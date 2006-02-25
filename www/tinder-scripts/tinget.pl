#!/usr/bin/perl -w

# tinget.pl - perl script to "refresh" the workspace directory
#
# Version 0.4 - 25.02.2006
#
# Syntax (all four parameters are needed):
# tinget.pl ws buildlog src_path {co|up|cont|clean}
#  ws          - See tinder-main.pl.
#  buildlog    - logfile name
#  src_path    - See tinder-main.pl.
#  {co|up|cont|clean} - See tin-main.pl.

my $tree = shift;
my $log = shift;
my $builddir = shift;
my $do_up = shift;

chomp($builddir = qx{cygpath -au "$builddir"});
chomp($log = qx{cygpath -au "$log"});

#my $cwsname="morejava";
my $cwsname=$tree;

$BUILD_TAG_BASE = 'http://go-oo.org/tinderbox/tags/';
$BUILD_TAG_NAME = 'tag-list';
$BUILD_MASTER_TAG_NAME = 'tag-latest-master-list';

my $cvshost="anoncvs\@anoncvs.services.openoffice.org";

sub log_msg($@)
{
    my $log = shift;
    my $logf;

    print STDERR @_ if ($debug);

    open($logf, ">> $log") || die "Can't open log: $!";
    print $logf @_;

    close($logf);
}

sub cvs_op($$)
{
    my $tag = shift;
    my $subdir = shift;
    my $count = 0;

    my $cmd;
    my $cmd2;

    log_msg ($log.'.up', "Starting cvs $do_up in $subdir with $tag ...\n");
    log_msg ($log.'.uperr', "Starting cvs $do_up in $subdir with $tag ...\n");
    print("Starting cvs $do_up in $subdir with $tag ...\n");

    if( $subdir eq "xmerge" && -d "$subdir/java/org" ) {
	log_msg ($log, "WARNING: Found xmerge/java/, see iz62573, removed.\n");
	qx{rm -rf "$subdir/java"};
    }

    # If there is no CVS dir do a "co" instead of "up"
    if ( $do_up eq "up" and (! -d "$subdir/CVS") ) {
        log_msg ($log, "WARNING: $subdir missing, cvs up not possible, doing cvs co.\n");
        $do_up = "co";
    }

    if ( $do_up eq "co") {
        $cmd="cvs -z3 -d :pserver:".$cvshost.":/cvs co -r$tag $subdir >> $log.up 2>> $log.uperr";
        $cmd2="";
    } elsif ( $do_up eq "up") {
        $cmd="cd $subdir && cvs -z3 -d :pserver:".$cvshost.":/cvs up -r$tag -dPRC -I ! -I CVS > $log.clean 2>> $log.uperr";
        $cmd2="cd $subdir && awk '{ if ( \$1 == \"?\" ) { system( \"{ echo loesche:\"\$2\": ; rm -rf \"\$2\" ; }\" ) } else { print \$0 } }' $log.clean >> $log.up 2>> $log.uperr";
    } elsif ( $do_up eq "clean") {
        $cmd="rm -rf $subdir/wntmsci*.pro >> $log.up 2>> $log.uperr";
        $cmd2="";
    } elsif ( $do_up eq "cont") {
        $cmd="";
        $cmd2="";
    } else {
        die "Unknown parameter: $do_up";
    }

    while (1) {
      $count++;

      if ( $cmd eq "" && $cmd2 eq "" ) {
	    log_msg ($log.'.up', "Nothing to do in $subdir\n");
	    return 1;
      }

      if ( $cmd && system ($cmd)) {
	    if ($count < 5) {
          log_msg ($log, "WARNING: $do_up in $subdir failed, retrying $count\n");
	    } else {
          log_msg ($log, "ERROR: $do_up in $subdir failed, retry limit reached\n");
          sleep(30);
          return 0;
	    }
      } else {
          if ( $cmd2 && system ($cmd2) ) {
              log_msg ($log, "ERROR: $do_up / $cmd2 in $subdir failed\n");
              sleep(30);
              return 0;
          }
	    log_msg ($log.'.up', "cvs $do_up in $subdir succeeded\n");
	    return 1;
      }
    }
  }


### MAIN


`mkdir -p $builddir`;
chdir $builddir || die "Cannot change to :".$builddir.":";

unlink ($BUILD_TAG_NAME);
system( "wget $BUILD_TAG_BASE/$BUILD_TAG_NAME" ) && die "Failed to download: $BUILD_TAG_BASE/$BUILD_TAG_NAME";
unlink ($BUILD_MASTER_TAG_NAME);
system( "wget $BUILD_TAG_BASE/$BUILD_MASTER_TAG_NAME" ) && die "Failed to download: $BUILD_TAG_BASE/$BUILD_MASTER_TAG_NAME";

my $TagList;
my %cws_table;
open ($TagList, $BUILD_TAG_NAME) || die "Can't open $BUILD_TAG_NAME: $!"; 
while (<$TagList>) {
    /^\s*\#/ && next;
    if (/\s*([^\s]+)\s*:\s*([^\s]+)\s*:\s*([^\s]+)\s*:\s*(.*)\s*/) {
	my %values = ( 'name', $1, 'master_tag', $2, 'cws_tag', $3, 'modules', $4 );
	$cws_table{$1} = \%values;
    } else {
	print STDERR "invalid line '$_'\n";
    }
}
close ($TagList);

my %mws_table;
open ($TagList, $BUILD_MASTER_TAG_NAME) || die "Can't open $BUILD_TAG_NAME: $!"; 
while (<$TagList>) {
    /^\s*\#/ && next;
    if (/\s*([^\s]+)\s*:\s*([^\s]+)\s*:\s*([^\s]+)\s*:\s*(.*)\s*/) {
	my %values = ( 'name', $1, 'master_tag', $2, 'cws_tag', $3, 'modules', $4 );
	$mws_table{$1} = \%values;
    } else {
	print STDERR "invalid line '$_'\n";
    }
}
close ($TagList);

my $cwstag;
my @cwsmodules;
my %incws;
my $mastertag;
if( $cwsname !~ /^\w\w\w680_m/ ) {
    if( !defined($cws_table{$cwsname}) ) {
        die("\nThe requested CWS name [$cwsname] does not exist! Aborting ...\n");
    }
    $cwstag=$cws_table{$cwsname}->{'cws_tag'};
    @cwsmodules = split / /, $cws_table{$cwsname}->{'modules'};
    for (@cwsmodules) { $incws{$_} = 1 }
    $mastertag=$cws_table{$cwsname}->{'master_tag'};
    log_msg ($log, "Getting CWS $cwsname\n");
} else {
    log_msg ($log, "Getting MWS $cwsname\n");
    $cwstag = $cwsname;
    $mastertag = $cwsname;
}

# Just use some key of the mws hash. It's not guaranteed that the mws
# that belongs to the cws is included in the 3 element mws list
my $mastercolist = each %mws_table;
#print $mastertag;

my @mwsmodules = split / /, $mws_table{$mastercolist}->{'modules'};

if( $do_up ne "cont") {
    log_msg ($log, "Removing solver ...\n");
    my $rmsolver = "rm -rf solver/* >> $log.up 2>> $log.uperr";
    system ($rmsolver) && die "Cannot remove solver";
}

log_msg ($log, "Updating modules ...\n");
for my $mod (@mwsmodules) {
  log_msg ($log, "Module '$mod'" );
  my $cvstag = $mastertag;
  if( $incws{$mod} )
  { $cvstag = $cwstag;
    log_msg ($log, " - from $cwstag" );
  }
  log_msg ($log, "\n" );
  cvs_op ("$cvstag", $mod) || die "cvs operation failed!";
}

