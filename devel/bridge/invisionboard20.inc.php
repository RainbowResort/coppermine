<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2005 Coppermine Dev Team
  v1.1 originaly written by Gregory DEMAR

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
define('USE_BRIDGEMGR', 1);

require 'core.inc.php';

class cpg_udb extends core_udb {

	function cpg_udb()
	{
		global $BRIDGE;
		
		if (!USE_BRIDGEMGR) {
			$this->boardurl = 'http://localhost/ipb';
			require_once('../ipb/conf_global.php');
			$this->use_post_based_groups = 0;
		} else {
			require_once($BRIDGE['relative_path_to_config_file'] . '/conf_global.php');
			$this->boardurl = $INFO['board_url'];
			$this->use_post_based_groups = $BRIDGE['use_post_based_groups'];
		}
		
		// Database connection settings
		$this->db = array(
			'name' => $INFO['sql_database'],
			'host' => $INFO['sql_host'] ? $INFO['sql_host'] : 'localhost',
			'user' => $INFO['sql_user']	,
			'password' => $INFO['sql_pass'],
			'prefix' =>$INFO['sql_tbl_prefix']
		);
		
		// Board table names
		$this->table = array(
			'users' => 'members',
			'groups' => 'groups',
			'sessions' => 'sessions'
		);

		// Derived full table names
		$this->usertable = '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['users'];
		$this->groupstable =  '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['groups'];
		$this->sessionstable =  '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['sessions'];
		
		// Table field names
		$this->field = array(
			'username' => 'name', // name of 'username' field in users table
			'user_id' => 'id', // name of 'id' field in users table
			'password' => 'legacy_password', // name of 'password' field in users table
			'email' => 'email', // name of 'email' field in users table
			'regdate' => 'joined', // name of 'registered' field in users table
			'location' => "''", // name of 'location' field in users table
			'website' => "''", // name of 'website' field in users table
			'usertbl_group_id' => 'mgroup', // name of 'group id' field in users table
			'grouptbl_group_id' => 'g_id', // name of 'group id' field in groups table
			'grouptbl_group_name' => 'g_title' // name of 'group name' field in groups table
		);
		
		// Pages to redirect to
		$this->page = array(
			'register' => '/index.php?act=Reg&CODE=00',
			'editusers' => '/admin.php',
			'edituserprofile' => '/index.php?showuser='
		);
	
	
		// Group ids - admin and guest only.
		$this->admingroup = $this->use_post_based_groups ? $INFO['admin_group'] : 1;
		$this->guestgroup = $this->use_post_based_groups ? $INFO['guest_group'] : 3;
		
		// Connect to db
		$this->connect();
	}

	// definition of how to extract id, name, group from a session cookie
	function session_extraction($cookie_uid)
	{
		if (isset($_COOKIE['session_id'])) {
			$session_id = addslashes($_COOKIE['session_id']);

        if (isset($_SERVER['REMOTE_ADDR'])) {
            $remote_ip = $_SERVER['REMOTE_ADDR'];
        } elseif (isset($HTTP_X_FORWARDED_FOR)) {
            $remote_ip = $HTTP_X_FORWARDED_FOR;
        } elseif (isset($HTTP_PROXY_USER)) {
            $remote_ip = $HTTP_PROXY_USER;
        } elseif (isset($REMOTE_ADDR)) {
            $remote_ip = $REMOTE_ADDR;
        } else {
            $remote_ip = '-1';
        };
		
		 $remote_ip = preg_replace("/^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})/", "\\1.\\2.\\3.\\4", $remote_ip);
			
			$sql = "SELECT member_id AS id, member_name AS name, member_group AS mgroup FROM {$this->sessionstable} WHERE id = '$session_id'";
			
			$result = cpg_db_query($sql, $this->link_id);
			
			if (mysql_num_rows($result)){
				$row = mysql_fetch_array($result);
				return $row;
			}
		} else {
			return false;
		}
	}
	
	// definition of how to extract an id and password hash from a cookie
	function cookie_extraction()
	{
	    $id = 0;
		$pass = '';
		
		if (isset($_COOKIE['member_id']) && isset($_COOKIE['pass_hash'])) {
			$id = (int)$_COOKIE['member_id'];
			$pass = substr(addslashes($_COOKIE['pass_hash']), 0, 32);
		}

		return array($id, $pass);
	}
	
	// definition of actions required to convert a password from user database form to cookie form
	function udb_hash_db($password)
	{
		return $password; // unused
	}
	
	function login_page()
	{
		$this->redirect("/index.php?act=Login&CODE=00");
	}

	function logout_page()
	{
		$this->redirect("/index.php?act=Login&CODE=03");
	}
}

// and go !
$cpg_udb = new cpg_udb;
?>