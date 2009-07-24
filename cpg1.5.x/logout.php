<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.2
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

define('IN_COPPERMINE', true);
define('LOGOUT_PHP', true);

require('include/init.inc.php');

if ($superCage->server->testip('REMOTE_ADDR')) {
    $ip = $superCage->server->getRaw('REMOTE_ADDR');
} else {
    $ip = 'Unknown';
}

if (!USER_ID) {
    if ($CONFIG['log_mode'] == CPG_LOG_ALL) {
        log_write("Logout attempt failed because visitor is not logged in.", CPG_SECURITY_LOG);
    }
    cpg_die(ERROR, $lang_logout_php['err_not_logged_in'], __FILE__, __LINE__);
}

if ($CONFIG['log_mode'] == CPG_LOG_ALL) {
    log_write('The user ' . $USER_DATA['user_name'] . ' (user ID ' . $USER_DATA['user_id'] . ") logged out.", CPG_ACCESS_LOG);
}

if (defined('UDB_INTEGRATION')) {
    $cpg_udb->logout_page();
}

cpgRedirectPage($CPG_REFERER, $lang_logout_php['logout'], sprintf($lang_logout_php['bye'], stripslashes(USER_NAME)), 3);

?>