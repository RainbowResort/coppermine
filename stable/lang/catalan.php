<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.1                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR                                     //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'Catalan',  
'lang_name_native' => 'Catal&agreugi;',
'lang_country_code' => 'es', 
'trans_name'=> 'Carles Escrig (simkin)', //the name of the translator - can be a nickname
'trans_email' => 'simkin@ono.com', //translator's email address (optional)
'trans_website' => 'http://simkin.now.nu/', //translator's website (optional)
'trans_date' => '2003-11-19', //the date the translation was created / last modified
);

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Dg', 'Dl', 'Dt', 'Dc', 'Dj', 'Dv', 'Db');
$lang_month = array('Gen', 'Febr', 'Mar�', 'Abr', 'Maig', 'Juny', 'Jul', 'Ag', 'Set', 'Oct', 'Nov', 'Des');

// Some common strings
$lang_yes = 'Si';
$lang_no  = 'No';
$lang_back = 'ARRERE';
$lang_continue = 'CONTINUAR';
$lang_info = 'Informaci�';
$lang_error = 'Error';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%d de %B de %Y';
$lastcom_date_fmt =  '%d/%m/%y a les %H:%M';
$lastup_date_fmt = '%d de %B de %Y';
$register_date_fmt = '%d de %B de %Y';
$lasthit_date_fmt = '%d de %B de %Y a les %I:%M %p';
$comment_date_fmt =  '%d de %B de %Y a les %I:%M %p';


// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
	'random' => 'Fotos a l\'atzar',
	'lastup' => '�ltimes fotos',
    'lastalb'=> '�ltims �lbums modificats',
	'lastcom' => '�ltims comentaris',
	'topn' => 'M�s vistes',
	'toprated' => 'M�s valorades',
	'lasthits' => '�ltimes vistes',
	'search' => 'Resultat de la recerca',
    'favpics'=> 'Fotos favorites'
);

$lang_errors = array(
	'access_denied' => 'No te permisos per a accedir a aquesta p�gina.',
	'perm_denied' => 'No te permisos per a realitzar aquesta operaci�.',
	'param_missing' => 'Cridada a Script sense els par�metres requerits.',
	'non_exist_ap' => 'L\'�lbum/foto seleccionat no existeix!',
	'quota_exceeded' => 'Quota de disc excedida<br /><br />Te una quota de disc de  %[quota]K, les seues fotos actualment ocupen %[space]K, i afegint aquesta foto excediria la quota.',
	'gd_file_type_err' => 'Quan s\'usa la llibreria d\'imatge GD solament estan permesos els tipus JPEG i PNG.',
	'invalid_image' => 'La imatge que ha afegit est� corrupta o no pot ser tractada per la llibreria GD.',
	'resize_failed' => 'Incapa� de crear thumbnail o imatge de grand�ria redu�da.',
	'no_img_to_display' => 'Cap imatge que ensenyar.',
	'non_exist_cat' => 'La categoria seleccionada no existeix.',
	'orphan_cat' => 'Una categoria no t� pare, executa la utilitat de categories per a corregir el problema.',
	'directory_ro' => 'El directori \'%s\' no t� permisos d\'escriptura, les fotos no poden ser esborrades.',
	'non_exist_comment' => 'El comentari seleccionat no existeix.',
	'pic_in_invalid_album' => 'La foto est� en un �lbum que no existeix (%s)!?',
    'banned' => 'Actualment est�s expulsat respecte a l\'�s d\'aquesta web.',
    'not_with_udb' => 'Aquesta funci� est� desactivada en Coppermine perqu� est� integrada amb un programari de f�rums. El que sigui que est� intentant fer no est� suportat per aquesta configuraci�, o la funci� deu ser manejada pel programari de f�rums.',
);


// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'Anar a la llista d\'�lbums',
	'alb_list_lnk' => 'Llista d\'�lbums',
	'my_gal_title' => 'Anar a la meva galeria personal',
	'my_gal_lnk' => 'La meva galeria',
	'my_prof_lnk' => 'El meu perfil d\'usuari',
	'adm_mode_title' => 'Anar a mode administrador',
	'adm_mode_lnk' => 'Mode Admininstrador',
	'usr_mode_title' => 'Anar a mode usuari',
	'usr_mode_lnk' => 'Mode Usuari',
	'upload_pic_title' => 'Inserir foto en un �lbum',
	'upload_pic_lnk' => 'Inserir foto',
	'register_title' => 'Crear un usuari',
	'register_lnk' => 'Registrar-se',
	'login_lnk' => 'Login',
	'logout_lnk' => 'Logout',
	'lastup_lnk' => '�ltimes fotos',
	'lastcom_lnk' => '�ltims comentaris',
	'topn_lnk' => 'M�s vistes',
	'toprated_lnk' => 'M�s valorades',
	'search_lnk' => 'Cercar',
	'fav_lnk' => 'Els meus Favorits',
    'ban_lnk' => 'Ban usuaris', //new in cpg1.2.0.
	
);


$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Aprovar Pujades',
	'config_lnk' => 'Configuraci�',
	'albums_lnk' => '�lbums',
	'categories_lnk' => 'Categories',
	'users_lnk' => 'Usuaris',
	'groups_lnk' => 'Grups',
	'comments_lnk' => 'Comentaris',
	'searchnew_lnk' => 'Afegir fotos (massiu)',
    'util_lnk' => 'Canviar grand�ria de les fotos',
    'ban_lnk' => 'Expulsar Usuaris',

);


$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Crear / ordenar �lbums',
	'modifyalb_lnk' => 'Modificar els meus �lbums',
	'my_prof_lnk' => 'El meu perfil d\'usuari',
);


$lang_cat_list = array(
	'category' => 'Categoria',
	'albums' => '�lbums',
	'pictures' => 'Fotos',
);

$lang_album_list = array(
	'album_on_page' => '%d �lbums en %d p�gina(s)'
);

$lang_thumb_view = array(
	'date' => 'DATA',
        //Sort by filename and title
	'name' => 'NOM',
    'title' => 'T�TOL',
	'sort_da' => 'Ordenat per data ascendent',
	'sort_dd' => 'Ordenat per data descendent',
	'sort_na' => 'Ordenat per nom ascendent',
	'sort_nd' => 'Ordenat per nom descendent',
    'sort_ta' => 'Ordenat per t�tol ascendent',
    'sort_td' => 'Ordenat per t�tol descendent',
	'pic_on_page' => '%d fotos en %d p�gina(s)',
	'user_on_page' => '%d usuaris en %d p�gina(s)'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Tornar a l\'�ndex de l\'�lbum',
	'pic_info_title' => 'Mostrar/ocultar informaci� de la foto',
	'slideshow_title' => 'Projecci� de Diapositives',
	'ecard_title' => 'Enviar aquesta foto a un amic/amiga',
	'ecard_disabled' => 'Enviament de fotos deshabilitat',
	'ecard_disabled_msg' => 'No tens permisos per a enviar fotos',
	'prev_title' => 'Veure foto anterior',
	'next_title' => 'Veure foto seg�ent',
	'pic_pos' => 'FOTO %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Valorar aquesta foto ',
	'no_votes' => '(No hi ha vots)',
	'rating' => '(valoraci� actual : %s / 5 amb %s vots)',
	'rubbish' => 'Dolenta',
	'poor' => 'Regular',
	'fair' => 'Normal',
	'good' => 'Bona',
	'excellent' => 'Excel�lent',
	'great' => 'Genial',
);

// ------------------------------------------------------------------------- //
// File include/exif.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File include/functions.inc.php
// ------------------------------------------------------------------------- //

$lang_cpg_die = array(
	INFORMATION => $lang_info,
	ERROR => $lang_error,
	CRITICAL_ERROR => 'Error cr�tic',
	'file' => 'Fitxer: ',
	'line' => 'Linea: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Fitxer: ',
	'filesize' => 'Grand�ria: ',
	'dimensions' => 'Dimensions: ',
	'date_added' => 'Data d\'alta: '
);

$lang_get_pic_data = array(
	'n_comments' => '%s comentaris',
	'n_views' => 'vista %s vegades',
	'n_votes' => '(%s vots)'
);

// ------------------------------------------------------------------------- //
// File include/init.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File include/picmgmt.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File include/smilies.inc.php
// ------------------------------------------------------------------------- //

if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array(
	'Exclamation' => 'Exclamaci�',
	'Question' => 'Pregunta',
	'Very Happy' => 'Molt Feli�',
	'Smile' => 'Somriure',
	'Sad' => 'Trist',
	'Surprised' => 'Sorpr�s',
	'Shocked' => 'Impressionat',
	'Confused' => 'Conf�s',
	'Cool' => 'Guai',
	'Laughing' => 'Rient',
	'Mad' => 'Furi�s',
	'Razz' => 'Razz',
	'Embarassed' => 'Avergonyit',
	'Crying or Very sad' => 'Plorant o molt trist',
	'Evil or Very Mad' => 'Dolent o molt boig',
	'Twisted Evil' => 'Twisted Evil',
	'Rolling Eyes' => 'Rolling Eyes',
	'Wink' => 'Wink',
	'Idea' => 'Idea',
	'Arrow' => 'Fletxa',
	'Neutral' => 'Neutral',
	'Mr. Green' => 'Mr. Verd',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'Sortint de mode administrador...',
	1 => 'Entrant en mode administrador...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Els �lbums han de tenir un nom!',
	'confirm_modifs' => 'Est� segur d\\\'aplicar aquestes modificacions?',
	'no_change' => 'No s\\\'ha fet cap canvi!',
	'new_album' => 'Nou �lbum',
	'confirm_delete1' => 'Est� segur de voler esborrar aquest �lbum?',
	'confirm_delete2' => '\nTotes les fotos i comentaris que cont� es perdran!',
	'select_first' => 'Seleccioni un �lbum primer',
	'alb_mrg' => 'Administrador d\'�lbums',
	'my_gallery' => '* La meva galeria *',
	'no_category' => '* Sense categoria *',
	'delete' => 'Esborrar',
	'new' => 'Nou',
	'apply_modifs' => 'Aplicar modificacions',
	'select_category' => 'Seleccionar categoria',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Els par�metres requerits per a l\'operaci�: \'%s\' no han estat subministrats!',
	'unknown_cat' => 'La categoria seleccionada no existeix en la base de dades',
	'usergal_cat_ro' => 'Les categories de galeries d\'usuari no poden ser esborrades!',
	'manage_cat' => 'Organitzador de categories',
	'confirm_delete' => 'Est� segur de voler ESBORRAR aquesta catagor�a',
	'category' => 'Categoria',
	'operations' => 'Operacions',
	'move_into' => 'Moure cap a',
	'update_create' => 'Modificar/Crear categoria',
	'parent_cat' => 'Categoria pare',
	'cat_title' => 'T�tol de la categoria',
	'cat_desc' => 'Descripci� de la categoria'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Configuraci�',
	'restore_cfg' => 'Restaurar valors per defecte',
	'save_cfg' => 'Desar la nova configuraci�',
	'notes' => 'Notes',
	'info' => 'Informaci�',
	'upd_success' => 'La configuraci� de Coppermine ha estat actualitzada',
	'restore_success' => 'Valors per defecte de Coppermine restaurats',
	'name_a' => 'Ascendent per nom',
	'name_d' => 'Descendent per nom',
    'title_a' => 'Ascendent per t�tol',
    'title_d' => 'Descendent per t�tol',
	'date_a' => 'Ascendent per data',
	'date_d' => 'Descendent per data',
    'th_any' => 'Max Aspect',
    'th_ht' => 'Al�ada',
    'th_wd' => 'Amplada',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Par�metres Generals',
	array('Nom de la galeria', 'gallery_name', 0),
	array('Descripci� de la galeria', 'gallery_description', 0),
	array('Correu electr�nic de l\'administrador', 'gallery_admin_email', 0),
	array('Adre�a web associada a  \'Veure m�s fotos\' a les e-cards', 'ecards_more_pic_target', 0),
	array('Idioma', 'lang', 5),
	array('Tema (aspecte)', 'theme', 6),

	'Aspecte de la llista d\'�lbums',
	array('Ampl�ria de la taula principal (p�xels o %)', 'main_table_width', 0),
	array('Nombre de nivells de categories a mostrar', 'subcat_level', 0),
	array('Nombre d\'�lbums a mostrar', 'albums_per_page', 0),
	array('Nombre de columnes a la llista d\'�lbums', 'album_list_cols', 0),
	array('Grand�ria de les miniatures en p�xels', 'alb_list_thumb_size', 0),
	array('Contingut de la p�gina principal', 'main_page_layout', 0),
    array('Mostrar miniatures d\'�lbums de primer nivell en categories','first_level',1),

	'Aspecte de la vista de Miniatures',
	array('Nombre de columnes en la p�gina de miniatures', 'thumbcols', 0),
	array('Nombre de files en la p�gina de miniatures', 'thumbrows', 0),
	array('M�xim nombre de tabs a mostrar', 'max_tabs', 0),
	array('Mostrar picture caption (a m�s del t�tol) sota la miniatura', 'caption_in_thumbview', 1),
	array('Mostrar el nombre de comentaris sota la miniatura', 'display_comment_count', 1),
	array('Ordre per defecte de les fotos', 'default_sort_order', 3),
	array('M�nim nombre de vots perqu� una foto aparegui a la llista de  \'M�s Valorades\'', 'min_votes_for_rating', 0),

	'Vista de foto i Configuraci� de comentaris',
	array('Ampl�ria de la taula on mostrar la foto (p�xels o %)', 'picture_table_width', 0),
	array('Informaci� de la foto visible per defecte', 'display_pic_info', 1),
	array('Filtrar paraules malsonants als comentaris', 'filter_bad_words', 1),
	array('Permetre Emoticons als comentaris', 'enable_smilies', 1),
	array('M�xima longitud per a la descripci� d\'una foto', 'max_img_desc_length', 0),
	array('M�xim nombre de car�cters en una paraula', 'max_com_wlength', 0),
	array('M�xim nombre de l�nies en un comentari', 'max_com_lines', 0),
	array('M�xima longitud d\'un comentari', 'max_com_size', 0),
    array('Mostrar tira de pel�l�cula', 'display_film_strip', 1),
    array('Nombre d\'objectes en tira de pel�l�cula', 'max_film_strip_items', 0),

	'Configuraci� de les fotos i miniatures',
	array('Qualitat per als fitxers JPEG', 'jpeg_qual', 0),
	array('M�xima ampl�ria o al�ada de les miniatures <b>*</b>', 'thumb_width', 0),
    array('Usar dimensi� ( ampl�ria o al�ada o M�xim per a les miniatures )<b>*</b>', 'thumb_use', 7),
	array('Crear fotos de grand�ria interm�dia','make_intermediate',1),
	array('M�xima ampl�ria o al�ada de les fotos de grand�ria interm�dia <b>*</b>', 'picture_width', 0),
	array('M�xima grand�ria dels fotos d\'usuaris per pujada (KB)', 'max_upl_size', 0),
	array('M�xima ampl�ria o al�ada de les fotos d\'usuaris per pujada (p�xels)', 'max_upl_width_height', 0),

	'Configuraci� d\'usuaris',
	array('Permetre el registre de nous usuaris', 'allow_user_registration', 1),
	array('Registre d\'usuaris requereix verificaci� del correu electr�nic', 'reg_requires_valid_email', 1),
	array('Permetre a dos usuaris tenir el mateix correu electr�nic', 'allow_duplicate_emails_addr', 1),
	array('Els usuaris poden tenir �lbums privats', 'allow_private_albums', 1),

	'Camps extra per a descripci� de fotos (deixar en blanc si no els uses)',
	array('Nom del camp 1', 'user_field1_name', 0),
	array('Nom del camp 2', 'user_field2_name', 0),
	array('Nom del camp 3', 'user_field3_name', 0),
	array('Nom del camp 4', 'user_field4_name', 0),

	'Configuraci� avan�ada de fotos i miniatures',
    array('Mostrar icona d\'�lbum privat a usuaris no registrats','show_private',1),
	array('Car�cters prohibits als noms de les fotos', 'forbiden_fname_char',0),
	array('Extensions de fitxer admeses a les pujades', 'allowed_file_extensions',0),
	array('M�tode per al reescalat de fotos','thumb_method',2),
	array('Cam� de la utilitat ImageMagick (per exemple /usr/bin/X11/)', 'impath', 0),
	array('Tipus de fitxers admesos (nom�s v�lids amb ImageMagick)', 'allowed_img_types',0),
	array('Ordres de linea per a ImageMagick', 'im_options', 0),
	array('Llegir dades EXIF en fitxers de tipus JPEG', 'read_exif_data', 1),
	array('Directori base dels �lbums <b>*</b>', 'fullpath', 0),
	array('Dierctori per a les fotos pujades pels usuaris <b>*</b>', 'userpics', 0),
	array('Prefix per a les fotos de grand�ria interm�dia <b>*</b>', 'normal_pfx', 0),
	array('Prefix per a les miniatures <b>*</b>', 'thumb_pfx', 0),
	array('Mode per defecte dels directoris', 'default_dir_mode', 0),
	array('Mode per defecte per a les fotos', 'default_file_mode', 0),

	'Configuraci� de cookies i Joc de Car�cters',
	array('Nom de la galeta usada per CPG', 'cookie_name', 0),
	array('Cam� de la galeta usada per CPG', 'cookie_path', 0),
	array('Joc de car�cters', 'charset', 4),

	'Configuracions d\'altres aspectes',
	array('Activar mode debug', 'debug_mode', 1),

	'<br /><div align="center">(*) Els camps marcats amb * no deuen ser canviats si ja es tenen fotos a les galeries</div><br />'
);

// ------------------------------------------------------------------------- //
// File dbinput.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Deu introduir el seu nom i un comentari',
	'com_added' => 'El seu comentari ha estat afegit',
	'alb_need_title' => 'Deus introduir un t�tol per a l\'�lbum!',
	'no_udp_needed' => 'No es requereix cap canvi',
	'alb_updated' => 'L\'�lbum ha estat actualitzat',
	'unknown_album' => 'L\'�lbum seleccionat no existeix o no tens permisos per a afegir fotos en aquest �lbum',
	'no_pic_uploaded' => 'Cap foto va ser afegida!<br /><br />Si havia seleccionat una foto per a afegir, comprovi que el servidor admet pujar fitxers...',
	'err_mkdir' => 'Error al crear el directori %s!',
	'dest_dir_ro' => 'El directori destinaci� %s no t� permisos d\'escriptura!',
	'err_move' => 'Impossible moure %s a  %s !',
	'err_fsize_too_large' => 'La grand�ria de la foto que vol inserir �s massa gran (el m�xim perm�s �s de  %s x %s)',
	'err_imgsize_too_large' => 'La grand�ria del fitxer de la foto que vol inserir �s massa gran (el m�xim perm�s �s de  %s KB)',
	'err_invalid_img' => 'El fitxer que vol inserir no �s una imatge v�lida',
	'allowed_img_types' => 'Pot inserir solament %s fotos.',
	'err_insert_pic' => 'La foto \'%s\' no pot ser donada d\'alta a l\'�lbum ',
	'upload_success' => 'La foto ha estat inserida correctament<br /><br />Ser� visible despr�s de l\'aprovaci� dels administradors.',
	'info' => 'Informaci�',
	'com_added' => 'Comentari afegit',
	'alb_updated' => '�lbum actualitzat',
	'err_comment_empty' => 'El comentari est� buit!',
	'err_invalid_fext' => 'Solament son admeses fotos amb les seg�ents extensions : <br /><br />%s.',
	'no_flood' => 'Perdoni per� �s vost� l\'autor/a de l\'�ltim comentari introdu�t per a aquesta foto<br /><br />Pot editar el comentari que ha posat si �s que vol modificar-lo',
	'redirect_msg' => 'Est� sent redirigit.<br /><br /><br />Premi \'CONTINUAR\' si la p�gina no es refresca autom�ticament',
	'upl_success' => 'La foto s\'ha afegit correctament',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Encap�alament',
	'fs_pic' => 'imatge grand�ria completa',
	'del_success' => 'esborrat correctament',
	'ns_pic' => 'imatge grand�ria normal',
	'err_del' => 'no pot ser esborrat',
	'thumb_pic' => 'miniatura',
	'comment' => 'comentari',
	'im_in_alb' => 'fotos a l\'�lbum',
	'alb_del_success' => '�lbum \'%s\' esborrat',
	'alb_mgr' => 'Organitzador d\'�lbums',
	'err_invalid_data' => 'Dades inv�lides rebudes en \'%s\'',
	'create_alb' => 'Creant l\'�lbum \'%s\'',
	'update_alb' => 'Actualitzant �lbum \'%s\' amb el t�tol \'%s\' i l\'�ndex \'%s\'',
	'del_pic' => 'Esborrar foto',
	'del_alb' => 'Esborrar �lbum',
	'del_user' => 'Esborrar usuari',
	'err_unknown_user' => 'L\'usuari seleccionat no existeix!',
	'comment_deleted' => 'El comentari ha estat esborrat',
);

// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //

if (defined('DISPLAYIMAGE_PHP')){

$lang_display_image_php = array(
	'confirm_del' => 'Est�s segur de voler ESBORRAR aquesta foto? \\nEls comentaris seran tamb� esborrats.',
	'del_pic' => 'ESBORRAR AQUESTA FOTO',
	'size' => '%s x %s p�xels',
	'views' => '%s vegades',
	'slideshow' => 'Projecci� de Diapositives',
	'stop_slideshow' => 'DETENIR PROJECCI�',
	'view_fs' => 'Premi aqui per a veure la imatge a grand�ria completa',
);

$lang_picinfo = array(
	'title' =>'Informaci� de la foto',
	'Filename' => 'Nom del fitxer',
	'Album name' => 'Nom de l\'�lbum',
	'Rating' => 'Valoraci� (%s vots)',
	'Keywords' => 'Paraules clau',
	'File Size' => 'Grand�ria del fitxer',
	'Dimensions' => 'Dimensions',
	'Displayed' => 'S\'ha vist',
	'Camera' => 'C�mera',
	'Date taken' => 'Data de la foto',
	'Aperture' => 'Obertura',
	'Exposure time' => 'Temps d\'exposici�',
	'Focal length' => 'Longitud del focus',
	'Comment' => 'Comentari',
    'addFav' => 'Afegir a Favorits',
    'addFavPhrase' => 'Favorits',
    'remFav' => 'Llevar de Favorits',
);

$lang_display_comments = array(
	'OK' => 'D\'acord',
	'edit_title' => 'Editar el comentari',
	'confirm_delete' => 'Est� segur de voler esborrar el comentari?',
	'add_your_comment' => 'Afegir un comentari',
    'name'=>'Nom',
    'comment'=>'Comentari',
	'your_name' => 'An�nim',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Premi la imatge per a tancar aquesta finestra',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Enviar foto a un amic/amiga',
	'invalid_email' => '<b>Atenci�</b> : adre�a electr�nica incorrecta!',
	'ecard_title' => 'Una foto de  %s per a tu',
	'view_ecard' => 'Si la foto no es veu correctament, premi en aquest enlla�',
	'view_more_pics' => 'Premi aqui per a veure m�s fotos!',
	'send_success' => 'La foto ha estat enviada',
	'send_failed' => 'Disculpi, per� el servidor no pot enviar la foto...',
	'from' => 'De',
	'your_name' => 'El teu nom',
	'your_email' => 'La teva adre�a electr�nica',
	'to' => 'A',
	'rcpt_name' => 'Nom del teu amic/amiga',
	'rcpt_email' => 'Adre�a electr�nica del teu amic/amiga',
	'greetings' => 'T�tol del missatge',
	'message' => 'Missatge',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Informaci�',
	'album' => '�lbum',
	'title' => 'T�tol',
	'desc' => 'Descripci�',
	'keywords' => 'Paraules Clau',
	'pic_info_str' => '%sx%s - %sKB - vista %s vegades - %s vots',
	'approve' => 'Aprovar la foto',
	'postpone_app' => 'Posposar aprovat de foto',
	'del_pic' => 'Esborrar foto',
	'reset_view_count' => 'Posar a zero el comptador de vegades que s\'ha vist',
	'reset_votes' => 'Posar a zero els vots',
	'del_comm' => 'Esborrar comentaris',
	'upl_approval' => 'Aprovar pujades',
	'edit_pics' => 'Editar fotos',
	'see_next' => 'Anar a les seg�ents fotos',
	'see_prev' => 'Anar a les fotos anteriors',
	'n_pic' => '%s foto/s',
	'n_of_pic_to_disp' => 'Nombre de fotos a mostrar',
	'apply' => 'Validar els canvis'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Nom del grup',
	'disk_quota' => 'Quota de disc',
	'can_rate' => 'Poden valorar fotos',
	'can_send_ecards' => 'Poden enviar ecards',
	'can_post_com' => 'Poden afegir comentaris',
	'can_upload' => 'Poden afegir fotos',
	'can_have_gallery' => 'Poden tenir galeries personals',
	'apply' => 'Validar els canvis',
	'create_new_group' => 'Crear nou grup',
	'del_groups' => 'Esborrar el(s) grup(s) seleccionats',
	'confirm_del' => 'Atenci�, quan esborres un grup, els usuaris que pertanyen a aquest grup seran transferits al grup \'Registered\'!\n\nDesitges continuar?',
	'title' => 'Configurar grups d\'usuaris',
	'approval_1' => 'Aprovaci� �lbum p�blic (1)',
	'approval_2' => 'Aprovaci� �lbum p�blic (2)',
	'note1' => '<b>(1)</b> Afegir fotos en un �lbum p�blic requerir� aprovaci� dels administradors',
	'note2' => '<b>(2)</b> Afegir fotos en un �lbum que pertany a l\'usuari requerir� aprovaci� dels administradors',
	'notes' => 'Notes'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Benvingut/da!'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Est� segur de voler ESBORRAR aquest �lbum ? \\nTotes les fotos i comentaris seran tamb� esborrats.',
	'delete' => 'ESBORRAR',
	'modify' => 'MODIFICAR',
	'edit_pics' => 'EDITAR FOTOS',
);

$lang_list_categories = array(
	'home' => 'Inici',
	'stat1' => '<b>[pictures]</b> fotos en <b>[albums]</b> �lbums i <b>[cat]</b> categories amb <b>[comments]</b> comentaris, vistes <b>[views]</b> vegades',
	'stat2' => '<b>[pictures]</b> fotos en <b>[albums]</b> �lbums, vistes <b>[views]</b> vegades',
	'xx_s_gallery' => 'Galeria de %s',
	'stat3' => '<b>[pictures]</b> fotos en <b>[albums]</b> �lbums amb <b>[comments]</b> comentaris, vistes <b>[views]</b> vegades'
);

$lang_list_users = array(
	'user_list' => 'Llista d\'usuaris',
	'no_user_gal' => 'No existeixen usuaris amb permisos per a tenir �lbums',
	'n_albums' => '%s �lbum(s)',
	'n_pics' => '%s foto(s)'
);

$lang_list_albums = array(
	'n_pictures' => '%s fotos',
	'last_added' => ', �ltima afegida el %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Entrada',
	'enter_login_pswd' => 'Introdueix el teu nom d\'usuari i contrasenya per a entrar',
	'username' => 'Nom d\'usuari',
	'password' => 'Contrasenya',
	'remember_me' => 'Recorda\'m',
	'welcome' => 'Benvingut/da %s ...',
	'err_login' => '*** Login incorrecte. Intenta-ho de nou ***',
	'err_already_logged_in' => 'Ja estaves validat al sistema!',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Sortir',
	'bye' => 'Fins un altra, %s ...',
	'err_not_loged_in' => 'No est�s validat al sistema!',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Modificar �lbum %s',
	'general_settings' => 'Configuraci� general',
	'alb_title' => 'T�tol de l\'�lbum',
	'alb_cat' => 'Categor�a de l\'�lbum',
	'alb_desc' => 'Descripci� de l\'�lbum',
	'alb_thumb' => 'Miniatura de l\'�lbum',
	'alb_perm' => 'Permisos per a aquest �lbum',
	'can_view' => 'Aquest �lbum pot ser vist per',
	'can_upload' => 'Els visitants poden afegir fotos',
	'can_post_comments' => 'Els visitants poden afegir comentaris',
	'can_rate' => 'Els visitants poden valorar les fotos',
	'user_gal' => 'Galeria d\'usuari',
	'no_cat' => '* Sense categoria *',
	'alb_empty' => 'L\'�lbum est� buit',
	'last_uploaded' => '�ltima foto afegida',
	'public_alb' => 'Tot el m�n (�lbum p�blic)',
	'me_only' => 'Solament jo',
	'owner_only' => 'Solament l\'amo de l\'�lbum (%s)',
	'groupp_only' => 'Membres del grup \'%s\'',
	'err_no_alb_to_modify' => 'No pots modificar cap �lbum a la base de dades.',
	'update' => 'Modificar �lbum'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Perdoni per� ja ha votat anteriorment per aquesta foto',
	'rate_ok' => 'El seu vot ha estat comptabilitzat',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
A pesar que els administradors de  {SITENAME} intentaran eliminar o editar qualsevol material desagradable tan aviat com puguin, resulta impossible revisar tots els enviaments que es realitzen. Per tant deus tenir en compte que tots els enviaments fets cap a aquesta web expressen el punt de vista i opinions dels seus autors i no els dels administradors o webmasters (excepte els afegits per ells mateixos).<br />
<br />
Vost� acorda no afegir cap material abusiu, obsc�, vulgar, escandal�s, odi�s, amena�ador, d�orientaci� sexual, o cap altre que pugui violar qualsevol llei aplicable. Vost� est� d�acord amb que el webmaster, l�administrador i els assessors de  { SITENAME } tenen el dret de llevar o de corregir qualsevol contingut en qualsevol moment si el consideren necessari. Com usuari, accedeix que qualsevol informaci� afegida ser� emmagatzemada en una base de dades. Tan mateix, aquesta informaci� no ser� divulgada a tercers sense el seu consentiment. El webmaster i l�administrador no es poden fer responsables de cap intent de destrucci� de la base de dades que pugui conduir a la p�rdua de la mateixa.<br />
<br />
Aquest lloc utilitza galetes per a emmagatzemar la informaci� al seu ordinador. Aquestes galetes serveixen per a millorar la navegaci� en aquest lloc. L�adre�a de correu electr�nic s�utilitza solament per a confirmar els seus detalls i contrasenya del registre.<br />
<br />
Prement <i>estic d�acord</i> expresses la teva conformitat amb aquestes condicions.
EOT;

$lang_register_php = array(
	'page_title' => 'Registre de nou usuari',
	'term_cond' => 'Termes i condicions',
	'i_agree' => 'Estic d\'acord',
	'submit' => 'Enviar sol�licitud de registre',
	'err_user_exists' => 'El nom d\'usuari elegit ja existeix, per favor elegeixi altre diferent',
	'err_password_mismatch' => 'Les dues contrassenyes no s�n iguals, per favor torni a introduir-les',
	'err_uname_short' => 'El nom d\'usuari deu ser de 2 car�cters de longitud com a m�nim',
	'err_password_short' => 'La contrassenya deu ser de 2 car�cters de longitud com a m�nim',
	'err_uname_pass_diff' => 'El nom d\'usuari i la contrassenya deuen ser diferents',
	'err_invalid_email' => 'L\'adre�a electr�nica no �s v�lida',
	'err_duplicate_email' => 'Un altre usuari s\'ha registrat anteriorment amb l\'adre�a de correu electr�nic subministrada',
	'enter_info' => 'Introdueixi la informaci� de registre',
	'required_info' => 'Informaci� requerida',
	'optional_info' => 'Informaci� opcional',
	'username' => 'Nom d\'usuari',
	'password' => 'Contrasenya',
	'password_again' => 'Reescriure contrasenya',
	'email' => 'Correu electr�nic',
	'location' => 'Localitat',
	'interests' => 'Interessos',
	'website' => 'P�gina web',
	'occupation' => 'Ocupaci�',
	'error' => 'ERROR',
	'confirm_email_subject' => '%s - Confirmaci� de registre',
	'information' => 'Informaci�',
	'failed_sending_email' => 'L\'email de confirmaci� de registre no ha pogut ser enviat!',
	'thank_you' => 'Gr�cies per registrar-se.<br /><br />Hem enviat un correu electr�nic amb informaci� sobre l\'activaci� del seu compte a l\'adre�a de correu que ens ha facilitat.',
	'acct_created' => 'El seu compte d\'usuari ha estat creat i ara pot accedir al sistema amb el seu nom d\'usuari i contrasenya',
	'acct_active' => 'El seu compte d\'usuari ja est� activat i ara pot accedir al sistema amb el seu nom d\'usuari i contrasenya',
	'acct_already_act' => 'El seu compte ja estava actiu!',
	'acct_act_failed' => 'Aquest compte no pot ser activat!',
	'err_unk_user' => 'L\'usuari seleccionat no existeix!',
	'x_s_profile' => 'Perfil de %s',
	'group' => 'Grup',
	'reg_date' => 'Data d\'alta',
	'disk_usage' => '�s de disc',
	'change_pass' => 'Canviar contrasenya',
	'current_pass' => 'Contrasenya actual',
	'new_pass' => 'Nova contrasenya',
	'new_pass_again' => 'Reescriure nova contrasenya',
	'err_curr_pass' => 'La contrasenya actual �s incorrecta',
	'apply_modif' => 'Desar els canvis',
	'change_pass' => 'Canviar la meva contrasenya',
	'update_success' => 'El seu perfil ha estat actualitzat',
	'pass_chg_success' => 'La seva contrasenya ha estat canviada',
	'pass_chg_error' => 'La seva contrassenya no ha estat canviada',
);

$lang_register_confirm_email = <<<EOT
Gr�cies per registrar-te a {SITE_NAME}

El seu nom d�usuari �s: "{USER_NAME}"
La seva contrassenya �s: "{PASSWORD}"

Per a acabar d�activar el seu compte, deu pr�mer sobre l�enlla� que
apareix sota o copiar-lo i pegar-lo al seu navegador d�Internet.

{ACT_LINK}

Salut.

Els administradors de {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Revisar comentaris',
	'no_comment' => 'No existeixen comentaris que mostrar',
	'n_comm_del' => '%s comentari(s) esborrat(s)',
	'n_comm_disp' => 'Nombre de comentaris a mostrar',
	'see_prev' => 'Veure l\'anterior',
	'see_next' => 'Veure el seg�ent',
	'del_comm' => 'Esborrar comentaris seleccionats',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Cercar entre totes les fotos',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Cercar noves fotos',
	'select_dir' => 'Seleccioni directori',
	'select_dir_msg' => 'Aquesta funci� li permet afegir de forma autom�tica les fotos que hagi pujat al teu servidor mitjan�ant FTP.<br /><br />Seleccioni el directori on ha pujat les seves fotos',
	'no_pic_to_add' => 'No hi ha cap foto per a afegir',
	'need_one_album' => 'Necessita almenys un �lbum per a utilitzar aquesta funci�',
	'warning' => 'Atenci�',
	'change_perm' => 'CPG no pot escriure en aquest directori, necessita canviar els seus permisos a modes 755 o 777 abans d\'intentar-ho de nou!',
	'target_album' => '<b>Col�locar les fotos del dierctori &quot;</b>%s<b>&quot; a l\'�lbum </b>%s',
	'folder' => 'Carpeta',
	'image' => 'Foto',
	'album' => '�lbum',
	'result' => 'Resultat',
	'dir_ro' => 'No es pot escriure. ',
	'dir_cant_read' => 'No es pot llegir. ',
	'insert' => 'Afegint noves fotos a la galeria',
	'list_new_pic' => 'Llistat de noves fotos',
	'insert_selected' => 'Afegir les fotos seleccionades',
	'no_pic_found' => 'No es va trobar cap foto nova',
	'be_patient' => 'Per favor, sigui pacient, CPG necessita temps per a afegir les fotos',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : significa que la foto va ser afegida sense problemes'.
				'<li><b>DP</b> : significa que la foto �s un duplicat i ja existeix a la base de dades'.
				'<li><b>PB</b> : significa que la foto no pot ser afegida, per favor comprovi la configaraci�n i els permisos dels directoris on estan les fotos'.
				'<li>Si les icones OK, DP, PB no apareixen, premi sobre la icona d\'imatge no carregada per a veure l\'error produ�t per PHP'.
				'<li>Si el navegador produeix un timeout, premi l\'icona d\'Actualitzar'.
				'</ul>',
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
                'title' => 'Expulsar Usuaris',
                'user_name' => 'Nom d\'Usuari',
                'ip_address' => 'Direcci� IP',
                'expiry' => 'Caduca (en blanc �s permanent)',
                'edit_ban' => 'Desar Canvis',
                'delete_ban' => 'Esborrar',
                'add_new' => 'Afegir Nova Expulsi�',
                'add_ban' => 'Afegir',
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'Inserir nova foto',
	'max_fsize' => 'La grand�ria m�xima de fitxer adm�s �s de  %s KB',
	'album' => '�lbum',
	'picture' => 'Foto',
	'pic_title' => 'T�tol de la foto',
	'description' => 'Descripci� de la foto',
	'keywords' => 'Paraules clau (separades per espais)',
	'err_no_alb_uploadables' => 'Perdoni per� no hi ha cap �lbum on estigui perm�s inserir noves fotos',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Administrar usuaris',
	'name_a' => 'Ascendent per nom',
	'name_d' => 'Descendent per nom',
	'group_a' => 'Ascendent per grup',
	'group_d' => 'Descendent per grup',
	'reg_a' => 'Ascendent per data d\'alta',
	'reg_d' => 'Descendent per data d\'alta',
	'pic_a' => 'Ascendent per total de fotos',
	'pic_d' => 'Descendent per total de fotos',
	'disku_a' => 'Ascendent per �s de disc',
	'disku_d' => 'Descendent per �s de disc',
	'sort_by' => 'Ordenar usuaris per',
	'err_no_users' => 'La taula d\'usuaris est� buida!',
	'err_edit_self' => 'No pot editar el seu propi perfil, usi l\'opci� \'El meu perfil d\'usuari\' per a aix�',
	'edit' => 'EDITAR',
	'delete' => 'ESBORRAR',
	'name' => 'Nom d\'usuari',
	'group' => 'Grup',
	'inactive' => 'Inactiu',
	'operations' => 'Operacions',
	'pictures' => 'Fotos',
	'disk_space' => 'Espai usat / Quota',
	'registered_on' => 'Registrat el dia',
	'u_user_on_p_pages' => '%d usuaris en %d p�gina(s)',
	'confirm_del' => 'Est� segur de voler ESBORRAR aquest usuari? \\nTotes les seves fotos i �lbums seran tamb� esborrats.',
	'mail' => 'MAIL',
	'err_unknown_user' => 'L\'usuari seleccionat no existeix!',
	'modify_user' => 'Modificar usuari',
	'notes' => 'Notes',
	'note_list' => '<li>Si no vol canviar la contrassenya actual, deixi el camp "contrasenya" buit',
	'password' => 'Contrasenya',
	'user_active' => 'L\'usuari est� actiu',
	'user_group' => 'Grup d\'usuaris',
	'user_email' => 'Correu electr�nic de l\'usuari',
	'user_web_site' => 'P�gina web de l\'usuari',
	'create_new_user' => 'Crear nou usuari',
	'user_location' => 'Localitat de l\'usuari',
	'user_interests' => 'Interessos de l\'usuari',
	'user_occupation' => 'Ocupaci� de l\'usuari',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Canviar grand�ria a les fotos',
        'what_it_does' => 'Qu� fa',
        'what_update_titles' => 'Actualitza els noms de fitxer',
        'what_delete_title' => 'Esborra els t�tols',
        'what_rebuild' => 'Torna a crear les miniatures i altres grand�ries de les fotos',
        'what_delete_originals' => 'Esborra les fotos originals reempla�ant-les amb versions de nova grand�ria',
        'file' => 'Fitxer',
        'title_set_to' => 't�tol a posar',
        'submit_form' => 'enviar',
        'updated_succesfully' => 'actualitzat amb �xit',
        'error_create' => 'ERROR al crear',
        'continue' => 'Processar m�s im�gnes',
        'main_success' => 'El fitxer %s ha estat usat com foto principal amb �xit',
        'error_rename' => 'Error reanomenant %s a %s',
        'error_not_found' => 'No es troba el fitxer %s',
        'back' => 'tornar a l\'inici',
        'thumbs_wait' => 'Actualitzant miniatures i/o grand�ries de fotos, per favor esperi...',
        'thumbs_continue_wait' => 'Continuant l\'actualitzaci� de miniatures i/o grand�ries de fotos...',
        'titles_wait' => 'Actualitzant t�tols, per favor esperi...',
        'delete_wait' => 'Esborrant t�tols, per favor esperi...',
        'replace_wait' => 'Esborrant originals i reempla�ant-los amb les fotos de nova grand�ria, per favor esperi...',
        'instruction' => 'Instruccions r�pides',
        'instruction_action' => 'Selecionar acci�',
        'instruction_parameter' => 'Posar par�metres',
        'instruction_album' => 'Seleccionar �lbum',
        'instruction_press' => 'Pr�mer %s',
        'update' => 'Actualitzar miniatures i/o grand�ries de fotos',
        'update_what' => 'Qu� deu ser actualitzat',
        'update_thumb' => 'Sols miniatures',
        'update_pic' => 'Sols grand�ries de fotos',
        'update_both' => 'Miniatures i grand�ries de fotos (ambd�s)',
        'update_number' => 'Nombre d\'imatges processades per cada clic',
        'update_option' => '(Si experimenta problemes de timeout provi a posar un nombre menor)',
        'filename_title' => 'Fitxer &rArr; T�tol de la foto',
        'filename_how' => 'Com deu ser el fitxer modificat',
        'filename_remove' => 'Llevar .jpg del final i reempla�ar _ (underscore) amb espais',
        'filename_euro' => 'Canviar 2003_11_23_13_20_20.jpg a 23/11/2003 13:20',
        'filename_us' => 'Canviar 2003_11_23_13_20_20.jpg a 11/23/2003 13:20',
        'filename_time' => 'Canviar 2003_11_23_13_20_20.jpg a 13:20',
        'delete' => 'Esborrar t�tols de fotos o fotos de grand�ria original',
        'delete_title' => 'Esborrar t�tols de fotos',
        'delete_original' => 'Esborrar fotos de grand�ria original',
        'delete_replace' => 'Esborra les imatges originals, reempla�ant-les amb unes altres de grand�ria nova',
        'select_album' => 'Seleccioni �lbum',
);

?>