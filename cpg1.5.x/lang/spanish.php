<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2010 Coppermine Dev Team
  v1.0 originally written by Gregory Demar

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.4
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/


if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

// info about translators and translated language
$lang_translation_info['lang_name_english'] = 'Spanish';
$lang_translation_info['lang_name_native'] = 'Espa�ol';
$lang_translation_info['lang_country_code'] = 'es';
$lang_translation_info['trans_name'] = array('fermunoz', 'Dtc', 'jmatute');
$lang_translation_info['trans_email'] = array('', '', '');
$lang_translation_info['trans_website'] = array('http://forum.coppermine-gallery.net/index.php?action=profile;u=73025', 'http://dtcsrni.co.cc/', 'http://forum.coppermine-gallery.net/index.php?action=profile;u=73633');
$lang_translation_info['trans_date'] = '2010-04-27';
$lang_charset = 'utf-8';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)


// shortcuts for Bytes, Kibibytes, Mebibytes, Gigibytes
$lang_byte_units = array('Bytes', 'Kb', 'Mb', 'Gb');
$lang_decimal_separator = array('.', ','); //cpg1.5 // symbol used to separate thousands from hundreds and rounded number from decimal place


// Day of weeks and months
$lang_day_of_week = array('Lunes', 'Martes', 'Mi�rcoles', 'Jueves', 'Viernes', 'S�bado', 'Domingo');
$lang_month = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');



// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$lang_date['album'] = '%d de %B de %y';
$lang_date['lastcom'] = '%d/%m/%y a las %H:%M';
$lang_date['lastup'] = '%d de %B de %Y';
$lang_date['register'] = '%d de %B de %Y';
$lang_date['lasthit'] = '%d de %B de %Y a las %I:%M %p';
$lang_date['comment'] = '%d de %B de %Y a las %I:%M %p';
$lang_date['log'] = '%B %d, %Y at %I:%M %p';    //jmatute: se mantiene el formato por si hay que enviar a desarrollo
$lang_date['scientific'] = '%Y-%m-%d %H:%M:%S'; //jmatute: se mantiene el formato por si hay que enviar a desarrollo



// For the word censor
$lang_bad_words = array('*joder*', 'pendejo', 'culo', 'culero', 'culera*', 'verga', 'mierda', 'chinga', 'mamada', 'mames*', 'puto', 'puta', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nigger*', 'nutsack','penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names['random'] = 'Fotos al azar';
$lang_meta_album_names['lastup'] = '�ltimas subidas';
$lang_meta_album_names['lastalb'] = '�ltimos �lbumes actualizados';
$lang_meta_album_names['lastcom'] = '�ltimos comentarios';
$lang_meta_album_names['topn'] = 'M�s vistos';
$lang_meta_album_names['toprated'] = 'M�s valorados';
$lang_meta_album_names['lasthits'] = '�ltima Vista';
$lang_meta_album_names['search'] = 'Resultado de la busqueda de imagenes';
$lang_meta_album_names['album_search'] = 'Resultado de la b�squeda de �lbumes';
$lang_meta_album_names['category_search'] = 'Resultado de la b�squeda de categor�as';
$lang_meta_album_names['favpics'] = 'Favoritos';
$lang_meta_album_names['datebrowse'] = 'Busqueda por fecha'; //cpg1.5


$lang_errors['access_denied'] = 'No tienes permiso para acceder a esta p�gina';
$lang_errors['invalid_form_token'] = 'No hay un \'form token\' v�lido'; //cpg1.5
$lang_errors['perm_denied'] = 'No tienes permiso para realizar esta operaci�n.';
$lang_errors['param_missing'] = 'Llamada a Script sin los par�metros requeridos.';
$lang_errors['non_exist_ap'] = 'El �lbum o foto no existe!';
$lang_errors['quota_exceeded'] = 'Cuota de disco excedida'; //cpg1.5
$lang_errors['quota_exceeded_details'] = 'Tienes una cuota de espacio de [quota]K y tus fotos actuales usan [space]K. A�adir esta foto exceder� tu cuota.'; //cpg1.5
$lang_errors['gd_file_type_err'] = 'Cuando usas la biblioteca de imagenes GD s�lo se permiten imagenes de tipo JPEG y PNG';
$lang_errors['invalid_image'] = 'La imagen que has subido est� corrupta o no puede ser manejada por la biblioteca GD';
$lang_errors['resize_failed'] = 'Incapaz de crear miniaturas o imagen de tama�o reducido';
$lang_errors['no_img_to_display'] = 'No hay im�genes para mostrar';
$lang_errors['non_exist_cat'] = 'La categor�a elegida no existe';
$lang_errors['directory_ro'] = 'El directorio \'%s\' no es modificable y los archivos no pueden ser borrados';
$lang_errors['pic_in_invalid_album'] = 'La foto est� en un �lbum que no existe (%s)!?';
$lang_errors['banned'] = 'En este momento se te tiene prohibido el uso de este sitio.';
$lang_errors['offline_title'] = 'Desconectad@';
$lang_errors['offline_text'] = 'La galer�a est� temporalmente desconectada, vuelve a comprobar en un rato.';
$lang_errors['ecards_empty'] = 'Actualmente no hay postales para mostrar.';
$lang_errors['database_query'] = 'Se produjo un error al procesar una consulta de base de datos';
$lang_errors['non_exist_comment'] = 'El comentario seleccionado no existe';
$lang_errors['captcha_error'] = 'El codigo de confirmaci�n no coincide'; // cpg1.5
$lang_errors['login_needed'] = 'Necesitas estar %sregister%s/%slogin%s para acceder a esta p�gina'; // cpg1.5
$lang_errors['error'] = 'Error'; // cpg1.5
$lang_errors['critical_error'] = 'Error Cr�tico'; // cpg1.5
$lang_errors['access_thumbnail_only'] = 'S�lo se te permite ver im�genes en miniatura.'; // cpg1.5
$lang_errors['access_intermediate_only'] = 'No est�s autorizado para ver las im�genes en tama�o completo.'; // cpg1.5
$lang_errors['access_none'] = 'No est�s autorizado para ver ninguna imagen.'; // cpg1.5
$lang_errors['register_globals_title'] = 'Registros globales disponibles';// cpg1.5 //JLM: Pendiente de comprobar
$lang_errors['register_globals_warning'] = 'La configuraci�n de PHP register_globals est� habilitado en su servidor, que es una mala idea en t�rminos de seguridad. Es muy recomendable que lo deshabilites.'; //cpg1.5
$lang_bbcode_help_title = 'Ayuda de BBCode';
$lang_bbcode_help = 'Puedes agregar v�nculos y hacer clic en alg�n formato de este campo mediante el uso de etiquetas de BBCode: <li>[b]Negrita[/b] =&gt; <strong>Negrita</strong></li><li>[i]It�lica[/i] =&gt; <i>It�lica</i></li><li>[url=http://sitioweb.com/]Texto de la Url[/url] =&gt; <a href="http://sitioweb.com">Texto de la Url</a></li><li>[email]usuario@dominio.com[/email] =&gt; <a href="mailto:usuario@dominio.com">usuario@dominio.com</a></li><li>[color=red]Algun texto[/color] =&gt; <span style="color:red">Algun Texto</span></li><li>[img]http://documentation.coppermine-gallery.net/images/browser.png[/img] =&gt; <img src="docs/images/browser.png" border="0" alt="" /></li>';
$lang_common['yes'] = 'Si'; // cpg1.5
$lang_common['no'] = 'No'; // cpg1.5
$lang_common['back'] = 'Atras'; // cpg1.5
$lang_common['continue'] = 'Continuar'; // cpg1.5
$lang_common['information'] = 'Informaci�n'; // cpg1.5
$lang_common['error'] = 'Error'; // cpg1.5
$lang_common['check_uncheck_all'] = 'Marcar/Desmarcar todo'; // cpg1.5
$lang_common['confirm'] = 'Confirmaci�n'; // cpg1.5
$lang_common['captcha_help_title'] = 'Confirmaci�n Visual (captcha)'; // cpg1.5
$lang_common['captcha_help'] = 'Para evitar el spam, tienes que confirmar que eres un humano real y no s�lo una secuencia de comandos bot, introduciendo el texto que se muestra. <br /> No distingue may�sculas/min�sculas'; // cpg1.5
$lang_common['title'] = 'T�tulo'; // cpg1.5
$lang_common['caption'] = 'Leyenda'; // cpg1.5
$lang_common['keywords'] = 'Palabras clave'; // cpg1.5
$lang_common['keywords_insert1'] = 'Palabras clave (separadas por %s)'; // cpg1.5
$lang_common['keywords_insert2'] = 'Elegir desde la lista'; // cpg1.5
$lang_common['keyword_separator'] = 'Separador de palabras clave'; //cpg1.5
$lang_common['keyword_separators'] = array(' '=>'espacio', ','=>'coma', ';'=>'punto y coma'); // cpg1.5
$lang_common['filename'] = 'Nombre de foto'; // cpg1.5
$lang_common['filesize'] = 'Tama�o de foto'; // cpg1.5
$lang_common['album'] = '�lbum'; // cpg1.5
$lang_common['file'] = 'Foto'; // cpg1.5
$lang_common['date'] = 'Fecha'; // cpg1.5
$lang_common['help'] = 'Ayuda'; // cpg1.5
$lang_common['close'] = 'Cerrar'; // cpg1.5
$lang_common['go'] = 'Ir'; // cpg1.5
$lang_common['javascript_needed'] = 'Esta p�gina requiere JavaScript para funcionar. Por favor, habil�talo'; // cpg1.5
$lang_common['move_up'] = 'Mover arriba'; // cpg1.5
$lang_common['move_down'] = 'Mover abajo'; // cpg1.5
$lang_common['move_top'] = 'Mover al principio'; // cpg1.5
$lang_common['move_bottom'] = 'Mover al final'; // cpg1.5
$lang_common['delete'] = 'Borrar'; // cpg1.5
$lang_common['edit'] = 'Editar'; // cpg1.5
$lang_common['username_if_blank'] = 'Cobarde Desconocido'; // cpg1.5
$lang_common['albums_no_category'] = '�lbumes sin categor�a'; // cpg1.5
$lang_common['personal_albums'] = '* �lbumes personales'; // cpg1.5
$lang_common['select_album'] = '�lbum seleccionado'; // cpg1.5
$lang_common['ok'] = 'OK'; // cpg1.5
$lang_common['status'] = 'Estado'; // cpg1.5
$lang_common['apply_changes'] = 'Aplicar cambios'; // cpg1.5
$lang_common['done'] = 'Listo'; // cpg1.5
$lang_common['album_properties'] = 'Propiedades del �lbum'; // cpg1.5
$lang_common['parent_category'] = 'Categor�a padre'; // cpg1.5
$lang_common['edit_files'] = 'Editar archivos'; // cpg1.5
$lang_common['thumbnail_view'] = 'Vista en miniatura'; // cpg1.5
$lang_common['album_manager'] = 'Administrador de �lbumes'; // cpg1.5
$lang_common['more'] = 'M�s'; // cpg1.5



// ------------------------------------------------------------------------- //
// File theme.php // Traducida
// ------------------------------------------------------------------------- //
$lang_main_menu['home_title'] = 'Ir a la p�gina Principal';
$lang_main_menu['home_lnk'] = 'Principal';
$lang_main_menu['alb_list_title'] = 'Ir a la lista de �lbumes';
$lang_main_menu['alb_list_lnk'] = 'Lista de �lbumes';
$lang_main_menu['my_gal_title'] = 'Ir a "Mi galer�a personal"';
$lang_main_menu['my_gal_lnk'] = 'Mi galer�a';
$lang_main_menu['my_prof_title'] = 'Ir a "Mi perfil personal"';
$lang_main_menu['my_prof_lnk'] = 'Mi perfil';
$lang_main_menu['adm_mode_title'] = 'Habilitar vista de los controles de admin'; // cpg1.5 //JLM: Pendiente de comprobar
$lang_main_menu['adm_mode_lnk'] = 'Ver controles de admin'; // cpg1.5 //JLM: Pendiente de comprobar
$lang_main_menu['usr_mode_title'] = 'Deshabilitar vista de controles de admin'; // cpg1.5 //JLM: Pendiente de comprobar
$lang_main_menu['usr_mode_lnk'] = 'Ocultar controles de admin'; // cpg1.5 //JLM: Pendiente de comprobar
$lang_main_menu['upload_pic_title'] = 'Subir una foto dentro de un �lbum'; //JLM: Pendiente de comprobar
$lang_main_menu['upload_pic_lnk'] = 'Subir foto';
$lang_main_menu['register_title'] = 'Crear una cuenta';
$lang_main_menu['register_lnk'] = 'Registro';
$lang_main_menu['login_title'] = 'Entrar';
$lang_main_menu['login_lnk'] = 'Entrar';
$lang_main_menu['logout_title'] = 'Salir';
$lang_main_menu['logout_lnk'] = 'Salir';
$lang_main_menu['lastup_title'] = 'Mostrar las subidas mas recientes'; //JLM: Pendiente de comprobar
$lang_main_menu['lastup_lnk'] = '�ltimas im�genes'; 
$lang_main_menu['lastcom_title'] = 'Mostrar los �ltimos comentarios';
$lang_main_menu['lastcom_lnk'] = '�ltimos comentarios';
$lang_main_menu['topn_title'] = 'Mostrar los mas vistos'; //JLM: Pendiente de comprobar
$lang_main_menu['topn_lnk'] = 'Mas vistos';
$lang_main_menu['toprated_title'] = 'Ver los mas votados';
$lang_main_menu['toprated_lnk'] = 'Graduaci�n superior'; //JLM: Pendiente de comprobar
$lang_main_menu['search_title'] = 'Buscar la galer�a'; //JLM: Pendiente de comprobar
$lang_main_menu['search_lnk'] = 'Buscar';
$lang_main_menu['fav_title'] = 'Ir a mis favoritos';
$lang_main_menu['fav_lnk'] = 'Mis favoritas';
$lang_main_menu['memberlist_title'] = 'Mostrar la lista de miembros';
$lang_main_menu['memberlist_lnk'] = 'Lista de miembros';
$lang_main_menu['browse_by_date_lnk'] = 'Por fecha'; // cpg1.5
$lang_main_menu['browse_by_date_title'] = 'Buscar por fecha de subida'; // cpg1.5
$lang_main_menu['contact_title'] = 'P�ngase en contacto con %s'; // cpg1.5
$lang_main_menu['contact_lnk'] = 'Contacto'; // cpg1.5
$lang_main_menu['sidebar_title'] = 'A�adir una barra lateral a tu buscador'; // cpg1.5
$lang_main_menu['sidebar_lnk'] = 'Barra lateral'; // cpg1.5
$lang_gallery_admin_menu['upl_app_title'] = 'Aprobar nuevas subidas';
$lang_gallery_admin_menu['upl_app_lnk'] = 'Subida aprobada';
$lang_gallery_admin_menu['admin_title'] = 'Ir a la configuracion';
$lang_gallery_admin_menu['admin_lnk'] = 'Configurar';
$lang_gallery_admin_menu['albums_title'] = 'Ir a la configuracion del �lbum';
$lang_gallery_admin_menu['albums_lnk'] = '�lbumes';
$lang_gallery_admin_menu['categories_title'] = 'Ir a la configuracion de categor�a';
$lang_gallery_admin_menu['categories_lnk'] = 'Categor�as';
$lang_gallery_admin_menu['users_title'] = 'Ir a la configuracion de usuario';
$lang_gallery_admin_menu['users_lnk'] = 'Usuarios';
$lang_gallery_admin_menu['groups_title'] = 'Ir a configuracion de grupos';
$lang_gallery_admin_menu['groups_lnk'] = 'Grupos';
$lang_gallery_admin_menu['comments_title'] = 'Revisar todos los comentarios';
$lang_gallery_admin_menu['comments_lnk'] = 'Revisar comentarios';
$lang_gallery_admin_menu['searchnew_title'] = 'Ir al proceso de subida por lotes';
$lang_gallery_admin_menu['searchnew_lnk'] = 'Agregar archivos por lotes';
$lang_gallery_admin_menu['util_title'] = 'Ir a las herramientas administrativas';
$lang_gallery_admin_menu['util_lnk'] = 'Herramientas Administrativas';
$lang_gallery_admin_menu['key_lnk'] = 'Diccionario de palabras clave';
$lang_gallery_admin_menu['ban_title'] = 'Ir a los usuarios expulsados';
$lang_gallery_admin_menu['ban_lnk'] = 'Usuarios expulsados';
$lang_gallery_admin_menu['db_ecard_title'] = 'Revisar postales';
$lang_gallery_admin_menu['db_ecard_lnk'] = 'Mostrar postales';
$lang_gallery_admin_menu['pictures_title'] = 'Ordenar mis fotos';
$lang_gallery_admin_menu['pictures_lnk'] = 'Ordenar mis fotos';
$lang_gallery_admin_menu['documentation_lnk'] = 'Documentaci�n';
$lang_gallery_admin_menu['documentation_title'] = 'Manual de Coppermine';
$lang_gallery_admin_menu['phpinfo_lnk'] = 'phpinfo'; // cpg1.5
$lang_gallery_admin_menu['phpinfo_title'] = 'Contiene informaci�n t�cnica sobre su servidor. Se le puede pedir que proporcione esta informaci�n cuando solicite ayuda.'; // cpg1.5
$lang_gallery_admin_menu['update_database_lnk'] = 'Actualizar base de datos'; // cpg1.5
$lang_gallery_admin_menu['update_database_title'] = 'Si has reemplazado los archivos de Coppermine, agregado una modificaci�n o una actualizaci�n desde una versi�n anterior de Coppermine, aseg�rate de ejecutar la actualizaci�n la base de datos una vez. Esto crear� las tablas necesarias y/o valores de configuraci�n en la base de datos de Coppermine.'; // cpg1.5
$lang_gallery_admin_menu['view_log_files_lnk'] = 'Ver archivos de registro (log)'; // cpg1.5
$lang_gallery_admin_menu['view_log_files_title'] = 'Coppermine puede realizar un seguimiento de diversas acciones que realizan los usuarios. Puedes navegar por los registros si has habilitado el registro en la configuraci�n de Coppermine.'; // cpg1.5
$lang_gallery_admin_menu['check_versions_lnk'] = 'Comprobar versiones'; // cpg1.5
$lang_gallery_admin_menu['check_versions_title'] = 'Compruebe la versi�n del servidor para averiguar si ha reemplazado todos los archivos despu�s de una actualizaci�n, o si los archivos de Coppermine se han actualizado despu�s de la publicaci�n de un paquete.'; // cpg1.5
$lang_gallery_admin_menu['bridgemgr_lnk'] = 'Administrador de integraciones (bridges)'; // cpg1.5
$lang_gallery_admin_menu['bridgemgr_title'] = 'Habilitar / deshabilitar la integraci�n (bridges) de Coppermine con otra aplicaci�n (por ejemplo, su BBS).'; // cpg1.5
$lang_gallery_admin_menu['pluginmgr_lnk'] = 'Administrador de plugins'; // cpg1.5
$lang_gallery_admin_menu['pluginmgr_title'] = 'Administrador de plugins'; // cpg1.5
$lang_gallery_admin_menu['overall_stats_lnk'] = 'Estad�sticas totales'; // cpg1.5
$lang_gallery_admin_menu['overall_stats_title'] = 'Ver estad�sticas generales afectadas por el navegador y sistema operativo (si las opciones correspondientes se activan en la configuraci�n).'; // cpg1.5
$lang_gallery_admin_menu['keywordmgr_lnk'] = 'Administrador de palabras clave'; // cpg1.5
$lang_gallery_admin_menu['keywordmgr_title'] = 'Administrar las palabras clave (si la opci�n correspondiente est� activada en la configuraci�n).'; // cpg1.5
$lang_gallery_admin_menu['exifmgr_lnk'] = 'Administrador de datos EXIF'; // cpg1.5
$lang_gallery_admin_menu['exifmgr_title'] = 'Administrar los datos EXIF (si esta habilitada la configuracion correspondiente).'; // cpg1.5
$lang_gallery_admin_menu['shownews_lnk'] = 'Mostrar novedades'; // cpg1.5
$lang_gallery_admin_menu['shownews_title'] = 'Mostrar las novedades desde coppermine-gallery.net'; // cpg1.5
$lang_user_admin_menu['albmgr_title'] = 'Crear y ordenar mis �lbumes';
$lang_user_admin_menu['albmgr_lnk'] = 'Crear/ordenar mis �lbumes';
$lang_user_admin_menu['modifyalb_title'] = 'Ir a modificar mis �lbumes';
$lang_user_admin_menu['modifyalb_lnk'] = 'Modificar mis �lbumes';
$lang_user_admin_menu['my_prof_title'] = 'Ir a mi perfil personal';
$lang_user_admin_menu['my_prof_lnk'] = 'Mi perfil';
$lang_cat_list['category'] = 'Categor�a';
$lang_cat_list['albums'] = '�lbumes';
$lang_cat_list['pictures'] = 'Fotos';
$lang_album_list['album_on_page'] = '%d �lbumes en %d p�gina(s)';
$lang_thumb_view['date'] = 'Fecha';  

//Sort by filename and title
$lang_thumb_view['name'] = 'Nombre de foto';
$lang_thumb_view['sort_da'] = 'Ordenar por fecha ascendente';
$lang_thumb_view['sort_dd'] = 'Ordenar por fecha descendente';
$lang_thumb_view['sort_na'] = 'Ordenar por nombre ascendente';
$lang_thumb_view['sort_nd'] = 'Ordenar por nombre descendente';
$lang_thumb_view['sort_ta'] = 'Ordenar por t�tulo ascendente';
$lang_thumb_view['sort_td'] = 'Ordenar por t�tulo descendente';
$lang_thumb_view['position'] = 'Posici�n';
$lang_thumb_view['sort_pa'] = 'Ordenar por posici�n ascendente';
$lang_thumb_view['sort_pd'] = 'Ordenar por posici�n descendente';
$lang_thumb_view['download_zip'] = 'Descargar como archivo ZIP';
$lang_thumb_view['pic_on_page'] = '%d fotos en %d p�gina(s)';
$lang_thumb_view['user_on_page'] = '%d usuarios en %d p�gina(s)';
$lang_thumb_view['enter_alb_pass'] = 'Introduce la contrase�a del �lbum';
$lang_thumb_view['invalid_pass'] = 'Contrase�a invalida';
$lang_thumb_view['pass'] = 'Contrase�a';
$lang_thumb_view['submit'] = 'Enviar';
$lang_thumb_view['zipdownload_copyright'] = 'Por favor, respeta los derechos de autor - utiliza s�lo los archivos que hayas descargado en la forma prevista por el propietario de la galer�a'; // cpg1.5
$lang_thumb_view['zipdownload_username'] = 'Este archivo contiene los archivos comprimidos de los favoritos de %s'; // cpg1.5
$lang_img_nav_bar['thumb_title'] = 'Regresar a la p�gina de miniaturas';
$lang_img_nav_bar['pic_info_title'] = 'Mostrar/Ocultar informaci�n del archivo';
$lang_img_nav_bar['slideshow_title'] = 'Presentaci�n de diapositivas';
$lang_img_nav_bar['ecard_title'] = 'Enviar este archivo como una postal';
$lang_img_nav_bar['ecard_disabled'] = 'Las postales estan deshabilitadas';
$lang_img_nav_bar['ecard_disabled_msg'] = 'No tienes permiso para enviar postales'; // js-alert
$lang_img_nav_bar['prev_title'] = 'Ver la foto anterior';
$lang_img_nav_bar['next_title'] = 'Ver la foto siguiente';
$lang_img_nav_bar['pic_pos'] = 'Foto %s/%s';
$lang_img_nav_bar['report_title'] = 'Reportar esta foto al administrador';
$lang_img_nav_bar['go_album_end'] = 'Saltar al final';
$lang_img_nav_bar['go_album_start'] = 'Regresar al inicio';
$lang_rate_pic['rate_this_pic'] = 'Vota esta foto';
$lang_rate_pic['no_votes'] = '(No ha sido votada todavia)';
$lang_rate_pic['rating'] = '(Votacion actual : %s / %s con %s votos)';
$lang_rate_pic['rubbish'] = 'Basura';
$lang_rate_pic['poor'] = 'Pobre';
$lang_rate_pic['fair'] = 'Razonable';
$lang_rate_pic['good'] = 'Est� bien';
$lang_rate_pic['excellent'] = 'Excelente';
$lang_rate_pic['great'] = 'Muy buena';
$lang_rate_pic['js_warning'] = 'Tiene que habilitar Javascript para poder votar'; // cpg1.5
$lang_rate_pic['already_voted'] = 'Usted ya ha votado esta foto.'; // cpg1.5
$lang_rate_pic['forbidden'] = 'No puedes votar tus propias fotos'; // cpg1.5
$lang_rate_pic['rollover_to_rate'] = 'Mueve el cursor sobre esta imagen para votar'; // cpg1.5

// ------------------------------------------------------------------------- //
// File include/functions.inc.php // Traducida
// ------------------------------------------------------------------------- //
$lang_cpg_die['file'] = 'Fichero: ';
$lang_cpg_die['line'] = 'Linea: ';
$lang_display_thumbnails['dimensions'] = 'Dimensiones=';
$lang_display_thumbnails['date_added'] = 'Fecha a�adida=';
$lang_get_pic_data['n_comments'] = '%s commentarios';
$lang_get_pic_data['n_views'] = 'vista %s veces';
$lang_get_pic_data['n_votes'] = '(%s votos)';
$lang_cpg_debug_output['debug_info'] = 'Informaci�n para depuraci�n';
$lang_cpg_debug_output['debug_output'] = 'Salida de la depuraci�n'; // cpg1.5
$lang_cpg_debug_output['select_all'] = 'Seleccionar todo';
$lang_cpg_debug_output['copy_and_paste_instructions'] = 'Si vas a solicitar ayuda en el foro de Coppermine, copia y pega esta salida de depuraci�n en tu entrada cuando se te solicite, junto con el mensaje de error que recibes (si existe). �A�ade esta informaci�n s�lo si te lo piden! Aseg�rate de reemplazar las contrase�as de la consulta con *** antes de publicar.'; // cpg1.5
$lang_cpg_debug_output['debug_output_explain'] = 'Nota: Esto es a t�tulo informativo y no significa que hay un error en la galer�a.'; // cpg1.5
$lang_cpg_debug_output['phpinfo'] = 'Mostrar phpinfo';
$lang_cpg_debug_output['notices'] = 'Noticias';

//JLM: pendiente
$lang_cpg_debug_output['notices_help_admin'] = 'Los anuncios aparecen en esta p�gina porque t� (como administrador de la galer�a) permitiste deliberadamente que figuren en la configuraci�n de Coppermine. Eso no significa necesariamente que algo est� mal con la galer�a. De hecho, son un rasgo revelador de que s�lo los programadores cualificados deber�an permitir hacer un seguimiento de errores. Si te molesta colocar� avisos y/o que no tiene idea de lo que los avisos decir, a su vez la funci�n de apagado en la configuraci�n correspondiente.'; // cpg1.5

//JLM: pendiente
$lang_cpg_debug_output['notices_help_non_admin'] = 'The notices display has been deliberately enabled by the admin. It doesn\'t mean that something is wrong on your end. You can safely ignore the notices displayed here.'; // cpg1.5
$lang_cpg_debug_output['show_hide'] = 'mostrar/ocultar'; // cpg1.5
$lang_language_selection['reset_language'] = 'Idioma por defecto';
$lang_language_selection['choose_language'] = 'Elige idioma';
$lang_theme_selection['reset_theme'] = 'Tema por defecto';
$lang_theme_selection['choose_theme'] = 'Elige un tema';
$lang_version_alert['version_alert'] = '�Versi�n no soportada!';
$lang_version_alert['no_stable_version'] = 'You are running Coppermine %s (%s) which is only meant for very experienced users - this version comes without support nor any warranties. Use it at your own risk or downgrade to the latest stable version if you need support!';
$lang_version_alert['gallery_offline'] = 'La galer�a est� actualmente desactivada, y solo ser� visible para t� como administrador. No olvides activarla de nuevo despu�s de terminar el mantenimiento.';
$lang_version_alert['coppermine_news'] = 'Noticias de coppermine-gallery.net'; // cpg1.5

//JLM: pendiente
$lang_version_alert['no_iframe'] = 'Tu navegador no puede mostrar frames inline'; // cpg1.5
$lang_version_alert['hide'] = 'Oculto'; // cpg1.5
$lang_create_tabs['previous'] = 'Previos'; // cpg1.5
$lang_create_tabs['next'] = 'Siguiente'; // cpg1.5
$lang_create_tabs['jump_to_page'] = 'Saltar a pgina'; // cpg1.5
$lang_get_remote_file_by_url['no_data_returned'] = 'No hay datos devueltos con %s'; // cpg1.5
$lang_get_remote_file_by_url['curl'] = 'CURL'; // cpg1.5
$lang_get_remote_file_by_url['fsockopen'] = 'Coneccion Socket (FSOCKOPEN)'; // cpg1.5
$lang_get_remote_file_by_url['fopen'] = 'fopen'; // cpg1.5
$lang_get_remote_file_by_url['curl_not_available'] = 'Curl no esta disponible en tu servidor'; // cpg1.5
$lang_get_remote_file_by_url['error_number'] = 'Numero de error: %s'; // cpg1.5
$lang_get_remote_file_by_url['error_message'] = 'Mensaje de Eerror: %s'; // cpg1.5



// ------------------------------------------------------------------------- //
// File include/mailer.inc.php // Traducida
// ------------------------------------------------------------------------- //
$lang_mailer['provide_address'] = 'Debes escribir al menos una ';
//JLM: pendiente
$lang_mailer['mailer_not_supported'] = ' programa de correo no soportado';
$lang_mailer['execute'] = 'No se puede ejecutar: ';
$lang_mailer['instantiate'] = 'No se puede iniciar la funcion de email';
$lang_mailer['authenticate'] = 'SMTP Error: No se puede autentificar';
$lang_mailer['from_failed'] = 'Las siguientes direcciones de remitente fallaron: ';
$lang_mailer['recipients_failed'] = 'SMTP Error: Los siguientes ';
$lang_mailer['data_not_accepted'] = 'SMTP Error: Datos no aceptados.';
$lang_mailer['connect_host'] = 'SMTP Error: No se puede conectar con el servidor.';
$lang_mailer['file_access'] = 'No se puede acceder al archivo: ';
$lang_mailer['file_open'] = 'Error de archivo: No se pudo abrir el archivo: ';
$lang_mailer['encoding'] = 'Codificacion desconocida: ';
$lang_mailer['signing'] = 'Firma de error: ';



// ------------------------------------------------------------------------- //
// File include/plugin_api.inc.php // Traducida
// ------------------------------------------------------------------------- //
$lang_plugin_api['error_install'] = 'No se pudo instalar el plugin \'%s\'';
$lang_plugin_api['error_uninstall'] = 'No se pudo desinstalar el plugin \'%s\'';
$lang_plugin_api['error_sleep'] = 'No se pudo deshabilitar el plugin \'%s\''; // cpg1.5



// ------------------------------------------------------------------------- //
// File include/smilies.inc.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('SMILIES_PHP')) {
$lang_smilies_inc_php['Exclamation'] = 'Exclamaci�n';
$lang_smilies_inc_php['Question'] = 'Pregunta';
$lang_smilies_inc_php['Very Happy'] = 'Muy feliz';
$lang_smilies_inc_php['Smile'] = 'Sonrisa';
$lang_smilies_inc_php['Sad'] = 'Triste';
$lang_smilies_inc_php['Surprised'] = 'Sorprendido';
$lang_smilies_inc_php['Shocked'] = 'En shock';
$lang_smilies_inc_php['Confused'] = 'Confundido';
$lang_smilies_inc_php['Cool'] = 'Sensacional!';
$lang_smilies_inc_php['Laughing'] = 'Riendo';
$lang_smilies_inc_php['Mad'] = 'Loco';
$lang_smilies_inc_php['Razz'] = 'Razz';
$lang_smilies_inc_php['Embarrassed'] = 'Avergonzado'; // cpg1.5
$lang_smilies_inc_php['Crying or Very sad'] = 'Llorando o muy triste';
$lang_smilies_inc_php['Evil or Very Mad'] = 'Malo o muy enojado';
$lang_smilies_inc_php['Twisted Evil'] = 'Retorcido';
$lang_smilies_inc_php['Rolling Eyes'] = 'Ojos Volteados';
$lang_smilies_inc_php['Wink'] = 'Cerrar el ojo';
$lang_smilies_inc_php['Idea'] = 'Idea';
$lang_smilies_inc_php['Arrow'] = 'Flecha';
$lang_smilies_inc_php['Neutral'] = 'Neutral';
$lang_smilies_inc_php['Mr. Green'] = 'Sr. Verde';
};



// ------------------------------------------------------------------------- //
// File albmgr.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) {
$lang_albmgr_php['title'] = 'Administrador de �lbum'; // cpg1.5
$lang_albmgr_php['alb_need_name'] = 'Los �lbumes necesitan tener un nombre!'; // js-alert
$lang_albmgr_php['confirm_modifs'] = '�Estas seguro de querer hacer esas modificaciones?'; // js-alert
$lang_albmgr_php['no_change'] = 'No has hecho ningun cambio!'; // js-alert
$lang_albmgr_php['new_album'] = 'Nuevo �lbum';
$lang_albmgr_php['delete_album'] = 'Borrar �lbum'; // cpg1.5
$lang_albmgr_php['confirm_delete1'] = '�Estas seguro de querer borrar este �lbum?'; // js-alert
$lang_albmgr_php['confirm_delete2'] = 'Todos los archivos y comentarios que contiene se perder�n!'; // js-alert
$lang_albmgr_php['select_first'] = 'Selecciona un �lbum primero'; // js-alert
$lang_albmgr_php['my_gallery'] = '* Mi galer�a *';
$lang_albmgr_php['no_category'] = '* Sin categor�a *';
$lang_albmgr_php['select_category'] = 'Seleccionar categor�a';
$lang_albmgr_php['category_change'] = 'Si cambias la categor�a, tus cambios se perder�n!'; // cpg1.5
$lang_albmgr_php['page_change'] = 'Si sigues este enlace, los cambios se perder�n!'; // cpg1.5
$lang_albmgr_php['cancel'] = 'Cancelar'; // cpg1.5
$lang_albmgr_php['submit_reminder'] = 'Clasificaci�n los cambios no se guardan hasta que haga clic &quot;Aplicar Cambios&quot;.'; // cpg1.5
}


// ------------------------------------------------------------------------- //
// File banning.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('BANNING_PHP')) {
$lang_banning_php['title'] = 'Usuarios expulsados';
$lang_banning_php['user_name'] = 'Nombre de usuario';
$lang_banning_php['user_account'] = 'Cuenta de usuario';
$lang_banning_php['email_address'] = 'Direccion de correo'; // cpg1.5
$lang_banning_php['ip_address'] = 'Direccion IP';
$lang_banning_php['expires'] = 'Expira'; // cpg1.5
$lang_banning_php['expiry_date'] = 'Fecha de expiraci�n'; // cpg1.5
$lang_banning_php['expired'] = 'Expirada'; // cpg1.5
$lang_banning_php['edit_ban'] = 'Guardar cambios';
$lang_banning_php['add_new'] = 'A�adir nuevo';
$lang_banning_php['add_ban'] = 'A�ade';
$lang_banning_php['error_user'] = 'No se pudo encontrar al usuario';
$lang_banning_php['error_specify'] = 'Debes especificar un usuario o una direcci�n IP';
$lang_banning_php['error_ban_id'] = '�Identificador de expulsi�n inv�lido!';
$lang_banning_php['error_admin_ban'] = 'No te puedes expulsar a t� mismo';
$lang_banning_php['error_server_ban'] = '�Vas a expulsar a tu propio seridor? no, no, no... �no lo puedes hacer!';
$lang_banning_php['skipping'] = 'Salt�ndose esa orden'; // cpg1.5
$lang_banning_php['lookup_ip'] = 'Buscando direcci�n IP';
$lang_banning_php['select_date'] = 'Selecciona fecha';
$lang_banning_php['delete_comments'] = 'Borrar comentarios'; // cpg1.5
$lang_banning_php['current'] = 'actual'; // cpg1.5
$lang_banning_php['all'] = 'todos'; // cpg1.5
$lang_banning_php['none'] = 'ninguno'; // cpg1.5
$lang_banning_php['view'] = 'ver'; // cpg1.5
$lang_banning_php['ban_id'] = 'Identificador de expulsi�n'; // cpg1.5
$lang_banning_php['existing_bans'] = 'Expulsiones existentes'; // cpg1.5
$lang_banning_php['no_banning_when_bridged'] = 'Est�s usando tu galer�a integrada en otra aplicaci�n. Usa el mecanismo de expulsi�n de esa aplicaci�n en lugar del integrado en Coppermine. Los mecanismos de Coppermine no se aplican correctamente si est� integrado.'; // cpg1.5
$lang_banning_php['records_on_page'] = '%d registros en %d p�gina(s)'; // cpg1.5
$lang_banning_php['ascending'] = 'ascendente'; // cpg1.5
$lang_banning_php['descending'] = 'descendente'; // cpg1.5
$lang_banning_php['sort_by'] = 'Ordenar por'; // cpg1.5
$lang_banning_php['sorted_by'] = 'ordenado por'; // cpg1.5
$lang_banning_php['ban_record_x_updated'] = 'El registro de expulsi�n %s ha sido actualizado'; // cpg1.5
$lang_banning_php['ban_record_x_deleted'] = 'El registro de expulsi�n %s ha sido borrado'; // cpg1.5
$lang_banning_php['new_ban_record_created'] = 'Creado un nuevo registro de expulsi�n'; // cpg1.5
$lang_banning_php['ban_record_x_already_exists'] = 'El registro de expulsi�n %s ya existe'; // cpg1.5
$lang_banning_php['comment_deleted'] = '%s comentario hecho por %s ha sido borrado(s)'; // cpg1.5
$lang_banning_php['comments_deleted'] = '%s cometarios hechos por %s han sido borrados'; // cpg1.5
$lang_banning_php['email_field_invalid'] = 'Introduce una direccion de correo v�lida'; // cpg1.5
$lang_banning_php['ip_address_field_invalid'] = 'Introduce una direccion IP v�lida (x.x.x.x)'; // cpg1.5
$lang_banning_php['expiry_field_invalid'] = 'Introduce una fecha de expiraci�n v�lida (YYYY-MM-DD)'; // cpg1.5
$lang_banning_php['form_not_submit'] = 'No se ha enviado el formulario - debes corregir los errores antes'; // cpg1.5
};

// ------------------------------------------------------------------------- //
// File bridgemgr.php
// ------------------------------------------------------------------------- //
if (defined('BRIDGEMGR_PHP')) {
$lang_bridgemgr_php['title'] = 'Bridge Wizard';
$lang_bridgemgr_php['back'] = 'anterior';
$lang_bridgemgr_php['next'] = 'siguiente';
$lang_bridgemgr_php['start_wizard'] = 'Start bridging wizard';
$lang_bridgemgr_php['finish'] = 'Terminar';
$lang_bridgemgr_php['no_action_needed'] = 'No action needed in this step. Just click \'next\' to continue.';
$lang_bridgemgr_php['reset_to_default'] = 'Reset to default value';
$lang_bridgemgr_php['choose_bbs_app'] = 'choose application to bridge Coppermine with';
$lang_bridgemgr_php['support_url'] = 'Go here for support on this application';
$lang_bridgemgr_php['settings_path'] = 'path(s) used by your bridge app';
$lang_bridgemgr_php['full_forum_url'] = 'URL of the bridge app';
$lang_bridgemgr_php['relative_path_of_forum_from_webroot'] = 'Absolute bridging app path';
$lang_bridgemgr_php['relative_path_to_config_file'] = 'Relative path to your bridge app\'s config file';
$lang_bridgemgr_php['cookie_prefix'] = 'Cookie prefix';
$lang_bridgemgr_php['special_settings'] = 'bridge app-specific settings';
$lang_bridgemgr_php['use_post_based_groups'] = 'Use bridge app custom groups?';
$lang_bridgemgr_php['use_post_based_groups_yes'] = 'yes';
$lang_bridgemgr_php['use_post_based_groups_no'] = 'no';
$lang_bridgemgr_php['error_title'] = 'You need to correct these errors before you can continue. Go to the previous screen.';
$lang_bridgemgr_php['error_specify_bbs'] = 'You have to specify what application you want to bridge your Coppermine install with.';
$lang_bridgemgr_php['finalize'] = 'enable/disable bridging';
$lang_bridgemgr_php['finalize_explanation'] = 'So far, the settings you specified have been written into the database, but bridge app integration hasn\'t been enabled. You can switch integration on/off later at any time. Make sure to remember the admin username and password from standalone Coppermine, you might need it later to be able to make any changes. If anything goes wrong, go to %s and disable bridging there, using your standalone (unbridged) admin account (usually the one you set up during Coppermine install).';
$lang_bridgemgr_php['your_bridge_settings'] = 'Your bridge settings';
$lang_bridgemgr_php['title_enable'] = 'Enable integration/bridging with %s';
$lang_bridgemgr_php['bridge_enable_yes'] = 'enable';
$lang_bridgemgr_php['bridge_enable_no'] = 'disable';
$lang_bridgemgr_php['error_must_not_be_empty'] = 'must not be empty';
$lang_bridgemgr_php['error_either_be'] = 'must either be %s or %s';
$lang_bridgemgr_php['error_folder_not_exist'] = '%s doesn\'t exist. Correct the value you entered for %s';
$lang_bridgemgr_php['error_cookie_not_readible'] = 'Coppermine can\'t read a cookie named %s. Correct the value you entered for %s, or go to your bridge app administration panel and make sure that the cookie path is readable for Coppermine.';
$lang_bridgemgr_php['error_mandatory_field_empty'] = 'You cannot leave the field %s blank - fill in the proper value.';
$lang_bridgemgr_php['error_no_trailing_slash'] = 'There mustn\'t be a trailing slash in the field %s.';
$lang_bridgemgr_php['error_trailing_slash'] = 'There must be a trailing slash in the field %s.';
$lang_bridgemgr_php['error_prefix_and_table'] = '%s and ';
$lang_bridgemgr_php['recovery_title'] = 'Bridge Manager: emergency recovery';
$lang_bridgemgr_php['recovery_explanation'] = 'If you came here to administer the bridging of your Coppermine gallery, you have to log in first as admin. If you cannot log in because bridging doesn\'t work as expected, you can disable bridging with this page. Entering your username and password will not log you in, it will only disable bridging. Refer to the documentation for details.';
$lang_bridgemgr_php['username'] = 'Username';
$lang_bridgemgr_php['password'] = 'Password';
$lang_bridgemgr_php['disable_submit'] = 'submit';
$lang_bridgemgr_php['recovery_success_title'] = 'Authorization successful';
$lang_bridgemgr_php['recovery_success_content'] = 'You have successfully disabled bridging. Your Coppermine install runs now in standalone mode.';
$lang_bridgemgr_php['recovery_success_advice_login'] = 'Log in as admin to edit your bridge settings and/or enable bridging again.';
$lang_bridgemgr_php['goto_login'] = 'Go to login page';
$lang_bridgemgr_php['goto_bridgemgr'] = 'Go to bridge manager';
$lang_bridgemgr_php['recovery_failure_title'] = 'Authorization failed';
$lang_bridgemgr_php['recovery_failure_content'] = 'You supplied the wrong credentials. You will have to supply the admin account data of the standalone version (usually the account you set up during Coppermine install).';
$lang_bridgemgr_php['try_again'] = 'try again';
$lang_bridgemgr_php['recovery_wait_title'] = 'Wait time has not elapsed';
$lang_bridgemgr_php['recovery_wait_content'] = 'For security reasons this script does not allow failed logons in short succession, so you will have to wait a bit until you\'re allowed to try to authenticate.';
$lang_bridgemgr_php['wait'] = 'wait';
$lang_bridgemgr_php['browse'] = 'browse';
}

// ------------------------------------------------------------------------- //
// File calendar.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('CALENDAR_PHP')) {
$lang_calendar_php['title'] = 'Calendario';
$lang_calendar_php['clear_date'] = 'borrar fecha';
$lang_calendar_php['files'] = 'ficheros'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File catmgr.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) {
$lang_catmgr_php['miss_param'] = '�Faltan parametros necesarios para la operaci�n \'%s\'!';
$lang_catmgr_php['unknown_cat'] = 'La categor�a seleccionada no existe en la base de datos';
$lang_catmgr_php['usergal_cat_ro'] = 'Las galer�as de usuarios no pueden ser borradas!';
$lang_catmgr_php['manage_cat'] = 'Administrar categor�as';
$lang_catmgr_php['confirm_delete'] = '�Seguro que quieres BORRRAR esta categor�a?'; // js-alert
$lang_catmgr_php['category'] = 'Categor�as'; // cpg1.5
$lang_catmgr_php['operations'] = 'Operaciones';
$lang_catmgr_php['move_into'] = 'Pasar a';
$lang_catmgr_php['update_create'] = 'Actualizar/Crear categor�a';
$lang_catmgr_php['parent_cat'] = 'categor�a principal';
$lang_catmgr_php['cat_title'] = 'Titulo de la Categor�a';
$lang_catmgr_php['cat_thumb'] = 'Miniatura de la categor�a';
$lang_catmgr_php['cat_desc'] = 'Descripcion de la categor�a';
$lang_catmgr_php['categories_alpha_sort'] = 'Ordenar categor�as alfabeticamente (en lugar de orden personalizado)';
$lang_catmgr_php['save_cfg'] = 'Guardar configuracion';
$lang_catmgr_php['no_category'] = '* Sin categor�a *'; // cpg1.5
$lang_catmgr_php['group_create_alb'] = 'En esta categor�a se permite crear �lbumes a los grupos'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File contact.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('CONTACT_PHP')) {
$lang_contact_php['title'] = 'Contacto'; // cpg1.5
$lang_contact_php['your_name'] = 'Tu nombre'; // cpg1.5
$lang_contact_php['your_email'] = 'Tu correo'; // cpg1.5
$lang_contact_php['subject'] = 'Asunto'; // cpg1.5
$lang_contact_php['your_message'] = 'Tu mensaje'; // cpg1.5
$lang_contact_php['name_field_mandatory'] = 'Por favor, introduce tu nombre'; // cpg1.5 // js-alert
$lang_contact_php['name_field_invalid'] = 'Por favor, introduce un nombre v�lido'; // cpg1.5 // js-alert
$lang_contact_php['email_field_mandatory'] = 'Por favor, introduce tu correo'; // cpg1.5 // js-alert
$lang_contact_php['email_field_invalid'] = 'Por favor, introduce un correo v�lido'; // cpg1.5 // js-alert
$lang_contact_php['subject_field_mandatory'] = 'Por favor introduce un asunto significativo (m�s detallado)'; // cpg1.5 // js-alert
$lang_contact_php['message_field_mandatory'] = 'Por favor, introduce tu mensaje'; // cpg1.5 // js-alert
$lang_contact_php['confirmation'] = 'Confirmaci�n'; // cpg1.5
$lang_contact_php['email_headline'] = 'Este correo electr�nico fue enviado a %s utilizando el formulario de contacto en %s desde la direcci�n IP %s'; // cpg1.5
$lang_contact_php['registered_user'] = 'Usuario registrado'; // cpg1.5
$lang_contact_php['guest'] = 'An�nimo'; // cpg1.5
$lang_contact_php['unknown'] = 'Desconocido'; // cpg1.5
$lang_contact_php['user_info'] = 'El %s llamado %s con la direccion de correo %s dijo:'; // cpg1.5
$lang_contact_php['failed_sending_email'] = 'Fallo al enviar el correo. Por favor, int�ntalo de nuevo'; // cpg1.5
$lang_contact_php['email_sent'] = 'Se ha enviado tu correo.'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File admin.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) {
$lang_admin_php['title'] = 'Configuraci�n de galer�a';
$lang_admin_php['general_settings'] = 'Configuraci�n general'; // cpg1.5
$lang_admin_php['language_charset_settings'] = 'Idioma &amp; Conjunto de ajustes'; // cpg1.5
$lang_admin_php['themes_settings'] = 'Configuraci�n de Temas (aspecto)'; // cpg1.5
$lang_admin_php['album_list_view'] = 'Aspecto de la lista de �lbumes'; // cpg1.5
$lang_admin_php['thumbnail_view'] = 'Aspecto de la vista de miniaturas'; // cpg1.5
$lang_admin_php['image_view'] = 'Aspecto de la vista de im�genes'; // cpg1.5
$lang_admin_php['comment_settings'] = 'Configuraci�n de comentarios'; // cpg1.5
$lang_admin_php['thumbnail_settings'] = 'Configuraci�n de archivos e im�genes miniatura'; // cpg1.5
$lang_admin_php['file_settings'] = 'Configuraci�n de archivos'; // cpg1.5
$lang_admin_php['image_watermarking'] = 'Marcas de agua en im�genes'; // cpg1.5
$lang_admin_php['registration'] = 'Registro de usuarios'; // cpg1.5
$lang_admin_php['user_settings'] = 'Ajustes de usuario'; // cpg1.5
$lang_admin_php['custom_fields_user_profile'] = 'Campos personalizados para perfiles de usuarios (d�jelo en blanco si no se usa). Utilice el Perfil 6 para entradas largas, como biograf�as '; // cpg1.5
$lang_admin_php['custom_fields_image_description'] = 'Campos extra para descripci�n de im�genes (dejar en blanco si no se usan) '; // cpg1.5
$lang_admin_php['cookie_settings'] = 'Ajustes de cookies'; // cpg1.5
$lang_admin_php['email_settings'] = 'configuraci�n de correo (usualmente no requiere cambios, deje los campos en blanco si no esta seguro) '; // cpg1.5
$lang_admin_php['logging_stats'] = 'Registro de Sucesos (Log) y estad�sticas '; // cpg1.5
$lang_admin_php['maintenance_settings'] = 'Configuraciones de mantenimiento'; // cpg1.5
$lang_admin_php['manage_exif'] = 'Gesti�n de datos EXIF';
$lang_admin_php['manage_plugins'] = 'Gesti�n de plugins';
$lang_admin_php['manage_keyword'] = 'Gesti�n de palabras clave';
$lang_admin_php['restore_cfg'] = 'Restaurar los valores de f�brica';
$lang_admin_php['restore_cfg_confirm'] = '�Realmente quieres volver a los valores de f�brica para todos los par�metros? �No se puede deshacer!'; // cpg1.5 // js-alert
$lang_admin_php['save_cfg'] = 'Guardar la nueva configuraci�n';
$lang_admin_php['notes'] = 'Notas';
$lang_admin_php['info'] = 'Informaci�n';
$lang_admin_php['upd_success'] = 'La configuraci�n de Coppermine se ha actualizado';
$lang_admin_php['restore_success'] = 'Se ha restaurado la configuraci�n Coppermine a los valores por defecto';
$lang_admin_php['name_a'] = 'Nombre ascendente';
$lang_admin_php['name_d'] = 'Nombre descendente';
$lang_admin_php['title_a'] = 'T�tulo ascendente';
$lang_admin_php['title_d'] = 'T�tulo descendente';
$lang_admin_php['date_a'] = 'Fecha ascendente';
$lang_admin_php['date_d'] = 'Fecha descendente';
$lang_admin_php['pos_a'] = 'Posici�n ascendente';
$lang_admin_php['pos_d'] = 'Posici�n descendente';
$lang_admin_php['th_any'] = 'Lado m�ximo';
$lang_admin_php['th_ht'] = 'Alto';
$lang_admin_php['th_wd'] = 'Ancho';
$lang_admin_php['th_ex'] = 'Exacto'; // cpg1.5
$lang_admin_php['debug_everyone'] = 'Todos';
$lang_admin_php['debug_admin'] = 'Solo administrador';
$lang_admin_php['no_logs'] = 'Desactivado';
$lang_admin_php['log_normal'] = 'Normal';
$lang_admin_php['log_all'] = 'Todo';
$lang_admin_php['view_logs'] = 'Ver logs';

//JLM: pendiente
$lang_admin_php['click_expand'] = 'click section name to expand';

//JLM: pendiente
$lang_admin_php['click_collapse'] = 'click section name to collapse'; // cpg1.5
$lang_admin_php['expand_all'] = 'Expandir todo ';
$lang_admin_php['toggle_all'] = 'Cambiar todo'; // cpg1.5
$lang_admin_php['notice1'] = '(*) Estos valores no deben ser cambiados si ya existen archivos en la base de datos.';
$lang_admin_php['notice2'] = '(**) Si se cambian estos valores, solamente afectar� a los archivos que se a�adan desde este momento, por lo que es recomendable no cambiarlos si ya hay im�genes en la galer�a. Puedes, sin embargo, hacer los cambios sobre im�genes existentes con la utilidad &quot;<a href="util.php">Cambiar tama�os</a>&quot; del el men� de administraci�n.';
$lang_admin_php['notice3'] = '(***) Los ficheros de log est�n en ingl�s.';
$lang_admin_php['bbs_disabled'] = 'La funci�n est� descativada cuando se usa integraci�n (bridge)';
$lang_admin_php['auto_resize_everyone'] = 'Todos';
$lang_admin_php['auto_resize_user'] = 'S�lo el usuario';
$lang_admin_php['ascending'] = 'ascendente';
$lang_admin_php['descending'] = 'descendente';
$lang_admin_php['collapse_all'] = 'Contraer todo'; // cpg1.5
$lang_admin_php['separate_page'] = 'en una nueva p�gina'; // cpg1.5
$lang_admin_php['inline'] = 'en la misma p�gina'; // cpg1.5
$lang_admin_php['guests_only'] = 'S�lo invitados'; // cpg1.5
$lang_admin_php['wm_bottomright'] = 'Derecha abajo'; // cpg1.5
$lang_admin_php['wm_bottomleft'] = 'Izquierda abajo'; // cpg1.5
$lang_admin_php['wm_topleft'] = 'Izquierda arriba'; // cpg1.5
$lang_admin_php['wm_topright'] = 'Derecha arriba'; // cpg1.5
$lang_admin_php['wm_center'] = 'Centrado'; // cpg1.5
$lang_admin_php['wm_both'] = 'Ambos'; // cpg1.5
$lang_admin_php['wm_original'] = 'Original'; // cpg1.5
$lang_admin_php['wm_resized'] = 'Tama�o cambiado'; // cpg1.5
$lang_admin_php['gallery_name'] = 'Nombre de la galer�a'; // cpg1.5
$lang_admin_php['gallery_description'] = 'Descripci�n de la galer�a'; // cpg1.5
$lang_admin_php['gallery_admin_email'] = 'Correo del administrador de la galer�a'; // cpg1.5
$lang_admin_php['ecards_more_pic_target'] = 'URL de la carpeta de la galer�a'; // cpg1.5
$lang_admin_php['ecards_more_pic_target_detail'] = '(con una barra al final, no con \'index.php\' o similar al final)'; // cpg1.5
$lang_admin_php['home_target'] = 'URL de la p�gina principal'; // cpg1.5
$lang_admin_php['enable_zipdownload'] = 'Permitir descarga comprimida (ZIP) de los favoritos'; // cpg1.5
$lang_admin_php['enable_zipdownload_no_textfile'] = 's�lo los favoritos'; // cpg1.5
$lang_admin_php['enable_zipdownload_additional_textfile'] = 'favoritos y fichero readme'; // cpg1.5
$lang_admin_php['time_offset'] = 'Zona horaria respecto a GMT'; // cpg1.5
$lang_admin_php['time_offset_detail'] = '(Hora actual: %s)'; // cpg1.5
$lang_admin_php['enable_help'] = 'Habilitar iconos de ayuda'; // cpg1.5
$lang_admin_php['enable_help_description'] = 'ayuda parcialmente en ingl�s '; // cpg1.5
$lang_admin_php['clickable_keyword_search'] = 'Permitir palabras clave \'clickables\' en la b�squeda'; // cpg1.5
$lang_admin_php['keyword_separator'] = 'Separador de palabras clave'; // cpg1.5
$lang_admin_php['keyword_convert'] = 'Convertir el separador de palabras clave'; // cpg1.5
$lang_admin_php['enable_plugins'] = 'Habilitar plugins'; // cpg1.5
$lang_admin_php['purge_expired_bans'] = 'Purgar expulsiones caducadas autom�ticamente'; // cpg1.5
$lang_admin_php['browse_batch_add'] = 'Interfase navegable para a�adir im�genes por lotes'; // cpg1.5
$lang_admin_php['batch_proc_limit'] = 'Procesos concurrentes para a�adir im�genes por lotes'; // cpg1.5
$lang_admin_php['display_thumbs_batch_add'] = 'Mostrar miniaturas cuando se a�aden im�genes por lotes'; // cpg1.5
$lang_admin_php['lang'] = 'Idioma por defecto'; // cpg1.5
$lang_admin_php['language_autodetect'] = 'Detectar idioma autom�ticamente'; // cpg1.5
$lang_admin_php['charset'] = 'Juego de caracteres'; // cpg1.5 
$lang_admin_php['previous_next_tab'] = 'Mostar enlaces siguiente/anterior en las p�ginas de tablas'; // cpg1.5
$lang_admin_php['theme'] = 'Tema (aspecto)'; // cpg1.5
$lang_admin_php['custom_lnk_name'] = 'Nombre del enlace del men� personalizado '; // cpg1.5
$lang_admin_php['custom_lnk_url'] = 'URL del enlace del men� personalizado '; // cpg1.5
$lang_admin_php['enable_menu_icons'] = 'Mostrar iconos en el men�'; // cpg1.5
$lang_admin_php['show_bbcode_help'] = 'Mostar la ayuda BBCode'; // cpg1.5
$lang_admin_php['vanity_block'] = 'Mostrar el "Vanity block" en temas que han sido definidos como compilados para XHTML y CSS '; // cpg1.5
$lang_admin_php['highlight_multiple'] = 'Para marcar varias l�neas mantenga pulsada la tecla [Ctrl]'; // cpg1.5
$lang_admin_php['custom_header_path'] = 'Ruta de inserci�n de la cabecera personalizada'; // cpg1.5
$lang_admin_php['custom_footer_path'] = 'Ruta de inserci�n del pie de p�gina personalizado'; // cpg1.5
$lang_admin_php['browse_by_date'] = 'Permitir la navegaci�n por fecha'; // cpg1.5
$lang_admin_php['display_redirection_page'] = 'Mostar las p�ginas redirigidas'; // cpg1.5
$lang_admin_php['display_xp_publish_link'] = 'Alentar el uso del XP Publisher mostrando un enlace en la p�gina de carga'; // cpg1.5
$lang_admin_php['main_table_width'] = 'Ancho de la tabla principal'; // cpg1.5
$lang_admin_php['pixels_or_percent'] = 'pixels or %'; // cpg1.5
$lang_admin_php['subcat_level'] = 'N�mero de niveles de categor�as a mostrar'; // cpg1.5
$lang_admin_php['albums_per_page'] = 'N�mero de �lbumes a mostrar'; // cpg1.5
$lang_admin_php['album_list_cols'] = 'N�mero de columnas en la lista de �lbumes'; // cpg1.5
$lang_admin_php['alb_list_thumb_size'] = 'Tama�o de las im�genes miniatura en pixels'; // cpg1.5
$lang_admin_php['main_page_layout'] = 'Contenido de la p�gina principal'; // cpg1.5
$lang_admin_php['first_level'] = 'Mostrar imagen miniatura de �lbumes de primer nivel en categor�as'; // cpg1.5
$lang_admin_php['categories_alpha_sort'] = 'Organizar categor�a alfab�ticamente'; // cpg1.5
$lang_admin_php['categories_alpha_sort_details'] = '(en lugar del orden predefinida)'; // cpg1.5
$lang_admin_php['link_pic_count'] = 'Mostrar numero de archivos enlazados'; // cpg1.5
$lang_admin_php['thumbcols'] = 'N�mero de columnas en la p�gina de im�genes miniatura'; // cpg1.5
$lang_admin_php['thumbrows'] = 'N�mero de filas en la p�gina de im�genes miniatura'; // cpg1.5
$lang_admin_php['max_tabs'] = 'M�ximo n�mero de pesta�as (tabs) a mostrar'; // cpg1.5
$lang_admin_php['tabs_dropdown'] = 'Mostrar lista desplegable de p�ginas junto a las pesta�as (tabs)'; // cpg1.5

//JLM: pendiente
$lang_admin_php['caption_in_thumbview'] = 'Mostrar file caption (adem�s del t�tulo) debajo de la imagen miniatura'; // cpg1.5
$lang_admin_php['views_in_thumbview'] = 'Mostrar n�mero de veces vista debajo de la imagen miniatura'; // cpg1.5
$lang_admin_php['display_comment_count'] = 'Mostrar n�mero de comentarios debajo de la imagen miniatura'; // cpg1.5

//JLM: pendiente
$lang_admin_php['display_uploader'] = 'Mostrar nombre del usuario que a�adi� el archivo debajo de la imagen miniatura'; // cpg1.5

//JLM: pendiente
//$lang_admin_php['display_admin_uploader'] = 'Mostrar nombre del usuario que a�adi� el archivo debajo de la imagen miniatura'; // cpg1.5
$lang_admin_php['display_filename'] = 'Mostrar nombre de la imagen miniatura'; // cpg1.5

//JLM: pendiente
$lang_admin_php['display_thumbnail_rating'] = 'Display rating below the thumbnail'; // cpg1.5
$lang_admin_php['alb_desc_thumb'] = 'Mostrar la descripci�n del �lbum'; // cpg1.5
$lang_admin_php['thumbnail_to_fullsize'] = 'Mostrar la imagen a tama�o completo desde la miniatura'; // cpg1.5
$lang_admin_php['default_sort_order'] = 'Orden por defecto de los ficheros'; // cpg1.5
$lang_admin_php['min_votes_for_rating'] = 'M�nimo n�mero de votos para que una foto aparezca el la lista de \'M�s Valoradas\' '; // cpg1.5
$lang_admin_php['picture_table_width'] = 'Ancho de la tabla de ficheros'; // cpg1.5
$lang_admin_php['display_pic_info'] = 'Informaci�n del fichero visible por defecto'; // cpg1.5
$lang_admin_php['picinfo_movie_download_link'] = 'Mostrar el enlace de descarga en el �rea de informaci�n'; // cpg1.5
$lang_admin_php['max_img_desc_length'] = 'Longitud m�xima de la descripci�n de la imagen'; // cpg1.5
$lang_admin_php['max_com_wlength'] = 'Longitud m�xima de una palabra'; // cpg1.5
$lang_admin_php['display_film_strip'] = 'Mostrar tira de pel�cula'; // cpg1.5
$lang_admin_php['max_film_strip_items'] = 'N�mero de objetos en tira de pel�cula'; // cpg1.5
$lang_admin_php['slideshow_interval'] = 'Intervalo de tiempo entre im�genes en la presentaci�n en'; // cpg1.5
$lang_admin_php['milliseconds'] = 'milisegundos'; // cpg1.5
$lang_admin_php['slideshow_interval_detail'] = '1 segundo = 1000 milisegundos'; // cpg1.5
$lang_admin_php['slideshow_hits'] = 'Contar las vistas en las presentaciones'; // cpg1.5
$lang_admin_php['ecard_flash'] = 'Permitir Flash en las postales'; // cpg1.5
$lang_admin_php['not_recommended'] = 'no recomendado'; // cpg1.5
$lang_admin_php['recommended'] = 'recomendado'; // cpg1.5
$lang_admin_php['transparent_overlay'] = 'Insertar una capa trasnparente para minimizar el robo de im�genes'; // cpg1.5
$lang_admin_php['old_style_rating'] = 'Usar el antiguo sistema de votaciones'; // cpg1.5 //JLM
$lang_admin_php['old_style_rating_extra'] = 'Esto deshabilitar� la opci�n \'N�mero de estrellas que se usar�n\''; // cpg1.5
$lang_admin_php['rating_stars_amount'] = 'N�mero de estrellas que se usar�n en la votaci�n'; // cpg1.5
$lang_admin_php['rate_own_files'] = 'Los usuarios pueden votar sus propios ficheros'; // cpg1.5
$lang_admin_php['filter_bad_words'] = 'Filtrar palabras malsonantes en los comentarios'; // cpg1.5
$lang_admin_php['enable_smilies'] = 'Permitir emoticonos en los comentarios'; // cpg1.5
$lang_admin_php['disable_comment_flood_protect'] = 'Permitir varios comentarios consecutivos del mismo usuario en una imagen'; // cpg1.5
$lang_admin_php['disable_comment_flood_protect_details'] = '(deshabilitar protecci�n contra flood)'; // cpg1.5
$lang_admin_php['max_com_lines'] = 'M�ximo n�mero de l�neas en un comentario'; // cpg1.5
$lang_admin_php['max_com_size'] = 'M�xima longitud de un comentario'; // cpg1.5
$lang_admin_php['email_comment_notification'] = 'Notificar al administrador por correo sobre los comentarios a�adidos'; // cpg1.5
$lang_admin_php['comments_sort_descending'] = 'Ordenar los comentarios'; // cpg1.5
$lang_admin_php['comments_per_page'] = 'Comentarios por p�gina'; // cpg1.5
$lang_admin_php['comments_anon_pfx'] = 'Prefijo para autores an�nimos'; // cpg1.5
$lang_admin_php['comment_approval'] = 'Aprobaci�n necesaria para los comentarios'; // cpg1.5
$lang_admin_php['display_comment_approval_only'] = 'Mostrar s�lo los comentarios pendientes de aprobaci�n en la p�gina &quot;Revisar comentarios&quot;'; // cpg1.5
$lang_admin_php['comment_placeholder'] = 'Display placeholder text to end users for comments waiting for admin approval'; // cpg1.5 //Pendiente
$lang_admin_php['comment_user_edit'] = 'Permitir a los usuarios editar sus propios comentarios'; // cpg1.5
$lang_admin_php['comment_captcha'] = 'Mostrar confirmaci�n visual (Captcha) para a�adir comentarios'; // cpg1.5
$lang_admin_php['comment_akismet_enable'] = 'Opciones Akismet'; // cpg1.5
$lang_admin_php['comment_akismet_enable_description'] = '�Qu� hacer si Akismet rechaza un comentario como spam?'; // cpg1.5
$lang_admin_php['comment_akismet_applicable_only'] = 'Las opciones s�lo aplican si se habilita Akismet con una clave API v�lida'; // cpg1.5
$lang_admin_php['comment_akismet_enable_approval'] = 'Permitir comentarios que no pasan el filtro Akismet, pero marcarlos como no aprobados'; // cpg1.5
$lang_admin_php['comment_akismet_drop_tell'] = 'Borrar el comentario que no se valida e informar al autor que fu� rechazado'; // cpg1.5
$lang_admin_php['comment_akismet_drop_lie'] = 'Borrar el comentario que no se valida e informar al autor que fu� a�adido'; // cpg1.5
$lang_admin_php['comment_akismet_api_key'] = 'Clave API de Akismet'; // cpg1.5
$lang_admin_php['comment_akismet_api_key_description'] = 'D�jelo en blanco para deshabilitar Akismet'; // cpg1.5
$lang_admin_php['comment_akismet_group'] = 'Applicar Akismet a los comentarios de'; // cpg1.5
$lang_admin_php['comment_promote_registration'] = 'Pedir a los usuarios que se registren y accedan para dejar comentarios'; // cpg1.5
$lang_admin_php['thumb_width'] = 'Dimansi�n mayor de una miniatura (anchura, si usas "Exacta" en "Usar dimensi�n")'; // cpg1.5
$lang_admin_php['thumb_use'] = 'Usar dimensi�n'; // cpg1.5
$lang_admin_php['thumb_use_detail'] = '(anchura, altura o aspecto m�ximo de la miniatura)'; // cpg1.5
$lang_admin_php['thumb_height'] = 'Alto de la miniatura'; // cpg1.5
$lang_admin_php['thumb_height_detail'] = '(s�lo aplica si se usa &quot;Exacta&quot; en &quot;Usar dimensi�n&quot;)'; // cpg1.5
$lang_admin_php['movie_audio_document'] = 'Pel�cula, sonido, documento'; // cpg1.5
$lang_admin_php['thumb_pfx'] = 'Prefijo para las miniaturas'; // cpg1.5
$lang_admin_php['enable_unsharp'] = 'Thumb Sharpening: enable Unsharp Mask'; // cpg1.5 //Pendiente
$lang_admin_php['unsharp_amount'] = 'Thumb Sharpening amount'; // cpg1.5 //Pendiente
$lang_admin_php['unsharp_radius'] = 'Thumb Sharpening radius'; // cpg1.5 //Pendiente
$lang_admin_php['unsharp_threshold'] = 'Thumb Sharpening threshold'; // cpg1.5 //Pendiente
$lang_admin_php['jpeg_qual'] = 'Calidad de los ficheros JPEG'; // cpg1.5
$lang_admin_php['make_intermediate'] = 'Crear im�genes intermedias'; // cpg1.5
$lang_admin_php['picture_use'] = 'Usar dimensi�n'; // cpg1.5
$lang_admin_php['picture_use_detail'] = '(ancho, alto o m�ximo para una imagen intermedia)'; // cpg1.5
$lang_admin_php['picture_use_thumb'] = 'Como la miniatura'; // cpg1.5
$lang_admin_php['picture_width'] = 'M�x. ancho o alto de una imagen intermedia'; // cpg1.5
$lang_admin_php['max_upl_size'] = 'Tama�o m�ximo de los ficheros cargados'; // cpg1.5
$lang_admin_php['kilobytes'] = 'KB'; // cpg1.5
$lang_admin_php['pixels'] = 'pixels'; // cpg1.5
$lang_admin_php['max_upl_width_height'] = 'Ancho o alto m�ximos de las im�genes cargadas width or height for uploaded pictures'; // cpg1.5
$lang_admin_php['auto_resize'] = 'Escalar autom�ticamente las im�genes mayores que el ancho o alto m�ximo'; // cpg1.5
$lang_admin_php['fullsize_padding_x'] = 'Horizontal padding for full-size pop-up'; // cpg1.5 //pendiente
$lang_admin_php['fullsize_padding_y'] = 'Vertical padding for full-size pop-up'; // cpg1.5 //pendiente
$lang_admin_php['allow_private_albums'] = 'Permitir �lbumes privados'; // cpg1.5
$lang_admin_php['allow_private_albums_note'] = '(Nota: Si cambias de  \'Si\' a \'No\' todos los �lbumes privados que est�n ya definidos ser�n visibles)'; // cpg1.5
$lang_admin_php['show_private'] = 'Mostrar icono de �lbum privado a los usuarios no logueados'; // cpg1.5
$lang_admin_php['forbiden_fname_char'] = 'Caracteres prohibidos en los nombres de fichero'; // cpg1.5
$lang_admin_php['silly_safe_mode'] = 'Permitir &quot;silly safe mode&quot;'; // cpg1.5 //pendiente
$lang_admin_php['allowed_img_types'] = 'Tipos de im�genes permitidos'; // cpg1.5
$lang_admin_php['allowed_mov_types'] = 'Tipos de archivos de video admitidos'; // cpg1.5
$lang_admin_php['media_autostart'] = 'Autoinicio de Peliculas'; // cpg1.5
$lang_admin_php['allowed_snd_types'] = 'Tipos de archivos de sonido admitidos'; // cpg1.5
$lang_admin_php['allowed_doc_types'] = 'Tipos de documentos admitidos'; // cpg1.5
$lang_admin_php['thumb_method'] = 'M�todo para el reescalado de im�genes'; // cpg1.5
$lang_admin_php['impath'] = 'Ruta a la utilidad \'convert\' de ImageMagick'; // cpg1.5
$lang_admin_php['impath_example'] = '(por ejemplo /usr/bin/X11/)'; // cpg1.5
$lang_admin_php['im_options'] = 'Comandos de l�nea para ImageMagick'; // cpg1.5
$lang_admin_php['read_exif_data'] = 'Leer datos EXIF en los archivos JPEG'; // cpg1.5
$lang_admin_php['read_iptc_data'] = 'Leer datos IPTC en los archivos JPEG'; // cpg1.5
$lang_admin_php['fullpath'] = 'Directorio base de los �lbumes'; // cpg1.5
$lang_admin_php['userpics'] = 'Directorio para los archivos de los usuarios'; // cpg1.5
$lang_admin_php['normal_pfx'] = 'Prefijo para las im�genes intermedias'; // cpg1.5
$lang_admin_php['default_dir_mode'] = 'Modo por defecto para los directorios'; // cpg1.5
$lang_admin_php['default_file_mode'] = 'Modo por defecto para los ficheros'; // cpg1.5
$lang_admin_php['enable_watermark'] = 'Im�genes para marca de agua'; // cpg1.5
$lang_admin_php['enable_thumb_watermark'] = 'Miniaturas definidas por el usuario para marca de agua'; // cpg1.5
$lang_admin_php['where_put_watermark'] = 'Lugar en que se pondr� la marca de agua'; // cpg1.5
$lang_admin_php['which_files_to_watermark'] = 'A qu� ficheros aplicar la marca de agua'; // cpg1.5
$lang_admin_php['watermark_file'] = 'Qu� fichero se usar� para marca de agua'; // cpg1.5
$lang_admin_php['watermark_transparency'] = 'Transparencia de la imagen completa'; // cpg1.5
$lang_admin_php['zero_2_hundred'] = '0-100'; // cpg1.5
$lang_admin_php['reduce_watermark'] = 'Reescalar la marca de agua si el ancho de la imagen es menor que el valor introducido. Esa se usar� como referencia del 100%. El reescalado de la marca de agua es lineal (0 para deshabilitarla)'; // cpg1.5
$lang_admin_php['watermark_transparency_featherx'] = 'Establecer x para el color transparente'; // cpg1.5
$lang_admin_php['watermark_transparency_feathery'] = 'Establecer y para el color transparente'; // cpg1.5
$lang_admin_php['gd2_only'] = 'S�lo para GD2'; // cpg1.5
$lang_admin_php['allow_user_registration'] = 'Permitir registrarse a nuevos usuarios'; // cpg1.5
$lang_admin_php['global_registration_pw'] = 'Contrase�a general al registrarse'; // cpg1.5
$lang_admin_php['user_registration_disclaimer'] = 'Mostrar \'disclaimer\' en el registro de usuario'; // cpg1.5
$lang_admin_php['registration_captcha'] = 'Mostrar confirmaci�n visual (Captcha) en la p�gina de registro'; // cpg1.5
$lang_admin_php['reg_requires_valid_email'] = 'Registro de usuarios requiere verificaci�n de email '; // cpg1.5
$lang_admin_php['reg_notify_admin_email'] = 'Notificar por email al administrador del registro de nuevos usuarios '; // cpg1.5
$lang_admin_php['admin_activation'] = 'El administrador activa los registros de usuario'; // cpg1.5
$lang_admin_php['personal_album_on_registration'] = 'Crear un �lbum de usuario en la galer�a personal al registrarse'; // cpg1.5
$lang_admin_php['allow_unlogged_access'] = 'Permitir accesos de usuarios no logueados (invitados o an�nimos) '; // cpg1.5
$lang_admin_php['thumbnail_intermediate_full'] = 'im�genes miniatura, intermedias y a tama�o completo'; // cpg1.5
$lang_admin_php['thumbnail_intermediate'] = 'im�genes miniatura y a tama�o completo'; // cpg1.5
$lang_admin_php['thumbnail_only'] = 's�lo miniatura'; // cpg1.5
$lang_admin_php['upload_mechanism'] = 'M�todo de carga de im�genes por defecto'; // cpg1.5

//JLM: pendiente
$lang_admin_php['upload_swf'] = 'avanzado - m�ltiples ficheros, usa Flash (recomendado)'; // cpg1.5
$lang_admin_php['upload_single'] = 'simple - un fichero cada vez'; // cpg1.5
$lang_admin_php['allow_user_upload_choice'] = 'Permitir a los usuarios elegir el m�todo de subida'; // cpg1.5
$lang_admin_php['allow_duplicate_emails_addr'] = 'Permitir a dos usuarios tener el mismo correo '; // cpg1.5
$lang_admin_php['upl_notify_admin_email'] = 'Notificar al administrador de archivos a�adidos esperando autorizaci�n'; // cpg1.5
$lang_admin_php['allow_memberlist'] = 'Permitir a los usuarios validados ver la lista de miembros'; // cpg1.5
$lang_admin_php['allow_email_change'] = 'Permitir a los usuarios cambiar su correo en su perfil'; // cpg1.5
$lang_admin_php['allow_user_account_delete'] = 'Permitir a los usuarios borrar su cuenta'; // cpg1.5
$lang_admin_php['users_can_edit_pics'] = 'Permitir a los usuarios tener control sobre sus archivos en galerias publicas'; // cpg1.5
$lang_admin_php['allow_user_move_album'] = 'Permitir a los usuarios mover sus �lbumes desde/hasta las categor�as permitidas'; // cpg1.5
$lang_admin_php['allow_user_album_keyword'] = 'Permitir a los usuarios asignar palabras clave al �lbum'; // cpg1.5
$lang_admin_php['allow_user_edit_after_cat_close'] = 'Permitir a los usuarios editar sus �lbumess en categor�as bloqueadas'; // cpg1.5
$lang_admin_php['login_method_username'] = 'Nombre de usuario'; // cpg1.5
$lang_admin_php['login_method_email'] = 'correo'; // cpg1.5
$lang_admin_php['login_method_both'] = 'Ambos'; // cpg1.5
$lang_admin_php['login_method'] = '�C�mo se permitir� a los usuarios acceder?'; // cpg1.5
$lang_admin_php['login_threshold'] = 'Numero de intentos fallidos de autentificaci�n antes de proceder a la expulsi�n'; // cpg1.5
$lang_admin_php['login_threshold_detail'] = '(para evitar ataques de fuerza bruta)'; // cpg1.5
$lang_admin_php['login_expiry'] = 'Duraci�n de la expulsi�n luego de los intentos fallidos'; // cpg1.5
$lang_admin_php['minutes'] = 'minutos'; // cpg1.5
$lang_admin_php['report_post'] = 'Habilitar reporte al Administrador'; // cpg1.5
$lang_admin_php['user_profile1_name'] = 'Nombre de perfil 1'; // cpg1.5
$lang_admin_php['user_profile2_name'] = 'Nombre de perfil 2'; // cpg1.5
$lang_admin_php['user_profile3_name'] = 'Nombre de perfil 3'; // cpg1.5
$lang_admin_php['user_profile4_name'] = 'Profile 4 name'; // cpg1.5
$lang_admin_php['user_profile5_name'] = 'Profile 5 name'; // cpg1.5
$lang_admin_php['user_profile6_name'] = 'Profile 6 name'; // cpg1.5
$lang_admin_php['user_field1_name'] = 'Nombre de campo 1'; // cpg1.5
$lang_admin_php['user_field2_name'] = 'Nombre de Campo 2'; // cpg1.5
$lang_admin_php['user_field3_name'] = 'Nombre de Campo 3'; // cpg1.5
$lang_admin_php['user_field4_name'] = 'Nombre de Campo 4'; // cpg1.5
$lang_admin_php['cookie_name'] = 'Nombre de la cookie usada por el script'; // cpg1.5
$lang_admin_php['cookie_path'] = 'Ruta de la cookie usada por el script'; // cpg1.5
$lang_admin_php['smtp_host'] = 'Servidor SMTP (si se deja en blanco se usara sendmail) '; // cpg1.5
$lang_admin_php['smtp_username'] = 'Usuario SMTP'; // cpg1.5
$lang_admin_php['smtp_password'] = 'Contrase�a SMTP'; // cpg1.5
$lang_admin_php['log_mode'] = 'Modo de registro de sucesos'; // cpg1.5
$lang_admin_php['log_mode_details'] = 'Todos los registros se escriben en ingl�s.'; // cpg1.5
$lang_admin_php['log_ecards'] = 'Registrar los sucesos de postales'; // cpg1.5
$lang_admin_php['log_ecards_detail'] = 'Nota: Registrar los sucesos puede tener consecuencias legales. Debes informar al usuario cuando se registre que se est� registrando la informaci�n de las postales. Tambi�n se recomienda crear una p�gina separada con las directrices de la pol�tica de privacidad.'; // cpg1.5
$lang_admin_php['vote_details'] = 'Mantener estad�sticas detalladas de los votos'; // cpg1.5
$lang_admin_php['hit_details'] = 'Mantener estad�sticas detalladas de los hits'; // cpg1.5
$lang_admin_php['display_stats_on_index'] = 'Mostrar estad�sticas ewn la p�gina �ndice'; // cpg1.5
$lang_admin_php['count_file_hits'] = 'Contar visitas a ficheros'; // cpg1.5
$lang_admin_php['count_album_hits'] = 'Contar visitas a los �lbumes'; // cpg1.5
$lang_admin_php['count_admin_hits'] = 'Contar las visitas del administrador'; // cpg1.5
$lang_admin_php['debug_mode'] = 'Habilitar depuraci�n'; // cpg1.5
$lang_admin_php['debug_notice'] = 'Mostar noticias en el modo de depuraci�n'; // cpg1.5
$lang_admin_php['offline'] = 'La galer�a est� desactivada'; // cpg1.5
$lang_admin_php['display_coppermine_news'] = 'Mostar noticias de coppermine-gallery.net'; // cpg1.5
$lang_admin_php['display_coppermine_detail'] = 'S�lo se mostrar�n al administrador'; // cpg1.5
$lang_admin_php['config_setting_invalid'] = 'El valor establecido en &laquo;%s&raquo; no es v�lido, rev�salo por favor.'; // cpg1.5
$lang_admin_php['config_setting_ok'] = 'Se ha guardado el valor de &laquo;%s&raquo;.'; // cpg1.5
$lang_admin_php['contact_form_settings'] = 'Ajustes del formulario de contacto'; // cpg1.5
$lang_admin_php['contact_form_guest_enable'] = 'Mostrar el formulario de contacto para usuarios an�nimos (invitados)'; // cpg1.5
$lang_admin_php['contact_form_registered_enable'] = 'Mostrar el formulario de contacto para usuarios an�nimos registrados'; // cpg1.5
$lang_admin_php['with_captcha'] = 'con confirmaci�n visual (captcha)'; // cpg1.5
$lang_admin_php['without_captcha'] = 'sin confirmaci�n visual (captcha)'; // cpg1.5
$lang_admin_php['optional'] = 'opcional'; // cpg1.5
$lang_admin_php['mandatory'] = 'obligatorio'; // cpg1.5

//JLM
$lang_admin_php['contact_form_guest_name_field'] = 'Display sender name field for guests'; // cpg1.5
$lang_admin_php['contact_form_guest_email_field'] = 'Display sender email field for guests'; // cpg1.5
$lang_admin_php['contact_form_subject_field'] = 'Display subject field'; // cpg1.5
$lang_admin_php['contact_form_subject_content'] = 'Subject line for emails generated by contact form'; // cpg1.5
$lang_admin_php['contact_form_sender_email'] = 'Use the sender\'s email address as &quot;from&quot; address'; // cpg1.5
$lang_admin_php['allow_no_link'] = 'allow, but don\'t display link'; // cpg1.5
$lang_admin_php['allow_show_link'] = 'allow and promote it by displaying a link'; // cpg1.5
$lang_admin_php['display_sidebar_user'] = 'Sidebar for registered users'; // cpg1.5
$lang_admin_php['display_sidebar_guest'] = 'Sidebar for guests'; // cpg1.5
$lang_admin_php['do_not_change'] = 'Don\'t change this unless you REALLY know what you\'re doing!'; // cpg1.5
$lang_admin_php['reset_to_default'] = 'Reset to default'; // cpg1.5
$lang_admin_php['no_change_needed'] = 'No change needed, config option already is set to default'; // cpg1.5
$lang_admin_php['enabled'] = 'enabled'; // cpg1.5
$lang_admin_php['disabled'] = 'disabled'; // cpg1.5
$lang_admin_php['none'] = 'none'; // cpg1.5
$lang_admin_php['warning_change'] = 'When changing this setting, only the files that are added from that point on are affected, so it\'s advisable that this setting is not changed if there are already files in the gallery. You can, however, apply the changes to the existing files with the "admin tools (resize pictures)" utility from the admin menu.'; // cpg1.5
$lang_admin_php['warning_exist'] = 'These settings mustn\'t be changed if you already have files in your database.'; // cpg1.5
$lang_admin_php['warning_dont_submit'] = 'If you are not sure about the impact that changing this setting will have, do not submit the form and review the documentation first.'; // cpg1.5 // js-alert
$lang_admin_php['menu_only'] = 'menu only'; // cpg1.5
$lang_admin_php['everywhere'] = 'everywhere'; // cpg1.5
$lang_admin_php['manage_languages'] = 'Manage languages'; // cpg1.5
$lang_admin_php['form_token_lifetime'] = 'Form token lifetime'; // cpg1.5
$lang_admin_php['seconds'] = 'Seconds'; // cpg1.5
$lang_admin_php['display_reset_boxes_in_config'] = 'Display reset boxes in config'; // cpg1.5
$lang_admin_php['upd_not_needed'] = 'Update not needed.'; // cpg 1.5
}

// ------------------------------------------------------------------------- //
// File db_ecard.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('DB_ECARD_PHP')) {
$lang_db_ecard_php['title'] = 'Enviar postales';
$lang_db_ecard_php['ecard_sender'] = 'Remitente';
$lang_db_ecard_php['ecard_recipient'] = 'Destinatario';
$lang_db_ecard_php['ecard_date'] = 'Fecha';
$lang_db_ecard_php['ecard_display'] = 'Mostrar postales';
$lang_db_ecard_php['ecard_name'] = 'Nombre';
$lang_db_ecard_php['ecard_email'] = 'Email';
$lang_db_ecard_php['ecard_ip'] = 'IP';
$lang_db_ecard_php['ecard_ascending'] = 'Ascendente';
$lang_db_ecard_php['ecard_descending'] = 'Descendente';
$lang_db_ecard_php['ecard_sorted'] = 'Ordenadas';
$lang_db_ecard_php['ecard_by_date'] = 'por fecha';
$lang_db_ecard_php['ecard_by_sender_name'] = 'por nombre del remitente';
$lang_db_ecard_php['ecard_by_sender_email'] = 'por correo(s) del remitente';
$lang_db_ecard_php['ecard_by_sender_ip'] = 'por la direccion IP del remitente';
$lang_db_ecard_php['ecard_by_recipient_name'] = 'por nombre del destinatario';
$lang_db_ecard_php['ecard_by_recipient_email'] = 'por correo(s) del destinatario';
$lang_db_ecard_php['ecard_number'] = 'mostrando los registros %s a %s de %s';
$lang_db_ecard_php['ecard_goto_page'] = 'ir a la p�gina';
$lang_db_ecard_php['ecard_records_per_page'] = 'Registros por p�gina';
$lang_db_ecard_php['check_all'] = 'Marcar todas';
$lang_db_ecard_php['uncheck_all'] = 'Desmarcar todas';
$lang_db_ecard_php['ecards_delete_selected'] = 'Borrar postales seleccionadas';
$lang_db_ecard_php['ecards_delete_confirm'] = '�Estas seguro de que quieres borrar los registros? Marca la casilla de verificacion!';
$lang_db_ecard_php['ecards_delete_sure'] = 'Estoy seguro';
$lang_db_ecard_php['invalid_data'] = 'Los datos de la postal a la que est� intentando acceder han sido corrompidos por su cliente de correo. Compruebe que la conexi�n se ha completado.';
}

// ------------------------------------------------------------------------- //
// File db_input.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) {
$lang_db_input_php['empty_name_or_com'] = 'Es necesario que escribas tu nombre y un comentario';
$lang_db_input_php['com_added'] = 'Comentario a�adido'; // cpg1.5
$lang_db_input_php['alb_need_title'] = 'Tienes que proporcionar un t�tulo para el �lbum!';
$lang_db_input_php['no_udp_needed'] = 'No necesita actualizacion.';
$lang_db_input_php['alb_updated'] = 'El �lbum fue actualizado';
$lang_db_input_php['unknown_album'] = 'El �lbum seleccionado no existe o no tienes permiso para verlo';
$lang_db_input_php['no_pic_uploaded'] = 'Ningun archivo cargado!<br />Si realmente has seleccionado un archivo para subir, revisa si el servidor acepta la subida de archivos ...';
$lang_db_input_php['err_mkdir'] = 'Fallo en la creaci�n del directorio %s!';
$lang_db_input_php['dest_dir_ro'] = 'El directorio destino %s no es modificable por el script!';
$lang_db_input_php['err_move'] = 'Imposible mover %s a %s!';
$lang_db_input_php['err_fsize_too_large'] = 'La foto que ha subido es muy grande (maximo permitido es %s x %s)!';
$lang_db_input_php['err_imgsize_too_large'] = 'La foto que has subido ocupa mucho (maximo permitido es %s KB)!';
$lang_db_input_php['err_invalid_img'] = 'El archivo que quieres subir no es una imagen v�lida!';
$lang_db_input_php['allowed_img_types'] = 'Puedes subir %s im�genes.';
$lang_db_input_php['err_insert_pic'] = 'La foto \'%s\' no puede ser insertada en el �lbum ';
$lang_db_input_php['upload_success'] = 'Tu foto se ha cargado satisfactoriamente.<br />Ser� visible despues de que el administrador la apruebe.';
$lang_db_input_php['notify_admin_email_subject'] = '%s - Notoficaci�n de subida';
$lang_db_input_php['notify_admin_email_body'] = '%s ha cargado una foto y necesita ser aprobada. Visita %s';
$lang_db_input_php['info'] = 'Informaci�n';
$lang_db_input_php['com_added'] = 'Comentario a�adido';
$lang_db_input_php['com_updated'] = 'Comentario actualizado'; // cpg1.5
$lang_db_input_php['alb_updated'] = '�lbum actualizado';
$lang_db_input_php['err_comment_empty'] = 'Tu comentario esta vacio!';
$lang_db_input_php['err_invalid_fext'] = 'S�lo se aceptan archivos con las siguientes extensiones:'; // js-alert
$lang_db_input_php['no_flood'] = 'Lo siento, pero eres el autor del �ltimo comentario publicado para este archivo<br />Edita el comentario que has escrito si quieres modificarlo';
$lang_db_input_php['redirect_msg'] = 'Est�s siendo redireccionado.<br /><br />Click en \'Continuar\' si la p�gina no se actualiza automaticamente';
$lang_db_input_php['upl_success'] = 'Archivo cargado satisfactoriamente';
$lang_db_input_php['email_comment_subject'] = 'Comentario escrito en la galer�a Coppermine';
$lang_db_input_php['email_comment_body'] = 'Alguien ha escrito un comentario en tu galer�a. Miralo en';
$lang_db_input_php['album_not_selected'] = '�lbum no seleccionado';
$lang_db_input_php['com_author_error'] = 'Un usuario registrado esta usando este nick. Elige otro o accede';
}

// ------------------------------------------------------------------------- //
// File delete.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) {
$lang_delete_php['orig_pic'] = 'Imagen original'; // cpg1.5
$lang_delete_php['fs_pic'] = 'Imagen a tama�o completo';
$lang_delete_php['del_success'] = 'Borrado satisfactoriamente!';
$lang_delete_php['ns_pic'] = 'Imagen de tama�o normal';
$lang_delete_php['err_del'] = 'No puede ser borrado';
$lang_delete_php['thumb_pic'] = 'Miniatura';
$lang_delete_php['comment'] = 'Comentario';
$lang_delete_php['im_in_alb'] = 'Imagen en �lbum';
$lang_delete_php['alb_del_success'] = '�lbum &laquo;%s&raquo; borrado';
$lang_delete_php['alb_mgr'] = 'Administrador de �lbumes';
$lang_delete_php['err_invalid_data'] = 'Datos no v�lidos recibidos en \'%s\'';
$lang_delete_php['create_alb'] = 'Creando �lbum \'%s\'';
$lang_delete_php['update_alb'] = 'Actualizando �lbum \'%s\' con el t�tulo \'%s\' e �ndice \'%s\'';
$lang_delete_php['del_pic'] = 'Borrar archivo';
$lang_delete_php['del_alb'] = 'Borrar �lbum';
$lang_delete_php['del_user'] = 'Borrar usuario';
$lang_delete_php['err_unknown_user'] = 'El usuario seleccionado no existe!';
$lang_delete_php['err_empty_groups'] = 'No existe la tabla de grupos, o la tabla est� vac�a!';
$lang_delete_php['comment_deleted'] = 'Comentario borrado';
$lang_delete_php['npic'] = 'Imagen';
$lang_delete_php['pic_mgr'] = 'Gestor de im�genes';
$lang_delete_php['update_pic'] = 'Actualizando la imagen \'%s\' con nombre de fichero \'%s\' e �ndice \'%s\'';
$lang_delete_php['username'] = 'Usuario';
$lang_delete_php['anonymized_comments'] = '%s comentarios(s) pasados a an�nimos';
$lang_delete_php['anonymized_uploads'] = '%s subida(s) p�blica(s) pasados a an�nimos';
$lang_delete_php['deleted_comments'] = '%s comentario(s) borrados';
$lang_delete_php['deleted_uploads'] = '%s subida(s) p�blica(s) borradas';
$lang_delete_php['user_deleted'] = 'usuario %s borrado';
$lang_delete_php['activate_user'] = 'Activar usuario';
$lang_delete_php['user_already_active'] = 'La cuenta ya est� activa';
$lang_delete_php['activated'] = 'Activado';
$lang_delete_php['deactivate_user'] = 'Desactivar usuario';
$lang_delete_php['user_already_inactive'] = 'La cuenta ya est� inactiva';
$lang_delete_php['deactivated'] = 'Desactivada';
$lang_delete_php['reset_password'] = 'Reset password(s)';
$lang_delete_php['password_reset'] = 'Password reset to %s';
$lang_delete_php['change_group'] = 'Cambiar grupo principal';
$lang_delete_php['change_group_to_group'] = 'Cambiando de %s a %s';
$lang_delete_php['add_group'] = 'A�adir otro grupo';
$lang_delete_php['add_group_to_group'] = 'A�adiendo el usuario %s al grupo %s. Ahora es miembro de %s como principal y de %s como secundario.';
$lang_delete_php['status'] = 'Estado';
$lang_delete_php['updating_album'] = 'Actualizando �lbum '; // cpg1.5
$lang_delete_php['moved_picture_to_position'] = 'Imagen %s movida a la posici�n %s'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File displayimage.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP'))
{
$lang_display_image_php['confirm_del'] = 'Estas seguro de querer BORRAR este archivo?\\nTambi�n se borrar�n comentarios.'; // js-alert
$lang_display_image_php['del_pic'] = 'Borrar este archivo';
$lang_display_image_php['size'] = '%s x %s pixeles';
$lang_display_image_php['views'] = '%s visitas';
$lang_display_image_php['slideshow'] = 'Presentacion de diapositivas';
$lang_display_image_php['stop_slideshow'] = 'Detener presentacion de diapositivas';
$lang_display_image_php['view_fs'] = 'Click para ver la imagen a tama�o completo';
$lang_display_image_php['edit_pic'] = 'Editar la informacion del archivo';
$lang_display_image_php['crop_pic'] = 'Cortar y girar';
$lang_display_image_php['set_player'] = 'Cambiar el reproductor';
$lang_picinfo['title'] = 'Informacion de archivo';
$lang_picinfo['Album name'] = 'Nombre de �lbum';
$lang_picinfo['Rating'] = 'Votado (%s votos)';
$lang_picinfo['Date Added'] = 'Fecha a�adida';
$lang_picinfo['Dimensions'] = 'Dimensiones';
$lang_picinfo['Displayed'] = 'Visto';
$lang_picinfo['URL'] = 'URL';
$lang_picinfo['Make'] = 'Hecho';
$lang_picinfo['Model'] = 'Modelo';
$lang_picinfo['DateTime'] = 'Fecha y hora';
$lang_picinfo['ISOSpeedRatings'] = 'ISO';
$lang_picinfo['MaxApertureValue'] = 'Maxima apertura';
$lang_picinfo['FocalLength'] = 'Focal length';
$lang_picinfo['Comment'] = 'Comentario';
$lang_picinfo['addFav'] = 'A�adir a favoritos';
$lang_picinfo['addFavPhrase'] = 'Favoritos';
$lang_picinfo['remFav'] = 'Quitar de favoritos';
$lang_picinfo['iptcTitle'] = 'T�tulo IPTC';
$lang_picinfo['iptcCopyright'] = 'Copyright IPTC';
$lang_picinfo['iptcKeywords'] = 'Palabras clave IPTC';
$lang_picinfo['iptcCategory'] = 'Categor�a IPTC';
$lang_picinfo['iptcSubCategories'] = 'Subcategor�as IPTC';
$lang_picinfo['ColorSpace'] = 'Espacio de color';
$lang_picinfo['ExposureProgram'] = 'Programa de exposici�n';
$lang_picinfo['Flash'] = 'Flash';
$lang_picinfo['MeteringMode'] = 'Modo de medici�n';
$lang_picinfo['ExposureTime'] = 'Tiempo de exposici�n';
$lang_picinfo['ExposureBiasValue'] = 'Compensaci�n de la exposici�n';
$lang_picinfo['ImageDescription'] = 'Descripci�n';
$lang_picinfo['Orientation'] = 'Orientaci�n';
$lang_picinfo['xResolution'] = 'Resoluci�n X';
$lang_picinfo['yResolution'] = 'Resoluci�n Y';
$lang_picinfo['ResolutionUnit'] = 'Unidades de resoluci�n';
$lang_picinfo['Software'] = 'Software';
//JLM: pendiente
$lang_picinfo['YCbCrPositioning'] = 'Posici�n YCbCr';
$lang_picinfo['ExifOffset'] = 'Offset EXIF';
$lang_picinfo['IFD1Offset'] = 'IFD1 Offset';
//JLM: pendiente
$lang_picinfo['FNumber'] = 'FNumber';
$lang_picinfo['ExifVersion'] = 'Versi�n EXIF';
$lang_picinfo['DateTimeOriginal'] = 'Fecha y hora originales';
$lang_picinfo['DateTimedigitized'] = 'Fecha y hora de modificaci�n';
//JLM : pendiente
$lang_picinfo['ComponentsConfiguration'] = 'Configuraci�n por componentes';
$lang_picinfo['CompressedBitsPerPixel'] = 'Bits Por Pixel (compresi�n)';
$lang_picinfo['LightSource'] = 'Fuente de luz';
$lang_picinfo['ISOSetting'] = 'Ajuste ISO';
$lang_picinfo['ColorMode'] = 'Modo de color';
$lang_picinfo['Quality'] = 'Calidad';
$lang_picinfo['ImageSharpening'] = 'Enfoque de la imagen (sharpening)';
$lang_picinfo['FocusMode'] = 'Modo de enfoque';
$lang_picinfo['FlashSetting'] = 'Ajustes de flash';
$lang_picinfo['ISOSelection'] = 'Selecci�n ISO';
$lang_picinfo['ImageAdjustment'] = 'Ajustes de imagen';
$lang_picinfo['Adapter'] = 'Adaptador';
$lang_picinfo['ManualFocusDistance'] = 'Distancia de enfoque manual';
$lang_picinfo['DigitalZoom'] = 'Zoom digital';
$lang_picinfo['AFFocusPosition'] = 'Posici�n de autofoco';
$lang_picinfo['Saturation'] = 'Saturaci�n';
$lang_picinfo['NoiseReduction'] = 'Reducci�n de ruido';
$lang_picinfo['FlashPixVersion'] = 'Versi�n de FlashPix';
$lang_picinfo['ExifimageWidth'] = 'Ancho de imagen EXIF';
$lang_picinfo['ExifimageHeight'] = 'Alto de imagen EXIF';
$lang_picinfo['ExifinteroperabilityOffset'] = 'EXIF Interoperability Offset';
$lang_picinfo['FileSource'] = 'Origen del fichero';
$lang_picinfo['SceneType'] = 'Tipo de escena';
$lang_picinfo['CustomerRender'] = 'Customer Render';
$lang_picinfo['ExposureMode'] = 'Modo de exposici�n';
$lang_picinfo['WhiteBalance'] = 'Balance de blancos';
$lang_picinfo['DigitalZoomRatio'] = 'Digital Zoom Ratio';
$lang_picinfo['SceneCaptureMode'] = 'Scene Capture Mode';
$lang_picinfo['GainControl'] = 'Gain Control';
$lang_picinfo['Contrast'] = 'Contrast';
$lang_picinfo['Sharpness'] = 'Nitidez';
$lang_picinfo['ManageExifDisplay'] = 'Manage EXIF Display';
$lang_picinfo['success'] = 'Informaci�n actualizada.';
$lang_picinfo['show_details'] = 'Mostrar detalles'; // cpg1.5
$lang_picinfo['hide_details'] = 'Ocultar detalles'; // cpg1.5
$lang_picinfo['download_URL'] = 'Enlace directo';
$lang_picinfo['movie_player'] = 'Reproducir el fichero en tu aplicaci�n est�ndar';
$lang_display_comments['comment_x_to_y_of_z'] = '%d a %d de %d'; // cpg1.5
$lang_display_comments['page'] = 'P�gina'; // cpg1.5
$lang_display_comments['edit_title'] = 'Editar este comentario';
$lang_display_comments['delete_title'] = 'Borrar este comentario'; // cpg1.5
$lang_display_comments['confirm_delete'] = '�Est�s seguro de querer borrar este comentario?'; // js-alert
$lang_display_comments['add_your_comment'] = 'A�ade tu comentario';
$lang_display_comments['name'] = 'Nombre';
$lang_display_comments['comment'] = 'Comentario';
$lang_display_comments['your_name'] = 'An�nimo';
$lang_display_comments['report_comment_title'] = 'Informar al administrador sobre este comentario';
$lang_display_comments['pending_approval'] = 'El comentario ser� visible tras la aprobaci�n del administrador'; // cpg1.5
$lang_display_comments['unapproved_comment'] = 'Comentario rechazado'; // cpg1.5
$lang_display_comments['pending_approval_message'] = 'Alguien ha escrito un comentario. Ser� visible tras la aprobaci�n del administrador.'; // cpg1.5
$lang_display_comments['approve'] = 'Aprobar comentario'; // cpg1.5
$lang_display_comments['disapprove'] = 'Marcar como rechazado'; // cpg1.5
$lang_display_comments['log_in_to_comment'] = 'No se permiten comentarios an�nimos. %sAccede%s para comentar'; // cpg1.5 // do not translate the %s placeholders - they will be used as wrappers for the link (<a>)
$lang_display_comments['default_username_message'] = 'Por favor, pon tu nombre para comentar'; // cpg1.5
$lang_display_comments['comment_rejected'] = 'Se ha rechazado tu comentario'; // cpg1.5
$lang_fullsize_popup['click_to_close'] = 'Pulsa en la imagen para cerrar la ventana';
$lang_fullsize_popup['close_window'] = 'Cerrar ventana'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File ecard.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP')) {
$lang_ecard_php['title'] = 'Enviar una postal';
$lang_ecard_php['invalid_email'] = 'Aviso: direcci�n de correo no v�lida:'; // cpg1.5
$lang_ecard_php['ecard_title'] = '%s te ha enviado una postal';
$lang_ecard_php['error_not_image'] = 'S�lo se pueden enviar im�genes en las postales.'; // cpg1.5
$lang_ecard_php['error_not_image_flash'] = 'S�lo se pueden enviar im�genes y archivos Flash en las postales.'; // cpg1.5
$lang_ecard_php['view_ecard'] = 'Si la imagen no se ve correctamente, pulsa en este enlace';
$lang_ecard_php['view_ecard_plaintext'] = 'Para ver la postal copia este enlace y p�galo en tu navegador:';
$lang_ecard_php['view_more_pics'] = 'Ver m�s im�genes!';
$lang_ecard_php['send_success'] = 'Postal enviada';
$lang_ecard_php['send_failed'] = 'Lo siento, pero el servidor no puede enviar tu postal...';
$lang_ecard_php['from'] = 'De';
$lang_ecard_php['your_name'] = 'Tu nombre';
$lang_ecard_php['your_email'] = 'Tu direcci�n de correo';
$lang_ecard_php['to'] = 'Para';
$lang_ecard_php['rcpt_name'] = 'Destinatario';
$lang_ecard_php['rcpt_email'] = 'Direcci�n de correo';
$lang_ecard_php['greetings'] = 'T�tulo';
$lang_ecard_php['message'] = 'Mensaje';
$lang_ecard_php['ecards_footer'] = 'Enviada por %s desde la IP %s a las %s (hora de la galer�a)';
$lang_ecard_php['preview'] = 'Vista previa de la postal';
$lang_ecard_php['preview_button'] = 'Vista previa';
$lang_ecard_php['submit_button'] = 'Enviar postal';
$lang_ecard_php['preview_view_ecard'] = 'Este ser� el enlace alternativo a la postal una vez que se genere. No funciona en la vista previa.';
}

// ------------------------------------------------------------------------- //
// File report_file.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('REPORT_FILE_PHP')) {
$lang_report_php['title'] = 'Informar al administrador';
$lang_report_php['invalid_email'] = '<strong>Aviso</strong>: �direcci�n de correo no v�lida!';
$lang_report_php['report_subject'] = 'Informe de %s sobre %s en una galer�a';
$lang_report_php['view_report'] = 'Si el informe no se ve correctamente pulsa en este enlace';
$lang_report_php['view_report_plaintext'] = 'Para ver el informe copia este enlace y p�galo en tu navegador:';
$lang_report_php['view_more_pics'] = 'Galer�a';
$lang_report_php['send_success'] = 'Se ha enviado tu informe';
$lang_report_php['send_failed'] = 'Lo siento, pero el servidor no puede enviar tu informe...';
$lang_report_php['from'] = 'De';
$lang_report_php['your_name'] = 'Tu nombre';
$lang_report_php['your_email'] = 'Tu direcci�n de correo';
$lang_report_php['to'] = 'Para';
$lang_report_php['administrator'] = 'Administrador/Moderador';
$lang_report_php['subject'] = 'Asunto';
$lang_report_php['comment_field_name'] = 'Informe de un comentario por "%s"';
$lang_report_php['reason'] = 'Motivo';
$lang_report_php['message'] = 'Mensaje';
$lang_report_php['report_footer'] = 'Enviado por %s desde la IP %s a las %s (hora de la galer�a)';
$lang_report_php['obscene'] = 'obsceno';
$lang_report_php['offensive'] = 'ofensivo';
$lang_report_php['misplaced'] = 'Fuera de lugar/t�pico';
$lang_report_php['missing'] = 'perdido';
$lang_report_php['issue'] = 'error/no se puede ver';
$lang_report_php['other'] = 'otro';
$lang_report_php['refers_to'] = 'El informe de fichero se refiere a';
$lang_report_php['reasons_list_heading'] = 'raz�n(es) para informar:';
$lang_report_php['no_reason_given'] = 'no se da raz�n alguna';
$lang_report_php['go_comment'] = 'Ir al comentario';
$lang_report_php['view_comment'] = 'Ver el informe completo con el comentario';
$lang_report_php['type_file'] = 'fichero';
$lang_report_php['type_comment'] = 'comentario';
$lang_report_php['invalid_data'] = 'Los datos del informe a los que intentas acceder se han corrompido por tu aplicaci�n de correo. Comprueba si el enlace est� correcto.';
}

// ------------------------------------------------------------------------- //
// File editpics.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) {
$lang_editpics_php['pic_info'] = 'Informaci�n de la imagen';
$lang_editpics_php['desc'] = 'Descripci�n';
$lang_editpics_php['approval'] = 'Aprobaci�n'; //cpg 1.5 //JLM: pendiente de comprobar
$lang_editpics_php['approved'] = 'Aprobada'; // cpg 1.5
$lang_editpics_php['unapproved'] = 'No aprobada'; // cpg 1.5
$lang_editpics_php['new_keyword'] = 'Nueva palabra clave';
$lang_editpics_php['new_keywords'] = 'No se han encontrado palabras clave';
$lang_editpics_php['existing_keyword'] = 'Palabra clave ya existente';
$lang_editpics_php['pic_info_str'] = '%s &veces; %s - %s KB - %s vistas - %s votos';
$lang_editpics_php['approve'] = 'Aprobar fichero';
$lang_editpics_php['postpone_app'] = 'Posponer aprobaci�n';
$lang_editpics_php['del_pic'] = 'Borrar fichero';
$lang_editpics_php['del_all'] = 'Borrar todos los ficheros';
$lang_editpics_php['read_exif'] = 'Releer datos EXIF';
$lang_editpics_php['reset_view_count'] = 'Poner a cero el contador de visitas';
$lang_editpics_php['reset_all_view_count'] = 'Poner a cero TODOS los contadores de visitas';
$lang_editpics_php['reset_votes'] = 'Poner a cero los votos';
$lang_editpics_php['reset_all_votes'] = 'Poner a cero TODOS los votos';
$lang_editpics_php['del_comm'] = 'Borrar comentarios';
$lang_editpics_php['del_all_comm'] = 'Borrar TODOS los comentarios';
$lang_editpics_php['upl_approval'] = 'Aprobaci�n de la subida';
$lang_editpics_php['edit_pics'] = 'Editar im�genes';
$lang_editpics_php['edit_pic'] = 'Editar imagen'; // cpg 1.5
$lang_editpics_php['see_next'] = 'Ver los ficheros siguientes';
$lang_editpics_php['see_prev'] = 'Ver los ficheros anteriores';
$lang_editpics_php['n_pic'] = '%s im�genes';
$lang_editpics_php['n_of_pic_to_disp'] = 'N�mero de im�genes que se mostrar�n';
$lang_editpics_php['crop_title'] = 'Coppermine Picture Editor';
$lang_editpics_php['preview'] = 'Vista previa';
$lang_editpics_php['save'] = 'Guardar imagen';
$lang_editpics_php['save_thumb'] = 'Guardar como miniatura';
$lang_editpics_php['gallery_icon'] = 'Poner esta imagen como mi icono';
$lang_editpics_php['sel_on_img'] = '�La selecci�n ha de estar completamente dentro de la imagen!'; // js-alert
$lang_editpics_php['album_properties'] = 'Propiedades del �lbum';
$lang_editpics_php['parent_category'] = 'Categor�a padre';
$lang_editpics_php['thumbnail_view'] = 'Vista de miniaturas';
$lang_editpics_php['select_unselect'] = 'Seleccionar/quitar selecci�n a todas';
$lang_editpics_php['file_exists'] = 'Ya existe el fichero destino \'%s\'.';
$lang_editpics_php['rename_failed'] = 'Error al renombrar \'%s\' a \'%s\'.';
$lang_editpics_php['src_file_missing'] = 'El fichero origen \'%s\' no existe.';
$lang_editpics_php['mime_conv'] = 'No se puede convertir \'%s\' a \'%s\'';
$lang_editpics_php['forb_ext'] = 'Extensi�n del fichero no permitida.';
$lang_editpics_php['error_editor_class'] = 'La clase para tu m�todo de reescalado no est� implementada'; // cpg 1.5 // Pendiente
$lang_editpics_php['error_document_size'] = 'El documento no tiene ancho o alto'; // cpg 1.5 // js-alert
$lang_editpics_php['success_picture'] = 'Imagen guardada - ahora puedes %scerrar%s esta ventana'; // cpg1.5 // do not translate "%s" here
$lang_editpics_php['success_thumb'] = 'Miniatura guardada - ahora puedes %scerrar%s esta ventana'; // cpg1.5 // do not translate "%s" here
$lang_editpics_php['rotate'] = 'Rotar'; // cpg 1.5
$lang_editpics_php['mirror'] = 'Voltear'; // cpg 1.5
$lang_editpics_php['scale'] = 'Expandir/contraer'; // cpg 1.5
$lang_editpics_php['new_width'] = 'Nuevo ancho'; // cpg 1.5
$lang_editpics_php['new_height'] = 'Nuevo alto'; // cpg 1.5
$lang_editpics_php['enable_clipping'] = 'Habilitar cortar, aplicar para recortar'; // cpg 1.5 //Pendiente
$lang_editpics_php['jpeg_quality'] = 'Calidad de salida JPEG'; // cpg 1.5
$lang_editpics_php['or'] = 'O'; // cpg 1.5
$lang_editpics_php['approve_pic'] = 'Aprobar fichero'; // cpg 1.5
$lang_editpics_php['approve_all'] = 'Aprobar TODOS los ficheros'; // cpg 1.5
$lang_editpics_php['error_empty'] = 'El �lbum est� vac�o'; // cpg1.5
$lang_editpics_php['error_approval_empty'] = 'No hay im�genes por aprobar'; // cpg1.5
$lang_editpics_php['error_linked_only'] = 'El �lbum s�lo tiene enlaces a ficheros, que no se pueden editar desde aqu�'; // cpg1.5
$lang_editpics_php['note_approve_public'] = 'Los ficheros que se han movido a un �lbum publico debes ser aprobados por un administrador.'; // cpg1.5
$lang_editpics_php['note_approve_private'] = 'Los ficheros que se han movido a un �lbum en una galer�a privada deben ser aprobados por un administrador.' ; // cpg1.5
$lang_editpics_php['note_edit_control'] = 'No se puede editar los ficheros que se han movido a un �lbum publico.'; // cpg1.5
$lang_editpics_php['confirm_move'] = '�Est�s seguro de querer mover este fichero?'; // cpg1.5 //js-alert
$lang_editpics_php['success_changes'] = 'Cambios guardados'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File forgot_passwd.php
// ------------------------------------------------------------------------- //
if (defined('FORGOT_PASSWD_PHP')) {
$lang_forgot_passwd_php['forgot_passwd'] = 'Password reminder';
$lang_forgot_passwd_php['err_already_logged_in'] = 'You are already logged in!';
$lang_forgot_passwd_php['enter_email'] = 'Enter your email address';
$lang_forgot_passwd_php['submit'] = 'go';
$lang_forgot_passwd_php['illegal_session'] = 'Forgot password session invalid or has expired.';
$lang_forgot_passwd_php['failed_sending_email'] = 'The password reminder email can\'t be sent!';
$lang_forgot_passwd_php['email_sent'] = 'An email with your username and new password was sent to %s';
$lang_forgot_passwd_php['verify_email_sent'] = 'An email has been sent to %s. Please check your email to complete the process.';
$lang_forgot_passwd_php['err_unk_user'] = 'Selected user does not exist!';
$lang_forgot_passwd_php['account_verify_subject'] = '%s - New password request';
$lang_forgot_passwd_php['passwd_reset_subject'] = '%s - Your new password';
$lang_forgot_passwd_php['account_verify_email'] = <<< EOT
You have requested a new password. If you would like to proceed with having a new password sent to you, click on the following link:

<a href="{VERIFY_LINK}">{VERIFY_LINK}</a>


Regards,

The management of {SITE_NAME}

EOT;

$lang_forgot_passwd_php['reset_email'] = <<< EOT
Here is the new password you requested:

Username: {USER_NAME}
Password: {PASSWORD}

Go to <a href="{SITE_LINK}">{SITE_LINK}</a> to log in.


Regards,

The management of {SITE_NAME}

EOT;
}

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) {
$lang_groupmgr_php['group_manager'] = 'Group manager'; // cpg1.5.x
$lang_groupmgr_php['group_name'] = 'Group';
$lang_groupmgr_php['permissions'] = 'Permissions';
$lang_groupmgr_php['public_albums'] = 'Public albums upload';
$lang_groupmgr_php['personal_gallery'] = 'Personal gallery';
$lang_groupmgr_php['disk_quota'] = 'Quota';
$lang_groupmgr_php['rating'] = 'Rating';
$lang_groupmgr_php['ecards'] = 'Ecards';
$lang_groupmgr_php['comments'] = 'Comments';
$lang_groupmgr_php['allowed'] = 'Allowed';
$lang_groupmgr_php['approval'] = 'Approval';
$lang_groupmgr_php['create_new_group'] = 'Create new group';
$lang_groupmgr_php['del_groups'] = 'Delete selected group(s)';
$lang_groupmgr_php['confirm_del'] = 'Warning, when you delete a group, users that belong to this group will be transferred to the \'Registered\' group!\n\nDo you want to proceed?'; // js-alert
$lang_groupmgr_php['title'] = 'Manage user groups';
$lang_groupmgr_php['reset_to_default'] = 'Reset to default name (%s) - recommended!';
$lang_groupmgr_php['error_group_empty'] = 'Group table was empty!<br />Default groups created, please reload this page';
$lang_groupmgr_php['explain_greyed_out_title'] = 'Why is this row grayed out?';
$lang_groupmgr_php['explain_guests_greyed_out_text'] = 'You cannot change the properties of this group because the access level of this group is NONE. All unlogged users (members of the group %s) can\'t do anything but login; therefore group settings don\'t apply for them. Change the access level here or on the Gallery Configuration page under "User Settings", "Allow unlogged users access".';
$lang_groupmgr_php['group_assigned_album'] = 'assigned album(s)';
$lang_groupmgr_php['access_level'] = 'Access level'; // cpg1.5
$lang_groupmgr_php['thumbnail_intermediate_full'] = 'thumbnail, intermediate, and full-size image'; // cpg1.5
$lang_groupmgr_php['thumbnail_intermediate'] = 'thumbnail and intermediate image'; // cpg1.5
$lang_groupmgr_php['thumbnail_only'] = 'thumbnail only'; // cpg1.5
$lang_groupmgr_php['none'] = 'none'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP'))
{
$lang_index_php['welcome'] = 'Welcome!';
$lang_album_admin_menu['confirm_delete'] = 'Are you sure you want to DELETE this album?\\nAll files and comments will also be deleted.'; // js-alert
$lang_album_admin_menu['delete'] = 'Delete';
$lang_album_admin_menu['modify'] = 'Properties';
$lang_album_admin_menu['edit_pics'] = 'Edit Files';
$lang_album_admin_menu['cat_locked'] = 'This album has been locked for editing'; // cpg1.5.x
$lang_list_categories['home'] = 'Home';
$lang_list_categories['stat1'] = '[pictures] files in [albums] albums and [cat] categories with [comments] comments viewed [views] times'; // do not translate the stuff in square brackets
$lang_list_categories['stat2'] = '[pictures] files in [albums] albums viewed [views] times'; // do not translate the stuff in square brackets
$lang_list_categories['xx_s_gallery'] = '%s\'s Gallery';
$lang_list_categories['stat3'] = '[pictures] files in [albums] albums with [comments] comments viewed [views] times'; // do not translate the stuff in square brackets
$lang_list_users['user_list'] = 'User list';
$lang_list_users['no_user_gal'] = 'There are no user galleries';
$lang_list_users['n_albums'] = '%s album(s)';
$lang_list_users['n_pics'] = '%s file(s)';
$lang_list_albums['n_pictures'] = '%s files';
$lang_list_albums['last_added'] = ', last one added on %s';
$lang_list_albums['n_link_pictures'] = '%s linked files';
$lang_list_albums['total_pictures'] = '%s files total';
$lang_list_albums['alb_hits'] = 'Album viewed %s times'; // cpg1.5
$lang_list_albums['from_category'] = ' - From Category: '; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File install.php
// ------------------------------------------------------------------------- //
if (defined('INSTALL_PHP')) {
$lang_install['already_succ'] = 'The installer has already been successfully run once and is now locked.';
$lang_install['already_succ_explain'] = 'If you want to run the installer again, you first need to delete the \'include/config.inc.php\' file that was created in the directory where you put Coppermine. You can do this with any FTP program';
$lang_install['cant_read_tmp_conf'] = 'The installer can\'t read the temporary config file %s.';
$lang_install['cant_write_tmp_conf'] = 'The installer can\'t write the temporary config file %s.';
$lang_install['review_permissions'] = 'Please review directory permissions.';
$lang_install['change_lang'] = 'Change language';
$lang_install['check_path'] = 'Check path';
$lang_install['continue'] = 'Next step';
$lang_install['conv_said'] = 'The convert program said:';
$lang_install['license_info'] = 'Coppermine is a picture/multimedia gallery package that is released under GNU GPL v3. By installing, you agree to be bound to Coppermine\'s license:';
$lang_install['cpg_info_frames'] = 'Your browser appears incapable of displaying inline frames. You can review the license within the docs folder that ships with your Coppermine package.';
$lang_install['license'] = 'Coppermine license agreement';
$lang_install['create_table'] = 'Creating table \'%s\'';
$lang_install['db_populating'] = 'Trying to insert data in the database.';
$lang_install['db_alr_populated'] = 'Already inserted required data in the database.';
$lang_install['dir_ok'] = 'Directory found';
$lang_install['directory'] = 'Directory';
$lang_install['email'] = 'Email address';
$lang_install['email_no_match'] = 'Email addresses do not match or are invalid.';
$lang_install['email_verif'] = 'Verify email';
$lang_install['err_cpgnuke'] = '<h1>ERROR</h1>You seem to be trying to install the standalone Coppermine into your Nuke portal.<br />This version can only be used as standalone!<br />Some server setups might display this warning even though you don\'t have a nuke portal installed - if this is the case for you, <a href="%s?continue_anyway=1">continue</a> with the install. If you are using a nuke portal, you might want to take a look into <a href=\"http://www.cpgnuke.com/\">CpgNuke</a> or use one of the (unsupported)<a href=\"http://sourceforge.net/project/showfiles.php?group_id=89658&amp;package_id=95984\">Coppermine ports</a> - do not continue!';
$lang_install['error'] = 'ERROR';
$lang_install['error_need_corr'] = 'The following errors were encountered and need to be corrected first:';
$lang_install['finish'] = 'Finish installation';
$lang_install['gd_note'] = '<strong>Important :</strong> older versions of the GD graphic library support only JPEG and PNG images. If this is the case for you, then the script will not be able to create thumbnails for GIF images.';
$lang_install['go_to_main'] = 'Go to the main page';
$lang_install['im_no_convert_ex'] = 'The installer found the ImageMagick \'convert\' program in \'%s\', however it can\'t be executed by the script.<br />You may consider using GD instead of ImageMagick.';
$lang_install['im_not_found'] = 'The installer tried to find ImageMagick, but could not determine its existence or there was an error. <br />Coppermine can use the <a href="http://www.imagemagick.org/">ImageMagick</a> \'convert\' program to create thumbnails. Quality of images produced by ImageMagick is superior to GD1 but equivalent to GD2.<br />If ImageMagick is installed on your system and you want to use it, <br />you need to input the full path to the \'convert\' program below. <br />On Windows the path should look something like \'c:/ImageMagick/\' and should not contain any space, on Unix is it something like \'/usr/bin/\'.<br />If you have no idea wether you have ImageMagick or not, leave this field empty - the installer will then try to use GD2 by default (which is what most users have). <br />You can change this later as well (in Coppermine\'s config screen), so don\'t be afraid if you\'re not sure what to enter here - leave it blank.';
$lang_install['im_packages'] = 'Your server supports the following image package(s)';
$lang_install['im_path'] = 'Path to ImageMagick:';
$lang_install['im_path_space'] = 'The path to ImageMagick (\'%s\') contains at least one space. This will cause problems in the script.<br />You must move ImageMagick to another directory.';
$lang_install['installation'] = 'installation';
$lang_install['installer_locked'] = 'The installer is locked';
$lang_install['installer_selected'] = 'The installer selected';
$lang_install['inv_im_path'] = 'The installer cannot find the \'%s\' directory you have specified for ImageMagick or it does not have permission to access it. Check that your typing is correct and that you have access to the specified directory.';
$lang_install['lets_go'] = 'Let\'s Go!';
$lang_install['mysql_create_btn'] = 'Create';
$lang_install['mysql_create_db'] = 'Create new MySQL database';
$lang_install['mysql_db_name'] = 'MySQL database name';
$lang_install['mysql_error'] = 'MySQL error: ';
$lang_install['mysql_host'] = 'MySQL host<br />(localhost is usually OK)';
$lang_install['mysql_username'] = 'MySQL username'; // cpg1.5
$lang_install['mysql_password'] = 'MySQL password'; // cpg1.5
$lang_install['mysql_no_create_db'] = 'Could not create MySQL database.';
$lang_install['mysql_no_sel_dbs'] = 'Could not retrieve available MySQL databases';
$lang_install['mysql_succ'] = 'Successful connection with database';
$lang_install['mysql_tbl_pref'] = 'MySQL table prefix';
$lang_install['mysql_test_connection'] = 'Test connection';
$lang_install['mysql_wrong_db'] = 'MySQL could not locate a database called \'%s\' please check the value entered for this';
$lang_install['n_a'] = 'N/A';
$lang_install['no_admin_email'] = 'You have to enter an admin email address';
$lang_install['no_admin_password'] = 'You have to enter an admin password';
$lang_install['no_admin_username'] = 'You have to enter an admin username';
$lang_install['no_dir'] = 'Directory not available';
$lang_install['no_gd'] = 'Your installation of PHP does not seem to include the \'GD\' graphic library extension and you have not indicated that you want to use ImageMagick. Coppermine has been configured to use GD2 because the automatic GD detection sometimes fails. If GD is installed on your system, the script should work else you will need to install ImageMagick.';
$lang_install['no_mysql_conn'] = 'Could not create a MySQL connection, please check the MySQL details entered';
$lang_install['no_mysql_support'] = 'PHP does not have MySQL support enabled.';
$lang_install['no_thumb_method'] = 'You have to choose an image manipulation application (GD/IM)';
$lang_install['nok'] = 'Not OK';
$lang_install['not_here_yet'] = 'Nothing here yet, please click %shere%s to go back.';
$lang_install['ok'] = 'OK';
$lang_install['on_q'] = 'on query';
$lang_install['or'] = 'or';
$lang_install['pass_err'] = 'Passwords don\'t match, you used illegal characters or didn\'t provide one.';
$lang_install['password'] = 'Password';
$lang_install['password_verif'] = 'Verify Password';
$lang_install['perm_error'] = 'The permissions of \'%s\' are set to %s, please set them to';
$lang_install['perm_ok'] = 'The permissions on certain directories have been checked, and seem to be ok. <br />Please proceed to the next step.';
$lang_install['perm_not_ok'] = 'The permissions on certain directories are not set correctly.<br />Please change the permissions of the directories below that are marked "Not OK".'; // cpg1.5
$lang_install['please_go_back'] = 'Please %sclick here%s to go back and fix this problem before proceeding.';
$lang_install['populate_db'] = 'Populate database';
$lang_install['ready_to_roll'] = '<a href="index.php">Coppermine</a> is now properly configured and ready to use.<br /><a href="login.php">Login</a> using the information you provided for your admin account.';
$lang_install['sect_create_adm'] = 'This section requires information to create your Coppermine administration account. Use only alphanumeric characters. Enter the data carefully!';
$lang_install['sect_mysql_info'] = 'This section requires information on how to access your MySQL database.<br />If you don\'t know how to fill them, check with your webhost support.';
$lang_install['sect_mysql_sel_db'] = 'Here you have to choose which database you want to use for Coppermine.<br />If your MySQL account has the needed privileges, you can create a new database from within the installer or you can use an existing database. If you don\'t like both options, you will have to create a database first outside the Coppermine installer, then return here then select the new database from the dropdown box below. You can also change the table prefix (don\'t use dots though), but keeping the default prefix is recommended.';
$lang_install['select_lang'] = 'Select default language: ';
$lang_install['sql_file_not_found'] = 'The file \'%s\' could not be found. Check that you have uploaded all Coppermine files to your server.';
$lang_install['status'] = 'Status';
$lang_install['subdir_called'] = 'A subdirectory called \'%s\' should normally exist in the directory where you uploaded Coppermine.<br />The installer can\'t find this directory. Check that you have uploaded all Coppermine files to your server.';
$lang_install['title_admin'] = 'Create Coppermine administrator';
$lang_install['title_dir_check'] = 'Checking directory permissions';
$lang_install['title_file_check'] = 'Checking installation files';
$lang_install['title_finished'] = 'Installation completed';
$lang_install['title_imp'] = 'Image package selection';
$lang_install['title_imp_test'] = 'Testing image library';
$lang_install['title_mysql_db_sel'] = 'MySQL database selection';
$lang_install['title_mysql_pop'] = 'Creating database structure';
$lang_install['title_mysql_user'] = 'MySQL user authentication';
$lang_install['title_welcome'] = 'Welcome to Coppermine installation';
$lang_install['tmp_conf_error'] = 'Unable to write the temporary config file - make sure the \'include\' folder is writable for the script.';
$lang_install['tmp_conf_ser_err'] = 'A serious error occurred in the installer, try reloading your page or start over by removing the \'include/config.tmp\' file.';
$lang_install['try_again'] = 'Try again!';
$lang_install['unable_write_config'] = 'Unable to write config file';
$lang_install['user_err'] = 'Admin username must contain only alphanumeric characters and can\'t be empty.';
$lang_install['username'] = 'Username';
$lang_install['your_admin_account'] = 'Your admin account';
$lang_install['no_cookie'] = 'Your browser did not accept our cookie. It is recommended to accept cookies.';
$lang_install['no_javascript'] = 'Your browser doesn\'t seem to have Javascript enabled - it is highly recommended to enable it.';
$lang_install['register_globals_detected'] = 'It seems your PHP configuration has \'register_globals\' enabled - you should disable this for security reasons.';
$lang_install['more'] = 'more';
$lang_install['version_undetected'] = 'The script could not determine the version of %s your server is using. Be sure it is at least version %s.';
$lang_install['version_incompatible'] = 'The script detected an incompatible version (%s) of %s on your server.<br />Make sure to use a compatible version (%s or better) before continuing!';
$lang_install['read_gif'] = 'Read/write .gif file';
$lang_install['read_png'] = 'Read/write .png file';
$lang_install['read_jpg'] = 'Read/write .jpg file';
$lang_install['write_error'] = 'Could not write generated image to disk.';
$lang_install['read_error'] = 'Could not read the source image.';
$lang_install['combine_error'] = 'Could not combine the source images';
$lang_install['text_error'] = 'Could not add text to the source image';
$lang_install['scale_error'] = 'Could not scale the source image';
$lang_install['pixels'] = 'pixels';
$lang_install['combine'] = 'Combine 2 images';
$lang_install['text'] = 'Write text on image';
$lang_install['scale'] = 'Scale an image';
$lang_install['generated_image'] = 'Generated image';
$lang_install['reference_image'] = 'Reference image';
$lang_install['imp_test_error'] = 'There was an error in one or more of the tests, please make sure you selected the appropriate Image Processing Package and it is configured correctly!';
$lang_install['writable'] = 'Writable';
$lang_install['not_writable'] = 'Not writable';
$lang_install['not_exist'] = 'Does not exist';
$lang_install['old_install'] = 'This is the new install wizard. Click %shere%s for the classic install screen.'; //cpg1.5
}

// ------------------------------------------------------------------------- //
// File keywordmgr.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('KEYWORDMGR_PHP')) {
$lang_keywordmgr_php['title'] = 'Gestionar palabras clave';
$lang_keywordmgr_php['search'] = 'Buscar';
$lang_keywordmgr_php['keyword_test_search'] = 'Buscar %s en una ventana nueva';
$lang_keywordmgr_php['keyword_del'] = 'Borrar la palabra clave %s';
$lang_keywordmgr_php['confirm_delete'] = 'Est�s seguro de querer borrar la palabra clave %s de TODA la galer�a?'; // js-alert
$lang_keywordmgr_php['change_keyword'] = 'Cambiar palabra clave';
}

// ------------------------------------------------------------------------- //
// File langmgr.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('LANGMGR_PHP')) {
$lang_langmgr_php['title'] = 'Gestor de idiomas';
$lang_langmgr_php['english_language_name'] = 'Ingl�s';
$lang_langmgr_php['native_language_name'] = 'Nativo';
$lang_langmgr_php['custom_language_name'] = 'Modificado';
$lang_langmgr_php['language_name'] = 'Nombre del idioma';
$lang_langmgr_php['language_file'] = 'Fichero del idioma';
$lang_langmgr_php['flag'] = 'Bandera';
$lang_langmgr_php['file_available'] = 'Disponible';
$lang_langmgr_php['enabled'] = 'Activo';
$lang_langmgr_php['complete'] = 'Completo';
$lang_langmgr_php['default'] = 'Por defecto';
$lang_langmgr_php['missing'] = 'no encontrado';
$lang_langmgr_php['broken'] = 'parece estar roto o inaccesible';
$lang_langmgr_php['exists_in_db_and_file'] = 'existe en la base de datos y en fichero';
$lang_langmgr_php['exists_as_file_only'] = 's�lo existe como fichero';
$lang_langmgr_php['pick_a_flag'] = 'Elige uno';
$lang_langmgr_php['replace_x_with_y'] = 'Reemplazar %s por %s';
$lang_langmgr_php['tanslator_information'] = 'Informaci�n del traductor';
$lang_langmgr_php['cpg_version'] = 'Versi�n Coppermine';
$lang_langmgr_php['hide_details'] = 'Ocultar detalles';
$lang_langmgr_php['show_details'] = 'Mostrar detalles';
$lang_langmgr_php['loading'] = 'Cargando';
$lang_langmgr_php['english_missing'] = 'El fichero de idioma ingl�s no est� accesible aunque no se debe borrar nunca. Es necesario reponerlo inmediatamente.';
$lang_langmgr_php['enable_at_least_one'] = 'Necesitas habilitar al menos un idioma para que funcione la galer�a';
$lang_langmgr_php['enable_default'] = 'Has elegido un idioma que no est� habilitado. �Elige otro idioma por defecto o habilita el idioma que has elegido por defecto!';
$lang_langmgr_php['available_default'] = 'Has elegido un idioma que ni siquiera est� disponible. �Elige otro idioma por defecto!';
$lang_langmgr_php['version_does_not_match'] = 'La versi�n de este fichero no corresponde con la de Coppermine. �salo con cuidado y pru�balo exhaustivamente!';
$lang_langmgr_php['no_version'] = 'No se pudo recuperar infomaci�n de versi�n. Es muy posible que este fichero de lenguaje no funcione o que no sea un fichero de lenguaje.';
$lang_langmgr_php['filesize'] = 'El tama�o del fichero (%s) es inveros�mil';
$lang_langmgr_php['content_missing'] = 'No parece que el fichero contenga la informaci�n necesaria, as� que probablemente no sea v�lido.';
$lang_langmgr_php['status'] = 'Estado';
$lang_langmgr_php['default_language'] = '%s elegido como idioma por defecto';
}

// ------------------------------------------------------------------------- //
// File login.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('LOGIN_PHP')) {
$lang_login_php['login'] = 'Acceder';
$lang_login_php['enter_login_pswd'] = 'Introduce tu usuario y contrase�a para acceder';
$lang_login_php['username'] = 'Usuario';
$lang_login_php['email'] = 'Correo'; // cpg1.5
$lang_login_php['both'] = 'Usuario / Correo'; // cpg1.5
$lang_login_php['password'] = 'Contrase�a';
$lang_login_php['remember_me'] = 'Recordarme';
$lang_login_php['welcome'] = 'Bienvenido %s ...';
$lang_login_php['err_login'] = 'Acceso fallido. Int�ntalo de nuevo.';
$lang_login_php['err_already_logged_in'] = '�Ya estaba validado en el sistema!';
$lang_login_php['forgot_password_link'] = 'Olvid� mi contrase�a';
$lang_login_php['cookie_warning'] = 'Aviso: tu navegador no acepta las cookies';
$lang_login_php['send_activation_link'] = '�Perdiste el enlace de la activaci�n?';
$lang_login_php['force_login'] = 'Debes acceder para ver esta p�gina'; // cpg1.5
$lang_login_php['force_login_title'] = 'Accede para continuar'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File logout.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('LOGOUT_PHP')) {
$lang_logout_php['logout'] = 'Salir';
$lang_logout_php['bye'] = 'Hasta luego, %s ...';
$lang_logout_php['err_not_logged_in'] = '�No est� validado en el sistema!'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File minibrowser.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('MINIBROWSER_PHP')) {
$lang_minibrowser_php['up'] = 'Arriba un nivel';
$lang_minibrowser_php['current_path'] = 'ruta actual';
$lang_minibrowser_php['select_directory'] = 'Elige un directorio, por favor';
$lang_minibrowser_php['click_to_close'] = 'Pulsa en una imagen para cerrar esta ventana';
$lang_minibrowser_php['folder'] = 'Carpeta'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File mode.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('MODE_PHP')) {
$lang_mode_php[0] = 'Ocultando los controles de administraci�n...'; // cpg1.5
$lang_mode_php[1] = 'Mostrando los controles de administraci�n...'; // cpg1.5
$lang_mode_php['news_hide'] = 'Ocultando novedades...'; // cpg1.5
$lang_mode_php['news_show'] = 'Mostrando novedades...'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //
if (defined('MODIFYALB_PHP')) {
$lang_modifyalb_php['upd_alb_n'] = 'Update album %s';
$lang_modifyalb_php['related_tasks'] = 'Related tasks'; // cpg1.5
$lang_modifyalb_php['choose_album'] = 'Choose album'; // cpg1.5
$lang_modifyalb_php['general_settings'] = 'General settings';
$lang_modifyalb_php['alb_title'] = 'Album title';
$lang_modifyalb_php['alb_cat'] = 'Album category';
$lang_modifyalb_php['alb_desc'] = 'Album description';
$lang_modifyalb_php['alb_keyword'] = 'Album keyword';
$lang_modifyalb_php['alb_thumb'] = 'Album thumbnail';
$lang_modifyalb_php['alb_perm'] = 'Permissions for this album';
$lang_modifyalb_php['can_view'] = 'Album can be viewed by';
$lang_modifyalb_php['can_upload'] = 'Visitors can upload files';
$lang_modifyalb_php['can_post_comments'] = 'Visitors can post comments';
$lang_modifyalb_php['can_rate'] = 'Visitors can rate files';
$lang_modifyalb_php['user_gal'] = 'User Gallery';
$lang_modifyalb_php['my_gal'] = '* My Gallery *'; // cpg 1.5
$lang_modifyalb_php['no_cat'] = '* No category *';
$lang_modifyalb_php['alb_empty'] = 'Album is empty';
$lang_modifyalb_php['last_uploaded'] = 'Last uploaded';
$lang_modifyalb_php['public_alb'] = 'Everybody (public album)';
$lang_modifyalb_php['me_only'] = 'Me only';
$lang_modifyalb_php['owner_only'] = 'Album owner (%s) only';
$lang_modifyalb_php['group_only'] = 'Members of the \'%s\' group';
$lang_modifyalb_php['err_no_alb_to_modify'] = 'No album you can modify in the database.';
$lang_modifyalb_php['update'] = 'Update album';
$lang_modifyalb_php['reset_album'] = 'Reset album';
$lang_modifyalb_php['reset_views'] = 'Reset views counter to &quot;0&quot; in %s';
$lang_modifyalb_php['reset_rating'] = 'Reset ratings on all files in %s';
$lang_modifyalb_php['delete_comments'] = 'Delete all comments made in %s';
$lang_modifyalb_php['delete_files'] = '%sIrreversibly%s delete all files in %s';
$lang_modifyalb_php['views'] = 'views';
$lang_modifyalb_php['votes'] = 'votes';
$lang_modifyalb_php['comments'] = 'comments';
$lang_modifyalb_php['files'] = 'files';
$lang_modifyalb_php['submit_reset'] = 'submit changes';
$lang_modifyalb_php['reset_views_confirm'] = 'I\'m sure';
$lang_modifyalb_php['notice1'] = '(*) depending on %sgroups%s settings'; //(do not translate %s!)
$lang_modifyalb_php['can_moderate'] = 'Album can be moderated by'; // cpg 1.5
$lang_modifyalb_php['admins_only'] = 'Admins only'; // cpg 1.5
$lang_modifyalb_php['alb_password'] = 'Album password (New password)';
$lang_modifyalb_php['alb_password_hint'] = 'Album password hint';
$lang_modifyalb_php['edit_files'] = 'Edit files';
$lang_modifyalb_php['parent_category'] = 'Parent category';
$lang_modifyalb_php['thumbnail_view'] = 'Thumbnail view';
$lang_modifyalb_php['random_image'] = 'Random Image'; // cpg 1.5
$lang_modifyalb_php['password_protect'] = 'Password protect this album (Tick for yes)'; //cpg1.5
}

// ------------------------------------------------------------------------- //
// File phpinfo.php
// ------------------------------------------------------------------------- //
if (defined('PHPINFO_PHP')) {
$lang_phpinfo_php['php_info'] = 'PHP info';
$lang_phpinfo_php['explanation'] = 'This is the output generated by the PHP function <a href="http://www.php.net/phpinfo">phpinfo()</a>, displayed within Coppermine.';
$lang_phpinfo_php['no_link'] = 'Having others see your phpinfo can be a security risk, that\'s why this page is only visible when you\'re logged in as admin. You cannot post a link to this page for others, they will be denied access.';
}

// ------------------------------------------------------------------------- //
// File picmgr.php
// ------------------------------------------------------------------------- //
if (defined('PICMGR_PHP')) {
$lang_picmgr_php['pic_mgr'] = 'Picture Manager';
$lang_picmgr_php['confirm_modifs'] = 'Really perform the modifications?'; // cpg1.5 // js-alert
$lang_picmgr_php['no_change'] = 'You did not make any change!';
$lang_picmgr_php['no_album'] = '* No album *';
$lang_picmgr_php['explanation_header'] = 'The custom sort order you can specify on this page will only be taken into account if';
$lang_picmgr_php['explanation1'] = 'the admin has set the "Default sort order for files" in the config to "Position descending" or "Position ascending" (global setting for all users who haven\'t chosen another sort option individually)';
$lang_picmgr_php['explanation2'] = 'the user has chosen "Position descending" or "Position ascending" on the thumbnail page (per user setting)';
$lang_picmgr_php['change_album'] = 'If you change the album, your changes will be lost!'; // cpg1.5 // js-alert
$lang_picmgr_php['submit_reminder'] = 'Sorting changes are not saved until you click &quot;Apply changes&quot;.'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File pluginmgr.php
// ------------------------------------------------------------------------- //
if (defined('PLUGINMGR_PHP'))
{
$lang_pluginmgr_php['confirm_uninstall'] = 'Are you sure you want to UNINSTALL this plugin?';
$lang_pluginmgr_php['confirm_remove'] = 'NOTE: Plugin API is disabled. Do you want to MANUALLY REMOVE this plugin, ignoring any cleanup actions?'; // cpg1.5
$lang_pluginmgr_php['confirm_delete'] = 'Are you sure you want to DELETE this plugin?';
$lang_pluginmgr_php['pmgr'] = 'Plugin Manager';
$lang_pluginmgr_php['explanation'] = 'Install / uninstall / manage plugins using this page.'; // cpg1.5
$lang_pluginmgr_php['plugin_enabled'] = 'Plugin API enabled'; // cpg1.5
$lang_pluginmgr_php['name'] = 'Name';
$lang_pluginmgr_php['author'] = 'Author';
$lang_pluginmgr_php['desc'] = 'Description';
$lang_pluginmgr_php['vers'] = 'v';
$lang_pluginmgr_php['i_plugins'] = 'Installed Plugins';
$lang_pluginmgr_php['n_plugins'] = 'Plugins Not installed';
$lang_pluginmgr_php['none_installed'] = 'None Installed';
$lang_pluginmgr_php['operation'] = 'Operation';
$lang_pluginmgr_php['not_plugin_package'] = 'The file uploaded is not a plugin package.';
$lang_pluginmgr_php['copy_error'] = 'There was an error copying the package to the plugins folder.';
$lang_pluginmgr_php['upload'] = 'Upload';
$lang_pluginmgr_php['configure_plugin'] = 'Configure plugin';
$lang_pluginmgr_php['cleanup_plugin'] = 'Cleanup plugin';
$lang_pluginmgr_php['extra'] = 'Extra'; // cpg1.5
$lang_pluginmgr_php['install_info'] = 'Install information'; // cpg1.5
$lang_pluginmgr_php['plugin_disabled_note'] = 'Plugin API is disabled, so that operation is not allowed.'; // cpg1.5
$lang_pluginmgr_php['install'] = 'install'; // cpg1.5
$lang_pluginmgr_php['uninstall'] = 'uninstall'; // cpg1.5
$lang_pluginmgr_php['minimum_requirements_not_met'] = 'Minimum requirements not met'; // cpg1.5
$lang_pluginmgr_php['confirm_version'] = 'Could not determine the version requirements for this plugin. This is usually an indicator that the plugin was not designed for your version of Coppermine and might therefore crash your gallery. Continue anyway (not recommended)?'; // cpg1.5 // js-alert
}

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) {
$lang_rate_pic_php['already_rated'] = 'Sorry but you have already rated this file';
$lang_rate_pic_php['rate_ok'] = 'Your vote was accepted';
$lang_rate_pic_php['forbidden'] = 'You cannot rate your own files.';
}

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
$lang_register_php['disclamer'] = <<< EOT
While the administrators of {SITE_NAME} will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every post. Therefore you acknowledge that all posts made to this site express the views and opinions of the author and not the administrators or webmaster (except for posts by these people) and hence will not be held liable.<br />
<br />
You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-oriented or any other material that may violate any applicable laws. You agree that the webmaster, administrator and moderators of {SITE_NAME} have the right to remove or edit any content at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent the webmaster and administrator cannot be held responsible for any hacking attempt that may lead to the data being compromised.<br />
<br />
This site uses cookies to store information on your local computer. These cookies serve only to improve your viewing pleasure. The email address is used only for confirming your registration details and password.<br />
<br />
By clicking 'I agree' below you agree to be bound by these conditions.
EOT;
$lang_register_php['page_title'] = 'User registration';
$lang_register_php['term_cond'] = 'Terms and conditions';
$lang_register_php['i_agree'] = 'I agree';
$lang_register_php['submit'] = 'Submit registration';
$lang_register_php['err_user_exists'] = 'The username you have entered already exists, please choose a different one';
$lang_register_php['err_global_pw'] = 'Invalid global registration password'; // cpg1.5
$lang_register_php['err_global_pass_same'] = 'Your password should be different from the global password'; // cpg1.5
$lang_register_php['err_duplicate_email'] = 'Another user has already registered with the email address you entered';
$lang_register_php['err_disclaimer'] = 'You need to agree to the disclaimer'; // cpg1.5
$lang_register_php['enter_info'] = 'Input registration information';
$lang_register_php['required_info'] = 'Required information';
$lang_register_php['optional_info'] = 'Optional information';
$lang_register_php['username'] = 'Username';
$lang_register_php['password'] = 'Password';
$lang_register_php['password_again'] = 'Re-enter password';
$lang_register_php['global_registration_pw'] = 'Global registration password'; // cpg1.5
$lang_register_php['email'] = 'Email';
$lang_register_php['location'] = 'Location';
$lang_register_php['interests'] = 'Interests';
$lang_register_php['website'] = 'Home page';
$lang_register_php['occupation'] = 'Occupation';
$lang_register_php['error'] = 'ERROR';
$lang_register_php['confirm_email_subject'] = '%s - Registration confirmation';
$lang_register_php['information'] = 'Information';
$lang_register_php['failed_sending_email'] = 'The registration confirmation email can\'t be send!';
$lang_register_php['thank_you'] = 'Thank you for registering.<br />An email with information on how to activate your account was sent to the email address you provided.';
$lang_register_php['acct_created'] = 'Your account has been created and you can now login with your username and password';
$lang_register_php['acct_active'] = 'Your account is now active and you can login with your username and password';
$lang_register_php['acct_already_act'] = 'Account is already active!';
$lang_register_php['acct_act_failed'] = 'This account can\'t be activated!';
$lang_register_php['err_unk_user'] = 'Selected user does not exist!';
$lang_register_php['x_s_profile'] = '%s\'s profile';
$lang_register_php['group'] = 'Group';
$lang_register_php['reg_date'] = 'Joined';
$lang_register_php['disk_usage'] = 'Disk usage';
$lang_register_php['change_pass'] = 'Change password';
$lang_register_php['current_pass'] = 'Current password';
$lang_register_php['new_pass'] = 'New password';
$lang_register_php['new_pass_again'] = 'New password again';
$lang_register_php['err_curr_pass'] = 'Current password is incorrect';
$lang_register_php['change_pass'] = 'Change my password';
$lang_register_php['update_success'] = 'Your profile was updated';
$lang_register_php['pass_chg_success'] = 'Your password was changed';
$lang_register_php['pass_chg_error'] = 'Your password was not changed';
$lang_register_php['notify_admin_email_subject'] = '%s - Registration notification';
$lang_register_php['last_uploads'] = 'Last uploaded file'; // cpg1.5
$lang_register_php['last_uploads_detail'] = 'Click to see all uploads by %s'; // cpg1.5
$lang_register_php['last_comments'] = 'Last comment'; // cpg1.5
$lang_register_php['you'] = 'you'; // cpg1.5
$lang_register_php['last_comments_detail'] = 'Click to see all comments made by %s'; // cpg1.5
$lang_register_php['notify_admin_email_body'] = 'A new user with the username "%s" has registered in your gallery';
$lang_register_php['pic_count'] = 'files uploaded';
$lang_register_php['notify_admin_request_email_subject'] = '%s - Registration request';
$lang_register_php['thank_you_admin_activation'] = 'Thank you.<br />Your request for account activation was sent to the admin. You will receive an email if approved.';
$lang_register_php['acct_active_admin_activation'] = 'The account is now active and an email has been sent to the user.';
$lang_register_php['notify_user_email_subject'] = '%s - Activation notification';
$lang_register_php['delete_my_account'] = 'Delete my user account'; // cpg1.5
$lang_register_php['warning_delete'] = 'Warning: deleting your account cannot be undone. The %sfiles you uploaded%s into public albums and %syour comments%s do not get deleted when deleting your user account! However, the files you uploaded into your personal gallery will be deleted.'; // cpg1.5 // The %s-placeholders mustn't be removed, they will later be replaced by the wrappers for the links
$lang_register_php['i_am_sure'] = 'I\'m sure that I want to delete my user account'; // cpg1.5
$lang_register_php['really_delete'] = 'Do you really want to delete your user account?'; // cpg1.5 // js-alert
$lang_register_php['edit_xs_profile'] = 'Edit the profile of %s'; // cpg1.5
$lang_register_php['edit_my_profile'] = 'Edit my profile'; // cpg1.5
$lang_register_php['none'] = 'none'; // cpg1.5
$lang_register_php['user_name_banned'] = 'The username you have chosen is not allowed/banned. Choose another user name'; // cpg1.5
$lang_register_php['email_address_banned'] = 'You are banned from this gallery. You are not allowed to re-register. Go away!'; // cpg1.5
$lang_register_php['email_warning1'] = 'The email address field mustn\'t be empty!'; // cpg1.5
$lang_register_php['email_warning2'] = 'The email address you entered is not valid. Review!'; // cpg1.5
$lang_register_php['username_warning1'] = 'The username field mustn\'t be empty!'; // cpg1.5
$lang_register_php['username_warning2'] = 'Username must be at least two characters long!'; // cpg1.5
$lang_register_php['password_warning1'] = 'The password must be at least two characters long!'; // cpg1.5
$lang_register_php['password_warning2'] = 'Username and password must be different!'; // cpg1.5
$lang_register_php['password_verification_warning1'] = 'The two passwords do not match, please enter them again!'; // cpg1.5
$lang_register_php['form_not_submit'] = 'The form hasn\'t been submit - there are errors that you need to correct first!'; // cpg1.5
$lang_register_php['banned'] = 'Banned!'; // cpg1.5


$lang_register_php['confirm_email'] = <<< EOT
Thank you for registering at {SITE_NAME}

In order to activate your account with username "{USER_NAME}", you need to click on the link below or copy and paste it in your web browser.
<a href="{ACT_LINK}">{ACT_LINK}</a>

Regards,

The management of {SITE_NAME}

EOT;

$lang_register_approve_email = <<< EOT
A new user with the username "{USER_NAME}" has registered in your gallery.
In order to activate the account, you need to click on the link below or copy and paste it in your web browser.

<a href="{ACT_LINK}">{ACT_LINK}</a>

EOT;

$lang_register_php['activated_email'] = <<< EOT
Your account has been approved and activated.

You can now log in at <a href="{SITE_LINK}">{SITE_LINK}</a> using the username "{USER_NAME}"


Regards,

The management of {SITE_NAME}

EOT;
}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) {
$lang_reviewcom_php['title'] = 'Review comments';
$lang_reviewcom_php['no_comment'] = 'There are no comments to review';
$lang_reviewcom_php['n_comm_del'] = '%s comment(s) deleted';
$lang_reviewcom_php['n_comm_disp'] = 'Number of comments to display';
$lang_reviewcom_php['see_prev'] = 'See previous';
$lang_reviewcom_php['see_next'] = 'See next';
$lang_reviewcom_php['del_comm'] = 'Delete selected comments';
$lang_reviewcom_php['user_name'] = 'Name';
$lang_reviewcom_php['date'] = 'Date';
$lang_reviewcom_php['comment'] = 'Comment';
$lang_reviewcom_php['file'] = 'File';
$lang_reviewcom_php['name_a'] = 'User name ascending';
$lang_reviewcom_php['name_d'] = 'User name descending';
$lang_reviewcom_php['date_a'] = 'Date ascending';
$lang_reviewcom_php['date_d'] = 'Date descending';
$lang_reviewcom_php['comment_a'] = 'Comment message ascending';
$lang_reviewcom_php['comment_d'] = 'Comment message descending';
$lang_reviewcom_php['file_a'] = 'File ascending';
$lang_reviewcom_php['file_d'] = 'File descending';
$lang_reviewcom_php['approval_a'] = 'Approval ascending'; // cpg1.5
$lang_reviewcom_php['approval_d'] = 'Approval descending'; // cpg1.5
$lang_reviewcom_php['ip_a'] = 'IP address ascending'; // cpg1.5
$lang_reviewcom_php['ip_d'] = 'IP address descending'; // cpg1.5
$lang_reviewcom_php['akismet_a'] = 'Akismet rating (valid comments at the bottom)'; // cpg1.5
$lang_reviewcom_php['akismet_d'] = 'Akismet rating (valid comments at the top)'; // cpg1.5
$lang_reviewcom_php['n_comm_appr'] = '%s approved comment(s)'; // cpg1.5
$lang_reviewcom_php['n_comm_unappr'] = '%s unapproved comment(s)'; // cpg1.5
$lang_reviewcom_php['configuration_changed'] = 'Approval config changed'; // cpg1.5
$lang_reviewcom_php['only_approval'] = 'only display comments needing approval'; // cpg1.5
$lang_reviewcom_php['approval'] = 'Approved'; // cpg1.5
$lang_reviewcom_php['save_changes'] = 'Save changes'; // cpg1.5
$lang_reviewcom_php['n_confirm_delete'] = 'Do you really want to delete the selected comment(s)?'; // cpg1.5
$lang_reviewcom_php['with_selected'] = 'With selected'; // cpg1.5
$lang_reviewcom_php['delete'] = 'delete'; // cpg1.5
$lang_reviewcom_php['approve'] = 'approve'; // cpg1.5
$lang_reviewcom_php['disapprove'] = 'mark unapproved'; // cpg1.5
$lang_reviewcom_php['do_nothing'] = 'do nothing'; // cpg1.5
$lang_reviewcom_php['comment_approved'] = 'Comment approved'; // cpg1.5
$lang_reviewcom_php['comment_unapproved'] = 'Comment marked unapproved'; // cpg1.5
$lang_reviewcom_php['ban_and_delete'] = 'Ban user and delete comment(s)'; // cpg1.5
$lang_reviewcom_php['akismet_status'] = 'Akismet said'; // cpg1.5
$lang_reviewcom_php['is_spam'] = 'is spam'; // cpg1.5
$lang_reviewcom_php['is_not_spam'] = 'is not spam'; // cpg1.5
$lang_reviewcom_php['akismet'] = 'Akismet'; // cpg1.5
$lang_reviewcom_php['akismet_count'] = 'Akismet has found %s spam messages for you until now'; // cpg1.5
$lang_reviewcom_php['akismet_test_result'] = 'Test result for your Akismet API key %s'; // cpg1.5
$lang_reviewcom_php['invalid'] = 'invalid'; // cpg1.5
$lang_reviewcom_php['missing_gallery_url'] = 'You need to specify a gallery URL in Coppermine\'s config'; // cpg1.5
$lang_reviewcom_php['unable_to_connect'] = 'Unable to connect to akismet.com'; // cpg1.5
$lang_reviewcom_php['not_found'] = 'The target URL was not found. Maybe the site structure of akismet.com has changed.'; // cpg1.5
$lang_reviewcom_php['unknown_error'] = 'Unknown error'; // cpg1.5
$lang_reviewcom_php['error_message'] = 'The error message returned was'; // cpg1.5
$lang_reviewcom_php['ip_address'] = 'IP address'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File sidebar.php
// ------------------------------------------------------------------------- //
if (defined('SIDEBAR_PHP')) {
$lang_sidebar_php['sidebar'] = 'Side Bar'; // cpg1.5
$lang_sidebar_php['install'] = 'install'; // cpg1.5
$lang_sidebar_php['install_explain'] = 'Among the many smart access methods to get to information quickly on the site, we provide sidebars for the most popular browsers used on different operating systems to access pages easily. Here you can find setup and uninstall information for the browsers supported.'; // cpg1.5
$lang_sidebar_php['os_browser_detect'] = 'Detecting your OS and browser'; // cpg1.5
$lang_sidebar_php['os_browser_detect_explain'] = 'The script is trying to detect your operating system and browser version - please wait a second. If auto-detection fails, you might want to %sunhide%s all possible sidebar install options manually.'; // cpg1.5
$lang_sidebar_php['mozilla'] = 'Mozilla, Firefox, Netscape 6+, Konqueror 3.2+'; // cpg1.5
$lang_sidebar_php['mozilla_explain'] = 'If you use Mozilla 0.9.4 or later, you can %sadd our sidebar to your set%s. You can uninstall this sidebar using the "Customize Sidebar" dialog in Mozilla.'; // cpg1.5
$lang_sidebar_php['ie_mac'] = 'Internet Explorer 5 and above on Mac OS'; // cpg1.5
$lang_sidebar_php['ie_mac_explain'] = 'If you use Internet Explorer 5 or above on MacOS, %sopen our sidebar page%s in a separate window. In that window, open the "Page Holder" tab on the left side of the window. Click "Add". If you want to keep it for future use, click on "Favorites" and select "Add to Page Holder Favorites".'; // cpg1.5
$lang_sidebar_php['ie_win'] = 'Internet Explorer 5 and above on Windows'; // cpg1.5
$lang_sidebar_php['ie_win_explain'] = 'If you use Internet Explorer 5 or above on Windows, you can add the Side Bar to your Links toolbar or you can add it to your favorites and clicking on it you can see our bar displayed in place of your usual search bar by right-clicking %shere%s and selecting "Add to favorites" from the context menu. This link does not install our bar as your default search bar, so no modification is made to your system.'; // cpg1.5
$lang_sidebar_php['ie7_win'] = 'Internet Explorer 7 on Windows XP/Vista'; // cpg1.5
$lang_sidebar_php['ie7_win_explain'] = 'If you use Internet Explorer 7 on Windows, you can add a navigation pop-up to your Links toolbar or you can add it to your favorites and clicking on it you can see our bar displayed as a pop-up window by right-clicking %shere%s and selecting "Add to favorites" from the context menu. In previous versions of IE, it was possible to add an actual side bar, but in IE7 you cannot accomplish this without applying complicated registry hacks. It is recommended to use another browser if you want to use an actual sidebar.'; // cpg1.5
$lang_sidebar_php['opera'] = 'Opera 6 and above'; // cpg1.5
$lang_sidebar_php['opera_explain'] = 'If you are using Opera, you can %sclick on this link to add our sidebar to your set%s. Tick "Show in panel" then. You can uninstall the sidebar by right clicking on it\'s tab and choosing "Delete" from the context menu.'; // cpg1.5
$lang_sidebar_php['additional_options'] = 'Additional options'; // cpg1.5
$lang_sidebar_php['additional_options_explain'] = 'If you have another browser than the one mentioned above, then click %shere%s to display all possible sidebar options.'; // cpg1.5
$lang_sidebar_php['cannot_add_sidebar'] = 'Sidebar cannot be added! Your browser does not support this method!'; // cpg1.5 // js-alert
$lang_sidebar_php['search'] = 'Search'; // cpg1.5
$lang_sidebar_php['reload'] = 'Reload'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File search.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('SEARCH_PHP'))
{
$lang_search_php['title'] = 'Buscar';
$lang_search_php['submit_search'] = 'buscar';
$lang_search_php['keyword_list_title'] = 'Lista de palabras clave';
$lang_search_php['keyword_msg'] = 'La lista previa puede no estar completa. No incluye las palabras de los t�tulos o descripciones. Prueba la b�squeda completa.';
$lang_search_php['edit_keywords'] = 'Editar palabras clave';
$lang_search_php['search in'] = 'Buscar en:';
$lang_search_php['ip_address'] = 'Direcciones IP';
$lang_search_php['imgfields'] = 'Buscar en ficheros';
$lang_search_php['albcatfields'] = 'Buscar en �lbumes y categor�as';
$lang_search_php['age'] = 'Per�odo';
$lang_search_php['newer_than'] = 'Menos de ';
$lang_search_php['older_than'] = 'M�s de';
$lang_search_php['days'] = 'd�as';
$lang_search_php['all_words'] = 'Encontrar todas las palabras (AND)';
$lang_search_php['any_words'] = 'Encontrar cualquier palabra (OR)';
$lang_search_php['regex'] = 'Expresiones regulares';
$lang_search_php['album_title'] = 'T�tulos de �lbumes';
$lang_search_php['category_title'] = 'T�tulos de categor�as';
}

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) {
$lang_search_new_php['page_title'] = 'Search new files';
$lang_search_new_php['select_dir'] = 'Select directory';
$lang_search_new_php['select_dir_msg'] = 'This function allows you to add a batch of files that you have uploaded to your server by FTP.<br />Select the directory where you have uploaded your files.';
$lang_search_new_php['no_pic_to_add'] = 'There is no file to add';
$lang_search_new_php['need_one_album'] = 'You need at least one album to use this function';
$lang_search_new_php['warning'] = 'Warning';
$lang_search_new_php['change_perm'] = 'the script can\'t write in this directory, you need to change its mode to 755 or 777 before trying to add the files!';
$lang_search_new_php['target_album'] = '<strong>Put files of &quot;</strong>%s<strong>&quot; into </strong>%s';
$lang_search_new_php['folder'] = 'Folder';
$lang_search_new_php['image'] = 'file';
$lang_search_new_php['result'] = 'Result';
$lang_search_new_php['dir_ro'] = 'Not writable. ';
$lang_search_new_php['dir_cant_read'] = 'Not readable. ';
$lang_search_new_php['insert'] = 'Adding new files to the gallery';
$lang_search_new_php['list_new_pic'] = 'List of new files';
$lang_search_new_php['insert_selected'] = 'Insert selected files';
$lang_search_new_php['no_pic_found'] = 'No new file was found';
$lang_search_new_php['be_patient'] = 'Please be patient, the script needs time to add the files';
$lang_search_new_php['no_album'] = 'no album selected';
$lang_search_new_php['result_icon'] = 'click for details or to reload';
$lang_search_new_php['notes'] = <<< EOT
    <ul>
        <li>%s: the file was successfully added</li>
        <li>%s: the file is a duplicate and is already in the database</li>
        <li>%s: the file could not be added, check your configuration and the permission of directories where the files are located</li>
        <li>%s: you need to select an album first</li>
        <li>%s: the file is broken or inacessible</li>
        <li>%s: unknown file type</li>
        <li>%s: the file is actually a GIF image</li>
        <li>If the icons do not appear click on the broken file to see any error message produced by PHP</li>
        <li>If your browser timeouts, hit the reload button</li>
    </ul>
EOT;
// Translator note: Do not translate the %s placeholders - they are being replaced with icons
$lang_search_new_php['check_all'] = 'Check All';
$lang_search_new_php['uncheck_all'] = 'Uncheck All';
$lang_search_new_php['no_folders'] = 'There are no folders inside the "albums" folder yet. Make sure to create at least one custom folder within "albums" folder and ftp-upload your files there. You mustn\'t upload to the "userpics" nor "edit" folders, they are reserved for http uploads and internal purposes.';
$lang_search_new_php['browse_batch_add'] = 'Browsable interface'; // cpg1.5
$lang_search_new_php['display_thumbs_batch_add'] = 'Display preview thumbnails'; // cpg1.5
$lang_search_new_php['edit_pics'] = 'Edit files';
$lang_search_new_php['edit_properties'] = 'Album properties';
$lang_search_new_php['view_thumbs'] = 'Thumbnail view';
$lang_search_new_php['add_more_folder'] = 'Batch-add more files from the folder %s'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File send_activation.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('SEND_ACTIVATION_PHP')) {
$lang_send_activation_php['err_already_logged_in'] = '�Ya estaba validado en el sistema!'; // cpg1.5
$lang_send_activation_php['activation_not_required'] = 'This website does not require activation by email'; // cpg1.5
$lang_send_activation_php['err_unk_user'] = 'Selected user does not exist!'; // cpg1.5
$lang_send_activation_php['resend_act_link'] = 'Resend activation link'; // cpg1.5
$lang_send_activation_php['enter_email'] = 'Enter your email address'; // cpg1.5
$lang_send_activation_php['submit'] = 'Enviar'; // cpg1.5
$lang_send_activation_php['failed_sending_email'] = 'Failed to send email with activation link'; // cpg1.5
$lang_send_activation_php['activation_email_sent'] = 'An email with activation link sent to %s. Please check your email to complete the process'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File stat_details.php
// ------------------------------------------------------------------------- //
if (defined('STAT_DETAILS_PHP')) {
$lang_stat_details_php['show_hide'] = 'show/hide this column';
$lang_stat_details_php['title'] = 'Statistic details'; // cpg1.5
$lang_stat_details_php['vote'] = 'Vote Details';
$lang_stat_details_php['hits'] = 'Hit Details';
$lang_stat_details_php['stats'] = 'Vote Statistics';
$lang_stat_details_php['users'] = 'User Statistics';
$lang_stat_details_php['sdate'] = 'Date';
$lang_stat_details_php['rating'] = 'Rating';
$lang_stat_details_php['search_phrase'] = 'Search phrase';
$lang_stat_details_php['referer'] = 'Referer';
$lang_stat_details_php['browser'] = 'Browser';
$lang_stat_details_php['os'] = 'Operating System';
$lang_stat_details_php['ip'] = 'IP';
$lang_stat_details_php['uid'] = 'User'; // cpg1.5
$lang_stat_details_php['sort_by_xxx'] = 'Sort by %s';
$lang_stat_details_php['ascending'] = 'ascending';
$lang_stat_details_php['descending'] = 'descending';
$lang_stat_details_php['internal'] = 'int';
$lang_stat_details_php['close'] = 'close';
$lang_stat_details_php['hide_internal_referers'] = 'hide internal referers';
$lang_stat_details_php['date_display'] = 'Date display';
$lang_stat_details_php['records_per_page'] = 'records per page';
$lang_stat_details_php['submit'] = 'submit / refresh';
$lang_stat_details_php['overall_stats'] = 'Overall Statistics'; // cpg1.5
$lang_stat_details_php['stats_by_os'] = 'Stats by operating systems'; // cpg1.5
$lang_stat_details_php['number_of_hits'] = 'Number of hits'; // cpg1.5
$lang_stat_details_php['total'] = 'Total'; // cpg1.5
$lang_stat_details_php['stats_by_browser'] = 'Stats by browser'; // cpg1.5
$lang_stat_details_php['overall_stats_config'] = 'Overall stats configuration'; // cpg1.5
$lang_stat_details_php['hit_details'] = 'Keep detailed hit statistics'; // cpg1.5
$lang_stat_details_php['hit_details_explanation'] = 'Keep detailed hit statistics'; // cpg1.5
$lang_stat_details_php['vote_details'] = 'Keep detailed voting statistics'; // cpg1.5
$lang_stat_details_php['vote_details_explanation'] = 'Keep detailed voting statistics'; // cpg1.5
$lang_stat_details_php['empty_hits_table'] = 'Empty all hit stats'; // cpg1.5
$lang_stat_details_php['empty_hits_table_confirm'] = 'Are you absolutely sure that you want to delete ALL hit stat records for your ENTIRE gallery? This cannot be undone!'; // cpg1.5 // js-alert
$lang_stat_details_php['empty_votes_table'] = 'Empty all voting stats'; // cpg1.5
$lang_stat_details_php['empty_votes_table_confirm'] = 'Are you absolutely sure that you want to delete ALL voting records for your ENTIRE gallery? This cannot be undone!'; // cpg1.5 // js-alert
$lang_stat_details_php['submit'] = 'Submit'; // cpg1.5
$lang_stat_details_php['upd_success'] = 'Coppermine configuration was updated'; // cpg1.5
$lang_stat_details_php['votes'] = 'votes'; // cpg1.5
$lang_stat_details_php['reset_votes_individual'] = 'Reset selected vote(s)'; // cpg1.5
$lang_stat_details_php['reset_votes_individual_confirm'] = 'Are you sure that you want to delete the selected votes? This cannot be undone!'; // cpg1.5
$lang_stat_details_php['back_to_intermediate'] = 'Back to intermediate file view'; // cpg1.5
$lang_stat_details_php['records_on_page'] = '%s records on %s page(s)'; // cpg1.5
$lang_stat_details_php['guest'] = 'Guest'; // cpg1.5
$lang_stat_details_php['not_implemented'] = 'not implemented yet'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //
if (defined('UPLOAD_PHP')) {
$lang_upload_php['title'] = 'Upload file';
$lang_upload_php['restrictions'] = 'Restrictions'; // cpg1.5
$lang_upload_php['choose_method'] = 'Choose upload method'; // cpg1.5
$lang_upload_php['upload_swf'] = 'Multiple files - Flash-driven (recommended)'; // cpg1.5
$lang_upload_php['upload_single'] = 'simple - one file at a time'; // cpg1.5
$lang_upload_php['up_instr_1'] = 'Select an album from the album dropdown list';
$lang_upload_php['up_instr_2'] = 'Click the "Browse" button below and navigate to the file you want to upload. You can select multiple files in a single go using Ctrl+Click.';
$lang_upload_php['up_instr_3'] = 'Select more files to upload by repeating step 2';
$lang_upload_php['up_instr_4'] = 'Click the "Continue" button after all your files have completed uploading (the button will only appear when you have uploaded at least one file).';
$lang_upload_php['up_instr_5'] = 'You\'ll be sent to a screen where you can enter details about the uploaded files. After filling in, submit that form using the "Apply changes" button at the bottom of that form.';
$lang_upload_php['restriction_zip'] = 'ZIP files uploaded will remain compressed, they will not be extracted on the server.';
$lang_upload_php['restriction_filesize'] = 'The size of files uploaded from your client to the server must not exceed %s each.';
$lang_upload_php['reg_instr_1'] = 'Invalid action for form creation.';
$lang_upload_php['no_name'] = 'Filename unavailable'; // cpg 1.5
$lang_upload_php['no_tmp_name'] = 'Unable to upload'; // cpg 1.5
$lang_upload_php['no_post'] = 'File not uploaded by POST.';
$lang_upload_php['forb_ext'] = 'Forbidden file extension.';
$lang_upload_php['exc_php_ini'] = 'Exceeded filesize allowed in php.ini.';
$lang_upload_php['exc_file_size'] = 'Exceeded filesize permitted by CPG.';
$lang_upload_php['partial_upload'] = 'Only a partial upload.';
$lang_upload_php['no_upload'] = 'No upload occurred.';
$lang_upload_php['unknown_code'] = 'Unknown PHP upload error code.';
$lang_upload_php['impossible'] = 'Impossible to move.';
$lang_upload_php['not_image'] = 'Not an image/corrupt';
$lang_upload_php['not_GD'] = 'Not a GD extension.';
$lang_upload_php['pixel_allowance'] = 'The height and/or width of the uploaded picture is more than that allowed by the gallery config.';
$lang_upload_php['failure'] = 'Upload failure';
$lang_upload_php['no_place'] = 'The previous file could not be placed.';
$lang_upload_php['max_fsize'] = 'Maximum allowed file size is %s';
$lang_upload_php['picture'] = 'File';
$lang_upload_php['pic_title'] = 'File title';
$lang_upload_php['description'] = 'File description';
$lang_upload_php['keywords_sel'] = 'Select a keyword';
$lang_upload_php['err_no_alb_uploadables'] = 'Sorry there is no album where you are allowed to upload files';
$lang_upload_php['close'] = 'Close';
$lang_upload_php['no_keywords'] = 'Sorry, no keywords available!';
$lang_upload_php['regenerate_dictionary'] = 'Regenerate dictionary';
$lang_upload_php['allowed_types'] = 'You are allowed to upload files with the following extensions:'; // cpg1.5
$lang_upload_php['allowed_img_types'] = 'Image extensions: %s'; // cpg1.5
$lang_upload_php['allowed_mov_types'] = 'Video extensions: %s'; // cpg1.5
$lang_upload_php['allowed_doc_types'] = 'Document extensions: %s'; // cpg1.5
$lang_upload_php['allowed_snd_types'] = 'Audio extensions: %s'; // cpg1.5
$lang_upload_php['please_wait'] = 'Please wait while the script is uploading - this might take a while'; // cpg1.5
$lang_upload_php['alternative_upload'] = 'Alternative upload method'; // cpg1.5
$lang_upload_php['xp_publish_promote'] = 'If you are running Windows XP/Vista, you can use the Windows XP Uploading Wizard as well to upload files, providing an easier user interface directly on the client.'; // cpg1.5
$lang_upload_php['err_js_disabled'] = 'Flash upload interface could not load. You must have JavaScript enabled to enjoy the flash upload interface.'; // cpg1.5
$lang_upload_php['err_flash_disabled'] = 'Upload interface is taking a long time to load or the load has failed. Please make sure that the Flash Plugin is enabled and that a working version of the Flash Player is installed.'; // cpg1.5
$lang_upload_php['err_alternate_method'] = 'Alternately you can use the <a href="upload.php?single=1">single</a> file upload interface.'; // cpg1.5
$lang_upload_php['err_flash_version'] = 'Upload interface could not load. You may need to install or upgrade Flash Player. Visit the <a href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash">Adobe website</a> to get the Flash Player.'; // cpg1.5
$lang_upload_php['flash_loading'] = 'Upload interface is loading. Please wait a moment...'; // cpg1.5
$lang_upload_swf_php['browse'] = 'Browse...'; //cpg1.5
$lang_upload_swf_php['cancel_all'] = 'Cancel all uploads'; //cpg1.5
$lang_upload_swf_php['upload_queue'] = 'Upload Queue'; //cpg1.5
$lang_upload_swf_php['files_uploaded'] = 'files uploaded'; //cpg1.5
$lang_upload_swf_php['all_files'] = 'All Files'; //cpg1.5
$lang_upload_swf_php['status_pending'] = 'Pending...'; //cpg1.5
$lang_upload_swf_php['status_uploading'] = 'Uploading...'; //cpg1.5
$lang_upload_swf_php['status_complete'] = 'Complete.'; //cpg1.5
$lang_upload_swf_php['status_cancelled'] = 'Cancelled.'; //cpg1.5
$lang_upload_swf_php['status_stopped'] = 'Stopped.'; //cpg1.5
$lang_upload_swf_php['status_failed'] = 'Upload Failed.'; //cpg1.5
$lang_upload_swf_php['status_too_big'] = 'File is too big.'; //cpg1.5
$lang_upload_swf_php['status_zero_byte'] = 'Cannot upload Zero Byte files.'; //cpg1.5
$lang_upload_swf_php['status_invalid_type'] = 'Invalid File Type.'; //cpg1.5
$lang_upload_swf_php['status_unhandled'] = 'Unhandled Error'; //cpg1.5
$lang_upload_swf_php['status_upload_error'] = 'Upload Error: '; //cpg1.5
$lang_upload_swf_php['status_server_error'] = 'Server (IO) Error'; //cpg1.5
$lang_upload_swf_php['status_security_error'] = 'Security Error'; //cpg1.5
$lang_upload_swf_php['status_upload_limit'] = 'Upload limit exceeded.'; //cpg1.5
$lang_upload_swf_php['status_validation_failed'] = 'Failed Validation. Upload skipped.'; //cpg1.5
$lang_upload_swf_php['queue_limit'] = 'You have attempted to queue too many files.'; //cpg1.5
$lang_upload_swf_php['upload_limit_1'] = 'You have reached the upload limit.'; //cpg1.5
$lang_upload_swf_php['upload_limit_2'] = 'You may select up to %s file(s)'; //cpg1.5
}

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) {
$lang_usermgr_php['memberlist'] = 'Memberlist';
$lang_usermgr_php['user_manager'] = 'User manager';
$lang_usermgr_php['title'] = 'Manage users';
$lang_usermgr_php['name_a'] = 'Name ascending';
$lang_usermgr_php['name_d'] = 'Name descending';
$lang_usermgr_php['group_a'] = 'Group ascending';
$lang_usermgr_php['group_d'] = 'Group descending';
$lang_usermgr_php['reg_a'] = 'Reg date ascending';
$lang_usermgr_php['reg_d'] = 'Reg date descending';
$lang_usermgr_php['pic_a'] = 'File count ascending';
$lang_usermgr_php['pic_d'] = 'File count descending';
$lang_usermgr_php['disku_a'] = 'Disk usage ascending';
$lang_usermgr_php['disku_d'] = 'Disk usage descending';
$lang_usermgr_php['lv_a'] = 'Last visit ascending';
$lang_usermgr_php['lv_d'] = 'Last visit descending';
$lang_usermgr_php['sort_by'] = 'Sort users by';
$lang_usermgr_php['err_no_users'] = 'User table is empty!';
$lang_usermgr_php['err_edit_self'] = 'You can\'t edit your own profile, use the \'My profile\' link for that';
$lang_usermgr_php['with_selected'] = 'With selected:';
$lang_usermgr_php['delete_files_no'] = 'keep public files (but anonymize)';
$lang_usermgr_php['delete_files_yes'] = 'delete public files as well';
$lang_usermgr_php['delete_comments_no'] = 'keep comments (but anonymize)';
$lang_usermgr_php['delete_comments_yes'] = 'delete comments as well';
$lang_usermgr_php['activate'] = 'Activate';
$lang_usermgr_php['deactivate'] = 'Deactivate';
$lang_usermgr_php['reset_password'] = 'Reset Password';
$lang_usermgr_php['change_primary_membergroup'] = 'Change primary membergroup';
$lang_usermgr_php['add_secondary_membergroup'] = 'Add secondary membergroup';
$lang_usermgr_php['name'] = 'User name';
$lang_usermgr_php['group'] = 'Group';
$lang_usermgr_php['inactive'] = 'Inactive';
$lang_usermgr_php['operations'] = 'Operations';
$lang_usermgr_php['pictures'] = 'Files';
$lang_usermgr_php['disk_space_used'] = 'Space used';
$lang_usermgr_php['disk_space_quota'] = 'Quota'; // cpg1.5
$lang_usermgr_php['registered_on'] = 'Registration';
$lang_usermgr_php['last_visit'] = 'Last visit';
$lang_usermgr_php['u_user_on_p_pages'] = '%d users on %d page(s)';
$lang_usermgr_php['confirm_del'] = 'Are you sure you want to DELETE this user?\\nAll his/her files and albums will also be deleted.'; // js-alert
$lang_usermgr_php['mail'] = 'MAIL';
$lang_usermgr_php['err_unknown_user'] = 'Selected user does not exist!';
$lang_usermgr_php['modify_user'] = 'Modify user';
$lang_usermgr_php['notes'] = 'Notes';
$lang_usermgr_php['note_list'] = 'If you don\'t want to change the current password, leave the "password" field blank';
$lang_usermgr_php['password'] = 'Password';
$lang_usermgr_php['user_active'] = 'User is active';
$lang_usermgr_php['user_group'] = 'User group';
$lang_usermgr_php['user_email'] = 'User email';
$lang_usermgr_php['user_web_site'] = 'User web site';
$lang_usermgr_php['create_new_user'] = 'Create new user';
$lang_usermgr_php['user_location'] = 'User location';
$lang_usermgr_php['user_interests'] = 'User interests';
$lang_usermgr_php['user_occupation'] = 'User occupation';
$lang_usermgr_php['user_profile1'] = '$user_profile1';
$lang_usermgr_php['user_profile2'] = '$user_profile2';
$lang_usermgr_php['user_profile3'] = '$user_profile3';
$lang_usermgr_php['user_profile4'] = '$user_profile4';
$lang_usermgr_php['user_profile5'] = '$user_profile5';
$lang_usermgr_php['user_profile6'] = '$user_profile6';
$lang_usermgr_php['latest_upload'] = 'Recent uploads';
$lang_usermgr_php['no_latest_upload'] = 'Has not uploaded any files'; // cpg1.5
$lang_usermgr_php['last_comments'] = 'Last comments'; // cpg1.5
$lang_usermgr_php['no_last_comments'] = 'Has not made any comments'; // cpg1.5
$lang_usermgr_php['comments'] = 'Comments'; // cpg1.5
$lang_usermgr_php['never'] = 'never';
$lang_usermgr_php['search'] = 'User search';
$lang_usermgr_php['submit'] = 'Submit';
$lang_usermgr_php['search_submit'] = 'Go!';
$lang_usermgr_php['search_result'] = 'Search results for: ';
$lang_usermgr_php['alert_no_selection'] = 'You have to select at least one user first!'; // js-alert
$lang_usermgr_php['select_group'] = 'Select group';
$lang_usermgr_php['groups_alb_access'] = 'Album permissions by group';
$lang_usermgr_php['category'] = 'Category';
$lang_usermgr_php['modify'] = 'Modify?';
$lang_usermgr_php['group_no_access'] = 'This group has no special access';
$lang_usermgr_php['notice'] = 'Notice';
$lang_usermgr_php['group_can_access'] = 'Album(s) that only "%s" can access';
$lang_usermgr_php['send_login_data'] = 'Send login data to this user (Password will be sent via email)'; // cpg1.5
$lang_usermgr_php['send_login_email_subject'] = 'Your new account information'; // cpg1.5
$lang_usermgr_php['failed_sending_email'] = 'The login data email can\'t be sent!'; // cpg1.5
$lang_usermgr_php['view_profile'] = 'View profile'; // cpg1.5
$lang_usermgr_php['edit_profile'] = 'Edit profile'; // cpg1.5
$lang_usermgr_php['ban_user'] = 'Ban user'; // cpg1.5
$lang_usermgr_php['user_is_banned'] = 'User is banned'; // cpg1.5
$lang_usermgr_php['status'] = 'Status'; // cpg1.5
$lang_usermgr_php['status_active'] = 'active'; // cpg1.5
$lang_usermgr_php['status_inactive'] = 'not active'; // cpg1.5
$lang_usermgr_php['total'] = 'Total'; // cpg1.5
$lang_usermgr_php['send_login_data_email'] = <<< EOT
A new account has been created for you at {SITE_NAME}.

You can now log in at <a href="{SITE_LINK}">{SITE_LINK}</a> using the username "{USER_NAME}" and password "{USER_PASS}"


Regards,

The management of {SITE_NAME}

EOT;
}

// ------------------------------------------------------------------------- //
// File update.php
// ------------------------------------------------------------------------- //
if (defined('UPDATE_PHP')) {
$lang_update_php['title'] = 'Updater'; // cpg1.5
$lang_update_php['welcome_updater'] = 'Welcome to Coppermine update'; // cpg1.5
$lang_update_php['could_not_authenticate'] = 'Could not authenticate you'; // cpg1.5
$lang_update_php['provide_admin_account'] = 'Please provide your Coppermine admin account details or your MySQL account data'; // cpg1.5
$lang_update_php['try_again'] = 'Try again'; // cpg1.5
$lang_update_php['mysql_connect_error'] = 'Could not create a MySQL connection'; // cpg1.5
$lang_update_php['mysql_database_error'] = 'MySQL could not locate a database called %s'; // cpg1.5
$lang_update_php['mysql_said'] = 'MySQL said'; // cpg1.5
$lang_update_php['check_config_file'] = 'Please check the MySQL details in %s'; // cpg1.5
$lang_update_php['performing_database_updates'] = 'Performing Database Updates'; // cpg1.5
$lang_update_php['performing_file_updates'] = 'Performing File Updates'; // cpg1.5
$lang_update_php['already_done'] = 'Already Done'; // cpg1.5
$lang_update_php['password_encryption'] = 'Encryption of passwords'; // cpg1.5
$lang_update_php['alb_password_encryption'] = 'Encryption of album passwords'; // cpg1.5
$lang_update_php['category_tree'] = 'Category tree'; // cpg1.5
$lang_update_php['authentication_needed'] = 'Authentication needed'; // cpg1.5
$lang_update_php['username'] = 'Username'; // cpg1.5
$lang_update_php['password'] = 'Password'; // cpg1.5
$lang_update_php['update_completed'] = 'Update completed'; // cpg1.5
$lang_update_php['check_versions'] = 'It\'s recommended to %scheck your file versions%s if you just upgraded from an older version of Coppermine'; // cpg1.5 // Leave the %s untouched when translating - it wraps the link
$lang_update_php['start_page'] = 'If you didn\'t (or you don\'t want to check), you can go to %syour gallery\'s start page%s'; // cpg1.5 // Leave the %s untouched when translating - it wraps the link
$lang_update_php['errors_encountered'] = 'The following errors were encountered and need to be corrected first'; // cpg1.5
$lang_update_php['delete_file'] = 'Delete %s'; // cpg1.5
$lang_update_php['could_not_delete'] = 'Could not delete due to missing permissions. Delete the file manually!'; // cpg1.5
$lang_update_php['rename_file'] = 'Rename %s to %s'; // cpg1.5
$lang_update_php['could_not_rename'] = 'Could not rename due to missing permissions. Rename the file manually!'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) {
$lang_util_php['title'] = 'Admin tools'; // cpg1.5
$lang_util_php['file'] = 'File';
$lang_util_php['problem'] = 'Problem';
$lang_util_php['status'] = 'Status';
$lang_util_php['title_set_to'] = 'title set to';
$lang_util_php['submit_form'] = 'submit';
$lang_util_php['titles_updated'] = '%s Titles Updated.'; // cpg1.5
$lang_util_php['updated_successfully'] = 'updated successfully'; // cpg1.5
$lang_util_php['error_create'] = 'ERROR creating';
$lang_util_php['continue'] = 'Process more files'; // cpg1.5
$lang_util_php['main_success'] = 'The file %s was successfully used as main file';
$lang_util_php['error_rename'] = 'Error renaming %s to %s';
$lang_util_php['error_not_found'] = 'The file %s was not found';
$lang_util_php['back'] = 'back to Admin tools start'; // cpg1.5
$lang_util_php['thumbs_wait'] = 'Updating thumbnails and/or resized images, please wait...';
$lang_util_php['thumbs_continue_wait'] = 'Continuing to update thumbnails and/or resized images...';
$lang_util_php['titles_wait'] = 'Updating titles, please wait...';
$lang_util_php['delete_wait'] = 'Deleting titles, please wait...';
$lang_util_php['replace_wait'] = 'Deleting originals and replacing them with resized images, please wait..';
$lang_util_php['update'] = 'Update thumbs and/or resized photos';
$lang_util_php['update_what'] = 'What should be updated';
$lang_util_php['update_thumb'] = 'Only thumbnails';
$lang_util_php['update_pic'] = 'Only resized pictures';
$lang_util_php['update_both'] = 'Both thumbnails and resized pictures';
$lang_util_php['update_number'] = 'Number of processed images per click';
$lang_util_php['update_option'] = '(Try setting this option lower if you experience timeout problems)';
$lang_util_php['update_missing'] = 'Only update missing files'; // cpg1.5
$lang_util_php['filename_title'] = 'Filename &rArr; File title';
$lang_util_php['filename_how'] = 'How should the file title be modified';
$lang_util_php['filename_remove'] = 'Remove extension (.jpg or other) and replace _ (underscores) with spaces'; // cpg1.5
$lang_util_php['filename_euro'] = 'Change 2003_11_23_13_20_20.jpg to 23/11/2003 13:20';
$lang_util_php['filename_us'] = 'Change 2003_11_23_13_20_20.jpg to 11/23/2003 13:20';
$lang_util_php['filename_time'] = 'Change 2003_11_23_13_20_20.jpg to 13:20';
$lang_util_php['notitle'] = 'Apply only for files with empty titles'; // cpg1.5
$lang_util_php['delete_title'] = 'Delete file titles';
$lang_util_php['delete_title_explanation'] = 'This will remove all titles on files in the album you specify.';
$lang_util_php['delete_original'] = 'Delete original size photos';
$lang_util_php['delete_original_explanation'] = 'This will remove the full sized pictures.';
$lang_util_php['delete_intermediate'] = 'Delete intermediate pictures';
$lang_util_php['delete_intermediate_explanation1'] = 'This will delete intermediate (normal) pictures.'; // cpg1.5
$lang_util_php['delete_intermediate_explanation2'] = 'Use this to free up disk space if you have disabled \'Create intermediate pictures\' in config after adding pictures.'; // cpg1.5
$lang_util_php['delete_intermediate_check'] = 'The config option \'Create intermediate pictures\' is currently %s.'; // cpg1.5
$lang_util_php['no_image'] = '%s has been skipped because it is not an image.'; // cpg1.5
$lang_util_php['enabled'] = 'enabled'; // cpg1.5
$lang_util_php['disabled'] = 'disabled'; // cpg1.5
$lang_util_php['delete_replace'] = 'Deletes the original images replacing them with the sized versions';
$lang_util_php['titles_deleted'] = 'All titles in specified album removed';
$lang_util_php['deleting_intermediates'] = 'Deleting intermediate images, please wait...';
$lang_util_php['searching_orphans'] = 'Searching for orphans, please wait...';
$lang_util_php['delete_orphans'] = 'Delete comments on missing files';
$lang_util_php['delete_orphans_explanation'] = 'This will identify and allow you to delete any comments associated with files no longer in the gallery.<br />Checks all albums.';
$lang_util_php['update_full_normal_thumb'] = 'Everything: full-sized, resized and thumbs'; // cpg1.5
$lang_util_php['update_full_normal'] = 'Both resized and full sized (if an original copy is available)'; // cpg1.5
$lang_util_php['update_full'] = 'Just full sized (if an original copy is available)'; // cpg1.5
$lang_util_php['delete_back'] = 'Delete original image backup for watermarked images'; // cpg1.5
$lang_util_php['delete_back_explanation'] = 'This will delete the backup image. You will save some disk space but not be able anymore to undo the watermark!!! After that the watermark will be permanent.'; // cpg1.5
$lang_util_php['finished'] = '<br />Finished updating thumbs/images!<br />'; // cpg1.5
$lang_util_php['autorefresh'] = 'Auto refresh (no need to click continue button anymore)'; // cpg1.5
$lang_util_php['refresh_db'] = 'Reload file dimensions and size information.';
$lang_util_php['refresh_db_explanation'] = 'This will re-read file sizes and dimensions. Use this if quota\'s are incorrect or you have changed the files manually.';
$lang_util_php['reset_views'] = 'Reset view counters';
$lang_util_php['reset_views_explanation'] = 'Sets all file view counts to zero in the album specified.';
$lang_util_php['reset_success'] = 'Reset successful'; // cpg1.5
$lang_util_php['orphan_comment'] = 'orphan comments found';
$lang_util_php['delete_all'] = 'Delete all';
$lang_util_php['delete_all_orphans'] = 'Delete all orphans?';
$lang_util_php['comment'] = 'Comment: ';
$lang_util_php['nonexist'] = 'attached to non-existent file # ';
$lang_util_php['delete_old'] = 'Delete files that are older than a set number of days'; // cpg1.5
$lang_util_php['delete_old_explanation'] = 'This will delete files that are older than the number of days you specify (full-size, intermediate, thumbnails). Use this feature to free up disk space.'; // cpg1.5
$lang_util_php['delete_old_warning'] = 'Warning: the files you specify will be deleted for good without further warnings!'; // cpg1.5
$lang_util_php['deleting_old'] = 'Deleting older images, please wait...'; // cpg1.5
$lang_util_php['older_than'] = 'Delete files older than %s days'; // cpg1.5
$lang_util_php['del_orig'] = 'The original file %s was successfully deleted'; // cpg1.5
$lang_util_php['del_intermediate'] = 'The intermediate image %s was successfully deleted'; // cpg1.5
$lang_util_php['del_thumb'] = 'The thumbnail %s was successfully deleted'; // cpg1.5
$lang_util_php['del_error'] = 'Error deleting %s!'; // cpg1.5
$lang_util_php['affected_records'] = '%s affected records.'; // cpg1.5
$lang_util_php['all_albums'] = 'All Albums'; // cpg1.5
$lang_util_php['update_result'] = 'Update results'; // cpg1.5
$lang_util_php['incorrect_filesize'] = 'Total filesize is incorrect'; // cpg1.5
$lang_util_php['database'] = 'Database: '; // cpg1.5
$lang_util_php['bytes'] = ' bytes'; // cpg1.5
$lang_util_php['actual'] = 'Actual: '; // cpg1.5
$lang_util_php['updated'] = 'Updated'; // cpg1.5
$lang_util_php['filesize_error'] = 'Could not obtain file size (may be invalid file), skipping....'; // cpg1.5
$lang_util_php['skipped'] = 'Skipped'; // cpg1.5
$lang_util_php['incorrect_dimension'] = 'Dimensions are incorrect'; // cpg1.5
$lang_util_php['dimension_error'] = 'Could not obtain dimension info, skipping....'; // cpg1.5
$lang_util_php['cannot_fix'] = 'Cannot fix'; // cpg1.5
$lang_util_php['fullpic_error'] = 'File %s does not exist!'; // cpg1.5
$lang_util_php['no_prob_detect'] = 'No problems detected'; // cpg1.5
$lang_util_php['no_prob_found'] = 'No problems were found.'; // cpg1.5
$lang_util_php['keyword_convert'] = 'Convert keyword separator'; // cpg1.5
$lang_util_php['keyword_from_to'] = 'Convert keyword separator from %s to %s'; // cpg1.5
$lang_util_php['keyword_set'] = 'Set gallery keyword separator to new value'; // cpg1.5
$lang_util_php['keyword_replace_before'] = 'Before conversion, replace %s with %s'; // cpg1.5
$lang_util_php['keyword_replace_after'] = 'After conversion, replace %s with %s'; // cpg1.5
$lang_util_php['keyword_replace_values'] = array('_'=>'underscore', '-'=>'hyphen', '~'=>'tilde'); // cpg1.5
$lang_util_php['keyword_explanation'] = 'This will convert the keyword separator for all your files from one value to another value. See the help documentation for details.'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File versioncheck.php
// ------------------------------------------------------------------------- //
if (defined('VERSIONCHECK_PHP')) {
$lang_versioncheck_php['title'] = 'Versioncheck';
$lang_versioncheck_php['versioncheck_output'] = 'Versioncheck output';
$lang_versioncheck_php['file'] = 'file';
$lang_versioncheck_php['folder'] = 'folder';
$lang_versioncheck_php['outdated'] = 'older than %s';
$lang_versioncheck_php['newer'] = 'newer than %s';
$lang_versioncheck_php['modified'] = 'modified';
$lang_versioncheck_php['not_modified'] = 'unmodified'; // cpg1.5
$lang_versioncheck_php['needs_change'] = 'needs change';
$lang_versioncheck_php['review_permissions'] = 'Review Permissions';
$lang_versioncheck_php['inaccessible'] = 'File is inaccessible';
$lang_versioncheck_php['review_version'] = 'Your file is outdated';
$lang_versioncheck_php['review_dev_version'] = 'Your file is newer than anticipated';
$lang_versioncheck_php['review_modified'] = 'File may be corrupt (or you have deliberately edited it)';
$lang_versioncheck_php['review_missing'] = '%s missing or inaccessible';
$lang_versioncheck_php['existing'] = 'existing';
$lang_versioncheck_php['review_removed_existing'] = 'The file must be removed for security reasons';
$lang_versioncheck_php['counter'] = 'Counter';
$lang_versioncheck_php['type'] = 'Type';
$lang_versioncheck_php['path'] = 'Path';
$lang_versioncheck_php['missing'] = 'Missing';
$lang_versioncheck_php['permissions'] = 'Permissions';
$lang_versioncheck_php['version'] = 'Version';
$lang_versioncheck_php['revision'] = 'Revision';
$lang_versioncheck_php['modified'] = 'Modified';
$lang_versioncheck_php['comment'] = 'Comment';
$lang_versioncheck_php['help'] = 'Help';
$lang_versioncheck_php['repository_link'] = 'Repository link';
$lang_versioncheck_php['browse_corresponding_page_subversion'] = 'Browse page corresponding to this file in the project\'s subversion repository';
$lang_versioncheck_php['mandatory'] = 'mandatory';
$lang_versioncheck_php['mandatory_missing'] = 'Mandatory file is missing'; // cpg1.5
$lang_versioncheck_php['optional'] = 'optional';
$lang_versioncheck_php['removed'] = 'removed'; // cpg1.5
$lang_versioncheck_php['options'] = 'Options';
$lang_versioncheck_php['display_output'] = 'Display output';
$lang_versioncheck_php['on_screen'] = 'Full Screen';
$lang_versioncheck_php['text_only'] = 'Text-only';
$lang_versioncheck_php['errors_only'] = 'Only show potential errors';
$lang_versioncheck_php['hide_images'] = 'Hide images'; // cpg1.5
$lang_versioncheck_php['no_modification_check'] = 'Don\'t check for modified files'; // cpg1.5
$lang_versioncheck_php['do_not_connect_to_online_repository'] = 'Do not connect to the online repository';
$lang_versioncheck_php['online_repository_explain'] = 'only recommended if connection fails';
$lang_versioncheck_php['submit'] = 'submit / refresh';
$lang_versioncheck_php['select_all'] = 'Select All'; // js-alert
$lang_versioncheck_php['files_folder_processed'] = 'Displaying %s items of %s folders/files processed with %s potential issues';
$lang_versioncheck_php['read'] = 'Read'; // cpg1.5
$lang_versioncheck_php['write'] = 'Write'; // cpg1.5
$lang_versioncheck_php['warning'] = 'Warning'; // cpg1.5
$lang_versioncheck_php['not_applicable'] = 'n/a'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File view_log.php // Traducida
// ------------------------------------------------------------------------- //
if (defined('VIEWLOG_PHP')) {
$lang_viewlog_php['delete_all'] = 'Borrar todos los registros';
$lang_viewlog_php['delete_this'] = 'Borrar este registro';
$lang_viewlog_php['view_logs'] = 'Ver registros';
$lang_viewlog_php['no_logs'] = 'No hay registros.';
$lang_viewlog_php['last_updated'] = 'modificado por �ltima vez'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File xp_publish.php
// ------------------------------------------------------------------------- //
if (defined('XP_PUBLISH_PHP')) {
$lang_xp_publish_php['title'] = 'XP Web Publishing Wizard';
$lang_xp_publish_php['client_header'] = 'XP Web Publishing Wizard Client'; // cpg1.5
$lang_xp_publish_php['requirements'] = 'Requirements'; // cpg1.5
$lang_xp_publish_php['windows_xp'] = 'Windows XP / Vista'; // cpg1.5
$lang_xp_publish_php['no_windows_xp'] = 'You appear to be running another, unsupported operating system'; // cpg1.5
$lang_xp_publish_php['no_os_detect'] = 'Could not detect your operating system'; // cpg1.5
$lang_xp_publish_php['requirement_http_upload'] = 'A working installation of Coppermine on which the http upload function works properly'; // cpg1.5
$lang_xp_publish_php['requirement_ie'] = 'Microsoft Internet Explorer'; // cpg1.5
$lang_xp_publish_php['requirement_permissions'] = 'The administrator of the gallery must have granted you permission to upload'; // cpg1.5
$lang_xp_publish_php['requirement_login'] = 'You need to be logged in to upload'; // cpg1.5
$lang_xp_publish_php['no_ie'] = 'You appear to be using another, unsupported browser'; // cpg1.5
$lang_xp_publish_php['no_browser_detect'] = 'Could not detect your browser'; // cpg1.5
$lang_xp_publish_php['no_gallery_name'] = 'You need to specify a gallery name in config'; // cpg1.5
$lang_xp_publish_php['no_gallery_description'] = 'You need to specify a gallery description in config'; // cpg1.5
$lang_xp_publish_php['howto_install'] = 'How to install'; // cpg1.5
$lang_xp_publish_php['install_right_click'] = 'Right click on %sthis link%s and select &quot;save target as...&quot;'; // cpg1.5 // translator note: don't replace the %s - that placeholder token needs to go untranslated
$lang_xp_publish_php['install_save'] = 'Save the file on your client. When saving the file, make sure that the proposed file name is <tt>cpg_###.reg</tt> (the ### represents a numerical timestamp). Change it to that name if necessary (leave the numbers)'; // cpg1.5
$lang_xp_publish_php['install_execute'] = 'After the download has finished, execute the file by double clicking on it in order to register your server with the web publishing wizard'; // cpg1.5
$lang_xp_publish_php['usage'] = 'Usage'; // cpg1.5
$lang_xp_publish_php['select_files'] = 'In Windows Explorer, select the files you want to upload'; // cpg1.5
$lang_xp_publish_php['display_tasks'] = 'Make sure that the folders are not being displayed in left bar of the Explorer'; // cpg1.5
$lang_xp_publish_php['publish_on_the_web'] = 'click on &quot;Publish xxx on the web&quot; in the left pane'; // cpg1.5
$lang_xp_publish_php['confirm_selection'] = 'Confirm your file selection'; // cpg1.5
$lang_xp_publish_php['select_service'] = 'In the list of services that appear, select the one for your photo gallery (it has the name of your gallery)'; // cpg1.5
$lang_xp_publish_php['enter_login'] = 'Enter your login information if required'; // cpg1.5
$lang_xp_publish_php['select_album'] = 'Select the target album for your pictures or create a new one'; // cpg1.5
$lang_xp_publish_php['next'] = 'Click on &quot;next&quot;'; // cpg1.5
$lang_xp_publish_php['upload_starts'] = 'The upload of your pictures should start'; // cpg1.5
$lang_xp_publish_php['upload_completed'] = 'When it is completed, check your gallery to see if pictures have been properly added'; // cpg1.5
$lang_xp_publish_php['welcome'] = 'Welcome <strong>%s</strong>,';
$lang_xp_publish_php['need_login'] = 'You need to login to the gallery using Internet Explorer before you can use this wizard.<p/><p>When you login don\'t forget to select the &quot;remember me&quot; option if it is present.';
$lang_xp_publish_php['no_alb'] = 'Sorry but there is no album where you are allowed to upload pictures with this wizard.';
$lang_xp_publish_php['upload'] = 'Upload your pictures into an existing album';
$lang_xp_publish_php['create_new'] = 'Create a new album for your pictures';
$lang_xp_publish_php['category'] = 'Category';
$lang_xp_publish_php['new_alb_created'] = 'Your new album &quot;<strong>%s</strong>&quot; was created.';
$lang_xp_publish_php['continue'] = 'Press &quot;Next&quot; to start to upload your pictures';
$lang_xp_publish_php['link'] = '';
}

// ------------------------------------------------------------------------- //
// Core plugins
// ------------------------------------------------------------------------- //
if (defined('CORE_PLUGIN')) {
$lang_plugin_php['usergal_alphatabs_config_name'] = 'User Gallery Alphabetic Tabbing'; // cpg1.5
$lang_plugin_php['usergal_alphatabs_config_description'] = 'What it does: displays tabs from A to Z at the top of user galleries that visitors can click on to directly jump to a page that displays all user galleries of the users who\'s username starts with that letter. Plugin only recommended to be used if you have a really large number of user galleries.'; // cpg1.5
$lang_plugin_php['usergal_alphatabs_jump_by_username'] = 'Jump by username'; // cpg1.5
$lang_plugin_php['sample_config_name'] = 'Sample Plugin'; // cpg1.5
$lang_plugin_php['sample_config_description'] = 'This is a sample plugin. It will not do anything particular useful - it is just meant to demonstrate what plugins can do and how to code them. When enabled, it will display some sample text in red.'; // cpg1.5
$lang_plugin_php['sample_plugin_documentation'] = 'Plugin Documentation'; // cpg1.5
$lang_plugin_php['sample_plugin_support'] = 'Plugin Support'; // cpg1.5
$lang_plugin_php['sample_install_explain'] = 'Enter the username (\'foo\') and password (\'bar\') to install'; // cpg1.5
$lang_plugin_php['sample_install_username'] = 'Username'; // cpg1.5
$lang_plugin_php['sample_install_password'] = 'Password'; // cpg1.5
$lang_plugin_php['sample_output'] = 'This is sample data returned from the sample plugin'; // cpg1.5
$lang_plugin_php['opensearch_config_name'] = 'OpenSearch'; // cpg1.5
$lang_plugin_php['opensearch_config_description'] = 'An implementation of <a href="http://www.opensearch.org/" rel="external" class="external">OpenSearch</a> for Coppermine.<br />When enabled, visitors can add your gallery to their browser\'s search bar.'; // cpg1.5
$lang_plugin_php['opensearch_search'] = 'Search %s'; // cpg1.5
$lang_plugin_php['opensearch_extra'] = 'You may want to add some text to your site that explains what this plugin does'; // cpg1.5
$lang_plugin_php['opensearch_failed_to_open_file'] = 'Failed to open file %s - check permissions'; // cpg1.5
$lang_plugin_php['opensearch_failed_to_write_file'] = 'Failed to write to file %s - check permissions'; // cpg1.5
$lang_plugin_php['opensearch_form_header'] = 'Enter the details to be used for the description file'; // cpg1.5
$lang_plugin_php['opensearch_gallery_url'] = 'Gallery URL (must be correct)'; // cpg1.5
$lang_plugin_php['opensearch_display_name'] = 'Name as displayed in browser'; // cpg1.5
$lang_plugin_php['opensearch_description'] = 'Description'; // cpg1.5
$lang_plugin_php['opensearch_character_limit'] = '%s character limit'; // cpg1.5
$lang_plugin_php['onlinestats_description'] = 'Display a block on each gallery page that shows users and guests actually online.';
$lang_plugin_php['onlinestats_name'] = 'Who is online?';
$lang_plugin_php['onlinestats_config_extra'] = 'To enable this plugin (make it actually display the onlinestats block), the string "onlinestats" (separated with a slash) has been added to "the content of the main page" in <a href="admin.php">Coppermine\'s config</a> in the section "Album list view". The setting should now look like "breadcrumb/catlist/alblist/onlinestats" or similar. To change the position of the block, move the string "onlinestats" around inside that config field.';
$lang_plugin_php['onlinestats_config_install'] = 'The plugin runs additional queries on the database each time it is being executed, burning CPU cycles and using resources. If your Coppermine gallery is slow or has got a lot of users, you shouldn\'t use it.';
$lang_plugin_php['onlinestats_we_have_reg_member'] = 'There is %s registered user';
$lang_plugin_php['onlinestats_we_have_reg_members'] = ' There are %s registered users';
$lang_plugin_php['onlinestats_most_recent'] = 'The newest registered user is %s';
$lang_plugin_php['onlinestats_is'] = 'In total there is %s visitor online';
$lang_plugin_php['onlinestats_are'] = 'In total there are %s visitors online';
$lang_plugin_php['onlinestats_and'] = 'and';
$lang_plugin_php['onlinestats_reg_member'] = '%s registered user';
$lang_plugin_php['onlinestats_reg_members'] = '%s registered users';
$lang_plugin_php['onlinestats_guest'] = '%s guest';
$lang_plugin_php['onlinestats_guests'] = '%s guests';
$lang_plugin_php['onlinestats_record'] = 'Most users ever online: %s on %s';
$lang_plugin_php['onlinestats_since'] = 'Registered users who have been online in the past %s minutes: %s';
$lang_plugin_php['onlinestats_config_text'] = 'How long do you want to keep users listed as online for before they are assumed to have gone?';
$lang_plugin_php['onlinestats_minute'] = 'minutes';
$lang_plugin_php['onlinestats_remove'] = 'Remove the table that was used to store online data?';
$lang_plugin_php['link_target_name'] = 'Link target';
$lang_plugin_php['link_target_description'] = 'Changes the way external links are being opened: when this plugin is enabled, all links that contain the attribute rel="external" will open in a new window (instead of the same window).';
$lang_plugin_php['link_target_extra'] = 'This plugin has an impact mostly on the "Powered by Coppermine" link at the bottom of the gallery output.';
$lang_plugin_php['link_target_recommendation'] = 'It is recommended not to use this plugin to avoid bossing your users around: opening links in a new window means bossing around your site visitors.';
}

?>