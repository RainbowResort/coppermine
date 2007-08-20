<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2007 Coppermine Dev Team
  v0.1 originally written by Nitin Gupta

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision: 2 $
  $LastChangedBy: xnitingupta $
  $Date: 6:01 PM 6/1/2007 $
**********************************************/

define('COPPERMINE_API_VERSION', '0.1');
define('COPPERMINE_API_VERSION_STATUS', 'dev');
define('IN_COPPERMINE', true);
define('USER_GAL_CAT', 1);
define('FIRST_USER_CAT', 10000);

/*
 * Specify the required permission to execute an API command.
 * These permissions may later get overridden by the saved config settings.
 *
 * unauth => user does not need to login
 * login  => only a registered logged in user can execute the command
 * admin  => only an administrator can execute this command
 */
$APITYPE = array(
    'base_install'		=> array('unauth'),
    'install' 			=> array('unauth'),
    'uninstall'			=> array('unauth'),

    'login' 			=> array('unauth'),
    'logout' 			=> array('login'),
    'register' 			=> array('unauth'),
    'activate' 			=> array('unauth'),
    'reactivate'		=> array('unauth'),
    'forgotpassword'	=> array('unauth'),
    'generatepassword'	=> array('unauth'),
    'modifyprofile' 	=> array('login'),

    'getconfig' 		=> array('unauth'),
    'setconfig' 		=> array('login', 'admin'),

    'showusers' 		=> array('login', 'admin'),
    'adduser' 			=> array('login', 'admin'),
    'removeuser' 		=> array('login', 'admin'),
    'updateuser'	 	=> array('login', 'admin'),
    'addgroup' 			=> array('login', 'admin'),
    'removegroup' 		=> array('login', 'admin'),
    'updategroup' 		=> array('login', 'admin'),
    'showgroups' 		=> array('login', 'admin'),
    'addusertogroup'	=> array('login', 'admin'),
    'removeuserfromgroup' => array('login', 'admin'),
    
    'showcategories'	=> array('softlogin'),
    'showmycategories'	=> array('login'),
    'showadmincategories'	=> array('login', 'admin'),
    'createcategory'	=> array('login', 'categoryowner'),
    'viewcategory'		=> array('softlogin', 'categoryview'),
    'modifycategory'	=> array('login', 'categoryowner'),
    'movecategory'		=> array('login', 'categoryowner'),
    'removecategory'	=> array('login', 'categoryowner'),
    
    'createalbum'		=> array('login', 'categoryowner'),
    'viewalbum'			=> array('softlogin', 'albumview'),
    'modifyalbum'		=> array('login', 'albumowner'),
    'movealbum'			=> array('login', 'albumowner'),
    'removealbum'		=> array('login', 'albumowner'),
    
    'addpicture'		=> array('login', 'albumowner'),
    'getpicture'		=> array('softlogin', 'pictureview'),
    'getpicturedata'	=> array('softlogin', 'pictureview'),
    'modifypicture'		=> array('login', 'pictureowner'),
    'movepicture'		=> array('login', 'pictureowner'),
    'removepicture'		=> array('login', 'pictureowner'),
    'createthumb'		=> array('login', 'pictureowner'),
    'getthumb'			=> array('softlogin', 'pictureview'),
    
    'getcomments'		=> array('softlogin', 'pictureview'),
    'getallcomments'	=> array('login', 'pictureowner'),
	'createcomment'		=> array('softlogin', 'pictureview'),
	'approvecomment'	=> array('login', 'pictureowner'),
	'modifycomment'		=> array('login', 'commentowner'),
	'viewcomment'		=> array('login', 'commentview'),
	'removecomment'		=> array('login', 'pictureowner'),
	
	'createvote'		=> array('login', 'pictureview'),
	'getvotes'			=> array('login', 'admin', 'pictureview'),
	'removevote'		=> array('login', 'admin', 'pictureview'),
	
	'gethits'			=> array('login', 'pictureowner'),
	
	'phpinfo'			=> array('login', 'admin')
);

$ALLVARS = array(
	'username'		=> array('string', 'NewUser'),
	'password'		=> array('string', ''),
	'addusername'	=> array('string', 'ExistingUser'),
	'profile1'		=> array('string', ''),
	'profile2'		=> array('string', ''),
	'profile3'		=> array('string', ''),
	'profile4'		=> array('string', ''),
	'profile5'		=> array('string', ''),
	'profile6'		=> array('string', ''),
	'email'			=> array('string', ''),
	'sessionkey'	=> array('string', ''),
	'act_key'		=> array('string', ''),
	'pass_key'		=> array('string', ''),
	'active'		=> array('booleanString', 'NO'),
	'group_id'		=> array('naturalWith0', 0),
	'groupname'		=> array('string', 'New Group'),
	'admin'			=> array('booleanString', 'NO'),
	
	'categoryid'	=> array('naturalWith0', 0),
	'categoryname'	=> array('string', 'New Category'),
	'categorydesc'	=> array('string', 'Description of the new category'),
	
	'albumid'		=> array('naturalWith0', 0),
	'albumname'		=> array('string', 'New Album'),
	'albumdesc'		=> array('string', 'Description of the new album'),

	'pictureid'		=> array('naturalWith0', 0),
	'sid'			=> array('naturalWith0', 0),
	'msgid'			=> array('naturalWith0', 0),
	'msgbody'		=> array('string', '')

);

$GROUPPERMS = array(
	'admin' => 'admin'
);

/*
 * Required system parameters
 */
$DFLT = array('cfg_d' => 'include', // The config file dir
    'cfg_f' => 'config.inc.php', // The config file name
    'ins_f' => 'apiinstall.lock', // The install lock file
    'alb_d' => 'albums', // The album dir
    'upl_d' => 'userpics', // The uploaded pic dir
    'edit_d' => 'edit',
    'lang_d' => 'lang',
    'mail_f' => 'mailer.inc.php',
    'sql_f' => 'cpgAPIschema.sql',
    'sqloff_f' => 'cpgAPIoffschema.sql'
);

/*
 * Require the following basic files and structures to initialize variables
 */
require('cpgAPIdbspecs.php');
require('cpgAPIdisplayspecs.php');
require('cpgAPIcommonfunctions.php');
require('cpgAPIglobalfunctions.php');
require('cpgAPIgdfunctions.php');

$CONFIG = array();
$DISPLAY = new displayspecs();
$DISPLAY->initialize();
$DBS = new dbspecs();
$CF = new commonfunctions();
$GD = new gdfunctions();
$GD->initialize();


/*
 * Print the header
 */
$IS_HEADER = false;
if ($query != "getpicture" && $query != "getthumb" && $query != "phpinfo") {
   $IS_HEADER = true;
   $CF->showheader();
}

$GF = new globalfunctions();
$query = $CF->getuncheckedvariable("query");

if($query == 'base_install') {
  // check if already installed
  $installed = true;
  $fh = @fopen($DFLT['cfg_d'] . "/" . $DFLT['ins_f'], 'r') or $installed = false;

  if ($installed) {
     fclose($fh);
   	 $CF->unsafeexit("install_error");
  }  else {
     // current query is install. let it proceed
     require('cpgAPIinstall.php');
     $INSTALL = new install();
     $INSTALL->baseinstall();
  }
} 

/*
 * Install Application -- open currently for debug only
 * @ dbserver
 * @ dbuser
 * @ dbpass
 * @ dbname
 * @ prefix
 * @ adminusername
 * @ adminpassword
 * @ adminemail
 */
if($query == 'install') {
  // check if already installed
  $installed = true;
  $fh = @fopen($DFLT['cfg_d'] . "/" . $DFLT['ins_f'], 'r') or $installed = false;

  if ($installed) {
     fclose($fh);
   	 $CF->unsafeexit("install_error");
  }  else {
     // current query is install. let it proceed
     require('cpgAPIinstall.php');
     $INSTALL = new install();
     $INSTALL->newinstall($CF->getuncheckedvariable("dbserver"), $CF->getuncheckedvariable("dbuser"), $CF->getuncheckedvariable("dbpass"), $CF->getuncheckedvariable("dbname"), $CF->getuncheckedvariable("prefix"), $CF->getuncheckedvariable("adminusername"), $CF->getuncheckedvariable("adminpassword"), $CF->getuncheckedvariable("adminemail"));
  }
} 

/* 
 * Uninstall Application -- open currently for debug only
 * @ no paramters
 */
if($query == 'uninstall') {
  // current query is uninstall. let it proceed
  require('cpgAPIinstall.php');  
  $INSTALL = new install();
  $INSTALL->uninstall();
}


$API_MODE = 0;

/*
 * First check the install, and then do anything else.
 */
$fh = @fopen($DFLT['cfg_d'] . "/" . $DFLT['ins_f'], 'r') or $CF->unsafeexit("init_error");
fclose($fh);
/*
 * Install is OK. Now include the required files and do initialization
 */
$fh = @fopen($DFLT['cfg_d'] . "/" . $DFLT['cfg_f'], 'r') or $API_MODE = 1;
fclose($fh);

if($API_MODE == 0) {
  require($DFLT['cfg_d'] . "/" . $DFLT['cfg_f']);
} else {
  require("../" . $DFLT['cfg_d'] . "/" . $DFLT['cfg_f']);
}
$DBS->initialize();
require('cpgAPIuserfunctions.php');
$UF = new userfunctions();
require('cpgAPIalbumfunctions.php');
$AF = new albumfunctions();
require('cpgAPIpicturefunctions.php');
$PF = new picturefunctions();
$DBS->sql_connect();

$CONFIG = $GF->getconfig($CONFIG);

require($DFLT['cfg_d'] . "/" . $DFLT['mail_f']);
require($DFLT['lang_d'] . "/" . $CONFIG['lang'] . ".php");

if($API_MODE==0) {
  /*
   * Check the existance of upload folders. If they do not exist, create them
   */
  if (!is_dir($CONFIG['fullpath'])) {
	 mkdir($CONFIG['fullpath'], octdec($CONFIG['default_dir_mode']));
     if (!is_dir($CONFIG['fullpath'])) {
        $CF->unsafeexit('upload_dir_error');
     }
     @chmod($CONFIG['fullpath'], octdec($CONFIG['default_dir_mode'])); //silence the output in case chmod is disabled
  }
  if (!is_dir($CONFIG['fullpath'] . $CONFIG['userpics'])) {
	 mkdir($CONFIG['fullpath'] . $CONFIG['userpics'], octdec($CONFIG['default_dir_mode']));
     if (!is_dir($CONFIG['fullpath'] . $CONFIG['userpics'])) {
        $CF->unsafeexit('upload_dir_error');
     }
     @chmod($CONFIG['fullpath'] . $CONFIG['userpics'], octdec($CONFIG['default_dir_mode'])); //silence the output in case chmod is disabled
  }
} else {
	$CONFIG['fullpath'] = "../" . $CONFIG['fullpath'];
}

/*
 * Query manipulation: authenticate user first
 */
$CURRENT_USER = array(
	'username' => false
	);

if (!isset($APITYPE[$query])) {
   $CF->unsafeexit('unknown_query');
}  else {
   for($i=0; $i < count($APITYPE[$query]); $i++) {
	   if ($APITYPE[$query][$i] == 'unauth') {
   		  /* User does not need any permissions to execute the query */
   		  break;
	   }  else if($APITYPE[$query][$i] == 'login') {
   		  $username = $CF->getvariable("username");
   		  $sessionkey = $CF->getvariable("sessionkey");
   		  $CURRENT_USER = $UF->authenticateuser($username, $sessionkey);
   		  if (!$CURRENT_USER) {
             $CF->unsafeexit("invalid_session_error");
   		  }
	   }  else if($APITYPE[$query][$i] == 'softlogin') {
   		  $username = $CF->getvariable("username");
   		  $sessionkey = $CF->getvariable("sessionkey");
   		  $CURRENT_USER = $UF->authenticateuser($username, $sessionkey);
   		  if (!$CURRENT_USER) {
             $CURRENT_USER = array(
	         	 'username' => false
	         );
   		  }
	   }  else if (isset($GROUPPERMS[$APITYPE[$query][$i]])){
   		  $UF->checkgrouppermission($username, $APITYPE[$query][$i]);
	   }  else {
	   	  switch($APITYPE[$query][$i]) {
	   	  	 case 'categoryowner':
	   	  	 	$categoryid = $CF->getvariable("categoryid");
	   	  	 	if (!$AF->authorizeusercat($CURRENT_USER, $categoryid, "owner")) {
                   $CF->unsafeexit("query_permission_error");
	   	  	 	}
	   	  	 	break;
	   	  	 case 'categoryview' :
	   	  	 	$categoryid = $CF->getvariable("categoryid");
	   	  	 	if (!$AF->authorizeusercat($CURRENT_USER, $categoryid, "view")) {
                   $CF->unsafeexit("query_permission_error");
	   	  	 	}
	   	  	 	break;
	   	  	 case 'albumowner'   :
	   	  	 	$albumid = $CF->getvariable("albumid");
	   	  	 	$albumpassword = $CF->getvariable("albumpassword");
	   	  	 	if (!$AF->authorizeuseralbum($CURRENT_USER, $albumid, "owner", $albumpassword)) {
                   $CF->unsafeexit("query_permission_error");
	   	  	 	}
	   	  	 	break;
	   	  	 case 'albumview'    :
	   	  	 	$albumid = $CF->getvariable("albumid");
	   	  	 	$albumpassword = $CF->getvariable("albumpassword");
	   	  	 	if (!$AF->authorizeuseralbum($CURRENT_USER, $albumid, "view", $albumpassword)) {
                   $CF->unsafeexit("query_permission_error");
	   	  		}
	   	  	 	break;
	   	  	 case 'pictureowner'    :
	   	  	 	$picid = $CF->getvariable("pictureid");
	   	  	 	$albumpassword = $CF->getvariable("albumpassword");
	   	  	 	if (!$PF->authorizeuserpicture($CURRENT_USER, $picid, "owner", $albumpassword)) {
                   $CF->unsafeexit("query_permission_error");
	   	  		}
	   	  	 	break;
	   	  	 case 'pictureview'    :
	   	  	 	$picid = $CF->getvariable("pictureid");
	   	  	 	$albumpassword = $CF->getvariable("albumpassword");
	   	  	 	if (!$PF->authorizeuserpicture($CURRENT_USER, $picid, "view", $albumpassword)) {
                   $CF->unsafeexit("query_permission_error");
	   	  		}
	   	  	 	break;
	   	  	 case 'commentowner'    :
	   	  	 	$msgid = $CF->getvariable("msgid");
	   	  	 	$albumpassword = $CF->getvariable("albumpassword");
	   	  	 	if (!$PF->authorizeusercomment($CURRENT_USER, $msgid, "owner", $albumpassword)) {
                   $CF->unsafeexit("query_permission_error");
	   	  		}
	   	  	 	break;
	   	  	 case 'commentview'    :
	   	  	 	$msgid = $CF->getvariable("msgid");
	   	  	 	$albumpassword = $CF->getvariable("albumpassword");
	   	  	 	if (!$PF->authorizeusercomment($CURRENT_USER, $msgid, "view", $albumpassword)) {
                   $CF->unsafeexit("query_permission_error");
	   	  		}
	   	  	 	break;
	   	  }
	   }
   }
}


switch($query) {

/* Command: login
 * Checks the username and password of a user. Returns a session key along with user data on success. 
 * @ username	The username of the user logging in
 * @ password	The corresponding password
 */
case 'login':
   $username = $CF->getvariable("username");
   $password = $CF->getvariable("password");
   $result = $UF->login($username, $password);
   if (!$result['error']) {
   	  $CF->printMessage("success");
      $CF->printMessage("success");

      $USER_DATA = $UF->getpersonaldata($username);
      $sessionkey = $UF->setlastvisit($username);
      $USER_DATA['sessionkey'] = $sessionkey;
      $UF->showdata($USER_DATA);
   }
   else $CF->printMessage($result['messagecode']);
   break;

/* Command: logout
 * Checks the session key and unsets the session key if authenticated.
 * @ username	The username of the user logging out
 * @ sessionkey	The current session key for this user	
 */
case 'logout':
   $username = $CF->getvariable("username");
   $UF->logout($username);
   $CF->printMessage("success");
   break;

/* Command: showusers
 * Admin specific command to list all users in the system
 * @ username	The username of the admin
 * @ sessionkey	The key of the current admin session
 */
case 'showusers':
   $CF->printMessage("success");
   $USER_DATA = $UF->getalluserdata();
   for($j = 0; $j < count($USER_DATA); $j++) {
      $UF->showdata($USER_DATA[$j]);
   }
   break;

/* Command: register
 * Allows a user to register
 * @ username	The requested username
 * @ password	The password for the new account
 * @ email		Email address of the new user
 * @ profile[]	The six profile admin-defined parameters, optional for register
 */
case 'register':
   $addusername = $CF->getvariable("addusername");
   $password = $CF->getvariable("password");
   $group_id = "2"; // Default group
   $email = $CF->getvariable("email");
   $profile = array();
   for($i=1;$i<=6;$i++) {
      $profile[$i] = $CF->getvariable("profile".$i);
   }
   $USER_DATA = $UF->adduser($addusername, $password, $group_id, $email, $profile);
   if (!$USER_DATA['error']) {
      $CF->printMessage("success");
      $UF->showdata($USER_DATA);
   }
   else $CF->printMessage($USER_DATA['messagecode']);
   break;

/* Command: modifyprofile
 * Allows a user to modify her profile
 * @ username	The username of the current user
 * @ sessionkey	The sessionkey for the current session of this user
 * @ password	A new password if changing password, blank otherwise
 * @ email		The new email address
 * @ profile[]	The six profile admin-defined parameters
 */
case 'modifyprofile':
   $username = $CF->getvariable("username");

   if ($CF->checkvariable("password"))
   	  $password = $CF->getvariable("password");
   else $password = false;
   if ($CF->checkvariable("email"))
      $email = $CF->getvariable("email");
   else $email = false;

   $profile = array();
   for($i=1;$i<=6;$i++) {
      if ($CF->checkvariable("profile".$i))
         $profile[$i] = $CF->getvariable("profile".$i);
      else $profile[$i] = false;
   }

   $USER_DATA = $UF->modifyprofile($username, $password, $email, $profile);
   if (!$USER_DATA['error']) {
      $CF->printMessage("success");
      $UF->showdata($USER_DATA);
   }
   else $CF->printMessage($USER_DATA['messagecode']);
   break;

/* Command: activate
 * Allows a user to activate her account
 * @ username	The username for the account being activated
 * @ act_key	The activation key that was emailed to the user
 */
case 'activate':
   $addusername = $CF->getvariable("addusername");
   $act_key = $CF->getvariable("act_key");

   $USER_DATA = $UF->activate($addusername, $act_key);
   if (!$USER_DATA['error']) {
      $CF->printMessage("success");
      $UF->showdata($USER_DATA);
   }
   else $CF->printMessage($USER_DATA['messagecode']);
   break;

/* Command: reactivate
 * Resends the activation email to a user at the email address provided during
 * registration. Asks for email address as a security check.
 * @ username	The username of the account to be activated
 * @ email		The email address provided during registration
 */
case 'reactivate':
   $addusername = $CF->getvariable("addusername");
   $email = $CF->getvariable("email");

   $USER_DATA = $UF->reactivate($addusername, $email);
   if (!$USER_DATA['error']) {
      $CF->printMessage("success");
   }
   else $CF->printMessage($USER_DATA['messagecode']);
   break;

/* Command: forgotpassword
 * Sends an email to the user to confirm if she requested a new password. The
 * email contains a password key required for generating new password.
 * @ username	The username for the account with forgotten password
 * @ email		The email address associated with the account
 */
case 'forgotpassword':
   $addusername = $CF->getvariable("addusername");
   $email = $CF->getvariable("email");

   $USER_DATA = $UF->forgotpassword($addusername, $email);
   if (!isset($USER_DATA['error']) || !$USER_DATA['error']) {
      $CF->printMessage("success");
   }
   else $CF->printMessage($USER_DATA['messagecode']);
   break;

/* Command: generatepassword
 * Generates a new password for the user. Requires her to use the password key
 * contained in the email sent by forgotpassword.
 * @ username	The username of the account with forgotten password
 * @ pass_key	The password key included in the forgot password email
 */
case 'generatepassword':
   $addusername = $CF->getvariable("addusername");
   $pass_key = $CF->getvariable("pass_key");

   $USER_DATA = $UF->generatepassword($addusername, $pass_key);
   if (!isset($USER_DATA['error']) || !$USER_DATA['error']) {
      $CF->printMessage("success");
      $UF->showdata($USER_DATA);
   }
   else $CF->printMessage($USER_DATA['messagecode']);
   break;

/* Command: adduser
 * Admin specific command that allows an admin to add a user to the system. The user is by default
 * added to the group of "Registered" users.
 * @ username		The username of the admin
 * @ sessionkey		The key of the current admin session
 * @ addusername	Username for the new user 
 * @ password		Password for the new user
 * @ email			Email address of the new user
 */
case 'adduser':
   $addusername = $CF->getvariable("addusername");
   $password = $CF->getvariable("password");
   $group_id = "2"; // Default group
   $email = $CF->getvariable("email");
   $profile = array();
   for($i=1;$i<=6;$i++) {
      $profile[$i] = "";
   }
   $USER_DATA = $UF->adduser($addusername, $password, $group_id, $email, $profile);
   if (!isset($USER_DATA['error']) || !$USER_DATA['error']) {
      $CF->printMessage("success");
      $UF->showdata($USER_DATA);
   }
   else $CF->printMessage($USER_DATA['messagecode']);
   break;

/* Command: removeuser
 * Admin specific command allowing her to remove a user from the system
 * @ username		The username of the admin
 * @ sessionkey		The key of the current admin session
 * @ addusername	The username of the user being removed
 */
case 'removeuser':
   $addusername = $CF->getvariable("addusername");

   if($addusername == $username) {
      $CF->safeexit("cannot_remove_self");
   }

   $USER_DATA = $UF->removeuser($addusername);
   if ($USER_DATA) {
      $CF->printMessage("success");
      $UF->showdata($USER_DATA);
   }
   else $CF->printMessage("username_not_exist");
   break;

/* Command: updateuser
 * Admin specific command allowing her to update the basic information for any user
 * Admin specific command allowing her to remove a user from the system
 * @ username		The username of the admin
 * @ sessionkey		The key of the current admin session
 * @ addusername	The username of the account being updated
 * @ password		A new password for this account, if the password is being changed. Blank otherwise.	
 * @ email			The email address for this account
 * @ active			The activation condition of this account
 */
case 'updateuser':
   $addusername = $CF->getvariable("addusername");

   if ($CF->checkvariable("password"))
   	  $password = $CF->getvariable("password");
   else $password = false;
   if ($CF->checkvariable("email"))
      $email = $CF->getvariable("email");
   else $email = false;
   if ($CF->checkvariable("active"))
      $active = $CF->getvariable("active");
   else $active = false;

   $USER_DATA = $UF->updateuser($addusername, $password, $email, $active);
   if (!isset($USER_DATA['error']) || !$USER_DATA['error']) {
      $CF->printMessage("success");
      $UF->showdata($USER_DATA);
   }
   else $CF->printMessage($USER_DATA['messagecode']);
   break;

/* Command: showgroups
 * Admin specific command to list all groups in the system
 * @ username	The username of the admin
 * @ sessionkey	The key of the current admin session
 */
 case 'showgroups':
   $GROUP_DATA = $UF->getallgroupdata();
   $CF->printMessage("success");
   $UF->showmultigroupdata($GROUP_DATA);
   break;

/* Command: addgroup
 * Admin specific command to add a group in the system
 * @ username	The username of the admin
 * @ sessionkey	The key of the current admin session
 * @ groupname	The name of the new group
 * @ admin		Boolean value of the "admin" property of the group
 */
case 'addgroup':
   $groupname = $CF->getvariable("groupname");
   $admin = $CF->getvariable("admin"); if($admin=="") $admin = "NO";

   $GROUP_DATA = $UF->addgroup($groupname, $admin);
   if (!isset($GROUP_DATA['error']) || !$GROUP_DATA['error']) {
      $CF->printMessage("success");
      $UF->showgroupdata($GROUP_DATA);
   }
   else $CF->printMessage($GROUP_DATA['messagecode']);
   break;

/* Command: updategroup
 * Admin specific command to update an existing group
 * @ username	The username of the admin
 * @ sessionkey	The key of the current admin session
 * @ groupname	The name of the group to be updated
 * @ admin		Boolean value of the "admin" property of the group
 */
case 'updategroup':
   $group_id = $CF->getvariable("group_id");
   $groupname = $CF->getvariable("groupname");
   $admin = $CF->getvariable("admin");
   if($admin=="") $admin = "NO";

   $GROUP_DATA = $UF->updategroup($group_id, $groupname, $admin);
   if (!isset($GROUP_DATA['error']) || !$GROUP_DATA['error']) {
      $CF->printMessage("success");
      $UF->showgroupdata($GROUP_DATA);
   }
   else $CF->printMessage($GROUP_DATA['messagecode']);
   break;

/* Command: removegroup
 * Admin specific command to remove an existing group from the system. Destroys
 * the related entries in the user list having this group.
 * @ username	The username of the admin
 * @ sessionkey	The key of the current admin session
 * @ group_id	The integral value of the id of the group to be removed
 */
case 'removegroup':
   $group_id = $CF->getvariable("group_id");

   if ($group_id <= 4) {
      $CF->printMessage("reserved_group_remove_error");
   }  else {
      $GROUP_DATA = $UF->removegroup($group_id);
      if ($GROUP_DATA) {
         $CF->printMessage("success");
         $UF->showgroupdata($GROUP_DATA);
      }
      else $CF->printMessage("group_not_exist");
   }
   break;

/* Command: addusertogroup
 * Admin specific command to add an existing user to an existing group
 * @ username		The username of the admin
 * @ sessionkey		The key of the current admin session
 * @ addusername	The id of the user who has to be added to the group
 * @ group_id		The id of the group to which the user has to be added
 */
case 'addusertogroup':
   $addusername = $CF->getvariable("addusername");
   $group_id = $CF->getvariable("group_id");

   $USER_DATA = $UF->addusertogroup($addusername, $group_id);
   if (!isset($USER_DATA['error']) || !$USER_DATA['error']) {
      $CF->printMessage("success");
      $UF->showdata($USER_DATA);
   }
   else $CF->printMessage($USER_DATA['messagecode']);
   break;

/* Command: removeuserfromgroup
 * Admin specific command to remove an existing user from an existing group
 * @ username		The username of the admin
 * @ sessionkey		The key of the current admin session
 * @ addusername	The id of the user who has to be removed from the group
 * @ group_id		The id of the group from which the user has to be removed
 */
case 'removeuserfromgroup':
   $addusername = $CF->getvariable("addusername");
   $group_id = $CF->getvariable("group_id");

   if($addusername == $username) {
      $CF->safeexit("cannot_remove_self_from_group");
   }

   $USER_DATA = $UF->removeuserfromgroup($addusername, $group_id);
   if (!isset($USER_DATA['error']) || !$USER_DATA['error']) {
      $CF->printMessage("success");
      $UF->showdata($USER_DATA);
   }
   else $CF->printMessage($USER_DATA['messagecode']);
   break;

/* Command: getconfig
 * Returns all parameters for application configuration. To see a list of parameters, see
 * the $config variable in the cpgAPIdisplayspecs file.
 * @ no parameters
 */
case 'getconfig':
   $CF->printMessage("success");
   print "<config>";
   for($i=0; $i<count($DISPLAY->configfields); $i++) {
      print "<" . $DISPLAY->configfields[$i] . ">";
      print $CONFIG[$DISPLAY->configfields[$i]];
      print "</" . $DISPLAY->configfields[$i] . ">";
   }
   print "</config>";
   break;

/* Command: setconfig
 * Admin specific command to set the parameters for application configuration. Only the parameters
 * visible using the getconfig command can be set using this command.
 * @ username		The username of the admin
 * @ sessionkey		The key of the current admin session
 * @ parametername	The name of the parameter to be set
 */
case 'setconfig':
   for($i=0;$i < count($DISPLAY->configfields); $i++) {
      if ($CF->checkvariable($DISPLAY->configfields[$i])) {
         // known languages only
         if ($DISPLAY->configfields[$i]=="lang") {
            $lang = $CF->getvariable("lang");
            if ($lang=="english" || $lang=="german")
               $CONFIG[$DISPLAY->configfields[$i]] =  $CF->getvariable("lang");
         }  else {
            $CONFIG[$DISPLAY->configfields[$i]] =  $CF->getvariable($DISPLAY->configfields[$i]);
         }
      }
   }
   $GF->setconfig($CONFIG);

   $CF->printMessage("success");
   print "<config>";
   for($i=0; $i<count($DISPLAY->configfields); $i++) {
      print "<" . $DISPLAY->configfields[$i] . ">";
      print $CONFIG[$DISPLAY->configfields[$i]];
      print "</" . $DISPLAY->configfields[$i] . ">";
   }
   print "</config>";
   break;

/* Command: createcategory
 * Command to create a new category (analogously gallery). Can be invoked by both users and admin.
 * However, users must give a non-zero value for the parent category, and the new category
 * is visible only to them. 
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ categoryid		The id of the parent category
 * @ categoryname	The name of the new category
 * @ categorydesc	The description of the new category
 */
case 'createcategory':
   $categoryid = $CF->getvariable("categoryid"); // Parent category
   $addcategoryname = $CF->getvariable("categoryname");
   $addcategorydesc = $CF->getvariable("categorydesc");
   if ($UF->isAdmin($CURRENT_USER['username'])) {
      if ($categoryid == "0") {
   	     $isadmincategory = 1;
   	  }  else {
   	     $results = $DBS->sql_query("SELECT * FROM {$DBS->categorytable} WHERE {$DBS->catfield['cid']}=" . $categoryid);
   	     $ownerid = mysql_result($results, 0, $DBS->catfield['ownerid']);
   	     if ($ownerid == 0) {
   	        $isadmincategory = 1;
   	     }
   	  }
   }
   $CF->printMessage("success");
   $AF->showSingleCategoryData($AF->createCategory($CURRENT_USER, $addcategoryname, $addcategorydesc, $categoryid, $isadmincategory));
   break;

/* Command: modifycategory
 * Command to modify an existing category. Can be invoked by both users and admin.
 * However, users can update only the categories they own or their group is responsible for.
 * Admin can modify all categories.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ categoryid		The id of the category to be modified
 * @ categoryname	(optional) A new name for the category
 * @ categorydesc	(optional) A new description for the category
 * @ categoryparent	(optional) Id for a new parent category for this category
 * @ categorythumb	(optional) Id of the picture which is the thumbnail for this category
 */
case 'modifycategory':
   $categoryid = $CF->getvariable("categoryid");
   
   if ($CF->checkvariable("categoryname"))
   	  $categoryname = $CF->getvariable("categoryname");
   else $categoryname = false;
   if ($CF->checkvariable("categorydesc"))
      $categorydesc = $CF->getvariable("categorydesc");
   else $categorydesc = false;
   if ($CF->checkvariable("categoryparent"))
      $categoryparent = $CF->getvariable("categoryparent");
   else $categoryparent = false;
   if ($CF->checkvariable("categorythumb"))
      $categorythumb = $CF->getvariable("categorythumb");
   else $categorythumb = false;
   
   if ($categoryparent == $categoryid) {
   	  $categoryparent = 0;
   }
   $CF->printMessage("success");
   $AF->showSingleCategoryData($AF->modifyCategory($CURRENT_USER, $categoryid, $categoryname, $categorydesc, $categoryparent, $categorythumb));
   break;

/* Command: viewcategory
 * Command to get the recursive view of an existing category (analogously gallery).
 * Can be invoked by both users and admin.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ categoryid		The id of the required category
 */
case 'viewcategory':
   $categoryid = $CF->getvariable("categoryid");
   $CF->printMessage("success");
   $AF->showCategoryData($AF->getCategoryData($categoryid), $CURRENT_USER);
   break;

/* Command: movecategory
 * Command to change the position of an existing category. Can be invoked by both users and admin.
 * However, users can move only the categories they own or their group is responsible for.
 * Admin can move all categories.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ categoryid		The id of the category to be moved
 * @ categorypos	The new position of the category
 */
case 'movecategory':
   $categoryid = $CF->getvariable("categoryid"); // Parent category
   $categorypos = $CF->getvariable("categorypos");
   if ($AF->moveCategory($CURRENT_USER, $categoryid, $categorypos))
      $CF->printMessage("success");
   else
      $CF->printMessage("could_not_move");   
   break;

/* Command: removecategory
 * Command to remove an existing category from the system. Can be invoked by both users and admin.
 * However, users can remove only the categories they own or their group is responsible for.
 * Admin can remove all categories.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ categoryid		The id of the category to be removed
 */
case 'removecategory':
   $categoryid = $CF->getvariable("categoryid");
   $AF->removeCategory($categoryid);
   $CF->printMessage("success");
   break;

/* Command: showcategories
 * Command to get the recursive view of all categories visible to a user.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 */
case 'showcategories':
   $CF->printMessage("success");
   $AF->showCategories($CURRENT_USER);
   break;
   
/* Command: showmycategories
 * Command to get the recursive view of all categories owned by the current user.
 * For administrators, this command does NOT return admin-owned categories.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 */
case 'showmycategories':
   $CF->printMessage("success");
   $AF->showUserCategories($CURRENT_USER);
   break;

/* Command: showadmincategories
 * Admin specific command to show the recursive view of all admin-owned categories,
 * i.e. the categories visible to all users.
 * @ username		The username of the admin
 * @ sessionkey		The key of the current admin session
 */
case 'showadmincategories':
   $CF->printMessage("success");
   $AF->showAdminCategories($CURRENT_USER);
   break;

/* Command: createalbum
 * Command to create a new album. Can be invoked by both users and admin. Users can create
 * albums in only those categories which they own, or for which their groups are responsible.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ categoryid		The id of the parent category
 * @ albumname		The name of the new album
 * @ albumdesc		The description of the new album
 * @ albumkeywords	The keywords describing of the new album
 */
case 'createalbum':
   $categoryid = $CF->getvariable("categoryid"); // Parent category
   // NG - INCOMPATIBLE
   if ($categorid == 1) {
   	  $categoryid = FIRST_USER_CAT + $userid;
   }
   $addalbumname = $CF->getvariable("albumname");
   $addalbumdesc = $CF->getvariable("albumdesc");
   $addalbumkeywords = $CF->getvariable("albumkeywords");
   $CF->printMessage("success");
   $AF->showSingleAlbumData($AF->createAlbum($addalbumname, $addalbumdesc, $addalbumkeywords, $categoryid));
   break;

/* Command: modifyalbum
 * Command to modify an existing album. Can be invoked by both users and admin.
 * However, users can update only the albums they own or their group is responsible for.
 * Admin can modify all albums.
 * @ username			The username of the current user
 * @ sessionkey			The sessionkey for the current session of this user
 * @ albumid			The id of the album to be modified
 * @ albumname			(optional) A new name for the album
 * @ albumdesc			(optional) A new description for the album
 * @ albumkeywords		(optional) Keywords describing the album
 * @ albumthumb			(optional) Id of the picture which is the thumbnail for this album
 * @ albumpassword		(optional) Password required for a non-owner to access the album
 * @ albumpasswordhint	(optional) Hint given to a user to guess the password for the album
 */
case 'modifyalbum':
   $albumid = $CF->getvariable("albumid");
   
   if ($CF->checkvariable("albumname"))
   	  $albumname = $CF->getvariable("albumname");
   else $albumname = false;
   if ($CF->checkvariable("albumdesc"))
      $albumdesc = $CF->getvariable("albumdesc");
   else $albumdesc = false;
   if ($CF->checkvariable("albumthumb"))
      $albumthumb = $CF->getvariable("albumthumb");
   else $albumthumb = false;
   if ($CF->checkvariable("albumkeywords"))
      $albumkeywords = $CF->getvariable("albumkeywords");
   else $albumkeywords = false;
   if ($CF->checkvariable("albumpassword"))
      $albumpassword = $CF->getvariable("albumpassword");
   else $albumpassword = false;
   if ($CF->checkvariable("albumpasswordhint"))
      $albumpasswordhint = $CF->getvariable("albumpasswordhint");
   else $albumpasswordhint = false;
   
   $CF->printMessage("success");
   $AF->showSingleAlbumData($AF->modifyAlbum($albumid, $albumname, $albumdesc, $albumthumb, $albumpassword, $albumpasswordhint));
   break;

/* Command: viewalbum
 * Command to get the view of an existing album along with details on the contained pictures.
 * Can be invoked by both users and admin.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ albumid		The id of the required album
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */
case 'viewalbum':
   $albumid = $CF->getvariable("albumid");
   $AF->registerAlbumHit($albumid);
   $CF->printMessage("success");
   $AF->showAlbumData($AF->getAlbumData($albumid));
   break;

/* Command: movealbum
 * Command to change the position of an existing album. Can be invoked by both users and admin.
 * However, users can move only the albums they own or their group is responsible for.
 * Admin can move all albums.
 * @ username	The username of the current user
 * @ sessionkey	The sessionkey for the current session of this user
 * @ albumid	The id of the album to be moved
 * @ albumpos	The new position of the album
 */
case 'movealbum':
   $albumid = $CF->getvariable("albumid");
   $albumpos = $CF->getvariable("albumpos");
   if ($AF->moveAlbum($albumid, $albumpos))
      $CF->printMessage("success");
   else
      $CF->printMessage("could_not_move");   
   break;
   
/* Command: removealbum
 * Command to remove an existing album from the system. Can be invoked by both users and admin.
 * However, users can remove only the albums they own or their group is responsible for.
 * Admin can remove all albums.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ albumid		The id of the album to be removed
 */
case 'removealbum':
   $albumid = $CF->getvariable("albumid");
   $AF->removeAlbum($albumid);
   $CF->printMessage("success");
   break;

/* Command: addpicture
 * Command to add a new picture to an existing album. Can be invoked by both users and admin.
 * However, users can only add pictures to albums they own or their group is responsible for.
 * Admin can add pictures anywhere.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ albumsid		The id of the parent album
 * @ pictitle		A title for the picture
 * @ piccaption		A caption for the picture
 * @ pickeywords	Keywords describing the picture
 * @ user1			Value corresponding to system defined user field 1
 * @ user2			Value corresponding to system defined user field 2
 * @ user3			Value corresponding to system defined user field 3
 * @ user4			Value corresponding to system defined user field 4
 * @ filename		(optional) The name of the file being uploaded
 * @ filecontents	(optional) The binary data for the file being uploaded
 * @ _FILE[file]	(optional) The file upload parameter to be passed if using HTML forms
 */
case 'addpicture':
   $albumid = $CF->getvariable("albumid");
   $pictitle = $CF->getvariable("pictitle");
   $piccaption = $CF->getvariable("piccaption");
   $pickeywords = $CF->getvariable("pickeywords");
   $user1 = $CF->getvariable("user1");
   $user2 = $CF->getvariable("user2");
   $user3 = $CF->getvariable("user3");
   $user4 = $CF->getvariable("user4");   
   
   if (isset($_FILES['file'])) {
      if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
         $filename = $_FILES['file']['name']; // file name 
         $pos = strrpos($filename, ".");
   	     if ($pos) { 
   	  	    $extension = substr($filename, $pos+1);
            if ($PF->checkExtension($extension)) {
               $picid = $PF->addPicture($albumid, $pictitle, $piccaption, $pickeywords, $filename, $extension, $_FILES['file']['size'], $CURRENT_USER['username'], $CURRENT_USER['user_id'], $user1, $user2, $user3, $user4);
               if ($picid) {
                  $CF->printMessage("success");
                  $PF->showPictureData($PF->getPictureData($picid));            	   
   	  	 	      $filepath = $PF->getPicturePath($picid);
                  // Upload the file
            	  move_uploaded_file($_FILES['file']['tmp_name'], $filepath);
         	      @chmod($filepath, octdec($CONFIG['default_file_mode']));
               }  else {
         	      $PF->removePicture($picid);
                  $CF->printMessage("upload_error"); 
               }
   	  	    }  else {
      	       $CF->printMessage("unknown_extension");       		   	  	 	
   	  	    } 
   	     }  else {
         	$CF->printMessage("unknown_extension");    	     	
   	     }
      }  elseif ($_FILES['file']['error'] == UPLOAD_ERR_INI_SIZE) {
         $CF->printMessage("max_upload_size_exceed"); 
      }  else { 
         $CF->printMessage("upload_error"); 
      }
   }  else if ($CF->checkvariable("filename")) {
   	  $filename = $CF->getvariable("filename");
      $filecontents = $CF->getvariable("filecontents");
   	  $pos = strrpos($filename, ".");
   	  if ($pos) { 
   	  	 $extension = substr($filename, $pos+1);
   	  	 if ($PF->checkExtension($extension)) {
      	    $picid = $PF->addPicture($albumid, $pictitle, $piccaption, $pickeywords, $filename, $extension, strlen($filecontents), $CURRENT_USER['username'], $CURRENT_USER['user_id'], $user1, $user2, $user3, $user4);
      	    if ($picid) {
   	  	 	   $filepath = $PF->getPicturePath($picid);
        	   // Upload the file
               $CF->printMessage("success");         	       
               $PF->showPictureData($PF->getPictureData($picid));            	   
      	       if ($fh = @fopen($filepath, "w")) {
				   fwrite($fh, $filecontents);      	       	
         	       fclose($fh);
         	       @chmod($filepath, octdec($CONFIG['default_file_mode']));
         	    }  else {
         	       $PF->removePicture($picid);
         	       $CF->printMessage("upload_error");       		
      	       }
      	    }  else {
               $CF->printMessage("upload_error");       		      	 	
      	    }   	  	 	
   	  	 }  else {
      	    $CF->printMessage("unknown_extension");       		   	  	 	
   	  	 } 
      }  else {
      	 $CF->printMessage("unknown_extension");       		
      }
   }  else {
      $CF->printMessage("upload_error");       		   	
   }
   
   break;

/* Command: getpicture
 * Command to fetch a picture. Can be invoked by both users and admin.
 * However, users can only fetch the pictures they have authorization to see.
 * Admin can access all pictures.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture to be fetched
 * @ searchphrase	The value to be put into the hit statistic for this picture, if fetched as the result of a search
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */
case 'getpicture':
   $pictureid = $CF->getvariable("pictureid");
   $search_phrase = $CF->getvariable("searchphrase");
   $PF->registerPictureHit($pictureid, $search_phrase);
   $PICTURE_DATA = $PF->showPicture($pictureid);
   if (!$PICTURE_DATA['error']) {
   	   exit(0);
   }  else {
      $CF->showheader();
      $IS_HEADER = true;
      $CF->printMessage($PICTURE_DATA['messagecode']);
   }

/* Command: getpicturedata
 * Command to get the metadata associated with a picture. Also returns the comments of
 * this picture. Can be invoked by both users and admin.
 * However, users can only get the data for pictures they have authorization to see.
 * Admin can access all pictures.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture whose metadata is required
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */
case 'getpicturedata':
   $pictureid = $CF->getvariable("pictureid");
   $PICTURE_DATA = $PF->getPictureData($pictureid);
   if (!$PICTURE_DATA['error']) {
      $CF->printMessage("success");
      $PF->showPictureData($PICTURE_DATA);
   }
   else $CF->printMessage($PICTURE_DATA['messagecode']);
   break;

/* Command: movepicture
 * Command to change the position of an existing picture. Can be invoked by both users and admin.
 * However, users can move only the pictures they own or their group is responsible for.
 * Admin can move all pictures.
 * @ username	The username of the current user
 * @ sessionkey	The sessionkey for the current session of this user
 * @ pictureid	The id of the picture to be moved
 * @ picturepos	The new position of the picture
 */
case 'movepicture':
   $pictureid = $CF->getvariable("pictureid");
   $picturepos = $CF->getvariable("picturepos");
   if ($PF->movePicture($pictureid, $picturepos))
      $CF->printMessage("success");
   else
      $CF->printMessage("could_not_move");   
   break;

/* Command: modifypicture
 * Command to modify the metadata associated with a picture. Can be invoked by both users and admin.
 * However, users can only modify the data for pictures they own or their group is responsible for.
 * Admin can access all pictures.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture whose metadata is required
 * @ pictitle		(optional) A new title for the picture
 * @ piccaption		(optional) A new caption for the picture
 * @ pickeywords	(optional) Keywords describing the picture
 * @ user1			(optional) Value corresponding to system defined user field 1
 * @ user2			(optional) Value corresponding to system defined user field 2
 * @ user3			(optional) Value corresponding to system defined user field 3
 * @ user4			(optional) Value corresponding to system defined user field 4
 */
case 'modifypicture':
   $pictureid = $CF->getvariable("pictureid");
   
   if ($CF->checkvariable("pictitle"))
   	  $pictitle = $CF->getvariable("pictitle");
   else $pictitle = false;
   if ($CF->checkvariable("piccaption"))
      $piccaption = $CF->getvariable("piccaption");
   else $piccaption = false;
   if ($CF->checkvariable("pickeywords"))
      $pickeywords = $CF->getvariable("pickeywords");
   else $pickeywords = false;
   if ($CF->checkvariable("user1"))
      $user1 = $CF->getvariable("user1");
   else $user1 = false;
   if ($CF->checkvariable("user2"))
      $user2 = $CF->getvariable("user2");
   else $user2 = false;
   if ($CF->checkvariable("user3"))
      $user3 = $CF->getvariable("user3");
   else $user3 = false;
   if ($CF->checkvariable("user4"))
      $user4 = $CF->getvariable("user4");
   else $user4 = false;
   
   $CF->printMessage("success");
   $PF->showPictureData($PF->modifyPictureData($pictureid,  $pictitle, $piccaption, $pickeywords, $user1, $user2, $user3, $user4));
   break;

/* Command: removepicture
 * Command to remove an picture from an album in the system. Can be invoked by both users and admin.
 * However, users can remove only the pictures they own or their group is responsible for.
 * Admin can remove all albums.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture to be removed
 */
case 'removepicture':
   $pictureid = $CF->getvariable("pictureid");
   $PF->removePicture($pictureid);
   $CF->printMessage("success");
   break;

/* Command: createthumb
 * Command to create the thumbnail for a picture. Requires GD. Can be invoked by both users and admin.
 * However, users can only create thumbnails for pictures they own or their group is responsible for.
 * Admin can access all pictures.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture whose metadata is required
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */
case 'createthumb':
   if(!$GD->GD_SUPPORTED) {
      $CF->safeexit('gd_not_supported');   	
   }
   if(!$GD->GD_ENABLED) {
      $CF->safeexit('gd_not_enabled');   	
   }
   $pictureid = $CF->getvariable("pictureid");
   
   $picturepath = $PF->getPicturePath($pictureid);
   if ($picturepath) {
      if ($GD->createthumb($picturepath, $picturepath . ".thumb", $CONFIG['thumb_width'], $CONFIG['thumb_height'])) {
         $CF->printMessage("success");
      }  else {
      	 $CF->printMessage("could_not_create_thumb");
      }  	  
   }
   break;

/* Command: getthumb
 * Command to fetch a thumbnail. Can be invoked by both users and admin.
 * However, users can only fetch the thumbnails they have authorization to see.
 * Admin can access all thumbnails.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture whose thumbnail is to be fetched
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */
case 'getthumb':
   $pictureid = $CF->getvariable("pictureid");
   $PICTURE_DATA = $PF->showThumbNail($pictureid);
   if (!$PICTURE_DATA['error']) {
   	   exit(0);
   }  else {
      $CF->showheader();   	
      $IS_HEADER = true;
      $CF->printMessage($PICTURE_DATA['messagecode']);
   }
   break;

/* Command: createcomment
 * Command to create a new comment. Can be invoked by both users and admin. Users can create
 * comments on any picture that they can see.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture commented
 * @ authorname		(optional) Name of the comment author
 * @ msgbody		The body of the comment
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */
case 'createcomment':
   $pictureid = $CF->getvariable("pictureid");
   if (!$CURRENT_USER['username']) {
      $authorname = $CONFIG['comments_anon_pfx'] . $CF->getvariable("authorname");
      $authorid = "0";
   }  else {
   	  $authorname = $CURRENT_USER['username'];
   	  $authorid = $CURRENT_USER['user_id'];
   }
   $msgbody = $CF->getvariable("msgbody");
   $CF->printMessage("success");
   $PF->createComment($pictureid, $msgbody, $authorname, $authorid);
   $PF->showPictureData($PF->getPictureData($pictureid));
   break;

/* Command: approvecomment
 * Command to approve an existing comment. Can be invoked by both picture owner and admin. 
 * @ username	The username of the current user
 * @ sessionkey	The sessionkey for the current session of this user
 * @ msgid		The id of the comment to be approved
 */
case 'approvecomment':
   $msgid = $CF->getvariable("msgid");
   $COMMENT_DATA = $PF->approveComment($msgid);
   if (!$COMMENT_DATA['error']) {
      $CF->printMessage("success");
      $PF->showCommentData($COMMENT_DATA);
   }
   else $CF->printMessage($COMMENT_DATA['messagecode']);
   break;

/* Command: viewcomment
 * Command to view an existing comment. Can be invoked by both users and admin. Users can view
 * comments on any picture that they can see.
 * @ username	The username of the current user
 * @ sessionkey	The sessionkey for the current session of this user
 * @ msgid		The id of the comment to be viewed
 */
case 'viewcomment':
   $msgid = $CF->getvariable("msgid");
   $COMMENT_DATA = $PF->getCommentData($msgid);
   if (!$COMMENT_DATA['error']) {
      $CF->printMessage("success");
      $PF->showCommentData($COMMENT_DATA);
   }
   else $CF->printMessage($COMMENT_DATA['messagecode']);
   break;

/* Command: getcomments
 * Command to get all info about the approved comments of an existing picture.
   Can be invoked by anyone.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture whose votes are required
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */
case 'getcomments':
   $pictureid = $CF->getvariable("pictureid");
   $CF->printMessage("success");
   $PF->showComments($pictureid);
   break;

/* Command: getallcomments
 * Command to get all info about all of the comments of an existing picture.
   Can be invoked only by picture owner, album owner or admin.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture whose votes are required
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */
case 'getallcomments':
   $pictureid = $CF->getvariable("pictureid");
   $CF->printMessage("success");
   $PF->showAllComments($pictureid);
   break;

/* Command: modifycomment
 * Command to modify a comment. Can be invoked by only the user who originally wrote the comment, or admin.
 * 
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ msgid			The id of the comment to be modified
 * @ msgbody		(optional) A new body of the comment
 */
case 'modifycomment':
   $msgid = $CF->getvariable("msgid");
   if ($CONFIG['comment_user_edit']) {
      if ($CF->checkvariable("msgbody"))
         $msgbody = $CF->getvariable("msgbody");
      else $msgbody = false;
      $CF->printMessage("success");
      $PF->showCommentData($PF->modifyComment($msgid,  $msgbody));      
   }  else {
   	  $CF->printMessage('cannot_edit_comment');
   }
   break;

/* Command: removecomment
 * Command to remove an existing comment from the system. Can be invoked by both users and admin.
 * However, users can remove comments that they have written, or from the pictures they own or their group is responsible for.
 * Admin can remove all comments.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ msgid			The id of the comment to be removed
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */
case 'removecomment':
   $msgid = $CF->getvariable("msgid");
   $PF->removeComment($msgid);
   $CF->printMessage("success");
   break;

/* Command: createvote
 * Command to create a new vote. Can be invoked by both users and admin. Users can create
 * vote on any picture that they can see.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture voted
 * @ rating			Rating of the vote
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */
case 'createvote':
   $pictureid = $CF->getvariable("pictureid");
   $rating = $CF->getvariable("rating");
   $CF->printMessage("success");
   $PF->createVote($CURRENT_USER, $pictureid, $rating);
   $PF->showPictureData($PF->getPictureData($pictureid));
   break;

/* Command: getvotes
 * Command to get all info about the votes of an existing picture. Can be invoked only by admin.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture whose votes are required
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */
case 'getvotes':
   $pictureid = $CF->getvariable("pictureid");
   $CF->printMessage("success");
   $PF->showVotes($pictureid);
   break;

/* Command: removevote
 * Command to remove an existing vote from the system. Can be invoked only by the admin.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ sid			The id of the vote to be removed
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */
case 'removevote':
   $msgid = $CF->getvariable("sid");
   $PF->removeVote($sid);
   $CF->printMessage("success");
   break;

/* Command: gethits
 * Command to get all info about the hits of an existing picture. Can be invoked by both users and admin.
 * However, users can get details only for the pictures they own or their group is responsible for.
 * Admin can access all hits. 
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture whose hits are required
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */
case 'gethits':
   $pictureid = $CF->getvariable("pictureid");
   $CF->printMessage("success");
   $PF->showHits($pictureid);
   break;
   
/* Command: phpinfo
 * Admin specific command to print phpinfo. Does not print headers.
 * @ username		The username of the admin
 * @ sessionkey		The key of the current admin session
 */
case 'phpinfo':
   phpinfo();

default:
   $CF->printMessage("query_not_implemented");   
}

$CF->safeexit(false);
?>