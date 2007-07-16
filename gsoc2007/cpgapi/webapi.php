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
    'setconfig' 		=> array('admin'),

    'showusers' 		=> array('admin'),
    'adduser' 			=> array('admin'),
    'removeuser' 		=> array('admin'),
    'updateuser'	 	=> array('admin'),
    'addgroup' 			=> array('admin'),
    'removegroup' 		=> array('admin'),
    'updategroup' 		=> array('admin'),
    'showgroups' 		=> array('admin'),
    'addusertogroup'	=> array('admin'),
    'removeuserfromgroup' => array('admin'),
    
    'createcategory'	=> array('login', 'categoryowner'),
    'viewcategory'		=> array('categoryview'),
    'modifycategory'	=> array('login', 'categoryowner'),
    'createalbum'		=> array('login', 'categoryowner'),
    'viewalbum'			=> array('albumview'),
    'modifyalbum'		=> array('login', 'albumowner')
);

$GROUPPERMS = array(
	'login'	=> 'login',
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
$CF->showheader();
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
$DBS->sql_connect();

$CONFIG = $GF->getconfig($CONFIG);

require($DFLT['cfg_d'] . "/" . $DFLT['mail_f']);
require($DFLT['lang_d'] . "/" . $CONFIG['lang'] . ".php");

/*
 * Query manipulation: authenticate user first
 */
$CURRENT_USER = false;

if (!$APITYPE[$query]) {
   print "<messagecode>unknown_query</messagecode>";
   $CF->safeexit();
}  else {
   for($i=0; $i < count($APITYPE[$query]); $i++) {
	   if ($APITYPE[$query][$i] == 'unauth') {
   		  /* User does not need any permissions to execute the query */
   		  break;
	   }  else if (isset($GROUPPERMS[$APITYPE[$query][$i]])){
   		  /* Verify if the session key is correct or not */
   		  $username = $CF->getvariable("username");
   		  $sessionkey = $CF->getvariable("sessionkey");
   		  $CURRENT_USER = $UF->authorizeuser($username, $sessionkey, $APITYPE[$query][$i]);
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
	   	  	 	if (!$AF->authorizeuseralbum($CURRENT_USER, $albumid, "owner")) {
	   	  	 	   print "<messagecode>query_permission_error</messagecode>";
                   $CF->safeexit();
	   	  	 	}
	   	  	 	break;
	   	  	 case 'albumview'    :
	   	  	 	$albumid = $CF->getvariable("albumid");
	   	  	 	if (!$AF->authorizeuseralbum($CURRENT_USER, $albumid, "view")) {
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
   $username = $CF->getvariable("username");
   $categoryid = $CF->getvariable("categoryid");
   $addcategoryname = $CF->getvariable("addcategoryname");
   $addcategorydesc = $CF->getvariable("addcategorydesc");
   $AF->createCategory($username, $addcategoryname, $addcategorydesc, $categoryid);
   print "<messagecode>success</messagecode>";
   break;

default:
   print "<messagecode>query_not_implemented</messagecode>";   
}

$CF->safeexit();
?>