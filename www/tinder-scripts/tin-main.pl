#!/usr/bin/perl -w

# tin-main.pl - Main perl program to send reports to the tinderbox.
#
# Version 0.2 - 22.12.2005
#
# Syntax (all five parameters are needed):
# tin-main.pl buildstring src_path ws {co|up|cont|clean} {send|nosend}
#  buildstring - Name that will appear in the tinderbox
#  src_path    - Pointing to source to be used
#  ws          - Which workspace shall be build. It accepts CWSs names
#                (from the list in
#                   <http://go-oo.org/tinderbox/tags/tag-list>)
#                or all MWSs starting with ???680_m*.
#  co|up|cont|clean - Tells the script what to do with src_path. Fresh
#                checkout, update a current repo (this also deletes
#                modified/extra files), do nothing, just start/continue
#                with current repo, and clean removes all wntmsci10.pro
#                before rebuilding. (Needs pacthing for UNX ;) )
#  send|nosend - send the logfile to the tinderbox (or not)
#
# Example: ./ti-main.pl "OOoW32-(opti)" /cygdrive/d/w1/SRC680_m140 SRC680_m140 co send

use File::Basename;
use Cwd;
use tinsend;

# Get parameter

# Name for the build "OOo W32-MSVC6" or "OOo W32-NET2002"
$tinderbuildname = "$ARGV[0]";
if ( "$tinderbuildname" eq "" ) {
    die "No tinderbuildname";
}

# Sourcepath
$ooosrcpath = "$ARGV[1]";
if ( "$ooosrcpath" eq "" ) {
    die "No ooosrcpath";
}

# Tag
$oootag = "$ARGV[2]";
if ( "$oootag" eq "" ) {
    die "No oootag";
}

# up, clean, co, cont
$ws_cmd = "$ARGV[3]";
if ( "$ws_cmd" !~ /^up$|^clean$|^co$|^cont$/ ) {
    die("Unknown 4th parameter: $ws_cmd\n");
}

# Tinderbox send: true / ---
$REALLYSEND = "$ARGV[4]";
if ( ($REALLYSEND eq "true") or ($REALLYSEND eq "send") or ($REALLYSEND eq "") ) {
	$REALLYSEND = "true";
} else {
	$REALLYSEND = "";
}

print("Buildnamepara: ".$tinderbuildname."\nOOo srcpath: ".$ooosrcpath."\nBuildtag: ".$oootag."\nBuildtype: ".$ws_cmd."\n");
#die "end";

$tinsend::BUILDNAME = $tinderbuildname;

# -- Things to tweak --
$tinsend::FROMADDRESS = 'Volker Quetschke <quetschke@scytek.de>';

## Choose the correct smtp settings:
# -- smtpserver without password --
$tinsend::SMTPAUTH = ''; # Don't change this!
$tinsend::SMTPSERVER = 'localhost';
$tinsend::SMTPAUTHID = ''; # Don't change this!
$tinsend::SMTPAUTHPW = ''; # Don't change this!
# -- end smtpserver without password --

# -- smtpserver with password --
#$tinsend::SMTPAUTH = 'LOGIN'; # Don't change this!
#$tinsend::SMTPSERVER = 'smtp.serverwithpw.com';
#$tinsend::SMTPAUTHID = 'userid';
#$tinsend::SMTPAUTHPW = 'password';
# -- end smtpserver with password --
# -- End of Things to tweak --

# -- Things not to tweak --
#Override default for debugging purposes
#$tinsend::TINDER_DEST = 'quetschke@scytek.de';

# Global variable(s)
my $LOGDIR = cwd() . "/../logdirs";
my $buildlogdir = "$LOGDIR/$oootag";
`mkdir -p $buildlogdir` ;
my $buildlog = "$buildlogdir/is_reset_later";

sub build_one {
    my $tree = shift;
    my $sourcedir = shift;
    my $starttime = time();
    my $err;

    # use a global variable here
    $buildlog = `date +%y%m%d_%H%M%S` ;
    chomp($buildlog);
    $buildlog = "$buildlogdir/tin$buildlog" ;

    logprint("Building $tree: ".$starttime."\n");

    $err = "";
    do {
        $err=tinsend::mailsend ('building', $tree, $starttime, "Mailbody\n", "") if ( $REALLYSEND ) ;
        if($err){
            logprint($err."\n");
            sleep(300);
        }
    } until ( !$err);

    logprint("Setting up ws ... (log: $buildlog)\n");
    my $CVSSTARTTIME="tinget.pl started at: ".qx{date +%T};
    logprint("--------------------------------------------------\n");
    logprint($CVSSTARTTIME);

    if (system ("./tinget.pl $tree $buildlog $sourcedir $ws_cmd")) {
	$status = 'ws_cmd_failed';
    } else {
	$status = 'success';
    }
    logprint("tinget.pl ended at: ".qx(date +%T)." with: $status\n");
    logprint("--------------------------------------------------\n");

    logprint("Preparing, running tinprep.sh ...\n");
    if ($status eq 'success' and system ("./tinprep.sh $sourcedir >> $buildlog 2>&1")) {
	$status = 'something_failed';
    } else {
	$status = 'success';
    }
    logprint("tinprep.sh ended with: $status\n");
    logprint("--------------------------------------------------\n");

    logprint("Building ... (log: $buildlog)\n");
    if ($status eq 'success' and system ("./tinbuild.sh $tree $buildlog $sourcedir")) {
	$status = 'build_failed';
    } else {
	$status = 'success';
    }

    $err = "";
    do {
        $err=tinsend::mailsend ($status, $tree, $starttime, "Mailbody for mail with logfile\n", $buildlog) if ( $REALLYSEND ) ;
        if($err){
            logprint($err."\n");
            sleep(300);
        }
    } until ( !$err);
}

sub logprint {
    my $output = shift;

    open(LOG, ">> $buildlog") or die "Can't open $buildlog: $!";
    print( LOG $output );
    close( LOG);
}

## Main

print "Starting cycle ".gmtime(time())."\n";
build_one ($oootag, $ooosrcpath);
print "Done!\n";
