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
define('PHOTOSHOP_IPN_PHP', true);

require('include/init.inc.php');
require('include/mailer.inc.php');

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$lang = isset($USER['lang']) ? $USER['lang'] : $CONFIG['lang'];
if (!file_exists("plugins/photo_shop/lang/{$lang}.php"))
  $lang = 'english';
require "plugins/photo_shop/lang/{$lang}.php";

require('photo_shop_paypal_ipn_cls.php');
$p = new photo_shop_paypal_class;

switch ($_GET['action']) {

   case 'return':

		$redirect = "index.php";
		header($header_location . $redirect);
		pageheader($lang_info, "<META http-equiv=\"refresh\" content=\"15;url=$redirect\">");
		msg_box($lang_photoshop_ipn['success'], $lang_photoshop_ipn['thank_you'], $lang_continue, $redirect);
		pagefooter();
		//foreach ($_POST as $key => $value) { echo "$key: $value<br>"; }

		break;

   case 'cancel':

		$redirect = "index.php";
		header($header_location . $redirect);
		pageheader($lang_info, "<META http-equiv=\"refresh\" content=\"15;url=$redirect\">");
		msg_box($lang_photoshop_ipn['cancel_tit'], $lang_photoshop_ipn['cancel'], $lang_continue, $redirect);
		pagefooter();

	    break;

   case 'ipn':

      	if ($p->photo_shop_validate_ipn()) { //VERIFIED

		//user has paid and transaction has been verified
		//create the admin email body
		$date = date("D M j G:i:s T Y", time());

		$template_vars = array(
		'{PAYER_EMAIL}' => $p->ipn_data['payer_email'],
		'{DATE}' => $name,
		);
		$body=nl2br(strtr($lang_photoshop_ipn_admin_mail_body, $template_vars));



        foreach ($p->ipn_data as $key => $value) {
		 	$body .=  $key . ':' . " \t$value\n";
		 	$$key = $value;
		}

		//log verified
		$results = cpg_db_query ("INSERT INTO `{$CONFIG['TABLE_SHOP_PAYPAL_LOG']}` ( `invoice`, `receiver_email`, `payment_status`, `pending_reason`, `payment_date`, `mc_gross`, `mc_fee`, `tax`, `mc_currency`, `txn_id`, `txn_type`, `first_name`, `last_name`, `address_street`, `address_city`, `address_state`, `address_zip`, `address_country`, `address_status`, `payer_email`, `payer_status`, `payment_type`, `notify_version`, `verify_sign` ) VALUES ( '$invoice', '$receiver_email', '$payment_status', '$pending_reason', '$payment_date', '$mc_gross', '$mc_fee', '$tax', '$mc_currency', '$txn_id', '$txn_type', '$first_name', '$last_name', '$address_street', '$address_city', '$address_state', '$address_zip', '$address_country', '$address_status', '$payer_email', '$payer_status', '$payment_type', '$notify_version', '$verify_sign' )");

		switch($p->ipn_data['payment_status']) {

				case 'Completed':
					//error messages from function photo_shop_ipn_download()
					$error = &$ERROR;

					//just grabbing gross price from the shop table in order to compare with the gross from paypal
					$result = cpg_db_query("SELECT price, uid FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$invoice." AND cd=1");
					$row = cpg_db_fetch_row($result);
					$gross = $row['price'];
					$uid = $row['uid'];
					mysql_free_result($result);


					//check if invoice AND gross AND seller_email AND currency match, else spoofed data
					if ((strtolower(trim($p->ipn_data['business'])) == trim($CONFIG['photo_shop_paypal_email'])) && (trim($p->ipn_data['mc_currency']) == trim($CONFIG['photo_shop_paypal_currency'])) && (trim($p->ipn_data['mc_gross']) == trim($gross))) {

						//mark items of the current order paid
						$result2 = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$invoice.";");
						while($i=mysql_fetch_array($result2))
						{
							$id = $i['id'];
							$status = $i['status'] | 2;
							cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET status=$status WHERE id ='".$i['id']."';");
 						}
						mysql_free_result($result2);

						//if we set download instead of prints
						if ($CONFIG['photo_shop_download_enable']=='1') {

							//first check if we have items to download, if yes, create down dir, send passwords etc
							if (photo_shop_ipn_download_check($uid, $invoice)) {
								$CONFIG['photo_shop_download_passwd_mail']=='1' ? $send_admin_mail = true : $send_admin_mail = false;
								//create download folder, htaccess, htpasswd, resize images and copy them to download folder
								if(photo_shop_ipn_download($uid, $invoice, $send_admin_mail, true)) {
									//success, email admin
									cpg_mail('admin', $lang_photoshop_ipn['ipn_email_admin_ipn_download_success']." [$date]", nl2br(make_clickable($error. $body)), 'text/plain', $CONFIG['gallery_name'], $CONFIG['gallery_admin_email'], $body);
								} else {
									cpg_mail('admin', $lang_photoshop_ipn['ipn_email_admin_ipn_download_problem']." [$date]", nl2br(make_clickable($error. $body)), 'text/plain', $CONFIG['gallery_name'], $CONFIG['gallery_admin_email'], $body);
								}
							}
						} else { // email user admin, order is paid... prints need to be sent
							cpg_mail('admin', $lang_photoshop_ipn['ipn_email_admin_ipn_success']." [$date]", nl2br(make_clickable($error. $body)), 'text/plain', $CONFIG['gallery_name'], $CONFIG['gallery_admin_email'], $body);
							//mail user... maybe redundant..  has already received shop thank you message and all the paypal emails
						}
					} else {
						$body = $lang_photoshop_ipn['ipn_email_manipulated'].$body;
						cpg_mail('admin', $lang_photoshop_ipn['ipn_email_admin_ipn_failed']." [$date]", nl2br(make_clickable($body)), 'text/plain', $CONFIG['gallery_name'], $CONFIG['gallery_admin_email'], $body);
					}
				break;

				case 'Pending':
					$body = $lang_photoshop_ipn['ipn_email_pending'].$body;
					cpg_mail('admin', "Testing status: ".$p->ipn_data['payment_status'].$lang_photoshop_ipn['ipn_email_admin_ipn_failed']." [$date]", nl2br(make_clickable($body)), 'text/plain', $CONFIG['gallery_name'], $CONFIG['gallery_admin_email'], $body);
				break;
				case 'Failed':
					// this will only happen in case of echeck.
					$body = $lang_photoshop_ipn['ipn_email_failed'].$body;
					cpg_mail('admin', $lang_photoshop_ipn['ipn_email_admin_ipn_failed']." [$date]", nl2br(make_clickable($body)), 'text/plain', $CONFIG['gallery_name'], $CONFIG['gallery_admin_email'], $body);
				break;

				case 'Denied':
					$body = $lang_photoshop_ipn['ipn_email_denied'].$body;
					cpg_mail('admin', $lang_photoshop_ipn['ipn_email_admin_ipn_failed']." [$date]", nl2br(make_clickable($body)), 'text/plain', $CONFIG['gallery_name'], $CONFIG['gallery_admin_email'], $body);
				break;

				case 'Refunded':
					$body = $lang_photoshop_ipn['ipn_email_refunded'].$body;
					cpg_mail('admin', $lang_photoshop_ipn['ipn_email_admin_ipn_failed']." [$date]", nl2br(make_clickable($body)), 'text/plain', $CONFIG['gallery_name'], $CONFIG['gallery_admin_email'], $body);
				break;

				case 'Canceled':
					// mark the payment as dispute cancelled
					$body = $lang_photoshop_ipn['ipn_email_canc-rev'].$body;
					cpg_mail('admin', $lang_photoshop_ipn['ipn_email_admin_ipn_failed']." [$date]", nl2br(make_clickable($body)), 'text/plain', $CONFIG['gallery_name'], $CONFIG['gallery_admin_email'], $body);
				break;

				default:
					// order is not good
					$body = $lang_photoshop_ipn['ipn_email_unknown'].$p->ipn_data['payment_status']."\n\n";
					cpg_mail('admin', $lang_photoshop_ipn['ipn_email_admin_ipn_failed'], nl2br(make_clickable($body)), 'text/plain', $CONFIG['gallery_name'], $CONFIG['gallery_admin_email'], $body);
				break;
			} // end switch



      } else { //Paypal didn't verify
			$body = $lang_photoshop_ipn['ipn_email_invalid'].$p->ipn_response."\n\n";
			cpg_mail('admin', $lang_photoshop_ipn['ipn_email_admin_ipn_failed'], nl2br(make_clickable($body)), 'text/plain', $CONFIG['gallery_name'], $CONFIG['gallery_admin_email'], $body);

	  }
      break;

 }

?>