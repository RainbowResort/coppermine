<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2005 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.4.1
  $Source$
  $Revision$
  $Author$
  $Date$
**********************************************/


if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Switch that allows overriding the bridge manager with hard-coded values
define('USE_BRIDGEMGR', 0);

require 'udb_base.inc.php';

class cpg_udb extends core_udb {

	function cpg_udb()
	{
		global $BRIDGE, $CONFIG;
		
		if (!USE_BRIDGEMGR) { // the vars that are used when bridgemgr is disabled

			// URL of your punbb
			$this->cookie_name = 'blah';
			$this->datapath = '/var/www/cgi-bin/Blah/Members/';
			$this->boardurl = 'http://localhost/cgi-bin/Blah';
		}
		
		$this->multigroups = 0;
		$this->group_overrride = 0;
		
		// Database connection settings
		$this->db = array(
			'name' => $CONFIG['dbname'],
			'host' => $CONFIG['dbserver'],
			'user' => $CONFIG['dbuser'],
			'password' => $CONFIG['dbpass'],
			'prefix' =>$CONFIG['TABLE_PREFIX']
		);
		
		// Board table names
		$this->table = array(
			'users' => 'users',
			'groups' => 'usergroups'
		);

		// Derived full table names
		$this->usertable = '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['users'];
		$this->groupstable =  '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['groups'];
		
		// Table field names
		$this->field = array(
			'username' => 'user_name', // name of 'username' field in users table
			'user_id' => 'user_id', // name of 'id' field in users table
			'password' => 'user_password', // name of 'password' field in users table
			'email' => 'user_email', // name of 'email' field in users table
			'regdate' => 'user_regdate', // name of 'registered' field in users table
			'location' => 'user_location', // name of 'location' field in users table
			'website' => 'user_website', // name of 'website' field in users table
			'usertbl_group_id' => 'user_group', // name of 'group id' field in users table
			'grouptbl_group_id' => 'group_id'
		);
		
		// Pages to redirect to
		$this->page = array(
			'register' => '/register.php',
			'editusers' => '/userlist.php',
			'edituserprofile' => '/Blah.pl?b=,v=memberpanel,a=view,u='
		);
		
		// Group ids
		$this->admingroups = array(1);
		$this->guestgroup = 3;

		// Connect to db
		$this->connect($CONFIG['link_id']);

	}
		
	// definition of how to extract id, name, group from a session cookie
	function session_extraction()
	{
		return false;
	}
	
	// definition of how to extract an id and password hash from a cookie
	function cookie_extraction()
	{
		if (isset($_COOKIE['blahname']) && isset($_COOKIE['blahpass'])){
			return array($this->get_user_id($_COOKIE['blahname']), $_COOKIE['blahpass']);
		}
		
		return false;
	}
	
	// View user profile
	function view_profile($uid)
	{
		$this->redirect($this->page['edituserprofile'].$this->get_user_name($uid ? $uid : USER_ID));
	}

	// Edit user profile
	function edit_profile($uid)
	{
		$this->redirect($this->page['edituserprofile'].$this->get_user_name($uid));
	}

	// definition of actions required to convert a password from user database form to cookie form
	function udb_hash_db($password)
	{
		return crypt($password, $_COOKIE['blahpass']);
	}
	
	// Login
	function login_page()
	{
		$this->redirect('/Blah.pl?,v=login');
	}

	// Logout
	function logout_page()
	{
		$this->redirect('/Blah.pl?,v=login,p=3');
	}
	
	function get_user_id($username)
	{
		static $x = false;
		
		$username = addslashes($username);

		$sql = "SELECT {$this->field['user_id']} AS user_id FROM {$this->usertable} WHERE {$this->field['username']}  = '$username'";

		$result = cpg_db_query($sql, $this->link_id);

		if (mysql_num_rows($result)) {
			$row = mysql_fetch_array($result);
			mysql_free_result($result);
			return $row['user_id'];
		} else {
			if (!$x){
				$x =  true;
				$this->sync_users();
				$id = 0;
				$id = $this->get_user_id($username);
				return $id;
			}
		}
		return 0;
	}
	
	function synchronize_groups()
	{
		parent::synchronize_groups();
		$this->sync_users();
	}
	
	function sync_users()
	{
		$data = file($this->datapath . 'List.txt');
		
		foreach ($data as $name){
			$name = trim($name);
			$info = file($this->datapath . "$name.dat");
			$info = array_map('trim', $info);
			
			list($password, $username, $email,,$rank) = $info;
			$user_group = $rank === 'Administrator' ? 1 : 2;
			cpg_db_query("INSERT IGNORE INTO {$this->usertable} (`user_name`, `user_password`, `user_email`, `user_active`, `user_group`) VALUES ( '$username', '$password', '$email', 'YES', $user_group)");
		}
	}
}

// and go !
$cpg_udb = new cpg_udb;
?>
