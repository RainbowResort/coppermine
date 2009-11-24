<?php
/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt!
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.2
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

require('include/init.inc.php');

if (!USER_ID && $CONFIG['allow_unlogged_access'] == 0) {
    cpg_die(ERROR, $lang_errors['access_none'], __FILE__, __LINE__);
}

if($CONFIG['read_exif_data'] ){
        include("include/exif_php.inc.php");
}
if($CONFIG['read_iptc_data'] ){
        include("include/iptc.inc.php");
}

/*
 * Local functions definition
 */

# Sanitize the data - to fix the XSS vulnerability - Aditya
function sanitize_data(&$value, $key)
{
        if (is_array($value)) {
                array_walk($value, 'sanitize_data');
        } else {
                # sanitize against sql/html injection; trim any nongraphical non-ASCII character:
                $value = trim(htmlentities(strip_tags(trim($value,"\x7f..\xff\x0..\x1f")),ENT_QUOTES));
        }
}

// Display picture information
function html_picinfo()
{
    global $CONFIG, $CURRENT_PIC_DATA, $CURRENT_ALBUM_DATA, $THEME_DIR, $FAVPICS, $REFERER;
    global $album, $lang_picinfo, $lang_display_image_php, $lang_byte_units, $lastup_date_fmt;

    if ($CURRENT_PIC_DATA['owner_id'] && $CURRENT_PIC_DATA['owner_name']) {
        $owner_link = '<a href ="profile.php?uid=' . $CURRENT_PIC_DATA['owner_id'] . '">' . $CURRENT_PIC_DATA['owner_name'] . '</a> ';
    } else {
        $owner_link = '';
    }

    if (GALLERY_ADMIN_MODE && $CURRENT_PIC_DATA['pic_raw_ip']) {
        if ($CURRENT_PIC_DATA['pic_hdr_ip']) {
            $ipinfo = ' (' . $CURRENT_PIC_DATA['pic_hdr_ip'] . '[' . $CURRENT_PIC_DATA['pic_raw_ip'] . ']) / ';
        } else {
            $ipinfo = ' (' . $CURRENT_PIC_DATA['pic_raw_ip'] . ') / ';
        }
    } else {
        if ($owner_link) {
            $ipinfo = '/ ';
        } else {
            $ipinfo = '';
        }
    }

    $info[$lang_picinfo['Filename']] = htmlspecialchars($CURRENT_PIC_DATA['filename']);
    $info[$lang_picinfo['Album name']] = '<span class="alblink">' . $owner_link . '/ <a href="thumbnails.php?album=' . $CURRENT_PIC_DATA['aid'] . '">' . $CURRENT_ALBUM_DATA['title'] . '</a></span>';

    if ($CURRENT_PIC_DATA['votes'] > 0) {
        if (defined('THEME_HAS_RATING_GRAPHICS')) {
            $prefix = $THEME_DIR;
        } else {
            $prefix = '';
        }
        if (GALLERY_ADMIN_MODE) {
          $width = 800;
          $height = 500;
        } else {
          $width = 400;
          $height = 250;
        }

        $detailsLink = $CONFIG['vote_details'] ? ' (<a href="#" onclick="MM_openBrWindow(\'stat_details.php?type=vote&amp;pid='.$CURRENT_PIC_DATA['pid'].'&amp;sort=sdate&amp;dir=&amp;sdate=1&amp;ip=1&amp;rating=1&amp;referer=1&amp;browser=1&amp;os=1\',\'\',\'resizable=yes,width='.$width.',height='.$height.',top=50,left=50,scrollbars=yes\'); return false;">'.$lang_picinfo['details'].'</a>)' : '';
        $info[sprintf($lang_picinfo['Rating'], $CURRENT_PIC_DATA['votes'])] = '<img width="65" height="14" src="plugins/enlargeit/rating/rating' . round($CURRENT_PIC_DATA['pic_rating'] / 2000) . '.gif" align="middle" alt="" />'.$detailsLink;
    }

    if ($CURRENT_PIC_DATA['keywords'] != "") {
        $info[$lang_picinfo['Keywords']] = '<span class="alblink">' . preg_replace("/(\S+)/", "<a href=\"thumbnails.php?album=search&amp;search=\\1\">\\1</a>" , $CURRENT_PIC_DATA['keywords']) . '</span>';
    }

    for ($i = 1; $i <= 4; $i++) {
        if ($CONFIG['user_field' . $i . '_name']) {
            if ($CURRENT_PIC_DATA['user' . $i] != "") {
                $info[$CONFIG['user_field' . $i . '_name']] = make_clickable($CURRENT_PIC_DATA['user' . $i]);
            }
        }
    }

    $info[$lang_picinfo['File Size']] = ($CURRENT_PIC_DATA['filesize'] > 10240 ? ($CURRENT_PIC_DATA['filesize'] >> 10) . '&nbsp;' . $lang_byte_units[1] : $CURRENT_PIC_DATA['filesize'] . '&nbsp;' . $lang_byte_units[0]);
    $info[$lang_picinfo['File Size']] = '<span dir="ltr">' . $info[$lang_picinfo['File Size']] . '</span>';
    $info[$lang_picinfo['Date Added']] = localised_date($CURRENT_PIC_DATA['ctime'],$lastup_date_fmt);
    $info[$lang_picinfo['Dimensions']] = sprintf($lang_display_image_php['size'], $CURRENT_PIC_DATA['pwidth'], $CURRENT_PIC_DATA['pheight']);
    $detailsLink = ($CURRENT_PIC_DATA['hits'] && $CONFIG['hit_details'] && GALLERY_ADMIN_MODE) ? ' (<a href="#" onclick="MM_openBrWindow(\'stat_details.php?type=hits&amp;pid='.$CURRENT_PIC_DATA['pid'].'&amp;sort=sdate&amp;dir=&amp;sdate=1&amp;ip=1&amp;search_phrase=1&amp;referer=1&amp;browser=1&amp;os=1\',\'\',\'resizable=yes,width=800,height=500,top=50,left=50,scrollbars=yes\'); return false;">'.$lang_picinfo['details'].'</a>)' : '';
    $info[$lang_picinfo['Displayed']] = sprintf($lang_display_image_php['views'], $CURRENT_PIC_DATA['hits']);
    $info[$lang_picinfo['Displayed']] .= $detailsLink;

    $path_to_pic = $CONFIG['fullpath'] . $CURRENT_PIC_DATA['filepath'] . $CURRENT_PIC_DATA['filename'];

    if ($CONFIG['read_exif_data']) $exif = exif_parse_file($path_to_pic);

    if (isset($exif) && is_array($exif)) {
                array_walk($exif, 'sanitize_data');
        $info = array_merge($info,$exif);
    }

    if ($CONFIG['read_iptc_data']) $iptc = get_IPTC($path_to_pic);

    if (isset($iptc) && is_array($iptc)) {
        array_walk($iptc, 'sanitize_data');
        if (!empty($iptc['Title'])) $info[$lang_picinfo['iptcTitle']] = $iptc['Title'];
        if (!empty($iptc['Copyright'])) $info[$lang_picinfo['iptcCopyright']] = $iptc['Copyright'];
        if (!empty($iptc['Keywords'])) $info[$lang_picinfo['iptcKeywords']] = implode(' ',$iptc['Keywords']);
        if (!empty($iptc['Category'])) $info[$lang_picinfo['iptcCategory']] = $iptc['Category'];
        if (!empty($iptc['SubCategories'])) $info[$lang_picinfo['iptcSubCategories']] = implode(' ',$iptc['SubCategories']);
    }


    /**
     * Filter file information
     */
    $info = CPGPluginAPI::filter('file_info',$info);

    return theme_html_picinfo($info);
}

/**
 * Main code
 */

$pid    = $superCage->get->getInt('pid');
$pos    = $superCage->get->getInt('pos');
$cat    = $superCage->get->getInt('cat');
$album  = $superCage->get->getInt('album');


//get_meta_album_set in functions.inc.php will populate the $ALBUM_SET instead; matches $META_ALBUM_SET.
get_meta_album_set($cat,$ALBUM_SET);
$META_ALBUM_SET = $ALBUM_SET; //displayimage uses $ALBUM_SET but get_pic_data in functions now uses $META_ALBUM_SET


// Retrieve data for the current picture
    $pid = ($pos < 0) ? -$pos : $pid;
    $result = cpg_db_query("SELECT aid from {$CONFIG['TABLE_PICTURES']} WHERE pid='$pid' $ALBUM_SET LIMIT 1");
    if (mysql_num_rows($result) == 0) cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
    $row = mysql_fetch_array($result);
    $album = $row['aid'];
    $pic_data = get_pic_data($album, $pic_count, $album_name, -1, -1, false);
    for($pos = 0; $pic_data[$pos]['pid'] != $pid && $pos < $pic_count; $pos++);
    $pic_data = get_pic_data($album, $pic_count, $album_name, $pos, 1, false);
    $CURRENT_PIC_DATA = $pic_data[0];



// Retrieve data for the current album
if (isset($CURRENT_PIC_DATA)) {
    $result = cpg_db_query("SELECT title, comments, votes, category, aid FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid='{$CURRENT_PIC_DATA['aid']}' LIMIT 1");
    if (!mysql_num_rows($result)) cpg_die(CRITICAL_ERROR, sprintf($lang_errors['pic_in_invalid_album'], $CURRENT_PIC_DATA['aid']), __FILE__, __LINE__);
    $CURRENT_ALBUM_DATA = mysql_fetch_array($result);

    if (is_numeric($album)) {
        $cat = - $album;
        $actual_cat = $CURRENT_ALBUM_DATA['category'];
        breadcrumb($actual_cat, $breadcrumb, $breadcrumb_text);
        $cat = - $album;
    } else {
        $actual_cat = $CURRENT_ALBUM_DATA['category'];
        breadcrumb($actual_cat, $breadcrumb, $breadcrumb_text);
    }
}

echo "<table align=\"center\" cellspacing=\"1\" style=\"width:100%;height:100%\">";

$test = html_picinfo();
$test = str_replace("tableb_compact","enl_infotable\" width=\"50%",$test);
$test = str_replace("tableh2_compact","enl_infotablehead\" align=\"center",$test);
$test = str_replace("valign=\"top\"","align=\"right\"",$test);
$test = str_replace(" class=\"alblink\"","",$test);
$kopf = '';

if ($CURRENT_PIC_DATA['title']) {
$kopf .= "<tr><td class=\"enl_infotable\" width=\"50%\" align=\"right\">";
$kopf .=  $lang_upload_php['pic_title'];
$kopf .=  ":</td><td class=\"enl_infotable\" width=\"50%\">";
$kopf .=  $CURRENT_PIC_DATA['title'];
$kopf .=  "</td></tr>";
}
if ($CURRENT_PIC_DATA['caption']) {
$kopf .=  "<tr><td class=\"enl_infotable\" width=\"50%\" align=\"right\">";
$kopf .=  $lang_upload_php['description'];
$kopf .=  ":</td><td class=\"enl_infotable\" width=\"50%\">";
$kopf .=  $CURRENT_PIC_DATA['caption'];
$kopf .=  "</td></tr>";
}
$kopf .=  "<tr><td class=\"enl_infotable\" width=\"50%\" align=\"right\" >".$lang_picinfo['Filename'];
$test = str_replace("<tr><td class=\"enl_infotable\" width=\"50%\" align=\"right\" >".$lang_picinfo['Filename'],$kopf,$test);

echo $test;
echo "</table>";

?>