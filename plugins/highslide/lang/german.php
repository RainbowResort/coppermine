<?php
/**************************************************
  Coppermine 1.4.x Plugin - HighSlide v 3.04
  *************************************************
  Copyright (c) 2006-2008 Borzoo Mossavari and Timos-Welt
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Skip Intermediate Page and show full page on the page
  Based on Highslide JS @ http://vikjavev.no/highslide/ 
  ***************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

// Lang setting for installation process
$lang_plugin_highslide_install = array(
  'button_install'=> 'Installieren',
  'button_submit' => 'Speichern',
  'button_cancel' => 'Abbrechen',
  'button_done'   => 'Erledigt',
  'cleanup_question' => 'Tabelle entfernen, in der die Einstellungen gespeichert sind?',
  'install_note'  => 'Konfiguriere das PlugIn mit dem Butten in der Admin-Leiste.',	// Note about configuring plugin
  'install_click' => 'Button klicken, um das PlugIn zu installieren.',	// Message to install plugin
);

// Lang setting for Caption
$lang_plugin_highslide = array( 
	'detail'       => 'Details zu diesem Foto', // Lable of the link to intermadiate image
	'close'        => 'Schliessen', // Lable of the close link
	'title'        => 'Titel', // Lable of the title
	'controlbarnext'  => 'N&auml;chstes (rechte Pfeiltaste)',  // HS v3.02
	'controlbarprev'  => 'Voriges (linke Pfeiltaste)', // HS v3.02
	'controlbarmove'  => 'Klicken und ziehen zum Verschieben', // HS v3.02
	'controlbarclose' => 'Schliessen', //HS v3.02
);
//Lang setting for configuration and admin panel
$lang_plugin_highslide_config = array(
  'display_name'  => 'HighSlide',			// Display Name
  'config_title'  => 'HighSlide konfigurieren',			// Title of the button on the gallery config menu
  'config_button' => 'HighSlide',				// Label of the button on the gallery config menu
  'page_success'  => 'Einstellungen aktualisiert.',		// Page success message
  'page_failure'  => 'Konnte Einstellungen nicht aktualisieren.',		// Page failure message
  'version'       => 'Ver 3.04', // HS 3.0
  'pluginmanager' => 'Plugin Manager',
  'expand_all'    => 'Alles aufklappen',
  'main_title'    => 'HighSlide PlugIn Management',
  'Style_of_border'   => 'Rahmenstil:',
  'Disable_Admin_Mode'=> 'PlugIn im Admin-Modus deaktivieren:',
  'Link_To_intermadiate'=> 'Link auf Bild in Zwischengr&ouml;sse:',
  'Link_for_Closing'=> 'Link zum Schliessen:', // HS v 2.3
  'Dispaly_Title_Caption'=> 'Titel als Bildunterschrift darstellen:',// HS 2.1
  'Custom_HTML_Caption'=> 'Eigenes HTML als Bildunterschrift: ',
  'Aimao' => 'Wie soll HighSlide wirksam werden?', // HS v 2.2 
  'SFIuSIi' => 'Gr&ouml;sse der Animation - Bild in...', // HS v 2.3 
  'Yes' => 'Ja',
  'No' => 'Nein',
  'full_image' => 'Originalgr&ouml;sse', // HS v 2.1
  'intermadiate' => 'Zwischengr&ouml;sse (per Dateinamen pr&uuml;fen)', // HS v 2.1
  'force_intermadiate' => 'Zwischengr&ouml;sse immer erzwingen', // HS v3.0
  'Wrob'=> 'Runder weisser Rahmen *',
  'StyleNote' => '* Farbe Rahmen und Hintergrund Bildunterschrift wird automatisch angepasst!', //HS 3.01
  'StyleNote2' => '** Rahmenst&auml;rke wird auf 0px gesetzt!', //HS 3.01
  'Beveled' => 'Halbtransparent angeschr&auml;gt *', //HS 3.0
  'W10b'=> 'Eckiger Rahmen (Farben unten w&auml;hlen)',
  'Ogb'=> 'Eckiger Rahmen mit Gl&uuml;h-Effekt (Farben unten w&auml;hlen)',
  'Nb'=> 'Kein Rahmen **',
  'Nbshadow'=> 'Nur Schatten **', //HS 3.01
  'note1' => 'Diese Optionen haben in dieser Version keine Wirkung!!!',
  'apply_to_all'  => 'Auf allen Seiten anwenden', // HS v 2.3
  'apply_to_index'  => 'Auf Index & Meta-Alben anwenden', // HS v 2.2
  'page_success' => 'HighSlide Konfiguration aktualisiert.', // HS v 2.2
  'enable_sef' => 'SEF-Unterst&uuml;tzung einschalten:', // HS v2.2
  'slide_cnt' => 'Slide-Anzeigen als richtige Views z&auml;hlen (hscnt.php muss ins Hauptverzeichnis der Galerie kopiert sein!):', //HS v2.5
  'border_color' => 'Farbe Rahmen und Hintergrund Bildunterschrift:', //HS 3.0
  'details_color' => 'Schriftfarbe der Bildunterschrift:', //HS 3.0
  'detailsover_color' => 'Schriftfarbe der Bildunterschrift beim Dar&uuml;berfahren (Hover):', //HS 3.0
  'thickness' => 'Rahmenst&auml;rke:', //HS 3.0
  'expand_steps' => 'Zahl der Schritte beim Vergr&ouml;ssern des Bildes:', //HS 3.0
  'expand_duration' => 'Dauer des Vergr&ouml;sserns [ms]:', //HS 3.0
  'restore_steps' => 'Zahl der Schritte beim Verkleinern des Bildes:', //HS 3.0
  'restore_duration' => 'Dauer des Verkleinerns [ms]:', //HS 3.0
  'caption_slide_speed' => 'Bildunterschrift Gleiteffekt Geschwindigkeit:', //HS 3.0
  'allow_multi_inst' => 'Mehr als ein vergr&ouml;ssertes Bild zur gleichen Zeit:', //HS 3.0
  'RightNow' => 'sofort', //HS 3.0
  'Slowest' => 'sehr langsam', //HS 3.0
  'Slower' => 'langsam', //HS 3.0
  'Slow' => 'mittel', //HS 3.0
  'Fast' => 'schnell', //HS 3.0
  'Faster' => 'schneller', //HS 3.0
  'Fastest' => 'turbo', //HS 3.0
  'Rlightgray' => 'Runder hellgrauer Rahmen *', //HS 3.01
  'Rmediumgray' => 'Runder mittelgrauer Rahmen *', //HS 3.01
  'Rdarkgray' => 'Runder dunkelgrauer Rahmen *', //HS 3.01
  'Rblack' => 'Runder schwarzer Rahmen *', //HS 3.01
  'Rroyalblue' => 'Runder k&ouml;nigsblauer Rahmen *', //HS 3.01
  'Rdarkblue' => 'Runder dunkelblauer Rahmen *', //HS 3.01
  'Rlightgreen' => 'Runder hellgr&uuml;ner Rahmen *', //HS 3.01
  'Rdarkgreen' => 'Runder dunkelgr&uuml;ner Rahmen *', //HS 3.01
  'Rlightred' => 'Runder hellroter Rahmen *', //HS 3.01
  'Rdarkred' => 'Runder dunkelroter Rahmen *', //HS 3.01
  'Rorange' => 'Runder orangener Rahmen *', //HS 3.01
  'Rcyan' => 'Runder blaugr&uuml;ner Rahmen *', //HS 3.01
  'Preview' => 'Vorschau', //HS 3.01
);
// JS lang setting
$lang_plugin_highslide_js = array (
	'loading_text'   =>  'Laden...',// HS v2.3
	'loading_title'  =>  'Klicken zum Abbrechen',// HS v2.3
	'restore_title'  =>  'Klicken zum Verkleinern',// HS v2.3
	'fullexpand_title' => 'Originalgroesse', // HS v3.0
);
?>