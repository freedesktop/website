<?php
require("../template.php");

print_page("Go-OO! - Download",
		   "Download OpenOffice.org",
                   "Choose the version of OpenOffice that matches your computer's operating system.".
                   "<dl>".
                   "<dt><a href=\"http://go-oo.org/tstnvl/GoOo/\">Windows</a> - simply download the zip file and run the".
                   "embedded setup to install.</dt>".
                   "<dt>SUSE ".
                   "Stable: ".
                   "<a href=\"http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/SLED_10/\">SLED10</a>,".
                   "<a href=\"http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/SUSE_Linux_10.1/\">10.1</a>,".
                   "<a href=\"http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/openSUSE_10.2/\">10.2</a>".
                   "Unstable: ".
                   "<a href=\"http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/SLED_10/\">SLED10</a>,".
                   "<a href=\"http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/SUSE_Linux_10.1/\">10.1</a>,".
                   "<a href=\"http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/openSUSE_10.2/\">10.2</a>".
                   "<br>add a repository with zypper eg.".
"<pre>zypper sa http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/openSUSE_10.2".
"zypper --non-interactive in OpenOffice_org-gnome</pre>".
                    "</dt>".
                    "<dt>Debian</dt>".
                    "<dt>Ubuntu</dt>".
                    "<dt>Mandriva</dt>".
                    "<dt>Gentoo</dt>".
                    "<dt>Ark</dt>".
                    "<dt>PLD</dt>".
                    "<dt>RPath</dt>".
                    "<dt>Pardus</dt>".
                    "<dt>QiLinux</dt>".
                    "<dt>DroplineGNOME</dt>".
                    "<dt>Frugalware</dt>".
                    "<dt>Solaris</dt>".
                    "</dl>"
		    
);


?>