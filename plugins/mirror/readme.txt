/**************************************************
  Coppermine 1.5.x Plugin - Mirror
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



Mirror - add reflection to image on displayimage.php
----------------------------------------------------

This plugin generates a mirror-like reflection on displayimage.php just below 
the image. The effect is client-sided, so there's no additional server load. 
The effect is tested and works fine with IE>=6, Firefox >=1.5, Opera, Chrome, 
Safari. It's only 2,2 KByte  of Javascript that is added to the page.

Please note:
------------
Mirror will only work if 'Insert a transparent overlay to minimize image 
theft' is deactivated. 
Feel free to adapt the size and opacity of the reflection by editing mirror.js 
to your needs. 
This plugin and the plugin 'image_manipulate' may not be used at the same time.