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
'display_name' => 'Plugin EnlargeIt!',
'update_success' => 'Los valores han sido actualizados con exito',
'main_title' => 'Plugin EnlargeIt!',
'version' => 'v0.4',
'pluginmanager' => 'Plugin Manager',
'enl_yes' => 'si',
'enl_no' => 'no',
'submit_button' => 'Enviar',
'enl_pictype' => 'Ampliar la imagen como',
'enl_normalsize' => 'Dimension intermedia',
'enl_fullsize' => 'Dimension original',
'enl_forcenormal' => 'Forzar dimension intermedia',
'enl_ani' => 'Animacion',
'noani' => 'ninguna',
'fade' => 'fade in/out',
'glide' => 'Planeo',
'bumpglide' => 'Planeo de golpe',
'smoothglide' => 'Planeo suave',
'expglide' => 'planeo duro',
'topglide' => 'glide from top',
'leftglide' => 'glide from left',
'topleftglide' => 'glide from top left',
'enl_speed' => 'Tiempo entre pasos de animacion',
'enl_maxstep' => 'Pasos de animacion',
'enl_brd' => 'Usar borde',
'enl_brdsize' => 'Expesor del borde',
'enl_brdbck' => 'Textura del borde',
'enl_brdcolor' => 'Color del borde',
'enl_brdround' => 'Borde redondo (Solo Mozilla/Safari)',
'enl_shadow' => 'Usar borde con sombra',
'enl_shadowsize' => 'Dimension de la sombra derecha/abajo',
'enl_shadowintens' => 'Opacidad de la sombra',
'enl_titlebar' => 'Mostrar la barra de titulo cuando no hayan botones activos',
'enl_titletxtcol' => 'Color del texto de la barra de titulo',
'enl_ajaxcolor' => 'Color de fondo de la zona AJAX',
'enl_center' => 'Centrar imagen ampliada',
'enl_dark' => 'Oscurecer la pantalla cuando se use ampliada (solo 1 foto a la vez)',
'enl_darkprct' => 'Fuerza del oscurecimiento',
'enl_buttonpic' => 'Mostrar boton \'Mostrar imagen\'',
'enl_tooltippic' => 'Mostrar imagen',
'enl_buttoninfo' => 'Mostrar boton \'Informacion de la imagen\'',
'enl_buttoninfoyes1' => 'si (abrir como fragmento AJAX)',
'enl_buttoninfoyes2' => 'si (abrir pagina intermedia)',
'enl_tooltipinfo' => 'Mostrar informacion de la imagen',
'enl_buttondownload' => 'Show button \'Download\'',
'enl_tooltipdownload' => 'Download this file',
'enl_clickdownload' => 'Click here to download this file',
'enl_buttonfav' => 'Mostrar boton \'Favoritos\'',
'enl_tooltipfav' => 'Favoritos',
'enl_buttoncomment' => 'Mostrar boton \'Comentarios\'',
'enl_tooltipcomment' => 'Comentarios',
'enl_buttonhist' => 'Mostrar boton \'Histograma (experimental)\'',
'enl_tooltiphist' => 'Histograma',
'enl_buttonvote' => 'Mostrar boton \'Votar\'',
'enl_tooltipvote' => 'Votar',
'enl_buttonmax' => 'Mostrar boton \'Maximizar\'',
'enl_tooltipmax' => 'Maximizar',
'enl_maxforreg' => 'Si, pero no para usuarios anonimos',
'enl_maxpopup' => 'Si, como ventana pop-up',
'enl_maxpopupforreg' => 'Si, como pop-up pero no para usuarios anonimos',
'enl_buttonclose' => 'Mostrar boton \'Cerrar ventana\'',
'enl_tooltipclose' => 'Cerrar ventana [Esc]',
'enl_buttonnav' => 'Mostrar botones \'Navegacion\'',
'enl_tooltipprev' => 'Imagen anterior [tecla de la flecha izquierda]',
'enl_tooltipnext' => 'Imagen siguiente [tecla de la flecha derecha]',
'enl_adminmode' => 'Habilitar EnlargeIt! en modo admin',
'enl_registeredmode' => 'Habilitar EnlargeIt! para usuarios registrados',
'enl_guestmode' => 'Habilitar EnlargeIt! para invitados',
'enl_sefmode' => 'Habilitar soporte SEF',
'enl_addedtofav' => 'La imagen ha sido agregada a tus favoritos.',
'enl_removedfromfav' => 'La imagen ha sido eliminada de tus favoritos.',
'enl_showfav' => 'Mostrarme mis favoritos',
'enl_dragdrop' => 'Arrastrar y soltar imagenes ampliadas',
'enl_darkensteps' => 'Pasos para el oscurecimiento (1 = inmediatamente)',
'enl_cantcomment' => 'No hay ningun comentario todavia, y no se le permite agregar uno hasta que no se identifique!',
'enl_wheelnav' => 'Navegacion con la rueda del raton',
'enl_canceltext' => 'Click to cancel loading of this picture',
'enl_noflashfound' => 'To watch this file, you need the browser plugin Adobe Flash Player!',
'enl_flvplayer' => 'Use which FLV player software',
'enl_buttonbbcode' => 'Show button \'BBCode\'',
'enl_tooltipbbcode' => 'BBCode',
'enl_copytoclipbrd' => 'Copy to clipboard',
'enl_opaglide' => 'Transparency effect for glide animation',
);
?>