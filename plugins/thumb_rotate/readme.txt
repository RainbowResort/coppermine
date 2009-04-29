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


  Changelog
  ---------
  0.2 to 0.3:
    - added config section
    - internationalization
    - added icons

  0.3 to 0.4:
    - better optics
    - fixed broken anti-aliasing
    
  0.4 to 0.5
    - removed image from plugin root that was added in error (resides in sub-folder "images")
    - improved version checking during install for GD version to avoid text in version string spoiling the result
    - changed cache path from folder within plugin path into sub-folder within edit folder, which should be writable out of the box
    - added display of amount of cached files 
    - added option to empty cache 
    - added farbtastic plugin (http://acko.net/dev/farbtastic)
    - added test to installer to check if cache folder is writable
    
  0.5 to 0.6
    - added permission check to config screen
    - fixed permissions of cache folder
  
  Todo
  -------------
  - sanitization of URL parameters in thumb_rotate.php for security reasons
  - add fallback option in flash as discussed in announcement thread
  - add a preview to config page