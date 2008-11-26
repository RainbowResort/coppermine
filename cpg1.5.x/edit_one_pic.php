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
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

define('IN_COPPERMINE', true);
define('EDITPICS_PHP', true);
require('include/init.inc.php');

// Include the JS for versioncheck.php
js_include('js/jquery.autogrow.js');
js_include('js/edit_one_pic.js');

// Define the icons
$icon_array = array();
$icon_array['album_properties'] = cpg_fetch_icon('modifyalb', 2);
$icon_array['thumbnail_view'] = cpg_fetch_icon('thumbnails', 2);
$icon_array['file_info'] = cpg_fetch_icon('info', 2);
$icon_array['album'] = cpg_fetch_icon('alb_mgr', 2);
$icon_array['move'] = cpg_fetch_icon('move', 2);
$icon_array['title'] = cpg_fetch_icon('title', 2);
$icon_array['file_name'] = cpg_fetch_icon('filename', 2);
$icon_array['description'] = cpg_fetch_icon('text_left', 2);
$icon_array['keyword'] = cpg_fetch_icon('keyword_mgr', 2);
$icon_array['file_approval'] = cpg_fetch_icon('file_approval', 2);
$icon_array['file_approve'] = cpg_fetch_icon('file_approve', 2);
$icon_array['file_disapprove'] = cpg_fetch_icon('file_disapprove', 2);
$icon_array['exif'] = cpg_fetch_icon('exif_mgr', 2);
$icon_array['reset_views'] = cpg_fetch_icon('stats_delete', 2);
$icon_array['reset_votes'] = cpg_fetch_icon('blank', 2);
$icon_array['delete_comments'] = cpg_fetch_icon('comment_approval', 2);
$icon_array['ok'] = cpg_fetch_icon('ok', 2);



if ($superCage->get->keyExists('id')) {
    $pid = $superCage->get->getInt('id');
} elseif ($superCage->post->keyExists('id')){
	$pid = $superCage->post->getInt('id');
} else {
	$pid = -1;
}

function process_post_data()
{
    global $CONFIG, $mb_utf8_regex;
    global $lang_errors, $lang_editpics_php;

    $superCage = Inspekt::makeSuperCage();

    $pid = $superCage->post->getInt('id');
    $aid = $superCage->post->getInt('aid');
    $pwight = $superCage->post->getInt('pwidth');
    $pheight = $superCage->post->getInt('pheight');
    $title = cpgSanitizeUserTextInput($superCage->post->getEscaped('title'));
    $caption = cpgSanitizeUserTextInput($superCage->post->getEscaped('caption'));
    $keywords = cpgSanitizeUserTextInput(utf_replace($superCage->post->getEscaped('keywords')));
    $user1 = cpgSanitizeUserTextInput($superCage->post->getEscaped('user1'));
    $user2 = cpgSanitizeUserTextInput($superCage->post->getEscaped('user2'));
    $user3 = cpgSanitizeUserTextInput($superCage->post->getEscaped('user3'));
    $user4 = cpgSanitizeUserTextInput($superCage->post->getEscaped('user4'));

    $galleryicon = $superCage->post->getInt('galleryicon');
    $isgalleryicon = ($galleryicon===$pid);

    if ($superCage->post->keyExists('read_exif')){
    	$read_exif = $superCage->post->getInt('read_exif');
    }

    if ($superCage->post->keyExists('reset_vcount')){
		$reset_vcount = $superCage->post->getInt('reset_vcount');
    }

    if ($superCage->post->keyExists('reset_votes')){
		$reset_votes = $superCage->post->getInt('reset_votes');
    }

    if ($superCage->post->keyExists('del_comments')){
		$del_comments = $superCage->post->getInt('del_comments') || $delete;
    }

    $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p, {$CONFIG['TABLE_ALBUMS']} AS a WHERE a.aid = p.aid AND pid = '$pid'");
    if (!mysql_num_rows($result)) cpg_die(CRITICAL_ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
    $pic = mysql_fetch_array($result);
    mysql_free_result($result);

    if (!(GALLERY_ADMIN_MODE || $pic['category'] == FIRST_USER_CAT + USER_ID || ($CONFIG['users_can_edit_pics'] && $pic['owner_id'] == USER_ID)) || !USER_ID) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

    $update  = "aid = '".$aid."'";
    if (is_movie($pic['filename'])) {
        $update .= ", pwidth = ".$pwidth;
        $update .= ", pheight = ".$pheight;
    }
    $update .= ", title = '".$title."'";
    $update .= ", caption = '".$caption."'";
    $update .= ", keywords = '".$keywords."'";

    if (GALLERY_ADMIN_MODE) {
      $approved = $superCage->post->getAlpha('approved');
      $update .= ", approved = '".$approved."'";
    }

    $update .= ", user1 = '".$user1."'";
    $update .= ", user2 = '".$user2."'";
    $update .= ", user3 = '".$user3."'";
    $update .= ", user4 = '".$user4."'";

    if ($isgalleryicon && $pic['category']>FIRST_USER_CAT) {
            $sql = 'update '.$CONFIG['TABLE_PICTURES'].' set galleryicon=0 where owner_id='.$pic['owner_id'].';';
            cpg_db_query($sql);
            $update .= ", galleryicon = ".$galleryicon;
    }

    if ($reset_vcount) {
        $update .= ", hits = '0'";
        resetDetailHits($pid);
    }
    if ($reset_votes) {
        $update .= ", pic_rating = '0', votes = '0'";
        resetDetailVotes($pid);
    }
    if ($read_exif) {
        $filepath = urldecode(get_pic_url($pic, 'fullsize'));

        // If read exif info again is checked then we will just delete the entry from exif table. The new exif information will automatically be read when someone views the image.
        $query = "DELETE FROM {$CONFIG['TABLE_EXIF']} WHERE filename = '$filepath'";
        cpg_db_query($query);
    }

    if ($del_comments) {
        $query = "DELETE FROM {$CONFIG['TABLE_COMMENTS']} WHERE pid='$pid'";
        $result =cpg_db_query($query);

    } else {
        $query = "UPDATE {$CONFIG['TABLE_PICTURES']} SET $update WHERE pid='$pid' LIMIT 1";
        $result = cpg_db_query($query);
    }

    // rename a file
    if ($superCage->post->keyExists('filename') && $matches = $superCage->post->getMatched('filename','/^[0-9A-Za-z\/_.-]+$/')){
    		$post_filename = $matches[0];
    }

    if ($post_filename != $pic['filename']) {
        if($CONFIG['thumb_use']=='ht' && $pic['pheight'] > $CONFIG['picture_width']) {
            $condition = true;
        } elseif ($CONFIG['thumb_use']=='wd' && $pic['pwidth'] > $CONFIG['picture_width']){
            $condition = true;
        } elseif ($CONFIG['thumb_use']=='any' && max($pic['pwidth'], $pic['pheight']) > $CONFIG['picture_width']){
            $condition = true;
        } else {
            $condition = false;
        }

        if ($CONFIG['make_intermediate'] && $condition ) {
            $prefices = array('fullsize', 'normal', 'thumb');
        } else {
            $prefices = array('fullsize', 'thumb');
        }

        if ($CONFIG['enable_watermark'] == '1' && ($CONFIG['which_files_to_watermark'] == 'both' || $CONFIG['which_files_to_watermark'] == 'original')) {
            $prefices[] = 'orig';
        }

        if (!is_image($pic['filename'])){
            $prefices = array('fullsize');
        }

        foreach ($prefices as $prefix)
        {
            $oldname = urldecode(get_pic_url($pic, $prefix));
            $filename = replace_forbidden($post_filename);
            $newname = str_replace($pic['filename'], $filename, $oldname);

            $old_mime = cpg_get_type($oldname);
            $new_mime = cpg_get_type($newname);

            if (($old_mime['mime'] != $new_mime['mime']) && isset($new_mime['mime']))
                cpg_die(CRITICAL_ERROR, sprintf($lang_editpics_php['mime_conv'], $old_mime['mime'], $new_mime['mime']), __FILE__, __LINE__);

            if (!is_known_filetype($newname))
                cpg_die(CRITICAL_ERROR, $lang_editpics_php['forb_ext'], __FILE__, __LINE__);

            if (file_exists($newname))
                cpg_die(CRITICAL_ERROR, sprintf($lang_editpics_php['file_exists'], $newname), __FILE__, __LINE__);

            if (!file_exists($oldname))
                cpg_die(CRITICAL_ERROR, sprintf($lang_editpics_php['src_file_missing'], $oldname), __FILE__, __LINE__);

            if (rename($oldname, $newname))
            {
                cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET filename = '$filename' WHERE pid = '$pid' LIMIT 1");
            } else cpg_die(CRITICAL_ERROR, sprintf($lang_editpics_php['rename_failed'], $oldname, $newname), __FILE__, __LINE__);
        }
    }
}

function get_user_albums($user_id = '')
{
        global $CONFIG, $USER_ALBUMS_ARRAY, $user_albums_list;

        if ($user_id != '') {
                $or = " OR category='" . (FIRST_USER_CAT + $user_id) . "'";
        }

        if (!isset($USER_ALBUMS_ARRAY[USER_ID])) {
                $user_albums = cpg_db_query("SELECT aid, title FROM {$CONFIG['TABLE_ALBUMS']} WHERE category='".(FIRST_USER_CAT + USER_ID)."' $or ORDER BY title");

                if (mysql_num_rows($user_albums)) {
                    $user_albums_list=cpg_db_fetch_rowset($user_albums);
                } else {
                        $user_albums_list = array();
                }
                mysql_free_result($user_albums);
                $USER_ALBUMS_ARRAY[USER_ID] = $user_albums_list;
        } else {
                $user_albums_list = &$USER_ALBUMS_ARRAY[USER_ID];
        }
}

function form_alb_list_box()
{
        global $CONFIG, $CURRENT_PIC;
        global $user_albums_list, $public_albums_list, $lang_editpics_php, $lang_common, $icon_array;
        $sel_album = $CURRENT_PIC['aid'];

        echo <<<EOT
                <tr>
                        <td class="tableb" style="white-space: nowrap;">
                                {$icon_array['album']}{$lang_common['album']}
                </td>
                <td class="tableb" valign="top">
                                {$icon_array['move']}<select name="aid" class="listbox">
EOT;
                foreach($public_albums_list as $album) {
        echo '              <option value="' . $album['aid'] . '"' . ($album['aid'] == $sel_album ? ' selected="selected"' : '') . '>' . $album['cat_title'] . "</option>\n";
    }
                foreach($user_albums_list as $album){
                        echo '                        <option value="'.$album['aid'].'"'.($album['aid'] == $sel_album ? ' selected="selected"' : '').'>* '.$album['title'] . "</option>\n";
                }
        echo <<<EOT
                                </select>
                        </td>
                </tr>

EOT;
}

if ($superCage->post->keyExists('submitDescription')) process_post_data();
$result = cpg_db_query("SELECT *, p.title AS title, p.votes AS votes FROM {$CONFIG['TABLE_PICTURES']} AS p, {$CONFIG['TABLE_ALBUMS']} AS a WHERE a.aid = p.aid AND pid = '$pid'");
$CURRENT_PIC = mysql_fetch_array($result);
mysql_free_result($result);

if (!(GALLERY_ADMIN_MODE || $CURRENT_PIC['category'] == FIRST_USER_CAT + USER_ID || ($CONFIG['users_can_edit_pics'] && $CURRENT_PIC['owner_id'] == USER_ID)) || !USER_ID) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

pageheader($lang_editpics_php['edit_pics']);

$thumb_url = get_pic_url($CURRENT_PIC, 'thumb');
$thumb_link = 'displayimage.php?pos='.(-$CURRENT_PIC['pid']);
$filename = htmlspecialchars($CURRENT_PIC['filename']);
$filepath = htmlspecialchars($CURRENT_PIC['filepath']);

$THUMB_ROWSPAN=6;
if ($CONFIG['user_field1_name'] != '') $THUMB_ROWSPAN++;
if ($CONFIG['user_field2_name'] != '') $THUMB_ROWSPAN++;
if ($CONFIG['user_field3_name'] != '') $THUMB_ROWSPAN++;
if ($CONFIG['user_field4_name'] != '') $THUMB_ROWSPAN++;


if (GALLERY_ADMIN_MODE) {
//    $public_albums = cpg_db_query("SELECT DISTINCT aid, title, IF(category = 0, CONCAT('&gt; ', title), CONCAT(name,' &lt; ',title)) AS cat_title FROM {$CONFIG['TABLE_ALBUMS']}, {$CONFIG['TABLE_CATEGORIES']} WHERE category < '" . FIRST_USER_CAT . "' AND (category = 0 OR category = cid) ORDER BY cat_title");  // albums weren't coming up in the list when there were no cats
    $public_albums = cpg_db_query("SELECT DISTINCT aid, title, IF(category = 0, CONCAT('&gt; ', title), CONCAT(name,' &lt; ',title)) AS cat_title FROM {$CONFIG['TABLE_ALBUMS']} LEFT JOIN {$CONFIG['TABLE_CATEGORIES']} ON category = cid WHERE category < '" . FIRST_USER_CAT . "' ORDER BY cat_title");
} else {
        $forbidden_set_alt = $FORBIDDEN_SET ? 'AND ' . str_replace('p.', '', $FORBIDDEN_SET) : '';
//    $public_albums = cpg_db_query("SELECT DISTINCT aid, title, IF(category = 0, CONCAT('&gt; ', title), CONCAT(name,' &lt; ',title)) AS cat_title FROM {$CONFIG['TABLE_ALBUMS']} LEFT JOIN {$CONFIG['TABLE_CATEGORIES']} ON category = cid WHERE category < '" . FIRST_USER_CAT . "' AND uploads = 'YES' $forbidden_set_alt ORDER BY cat_title"); //when user edited own image and no album was uploadable album list was empty
        $public_albums = cpg_db_query("SELECT DISTINCT aid, title, IF(category = 0, CONCAT('&gt; ', title), CONCAT(name,' &lt; ',title)) AS cat_title FROM {$CONFIG['TABLE_ALBUMS']} LEFT JOIN {$CONFIG['TABLE_CATEGORIES']} ON category = cid WHERE (category < '" . FIRST_USER_CAT . "' AND uploads = 'YES' $forbidden_set_alt) OR aid='{$CURRENT_PIC['aid']}' ORDER BY cat_title");
}

if (mysql_num_rows($public_albums)) {
        $public_albums_list=cpg_db_fetch_rowset($public_albums);
} else {
        $public_albums_list = array();
}

if (GALLERY_ADMIN_MODE && $CURRENT_PIC['owner_id'] != USER_ID) {
  get_user_albums($CURRENT_PIC['owner_id']);
} else {
  get_user_albums();
}

echo <<<EOT
<form name="editonepicform" id="cpgform" method="post" action="edit_one_pic.php">
<input type="hidden" name="id" value="{$CURRENT_PIC['pid']}" />
EOT;

starttable("100%", cpg_fetch_icon('edit', 2) . $lang_editpics_php[edit_pic], 3);

//$pic_info = sprintf($lang_editpics_php['pic_info_str'], $CURRENT_PIC['pwidth'], $CURRENT_PIC['pheight'], ($CURRENT_PIC['filesize'] >> 10), $CURRENT_PIC['hits'], $CURRENT_PIC['votes']);

if (!is_movie($CURRENT_PIC['filename'])) {
        $pic_info = sprintf($lang_editpics_php['pic_info_str'], $CURRENT_PIC['pwidth'], $CURRENT_PIC['pheight'], ($CURRENT_PIC['filesize'] >> 10), $CURRENT_PIC['hits'], $CURRENT_PIC['votes']);
} else {
        $pic_info = sprintf($lang_editpics_php['pic_info_str'], '<input type="text" name="pwidth" value="'.$CURRENT_PIC['pwidth'].'" size="5" maxlength="5" class="textinput" />', '<input type="text" name="pheight" value="'.$CURRENT_PIC['pheight'].'" size="5" maxlength="5" class="textinput" />', ($CURRENT_PIC['filesize'] >> 10), $CURRENT_PIC['hits'], $CURRENT_PIC['votes']);
}

if (defined('UPLOAD_APPROVAL_MODE')) {
        if ($CURRENT_PIC['owner_name']){
                $pic_info .= ' - <a href ="profile.php?uid='.$CURRENT_PIC['owner_id'].'" target="_blank">'.$CURRENT_PIC['owner_name'].'</a>';
        }
}

print <<<EOT
        <tr>
            <td class="tableh2" colspan="3">
                    <strong>{$filename}</strong>
                    &nbsp;&nbsp;-&nbsp;&nbsp;<a href="modifyalb.php?album={$CURRENT_PIC['aid']}" class="admin_menu">{$icon_array['album_properties']}{$lang_editpics_php['album_properties']}</a>&nbsp;&nbsp;-&nbsp;&nbsp;
            <a href="thumbnails.php?album={$CURRENT_PIC['aid']}" class="admin_menu">{$icon_array['thumbnail_view']}{$lang_editpics_php['thumbnail_view']}</a>
            </td>
        </tr>
        <tr>
            <td class="tableb" style="white-space:nowrap;">
                    {$icon_array['file_info']}{$lang_editpics_php['pic_info']}
            </td>
            <td class="tableb">
                    $pic_info
            </td>
            <td class="tableb" align="center" rowspan="$THUMB_ROWSPAN">
                <a href="$thumb_link"><img src="$thumb_url" class="image" border="0" alt="{$CURRENT_PIC['title']}"/></a><br />
            </td>
        </tr>
EOT;

form_alb_list_box();

if ($CONFIG['show_bbcode_help']) {$captionLabel = '&nbsp;'. cpg_display_help('f=index.html&amp;base=64&amp;h='.urlencode(base64_encode(serialize($lang_bbcode_help_title))).'&amp;t='.urlencode(base64_encode(serialize($lang_bbcode_help))),470,245);}

print <<<EOT
        <tr>
                <td class="tableb" style="white-space: nowrap;">
                        {$icon_array['title']}{$lang_common['title']}
                </td>
                <td width="100%" class="tableb" valign="top">
                                <input type="text" style="width: 100%" name="title" maxlength="255" value="{$CURRENT_PIC['title']}" class="textinput" />
                        </td>
        </tr>

        <tr>
                        <td class="tableb" style="white-space: nowrap;">
                        {$icon_array['file_name']}{$lang_common['filename']}
                </td>
                <td width="100%" class="tableb" valign="top">
                                <tt>{$CONFIG['site_url']}{$CONFIG['fullpath']}{$filepath}</tt><input type="text" name="filename" maxlength="255" size="40" value="{$CURRENT_PIC['filename']}" class="textinput" />
                        </td>
        </tr>

        <tr>
                        <td class="tableb" valign="top" style="white-space: nowrap;">
                                {$icon_array['description']}{$lang_editpics_php['desc']}$captionLabel
                        </td>
                        <td class="tableb" valign="top">
                                <textarea name="caption" rows="1" cols="60" class="textinput autogrow" onkeydown="textCounter(this, {$CONFIG['max_img_desc_length']});" onkeyup="textCounter(this, {$CONFIG['max_img_desc_length']});">{$CURRENT_PIC['caption']}</textarea>
                        </td>
        </tr>
        <tr>
                        <td class="tableb" style="white-space: nowrap;">
                                {$icon_array['keyword']}{$lang_common['keywords_insert1']}<br /><a href="#" onClick="return MM_openBrWindow('keyword_select.php','selectKey','width=250, height=400, scrollbars=yes,toolbar=no,status=yes,resizable=yes')">{$lang_common['keywords_insert2']}</a>
                </td>
                <td width="100%" class="tableb" valign="top">
                                <input type="text" style="width: 100%" name="keywords" maxlength="255" value="{$CURRENT_PIC['keywords']}" id="keywords" class="textinput" />
                        </td>
        </tr>
EOT;

if (GALLERY_ADMIN_MODE) {
  $checkYes = ($CURRENT_PIC['approved'] == 'YES') ? 'checked="checked"' : '';
  $checkNo = ($CURRENT_PIC['approved'] == 'NO') ? 'checked="checked"' : '';

  echo <<<EOT
        <tr>
            <td class="tableb" style="white-space: nowrap;">
                        {$icon_array['file_approval']}{$lang_editpics_php['approval']}
        </td>
        <td width="100%" class="tableb" valign="top">
                <input type="radio" id="approved_yes" name="approved" value="YES" $checkYes /><label for="approved_yes" class="clickable_option">{$icon_array['file_approve']}{$lang_editpics_php['approved']}</label>&nbsp;&nbsp;
                <input type="radio" id="approved_no" name="approved" value="NO" $checkNo /><label for="approved_no" class="clickable_option">{$icon_array['file_disapprove']}{$lang_editpics_php['disapproved']}</label>
                </td>
        </tr>
EOT;

}
if ($CONFIG['user_field1_name'] != ''){
echo <<<EOT
        <tr>
            <td class="tableb" style="white-space: nowrap;">
                {$CONFIG['user_field1_name']}
                </td>
                <td width="100%" class="tableb" valign="top">
                                <input type="text" style="width: 100%" name="user1" maxlength="255" value="{$CURRENT_PIC['user1']}" class="textinput" />
                        </td>
        </tr>
EOT;
}
if ($CONFIG['user_field2_name'] != ''){
echo <<<EOT
        <tr>
            <td class="tableb" style="white-space: nowrap;">
                {$CONFIG['user_field2_name']}
                </td>
                <td width="100%" class="tableb" valign="top">
                <input type="text" style="width: 100%" name="user2" maxlength="255" value="{$CURRENT_PIC['user2']}" class="textinput" />
                        </td>
        </tr>
EOT;
}if ($CONFIG['user_field3_name'] != ''){
echo <<<EOT
        <tr>
            <td class="tableb" style="white-space: nowrap;">
                {$CONFIG['user_field3_name']}
                </td>
                <td width="100%" class="tableb" valign="top">
                <input type="text" style="width: 100%" name="user3" maxlength="255" value="{$CURRENT_PIC['user3']}" class="textinput" />
                        </td>
        </tr>
EOT;
}if ($CONFIG['user_field4_name'] != ''){
echo <<<EOT
        <tr>
            <td class="tableb" style="white-space: nowrap;">
                {$CONFIG['user_field4_name']}
                </td>
                <td width="100%" class="tableb" valign="top">
                <input type="text" style="width: 100%" name="user4" maxlength="255" value="{$CURRENT_PIC['user4']}" class="textinput" />
                        </td>
        </tr>
EOT;
}

// If this is the users gallery icon then check it
$isgalleryicon_selected = ($CURRENT_PIC['galleryicon']) ? 'checked="checked" ': '';
$isgalleryicon_disabled = ($CURRENT_PIC['category'] < FIRST_USER_CAT)? 'disabled="disabled" ':'';
print <<<EOT
        <tr>
                        <td class="tableb" colspan="3" align="center">
                                                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                                <tr>
                                                                        <td width="20%" align="center"><input type="checkbox" name="galleryicon" id="galleryicon" {$isgalleryicon_selected}{$isgalleryicon_disabled}value="{$CURRENT_PIC['pid']}" class="checkbox" /><label for="galleryicon">{$lang_editpics_php['gallery_icon']}</label></td>
                                                                        <td width="20%" align="center"><input type="checkbox" name="read_exif" id="read_exif" value="1" class="checkbox" /><label for="read_exif">{$icon_array['exif']}{$lang_editpics_php['read_exif']}</label></td>
                                                                        <td width="20%" align="center"><input type="checkbox" name="reset_vcount" id="reset_vcount" value="1" class="checkbox" /><label for="reset_vcount">{$icon_array['reset_views']}{$lang_editpics_php['reset_view_count']} ({$CURRENT_PIC['hits']})</label></td>
                                                                        <td width="20%" align="center"><input type="checkbox" name="reset_votes" id="reset_votes" value="1" class="checkbox" /><label for="reset_votes">{$icon_array['reset_votes']}{$lang_editpics_php['reset_votes']} ({$CURRENT_PIC['votes']})</label></td>
                                                                        <td width="20%" align="center"><input type="checkbox" name="del_comments" id="del_comments" value="1" class="checkbox" /><label for="del_comments">{$icon_array['delete_comments']}{$lang_editpics_php['del_comm']}</label></td>
                                                                </tr>
                                                        </table>
                        </td>
        </tr>
        <tr>
                        <td colspan="3" align="center" class="tablef">
                                <button type="submit" class="button" name="submitDescription" value="{$lang_common['apply_changes']}">{$icon_array['ok']}{$lang_common['apply_changes']}</button>
                        </td>
        </tr>
EOT;

endtable();
echo '</form>';
pagefooter();
ob_end_flush();
?>