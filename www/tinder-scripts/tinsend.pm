#!/usr/bin/perl -w

# tinsend.pm - perl module to simplify the submission of
# compressed tinderbox logfiles.
#
# Version 0.4 - 31.05.2006

package tinsend;

use Mail::Sender;

############################################
# Global settings
############################################

$BUILDNAME = 'My BuildName';
$FROMADDRESS = 'myname@here.here';

$SMTPAUTH = '';
$SMTPSERVER = 'smtpserver.without_pw.org';
$SMTPAUTHID = '';
$SMTPAUTHPW = '';

$TINDER_DEST = 'ooo@go-oo.org';

############################################
# Functions
############################################

#-------------------------------------------------------------
# Function name: mailsend
# Description:   Send a mail to the tinderbox server.
# Arguments:     1. Status. Allowed are:
#                   'not_running', 'building',
#                   'build_failed', 'test_failed', 'success'
#                2. Buildtree
#                3. Start time
#                4. Additional text for mailbody
#                5. (optional) If set this is the buildlog to be send
#                   as attachment
# Return value:  Errormessage (if any) from Mail::Sender.
#                Successfull submission returns "".
#-------------------------------------------------------------
sub mailsend {
    my $status = shift;
    my $tree = shift;
    my $starttime = shift;
    my $mailbody = shift;
    my $tinderlog = shift;

    my $err;
    my ( $sender, $sendto, $copys, $subject, $message, $headers, $file );

    my $MAIL_HEADER_MSG = "X-Tinder: cookie";
    my $MAIL_HEADER_ATT = "X-Tinder: gzookie";
    my $MAIL_PREFIX =
	"\n".	# vital header / body separator
	"tinderbox: administrator: $FROMADDRESS\n".
	"tinderbox: builddate: deprecated\n".
	"tinderbox: starttime: $starttime\n".
	"tinderbox: buildname: $BUILDNAME\n".
	"tinderbox: errorparser: unix\n".
	"tinderbox: status: $status\n".
	"tinderbox: timenow: ". time(). "\n".
	"tinderbox: tree: $tree\n".
	"tinderbox: END\n".
	"\n"; # end of tinder header separator

    #print "Mailing '$status'\n";

    # Prepare Mailer
    $sender = new Mail::Sender {smtp => $SMTPSERVER, from => $FROMADDRESS,
				auth => $SMTPAUTH, authid => $SMTPAUTHID,
				authpwd => $SMTPAUTHPW };
    $err = $Mail::Sender::Error;
    if ($err) {
	return $err;
    }	# Terminate on error.

    # Prepare message
    $sendto=$TINDER_DEST;
    $copys="";
    $subject="tinderbox gzipped logfile";
    $message=$MAIL_PREFIX.$mailbody;

    if ( $tinderlog eq "" ) {
	# Send the mail
	print "Sending normal mail!\n";
	$headers=$MAIL_HEADER_MSG;
	$sender->MailMsg({to => $sendto,
			  cc => $copys,
			  subject => $subject,
			  headers => $headers,
			  msg => $message});
    } else {
	# Todo: Error handling if $tinderlog exists
	# and mailprep() succeeds.
	$file = mailprep( $tinderlog, $MAIL_PREFIX );
	# Send mail with gzipped attachment
	print "Sending the mail with $file !\n";
	$headers=$MAIL_HEADER_ATT;
	$sender->MailFile({to => $sendto,
			   cc => $copys,
			   subject => $subject,
			   headers => $headers,
			   msg => $message,
			   file => $file});
    }
    $err = $Mail::Sender::Error;

    return $err;
}

#-------------------------------------------------------------
# Function name: mailprep
# Description:   Create a gzipped file that contains the tinderbox
#                information and the logfile
# Arguments:     1. logfile
#                2. Tinderbox informationBuildtree
# Return value:  new filename
#-------------------------------------------------------------
sub mailprep {
    my $prepfile = shift;
    my $MAIL_PREFIX = shift;

    print "Creating gzipped logfile: $prepfile !\n";
    `echo "$MAIL_PREFIX" > $prepfile.log && cat $prepfile >> $prepfile.log && gzip -f $prepfile.log` ;
    return "$prepfile.log.gz";
}
