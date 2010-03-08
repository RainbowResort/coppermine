﻿<?php
/**************************************************
  Coppermine 1.5.x Plugin - final_extract
  *************************************************
  Copyright (c) 2009 Donnovan Bray
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

$lang_plugin_final_extract = array(
  'display_name'  => 'Final Extract',			// Display Name
  'config_title'  => 'Configuration de Final Extract',			// Title of the button on the gallery config menu
  'config_button' => 'Final Extract',				// Label of the button on the gallery config menu
  'page_success'  => 'Parametres de Configuration mis à jour.',		// Page success message
  'page_failure'  => 'Impossible de mettre à jour les parametres.',		// Page failure message
  'install_note'  => 'Utilisez le bouton du menu Administrateur pour configurer le plugin.',	// Note about configuring plugin
  'install_click' => 'Cliquez sur le bouton pour installer le plugin.',	// Message to install plugin
  'group_name'      => 'Selectionnez le groupe d\'utilisateur',
  'home_block'      => 'Accueil',
  'login_block'     => 's\'identifier',
  'my_galery_block' =>'Ma Galerie',
  'upload_pic_block'=>'Uploader une image',
  'album_list_block'=>'Albums',
  'lastup_block'    =>'Derniers Ajouts',
  'lastcom_block'   =>'Derniers Commentaires',
  'topn_block'      =>'Les plus Populaires',
  'toprated_block'  =>'Le mieux Notées',
  'favpics_block'   =>'Mes Favoris',
  'search_block'    =>'Rechercher',
  'my_profile_block'=>'Mon Profil',
);

$lang_plugin_final_extract_config = array(
  'status'        => 'Status du Plugin',
  'button_install'=> 'Installation',
  'button_submit' => 'Envoyer',
  'button_cancel' => 'Annuler',
  'button_done'   => 'Fait',
  'cleanup_question' => 'Supprimer la table utiliséepour le stockage du paramétrage ?',
  'expand_all'    => 'Tout Afficher',
);
// Banner Management
$lang_plugin_final_extract_manage= array(
	'list_name'   => 'Nom',
	'list_submit' => 'Sauvegarder la nouvelle configuration',
	'list_restore'=> 'Restorer les parametres par défaut',
	'list_stat'   => 'Effacer', 
	'list_chstat' => 'Sauvegarder les changements',
	'list_chkall' => 'Sélectionner tout', // CPA 1.2.2
	'list_unchkall' => 'Sélectionner rien',
	'list_check'  => 'Sélection',
);
// Delete
$lang_plugin_final_extract_delete= array(
  'nothing_do'    => 'Vous ne pouvez rien faire!',
  'nothing_changed' => 'Tous les blocs sont actif ...',
  'success'       => 'Final Extract est configuré correctement',
 );
?>