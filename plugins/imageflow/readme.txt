/**************************************************
  Coppermine 1.5.x Plugin - Imageflow
  *************************************************
  Copyright (c) 2010 Timo Schewe (www.timos-welt.de)
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
Displays a coverflowish JavaScript animation of a meta album on main page with EnlargeIt! integration.
The animation can be controlled by:
 - click on a pic
 - arrow keys (can be deactivated on config page)
 - mouse wheel (can be deactivated on config page)
 - automatic by time (one step forward every ... seconds)
 - double click or single click on active pic opens intermediate page or enlarges pic
No flash needed, so every modern browser works.
This plugin has been created for cpg1.4.x.


Requirements:
---------------
- Your server must run PHP 4.3.2 or above
- GD2 extension has to be installed


Browser Compatibility:
----------------------
The animation is tested to be fully compatible with these browsers:
- IE 6
- IE 7
- Firefox 2.x (Win)
- Firefox 2.x (Linux)
- Opera 9.x (Win)
- Opera 9.x (Linux)
- Safari 3.1 (Win)
- Konqueror 3.5.x (Linux)
It probably works fine in many other browsers, too.


=========================================================================


How to install:
---------------
* Uninstall any previous version
* Unzip
* Upload folder 'imageflow' into Coppermine's plugins folder
* Go to plugin manager page and install it
* Empty your browser cache


How to enable:
--------------
* To enable this plugin, you'll have to add "imageflow" to "the content of the main page" in coppermine's config in the section "Album list view". The setting should look like "breadcrumb/catlist/alblist/imageflow" or similar. For details, review the documentation that comes with coppermine (inside the docs folder) in the section "The gallery configuration page" > "Album list view" > "The content of the main page".


How to configure:
-----------------
* Use the button in plugin manager.


=========================================================================


Settings in detail:
-------------------

Width of Imageflow:     The width in px or %
                        Examples: 
                        900px
                        80%
                        If you use a fixed px value, the generated images will exactly fit in size
                        and needn't to be interpolated by the browser, resulting in a much better
                        image quality. Therefore it's highly recommended to use a fixed pixel value.

Number of pics          The number of pics to display in Imageflow. Minimum: 7. Usually 7-25.

Background color        The background color of Imageflow. Use hex value without leading #

Skip pics in portrait   If set, Imageflow only uses pics where width > height
  orientation

Show pics from which    Select 'Random Files', 'Last additions', 'Most viewed' or 'Top rated'
  meta album

Align                   Show animation centered or on left side

Theme has table based   Recommended for most skins, mandatory if you show Imageflow in standard
 Layout                 table of the theme

Correct upper border    If the animation is displayed too far up or too far down, you can correct it.
                        Positive values will move the animation down.
                        Negative values will move the animation up.

Generated reflexion     If you chose 50% here and your intermediate size pics have a width of 700px, the
 images have size of    generated reflexion images will be 350px width. This setting has no effect if
 normal intermediate    you use a fixed pixel value as width.
 pics in percent

Cache generated         Every pic that is displayed in Imageflow is generated via GD2, adding the
 reflexion pics         reflexion. If you activate caching, the generated images will be saved on
                        your server, thus improving performance very much at the cost of webspace.
                        You can delete these cached images at any time. They're saved where the
                        normal images are, and their names begin with refl_...
                        Please try around with the percent size (see above) until you find your
                        prefered size. AFTER this, you can activate caching with this option.


=========================================================================


Credits:
--------
This plugin is written by Timos-welt. 
The plugin uses the incredible ImageFlow script. See http://imageflow.finnrudolph.de
Please note: The author of the Imageflow javascript changed the license of his script 
with version 1.0, so you have to pay for commercial use now. This release is based on 
an older Imageflow version (0.9) that is absolutely free, so you may use it wherever you want.
Look here for details: http://finnrudolph.de/Shoutbox/1225723541

Parts of the code are adapted from the great CPG plugins 'Onlinestats' and 'Highslide' by Nibbler and Sami.
Don't try to contact the plugin author for support - post on the board publicly instead.


=========================================================================

v1.1 (2010/01/07)
-----------------
- fixed: correct handling for $matches
- fixed: a not-found-icon was displayed for pics without intermediate version


v1.0 (2010/01/06)
-----------------
* initial release
