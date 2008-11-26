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
define('PROFILE_PHP', true);
define('USERMGR_PHP', true);

require('include/init.inc.php');
include("include/smilies.inc.php");

//if (defined('UDB_INTEGRATION')){
  $cpg_udb->view_profile($superCage->get->getInt('uid'));
//}

$icon_array = array();
$icon_array['ok'] = cpg_fetch_icon('ok', 0);
$icon_array['password'] = cpg_fetch_icon('key_enter', 0);

function cpgUserPicCount($username) {
        global $CONFIG;
        $result = cpg_db_query("SELECT pid FROM {$CONFIG['TABLE_PICTURES']} WHERE owner_name = '".addslashes($username)."'");
        $pic_count = mysql_num_rows($result);
        mysql_free_result($result);
        return $pic_count;
}

function cpgUserThumb($uid) {
        global $CONFIG, $FORBIDDEN_SET;
        //if ($FORBIDDEN_SET != "") $FORBIDDEN_SET = "AND $FORBIDDEN_SET";
        $query = "SELECT count(*), MAX(pid) FROM {$CONFIG['TABLE_PICTURES']} AS p WHERE owner_id = '$uid' AND approved = 'YES' $FORBIDDEN_SET";
        $result = cpg_db_query($query);
        $nbEnr = mysql_fetch_array($result);
        $picture_count = $nbEnr[0];
        $thumb_pid = $nbEnr[1];
        mysql_free_result($result);

        $result = cpg_db_query("SELECT count(*) FROM {$CONFIG['TABLE_ALBUMS']} AS p WHERE category = '" . (FIRST_USER_CAT + $uid) . "' $FORBIDDEN_SET");
        $nbEnr = mysql_fetch_array($result);
        $album_count = $nbEnr[0];
        mysql_free_result($result);

        $user_thumb = '';
        if ($picture_count) {
            $sql = "SELECT filepath, filename, url_prefix, pwidth, pheight " . "FROM {$CONFIG['TABLE_PICTURES']} " . "WHERE pid='" . $thumb_pid . "'";
            $result = cpg_db_query($sql);
            if (mysql_num_rows($result)) {
                $picture = mysql_fetch_array($result);
                mysql_free_result($result);
                $pic_url =  get_pic_url($picture, 'thumb');
                if (!is_image($picture['filename'])) {
                        $image_info = cpg_getimagesize(urldecode($pic_url));
                        $picture['pwidth'] = $image_info[0];
                        $picture['pheight'] = $image_info[1];
                }
                $image_size = compute_img_size($picture['pwidth'], $picture['pheight'], $CONFIG['thumb_width']);
                $mime_content = cpg_get_type($picture['filename']);
                $user_thumb = '<img src="' . $pic_url . '" class="image"'
                                . $image_size['geom'] . ' border="0" alt="" />';
            }
        }
        return $user_thumb;
}

function cpgUserLastComment($uid) {
        global $CONFIG, $FORBIDDEN_SET;

        $result = cpg_db_query("SELECT count(*), MAX(msg_id) FROM {$CONFIG['TABLE_COMMENTS']} as c, {$CONFIG['TABLE_PICTURES']} as p WHERE c.pid = p.pid AND approval='YES' AND author_id = '$uid' $FORBIDDEN_SET");
        $nbEnr = mysql_fetch_array($result);
        $comment_count = $nbEnr[0];
        $lastcom_id = $nbEnr[1];
        mysql_free_result($result);

        $lastcom = '';
        if ($comment_count) {
            $sql = "SELECT filepath, filename, url_prefix, pwidth, pheight, msg_author, UNIX_TIMESTAMP(msg_date) as msg_date, msg_body, approval " . "FROM {$CONFIG['TABLE_COMMENTS']} AS c, {$CONFIG['TABLE_PICTURES']} AS p " . "WHERE msg_id='" . $lastcom_id . "' AND approval = 'YES' AND c.pid = p.pid";
            $result = cpg_db_query($sql);
            if (mysql_num_rows($result)) {
                $row = mysql_fetch_array($result);
                mysql_free_result($result);
                $pic_url =  get_pic_url($row, 'thumb');
                if (!is_image($row['filename'])) {
                        $image_info = cpg_getimagesize(urldecode($pic_url));
                        $row['pwidth'] = $image_info[0];
                        $row['pheight'] = $image_info[1];
                }
                $image_size = compute_img_size($row['pwidth'], $row['pheight'], $CONFIG['thumb_width']);
                $mime_content = cpg_get_type($row['filename']);
                $lastcom = '<img src="' . $pic_url . '" class="image"' . $image_size['geom'] . ' border="0" alt="" />';
            }
        }
        $lastComArray = array();
        $lastComArray['thumb'] = $lastcom;
        $lastComArray['comment'] = $row['msg_body'];
        $lastComArray['msg_date'] = $row['msg_date'];
        $lastComArray['count'] = $comment_count;
        return $lastComArray;
}

$edit_profile_form_param = array(
    array('text', 'username', cpg_fetch_icon('my_profile', 2) . $lang_register_php['username']),
    array('text', 'status', cpg_fetch_icon('online', 2) . $lang_usermgr_php['status']),
    array('text', 'reg_date', cpg_fetch_icon('calendar', 2) . $lang_register_php['reg_date']),
    array('text', 'group', cpg_fetch_icon('groups_mgr', 2) . $lang_register_php['group']),
    array('text', 'email', cpg_fetch_icon('mail', 2) . $lang_register_php['email'],255),
    array('input', 'user_profile1', $CONFIG['user_profile1_name'], 255),
    array('input', 'user_profile2', $CONFIG['user_profile2_name'], 255),
    array('input', 'user_profile3', $CONFIG['user_profile3_name'], 255),
    array('input', 'user_profile4', $CONFIG['user_profile4_name'], 255),
    array('input', 'user_profile5', $CONFIG['user_profile5_name'], 255),
    array('textarea', 'user_profile6', $CONFIG['user_profile6_name'], 255),
    array('text', 'disk_usage', cpg_fetch_icon('disk_usage', 2) . $lang_register_php['disk_usage']),
    );


if ($CONFIG['allow_email_change'] == 1 || GALLERY_ADMIN_MODE) {
	$edit_profile_form_param[3][0]='input';
} 

        // profile mod test
$display_profile_form_param = array(
    array('text', 'username', $lang_register_php['username']),
    array('text', 'status', $lang_usermgr_php['status']),
    array('text', 'reg_date', $lang_register_php['reg_date']),
    array('text', 'group', $lang_register_php['group']),
    array('text', 'user_profile1', $CONFIG['user_profile1_name']),
    array('text', 'user_profile2', $CONFIG['user_profile2_name']),
    array('text', 'user_profile3', $CONFIG['user_profile3_name']),
    array('text', 'user_profile4', $CONFIG['user_profile4_name']),
    array('text', 'user_profile5', $CONFIG['user_profile5_name']),
    array('text', 'user_profile6', $CONFIG['user_profile6_name']),
    array('text', 'pic_count', $lang_register_php['pic_count']),
    array('thumb', 'user_thumb'),
    array('text', 'admin_link'),
    );




$change_password_form_param = array(
    array('password', 'current_pass', $lang_register_php['current_pass'], 25),
    array('password', 'new_pass', $lang_register_php['new_pass'], 25),
    array('password', 'new_pass_again', $lang_register_php['new_pass_again'], 25),
    );

function make_form($form_param, $form_data)
{
    global $CONFIG; //, $PHP_SELF;
    global $lang_register_php;

    $loopCounter = 0;
    foreach ($form_param as $element) {

      if ( ($loopCounter / 2) == floor($loopCounter/2) ) {
        $cellStyle = 'tableb';
      } else {
        $cellStyle = 'tableb tableb_alternate';
      }


      switch ($element[0]) {
        case 'label' :
            echo <<<EOT
    <tr>
        <td colspan="2" class="{$cellStyle}">
            <strong>{$element[1]}</strong>
        </td>
    </tr>

EOT;
            break;

        case 'text' :
            if ($form_data[$element[1]] == '') break;
            echo <<<EOT
    <tr>
        <td width="40%" class="{$cellStyle}" height="25">
            {$element[2]}
        </td>
        <td width="60%" class="{$cellStyle}">
            {$form_data[$element[1]]}
        </td>
    </tr>

EOT;

            break;
        case 'input' :
            $value = $form_data[$element[1]];

        if ($element[2]) echo <<<EOT
    <tr>
        <td width="40%" class="{$cellStyle}"  height="25">
            {$element[2]}
        </td>
        <td width="60%" class="{$cellStyle}" valign="top">
            <input type="text" style="width: 100%" name="{$element[1]}" maxlength="{$element[3]}" value="$value" class="textinput" />
        </td>
    </tr>


EOT;
            break;

        case 'textarea' :
            $value = $form_data[$element[1]];

           if ($element[2]) echo <<<EOT
        <tr>
            <td width="40%" class="{$cellStyle}"  height="25">
                        {$element[2]}
        </td>
        <td width="60%" class="{$cellStyle}" valign="top">
                <textarea name="{$element[1]}" rows="7" cols="40" class="textinput" style="width: 100%">$value</textarea>
                </td>
        </tr>


EOT;
            break;

        case 'password' :
            echo <<<EOT
    <tr>
        <td width="40%" class="{$cellStyle}">
            {$element[2]}
        </td>
        <td width="60%" class="{$cellStyle}" valign="top">
            <input type="password" style="width: 100%" name="{$element[1]}" maxlength="{$element[3]}" value="" class="textinput" />
        </td>
    </tr>

EOT;
            break;
        case 'thumb' :
            $value = $form_data[$element[1]];

            if ($value) echo <<<EOT
    <tr>
        <td valign="top" colspan="2" class="{$cellStyle}" align="center">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center">
                        $value
                    </td>
                </tr>
            </table>
        </td>
    </tr>
EOT;
            break;

        default:
            cpg_die(CRITICAL_ERROR, 'Invalid action for form creation ' . $element[0], __FILE__, __LINE__);
      }
      $loopCounter++;
    }
}

function get_post_var($var)
{
    global $lang_errors;
    $superCage = Inspekt::makeSuperCage();

    if (!$superCage->post->keyExists($var)) {
    	cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'] . " ($var)", __FILE__, __LINE__);
    }
    return $superCage->post->getEscaped($var);
}

if ($superCage->get->keyExists('op') && ($matches = $superCage->get->getMatched('op', '/^[a-z_]+$/'))) {
    $op = $matches[0];
} else {
	$op = '';
}

if ($superCage->get->keyExists('uid')) {
	$uid = $superCage->get->getInt('uid');
} else {
	$uid = -1;
}

if ($superCage->post->keyExists('change_pass')) {
	$op = 'change_pass';
}

if ($superCage->post->keyExists('change_profile') && USER_ID && UDB_INTEGRATION == 'coppermine') { //!defined('UDB_INTEGRATION')) {

        $profile1 = $superCage->post->getEscaped('user_profile1');
        $profile2 = $superCage->post->getEscaped('user_profile2');
        $profile3 = $superCage->post->getEscaped('user_profile3');
        $profile4 = $superCage->post->getEscaped('user_profile4');
        $profile5 = $superCage->post->getEscaped('user_profile5');
        $profile6 = $superCage->post->getEscaped('user_profile6');

        $error = false;

        if ($CONFIG['allow_email_change']){

                $email = $superCage->post->getEscaped('email');

                if (!eregi("^[_\.0-9a-z\-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$", $email)){
                        $error = $lang_register_php['err_invalid_email'];

                } elseif (!$CONFIG['allow_duplicate_emails_addr']) {

                        $sql = "SELECT user_id " . "FROM {$CONFIG['TABLE_USERS']} " . "WHERE user_email = '" . $email . "' AND user_id <> " . USER_ID;
                        $result = cpg_db_query($sql);

                        if (mysql_num_rows($result)) {
                                $error = $lang_register_php['err_duplicate_email'];
                        }
                }
    }

    $sql = "UPDATE {$CONFIG['TABLE_USERS']} SET " . "user_profile1 = '$profile1', " . "user_profile2 = '$profile2', " . "user_profile3 = '$profile3', " . "user_profile4 = '$profile4', " . "user_profile5 = '$profile5', " . "user_profile6 = '$profile6'" . ($CONFIG['allow_email_change'] && !$error ? ", user_email = '$email'" : "") . " WHERE user_id = '" . USER_ID . "'";

    $result = cpg_db_query($sql);

    $title = sprintf($lang_register_php['x_s_profile'], stripslashes(USER_NAME));

    if (!$error){
            $redirect = "index.php";
                 pageheader($title, "<META http-equiv=\"refresh\" content=\"3;url=$redirect\">");
            msg_box($lang_common['information'], $lang_register_php['update_success'], $lang_common['continue'], $redirect);
    } else {
                $redirect = 'profile.php?op=edit_profile';
                pageheader($title, "<META http-equiv=\"refresh\" content=\"3;url=$redirect\">");
                msg_box($lang_common['error'], $error, $lang_common['back'], $redirect);
    }

    pagefooter();
    ob_end_flush();
    exit;
}

if ($superCage->post->keyExists('change_password') && USER_ID && UDB_INTEGRATION == 'coppermine') { //!defined('UDB_INTEGRATION')) {
    $current_pass = get_post_var('current_pass');
    $new_pass = get_post_var('new_pass');
    $new_pass_again = get_post_var('new_pass_again');

    if (utf_strlen($new_pass) < 2) cpg_die(ERROR, $lang_register_php['err_password_short'], __FILE__, __LINE__);
    if ($new_pass != $new_pass_again) cpg_die(ERROR, $lang_register_php['err_password_mismatch'], __FILE__, __LINE__);

    $new_pass = md5($new_pass);
    $current_pass = md5($current_pass);

    $sql = "UPDATE {$cpg_udb->usertable} SET " .
           $cpg_udb->field['password']." = '$new_pass' " .
           "WHERE {$cpg_udb->field['user_id']} = '" . USER_ID . "' AND BINARY {$cpg_udb->field['password']} = '$current_pass'";

    $result = cpg_db_query($sql);
    if (!mysql_affected_rows()) cpg_die(ERROR, $lang_register_php['pass_chg_error'], __FILE__, __LINE__);

    /**
     * TODO: add setcookie function to udb objects (omni)
     */
    setcookie($CONFIG['cookie_name'] . '_pass', md5($new_pass), time() + 86400, $CONFIG['cookie_path']);

    $title = sprintf($lang_register_php['x_s_profile'], stripslashes(USER_NAME));
    $redirect = $CPG_PHP_SELF . "?op=edit_profile";
    pageheader($title, "<META http-equiv=\"refresh\" content=\"3;url=$redirect\">");
    msg_box($lang_common['information'], $lang_register_php['pass_chg_success'], $lang_common['continue'], $redirect);
    pagefooter();
    ob_end_flush();
    exit;
}

switch ($op) {
    // ------------------------------------------------------------------------- //
    case 'edit_profile' :
        if (!USER_ID) {
        	cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
        }

        if (defined('UDB_INTEGRATION')) $cpg_udb->edit_profile(USER_ID);

        $sql = "SELECT user_name, user_email, user_group, user_active, UNIX_TIMESTAMP(user_regdate) AS user_regdate, group_name, " . "user_profile1, user_profile2, user_profile3, user_profile4, user_profile5, user_profile6, user_group_list, " . "COUNT(pid) AS pic_count, SUM(total_filesize) AS disk_usage, group_quota " . "FROM {$CONFIG['TABLE_USERS']} AS u " . "INNER JOIN {$CONFIG['TABLE_USERGROUPS']} AS g ON user_group = group_id " . "LEFT JOIN {$CONFIG['TABLE_PICTURES']} AS p ON p.owner_id = u.user_id " . "WHERE user_id ='" . USER_ID . "' " . "GROUP BY user_id ";

        $result = cpg_db_query($sql);

        if (!mysql_num_rows($result)) cpg_die(ERROR, $lang_register_php['err_unk_user'], __FILE__, __LINE__);
        $user_data = mysql_fetch_array($result);
        mysql_free_result($result);

        $group_list = '';
        if ($user_data['user_group_list'] != '') {
            $sql = "SELECT group_name " . "FROM {$CONFIG['TABLE_USERGROUPS']} " . "WHERE group_id IN ({$user_data['user_group_list']}) AND group_id != {$user_data['user_group']} " . "ORDER BY group_name";
            $result = cpg_db_query($sql);
            while ($row = mysql_fetch_array($result)) {
                $group_list .= $row['group_name'] . ', ';
            }
            mysql_free_result($result);
            $group_list = '<br /><i>(' . substr($group_list, 0, -2) . ')</i>';
        }
        
        if (mysql_num_rows(cpg_db_query("SELECT user_name FROM {$CONFIG['TABLE_BANNED']} WHERE user_name = '" . $user_data['user_name'] . "' AND brute_force=0 LIMIT 1"))){
        	$user_status = $lang_register_php['banned'];
        } elseif ($user_data['user_active'] == 'YES') {
        	$user_status = $lang_usermgr_php['status_active'];
        } else {
        	$user_status = $lang_usermgr_php['status_inactive'];
        }

        if ($user_data['disk_usage'] != '') {
            $disk_usage = $user_data['disk_usage'];
        } else {
            $disk_usage = 0;
        }
        $group_quota = '0';
        $group_quota_separator = '';
        if ($user_data['group_quota']) {
            $group_quota = $user_data['group_quota'];
            $group_quota_separator = '/';
        }
        if (!GALLERY_ADMIN_MODE) {
            $disk_usage_output = theme_display_bar($disk_usage,$group_quota,300,'', '', $group_quota_separator.$group_quota.$lang_byte_units[1],'red','green');
        } else {
            $disk_usage_output = cpg_format_bytes($disk_usage);
        }
        $form_data = array('username' => $user_data['user_name'],
            'reg_date' => localised_date($user_data['user_regdate'], $register_date_fmt),
            'status' => $user_status,
            'group' => $user_data['group_name'] . $group_list,
            'email' => $user_data['user_email'],
            'disk_usage' => $disk_usage_output,
            'user_profile1' => $user_data['user_profile1'],
            'user_profile2' => $user_data['user_profile2'],
            'user_profile3' => $user_data['user_profile3'],
            'user_profile4' => $user_data['user_profile4'],
            'user_profile5' => $user_data['user_profile5'],
            'user_profile6' => $user_data['user_profile6'],
            );

        $title = sprintf($lang_register_php['x_s_profile'], stripslashes(USER_NAME));
        pageheader($title);

        echo <<<EOT
    <form name="cpgform" id="cpgform" method="post" action="{$CPG_PHP_SELF}">

EOT;
        starttable(-1, cpg_fetch_icon('my_profile', 2) . $title, 2);
        make_form($edit_profile_form_param, $form_data);
        $pic_count = cpgUserPicCount($user_data['user_name']);
        $user_thumb = cpgUserThumb(USER_ID);
        $userID = USER_ID;
        $lastComArray = cpgUserLastComment(USER_ID);
        if ($lastComArray['count'] > 0) {
          $lastComByText = '&nbsp;<a href="thumbnails.php?album=lastcomby&amp;uid='.$userID.'">'.
                           cpg_fetch_icon('comment_approval', 0, sprintf($lang_register_php['last_comments_detail'], $lang_register_php['you'])).
                           '</a>';
          $lastComDate = '<br />'.
                         '<span class="thumb_caption">'.
                         localised_date($lastComArray['msg_date'], $lastcom_date_fmt).
                         '</span>';
          $lastComText = '<br />'.
                         '<span class="thumb_caption">'.
                         bb_decode(process_smilies($lastComArray['comment'])).
                         '</span>';
        } else {
          $lastComText = $lang_register_php['none'];
        }
        if ($pic_count > 0) {
          $lastUploadByText = '&nbsp;<a href="thumbnails.php?album=lastupby&amp;uid='.$userID.'">'.
                            cpg_fetch_icon('last_uploads', 0, sprintf($lang_register_php['last_uploads_detail'], $lang_register_php['you'])).
                            '</a>';
          $lastUploadText = '<a href="thumbnails.php?album=lastupby&amp;uid='.$userID.'">'.
                            '<span class="thumb_title">'.
                            $user_thumb.
                            '</a>';
        } else {
          $lastUploadText = $lang_register_php['none'];
        }
        echo <<<EOT
    <tr>
        <td align="left" valign="top" class="tableb tableb_alternate">
          {$lang_register_php['pic_count']}
        </td>
        <td align="left" class="tableb tableb_alternate">
          {$pic_count}
        </td>
    </tr>
    <tr>
        <td align="left" valign="top" class="tableb">
          {$lang_register_php['last_comments']}
          {$lastComByText}
        </td>
        <td align="left" valign="top" class="tableb">
          <a href="thumbnails.php?album=lastcomby&amp;uid={$userID}"><span class="thumb_title">{$lastComArray['thumb']}</a>
          {$lastComDate}
          {$lastComText}
        </td>
    </tr>
    <tr>
        <td align="left" valign="top" class="tableb tableb_alternate">
          {$lang_register_php['last_uploads']}
          {$lastUploadByText}
        </td>
        <td align="left" valign="top" class="tableb tableb_alternate">
          {$lastUploadText}
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center" class="tablef">
            <button type="submit" class="button" name="change_profile" id="change_profile" value="{$lang_common['apply_changes']}">{$icon_array['ok']}{$lang_common['apply_changes']}</button>
            &nbsp;
            <button type="submit" class="button" name="change_pass" id="change_pass" value="{$lang_register_php['change_pass']}">{$icon_array['password']}{$lang_register_php['change_pass']}</button>
        </td>
    </tr>
EOT;
        endtable();
        echo "</form>";
        if ($CONFIG['allow_user_account_delete'] != 0) { // user is allowed to delete his account --- start
          print <<< EOT
        <br />
        <script type="text/javascript">
          <!--//
          function confirmUserDelete() {
            if (document.cpgform2.confirmation.checked = true) {
              check = confirm('{$lang_register_php['really_delete']}');
              if (check == true) {
                //document.cpgform2.submit();
              } else {
                document.cpgform2.confirmation.checked = false;
                document.cpgform2.delete_submit.disabled = true;
                return;
              }
            }
          }

          function agreesubmit(el){
            check = document.cpgform2.confirmation.checked;
            if (check == true) {
                document.cpgform2.delete_submit.disabled = false;
            }
          }
          //-->
        </script>
        <form name="cpgform2" id="cpgform2" method="get" action="delete.php" >
EOT;
          starttable(-1, cpg_fetch_icon('my_profile', 2) . $lang_register_php['delete_my_account'], 2);
          $user_id = USER_ID;
          $warning = sprintf($lang_register_php['warning_delete'],'<a href="thumbnails.php?album=lastupby&uid='.$user_id.'">','</a>','<a href="thumbnails.php?album=lastcomby&uid='.$user_id.'">','</a>');
          echo <<<EOT
    <tr>
        <td colspan="2" align="left" class="tableb">
            {$warning}
        </td>
    </tr>
    <tr>
        <td width="100%" colspan="2" class="tableb">
            <script type="text/javascript">
                document.write('<input type="checkbox" name="confirmation" id="confirmation" value="1" class="checkbox" onClick="agreesubmit();" />');
                document.write('<label for="confirmation" class="clickable_option">');
                document.write("{$lang_register_php['i_am_sure']}");
                document.write('</label>');
            </script>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center" class="tablef">
            <input type="hidden" name="id" value="u{$user_id}" />
            <input type="hidden" name="action" value="delete" />
            <input type="hidden" name="what" value="user" />
            <input type="hidden" name="delete_files" value="no" />
            <input type="hidden" name="delete_comments" value="no" />
            <script type="text/javascript">
              document.write('<input type="submit" name="delete_submit" id="delete_submit" value="{$lang_register_php['delete_my_account']}" class="button" disabled="disabled" onclick="return confirmUserDelete(this);" />');
            </script>
            <noscript>
            <input type="submit" name="delete_submit" id="delete_submit" value="{$lang_register_php['delete_my_account']}" class="button" />
            </noscript>
        </td>
    </tr>
EOT;
          endtable();
          print '</form>';
        } // user is allowed to delete his account --- end
        pagefooter();
        ob_end_flush();
        break;
    // ------------------------------------------------------------------------- //
    case 'change_pass' :
        if (!USER_ID /*|| defined('UDB_INTEGRATION')*/) {
            cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
        }

        // Just a sanity check (should get caught when user clicks 'My Profile')
        if (UDB_INTEGRATION != 'coppermine') {
            $cpg_udb->edit_profile(USER_ID);
        }

        $title = $lang_register_php['change_pass'];
        pageheader($title);
        echo <<<EOT
         <form name="cpgform" id="cpgform" method="post" action="{$CPG_PHP_SELF}">
EOT;
        starttable(-1, cpg_fetch_icon('my_profile', 2) . $title, 2);
        make_form($change_password_form_param, '');
        echo <<<EOT
    <tr>
        <td colspan="2" align="center" class="tablef">
            <input type="submit" name="change_password" value="$title" class="button" />
        </td>
    </tr>
EOT;
        endtable();
        echo "    </form>";
        pagefooter();
        ob_end_flush();
        break;
    // ------------------------------------------------------------------------- //
    default :

        $user_data = $cpg_udb->get_user_infos($uid);
        $user_thumb = cpgUserThumb($uid);
        if (mysql_num_rows(cpg_db_query("SELECT user_name FROM {$CONFIG['TABLE_BANNED']} WHERE user_name = '" . $user_data['user_name'] . "' AND brute_force=0 LIMIT 1"))){
        	$user_status = $lang_register_php['banned'];
        } elseif ($user_data['user_active'] == 'YES') {
        	$user_status = $lang_usermgr_php['status_active'];
        } else {
        	$user_status = $lang_usermgr_php['status_inactive'];
        }
        if ($user_thumb != '') {
          $user_thumb = '<td width="50%" valign="top" align="center">'
                      . '<a href="thumbnails.php?album=lastupby&amp;uid=' . $uid . '">'
                      . '<span class="thumb_title">' . $lang_register_php['last_uploads']. '<br />'. sprintf($lang_register_php['last_uploads_detail'], $user_data['user_name']) . '<br /></span>'
                      . $user_thumb
                      . '</a></td>';
        }
        $lastComArray = cpgUserLastComment($uid);
        if ($lastComArray['count'] != 0) {
                $lastcom = '<td width="50%" valign="top" align="center">'
                    . '<a href="thumbnails.php?album=lastcomby&amp;uid=' . $uid . '">'
                    . '<span class="thumb_title">' . $lang_register_php['last_comments'] . '<br />' . sprintf($lang_register_php['last_comments_detail'], $user_data['user_name']) . '<br /></span>'
                    . $lastComArray['thumb']
                    . '</a><br />';
                $lastcom .= "<span class=\"thumb_caption\">" . localised_date($lastComArray['msg_date'], $lastcom_date_fmt) . '</span>' . "<span class=\"thumb_caption\">" . bb_decode(process_smilies($lastComArray['comment'])) . '</span></td>';
        }


        $quick_jump = ($user_thumb . $lastcom) ? '<table width="100%" border="0" cellspacing="5"><tr>' . $user_thumb . $lastcom . '</tr></table>' : '';

        if (GALLERY_ADMIN_MODE || $uid == USER_ID) {
          if ($uid == USER_ID) {
            $adminLink = '<a href="profile.php?op=edit_profile" class="admin_menu">'.$lang_register_php['edit_my_profile'].'</a>';
          } elseif(GALLERY_ADMIN_MODE) {
            $adminLink = '<a href="usermgr.php?op=edit&user_id='.$uid.'" class="admin_menu">'.sprintf($lang_register_php['edit_xs_profile'], $user_data['user_name']).'</a>';
          }
        }

        $form_data = array('username' => $user_data['user_name'],
            'status' => $user_status,
            'reg_date' => localised_date($user_data['user_regdate'], $register_date_fmt),
            'group' => $user_data['group_name'],
            'user_profile1' => $user_data['user_profile1'],
            'user_profile2' => $user_data['user_profile2'],
            'user_profile3' => $user_data['user_profile3'],
            'user_profile4' => $user_data['user_profile4'],
            'user_profile5' => $user_data['user_profile5'],
            'user_profile6' => bb_decode($user_data['user_profile6']),
            'user_thumb' => $quick_jump,
            'pic_count' => cpgUserPicCount($user_data['user_name']),
            'admin_link' => $adminLink,
            );

        $title = sprintf($lang_register_php['x_s_profile'], $user_data['user_name']);
        pageheader($title);
        starttable(-1, cpg_fetch_icon('my_profile', 2) . $title, 2);
        make_form($display_profile_form_param, $form_data);
        endtable();
        pagefooter();
        ob_end_flush();
        break;
}

?>
