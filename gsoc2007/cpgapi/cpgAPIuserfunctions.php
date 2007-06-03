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

/**
 * Class for user related functions
 */
class userfunctions {

  /* Primary login function. Anything else should be a wrapper around this. 
   * @ username
   * @ password
   */
  function login ($username, $password) {
    global $DBS;

    $encpassword = md5($password);
    // Check for user in users table
    $sql =  "SELECT {$DBS->field['user_id']}, {$DBS->field['username']} FROM {$DBS->usertable}";
    $sql .= " WHERE {$DBS->field['username']} = '$username' AND BINARY {$DBS->field['password']} = '$encpassword'";
    $results = $DBS->sql_query($sql);

    if (mysql_num_rows($results)) {
       $USER_DATA = mysql_fetch_assoc($results);
       mysql_free_result($results);
       return $USER_DATA;
    }  else {
       return false;
    }
  }

  function getpersonaldata ($username) {
    global $DBS, $DISPLAY;

    $fieldstring = "";
    for($i=0;$i<count($DISPLAY->userpersonalfields);$i++) {
       if($i!=0) $fieldstring .= ", ";
       $fieldstring .= "{$DBS->field[$DISPLAY->userpersonalfields[$i]]} AS {$DISPLAY->userpersonalfields[$i]}";
    }

    $sql =  "SELECT $fieldstring FROM {$DBS->usertable}";
    $sql .= " WHERE {$DBS->field['username']} = '$username'";
    $results = $DBS->sql_query($sql);

    if (mysql_num_rows($results)) {
       $USER_DATA = mysql_fetch_assoc($results);
       mysql_free_result($results);
       return $USER_DATA;
    }  else {
       return false;
    }
  }

  function getgroupdata ($group_id) {
    global $DBS, $DISPLAY;

    $fieldstring = "";
    for($i=0;$i<count($DISPLAY->groupfields);$i++) {
       if($i!=0) $fieldstring .= ", ";
       $fieldstring .= "{$DBS->group[$DISPLAY->groupfields[$i]]} AS {$DISPLAY->groupfields[$i]}";
    }

    $sql =  "SELECT $fieldstring FROM {$DBS->groupstable}";
    $sql .= " WHERE {$DBS->group['group_id']} = '$group_id'";
    $results = $DBS->sql_query($sql);

    if (mysql_num_rows($results)) {
       $GROUP_DATA = mysql_fetch_assoc($results);
       mysql_free_result($results);
       return $GROUP_DATA;
    }  else {
       return false;
    }
  }
}

?>