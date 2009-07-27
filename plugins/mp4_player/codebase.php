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
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/
/*********************************************
  Coppermine Plugin - MP4 Player
  ********************************************
  Copyright (c) 2009 eenemeenemuu
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('plugin_install','mp4_player_install');
$thisplugin->add_action('plugin_uninstall','mp4_player_uninstall');
$thisplugin->add_action('plugin_cleanup','mp4_player_cleanup');

$thisplugin->add_filter('html_other_media','mp4_player_other_media');


function mp4_player_install() {
    global $CONFIG;
    if (mysql_result(cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_FILETYPES']} WHERE extension = 'mp4'"),0) == "0") {
        cpg_db_query("INSERT INTO {$CONFIG['TABLE_FILETYPES']} (extension,mime,content,player) VALUES ('mp4','application/x-shockwave-flash','movie','SWF')");
    } else {
        cpg_db_query("UPDATE {$CONFIG['TABLE_FILETYPES']} SET mime = 'application/x-shockwave-flash', content = 'movie',player = 'SWF' WHERE extension = 'mp4'");
    }
    if (strpos($CONFIG['allowed_mov_types'], 'mp4') === FALSE) {
        cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '{$CONFIG['allowed_mov_types']}/mp4' WHERE name = 'allowed_mov_types'");
    }
    return true;
}


function mp4_player_uninstall() {
    $superCage = Inspekt::makeSuperCage();

    if (!$superCage->post->keyExists('drop')) {
        return 1;
    }

    if ($superCage->post->getInt('drop') == 1) {
        global $CONFIG;
        $allowed_mov_types = str_replace('/mp4', '', $CONFIG['allowed_mov_types']);
        $allowed_mov_types = str_replace('mp4/', '', $allowed_mov_types);
        $allowed_mov_types = str_replace('mp4', '', $allowed_mov_types);
        cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$allowed_mov_types' WHERE name = 'allowed_mov_types'");
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_FILETYPES']} WHERE extension = 'mp4'");

        return true;
    }
}


function mp4_player_cleanup($action) {
    $superCage = Inspekt::makeSuperCage();
    $cleanup = $superCage->server->getEscaped('REQUEST_URI');
    if ($action == 1) {
        global $lang_common;
        echo <<< EOT
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="tableb">
                        Playback of existing mp4 files won't work anymore!
                    </td>
                    <td class="tableb">
                        <form action="pluginmgr.php" method="post">
                            <input type="submit" name="submit" value="{$lang_common['back']}" class="button" />
                        </form>
                    </td>
                    <td class="tableb">
                        <form action="{$cleanup}" method="post">
                            <input type="hidden" name="drop" value="1" />
                            <input type="submit" name="submit" value="{$lang_common['continue']}" class="button" />
                        </form>
                    </td>
                </tr>
            </table>
EOT;
    }
}


function mp4_player_other_media($pic_html) {
    global $CURRENT_PIC_DATA;
    if ($CURRENT_PIC_DATA['extension'] == "mp4") {
        global $CONFIG;
        $CURRENT_PIC_DATA['pheight'] += 20;
        $thumb = get_pic_url($CURRENT_PIC_DATA, 'thumb');
        $file = $CONFIG['ecards_more_pic_target'].get_pic_url($CURRENT_PIC_DATA, 'fullsize');

        if ($CONFIG['media_autostart'] == 1) {
            $autostart = "true";
        } else {
            $autostart = "false";
        }

        $pic_html  = "<object type=\"{$CURRENT_PIC_DATA['mime']}\" width=\"{$CURRENT_PIC_DATA['pwidth']}\" height=\"{$CURRENT_PIC_DATA['pheight']}\" data=\"plugins/mp4_player/player.swf?file=$file&image=$thumb&autostart=$autostart\">";
        $pic_html .= "<param name=\"movie\" value=\"plugins/mp4_player/player.swf?file=$file&image=$thumb&autostart=$autostart\" />";
        $pic_html .= "<param name=\"allowfullscreen\" value=\"true\" />";
        $pic_html .= "</object>";
    }
    return $pic_html;
}


?>
