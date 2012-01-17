<?php
/**************************************************
  Coppermine 1.5.x Plugin - keyboard_navigation
  *************************************************
  Copyright (c) 2009-2012 eenemeenemuu
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

if (defined('DISPLAYIMAGE_PHP')) {
    $thisplugin->add_action('page_start', 'keyboard_navigation_displayimage');
}

if (defined('THUMBNAILS_PHP')) {
    $thisplugin->add_action('page_start', 'keyboard_navigation_thumbnails');
}

function keyboard_navigation_displayimage() {
    js_include('plugins/keyboard_navigation/keydown_displayimage.js');
}

function keyboard_navigation_thumbnails() {
    js_include('plugins/keyboard_navigation/keydown_thumbnails.js');
}

?>
