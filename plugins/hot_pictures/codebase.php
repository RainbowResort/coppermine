<?php
/**************************************************
  Coppermine 1.5.x Plugin - Hot pictures
  *************************************************
  Copyright (c) 2012 eenemeenemuu
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


// Configuration
function hot_pictures_button_array() {
    $buttons = array(1, 2, 3);
    return $buttons;
}


// Buttons
$thisplugin->add_filter('file_data', 'hot_pictures_file_data');
function hot_pictures_file_data($data) {
    if (USER_ID) {
        global $CURRENT_PIC_DATA, $lang_plugin_hot_pictures;
        $superCage = Inspekt::makeSuperCage();

        $buttons = "
            <style>
                .hotbutton, .hotbutton:link, .hotbutton:hover, .hotbutton:visited, .hotbutton:active {
                    padding: 10px;
                    border: solid 1px black;
                    color: black;
                    text-decoration: none;
                }
            </style>
            &nbsp;<br />
            <a href=\"index.php?file=hot_pictures/set&amp;pid={$CURRENT_PIC_DATA['pid']}&amp;hot=0\" class=\"hotbutton\" style=\"background: #ccc;{$set[0]}\">{$lang_plugin_hot_pictures['hot0']}</a>
        ";
        foreach (hot_pictures_button_array() as $days) {
            if ($days < 1) {
                continue;
            }
            // TODO: calculate color
            $style = "background: #f88;";
            if ($superCage->get->keyExists('set') && $superCage->get->getInt('set') == $days) {
                $style .= " border-width: 3px;";
            }
            $text = $days == 1 ? $lang_plugin_hot_pictures['hot1'] : sprintf($lang_plugin_hot_pictures['hotx'], $days);
            $buttons .= "<a href=\"index.php?file=hot_pictures/set&amp;pid={$CURRENT_PIC_DATA['pid']}&amp;hot={$days}\" class=\"hotbutton\" style=\"{$style}\">$text</a> ";
        }
        $buttons .= "<br />&nbsp";

        $data['footer'] .= $buttons;
    }

    return $data;
}


// Meta album titles
$thisplugin->add_action('page_start', 'hot_pictures_start');
function hot_pictures_start() {
    global $CONFIG, $lang_meta_album_names, $lang_plugin_hot_pictures, $valid_meta_albums;

    require_once "./plugins/hot_pictures/lang/english.php";
    if ($CONFIG['lang'] != 'english' && file_exists("./plugins/hot_pictures/lang/{$CONFIG['lang']}.php")) {
        require_once "./plugins/hot_pictures/lang/{$CONFIG['lang']}.php";
    }

    $meta_album_name = 'hotpics';
    $lang_meta_album_names[$meta_album_name] = $lang_plugin_hot_pictures['hot_pictures'];
    $valid_meta_albums[] = $meta_album_name;
}


// Meta album get_pic_pos
$thisplugin->add_filter('meta_album_get_pic_pos', 'hot_pictures_get_pic_pos');
function hot_pictures_get_pic_pos($album) {

    if (is_numeric($album)) {
        return $album;
    }

    global $CONFIG, $pid, $RESTRICTEDWHERE;

    switch($album) {
        case 'hotpics':
            $query = "SELECT hot_expire FROM {$CONFIG['TABLE_PICTURES']} WHERE pid = $pid";
            $result = cpg_db_query($query);
            $hot_expire = mysql_result($result, 0);
            mysql_free_result($result);

            $timestamp = time();

            $query = "SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']} AS p
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
                $RESTRICTEDWHERE
                AND approved = 'YES'
                AND p.hot_expire > $timestamp
                AND (p.hot_expire < $hot_expire
                OR p.hot_expire = $hot_expire AND pid < $pid)";

                $result = cpg_db_query($query);

                list($pos) = mysql_fetch_row($result);
                mysql_free_result($result);
            return strval($pos);
            break;

        default: 
            return $album;
    }
}


// New meta albums
$thisplugin->add_filter('meta_album', 'hot_pictures_meta_album');
function hot_pictures_meta_album($meta) {
    global $CONFIG, $CURRENT_CAT_NAME, $RESTRICTEDWHERE, $lang_plugin_hot_pictures;

    switch ($meta['album']) {
        case 'hotpics':
            $album_name = cpg_fetch_icon('top_rated', 2)." ".$lang_plugin_hot_pictures['hot_pictures'];
            if ($CURRENT_CAT_NAME) {
                $album_name .= " - $CURRENT_CAT_NAME";
            }

            $timestamp = time();

            $query = "SELECT pid FROM {$CONFIG['TABLE_PICTURES']} AS p 
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid 
                $RESTRICTEDWHERE 
                AND approved = 'YES'
                AND p.hot_expire > $timestamp";
            $result = cpg_db_query($query);
            $count = mysql_num_rows($result);
            mysql_free_result($result);
            if (!$count) {
                $rowset = array();
                break;
            }

            $query = "SELECT p.* FROM {$CONFIG['TABLE_PICTURES']} AS p 
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid 
                $RESTRICTEDWHERE 
                AND approved = 'YES'
                AND p.hot_expire > $timestamp
                ORDER BY p.hot_expire ASC, pid ASC
                {$meta['limit']}";
            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);

            build_caption($rowset);
            break;

        default:
            return $meta;
    }
    
    $meta['album_name'] = $album_name;
    $meta['count'] = $count;
    $meta['rowset'] = $rowset;

    return $meta;
}


// Add new column
$thisplugin->add_action('plugin_install', 'hot_pictures_install');
function hot_pictures_install() {
    global $CONFIG;
    cpg_db_query("ALTER IGNORE TABLE {$CONFIG['TABLE_PICTURES']} ADD hot_expire int(11) default '0'");
    return true;
}

?>