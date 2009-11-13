/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt! $VERSION$=0.4
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  **************************************************/

What's this?
------------
This plugin replaces the intermediate page with an AJAX gui that is widely configurable. It provides one of the fastest possible ways to browse a picture gallery.

This plugin works fine with any graphical web browser (Firefox 1.5 and higher, IE 5.0 and higher, Opera 8 and higher, Safari 3 and higher, Konqueror 3.5 and higher, Google Chrome ...), so you won't lose any visitors because of compatibility issues. Users without a Javascript-capable browser or who have deactivated scripting in their browser can use the gallery as if EnlargeIt! wasn't there at all.


Features:
---------
* buttons for picture info, full size image, favourite pics, download, histogram
* navigation and close buttons
* navigation with arrow keys or mouse wheel (mouse wheel only supported with mozilla & IE)
* five different animation types
* chose animation speed and steps
* select border size, color and shadow
* centering and screen darkening (lightbox alike)
* enlarge to intermediate size or full size pics
* doesn't blow up your page size - only 22 Kbyte of javascript and 1 Kbyte of CSS is added
  Still too big for you? Go to http://enlargeit.timos-welt.de/english/11/building_blocks.php
  and generate your own smaller, personalized version of the Javascript part
* support for playback of flash files (*.swf)
* support for playback of *.flv files - simply upload them to your CPG and they will play
* support for playback of *.divx files via DivX Web Player (http://labs.divx.com/WebPlayer) - 
  simply upload a *.divx file to your gallery, and EnlargeIt! will play it on Windows and Mac
* you can configure virtually everything on the config page - but it's not mandatory


How to install:
---------------
1. Copy folder enlargeit to your plugins folder.
2. Install via plugin manager.
3. If you update from a previous version, make sure to always completely uninstall the 
   old version before installing the new one, and empty your browser cache afterwards.


How to configure:
-----------------
* Use the additional button 'EnlargeIt!' in admin menu.


How to uninstall:
-----------------
1. Uninstall via plugin manager.
2. Delete all files enl_*.php from your gallery root.


First aid - if it doesn't work
------------------------------
- Check if the visitor has the right to access enlargeit.js 
  (http://path.to.your.gallery/plugins/enlargeit/js/enlargeit.js)
  the whole folder must be accessable via web by the visitors, 
  because it contains the javascript and graphic files.
- If you use the SEF plugin, don't forget to switch the setting 
  on the EnlargeIt! config page.
- If you use a highly modded theme or a theme that doesn't provide 
  valid HTML/XHTML, this plugin probably won't work. I can live with that, and you must!


Credits:
--------
This plugin uses some icons from the free icon set 'Silk':
  http://www.famfamfam.com/lab/icons/silk/
This plugin uses EnlargeIt! technology:
  http://enlargeit.timos-welt.de/
This plugin uses free FLV player by rphMedia:
  http://forum.coppermine-gallery.net/index.php/topic,43180.0.html
The included plugin 'ImageFlow' is based on the script by Finn Rudolph:
  http://imageflow.finnrudolph.de/
This plugin uses open source FLV player OSFLV:
  http://www.osflv.com/


=========================================================================


Change log:
-----------

v0.4 (2009/11/11)
-----------------
favourite button is back
histogram  button is back
download  button is back
no longer need to copy anything to gallery root
three new animation modes


v0.3 (2009/01/11)
-----------------
using new plugin hook for faster processing and no preg_replace anymore

v0.1 (2008/06/16)
-----------------
first public release