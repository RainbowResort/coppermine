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
$lang_plugin_geoip['announcement_thread'] = 'Anuncio en el foro';
$lang_plugin_geoip['plugin_code'] = 'Código del plugin';
$lang_plugin_geoip['api_and_database'] = 'API y la base de datos';
$lang_plugin_geoip['released_under_gnu_gpl'] = 'liberados bajo licencia GNU GPL';
$lang_plugin_geoip['city_lookup'] = 'Para activar la búsqueda de IPs por ciudades, debes descargar un %s, descomprimirlo y subirlo a tu servidor Web en el directorio que corresponde a %s, y ocupará aproximadamente 30Mb de espacio Web extra. Este archivo no se incluye en el plugin para no engordar innecesariamente esta descarga si no vas a buscar por ciudad.';
$lang_plugin_geoip['additional_file'] = 'archivo adicional';
$lang_plugin_geoip['download_city_database'] = 'Descargar adicionalmente el archivo GeoLite City';
$lang_plugin_geoip['configure_plugin'] = 'Configurar el plugin %s';
$lang_plugin_geoip['update_success'] = 'La configuración se ha modificado con éxito: se han guardado tus cambios.';
$lang_plugin_geoip['no_changes'] = 'No ha cambiado nada';
$lang_plugin_geoip['scope'] = 'Discriminación de la búsqueda de dirección IP';
$lang_plugin_geoip['country'] = 'por países';
$lang_plugin_geoip['city'] = 'por ciudades';
?>