CREATE TABLE IF NOT EXISTS `CPG_fr_notify` (
  `user_id` int(10) NOT NULL default '0',
  `topic_id` mediumint(8) NOT NULL default '0',
  `board_id` smallint(5) NOT NULL default '0',
  `send` tinyint(1) NOT NULL default '0'
) TYPE=MyISAM;

INSERT INTO `CPG_config` (name, value) VALUES ('fr_time_online_checking', 5);
UPDATE `CPG_config` SET value='2.0/Beta/4f' where name='fr_version';

CREATE TABLE IF NOT EXISTS `CPG_fr_badwords` (
  `word_id` int(10) NOT NULL auto_increment,
  `word` varchar(45) NOT NULL default '',
  `replace` varchar(45) NOT NULL default '',
  PRIMARY KEY (`word_id`)
) TYPE=MyISAM;
