##  ********************************************
##  Coppermine Photo Gallery
##  ************************
##  Copyright (c) 2003-2012 Coppermine Dev Team
##  v1.0 originally written by Gregory Demar
##
##  This program is free software; you can redistribute it and/or modify
##  it under the terms of the GNU General Public License version 3
##  as published by the Free Software Foundation.
##
##  ********************************************
##  Coppermine version: 1.6.01
##  $HeadURL$
##  $Revision$
##  ********************************************

# The following line has to be removed when the moderator group feature will be re-enabled!
UPDATE CPG_albums SET moderator_group = 0;

INSERT INTO CPG_config VALUES ('upload_create_album_directory', '1');
INSERT INTO CPG_config VALUES ('ecard_captcha', '1');