<?php
/**************************************************
  Coppermine 1.5.x Plugin - move_to_public
  *************************************************
  Copyright (c) 2010 Borzoo Mossavari (Sami)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

if (!defined('IN_COPPERMINE')) { 
    die('Not in Coppermine...');
}

$lang_plugin_move_to_public['name'] = 'In öffentliche Kategorie verschieben (Move2Public)'; // Display Name
$lang_plugin_move_to_public['admin_title'] = 'Move2Public'; // Title of the button on the gallery admin menu
$lang_plugin_move_to_public['description'] = 'Move2Public gibt dem Admin die Möglichkeit, Alben von innerhalb der Benutzergalerien in öffentliche (durch den Admin erstellte) Kategorien zu verschieben.';
$lang_plugin_move_to_public['announcement_thread'] = 'Ankündigungs-Thread';
$lang_plugin_move_to_public['install_info'] = 'Dieses Plugin fügt eine neue Schaltfläche zum Admin-Menü hinzu, welches dem Admin ein schnelles Verschieben von Alben ermöglicht.';
$lang_plugin_move_to_public['default_behaviour_explain'] = 'Standardmäßig werden Alben in die neueste Kategorie verschoben (die Kategorie mit der höchsten Kategorie-ID). Die Eigentümerschaft wird dem Benutzer mit der niedrigsten Benutzer-ID gewährt, welches in der Regel das Admin-Konto ist, falls kein anderer Benutzer explizit gewählt wird.';
$lang_plugin_move_to_public['no_user_albums_available'] = 'Keine benutzerdefinierten Alben vorhanden!';
$lang_plugin_move_to_public['move_to_public'] = 'Verschiebe in öffentliche Kategorie';
$lang_plugin_move_to_public['status'] = 'Status';
$lang_plugin_move_to_public['choose'] = 'Wähle';
$lang_plugin_move_to_public['user'] = 'Benutzer';
$lang_plugin_move_to_public['album'] = 'Album';
$lang_plugin_move_to_public['move_to_category'] = 'Verschiebe in Kategorie';
$lang_plugin_move_to_public['moved_to_category'] = 'Verschoben in Kategorie';
$lang_plugin_move_to_public['take_ownership'] = 'Besitz übernehmen';
$lang_plugin_move_to_public['enable'] = 'Aktivieren';
$lang_plugin_move_to_public['no_album_selected'] = 'Kein Album gewählt!';
$lang_plugin_move_to_public['move_more_albums_to_public'] = 'Mehr Alben in öffentliche Kategorien verschieben';
$lang_plugin_move_to_public['failure'] = 'Fehlschlag';
$lang_plugin_move_to_public['album_properties'] = 'Alben Eigenschaften';

?>