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

define('IN_COPPERMINE', true);
define('DISPLAYIMAGE_PHP', true);
define('INDEX_PHP', true);
//define('SMILIES_PHP', true);

require('include/init.inc.php');

if ($CONFIG['enable_smilies']) include("include/smilies.inc.php");

$breadcrumb = '';
$breadcrumb_text = '';
$cat_data = array();

if($CONFIG['read_exif_data'] ){
        include("include/exif_php.inc.php");
}
if($CONFIG['read_iptc_data'] ){
        include("include/iptc.inc.php");
}


/**
 * Local functions definition
 */

function html_picture_menu($id)
{
    global $lang_display_image_php;

    return <<<EOT
     <a href="#" onclick="return MM_openBrWindow('picEditor.php?id=$id','Crop_Picture','scrollbars=yes,toolbar=no,status=yes,resizable=yes')" class="admin_menu" >{$lang_display_image_php['crop_pic']}</a> <a href="editOnePic.php?id=$id&amp;what=picture"  class="admin_menu">{$lang_display_image_php['edit_pic']}</a> <a href="delete.php?id=$id&amp;what=picture"  class="admin_menu" onclick="return confirm('{$lang_display_image_php['confirm_del']}'); return false; ">{$lang_display_image_php['del_pic']}</a>

EOT;
}
// Prints the image-navigation menu
function html_img_nav_menu()
{
    global $CONFIG, $CURRENT_PIC_DATA, $meta_nav ; //$PHP_SELF,
    global $album, $cat, $pos, $pic_count, $lang_img_nav_bar, $lang_text_dir, $template_img_navbar;

    $cat_link = is_numeric($album) ? '' : '&amp;cat=' . $cat;

    $human_pos = $pos + 1;
    $page = ceil(($pos + 1) / ($CONFIG['thumbrows'] * $CONFIG['thumbcols']));
    $pid = $CURRENT_PIC_DATA['pid'];

    if ($pos > 0) {
        $prev = $pos - 1;
        $prev_tgt = "{$_SERVER['PHP_SELF']}?album=$album$cat_link&amp;pos=$prev";
        $prev_title = $lang_img_nav_bar['prev_title'];
                $meta_nav .= "<link rel=\"prev\" href=\"$prev_tgt\" title=\"$prev_title\" />
                ";
    } else {
        $prev_tgt = "javascript:;";
        $prev_title = "";
    }
    if ($pos < ($pic_count -1)) {
        $next = $pos + 1;
        $next_tgt = "{$_SERVER['PHP_SELF']}?album=$album$cat_link&amp;pos=$next";
        $next_title = $lang_img_nav_bar['next_title'];
                $meta_nav .= "<link rel=\"next\" href=\"$next_tgt\" title=\"$next_title\"/>
                ";
    } else {
        $next_tgt = "javascript:;";
        $next_title = "";
    }

    if (USER_CAN_SEND_ECARDS) {
        $ecard_tgt = "ecard.php?album=$album$cat_link&amp;pid=$pid&amp;pos=$pos";
        $ecard_title = $lang_img_nav_bar['ecard_title'];
    } else {
        template_extract_block($template_img_navbar, 'ecard_button'); // added to remove button if cannot send ecard
        /*$ecard_tgt = "javascript:alert('" . addslashes($lang_img_nav_bar['ecard_disabled_msg']) . "');";
        $ecard_title = $lang_img_nav_bar['ecard_disabled'];*/
    }

                //report to moderator buttons
    if ($CONFIG['report_post']==1) {
                                $report_tgt = "report_file.php?album=$album$cat_link&amp;pid=$pid&amp;pos=$pos";
    } else { // remove button if report toggle is off
        template_extract_block($template_img_navbar, 'report_file_button');

    }

                    $thumb_tgt = "thumbnails.php?album=$album$cat_link&amp;page=$page";
        $meta_nav .= "<link rel=\"up\" href=\"$thumb_tgt\" title=\"".$lang_img_nav_bar['thumb_title']."\"/>
        ";

    $slideshow_tgt = "{$_SERVER['PHP_SELF']}?album=$album$cat_link&amp;pid=$pid&amp;slideshow=".$CONFIG['slideshow_interval'];

    $pic_pos = sprintf($lang_img_nav_bar['pic_pos'], $human_pos, $pic_count);

    $params = array('{THUMB_TGT}' => $thumb_tgt,
        '{THUMB_TITLE}' => $lang_img_nav_bar['thumb_title'],
        '{PIC_INFO_TITLE}' => $lang_img_nav_bar['pic_info_title'],
        '{SLIDESHOW_TGT}' => $slideshow_tgt,
        '{SLIDESHOW_TITLE}' => $lang_img_nav_bar['slideshow_title'],
        '{PIC_POS}' => $pic_pos,
        '{ECARD_TGT}' => $ecard_tgt,
        '{ECARD_TITLE}' => $ecard_title,
                                '{PREV_TGT}' => $prev_tgt,
        '{PREV_TITLE}' => $prev_title,
        '{NEXT_TGT}' => $next_tgt,
        '{NEXT_TITLE}' => $next_title,
        '{PREV_IMAGE}' => ($lang_text_dir=='ltr') ? 'prev' : 'next',
        '{NEXT_IMAGE}' => ($lang_text_dir=='ltr') ? 'next' : 'prev',
        '{REPORT_TGT}' => $report_tgt,
        '{REPORT_TITLE}' => $lang_img_nav_bar['report_title'],
        );

    return template_eval($template_img_navbar, $params);
}
// Displays a picture
function html_picture()
{
    global $CONFIG, $CURRENT_PIC_DATA, $CURRENT_ALBUM_DATA, $USER;
    global $album, $comment_date_fmt, $template_display_picture;
    global $lang_display_image_php, $lang_picinfo;

    $pid = $CURRENT_PIC_DATA['pid'];

    if (!isset($USER['liv']) || !is_array($USER['liv'])) {
        $USER['liv'] = array();
    }
    // Add 1 to hit counter
    if (!USER_IS_ADMIN && $album != "lasthits" && !in_array($pid, $USER['liv']) && isset($_COOKIE[$CONFIG['cookie_name'] . '_data'])) {
        add_hit($pid);
        if (count($USER['liv']) > 4) array_shift($USER['liv']);
        array_push($USER['liv'], $pid);
    }

    if($CONFIG['thumb_use']=='ht' && $CURRENT_PIC_DATA['pheight'] > $CONFIG['picture_width'] ){ // The wierd comparision is because only picture_width is stored
      $condition = true;
    }elseif($CONFIG['thumb_use']=='wd' && $CURRENT_PIC_DATA['pwidth'] > $CONFIG['picture_width']){
      $condition = true;
    }elseif($CONFIG['thumb_use']=='any' && max($CURRENT_PIC_DATA['pwidth'], $CURRENT_PIC_DATA['pheight']) > $CONFIG['picture_width']){
      $condition = true;
    }else{
     $condition = false;
    }

    if ($CURRENT_PIC_DATA['title'] != '') {
        $pic_title .= $CURRENT_PIC_DATA['title'] . "\n";
    }
    if ($CURRENT_PIC_DATA['caption'] != '') {
        $pic_title .= $CURRENT_PIC_DATA['caption'] . "\n";
    }
    if ($CURRENT_PIC_DATA['keywords'] != '') {
        $pic_title .= $lang_picinfo['Keywords'] . ": " . $CURRENT_PIC_DATA['keywords'];
    }

    if (!$CURRENT_PIC_DATA['title'] && !$CURRENT_PIC_DATA['caption']) {
        template_extract_block($template_display_picture, 'img_desc');
    } else {
        if (!$CURRENT_PIC_DATA['title']) {
            template_extract_block($template_display_picture, 'title');
        }
        if (!$CURRENT_PIC_DATA['caption']) {
            template_extract_block($template_display_picture, 'caption');
        }
    }

    $CURRENT_PIC_DATA['menu'] = ((USER_ADMIN_MODE && $CURRENT_ALBUM_DATA['category'] == FIRST_USER_CAT + USER_ID) || GALLERY_ADMIN_MODE) ? html_picture_menu($pid) : '';

    if ($CONFIG['make_intermediate'] && $condition ) {
        $picture_url = get_pic_url($CURRENT_PIC_DATA, 'normal');
    } else {
        $picture_url = get_pic_url($CURRENT_PIC_DATA, 'fullsize');
    }

    $image_size = compute_img_size($CURRENT_PIC_DATA['pwidth'], $CURRENT_PIC_DATA['pheight'], $CONFIG['picture_width']);

    $pic_title = '';
    $mime_content = cpg_get_type($CURRENT_PIC_DATA['filename']);

    if ($CURRENT_PIC_DATA['pwidth']==0 || $CURRENT_PIC_DATA['pheight']==0) {
        $image_size['geom']='';
        $image_size['whole'] = '';
    } elseif ($mime_content['content']=='movie' || $mime_content['content']=='audio') {
        $ctrl_offset['mov']=15;
        $ctrl_offset['wmv']=45;
        $ctrl_offset['swf']=0;
        $ctrl_offset['rm']=0;
        $ctrl_offset_default=45;
        $ctrl_height = (isset($ctrl_offset[$mime_content['extension']]))?($ctrl_offset[$mime_content['extension']]):$ctrl_offset_default;
        $image_size['whole']='width="'.$CURRENT_PIC_DATA['pwidth'].'" height="'.($CURRENT_PIC_DATA['pheight']+$ctrl_height).'"';
    }

    if ($mime_content['content']=='image') {
        if (isset($image_size['reduced'])) {
            $winsizeX = $CURRENT_PIC_DATA['pwidth'] + 16;
            $winsizeY = $CURRENT_PIC_DATA['pheight'] + 16;
            $pic_html = "<a href=\"javascript:;\" onclick=\"MM_openBrWindow('displayimage.php?pid=$pid&amp;fullsize=1','" . uniqid(rand()) . "','scrollbars=yes,toolbar=yes,status=yes,resizable=yes,width=$winsizeX,height=$winsizeY')\">";
            $pic_title = $lang_display_image_php['view_fs'] . "\n==============\n" . $pic_title;
            $pic_html .= "<img src=\"" . $picture_url . "\" class=\"image\" border=\"0\" alt=\"{$lang_display_image_php['view_fs']}\" /><br />";
            $pic_html .= "</a>\n";
        } else {
            $pic_html = "<img src=\"" . $picture_url . "\" {$image_size['geom']} class=\"image\" border=\"0\" alt=\"\" /><br />\n";
        }
    } elseif ($mime_content['content']=='document') {
        $pic_thumb_url = get_pic_url($CURRENT_PIC_DATA,'thumb');
        $pic_html = "<a href=\"{$picture_url}\" target=\"_blank\" class=\"document_link\"><img src=\"".$pic_thumb_url."\" border=\"0\" class=\"image\" /></a>\n<br />";
    } else {
                   $autostart = ($CONFIG['mv_autostart']) ? ('true'):('false');
            $pic_html = "<object {$image_size['whole']}><param name=\"autostart\" value=\"$autostart\"><param name=\"src\" value=\"". $picture_url . "\"><embed {$image_size['whole']} src=\"". $picture_url . "\" autostart=\"$autostart\"></embed></object><br />\n";
    }

    $CURRENT_PIC_DATA['html'] = $pic_html;
    $CURRENT_PIC_DATA['header'] = '';
    $CURRENT_PIC_DATA['footer'] = '';

    $CURRENT_PIC_DATA = CPGPluginAPI::filter('file_data',$CURRENT_PIC_DATA);

    $params = array('{CELL_HEIGHT}' => '100',
        '{IMAGE}' => $CURRENT_PIC_DATA['header'].$CURRENT_PIC_DATA['html'].$CURRENT_PIC_DATA['footer'],
        '{ADMIN_MENU}' => $CURRENT_PIC_DATA['menu'],
        '{TITLE}' => $CURRENT_PIC_DATA['title'],
        '{CAPTION}' => bb_decode($CURRENT_PIC_DATA['caption']),
        );

    return template_eval($template_display_picture, $params);
}

function html_rating_box()
{
    global $CONFIG, $CURRENT_PIC_DATA, $CURRENT_ALBUM_DATA;
    global $template_image_rating, $lang_rate_pic;

    if (!(USER_CAN_RATE_PICTURES && $CURRENT_ALBUM_DATA['votes'] == 'YES')) return '';

    $votes = $CURRENT_PIC_DATA['votes'] ? sprintf($lang_rate_pic['rating'], round($CURRENT_PIC_DATA['pic_rating'] / 2000, 1), $CURRENT_PIC_DATA['votes']) : $lang_rate_pic['no_votes'];
    $pid = $CURRENT_PIC_DATA['pid'];

    $params = array('{TITLE}' => $lang_rate_pic['rate_this_pic'],
        '{VOTES}' => $votes,
        '{RATE0}' => "ratepic.php?pic=$pid&amp;rate=0",
        '{RATE1}' => "ratepic.php?pic=$pid&amp;rate=1",
        '{RATE2}' => "ratepic.php?pic=$pid&amp;rate=2",
        '{RATE3}' => "ratepic.php?pic=$pid&amp;rate=3",
        '{RATE4}' => "ratepic.php?pic=$pid&amp;rate=4",
        '{RATE5}' => "ratepic.php?pic=$pid&amp;rate=5",
        '{RUBBISH}' => $lang_rate_pic['rubbish'],
        '{POOR}' => $lang_rate_pic['poor'],
        '{FAIR}' => $lang_rate_pic['fair'],
        '{GOOD}' => $lang_rate_pic['good'],
        '{EXCELLENT}' => $lang_rate_pic['excellent'],
        '{GREAT}' => $lang_rate_pic['great'],
        );

    return template_eval($template_image_rating, $params);
}
// Display picture information
function html_picinfo()
{
    global $CONFIG, $CURRENT_PIC_DATA, $CURRENT_ALBUM_DATA, $THEME_DIR, $FAVPICS;
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
    $info[$lang_picinfo['Album name']] = '<span class="alblink">' . $owner_link . $ipinfo . '<a href="thumbnails.php?album=' . $CURRENT_PIC_DATA['aid'] . '">' . $CURRENT_ALBUM_DATA['title'] . '</a></span>';

    if ($CURRENT_PIC_DATA['votes'] > 0) {
        if (defined('THEME_HAS_RATING_GRAPHICS')) {
            $prefix = $THEME_DIR;
        } else {
            $prefix = '';
        }
        if (GALLERY_ADMIN_MODE) {
          $width = 978;
          $height = 504;
        } else {
          $width = 418;
          $height = 232;
        }

        $detailsLink = $CONFIG['vote_details'] ? ' (<a href="#" onclick="MM_openBrWindow(\'voteDetails.php?pid='.$CURRENT_PIC_DATA['pid'].'\',\'\',\'resizable=no,width='.$width.',height='.$height.',top=50,left=50,scrollbars=yes\'); return false;">'.$lang_picinfo['details'].'</a>)' : '';
        $info[sprintf($lang_picinfo['Rating'], $CURRENT_PIC_DATA['votes'])] = '<img src="' . $prefix . 'images/rating' . round($CURRENT_PIC_DATA['pic_rating'] / 2000) . '.gif" align="middle" alt="" />'.$detailsLink;
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
    $detailsLink = ($CURRENT_PIC_DATA['hits'] && $CONFIG['vote_details'] && GALLERY_ADMIN_MODE) ? ' (<a href="#" onclick="MM_openBrWindow(\'hitDetails.php?pid='.$CURRENT_PIC_DATA['pid'].'\',\'\',\'resizable=no,width=978,height=504,top=50,left=50,scrollbars=yes\'); return false;">'.$lang_picinfo['details'].'</a>)' : '';
    $info[$lang_picinfo['Displayed']] = sprintf($lang_display_image_php['views'], $CURRENT_PIC_DATA['hits']);
    $info[$lang_picinfo['Displayed']] .= $detailsLink;

    $path_to_pic = $CONFIG['fullpath'] . $CURRENT_PIC_DATA['filepath'] . $CURRENT_PIC_DATA['filename'];

    if ($CONFIG['read_exif_data']) $exif = exif_parse_file($path_to_pic);

    if (isset($exif) && is_array($exif)) {
        $info = array_merge($info,$exif);
    }

    if ($CONFIG['read_iptc_data']) $iptc = get_IPTC($path_to_pic);

    if (isset($iptc) && is_array($iptc)) {
        if (isset($iptc['Title'])) $info[$lang_picinfo['iptcTitle']] = trim($iptc['Title']);
        if (isset($iptc['Copyright'])) $info[$lang_picinfo['iptcCopyright']] = trim($iptc['Copyright']);
        if (isset($iptc['Keywords'])) $info[$lang_picinfo['iptcKeywords']] = trim(implode(" ",$iptc['Keywords']));
        if (isset($iptc['Category'])) $info[$lang_picinfo['iptcCategory']] = trim($iptc['Category']);
        if (isset($iptc['SubCategories'])) $info[$lang_picinfo['iptcSubCategories']] = trim(implode(" ",$iptc['SubCategories']));
    }
    // Create the absolute URL for display in info
    $info[$lang_picinfo['URL']] = '<a href="' . $CONFIG["ecards_more_pic_target"] . (substr($CONFIG["ecards_more_pic_target"], -1) == '/' ? '' : '/') .basename($_SERVER['PHP_SELF']) . "?pos=-$CURRENT_PIC_DATA[pid]" . '" >' . $CONFIG["ecards_more_pic_target"] . (substr($CONFIG["ecards_more_pic_target"], -1) == '/' ? '' : '/') . basename($_SERVER['PHP_SELF']) . "?pos=-$CURRENT_PIC_DATA[pid]" . '</a>';
    // with subdomains the variable is $_SERVER["SERVER_NAME"] does not return the right value instead of using a new config variable I reused $CONFIG["ecards_more_pic_target"] no trailing slash in the configure
    // Create the add to fav link
    if (!in_array($CURRENT_PIC_DATA['pid'], $FAVPICS)) {
        $info[$lang_picinfo['addFavPhrase']] = "<a href=\"addfav.php?pid=" . $CURRENT_PIC_DATA['pid'] . "\" >" . $lang_picinfo['addFav'] . '</a>';
    } else {
        $info[$lang_picinfo['addFavPhrase']] = "<a href=\"addfav.php?pid=" . $CURRENT_PIC_DATA['pid'] . "\" >" . $lang_picinfo['remFav'] . '</a>';
    }

    /**
     * Filter file information
     */
    $info = CPGPluginAPI::filter('file_info',$info);

    return theme_html_picinfo($info);
}
// Displays comments for a specific picture
function html_comments($pid)
{
    global $CONFIG, $USER, $CURRENT_ALBUM_DATA, $comment_date_fmt, $HTML_SUBST;
    global $template_image_comments, $template_add_your_comment, $lang_display_comments;

    $html = '';

//report to moderator buttons
    if ($CONFIG['report_post']==1) {
                                $report_comment_tgt = "report_file.php?msg_id={MSG_ID}&what=comment";
    } else { // remove buttons if report toggle is off
        template_extract_block($template_image_comments, 'report_comment_button');
    }

    if (!$CONFIG['enable_smilies']) {
        $tmpl_comment_edit_box = template_extract_block($template_image_comments, 'edit_box_no_smilies', '{EDIT}');
        template_extract_block($template_image_comments, 'edit_box_smilies');
        template_extract_block($template_add_your_comment, 'input_box_smilies');
    } else {
        $tmpl_comment_edit_box = template_extract_block($template_image_comments, 'edit_box_smilies', '{EDIT}');
        template_extract_block($template_image_comments, 'edit_box_no_smilies');
        template_extract_block($template_add_your_comment, 'input_box_no_smilies');
    }

    $tmpl_comments_buttons = template_extract_block($template_image_comments, 'buttons', '{BUTTONS}');
    $tmpl_comments_ipinfo = template_extract_block($template_image_comments, 'ipinfo', '{IPINFO}');

    if ($CONFIG['comments_sort_descending'] == 1) {
        $comment_sort_order = 'DESC';
    } else {
        $comment_sort_order = 'ASC';
    }
    $result = cpg_db_query("SELECT msg_id, msg_author, msg_body, UNIX_TIMESTAMP(msg_date) AS msg_date, author_id, author_md5_id, msg_raw_ip, msg_hdr_ip FROM {$CONFIG['TABLE_COMMENTS']} WHERE pid='$pid' ORDER BY msg_id $comment_sort_order");

    while ($row = mysql_fetch_array($result)) {
        $user_can_edit = (GALLERY_ADMIN_MODE) || (USER_ID && USER_ID == $row['author_id'] && USER_CAN_POST_COMMENTS) || (!USER_ID && USER_CAN_POST_COMMENTS && ($USER['ID'] == $row['author_md5_id']));
        $comment_buttons = $user_can_edit ? $tmpl_comments_buttons : '';
        $comment_edit_box = $user_can_edit ? $tmpl_comment_edit_box : '';
        $comment_ipinfo = ($row['msg_raw_ip'] && GALLERY_ADMIN_MODE)?$tmpl_comments_ipinfo : '';

        if ($CONFIG['enable_smilies']) {
            $comment_body = process_smilies(make_clickable($row['msg_body']));
            $smilies = generate_smilies("f{$row['msg_id']}", 'msg_body');
        } else {
            $comment_body = make_clickable($row['msg_body']);
            $smilies = '';
        }

        $params = array('{EDIT}' => &$comment_edit_box,
            '{BUTTONS}' => &$comment_buttons,
            '{IPINFO}' => &$comment_ipinfo
            );

        $template = template_eval($template_image_comments, $params);

        $params = array('{MSG_AUTHOR}' => $row['msg_author'],
            '{MSG_ID}' => $row['msg_id'],
            '{EDIT_TITLE}' => &$lang_display_comments['edit_title'],
            '{CONFIRM_DELETE}' => &$lang_display_comments['confirm_delete'],
            '{MSG_DATE}' => localised_date($row['msg_date'], $comment_date_fmt),
            '{MSG_BODY}' => &$comment_body,
            '{MSG_BODY_RAW}' => $row['msg_body'],
            '{OK}' => &$lang_display_comments['OK'],
            '{SMILIES}' => $smilies,
            '{HDR_IP}' => $row['msg_hdr_ip'],
            '{RAW_IP}' => $row['msg_raw_ip'],
            '{REPORT_COMMENT_TGT}' => $report_comment_tgt,
			'{REPORT_COMMENT_TITLE}' => &$lang_display_comments['report_comment_title'],
            );

        $html .= template_eval($template, $params);
    }

    if (USER_CAN_POST_COMMENTS && $CURRENT_ALBUM_DATA['comments'] == 'YES') {
        if (USER_ID) {
            $user_name_input = '<input type="hidden" name="msg_author" value="' . USER_NAME . '" />';
            template_extract_block($template_add_your_comment, 'user_name_input', $user_name_input);
            $user_name = '';
        } else {
            $user_name = isset($USER['name']) ? '"' . strtr($USER['name'], $HTML_SUBST) . '"' : '"' . $lang_display_comments['your_name'] . '" onclick="javascript:this.value=\'\';"';
        }

        $params = array('{ADD_YOUR_COMMENT}' => $lang_display_comments['add_your_comment'],
            // Modified Name and comment field
            '{NAME}' => $lang_display_comments['name'],
            '{COMMENT}' => $lang_display_comments['comment'],
            '{PIC_ID}' => $pid,
            '{USER_NAME}' => $user_name,
            '{MAX_COM_LENGTH}' => $CONFIG['max_com_size'],
            '{OK}' => $lang_display_comments['OK'],
            '{SMILIES}' => '',
            );

        if ($CONFIG['enable_smilies']) $params['{SMILIES}'] = generate_smilies();

        $html .= template_eval($template_add_your_comment, $params);
    }

    return $html;
}
// Display the full size image
function display_fullsize_pic()
{
    global $CONFIG, $THEME_DIR, $ALBUM_SET;
    global $lang_errors, $lang_fullsize_popup, $lang_charset;

    if (function_exists('theme_display_fullsize_pic')) {
        theme_display_fullsize_pic();
        return;
    }

    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php echo $CONFIG['gallery_name'] ?>: <?php echo $lang_fullsize_popup['click_to_close'];
    ?></title>
<meta http-equiv="content-type" content="text/html; charset=<?php echo $CONFIG['charset'] == 'language file' ? $lang_charset : $CONFIG['charset'] ?>" />
<link rel="stylesheet" href="<?php echo $THEME_DIR ?>style.css" />
<script type="text/javascript" src="scripts.js"></script>
</head>
<body class="tableb" scroll="auto" marginwidth="0" marginheight="0">
<script language="JavaScript" type="text/JavaScript">
adjust_popup();
</script>

<table width="100%" border="0" cellpadding="0" cellspacing="2">
 <td align="center" valign="middle">
  <table cellspacing="2" cellpadding="0" style="border: 1px solid #000000; background-color: #FFFFFF;">
   <td>
<?php
    if (isset($_GET['picfile'])) {
        if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

        $picfile = $_GET['picfile'];
        $picname = $CONFIG['fullpath'] . $picfile;
        $imagesize = @getimagesize($picname);
        echo "<a href=\"javascript: window.close()\"><img src=\"" . path2url($picname) . "\" $imagesize[3] class=\"image\" border=\"0\" alt=\"\" title=\"$picfile\n" . $lang_fullsize_popup['click_to_close'] . "\" /></a><br />\n";
    } elseif (isset($_GET['pid'])) {
        $pid = (int)$_GET['pid'];
        $sql = "SELECT * " . "FROM {$CONFIG['TABLE_PICTURES']} " . "WHERE pid='$pid' $ALBUM_SET";
        $result = cpg_db_query($sql);

        if (!mysql_num_rows($result)) cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);

        $row = mysql_fetch_array($result);
        $pic_url = get_pic_url($row, 'fullsize');
        $geom = 'width="' . $row['pwidth'] . '" height="' . $row['pheight'] . '"';
               echo "<a href=\"javascript: window.close()\"><img src=\"" . $pic_url . "\" $geom class=\"image\" border=\"0\" alt=\"\" title=\"" . htmlspecialchars($row['filename']) . "\n" . $lang_fullsize_popup['click_to_close'] . "\" /></a><br />\n";
    }

    ?>
   </td>
  </table>
 </td>
</table>
</body>
</html>
<?php
}

function slideshow()
{
    global $CONFIG, $lang_display_image_php, $template_display_picture;

    if (function_exists('theme_slideshow')) {
        theme_slideshow();
        return;
    }

    pageheader($lang_display_image_php['slideshow']);

    include "include/slideshow.inc.php";

    $start_slideshow = '<script language="JavaScript" type="text/JavaScript">runSlideShow()</script>';
    template_extract_block($template_display_picture, 'img_desc', $start_slideshow);

    $params = array('{CELL_HEIGHT}' => $CONFIG['picture_width'] + 100,
        '{IMAGE}' => '<img src="' . $start_img . '" name="SlideShow" class="image" /><br />',
        '{ADMIN_MENU}' => '',
        );

    starttable();
    echo template_eval($template_display_picture, $params);
    endtable();
    starttable();
    echo <<<EOT
        <tr>
                <td align="center" class="navmenu" style="white-space: nowrap;">
                        <a href="javascript:endSlideShow()" class="navmenu">{$lang_display_image_php['stop_slideshow']}</a>
                </td>
        </tr>

EOT;
    endtable();
    pagefooter();
}

function get_subcat_data($parent, $level)
{
    global $CONFIG, $ALBUM_SET_ARRAY;

    $result = cpg_db_query("SELECT cid, name, description FROM {$CONFIG['TABLE_CATEGORIES']} WHERE parent = '$parent'");
    if (mysql_num_rows($result) > 0) {
        $rowset = cpg_db_fetch_rowset($result);
        foreach ($rowset as $subcat) {
            $result = cpg_db_query("SELECT aid FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = {$subcat['cid']}");
            $album_count = mysql_num_rows($result);
            while ($row = mysql_fetch_array($result)) {
                $ALBUM_SET_ARRAY[] = $row['aid'];
            } // while
        }
        if ($level > 1) get_subcat_data($subcat['cid'], $level -1);
    }
}

/**
 * Main code
 */

$pos = isset($_GET['pos']) ? (int)$_GET['pos'] : 0;

/**
 * Hack added by tarique to prevent incorrect picture being seen on last view or last uploaded
 */

$pid = isset($_GET['pid']) ? (int)$_GET['pid'] : 0;

$cat = isset($_GET['cat']) ? (int)$_GET['cat'] : 0;
$album = isset($_GET['album']) ? $_GET['album'] : '';
// Build the album set if required
if (!is_numeric($album) && $cat) { // Meta albums, we need to restrict the albums to the current category
    if ($cat < 0) {
        $ALBUM_SET .= 'AND aid IN (' . (- $cat) . ') ';
    } else {
        $ALBUM_SET_ARRAY = array();
        if ($cat == USER_GAL_CAT)
            $where = 'category > ' . FIRST_USER_CAT;
        else
            $where = "category = '$cat'";

        $result = cpg_db_query("SELECT aid FROM {$CONFIG['TABLE_ALBUMS']} WHERE $where");
        while ($row = mysql_fetch_array($result)) {
            $ALBUM_SET_ARRAY[] = $row['aid'];
        } // while
        get_subcat_data($cat, $CONFIG['subcat_level']);
        // Treat the album set
        if (count($ALBUM_SET_ARRAY)) {
            $set = '';
            foreach ($ALBUM_SET_ARRAY as $album_id) $set .= ($set == '') ? $album_id : ',' . $album_id;
            $ALBUM_SET .= "AND aid IN ($set) ";
        }
    }
}
// Retrieve data for the current picture
if ($pos < 0 || $pid > 0) {
    $pid = ($pos < 0) ? -$pos : $pid;
    $result = cpg_db_query("SELECT aid from {$CONFIG['TABLE_PICTURES']} WHERE pid='$pid' $ALBUM_SET LIMIT 1");
    if (mysql_num_rows($result) == 0) cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
    $row = mysql_fetch_array($result);
    $album = $row['aid'];
    $pic_data = get_pic_data($album, $pic_count, $album_name, -1, -1, false);
    for($pos = 0; $pic_data[$pos]['pid'] != $pid && $pos < $pic_count; $pos++);
    $pic_data = get_pic_data($album, $pic_count, $album_name, $pos, 1, false);
    $CURRENT_PIC_DATA = $pic_data[0];

} elseif (isset($_GET['pos'])) {
    $pic_data = get_pic_data($album, $pic_count, $album_name, $pos, 1, false);
    if ($pic_count == 0) {
        cpg_die(INFORMATION, $lang_errors['no_img_to_display'], __FILE__, __LINE__);
    } elseif (count($pic_data) == 0 && $pos >= $pic_count) {
        $pos = $pic_count - 1;
        $human_pos = $pos + 1;
        $pic_data = get_pic_data($album, $pic_count, $album_name, $pos, 1, false);
    }
    $CURRENT_PIC_DATA = $pic_data[0];
}

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

if (isset($_GET['fullsize'])) {
    display_fullsize_pic();
    ob_end_flush();
} elseif (isset($_GET['slideshow'])) {
    slideshow();
    ob_end_flush();
} else {
    if (!isset($_GET['pos'])) cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
    $picture_title = $CURRENT_PIC_DATA['title'] ? $CURRENT_PIC_DATA['title'] : strtr(preg_replace("/(.+)\..*?\Z/", "\\1", htmlspecialchars($CURRENT_PIC_DATA['filename'])), "_", " ");

    $nav_menu = html_img_nav_menu();
    $picture = html_picture();
    $votes = html_rating_box();
    $pic_info = html_picinfo();
    $comments = html_comments($CURRENT_PIC_DATA['pid']);
    if ($CURRENT_PIC_DATA['keywords']) { $meta_keywords = "<meta name=\"keywords\" content=\"".$CURRENT_PIC_DATA['keywords']."\"/>"; }
        $meta_nav .= "<link rel=\"alternate\" type=\"text/xml\" title=\"RSS feed\" href=\"rss.php\" />
        ";
        $meta_keywords .= $meta_nav;
    pageheader($album_name . '/' . $picture_title, $meta_keywords, false);
    // Display Breadcrumbs
    if ($breadcrumb && !(strpos($CONFIG['main_page_layout'],"breadcrumb")===false)) {
        theme_display_breadcrumb($breadcrumb, $cat_data);
    }
    // Display Filmstrip if the album is not search
    if ($album != 'search') {
        $film_strip = display_film_strip($album, (isset($cat) ? $cat : 0), $pos, true);
    }
    theme_display_image($nav_menu, $picture, $votes, $pic_info, $comments, $film_strip);
    pagefooter();
    ob_end_flush();
}

?>