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

global $CONFIG, $USER;

$lang = isset($USER['lang']) ? $USER['lang'] : $CONFIG['lang'];
if (!file_exists("plugins/photo_shop/lang/{$lang}.php"))
  $lang = 'english';
require "plugins/photo_shop/lang/{$lang}.php";

$CONFIG['TABLE_SHOP'] = $CONFIG['TABLE_PREFIX'] . "shop";
$CONFIG['TABLE_SHOP_CONFIG'] = $CONFIG['TABLE_PREFIX'] . "shop_config";
$CONFIG['TABLE_SHOP_PRICES'] = $CONFIG['TABLE_PREFIX'] . "shop_prices";
$CONFIG['TABLE_SHOP_PAYPAL_LOG'] = $CONFIG['TABLE_PREFIX'] . "shop_paypal_log";


//is a SSL URL set
if ($CONFIG['photo_shop_paypal_ssl_adress'] == '') {
	$CONFIG['photo_shop_paypal_ssl_adress'] = $CONFIG['ecards_more_pic_target'];
}


//DEFINE SHOP_CONFIG
$SHOP_CONFIG = array();
@session_start();
if(!$_SESSION['photoshop']){
		if (isset($_COOKIE[$CONFIG['cookie_name'].'_cart'])) {
                $_SESSION['photoshop']['cart'] = @unserialize(@base64_decode($_COOKIE[$CONFIG['cookie_name'].'_cart']));
        } else {
		    $_SESSION['photoshop'] = Array();
		    $_SESSION['photoshop']['cart'] = Array();
		}
}

$results = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_SHOP_CONFIG']} ORDER BY priority ASC");
while ($row = mysql_fetch_array($results)) {
	if ($row['type']=='ship') {
		$SHOP_CONFIG['ship'] = $row['price'];
	}
    $SHOP_CONFIG[$row['id']] = $row;
}
mysql_free_result($results);
?>