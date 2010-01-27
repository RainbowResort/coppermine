#**************************************************
#  CPG Mosaic Plugin for Coppermine Photo Gallery
#  *************************************************
#  Copyright (c) 2008 Thomas Lange <stramm@gmx.net>
#  *************************************************
#  This program is free software; you can redistribute it and/or modify
#  it under the terms of the GNU General Public License as published by
#  the Free Software Foundation; either version 2 of the License, or
#  (at your option) any later version.
#  *************************************************
#  Coppermine version: 1.4.18
#  Photo Shop version: 1.0
#  $Revision: 1.0 $
#  $Author: stramm $
#***************************************************

#
# Table structure for table `CPG_mosaic`
#

CREATE TABLE `CPG_mosaic` (
  `id` int(11) NOT NULL auto_increment,
  `groups` varchar(50) collate utf8_bin NOT NULL,
  `folder` varchar(200) collate utf8_bin NOT NULL,
  `filename` varchar(100) collate utf8_bin NOT NULL,
  `red` int(11) NOT NULL,
  `green` int(11) NOT NULL,
  `blue` int(11) NOT NULL,
  `image` blob NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `_insert` int(11) NOT NULL,
  `_update` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `folder_file` (`folder`,`filename`),
  KEY `groups` (`groups`)
) TYPE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;




#
# Config entries
#
#config entries
INSERT INTO CPG_config (name, value) values ('mosaic_enabled', '0');
INSERT INTO CPG_config (name, value) values ('mosaic_admin', '0');
INSERT INTO CPG_config (name, value) values ('mosaic_thumbnail_width', '40');
INSERT INTO CPG_config (name, value) values ('mosaic_thumbnail_height', '30');
INSERT INTO CPG_config (name, value) values ('mosaic_thumbnail_quality', '100');
INSERT INTO CPG_config (name, value) values ('mosaic_resize_option', 'deform');
INSERT INTO CPG_config (name, value) values ('mosaic_time_limit', '0');
INSERT INTO CPG_config (name, value) values ('mosaic_memory_limit', 'auto');
INSERT INTO CPG_config (name, value) values ('mosaic_thumbnail_limit', '7500');
INSERT INTO CPG_config (name, value) values ('mosaic_range', '0');
INSERT INTO CPG_config (name, value) values ('mosaic_distance', '8');
INSERT INTO CPG_config (name, value) values ('mosaic_quality', '75');
