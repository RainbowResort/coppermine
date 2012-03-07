<?php
/**************************************************
  Coppermine 1.5.x Plugin - xfeed
  *************************************************
  Copyright (c) 2008 lee (www.mininoteuser.com)
  Plugin for CPG 1.4 created by Lee
  Ported to CPG 1.5.x by Aditya Mooley <adityamooley@sanisoft.com>
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

// WARNING : No user servicable parts below here
define('IN_COPPERMINE', true);

require_once('./plugins/xfeed/include/init.inc.php');

// This should work as it is, but hardcode if necessary.
define('CPG15', version_compare(COPPERMINE_VERSION, "1.5.0", ">="));
define('PHP5', version_compare(phpversion(), "5", ">="));
$base = rtrim($CONFIG['ecards_more_pic_target'], '/');
$gallery_name = $CONFIG['gallery_name'];

function lmdate($timestamp)
{
    if (PHP5) {
        return date('r', $timestamp);
    } else {
        return date('D, d M Y H:i:s +0800', $timestamp - date('Z'));
    }
}

function rfc3339date ($timestamp)
{
    //2002-10-02T15:00:00Z
    return(date("Y-m-d", $timestamp - date('Z')) . "T" . date("H:i:s", $timestamp - date('Z') ) . "Z");
}


if ($superCage->get->keyExists('album')) {
    // For any kind of album, get its pictures using built-in get_pic_data(). Respect the album privacy settings
    $album = $superCage->get->getEscaped('album');

    if ($superCage->get->keyExists('cat')) {
        $cat = $superCage->get->getRaw('cat');
        $cat = (int)$cat;

        if ($cat < 0) {
            // In case of metaalbums, the category id gets negative value which is actually the album id. So, first get the correct category id
            $aid = -($cat);
            $query = "SELECT category FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid = '$aid'";
            $result = cpg_db_query($query);

            $row = cpg_db_fetch_rowset($result);
            $cat = $row[0]['category'];
        }

        $CURRENT_CAT_NAME = populate_category_name($cat);

        get_meta_album_set($cat);
    } else {
        get_meta_album_set(0);
    }

    $pic_data = get_pic_data($album, $count, $album_name, 0, $XFDSET['xfd_feed_items'], false);
} elseif ($superCage->get->testInt('cat')) {
    // If on category page, show the last uploaded photos for all the albums in that category in feed
    $cat = $superCage->get->getInt('cat');
    $album = 'lastup';

    $CURRENT_CAT_NAME = populate_category_name($cat);

    get_meta_album_set($cat);
    $pic_data = get_pic_data($album, $count, $album_name, 0, $XFDSET['xfd_feed_items'], false);

} else {
    get_meta_album_set(0);
    $query = "SELECT pid,aid,filepath,filename,url_prefix,pwidth,pheight,filesize,ctime,title,keywords,votes,pic_rating,hits,caption,owner_id,u.user_name FROM {$CONFIG['TABLE_PICTURES']} r, {$CONFIG['TABLE_USERS']} u
            $RESTRICTEDWHERE AND r.owner_id = u.user_id AND approved = 'YES' ORDER BY pid DESC LIMIT 0, {$XFDSET['xfd_feed_items']}";;
    $result = cpg_db_query($query);
    $pic_data = cpg_db_fetch_rowset($result);
}

/**
 * MAIN CODE
 */
$feedtype = $superCage->get->keyExists('type') ? $superCage->get->getEscaped('type') : '';
header("Content-type: text/xml; charset={$CONFIG['charset']}");
if ($feedtype == "atom"){
    atom10();
} else {
    rss20();
}

// Create RSS
function rss20() {
    global $CONFIG, $result, $base, $gallery_name, $pic_data, $album, $album_name, $CURRENT_CAT_NAME;

    $superCage = Inspekt::makeSuperCage();

    // Decide what kind of title to be shown
    if ((int)$album) {
        $title = " | Album: $album_name";
    } elseif ($superCage->get->testInt('cat')) {
        if (strip_tags($album_name)) {
            $title = ' | ' . strip_tags($album_name);
        }
        if ($superCage->get->getInt('cat') < 0) {
            $albumDetails = get_album_name(-($superCage->get->getInt('cat')));
            $title .= " | Album: {$albumDetails['title']}";
        }
    } elseif ($album) {
        $title = ' | '. strip_tags($album_name);
    }

    print "<?xml version=\"1.0\" encoding=\"{$CONFIG['charset']}\"?>\n";
    print "<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\">";
    print "<channel>\n";
    print "<title>{$gallery_name}{$title}</title>\n";
    print "<link>$base</link>\n";
    print "<description>".$CONFIG['gallery_description']."</description>\n";
    print "<language>en-US</language>\n";
    print "<lastBuildDate>"  . lmdate(time()) . "</lastBuildDate>\n";
    print "<generator>Coppermine RSS Aggregator</generator>\n\n";

    foreach ($pic_data as $row) {
        $title = $row['title'] ? $row['title'] : $row['filename'];
        print "\t<item>\n";
        print "\t\t<title>".htmlspecialchars ($title, ENT_COMPAT, $CONFIG['charset'])."</title>\n";
        print "\t\t<link>$base/displayimage.php?pid={$row['pid']}</link>\n";
        print "\t\t<dc:creator>{$row['owner_name']}</dc:creator>\n";
        print "\t\t<pubDate>" . lmdate($row['ctime']) . "</pubDate>\n";
        print "\t\t<description>";
        echo  htmlspecialchars ("<p><img src=\"$base/".get_pic_url($row, 'thumb')."\" alt=\"{$row['filename']}\" /></p>", ENT_COMPAT, $CONFIG['charset']);
        echo  htmlspecialchars ("<p>" . bb_decode($row['caption']) ."&nbsp;</p>", ENT_COMPAT, $CONFIG['charset']);
        echo  htmlspecialchars ("<p>" . bb_decode($row['keywords']) . "</p>", ENT_COMPAT, $CONFIG['charset']);

        if (isset($row['msg_body']) && !empty($row['msg_body'])) {
            // We have comment for the photo. Must be lastcom metaalbum feed. Display the comment
            echo  htmlspecialchars ("<p><b>Comment:</b> (<i>".date('Y-m-d H:m:s', $row['msg_date'])."</i>) - {$row['msg_author']}</p>", ENT_COMPAT, $CONFIG['charset']);
            if ($CONFIG['enable_smilies']) {
                include_once("include/smilies.inc.php");
                $row['msg_body'] = process_smilies($row['msg_body']);
            }
            echo  htmlspecialchars ("<p>" . bb_decode($row['msg_body']) . "&nbsp;</p>", ENT_COMPAT, $CONFIG['charset']);
        }

        print "</description>\n";
        print "\t\t<guid>$base/displayimage.php?pid={$row['pid']}</guid>\n";
        print "\t</item>\n";
        print "\n";
    }
    print "</channel>";
    print "</rss>";
}

function atom10() {
    global $CONFIG, $result, $base, $gallery_name, $CURRENT_CAT_NAME, $album, $album_name, $pic_data;

    $superCage = Inspekt::makeSuperCage();

    // Decide what kind of title to be shown
    if ((int)$album) {
        $title = " | Album: $album_name";
    } elseif ($superCage->get->testInt('cat')) {
        $title = " | Category: $CURRENT_CAT_NAME";
    } elseif ($album) {
        $title = ' | '. strip_tags($album_name);
    }

    print "<?xml version=\"1.0\" encoding=\"{$CONFIG['charset']}\"?>\n";
    print "<feed xmlns=\"http://www.w3.org/2005/Atom\">\n";
    print "<title>$gallery_name{$title}</title>\n";
    print "<link href=\"$base\" />\n";
    print "<updated>" . rfc3339date(time()) . "</updated>\n";
    print "<author><name>Admin</name></author>\n";
    print "<id>$base/</id>\n";
    print "<generator uri=\"http://coppermine-gallery.net/\" version=\"1.0\">Coppermine Atom Aggregator</generator>\n";
    print "<link rel=\"self\" type=\"application/atom+xml\" href=\"$base" . $_SERVER["PHP_SELF"] . "?type=atom\" />\n\n";


    foreach ($pic_data as $row) {
        print "\t<entry>\n";
        print "\t\t<title> {$row['title']} </title>\n";
        print "\t\t<link href=\"$base/displayimage.php?pid={$row['pid']}\" />\n";
        print "\t\t<id>$base/displayimage.php?pid={$row['pid']}</id>\n";
        print "\t\t<updated>" . rfc3339date($row['ctime']) . "</updated>\n";
        print "\t\t<content type=\"html\">\n";
        echo  htmlspecialchars ("<p><img src=\"$base/".get_pic_url($row, 'thumb')."\" alt=\"{$row['filename']}\" /></p>", ENT_COMPAT, $CONFIG['charset']);
        echo  htmlspecialchars ("<p>" . bb_decode($row['caption']) ."&nbsp;</p>", ENT_COMPAT, $CONFIG['charset']);
        echo  htmlspecialchars ("<p>" . bb_decode($row['keywords']) . "</p>", ENT_COMPAT, $CONFIG['charset']);

        if (isset($row['msg_body']) && !empty($row['msg_body'])) {
            // We have comment for the photo. Must be lastcom metaalbum feed. Display the comment
            echo  htmlspecialchars ("<p><b>Comment:</b> (<i>".date('Y-m-d H:m:s', $row['msg_date'])."</i>) - {$row['msg_author']}</p>", ENT_COMPAT, $CONFIG['charset']);
            if ($CONFIG['enable_smilies']) {
                include_once("include/smilies.inc.php");
                $row['msg_body'] = process_smilies($row['msg_body']);
            }
            echo  htmlspecialchars ("<p>" . bb_decode($row['msg_body']) . "&nbsp;</p>", ENT_COMPAT, $CONFIG['charset']);
        }

        print "\n\t\t</content>\n";
        print "\t</entry>\n";
        print "\n";
    }

    print "</feed>";
}
