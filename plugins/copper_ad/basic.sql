# *************************************************
# Coppermine Photo Gallery 1.4.8 CopperAd Plugin
# *************************************************
# 1.0  CopperAd
# Copyright (C) 2006 Borzoo Mossavari <bmossavari@gmail.com>
# ************************************************* 
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
# *************************************************
# Default values for Copper Ad

INSERT INTO `CPG_copperad_config` VALUES ('status', '1');
INSERT INTO `CPG_copperad_config` VALUES ('max_show_number', '2');
INSERT INTO `CPG_copperad_config` VALUES ('text_title', 'A D V E R T I S E M E N T');
INSERT INTO `CPG_copperad_config` VALUES ('admin_show', '1');
INSERT INTO `CPG_copperad_config` VALUES ('banner_bg', '#FAFAFA');
INSERT INTO `CPG_copperad_config` VALUES ('width', '780');
INSERT INTO `CPG_copperad_config` VALUES ('height', '100');

INSERT INTO `CPG_plugin_copperad` (adv_id,kind,address,height,width,linkto,alt,html,showd,name)VALUES ( '1','3','','100','780','http://coppermine-gallery.net/forum/index.php?topic=33151.0','','<h2>This is your first Advertisement</h2><br/><h3>By default copper ad create your first advertisement with HTML</h3>','0','Copper Ad default HTML banner');
INSERT INTO `CPG_plugin_copperad` (adv_id,kind,address,height,width,linkto,alt,html,showd,name)VALUES ( '2','2','adv/flash/copperad.swf','100','450','','','','0','Copper Ad default Flash banner');
INSERT INTO `CPG_plugin_copperad` (adv_id,kind,address,height,width,linkto,alt,html,showd,name)VALUES ( '3','1','adv/pic/copperad.jpg','100','450','http://www.myprj.com','Copperad default pic banner','','0','Copper Ad default Picture banner');