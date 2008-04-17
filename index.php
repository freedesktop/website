<?php
require("template.php");

$content = <<<EOT
    <p id="download">
      <a href="/download/">Download OpenOffice.org</a>
    </p>
    <p>
        With word processing, spreadsheets,
        presentations, and everything else needed
        for creating and editing documents,
        OpenOffice.org has the tools it takes to
        create, edit, and share work.  It's open
        source and cross-platform, so it's free
        and works on your computer.
    </p>
    <h2>Better</h3>
    <ul>
        <li>Better interoperability: 
          <a href="/discover/#ms-works-import">MS-Works Import</a>,
          <a href="/discover/#vba-support">VBA support</a>,
          <a href="http://noelpower.blogs.ie/2008/04/17/is-it-possible-to-support-vba-userforms/">VBA user forms</a>,
          <a href="/discover/#wp-graphics-import">WordPerfect Graphics Import</a>
        </li>
        <li>Better functionality:
          <a href="/discover/#calc-solver">Calc Solver</a>,
          <a href="/discover/#chinese-rendering">Chinese Text Grid Rendering</a>,
          <a href="/discover/#emf-rendering">EMF Rendering</a>,
          <a href="/discover/#gstreamer">GStreamer integration</a>
        </li>
    </ul>

    <h2>Faster</h3>
    <ul>
        <li>Faster startup:
          <a href="/discover/#startup-performance">Startup Performance</a>
        </li>
        <li>Faster code integration</li>
    </ul>

    <h2>Freer</h3>
    <ul>
        <li>Freer licensing: no requirement to sign the JCA or the SCA</li>
        <li>Freer politics</li>
    </ul>
EOT;

print_page("Go-OO!", array("summary"),
		   "go-oo",
		   $content);

?>
