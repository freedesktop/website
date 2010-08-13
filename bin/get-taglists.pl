#!/usr/bin/perl -w
# query EIS for the tag-lists via SOAP
use strict;
use utf8;
use lib '/srv/tinderbox/bin/modules';
use Cws;
use Eis;

sub print_tags($$)
{
    my $ft = shift;
    my $taglist = shift;

    open(MYOUT, ">$ft");
    print(MYOUT $taglist);
    close(MYOUT);

    return 0;
}

my $eis = Eis->new( uri => Cws::eis_uri(),
                    proxy_list => Cws::eis_proxy_list(),
                    net_proxy => Cws::net_proxy()
                    );

my $nominated      = $eis->getTinderboxTagList('nominated');
my $approved_by_QA = $eis->getTinderboxTagList('approved by QA');
my $ready_for_QA   = $eis->getTinderboxTagList('ready for QA');
my $new            = $eis->getTinderboxTagList('new');

die "EIS not reachable?!" unless (defined($new) and defined($ready_for_QA) and defined($approved_by_QA) and defined($nominated));

print_tags("/srv/www/tinderbox.go-oo.org/tags/tag-list-nominated", $nominated); 
print_tags("/srv/www/tinderbox.go-oo.org/tags/tag-list-approved",  $approved_by_QA);
print_tags("/srv/www/tinderbox.go-oo.org/tags/tag-list-qa",        $ready_for_QA);
print_tags("/srv/www/tinderbox.go-oo.org/tags/tag-list-new",       $new);

print_tags("/srv/www/tinderbox.go-oo.org/tags/tag-list", $nominated.$approved_by_QA.$ready_for_QA.$new);

