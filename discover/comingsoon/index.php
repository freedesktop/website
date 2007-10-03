<?php
require("../../template.php");


$content = <<<EOT

<p>Take a sneak peek at what is being worked on for future version
of OpenOffice.org</p>

<h4>Enhanced field support</h4>

<p>OpenOffice.org Writer has a lot of shortcomings when it comes to
fields.  Florian Reuter is working on enhancing the field support in
Writer.  Here are the issues currently being worked on:</p>
<ul>
<li>Allow for in-place editing of input field (turn off pop-up) 
<a href="http://qa.openoffice.org/issues/show_bug.cgi?id=33737">(#i33737)</a></li>
<li>allow use of different fonts within one field 
<a href="http://qa.openoffice.org/issues/show_bug.cgi?id=29508">(#i29508)</a></li>
<li>Nested Fields support on Write 
<a href="http://qa.openoffice.org/issues/show_bug.cgi?id=7644">(#i7644)</a>
and allow nested conditions when using conditional fields 
<a href="http://qa.openoffice.org/issues/show_bug.cgi?id=69332">(#i69332)</a></li>
</ul>
<p>Here is the preview of a proof-of-concept implementation:</p>
<p>
<a href="go-fields.png"><img src="go-fields-thumb.jpg" 
alt="field support screenshot" /></a>
</p>
EOT;


print_page("Go-OO! - Discover - Coming Soon", array("comingsoon", "discover", "summary"),
   "Coming soon to OpenOffice.org",
   $content
   );

?>

