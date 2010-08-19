# -*- Mode: perl; indent-tabs-mode: nil -*-
# vim: set ts=2 expandtab sw=2 : 

# TinderDB::VC_SVN - methods to query the SVN Version Control
# system and find the users who have checked changes into the tree
# recently and renders this information into HTML for the status page.
# This module depends on TreeData.  The TinderHeader::TreeState is
# queried so that users will be displayed in the color which
# represents the state of the tree at the time they checked their code
# in.  If you are using bonsai you should not use this module, use
# TinderDB::VC_Bonsai instead.

# The contents of this file are subject to the Mozilla Public
# License Version 1.1 (the "License"); you may not use this file
# except in compliance with the License. You may obtain a copy of
# the License at http://www.mozilla.org/NPL/
#
# Software distributed under the License is distributed on an "AS
# IS" basis, WITHOUT WARRANTY OF ANY KIND, either express or
# implied. See the License for the specific language governing
# rights and limitations under the License.
#
# The Original Code is the Tinderbox build tool.
#
# The Initial Developer of the Original Code is Netscape Communications
# Corporation. Portions created by Netscape are
# Copyright (C) 1998 Netscape Communications Corporation. All
# Rights Reserved.
#

# Written by Mike Taylor (bear@code-bear.com) and heavily
# based on VC_CVS.pm to get the flavour of the existing code
#
# Contributor(s): 

# $Revision: 1.3 $ 
# $Date: 2006/08/28 20:12:37 $ 
# $Author: timeless%mozdev.org $ 
# $Source: /cvsroot/mozilla/webtools/tinderbox2/src/lib/TinderDB/VC_SVN.pm,v $ 
# $Name:  $ 


package TinderDB::VC_OOo;

# the raw SVN implemenation of the Version Control DB for Tinderbox.
# This column of the status table will report who has changed files in
# the SVN repository and what files they have changed.

# NOTE: This code uses "svn log" to pull the history log for a given
#       revision (by date/time) and parses that output

#   We store the hash of all names who modified the tree at a
#   particular time as follows:

#   $DATABASE{$tree}{$time}{'author'}{$author}{$file} = 1;

# additionally information about changes in the tree state are stored
# in the variable:

#   $DATABASE{$tree}{$time}{'treestate'} = $state;

# we also store information in the metadata structure

#   $METADATA{$tree}{'updates_since_trim'} += 1;
#
# where state is either 'Open' or 'Closed' or some other user defined string.
#
# Cell colors are controled by the functions:
#	TreeData::get_all_tree_states()
#	TreeData::TreeState2color($state)

# Load standard perl libraries
use File::Basename;
use Time::Local;

# Load Tinderbox libraries
use lib '/srv/tinderbox/local_conf',
   '/srv/tinderbox/default_conf',
   '/var/tinderbox/lib';

use TinderDB::BasicTxtDB;
use Utils;
use HTMLPopUp;
use TreeData;
use VCDisplay;

$VERSION = ( qw $Revision: 1.3 $ )[1];

@ISA = qw(TinderDB::BasicTxtDB);

# name of the version control system

$VC_NAME = $TinderConfig::VC_NAME || "SVN";

# How we recoginize bug number in the checkin comments.

$VC_BUGNUM_REGEXP = $TinderConfig::VC_BUGNUM_REGEXP || '(\d\d\d+)';

# We 'have a' notice so that we can put stars in our column.

$NOTICE = TinderDB::Notice->new();
$DEBUG  = 1;

my %SVNTREES = ();

sub parse_svn_time { 
  # convert svn times into unix times.
  # timestamp is passed in as "2005-06-02 01:38:15 -0400 (Thu, 02 Jun 2005)"

  my ($timestamp) = @_;

  my (@timestamp) = split(/ /, $timestamp);

  my ($date_str) = shift @timestamp;
  my ($time_str) = shift @timestamp;

  my ($year, $mon, $mday, $hours, $min,) = ();

  ($year, $mon, $mday,) = split(/-/, $date_str);
  ($hours, $min,) = split(/:/, $time_str);

  # The perl conventions for these variables is 0 origin while the
  # "display" convention for these variables is 1 origin.  
  $mon--;

  my $sec = 0;

  my ($time) = timelocal($sec,$min,$hours,$mday,$mon,$year);    

  # This fix is needed every year on Jan 1. On that day $time is
  # nearly a year in the future so is much bigger than $main::TIME.

  if ( ($time - $main::TIME) > $main::SECONDS_PER_MONTH) {
    $time = timelocal($sec,$min,$hours,$mday,$mon,$year - 1);    
  }

  # check that the result is reasonable.

  if ( (($main::TIME - $main::SECONDS_PER_YEAR) > $time) || 
       (($main::TIME + $main::SECONDS_PER_MONTH) < $time) ) {
    die("SVN reported time: $time ".scalar(localtime($time)).
        " which is more than a year away from now or in the future.\n");
  }

  return $time;
}

sub time2svnformat {
  # convert time() format to svn input format

  my ($time) = @_;

  my ($sec,$min,$hour,$mday,$mon,
      $year,$wday,$yday,$isdst) = gmtime($time);

  $mon++;
  $year += 1900;

  # for now only do date
  my ($svn_date_str) = sprintf("%04u-%02u-%02u",
                               $year, $mon, $mday);
  #my ($svn_date_str) = sprintf("%04u-%02u-%02u %02u:%02u:%02u",
  #                             $year, $mon, $mday, $hour, $min, $sec);

  return $svn_date_str;
}

sub trim_db_history {
  # remove all records from the database which are older than last_time.

  my ($self, $tree,) = (@_);

  my ($last_time) =  $main::TIME - $TinderDB::TRIM_SECONDS;

  # sort numerically ascending
  my (@times) = sort {$a <=> $b} keys %{ $DATABASE{$tree} };

  foreach $time (@times) {
    ($time >= $last_time) && last;

    delete $DATABASE{$tree}{$time};
  }

  return ;
}

sub get_all_hg_data {
  # Print out the Database in a visually useful form.
  my ($self, $tree) = (@_);

  my $treestate = TinderHeader::gettree_header('TreeState', $tree);

  # sort numerically descending
  my (@times) = sort {$b <=> $a} keys %{ $DATABASE{$tree} };

  my $out;
  $out .= "<html>\n";
  $out .= "<head>\n";
  $out .= "\t<title>Mercurial Checkin Data as gathered by Tinderbox</title>\n";
  $out .= "</head>\n";
  $out .= "<body>\n";
  $out .= "<h3>Mercurial Checkin Data as gathered by Tinderbox</h3>\n";
  $out .= "\n\n";
  $out .= "<table BORDER=1 BGCOLOR='#FFFFFF' CELLSPACING=1 CELLPADDING=1>\n";
  $out .= "\t<tr>\n";
  $out .= "\t\t<th>Time</th>\n";
  $out .= "\t\t<th>Tree State</th>\n";
  $out .= "\t\t<th>Author</th>\n";
  $out .= "\t\t<th>Comment</th>\n";
  $out .= "\t\t<th>Files</th>\n";
  $out .= "\t</tr>\n";

  # we want to be able to make links into this page either with the
  # times of checkins or of times which are round numbers.

  my $rounded_increment = $main::SECONDS_PER_MINUTE * 30;
  my $rounded_time = main::round_time($times[0]);

  # Why are the names so confusing in this code?
  # Netscape does not scroll to the middle of a large table if we
  # put names between the rows, however it will scroll if we name
  # the contents of a cell.

  foreach $time (@times) {
    # Allow us to create links which point to times which may not
    # appear in the data.  These links should correspond to the cell
    # spacing in the status table.

    my $names = '';

    while ($rounded_time > $time) { 
      my $comment = "<!-- ".localtime($rounded_time)." -->";
      $names .= ("\t\t\t".
        HTMLPopUp::Link("name" => $rounded_time,
          "linktxt" => $comment,
        ).
        "\n");
      $rounded_time -= $rounded_increment;
    }

    # Allow us to create links which point to any row.

    my $localtime = localtime($time);
    my $cell_time = HTMLPopUp::Link("name" => $time,
      "linktxt" => $localtime,
    );

    ($names) && ($cell_time .= "\n".$names."\t\t");

    if (defined($DATABASE{$tree}{$time}{'treestate'})) {

      $treestate = $DATABASE{$tree}{$time}{'treestate'};

      $out .= "\t<tr>\n";
      $out .= "\t\t<td>$cell_time</td>\n";
      $out .= "\t\t<td ALIGN=center >$treestate</td>\n";
      $out .= "\t\t<td>$HTMLPopUp::EMPTY_TABLE_CELL</td>\n";
      $out .= "\t\t<td>$HTMLPopUp::EMPTY_TABLE_CELL</td>\n";
      $out .= "\t</tr>\n";
    }

    if ( defined($DATABASE{$tree}{$time}{'changeset'}) ) {
      my ($recs) = $DATABASE{$tree}{$time}{'changeset'};
      my (@changes) = sort (keys %{ $recs });

      foreach $changeset (@changes) {
        my $author = $recs->{$changeset}{'author'};
        my $filesout="";
        if ($recs->{$changeset}{'file_adds'}) {
          $filesout.='<span style="color:#cc0000;">A ';
          $filesout.=join('<br/>A ', @{$recs->{$changeset}{'file_adds'}});
          $filesout.='</span>';
        }
        if ($recs->{$changeset}{'file_dels'}) {
          $filesout.='<br/>' if ($filesout);
          $filesout.='<span style="color:#008800;">D ';
          $filesout.=join('<br/>D ', @{$recs->{$changeset}{'file_dels'}});
          $filesout.='</span>';
        }
        if ($recs->{$changeset}{'file_mods'}) {
          $filesout.='<br/>' if ($filesout);
          $filesout.='M ';
          $filesout.=join('<br/>M ', @{$recs->{$changeset}{'file_mods'}});
        }
        my $comment   = $recs->{$changeset}{'comment'};
        $comment =~ s/$VC_BUGNUM_REGEXP/<a href="$TinderConfig::BT_URL$1">$1<\/a>/g;
        # add changeset for author-column
        $author.='<br/><a href="http://hg.services.openoffice.org/hg/cws/'.$tree;
        $author.='/rev/'.$changeset.'">'.$changeset.'</a>';
        $out .= "\t<tr>\n";
        $out .= "\t\t<td>$cell_time</td>\n";
        $out .= "\t\t<td>$treestate</td>\n";
        $out .= "\t\t<td>$author</td>\n";
        $out .= "\t\t<td>$comment</td>\n";
        $out .= "\t\t<td>$filesout</td>\n";
        $out .= "\t</tr>\n";
      } # foreach $changeset
    } # defined ->{changeset}
  } # foreach $time

  $out .= "</table>\n";
  $out .= "\n\n";
  $out .= "This page was generated at: ";
  $out .= localtime($main::TIME);
  $out .= "\n\n";
  $out .= "</body>\n";
  $out .= "</html>\n";
  return $out;
}

sub get_all_svn_data {
  # Print out the Database in a visually useful form.

  my ($self, $tree) = (@_);

  my $treestate = TinderHeader::gettree_header('TreeState', $tree);

  # sort numerically descending
  my (@times) = sort {$b <=> $a} keys %{ $DATABASE{$tree} };

  my $out;
  $out .= "<html>\n";
  $out .= "<head>\n";
  $out .= "\t<title>SVN Checkin Data as gathered by Tinderbox</title>\n";
  $out .= "</head>\n";
  $out .= "<body>\n";
  $out .= "<h3>SVN Checkin Data as gathered by Tinderbox</h3>\n";
  $out .= "\n\n";
  $out .= "<table BORDER=1 BGCOLOR='#FFFFFF' CELLSPACING=1 CELLPADDING=1>\n";
  $out .= "\t<tr>\n";
  $out .= "\t\t<th>Time</th>\n";
  $out .= "\t\t<th>Tree State</th>\n";
  $out .= "\t\t<th>Author</th>\n";
  $out .= "\t\t<th>Comment</th>\n";
  $out .= "\t\t<th>File</th>\n";
  $out .= "\t</tr>\n";

  # we want to be able to make links into this page either with the
  # times of checkins or of times which are round numbers.

  my $rounded_increment = $main::SECONDS_PER_MINUTE * 30;
  my $rounded_time = main::round_time($times[0]);

  # Why are the names so confusing in this code?
  # Netscape does not scroll to the middle of a large table if we
  # put names between the rows, however it will scroll if we name
  # the contents of a cell.

  foreach $time (@times) {
    # Allow us to create links which point to times which may not
    # appear in the data.  These links should correspond to the cell
    # spacing in the status table.

    my $names = '';

    while ($rounded_time > $time) { 
      my $comment = "<!-- ".localtime($rounded_time)." -->";
      $names .= ("\t\t\t".
        HTMLPopUp::Link("name" => $rounded_time,
          "linktxt" => $comment,
        ).
        "\n");
      $rounded_time -= $rounded_increment;
    }

    # Allow us to create links which point to any row.

    my $localtime = localtime($time);
    my $cell_time = HTMLPopUp::Link("name" => $time,
      "linktxt" => $localtime,
    );

    ($names) && ($cell_time .= "\n".$names."\t\t");

    if (defined($DATABASE{$tree}{$time}{'treestate'})) {
      my $localtime = localtime($time);

      $treestate = $DATABASE{$tree}{$time}{'treestate'};

      $out .= "\t<tr>\n";
      $out .= "\t\t<td>$cell_time</td>\n";
      $out .= "\t\t<td ALIGN=center >$treestate</td>\n";
      $out .= "\t\t<td>$HTMLPopUp::EMPTY_TABLE_CELL</td>\n";
      $out .= "\t\t<td>$HTMLPopUp::EMPTY_TABLE_CELL</td>\n";
      $out .= "\t</tr>\n";
    }

    if ( defined($DATABASE{$tree}{$time}{'author'}) ) {
      my ($recs) = $DATABASE{$tree}{$time}{'author'};
      my $localtime = localtime($time);
      my (@authors) = sort (keys %{ $recs });

      foreach $author (@authors) {
        my @files =  sort (keys %{ $recs->{$author} });
        my $rowspan = scalar (@files);
        my $cell_options = "ALIGN=center ROWSPAN=$rowspan";
        my $comment = $DATABASE{$tree}{$time}{'log'}{$author};
        $comment =~ s/$VC_BUGNUM_REGEXP/<a href="$TinderConfig::BT_URL$1">$1<\/a>/g;
        $out .= "\t<tr>\n";
        $out .= "\t\t<td $cell_options>$cell_time</td>\n";
        $out .= "\t\t<td $cell_options>$treestate</td>\n";
        $out .= "\t\t<td $cell_options>$author</td>\n";
        $out .= "\t\t<td $cell_options>$comment</td>\n";

        my $num;

        foreach $file (@files) {
          ($num) && ($out .= "\t<tr>\n");

          $num ++;

          $out .= "\t\t<td>$file</td>\n";
          $out .= "\t</tr>\n";
        } # $file
      } # $author
    }

  } # $time

  $out .= "</table>\n";
  $out .= "\n\n";
  $out .= "This page was generated at: ";
  $out .= localtime($main::TIME);
  $out .= "\n\n";
  $out .= "</body>\n";
  $out .= "</html>\n";
  return $out;
}

sub find_last_data {
  # Return the most recent times that we received treestate and checkin data.

  my ($tree) = @_;

  # sort numerically descending
  my (@times) = sort {$b <=> $a} keys %{ $DATABASE{$tree} };

  my ($last_tree_data, $second2last_tree_data, $last_svn_data);

  foreach $time (@times) {
    # We must check $second2last_tree_data before $last_tree_data or
    # we may end up with both pointing to the same entry.

    (defined($last_tree_data)) &&
      (!defined($second2last_tree_data)) &&
      (defined($DATABASE{$tree}{$time}{'treestate'})) &&
      ($second2last_tree_data = $time);

    (!defined($last_tree_data)) &&
      (defined($DATABASE{$tree}{$time}{'treestate'})) &&
      ($last_tree_data = $time);

    (!defined($last_svn_data)) &&
      (defined($DATABASE{$tree}{$time}{'author'}) || defined($DATABASE{$tree}{$time}{'changeset'})) &&
      ($last_svn_data = $time);

    # do not iterate through the whole history.
    # Stop after we have the data we need.

    (defined($last_svn_data)) &&
      (defined($second2last_svn_data)) &&
      (defined($last_tree_data)) &&
      last;

  } # foreach $time (@times) 

  return ($last_tree_data, $second2last_tree_data, $last_svn_data);
}

sub apply_db_updates {
  # Get the recent data from SVN and the treestate file.

  my ($self, $tree,) = @_;

  unless (%SVNTREES) {
    # create list of cws tracked in svn
    #print "getting trees tracked in svn\n";
    my @svnlist = main::cache_cmd("svn list svn://svn.services.openoffice.org/ooo/tags svn://svn.services.openoffice.org/ooo/cws");
    foreach my $cws (@svnlist) {
      chomp $cws; chop $cws; # remove trailing slash
      $SVNTREES{$cws}=0;
    }
  }
  return 0 unless defined($TreeData::VC_TREE{$tree}{'VCS'});
 
  my $vcs = $TreeData::VC_TREE{$tree}{'VCS'};

  my ($new_tree_state) = TinderHeader::gettree_header('TreeState', $tree);
  my ($last_tree_data, $second2last_tree_data, $last_svn_data) = 
  find_last_data($tree);

  # Store the latest treestate in the database along with the checkin data.

  # Take this opportunity to perform an optimization of the database.

  # We purge duplicate 'treestate' entries (entries at consecutive
  # times which have the same state) to keep the DB size down.
  # Data::Dumper takes a long time and reducing the data that it needs
  # to process really helps speed things up.

  # If we delete too many duplicates then we loose information when
  # the database is trimmed. We need to keep some duplicates arround
  # for debuging and for "redundancy". Only delete duplicates during
  # the last hour.  Notice we are still removing 90% of the
  # duplicates.

  # If we have three data points in a row, and all of them have the
  # same state and the oldest is less than an hour old, then we can
  # delete the middle state.  While writing this code I kept trying to
  # make do with only one older state being remembered.  The problem
  # is that if you keep deleting the oldest member you always have
  # exactly one entry which is only five minutes old.

  if ( defined($last_tree_data) && 
    defined($second2last_tree_data) &&
    ($new_tree_state eq $DATABASE{$tree}{$last_tree_data}{'treestate'}) &&
    ($new_tree_state eq $DATABASE{$tree}{$second2last_tree_data}{'treestate'}) &&
    ( ($main::TIME - $second2last_tree_data) < $main::SECONDS_PER_HOUR )
  ) {
    delete $DATABASE{$tree}{$last_tree_data}{'treestate'};

    (scalar(%{ $DATABASE{$tree}{$last_tree_data} }) == 0) &&
    delete $DATABASE{$tree}{$last_tree_data};
  }

  $DATABASE{$tree}{$main::TIME}{'treestate'} = $new_tree_state;

  ($last_svn_data) || ($last_svn_data = $main::TIME - $TinderDB::TRIM_SECONDS );

  my ($num_updates) = 0;

  if ($vcs eq 'SVN') {
    unless (defined $SVNTREES{$tree}) {
      print "Wrong status for: $tree - claims to be in SVN but is not available!\n";
      return 0;
    }
    my ($svn_date_str) = time2svnformat($last_svn_data, DEBUGFILE);

    $svn_date_str = "{$svn_date_str}:HEAD";
    $svn_date_str =~ s/\s+//;


    # my (@cmd) = ('svn', 
    #              'log', '--verbose',
    #              '--revision', $svn_date_str, 
    #              $TreeData::VC_TREE{$tree}{'root'},);
    # HACKY HACKY HACKY - the duplication with grep is to make that command not fail for cvs based trees
    my (@cmd) = ('svn log --verbose --revision '.$svn_date_str.' '.$TreeData::VC_TREE{$tree}{'root'},);
    #'|| ( svn log '.$TreeData::VC_TREE{$tree}{'root'}.' 2>&1 | grep "^svn: File not found: revision" >/dev/null )' ,);

    my (@svn_output) = main::cache_cmd(@cmd);

    # yep - the parsing code below is rather verbose but I did it this
    # way so that others can see what is happening and use/improve it
    # without having to grok a lot of perl'isms
    #
    # once it's been shown to be stable and bug-free *then* I will optimize it

    $parseRevision = True;
    $parseComments = False;
    $parseFiles    = False;

    foreach $line (@svn_output) {
      # we are now parsing lines which look like this:
      # ------------------------------------------------------------------------
      # r5461 | bear | 2005-05-25 20:48:54 -0700 (Wed, 25 May 2005) | 2 lines
      # Changed paths:
      #    M /trunk/chandler/distrib/linux/manifest.debug.linux
      #    M /trunk/chandler/distrib/linux/manifest.linux
      #    M /trunk/chandler/distrib/osx/manifest.debug.osx
      #    M /trunk/chandler/distrib/osx/manifest.osx
      #    M /trunk/chandler/distrib/win/manifest.debug.win
      #    M /trunk/chandler/distrib/win/manifest.win
      # 
      # Changed references to CVS in the exclude lists to .svn
      # 
      # ------------------------------------------------------------------------
      # r5462 | vajda | 2005-05-25 21:32:53 -0700 (Wed, 25 May 2005) | 1 line
      # Changed paths:
      #    M /trunk/chandler/parcels/osaf/contentmodel/mail/Mail.py
      # 
      # fixed bug due to switchover to datetime
      # ------------------------------------------------------------------------

      if ( $parseRevision eq True ) {
        unless ( substr($line, 0,  5) eq  '-----' || 
          substr($line, 0, 22) eq 'No commit for revision') {
          chop ($line);

          my (@line) = split(/\|/, $line);

          $revision     = shift @line;
          $author       = shift @line;
          $timestamp    = shift @line;
          $commentlines = shift @line;

          $revision     =~ s/^\s+//;
          $author       =~ s/^\s+//;
          $author       =~ s/\s+$//;
          $timestamp    =~ s/^\s+//;
          $commentlines =~ s/^\s+//;

          $time = parse_svn_time($timestamp);
          @line = split(/ /, $commentlines);

          $commentlinecount = shift @line;

          ($dest_dir, $repository_dir, $file, $comment) = '';

          $parseRevision = False;
          $parseComments = False;
          $parseFiles    = True;
        }
      }
      else {
        if ( $parseFiles eq True ) {
          chop ($line);

          if ( length($line) eq 0 ) {
            $parseFiles   = False;
            $parseComment = True;
          }
          else {
            unless ( substr($line, 0, 14) eq 'Changed paths:' ) {
              $line =~ s/^\s+//;
              @line = split(/ /, $line);

              $revtype = shift @line;
              $file    = shift @line;
              $file    =~ s/^\///;

              $DATABASE{$tree}{$time}{'author'}{$author}{"$file"} = 1;
              $num_updates ++;
            }
          }
        }
        else {
          if ( $parseComment eq True ) {

            $comment          .= $line;
            $commentlinecount -= 1;

            if ( $commentlinecount == 0 ) {
              $DATABASE{$tree}{$time}{'log'}{$author} = $comment;
              $parseComments = False;
              $parseRevision = True;
            }
          }
        }
      }
    } # foreach $line
  } elsif ($vcs eq 'HG') {
    my $sourceurl = 'http://hg.services.openoffice.org/cws/'.$tree;
    # tag is a tag - no changes possible without messing with .hgtags - thus return ...
    return 0 if ($tree =~ m/^[A-Z]+[0-9]+_m[0-9]+$/);
    my $sep = ';;del;;';
    my $record_sep = 'delimiter\ndelimiter';
    my $old_id = 0;
    $old_id = $METADATA{$tree}{'last_id'} if defined($METADATA{$tree}{'last_id'});

    # force update of hg-id to accelerate update of next diff, no matter whether there are checkins or not
    $num_updates++ if("$old_id" eq "0");
    # date|hgdate|user → only unixtimestamp, no timezone offset
    # using seperate file_* directives is slower than just using files, but since it's local...
    my $template = "'{node|short}".$sep.'{date|hgdate|user}'.$sep.'{author|user}'.$sep.'{desc|escape|addbreaks}'.$sep.'{file_adds}'.$sep.'{file_dels}'.$sep.'{file_mods}'.$record_sep."'";
    my $hg_cmd = 'hg';
    my $hgrepodir = '/var/mercurial/DEV300-repo';
    # get current id of cws with hg id....
    my $current_id = `$hg_cmd id $sourceurl`;
    chomp $current_id;
    #untaint
    $current_id =~ m/^(.*)$/;
    $current_id = $1;
    #print "Got id for tree $sourceurl: $current_id - old_id: $old_id -databse..last_ID: $METADATA{$tree}{'last_id'} \n";
    return 0 if ($current_id eq $old_id || $current_id eq ""); # no changes/no success in retreiving info
    # pull the changes into local repo with hg pull
    unless (system("$hg_cmd --cwd $hgrepodir pull -q $sourceurl") == 0 ) {
      print "pulling from $sourceurl failed!\n";
      return 0;
    }
    # for debugging - refetch all the history-data
    #my $last_svn_data =  $main::TIME - $TinderDB::TRIM_SECONDS; # dont get full log, stop at earliest_time
    #print "getting log with: $hg_cmd --cwd $hgrepodir log --follow -P $old_id -r $current_id:$old_id -d \">$last_svn_data 0\" --template $template\n";
    my $raw_changes = `$hg_cmd --cwd $hgrepodir log --follow -P $old_id -r $current_id:$old_id -d ">$last_svn_data 0" --template $template`;
    my @changes = split(/$record_sep/, $raw_changes);
    # get log with template, purge old version, from id to old version
    # done :-)
    foreach my $changeset (@changes) {
      chomp $changeset;
      my ($node, $time, $author, $comment, $sfile_adds, $sfile_dels, $sfile_mods) = split(/$sep/, $changeset, 7);
      my @file_adds = split(/ /,$sfile_adds);
      my @file_dels = split(/ /,$sfile_dels);
      my @file_mods = split(/ /,$sfile_mods);
      $DATABASE{$tree}{$time}{'changeset'}{$node}{'author'}    = $author;
      $DATABASE{$tree}{$time}{'changeset'}{$node}{'comment'}   = $comment;
      #print "changeset $node, time $time, author $author comment $comment files modified: ".join("::",@file_mods)."\n";
      @{$DATABASE{$tree}{$time}{'changeset'}{$node}{'file_adds'}} = @file_adds if (@file_adds);
      @{$DATABASE{$tree}{$time}{'changeset'}{$node}{'file_dels'}} = @file_dels if (@file_dels);
      @{$DATABASE{$tree}{$time}{'changeset'}{$node}{'file_mods'}} = @file_mods if (@file_mods);
      $num_updates++;
    }
    $METADATA{$tree}{'last_id'}=$current_id;
    #$num_updates=1; # avoid returning without saving
  } else {
    # neither tracked in svn, nor in hg - sorry for cvs...
    return 0;
  }

  ($num_updates) || return 0;

  $METADATA{$tree}{'updates_since_trim'} += $num_updates;

  if ( ($METADATA{$tree}{'updates_since_trim'} >
      $TinderDB::MAX_UPDATES_SINCE_TRIM) ) {
    $METADATA{$tree}{'updates_since_trim'}=0;
    $self->trim_db_history($tree);
  }

  $self->savetree_db($tree);

  # VCDisplay needs to know the filename that we write to, so that the
  # None.pm can reference this file.  However VC display is called by
  # Build, Time as well as this VC column.  So all the VC implementations
  # must store their data into a file with the same name.

  my $all_vc_data;
  if ($vcs eq 'SVN') {
    $all_vc_data = $self->get_all_svn_data($tree);
  } else {
    $all_vc_data = $self->get_all_hg_data($tree);
  }

  my ($outfile)   = (FileStructure::get_filename($tree, 'tree_HTML')."/all_vc.html");

  main::overwrite_file($outfile, $all_vc_data);

  return $num_updates;
}

sub status_table_legend {
  my ($out)='';

  # print all the possible tree states in a cell with the color
  $out .= "\t<td align=right valign=top>\n";
  $out .= "\t<table $TinderDB::LEGEND_BORDER>\n";
  
  $out .= ("\t\t<thead><tr><td align=center>".
           "$VC_NAME Cell Colors".
           "</td></tr></thead>\n");

  foreach $state (TreeData::get_all_sorted_tree_states()) {
    my ($cell_color) = TreeData::TreeState2color($state);
    my ($char) = TreeData::TreeState2char($state);
    my ($description) = TreeData::TreeStates2descriptions($state);

    $description = "$state: $description";

    my $text_browser_color_string = HTMLPopUp::text_browser_color_string($cell_color, $char);

    $description = ($text_browser_color_string.
                    $description.
                    $text_browser_color_string.
                    "");
    
    $out .= ("\t\t<tr bgcolor=\"$cell_color\">".
             "<td>$description</td></tr>\n");
  }

  $out .= "\t</table>\n";
  $out .= "\t</td>\n";

  return ($out);  
}

sub notice_association {
  # where can people attach notices to?
  # Really this is the names the columns produced by this DB

    return $VC_NAME;
}

sub status_table_header {
  return ("\t<th>$VC_NAME</th>\n");
}

sub status_table_start {
  # clear data structures in preparation for printing a new table

  my ($self, $row_times, $tree, ) = @_;

  # create an ordered list of all times which any data is stored

  # sort numerically descending
  @DB_TIMES = sort {$b <=> $a} keys %{ $DATABASE{$tree} };

  # adjust the $NEXT_DB to skip data which came after the first cell
  # at the top of the page.  We make the first cell bigger than the
  # rest to allow for some overlap between pages.

  my ($first_cell_seconds) = 2*($row_times->[0] - $row_times->[1]);
  my ($earliest_data) = $row_times->[0] + $first_cell_seconds;

  $NEXT_DB = 0;
  while ( ($DB_TIMES[$NEXT_DB] > $earliest_data) &&    
          ($NEXT_DB < $#DB_TIMES) ) {
    $NEXT_DB++
  }

  $LAST_TREESTATE = '';

  return ;  
}

sub status_table_row {
  my ($self, $row_times, $row_index, $tree, ) = @_;

  my (@outrow) = ();

  # we assume that tree states only change rarely so there are very
  # few cells which have more than one state associated with them.
  # It does not matter what we do with those cells.

  # find all the authors who changed code at any point in this cell
  # find the tree state for this cell.

  my (@authors) = ();
  my (@changesets) = ();
  my $checkin_page_reference;

  while (1) {
    my ($time) = $DB_TIMES[$NEXT_DB];

    # find the DB entries which are needed for this cell
    ($time < $row_times->[$row_index]) && last;

    $NEXT_DB++;

    if (defined($DATABASE{$tree}{$time}{'treestate'})) {
      $LAST_TREESTATE = $DATABASE{$tree}{$time}{'treestate'};
    }

    next unless (defined($TreeData::VC_TREE{$tree}{'VCS'}));

    if (($TreeData::VC_TREE{$tree}{'VCS'} eq 'SVN') && defined($DATABASE{$tree}{$time}{'author'})) {
      push @authors,  (keys %{ $DATABASE{$tree}{$time}{'author'} });
      if (!(defined($checkin_page_reference))) {
        $checkin_page_reference = $time;
      }
    } elsif (($TreeData::VC_TREE{$tree}{'VCS'} eq 'HG') && defined($DATABASE{$tree}{$time}{'changeset'})) {
      push @changesets,  (keys %{ $DATABASE{$tree}{$time}{'changeset'} });
      if (!(defined($checkin_page_reference))) {
        $checkin_page_reference = $time;
      }
    } else {
      # nothing - not SVN, nor HG
    }

  } # while (1)

  @authors = main::uniq(@authors);

  # If there is no treestate, then the tree state has not changed
  # since an early time.  The earliest time was assigned a state in
  # apply_db_updates().  It is possible that there are no treestates at
  # all this should not prevent the VC column from being rendered.

  if (!($LAST_TREESTATE)) {
      $LAST_TREESTATE = $TinderHeader::HEADER2DEFAULT_HTML{'TreeState'};
  }

  my ($cell_color) = TreeData::TreeState2color($LAST_TREESTATE);
  my ($char) = TreeData::TreeState2char($LAST_TREESTATE);

  my $cell_options = '';
  my $text_browser_color_string;
  my $empty_cell_contents = $HTMLPopUp::EMPTY_TABLE_CELL;

  if ( ($LAST_TREESTATE) && ($cell_color) ) {
    my ($cell_options) = "bgcolor=$cell_color ";

    $text_browser_color_string = 
    HTMLPopUp::text_browser_color_string($cell_color, $char);

    # for those who like empty cells to be truly empty, we need to
    # be sure that they see the different cell colors when they
    # change.

    if (
      ($cell_color !~ m/white/) &&
      (!($text_browser_color_string)) &&
      (!($empty_cell_contents)) &&
      1) {
      $empty_cell_contents = "&nbsp;";
    }
  }

  my ($query_links) = '';

  $query_links.=  "\t\t".$text_browser_color_string."\n";
  
  #common part
  my ($mindate,$maxdate,$time_interval_str,$vc_info);
  if ( scalar(@authors) || scalar(@changesets) ) {
    # find the times which bound the cell so that we can set up a
    # VC query.
    $mindate = $row_times->[$row_index];

    if ($row_index > 0){
      $maxdate = $row_times->[$row_index - 1];
    } else {
      $maxdate = $main::TIME;
    }

    my ($format_maxdate) = HTMLPopUp::timeHTML($maxdate);
    my ($format_mindate) = HTMLPopUp::timeHTML($mindate);
    $time_interval_str = "$format_maxdate to $format_mindate";

    foreach $key ('module',) {
      my ($value) = $TreeData::VC_TREE{$tree}{$key};
      $vc_info .= "$key: $value <br>\n";
    }

    # I wish we could give only the information for a particular
    # branch, since we can not document that this is for all branches
    $vc_info .= "branch: all <br>\n";
  }
  if ( scalar(@authors) ) {
    foreach $author (@authors) {
      # This is a Netscape.com/Mozilla.org specific CVS/Bonsai
      # issue. Most users do not have '%' in their CVS names. Do
      # not display the full mail address in the status column,
      # it takes up too much space.
      # Keep only the user name.

      my $display_author=$author;
      $display_author =~ s/\%.*//;

      my $mailto_author=$author;
      $mailto_author = TreeData::VCName2MailAddress($author);

      # The Link Choices inside the popup.

      my $link_choices = "Checkins by <b>$author</b><br>";
      $link_choices .= " for $vc_info \n<br>";
      $link_choices .= VCDisplay::query('tree' => $tree,
                                        'mindate' => $mindate,
                                        'maxdate' => $maxdate,
                                        'who' => $author,
                                        "linktxt" => "This check-in",
                                       );

      $link_choices .= "<br>";
#     $link_choices .= 
#         VCDisplay::query(
#                          'tree' => $tree,
#                          'mindate' => $mindate - $main::SECONDS_PER_DAY,
#                          'maxdate' => $maxdate,
#                          'who' => $author,
#
#                          "linktxt" => "Check-ins within 24 hours",
#                          );
#
#     $link_choices .= "<br>";
#     $link_choices .= 
#           VCDisplay::query(
#                            'tree' => $tree,
#                            'mindate' => $mindate - $main::SECONDS_PER_WEEK,
#                            'maxdate' => $maxdate,
#                            'who' => $author,
#
#                            "linktxt" => "Check-ins within 7 days",
#                            );
#
#     $link_choices .= "<br>";

      $link_choices .= HTMLPopUp::Link("href" => "mailto:$mailto_author",
                                       "linktxt" => "Send Mail to $author",
                                      );

      $link_choices .= "<br>";

      my ($href) = (FileStructure::get_filename($tree, 'tree_URL').
                    "/all_vc.html#$checkin_page_reference");

      $link_choices .= HTMLPopUp::Link("href" => $href,
                                       "linktxt" => "Tinderbox Checkin Data",
                                      );

      $link_choices .= "<br>";

      my (%popup_args) = ("windowtxt" => $link_choices,
                          "windowtitle" => ("$VC_NAME Info ".
                                            "Author: $author ".
                                            "$time_interval_str "),
                         );

      my ($query_link) = "";

      $query_link .= VCDisplay::query('tree' => $tree,
                                      'mindate' => $mindate,
                                      'maxdate' => $maxdate,
                                      'who' => $author,
                                      "linktxt" => "\t\t<tt>$display_author</tt>",
                                      %popup_args,
                                     );

      # put each link on its own line and add good comments so we
      # can debug the HTML.

      my ($date_str) = localtime($mindate)."-".localtime($maxdate);

      if ($DEBUG) {
          $query_links .= ("\t\t<!-- VC_SVN: ".
                           ("Author: $author, ".
                            "Time: '$date_str', ".
                            "Tree: $tree, ".
                            "").
                           "  -->\n".
                           "");
      }

      $query_links .= "\t\t".$query_link."\n";
    } # foreach %author

    my $notice = $NOTICE->Notice_Link($maxdate,
                                      $tree,
                                      $VC_NAME,
                                      );
    if ($notice) {
      $query_links.= "\t\t".$notice."\n";
    }

    $query_links.=  "\t\t".$text_browser_color_string."\n";

    @outrow = ("\t<td align=center $cell_color>\n".
               $query_links.
               "\t</td>\n".
               "");
  } elsif (scalar(@changesets)) {
    foreach my $changeset (@changesets) {
      my $author = $DATABASE{$tree}{$checkin_page_reference}{'changeset'}{$changeset}{'author'};
      my $display_author=$author;
      #$display_author =~ s/\%.*//;

      my $mailto_author=$author;
      $mailto_author = TreeData::VCName2MailAddress($author);

      # The Link Choices inside the popup.

      my $link_choices = "Checkins by <b>$author</b><br>";
      $link_choices .= " for $vc_info \n<br>";
      $link_choices .= VCDisplay::query('tree' => $tree,
                                        'mindate' => $mindate,
                                        'maxdate' => $maxdate,
                                        'who' => $author,
                                        "linktxt" => "This check-in",
                                       );

      $link_choices .= "<br>";
#        $link_choices .= 
#            VCDisplay::query(
#                             'tree' => $tree,
#                             'mindate' => $mindate - $main::SECONDS_PER_DAY,
#                             'maxdate' => $maxdate,
#                             'who' => $author,
#
#                             "linktxt" => "Check-ins within 24 hours",
#                             );
#
#        $link_choices .= "<br>";
#        $link_choices .= 
#              VCDisplay::query(
#                               'tree' => $tree,
#                               'mindate' => $mindate - $main::SECONDS_PER_WEEK,
#                               'maxdate' => $maxdate,
#                               'who' => $author,
#
#                               "linktxt" => "Check-ins within 7 days",
#                               );
#
#        $link_choices .= "<br>";

      $link_choices .= HTMLPopUp::Link("href" => "mailto:$mailto_author",
                                       "linktxt" => "Send Mail to $author",
                                      );

      $link_choices .= "<br>";

      my ($href) = (FileStructure::get_filename($tree, 'tree_URL').
                    "/all_vc.html#$checkin_page_reference");

      $link_choices .= HTMLPopUp::Link("href" => $href,
                                       "linktxt" => "Tinderbox Checkin Data",
                                      );

      $link_choices .= "<br>";

      my (%popup_args) = ("windowtxt" => $link_choices,
                          "windowtitle" => ("$VC_NAME Info ".
                                            "Author: $author ".
                                            "$time_interval_str "),
                         );

      my ($query_link) = "";

      $query_link .= VCDisplay::query('tree' => $tree,
                                      'mindate' => $mindate,
                                      'maxdate' => $maxdate,
                                      'who' => $author,
                                      "linktxt" => "<tt>$display_author</tt>",
                                      %popup_args,
                                     );

      # put each link on its own line and add good comments so we
      # can debug the HTML.

      my ($date_str) = localtime($mindate)."-".localtime($maxdate);

      if ($DEBUG) {
          $query_links .= ("\t\t<!-- VC_SVN: ".
                           ("Author: $author, ".
                            "Time: '$date_str', ".
                            "Tree: $tree, ".
                            "").
                           "  -->\n".
                           "");
      }

      $query_links .= "\t\t".$query_link."\n";
    } # foreach %author

    my $notice = $NOTICE->Notice_Link($maxdate,
                                      $tree,
                                      $VC_NAME,
                                      );
    if ($notice) {
      $query_links.= "\t\t".$notice."\n";
    }

    $query_links.=  "\t\t".$text_browser_color_string."\n";

    @outrow = ("\t<td align=center $cell_color>\n".
               $query_links.
               "\t</td>\n".
               "");
  } else {
    @outrow = ("\t<!-- skipping: VC_Bonsai: tree: $tree -->".
               "<td align=center $cell_options>$empty_cell_contents</td>\n");
  }

  return @outrow; 
}

1;

