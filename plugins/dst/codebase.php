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

$thisplugin->add_action('page_start','dst_start');

function dst_start() {
    global $CONFIG, $CPG_PHP_SELF, $lang_admin_php, $lang_date;

    if ($CPG_PHP_SELF != 'admin.php') {
        $CONFIG['time_offset']++;
    } else {
        $lang_admin_php['time_offset_detail'] = str_replace('%s', localised_date(time() + 3600, $lang_date['comment']), $lang_admin_php['time_offset_detail']);
    }
}

?>