/**************************************************
  Coppermine 1.5.x Plugin - JSMin
  *************************************************
  Copyright (c) 2010 Timos-Welt (www.timos-welt.de)
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


What's this?
------------
This plugin combines all javascript files into one and compresses it by removing unneeded stuff. The compressed files will be cached. Normally this plugin will make your gallery access faster for visitors. If you update your gallery or any plugins that add javascript stuff, it is very important to manually clear the cache using the button in plugin manager. The folder plugins/jsmin/cache must be readable by visitors, and it must be writable by php (usually chmod to 755). This plugin has no effect in admin mode, log off to see it working.


PLEASE READ THIS !!!
--------------------
1. This plugin MUST be the last in the chain. Move it all the way down in
   plugin manager.
2. NEVER EVER ask for support on the CPG forums when this plugin is active.
   Supporters will probably refuse to help you because of the unreadable
   source code.


How to install:
---------------
1. Upload folder jsmin to your plugins folder.
2. Install via plugin manager.


How to uninstall:
-----------------
1. Uninstall via plugin manager.
2. Remove folder jsmin from your plugins folder.


=========================================================================


Change log:
-----------

v0.1 (2010/01/14)
-----------------
First release.