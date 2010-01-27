#**************************************************
#  CPG Photo Shop Plugin for Coppermine Photo Gallery
#  *************************************************
#  Copyright (c) 2006 Thomas Lange <stramm@gmx.net>
#  *************************************************
#  This program is free software; you can redistribute it and/or modify
#  it under the terms of the GNU General Public License as published by
#  the Free Software Foundation; either version 2 of the License, or
#  (at your option) any later version.
#  *************************************************
#  Coppermine version: 1.4.19
#  Photo Shop version: 1.4.0
#  $Revision: 1.0 $
#  $Author: stramm $
#***************************************************

#
# Table structure for table `CPG_shop_paypal_log`
#

CREATE TABLE `CPG_shop_paypal_log` (
  `id` int(11) NOT NULL auto_increment,
  `invoice` int(11) NOT NULL default '0',
  `receiver_email` varchar(60) NOT NULL default '',
  `payment_status` varchar(10) NOT NULL default '',
  `pending_reason` varchar(10) NOT NULL default '',
  `payment_date` varchar(20) NOT NULL default '',
  `mc_gross` varchar(20) NOT NULL default '',
  `mc_fee` varchar(20) NOT NULL default '',
  `tax` varchar(20) NOT NULL default '',
  `mc_currency` varchar(3) NOT NULL default '',
  `txn_id` varchar(20) NOT NULL default '',
  `txn_type` varchar(10) NOT NULL default '',
  `first_name` varchar(30) NOT NULL default '',
  `last_name` varchar(40) NOT NULL default '',
  `address_street` varchar(50) NOT NULL default '',
  `address_city` varchar(30) NOT NULL default '',
  `address_state` varchar(30) NOT NULL default '',
  `address_zip` varchar(20) NOT NULL default '',
  `address_country` varchar(30) NOT NULL default '',
  `address_status` varchar(10) NOT NULL default '',
  `payer_email` varchar(60) NOT NULL default '',
  `payer_status` varchar(10) NOT NULL default '',
  `payment_type` varchar(10) NOT NULL default '',
  `notify_version` varchar(10) NOT NULL default '',
  `verify_sign` varchar(100) NOT NULL default '',
  PRIMARY KEY (`id`, `invoice`)
  ) TYPE=MyISAM AUTO_INCREMENT=1;

#
# Table structure for table `CPG_shop_config`
#

CREATE TABLE `CPG_shop_config` (
 `id` int(11) NOT NULL auto_increment,
 `type` varchar(40) NOT NULL default '0',
 `name` varchar(40) NOT NULL default '0',
 `price` dec(9,2) NOT NULL default '0',
 `max_items` varchar(40) NOT NULL default '0',
 `priority` int(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1;

#
# Table structure for table `CPG_shop`
#

CREATE TABLE `CPG_shop` (
  `id` int(11) NOT NULL auto_increment,
  `oid` int(11) NOT NULL default '0',
  `uid` int(11) NOT NULL default '0',
  `pid` int(11) NOT NULL default '0',
  `cd` tinyint(2) NOT NULL default '0',
  `quantity` int(11) NOT NULL default '0',
  `size` varchar(40) NOT NULL default '0',
  `price` dec(9,2) NOT NULL default '0',
  `otime` int(11) NOT NULL default '0',
  `status` tinyint(2) NOT NULL default '0',
  `aktive` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`id`, `oid`)
) TYPE=MyISAM AUTO_INCREMENT=1;


#
# Table structure for table `CPG_shop_prices`
#

CREATE TABLE `CPG_shop_prices` (
 `id` int(11) NOT NULL auto_increment,
 `aid` int(11) NOT NULL default '0',
 `gid` int(11) NOT NULL default '0',
 `price` dec(9,2) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1;

#table updates
# for table `CPG_shop`
#mod 1.3.6 ipn download resize size
ALTER TABLE `CPG_shop` ADD `size2` varchar(40) NOT NULL default '0' AFTER `size`;
ALTER TABLE `CPG_shop` ADD `dtime` int(11) NOT NULL default '0' AFTER `otime`;
ALTER TABLE `CPG_shop` ADD `order_md5_id` varchar(32) NOT NULL default '' AFTER `aktive`;

# for table `CPG_shop_config`
ALTER TABLE `CPG_shop_config` ADD `ship` dec(9,2) NOT NULL default '0' AFTER `max_items`;
#mod 1.3.6 ipn download resize size
ALTER TABLE `CPG_shop_config` ADD `size` VARCHAR(40) NOT NULL default '0' AFTER `ship`;

#config entries
INSERT INTO CPG_config (name, value) values ('photo_shop_enabled', '0');
INSERT INTO CPG_config (name, value) values ('photo_shop_currency', 'USD');
INSERT INTO CPG_config (name, value) values ('photo_shop_vat', '19');
INSERT INTO CPG_config (name, value) values ('photo_shop_download_enable', '0');
INSERT INTO CPG_config (name, value) values ('photo_shop_download_passwd_mail', '0');
INSERT INTO CPG_config (name, value) values ('photo_shop_download_zip', '0');
INSERT INTO CPG_config (name, value) values ('photo_shop_del_download_dir', '720');
INSERT INTO CPG_config (name, value) values ('photo_shop_show_myorders', '0');
INSERT INTO CPG_config (name, value) values ('photo_shop_paypal_enable', '0');
INSERT INTO CPG_config (name, value) values ('photo_shop_paypal_email', '');
INSERT INTO CPG_config (name, value) values ('photo_shop_paypal_currency', 'USD');
INSERT INTO CPG_config (name, value) values ('photo_shop_paypal_image', 'http://www.paypal.com/en_US/i/btn/x-click-but01.gif');
INSERT INTO CPG_config (name, value) values ('photo_shop_paypal_form_url', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
INSERT INTO CPG_config (name, value) values ('photo_shop_paypal_use_ipn', '0');
INSERT INTO CPG_config (name, value) values ('photo_shop_paypal_ssl_adress', '');
INSERT INTO CPG_config (name, value) values ('photo_shop_paypal_ipn_log', '1');
INSERT INTO CPG_config (name, value) values ('photo_shop_paypal_ipn_logfile', 'logs/paypal_ipn.log');
INSERT INTO CPG_config (name, value) values ('photo_shop_paypal_ipn_notify_url', 'index.php?file=photo_shop/photo_shop_paypal_ipn&action=ipn');
INSERT INTO CPG_config (name, value) values ('photo_shop_paypal_return_url', 'index.php?file=photo_shop/photo_shop_paypal_ipn&action=return');
INSERT INTO CPG_config (name, value) values ('photo_shop_paypal_cancel_return_url', 'index.php?file=photo_shop/photo_shop_paypal_ipn&action=cancel');
INSERT INTO CPG_config (name, value) values ('photo_shop_wire_enable', '0');
INSERT INTO CPG_config (name, value) values ('photo_shop_wire_routing', '000-001-002');
INSERT INTO CPG_config (name, value) values ('photo_shop_wire_account', '030330030');
INSERT INTO CPG_config (name, value) values ('photo_shop_wire_bank', 'RKB Canada');
INSERT INTO CPG_config (name, value) values ('photo_shop_wire_bank_address', '10 West Georgia Street <br>Vancouver, BC V6C 3G1');
INSERT INTO CPG_config (name, value) values ('photo_shop_wire_swift', 'TEST CATT');
INSERT INTO CPG_config (name, value) values ('photo_shop_google_enable', '0');
INSERT INTO CPG_config (name, value) values ('photo_shop_google_currency', 'USD');
INSERT INTO CPG_config (name, value) values ('photo_shop_google_button_width', '168');
INSERT INTO CPG_config (name, value) values ('photo_shop_google_button_height', '44');
INSERT INTO CPG_config (name, value) values ('photo_shop_google_button_style', 'trans');
INSERT INTO CPG_config (name, value) values ('photo_shop_google_button_loc', 'en_US');
INSERT INTO CPG_config (name, value) values ('photo_shop_google_id', '');
INSERT INTO CPG_config (name, value) values ('photo_shop_cc_enable', '0');


#sample data
#INSERT INTO `CPG_shop_config` VALUES ('', 'photo', '4x6', '2.00', '0', '0', '0', '0');
#INSERT INTO `CPG_shop_config` VALUES ('', 'photo', '5x7', '3.00', '0', '0', '0', '1');
#INSERT INTO `CPG_shop_config` VALUES ('', 'photo', '8x10', '4.00', '0', '0', '0', '2');
#INSERT INTO `CPG_shop_config` VALUES ('', 'cd', '25 pictures cd', '25.00', '25', '0', '0', '3');
#INSERT INTO `CPG_shop_config` VALUES ('', 'cd', '50 pictures cd', '40.00', '50', '0', '0', '4');
#INSERT INTO `CPG_shop_config` VALUES ('', 'cd', '100 pictures cd', '70.00', '100', '0', '0', '5');
#INSERT INTO `CPG_shop_config` VALUES ('', 'ship', 'Shipping', '4.00', '0', '0', '0', '6');