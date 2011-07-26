<?php
/**************************************************
  Coppermine 1.5.x Plugin - thumbnail_class
  *************************************************
  Copyright (c) 2011 eenemeenemuu
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


$thisplugin->add_filter('page_html', 'thumbnail_class_page_html');

function thumbnail_class_page_html($html) {
    global $CONFIG;

    if (strpos($html, $CONFIG['thumb_pfx'])) {
        $html = preg_replace('/(<img src=".*'.$CONFIG['thumb_pfx'].'.*" class="image)/U', '\\1 thumb', $html);
    }

    return $html;
}

?>