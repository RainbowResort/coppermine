/**************************************************
  Coppermine 1.4.x Plugin - EnlargeIt! $VERSION$=2.15
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ***************************************************/

What's this?
------------
This plugin replaces the intermediate page with an AJAX gui that is widely configurable. EnlargeIt! turns the whole intermediate page into a Javascript pop up. So it provides one of the fastest possible ways to browse a picture gallery.

This plugin works fine with any graphical web browser (Firefox 1.5 and higher, IE 5.0 and higher, Opera 8 and higher, Safari 3 and higher, Konqueror 3.5 and higher, Google Chrome ...), so you won't lose any visitors because of compatibility issues. Users without a Javascript-capable browser or who have deactivated scripting in their browser can use the gallery as if EnlargeIt! wasn't there at all. The whole plugin including the Javascript stuff is licensed under the GPL (like Coppermine is).


Features:
---------
* AJAX buttons for rating, picture info, favorites, comment, full size image, 
  bbcode, histogram, download, eCard
* navigation and close buttons
* navigation with arrow keys or mouse wheel (mouse wheel only supported with mozilla & IE)
* five different animation types
* chose animation speed and steps
* select border size, color and shadow
* centering and screen darkening (lightbox alike)
* enlarge to intermediate size or full size pics
* doesn't blow up your page size - only 21 Kbyte of javascript and 1 Kbyte of CSS is added
  Still too big for you? Go to http://enlargeit.timos-welt.de/english/11/building_blocks.php
  and generate your own smaller, personalized version of the Javascript part
* this plugin fully supports the SEF plugin
* support for playback of flash files (*.swf)
* support for playback of YouTube movies (needs additional modification, see file 
  youtube_support_mod.txt for detailled instructions)
* support for playback of *.flv files - simply upload them to your CPG and they will play
* support for playback of *.divx files via DivX Web Player (http://labs.divx.com/WebPlayer) - 
  simply upload a *.divx file to your gallery, and EnlargeIt! will play it on Windows and Mac
* you can configure virtually everything on the config page - but it's not mandatory


How to install:
---------------
1. Copy folder enlargeit to your plugins folder.
2. If you want to use the histogram button, make subfolder histcache writable, 
   this usually means CHMOD to 755 or 777.
3. Install via plugin manager.
4. If you update from a previous version, make sure to always completely uninstall the 
   old version before installing the new one, and empty your browser cache afterwards.


How to configure:
-----------------
* Use the additional button 'EnlargeIt!' in admin menu.


How to uninstall:
-----------------
1. Uninstall via plugin manager.
2. If you want to make sure, that noone can upload DIVX or FLV files anymore,
   get Nibbler's file type plugin and remove FLV and divx file types
   (http://forum.coppermine-gallery.net/index.php/topic,24186.msg111120.html)


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

v2.15 (2009/04/05)
------------------
- added e-card feature (new button)
- smaller page source code
- greatly improved display of scaled images in IE7 and IE8 if pic is bigger 
  than browser window
- new setting on config page: shadow color (useful for dark themes)
- added download feature (new button)
- better button look in IE6 if white border is used
- new setting on config page: use hourglass mouse cursors
- it is not longer neccessary to copy anything to your gallery root
- histogram files are now cached in a plugin subfolder
- added slovak and czech language files (user contribution)


v2.14 (2008/12/11)
------------------
- fixed: when darkening was set to mode 2 and a user aborted loading of a pic,
  the page was locked
- fixed: flash files would always cover other content, even when not in front
- fixed: Internet Explorer would display artifacts at black pixels when animation
  fade in/out was used
- fixed: script could crash when navigating very quickly
- if no width/height is set for a flash (SWF) file, the default will be 400x400 now
- various code optimizations
- new: EnlargeIt! v1.10 Building Blocks can now be used to generate a smaller 
  Javascript file: http://enlargeit.timos-welt.de/english/11/building_blocks.php
- new: integrated support for playback of FLV files with two different players
  (rphMedia or OS FLV - chose in plugin settings)
- new: support for divx web player - see http://labs.divx.com/WebPlayer for info
- new: flash (SWF) files now support drag&drop like pictures
- new: additional button and AJAX snippet BBCode
- new: optional transparency effect for glide animations

v2.13 (2008/11/20)
------------------
- visitor can now abort loading of a picture (click on loader gif)
- messages for cancel loading and no flash plug found can now be set in lang file
- no hourglass plus cursor if IE6 is detected (caused bad performance of animation)
- added compatibility for Nibbler's mod 'Displaying videos from Youtube in Coppermine'
  see here: http://forum.coppermine-gallery.net/index.php/topic,37962.0.html
  so EnlargeIt will now play YouTube videos if you like
- fixed: select boxes were visible through enlarged image in IE6
- fixed: global use of $matches in imageflow and slider main functions
  (new versions included)

v2.11 (2008/10/09)
------------------
- fixed: setting 'open intermediate page' for info button didn't work

v2.1 (2008/10/01)
---------------------
- new: completed support for flash (SWF) files
- fixed: unwanted selections in Firefox 3 when using close buttons
- fixed: bad animation performance in IE

v2.0 (2008/09/18)
-----------------
- new: option for info button to directly go to intermediate page ('Highslide mode')
- new: key listener - you can use arrow keys for navigation now and Esc key to close
- new: mouse wheel navigation (IE and Mozilla only)
- new: option for maximize button to use popup window instead of max to viewport
- new: darkening fade, new option darkening steps on config page
- new: optimized mouse cursors in browsers that support it
- new: drag & drop can be deactivated on config page
- new: option for using textured border
- new: comment AJAX snippet
- new: experimental swf (flash) support - no buttons, but view is counted
- added: italian translation (user contribution)
- added to imageflow plugin: french langauge file (user contrib)
- fixed: imageflow plugin - invalid html if not enough pics in a category
- fixed: changed the way pic views are counted
- fixed: plugin didn't work without title bar
- fixed: pic views are not counted in admin mode anymore
- fixed: plugin didn't work if config setting 'Use thumb dimension' was not 'Max Aspect'
- fixed: plugin didn't work if config setting 'thumbnail prefix' that was not 'thumb_'
- fixed: plugin didn't work if config setting 'album directory' was not set to 'albums/'
- fixed: plugin didn't work if config setting 'prefix for intermediate' was not set to 'normal_'
  (please note: the maximize button will still not be available if it's not 'normal_')

v0.881 (2008/07/26)
-------------------
fixed bug in slider plugin

v0.87 (2008/07/10)
------------------
changed onclick to onmousedown (faster reaction)
new versions of ImageFlow and Slider plugins (update required for 0.87!)
magnifying glass mouse cursor

v0.86 (2008/07/01)
------------------
added support for special characters in filenames (e. g. german 'umlauts')

v0.85 (2008/06/30)
------------------
improved cooperation with slider plugin
IE graphics toolbar gets disabled automatically (disturbing)
fixed bug some files wouldn't get 'enlarged'

v0.83 (2008/06/26)
------------------
added maximize button for intermediate size pics
added histogram AJAX snippet and button
fixed resize bug with included slider plugin

v0.82 (2008/06/25)
------------------
preloading finally works, browsing the pics with nav buttons is now much faster
button image and order improvements

v0.81 (2008/06/24)
------------------
fixed: random image block on album list page didn't work
added nicer buttons from Silk icon set, see credits

v0.8 (2008/06/21)
-----------------
fixed two important bugs, plugin is now stable again

v0.7 (2008/06/19)
-----------------
added title and caption on info snippet
nicer rating snippet
views get counted now for gallery statistics

v0.6 (2008/06/18)
-----------------
added french language
added vote AJAX snippets

v0.5 (2008/06/16)
-----------------
first public release