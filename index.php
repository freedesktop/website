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

<p>The Document Foundation is proud to be the home of <a href="download">LibreOffice</a>, the next evolution of the world's leading free office suite.</p>

<h3>Press Materials</h3>

<p>Numbers @ The Document Foundation press release is <a href="/contact/tdf_numbers.pdf">here</a> (PDF).</p>
<p>Please find The Document Foundation press release <a href="/contact/tdf_release.xml">here</a> (<a href="/contact/tdf_release.pdf">PDF</a>).</p>


<h3>Blogosphere</h3>

<p>Read what bloggers say on our <a href="http://planet.documentfoundation.org">The Document Foundation Planet</a>.</p>

</div>
EOT;

print_page("Welcome", array("summary"), "Welcome to The Document Foundation!", $content);

?>
