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

//calculate item prices, for the CD (and if there are less/ to many images on it), all photos
function item_price($cd_counter)
{ // all totals!! return[0] = photo price, return[1] = cd price, return[2] = to many items in cd error (if set)

	global $SHOP_CONFIG, $lang_photoshop, $CONFIG;
	$return = array();
	foreach($_SESSION['photoshop']['cart'] as $key => $temp){//foreach count photo items

		$item_id = (isset($_SESSION['photoshop']['cart'][$key]['id'])) ? $_SESSION['photoshop']['cart'][$key]['id'] : '';
		$amount = (isset($_SESSION['photoshop']['cart'][$key]['amount'])) ? $_SESSION['photoshop']['cart'][$key]['amount'] : '';
		$aid = (isset($_SESSION['photoshop']['cart'][$key]['aid'])) ? $_SESSION['photoshop']['cart'][$key]['aid'] : '';

		//price override
		$price = $SHOP_CONFIG[$item_id]['price'];

		$results = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_SHOP_PRICES']} WHERE aid={$_SESSION['photoshop']['cart'][$key]['aid']}");

	    while ($temp_data = mysql_fetch_array($results)) {
			if($temp_data['gid']==$SHOP_CONFIG[$item_id]['id'])
				$price=$temp_data['price'];
		}
		mysql_free_result($results);


			//here we check if the price is set to -1 (that's a free item, and we set price for display reasons back to 0.00)
			//do the same in cart and calc total an in function item_price, pricelist, photoshop_add_data
		if ($price == -1) {
			$price = "0.00";
		}


		$return[0] += $amount*$price;
	}

	if ($cd_counter > 0) { //if we have an item added to cd
		$pricelist = array();
		foreach($SHOP_CONFIG as $key => $value){//foreach
			if ($value['type']=="cd") $pricelist[$key]=$value['max_items'];
		}
		arsort($pricelist);
		foreach ($pricelist as $key => $val) {
			if ($val >= $cd_counter){
				$pointer=$key;
				$check=true;
			}

		}
		$return[4] = $value['name']; //naming of the cd from shop config, used in paypal checkout
		$return[3] = true;
		$return[2] = '';
		$return[1] = $SHOP_CONFIG[$pointer]['price'];
		if(!$check==true) {
			$return[4] = $value['name'];
			$return[3] = false;
			$return[2] = "<font color=\"red\">".$lang_photoshop['to_many_pics']."</font>&nbsp;<br />";
			$return[1] = '';
		}
	} else {
		$return[1] = '';//end if we have an item added to cd
		$return[3] = true;
	}
	return $return;
}

//count the different items in the cart, doesn't count the same item twice
function photoshop_count_items()
{ // return['cd'] = number of cd items, return['photo'] = number of print photo items
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
	return $cd_counter;
}

//refresh page
function photoshop_refresh($redirect, $txt='')
{
			global $lang_info;

            pageheader($lang_info, "<META http-equiv=\"refresh\" content=\"0;url={$redirect}\">");
            if($txt !='') {
				msg_box ($txt, $txt);
			}
            pagefooter();
            ob_end_flush();
			exit;
}

//display a pricelist
function photoshop_pricelist()
{
	global $lang_photoshop, $SHOP_CONFIG, $CONFIG;
	starttable('100%', $lang_photoshop['pricelist'], 2);
	$cd_pricelist = '';
	$photo_pricelist = '';
	$shipping_pricelist = '';
	$shipping_pricelist2 = '';
	$photo_desc = '';
	$cd_desc = '';
	$ship_desc = '';
	foreach($SHOP_CONFIG as $key => $value) {
		if ((is_numeric($key))) {
			if($SHOP_CONFIG[$key]['type']=="photo"){
			//here we check if the price is set to -1 (that's a free item, and we set price for display reasons back to 0.00)
			//do the same in cart and calc total an in function item_price, pricelist, photoshop_add_data
				if ($SHOP_CONFIG[$key]['price'] == -1) {
					$SHOP_CONFIG[$key]['price'] = "0.00";
				}

				$photo_pricelist .= $SHOP_CONFIG[$key]['name']." - ".$SHOP_CONFIG[$key]['price'] ." ". $CONFIG['photo_shop_currency']."<br />";
				if ($SHOP_CONFIG[$key]['ship'] > 0) {
				   $shipping_pricelist2 .= $lang_photoshop['shipping'].' '.$SHOP_CONFIG[$key]['name']." - ".$SHOP_CONFIG[$key]['ship'] ." ". $CONFIG['photo_shop_currency']."<br />";
				}
				$photo_desc = $lang_photoshop['photos'];
			} elseif($SHOP_CONFIG[$key]['type']=="cd"){
				$cd_pricelist .= $SHOP_CONFIG[$key]['name']." - ".$SHOP_CONFIG[$key]['price'] ."".$CONFIG['photo_shop_currency']." <br />";
				if ($SHOP_CONFIG[$key]['ship'] > 0) {
				   $shipping_pricelist2 .= $lang_photoshop['shipping'].' '.$SHOP_CONFIG[$key]['name']." - ".$SHOP_CONFIG[$key]['ship'] ." ".$CONFIG['photo_shop_currency']."<br />";
				}
				$cd_desc = $lang_photoshop['cds'];
			} elseif($SHOP_CONFIG[$key]['type']=="ship") {
				$shipping_pricelist .= $SHOP_CONFIG[$key]['name']." - ".$SHOP_CONFIG[$key]['price'] ." ".$CONFIG['photo_shop_currency']."<br />";
			}
		}
	}

	echo <<<EOT
					<tr style="font-weight:bold;">
						<td><p>{$photo_desc}</p></td>
						<td><p>{$cd_desc}</p></td>
					</tr>
					<tr style="font-size:10px;">
						<td align="left" width="50%" valign="top">
						{$photo_pricelist}
						</td>
						<td align="left" width="50%" valign="top">
						{$cd_pricelist}
						</td>
					</tr>
					<tr>
						<td align="left" colspan="2" valign="top">
						<br><p style="font-weight:bold;">{$lang_photoshop['shipping']}</p>
						<span style="font-size:10px;">{$shipping_pricelist}{$shipping_pricelist2}</span>
						</td>
					</tr>


EOT;

endtable();
}

//calculate and format total, discount, shipping
function photoshop_format_price($temp_price, $cd_counter, $error='', $template)
{
	global $lang_photoshop, $SHOP_CONFIG, $CONFIG;

	$out =array();
	$discount_calc = calculate_discount($temp_price, $cd_counter);
	$shipping_calc = calculate_shipping();
	$discount = number_format(($discount_calc),2);
	$shipping = number_format(($shipping_calc),2);
	$tot_price = number_format(($temp_price[1]+$temp_price[0]+$shipping_calc-$discount_calc),2);
	$vat = number_format((($temp_price[1]+$temp_price[0]+$shipping_calc-$discount_calc)/100*$CONFIG['photo_shop_vat']),2);
	$cd_price = number_format($temp_price[1],2);
	$photo_price = number_format($temp_price[0],2);

	if ($cd_price > 0) {
		$cd_price2 = "{$lang_photoshop['on_cd']}: {$cd_counter['cd']} {$lang_photoshop['pics']} :: {$cd_price} {$CONFIG['photo_shop_currency']}&nbsp;<br />";
	} else $cd_price2 = '';
	if ($photo_price > 0) {
		$photo_price2 = "{$lang_photoshop['for_print']}: {$cd_counter['photo']} {$lang_photoshop['pics']} :: {$photo_price} {$CONFIG['photo_shop_currency']}&nbsp;<br />";
	} else $photo_price2 = '';

	if ($tot_price > 0) {
		if ($shipping > 0) {
			$total_price = "{$lang_photoshop['shipping']} :: {$shipping} {$CONFIG['photo_shop_currency']}&nbsp;<br>";
		} else $total_price = "";
		if ($discount > 0) {
			$total_price .= "{$lang_photoshop['discount']} :: % {$discount} {$CONFIG['photo_shop_currency']}&nbsp;";
		}
		$total_price .= "<hr size=\"1\" width=\"200\" align=\"right\" />&nbsp;";
		$total_price .= "{$lang_photoshop['total']}: {$tot_price} {$CONFIG['photo_shop_currency']}&nbsp;<br><br>";
		$total_price .= "<hr size=\"1\" width=\"220\" align=\"right\" />&nbsp;";
		$total_price .= sprintf($lang_photoshop['total_incl'], '19').": {$vat} {$CONFIG['photo_shop_currency']}&nbsp";
	} else $tot_price = '';

	$out['html'] = <<<EOT
		<tr>
			<td colspan="6" align="center">
			<hr size="1" />
			</td>
		</tr>
		<tr>
			<td colspan="6" align="right">
				{$photo_price2}
				{$cd_price2}{$error}
				{$total_price}

			</td>
		</tr>
EOT;

	$vat_txt = sprintf($lang_photoshop['total_incl'], '19').": {$vat} {$CONFIG['photo_shop_currency']}";
	$out['text'] = sprintf("%+63s\n\n", '');
	if ($photo_price > 0) { $out['text'] .= sprintf("%+63s\n", $lang_photoshop['for_print'].': '. $cd_counter['photo'].' '.$lang_photoshop['pics'].' :: '.$photo_price.' '.$CONFIG['photo_shop_currency']); }
	if ($cd_price > 0) { $out['text'] .= sprintf("%+63s\n", $lang_photoshop['on_cd'].': '. $cd_counter['cd'].' '.$lang_photoshop['pics'].' :: '.$cd_price.' '.$CONFIG['photo_shop_currency']); }
	if ($shipping > 0) {	$out['text'] .= sprintf("%+63s\n", $lang_photoshop['shipping'].' :: '.$shipping.' '.$CONFIG['photo_shop_currency']); }
	if ($discount > 0) { $out['text'] .= sprintf("%+63s\n", $lang_photoshop['discount'].' :: %'.$discount.' '.$CONFIG['photo_shop_currency']); }
	$out['text'] .= sprintf("%+63s\n", '--------------------------');
	$out['text'] .= sprintf("%+63s\n", $lang_photoshop['total'].': '.$tot_price.' '.$CONFIG['photo_shop_currency']);
	$out['text'] .= sprintf("%+63s\n", $vat_txt);

	return $out[$template];
}

//check the multi dimensional item array for CDs, used in checkout item overview
function photoshop_in_array_multi($needle, $haystack)
{
   if(!is_array($haystack)) return $needle == $haystack;
   foreach($haystack as $value) if(photoshop_in_array_multi($needle, $value)) return true;
   return false;
}

function photoshop_user_details($id)
{
	global $cpg_udb;
	$user_name = $cpg_udb->get_user_infos($id);
	return $user_name;
}

function photo_shop_ipn_download_check($uid, $oid) // is this item set to be downloadable, is in config size = 0, then false
{
	global $CONFIG;

    $sql = "SELECT 1 FROM {$CONFIG['TABLE_SHOP']} WHERE oid='$oid' AND size2>'0'";
    $results = cpg_db_query($sql);
	if (!mysql_num_rows($results)) {
		return false;
	}
	return true;
}


function photo_shop_ipn_download($uid, $oid, $mail_admin = false, $overwrite_dir = false )
{
	global $CONFIG, $ERROR, $lang_photoshop_htaccess, $lang_photoshop_ipn_email_user, $lang_photoshop_index, $lang_photoshop_ipn, $template_index_html;

	//now create a download directory
	//first test if dir 'albums/downloads exists'
	if (!is_dir($CONFIG['fullpath'].'downloads')) {
	    $cpg_umask = umask(0);
	    @mkdir($CONFIG['fullpath'].'downloads',octdec($CONFIG['default_dir_mode']));
	    umask($cpg_umask);
	    unset($cpg_umask);
	}

	//then create the dir for the user user-id_order-id
	//but first do some checks - safe mode enabled? downloads dir exists - if not create
	if (!defined('SILLY_SAFE_MODE')) {
        $filepath = 'downloads/' . $uid . '_' . $oid;
        $dest_dir = $CONFIG['fullpath'] . $filepath;
        if (!is_dir($dest_dir)) {
            mkdir($dest_dir, octdec($CONFIG['default_dir_mode']));
            	if (!is_dir($dest_dir)) {
					//couldn't create dir
					$ERROR = $lang_photoshop_ipn['ipn_download_err_mkdir'];
					return false;
				}
			//redundant but... hmmm
            @chmod($dest_dir, octdec($CONFIG['default_dir_mode'])); //silence the output in case chmod is disabled


        } elseif (!$overwrite_dir) { //directory exists
			return false;
		}
        $dest_dir .= '/';
        $filepath .= '/';

        //create random password... we use the users username for the htpasswd
        $clear_txt_password = photo_shop_gen_passwd(8);
		//$CTP = &$clear_txt_password;
        //if server os is windows, then we have to use plain passwords, *nix we need to crypt
        //so do the OS check now and then use wither crypted or plain pwd
        $htpasswd_path = getcwd() . '/' . $dest_dir;
        if (eregi("win",$_ENV['OS'])) { //win
        	$password = $clear_txt_password;
		} else { //*nix))
			$password = crypt($clear_txt_password, base64_encode($clear_txt_password));
		}

		$user_info = photoshop_user_details($uid); // grab user_info, now we have username and his email addy (for now we use the name for the htpasswd)
		$order_hash = md5($uid.$oid.$password.$user_info['user_email']);

		//update shop table with hash
		$results = cpg_db_query ("UPDATE {$CONFIG['TABLE_SHOP']} SET order_md5_id='$order_hash' WHERE oid='$oid' AND cd='1'");


		//placeholder <-> path
		$template_vars = array(
			'{HTPASSWD_PATH}' => $htpasswd_path.'.htpasswd',
		);
		$htaccess = strtr($lang_photoshop_htaccess, $template_vars);
		//get the filenames

		//query the path.filename of the order -> used to create the index.php in the downloads folder. When called that file will copy (resize) the images into the download dir
		//that way we reduce heat (timeouts) on the IPN script
	    $sql = 'SELECT s.size2, p.filepath, p.filename, p.filesize, p.pwidth, p.pheight, p.title FROM ' . $CONFIG['TABLE_PICTURES'] . ' as p LEFT JOIN ' . $CONFIG['TABLE_SHOP'] . ' as s ON p.pid=s.pid WHERE oid=' . $oid . ' AND cd<>1';

	    $result = cpg_db_query($sql);
	    $row = cpg_db_fetch_rowset($result);
	    mysql_free_result($result);


		//write htpasswd
        $fp = fopen($dest_dir . '.htpasswd', 'w');
        fwrite($fp, $user_info['user_name'].':'.$password);
        fclose($fp);

		//write htaccess
        $fp = fopen($dest_dir . '.htaccess', 'w');
        fwrite($fp, $htaccess);
        fclose($fp);

        //write an index.html
        $fp = fopen($dest_dir . 'index.html', 'w');
        fwrite($fp, " ");
        fclose($fp);

        //check if all worked
        if (is_file($dest_dir . 'index.html') && is_file($dest_dir . '.htpasswd') && is_file($dest_dir . '.htaccess')) {
			//when the files have been created and verified it's a good time to add the timestamp for automatic deletion of the folder after its lifespan
			$time = localised_timestamp();
			$results = cpg_db_query ("UPDATE {$CONFIG['TABLE_SHOP']} SET dtime='$time' WHERE oid='$oid' AND cd='1'");

			//send user the password

			photo_shop_send_password($lang_photoshop_ipn_email_user, $lang_photoshop_ipn['ipn_email_user_subject'], $clear_txt_password, $user_info['user_name'], $user_info['user_email'], $order_hash);
			if ($mail_admin) {

				photo_shop_send_password($lang_photoshop_ipn_email_user, "{$lang_photoshop_ipn['ipn_email_admin_subject']} {$oid}", $clear_txt_password, $user_info['user_name'], 'admin', $order_hash);
			}

    		$ERROR = $lang_photoshop_ipn['ipn_download_ok'];
        	return true;
        } else {
     		$ERROR = $lang_photoshop_ipn['ipn_download_err_noindex'];
			return false;
		}

    } else {
		//email admin safe mode restrictions and die
     	$ERROR = $lang_photoshop_ipn['ipn_download_err_safemode'];
    	return false;
	}
}

function photo_shop_gen_passwd ($length = 8)
{
	//possible chars
	$possible = "0123456789-_bcdfghjkmnpqrstvwxyz";
	$password = "";
	$i = 0;

	// add random characters to $password until $length is reached
	while ($i < $length) {
		$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
		// don't use if already in the password
		if (!strstr($password, $char)) {
			$password .= $char;
			$i++;
		}
	}
	return $password;
}

function photo_shop_send_password($message, $subject, $pass, $name, $email, $hash)
{
	global $CONFIG, $SHOP_CONFIG;

	$template_vars = array(
	'{PASSWORD}' => $pass,
	'{USER_NAME}' => $name,
	'{ADMIN}' => $CONFIG['gallery_name'],
	'{LINK}' => $CONFIG['ecards_more_pic_target']."index.php?file=photo_shop/photo_shop_download_order&order=".$hash,
	);
	$mail_body=nl2br(strtr($message, $template_vars));
	if(cpg_mail($email, $subject, $mail_body, 'text/plain', $CONFIG['gallery_name'], $CONFIG['gallery_admin_email'] )) {
		return true;
	}
	return false;
}


function photo_shop_dir_springbreak($uid, $oid)
{
	global $CONFIG;

    $filepath = 'downloads/' . $uid . '_' . $oid;
	$dest_dir = $CONFIG['fullpath'] . $filepath . "/";
	if (is_dir($dest_dir)) {
		if (photo_shop_deltree($dest_dir)) {
			return true;
		}
	}
	return false;
}

function photo_shop_deltree($path)
{
  if (is_dir($path)) {
    if ($handle = opendir($path)) {
      while (false !== ($file = readdir($handle))) {
        if ($file != '.' && $file != '..') {
          unlink($path."/".$file);
          }
        }
      closedir($handle);
      rmdir($path);
      return 1;
      }
    }
  return;
}

//calculate discounts, user defined
function calculate_discount($temp_price, $cd_counter){

	$discount = '';
	//variables that can be used
	//$cd_counter['photo']  number of pics for print
	//$cd_counter['cd']		number of pics on CD
	//$temp_price[1]		price for the CD
	//$temp_price[0]		price for the pics

	//just to demonstrate how to calculate a discount
	//10% on print images if user orders more than 10 pics
	/*
	if($cd_counter['photo'] >= 3) {
		$discount = 0.1 * $temp_price[0];
	}
	*/

	/*
	//or another example... 10% if the order volume is > 100USD
	if($temp_price[0] >= 100) {
		$discount = 0.1 * $temp_price[0];
	}
	*/
	return $discount;
}

//calculate shipping, user defined
function calculate_shipping(){
global $CONFIG, $SHOP_CONFIG;
   	//global shipping is taken (type=ship), if the per item shipping is set and higher, than it overrides global
	$shipping = $SHOP_CONFIG['ship'];
	foreach($_SESSION['photoshop']['cart'] as $key => $temp){//foreach count photo items

		$item_id = (isset($_SESSION['photoshop']['cart'][$key]['id'])) ? $_SESSION['photoshop']['cart'][$key]['id'] : '';
			if($SHOP_CONFIG[$item_id]['ship'] >= $shipping) {
			  $shipping = $SHOP_CONFIG[$item_id]['ship'];
			}
		}


	return $shipping;
}

?>