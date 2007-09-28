<?php
require("template.php");

$content = <<<EOT
	 <p id="tagline">
	 <p>With word processing, spreadsheets,
         presentations, and everything else needed
         for creating and editing documents,
         OpenOffice.org has the tools it takes to
         create, edit, and share work.  It's open
         source and cross-platform, so it's free
         and works on your computer.
     </p>
     <p>
         The go-oo version of OpenOffice.org is designed
         to give a foretaste of new features in development
         and includes functionality not yet accepted up-stream.
     </p>
     <a href="/download/">Download OpenOffice.org</a>
EOT;

print_page("Go-OO!", "summary",
		   "Your OpenOffice.org",
		   $content);

?>