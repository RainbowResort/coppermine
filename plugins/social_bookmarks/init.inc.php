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

function social_bookmarks_initialize() {
    global $CONFIG, $JS, $lang_plugin_social_bookmarks, $social_bookmarks_icon_array;
    $superCage = Inspekt::makeSuperCage();
    if (in_array('js/jquery.spinbutton.js', $JS['includes']) != TRUE) {
        $JS['includes'][] = 'js/jquery.spinbutton.js';
    }
    if (in_array('plugins/social_bookmarks/script.js', $JS['includes']) != TRUE) {
        $JS['includes'][] = 'plugins/social_bookmarks/script.js';
    }
    
    require_once "./plugins/social_bookmarks/lang/english.php";
    if ($CONFIG['lang'] != 'english' && file_exists("./plugins/social_bookmarks/lang/{$CONFIG['lang']}.php")) {
        require_once "./plugins/social_bookmarks/lang/{$CONFIG['lang']}.php";
    }
    
    if ($CONFIG['enable_menu_icons'] >= 1) {
        $social_bookmarks_icon_array['configure'] = '<img src="./plugins/social_bookmarks/images/icons/configure.png" border="0" width="16" height="16" alt="" class="icon" />';
        $social_bookmarks_icon_array['menu'] = '<img src="./plugins/social_bookmarks/images/icons/social_bookmarks.png" border="0" width="16" height="16" alt="" class="icon" />';
    } else {
        $social_bookmarks_icon_array['configure'] = '';
        $social_bookmarks_icon_array['menu'] = '';
    }
    if ($CONFIG['enable_menu_icons'] == 2) {
        $social_bookmarks_icon_array['page'] = '<img src="./plugins/social_bookmarks/images/icons/social_bookmarks.png" border="0" width="16" height="16" alt="" class="icon" />';
    } else {
        $social_bookmarks_icon_array['page'] = '';
    }
    $social_bookmarks_icon_array['announcement'] = cpg_fetch_icon('announcement', 1);
    $social_bookmarks_icon_array['ok'] = cpg_fetch_icon('ok', 0);
    $social_bookmarks_icon_array['cancel'] = cpg_fetch_icon('cancel', 0);
    $social_bookmarks_icon_array['stop'] = cpg_fetch_icon('stop', 0);
    $return['language'] = $lang_plugin_social_bookmarks;
    $return['icon'] = $social_bookmarks_icon_array;
    return $return;
}

function social_bookmarks_content() {
    global $CONFIG, $LINEBREAK, $USER, $lang_plugin_social_bookmarks, $lang_common, $socialBookmarks_title;
    $return = '';
    $loopCounter = 0;
    $return_array = array();
    if ($CONFIG['plugin_social_bookmarks_smart_language'] == '1') { 
        // Determine the visistor's language
        $result = cpg_db_query("SELECT flag, abbr FROM {$CONFIG['TABLE_LANGUAGE']} WHERE lang_id='{$USER['lang']}' LIMIT 1");
        list($user_flag, $user_abbr) = mysql_fetch_row($result);
        mysql_free_result($result);
        if ($user_abbr != '') {
            $user_flag = $user_abbr;
        }
    }
    // Query the services
    $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_social_bookmarks_services WHERE service_active='YES'");
    while ($row = mysql_fetch_assoc($result)) {
        $row['service_url'] = str_replace('{u}', urlencode(social_bookmarks_pagelink()) , $row['service_url']);
        $row['service_url'] = str_replace('{t}', urlencode($socialBookmarks_title) , $row['service_url']);
        unset($service_language);
        $service_language = explode('|', $row['service_lang']);
        if ($CONFIG['plugin_social_bookmarks_smart_language'] != '1' || (in_array($user_flag, $service_language) == TRUE || in_array('multi', $service_language) == TRUE)) {
            $return_array[$loopCounter] = '';
            $return_array[$loopCounter] .= '<a href="'.$row['service_url'].'" rel="external nofollow" title="'.$row['service_name_full'].'">';
            if ($CONFIG['plugin_social_bookmarks_layout'] == 1 || $CONFIG['plugin_social_bookmarks_layout'] == 2) {
                $return_array[$loopCounter] .= '<img src="plugins/social_bookmarks/images/services/'.$row['icon_filename'].'" border="0" width="16" height="16" alt="" align="left" class="icon" />';
            }
            if ($CONFIG['plugin_social_bookmarks_layout'] == 0 || $CONFIG['plugin_social_bookmarks_layout'] == 1) {
                $return_array[$loopCounter] .= $row['service_name_short'];
            }
            $return_array[$loopCounter] .= '</a>';
        }
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
        if ($CONFIG['plugin_social_bookmarks_position'] == '2' || $CONFIG['plugin_social_bookmarks_position'] == '3') {
            $return_start = '<table class="maintable" width="100%">' . $LINEBREAK . '<tbody>';
        } else {
            $return_start = '<table class="maintable">' . $LINEBREAK . '<tbody>';
        }
        $return_start = '<table class="maintable">' . $LINEBREAK . '<tbody>';
        $return_end   = '</tbody>' . $LINEBREAK . '</table>';
        $record_start = '<td class="social_bookmarks_content">';
        $record_end   = '</td>';
        // Add a close header
        if ($CONFIG['plugin_social_bookmarks_greyout'] != '1' && $CONFIG['plugin_social_bookmarks_visibility'] == '2' && ($CONFIG['plugin_social_bookmarks_position'] == '2' || $CONFIG['plugin_social_bookmarks_position'] == '3')) {
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
    return $return;
}

function social_bookmarks_pagelink() {
    global $CONFIG, $CPG_PHP_SELF;
    $allowed_filenames =      array('contact.php', 
                                    'displayecard.php', 
                                    'displayimage.php', 
                                    'displayreport.php', 
                                    'ecard.php', 
                                    'export.php',
                                    'index.php',
                                    'login.php',
                                    'register.php',
                                    'report_file.php',
                                    'upload.php',
                                    'xp_publish.php',
                               );
    $forbidden_parameters =   array('message_id',
                                    'form_token',
                                    'timestamp',
                                    'user_id',
                                    'referer',
                                    'lang',
                                    'theme',
                                     );
    if (in_array($CPG_PHP_SELF, $allowed_filenames) == TRUE) {
        $return = $CONFIG['site_url'] . rtrim(cpgGetScriptNameParams($forbidden_parameters), '&');
    } else {
        $return = $CONFIG['site_url'] . 'index.php';
    }
    return $return;
}
?>