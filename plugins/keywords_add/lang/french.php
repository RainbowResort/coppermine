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
French translation by Frantz
**********************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

$lang_plugin_keywords_add = array(
  'display_name'  => 'Keywords add',			// Display Name
  'config_title'  => 'Configuration de Keywords add',			// Title of the button on the gallery config menu
  'config_button' => 'Keywords add',				// Label of the button on the gallery config menu
  'install_note'  => 'Utilisez le bouton du menu Administrateur pour configurer le plugin.',	// Note about configuring plugin
  'install_click' => 'Cliquez sur le bouton pour installer le plugin.',	// Message to install plugin
  'version'       => 'Ver 1.0',
  'album_name'    => 'Sélectionnez l\'album dans lequel vous voulez ajoutez des informations',
  'add_info'      => 'Informations à ajouter',
  'keyword'	  => 'Mots Clés',
  'caution'       => 'Attention: Les informations qui étaient déjà entrées dans les champs utilisateurs, les titres et les descriptions seront remplacées par les nouvelles.<br>Laissez les champs vides pour ne pas modifier le contenu existant.',
  'title'	  => 'Titre de la photo',
  'description'	  => 'Description de la photo',
);

$lang_plugin_keywords_add_config = array(
  'status'        => 'Status du Plugin',
  'button_install'=> 'Installation',
  'button_submit' => 'Envoyer',
);

// Delete
$lang_plugin_keywords_add_delete= array(
  'success'       => 'Les informations ont été ajoutées',
 );
?>