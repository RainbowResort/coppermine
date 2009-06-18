CREATE TABLE IF NOT EXISTS CPG_plugin_external_edit (
  token_id varchar(80) NOT NULL default '',
  user_id int(11) default '0',
  pid int(11) default NULL,
  aid int(11) default NULL,
  time int(11) default NULL,
  PRIMARY KEY (token_id)
) TYPE=MyISAM COMMENT='Used to authenticate users from one page to the other';