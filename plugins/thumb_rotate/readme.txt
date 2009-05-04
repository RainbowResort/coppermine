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
  
  0.6 to 0.7
    - added hidden config option for rotated thumb prefix
    
  0.7 to 1.0
    - dropped usage of separate file: entire code now resides in codebase.php
    - fixed security issue: plugin can no longer be abused to retrieve content
    - removed cache folder - caching happens within the regular coppermine folder structure
    - added db table to store the cache records
    - take care of files that the GD lib can not handle (e.g. custom thumbs or generic ones)
  
  1.0 to 1.1
	- added style command to make sure that there is no interfering border for the CSS class .image
	- re-added the stats (number of cached files) to the config screen
	- added button to manually clear the cache
	- added expand/collapse toggles for the color pickers
	- added option to preserve settings on uninstall
	- added a preview to config page
	- fixed generation of rotated thumbnails for all meta albums except 'lastalb'
	- added empty_cache page that allows emptying the cache for a large number of files
	
  
  Todo
  -------------
  - add fallback option in flash as discussed in announcement thread
  - apply for the film strip as well
  - apply for the album thumbs as well
  - add a check that makes sure to process only the files it can process
  
  Known Issues
  ------------
  - Currently doesn't work for the lastalb meta album - please turn that off in coppermine's config
  - If the function imagerotate is not present, the fallback function will look distorted because of lacking support for transparency