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
/**********************************************
German translation by AlexL
**********************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

$lang_plugin_keywords_add = array(
  'display_name'  => 'Keywords add',			// Display Name
  'config_title'  => 'Verwendung von Keywords add',			// Title of the button on the gallery config menu
  'config_button' => 'Keywords add',				// Label of the button on the gallery config menu
  'install_note'  => 'Um das Plugin zu verwenden nutze den Button in der Admin Toolbar.',	// Note about configuring plugin
  'install_click' => 'Klicke den Button um das PlugIn zu installieren.',	// Message to install plugin
  'version'       => 'Ver 1.1',
  'album_name'    => 'W&auml;hle das Album aus, in welches Du die Stichworte hinzuf&uuml;gen willst',
  'add_info'      => 'Stichworte hinzuf&uuml;gen',
  'keyword'	  => 'Stichworte',
  'caution'       => 'Vorsicht: Bei Titel, Beschreibung und benutzerdefinierten Feldern werden Informationen, welche bereits eingegeben wurden, <br> 
  durch die hier eingegebenen neuen Informationen ersetzt.<br>
  Diese Felder deshalb frei lassen, um den bestehenden Inhalt zu erhalten.',
  'title'	    => 'Titel',
  'description'      => 'Beschreibung',
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