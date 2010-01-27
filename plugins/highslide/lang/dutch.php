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
  'button_install'=> 'Installeer',
  'button_submit' => 'Opslaan',
  'button_cancel' => 'Annuleer',
  'button_done'   => 'Klaar',
  'cleanup_question' => 'Verwijder opgeslagen instellingen ?',
  'install_note'  => 'Configureer plugin d.m.v. knop op de Beheerders toolbar.',	// Note about configuring plugin
  'install_click' => 'Klik op de knop om plugin te installeren.',	// Message to install plugin
);

// Lang setting for Caption
$lang_plugin_highslide = array( 
	'detail'       => 'Detail', // Lable of the link to intermadiate image
	'close'        => 'Sluiten', // Lable of the close link
	'title'        => 'Titel', // Lable of the title
	'controlbarnext'  => 'Next (right arrow key)',  // HS v3.02
	'controlbarprev'  => 'Previous (left arrow key)', // HS v3.02
	'controlbarmove'  => 'Click and drag to move', // HS v3.02
	'controlbarclose' => 'Close', //HS v3.02
);
//Lang setting for configuration and admin panel
$lang_plugin_highslide_config = array(
  'display_name'  => 'HighSlide',			// Display Name
  'config_title'  => 'Configureer HighSlide',			// Title of the button on the gallery config menu
  'config_button' => 'HighSlide',				// Label of the button on the gallery config menu
  'page_success'  => 'Configuratie instellinge opgeslagen.',		// Page success message
  'page_failure'  => 'Niet mogenlijk om instellingen te updaten.',		// Page failure message
  'version'       => 'Ver 3.04', // HS 3.01
  'pluginmanager' => 'Plugin Beheer',
  'expand_all'    => 'Alles uitvouwen',
  'main_title'    => 'HighSlide plugin beheer',
  'Style_of_border'   => 'Stijl van de Rand:',
  'Disable_Admin_Mode'=> 'Plugin uitschakelen in Beheerders modus:',
  'Link_To_intermadiate'=> 'Link naar intermediate:',
  'Link_for_Closing'=> 'Link naar sluiten:', // HS v 2.3
  'Dispaly_Title_Caption'=> 'Laat titel zien in onderschrift :',// HS 2.1
  'Custom_HTML_Caption'=> 'Custom HTML in onderschrift: ',
  'Aimao' => 'Waar wil je HighSlide toepassen? ', // HS v 2.2 
  'SFIuSIi' => 'Grote van de slide: ', // HS v 2.3 
  'Yes' => 'Ja',
  'No' => 'Nee',
  'full_image' => 'Volledige foto', // HS v 2.1
  'intermadiate' => 'Intermediate foto (gecontroleerd via file naam; error indien speciale characters in file naam)', // HS v 2.1
  'force_intermadiate' => 'Dwing naar intermediate foto (als er intermediate gegevens zijn van iedere foto)', // HS v3.0
  'Wrob'=> 'Afgeronde witte uitwendige rand *',
  'StyleNote' => '* Kleuren van randen en onderschrift worden passend gemaakt!', //HS 3.01
  'StyleNote2' => '** Dikte wordt gezet op 0px!', //HS 3.01
  'Beveled' => 'Half transparant afgeschuinde rand **', //HS 3.0
  'W10b'=> 'Vierkante rand (selecteer kleur hieronder)',
  'Ogb'=> 'Vierkante rand met uitwendige gloed (selecteer kleur hieronder)',
  'Nb'=> 'Geen rand **',
  'Nbshadow'=> 'Alleen schaduw **', //HS 3.01
  'note1' => 'Deze opties zijn niet beschikbaar in deze versie !!!',
  'apply_to_all'  => 'Op alle pagina&#180;s', // HS v 2.3
  'apply_to_index'  => 'Op index & meta albums pagina&#180;s', // HS v 2.2
  'page_success' => 'HighSlide instellingen opgeslagen.', // HS v 2.2
  'enable_sef' => ' SEF ondersteuning inschakelen: ', // HS v2.2
  'slide_cnt' => 'HighSlide views tellen als echte views (hscnt.php installeren in gallery root!):', //HS v2.5
  'border_color' => 'Kleur voor rand en onderschrift:', //HS 3.0
  'details_color' => 'Kleur voor onderschrift tekst:', //HS 3.0
  'detailsover_color' => 'Kleur voor onderschrift tekst (zwevend):', //HS 3.0
  'thickness' => 'Rand dikte:', //HS 3.0
  'expand_steps' => 'Aantal stappen tijdens uitvouwen foto:', //HS 3.0
  'expand_duration' => 'Tijdsduur voor uitvouwen [ms]:', //HS 3.0
  'restore_steps' => 'Aantal stappen tijdens sluiten foto:', //HS 3.0
  'restore_duration' => 'Tijdsduur voor sluiten [ms]:', //HS 3.0
  'caption_slide_speed' => 'Tijdsduur voor onderschrift uitvouwen:', //HS 3.0
  'allow_multi_inst' => 'Sta meerdere gelijktijdig uitgevouwen foto&#180;s toe:', //HS 3.0
  'RightNow' => 'Nu Meteen', //HS 3.0
  'Slowest' => 'Traagst', //HS 3.0
  'Slower' => 'Trager', //HS 3.0
  'Slow' => 'Traag', //HS 3.0
  'Fast' => 'Snel', //HS 3.0
  'Faster' => 'Sneller', //HS 3.0
  'Fastest' => 'Snelst', //HS 3.0
  'Rlightgray' => 'Afgeronde licht-grijze uitwendige rand *', //HS 3.01
  'Rmediumgray' => 'Afgeronde medium-grijze uitwendige rand *', //HS 3.01
  'Rdarkgray' => 'Afgeronde donker-grijze uitwendige rand *', //HS 3.01
  'Rblack' => 'Afgeronde zwarte uitwendige rand *', //HS 3.01
  'Rroyalblue' => 'Afgeronde royal-blauwe uitwendige rand *', //HS 3.01
  'Rdarkblue' => 'Afgeronde donker-blauwe uitwendige rand *', //HS 3.01
  'Rlightgreen' => 'Afgeronde licht-groene uitwendige rand *', //HS 3.01
  'Rdarkgreen' => 'Afgeronde donker-groene uitwendige rand *', //HS 3.01
  'Rlightred' => 'Afgeronde licht-rode uitwendige rand *', //HS 3.01
  'Rdarkred' => 'Afgeronde donker-rode uitwendige rand *', //HS 3.01
  'Rorange' => 'Afgeronde oranje uitwendige rand *', //HS 3.01
  'Rcyan' => 'Afgeronde cyaan uitwendige rand *', //HS 3.01
  'Preview' => 'Voorvertoning', //HS 3.01
);
// JS lang setting
$lang_plugin_highslide_js = array (
	'loading_text'   =>  'Laden...',// HS v2.3
	'loading_title'  =>  'Klik om te annuleren',// HS v2.3
	'restore_title'  =>  'Klik om thumbnail te herstellen',// HS v2.3
	'fullexpand_title' => 'Klik voor originele grote', // HS v3.0
);
?>