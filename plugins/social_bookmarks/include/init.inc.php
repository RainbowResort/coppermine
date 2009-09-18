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
	if (in_array('plugins/social_bookmarks/js/script.js', $JS['includes']) != TRUE) {
	    $JS['includes'][] = 'plugins/social_bookmarks/js/script.js';
	}
	
    // define some vars that need to exist in JS
    set_js_var('bookmarks_visibility', $CONFIG['plugin_social_bookmarks_visibility']);
    set_js_var('bookmarks_layout', $CONFIG['plugin_social_bookmarks_layout']);
    set_js_var('bookmarks_greyout', $CONFIG['plugin_social_bookmarks_greyout']);
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

function social_bookmarks_content() {
    global $CONFIG, $LINEBREAK, $lang_plugin_social_bookmarks, $lang_common;
    $return = '';
    $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_social_bookmarks_services WHERE service_active='YES'");
    $loopCounter = 0;
    $return_array = array();
    while ($row = mysql_fetch_assoc($result)) {
        $row['service_url'] = str_replace('{u}', urlencode($CONFIG['site_url']) , $row['service_url']);
        $row['service_url'] = str_replace('{t}', urlencode($CONFIG['gallery_name']) , $row['service_url']);
        $return_array[$loopCounter] = '';
        $return_array[$loopCounter] .= '<a href="'.$row['service_url'].'" rel="external" rel="nofollow" title="'.$row['service_name_full'].'">';
        if ($CONFIG['plugin_social_bookmarks_layout'] == 1 || $CONFIG['plugin_social_bookmarks_layout'] == 2) {
            $return_array[$loopCounter] .= '<img src="plugins/social_bookmarks/images/services/'.$row['icon_filename'].'" border="0" width="16" height="16" alt="" align="left" class="icon" />';
        }
        if ($CONFIG['plugin_social_bookmarks_layout'] == 0 || $CONFIG['plugin_social_bookmarks_layout'] == 1) {
            $return_array[$loopCounter] .= $row['service_name_short'];
        }
        $return_array[$loopCounter] .= '</a>';
        $loopCounter++;
    }
    $total_records = $loopCounter;
    if ($total_records == 0) {  // Nothing to return, as no service has been enabled in config
        if (!GALLERY_ADMIN_MODE) {
            return;
        } else {
            return $lang_plugin_social_bookmarks['no_service_activated']; 
        }
    }
    // Add favorites
    // Define HTML output wrappers
    if ($CONFIG['plugin_social_bookmarks_columns'] == 1) {
        $return_start = '<ul class="social_bookmarks_content">';
        $return_end   = '</ul>';
        $record_start = '<li class="social_bookmarks_content">';
        $record_end   = '</li>';
        // Add a close header
        if ($CONFIG['plugin_social_bookmarks_greyout'] != '1' && $CONFIG['plugin_social_bookmarks_visibility'] == '2') {
            $return .= '<div style="text-align:right;"><img src="images/icons/close.png" border="0" width="16" height="16" alt="" title="'.$lang_common['close'].'" id="social_bookmarks_close" /></div>';
        }
    } else {
        $return_start = '<table class="maintable">' . $LINEBREAK . '<tbody>';
        $return_end   = '</tbody>' . $LINEBREAK . '</table>';
        $record_start = '<td class="social_bookmarks_content">';
        $record_end   = '</td>';
        // Add a close header
        if ($CONFIG['plugin_social_bookmarks_greyout'] != '1' && $CONFIG['plugin_social_bookmarks_visibility'] == '2') {
            $return_start .= '<tr><td class="tableh1" style="text-align:right;" colspan="'.$CONFIG['plugin_social_bookmarks_columns'].'"><img src="images/icons/close.png" border="0" width="16" height="16" alt="" title="'.$lang_common['close'].'" id="social_bookmarks_close" /></td></tr>';
        }
    }
    $return .= $return_start . $LINEBREAK;
    $loopCounter = 0;
    foreach ($return_array as $service_record) {
        if ($CONFIG['plugin_social_bookmarks_columns'] != 1 && $loopCounter == 0) {
            $return .= '<tr>' . $LINEBREAK;
        }
        $return .=  $record_start . $service_record . $record_end . $LINEBREAK;
        $loopCounter++;
        if ($CONFIG['plugin_social_bookmarks_columns'] != 1 && $loopCounter == $CONFIG['plugin_social_bookmarks_columns']) {
            $return .= '</tr>' . $LINEBREAK;
            $loopCounter = 0;
        }
    }
    if ($CONFIG['plugin_social_bookmarks_columns'] != 1 && $loopCounter < $CONFIG['plugin_social_bookmarks_columns']) {
        // Add the missing table cells form well-formedness
        for ($i = $loopCounter; $i < $CONFIG['plugin_social_bookmarks_columns']; $i++) {
            $return .= $record_start . ' ' . $record_end . $LINEBREAK;
        }
        $return .= '</tr>' . $LINEBREAK;
    }
    $return .= $return_end . $LINEBREAK;
    // Add a closing link
    //'<table border="0"><tr><td>content</td><td style="text-align:right;vertical-align:top">close</td></tr></table>'
    return $return;
}
?>