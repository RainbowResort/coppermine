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
Modified by Frantz for Keywords add plugin
2006/10/08
**********************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

$lang_plugin_keywords_add = array(
  'display_name'    => 'Zoekbegrippen',			// Display Name
  'config_title'    => 'Configureer Zoekbegrippen',			// Title of the button on the gallery config menu
  'config_button'   => 'Zoekbegrippen toevoegen',				// Label of the button on the gallery config menu
  'install_note'    => 'Configureer de plugin via het Admin menu.',	// Note about configuring plugin
  'install_click'   => 'Click op de knop om de plugin te installeren.',	// Message to install plugin
  'version'         => 'Ver 1.0', // Curent plugin version
  'album_name'      => 'Selecteer het album waar informatie wilt toevoegen',
  'add_info'        => 'Informatie die toegevoegd moet worden',
  'keyword'	    => 'Zoekbegrippen',
  'caution'         => 'Waarschuwing: Informatie die al in de gebruikers velden stonden zal worden vervangen.<br>Leeg laten als je bestaande informatie niet wil wijzigen.', 
  'title'	    => 'Titel van album',
  'description'      => 'Album omschrijving',
);

$lang_plugin_keywords_add_config = array(
  'status'        => 'Status van de plugin',
  'button_install'=> 'Installeer',
  'button_submit' => 'Toevoegen',
);

// Delete
$lang_plugin_keywords_add_delete= array(
  'success'       => 'Zoekbegrippen succesvol aan foto(\'s) toegevoegd.',
 );
?>