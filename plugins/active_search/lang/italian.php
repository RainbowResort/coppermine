<?php
/**************************************************
  Coppermine 1.4.x Plugin - Live Search (Ajax Base)
  *************************************************
  Copyright (c) 2006 Borzoo Mossavari
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Simple Ajax search :
  - Search Title of files
  - Search Title of Albums
  
  Licence:
  Orginal Javascript and CSS : Coded by Timothy Groves,
  a designer based in Munich, Germany
  Under Creative Commons License.
  URL:
  http://www.brandspankingnew.net/specials/ajax_autosuggest/ajax_autosuggest_autocomplete.html
  
  Moded By Borzoo Mossavari (Bmossavari(at)gmail(dot)com)
  ***************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

$lang_plugin_as = array(
  'display_name'  => 'Active Search',			// Display Name
  'config_title'  => 'Configura Active Search',			// Title of the button on the gallery config menu
  'config_button' => 'Active Search',				// Label of the button on the gallery config menu
  'page_success'  => 'Parametri di configurazione aggiornati.',		// Page success message
  'page_failure'  => 'Impossibile aggiornare i parametri di configurazione.',		// Page failure message
  'install_note'  => 'Versione Beta',	// Note about configuring plugin
  'install_click' => 'Clicca qui per installare il plugin.',	// Message to install plugin
  'create_success'=> 'Banner creato perfettamente', // Create success message
  'version'       => 'Ver 1.0.0 <font size=1><em>Beta</em></font>',
  'search' => 'Cerca',
);

$lang_plugin_as_config = array(
  'status'        => 'Stato del Plugin',
  'button_install'=> 'Installa',
  'button_submit' => 'Invia',
  'button_cancel' => 'Cancella',
  'button_done'   => 'Fatto',
  'cleanup_question' => 'Rimuovi la tavola utilizzata per memorizzare i parametri di configurazione?',
  'text_title_des'=> '<font size="1" color="red">Non utilizzare tag html</font>',
  'expand_all'    => 'Espandi tutto',
);
$lang_plugin_asmgr = array(
);

?>