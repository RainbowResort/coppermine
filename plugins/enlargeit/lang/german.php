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
$lang_plugin_enlargeit['submit_button'] = 'Speichern';
$lang_plugin_enlargeit['enl_pictype'] = 'Vergrößern auf Bild in';
$lang_plugin_enlargeit['enl_normalsize'] = 'Normalgröße';
$lang_plugin_enlargeit['enl_fullsize'] = 'voller Größe';
$lang_plugin_enlargeit['enl_forcenormal'] = 'Normalgröße erzwingen';
$lang_plugin_enlargeit['enl_ani'] = 'Art der Animation';
$lang_plugin_enlargeit['noani'] = 'keine';
$lang_plugin_enlargeit['fade'] = 'ein-/ausblenden';
$lang_plugin_enlargeit['glide'] = 'gleiten';
$lang_plugin_enlargeit['bumpglide'] = 'hüpfgleiten';
$lang_plugin_enlargeit['smoothglide'] = 'sanft gleiten';
$lang_plugin_enlargeit['expglide'] = 'hart gleiten';
$lang_plugin_enlargeit['topglide'] = 'von oben gleiten';
$lang_plugin_enlargeit['leftglide'] = 'von links gleiten';
$lang_plugin_enlargeit['topleftglide'] = 'von oben links gleiten';
$lang_plugin_enlargeit['enl_speed'] = 'Zeit zwischen den Animationsschritten';
$lang_plugin_enlargeit['enl_maxstep'] = 'Zahl der Animationsschritte';
$lang_plugin_enlargeit['enl_brdsize'] = 'Rahmendicke';
$lang_plugin_enlargeit['enl_brdbck'] = 'Rahmentextur';
$lang_plugin_enlargeit['enl_brdcolor'] = 'Rahmenfarbe';
$lang_plugin_enlargeit['enl_brdround'] = 'Rahmen abrunden (nur Mozilla/Safari)';
$lang_plugin_enlargeit['enl_shadow'] = 'Schatten unter Rahmen';
$lang_plugin_enlargeit['enl_shadowsize'] = 'Schattengröße rechts/unten';
$lang_plugin_enlargeit['enl_shadowintens'] = 'Deckkraft des Schattens';
$lang_plugin_enlargeit['enl_titlebar'] = 'Titelleiste auch ohne Buttons zeigen';
$lang_plugin_enlargeit['enl_titletxtcol'] = 'Textfarbe der Titelleiste';
$lang_plugin_enlargeit['enl_ajaxcolor'] = 'Hintergrundfarbe AJAX-Bereich';
$lang_plugin_enlargeit['enl_center'] = 'Vergrößertes Bild zentrieren';
$lang_plugin_enlargeit['enl_dark'] = 'Bildschirm nach vergrößern abdunkeln (nur 1 Bild gleichzeitig)';
$lang_plugin_enlargeit['enl_darkprct'] = 'Stärke der Abdunkelung';
$lang_plugin_enlargeit['enl_buttonpic'] = 'Button \'Zurück zum Bild\' anzeigen';
$lang_plugin_enlargeit['enl_tooltippic'] = 'Bild anzeigen';
$lang_plugin_enlargeit['enl_buttoninfo'] = 'Button \'Info\' anzeigen';
$lang_plugin_enlargeit['enl_buttoninfoyes1'] = 'Ja (AJAX Schnippsel)';
$lang_plugin_enlargeit['enl_buttoninfoyes2'] = 'Ja (öffne Seite)';
$lang_plugin_enlargeit['enl_tooltipinfo'] = 'Info anzeigen';
$lang_plugin_enlargeit['enl_buttonfav'] = 'Button \'Favoriten\' anzeigen';
$lang_plugin_enlargeit['enl_tooltipfav'] = 'Favoriten';
$lang_plugin_enlargeit['enl_buttoncomment'] = 'Button \'Kommentar\' anzeigen';
$lang_plugin_enlargeit['enl_tooltipcomment'] = 'Kommentieren';
$lang_plugin_enlargeit['enl_buttonhist'] = 'Button \'Histogramm\' anzeigen';
$lang_plugin_enlargeit['enl_tooltiphist'] = 'Histogramm';
$lang_plugin_enlargeit['enl_buttonvote'] = 'Button \'Bewerten\' anzeigen';
$lang_plugin_enlargeit['enl_tooltipvote'] = 'Bewerten';
$lang_plugin_enlargeit['enl_buttonmax'] = 'Button \'Maximieren\' anzeigen';
$lang_plugin_enlargeit['enl_tooltipmax'] = 'Volle Groesse';
$lang_plugin_enlargeit['enl_buttonclose'] = 'Button \'Schließen\' anzeigen';
$lang_plugin_enlargeit['enl_buttondownload'] = 'Button \'Download\' anzeigen';
$lang_plugin_enlargeit['enl_tooltipdownload'] = 'Datei herunterladen';
$lang_plugin_enlargeit['enl_clickdownload'] = 'Hier klicken um die Datei herunterzuladen';
$lang_plugin_enlargeit['enl_tooltipclose'] = 'Schliessen [Esc]';
$lang_plugin_enlargeit['enl_buttonnav'] = 'Buttons \'Navigation\' anzeigen';
$lang_plugin_enlargeit['enl_tooltipprev'] = 'Vorheriges Bild [linke Pfeiltaste]';
$lang_plugin_enlargeit['enl_tooltipnext'] = 'Naechstes Bild [rechte Pfeiltaste]';
$lang_plugin_enlargeit['enl_adminmode'] = 'EnlargeIt! im Admin-Modus aktivieren';
$lang_plugin_enlargeit['enl_registeredmode'] = 'EnlargeIt! für registrierte Besucher aktivieren';
$lang_plugin_enlargeit['enl_guestmode'] = 'EnlargeIt! für anonyme Besucher aktivieren';
$lang_plugin_enlargeit['enl_sefmode'] = 'SEF-Unterstützung aktivieren';
$lang_plugin_enlargeit['enl_addedtofav'] = 'Das Bild wurde zu den Favoriten hinzugefügt.';
$lang_plugin_enlargeit['enl_removedfromfav'] = 'Das Bild wurde von den Favoriten entfernt.';
$lang_plugin_enlargeit['enl_showfav'] = 'Meine Favoriten anzeigen';
$lang_plugin_enlargeit['enl_maxforreg'] = 'Ja, aber nicht für anonyme Gäste';
$lang_plugin_enlargeit['enl_maxpopup'] = 'Ja, als Pop-Up';
$lang_plugin_enlargeit['enl_maxpopupforreg'] = 'Ja, als Pop-Up aber nicht für anonyme Gäste';
$lang_plugin_enlargeit['enl_dragdrop'] = 'Vergrösserte Bilder mit der Maus verschiebbar (Drag & Drop)';
$lang_plugin_enlargeit['enl_darkensteps'] = 'Zahl der Schritte beim Abdunkeln (1 = sofort)';
$lang_plugin_enlargeit['enl_cantcomment'] = 'Es gibt noch keine Kommentare, und Du hast nicht das Recht, einen hinzuzufügen!';
$lang_plugin_enlargeit['enl_wheelnav'] = 'Mausrad-Navigation';
$lang_plugin_enlargeit['enl_canceltext'] = 'Klicken, um das Laden des Bildes abzubrechen';
$lang_plugin_enlargeit['enl_noflashfound'] = 'Um diese Datei anzusehen wird das Flash Plugin benötigt';
$lang_plugin_enlargeit['enl_flvplayer'] = 'Welcher FLV player soll benutzt werden';
$lang_plugin_enlargeit['enl_buttonbbcode'] = 'Button \'BBCode\' anzeigen';
$lang_plugin_enlargeit['enl_tooltipbbcode'] = 'BBCode';
$lang_plugin_enlargeit['enl_copytoclipbrd'] = 'In Zwischenablage kopieren';
$lang_plugin_enlargeit['enl_opaglide'] = 'Transparenzeffekt für Gleit-Animation';

?>