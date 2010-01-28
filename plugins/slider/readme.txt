/**************************************************
  Coppermine 1.5.x Plugin - Slider
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


What it does:
-------------
Displays a JavaScript slider on album list page.
This plugin has been created for cpg1.5.x.

=========================================================================

How to install:
---------------
* Unzip
* Upload folder 'slider' into Coppermine's plugins folder
* Go to plugin manager page and install it

How to enable:
--------------
* To enable this plugin, you'll have to add "slider" to "the content of the main page" in coppermine's config in the section "Album list view". The setting should look like "breadcrumb/catlist/alblist/slider" or similar. For details, review the documentation that comes with coppermine (inside the docs folder) in the section "The gallery configuration page" > "Album list view" > "The content of the main page".

How to configure:
-----------------
* Use the additional button 'Slider' in admin menu.

=========================================================================

Browser Compatibility:
----------------------
The JavaScript slider is tested and works perfectly in these browsers:
- IE 6
- IE 6 sp1
- IE 7
- IE 8
- Firefox 2.x (Win)
- Firefox 2.x (Linux)
- Firefox 3.x (Win)
- Opera 9.x (Win)
- Opera 9.x (Linux)
- Konqueror 3.5.x
- Safari 3.x (Win)
It probably works fine in many other browsers, too.

=========================================================================

Credits:
--------
This plugin is written by Timos-welt and based on the "Slider mod" by pbasmo for cpg1.4.x.
The plugin legally uses Javascript code "Conveyor belt slideshow script" by Dynamic Drive DHTML code library (www.dynamicdrive.com).
Don't try to contact the plugin author for support - post on the board publicly instead.

=========================================================================

Change log:
-----------

v0.7 (2010/xx/xx)
-----------------
- code cleanup
- fixed add onload bug in js
- removed packed version of script because JSMin plugin is available

v0.5 (2010/01/02)
-----------------
- fixed: plugin didn't work together with other plugins
- reduced animation speed to make IE8 work with it

v0.4 (2009/12/04)
-----------------
* fixed: SQL error

v0.2 (2009/11/11)
-----------------
* added: correct album icon for standard table on album list page
* fixed: pics without intermediate would be displayed incorrectly
* slider code only on index.php

v0.1 (2009/01/02)
-----------------
* initial alpha version release for CPG 1.5x
