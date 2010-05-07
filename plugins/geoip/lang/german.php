<?php
/**************************************************
  Coppermine 1.5.x Plugin - Geo IP Lookup (geoip)
  *************************************************
  Copyright (c) 2010 Joachim Müller
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

//Language file strings
$lang_plugin_geoip['plugin_name'] = 'Geo IP Lookup';
$lang_plugin_geoip['plugin_description'] = 'Zeigt die Länder zu den IP Adressen Deiner Besucher nach und zeigt ein eine entsprechende Landesflagge neben der jeweiligen IP-Adresse (nur-Admin Feature).';
$lang_plugin_geoip['plugin_details'] = 'Die Zuordnung ist nicht zu hunderprozentig möglich, sollte aber für die meisten Einstellungen funktionieren. Die Zuordnung verbaucht zusätzliche Rechnleistung, so dass dieses Plugin nur installiert werden sollte, wenn genügend serverseitige Ressourcen verfügbar sind.';
$lang_plugin_geoip['announcement_thread'] = 'Ankündigungs-Thread';
$lang_plugin_geoip['plugin_code'] = 'Programmierung des Plugins';
$lang_plugin_geoip['api_and_database'] = 'API und Datenbank';
$lang_plugin_geoip['released_under_gnu_gpl'] = 'veröffentlicht unter der GNU GPL';
$lang_plugin_geoip['city_lookup'] = 'Um die Zuordnung der Stadt zur IP-Adresse zu aktivieren mußt Du eine %s herunterladen, sie entpacken und auf Deinen Webserver in das Verzeichnis hochladen, das der URL %s entspricht. Diese zusätzliche Datei verbraucht ca. 30 MB zusätzlichen Webspace, weshalb sie auch nicht mit dem Plugin gebündelt wurde.';
$lang_plugin_geoip['additional_file'] = 'zusätzliche Datei';
$lang_plugin_geoip['download_city_database'] = 'Zusätzliche Datei GeoLite City herunterladen';
$lang_plugin_geoip['configure_plugin'] = 'Konfiguriere das Plugin %s';
$lang_plugin_geoip['update_success'] = 'Die Einstellungen wurden erfolgreich aktualisiert; Deine Veränderungen wurden gespeichert.';
$lang_plugin_geoip['no_changes'] = 'Es gab keine Veränderungen, die gespeichert werden müssten.';
$lang_plugin_geoip['scope'] = 'Anwendungsbereich der IP-Adress-Zuordunung';
$lang_plugin_geoip['country'] = 'pro Land';
$lang_plugin_geoip['city'] = 'auf Ebene einzelner Ortschaften';
?>