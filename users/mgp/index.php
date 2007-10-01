<?php

require("../../template.php");

$content = <<<EOT
    <p>
      Or - how hackers can use OO.o effectively and fast.
      Having been an ardent magicpoint user, and advocate for
      many years; I was amazed that in fact OO.o can be used
      almost as effectively (modulo the lack of emacs key
      bindings) for content, and can do so much more as well.
    </p>
    <h3>Creating a presentation</h3>
    <p>
      As everyone knows, they key to a good presentation is
      content, not gimmicks. Thus, it is vital to be able to
      edit the content, unimpeded by the trivial.
    </p>
    <p>
      In order to do this, create your presentation, using a 
      sensible layout; then immediately switch to outline view
      (View-&gt;Master View-&gt;Outline View).
      To do this press F12, Control-F12 will switch back to the
      drawing view.
    </p>
    <p>
      At this point simply type; to get more indentation, press
      Tab; to loose a level of indentation use Shift-Tab; 
    </p>
    <h3>Editing the styles</h3>
    <p>
      So; having created a few bullet points, and switched to
      drawing view, you notice that the bullets look pretty
      awful, and you want to change them for the whole
      presentation.
    </p>
    <p>
      Hit F11 - shows the style list, select 'Outline <i>N</i>'
      right click -> modify, and away you go - lots of funky
      options. Of course - you can also override those with
      sheet specific options, but that's less useful.
    </p>
    <h3>Background images</h3>
    <p>
      You can set a slide background image using
      Format-&gt;Page, Background-&gt;Bitmap.
      It is possible to add your own photos/images to the 
      bitmaps list, just not in this dialog.
      Close the dialog and go to Format-&gt;Area, Bitmaps to
      find the Import button. Any bitmap you add here will be
      available as a page background.     
      For more complex backgrounds
      (e.g. an image and a logo.), see below.
    </p>
    <h3>Editing the background / layout</h3>
    <p>
      At the bottom of the screen, to the left of the sheet
      tabs, and to the left of the 4 sheet tab shuttling
      controls there are 3 very magic buttons.
      In order to edit the default page background / layouts
      in the template, switch between the 'Slide View' and
      'Master View' radio-toggles. Generating sane templates
      any other way is not feasible.
    </p>
    <h3>Stopping the auto-capitalization</h3>
    <p>
      Future versions of XOO.o will have this disabled; however
      for now the setting lurks in Tools -> Autocorrect, turn it
      off there for a less painful life.
    </p>
EOT;

print_page("Go-OO! - Users - MagicPoint", array("mgp", "users", "summary"),
   "Magicpoint users guide to OO.o's Impress",
   $content
   );


?>