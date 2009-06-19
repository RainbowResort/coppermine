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


function embed_external_videos_install() {
    global $CONFIG;
    cpg_db_query("ALTER TABLE {$CONFIG['TABLE_FILETYPES']} MODIFY extension CHAR(10)");

    return true;
}


function embed_external_videos_uninstall() {
    global $CONFIG;
    foreach(embed_external_videos_get_hoster() as $filetype => $value) {
        $CONFIG['allowed_mov_types'] = str_replace("/{$filetype}", '', $CONFIG['allowed_mov_types']);
        $CONFIG['allowed_mov_types'] = str_replace("{$filetype}/", '', $CONFIG['allowed_mov_types']);
        $CONFIG['allowed_mov_types'] = str_replace("{$filetype}", '', $CONFIG['allowed_mov_types']);
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_FILETYPES']} WHERE extension = '{$filetype}'");
    }
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '{$CONFIG['allowed_mov_types']}' WHERE name = 'allowed_mov_types'");

    return true;
}


function embed_external_videos_get_hoster() {
    $hoster = array(
        'youtube' => 'YouTube',
        'myvideo' => 'MyVideo',
        'vimeo' => 'Vimeo',
        'yahoo' => 'Yahoo! Video',
        'metacafe' => 'Metacafe',
        'google' => 'Google Video',
        'myspace' => 'Myspace Video',
    );
    asort($hoster);

    return $hoster;
}


function embed_external_videos_get_width_height($pid, $what = FALSE) {
    if ($what != FALSE) {
        global $CONFIG;
        $result = cpg_db_query("SELECT $what FROM {$CONFIG['TABLE_PICTURES']} WHERE pid = '{$pid}'");
        return mysql_result($result, 0);
    }
}


function embed_external_videos_other_media($pic_html) {
    global $CURRENT_PIC_DATA;
    switch($CURRENT_PIC_DATA['extension']) {

        case 'youtube':
            $check_result = preg_match("/http:\/\/www.youtube.com\/watch\?v=([A-Za-z0-9_-]{11})/", file_get_contents($CURRENT_PIC_DATA['url']), $video_id);
            if ($check_result == "1" ) {
                $pheight = embed_external_videos_get_width_height($CURRENT_PIC_DATA['pid'], 'pheight');
                $pwidth = embed_external_videos_get_width_height($CURRENT_PIC_DATA['pid'], 'pwidth');
                if (pwidth == 0 || $pheight == 0) {
                    $pwidth = 640;
                    $pheight = 385;
                }
                $movie = "http://www.youtube.com/v/{$video_id[1]}";
                $new_html  = "<object type=\"{$CURRENT_PIC_DATA['mime']}\" width=\"{$pwidth}\" height=\"{$pheight}\" data=\"{$movie}\">";
                $new_html .= "<param name=\"movie\" value=\"{$movie}\" />";
                $new_html .= "<param name=\"allowfullscreen\" value=\"true\" />";
                $new_html .= "</object>";                         
            } else {
                $new_html = "Error: no valid YouTube video id";
            }
            $search = '(<object.*</object>)';
            $pic_html = preg_replace($search, $new_html, $pic_html);
            
            return $pic_html;
        break;


        case 'myvideo':
            $check_result = preg_match("/http:\/\/www.myvideo.de\/watch\/([0-9]+)\//", file_get_contents($CURRENT_PIC_DATA['url']), $video_id);
            if ($check_result == "1" ) {
                $pheight = embed_external_videos_get_width_height($CURRENT_PIC_DATA['pid'], 'pheight');
                $pwidth = embed_external_videos_get_width_height($CURRENT_PIC_DATA['pid'], 'pwidth');
                if (pwidth == 0 || $pheight == 0) {
                    $pwidth = 613;
                    $pheight = 383;
                }
                $movie = "http://www.myvideo.de/movie/{$video_id[1]}";
                $new_html  = "<object type=\"{$CURRENT_PIC_DATA['mime']}\" width=\"{$pwidth}\" height=\"{$pheight}\" data=\"{$movie}\">";
                $new_html .= "<param name=\"movie\" value=\"{$movie}\" />";
                $new_html .= "<param name=\"allowfullscreen\" value=\"true\" />";
                $new_html .= "</object>";                         
            } else {
                $new_html = "Error: no valid MyVideo video id";
            }
            $search = '(<object.*</object>)';
            $pic_html = preg_replace($search, $new_html, $pic_html);
            
            return $pic_html;
        break;


        case 'vimeo':
            $check_result = preg_match("/http:\/\/www.vimeo.com\/([0-9]+)/", file_get_contents($CURRENT_PIC_DATA['url']), $video_id);
            if ($check_result == "1" ) {
                $pheight = embed_external_videos_get_width_height($CURRENT_PIC_DATA['pid'], 'pheight');
                $pwidth = embed_external_videos_get_width_height($CURRENT_PIC_DATA['pid'], 'pwidth');
                if (pwidth == 0 || $pheight == 0) {
                    $pwidth = 640;
                    $pheight = 360;
                }
                $movie = "http://vimeo.com/moogaloop.swf?clip_id={$video_id[1]}";
                $new_html  = "<object type=\"{$CURRENT_PIC_DATA['mime']}\" width=\"{$pwidth}\" height=\"{$pheight}\" data=\"{$movie}\">";
                $new_html .= "<param name=\"movie\" value=\"{$movie}\" />";
                $new_html .= "<param name=\"allowfullscreen\" value=\"true\" />";
                $new_html .= "</object>";                         
            } else {
                $new_html = "Error: no valid Vimeo video id";
            }
            $search = '(<object.*</object>)';
            $pic_html = preg_replace($search, $new_html, $pic_html);
            
            return $pic_html;
        break;


        case 'yahoo':
            $check_result = preg_match("/http:\/\/video.yahoo.com\/watch\/([0-9]+)\/([0-9]+)/", file_get_contents($CURRENT_PIC_DATA['url']), $video_id);
            if ($check_result == "1" ) {
                $pheight = embed_external_videos_get_width_height($CURRENT_PIC_DATA['pid'], 'pheight');
                $pwidth = embed_external_videos_get_width_height($CURRENT_PIC_DATA['pid'], 'pwidth');
                if (pwidth == 0 || $pheight == 0) {
                    $pwidth = 576;
                    $pheight = 357;
                }
                $movie = "http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.40";
                //$thumburl = "&thumbUrl="; //2do!
                $new_html  = "<object type=\"{$CURRENT_PIC_DATA['mime']}\" width=\"{$pwidth}\" height=\"{$pheight}\" data=\"{$movie}\">";
                $new_html .= "<param name=\"movie\" value=\"{$movie}\" />";
                $new_html .= "<param name=\"allowfullscreen\" value=\"true\" />";
                $new_html .= "<param name=\"flashVars\" value=\"id={$video_id[2]}&vid={$video_id[1]}{$thumburl}\" />";
                $new_html .= "</object>";                         
            } else {
                $new_html = "Error: no valid Yahoo! video id";
            }
            $search = '(<object.*</object>)';
            $pic_html = preg_replace($search, $new_html, $pic_html);
            
            return $pic_html;
        break;


        case 'metacafe':
            $check_result = preg_match("/http:\/\/www.metacafe.com\/watch\/([0-9]+)\/([a-z0-9_-])/", file_get_contents($CURRENT_PIC_DATA['url']), $video_id);
            if ($check_result == "1" ) {
                $pheight = embed_external_videos_get_width_height($CURRENT_PIC_DATA['pid'], 'pheight');
                $pwidth = embed_external_videos_get_width_height($CURRENT_PIC_DATA['pid'], 'pwidth');
                if (pwidth == 0 || $pheight == 0) {
                    $pwidth = 565;
                    $pheight = 458;
                }
                $movie = "http://www.metacafe.com/fplayer/{$video_id[1]}/{$video_id[2]}.swf";
                $new_html  = "<object type=\"{$CURRENT_PIC_DATA['mime']}\" width=\"{$pwidth}\" height=\"{$pheight}\" data=\"{$movie}\">";
                $new_html .= "<param name=\"movie\" value=\"{$movie}\" />";
                $new_html .= "<param name=\"allowfullscreen\" value=\"true\" />";
                $new_html .= "</object>";                         
            } else {
                $new_html = "Error: no valid Metacafe video id";
            }
            $search = '(<object.*</object>)';
            $pic_html = preg_replace($search, $new_html, $pic_html);
            
            return $pic_html;
        break;


        case 'google':
            $file_content = file_get_contents($CURRENT_PIC_DATA['url']);
            $check_result = preg_match("/http:\/\/video.google.com\/videoplay\?docid=([0-9]+)/", $file_content, $video_id);

            if ($check_result == "1" ) {
                $pheight = embed_external_videos_get_width_height($CURRENT_PIC_DATA['pid'], 'pheight');
                $pwidth = embed_external_videos_get_width_height($CURRENT_PIC_DATA['pid'], 'pwidth');
                if (pwidth == 0 || $pheight == 0) {
                    $pwidth = 640;
                    $pheight = 385;
                }
                $movie = "http://video.google.com/googleplayer.swf?docid={$video_id[1]}";
                $new_html  = "<object type=\"{$CURRENT_PIC_DATA['mime']}\" width=\"{$pwidth}\" height=\"{$pheight}\" data=\"{$movie}\">";
                $new_html .= "<param name=\"movie\" value=\"{$movie}\" />";
                $new_html .= "<param name=\"allowfullscreen\" value=\"true\" />";
                $new_html .= "</object>";                         
            } else {
                $new_html = "Error: no valid Google video id";
            }
            $search = '(<object.*</object>)';
            $pic_html = preg_replace($search, $new_html, $pic_html);
            
            return $pic_html;
        break;


        case 'myspace':
            $file_content = file_get_contents($CURRENT_PIC_DATA['url']);
            $check_result = preg_match("/http:\/\/vids.myspace.com\/index.cfm\?fuseaction=vids.individual&videoid=([0-9]+)/", $file_content, $video_id);

            if ($check_result == "1" ) {
                $pheight = embed_external_videos_get_width_height($CURRENT_PIC_DATA['pid'], 'pheight');
                $pwidth = embed_external_videos_get_width_height($CURRENT_PIC_DATA['pid'], 'pwidth');
                if (pwidth == 0 || $pheight == 0) {
                    $pwidth = 640;
                    $pheight = 400;
                }
                $movie = "http://mediaservices.myspace.com/services/media/embed.aspx/m={$video_id[1]}";
                $new_html  = "<object type=\"{$CURRENT_PIC_DATA['mime']}\" width=\"{$pwidth}\" height=\"{$pheight}\" data=\"{$movie}\">";
                $new_html .= "<param name=\"movie\" value=\"{$movie}\" />";
                $new_html .= "<param name=\"allowfullscreen\" value=\"true\" />";
                $new_html .= "</object>";                         
            } else {
                $new_html = "Error: no valid Myspace video id";
            }
            $search = '(<object.*</object>)';
            $pic_html = preg_replace($search, $new_html, $pic_html);
            
            return $pic_html;
        break;


/*
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
    * SevenLoad.de
    * ClipFish
    * Stickam
    * FreeVideoBlog (now Vidiac)
    * StreetFire
    * DropShots
    * Bofunk
    * Virb.com
    * TED.com
    * DailyMotion.com    
*/    
            
        default: return $pic_html;
    }
    return $pic_html;
}


?>
