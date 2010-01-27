<?php
/**
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
 * reCAPTCHA Plugin ver 2.6
 * Based on Mod by Abbas ali(http://coppermine-gallery.net/forum/index.php?topic=29564.0)
 * Based on Plugin Writen by bmossavari at gmail dot com
 * Plugin Written by Joe Carver - http://gallery.josephcarver.com/natural/ - http://i-imagine.net
 *  22 January 2010
*/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Add filters 
$thisplugin->add_filter('page_meta','recaptcha_header');
$thisplugin->add_filter('page_html', 'recaptcha_main');

// Add actions
$thisplugin->add_action('page_start', 'recaptcha_page_start');
$thisplugin->add_action('page_start', 'recaptcha_check');
$thisplugin->add_action('plugin_install','recaptcha_install');
$thisplugin->add_action('plugin_configure','recaptcha_key_configure');
$thisplugin->add_action('plugin_uninstall','recaptcha_uninstall');

// Configure 
// input keys
	function recaptcha_key_configure() { 
	include_once('plugins/recaptcha/recaptchalib.php');
	$url = recaptcha_get_signup_url($_SERVER['HTTP_HOST'], 'Coppermine Photo Gallery');
    echo <<< EOT
	<form name="cpgform" id="cpgform" action="{$_SERVER['REQUEST_URI']}" method="post">
	    <table border="0" cellspacing="0" cellpadding="0" width="80%">
              <tr>
                <td colspan="2" align="center">
                  <h2><a href="{$url}" target="_blank"><br>1) Sign Up and Get Keys for your Domain at recaptcha.net - Click Here</a></h2>
                </td>
                </tr>
				<tr>
				<td><br><br><br></td></tr>
				              <tr>
				<td align="center" colspan="2"><h2>2) Copy & Paste your Public and Private Keys below - then  press <b>Go!</b></h2></td></tr>
				              <tr>
				<td><br><br></td></tr>
				              <tr>
                <td class="tableb" align="right">
                  Public Key:
                </td>
                <td class="tableb">
                  <input type="text" name="key_pub" class="textinput" size="55"/>
                </td>
              </tr>
              <tr>
				<td><br><br></td></tr>
				              <tr>
                <td class="tableb tableb_alternate" align="right">
                  Private Key:
                </td>
                <td class="tableb tableb_alternate">
                  <input type="text" name="key_pri" class="textinput" size="55"/>
                </td>
              </tr>
				<tr>
				<td><br></td></tr>
				              <tr>
                <td class="tablef" colspan="2" align="center">
                  <input type="submit" name="rc_submit" value="Go!" class="button" />
                </td>
              </tr>
				
            </table>
			</form>
EOT;
}

	 // Install Plugin and keys to db
	function recaptcha_install() {
    global $CONFIG;
   
	   if ($_POST['key_pub']=='') {
				return 1;
	}
		   if ($_POST['key_pri']=='') {
				return 1;
	}
		
else{
		//create a new entry in the configuration table
		$rc_key = ($_POST['key_pub']); //needs sanitisation,
		$rc_privkey = ($_POST['key_pri']);
		if(strlen($rc_key) < 35){
			return 1;
		}
		$sql = "INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} VALUES('new_recaptcha_pubkey', '$rc_key'), ('new_recaptcha_privkey', '$rc_privkey')";
		cpg_db_query($sql);
		return true;
	}
}

    // Uninstall and remove keys
function recaptcha_uninstall(){
	global $CONFIG;
	//remove the record from config
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'new_recaptcha_pubkey'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'new_recaptcha_privkey'");
	//cpg_db_query($sql);
	return true;
}

// Function to modify the gallery header 
 
function recaptcha_header($html) {
	global $CONFIG;
	global $template_header;
    $html = '<script type="text/javascript" src="http://api.recaptcha.net/js/recaptcha_ajax.js"></script>'
            .$html;
    $template_header = str_replace('</head>', $html.'</head>', $template_header);
}

// for purpose of disable by ftp  remove referenced config file
if(!file_exists('plugins/recaptcha/recaptcha_config.php')){
return;
}
include('plugins/recaptcha/recaptcha_config.php');

/**
 * recaptcha_main()
 * Filter HTML and create recaptchas
 *
 * @return HTML
 */
function recaptcha_main($html)
{
    global $CONFIG, $lang_display_comments, $lang_register_php, $CAPTCHA_DISABLE, $key_public, $lang_ecard_php, $lang_report_php, $lang_login_php, $CURRENT_PIC_DATA, $CURRENT_ALBUM_DATA, $lang_plugin_captcha;
    include('plugins/recaptcha/recaptcha_config.php');
	switch ($_SERVER['PHP_SELF']) {
        case 'displayimage.php':
		    $valid_groups = explode(',', $CAPTCHA_DISABLE['comment']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['comment'] == '') {
                $exper = '(/>.*
 .*<input type="submit" class="comment_button" name="submit" value="' . $lang_display_comments['OK'] . '" />)';
                if (preg_match($exper, $html)) {
                    $newcpch = <<<EOT
/>
<tr> <table  align="center" valign= "top"><tr>
 <td class="tableb_compact" align ="center" valign= "top" colspan="3">
 <script> 
function showRecaptcha(element, submitButton, themeName) {
   Recaptcha.create("$key_public", element, {
         theme: '$recapt_thme',
         lang: '$recapt_lang',
         callback: Recaptcha.focus_response_field
 });
 hideSubmitButtons();
document.getElementById(submitButton).style.visibility = "visible";
}

function hideSubmitButtons() {
 document.getElementById('submit_button_1').style.visibility = "hidden";
}

function destroyRecaptchaWidget()
 { hideSubmitButtons();
 Recaptcha.destroy();
}
</script>

<form method="post" action=""> <input type="button" class="comment_button"  value="$lang_plugin_captcha_submit_click" onclick="showRecaptcha('dynamic_recaptcha_1', 'submit_button_1', 'red');"></input> <div id="dynamic_recaptcha_1"></div> <input type="submit" value="$lang_plugin_captcha_submit" style="visibility: hidden" id="submit_button_1"class="comment_button" name="submit" /></input> </td> 
<td class="tableb_compact" align ="center" colspan="3" valign= "top" > <input type="button" class="comment_button" value="$lang_plugin_captcha_hide" onclick="destroyRecaptchaWidget();"></input> </td> </tr> <tr> 
EOT;
$html = preg_replace($exper, $newcpch, $html);
                }
            }
            break;
        case 'register.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['register']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['register'] == '') {
                $exper = '(<input type="submit" name="submit" value="' . $lang_register_php['submit'] . '" class="button" />)';
                if (preg_match($exper, $html)) {
                    $newcpch = <<<EOT
<div><br></div>

<script type="text/javascript" >
function showRecaptcha(element, submitButton, themeName) {
  Recaptcha.create("$key_public", element, {
         theme: '$recapt_thme',
         lang: '$recapt_lang',
        callback: Recaptcha.focus_response_field
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



<input type="button" class="button"  value="$lang_plugin_captcha_submit_click"  onclick="showRecaptcha('dynamic_recaptcha_1', 'submit_button_1', 'red');"></input>
<div id="dynamic_recaptcha_1"></div>

<input type="submit"  style="visibility: hidden" id="submit_button_1" class="button" name="submit" value="{$lang_register_php['submit']}" /></input>
<div><br></div>
<input type="button" class="comment_button" value="$lang_plugin_captcha_hide"  onclick="destroyRecaptchaWidget();"></input>
EOT;
                    $html = preg_replace($exper, $newcpch, $html);
                }
            }
            break;
        case 'ecard.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['ecard']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['ecard'] == '') {
                $exper = '(<input type="submit" class="button" name="submit".*/>)'; 
                //line 123
		if (preg_match($exper, $html)) {
                    $newcpch = <<<EOT
</tr><tr><td colspan="3" align="center" class="tablef"><div></div> 
<script> function showRecaptcha(element, submitButton, themeName) {   
Recaptcha.create("$key_public", element, {
         theme: '$recapt_thme',
         lang: '$recapt_lang',
         callback: Recaptcha.focus_response_field   
});   hideSubmitButtons();   document.getElementById(submitButton).style.visibility = "visible"; }  function hideSubmitButtons() {   document.getElementById('submit_button_1').style.visibility = "hidden";    }  function destroyRecaptchaWidget() {   hideSubmitButtons();   Recaptcha.destroy(); } 
</script> 
<form method="post" action=""> 
<input type="button" class="button"  value="$lang_plugin_captcha_ecard_click"  onclick="showRecaptcha('dynamic_recaptcha_1', 'submit_button_1', 'red');"></input> 
<div id="dynamic_recaptcha_1"></div> 
<input type="submit"  style="visibility: hidden" id="submit_button_1" class="button" name="submit" title="{$lang_ecard_php['submit_button']}" value="{$lang_ecard_php['submit_button']}" /></input> 
<div><br></div> 
<input type="button" class="comment_button" value="$lang_plugin_captcha_hide"  onclick="destroyRecaptchaWidget();"></input> 
<br><br>  </td>         
</tr> <tr> 			
<td colspan="3" align="center">              
<br><h3>To prevent abuse and spamming all ecard activity is logged</h3><br>                 
</td>         
</tr>
EOT;
                    $html = preg_replace($exper, $newcpch, $html);
                }
            }

            break;
        case 'report_file.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['report']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['report'] == '') {
                $exper = '(<input type="submit" .*/>)';
	//<input type="submit" class="button" value="Report to administrator" />
                if (preg_match($exper, $html)) {
                    $newcpch = <<<EOT
</tr><tr><td colspan="3" align="center" class="tablef"><div></div> 
<script> function showRecaptcha(element, submitButton, themeName) {   
Recaptcha.create("$key_public", element, {
         theme: '$recapt_thme',
         lang: '$recapt_lang',
         callback: Recaptcha.focus_response_field   
});   hideSubmitButtons();   document.getElementById(submitButton).style.visibility = "visible"; }  function hideSubmitButtons() {   document.getElementById('submit_button_1').style.visibility = "hidden";    }  function destroyRecaptchaWidget() {   hideSubmitButtons();   Recaptcha.destroy(); } 
</script> 
<form method="post" action=""> 
<input type="button" class="button"  value="$lang_plugin_captcha_report_click"  onclick="showRecaptcha('dynamic_recaptcha_1', 'submit_button_1', 'red');"></input> 
<div id="dynamic_recaptcha_1"></div> 
<input type="submit"  style="visibility: hidden" id="submit_button_1"  class="button" value="{$lang_report_php['title']}" /></input>
<div><br></div> 
<input type="button" class="comment_button" value="$lang_plugin_captcha_hide"  onclick="destroyRecaptchaWidget();"></input> 
<br><br>  </td>         
</tr> <tr> 			
<td colspan="3" align="center">                
</td>         
</tr>
EOT;
                    $html = preg_replace($exper, $newcpch, $html);
                }
            }
            break;
        case 'login.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['login']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['login'] == '') {
                $exper = '(<input name="submitted" type="submit".*/>)';
	// <input name="submitted" type="submit".*/>
                if (preg_match($exper, $html)) {
                    $newcpch =<<<EOT
<tr><td class="tableb_compact" align ="center" colspan="3"> 
<div></div> 	
<script type="text/javascript" >
function showRecaptcha(element, submitButton, themeName) {
   	Recaptcha.create("$key_public", element, {
         theme: '$recapt_thme',
         lang: '$recapt_lang',
         callback: Recaptcha.focus_response_field
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
 	<input type="button" class="comment_button"  value="$lang_plugin_captcha_login_click" {$lang_login_php['login']}" onclick="showRecaptcha('dynamic_recaptcha_1', 'submit_button_1',   'red');"></input>
 	<div id="dynamic_recaptcha_1"></div> <input name="submitted"  style="visibility: hidden"  type="submit" class="button" value="{$lang_login_php['login']}" tabindex="4" id="submit_button_1" /></input>  	<div></div>       <input type="button" class="comment_button" value="$lang_plugin_captcha_hide"  onclick="destroyRecaptchaWidget();"></input>
</form> 	
       </td>
       </tr></table>
EOT;
                    $html = preg_replace($exper, $newcpch, $html);
                }
            }
            break;
        default: ;
    } // switch
    return $html;
}
 /**
 * recaptcha_check()
 * check/validate captcha confirmation code [user input] for each page
 *
 * @return
 */
function recaptcha_page_start()
{


    global $lang_continue, $lang_error,$CONFIG, $CAPTCHA_DISABLE, $key_public, $key_private;
     include('plugins/recaptcha/recaptcha_config.php');

$recapt_error_back = <<<EOT
<script type="text/javascript">
	document.write('<span style="h3"><a href="#" onclick="history.go(-1);return false;">$lang_plugin_captcha_error<br>$lang_plugin_captcha_goback</span></a>');
</script>
EOT;

                                
    switch ($_SERVER['PHP_SELF']) {
        case 'db_input.php':
		$valid_groups = explode(',', $CAPTCHA_DISABLE['comment']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['comment'] == '') {
                if (isset($_POST['msg_body']) && (!isset($_POST['msg_id']))) {
			 	require_once('plugins/recaptcha/recaptchalib.php');
   	$privatekey = "$key_private";
 	$resp = recaptcha_check_answer ($privatekey,
 	$_SERVER["REMOTE_ADDR"],
 	$_POST["recaptcha_challenge_field"],
 	$_POST["recaptcha_response_field"]);
 	if (!$resp->is_valid) {
                    load_template();
                    pageheader($lang_error, "<META http-equiv=\"refresh\" content=\"25;url=displayimage.php?pos=" . (- $_POST['pid']) . "\">");
                    msg_box($lang_error,  $recapt_error_back);
                    pagefooter();
                    exit;
           }
		   return;
		}
            }
            break;
        case 'register.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['register']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['register'] == '') {
                if (isset($_POST['submit'])) {
	require_once('plugins/recaptcha/recaptchalib.php');
   	$privatekey = "$key_private";
 	$resp = recaptcha_check_answer ($privatekey,
 	$_SERVER["REMOTE_ADDR"],
 	$_POST["recaptcha_challenge_field"],
 	$_POST["recaptcha_response_field"]);
 	if (!$resp->is_valid) {
			  load_template();
                    pageheader($lang_error, "<META http-equiv=\"refresh\" content=\"25;url=register.php\">");
                    msg_box($lang_error,  $recapt_error_back);
                    pagefooter();
                    exit;
           }
return;
		}
            }
            break;
        case 'ecard.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['ecard']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['ecard'] == '') {
                if (isset($_POST['submit'])) {
	require_once('plugins/recaptcha/recaptchalib.php');
   	$privatekey = "$key_private";
 	$resp = recaptcha_check_answer ($privatekey,
 	$_SERVER["REMOTE_ADDR"],
 	$_POST["recaptcha_challenge_field"],
 	$_POST["recaptcha_response_field"]);
 	if (!$resp->is_valid) {
                    load_template();
                    pageheader($lang_error, "<META http-equiv=\"refresh\" content=\"25;url=ecard.php?album={$_GET['album']}&pid={$_GET['pid']}&pos={$_GET['pos']}\">");
                    msg_box($lang_error,  $recapt_error_back);
                    pagefooter();
                    exit;
           }
return;
		}
            }
            break;
        case 'report_file.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['report']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['report'] == '') {
                if (count($_POST) > 0) {
	require_once('plugins/recaptcha/recaptchalib.php');
   	$privatekey = "$key_private";
 	$resp = recaptcha_check_answer ($privatekey,
 	$_SERVER["REMOTE_ADDR"],
 	$_POST["recaptcha_challenge_field"],
 	$_POST["recaptcha_response_field"]);
 	if (!$resp->is_valid) {
                    load_template();
                    pageheader($lang_error, "<META http-equiv=\"refresh\" content=\"25;url=report_file.php?album={$_GET['album']}&pid={$_GET['pid']}&pos={$_GET['pos']}\">");
                    msg_box($lang_error,  $recapt_error_back);
                    pagefooter();
                    exit;
           }
return;
		}
            }
            break;
        case 'login.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['login']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['login'] == '') {
                if (isset($_POST['submitted'])) {
	require_once('plugins/recaptcha/recaptchalib.php');
   	$privatekey = "$key_private";
 	$resp = recaptcha_check_answer ($privatekey,
 	$_SERVER["REMOTE_ADDR"],
 	$_POST["recaptcha_challenge_field"],
 	$_POST["recaptcha_response_field"]);
 	if (!$resp->is_valid) {
                    load_template();
                    pageheader($lang_error, "<META http-equiv=\"refresh\" content=\"25;url=login.php\">");
                    msg_box($lang_error,  $recapt_error_back);
                    pagefooter();
                    exit;
}
return;
		}
            }
            break;
        default: ;
    } // switch
}



?>