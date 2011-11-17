<?php
/**************************************************
  Coppermine 1.5.x plugin - More meta albums
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

require "./plugins/more_meta_albums/lang/english.php";
if ($CONFIG['lang'] != 'english' && file_exists("./plugins/more_meta_albums/lang/{$CONFIG['lang']}.php")) {
    require "./plugins/more_meta_albums/lang/{$CONFIG['lang']}.php";
}

$name = $lang_plugin_more_meta_albums['more_meta_albums'];
$description = $lang_plugin_more_meta_albums['description'];
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>';
$version = '1.7';
$plugin_cpg_version = array('min' => '1.5');
$extra_info = $install_info = '<a href="http://forum.coppermine-gallery.net/index.php/topic,63706.0.html" rel="external" class="admin_menu">'.cpg_fetch_icon('announcement', 1).$lang_plugin_more_meta_albums['announcement_thread'].'</a>';

?>
