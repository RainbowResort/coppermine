<?php
/*************************
  mass_import Plugin for cpg1.5.x
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.x
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/mass_import/lang/english.php $
  $Revision: 6490 $
  $LastChangedBy: gaugau $
  $Date: 2009-08-19 10:44:55 +0200 (Mi, 19 Aug 2009) $
**********************************************/

if (!defined('IN_COPPERMINE')) { 
    die('Not in Coppermine...');
}

$lang_plugin_mass_import['name'] = 'Mass Import';
$lang_plugin_mass_import['admin_title'] = 'Massen-Import';
$lang_plugin_mass_import['description'] = 'Das Plugin Massen-Import ermöglicht dem Admin, eine große Anzahl von Dateien aus einer bestehenden Ordner-Struktur zur Galerie hinzuzufügen.';
$lang_plugin_mass_import['subdir_desc'] = 'Unterverzeichnis von "albums" oder leer';
$lang_plugin_mass_import['sleep_desc'] = 'Pause zwischen den einzelnen Import-Schritten';
$lang_plugin_mass_import['in_milliseconds'] = 'in Millisekunden';
$lang_plugin_mass_import['hardlimit_desc'] = 'Import-Dateien pro Durchgang';
$lang_plugin_mass_import['autorun_desc'] = 'Unbeaufsichtigter Ablauf';
$lang_plugin_mass_import['skipping'] = 'Überspringe Thumbnail und Bild in Zwischengröße';
$lang_plugin_mass_import['file_already_in_database'] = 'Datei bereits in Datenbank vorhanden';
$lang_plugin_mass_import['file_added_to_database'] = 'Datei zum Datenbestand hinzugefügt';
$lang_plugin_mass_import['failed_to_add_file_to_database'] = 'Konnte Datei nicht zum Datenbestand hinzufügen';
$lang_plugin_mass_import['root_create'] = 'Wurzel-Kategorie erzeugt';
$lang_plugin_mass_import['root_exists'] = 'Wurzel-Kategorie besteht bereits';
$lang_plugin_mass_import['root_use'] = 'Verwende Wurzel-Kategorie';
$lang_plugin_mass_import['album_exists'] = 'Album besteht bereits';
$lang_plugin_mass_import['album_create'] = 'Album wurde erzeugt';
$lang_plugin_mass_import['cat_exists'] = 'Kategorie besteht bereits';
$lang_plugin_mass_import['cat_create'] = 'Kategorie wurde erzeugt';
$lang_plugin_mass_import['pics_found'] = 'Dateien Gefunden';
$lang_plugin_mass_import['pics_indb'] = 'Dateien im Bestand der Datenbank';
$lang_plugin_mass_import['pics_afterfilter'] = 'Dateien, die nach der Filterung hinzugefügt werden müssen';
$lang_plugin_mass_import['structure_created'] = 'Struktur erzeugt';
$lang_plugin_mass_import['files_added'] = 'Dateien hinzugefügt';
$lang_plugin_mass_import['files_to_add'] = 'Zu verarbeitende Dateien';
$lang_plugin_mass_import['path'] = 'Pfad';
$lang_plugin_mass_import['announcement_thread'] = 'Ankündigungs-Thread';
$lang_plugin_mass_import['install_info'] = 'Der Massen-Import funktioniert ähnlich wie das Batch-Hinzufügen, es ermöglicht aber die verarbeitung einer ganzen Ordnerstruktur mit Unterordnern und Dateien in einem Durchgang. Das Plugin erzeugt Kategorien und Alben entsprechend der Verzeichnisnamen innerhalb der Ordnerstruktur und durchläuft dann diese Struktur und fügt die gefundenen Dateien der Datenbank hinzu und erzeugt Thumbnails und Bilder in Zwischengröße.<br />Dieses Plugin ist ebenfalls empfehlenswert, falls der normale Batch-Hinzufügen-Vorgang zu viele Ressourcen verbraucht und der Webhost deswegen aktiv wird.';

?>