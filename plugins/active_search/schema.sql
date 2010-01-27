#**************************************************
#  Coppermine 1.4.x Plugin - Live Search (Ajax Base)
#  *************************************************
#  Copyright (c) 2006 Borzoo Mossavari
#  *************************************************
#  This program is free software; you can redistribute it and/or modify
#  it under the terms of the GNU General Public License as published by
#  the Free Software Foundation; either version 2 of the License, or
#  (at your option) any later version.
#  *************************************************
#  Simple Ajax search :
#  - Search Title of files
#  - Search Title of Albums
#  
#  Licence:
#  Orginal Javascript and CSS : Coded by Timothy Groves,
#  a designer based in Munich, Germany
#  Under Creative Commons License.
#  URL:
#  http://www.brandspankingnew.net/specials/ajax_autosuggest/ajax_autosuggest_autocomplete.html
#  
#  Moded By Borzoo Mossavari (Bmossavari(at)gmail(dot)com)
#  ***************************************************/

#
# Table structure for table `CPG_plugin_active_search`
#
CREATE TABLE IF NOT EXISTS `CPG_plugin_active_search` (
  `name` VARCHAR(255) NOT NULL DEFAULT '',
  `value` varchar(255) NOT NULL default '',

    PRIMARY KEY(`name`)
)
TYPE=MyISAM;

INSERT INTO `CPG_plugin_active_search` (name,value)VALUES ( 'minchars','1');
INSERT INTO `CPG_plugin_active_search` (name,value)VALUES ( 'delay','500');
INSERT INTO `CPG_plugin_active_search` (name,value)VALUES ( 'timeout','2500');
INSERT INTO `CPG_plugin_active_search` (name,value)VALUES ( 'cache','false');
INSERT INTO `CPG_plugin_active_search` (name,value)VALUES ( 'offsety','-5');
INSERT INTO `CPG_plugin_active_search` (name,value)VALUES ( 'shownoresults','true');
INSERT INTO `CPG_plugin_active_search` (name,value)VALUES ( 'json','false');
INSERT INTO `CPG_plugin_active_search` (name,value)VALUES ( 'type','\"Files\"');