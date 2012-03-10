<?php
/**************************************************
  Coppermine 1.5.x Plugin - Hot pictures
  *************************************************
  Copyright (c) 2012 eenemeenemuu
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/hot_pictures/configuration.php $
  $Revision: 7804 $
  $LastChangedBy: timoswelt $
  $Date: 2010-07-31 19:08:54 +0200 (Sa, 31 Jul 2010) $
**************************************************/

require_once "./plugins/hot_pictures/lang/english.php";
if ($CONFIG['lang'] != 'english' && file_exists("./plugins/hot_pictures/lang/{$CONFIG['lang']}.php")) {
    require_once "./plugins/hot_pictures/lang/{$CONFIG['lang']}.php";
}

$name = $lang_plugin_hot_pictures['hot_pictures'];
$description = $lang_plugin_hot_pictures['description'];
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>';
$version = '1.0';
$plugin_cpg_version = array('min' => '1.5');
$extra_info = $install_info = '<a href="http://forum.coppermine-gallery.net/index.php/topic,TODO.0.html" rel="external" class="admin_menu">'.cpg_fetch_icon('announcement', 1).$lang_plugin_hot_pictures['announcement_thread'].'</a>';

?>
