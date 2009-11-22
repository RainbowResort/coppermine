/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt!
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.2
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
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
========
This plugin uses the following components:
* EnlargeIt! technology by Timo Sack: http://enlargeit.timos-welt.de/
* FLV player by rphMedia: http://forum.coppermine-gallery.net/index.php/topic,43180.0.html
* ImageFlow is based on the script by Finn Rudolph: http://imageflow.finnrudolph.de/
* FLV player OSFLV: http://www.osflv.com/
* Histogram creation by Anton Sparrius (Spaz): anton_spaz@yahoo.com
* Crystal Clear icons by Everaldo Coelho: http://www.everaldo.com/crystal/
* Farbtastic color picker by Steven Wittens: http://acko.net/dev/farbtastic/
* SpinButton jquery plugin by George Adamson: http://www.softwareunity.com/jquery/JQuerySpinBtn/

Changelog
=========
[A] = Added new feature
[B] = Bugfix (fix something that wasn't working as expected)
[C] = Cosmetical fix (layout, typo etc.)
[D] = Documentation improvements
[M] = Maintenance works
[O] = Optimization of code
[S] = Security fix (issues that are related to security)
*********************************************

2009-11-22 [M] Version count updated to 0.9 {GauGau}
2009-11-22 [C] Fixed spelling mistake "histogramm" {GauGau}
2009-11-22 [B] Renamed variable that differed from language file to codebase {GauGau}
2009-11-22 [M] Renamed style sheet to match coppermine standards {GauGau}
2009-11-22 [M] Renamed files that get included by URL pattern to be easier to memorize {GauGau}
2009-11-21 [M] Version count updated to 0.8 {GauGau}
2009-11-21 [M] Moved include file to plugin root folder for easier maintenance {GauGau}
2009-11-21 [M] Renamed language variables to match coppermine coding standards {GauGau}
2009-11-21 [M] Replaced html entities with their equivalents in language files {GauGau}
2009-11-21 [M] Replaced single quotes in language file strings with double quotes {GauGau}
2009-11-21 [M] Rolled back changes in JS files as requested by plugin author {GauGau}
2009-11-21 [D] Added js-alert comments to language file for easier translation {GauGau}
2009-11-18 [M] Version count updated to 0.7 {GauGau}
2009-11-18 [A] Dropped usage of separate table to store config settings in favor of regular coppermine config table {GauGau}
2009-11-18 [C] Restored icons for BBCode and Histogram (own work) {Timo}
2009-11-18 [B] Fixed bug that made plugin stop working in IE {Timo}
2009-11-18 [A] Added sub-headers to config screen {GauGau}
2009-11-17 [M] Version count updated to 0.6 {GauGau}
2009-11-17 [A] Added buttons to config screen {GauGau}
2009-11-17 [M] Replaced silk icons with crystal icons for license compliance {GauGau}
2009-11-17 [A] Added icons {GauGau} 
2009-11-17 [M] Converted changelog to coppermine standards {GauGau} 
2009-11-16 [M] Version count updated to 0.5 {GauGau}
2009-11-16 [M] Added SVN headers {GauGau}
2009-11-16 [A] Moved images into separate folder, cleaning up js folder {GauGau}
2009-11-13 [M] Added enlargeit to subversion repository {eenemeenemuu }
2009-11-11 [A] Favorite button is back {Timo}
2009-11-11 [A] Histogram  button is back {Timo}
2009-11-11 [A] Download  button is back {Timo}
2009-11-11 [A] No longer need to copy anything to gallery root {Timo}
2009-11-11 [A] Three new animation modes {Timo}
2009-11-11 [M] Version count updated to 0.4 {Timo}
2009-11-01 [A] Using new plugin hook for faster processing and no preg_replace anymore {Timo}
2009-11-01 [M] Version count updated to 0.3 {Timo}
2009-11-01 [M] First public release {Timo}


To Do
=====
* Clear histcache
* i18n of configuration file