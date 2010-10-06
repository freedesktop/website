<?php
require("../template.php");

$urlbase="http://libreoffice.mirrorbrain.org";

$content = <<<"EOT"

<h3>Get Involved</h3>

<div id="contribute1">

<p>Come and join us! Subscribe to our mailing lists and support us with your skills! We need you for code development, testing, translation, documentation, design, marketing and many other tasks in our world-wide community!</p>

<p>For code contribution, have a look at our <a href="/develop/">Develop</a> page - for the available mailing lists, please refer to our <a href="/contact/">Contact</a> page.</p>
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
<p>PayPal: paypal@ooodev.org</p>
	<form action="https://www.paypal.com/de/cgi-bin/webscr" method="post">
	<p>
	<input name="cmd" value="_donations" type="hidden">
	<input name="business" value="paypal@ooodev.org" type="hidden">
	<input name="return" value="http://www.documentfoundation.org" type="hidden">
	<input name="undefined_quantity" value="0" type="hidden">
	<input name="item_name" value="Document Foundation" type="hidden">
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
	<input name="image_url" value="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" type="hidden">
	<input name="cancel_return" value="http://www.documentfoundation.org" type="hidden">
	<input name="no_note" value="0" type="hidden"><br><br>
	<input src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" name="submit" alt="PayPal secure payments." type="image">
	</p>
	</form>
<br>
<p>Bank account information:
<pre>OpenOffice.org Deutschland e.V.
IBAN: DE18 5465 1240 0000 9609 71
SWIFT-BIC: MALADE51DKH
Subject: Document Foundation</pre>
<p>
If you are living in Germany, you may also use <a href="http://www.ooodev.org/spenden.html">domestic bank transfer</a>.
<br>
</p>
<br>
</div>

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
