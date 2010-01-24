#/**************************************************
#  Coppermine 1.5.x Plugin - final_extract
#  *************************************************
#  Copyright (c) 2009 Donnovan Bray
#  *************************************************
#  This program is free software; you can redistribute it and/or modify
#  it under the terms of the GNU General Public License as published by
#  the Free Software Foundation; either version 3 of the License, or
#  (at your option) any later version.
#  ********************************************
#  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/image_manipulation/admin.php $
#  $Revision: 7043 $
#  $LastChangedBy: gaugau $
#  $Date: 2010-01-11 19:26:53 +0100 (Mo, 11. Jan 2010) $
#  **************************************************/


#
# Table structure for table `CPG_final_extract_config`
#
CREATE TABLE IF NOT EXISTS `CPG_final_extract_config` (
  `Group_Id` varchar(40) NOT NULL default '',
  `home` varchar(255) NOT NULL default '',
  `login` varchar(255) NOT NULL default '',
  `my_gallery` varchar(255) NOT NULL default '',
  `upload_pic` varchar(255) NOT NULL default '',
  `album_list` varchar(255) NOT NULL default '',
  `lastup` varchar(255) NOT NULL default '',
  `lastcom` varchar(255) NOT NULL default '',
  `topn` varchar(255) NOT NULL default '',
  `toprated` varchar(255) NOT NULL default '',
  `favpics` varchar(255) NOT NULL default '',
  `search` varchar(255) NOT NULL default '',
  `my_profile` varchar(255) NOT NULL default '',

  PRIMARY KEY  (`Group_Id`)
)TYPE=MyISAM;
