<?php
/**************************************************
  Picture Annotation (annotate) plugin for cpg1.5.x
  *************************************************
  Copyright (c) 2003-2009 Coppermine Dev Team

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  *************************************************
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**************************************************/

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}

$lang_plugin_annotate['annotate'] = 'Beschriftung';
$lang_plugin_annotate['plugin_name'] = 'Bild-Beschriftung';
$lang_plugin_annotate['plugin_description'] = 'Füge Beschriftungen in Textform den Bildern der Galerie hinzu';
$lang_plugin_annotate['plugin_credit_creator'] = 'Programmiert durch %s für cpg1.4.x';
$lang_plugin_annotate['plugin_credit_porter'] = 'Portiert nach cpg1.5.x durch %s';
$lang_plugin_annotate['plugin_credit_js'] = 'Verwendete JavaScriptBibliotheken von %s und %s';
$lang_plugin_annotate['plugin_credit_i18n'] = 'Internationalisierung durch %s';
$lang_plugin_annotate['announcemen_thread'] = 'Ankündigungs-Theme für %s-Plugin';
$lang_plugin_annotate['delete_orphaned_entries'] = 'Verwaiste Beschriftungen löschen';
$lang_plugin_annotate['x_orphaned_entries_deleted'] = '%s verwaiste Einträge wurden gelöscht';
$lang_plugin_annotate['1_orphaned_entry_deleted'] = '1 verwaister Eintrag wurde gelöscht';
$lang_plugin_annotate['save'] = 'Speichern';
$lang_plugin_annotate['cancel'] = 'Abbrechen';
$lang_plugin_annotate['error_saving_note'] = 'Fehler beim Speichern'; // JS-alert
$lang_plugin_annotate['onsave_not_implemented'] = 'onsave muss implementiert sein, damit man tatsächlich etwas speichern kann'; // JS-alert

?>