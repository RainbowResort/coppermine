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

$name = 'Flash Media Player';
$description = 'Use <a href="http://www.longtailvideo.com/players/jw-flv-player/" rel="external" class="external">JW Media Player</a> to play flv, mp4, mp3 &amp; aac files. Consider the <a href="http://creativecommons.org/licenses/by-nc-sa/3.0/" class="external">noncommercial license</a>!';
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>';
$version = '1.3';
$extra_info = $install_info = '<a href="http://forum.coppermine-gallery.net/index.php/topic,62704.0.html" rel="external" class="admin_menu">'.cpg_fetch_icon('announcement', 1).'Announcement thread for '.$name.' plugin</a><br />';
$install_info .= ' This plugin will configure coppermine to allow the upload of flash files and the other files that it supports. This will of course have an impact on you as admin as well as for your registered users! To determine the type of files you can upload in coppermine, go to coppermine\'s config and edit &quot;File settings&quot; &rarr; &quot;Allowed movie types &quot; / &quot;Allowed audio types &quot; accordingly.';
$extra_info .= '<div><span class="detail_head_collapsed">Details</span><div class="detail_body">';

$extra_info .= 'Your gallery is configured to allow the upload of the following movie file types:<ul>';
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
$extra_info .= 'Your gallery is configured to allow the upload of the following sound file types:<ul>';
$allowed_sound_types = explode('/', $CONFIG['allowed_snd_types']);
foreach ($allowed_sound_types as $key) {
	if (in_array($key, $supported_extensions) == TRUE) {
		$extra_info .= '<li><strong>'.$key.'</strong> ' . cpg_fetch_icon('ok', 0) . '</li>' . $LINEBREAK;
	} else {
		$extra_info .= '<li>'.$key.'</li>' . $LINEBREAK;
	}
}
$extra_info .= '</ul>' . $LINEBREAK;
$extra_info .= 'The JS Media player will take care of the files highlighted' . $LINEBREAK;
$extra_info .= '<div class="cpg_message_info">To determine the type of files you can upload in coppermine, go to coppermine\'s config and edit &quot;File settings&quot; &rarr; &quot;Allowed movie types &quot; / &quot;Allowed audio types &quot; accordingly.</div>';
$extra_info .= '</div></div>';
?>
