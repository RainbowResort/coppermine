<?php
/**************************************************
  Coppermine 1.5.x Plugin - keywords_add
  *************************************************
  Copyright (c) coppermine dev team
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

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

$lang_plugin_keywords_add = array(
  'display_name'    => 'Zoekbegrippen',			// Display Name
  'config_title'    => 'Configureer Zoekbegrippen',			// Title of the button on the gallery config menu
  'config_button'   => 'Zoekbegrippen toevoegen',				// Label of the button on the gallery config menu
  'install_note'    => 'Configureer de plugin via het Admin menu.',	// Note about configuring plugin
  'install_click'   => 'Click op de knop om de plugin te installeren.',	// Message to install plugin
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