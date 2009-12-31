/**************************************************
  Coppermine 1.5.x Plugin - Image manipulation
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
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

  This plugin uses the great Pixastic Javascript library
  Copyright (c) 2008 Jacob Seidelin, jseidelin@nihilogic.dk, http://blog.nihilogic.dk/
  MIT License [http://www.pixastic.com/lib/license.txt]


This plugin allows the visitor to non-destructively manipulate the image using new LED sliders and buttons on displayimage.php. It will add ~30 kbyte of javascript to the page. The URL will change accordingly, so if you pass on the link, the recepient will see the pic just as you like it. Settings will be saved in a cookie on the visitor's computer, so if a picture is visited again, the old settings will be applied.

Available effects with compatibility mode 'on' or visitor uses IE:
 * brightness (LED slider)
 * reset
 * blur
 * b/w
 * invert
 * emboss
 * flip vertically
 * flip horizontally

Available effects with compatibility mode 'off' and visitor doesn't use IE:
 * brightness (LED slider)
 * contrast (LED slider)
 * saturation (LED slider)
 * sharpness (LED slider)
 * reset
 * sepia
 * flip vert
 * flip hori
 * invert
 * emboss
 * blur

Browser compatibility:
The effects work fine with
 - IE 5.5+
 - Opera 9.5+
 - Firefox 2+
 - Chrome 3+
 - most other modern browsers should work, too or fall back without crashing

Please note:
 * This plugin will only work if 'Insert a transparent overlay to minimize image theft' is deactivated.
 * This plugin and the plugin 'mirror' may not be used at the same time.
 * The buttons will only be available for visitors with javascript turned on. Others won't notice a thing.
 * It is highly recommended to use compatibility mode. If you don't, it depends on the visitor's browser which effects will be available.
 * Use the config page to disable compatible mode (not recommended)
 * Use the config page to disable url values
 * Use the config page to disable cookies

If you like to contribute a localisation, copy im_english.js to im_yourlanguage.js, open with a text editor and adapt the strings (first lines). The plugin will automatically use the correct language file if it exists, otherwise it defaults to im_english.js.