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
  Coppermine Plugin - Remote Videos
  ********************************************
  Copyright (c) 2009 eenemeenemuu
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('plugin_install','remote_videos_install');
$thisplugin->add_action('plugin_uninstall','remote_videos_uninstall');
$thisplugin->add_filter('html_other_media','remote_videos_other_media');


function remote_videos_install() {
    global $CONFIG;
    cpg_db_query("ALTER TABLE {$CONFIG['TABLE_FILETYPES']} MODIFY extension CHAR(11)");

    return true;
}


function remote_videos_uninstall() {
    global $CONFIG;
    foreach(remote_videos_get_hoster() as $filetype => $value) {
        $CONFIG['allowed_mov_types'] = str_replace("/{$filetype}", '', $CONFIG['allowed_mov_types']);
        $CONFIG['allowed_mov_types'] = str_replace("{$filetype}/", '', $CONFIG['allowed_mov_types']);
        $CONFIG['allowed_mov_types'] = str_replace("{$filetype}", '', $CONFIG['allowed_mov_types']);
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_FILETYPES']} WHERE extension = '{$filetype}'");
    }
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '{$CONFIG['allowed_mov_types']}' WHERE name = 'allowed_mov_types'");

    return true;
}


function remote_videos_get_hoster() {
    $hoster = array(
        'youtube'     => 'YouTube',
        'myvideo'     => 'MyVideo',
        'vimeo'       => 'Vimeo',
        'yahoo'       => 'Yahoo! Video',
        'metacafe'    => 'Metacafe',
        'google'      => 'Google Video',
        'myspace'     => 'Myspace Video',
        'sevenload'   => 'SevenLoad.de',
        'clipfish'    => 'ClipFish',
        'dailymotion' => 'Dailymotion',
    );
    asort($hoster);

    return $hoster;
}


function remote_videos_html_replace($params, $pic_html) {
    global $CONFIG, $CURRENT_PIC_DATA;
    $check_result = preg_match($params['search_pattern'], file_get_contents($CURRENT_PIC_DATA['url']), $video_id);
    if ($check_result == "1") {
        $row = mysql_fetch_array(cpg_db_query("SELECT pwidth, pheight FROM {$CONFIG['TABLE_PICTURES']} WHERE pid = '{$CURRENT_PIC_DATA['pid']}'"), MYSQL_ASSOC);
        $pwidth = $row['pwidth'];
        $pheight = $row['pheight'];
        if ($pwidth == 0 || $pheight == 0) {
            $pwidth = $params['default_width'];
            $pheight = $params['default_height'];
        }
        $params['player'] = str_replace("{MATCH_1}", $video_id[1], $params['player']);
        $params['player'] = str_replace("{MATCH_2}", $video_id[2], $params['player']);
        $params['player'] = str_replace("{WIDTH}", $pwidth, $params['player']);
        $params['player'] = str_replace("{HEIGHT}", $pheight, $params['player']);
        $new_html  = "<object type=\"{$CURRENT_PIC_DATA['mime']}\" width=\"{$pwidth}\" height=\"{$pheight}\" data=\"{$params['player']}\">";
        $new_html .= "<param name=\"movie\" value=\"{$params['player']}\" />";
        $new_html .= "<param name=\"allowfullscreen\" value=\"true\" />";
        if (isset($params['extra_params'])) {
            $params['extra_params'] = str_replace("{MATCH_1}", $video_id[1], $params['extra_params']);
            $params['extra_params'] = str_replace("{MATCH_2}", $video_id[2], $params['extra_params']);
            $params['extra_params'] = str_replace("{THUMBURL}", "&thumbUrl=", $params['extra_params']); // 2do!
            $new_html .= $params['extra_params'];
        }
        $new_html .= "</object>";                         
    } else {
        $new_html = "Error: invalid video id";
    }
    $search = '(<object.*</object>)';
    $pic_html = preg_replace($search, $new_html, $pic_html);
    return $pic_html;
}


function remote_videos_other_media($pic_html) {
    global $CURRENT_PIC_DATA;
    switch($CURRENT_PIC_DATA['extension']) {

        case 'youtube':
            $params = array(
                'search_pattern' => '/http:\/\/www.youtube.com\/watch\?v=([A-Za-z0-9_-]{11})/',
                'default_width'  => 640,
                'default_height' => 385,
                'player'         => 'http://www.youtube.com/v/{MATCH_1}',
            );
            return remote_videos_html_replace($params, $pic_html);
        break;

        case 'myvideo':
            $params = array(
                'search_pattern' => '/http:\/\/www.myvideo.de\/watch\/([0-9]+)\//',
                'default_width'  => 613,
                'default_height' => 383,
                'player'         => 'http://www.myvideo.de/movie/{MATCH_1}',
            );
            return remote_videos_html_replace($params, $pic_html);
        break;

        case 'vimeo':
            $params = array(
                'search_pattern' => '/http:\/\/www.vimeo.com\/([0-9]+)/',
                'default_width'  => 640,
                'default_height' => 360,
                'player'         => 'http://vimeo.com/moogaloop.swf?clip_id={MATCH_1}',
            );
            return remote_videos_html_replace($params, $pic_html);
        break;

        case 'yahoo':
            $params = array(
                'search_pattern' => '/http:\/\/video.yahoo.com\/watch\/([0-9]+)\/([0-9]+)/',
                'default_width'  => 576,
                'default_height' => 357,
                'player'         => 'http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.40',
                'extra_params'   => '<param name="flashVars" value="id={MATCH_2}&vid={MATCH_1}{THUMBURL}" />',
            );
            return remote_videos_html_replace($params, $pic_html);
        break;

        case 'metacafe':
            $params = array(
                'search_pattern' => '/http:\/\/www.metacafe.com\/watch\/([0-9]+)\/([a-z0-9_-])/',
                'default_width'  => 565,
                'default_height' => 458,
                'player'         => 'http://www.metacafe.com/fplayer/{MATCH_1}/{MATCH_2}.swf',
            );
            return remote_videos_html_replace($params, $pic_html);
        break;

        case 'google':
            $params = array(
                'search_pattern' => '/http:\/\/video.google.com\/videoplay\?docid=([0-9]+)/',
                'default_width'  => 640,
                'default_height' => 385,
                'player'         => 'http://video.google.com/googleplayer.swf?docid={MATCH_1}',
            );
            return remote_videos_html_replace($params, $pic_html);
        break;

        case 'myspace':
            $params = array(
                'search_pattern' => '/http:\/\/vids.myspace.com\/index.cfm\?fuseaction=vids.individual&videoid=([0-9]+)/',
                'default_width'  => 640,
                'default_height' => 400,
                'player'         => 'http://mediaservices.myspace.com/services/media/embed.aspx/m={MATCH_1}',
            );
            return remote_videos_html_replace($params, $pic_html);
        break;

         case 'sevenload':
            $params = array(
                'search_pattern' => '/http:\/\/de.sevenload.com\/videos\/([A-Za-z0-9]{7})/',
                'default_width'  => 445,
                'default_height' => 364,
                'player'         => 'http://de.sevenload.com/pl/{MATCH_1}/{WIDTH}x{HEIGHT}/swf',
            );
            return remote_videos_html_replace($params, $pic_html);
        break;    

        case 'clipfish':
            $params = array(
                'search_pattern' => '/http:\/\/www.clipfish.de\/video\/([0-9]+)/',
                'default_width'  => 464,
                'default_height' => 380,
                'player'         => 'http://www.clipfish.de/videoplayer.swf?vid={MATCH_1}&r=1',
            );
            return remote_videos_html_replace($params, $pic_html);
        break;

        case 'dailymotion':
            $params = array(
                'search_pattern' => '/http:\/\/www.dailymotion.com\/video\/([a-z0-9]{6})/',
                'default_width'  => 608,
                'default_height' => 356,
                'player'         => 'http://www.dailymotion.com/swf/{MATCH_1}',
            );
            return remote_videos_html_replace($params, $pic_html);
        break;
        


/*
        case '':
            $params = array(
                'search_pattern' => '',
                'default_width'  => ,
                'default_height' => ,
                'player'         => '{MATCH_1}',
            );
            return remote_videos_html_replace($params, $pic_html);
        break;

    2do
    * 6.cn
    * Apple trailers
    * Blip.tv
    * GameTrailers
    * MegaVideo
    * MyShows
    * iFilm (now Spike)
    * Break
    * Jumpcut
    * Current TV
    * Revver
    * College Humor
    * Stickam
    * FreeVideoBlog (now Vidiac)
    * StreetFire
    * DropShots
    * Bofunk
    * Virb.com
    * TED.com

*/    
            
        default: return $pic_html;
    }
    return $pic_html;
}


?>
