<?php
/**************************************************
  Coppermine 1.5.x Plugin - Daylight saving time
  *************************************************
  Copyright (c) 2010 eenemeenemuu
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**************************************************/

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}

require_once "./plugins/dst/lang/english.php";
if ($CONFIG['lang'] != 'english' && file_exists("./plugins/dst/lang/{$CONFIG['lang']}.php")) {
	require_once "./plugins/dst/lang/{$CONFIG['lang']}.php";
}

pageheader($lang_plugin_dst['configuration']);
dst_configure();
pagefooter();
die;
?>