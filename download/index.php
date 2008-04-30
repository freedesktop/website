<?php
require("../template.php");


$content = <<<EOT
<h4><a href="http://download.go-oo.org/">Source Code</a></h4>
<dd>Last stable release: <a href="http://download.go-oo.org/OOH680/ooo-build-2.4.0.8.tar.gz">ooo-build-2.4.0.8</a>
<dd>Browse: <a href="http://svn.gnome.org/viewcvs/ooo-build/trunk/">trunk</a> or <a href="http://svn.gnome.org/viewcvs/ooo-build/branches/ooo-build-2-4">ooo-build-2-4 branch</a></dd>
<dd>Check out: <pre>\$ svn checkout http://svn.gnome.org/svn/ooo-build/trunk ooo-build</pre></dd>
<dl>
<h4>Binary package</h4>
<h5>Windows</h5>
<dd>Try <a href="http://go-oo.mirrorbrain.org/stable/win32/">STABLE</a> or <a href="http://go-oo.mirrorbrain.org/unstable/win32/">UNSTABLE</a> build.</dd>
<dd>Simply download the en_us file, and your native lang-pack, and install them one by one.</dd>
<dd></dd>
<dl>
<h5>Universal Linux build</h5>
<dd>Try <a href="http://go-oo.mirrorbrain.org/stable/linux-x86/">STABLE</a> or <a href="http://go-oo.mirrorbrain.org/unstable/linux-x86/">UNSTABLE</a> build.</dd>
<dd>There are available YUM repodata, so you could add the above URLs as extra installation sources.</dd>
<dd></dd>
<dl>
<h5>openSUSE</h5>
<dd>STABLE: 
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/SLED_10/">SLED10</a>, 
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/SUSE_Linux_10.1/">10.1</a>, 
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/openSUSE_10.2/">10.2</a>
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/openSUSE_10.3/">10.3</a> (<a href="http://software.opensuse.org/ymp/OpenOffice.org:STABLE/openSUSE_10.3/OpenSUSE_org.ymp">1-click install</a>)
</dd>
<dd>UNSTABLE: 
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/SLED_10/">SLED10</a>, 
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/SUSE_Linux_10.1/">10.1</a>, 
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/openSUSE_10.2/">10.2</a>
<a href="http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/openSUSE_10.3/">10.3</a> (<a href="http://software.opensuse.org/ymp/OpenOffice.org:UNSTABLE/openSUSE_10.3/OpenSUSE_org.ymp">1-click install</a>)
</dd>
<dd>To add a repository with <a href="http://en.opensuse.org/Zypper">zypper</a> (NB. OO.o
has been split into more individual packages here so make sure you get all of them):
<pre># zypper sa http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/openSUSE_10.2
# zypper --non-interactive in OpenOffice_org-gnome OpenOffice_org-writer OpenOffice_org-calc ...</pre>
</dd>
<dd>See <a href="http://en.opensuse.org/OpenOffice.org">opensuse.org</a> site for more information about these builds.</dd>
<dl>
<h5>Debian</h5>
<dd>Debian provides OpenOffice.org in their repositories. 
To install it just type as root <pre># apt-get install openoffice.org</pre></dd>
<dl>
<h5>DroplineGNOME</h5>
<dd>DroplineGNOME provide pre-builds packages for OpenOffice.org:<ul>
<li><a href="http://trovao.droplinegnome.org/extras/2.18/openoffice/">i686 builds</a></li>
<li><a href="http://saxa.droplinegnome.org/ooo/">x86_64 builds</a></li>
</ul></dd>
<dl>
<h5>Frugalware</h5>
<dd>Frugalware provides OpenOffice.org in their repositories. To install it just type as root 
<pre># pacman-g2 -S openoffice.org</pre></dd>
<dl>
<h5>Gentoo</h5>
<dd>Gentoo provides OpenOffice.org in their repositories. 
To build and install it just type as root <pre># emerge openoffice</pre></dd>
<dl>
<h5>Ubuntu</h5>
<dd>Ubuntu provides OpenOffice.org in their repositories. 
To install it just type as root <pre># apt-get install openoffice.org</pre></dd>
<dl>
<h5>PLD</h5>
<dd>PLD provides OpenOffice.org in their repository. To install it just
type as root:
<pre># poldek -uGv openoffice.org-APP</pre>
 where APP can be one of base, calc, draw, writer</dd>
</dl>
EOT;


print_page("Go-OO! - Download", array("download", "summary"),
		   "Download Go-OO!",
		   $content 
		   );

?>
