CREATE TABLE IF NOT EXISTS `CPG_mod_slider` (
  `slider_useenlarge` int(2) NOT NULL default '0',
  `slider_width` int(2) NOT NULL default '600',
  `slider_height` int(2) NOT NULL default '60',
  `slider_numberofpics` int(2) NOT NULL default '20',
  `slider_speed` int(2) NOT NULL default '1',
  `slider_bgcolor` varchar(7) default '',
  `slider_album` varchar(100) default 'random',
  `slider_skipportrait` int(2) NOT NULL default '0',
  `slider_align` varchar(15) default 'center',
  `slider_pictype` varchar(100) default 'normal',
  `slider_autowidth` int(2) NOT NULL default '0'
);