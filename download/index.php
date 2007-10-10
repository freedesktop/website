<?php
require("../template.php");


$content = <<<EOT
Choose the version of OpenOffice that matches your computer's operating system.
<dl>
<dt><a href="http://download.go-oo.org/">Source Code</a></dt>
<dd><a href="http://download.go-oo.org/OOG680/ooo-build-2.3.0.3.tar.gz">ooo-build-2.3.0.3</a> or
<a href="http://svn.gnome.org/viewcvs/ooo-build/trunk/">svn view</a> or:
<pre>\$ svn checkout http://svn.gnome.org/svn/ooo-build/trunk ooo-build</pre>
</dd>
<dt>Windows ( mirrors:
be: <a href="ftp://ftp.skynet.be/pub/ftp.suse.com/projects/go-oo">ftp</a>
<a href="ftp://ftp.belnet.be/mirror/ftp.suse.com/projects/go-oo">ftp</a>,
de: <a href="ftp://ftp.hs.uni-hamburg.de/pub/mirrors/suse/projects/go-oo">ftp</a>
<a href="ftp://ftp.tu-chemnitz.de/pub/linux/suse/projects/go-oo">ftp</a>,
it: <a href="ftp://ftp.uniroma2.it/Linux/suse/pub/projects/go-oo">ftp</a>,
jp: <a href="ftp://ftp.riken.jp/Linux/suse/projects/go-oo">ftp</a>
<a href="http://ftp.kddilabs.jp/Linux/packages/SuSE/projects/go-oo">http</a>,
us: <a href="ftp://ftp.suse.com/pub/projects/go-oo">ftp</a>
<a href="ftp://suse.mirrors.tds.net/pub/projects/go-oo">ftp</a>
)
</dt>
<dd>Simply download the en_us file, and your native lang-pack, and install them
one by one.</dd>
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
<dt>PLD</dt>
<dd>PLD provides OpenOffice.org in their repository. To install it just
type as root:
<pre># poldek -uGv openoffice.org-APP</pre>
 where APP can be one of base, calc, draw, writer</dd>
<dt>Mandriva</dt>
<dd></dd>
<dd></dd>
<dt>Ark</dt>
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
