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
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/
/*********************************************
  Coppermine Plugin - Atom Feed
  ********************************************
  Copyright (c) 2009 eenemeenemuu
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('page_start','atom_page_start');
$thisplugin->add_filter('sub_menu','atom_sub_menu');


function atom_page_start() {
    $superCage = Inspekt::makeSuperCage();

    if ($superCage->get->keyExists('atom')) {
        global $CONFIG, $lang_meta_album_names;
        $type = $superCage->get->getAlpha('atom');
        $supported_feeds = array("lastup", "lastalb", "lastcom");
        if (isset($CONFIG['fr_title'])) {
            $supported_feeds[] = "forum";
            $lang_meta_album_names['forum'] = "Forum";
        }

        if(in_array($type, $supported_feeds)) {

            function atomdate($timestamp) {
                return(date("Y-m-d", $timestamp - date('Z')) . "T" . date("H:i:s", $timestamp - date('Z') ) . "Z");
            }

            // Atom header
            header ("content-type: text/xml");
            echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>
              <feed xmlns=\"http://www.w3.org/2005/Atom\">
                <id>{$CONFIG['ecards_more_pic_target']}</id>
                <updated>".atomdate(time())."</updated>
                ";
            
            if ($type != "forum") {
                echo "<title>{$CONFIG['gallery_name']} - {$lang_meta_album_names[$type]}</title>";
                if ($superCage->get->keyExists('cat')) {
                    $cat = $superCage->get->getInt('cat');
                    get_meta_album_set($cat);
                    global $RESTRICTEDWHERE;
                }
            }

            if($type == "lastup") {
                $result = cpg_db_query("
                    SELECT r.*, u.user_name 
                    FROM {$CONFIG['TABLE_PICTURES']} r 
                    INNER JOIN {$CONFIG['TABLE_USERS']} u 
                    ON r.owner_id = u.user_id 
                    INNER JOIN {$CONFIG['TABLE_ALBUMS']} a 
                    ON a.aid = r.aid
                    {$RESTRICTEDWHERE}
                    AND approved = 'YES'
                    ORDER BY r.pid DESC 
                    LIMIT 500
                ");
                while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                    $image = $CONFIG['ecards_more_pic_target'].get_pic_url($row, 'thumb');
                    $link = $CONFIG['ecards_more_pic_target']."displayimage.php?pid=".$row['pid'];
                    echo "
                      <entry>
                        <id>$link</id>
                        <title>{$row['filename']}</title>
                        <updated>".atomdate($row['ctime'])."</updated>
                        <author><name>{$row['user_name']}</name></author>
                        <link href=\"$link\" />
                        <summary type=\"html\">".htmlentities("<a href=\"$link\"><img src=\"$image\" /></a>")."</summary>
                      </entry>";
                }
            }

            if($type == "lastalb") {
                $result = cpg_db_query("
                    SELECT * 
                    FROM {$CONFIG['TABLE_ALBUMS']} a
                    {$RESTRICTEDWHERE}
                    ORDER BY a.aid 
                    DESC LIMIT 20
                ");
                while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                    $result2 = cpg_db_query("SELECT p.*, u.user_name FROM {$CONFIG['TABLE_PICTURES']} p INNER JOIN {$CONFIG['TABLE_USERS']} u ON owner_id = user_id WHERE aid = {$row['aid']} ORDER BY pid DESC");
                    if(mysql_num_rows($result2) == "0") {
                        continue; // don't show empty albums
                    } else {
                        $thumb = mysql_fetch_array($result2, MYSQL_ASSOC);
                        $image = get_pic_url($thumb, 'thumb');
                    }
                    $image = $CONFIG['ecards_more_pic_target'].$image;
                    $link = $CONFIG['ecards_more_pic_target']."thumbnails.php?album=".$row['aid'];
                    echo "
                      <entry>
                        <id>$link</id>
                        <title>{$row['title']}</title>
                        <updated>".atomdate($thumb['ctime'])."</updated>
                        <author><name>{$thumb['user_name']}</name></author>
                        <link href=\"$link\" /> $picinfo
                        <summary type=\"html\">".htmlentities("<a href=\"$link\"><img src=\"$image\" /></a>")."</summary>
                      </entry>";
                }
            }

            if($type == "lastcom") {
                $result = cpg_db_query("
                    SELECT r.*, com.*
                    FROM {$CONFIG['TABLE_COMMENTS']} com 
                    INNER JOIN {$CONFIG['TABLE_PICTURES']} r 
                    ON com.pid = r.pid 
                    INNER JOIN {$CONFIG['TABLE_ALBUMS']} a 
                    ON a.aid = r.aid
                    {$RESTRICTEDWHERE}
                    AND approved = 'YES'
                    ORDER BY msg_id DESC 
                    LIMIT 100
                ");
                while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                    $image = $CONFIG['ecards_more_pic_target'].get_pic_url($row, 'thumb');
                    $link = $CONFIG['ecards_more_pic_target']."displayimage.php?pid={$row['pid']}#comment{$row['msg_id']}";
                    $msg_date = explode(" ", $row['msg_date']);
                    $msg_date_date = explode("-", $msg_date[0]);
                    $msg_date_time = explode(":", $msg_date[1]);
                    $timestamp = mktime($msg_date_time[0], $msg_date_time[1], $msg_date_time[2], $msg_date_date[1], $msg_date_date[2], $msg_date_date[0]);
                    echo "
                      <entry>
                        <id>$link</id>
                        <title>{$row['msg_author']}</title>
                        <updated>".atomdate($timestamp)."</updated>
                        <author><name>{$row['msg_author']}</name></author>
                        <link href=\"$link\" />
                        <summary type=\"html\">".htmlentities("{$row['msg_body']}<br /><br /><a href=\"$link\"><img src=\"$image\" /></a>")."</summary>
                      </entry>";
                }
            }

            if($type == "forum") {
                echo "<title>{$CONFIG['gallery_name']} - {$CONFIG['fr_title']}</title>";
                $result = cpg_db_query("
                    SELECT * 
                    FROM {$CONFIG['TABLE_PREFIX']}fr_messages 
                    ORDER BY msg_id DESC 
                    LIMIT 100
                    ");
                while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                    $link = $CONFIG['ecards_more_pic_target']."forum.php?c=message&amp;id={$row['msg_id']}";
                    echo "
                      <entry>
                        <id>$link</id>
                        <title>{$row['subject']}</title>
                        <updated>".atomdate($row['poster_time'])."</updated>
                        <author><name>{$row['poster_name']}</name></author>
                        <link href=\"$link\" />
                        <summary type=\"html\">{$row['body']}</summary>
                      </entry>";
                }
            }

            // Atom footer
            echo "</feed>";

            exit;
        } else {
            load_template();
            pageheader('Atom');
            starttable($CONFIG['main_table_width'], 'Usage');

            foreach($supported_feeds as $type) {
                $available .= "<li> <a href=\"index.php?atom=$type\">{$lang_meta_album_names[$type]}</a> </li>";
            }
            $supported = implode(", ", $supported_feeds);
            $supported = str_replace(", forum", "", $supported);

            echo "
                <tr>
                    <td class=\"tableb\">
                        Visit a supported meta album ({$supported}) and press the 'Atom' button again 
                        <br /><br /> or <br /><br />
                        use one of these pre-built gallery feeds: <ul> {$available} </ul>
                    </td>
                </tr>
            ";
            endtable();
            pagefooter();
            exit;
        }
    }
}


function atom_sub_menu($menu) {
    $superCage = Inspekt::makeSuperCage();
    $meta_album = $superCage->get->keyExists('album') ? $superCage->get->getAlpha('album') : 'help';
    $cat = $superCage->get->keyExists('cat') ? "&amp;cat=".$superCage->get->getInt('cat') : '';

    $new_button = array();
    $new_button[0][0] = 'Atom';
    $new_button[0][1] = 'Atom Feed';
    $new_button[0][2] = 'index.php?atom='.$meta_album.$cat;
    $new_button[0][3] = 'atom';
    $new_button[0][4] = '::';
    $new_button[0][5] = 'rel="nofollow"';

    array_splice($menu, count($menu)-1, 0, $new_button);

    return $menu;
}

?>
