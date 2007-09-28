<?php
require("../template.php");


$content = <<<EOT
<p>Here you'll discover what Go-oo has to offer in addition to the 
regular build of OpenOffice.org</p>

<p>Not without mentionning what is <a href="comingsoon/">coming soon</a></p>

<table>
<tr>

<td>
<h4>VBA support</h4>
<p>Go-oo provide VBA macros support for OpenOffice.org <!-- (<a href="excel-vba.xls">download sample file</a>) --></p>
<p><a href="go-excel-vba.png">
<img src="go-excel-vba-thumb.png"/></a></p>
</td>

<td>
<h4>Startup performance</h4>
<p>Go-oo starts faster: (go-oo 2.1 vs. Sun/OO.o 2.3)</p>
<img src="startup.png"/></a>
</td>

</tr>

<tr><td colspan="2">
<h4>Calc solver</h4>
<p>Go-oo has a linear optimization solver to optimize a cell value based
on arbitrary constraints, built into Calc.</p>
<a href="go-calc-solver.png">
<img src="go-calc-solver-thumb.png" /></a>
</td>
</tr>

<tr>

<td colspan="2">
<h4>GStreamer integration</h4>
<p>Go-oo supports multimedia content into your document using the 
gstreamer multimedia framework
</p>
<table>
<tr><th>Before</th>
<th>After</th></tr>
<tr><td><a href="oo-gstreamer.png"><img src="oo-gstreamer-thumb.png" /></a></td>
<td><a href="go-gstreamer.png"><img src="go-gstreamer-thumb.png"
/></a></td></tr>
</table>
</td>

</tr>
<tr>

<td>
<h4>MS-Works import</h4>
<p>Go-oo supports MS-Works files (<a href="msworks.wps" type="application/vnd.ms-works">download sample file</a>)</p>
<a href="go-msworks.png"><img src="go-msworks-thumb.png" /></a>
</td>

<td>
<h4>WordPerfect Graphics import</h4>
<p>Go-oo imports graphics in the WPG format coming from WordPerfect 
which supplement the WordPerfect importer also available in Go-oo 
(<a href="wpg-support.wpg" type="image/wpg">download sample file</a>)</p>
<a href="go-wpg-support.png"><img src="go-wpg-support-thumb.png" /></a>
</td>

</tr>
<tr>

<td>
<h4>T602 import</h4>
<p>Go-oo supports T602 files (<a href="cti_lasr.602" type="application/x-t602">download sample file</a>)</p>
<a href="go-t602.png"><img src="go-t602-thumb.png" /></a>
</td>

<td>
<h4>Improved EMF rendering</h4>
<p>Go-oo renders EMF+ content, giving a far better view of embedded drawings
</p>
<table>
<tr><th>Before</th>
<th>After</th></tr>
<tr><td><a href="oo-emf.png"><img src="oo-emf-thumb.png" /></a></td>
<td><a href="go-emf.png"><img src="go-emf-thumb.png"
/></a></td></tr>
</table>
</td>

</tr>

</table>

EOT;


print_page("Go-OO! - Discover", array("discover", "summary"),
   "Discover OpenOffice.org",
   $content
   );

?>

