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
$lang_plugin_enlargeit['update_success'] = 'Die Werte wurden erfolgreich aktualisiert';
$lang_plugin_enlargeit['main_title'] = 'EnlargeIt! PlugIn';
$lang_plugin_enlargeit['pluginmanager'] = 'Plugin Manager';
$lang_plugin_enlargeit['submit'] = 'Speichern';
$lang_plugin_enlargeit['enlarge_to_pic_in'] = 'Vergrößern auf Bild in';
$lang_plugin_enlargeit['intermediate_size'] = 'Normalgröße';
$lang_plugin_enlargeit['full_size'] = 'voller Größe';
$lang_plugin_enlargeit['force_intermediate_size'] = 'Normalgröße erzwingen';
$lang_plugin_enlargeit['animation'] = 'Art der Animation';
$lang_plugin_enlargeit['none'] = 'keine';
$lang_plugin_enlargeit['fade'] = 'ein-/ausblenden';
$lang_plugin_enlargeit['glide'] = 'gleiten';
$lang_plugin_enlargeit['bumpglide'] = 'hüpfgleiten';
$lang_plugin_enlargeit['smoothglide'] = 'sanft gleiten';
$lang_plugin_enlargeit['expglide'] = 'hart gleiten';
$lang_plugin_enlargeit['topglide'] = 'von oben gleiten';
$lang_plugin_enlargeit['leftglide'] = 'von links gleiten';
$lang_plugin_enlargeit['topleftglide'] = 'von oben links gleiten';
$lang_plugin_enlargeit['time_between_animation_steps'] = 'Zeit zwischen den Animationsschritten';
$lang_plugin_enlargeit['animation_steps'] = 'Zahl der Animationsschritte';
$lang_plugin_enlargeit['border_width'] = 'Rahmendicke';
$lang_plugin_enlargeit['border_texture'] = 'Rahmentextur';
$lang_plugin_enlargeit['border_color'] = 'Rahmenfarbe';
$lang_plugin_enlargeit['round_border'] = 'Rahmen abrunden (nur Mozilla/Safari)';
$lang_plugin_enlargeit['enl_shadow'] = 'Schatten unter Rahmen';
$lang_plugin_enlargeit['shadow_size'] = 'Schattengröße rechts/unten';
$lang_plugin_enlargeit['shadow_opacity'] = 'Deckkraft des Schattens';
$lang_plugin_enlargeit['show_titlebar'] = 'Titelleiste auch ohne Buttons zeigen';
$lang_plugin_enlargeit['title_bar_text_color'] = 'Textfarbe der Titelleiste';
$lang_plugin_enlargeit['background_color_ajax_area'] = 'Hintergrundfarbe AJAX-Bereich';
$lang_plugin_enlargeit['center_enlarge_images'] = 'Vergrößertes Bild zentrieren';
$lang_plugin_enlargeit['darken_screen'] = 'Bildschirm nach vergrößern abdunkeln (nur 1 Bild gleichzeitig)';
$lang_plugin_enlargeit['darken_strength'] = 'Stärke der Abdunkelung';
$lang_plugin_enlargeit['button_picture'] = 'Button "Zurück zum Bild" anzeigen';
$lang_plugin_enlargeit['show_picture'] = 'Bild anzeigen'; // js-alert
$lang_plugin_enlargeit['button_info'] = 'Button "Info" anzeigen';
$lang_plugin_enlargeit['open_as_ajax'] = 'als AJAX Schnippsel';
$lang_plugin_enlargeit['open_intermediate_page'] = 'öffne Seite';
$lang_plugin_enlargeit['show_info'] = 'Info anzeigen'; // js-alert
$lang_plugin_enlargeit['button_favorites'] = 'Button "Favoriten" anzeigen';
$lang_plugin_enlargeit['favorites'] = 'Favoriten'; // js-alert
$lang_plugin_enlargeit['button_comments'] = 'Button "Kommentar" anzeigen';
$lang_plugin_enlargeit['comment'] = 'Kommentieren';
$lang_plugin_enlargeit['button_histogram'] = 'Button "Histogramm" anzeigen';
$lang_plugin_enlargeit['histogram'] = 'Histogramm'; // js-alert
$lang_plugin_enlargeit['button_vote'] = 'Button "Bewerten" anzeigen';
$lang_plugin_enlargeit['vote'] = 'Bewerten';
$lang_plugin_enlargeit['button_maximize'] = 'Button "Maximieren" anzeigen';
$lang_plugin_enlargeit['full_size'] = 'Volle Groesse'; // js-alert
$lang_plugin_enlargeit['button_close'] = 'Button "Schließen" anzeigen';
$lang_plugin_enlargeit['button_download'] = 'Button "Download" anzeigen';
$lang_plugin_enlargeit['download_this_file'] = 'Datei herunterladen'; // js-alert
$lang_plugin_enlargeit['download_explain'] = 'Hier klicken um die Datei herunterzuladen';
$lang_plugin_enlargeit['close_esc'] = 'Schliessen [Esc]'; // js-alert
$lang_plugin_enlargeit['button_navigation'] = 'Buttons "Navigation" anzeigen';
$lang_plugin_enlargeit['previous_left'] = 'Vorheriges Bild [linke Pfeiltaste]'; // js-alert
$lang_plugin_enlargeit['next_right'] = 'Naechstes Bild [rechte Pfeiltaste]'; // js-alert
$lang_plugin_enlargeit['administrators'] = 'EnlargeIt! im Admin-Modus aktivieren';
$lang_plugin_enlargeit['registered_users'] = 'EnlargeIt! für registrierte Besucher aktivieren';
$lang_plugin_enlargeit['guests'] = 'EnlargeIt! für anonyme Besucher aktivieren';
$lang_plugin_enlargeit['enable_sefurl_support'] = 'SEF-Unterstützung aktivieren';
$lang_plugin_enlargeit['file_added_to_favorites'] = 'Das Bild wurde zu den Favoriten hinzugefügt.';
$lang_plugin_enlargeit['file_removed_from_favorites'] = 'Das Bild wurde von den Favoriten entfernt.';
$lang_plugin_enlargeit['button_favorites'] = 'Meine Favoriten anzeigen';
$lang_plugin_enlargeit['for_registered_users'] = 'Ja, aber nicht für anonyme Gäste';
$lang_plugin_enlargeit['as_popup_window'] = 'Ja, als Pop-Up';
$lang_plugin_enlargeit['enl_maxpopupforreg'] = 'Ja, als Pop-Up aber nicht für anonyme Gäste';
$lang_plugin_enlargeit['enable_drag_drop'] = 'Vergrösserte Bilder mit der Maus verschiebbar (Drag & Drop)';
$lang_plugin_enlargeit['darkening_speed'] = 'Zahl der Schritte beim Abdunkeln (1 = sofort)';
$lang_plugin_enlargeit['no_comments'] = 'Es gibt noch keine Kommentare, und Du hast nicht das Recht, einen hinzuzufügen!';
$lang_plugin_enlargeit['mouse_wheel_navigation'] = 'Mausrad-Navigation';
$lang_plugin_enlargeit['cancel_loading'] = 'Klicken, um das Laden des Bildes abzubrechen'; // js-alert
$lang_plugin_enlargeit['no_flash_found'] = 'Um diese Datei anzusehen wird das Flash Plugin benötigt'; // js-alert
$lang_plugin_enlargeit['flash_player'] = 'Welcher FLV player soll benutzt werden';
$lang_plugin_enlargeit['button_bbcode'] = 'Button "BBCode" anzeigen';
$lang_plugin_enlargeit['bbcode'] = 'BBCode'; // js-alert
$lang_plugin_enlargeit['copy_to_clipboard'] = 'In Zwischenablage kopieren';
$lang_plugin_enlargeit['transparency_for_glide'] = 'Transparenzeffekt für Gleit-Animation';

?>