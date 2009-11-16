<?php
/**************************************************
  Coppermine 1.4.x Plugin - EnlargeIt! $VERSION$=0.4
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
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
  ***************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }
//language variables
$lang_enlargeit = array(
'display_name' => 'EnlargeIt! PlugIn',
'update_success' => 'Valori aggiornati correttamente',
'main_title' => 'EnlargeIt! PlugIn',
'version' => 'v0.4',
'pluginmanager' => 'Plugin Manager',
'enl_yes' => 'si',
'enl_no' => 'no',
'submit_button' => 'Invia',
'enl_pictype' => 'Allarga immagini come',
'enl_normalsize' => 'dimensione intermedia',
'enl_fullsize' => 'dimensione originale',
'enl_forcenormal' => 'forza dimensione intermedia',
'enl_ani' => 'Animazione',
'noani' => 'nessuna',
'fade' => 'scompasa',
'glide' => 'glide',
'bumpglide' => 'bump glide',
'smoothglide' => 'smooth glide',
'expglide' => 'hard glide',
'topglide' => 'glide from top',
'leftglide' => 'glide from left',
'topleftglide' => 'glide from top left',
'enl_speed' => 'Durata animazione',
'enl_maxstep' => 'Passaggi animazione',
'enl_brd' => 'Usa cornice',
'enl_brdsize' => 'Larghezza cornice',
'enl_brdbck' => 'Border texture',
'enl_brdcolor' => 'Colore cornice',
'enl_brdround' => 'Arrotonda cornice (solo per Mozilla/Safari)',
'enl_shadow' => 'Usa ombra della cornice',
'enl_shadowsize' => 'Dimensione ombra destra/sotto',
'enl_shadowintens' => 'Opacità ombra',
'enl_titlebar' => 'Mostra barra del titolo quando nessun bottone è attivo',
'enl_titletxtcol' => 'Colore testo barra del titolo',
'enl_ajaxcolor' => 'Colore sfondo area AJAX',
'enl_center' => 'Centra immagine allargata',
'enl_dark' => 'Oscura schermo quando allargato (solo 1 immagine alla volta)',
'enl_darkprct' => 'Tasso oscuramento',
'enl_buttonpic' => 'Mostra bottone \'Mostra bottone\'',
'enl_tooltippic' => 'Mostra immagine',
'enl_buttoninfo' => 'Mostra bottone \'Info\'',
'enl_buttondownload' => 'Show button \'Download\'',
'enl_tooltipdownload' => 'Download this file',
'enl_clickdownload' => 'Click here to download this file',
'enl_buttoninfoyes1' => 'yes (open AJAX snippet)',
'enl_buttoninfoyes2' => 'yes (open intermediate page)',
'enl_tooltipinfo' => 'Mostra info',
'enl_buttonfav' => 'Mostra bottone \'Preferiti\'',
'enl_tooltipfav' => 'Preferiti',
'enl_buttoncomment' => 'Mostra bottone \'Commenti\'',
'enl_tooltipcomment' => 'Commenta',
'enl_buttonhist' => 'Mostra bottone \'Istogramma\'',
'enl_tooltiphist' => 'Istogramma',
'enl_buttonvote' => 'Mostra bottone \'Vota\'',
'enl_tooltipvote' => 'Vota',
'enl_buttonmax' => 'Mostra bottone \'Massimizza\'',
'enl_tooltipmax' => 'Dimensione originale',
'enl_maxforreg' => 'si, ma non per utenti anonimi',
'enl_maxpopup' => 'yes, as pop-up window',
'enl_maxpopupforreg' => 'yes, as pop-up but not for anonymous users',
'enl_buttonclose' => 'Mostra bottone \'Chiudi\'',
'enl_tooltipclose' => 'Chiusi',
'enl_buttonnav' => 'Mostra bottone \'Navigazione\'',
'enl_tooltipprev' => 'Precedente',
'enl_tooltipnext' => 'Successiva',
'enl_adminmode' => 'Usa EnlargeIt! in modo admin',
'enl_registeredmode' => 'Usa EnlargeIt! per utenti registrati',
'enl_guestmode' => 'Usa EnlargeIt! per utenti anonimi',
'enl_sefmode' => 'Usa supporto SEF',
'enl_addedtofav' => 'Questa immagine è stata aggiunta ai tuoi preferiti.',
'enl_removedfromfav' => 'Questa immagine è stata rimossa dai tuoi preferiti.',
'enl_showfav' => 'Mostra preferiti',
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