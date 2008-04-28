<?php
require("template.php");

$content = <<<EOT
    <h3>Better interoperability</h3>
    <p>
	Go-oo has built in OpenXML import filters, it will import your
	Microsoft <a href="/discover/#ms-works-import">Works</a> files.
	Compared to up-stream OO.o, it has
	better Microsoft binary file support (with eg. fields
	support), and it will import 
	<a href="/discover/#wp-graphics-import">WordPerfect</a>
	graphics beautifully. If you are reliant on Excel
	<a href="/discover/#vba-support">VBA</a> macros - then Go-oo
	offers the best macro fidelity too. If you expect your spreadsheets
	to calculate compatibly, or you get embedded Visio <a
	href="/discover/#emf-rendering">diagrams</a> in your documents,
	you'll want Go-oo.
    </p>

    <h3>Better functionality</h3>
    <p>
	Go-oo's user interface is more familiar, with lots of small pieces
	of polish. We have built-in (working) <a href="/discover/#gstreamer">
	multimedia</a> integration on Linux, a beautiful <a
	href="/discover/#calc-solver">solver</a> component, and your <a
	href="/discover/#chinese-rendering">Chinese</a> should look sane.
	We also integrate with your system better by default, enabling
	native file-selectors on Linux.
    </p>

    <h3>A Faster application</h3>
    <p>
	From first-time startup, where we sort I/O to reduce seek cost,
	to a highly optimised second start application and a systray <a
	href="/discover/#quickstarter">quick-starter</a> on Linux.
	We use less memory than up-stream, we link faster, use better
	system allocators, and don't waste so much time &amp; memory in
	the registry. Go-oo performance is hard to beat.
    </p>
    
    <h3>Faster code integration</h3>
    <p>
	Contributing code to go-oo is simple, and fast, following the
	traditional hackers' process of peer code review: just mail
	patches to the <a href="http://lists.go-oo.org/listinfo.cgi/dev-go-oo.org">
	list</a>, or if we like your code - commit your patch
	immediately to HEAD ooo-build: no CWS, no hours of tagging,
	paperwork, no specification, no beaurocracy. Of course - if
	your patch sucks - be prepared to hear about it.
    </p>

    <h3>Freer licensing</h3>
    <p>
	For the code to live, grow and improve, we need the ...
	Licensing / JCA etc.
    </p>

    <h3>Freer politics</h3>
    <p>
	Go-oo is a developer run meritocracy. If you want to contribute something
	concrete: code, bug fixes, bug triage, significant translation, build-bot
	maintainance etc. then there is a place for you to form a key part of the
	team. If instead, you want to market Go-oo, install it, talk about it -
	that's great too, but this is not our goal: there are no formal roles in
	the project for this work.
    </p>
    <div>
         <p><a href="/download/">Download OpenOffice.org</a></p>
    </div>
EOT;

print_page("Go-OO!", array("summary"),
		   "Your OpenOffice.org",
		   $content);

?>
