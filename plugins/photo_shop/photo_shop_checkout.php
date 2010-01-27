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
define('PHOTOSHOP_ORDER_PHP', true);
define('PHOTOSHOP_IPN_PHP', true);

require('include/init.inc.php');
require('include/mailer.inc.php');

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
if ((!USER_ID && $CONFIG['allow_unlogged_access'] == 0) || !$CONFIG['photo_shop_enabled']) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

$lang = isset($USER['lang']) ? $USER['lang'] : $CONFIG['lang'];
if (!file_exists("plugins/photo_shop/lang/{$lang}.php"))
  $lang = 'english';
require "plugins/photo_shop/lang/{$lang}.php";

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
//cart empty??
$cd_counter = photoshop_count_items();
if (($cd_counter['cd']+$cd_counter['photo']) == 0 ) {
			pageheader($lang_photoshop['checkout']);
			starttable('100%', $lang_photoshop['checkout'], 1);
			msg_box('', $lang_photoshop['cart_empty'], $lang_continue, $CONFIG['ecards_more_pic_target'].'index.php');
			pagefooter();
			ob_end_flush();
			exit;
}
//if user isn't logged in redirect to shop register/ login page
if(!USER_ID) {
    photoshop_refresh($_SERVER['PHP_SELF'].'?file=photo_shop/photo_shop_register');
	exit;
}
//start html output
pageheader($lang_photoshop['checkout']);
starttable('100%', $lang_photoshop['checkout'], 1);
endtable();
//start all the if else
$cd_price = item_price($cd_counter['cd']);
if ($cd_price[3] == false) { // more CD items than max defined -> warn and show link to cart
	echo '<tr><td><br>'.$cd_price[2].'<br>'.$lang_photoshop['goto_cart_cd'].'</td></tr>';
} elseif (($_POST['order'] == "confirmed") && (($cd_counter['cd']+$cd_counter['photo']) > 0 )) {
	//add to mysql, show confirmation and send email (user+admin)
	photoshop_prep_data($shop_array_cd, $shop_array_photos);
	//order_id++
	$results = cpg_db_query("SELECT oid FROM {$CONFIG['TABLE_SHOP']} ORDER BY oid DESC LIMIT 1");
	$row = mysql_fetch_array($results);
	$order_id = ++$row['oid'];
	mysql_free_result($results);

	//merge photo und cd array
	$shop_array = array_merge($shop_array_photos, $shop_array_cd);

	//calculate the discount
	$discount_calc = calculate_discount($cd_price, $cd_counter);
	$shipping_price_calc = calculate_shipping();
	$discount = number_format($discount_calc,2);
	$shipping_price = number_format($shipping_price_calc,2);
	$free_item = false; // if we have a free item in the cart, if yes, and download is enabled we create the down folder later, in case free_item gets set true in function photoshop_add_data
	if (photoshop_add_data($shop_array, $order_id, $free_item)) { // adding data succeeded
		//now email the user
		//first we prepare the invoice attachment
		$invoice = '<pre>'; //added to make the output more convenient when viewing the email not as text email but html
		$invoice .= $lang_photoshop_email_attach_header; //in the lang file we could define a header for the invoice
		$invoice .= photoshop_create_table($shop_array_photos, 'photo', 'text');
		$invoice .= photoshop_create_table($shop_array_cd, 'cd', 'text');
		$invoice .= photoshop_format_price($cd_price, $cd_counter, '', 'text');
		$invoice .= '</pre>';


		if(photoshop_email_the_user($lang_photoshop_email_order.$invoice, $lang_photoshop['email_subject_order'])){
			//when user got his email, then send to admin
			photoshop_email_the_user($lang_photoshop_email_admin.$invoice, $lang_photoshop['email_subject_order_admin'], true);

			//here we do the integration... we just add the buttons, text etc to the msg_box

			$item_price = number_format(($cd_price[0]+$cd_price[1]-$discount_calc),2); // - discount (used for paypal, google checkout)
			$order_price = number_format(($cd_price[0]+$cd_price[1]+$shipping_price_calc-$discount_calc),2);
			$msg_box_txt = $lang_photoshop['email_sent'];
			$msg_box_txt .= '<br><br>'.$lang_photoshop['order_id'].' '.$order_id.', '.$lang_photoshop['total'].' '.$order_price.' '.$CONFIG['photo_shop_currency'];


			//pay by wire
			if ($CONFIG['photo_shop_wire_enable'] && $order_price > 0) {
				$msg_box_txt .= <<<EOT
					<br><br>{$lang_photoshop['wire']}<br>

					<table>
						<tr>
							<td>{$lang_photoshop['bank']}</td>
							<td>{$CONFIG['photo_shop_wire_bank']}</td>
						</tr>
						<tr>
							<td></td>
							<td>{$CONFIG['photo_shop_wire_bank_address']}</td>
						</tr>
						<tr>
							<td>{$lang_photoshop['routing']}</td>
							<td>{$CONFIG['photo_shop_wire_routing']}</td>
						</tr>
						<tr>
							<td>{$lang_photoshop['account']}</td>
							<td>{$CONFIG['photo_shop_wire_account']}</td>
						</tr>
						<tr>
							<td>{$lang_photoshop['swift']}</td>
							<td>{$CONFIG['photo_shop_wire_swift']}</td>
						</tr>
					</table>
EOT;

			}

			//pay with paypal
			if ($CONFIG['photo_shop_paypal_enable'] && $order_price > 0) {

					$handling = $shipping_price-$discount;
					$paypal_items = "";
					$cd_price_set = false;
					$counter = 0;
					foreach ($shop_array as $key => $item_id) {

						if ($SHOP_CONFIG[$item_id['id']]['price'] > 0 || $item_id['id']=="CD") { // if it's not a free item
							$pid = $item_id['pid'];
							$amount = $item_id['amount'];
							$counter++;
							if ($item_id['id']=="CD") {
								$size = "CD";
								//$price = $cd_price[1];
								if ($cd_price_set === false) {
									photoshop_add_field($form_fields, 'item_name_'.$counter, $cd_price[4]);
									photoshop_add_field($form_fields, 'amount_'.$counter, $cd_price[1]);
									photoshop_add_field($form_fields, 'quantity_'.$counter, $amount);
								}
								$cd_price_set = true;
							} else {
								$size = $SHOP_CONFIG[$item_id['id']]['name'];
								$price = $SHOP_CONFIG[$item_id['id']]['price'];

								//price override
								$results = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_SHOP_PRICES']} WHERE aid={$item_id['aid']}");

							    while ($temp_data = mysql_fetch_array($results)) {
									if($temp_data['gid']==$SHOP_CONFIG[$item_id['id']]['id'])
										$price=$temp_data['price'];
								} //end while
								mysql_free_result($results);

								//to grab the image title from the db
								$query = cpg_db_query("SELECT title FROM {$CONFIG['TABLE_PICTURES']} WHERE pid={$item_id['pid']}");
	    						$row = mysql_fetch_row($query);
								($row[0]) ? $title= $row[0] : $title="No title";
								mysql_free_result($row);



							$picture_total = ($picture_total+$price*$amount);
							photoshop_add_field($form_fields, 'item_name_'.$counter, "{$cd_price[4]} => Title: {$title} - ID: {$pid}");
							photoshop_add_field($form_fields, 'amount_'.$counter, $price);
							photoshop_add_field($form_fields, 'quantity_'.$counter, $amount);
							}// end else

						}//end if amount >0
						else //it's a free item
						{
							//code here
						}
					} // end foreach

				if ($CONFIG['photo_shop_paypal_use_ipn'] == '1') {
					photoshop_add_field($form_fields, 'notify_url', $CONFIG['photo_shop_paypal_ssl_adress'].$CONFIG['photo_shop_paypal_ipn_notify_url']);
					photoshop_add_field($form_fields, 'rm', '2');
					if ($CONFIG['photo_shop_paypal_return_url'] != '') {
						photoshop_add_field($form_fields, 'return', $CONFIG['photo_shop_paypal_ssl_adress'].$CONFIG['photo_shop_paypal_return_url']);
					}
					if ($CONFIG['photo_shop_paypal_cancel_return_url'] != '') {
						photoshop_add_field($form_fields, 'cancel_return', $CONFIG['photo_shop_paypal_ssl_adress'].$CONFIG['photo_shop_paypal_cancel_return_url']);
					} else $paypal_cancel_return_url = '';
				}
				if ($CONFIG['photo_shop_tax'] != '') {
					photoshop_add_field($form_fields, 'tax_cart', $CONFIG['photo_shop_tax']*$picture_total);
				}

				photoshop_add_field($form_fields, 'cmd', '_cart');
				photoshop_add_field($form_fields, 'upload', '1');
				photoshop_add_field($form_fields, 'invoice', $order_id);
				photoshop_add_field($form_fields, 'business', $CONFIG['photo_shop_paypal_email']);
				photoshop_add_field($form_fields, 'currency_code', $CONFIG['photo_shop_paypal_currency']);
				photoshop_add_field($form_fields, 'handling_cart', $handling);

				foreach ($form_fields as $name => $value) {
					$paypal_items .= "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
				}

				$msg_box_txt .= <<<EOT
					<br><br>{$lang_photoshop['paypal']}<br>
					<form action="{$CONFIG['photo_shop_paypal_form_url']}" method="post" name="paypal_form">
					{$paypal_items}
					<input type="image" src="{$CONFIG['photo_shop_paypal_image']}" name="submit" alt="Pay with PayPal!">
					</form>

EOT;
			}
			if ($CONFIG['photo_shop_google_enable'] && $order_price > 0) {
				$msg_box_txt .= <<<EOT
					<br><br>{$lang_photoshop['google']}<br>

					<form method="POST" action="https://checkout.google.com/cws/v2/Merchant/{$CONFIG['photo_shop_google_id']}/checkoutForm" accept-charset="utf-8">
	    			<input type="image" name="Google Checkout" alt="Fast checkout through Google" src="http://checkout.google.com/buttons/checkout.gif?merchant_id={$CONFIG['photo_shop_google_id']}&w={$CONFIG['photo_shop_google_button_width']}&h={$CONFIG['photo_shop_google_button_height']}&style={$CONFIG['photo_shop_google_button_style']}&variant=text&loc={$CONFIG['photo_shop_google_button_loc']}"  height="46" width="180"/>

					<input type="hidden" name="item_name_1" value="{$CONFIG['gallery_name']}"/>
					<input type="hidden" name="item_description_1" value="{$lang_photoshop['order_id']} {$order_id}"/>
					<input type="hidden" name="item_quantity_1" value="1"/>
					<input type="hidden" name="item_price_1" value="{$item_price}"/>
					<input type="hidden" name="item_currency_1" value="{$CONFIG['photo_shop_google_currency']}"/>
					<input type="hidden" name="ship_method_name_1" value="{$lang_photoshop['shipping']}"/>
    				<input type="hidden" name="ship_method_price_1" value="{$shipping_price}"/>
					</form>

EOT;
			}


			$msg_box_txt .= '<br><br><br>';

			//if there's a free item in the basket and downloads enabled
			if ($free_item === true){ //there's a free item in the cart
			//if ($order_price == 0){
			//mark items of the current order paid
			/*
			$result2 = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$order_id.";");
			while($i=mysql_fetch_array($result2))
			{
				$id = $i['id'];
				$status = $i['status'] | 2;
				cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET status=$status WHERE id ='".$i['id']."';");
			}
			mysql_free_result($result2);
			*/


				if ($CONFIG['photo_shop_download_enable']=='1') {

					//first check if we have items to download, if yes, create down dir, send passwords etc
					if (photo_shop_ipn_download_check(USER_ID, $order_id)) {
						$CONFIG['photo_shop_download_passwd_mail']=='1' ? $send_admin_mail = true : $send_admin_mail = false;
						//create download folder, htaccess, htpasswd, resize images and copy them to download folder
						if(photo_shop_ipn_download(USER_ID, $order_id, $send_admin_mail, true)) {
							//success, email admin
							cpg_mail('admin', $lang_photoshop_ipn['ipn_email_admin_ipn_download_success']." [$date]", nl2br(make_clickable($error. $body)), 'text/plain', $CONFIG['gallery_name'], $CONFIG['gallery_admin_email'], $body);
						} else {
							cpg_mail('admin', $lang_photoshop_ipn['ipn_email_admin_ipn_download_problem']." [$date]", nl2br(make_clickable($error. $body)), 'text/plain', $CONFIG['gallery_name'], $CONFIG['gallery_admin_email'], $body);
						}
					}

				}
			}

			msg_box('', $msg_box_txt, $lang_continue, $CONFIG['ecards_more_pic_target'].'index.php');

			//comment out if you don't want the orders to appeare on the order confirmed page
			starttable('100%', $lang_photoshop['myorders'], 1);
			echo photoshop_create_table($shop_array_photos, 'photo', 'html');
			echo photoshop_create_table($shop_array_cd, 'cd', 'html');
			echo photoshop_format_price($cd_price, $cd_counter, '', 'html');
			endtable();
			//now we just need to clear the cookie/ session and done
			setcookie($CONFIG['cookie_name'] . '_cart', '', time() + 86400 * 30, $CONFIG['cookie_path']);
			unset ($_SESSION['photoshop']['cart']);
		}



	pagefooter();
	ob_end_flush();
	exit; // we're done here
	} else {
		//something went wrong
	}

} else {
	//show the cart contents and price, submit button
	echo "<form action='{$CONFIG['photo_shop_paypal_ssl_adress']}?file=photo_shop/photo_shop_checkout' method='post'>";

	photoshop_prep_data($shop_array_cd, $shop_array_photos);
	echo photoshop_create_table($shop_array_photos, 'photo', 'html');
	echo photoshop_create_table($shop_array_cd, 'cd', 'html');
	echo photoshop_format_price($cd_price, $cd_counter, '', 'html');

	echo <<<EOT
                <tr>
                        <td align="left" class="tablef" colspan="7">
                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tr>
                                    <td width="100%" align="center">
                                        <input type="hidden" name="order" value="confirmed" />
                                        <input type="submit" class="button" name="apply" value="{$lang_photoshop['send_order']}" />
                                    </td>
                                </tr>
                            </table>
                        </td>
                </tr>
EOT;
}

endtable();
echo "</form>";
//printing a pricelist
photoshop_pricelist();
pagefooter();
ob_end_flush();

//functioons
function photoshop_prep_data(&$shop_array_cd, &$shop_array_photos){
	$shop_array_photos = array(); //temp array for easier use
	$shop_array_cd = array(); //temp array for easier use
	foreach ($_SESSION['photoshop']['cart'] as $key => $item_id) {
		if ($item_id['id'] == 'CD') {
			$shop_array_cd[] = $_SESSION['photoshop']['cart'][$key];
		} else {
			$shop_array_photos[] = $_SESSION['photoshop']['cart'][$key];
		}
	}
}

function photoshop_create_table($shop_array_photos, $type, $template){ //we create two basic templates html and text
	global $SHOP_CONFIG, $CONFIG, $lang_photoshop, $cd_price;

	$out = array();

	$out['html'] = '<tr><td><table cellpadding="0" cellspacing="1" width="100%">';
	$out['text'] = sprintf("%s\n\n", '');

	if ($type == 'photo') {
	$out['html'].= <<<EOT
		<tr>
			<td class="tableh1" width="25%">{$lang_photoshop['item_id_checkout']}</td>
			<td class="tableh1" width="25%">{$lang_photoshop['type_chckout']}</td>
			<td class="tableh1" width="25%">{$lang_photoshop['amount_checkout']}</td>
			<td class="tableh1" width="25%">{$lang_photoshop['total_checkout']}</td>
		</tr>
EOT;
	$out['text'].= sprintf("%10.10s\t", $lang_photoshop['item_id_checkout']).sprintf("%15.15s\t",$lang_photoshop['type_chckout']).sprintf("%10.10s\t",$lang_photoshop['amount_checkout']).sprintf("%15.15s\n",$lang_photoshop['total_checkout']);
	} elseif(($type == 'cd') && (photoshop_in_array_multi("CD", $shop_array_photos))) {
	$out['html'].= <<<EOT
		<tr>
			<td class="tableh1" width="25%">{$lang_photoshop['item_id_checkout']}</td>
			<td class="tableh1" width="25%">{$lang_photoshop['type_chckout']}</td>
			<td class="tableh1" width="25%">&nbsp;</td>
			<td class="tableh1" width="25%">&nbsp;</td>
		</tr>
EOT;
	$out['text'].= sprintf("%10.10s\t", $lang_photoshop['item_id_checkout']).sprintf("%15.15s\n",$lang_photoshop['type_chckout']);

	}
	foreach ($shop_array_photos as $key => $item_id) {
		$select_columns = 'filepath, filename, url_prefix, filesize, pwidth, pheight, ctime, title, aid';

	    $result = cpg_db_query("SELECT $select_columns from {$CONFIG['TABLE_PICTURES']} WHERE pid='{$item_id['pid']}' LIMIT 1");
	    $row = mysql_fetch_array($result);

		$price = $SHOP_CONFIG[$item_id['id']]['price'];

		//price override
		$results = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_SHOP_PRICES']} WHERE aid={$row['aid']}");

	    while ($temp_data = mysql_fetch_array($results)) {
			if($temp_data['gid']==$SHOP_CONFIG[$item_id['id']]['id'])
				$price=$temp_data['price'];
		}
		mysql_free_result($results);

		//here we check if the price is set to -1 (that's a free item, and we set price for display reasons back to 0.00)
		//do the same in cart and calc total an in function item_price, pricelist, photoshop_add_data
		if ($price < 0) {
			$price = "0.00";
		}


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

		if ($item_id['id'] == 'CD') {
			$out['html'].= <<<EOT
				<tr>
					<td>
					<a href="displayimage.php?pos=-{$item_id['pid']}"><img class="image" src="{$thumb_url}" width="{$destWidth}" height="{$destHeight}" alt="" /></a>
					</td>
					<td>{$item_id['id']} text</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
EOT;

			$out['text'].= sprintf("%10.10s\t", $item_id['pid']).sprintf("%15.15s\n",$item_id['id']);

		} else {
		$price = number_format($price*$item_id['amount'],2);
			$out['html'].=  <<<EOT
				<tr>
					<td>
					<a href="displayimage.php?pos=-{$item_id['pid']}"><img class="image" src="{$thumb_url}" width="{$destWidth}" height="{$destHeight}" alt="" /></a>
					</td>
					<td>{$SHOP_CONFIG[$item_id['id']]['name']}</td>
					<td>{$item_id['amount']}</td>
					<td>{$price} {$CONFIG['photo_shop_currency']}</td>
				</tr>
EOT;

			$out['text'].= sprintf("%10.10s\t", $item_id['pid']).sprintf("%15.15s\t", $SHOP_CONFIG[$item_id['id']]['name']).sprintf("%10.10s\t", $item_id['amount']).sprintf("%15.15s\n",$CONFIG['photo_shop_currency'].' '.$price);

		}
	}
	$out['html'] .= "</td></tr></table>";

	return $out[$template];
}

function photoshop_add_data($shop_data, $order_id, &$free_item){
	global $CONFIG, $SHOP_CONFIG, $cd_price, $cd_counter, $discount_calc, $shipping_price_calc;

	$otime = localised_timestamp();
	$picture_total = 0;
	foreach ($shop_data as $key => $item_id) {
		$pid = $item_id['pid'];
		$amount = $item_id['amount'];
		$size2 = $SHOP_CONFIG[$item_id['id']]['size'];

		if ($item_id['id']=="CD") {
			$size = "CD";
			$price = $cd_price[1];
			$free_order = false; // this is not a free order
			// without paid status
			$sql = "INSERT INTO `{$CONFIG['TABLE_SHOP']}` (`oid`, `uid`, `pid`, `quantity`, `size`, `size2`, `price`, `otime`) VALUES ('$order_id', '".USER_ID."', '$pid', '$amount', '$size', '$size2','$price', '$otime')";

		} else {
			$size = $SHOP_CONFIG[$item_id['id']]['name'];
			$price = $SHOP_CONFIG[$item_id['id']]['price'];

			//price override
			$results = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_SHOP_PRICES']} WHERE aid={$item_id['aid']}");

		    while ($temp_data = mysql_fetch_array($results)) {
				if($temp_data['gid']==$SHOP_CONFIG[$item_id['id']]['id'])
					$price=$temp_data['price'];
			}
			mysql_free_result($results);

			//here we check if the price is set to -1 (that's a free item, and we set price for display reasons back to 0.00)
			//do the same in cart and calc total an in function item_price, pricelist, photoshop_add_data
			if ($price == -1) {
				$price = "0.00";
				if(!isset($free_order)) $free_order = true; //this is a free order, only set if there hasn't been a paid item before
				$free_item = true; // always set
				// add status paid to sql
				$sql = "INSERT INTO `{$CONFIG['TABLE_SHOP']}` (`oid`, `uid`, `pid`, `quantity`, `size`, `size2`, `price`, `otime`, `status`) VALUES ('$order_id', '".USER_ID."', '$pid', '$amount', '$size', '$size2','$price', '$otime', '2')";
			} else {
				// without status set to paod -> no free item
				$sql = "INSERT INTO `{$CONFIG['TABLE_SHOP']}` (`oid`, `uid`, `pid`, `quantity`, `size`, `size2`, `price`, `otime`) VALUES ('$order_id', '".USER_ID."', '$pid', '$amount', '$size', '$size2','$price', '$otime')";
				$free_order = false; //this is not a free order
			}



		$picture_total = ($picture_total+$price*$amount);
		}
		//add single item
		$results = cpg_db_query ($sql);

	}
	//add order total
	if ($free_order === true) { //this is a free order, the total order is set paid
		$sql2 = "INSERT INTO `{$CONFIG['TABLE_SHOP']}` (`oid`, `uid`, `cd`, `quantity`, `price`, `otime`, `status`) VALUES ('$order_id', '".USER_ID."', '1', '".($cd_counter['cd']+$cd_counter['photo'])."', '".($picture_total+$cd_price[1]+$shipping_price_calc-$discount_calc)."', '$otime', '2')";
	}
	else //this is a paid order, status unpaid
	{
		$sql2 = "INSERT INTO `{$CONFIG['TABLE_SHOP']}` (`oid`, `uid`, `cd`, `quantity`, `price`, `otime`) VALUES ('$order_id', '".USER_ID."', '1', '".($cd_counter['cd']+$cd_counter['photo'])."', '".($picture_total+$cd_price[1]+$shipping_price_calc-$discount_calc)."', '$otime')";

	}
	$results2 = cpg_db_query ($sql2);
	return $results2;
}

function photoshop_email_the_user($message, $subject, $admin = '')
{
	global $CONFIG, $SHOP_CONFIG, $lang_photoshop, $cd_price, $order_id, $discount, $shipping_price;

	$user_info = photoshop_user_details(USER_ID);
	$email = $user_info['user_email'];

	if ($admin) {
		$user_info['user_email']='admin';
	}

	$template_vars = array(
	'{ORDER_ID}' => $order_id,
	'{SITE_NAME}' => $CONFIG['gallery_name'],
	'{PRICE}' => number_format(($cd_price[0]+$cd_price[1]+$shipping_price-$discount),2),
	'{USER_NAME}' => (USER_NAME),
	'{USER_EMAIL}' => $email,
	'{ADMIN}' => $CONFIG['gallery_name'],
	'{LINK}' => $CONFIG['ecards_more_pic_target'],
	'{USER_PROFILE1}' => $user_info['user_profile1'],
	'{USER_PROFILE2}' => $user_info['user_profile2'],
	'{USER_PROFILE3}' => $user_info['user_profile3'],
	'{USER_PROFILE4}' => $user_info['user_profile4'],
	'{USER_PROFILE5}' => $user_info['user_profile5'],
	'{USER_PROFILE6}' => $user_info['user_profile6'],
	);
	$mail_body=nl2br(strtr($message, $template_vars));
	if(cpg_mail($user_info['user_email'], $subject, $mail_body, 'text/plain', $CONFIG['gallery_name'], $CONFIG['gallery_admin_email'] )) {
		return true;
	}
	return false;
}

function photoshop_add_field(&$form_fields, $field, $value) {

      $form_fields["$field"] = $value;
}
?>