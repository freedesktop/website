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
                <dt><a href="http://svn.services.openoffice.org/opengrok/">OpenGrok</a> (replaces LXR)</dt>
                <dd>
                <form method="get" action="http://svn.services.openoffice.org/opengrok/search">
                    <label>
                        Identifier
                        <input type="text" name="refs" value="" size="10" />
                    </label>
                    <input type="submit" value="Find" class="hide" />
                </form>
                <form method="get" action="http://svn.services.openoffice.org/opengrok/search">
                    <label>
                        Text 
                        <input type="text" name="q" value="" size="10" />
                    </label>
                    <input type="submit" value="Find" class="hide" />
                </form>
                <form method="get" action="http://svn.services.openoffice.org/opengrok/search">
                    <label>
                        File 
                        <input type="text" name="path" value="" size="10" />
                    </label>
                    <input type="submit" value="Find" class="hide" />
                </form>
                </dd>
                <dt>Bugzilla</dt>
                <dd>
                <form method="get" action="http://www.openoffice.org/issues/show_bug.cgi">
                    <a href="http://www.openoffice.org/issues/query.cgi">OO.o Issue</a> <a href="http://qa.openoffice.org/issue_handling/submission_gateway.html#code_module">New</a> 
                    <input name="id" size="8" />
                    <input type="submit" value="Find" class="hide" />
                </form>
                <form method="get" action="https://bugzilla.novell.com/show_bug.cgi">
                    <a href="https://bugzilla.novell.com/query.cgi">BNC Issue</a> <a href="https://bugzilla.novell.com/enter_bug.cgi">New</a> 
                    <input name="id" size="8" />
                    <input type="submit" value="Find" class="hide" />
                </form>
                </dd>
                <dt>Development Tools</dt>
                <dd>
                    <ul>
                        <li><a href="http://svn.services.openoffice.org/opengrok/">OpenGrok</a> (replaces LXR)</li>
                        <li><a href="http://bonsai.go-oo.org/cvsqueryform.cgi">Bonsai</a></li>
                        <li><a href="http://tinderbox.go-oo.org/">Tinderbox</a></li>
                        <li>
                          <a href="http://buildbot.go-oo.org">Buildbot</a>
                          (<a href="http://wiki.services.openoffice.org/wiki/Buildbot">More information</a>)
                        </li>
                        <li><a href="http://embed.mibbit.com/?server=irc.freenode.net&channel=%23go-oo&noServerTab=false" target="blank">#go-oo IRC Chat</a></li>
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
                <dt>Resources</dt>
                <dd>
                    <ul>
                        <li><b><a href="http://wiki.services.openoffice.org/wiki/">Wiki</a></b></li>
                        <li><a href="http://planet.go-oo.org/">Planet OO.o</a> &amp; <a href="http://planet.go-oo.org/rss20.xml">(rss)</a></li>
                        <li><a href="tutorials/">Hackers Tutorials</a></li>
                        <li><a href="cws.html">Hackers CWS howto</a> &amp; <a href="cws-quickhowto-ja.html">Japanese</a></li>
                        <li><a href="http://wiki.services.openoffice.org/wiki/Ooo-build">About ooo-build</a></li>
                        <li><a href="http://wiki.services.openoffice.org/wiki/Environment_Variables">Tweaking setting at runtime.</a></li>
                        <li><a href="http://wiki.services.openoffice.org/wiki/DomainDeveloper">Who is Whom?</a></li>
                        <li><a href="http://eis.services.openoffice.org/EIS2/servlet/GuestLogon">EIS</a></li>
                        <li><a href="http://wiki.services.openoffice.org/wiki/Tinderbox_Setup">Tinderbox setup</a></li>
                        <li>ooo-build <a href="http://download.go-oo.org/">source</a> &amp; <a href="http://svn.gnome.org/viewvc/ooo-build/trunk/patches/">patches</a></li>
                        <li><a href="/users/mgp/">MagicPoint users</a></li>
                <li><a href="http://docs.go-oo.org/index.html">source code documentation</a></li>
                    </ul>
                </dd>
            </dl>
        </div>
	<div>
	<h4 id="irc">IRC</h4>
        <p>We have a channel #go-oo on irc.freenode.net, where you can discuss development 
	issues with hackers.</p>
        <p>To contact anyone wrt. go-oo see the ooo-build 
	<a href="http://svn.gnome.org/viewcvs/ooo-build/trunk/AUTHORS?view=markup">maintainers</a> 
	or contact <i>mmeeks T novell com</i></p>

	<h4>Mailing List</h4>
	
	<p>There is a mailing for ooo-build development. 
	<a href="http://lists.go-oo.org/listinfo.cgi/dev-go-oo.org">More info</a> on
	how to <a href="http://lists.go-oo.org/listinfo.cgi/dev-go-oo.org">subscribe</a> or to 
	read the <a href="http://lists.go-oo.org/pipermail/dev-go-oo.org/">archive</a>. 
	There is also the <a href="mailarchive/">old mailing list archive</a>.</p>

	<h4>Tarballs</h4>
        <p>You can download <a href="http://download.go-oo.org/">packages of OO.o here</a>. 
	These are tested to ensure clean builds.</p>
        
    <h4>Translate a short German comment: [ thanks to <a href="http://babelfish.altavista.com">BabelFish</a> ]</h4>
    <form action="http://babelfish.altavista.com/tr" method="post" name="frmTrText">
        <input name="doit" value="done" type="hidden" />
        <input name="intl" value="1" type="hidden" />
        <input name="tt" value="urltext" type="hidden" />
        <textarea rows="2" wrap="virtual" cols="42" style="width: 30em;" name="trtext"></textarea><br />
        <input name="lp" value="de_en" type="hidden" />
        <input value="Translate" type="submit" />
    </form>

	<h4>Source</h4>
    <p>ooo-build sources are stored in 
    <a href="http://developer.gnome.org/tools/svn.html">Subversion</a>.
    To check out the latest version of ooo-build:</p>

    <div class="pre">
        svn co http://svn.gnome.org/svn/ooo-build/trunk ooo-build
    </div>

    <p>Registered developers should use the following command to enable writing
    to the repository:</p>

    <div class="pre">
        svn co svn+ssh://<i>login@</i>svn.gnome.org/svn/ooo-build/trunk ooo-build
    </div>

    <p>Once the source has been checked out, ooo-build can be built in 
    very nearly the usual manner:</p>
    <div class="pre">
        cd ooo-build<br />
        ./autogen.sh --with-distro=<i>DISTRO</i><br />
        ./download<br />
        make
    </div>

    <p>where <i>DISTRO</i> is the basename of a file in the 
    <a href="http://svn.gnome.org/viewvc/ooo-build/trunk/distro-configs/">distro-configs</a>
    directory, such as <i>Debian</i>, <i>SUSE</i>, or <i>Ubuntu</i>.</p>

    <p>See the 
    <a href="http://wiki.services.openoffice.org/wiki/Ooo-build">Wiki</a> for
    more information.</p>

	<h4>Tinderbox Build Status</h4>
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
        
	<h4>Changes in ooo-build</h4>
        <p>Use <a href="http://cia.vc/stats/project/gnome/ooo-build">CIA</a> to look up 
	the latest changes in ooo-build cvs.</p>
        
	<h4>Local web tools</h4>
        <p>Our patches to sync bonsai via cvsup, and a description of how to make LXR work 
	on RH 8.0+ can be found <a href="web-patches/">here</a>.</p>
        
	</div>
EOT;

print_page("Go-OO! - Developers", 
   array("developers", "summary"),
   "Developers",
   $content,
   array (
      "Bonsai" => "http://bonsai.go-oo.org/cvsqueryform.cgi",
      "OpenGrok" => "http://svn.services.openoffice.org/opengrok/",
      "Tinderbox" => "http://tinderbox.go-oo.org/",
      "Buildbot" => "http://buildbot.go-oo.org",
      "#go-oo IRC Channel" => array (
           "href" => "http://embed.mibbit.com/?server=irc.freenode.net&channel=%23go-oo&noServerTab=false",
           "target" => "blank"
      ),
   )
);

?>
