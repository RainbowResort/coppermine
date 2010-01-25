<?php
/**************************************************
  Coppermine 1.5.x Plugin - album_fav_boxes!
  *************************************************
  Copyright (c) 2009 Nibbler
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}

$lightbox['lang']['plugin_name'] = 'Add thumbnails to favorites';
$lightbox['lang']['plugin_description'] = 'Plugin adds checkboxes underneath each thumbnail to directly add the file represented by the thumbnails to the favorites directly on the thumbnail page. Similar checkboxes exist on the favorites meta-album to remove some or all files from the favorites list. This plugin turns the favorites feature into a sort of lightbox.';
$lightbox['lang']['Add to favorites'] = 'Add to favorites';
$lightbox['lang']['Remove from favorites'] = 'Remove from favorites';
$lightbox['lang']['Remove selected'] = 'Remove selected';
$lightbox['lang']['Remove all'] = 'Remove all';
$lightbox['lang']['Add selected'] = 'Add selected';
$lightbox['lang']['Add selected files to favorites'] = 'Add selected files to favorites';
$lightbox['lang']['Confirm'] = 'Clear the favorites ?';
$lightbox['lang']['Belongs to favorites list'] = 'Belongs to favorites list';
$lightbox['lang']['x files added to favorites'] = '%s files added to favorites';
$lightbox['lang']['1 file added to favorites'] = '1 file added to favorites';
$lightbox['lang']['x files removed from favorites'] = '%s files removed from favorites';
$lightbox['lang']['1 file removed from favorites'] = '1 file removed from favorites';
$lightbox['lang']['Favorites cleared'] = 'Favorites cleared';
$lightbox['lang']['Announcement thread'] = 'Announcement thread';
$lightbox['lang']['Configuration'] = 'Configuration';
$lightbox['lang']['Update success'] = 'Configuration has been updated successfully; your changes have been saved.';
$lightbox['lang']['No changes'] = 'There have been no changes';
$lightbox['lang']['Submit'] = 'Submit';
$lightbox['lang']['Albums'] = 'Enable "%s" in which meta albums'; // Don't translate or modify %s
$lightbox['lang']['Regular albums'] = 'Regular albums';
$lightbox['lang']['Search results'] = 'Search results';
$lightbox['lang']['Last comments by'] = 'Last comments by';
$lightbox['lang']['Last additions by'] = 'Last additions by';
$lightbox['lang']['install_instructions'] = 'After installing you can configure in which meta albums the lightbox checkbox should be displayed. For that purpose, use the plugin\'s configuration screen on the plugin manager page.';
?>