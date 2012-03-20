<?php
/**************************************************
  Coppermine 1.5.x Plugin - Vote for albums
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


function album_voting_user_voted($aid, $type = 1) {
    global $CONFIG;
    if (mysql_num_rows(cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}album_votes WHERE aid = $aid AND type = $type AND user_id = ".USER_ID))) {
        return true;
    } else {
        return false;
    }
}


function album_voting_voting_stats($aid, $type = 1) {
    global $CONFIG, $lang_plugin_album_voting;
    $num_votes = $lang_plugin_album_voting['votes']." ".mysql_result(cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}album_votes WHERE aid = $aid AND type = $type"), 0);
    return $num_votes;
}


function album_voting_vote_button($aid, $type = 1, $cat = false) {
    global $lang_plugin_album_voting;
    $superCage = Inspekt::makeSuperCage();
    if (album_voting_user_voted($aid, $type)) {
        $text = $lang_plugin_album_voting['vote_remove'];
        $action = "0";
    } else {
        $text = $lang_plugin_album_voting['vote_add'];
        $action = "1";
    }
    $cat = $cat !== false ? '&amp;cat='.$cat : '';
    $vote_button = "<a href=\"index.php?file=album_voting/vote&amp;aid={$aid}&amp;type={$type}&amp;action={$action}{$cat}\" class=\"admin_menu\">{$text}</a>";
    return $vote_button;
}


// Button for thumbnail view (thumbnails.php)
$thisplugin->add_filter('theme_thumbnails_title', 'album_voting_thumbnails_title');
function album_voting_thumbnails_title($param) {
    $superCage = Inspekt::makeSuperCage();
    $aid = $superCage->get->getInt('album');
    if ($aid > 0) {
        $param['{ALBUM_NAME}'] .= ' &#124; ';
        if (USER_ID) {
            $param['{ALBUM_NAME}'] .= album_voting_vote_button($aid, 1)." ";
        }
    $param['{ALBUM_NAME}'] .= album_voting_voting_stats($aid, 1);

    }
    return $param;
}


// Buttons for category/album view (index.php)
$thisplugin->add_filter('theme_album_params', 'album_voting_album_params');
function album_voting_album_params($params) {
    $params['{ALB_HITS}'] .= "<br />";
    $aid = str_replace('thumbnails.php?album=', '', $params['{ALB_LINK_TGT}']);
    if (USER_ID) {
        global $cat;
        $params['{ALB_HITS}'] .= album_voting_vote_button($aid, 1, $cat);
    }
    $params['{ALB_HITS}'] .= " ".album_voting_voting_stats($aid, 1);
    return $params;
}


// Meta album titles
$thisplugin->add_action('page_start', 'album_voting_start');
function album_voting_start() {
    global $CONFIG, $lang_meta_album_names, $lang_plugin_album_voting, $valid_meta_albums;

    require "./plugins/album_voting/lang/english.php";
    if ($CONFIG['lang'] != 'english' && file_exists("./plugins/album_voting/lang/{$CONFIG['lang']}.php")) {
        require "./plugins/album_voting/lang/{$CONFIG['lang']}.php";
    }

    $meta_album_name = 'mostvotalb';
    $lang_meta_album_names[$meta_album_name] = $lang_plugin_album_voting[$meta_album_name];
    $valid_meta_albums[] = $meta_album_name;
}


// Add 'album' type
$thisplugin->add_filter('theme_thumbnails_album_types', 'album_voting_album_types');
function album_voting_album_types($album_types) {
    $album_types['albums'][] = 'mostvotalb';

    return $album_types;
}


// New meta albums
$thisplugin->add_filter('meta_album', 'album_voting_meta_album');
function album_voting_meta_album($meta) {
    global $CONFIG, $CURRENT_CAT_NAME, $RESTRICTEDWHERE, $lang_plugin_album_voting;

    switch ($meta['album']) {
        case 'mostvotalb':
            $album_name = cpg_fetch_icon('top_rated', 2)." ".$lang_plugin_album_voting['mostvotalb'];
            if ($CURRENT_CAT_NAME) {
                $album_name .= " - $CURRENT_CAT_NAME";
            }

            $query = "SELECT *, COUNT(v.aid) AS album_votes FROM {$CONFIG['TABLE_PREFIX']}album_votes AS v
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = v.aid 
                $RESTRICTEDWHERE 
                GROUP BY v.aid
                ORDER BY album_votes DESC, v.aid DESC
                {$meta['limit']}";
            $result = cpg_db_query($query);
            $count = mysql_num_rows($result);
            $rowset_aid = cpg_db_fetch_rowset($result);
            mysql_free_result($result);
            if (!$count) {
                $rowset = array();
                break;
            }

            // Get album thumbnails 
            // Copied from include/functions.inc.php 'lastalb' meta album code -- START
            $album_thumbs = array();
            foreach ($rowset_aid as $index => $row) {
                if ($row['thumb'] > 0) {
                    $album_thumbs[] = $row['thumb'];
                }
            }
            if (count($album_thumbs)) {
                $query = "SELECT pid FROM {$CONFIG['TABLE_PICTURES']} WHERE pid IN (".implode(',', $album_thumbs).")";
                $result = cpg_db_query($query);
                while ($row = mysql_fetch_assoc($result)) {
                    $rowset_available_pids[] = $row['pid'];
                }
                mysql_free_result($result);
            }

            $album_thumbs = array();
            foreach ($rowset_aid as $index => $row) {

                // Check if album thumbnail exists, if not, set to last uploaded
                if ($row['thumb'] > 0 && !in_array($row['thumb'], $rowset_available_pids)) {
                    $row['thumb'] = 0;
                }

                if ($row['thumb'] > 0) {
                    $album_thumbs[] = $row['thumb'];
                } elseif ($row['thumb'] < 0) {
                    // random file from album
                    $keyword = ($row['keyword'] ? "OR (keywords like '%".addslashes($row['keyword'])."%' $forbidden_set_string )" : '');
                    $query = "SELECT pid FROM {$CONFIG['TABLE_PICTURES']} WHERE ((aid = '{$row['aid']}' $forbidden_set_string) $keyword) $approved ORDER BY RAND() LIMIT 0,1";
                    $result = cpg_db_query($query);
                    list($pid_random) = mysql_fetch_row($result);
                    mysql_free_result($result);
                    $album_thumbs[] = $pid_random;
                    $rowset_aid[$index]['thumb'] = $pid_random;
                } else {  // thumb = 0
                    // last uploaded file from album
                    $keyword = ($row['keyword'] ? "OR (keywords like '%".addslashes($row['keyword'])."%' $forbidden_set_string )" : '');
                    $query = "SELECT pid FROM {$CONFIG['TABLE_PICTURES']} WHERE ((aid = '{$row['aid']}' $forbidden_set_string) $keyword) $approved ORDER BY ctime DESC LIMIT 0,1";
                    $result = cpg_db_query($query);
                    list($pid_lastup) = mysql_fetch_row($result);
                    mysql_free_result($result);
                    $album_thumbs[] = $pid_lastup;
                    $rowset_aid[$index]['thumb'] = $pid_lastup;
                }
            }

            if (!$album_thumbs) {
                $rowset = array();
            } else {
                $album_thumbs_set = implode(',', array_unique($album_thumbs));
                $query = "SELECT *
                        FROM {$CONFIG['TABLE_PICTURES']} AS r
                        WHERE approved = 'YES'
                        AND r.pid IN ($album_thumbs_set)";
                $result = cpg_db_query($query);
                $rowset_pid = cpg_db_fetch_rowset($result);
                mysql_free_result($result);

                $rowset_pid_indexed = array();
                foreach ($rowset_pid as $row) {
                    $rowset_pid_indexed[$row['pid']] = $row;
                }
                $rowset = array();
                foreach ($rowset_aid as $row) {
                    $rowset[] = is_array($rowset_pid_indexed[$row['thumb']]) ? array_merge($rowset_pid_indexed[$row['thumb']], $row) : $row;
                }

                if ($set_caption) {
                    build_caption($rowset, array('ctime'), 'albums');
                }
            }
            // Copy -- END

            build_caption($rowset);
            foreach ($rowset as $key => $row) {
                $rowset[$key]['caption_text'] .= "<span class=\"thumb_title\">{$lang_plugin_album_voting['votes']} {$row['album_votes']}</span>";
            }
            break;

        default:
            return $meta;
    }
    
    $meta['album_name'] = $album_name;
    $meta['count'] = $count;
    $meta['rowset'] = $rowset;

    return $meta;
}


// Create new table on install
$thisplugin->add_action('plugin_install', 'album_voting_install');
function album_voting_install() {
    global $CONFIG;
    cpg_db_query("CREATE TABLE IF NOT EXISTS {$CONFIG['TABLE_PREFIX']}album_votes (
        aid int(11) NOT NULL,
        user_id int(11) NOT NULL, 
        type int(1) NOT NULL,
        timestamp int(11) NOT NULL
    );");
    return true;
}

?>