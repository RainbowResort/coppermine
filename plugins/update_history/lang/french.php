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
Modified By Frantz for update history plugin
**********************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }
// info about translators and translated language
$lang_translation_info['lang_name_english'] = 'French_FR';
$lang_translation_info['lang_name_native'] = 'Français';
$lang_translation_info['lang_country_code'] = 'fr';
$lang_translation_info['trans_name'] = 'François Keller & FBleu';
$lang_translation_info['trans_email'] = 'francois.cpgtest@free.fr';
$lang_translation_info['trans_website'] = 'http://coppermine-gallery.net/forum/index.php?board=38.0';
$lang_translation_info['trans_date'] = '2010-11-27';


$lang_charset = 'utf-8';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)
//variables de langue
$lang_plugin_update_history = array(
  'configure'	=>'Apr&egrave;s installation, Ajoutez <strong>updatehistory</strong> dans le contenu de:<br />config => Affichage de la liste des albums => Le contenu de la page principale',
  'update'	=>'Mises &agrave; Jour r&eacute;centes',
  'new'		=>' nouveau fichier ajout&eacute; &agrave; l\'album ',
  'news'	=>' nouveaux fichiers ajout&eacute;s &agrave; l\'album ',
  'by'		=>' par ',
  'archive'	=>'Archives',
  'admin'	=>'Configuration du plugin',
  'plugin_name'	=>'Update History',
  'day_nb'	=>'Nombre &agrave; prendre en compte dans l\'historique: ',
  'submit'	=>'Envoyer',
  'history'  	=>'Historique des ',
  'last_days'	=>' derniers jours',
  'add'		=>' ajout&eacute; dans l\'album ',
  'archive_title'=>'Archives des derniers t&eacute;l&eacute;chargements',
  'archive_setup'=>'Param&eacute;trage de la recherche:',
);
//Format de la date
$plugin_update_history_date_fmt = '%d %B %Y';
$lang_plugin_update_history_config = array(
'button_install'	=> 'Installation',
'install_click'		=> 'Cliquez sur le bouton pour installer le plugin.',
'install_note'		=> 'Utilisez le bouton <b>"administration"</b> du bloc du plugin pour la configuration.',
'display_block'		=> 'Apr&egrave;s l\'installation, ajoutez <b>updatehistory</b> dans la liste du param&egrave;tre <i><b>Le contenu de la page principale</b></i> de l\'onglet <b>Affichage de la liste des albums</b> de la page de configuration.',
'cleanup_question' 	=> 'Supprimer la table utilis&eacute;e pour le stockage du param&eacute;trage ?',
'yes'			=> 'Oui',
'no'			=> 'Non',
'button_submit' 	=> 'Envoyer',
'button_cancel' 	=> 'Annuler',
);
$lang_plugin_update_history_admin = array(
'title'			=> 'Groupe &agrave; param&eacute;trer',
'group_name'		=> 'Groupe d\'utilisateurs',
'param'			=> 'Param&eacute;trage du plugin pour le groupe ',
'text'			=> 'Modifiez le param&eacute;trage pour ce groupe puis cliques sur le bouton "Sauvegarder"',
'bloc'			=> 'Afficher le bloc: ',
'archive'		=> 'Afficher le bouton "Archives": ',
'uploader'		=> 'Afficher le nom de la personne qui a t&eacute;l&eacute;charg&eacute; le fichier: ',
'days_last'		=> 'Param&egrave;tre &agrave; prendre en compte pour l\'historique: ',
'days'			=> 'Derniers Jours',
'last'			=> 'Derniers Fichiers',
'save'			=> 'Sauvegarder',
'nb'			=> 'Nombre pris en compte pour l\'historique en fonction du param&eacute;trage pr&eacute;c&eacute;dent',
'succes'		=> 'La nouvelle configuration du Plugin est sauvegard&eacute;e',
'uploaded_files'	=> ' derniers fichiers t&eacute;l&eacute;charg&eacute;s:',
);
?>
