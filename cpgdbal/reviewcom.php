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
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/reviewcom.php $
  $Revision: 5129 $
  $LastChangedBy: gaugau $
  $Date: 2008-10-18 16:03:12 +0530 (Sat, 18 Oct 2008) $
**********************************************/

// todo: search option.

define('IN_COPPERMINE', true);
define('REVIEWCOM_PHP', true);

require('include/init.inc.php');
include("include/smilies.inc.php");

if (!GALLERY_ADMIN_MODE) {
    cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

// initialize some variables
$start = '';
$count = '';
$sort = '';
$single_picture = '';
$nb_com_yes = '';
$nb_com_no = '';
$flag_conf_change = '';

// Change config options if applicable
if ($superCage->post->keyExists('is_submit')) {
        if ($superCage->post->keyExists('approval_only')) {
           $approval_only = 1;
        } else {
           $approval_only = 0;
        }
        if ($approval_only != $CONFIG['display_comment_approval_only']) {
            // the user wants to see the option changed - let's write it to the database
            cpg_config_set('display_comment_approval_only', $approval_only);
            $flag_conf_change = 1;
        }
}

// we have made sure that an admin is logged in - let's check for GET parameters if the admin is trying to approve things from the intermediate image view
$get_data_rejected = 0;
$single_approval_array = array('pos' => $superCage->get->getInt('pos'), 'msg_id' => $superCage->get->getInt('msg_id'), 'what' => $superCage->get->getAlpha('what'));

foreach ($single_approval_array as $value) {
    if (!$value) {
        $get_data_rejected++;
    }
}
// We have gathered enough data for a basic check - let's only perform the rest of the individual approval if everthying is OK, i.e. all previous critieria have been met.
if ($get_data_rejected==0) { // individual approval start
    pageheader($lang_reviewcom_php['title']);

    // Normally, we could trust this input, as only the admin should have gotten that far.
    // Anyway, let's perform some more testing, it won't hurt performance-wise, but should be more secure - maybe the admin has followed a made-up link that led him here.
    // Some of those checks could be performed more elegantly using regex - contributions would be welcome.

    if (floor($single_approval_array['pos']) != $single_approval_array['pos']) {
      $get_data_rejected++;
    }
    if (abs($single_approval_array['pos']) == $single_approval_array['pos']) {
      $get_data_rejected++;
    }
    if (floor($single_approval_array['msg_id']) != $single_approval_array['msg_id']) {
      $get_data_rejected++;
    }
    if (abs($single_approval_array['msg_id']) != $single_approval_array['msg_id']) {
      $get_data_rejected++;
    }
    if ($single_approval_array['what'] != 'approve' && $single_approval_array['what'] != 'disapprove') {
      $get_data_rejected++;
    }

    // Perform the lookup

    /*$result = cpg_db_query("
                        SELECT msg_id, msg_author, msg_body, UNIX_TIMESTAMP(msg_date)
                        AS msg_date, approval, author_id, {$CONFIG['TABLE_COMMENTS']}.pid
                        AS pid, aid, filepath, filename, url_prefix, pwidth, pheight
                        FROM {$CONFIG['TABLE_COMMENTS']}, {$CONFIG['TABLE_PICTURES']}
                        WHERE {$CONFIG['TABLE_COMMENTS']}.pid = {$CONFIG['TABLE_PICTURES']}.pid
                        AND {$CONFIG['TABLE_COMMENTS']}.msg_id = {$single_approval_array['msg_id']}
                        LIMIT 1
                        ");
    while ($row = mysql_fetch_array($result)) {	*/
	########################  DB  ############################
		$cpgdb->query($cpg_db_reviewcom_php['verify_admin'], $single_approval_array['msg_id']);
		while ($row = $cpgdb->fetchRow()) {
	#######################################################
        if ($row['pid'] != abs($single_approval_array['pos'])) {
            $get_data_rejected++;
        }	
        $thumb_url =  get_pic_url($row, 'thumb');
        if (!is_image($row['filename'])) {
        $image_info = cpg_getimagesize($thumb_url);
        $row['pwidth'] = $image_info[0];
        $row['pheight'] = $image_info[1];
        }
        $image_size = compute_img_size($row['pwidth'], $row['pheight'], $CONFIG['alb_list_thumb_size']);
        $thumb_link = 'displayimage.php?pos=' . - $row['pid'];
        $msg_date = localised_date($row['msg_date'], $scientific_date_fmt);
        $msg_body = bb_decode(process_smilies($row['msg_body']));
        // build a link to the author's profile if applicable
        if ($row['author_id'] != 0) {
                $profile_link_start = '<a href="profile.php?uid='.$row['author_id'].'">';
                $profile_link_end = '</a>';
        } else {
                $profile_link_start = '';
                $profile_link_end = '';
        }
        $msg_author = $row['msg_author'];
    }

    // if all verifications have passed, execute the change and output the result. Else, display an error message
    if ($get_data_rejected == 0) {
        if ($single_approval_array['what'] == 'approve') {
            $query_approval = 'YES';
            $title = $lang_reviewcom_php['comment_approved'];
        } else {
            $query_approval = 'NO';
            $title = $lang_reviewcom_php['comment_disapproved'];
        }
        //cpg_db_query("UPDATE {$CONFIG['TABLE_COMMENTS']} SET `approval` = '{$query_approval}' WHERE msg_id = {$single_approval_array['msg_id']}");
        #########################  DB  ############################
		$cpgdb->query($cpg_db_reviewcom_php['comments_query_approval'], $query_approval, $single_approval_array['msg_id']);
		########################################################
		starttable('-2', $title, 2);
        print <<< EOT
        <tr>
            <td class="tableb">{$lang_reviewcom_php['user_name']}</td>
            <td class="tableb">{$profile_link_start}{$msg_author}{$profile_link_end}</td>
        </tr>
        <tr>
            <td class="tableb tableb_alternate">{$lang_reviewcom_php['date']}</td>
            <td class="tableb tableb_alternate">{$msg_date}</td>
        </tr>
        <tr>
            <td class="tableb">{$lang_reviewcom_php['comment']}</td>
            <td class="tableb">{$msg_body}</td>
        </tr>
        <tr>
            <td class="tableb tableb_alternate">{$lang_reviewcom_php['file']}</td>
            <td class="tableb tableb_alternate"><a href="$thumb_link"><img src="$thumb_url" {$image_size['geom']} class="image" border="0" alt="" /></a></td>
        </tr>
        <tr>
            <td class="tablef" colspan="2" align="center"><a href="$thumb_link#comment{$single_approval_array['msg_id']}" class="admin_menu">{$lang_common['continue']}</a></td>
        </tr>
EOT;
        endtable();
    } else { // verification not passed
        cpg_die(ERROR, $lang_errors['non_exist_comment'], __FILE__, __LINE__);
    }
    pagefooter();
    ob_end_flush();
} else { // individual approval end, mass-approval start


if ($CONFIG['display_comment_approval_only'] == 1) {
    $comment_approval_only_checked = 'checked="checked"';
} else {
    $comment_approval_only_checked = '';
}

// Get the hidden field that contains all message IDs that are being
// handled by the form that was just submit.
if ($superCage->post->keyExists('total_message_id_collector')) {
	$total_message_id_submit = $superCage->post->getMatched('total_message_id_collector', '/^[0-9\/|]+$/');
	$total_message_id_array = explode('|' , rtrim($total_message_id_submit[0],'|'));
	sort($total_message_id_array);
	// Now loop through that array to check wether an individual approval change has been submit.
	$approved_yes_set = '';
	$approved_no_set = '';
	foreach ($total_message_id_array as $message_id_check) {
		if ($superCage->post->getInt('status_approved_yes'.$message_id_check) != '') {
			$approved_yes_set .= $superCage->post->getInt('status_approved_yes'.$message_id_check) . ',';
		}
		if ($superCage->post->getInt('status_approved_no'.$message_id_check) != '') {
			$approved_no_set .= $superCage->post->getInt('status_approved_no'.$message_id_check) . ',';
		}
	}
	$approved_yes_set = rtrim($approved_yes_set, ',');
	$approved_no_set = rtrim($approved_no_set, ',');
	$nb_com_yes = 0;
	$nb_com_no = 0;
	if ($approved_yes_set != '') {
		/*cpg_db_query("UPDATE {$CONFIG['TABLE_COMMENTS']} SET `approval` = 'YES' WHERE msg_id IN ($approved_yes_set)");
		$nb_com_yes = mysql_affected_rows(); */
        ##################################    DB    ###############################
        $cpgdb->query($cpg_db_reviewcom_php['set_approval_yes'], $approved_yes_set);
        $nb_com_yes = $cpgdb->affectedRows();
        ###########################################################################
	}
	if ($approved_no_set != '') {
	    /* cpg_db_query("UPDATE {$CONFIG['TABLE_COMMENTS']} SET `approval` = 'NO' WHERE msg_id IN ($approved_no_set)");
	    $nb_com_no = mysql_affected_rows(); */
        ##################################    DB    ###############################
        $cpgdb->query($cpg_db_reviewcom_php['set_approval_no'], $approved_no_set);
        $nb_com_no = $cpgdb->affectedRows();
        ###########################################################################
	}
}

$nb_com_del = 0;
//if (isset($_POST['cid_array'])) { // have any checkboxes been ticked?
if ($superCage->post->keyExists('cid_array')) {
    $cid_array = $superCage->post->getEscaped('cid_array');
    $cid_set = '';
    foreach ($cid_array as $cid) {
            $cid_set .= ($cid_set == '') ? $cid : ', ' . $cid; //'(' . $cid : ', ' . $cid;
    }
    //$cid_set .= ')';
    /*if($superCage->post->getAlpha('with_selected') == 'delete') {
    
            // Delete selected comments if form is posted
            cpg_db_query("DELETE FROM {$CONFIG['TABLE_COMMENTS']} WHERE msg_id IN $cid_set");
            $nb_com_del = mysql_affected_rows();
    } elseif($superCage->post->getAlpha('with_selected') == 'approve') {
        cpg_db_query("UPDATE {$CONFIG['TABLE_COMMENTS']} SET `approval` = 'YES' WHERE msg_id IN $cid_set");
        $nb_com_yes = mysql_affected_rows();
    } elseif($superCage->post->getAlpha('with_selected') == 'disapprove') {
        cpg_db_query("UPDATE {$CONFIG['TABLE_COMMENTS']} SET `approval` = 'NO' WHERE msg_id IN $cid_set");
        $nb_com_no = mysql_affected_rows();
    }	*/
	##############################  DB  ##################################
    if($superCage->post->getAlpha('with_selected') == 'delete') {
        // Delete selected comments if form is posted
        $cpgdb->query($cpg_db_reviewcom_php['delete_selected_comments'], $cid_set);
            $nb_com_del = $cpgdb->affectedRows();
    } elseif($superCage->post->getAlpha('with_selected') == 'approve') {
        $cpgdb->query($cpg_db_reviewcom_php['set_approval_yes'], $cid_set);
		$nb_com_yes = $cpgdb->affectedRows();
    } elseif($superCage->post->getAlpha('with_selected') == 'disapprove') {
        $cpgdb->query($cpg_db_reviewcom_php['set_approval_no'], $cid_set);
		$nb_com_no = $cpgdb->affectedRows();
    }
	###################################################################
}

/*$result = cpg_db_query("SELECT count(*) FROM {$CONFIG['TABLE_COMMENTS']} WHERE 1");
$nbEnr = mysql_fetch_array($result);
$comment_count = $nbEnr[0];	*/
#####################  DB  ########################
$cpgdb->query($cpg_db_reviewcom_php['count_comments']);
$nbEnr = $cpgdb->fetchRow();
$comment_count = $nbEnr['count'];
###############################################


if (!$comment_count) cpg_die(INFORMATION , $lang_reviewcom_php['no_comment'], __FILE__, __LINE__);

//$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;
if ($superCage->get->keyExists('start')) {
	$start = $superCage->get->getInt('start');
} else {
	$start = 0;
}
//$count = isset($_GET['count']) ? $_GET['count'] : 25;
if ($superCage->get->keyExists('count')) {
	$count = $superCage->get->getInt('count');
} else {
	$count = 25;
}
$next_target = $CPG_PHP_SELF . '?start=' . ($start + $count) . '&amp;count=' . $count;
$prev_target = $CPG_PHP_SELF . '?start=' . max(0, $start - $count) . '&amp;count=' . $count;
$s50 = $count == 50 ? 'selected' : '';
$s75 = $count == 75 ? 'selected' : '';
$s100 = $count == 100 ? 'selected' : '';
//$single_picture = isset($_GET['pid']) ? (int)$_GET['pid'] : '';
if ($superCage->get->keyExists('pid')) {
	$single_picture = $superCage->get->getInt('pid');
} else {
	$single_picture = '';
}

if ($start + $count < $comment_count) {
    $next_link = '<a href="'.$next_target.'">'.cpg_fetch_icon('rightright', 0, $lang_reviewcom_php['see_next']).'</a>';
} else {
    $next_link = '';
}

if ($start > 0) {
    $prev_link = '<a href="'.$prev_target.'">'.cpg_fetch_icon('leftleft', 0,$lang_reviewcom_php['see_prev']).'</a>&nbsp;&nbsp;';
} else {
    $prev_link = '';
}

pageheader($lang_reviewcom_php['title']);



echo <<<EOT
<script type="text/javascript" language="javascript">
<!--
function textCounter(field, maxlimit) {
        if (field.value.length > maxlimit) // if too long...trim it!
        field.value = field.value.substring(0, maxlimit);
}

function selectAll(d,box) {
  var f = document.editForm;
  for (i = 0; i < f.length; i++) {
    //alert (f[i].name.indexOf(box));
    if (f[i].type == "checkbox" && f[i].name.indexOf(box) >= 0) {
      if (d.checked) {
        f[i].checked = true;
      } else {
        f[i].checked = false;
      }
    }
  }
  if (d.name == "checkAll") {
      document.getElementsByName('checkAll2')[0].checked = document.getElementsByName('checkAll')[0].checked;
  } else {
      document.getElementsByName('checkAll')[0].checked = document.getElementsByName('checkAll2')[0].checked;
  }
}

function approveCommentEnable(id) {
    if (document.getElementById('approved'+id+'yes').checked == true) {
        document.getElementById('status_approved_yes'+id).value = id;
        document.getElementById('status_approved_no'+id).value = '';
    }
    if (document.getElementById('approved'+id+'no').checked == true) {
        document.getElementById('status_approved_yes'+id).value = '';
        document.getElementById('status_approved_no'+id).value = id;
    }
}

function checkBeforeSubmit() {
    // Are there any comments scheduled for deletion?
    var f = document.editForm;
    var counter = 0;
    for (i = 0; i < f.length; i++) {
        if (f[i].type == "checkbox" && f[i].name.indexOf('cid_array') >= 0 && f[i].checked == true) {
            counter++;
        }
    }
    if (counter > 0) {
        // at least one checkbox has been ticked
        if (document.getElementById('delete_selected').checked == true) {
            // the ticked items are scheduled for deletion
            return confirm("{$lang_reviewcom_php['n_confirm_delete']}");
        }
    }
}

-->
</script>

    <form action="{$CPG_PHP_SELF}?start=$start&amp;count=$count&amp;sort=$sort&amp;pid=$single_picture" method="post" name="editForm" id="cpgform2">
    <input type="hidden" name="is_submit" value="1" />
EOT;

// make up the table header


starttable('100%');

$msg_txt = '';
if ($nb_com_del > 0) {
    $msg_txt .= '                          <li style="list-style-image:url(images/icons/ok.png)">'.sprintf($lang_reviewcom_php['n_comm_del'], $nb_com_del).'</li>'."\n\r";
}
if ($nb_com_yes > 0) {
    $msg_txt .= '                          <li style="list-style-image:url(images/icons/ok.png)">'.sprintf($lang_reviewcom_php['n_comm_appr'], $nb_com_yes).'</li>'."\n\r";
}
if ($nb_com_no > 0) {
    $msg_txt .= '                          <li style="list-style-image:url(images/icons/ok.png)">'.sprintf($lang_reviewcom_php['n_comm_disappr'], $nb_com_no).'</li>'."\n\r";
}
if ($flag_conf_change != '') {
    $msg_txt .= '                          <li style="list-style-image:url(images/icons/ok.png)">'.$lang_reviewcom_php['configuration_changed'].'</li>'."\n\r";
}


if ($msg_txt != '') {
    echo <<<EOT
        <tr>
                <td class="tableh2" colspan="7" align="left">
                        <ul>
$msg_txt
                        </ul>
                </td>
        </tr>

EOT;
}

$help_approval_only = '&nbsp;'.cpg_display_help('f=configuration.htm&amp;as=admin_comment_display_comment_approval_only_start&amp;ae=admin_comment_display_comment_approval_only_end&amp;top=1', '600', '400');
$help = '&nbsp;'.cpg_display_help('f=comments.htm&amp;as=comments_review&amp;ae=comments_review_end&amp;top=1', '800', '400');
$icon = cpg_fetch_icon('comment_approval',2);
echo <<<EOT
        <tr>
                <td class="tableh1" colspan="7">
                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                            <td class="tableh1">
                                {$icon}{$lang_reviewcom_php['title']}
                                {$help}
                            </td>
                            <td class="tableh1" align="center">
                                <input type="checkbox" name="approval_only" id="approval_only" class="checkbox" title="{$lang_reviewcom_php['only_approval']}" {$comment_approval_only_checked} value="1" />
                                <label for="approval_only" class="clickable_option">{$lang_reviewcom_php['only_approval']}</label>
                                {$help_approval_only}
                            </td>
                            <td class="tableh1" align="center">
                                $prev_link
                                $next_link
                            </td>
                            <td class="tableh1" align="right">
                                {$lang_reviewcom_php['n_comm_disp']}
                                <select onChange="if(this.options[this.selectedIndex].value) window.location.href='{$CPG_PHP_SELF}?start=$start&amp;count='+this.options[this.selectedIndex].value;"  name="count" class="listbox">
                                        <option value="25">25</option>
                                        <option value="50" $s50>50</option>
                                        <option value="75" $s75>75</option>
                                        <option value="100" $s100>100</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </td>
        </tr>
        <noscript>
        <tr>
                <td class="tableh2" colspan="6">
                  {$lang_common['javascript_needed']}
                </td>
        </tr>
        </noscript>

EOT;

    echo <<<EOT
        <tr>
          <td class="tableh2" valign="middle" align="center">
          </td>
          <td class="tableh2" valign="middle" align="center">
            <input type="checkbox" name="checkAll" onClick="selectAll(this,'cid_array');" class="checkbox" title="{$lang_common['check_uncheck_all']}" />
          </td>
          <td class="tableh2" valign="top">
            {$lang_reviewcom_php['approval']}
            <a href="{$CPG_PHP_SELF}?start=$start&amp;count=$count&amp;sort=approval_a"><img src="images/ascending.gif" width="9" height="9" border="0" alt="" title="{$lang_reviewcom_php['approval_a']}" /></a>
            <a href="{$CPG_PHP_SELF}?start=$start&amp;count=$count&amp;sort=approval_d"><img src="images/descending.gif" width="9" height="9" border="0" alt="" title="{$lang_reviewcom_php['approval_d']}" /></a>
          </td>
          <td class="tableh2" valign="top">{$lang_reviewcom_php['user_name']}
            <a href="{$CPG_PHP_SELF}?start=$start&amp;count=$count&amp;sort=name_a"><img src="images/ascending.gif" width="9" height="9" border="0" alt="" title="{$lang_reviewcom_php['name_a']}" /></a>
            <a href="{$CPG_PHP_SELF}?start=$start&amp;count=$count&amp;sort=name_d"><img src="images/descending.gif" width="9" height="9" border="0" alt="" title="{$lang_reviewcom_php['name_d']}" /></a>
          </td>
          <td class="tableh2" valign="top">{$lang_reviewcom_php['date']}
            <a href="{$CPG_PHP_SELF}?start=$start&amp;count=$count&amp;sort=date_a"><img src="images/ascending.gif" width="9" height="9" border="0" alt="" title="{$lang_reviewcom_php['date_a']}" /></a>
            <a href="{$CPG_PHP_SELF}?start=$start&amp;count=$count&amp;sort=date_d"><img src="images/descending.gif" width="9" height="9" border="0" alt="" title="{$lang_reviewcom_php['date_d']}" /></a>
          </td>
          <td class="tableh2" valign="top">{$lang_reviewcom_php['comment']}
            <a href="{$CPG_PHP_SELF}?start=$start&amp;count=$count&amp;sort=comment_a"><img src="images/ascending.gif" width="9" height="9" border="0" alt="" title="{$lang_reviewcom_php['comment_a']}" /></a>
            <a href="{$CPG_PHP_SELF}?start=$start&amp;count=$count&amp;sort=comment_d"><img src="images/descending.gif" width="9" height="9" border="0" alt="" title="{$lang_reviewcom_php['comment_d']}" /></a>
          </td>
          <td class="tableh2" valign="top">{$lang_reviewcom_php['file']}
            <a href="{$CPG_PHP_SELF}?start=$start&amp;count=$count&amp;sort=file_a"><img src="images/ascending.gif" width="9" height="9" border="0" alt="" title="{$lang_reviewcom_php['file_a']}" /></a>
            <a href="{$CPG_PHP_SELF}?start=$start&amp;count=$count&amp;sort=file_d"><img src="images/descending.gif" width="9" height="9" border="0" alt="" title="{$lang_reviewcom_php['file_d']}" /></a>
          </td>
        </tr>

EOT;

$sort_codes = array('name_a' => 'msg_author ASC',
    'name_d' => 'msg_author DESC',
    'date_a' => 'msg_id ASC',
    'date_d' => 'msg_id DESC',
    'comment_a' => 'msg_body ASC',
    'comment_d' => 'msg_body DESC',
    'file_a' => 'pid ASC',
    'file_d' => 'pid DESC',
    'approval_a' => 'approval ASC',
    'approval_d' => 'approval DESC',
);
// sort by date descending if no other sorting order is given
//$sort = (!isset($_GET['sort']) || !isset($sort_codes[$_GET['sort']])) ? 'date_d' : $_GET['sort'];
if ($superCage->get->keyExists('sort')) {
	$get_sort = $superCage->get->getEscaped('sort');
}
if (!isset($get_sort) || !isset($sort_codes[$get_sort])) {
	$sort = 'date_d';
} else {
	$sort = $get_sort;
}
if ($CONFIG['display_comment_approval_only'] == 1) {
    $only_comments_needing_approval = "AND approval='NO'";
} else {
	$only_comments_needing_approval = '';
}

/*$result = cpg_db_query("
                        SELECT msg_id, msg_author, msg_body, UNIX_TIMESTAMP(msg_date)
                        AS msg_date, approval, author_id, {$CONFIG['TABLE_COMMENTS']}.pid
                        AS pid, aid, filepath, filename, url_prefix, pwidth, pheight
                        FROM {$CONFIG['TABLE_COMMENTS']}, {$CONFIG['TABLE_PICTURES']}
                        WHERE {$CONFIG['TABLE_COMMENTS']}.pid = {$CONFIG['TABLE_PICTURES']}.pid {$only_comments_needing_approval}
                        ORDER BY {$sort_codes[$sort]}
                        LIMIT $start, $count
                        ");

$rowcounter = 0;
$totalMessageIdCollector = '';
$loopCounter = 0;

while ($row = mysql_fetch_array($result)) {*/
######################  DB  ############################
$cpgdb->query($cpg_db_reviewcom_php['only_comments_needing_approval'], $only_comments_needing_approval, $sort_codes[$sort], $start, $count);
$rowcounter = 0;
$totalMessageIdCollector = '';
$loopCounter = 0;
while ($row = $cpgdb->fetchRow()) {
#####################################################
    $loopCounter++;
    $thumb_url =  get_pic_url($row, 'thumb');
    if (!is_image($row['filename'])) {
        $image_info = cpg_getimagesize($thumb_url);
        $row['pwidth'] = $image_info[0];
        $row['pheight'] = $image_info[1];
    }
    $totalMessageIdCollector .= $row['msg_id'].'|';
    $image_size = compute_img_size($row['pwidth'], $row['pheight'], $CONFIG['alb_list_thumb_size']);
    $thumb_link = 'displayimage.php?pos=' . - $row['pid'];
    $msg_date = localised_date($row['msg_date'], $scientific_date_fmt);
    $msg_body = bb_decode(process_smilies($row['msg_body']));
    if ($row['approval'] == 'YES') {
        $comment_approval_status = '<input name="approved'.$row['msg_id'].'" id="approved'.$row['msg_id'].'yes" type="radio" value="1" checked="checked" onchange="approveCommentEnable('.$row['msg_id'].');" /><label for="approved'.$row['msg_id'].'yes" class="clickable_option">' . $lang_common['yes']."</label>&nbsp;\n\r";
        $comment_approval_status .= '<input name="approved'.$row['msg_id'].'" id="approved'.$row['msg_id'].'no" type="radio" value="0" onchange="approveCommentEnable('.$row['msg_id'].');" /><label for="approved'.$row['msg_id'].'no" class="clickable_option">' .$lang_common['no'].'</label>';
    } else {
        $comment_approval_status = '<input name="approved'.$row['msg_id'].'" id="approved'.$row['msg_id'].'yes" type="radio" value="1" onchange="approveCommentEnable('.$row['msg_id'].');" /><label for="approved'.$row['msg_id'].'yes" class="clickable_option">' .$lang_common['yes']."</label>&nbsp;\n\r                        ";
        $comment_approval_status .= '<input name="approved'.$row['msg_id'].'" id="approved'.$row['msg_id'].'no" type="radio" value="0" checked="checked" onchange="approveCommentEnable('.$row['msg_id'].');" /><label for="approved'.$row['msg_id'].'no" class="clickable_option">' .$lang_common['no'].'</label>';
    }
    $comment_approval_status .= '<input type="hidden" name="status_approved_yes'.$row['msg_id'].'" id="status_approved_yes'.$row['msg_id'].'" value="" />';
    $comment_approval_status .= '<input type="hidden" name="status_approved_no'.$row['msg_id'].'" id="status_approved_no'.$row['msg_id'].'" value="" />';
	//get link to ban and delete
	if ($row['author_id'] == 0) {
		//$ban_and_delete = '<a href="banning.php?delete_comment_id=' . $row['msg_id'] . '">' . $lang_reviewcom_php['ban_and_delete'] . '</a>';
		$ban_and_delete = '';
	} else {
		$ban_and_delete = '<a href="banning.php?ban_user=' . $row['author_id'] . '&amp;delete_comment_id=' . $row['msg_id'] . '" title="' . $lang_reviewcom_php['ban_and_delete'] . '">' . cpg_fetch_icon('ban_user_comment', 0) . '</a>';
	}
    $rowcounter++;
    if ($rowcounter >=2 ) { //let the row colors alternate, for now they are the same
        $rowcounter = 0;
        $tableclass = 'tableb'; // change to "tableh2_compact" or similar for alternation
    } else {
        $tableclass = 'tableb tableb_alternate';
    }
    // build a link to the author's profile if applicable
    if ($row['author_id'] != 0) {
        $profile_link_start = '<a href="profile.php?uid='.$row['author_id'].'">';
        $profile_link_end = '</a>';
    } else {
        $profile_link_start = '';
        $profile_link_end = '';
    }
    // output the table rows
    echo <<<EOT
        <tr>
            <td class="$tableclass" valign="top" align="center">
                {$loopCounter}
            </td>
            <td class="$tableclass" valign="top" align="center">
                <input name="cid_array[]" id="check{$row['msg_id']}" type="checkbox" value="{$row['msg_id']}" />
            </td>
            <td class="$tableclass" valign="top" align="left">
                {$comment_approval_status}
            </td>
            <td class="$tableclass" valign="top">$profile_link_start{$row['msg_author']}$profile_link_end $ban_and_delete</td>
            <td class="$tableclass" valign="top">{$msg_date}</td>
            <td class="$tableclass" valign="top">
                {$msg_body}
            </td>
            <td class="$tableclass" align="center">
                <a href="$thumb_link"><img src="$thumb_url" {$image_size['geom']} class="image" border="0" alt="" title="$thumb_url" /></a>
            </td>
        </tr>

EOT;
    flush();
}

//mysql_free_result($result);
$cpgdb->free();		###################  cpgdb_AL



// output the table footer
echo <<<EOT
        <tr>
            <td class="tablef" valign="middle" align="center">
            </td>
            <td class="tablef" valign="middle" align="center">
                <input type="checkbox" name="checkAll2" onClick="selectAll(this,'cid_array');" class="checkbox" title="{$lang_common['check_uncheck_all']}" />
            </td>
            <td colspan="3" class="tablef" valign="middle" align="left">
                {$lang_reviewcom_php['with_selected']}: 
                <input name="with_selected" id="delete_selected" type="radio" value="delete" />
                <label for="delete_selected">{$lang_reviewcom_php['delete']}</label>
                &nbsp;
                <input name="with_selected" id="approve_selected" type="radio" value="approve" checked="checked" />
                <label for="approve_selected">{$lang_reviewcom_php['approve']}</label>
                &nbsp;
                <input name="with_selected" id="disapprove_selected" type="radio" value="disapprove" />
                <label for="disapprove_selected">{$lang_reviewcom_php['disapprove']}</label>
            </td>
            <td colspan="2" align="center" class="tablef">
                <input type="hidden" name="total_message_id_collector" value="{$totalMessageIdCollector}" />
                <input type="submit" value="{$lang_reviewcom_php['save_changes']}" class="button" onclick="return checkBeforeSubmit();" />
                </td>
        </tr>

EOT;
endtable();
echo '</form>';
pagefooter();
ob_end_flush();
} // mass approval end
?>
