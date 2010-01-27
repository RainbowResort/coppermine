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
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$photoshop_home = dirname(__FILE__);
require_once($photoshop_home.'/include/functions.inc.php');

// Init
 $thisplugin->add_action('page_start','photoshop_start');

// Add plugin_install action
 $thisplugin->add_action('plugin_install','photoshop_install');

// Add plugin_uninstall action
 $thisplugin->add_action('plugin_uninstall','photoshop_uninstall');

// Add plugin_cleanup action
 $thisplugin->add_action('plugin_cleanup','photoshop_cleanup');

// Add plugin_configure action
 $thisplugin->add_action('plugin_configure','photoshop_configure');

// User menus
 $thisplugin->add_filter('template_html','photoshop_user_menu');

// Some filters
$thisplugin->add_filter('file_data','photoshop_add_item');


//functions
//Plugin init
function photoshop_start()
{
  global $CONFIG, $SHOP_CONFIG, $lang_photoshop, $lang_photoshop_config, $lang_photoshop;
  require 'plugins/photo_shop/include/init.inc.php';

  //add admin button
  photoshop_add_admin_button('index.php?file=photo_shop/photo_shop_admin',$lang_photoshop['admin_title'],'',$lang_photoshop['admin_title']);
}

//install
function photoshop_install(){
    // Install
    if ($_REQUEST['submit']=='Go!') {
        return true;
    } else {
        return 1;
    }
}

//uninstall
function photoshop_uninstall(){
        global $CONFIG;

        if (!isset($_POST['drop'])) return 1;

        if ($_POST['drop']) {
        		//tables
                cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_SHOP']}");
                cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_SHOP_CONFIG']}");
                cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_SHOP_PRICES']}");
                cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_SHOP_PAYPAL_LOG']}");
				//config entries
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_enabled'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_currency'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_vat'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_download_enable'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_download_passwd_mail'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_download_zip'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_del_download_dir'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_show_myorders'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_paypal_enable'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_paypal_email'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_paypal_currency'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_paypal_image'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_paypal_form_url'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_paypal_use_ipn'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_paypal_ssl_adress'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_paypal_ipn_log'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_paypal_ipn_logfile'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_paypal_ipn_notify_url'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_paypal_return_url'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_paypal_cancel_return_url'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_wire_enable'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_wire_routing'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_wire_account'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_wire_bank'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_wire_bank_address'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_wire_swift'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_google_enable'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_google_currency'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_google_button_width'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_google_button_height'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_google_button_style'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_google_button_loc'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_google_id'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='photo_shop_cc_enable'");
           }

        return true;
}

//cleanup, ask if we want to drop the table
function photoshop_cleanup($action) {

	global $lang_photoshop;

    if ($action===1) {
        echo <<< EOT
    <form action="{$_SERVER['REQUEST_URI']}" method="post">
        <p>
            {$lang_photoshop['uninstall']}
        </p>
        <div style="margin:25;">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><input type="radio" name="drop" value="1" /></td>
                <td>Yes</td>
            </tr>
            <tr>
                <td><input type="radio" name="drop" checked="checked" value="0" /></td>
                <td>No</td>
            </tr>
        </table>
        </div>
        <span>
           <input type="submit" name="submit" value="Submit" /> &nbsp;&nbsp;&nbsp;
            <input type="button" name="cancel" onClick="window.location='pluginmgr.php';" value="Cancel" />
        </span>
    </form>
EOT;
    }
}

//configure
function photoshop_configure($stop=true)
{
    global $errors, $CONFIG;
    require ('include/sql_parse.php');

    $db_update = 'plugins/photo_shop/sql/basic.sql';
    $sql_query = fread(fopen($db_update, 'r'), filesize($db_update));
    // Update table prefix
    $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);

    $sql_query = remove_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, ';');

    ?>
        <h2>Performing Database Updates<h2>
        <table class="maintable">

    <?php

    foreach($sql_query as $q) {
        echo "<tr><td class='debug_text' style='color: black;'>
		{$q}
		</td>";
        if (mysql_query($q)) {
            echo "<td class='debug_text' style='color: green;'>OK</td></tr>";
        } else {
            echo "<td class='debug_text' style='color: black;'>Already Done</td></tr>";
        }
    }

    echo "</table>";

    if ($stop) {
        echo <<< EOT

        <form action="{$_SERVER['REQUEST_URI']}" method="post">
            <input type="submit" value="Go!" name="submit" />
        </form>
EOT;
    }

}

//the user menu, 'ximages in cart, my orders, checkout'
function photoshop_user_menu(&$html){
    global $template_sys_menu_spacer, $lang_photoshop, $CONFIG;

    if ((!USER_ID && $CONFIG['allow_unlogged_access'] == 0) || !$CONFIG['photo_shop_enabled']) {
		$cart_menu = ''; //shop disabled, unlogged has no access, then don't show shop buttons
	} else {
	    if (!strpos($html,'{CART_MENU}')) {
			$html = str_replace('{SUB_MENU}','{SUB_MENU} <br /> {CART_MENU}',$html);
		}
		//if you do not want the MyOrders page then uncomment the following line and comment out the one with the menu entry
	    //$cart_menu = "<a style=\"padding:2px;\" class=\"admin_menu\" href=\"index.php?file=photo_shop/photo_shop_cart\">".photoshop_count()." {$lang_photoshop['in_cart']}</a> ".$template_sys_menu_spacer." <a href=\"index.php?file=photo_shop/photo_shop_checkout\" style=\"padding:2px;\" class=\"admin_menu\">{$lang_photoshop['checkout']}</a>";
	    $cart_menu = "<a style=\"padding:2px;\" class=\"admin_menu\" href=\"index.php?file=photo_shop/photo_shop_cart\">".photoshop_count()." {$lang_photoshop['in_cart']}</a> ".$template_sys_menu_spacer;
		if (USER_ID && $CONFIG['photo_shop_show_myorders'] == "1") $cart_menu .= " <a href=\"index.php?file=photo_shop/photo_shop_myorders\" style=\"padding:2px;\" class=\"admin_menu\">{$lang_photoshop['myorders']}</a> ".$template_sys_menu_spacer;
		$cart_menu .= " <a href=\"{$CONFIG['photo_shop_paypal_ssl_adress']}index.php?file=photo_shop/photo_shop_checkout\" style=\"padding:2px;\" class=\"admin_menu\">{$lang_photoshop['checkout']}</a>";
	} //end else

    $html = str_replace('{CART_MENU}',$cart_menu,$html);

    return $html;
}

//shop admin button
function photoshop_add_admin_button($href,$title,$target,$link)
{
  global $template_gallery_admin_menu;

  $new_template=$template_gallery_admin_menu;
  $button=template_extract_block($new_template,'documentation');
  $params = array(
      '{DOCUMENTATION_HREF}' => $href,
      '{DOCUMENTATION_TITLE}' => $title,
      'target="cpg_documentation"' => $target,
      '{DOCUMENTATION_LNK}' => $link,
   );
   $new_button="<!-- BEGIN $link -->".template_eval($button,$params)."<!-- END $link -->\n";
   template_extract_block($template_gallery_admin_menu,'documentation',"<!-- BEGIN documentation -->" . $button . "<!-- END documentation -->\n" . $new_button);
}

//count the items in the basket, used in user menu, x images in cart
function photoshop_count() {
	global $SHOP_CONFIG;
	$cd_counter = array();
	foreach($_SESSION['photoshop']['cart'] as $key => $temp){//foreach
		$amount = (isset($_SESSION['photoshop']['cart'][$key]['amount'])) ? $_SESSION['photoshop']['cart'][$key]['amount'] : '';
		$item_id = (isset($_SESSION['photoshop']['cart'][$key]['id'])) ? $_SESSION['photoshop']['cart'][$key]['id'] : '';
		if($item_id == 'CD') {
			$cd_counter['cd']++;
		} else {
			$cd_counter['photo'] = $cd_counter['photo'] + $amount;
		}

	}//end foreach
	return ($cd_counter['cd'] + $cd_counter['photo']);

}

//do we already have that item in the cart
function photoshop_deep_in_array($value, $value2, $array) {
   foreach($array as $key =>$item) {
       if((in_array($value, $item)) && ($_SESSION['photoshop']['cart'][$key]['id'] == $value2)) {
			 return $key;
			 }
       //else if(photoshop_deep_in_array($value, $value2, $item)) return true;
   }
   return false;
}


//add an item to the cart
function photoshop_add_item($pic_data){
	global $CONFIG, $SHOP_CONFIG, $lang_photoshop, $album;

	if (!$CONFIG['photo_shop_enabled']) { //shop disabled
		return $pic_data;
	}

	$html = "";
	$added = "";
	$event = isset($_POST['event']) ? $_POST['event'] : null;

	//price override
	//if the shop is disabled to show for that album we return $pic_data
	//also we check if an override price is set
	$results = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_SHOP_PRICES']} WHERE aid={$pic_data['aid']}");

    while ($temp_data = mysql_fetch_array($results)) {
		if($temp_data['gid']=='-1') return $pic_data;
		$SHOP_CONFIG[$temp_data['gid']]['price']=$temp_data['price'];
	}
	mysql_free_result($results);

	switch ($event) {
    	case 'add_item':
			if(isset($_POST['pid']))
			$added = 'yes';
			$duplicate=photoshop_deep_in_array($_POST['pid'],$_POST['item_id'],$_SESSION['photoshop']['cart']);//search array if item is already in cart.. then ++ amount of that item
			if(is_numeric($duplicate)){ // only add 1 item if it's for the CD
				if (($_SESSION['photoshop']['cart'][$duplicate]['id'] != "CD") && ($SHOP_CONFIG[$_POST['item_id']]['size'] == 0 )){
					++$_SESSION['photoshop']['cart'][$duplicate]['amount'];
				} else {
					//break;
				}
			} else {
			$_SESSION['photoshop']['cart'][] = array(
		        'pid' => $_POST['pid'],
		        'id' => $_POST['item_id'],
		        'amount' => '1',
				'aid' => $pic_data['aid'],
				);
			}
			$cookie_data = base64_encode(serialize($_SESSION['photoshop']['cart']));
			setcookie($CONFIG['cookie_name'] . '_cart', $cookie_data, time() + 86400 * 30, $CONFIG['cookie_path']);

		break;
	}

//the max download size from the shop config
//$max_down_size = max($SHOP_CONFIG[]['size']);

			//fullsized image width/ height
			$imagesize[0] = $pic_data['pheight'];
			$imagesize[1] = $pic_data['pwidth'];

			//if orig exists, use its dimensions
			if (isset($CONFIG['enable_watermark'])) { // modpack installed ? Then we check for an orig image
				$image = $CONFIG['fullpath'] . $pic_data['filepath'] . $CONFIG['orig_pfx'].$pic_data['filename'];
				if (file_exists($image)) {
        			$imagesize = getimagesize($image);
				}
			}

//loop through the items and create forms
	$html .= "<select name=\"item_id\" class=\"listbox_lang\">";
	$temp_html = '';
	foreach($SHOP_CONFIG as $key => $value) {
		if ($value['type'] == 'photo') {
			//echo $value['size'];
			if ($value['price'] > 0) {
				//is the image > than the shops download size or it's a to print image
				if (max($imagesize[0], $imagesize[1]) >= $value['size'] || $value['size'] == 0 )	{
					$temp_html.="<option value=\"{$value['id']}\">{$value['name']} - {$value['price']} {$CONFIG['photo_shop_currency']}</option>";
				}
			} elseif ($value['price'] == -1) {
				if (max($imagesize[0], $imagesize[1]) >= $value['size'] || $value['size'] == 0 )	{
					$temp_html.="<option value=\"{$value['id']}\">{$value['name']} - {$lang_photoshop['free']}</option>";
				}
			}
		} elseif ($value['type'] == 'cd') {
		 	$cd = true;
		}
	}

	//if we have no items to sell (maybe the download sizes in shop config are > than teh image size) return;
	if ($temp_html == '') {
		return $pic_data;
	}

	$html .= $temp_html;
	$html .= ($cd) ? "<option value=\"CD\">{$lang_photoshop['CD']}</option>" : '';
	$html .="</select>";

	($album == 'search') ? $referer = "displayimage.php?pos=-{$pic_data['pid']}" : $referer = null;

	$shop_data =  <<<EOT
	<table class="shop_table">
		<tr>
			<td>
			<form action="{$referer}" method="post">
			  	{$added}{$lang_photoshop['buy']} {$html}
				<input type="hidden" value="{$pic_data['pid']}" name="pid" />
				<input type="hidden" value="add_item" name="event" />
    			<input type="submit" value="{$lang_photoshop['send']}" class="comment_button" />
			</form>
			</td>
		</tr>
	</table>

EOT;
	$pic_data['html'] = $shop_data.$pic_data['html'];
	$referer = ($_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : ''));
	if ($added) {
		//this is not nice.. but the menu updates before the content. So if you add an item, the basket count can't match
		// -> we have to refresh the page twice... can be removed but than the counter is wrong till the user manually reloads

		photoshop_refresh($referer, $lang_photoshop['added']);
		exit;
	}

	return $pic_data;
}
?>