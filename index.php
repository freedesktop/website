<?php
require("template.php");

$content = <<<EOT

$rightnavigation

<div id="welcome">
<!-- <p>The Document Foundation:</p> -->
<ul class="ul-libreoffice">
<!-- could be defined better in CSS, what I want to achieve is:bullets in the header color, but black text -->
    <li><div>It is an independent self-governing meritocratic Foundation, created by leading members of the OpenOffice.org Community.</div></li>
    <li><div>It continues to build on the foundation of ten years' dedicated work by the OpenOffice.org Community.</div></li>
    <li><div>It was created in the belief that the culture born of an independent Foundation brings out the best in contributors and will deliver the best software for users.</div></li>
    <li><div>It is open to any individual who agrees with our core values and contributes to our activities.</div></li>
    <li><div>It welcomes corporate participation, e.g. by sponsoring individuals to work as equals alongside other contributors in the community.</div></li>
<!--    <li><div>It is proud to be the home of LibreOffice, the next evolution of the world's leading free office suite.</div></li> -->
</ul> 

<p>The Document Foundation is proud to be the home of <a
href="http://www.libreoffice.org/download/">LibreOffice</a>,
the next evolution of the world's leading free office suite.</p>

<h3>Want to meet us?</h3>

<p>See the <a href="http://wiki.documentfoundation.org/Events">list of events</a> where you can meet The Document Foundation and members of the Community.</p>

</div>
EOT;

print_page("Welcome", array("summary"), "Welcome to The Document Foundation!", $content);

?>
