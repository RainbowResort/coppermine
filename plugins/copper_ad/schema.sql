# *************************************************
# Coppermine Photo Gallery 1.4.8 CopperAd Plugin
# *************************************************
# 1.0  CopperAd
# Copyright (C) 2006 Borzoo Mossavari <bmossavari@gmail.com>
# ************************************************* 
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
# *************************************************


#
# Table structure for table `CPG_copperad_config`
#
CREATE TABLE IF NOT EXISTS `CPG_copperad_config` (
  `name` varchar(40) NOT NULL default '0',
  `value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`name`)
)TYPE=MyISAM;


#
# Table structure for table `CPG_plugin_copperad`
#
CREATE TABLE  IF NOT EXISTS `CPG_plugin_copperad` (
  `adv_id` int(10) unsigned NOT NULL auto_increment,
  `kind` int(1) unsigned NOT NULL default '1',
  `address` varchar(255) NOT NULL default 'Only if its picture or flash',
  `height` int(4) unsigned NOT NULL default '100',
  `width` int(4) unsigned NOT NULL default '780',
  `linkto` varchar(255) NOT NULL default 'index.php',
  `alt` varchar(255) NOT NULL default 'Advertisement',
  `html` text NOT NULL,
  `showd` int(1) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL default 'Copper Ad default name',
  `stat` int(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`adv_id`)
) TYPE=MyISAM;