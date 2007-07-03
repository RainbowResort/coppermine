<?php
/*
 * PHP library for all user related functions in CPG
 * @author xnitingupta
 */

/**
 * Class for user related functions
 */
class userfunctions {

  /* Login function. Authenticates password.
   * @ username
   * @ password
   * @ return USER_DATA on success, false on failure
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

  /* Logout function. Resets the session key.
   * @ username
   */
  function logout ($username) {
    global $DBS, $CF;
    $sql = "UPDATE {$DBS->usertable} SET {$DBS->field['sessionkey']}='' WHERE {$DBS->field['username']} = '$username'";
    $DBS->sql_update($sql);
  }

  /* Login confirm function. Sets the session key and the last visit time.
   * @ username
   * @ return sessionkey
   */
  function setlastvisit ($username) {
    global $DBS, $CF;
    $sessionkey = $CF->str_makerand(15,25, true, false, true);
    $sql = "UPDATE {$DBS->usertable} SET {$DBS->field['lastvisit']}=NOW(), {$DBS->field['sessionkey']}='{$sessionkey}' WHERE {$DBS->field['username']} = '$username'";
    $DBS->sql_update($sql);
    return $sessionkey;
  }

  /* Fetches and returns the most recent session key corresponding to a single user.
   * @ username
   * @ return sessionkey
   */
  function getsessionkey ($username) {
    global $DBS;

    $sql =  "SELECT {$DBS->field['sessionkey']} FROM {$DBS->usertable} WHERE {$DBS->field['username']} = '$username'";
    $results = $DBS->sql_query($sql);

    if (mysql_num_rows($results)) {
       $sessionkey = mysql_result($results, 0, $DBS->field['sessionkey']);
       mysql_free_result($results);
       return $sessionkey;
    }  else {
       return '';
    }
  }

  /* Shows the data corresponding to a single user.
   * @ USER_DATA
   */
  function showdata ($USER_DATA) {
    global $DISPLAY;

    print "<userdata>\n";
    for($i=0;$i<count($DISPLAY->userpersonalfields);$i++) {
       print "<" . $DISPLAY->userpersonalfields[$i] . ">\n";
       print $USER_DATA[$DISPLAY->userpersonalfields[$i]];
       print "</" . $DISPLAY->userpersonalfields[$i] . ">\n";
    }
    if($USER_DATA['sessionkey']!="")
      print "<sessionkey>" . $USER_DATA['sessionkey'] . "</sessionkey>\n";

    $GROUP_DATA = $this->getgroupdata($USER_DATA['user_id']);
    for($j = 0; $j < count($GROUP_DATA); $j++) {
       print "<group>\n";
       for($i=0;$i<count($DISPLAY->groupfields);$i++) {
          print "<" . $DISPLAY->groupfields[$i] . ">\n";
          print $GROUP_DATA[$j][$DISPLAY->groupfields[$i]];
          print "</" . $DISPLAY->groupfields[$i] . ">\n";
       }
       print "</group>\n";
    }
    print "</userdata>\n";
  }

  /* Fetches and returns the data corresponding to a single user.
   * @ username
   * @ return USER_DATA
   */
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

  /* Authorizes the user. Checks for a valid session key and permissions for the operations being performed
   * @ username
     @ sessionkey
     @ perm
     @ return true if authorized, otherwise exits immediately
   */
  function authorizeuser($username, $sessionkey, $perm) {
    global $CF, $MESSAGECODE;

    $userkey = $this->getsessionkey($username);
    if($userkey=='' || $userkey!=$sessionkey) {
       print "<messagecode>{$MESSAGECODE['unknown_user']}</messagecode>\n<message>User invalid or session not authenticated</message>\n";
       $CF->safeexit();
    }

   if ($perm!="login") {
      /* Check if there is a current user and if she has appropriate permissions */
      $USER_DATA = $this->getpersonaldata($username);

      if ($USER_DATA) {
         $GROUP_DATA = $this->getgroupdata($USER_DATA['user_id']);
         if ($GROUP_DATA) {
            $authorized = false;
            for($i = 0; $i < count($GROUP_DATA); $i++) {
               if($GROUP_DATA[$i][$perm]) {
                  $authorized = true;
                  break;
               }
            }

            if ($authorized) {
               return true;
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
    return true;
  }

  /* Fetches and returns the group data corresponding to a single user.
   * @ userid
   * @ return GROUP_DATA[]
   */
  function getgroupdata ($user_id) {
    global $DBS, $DISPLAY;

    $fieldstring = "";
    for($i=0;$i<count($DISPLAY->groupfields);$i++) {
       if($i!=0) $fieldstring .= ", ";
       $fieldstring .= "{$DBS->group[$DISPLAY->groupfields[$i]]} AS {$DISPLAY->groupfields[$i]}";
    }

    $res = array();
    $sql = "SELECT {$DBS->userxgroup['group_id']} FROM {$DBS->userxgrouptable} WHERE {$DBS->userxgroup['user_id']} = '{$user_id}'";
    $results = $DBS->sql_query($sql);
    for($i = 0; $i < mysql_numrows($results); $i++) {
      $isql =  "SELECT $fieldstring FROM {$DBS->groupstable}";
      $isql .= " WHERE {$DBS->group['group_id']}=" . mysql_result($results, $i, $DBS->userxgroup['group_id']);
      $iresult = $DBS->sql_query($isql);
      if (mysql_num_rows($iresult)) {
         $res[$i] = mysql_fetch_assoc($iresult);
         mysql_free_result($iresult);
      }
    }
    mysql_free_result($results);
    return $res;
  }

  /* Fetches and returns the data corresponding to all users.
   * @ return USER_DATA[]
   */
  function getalluserdata () {
    global $DBS, $DISPLAY;

    $fieldstring = "";
    for($i=0;$i<count($DISPLAY->userpersonalfields);$i++) {
       if($i!=0) $fieldstring .= ", ";
       $fieldstring .= "{$DBS->field[$DISPLAY->userpersonalfields[$i]]} AS {$DISPLAY->userpersonalfields[$i]}";
    }

    $sql =  "SELECT $fieldstring FROM {$DBS->usertable}";
    $results = $DBS->sql_query($sql);

    $res = array();
    for ($i = 0; $i < mysql_numrows($results); $i++) {
       $res[$i] = mysql_fetch_assoc($results);
    }
    mysql_free_result($results);
    return $res;
  }

  /* Fetches and returns the data corresponding to all groups.
   * @ return GROUP_DATA[]
   */
  function getallgroupdata () {
    global $DBS, $DISPLAY;

    $fieldstring = "";
    for($i=0;$i<count($DISPLAY->groupfields);$i++) {
       if($i!=0) $fieldstring .= ", ";
       $fieldstring .= "{$DBS->group[$DISPLAY->groupfields[$i]]} AS {$DISPLAY->groupfields[$i]}";
    }

    $sql =  "SELECT $fieldstring FROM {$DBS->groupstable}";
    $results = $DBS->sql_query($sql);
    $res = array();
    for ($i = 0; $i < mysql_numrows($results); $i++) {
       $res[$i] = mysql_fetch_assoc($results);
    }
    mysql_free_result($results);
    return $res;
  }

  /* Function to add a new user to the database.
   * @ username
   * @ password
   * @ group_id
   * @ email
   * @ active
   * @ return USER_DATA
   */
  function adduser ($addusername, $password, $group_id, $email, $active) {
    global $DBS, $DISPLAY;

    $fieldstring = "";
    for($i=0;$i<count($DISPLAY->userpersonalfields);$i++) {
       if($i!=0) $fieldstring .= ", ";
       $fieldstring .= "{$DBS->field[$DISPLAY->userpersonalfields[$i]]} AS {$DISPLAY->userpersonalfields[$i]}";
    }

    $sql = "SELECT * FROM {$DBS->usertable} WHERE {$DBS->field['username']}='" . $addusername . "'";
    $results = $DBS->sql_query($sql);
    if (mysql_num_rows($results)) {
       mysql_free_result($results);
       $USER_DATA = array();
       $USER_DATA['error'] = true;
       $USER_DATA['message'] = "Username already exists";
       return $USER_DATA;
    }

    // Check for duplicate email addresses
    if (!$CONFIG['allow_duplicate_emails_addr']) {
       $sql = "SELECT * FROM {$DBS->usertable} WHERE {$DBS->field['email']}='" . $email . "'";
       $results = $DBS->sql_query($sql);
       if (mysql_num_rows($results)) {
          mysql_free_result($results);
          $USER_DATA = array();
          $USER_DATA['error'] = true;
          $USER_DATA['message'] = "Email address already in use";
          return $USER_DATA;
       }
    }

    $sql =  "INSERT INTO {$DBS->usertable} ({$DBS->field['username']},{$DBS->field['password']},{$DBS->field['active']},{$DBS->field['email']},{$DBS->field['regdate']},{$DBS->field['lastvisit']}) VALUES ('{$addusername}', md5('{$password}'), '{$active}', '{$email}', NOW(), NOW())";
    $DBS->sql_update($sql);

    $sql = "SELECT * FROM {$DBS->usertable} WHERE {$DBS->field['username']}='" . $addusername . "'";
    $results = $DBS->sql_query($sql);
    if (mysql_num_rows($results)) {
       $adduserid = mysql_result($results, 0, $DBS->field['user_id']);
       mysql_free_result($results);
    }

    $sql =  "INSERT INTO {$DBS->userxgrouptable} ({$DBS->userxgroup['user_id']},{$DBS->userxgroup['group_id']}) VALUES ('{$adduserid}', '{$group_id}')";
    $DBS->sql_update($sql);

    return $this->getpersonaldata($addusername);
  }

  /* Function to remove an existing user from the database.
   * @ username
   * @ return USER_DATA if user exists, false if user does not exist
   */
  function removeuser ($addusername) {
    global $DBS, $DISPLAY;

    $sql = "SELECT * FROM {$DBS->usertable} WHERE {$DBS->field['username']}='" . $addusername . "'";
    $results = $DBS->sql_query($sql);
    if (mysql_num_rows($results)) {
       $adduserid = mysql_result($results, 0, $DBS->field['user_id']);
       mysql_free_result($results);
    } else {
       return false;
    }

    $res = $this->getpersonaldata($addusername);
    $sql =  "DELETE FROM {$DBS->usertable} WHERE {$DBS->field['username']}='{$addusername}'";
    $DBS->sql_update($sql);
    $sql =  "DELETE FROM {$DBS->userxgrouptable} WHERE {$DBS->userxgroup['user_id']}='{$adduserid}'";
    $DBS->sql_update($sql);

    return $res;
  }

  /* Function to add a user to a group in the database.
   * @ username
   * @ group_id
   * @ return USER_DATA if user and group exist, false otherwise
   */
  function addusertogroup ($addusername, $group_id) {
    global $DBS, $DISPLAY;

    $sql = "SELECT * FROM {$DBS->usertable} WHERE {$DBS->field['username']}='" . $addusername . "'";
    $results = $DBS->sql_query($sql);
    if (mysql_num_rows($results)) {
       $adduserid = mysql_result($results, 0, $DBS->field['user_id']);
       mysql_free_result($results);
    } else {
       return false;
    }

    $sql = "SELECT * FROM {$DBS->groupstable} WHERE {$DBS->group['group_id']}='" . $group_id . "'";
    $results = $DBS->sql_query($sql);
    if (mysql_num_rows($results)) {
       mysql_free_result($results);
    } else {
       return false;
    }

    $sql =  "INSERT INTO {$DBS->userxgrouptable} ({$DBS->userxgroup['user_id']},{$DBS->userxgroup['group_id']}) VALUES ('{$adduserid}', '{$group_id}')";
    $DBS->sql_update($sql);

    return $this->getpersonaldata($addusername);
  }

  /* Function to remove a user from a group in the database.
   * @ username
   * @ group_id
   * @ return USER_DATA if user and group exist, false otherwise
   */
  function removeuserfromgroup ($addusername, $group_id) {
    global $DBS, $DISPLAY;

    $sql = "SELECT * FROM {$DBS->usertable} WHERE {$DBS->field['username']}='" . $addusername . "'";
    $results = $DBS->sql_query($sql);
    if (mysql_num_rows($results)) {
       $adduserid = mysql_result($results, 0, $DBS->field['user_id']);
       mysql_free_result($results);
    } else {
       return false;
    }

    $sql = "SELECT * FROM {$DBS->groupstable} WHERE {$DBS->group['group_id']}='" . $group_id . "'";
    $results = $DBS->sql_query($sql);
    if (mysql_num_rows($results)) {
       mysql_free_result($results);
    } else {
       return false;
    }

    $sql =  "DELETE FROM {$DBS->userxgrouptable} WHERE {$DBS->userxgroup['user_id']}='{$adduserid}' AND {$DBS->userxgroup['group_id']}='{$group_id}'";
    $DBS->sql_update($sql);

    return $this->getpersonaldata($addusername);
  }

}

?>