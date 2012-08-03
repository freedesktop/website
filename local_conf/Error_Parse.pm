# -*- Mode: perl; indent-tabs-mode: nil -*-

# Error_Parse.pm - Used by processmail to turn the build logs into
# HTML.  Contains the parsing functions for highlighting the build
# errors and creating links into the source code where the errors
# occurred.

# $Revision: 1.18 $ 
# $Date: 2004/07/12 01:01:53 $ 
# $Author: kestes%walrus.com $ 
# $Source: /cvsroot/mozilla/webtools/tinderbox2/src/default_conf/Error_Parse.pm,v $ 
# $Name:  $ 


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

# complete rewrite by Ken Estes for contact info see the
#     mozilla/webtools/tinderbox2/Contact file.
# Contributor(s): 




package Error_Parse;
use utf8;
binmode STDIN, ':encoding(utf8)';
binmode STDOUT, ':encoding(utf8)';

# This package must not use any tinderbox specific libraries.  It is
# intended to be a base class.

$VERSION = '#tinder_version#';

# the rest of the code does not depend on knowing the different
# line_types. We may need to add new types like:
#   'warning_style', 'warning_fix_required', 
#   'error_test', 'error_test_performance'

# These new types would be useful for the "build warnings page" since
# not every warning may be considered interesting by QA.  Allowing a
# flexible error type will allow QA to define types of warnigns of
# interest and other warnings may only be interesting during
# particular types of builds.

# If new types are added try and keep to a small set of colors or the
# display will get confusing.  You may find it convenient to keep a
# distinction between different kinds of warnings or different kinds
# of tests but all warnings and all tests get the same color.


# Be careful when changing the function line_type.  An improperly
# tuned version can take up 50% (as shown by perl -d:DProf ) of the
# execution time.

%ERRORTYPE = (
               'error' => {
                            'html_color'=> "red",
                            'handler'=> \&main::null,
                          },              
               'warning' => {
                             'html_color'=> "maroon",
                             'handler'=> \&main::null,
                             },
               'info' => {
                          'html_color'=> "black",
                          'handler'=> \&main::null,
                          },
               );

# This block adjusts how we format the error logs, perhaps it belongs
# in another file and not the error_parse file.  Processmail is a
# candidate.
{

# window of context arround error message,  for summary log
# created by Error_Parse.pm and processmail

$LINES_AFTER_ERROR = 5;

$LINES_BEFORE_ERROR = 30;

# number of characters width the line number gets in HTML pages
# (mostly the build log pages)

$LINENO_COLUMN = 6;

}

sub type2color {
    my ($type) = @_;
    $out = $ERRORTYPE{$type}{'html_color'};
    return $out;
}

# run the handler associated with the status given as input.

sub run_status_handler {
  my (%args) = @_;

  my ($line_type) = $args{'line_type'};

  # run status dependent hook.
  &{$ERRORTYPE{$line_type}{'handler'}}(%args);

  # notice handlers never return any values.

  return ;
}


package Error_Parse::unix;


sub line_type {
  my ($line) = @_;

  my $error = (

            ($line =~ /\sORA-\d/)		||		# Oracle
            ($line =~ /\bNo such file or directory\b/)	||
            ($line =~ /\b[Uu]nable to\b/)	||		
            ($line =~ /\bnot found\b/)		||		# shell path
            ($line =~ /\b[Dd]oes not\b/)	||		# javac error
            ($line =~ /\b[Cc]ould not\b/)	||		# javac error
            ($line =~ /\b[Cc]an\'t\b/)		||		# javac error
            ($line =~ /\b[Cc]an not\b/)		||		# javac error
            ($line =~ /\b\[javac\]\b/)		||		# javac error
            # Remember: some source files are called $prefix/error.suffix
            ($line =~ /\bDied\b/)		||		# Perl error
            ($line =~ /\b(?<!\/)[Ee]rror(?!\.)\b/)||		# C make error
            ($line =~ /\b[Ff]atal\b/)		||		# link error
            ($line =~ /\b[Ee]xception\b/)	||		# javac error
# This is something that should get fixed - move to warnings ...
#            ($line =~ /\b[Dd]eprecated\b/)	||		# java error
            ($line =~ /\b[Aa]ssertion\b/)	||		# test error
            ($line =~ /\b[Aa]borted\b/)		||		# cvs error
            ($line =~ /\b[Ff]ailed\b/)		||		# java nmake
            ($line =~ /BUILD FAILED/)		||		# ant

            ($line =~ /Unknown host /)		||		# cvs error
            ($line =~ /\: cannot find module/)	||		# cvs error
            ($line =~ /\^C /)			||		# cvs merge conflict
            ($line =~ /No such file or directory/)	 ||	# cpp error
            ($line =~ /jmake.MakerFailedException:/) ||         # Java error
            ($line =~ /  Warning:/)                  ||         # dmake warning
            ($line =~ /  Error:/)                    ||         # dmake error
            ($line =~ /\*\*\* No rule to make target/) ||       # make error (no rule or failed to build)
            ($line =~ /^cc1plus: warnings being treated as errors/) || 
            0);


  if ($error) {
      my  $ignore = (

                     # These might be something worth looking at, but
                     # there are so many messages we might as well
                     # ignore them until the developers are willing to
                     # work on removing them.

                     # note that the word inline was followed by a
                     # quote mark which emacs thought was a bit funny
                     # so I removed it.

                     ($line =~ m/warning: ANSI does not permit the keyword `inline/) ||
                     ($line =~ m/warning: ISO C does not permit named variadic macros/) ||
                     ($line =~ m/warning: operator new should throw an exception, not return NULL/) ||
                     ($line =~ m/zip warning: .* not found or empty/) ||

                     ($line =~ m/Status token, FAILED, not found/) ||

                     # This is a MSVC warning that includes "does not"
                     ($line =~ m/ C4263:/) ||

                     # note that the word widget was followed by a
                     # quote mark which emacs thought was a bit funny
                     # so I removed it.

                     ($line =~ m/does not intersect the widget.s view/) ||

 		     # these are files which look like error messages

                     ($line =~ m![\/\-\.]error[\/\-\.]!) ||
                     ($line =~ m/-failed\.gif/) ||
                     ($line =~ m/-deprecated\.h/) ||

                     # See: http://homepages.muenchen.org/bm617259/tinderbox/
                     ($line =~ m/^checking exception type/) ||
                     ($line =~ m/color components does mot/) ||
                     ($line =~ m/^checking for a sed that does not truncate output/) ||
                     ($line =~ m/ .exception. :/) ||
                     ($line =~ m/ throw an exception but /) ||
                     ($line =~ m/ precedence for possible error/) ||
                     ($line =~ m/ if initialization throws an exception/) ||
                     ($line =~ m/ C\+\+ exception handler used/) ||
                     ($line =~ m/RuntimeException/) ||
                     ($line =~ m/exception\.(hpp|htm|html|cpp)/) ||
                     ($line =~ m/deprecated-list\.html/) ||
                     ($line =~ m#/(stlport|inc/stl)/exception#) ||
                     ($line =~ m#Exception\.(idl|hdl|cpp|cxx|hpp|o|h|class)#) ||
                     
                     ($line =~ m/^If this does not correspond to your system or settings please remove the file/) ||
                     ($line =~ m#^find.*/usr/lib/debug: No such file or directory$#) ||
                     ($line =~ m/^Warning: Can.t check separators used in FormatCode due to LC_CTYPE ref=.(es_ES|zh_TW|zh_CN)./) ||
                      #07-02-07
                     ($line =~ m/^xmlrole.c: In (f|F)un(c|K)tion .error./) ||
                     ($line =~ m#^find:.*openoffice.org-freedesktop-menus.*/usr/lib: No such file or directory#) ||
                     ($line =~ m/^This version of java does not support the classic compiler; upgrading to modern/) ||

                     #07-05-10
                     #errors while building nas on mac, irrelevant, since nas works anyway
                     #we're not interested in the sample-progs...
                     ($line =~ m/^mv: rename libaudio.2.3.dylib~ to libaudio.2.3.dylib: No such file or directory/) ||
                     # the same with gnu fileutils
                     ($line =~ m/^mv: cannot stat `libaudio.2.3.dylib~': No such file or directory/) ||
                     ($line =~ m/^make\[[0-9]\]: \*\*\* \[libaudio.2.3.dylib\] Error 1/) ||
                     ($line =~ m/^Graph.c:36:22: error: values.h: No such file or directory/) ||
                     ($line =~ m/^Graph.c:(336|405): error: 'MAXSHORT' undeclared \(first use in this function\)/) ||

                     ($line =~ m/^Graph.c:336: error: \(Each undeclared identifier is reported only once/) ||
                     ($line =~ m/^Graph.c:336: error: for each function it appears in.\)/) ||
                     ($line =~ m/^make\[[0-9]\]: \*\*\* \[Graph.o\] Error 1/) ||

                     ($line =~ m/^ne_request.c: In function 'aborted':/) ||

                     #07-07-04
                     #Silence cygwin only dmake warning

                     #ignore dmake warnings about extra unknown processes
                     #Happens only with cygwin dmakes
                     ($line =~ m/is not in pq/) ||
		     #07-08-13
		     #Silence saxparser warnings
		     ($line =~ m/QuotationStart equals /) ||
		     ($line =~ m/QuotationEnd are both ASCII characters/) ||

		     #07-09-12
		     #x86_64 "errors" with gij (more than 700, so obfuscating everything else)
		     ($line =~ m/The serializable class [^ ]* does not declare a static final serialVersionUID/) || # ...field of type long (line is wrapped a couple of times...
		     ($line =~ m/class [^ ]* extends (Exception|Error)/) ||

		     ($line =~ m/dmake:  Warning: -- Found file corresponding to virtual target \[[^\]]*\]./) ||

		     #08-01-03
		     ($line =~ m/checking for --hash-style=both linker support ... not found/) ||
		     ($line =~ m/configure: WARNING: Internal freetype2 does not support emboldening./) ||
		     ($line =~ m#/o3/lx_ia32/glibc-pc-linux-gnu/include/stdlib.h:486: warning: ISO C90 does not support 'long long'#) ||
		     ($line =~ m#^\s*import com.sun.star.uno.Exception;#) ||
		     #10-04-08
		     ($line =~ m#^COPY:.*(/inc/boost/exception/.*\.hpp) -> .*\1#) ||
		     ($line =~ m#^checking dynamic linker characteristics\.\.\. cat: /etc/ld\.so\.conf\.d/\*\.conf: No such file or directory#) ||
		     ($line =~ m#^checking for shared library run path origin\.\.\. /bin/sh: \./config\.rpath: No such file or directory#) ||
		     ($line =~ m#^\s*\[echo\]\s*Clover not found\. Code coverage reports disabled\.#) ||
		     ($line =~ m#^pk11merge\.c:[0-9]+:.*error. may be used uninitialized in this function#) ||
		     # python-build related
		     ($line =~ m#^Failed to find the necessary bits to build these modules:#) ||
		     ($line =~ m#^INFO: Can't locate Tcl/Tk libs and/or headers#) ||
		     # apache-commons related
		     ($line =~ m#^\s*\[echo\]\s*Log4j 1\.2 not found: Cannot Build Log4JLogger#) ||
		     ($line =~ m#^\s*\[echo\]\s*LogKit not found: Cannot Build LogKitLogger#) ||
		     ($line =~ m#^\s*\[echo\]\s*Avalon-Framework not found: Cannot Build AvalonLogger#) ||
		     # some more filenames that cause a false trigger
		     ($line =~ m#^boost_1_39_0/(boost(/tr1/tr1(/sun)?)?|libs(/unordered/test)?)/exception(\.|/)?#) ||
		     ($line =~ m#^boost_1_44_0/(boost(/tr1/tr1(/sun)?)?|libs(/unordered/test)?)/exception(\.|/)?#) ||
		     ($line =~ m#^commons-lang-2\.3-src/src/(java|test)/org/apache/commons/lang/exception/#) ||
		     ($line =~ m#^commons-httpclient-3\.1/docs/exception-handling\.html#) ||
		     # annoying configure messages
		     ($line =~ m#^checking (if|whether).*/bin/rm: cannot remove `conftest\*´: No such file or directory$#) ||
		     ($line =~ m#^checking for -Bsymbolic-functions linker support \.\.\. not found#) ||
		     # cppunit
		     ($line =~ m#^  CXX    Exception.lo#) ||
		     # gettext related
		     ($line =~ m#^checking where term(info|cap) library functions come from\.\.\. not found, consider installing GNU ncurses#) ||
		     ($line =~ m#^  CC     (error-progname|fatal-signal).lo#) ||
		     ($line =~ m#^  CCLD   (gdbus-)?error#) ||
		     # libgsf related
		     ($line =~ m#^configure: WARNING: thumbnailer will not be built, unable to find gconftool-2#) ||
		     # rules in instsetoo_native/util/makefile.mk
		     ($line =~ m#^dmake:  makefile\.mk:  line (222|277):  Warning: -- Prior to dmake 4\.5 only one#) ||
		     # odk - subclass copying where no subclass exists
		     ($line =~ m#^cp: .*/class/com/sun/star/lib/loader/WinRegKey(Exception)?\$\*\.class'?: No such file or directory#) ||
		     # gbuildified modules - filenames
		     ($line =~ m#^\[ build IDL \] udkapi/com/sun/star/uno/Exception\.urd#) ||
		     # gentoo-box
		     ($line =~ m#^checking dynamic linker characteristics\.\.\. cat: ld\.so\.conf\.d/\*\.conf: No such file or directory#) ||
		     ($line =~ m#^((\.\./)?\.)?\./libtool: line [0-9]+: cd: \.\./lib: No such file or directory#) ||
		     # SuSE box
		     ($line =~ m#\.\./\.\./dist/include/xpcom_obsolete/nsFileStream\.h: In member function 'PRBool nsErrorProne::failed\(\) const':$#) ||
		     # system-libs
		     ($line =~ m#^Therefore the version provided here does not need to be built in addition\.#) ||
		     
                     0);
      
      if ($ignore) {
          undef $error;
      }
  }

  if ($error) {
    return('error');
  }
  
  my $warning = (

              ($line =~ m/^[-._\/A-Za-z0-9]+\.[A-Za-z0-9]+\:[0-9]+\:/) ||
              ($line =~ m/^\"[-._\/A-Za-z0-9]+\.[A-Za-z0-9]+\"\, line [0-9]+\:/) ||

              ($line =~ m/\b[Ww]arning\b/) ||
              ($line =~ m/not implemented:/) ||
# Used to be an error ...
              ($line =~ /\b[Dd]eprecated\b/) ||

              0);

  if ($warning) {
    return('warning');
  }
  
  return('info');
}


sub parse_errorline {
    local( $line ) = @_;

    if( $line =~ /^(([A-Za-z0-9_]+\.[A-Za-z0-9]+)\:([0-9]+)\:)/ ){
      my ($error_msg) = $1;
      my ($error_file_ref) = $2;
      my ($error_line) = $3;
      return ($error_file_ref, $error_line);
    }
    if ( $line =~ /^(\"([A-Za-z0-9_]+\.[A-Za-z0-9]+)\"\, line ([0-9]+)\:)/  ){
      my ($error_msg) = $1;
      my ($error_file_ref) = $2;
      my ($error_line) = $3;
        return ($error_file_ref, $error_line);
    }
    return undef;
}

package Error_Parse::windows;

sub line_type {
  my ($line) = @_;

  my  $error = (

            ($line =~ /\b[Ee]rror\b/)		||		# C make error
            ($line =~ /\b[Ff]atal\b/)		||		# link error
            ($line =~ /\b[Aa]ssertion\b/)	||		# test error
            ($line =~ /\b[Aa]borted\b/)		||		# cvs error
            ($line =~ /\b[Ff]ailed\b/)		||		# java nmake

            ($line =~ /Unknown host /)		||		# cvs error
            ($line =~ /\: cannot find module/)	||		# cvs error
            ($line =~ /\^C /)			||		# cvs merge conflict
            ($line =~ /Couldn\'t find project file /) ||	# CW project error
            ($line =~ /Creating new precompiled header/) ||	# Wastes time.
            ($line =~ /No such file or directory/) ||		# cpp error
            ($line =~ /jmake.MakerFailedException:/) ||         # Java error

    0);

  if ($error) {
      my  $ignore = (

 		     # these are files which look like error messages

                     ($line =~ m![\/\-\.]error[\/\-\.]!) ||
                     ($line =~ m/-failed\.gif/) ||
                     ($line =~ m/-deprecated\.h/) ||

                     0);
      
      if ($ignore) {
          undef $error;
      }
  }

  if ($error) {
    return('error');
  }
  
  my  $warning = (
              ($line =~ m/^[-._\/A-Za-z0-9]+\.[A-Za-z0-9]+\:[0-9]+\:/) ||
              ($line =~ m/^\"[-._\/A-Za-z0-9]+\.[A-Za-z0-9]+\"\, line [0-9]+\:/) ||
              ($line =~ m/\bwarning\b/) ||
              ($line =~ m/not implemented:/) ||
              0);

  if ($warning) {
    return('warning');
  }

  return('info');
}



sub parse_errorline {
    local( $line ) = @_;

    if( $line =~ m@(ns([\\/][a-z0-9\._]+)*)@i ){
      my $error_file = $1;
      my $error_file_ref = lc $error_file;
      $error_file_ref =~ s@\\@/@g;
      
      $line =~ m/\(([0-9]+)\)/;
      my $error_line = $1;
      return ($error_file_ref, $error_line);
    }

    if( $line =~ m@(^([A-Za-z0-9_]+\.[A-Za-z])+\(([0-9]+)\))@ ){
      my $error_file = $1;
      my $error_file_ref = lc $2;
      my $error_line = $3;
      $error_file_ref =~ s@\\@/@g;
      return ($error_file_ref, $error_line);
    }

    return ;
}


package Error_Parse::mac;



sub line_type {
  my ($line) = @_;

  my  $error = (
            ($line =~ /\b[Ee]rror\b/)		||		# C make error
            ($line =~ /\b[Ff]atal\b/)		||		# link error
            ($line =~ /\b[Aa]ssertion\b/)	||		# test error
            ($line =~ /\b[Aa]borted\b/)		||		# cvs error
            ($line =~ /\b[Ff]ailed\b/)		||		# java nmake
            ($line =~ /\bDied\b/)		||		# Perl error

            ($line =~ /Unknown host /)		||		# cvs error
            ($line =~ /\: cannot find module/)	||		# cvs error
            ($line =~ /\^C /)			||		# cvs merge conflict
            ($line =~ /\bCouldn\'t find project file /) ||	# CW project
            ($line =~ /\bCan\'t (create)|(open)|(find) /) ||	# CW project error
    0);

  if ($error) {
      my  $ignore = (

                     ($line =~ m/Warning : cannot find matching deallocation function for/) ||
                     0);
      
      if ($ignore) {
          undef $error;
      }
  }

  ($error) && 
    return('error');
  
  my $warning = (
              ($line =~ m/^[-._\/A-Za-z0-9]+\.[A-Za-z0-9]+\:[0-9]+\:/) ||
              ($line =~ m/^\"[-._\/A-Za-z0-9]+\.[A-Za-z0-9]+\"\, line [0-9]+\:/) ||
              ($line =~ m/warning/i) ||
              ($line =~ m/not implemented:/i) ||
              0);

  ($warning) &&
    return('warning');

  return('info');
}




sub parse_errorline {
    local( $line ) = @_;

    if( $line =~ /^(([A-Za-z0-9_]+\.[A-Za-z0-9]+) line ([0-9]+))/ ){
        my $error_file = $1;
        my $error_file_ref = $2;
        my $error_line = $3;
      return ($error_file_ref, $error_line);
    }
    return ;
}


=head1 NAME

Error_Parse - methods used by showlogs.cgi

=head1 SYNOPSIS

C<require Error_Parse::unix;>

=head1 DESCRIPTION

The methods provided by this package are designed to be used in
conjunction with showlogs.cgi.  This file contains code for parsing
out the error messages of various build tools.  There are different
name spaces for each build type and a set of parsing programs in each
namespace.  Currently build types are the major OS (Unix, Mac,
Windows).  It may be possible in the future to have a single universal
parsing program or alternatly to have build types specify a list of
parsing programs for each tool (compler, make language, script) which
is used in the build process then a build would also need to specify a
list of tools that are used.  This may be necessary as people run unix
compilers on NT and vice versa.


=head1 METHODS

=over 2

=item line_type

returns a string describing if the line has any errors or warnings.
The list of types may grow in the future as some warnings become more
important then others.  The possible return codes are:

	'error'
	'warning'
	'info'


=cut


=item has_errorline

returns undef if the input line does not contains a parsable error.

If the line contains a parsable error it returns the list

	($error_file_ref, $error_line);

where:


$error_file_ref: the file which has the error

$error_line:  the line the error was found on

=head1 AUTHOR

Ken Estes (kestes@staff.mail.com)

=cut

1;

