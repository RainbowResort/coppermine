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

require('include/sql_parse.php');

/**
 * Class specifying everthing about the database structure
 */
class install {

  function newinstall($dbserver, $dbuser, $dbpass, $dbname, $prefix, $adminusername, $adminpassword, $adminemail) {
     global $DFLT, $CF, $DBS, $CONFIG;

     $cnf = "<?php\n";
     $cnf.= "// Coppermine configuration file\n";
     $cnf.= "// MySQL configuration\n";
     $cnf.= "\$CONFIG['dbserver'] =          '{$dbserver}';     // Your database servers\n";
     $cnf.= "\$CONFIG['dbuser'] =            '{$dbuser}';          // Your mysql username\n";
     $cnf.= "\$CONFIG['dbpass'] =            '{$dbpass}';       // Your mysql password\n";
     $cnf.= "\$CONFIG['dbname'] =            '{$dbname}';    // Your mysql database name\n";
     $cnf.= "// MySQL TABLE NAMES PREFIX\n";
     $cnf.= "\$CONFIG['TABLE_PREFIX'] =      '{$prefix}';\n";
     $cnf.= "?>\n";
 
     $dh = mkdir($DFLT['cfg_d']);
     $fh = fopen($DFLT['cfg_d'] . "/" . $DFLT['cfg_f'], 'w') or $CF->unsafeexit("install_error", "Cannot open config file");
     fwrite($fh, $cnf);
     fclose($fh);

     $CONFIG = array();
     require($DFLT['cfg_d'] . "/" . $DFLT['cfg_f']);
     $DBS->initialize();
     
     mysql_connect($DBS->db['host'], $DBS->db['user'], $DBS->db['password']);
     @mysql_select_db($DBS->db['name']) or $CF->unsafeexit("install_error", "Server connection error");

     if (($sch_open = fopen($DFLT['sql_f'], 'r')) === FALSE){
        $CF->unsafeexit("install_error", "Cannot open SQL config file");
     }  else {
        $sql_query = fread($sch_open, filesize($DFLT['sql_f']));
     }

     // Insert the admin account
     $sql_query .= "INSERT INTO CPG_users (user_id, user_group, user_active, user_name, user_password, user_lastvisit, user_regdate, user_group_list, user_email, user_profile1, user_profile2, user_profile3, user_profile4, user_profile5, user_profile6, user_actkey ) VALUES (1, 1, 'YES', '{$adminusername}', md5('{$adminpassword}'), NOW(), NOW(), '', '{$adminemail}', '', '', '', '', '', '', '');\n";
     $sql_query .= "REPLACE INTO CPG_config VALUES ('gallery_admin_email', '{$adminemail}');\n";
     // Test write permissions for main dir
     if (!is_writable('.')) {
         $sql_query .= "REPLACE INTO CPG_config VALUES ('default_dir_mode', '0777');\n";
         $sql_query .= "REPLACE INTO CPG_config VALUES ('default_file_mode', '0666');\n";
     }
     // Update table prefix
     $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);
     $sql_query = remove_remarks($sql_query);
     $sql_query = split_sql_file($sql_query, ';');

     foreach($sql_query as $q) {
        if (! mysql_query($q)) {
           $CF->unsafeexit("install_error", "Error executing SQL statement");
        }
     }

     mysql_close();

     $fh = fopen($DFLT['cfg_d'] . "/" . $DFLT['ins_f'], 'w') or $CF->unsafeexit("install_error", "Cannot open install file");
     fwrite($fh, "1");
     fclose($fh);

     print "<messagecode>{$MESSAGECODE['success']}</messagecode><message>\nCoppermine Installed\n</message>\n";
     $CF->safeexit();
  }
  
  function uninstall() {
     global $DFLT, $CF, $DBS, $CONFIG;

     $fh = fopen($DFLT['cfg_d'] . "/" . $DFLT['cfg_f'], 'r') or $CF->unsafeexit("install_error", "Cannot open config file");
     fclose($fh);

     $CONFIG = array();
     require($DFLT['cfg_d'] . "/" . $DFLT['cfg_f']);
     $DBS->initialize();
     
     mysql_connect($DBS->db['host'], $DBS->db['user'], $DBS->db['password']);
     @mysql_select_db($DBS->db['name']) or $CF->unsafeexit("install_error", "Server connection error");

     if (($sch_open = fopen($DFLT['sqloff_f'], 'r')) === FALSE){
        $CF->unsafeexit("install_error", "Cannot open SQL config file");
     }  else {
        $sql_query = fread($sch_open, filesize($DFLT['sql_f']));
     }

     // Update table prefix
     $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);
     $sql_query = remove_remarks($sql_query);
     $sql_query = split_sql_file($sql_query, ';');

     foreach($sql_query as $q) {
        if (! mysql_query($q)) {
           $CF->unsafeexit("install_error", "Error executing SQL statement");
        }
     }

     mysql_close();

     unlink($DFLT['cfg_d'] . "/" . $DFLT['cfg_f']);
     unlink($DFLT['cfg_d'] . "/" . $DFLT['ins_f']);
     print "<messagecode>{$MESSAGECODE['success']}</messagecode><message>\nCoppermine Uninstalled\n</message>\n";
     $CF->safeexit();
  }
}