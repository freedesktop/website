<?php
require("../template.php");

$content = <<<EOT
<p>Go-oo has been contributed to by many people, past and present.</p>
<p style="text-align: center;">
<img src="/img/go-oo-team.png" alt="mugshots of the team" />
</p>
EOT;
$people = file($_SERVER['argv'][1]."/src/easter/people.txt");
$names = array();
foreach($people as $i)
{
	if(!strlen(trim($i)) or substr($i, 0, 1) == "#")
		continue;
	$names[] = preg_replace("/^([^: ]+):* .*/", '$1', trim($i));
}
sort($names);
$limit = 7;
for($i=0;$i<count($names);$i+=$limit)
{
	$content .= "<p style=\"text-align: center; height: 78px;\">\n";
	if($i==0)
		$content .= "From top left: ";
	$content .= join(", ", array_slice($names, $i, $limit));
	if(count($names)<$i+$limit)
		$content .= ".";
	$content .= "\n</p>\n";
}
$content .= <<<EOT
<p>If you believe you should be on this page, but are missing please
ping me <i>michael dot meeks at</i><i> novell.com</i></p>
EOT;


print_page("Go-OO! - About", array("about", "summary"), 
   "The people behind go-oo.org",
   $content
   );

?>

