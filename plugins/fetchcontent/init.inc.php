<?php
/********************************************************
  Coppermine 1.5.x plugin - FetchContent
  *******************************************************
  Copyright (c) 2010 Coppermine dev team
  *******************************************************
  This program is free software; you can redistribute 
  it and/or modify it under the terms of the GNU General
  Public License as published by the Free Software
  Foundation; either version 3 of the License, or 
  (at your option) any later version.
  *******************************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/fetchcontent/admin.php $
  $Revision: 7043 $
  $LastChangedBy: gaugau $
  $Date: 2010-01-11 19:26:53 +0100 (Mo, 11. Jan 2010) $
  *******************************************************/
  
if (!defined('IN_COPPERMINE')) { 
    die('Not in Coppermine...');
}

// Define the default language array (English)
require ("./plugins/fetchcontent/lang/english.php");
// submit your lang file for this plugin on the coppermine forums
// plugin will try to use the configured language if it is available.
if (file_exists("./plugins/fetchcontent/lang/{$CONFIG['lang']}.php")) {
    require ("./plugins/fetchcontent/lang/{$CONFIG['lang']}.php");
} 

// Determine the help file link
if (file_exists("./plugins/fetchcontent/docs/{$CONFIG['lang']}.htm")) {
    $documentation_file = $CONFIG['lang'];
} else {
    $documentation_file = 'english';
}

if ($CONFIG['enable_menu_icons'] >= 1) {
    $fetchcontent_icon_array['reset'] = '<img src="./plugins/fetchcontent/images/icons/reset.png" border="0" width="16" height="16" alt="" class="icon" />';
} else {
    $fetchcontent_icon_array['reset'] = '';
}

$fetchcontent_icon_array['submit'] = cpg_fetch_icon('ok', 1);
$fetchcontent_icon_array['announcement'] = cpg_fetch_icon('announcement', 1);
$fetchcontent_icon_array['documentation'] = cpg_fetch_icon('documentation', 1);
$fetchcontent_icon_array['config'] = cpg_fetch_icon('config', 1);


?>