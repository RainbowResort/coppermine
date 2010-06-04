<?php
/**************************************************
  Coppermine 1.5.x Plugin - thumb_rotate
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
  
require_once './plugins/thumb_rotate/init.inc.php';
$thumb_rotate_init_array = thumb_rotate_initialize();
$lang_plugin_thumb_rotate = $thumb_rotate_init_array['language']; 
$thumb_rotate_icon_array = $thumb_rotate_init_array['icon'];

$name = $lang_plugin_thumb_rotate['config_name'];
$description = $lang_plugin_thumb_rotate['config_description'] . '<br />' . $lang_plugin_thumb_rotate['config_details'];

$author = sprintf($lang_plugin_thumb_rotate['author'],
    '<a href="http://www.timos-welt.de" rel="external" class="external">Timos-Welt</a>',
    '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=2" rel="external" class="external">Joachim Müller</a>',
    '<a href="http://acko.net/dev/farbtastic/" rel="external" class="external">Steven Wittens</a>');
    
$version = '2.1';
$plugin_cpg_version = array('min' => '1.5');
$extra_info = <<<EOT
    {$lang_plugin_thumb_rotate['resources_warning']}<br />
    <a href="index.php?file=thumb_rotate/index" class="admin_menu">{$thumb_rotate_icon_array['config']}{$lang_plugin_thumb_rotate['config']}</a>&nbsp;
    <a href="http://forum.coppermine-gallery.net/index.php/topic,57468.0.html" title="&laquo;{$lang_plugin_thumb_rotate['config_name']}&raquo; - {$lang_plugin_thumb_rotate['announcement_thread']}" class="admin_menu">{$thumb_rotate_icon_array['announcement']}{$lang_plugin_thumb_rotate['announcement_thread']}</a>
EOT;

$install_info = <<<EOT
   <a href="javascript:;" onclick="MM_openBrWindow('plugins/thumb_rotate/images/screenshot.jpg','','scrollbars=yes,toolbar=no,status=no,resizable=yes,width=750,height=650')"><img src="plugins/thumb_rotate/images/thumb_screenshot.jpg" border="0" width="128" height="85" alt="" align="right" style="padding-left:10px;" /></a>
   {$lang_plugin_thumb_rotate['minimum requirements_summary']}<br />
   {$lang_plugin_thumb_rotate['resources_warning']}<br />&nbsp;<br />
   <a href="http://forum.coppermine-gallery.net/index.php/topic,57468.0.html" title="&laquo;{$lang_plugin_thumb_rotate['config_name']}&raquo; - {$lang_plugin_thumb_rotate['announcement_thread']}" class="admin_menu">{$thumb_rotate_icon_array['announcement']}{$lang_plugin_thumb_rotate['announcement_thread']}</a>
EOT;
?>