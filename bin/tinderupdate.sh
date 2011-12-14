#!/bin/bash

TINDERBOX_BIN=/srv/tinderbox/bin
TINDERBOX_WWW=/srv/www/tinderbox.libreoffice.org
TINDERBOX_LOG=/var/log/tinderbox/tinderbox2.log

cd /srv/tinderbox
# disable cronjob without removing cronjob entry
#exit 0 

echo starting update at   $(date -u) >> $TINDERBOX_LOG
# update the tag-lists
touch $TINDERBOX_WWW/tags/tag-list.tstamp

# parse mails with attachment that accumulated in the meantime
$TINDERBOX_BIN/bypass_postfixlimit.sh >> $TINDERBOX_LOG 2>&1

# regenerate tinderbox-HTML pages
$TINDERBOX_WWW/cgi-bin/tinder.cgi >> $TINDERBOX_LOG 2>&1
echo finished updating at $(date -u) >> $TINDERBOX_LOG
