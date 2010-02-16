<?php
require("../template.php");


$content = <<<EOT
<p>Here you can see, at a glance, what Go-oo has to offer in addition to the 
features you expect in up-stream OpenOffice.org.
Subscribe to the <a href="http://lists.freedesktop.org/mailman/listinfo/ooo-build-announce">announcement list</a> for news about Go-oo!</p>

<hr>

<div class="discover-tile" style="width: 15em;">
<h4 id="svg-support">SVG support</h4>
<p>Go-oo provides a built-in 
SVG import filter. (<a href="tiger.svg" type="image/svg+xml">sample</a>)</p>
<a href="go-svg.png">
<img src="go-svg-thumb.png" alt="screenshot of SVG import"/></a>
</div>

<div class="discover-tile" style="width: 15em;">
<h4 id="impress-transitions">3D transitions</h4>
<p>Go-oo on Linux provides built-in 3D transitions within presentations.
(<a href="rochade.odp">sample</a>)</p>
<a href="rochade.png">
<img src="rochade-thumb.png" alt="go-oo 3D transition screenshot" /></a>
</div>

<div class="discover-tile" style="width: 15em;">
<h4 id="fields-support">Rich fields support</h4>
<p>Go-oo provides a powerful and interoperable fields implementation with
<a href="http://qa.openoffice.org/issues/show_bug.cgi?id=7644">nesting</a>,
<a href="http://qa.openoffice.org/issues/show_bug.cgi?id=33737">in-place editing</a>,
<a href="http://qa.openoffice.org/issues/show_bug.cgi?id=29508">multiple fonts</a> &amp;
<a href="http://qa.openoffice.org/issues/show_bug.cgi?id=69332">nested conditionals</a>.
(<a href="go-fields.doc">sample</a>)</p>
<a href="go-fields.png">
<img src="go-fields-thumb.png" alt="go-oo screenshot showing powerful fields import"/></a>
</div>

<div class="discover-tile" style="width: 15em;">
<h4>Startup performance</h4>
<p>Go-oo starts faster:<br>
go-oo 2.1 vs. Sun/OO.o 2.3</p>
<img src="startup.png" alt="startup comparison chart" />
</div>

<div class="discover-tile" style="width: 15em;">
<h4 id="quickstarter">Unix systray quick-starter</h4>
<p>Go-oo can run in the background
for a lightning second start. <br>
(Tools &rarr; Options &rarr; Memory)</p>
<img src="go-quickstart.png" alt="built in quick-starter" />
</div>

<div class="discover-tile" style="width: 15em;">
<h4 id="calc-solver">Calc solver</h4>
<p>Go-oo has a linear optimization solver
that can optimize a cell value based on
arbitrary constraints, built into Calc.</p>
<a href="go-calc-solver.png">
<img src="go-calc-solver-thumb.png" alt="go-oo solver screenshot" /></a>
</div>

<div class="discover-tile" style="width: 34em;">
<h4 id="excel-interop">Improved Excel interoperability</h4>
<p>Go-oo has improved interoperability with Excel, 
such as the ability to implicitly convert strings to 
numbers as context demands.
(<a href="xl-interop.xls">sample</a>; 
<a href="xl-interop.jpg">reference</a>)</p>
<table>
<th>Before</th><th>After</th></tr>
<tr><td><a href="oo-interop.png"><img 
  src="oo-interop-thumb.png" alt="OpenOffice.org and Calc functions" /></a></td>
<td><a href="go-interop.png"><img
  src="go-interop-thumb.png" alt="Go-oo and Calc functions" /></a></td></tr>
</table>
</div>

<div class="discover-tile" style="width: 15em;">
<h4 id="vba-support">VBA support</h4>
<p>Go-oo provides VBA macro support
for OpenOffice.org (<a href="go-vba-hypo.xls">sample</a>).</p>
<a href="go-excel-vba.png">
<img src="go-excel-vba-thumb.png" alt="go-oo screenshot for VBA"/></a>
</div>

<div class="discover-tile" style="width: 15em;">
<h4 id="mono-integration">Mono integration</h4>
<p>Go-oo allows UNO automation with
<a href="http://www.mono-project.com">Mono</a>,
permitting automation from
many languages such as <a href="http://www.mono-project.com/CSharp">C#</a>,
<a href="http://boo.codehaus.org">Boo</a>,
and more! (<a href="http://wiki.services.openoffice.org/wiki/Mono_Integration">instructions</a>;
<a href="http://cgit.freedesktop.org/ooo-build/ooo-build/tree/test/mono">source</a>)</p>
<a href="mono-sample.png">
<img src="mono-sample-thumb.png" alt="Screenshot of Automation with Mono"/></a>
</div>

<div class="discover-tile" style="width: 34em;">
<h4 id="gstreamer">GStreamer integration</h4>
<p>Go-oo on Linux supports multimedia content using
the <a href="http://gstreamer.org/">GStreamer</a> multimedia framework.
</p>
<table>
<th>Before</th>
<th>After</th></tr>
<tr><td><a href="oo-gstreamer.png"><img src="oo-gstreamer-thumb.png" 
alt="ooo and gstreamer screenshot" /></a></td>
<td><a href="go-gstreamer.png"><img src="go-gstreamer-thumb.png"
alt="go-oo and gstreamer screenshot" /></a></td></tr>
</table>
</div>

<div class="discover-tile" style="width: 34em;">
<h4 id="chinese-rendering">Text Grid rendering</h4>
<p>Go-oo renders Chinese much more pleasantly, using a
familiar text grid. (<a href="textgrid.doc">sample</a>)
</p>
<table>
<th>Before</th>
<th>After</th></tr>
<tr><td><a href="oo-textgrid.png"><img src="oo-textgrid-thumb.png" 
alt="ooo textgrid screenshot" /></a></td>
<td><a href="go-textgrid.png"><img src="go-textgrid-thumb.png"
alt="go-oo textgrid screenshot" /></a></td></tr>
</table>
</div>

<div class="discover-tile" style="width: 33em;">
<h4 id="emf-rendering">Improved EMF rendering</h4>
<p>Go-oo renders EMF+ content, giving a far better
view of embedded drawings.</p>
<table>
<th>Before</th>
<th>After</th></tr>
<tr><td><a href="oo-emf.png"><img src="oo-emf-thumb.png" 
alt="ooo EMF support screenshot" /></a></td>
<td><a href="go-emf.png"><img src="go-emf-thumb.png"
alt="go-oo EMF support screenshot" /></a></td></tr>
</table>
</div>

<div class="discover-tile" style="width: 15em;">
<h4 id="ms-works-import">MS-Works import</h4>
<p>Go-oo supports MS-Works files.
(<a href="msworks.wps" type="application/vnd.ms-works">sample</a>)</p>
<a href="go-msworks.png"><img src="go-msworks-thumb.png" alt="go-oo MS-Works support screenshot" /></a>
</div>

<div class="discover-tile" style="width: 17em;">
<h4 id="wp-graphics-import">WordPerfect Graphics import</h4>
<p>Go-oo imports graphics in the
WordPerfect WPG format
which supplements Go-oo's
WordPerfect importer.
(<a href="wpg-support.wpg" type="image/wpg">sample</a>)</p>
<a href="go-wpg-support.png"><img src="go-wpg-support-thumb.png" 
alt="go-oo WPG support screenshot" /></a>
</div>

<div class="discover-tile" style="width: 17em;">
<h4 id="lwp-import">Lotus Word Pro import</h4>
<p>Go-oo imports Lotus Word Pro files:
(<a href="go-wordpro.lwp" type="image/wpg">sample</a>)</p>
<a href="go-wordpro.png"><img src="go-wordpro-thumb.png" 
alt="go-oo Lotus WordPro support screenshot" /></a>
</div>

<div class="discover-tile" style="width: 17em;">
<h4 id="go-extensions">Includes useful Extensions</h4>
<p>Go-oo already bundles the most useful OpenOffice.org extensions, 
   like presenter console, pdfimport, or presentation minimizer:
<a href="go-extensions.png"><img src="go-extensions-thumb.png" alt="go-oo included extensions screenshot" /></a>
</div>

<hr>
<p>Of course, there are many other fixes and features included, too numerous to mention.</p>

EOT;


print_page("Go-OO! - Discover", array("discover", "summary"),
   "Discover Go-OO!",
   $content
   );

?>
