<?php
/**************************************************
  CPG Mosaic Plugin for Coppermine Photo Gallery
  *************************************************
  Copyright (c) 2006 Thomas Lange <stramm@gmx.net>
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Coppermine version: 1.4.18
  Mosaic version: 1.0
  $Revision: 1.0 $
  $Author: stramm $
***************************************************/

if (!defined('IN_COPPERMINE'))
{
	die('Not in Coppermine...');
}


$lang_mosaic = array(
  'admin_title' => 'Mosaic',
  'uninstall' => 'Remove the table that was used to store the mosaic data ?',
  'send' => 'Build mosaic',
  'download' => 'Download mosaic',
  );

if (defined('MOSAIC_ADMIN_PHP'))
{
$lang_mosaic_config = array(
  'yes_cut' => 'cut',
  'yes_ignore' => 'ignore',
  'yes_deform' => 'deform',
  'title' => 'Mosaic',
  'index' => 'Build index from selected album',
  'clear' => 'Clear index',
  );



$lang_mosaic_admin_data = array(
  'Mosaic Settings',
  array('Enable mosaic', 'mosaic_enabled', 1),
  array('Only admin can create mosaics', 'mosaic_admin', 1),
  array('Resize option', 'mosaic_resize_option', 2),
  array('Thumbnail width', 'mosaic_thumbnail_width', 0),
  array('Thumbnail height', 'mosaic_thumbnail_height', 0),
  array('Thumbnail quality', 'mosaic_thumbnail_quality', 0),
  array('Time Limit in seconds (0 = unlimited) (only if safemode = off)', 'mosaic_time_limit', 0),
  array('Memory Limit in Megabyte, auto doesn\'t change the default set by php.ini (only if safemode = off)', 'mosaic_memory_limit', 0),
  array('Thumbnail limit for mosaic image creation process (0 = unlimited) maximum number of thumbnails in mosaic-image', 'mosaic_thumbnail_limit', 0),
  array('How many pixel together get replaced by a thumb (0 = auto calculation)', 'mosaic_range', 0),
  array('Distance same thumbs must have at minimum (0 = each thumb only once per image)', 'mosaic_distance', 0),
  array('Jpeg quality of the mosaic image', 'mosaic_quality', 0),
);

}
?>