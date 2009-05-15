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
  Installation works exactly as suggested in the coppermine documentation.
  1. Unzip on your client.
  2. Upload folder thumb_rotate to the plugin folder of your gallery.
  3. Install via plugin manager.
  
  Uninstall
  ---------
  Un-Installation works exactly as suggested in the coppermine documentation.
  1. Uninstall via plugin manager.

  Upgrading
  ---------
  To upgrade this plugin do not just overwrite.
  Instead:
  1. Uninstall first (using the plugin manager). It's safe to keep the settings and cache.
  2. Replace the plugin files
  3. Install (using the plugin manager) 
  
  Configuration
  -------------
  The plugin comes with a configuration panel that you can access by clicking on the 
  corresponding config link from within the plugin manager screen. 
  To access the config screen manually, go to 
  http://yoursite.tld/your_coppermine_folder/index.php?file=thumb_rotate/index
  
  The config options should be pretty self-explanatory.
  Just make sure to set up your config as needed before populating a large gallery with
  rotated thumbnails: each time you modify a config option that has an impact on the rotated
  thumbnail files, the entire cache will be deleted and needs to be built from scratch.
  
  Caching
  -------
  The plugin populates the cache (i.e. creates rotated images) as your site's visitors access
  your gallery: each time the browser of your visitor requests a set of thumbnails, the plugin
  checks if those particular thumbnails already exist in the cache. If they are not already
  cached, they will be created during run-time and stored (cached).
  The storage happens in the same folder structure your coppermine files reside in: if a particular
  picture that resides in your gallery is located at 
  http://yoursite.tld/your_coppermine_folder/albums/userpics/10003/my_image.jpg, this plugin will create
  a rotated thumbnail and store that within the same folder under the name rotate_my_image.png.
  You don't have to worry about the location of the cached files - the plugin takes care of that.
  However, for those with limited resources, a few extra options have been added: in the plugin's 
  config screen, you can make the plugin admin-only to allow you to build the cache in advance
  over a longer period (using the cache batch-fill process) before finally displaying the rotated
  thumbnails to your site visitors.
  Another option to make the impact of the resources-consumption of this plugin less dramatical is
  the delay setting: you can specify the number of seconds to pass between the creation of a cache
  file. In batch-fill mode, the script will create one rotated thumbnail, wait for the time span
  specified and then continue with the next file. In "regular" mode (when the rotated thumbnails
  get created when they are requested by the visitor's browser), the script will create one
  rotated thumbnail per page and no more - the rest of the thumbnails that haven't been rotated
  yet will be sent to the visitor's browser without rotation effect.

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
	- added a check that makes sure to process only the file types it can process
	
  1.1 to 1.2
  	- added explanation why there's no preview when cache is empty
  	- removed 'empty cache' button if the cache is already empty
  	- added total stats
  	- fixed broken display of generic thumbs
  	- added a toggle that makes rotation admin-only to allow preparation of rotation in advance
  	- added a delay field to config that allows to reduce the resources consumption of the plugin
  	- added routine to batch-fill the cache in a slow manner for decreased workload
  	- added icon for batch-fill
  	- added spinbutton control to text fields	
	
  1.2 to 2.0
	- removed the spinbutton JS that went into the core instead
	- re-added check to plugin install for existence of imagerotate function
	- added width and height fields to database
	- added replacement of width and height attributes for rotated thumbs
	
  2.0 to 2.1
	- added support for rounded corners
	- re-wrote function thumb_rotate_image_create from scratch
	- added rounding angle field
	- added fallback to ImageMagick if imagerotate function doesn't exist (on debian systems)
	
  2.1 to 2.2	
	- removed type toggle
	- improved performance by disabling image manipulation steps if corresponding option is set to zero
	- added fixed rotation option
  
  Todo
  -------------
  - add fallback option in flash as discussed in announcement thread
  - apply for the film strip as well
  - apply for the album thumbs as well
  - add other drop shadow support
  - add help text to config screen
  - add a routine to batch-fill to prevent an endless loop.
  
  
  Known Issues
  ------------
  - Currently doesn't work for the lastalb meta album - please turn that off in coppermine's config
  - If the function imagerotate is not present, the fallback function will look distorted because of lacking support for transparency