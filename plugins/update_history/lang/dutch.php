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
Modified By Frantz for update_history plugin
**********************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }
//language variables
$lang_plugin_update_history = array(
  'configure'	=>'Na installatie voeg je <strong>updatehistory</strong> toe aan de instellingen van de :<br />config => Albums lijst => De layout van de hoofdpagina',
  'update'	=>'Recente toevoegingen',
  'new'		=>' nieuwe bestand toegevoegd aan album ',
  'news'	=>' nieuwe bestanden toegevoegd aan album ',
  'by'		=>' door ',
  'archive'	=>'Archief',
  'admin'	=>'Archief instellingen',
  'plugin_name'	=>'Update Historie',
  'day_nb'	=>'Hoever terug wil je de historie zien: ',
  'submit'	=>'Laat zien',
  'history'  	=>'Historie voor de ',
  'last_days'	=>' laatste dagen',
  'add'		=>' toegevoegd aan het album ',
  'archive_title'=>'Laatst geplaatste bestanden archief',
  'archive_setup'=>'Zoek instellingen:',
);
//Date format 
$plugin_update_history_date_fmt = '%B %d, %Y';
$lang_plugin_update_history_config = array(
'button_install'	=> 'Installeer',
'install_click'		=> 'Klik op de knop om de plugin te installeren.',
'install_note'		=> 'Stel de plugin in via de <b>"administration"</b> Archief instellingen knop bij de archief gegevens .',
'display_block'		=> 'Na installeren, voeg je <b>updatehistory</b> toe aan de instellingen voor  <i><b>Albums lijst => De layout van de hoofdpagina.',
'cleanup_question' 	=> 'Database tabel verwijderen waar de instellingen in worden bewaard ?',
'yes'			=> 'Ja',
'no'			=> 'Nee',
'button_submit' 	=> 'Opslaan',
'button_cancel' 	=> 'Stop',
);
$lang_plugin_update_history_admin = array(
'title'			=> 'Groeps instellingen',
'group_name'		=> 'Gebruikers groep',
'param'			=> 'Archief instellingen voor de groep ',
'text'			=> 'Wijzig hoe deze groep het archief kan gebruiken en klik op Opslaan ',
'bloc'			=> 'Archief laten zien: ',
'archive'		=> 'Archief knop laten zien: ',
'uploader'		=> 'Naam laten zien van degene die ze toegevoegd heeft: ',
'days_last'		=> 'Wat wil je ze laten zien: ',
'days'			=> 'Laatste dagen',
'last'			=> 'Laatste bestanden',
'save'			=> 'Opslaan',
'nb'			=> 'Hoever terug wil je dagen of bestanden laten zien ',
'succes'		=> 'De nieuwe archief instellingen zijn opgeslagen!',
'uploaded_files'	=> ' laatst toegevoegde bestanden:',
);
?>