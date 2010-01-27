<?php
/**************************************************
  CPG Photo Shop Plugin for Coppermine Photo Gallery
  *************************************************
  Copyright (c) 2006 Thomas Lange <stramm@gmx.net>
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Coppermine version: 1.4.19
  Photo Shop version: 1.4.0
  $Revision: 1.0 $
  $Author: stramm $
***************************************************/

define('PHOTOSHOP_ADMIN_PHP', true);
define('PHOTOSHOP_IPN_PHP', true);

require('include/init.inc.php');
require('include/mailer.inc.php');

$lang = isset($USER['lang']) ? $USER['lang'] : $CONFIG['lang'];
if (!file_exists("plugins/photo_shop/lang/{$lang}.php"))
  $lang = 'english';
require "plugins/photo_shop/lang/{$lang}.php";


if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (!(GALLERY_ADMIN_MODE))	cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
//archive??
$box = isset($_REQUEST['box']) ? $_REQUEST['box'] : 0;
$box != 0 ? $box = 1 : $box = 0;
$box == 0 ? $name = $lang_photoshop_admin['Active'] : $name = $lang_photoshop_admin['Archive'];


/**************************************************
status codes
0001 (1)= unviewed (gross)
0010 (2)= payed (all)
0100 (4)= sent (all)
***************************************************/
if( isset($_GET['download']) && isset($_GET['oid']) && isset($_GET['uid']))
{
	switch ($_GET['download']) {
		case "delete_dir":
				pageheader($lang_photoshop_admin['o_board_title']);
				if(photo_shop_dir_springbreak($_GET['uid'], $_GET['oid'])) {

					msg_box("{$lang_photoshop_ipn['ipn_deleted_folder']} {$_GET['oid']}", "{$lang_photoshop_ipn['ipn_deleted_folder']} {$_GET['oid']}", $lang_photoshop_ipn['ipn_continue'], str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin&amp;box={$_REQUEST['box']}"), '100%');
				} else { //folder doesn't exist

					msg_box("{$lang_photoshop_ipn['ipn_deleted_folder_error']} {$_GET['oid']}", "{$lang_photoshop_ipn['ipn_deleted_folder_error']} {$_GET['oid']}", $lang_photoshop_ipn['ipn_continue'], str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin&amp;box={$_REQUEST['box']}"), '100%');

				}
				pagefooter();
				die();

		break;
		case "create_dir":
				$CONFIG['photo_shop_download_passwd_mail']=='1' ? $send_admin_mail = true : $send_admin_mail = false;
				pageheader($lang_photoshop_admin['o_board_title']);

				if(photo_shop_ipn_download_check($_GET['uid'], $_GET['oid']) == true) {
					if (photo_shop_ipn_download($_GET['uid'], $_GET['oid'], $send_admin_mail, false)) {

						msg_box("{$lang_photoshop_ipn['ipn_created_folder']} {$_GET['oid']}", "{$lang_photoshop_ipn['ipn_created_folder']} {$_GET['oid']}", $lang_photoshop_ipn['ipn_continue'], str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin&amp;box={$_REQUEST['box']}"), '100%');

					} else {

						msg_box("{$lang_photoshop_ipn['ipn_created_folder_error']} {$_GET['oid']}", "{$lang_photoshop_ipn['ipn_created_folder_error']} {$_GET['oid']}", $lang_photoshop_ipn['ipn_continue'], str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin&amp;box={$_REQUEST['box']}"), '100%');
					}
				} else {
						msg_box("{$lang_photoshop_ipn['ipn_no_download_items']} {$_GET['oid']}", "{$lang_photoshop_ipn['ipn_no_download_items']} {$_GET['oid']}", $lang_photoshop_ipn['ipn_continue'], str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin&amp;box={$_REQUEST['box']}"), '100%');

				}

				pagefooter();
				die();
		break;
		case "copy_files":
			if(photo_shop_ipn_download_check($_GET['uid'], $_GET['oid'])) {

			    $sql = "SELECT order_md5_id FROM {$CONFIG['TABLE_SHOP']} WHERE oid='{$_GET['oid']}' AND cd='1'";
			    $result = cpg_db_query($sql);
			    $row = cpg_db_fetch_row($result);
			    mysql_free_result($result);
				$hash = $row['order_md5_id'];
				header('Location: '.str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_download_order&amp;order={$hash}&amp;return_lnk=index"));
				die();
			} else {
				pageheader($lang_photoshop_admin['o_board_title']);
				msg_box("{$lang_photoshop_ipn['ipn_no_download_items']} {$_GET['oid']}", "{$lang_photoshop_ipn['ipn_no_download_items']} {$_GET['oid']}", $lang_photoshop_ipn['ipn_continue'], str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin&amp;box={$_REQUEST['box']}"), '100%');
				pagefooter();
				die();
			}
		break;
		case "paypal_log":
		    $sql = "SELECT * FROM {$CONFIG['TABLE_SHOP_PAYPAL_LOG']} WHERE invoice='{$_GET['oid']}'";
		    $result = cpg_db_query($sql);
		    $row = cpg_db_fetch_row($result);
		    mysql_free_result($result);

		      	echo "<html><head><title>{$lang_photoshop_ipn['ipn_log']}</title></head><body bgcolor=lightgray><h3>{$lang_photoshop_ipn['ipn_log']}</h3>";
		      	foreach ($row as $key => $value) {
					if ((!is_numeric($key))) {
				   		echo "$key: $value<br>";
					}
			   	}

			   	echo "<br><center><form method=\"post\"><input type=\"button\" value=\"{$lang_photoshop_ipn['ipn_log_close_window']}\" onclick=\"window.close()\"></form></center>";
		      	echo "</body></html>";

			die();
		break;
	}
}// end dowhat



if( isset($_POST['dowhat']) && isset($_POST['orders']))
{

	switch ($_POST['dowhat']) {
	case "delete_orders":
		$mark_list=$_POST['orders'];
		while(list($key, $value) = each($mark_list))
			{
			cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET aktive=2 WHERE oid ='".$value."'");
			}
			header('Location: '.str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin&amp;box=".$_REQUEST['box']));
	   break;
	case "mark_active":
		$mark_list=$_POST['orders'];
		while(list($key) = each($mark_list))
			{
			cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET aktive=0 WHERE oid ='".$key."'");
			}
			header('Location: '.str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin&amp;box=".$_REQUEST['box']));
	   break;
	case "mark_archive":
		$mark_list=$_POST['orders'];
		while(list($key) = each($mark_list))
			{
			cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET aktive=1 WHERE oid ='".$key."'");
			}
			header('Location: '.str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin&amp;box=".$_REQUEST['box']));
	   break;
	case "mark_unviewed":
		$mark_list=$_POST['orders'];
		while(list($key) = each($mark_list))
			{
			$result = cpg_db_query("SELECT status FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$key." AND cd=1");
			$row = mysql_fetch_assoc($result);
			$stat = $row['status'] & 6;
			cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET status=".$stat." WHERE cd=1 AND oid ='".$key."'");
			mysql_free_result($result);
			}
			header('Location: '.str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin&amp;box=".$_REQUEST['box']));
	   break;
	case "mark_viewed":
		$mark_list=$_POST['orders'];
		while(list($key) = each($mark_list))
			{
			$result = cpg_db_query("SELECT status FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$key." AND cd=1");
			$row = mysql_fetch_assoc($result);
			$stat = $row['status'] | 1;
			cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET status=".$stat." WHERE cd=1 AND oid ='".$key."'");
			mysql_free_result($result);
			}
			header('Location: '.str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin&amp;box=".$_REQUEST['box']));
	   break;
	}
}// end dowhat


if( isset($_POST['dowhat_item']) && isset($_POST['orders']))
{

	switch ($_POST['dowhat_item']) {
	case "delete_orders":
		$mark_list=$_POST['orders'];
		while(list($key, $value) = each($mark_list))
			{
			cpg_db_query("DELETE FROM {$CONFIG['TABLE_SHOP']} WHERE id ='".$key."'");

			$result = cpg_db_query("SELECT sum(quantity) as total FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$_POST['oid']." AND cd=0");
			$row = mysql_fetch_assoc($result);
			mysql_free_result($result);
				$row['total'] = isset($row['total']) ? $row['total'] : 0;
				cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET quantity=".$row['total']." WHERE cd=1 AND oid ='".$_POST['oid']."'");

			}
			header('Location: '.str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin&amp;box=".$_POST['box']."&amp;oid=".$_POST['oid']));
	   break;
	case "mark_payed":
		$mark_list=$_POST['orders'];
		while(list($key, $value) = each($mark_list))
			{
			$status = $value | 2;
			cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET status=$status WHERE id ='".$key."'");
			//check if all status = payed -> set main payed
			$result = cpg_db_query("SELECT status  FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$_POST['oid']." AND cd=0;");
			$check=true;
				while($i=mysql_fetch_array($result))
				{
					if (($i['status'] & 2) != 2) $check=false;
				}
				mysql_free_result($result);

				if ($check) {
					$result = cpg_db_query("SELECT status FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$_POST['oid']." AND cd=1");
					$row = mysql_fetch_assoc($result);
					$stat = $row['status'] | 2;
					cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET status=".$stat." WHERE cd=1 AND oid ='".$_POST['oid']."'");
					mysql_free_result($result);
				}
			}
			header('Location: '.str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin&amp;box=".$_POST['box']."&amp;oid=".$_POST['oid']));
	   break;
	case "mark_unpayed":
		$mark_list=$_POST['orders'];
		while(list($key, $value) = each($mark_list))
			{
			$status = $value & 5;
			cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET status=$status WHERE id ='".$key."'");
			//we've set 1 unpayed.. means the main has to be set unpayed as well. No further checks needed
			$result = cpg_db_query("SELECT status FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$_POST['oid']." AND cd=1");
			$row = mysql_fetch_assoc($result);
			$stat = $row['status'] & 5;
			cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET status=".$stat." WHERE cd=1 AND oid ='".$_POST['oid']."'");
			mysql_free_result($result);
			}
			header('Location: '.str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin&amp;box=".$_POST['box']."&amp;oid=".$_POST['oid']));
	   break;
	case "mark_sent":
		$mark_list=$_POST['orders'];
		while(list($key, $value) = each($mark_list))
			{
			$status = $value | 4;
			cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET status=$status WHERE id ='".$key."'");
			//check if all status = payed -> set main payed
			$result = cpg_db_query("SELECT status  FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$_POST['oid']." AND cd=0;");
			$check=true;
				while($i=mysql_fetch_array($result))
				{
					if (($i['status'] & 4) != 4) $check=false;
				}
				mysql_free_result($result);
				if ($check) {
					$result = cpg_db_query("SELECT status FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$_POST['oid']." AND cd=1");
					$row = mysql_fetch_assoc($result);
					mysql_free_result($result);
					$stat = $row['status'] | 4;
					cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET status=".$stat." WHERE cd=1 AND oid ='".$_POST['oid']."'");
				}
			}
			header('Location: '.str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin&amp;box=".$_POST['box']."&amp;oid=".$_POST['oid']));
	   break;
	case "mark_unsent":
		$mark_list=$_POST['orders'];
		while(list($key, $value) = each($mark_list))
			{
			$status = $value & 3;
			cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET status=$status WHERE id ='".$key."'");
			//we've set 1 unpayed.. means the main has to be set unpayed as well. No further checks needed
			$result = cpg_db_query("SELECT status FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$_POST['oid']." AND cd=1");
			$row = mysql_fetch_assoc($result);
			mysql_free_result($result);
			$stat = $row['status'] & 3;
			cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET status=".$stat." WHERE cd=1 AND oid ='".$_POST['oid']."'");
			}
			header('Location: '.str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin&amp;box=".$_POST['box']."&amp;oid=".$_POST['oid']));
	   break;
	}

}// end dowhat

//now we do the bridging
//we have to get all object vars from the bridge child and save them in an array, then we extend core_udb with photo shop functions
$udb_var = get_object_vars($cpg_udb);

class photo_shop_udb extends core_udb {

	function photo_shop_fetch_orders($box, $sort_codes, $sort, $lower_limit, $orders_per_page){
		global $CONFIG, $udb_var;
		$sql = 	"SELECT s.*, u.{$udb_var['field']['username']}, u.{$udb_var['field']['email']}  FROM {$CONFIG['TABLE_SHOP']} AS s LEFT JOIN {$udb_var['usertable']} as u ON u.{$udb_var['field']['user_id']} = s.uid WHERE aktive=".$box." AND cd=1 ORDER BY ". $sort_codes[$sort] ." LIMIT $lower_limit, $orders_per_page";

		$result = cpg_db_query($sql, $this->link_id);
		return $result;
	}

	function photo_shop_fetch_user($oid){
		global $CONFIG, $udb_var;
		$sql = "SELECT s.*, u.{$udb_var['field']['username']}, u.{$udb_var['field']['email']}  FROM {$CONFIG['TABLE_SHOP']} AS s LEFT JOIN {$udb_var['usertable']} as u ON u.{$udb_var['field']['user_id']} = s.uid WHERE oid=".$oid." AND cd=1 LIMIT 1";

		$result = cpg_db_query($sql, $this->link_id);
		return $result;
	}
}

$cpg_udb = new photo_shop_udb;


$oid = isset($_REQUEST['oid']) ? $_REQUEST['oid'] : null;
if (!$oid) {//display a list of all orders

		//before we display the order list, we check for to delete download dirs
		if ($CONFIG['photo_shop_del_download_dir'] > 0) { //it's set
			$time = localised_timestamp() - $CONFIG['photo_shop_del_download_dir'] * 3600;

		    $result = cpg_db_query("SELECT oid, uid FROM {$CONFIG['TABLE_SHOP']} WHERE dtime < '$time' AND dtime > '0'");

		    if (mysql_num_rows($result) > 0) {
		        $rowset = cpg_db_fetch_rowset($result);
		        foreach ($rowset as $value) {
		            if ($value['oid'] && $value['uid']) {
						photo_shop_dir_springbreak($value['uid'], $value['oid']);
		            }
		        }
		    }
		}


		// Get total active count
		$result = cpg_db_query("SELECT count(DISTINCT oid) FROM {$CONFIG['TABLE_SHOP']} WHERE aktive='1'");
		list($tot_box[1]) = @mysql_fetch_array($result);
		mysql_free_result($result);
		// Get total archive count
		$result = cpg_db_query("SELECT count(DISTINCT oid) FROM {$CONFIG['TABLE_SHOP']} WHERE aktive='0'");
		list($tot_box[0]) = @mysql_fetch_array($result);
		mysql_free_result($result);

		$tot_orders = $tot_box[0]+$tot_box[1];
		$proc[0] = ceil($tot_box[0] / $tot_orders * 100);
		$proc[1] = ceil($tot_box[1] / $tot_orders * 100);

		if ($box=="0") {
			$thisfolder=$proc[0];
			$selected_aktive=' selected="selected"';
			$selected_archive='';
		} else {
			$thisfolder=$proc[1];
			$selected_archive=' selected="selected"';
			$selected_aktive='';
		}
		$allfolder=$proc[0]+$proc[1];

	    $sort_codes = array(
	        'oid_d' => 'oid DESC',
			'oid_a' => 'oid ASC',
	        'uid_d' => 'uid DESC',
			'uid_a' => 'uid ASC',
	        'otime_d' => 'otime DESC',
			'otime_a' => 'otime ASC',
	        );

	    $sort = (!isset($_GET['sort']) || !isset($sort_codes[$_GET['sort']])) ? 'oid_d' : $_GET['sort'];

	    $tab_tmpl = array('left_text' => '<td width="100%%" align="left" valign="middle" class="tableh1_compact" style="white-space: nowrap"><b>' . $lang_photoshop_admin['u_orders_on_p_pages'] . '</b></td>' . "\n",
	        'tab_header' => '',
	        'tab_trailer' => '',
	        'active_tab' => '<td><img src="images/spacer.gif" width="1" height="1" alt="" /></td>' . "\n" . '<td align="center" valign="middle" class="tableb_compact"><b>%d</b></td>',
	        'inactive_tab' => '<td><img src="images/spacer.gif" width="1" height="1" alt="" /></td>' . "\n" . '<td align="center" valign="middle" class="navmenu"><a href="index.php?file=photo_shop/photo_shop_admin&amp;page=%d&amp;box=' . $box . '&amp;sort=' . $sort . '"><b>%d</b></a></td>' . "\n",
			'active_next_tab' => '<td><img src="images/spacer.gif" width="1" height="1" alt="" /></td>' . "\n" . '<td align="center" valign="middle" class="tableb_compact"><b>%s</b></td>',
			'inactive_next_tab' => '<td><img src="images/spacer.gif" width="1" height="1" alt="" /></td>' . "\n" . '<td align="center" valign="middle" class="navmenu"><a href="index.php?file=photo_shop/photo_shop_admin&amp;page=%s&amp;box=' . $box . '&amp;sort=' . $sort . '"><b>Next</b></a></td>',
			'active_prev_tab' => '<td><img src="images/spacer.gif" width="1" height="1" alt="" /></td>' . "\n" . '<td align="center" valign="middle" class="tableb_compact"><b>%s</b></td>',
			'inactive_prev_tab' => '<td><img src="images/spacer.gif" width="1" height="1" alt="" /></td>' . "\n" . '<td align="center" valign="middle" class="navmenu"><a href="index.php?file=photo_shop/photo_shop_admin&amp;page=%s&amp;box=' . $box . '&amp;sort=' . $sort . '"><b>Prev</b></a></td>'
			);
	    $orders_per_page = 25;
	    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
	    $lower_limit = ($page-1) * $orders_per_page;
	    $total_pages = ceil($tot_box[$box] / $orders_per_page);

		//Fetch orders
		$result = $cpg_udb->photo_shop_fetch_orders($box, $sort_codes, $sort, $lower_limit, $orders_per_page);

		//total_orders
		$result2 = cpg_db_query("SELECT count(*) FROM {$CONFIG['TABLE_SHOP']} WHERE aktive=".$box." AND cd=1");
		list($total) = @mysql_fetch_array($result2);
		mysql_free_result($result2);

		if ($total>0) $tabs = create_tabs($total, $page, $total_pages, $tab_tmpl);
		$lb = "<select name=\"album_listbox\" class=\"listbox\" onchange=\"if(this.options[this.selectedIndex].value) window.location.href='index.php?file=photo_shop/photo_shop_admin&amp;page=$page&amp;box=$box&amp;sort='+this.options[this.selectedIndex].value;\">\n";
			foreach($sort_codes as $key => $value) {
				  $selected = ($key == $sort) ? 'selected="selected"' : "";
				  $lb .= "        <option value=\"" . $key . "\" $selected>" . $lang_photoshop_admin[$key] . "</option>\n";
			}
		$lb .= "</select>\n";

		pageheader($lang_photoshop_admin['o_board_title']);
?>


<script type="text/javascript" language="javascript">
<!--
function checkBoxes (form, check) {
  for (var c = 0; c < form.elements.length; c++)
    if (form.elements[c].type == 'checkbox')
      form.elements[c].checked = check;
}
-->
</script>


<?php
echo <<<EOT
	<form action="index.php?file=photo_shop/photo_shop_admin" method="post">
	<table class="maintable" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
	<thead>
		<tr>
			<td class="tableh1" colspan="4" style="padding: 6px 0 6px 6px">
				<span style="float:left"><strong>{$lang_photoshop_admin['OrdersIn']}</strong>: {$name}</span><span style="float:right;cursor:pointer" onclick="window.location='index.php?file=photo_shop/photo_shop_config';">{$lang_photoshop_admin['config']}&nbsp; </span>
			</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="panelsurround" align="center">
			<div class="panel">
				<div style="width:480px" align="center">
					<fieldset class="fieldset">
						<legend>{$lang_photoshop_admin['managefolder']}</legend>
						<table cellpadding="0" cellspacing="3" border="0" width="100%">
						<tr>
							<td><strong>{$name}</strong> {$lang_photoshop_admin['contains']} {$tot_box[$box]} {$lang_photoshop_admin['order_s']}.<br />{$lang_photoshop_admin['in_total']} {$tot_orders} {$lang_photoshop_admin['orders_stored']}.</td>
						</tr>
						<tr>
							<td>
								<table style="border:2px groove" cellpadding="0" cellspacing="1" border="0" width="100%">
								<tr>
									<td width="{$proc[$box]}%" class="pms_linecolor1" title="{$lang_photoshop_admin['stored_orders']}: {$tot_box[$box]}">&nbsp;</td>
									<td width="{$allfolder}%" class="pms_linecolor2" title="{$lang_photoshop_admin['total_orders']}: {$tot_orders}">&nbsp;</td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								{$lang_photoshop_admin['switch']}:<br />
								<select name="box" class="listbox" style="width: 200px;" onchange="this.form.submit();">
								<option value="0" {$selected_aktive}>{$lang_photoshop_admin['Active']} ({$tot_box[0]} {$lang_photoshop_admin['orders']})</option>
								<option value="1" {$selected_archive}>{$lang_photoshop_admin['Archive']} ({$tot_box[1]} {$lang_photoshop_admin['orders']})</option>

								</select><!-- go button -->
	<input type="submit" class="button" value="{$lang_photoshop_admin['go']}"  />
							</td>
						</tr>
						</table>
					</fieldset>
				</div>
			</div>
			</td>
		</tr>
	</tbody>
	</table>
	</form>

	<br />


<form action="index.php?file=photo_shop/photo_shop_admin" method="post" name="form">
<table class="maintable" cellpadding="0" cellspacing="1" border="0" width="100%" align="center">
<thead>
	<tr>
		<td class="tableh1" colspan="4" style="padding: 6px 0 6px 6px">
			<span class="smallfont" style="float:right">
				<label for="checkall_all">
				{$lang_photoshop_admin['Orders']}: <strong>{$total}</strong>
				<input type="checkbox" name="allbox" id="checkall_all" title="{$lang_photoshop_admin['mark_all']}" onclick="checkBoxes(this.form, this.checked)" />
				</label>
			</span>
			<strong>{$lang_photoshop_admin['OrdersIn']}</strong><span>: <span>{$name} ({$tot_box[$box]})</span></span>
		</td>
	</tr>
</thead>
<tr><td>
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
EOT;
if ($total>0){
	//get all the message data
	//$id = array();
	$icon_type = array();
	while($i=mysql_fetch_array($result))
	{
		$user_name[] = $i[$udb_var['field']['username']];
		$user_email[] = $i[$udb_var['field']['email']];
		$this_id[] = $i['id'];
		$oid[] = $i['oid'];
		$uid_tmp[] = $i['uid'];
		$quantity[] = $i['quantity'];
		$price[] = $i['price'];
		$otime[] = $i['otime'];
		$status[] = $i['status'];
		$aktive[] = $i['aktive'];
	}
	//process date grouping and icons
	for ($i=0;$i<count($user_name);$i++)
	{
		(($status[$i] & 1) != 1) ? $icon_type1[$i] = $THEME_DIR.'images/pm_new.gif' : $icon_type1[$i] = $THEME_DIR.'images/pm_old.gif';
		(($status[$i] & 2) != 2) ? $icon_type2[$i] = $THEME_DIR.'images/s_pos.gif' : $icon_type2[$i] = $THEME_DIR.'images/s_neg.gif';
		(($status[$i] & 4) != 4) ? $icon_type3[$i] = $THEME_DIR.'images/s_pos.gif' : $icon_type3[$i] = $THEME_DIR.'images/s_neg.gif';
	}
	mysql_free_result($result);


	echo <<<EOT
	<tbody>
EOT;
	for ($k=0;$k<count($this_id);$k++)
	{
		$thistime=date('H:i:s', $otime[$k]);
		$thisdate=date('M-d-Y', $otime[$k]);

		$button_list[$k] = '';
		if ($CONFIG['photo_shop_download_enable']=='1') {
			if ($CONFIG['photo_shop_paypal_enable']=='1') {
				//do we have an IPN log entry... yes, then display [P] button
				$result = cpg_db_query("SELECT 1 FROM {$CONFIG['TABLE_SHOP_PAYPAL_LOG']} WHERE invoice='{$oid[$k]}'");
				if(mysql_fetch_row($result)){

					$link = "index.php?file=photo_shop/photo_shop_admin&box={$box}&oid={$oid[$k]}&uid={$uid_tmp[$k]}&download=paypal_log";
					$button_list[$k] .= "<a href=\"javascript:;\" onclick=\"coppermine_shop_window=window.open('{$link}','coppermine_help','scrollbars=yes,toolbar=no,status=no,resizable=yes,width=550,height=620'); coppermine_shop_window.focus()\" style=\"cursor:hand\"> <img src=\"{$THEME_DIR}images/p.gif\" border=\"0\" width=\"14\" height=\"14\" title=\"{$lang_photoshop_ipn['ipn_button_show_log']}\" alt=\"{$lang_photoshop_ipn['ipn_button_show_log']}\"></a>";
				}
			//are there any items for download so we need the control icons?
			if(photo_shop_ipn_download_check($uid_tmp[$k], $oid[$k])) {

				$button_list[$k] .= "<a href=\"index.php?file=photo_shop/photo_shop_admin&box={$box}&oid={$oid[$k]}&uid={$uid_tmp[$k]}&download=create_dir\"> <img src=\"{$THEME_DIR}images/d.gif\" border=\"0\" width=\"14\" height=\"14\" title=\"{$lang_photoshop_ipn['ipn_button_create_dir']}\" alt=\"{$lang_photoshop_ipn['ipn_button_create_dir']}\"></a>";

				$button_list[$k] .= "<a href=\"index.php?file=photo_shop/photo_shop_admin&box={$box}&oid={$oid[$k]}&uid={$uid_tmp[$k]}&download=copy_files\"> <img src=\"{$THEME_DIR}images/c.gif\" border=\"0\" width=\"14\" height=\"14\" title=\"{$lang_photoshop_ipn['ipn_button_copy_files']}\" alt=\"{$lang_photoshop_ipn['ipn_button_copy_files']}\"></a>";

				$button_list[$k] .= "<a href=\"index.php?file=photo_shop/photo_shop_admin&box={$box}&oid={$oid[$k]}&uid={$uid_tmp[$k]}&download=delete_dir\"> <img src=\"{$THEME_DIR}images/x.gif\" border=\"0\" width=\"14\" height=\"14\" title=\"{$lang_photoshop_ipn['ipn_button_delete_dir']}\" alt=\"{$lang_photoshop_ipn['ipn_button_delete_dir']}\"></a>";
			} //  are there items for download end
		}
	}
	echo <<<EOT
		<tr>
		<td class="alt1 smallfont" width="50px">
		v<img src="$icon_type1[$k]" alt="" border="0" /><br>
		p<img src="$icon_type2[$k]" alt="" border="0" /><br>
		s<img src="$icon_type3[$k]" alt="" border="0" />
		</td>
		<td class="alt2">&nbsp;<a href="profile.php?uid={$uid_tmp[$k]}">{$user_name[$k]}</a>&nbsp;</td>
		<td class="alt1Active" width="75%">

			<div>
				<span style="float:right" class="smallfont">Date: {$thisdate} - {$thistime}</span>
				<div style="cursor:crosshair" onclick="window.location='index.php?file=photo_shop/photo_shop_admin&amp;oid={$oid[$k]}&amp;box={$box}';">
				{$lang_photoshop_admin['noitems']}: {$quantity[$k]}<br />
				{$lang_photoshop_admin['volume']}: {$price[$k]} {$CONFIG['photo_shop_currency']} - {$lang_photoshop_admin['incl_ship']}
				</div>
			</div>
			<div class="smallfont">
				<span style="float:right;"><a href="index.php?file=photo_shop/photo_shop_zip&oid={$oid[$k]}">{$lang_photoshop_admin['download_zip']}</a></span><br>
				<span style="float:right;"><a href="mailto:{$user_email[$k]}">{$user_email[$k]}</a></span>
				<span style="cursor:crosshair" onclick="window.location='index.php?file=photo_shop/photo_shop_admin&amp;oid={$oid[$k]}&amp;box={$box}';">{$lang_photoshop_admin['order_id']}: {$oid[$k]}&nbsp;&nbsp;- &nbsp;&nbsp;{$lang_photoshop_admin['user_id']}: {$uid_tmp[$k]}</span>{$button_list[$k]}
			</div>

		</td>
		<td class="alt2" align="center" style="padding:0px"><input type="checkbox" name="orders[{$oid[$k]}]" value="{$oid[$k]}" /></td>
	</tr>

EOT;

	}
	echo <<<EOT
	</tbody>
EOT;

	} else // if there are no orders to display
	{
		echo '<tr><td class="alt1">'.$lang_photoshop_admin['NoOrders'].'</td></tr>'."\n";
	}


echo <<<EOT


<table class=" " cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
<thead>
	<tr>
		<td class="tablef" align="left">
			<div class="smallfont">
				{$lang_photoshop_admin['sort_by']} {$lb}
			</div>
		</td>
		<td class="tablef" align="right" colspan="4">
			<div class="smallfont">
				{$lang_photoshop_admin['SelectedOrders']}
				<select name="dowhat" class="listbox">
					<option value="mark_archive">{$lang_photoshop_admin['markarchive']}</option>
					<option value="mark_active">{$lang_photoshop_admin['markactive']}</option>
					<option value="mark_unviewed">{$lang_photoshop_admin['mark_unviewed']}</option>
					<option value="mark_viewed">{$lang_photoshop_admin['mark_viewed']}</option>
					<option value="delete_orders">{$lang_photoshop_admin['delete']}</option>
				</select>
				<input type="hidden" name="box" value="{$box}" />
				<input type="submit" class="button" value="{$lang_photoshop_admin['go']}" />
			</div>
		</td>
	</tr>
    <tr>
              <td colspan="5" style="padding: 0px;">
                      <table width="100%" cellspacing="0" cellpadding="0">
                              <tr>
                                      {$tabs}
                              </tr>
                      </table>
              </td>
    </tr>
</thead>
</table>
</form>
</tr></td></table>


<table class="pms_legend" cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
<tr><td><img src="{$THEME_DIR}images/s_neg.gif" border="0" alt="" /></td><td class="smallfont">&nbsp;&nbsp;{$lang_photoshop_admin['pos']}</td></tr>
<tr><td><img src="{$THEME_DIR}images/s_pos.gif" border="0" alt="" /></td><td class="smallfont">&nbsp;&nbsp;{$lang_photoshop_admin['neg']}</td></tr>


EOT;
endtable();
pagefooter();
ob_end_flush();
}
else { //display specific order oid

//set viewed
	$result = cpg_db_query("SELECT status FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$oid." AND cd=1");
	$row = mysql_fetch_assoc($result);
	$stat = $row['status'] | 1;
	cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET status=".$stat." WHERE cd=1 AND oid ='".$oid."'");
	mysql_free_result($result);

	//bridge
	//$result = cpg_db_query("SELECT s.*, u.user_name, u.user_email  FROM {$CONFIG['TABLE_SHOP']} AS s LEFT JOIN {$CONFIG['TABLE_USERS']} as u ON u.user_id = s.uid WHERE oid=".$oid." AND cd=1 LIMIT 1;");
	$result = $cpg_udb->photo_shop_fetch_user($oid);

	$row = mysql_fetch_assoc($result);
	mysql_free_result($result);

	pageheader($lang_photoshop_admin['o_board_title']);
?>


<script type="text/javascript" language="javascript">
<!--
function checkBoxes (form, check) {
  for (var c = 0; c < form.elements.length; c++)
    if (form.elements[c].type == 'checkbox')
      form.elements[c].checked = check;
}
-->
</script>


<?php
echo <<<EOT
<form action="index.php?file=photo_shop/photo_shop_admin" method="post" name="form">
<table class="maintable" cellpadding="0" cellspacing="1" border="0" width="100%" align="center">
<thead>
	<tr>
		<td class="tableh1" colspan="4" style="padding: 6px 0 6px 6px">
			<span class="smallfont" style="float:right">
				<label for="checkall_all">
				{$lang_photoshop_admin['order_id']}: <strong>{$oid}</strong>
				<input type="checkbox" name="allbox" id="checkall_all" title="{$lang_photoshop_admin['mark_all']}" onclick="checkBoxes(this.form, this.checked)" />
				</label>
			</span>
			<strong>{$lang_photoshop_admin['order_id']}</strong>: {$oid} - <strong>{$lang_photoshop_admin['items']}</strong>: {$row['quantity']} - <strong>{$CONFIG['photo_shop_currency']} {$lang_photoshop_admin['total']}</strong>: {$row['price']} {$lang_photoshop_admin['incl_ship']}<br>
			<span style="cursor:pointer" onclick="window.location='profile.php?uid={$row['uid']}';">{$row['user_name']}</span> -
			<span style="cursor:pointer" onclick="window.location='mailto:{$row['user_email']}';">{$row['user_email']}</span>
		</td>
	</tr>
</thead>
<tr><td>
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
EOT;
	$result2 = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$oid." AND cd<>1;");
	while($i=mysql_fetch_array($result2))
	{
		$this_id[] = $i['id'];
		$pid[] = $i['pid'];
		$size[] = $i['size'];
		$quantity[] = $i['quantity'];
		$price[] = $i['price'];
		$otime[] = $i['otime'];
		$status[] = $i['status'];
		$aktive[] = $i['aktive'];
	}
	mysql_free_result($result2);
	for ($i=0;$i<count($this_id);$i++)
	{
		(($status[$i] & 2) != 2) ? $icon_type2[$i] = $THEME_DIR.'images/s_pos.gif' : $icon_type2[$i] = $THEME_DIR.'images/s_neg.gif';
		(($status[$i] & 4) != 4) ? $icon_type3[$i] = $THEME_DIR.'images/s_pos.gif' : $icon_type3[$i] = $THEME_DIR.'images/s_neg.gif';
	}
	echo <<<EOT
	<tbody>
EOT;
	for ($k=0;$k<count($this_id);$k++)
	{

		$select_columns = 'filepath, filename, url_prefix, filesize, pwidth, pheight, ctime, title';
		$result3 = cpg_db_query("SELECT $select_columns from {$CONFIG['TABLE_PICTURES']} WHERE pid='{$pid[$k]}' LIMIT 1");
	    $row_pic = mysql_fetch_array($result3);
		mysql_free_result($result3);

		//html resize thumb
		if ($CONFIG['enable_mini_thumbs'] == '1') { // if you use the modpack and have enabled mini thumbs -> these get used instead of html resized thumbs
			$thumb_url= get_pic_url($row_pic, 'mini');
		    $destWidth = $CONFIG['mini_thumb_width'];
		    $destHeight = $CONFIG['mini_thumb_height'];
		} else {
			$thumb_url= get_pic_url($row_pic, 'thumb');
			$new_size = 60;
		    $ratio = max($row_pic['pwidth'], $row_pic['pheight']) / $new_size;
		    $ratio = max($ratio, 1.0);
		    $destWidth = (int)($row_pic['pwidth'] / $ratio);
		    $destHeight = (int)($row_pic['pheight'] / $ratio);
		}
		$item_price =  number_format($quantity[$k]*$price[$k],2);
	echo <<<EOT

		<tr>
		<td class="alt1 smallfont" width="50px">
		p<img src="$icon_type2[$k]" alt="" border="0" /><br>
		s<img src="$icon_type3[$k]" alt="" border="0" />
		</td>
		<td class="alt2">&nbsp;<a href="displayimage.php?pos=-{$pid[$k]}"><img class="image" src="{$thumb_url}" width="{$destWidth}" height="{$destHeight}" alt="" /></a>&nbsp;</td>
		<td class="alt1Active" width="75%">

			<div>
				<span style="float:right" class="smallfont">{$lang_photoshop_admin['item_price']}: {$quantity[$k]} * {$price[$k]} {$CONFIG['photo_shop_currency']} = {$item_price} {$CONFIG['photo_shop_currency']}</span>
				<div style="cursor:pointer" onclick="window.location='index.php?file=photo_shop/photo_shop_admin&amp;box={$box}';">
				{$lang_photoshop_admin['size']}: {$size[$k]}<br />
				{$lang_photoshop_admin['amount']}: {$quantity[$k]} :: {$lang_photoshop_admin['pid']}: -{$pid[$k]}
				</div>
			</div>
			<div class="smallfont">
				<span style="float:right;">{$lang_photoshop_admin['filename']}: {$row_pic['filename']}</span>
				<span>{$lang_photoshop_admin['price_pi']}: {$price[$k]} {$CONFIG['photo_shop_currency']}</span>
			</div>

		</td>
		<td class="alt2" align="center" style="padding:0px"><input type="checkbox" name="orders[{$this_id[$k]}]" value="{$status[$k]}" /></td>
	</tr>
EOT;

	}
	echo <<<EOT
	</tbody>
EOT;


echo <<<EOT


<table class=" " cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
<thead>
	<tr>

		<td class="tablef" align="right" colspan="4">
			<div class="smallfont">
				{$lang_photoshop_admin['SelectedOrders']}
				<select name="dowhat_item" class="listbox">
					<option value="mark_payed">{$lang_photoshop_admin['mark_payed']}</option>
					<option value="mark_unpayed">{$lang_photoshop_admin['mark_unpayed']}</option>
					<option value="mark_sent">{$lang_photoshop_admin['mark_sent']}</option>
					<option value="mark_unsent">{$lang_photoshop_admin['mark_unsent']}</option>
					<option value="delete_orders">{$lang_photoshop_admin['delete']}</option>
				</select>
				<input type="hidden" name="box" value="{$box}" />
				<input type="hidden" name="oid" value="{$oid}" />
				<input type="submit" class="button" value="{$lang_photoshop_admin['go']}" />
			</div>
		</td>
	</tr>
    <tr>
              <td colspan="5" style="padding: 0px;">
                      <table width="100%" cellspacing="0" cellpadding="0">
                              <tr>
                                      {$tabs}
                              </tr>
                      </table>
              </td>
    </tr>
</thead>
</table>
</form>
</tr></td></table>


<table class="pms_legend" cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
<tr><td><img src="{$THEME_DIR}images/s_neg.gif" border="0" alt="" /></td><td class="smallfont">&nbsp;&nbsp;{$lang_photoshop_admin['pos']}</td></tr>
<tr><td><img src="{$THEME_DIR}images/s_pos.gif" border="0" alt="" /></td><td class="smallfont">&nbsp;&nbsp;{$lang_photoshop_admin['neg']}</td></tr>
EOT;

endtable();
pagefooter();
ob_end_flush();
}
?>