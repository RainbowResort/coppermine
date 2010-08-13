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

DROP TABLE `CPG_fr_badwords`;
DROP TABLE `CPG_fr_boards`;
DROP TABLE `CPG_fr_categories`;
DROP TABLE `CPG_fr_message_icons`;
DROP TABLE `CPG_fr_messages`;
DROP TABLE `CPG_fr_notify`;
DROP TABLE `CPG_fr_topics`;
DELETE FROM `CPG_config` WHERE name = 'fr_version';
DELETE FROM `CPG_config` WHERE name = 'fr_title';
DELETE FROM `CPG_config` WHERE name = 'fr_guest_browse'; 
DELETE FROM `CPG_config` WHERE name = 'fr_guest_post';
DELETE FROM `CPG_config` WHERE name = 'fr_hot_topic_msg';
DELETE FROM `CPG_config` WHERE name = 'fr_msg_max_size';
DELETE FROM `CPG_config` WHERE name = 'fr_topic_per_page';
DELETE FROM `CPG_config` WHERE name = 'fr_msg_per_page';
DELETE FROM `CPG_config` WHERE name = 'fr_hot_topic_msg';
DELETE FROM `CPG_config` WHERE name = 'fr_max_word_length';
DELETE FROM `CPG_config` WHERE name = 'fr_gap_time';
DELETE FROM `CPG_config` WHERE name = 'fr_time_online_checking';
DELETE FROM `CPG_config` WHERE name = 'fr_avatar_size';
DELETE FROM `CPG_config` WHERE name = 'fr_signature_max_size';
DELETE FROM `CPG_config` WHERE name = 'fr_msg_icons';

ALTER TABLE `CPG_users` DROP `fr_avatar`;
ALTER TABLE `CPG_users` DROP `fr_signature`;