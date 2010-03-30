<?php
/**************************************************
  Coppermine 1.5.x Plugin - Daylight saving time
  *************************************************
  Copyright (c) 2010 $lang_plugin_dst
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$lang_plugin_dst $
  $Date$
**************************************************/

require_once "./plugins/dst/lang/english.php";
if ($CONFIG['lang'] != 'english' && file_exists("./plugins/dst/lang/{$CONFIG['lang']}.php")) {
    require_once "./plugins/dst/lang/{$CONFIG['lang']}.php";
}

$name = $lang_plugin_dst['dst'];
$description = $lang_plugin_dst['description'];
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>';
$version = '1.0';
$plugin_cpg_version = array('min' => '1.5');
$extra_info = $install_info = '<a href="http://forum.coppermine-gallery.net/index.php/topic,64308.0.html" rel="external" class="admin_menu">'.cpg_fetch_icon('announcement', 1).$lang_plugin_dst['announcement_thread'].'</a>';
?>