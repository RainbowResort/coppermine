<?php
/**************************************************
  Coppermine 1.5.x plugin - More meta albums
  *************************************************
  Copyright (c) 2010 eenemeenemuu
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


// Meta album titles
$thisplugin->add_action('page_start','mma_page_start');
function mma_page_start() {
    global $CONFIG, $lang_meta_album_names, $lang_plugin_more_meta_albums, $valid_meta_albums;

    require_once "./plugins/more_meta_albums/lang/english.php";
    if ($CONFIG['lang'] != 'english' && file_exists("./plugins/more_meta_albums/lang/{$CONFIG['lang']}.php")) {
        require_once "./plugins/more_meta_albums/lang/{$CONFIG['lang']}.php";
    }

    foreach($lang_plugin_more_meta_albums as $key => $value) {
        if (substr($key, -6) == "_title") {
            $meta_album_name = substr($key, 0, count($key)-7);
            $lang_meta_album_names[$meta_album_name] = $value;
            $valid_meta_albums[] = $meta_album_name;
        }
    }
}


// Add 'album' type
$thisplugin->add_filter('theme_thumbnails_album_types', 'mma_album_types');
function mma_album_types($album_types) {
    $album_types['albums'][] = 'newalb';
    return $album_types;
}


// Meta album get_pic_pos
$thisplugin->add_filter('meta_album_get_pic_pos','mma_get_pic_pos');
function mma_get_pic_pos($album) {

    if (is_numeric($album)) {
        return $album;
    }

    global $CONFIG, $pid, $RESTRICTEDWHERE;

    switch($album) {
        case 'image': // All pictures
        case 'movie': // All videos
        case 'audio': // All audio files
        case 'document': // All documents
            $filetypes = array();
            $filetypes_sql = "";
            $result = cpg_db_query("SELECT extension FROM {$CONFIG['TABLE_FILETYPES']} WHERE content = '$album'");
            while($row = mysql_fetch_assoc($result)) {
                $filetypes[] = $row['extension'];
            }
            foreach($filetypes as $filetype) {
                $filetypes_sql .= "filename LIKE '%.$filetype' OR ";
            }
            $filetypes_sql .= "0";

            $query = "SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']} AS p
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
                $RESTRICTEDWHERE
                AND approved = 'YES'
                AND ($filetypes_sql)
                AND pid < $pid";

                $result = cpg_db_query($query);

                list($pos) = mysql_fetch_row($result);
                mysql_free_result($result);
            return strval($pos);
            break;

        case 'landscape': // Landscape format (height < width)
        case 'portrait': // Portrait format (width < height)
            $icons = array(
                'landscape' => 'searchnew',
                'portrait' => 'user_mgr'
            );

            $compare = array(
                'landscape' => '>',
                'portrait' => '<'
            );

            $query = "SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']} AS p
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
                $RESTRICTEDWHERE
                AND approved = 'YES'
                AND pwidth {$compare[$album]} pheight
                AND pid < $pid";

                $result = cpg_db_query($query);

                list($pos) = mysql_fetch_row($result);
                mysql_free_result($result);
            return strval($pos);
            break;

        case 'newalb': // New albums
            $query = "SELECT ctime FROM {$CONFIG['TABLE_PICTURES']} WHERE pid = $pid";
            $result = cpg_db_query($query);
            $ctime = mysql_result($result, 0);
            mysql_free_result($result);

            $query = "SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']} AS p 
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid 
                $RESTRICTEDWHERE 
                AND approved = 'YES' 
                AND p.pid = r.thumb 
                AND ctime > $ctime 
                OR ctime = $ctime AND pid < $pid";
            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);

            build_caption($rowset, array('ctime'));
            break;

        case 'mostcom': // Most commented files
            $query = "SELECT p.pid, COUNT(*) AS count FROM {$CONFIG['TABLE_PICTURES']} AS p
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
                INNER JOIN {$CONFIG['TABLE_COMMENTS']} AS c ON c.pid = p.pid
                $RESTRICTEDWHERE
                AND approved = 'YES'
                AND approval = 'YES'
                GROUP BY p.pid
                ORDER BY count DESC, p.pid ASC";

                $result = cpg_db_query($query);
                $pos = 0;
                while($row = mysql_fetch_assoc($result)) {
                    if ($row['pid'] == $pid) {
                        break;
                    }
                    $pos++;
                }
                mysql_free_result($result);

            return strval($pos);
            break;

        case 'mostvot': // Most voted files
            $query = "SELECT votes FROM {$CONFIG['TABLE_PICTURES']} WHERE pid = $pid";
            $result = cpg_db_query($query);
            $votes = mysql_result($result, 0);
            mysql_free_result($result);

            $query = "SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']} AS p
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
                $RESTRICTEDWHERE
                AND approved = 'YES'
                AND p.votes > $votes
                OR p.votes = $votes AND pid < $pid";

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
$thisplugin->add_filter('meta_album', 'mma_meta_album');
function mma_meta_album($meta) {
    global $CONFIG, $CURRENT_CAT_NAME, $RESTRICTEDWHERE, $lang_plugin_more_meta_albums;

    switch ($meta['album']) {
        case 'image': // All pictures
        case 'movie': // All videos
        case 'audio': // All audio files
        case 'document': // All documents
            $icons = array(
                'image' => 'picture_sort',
                'movie' => 'slideshow',
                'audio' => 'announcement',
                'document' => 'documentation'
            );

            $album_name = cpg_fetch_icon($icons[$meta['album']], 2)." ".$lang_plugin_more_meta_albums[$meta['album'].'_title'];
            if ($CURRENT_CAT_NAME) {
                $album_name .= " - $CURRENT_CAT_NAME";
            }

            $filetypes = array();
            $filetypes_sql = "";
            $result = cpg_db_query("SELECT extension FROM {$CONFIG['TABLE_FILETYPES']} WHERE content = '{$meta['album']}'");
            while($row = mysql_fetch_assoc($result)) {
                $filetypes[] = $row['extension'];
            }
            foreach($filetypes as $filetype) {
                $filetypes_sql .= "filename LIKE '%.$filetype' OR ";
            }
            $filetypes_sql .= "0";

            $query = "SELECT pid FROM {$CONFIG['TABLE_PICTURES']} AS p 
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid 
                $RESTRICTEDWHERE
                AND approved = 'YES'
                AND ($filetypes_sql)";
            $result = cpg_db_query($query);
            $count = mysql_num_rows($result);
            mysql_free_result($result);

            $query = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p 
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
                $RESTRICTEDWHERE 
                AND approved = 'YES'
                AND ($filetypes_sql)
                ORDER BY pid ASC 
                {$meta['limit']}";
            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);

            build_caption($rowset);
            break;

        case 'landscape': // Landscape format (height < width)
        case 'portrait': // Portrait format (width < height)
            $icons = array(
                'landscape' => 'searchnew',
                'portrait' => 'user_mgr'
            );

            $compare = array(
                'landscape' => '>',
                'portrait' => '<'
            );

            $album_name = cpg_fetch_icon($icons[$meta['album']], 2)." ".$lang_plugin_more_meta_albums[$meta['album'].'_title'];
            if ($CURRENT_CAT_NAME) {
                $album_name .= " - $CURRENT_CAT_NAME";
            }

            $query = "SELECT pid FROM {$CONFIG['TABLE_PICTURES']} AS p 
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid 
                $RESTRICTEDWHERE
                AND approved = 'YES'
                AND pwidth {$compare[$meta['album']]} pheight";
            $result = cpg_db_query($query);
            $count = mysql_num_rows($result);
            mysql_free_result($result);

            $query = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p 
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
                $RESTRICTEDWHERE 
                AND approved = 'YES'
                AND pwidth {$compare[$meta['album']]} pheight
                ORDER BY pid ASC 
                {$meta['limit']}";
            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);

            build_caption($rowset);
            break;

        case 'newalb': // New albums
            $album_name = cpg_fetch_icon('last_created', 2)." ".$lang_plugin_more_meta_albums['newalb_title'];
            if ($CURRENT_CAT_NAME) {
                $album_name .= " - $CURRENT_CAT_NAME";
            }

            $query = "SELECT pid FROM {$CONFIG['TABLE_PICTURES']} AS p 
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid 
                $RESTRICTEDWHERE 
                AND approved = 'YES'
                AND p.pid = r.thumb ";
            $result = cpg_db_query($query);
            $count = mysql_num_rows($result);
            mysql_free_result($result);

            $query = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p 
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid 
                $RESTRICTEDWHERE 
                AND approved = 'YES' 
                AND p.pid = r.thumb 
                ORDER BY ctime DESC
                {$meta['limit']}";
            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);

            build_caption($rowset, array('ctime'));
            break;

        case 'mostcom': // Most commented files
            $album_name = cpg_fetch_icon('comment', 2)." ".$lang_plugin_more_meta_albums['mostcom_title'];
            if ($CURRENT_CAT_NAME) {
                $album_name .= " - $CURRENT_CAT_NAME";
            }

            $query = "SELECT DISTINCT c.pid FROM {$CONFIG['TABLE_COMMENTS']} AS c 
                INNER JOIN {$CONFIG['TABLE_PICTURES']} AS p ON c.pid = p.pid 
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid 
                $RESTRICTEDWHERE
                AND approved = 'YES'
                AND approval = 'YES'";
            $result = cpg_db_query($query);
            $count = mysql_num_rows($result);
            mysql_free_result($result);

            $query = "SELECT *, COUNT(c.pid) AS count FROM {$CONFIG['TABLE_COMMENTS']} c 
                INNER JOIN {$CONFIG['TABLE_PICTURES']} AS p ON p.pid = c.pid 
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid
                $RESTRICTEDWHERE 
                AND approved = 'YES'
                AND approval = 'YES'
                GROUP BY p.pid 
                ORDER BY count DESC, p.pid ASC 
                {$meta['limit']}";
            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);
            
            $preVal = $CONFIG['display_comment_count'];
            $CONFIG['display_comment_count'] = 1;
            build_caption($rowset);
            $CONFIG['display_comment_count'] = $preVal;
            break;

        case 'mostvot': // Most voted files
            $album_name = cpg_fetch_icon('top_rated', 2)." ".$lang_plugin_more_meta_albums['mostvot_title'];
            if ($CURRENT_CAT_NAME) {
                $album_name .= " - $CURRENT_CAT_NAME";
            }

            $query = "SELECT pid FROM {$CONFIG['TABLE_PICTURES']} AS p 
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid 
                $RESTRICTEDWHERE 
                AND approved = 'YES'
                AND p.votes > 0";
            $result = cpg_db_query($query);
            $count = mysql_num_rows($result);
            mysql_free_result($result);

            $query = "SELECT *, p.votes FROM {$CONFIG['TABLE_PICTURES']} AS p 
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid 
                $RESTRICTEDWHERE 
                AND approved = 'YES'
                AND p.votes > 0
                ORDER BY p.votes DESC, pid ASC
                {$meta['limit']}";
            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);

            build_caption($rowset, array('pic_rating'));
            break;

        case 'randalb': // Random album
            $aid = mysql_result(cpg_db_query("SELECT aid FROM `{$CONFIG['TABLE_ALBUMS']}` ORDER BY RAND() LIMIT 1"), 0);
            header("Location: thumbnails.php?album=$aid");
            break;

        default:
            return $meta;
    }
    
    $meta['album_name'] = $album_name;
    $meta['count'] = $count;
    $meta['rowset'] = $rowset;

    return $meta;
}


?>