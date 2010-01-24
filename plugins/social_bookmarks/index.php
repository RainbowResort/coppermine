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
echo <<< EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="{$lang_text_dir}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$CONFIG['charset']}" />
<meta http-equiv="Pragma" content="no-cache" />
<title>{$lang_plugin_social_bookmarks['menu_title']}</title>
<link rel="stylesheet" href="css/coppermine.css" type="text/css" />
<link rel="stylesheet" href="themes/classic/style.css" type="text/css" />
<link rel="stylesheet" href="plugins/social_bookmarks/style.css" type="text/css" />
</head>
<body>
<div id="cpg_main_block">
EOT;
echo social_bookmarks_content();
echo <<< EOT
</div>
</body>
</html>
EOT;
die;
?>