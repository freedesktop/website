<?php
require("template.php");

$content = <<<EOT
    <h3>Better</h3>
    <ul>
        <li>Better interoperability</li>
        <li>Better functionality</li>
    </ul>

    <h3>Faster</h3>
    <ul>
        <li>Faster startup</li>
        <li>Faster code integration</li>
    </ul>

    <h3>Freer</h3>
    <ul>
        <li>Freer licensing</li>
        <li>Freer politics</li>
    </ul>
    <div>
     <p><a href="/download/">Download OpenOffice.org</a></p>
     </div>
EOT;

print_page("Go-OO!", array("summary"),
		   "Your OpenOffice.org",
		   $content);

?>
