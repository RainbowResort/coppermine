/**************************************************
  Coppermine 1.5.x Plugin - move_to_public
  *************************************************
  Copyright (c) 2010 eenemeenemuu
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

Plugins for the Coppermine Photo Gallery are add-ons that use the plugin interface of Coppermine.
Read up the documentation that comes with Coppermine to find out more, e.g. how to install a plugin.

Coppermine version: cpg1.5.x
Plugin name: Move user albums to public category
Plugin version: 2.0
Plugin author: eenemeenemuu
Plugin announcement thread: http://forum.coppermine-gallery.net/index.php/topic,62360.0.html


Because so many people ask how they can move user albums to public categories, I made a little plugin.

Just install it like every other plugin. A new button will appear in the admin menu.

Version 1.0 (2008-11-28):
- [new] plugin
- list all user albums (for admins only)
- move the selected album to the latest category (with the highest 'cid')
- [new] choose if the user can edit his files after moving or not
-> after moving to public, you can move it to a category you want, as you can do it with every other public album

Version 1.1.0 (2008-12-11):
- [bugfix] new owner name will be applied
- [improvement] choose where to move the selected album
- [improvement] choose which user will be the new owner of the moved files (or just leave the current user as owner)
- [new] move more than 1 album at a time
- [new] status page which lists the moving status and some links, relating to the moved album

Version 1.1.1 (2009-02-23):
- [improvement] show name of parent category in category list

