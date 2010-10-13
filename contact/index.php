<?php
require("../template.php");

$content = <<<"EOT"

<h3>General Inquiries</h3>

<p>For general inquiries, please contact us directly at <a href="mailto:info@documentfoundation.org">
info@documentfoundation.org</a>.

<h3>Press and Media Contacts</h3>

<p>We have a dedicated group of press contacts who are happy to answer your questions about The Document Foundation
and LibreOffice. <b>To receive a reply in time, we recommend contacting us directly at <a href="mailto:info@documentfoundation.org">
info@documentfoundation.org</a>, which will be distributed to all contacts below.</b></p>
<ul>
	<li><b>Florian Effenberger (Germany)</b><br>
	Phone: +49 8341 99660880<br>
	Mobile: +49 151 14424108<br>
	Skype: <a href="callto://floeff">floeff</a><br>
	E-mail: <a href="mailto:floeff@documentfoundation.org">floeff@documentfoundation.org</a></li>
	<li><b>Olivier Hallot (Brazil)</b><br>
	Mobile: +55 21 88228812<br>
	E-mail: <a href="mailto:olivier.hallot@documentfoundation.org">olivier.hallot@documentfoundation.org</a></li>
	<li><b>Charles H. Schulz (France)</b><br>
	Mobile: +33 6 98655424<br>
	E-mail: <a href="mailto:charles.schulz@documentfoundation.org">charles.schulz@documentfoundation.org</a></li>
	<li><b>Italo Vignoli (Italy)</b><br>
	Mobile: +39 348 5653829<br>
	E-mail: <a href="mailto:italo.vignoli@documentfoundation.org">italo.vignoli@documentfoundation.org</a></li>
</ul>

<h3>Blogosphere</h3>

<p>Bloggers can be found on the <a href="http://planet.documentfoundation.org">The Document Foundation Planet</a>.</p>

<h3>Security Contact</h3>

<p>To reach our security team, please drop an e-mail to <a href="mailto:security@documentfoundation.org">
security@documentfoundation.org</a>.

<h3>Blogosphere</h3>

<p>Read what bloggers say on our <a href="http://planet.documentfoundation.org">The Document Foundation Planet</a>.</p>

<h3>Social Networks and IRC</h3>
<p>The Document Foundation also provides communication channels on IRC and various social networks.</p>
<ul>
        <li><b>Twitter and Identi.ca:</b> Follow us @docufoundation <a href="http://twitter.com/docufoundation">on Twitter</a>
	and <a href="http://identi.ca/docufoundation">on Identi.ca</a>. Feel free to use the tag
	#docufoundation for posting interesting news about us. We've also set-up a <a href="http://identi.ca/group/docufoundation">dedicated
	group at Identi.ca</a>.
        <li><b>IRC:</b> We provide a dedicated IRC channel <a href="irc://irc.freenode.net/#documentfoundation">#documentfoundation at irc.freenode.net</a> where
        where many of our members and supporters are happy to answer your questions.</li>
        <li><b>Facebook:</b> At Facebook, The Document Foundation maintains <a href="http://www.facebook.com/group.php?gid=159921240700930">a group</a>
as well as a <a href="http://www.facebook.com/documentfoundation">fan page</a>.</li>
        <li><b>LinkedIn:</b> Users of LinkedIn find our group <a href="http://www.linkedin.com/groups?mostPopular=&amp;gid=3469260">here</a>.</li>
        <li><b>XING:</b> We provide a group at XING. To join, click <a href="http://www.xing.com/group-60064.a12be3">here</a>.</li>
</ul>

EOT;

print_page("Contact", array("contact", "summary"),
	   "Contact Us", $content);
?>
