# *************************************************
# Coppermine Photo Gallery 1.5.12 
# *************************************************
# Update_history V2.1
# by Frantz
# ************************************************* 
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
# *************************************************


#
# Table structure for table `CPG_update_history_config`
#
CREATE TABLE IF NOT EXISTS `CPG_update_history_config` (
  `Group_Id` varchar(40) NOT NULL default '',
  `bloc` varchar(255) NOT NULL default '',
  `archive` varchar(255) NOT NULL default '',
  `uploader_name` varchar(255) NOT NULL default '',
  `days` varchar(255) NOT NULL default '',
  `number` varchar(255) NOT NULL default '',

  PRIMARY KEY  (`Group_Id`)
)TYPE=MyISAM;
