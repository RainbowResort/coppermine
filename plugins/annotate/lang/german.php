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
$lang_plugin_annotate['submit_to_install'] = 'Sende das Formular ab, um das Plugin zu installieren';
$lang_plugin_annotate['configure_plugin'] = 'Konfiguriere Bild-Beschriftungs Plugin';
$lang_plugin_annotate['changes_saved'] = 'Deine Änderungen wurden gespeichert';
$lang_plugin_annotate['no_changes'] = 'Es gab keine Änderungen oder Deine Änderungen waren ungültig';
$lang_plugin_annotate['guests_more_permissions_than_registered'] = 'Gästen mehr Rechte zu gewähren als registrierten Benutzern macht keinen Sinn. Überprüfe Deine Einstellungen!';
$lang_plugin_annotate['prune_database'] = 'Wollen Sie alle Beschriftungen aus der Datenbank löschen?';
$lang_plugin_annotate['announcement_thread'] = 'Ankündigungs-Thema für %s-Plugin';
$lang_plugin_annotate['delete_orphaned_entries'] = 'Verwaiste Beschriftungen löschen';
$lang_plugin_annotate['x_orphaned_entries_deleted'] = '%s verwaiste Einträge wurden gelöscht';
$lang_plugin_annotate['1_orphaned_entry_deleted'] = '1 verwaister Eintrag wurde gelöscht';
$lang_plugin_annotate['save'] = 'Speichern';
$lang_plugin_annotate['cancel'] = 'Abbrechen';
$lang_plugin_annotate['error_saving_note'] = 'Fehler beim Speichern'; // JS-alert
$lang_plugin_annotate['onsave_not_implemented'] = 'onsave muss implementiert sein, damit man tatsächlich etwas speichern kann'; // JS-alert
$lang_plugin_annotate['permissions'] = 'Berechtigungen';
$lang_plugin_annotate['group'] = 'Gruppe';
$lang_plugin_annotate['guests'] = 'Gäste';
$lang_plugin_annotate['registered_users'] = 'Registrierte Benutzer';
$lang_plugin_annotate['administrators'] = 'Administratoren';
$lang_plugin_annotate['read_annotations'] = 'Beschriftungen lesen';
$lang_plugin_annotate['read_write_annotations'] = 'Beschriftungen lesen und schreiben';
$lang_plugin_annotate['read_write_delete_annotations'] = 'Beschriftungen lesen, schreiben und löschen';
$lang_plugin_annotate['no_access'] = 'kein Zugriff';
$lang_plugin_annotate['lastnotes'] = 'zuletzt beschriftete Bilder';
$lang_plugin_annotate['shownotes'] = 'Bilder mit';
$lang_plugin_annotate['x_annotations_for_file'] = 'Es sind %s Beschriftungen für diese Datei vorhanden.';
$lang_plugin_annotate['1_annotation_for_file'] = 'Es ist eine Beschriftungen für diese Datei vorhanden.';
$lang_plugin_annotate['registration_promotion'] = 'Du musst angemeldet sein, um Beschriftungen anzusehen. %sMelde Dich an%s wenn Du schon ein Benutzerkonto hast oder %sregistriere%s Dich kostenlos.'; // Do not translate the %s placeholders
$lang_plugin_annotate['update_database'] = 'Datenbank aktualisieren';
$lang_plugin_annotate['update_database_success'] = 'Datenbank erfolgreich aktualisiert';
$lang_plugin_annotate['on_this_pic'] = 'Auf diesem Bild';
$lang_plugin_annotate['all_pics_of'] = 'Zeige alle Bilder mit';
$lang_plugin_annotate['rapid_annotation'] = 'Schnellbeschriftung';
$lang_plugin_annotate['annotation_type'] = 'Beschriftungsart';
$lang_plugin_annotate['free_text'] = 'Freitext';
$lang_plugin_annotate['drop_down_existing_annotations'] = 'Liste bereits bestehender Beschriftungen';
$lang_plugin_annotate['drop_down_registered_users'] = 'Liste der registrierten Benutzer';
$lang_plugin_annotate['display_notes'] = 'Zeige Buttons über dem Bild';
$lang_plugin_annotate['display_notes_title'] = 'Zeige Buttons von bereits erstellten Beschriftungen im jeweiligen Album (zur leichteren/schnelleren Beschriftung)';
$lang_plugin_annotate['display_links'] = 'Zeige Links unter dem Bild';
$lang_plugin_annotate['display_links_title'] = 'Wenn man auf diese Links klickt, wird ein Meta-Album mit allen Bildern der jeweiligen Beschriftung angezeigt';
?>