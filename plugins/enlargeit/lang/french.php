<?php
/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt! $VERSION$=0.4
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.2
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/
/*   Translation in French by PYAP : pyap @ coppermine-gallery.net
     French Coppermine board at  : http://coppermine-gallery.net/forum/index.php?board=38.0
*/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }
//language variables
$lang_enlargeit = array(
'display_name' => 'EnlargeIt! PlugIn',
'update_success' => 'Valeurs sauvegard&eacute;es correctement',
'main_title' => 'EnlargeIt! PlugIn',
'version' => 'v0.4',
'pluginmanager' => 'Plugin Manager',
'enl_yes' => 'Oui',
'enl_no' => 'Non',
'submit_button' => 'Soumettre vos valeurs',
'enl_pictype' => 'Elargissez l\'image',
'enl_normalsize' => 'Taille interm&eacute;diaire',
'enl_fullsize' => 'Taille MAX',
'enl_forcenormal' => 'Forcez la taille interm&eacute;diaire',
'enl_ani' => 'Animation',
'noani' => 'aucune',
'fade' => 'fondu in<>out',
'glide' => 'glide',
'bumpglide' => 'bump glide',
'smoothglide' => 'smooth glide',
'expglide' => 'hard glide',
'topglide' => 'glide from top',
'leftglide' => 'glide from left',
'topleftglide' => 'glide from top left',
'enl_speed' => 'Espace temps pour l\'animation',
'enl_maxstep' => 'Nbr Etapes pour l\'animation',
'enl_brd' => 'Utilisez une Bordure',
'enl_brdsize' => 'Epaisseur de la Bordure',
'enl_brdbck' => 'Border texture',
'enl_brdcolor' => 'Couleur de la Bordure',
'enl_brdround' => 'Bordure arrondie (Mozilla et Safari seulement)',
'enl_shadow' => 'Utilisez un ombrage sur les Bords',
'enl_shadowsize' => 'Taille de l\'ombrage (&agrave; droite et en bas)',
'enl_shadowintens' => 'Opacit&eacute; de l\'ombre',
'enl_titlebar' => 'Affichez le Titre lorsque aucun bouton n\'est actif',
'enl_titletxtcol' => 'Couleur du texte de la barre de titre',
'enl_ajaxcolor' => 'Couleur arri&egrave;re plan de la zone AJAX',
'enl_center' => 'Centrez l\'image',
'enl_dark' => 'Assombrir l\'&eacute;cran quand les images sont &eacute;largies (seulement une image &agrave; la fois)',
'enl_darkprct' => 'Forcez l\'assombrissement de l\'&eacute;cran',
'enl_buttonpic' => 'Affichez le bouton \'Affichez l\'image\'',
'enl_tooltippic' => 'Affichez l´image',
'enl_buttoninfo' => 'Affichez le bouton \'Info\'',
'enl_buttoninfoyes1' => 'yes (open AJAX snippet)',
'enl_buttoninfoyes2' => 'yes (open intermediate page)',
'enl_tooltipinfo' => 'Affichez info',
'enl_buttonfav' => 'Affichez le bouton \'Favoris\'',
'enl_tooltipfav' => 'Favoris',
'enl_buttoncomment' => 'Affichez le bouton \'Commentaires\'',
'enl_tooltipcomment' => 'Commentaires',
'enl_buttonhist' => 'Affichez le bouton \'Histogramme\'',
'enl_tooltiphist' => 'Histogramme',
'enl_buttonvote' => 'Affichez le bouton \'Vote\'',
'enl_tooltipvote' => 'Vote',
'enl_buttonmax' => 'Affichez le bouton \'Maximisez\'',
'enl_tooltipmax' => 'Maximizez',
'enl_buttonclose' => 'Affichez le bouton \'Fermez\'',
'enl_tooltipclose' => 'Fermez',
'enl_buttondownload' => 'Show button \'Download\'',
'enl_tooltipdownload' => 'Download this file',
'enl_clickdownload' => 'Click here to download this file',
'enl_buttonnav' => 'Affichez le bouton \'Navigation\'',
'enl_tooltipprev' => 'Image Pr&eacute;c&eacute;dente',
'enl_tooltipnext' => 'Image Suivante',
'enl_adminmode' => 'Autorisez EnlargeIt! en Mode Admin',
'enl_registeredmode' => 'Autorisez EnlargeIt! pour les Utilisateurs enregistr&eacute;s',
'enl_guestmode' => 'Autorisez EnlargeIt! pour les Visiteurs (guests)',
'enl_sefmode' => 'Autorisez le support SEF',
'enl_addedtofav' => 'Image ajout&eacute;e aux Favoris.',
'enl_removedfromfav' => 'Image supprim&eacute;e de vos Favoris.',
'enl_showfav' => 'Affichez Mes Favoris',
'enl_maxforreg' => 'yes, but not for anonymous users',
'enl_maxpopup' => 'yes, as pop-up window',
'enl_maxpopupforreg' => 'yes, as pop-up but not for anonymous users',
'enl_dragdrop' => 'Drag & Drop of enlarged pictures',
'enl_darkensteps' => 'Steps for darkening (1 = immediately)',
'enl_cantcomment' => 'There are no comments yet, and you are not allowed to add one!',
'enl_wheelnav' => 'Mouse wheel navigation',
'enl_canceltext' => 'Click to cancel loading of this picture',
'enl_noflashfound' => 'To watch this file, you need the browser plugin Adobe Flash Player!',
'enl_flvplayer' => 'Use which FLV player software',
'enl_buttonbbcode' => 'Show button \'BBCode\'',
'enl_tooltipbbcode' => 'BBCode',
'enl_copytoclipbrd' => 'Copy to clipboard',
'enl_opaglide' => 'Transparency effect for glide animation',
);
?>