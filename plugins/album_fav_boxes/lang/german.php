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
$lightbox['lang']['plugin_name'] = 'Thumbnails zu Favoriten hinzufügen';
$lightbox['lang']['plugin_description'] = 'Dieses Plugin fügt auf der Thumbnail-Seite Checkboxen unterhalb jedes Thumbnails ein, damit die zugehörige Datei direkt zu den Favoriten hinzugefügt werden kann. Ähnliche Checkboxen existieren innerhalb der Favoriten-Anzeige, um einzelne oder alle Dateien aus dem Meta-Album &quot;Favoriten&quot; zu entfernen. Dieses Plugin wandelt das Favoriten-Feature in eine Art Lichtkasten um.';
$lightbox['lang']['Add to favorites'] = 'Zu Favoriten hinzufügen';
$lightbox['lang']['Remove from favorites'] = 'Von Favoriten entfernen';
$lightbox['lang']['Remove selected'] = 'Gewählte Dateien entfernen';
$lightbox['lang']['Remove all'] = 'Alle entfernen';
$lightbox['lang']['Add selected'] = 'Gewählte Dateien hinzufügen';
$lightbox['lang']['Add selected files to favorites'] = 'Gewählte Dateien zu den Favoriten hinzufügen';
$lightbox['lang']['Confirm'] = 'Favoriten löschen?';
$lightbox['lang']['Belongs to favorites list'] = 'Gehört zur Liste der Favoriten';
$lightbox['lang']['x files added to favorites'] = '%s Dateien zu den Favoriten hinzugefügt';
$lightbox['lang']['1 file added to favorites'] = 'Eine Dateie zu den Favoriten hinzugefügt';
$lightbox['lang']['x files removed from favorites'] = '%s Dateien von der Favoriten-Liste entfernt';
$lightbox['lang']['1 file removed from favorites'] = 'Eine Datei von der Favoriten-Liste entfernt';
$lightbox['lang']['Favorites cleared'] = 'Favoriten-Liste wurde gelöscht';
$lightbox['lang']['Announcement thread'] = 'Ankündigungs-Thread';
?>