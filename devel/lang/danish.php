<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery                                                 //
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

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('S�n', 'Man', 'Tir', 'Ons', 'Tor', 'Fre', 'L�r');
$lang_month = array('Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec');

// Some common strings
$lang_yes = 'Ja';
$lang_no  = 'Nej';
$lang_back = 'TILBAGE';
$lang_continue = 'FORTS�T';
$lang_info = 'Information';
$lang_error = 'Fejl';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%d. %B, %Y';
$lastcom_date_fmt =  '%d/%b/%y kl. %H:%M';
$lastup_date_fmt = '%d. %B, %Y';
$register_date_fmt = '%d. %B, %Y';
$lasthit_date_fmt = '%d. %B, %Y kl. %R';
$comment_date_fmt =  '%d. %B, %Y kl. %R';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
	'random' => 'Tilf�ldige billeder',
	'lastup' => 'Sidste tilf�jelser',
	'lastcom' => 'Sidste komentarer',
	'topn' => 'Mest viste',
	'toprated' => 'Top karakter',
	'lasthits' => 'Sidst viste',
	'search' => 'S�ge resultat'
);

$lang_errors = array(
	'access_denied' => 'Du har ikke tilladelse til at se denne side.',
	'perm_denied' => 'Du har ikke tilladelse til at udf�re denne handling.',
	'param_missing' => 'Script kaldet uden de n�dvendige parater(er).',
	'non_exist_ap' => 'Det valgte album/billede eksister ikke !',
	'quota_exceeded' => 'Disk m�ngden overskredet<br /><br />Du har palds til en m�ngde af [quota]K, Dine billeder bruger aktuelt [space]K, tilf�jelse af dette billede med medf�re en overskridelse af din tilladte m�ngde.',
	'gd_file_type_err' => 'N�r der anvendes GD billedeteknink, er tilladete typer kun JPEG og PNG.',
	'invalid_image' => 'Billedet som du har uploadet er defekt eller kan ikke bruges ved GD billedeteknik',
	'resize_failed' => 'Ej muligt at oprette minibillede eller reduceret billede st�rrelse.',
	'no_img_to_display' => 'Intet billede at vise',
	'non_exist_cat' => 'Den valgte kategori findes ikke',
	'orphan_cat' => 'En kategori har ikke ikke et tilh�rsforhold, k�r kategori manager for at rette problemet.',
	'directory_ro' => 'Mappen \'%s\' er skrivebeskyttet,billeder kan ikke slettes',
	'non_exist_comment' => 'Den valgte kommentar findes ikke.',
	'pic_in_invalid_album' => 'Billede er i et ikke eksisterende album (%s)!?'
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'G� til albumslisten',
	'alb_list_lnk' => 'Albumsliste',
	'my_gal_title' => 'G� til personligt galleri',
	'my_gal_lnk' => 'Mit galleri',
	'my_prof_lnk' => 'Min profil',
	'adm_mode_title' => 'Skift til admin mode',
	'adm_mode_lnk' => 'Admin mode',
	'usr_mode_title' => 'Skift til bruger mode',
	'usr_mode_lnk' => 'Bruger mode',
	'upload_pic_title' => 'Upload et billede til album',
	'upload_pic_lnk' => 'Upload billede',
	'register_title' => 'Opret en konto',
	'register_lnk' => 'Registrer',
	'login_lnk' => 'Logind',
	'logout_lnk' => 'Logud',
	'lastup_lnk' => 'Sidste uploads',
	'lastcom_lnk' => 'Sidste kommentar',
	'topn_lnk' => 'Mest viste',
	'toprated_lnk' => 'Top karakter',
	'search_lnk' => 'S�g',
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Upload til godkendelse',
	'config_lnk' => 'Konfiguration',
	'albums_lnk' => 'Albums',
	'categories_lnk' => 'Kategorier',
	'users_lnk' => 'Bruger',
	'groups_lnk' => 'Grupper',
	'comments_lnk' => 'Kommentarer',
	'searchnew_lnk' => 'Masse tilf�j billede',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Opret / ordne albums',
	'modifyalb_lnk' => 'ret i mit album',
	'my_prof_lnk' => 'Min profil',
);

$lang_cat_list = array(
	'category' => 'Kategori',
	'albums' => 'Albums',
	'pictures' => 'Billeder',
);

$lang_album_list = array(
	'album_on_page' => '%d albums p� %d side(r)'
);

$lang_thumb_view = array(
	'date' => 'DATO',
	'name' => 'NAVN',
	'sort_da' => 'Sorteret i stigende dato r�kkef�lge',
	'sort_dd' => 'Sortret i faldende dato r�kkef�lge',
	'sort_na' => 'Sorteret alfabetisk stigende re�kkef�lge',
	'sort_nd' => 'Sorteret alfabetisk faldende re�kkef�lge',
	'pic_on_page' => '%d billeder p� %d side(r)',
	'user_on_page' => '%d bruger p� %d side(r)'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Retur til oversigt',
	'pic_info_title' => 'Vis/skjul billede information',
	'slideshow_title' => 'Slideshow',
	'ecard_title' => 'Send dette billede som et e-postkort',
	'ecard_disabled' => 'e-postkort er sl�et fra',
	'ecard_disabled_msg' => 'Du har ikke tilladelse til at sende e-postkort',
	'prev_title' => 'Se foreg�ende billede',
	'next_title' => 'Se n�ste billede',
	'pic_pos' => 'BILLEDE %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Bed�m dette billede ',
	'no_votes' => '(Ej bed�mt endnu)',
	'rating' => '(Aktuel karakter : %s / 5 med %s stemmer)',
	'rubbish' => 'D�rligt',
	'poor' => 'Ringe',
	'fair' => 'Rimeligt',
	'good' => 'Godt',
	'excellent' => 'Ret s� godt',
	'great' => 'Fantastisk',
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
	CRITICAL_ERROR => 'Kritisk fejl',
	'file' => 'Fil: ',
	'line' => 'Linje: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Filnavn : ',
	'filesize' => 'Filst�rrelse : ',
	'dimensions' => 'Dimensioner : ',
	'date_added' => 'Tilf�jet dato : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s kommentar',
	'n_views' => '%s visninger',
	'n_votes' => '(%s stemmer)'
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
	'Exclamation' => 'Udr�b',
	'Question' => 'Sp�rgsm�l',
	'Very Happy' => 'Meget glad',
	'Smile' => 'Smil',
	'Sad' => 'Trist',
	'Surprised' => 'Overrasket',
	'Shocked' => 'Chokeret',
	'Confused' => 'Forvirret',
	'Cool' => 'Sejt',
	'Laughing' => 'Griner',
	'Mad' => 'Sur',
	'Razz' => 'Drille',
	'Embarassed' => 'genert',
	'Crying or Very sad' => 'Gr�der eller meget trist',
	'Evil or Very Mad' => 'Ond eller meget sur',
	'Twisted Evil' => 'Lusket ond',
	'Rolling Eyes' => 'Ruller med �jne',
	'Wink' => 'Vinker',
	'Idea' => 'God ide',
	'Arrow' => 'Pil',
	'Neutral' => 'Neutral',
	'Mr. Green' => 'Hr. Gr�n',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'Forlader admin mode...',
	1 => 'kommer ind i admin mode...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Albums skal have et navn !',
	'confirm_modifs' => 'Er du sikker p� du vil lave disse �ndringer ?',
	'no_change' => 'Du lavede ingen �ndringer !',
	'new_album' => 'Nyt album',
	'confirm_delete1' => 'Er du sikker p� du vil slette dette album ?',
	'confirm_delete2' => '\nAlle billeder og kommentarer forsvinder !',
	'select_first' => 'V�lg f�rst et album',
	'alb_mrg' => 'Album Manager',
	'my_gallery' => '* Mit galleri *',
	'no_category' => '* Ingen kategori *',
	'delete' => 'Slet',
	'new' => 'Ny',
	'apply_modifs' => 'Godkend rettelser',
	'select_category' => 'Select category',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Parameter Parameters obligatorisk ved \'%s\'operation ej udf�rt  !',
	'unknown_cat' => 'Valgte kategori eksister ikke i databasen',
	'usergal_cat_ro' => 'Bruger galleri kategprien kan ikke slettes !',
	'manage_cat' => 'Administrer kategorier',
	'confirm_delete' => 'Er du sikker p� du �nsker at SLETTE denne kategori',
	'category' => 'Kategori',
	'operations' => 'Handling',
	'move_into' => 'Flyt til',
	'update_create' => 'Opdater/Opret kategori',
	'parent_cat' => 'Hoved kategori',
	'cat_title' => 'Kategori titel',
	'cat_desc' => 'Kategori beskrivelse'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Konfiguration',
	'restore_cfg' => 'Genskab standart instillinger',
	'save_cfg' => 'Gem ny konfiguration',
	'notes' => 'Noter',
	'info' => 'Information',
	'upd_success' => 'Coppermine ckonfigurationen er opdateret',
	'restore_success' => 'Coppermine standart konfigurationen genskabt',
	'name_a' => 'Navn stigende',
	'name_d' => 'Navn faldende',
	'date_a' => 'Dato stigende',
	'date_d' => 'Date faldende'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Generelle indstillinger',
	array('Galleri navn', 'gallery_name', 0),
	array('Galleri beskrivelse', 'gallery_description', 0),
	array('Galleri administrator e-mail', 'gallery_admin_email', 0),
	array('M�l adressen for \'Se flere billeder\' link i e-postkort', 'ecards_more_pic_target', 0),
	array('Sprog', 'lang', 5),
	array('Tema', 'theme', 6),

	'Albumsliste visning',
	array('Bredde p� hoved tabellen (pixels eller %)', 'main_table_width', 0),
	array('Antal af trin i kategorier for fremvisning', 'subcat_level', 0),
	array('Antal af albums til fremvisning', 'albums_per_page', 0),
	array('Antal af kolonner for albumliste', 'album_list_cols', 0),
	array('St�rrelse af minibilleder i pixels', 'alb_list_thumb_size', 0),
	array('Indholdet af hovedsiden', 'main_page_layout', 0),

	'Minibillede visning',
	array('Antal kolonner p� minnibillede siden', 'thumbcols', 0),
	array('Antal r�kker p� minibillede siden', 'thumbrows', 0),
	array('Max antal minibilleder pr side', 'max_tabs', 0),
	array('Vis billedeoverskriften (i tilf�jelse til titel) nedenfor minibillede', 'caption_in_thumbview', 1),
	array('Vis antal af kommentarer nedenfor minibilledet', 'display_comment_count', 1),
	array('Standart sorterng af billedre�kkef�lgen', 'default_sort_order', 3),
	array('Min antal stemmer for billede f�r visning i \'top karakter\' listen', 'min_votes_for_rating', 0),

	'Billedevisning &amp; Kommentar indstillinger',
	array('Bredde for tabellen til visning af billeder (pixels eller %)', 'picture_table_width', 0),
	array('Billede information er synlig som standart', 'display_pic_info', 1),
	array('Filtrer bandet ord i kommentar', 'filter_bad_words', 1),
	array('Tillad smiles i kommentar', 'enable_smilies', 1),
	array('Max l�ngde for billedebeskrivelse', 'max_img_desc_length', 0),
	array('Max l�nge p� helt ord', 'max_com_wlength', 0),
	array('Max linjer i en kommentar', 'max_com_lines', 0),
	array('Maximum l�ngde p� en kommentar', 'max_com_size', 0),

	'Billede og minnibillede indstillinger',
	array('Kvalitet for JPEG billeder', 'jpeg_qual', 0),
	array('Max bredde eller h�jde p� minibilleder <b>*</b>', 'thumb_width', 0),
	array('Opret mellemliggende bolleder','make_intermediate',1),
	array('Max bredde eller h�jde for et mellemliggende billede <b>*</b>', 'picture_width', 0),
	array('Max st�rrelse for uploadet billeder (KB)', 'max_upl_size', 0),
	array('Max bredde eller h�jde for uploadet billeder (pixels)', 'max_upl_width_height', 0),

	'Bruger indstillinger',
	array('Tillad nye bruger registreringer', 'allow_user_registration', 1),
	array('Ved bruger registration forlanges e-mail godkendelse', 'reg_requires_valid_email', 1),
	array('Tillad 2 bruger at have samme e-mail', 'allow_duplicate_emails_addr', 1),
	array('Bruger kan have private albums', 'allow_private_albums', 1),

	'specialfremstillet f�lter ved billede beskrivelse (lad det forblive blanke, hvis det ikke skal bruges)',
	array('Felt 1 navn', 'user_field1_name', 0),
	array('Felt 2 navn', 'user_field2_name', 0),
	array('Felt 3 navn', 'user_field3_name', 0),
	array('Felt 4 navn', 'user_field4_name', 0),

	'Advanceret billede og minibillede indstillinger',
	array('Forbudte karakterer i filnavne', 'forbiden_fname_char',0),
	array('Aksepter fil udvidelse for uploadet billeder', 'allowed_file_extensions',0),
	array('Metode for skabelsen af billede st�rrelsen','thumb_method',2),
	array('Sti til ImageMagick \'konveter\' v�rkt�j (eksempel /usr/bin/X11/)', 'impath', 0),
	array('Tillad billedetyper (kun gangbar ved brug af ImageMagick)', 'allowed_img_types',0),
	array('Kommandolinje valg ved brug af ImageMagick', 'im_options', 0),
	array('L�s EXIF data i JPEG filer', 'read_exif_data', 1),
	array('Album mappen <b>*</b>', 'fullpath', 0),
	array('Mappen for bruger billeder <b>*</b>', 'userpics', 0),
	array('foranstillet navn p� mellembilleder <b>*</b>', 'normal_pfx', 0),
	array('foranstillet navn p� minibilleder <b>*</b>', 'thumb_pfx', 0),
	array('Standart tilstand p� mapper', 'default_dir_mode', 0),
	array('stndart tilstand p� billeder', 'default_file_mode', 0),

	'Cookies &amp; tegn-kodnings indstillinger',
	array('Navnet p� den cookie brugt af dette system', 'cookie_name', 0),
	array('Sien til den cookie brugt at dette system', 'cookie_path', 0),
	array('tegn-kodning', 'charset', 4),

	'Miscellaneous settings',
	array('Enable debug mode', 'debug_mode', 1),
	
	'<br /><div align="center">(*) Felter markeret med * skal skiftes hvis du allerede har billeder i dit galleri</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'You need to type your name and a comment',
	'com_added' => 'Your comment was added',
	'alb_need_title' => 'You have to provide a title for the album !',
	'no_udp_needed' => 'No update needed.',
	'alb_updated' => 'The album was updated',
	'unknown_album' => 'Selected album does not exist or you don\'t have permission to upload in this album',
	'no_pic_uploaded' => 'No picture was uploaded !<br /><br />If you have really selected a picture to upload, check that the server allows file uploads...',
	'err_mkdir' => 'Failed to create directory %s !',
	'dest_dir_ro' => 'Destination directory %s is not writable by the script !',
	'err_move' => 'Impossible to move %s to %s !',
	'err_fsize_too_large' => 'The size of picture you have uploaded is too large (maximum allowed is %s x %s) !',
	'err_imgsize_too_large' => 'The size of the file you have uploaded is too large (maximum allowed is %s KB) !',
	'err_invalid_img' => 'The file you have uploaded is not a valid image !',
	'allowed_img_types' => 'You can only upload %s images.',
	'err_insert_pic' => 'The picture \'%s\' can\'t be inserted in the album ',
	'upload_success' => 'Your picture was uploaded successfully<br /><br />It will be visible after admin approval.',
	'info' => 'Information',
	'com_added' => 'Comment added',
	'alb_updated' => 'Album updated',
	'err_comment_empty' => 'Your comment is empty !',
	'err_invalid_fext' => 'Only files with the following extensions are accepted : <br /><br />%s.',
	'no_flood' => 'Sorry but you are already the author of the last comment posted for this picture<br /><br />Edit the comment you have posted if you want to modify it',
	'redirect_msg' => 'You are being redirected.<br /><br /><br />Click \'CONTINUE\' if the page does not refresh automatically',
	'upl_success' => 'Your picture was successfully added',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Overskrift',
	'fs_pic' => 'fuld st�rrese billede',
	'del_success' => 'Slettet',
	'ns_pic' => 'normal st�rrelse billede',
	'err_del' => 'Kan ikke slettes',
	'thumb_pic' => 'minibillede',
	'comment' => 'kommentar',
	'im_in_alb' => 'billede i album',
	'alb_del_success' => 'Album \'%s\' slettet',
	'alb_mgr' => 'Album Administrator',
	'err_invalid_data' => 'Forkert data modtaget i \'%s\'',
	'create_alb' => 'Opretter album \'%s\'',
	'update_alb' => 'Opdater album \'%s\' with title \'%s\' and index \'%s\'',
	'del_pic' => 'Slet billede',
	'del_alb' => 'Slet album',
	'del_user' => 'Slet bruger',
	'err_unknown_user' => 'Den valgte bruger findes ikke !',
	'comment_deleted' => 'Kommentar blev slettet',
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
	'confirm_del' => 'Er du sikker p� du �nsker at SLETTE dette billede ? \\nKommentarer bliver ogs� slettet.',
	'del_pic' => 'SLET DETTE BILLEDE',
	'size' => '%s x %s pixels',
	'views' => '%s gange',
	'slideshow' => 'Slideshow',
	'stop_slideshow' => 'STOP SLIDESHOW',
	'view_fs' => 'Click to view full size image',
);

$lang_picinfo = array(
	'title' =>'Billede information',
	'Filename' => 'Filnavn',
	'Album name' => 'Album navn',
	'Rating' => 'Karakter (%s stemmer)',
	'Keywords' => 'N�gleord',
	'File Size' => 'Fil St�rrelse',
	'Dimensions' => 'Dimensioner',
	'Displayed' => 'Vist',
	'Camera' => 'Kamera',
	'Date taken' => 'Optaget dato',
	'Aperture' => 'Bl�nder�bning',
	'Exposure time' => 'Eksponeringstid ',
	'Focal length' => 'Br�ndvidde',
	'Comment' => 'Kommentar'
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => 'Ret denne kommentar',
	'confirm_delete' => 'Erdu sikker p� du vil slette denn kommentar ?',
	'add_your_comment' => 'Tilf�j din kommentar',
	'your_name' => 'Dit navn',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Send et e-postkort',
	'invalid_email' => '<b>Advarsel</b> : ugyldig e-mail adresse !',
	'ecard_title' => 'Et e-postkort fra %s til dig',
	'view_ecard' => 'Hvis kortet ikke vises korrekt, klik her',
	'view_more_pics' => 'Klik p� dette link for at se flere billeder !',
	'send_success' => 'Dit e-postkort blev sendt',
	'send_failed' => 'Beklager men serveren kan ikke sende dit e-postkort...',
	'from' => 'Fra',
	'your_name' => 'Dit navn',
	'your_email' => 'Din e-mail adresse',
	'to' => 'Til',
	'rcpt_name' => 'Modtagers navn',
	'rcpt_email' => 'Modtagers e-mail adresse',
	'greetings' => 'Hilsen',
	'message' => 'Besked',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Billede&nbsp;info',
	'album' => 'Album',
	'title' => 'Titel',
	'desc' => 'Beskrivelse',
	'keywords' => 'N�gleord',
	'pic_info_str' => '%sx%s - %sKB - %s visninger - %s stemmer',
	'approve' => 'Godkend billede',
	'postpone_app' => 'Udskyde godkendelsen',
	'del_pic' => 'Slet billede',
	'reset_view_count' => 'Nulstil t�ller',
	'reset_votes' => 'Nulstil afsteming',
	'del_comm' => 'Slet kommentarer',
	'upl_approval' => 'Upload godkendelse',
	'edit_pics' => 'Rediger billeder',
	'see_next' => 'Se n�ste billede',
	'see_prev' => 'Se foreg�ende billede',
	'n_pic' => '%s billeder',
	'n_of_pic_to_disp' => 'Antal billeder til fremvisning',
	'apply' => 'Tilf�j rettelser'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Gruppe navn',
	'disk_quota' => 'Disk kvote',
	'can_rate' => 'Kan give karakter',
	'can_send_ecards' => 'Kan sende e-postkort',
	'can_post_com' => 'Kan oprette kommentar',
	'can_upload' => 'Kan uploade billeder',
	'can_have_gallery' => 'Kan have privat billede galleri',
	'apply' => 'Tilf�j rettelser',
	'create_new_group' => 'Opret ny gruppe',
	'del_groups' => 'Slet valgte gruppe(er)',
	'confirm_del' => 'Advasel, n�r du sletter en gruppe, bruger tilh�rende denne gruppe vil blive flyttet til den \'Registreret\' gruppe !\n\nVil du forts�tte ?',
	'title' => 'Administrer bruger grupper',
	'approval_1' => 'Offentlig uploads godkendelse(1)',
	'approval_2' => 'Privat Uploads godkendelse(2)',
	'note1' => '<b>(1)</b> Uploads i det offentlige album, kr�ver admin godkendelse',
	'note2' => '<b>(2)</b> Uploads i et album som tilh�re brugeren, kr�ver admin godkendelse',
	'notes' => 'Notes'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Velkommen !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Er du sikker p� du vil SLETTE dette album ? \\nAlle billeder og kommentarer vil ogs� blive slettet.',
	'delete' => 'SLET',
	'modify' => 'REDIGER',
	'edit_pics' => 'REDIGER BILLEDER',
);

$lang_list_categories = array(
	'home' => 'Hjem',
	'stat1' => '<b>[pictures]</b> billeder i <b>[albums]</b> albums og <b>[cat]</b> kategorier med <b>[comments]</b> kommentarer vist <b>[views]</b> gange',
	'stat2' => '<b>[pictures]</b> billeder i <b>[albums]</b> albums vist <b>[views]</b> gange',
	'xx_s_gallery' => '%s\'s Galleri',
	'stat3' => '<b>[pictures]</b> billeder i <b>[albums]</b> albums med <b>[comments]</b> kommentarer vist <b>[views]</b> gange'
);

$lang_list_users = array(
	'user_list' => 'Bruger liste',
	'no_user_gal' => 'Der er ingen bruger der har tilladelse til at have albums',
	'n_albums' => '%s album(s)',
	'n_pics' => '%s billede(r)'
);

$lang_list_albums = array(
	'n_pictures' => '%s billeder',
	'last_added' => ', sidste tilf�jet den %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Logind',
	'enter_login_pswd' => 'Skriv dig brugernavn og password',
	'username' => 'Brugernavn',
	'password' => 'Password',
	'remember_me' => 'Husk mig',
	'welcome' => 'Velkommen %s ...',
	'err_login' => '*** Kunne ikke logge ind. Pr�v igen ***',
	'err_already_logged_in' => 'Du er allerede logget ind !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Logud',
	'bye' => 'Farvel %s ...',
	'err_not_loged_in' => 'Du er ikke logget ind !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Opdater album %s',
	'general_settings' => 'Generelle indstillinger',
	'alb_title' => 'Album titel',
	'alb_cat' => 'Album kategori',
	'alb_desc' => 'Album beskrivelse',
	'alb_thumb' => 'Album minibillede',
	'alb_perm' => 'Tilladelser for dette album',
	'can_view' => 'Album kan vises af',
	'can_upload' => 'G�ster kan oploade billeder',
	'can_post_comments' => 'G�ster kan skrive kommentarer',
	'can_rate' => 'G�ster kan stemme p� billeder',
	'user_gal' => 'Bruger Galleri',
	'no_cat' => '* Ingen kategori *',
	'alb_empty' => 'Album er tomt',
	'last_uploaded' => 'Sidst indsendt',
	'public_alb' => 'Alle (offentligt album)',
	'me_only' => 'Kun mig',
	'owner_only' => 'Album ejer (%s)',
	'groupp_only' => 'Medlemmer af \'%s\' gruppen',
	'err_no_alb_to_modify' => 'Intet album du retiger i databasen.',
	'update' => 'Opdater album'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Beklager, men du har allerede stemt p� dette billede',
	'rate_ok' => 'Din stemme blev accepteret',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Mens administratorerne af denne site {SITE_NAME} vil pr�ve at fjerne eller tilrette alle generelt relevant materiale s� hurtigt som muligt, er det umuligt at gennemse alle indl�g. Derfor b�r du v�re opm�rksom p� at alle indl�g der er lavet til denne site Tilkendegiver meninger og holdninger af de forskellige forfattere og ikke altid administratorernes mening (med undtagelse af de indl�g skrevet af disse) derfor kan disse ikke stille til ansvar for andres indl�g.<br><br>
Du accepterer hermed ikke at indsende anst�delige, vulg�re, usmagelige, hadefulde, truende, sex-relaterede eller andet materiale der er i strid med lovgivningen. Du accepterer hermed at webmaster, administratorerne af {SITE_NAME} har lov til at fjerne eller rette i indholdet til enhver tid. Som bruger accepterer du at alle dine oplysninger bliver gemt i en database. Men dine informationer bliver ikke givet videre til andre uden din accept. Administratorerne kan ikke kr�ves til ansvar overfor hackerfors�g der eventuelt kan f�re til videregivelse af dine oplysninger.<br><br>
Denne site bruger cookies til at gemme informationer p� din private computer. Disse cookies tjener kun det form�l at forbedre billedkvaliteten. Denne e-mail bekr�fter din registrering, detaljer og password.<br>
Ved at klikke p� "jeg accepterer" knappen forneden acceptere du ovenst�ende betingelser
EOT;

$lang_register_php = array(
	'page_title' => 'Bruger registrering',
	'term_cond' => 'Regler og betingelser',
	'i_agree' => 'Jeg er ening',
	'submit' => 'Send registrering',
	'err_user_exists' => 'Brugernavnet du har skrevet findes allerede, v�lge venligst et andet',
	'err_password_mismatch' => 'de to password er ikke ens, pr�v igen',
	'err_uname_short' => 'Brugernavn skal v�re p� mindst 2 karakterer',
	'err_password_short' => 'Password skal v�re p� mindst 2 karakterer',
	'err_uname_pass_diff' => 'Username og password skal v�re forskellige',
	'err_invalid_email' => 'E-mail adresse er ugyldig',
	'err_duplicate_email' => 'En anden bruger er allerede registret med den e-mail du har opgivet',
	'enter_info' => 'Angiv registrerings information',
	'required_info' => 'Information forlanges',
	'optional_info' => 'Information er valgfri',
	'username' => 'Brugernavn',
	'password' => 'Password',
	'password_again' => 'gentag password',
	'email' => 'E-mail',
	'location' => 'Sted',
	'interests' => 'Interesser',
	'website' => 'Hjemmeside',
	'occupation' => 'Bes�ftigelse',
	'error' => 'FEJL',
	'confirm_email_subject' => '%s - Registrations godkendelse',
	'information' => 'Information',
	'failed_sending_email' => 'Registreings godkendelsen kan ikke sendes !',
	'thank_you' => 'Tak for din registrering.<br /><br />En e-mail med informationer om hvordan du aktiver din konto, er blevet sendt til den adresse som du har angivet.',
	'acct_created' => 'Din konto er blevet oprettet og du kan nu logge ind med dit brugernavn og password',
	'acct_active' => 'Din konto er nu aktiv og du kan logge ind med dit brugernavn og password',
	'acct_already_act' => 'Din konto er allerede aktiv !',
	'acct_act_failed' => 'Denne konto kan ikke blive aktiveret !',
	'err_unk_user' => 'Valgte bruger eksister ikke !',
	'x_s_profile' => '%s\'s profil',
	'group' => 'Gruppe',
	'reg_date' => 'Tilsluttet',
	'disk_usage' => 'Disk behandling',
	'change_pass' => 'Skift password',
	'current_pass' => 'Nuv�rende password',
	'new_pass' => 'Nyt password',
	'new_pass_again' => 'Nyt password igen',
	'err_curr_pass' => 'Nuv�rende password er forkert',
	'apply_modif' => 'Tilf�j rettelser',
	'change_pass' => 'Skift mit password',
	'update_success' => 'Din profil blev opdateret',
	'pass_chg_success' => 'Dit password blev �ndret',
	'pass_chg_error' => 'Dit password blev ikke �ndret',
);

$lang_register_confirm_email = <<<EOT
Tak for din registrering hos {SITE_NAME}

Dit brugernavn er : "{USER_NAME}"
Dit password er : "{PASSWORD}"

Som led i at aktiver din konto, skal du klikke p� linket her under
eller kopier og inds�tte det i din web browser.

{ACT_LINK}

Mange hilsner,

{SITE_NAME} - Administrationen

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Kommentar overblik',
	'no_comment' => 'Der er ingen kommentar at se tilbage p�',
	'n_comm_del' => '%s kommentar(er) slettet',
	'n_comm_disp' => 'Antal af kommentarer at vise',
	'see_prev' => 'Se foreg�ende',
	'see_next' => 'Se n�ste',
	'del_comm' => 'Slet valgte komentarer',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'S�g i billede samlingen',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'S�g i nye billeder',
	'select_dir' => 'V�lg mappe',
	'select_dir_msg' => 'Denne funktion tillader dig at massetilf�je de billeder som du har uploadet via FTP.<br /><br />V�lg den mappe hvor du har uploadet dine billeder',
	'no_pic_to_add' => 'Der er intet billede at tilf�je',
	'need_one_album' => 'Du skal have mindt et album oprettet, for at bruge denne funktion',
	'warning' => 'Advarsel',
	'change_perm' => 'systemet kan ikke skrive i dette mappe, du skal �ndre server rettigheder p� denne mappe til 755 or 777 f�r du pr�ver at tilf�je billeder !',
	'target_album' => '<b>Anbring billeder af &quot;</b>%s<b>&quot; til </b>%s',
	'folder' => 'Folder',
	'image' => 'Billede',
	'album' => 'Album',
	'result' => 'Resultat',
	'dir_ro' => 'Ej skrivebar. ',
	'dir_cant_read' => 'Ej l�sebar. ',
	'insert' => 'Tilf�je nye billeder til galleriet',
	'list_new_pic' => 'Liste af nye billeder',
	'insert_selected' => 'Inds�t valgte billeder',
	'no_pic_found' => 'Ingen nye billeder blev fundet',
	'be_patient' => 'Hav lidt t�lmodighed, systemet arbejder p� at tilf�je billederne',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : Betyder at billedet blev tilf�jet'.
				'<li><b>DP</b> : Betyder at billedet er en dublikat og det allerede ligger i databasen'.
				'<li><b>PB</b> : Betyder at billedet ikke kunne tilf�jes, kontrolerer venligst din konfiguration samt tilladelser p� de respektive mapper'.
				'<li>Hvis OK, DP, PB \'signalet\' ikke kommer frem, klik da p� de manglede billeder for at se om der da fremkommer nogle fejlmeddelser som frembringes af PHP'.
				'<li>Hvis din browser laver timeout, da opdater den browser'.
				'</ul>',
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void


// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'Upload billede',
	'max_fsize' => 'Max tilladte filst�rrelse er sat til %s KB',
	'album' => 'Album',
	'picture' => 'Billede',
	'pic_title' => 'Billede titel',
	'description' => 'Billede beskrivelse',
	'keywords' => 'N�gleord (Adskil dem med medllemrum)',
	'err_no_alb_uploadables' => 'Beklager der er intet album, som er dig tilladt at lave uploads af billeder',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Administrer bruger',
	'name_a' => 'Navn stigende',
	'name_d' => 'Navn faldende',
	'group_a' => 'Gruppe stigende',
	'group_d' => 'Gruppe faldende',
	'reg_a' => 'Reg dato stigende',
	'reg_d' => 'Reg dato faldende',
	'pic_a' => 'Billede t�ller stigende',
	'pic_d' => 'Billede t�ller faldende',
	'disku_a' => 'Disk behandling stigende',
	'disku_d' => 'Disk behandling faldende',
	'sort_by' => 'Sorteret af bruger',
	'err_no_users' => 'Bruger tabel er tom !',
	'err_edit_self' => 'Du kan ikke rette i egen profil, brug \'Min profil\' link til dette form�l',
	'edit' => 'RET',
	'delete' => 'SLET',
	'name' => 'Bruger navn',
	'group' => 'Gruppe',
	'inactive' => 'Inaktiv',
	'operations' => 'Handlinger',
	'pictures' => 'Billeder',
	'disk_space' => 'Plads brugt / Kvote',
	'registered_on' => 'Registreret den',
	'u_user_on_p_pages' => '%d bruger p� %d side(r)',
	'confirm_del' => 'Er du siker p� du vil SLETTE denne bruger ? \\nAlle billeder og albums vil ogs� blive slettet.',
	'mail' => 'POST',
	'err_unknown_user' => 'Valgt bruger eksister ikke !',
	'modify_user' => 'Rediger bruger',
	'notes' => 'Noter',
	'note_list' => '<li>Hvis du ikke vil rette det aktuelle password, da lad feltet "password" st� tomt',
	'password' => 'Password',
	'user_active' => 'Bruger er aktiv',
	'user_group' => 'Brugers gruppe',
	'user_email' => 'Brugers e-mail',
	'user_web_site' => 'Brugers webside',
	'create_new_user' => 'Opret ny bruger',
	'user_location' => 'Brugers placering',
	'user_interests' => 'Brugers interesser',
	'user_occupation' => 'Brugers besk�ftigelse',
);
?>