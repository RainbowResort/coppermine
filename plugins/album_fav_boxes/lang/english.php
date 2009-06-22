<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/albmgr.php $
  $Revision: 6131 $
  $LastChangedBy: gaugau $
  $Date: 2009-06-10 08:42:56 +0200 (Mi, 10 Jun 2009) $
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$lightbox = array();
$lightbox['lang']['plugin_name'] = 'Add thumbnails to lightbox';
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

?>