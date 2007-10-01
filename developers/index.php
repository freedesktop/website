<?php
require("../template.php");


// some unused HTML snippets.
/*
                <form method="get" action="http://bugzilla.novell.com/show_bug.cgi">
                    <a href="http://bugzilla.novell.com/query.cgi?format=advanced">Novell Issue</a> <a href="https://bugzilla.novell.com/enter_bug.cgi?product=OpenOffice.org+2.0">New</a> 
                    <input name="id" size="6"> 
                    <input type="submit" value="Find" class="hide">
                </form>
*/

// enter the content of the page here.
$content = <<<EOT
        <div id="dev-tools">
            <dl>
                <dt>LXR</dt>
                <dd>
                <form method="get" action="http://lxr.go-oo.org/ident">
                    <label>
                        <a href="http://lxr.go-oo.org/ident">Identifier</a>
                        <input type="text" name="i" value="" size="12">
                    </label>
                    <input type="submit" value="Find" class="hide">
                </form>
                <form method="get" action="http://lxr.go-oo.org/search">
                    <label>
                        <a href="http://lxr.go-oo.org/search">Text</a> 
                        <input type="text" name="string" value="" size="12"> 
                    </label>
                    <input type="submit" value="Find" class="hide">
                </form>
                <form method="get" action="http://lxr.go-oo.org/find">
                    <label>
                        <a href="http://lxr.go-oo.org/find">File</a> 
                        <input type="text" name="string" value="" size="8"> 
                    </label>
                    <input type="submit" value="Find" class="hide">
                </form>
                </dd>
                <dt>Bugzilla</dt>
                <dd>
                <form method="get" action="http://www.openoffice.org/issues/show_bug.cgi">
                    <a href="http://www.openoffice.org/issues/query.cgi">OO.o Issue</a> <a href="http://qa.openoffice.org/issue_handling/submission_gateway.html#code_module">New</a> 
                    <input name="id" size="6"> 
                    <input type="submit" value="Find" class="hide">
                </form>
                </dd>
            </dl>
        </div>
        <hr />
	<div id="quicklinks">
        <h4>Quick links</h4>
        <dl>
	<div class="leftcol">
            <dt>Development Tools</dt>
            <dd>
            <ul>
                <li><a href="http://lxr.go-oo.org/">LXR</a></li>
                <li><a href="http://bonsai.go-oo.org/cvsqueryform.cgi">Bonsai</a></li>
                <li><a href="http://tinderbox.go-oo.org/">Tinderbox</a></li>
            </ul>
            </dd>
            <dt>Hacker Guides</dt> 
            <dd>
            <ul>
                <li><a href="hackers-guide.html">English</a></li>
                <li><a href="hackers-guide-ja.html">Japanese</a> 1.1</li>
                <li><a href="hackers-guide-de.html">German</a> 1.1</li>
                <li><a href="http://babelfish.altavista.com/tr?doit=done&amp;url=http://go-oo.org/hackers-guide.html&amp;lp=?" target="new">Other</a></li>
                <li><a href="old-guides.html">Old</a></li>
            </ul>
            </dd>
	</div>
	<div class="rightcol">
            <dt>Resources</dt>
            <dd>
            <ul>
                <li><b><a href="http://wiki.services.openoffice.org/wiki/">Wiki</a></b></li>
                <li><a href="http://planet.go-oo.org/">Planet OO.o</a> &amp; <a href="http://planet.go-oo.org/rss20.xml">(rss)</a></li>
                <li><a href="tutorials/">Hackers Tutorials</a></li>
                <li><a href="cws.html">Hackers CWS howto</a> &amp; <a href="cws-quickhowto-ja.html">Japanese</a></li>
                <li><a href="http://wiki.services.openoffice.org/wiki/Ooo-build">About ooo-build</a></li>
                <li><a href="http://wiki.services.openoffice.org/wiki/Environment_Variables">Tweaking setting
		at runtime.</a></li>
                <li><a href="http://wiki.services.openoffice.org/wiki/DomainDeveloper">Who is Whom?</a></li>
                <li><a href="http://eis.services.openoffice.org/EIS2/servlet/GuestLogon">EIS</a></li>
                <li><a href="http://wiki.services.openoffice.org/wiki/Tinderbox_Setup">Tinderbox setup</a></li>
                <li>ooo-build <a href="http://download.go-oo.org/">source</a> &amp; <a href="ooo-build/patches">patches</a></li>
                <li><a href="/users/mgp/">MagicPoint users</a></li>
            </ul>
            </dd>
	    </div>
        </dl>
	</div>

	<hr />

	<div>
	<h5>Mailing List</h5>
	
	<p>There is a mailing for ooo-build development. 
	<a href="http://lists.go-oo.org/listinfo.cgi/dev-go-oo.org">More info</a> on
	how to subscribe or to read the archive. There is also the old mailing list 
	<a href="mailarchive/">archive</a>.</p>

	<h5>Tinderbox Build Status</h5>
        <p>Find an overview over the last tinderbox build results 
	<a href="http://go-oo.org/tinderbox/all_trees.express.html">here</a>.</p>
        <p>A list of the currently open tinderbox branches (CWSs and MWSs) can be 
	found <a href="http://tinderbox.go-oo.org">here</a>.</p>
        <p>For more information on branches, see the 
	<a href="http://development.openoffice.org/releases/ooo_roadmap.pdf">roadmap</a> 
	and <a href="http://development.openoffice.org/releases/">codelines</a> documents. 
	To create your own tinderbox, check the 
	<a href="http://wiki.services.openoffice.org/wiki/Tinderbox_Setup">Tinderbox 
	setup guide</a>.</p>
        
	<h5>Changes in ooo-build</h5>
        <p>Use <a href="http://cia.vc/stats/project/gnome/ooo-build">CIA</a> to look up 
	the latest changes in ooo-build cvs.</p>
        
	<h5>Tarballs</h5>
        <p>You can download <a href="http://download.go-oo.org/">packages of OO.o here</a>. 
	These are tested to ensure clean builds.</p>
        
	<h5>Local web tools</h5>
        <p>Our patches to sync bonsai via cvsup, and a description of how to make LXR work 
	on RH 8.0+ can be found <a href="web-patches/">here</a>.</p>
        
	<h5 id="irc">IRC</h5>
        <p>We have a channel #go-oo on irc.freenode.net, where you can discuss development 
	issues with hackers.</p>
        <p>To contact anyone wrt. go-oo see the ooo-build 
	<a href="http://svn.gnome.org/viewcvs/ooo-build/trunk/AUTHORS?view=markup">maintainers</a> 
	or contact <i>mmeeks T novell com</i></p>

        <hr />
        <form action="http://babelfish.altavista.com/tr" method="post" name="frmTrText">
            <input name="doit" value="done" type="hidden"> 
            <input name="intl" value="1" type="hidden"> <b>Translate a short German comment: [ thanks to <a href="http://babelfish.altavista.com">BabelFish</a> ]</b><br>
            <input name="tt" value="urltext" type="hidden"> 
            <textarea rows="2" wrap="virtual" cols="42" style="width: 400px;" name="trtext"></textarea><br>
            <input name="lp" value="de_en" type="hidden"> 
            <input value="Translate" type="submit">
        </form>
	</div>
EOT;

print_page("Go-OO! - Developers", array("developers", "summary"),
   "Developers",
   $content
);

?>
