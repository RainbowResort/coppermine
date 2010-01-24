#/**************************************************
#  Coppermine 1.5.x Plugin - Imageflow
#  *************************************************
#  Copyright (c) 2010 Timo Schewe (www.timos-welt.de)
#  *************************************************
#  This program is free software; you can redistribute it and/or modify
#  it under the terms of the GNU General Public License as published by
#  the Free Software Foundation; either version 3 of the License, or
#  (at your option) any later version.
#  ********************************************
#  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/imageflow/codebase.php $
#  $Revision: 7015 $
#  $LastChangedBy: timoswelt $
#  $Date: 2010-01-07 19:10:40 +0100 (Do, 07. Jan 2010) $
#  **************************************************/
  
  CREATE TABLE IF NOT EXISTS `CPG_mod_imageflow` (
  `imageflow_width` varchar(15) NOT NULL default '800px',
  `imageflow_intable` int(2) NOT NULL default '60',
  `imageflow_auto` int(2) NOT NULL default '1',
  `imageflow_usewheel` int(2) NOT NULL default '1',
  `imageflow_usekeys` int(2) NOT NULL default '1',
  `imageflow_autotime` int(2) NOT NULL default '5',
  `imageflow_numberofpics` int(2) NOT NULL default '20',
  `imageflow_cache` int(2) NOT NULL default '0',
  `imageflow_bgcolor` varchar(7) default '',
  `imageflow_procent` varchar(100) default '0.5',
  `imageflow_skipportrait` int(2) NOT NULL default '0',
  `imageflow_align` varchar(15) default 'center',
  `imageflow_topcorrect` int(2) NOT NULL default '0',
  `imageflow_album` varchar(15) NOT NULL default 'random',
  `imageflow_useenlarge` int(2) NOT NULL default '1',
  `imageflow_pictype` varchar(100) default 'normal'
);