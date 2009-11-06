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
##  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/annotate/codebase.php $
##  $Revision: 6675 $
##  $LastChangedBy: gaugau $
##  $Date: 2009-10-12 17:29:23 +0200 (Mo, 12. Okt 2009) $
## ***************************************************

CREATE TABLE IF NOT EXISTS `CPG_plugin_annotate` (
  nid smallint(5) unsigned NOT NULL auto_increment,
  pid mediumint(8) unsigned NOT NULL,
  posx smallint(5) unsigned NOT NULL,
  posy smallint(5) unsigned NOT NULL,
  width smallint(5) unsigned NOT NULL,
  height smallint(5) unsigned NOT NULL,
  note text NOT NULL,
  user_id smallint(5) unsigned NOT NULL,
  PRIMARY KEY  (nid)
) TYPE=MyISAM  COMMENT='Contains the data for the annotate plugin';
