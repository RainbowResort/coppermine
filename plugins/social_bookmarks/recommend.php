<?php
/**************************************************
  Coppermine 1.5.x Plugin - social_bookmarks
  *************************************************
  Copyright (c) 2003-2009 Coppermine Dev Team
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

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}
// Initialize language and icons
require_once './plugins/social_bookmarks/init.inc.php';
$social_bookmarks_init_array = social_bookmarks_initialize();
$lang_plugin_social_bookmarks = $social_bookmarks_init_array['language']; 
$social_bookmarks_icon_array = $social_bookmarks_init_array['icon'];
pageheader('Under construction');
echo theme_display_bar($row['relevance'], 10, 100, 'lightsteelblue', '', '', 'lightsteelblue', '');
pagefooter();
die;
?>