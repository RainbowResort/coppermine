##  ********************************************
##  Coppermine Photo Gallery
##  ************************
##  Copyright (c) 2003-2005 Coppermine Dev Team
##  v1.1 originaly written by Gregory DEMAR
##
##  This program is free software; you can redistribute it and/or modify
##  it under the terms of the GNU General Public License as published by
##  the Free Software Foundation; either version 2 of the License, or
##  (at your option) any later version.
##  ********************************************
##  Coppermine version: 1.4.1
##  $Source$
##  $Revision$
##  $Author$
##  $Date$
##  ********************************************

#
# Add parent field to support nested albums
#
ALTER TABLE CPG_albums ADD parent INT(11) DEFAULT '0' NOT NULL;