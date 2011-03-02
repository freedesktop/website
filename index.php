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

<h2>Donate</h2>
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
</div>
EOT;

print_page("Welcome", array("summary"), "Welcome to The Document Foundation!", $content);

?>
