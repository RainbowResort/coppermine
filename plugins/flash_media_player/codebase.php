<?php
/**************************************************
  Coppermine 1.5.x Plugin - Flash Media Player
  *************************************************
  Copyright (c) 2009 eenemeenemuu
  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/flash_movie_player/codebase.php $
  $Revision: 6888 $
  $LastChangedBy: gaugau $
  $Date: 2009-12-21 13:55:20 +0100 (Mo, 21 Dez 2009) $
**************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('plugin_install', 'fmp_install');
$thisplugin->add_action('plugin_uninstall', 'fmp_uninstall');
$thisplugin->add_action('plugin_cleanup', 'fmp_cleanup');

$thisplugin->add_filter('html_other_media','fmp_other_media');
$thisplugin->add_action('page_start','fmp_page_start');


function fmp_get_html($CURRENT_PIC_DATA) {
    if (in_array($CURRENT_PIC_DATA['extension'], Array('flv', 'mp4', 'mp3', 'aac'))) {
        global $CONFIG, $USER;
        $CURRENT_PIC_DATA['pheight'] += 20;
        $thumb = get_pic_url($CURRENT_PIC_DATA, 'thumb');
        $file = $CONFIG['ecards_more_pic_target'].get_pic_url($CURRENT_PIC_DATA, 'fullsize');

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

        $pic_html = <<< EOT
            <object type="{$CURRENT_PIC_DATA['mime']}" width="{$CURRENT_PIC_DATA['pwidth']}" height="{$CURRENT_PIC_DATA['pheight']}" data="$player">
            <param name="movie" value="$player" />
            <param name="allowfullscreen" value="true" />
            <param name="wmode" value="opaque" />
            </object>
EOT;
        if ($CURRENT_PIC_DATA['popup'] != true) {
            list($timestamp, $form_token) = getFormToken();
            $link = "displayimage.php?fmp={$CURRENT_PIC_DATA['pid']}&amp;form_token=$form_token&amp;timestamp=$timestamp";
            $pic_html .= <<< EOT
            <script type="text/javascript">
                function popup(url,target,w,h) {
                    var args = 'width='+w+',height='+h+',left=10,top=10,resizable';
                    ok = window.open(url,target,args);
                    ok.focus();
                    if (ok) return false;
                    else return true;
                }
                </script>
            <br />
            <a href="$link" onclick="javascript: return popup('$link', 'fmp' + Math.random(), {$CURRENT_PIC_DATA['pwidth']} + {$CONFIG['fullsize_padding_x']}, {$CURRENT_PIC_DATA['pheight']} + {$CONFIG['fullsize_padding_y']})">Popup <img src="images/link.gif" border="0" /></a>
EOT;
        }
    }
    return $pic_html;
}


function fmp_other_media($pic_html) {
    global $CURRENT_PIC_DATA;
    if (fmp_get_html($CURRENT_PIC_DATA)) {
        $pic_html = fmp_get_html($CURRENT_PIC_DATA);
    }
    return $pic_html;
}


function fmp_page_start() {
    $superCage = Inspekt::makeSuperCage();
    if ($superCage->get->testInt('fmp')) {
        // Disable permanent direct access 
        if (!checkFormToken()) {
            global $lang_errors;
            cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
        }

        global $CONFIG;
        // TODO: check access rights
        $CURRENT_PIC_DATA = mysql_fetch_assoc(cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} WHERE pid = ".$superCage->get->getInt('fmp')));

        // File does not exist or access denied
        if (!$CURRENT_PIC_DATA) {
            global $lang_errors;
            cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
        }

        $path_parts = pathinfo($CURRENT_PIC_DATA['filename']);
        $CURRENT_PIC_DATA['extension'] = $path_parts['extension'];
        $CURRENT_PIC_DATA['popup'] = true;
        if ($CURRENT_PIC_DATA['pwidth']==0 || $CURRENT_PIC_DATA['pheight']==0) {
            $CURRENT_PIC_DATA['pwidth']  = 320;
            $CURRENT_PIC_DATA['pheight'] = 240;
        }
        echo fmp_get_html($CURRENT_PIC_DATA);
        exit;
    }
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
    if (strpos($CONFIG[$config_value], '$extension') === FALSE) {
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
        global $lang_common;
        list($timestamp, $form_token) = getFormToken();
		$button_array = array('cancel' => cpg_fetch_icon('leftleft', 2), 'continue' => cpg_fetch_icon('rightright', 2));
        echo <<< EOT
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="tableb">
                        Playback of existing flv files won't work anymore!
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
