/**************************************************
  Coppermine 1.5.x Plugin - JSmin
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
This plugin compresses the javascript files. The compressed files will be cached. Normally this plugin will make your gallery access faster for visitors. If you update your gallery or any plugins that add javascript stuff, it is very important to manually clear the cache using the button in plugin manager. The folder plugins/jsmin/cache must be readable by visitors, and it must be writable by php (usually chmod to 755). This plugin has no effect in admin mode, log off to see it working.


How to install:
---------------
1. Upload folder jsmin to your plugins folder.
2. The folder plugins/jsmin/cache must be readable by visitors via http, and it must be writable by php (usually chmod to 755).
3. Install via plugin manager.


How to uninstall:
-----------------
1. Uninstall via plugin manager.
2. Remove folder jsmin from your plugins folder.


Maintenance:
------------
If you ever update your gallery or any plugins that add javascript stuff, it is very important to manually clear the cache using the button in plugin manager.


=========================================================================


Change log:
-----------

v1.1 (2010/01/19)
-----------------
code clean up

v1.0 (2010/01/18)
-----------------
added new algorithm that has the optimal balance between
- few http requests (always exactly 2 per page)
- optimal compression
added docs
stable release

v0.4 (2010/01/16)
-----------------
Using new plugin hook (thanks Andre)
Added check if zlib is available in php for algo 5 + 6

v0.3 (2010/01/16)
-----------------
Added check if browser supports gzip encoding for algorithm 5 + 6

v0.2 (2010/01/15)
-----------------
added two new algorithms with gzip compression for browsers that support it

v0.1 (2010/01/14)
-----------------
First release.