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


Tweaking:
---------
If you open codebase.php with a text editor, you'll find a variable named $compr_JS_algo. This allows you to tweak this plugin, but you do that on your own - noone will support you. Try out and test carefully to find the most efficient setting for your gallery.
$compr_JS_algo = 0: 
All javascript files will be merged into one single file to reduce the number of http requests. Will speed up access a bit but doesn't save a single byte of bandwidth.
$compr_JS_algo = 1: 
All javascript files will be merged into one single file. This one will be compressed using Packer by Dean Edwards. Very efficient, but this one makes great demands on the javascript files - they have to be syntactically absolutely correct (currently the cpg1.5.x files are not), and it's not allowed that packer has been already used before on the same files, so the setting won't work at the moment. For future use.
$compr_JS_algo = 2: 
All javascript files will be merged into one single file to reduce the number of http requests. This single file is compressed with JSmin. Will speed up access and saves 15-20% bandwidth.
$compr_JS_algo = 3: 
Keep the different javascript files and use Packer by Dean Edwards to compress them individually. Very efficient, but this one makes great demands on the javascript files - they have to be syntactically absolutely correct (currently the cpg1.5.x files are not), and it's not allowed that packer has been already used, so the setting won't work at the moment. For future use.
$compr_JS_algo = 4: 
Keep the different javascript files and use JSmin to compress them individually. Saves 15-20% bandwidth. Safest and most compatible setting that will always work.
$compr_JS_algo = 5: 
Keep the different javascript files and use JSmin to compress them individually a bit. Afterwards use gzip compression for browsers that reliably support this. Saves 50-60% bandwidth with Firefox, Opera, IE7+ and Chrome. With other browsers at least 15-20% of bandwidth are saved. You will need PHP with zlib support.
$compr_JS_algo = 6 (default):
All javascript files will be merged into one single file to reduce the number of http requests. This single file is compressed with JSmin and afterwards coompressed using gzip for browsers that reliably support it. Saves 50-60% bandwidth with Firefox, Opera, IE7+ and Chrome. With other browsers at least 15-20% of bandwidth are saved. You will need PHP with zlib support. If your PHP version doesn't support zlib, this algorithm will behave like algorithm 2.



=========================================================================


Change log:
-----------

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