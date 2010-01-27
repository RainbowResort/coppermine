/**************************************************
  Coppermine 1.4.x Plugin - Slider $VERSION$=2.15
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ***************************************************
  Based on a mod by pbasmo, you can find it in this thread:
  http://coppermine-gallery.net/forum/index.php?topic=41197.0
  ***************************************************/

What it does:
-------------
Displays a JavaScript slider on album list page.
This plugin has been created for cpg1.4.x.

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
- Firefox 2.x (Win)
- Firefox 2.x (Linux)
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

v2.15 (2008/12/28)
------------------
smaller HTML code

v2.12 (2008/12/11)
------------------
fixed: IE would display unwanted tooltips

v2.11 (2008/11/18)
------------------
Fixed global use of $matches in mainpage function.

v2.10 (2008/11/05)
------------------
EnlargeIt! can now be used to play youtube movies, though these will not appear as thumbs in slider

v2.09 (2008/09/11)
------------------
fixed a bug with invalid XHTML (double IDs) if not enough pics available for slider width

v2.08 (2008/07/26)
------------------
fixed a bug where slider in an empty category could lock the webserver

v2.07 (2008/07/15)
------------------
fixed a css issue

v2.06 (2008/07/11)
------------------
bugifx: slow animation in firefox under certain circumstances

v2.05 (2008/07/10)
------------------
* faster reaction on mouseclick with EnlargeIt!
* zoom mouse cursor with EnlargeIt!
* Javascript functions now in seperate js file for faster loading times

v2.03 (2008/06/30)
------------------
better integration with EnlargeIt - slider stops now while enlarging and shrinking

v2.02 (2008/06/30)
------------------
fixed: short flickering at page load

v2.01 (2008/06/27)
------------------
fixed: resizing wouldn't work when slider auto-width enabled and EnlargeIt! darkening was used

v2.00 (2008/06/16)
------------------
Now uses EnlargeIt! plugin engine

v1.73 (2008/05/11)
------------------
* New EnlargeIt! version 0.94 fixes two bugs

v1.72 (2008/05/09)
------------------
* Fixed a bug where pics wouldn't be displayed when no intermediate pic had been 
  generated when using EnlargeIt!
* New EnlargeIt! version 0.93 with more options

v1.71 (2008/05/05)
------------------
* fixed a small display bug in IE when 'Auto fit slider width' is set to 'no'
  and 'Slider align' set to 'center' or 'left'

v1.7 (2008/05/03)
-----------------
* new option 'Auto fit slider width' (experimental)
* new EnlargeIt! animation mode 'bump-glide'
* new EnlargeIt! version 0.92

v1.61 (2008/04/19)
------------------
* bug fix: slider wouldn't work with EnlargeIt! turned off

v1.6 (2008/04/18)
-----------------
* much better optics
* new EnlargeIt! option 'Show caption'
* new EnlargeIt! options 'Shadow' / 'Shadow size' / 'Shadow intensity'
* improved JS performance
* Enlarge to normal size or full size pic (selectable)
* improved stability in gallerys with pics of very different sizes

v1.52 (2008/04/16)
------------------
* now out of the box compatible with Highslide, Slider and most other Javascripts

v1.51 (2008/04/14)
------------------
* too much german in english language file - 'yes' and 'no' shouldn't be 
  'ja' and 'nein' ;)
* new EnlargeIt! version with drop shadow, now packed only 7,3 KB

v1.5 (2008/04/12)
-----------------
* new option to select meta album (random files, last additions, 
  most viewed, top rated)
* now works as intended in multi-user galleries
* EnlargeIt! integration
* if there's not enough pics in a category, they will be repeated to give 
  at least 5 pics to prevent the Slider animation from crashing

v1.2 (2008/03/24)
-----------------
* new feature 'Slider align' (left, center, right)
* 100% valid XHTML 1.0
* much faster, slighter code
* fixed few little bugs

v1.1 (2008/03/23)
-----------------
* fixed few little bugs
* new feature 'skip pics in portrait mode'

v1.0 (2008/03/22)
-----------------
* initial release
