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
  'display_name'  => 'Actief Zoeken',			// Display Name
  'config_title'  => 'Configureer Actief Zoeken',			// Title of the button on the gallery config menu
  'config_button' => 'Actief Zoeken',				// Label of the button on the gallery config menu
  'page_success'  => 'Configuratie instellingen bijgewerkt.',		// Page success message
  'page_failure'  => 'Configuratie instellingen niet gelukt.',		// Page failure message
  'install_note'  => 'Beta versie',	// Note about configuring plugin
  'install_click' => 'Klik op de knop voor installatie.',	// Message to install plugin
  'create_success'=> 'Jou banner is met succes gemaakt', // Create success message
  'version'       => 'Ver 1.0.0 <font size=1><em>Beta</em></font>',
  'search' => 'Search',
);

$lang_plugin_as_config = array(
  'status'        => 'Status van de plugin',
  'button_install'=> 'Installatie',
  'button_submit' => 'Uitvoeren',
  'button_cancel' => 'Stoppen',
  'button_done'   => 'Klaar',
  'cleanup_question' => 'Tabel verwijderen waarin de instellingen worden bewaard ?',
  'text_title_des'=> '<font size="1" color="red">Geen html gebruiken</font>',
  'expand_all'    => 'Allemaal uitklappen',
);
$lang_plugin_asmgr = array(
);

?>