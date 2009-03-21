/**********************************************************************
  Coppermine 1.5.x Plugin - CompressHTML v1.0
  *********************************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *********************************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  *********************************************************************/


What's this?
------------
This plugin compresses the HTML output by removing disposable spaces and line feeds from the source code. It is meant for those who can't use zlib compression in their PHP settings to compress the gallerie's output, or for those who want to make their source code more difficult to read. Under certain conditions it may be useful for people on slow connections. The reduction in page size is 15-30% depending on your CPG theme and the amount of plugins and extras used. You can check how much it saves on your CPG - have a look at the last line of the page source code.


PLEASE READ THIS !!!
--------------------
1. This plugin MUST be the last in the chain. Move it all the way down in
   plugin manager, otherwise it may harm other plugins.
2. This plugin may break certain scripts, especially Javascripts with missing
   semicolons after each command. If it doesn't work, edit codebase.php and
   comment out the marked line.
3. This plugin may under certain conditions lead to invalid X(HTML), so if
   you're after that, re-check with a validator. If it doesn't work, edit 
   codebase.php and comment out the marked line.
4. NEVER EVER ask for support on the CPG forums when this plugin is active.
   Supporters will probably refuse to help you because of the unreadable
   source code.


How to install:
---------------
1. Upload folder compresshtml to your plugins folder.
2. Install via plugin manager.


How to uninstall:
-----------------
1. Uninstall via plugin manager.
2. Remove folder compresshtml from your plugins folder.


=========================================================================


Change log:
-----------

v1.0 (2009/01/13)
-----------------
First release.