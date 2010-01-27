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
define('DB_INPUT_PHP', true);

require('include/init.inc.php');
require('include/picmgmt.inc.php');
require('include/mailer.inc.php');
require('include/smilies.inc.php');


// AJAX compatible replacement for CPG_DIE
function enl_die($enl_error)
{
	global $lang_back;
	echo '<table cellspacing="1" style="width:100%;height:100%">';
	echo '<tr>';
	echo '<td class="enl_infotablehead" align="center"><b>';
	echo $enl_error;
	echo '</b><br /><br /><a href="javascript:;" class="enl_infotable" style="border-width: 1px;border-style: solid;border-color: #000000;" onclick="enl_ajaxfollow(this);" name="index.php?file=enlargeit/enl_comment&pos='.$_GET['pos'].'&amp;enl_img='.$_GET['enl_img'].'&amp;rnd='.rand(1,9999).'">';
	echo $lang_back;
	echo '</a></td>';
	echo '</tr>';
	echo '</table>';
	exit();
}

// AJAX compatible replacement for MSG_BOX
function enl_message($enl_message)
{
	global $lang_back;
	echo '<table cellspacing="1" style="width:100%;height:100%">';
	echo '<tr>';
	echo '<td class="enl_infotablehead" align="center"><b>';
	echo $enl_message;
	echo '</b><br /><br /><a href="javascript:;" class="enl_infotable" style="border-width: 1px;border-style: solid;border-color: #000000;" onclick="enl_ajaxfollow(this);" name="index.php?file=enlargeit/enl_comment&pos='.$_GET['pos'].'&amp;enl_img='.$_GET['enl_img'].'&amp;rnd='.rand(1,9999).'">';
	echo $lang_back;
	echo '</a></td>';
	echo '</tr>';
	echo '</table>';
}

// decode AJAX strings
function enl_utf8Urldecode($value)
{
    if (is_array($value)) {
        foreach ($value as $key => $val) {
            $value[$key] = utf8Urldecode($val);
        }
    } else {
        $value = preg_replace('/%([0-9a-f]{2})/ie', 'chr(hexdec($1))', (string) $value);
    }
    return $value;
}


function check_comment(&$str)
{
    global $CONFIG, $lang_bad_words, $queries;

    if ($CONFIG['filter_bad_words']) {
        $ercp = array();
        foreach($lang_bad_words as $word) {
            $ercp[] = '/' . ($word[0] == '*' ? '': '\b') . str_replace('*', '', $word) . ($word[(strlen($word)-1)] == '*' ? '': '\b') . '/i';
        }
        $str = preg_replace($ercp, '(...)', $str);
    }

    $com_words=explode(' ',strip_tags(bb_decode($str)));
    $replacements=array();
    foreach($com_words as $key => $word) {
       if (utf_strlen($word) > $CONFIG['max_com_wlength'] ) {
          $replacements[] = $word;
       }
    }
    $str=str_replace($replacements,'(...)',$str);
}

if (!isset($_GET['event']) && !isset($_POST['event'])) {
    enl_die($lang_errors['param_missing']);
}

$event = isset($_POST['event']) ? $_POST['event'] : $_GET['event'];
switch ($event) {

    // Comment

    case 'comment':
        if (!(USER_CAN_POST_COMMENTS)) enl_die($lang_errors['perm_denied']);
        check_comment($_GET['msg_body']);
        check_comment($_GET['msg_author']);
        $msg_author = enl_utf8Urldecode(addslashes(trim($_GET['msg_author'])));
        $msg_body = enl_utf8Urldecode(addslashes(trim($_GET['msg_body'])));
        $pid = (int)$_GET['pos'];
        $pid = -$pid;
        if (($msg_author == '' || $msg_author == 'undefined') && !USER_ID) enl_die($lang_db_input_php['empty_name_or_com']);
        if ($msg_body == '' || $msg_body == 'undefined') enl_die($lang_db_input_php['empty_name_or_com']);

        $result = cpg_db_query("SELECT comments FROM {$CONFIG['TABLE_PICTURES']}, {$CONFIG['TABLE_ALBUMS']} WHERE {$CONFIG['TABLE_PICTURES']}.aid = {$CONFIG['TABLE_ALBUMS']}.aid AND pid='$pid'");
        if (!mysql_num_rows($result)) enl_die($lang_errors['non_exist_ap']);
        $album_data = mysql_fetch_array($result);
        mysql_free_result($result);

        if ($album_data['comments'] != 'YES') enl_die($lang_errors['perm_denied']);

        if (!$CONFIG['disable_comment_flood_protect']){
          $result = cpg_db_query("SELECT author_md5_id, author_id FROM {$CONFIG['TABLE_COMMENTS']} WHERE pid = '$pid' ORDER BY msg_id DESC LIMIT 1");
          if (mysql_num_rows($result)) {
              $last_com_data = mysql_fetch_array($result);
              if ((USER_ID && $last_com_data['author_id'] == USER_ID) || (!USER_ID && $last_com_data['author_md5_id'] == $USER['ID'])) {
                  enl_die($lang_db_input_php['no_flood']);
              }
          }
        }

        if (!USER_ID) { // Anonymous users, we need to use META refresh to save the cookie
            if (mysql_result(cpg_db_query("select count(user_id) from {$CONFIG['TABLE_USERS']} where UPPER(user_name) = UPPER('$msg_author')"),0,0))
            {
              enl_die($lang_db_input_php['com_author_error']);
          }

            $insert = cpg_db_query("INSERT INTO {$CONFIG['TABLE_COMMENTS']} (pid, msg_author, msg_body, msg_date, author_md5_id, author_id, msg_raw_ip, msg_hdr_ip) VALUES ('$pid', '{$CONFIG['comments_anon_pfx']}$msg_author', '$msg_body', NOW(), '{$USER['ID']}', '0', '$raw_ip', '$hdr_ip')");

            $USER['name'] = $_POST['msg_author'];
            $redirect = "displayimage.php?pos=" . (- $pid);
            if ($CONFIG['email_comment_notification']) {
                $mail_body = "<p>" . bb_decode(process_smilies($msg_body, $CONFIG['ecards_more_pic_target'])) . "</p>\n\r ".$lang_db_input_php['email_comment_body'] . " " . $CONFIG['ecards_more_pic_target'].(substr($CONFIG["ecards_more_pic_target"], -1) == '/' ? '' : '/').$redirect;
                cpg_mail('admin', $lang_db_input_php['email_comment_subject'], make_clickable($mail_body));
            }
            enl_message($lang_db_input_php['com_added']);
            ob_end_flush();
            exit;
        } else { // Registered users, we can use Location to redirect
            $insert = cpg_db_query("INSERT INTO {$CONFIG['TABLE_COMMENTS']} (pid, msg_author, msg_body, msg_date, author_md5_id, author_id, msg_raw_ip, msg_hdr_ip) VALUES ('$pid', '" . addslashes(USER_NAME) . "', '$msg_body', NOW(), '', '" . USER_ID . "', '$raw_ip', '$hdr_ip')");
            $redirect = "displayimage.php?pos=" . (- $pid);
            if ($CONFIG['email_comment_notification'] && !USER_IS_ADMIN ) {
                $mail_body = "<p>" . bb_decode(process_smilies($msg_body, $CONFIG['ecards_more_pic_target'])) . "</p>\n\r ".$lang_db_input_php['email_comment_body'] . " " . $CONFIG['ecards_more_pic_target'] . (substr($CONFIG["ecards_more_pic_target"], -1) == '/' ? '' : '/') . $redirect;
                cpg_mail('admin', $lang_db_input_php['email_comment_subject'], make_clickable($mail_body));
            }
            enl_message($lang_db_input_php['com_added']);
            ob_end_flush();
            exit;
        }
        break;

    // Unknow event

    default:
        enl_die($lang_errors['param_missing']);
}
?>
