<?php
/**************************************************
  Coppermine Plugin - Display Fields
  *************************************************
  Copyright (c) 2006 Paul Van Rompay
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
***************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

// submit your lang file for this plugin on the coppermine forums
// plugin will try to use the configured language if it is available.

global $CONFIG;

if (file_exists("plugins/display_fields/lang/{$CONFIG['lang']}.php")) {
  require "plugins/display_fields/lang/{$CONFIG['lang']}.php";
} else require 'plugins/display_fields/lang/english.php';

// pull in current values
$result = cpg_db_query("SELECT name, value FROM {$CONFIG['TABLE_CONFIG']} where name REGEXP '^plugin_displayfields_'");
$params = cpg_db_fetch_rowset($result);
mysql_free_result($result);
foreach($params as $param) {
	if ($param['name'] != 'plugin_displayfields_adminshowall') {
		$plugin_displayfields_params[$param['name']] = $param['value'];
	}
}

?>