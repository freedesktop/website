#!/bin/bash

cd $HOME

echo starting update at   $(date -u) >> $HOME/var/log/tinderbox2.log
# update the tag-lists
touch $HOME/tinderbox.go-oo.org/tags/tag-list.tstamp
$HOME/usr/bin/get-taglists.pl
$HOME/usr/bin/get-latest-master.pl

# parse mails with attachment that accumulated in the meantime
$HOME/usr/bin/bypass_postfixlimit.sh >> $HOME/var/log/tinderbox2.log 2>&1

# regenerate tinderbox-HTML pages
$HOME/tinderbox.go-oo.org/tinder.cgi >> $HOME/var/log/tinderbox2.log 2>&1
echo finished updating at $(date -u) >> $HOME/var/log/tinderbox2.log
