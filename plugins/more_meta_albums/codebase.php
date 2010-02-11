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
    global $CONFIG, $lang_meta_album_names, $lang_plugin_more_meta_albums;

    require_once "./plugins/more_meta_albums/lang/english.php";
    if ($CONFIG['lang'] != 'english' && file_exists("./plugins/more_meta_albums/lang/{$CONFIG['lang']}.php")) {
        require_once "./plugins/more_meta_albums/lang/{$CONFIG['lang']}.php";
    }

    $lang_meta_album_names['mostcom'] = $lang_plugin_more_meta_albums['mostcom_title'];
    $lang_meta_album_names['mostvot'] = $lang_plugin_more_meta_albums['mostvot_title'];
}


// Meta album get_pic_pos
$thisplugin->add_filter('meta_album_get_pic_pos','mma_get_pic_pos');
function mma_get_pic_pos($album) {

    if (is_numeric($album)) {
        return $album;
    }

    global $CONFIG, $pid, $RESTRICTEDWHERE;

    switch($album) {
        case 'mostcom': // Most commented pictures
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

        case 'mostvot': // Most voted pictures
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
        case 'mostcom': // Most commented pictures
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

        case 'mostvot': // Most voted pictures
            $album_name = cpg_fetch_icon('top_rated', 2)." ".$lang_plugin_more_meta_albums['mostcom_title'];
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
            $aid = mysql_fetch_array(cpg_db_query("SELECT aid FROM `{$CONFIG['TABLE_ALBUMS']}` ORDER BY RAND() LIMIT 1"));
            header("Location: thumbnails.php?album={$aid[0]}");
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