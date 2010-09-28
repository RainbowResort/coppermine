<?php
/********************************************************
  Coppermine 1.5.x plugin - FetchContent
  *******************************************************
  Copyright (c) 2010 Coppermine dev team
  *******************************************************
  This program is free software; you can redistribute 
  it and/or modify it under the terms of the GNU General
  Public License as published by the Free Software
  Foundation; either version 3 of the License, or 
  (at your option) any later version.
  *******************************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  *******************************************************/
  
if (!defined('IN_COPPERMINE')) { 
	die('Not in Coppermine...'); 
}
$lang_plugin_fetchcontent['display_name'] = 'FetchContent';
$lang_plugin_fetchcontent['description'] = 'Zeigt Inhalte aus Coppermine auf Seiten an, die nicht durch Coppermine erzeugt werden. Kann möglicherweise irgendwann der Nachfolger von cpmFetch werden.';
$lang_plugin_fetchcontent['extra_info_create_file'] = 'Erzeuge irgendwo (innerhalb oder außerhalb des Coppermine-Verzeichnisses) eine Testdatei und füge dieser Datei folgenden Inhalt hinzu:';
$lang_plugin_fetchcontent['configuration'] = 'Einstellungen';
$lang_plugin_fetchcontent['documentation'] = 'Dokumentation';
$lang_plugin_fetchcontent['announcement_thread'] = 'Ankündigungs-Thread';
$lang_plugin_fetchcontent['info'] = 'Information';
$lang_plugin_fetchcontent['update_success'] = 'Die Einstellungen wurden erfolgreich aktualisiert; Deine Änderungen wurden gespeichert.';
$lang_plugin_fetchcontent['no_changes'] = 'Entweder gab es keine Änderungen oder die von Dir vorgenommenen Änderungen waren ungültig.';
$lang_plugin_fetchcontent['submit'] = 'Absenden';
$lang_plugin_fetchcontent['recommended'] = 'empfohlen';
$lang_plugin_fetchcontent['not_recommended'] = 'nicht empfohlen';
$lang_plugin_fetchcontent['individual_file_settings'] = 'Individuelle Einstellungen pro Datei (Bild)';
$lang_plugin_fetchcontent['deny_access_action'] = 'Aktion bei verweigertem Zugriff';
$lang_plugin_fetchcontent['output_nothing'] = 'Gar nichts ausgeben';
$lang_plugin_fetchcontent['blank_image'] = 'Leeres Bild mit den Dimensionen 1 mal 1 Pixel anzeigen';
$lang_plugin_fetchcontent['placeholder_image'] = 'Platzhalter-Bild anzeigen';
$lang_plugin_fetchcontent['display_anyway'] = 'Versuche, das Bild auf jeden Fall anzuzeigen und Berechtigungen zu ignorieren';
$lang_plugin_fetchcontent['check_referer'] = 'Referer prüfen';
$lang_plugin_fetchcontent['only_gallery_domain'] = 'Nur Anfragen der Domäne zulassen, auf der auch die Galerie läuft';
$lang_plugin_fetchcontent['domain_list'] = 'Liste erlaubter Domänen, mit einem Pipe-Symbol (vertikaler Strich) voneinander getrennt';
$lang_plugin_fetchcontent['enable_logging'] = 'Logbuch-Dateien aktivieren';
$lang_plugin_fetchcontent['errors_only'] = 'Nur Fehler';
$lang_plugin_fetchcontent['log_anything'] = 'Alles aufzeichnen';
$lang_plugin_fetchcontent['allow_non_images'] = 'Andere Dateien als Bilder erlauben';
$lang_plugin_fetchcontent['allowed_if_filetype_set'] = 'Erlaubt, aber nur wenn der URL-Parameter "filetype" ausdrücklich gesetzt wurde';
$lang_plugin_fetchcontent['allowed_if_imageonly_not_set'] = 'Erlaubt, aber nur wenn der URL-Parameter "imageonly" NICHT gesetzt wurde';
$lang_plugin_fetchcontent['allowed_no_matter_what'] = 'Bedingungslos erlaubt';
$lang_plugin_fetchcontent['debugging'] = 'Fetchcontent Debugging';
$lang_plugin_fetchcontent['example_file'] = 'Beispiel-Datei';
$lang_plugin_fetchcontent['fetching_several_files'] = 'Mehrere Dateien abholen';
$lang_plugin_fetchcontent['overall_settings'] = 'Gesamt-Einstellungen';
$lang_plugin_fetchcontent['max_cols'] = 'Maximale Anzahl von Tabellen-Spalten';
$lang_plugin_fetchcontent['max_rows'] = 'Maximale Anzahl von Tabellen-Zeilen';
$lang_plugin_fetchcontent['caching'] = 'Temporäre Dateien';
$lang_plugin_fetchcontent['hide_location'] = 'Adresse der einzelnen Dateien verschleiern';
$lang_plugin_fetchcontent['images_only'] = 'Nur Bilder';
$lang_plugin_fetchcontent['all_file_types'] = 'Alle Dateitypen';


?>