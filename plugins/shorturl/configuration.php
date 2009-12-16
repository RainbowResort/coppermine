<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.x
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/fav_button/configuration.php $
  $Revision: 6770 $
  $LastChangedBy: eenemeenemuu $
  $Date: 2009-11-23 15:05:21 +0100 (Mo, 23 Nov 2009) $
**********************************************/
/*********************************************
  Coppermine Plugin - Short URL
  ********************************************
  Copyright (c) 2009 eenemeenemuu
**********************************************/

$name = 'Short URL';
$description = 'Access categories, albums and pictures with a shorter url and create own short redirection urls.';
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>';
$version = '1.0';

$extra_info = '
    <a href="index.php?shorturl=config" class="admin_menu">'.cpg_fetch_icon('config', 1).$name.' '.$lang_gallery_admin_menu['admin_lnk'].'</a>
    <a href="http://forum.coppermine-gallery.net/index.php/topic,62877.0.html" rel="external" class="admin_menu external">'.cpg_fetch_icon('announcement', 1).'Announcement thread for '.$name.' plugin</a>
';

$install_info = '
    You can configure the plugin after installation using the button in the plugin manager
    <a href="http://forum.coppermine-gallery.net/index.php/topic,62877.0.html" rel="external" class="admin_menu external">'.cpg_fetch_icon('announcement', 1).'Announcement thread for '.$name.' plugin</a>
';


?>
