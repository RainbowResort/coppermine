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
 * Define possible queries for the API
 */
// User Related
$api_login = 'login';
$api_logout = 'logout';
$api_register = 'register';

// Application Basic
$api_install = 'install';
$api_uninstall = 'uninstall';
$api_getconfig = 'getconfig';
$api_setconfig = 'setconfig';

// Admin Related
$api_showusers = 'showusers';
$api_adduser = 'adduser';
$api_removeuser = 'removeuser';
$api_addgroup = 'addgroup';
$api_removegroup = 'removegroup';
$api_showgroups = 'showgroups';
$api_addusertogroup = 'addusertogroup';
$api_removeuserfromgroup = 'removeuserfromgroup';

/*
 * Specify the required permission to execute an API command.
 * These permissions may later get overridden by the saved config settings.
 *
 * unauth => user does not need to login
 * login  => only a registered logged in user can execute the command
 * admin  => only an administrator can execute this command
 */
$APITYPE = array(
    $api_login => 'unauth',
    $api_logout => 'login',
    $api_register => 'unauth',
    $api_getconfig => 'unauth',
    $api_setconfig => 'admin',
    $api_showusers => 'admin',
    $api_adduser => 'admin',
    $api_removeuser => 'admin',
    $api_addgroup => 'admin',
    $api_removegroup => 'admin',
    $api_showgroups => 'admin',
    $api_addusertogroup => 'admin',
    $api_removeuserfromgroup => 'admin'
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
$MESSAGECODE = $DISPLAY->messagecode;
$DBS = new dbspecs();
$CF = new commonfunctions();
$CF->showheader();
$GF = new globalfunctions();
$query = $CF->getvariable("query");


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
if($query == $api_install) {
  // current query is install. let it proceed
  require('cpgAPIinstall.php');
  $INSTALL = new install();
  $INSTALL->newinstall($CF->getvariable("dbserver"), $CF->getvariable("dbuser"), $CF->getvariable("dbpass"), $CF->getvariable("dbname"), $CF->getvariable("prefix"), $CF->getvariable("adminusername"), $CF->getvariable("adminpassword"), $CF->getvariable("adminemail"));
}

/* 
 * Uninstall Application -- open currently for debug only
 * @ no paramters
 */
if($query == $api_uninstall) {
  // current query is uninstall. let it proceed
  require('cpgAPIinstall.php');  
  $INSTALL = new install();
  $INSTALL->uninstall();
}


/*
 * First check the install, and then do anything else.
 */
$fh = @fopen($DFLT['cfg_d'] . "/" . $DFLT['ins_f'], 'r') or $CF->unsafeexit("init_error", "Cannot open install file");
fclose($fh);

/*
 * Install is OK. Now include the required files and do initialization
 */
require($DFLT['cfg_d'] . "/" . $DFLT['cfg_f']);
$DBS->initialize();
require('cpgAPIuserfunctions.php');
$UF = new userfunctions();
$DBS->sql_connect();

$CONFIG = $GF->getconfig($CONFIG);

/*
 * Query manipulation: authenticate user first
 */
if ($APITYPE[$query] == "") {
   print "<messagecode>{$MESSAGECODE['unknown_query']}</messagecode>\n<message>Unknown Query</message>\n";
   $CF->safeexit();
}  else if($APITYPE[$query] == 'unauth') {
   /* User does not need any permissions to execute the query */
}  else {
   /* Verify if the session key is correct or not */
   $username = $CF->getvariable("username");
   $sessionkey = $CF->getvariable("sessionkey");
   $UF->authorizeuser($username, $sessionkey, $APITYPE[$query]);
}


/* User tries to login and obtain an authentication key 
 * @ username
 * @ password
 */
if ($query == $api_login) {
   $username = $CF->getvariable("username");
   $password = $CF->getvariable("password");
   $result = $UF->login($username, $password);
   if ($result) {
      print "<messagecode>{$MESSAGECODE['success']}</messagecode><message>\nLogged In\n</message>\n";

      $USER_DATA = $UF->getpersonaldata($username);
      $sessionkey = $UF->setlastvisit($username);
      $USER_DATA['sessionkey'] = $sessionkey;
      $UF->showdata($USER_DATA);
   }
   else print "<messagecode>{$MESSAGECODE['login_error']}</messagecode><message>Password Incorrect\n</message>\n";
}

if ($query == $api_logout) {
   $username = $CF->getvariable("username");
   $UF->logout($username);
   print "<messagecode>{$MESSAGECODE['success']}</messagecode><message>\nLogged Out\n</message>\n";
}

/* 
 * Admin lists all users
 */
if ($query == $api_showusers) {
   print "<messagecode>{$MESSAGECODE['success']}</messagecode><message>\nUsers\n</message>\n";
   $USER_DATA = $UF->getalluserdata();
   for($j = 0; $j < count($USER_DATA); $j++) {
      $UF->showdata($USER_DATA[$j]);
   }
}

/* User tried to register
 * @ username
 * @ password
 * @ email
 */
if ($query == $api_register) {
   $addusername = $CF->getvariable("addusername");
   $password = $CF->getvariable("password");
   $group_id = "2"; // Default group
   $email = $CF->getvariable("email");
   $active = "YES";

   $USER_DATA = $UF->adduser($addusername, $password, $group_id, $email, $active);
   if (!$USER_DATA['error']) {
      print "<messagecode>{$MESSAGECODE['success']}</messagecode><message>\nUser Added\n</message>\n";
      $UF->showdata($USER_DATA);
   }
   else print "<messagecode>{$MESSAGECODE['user_error']}</messagecode><message>{$USER_DATA['message']}</message>\n";
}

/* Admin tries to add a user to the system
 * @ addusername
 * @ password
 * @ email
 * @ active
 */
if ($query == $api_adduser) {
   $addusername = $CF->getvariable("addusername");
   $password = $CF->getvariable("password");
   $group_id = "2"; // Default group
   $email = $CF->getvariable("email");
   $active = $CF->getvariable("active"); if($active=="") $active = "YES";

   $USER_DATA = $UF->adduser($addusername, $password, $group_id, $email, $active);
   if (!$USER_DATA['error']) {
      print "<messagecode>{$MESSAGECODE['success']}</messagecode><message>\nUser Added\n</message>\n";
      $UF->showdata($USER_DATA);
   }
   else print "<messagecode>{$MESSAGECODE['user_error']}</messagecode><message>{$USER_DATA['message']}</message>\n";
}

/* Admin tries to remove a user from the system
 * @ addusername
 */
if ($query == $api_removeuser) {
   $addusername = $CF->getvariable("addusername");

   if($addusername == $username) {
      print "<messagecode>{$MESSAGECODE['usergroup_error']}</messagecode><message>\nCannot remove yourself\n</message>\n";
      $CF->safeexit();
   }

   $USER_DATA = $UF->removeuser($addusername);
   if ($USER_DATA) {
      print "<messagecode>{$MESSAGECODE['success']}</messagecode><message>\nUser Removed\n</message>\n";
      $UF->showdata($USER_DATA);
   }
   else print "<messagecode>{$MESSAGECODE['user_error']}</messagecode><message>Username does not exist\n</message>\n";
}

/* 
 * Admin lists all groups
 */
if ($query == $api_showgroups) {
   $GROUP_DATA = $UF->getallgroupdata();
   print "<messagecode>{$MESSAGECODE['success']}</messagecode><message>\nGroups\n</message>\n";
   for($j = 0; $j < count($GROUP_DATA); $j++) {
      print "<group>\n";
      for($i=0;$i<count($DISPLAY->groupfields);$i++) {
         print "<" . $DISPLAY->groupfields[$i] . ">\n";
         print $GROUP_DATA[$j][$DISPLAY->groupfields[$i]];
         print "</" . $DISPLAY->groupfields[$i] . ">\n";
      }
      print "</group>\n";
   }
}

/* Admin tries to add a group to the system
 * @ groupname
 * @ admin
 */
if ($query == $api_addgroup) {
   $groupname = $CF->getvariable("groupname");
   $admin = $CF->getvariable("admin"); if($admin=="") $admin = "NO";

   $GROUP_DATA = $UF->addgroup($groupname, $admin);
   if (!$GROUP_DATA['error']) {
      print "<messagecode>{$MESSAGECODE['success']}</messagecode><message>\nGroup Added\n</message>\n";
      print "<group>\n";
      for($i=0;$i<count($DISPLAY->groupfields);$i++) {
         print "<" . $DISPLAY->groupfields[$i] . ">\n";
         print $GROUP_DATA[$DISPLAY->groupfields[$i]];
         print "</" . $DISPLAY->groupfields[$i] . ">\n";
      }
      print "</group>\n";
   }
   else print "<messagecode>{$MESSAGECODE['group_error']}</messagecode><message>{$GROUP_DATA['message']}</message>\n";
}

/* Admin tries to remove a group from the system
 * @ group_id
 */
if ($query == $api_removegroup) {
   $group_id = $CF->getvariable("group_id");

   if ($group_id <= 4) {
      print "<messagecode>{$MESSAGECODE['group_error']}</messagecode><message>Reserved Group. Cannot remove.\n</message>\n";
   }  else {
      $GROUP_DATA = $UF->removegroup($group_id);
      if ($GROUP_DATA) {
         print "<messagecode>{$MESSAGECODE['success']}</messagecode><message>\nGroup Removed\n</message>\n";
         print "<group>\n";
         for($i=0;$i<count($DISPLAY->groupfields);$i++) {
            print "<" . $DISPLAY->groupfields[$i] . ">\n";
            print $GROUP_DATA[$DISPLAY->groupfields[$i]];
            print "</" . $DISPLAY->groupfields[$i] . ">\n";
         }
         print "</group>\n";
      }
      else print "<messagecode>{$MESSAGECODE['group_error']}</messagecode><message>Group does not exist\n</message>\n";
   }
}

/*
 * Admin adds user to another group
 * @ addusername
 * @ group_id
 */
if ($query == $api_addusertogroup) {
   $addusername = $CF->getvariable("addusername");
   $group_id = $CF->getvariable("group_id");

   $USER_DATA = $UF->addusertogroup($addusername, $group_id);
   if ($USER_DATA) {
      print "<messagecode>{$MESSAGECODE['success']}</messagecode><message>\nUser Added To Group\n</message>\n";
      $UF->showdata($USER_DATA);
   }
   else print "<messagecode>{$MESSAGECODE['usergroup_error']}</messagecode><message>Username or groupname does not exist\n</message>\n";
}

/* 
 * Admin removes user from group
 * @ addusername
 * @ group_id
 */
if ($query == $api_removeuserfromgroup) {
   $addusername = $CF->getvariable("addusername");
   $group_id = $CF->getvariable("group_id");

   if($addusername == $username) {
      print "<messagecode>{$MESSAGECODE['usergroup_error']}</messagecode><message>\nCannot remove yourself from a group\n</message>\n";
      $CF->safeexit();
   }

   $USER_DATA = $UF->removeuserfromgroup($addusername, $group_id);
   if ($USER_DATA) {
      print "<messagecode>{$MESSAGECODE['success']}</messagecode><message>\nUser Removed From Group\n</message>\n";
      $UF->showdata($USER_DATA);
   }
   else print "<messagecode>{$MESSAGECODE['usergroup_error']}</messagecode><message>Username or groupname does not exist\n</message>\n";
}

/* 
 * Request for application configuration
 */
if ($query == $api_getconfig) {
   print "<messagecode>{$MESSAGECODE['success']}</messagecode><message>\nConfig\n</message>\n";
   print "<config>\n";
   for($i=0; $i<count($DISPLAY->configfields); $i++) {
      print "<" . $DISPLAY->configfields[$i] . ">";
      print $CONFIG[$DISPLAY->configfields[$i]];
      print "</" . $DISPLAY->configfields[$i] . ">\n";
   }
   print "</config>\n";
}

/* 
 * Set application configuration
 */
if ($query == $api_setconfig) {
   //$CONFIG[''] = $CF->getvariable("");
   $CONFIG['allow_user_registration'] = $CF->getvariable("allow_user_registration");
   $CONFIG['allow_duplicate_emails_addr'] = $CF->getvariable("allow_duplicate_emails_addr");

   $GF->setconfig($CONFIG);

   print "<messagecode>{$MESSAGECODE['success']}</messagecode><message>\nConfig\n</message>\n";
   print "<config>\n";
   for($i=0; $i<count($DISPLAY->configfields); $i++) {
      print "<" . $DISPLAY->configfields[$i] . ">";
      print $CONFIG[$DISPLAY->configfields[$i]];
      print "</" . $DISPLAY->configfields[$i] . ">\n";
   }
   print "</config>\n";
}

$CF->safeexit();

?>