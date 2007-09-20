<?php
require("../template.php");

print_page("Go-OO! - Download", "download",
		   "Download OpenOffice.org",
                   "Choose the version of OpenOffice that matches your computer's operating system.".
                   "<dl>".
                   "<dt><a href=\"http://go-oo.org/tstnvl/GoOo/\">Windows</a></dt>\n".
		   "<dd>Simply download the zip file and run the embedded setup to install.</dd>".
                   "<dt>SUSE</dt>".
                   "<dd>Stable: ".
		   "<ul>".
                   "<li><a href=\"http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/SLED_10/\">SLED10</a></li>".
                   "<li><a href=\"http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/SUSE_Linux_10.1/\">10.1</a></li>".
                   "<li><a href=\"http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/openSUSE_10.2/\">10.2</a></li>".
		   "</ul></dd>".
                   "<dd>Unstable: ".
		   "<ul>" .
                   "<li><a href=\"http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/SLED_10/\">SLED10</a></li>".
                   "<li><a href=\"http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/SUSE_Linux_10.1/\">10.1</a></li>".
                   "<li><a href=\"http://download.opensuse.org/repositories/OpenOffice.org:/UNSTABLE/openSUSE_10.2/\">10.2</a></li>".
		   "</ul>".
                   "To add a repository with <a href=\"http://en.opensuse.org/Zypper\">zypper</a>:".
"<pre># zypper sa http://download.opensuse.org/repositories/OpenOffice.org:/STABLE/openSUSE_10.2\n".
"# zypper --non-interactive in OpenOffice_org-gnome</pre>".
                    "</dd>".
                    "<dt>Debian</dt>\n".
		    "<dd>Debian provides OpenOffice.org in their repositories. ".
		    "To install it just type as root <pre># apt-get install openoffice.org</pre></dd>\n".
                    "<dt>Ubuntu</dt>".
		    "<dd>Ubuntu provides OpenOffice.org in their repositories. ".
		    "To install it just type as root <pre># apt-get install openoffice.org</pre></dd>\n".
                    "<dt>Mandriva</dt>\n".
		    "<dd></dd>\n".
                    "<dt>Gentoo</dt>".
		    "<dd></dd>\n".
                    "<dt>Ark</dt>".
		    "<dd></dd>\n".
                    "<dt>PLD</dt>".
		    "<dd></dd>\n".
                    "<dt>RPath</dt>".
		    "<dd></dd>\n".
                    "<dt>Pardus</dt>".
		    "<dd></dd>\n".
                    "<dt>QiLinux</dt>".
		    "<dd></dd>\n".
                    "<dt>DroplineGNOME</dt>".
		    "<dd></dd>\n".
                    "<dt>Frugalware</dt>".
		    "<dd></dd>\n".
                    "</dl>"
		    
);


?>