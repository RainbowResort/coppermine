<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/
/*********************************************
  Coppermine Plugin - File Replacer
  ********************************************
  Created by Nibbler for cpg1.4.x - ported to cpg1.5.x by eenemeenemuu 
**********************************************/

require_once "./plugins/file_replacer/lang/english.php";
if ($CONFIG['lang'] != 'english' && file_exists("./plugins/file_replacer/lang/{$CONFIG['lang']}.php")) {
    require_once "./plugins/file_replacer/lang/{$CONFIG['lang']}.php";
}

$name = $lang_plugin_file_replacer['file_replacer'];
$description = $lang_plugin_file_replacer['description'];
$author = sprintf($lang_plugin_file_replacer['author'], '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=941" rel="external" class="external">Nibbler</a>', '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>');
$version = '1.3';
$extra_info = $install_info = '<a href="http://forum.coppermine-gallery.net/index.php/topic,60499.0.html" rel="external" class="admin_menu">'.cpg_fetch_icon('announcement', 1).$lang_plugin_file_replacer['announcement_thread'].'</a>';

?>
