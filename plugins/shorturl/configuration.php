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
  Coppermine Plugin - Short URL
  ********************************************
  Copyright (c) 2009 eenemeenemuu
**********************************************/

require "./plugins/shorturl/lang/english.php";
if ($CONFIG['lang'] != 'english' && file_exists("./plugins/shorturl/lang/{$CONFIG['lang']}.php")) {
    require "./plugins/shorturl/lang/{$CONFIG['lang']}.php";
}

$name = $lang_plugin_shorturl['plugin_name'];
$description = $lang_plugin_shorturl['description'];
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>';
$version = '1.1';

$extra_info = '
    <a href="index.php?shorturl=config" class="admin_menu">'.cpg_fetch_icon('config', 1).$name.' '.$lang_gallery_admin_menu['admin_lnk'].'</a>
    <a href="http://forum.coppermine-gallery.net/index.php/topic,62877.0.html" rel="external" class="admin_menu">'.cpg_fetch_icon('announcement', 1).$lang_plugin_shorturl['announcement_thread'].'</a>
';

$install_info = '<a href="http://forum.coppermine-gallery.net/index.php/topic,62877.0.html" rel="external" class="admin_menu">'.cpg_fetch_icon('announcement', 1).$lang_plugin_shorturl['announcement_thread'].'</a><br />'.$lang_plugin_shorturl['install_info'];

?>
