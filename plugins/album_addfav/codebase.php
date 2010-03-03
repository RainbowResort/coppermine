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
  Coppermine version: 1.4.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/
/*********************************************
  Coppermine Plugin - Album Addfav
  ********************************************
  Copyright (c) 2009 eenemeenemuu
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (defined('THUMBNAILS_PHP')) {
    $thisplugin->add_filter('page_html','album_addfav_html');
}

function album_addfav_html($html) {
    //$html = str_replace('<td class="sortorder_cell">', '<td><a href="index.php?file=album_addfav/album_addfav&album='.$_GET['album'].'" title="Add album to favorites"><img src="plugins/album_addfav/favorites.png" border="0" /></a>&emsp;</td><td class="sortorder_cell">', $html, $count);
    $html = preg_replace('/<td width="100%" class="statlink"><h2>(.*)<\/h2><\/td>/Usi', '<td width=\"100%\" class=\"statlink\"><h2>\\1 <a href="index.php?file=album_addfav/album_addfav&album='.$_GET['album'].'" title="Add album to favorites"><img src="plugins/album_addfav/favorites.png" border="0" style="display:inline" /></a></h2></td>', $html, 1, $count);

    if ($count < 1) {
        $html = preg_replace('/<td width="100%" class="statlink">(.*)<\/td>/Usi', '<td width=\"100%\" class=\"statlink\">\\1 <a href="index.php?file=album_addfav/album_addfav&album='.$_GET['album'].'" title="Add album to favorites"><img src="plugins/album_addfav/favorites.png" border="0" style="display:inline" /></a></td>', $html);
    }

    return $html;
}

?>
