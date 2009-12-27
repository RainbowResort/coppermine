  *************************************************
  Coppermine 1.5.x Plugin - Image manipulation $VERSION$=0.7
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  *************************************************

  This plugin uses the great Pixastic Javascript library
  Copyright (c) 2008 Jacob Seidelin, jseidelin@nihilogic.dk, http://blog.nihilogic.dk/
  MIT License [http://www.pixastic.com/lib/license.txt]


This plugin allows the visitor to non-destructively manipulate the image using new LED sliders and buttons on displayimage.php. It will add ~30 kbyte of javascript to the page. The URL will change accordingly, so if you pass on the link, the recepient will see the pic just as you liked it.

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
 * To disable compatibility mode, open the *.js files and set var im_compatible = 0;
 * To disable URL modification, open the *.js files and set var im_useurlvalues = 0;

If you like to contribute a localisation, copy pixastic_english.js to pixastic_yourlanguage.js, open with a text editor and adapt the strings (first lines). The plugin will automatically use the correct language file if it exists, otherwise it defaults to pixastic_english.js.

This plugin uses the great Pixastic Javascript library (http://www.pixastic.com) by Jacob Seidelin (MIT License).