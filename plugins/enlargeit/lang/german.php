<?php
/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt! $VERSION$=0.4
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

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }
//language variables
$lang_enlargeit = array(
'display_name' => 'EnlargeIt! PlugIn',
'update_success' => 'Die Werte wurden erfolgreich aktualisiert',
'main_title' => 'EnlargeIt! PlugIn',
'version' => 'v0.4',
'pluginmanager' => 'Plugin Manager',
'enl_yes' => 'Ja',
'enl_no' => 'Nein',
'submit_button' => 'Speichern',
'enl_pictype' => 'Vergr&ouml;&szlig;ern auf Bild in',
'enl_normalsize' => 'Normalgr&ouml;&szlig;e',
'enl_fullsize' => 'voller Gr&ouml;&szlig;e',
'enl_forcenormal' => 'Normalgr&ouml;&szlig;e erzwingen',
'enl_ani' => 'Art der Animation',
'noani' => 'keine',
'fade' => 'ein-/ausblenden',
'glide' => 'gleiten',
'bumpglide' => 'h&uuml;pfgleiten',
'smoothglide' => 'sanft gleiten',
'expglide' => 'hart gleiten',
'topglide' => 'von oben gleiten',
'leftglide' => 'von links gleiten',
'topleftglide' => 'von oben links gleiten',
'enl_speed' => 'Zeit zwischen den Animationsschritten',
'enl_maxstep' => 'Zahl der Animationsschritte',
'enl_brd' => 'Rahmen verwenden',
'enl_brdsize' => 'Rahmendicke',
'enl_brdbck' => 'Rahmentextur',
'enl_brdcolor' => 'Rahmenfarbe',
'enl_brdround' => 'Rahmen abrunden (nur Mozilla/Safari)',
'enl_shadow' => 'Schatten unter Rahmen',
'enl_shadowsize' => 'Schattengr&ouml;&szlig;e rechts/unten',
'enl_shadowintens' => 'Deckkraft des Schattens',
'enl_titlebar' => 'Titelleiste auch ohne Buttons zeigen',
'enl_titletxtcol' => 'Textfarbe der Titelleiste',
'enl_ajaxcolor' => 'Hintergrundfarbe AJAX-Bereich',
'enl_center' => 'Vergr&ouml;&szlig;ertes Bild zentrieren',
'enl_dark' => 'Bildschirm nach vergr&ouml;&szlig;ern abdunkeln (nur 1 Bild gleichzeitig)',
'enl_darkprct' => 'St&auml;rke der Abdunkelung',
'enl_buttonpic' => 'Button \'Zur&uuml;ck zum Bild\' anzeigen',
'enl_tooltippic' => 'Bild anzeigen',
'enl_buttoninfo' => 'Button \'Info\' anzeigen',
'enl_buttoninfoyes1' => 'Ja (AJAX Schnippsel)',
'enl_buttoninfoyes2' => 'Ja (&ouml;ffne Seite)',
'enl_tooltipinfo' => 'Info anzeigen',
'enl_buttonfav' => 'Button \'Favoriten\' anzeigen',
'enl_tooltipfav' => 'Favoriten',
'enl_buttoncomment' => 'Button \'Kommentar\' anzeigen',
'enl_tooltipcomment' => 'Kommentieren',
'enl_buttonhist' => 'Button \'Histogramm\' anzeigen',
'enl_tooltiphist' => 'Histogramm',
'enl_buttonvote' => 'Button \'Bewerten\' anzeigen',
'enl_tooltipvote' => 'Bewerten',
'enl_buttonmax' => 'Button \'Maximieren\' anzeigen',
'enl_tooltipmax' => 'Volle Groesse',
'enl_buttonclose' => 'Button \'Schlie&szlig;en\' anzeigen',
'enl_buttondownload' => 'Button \'Download\' anzeigen',
'enl_tooltipdownload' => 'Datei herunterladen',
'enl_clickdownload' => 'Hier klicken um die Datei herunterzuladen',
'enl_tooltipclose' => 'Schliessen [Esc]',
'enl_buttonnav' => 'Buttons \'Navigation\' anzeigen',
'enl_tooltipprev' => 'Vorheriges Bild [linke Pfeiltaste]',
'enl_tooltipnext' => 'Naechstes Bild [rechte Pfeiltaste]',
'enl_adminmode' => 'EnlargeIt! im Admin-Modus aktivieren',
'enl_registeredmode' => 'EnlargeIt! f&uuml;r registrierte Besucher aktivieren',
'enl_guestmode' => 'EnlargeIt! f&uuml;r anonyme Besucher aktivieren',
'enl_sefmode' => 'SEF-Unterst&uuml;tzung aktivieren',
'enl_addedtofav' => 'Das Bild wurde zu den Favoriten hinzugef&uuml;gt.',
'enl_removedfromfav' => 'Das Bild wurde von den Favoriten entfernt.',
'enl_showfav' => 'Meine Favoriten anzeigen',
'enl_maxforreg' => 'Ja, aber nicht f&uuml;r anonyme G&auml;ste',
'enl_maxpopup' => 'Ja, als Pop-Up',
'enl_maxpopupforreg' => 'Ja, als Pop-Up aber nicht f&uuml;r anonyme G&auml;ste',
'enl_dragdrop' => 'Vergr&ouml;sserte Bilder mit der Maus verschiebbar (Drag & Drop)',
'enl_darkensteps' => 'Zahl der Schritte beim Abdunkeln (1 = sofort)',
'enl_cantcomment' => 'Es gibt noch keine Kommentare, und Sie haben nicht das Recht einen hinzuzuf&uuml;gen!',
'enl_wheelnav' => 'Mausrad-Navigation',
'enl_canceltext' => 'Klicken, um das Laden des Bildes abzubrechen',
'enl_noflashfound' => 'Um diese Datei anzusehen, brauchen Sie das Flash PlugIn von Adobe!',
'enl_flvplayer' => 'Welcher FLV player soll benutzt werden',
'enl_buttonbbcode' => 'Button \'BBCode\' anzeigen',
'enl_tooltipbbcode' => 'BBCode',
'enl_copytoclipbrd' => 'In Zwischenablage kopieren',
'enl_opaglide' => 'Transparenzeffekt f&uuml;r Gleit-Animation',
);
?>