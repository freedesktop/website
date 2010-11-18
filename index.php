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

<h3>Business and Administration Congress</h3>

<p>You can meet founding members of The Document Foundation at the <b>Business and Administration Congress</b>, taking place
<i>November 16th and 17th</i> in <i>Munich</i>. More information is available at <a href="http://www.oookwv.de">http://www.OOoKWV.de</a>.</p>

<h3>Want to meet us?</h3>

<p>See the <a href="http://wiki.documentfoundation.org/Events">list of events</a> where you can meet The Document Foundation and members of the Community.</p>

<h3>News</h3>

<p>2010-11-17 <b>Blog</b><br>
The official Document Foundation blog is <a href="http://blog.documentfoundation.org">here</a>.</p>

<p>2010-10-13 <b>The Next Decade Manifesto</b><br>
The announcement of the next decade manifesto is available <a href="/pdf/tdf_nextdecade.pdf">here</a>.<br>
The manifesto itself is <a href="/pdf/tdf_manifesto.pdf">available as PDF</a> and <a href="http://wiki.documentfoundation.org/TDF/Next_Decade_Manifesto">in our wiki</a>.</p>

<p>2010-10-06 <b>Numbers of the first week</b><br>
Numbers @ The Document Foundation press release is available <a href="/pdf/tdf_numbers.pdf">here</a>.</p>

<p>2010-09-28 <b>The Document Foundation announced</b><br>
The announcement of The Document Foundation is available <a href="/pdf/tdf_release.pdf">here</a>.</p>

<p>2010-09-28 <b>Blogosphere</b><br>
Bloggers can be found on the <a href="http://planet.documentfoundation.org">The Document Foundation Planet</a>.</p>

</div>
EOT;

print_page("Welcome", array("summary"), "Welcome to The Document Foundation!", $content);

?>
