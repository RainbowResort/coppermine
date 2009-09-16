<?php
/********************************************
  social_bookmarks plugin for cpg1.5.x
  *******************************************
  Copyright (c) 2003-2009 Coppermine Dev Team

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.x
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/mass_import/codebase.php $
  $Revision: 6497 $
  $LastChangedBy: gaugau $
  $Date: 2009-08-19 18:54:16 +0200 (Mi, 19. Aug 2009) $
**********************************************/

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}
// Initialize language and icons
require_once './plugins/social_bookmarks/include/init.inc.php';
$social_bookmarks_init_array = social_bookmarks_initialize();
$lang_plugin_social_bookmarks = $social_bookmarks_init_array['language']; 
$social_bookmarks_icon_array = $social_bookmarks_init_array['icon'];
// Configuration
pageheader($lang_plugin_social_bookmarks['config']);
echo 'Nothing there yet - under constructions';
pagefooter();
die;
?>