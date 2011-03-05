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
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/keywords_add/lang/english.php $
  $Revision: 7125 $
  $LastChangedBy: gaugau $
  $Date: 2010-01-25 18:03:41 +0100 (Mo, 25 Jan 2010) $
  **************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

$lang_plugin_keywords_add = array(
  'display_name'    => 'Keywords Add',			// Display Name
  'config_title'    => 'Konfigurer Keywords Add',			// Title of the button on the gallery config menu
  'config_button'   => 'Keywords Add',				// Label of the button on the gallery config menu
  'install_note'    => 'Konfigurer plugin fra knappen på Admin værktøjslinien.',	// Note about configuring plugin
  'install_click'   => 'Klik på knap, for at installerer plugin.',	// Message to install plugin
  'version'         => 'V1.2', // Curent plugin version
  'album_name'      => 'Vælg albumet hvor du vil tilføje information',
  'add_info'        => 'Information to be added',
  'keyword'	    => 'Nøgleord',
  'caution'         => 'Bemærk: Information som allerede er blevet tilføjet titlen, beskrivelse and brugerfelter vil blive erstattet af de nye.<br>Lad stå tom for at bevarer indhold.',
  'title'	    => 'Titel',
  'description'      => 'Beskrivelse',
);

$lang_plugin_keywords_add_config = array(
  'status'        => 'Status af Plugin',
  'button_install'=> 'Installer',
  'button_submit' => 'Send',
);

// Delete
$lang_plugin_keywords_add_delete= array(
  'success'       => 'Keywords Add konfugurering successfuld',
 );
?>