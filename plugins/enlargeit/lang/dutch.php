<?php
/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt!
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

if (!defined('IN_COPPERMINE')) { 
	die('Not in Coppermine...'); 
}
$lang_plugin_enlargeit['display_name'] = 'EnlargeIt! PlugIn';
$lang_plugin_enlargeit['update_success'] = 'Waarden zijn succesvol opgeslagen';
$lang_plugin_enlargeit['main_title'] = 'EnlargeIt! PlugIn';
$lang_plugin_enlargeit['pluginmanager'] = 'Plugin Manager';
$lang_plugin_enlargeit['submit_button'] = 'Opslaan';
$lang_plugin_enlargeit['enl_pictype'] = 'Vergroten naar';
$lang_plugin_enlargeit['enl_normalsize'] = 'Half formaat';
$lang_plugin_enlargeit['enl_fullsize'] = 'Volledig formaat';
$lang_plugin_enlargeit['enl_forcenormal'] = 'forceer half formaat';
$lang_plugin_enlargeit['enl_ani'] = 'Animatie';
$lang_plugin_enlargeit['noani'] = 'geen';
$lang_plugin_enlargeit['fade'] = 'vaag in/uit';
$lang_plugin_enlargeit['glide'] = 'glijden';
$lang_plugin_enlargeit['bumpglide'] = 'Hard glijden';
$lang_plugin_enlargeit['smoothglide'] = 'Zacht glijden';
$lang_plugin_enlargeit['expglide'] = 'hard glide';
$lang_plugin_enlargeit['topglide'] = 'glide from top';
$lang_plugin_enlargeit['leftglide'] = 'glide from left';
$lang_plugin_enlargeit['topleftglide'] = 'glide from top left';
$lang_plugin_enlargeit['enl_speed'] = 'Tijd tussen animatie stappen';
$lang_plugin_enlargeit['enl_maxstep'] = 'Animatie stappen';
$lang_plugin_enlargeit['enl_brdsize'] = 'Rand dikte';
$lang_plugin_enlargeit['enl_brdbck'] = 'Rand textur';
$lang_plugin_enlargeit['enl_brdcolor'] = 'Rand kleur';
$lang_plugin_enlargeit['enl_brdround'] = 'Ronde rand (alleen in Mozilla/Safari)';
$lang_plugin_enlargeit['enl_shadow'] = 'Gebruik rand schaduw';
$lang_plugin_enlargeit['enl_shadowsize'] = 'Schaduw grootte (rechts/onder)';
$lang_plugin_enlargeit['enl_shadowintens'] = 'Schaduw dikte';
$lang_plugin_enlargeit['enl_titlebar'] = 'Laat titelbalk zien als geen knoppen actief zijn';
$lang_plugin_enlargeit['enl_titletxtcol'] = 'Titelbalk kleur';
$lang_plugin_enlargeit['enl_ajaxcolor'] = 'Achtergrond kleur AJAX gedeelte';
$lang_plugin_enlargeit['enl_center'] = 'Centreer vergrote afbeelding';
$lang_plugin_enlargeit['enl_dark'] = 'Verduister scherm tijdens vergroting (1 afbeelding per keer)';
$lang_plugin_enlargeit['enl_darkprct'] = 'Verduistering sterkte';
$lang_plugin_enlargeit['enl_buttonpic'] = 'Laat knop zien \'Laat afbeelding zien\'';
$lang_plugin_enlargeit['enl_tooltippic'] = 'Laat afbeelding zien';
$lang_plugin_enlargeit['enl_buttoninfo'] = 'Laat knop zien \'Info\'';
$lang_plugin_enlargeit['enl_buttoninfoyes1'] = 'ja (open AJAX info pagina)';
$lang_plugin_enlargeit['enl_buttoninfoyes2'] = 'ja (open half formaat pagina)';
$lang_plugin_enlargeit['enl_tooltipinfo'] = 'Laat info zien';
$lang_plugin_enlargeit['enl_buttonfav'] = 'Laat knop zien \'Favorieten\'';
$lang_plugin_enlargeit['enl_tooltipfav'] = 'Favorieten';
$lang_plugin_enlargeit['enl_buttoncomment'] = 'Laat knop zien \'Commentaar\'';
$lang_plugin_enlargeit['enl_tooltipcomment'] = 'Commentaar';
$lang_plugin_enlargeit['enl_buttonhist'] = 'Laat knop zien \'Historie\'';
$lang_plugin_enlargeit['enl_tooltiphist'] = 'Historie';
$lang_plugin_enlargeit['enl_buttondownload'] = 'Show button \'Download\'';
$lang_plugin_enlargeit['enl_tooltipdownload'] = 'Download this file';
$lang_plugin_enlargeit['enl_clickdownload'] = 'Click here to download this file';
$lang_plugin_enlargeit['enl_buttonvote'] = 'Laat knop zien \'Stem\'';
$lang_plugin_enlargeit['enl_tooltipvote'] = 'Stem';
$lang_plugin_enlargeit['enl_buttonmax'] = 'Laat knop zien \'Maximaliseer\'';
$lang_plugin_enlargeit['enl_tooltipmax'] = 'Maximaliseer';
$lang_plugin_enlargeit['enl_maxforreg'] = 'Ja, maar niet voor anonieme bezoekers';
$lang_plugin_enlargeit['enl_maxpopup'] = 'ja, als pop-up scherm';
$lang_plugin_enlargeit['enl_maxpopupforreg'] = 'ja, als pop-up maar niet voor anonieme bezoekers';
$lang_plugin_enlargeit['enl_buttonclose'] = 'Laat knop zien \'Sluiten\'';
$lang_plugin_enlargeit['enl_tooltipclose'] = 'Sluiten';
$lang_plugin_enlargeit['enl_buttonnav'] = 'Laat knoppen zien \'Navigatie\'';
$lang_plugin_enlargeit['enl_tooltipprev'] = 'Vorige afbeelding';
$lang_plugin_enlargeit['enl_tooltipnext'] = 'Volgende afbeelding';
$lang_plugin_enlargeit['enl_adminmode'] = 'EnlargeIt! actief wanneer in admin mode';
$lang_plugin_enlargeit['enl_registeredmode'] = 'EnlargeIt! actief voor geregistreerde gebruikers';
$lang_plugin_enlargeit['enl_guestmode'] = 'EnlargeIt! actief voor gasten';
$lang_plugin_enlargeit['enl_sefmode'] = 'SEF support aan';
$lang_plugin_enlargeit['enl_addedtofav'] = 'De afbeelding is toegevoegd aan je favorieten.';
$lang_plugin_enlargeit['enl_removedfromfav'] = 'De afbeelding is verwijderd uit je favorieten.';
$lang_plugin_enlargeit['enl_showfav'] = 'Laat mijn favorieten zien';
$lang_plugin_enlargeit['enl_dragdrop'] = 'Sleep & Plaats voor vergrote afbeeldingen';
$lang_plugin_enlargeit['enl_darkensteps'] = 'Verduistering stappen (1 = onmiddelijk)';

?>