#!/usr/bin/perl -w

use File::Basename;
use Cwd;
use tinsend;

# Get parameter

# Name for the build "OOo W32-MSVC6" or "OOo W32-NET2002"
$tinderbuildname = "$ARGV[0]";
if ( "$tinderbuildname" eq "" ) {
    die "No tinderbuildname";
}

# cyg, 4nt, linux, mingw, cygming
$ooobuildsys = "$ARGV[1]";
if ( "$ooobuildsys" eq "" ) {
    die "No ooobuildsys";
}

# Sourcepath
$ooosrcpath = "$ARGV[2]";
if ( "$ooosrcpath" eq "" ) {
    die "No ooosrcpath";
}

# Tag
$oootag = "$ARGV[3]";
if ( "$oootag" eq "" ) {
    die "No oootag";
}

# up, clean, co, cont
$ws_cmd = "$ARGV[4]";
if ( "$ws_cmd" !~ /^up$|^clean$|^co$|^cont$/ ) {
    die("Unknown 4th parameter: $ws_cmd\n");
}

# Tinderbox send: true / ---
$REALLYSEND = "$ARGV[5]";
if ( ($REALLYSEND eq "true") or ($REALLYSEND eq "send") or ($REALLYSEND eq "") ) {
	$REALLYSEND = "true";
} else {
	$REALLYSEND = "";
}

print("Buildnamepara: ".$tinderbuildname."\nBuildsyspara: ".$ooobuildsys."\nOOo srcpath: ".$ooosrcpath."\nBuildtag: ".$oootag."\nBuildtype: ".$ws_cmd."\n");
#die "end";

if ( ($ooobuildsys eq "cyg") or ($ooobuildsys eq "mingw") or ($ooobuildsys eq "cygming") ) {
    $tinsend::BUILDNAME = $tinderbuildname.'-tcsh';
} else {
    $tinsend::BUILDNAME = $tinderbuildname.'-'.$ooobuildsys;
}

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

# -- Things not to tweak --
#Override default for debugging purposes
#$tinsend::TINDER_DEST = 'quetschke@scytek.de';

# Global variable(s)
my $LOGDIR = cwd() . "/../logdirs";
my $buildlogdir = "$LOGDIR/$oootag";
`mkdir -p $buildlogdir` ;
my $buildlog = "$buildlogdir/notset";

sub build_one {
    my $tree = shift;
    my $buildsys = shift;
    my $sourcedir = shift;
    my $starttime = time();
    my $err;

    # use a global variable here
    $buildlog = `date +%y%m%d_%H%M%S` ;
    chomp($buildlog);
    $buildlog = "$buildlogdir/$buildlog-$buildsys" ;

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

    logprint("Building ... (log: $buildlog)\n");
    if ($status eq 'success' and system ("./buildall.sh $tree $buildsys $buildlog $sourcedir")) {
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
build_one ($oootag, $ooobuildsys, $ooosrcpath);
print "Done!\n";
