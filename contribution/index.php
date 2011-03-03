<?php
require("../template.php");

$urlbase="http://libreoffice.mirrorbrain.org";

$content = <<<"EOT"

<h3>Get Involved</h3>

<div id="contribute1">

<p>Come and join us! Subscribe to our mailing lists and support us with your skills! We need you for code development, testing, translation, documentation, design, marketing and many other tasks in our world-wide community!</p>

<p>For code contribution, have a look at our <a href="/develop/">Develop</a> page - for the available mailing lists, please scroll down.</p>
<p>We also offer <a href="http://wiki.documentfoundation.org">a wiki</a>, <a href="http://blog.documentfoundation.org">an official blog</a>, <a href="http://planet.documentfoundation.org">a blog planet</a>, as well as
<a href="#lists">some mailing lists</a>.
</div>

<h3>Show Your Support</h3>

<div id="contribute2">
<p>Tell the world you share our visions by joining our <a href="http://www.facebook.com/group.php?gid=159921240700930">group</a>
 and the <a href="http://www.facebook.com/pages/The-Document-Foundation/163385893677896">fan page</a> at Facebook.
</p>
</div>

<h3>Donate</h3>
<div id="contribute3">
<p>
If you like to support our work on LibreOffice and The Document Foundation but cannot directly contribute, you are welcome to send in donations.
<a href="http://www.ooodev.org">OpenOffice.org Deutschland e.V.</a> will handle donations on our behalf. Each 
donation marked with the keyword "Document Foundation" will be used to support our efforts.
</p>
<p>PayPal: donations@documentfoundation.org</p>
	<form action="https://www.paypal.com/de/cgi-bin/webscr" method="post">
	<p>
	<input name="lc" value="EN" type="hidden">
	<input name="cmd" value="_donations" type="hidden">
	<input name="business" value="donations@documentfoundation.org" type="hidden">
	<input name="return" value="http://www.documentfoundation.org" type="hidden">
	<input name="undefined_quantity" value="0" type="hidden">
	<input name="item_name" value="The Document Foundation" type="hidden">
	Amount: <input name="amount" size="4" maxlength="10" value="" style="text-align: right;" type="text">
		<select name="currency_code">
			<option value="EUR">EUR</option>
			<option value="USD">USD</option>
			<option value="GBP">GBP</option>
			<option value="CHF">CHF</option>
			<option value="AUD">AUD</option>
			<option value="HKD">HKD</option>
			<option value="CAD">CAD</option>
			<option value="JPY">JPY</option>
			<option value="NZD">NZD</option>
			<option value="SGD">SGD</option>
			<option value="SEK">SEK</option>
			<option value="DKK">DKK</option>
			<option value="PLN">PLN</option>
			<option value="NOK">NOK</option>
			<option value="HUF">HUF</option>
			<option value="CZK">CZK</option>
			<option value="ILS">ILS</option>
			<option value="MXN">MXN</option>
	</select>
	<input name="charset" value="utf-8" type="hidden">
	<input name="no_shipping" value="1" type="hidden">
	<input name="image_url" value="https://www.libreoffice.org/themes/libo/images/logo.png" type="hidden">
	<input name="cancel_return" value="http://www.documentfoundation.org" type="hidden">
	<input name="no_note" value="1" type="hidden"><br><br>
	<input src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" name="submit" alt="PayPal secure payments." type="image">
	</p>
	</form>
<br>
<p>Bank account information:
<pre>Owner: OpenOffice.org Deutschland e.V.
Subject: The Document Foundation
Account Number: 3497390
Bank Code: 66690000
Bank: Volksbank Pforzheim
IBAN: DE12666900000003497390
BIC: VBPFDE66

Address of recipient: OpenOffice.org Deutschland e.V., Riederbergstr. 92, 65195 Wiesbaden, Germany
Address of bank: Volksbank Pforzheim eG, Westliche-Karl-Friedrich-Str. 53, 75172 Pforzheim, Germany</pre>
</p>
<br>
</div>

<h3><a name="lists">Global Mailing Lists</a></h3>

We have several global mailing lists available, which are our primary discussion platform.<br>
<b>Everything you post to public mailing lists, <u>including your e-mail address and other personal data contained in your e-mail</u>, will be publicly archived and cannot be deleted. So, post wisely!</b><br>
Information on how to unsubscribe will be sent to you in the confirmation e-mail, and is shown in the footer of every message.<br>
<b>A note for GMANE users:</b>
In order to use GMANE to post to the mailing lists, you need to supply your e-mail address. This is to protect our lists from spam. You can either subscribe to the lists or their digests, but this might defeat the purpose of using GMANE. If you do not want to receive any e-mail from the lists, but be able to post, please subscribe to the so-called "nomail" version of the list by attaching -nomail to the normal subscription address.<br>
Example: discuss+subscribe-nomail@documentfoundation.org or website+subscribe-nomail@libreoffice.org
<ul>
<li><b>announce@documentfoundation.org:</b> News and press releases by The Document Foundation<br>
Subscription: <a href="mailto:announce+subscribe@documentfoundation.org">announce+subscribe@documentfoundation.org</a><br>

Digest subscription: <a href="mailto:announce+subscribe-digest@documentfoundation.org">announce+subscribe-digest@documentfoundation.org</a><br>
Archives: <a href="http://listarchives.documentfoundation.org/www/announce/">http://listarchives.documentfoundation.org/www/announce/</a><br>
Mail-Archive.com: <a href="http://www.mail-archive.com/announce@documentfoundation.org/">http://www.mail-archive.com/announce@documentfoundation.org/</a><br>
GMANE: <a href="http://dir.gmane.org/gmane.comp.documentfoundation.announce">http://dir.gmane.org/gmane.comp.documentfoundation.announce</a></li>
<li><b>discuss@documentfoundation.org:</b> Discussions about The Document Foundation<br>
Subscription: <a href="mailto:discuss+subscribe@documentfoundation.org">discuss+subscribe@documentfoundation.org</a><br>

Digest subscription: <a href="mailto:discuss+subscribe-digest@documentfoundation.org">discuss+subscribe-digest@documentfoundation.org</a><br>
Archives: <a href="http://listarchives.documentfoundation.org/www/discuss/">http://listarchives.documentfoundation.org/www/discuss/</a><br>
Mail-Archive.com: <a href="http://www.mail-archive.com/discuss@documentfoundation.org/">http://www.mail-archive.com/discuss@documentfoundation.org/</a><br>
GMANE: <a href="http://dir.gmane.org/gmane.comp.documentfoundation.discuss">http://dir.gmane.org/gmane.comp.documentfoundation.discuss</a></li>
<li><b>mirrors@documentfoundation.org:</b> Platform for administrators providing mirror space for our products<br>
Subscription: <a href="mailto:mirrors+subscribe@documentfoundation.org">mirrors+subscribe@documentfoundation.org</a><br>

Digest subscription: <a href="mailto:mirrors+subscribe-digest@documentfoundation.org">mirrors+subscribe-digest@documentfoundation.org</a><br>
Archives: <a href="http://listarchives.documentfoundation.org/www/mirrors/">http://listarchives.documentfoundation.org/www/mirrors/</a><br>
Mail-Archive.com: <a href="http://www.mail-archive.com/mirrors@documentfoundation.org/">http://www.mail-archive.com/mirrors@documentfoundation.org/</a><br>
GMANE: <a href="http://dir.gmane.org/gmane.comp.documentfoundation.mirrors">http://dir.gmane.org/gmane.comp.documentfoundation.mirrors</a></li>
<li><b>steering-discuss@documentfoundation.org:</b> Discussions of the Steering Committee<br>
Subscription: <a href="mailto:steering-discuss+subscribe@documentfoundation.org">steering-discuss+subscribe@documentfoundation.org</a><br>

Digest subscription: <a href="mailto:steering-discuss+subscribe-digest@documentfoundation.org">steering-discuss+subscribe-digest@documentfoundation.org</a><br>
Archives: <a href="http://listarchives.documentfoundation.org/www/steering-discuss/">http://listarchives.documentfoundation.org/www/steering-discuss/</a><br>
Mail-Archive.com: <a href="http://www.mail-archive.com/steering-discuss@documentfoundation.org/">http://www.mail-archive.com/steering-discuss@documentfoundation.org/</a><br>
GMANE: <a href="http://dir.gmane.org/gmane.comp.documentfoundation.steering-discuss">http://dir.gmane.org/gmane.comp.documentfoundation.steering-discuss</a></li>
<li><b>moderators@documentfoundation.org:</b> Discussions for moderators of our mailing lists<br>
Subscription: <a href="mailto:moderators+subscribe@documentfoundation.org">moderators+subscribe@documentfoundation.org</a><br>

Digest subscription: <a href="mailto:moderators+subscribe-digest@documentfoundation.org">moderators+subscribe-digest@documentfoundation.org</a><br>
Archives: <a href="http://listarchives.documentfoundation.org/www/moderators/">http://listarchives.documentfoundation.org/www/moderators/</a><br>
Mail-Archive.com: <a href="http://www.mail-archive.com/moderators@documentfoundation.org/">http://www.mail-archive.com/moderators@documentfoundation.org/</a><br>
GMANE: <a href="http://dir.gmane.org/gmane.comp.documentfoundation.moderators">http://dir.gmane.org/gmane.comp.documentfoundation.moderators</a></li>
<li><b>test@documentfoundation.org:</b> Mailing list for testing the mailing list manager<br>
Subscription: <a href="mailto:test+subscribe@documentfoundation.org">test+subscribe@documentfoundation.org</a><br>

Digest subscription: <a href="mailto:test+subscribe-digest@documentfoundation.org">test+subscribe-digest@documentfoundation.org</a><br>
Archives: <a href="http://listarchives.documentfoundation.org/www/test/">http://listarchives.documentfoundation.org/www/test/</a><br>
Mail-Archive.com: <a href="http://www.mail-archive.com/test@documentfoundation.org/">http://www.mail-archive.com/test@documentfoundation.org/</a><br>
GMANE: <a href="http://dir.gmane.org/gmane.comp.documentfoundation.test">http://dir.gmane.org/gmane.comp.documentfoundation.test</a></li>
<hr>
<li><b>l10n@libreoffice.org:</b> Mailing list for people in charge of LibreOffice localization<br>

Subscription: <a href="mailto:l10n+subscribe@libreoffice.org">l10n+subscribe@libreoffice.org</a><br>
Digest subscription: <a href="mailto:l10n+subscribe-digest@libreoffice.org">l10n+subscribe-digest@libreoffice.org</a><br>
Archives: <a href="http://listarchives.libreoffice.org/www/l10n/">http://listarchives.libreoffice.org/www/l10n/</a><br>
Mail-Archive.com: <a href="http://www.mail-archive.com/l10n@libreoffice.org/">http://www.mail-archive.com/l10n@libreoffice.org/</a><br>
GMANE: <a href="http://dir.gmane.org/gmane.comp.documentfoundation.libreoffice.l10n">http://dir.gmane.org/gmane.comp.documentfoundation.libreoffice.l10n</a></li>
<li><b>users@libreoffice.org:</b> User support list for LibreOffice<br>

Subscription: <a href="mailto:users+subscribe@libreoffice.org">users+subscribe@libreoffice.org</a><br>
Digest subscription: <a href="mailto:users+subscribe-digest@libreoffice.org">users+subscribe-digest@libreoffice.org</a><br>
Archives: <a href="http://listarchives.libreoffice.org/www/users/">http://listarchives.libreoffice.org/www/users/</a><br>
Mail-Archive.com: <a href="http://www.mail-archive.com/users@libreoffice.org/">http://www.mail-archive.com/users@libreoffice.org/</a><br>
GMANE: <a href="http://dir.gmane.org/gmane.comp.documentfoundation.libreoffice.user">http://dir.gmane.org/gmane.comp.documentfoundation.libreoffice.user</a></li>
<li><b>website@libreoffice.org:</b> Discussions on maintaining and enhancing our website, wiki, planet and other infrastructure<br>

Subscription: <a href="mailto:website+subscribe@libreoffice.org">website+subscribe@libreoffice.org</a><br>
Digest subscription: <a href="mailto:website+subscribe-digest@libreoffice.org">website+subscribe-digest@libreoffice.org</a><br>
Archives: <a href="http://listarchives.libreoffice.org/www/website/">http://listarchives.libreoffice.org/www/website/</a><br>
Mail-Archive.com: <a href="http://www.mail-archive.com/website@libreoffice.org/">http://www.mail-archive.com/website@libreoffice.org/</a><br>
GMANE: <a href="http://dir.gmane.org/gmane.comp.documentfoundation.libreoffice.website">http://dir.gmane.org/gmane.comp.documentfoundation.libreoffice.website</a></li>
<li><b>documentation@libreoffice.org:</b> Group for people working on LibreOffice documentation and help system<br>

Subscription: <a href="mailto:documentation+subscribe@libreoffice.org">documentation+subscribe@libreoffice.org</a><br>
Digest subscription: <a href="mailto:documentation+subscribe-digest@libreoffice.org">documentation+subscribe-digest@libreoffice.org</a><br>
Archives: <a href="http://listarchives.libreoffice.org/www/documentation/">http://listarchives.libreoffice.org/www/documentation/</a><br>
Mail-Archive.com: <a href="http://www.mail-archive.com/documentation@libreoffice.org/">http://www.mail-archive.com/documentation@libreoffice.org/</a><br>
GMANE: <a href="http://dir.gmane.org/gmane.comp.documentfoundation.libreoffice.documentation">http://dir.gmane.org/gmane.comp.documentfoundation.libreoffice.documentation</a></li>
<li><b>marketing@libreoffice.org:</b> Mailing list for marketing and promoting LibreOffice<br>

Subscription: <a href="mailto:marketing+subscribe@libreoffice.org">marketing+subscribe@libreoffice.org</a><br>
Digest subscription: <a href="mailto:marketing+subscribe-digest@libreoffice.org">marketing+subscribe-digest@libreoffice.org</a><br>
Archives: <a href="http://listarchives.libreoffice.org/www/marketing/">http://listarchives.libreoffice.org/www/marketing/</a><br>
Mail-Archive.com: <a href="http://www.mail-archive.com/marketing@libreoffice.org/">http://www.mail-archive.com/marketing@libreoffice.org/</a><br>
GMANE: <a href="http://dir.gmane.org/gmane.comp.documentation.libreoffice.marketing">http://dir.gmane.org/gmane.comp.documentation.libreoffice.marketing</a></li>
<li><b>design@libreoffice.org:</b> LibreOffice Design Team mailing list covering user experience design and visual identity design<br>

Subscription: <a href="mailto:design+subscribe@libreoffice.org">design+subscribe@libreoffice.org</a><br>
Digest subscription: <a href="mailto:design+subscribe-digest@libreoffice.org">design+subscribe-digest@libreoffice.org</a><br>
Archives: <a href="http://listarchives.libreoffice.org/www/design/">http://listarchives.libreoffice.org/www/design/</a><br>
Mail-Archive.com: <a href="http://www.mail-archive.com/design@libreoffice.org/">http://www.mail-archive.com/design@libreoffice.org/</a><br>
GMANE: <a href="http://dir.gmane.org/gmane.comp.documentfoundation.libreoffice.design">http://dir.gmane.org/gmane.comp.documentfoundation.libreoffice.design</a></li>
<li><b>accessibility@libreoffice.org:</b> Accessibility discussions on LibreOffice<br>

Subscription: <a href="mailto:accessibility+subscribe@libreoffice.org">accessibility+subscribe@libreoffice.org</a><br>
Digest subscription: <a href="mailto:accessibility+subscribe-digest@libreoffice.org">accessibility+subscribe-digest@libreoffice.org</a><br>
Archives: <a href="http://listarchives.libreoffice.org/www/accessibility/">http://listarchives.libreoffice.org/www/accessibility/</a><br>
Mail-Archive.com: <a href="http://www.mail-archive.com/accessibility@libreoffice.org/">http://www.mail-archive.com/accessibility@libreoffice.org/</a><br>
GMANE: <a href="http://dir.gmane.org/gmane.comp.documentfoundation.libreoffice.accessibility">http://dir.gmane.org/gmane.comp.documentfoundation.libreoffice.accessibility</a></li>
<hr>
<li><b>projects@libreoffice.org:</b> Project coordination<br>

Subscription: <a href="mailto:projects+subscribe@libreoffice.org">projects+subscribe@libreoffice.org</a><br>
Digest subscription: <a href="mailto:projects+subscribe-digest@libreoffice.org">projects+subscribe-digest@libreoffice.org</a><br>
Archives: <a href="http://listarchives.libreoffice.org/www/projects/">http://listarchives.libreoffice.org/www/projects/</a><br>
Mail-Archive.com: <a href="http://www.mail-archive.com/projects@libreoffice.org/">http://www.mail-archive.com/projects@libreoffice.org/</a><br>
GMANE: pending</li>
<hr>
<li>There is also a <a href="http://lists.freedesktop.org/mailman/listinfo/libreoffice">development mailing list</a> available for those interested
in code contributions. This list is hosted by FreeDesktop.org.</li>

<li>If you are more comfortable with using forums, you can use our <a href="http://www.documentfoundation.org/nabble/">Nabble gateway</a>.</li>
</ul>

<h3>Local and Regional Mailing Lists</h3>

<p>To see local and regional mailing lists in your language, please <a href="http://wiki.documentfoundation.org/Local_Mailing_Lists">refer to the table in our wiki</a>.</p>

<h3>Keeping up with progress</h3>
<div id="contribute">
To be informed about the latest updates and releases of LibreOffice
send an empty mail to <a
href="mailto:announce+subscribe@documentfoundation.org">announce+subscribe@documentfoundation.org</a>
</div>

EOT;


print_page("Contribute", array("contribute", "summary"), 
   "Contribute to the Foundation", $content);

?>
