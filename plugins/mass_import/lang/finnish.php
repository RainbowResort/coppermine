<?php
/*************************
  mass_import Plugin for cpg1.5.x
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

if (!defined('IN_COPPERMINE')) { 
    die('Not in Coppermine...');
}

$lang_plugin_mass_import['name'] = 'Mass Import'; // Display Name
$lang_plugin_mass_import['admin_title'] = 'Massa Tuonti'; // Title of the button on the gallery admin menu
$lang_plugin_mass_import['description'] = 'Massa Tuonti -lisäosä mahdollistaa pääkäyttäjälle tuoda suuren määrän kuvia, jotka ovat järjestetty kansioihin.';
$lang_plugin_mass_import['subdir_desc'] = 'Alakansio (albumien sisällä) tai tyhjä';
$lang_plugin_mass_import['sleep_desc'] = 'Tauko lisäysten välillä';
$lang_plugin_mass_import['in_milliseconds'] = 'millisekunteina';
$lang_plugin_mass_import['hardlimit_desc'] = 'Rajoita lisäysten määrää per lataus';
$lang_plugin_mass_import['autorun_desc'] = 'Aja automaattisesti';
$lang_plugin_mass_import['skipping'] = 'Skipataan esikatselukuvat ja normaalin kokoiset kuvat';
$lang_plugin_mass_import['file_already_in_database'] = 'Tiedosto on jo olemassa tietokannassa';
$lang_plugin_mass_import['file_added_to_database'] = 'Tiedosto lisätty tietokantaan';
$lang_plugin_mass_import['failed_to_add_file_to_database'] = 'Tiedoston lisäys tietokantaan epäonnistui';
$lang_plugin_mass_import['root_create'] = 'Luotiin pääkategoria';
$lang_plugin_mass_import['root_exists'] = 'Pääkategoria on jo olemassa';
$lang_plugin_mass_import['root_use'] = 'Käytetään pääkategoriaa';
$lang_plugin_mass_import['album_exists'] = 'Albumi on jo olemassa';
$lang_plugin_mass_import['album_create'] = 'Luotiin albumi';
$lang_plugin_mass_import['cat_exists'] = 'Kategoria on jo olemassa';
$lang_plugin_mass_import['cat_create'] = 'Luotiin kategoria';
$lang_plugin_mass_import['pics_found'] = 'Tiedostot löytyivät';
$lang_plugin_mass_import['pics_indb'] = 'Tiedostot tietokannassa';
$lang_plugin_mass_import['pics_afterfilter'] = 'Suodatuksen jälkeen lisättävät tiedostot';
$lang_plugin_mass_import['structure_created'] = 'Luotiin struktuuri';
$lang_plugin_mass_import['files_added'] = 'Tiedostot lisätty';
$lang_plugin_mass_import['files_to_add'] = 'Käsiteltävät tiedostot';
$lang_plugin_mass_import['path'] = 'Polku';

?>
