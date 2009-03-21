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
  Coppermine Plugin - FLV Player
  ********************************************
  Copyright (c) 2009 eenemeenemuu
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('plugin_install','flv_player_install');
$thisplugin->add_action('plugin_uninstall','flv_player_uninstall');

$thisplugin->add_filter('html_other_media','flv_player_other_media');


function flv_player_install() {
    global $CONFIG;
    if (mysql_result(cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_FILETYPES']} WHERE extension = 'flv'"),0) == "0") {
        cpg_db_query("INSERT INTO {$CONFIG['TABLE_FILETYPES']} (extension,mime,content,player) VALUES ('flv','application/x-shockwave-flash','movie','SWF')");
    } else {
        cpg_db_query("UPDATE {$CONFIG['TABLE_FILETYPES']} SET mime = 'application/x-shockwave-flash', content = 'movie',player = 'SWF' WHERE extension = 'flv'");
    }
    if (strpos($CONFIG['allowed_mov_types'], 'flv') === FALSE) {
        cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '{$CONFIG['allowed_mov_types']}/flv' WHERE name = 'allowed_mov_types'");
    }
    return true;
}


function flv_player_uninstall() {
    global $CONFIG;
    $allowed_mov_types = str_replace('/flv', '', $CONFIG['allowed_mov_types']);
    $allowed_mov_types = str_replace('flv/', '', $allowed_mov_types);
    $allowed_mov_types = str_replace('flv', '', $allowed_mov_types);
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$allowed_mov_types' WHERE name = 'allowed_mov_types'");
    cpg_db_query("DELETE FROM {$CONFIG['TABLE_FILETYPES']} WHERE extension = 'flv'");

    return true;
}


function flv_player_other_media($pic_html) {
    global $CURRENT_PIC_DATA;
    if ($CURRENT_PIC_DATA['extension'] == "flv") {
        global $CONFIG;
        $CURRENT_PIC_DATA['pheight'] += 20;
        $thumb = get_pic_url($CURRENT_PIC_DATA, 'thumb');
        $file = $CONFIG['ecards_more_pic_target'].get_pic_url($CURRENT_PIC_DATA, 'fullsize');

        if ($CONFIG['media_autostart'] == 1) {
            $autostart = "true";
        } else {
            $autostart = "false";
        }
        $search = '(<object.*</object>)';
        $new_html = "<embed type=\"{$CURRENT_PIC_DATA['mime']}\" width=\"{$CURRENT_PIC_DATA['pwidth']}\" height=\"{$CURRENT_PIC_DATA['pheight']}\" allowfullscreen=\"true\" src=\"plugins/flv_player/player.swf\" flashvars=\"file=$file&image=$thumb&autostart=$autostart\" />";
        $pic_html = preg_replace($search, $new_html, $pic_html);
    }

    return $pic_html;
}


?>
