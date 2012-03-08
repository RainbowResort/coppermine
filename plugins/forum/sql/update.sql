#/**************************************************
#  Coppermine 1.5.x Plugin - forum
#  *************************************************
#  Copyright (c) 2010 foulu (Le Hoai Phuong), eenemeenemuu
#  *************************************************
#  This program is free software; you can redistribute it and/or modify
#  it under the terms of the GNU General Public License as published by
#  the Free Software Foundation; either version 3 of the License, or
#  (at your option) any later version.
#  ********************************************
#  $HeadURL$
#  $Revision$
#  $LastChangedBy$
#  $Date$
#  **************************************************/

UPDATE `CPG_config` SET value='2.1/Beta/8' where name='fr_version';

CREATE TABLE IF NOT EXISTS `CPG_fr_notify` (
  `user_id` int(10) NOT NULL default '0',
  `topic_id` mediumint(8) NOT NULL default '0',
  `board_id` smallint(5) NOT NULL default '0',
  `send` tinyint(1) NOT NULL default '0'
) TYPE=MyISAM;

INSERT INTO `CPG_config` (name, value) VALUES ('fr_time_online_checking', 5);

CREATE TABLE IF NOT EXISTS `CPG_fr_badwords` (
  `word_id` int(10) NOT NULL auto_increment,
  `word` varchar(45) NOT NULL default '',
  `replace` varchar(45) NOT NULL default '',
  PRIMARY KEY (`word_id`)
) TYPE=MyISAM;

INSERT INTO `CPG_config` (name, value) VALUES ('fr_msg_icons', 1);

ALTER TABLE `CPG_fr_messages` ALTER `icon` SET DEFAULT '1';
