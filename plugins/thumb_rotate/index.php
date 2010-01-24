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
 
// Initialize language and icons
require_once './plugins/thumb_rotate/init.inc.php';
$thumb_rotate_init_array = thumb_rotate_initialize();
$lang_plugin_thumb_rotate = $thumb_rotate_init_array['language']; 
$thumb_rotate_icon_array = $thumb_rotate_init_array['icon'];
// Configuration
pageheader($lang_plugin_thumb_rotate['config']);
thumb_rotate_configure();
pagefooter();
die;
?>