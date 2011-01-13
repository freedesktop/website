<?php
require("../template.php");

$content = <<<EOT


<div id="libreoffice">
<script type="text/javascript" src="/scripts/photoshuffler.js"></script>

<div id="right-download"><div id="screenshot-slide"><a href="/download/"><img id="screenshot-slide-image" src="/img/slides/scaled/LO_StartCenter_Small.png" alt="Download LibreOffice"></a></div></div>

<<<<<<< HEAD
<h3>About LibreOffice</h3>

<p>
LibreOffice is a productivity suite that is compatible with other major 
office suites, and is available on a variety of platforms. It is free software 
and therefore free to download, use and distribute.
</p>

<h3>Download LibreOffice Release Candidate 3</h3>

<p>
The following software packages are intended to give you a first impression of what LibreOffice 
is. Currently we are in the process of combining the work of many contributors, and improving
how to make the software available to our users. 
There are known issues, so please consider reading the <a href="#release-notes">release notes</a>
below for a list of known issues being worked on, the most obvious being
the incomplete language packaging situation.
</p>

<p>
This release candidate is not intended for production use!
</p>

<div id="download-nav">
    <ul id="dlnav">
       <li class="dlnav-win32"><a href="$urlbase/3.3.0-rc3/win/x86/LibO_3.3.0rc3_Win_x86_install_multi.exe">Download and install this for the International version to be used on Microsoft Windows.</a></li>
       <li class="dlnav-linux32"><a href="$urlbase/3.3.0-rc3/rpm/x86/LibO_3.3.0rc3_Linux_x86_install-rpm_en-US.tar.gz">Download and install this for the English version to be used on various GNU/Linux 32-bit distributions.</a></li>
       <li class="dlnav-linux64"><a href="$urlbase/3.3.0-rc3/rpm/x86_64/LibO_3.3.0rc3_Linux_x86-64_install-rpm_en-US.tar.gz">Download and install this for the English version to be used on various GNU/Linux 64-bit distributions.</a></li>
       <li class="dlnav-mac"><a href="$urlbase/3.3.0-rc3/mac/x86/LibO_3.3.0rc3_MacOS_x86_install_en-US.dmg">Download and install this for the English version to be used on Apple MacOS X (x86).</a></li>
       <li class="dlnav-source"><a href="$download_source">Click here to download the tarball containing the source code.</a></li>
    </ul>

    <p>You can also <a href="http://tracker.documentfoundation.org:6969">download using BitTorrent</a>,
    or <a href="$urlbase/3.3.0-rc3">browse all the RC3 installation packages</a> to get unofficial
       Debian packages (<a href="$urlbase/3.3.0-rc3/deb/x86/LibO_3.3.0rc3_Linux_x86_install-deb_en-US.tar.gz">32-bit .debs</a> 
    or <a href="$urlbase/3.3.0-rc3/deb/x86_64/LibO_3.3.0rc3_Linux_x86-64_install-deb_en-US.tar.gz">64-bit .debs</a>),
    <a href="$urlbase/3.3.0-rc3/mac/ppc/LibO_3.3.0rc3_MacOS_PPC_install_en-US.dmg">Apple MacOS X (PPC)</a>
    or language packs.</p>
</div>

<h3 id="release-notes">Release Notes</h3>
<p>This release candidate is not intended for production use!</p>
<p>There are a number of known issues being worked on:</p>
<ul class="list-libreoffice">
<li>The Windows build is an International build - you can choose the user interface language that 
    is suitable for you. The help content is not included, but using an online version. 
    Alternatively, there are separate helppacks available. Please browse <a href="$urlbase/3.3.0-rc3">the archives</a> 
    to get the helppack pack you need for your platform.</li>
<li>The Linux and MacOSX builds are English builds with the possibility to install language packs.
    Please browse <a href="$urlbase/3.3.0-rc3">the archives</a> to get the language pack you need 
    for your platform.</li>
<li>The LibreOffice branding and renaming is new and work in progress. You may still see old graphics, 
    icons or websites. So please bear with us. This also applies to
    the BrOffice.org branding - applicable in Brazil.</li>
<li>Filters for the legacy StarOffice binary formats may be missing.</li>
<li>More detailed release notes are <a href="http://wiki.documentfoundation.org/Releases/3.3/RC3">available in our wiki.</a>
</ul>
=======
<h3>Downloading LibreOffice</h3>
>>>>>>> remove the download tab, and re-direct to libreoffice.org/download

<p>
This page is obsolete.
You can download LibreOffice from the libreoffice.org download site which is at
<a href="http://www.libreoffice.org/download/">http://www.libreoffice.org/download</a>.
</p>

</div>
EOT;

print_page("Download", array("libreoffice", "summary"),
	   "LibreOffice Productivity Suite", $content);
?>
