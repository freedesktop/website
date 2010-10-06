<?php
require("../template.php");

$content = <<<"EOT"

<h3>Foundation page content goes here.</h3>

EOT;

print_page("The Document Foundation", array("foundation", "summary"),
	   "The Document Foundation", $content);
?>
