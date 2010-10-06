<?php
require("../template.php");

$vspacer = <<<EOT
	<tr><td><img src="/img/spacer.gif" width="1" height="4" alt=""></td><td><td></tr>
EOT;

$content = <<<"EOT"

<h3>Our Mission</h3>
<p>
Our mission is to facilitate the evolution of the OpenOffice.org Community into a new open, independent, 
and meritocratic organizational structure within the next few months. An independent Foundation is a 
better match to the values of our contributors, users, and supporters, and will enable a more effective, 
efficient, transparent, and inclusive Community. We will protect past investments by building on the solid 
achievements of our first decade, encourage wide participation in the Community, and co-ordinate 
activity across the Community. 
</p>

<h3>Our Team</h3>
<p>Here is a (still incomplete) list of those deeply involved in the creation
of the Document Foundation, and its steering committee.
</p>

<style type="text/css">
.foundationtable table, tbody, tfoot, thead, tr, th, td {
        margin: 0;
        padding: 0;
        border: 0;
        font-weight: inherit;
        font-style: inherit;
        font-size: 100%;
        font-family: inherit;
        vertical-align: baseline;
}

.foundationtable table { 
        border: 0;
	border-collapse: separate;
	border-spacing: 0;
}

.foundationtable caption, th, td { 
	text-align: left; 
	font-weight:400; 
	vertical-align: top;
}

.foundationtable tr, td { 
	padding-bottom: 28px;
}

.foundationtable th { 
	height: 40px; 
	padding: 6px; 
	vertical-align: middle; 
	font-size: 140%;
}

.foundationtable td p { 
	padding-top: 6px; 
	padding-bottom: 0; 
	margin: 0; 
	border: 0;
}

.foundationtable p.roles {
	font-variant:small-caps
}
</style>

<div class="foundationtable">
<table class="foundationtable"><tbody>
<tr><th colspan=2><a name="sc"></a>Steering Committee Members</th></tr>
$vspacer

<!-- Alphabetically sorted -->

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Schnabel_Andre.jpg">
		<img src="images/TDF_Schnabel_Andre_gray_small.jpg" alt="André Schnabel" width="100" >
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>André Schnabel</b>
		<p class="roles">
		Coordinator for German localization, former Project Lead QA Project, former Community Council Member for accepted projects category
		</p><p>
		André is involved in the OpenOffice.org project since 2001. Being a software developer in 
		his professional live he focused his voluntary work for OpenOffice.org on user support, 
		documentation and quality assurance. He has been Co-Lead of the Germanophone project as 
		well as project lead of the Quality Assurance project and member of the Community Council 
		for several years. Today he is maintaining the German localization and working on a 
		translation process based on open standards. André is also founding member and chairman 
		of the advisory board of the German non-profit OpenOffice.org Deutschland e.V. 
	   </p>
	</td>
</tr>
$vspacer

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_McNamara_Caolan.jpg">
		<img src="images/TDF_McNamara_Caolan_gray_small.jpg" alt="Caolán McNamara" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Caolán McNamara</b>
		<p class="roles">
		former Writer Project co-lead and member of the OpenOffice.org Engineering Steering Committee
		</p><p>
		Caolán is a Senior Software Engineer at Red Hat, Inc, and has over 10 years experience 
		in developing OpenOffice.org. Starting 2000 in Hamburg as an employee of Sun Microsystems 
		developing StarOffice before its subsequent release under the LGPL as OpenOffice.org later 
		that year. From 2000 to 2005 Caolán specialized in improving the the binary MSWord import/export 
		filters, building on his prior experience developing libwv, libwmf and other free software 
		projects to parse Microsoft binary file formats.
		<br>
		From 2005 to present Caolán has been employed full-time by Red Hat, Inc. to maintain, improve
		and enhance OpenOffice.org, typically focusing on GNOME desktop integration, font and glyph
		replacement, Indic text layout, linguistic components, tooling to improve overall code quality,
		debugging the type of problems no one wants to touch, while retaining an interest in MSOffice
		compatibility.
	   </p>
	</td>
</tr>
$vspacer

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Schulz_Charles-H.jpg">
		<img src="images/TDF_Schulz_Charles-H_gray_small.jpg" alt="Charles-H. Schulz" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Charles-H. Schulz</b>
		<p class="roles">
		NLC Lead, Community Council Member (Lang Representative)
		</p><p>
		Charles-H. Schulz (The "H" letter standing for his second name "Henri") is a 
		French technologist, Free Software and Open Standards advocate. As a long time
		contributor to the OpenOffice.org project he helped grow its community from a few 
		mostly european communities to over a hundred communities and teams of various sizes. 
		In the end of 2009 he was elected at the Community Council of the OpenOffice.org project.
		He is currently the lead of the Native-Language Confederation and a member of the 
		Community Council. He also contributed to the development and adoption of the OpenDocument 
		Format standard through the company he co-founded, Ars Aperta. Member of several international
		organizations he helped to create the Digital Standards Group and is part of the OASIS 
		standards consortium, of which he is now one of the directors. 
	   </p>
	</td>
</tr>
$vspacer

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Effenberger_Florian.png">
		<img src="images/TDF_Effenberger_Florian_gray_small.png" alt="Florian Effenberger" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Florian Effenberger</b>
		<p class="roles">
		Marketing Project Lead and German MarCon, Board of Directors OpenOffice.org Deutschland e.V. 
		</p><p>
		Florian Effenberger has been an open source evangelist for many years. He is 
		lead of the international OpenOffice.org marketing project as well as a member 
		of the management board of the non-profit organization OpenOffice.org 
		Deutschland e.V. He has ten years of experience in designing computer 
		networks in enterprises and educational settings. This includes software 
		deployment based on free software. He is also a frequent contributor to a 
		variety of professional magazines worldwide on topics such as free software, 
		open standards and legal matters.
	   </p>
	</td>
</tr>
$vspacer

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Gautier_Sophie.jpg">
		<img src="images/TDF_Gautier_Sophie_gray_small.jpg" alt="Sophie Gautier" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Sophie Gautier </b>
		<p class="roles">
		Francophone project co-lead, former Project Lead Education Project, former Community Council Member for Native Lang projects category
		</p><p>
		I've been deeply involved in the OpenOffice.org Community since its very beginning in 2000. 
		First I participated to the Documentation Project, then  I've been the lead of the French-speaking 
		project from 2002 to 2007, then the co-lead in 2009 until now. I've represented the Native 
		Language Confederation at the Community Council since its launch until last year. 
		Now I'm managing the French localization of the OOo product and satellite 
		sites and participating to QA, Documentation, User Support and Marketing.<br>
		In my daily job, I've worked as an OpenOffice.org consultant and trainer on my own first, 
		then for the Linagora Group from 2006 to 2010 and I'm currently unemployed.
		</p>
	 </td>
</tr>
$vspacer

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Vignoli_Italo.jpg">
		<img src="images/TDF_Vignoli_Italo_gray_small.jpg" alt="Italo Vignoli" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Italo Vignoli</b>
		<p class="roles">
		Italian MarCon, President of Associazione PLIO (Italian National Language Project) 
		</p><p>
		Italo Vignoli is president of PLIO, OpenOffice.org Italian National Language 
		Project, a not for profit association that represents the community of volunteers 
		who promote the free office productivity suite. In everyday life, is partner and 
		president of Quorum PR, a public relations agency with a strong bias to the integration
		of traditional media and social network. He has almost thirty years of experience in 
		marketing and communication of high-tech companies in Italy and at international level, 
		and is responsible for the social networks practice within the Italian Federation of Public
		Relations. Since 1984, it is connected to the network with a portable PC and a messaging or
		e-mail system despite a degree in humanities from the University of Milan, where he has been
		a researcher on urban geography. He is working as a freelance journalist since 1972, writing 
		about sports, music and IT. He blogs in Italian about libre software at 
		<a href="http://www.cwi.it/blogs/sistemaperto/">http://www.cwi.it/blogs/sistemaperto/</a>. 
	   </p>
	</td>
</tr>
$vspacer

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Hallot_Olivier.jpg">
		<img src="images/TDF_Hallot_Olivier_gray_small.jpg" alt="Olivier Hallot" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Olivier Hallot</b>
		<p class="roles">
		BrOffice.org CFO, Community Council Member, Main translator for pt-BR 
		</p><p>
		Graduated Electronic Engineer in 1982, MSc in Digital Signal Processing in 1985
		and MBA in Oil &amp; Gas industry in 2001. He initiated his career as Associate
		Researcher for digital signal processing in the IBM Scientific Center in
		Brasilia, Brazil, for the Oil &amp; Gas industry in seismic data processing and high
		performance computing. Later he moved to marketing and sales for the same
		industry all over Latin America. In 1998 he joined Oracle Brazil in sales for
		the Oil &amp; Gas industry and later as Alliance relationship manager for large
		hardware manufacturers as well as with the Oracle Academic Initiative. Since
		2002 and on his own, he participated actively in FLOSS projects notably in
		OpenOffice.org as one of the translators for Brazilian Portuguese and volunter
		CFO of BrOffice.org NGO. He is now senior consultant in OpenOffice.org
		technology for large corporations on migration projects. 
	   </p>
	</td>
</tr>
$vspacer

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Behrens_Thorsten.jpg">
		<img src="images/TDF_Behrens_Thorsten_gray_small.jpg" alt="Thorsten Behrens" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Thorsten Behrens</b>
		<p class="roles">
		GSL Project co-lead, OASIS ODF TC / ECMA TC45 / ISO SC34 WG4 participant
		</p><p>
		Thorsten was part of OpenOffice.org almost from the start, when he joined the then-Sun-Microsystems 
		development team back in early 2001. He's a computer scientist by education, and a Free Software 
		enthusiast by heart, a geek from early childhood - and someone who was lucky enough to turn a hobby 
		into an occupation.<br>
		During his now nine years of tenure in the project, he's spent most of his time hacking the code, 
		in areas ranging from build system, platform abstraction libraries, Impress and Writer. Thorsten is 
		currently co-lead of the graphical system layer project, member of the OASIS ODF technical 
		committee, the ECMA TC45, and technical advisor on the ISO/IEC JTC 1/SC 34 working group 4.<br>
		He's sponsored by Novell to work full-time on OpenOffice.org. 
	   </p>
	</td>
</tr>
$vspacer


<tr><th colspan=2><a name="deputies"></a>Steering Committee Deputies</th></tr>
$vspacer

<!-- Again alphabetically sorted ... -->

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Noack_Christoph.jpg">
		<img src="images/TDF_Noack_Christoph_gray_small.jpg" alt="Christoph Noack" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Christoph Noack</b>
		<p class="roles">
		OpenOffice.org User Experience Team Co-Lead, OpenOffice.org Community Council Member (Product Development Representative) 
		</p><p>
		Christoph Noack made his first experiences with one of the predecessors of OpenOffice.org 
		in the ages of DOS. Since that time, he got a strong supporter of both the software and 
		the idea of open-source in general. He is happy to represent the community thanks to 
		his election to serve as one of the Product Development Representatives in the OpenOffice.org 
		Community Council. Christoph is also the Co-Lead of the User Experience team that aims to
		make OpenOffice.org a great piece of software for all the different users. Within that team, 
		he actively contributed to several feature developments to improve the overall usability of
		the software. And also in his day job, he works in the field of Human-Machine interaction,
		but this case he works for a German consumer goods company. 
	   </p>
	</td>
</tr>

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Filho_Claudio_gray.jpg">
		<img src="images/TDF_Filho_Claudio_gray_small.jpg" alt="Claudio Filho" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Claudio Filho</b>
		<p class="roles">Project Lead of Brazilian Project and BrOffice.org Project Founder 
		</p><p>
		Claudio is involved in the OpenOffice.org project since 2001. Majored in Industrial Chemistry 
		at UFRGS in 1994 and System Information in 2004. He founded the OpenOffice.org community in Brazil, 
		now called BrOffice.org, Mozilla Brazil and PostgreSQL Brazil, all entities that maintain and 
		support the promotion and the translation of its apps in Brazil. Nowadays, works as consultant 
		for FLOSS products into IT Board Development of National Social Security, and CIO of BrOffice.org NGO. 
		</p>
	</td>
</tr>

<tr>
	<td style="padding-top:1.5em">
		<img src="images/TDF_Cor_Nouws_gray_small.jpg" alt="Cor Nouws" width="100">
	</td>
	<td style="padding-left: 14px">
		<b>Cor Nouws</b>
		<p class="roles">
		Community Council member
		</p><p>
		Cor Nouws is an active member of the OpenOffice.org community since 2004,
	involved mainly in testing, localisation and marketing. He also maintains some
	extensions on the OpenOffice.org repository and is one of the Marcons for the
	Dutch speaking Native Language community. He was chosen as community
	representative for the Community Council in 2008.<br>
	Cor Nouws is founder of the Dutch based firm Nou&amp;Off, offering training and
	migrations, extensions and consultancy for OpenOffice.org. 		
	   </p>
	</td>
</tr>
$vspacer

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Dozza_Davide.jpg">
		<img src="images/TDF_Dozza_Davide_gray_small.jpg" alt="Davide Dozza" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Davide Dozza</b>
		<p class="roles">
		Project Lead Italian Project
		</p><p>
		Bio: he received the Dr.Eng. and the Ph.D. degree from the University of
	Bologna, Italy, in 1985 and 2000 respectively. After working at R&amp;D Department
	at Datalogic, Italy, he joined the University of Bologna as Ph.D. Student
	collaborating with ST Microelectronics on research on integrated circuit modeling
	and design. In 2000 he founded Yacme, Bologna a company focused in delivering
	professional services on Open Source Software. Since 2001 he is maintainer of
	OpenOffice.org Italian Native Lang Project. In 2006 he founded the PLIO
	association which received the ONG status from Friuli Venezia Giulia region.
	At the moment is working as senior consultant for Yacme on OpenOffice.org
	migration projects.
	   </p>
	</td>
</tr>
$vspacer

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Lodahl_Leif.jpg">
		<img src="images/TDF_Lodahl_Leif_gray_small.jpg" alt="Leif Lyngby Lodahl" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Leif Lyngby Lodahl</b>
		<p class="roles">
		Project Lead Danish native lang project, OpenOffice.org Community Council Deputy (Native Lang Representative)
		</p><p>
		I worked for more than ten years in financial business. In 1998 I moved to IT as project 
		manager and in 2000 I became a consultant working with Lotus Software. I worked with 
		IBM Lotus for ten years as project manager and with teaching developers and end users. 
		Since may 2009 I have been working full time with open source software - primarily OpenOffice.org. 
	   </p>
	</td>
</tr>
$vspacer

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Meeks_Michael.jpg">
		<img src="images/TDF_Meeks_Michael_gray_small.jpg" alt="Michael Meeks" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Michael Meeks</b>
		<p class="roles">
		Novell / Linux Desktop Architect
		</p><p>
		Michael is a Christian and enthusiastic believer in Free software.
		His long involvement with OpenOffice.org starts before it was open
		sourced, working with Sun to see how best to integrate it into the
		Linux Desktop. OpenOffice.org replaced his previous passion: the
		gnumeric spreadsheet and its interoperability. Michael has lead, and
		helped to grow OpenOffice.org investment through Ximian, to Novell. He
		has contributed code to many of the components of the suite, and is
		excited about the future of the code.<br>

		In other roles, he has contributed to MeeGo, GNOME, CORBA, Nautilus,
		Evolution and accessibility, amongst many other interesting things.<br>

		Before all this, he enjoyed working for Quantel gaining expertise in
		real time software and high performance custom hardware for real time
		Audio / Video editing and playback. 
	   </p>
	</td>
</tr>
$vspacer


<tr><th colspan=2><a name="founding"></a>Other Founding Members</th></tr>
$vspacer

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Poeml_Peter.jpg">
		<img src="images/TDF_Poeml_Peter_gray_small.jpg" alt="Peter Pöml" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Peter Pöml</b>
		<p class="roles">
		MirrorBrain Developer 
		</p><p>
As specialist for downloads and content delivery, I came to the OpenOffice.org community in 2009 to help modernizing the mirror distribution network. I introduced MirrorBrain, a content distribution software that is also used by the FSF, openSUSE, Sugar Labs and other organizations. With the Document Foundation I have been involved in building the new mirror network from the start. Despite my background of degree of a medical doctor I have been working full-time with many Open Source communities since the year 2000, in particular in the Linux and Apache world. 
	   </p>
	</td>
</tr>

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Rahemipour_Jacqueline.jpg">
		<img src="images/TDF_Rahemipour_Jacqueline_gray_small.jpg" alt="Jacqueline Rahemipour" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Jacqueline Rahemipour</b>
		<p class="roles">
		Co-Lead de.openoffice.org, Board of Directors OpenOffice.org Deutschland e.V. 
		</p><p>
		Jacqueline Rahemipour is Co-Lead of the germanophone OpenOffice.org project 
		since 2005 and member of the management board and founding member of the non-profit
		organisation OpenOffice.org Deutschland e.V. Her main working areas are quality 
		assurance, marketing and localisation. In her daily job she works as an OpenOffice.org 
		consultant and trainer. She published several books and articles on the topic
		of OpenOffice.org.
	   </p>
	</td>
</tr>
$vspacer

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Stoni_Daniel.jpg">
		<img src="images/TDF_Stoni_Daniel_gray_small.jpg" alt="Name" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Daniel Stoni</b>
		<p class="roles">
		founding member and chairman of the board of OpenOffice.org Switzerland Association, administrator for the Swiss Ubuntu LoCo team 
		</p><p>
		I carry along: ten years of IT experience (infrastructure services) at Credit Suisse 
		plus twelve years as Project Leader and Business Manager at IBM: of Sales, of Software
		Technical Support, of Project Services. I'm passionate about new technology, have high
		interest in overall IT efficiency, demonstrated customer insight and ability to coach
		individuals and teams to success. My particular assets are: insight into local OS market
		and swiss community work, good overview about OS products. 
	   </p>
	</td>
</tr>
$vspacer

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Corrius_Jesus.jpg">
		<img src="images/TDF_Corrius_Jesus_gray_small.jpg" alt="Jesús Corrius" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Jesús Corrius</b>
		<p class="roles">
		Catalan Native Lang Project Leader, Catalan L10N Project Leader 
		</p><p>
		Since 2000 has been the Catalan Native Lang Project Leader / L10N of OpenOffice.org
		and started to produce full builds of the suite in Catalan language downloaded 
		over the years by millions of people. In 2007 he was the main contact and responsible
		of the OpenOffice.org Conference 2007 in Barcelona (Spain) organized by Softcatalà.
		In 2009 successfully completed a Google Summer of Code (GSOC) project, mentored
		by Fridrich Strba, about cross-compiling the office suit.<br>

		Born near Barcelona in 1979, Jesús Corrius holds a degree in Computer Science and 
		another in Audiovisual Communication. He's a professional C++, Python software 
		developer and teaches Advanced Software Development in the Free Software Master
		at the Universitat Oberta de Catalunya (UOC). He's a member of Softcatalà, and 
		NGO dedicated to promote the use of the Catalan language in IT. 
	   </p>
	</td>
</tr>
$vspacer

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Holesovsky_Jan.jpg">
		<img src="images/TDF_Holesovsky_Jan_gray_small.jpg" alt="Jan Holešovský" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Jan Holešovský</b>
		<p class="roles">
		KDE.openoffice.org formal lead (not active any more)
		</p><p>
		Jan, as a Free Software enthusiast, is aware of OpenOffice.org from the moment it
		was open-sourced, but his real involvement and contribution started in 2003. First 
		as a volunteer, then as a Novell employee, he did lots of integration work between 
		OpenOffice.org and KDE3, and became the KDE.OpenOffice.org project lead. Later he focused 
		on x86-64 porting, and significantly helped to make OpenOffice.org a good citizen on that
		platform. He was also involved in filter work, and build and source code management problems.
		From 2009, he leads the Novell OpenOffice.org team.<br>
		Before he joined OpenOffice.org, he graduated from the Charles University, and worked 
		as a YaST2 developer during the studies. His first experience with developing office software
		dates back to 1998-9 when he programmed the drawing part of KTTV, a Linux word processor and
		a vector drawing program for lecture notes. 
	   </p>
	</td>
</tr>
$vspacer

<tr>
	<td style="padding-top:2.5em">
		<a href="images/TDF_Rene_Engelhard.jpg">
		<img src="images/TDF_Rene_Engelhard_gray_small.jpg" alt=" Rene Engelhard" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Rene Engelhard</b>
		<p class="roles">
		Debian Maintainer, OpenOffice.org tools maintainer
		</p><p>
			Rene has been a long term contributor to the openoffice.org project,
		and Debian Packager of OpenOffice.org, and many associated packages since 2002.
		He is a key contributor to the Engineering Steering Committee, and member
		of the German project. He is an expert on the build system, and maintains
		close scrutiny of both build, tooling, emerging Linux portability problems
		as well as licensing compliance.
	        </p>
	</td>
</tr>
$vspacer

<tr>
	<td style="padding-top:1.5em">
		<a href="images/TDF_Krumbein_Thomas.jpg">
		<img src="images/TDF_Krumbein_Thomas_gray_small.jpg" alt="Thomas Krumbein" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Thomas Krumbein</b>
		<p class="roles">
		Marketing Contact German Project, Chairman OpenOffice.org Deutschland e.V. 
		</p><p>
		Thomas Krumbein joined the OpenOffice.org project in 2001. As business-consultant
		he helps enterprises to swich over to open-source software since more then ten years. 
		He is part of the german marketing project and is one of the initiator of the non-profit
		OpenOffice.org Deutschland e.V., where he is still the chairman. He is also a frequent
		contributor to a variety of professional magazines, author of several OpenOffice.org
		related books and active involved in major migration projects. Specialized in custom
		adjustments and improvements using script languages he is one of the experts in UNO
		API in Germany.
	   </p>
	</td>
</tr>
$vspacer

<!-- take this as template>
<tr>
	<td style="padding-top:1.5em">
		<a href="images/Name.jpg">
		<img src="images/Name_gray_small.jpg" alt="Name" width="100">
		</a>
	</td>
	<td style="padding-left: 14px">
		<b>Name</b>
		<p class="roles">
		roles
		</p><p>
		bio
	   </p>
	</td>
</tr>
$vspacer
< -->
</table>
</div>

EOT;

print_page("Foundation", array("foundation", "summary"),
           "The Document Foundation", $content);
?>

