/**************************************************
  Coppermine 1.5.x Plugin - Thumb Rotate $VERSION$=0.2
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
  Have a look at thumb_rotate_screenshot.jpg for an example.
  
  Requirements
  ------------
  - a fast server
  - additional space for the generated thumbnails
  - PHP 4.3.2 or PHP 5
  - PHP with working GD2 (ImageMagick will NOT work!)
  
  Install
  -------
  1. Unzip.
  2. Open codebase.php with a text editor and change values for 
     $maxdegree, $themebackcolor, $border and $brdcolor
  3. Upload folder thumb_rotate to the plugin folder of your gallery.
  4. Make subfolder thumb_cache writable, this usually means CHMOD to 755 or 777.
  5. Install via plugin manager.

  Compatibility
  -------------
  This plugin is currently not compatible with
  - SEF_URL plugin
  - EnlargeIt!
