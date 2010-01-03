<?php
/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt!
  *************************************************
  Copyright (c) 2010 Timos-Welt (www.timos-welt.de)
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
$lang_plugin_enlargeit['display_name'] = 'EnlargeIt!';
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
$lang_plugin_enlargeit['full_size'] = 'Volle Größe'; // js-alert
$lang_plugin_enlargeit['button_close'] = 'Button "Schließen" anzeigen';
$lang_plugin_enlargeit['button_download'] = 'Button "Download" anzeigen';
$lang_plugin_enlargeit['download_this_file'] = 'Datei herunterladen'; // js-alert
$lang_plugin_enlargeit['download_explain'] = 'Hier klicken um die Datei herunterzuladen';
$lang_plugin_enlargeit['close_esc'] = 'Schliessen [Esc]'; // js-alert
$lang_plugin_enlargeit['button_navigation'] = 'Buttons "Navigation" anzeigen';
$lang_plugin_enlargeit['previous_left'] = 'Vorheriges Bild [linke Pfeiltaste]'; // js-alert
$lang_plugin_enlargeit['next_right'] = 'Naechstes Bild [rechte Pfeiltaste]'; // js-alert
$lang_plugin_enlargeit['administrators'] = 'Administratoren';
$lang_plugin_enlargeit['registered_users'] = 'registrierte Benutzer';
$lang_plugin_enlargeit['guests'] = 'anonyme Besucher (Gäste)';
$lang_plugin_enlargeit['enable_sefurl_support'] = 'SEF-Unterstützung aktivieren';
$lang_plugin_enlargeit['file_added_to_favorites'] = 'Das Bild wurde zu den Favoriten hinzugefügt.';
$lang_plugin_enlargeit['file_removed_from_favorites'] = 'Das Bild wurde von den Favoriten entfernt.';
$lang_plugin_enlargeit['button_favorites'] = 'Meine Favoriten anzeigen';
$lang_plugin_enlargeit['for_registered_users_only'] = 'für registrierte Benutzer';
$lang_plugin_enlargeit['as_popup_window'] = 'Ja, als Pop-Up';
$lang_plugin_enlargeit['enl_maxpopupforreg'] = 'Ja, als Pop-Up aber nicht für anonyme Gäste';
$lang_plugin_enlargeit['enable_drag_drop'] = 'Vergrösserte Bilder mit der Maus verschiebbar';
$lang_plugin_enlargeit['darkening_speed'] = 'Zahl der Schritte beim Abdunkeln';
$lang_plugin_enlargeit['no_comments'] = 'Es gibt noch keine Kommentare, und Du hast nicht das Recht, einen hinzuzufügen!';
$lang_plugin_enlargeit['mouse_wheel_navigation'] = 'Mausrad-Navigation';
$lang_plugin_enlargeit['cancel_loading'] = 'Klicken, um das Laden des Bildes abzubrechen'; // js-alert
$lang_plugin_enlargeit['no_flash_found'] = 'Um diese Datei anzusehen wird das Flash Plugin benötigt'; // js-alert
$lang_plugin_enlargeit['flash_player'] = 'Welcher FLV player soll benutzt werden';
$lang_plugin_enlargeit['button_bbcode'] = 'Button "BBCode" anzeigen';
$lang_plugin_enlargeit['bbcode'] = 'BBCode'; // js-alert
$lang_plugin_enlargeit['copy_to_clipboard'] = 'In Zwischenablage kopieren';
$lang_plugin_enlargeit['transparency_for_glide'] = 'Transparenzeffekt für Gleit-Animation';
$lang_plugin_enlargeit['marble'] = 'Marmor';
$lang_plugin_enlargeit['metallight'] = 'Gebürsteter Edelstahl';
$lang_plugin_enlargeit['metalwhite'] = 'Helles Metall';
$lang_plugin_enlargeit['metalwhite2'] = 'Helleres Metall';
$lang_plugin_enlargeit['metalblue'] = 'Metallisches Blau';
$lang_plugin_enlargeit['metalred'] = 'Metallisches Rot';
$lang_plugin_enlargeit['metalgreen'] = 'Metalisches Grün';
$lang_plugin_enlargeit['metalsilver'] = 'Silber';
$lang_plugin_enlargeit['metalblack'] = 'Metallisches Schwarz';
$lang_plugin_enlargeit['rain'] = 'Regen';
$lang_plugin_enlargeit['light_rain'] = 'Nieselregen';
$lang_plugin_enlargeit['woodlight'] = 'Kiefer';
$lang_plugin_enlargeit['wooddark'] = 'Eiche';
$lang_plugin_enlargeit['paper'] = 'Papier';
$lang_plugin_enlargeit['leather'] = 'Leder';
$lang_plugin_enlargeit['green'] = 'Dunkelgrün';
$lang_plugin_enlargeit['greenliquid'] = 'Grüne Flüssigkeit';
$lang_plugin_enlargeit['choc'] = 'Schokolade';
$lang_plugin_enlargeit['plugin_configuration'] = 'Plugin Einstellungen';
$lang_plugin_enlargeit['enlargement_type'] = 'Vergrößerungsart';
$lang_plugin_enlargeit['animation_type'] = 'Animationsart';
$lang_plugin_enlargeit['milliseconds'] = 'Millisekunden';
$lang_plugin_enlargeit['zero_to_disable'] = '0 zum deaktivieren';
$lang_plugin_enlargeit['border'] = 'Rahmen';
$lang_plugin_enlargeit['toggle_color_picker'] = 'Farbwähler an/aus';
$lang_plugin_enlargeit['mozilla_only'] = 'Nur für Mozilla/Safari';
$lang_plugin_enlargeit['shadow'] = 'Schatten';
$lang_plugin_enlargeit['right_bottom'] = 'nach rechts und unten';
$lang_plugin_enlargeit['title_bar'] = 'Titel-Leiste';
$lang_plugin_enlargeit['action'] = 'Aktion';
$lang_plugin_enlargeit['only_darken_when_image_shows'] = 'nur verdunkeln wenn das Bild angezeigt wird';
$lang_plugin_enlargeit['remain_dark_when_using_navigation'] = 'Dunkel bleiben während Navigationsvorgang';
$lang_plugin_enlargeit['darkening_speed_explain'] = '1 = sofort dunkel, 20 = langsame Dämmerung';
$lang_plugin_enlargeit['buttons'] = 'Buttons';
$lang_plugin_enlargeit['not_implemented_yet'] = 'Noch nicht implementiert';
$lang_plugin_enlargeit['for_all'] = 'für jedermann (Gäste und registrierte Benutzer)';
$lang_plugin_enlargeit['enable_for'] = 'Aktivieren für';
$lang_plugin_enlargeit['multimedia'] = 'Multimedia';
$lang_plugin_enlargeit['os_flv'] = 'OS FLV';
$lang_plugin_enlargeit['rphmedia'] = 'RphMedia';
$lang_plugin_enlargeit['no_changes'] = 'Entweder gab es keine Veränderungen oder die Veränderungen waren ungültig';
$lang_plugin_enlargeit['recommended'] = 'empfohlen';
$lang_plugin_enlargeit['not_recommended'] = 'nicht empfohlen';
$lang_plugin_enlargeit['description'] = 'Web 2.0 Benutzerinterface für Coppermine 1.5.x zum nahtlosen Öffnen der eingebetteten Bilder innerhalb der Thumbnail-Seite, mit optionaler Abdunklung der Umgebung und detailierten Plugin-Einstellungsmöglichkeiten.';
$lang_plugin_enlargeit['install_info'] = 'Zur Konfiguration des Plugins nach der Installation den entsprechenden Knopf auf der Plugin-Manager Seite benutzen. Um die Plugins "ImageFlow" oder "Slider" zusammen mit EnlargeIt! zu nutzen sind diese separat zu installieren und in deren Einstellungs-Seiten die entsprechenden Optionen zu aktivieren.';
$lang_plugin_enlargeit['extra_info'] = 'Dieses Plugin ist derzeit in Alpha-Stadium. Nicht alle Features funktionieren, spezielle nicht die Ajax-Komponenten. Danke für Dein Verständnis.';
$lang_plugin_enlargeit['announcement_thread'] = 'Ankündigungs-Thread';
$lang_plugin_enlargeit['enlargeit_configuration'] = 'EnlargeIt! Einstellungen';
$lang_plugin_enlargeit['plugin_setup'] = 'Plugin Setup';
$lang_plugin_enlargeit['display_plugin_config_in_admin_menu'] = 'Zeige einen Link zur Konfiguration dieses Plugins im Admin-Menü';
$lang_plugin_enlargeit['not_a_valid_extension'] = '%s ist keine gültige Datei-Erweiterung';
$lang_plugin_enlargeit['gd_version'] = 'GD-Version: %s';
$lang_plugin_enlargeit['not_available'] = 'nicht verfügbar';
$lang_plugin_enlargeit['file_cache_x_files_using_x_bytes'] = 'Datei-Cache: %s Dateien verbrauchen %s an Speicherplatz';
$lang_plugin_enlargeit['histogram_cache_file_lifetime'] = 'Speicherdauer von Dateien im Histgramm-Cache';
$lang_plugin_enlargeit['unlimited'] = 'unbegrenzt';
$lang_plugin_enlargeit['days'] = 'Tage';
$lang_plugin_enlargeit['max_file_size_total'] = 'Maximale Summe der Datei-Grösse';
$lang_plugin_enlargeit['maximize_method'] = 'Vergößerungs-Methode für Vollbilder';
$lang_plugin_enlargeit['preview'] = 'Vorschau';
$lang_plugin_enlargeit['image_formats'] = 'Bild-Formate';
$lang_plugin_enlargeit['video_formats'] = 'Video-Formate';
$lang_plugin_enlargeit['jpg'] = 'Grafik-Datei der Joint Photography Experts Group'; 
$lang_plugin_enlargeit['jpeg'] = 'Grafik-Datei der Joint Photography Experts Group'; 
$lang_plugin_enlargeit['jpe'] = 'Grafik-Datei der Joint Photography Experts Group'; 
$lang_plugin_enlargeit['png'] = 'Portable Network Graphics';
$lang_plugin_enlargeit['gif'] = 'Graphics Interchange Format';
$lang_plugin_enlargeit['bmp'] = 'BitMap Picture';
$lang_plugin_enlargeit['jpc'] = 'Japan PIC';
$lang_plugin_enlargeit['jp2'] = 'JPEG 2000 Bild-Datei'; 
$lang_plugin_enlargeit['jpx'] = 'JPEG 2000 Bild-Datei'; 
$lang_plugin_enlargeit['jb2'] = 'JBIG2 Bitmap-Grafik'; 
$lang_plugin_enlargeit['swc'] = 'Flex Komponenten-Archiv';
$lang_plugin_enlargeit['swf'] = 'Shockwave Flash';
$lang_plugin_enlargeit['ytb'] = 'YouTube Video';
$lang_plugin_enlargeit['dvx'] = 'DivX Video';
$lang_plugin_enlargeit['flv'] = 'Flash Video-Datei';
$lang_plugin_enlargeit['download'] = 'Download';
$lang_plugin_enlargeit['enlargeit_documentation'] = 'EnlargeIt! Dokumentation';
$lang_plugin_enlargeit['shadow_color'] = 'Schattenfarbe';
?>