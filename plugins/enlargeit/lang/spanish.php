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
$lang_plugin_enlargeit['display_name'] = 'Plugin EnlargeIt!';
$lang_plugin_enlargeit['update_success'] = 'Los valores han sido actualizados con exito';
$lang_plugin_enlargeit['main_title'] = 'Plugin EnlargeIt!';
$lang_plugin_enlargeit['pluginmanager'] = 'Plugin Manager';
$lang_plugin_enlargeit['submit_button'] = 'Enviar';
$lang_plugin_enlargeit['enl_pictype'] = 'Ampliar la imagen como';
$lang_plugin_enlargeit['enl_normalsize'] = 'Dimension intermedia';
$lang_plugin_enlargeit['enl_fullsize'] = 'Dimension original';
$lang_plugin_enlargeit['enl_forcenormal'] = 'Forzar dimension intermedia';
$lang_plugin_enlargeit['enl_ani'] = 'Animacion';
$lang_plugin_enlargeit['noani'] = 'ninguna';
$lang_plugin_enlargeit['fade'] = 'fade in/out';
$lang_plugin_enlargeit['glide'] = 'Planeo';
$lang_plugin_enlargeit['bumpglide'] = 'Planeo de golpe';
$lang_plugin_enlargeit['smoothglide'] = 'Planeo suave';
$lang_plugin_enlargeit['expglide'] = 'planeo duro';
$lang_plugin_enlargeit['topglide'] = 'glide from top';
$lang_plugin_enlargeit['leftglide'] = 'glide from left';
$lang_plugin_enlargeit['topleftglide'] = 'glide from top left';
$lang_plugin_enlargeit['enl_speed'] = 'Tiempo entre pasos de animacion';
$lang_plugin_enlargeit['enl_maxstep'] = 'Pasos de animacion';
$lang_plugin_enlargeit['enl_brdsize'] = 'Expesor del borde';
$lang_plugin_enlargeit['enl_brdbck'] = 'Textura del borde';
$lang_plugin_enlargeit['enl_brdcolor'] = 'Color del borde';
$lang_plugin_enlargeit['enl_brdround'] = 'Borde redondo (Solo Mozilla/Safari)';
$lang_plugin_enlargeit['enl_shadow'] = 'Usar borde con sombra';
$lang_plugin_enlargeit['enl_shadowsize'] = 'Dimension de la sombra derecha/abajo';
$lang_plugin_enlargeit['enl_shadowintens'] = 'Opacidad de la sombra';
$lang_plugin_enlargeit['enl_titlebar'] = 'Mostrar la barra de titulo cuando no hayan botones activos';
$lang_plugin_enlargeit['enl_titletxtcol'] = 'Color del texto de la barra de titulo';
$lang_plugin_enlargeit['enl_ajaxcolor'] = 'Color de fondo de la zona AJAX';
$lang_plugin_enlargeit['enl_center'] = 'Centrar imagen ampliada';
$lang_plugin_enlargeit['enl_dark'] = 'Oscurecer la pantalla cuando se use ampliada (solo 1 foto a la vez)';
$lang_plugin_enlargeit['enl_darkprct'] = 'Fuerza del oscurecimiento';
$lang_plugin_enlargeit['enl_buttonpic'] = 'Mostrar boton \'Mostrar imagen\'';
$lang_plugin_enlargeit['enl_tooltippic'] = 'Mostrar imagen';
$lang_plugin_enlargeit['enl_buttoninfo'] = 'Mostrar boton \'Informacion de la imagen\'';
$lang_plugin_enlargeit['enl_buttoninfoyes1'] = 'si (abrir como fragmento AJAX)';
$lang_plugin_enlargeit['enl_buttoninfoyes2'] = 'si (abrir pagina intermedia)';
$lang_plugin_enlargeit['enl_tooltipinfo'] = 'Mostrar informacion de la imagen';
$lang_plugin_enlargeit['enl_buttondownload'] = 'Show button \'Download\'';
$lang_plugin_enlargeit['enl_tooltipdownload'] = 'Download this file';
$lang_plugin_enlargeit['enl_clickdownload'] = 'Click here to download this file';
$lang_plugin_enlargeit['enl_buttonfav'] = 'Mostrar boton \'Favoritos\'';
$lang_plugin_enlargeit['enl_tooltipfav'] = 'Favoritos';
$lang_plugin_enlargeit['enl_buttoncomment'] = 'Mostrar boton \'Comentarios\'';
$lang_plugin_enlargeit['enl_tooltipcomment'] = 'Comentarios';
$lang_plugin_enlargeit['enl_buttonhist'] = 'Mostrar boton \'Histograma (experimental)\'';
$lang_plugin_enlargeit['enl_tooltiphist'] = 'Histograma';
$lang_plugin_enlargeit['enl_buttonvote'] = 'Mostrar boton \'Votar\'';
$lang_plugin_enlargeit['enl_tooltipvote'] = 'Votar';
$lang_plugin_enlargeit['enl_buttonmax'] = 'Mostrar boton \'Maximizar\'';
$lang_plugin_enlargeit['enl_tooltipmax'] = 'Maximizar';
$lang_plugin_enlargeit['enl_maxforreg'] = 'Si, pero no para usuarios anonimos';
$lang_plugin_enlargeit['enl_maxpopup'] = 'Si, como ventana pop-up';
$lang_plugin_enlargeit['enl_maxpopupforreg'] = 'Si, como pop-up pero no para usuarios anonimos';
$lang_plugin_enlargeit['enl_buttonclose'] = 'Mostrar boton \'Cerrar ventana\'';
$lang_plugin_enlargeit['enl_tooltipclose'] = 'Cerrar ventana [Esc]';
$lang_plugin_enlargeit['enl_buttonnav'] = 'Mostrar botones \'Navegacion\'';
$lang_plugin_enlargeit['enl_tooltipprev'] = 'Imagen anterior [tecla de la flecha izquierda]';
$lang_plugin_enlargeit['enl_tooltipnext'] = 'Imagen siguiente [tecla de la flecha derecha]';
$lang_plugin_enlargeit['enl_adminmode'] = 'Habilitar EnlargeIt! en modo admin';
$lang_plugin_enlargeit['enl_registeredmode'] = 'Habilitar EnlargeIt! para usuarios registrados';
$lang_plugin_enlargeit['enl_guestmode'] = 'Habilitar EnlargeIt! para invitados';
$lang_plugin_enlargeit['enl_sefmode'] = 'Habilitar soporte SEF';
$lang_plugin_enlargeit['enl_addedtofav'] = 'La imagen ha sido agregada a tus favoritos.';
$lang_plugin_enlargeit['enl_removedfromfav'] = 'La imagen ha sido eliminada de tus favoritos.';
$lang_plugin_enlargeit['enl_showfav'] = 'Mostrarme mis favoritos';
$lang_plugin_enlargeit['enl_dragdrop'] = 'Arrastrar y soltar imagenes ampliadas';
$lang_plugin_enlargeit['enl_darkensteps'] = 'Pasos para el oscurecimiento (1 = inmediatamente)';
$lang_plugin_enlargeit['enl_cantcomment'] = 'No hay ningun comentario todavia, y no se le permite agregar uno hasta que no se identifique!';
$lang_plugin_enlargeit['enl_wheelnav'] = 'Navegacion con la rueda del raton';

?>