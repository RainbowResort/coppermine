## **************************************************
##  Picture Annotation (annotate) plugin for cpg1.5.x
##  *************************************************
##  Copyright (c) 2003-2009 Coppermine Dev Team
##
##  This program is free software; you can redistribute it and/or modify
##  it under the terms of the GNU General Public License version 3
##  as published by the Free Software Foundation.
##
##  *************************************************
##  Coppermine version: 1.5.x
##  $HeadURL$
##  $Revision$
##  $LastChangedBy$
##  $Date$
## ***************************************************

ALTER TABLE `CPG_plugin_annotate` ADD user_time int(9) default NULL;

CREATE TABLE IF NOT EXISTS `CPG_plugin_annotate_permissions` (
  group_id smallint(5) unsigned NOT NULL,
  permission smallint(5) unsigned NOT NULL default 0,
  PRIMARY KEY  (group_id, permission)
) TYPE=MyISAM  COMMENT='Contains the permission settings for the annotate plugin';