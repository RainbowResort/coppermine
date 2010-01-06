CREATE TABLE IF NOT EXISTS `CPG_mod_imageflow` (
  `imageflow_width` varchar(15) NOT NULL default '800px',
  `imageflow_intable` int(2) NOT NULL default '60',
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