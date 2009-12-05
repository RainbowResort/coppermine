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
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/album_fav_boxes/admin.php $
  $Revision: 6793 $
  $LastChangedBy: gaugau $
  $Date: 2009-11-26 18:23:33 +0100 (Do, 26. Nov 2009) $
  **************************************************/

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
$lightbox['lang']['Configuration'] = 'Einstellungen';
$lightbox['lang']['Update success'] = 'ie Werte wurden erfolgreich aktualisiert';
$lightbox['lang']['No changes'] = 'Es gabe keine Änderungen';
$lightbox['lang']['Submit'] = 'Senden';
$lightbox['lang']['Albums'] = 'Aktiviere "%s" in den folgenden Meta-Alben'; // Don't translate or modify %s
$lightbox['lang']['Regular albums'] = 'Normale Alben';
$lightbox['lang']['Search results'] = 'Suchergebnisse';
$lightbox['lang']['Last comments by'] = 'Letzte Kommentare von';
$lightbox['lang']['Last additions by'] = 'Zuletzt hinzugefügt von';
$lightbox['lang']['install_instructions'] = 'Nach der Installation kannst Du entscheiden, in welchen Meta-Alben die Lightbox-Ankreuzfelder erscheinen sollen. Benutze dazu die "Einstellungen"-Schaltfläche auf der Plugin-Manager-Seite.';
?>