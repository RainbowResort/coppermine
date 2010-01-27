Plugins for the Coppermine Photo Gallery are add-ons that use the plugin interface of Coppermine.
Read up the documentation that comes with Coppermine to find out more, e.g. how to install a plugin.

Coppermine version: cpg1.4.x
Plugin name: Mosaic
Plugin version: 1.0
Plugin author: Stramm
Plugin announcement thread: http://forum.coppermine-gallery.net/index.php/topic,53767.0.html


This plugin lets you create a photomosaic ( http://en.wikipedia.org/wiki/Photomosaic ). It uses the google library phpmosaic ( http://code.google.com/p/phpmosaic/ ).

This plugin is very resource hungry. Therefore you can override memory_limit and timeout (if you don't make use of the safe mode).

How to get started:
1. Install the plugin.
2. Check settings and modify them to your needs
3. Build an index (needs some time, depending on your server - you may want to do that album by album - if you've created an index for a pic, then you'll have to clear the entire index db [click clear], to remove it. If an index already exists for an image, creating the indexes again for that album would skip this image)
Try to have as many indexed images as possible for the best result.
Try to have pics with different colors (also extremes)
4. In the intermediate view below the pic you'll see a 'Build mosaic button' - click it and the process starts (may take its time). When finished, the button gets replaced with a download link

Settings:
Click the mosaic button in the admin menu to go to the mosaic config menu
- Enable mosaic: ( function disabled atm cause of the next setting)
- Only admin can create mosaics: if you want your users not to take heat on your box
- Resize option: when creating the thumbs to be used for the mosaic, the get resized. Here you can set how this has to be done... options - cut   |  ignore  |   deform
- Thumbnail width: width of the thumb to be used for the mosaic
- Thumbnail height: height of the thumb to be used for the mosaic
- Time Limit in seconds (0 = unlimited) (only if safemode = off) : default 0
- Memory Limit in Megabyte, auto doesn't change the default set by php.ini (only if safemode = off): 'auto' as siad uses the php.ini setting, use eg. 8, 16, 32, 64, 128... 512 etc. depending on your server
- Thumbnail limit for mosaic image creation process (0 = unlimited) maximum number of thumbnails in mosaic-image: default 7500; if you set the other options to high, this may not be enough thumbs and you need to increase it (but then you need more memory, too)
- How many pixel together get replaced by a thumb (0 = auto calculation): auto calc makes 32 thumbs fit in the source images width. The lower you set this, the more thumbs you need (better result, but a lot more CPU + mem is needed)
- Distance same thumbs must have at minimum (0 = each thumb only once per image): This number sets the distance the same thumbs must have in x,y. If you set it eg. to 4, then the same thumbs have at least 4 other images between them in x and y dimension. If you do not have that much indexed images, then it may be good, to set this to 1
- Jpeg quality of the mosaic image : That's of course the quality used to save the final image
