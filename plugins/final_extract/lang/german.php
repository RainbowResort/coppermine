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
  $Revision$
  $Author$
  $Date$
**********************************************/
/**********************************************
Modified By BMossavari 
- Add menu option to remove each part
- Add config page
**********************************************/
/**********************************************
German translation by AlexL
**********************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

$lang_plugin_final_extract = array(
  'display_name'  => 'Final Extract',			// Display Name
  'config_title'  => 'Konfiguration von Final Extract',			// Title of the button on the gallery config menu
  'config_button' => 'Final Extract',				// Label of the button on the gallery config menu
  'page_success'  => 'Die Konfiguration wurde ge&auml;ndert.',		// Page success message
  'page_failure'  => 'Unm&ouml;glich diese Einstellungen zu &auml;ndern.',		// Page failure message
  'install_note'  => 'Zum Konfigurieren des Plugins den Button in der Admintoolbar nutzen.',	// Note about configuring plugin
  'install_click' => 'Klicke den Button um das Plugin zu installieren.',	// Message to install plugin
  'group_name'      => 'Benutzergruppe w&auml;hlen',
  'home_block'      => 'Startseite',
  'login_block'     => 'Anmelden',
  'my_galery_block' => 'Meine Galerie',
  'upload_pic_block'=> 'Datei hochladen',
  'album_list_block'=> 'Albenliste',
  'lastup_block'    => 'Neueste Uploads',
  'lastcom_block'   => 'Neueste Kommentare',
  'topn_block'      => 'Am meisten angesehen',
  'toprated_block'  => 'Am besten bewertet',
  'favpics_block'   => 'Meine Favoriten',
  'search_block'    => 'Suche',
  'my_profile_block'=> 'Mein Profil',
 );

$lang_plugin_final_extract_config = array(
  'status'        => 'Plugin-Status',
  'button_install'=> 'Installation',
  'button_submit' => 'Senden',
  'button_cancel' => 'Abbrechen',
  'button_done'   => 'Erledigt',
  'cleanup_question' => 'Die Tabelle mit den Einstellungen entfernen?',
  'expand_all'    => 'Erweitere Alle',
);
// Banner Management
$lang_plugin_final_extract_manage= array(
	'list_name'   => 'Men&uuml;punkt',
//	'list_submit' => 'Konfiguration sichern',
//	'list_restore'=> 'Standard wiederherstellen',
//	'list_stat'   => 'Entfernen', 
	'list_chstat' => 'Einstellung sichern',
	'list_chkall' => 'Alles markieren',
	'list_unchkall' => 'Nichts markieren',
	'list_check'  => 'Nicht anzeigen',
);
// Delete
$lang_plugin_final_extract_delete= array(
  'nothing_do'    => 'Da ist nichts zu erledigen!',
  'nothing_changed' => 'Es wurden keine Änderungen vorgenommen.',
  'success'       => 'Final Extract Konfiguration erfolgreich für die gewählte Benutzergruppe gespeichert.',
 );
?>