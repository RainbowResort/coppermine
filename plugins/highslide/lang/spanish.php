<?php
/**************************************************
  Coppermine 1.4.x Plugin - HighSlide v 3.04
  *************************************************
  Copyright (c) 2006-2008 Borzoo Mossavari and Timos-Welt
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Skip Intermediate Page and show full page on the page
  Based on Highslide JS @ http://vikjavev.no/highslide/ 
  ***************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

// Lang setting for installation process
$lang_plugin_highslide_install = array(
  'button_install'=> 'Instalar',
  'button_submit' => 'Enviar',
  'button_cancel' => 'Cancelar',
  'button_done'   => 'Actualizado',
  'cleanup_question' => 'Borrar la tabla que fue usada para guardar las preferencias?',
  'install_note'  => 'Configurar el plugin usando el bot&oacute;n en la barra de Administraci&oacute;n',	// Note about configuring plugin
  'install_click' => 'Apretar el bot&iocute;n para instalar el plugin.',	// Message to install plugin
);

// Lang setting for Caption
$lang_plugin_highslide = array( 
	'detail'       => 'Detalle', // Lable of the link to intermadiate image
	'close'        => 'Cerrar', // Lable of the close link
	'title'        => 'T&iacute;tulo', // Lable of the title
	'controlbarnext'  => 'Pr&oacute;ximo (flecha derecha)',  // HS v3.02
	'controlbarprev'  => 'Anterior (flecha izquierda)', // HS v3.02
	'controlbarmove'  => 'Clickear y arrastrar para mover', // HS v3.02
	'controlbarclose' => 'Cerrar', //HS v3.02
);
//Lang setting for configuration and admin panel
$lang_plugin_highslide_config = array(
  'display_name'  => 'HighSlide',			// Display Name
  'config_title'  => 'Configurar HighSlide',			// Title of the button on the gallery config menu
  'config_button' => 'HighSlide',				// Label of the button on the gallery config menu
  'page_success'  => 'Preferencias de configuraci&oacute;n actualizadas.',		// Page success message
  'page_failure'  => 'Imposible actualizar configuraci&ocute;n.',		// Page failure message
  'version'       => 'Ver 3.04', // HS 3.01
  'pluginmanager' => 'Administrador de plugins',
  'expand_all'    => 'Expandir todo',
  'main_title'    => 'HighSlide plugin administraci&oacute;n',
  'Style_of_border'   => 'Estilo del borde:',
  'Disable_Admin_Mode'=> 'Desactivar plugin en modo administrador:',
  'Link_To_intermadiate'=> 'Linkear a imagen intermedia:',
  'Link_for_Closing'=> 'Boton de Cerrar:', // HS v 2.3
  'Dispaly_Title_Caption'=> 'Mostrar t&iacute;tulo en informaci&oacute;n :',// HS 2.1
  'Custom_HTML_Caption'=> 'Incluir siguiente HTML en informaci&oacute;n: ',
  'Aimao' => 'En donde quiere aplicar HighSlide? ', // HS v 2.2 
  'SFIuSIi' => 'Tama&ntilde;o del Slide: ', // HS v 2.3 
  'Yes' => 'Si',
  'No' => 'No',
  'full_image' => 'Im&aacute;gen tama&ntilde;o completo', // HS v 2.1
  'intermadiate' => 'Intermedia (chequeado via nombre de archivo; puede fallar con caract&eacute;res especiales en nombres de archivo)', // HS v 2.1
  'force_intermadiate' => 'Forzar siempre intermedias (si tiene imagenes intermedia de todos los archivos)', // HS v3.0
  'Wrob'=> 'Borde blanco redondeado *',
  'StyleNote' => '* Color para bordes e info sera modificado para coincidir!', //HS 3.01
  'StyleNote2' => '** Grosor sera seteado a 0px!', //HS 3.01
  'Beveled' => 'Media transparencia viselado **', //HS 3.0
  'W10b'=> 'Borde cuadrado (seleccionar color abajo)',
  'Ogb'=> 'Borde cuadrado con brillo externo (seleccionar color abajo)',
  'Nb'=> 'Sin borde **',
  'Nbshadow'=> 'Solo proyectar sombra **', //HS 3.01
  'note1' => 'Estas opciones no estan habilitadas en esta versi&oacute;n!!!',
  'apply_to_all'  => 'Aplicar a todas las p&aacute;ginas', // HS v 2.3
  'apply_to_index'  => 'Aplicar al indice y meta albumes', // HS v 2.2
  'page_success' => 'La configuraci&oacute;n de HighSlide ha sido actualizada.', // HS v 2.2
  'enable_sef' => 'Habilitar compatibilidad SEF : ', // HS v2.2
  'slide_cnt' => 'Contar vistas del Slide como reales (hscnt.php debe ser movido al directorio raiz!):', //HS v2.5
  'border_color' => 'Color para bordes e informaci&oacute;n:', //HS 3.0
  'details_color' => 'Color para texto de informaci&oacute;n:', //HS 3.0
  'detailsover_color' => 'Color para texto de informaci&oacute;n (rollover):', //HS 3.0
  'thickness' => 'Grosor del borde:', //HS 3.0
  'expand_steps' => 'N&uacute;mero de iteraciones para expandir la imagen:', //HS 3.0
  'expand_duration' => 'Duraci&oacute;n de la expansi&oacute;n [ms]:', //HS 3.0
  'restore_steps' => 'N&uacute;mero de iteraciones para se re ubique la imagen:', //HS 3.0
  'restore_duration' => 'Duraci&oacute;n de la implosi&oacute;n [ms]:', //HS 3.0
  'caption_slide_speed' => 'Velocidad de la informaci&oacute;n del Slide:', //HS 3.0
  'allow_multi_inst' => 'Permitir varias imagenes expandidas al mismo tiempo:', //HS 3.0
  'RightNow' => 'Inmediatamente', //HS 3.0
  'Slowest' => 'El m&aacute;s lento', //HS 3.0
  'Slower' => 'M&aacute;s lento', //HS 3.0
  'Slow' => 'Lento', //HS 3.0
  'Fast' => 'R&aacute;pido', //HS 3.0
  'Faster' => 'M&aacute;s r&aacute;pido', //HS 3.0
  'Fastest' => 'El m&aacute;s r&aacute;pido', //HS 3.0
  'Rlightgray' => 'Borde redondeado gris claro *', //HS 3.01
  'Rmediumgray' => 'Borde redondeado gris medio *', //HS 3.01
  'Rdarkgray' => 'Borde redondeado gris oscuro *', //HS 3.01
  'Rblack' => 'Borde redondeado negro *', //HS 3.01
  'Rroyalblue' => 'Borde redondeado azul marino *', //HS 3.01
  'Rdarkblue' => 'Borde redondeado azul oscuro *', //HS 3.01
  'Rlightgreen' => 'Borde redondeado verde claro *', //HS 3.01
  'Rdarkgreen' => 'Borde redondeado verde oscuro *', //HS 3.01
  'Rlightred' => 'Borde redondeado rojo *', //HS 3.01
  'Rdarkred' => 'Borde redondeado rojo oscuro*', //HS 3.01
  'Rorange' => 'Borde redondeado naranja *', //HS 3.01
  'Rcyan' => 'Borde redondeado cyan *', //HS 3.01
  'Preview' => 'Previsualizar', //HS 3.01
);
// JS lang setting
$lang_plugin_highslide_js = array (
	'loading_text'   =>  'Cargando..',// HS v2.3
	'loading_title'  =>  'Clickear para cancelar',// HS v2.3
	'restore_title'  =>  'Clickear para restaurar miniatura',// HS v2.3
	'fullexpand_title' => 'Clickear para tama&ntilde;o original', // HS v3.0
);
?>