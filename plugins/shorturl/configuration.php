<?php
/**************************************************
  Coppermine 1.5.x Plugin - ShortURL
  *************************************************
  Copyright (c) 2009-2010 eenemeenemuu
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

require "./plugins/shorturl/lang/english.php";
if ($CONFIG['lang'] != 'english' && file_exists("./plugins/shorturl/lang/{$CONFIG['lang']}.php")) {
    require "./plugins/shorturl/lang/{$CONFIG['lang']}.php";
}

$name = $lang_plugin_shorturl['plugin_name'];
$description = $lang_plugin_shorturl['description'];
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>';
$version = '1.3';
$plugin_cpg_version = array('min' => '1.5');
$extra_info = '
    <a href="index.php?shorturl=config" class="admin_menu">'.cpg_fetch_icon('config', 1).$name.' '.$lang_gallery_admin_menu['admin_lnk'].'</a>
    <a href="http://forum.coppermine-gallery.net/index.php/topic,62877.0.html" rel="external" class="admin_menu">'.cpg_fetch_icon('announcement', 1).$lang_plugin_shorturl['announcement_thread'].'</a>
';

$install_info = '<a href="http://forum.coppermine-gallery.net/index.php/topic,62877.0.html" rel="external" class="admin_menu">'.cpg_fetch_icon('announcement', 1).$lang_plugin_shorturl['announcement_thread'].'</a><br />'.$lang_plugin_shorturl['install_info'];

?>
