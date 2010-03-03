<?php
/**************************************************
  Coppermine 1.4.x Plugin - Copper ad
  *************************************************
  Copyright (c) 2006 Borzoo Mossavari
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  This is a simple Advertisement plugin without statistics
  or any kind of log.
  this will give you flash/picture/HTML banner
  By using FRAME technology
  
  French Translation by PYAP
  ***************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

$lang_plugin_copperad = array(
  'display_name'  => 'Copper-Ad',		// Display Name
  'config_title'  => 'Configurez Copper-Ad',	// Title of the button on the gallery config menu
  'config_button' => 'Copper-Ad',		// Label of the button on the gallery config menu
  'page_success'  => 'La Configuration de Copper-Ad OK.', // Page success message
  'page_failure'  => 'La nouvelle Configuration de Copper-Ad a &eacute;chou&eacute;.', // Page failure message
  'install_note'  => 'Configurez le plugin &agrave; partir du bouton Copper-Ad de votre menu Administrateur.', // Note about configuring plugin
  'install_click' => 'Cliquez ce bouton pour Installer le Plugin Copper-Ad.', // Message to install plugin
  'create_success'=> 'Votre banni&egrave;re est cr&eacute;&eacute;e avec succ&egrave;s !', // Create success message
  'version'       => 'Ver 1.2.4<font size=1><em>Stable</em></font>' // CPA 1.2.2

);

$lang_plugin_copperad_config = array(
  'status'        => 'Status du Plugin',
  'max_show'      => 'Combien de fois voulez-vous que cette banni&egrave;re apparaisse ?',
  'button_install'=> 'Installez',
  'button_submit' => 'Soumettez',
  'button_cancel' => 'Annulez',
  'button_done'   => 'Effectu&eacute;',
  'cleanup_question' => 'Voulez-vous supprimer la Table qui &eacute;tait utilis&eacute;e pour stocker vos param&egrave;tres ?',
  'text_title'    => 'Entrez le titre visible sous la banni&egrave;re (laissez vide pour aucun titre)',
  'text_title_des'=> '<font size="1" color="red">Pas de balise HTML</font>',
  'admin_show'    => 'Voulez-vous faire apparaitre la banni&egrave;re durant le Mode Admin ?',
  'banner_bg'     => 'Entrez la couleur de l\'arri&egrave;re plan de votre banni&egrave;re',
  'expand_all'    => 'D&eacute;pliez tout',
  'permission'    => 'Ajustez le CHMOD de votre Galerie sur la valeur 777 (seulement la racine de votre Galerie, pas les dossiers ni les fichiers contenus)', // CPA 1.2.2
);
// Banner Management
$lang_plugin_copperad_manage= array(
	'display_name'=> 'Param&egrave;tres Banni&egrave;re',
	'list_name'   => 'Nom',
	'list_delete' => 'Supprimez',
	'list_edit'   => '&Eacute;ditez',
	'list_kind'   => 'Type de votre Annonce.',
	'list_address'=> 'URL Image  (expl : adv/pic/adv1.gif ou adv/flash/adv1.swf)',
	'list_linkto' => 'Liez vers ce web (entrez URL : expl www.site.comhere)',
	'list_height' => 'Hauteur (entrez la hauteur en px) <em><font color="#FF0000">Max 100 px</font> </em>',
	'list_width'  => 'Largeur (Entrez la largeur en px) <em><font color="#FF0000">Max 780 px</font></em>',
	'list_alt'    => 'Entrez un texte Alternative (texte affich&eacute; lorsque le visiteur &agrave; invalider les affichages images)',
	'list_html'   => 'HTML',
	'list_html_des' => 'Toutes les balises HTML sont acceptables m&ecirc;me <em>iframe</em>, <font color="#FF0000">mais &agrave; utiliser avec prudence</font>',
	'list_pic'    => '<font color="red">Seulement pour les images.</font>',
	'list_submit' => 'Sauvez la nouvelle configuration.',
	'list_restore'=> 'Restaurez les param&egrave;tres par d&eacute;fauts.',
	'list_status' => 'Status Banni&egrave;re', // CPA 1.2.2
	'list_banner' => 'Liste des Banni&egrave;res', // CPA 1.2.2
	'list_conf'   => 'Configuration', // CPA 1.2.2
	'list_stat'   => 'Enable', // CPA 1.2.2
	'list_chstat' => 'Changez les Status', // CPA 1.2.2
	'list_chkall' => 'Cochez tout', // CPA 1.2.2
);
// Delete
$lang_plugin_copperad_delete= array(
  'display_name'  => 'Supprimez la banni&egrave;re',
  'nothing_do'    => 'Vous ne pouvez rien faire !!!',
  'cant_delete'   => 'Il y a une seule banni&egrave;re dans votre Base de Donn&eacute;es, elle ne peut pas &ecirc;tre supprim&eacute;e !!!',
  'delete_okey'   => 'Banni&egrave;re supprim&eacute;e avec succ&egrave;s.',
 );

?>