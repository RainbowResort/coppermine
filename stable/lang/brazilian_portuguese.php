<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery v1.2                                            //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gr�gory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning St�verud <henning@stoverud.com>         //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

// info about translators and translated language 
$lang_translation_info = array( 
'lang_name_english' => 'Portuguese (Brazilian)',  //the name of your language in English, e.g. 'Greek' or 'Spanish' 
'lang_name_native' => 'Portugu�s (Brasileiro)', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol' 
'lang_country_code' => 'br', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es' 
'trans_name'=> 'Steve.H', //the name of the translator - can be a nickname 
'trans_email' => 'steve.spam@terra.com.br', //translator's email address (optional) 
'trans_website' => '', //translator's website (optional) 
'trans_date' => '2003-12-10', //the date the translation was created / last modified 
); 

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');
$lang_month = array('Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');

// Some common strings
$lang_yes = 'Sim';
$lang_no  = 'Nao';
$lang_back = 'VOLTAR';
$lang_continue = 'CONTINUAR';
$lang_info = 'Informa��o';
$lang_error = 'Erro';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%d de %B de %Y';
$lastcom_date_fmt =  '%d/%m/%y �s %H:%M';
$lastup_date_fmt = '%d/%m/%y';
$register_date_fmt = '%d de %B de %Y';
$lasthit_date_fmt = '%d de %B de %Y �s %I:%M %p';
$comment_date_fmt =  '%d de %B de %Y �s %R';

// For the word censor
$lang_bad_words = array('fudid*', 'viado*', 'veado*', 'put*', 'buceta', 'rola', 'filh* d* puta', 'vadia', 'biscate', 'c�', 'cuzinh*', 'caralho', 'piranha', 'vagabunda', 'fanculo', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
	'random' => 'Fotos Aleat�rias - Selecionadas automaticamente pelo servidor, mudam a cada visualiza��o.',
	'lastup' => '�ltimas Atualiza��es - As fotos mais recentes.',
	'lastcom' => 'Coment�rios das fotos.',
	'topn' => 'As fotos mais visualizadas.',
	'toprated' => 'Ranking das fotos - Votos/Qualifica��es.',
	'lasthits' => '�ltimas fotos visualizadas.',
	'search' => 'Resultado(s) da Pesquisa',
    'favpics'=> 'As fotos favoritas.', //new in cpg1.2.0
);

$lang_errors = array(
	'access_denied' => 'Voc� n�o tem permiss�o para visualizar esta p�gina!',
	'perm_denied' => 'Voc� n�o tem permiss�o para executar esta opera��o!',
	'param_missing' => 'O Script foi executado sem os par�metros necess�rios.',
	'non_exist_ap' => 'O �lbum ou foto que vocc� selecinou n�o foi encontrado!',
	'quota_exceeded' => 'O seu limite (QUOTA) de espa�o � insuficiente.<br /><br />Voc� possui [quota]KB de espa�o, suas fotos utilizam atualmente [space]KB, adicionar esta foto ir� exceder o seu limite.',
	'gd_file_type_err' => 'O GD library (script) s� permite o envio de fotos com extens�o .JPEG e .PNG!',
	'invalid_image' => 'A imagem que voc� enviou est� corrompida ou n�o p�de ser interpretada por GD library.',
	'resize_failed' => 'Imposs�vel criar miniatura ou redimensionar a imagem.',
	'no_img_to_display' => 'Sem imagem(ns) para mostrar.',
	'non_exist_cat' => 'A categoria selecionada n�o existe!',
	'orphan_cat' => 'A category has a non-existing parent, runs the category manager to correct the problem.',
	'directory_ro' => 'O diret�rio \'%s\' est� protegido, a(s) foto(s) n�o pode(m) ser deletada(s)!',
	'non_exist_comment' => 'O coment�rio selecionado n�o existe!',
	'pic_in_invalid_album' => 'Imagem em um �lbum inexistente (%s)!?',
    'banned' => 'Voc� foi BANDIDO(A) deste Site!',  //new in cpg1.2.0
    'not_with_udb' => 'This function is disabled in Coppermine because it is integrated with forum software. Either what you are trying to do is not supported in this configuration, or the function should be handled by the forum software.',  //new in cpg1.2.0
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'Ir para a lista dos �lbuns',
	'alb_list_lnk' => 'Lista dos �lbuns',
	'my_gal_title' => 'Ir para minha galeria pessoal',
	'my_gal_lnk' => 'Minha Galeria',
	'my_prof_lnk' => 'Meus dados',
	'adm_mode_title' => 'Alterar para o modo administrativo',
	'adm_mode_lnk' => 'Modo Administrativo',
	'usr_mode_title' => 'Alterar para modo Usu�rio',
	'usr_mode_lnk' => 'Modo Usu�rio',
	'upload_pic_title' => 'Enviar imagem para o �lbum',
	'upload_pic_lnk' => 'Enviar imagem',
	'register_title' => 'Criar uma conta',
	'register_lnk' => 'Registar-se',
	'login_lnk' => 'Login',
	'logout_lnk' => 'Logout',
	'lastup_lnk' => '�ltimos envios',
	'lastcom_lnk' => '�ltimos coment�rios',
	'topn_lnk' => 'Mais visualizados',
	'toprated_lnk' => 'Mais votadas',
	'search_lnk' => 'Pesquisar',
    'fav_lnk' => 'Fotos Favoritas', //new in cpg1.2.0
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Envio aprovado',
	'config_lnk' => 'Configura��o',
	'albums_lnk' => '�lbuns',
	'categories_lnk' => 'Categorias',
	'users_lnk' => 'Usu�rios',
	'groups_lnk' => 'Grupos',
	'comments_lnk' => 'Coment�rios',
	'searchnew_lnk' => 'Enviar fotos',
    'util_lnk' => 'Redimensionar fotos',  //new in cpg1.2.0
    'ban_lnk' => 'Banir usu�rio(s)',  //new in cpg1.2.0
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Criar / ordenar meus �lbuns',
	'modifyalb_lnk' => 'Modificar meus �lbuns',
	'my_prof_lnk' => 'Meus Dados',
);

$lang_cat_list = array(
	'category' => 'Categoria',
	'albums' => '�lbuns',
	'pictures' => 'Fotos',
);

$lang_album_list = array(
	'album_on_page' => 'Existem %d �lbuns, mostrados em %d p�ginas'
);

$lang_thumb_view = array(
	'date' => 'DATA', //Sort by filename and title
    'name' => 'NOME', //new in cpg1.2.0
    'title' => 'T�TUTLO', //new in cpg1.2.0
	'sort_da' => 'Mostar por data ascendente (0-9)',
	'sort_dd' => 'Mostar por data descendente (9-0)',
	'sort_na' => 'Mostar por nome ascendente (A-Z)',
	'sort_nd' => 'Mostar por nome descendente (Z-A)',
    'sort_ta' => 'Mostrar por t�tulo ascendente (A-Z)',  //new in cpg1.2.0
    'sort_td' => 'Mostrar por t�tulo descendente (Z-A)',  //new in cpg1.2.0
	'pic_on_page' => '%d fotos, mostradas em %d p�ginas',
	'user_on_page' => '%d usu�rios na(s) %d p�gina(s)'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Retornar para a p�gina de miniaturas',
	'pic_info_title' => 'Mostar/esconder informa��es da imagem',
	'slideshow_title' => 'Slideshow - Iniciar',
	'ecard_title' => 'Envie esta foto como E-Card',
	'ecard_disabled' => 'O envio de E-cards est� desabilitado.',
	'ecard_disabled_msg' => 'Voc� n�o possui permiss�o para enviar E-cards!',
	'prev_title' => 'foto anterior',
	'next_title' => 'pr�xima foto',
	'pic_pos' => 'FOTO - %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Vote/Qualifique esta foto',
	'no_votes' => '(seja a primeira pessoa a votar).',
	'rating' => '(Qualifica��o atual : %s / 5 dos %s votos)',
	'rubbish' => 'P�ssima!',
	'poor' => 'Ruim!',
	'fair' => 'Razo�vel',
	'good' => 'Muito Boa',
	'excellent' => 'Excelente!',
	'great' => 'Espetacular!',
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
	CRITICAL_ERROR => 'ERRO CR�TICO',
	'file' => 'Arquivo: ',
	'line' => 'Linha: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Arquivo: ',
	'filesize' => 'Tamanho: ',
	'dimensions' => 'Dimens�es: ',
	'date_added' => 'Enviada: '
);

$lang_get_pic_data = array(
	'n_comments' => '%s coment�rios',
	'n_views' => '%s visualiza��es',
	'n_votes' => '(%s votos)'
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
	'Exclamation' => 'Exclama��o',
	'Question' => 'D�vida',
	'Very Happy' => 'Muito Feliz',
	'Smile' => 'Sorriso',
	'Sad' => 'Triste',
	'Surprised' => 'Surpreso',
	'Shocked' => 'Chocado',
	'Confused' => 'Confuso',
	'Cool' => 'legal',
	'Laughing' => 'Sorridente',
	'Mad' => 'Louco',
	'Razz' => 'Razz',
	'Embarassed' => 'Envergonhado',
	'Crying or Very sad' => 'Muito triste',
	'Evil or Very Mad' => 'Malvado',
	'Twisted Evil' => 'Muito Malvado',
	'Rolling Eyes' => 'Rolando os olhos',
	'Wink' => 'Piscando',
	'Idea' => 'Id�ia',
	'Arrow' => 'Seta',
	'Neutral' => 'Neutro',
	'Mr. Green' => 'Mr. Green',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'Deixando o modo administrativo...',
	1 => 'Entrando no modo administrativo...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => '�lbuns precisam ter um nome !',
	'confirm_modifs' => 'Tem certeza que deseja realizar as modifica��es ?',
	'no_change' => 'Voc� n�o fez nenhuma mudan�a  !',
	'new_album' => 'Novo �lbum',
	'confirm_delete1' => 'Tem certeza de querer remover este �lbum ?',
	'confirm_delete2' => '\nTodas as imagens e coment�rios ser�o perdidos !',
	'select_first' => 'Primeiro selecione um �lbum',
	'alb_mrg' => 'Gerenciador de �lbuns',
	'my_gallery' => '* Minha Galeria *',
	'no_category' => '* Sem categoria *',
	'delete' => 'Apagar',
	'new' => 'Novo',
	'apply_modifs' => 'Aplicar modifica��es',
	'select_category' => 'Selecione uma categoria',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Parametros requeridos para \'%s\'opera��o n�o fornecida !',
	'unknown_cat' => 'A ctegoria selecionada n�o existe em nossa base de dados',
	'usergal_cat_ro' => 'A categoria do usu�rio n�o pode ser exclu�da !',
	'manage_cat' => 'Gerenciar categorias',
	'confirm_delete' => 'Voc� tem certeza que deseja EXCLUIR  esta categoria ? ',
	'category' => 'Categoria',
	'operations' => 'Opera��es',
	'move_into' => 'Mover em',
	'update_create' => 'Atualizar/Criar categoria',
	'parent_cat' => 'Categoria parente',
	'cat_title' => 'T�tulo da categoria',
	'cat_desc' => 'Descri��o da categoria'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Configura��o',
	'restore_cfg' => 'Restaurar configura��es originais.',
	'save_cfg' => 'Salvar nova configura��o.',
	'notes' => 'Anota��es.',
	'info' => 'Informa��o.',
	'upd_success' => 'Configura��o do cat�logo atualizada.',
	'restore_success' => 'Configura��o original restaurada!',
	'name_a' => 'Nome ascendente.',
	'name_d' => 'Nome descendente.',
    'title_a' => 'Tit�lo ascendente.',  //new in cpg1.2.0
    'title_d' => 'T�tulo descendente.',  //new in cpg1.2.0
	'date_a' => 'Data Ascendente',
	'date_d' => 'Data descendente',
    'th_any' => 'Max Aspect',
    'th_ht' => 'Altura',
    'th_wd' => 'Largura',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'General settings',
	array('Gallery name', 'gallery_name', 0),
	array('Gallery description', 'gallery_description', 0),
	array('Gallery administrator email', 'gallery_admin_email', 0),
	array('Target address for the \'See more pictures\' link in e-cards', 'ecards_more_pic_target', 0),
	array('Language', 'lang', 5),
	array('Theme', 'theme', 6),

	'Album list view',
	array('Width of the main table (pixels or %)', 'main_table_width', 0),
	array('Number of levels of categories to display', 'subcat_level', 0),
	array('Number of albums to display', 'albums_per_page', 0),
	array('Number of columns for the album list', 'album_list_cols', 0),
	array('Size of thumbnails in pixels', 'alb_list_thumb_size', 0),
	array('The content of the main page', 'main_page_layout', 0),
        array('Show first level album thumbnails in categories','first_level',1),  //new in cpg1.2.0

	'Thumbnail view',
	array('Number of columns on thumbnail page', 'thumbcols', 0),
	array('Number of rows on thumbnail page', 'thumbrows', 0),
	array('Maximum number of tabs to display', 'max_tabs', 0),
	array('Display picture caption (in addition to title) below the thumbnail', 'caption_in_thumbview', 1),
	array('Display number of comments below the thumbnail', 'display_comment_count', 1),
	array('Default sort order for pictures', 'default_sort_order', 3),
	array('Minimum number of votes for a picture to appear in the \'top-rated\' list', 'min_votes_for_rating', 0),

	'Image view &amp; Comment settings',
	array('Width of the table for picture display (pixels or %)', 'picture_table_width', 0),
	array('Picture information are visible by default', 'display_pic_info', 1),
	array('Filter bad words in comments', 'filter_bad_words', 1),
	array('Allow smiles in comments', 'enable_smilies', 1),
	array('Max length for an image description', 'max_img_desc_length', 0),
	array('Max number of characters in a word', 'max_com_wlength', 0),
	array('Max number of lines in a comment', 'max_com_lines', 0),
	array('Maximum length of a comment', 'max_com_size', 0),
        array('Show film strip', 'display_film_strip', 1),  //new in cpg1.2.0
        array('Number of items in film strip', 'max_film_strip_items', 0), 

	'Pictures and thumbnails settings',
	array('Quality for JPEG files', 'jpeg_qual', 0),
        array('Max dimension of a thumbnail <b>*</b>', 'thumb_width', 0),  //new in cpg1.2.0
        array('Use dimension ( width or height or Max aspect for thumbnail )<b>*</b>', 'thumb_use', 7),  //new in cpg1.2.0
	array('Create intermediate pictures','make_intermediate',1),
	array('Max width or height of an intermediate picture <b>*</b>', 'picture_width', 0),
	array('Max size for uploaded pictures (KB)', 'max_upl_size', 0),
	array('Max width or height for uploaded pictures (pixels)', 'max_upl_width_height', 0),

	'User settings',
	array('Allow new user registrations', 'allow_user_registration', 1),
	array('User registration requires email verification', 'reg_requires_valid_email', 1),
	array('Allow two users to have the same email address', 'allow_duplicate_emails_addr', 1),
	array('Users can can have private albums', 'allow_private_albums', 1),

	'Custom fields for image description (leave blank if unused)',
	array('Field 1 name', 'user_field1_name', 0),
	array('Field 2 name', 'user_field2_name', 0),
	array('Field 3 name', 'user_field3_name', 0),
	array('Field 4 name', 'user_field4_name', 0),

	'Pictures and thumbnails advanced settings',
        array('Show private album Icon to unlogged user','show_private',1),  //new in cpg1.2.0
	array('Characters forbidden in filenames', 'forbiden_fname_char',0),
	array('Accepted file extensions for uploaded pictures', 'allowed_file_extensions',0),
	array('Method for resizing images','thumb_method',2),
	array('Path to ImageMagick \'convert\' utility (example /usr/bin/X11/)', 'impath', 0),
	array('Allowed image types (only valid for ImageMagick)', 'allowed_img_types',0),
	array('Command line options for ImageMagick', 'im_options', 0),
	array('Read EXIF data in JPEG files', 'read_exif_data', 1),
	array('The album directory <b>*</b>', 'fullpath', 0),
	array('The directory for user pictures <b>*</b>', 'userpics', 0),
	array('The prefix for intermediate pictures <b>*</b>', 'normal_pfx', 0),
	array('The prefix for thumbnails <b>*</b>', 'thumb_pfx', 0),
	array('Default mode for directories', 'default_dir_mode', 0),
	array('Default mode for pictures', 'default_file_mode', 0),

	'Cookies &amp; Charset settings',
	array('Name of the cookie used by the script', 'cookie_name', 0),
	array('Path of the cookie used by the script', 'cookie_path', 0),
	array('Character encoding', 'charset', 4),

	'Miscellaneous settings',
	array('Enable debug mode', 'debug_mode', 1),

	'<br /><div align="center">(*) Fields marked with * must not be changed if you already have pictures in your gallery</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Voc� n�o preencheu o seu nome!',
	'com_added' => 'Sua conta foi criada!',
	'alb_need_title' => 'Voc� deve definir um nome para o �lbum!',
	'no_udp_needed' => 'Atualiza��o n�o necess�ria.',
	'alb_updated' => 'O �lbum foi atualizado!',
	'unknown_album' => 'O �lbum selecionado n�o existe ou voc� n�o tem permiss�o para enviar imagens para ele',
	'no_pic_uploaded' => 'Nenhuma imagem enviada !<br /><br />Se voc� realmente selecionaou uma imagem para enviar, verifique se o servidor permite envios.',
	'err_mkdir' => 'Falha ao criar o diret�rio %s !',
	'dest_dir_ro' => 'Diret�rio de destino %s n�o pode ser gravado pelo script !',
	'err_move' => 'Imposs�vel mover %s para %s !',
	'err_fsize_too_large' => 'A imagem que voc� est� tentando enviar � muito grande (m�ximo permitido %s x %s) !',
	'err_imgsize_too_large' => 'O tamanho da imagem � maior que o permitido (m�ximo permitido %s KB) !',
	'err_invalid_img' => 'O arquivo que voc� est� tentando enviar n�o � um arquivo de imagem v�lido !',
	'allowed_img_types' => 'Voc� s� pode enviar %s imagens.',
	'err_insert_pic' => 'A imagem \'%s\' n�o pode ser inserida no �lbum ',
	'upload_success' => 'Sua imagem foi enviada com sucesso<br /><br />Por�m s� ser� vis�vel ap�s a aprova��o do Administrador.',
	'info' => 'Informa��o',
	'com_added' => 'Coment�rio adicionado com sucesso!',
	'alb_updated' => '�lbum atualizado',
	'err_comment_empty' => 'Seu coment�rio est� vazio!',
	'err_invalid_fext' => 'Somente os arquivos com as seguines exten��es s�o permitidos : <br /><br />%s.',
	'no_flood' => 'Desculpe mas voc� � o �ltimo autor a enviar um coment�rio<br /><br />Edite o coment�rio se deseja alter�-lo',
	'redirect_msg' => 'Voc� est� sendo redirecionado.<br /><br /><br />Clique \'CONTINUE\' se a p�gina n�o se atualizar automaticamente',
	'upl_success' => 'Sua imagem foi adicionada com sucesso',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Sub-T�tulo',
	'fs_pic' => 'tamanho total da imagem',
	'del_success' => 'removido com sucesso',
	'ns_pic' => 'tamanho normal da imagem',
	'err_del' => 'n�o pode ser esclu�do',
	'thumb_pic' => 'miniatura',
	'comment' => 'coment�rio',
	'im_in_alb' => 'imagem no �lbum',
	'alb_del_success' => '�lbum \'%s\' REMOVIDO',
	'alb_mgr' => 'Gerenciador de �lbuns',
	'err_invalid_data' => 'Dados recebidos inv�lidos \'%s\'',
	'create_alb' => 'Criando �lbuns \'%s\'',
	'update_alb' => 'Atualizando �lbuns \'%s\' t�tulo \'%s\' �ndice \'%s\'',
	'del_pic' => 'Remover imagem',
	'del_alb' => 'Remover �lbum',
	'del_user' => 'Remover usu�rio',
	'err_unknown_user' => 'O usu�rio selecionado n�o existe !',
	'comment_deleted' => 'O coment�rio foi removido com sucesso',
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
	'confirm_del' => 'Tem certeza que deseja EXCLUIR  esta imagem ? \\nComent�rios vinculados tamb�m ser�o exclu�dos.',
	'del_pic' => 'DELETAR ESTA FOTO',
	'size' => '%s x %s pixels',
	'views' => '%s vezes',
	'slideshow' => 'Slideshow',
	'stop_slideshow' => 'PARAR SLIDESHOW',
	'view_fs' => 'Clique aqui para ampliar a foto.',
);

$lang_picinfo = array(
	'title' =>'INFORMA��ES SOBRE ESTA FOTO',
	'Filename' => 'Nome do arquivo',
	'Album name' => '�lbum em que se encontra',
	'Rating' => 'Classifica��o (%s votos)',
	'Keywords' => 'Palavras-chave',
	'File Size' => 'Tamanho da foto (Kbytes)',
	'Dimensions' => 'Dimens�es (tamanho)',
	'Displayed' => 'Esta foto j� foi visualizada',
	'Camera' => 'Camera:',
	'Date taken' => 'Data da foto:',
	'Aperture' => 'Abertura:',
	'Exposure time' => 'Tempo de exposi��o:',
	'Focal length' => 'Largura focal:',
	'Comment' => 'Coment�rios:',
    'addFav' => 'Adicionar � Favoritas',  //new in cpg1.2.0
    'addFavPhrase' => 'Favoritas',  //new in cpg1.2.0
    'remFav' => 'Remover das Favoritas',  //new in cpg1.2.0
);

$lang_display_comments = array(
	'OK' => 'Adicionar',
	'edit_title' => 'Editar este coment�rio.',
	'confirm_delete' => 'Tem certeza que deseja REMOVER este coment�rio?',
	'add_your_comment' => 'Adicione o seu coment�rio',
    'name'=>'Nome',  //new in cpg1.2.0
    'comment'=>'Coment�rio',  //new in cpg1.2.0
	'your_name' => 'Seu nome',
);

$lang_fullsize_popup = array( 
        'click_to_close' => 'Clique sobre a foto para fechar esta janela.',  //new in cpg1.2.0
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Enviar um E-card.',
	'invalid_email' => '<b>Aviso</b> : endere�o eletr�nico (e-mail) inv�lido!',
	'ecard_title' => 'E-Card do %s para voc�',
	'view_ecard' => 'Clique aqui caso voc� n�o esteja conseguindo visualizar a foto.',
	'view_more_pics' => 'Clique aqui para ver mais fotos!',
	'send_success' => 'Seu E-card foi enviado com sucesso!',
	'send_failed' => 'Desculpe, mas o servidor n�o p�de enviar seu E-card.',
	'from' => 'Remetente',
	'your_name' => 'Seu nome:',
	'your_email' => 'Seu e-mail:',
	'to' => 'Para',
	'rcpt_name' => 'Destinat�rio:',
	'rcpt_email' => 'E-mail do destinat�rio:',
	'greetings' => 'Assunto:',
	'message' => 'Mensagem',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Picture&nbsp;info',
	'album' => '�lbum',
	'title' => 'T�tulo',
	'desc' => 'Descri��o',
	'keywords' => 'Palavras-chave',
	'pic_info_str' => '%sx%s - %sKB - %s views - %s votes',
	'approve' => 'Aprovar fotos',
	'postpone_app' => 'Postpone approval',
	'del_pic' => 'Apagar imagem',
	'reset_view_count' => 'Zerar contador',
	'reset_votes' => 'Zerar votos',
	'del_comm' => 'Excluir coment�rios',
	'upl_approval' => 'Aprovar envio',
	'edit_pics' => 'Editar fotos',
	'see_next' => 'Ver pr�ximas fotos',
	'see_prev' => 'Ver fotos anteriores',
	'n_pic' => '%s imagens',
	'n_of_pic_to_disp' => 'N�mero de fotos a mostrar',
	'apply' => 'Aplicar modifica��es'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Nome do Grupo',
	'disk_quota' => 'Quota de disco',
	'can_rate' => 'Pode avaliar imagens',
	'can_send_ecards' => 'Pode enviar e-cards',
	'can_post_com' => 'Pode enviar coment�rios',
	'can_upload' => 'Pode enviar imagens',
	'can_have_gallery' => 'Pode ter uma galeria pessoal',
	'apply' => 'Aplicar modifica��es',
	'create_new_group' => 'Criar novo grupo',
	'del_groups' => 'Apagar grupo(s) selecionado(s)',
	'confirm_del' => 'CUIDADO: Ao remover um grupo seu conte�do ser� transferido para \'Registered\' !\n\nquer continuar ?',
	'title' => 'Gerenciar grupos',
	'approval_1' => 'Aprova��o p�blica (1)',
	'approval_2' => 'Aaprova��o privada (2)',
	'note1' => '<b>(1)</b> Envios para um �lbum p�blico requerer aprova��o do administrador',
	'note2' => '<b>(2)</b> Envios requerem aprova��o do administrador',
	'notes' => 'Anota��es'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Bem-vindo(a)!'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Tem certeza que deseja EXCLUIR este �lbum ? \\nTodas as imagens e coment�rios ser�o exclu�dos.',
	'delete' => 'EXCLUIR',
	'modify' => 'PROPRIEDADES',
	'edit_pics' => 'EDITAR IMAGENS',
);

$lang_list_categories = array(
	'home' => 'Home',
	'stat1' => '<b>Stat�sticas:</b> Existem <b>[pictures]</b> fotos, <b>[albums]</b> �lbuns e <b>[cat]</b> categorias com <b>[comments]</b> coment�rios, totalizando <b>[views]</b> visualiza��es.',
	'stat2' => '<b>[pictures]</b> imagens em <b>[albums]</b> �lbuns vistos <b>[views]</b> vezes',
	'xx_s_gallery' => '%s\'s Galeria',
	'stat3' => '<b>[pictures]</b> fotos <b>[albums]</b> �lbuns <b>[comments]</b> coment�rios <b>[views]</b> visualiza��es'
);

$lang_list_users = array(
	'user_list' => 'Lista de usu�rios',
	'no_user_gal' => 'Nenhum usu�rio permitido a ter �lbuns',
	'n_albums' => '%s �lbum(s)',
	'n_pics' => '%s imagem(s)'
);

$lang_list_albums = array(
	'n_pictures' => 'Possui %s fotos',
	'last_added' => ', atualizado em %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Login',
	'enter_login_pswd' => 'Insira seu nome de usu�rio e senha para entrar.',
	'username' => 'Usu�rio',
	'password' => 'Senha',
	'remember_me' => 'Lembrar',
	'welcome' => 'Bem-Vindo(a) %s !',
	'err_login' => '*** ERRO na Autentica��o! Verifique os dados fornecidos e tente novamente! ***',
	'err_already_logged_in' => 'Voc� j� est� Logado.',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Logout',
	'bye' => 'LOGOUT Efetuado com sucesso, at� logo %s .',
	'err_not_loged_in' => 'Voc� nem est� Logado!',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Atualizar �lbum %s',
	'general_settings' => 'Configura��es gerais',
	'alb_title' => 'T�tulo do �lbum',
	'alb_cat' => 'Categoria do �lbum',
	'alb_desc' => 'Descri��o do �lbum',
	'alb_thumb' => 'Miniatura do �lbum',
	'alb_perm' => 'Permiss�es para este �lbum',
	'can_view' => '�lbum pode ser visto por',
	'can_upload' => 'Visitantes podem enviar imagens',
	'can_post_comments' => 'Visitantes podem enviar coment�rios',
	'can_rate' => 'Visitantes podem avaliar imagens',
	'user_gal' => 'Galeria do Usu�rio',
	'no_cat' => '* Sem categoria *',
	'alb_empty' => '�lbum vazio',
	'last_uploaded' => '�ltimo envio',
	'public_alb' => 'Todos (album p�blico)',
	'me_only' => 'Apenas eu',
	'owner_only' => 'Propriet�rio (%s) apenas',
	'groupp_only' => 'Membros do  grupo\'%s\' ',
	'err_no_alb_to_modify' => 'Nenhum album que voc� pode modificar na base de dados .',
	'update' => 'Atualizar �lbum'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Voc� j� votou nesta foto! (Apenas 1 voto por foto).',
	'rate_ok' => 'Seu voto foi registrado!',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT

Mesmo com todo o esfor�o e aten��o dos administradores/webmasters do { SITE_NAME } para eliminarem ou editarem qualquer tipo de material desagrad�vel o mais r�pido poss�vel, � impossivel verificar todos os envios realizados. Em raz�o disto, todo o conte�do do { SITE_NAME } s�o de total responsabilidade de seus autores (quem enviou) e n�o dos administradores/webmasters (salvo se enviados por eles mesmos).
<br />
Voc� concorda n�o adicionar/enviar nenhum tipo de material abusivo, obsceno, vulgar, escandaloso, amea�ador, pornogr�fico e/ou de orienta��o sexual, ou qualquer outro tipo de material pun�vel por Lei. Concorda que os administradores/webmasters do { SITE_NAME } t�m o direito de eliminar, alterar ou corrigir qualquer conte�do � qualquer momento, caso considerem o mesmo abusivo. Como usu�rio, concorda que todas as suas infmora��es ser�o armazenadas em uma base de dados, a qual n�o ser� negociada, trocada ou fornecida � terceiros sob hip�tese alguma. Os administradores/webmasters deste site, n�o s�o respons�veis por eventuais falhas/ataques do sistema que venham a ocasionar qualquer tipo de perda.
<br />
Este site utiliza cookies para armazenar informa��es em seu processador, estes cookies servem para melhorar a sua navega��o. O seu endere�o de e-mail ser� utilizado apenas para confirma��o de dados como Nome de Usu�rio e Senha. Voc� dever� utilizar o { SITE_NAME } como um privil�gio e n�o como um direito.
<br />
Ao optar por 'EU ACEITO' voc� estar� concordando com todos os termos acima citados.
EOT;

$lang_register_php = array(
	'page_title' => 'REGISTRO DE USU�RIO',
	'term_cond' => 'Termos e condi��es',
	'i_agree' => 'EU ACEITO',
	'submit' => 'enviar registro',
	'err_user_exists' => 'Usu�rio j� existente, escolha outro usu�rio.',
	'err_password_mismatch' => 'As senhas digitas n�o conferem. Confira-as novamente.',
	'err_uname_short' => 'O nome de usu�rio deve conter no m�nimo 2 caracteres!',
	'err_password_short' => 'Sua senha deve conter no m�nimo 2 caracteres!',
	'err_uname_pass_diff' => 'O nome de usu�rio e senha devem ser DIFERENTES!',
	'err_invalid_email' => 'E-Mail Inv�lido!',
	'err_duplicate_email' => 'O e-mail informado j� est� sendo utilizado! Informe outro E-Mail.',
	'enter_info' => 'Entre com as informa��es de registro',
	'required_info' => 'Informa��o Obrigat�ria.',
	'optional_info' => 'Informa��o Opcional.',
	'username' => 'Usu�rio',
	'password' => 'Senha',
	'password_again' => 'Repita a senha',
	'email' => 'E-mail',
	'location' => 'Endere�o',
	'interests' => 'Interesses',
	'website' => 'Home-page',
	'occupation' => 'Profiss�o',
	'error' => 'ERRO',
	'confirm_email_subject' => '%s - CONFIRMA��O DE REGISTRO',
	'information' => 'Informa��o',
	'failed_sending_email' => 'O e-mail de confirma��o de registro n�o p�de ser enviado !',
	'thank_you' => 'Obrigado pr se registrar.<br /><br />As informa��es para finalizar seu registro foram enviadas para seu e-mail. Verifique agora ou aguarde uns instantes.',
	'acct_created' => 'Sua conta foi criada. Para acessar meu �lbum virtual voc� deve fornecer seu nome de usu�rio e sua senha',
	'acct_active' => 'Sua conta j� est� ativa. Entre com seu nome de usu�rio e senha para acessar os dados do cat�logo',
	'acct_already_act' => 'Sua conta j� est� ativada!',
	'acct_act_failed' => 'Esta conta n�o foi ativada ainda, cheque o seu e-mail primeiro!',
	'err_unk_user' => 'Usu�rio selecionado n�o existe !',
	'x_s_profile' => '%s\'s perfil',
	'group' => 'Grupo',
	'reg_date' => 'PArticipante',
	'disk_usage' => 'Uso do disco',
	'change_pass' => 'Alterar senha',
	'current_pass' => 'Senha atual',
	'new_pass' => 'Nova senha',
	'new_pass_again' => 'Nova senha de novo',
	'err_curr_pass' => 'Senha atual INCORRETA',
	'apply_modif' => 'Aplicar modifica��es',
	'change_pass' => 'Alterar minha senha',
	'update_success' => 'Seus dados foram atualizadsos',
	'pass_chg_success' => 'Sua senha foi alterada',
	'pass_chg_error' => 'Sua senha n�o foi alterada',
);

$lang_register_confirm_email = <<<EOT
Obrigado por registrar-se no {SITE_NAME}

Guarde este e-mail para futura refer�ncias.

Seu usu�rio � : "{USER_NAME}"
Sua senha � : "{PASSWORD}"

Clique no link abaixo ou copie e cole no seu Navegador para acessar o meu �lbum virtual.

{ACT_LINK}

Seja bem-vindo(a) e divirta-se!

Administrador
{SITE_NAME}

Aten��o: Este � um e-mail autom�tico, por favor, N�O RESPONDA.

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Revisar coment�rios',
	'no_comment' => 'N�o h� coment�rios para se revisar',
	'n_comm_del' => '%s coment�rio(s) removido',
	'n_comm_disp' => 'N�mero de coment�rios ',
	'see_prev' => 'Ver anterior',
	'see_next' => 'Ver pr�ximo',
	'del_comm' => 'Excluir os coment�rios selecionados',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Pesquisar na cole��o de fotos',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Pesquisar novas imagens',
	'select_dir' => 'Selecionar diret�rio',
	'select_dir_msg' => 'Esta fun��o lhe permite enviar diversas imagens ao mesmo tempo.<br /><br />Selecione o diret�rio das imagens',
	'no_pic_to_add' => 'N�o h� imagens para enviar',
	'need_one_album' => 'Voc� precisa ter pelo menos um �lbum para usar esta fun��o',
	'warning' => 'CUIDADO',
	'change_perm' => 'O script n�o pode gravar neste diret�rio que deve possuir permiss�o 755 ou 777 !',
	'target_album' => '<b>Colocar imagens do &quot;</b>%s<b>&quot; em </b>%s',
	'folder' => 'Pasta',
	'image' => 'Imagem',
	'album' => '�lbum',
	'result' => 'Resultado',
	'dir_ro' => 'N�o grav�vel. ',
	'dir_cant_read' => 'N�o pode ser lido. ',
	'insert' => 'Adicionando novas fotos � galeria',
	'list_new_pic' => 'Lista das novas fotos',
	'insert_selected' => 'Inserir fotos selecionadas',
	'no_pic_found' => 'N�o h� novas foto',
	'be_patient' => 'Agurade, isto pode levar alguns instantes',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : Significa que a foto foi enviada com sucesso'.
				'<li><b>DP</b> : Significa que a foto j� existe (o mesmo nome de arquivo)'.
				'<li><b>PB</b> : significa que a foto n�o p�de ser enviada. Verifique suas permiss�es.'.
				'<li>Se o OK, DP, PB \'signs\' n�o aparecem, clique na imagem com problema para receber a mensagem do erro'.
				'<li>Se voc� receber a mensagem TIMEOUT, recarrege/reload a p�gina'.
				'</ul>',
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void


// ------------------------------------------------------------------------- // 
// File banning.php  //new in cpg1.2.0
// ------------------------------------------------------------------------- // 

if (defined('BANNING_PHP')) $lang_banning_php = array( 
                'title' => 'Banir usu�rio(s)', 
                'user_name' => 'Username', 
                'ip_address' => 'Endere�o IP', 
                'expiry' => 'Tempor�rio (deixado em branco ser� considerado BAN Permanente)', 
                'edit_ban' => 'Salvar', 
                'delete_ban' => 'Apagar', 
                'add_new' => 'Adicionar um novo BAN', 
                'add_ban' => 'Adicionar', 
); 

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'Envio de Foto',
	'max_fsize' => 'Tamanho m�ximo da foto permitido: %s KB',
	'album' => '�lbum',
	'picture' => 'Imagem',
	'pic_title' => 'T�tulo',
	'description' => 'Descri��o',
	'keywords' => 'Palavras-chave (separar somente por espa�os)',
	'err_no_alb_uploadables' => 'Desculpe, mas voc� n�o est� autorizado(a) a enviar fotos para este �lbum',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Gerenciar usu�rios',
	'name_a' => 'Nome Ascendente',
	'name_d' => 'Nome Descendente',
	'group_a' => 'Grupo Ascendente',
	'group_d' => 'Grupo Descendente',
	'reg_a' => 'Data de registro Ascendente',
	'reg_d' => 'Data de registro Descendente',
	'pic_a' => 'Contagem de imagens ascendente',
	'pic_d' => 'Constagem de imagem descendente',
	'disku_a' => 'Uso de disco ascendente',
	'disku_d' => 'Uso de disco descendente',
	'sort_by' => 'Listar usu�rios por',
	'err_no_users' => 'Tabela de usu�rios est� vazia !',
	'err_edit_self' => 'Voc� n�o pode alterar os dados \'My profile\' ',
	'edit' => 'EDITAR',
	'delete' => 'EXCLUIR',
	'name' => 'Usu�rio',
	'group' => 'Grupo',
	'inactive' => 'Inativo',
	'operations' => 'Opera��es',
	'pictures' => 'Imagens',
	'disk_space' => 'Espa�o usado / Quota',
	'registered_on' => 'Registrado em',
	'u_user_on_p_pages' => '%d usu�rios em %d p�gina(s)',
	'confirm_del' => 'Tem certeza que quer EXCLUIR este usu�rio ? \\nTodas as imagens e �lbuns dele ser�o removidas.',
	'mail' => 'MAIL',
	'err_unknown_user' => 'Usu�rio selecionado n�o existe !',
	'modify_user' => 'Modificar usu�rio',
	'notes' => 'Notas',
	'note_list' => '<li>Se voc� n�o deseja alterar sua senha, deixe o campo em branco',
	'password' => 'Senha',
	'user_active' => 'Usu�rio � ativo',
	'user_group' => 'GBrupo de usu�rios',
	'user_email' => 'E-mail do usu�rio',
	'user_web_site' => 'Site do usu�rio',
	'create_new_user' => 'Criar novo usu�rio',
	'user_location' => 'Endere�o',
	'user_interests' => 'Interesse',
	'user_occupation' => 'Ocupa��o',
);

// ------------------------------------------------------------------------- // 
// File util.php  //new in cpg1.2.0
// ------------------------------------------------------------------------- // 

if (defined('UTIL_PHP')) $lang_util_php = array( 
        'title' => 'Resize pictures', 
        'what_it_does' => 'What it does', 
        'what_update_titles' => 'Updates titles from filename', 
        'what_delete_title' => 'Deletes titles', 
        'what_rebuild' => 'Rebuilds thumbnails and resized photos', 
        'what_delete_originals' => 'Deletes original sized photos replacing them with the sized version', 
        'file' => 'File', 
        'title_set_to' => 'title set to', 
        'submit_form' => 'submit', 
        'updated_succesfully' => 'updated succesfully', 
        'error_create' => 'ERROR creating', 
        'continue' => 'Process more images', 
        'main_success' => 'The file %s was successfully used as main picture', 
        'error_rename' => 'Error renaming %s to %s', 
        'error_not_found' => 'The file %s was not found', 
        'back' => 'back to main', 
        'thumbs_wait' => 'Updating thumbnails and/or resized images, please wait...', 
        'thumbs_continue_wait' => 'Continuing to update thumbnails and/or resized images...', 
        'titles_wait' => 'Updating titles, please wait...', 
        'delete_wait' => 'Deleting titles, please wait...', 
        'replace_wait' => 'Deleting originals and replacing them with resized images, please wait..', 
        'instruction' => 'Quick instructions', 
        'instruction_action' => 'Select action', 
        'instruction_parameter' => 'Set parameters', 
        'instruction_album' => 'Select album', 
        'instruction_press' => 'Press %s', 
        'update' => 'Update thumbs and/or resized photos', 
        'update_what' => 'What should be updated', 
        'update_thumb' => 'Only thumbnails', 
        'update_pic' => 'Only resized pictures', 
        'update_both' => 'Both thumbnails and resized pictures', 
        'update_number' => 'Number of processed images per click', 
        'update_option' => '(Try setting this option lower if you experience timeout problems)', 
        'filename_title' => 'Filename ? Picture title', 
        'filename_how' => 'How should the filename be modified', 
        'filename_remove' => 'Remove the .jpg ending and replace _ (underscore) with spaces', 
        'filename_euro' => 'Change 2003_11_23_13_20_20.jpg to 23/11/2003 13:20', 
        'filename_us' => 'Change 2003_11_23_13_20_20.jpg to 11/23/2003 13:20', 
        'filename_time' => 'Change 2003_11_23_13_20_20.jpg to 13:20', 
        'delete' => 'Delete picture titles or original size photos', 
        'delete_title' => 'Delete picture titles', 
        'delete_original' => 'Delete original size photos', 
        'delete_replace' => 'Deletes the original images replacing them with the sized versions', 
        'select_album' => 'Select album', 
); 

?>