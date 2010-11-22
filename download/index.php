<?php
require("../template.php");

$urlbase=$download_binaries;

$content = <<<EOT


<div id="libreoffice">
<script type="text/javascript" src="/scripts/photoshuffler.js"></script>

<div id="right-download"><div id="screenshot-slide"><a href="/download/"><img id="screenshot-slide-image" src="/img/slides/scaled/LO_StartCenter_Small.png" alt="Download LibreOffice"></a></div></div>

<h3>About LibreOffice</h3>

<p>
LibreOffice is a productivity suite that is compatible with other major 
office suites, and available on a variety of platforms. It is free software 
and therefore free to download, use and distribute.
</p>

<h3>Download LibreOffice Beta3</h3>

<p>
The following software packages are intended to give you a first impression of what LibreOffice 
is. Currently we are in the process of combining the work of many contributors, and improving
how to make the software available to our users. 
There are known issues, so please consider reading the <a href="#release-notes">release notes</a>
below for a list of known issues being worked on, the most obvious being
the incomplete language packaging situation.
</p>

<p>
This beta release is not intended for production use!
</p>

<div id="download-nav">
    <ul id="dlnav">
       <li class="dlnav-win32"><a href="$urlbase/3.3.0-beta3/win/x86/LibO_3.3.0_Win_x86_install_multi.exe">Download and install this for the International version to be used on Microsoft Windows.</a></li>
       <li class="dlnav-linux32"><a href="$urlbase/3.3.0-beta3/rpm/x86/LibO_3.3.0_Linux_x86_install-rpm_en-US.tar.gz">Download and install this for the English version to be used on various GNU/Linux 32-bit distributions.</a></li>
       <li class="dlnav-linux64"><a href="$urlbase/3.3.0-beta3/rpm/x86_64/LibO_3.3.0_Linux_x86-64_install-rpm_en-US.tar.gz">Download and install this for the English version to be used on various GNU/Linux 64-bit distributions.</a></li>
       <li class="dlnav-mac"><a href="$urlbase/3.3.0-beta3/mac/x86/LibO_3.3.0_MacOS_x86_install_en-US.dmg">Download and install this for the English version to be used on Apple MacOS X.</a></li>
       <li class="dlnav-source"><a href="$download_source">Click here to download the tarball containing the source code.</a></li>
    </ul>

    <p>You can also <a href="http://tracker.documentfoundation.org:6969">download using BitTorrent</a>,
    or <a href="$urlbase/3.3.0-beta3">browse all the Beta3 installation packages</a> to get unofficial
       Debian packages (<a href="$urlbase/3.3.0-beta3/deb/x86/LibO_3.3.0_Linux_x86_install-deb_en-US.tar.gz">32-bit .debs</a> 
    or <a href="$urlbase/3.3.0-beta3/deb/x86_64/LibO_3.3.0_Linux_x86-64_install-deb_en-US.tar.gz">64-bit .debs</a>), or language packs.</p>
</div>

<h3 id="release-notes">Beta Release Notes</h3>
<p>This beta release is not intended for production use!</p>
<p>There are a number of known issues being worked on:</p>
<ul class="list-libreoffice">
<li>The Windows build is an International build - you can choose the user interface language that 
    is suitable for you. The help content is not included. We are working on the online version. 
    Alternatively, it will be possible to install it separately. Beware that beta3 <a href="https://bugs.freedesktop.org/show_bug.cgi?id=31494">crashes on 
    exit</a>. It should not affect normal work, though. Additionally, we are working on smaller problems 
    like <a href="https://bugs.freedesktop.org/show_bug.cgi?id=30797">wrong description of several languages</a>.</li>
<li>The Linux and MacOSX builds are English builds with the possibility to install language packs.
    Please browse <a href="$urlbase/3.3.0-beta3">the archives</a> to get the language pack you need 
    for your platform.</li>
<li>The LibreOffice branding and renaming is new and work in progress. You may still see old graphics, 
    icons or websites. So please bear with us. This also applies to
    the BrOffice.org branding - applicable in Brazil.</li>
<li>Filters for the legacy StarOffice binary formats may be missing.</li>
</ul>

<h3>Keeping Up With the Progress</h3>
<p>
To be informed about the latest updates and releases of LibreOffice,
send an empty mail to <a
href="mailto:announce+subscribe@documentfoundation.org">announce+subscribe@documentfoundation.org</a>.<br>
To join our discussion mailing list, send an empty mail to <a
href="mailto:discuss+subscribe@documentfoundation.org">discuss+subscribe@documentfoundation.org</a>.<br>
More information are available on our <a href="/contact/">Contacts</a> page.
</p>

</div>
EOT;

print_page("Download", array("libreoffice", "summary"),
	   "LibreOffice Productivity Suite", $content);
?>
