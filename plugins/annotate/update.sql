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

DELETE FROM CPG_config WHERE name LIKE 'plugin_annotate_permissions_guest';
DELETE FROM CPG_config WHERE name LIKE 'plugin_annotate_permissions_registered';

INSERT INTO CPG_config (name, value) VALUES ('plugin_annotate_type', '1');
INSERT INTO CPG_config (name, value) VALUES ('plugin_annotate_display_notes', '0');
INSERT INTO CPG_config (name, value) VALUES ('plugin_annotate_display_links', '0');