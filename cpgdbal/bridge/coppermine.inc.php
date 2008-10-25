<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.0
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/bridge/coppermine.inc.php $
  $Revision: 5129 $
  $LastChangedBy: gaugau $
  $Date: 2008-10-18 16:03:12 +0530 (Sat, 18 Oct 2008) $
**********************************************/


if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (isset($bridge_lookup)) {
    // Do nothing - the default bridge file "coppermine.inc.php" is not an option in the bridge manager.
    // In other bridge files, we populate an array that specifies what bridging options are available for that particular file
} else {

	// Switch that allows overriding the bridge manager with hard-coded values
	define('USE_BRIDGEMGR', 1);

    require_once 'bridge/udb_base.inc.php';

    class coppermine_udb extends core_udb {

            function coppermine_udb()
            {
                    global $BRIDGE,$CONFIG;
                    ####################    DB    ##################
                    $cpgdb =& cpgDB::getInstance();
                    $cpgdb->connect_to_existing($CONFIG['LINK_ID']);
                    ###########################################

                    $superCage = Inspekt::makeSuperCage();

                    if (!USE_BRIDGEMGR) {

                            $this->boardurl = 'http://localhost/coppermine';
                            include_once('../include/config.inc.php');

                    } else {
                            $this->boardurl = $CONFIG['site_url'];
                            $this->use_post_based_groups = @$BRIDGE['use_post_based_groups'];
                    }

                    // A hash that's a little specific to the client's configuration
                    $this->client_id = md5($superCage->server->getEscaped('HTTP_USER_AGENT').$superCage->server->getEscaped('SERVER_PROTOCOL').$CONFIG['site_url']);

                    $this->multigroups = 1;

                    $this->group_overrride = !$this->use_post_based_groups;

                    // Database connection settings
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
                            'groups' => 'usergroups',
                            'sessions' => 'sessions'
                    );

                    // Derived full table names
                    /* $this->usertable = '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['users'];
                    $this->groupstable =  '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['groups'];
                    $this->sessionstable =  '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['sessions']; */
                    ##################################            DB          ###################################
                    $this->usertable = $cpgdb->getFullTableNames($this->db['name'], $this->db['prefix'], $this->table['users']);
                    $this->groupstable = $cpgdb->getFullTableNames($this->db['name'], $this->db['prefix'], $this->table['groups']);
                    $this->sessionstable = $cpgdb->getFullTableNames($this->db['name'], $this->db['prefix'], $this->table['sessions']);
                    ####################################################################################

                    // Table field names
                    $this->field = array(
                            'username' => 'user_name', // name of 'username' field in users table
                            'user_id' => 'user_id', // name of 'id' field in users table
                            'password' => 'user_password', // name of 'password' field in users table
                            'email' => 'user_email', // name of 'email' field in users table
                            //'regdate' => 'UNIX_TIMESTAMP(user_regdate)', // name of 'registered' field in users table
                            //'lastvisit' => 'UNIX_TIMESTAMP(user_lastvisit)', // last time user logged in
                            'regdate' => 'user_regdate', // name of 'registered' field in users table
                            'lastvisit' => 'user_lastvisit', // last time user logged in
                            'active' => 'user_active', // is user account active?
                            'location' => "''", // name of 'location' field in users table
                            'website' => "''", // name of 'website' field in users table
                            'usertbl_group_id' => 'user_group', // name of 'group id' field in users table
                            'grouptbl_group_id' => 'group_id', // name of 'group id' field in groups table
                            'grouptbl_group_name' => 'group_name' // name of 'group name' field in groups table
                    );

                    // Pages to redirect to
                    $this->page = array(
                            'register' => 'register.php',
                            'editusers' => 'usermgr.php',
                            'edituserprofile' => 'profile.php'
                    );

                    // Group ids - admin and guest only.
                    $this->admingroups = array(1);
                    $this->guestgroup = 3;

                    // Connect to db
                    $this->connect($CONFIG['LINK_ID']);
            }


            // Login function
            function login( $username = null, $password = null, $remember = false ) {
                    global $CONFIG;
                    #################  DB  #################
                    global $cpg_db_coppermine_inc;	
                    $cpgdb =& cpgDB::getInstance();
                    $cpgdb->connect_to_existing($CONFIG['LINK_ID']);
                    #####################################

                    // Create the session_id from concat(cookievalue,client_id)
                    $session_id = $this->session_id.$this->client_id;

                    $encpassword = md5($password);


                    /*// Check for user in users table
                    $sql =  "SELECT user_id, user_name, user_password FROM {$this->usertable} WHERE ";
    				//Check the login method (username, email address or both)
    				switch($CONFIG['login_method']){
    					case 'both':
    						$sql .= "(user_name = '$username' OR user_email = '$username') AND BINARY user_password = '$encpassword' AND user_active = 'YES'";
    						break;
    					case 'email':
    						$sql .= "user_email = '$username' AND BINARY user_password = '$encpassword' AND user_active = 'YES'";
    						break;
    					case 'username':
    					default:
    						$sql .= "user_name = '$username' AND BINARY user_password = '$encpassword' AND user_active = 'YES'";
    						break;
    				}
                   
                    $results = cpg_db_query($sql);

                    // If exists update lastvisit value, session, and login
                    if (mysql_num_rows($results)) {

                            // Update lastvisit value
                            $sql =  "UPDATE {$this->usertable} SET user_lastvisit = NOW() ";
    						//Check the login method (username, email address or both)
    						switch($CONFIG['login_method']){
    							case 'both':
    								$sql .= "WHERE (user_name = '$username' OR user_email = '$username') AND BINARY user_password = '$encpassword' AND user_active = 'YES'";
    								break;
    							case 'email':
    								$sql .= "WHERE user_email = '$username' AND BINARY user_password = '$encpassword' AND user_active = 'YES'";
    								break;
    							case 'username':
    							default:
    								$sql .= "WHERE user_name = '$username' AND BINARY user_password = '$encpassword' AND user_active = 'YES'";
    								break;
    						}
                            cpg_db_query($sql, $this->link_id);

                            $USER_DATA = mysql_fetch_assoc($results);
                            mysql_free_result($results);

                            // If this is a 'remember me' login set the remember field to true
                            if ($remember) {
                                    $remember_sql = ",remember = '1' ";
                            } else {
                                    $remember_sql = '';
                            }

                            // Update guest session with user's information
                            $sql  = "update {$this->sessionstable} set ";
                            $sql .= "user_id={$USER_DATA['user_id']} ";
                            $sql .= $remember_sql;
                            $sql .= "where session_id = '" . md5($session_id) . "'";
                            cpg_db_query($sql, $this->link_id); */
                    ##########################################  DB   ##########################################
                    //Check the login method (username, email address or both)
                    switch($CONFIG['login_method']){
                        case 'both':
                            $where= "(user_name = '$username' OR user_email = '$username') AND  user_password = '$encpassword' AND user_active = 'YES'";
                            break;
                        case 'email':
                            $where= "user_email = '$username' AND  user_password = '$encpassword' AND user_active = 'YES'";
                            break;
                        case 'username':
                        default:
                            $where= "user_name = '$username' AND  user_password = '$encpassword' AND user_active = 'YES'";
                            break;
                    } // 'BINARY' removed for mssql
                    // Check for user in users table
                    //print("username ".$username);exit;
                    $cpgdb->query($cpg_db_coppermine_inc['login_get_user_info'],$this->usertable, $where);
                    $rowset = $cpgdb->fetchRowSet();

                    // If exists update lastvisit value, session, and login
                    if (count($rowset)) {

                        // Update lastvisit value
                        $this->cpgudb->query($cpg_db_coppermine_inc['login_set_user_lastvisit'], $this->usertable, $where);

                        $USER_DATA = $rowset[0];
                        $cpgdb->free();
                        // If this is a 'remember me' login set the remember field to true
                        if ($remember) {
                            $remember_sql = ",remember = '1' ";
                        } else {
                            $remember_sql = '';
                        }

                        $this->cpgudb->query($cpg_db_coppermine_inc['update_guestsession'], $this->sessionstable, $USER_DATA['user_id'], $remember_sql, md5($session_id));

                    ########################################################################################

                            return $USER_DATA;
                    } else {

                            return false;
                    }
            }


            // Logout function
            function logout() {
                    global $cpg_db_coppermine_inc;    #####    cpgdb_AL

                    // Revert authenticated session to a guest session
                    $session_id = $this->session_id.$this->client_id;
                    /*$sql  = "update {$this->sessionstable} set user_id = 0, remember=0 where session_id = '" . md5($session_id) . "'";
                    cpg_db_query($sql, $this->link_id); */
                    #############################   DB   ################################
                    $this->cpgudb->query($cpg_db_coppermine_inc['logout_session'], $this->sessionstable, md5($session_id));
                    ####################################################################
            }

            /*// Get groups of which user is member
            function get_groups( $user )
            {
    			$groups = array($user['group_id'] - 100);

    			$sql = "SELECT user_group_list FROM {$this->usertable} AS u WHERE {$this->field['user_id']}='{$user['id']}' and user_group_list <> '';";

    			$result = cpg_db_query($sql, $this->link_id);

    			if ($row = mysql_fetch_array($result)){
    				$groups = array_merge($groups, explode(',', $row['user_group_list']));
    			}

    			mysql_free_result($result);

    			return $groups;
            } */
            ###########################   DB   ##############################
            // Get groups of which user is member
            function get_groups( $user )
            {
                global $cpg_db_coppermine_inc;
                $groups = array($user['group_id'] - 100);

                $this->cpgudb->query($cpg_db_coppermine_inc['get_user_group'], $this->usertable, $this->field['user_id'], $user['id']);

                if ($row = $this->cpgudb->fetchRow()){
                    $groups = array_merge($groups, explode(',', $row['user_group_list']));
                }

                $this->cpgudb->free();
                return $groups;
            }
            ###############################################################

            // definition of actions required to convert a password from user database form to cookie form
            function udb_hash_db($password)
            {
                    return $password;
            }


            // definition of how to extract id, name, group from a session cookie
            function session_extraction()
            {
                global $CONFIG;
                ####################### DB #########################	
                global $cpg_db_coppermine_inc;
                $cpgdb =& cpgDB::getInstance();
                $cpgdb->connect_to_existing($CONFIG['LINK_ID']);
                ##################################################	

                $superCage = Inspekt::makeSuperCage();

                // Default anonymous values
                $id = 0;
                $pass = '';

                // Get the session cookie value
                $sessioncookie = $superCage->cookie->getEscaped($this->client_id);

                // Create the session id by concat(session_cookie_value, client_id)
                $session_id = $sessioncookie.$this->client_id;

                // Lifetime of 'remember me' session is 2 weeks
                $rememberme_life_time = time()-(CPG_WEEK*2);

                // Lifetime of normal session is 1 hour
                $session_life_time = time()-CPG_HOUR;

    			// only clean up old sessions sometimes
    			if (rand(0, 100) == 42){
                
                	// Delete old sessions
    				/* $sql = "delete from {$this->sessionstable} where time<$session_life_time and remember=0;";
    				cpg_db_query($sql, $this->link_id); */
                    ##################################    DB     ####################################
                    $this->cpgudb->query($cpg_db_coppermine_inc['delete_old_sessions'], $this->sessionstable, $session_life_time);
                    ###########################################################################

                	// Delete stale 'remember me' sessions
                	/*$sql = "delete from {$this->sessionstable} where time<$rememberme_life_time;";
                	cpg_db_query($sql, $this->link_id); */
                    ##################################    DB     ####################################
                    $this->cpgudb->query($cpg_db_coppermine_inc['delete_remember_sessions'], $this->sessionstable, $rememberme_life_time);
                    ###########################################################################
    			}
    				
                /*// Check for valid session if session_cookie_value exists
                if ($sessioncookie) {

                    // Check for valid session
                    $sql =  'select user_id, time from '.$this->sessionstable." where session_id = '" . md5($session_id) . "'";
                    $result = cpg_db_query($sql);

                    // If session exists...
                    if (mysql_num_rows($result)) {
                        $row = mysql_fetch_assoc($result);
                        mysql_free_result($result);

                        $row['user_id'] = (int) $row['user_id'];
    					$this->sessiontime = $row['time'];

                        // Check if there's a user for this session
                        $sql =  'select user_id as id, user_password as password ';
                        $sql .= 'from '.$this->usertable.' ';
                        $sql .= 'where user_id='.$row['user_id'];
                        $result = cpg_db_query($sql, $this->link_id);

                        // If user exists, use the current session
                        if ($result) {
                            $row = mysql_fetch_assoc($result);
                            mysql_free_result($result);

                            $pass = $row['password'];
                            $id = (int) $row['id'];
                            $this->session_id = $sessioncookie;

                        // If the user doesn't exist, use default guest credentials
                        }

                    // If not a valid session exists, create a new session
                    } else {

                        $this->create_session();
                    } */
                ##################################    DB     ####################################
                // Check for valid session if session_cookie_value exists
                if ($sessioncookie) {

                $cpgdb->query($cpg_db_coppermine_inc['check_valid_session'], $this->sessionstable, md5($session_id));
                $rowset = $cpgdb->fetchRowSet();
                // If session exists...
                if (count($rowset)) {
                    $row = $rowset[0];
                    $cpgdb->free();

                    $row['user_id'] = (int) $row['user_id'];

                    // Check if there's a user for this session
                    $result = $this->cpgudb->query($cpg_db_coppermine_inc['check_session_user'], $this->usertable, $row['user_id']);
                    // If user exists, use the current session
                    if ($result) {
                        $row = $this->cpgudb->fetchRow();
                        $this->cpgudb->free();

                        $pass = $row['password'];
                        $id = (int) $row['id'];
                        $this->session_id = $sessioncookie;

                    // If the user doesn't exist, use default guest credentials
                    }

                // If not a valid session exists, create a new session
                } else {
                    $this->create_session();
                }
                ###########################################################################

                // No session exists; create one
                } else {

                    $this->create_session();
                }

                return ($id) ? array($id, $pass) : false;
            }


            /*// Function used to keep the session alive
            function session_update()
            {
            		// don't update null sessions
     		       	if (!$this->session_id) return false;
     		       	
     		       	// only update session time once per minute at maximum
     		       	if (time() - $this->sessiontime < 60) return false;
            	
                    $session_id = $this->session_id.$this->client_id;
                    $sql = "update {$this->sessionstable} set time='".time()."' where session_id = '" . md5($session_id) . "'";
                    cpg_db_query($sql);
            } */

            ####################### DB #########################	
            // Function used to keep the session alive
            function session_update() {
                global $CONFIG, $cpg_db_coppermine_inc;
                $cpgdb =& cpgDB::getInstance();
                $cpgdb->connect_to_existing($CONFIG['LINK_ID']);

                // don't update null sessions
                if (!$this->session_id) return false;

                // only update session time once per minute at maximum
                if (time() - $this->sessiontime < 60) return false;

                $session_id = $this->session_id.$this->client_id;
                $cpgdb->query($cpg_db_coppermine_inc['session_update'], $this->sessionstable, time(), md5($session_id));
}
            ##################################################	


            // Create a new session with the cookie lifetime set to 2 weeks
            function create_session() {
                    global $CONFIG;
                    global $cpg_db_coppermine_inc;
                    
                    $superCage = Inspekt::makeSuperCage();
                    
         			// don't create sessions for people that don't accept cookies anyway
         			if (!$superCage->cookie->keyExists($CONFIG['cookie_name'].'_data')) return false;   
    				
                    // start session
                    $this->session_id = $this->generateId();
                    $session_id = $this->session_id.$this->client_id;

                    /* $sql =  'insert into '.$this->sessionstable.' (session_id, user_id, time, remember) values ';
                    $sql .= '("'.md5($session_id).'", 0, "'.time().'", 0);';

                    // insert the guest session
                    cpg_db_query($sql, $this->link_id); */
                    ########################     DB     ##########################
                    // insert the guest session
                    $this->cpgudb->query($cpg_db_coppermine_inc['create_session'], $this->sessionstable, md5($session_id), time());
                    #########################################################

                    // set the session cookie
                    setcookie( $this->client_id, $this->session_id, time() + (CPG_WEEK*2), $CONFIG['cookie_path'] );
            }


            // Modified function taken from Mambo session class
            function generateId() {
                    global $cpg_db_coppermine_inc;
                    $failsafe = 20;
                    $randnum = 0;
                    while ($failsafe--) {
                            $randnum = md5( uniqid( microtime(), 1 ));
                            $session_id = $randnum.$this->client_id;
                            if ($randnum != "") {
                                    /* $sql = "SELECT session_id FROM {$this->sessionstable} WHERE session_id = '" . md5($session_id) . "'";
    								$result = cpg_db_query($sql, $this->link_id);
                                    if (!mysql_num_rows($result)) {
                                            break;
                                    }
                                    mysql_free_result($result); */
                                    #################################   DB   ####################################
                                    if (!$result = $this->cpgudb->query($cpg_db_coppermine['generate_session_id'], $this->sessionstable, MD5($session_id))) {
                                        break;
                                    }
                                    $this->cpgudb->free();
                                    ##########################################################################
                            }
                    }
                    return $randnum;
            }


            // Gets user/guest count
            function get_session_users() {
                    global $cpg_db_coppermine_inc;
                    static $count = array();

                    /* if (!$count) {
                            // Get guest count
                            $sql = "select count(user_id) as num_guests from {$this->sessionstable} where user_id=0;";
                            $result = cpg_db_query($sql, $this->link_id);
                            $count = mysql_fetch_assoc($result);

                            // Get authenticated user count
                            $sql = "select count(user_id) as num_users from {$this->sessionstable} where user_id>0;";
                            $result = cpg_db_query($sql, $this->link_id);
                            $count = array_merge(mysql_fetch_assoc($result), $count);
                    } */
                   ################################    DB    #################################
                   if (!$count) {
                        // Get guest count
                        $this->cpgudb->query($cpg_db_coppermine_inc['get_guest_count'], $this->sessionstable);
                        $count = $this->cpgudb->fetchRow();

                        // Get authenticated user count
                        $this->cpgudb->query($cpg_db_coppermine_inc['get_auth_user_count'], $this->sessionstable);
                        $count = array_merge($this->cpgudb->fetchRow(), $count);
                    }
                    ######################################################################

                    return $count;
            }


            /*
             * Overidden functions !!DO NOT REMOVE OR CPG WILL NOT WORK CORRECTLY!!
             */
            // definition of how to extract an id and password hash from a cookie
            function cookie_extraction()
            {
                    return false;
            }

            // Register
            function register_page()
            {        }

            // Edit users
            function edit_users()
            {        }

            // View users
            function view_users()
            {        }

            // View user profile
            function view_profile($uid)
            {        }

            // Edit user profile
            function edit_profile($uid)
            {        }

            function login_page()
            {        }

            function logout_page() {
                $this->logout();
            }
    		/* Note : we don't want to overide this - the groups need to be resynced to coppermine default after un-integration
             * Rebuttal: without overriding and removing Coppermine group deletion (see below) its impossible to add new groups to a non-bridged install.
             */

        	function synchronize_groups()
        	{
        		global $CONFIG ;
                ####################### DB #########################
                global $cpg_db_coppermine_inc;
                $cpgdb =& cpgDB::getInstance();
                $cpgdb->connect_to_existing($CONFIG['LINK_ID']);
                ##################################################	

        		if ($this->use_post_based_groups){
        			if ($this->group_overrride){
        				$udb_groups = $this->collect_groups();
        			} else {
        				/* $sql = "SELECT * FROM {$this->groupstable} WHERE {$this->field['grouptbl_group_name']} <> ''";

        				$result = cpg_db_query($sql, $this->link_id); */
                        ###########################################    DB    ######################################
                        $this->cpgudb->query($cpg_db_coppermine_inc['get_group_no_override'], $this->groupstable, $this->field['grouptbl_group_name']);
                        #######################################################################################

        				$udb_groups = array();

        				//while ($row = mysql_fetch_assoc($result))
                        while ($row = $this->cpgudb->fetchRow())
        				{
        					$udb_groups[$row[$this->field['grouptbl_group_id']]+100] = utf_ucfirst(utf_strtolower($row[$this->field['grouptbl_group_name']]));
        				}
        			}
        		} else {
        			$udb_groups = array(1 =>'Administrators', 2=> 'Registered', 3=>'Guests', 4=> 'Banned');
        		}

        		/* $result = cpg_db_query("SELECT group_id, group_name FROM {$CONFIG['TABLE_USERGROUPS']} WHERE 1");

        		while ($row = mysql_fetch_array($result)) {
        			$cpg_groups[$row['group_id']] = $row['group_name'];
        		}

        		mysql_free_result($result); */
                ############################    DB    ###############################
                $cpgdb->query($cpg_db_coppermine_inc['get_group_data']);

                while ($row = $cpgdb->fetchRow()) {
                    $cpg_groups[$row['group_id']] = $row['group_name'];
                }
                $cpgdb->free();
                #################################################################
                /* Must be removed to allow new groups to be created in an unbridged install.
        		// Scan Coppermine groups that need to be deleted
        		foreach($cpg_groups as $c_group_id => $c_group_name) {
        			if ((!isset($udb_groups[$c_group_id]))) {
        				cpg_db_query("DELETE FROM {$CONFIG['TABLE_USERGROUPS']} WHERE group_id = '" . $c_group_id . "' LIMIT 1");
        				unset($cpg_groups[$c_group_id]);
        			}
        		}
        		*/

        		// Scan udb groups that need to be created inside Coppermine table
        		foreach($udb_groups as $i_group_id => $i_group_name) {
        			if ((!isset($cpg_groups[$i_group_id]))) {
        				// add admin info
        				$admin_access = in_array($i_group_id-100, $this->admingroups) ? '1' : '0';
        				//cpg_db_query("INSERT INTO {$CONFIG['TABLE_USERGROUPS']} (group_id, group_name, has_admin_access) VALUES ('$i_group_id', '" . addslashes($i_group_name) . "', '$admin_access')");
                        #########################    DB   #############################
                        $cpgdb->query($cpg_db_coppermine_inc['add_admin_info'], $i_group_id, addslashes($i_group_name), $admin_access);
                        ###########################################################
        				$cpg_groups[$i_group_id] = $i_group_name;
        			}
        		}

        		// Update Group names
        		foreach($udb_groups as $i_group_id => $i_group_name) {
        			if ($cpg_groups[$i_group_id] != $i_group_name) {
        				//cpg_db_query("UPDATE {$CONFIG['TABLE_USERGROUPS']} SET group_name = '" . addslashes($i_group_name) . "' WHERE group_id = '$i_group_id' LIMIT 1");
                        #########################    DB   #############################
                        $cpgdb->query($cpg_db_coppermine_inc['update_group_names'], addslashes($i_group_name), $i_group_id);
                        ###########################################################
        			}
        		}
        		// fix admin grp
        		//if (!$this->use_post_based_groups) cpg_db_query("UPDATE {$CONFIG['TABLE_USERGROUPS']} SET has_admin_access = '1' WHERE group_id = '1' LIMIT 1");
                ######################################       DB      #####################################
                if (!$this->use_post_based_groups) $cpgdb->query($cpg_db_coppermine_inc['fix_admin_group']);
                #################################################################################

        	}

    }

    // and go !
    $cpg_udb = new coppermine_udb;
}
?>