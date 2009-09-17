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
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/social_bookmarks/codebase.php $
  $Revision: 6497 $
  $LastChangedBy: gaugau $
  $Date: 2009-08-19 18:54:16 +0200 (Mi, 19. Aug 2009) $
**********************************************/

if (!defined('IN_COPPERMINE')) {
	die('Not in Coppermine...');
}

function social_bookmarks_initialize() {
	global $CONFIG, $JS, $lang_plugin_social_bookmarks, $social_bookmarks_icon_array;
	$superCage = Inspekt::makeSuperCage();
	if (in_array('js/jquery.spinbutton.js', $JS['includes']) != TRUE) {
		$JS['includes'][] = 'js/jquery.spinbutton.js';
	}
	$JS['includes'][] = 'plugins/social_bookmarks/js/script.js';
	
    // define some vars that need to exist in JS
    set_js_var('bookmarks_visibility', $CONFIG['plugin_social_bookmarks_visibility']);
    if ($CONFIG['plugin_social_bookmarks_favorites'] != '0') {
        set_js_var('lang_add_to_favorites', $lang_plugin_social_bookmarks['add_to_favorites']);
    }
    set_js_var('bookmarks_content', social_bookmarks_content());
   
	
	require_once "./plugins/social_bookmarks/lang/english.php";
	if ($CONFIG['lang'] != 'english' && file_exists("./plugins/social_bookmarks/lang/{$CONFIG['lang']}.php")) {
	    require_once "./plugins/social_bookmarks/lang/{$CONFIG['lang']}.php";
	}
	
	if ($CONFIG['enable_menu_icons'] >= 1) {
	    $social_bookmarks_icon_array['announcement'] = '<img src="./plugins/social_bookmarks/images/icons/announcement.png" border="0" width="16" height="16" alt="" class="icon" />';
	} else {
	    $social_bookmarks_icon_array['announcement'] = '';
	}
	if ($CONFIG['enable_menu_icons'] == 2) {
	} else {
	}
	$social_bookmarks_icon_array['ok'] = cpg_fetch_icon('ok', 0);
	$social_bookmarks_icon_array['cancel'] = cpg_fetch_icon('cancel', 0);
	$social_bookmarks_icon_array['stop'] = cpg_fetch_icon('stop', 0);
	$social_bookmarks_icon_array['configure'] = cpg_fetch_icon('config', 1);
	$return['language'] = $lang_plugin_social_bookmarks;
	$return['icon'] = $social_bookmarks_icon_array;
	return $return;
}
?>