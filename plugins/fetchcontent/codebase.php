<?php
/********************************************************
  Coppermine 1.5.x plugin - FetchContent
  *******************************************************
  Copyright (c) 2010 Coppermine dev team
  *******************************************************
  This program is free software; you can redistribute 
  it and/or modify it under the terms of the GNU General
  Public License as published by the Free Software
  Foundation; either version 3 of the License, or 
  (at your option) any later version.
  *******************************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  *******************************************************/

if (!defined('IN_COPPERMINE')) {
	die('Not in Coppermine...');
}

$thisplugin->add_action('plugin_install','fetchcontent_install'); // Add plugin_install action$thisplugin->add_action('plugin_uninstall','fetchcontent_uninstall'); // Add plugin_uninstall action

// install
function fetchcontent_install() {
    global $CONFIG;
    $url = parse_url($CONFIG['site_url']);
	// Add the config options for the plugin	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_fetchcontent_image_denied', '2')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_fetchcontent_check_referer', '0')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_fetchcontent_domainlist', '{$url['host']}')");
    cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_fetchcontent_enable_logging', '1')");
    cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_fetchcontent_non_image', '1')");
    cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_fetchcontent_debug', '0')");
	
    return true;
}


// uninstall and drop settings tablefunction fetchcontent_uninstall() {
    global $CONFIG;
	// Delete the plugin config records	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_fetchcontent_image_denied'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_fetchcontent_check_referer'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_fetchcontent_domainlist'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_fetchcontent_enable_logging'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_fetchcontent_non_image'");
    cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_fetchcontent_debug'");

    return true;
}

?>