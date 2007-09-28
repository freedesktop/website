<?php
require("../template.php");

$content = <<<EOT
<p>Go-oo has been contributed to by many people, past and present.</p>
<br>     
<!-- FIXME: we should generate this from the same code that generates the
     easter egg and do it more intelligently: row by row or something.
     Also segregate into current and historic developers -->
<p align="center">
<img src="/img/go-oo-team.png"></a>
</p>
<p align="center">
    From top left: Andreas, Bernhard, David, Dhananjay, Federico, Fong
</p><p align="center">
    Fridrich, Giuseppe, Hubert, Jakub, Jan, Jiao
</p><p align="center">
    Jody, Kai, Kohei, Martin, Matthias, Michael
</p><p align="center">
    Mike, Noel, Petr, Radek, Rene, Tor
</p><p align="center">
    Volker, Yin, ZhangYun.
</p>
<p>If you believe you should be on this page, but are missing please
ping me <i>michael dot meeks at</i><i> novell.com</i></p>
EOT;


print_page("Go-OO! - About", "about", 
   "The people behind go-oo.org",
   $content
   );

?>

