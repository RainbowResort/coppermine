<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.4.0                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002-2004 Gregory DEMAR                                     //
// http://www.chezgreg.net/coppermine/                                       //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify      //
// it under the terms of the GNU General Public License as published by      //
// the Free Software Foundation; either version 2 of the License, or         //
// (at your option) any later version.                                       //
// ------------------------------------------------------------------------- //
// $Id$
// ------------------------------------------------------------------------- //

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

/**
 * functions_search.php
 *
 *                               -------------------
 *
 *      begin                : Wed Sep 05 2001
 *
 *      copyright            : (C) 2001 The phpBB Group
 *
 *      email                : support@phpbb.com
 *
 *
 *
 *      $Id$
 */

// encoding match for workaround

$multibyte_charset = 'utf-8, big5, shift_jis, euc-kr, gb2312';

$charset = $CONFIG['charset'] == 'language file' ? $GLOBALS['lang_charset'] : $CONFIG['charset'];

$sort_array = array('na' => 'filename ASC', 'nd' => 'filename DESC', 'ta'=>'title ASC', 'td'=>'title DESC', 'da' => 'pid ASC', 'dd' => 'pid DESC', 'pa' => 'position ASC', 'pd' => 'position DESC');
$sort_code = isset($USER['sort'])? $USER['sort'] : $CONFIG['default_sort_order'];
$sort_order = isset($sort_array[$sort_code]) ? $sort_array[$sort_code] : $sort_array[$CONFIG['default_sort_order']];

$mb_charset = stristr($multibyte_charset, $charset);

function clean_words(&$entry, $mb_charset)
{
    global $charset, $multibyte_charset;

    static $drop_char_match = array('^', '$', '&', '(', ')', '<', '>', '`', '\'', '"', '|', ',', '@', '_', '?', '%', '~', '.', '[', ']', '{', '}', ':', '\\', '/', '=', '#', '\'', ';', '!');

    static $drop_char_replace = array(' ', ' ', ' ', ' ', ' ', ' ', ' ', '', '', ' ', ' ', ' ', ' ', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ' , ' ', ' ', ' ', ' ', ' ', ' ');

    $entry = ' ' . strtolower($entry) . ' ';
    // Replace line endings by a space
    $entry = preg_replace('/[\n\r]/is', ' ', $entry);
    // + and - becomes and & not
    $entry = str_replace(' +', ' and ', $entry);

    $entry = str_replace(' -', ' not ', $entry);

    // Filter out strange characters like ^, $, &, change "it's" to "its"

    if (!$mb_charset) for($i = 0; $i < count($drop_char_match); $i++) {
        $entry = str_replace($drop_char_match[$i], $drop_char_replace[$i], $entry);
    }
    // 'words' that consist of <3 or >20 characters are removed.
    // $entry = preg_replace('/\b([a-z0-9]{1,2}|[a-z0-9]{21,})\b/',' ', $entry);
    return $entry;
}

if (defined('USE_MYSQL_SEARCH') && $query_all) {
    // If using MySQL 4 or above we use boolean search
    $mysql_version = mysql_get_server_info();

    if ($mysql_version >= '4') {
        $boolean_mode = 'IN BOOLEAN MODE';
    } else {
        $boolean_mode = '';
    }

    $result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']} WHERE MATCH(filename, title, caption, keywords) AGAINST ('$search_string' $boolean_mode) AND approved = 'YES' $ALBUM_SET");

    $nbEnr = mysql_fetch_array($result);

    $count = $nbEnr[0];

    mysql_free_result($result);

    if ($select_columns != '*') $select_columns .= ', title, caption';

    $result = cpg_db_query("SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} WHERE MATCH(filename, title, caption, keywords) AGAINST ('$search_string' $boolean_mode) AND approved = 'YES' $ALBUM_SET ORDER BY $sort_order $limit");

    $rowset = cpg_db_fetch_rowset($result);

    mysql_free_result($result);

    if ($set_caption) foreach ($rowset as $key => $row) {
        $caption = $rowset[$key]['title'] ? "<span class=\"thumb_title\">" . $rowset[$key]['title'] . "</span>" : '';

        if ($CONFIG['caption_in_thumbview']) {
            $caption .= $rowset[$key]['caption'] ? "<span class=\"thumb_caption\">" . bb_decode($rowset[$key]['caption']) . "</span>" : '';
        }

        $rowset[$key]['caption_text'] = $caption;
    }
} elseif ($search_string != '') {
    $split_search = array();

    $split_search = split(' ', clean_words($search_string, $mb_charset));

    $current_match_type = 'and';

    $pic_set = '';

    for($i = 0; $i < count($split_search); $i++) {
        switch ($split_search[$i]) {
            case 'and':

                $current_match_type = 'and';

                break;

            case 'or':

                $current_match_type = 'or';

                break;

            case 'not':

                $current_match_type = 'not';

                break;

            default:

                if (empty($split_search[$i])) break;

                $match_word = '%' . str_replace('*', '%', addslashes($split_search[$i])) . '%';

                $match_keyword = '% ' . str_replace('*', '%', addslashes($split_search[$i])) . ' %';

                $sql = "SELECT pid " . "FROM {$CONFIG['TABLE_PICTURES']} " . "WHERE CONCAT(' ', keywords, ' ') LIKE '$match_keyword' ";

                if ($query_all) $sql .= "OR filename LIKE '$match_word' " . "OR title LIKE '$match_word' " . "OR caption LIKE '$match_word' " . "OR user1 LIKE '$match_word' " . "OR user2 LIKE '$match_word' " . "OR user3 LIKE '$match_word' " . "OR user4 LIKE '$match_word' OR owner_name LIKE '$match_word' ORDER BY $sort_order";

                $result = cpg_db_query($sql);

                $set = '';

                while ($row = mysql_fetch_array($result)) {
                    $set .= $row['pid'] . ',';
                } // while
                if (empty($set)) {
                    $set = "'',";
                }

                if (empty($pic_set)) {
                    if ($current_match_type == 'not') {
                        $pic_set .= ' pid not in (' . substr($set, 0, -1) . ') ';
                    } else {
                        $pic_set .= ' pid in (' . substr($set, 0, -1) . ') ';
                    }
                } else {
                    if ($current_match_type == 'not') {
                        $pic_set .= ' and pid not in (' . substr($set, 0, -1) . ') ';
                    } else {
                        $pic_set .= ' ' . $current_match_type . ' pid in (' . substr($set, 0, -1) . ') ';
                    }
                }

                mysql_free_result($result);

                $current_match_type = 'and';
        }
    }

    if (!empty($pic_set)) {
        $sql = "SELECT COUNT(*) " . "FROM {$CONFIG['TABLE_PICTURES']} " . "WHERE ($pic_set) " . "AND approved = 'YES' " . "$ALBUM_SET";

        $result = cpg_db_query($sql);

        $nbEnr = mysql_fetch_array($result);

        $count = $nbEnr[0];

        mysql_free_result($result);

        if ($select_columns != '*') $select_columns .= ', title, caption';

        $sql = "SELECT $select_columns " . "FROM {$CONFIG['TABLE_PICTURES']} " . "WHERE ($pic_set) " . "AND approved = 'YES' " . "$ALBUM_SET ORDER BY $sort_order $limit";

        $result = cpg_db_query($sql);

        $rowset = cpg_db_fetch_rowset($result);

        mysql_free_result($result);

        if ($set_caption) foreach ($rowset as $key => $row) {
            $caption = $rowset[$key]['title'] ? "<span class=\"thumb_title\">" . $rowset[$key]['title'] . "</span>" : '';

            if ($CONFIG['caption_in_thumbview']) {
                $caption .= $rowset[$key]['caption'] ? "<span class=\"thumb_caption\">" . bb_decode($rowset[$key]['caption']) . "</span>" : '';
            }

            $rowset[$key]['caption_text'] = $caption;
        }
    } else {
        $count = 0;

        $rowset = array();
    }
} else {
    $count = 0;

    $rowset = array();
}

?>