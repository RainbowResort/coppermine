/***************************************************
  Video to Flash Plugin for Coppermine Photo Gallery
  **************************************************

  License: This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.x
  Plugin version: 1.0
  $Author: Abbas Ali (abbas@coppermine-gallery.net) $
  $Date: Tue, 7th Jul 2009 $
**********************************************/

This plugin requires ffmpeg (with mp3 codec) [http://ffmpeg.mplayerhq.hu] pre-installed and working on your server. 
Please DO NOT ask for support on installing or configuring ffmpeg. If you don't have ffmpeg or can't install ffmpeg on your server then this plugin is not meant for you.


What will this plugin do?
--------------------------
This plugin will convert all uploaded videos to flv format and create thumbnail from the uploaded video file on the fly. 
FLV and thumbnails will be placed in the directory where the videos are uploaded/batch added. 
Though ffmpeg supports many video formats but i am unsure about wmv. File formats which i tested were avi, mpg, asf, mov.

Secondly on displayimage page a flash player (JW FLV Player) will play those videos. 
So the functionality of this plugin is similar to what Youtube offers i.e. upload video in any format and it will be converted to flv and played using flash player.

So what are you waiting for? Turn your personal gallery into youtube.


How to install
---------------
1. Upload folder video2flash_ffmpeg to your plugins folder.
2. Install via plugin manager.


How to uninstall
-----------------
1. Uninstall via plugin manager.
2. Remove folder video2flash_ffmpeg from your plugins folder.


Support
-------
Plugin support is only available on coppermine support forums - http://forum.coppermine-gallery.net/index.php/topic,60539.0.html
Please do not email me asking for support.


CHANGELOG
----------
v1.0
[2009-07-10] Release of v1.0