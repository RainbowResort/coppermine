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

/*
 * Specify the required permission to execute an API command.
 * These permissions may later get overridden by the saved config settings.
 *
 * unauth => user does not need to login
 * login  => only a registered logged in user can execute the command
 * admin  => only an administrator can execute this command
 */
$APITYPE = array(
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
    
	'createcomment'		=> array('softlogin', 'pictureview'),
	'approvecomment'	=> array('login', 'pictureowner'),
	'modifycomment'		=> array('login', 'commentowner'),
	'viewcomment'		=> array('login', 'commentview'),
	'removecomment'		=> array('login', 'pictureowner')
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

$CONFIG = array();
$DISPLAY = new displayspecs();
$DISPLAY->initialize();
$DBS = new dbspecs();
$CF = new commonfunctions();
if ($query != "getpicture") {
   $CF->showheader();
}
$GF = new globalfunctions();
$query = $CF->getuncheckedvariable("query");

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


/*
 * First check the install, and then do anything else.
 */
$fh = @fopen($DFLT['cfg_d'] . "/" . $DFLT['ins_f'], 'r') or $CF->unsafeexit("init_error");
fclose($fh);

/*
 * Install is OK. Now include the required files and do initialization
 */
require($DFLT['cfg_d'] . "/" . $DFLT['cfg_f']);
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
        print "<messagecode>upload_dir_error</messagecode>";
        $CF->safeexit();
     }
     @chmod($CONFIG['fullpath'] . $CONFIG['userpics'], octdec($CONFIG['default_dir_mode'])); //silence the output in case chmod is disabled
}

/*
 * Query manipulation: authenticate user first
 */
$CURRENT_USER = array(
	'username' => false
	);

if (!$APITYPE[$query]) {
   print "<messagecode>unknown_query</messagecode>";
   $CF->safeexit();
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
   		  	 print "<messagecode>invalid_session_error</messagecode>";
             $CF->safeexit();
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
	   	  	 	   print "<messagecode>query_permission_error</messagecode>";
                   $CF->safeexit();
	   	  	 	}
	   	  	 	break;
	   	  	 case 'categoryview' :
	   	  	 	$categoryid = $CF->getvariable("categoryid");
	   	  	 	if (!$AF->authorizeusercat($CURRENT_USER, $categoryid, "view")) {
	   	  	 	   print "<messagecode>query_permission_error</messagecode>";
                   $CF->safeexit();
	   	  	 	}
	   	  	 	break;
	   	  	 case 'albumowner'   :
	   	  	 	$albumid = $CF->getvariable("albumid");
	   	  	 	$albumpassword = $CF->getvariable("albumpassword");
	   	  	 	if (!$AF->authorizeuseralbum($CURRENT_USER, $albumid, "owner", $albumpassword)) {
	   	  	 	   print "<messagecode>query_permission_error</messagecode>";
                   $CF->safeexit();
	   	  	 	}
	   	  	 	break;
	   	  	 case 'albumview'    :
	   	  	 	$albumid = $CF->getvariable("albumid");
	   	  	 	$albumpassword = $CF->getvariable("albumpassword");
	   	  	 	if (!$AF->authorizeuseralbum($CURRENT_USER, $albumid, "view", $albumpassword)) {
	   	  	 	   print "<messagecode>query_permission_error</messagecode>";
                   $CF->safeexit();
	   	  		}
	   	  	 	break;
	   	  	 case 'pictureowner'    :
	   	  	 	$picid = $CF->getvariable("pictureid");
	   	  	 	$albumpassword = $CF->getvariable("albumpassword");
	   	  	 	if (!$PF->authorizeuserpicture($CURRENT_USER, $picid, "owner", $albumpassword)) {
	   	  	 	   print "<messagecode>query_permission_error</messagecode>";
                   $CF->safeexit();
	   	  		}
	   	  	 	break;
	   	  	 case 'pictureview'    :
	   	  	 	$picid = $CF->getvariable("pictureid");
	   	  	 	$albumpassword = $CF->getvariable("albumpassword");
	   	  	 	if (!$PF->authorizeuserpicture($CURRENT_USER, $picid, "view", $albumpassword)) {
	   	  	 	   print "<messagecode>query_permission_error</messagecode>";
                   $CF->safeexit();
	   	  		}
	   	  	 	break;
	   	  	 case 'commentowner'    :
	   	  	 	$msgid = $CF->getvariable("msgid");
	   	  	 	$albumpassword = $CF->getvariable("albumpassword");
	   	  	 	if (!$PF->authorizeusercomment($CURRENT_USER, $msgid, "owner", $albumpassword)) {
	   	  	 	   print "<messagecode>query_permission_error</messagecode>";
                   $CF->safeexit();
	   	  		}
	   	  	 	break;
	   	  	 case 'commentview'    :
	   	  	 	$msgid = $CF->getvariable("msgid");
	   	  	 	$albumpassword = $CF->getvariable("albumpassword");
	   	  	 	if (!$PF->authorizeusercomment($CURRENT_USER, $msgid, "view", $albumpassword)) {
	   	  	 	   print "<messagecode>query_permission_error</messagecode>";
                   $CF->safeexit();
	   	  		}
	   	  	 	break;
	   	  }
	   }
   }
}


switch($query) {

/* User tries to login and obtain an authentication key 
 * @ username
 * @ password
 */
case 'login':
   $username = $CF->getvariable("username");
   $password = $CF->getvariable("password");
   $result = $UF->login($username, $password);
   if (!$result['error']) {
      print "<messagecode>success</messagecode>";

      $USER_DATA = $UF->getpersonaldata($username);
      $sessionkey = $UF->setlastvisit($username);
      $USER_DATA['sessionkey'] = $sessionkey;
      $UF->showdata($USER_DATA);
   }
   else print "<messagecode>{$result['messagecode']}</messagecode>";
   break;

/* User tries to logout
 * @ username
 */
case 'logout':
   $username = $CF->getvariable("username");
   $UF->logout($username);
   print "<messagecode>success</messagecode>";
   break;

/* 
 * Admin lists all users
 */
case 'showusers':
   print "<messagecode>success</messagecode>";
   $USER_DATA = $UF->getalluserdata();
   for($j = 0; $j < count($USER_DATA); $j++) {
      $UF->showdata($USER_DATA[$j]);
   }
   break;

/* User tried to register
 * @ username
 * @ password
 * @ email
 * @ profile[]
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
      print "<messagecode>success</messagecode>";
      $UF->showdata($USER_DATA);
   }
   else print "<messagecode>{$USER_DATA['messagecode']}</messagecode>";
   break;

/* User tried to modify profile
 * @ password
 * @ email
 * @ profile
 */
case 'modifyprofile':
   $username = $CF->getvariable("username");
   $password = $CF->getvariable("password");
   $email = $CF->getvariable("email");
   $profile = array();
   for($i=1;$i<=6;$i++) {
      $profile[$i] = $CF->getvariable("profile".$i);
   }
   $USER_DATA = $UF->modifyprofile($username, $password, $email, $profile);
   if (!$USER_DATA['error']) {
      print "<messagecode>success</messagecode>";
      $UF->showdata($USER_DATA);
   }
   else print "<messagecode>{$USER_DATA['messagecode']}</messagecode>";
   break;

/* User tried to activate account
 * @ username
 * @ act_key
 */
case 'activate':
   $addusername = $CF->getvariable("addusername");
   $act_key = $CF->getvariable("act_key");

   $USER_DATA = $UF->activate($addusername, $act_key);
   if (!$USER_DATA['error']) {
      print "<messagecode>success</messagecode>";
      $UF->showdata($USER_DATA);
   }
   else print "<messagecode>{$USER_DATA['messagecode']}</messagecode>";
   break;

/* Generate a new activation mail
 * @ username
 * @ email
 */
case 'reactivate':
   $addusername = $CF->getvariable("addusername");
   $email = $CF->getvariable("email");

   $USER_DATA = $UF->reactivate($addusername, $email);
   if (!$USER_DATA['error']) {
      print "<messagecode>success</messagecode>";
   }
   else print "<messagecode>{$USER_DATA['messagecode']}</messagecode>";
   break;

/* Generate a new password request for the user
 * @ username
 * @ email
 */
case 'forgotpassword':
   $addusername = $CF->getvariable("addusername");
   $email = $CF->getvariable("email");

   $USER_DATA = $UF->forgotpassword($addusername, $email);
   if (!$USER_DATA['error']) {
      print "<messagecode>success</messagecode>";
   }
   else print "<messagecode>{$USER_DATA['messagecode']}</messagecode>";
   break;

/* Generate a new password for the user
 * @ username
 * @ pass_key
 */
case 'generatepassword':
   $addusername = $CF->getvariable("addusername");
   $pass_key = $CF->getvariable("pass_key");

   $USER_DATA = $UF->generatepassword($addusername, $pass_key);
   if (!$USER_DATA['error']) {
      print "<messagecode>success</messagecode>";
      $UF->showdata($USER_DATA);
   }
   else print "<messagecode>{$USER_DATA['messagecode']}</messagecode>";
   break;

/* Admin tries to add a user to the system
 * @ addusername
 * @ password
 * @ email
 * @ active
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
   if (!$USER_DATA['error']) {
      print "<messagecode>success</messagecode>";
      $UF->showdata($USER_DATA);
   }
   else print "<messagecode>{$USER_DATA['messagecode']}</messagecode>";
   break;

/* Admin tries to remove a user from the system
 * @ addusername
 */
case 'removeuser':
   $addusername = $CF->getvariable("addusername");

   if($addusername == $username) {
      print "<messagecode>cannot_remove_self</messagecode>";
      $CF->safeexit();
   }

   $USER_DATA = $UF->removeuser($addusername);
   if ($USER_DATA) {
      print "<messagecode>success</messagecode>";
      $UF->showdata($USER_DATA);
   }
   else print "<messagecode>username_not_exist</messagecode>";
   break;

/* Admin updates a user
 * @ addusername
 * @ password
 * @ email
 * @ active
 */
case 'updateuser':
   $addusername = $CF->getvariable("addusername");
   $password = $CF->getvariable("password");
   $email = $CF->getvariable("email");
   $active = $CF->getvariable("active");

   $USER_DATA = $UF->updateuser($addusername, $password, $email, $active);
   if (!$USER_DATA['error']) {
      print "<messagecode>success</messagecode>";
      $UF->showdata($USER_DATA);
   }
   else print "<messagecode>{$USER_DATA['messagecode']}</messagecode>";
   break;

/* 
 * Admin lists all groups
 */
case 'showgroups':
   $GROUP_DATA = $UF->getallgroupdata();
   print "<messagecode>success</messagecode>";
   for($j = 0; $j < count($GROUP_DATA); $j++) {
      print "<group>";
      for($i=0;$i<count($DISPLAY->groupfields);$i++) {
         print "<" . $DISPLAY->groupfields[$i] . ">";
         print $GROUP_DATA[$j][$DISPLAY->groupfields[$i]];
         print "</" . $DISPLAY->groupfields[$i] . ">";
      }
      print "</group>";
   }
   break;

/* Admin tries to add a group to the system
 * @ groupname
 * @ admin
 */
case 'addgroup':
   $groupname = $CF->getvariable("groupname");
   $admin = $CF->getvariable("admin"); if($admin=="") $admin = "NO";

   $GROUP_DATA = $UF->addgroup($groupname, $admin);
   if (!$GROUP_DATA['error']) {
      print "<messagecode>success</messagecode>";
      print "<group>";
      for($i=0;$i<count($DISPLAY->groupfields);$i++) {
         print "<" . $DISPLAY->groupfields[$i] . ">";
         print $GROUP_DATA[$DISPLAY->groupfields[$i]];
         print "</" . $DISPLAY->groupfields[$i] . ">";
      }
      print "</group>";
   }
   else print "<messagecode>{$GROUP_DATA['messagecode']}</messagecode>";
   break;

/* Admin tries to add a group to the system
 * @ groupname
 * @ admin
 */
case 'updategroup':
   $group_id = $CF->getvariable("group_id");
   $groupname = $CF->getvariable("groupname");
   $admin = $CF->getvariable("admin");
   if($admin=="") $admin = "NO";

   $GROUP_DATA = $UF->updategroup($group_id, $groupname, $admin);
   if (!$GROUP_DATA['error']) {
      print "<messagecode>success</messagecode>";
      print "<group>";
      for($i=0;$i<count($DISPLAY->groupfields);$i++) {
         print "<" . $DISPLAY->groupfields[$i] . ">";
         print $GROUP_DATA[$DISPLAY->groupfields[$i]];
         print "</" . $DISPLAY->groupfields[$i] . ">";
      }
      print "</group>";
   }
   else print "<messagecode>{$GROUP_DATA['messagecode']}</messagecode>";
   break;

/* Admin tries to remove a group from the system
 * @ group_id
 */
case 'removegroup':
   $group_id = $CF->getvariable("group_id");

   if ($group_id <= 4) {
      print "<messagecode>reserved_group_remove_error</messagecode>";
   }  else {
      $GROUP_DATA = $UF->removegroup($group_id);
      if ($GROUP_DATA) {
         print "<messagecode>success</messagecode>";
         print "<group>";
         for($i=0;$i<count($DISPLAY->groupfields);$i++) {
            print "<" . $DISPLAY->groupfields[$i] . ">";
            print $GROUP_DATA[$DISPLAY->groupfields[$i]];
            print "</" . $DISPLAY->groupfields[$i] . ">";
         }
         print "</group>";
      }
      else print "<messagecode>group_not_exist</messagecode>";
   }
   break;

/*
 * Admin adds user to another group
 * @ addusername
 * @ group_id
 */
case 'addusertogroup':
   $addusername = $CF->getvariable("addusername");
   $group_id = $CF->getvariable("group_id");

   $USER_DATA = $UF->addusertogroup($addusername, $group_id);
   if (!$USER_DATA['error']) {
      print "<messagecode>success</messagecode>";
      $UF->showdata($USER_DATA);
   }
   else print "<messagecode>{$USER_DATA['messagecode']}</messagecode>";
   break;

/* 
 * Admin removes user from group
 * @ addusername
 * @ group_id
 */
case 'removeuserfromgroup':
   $addusername = $CF->getvariable("addusername");
   $group_id = $CF->getvariable("group_id");

   if($addusername == $username) {
      print "<messagecode>cannot_remove_self_from_group</messagecode>";
      $CF->safeexit();
   }

   $USER_DATA = $UF->removeuserfromgroup($addusername, $group_id);
   if (!$USER_DATA['error']) {
      print "<messagecode>success</messagecode>";
      $UF->showdata($USER_DATA);
   }
   else print "<messagecode>{$USER_DATA['messagecode']}</messagecode>";
   break;

/* 
 * Request for application configuration
 */
case 'getconfig':
   print "<messagecode>success</messagecode>";
   print "<config>";
   for($i=0; $i<count($DISPLAY->configfields); $i++) {
      print "<" . $DISPLAY->configfields[$i] . ">";
      print $CONFIG[$DISPLAY->configfields[$i]];
      print "</" . $DISPLAY->configfields[$i] . ">";
   }
   print "</config>";
   break;

/* 
 * Set application configuration
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

   print "<messagecode>success</messagecode>";
   print "<config>";
   for($i=0; $i<count($DISPLAY->configfields); $i++) {
      print "<" . $DISPLAY->configfields[$i] . ">";
      print $CONFIG[$DISPLAY->configfields[$i]];
      print "</" . $DISPLAY->configfields[$i] . ">";
   }
   print "</config>";
   break;

case 'createcategory':
   $categoryid = $CF->getvariable("categoryid"); // Parent category
   $addcategoryname = $CF->getvariable("categoryname");
   $addcategorydesc = $CF->getvariable("categorydesc");
   if ($UF->isAdmin($CURRENT_USER['username']) && $categoryid == "0") {
   	  $isadmincategory = 1;
   }
   print "<messagecode>success</messagecode>";
   $AF->showSingleCategoryData($AF->createCategory($CURRENT_USER, $addcategoryname, $addcategorydesc, $categoryid, $isadmincategory));
   break;

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
   print "<messagecode>success</messagecode>";
   $AF->showSingleCategoryData($AF->modifyCategory($categoryid, $categoryname, $categorydesc, $categoryparent, $categorythumb));
   break;

case 'viewcategory':
   $categoryid = $CF->getvariable("categoryid");
   print "<messagecode>success</messagecode>";
   $AF->showCategoryData($AF->getCategoryData($categoryid), $CURRENT_USER);
   break;

case 'movecategory':
   $categoryid = $CF->getvariable("categoryid"); // Parent category
   $categorypos = $CF->getvariable("categorypos");
   if ($AF->moveCategory($categoryid, $categorypos))
      print "<messagecode>success</messagecode>";
   else
      print "<messagecode>could_not_move</messagecode>";   
   break;

case 'removecategory':
   $categoryid = $CF->getvariable("categoryid");
   $AF->removeCategory($categoryid);
   print "<messagecode>success</messagecode>";
   break;

case 'showcategories':
   print "<messagecode>success</messagecode>";
   $AF->showCategories($CURRENT_USER);
   break;
   
case 'showmycategories':
   print "<messagecode>success</messagecode>";
   $AF->showUserCategories($CURRENT_USER);
   break;

case 'showadmincategories':
   print "<messagecode>success</messagecode>";
   $AF->showAdminCategories($CURRENT_USER);
   break;

case 'createalbum':
   $categoryid = $CF->getvariable("categoryid"); // Parent category
   $addalbumname = $CF->getvariable("albumname");
   $addalbumdesc = $CF->getvariable("albumdesc");
   $addalbumkeywords = $CF->getvariable("albumkeywords");
   print "<messagecode>success</messagecode>";
   $AF->showSingleAlbumData($AF->createAlbum($addalbumname, $addalbumdesc, $addalbumkeywords, $categoryid));
   break;

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
   
   print "<messagecode>success</messagecode>";
   $AF->showSingleAlbumData($AF->modifyAlbum($albumid, $albumname, $albumdesc, $albumthumb, $albumpassword, $albumpasswordhint));
   break;

case 'viewalbum':
   $albumid = $CF->getvariable("albumid");
   print "<messagecode>success</messagecode>";
   $AF->showAlbumData($AF->getAlbumData($albumid));
   break;

case 'movealbum':
   $albumid = $CF->getvariable("albumid");
   $albumpos = $CF->getvariable("albumpos");
   if ($AF->moveAlbum($albumid, $albumpos))
      print "<messagecode>success</messagecode>";
   else
      print "<messagecode>could_not_move</messagecode>";   
   break;
   
case 'removealbum':
   $albumid = $CF->getvariable("albumid");
   $AF->removeAlbum($albumid);
   print "<messagecode>success</messagecode>";
   break;

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
                  print "<messagecode>success</messagecode>";
                  $PF->showPictureData($PF->getPictureData($picid));            	   
   	  	 	      $filepath = $PF->getPicturePath($picid);
                  // Upload the file
            	  move_uploaded_file($_FILES['file']['tmp_name'], $filepath);
         	      @chmod($filepath, octdec($CONFIG['default_file_mode']));
               }  else {
         	      $PF->removePicture($picid);
                  print "<messagecode>upload_error</messagecode>"; 
               }
   	  	    }  else {
      	       print "<messagecode>unknown_extension</messagecode>";       		   	  	 	
   	  	    } 
   	     }  else {
         	print "<messagecode>unknown_extension</messagecode>";    	     	
   	     }
      }  elseif ($_FILES['file']['error'] == UPLOAD_ERR_INI_SIZE) {
         print "<messagecode>max_upload_size_exceed</messagecode>"; 
      }  else { 
         print "<messagecode>upload_error</messagecode>"; 
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
               print "<messagecode>success</messagecode>";         	       
               $PF->showPictureData($PF->getPictureData($picid));            	   
      	       if ($fh = @fopen($filepath, "w")) {
				   fwrite($fh, $filecontents);      	       	
         	       fclose($fh);
         	       @chmod($filepath, octdec($CONFIG['default_file_mode']));
         	    }  else {
         	       $PF->removePicture($picid);
         	       print "<messagecode>upload_error</messagecode>";       		
      	       }
      	    }  else {
               print "<messagecode>upload_error</messagecode>";       		      	 	
      	    }   	  	 	
   	  	 }  else {
      	    print "<messagecode>unknown_extension</messagecode>";       		   	  	 	
   	  	 } 
      }  else {
      	 print "<messagecode>unknown_extension</messagecode>";       		
      }
   }  else {
      print "<messagecode>upload_error</messagecode>";       		   	
   }
   
   break;

case 'getpicture':
   $pictureid = $CF->getvariable("pictureid");
   $PICTURE_DATA = $PF->showPicture($pictureid);
   if (!$PICTURE_DATA['error']) { }
   else {
      $CF->showheader();   	
      print "<messagecode>{$PICTURE_DATA['messagecode']}</messagecode>";
   }
   break;

case 'getpicturedata':
   $pictureid = $CF->getvariable("pictureid");
   $PICTURE_DATA = $PF->getPictureData($pictureid);
   if (!$PICTURE_DATA['error']) {
      print "<messagecode>success</messagecode>";
      $PF->showPictureData($PICTURE_DATA);
   }
   else print "<messagecode>{$PICTURE_DATA['messagecode']}</messagecode>";
   break;

case 'movepicture':
   $pictureid = $CF->getvariable("pictureid");
   $picturepos = $CF->getvariable("picturepos");
   if ($PF->movePicture($pictureid, $picturepos))
      print "<messagecode>success</messagecode>";
   else
      print "<messagecode>could_not_move</messagecode>";   
   break;

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
   
   print "<messagecode>success</messagecode>";
   $AF->showPictureData($AF->modifyPictureData($pictureid,  $pictitle, $piccaption, $pickeywords, $user1, $user2, $user3, $user4));
   break;

case 'removepicture':
   $pictureid = $CF->getvariable("pictureid");
   $PF->removePicture($pictureid);
   print "<messagecode>success</messagecode>";
   break;

default:
   print "<messagecode>query_not_implemented</messagecode>";   
}

$CF->safeexit();
?>