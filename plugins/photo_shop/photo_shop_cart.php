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

require('include/init.inc.php');

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if ((!USER_ID && $CONFIG['allow_unlogged_access'] == 0) || !$CONFIG['photo_shop_enabled']) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

//do we have items in the basket?
$cd_counter = photoshop_count_items();
if (($cd_counter['cd']+$cd_counter['photo']) == 0 ) {
			pageheader($lang_photoshop['cart']);
			starttable('100%', $lang_photoshop['cart'], 1);
			msg_box('', $lang_photoshop['cart_empty'], $lang_continue, 'index.php');
			pagefooter();
			ob_end_flush();
			exit;
}

$box = isset($_REQUEST['box']) ? $_REQUEST['box'] : "photo";
$box != "cd" ? $box = "photo" : $box = "cd";
if ($box=="photo"){
	$selected_photo=' selected="selected"';
	$selected_cd='';
} else {
	$selected_photo='';
	$selected_cd=' selected="selected"';
}

$event = isset($_REQUEST['event']) ? $_REQUEST['event'] : null;
switch ($event) {
   	case 'delete': // delete item from basket, session + save cookie
		if(isset($_REQUEST['item'])){
			unset ($_SESSION['photoshop']['cart'][$_REQUEST['item']]);
			$cookie_data = base64_encode(serialize($_SESSION['photoshop']['cart']));
			setcookie($CONFIG['cookie_name'] . '_cart', $cookie_data, time() + 86400 * 30, $CONFIG['cookie_path']);
		}
	  	photoshop_refresh($_SERVER['PHP_SELF'].'?file=photo_shop/photo_shop_cart&box='.$box);
		exit;

	break;
}

if (isset($_POST) && count($_POST)) {
	if (isset($_POST['apply_modifs'])) {// modifs
	    //$item_id_array = $_POST[('item_id')];
	    //change item amount in basket
	    foreach ($_POST[('item_id')] as $key => $item_id) {
	    	//if a value is given AND the set download size of the item in config is 0 (means it's a for download item -> that we do not need to have several times in the basket)
			if ((is_numeric($_POST[$item_id]) && $SHOP_CONFIG[$_SESSION['photoshop']['cart'][$key]['id']]['size'] == 0 )) { //is the new amount numeric... then change it
				$_SESSION['photoshop']['cart'][$item_id]['amount'] = $_POST['count'.$item_id];
			}
		}
		$cookie_data = base64_encode(serialize($_SESSION['photoshop']['cart']));
		setcookie($CONFIG['cookie_name'] . '_cart', $cookie_data, time() + 86400 * 30, $CONFIG['cookie_path']);
		photoshop_refresh($_SERVER['PHP_SELF'].'?file=photo_shop/photo_shop_cart&box='.$box);
		exit;

	} elseif(isset($_POST['empty_basket'])) {
		setcookie($CONFIG['cookie_name'] . '_cart', '', time() + 86400 * 30, $CONFIG['cookie_path']);
		unset ($_SESSION['photoshop']['cart']);
	  	photoshop_refresh($_SERVER['PHP_SELF'].'?file=photo_shop/photo_shop_cart&box='.$box);
		exit;
	} elseif(isset($_POST['checkout'])) {
	  	photoshop_refresh("{$CONFIG['photo_shop_paypal_ssl_adress']}?file=photo_shop/photo_shop_checkout");
		exit;
	} elseif(isset($_POST['continue']) && isset($_POST['referer'])) {
		photoshop_refresh($_POST['referer']);
		exit;
	}
}
// the dropdown pageheader
pageheader($lang_photoshop['cart']);
echo "<form action=\"".$_SERVER['PHP_SELF'].'?file=photo_shop/photo_shop_cart'."\" method=\"post\">";
echo <<<EOT
<table align="center" width="100%" cellspacing="1" cellpadding="0" class="maintable">
        <tr>
               	<td class="tableh1" colspan="">{$lang_photoshop['cart']}:
						<select name="box" style="width: 200px;" onchange="this.form.submit();">
						<option value="photo" {$selected_photo}>{$lang_photoshop['boxphoto']} </option>
						<option value="cd" {$selected_cd}>{$lang_photoshop['boxcd']} </option>

						</select><!-- go button -->
						<input type="submit" class="button" value="$lang_photoshop[go]"  />
				</td>
		</tr>
</table>
</form>

<form action="{$_SERVER['PHP_SELF']}?file=photo_shop/photo_shop_cart" method="post">
<table align="center" width="100%" cellspacing="1" cellpadding="0" class="maintable">
EOT;

//the main cart
photoshop_create_cart_form($box);


echo <<<EOT
                <tr>
                        <td align="left" class="tablef" colspan="7">
                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tr>
                                    <td width="100%" align="center">
                                        <input type="hidden" name="box" value="{$box}" />
                                        <input type="hidden" name="referer" value="{$_SERVER['HTTP_REFERER']}" />
										<input type="submit" class="button" name="continue" value="{$lang_photoshop['continue']}" />

EOT;
if ($box=="photo"){ // if we display photos, not cd, then display 'change amounts submit button'
echo <<<EOT
                                        <input type="submit" class="button" name="apply_modifs" value="{$lang_photoshop['save_amounts']}" />
EOT;
}
echo <<<EOT
										<input type="submit" class="button" name="empty_basket" value="{$lang_photoshop['empty_basket']}" />
										<input type="submit" class="button" name="checkout" value="{$lang_photoshop['checkout']}" />
                                    </td>
                                </tr>
                            </table>
                        </td>
                </tr>
EOT;




endtable();
echo '</form>';

//printing a pricelist
photoshop_pricelist();

pagefooter();
ob_end_flush();


// functions

function photoshop_create_cart_form($box){
	global $SHOP_CONFIG, $CONFIG, $THEME_DIR, $lang_photoshop;
	$error = '';
	$tot_price = 0;
	$cd_counter = 0;
	$photo_counter = 0;
	$photo_price = 0;
	$cd_price = 0;
	$link = $_SERVER['PHP_SELF'].'?file=photo_shop/photo_shop_cart';
	foreach($_SESSION['photoshop']['cart'] as $key => $temp){//foreach
		//to make it better readable
		$item_id = (isset($_SESSION['photoshop']['cart'][$key]['id'])) ? $_SESSION['photoshop']['cart'][$key]['id'] : '';
		$pid = (isset($_SESSION['photoshop']['cart'][$key]['pid'])) ? $_SESSION['photoshop']['cart'][$key]['pid'] : '';
		$amount = (isset($_SESSION['photoshop']['cart'][$key]['amount'])) ? $_SESSION['photoshop']['cart'][$key]['amount'] : '';


		//get the thumb URL
	    $select_columns = 'filepath, filename, url_prefix, filesize, pwidth, pheight, ctime, title, aid';

	    $result = cpg_db_query("SELECT $select_columns from {$CONFIG['TABLE_PICTURES']} WHERE pid='$pid' LIMIT 1");
	    $row = mysql_fetch_array($result);

		//get price and name
		$price = $SHOP_CONFIG[$item_id]['price'];
		$name = $SHOP_CONFIG[$item_id]['name'];

		//price override
		$results = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_SHOP_PRICES']} WHERE aid={$row['aid']}");

	    while ($temp_data = mysql_fetch_array($results)) {
			if($temp_data['gid']==$SHOP_CONFIG[$item_id]['id']){
			$price=$temp_data['price'];
			}
		}
		mysql_free_result($results);



		//html resize thumb
		if ($CONFIG['enable_mini_thumbs'] == '1') { // if you use the modpack and have enabled mini thumbs -> these get used instead of html resized thumbs
			$thumb_url = get_pic_url($row, 'mini');
		    $destWidth = $CONFIG['mini_thumb_width'];
		    $destHeight = $CONFIG['mini_thumb_height'];
		} else {
			$thumb_url = get_pic_url($row, 'thumb');
			$new_size = 60;
		    $ratio = max($row['pwidth'], $row['pheight']) / $new_size;
		    $ratio = max($ratio, 1.0);
		    $destWidth = (int)($row['pwidth'] / $ratio);
		    $destHeight = (int)($row['pheight'] / $ratio);
		}

		if ($box=="photo" and isset($name)){ // it's a photo
			//here we check if the price is set to -1 (that's a free item, and we set price for display reasons back to 0.00)
			//do the same in cart and calc total an in function item_price, pricelist, photoshop_add_data
			if ($price == -1) {
				$price = "0.00";
			}

			$photo_price += $amount*$price;
			$photo_counter += $amount;
			echo <<<EOT
			<tr>
				<td width="13%"><a href="displayimage.php?pos=-{$pid}"><img class="image" src="{$thumb_url}" width="{$destWidth}" height="{$destHeight}" alt="" /></a></td>
				<td align="left" valign="top" width="30%">
					<table style="font-size:10px">
						<tr><td>{$lang_photoshop['title']}</td><td>{$row['title']}</td></tr>
						<tr><td>{$lang_photoshop['filename']}</td><td>{$row['filename']}</td></tr>
						<tr><td>{$lang_photoshop['size']}</td><td>{$row['pwidth']} x {$row['pheight']}</td></tr>
					</table>
				</td>
				<td align="left" width="15%">{$name}</td>
				<td align="left" width="15%">{$lang_photoshop['amount']}
						<input type="hidden" name="item_id[]" value="{$key}" />
					 	<input type="text" class="textinput" maxlength="5" style="width: 20px" name="count{$key}" value="{$amount}"/>
				</td>
				<td align="left" width="20%"><span style="float:right">{$price} {$CONFIG['photo_shop_currency']} {$lang_photoshop['each']}</span></td>
				<td  width="7%" align="center">
                <a href="{$link}&amp;event=delete&amp;item={$key}&amp;box=photo">
                    <img src="{$THEME_DIR}images/delete_small.gif"  border="0" alt="" />
                </a>
				</td>
			</tr>
EOT;
		} elseif ($box=="cd" and (isset($name))) { //we're viewing the cd box, but there are also print photos, lets calculate its price too
			$photo_price += $amount*$price;
			$photo_counter += $amount;
		} elseif ($box=="cd" and (!isset($name))) {
			++$cd_counter;// += $amount;


			echo <<<EOT
			<tr>
				<td width="13%"><a href="displayimage.php?pos=-{$pid}"><img class="image" src="{$thumb_url}" width="{$destWidth}" height="{$destHeight}" alt="" /></a></td>
				<td align="left" valign="top" width="30%">
					<table style="font-size:10px">
						<tr><td>{$lang_photoshop['title']}</td><td>{$row['title']}</td></tr>
						<tr><td>{$lang_photoshop['filename']}</td><td>{$row['filename']}</td></tr>
						<tr><td>{$lang_photoshop['size']}</td><td>{$row['pwidth']} x {$row['pheight']}</td></tr>
					</table>
				</td>
				<td align="left" width="15%">&nbsp;</td>
				<td align="left" width="15%">&nbsp;</td>
				<td align="left" width="20%">&nbsp;</td>
				<td  width="7%" align="center">
                <a href="{$link}&amp;event=delete&amp;item={$key}&amp;box={$box}">
                    <img src="{$THEME_DIR}images/delete_small.gif"  border="0" alt="" />
                </a>
				</td>
			</tr>
EOT;

		} elseif ($box=="photo" and (!isset($name))) { //viewing print photos, but that's for cd
			++$cd_counter;// += $amount;
		}

	}//foreach


	if ($cd_counter > 0) { //if we have an item added to cd
		$pricelist=array();
		foreach($SHOP_CONFIG as $key => $value){//foreach
			if ($value['type']=="cd") $pricelist[$key]=$value['max_items'];
		}
		arsort($pricelist);
		foreach ($pricelist as $key => $val) {
			if ($val >= $cd_counter){
				$pointer=$key;
				$check=true;
				//echo "$key - $val<br />";
			}

		}
		$error='';
		$cd_price = $SHOP_CONFIG[$pointer]['price'];
		if(!$check==true) {
			$error = "<font color=\"red\">".$lang_photoshop['to_many_pics']."</font>&nbsp;<br />";
			$cd_price='';
		}
	} else $cd_price='';//end if we have an item added to cd


	if ($box == "photo" and $photo_counter < 1) {
			//uncomment, then the cart print refreshes to cd if print is empty
			photoshop_refresh($_SERVER['PHP_SELF'].'?file=photo_shop/photo_shop_cart&box=cd');
	}
	//sort($pricelist);
	if ($box == "cd" and $cd_counter > 0) {
		$to_go = $SHOP_CONFIG[$pointer]['max_items']-$cd_counter;
		if ($to_go > 0) {
			$to_go = sprintf($lang_photoshop['to_go'], ($to_go));
		} elseif ($to_go == 0) {
			$to_go = sprintf($lang_photoshop['to_go_full'], ($to_go));
		} elseif (($cd_counter-$pricelist[0]['max_items']) > 0) {
			$to_go = sprintf($lang_photoshop['to_go_remove'], ($cd_counter-$pricelist[count($pricelist)-1]['max_items']));
		}

		echo <<<EOT
			<tr>
				<td align="right" colspan="6">
					<hr size="1" />
					{$to_go}&nbsp;
				</td>
			</tr>
EOT;
	}


	$counter['cd'] = $cd_counter;
	$counter['photo'] = $photo_counter;
	$price_t[0] = $photo_price;
	$price_t[1] = $cd_price;
	echo photoshop_format_price($price_t, $counter, $error, 'html');
 }
?>