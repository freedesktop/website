<?php
require("../template.php");

$content = <<<"EOT"

<h3 id="code">The Code</h3>

<br>
All our source code is hosted in git, which is easy to use:
<br>
<b>Clone:</b> <tt>\$ git clone git://anongit.freedesktop.org/git/libreoffice/build</tt>
# <a href="$freedesktop_cgit">(browse)</a>
<br>
<b>Tarball:</b> <a href="$download_source">$download_source</a>.
<br>

<p>LibreOffice is <a href="http://www.fsf.org/">Free Software</a> -
which gives you key liberties, and responsibilities. LibreOffice
(unless indicated otherwise for any particular file), is licensed
under the <a href="/lgpl">LGPLv3</a>. We intend to make new code
modules available under a dual LGPLv3(or later) / MPL license to
allow the license to be upgraded - there is no requirement to
assign your copyright to anyone in order to get your code contributed
- all contributions are welcome.</p>

<h3 id="building">Building And Running It</h3>

<p>These instructions are primarily focused at a GNU/Linux user.
They are somewhat raw; they will improve rather rapidly over the next
few days. <b>Bootstrap</b> your system by installing all the packages
required to build your distribution's openoffice package. The easiest
way to do this is something like this:</p>
<code>sudo apt-get build-dep openoffice.org # Debian &amp; derivatives</code><br>
<code>sudo zypper si -d OpenOffice_org-bootstrap # for OpenSUSE</code><br>
<code>sudo yum-builddep openoffice.org # for Fedora &amp; derivatives</code><br>
<br>
<p>Then to download the full source and <b>build</b>:</p>

<code>./autogen.sh --with-git --with-num-cpus=2</code><br>
<code>./download</code><br>
<code>make</code><br>
<code>bin/ooinstall -l &lt;<i>/path/to/scratch/dir/</i>&gt;</code><br>
<br>
<p>If you have problems with the build - don't be put off, get in touch
with us on IRC, and/or read the wiki page <a
href="http://www.freedesktop.org/wiki/Software/LibreOffice/HowToBuild">How
To Build</a>. To <b>run</b> it do:</p>
<code>cd &lt;<i>/path/to/scratch/dir/</i>&gt;/program</code><br>
<code>. ./ooenv</code><br>
<code>gdb --args ./soffice.bin -writer</code><br>
...<br>

<h3 id="contact">Finding Other Developers</h3>

<p>Doing an elite hack by yourself is no fun, head to the
<code>#libreoffice</code> channel on <a
href="http://webchat.freenode.net/">irc.freenode.net</a> and
tell people about it; or better - ask for help with your strange
and twisted build problems. Failing that, checkout the <a
href="http://lists.freedesktop.org/mailman/listinfo/libreoffice">libreoffice@lists.freedesktop.org</a>
mailing list, or contact michael.meeks@novell.com.
</p>

<h3 id="easy_things">Completing Entry Level Tasks</h3>

<p>Luckily, the LibreOffice code contains many problems that simply
require care and time to improve - this provides a wonderful opportunity
to get involved in the code, to understand it and to get sucked into
the joy of LibreOffice. The wiki contains a <a
href="http://www.freedesktop.org/wiki/Software/libreoffice/EasyHacks">page
of easy tasks</a> - listing the skills required, and so on. In some
cases these extend only to the ability to detect un-necessary comments.</p>

<p>Edit the files in <code>rawbuild/&lt;location&gt;</code> and
use <code>git diff</code> to extract changes to mail in to <a
href="http://lists.freedesktop.org/mailman/listinfo/libreoffice">libreoffice@lists.freedesktop.org</a>
(don't be shy, please mention your code is contributed under the
LGPLv3+).</p>

<h3 id="buckstop">When Everything Fails</h3>

<p>While recognising the many key individuals in each module and
component, LibreOffice has a team of developers with whom the buck
stops; they get to make the horribly woolly technical decisions, so
that you have someone to shout at, in a satisfying way. These
guys are: Rene Engelhard (_rene_), Caolan McNamara (caolan)
Thorsten Behrens (thorsten) and Michael Meeks (mmeeks) - find them
on IRC, send them private mail, and persecute them with your
development related problem, until you get help.</p>

<h3 id="bugs">Filing Bugs</h3>

<p>If your bug has an associated patch, the best place to file it
is on the mailing list. Failing that <a
href="https://bugs.freedesktop.org/">bugzilla</a> is a reasonable
place to go.</p>

EOT;

print_page("Develop", array("develop", "summary"),
	   "Get Involved Developing LibreOffice", $content);
?>
