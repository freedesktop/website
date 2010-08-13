#!/usr/bin/perl -w

use strict;
use utf8;
# Global cvstmp location. Edit here
my $CVS_TMPDIR="/tmp/cvstmp";
my $CVS_ROOT=":pserver:anoncvs\@anoncvs.services.openoffice.org:/cvs";
my $SVN_URL="svn://svn.services.openoffice.org/ooo/tags";
my $hg_cmd = 'hg';
my $hgrepodir = '/var/mercurial/DEV300-repo';
my $hgrepodir_maint = '/var/mercurial/OOO320-repo';
my $HG_URL = 'http://hg.services.openoffice.org/DEV300';
# add corresponding pull command in case more release clones are added
my $HG_URL_MAINT32 = 'http://hg.services.openoffice.org/OOO320';
my $HG_URL_MAINT33 = 'http://hg.services.openoffice.org/OOO330';

my $DEFAULT_MASTER='DEV300';
my $RELEASE_MASTER='OOO330'; # 3.3
my $OLD_MASTER='OOO320'; # 3.2
my $OLD_RELEASE_MASTER='OOH680'; # 2.4
# end of config section - shouldn't be necessary to touch code below

sub min($$) {
	my($x, $y) = @_;
	return $x < $y ? $x : $y;
}

my $CvsRoot;
my $SvnTags;
my $HgTags;

my @latestmasters=();
my @default=();
my @release=();
my @old=();
my @oldrelease=();


my $defcount=0;
my $oldcount=0;
my $relcount=0;
my $oldrelcount=0;

`$hg_cmd --cwd $hgrepodir pull -q $HG_URL`;
`$hg_cmd --cwd $hgrepodir pull -q $HG_URL_MAINT32`;
`$hg_cmd --cwd $hgrepodir pull -q $HG_URL_MAINT33`;

open ($HgTags, "$hg_cmd --cwd $hgrepodir tags |") || return 0;
while (<$HgTags>) {
	chomp;
	s/\s+.*$//;
	next unless /^[A-Z]+.*_m[0-9]+/;
	push @default, $_ if (/^$DEFAULT_MASTER/);
	push @release, $_ if (/^$RELEASE_MASTER/);
	push @old, $_ if (/^$OLD_MASTER/);
	#$defcount++;
	#last if ($defcount == 3);
}
close $HgTags;

#open ($HgTags, "$hg_cmd --cwd $hgrepodir tags |") || return 0;
#while (<$HgTags>) {
#	chomp;
#	s/\s+.*$//;
#	next unless /^[A-Z]+.*_m[0-9]+/;
#	push @release, $_ if (/^$RELEASE_MASTER/);
#	push @old, $_ if (/^$OLD_MASTER/);
#}
#close $HgTags;

open ($SvnTags, "svn list $SVN_URL |") || return 0;
while (<$SvnTags>) {
	chomp;
	s|/||;
#	push @old, $_ if (/^$OLD_MASTER/);
	push @oldrelease, $_ if (/^$OLD_RELEASE_MASTER/);
}

# set counts to the minimum 
# don't try to include more than we actually have, and not more than we actually want
$defcount    = min(@default, 3); # 2-> allow to add one from cvs
$relcount    = min(@release, 2);
$oldcount    = min(@old, 2);
$oldrelcount = min(@oldrelease, 1);

push @latestmasters, (sort { (split "_m", $a,2)[1] <=> (split "_m", $b,2)[1] } @default)[-$defcount...-1] if ($defcount > 0);
push @latestmasters, (sort { (split "_m", $a,2)[1] <=> (split "_m", $b,2)[1] } @release)[-$relcount...-1] if ($relcount > 0); 
push @latestmasters, (sort { (split "_m", $a,2)[1] <=> (split "_m", $b,2)[1] } @old)[-$oldcount...-1] if ($oldcount > 0); 
push @latestmasters, (sort { (split "_m", $a,2)[1] <=> (split "_m", $b,2)[1] } @oldrelease)[-$oldrelcount...-1] if ($oldrelcount > 0); 


`mkdir -p $CVS_TMPDIR`;
`cd $CVS_TMPDIR && cvs -d $CVS_ROOT co -A solenv/inc/minor.mk`;
open ($CvsRoot, "cd $CVS_TMPDIR && cvs -d $CVS_ROOT status -v solenv/inc/minor.mk |") || return 0;
while (<$CvsRoot>) {
	if (/^\t$DEFAULT_MASTER/) {
		next if ($defcount == 3);
		$defcount++;
	} elsif (/^\t$OLD_MASTER/) {
		next if ($oldcount == 2);
		$oldcount++;
	} elsif (/^\t$RELEASE_MASTER/) {
		next if ($relcount == 2);
		$relcount++;
	} elsif (/^\t$OLD_RELEASE_MASTER/) {
		next if ($oldrelcount == 1);
		$oldrelcount++;
	} else {
		next;
	}
	s/^\t([^\s]+).*$/$1/;
	chomp;
	push @latestmasters, $_; 
	last if ( $defcount+$oldcount+$relcount+$oldrelcount == 8);
}

my @modules = ();
my $reading_modules = 0;
open ($CvsRoot, "cvs -d $CVS_ROOT co -c 2>&1 |") || return 0;
while (<$CvsRoot>) {
    $reading_modules = 0 if (/^\S/);
    $reading_modules = '1' if (/^OpenOffice3\s+\-a\s+/ or /^Extensions3\s+\-a\s+/);
    if ($reading_modules) {
	chomp;
	s/^.*\-a//;
	for my $elem (split (/ +/, $_)) {
	    push @modules, $elem if ($elem ne '');
	}
    }
}
close ($CvsRoot) || return 0;

die "couldn't determine master-list!" unless ( @latestmasters );
die "couldn't determine modules!" unless ( @modules );

open (MASTER_LIST, ">/home/ooweb/tinderbox.go-oo.org/tags/tag-latest-master-list");
print MASTER_LIST "# List of the last three master workspaces\n";
print MASTER_LIST "# <name> : <master-tag> : <master-tag> : <modules>\n";

for my $mastermod (sort @latestmasters) {
    print MASTER_LIST "$mastermod : $mastermod : $mastermod : @modules\n";
}
close MASTER_LIST;
