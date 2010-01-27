#**************************************************
# avatar maker plugin for cpg 1.4.x
# *******************************************
# Copyright (c) 2003-2009 foulu (Le Hoai Phuong)
# <foulu_bk@yahoo.com> 
#***************************************************

#CFG FOR FS

INSERT INTO `CPG_config` (name, value) values ('avmk_enabled'  	   , '1'  );
INSERT INTO `CPG_config` (name, value) values ('avmk_df_width'     , '100');
INSERT INTO `CPG_config` (name, value) values ('avmk_df_height'    , '100');
INSERT INTO `CPG_config` (name, value) values ('avmk_jpeg_quality' , '80' );
INSERT INTO `CPG_config` (name, value) values ('avmk_time' 		   , '0' );

# NEW TABLE (FOR AVATAR LOGGING)

CREATE TABLE `CPG_av_temp` (
  avid int(11) NOT NULL auto_increment,
  session_id varchar(40) NOT NULL default '',
  creater_id VARCHAR(255) NOT NULL default '',
  creater_name VARCHAR(255) NOT NULL default '',	
  filepath VARCHAR(255) NOT NULL default '',
  filename VARCHAR(255) NOT NULL default '',
  timecreate VARCHAR(10)  NOT NULL default '',
  memo TEXT NOT NULL default '',
  PRIMARY KEY (avid)
) TYPE=MyISAM COMMENT='Used to store avatar temp data';

