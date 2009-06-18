<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/
/*********************************************
  Coppermine Plugin - Embed External Videos
  ********************************************
  Copyright (c) 2009 eenemeenemuu
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('plugin_install','embed_external_videos_install');
$thisplugin->add_action('plugin_uninstall','embed_external_videos_uninstall');

$thisplugin->add_filter('html_other_media','embed_external_videos_other_media');


function embed_external_videos_install_helper($filetype) {
    global $CONFIG;
    if (!isset($CONFIG[$name])) {
        cpg_db_query("INSERT INTO {$CONFIG['TABLE_CONFIG']} (name,value) VALUES ('embed_external_videos_{$filetype}','0')");
    }
    if (mysql_result(cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_FILETYPES']} WHERE extension = '{$filetype}'"),0) == "0") {
        cpg_db_query("INSERT INTO {$CONFIG['TABLE_FILETYPES']} (extension,mime,content,player) VALUES ('{$filetype}','application/x-shockwave-flash','movie','SWF')");
    } 
    if (strpos($CONFIG['allowed_mov_types'], $filetype) === FALSE) {
        cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '{$CONFIG['allowed_mov_types']}/{$filetype}' WHERE name = 'allowed_mov_types'");
    }
    return true;
}


function embed_external_videos_install() {
    embed_external_videos_install_helper('youtube');

    return true;
}


function embed_external_videos_uninstall_helper($filetype) {
    global $CONFIG;
    $allowed_mov_types = str_replace("/{$filetype}", '', $CONFIG['allowed_mov_types']);
    $allowed_mov_types = str_replace("{$filetype}/", '', $allowed_mov_types);
    $allowed_mov_types = str_replace("{$filetype}", '', $allowed_mov_types);
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$allowed_mov_types' WHERE name = 'allowed_mov_types'");
    cpg_db_query("DELETE FROM {$CONFIG['TABLE_FILETYPES']} WHERE extension = '{$filetype}'");

    return true;
}


function embed_external_videos_uninstall() {
    global $CONFIG;
    cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name LIKE 'embed_external_videos_%'");
    embed_external_videos_uninstall_helper('youtube');

    return true;
}


function embed_external_videos_other_media($pic_html) {
    global $CURRENT_PIC_DATA;

    if ($CURRENT_PIC_DATA['extension'] == "youtube") {
        $youtube_file_content = file_get_contents($CURRENT_PIC_DATA['url']);
        $youtube_check_result = preg_match("/http:\/\/www.youtube.com\/watch\?v=([A-Za-z0-9_-]{11})/", $youtube_file_content, $youtube_video_id);
        if ($youtube_check_result == "1" ) {
            $new_html = "<embed type=\"application/x-shockwave-flash\" allowfullscreen=\"true\" width=\"640\" height=\"385\" src=\"http://www.youtube.com/v/{$youtube_video_id[1]}&hl=de&fs=1\" />";
        } else {
            $new_html = "Error: no valid youtube video id";
        }
        $search = '(<object.*</object>)';
        $pic_html = preg_replace($search, $new_html, $pic_html);
    }

    return $pic_html;
}


?>
