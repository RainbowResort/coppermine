<?php
/**************************************************
  Coppermine 1.4.x Plugin - EnlargeIt! $VERSION$=2.15
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ***************************************************/

define('IN_COPPERMINE', true);
define('DISPLAYIMAGE_PHP', true);
define('INDEX_PHP', true);
//define('SMILIES_PHP', true);

require('include/init.inc.php');

global $lang_enlargeit;

if (!USER_ID && $CONFIG['allow_unlogged_access'] == 0) {
    $redirect = $redirect . "login.php";
    header("Location: $redirect");
    exit();
}

if ($CONFIG['enable_smilies']) include("include/smilies.inc.php");

$breadcrumb = '';
$breadcrumb_text = '';
$cat_data = array();


$enlargeit_add_your_comment = <<<EOT
        <form method="post" name="post" action="index.php?file=enl_addcomment">
                <table align="center" width="100%" cellspacing="1" cellpadding="0" style="width:100%;">
                        <tr>
                                        <td width="100%" class="enl_infotablehead"><b>{ADD_YOUR_COMMENT}</b></td>
                        </tr>
                        <tr>
                <td colspan="1">
                        <table width="100%" cellpadding="0" cellspacing="0">

<!-- BEGIN user_name_input -->
                                                        <tr>
                                                                <td class="enl_infotable">
                                        {NAME}
                                </td>
                                <td class="enl_infotable">
                                        <input type="text" class="enl_textinput" name="msg_author" onselect="{{ENL_JSNAME}}" onclick="{{ENL_JSNAME}}" onkeyup="{{ENL_JSNAME}}" size="10" maxlength="20" value="{USER_NAME}" />
                                </td>
<!-- END user_name_input -->
<!-- BEGIN input_box_smilies -->
                                <td class="enl_infotable">
                                {COMMENT}
                                                                </td>
                                <td width="100%" class="enl_infotable">
                                <input type="text" class="enl_textinput" id="message" name="msg_body" onselect="{{ENL_JSCOMMENT}}" onclick="{{ENL_JSCOMMENT}}" onkeyup="{{ENL_JSCOMMENT}}" maxlength="{MAX_COM_LENGTH}" style="width: 100%;" />
                                                                </td>
<!-- END input_box_smilies -->
<!-- BEGIN input_box_no_smilies -->
                                <td class="enl_infotable">
                                {COMMENT}
                                                                </td>
                                <td width="100%" class="enl_infotable">
                                <input type="text" class="enl_textinput" id="message" name="msg_body" onselect="{{ENL_JSCOMMENT}}" onclick="{{ENL_JSCOMMENT}}" onkeyup="{{ENL_JSCOMMENT}}" maxlength="{MAX_COM_LENGTH}" style="width: 100%;" />
                                </td>
<!-- END input_box_no_smilies -->
                                <td class="enl_infotable">
                                <input type="hidden" name="event" value="comment" />
                                <input type="hidden" name="pid" value="{PIC_ID}" />
                                <input type="submit" class="enl_commentbutton" name="submit" value="{OK}" onclick="{{ENL_JSSUBMIT}}" />
                                </td>
                                                        </tr>
                        </table>
                </td>
        </tr>
<!-- BEGIN smilies -->
        <tr>
                <td width="100%" class="enl_infotable">
                        {SMILIES}
                </td>
        </tr>
<!-- END smilies -->
                </table>
        </form>
EOT;


$enlargeit_image_comments = <<<EOT
<table align="center" width="100%" cellspacing="0" cellpadding="0" style="width:100%;">

        <tr>
                <td>
                        <table width="100%" cellpadding="0" cellspacing="0">
                           <tr>
                                <td class="enl_commenthead" nowrap="nowrap">
                                        <b>{MSG_AUTHOR}</b><a name="comment{MSG_ID}"></a>&nbsp;
<!-- BEGIN ipinfo -->
                                                                                 ({IP})
<!-- END ipinfo -->
</td>


                                <td class="enl_commenthead" align="right" width="100%">

<!-- BEGIN report_comment_button -->
<!-- END report_comment_button -->
<!-- BEGIN buttons -->
                                        
                                        <a href="javascript:;" ><img src="plugins/enlargeit/rating/delete.gif" name="index.php?file=enlargeit/enl_delete&msg_id={MSG_ID}&what=comment&enl_img={{ENL_IMG}}" onclick="enl_ajaxfollow(this);" border="0" align="middle" /></a>
<!-- END buttons -->
                                </td>
                                <td class="enl_commenthead" align="right" nowrap="nowrap">
                                        <span class="enl_commentdate">[{MSG_DATE}]</span>
                                </td></tr>
                        </table>
                </td>
        </tr>
        <tr>
                <td class="enl_infotable">

                                {MSG_BODY}

<!-- BEGIN edit_box_smilies -->
<!-- END edit_box_smilies -->
<!-- BEGIN edit_box_no_smilies -->
<!-- END edit_box_no_smilies -->
                </td>
        </tr>
</table>
EOT;

$enlargeit_image_comments = str_replace('{{ENL_IMG}}',$_GET['enl_img'],$enlargeit_image_comments);

/**
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

function enlargeit_html_comments($pid)
{
    global $CONFIG, $USER, $CURRENT_ALBUM_DATA, $comment_date_fmt, $HTML_SUBST;
    global $enlargeit_image_comments, $enlargeit_add_your_comment, $lang_display_comments;

    $html = '';

    // report to moderator buttons


        $tmpl_comment_edit_box = template_extract_block($enlargeit_image_comments, 'edit_box_smilies', '{EDIT}');
        template_extract_block($enlargeit_image_comments, 'edit_box_no_smilies');
        template_extract_block($enlargeit_add_your_comment, 'input_box_no_smilies');


    $tmpl_comments_buttons = template_extract_block($enlargeit_image_comments, 'buttons', '{BUTTONS}');
    $tmpl_comments_ipinfo = template_extract_block($enlargeit_image_comments, 'ipinfo', '{IPINFO}');

    if ($CONFIG['comments_sort_descending'] == 1) {
        $comment_sort_order = 'DESC';
    } else {
        $comment_sort_order = 'ASC';
    }
    $result = cpg_db_query("SELECT msg_id, msg_author, msg_body, UNIX_TIMESTAMP(msg_date) AS msg_date, author_id, author_md5_id, msg_raw_ip, msg_hdr_ip, pid FROM {$CONFIG['TABLE_COMMENTS']} WHERE pid='$pid' ORDER BY msg_id $comment_sort_order");

    while ($row = mysql_fetch_array($result)) {
        $user_can_edit = (GALLERY_ADMIN_MODE) || (USER_ID && USER_ID == $row['author_id'] && USER_CAN_POST_COMMENTS) || (!USER_ID && USER_CAN_POST_COMMENTS && ($USER['ID'] == $row['author_md5_id']));
        $comment_buttons = $user_can_edit ? $tmpl_comments_buttons : '';
        $comment_edit_box = '';
        $comment_ipinfo = ($row['msg_raw_ip'] && GALLERY_ADMIN_MODE)?$tmpl_comments_ipinfo : '';


            $comment_body = make_clickable($row['msg_body']);
            $smilies = '';


        $ip = $row['msg_hdr_ip'];
        if ($row['msg_hdr_ip'] != $row['msg_raw_ip']) {
            $ip .= ' [' . $row['msg_raw_ip'] . ']';
        }

        $params = array('{EDIT}' => &$comment_edit_box,
            '{BUTTONS}' => &$comment_buttons,
            '{IPINFO}' => &$comment_ipinfo
            );

        $template = template_eval($enlargeit_image_comments, $params);

        $params = array('{MSG_AUTHOR}' => stripslashes($row['msg_author']),
            '{MSG_ID}' => $row['msg_id'],
            '{PID}' => $row['pid'],
            '{EDIT_TITLE}' => &$lang_display_comments['edit_title'],
            '{CONFIRM_DELETE}' => &$lang_display_comments['confirm_delete'],
            '{MSG_DATE}' => localised_date($row['msg_date'], $comment_date_fmt),
            '{MSG_BODY}' => bb_decode($comment_body),
            '{MSG_BODY_RAW}' => $row['msg_body'],
            '{OK}' => &$lang_display_comments['OK'],
            '{SMILIES}' => '',
            '{IP}' => $ip,
            '{REPORT_COMMENT_TITLE}' => &$lang_display_comments['report_comment_title'],
            '{WIDTH}' => $CONFIG['picture_table_width']
            );

        $html .= template_eval($template, $params);
    }

    if (USER_CAN_POST_COMMENTS && $CURRENT_ALBUM_DATA['comments'] == 'YES') {
        if (USER_ID) {
            $user_name_input = '<tr><td><input type="hidden" name="msg_author" value="" /></td>';
            template_extract_block($enlargeit_add_your_comment, 'user_name_input', $user_name_input);
            $user_name = '';
        } else {
            if (isset($USER['name'])) {
              $user_name = strtr($USER['name'], $HTML_SUBST);
            } else {
              $user_name = $lang_display_comments['your_name'];
            }
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
            '{WIDTH}' => $CONFIG['picture_table_width'],
            );


                        template_extract_block($enlargeit_add_your_comment, 'smilies');


        $html .= template_eval($enlargeit_add_your_comment, $params);
    }

    return $html;
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


//get_meta_album_set in functions.inc.php will populate the $ALBUM_SET instead; matches $META_ALBUM_SET.
get_meta_album_set($cat,$ALBUM_SET);
$META_ALBUM_SET = $ALBUM_SET; //displayimage uses $ALBUM_SET but get_pic_data in functions now uses $META_ALBUM_SET

//attempt to fix topn images for keyworded albums
if ($cat < 0) {
    $result = cpg_db_query("SELECT category, title, aid, keyword, description, alb_password_hint FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid='" . (- $cat) . "'");
    if (mysql_num_rows($result) > 0) {
        $CURRENT_ALBUM_DATA = mysql_fetch_array($result);
        $CURRENT_ALBUM_KEYWORD = $CURRENT_ALBUM_DATA['keyword'];
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

    if (!isset($_GET['pos'])) cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);

$enlargeit_add_your_comment = str_replace('{{ENL_JSCOMMENT}}',"enl_geto('".$_GET['enl_img']."').commenttext = encodeURIComponent(this.value);",$enlargeit_add_your_comment);
$enlargeit_add_your_comment = str_replace('{{ENL_JSNAME}}',"if (this.value == '".$lang_display_comments['your_name']."') this.value='';enl_geto('".$_GET['enl_img']."').commentname = encodeURIComponent(this.value);",$enlargeit_add_your_comment);
$enlargeit_add_your_comment = str_replace('{{ENL_JSSUBMIT}}',"this.name='index.php?file=enlargeit/enl_addcomment&enl_img=".$_GET['enl_img']."&amp;pos=".$_GET['pos']."&amp;msg_author='+enl_geto('".$_GET['enl_img']."').commentname+'&amp;msg_body='+enl_geto('".$_GET['enl_img']."').commenttext+'&amp;event=comment&amp;rnd=".rand(1,9999)."';enl_geto('".$_GET['enl_img']."').commenttext='';enl_geto('".$_GET['enl_img']."').commentname='';enl_ajaxfollow(this);return false;",$enlargeit_add_your_comment);



    $comments = enlargeit_html_comments($CURRENT_PIC_DATA['pid']);

if ($comments) {
	

	echo $comments;
}
else
{
	echo '<table cellspacing="1" style="width:100%;height:100%">';
  echo '<tr>';
  echo '<td class="enl_infotablehead" align="center"><b>'.$lang_enlargeit['enl_cantcomment'].'</b><br />';
  echo '</td>';
  echo '</tr>';
  echo '</table>';
}
?>