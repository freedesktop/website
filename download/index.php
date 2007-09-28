<?php
require("../template.php");


$content = <<<EOT
Choose the version of OpenOffice that matches your computer's operating system.
<dl>
<dt><a href="http://download.go-oo.org/">Source Code</a></dt>
<dd><a href="http://download.go-oo.org/OOG680/ooo-build-2.3.0.1.tar.gz">ooo-build-2.3.0.1</a> or
<a href="http://svn.gnome.org/viewcvs/ooo-build/trunk/">svn view</a> or:
<pre>\$ svn checkout http://svn.gnome.org/svn/ooo-build/trunk ooo-build</pre>
</dd>
<dt><a href="http://go-oo.org/tstnvl/GoOo/">Windows</a></dt>
<dd>Simply download the zip file and run the embedded setup to install.</dd>
<br>
<dt>OpenSUSE</dt>
<dd>Stable: 
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/SLED_10/">SLED10</a>, 
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/SUSE_Linux_10.1/">10.1</a>, 
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/openSUSE_10.2/">10.2</a>
</dd>
<dd>Unstable: 
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/SLED_10/">SLED10</a>, 
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/SUSE_Linux_10.1/">10.1</a>, 
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/openSUSE_10.2/">10.2</a>
</dd>
<dd>To add a repository with <a href="http://en.opensuse.org/Zypper">zypper</a> (NB. OO.o
has been split into more individual packages here so make sure you get all of them):
<pre># zypper sa http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/openSUSE_10.2
# zypper --non-interactive in OpenOffice_org-gnome OpenOffice_org-writer OpenOffice_org-calc ...</pre>
</dd>
<dt>Debian</dt>
<dd>Debian provides OpenOffice.org in their repositories. 
To install it just type as root <pre># apt-get install openoffice.org</pre></dd>
<dt>DroplineGNOME</dt>
<dd>DroplineGNOME provide pre-builds packages for OpenOffice.org:<ul>
<li><a href="http://trovao.droplinegnome.org/extras/2.18/openoffice/">i686 builds</a></li>
<li><a href="http://saxa.droplinegnome.org/ooo/">x86_64 builds</a></li>
</ul></dd>
<dt>Frugalware</dt>
<dd>Frugalware provides OpenOffice.org in their repositories. To install it just type as root 
<pre># pacman-g2 -S openoffice.org</pre></dd>
<dt>Gentoo</dt>
<dd>Gentoo provides OpenOffice.org in their repositories. 
To build and install it just type as root <pre># emerge openoffice</pre></dd>
<dt>Ubuntu</dt>
<dd>Ubuntu provides OpenOffice.org in their repositories. 
To install it just type as root <pre># apt-get install openoffice.org</pre></dd>
<dt>Mandriva</dt>
<dd></dd>
<dd></dd>
<dt>Ark</dt>
<dd></dd>
<dt>PLD</dt>
<dd></dd>
<dt>RPath</dt>
<dd></dd>
<dt>Pardus</dt>
<dd></dd>
<dt>QiLinux</dt>
<dd></dd>
</dl>

EOT;


print_page("Go-OO! - Download", array("download", "summary"),
		   "Download OpenOffice.org",
		   $content 
		   );

?>
