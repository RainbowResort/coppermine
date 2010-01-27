# *************************************************
# Coppermine Photo Gallery 1.4.x HighSlide Plugin
# *************************************************
# 3.04  HighSlide
# Copyright (C) 2006-2008 Borzoo Mossavari <bmossavari@gmail.com> and Timos-Welt <http:www.timos-welt.de>
# ************************************************* 
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
# *************************************************


#
# Table structure for table `CPG_highslide_config`
#
CREATE TABLE IF NOT EXISTS `CPG_highslide_config` (
  `detail` int(2) unsigned NOT NULL default '1',
  `close` int(2) unsigned NOT NULL default '0',
  `title` int(2) unsigned NOT NULL default '0',
  `admin_show` int(2) unsigned NOT NULL default '1',
  `style_mod` int(2) unsigned NOT NULL default '2',
  `custom_text` varchar(255) default NULL,
  `index_only` int(2) unsigned NOT NULL default '0',
  `full_image` int(2) unsigned NOT NULL default '1',
  `sef` int(2) unsigned NOT NULL default '0',
  `slide_cnt` int(2) unsigned NOT NULL default '0',
  `border_color` varchar(7) default '',
  `details_color` varchar(7) default '',
  `detailsover_color` varchar(7) default '',
  `thickness` int(2) unsigned NOT NULL default '5',
  `expand_steps` int(2) unsigned NOT NULL default '10',
  `expand_duration` int(2) unsigned NOT NULL default '250',
  `restore_steps` int(2) unsigned NOT NULL default '8',
  `restore_duration` int(2) unsigned NOT NULL default '180',
  `caption_slide_speed` int(2) unsigned NOT NULL default '1',
  `allow_multi_inst` int(2) unsigned NOT NULL default '1'
) ENGINE=MyISAM;
