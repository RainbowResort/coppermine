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
  'display_name'  => 'Keywords add', // Display Name
  'config_title'  => 'Verwendung von Keywords add', // Title of the button on the gallery config menu
  'config_button' => 'Keywords add', // Label of the button on the gallery config menu
  'install_note'  => 'Um das Plugin zu verwenden nutze den Button in der Admin Toolbar.', // Note about configuring plugin
  'install_click' => 'Klicke den Button um das PlugIn zu installieren.', // Message to install plugin
  'album_name'    => 'Wähle das Album aus, in welches Du die Stichworte hinzufügen willst',
  'add_info'      => 'Stichworte hinzufügen',
  'keyword'       => 'Stichworte',
  'caution'       => 'Vorsicht: Bei Titel, Beschreibung und benutzerdefinierten Feldern werden Informationen, welche bereits eingegeben wurden, <br> 
  durch die hier eingegebenen neuen Informationen ersetzt.<br>
  Diese Felder deshalb frei lassen, um den bestehenden Inhalt zu erhalten.',
  'title'         => 'Titel',
  'description'   => 'Beschreibung',
);

$lang_plugin_keywords_add_config = array(
  'status'        => 'Status des Plugins',
  'button_install'=> 'Installation',
  'button_submit' => 'Absenden',
);

// Delete
$lang_plugin_keywords_add_delete= array(
  'success'       => 'Die Verwendung von Keywords add war erfolgreich',
 );
?>