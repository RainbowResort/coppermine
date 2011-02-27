<?php
/**************************************************
  Coppermine 1.5.x Plugin - FileMove
  *************************************************
  Copyright (c) 2003-2010 Coppermine Dev Team
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

if (!defined('IN_COPPERMINE')) { 
	die('Not in Coppermine...'); 
}
$lang_plugin_FileMove['display_name'] = 'FileMove (Déplacement de Fichiers)';        // Nom d'affichage
$lang_plugin_FileMove['description'] = 'Choisissez les fichiers ou un dossier à déplacer et modifier la base de données';
$lang_plugin_FileMove['author'] = 'Crée par <a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=9980" rel="external" class="external">Frantz</a> ';
$lang_plugin_FileMove['ported'] = 'Porté sur cpg1.5.x par <a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=9980" rel="external" class="external">eenemeenemuu</a>';
$lang_plugin_FileMove['config_title'] = 'Configuration de FileMove';        // Titre du bouton du menu de configuration dans la galerie
$lang_plugin_FileMove['config_button'] = 'FileMove';        // Label du bouton du menu de configuration dans la galerie
$lang_plugin_FileMove['install_note'] = 'Utilisez le bouton du menu Administrateur pour configurer le plugin.';        // Note sur la configuration de plugin
$lang_plugin_FileMove['install_click'] = 'Cliquez sur le bouton pour installer le plugin.';        // Message d'installation du plugin
$lang_plugin_FileMove['version'] = '1.1';
$lang_plugin_FileMove['folder_name'] = 'Sélectionnez le répertoire à déplacer';
$lang_plugin_FileMove['folder_ar'] = 'Sélectionnez le répertoire de destination';
$lang_plugin_FileMove['some_files'] = 'Déplacer CERTAINS fichier';
$lang_plugin_FileMove['choix'] = 'Choix de l\'opération';
$lang_plugin_FileMove['choix2'] = 'Choisissez ce que vous souhaitez faire';
$lang_plugin_FileMove['confirm'] = 'Confirmation de vos choix';
$lang_plugin_FileMove['confirm_titre'] = '<b>Vous avez sélectionné les répertoires suivants:</b>';
$lang_plugin_FileMove['confirm_files'] = '<b>Vous avez sélectionné les fichiers suivants:</b>';
$lang_plugin_FileMove['folder'] = 'Déplacer TOUT le répertoire';
$lang_plugin_FileMove['DFolder'] = 'Répertoire de Départ: ';
$lang_plugin_FileMove['AFolder'] = 'Répertoire de Destination: ';
$lang_plugin_FileMove['to'] = 'vers le ';
$lang_plugin_FileMove['error'] = 'ERREUR!';
$lang_plugin_FileMove['file'] = 'Fichier';
$lang_plugin_FileMove['files'] = 'Fichiers';
$lang_plugin_FileMove['valid'] = 'Valider';
$lang_plugin_FileMove['continue'] = 'Continuer';
$lang_plugin_FileMove['back'] = 'Retour';
$lang_plugin_FileMove['transfer'] = 'Transfert du contenu du ';
$lang_plugin_FileMove['transfer_file'] = 'Transfert de certains fichiers du ';
$lang_plugin_FileMove['folder2'] = 'répertoire ';
$lang_plugin_FileMove['folder_error'] = 'Erreur, le répertoire n\'existe pas!';
$lang_plugin_FileMove['traitement'] = ' Fichiers déplacés';
?>