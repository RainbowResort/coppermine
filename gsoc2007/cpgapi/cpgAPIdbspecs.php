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
 * Class specifying everthing about the database structure
 */
class dbspecs {
  var $db, $table, $usertable, $groupstable, $configtable, $usergroupstable, $field, $group, $userxgroup;
  var $dbactive = false;

  function initialize() {
    // Database connection settings
    global $CONFIG;

    $this->db = array(
        'name' => $CONFIG['dbname'],
        'host' => $CONFIG['dbserver'] ? $CONFIG['dbserver'] : 'localhost',
        'user' => $CONFIG['dbuser'],
        'password' => $CONFIG['dbpass'],
        'prefix' =>$CONFIG['TABLE_PREFIX']
    );

    // Board table names
    $this->table = array(
        'users' => 'users',
        'userxgroup' => 'userxgroup',
        'groups' => 'usergroups',
        'config' => 'config'
    );
	
    // Derived full table names
    $this->usertable = '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['users'];
    $this->userxgrouptable = '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['userxgroup'];
    $this->groupstable =  '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['groups'];
    $this->configtable =  '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['config'];

    // Table field names
    $this->field = array(
        'username' => 'user_name', // name of 'username' field in users table
        'user_id' => 'user_id', // name of 'id' field in users table
        'password' => 'user_password', // name of the password field in the users table
        'email' => 'user_email', // name of 'email' field in users table
        'regdate' => 'user_regdate', // name of 'registered' field in users table
        'lastvisit' => 'user_lastvisit', // last time user logged in
        'active' => 'user_active', // is user account active?
        'sessionkey' => 'user_sessionkey' // session key if the user is logged in
    );

    // Table userxgroup values
    $this->userxgroup = array(
        'user_id' => 'user_id', // name of 'id' field in users table
        'group_id' => 'group_id' // group this user belongs to
    );

    // Group field names
    $this->group = array(
        'groupname' => 'group_name',
        'group_id' => 'group_id',
        'admin' => 'has_admin_access',
        'can_rate_pictures' => 'can_rate_pictures',
        'can_send_ecards' => 'can_send_ecards',
        'can_post_comments' => 'can_post_comments',
        'can_upload_pictures' => 'can_upload_pictures',
        'can_create_albums' => 'can_create_albums',
        'pub_upload' => 'pub_upl_need_approval',
        'prv_upload' => 'prv_upl_need_approval',
        'upload_form_config' => 'upload_form_config',
        'custom_user_upload' => 'custom_user_upload',
        'num_file_upload' => 'num_file_upload',
        'num_URI_upload' => 'num_URI_upload'
    );
  }

  function sql_connect() {
    global $DBS, $CF;
    mysql_connect($this->db['host'], $this->db['user'], $this->db['password']);
    @mysql_select_db($this->db['name']) or $CF->unsafeexit("dbserver", "Server connection error");
    $this->dbactive = true;
  }

  function sql_disconnect() {
    mysql_close();
  }
 
  function sql_query($sqlquery) {
    $results = mysql_query($sqlquery);
    return $results;
  }

  function sql_update($sqlquery) {
    mysql_query($sqlquery);
  }

}

?>