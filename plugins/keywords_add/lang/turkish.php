<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2005 Coppermine Dev Team
  v1.1 originaly written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.4.8
  $Source: /cvsroot/cpg-contrib/master_template/codebase.php,v $
  $Revision: 1.3 $
  $Author: donnoman $
  $Date: 2005/12/08 05:46:49 $
**********************************************/
/**********************************************
Modified by Frantz for Keywords add plugin
2006/10/08
**********************************************/
/**********************************************
Turkish translation by Mywedding
**********************************************/
if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

$lang_plugin_keywords_add = array(
  'display_name'    => 'Kelime Ekle',			// Display Name
  'config_title'    => 'Kelime ekle düzenle',			// Title of the button on the gallery config menu
  'config_button'   => 'Kelime Ekle',				// Label of the button on the gallery config menu
  'install_note'    => 'Eklentiyi yönetici ayarlarındaki butondan ayarla.',	// Note about configuring plugin
  'install_click'   => 'Eklentiyi yüklemek için butona tikla.',	// Message to install plugin
  'version'         => 'Ver 1.0', // Curent plugin version
  'album_name'      => 'Kelime ekleyeceginiz albümü seciniz',
  'add_info'        => 'Kelimenizi asağıya ekleyin.',
  'keyword'	    => 'Kelime',
  'caution'         => 'Dikkat: kelime zaten kaydedilmisse,<br>icerik degismeyecekse boş birakin.',
);

$lang_plugin_keywords_add_config = array(
  'status'        => 'Eklenti durumu',
  'button_install'=> 'Yükle',
  'button_submit' => 'Ekle',
);

// Delete
$lang_plugin_keywords_add_delete= array(
  'success'       => 'Kelimeler basariyla yüklendi',
 );
?>