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

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (!$CONFIG['photo_shop_show_myorders'] == '1') cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

if ((!USER_ID && $CONFIG['allow_unlogged_access'] == 0) || !$CONFIG['photo_shop_enabled']) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

$lang = isset($USER['lang']) ? $USER['lang'] : $CONFIG['lang'];
if (!file_exists("plugins/photo_shop/lang/{$lang}.php"))
  $lang = 'english';
require "plugins/photo_shop/lang/{$lang}.php";


if( isset($_GET['download']) && isset($_GET['oid']) && isset($_GET['uid']))
{
	switch ($_GET['download']) {
		case "copy_files":
			//check again if paid
				if (!verify_paid($_GET['oid'])) {
					cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
				}

			    $sql = "SELECT order_md5_id FROM {$CONFIG['TABLE_SHOP']} WHERE oid='{$_GET['oid']}' AND cd='1'";
			    $result = cpg_db_query($sql);
			    $row = cpg_db_fetch_row($result);
			    mysql_free_result($result);
				$hash = $row['order_md5_id'];

				header('Location: '.str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_download_order&amp;order={$hash}"));
				die();

		break;
		case "create_dir":
				if (!verify_paid($_GET['oid'])) {
					cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
				}

				$CONFIG['photo_shop_download_passwd_mail']=='1' ? $send_admin_mail = true : $send_admin_mail = false;
				pageheader($lang_photoshop_admin['o_board_title']);
				if (photo_shop_ipn_download(USER_ID, $_GET['oid'], $send_admin_mail, false)) {
					msg_box("{$lang_photoshop_ipn['ipn_created_folder']} {$_GET['oid']}", "{$lang_photoshop_ipn['ipn_created_folder']} {$_GET['oid']}", $lang_photoshop_ipn['ipn_continue'], "index.php?file=photo_shop/photo_shop_myorders", '100%');
				} else {
					msg_box("{$lang_photoshop_ipn['ipn_created_folder_error']} {$_GET['oid']}", "{$lang_photoshop_ipn['ipn_created_folder_error']} {$_GET['oid']}", $lang_photoshop_ipn['ipn_continue'], "index.php?file=photo_shop/photo_shop_myorders", '100%');
				}
				pagefooter();
				die();
		break;
	}
}// end dowhat



//now we do the bridging, this is very sucky...
//we have to get all object vars from the bridge child and save them in an array, then we extend core_udb with photo shop functions
$udb_var = get_object_vars($cpg_udb);

class photo_shop_udb extends core_udb {

	function photo_shop_fetch_orders($box, $sort_codes, $sort, $lower_limit, $orders_per_page){
		global $CONFIG, $udb_var;
		$sql = 	"SELECT s.*, u.{$udb_var['field']['username']}, u.{$udb_var['field']['email']}  FROM {$CONFIG['TABLE_SHOP']} AS s LEFT JOIN {$udb_var['usertable']} as u ON u.{$udb_var['field']['user_id']} = s.uid WHERE aktive=".$box." AND cd=1 AND uid=".USER_ID." ORDER BY ". $sort_codes[$sort] ." LIMIT $lower_limit, $orders_per_page";

		$result = cpg_db_query($sql, $this->link_id);
		return $result;
	}

	function photo_shop_fetch_user($oid){
		global $CONFIG, $udb_var;
		$sql = "SELECT s.*, u.{$udb_var['field']['username']}, u.{$udb_var['field']['email']}  FROM {$CONFIG['TABLE_SHOP']} AS s LEFT JOIN {$udb_var['usertable']} as u ON u.{$udb_var['field']['user_id']} = s.uid WHERE oid=".$oid." AND cd=1 AND s.uid=".USER_ID." LIMIT 1";

		$result = cpg_db_query($sql, $this->link_id);
		return $result;
	}
}

$cpg_udb = new photo_shop_udb;



if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');


//archive??
$box = isset($_REQUEST['box']) ? $_REQUEST['box'] : 0;
$box != 0 ? $box = 1 : $box = 0;
$box == 0 ? $name = $lang_photoshop_admin['Active'] : $name = $lang_photoshop_admin['Archive'];


$oid = isset($_REQUEST['oid']) ? $_REQUEST['oid'] : null;
if (!$oid) {//display a list of all orders
		// Get total active count
		$result = cpg_db_query("SELECT count(DISTINCT oid) FROM {$CONFIG['TABLE_SHOP']} WHERE aktive='1' AND uid=".USER_ID);
		list($tot_box[1]) = @mysql_fetch_array($result);
		mysql_free_result($result);
		// Get total archive count
		$result = cpg_db_query("SELECT count(DISTINCT oid) FROM {$CONFIG['TABLE_SHOP']} WHERE aktive='0' AND uid=".USER_ID);
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
	        'otime_d' => 'otime DESC',
			'otime_a' => 'otime ASC',
	        );

	    $sort = (!isset($_GET['sort']) || !isset($sort_codes[$_GET['sort']])) ? 'oid_d' : $_GET['sort'];

	    $tab_tmpl = array('left_text' => '<td width="100%%" align="left" valign="middle" class="tableh1_compact" style="white-space: nowrap"><b>' . $lang_photoshop_admin['u_orders_on_p_pages'] . '</b></td>' . "\n",
	        'tab_header' => '',
	        'tab_trailer' => '',
	        'active_tab' => '<td><img src="images/spacer.gif" width="1" height="1" alt="" /></td>' . "\n" . '<td align="center" valign="middle" class="tableb_compact"><b>%d</b></td>',
	        'inactive_tab' => '<td><img src="images/spacer.gif" width="1" height="1" alt="" /></td>' . "\n" . '<td align="center" valign="middle" class="navmenu"><a href="index.php?file=photo_shop/photo_shop_myorders&amp;page=%d&amp;box=' . $box . '&amp;sort=' . $sort . '"><b>%d</b></a></td>' . "\n",
			'active_next_tab' => '<td><img src="images/spacer.gif" width="1" height="1" alt="" /></td>' . "\n" . '<td align="center" valign="middle" class="tableb_compact"><b>%s</b></td>',
			'inactive_next_tab' => '<td><img src="images/spacer.gif" width="1" height="1" alt="" /></td>' . "\n" . '<td align="center" valign="middle" class="navmenu"><a href="index.php?file=photo_shop/photo_shop_myorders&amp;page=%s&amp;box=' . $box . '&amp;sort=' . $sort . '"><b>Next</b></a></td>',
			'active_prev_tab' => '<td><img src="images/spacer.gif" width="1" height="1" alt="" /></td>' . "\n" . '<td align="center" valign="middle" class="tableb_compact"><b>%s</b></td>',
			'inactive_prev_tab' => '<td><img src="images/spacer.gif" width="1" height="1" alt="" /></td>' . "\n" . '<td align="center" valign="middle" class="navmenu"><a href="index.php?file=photo_shop/photo_shop_myorders&amp;page=%s&amp;box=' . $box . '&amp;sort=' . $sort . '"><b>Prev</b></a></td>'
			);
	    $orders_per_page = 25;
	    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
	    $lower_limit = ($page-1) * $orders_per_page;
	    $total_pages = ceil($tot_box[$box] / $orders_per_page);

		//Fetch orders
		//bridge
		//$result = cpg_db_query("SELECT s.*, u.user_name, u.user_email  FROM {$CONFIG['TABLE_SHOP']} AS s LEFT JOIN {$CONFIG['TABLE_USERS']} as u ON u.user_id = s.uid WHERE aktive=".$box." AND cd=1 ORDER BY ". $sort_codes[$sort] ." LIMIT $lower_limit, $orders_per_page;");
		$result = $cpg_udb->photo_shop_fetch_orders($box, $sort_codes, $sort, $lower_limit, $orders_per_page);

		//total_orders
		$result2 = cpg_db_query("SELECT count(*) FROM {$CONFIG['TABLE_SHOP']} WHERE aktive=".$box." AND cd=1 AND uid=".USER_ID);
		list($total) = @mysql_fetch_array($result2);
		mysql_free_result($result2);

		if ($total>0) $tabs = create_tabs($total, $page, $total_pages, $tab_tmpl);
		$lb = "<select name=\"album_listbox\" class=\"listbox\" onchange=\"if(this.options[this.selectedIndex].value) window.location.href='index.php?file=photo_shop/photo_shop_myorders&amp;page=$page&amp;box=$box&amp;sort='+this.options[this.selectedIndex].value;\">\n";
			foreach($sort_codes as $key => $value) {
				  $selected = ($key == $sort) ? 'selected="selected"' : "";
				  $lb .= "        <option value=\"" . $key . "\" $selected>" . $lang_photoshop_admin[$key] . "</option>\n";
			}
		$lb .= "</select>\n";

		pageheader($lang_photoshop_admin['o_board_title']);
?>


<?php
echo <<<EOT
	<form action="index.php?file=photo_shop/photo_shop_myorders" method="post">
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


<form action="index.php?file=photo_shop/photo_shop_myorders" method="post" name="form">
<table class="maintable" cellpadding="0" cellspacing="1" border="0" width="100%" align="center">
<thead>
	<tr>
		<td class="tableh1" colspan="4" style="padding: 6px 0 6px 6px">
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
		$user_name[] = $i['user_name'];
		$user_email[] = $i['user_email'];
		$this_id[] = $i['id'];
		$oid[] = $i['oid'];
		//$uid[] = $i['uid'];
		$quantity[] = $i['quantity'];
		$price[] = $i['price'];
		$otime[] = $i['otime'];
		$status[] = $i['status'];
		$aktive[] = $i['aktive'];
	}
	$uid = USER_ID;
	//process date grouping and icons
	for ($i=0;$i<count($user_name);$i++)
	{
		(($status[$i] & 2) != 2) ? $icon_type2[$i] = $THEME_DIR.'images/s_pos.gif' : $icon_type2[$i] = $THEME_DIR.'images/s_neg.gif';
		(($status[$i] & 4) != 4) ? $icon_type3[$i] = $THEME_DIR.'images/s_pos.gif' : $icon_type3[$i] = $THEME_DIR.'images/s_neg.gif';
		if (($status[$i] & 2) != 2) {//paid
			$order_paid[$i] = false;
		} else {
			$order_paid[$i] = true;
		}

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
			if(photo_shop_ipn_download_check($uid, $oid[$k])) { // sre there to download items

			//download files link
			//get order? is paid?
				if (verify_paid($oid[$k]) === true) {
					$button_list[$k] .= "<a href=\"index.php?file=photo_shop/photo_shop_myorders&oid={$oid[$k]}&uid={$uid}&download=create_dir\"> <img src=\"{$THEME_DIR}images/d.gif\" border=\"0\" width=\"14\" height=\"14\" title=\"{$lang_photoshop_ipn['ipn_button_create_dir']}\" alt=\"{$lang_photoshop_ipn['ipn_button_create_dir']}\"></a>";
					$button_list[$k] .= "<a href=\"index.php?file=photo_shop/photo_shop_myorders&oid={$oid[$k]}&uid={$uid}&download=copy_files\"> <img src=\"{$THEME_DIR}images/c.gif\" border=\"0\" width=\"14\" height=\"14\" title=\"{$lang_photoshop_ipn['ipn_button_copy_files']}\" alt=\"{$lang_photoshop_ipn['ipn_button_copy_files']}\"></a>";
				}
			}
		}

	echo <<<EOT
		<tr>
		<td class="alt1 smallfont" width="50px">
		p<img src="$icon_type2[$k]" alt="" border="0" /><br>
		s<img src="$icon_type3[$k]" alt="" border="0" />
		</td>
		<td class="alt2">&nbsp;<a href="profile.php?uid={$uid}">{$user_name[$k]}</a>&nbsp;</td>
		<td class="alt1Active" width="75%">

			<div>
				<span style="float:right" class="smallfont">Date: {$thisdate} - {$thistime}</span>
				<div style="cursor:pointer" onclick="window.location='index.php?file=photo_shop/photo_shop_myorders&amp;oid={$oid[$k]}&amp;box={$box}';">
				{$lang_photoshop_admin['noitems']}: {$quantity[$k]}<br />
				{$lang_photoshop_admin['volume']}: {$price[$k]} {$CONFIG['photo_shop_currency']} - {$lang_photoshop_admin['incl_ship']}
				</div>
			</div>
			<div class="smallfont">
				<span style="float:right;"> <!-- <a href="index.php?file=photo_shop/photo_shop_zip&oid={$oid[$k]}">{$lang_photoshop_admin['download_zip']}</a> --> </span><br>
				<span style="float:right;"> <!-- <a href="mailto:{$user_email[$k]}">{$user_email[$k]}</a> --> </span>
				<span style="cursor:pointer" onclick="window.location='index.php?file=photo_shop/photo_shop_myorders&amp;oid={$oid[$k]}&amp;box={$box}';">{$lang_photoshop_admin['order_id']}: {$oid[$k]}&nbsp;&nbsp;</span>{$button_list[$k]}
			</div>

		</td>
		<td class="alt2" align="center" style="padding:0px"></td>
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
	$result = $cpg_udb->photo_shop_fetch_user($oid);

	$row = mysql_fetch_assoc($result);
	mysql_free_result($result);

	pageheader($lang_photoshop_admin['o_board_title']);

echo <<<EOT
<form action="index.php?file=photo_shop/photo_shop_myorders" method="post" name="form">
<table class="maintable" cellpadding="0" cellspacing="1" border="0" width="100%" align="center">
<thead>
	<tr>
		<td class="tableh1" colspan="4" style="padding: 6px 0 6px 6px">
			<span class="smallfont" style="float:right">
				<label for="checkall_all">
				{$lang_photoshop_admin['order_id']}: <strong>{$oid}</strong>&nbsp;
				</label>
			</span>
			<strong>{$lang_photoshop_admin['order_id']}</strong>: {$oid} - <strong>{$lang_photoshop_admin['items']}</strong>: {$row['quantity']} - <strong>{$CONFIG['photo_shop_currency']} {$lang_photoshop_admin['usd_total']}</strong>: {$row['price']} {$lang_photoshop_admin['incl_ship']}<br>
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
				<div style="cursor:pointer" onclick="window.location='index.php?file=photo_shop/photo_shop_myorders&amp;box={$box}';">
				{$lang_photoshop_admin['size']}: {$size[$k]}<br />
				{$lang_photoshop_admin['amount']}: {$quantity[$k]} :: {$lang_photoshop_admin['pid']}: -{$pid[$k]}
				</div>
			</div>
			<div class="smallfont">
				<span style="float:right;">{$lang_photoshop_admin['filename']}: {$row_pic['filename']}</span>
				<span>{$lang_photoshop_admin['price_pi']}: {$price[$k]} {$CONFIG['photo_shop_currency']}</span>
			</div>

		</td>
		<td class="alt2" align="center" style="padding:0px"></td>
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


function verify_paid($oid){
	global $CONFIG;


	//now we check if min one of the items in that order is set paid
	$result = cpg_db_query("SELECT status  FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$oid." AND cd=0;");
	$check=false;
		while($i=mysql_fetch_array($result))
		{
			if (($i['status'] & 2) == 2) $check=true;
		}
	return $check;

/* if entire order is set paid
	$result = cpg_db_query("SELECT status FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$oid." AND cd=1");
	$row = cpg_db_fetch_row($result);

	if($row['status'] & 2) {
		return true;
	} else {
		return false;
	}
*/
}

?>