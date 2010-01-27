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
define('ECARDS_PHP', true);

require('include/init.inc.php');
require('include/smilies.inc.php');
require('include/mailer.inc.php');

if (!USER_ID && $CONFIG['allow_unlogged_access'] == 0) {
    $redirect = $redirect . "login.php";
    header("Location: $redirect");
    exit();
}

if (!USER_CAN_SEND_ECARDS) {
	enl_die($lang_enlargeit['enl_cantecard']);
}

//print_r(get_defined_constants());

function get_post_var($name, $default = '')
{
    if ($_GET[$name] == 'undefined') return '';
    else { return isset($_GET[$name]) ? enl_utf8Urldecode($_GET[$name]) : enl_utf8Urldecode($default); }
}


// AJAX compatible replacement for CPG_DIE
function enl_die($enl_error)
{
	global $lang_back;
	echo '<table cellspacing="1" style="width:100%;height:100%">';
	echo '<tr>';
	echo '<td class="enl_infotablehead" align="center"><b>';
	echo $enl_error;
	echo '</b><br /><br />';
	echo '</td>';
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
	echo '</b><br /><br /><a href="javascript:;" class="enl_infotable" style="border-width: 1px;border-style: solid;border-color: #000000;" onclick="enl_ajaxfollow(this);" name="index.php?file=enlargeit/enl_ecard&pos='.$_GET['pos'].'&amp;back=1&amp;enl_img='.$_GET['enl_img'].'&amp;rnd='.rand(1,9999).'">';
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


$pid = (int)$_GET['pid'];
$album = $_GET['album'];
$pos = (int)$_GET['pos'];
$pid = -1*$pos;

$sender_name = get_post_var('sender_name');
if ($sender_name == '') $sender_name = USER_NAME ? USER_NAME : (isset($USER['name']) ? $USER['name'] : '');
if (defined('UDB_INTEGRATION')AND USER_ID) $USER_DATA = array_merge($USER_DATA,$cpg_udb->get_user_infos(USER_ID));
if ($USER_DATA['user_email']){
$sender_email = $USER_DATA['user_email'];
$sender_box = $sender_email;
} else {
$sender_email = get_post_var('sender_email',$USER['email'] ? $USER['email'] : '');
$sender_box = "<input type=\"text\" onselect=\"enl_geto('".$_GET[enl_img]."').sender_email = encodeURIComponent(this.value);\" onclick=\"enl_geto('".$_GET[enl_img]."').sender_email = encodeURIComponent(this.value);\" onkeyup=\"enl_geto('".$_GET[enl_img]."').sender_email = encodeURIComponent(this.value);\" class=\"enl_textinput\" value=\"$sender_email\" name=\"sender_email\" style=\"width: 95%;\" />";
}
$recipient_name = get_post_var('recipient_name');
$recipient_email = get_post_var('recipient_email');
$greetings = get_post_var('greetings');
$message = get_post_var('message');
$sender_email_warning = '';
$recipient_email_warning = '';
// Get picture thumbnail url
$result = cpg_db_query("SELECT * from {$CONFIG['TABLE_PICTURES']} WHERE pid='$pid' $ALBUM_SET");
if (!mysql_num_rows($result)) enl_die($lang_errors['non_exist_ap']);
$row = mysql_fetch_array($result);
$thumb_pic_url = get_pic_url($row, 'thumb');

$pic_title = $row['title'];
$pic_caption = bb_decode($row['caption']);

if (!is_image($row['filename'])) enl_die($lang_ecard_php['error_not_image']);

// Check supplied email address
$valid_email_pattern = "^[_\.0-9a-z\-]+@([0-9a-z][0-9a-z-]*\.)+[a-z]{2,6}$";
$valid_sender_email = eregi($valid_email_pattern, $sender_email);
$valid_recipient_email = eregi($valid_email_pattern, $recipient_email);
if (!$valid_sender_email && !isset($_GET['back']) && count($_GET) > 4) {
	$sender_email_warning = '<font size="1">' . $lang_ecard_php['invalid_email'] . ' (' . $sender_email . ')</font>';
}
if (!$valid_recipient_email && !isset($_GET['back']) && count($_GET) > 4) {
	$recipient_email_warning = '<font size="1">' . $lang_ecard_php['invalid_email'] . ' (' . $recipient_email . ')</font>';
}

$gallery_url_prefix = $CONFIG['ecards_more_pic_target']. (substr($CONFIG['ecards_more_pic_target'], -1) == '/' ? '' : '/');



if (isset($_GET['submit']) && isset($_GET['rnd'])) {

// Create and send the e-card
if (count($_GET) > 4 && $valid_sender_email && $valid_recipient_email) {
    $gallery_url_prefix = $CONFIG['ecards_more_pic_target']. (substr($CONFIG['ecards_more_pic_target'], -1) == '/' ? '' : '/');
    if ($CONFIG['make_intermediate'] && max($row['pwidth'], $row['pheight']) > $CONFIG['picture_width']) {
        $n_picname = get_pic_url($row, 'normal');
    } else {
        $n_picname = get_pic_url($row, 'fullsize');
    }

    if (!stristr($n_picname, 'http:')) $n_picname = $gallery_url_prefix . $n_picname;

    $msg_content = process_smilies($message, $gallery_url_prefix);

    $data = array('rn' => $recipient_name,
        'sn' => $sender_name,
        'se' => $sender_email,
        'p' => $n_picname,
        'g' => $greetings,
        'm' => $message,
        'pid' => $pid,
        'pt' => $pic_title,
        'pc' => $pic_caption,
        );

    $encoded_data = urlencode(base64_encode(serialize($data)));

    $params = array('{LANG_DIR}' => $lang_text_dir,
        '{TITLE}' => sprintf($lang_ecard_php['ecard_title'], $sender_name),
        '{CHARSET}' => $CONFIG['charset'] == 'language file' ? $lang_charset : $CONFIG['charset'],
        '{VIEW_ECARD_TGT}' => "{$gallery_url_prefix}displayecard.php?data=$encoded_data",
        '{VIEW_ECARD_LNK}' => $lang_ecard_php['view_ecard'],
        '{VIEW_ECARD_LNK_PLAINTEXT}' => $lang_ecard_php['view_ecard_plaintext'],
        '{PIC_URL}' => $n_picname,
        '{URL_PREFIX}' => $gallery_url_prefix,
        '{GREETINGS}' => $greetings,
        '{MESSAGE}' => bb_decode($msg_content),
        '{PLAINTEXT_MESSAGE}' => $message,
        '{SENDER_EMAIL}' => $sender_email,
        '{SENDER_NAME}' => $sender_name,
        '{VIEW_MORE_TGT}' => $CONFIG['ecards_more_pic_target'],
        '{VIEW_MORE_LNK}' => $lang_ecard_php['view_more_pics'],
        '{PID}' => $pid,
        '{PIC_TITLE}' => $pic_title,
        '{PIC_CAPTION}' => $pic_caption,
        );

                                $message = template_eval($template_ecard, $params);
                                $plaintext_message = template_eval($template_ecard_plaintext, $params);

        $tempTime = time();
        $message .= sprintf($lang_ecard_php['ecards_footer'], $sender_name, $_SERVER['REMOTE_ADDR'], localised_date(-1,$comment_date_fmt));
                                $subject = sprintf($lang_ecard_php['ecard_title'], $sender_name);

                                $result = cpg_mail($recipient_email, $subject, $message, 'text/html', $sender_name, $sender_email, $plaintext_message);

        //write ecard log
        if ($CONFIG['log_ecards'] == 1) {
          $result_log = cpg_db_query("INSERT INTO {$CONFIG['TABLE_ECARDS']} (sender_name, sender_email, recipient_name, recipient_email, link, date, sender_ip) VALUES ('$sender_name', '$sender_email', '$recipient_name', '$recipient_email',   '$encoded_data', '$tempTime', '{$_SERVER["REMOTE_ADDR"]}')");
          }

    if (!USER_ID) {
        $USER['name'] = $sender_name;
        $USER['email'] = $sender_email;
    }

    if ($result) {
        //pageheader($lang_ecard_php['title']);
        enl_message($lang_ecard_php['send_success']);
/*                                echo '<br />';
                                starttable('100%', $lang_ecard_php['preview']);
                                echo '<tr><td>';
                                echo template_eval($template_ecard, $params);
                                echo '</td></tr>';
                                endtable();
        pagefooter();
        ob_end_flush(); */
        exit;
    } else {
        enl_die($lang_ecard_php['send_failed']);
    }
        }
}//submit

//pageheader($lang_ecard_php['title']);

//ecard form
if ($CONFIG['show_bbcode_help']) {$captionLabel = '&nbsp;'. cpg_display_help('f=index.html&amp;base=64&amp;h='.urlencode(base64_encode(serialize($lang_bbcode_help_title))).'&amp;t='.urlencode(base64_encode(serialize($lang_bbcode_help))),470,245);}
echo <<< EOT
<form method="post" name="post" action="{$_SERVER['PHP_SELF']}?album=$album&amp;pid=$pid&amp;pos=$pos">
EOT;
//starttable("100%", $lang_ecard_php['title'], 3);
                echo '<table align="center" cellspacing="1" cellpadding="0" style="width:100%;">';
                echo '<tr>';
                echo '<td width="100%" colspan="3" class="enl_infotablehead"><b>'.$lang_ecard_php['title'].'</b></td>';
                echo '</tr>';

echo <<<EOT
        <tr>
                <td class="enl_infotable" colspan="2"><b><br />{$lang_ecard_php['from']}</b></td>
                <td rowspan="6" align="center" valign="top" class="enl_infotable">
                        
                                                                                                <img src="$thumb_pic_url" alt="" vspace="8" border="0" onclick="enl_btnpicture('{$_GET[enl_img]}');" class="image" /><br />
                </td>
        </tr>
        <tr>
                <td class="enl_infotable" valign="top" width="40%">
                        {$lang_ecard_php['your_name']}<br />
                </td>
                <td valign="top" class="enl_infotable" width="60%">
EOT;
                
echo '<input type="text" onselect="enl_geto(\''.$_GET[enl_img].'\').sender_name = encodeURIComponent(this.value);" onclick="enl_geto(\''.$_GET[enl_img].'\').sender_name = encodeURIComponent(this.value);" onkeyup="enl_geto(\''.$_GET[enl_img].'\').sender_name = encodeURIComponent(this.value);" class="enl_textinput" name="sender_name"  value="'.$sender_name.'" style="width: 95%;" />';

echo <<< EOT
<br />
                </td>
        </tr>
        <tr>
                <td class="enl_infotable" valign="top" width="40%">
                        {$lang_ecard_php['your_email']}<br />
                </td>
                <td valign="top" class="enl_infotable" width="60%">
                        {$sender_box}
                        {$sender_email_warning}
                </td>
        </tr>
        <tr>
                <td class="enl_infotable" colspan="2"><b><br />{$lang_ecard_php['to']}</b></td>
        </tr>
        <tr>
                <td class="enl_infotable" valign="top" width="40%">
                        {$lang_ecard_php['rcpt_name']}<br />
                </td>
                <td valign="top" class="enl_infotable" width="60%">
EOT;

echo '<input type="text" onselect="enl_geto(\''.$_GET[enl_img].'\').recipient_name = encodeURIComponent(this.value);" onclick="enl_geto(\''.$_GET[enl_img].'\').recipient_name = encodeURIComponent(this.value);" onkeyup="enl_geto(\''.$_GET[enl_img].'\').recipient_name = encodeURIComponent(this.value);" class="enl_textinput" name="recipient_name"  value="'.$recipient_name.'" style="width: 95%;" />';

echo <<< EOT

                </td>
        </tr>
        <tr>
                <td class="enl_infotable" valign="top" width="40%">
                        {$lang_ecard_php['rcpt_email']}<br />
                </td>
                <td valign="top" class="enl_infotable" width="60%">
                
EOT;

echo  '<input onselect="enl_geto(\''.$_GET[enl_img].'\').recipient_email = encodeURIComponent(this.value);" onclick="enl_geto(\''.$_GET[enl_img].'\').recipient_email = encodeURIComponent(this.value);" onkeyup="enl_geto(\''.$_GET[enl_img].'\').recipient_email = encodeURIComponent(this.value);" type="text" class="enl_textinput" name="recipient_email"  value="'.$recipient_email.'" style="width: 95%;" /><br />';

echo <<< EOT

                        $recipient_email_warning
                </td>
        </tr>
        <tr>
                <td class="enl_infotable" colspan="3"><b><br />{$lang_ecard_php['greetings']}</b></td>
        </tr>
        <tr>
                <td class="enl_infotable" colspan="3">
                
EOT;
echo '<input onselect="enl_geto(\''.$_GET[enl_img].'\').greetings = encodeURIComponent(this.value);" onclick="enl_geto(\''.$_GET[enl_img].'\').greetings = encodeURIComponent(this.value);" onkeyup="enl_geto(\''.$_GET[enl_img].'\').greetings = encodeURIComponent(this.value);" type="text" class="enl_textinput" name="greetings"  value="'.$greetings.'" style="width: 97%;" />';

echo <<< EOT
                </td>
        </tr>
        <tr>
                <td class="enl_infotable" colspan="3"><b><br />{$lang_ecard_php['message']}$captionLabel</b></td>
        </tr>
        <tr>
                <td class="enl_infotable" colspan="3">
                
EOT;

echo '<input onselect="enl_geto(\''.$_GET[enl_img].'\').message = encodeURIComponent(this.value);" onclick="enl_geto(\''.$_GET[enl_img].'\').message = encodeURIComponent(this.value);" onkeyup="enl_geto(\''.$_GET[enl_img].'\').message = encodeURIComponent(this.value);" type="text" name="message" class="enl_textinput" value="'.$message.'" style="width: 97%;" />';

$enl_rand = rand(1,9999);

echo <<< EOT
                </td>
        </tr>
        <tr>
                <td colspan="3" align="center" class="enl_infotable">&nbsp;<br />
                        <input type="submit" onclick="this.name='index.php?file=enlargeit/enl_ecard&enl_img={$_GET[enl_img]}&amp;pos={$_GET[pos]}&amp;recipient_name='+enl_geto('{$_GET[enl_img]}').recipient_name+'&amp;recipient_email='+enl_geto('{$_GET[enl_img]}').recipient_email+'&amp;greetings='+enl_geto('{$_GET[enl_img]}').greetings+'&amp;sender_email='+enl_geto('{$_GET[enl_img]}').sender_email+'&amp;sender_name='+enl_geto('{$_GET[enl_img]}').sender_name+'&amp;message='+enl_geto('{$_GET[enl_img]}').message+'&amp;rnd={$enl_rand}&amp;submit=1';enl_geto('{$_GET[enl_img]}').recipient_name='';enl_geto('{$_GET[enl_img]}').recipient_email='';enl_ajaxfollow(this);return false;" class="enl_commentbutton" name="submit" title="{$lang_ecard_php['submit_button']}" value="{$lang_ecard_php['submit_button']}" />
                <br />&nbsp;</td>
        </tr></table>
EOT;

echo '</form>';
ob_end_flush();

?>
