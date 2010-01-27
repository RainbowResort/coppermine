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
if (!defined('IN_COPPERMINE'))
{
	die('Not in Coppermine...');
}


if (defined('PHOTOSHOP_ORDER_PHP'))
{
$lang_photoshop_email_order = <<<EOT
Hello {USER_NAME},

Thank you for your order at {SITE_NAME} with the order id {ORDER_ID}.
Please transfer USD {PRICE} as soon as possible.
Some more yadda here.... you can change that in the plugins dir plugins/photo_shop/lang/english.php
<a href="{LINK}">{LINK}</a>

{ADMIN}
EOT;


$lang_photoshop_email_admin = <<<EOT
Hello {ADMIN},

{USER_NAME} with the email address {USER_EMAIL} just made an order on your site {SITE_NAME}. The id of that order is {ORDER_ID} and the total value {PRICE}.
<a href="{LINK}index.php?file=photo_shop/photo_shop_admin">Click to go to the order manager</a>

Other placeholders you can use (blank if these user profile fiels haven't been filled in):
user_profile1: {USER_PROFILE1}
user_profile2: {USER_PROFILE2}
user_profile3: {USER_PROFILE3}
user_profile4: {USER_PROFILE4}
user_profile5: {USER_PROFILE5}
user_profile6: {USER_PROFILE6}

Best regards,
{ADMIN}
EOT;

$lang_photoshop_email_attach_header = <<<EOT


Here we can have the invoice header like address etc

Coppermine Sample Gallery
4578 Avenue
New York, NY 10001, USA
(718) 111-1234

EOT;
}

$lang_photoshop_register = array(
  'already_member' => 'Already a member',
);



$lang_photoshop_config = array(
  'save_cfg' => 'Save new configuration',
  'new_item' => 'Create new item',
  'title' => 'Shop configuration',
  'type' => 'Type',
  'price' => 'Price',
  'name' => 'Description',
  'max_items' => 'Max items on CD',
  'priority' => 'Priority',
  //new 1.3
  'update_alb' => 'Update album',
  'reset_alb' => 'Reset album',
  'select_alb' => '&nbsp;&nbsp; ** Choose an album ** ',
  //new 1.3.5
  'ship_item' => 'Shipping',
  'order' => 'Order',
  //new 1.3.6
  'shop_enabled' => 'Shop enabled for this album',
  'all_albs' => 'Set prices for all albums in the (sub)category of this album',
  'per_alb_settings' => 'Per Album Settings',
  //1.3.6 mod ipn download size
  'size_item' => '(max)w/h',

);

$lang_photoshop = array(
  'type_chckout' => 'Type',
  'item_id_checkout' => 'Item ID',
  'amount_checkout' => 'Amount',
  'total_checkout' => 'Price total',
  'admin_title' => 'Shop', // admin menu button title
  'uninstall' => 'Remove the table that was used to store shop data ?',
  'buy' => 'Add image to shopping basket:',
  'send' => 'Add',
  'CD' => 'Add to CD',
  'CD_price' => 'check basket',
  'added' => 'Item added',
  'cart' =>'Shopping cart',
  'boxcd' =>'Items on CD',
  'boxphoto' =>'Items to download',
  'go' =>'GO',
  'save_amounts' => 'Save new amounts',
  'empty_basket' => 'Empty basket',
  'each' => 'each',
  'title' => 'Title:',
  'filename' => 'Filename:',
  'size' => 'Size:',
  'amount' => 'Amount:',
  'total' => 'Total',
  'pics' => 'pics',
  'pricelist' => 'Pricelist',
  'photos' => 'Photos',
  'cds' => 'CDs',
  'to_many_pics' => 'You have to many pics on the CD, please remove some!',
  'on_cd' => 'On CD',
  'for_print' => 'To download',
  'send_order' => 'Confirm your order',
  'goto_cart_cd' => '<a href="index.php?file=photo_shop/photo_shop_cart&box=cd">Open shopping cart</a>',
  'email_subject_order' => 'Thanks for your order',
  'email_subject_order_admin' => 'You got a new order',
  'email_sent' => 'Thanks for your order.<br> We have sent you a confirmation email! <br>Your order will be processed after payment! <br>',
  'cart_empty' => 'Your shopping cart is empty.<br> Please add some items first!',
  'in_cart' => 'images in cart',
  'checkout' => 'Checkout',
  'to_go' => 'You can add %s more images to your CD till the next price level',
  'to_go_full' => 'The CD is full for this price level',
  'to_go_remove' => 'You have added to many images to your CD. Please remove at least %s item(s)!',
  'shipping' => 'Shipping',
  // gateway integration

  'account' => 'Account Number:',
  'routing' => 'ABA routing:',
  'swift' => 'Swift code:',
  'bank' => 'Bank:',
  'wire' => 'Pay by wire transfer:',

  'paypal' => 'Pay with Paypal:',
  'google' => 'Pay with Google Checkout:',
  'order_id' => 'Order ID:',

  // discount, invoice
  'discount' => 'Discount',
  'myorders' => 'My Orders',

  //continue button
  'continue' => 'Continue shopping',

  'free' => 'free',
  'total_incl' => 'Price includes %s%% VAT',
  );

if (defined('PHOTOSHOP_ADMIN_PHP'))
{
$lang_photoshop_admin_data = array(
  'Shopping Cart General',
  array('Enable shopping cart', 'photo_shop_enabled', 1),
  array('Currency to use within the shop (eg. USD, EUR, GBP, CAD, JPY)', 'photo_shop_currency', 0),
  array('VAT to use within the shop', 'photo_shop_vat', 0),
  array('Enable photo downloads after purchease', 'photo_shop_download_enable', 1),
  array('If downloads are enabled send a copy of the password to the admin', 'photo_shop_download_passwd_mail', 1),
  array('If downloads are enabled offer zip downloads, too.', 'photo_shop_download_zip', 1),
  array('Hours after the download folder should be auto deleted (blank to disable)', 'photo_shop_del_download_dir', 0),
  array('Enable -My Orders- button', 'photo_shop_show_myorders', 1),
  'Paypal Support',
  array('Enable PayPal support', 'photo_shop_paypal_enable', 1),
  array('Your PayPal merchant email address', 'photo_shop_paypal_email', 0),
  array('The currency PayPal should use (USD, EUR, GBP, CAD, JPY)', 'photo_shop_paypal_currency', 0),
  array('The -Pay with PayPal- image URL, for Germany it\'s eg. http://www.paypal.com/de_DE/i/btn/x-click-but01.gif , US: http://www.paypal.com/en_US/i/btn/x-click-but01.gif', 'photo_shop_paypal_image', 0),
  array('The PayPal form URL (Sandbox: https://www.sandbox.paypal.com/cgi-bin/webscr , US: https://www.paypal.com/cgi-bin/webscr , DE: https://www.paypal.com/de/cgi-bin/webscr)', 'photo_shop_paypal_form_url', 0),
  array('Enable PayPal IPN (Instant Payment Notification)', 'photo_shop_paypal_use_ipn', 1),
  //array('The PayPal PostBack URL', 'paypal_url', 0),
  array('SSL URL to coppermine base dir, leave blank to not use SSL (it\'s mandatory to use SSL for security reasons even if the shop works without, don\'t forget the trailing slash at the end)', 'photo_shop_paypal_ssl_adress', 0),
  array('Enable additional txt file log (MySQL log is always enabled)', 'photo_shop_paypal_ipn_log', 1),
  array('Path to additional txt file log (usually no need to change this)', 'photo_shop_paypal_ipn_logfile', 0),
  array('PayPal notify_url - enter the URL at which you would like to receive IPN posts (usually no need to change this)', 'photo_shop_paypal_ipn_notify_url', 0),
  array('PayPal return URL, leave empty if you do not want to make use of the return URL (usually no need to change this)', 'photo_shop_paypal_return_url', 0),
  array('PayPal cancel return URL, leave empty if you do not want to make use of the cancel return URL (usually no need to change this)', 'photo_shop_paypal_cancel_return_url', 0),
  'Wire information',
  array('Enable displaying wire information', 'photo_shop_wire_enable', 1),
  array('Routing number', 'photo_shop_wire_routing', 0),
  array('Account number', 'photo_shop_wire_account', 0),
  array('Bank name', 'photo_shop_wire_bank', 0),
  array('Bank address', 'photo_shop_wire_bank_address', 0),
  array('Swift', 'photo_shop_wire_swift', 0),
  'Google Checkout (basic support)',
  array('Enable Google Checkout', 'photo_shop_google_enable', 1),
  array('The currency Google Checkout should use', 'photo_shop_google_currency', 0),
  array('Google Checkout button width', 'photo_shop_google_button_width', 0),
  array('Google Checkout button height', 'photo_shop_google_button_height', 0),
  array('Google Checkout button style', 'photo_shop_google_button_style', 0),
  array('Google Checkout localisation', 'photo_shop_google_button_loc', 0),
  array('Enter your google id here', 'photo_shop_google_id', 0),
  'Credit Card (not supported yet)',
  array('Enable CC', 'photo_shop_cc_enable', 1),
);

$lang_photoshop_admin = array(
  'u_orders_on_p_pages' => '%d orders on %d page(s)',
  'otime_a' => 'Date ascending',
  'otime_d' => 'Date decending',
  'uid_a' => 'User ID ascending',
  'uid_d' => 'User ID decending',
  'oid_a' => 'Order ID ascending',
  'oid_d' => 'Order ID decending',
  'o_board_title' => 'Shop admin',
  'Active' => 'Active',
  'Archive' => 'Archive',
  'OrdersIn'=> 	'Orders in',
  'managefolder'		=>		'Manage folder',
  'orders' => 'orders',
  'switch' => 'Switch to',
  'go' => 'Go',
  'Orders' => 'Orders',
  'mark_all' => 'Mark / unmark all orders',
  'NoOrders' => 'No orders',
  'SelectedOrders' => 'Selected orders',
  'markarchive' => 'Move to Archive',
  'markactive' => 'Move to Active',
  'delete' => 'Delete',
  'new' => 'New order',
  'viewed' => 'Viewed order',
  'processed' => 'Processed order',
  'order_id' => 'Order ID',
  'items' => 'Items',
  'usd_total' => 'total',
  'item_price' => 'Price total',
  'size' => 'Size',
  'config' => 'Config',
  'mark_unviewed' => 'Set unviewed',
  'mark_viewed' => 'Set viewed',
  'mark_payed' => 'Set paid',
  'mark_unpayed' => 'Set unpaid',
  'mark_sent' => 'Set sent',
  'mark_unsent' => 'Set unsent',
  'pos' => 'Paid/ sent',
  'neg' => 'Unpaid/ unsent',
  //new stuff 1.1
  'contains' => 'contains',
  'order_s' => 'order(s)',
  'in_total' => 'In total there are',
  'orders_stored' => 'orders stored',
  'stored_orders' => 'Stored orders in this folder',
  'total_orders' => 'Total orders',
  'noitems' => 'No. items',
  'volume' => 'Order volume',
  'user_id' => 'User ID',
  'sort_by' => 'Sort by',
  'amount' => 'Amount',
  'pid' => 'PID',
  'price_pi' => 'price per item',
  'incl_ship' => 'incl. shipping %discount',
  //1.3
  'filename' => 'Filename',
  //1.4
  'download_zip' => 'Download zip',
  );
}

if (defined('PHOTOSHOP_IPN_PHP'))
{
$lang_photoshop_ipn = array(
  'success' => 'Success',
  'thank_you' => 'Thank you for your order.<br><br>An email with details how to download your purcheased images will be sent to you shortly. ',
  'cancel_tit' => 'Canceled',
  'cancel' => 'The order was canceled.',
  'ipn_download_err_mkdir' => 'Failed to create download directory! \n\n',
  'ipn_download_ok' => 'A download dir, password file and index has been created for the user!',
  'ipn_download_err_noindex' => 'Failed to create an index in the users download directory! \n\n',
  'ipn_download_err_safemode' => 'Safe mode restrictions. Turn off safe mode!! Creating directories isn\'t possible this way! \n\n ',
  'ipn_email_admin_subject' => 'Password for order id:',
  'ipn_email_user_subject' => 'Your password',
  'ipn_email_admin_ipn_success' => 'PayPal IPN success -> please check shop admin and send the items',
  'ipn_email_admin_ipn_download_success' => 'PayPal IPN success',
  'ipn_email_admin_ipn_download_problem' => 'PayPal IPN success -> download problem',
  'ipn_email_admin_ipn_failed' => 'PayPal IPN failed',
  'ipn_email_manipulated' => 'Someone attempted a sale using a manipulated URL\n\n',
  'ipn_email_pending' => 'Transaction is pending. Paypal will contact this script again when it\'s ready\n\n',
  'ipn_email_failed' => 'Transaction failed\n\n',
  'ipn_email_denied' => 'Transaction denied payment by merchant\n\n',
  'ipn_email_refunded' => 'Payment refunded by merchant\n\n',
  'ipn_email_canc-rev' => 'Payment cancelled reversal\n\n',
  'ipn_email_unknown' => 'Unknown Payment Status: ',
  'ipn_email_invalid' => 'Bad order (PayPal says it\'s invalid): ',
  'ipn_no_order_match' => 'No matching order found!',
  'ipn_no_folder' => 'does not exist or has been deleted! Create it first [D]!',
  'ipn_no_folder_user' => 'Folder does not exist or has been deleted! Create it first [D]!',
  'ipn_continue' => 'Continue',
  'ipn_file' => 'File',
  'ipn_status' => 'Status',
  'ipn_result' => 'Result',
  'ipn_prep_down' => 'Preparing downloads',
  'ipn_download_file' => 'Download file',
  'ipn_creating_image' => 'Creating image...',
  'ipn_not_paid' => 'Item not paid yet!',
  'ipn_for_print' => 'This item is for print!',
  'ipn_download_zip' => 'Download zip file',
  'ipn_image_create_finished' => 'When all pics have been created click:',
  'ipn_deleted_folder' => 'Deleted download folder for oid:',
  'ipn_deleted_folder_error' => 'Folder does not exist! Can not delete it! Order id: ',
  'ipn_created_folder' => 'Created download dir and sent password to user for oid:',
  'ipn_created_folder_error' => 'Directory already exists.... delete first! Order id: ',
  'ipn_no_download_items' => 'There are no items for download in your order! Order id: ',
  'ipn_log' => 'PayPal IPN Log',
  'ipn_log_close_window' => 'Close Window',
  'ipn_button_show_log' => 'Show PayPal IPN log',
  'ipn_button_create_dir' => 'Create download dir and email the password',
  'ipn_button_copy_files' => 'Copy files into download dir and download them... dir must exist',
  'ipn_button_delete_dir' => 'Delete download dir',
  'ipn_error_contact_admin' => 'Error! Please contact the site admin!',
  );

$lang_photoshop_ipn_admin_mail_body  = <<<EOT

The following data was received from PayPal:
from {PAYER_EMAIL} on {DATE}
Details:

EOT;


$lang_photoshop_htaccess = <<<EOT
AuthName        "Download Area"
AuthType        Basic
AuthUserFile    {HTPASSWD_PATH}

<Limit GET POST>
require valid-user
</Limit>
EOT;

$lang_photoshop_ipn_email_user = <<<EOT
Hello {USER_NAME},

your order has been processed and we have created a download directory for you.

Please click the following link and your ordered items will be copied into your download directory. You can access this directory using:
Username: {USER_NAME}
Password: {PASSWORD}

<a href="{LINK}">Download your items</a>

Best regards,
{ADMIN}
EOT;


}
?>