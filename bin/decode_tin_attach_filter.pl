#!/usr/bin/perl -w

use strict;
use utf8;
use MIME::Parser;
use MIME::Entity;
use Compress::Zlib; 
use open ':encoding(utf8)', ':std';

my $parser = new MIME::Parser;
$parser->output_under("/tmp/mimemail");

### Parse input:
my $entity = $parser->parse(\*STDIN) or die "parse failed $!\n";

#my $header = $entity->head();
#
#my $date = $header->get("Date");
#chomp $date;
#my $subject = $header->get("Subject");
#chomp $subject;
#print STDERR "processing mail received at ".$date."\tsubject: ".$subject."\n";
### Take a look at the top-level entity (and any parts it has):

my $first_part = $entity->parts(1) or die "no second part $!\n";

#$entity->parts(\@{[$entity->parts(0)]});
#$entity->make_singlepart();
#print "******\n\n";
#$entity->print_header(\*STDOUT);
#print "******komplett ****\n\n";
#$entity->print(\*STDOUT);
#$first_part->bodyhandle->print(\*STDOUT);
#$dest = Compress::Zlib::memGunzip($buffer)

my $gz = gzopen($first_part->bodyhandle->path(), "rb") or die "gzopen failed $!\n";
#$first_part->bodyhandle->print(\*STDOUT);
my $buffer;
my $writehandle = $entity->parts(0)->bodyhandle->open("w") or die "failed to open bodyhandle for writing $!\n";
$writehandle->print($buffer) while $gz->gzread($buffer) > 0 ;
$writehandle->close();
$gz->gzclose();
$entity->parts(\@{[$entity->parts(0)]});
$entity->make_singlepart();
$entity->print(\*STDOUT);
#my $dummymail = MIME::Entity->new();
#$dummymail->print(\*STDOUT);
$parser->filer->purge();
rmdir ($parser->output_dir());
