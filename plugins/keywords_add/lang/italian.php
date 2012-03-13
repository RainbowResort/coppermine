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
  'display_name'  => 'Keywords add',			// Display Name
  'config_title'  => 'Configurazione Keywords add',			// Title of the button on the gallery config menu
  'config_button' => 'Keywords add',				// Label of the button on the gallery config menu
  'install_note'  => 'Utilizzare il bottone dal menu amministratore per configurare il plugin.',	// Note about configuring plugin
  'install_click' => 'Cliccare sul le bottone per installare il plugin.',	// Message to install plugin
  'album_name'    => 'Selezionare l\'album nel quale aggiungere le informazioni',
  'add_info'      => 'Informazioni da aggiungere',
  'keyword'       => 'Parole Chiave',
  'caution'       => 'Attenzione: le informazioni già presenti nei campi extra saranno rimpiazzate dalle nuove.<br>Lasciare i campi vuoti per non modificare il contenuto esistente.',
);

$lang_plugin_keywords_add_config = array(
  'status'        => 'Stato del Plugin',
  'button_install'=> 'Installazione',
  'button_submit' => 'Inviare',
);

// Delete
$lang_plugin_keywords_add_delete= array(
  'success'       => 'Informazioni aggiunte',
);
?>