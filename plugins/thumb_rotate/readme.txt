/**************************************************
  Coppermine 1.5.x Plugin - Thumb Rotate
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
  This plugin will rotate your thumbnails randomly, giving your gallery a 'comic' look.
  Have a look at images/screenshot.jpg for an example.
  For a working demo, visit http://cpgdev.timos-welt.de/cpg15x/
  
  Requirements
  ------------
  - a fast server
  - additional space for the generated thumbnails
  - PHP 4.3.2 or better (yes, this means that PHP 5 is fine)
  - PHP with working GD2 (ImageMagick will NOT work!)
  
  Install
  -------
  1. Unzip.
  2. Upload folder thumb_rotate to the plugin folder of your gallery.
  3. Make subfolder thumb_cache writable, this usually means CHMOD to 755 or 777.
  4. Install via plugin manager.

  Compatibility
  -------------
  This plugin is currently not compatible with
  - SEF_URL plugin
  - EnlargeIt!


  Changelog
  ---------
  0.2 to 0.3:
  	- added config section
  	- internationalization
  	- added icons
  
  Todo
  -------------
  - sanitization of URL parameters in thumb_rotate.php for security reasons
  - add fallback option in flash as discussed in announcement thread
  - granular cache control, maybe move cache into the folder /albums/edit, as that
    folder is writable in the first place
  - add a preview to config page
  - perform a test during install to check if the cache folder is actually writable