<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery                                                 //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gr&eacute;gory DEMAR <gdemar@wanadoo.fr>               //
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
//
// Latvian language file (first release)
// by Kaspars Priedols <house@tvertne.nu>
// http://foto.tvertne.nu
//

$lang_charset = 'windows-1257';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Sv', 'Pr', 'Ot', 'Tr', 'Ct', 'Pt', 'Ss');
$lang_month = array('Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'J&ucirc;n', 'J&ucirc;l', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec');

// Some common strings
$lang_yes = 'J&acirc;';
$lang_no  = 'N�';
$lang_back = 'ATGRIEZTIES';
$lang_continue = 'TURPIN&Acirc;T';
$lang_info = 'Inform&acirc;cija';
$lang_error = 'K�&ucirc;da';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
//$album_date_fmt =    '%B %d, %Y';
//$lastcom_date_fmt =  '%m/%d/%y %H:%M';
//$lastup_date_fmt = '%B %d, %Y';
//$register_date_fmt = '%B %d, %Y';
//$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
//$comment_date_fmt =  '%B %d, %Y at %I:%M %p';

$album_date_fmt = '%d/%m/%Y %H:%M';
$lastcom_date_fmt = '%d/%m/%Y %H:%M';
$lastup_date_fmt = '%d/%m/%Y %H:%M';
$register_date_fmt = '%d/%m/%Y %H:%M';
$lasthit_date_fmt = '%d/%m/%Y %H:%M';
$comment_date_fmt = '%d/%m/%Y %H:%M';


// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*', 'pimp', 'pe�', 'pipel', 'b�a&igrave;', 'nahu', 'pist', 'pisien', 'mirl', 's&ucirc;d', 'bled', 'blad', 'pizde', 'mauka', 'mauc&icirc;', '&acirc;nus', 'kaka', 's&ucirc;k&acirc;');

$lang_meta_album_names = array(
	'random' => 'Izlases veida att�li',
	'lastup' => 'Jaun&acirc;kie papildin&acirc;jumi',
	'lastcom' => 'Jaun&acirc;kie koment&acirc;ri',
	'topn' => 'Skat&icirc;t&acirc;kie',
	'toprated' => 'Vispopul&acirc;r&acirc;kie',
	'lasthits' => 'P�d�jie skat&icirc;tie',
	'search' => 'Mekl��anas rezult&acirc;ti'
);

$lang_errors = array(
	'access_denied' => 'Tev nav pieejas ties&icirc;bu �ai lapai.',
	'perm_denied' => 'Tev nav ties&icirc;bu veikt �&acirc;du darb&icirc;bu.',
	'param_missing' => 'Tika izsaukta komanda bez parametriem.',
	'non_exist_ap' => 'Izv�l�tais albums/att�ls neeksist�!',
	'quota_exceeded' => 'Nav vietas uz diska.<br /><br />Tev ir pie�&iacute;irts ierobe�ojums [quota]K, bet pa�laik jau aiz&ograve;emti [space]K, t&acirc;p�c �&icirc; att�la pievieno�ana nav ieteicama (tiks p&acirc;rsniegts ierobe�ojums).',
	'gd_file_type_err' => 'Izmantojot GD att�lu bibliot�ku, at�auts izmantot tikai JPEG un PNG form&acirc;tus.',
	'invalid_image' => 'Att�ls boj&acirc;ts vai ar&icirc; sist�mas GD att�lu bibliot�ka nesp�j to atkod�t.',
	'resize_failed' => 'Nav iesp�jams izveidot mazo att�lu vai izmain&icirc;t t&acirc; izm�rus.',
	'no_img_to_display' => 'Nav att�la',
	'non_exist_cat' => 'Izv�l�t&acirc; sada�a neeksist�',
	'orphan_cat' => '�ai apak�sada�ai nav sada�as, kam t&acirc; pieder�tu, l&ucirc;dzu izmanto sada�u mened�eri, lai atrisin&acirc;tu probl�mu.',
	'directory_ro' => 'Direktorij&acirc; \'%s\' nav at�auts rakst&icirc;t, t&acirc;p�c att�lus nav iesp�jams izdz�st.',
	'non_exist_comment' => 'Izv�l�tais koment&acirc;rs neeksist�.',
	'pic_in_invalid_album' => 'Att�ls atrodas neeksist�jo�&acirc; album&acirc; (%s)!?'
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'Uz albumu sarakstu',
	'alb_list_lnk' => 'Albumu saraksts',
	'my_gal_title' => 'Uz manu galeriju',
	'my_gal_lnk' => 'Mana galerija',
	'my_prof_lnk' => 'My profails',
	'adm_mode_title' => 'P&acirc;rsl�gties Administratora re�&icirc;m&acirc;',
	'adm_mode_lnk' => 'Administratora re�&icirc;ms',
	'usr_mode_title' => 'P&acirc;rsl�gties lietot&acirc;ja re�&icirc;m&acirc;',
	'usr_mode_lnk' => 'Lietot&acirc;ja re�&icirc;ms',
	'upload_pic_title' => 'Ielikt att�lu album&acirc;',
	'upload_pic_lnk' => 'Pievienot att�lu',
	'register_title' => 'Izveidot kontu',
	'register_lnk' => 'Re&igrave;istr�ties',
	'login_lnk' => 'Piesl�gties',
	'logout_lnk' => 'Beigt darbu',
	'lastup_lnk' => 'Jaun&acirc;kie att�li',
	'lastcom_lnk' => 'Jaun&acirc;kie koment&acirc;ri',
	'topn_lnk' => 'Skat&icirc;t&acirc;kie att�li',
	'toprated_lnk' => 'Vispopul&acirc;r&acirc;kie',
	'search_lnk' => 'Mekl�t',
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Apstiprin&acirc;t',
	'config_lnk' => 'Konfigur�t',
	'albums_lnk' => 'Albumi',
	'categories_lnk' => 'Sada�as',
	'users_lnk' => 'Lietot&acirc;ji',
	'groups_lnk' => 'Grupas',
	'comments_lnk' => 'Koment&acirc;ri',
	'searchnew_lnk' => 'Att�lu grupas...',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Izveidot manu albumu',
	'modifyalb_lnk' => 'Main&icirc;t manu albumu',
	'my_prof_lnk' => 'Profails',
);

$lang_cat_list = array(
	'category' => 'Sada�as',
	'albums' => 'Albumi',
	'pictures' => 'Att�li',
);

$lang_album_list = array(
	'album_on_page' => '%d albumi %d lap&acirc;(s)'
);

$lang_thumb_view = array(
	'date' => 'DATE',
	'name' => 'NAME',
	'sort_da' => 'p�c datuma augo�i',
	'sort_dd' => 'p�c datuma dilsto�i',
	'sort_na' => 'p�c nosaukuma augo�i',
	'sort_nd' => 'p�c nosaukuma dilsto�i',
	'pic_on_page' => '%d att�li %d lap&acirc;(s)',
	'user_on_page' => '%d lietot&acirc;ji %d lap&acirc;(s)'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Atgriezties uz att�lu indeksu',
	'pic_info_title' => 'R&acirc;d&icirc;t/pasl�pt inform&acirc;ciju par att�lu',
	'slideshow_title' => 'Slaid�ovs',
	'ecard_title' => 'S&ucirc;t&icirc;t k&acirc; e-karti&ograve;u',
	'ecard_disabled' => 'e-karti&ograve;u s&ucirc;t&icirc;�ana atsl�gta',
	'ecard_disabled_msg' => 'Tev nav pietiekamu ties&icirc;bu, lai s&ucirc;t&icirc;tu e-karti&ograve;as',
	'prev_title' => 'Iepriek��jais att�ls',
	'next_title' => 'N&acirc;kamais att�ls',
	'pic_pos' => 'ATT�LS %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Nov�rt�t ',
	'no_votes' => '(nov�rt�juma nav)',
	'rating' => '(nov�rt�jums: %s balsis no 5 (balsots %s reizi(-es))',
	'rubbish' => 'M�sls',
	'poor' => 'V&acirc;ji',
	'fair' => 'Viduv�ji',
	'good' => 'Labi',
	'excellent' => 'Teicami',
	'great' => 'Lieliski',
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
	CRITICAL_ERROR => 'Kritiska k�&ucirc;da',
	'file' => 'Fails: ',
	'line' => 'Rinda: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Nosaukums : ',
	'filesize' => 'Lielums : ',
	'dimensions' => 'Izm�rs : ',
	'date_added' => 'Pievienots : '
);

$lang_get_pic_data = array(
	'n_comments' => 'koment&acirc;ri: <b>%s</b>',
	'n_views' => 'skat&icirc;jumi: <b>%s</b>',
	'n_votes' => 'v�rt�jumi: <b>%s</b>'
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
	'Exclamation' => 'Exclamation',
	'Question' => 'Question',
	'Very Happy' => 'Very Happy',
	'Smile' => 'Smile',
	'Sad' => 'Sad',
	'Surprised' => 'Surprised',
	'Shocked' => 'Shocked',
	'Confused' => 'Confused',
	'Cool' => 'Cool',
	'Laughing' => 'Laughing',
	'Mad' => 'Mad',
	'Razz' => 'Razz',
	'Embarassed' => 'Embarassed',
	'Crying or Very sad' => 'Crying or Very sad',
	'Evil or Very Mad' => 'Evil or Very Mad',
	'Twisted Evil' => 'Twisted Evil',
	'Rolling Eyes' => 'Rolling Eyes',
	'Wink' => 'Wink',
	'Idea' => 'Idea',
	'Arrow' => 'Arrow',
	'Neutral' => 'Neutral',
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
	0 => 'Pametam administr��anas re�&icirc;mu...',
	1 => 'Uz administr��anas re�&icirc;mu...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'K&acirc; sauksim albumu?',
	'confirm_modifs' => 'Apstiprin&acirc;t veikt&acirc;s izmai&ograve;as?',
	'no_change' => 'Nekas nav main&icirc;ts!',
	'new_album' => 'Jauns albums',
	'confirm_delete1' => 'Tie�&acirc;m dz�st �o albumu?',
	'confirm_delete2' => '\nVisi att�li un koment&acirc;ri taj&acirc; tiks izdz�sti!',
	'select_first' => 'Vispirms j&acirc;izv�las albumu',
	'alb_mrg' => 'Albumu mened�eris',
	'my_gallery' => '* Mana galerija *',
	'no_category' => '* Mana sada�a *',
	'delete' => 'Dz�st',
	'new' => 'Jauns',
	'apply_modifs' => 'Apstiprin&acirc;t izmai&ograve;as',
	'select_category' => 'Izv�l�ties sada�u',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Komandas \'%s\' izpild&icirc;�anai tr&ucirc;kst nepiecie�amie parametri!',
	'unknown_cat' => 'Izv�l�t&acirc; sada�a datu b&acirc;z� neeksist�',
	'usergal_cat_ro' => 'Lietot&acirc;ja galerijas sada�a nevar tikt dz�sta!',
	'manage_cat' => 'Administr�t sada�as',
	'confirm_delete' => 'Tie�&acirc;m dz�st �o sada�u',
	'category' => 'Sada�a',
	'operations' => 'Darb&icirc;bas',
	'move_into' => 'P&acirc;rvietot uz',
	'update_create' => 'Modific�t/izveidot sada�u',
	'parent_cat' => 'Pieder sada�ai',
	'cat_title' => 'Sada�as virsraksts',
	'cat_desc' => 'Sada�as apraksts'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Konfigur&acirc;cija',
	'restore_cfg' => 'Atjaunot noklus�t&acirc;s v�rt&icirc;bas',
	'save_cfg' => 'Saglab&acirc;t jaunos uzst&acirc;d&icirc;jumus',
	'notes' => 'Piez&icirc;mes',
	'info' => 'Inform&acirc;cija',
	'upd_success' => 'Coppermine konfigur&acirc;cija saglab&acirc;ta',
	'restore_success' => 'Coppermine noklus�t&acirc; konfigur&acirc;cija uzst&acirc;d&icirc;ta',
	'name_a' => 'Nosaukums augo�i',
	'name_d' => 'Nosaukums dilsto�i',
	'date_a' => 'Datums augo�i',
	'date_d' => 'Datums dilsto�i'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Galvenie uzst&acirc;d&icirc;jumi',
	array('Nosaukums', 'gallery_name', 0),
	array('Apraksts', 'gallery_description', 0),
	array('Administrators', 'gallery_admin_email', 0),
	array('Adrese, kas b&ucirc;s e-karti&ograve;&acirc; pie teksta \'Citi att�li...\'', 'ecards_more_pic_target', 0),
	array('Valoda', 'lang', 5),
	array('T�ma', 'theme', 6),

	'Albumu saraksta skat&icirc;jums',
	array('Galven&acirc;s tabulas platums (pikse�os vai %)', 'main_table_width', 0),
	array('Cik l&icirc;me&ograve;os sada�as atspogu�ot', 'subcat_level', 0),
	array('Cik albumus atspogu�ot', 'albums_per_page', 0),
	array('Cik kolonn&acirc;s atspogu�ot alb&ucirc;mus', 'album_list_cols', 0),
	array('Cik lieli pikse�os b&ucirc;s mazie att�li', 'alb_list_thumb_size', 0),
	array('Galven&acirc;s lapas saturs', 'main_page_layout', 0),

	'Mazo att�lu skat&icirc;jums',
	array('Cik kolonn&acirc;s r&acirc;d&icirc;t mazos att�lus', 'thumbcols', 0),
	array('Cik rind&acirc;s r&acirc;d&icirc;t mazos att�lus', 'thumbrows', 0),
	array('Cik tabulas atspogu�ot', 'max_tabs', 0),
	array('Blakus mazajam att�lam atspogu�ot ne tikai att�la virsrakstu, bet ar&icirc; aprakstu', 'caption_in_thumbview', 1),
	array('Atspogu�ot koment&acirc;ru skaitu', 'display_comment_count', 1),
	array('K&acirc; k&acirc;rtot att�lus', 'default_sort_order', 3),
	array('Minim&acirc;lais balsu skaits, lai att�ls tiktu iek�auts vispopul&acirc;r&acirc;ko sarakst&acirc;', 'min_votes_for_rating', 0),

	'Att�lu skat&icirc;�an&acirc;s &amp; Koment&acirc;ri',
	array('Att�la tabulas platums (pikse�os vai %)', 'picture_table_width', 0),
	array('Att�la inform&acirc;cija redzama p�c noklus��anas', 'display_pic_info', 1),
	array('Filtr�t sliktus v&acirc;rdus koment&acirc;ros', 'filter_bad_words', 1),
	array('At�aut seji&ograve;as koment&acirc;ros', 'enable_smilies', 1),
	array('Max att�la apraksta garums', 'max_img_desc_length', 0),
	array('Max simbolu skaits vien&acirc; v&acirc;rd&acirc;', 'max_com_wlength', 0),
	array('Max rindu skaits koment&acirc;r&acirc;', 'max_com_lines', 0),
	array('Max koment&acirc;ra garums', 'max_com_size', 0),

	'Lielo un mazo att�lu kvalit&acirc;te',
	array('JPEG failu kvalit&acirc;te', 'jpeg_qual', 0),
	array('Max maz&acirc; att�la platums vai augstums <b>*</b>', 'thumb_width', 0),
	array('Izveidot ar&icirc; \'starpatt�lus\'','make_intermediate',1),
	array('Max \'starpatt�la\' platums vai augstums <b>*</b>', 'picture_width', 0),
	array('Max uzlikt&acirc; att�la lielums (KB)', 'max_upl_size', 0),
	array('Max uzlikt&acirc; att�la platums vai augstums (pikse�os)', 'max_upl_width_height', 0),

	'Lietot&acirc;ju uzst&acirc;d&icirc;jumi',
	array('At�aut jaunu lietot&acirc;ju piere&igrave;istr��anos', 'allow_user_registration', 1),
	array('Lietot&acirc;ja sekm&icirc;gai re&igrave;istr&acirc;cija nepiecie�ams e-pasta apstiprin&acirc;jums', 'reg_requires_valid_email', 1),
	array('At�aut diviem da�&acirc;diem lietot&acirc;jiem izmantot vien&acirc;das e-pasta adreses', 'allow_duplicate_emails_addr', 1),
	array('Lietot&acirc;js dr&icirc;kst veidot person&icirc;gus alb&ucirc;mus', 'allow_private_albums', 1),

	'Rezerves lauki att�la aprakstam (ja neizmanto, atst&acirc;j tuk�us)',
	array('Lauka 1 nosaukums', 'user_field1_name', 0),
	array('Lauka 2 nosaukums', 'user_field2_name', 0),
	array('Lauka 3 nosaukums', 'user_field3_name', 0),
	array('Lauka 4 nosaukums', 'user_field4_name', 0),

	'Lielo un mazo att�lu &icirc;pa�ie uzst&acirc;d&icirc;jumi',
	array('K&acirc;di simboli aizliegti failu nosaukumos', 'forbiden_fname_char',0),
	array('Uzliekamo att�lu at�autie failu papla�in&acirc;jumi', 'allowed_file_extensions',0),
	array('Att�lu izm�ru main&icirc;�anas metodes','thumb_method',2),
	array('Ce�� uz ImageMagick \'convert\' util&icirc;tu (piem�ram, /usr/bin/X11/)', 'impath', 0),
	array('At�auti att�lu form&acirc;ti (tikai priek� ImageMagick)', 'allowed_img_types',0),
	array('Komandrindas parametri ImageMagick util&icirc;tai', 'im_options', 0),
	array('Izmantot JPEG att�lu EXIF inform&acirc;ciju', 'read_exif_data', 1),
	array('Albumu direktorija <b>*</b>', 'fullpath', 0),
	array('Lietot&acirc;ju albumu direktorija <b>*</b>', 'userpics', 0),
	array('Starpatt�lu prefikss <b>*</b>', 'normal_pfx', 0),
	array('Mazo att�lu prefikss <b>*</b>', 'thumb_pfx', 0),
	array('Direktoriju skat&icirc;juma re�&icirc;ms p�c noklus��anas', 'default_dir_mode', 0),
	array('Att�lu re�&icirc;ms', 'default_file_mode', 0),

	'Cepumi (cookies) &amp; Kod�jums',
	array('Cookie nosaukumus', 'cookie_name', 0),
	array('Cookie ce��', 'cookie_path', 0),
	array('Teksta kod�jums', 'charset', 4),

	'Citi uzst&acirc;d&icirc;jumi',
	array('Debug re�&icirc;ms', 'debug_mode', 1),

	'<br /><div align="center">(*) Ar * atz&icirc;m�tos parametrus nav ieteicams main&icirc;t, ja galer&icirc;j&acirc;s jau ir att�li</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Ja neb&ucirc;s v&acirc;rds un koment&acirc;ra teksts, nekas nesan&acirc;ks',
	'com_added' => 'Koment&acirc;rs pievienots',
	'alb_need_title' => 'K&acirc;ds ir albuma virsraksts (nosaukums)?',
	'no_udp_needed' => 'Izmai&ograve;as nav nepiecie�amas.',
	'alb_updated' => 'Album&acirc; veiksm&icirc;gi veiktas izmai&ograve;as',
	'unknown_album' => 'Izv�l�tais albums neeksist� vai ar&icirc; nav ties&icirc;bu taj&acirc; pievienot att�lus',
	'no_pic_uploaded' => 'Att�ls netika uzlikts!<br /><br />Vai uz servera ir uzlikta at�auja �&acirc;d&acirc;m oper&acirc;cij&acirc;m?',
	'err_mkdir' => 'Direktorija %s NEtika izveidota!',
	'dest_dir_ro' => 'Nav ties&icirc;bu veikt ierakstu direktrij&acirc; %s!',
	'err_move' => 'Nav iesp�jams p&acirc;rvietot %s uz %s !',
	'err_fsize_too_large' => 'Uzliekam&acirc; att�la izm�rs p&acirc;rsniedz max at�auto (max at�autais ir %s x %s) !',
	'err_imgsize_too_large' => 'Uzliekam&acirc; att�la faila izm�rs p&acirc;rsniedz max at�auto (max at�autais ir %s KB) !',
	'err_invalid_img' => 'Uzliekamais fails nav klasific�jams k&acirc; att�ls!',
	'allowed_img_types' => 'Tu dr&icirc;ksti uzlikt %s att�lus.',
	'err_insert_pic' => 'Att�ls \'%s\' nevar tikt pievienots ',
	'upload_success' => 'Att�ls veiksm&icirc;gi uzlikts<br /><br />Tas b&ucirc;s redzams galerij&acirc;, tikl&icirc;dz Administrators to b&ucirc;s akcept�jis.',
	'info' => 'Inform&acirc;cija',
	'com_added' => 'Koment&acirc;rs pievienots',
	'alb_updated' => 'Albums modific�ts',
	'err_comment_empty' => 'Nav koment&acirc;ra!',
	'err_invalid_fext' => 'At�auti faili ar �&acirc;diem papla�in&acirc;jumiem : <br /><br />%s.',
	'no_flood' => 'Atvaino, bet tie�i tu ar&icirc; esi p�d�j&acirc; ies&ucirc;t&icirc;t&acirc; koment&acirc;ra autors.<br /><br />Modific� sava p�d�j&acirc; ies&ucirc;t&icirc;t&acirc; koment&acirc;ra tekstu',
	'redirect_msg' => 'Notiek p&acirc;radres&acirc;cija.<br /><br /><br />Spied uz \'TURPIN&Acirc;T\', ja lapa nep&acirc;rl&acirc;d�jas',
	'upl_success' => 'Att�ls veiksm&icirc;gi pievienots',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Teksts',
	'fs_pic' => 'piln&acirc; izm�ra att�ls',
	'del_success' => 'veiksm&icirc;gi izdz�sts',
	'ns_pic' => 'norm&acirc;la izm�ra att�ls',
	'err_del' => 'nevar tikt izdz�sts',
	'thumb_pic' => 'mazais att�ls',
	'comment' => 'koment&acirc;rs',
	'im_in_alb' => 'att�ls album&acirc;',
	'alb_del_success' => 'Albums \'%s\' izdz�sts',
	'alb_mgr' => 'Albuma mened�eris',
	'err_invalid_data' => 'Sa&ograve;emta nekorekta inform&acirc;cija \'%s\'',
	'create_alb' => 'Tiek veidots albums \'%s\'',
	'update_alb' => 'Tiek modific�ts albums \'%s\' ar virsrakstu \'%s\' un indeksu \'%s\'',
	'del_pic' => 'Dz�st att�lu',
	'del_alb' => 'Dz�st albumu',
	'del_user' => 'Dz�st lietot&acirc;ju',
	'err_unknown_user' => 'Izv�l�tais lietot&acirc;js neeksist�!',
	'comment_deleted' => 'Koment&acirc;rs veiksm&icirc;gi izdz�sts',
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
	'confirm_del' => 'Tie�&acirc;m DZ�ST �o att�lu? \\nAr&icirc; koment&acirc;ri tiks izdz�sti.',
	'del_pic' => 'IZDZ�ST �O ATT�LU',
	'size' => '%s x %s px',
	'views' => '%s reizes',
	'slideshow' => 'Slaid�ovs',
	'stop_slideshow' => 'APST&Acirc;DIN&Acirc;T SLAID�OVU',
	'view_fs' => 'Uzspied, lai redz�tu pilna izm�ra att�lu',
);

$lang_picinfo = array(
	'title' =>'Inform&acirc;cija par att�lu',
	'Filename' => 'Att�ls',
	'Album name' => 'Albums',
	'Rating' => 'V�rt�jums (%s balsis)',
	'Keywords' => 'Atsl�gas v&acirc;rdi',
	'File Size' => 'Faila lielums',
	'Dimensions' => 'Izm�rs',
	'Displayed' => 'Att�lots',
	'Camera' => 'Kamera',
	'Date taken' => 'Uz&ograve;em�anas datums',
	'Aperture' => 'Objekt&icirc;va diametrs',
	'Exposure time' => 'Ekspoz&icirc;cijas laiks',
	'Focal length' => 'Fokuss',
	'Comment' => 'Koment&acirc;ri'
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => 'Modific�t koment&acirc;ru',
	'confirm_delete' => 'Tie�&acirc;m DZ�ST �o koment&acirc;ru?',
	'add_your_comment' => 'Pievienot koment&acirc;ru',
	'your_name' => 'V&acirc;rds',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Nos&ucirc;t&icirc;t e-karti&ograve;u',
	'invalid_email' => '<b>UZMAN&Icirc;BU</b> : k�&ucirc;daina adrese!',
	'ecard_title' => 'Sveiciens no %s',
	'view_ecard' => '�o sveicienu var redz�t ar&icirc; sekojo�a adres�',
	'view_more_pics' => 'Citi for�i att�li...',
	'send_success' => 'E-karti&ograve;a nos&ucirc;t&icirc;ta',
	'send_failed' => 'Atvaino, serveris nevar nos&ucirc;t&icirc;t tavu E-karti&ograve;u...',
	'from' => 'No k&acirc;',
	'your_name' => 'V&acirc;rds',
	'your_email' => 'E-pasta adrese',
	'to' => 'Kam',
	'rcpt_name' => 'Sa&ograve;em�ja v&acirc;rds',
	'rcpt_email' => 'Sa&ograve;�m�ja e-pasta adrese',
	'greetings' => 'Sveiciens',
	'message' => 'Pilnais teksts',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Att�la&nbsp;dati',
	'album' => 'Albums',
	'title' => 'Virsraksts',
	'desc' => 'Apraksts',
	'keywords' => 'Atsl�gas v&acirc;rdi',
	'pic_info_str' => '%sx%s - %sKB - %s skat&icirc;jumi - %s balsis',
	'approve' => 'Apstiprin&acirc;t att�la pievieno�anu',
	'postpone_app' => 'Noraid&icirc;t att�la pievieno�anu',
	'del_pic' => 'Dz�st att�lu',
	'reset_view_count' => 'Nodz�st skat&icirc;jumi skait&icirc;t&acirc;ju',
	'reset_votes' => 'Nodz�st balsojumu skaitu',
	'del_comm' => 'Dz�st koment&acirc;rus',
	'upl_approval' => 'Uzlik�anas apstiprin&acirc;jums',
	'edit_pics' => 'Modific�t att�lus',
	'see_next' => 'Iepriek��jie att�li',
	'see_prev' => 'N&acirc;kamie att�li',
	'n_pic' => '%s att�li',
	'n_of_pic_to_disp' => 'Cik att�lus atspogu�ot',
	'apply' => 'Apstiprin&acirc;t izmai&ograve;as'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Grupa',
	'disk_quota' => 'Kvota (atmi&ograve;as ierobe�ojumi)',
	'can_rate' => 'Dr&icirc;kst v�rt�t att�lus',
	'can_send_ecards' => 'Dr&icirc;kst s&ucirc;t&icirc;t e-karti&ograve;as',
	'can_post_com' => 'Dr&icirc;kst koment�t',
	'can_upload' => 'Dr&icirc;kst likt att�lus',
	'can_have_gallery' => 'Dr&icirc;kst b&ucirc;t person&icirc;ga galerija',
	'apply' => 'Apstiprin&acirc;t izmai&ograve;as',
	'create_new_group' => 'Izveidot jaunu grupu',
	'del_groups' => 'Dz�st grupu(-as)',
	'confirm_del' => 'Uzman&icirc;bu! Dz��ot grupu, visi tai pieder&icirc;gie lietot&acirc;ji tiks p&acirc;rvietoti uz re&igrave;istr�to lietot&acirc;ju grupu!\n\nTurpin&acirc;t?',
	'title' => 'Administr�t lietot&acirc;ju grupas',
	'approval_1' => 'Publisks uzlik�anas apstiprin&acirc;jums (1)',
	'approval_2' => 'Priv&acirc;ts uzlik�anas apstiprin&acirc;jums (2)',
	'note1' => '<b>(1)</b> Att�lu uzlik�anai publisk&acirc; alb&ucirc;m&acirc; ir nepiecie�ama administratora at�auja',
	'note2' => '<b>(2)</b> Att�lu pievieno�anai album&acirc;, kas pieder �im lietot&acirc;jam, nepiecie�ama administratora at�auja',
	'notes' => 'Piez&icirc;mes'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Laipni l&ucirc;dzam!'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Tie�&acirc;m DZ�ST �o albumu? \\nVisi att�li un koment&acirc;ri taj&acirc; tiks izdz�sti.',
	'delete' => 'IZDZ�ST',
	'modify' => 'UZST&Acirc;D&Icirc;JUMI',
	'edit_pics' => 'MODIFIC�T ATT�LUS',
);

$lang_list_categories = array(
	'home' => 'Galven&acirc; lapa',
	'stat1' => 'att�li: <b>[pictures]</b> | albumi: <b>[albums]</b> | sada�as: <b>[cat]</b> | koment&acirc;ri: <b>[comments]</b> | <b>skat&icirc;ts [views]</b> reizes',
	'stat2' => 'att�li: <b>[pictures]</b> | albumi: <b>[albums]</b> | skat&icirc;ti <b>[views]</b> reizes',
	'xx_s_gallery' => 'Autors %s',
	'stat3' => '<b>[pictures]</b> att�li | <b>[albums]</b> albumi | <b>[comments]</b> koment&acirc;ri | skat&icirc;ti <b>[views]</b> reizes'
);

$lang_list_users = array(
	'user_list' => 'Lietot&acirc;ju saraksts',
	'no_user_gal' => 'Nav lietot&acirc;ju galerijas',
	'n_albums' => 'albumi: <b>%s</b>',
	'n_pics' => 'att�li: <b>%s</b>'
);

$lang_list_albums = array(
	'n_pictures' => '<b>%s</b> att�li',
	'last_added' => ', p�d�jais pievienots <b>%s</b>'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //
//
// Login->Latvian????
// Logout->Latvian???
//

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Piesl�gties',
	'enter_login_pswd' => 'Piesl�dzies ar savu lietot&acirc;ja v&acirc;rdu un paroli',
	'username' => 'V&acirc;rds',
	'password' => 'Parole',
	'remember_me' => 'Atcer�ties mani ar&icirc; turpm&acirc;k',
	'welcome' => 'Sveicin&acirc;ts, %s ...',
	'err_login' => '*** V&acirc;rds vai/un parole nepareizi. M�&igrave;in&acirc;si v�lreiz? ***',
	'err_already_logged_in' => 'Tu jau esi sist�m&acirc;!',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Iziet',
	'bye' => 'Visu labu,  %s ...',
	'err_not_loged_in' => 'J&acirc;piesl�dzas sist�mai!',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Modific�t albumu %s',
	'general_settings' => 'Galvenie uzst&acirc;d&icirc;jumi',
	'alb_title' => 'Albuma virsraksts',
	'alb_cat' => 'Sada�a',
	'alb_desc' => 'Albuma apraksts',
	'alb_thumb' => 'Albuma mazais att�ls',
	'alb_perm' => 'Albuma lietot&acirc;ju ties&icirc;bas',
	'can_view' => 'Albumu var skat&icirc;ties',
	'can_upload' => 'Apmekl�t&acirc;jie dr&icirc;kst pievienot att�lus',
	'can_post_comments' => 'Apmekl�t&acirc;ji dr&icirc;kst koment�t',
	'can_rate' => 'Apmekl�t&acirc;ji dr&icirc;kst v�rt�t att�lus',
	'user_gal' => 'Lietot&acirc;ja galerija',
	'no_cat' => '* Kategorijas nav *',
	'alb_empty' => 'Albums ir tuk�s',
	'last_uploaded' => 'P�dejoreiz uzlikts att�ls',
	'public_alb' => 'Ikviens (publiskais albums)',
	'me_only' => 'Tikai es',
	'owner_only' => 'Tikai albuma &icirc;pa�nieks (%s)',
	'groupp_only' => 'Tikai \'%s\' grup&acirc; eso�ie',
	'err_no_alb_to_modify' => 'Tev nav ties&icirc;bu modific�t albumus.',
	'update' => 'Saglab&acirc;t izmai&ograve;as'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Atvaino, bet tu jau esi iesniedzis savu v�rt�jumu',
	'rate_ok' => 'V�rt�jums pie&ograve;emts',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
While the administrators of {SITE_NAME} will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every post. Therefore you acknowledge that all posts made to this site express the views and opinions of the author and not the administrators or webmaster (except for posts by these people) and hence will not be held liable.<br />
<br />
You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-orientated or any other material that may violate any applicable laws. You agree that the webmaster, administrator and moderators of {SITE_NAME} have the right to remove or edit any content at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent the webmaster and administrator cannot be held responsible for any hacking attempt that may lead to the data being compromised.<br />
<br />
This site uses cookies to store information on your local computer. These cookies serve only to improve your viewing pleasure. The email address is used only for confirming your registration details and password.<br />
<br />
By clicking 'Es piekr&icirc;tu' below you agree to be bound by these conditions.
EOT;

$lang_register_php = array(
	'page_title' => 'Lietot&acirc;ja re&igrave;istr&acirc;cija',
	'term_cond' => 'Vieno�an&acirc;s nosac&icirc;jumi',
	'i_agree' => 'Es piekr&icirc;tu',
	'submit' => 'Apstiprin&acirc;t re&igrave;istr&acirc;ciju',
	'err_user_exists' => '�is lietot&acirc;ja v&acirc;rds jau ir re&igrave;istr�ts, izv�lies citu',
	'err_password_mismatch' => 'Paroles nesakr&icirc;t, raksti v�lreiz',
	'err_uname_short' => 'Lietot&acirc;ja v&acirc;rda minim&acirc;lais simbolu skaits ir 2',
	'err_password_short' => 'Parol� j&acirc;b&ucirc;t ne maz&acirc;k k&acirc; 2 simboliem',
	'err_uname_pass_diff' => 'Lietot&acirc;ja v&acirc;rds un parole nedr&icirc;kst b&ucirc;t vien&acirc;di',
	'err_invalid_email' => 'E-pasta adres ir nepareiza',
	'err_duplicate_email' => '�&acirc;da email adrese jau ir datu b&acirc;z�',
	'enter_info' => 'Re&igrave;istr&acirc;cijas inform&acirc;cija',
	'required_info' => 'Nepiecie�am&acirc; inform&acirc;cija',
	'optional_info' => 'Neoblig&acirc;t&acirc; inform&acirc;cija',
	'username' => 'Lietot&acirc;ja v&acirc;rds',
	'password' => 'Parole',
	'password_again' => 'V�lreiz parole',
	'email' => 'E-pasts',
	'location' => 'Atra�an&acirc;s vieta',
	'interests' => 'Intereses',
	'website' => 'M&acirc;jas lapa',
	'occupation' => 'Nodarbo�an&acirc;s',
	'error' => 'K�&Ucirc;DA',
	'confirm_email_subject' => '%s - Re&igrave;istr&acirc;cijas apstiprin&acirc;jums',
	'information' => 'Inform&acirc;cija',
	'failed_sending_email' => 'Nevar tikt nos&ucirc;t&icirc;ta re&igrave;istr&acirc;cijas apstiprin&acirc;juma v�stule!',
	'thank_you' => 'Paldies par re&igrave;istr��anos.<br /><br />V�stule ar s&icirc;k&acirc;ku inform&acirc;ciju, k&acirc; pabeigt re&igrave;istr��an&acirc;s procesu, tika nos&ucirc;t&icirc;ta uz iepriek� min�to adresi.',
	'acct_created' => 'Konts izveidots un tu vari piesl�gties ar savu lietot&acirc;ja v&acirc;rdu un paroli',
	'acct_active' => 'Konts ir akt&icirc;vs un tu tagad vari piesl�gties sist�mai',
	'acct_already_act' => 'Konts jau ir akt&icirc;vs!',
	'acct_act_failed' => '�is konts nevar tikt aktiviz�ts!',
	'err_unk_user' => 'Izv�l�tais lietot&acirc;js neeksist�!',
	'x_s_profile' => '%s : profails',
	'group' => 'Grupa',
	'reg_date' => 'Pievienojies',
	'disk_usage' => 'Diska izmanto�ana',
	'change_pass' => 'Nomain&icirc;t paroli',
	'current_pass' => 'Pa�reiz�j&acirc; parole',
	'new_pass' => 'Jauna parole',
	'new_pass_again' => 'V�lreiz jaun&acirc; parole',
	'err_curr_pass' => 'Pa�reiz�j&acirc; parole nepareiza',
	'apply_modif' => 'Apstiprin&acirc;t izmai&ograve;as',
	'change_pass' => 'Nomain&icirc;t paroli',
	'update_success' => 'Profails izmain&icirc;ts',
	'pass_chg_success' => 'Parole nomain&icirc;ta',
	'pass_chg_error' => 'Parole netika nomain&icirc;ta',
);

$lang_register_confirm_email = <<<EOT
Paldies par re&igrave;istr��anos {SITE_NAME}

Lietot&acirc;ja v&acirc;rds : "{USER_NAME}"
Lietot&acirc;ja parole : "{PASSWORD}"

Lai aktiviz�tu savu kontu, nepiecie�ams iel&acirc;d�t zem&acirc;k redzamo lapu.

{ACT_LINK}

Lai veicas,

{SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Apskat&icirc;ties koment&acirc;rus',
	'no_comment' => 'Koment&acirc;ru nav',
	'n_comm_del' => '%s koment&acirc;ri izdz�sti',
	'n_comm_disp' => 'Cik koment&acirc;rus atspogu�ot',
	'see_prev' => 'Iepriek��jie',
	'see_next' => 'N&acirc;kamie',
	'del_comm' => 'Dz�st izv�l�tos koment&acirc;rus',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Mekl�t att�lu kolekcij&acirc;',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Mekl�t jaunus att�lus',
	'select_dir' => 'Izv�l�ties direktoriju',
	'select_dir_msg' => '�&icirc; funkcija �auj pievienot daudzus att�lus vienlaikus, ja tie iepriek� uzlikti ar FTP.<br /><br />Izv�lies direktoriju, kur tika uzlikti att�li',
	'no_pic_to_add' => 'Nav att�lu, ko var�tu pievienot',
	'need_one_album' => 'Lai izmantotu �o funkciju, nepiecie�ams vismaz viens albums',
	'warning' => 'Uzman&icirc;bu',
	'change_perm' => 'nav pieeja direktorijai, tai j&acirc;izmaina ties&icirc;bas (chmod) no 755 uz 777, lai var�tu pievienot att�lus!',
	'target_album' => '<b>Ievietot att�lus &quot;</b>%s<b>&quot; </b>%s',
	'folder' => 'Direktorija',
	'image' => 'Att�ls',
	'album' => 'Albums',
	'result' => 'Rezult&acirc;ti',
	'dir_ro' => 'Nav rakst&icirc;�anas ties&icirc;bu. ',
	'dir_cant_read' => 'Nav las&icirc;�anas ties&icirc;bu. ',
	'insert' => 'Jaunu att�lu pievieno�ana',
	'list_new_pic' => 'Jauno att�lu saraksts',
	'insert_selected' => 'Pievienot izv�l�tos att�lus',
	'no_pic_found' => 'Jauni att�li netika atrasti',
	'be_patient' => 'L&ucirc;dzu esiet paciet&icirc;gi, kam�r tiek pievienoti jaunie att�li',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : att�ls veiksm&icirc;gi pievienots'.
				'<li><b>DP</b> : noz&icirc;m�, ka t&acirc;ds att�ls jau ir datu b&acirc;z�'.
				'<li><b>PB</b> : att�lu nevar pievienot, j&acirc;p&acirc;rbauda pieejas ties&icirc;bas'.
				'<li>Ja OK, DP, PB \'z&icirc;mes\' nepar&acirc;d&acirc;s, j&acirc;klik�&iacute;ina uz att�la, kas par&acirc;d&acirc;s, lai ieg&ucirc;tu detaliz�t&acirc;ku k�&ucirc;das aprakstu'.
				'<li>Ja p&acirc;rl&ucirc;k&acirc; par&acirc;d&acirc;s pazi&ograve;ojums par taimautu, lapa ir j&acirc;p&acirc;rl&acirc;d�'.
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
	'title' => 'Uzlikt att�lu',
	'max_fsize' => 'Max pievienojam&acirc; faila lielums %s KB',
	'album' => 'Albums',
	'picture' => 'Att�ls',
	'pic_title' => 'Att�la virsraksts',
	'description' => 'Att�la apraksts',
	'keywords' => 'Atsl�gas v&acirc;rdi (atdal&icirc;t ar atstarp�m)',
	'err_no_alb_uploadables' => 'Atvaino, nav neviena albuma, kur&acirc; tu var�tu ievietot savus att�lus',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Administr�t lietot&acirc;jus',
	'name_a' => 'V&acirc;rds augo�i',
	'name_d' => 'V&acirc;rds dilsto�i',
	'group_a' => 'Grupa augo�i',
	'group_d' => 'Grupa dilsto�i',
	'reg_a' => 'Reg datums augo�i',
	'reg_d' => 'Reg datums dilsto�i',
	'pic_a' => 'Att�lu skaits augo�i',
	'pic_d' => 'Att�lu skaits dilsto�i',
	'disku_a' => 'Diska atmi&ograve;a augo�i',
	'disku_d' => 'Diska atmi&ograve;a dilsto�i',
	'sort_by' => 'K&acirc;rtot',
	'err_no_users' => 'Lietot&acirc;ju tabul&acirc; nav datu!',
	'err_edit_self' => 'Nemaini te savu profailu, tam izmanto \'Mans profails\'',
	'edit' => 'MODIFIC�T',
	'delete' => 'DZ�ST',
	'name' => 'Lietot&acirc;js',
	'group' => 'Grupa',
	'inactive' => 'Neakt&icirc;vs',
	'operations' => 'Darb&icirc;bas',
	'pictures' => 'Att�li',
	'disk_space' => 'Izmantot&acirc; atmi&ograve;a / Ierobe�ojums',
	'registered_on' => 'Re&igrave;istr�ts',
	'u_user_on_p_pages' => '%d lietot&acirc;ji %d lap&acirc;(s)',
	'confirm_del' => 'Tie�&acirc;m DZ�ST �o lietot&acirc;ju? \\nVisi vi&ograve;a att�li un koment&acirc;ri ar&icirc; tiks izdz�sti',
	'mail' => 'MAIL',
	'err_unknown_user' => 'Izv�l�tais lietot&acirc;js neeksist�!',
	'modify_user' => 'Main&icirc;t datus',
	'notes' => 'Piez&icirc;mes',
	'note_list' => '<li>Ja nev�lies main&icirc;t paroli, atst&acirc;j paroles lauku tuk�u',
	'password' => 'Parole',
	'user_active' => 'Lietot&acirc;js akt&icirc;vs',
	'user_group' => 'Grupa',
	'user_email' => 'Emails',
	'user_web_site' => 'M&acirc;jas lapa',
	'create_new_user' => 'Izveidot',
	'user_location' => 'Atra�an&acirc;s',
	'user_interests' => 'Intereses',
	'user_occupation' => 'Nodarbo�an&acirc;s',
);
?>
