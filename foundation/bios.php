<?php
require("../template.php");

function add_bio($cname, $name, $bio, $vspacer)
{
	$ret  =  "<tr valign=\"top\">\n";
	$ret .= "  <td valign=\"top\"><img src=\"images/$cname.jpeg\" width=\"100\" alt=\"$name\" /></td>\n";
	$ret .=  "<td><img src=\"images/spacer.png\" width=\"14\" height=\"135\" alt=\"\" /></td>\n";
	$ret .= "<td><b>$name</b><br />$bio</td>\n";
	if ($vspacer) {
		$ret .= "<tr><td><img src=\"/img/spacer.gif\" width=\"1\" height=\"8\" alt=\"\" /></td><td /><td /></tr>\n";
	}
	return $ret;
}

$content = <<<"EOT"
<p>LibreOffice has been contributed to by many people, past and present.</p>
<h3>Document Foundation Founders</h3>
<p>Here is a (still incomplete) list of those deeply involved in the creation
of the Document Foundation, and its steering committee.
</p>

<style type="text/css">
table, tbody, tfoot, thead, tr, th, td {
        margin: 0;
        padding: 0;
        border: 0;
        font-weight: inherit;
        font-style: inherit;
        font-size: 100%;
        font-family: inherit;
        vertical-align: baseline;
}
table { border-collapse: separate; border-spacing: 0; }
caption, th, td { text-align: left; font-weight:400; vertical-align: top;} }
</style>

<table cellpadding="0" cellspacing="0" border="0">
EOT;

$content .= add_bio ("schnabel", "Andr&eacute; Schnabel",
	"Andr&eacute; has been involved in the OpenOffice.org project since 2001.
       As volunteer he started with user support, documentation and
       quality assurance. He has co-lead the germanophone project as
       well as been project lead of the Quality Assurance project and
       member of the Community Council for several years. <br />
       Andr&eacute; is also a founding member and Chairman of the board
       of the German non-profit OpenOffice.org Deutschland e.V.",
       1);

$content .= add_bio ("behrens", "Thorsten Behrens", 
	 "Thorsten was part of OpenOffice.org almost from the start, when he
	 joined the then-Sun-Microsystems development team back in early 2001.<br />
	 He's a computer scientist by education, and a Free Software enthusiast by
	 heart, a geek from early childhood - and someone who was lucky enough
	 to turn a hobby into an occupation.<br />
	 During his now nine years of tenure in the project, he's spent most of
	 his time hacking the code, in areas ranging from build system, platform
	 abstraction libraries, Impress and Writer.<br />
	 Thorsten is currently co-lead of the graphical system layer project,
	 member of the OASIS ODF technical committee, the ECMA TC45, and
	 technical advisor on the ISO/IEC JTC 1/SC 34 working group 4.<br />
	 He's sponsored by Novell to work full-time on OpenOffice.org. missing", 1);

$content .= add_bio ("schultz", "Charles-H. Schulz",
	"Charles-H. Schulz (The \"H\" letter standing for his second name \"Henri\")
	is a French technologist, Free Software and Open Standards advocate. As
	a long time contributor to the OpenOffice.org project he helped grow
	its community from a few mostly european communities to over a hundred
	communities and teams of various sizes. In the end of 2009 he was
	elected at the Community Council of the OpenOffice.org project. He is
	currently the lead of the Native-Language Confederation and a member
	of the Community Council. He also contributed to the development and
	adoption of the OpenDocument Format standard through the company he
	co-founded, Ars Aperta. Member of several international organizations
	he helped to create the Digital Standards Group and is part of the
	OASIS standards consortium, of which he is now one of the directors.",
	1);

$content .= add_bio ("noack", "Christoph Noack",
		"Christoph Noack had his first experience with one of the predecessors
	of OpenOffice.org in the ages of DOS. Since that time, he got a strong supporter
	of both the software and the idea of open-source in general. He is happy to
	represent the community thanks to his election to serve as one of the Product
	Development Representatives in the OpenOffice.org Community Council. Christoph
	has also lead Co-Lead of the OpenOffice.org User Experience team that aims to
	make a great piece of software for all the different users. Within that team, he
	actively contributed to the development of several features to improve the overall
	usability of the software. And also in his day job, he works in the field of
	Human-Machine interaction, but this case he works for a German consumer goods
	company.", 1);

$content .= add_bio ("filho", "Claudio Filho", "missing", 1);
$content .= add_bio ("nows", "Cor Nows", "missing", 1);
$content .= add_bio ("stone", "Dani Stone", "missing", 1);
$content .= add_bio ("dozza", "Davide Dozza", "missing.", 1);

$content .= add_bio ("effenberger", "Florian Effenberger",
	 "Florian Effenberger has been an open source evangelist for many years. He
	 is lead of the international OpenOffice.org marketing project as well as
	 a member of the management board of the non-profit OpenOffice.org Deutschland
	 e.V. He has ten years' experience of designing enterprise and educational
	 computer networks, including software deployment based on free software.
	 He is also a frequent contributor to a variety of professional magazines
	 worldwide on topics such as free software, open standards and legal matters.", 1);

$content .= add_bio ("guatier", "Sophie Gautier",
	 "I've been deeply involved in the OpenOffice.org Community since its very
	 beginning in 2000. First I participated to the Documentation Project,
	 then I've became the lead of the French-speaking project from 2002 to 2007,
	 then the co-lead from 2009 until now. I've represented the Native Language
	 Confederation at the Community Council since its launch until last year.
	 Now I'm managing the French localization of the OOo product and satellite
	 sites and participating to QA, Documentation, User Support and Marketing.<br />
	 In my daily job, I've worked as an OpenOffice.org consultant and trainer first
	 my own, then for the Linagora Group from 2006 to 2010 and I'm currently
	 unemployed.", 1);

$content .= add_bio ("hallot", "Olivier Hallot",
	"Graduated Electronic Engineer in 1982, MSc in Digital Signal Processing in 1985
	and MBA in Oil&Gas industry in 2001. I initiated my career as Assocate
	Researcher for digital signal processing in the IBM Scientific Center in
	Brasilia, Brazil, for the Oil&Gas industry in seismic data processing and
	high performance computing. Later I moved to marketing and sales for the
	same industry all over Latin America. In 1998 I joined Oracle Brazil in sales
	for the Oil& Gas industry and later as Alliance relationship manager for
	large hardware manufacturers as well as with the Oracle academic
	initiative. Since 2002 and on my own, I have participated actively in
	FLOSS projects notably in OpenOffice.org as one of the translators for
	Brazilian Portuguese and volunter CFO of BrOffice.org NGO. I am now senior
	consultant in OpenOffice.org technology for large corporations on migration
	projects.", 1);

$content .= add_bio ("rahemipour", "Jacqueline Rahemipour", "missing", 1);

$content .= add_bio ("kendy", "Jan Holesovsky",
	 "Jan, as a Free Software enthusiast, was aware of OpenOffice.org from the
	 moment it was open-sourced, but his real involvement and contribution
	 started in 2003. First as a volunteer, then as a Novell employee, he
	 did lots of integration work between OpenOffice.org and KDE3, and became
	 the KDE.OpenOffice.org project lead. Later he focused on x86-64 porting,
	 and significantly helped to make OpenOffice.org a good citizen on that
	 platform. He was also involved in filter work, and build and source code
	 management problems. From 2009, he leads the Novell OpenOffice.org team.<br />
	 Before he joined OpenOffice.org, he graduated from the Charles University,
	 and worked as a YaST2 developer during the studies. His first experience
	 with developing office software dates back to 1998-9 when he programmed
	 the drawing part of KTTV, a Linux word processor and a vector drawing
	 program for lecture notes.", 1);

$content .= add_bio ("corrius", "J&eacute;sus Corrius", "missing", 1);

$content .= add_bio ("lodahl", "Leif Lodhal",
	 "Leif has been an active member of the Danish project for more than
	  seven years and lead of the project since 1995.<br />
	 He has worked primarily in Denmark promoting OpenOffice.org and
	 as an implementation consultant.<br />
	 He is one of the initiaters of the Certification project.<br />
	 He currently serves as a Deputy to the OpenOffice.org Community Council
	 (Native Lang Representative)", 1);

$content .= add_bio ("mccreesh", "John McCreesh", "missing", 1);

$content .= add_bio ("mcnamara", "Caol&aacute;n McNamara",
	 "Caol&aacute;n is a Senior Software Engineer at Red Hat, Inc, and has
	 over 10 years experience in developing OpenOffice.org. Starting 2000
	 in Hamburg as an employee of Sun Microsystems developing StarOffice
	 before its subsequent release under the LGPL as OpenOffice.org later
	 that year. From 2000 to 2005 Caolán specialized in improving the
	 binary MSWord import/export filters, building on his prior experience
	 developing libwv, libwmf and other free software projects to parse
	 Microsoft binary file formats.<br />
	From 2005 to present Caol&aacute;n has been employed full-time by Red Hat,
	Inc. to maintain, improve and enhance OpenOffice.org, typically
	focusing on GNOME desktop integration, font and glyph replacement,
	Indic text layout, linguistic components, tooling to improve overall
	code quality, debugging the type of problems no one wants to touch,
	while retaining an interest in MSOffice compatibility.", 1);

$content .= add_bio ("meeks", "Michael Meeks",
	 "Michael is a Christian and enthusiastic believer in Free software.
	 His long involvement with OpenOffice.org starts before it was open
	 sourced, working with Sun to see how best to integrate it into the
	 Linux Desktop. OpenOffice.org replaced his previous passion: the
	 gnumeric spreadsheet and its interoperability. Michael has lead, and
	 helped to grow OpenOffice.org investment through Ximian, to Novell. He
	 has contributed code to many of the components of the suite, and is
	 excited about the future of the code.<br />
	 In other roles, he has contributed to MeeGo, GNOME, CORBA, Nautilus,
	 Evolution and accessibility, amongst many other interesting things.<br />
	 Before all this, he enjoyed working for Quantel gaining expertise in
	 real time software and high performance custom hardware for real time
	 Audio / Video editing and playback.", 1);

$content .= add_bio ("engelhard", "Rene Engelhard", "missing", 1);

$content .= add_bio ("krumbein", "Thomas Krumbein", "missing", 1);

$content .= add_bio ("dippold", "Bernhard Dippold", "missing", 1);

$content .= add_bio ("vignoli", "Italo Vignoli", "missing", 1);

$content .= <<<"EOT"
</table>

<h3>LibreOffice Developers</h3>

<b>I plan to insert the mug-shot gallery and names of all those who
have contributed to go-oo over the years here ...</b>

<p>While many more individuals and companies have contributed code
to LibreOffice, these individuals went beyond the call of duty to
contribute code over the years, and their work and friendship is
much appreciated:</p>

<center><img src="images/developers-grayscale.png" /></center><br/>
<p><i>From top left: Andreas Proschofsky, Bernhard Rosenkraenzer, Cedric Bosdonnat, David Frazer, Dhananjay Keskar, Donna Hertel\nEric Ward, Federico Mena Quintero, Fong Lin, Fridrich Strba, Giuseppe Ghibò, Hubert Figuiere\nJakub Steiner, Jan Holesovsky, Jan Nieuwenhuizen, Jiao Jianhua, Jody Goldberg, Kai Backman\nKalman "KAMI" Szalai, Kohei Yoshida, Martin Kretzschmar, Matthias Klose, Michael Meeks, Mike Leibowitz\nMiklos Vajna, Noel Power, Petr Mladek, Radek Doulik, Rene Engelhard, Silvan Calarco\nThorsten Behrens, Tor Lillqvist, Volker Quetschke, Wei Ming Khoo, Yin, ZhangYun.</i></p>
<p>Mail <a href="mailto:michael.meeks@novell.com">me</a> if you are
missing from here (include a 58x78pixel image too)</p>
EOT;


print_page("Developers", array("developers", "summary"), 
   "Get Involved! Developer information", $content);

?>

