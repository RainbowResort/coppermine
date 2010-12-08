<?php
/**************************************************
  Coppermine 1.5.x Plugin - filename2tooltip
  *************************************************
  Copyright (c) 2010 Timos-Welt (www.timos-welt.de)
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

$thisplugin->add_filter('thumb_html_title', 'modify_title');
$thisplugin->add_filter('thumb_strip_html_title', 'modify_title');

function modify_title($row_data) {
    if ($row_data[1]['title']) {
        return array($row_data[1]['title']);
    } else {
        return array($row_data[1]['filename']);
    }
}


?>