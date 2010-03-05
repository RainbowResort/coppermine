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
  'label_caption' => 'Beschriftung',
  'label_filename' => 'Dateiname',
  'last_additions'=> 'Zuletzt hochgeladen',
  'alt_rss_feed'  => 'RSS-Feed',
  'alt_google'    => 'Zu Google hinzufügen',
  'alt_yahoo'     => 'Zu MyYahoo! hinzufügen',
  'views'         => 'Ansichten',
  'no'            => 'Nein ',
);

$lang_plugin_easyrss_config = array(
  'question_title'=> 'Bild-Titel oder Beschriftung für den Feed-Titel verwenden?',
  'question_num'  => 'Anzahl der Elemente, die im Feed angezeigt werden: ',
  'question_show' => 'Welche Elemente sollen angezeigt werden?',
  'show_meta'     => 'Einen RSS-Verweis zu den Meta-Angaben im Dateikopf hinzufügen',
  'show_rss'      => 'Direkten RSS-Verweis zur Fußzeile hinzufügen',
  'show_google'   => 'Einen Button "Zu Google hinzufügen" zur Fußzeile hinzufügen?',
  'show_yahoo'    => 'Einen Button "Zu MyYahoo! hinzufügen" zur Fußzeile hinzufügen',
  'cleanup_question' => 'Datei rss.php und Einstellungen entfernen?',
  'cleanup_note'  => '** Dies wird alle Feed-Reader stören, die diesen Feed abonniert haben.',
  'button_install'=> 'Installieren',
  'button_cancel' => 'Abbrechen',
  'button_submit' => 'De-installieren',
  'yes'           => 'Ja',
  'no'            => 'Nein',
);
?>
