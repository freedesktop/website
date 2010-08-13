#!/bin/bash

# when procmail queues are run directly, i.e. invoked via postfix, the generate
# files can be 50MB at most. This is not enough for the intermediate files
# generated during processing of the tinderbox logs. The Error-Logs can easily
# grow larger than that, causing the processing to fail.
# This script uses the same procmail queues, but outside postfix, and thus
# without the file-size limit


ORIGMAIL=$HOME/Maildir/tinderbox/inbox
WORKMAIL=$HOME/Maildir/tinderbox/work
MAILLOCKFILE=$HOME/Maildir/tinderbox.lock
# guarded against multiple runs via crontab-locks, but being safe doesn't hurt
cd $HOME 
if lockfile -r0 -l1800 $WORKMAIL.lock ; then
	trap "rm -f $WORKMAIL.lock" 1 2 3 13 15
	# first, move the mbox away, to not disturb further mail-delivery
	if test -s $ORIGMAIL && lockfile -r5 -l1024 $MAILLOCKFILE ; then
		#echo "Mark: $(date -u)" 1>&2
		# cat instead of mv just in case the script gets killed before processing
		cat $ORIGMAIL >> $WORKMAIL && cat /dev/null > $ORIGMAIL
		# release the lock so new mail can be delivered to ORIGMAIL
		rm -f "$MAILLOCKFILE"
		# error-handling is done by the procmail-rules
		formail -s procmail < $WORKMAIL
		rm -f "$WORKMAIL"
	fi
	rm -f $WORKMAIL.lock
fi
exit 0

