<?php
/**************************************************
  Coppermine 1.5.x Plugin - Geo IP Lookup (geoip)
  *************************************************
  Copyright (c) 2010 Joachim Müller
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

//Language file strings
$lang_plugin_geoip['plugin_name'] = 'Geo IP Lookup';
$lang_plugin_geoip['plugin_description'] = 'Busca los países de los visitantes usando su IP y muestra el icono de su bandera junto a la dirección IP (funcionalidad sólo para administradores).';
$lang_plugin_geoip['plugin_details'] = 'La búsqueda no tiene precisión 100%, pero debería ser correcta para la mayoría de los casos. La búsqueda en base de datos consumirá ciclos extra de CPU, por lo que no es recomendable instalar este plugin si tu servidor no tiene recursos suficientes.';
$lang_plugin_geoip['announcement_thread'] = 'Hebra de anuncio en el foro';
$lang_plugin_geoip['plugin_code'] = 'Plugin code';
$lang_plugin_geoip['api_and_database'] = 'API y la base de datos';
$lang_plugin_geoip['released_under_gnu_gpl'] = 'liberados bajo licencia GNU GPL';
$lang_plugin_geoip['city_lookup'] = 'To enable the IP address lookup by city, you need to download an %s, un-archive it and upload it to your webserver into the folder that corresponds to %s, which will eat up approximately 30 MB of extra webspace. The additional file hasn\'t been bundled with the plugin for file space saving reasons.';
$lang_plugin_geoip['additional_file'] = 'additional file';
$lang_plugin_geoip['download_city_database'] = 'Download additional GeoLite City file';
$lang_plugin_geoip['configure_plugin'] = 'Configure plugin %s';
$lang_plugin_geoip['update_success'] = 'Configuration has been updated successfully; your changes have been saved.';
$lang_plugin_geoip['no_changes'] = 'There have been no changes';
$lang_plugin_geoip['scope'] = 'Scope of the IP address lookup';
$lang_plugin_geoip['country'] = 'by country';
$lang_plugin_geoip['city'] = 'on city level';
?>