Plugins for the Coppermine Photo Gallery are add-ons that use the plugin interface of Coppermine.
Read up the documentation that comes with Coppermine to find out more, e.g. how to install a plugin.

Coppermine version: cpg1.4.x
Plugin name: PhotoComment
Plugin version: 1.01
Plugin author: JohanLundin
Plugin announcement thread: http://forum.coppermine-gallery.net/index.php/topic,29229.0.html



Just wrote up a quick and dirty plugin to extract the EXIF UserComment field from JPG pictures and display it in Coppermine as title/caption.

A few related URLs:

Description and download of plugin:
http://www.bluenine.se/products/photocomment/coppermineplugin.html

An EXIF UserComment editor:
http://www.bluenine.se/products/photocomment/

The plugin in action:
http://www.tacticaldiving.com/cpg/index.php

Any possibility to change the require to require_once in exif_php.inc.php for next release?
Would simplify the installation of this plug-in and won't break anything else.


PhotoComment Coppermine plugin
- Displays your comment as image description in Coppermine

PhotoComment is by default configured to read and save comments for JPG pictures using the EXIF UserComment field. When publishing your photos online you may want to display these comments together with the pictures.

Coppermine is one of the better free open source photo album software packages available. The reason Coppermine was chosen to work with PhotoComment was:

    * Coppermine works reasonable well in PHP SafeMode which most PHP ISP offers
    * Coppermine is the most advanced photo album that still satisfies the previous condition
    * Coppermine has a plugin architecture making modifications easy

To install the PhotoComment Coppermine plugin follow these steps:

   1. Install Coppermine
   2. Download the plugin
   3. Unzip the plugin file and upload to server to create the following file structure
      <coppermine_root>/plugins/PhotoComment
      containing the files codebase.php and configuration.php
   4. Edit the file <coppermine_root>/include/exif_php.inc.php and change the line
      require("include/exif.php");
      to
      require_once("include/exif.php");
   5. Install the plugin from the Coppermine admin interface

