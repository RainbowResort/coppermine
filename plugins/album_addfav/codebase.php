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
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/
/*********************************************
  Coppermine Plugin - Album Addfav
  ********************************************
  Copyright (c) 2010 eenemeenemuu
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (defined('THUMBNAILS_PHP')) {
    $thisplugin->add_filter('page_html','album_addfav_html');
}

function album_addfav_html($html) {
    $superCage = Inspekt::makeSuperCage();
    $html = preg_replace('/(<td style="vertical-align:top" class="statlink">.*<h2>)(.*)(<\/h2>.*<\/td>)/Usi', '\\1\\2 <a href="index.php?file=album_addfav/add&amp;aid='.$superCage->get->getInt('album').'" title="Add all pictures of this album to your favorites"><img src="images/icons/favorites.png" border="0" style="display:inline" /></a>\\3', $html, 1);
    return $html;
}

?>
