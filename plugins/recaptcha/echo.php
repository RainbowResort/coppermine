<?php
/****************************************
 * Contact Form with reCAPTCHA v.9      
 * for Coppermine Photo Gallery         
 *                                      
 * By Joe Carver                        
 * http://gallery.josephcarver.com/natural/
 * Based on "Contact Form" posted on    
 * phpscripts.com by Author Anon. 11/2007      
 *
 *****************************************
 *
 * Coppermine Photo Gallery
 *
 * Copyright (c) 2003-2009 Coppermine Dev Team
 * v1.1 originally written by Gregory DEMAR
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Coppermine version: 1.4.25
 * reCAPTCHA Plugin ver 2.2
 * 16 August 2009
 * Plugin Written by JR Carver - http://gallery.josephcarver.com/natural/ - http://i-imagine.net
*/

define('IN_COPPERMINE', true);
require('include/init.inc.php');
global $CONFIG;
include('plugins/recaptcha/recaptcha_config.php');

pageheader('Contact Form');
// 090308
    starttable("90%");
		
    ?>
    <tr>
      <td class="tableb" valign="top" align="left">
            <?php

		/****SET THE MAX CHARS FOR EACH MESSAGE***************/
			//it is recommended not to set the max too high, to prevent extremely long messages
			// from stalling your server

			$EMAIL_MAX = 2500;
			$SMS_MAX = 120;
		
		/*****************************************************/

		//function for stripping whitespace and some chars
		function cleanUp($str_to_clean, $newlines, $spaces){
		
			//build list of whitespace chars to be removed
			$bad_chars = array('\r', '\t', ';','[',']','<','>');
		
			//if newlines are false, add that to the list of bad chars
			if(!$newlines){array_push($bad_chars, '\n');}
			
			//if spaces are false, strip them too
			if(!$spaces){array_push($bad_chars, ' ');}
			
			$str_to_clean_a = str_replace($bad_chars, '', $str_to_clean);
			$str_to_clean_b = strip_tags($str_to_clean_a);
			return $str_to_clean_b;
		}
		
		//function to check for valid email address pattern
		function checkEmail($email) {
			if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {return false;}
			return true;
		}
		//function to check for valid url pattern
		function checkURL($url) {
			if(!eregi("^http:\/\/", $url)) {return false;}
			return true;
		}

	?>

     

		<style type="text/css">
		/* BASIC STYLES */
		fieldset{margin:0;padding:0;border:0;}
		label{width:350px; display:block;}
		.txt_input{width:260px; display:block;}
		textarea{height:80px; width:320px;}
		input{display:block;}
		.req{color:#f00;font-size:100%;}
		</style>
		
	<table style="text-align: left; width: 90%;" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="vertical-align: top; width: 320;">
<h3 align="left"> <br><br>Please use this form to send  <br>your 
               message to <?php echo $CONFIG['gallery_name'];?><br><br></h3>

<div id="container">
<div class="contact"  style="vertical-align: top; width: 320;">
				
		<fieldset style="center;">
		<p id="form_errors"></p>
		<form name="contact" action="index.php?file=recaptcha/echo" method="post" onsubmit="return validateForm();">
 
<div align="left" width="310">

		<label>Your Name <span class="req">*required</span></label>
		<input type="text" class="txt_input" name="sender_name" />

		<label>Your E-Mail <span class="req">*required</span></label>
		<input type="text" class="txt_input" name="sender_email" />

		<label>Subject <span class="req">*required</span></label>
		<input type="text" class="txt_input" name="sender_subject" />


        	<label>Message <span class="req">*required</span></label>
		<textarea name="sender_message"></textarea><br><br>


<script>
function showRecaptcha(element, submitButton, themeName) {
  Recaptcha.create("<?php echo $key_public;?>", element, {
         theme: '<?php echo $recapt_thme;?>',
         lang: '<?php echo $recapt_lang;?>',
        callback: Recaptcha.reload
 });
  hideSubmitButtons();
  document.getElementById(submitButton).style.visibility = "visible";
}

function hideSubmitButtons() {
  document.getElementById('submit_button_1').style.visibility = "hidden";
  
}

function destroyRecaptchaWidget() {
  hideSubmitButtons();
  Recaptcha.destroy();
}
</script>

<form method="post" action="">

<input type="button" class="button" style="width: 320;"   value="Click here - Type the two words with a space - Click send" onclick="showRecaptcha('dynamic_recaptcha_1', 'submit_button_1', 'red');"></input><br>
<div id="dynamic_recaptcha_1"></div>


<input type="submit"  style="visibility: hidden" id="submit_button_1"class="button" name="submitForm" value="Send Message" /></input>

<div><br></div>

	<input type="button" class="button" value="Hide the reCAPTCHA widget" onclick="destroyRecaptchaWidget();"></input>	

</form>
		</fieldset></div>
	</div>




	</div>
	
</td>
<td style="vertical-align: top; width: 280;"><h3 align="left"><br><br><hr>Message Status<hr><br>

<noscript><h3 align="center"> <font color= "red"><br> Hello Visitor 

 <br>Your browser has no javascript.<br> You cannot send a message without javascript<br></font></h3><br>
	</noscript>



	<script type="text/javascript">
v_fields = new Array('sender_name','sender_email','sender_subject','sender_message');alert_on = true;thanks_on = true; thanks_message = "Thank you. Your message has been sent.";	
	
           



               function validateForm(){
		
		//alert(v_fields);
		
		//init errors
		var err = "";
		
		//start checking fields
		for(i=0;i<v_fields.length;i++){
			
			//store the field value
			var _thisfield = eval("document.contact."+v_fields[i]+".value");
			
			//check the field value 
			if(v_fields[i] == "sender_name"){
				if(!isAlpha(_thisfield)){ err += "Please enter a valid name\n";}
			}else if(v_fields[i] == "sender_subject"){
				if(!isAlpha(_thisfield)){ err += "Please enter a valid subject\n";}
			
			}else if(v_fields[i] == "sender_email"){
				if(!isEmail(_thisfield)){ err += "Please enter a valid email\n";}
			}else if(v_fields[i] == "sender_phone"){
				if(!isPhone(_thisfield)){ err += "Please enter a valid phone number\n";}
			}else if(v_fields[i] == "sender_message"){
				if(!isText(_thisfield)){ err += "Please enter a valid message\n";}
			}
			
		}//end for
		
		if(err != ""){ 
			if(alert_on){
				alert("The following errors have occurred\n"+err);
			}else{
				showErrors(err);
			}
			
			return false;
		
		}
		
		return true;
	}
	
	//function to show errors in HTML
	function showErrors(str){
		var err = str.replace(/\n/g,"<br />");
		document.getElementById("form_errors").innerHTML = err;
		document.getElementById("form_errors").style.display = "block";
	
	}
	
	//function to show thank you message in HTML
	function showThanks(str){
		var tym = str.replace(/\n/g,"<br />");
		document.getElementById("form_thanks").innerHTML = tym;
		document.getElementById("form_thanks").style.display = "block";
	
	}
	
	function isEmail(str){
	if(str == "") return false;
	var regex = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i
	return regex.test(str);
	}
	
	function isText(str){
		if(str == "") return false;
		return true;
	}
	
	function isURL(str){
		var regex = /[a-zA-Z0-9\.\/:]+/
		return regex.test(str);
	}
	
	// returns true if the number is formatted in the following ways:
	// (000)000-0000, (000) 000-0000, 000-000-0000, 000.000.0000, 000 000 0000, 0000000000
	function isPhone(str){
		var regex = /^\(?[2-9]\d{2}[\)\.-]?\s?\d{3}[\s\.-]?\d{4}$/
		return regex.test(str);
	}
	
	// returns true if the string contains A-Z, a-z or 0-9 or . or # only
	function isAddress(str){
		var regex = /[^a-zA-Z0-9\#\.]/g
		if (regex.test(str)) return true;
		return false;
	}
	
	// returns true if the string is 5 digits
	function isZip(str){
		var regex = /\d{5,}/;
		if(regex.test(str)) return true;
		return false;
	}
	
	// returns true if the string contains A-Z or a-z only
	function isAlpha(str){
		var regex = /[a-zA-Z]/g
		if (regex.test(str)) return true;
		return false;
	}
	
	// returns true if the string contains A-Z or a-z or 0-9 only
	function isAlphaNumeric(str){
		var regex = /[^a-zA-Z0-9]/g
		if (regex.test(str)) return false;
		return true;
	}

</script>

<?php

	if(isset($_POST["submitForm"])){

		$_POST["sender_message"] = htmlentities($_POST["sender_message"]);
		$_POST["sender_name"] = htmlspecialchars($_POST["sender_name"]);
		$_POST["sender_email"] = htmlspecialchars($_POST["sender_email"]);
		$_POST["sender_subject"] = htmlspecialchars($_POST["sender_subject"]);
		$_POST["sender_url"] = htmlspecialchars($_POST["sender_url"]);
		$_name = cleanUp($_POST["sender_name"], false, true);
		$_email = cleanUp($_POST["sender_email"], false, false);
		$_subject = cleanUp($_POST["sender_subject"], false, true);
		$_message = cleanUp($_POST["sender_message"], true, true);
		$_url = cleanUp($_POST["sender_url"], false, false);
		$_body = "You have been sent this message from your contact form\n\n";
		
		if($_name){
			$_body .= "NAME: $_name\n\n";
		}
		
		if($_email){
			$_body .= "EMAIL: $_email\n\n";
		}
		
		if($_url){
			$_body .= "URL: $_url\n\n";
		}
		
		if($_phone){
			$_body .= "PHONE: $_phone\n\n";
		}
		
		if($_message){
		
			//check length of body, reduce to max chars
			if(strlen($_message) > $EMAIL_MAX){$_message= substr($_message, 0, $EMAIL_MAX);}else{$_message = $_message;}
			if(strlen($_message) > $SMS_MAX){$_message2 = substr($_message, 0, $SMS_MAX);}else{$_message2 = $_message;}
		}

$recapt_error_back = <<<EOT
<script type="text/javascript">
	document.write('<span style="h3"><a href="#" onclick="history.go(-1);return false;">$lang_plugin_captcha_error<br>$lang_plugin_captcha_goback</span></a>');
</script>
EOT;

$clear_all = <<<EOT
Clear All
EOT;

require_once('recaptchalib.php');
$privatekey = "$key_private";
$resp = recaptcha_check_answer ($privatekey,
$_SERVER["REMOTE_ADDR"],
$_POST["recaptcha_challenge_field"],
$_POST["recaptcha_response_field"]);
if (!$resp->is_valid) {
				echo $error;
				echo $recapt_error_back;				
				die;
					}
                /*msg_box($lang_error, $recapt_error_back,  $lang_continue, 'index.php?file=recaptcha/echo');*/
		//store the recipient(s)
		$_to = array();

		//now get the recipient(s)
		$_to[] = $CONFIG['gallery_admin_email'];
		
		//define the subject
		if(!$_subject){$_subject = "Gallery Contact Form E-Mail";}

		
		if(!$_name){$_name = "Anonymous";}
		if(!$_email){$_email = $_name;}
		
		//set the headers
		$_header = "From: $_name < $_email >" . "\r\n" .
    "Reply-To: ".$_email."\r\n" .
 	"none: none.none";
		
		//we can send up to 2 emails (EMAIL and/or SMS)
		if(count($_to) > 2){ $_to = array_slice($_to,0,2);}
		
		for($i=0;$i<count($_to);$i++){
			
			//get the correct message, based on where it is delivering to
			if(strstr($_to[$i],"no.no")){$_text = $_body.$_message2;}else{$_text = $_body.$_message;}
			
                        //send the email(s)
			@mail($_to[$i], $_subject, $_text, $_header);
		
		$thanks_reply = 'Thanks!<br>';
		$thanks_mssg = '<br>For Your Message<br>';
		echo $thanks_reply;			
		echo $_name;
		echo $thanks_mssg;			
		echo $_message;
		
	 }
}	

?>

</td>
</tr>
</tbody>
</table>
            <p><br>
            </p>
            <p>&nbsp; </p>
    </td>
    </tr>
    <?php
    endtable();
/// ends here
pagefooter();
ob_end_flush();
?>