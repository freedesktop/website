<?php
require("../template.php");


$content = <<<EOT
<ul>
<li><a href="mgp/">Magicpoint users guide to OO.o's Impress</a> or hints 
MagicPoint users.</li>
</ul>
EOT;

print_page("Go-OO! - users", array("users", "summary"),
   "User resources",
   $content
);
?>
