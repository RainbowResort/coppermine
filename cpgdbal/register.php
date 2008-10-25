<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.0
  $Source: /cvsroot/coppermine/devel/register.php,v $
  $Revision: 5143 $
  $LastChangedBy: gaugau $
  $Date: 2008-10-19 17:04:34 +0530 (Sun, 19 Oct 2008) $
**********************************************/

define('IN_COPPERMINE', true);
define('REGISTER_PHP', true);

require('include/init.inc.php');
require('include/mailer.inc.php');

if (!$CONFIG['allow_user_registration']) {
    cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

if (defined('UDB_INTEGRATION')) {
    $cpg_udb->register_page();
}

/*****************************
* function definitions start *
*****************************/

/**
* display_disclaimer()
*
* Display the disclaimer
*
* @param void
* @return void
**/
function display_disclaimer() { // Display the disclaimer - start
    global $CONFIG, $CPG_PHP_SELF; //, $PHP_SELF;
    global $lang_register_disclamer, $lang_register_php;

    echo <<<EOT
        <form name="cpgform" id="cpgform" method="post" action="$CPG_PHP_SELF">
EOT;
	starttable(-1, cpg_fetch_icon('add_user', 2) . $lang_register_php['term_cond']);
	echo <<<EOT
        <tr>
                <td class="tableb" style="padding: 10px;">

EOT;
    echo str_replace('{SITE_NAME}', $CONFIG['gallery_name'], $lang_register_disclamer);

    echo <<<EOT
                </td>
        </tr>
        <tr>
                <td colspan="2" align="center" class="tablef">
                        <input type="submit" name="agree" value="{$lang_register_php['i_agree']}" class="button" />
                </td>
        </tr>

EOT;
    endtable();
    print '        </form>';
} // Display the disclaimer - end

/**
* input_user_info()
*
* Display the form fields
*
* @param string $errors
* @return void
**/
function input_user_info($errors = '') { // function input_user_info - start
    global $CONFIG, $CPG_PHP_SELF; //, $PHP_SELF;
    global $lang_register_php, $lang_register_disclamer, $lang_common;

    $superCage = Inspekt::makeSuperCage();

    echo <<<EOT
        <form name="cpgform" id="cpgform" method="post" action="$CPG_PHP_SELF">

EOT;

    starttable(-1, cpg_fetch_icon('add_user', 2) . $lang_register_php['enter_info'], 2);

    $inline_disclaimer = str_replace('{SITE_NAME}', $CONFIG['gallery_name'], $lang_register_disclamer);

    $form_data = array(
        array('label', $lang_register_php['required_info']),
        array('input', 'username', $lang_register_php['username'], 25),
        !empty($CONFIG['global_registration_pw']) ? array('password', 'global_registration_pw', $lang_register_php['global_registration_pw'], 25) : '',
        array('password', 'password', $lang_register_php['password'], 25),
        array('password', 'password_verification', $lang_register_php['password_again'], 25),
        array('input', 'email', $lang_register_php['email'], 255),
        array('label', $lang_register_php['optional_info']),
        array('input', 'user_profile1', $CONFIG['user_profile1_name'], 255),
        array('input', 'user_profile2', $CONFIG['user_profile2_name'], 255),
        array('input', 'user_profile3', $CONFIG['user_profile3_name'], 255),
        array('input', 'user_profile4', $CONFIG['user_profile4_name'], 255),
        array('input', 'user_profile5', $CONFIG['user_profile5_name'], 255),
        array('textarea', 'user_profile6', $CONFIG['user_profile6_name'], 255)
        );
    if ($CONFIG['user_registration_disclaimer'] == 2) {
        array_push($form_data,
            array('label', $lang_register_php['term_cond']),
            array('checkbox', 'agree', $inline_disclaimer, $lang_register_php['i_agree'], 1)
            );
    } else {
        array_push($form_data,
            array('hidden', 'agree', 1)
            );
    }

    foreach ($form_data as $element) {
      if (empty($element)) continue;
      switch ($element[0]) {
          case 'label' :
              echo <<<EOT
          <tr>
              <td colspan="2" class="tableh2">
                          {$element[1]}
          </td>
          </tr>

EOT;
            break;

          case 'input' :
              /*if (isset($_POST[$element[1]])) {
                  $value = $_POST[$element[1]];
              } else {
                  $value = '';
              }*/
              if ($superCage->post->keyExists($element[1])) {
                  $value = $superCage->post->getEscaped($element[1]);
              } else {
                  $value = '';
              }
              if ($element[2]) {
                echo <<<EOT
          <tr>
              <td width="40%" class="tableb"  height="25">
                          {$element[2]}
          </td>
          <td width="60%" class="tableb" valign="top">
                  <input type="text" style="width: 100%" name="{$element[1]}" maxlength="{$element[3]}" value="$value" class="textinput" />
                  </td>
          </tr>

EOT;
              }
            break;

          case 'radio' :
              // added the radio option for possible future use. The array definition would have to look like this:
              // array('radio', 'user_var', 'Text label', 'option 1','option 2'),
              // enabling this option requires changes in profile.php and usermgr.php as well
              //if (isset($_POST[$element[1]])) {
              if ($superCage->post->keyExists($element[1])) {
                  $value = $superCage->post->getAlnum($element[1]);
              } else {
                  $value = '';
              }
              if ($element[2]) echo <<<EOT
          <tr>
              <td width="40%" class="tableb"  height="25">
                          {$element[2]}
          </td>
          <td width="60%" class="tableb" valign="top">
                  <input type="radio" name="{$element[1]}" id="{$element[1]}1" value="{$element[3]}" class="radio" /><label for="{$element[1]}1" class="clickable_option">{$element[3]}</label>
                  <input type="radio" name="{$element[1]}" id="{$element[1]}2" value="{$element[4]}" class="radio" /><label for="{$element[1]}2" class="clickable_option">{$element[4]}</label>
                  </td>
          </tr>

EOT;
            break;

          case 'checkbox' :
              // added the checkbox option for possible future use. The array definition would have to look like this:
              // array('radio', 'user_var', 'preceeding text', 'Text label', 'value'),
              // enabling this option requires changes in profile.php and usermgr.php as well
              if ($superCage->post->keyExists($element[1])) {
                  $value = $superCage->post->getAlnum($element[1]);
              } else {
                  $value = '';
              }
              if ($element[3]) echo <<<EOT
          <tr>
              <td class="tableb" colspan="2">
                          {$element[2]}
                          <br />
                          <input type="checkbox" name="{$element[1]}" id="{$element[1]}" value="{$element[4]}" class="checkbox" /><label for="{$element[1]}" class="clickable_option">{$element[3]}</label>
              </td>
          </tr>

EOT;
            break;

          case 'textarea' :
              /*if (isset($_POST[$element[1]])) {
                  $value = $_POST[$element[1]];
              } else {
                  $value = '';
              }*/
              if ($superCage->post->keyExists($element[1])) {
                  $value = $superCage->post->getEscaped($element[1]);
              } else {
                  $value = '';
              }
            if ($element[2]) {
                echo <<<EOT
          <tr>
              <td width="40%" class="tableb"  height="25">
                          {$element[2]}
          </td>
          <td width="60%" class="tableb" valign="top">
                  <textarea name="{$element[1]}" rows="7" cols="60" class="textinput" style="width:100%">$value</textarea>
                  </td>
          </tr>


EOT;
              }
            break;

          case 'password' :
              echo <<<EOT
          <tr>
              <td width="40%" class="tableb"  height="25">
                          {$element[2]}
          </td>
          <td width="60%" class="tableb" valign="top">
                  <input type="password" style="width: 100%" name="{$element[1]}" maxlength="{$element[3]}" value="" class="textinput" />
                  </td>
          </tr>

EOT;
            break;

            case 'hidden' :
                echo <<<EOT
          <tr>
              <td colspan="2" class="tableb">
                <input type="hidden" name="{$element[1]}" value="{$element[2]}" />
              </td>
          </tr>

EOT;
            break;

          default:
              cpg_die(CRITICAL_ERROR, 'Invalid action for form creation ' . $element[0], __FILE__, __LINE__);
      }
    }

    if ($errors) {
        echo <<<EOT
        <tr>
                <td colspan="2" class="tableh2" align="center">
                        <strong>&#149;&nbsp;&#149;&nbsp;&#149;&nbsp;{$lang_register_php['error']}&nbsp;&#149;&nbsp;&#149;&nbsp;&#149;</strong>
                </td>
        </tr>
        <tr>
                <td colspan="2" class="tableb">
                        <ul>$errors</ul>
                </td>
        </tr>

EOT;
    }

    // captcha code
    if ($CONFIG['registration_captcha'] != 0) {
    $help = cpg_display_help('f=empty.htm&amp;base=64&amp;h='.urlencode(base64_encode(serialize($lang_common['captcha_help_title']))).'&amp;t='.urlencode(base64_encode(serialize($lang_common['captcha_help']))),470,245);
    echo <<<EOT
        <tr>
                <td align="right" class="tablef">
                    {$lang_common['confirm']}&nbsp;{$help}
                </td>
                <td class="tablef">
                    <input type="text" name="confirmCode" size="5" maxlength="5" class="textinput" />
                    <img src="captcha.php" align="middle" border="0" alt="" />
                </td>
        </tr>
EOT;
    }

    echo <<<EOT
        <tr>
                <td colspan="2" align="center" class="tablef">
                        <input type="submit" name="submit" value="{$lang_register_php['submit']}" class="button" />
                </td>
        </tr>

EOT;
    endtable();
    print '        </form>';
} // function input_user_info - end

/**
* get_post_var()
*
* Check the posted data
*
* @param array $var
* @return array $var
**/
function get_post_var($var) { // function get_post_var - start
    global $lang_errors;

    $superCage = Inspekt::makeSuperCage();

    if (!$superCage->post->keyExists($var) || !trim($superCage->post->getEscaped($var))) {
    	cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'] . " ($var)", __FILE__, __LINE__);
    }
    return $superCage->post->getEscaped($var);
} // function get_post_var - end

function check_user_info(&$error) { // function check_user_info - start
    global $CONFIG; //, $PHP_SELF;
    global $lang_register_php, $lang_register_confirm_email, $lang_common, $lang_register_approve_email;
    global $lang_register_activated_email, $lang_register_user_login, $lang_errors;
	#####################      DB      ######################	
	global $cpg_db_register_php;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	##################################################	

    $superCage = Inspekt::makeSuperCage();
    //$CONFIG['admin_activation'] = FALSE;
    //$CONFIG['admin_activation'] = TRUE;

    $user_name = trim(get_post_var('username'));
    $password = trim(get_post_var('password'));
    $password_again = trim(get_post_var('password_verification'));
    $email = trim(get_post_var('email'));
    $profile1 = $superCage->post->getEscaped('user_profile1');
    $profile2 = $superCage->post->getEscaped('user_profile2');
    $profile3 = $superCage->post->getEscaped('user_profile3');
    $profile4 = $superCage->post->getEscaped('user_profile4');
    $profile5 = $superCage->post->getEscaped('user_profile5');
    $profile6 = $superCage->post->getEscaped('user_profile6');
    $agree_disclaimer = $superCage->post->getEscaped('agree');
    $captcha_confirmation = $superCage->post->getEscaped('confirmCode');

	/*$sql = "SELECT user_id " . "FROM {$CONFIG['TABLE_USERS']} " . "WHERE user_name = '" . $user_name . "'";
	$result = cpg_db_query($sql);

	if (mysql_num_rows($result)) {
		$error = '<li>' . $lang_register_php['err_user_exists'] . '</li>';
		return false;
	}
	mysql_free_result($result);	*/
	#######################      DB      ########################
	$cpgdb->query($cpg_db_register_php['get_user_id_by_name'], $user_name);
	if (count($cpgdb->fetchRowSet())) {
		$error = '<li>' . $lang_register_php['err_user_exists'] . '</li>';
		return false;
	}
	$cpgdb->free();
	######################################################

    if (utf_strlen($user_name) < 2) $error .= '<li>' . $lang_register_php['err_uname_short'] . '</li>';
    if (!empty($CONFIG['global_registration_pw'])) {
      $global_registration_pw = get_post_var('global_registration_pw');
      if ($global_registration_pw != $CONFIG['global_registration_pw']) {
        $error .= '<li>' . $lang_register_php['err_global_pw'] . '</li>';
      } elseif ($password == $CONFIG['global_registration_pw']) {
        $error .= '<li>' . $lang_register_php['err_global_pass_same'] . '</li>';
      }
    }

    if (utf_strlen($password) < 2) $error .= '<li>' . $lang_register_php['err_password_short'] . '</li>';
    if ($password == $user_name) $error .= '<li>' . $lang_register_php['err_uname_pass_diff'] . '</li>';
    if ($password != $password_again) $error .= '<li>' . $lang_register_php['err_password_mismatch'] . '</li>';
    if (!eregi("^[_\.0-9a-z\-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$", $email)) $error .= '<li>' . $lang_register_php['err_invalid_email'] . '</li>';
    if ($CONFIG['user_registration_disclaimer'] == 2 && $agree_disclaimer != 1) {
        $error .= '<li>' . $lang_register_php['err_disclaimer'] . '</li>';
    }

    // check captcha
    if ($CONFIG['registration_captcha'] != 0) {
        require("include/captcha.inc.php");
        if (!PhpCaptcha::Validate($captcha_confirmation)) {
          $error .= '<li>' . $lang_errors['captcha_error'] . '</li>';
        }
    }

    if ($error != '') return false;

	if (!$CONFIG['allow_duplicate_emails_addr']) {
		/*$sql = "SELECT user_id " . "FROM {$CONFIG['TABLE_USERS']} " . "WHERE user_email = '" . addslashes($email) . "'";
		$result = cpg_db_query($sql);

		if (mysql_num_rows($result)) {
			$error = '<li>' . $lang_register_php['err_duplicate_email'] . '</li>';
			return false;
		}
		mysql_free_result($result);	*/
		#################################       DB       ##############################
		$cpgdb->query($cpg_db_register_php['get_user_id_by_email'], addslashes($email));
		if (count($cpgdb->fetchRowSet())) {
			$error = '<li>' . $lang_register_php['err_duplicate_email'] . '</li>';
			return false;
		}
		$cpgdb->free();
		######################################################################
	}

    if ($CONFIG['reg_requires_valid_email'] || $CONFIG['admin_activation']) {
        $active = 'NO';
        list($usec, $sec) = explode(' ', microtime());
        $seed = (float) $sec + ((float) $usec * 100000);
        srand($seed);
        $act_key = md5(uniqid(rand(), 1));
    } else {
        $active = 'YES';
        $act_key = '';
    }

    $encpassword = md5($password);

	/*$sql = "INSERT INTO {$CONFIG['TABLE_USERS']} ".
			"(user_regdate, user_active, user_actkey, user_name, user_password, user_email, user_profile1, user_profile2, user_profile3, user_profile4, user_profile5, user_profile6) ".
			"VALUES (NOW(), '$active', '$act_key', '$user_name', '$encpassword', '$email', '$profile1', '$profile2', '$profile3', '$profile4', '$profile5', '$profile6')";	*/
	if ($CONFIG['log_mode']) {
		log_write('New user "$user_name" created on '.date("F j, Y, g:i a"),CPG_ACCESS_LOG);
	}
	//$result = cpg_db_query($sql);
	########################################           DB         #########################################
	$cpgdb->query($cpg_db_register_php['add_user'], $active, $act_key, $user_name, $encpassword, $email, 
					$profile1, $profile2, $profile3, $profile4, $profile5, $profile6);
	############################################################################################

	// Create a personal album if corresponding option is enabled
	if ($CONFIG['personal_album_on_registration'] == 1) {
		print 'sub<br />';
		//$catid = mysql_insert_id() + FIRST_USER_CAT;
		$catid = $cpgdb->insertId();	######	cpgdbAL
		print $catid;
		//cpg_db_query("INSERT INTO {$CONFIG['TABLE_ALBUMS']} (`title`, `category`) VALUES ('$user_name', $catid)");
		############################         DB       #############################
		$cpgdb->query($cpg_db_register_php['add_user_album'], $user_name, $catid);
		#################################################################
		print "INSERT INTO {$CONFIG['TABLE_ALBUMS']} (`title`, `category`) VALUES ('$user_name', $catid)";
	}

    if ($CONFIG['reg_requires_valid_email']) {
        if (!$CONFIG['admin_activation']==1) { //user gets activation email
                                        $act_link = rtrim($CONFIG['site_url'], '/') . '/register.php?activate=' . $act_key;
                                        $template_vars = array(
                                                        '{SITE_NAME}' => $CONFIG['gallery_name'],
                                                        '{USER_NAME}' => $user_name,
                                                        '{ACT_LINK}' => $act_link
            );
                                        if (!cpg_mail($email, sprintf($lang_register_php['confirm_email_subject'], $CONFIG['gallery_name']), nl2br(strtr($lang_register_confirm_email, $template_vars)))) {
                                                        cpg_die(CRITICAL_ERROR, $lang_register_php['failed_sending_email'], __FILE__, __LINE__);
                                        }
                                }
        if ($CONFIG['admin_activation']==1) {
                                        msg_box($lang_register_php['information'], $lang_register_php['thank_you_admin_activation'], $lang_common['continue'], 'index.php');
                                } else {
                                        msg_box($lang_register_php['information'], $lang_register_php['thank_you'], $lang_common['continue'], 'index.php');
                                }
    } else {
                                        msg_box($lang_register_php['information'], $lang_register_php['acct_active'], $lang_common['continue'], 'index.php');
    }

    // email notification to admin
        if ($CONFIG['reg_notify_admin_email']) {

                        // get default language in which to inform the admin
                        $lang_register_php_def = cpg_get_default_lang_var('lang_register_php');
                        $lang_register_approve_email_def = cpg_get_default_lang_var('lang_register_approve_email');

                                        if ($CONFIG['admin_activation']==1) {
                                                        $act_link = rtrim($CONFIG['site_url'], '/') . '/register.php?activate=' . $act_key;
                                                        $template_vars = array(
                                                                        '{SITE_NAME}' => $CONFIG['gallery_name'],
                                                                        '{USER_NAME}' => $user_name,
                                                                        '{ACT_LINK}' => $act_link,
                                                        );
                                                        cpg_mail('admin', sprintf($lang_register_php_def['notify_admin_request_email_subject'], $CONFIG['gallery_name']), nl2br(strtr($lang_register_approve_email_def, $template_vars)));
                                        } else {
                                                        cpg_mail('admin', sprintf($lang_register_php_def['notify_admin_email_subject'], $CONFIG['gallery_name']), sprintf($lang_register_php_def['notify_admin_email_body'], $user_name));
                }
                                }

    return true;
}  // function check_user_info - end
/***************************
* function definitions end *
***************************/




/***************************
* main code start          *
***************************/

//if (isset($_GET['activate'])) { // registration activation - start
if ($superCage->get->keyExists('activate')) {
                //$CONFIG['admin_activation'] = FALSE;
                //$CONFIG['admin_activation'] = TRUE;

    //$act_key = addslashes(substr($_GET['activate'], 0 , 32));
    //$act_key = mysql_real_escape_string($superCage->get->getAlnum('activate'));
	$act_key = $cpgdb->escape($superCage->get->getAlnum('activate'));	######	cpgdbAL
    if (strlen($act_key) != 32) cpg_die(ERROR, $lang_register_php['acct_act_failed'], __FILE__, __LINE__);

	/*$sql = "SELECT  user_active, user_email, user_name, user_password " . "FROM {$CONFIG['TABLE_USERS']} " . "WHERE user_actkey = '$act_key' " . "LIMIT 1";
	$result = cpg_db_query($sql);
	if (!mysql_num_rows($result)) cpg_die(ERROR, $lang_register_php['acct_act_failed'], __FILE__, __LINE__);

	$row = mysql_fetch_array($result);
	mysql_free_result($result);	*/
	######################################          DB        ####################################
	$cpgdb->query($cpg_db_register_php['get_user_data'], $act_key);
	$rowset = $cpgdb->fetchRowSet();
	if (!count($rowset)) cpg_die(ERROR, $lang_register_php['acct_act_failed'], __FILE__, __LINE__);
	
	$row = $rowset[0];
	$cpgdb->free();
	####################################################################################

    if ($row['user_active'] == 'YES') cpg_die(ERROR, $lang_register_php['acct_already_act'], __FILE__, __LINE__);

    pageheader($lang_register_php['page_title']);
    $email = $row['user_email'];
    $user_name = $row['user_name'];
    $password = $row['user_password'];

	/*$sql = "UPDATE {$CONFIG['TABLE_USERS']} SET user_active = 'YES' WHERE user_actkey = '$act_key' LIMIT 1";
	$result = cpg_db_query($sql);	*/
	##########################          DB         ##########################
	$cpgdb->query($cpg_db_register_php['set_user_active'], $act_key);
	##############################################################

                if ($CONFIG['admin_activation']==1) { //after admin approves, user receives email notification
                        msg_box($lang_register_php['information'], $lang_register_php['acct_active_admin_activation'], $lang_common['continue'], 'index.php');
                        $site_link = $CONFIG['site_url'];
                        $template_vars = array(
                         '{SITE_LINK}' => $site_link,
                         '{USER_NAME}' => $user_name,
                         '{PASSWORD}' => $password,
                         '{SITE_NAME}' => $CONFIG['gallery_name'],
                                );
                        cpg_mail($email, sprintf($lang_register_php['notify_user_email_subject'], $CONFIG['gallery_name']), nl2br(strtr($lang_register_activated_email, $template_vars)));
                } else { //user self-activated, gets message box that account was activated
                        msg_box($lang_register_php['information'], $lang_register_php['acct_active'], $lang_common['continue'], 'index.php');
                }
  // registration activation - end
} else { // actual registration form logic - start
  pageheader($lang_register_php['page_title']);
  if ($CONFIG['user_registration_disclaimer'] == 1 && !$superCage->post->keyExists('submit') && !$superCage->post->keyExists('agree')) {
      // display the disclaimer page
      display_disclaimer();
  } else {
      //if(isset($_POST['submit']) == FALSE){
      if (!$superCage->post->keyExists('submit')) {
          input_user_info();
      } else {
          if(!check_user_info($errors)) {
            input_user_info($errors);
          }
      }
  }
} // actual registration form logic - end
pagefooter();
ob_end_flush();
?>