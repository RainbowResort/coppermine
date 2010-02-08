<?php 


if (!defined('IN_COPPERMINE')) { 
    die('Not in Coppermine...'); 
}
//language variables


$flf_lang_var['display_name'] = 'flf histotag';
$flf_lang_var['window_title'] = 'powered by flf histotag';
$flf_lang_var['click_link'] = 'Ort der Aufnahme anzeigen';
$flf_lang_var['no_data'] = 'Für diese Aufnahme liegen keine Geodaten vor.';
$flf_lang_var['histo_click_link'] = 'Histogramm anzeigen';
$flf_lang_var['histo_no_data'] = 'Für diese Aufnahme liegt kein Histogramm vor.';
$flf_lang_var['notice'] = 'powered by flf histotag plugin -- www.lounge-lizard.org';
$flf_lang_var['create'] = 'Erzeuge alle EXIF-Daten neu';
$flf_lang_var['configuretitle'] = 'Konfigurieren Sie die Einstellungen des flf histotag plugin';
$flf_lang_var['mapwidth'] = 'Breite in px';
$flf_lang_var['mapheight'] = 'Höhe in px';
$flf_lang_var['configmap'] = 'Grösse der Map';
$flf_lang_var['configmapbox'] = 'Grösse des Popup Fensters';
$flf_lang_var['setapi'] = 'Geben Sie Ihren persönlichen Google maps API key ein';
$flf_lang_var['apikey'] = 'API key';
$flf_lang_var['submit'] = 'speichern';
$flf_lang_var['histowidth'] = 'Breite des Histogramms';
$flf_lang_var['col'] = 'Farbe';
$flf_lang_var['histcol'] = 'Hintergrundfarbe des Histogramms';
$flf_lang_var['type'] = 'Art';
$flf_lang_var['histtype'] = 'Art des Histogramms';
$flf_lang_var['createhistograms'] = 'Erzeuge Histogramme fuer alle Bilder in Datenbank';
$flf_lang_var['createallhistograms_success'] = 'Histogramme erzeugt und gespeichert';
$flf_lang_var['histo_on_the_fly'] = 'Bei jedem Bild Histogramm anzeigen (wird ggf. vor Aufruf erstmalig erzeugt).';
$flf_lang_var['config'] = 'flf histotag Einstellungen';
$flf_lang_var['toggle_color_picker'] = 'Farbwähler an/aus';
$flf_lang_var['histo_quality'] = 'Qualität des Histogramms in %';
$flf_lang_var['histo_type_separate'] = 'separat je Farbkanal';
$flf_lang_var['histo_type_combined'] = 'kombiniert mit Überlagerung';
$flf_lang_var['changes_saved'] = 'Änderungen wurden gespeichert.';
$flf_lang_var['no_changes'] = 'Es gab keine Änderungen oder die eingegebenen Änderungen waren ungültig.';
$flf_lang_var['configure_geo'] = 'Einstellungen für die Geotagging-Unterstützung';
$flf_lang_var['configure_histo'] = 'Einstellungen für die Histogramm-Unterstützung';
$flf_lang_var['maptype'] = 'Kartendarstellung';
$flf_lang_var['maptype_1'] = 'Satellitenbild';
$flf_lang_var['maptype_2'] = 'Normale Straßenkarte';
$flf_lang_var['maptype_3'] = 'Hybridansicht';
$flf_lang_var['maptype_4'] = 'Topographische Karte';
$flf_lang_var['maptype_5'] = 'Satellitenansicht mit 3D-Darstellung (nur mit Google Earth Plugin; nicht alle Browser)';
$flf_lang_var['geosupport'] = 'Anzeige der Schaltfläche in der Navigationsleiste';
$flf_lang_var['geosupport_1'] = 'immer (Zeigt inaktive Schaltfläche, falls keine Geodaten vorhanden)';
$flf_lang_var['geosupport_2'] = 'nur bei vorhandenen Geodaten';
$flf_lang_var['geosupport_3'] = 'niemals (schaltet den Geotag-Support von flf_histotag ab)';
$flf_lang_var['histosupport'] = 'Anzeige der Schaltfläche in der Navigationsleiste';
$flf_lang_var['histosupport_1'] = 'immer (Zeigt inaktive Schaltfläche, falls kein Histogramm vorhanden)';
$flf_lang_var['histosupport_2'] = 'immer (generiert fehlende Histogramme bei Anzeige automatisch)';
$flf_lang_var['histosupport_3'] = 'nur bei vorhandenem Histogramm';
$flf_lang_var['histosupport_4'] = 'niemals (schaltet den Histogramm-Support von flf_histotag ab)';
$flf_lang_var['createonupload'] = 'Histogramm beim Hochladen neuer Bilder automatisch erzeugen';
$flf_lang_var['activated']='aktiviert';
$flf_lang_var['generateallheader'] = 'flf histotag - Ermittle alle Geopositionen';
$flf_lang_var['createall']=' Bilder waren noch nicht in der Datenbank enthalten und wurden überprüft.';
$flf_lang_var['contained_geo']= ' Bilder enthielten Geodaten.';
$flf_lang_var['createall_success'] = 'Die Werte wurden in der Datenbank gespeichert.';
$flf_lang_var['name'] = 'flf histotag - Geotagging und Histogramm-Anzeige für Coppermine';
$flf_lang_var['description'] = 'Bietet Unterstützung für Geotags incl. Link zu Google Maps. Zusätzlich besteht die Möglichkeit, Histogramme zu generieren';
$flf_lang_var['config']='Plugin Konfiguration';
$flf_lang_var['readme']='Readme-Datei anzeigen';
$flf_lang_var['getallgeo']='Alle Bilder nach Geotag-Daten durchsuchen';
$flf_lang_var['getallhistos']='Für alle Bilder Histogramme erzeugen';
$flf_lang_var['supportthread']='Thread zu diesem Plugin im Coppermine-Forum';
$flf_lang_var['deleteallhistograms']='Alle Histogramme löschen';
$flf_lang_var['deleteallhistograms_success'] = 'Histogramme wurden gelöscht';
?>