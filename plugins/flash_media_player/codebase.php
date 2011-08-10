<?php
/**************************************************
  Coppermine 1.5.x Plugin - Flash Media Player
  *************************************************
  Copyright (c) 2009 eenemeenemuu
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('plugin_install', 'fmp_install');
$thisplugin->add_action('plugin_uninstall', 'fmp_uninstall');
$thisplugin->add_action('plugin_cleanup', 'fmp_cleanup');

$thisplugin->add_filter('html_other_media','fmp_other_media');
$thisplugin->add_action('page_start','fmp_page_start');

if ($CONFIG['thumbnail_to_fullsize'] == 1) {
    $thisplugin->add_filter('fullsize_html','fmp_fullsize');
    $thisplugin->add_filter('theme_display_thumbnails_params','fmp_fullsize_thumbnail_params');
}


function fmp_get_html($CURRENT_PIC_DATA, $check_only = false) {
    if (in_array($CURRENT_PIC_DATA['extension'], array('flv', 'mp4', 'mp3', 'aac'))) {
        if ($check_only == true) {
            return true;
        }

        global $CONFIG, $USER;
        $CURRENT_PIC_DATA['pheight'] += 24;
        $thumb = get_pic_url($CURRENT_PIC_DATA, 'thumb');
        if (file_exists($normal = str_replace($CONFIG['thumb_pfx'], $CONFIG['normal_pfx'], $thumb))) {
            $thumb = $normal;
        }

        $file = $CONFIG['ecards_more_pic_target'].get_pic_url($CURRENT_PIC_DATA, 'fullsize');

        // Support for external files
        if ($CURRENT_PIC_DATA['filesize'] < 256) {
            $file_content = file_get_contents($CONFIG['fullpath'].$CURRENT_PIC_DATA['filepath'].$CURRENT_PIC_DATA['filename']);
            preg_match('/^(http|ftp)s?:\/\/.*\.'.$CURRENT_PIC_DATA['extension'].'$/i', $file_content, $matches);
            if (count($matches)) {
                $file = strip_tags($matches[0]);
            }
        }

        $autostart = $CONFIG['media_autostart'] == 1 ? "1" : "0";

        $theme = $USER['theme'] ? $USER['theme'] : $CONFIG['theme'];
        $stylesheet = file_get_contents("themes/{$theme}/style.css");
        preg_match_all('/\.tableh2.*{(.*)}/Us', $stylesheet, $matches);
        $style = array();
        foreach($matches[1] as $value) {
            $split = explode(";", $value);
            foreach($split as $value2) {
                $split2 = explode(":", $value2);
                if (isset($split2[0]) && isset($split2[1])) {
                    $style[trim($split2[0])] = trim($split2[1]);
                }
            }
        }

        $player = "plugins/flash_media_player/player.swf";
        $player .= "?file=$file";
        $player .= "&image=$thumb";
        $player .= "&autostart=$autostart";
        $player .= "&backcolor={$style['background']}";
        $player .= "&frontcolor={$style['color']}";
        $player .= "&lightcolor={$style['color']}";

        // Use skin if available
        if ($handle = opendir('plugins/flash_media_player/')) {
            $skins = array();
            while (false !== ($file = readdir($handle))) {
                if ($file != 'player.swf' && stripos($file, '.swf') || stripos($file, '.zip')) {
                    $skins[] = $file;
                }
            }
            closedir($handle);
            if (count($skins) == 1) {
                $player .= "&skin=plugins/flash_media_player/".$skins[0];
            }
        }

        $pic_html = <<< EOT
            <object type="{$CURRENT_PIC_DATA['mime']}" width="{$CURRENT_PIC_DATA['pwidth']}" height="{$CURRENT_PIC_DATA['pheight']}" data="$player">
            <param name="movie" value="$player" />
            <param name="allowfullscreen" value="true" />
            <param name="wmode" value="opaque" />
            </object>
EOT;
        return $pic_html;
    } else {
        return false;
    }
}


function fmp_other_media($pic_html) {
    global $CURRENT_PIC_DATA;
    if (fmp_get_html($CURRENT_PIC_DATA, true)) {
        $pic_html = fmp_get_html($CURRENT_PIC_DATA);
    }
    return $pic_html;
}


function fmp_fullsize($html) {
    global $CONFIG, $FORBIDDEN_SET, $pid;

    $sql = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p WHERE pid='$pid' $FORBIDDEN_SET";
    $result = cpg_db_query($sql);
    if (!mysql_num_rows($result)) {
        cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
    }
    $CURRENT_PIC_DATA = mysql_fetch_assoc($result);

    $mime_content = cpg_get_type($CURRENT_PIC_DATA['filename']);
    $CURRENT_PIC_DATA['extension'] = $mime_content['extension'];

    if ($CURRENT_PIC_DATA['pwidth']==0 || $CURRENT_PIC_DATA['pheight']==0) {
        $resize_method = $CONFIG['picture_use'] == "thumb" ? ($CONFIG['thumb_use'] == "ex" ? "any" : $CONFIG['thumb_use']) : $CONFIG['picture_use'];
        if ($resize_method == 'ht') {
            $pwidth = $CONFIG['picture_width']*4/3;
            $pheight = $CONFIG['picture_width'];
        } else { 
            $pwidth = $CONFIG['picture_width'];
            $pheight = $CONFIG['picture_width']*3/4;
        }

        $CURRENT_PIC_DATA['pwidth']  = $pwidth; // Default width

        // Set default height; if file is a movie
        if ($mime_content['content']=='movie') {
            $CURRENT_PIC_DATA['pheight'] = $pheight; // Default height
        }
    }

    if ($pic_html = fmp_get_html($CURRENT_PIC_DATA)) {
        $html = preg_replace('/<body style="margin:0px; padding:0px; background-color: gray;">(.*)<\/body>/Usi', '<body style="margin:0px; padding:0px; background-color: gray;">'.$pic_html.'</body>', $html);
    }

    return $html;
}


function fmp_fullsize_thumbnail_params($data) {
    preg_match('/alt="(.*)"/Ui', $data['{THUMB}'], $match_alt);
    $mime_content = cpg_get_type($match_alt[1]);

    if (fmp_get_html($mime_content, true)) {
        global $CONFIG;

        preg_match('/pid=([0-9]+)/i', $data['{LINK_TGT}'], $match_pid);
        $pid = $match_pid[1];

        $sql = "SELECT pwidth, pheight FROM {$CONFIG['TABLE_PICTURES']} WHERE pid='$pid'";
        $result = cpg_db_query($sql);
        $CURRENT_PIC_DATA = mysql_fetch_assoc($result);

        if ($CURRENT_PIC_DATA['pwidth']==0 || $CURRENT_PIC_DATA['pheight']==0) {
            $resize_method = $CONFIG['picture_use'] == "thumb" ? ($CONFIG['thumb_use'] == "ex" ? "any" : $CONFIG['thumb_use']) : $CONFIG['picture_use'];
            if ($resize_method == 'ht') {
                $pwidth = $CONFIG['picture_width']*4/3;
                $pheight = $CONFIG['picture_width'];
            } else { 
                $pwidth = $CONFIG['picture_width'];
                $pheight = $CONFIG['picture_width']*3/4;
            }

            $CURRENT_PIC_DATA['pwidth']  = $pwidth; // Default width

            // Set default height; if file is a movie
            if ($mime_content['content']=='movie') {
                $CURRENT_PIC_DATA['pheight'] = $pheight; // Default height
            }
        }

        $new_height = ceil($CURRENT_PIC_DATA['pheight'] + $CONFIG['fullsize_padding_y'] + 24);
        $new_width = ceil($CURRENT_PIC_DATA['pwidth'] + $CONFIG['fullsize_padding_x']);

        $data['{LINK_TGT}'] = preg_replace('/width=([0-9]+),height=([0-9]+)/i', 'width='.$new_width.',height='.$new_height, $data['{LINK_TGT}']);
    }

    return $data;
}


function fmp_update_filetype($extension, $type) {
    global $CONFIG;
    if (!mysql_result(cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_FILETYPES']} WHERE extension = '$extension'"), 0)) {
        cpg_db_query("INSERT INTO {$CONFIG['TABLE_FILETYPES']} (extension,mime,content,player) VALUES ('$extension', 'application/x-shockwave-flash', '$type', 'SWF')");
    } else {
        cpg_db_query("UPDATE {$CONFIG['TABLE_FILETYPES']} SET mime = 'application/x-shockwave-flash', player = 'SWF' WHERE extension = '$extension'");
    }

    if ($type == "movie") {
        $config_value = "allowed_mov_types";
    } elseif ($type == "audio") {
        $config_value = "allowed_snd_types";
    }
    if (strpos($CONFIG[$config_value], $extension) === FALSE) {
        cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = CONCAT(value, '/$extension') WHERE name = '$config_value'");
    }
    return;
}


function fmp_reset_filetype($extension, $mime) {
    global $CONFIG;
    if (substr_count($mime, 'video') > 0) {
        $config_value = "allowed_mov_types";
    } elseif (substr_count($mime, 'audio') > 0) {
        $config_value = "allowed_snd_types";
    }
    $CONFIG[$config_value] = str_replace('/'.$extension, '', $CONFIG[$config_value]);
    $CONFIG[$config_value] = str_replace($extension.'/', '', $CONFIG[$config_value]);
    $CONFIG[$config_value] = str_replace($extension, '', $CONFIG[$config_value]);
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '{$CONFIG[$config_value]}' WHERE name = '$config_value'");
    cpg_db_query("UPDATE {$CONFIG['TABLE_FILETYPES']} SET mime = '$mime', player = 'WMP' WHERE extension = '$extension'");
}


function fmp_install() {
    fmp_update_filetype('flv', 'movie');
    fmp_update_filetype('mp4', 'movie');
    fmp_update_filetype('mp3', 'audio');
    fmp_update_filetype('aac', 'audio');
    return true;
}


function fmp_uninstall() {
    $superCage = Inspekt::makeSuperCage();

    if (!$superCage->post->keyExists('drop')) {
        return 1;
    }

    if (!checkFormToken()) {
        global $lang_errors;
        cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
    }

    if ($superCage->post->getInt('drop') == 1) {
        fmp_reset_filetype('flv', 'video/x-flv');
        fmp_reset_filetype('mp4', 'video/mp4');
        fmp_reset_filetype('mp3', 'audio/mpeg3');
        fmp_reset_filetype('aac', 'audio/aac');
        return true;
    }
}


function fmp_cleanup($action) {
    $superCage = Inspekt::makeSuperCage();
    $cleanup = $superCage->server->getEscaped('REQUEST_URI');
    if ($action == 1) {
        global $CONFIG, $lang_common;

        require_once "./plugins/flash_media_player/lang/english.php";
        if ($CONFIG['lang'] != 'english' && file_exists("./plugins/flash_media_player/lang/{$CONFIG['lang']}.php")) {
            require_once "./plugins/flash_media_player/lang/{$CONFIG['lang']}.php";
        }

        list($timestamp, $form_token) = getFormToken();
        $button_array = array('cancel' => cpg_fetch_icon('leftleft', 2), 'continue' => cpg_fetch_icon('rightright', 2));
        echo <<< EOT
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="tableb">
                        {$lang_plugin_flash_media_player['uninstall_info']}!
                    </td>
                    <td class="tableb">
                        <form action="pluginmgr.php" method="post">
                            <button type="submit" class="button" name="cancel" value="{$lang_common['back']}">{$button_array['cancel']}{$lang_common['back']}</button>
                        </form>
                    </td>
                    <td class="tableb">
                        <form action="{$cleanup}" method="post">
                            <input type="hidden" name="drop" value="1" />
                            <input type="hidden" name="form_token" value="{$form_token}" />
                            <input type="hidden" name="timestamp" value="{$timestamp}" />
                            <button type="submit" class="button" name="submit" value="{$lang_common['continue']}">{$button_array['continue']}{$lang_common['continue']}</button>
                        </form>
                    </td>
                </tr>
            </table>
EOT;
    }
}

?>
