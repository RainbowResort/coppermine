<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2005 Coppermine Dev Team
  v1.1 originaly written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.4.8
  $Source: /cvsroot/cpg-contrib/master_template/codebase.php,v $
  $Revision: 1.3 $
  $Author: donnoman $
  $Date: 2005/12/08 05:46:49 $
**********************************************/
/**********************************************
Modified By Frantz for update_history plugin
**********************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }
//language variables
$lang_plugin_update_history = array(
  'configure'	=>'Nach der Installation musst Du <strong>updatehistory</strong> zu den Werten von :<br />Einstellungen => Ansicht Albenliste => Inhalt der Hauptseite hinzuf&uuml;gen',
  'update'	=>'Letzte Updates',
  'new'		=>' Neue Datei hinzugef&uuml;gt zum Album ',
  'news'	=>' Neue Dateien hinzugef&uuml;gt zum Album ',
  'by'		=>' von ',
  'archive'	=>'Archiv',
  'admin'	=>'PlugIn Einstellungen',
  'plugin_name'	=>'Update History',
  'day_nb'	=>'Zu berechnende Anzahl f&uuml;r die Historie: ',
  'submit'	=>'Ausw&auml;hlen',
  'history'  	=>'Historie f&uuml;r die ',
  'last_days'	=>' letzten Tage',
  'add'		=>' hinzugef&uuml;gt zum Album ',
  'archive_title'=>'Letzte Uploads Archiv ',
  'archive_setup'=>'Sucheinstellungen:',
);
//Date format 
$plugin_update_history_date_fmt = '%d %B %Y ';
$lang_plugin_update_history_config = array(
'button_install'	=> 'Installation',
'install_click'		=> 'Klicke den Button um das PlugIn zu installieren.',
'install_note'		=> 'Zum Einstellen des PlugIns verwende den <b>"PlugIn Einstellungen"</b> Button im PlugIn-Block.',
'display_block'		=> 'Nach der Installation musst Du <strong>updatehistory</strong> zu den Werten von :<br />Einstellungen => Ansicht Albenliste => Inhalt der Hauptseite hinzuf&uuml;gen',
'cleanup_question' 	=> 'Entferne die Tabelle welche die Einstellungen enth&auml;lt?',
'yes'			=> 'Ja',
'no'			=> 'Nein',
'button_submit' 	=> 'Abschicken',
'button_cancel' 	=> 'Abbrechen',
);
$lang_plugin_update_history_admin = array(
'title'			=> 'Gruppenauswahl',
'group_name'		=> 'Nutzergruppe',
'param'			=> 'PlugIn-Einstellungen f&uuml;r die Gruppe ',
'text'			=> '&Auml;ndere die Einstellungen f&uuml;r diese Gruppe und klicke auf den "Sichern" Button ',
'bloc'			=> 'Zeige den PlugIn-Block an: ',
'archive'		=> 'Zeige den "Archiv" Button an: ',
'uploader'		=> 'Zeige den Namen des Uploaders: ',
'days_last'		=> 'Was soll im Historie-Bericht erscheinen: ',
'days'			=> 'die letzten Tage',
'last'			=> 'die letzten Dateien',
'save'			=> 'Sichern',
'nb'			=> 'Anzahl der Tage oder Dateien - je nach vorheriger Auswahl',
'succes'		=> 'Die neuen PlugIn-Einstellungen wurden gesichert!',
'uploaded_files'	=> ' zuletzt hochgeladenen Dateien:',
);
?>