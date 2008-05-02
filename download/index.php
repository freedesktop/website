<?php
require("../template.php");


$content = <<<EOT

<hr>

<h3><a href="http://go-oo.mirrorbrain.org/stable/win32/">Windows</a></h3>
<dd>Simply download the 
<dd>
<a href="http://go-oo.mirrorbrain.org/stable/win32/2.4/GoOo-en-US-2.4.0-17.exe">en_us</a>
us file, and your
<a href="http://go-oo.mirrorbrain.org/stable/win32/2.4/">native lang-pack</a>, and
install them one by one.</dd>
<dd></dd>
<br>

<h3><a href="http://go-oo.mirrorbrain.org/stable/linux-x86/">Universal Linux</a></h3>
<dd><a href="http://go-oo.mirrorbrain.org/stable/linux-x86/2.4">Packages</a> available here,
also <code><a href="http://go-oo.mirrorbrain.org/stable/linux-x86/2.4">http://go-oo.mirrorbrain.org/stable/linux-x86/2.4</a></code>
is a YUM repository, you can add as an installation source.
<dd></dd>
<br>

<h3><a href="http://download.go-oo.org/">Source Code</a></h3>

<dd>Download: <a href="http://download.go-oo.org/OOH680/ooo-build-2.4.0.8.tar.gz">ooo-build-2.4.0.8</a>
<dd>Browse: <a href="http://svn.gnome.org/viewcvs/ooo-build/trunk/">trunk</a> or <a href="http://svn.gnome.org/viewcvs/ooo-build/branches/ooo-build-2-4">ooo-build-2-4 branch</a></dd>
<dd>Check out: <pre>\$ svn checkout http://svn.gnome.org/svn/ooo-build/trunk ooo-build</pre></dd>
<dl>

<hr>

<h2>Other derivatives</h2>

<h3>openSUSE</h3>
<dd>
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/SLED_10/">SLED10</a>, 
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/SUSE_Linux_10.1/">10.1</a>, 
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/openSUSE_10.2/">10.2</a>
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/openSUSE_10.3/">10.3</a> (<a href="http://software.opensuse.org/ymp/OpenOffice.org:STABLE/openSUSE_10.3/OpenSUSE_org.ymp">1-click install</a>)
</dd>
<dd>To add a repository with <a href="http://en.opensuse.org/Zypper">zypper</a> (NB. OO.o
has been split into more individual packages here so make sure you get all of them):
<pre># zypper sa http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/openSUSE_10.2
# zypper --non-interactive in OpenOffice_org-gnome OpenOffice_org-writer OpenOffice_org-calc ...</pre>
</dd>
<dd>See <a href="http://en.opensuse.org/OpenOffice.org">opensuse.org</a> site for more information about these builds.</dd>
<dl>

<h3>Debian</h3>
<dd>Debian provides OpenOffice.org in their repositories. 
To install it just type as root <pre># apt-get install openoffice.org</pre></dd>
<dl>

<h3>Ubuntu</h3>
<dd>Ubuntu provides OpenOffice.org in their repositories. 
To install it just type as root <pre># apt-get install openoffice.org</pre></dd>
<dl>

<h3>NeoOffice</h3>
<dd><a href="http://www.neooffice.org/">NeoOffice</a> is built on top of the
Go-OO! version.</dd>
<dl>

<h3>OxygenOffice</h3>
<dd>The <a href="http://ooop.wiki.sourceforge.net/">OxygenOffice</a> variant is
built on top of Go-OO!.</dd>
<dl>

<h3>DroplineGNOME</h3>
<dd>DroplineGNOME provide pre-builds packages for OpenOffice.org:<ul>
<li><a href="http://trovao.droplinegnome.org/extras/2.18/openoffice/">i686 builds</a></li>
<li><a href="http://saxa.droplinegnome.org/ooo/">x86_64 builds</a></li>
</ul></dd>
<dl>

<h3>Frugalware</h3>
<dd>Frugalware provides OpenOffice.org in their repositories. To install it just type as root 
<pre># pacman-g2 -S openoffice.org</pre></dd>
<dl>

<h3>Gentoo</h3>
<dd>Gentoo provides OpenOffice.org in their repositories. 
To build and install it just type as root <pre># emerge openoffice</pre></dd>
<dl>


<h3>PLD</h3>
<dd>PLD provides OpenOffice.org in their repository. To install it just
type as root:
<pre># poldek -uGv openoffice.org-APP</pre>
 where APP can be one of base, calc, draw, writer</dd>
</dl>

<h2>Unstable / development packages</h2>

 <a href="http://go-oo.mirrorbrain.org/unstable/win32/">UNSTABLE</a> build.</dd>

 <a href="http://go-oo.mirrorbrain.org/unstable/linux-x86/">UNSTABLE</a> build.</dd>

SUSE:
<dd>UNSTABLE: 
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/SLED_10/">SLED10</a>, 
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/SUSE_Linux_10.1/">10.1</a>, 
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/openSUSE_10.2/">10.2</a>
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/openSUSE_10.3/">10.3</a> (<a href="http://software.opensuse.org/ymp/OpenOffice.org:UNSTABLE/openSUSE_10.3/OpenSUSE_org.ymp">1-click install</a>)
</dd>

EOT;


print_page("Go-OO! - Download", array("download", "summary"),
		   "Download Go-OO!",
		   $content 
		   );

?>
