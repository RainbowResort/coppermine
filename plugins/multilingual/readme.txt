/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2005 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.4.8
  $Source$
  $Revision: 1.2 $
  $Author: abbas-ali $
  $Date: 2006-07-17 $
**********************************************/

What it does:
-------------
This plugin displays the category/album/picture's titles and descriptions in multiple languages.
This plugin has been created for cpg1.4.x

=========================================================================

How to install:
---------------
* Log into your coppermine page as admin
* Go to coppermine's config, expand "General settings", click "Manage plugins" next to "Enable plugins" (make sure that you have set "Enable plugins to "Yes"). Alternatively, you can directly access the plugin manager by entering http://yoursite.tld/your_coppermine_folder/pluginmgr.php into the address bar of your browser
* On the plugin manager page, click "browse", navigate to the plugin zip, click "upload". Alternatively, you can unzip the plugin on your client (preserving the folder structure) and then FTP-upload the unzipped folder into the plugins sub-folder of your coppermine install.
* If the plugin has been unzipped properly on your server, the plugin manager should refresh and you should see the plugin listed in the section "Plugins Not installed". Click the install icon (the "i") next to it
* If the plugin has got a configuration screen, go through it and submit your changes. "Multi Language" does have a configuration screen that prompts to select the languages you want to support.
* Then you need to put plugin hooks in two files viz index.php and include/functions.inc.php (See below for details).
* Most plugins are then ready for use and active.
* Multi Langauage needs you to enter texts in multiple langauges for albums, categories and pictures.
* This is done using the mod_lang.php file. This file is given along with plugin and you can find it in plugins/multilingual/ directory. mod_lang.php should be moved to your coppermine's root directory i.e. the url for mod_lang.php should be http://yoursite.tld/your_coppermine_folder/mod_lang.php
* To access mod_lang.php add a custom link via cpg config page or add a link manually by editing theme file or access it directly by entering URL in address bar of browser.

=========================================================================

How to input texts for mulitple languages:
------------------------------------------
* First create categories/albums/pictures and give their titles and descriptions as you would do normally.
* Access http://yoursite.tld/your_coppermine_folder/mod_lang.php (you need admin perms for this)
* Before doing anything on this page, you should always synchronize the categories/albums/pictures texts. This can be done by clicking the "Synchronize Categories", "Synchronize Albums", "Synchronize Pictures" links one by one.
* Whenever you add/edit/delete any category/album/picture, you should always come to this page and synchronize the respective element else the plugin won't work properly.
* After synchronization you can enter the texts for category/albums/pictures by selecting respective items from three drop downs provided.
* First drop down is used to input texts for categories. It lists all the categories with chosen langauges and place to input the translated texts.
* Second drop down is category drop down. When a category is selected, it lists all the albums within that category.
* Third drop down list all the available albums. On selecting album all the pictures inside that album are displayed.

=========================================================================

Known issues:
-------------
This plugin is used for mutli language felicitation but ironically the plugin is itself only in english.

=========================================================================

Credits:
--------
This plugin is created by Abbas Ali.
Don't try to contact the plugin author for support - post on the board publicly instead.

=========================================================================

Caveats:
--------
This plugin is still in an early beta stage (experimental). Please report possible bugs or improvements on the thread that deals with it on : http://coppermine-gallery.net/forum/
The plugin runs additional queries on the database each time it is being executed, burning cpu cycles and using resources. It also searches for text strings and replaces them and this again eats CPU. If your coppermine gallery is slow or has got a lot of pictures you shouldn't use it.

#############################################

You need to put hooks to plugin filters to make this plugin work. For this do as given below..

Edit index.php

Add (in function get_subcat_data)

[code]
$subcat['description'] = CPGPluginAPI::filter('lang_convert', $subcat['description']);
$subcat['name'] = CPGPluginAPI::filter('lang_convert', $subcat['name']);
[/code]

just after

[code]
foreach ($rowset as $subcat) {
[/code]

then Add (in function list_albums)

[code]
$alb_thumb['description'] = CPGPluginAPI::filter('lang_convert', $alb_thumb['description']);
$alb_thumb['title'] = CPGPluginAPI::filter('lang_convert', $alb_thumb['title']);
[/code]

just before

[code]
if (isset($cross_ref[$aid])) {
[/code]

then Add (in function list_cat_albums)

[code]
$alb_thumb['description'] = CPGPluginAPI::filter('lang_convert', $alb_thumb['description']);
$alb_thumb['title'] = CPGPluginAPI::filter('lang_convert', $alb_thumb['title']);
[/code]

just before

[code]
if (isset($cross_ref[$aid])) {
[/code]

-----------------------------------------------------

Edit functions.inc.php

Add (in function build_caption)

[code]
$row['caption'] = CPGPluginAPI::filter('lang_convert', $row['caption']);
$row['title'] = CPGPluginAPI::filter('lang_convert', $row['title']);
[/code]

just before

[code]
$caption='';
[/code]

then Add (in function breadcrumb)

[code]
$category[1] = CPGPluginAPI::filter('lang_convert', $category[1]);
[/code]

just before

[code]
$breadcrumb_links[$cat_order] = "<a href=\"index.php?cat={$category[0]}\">{$category[1]}</a>";
[/code]

and Add

[code]
$CURRENT_ALBUM_DATA['title'] = CPGPluginAPI::filter('lang_convert', $CURRENT_ALBUM_DATA['title']);
[/code]

just before

[code]
$breadcrumb_links[$cat_order] = "<a href=\"thumbnails.php?album=".$CURRENT_ALBUM_DATA['aid']."\">".$CURRENT_ALBUM_DATA['title']."</a>";
[/code]

#################################################################