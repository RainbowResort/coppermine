/**************************************************
  Coppermine 1.4.x Plugin - Imageflow $VERSION$=2.08
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ***************************************************/


What it does:
-------------
Displays a coverflowish JavaScript animation of a meta album on main page.
The animation can be controlled by:
 - click on a pic
 - arrow keys
 - double click or single click on active pic opens intermediate page
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
* Use the additional button 'Imageflow' in admin menu.


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

Show Imageflow in       If you select 'Yes', a standard table will be drawn around Imageflow
  standard table of     with the title of the selected meta album. Please test carefully if
  the theme             everything is displayed correctly in different browsers if you select 'Yes'!

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
The plugin uses the incredible free ImageFlow script. See http://imageflow.finnrudolph.de
Parts of the code are adapted from the great CPG plugins 'Onlinestats' and 'Highslide' by Nibbler and Sami.
Don't try to contact the plugin author for support - post on the board publicly instead.


=========================================================================


Change log:
-----------

v2.08 (2008/12/11)
------------------
fixed: IE would display unwanted tooltips
fixed: IE6 sometimes crashed with a strange error report ('member not found')

v2.08 (2008/11/18)
------------------
Fixed global use of $matches in mainpage function.

v2.06 (2008/11/05)
------------------
EnlargeIt! can now be used to play youtube movies, though these will not appear as thumbs in imageflow

v2.05 (2008/09/15)
------------------
fixed a bug with Firefox 3 that would lead to ugly selections when using the slider

v2.03 (2008/08/27)
------------------
fixed a bug that would lead to double id's (invalid XHTML) if not enough pics in cat
added french translation

v2.02 (2008/07/10)
------------------
faster reaction with EnlargeIt! plugin
removed BOM from one of the JS files

v2.0 (2008/06/16)
-----------------
* Works together with EnlargeIt! plugin.

v1.72 (2008/05/11)
------------------
* New EnlargeIt! version 0.94 fixes two bugs
* Added dutch language file (thanks Hein)

v1.71 (2008/05/09)
------------------
* Fixed a bug where pics wouldn't be displayed when no intermediate pic had been 
  generated
* Changed the way the script is integrated into the header for better
  compatibility with bridged and/or heavily modded gallerys
* New EnlargeIt! version 0.93 with more options
* Added italian language (contribution by user ngul)


v1.7 (2008/05/03)
-----------------
* EnlargeIt! integration (see http://enlargeit.timos-welt.de)
* better support of pics with funny filenames


v1.5 (2008/04/16)
-----------------
* now out of the box compatible with Highslide, Slider and most other Javascripts
* corrected JS syntax to make it packable, the JS is now only 5,5 kByte in
  size, unpacked version is still included as 'imageflow_source.js'


v1.4 (2008/03/31)
-----------------
* the Imageflow container now has correct height for pics with relations width:height
  from format 2:3 to 20:1, so they won't overlap the borders anymore
* if Imageflow width is set to a fixed pixel value (e. g. 800px), the reflexion
  images will be generated exact in size to fit. This greatly improves image
  quality and loading speed, because the images needn't to be interpolated by
  the client browser when having their maximum size while in focus; therefore,
  it's highly recommended to use a fixed px value instead of a % setting for 
  Imageflow width
* improved animation - all pics now on a straight line like in original coverflow
  

v1.3 (2008/03/28)
-----------------
* fixed a bug where pics wouldn't be displayed if no intermediate size image had been
  generated
* fixed a bug where Imageflow would possibly prevent other plugins from working


v1.2 (2008/03/28)
-----------------
* new option to select meta album (random files, last additions, most viewed, top rated)
* new option to display imageflow in a standard table of the theme with caption; this way,
  Imageflow can replace one of the meta album contents completely (e. g. top rated pics)
* now works as intended in multi-user galleries
* if there's not enough pics in a category, they will be repeated to give at least 5 pics
  to prevent the Imageflow animation from crashing
* if there's not a single pic in a category, the plugin will display random pics from the
  whole gallery
* if there's not a single pic in the whole gallery, a dummy pic will be used to prevent
  the Imageflow animation crashing
* a few performance improvements in codebase.php

v1.1 (2008/03/26)
-----------------
* Fullsize display didn't work anymore - fixed.
* Option 'Imageflow is inside a table' now works as expected;
  as it doesn't harm normally, standard value is now 'Yes'.

v1.0 (2008/03/25)
-----------------
* initial release
