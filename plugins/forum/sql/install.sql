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
  
CREATE TABLE IF NOT EXISTS `CPG_fr_boards` (
  `board_id` smallint(5) NOT NULL auto_increment,
  `cat_id` tinyint(4) NOT NULL default '0',
  `child_level` tinyint(4) NOT NULL default '0',
  `parent_id` smallint(5) NOT NULL default '0',
  `board_order` smallint(5) NOT NULL default '0',
  `last_msg_id` int(10) NOT NULL default '0',
  `updated_msg_id` int(10) NOT NULL default '0',
  `name` tinytext NOT NULL,
  `description` text NOT NULL,
  `topics` mediumint(8) NOT NULL default '0',
  `posts` mediumint(8) NOT NULL default '0',
  PRIMARY KEY (`board_id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `CPG_fr_categories` (
  `cat_id` tinyint(4) NOT NULL auto_increment,
  `cat_order` tinyint(4) NOT NULL default '0',
  `name` tinytext NOT NULL,
  PRIMARY KEY  (`cat_id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `CPG_fr_message_icons` (
  `icon_id` smallint(5) NOT NULL auto_increment,
  `title` varchar(80) NOT NULL default '',
  `filename` varchar(80) NOT NULL default '',
  `icon_order` smallint(5) NOT NULL default '0',
  PRIMARY KEY (`icon_id`)
) TYPE=MyISAM AUTO_INCREMENT=14 ;

INSERT INTO `CPG_fr_message_icons` 
(`icon_id`, `title`, `filename`, `icon_order`) 
VALUES 
(1,  'Post',      'icon1',  0),
(2,  'Smile',     'icon2',  1),
(3,  'Big smile', 'icon3',  2),
(4,  'Angry',     'icon4',  3),
(5,  'Cool',      'icon5',  4),
(6,  'Sad',       'icon6',  5),
(7,  'Wink',      'icon7',  6),
(8,  'Comment',   'icon8',  7),
(9,  'Magnify',   'icon9',  8),
(10, 'Icon',      'icon10', 9),
(11, 'Lamp',      'icon11', 10),
(12, 'Bug',       'icon12', 11),
(13, 'Wheel',     'icon13', 12);

CREATE TABLE IF NOT EXISTS `CPG_fr_messages` (
  `msg_id` int(10) NOT NULL auto_increment,
  `topic_id` mediumint(8) NOT NULL default '0',
  `board_id` smallint(5) NOT NULL default '0',
  `poster_time` int(10) NOT NULL default '0',
  `poster_id` mediumint(8) NOT NULL default '0',
  `modified_id` int(10) NOT NULL default '0',
  `subject` tinytext NOT NULL,
  `poster_name` tinytext NOT NULL,
  `poster_email` tinytext NOT NULL,
  `poster_ip` tinytext NOT NULL,
  `smileys_enabled` tinyint(4) NOT NULL default '1',
  `modified_time` int(10) NOT NULL default '0',
  `modified_name` tinytext NOT NULL,
  `body` text NOT NULL,
  `icon` varchar(16) NOT NULL default '1',
  PRIMARY KEY  (`msg_id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `CPG_fr_topics` (
  `topic_id` mediumint(8) NOT NULL auto_increment,
  `is_sticky` tinyint(4) NOT NULL default '0',
  `board_id` smallint(5) NOT NULL default '0',
  `first_msg_id` int(10) NOT NULL default '0',
  `last_msg_id` int(10) NOT NULL default '0',
  `started_member_id` int(8) NOT NULL default '0',
  `updated_member_id` int(8) NOT NULL default '0',
  `poll_id` mediumint(8)  NOT NULL default '0',
  `replies` int(10) NOT NULL default '0',
  `views` int(10) NOT NULL default '0',
  `locked` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`topic_id`)
) TYPE=MyISAM;

INSERT INTO `CPG_config` (name, value) VALUES ('fr_version', '2.0 Beta');
INSERT INTO `CPG_config` (name, value) VALUES ('fr_title', 'Coppermine Simple Forum');
INSERT INTO `CPG_config` (name, value) VALUES ('fr_guest_browse', 1);
INSERT INTO `CPG_config` (name, value) VALUES ('fr_guest_post', 1);
INSERT INTO `CPG_config` (name, value) VALUES ('fr_hot_topic_msg', 20);
INSERT INTO `CPG_config` (name, value) VALUES ('fr_topic_per_page', 20);
INSERT INTO `CPG_config` (name, value) VALUES ('fr_msg_max_size', 512);
INSERT INTO `CPG_config` (name, value) VALUES ('fr_msg_per_page', 15);
INSERT INTO `CPG_config` (name, value) VALUES ('fr_max_word_length', 30);
INSERT INTO `CPG_config` (name, value) VALUES ('fr_gap_time', 30);
INSERT INTO `CPG_config` (name, value) VALUES ('fr_avatar_size', 100);
INSERT INTO `CPG_config` (name, value) VALUES ('fr_signature_max_size', 512);

ALTER TABLE `CPG_users` ADD `fr_avatar` varchar(255) NOT NULL DEFAULT '';
ALTER TABLE `CPG_users` ADD `fr_signature` text NOT NULL DEFAULT '';