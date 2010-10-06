<?php
require("../template.php");

$content = <<<"EOT"

<p>
Verantwortlich für den Inhalt dieser Webseite ist<br>
Responsible for the content of this website is
</p><p>
OpenOffice.org Deutschland e.V.<br>
Riederbergstr. 92<br>
65195 Wiesbaden<br>
Deutschland/Germany<br>
</p><p>
e-mail: <a href="mailto:info@ooodev.org">info@ooodev.org</a><br>
web: <a href="http://www.ooodev.org">http://www.ooodev.org</a>
</p>
<p><p>
Vertretungsberechtigter Vorstand/Board of Directors:<br>
Thomas Krumbein (Vorsitzender), 
Jacqueline Rahemipour, Florian Effenberger (Anschrift jeweils wie oben)<br>
Registergericht: Amtsgericht Wiesbaden<br>
Registernummer: VR 3850<br>
Steuernummer: 043 250 78217<br>
</p>

<h3>Disclaimer</h3>
<p>Despite toroughly testing of external websites we are not liable for the content of linked websites. 
Only the provider of the respective website is liable for it's contents.
</p>

<h3>Privacy statement</h3>
<p>For information about data privacy, please refer to our
<a href="privacy_policy.html">Privacy Policy</a>.</p>

 
<h3>Haftungshinweis</h3>
<p>Trotz sorgfältiger inhaltlicher Kontrolle übernehmen wir keine Haftung für die Inhalte externer 
Links. Für den Inhalt der verlinkten Seiten sind ausschließlich deren Betreiber verantwortlich.

<h3>Datenschutzerklärung</h3>
<p>Bitte lesen Sie hierzu unsere ausführliche, eigenständige Seite zum 
<a href="privacy_policy.html#german">Datenschutz</a>.</p>


EOT;

print_page("Imprint", array("summary", "summary"),
	   "Imprint", $content);
?>
