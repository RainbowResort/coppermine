#/**************************************************
#  Coppermine 1.5.x Plugin - Slider
#  *************************************************
#  Copyright (c) 2010 Timos-Welt (www.timos-welt.de)
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
  
CREATE TABLE IF NOT EXISTS `CPG_plugin_slider` (
  `slider_useenlarge` int(2) NOT NULL default '0',
  `slider_width` int(2) NOT NULL default '600',
  `slider_numberofpics` int(2) NOT NULL default '20',
  `slider_speed` int(2) NOT NULL default '1',
  `slider_bgcolor` varchar(7) default '',
  `slider_album` varchar(100) default 'random',
  `slider_skipportrait` int(2) NOT NULL default '0',
  `slider_align` varchar(15) default 'center',
  `slider_pictype` varchar(100) default 'normal',
  `slider_autowidth` int(2) NOT NULL default '0'
);