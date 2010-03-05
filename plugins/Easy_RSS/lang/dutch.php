<?php
/**************************************************
  Coppermine 1.4 Plugin - Easy RSS
  *************************************************
  Copyright (c) 2007 Brent Gerig
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

$lang_plugin_easyrss = array(
  'label_title'   => 'Titel',
  'label_caption' => 'Korte beschrijving',
  'label_filename' => 'filename',
  'last_additions'=> 'Laatste toevoegingen',
  'alt_rss_feed'  => 'RSS',
  'alt_google'    => 'Toevoegen aan Google',
  'alt_yahoo'     => 'Toevoegen aan My Yahoo!',
  'views'         => 'Beeld',
  'no'            => 'Nee ',
);

$lang_plugin_easyrss_config = array(
  'question_title'=> 'Moet de afbeelding naam of beschrijving gebruikt worden in de RSS?',
  'question_num'  => 'Welke hoeveelheid items wil je laten zien in de RSS: ',
  'question_show' => 'Welke items wil je laten zien?',
  'show_meta'     => 'RSS meta link toevoegen aan head',
  'show_rss'      => 'Directe RSS link toevoegen aan footer',
  'show_google'   => '"Toevoegen aan Google" knop toevoegen aan footer',
  'show_yahoo'    => '"Toevoegen aan My Yahoo!" knop toevoegen aan footer',
  'cleanup_question' => 'Rss.php en instellingen verwijderen?',
  'cleanup_note'  => '** Dit zal alle RSS lezers stoppen die deze RSS lezen.',
  'button_install'=> 'Installeer',
  'button_cancel' => 'Stoppen',
  'button_submit' => 'Deinstalleren',
  'yes'           => 'Ja',
  'no'            => 'Nee',
);
?>
