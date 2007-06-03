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

/**
 * Define possible queries for the API
 */
$api_login = 'login';
$api_adduser = 'adduser';
$api_install = 'install';
$api_uninstall = 'uninstall';

$APITYPE = array(
    $api_login => 'unauth',
    $api_adduser => 'admin'
);


/**
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

$CONFIG = array();
$DISPLAY = new displayspecs();
$DISPLAY->initialize();
$DBS = new dbspecs();
$CF = new commonfunctions();
$CF->showheader();
$query = $CF->getvariable("query");


/* Install Application -- open currently for debug only
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

/* Uninstall Application -- open currently for debug only
 * @ no paramters
 */
if($query == $api_uninstall) {
  // current query is uninstall. let it proceed
  require('cpgAPIinstall.php');  
  $INSTALL = new install();
  $INSTALL->uninstall();
}


/**
 * First check the install, and then do anything else.
 */
$fh = fopen($DFLT['cfg_d'] . "/" . $DFLT['ins_f'], 'r') or $CF->unsafeexit("init_error", "Cannot open install file");
fclose($fh);

/**
 * Install is OK. Now include the required files and do initialization
 */
require($DFLT['cfg_d'] . "/" . $DFLT['cfg_f']);
$DBS->initialize();
require('cpgAPIuserfunctions.php');
$UF = new userfunctions();
$DBS->sql_connect();


/**
 * Query manipulation: authenticate user first
 */
if ($APITYPE[$query] == "") {
   print "<messagecode>{$MESSAGECODE['unknown_query']}</messagecode>\n<message>Unknown Query</message>\n";
   $CF->safeexit();
}  else if($APITYPE[$query] == 'unauth') {
   // User does not need any permissions to execute the query
}  else {
   /* Check if there is a current user and if she has appropriate permissions */
   $username = $CF->getvariable("username");
   $USER_DATA = $UF->getpersonaldata($username);

   if ($USER_DATA) {
      $GROUP_DATA = $UF->getgroupdata($USER_DATA['group_id']);
      if ($GROUP_DATA) {
         if ($GROUP_DATA[$APITYPE[$query]]) {
            // User has enough permissions. Try to execute the query later.
         }  else {
            print "<messagecode>{$MESSAGECODE['no_perms']}</messagecode>\n<message>Not enough permissions to execute this query</message>\n";
            $CF->safeexit();
         }
      }  else {
         print "<messagecode>{$MESSAGECODE['unknown_user']}</messagecode>\n<message>User group data incorrect or corrupted</message>\n";
         $CF->safeexit();
      }
   }  else  {
      print "<messagecode>{$MESSAGECODE['unknown_user']}</messagecode>\n<message>User data incorrect or corrupted</message>\n";
      $CF->safeexit();
   }
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
      print "<messagecode>{$MESSAGECODE['success']}</messagecode><message>\nLogged In\n</message>\n<login>\n<userdata>\n";

      $USER_DATA = $UF->getpersonaldata($username);
      for($i=0;$i<count($DISPLAY->userpersonalfields);$i++) {
         print "<" . $DISPLAY->userpersonalfields[$i] . ">\n";
         print $USER_DATA[$DISPLAY->userpersonalfields[$i]];
         print "</" . $DISPLAY->userpersonalfields[$i] . ">\n";
      }

      print "</userdata>\n</login>\n";
   }
   else print "<messagecode>{$MESSAGECODE['login_error']}</messagecode><message>Password Incorrect\n</message>\n";
}


/* Admin tries to add a user to the system
 * @ username
 * @ password
 * @ group_id
 * @ email
 * @ active
 */
if ($query == $api_adduser) {
   $username = $CF->getvariable("username");
   $password = $CF->getvariable("password");
   $group_id = $CF->getvariable("group_id");
   $email = $CF->getvariable("email");
   $active = $CF->getvariable("active");
   /* <-- Incomplete
      print "<messagecode>{$MESSAGECODE['success']}</messagecode><message>\nLogged In\n</message>\n<login>\n<userdata>\n";

      $USER_DATA = $UF->getpersonaldata($username);
      for($i=0;$i<count($DISPLAY->userpersonalfields);$i++) {
         print "<" . $DISPLAY->userpersonalfields[$i] . ">\n";
         print $USER_DATA[$DISPLAY->userpersonalfields[$i]];
         print "</" . $DISPLAY->userpersonalfields[$i] . ">\n";
      }
    --> */
}

$CF->safeexit();


?>