<?php
/**************************************************
  Coppermine 1.5.x Plugin - thumb_rotate
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

$lang_plugin_thumb_rotate['config_name'] = 'Thumb Rotate';
$lang_plugin_thumb_rotate['config_description'] = 'Stellt Thumbnails leicht verdreht dar, wie in einem Comic.'; 
$lang_plugin_thumb_rotate['resources_warning'] = 'Die gedrehten Thumbnails werden zwischengespeichert. Trotzdem geht dieses Plugin ein wenig verschwenderisch mit der Rechenleistung auf dem Server um und sollte deshalb nicht in großen Galerien oder auf langsamen Servern eingesetzt werden. Wenn es zu Leistungsproblemen kommen sollte, dann schalte dieses Plugin ab! Dieses Plugin befindet sich derzeit bestenfalls im Beta-Stadium.';
$lang_plugin_thumb_rotate['config_details'] = 'Du kannst den Maximalgrad der Drehung und die Hintergrundfarbe der durch das Plugin erzeugten Thumbnails in dem Einstellungs-Dialog des Plugins konfigurieren.';
$lang_plugin_thumb_rotate['config'] = 'Thumb Rotate Einstellungen';
$lang_plugin_thumb_rotate['minimum_requirements'] = 'Mindestanforderungen';
$lang_plugin_avatar_create['minimum requirements_summary'] = 'Dieses Plugin benötigt PHP 4.3.2 oder besser und ein lauffähiges GD2-Modul.';
$lang_plugin_thumb_rotate['minimum_requirements_ok'] = 'Erfolgreich: Deine Version von %s (%s) scheint gut genug zu sein.';
$lang_plugin_thumb_rotate['minimum_requirements_low'] = 'Fehlschlag: Deine Version von %s (%s) scheint nicht gut genug zu sein.';
$lang_plugin_thumb_rotate['minimum_requirements_unavailable'] = 'Fehlschlag: das GD-Modul scheint nicht vorhanden zu sein.';
$lang_plugin_thumb_rotate['minimum_requirements_imagerotate'] = 'Fehlschlag: die Funktion imagerotate scheint nicht vorhanden zu sein, so dass eine noch leistungshungrigere Alternative verwendet werden muss.';
$lang_plugin_thumb_rotate['continue_anyway'] = 'Trotzdem weitermachen?';
$lang_plugin_thumb_rotate['option_rounded_corners'] = 'Abgerundete Ecken';
$lang_plugin_thumb_rotate['option_rounded_corners_radius'] = 'Radius';
$lang_plugin_thumb_rotate['option_rotation'] = 'Drehung';
$lang_plugin_thumb_rotate['option_maxrotation'] = 'Drehwinkel';
$lang_plugin_thumb_rotate['option_rotation_method'] = 'Rotations-Methode';
$lang_plugin_thumb_rotate['option_rotation_method_random'] = 'zufällig';
$lang_plugin_thumb_rotate['option_rotation_method_fixed'] = 'fest';
$lang_plugin_thumb_rotate['option_bgcolor'] = 'Hintergrundfarbe Deines Themes';
$lang_plugin_thumb_rotate['option_border'] = 'Rahmen';
$lang_plugin_thumb_rotate['option_borderwidth'] = 'Rahmenbreite';
$lang_plugin_thumb_rotate['option_bordercolor'] = 'Rahmenfarbe';
$lang_plugin_thumb_rotate['option_admin_only'] = 'Nur für Admin sichtbar';
$lang_plugin_thumb_rotate['option_admin_only_explain'] = 'Zur Vorbereitung des Plugins im Hintergrund';
$lang_plugin_thumb_rotate['option_timelimit'] = 'Verzögerung bei Thumbnail-Erzeugung';
$lang_plugin_thumb_rotate['option_filetype'] = 'Datei-Art';
$lang_plugin_thumb_rotate['pixels'] = 'Pixel';
$lang_plugin_thumb_rotate['seconds'] = 'Sekunden';
$lang_plugin_thumb_rotate['zero_to_disable'] = '0 zum deaktivieren';
$lang_plugin_thumb_rotate['submit_to_install'] = 'Sende dieses Formular ab, um das Plugin zu installieren';
$lang_plugin_thumb_rotate['author'] = 'Ursprünglich geschrieben von %s, Neu-Programmierung durch %s, colorpicker jQuery Plugin &quot;Farbtastic&quot; von %s';
$lang_plugin_thumb_rotate['announcement_thread'] = 'Ankündigungs-Thread';
$lang_plugin_thumb_rotate['changes_saved'] = 'Deine Änderungen wurden gespeichert';
$lang_plugin_thumb_rotate['no_changes'] = 'Es gab keine Änderungen oder die eingegebenen Änderungen waren ungültig';
$lang_plugin_thumb_rotate['toggle_color_picker'] = 'Farbwähler ein/aus';
$lang_plugin_thumb_rotate['cache'] = 'Zwischenspeicher (Cache)';
$lang_plugin_thumb_rotate['empty_cache'] = 'Cache löschen';
$lang_plugin_thumb_rotate['cache_size'] = 'Zwischengespeicherte Dateien: %s von %s';
$lang_plugin_thumb_rotate['wait'] = 'Bitte warten, es müssen noch %s Einträge bearbeitet werden.';
$lang_plugin_thumb_rotate['preview'] = 'Vorschau';
$lang_plugin_thumb_rotate['no_preview_available'] = 'Keine Vorschau verfügbar - Cache ist leer.';
$lang_plugin_thumb_rotate['remove_settings'] = 'Einstellungen des Plugins aus der Datenbank löschen?';
$lang_plugin_thumb_rotate['batch_fill'] = 'Cache per Stapelverarbeitung füllen';
$lang_plugin_thumb_rotate['x_files_remaining'] = '%s Dateien verbleibend';
$lang_plugin_thumb_rotate['manual_control'] = 'Manuelle Steuerung';
$lang_plugin_thumb_rotate['cancel'] = 'Abbrechen';
$lang_plugin_thumb_rotate['manual_control_explain'] = 'nur klicken, um automatischen Ablauf zu unterbrechen oder beschleunigen';
?>