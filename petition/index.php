<?php
require("../template.php");

$content = <<<"EOT"

<style>
.sign_title
{
	color: #758c98;
	font-size: 13px;
	padding-bottom: 10px;
}

.signContainerTop
{
	background: url(images/signContainerTop.png) no-repeat top center;
	height: 9px;
	width: 642px;
}

.signContainerBottom
{
	background: url(images/signContainerBottom.png) no-repeat top center;
	height: 9px;
	width: 642px;
}

.signContainerBody
{
	background: url(images/signContainerBG.png) repeat-y top center;
	width: 592px;
	height: 268px;
	padding: 5px 25px;
}

#sign_services
{
	padding-bottom: 15px;
}

#self_sign
{
	padding-top: 15px;
}

#self_sign_left
{
	width: 210px;
	float: left;
}

#self_sign_right
{
	width: 370px;
	float: right;
}

.signTextarea textarea
{
	background: #fff;
	border: 1px solid #b3cbd5;
	font-size: 15px;
	margin-bottom: 10px;
	color: #6e8d9c;
	width: 354px;
	height: 100px;
	padding: 5px 8px;
	-webkit-border-radius: 5px;
	-khtml-border-radius: 5px;	
	-moz-border-radius: 5px;
	border-radius: 5px;
	
}

.comments_width
{
	width:500px;
}


.signInput,
input.input2
{
	background: #fff;
	border: 1px solid #b3cbd5;
	font-size: 15px;
	margin-bottom: 10px;
	color: #6e8d9c;
	width: 194px;
	padding: 5px 8px;
	-webkit-border-radius: 5px;
	-khtml-border-radius: 5px;	
	-moz-border-radius: 5px;
	border-radius: 5px;
	
}

.signContainer
{
	padding: 0 20px;
}

#petition-footer, #petition-promotion {
        margin: 20px 0 20px 0;
	width: 650px;
	padding: 5px 25px;
}


</style>

<div id='petition-promotion'>
<p>Our mission is to facilitate the evolution of the OpenOffice.org Community into a new open, independent, and meritocratic organizational structure within the next few months. An independent Foundation is a better match to the values of our contributors, users, and supporters, and will enable a more effective, efficient, transparent, and inclusive Community. We will protect past investments by building on the solid achievements of our first decade, encourage wide participation in the Community, and co-ordinate activity across the Community.</p>

<p>We highly respect the work of the people that have recently joined Oracle coming from Sun/StarDivision and with who we'd appreciate to continue collaboration.</p>

<p>The Document Foundation was created to fulfill our mission and become the independent home of the OpenOffice.org community.</p>

<p>You can easily sign our petition by filling the form below. Thank you for your support!</p>
</div>

   <div id='signFormContainer'>
   
   <br />
   <div class='signContainer'>
      <div class='signContainerTop'></div>
      <div class='signContainerBody'>

         
   <form id='this_sign_form' action="http://www.petitionspot.com/petitions/documentfoundation/sign/" method="post">
      <input type='hidden' name='code' value='save' />
      <input type='hidden' name='onsite' value='yes' />
      <input type='hidden' name='fb_sign' id='fb_sign' value='no' />
      <input type='hidden' name='tw_sign' id='tw_sign' value='no' />
      <input type='hidden' name='ms_sign' id='ms_sign' value='no' />
      
         
         <div id='self_sign'>

            <div id='self_sign_left'>
		      <div>First Name<input type='text' class='signInput' id='sign-first_name' name='first_name' /></div>
		      <div>Last Name<input type='text' class='signInput' id='sign-last_name' name='last_name' /></div>
		      <div>Email Address<input type='text' class='signInput' id='sign-email_address' name='email_address' /></div>
		      <div>Zip Code<input type='text' class='signInput' id='sign-zip' name='zip_code' /></div>
            </div>
            <div id='self_sign_right'>
		      Add a message<div class='signTextarea'><textarea id='sign-comments' onblur="validateComments()" name='comments'></textarea></div>

		      <input type='image' src='http://www.petitionspot.com/static/images/sign_petition.png' alt='Sign this petition!' class='invisible'  />
            </div>
         </div>
   </form>
         
      </div>
      <div class='signContainerBottom'></div>
   </div>

<div id='petition-footer'>

<p>By providing your information above, you will be signing our petition hosted on PetitionSpot.com. They also accept Facebook, Twitter and MySpace authentification.</p>

<p>For more information about our petition, you can visit <a href="http://www.petitionspot.com/petitions/documentfoundation/">http://www.petitionspot.com/petitions/documentfoundation/</a>.</p>

<p>PetitionSpot: <a href="http://www.petitionspot.com/termsofservice/">Term of service</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.petitionspot.com/privacy/">Privacy policy</a></p>
</div>

EOT;

print_page("Our Foundation Petition", array("summary", "summary"),
	   "Our Foundation Petition", $content);
?>
