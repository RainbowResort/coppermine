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
//variables de langue
$lang_plugin_update_history = array(
  'configure'	=>'Dopo l\'installazione, aggiungere <strong>updatehistory</strong> nella stringa :<br />config => Visualizzazione lista album => Contenuto della pagina principale',
  'update'	=>'Aggiornamenti recenti',
  'new'		=>' nuovo file aggiunto nell\'album ',
  'news'	=>' nuovi files aggiunti nell\'album ',
  'by'		=>' da ',
  'archive'	=>'Archivi',
  'admin'	=>'Configurazione plugin',
  'plugin_name'	=>'Update History',
  'day_nb'	=>'Numero di giorni da contabilizzare nello storico: ',
  'submit'	=>'Invia',
  'history'  	=>'Storico degli ',
  'last_days'	=>' ultimi giorni',
  'add'		=>' aggiunto nell\'album ',
  'archive_title'=>'Archivio degli ultimi uploads',
  'archive_setup'=>'Parametri ricerca:',
);
//Format de la date
$plugin_update_history_date_fmt = '%d %B %Y';
$lang_plugin_update_history_config = array(
'button_install'	=> 'Installazione',
'install_click'		=> 'Clicca qui per installare il plugin.',
'install_note'		=> 'Utilizza il comando <b>"amministrazione"</b> dal plugin per configurarlo.',
'display_block'		=> 'Dopo l\'installazione, aggiungere <strong>updatehistory</strong> nella stringa :<br />config => Visualizzazione lista album => Contenuto della pagina principale.',
'cleanup_question' 	=> 'Cancellare la tavola utilizzata per memorizzare i parametri ?',
'yes'			=> 'Si',
'no'			=> 'No',
'button_submit' 	=> 'Invia',
'button_cancel' 	=> 'Annulla',
);
$lang_plugin_update_history_admin = array(
'title'			=> 'Gruppo da parametrare',
'group_name'		=> 'Gruppo users',
'param'			=> 'Parametri del plugin per il gruppo ',
'text'			=> 'Modifica parametri per questo gruppo poi clicca su  "Salva"',
'bloc'			=> 'Mostra blocco: ',
'archive'		=> 'Mostra comando "Archivi": ',
'uploader'		=> 'Mostra l\'user che ha caricato il file: ',
'days_last'		=> 'Parametri da considerare per lo storico: ',
'days'			=> 'Ultimi giorni',
'last'			=> 'Ultimi files',
'save'			=> 'Salva',
'nb'			=> 'Numeri considerati per lo storico in funzione dei parametri precedenti',
'succes'		=> 'Nuova configurazione salvata',
'uploaded_files'	=> ' ultimi files caricati:',
);
?>