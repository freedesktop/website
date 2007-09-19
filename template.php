<?php

function print_page($title, $heading, $content)
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title><?php print $heading; ?></title>
        <style type="text/css">
            @import url(css/blueprint/print.css) print;
            @import url(css/blueprint/screen.css) screen;
            @import url(css/tabs.css);
            @import url(css/style.css);
        </style>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.history_remote.pack.js"></script>
        <script type="text/javascript" src="js/jquery.tabs.pack.js"></script>
        <script type="text/javascript" src="js/interface.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
    </head>
    <body>
        <div id="wrap">

            <div id="header">
                <h1><a href="/">Go-OO</a></h1>
            </div>
            <div id="container">

                <ul id="nav">
                    <li><a href="/"><span>Summary</span></a></li>
                    <li><a href="/download/"><span>Download</span></a></li>
                    <li><a href="/discover/"><span>Discover</span></a></li>
                    <li><a href="/developers/"><span>Developers</span></a></li>
                    <li><a href="/about/"><span>About</span></a></li>
                </ul>

                <div class="container">
                    <div id="splash">
                        <h3><?php print $heading; ?></h3>
			<?php print $content . "\n"; ?>
                    </div>
                </div>

            </div>

            <div id="sidebar">
                <div class="text">
                    openoffice<br>
                    development
                </div>
            </div>

        </div>
    </body>
</html>
<?php
}
?>
