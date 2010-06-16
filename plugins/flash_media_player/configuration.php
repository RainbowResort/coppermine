<?php
/**************************************************
  Coppermine 1.5.x Plugin - Flash Media Player
  *************************************************
  Copyright (c) 2009 eenemeenemuu
  *************************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**************************************************/

require_once "./plugins/flash_media_player/lang/english.php";
if ($CONFIG['lang'] != 'english' && file_exists("./plugins/flash_media_player/lang/{$CONFIG['lang']}.php")) {
    require_once "./plugins/flash_media_player/lang/{$CONFIG['lang']}.php";
}

$name = 'Flash Media Player';
$description = sprintf($lang_plugin_flash_media_player['description'], '<a href="http://www.longtailvideo.com/players/jw-flv-player/" rel="external" class="external">JW Media Player</a>');
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>';
$version = '1.6';
$plugin_cpg_version = array('min' => '1.5');
$extra_info = $install_info = '<a href="http://forum.coppermine-gallery.net/index.php/topic,62704.0.html" rel="external" class="admin_menu">'.cpg_fetch_icon('announcement', 1).$lang_plugin_flash_media_player['announcement_thread'].'</a><br />';
$install_info .= $lang_plugin_flash_media_player['install_info'];
$extra_info .= '<div><span class="detail_head_collapsed">'.$lang_plugin_flash_media_player['details'].'</span><div class="detail_body">';

$extra_info .= $lang_plugin_flash_media_player['extra_info_movie'].':<ul>';
$supported_extensions = array('flv', 'mp4', 'mp3', 'aac');
$allowed_mov_types = explode('/', $CONFIG['allowed_mov_types']);
foreach ($allowed_mov_types as $key) {
    if (in_array($key, $supported_extensions) == TRUE) {
        $extra_info .= '<li><strong>'.$key.'</strong> ' . cpg_fetch_icon('ok', 0) . '</li>' . $LINEBREAK;
    } else {
        $extra_info .= '<li>'.$key.'</li>' . $LINEBREAK;
    }
}
$extra_info .= '</ul>';
$extra_info .= $lang_plugin_flash_media_player['extra_info_sound'].':<ul>';
$allowed_sound_types = explode('/', $CONFIG['allowed_snd_types']);
foreach ($allowed_sound_types as $key) {
    if (in_array($key, $supported_extensions) == TRUE) {
        $extra_info .= '<li><strong>'.$key.'</strong> ' . cpg_fetch_icon('ok', 0) . '</li>' . $LINEBREAK;
    } else {
        $extra_info .= '<li>'.$key.'</li>' . $LINEBREAK;
    }
}
$extra_info .= '</ul>' . $LINEBREAK;
$extra_info .= $lang_plugin_flash_media_player['extra_info_highlighted'] . $LINEBREAK;
$extra_info .= '<div class="cpg_message_info">'.$lang_plugin_flash_media_player['extra_info_message_box'].'</div>';
$extra_info .= '</div></div>';
?>
