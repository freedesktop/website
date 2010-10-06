<?php
require("../template.php");

$content = <<<"EOT"

<div id="faq">
<h5><span class="faq-question" id="Q:_Why_a_Foundation.3F"> Q: Why a Foundation?  </span></h5>
<p>A: When Sun Microsystems decided to release the OpenOffice.org software under an open-source licence a decade ago, it was making an act of faith in Community based development, which it hoped would one day lead to <a href="http://www.openoffice.org/white_papers/OOo_project/openofficefoundation.html" class="external text" rel="nofollow">an independent foundation</a>. This gamble has proved hugely successful, and today OpenOffice.org is unquestionably the world's leading open-source productivity suite. As the Community approached its second decade, a consensus gradually emerged among leading Community contributors that a new organisational model was needed to take it forward. From the options available, an independent, community owned and managed democratic foundation emerged as the best solution.<br> 
</p>

<h5><span class="faq-question" id="Q:_So_is_this_a_breakaway_project.3F"> Q: So is this a breakaway project?  </span></h5>
<p>A: Not at all. The Document Foundation will continue to be focused on developing, supporting, and promoting the same software, and it's very much business as usual. We are simply moving to a new and more appropriate organisational model for the next decade - a logical development from Sun's inspirational launch a decade ago. 
</p>

<h5><span class="faq-question" id="Q:_Why_are_you_calling_yourselves_.22The_Document_Foundation.22.3F"> Q: Why are you calling yourselves "The Document Foundation"?  </span></h5>
<p>A: For ten years we have used the same name - "OpenOffice.org" - for both the Community and the software. We've decided it removes ambiguity to have a different name for the two, so the Community is now "The Document Foundation", and the software "LibreOffice". <i>Note: there are other examples of this usage in the free software community - e.g. the Mozilla Foundation with the Firefox browser.</i> 
</p>

<h5><span class="faq-question" id="Q:_Does_this_mean_you_intend_to_develop_other_pieces_of_software.3F"> Q: Does this mean you intend to develop other pieces of software?  </span></h5>
<p>A: We would like to have that possibility open to us in the future... 
</p>

<h5><span class="faq-question" id="Q:_And_why_are_you_calling_the_software_.22LibreOffice.22_instead_of_.22OpenOffice.org.22.3F"> Q: And why are you calling the software "LibreOffice" instead of "OpenOffice.org"?  </span></h5>
<p>A: The OpenOffice.org trademark is owned by Oracle Corporation. Our hope is that Oracle will donate this to the Foundation, along with the other assets it holds in trust for the Community, in due course, once legal etc issues are resolved. However, we need to continue work in the meantime - hence "LibreOffice" ("free office"). 
</p>

<h5><span class="faq-question" id="Q:_Why_are_you_building_a_new_web_infrastructure.3F"> Q: Why are you building a new web infrastructure?  </span></h5>
<p>A: Since Oracle's takeover of Sun Microsystems, the Community has been under "notice to quit" from our previous Collabnet infrastructure. With today's announcement of a Foundation, we now have an entity which can own our emerging new infrastructure. 
</p>

<h5><span class="faq-question" id="Q:_What_does_this_announcement_mean_to_other_derivatives_of_OpenOffice.org.3F"> Q: What does this announcement mean to other derivatives of OpenOffice.org?  </span></h5>
<p>A: We want The Document Foundation to be open to code contributions from as many people as possible. We are delighted to announce that the enhancements produced by the Go-OOo team will be merged into LibreOffice, effective immediately. We hope that others will follow suit. 
</p>

<h5><span class="faq-question" id="Q:_What_difference_will_this_make_to_the_commercial_products_produced_by_Oracle_Corporation.2C_IBM.2C_Novell.2C_Red_Flag.2C_etc.3F"> Q: What difference will this make to the commercial products produced by Oracle Corporation, IBM, Novell, Red Flag, etc?  </span></h5>
<p>A: The Document Foundation cannot answer for other bodies. However, there is nothing in the licence arrangements to stop companies continuing to release commercial derivatives of LibreOffice. The new Foundation will also mean companies can contribute funds or resources without worries that they may be helping a commercial competitor. 
</p>

<h5><span class="faq-question" id="Q:_What_difference_will_The_Document_Foundation_make_to_developers.3F"> Q: What difference will The Document Foundation make to developers?  </span></h5>
<p>A: The Document Foundation sets out deliberately to be as developer friendly as possible. We do not demand that contributors share their copyright with us. People will gain status in our community based on peer evaluation of their contributions - not by who their employer is. 
</p>

<h5><span class="faq-question" id="Q:_What_difference_will_The_Document_Foundation_make_to_users_of_LibreOffice.3F"> Q: What difference will The Document Foundation make to users of LibreOffice?  </span></h5>
<p>A: LibreOffice is The Document Foundation's reason for existence. We do not have and will not have a commercial product which receives preferential treatment. We only have one focus - delivering the best free office suite for our users - LibreOffice. 
</p>
</div>

EOT;

print_page("FAQ", array("faq", "summary"),
	   "Frequently Asked Questions - FAQ", $content);
?>
