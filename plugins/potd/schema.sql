##  ********************************************
##  Coppermine Photo Gallery
##  ************************
##  Copyright (c) 2003-2006 Coppermine Dev Team
##  v1.1 originally written by Gregory DEMAR
##
##  This program is free software; you can redistribute it and/or modify
##  it under the terms of the GNU General Public License as published by
##  the Free Software Foundation; either version 2 of the License, or
##  (at your option) any later version.
##  ********************************************

CREATE TABLE IF NOT EXISTS `CPG_plugin_potd` (
  `pid` INT(11) NOT NULL,
  `potd` TINYINT(3) DEFAULT '0' NOT NULL,
  `potd_date`  varchar(14) NOT NULL,
  `potw` TINYINT(3) DEFAULT '0' NOT NULL,
  `potw_date`  varchar(14) NOT NULL,
PRIMARY KEY  (`pid`)
);
