<?php
/**************************************************
  Coppermine 1.5.x Plugin - FLV Player
  *************************************************
  Copyright (c) 2009 eenemeenemuu
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

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('plugin_install','flv_player_install');
$thisplugin->add_action('plugin_uninstall','flv_player_uninstall');
$thisplugin->add_action('plugin_cleanup','flv_player_cleanup');

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
    $superCage = Inspekt::makeSuperCage();

    if (!$superCage->post->keyExists('drop')) {
        return 1;
    }

    if (!checkFormToken()) {
        global $lang_errors;
        cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
    }

    if ($superCage->post->getInt('drop') == 1) {
        global $CONFIG;
        $allowed_mov_types = str_replace('/flv', '', $CONFIG['allowed_mov_types']);
        $allowed_mov_types = str_replace('flv/', '', $allowed_mov_types);
        $allowed_mov_types = str_replace('flv', '', $allowed_mov_types);
        cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$allowed_mov_types' WHERE name = 'allowed_mov_types'");
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_FILETYPES']} WHERE extension = 'flv'");

        return true;
    }
}


function flv_player_cleanup($action) {
    $superCage = Inspekt::makeSuperCage();
    $cleanup = $superCage->server->getEscaped('REQUEST_URI');
    if ($action == 1) {
        global $lang_common;
        list($timestamp, $form_token) = getFormToken();
        echo <<< EOT
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="tableb">
                        Playback of existing flv files won't work anymore!
                    </td>
                    <td class="tableb">
                        <form action="pluginmgr.php" method="post">
                            <input type="submit" name="submit" value="{$lang_common['back']}" class="button" />
                        </form>
                    </td>
                    <td class="tableb">
                        <form action="{$cleanup}" method="post">
                            <input type="hidden" name="drop" value="1" />
                            <input type="hidden" name="form_token" value="{$form_token}" />
                            <input type="hidden" name="timestamp" value="{$timestamp}" />
                            <input type="submit" name="submit" value="{$lang_common['continue']}" class="button" />
                        </form>
                    </td>
                </tr>
            </table>
EOT;
    }
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

        $pic_html  = "<object type=\"{$CURRENT_PIC_DATA['mime']}\" width=\"{$CURRENT_PIC_DATA['pwidth']}\" height=\"{$CURRENT_PIC_DATA['pheight']}\" data=\"plugins/flv_player/player.swf?file=$file&image=$thumb&autostart=$autostart\">";
        $pic_html .= "<param name=\"movie\" value=\"plugins/flv_player/player.swf?file=$file&image=$thumb&autostart=$autostart\" />";
        $pic_html .= "<param name=\"allowfullscreen\" value=\"true\" />";
        $pic_html .= "</object>";
    }
    return $pic_html;
}


?>
