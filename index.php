<?php
require("template.php");

$content = <<<EOT

	<div id="download">
		<a href="/download/">
	  <img id="home_oo_image" src="img/thumb_go-oox-pptx.png" /><br />
		<a href="/download/">Download</a>
	</div>
    <h3>Better interoperability</h3>
    <p>
	Go-oo has built in <a href="/discover/#docx-support">OpenXML</a>
	import filters and it will import your
	Microsoft <a href="/discover/#ms-works-import">Works</a> files.
	Compared with up-stream OO.o, it has
	better Microsoft binary file support (with eg. <a
	href="/discover/#fields-support">fields</a>
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
	We also integrate with your system better by default: eg. enabling
	native file-selectors on Linux.
    </p>

    <h3>A Faster application</h3>
    <p>
	From first-time startup, where we sort I/O to reduce seek cost,
	to a highly optimised second start application and a systray <a
	href="/discover/#quickstarter">quick-starter</a> on Linux we
	are faster.
	We use less memory than up-stream, we link faster, use better
	system allocators, and don't waste so much time &amp; memory in
	the registry. Go-oo performance is hard to beat.
    </p>
    
    <h3>Faster code integration</h3>
    <p>
	Contributing code to go-oo is simple, and fast, following the
	traditional hackers' process of peer code review: just mail
	patches to the <a href="http://lists.freedesktop.org/mailman/listinfo/ooo-build">
	mailing list</a>, or when we get used to your code - commit your
	patch immediately to HEAD ooo-build: no CWS, no hours of tagging,
	paperwork, no specification, no hassle. Of course - if
	your patch sucks - expect to hear how it can be improved.
    </p>

    <h3>Freer licensing</h3>
    <p>
	For the code to live, grow and improve, to encourage participation and
	compete with the other office suite - we need sensible licensing: ie.
	weak copy-left. While in general we think LGPLv3 is a great &amp; sufficient
	license for our code, others eg. <a
	href="http://wiki.services.openoffice.org/wiki/ESC_minutes#Inclusion_of_non-Sun-owned_components">
	Sun</a> &amp; <a
	href="http://council.openoffice.org/files/documents/126/4135/OOoAdvisoryBoard_01Nov2007_MeetingNotes_v4.pdf">
	IBM</a> appear reluctant to include LGPL code into their products, and prefer
	other licenses such as the CDDL (a weak copy-left derived from Mozilla's MPL).
	Luckily dual licensing under the LGPLv3 / CDDL can help here - and we recommend
	this for the majority of our code.
    </p>
    <p>
	We believe that copyright assignment to a single corporate entity opens
	the door for substantial abuse of the best-interests of the codebase
	and developer community. As such, we prefer either eclectic ownership
	(cf. Mozilla, GNOME, KDE, Linux), or an independent, meritocratic foundation
	(cf. Eclipse, Apache) to own the rights. Having said that we recognise and
	applaud Sun's technical contribution to OpenOffice and recommend
	that small patches &amp; fixes to existing Sun code should be assigned to
	them under the SCA, and up-streamed.
    </p>

    <h3>Freer politics</h3>
    <p>
	Go-oo is a developer run meritocracy. If you want to contribute something
	concrete: code, bug fixes, bug triage, significant translation, build-bot
	maintainance etc. then there is a place for you as a key part of the
	team. If instead, you want to market Go-oo, install it, talk about it -
	that's really excellent, but this is not our focus: there are no formal
	roles in development to reflect this valuable work.
    </p>
EOT;

print_page("Go-OO!", array("summary"),
		   "Your Office Suite",
		   $content);

?>