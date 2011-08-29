<?php
require("../template.php");

$content = <<<EOT
        <p>Go-oo has been made obsolete by the exciting new LibreOffice project. Read their hacker page <a href="http://www.libreoffice.org/get-involved/developers/">here</a>.
	</p>
EOT;

print_page("Go-OO! - Developers", 
   array("developers", "summary"),
   "Developers",
   $content,
   array ()
);

?>
