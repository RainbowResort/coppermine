<?php
/**************************************************
  Coppermine 1.5.x Plugin - absolute_url
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

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_filter('picture_url', 'absolute_url_picture_url');

function absolute_url_picture_url($pic_row) {
    global $CONFIG;
    if (stripos($pic_row['url'], $CONFIG['fullpath']) === 0) {
        $prefix = $CONFIG['plugin_absolute_url_url'] ? $CONFIG['plugin_absolute_url_url'] : $CONFIG['ecards_more_pic_target'];
    } else {
        $prefix = '';
    }
    $pic_row['url'] = $prefix.$pic_row['url'];
    return $pic_row;
}

?>