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
//  Translation by Meelis R&uuml;&uuml;tli (m_ryytli@hotmail.com) from estonia         //
// ------------------------------------------------------------------------- //

$lang_charset = 'ISO-8859-4';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Baiti', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('P&uuml;', 'Es', 'Te', 'Ko', 'Ne', 'Re', 'La');
$lang_month = array('Jaanuar', 'Veebruar', 'M&auml;rts', 'Aprill', 'Mai', 'Juuni', 'Juuli', 'August', 'September', 'Oktoober', 'November', 'Detsember');

// Some common strings
$lang_yes = 'Jah';
$lang_no  = 'Ei';
$lang_back = 'TAGASI';
$lang_continue = 'J&Auml;TKA';
$lang_info = 'Info';
$lang_error = 'Viga';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%m/%d/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt =  '%B %d, %Y at %I:%M %p';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
	'random' => 'Juhuslikud pildid',
	'lastup' => 'Viimati lisatud',
	'lastcom' => 'Viimati kommenteeritud',
	'topn' => 'Enim vaadatud',
	'toprated' => 'Edetabel',
	'lasthits' => 'Viimati vaadatud',
	'search' => 'Otsingu tulemused'
);

$lang_errors = array(
	'access_denied' => 'Teil puudub �igus ligip&auml;&auml;suks sellele lehele',
	'perm_denied' => 'Teil puudub �igus teostada antud toimingut.',
	'param_missing' => 'Skript t&auml;itmiseks puuduvad vajalikud parameeterid.',
	'non_exist_ap' => 'Valitud album/pilt puudub!',
	'quota_exceeded' => 'Ketta kvoot &uuml;letatud<br /><br />Teie ruumi kvoot on [quota]KB, teie pildid hetkel kasutavad [space]KB, selle pildi lisamine v�ib &uuml;letada teie kvoodi.',
	'gd_file_type_err' => 'Kasutades GD pilditeeki on lubatud t&uuml;&uuml;bid ainult JPEG ja PNG.',
	'invalid_image' => 'Teie poolt &uuml;leslaaditav pilt on vigane v�i seda ei saa k&auml;itleda GD teegi poolt',
	'resize_failed' => 'V�imatu luua pisipilti v�i kahandada pildi suurust.',
	'no_img_to_display' => 'Pole &uuml;htegi pilti',
	'non_exist_cat' => 'Valitud kategooria puudub',
	'orphan_cat' => 'Kategoorial on olematu juur, j&auml;tka kategooria-halduriga probleemi lahendamiseks.',
	'directory_ro' => 'Kataloog \'%s\' pole kirjutamis�iguslik, pilte ei saa kustutada',
	'non_exist_comment' => 'Valitud kommentaar puudub.',
	'pic_in_invalid_album' => 'Pilt on olematus albumis (%s)!?'
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'Mine albumite loetellu',
	'alb_list_lnk' => 'Albumite loetelu',
	'my_gal_title' => 'Mine minu personaal galeriisse',
	'my_gal_lnk' => 'Minu Galerii',
	'my_prof_lnk' => 'Minu Profiil',
	'adm_mode_title' => 'L&uuml;litu admin moodi',
	'adm_mode_lnk' => 'Admin olek',
	'usr_mode_title' => 'L&uuml;litu kasutaja moodi',
	'usr_mode_lnk' => 'Kasutaja olek',
	'upload_pic_title' => 'Lisa pilt albumisse',
	'upload_pic_lnk' => 'Lisa pilt',
	'register_title' => 'Loo konto',
	'register_lnk' => 'Registreeri',
	'login_lnk' => 'Logi sisse',
	'logout_lnk' => 'Logi v&auml;lja',
	'lastup_lnk' => 'Viimati lisatud',
	'lastcom_lnk' => 'Viimased kommentaarid',
	'topn_lnk' => 'Enim vaadatud',
	'toprated_lnk' => 'Edetabel',
	'search_lnk' => 'Otsing',
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Lisamise kinnitus',
	'config_lnk' => 'Konfig',
	'albums_lnk' => 'Albumid',
	'categories_lnk' => 'Kategooriad',
	'users_lnk' => 'Kasutajad',
	'groups_lnk' => 'Grupid',
	'comments_lnk' => 'Kommentaarid',
	'searchnew_lnk' => 'Lisa "FTP" pilte',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Loo / telli minu albumeid',
	'modifyalb_lnk' => 'Muuda minu albumeid',
	'my_prof_lnk' => 'Minu profiil',
);

$lang_cat_list = array(
	'category' => 'Kategooria',
	'albums' => 'Albumid',
	'pictures' => 'Pildid',
);

$lang_album_list = array(
	'album_on_page' => '%d albumit %d-el lehel'
);

$lang_thumb_view = array(
	'date' => 'KUUP&Auml;EV',
	'name' => 'NIMI',
	'sort_da' => 'Sordi kuup&auml;eva j&auml;rgi kasvavalt',
	'sort_dd' => 'Sordi kuup&auml;eva j&auml;rgi kahanevalt',
	'sort_na' => 'Sordi nime j&auml;rgi kasvavalt',
	'sort_nd' => 'Sordi nime j&auml;rgi kahanevalt',
	'pic_on_page' => '%d pilti on %d-el lehel',
	'user_on_page' => '%d kasutajat on %d-el lehel'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Tagasi pisipiltide lehele',
	'pic_info_title' => 'Kuva/peida pildi info',
	'slideshow_title' => 'Slaidiesitus',
	'ecard_title' => 'Saada see pilt e-kaardina',
	'ecard_disabled' => 'e-kaartid on keelatud',
	'ecard_disabled_msg' => 'Teil pole �igust saata e-kaarte',
	'prev_title' => 'Vaata eelmist pilti',
	'next_title' => 'Vaata j&auml;rgmist pilti',
	'pic_pos' => 'PILT %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Hinda seda pilti ',
	'no_votes' => '(Veel hindamata)',
	'rating' => '(Hetke hinne : %s / 5-st %s h&auml;&auml;lega)',
	'rubbish' => 'R&auml;mps',
	'poor' => 'Armetu',
	'fair' => 'Keskmine',
	'good' => 'Hea',
	'excellent' => 'Imeline',
	'great' => 'fantastiline',
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
	CRITICAL_ERROR => 'Kriitiline viga',
	'file' => 'Fail: ',
	'line' => 'Rida: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Failinimi : ',
	'filesize' => 'Failisuurus : ',
	'dimensions' => 'M��tmed : ',
	'date_added' => 'Lisamise kuup&auml;ev : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s kommentaari',
	'n_views' => '%s kord(a)',
	'n_votes' => '(%s h&auml;&auml;l(t))'
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
	'Exclamation' => 'H&uuml;&uuml;atus',
	'Question' => 'K&uuml;simus',
	'Very Happy' => 'V&auml;ga �nnelik',
	'Smile' => 'Naer',
	'Sad' => 'Kurb',
	'Surprised' => '&Uuml;llatnud',
	'Shocked' => 'Vapustatud',
	'Confused' => 'H&auml;mmeldunud',
	'Cool' => 'Lahe',
	'Laughing' => 'Naerev',
	'Mad' => 'Hull',
	'Razz' => 'Razz',
	'Embarassed' => 'H&auml;bistatud',
	'Crying or Very sad' => 'Nuttev v�i V&auml;ga kurb',
	'Evil or Very Mad' => '�el v�i T&auml;itsa hull',
	'Twisted Evil' => 'Eelarvamuslik �el',
	'Rolling Eyes' => 'Silmap&ouml;&ouml;ritaja',
	'Wink' => 'Silmapilgutus',
	'Idea' => 'Idee',
	'Arrow' => 'Nool',
	'Neutral' => 'Neutraalne',
	'Mr. Green' => 'Mr. Roheline',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'Lahkumine admin olekust...',
	1 => 'Sisenemine admin olekusse...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Albumitel peab olema nimi !',
	'confirm_modifs' => 'Oled kindel, et tahad teha neid muudatusi ?',
	'no_change' => 'Sa ei muutnud midagi !',
	'new_album' => 'Uus album',
	'confirm_delete1' => 'Kindel, et tahad albumit kustutada ?',
	'confirm_delete2' => '\nK�ik siin sisalduvad pildid ja kommentaarid l&auml;hevad kaduma !',
	'select_first' => 'Vali enne album',
	'alb_mrg' => 'Albumi-haldur',
	'my_gallery' => '* Minu Galerii *',
	'no_category' => '* Kategooriata *',
	'delete' => 'Kustuta',
	'new' => 'Uus',
	'apply_modifs' => 'Omista muudatused',
	'select_category' => 'Vali kategooria',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Vajalikud parameetrid \'%s\' toiminguks varustamata !',
	'unknown_cat' => 'Valitud kategooria puudub andmebaasis',
	'usergal_cat_ro' => 'Kasutaja galeriisi ei saa kustutada !',
	'manage_cat' => 'Halda kategooriad',
	'confirm_delete' => 'Oled kindel, et tahad KUSTUTADA seda kategooriat',
	'category' => 'Kategooria',
	'operations' => 'Toimingud',
	'move_into' => 'Liigu',
	'update_create' => 'Uuenda/Loo kategooria',
	'parent_cat' => 'Juurkategooria',
	'cat_title' => 'Kategooria tiitel',
	'cat_desc' => 'Kategooria kirjeldus'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Konfiguratsioon',
	'restore_cfg' => 'Taasta tehase vaikeseaded',
	'save_cfg' => 'Salvesta uus konfiguratsioon',
	'notes' => 'M&auml;rkused',
	'info' => 'Info',
	'upd_success' => 'Konfiguratsioon uuendatud',
	'restore_success' => 'Vaikekonfiguratsioon taastatud',
	'name_a' => 'Nimed kasvavalt',
	'name_d' => 'Nimed kahanevalt',
	'date_a' => 'Kuup&auml;ev kasvavalt',
	'date_d' => 'Kuup&auml;ev kahanevalt'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'&Uuml;ldised seaded',
	array('Galerii nimi', 'gallery_name', 0),
	array('Galrii kirjeldus', 'gallery_description', 0),
	array('Galerii administraatorile epost', 'gallery_admin_email', 0),
	array('Sihtaadress \'Vaata veel pilte\' link e-kaartidel', 'ecards_more_pic_target', 0),
	array('Keel', 'lang', 5),
	array('Teema', 'theme', 6),

	'Albumite loetelu vaade',
	array('Peatabeli laius (pixelites v�i %)', 'main_table_width', 0),
	array('Number kategooria tasandeid kuvamiseks', 'subcat_level', 0),
	array('Number albumeid kuvamiseks', 'albums_per_page', 0),
	array('Number veergusid albumi loeteluks', 'album_list_cols', 0),
	array('pisipildi suurus pixelites', 'alb_list_thumb_size', 0),
	array('Pealehe sisu', 'main_page_layout', 0),

	'Pisipiltide vaade',
	array('Veergude arv pisipiltide lehel', 'thumbcols', 0),
	array('Ridade arv pisipiltide lehel', 'thumbrows', 0),
	array('Maksimaalne lahtrite arv kuvamiseks', 'max_tabs', 0),
	array('Kuva pildi selgitus (lisaks tiitlile) pisipildi all', 'caption_in_thumbview', 1),
	array('Kuva kommentaaraide arv  pisipildi all', 'display_comment_count', 1),
	array('Vaikej&auml;rjestus piltidele', 'default_sort_order', 3),
	array('Minimaalne h&auml;&auml;lte arv pildi sattumiseks \'Edetabel\' nimekirja', 'min_votes_for_rating', 0),

	'Pildivaade &amp; Kommentaaride seaded',
	array('Tabeli laius pildi kuvamiseks (pixelites v�i %)', 'picture_table_width', 0),
	array('Pildi info on vaikimisi n&auml;htav', 'display_pic_info', 1),
	array('Filtreeri pahad s�nad kommentaarides', 'filter_bad_words', 1),
	array('Luba smile\'isi kommentaarides', 'enable_smilies', 1),
	array('Maksimaalne pildikirjelduse pikkus', 'max_img_desc_length', 0),
	array('Maksimaalne number t&auml;hti s�nas', 'max_com_wlength', 0),
	array('Maksimaalne number ridu kommentaaris', 'max_com_lines', 0),
	array('Maksimaalne kommentaari pikkus', 'max_com_size', 0),

	'Piltide ja pisipiltide seaded',
	array('JPEG failide kvaliteet', 'jpeg_qual', 0),
	array('Pisipildi max laius v�i k�rgus <b>*</b>', 'thumb_width', 0),
	array('Loo keskmised pildid','make_intermediate',1),
	array('Keskmiste piltide laius v�i k�rgus <b>*</b>', 'picture_width', 0),
	array('Salvestatud piltide max suurus (KB)', 'max_upl_size', 0),
	array('Salvestatud piltide max laius v�i k�rgus (pixelites)', 'max_upl_width_height', 0),

	'Kasutaja seaded',
	array('Luba uue kasutaja registreerimist', 'allow_user_registration', 1),
	array('Kasutaja registreerimine n�uab eposti-kinnitust', 'reg_requires_valid_email', 1),
	array('Luba kahel kasutajal &uuml;hte-sama eposti aadressi', 'allow_duplicate_emails_addr', 1),
	array('Kasutajatel v�ib olla privaat-albumid', 'allow_private_albums', 1),

	'Kohandatavad v&auml;ljad pildi kirjelduseks (j&auml;ta t&uuml;hjaks kui ei kasuta)',
	array('V&auml;li 1 nimi', 'user_field1_name', 0),
	array('V&auml;li 2 nimi', 'user_field2_name', 0),
	array('V&auml;li 3 nimi', 'user_field3_name', 0),
	array('V&auml;li 4 nimi', 'user_field4_name', 0),

	'Piltide ja pisipiltide lisaseaded',
	array('Faili nimes keelatud t&auml;hem&auml;rgid', 'forbiden_fname_char',0),
	array('Lubatud failit&uuml;&uuml;bid salvestatavatele piltidele', 'allowed_file_extensions',0),
	array('Piltide suurusemuutmise meetod','thumb_method',2),
	array('ImageMagick\'u \'konvertimise\' abiprogrammi tee (n&auml;iteks /usr/bin/X11/)', 'impath', 0),
	array('Lubatud pildit&uuml;&uuml;bid (ainult ImageMagick\'u jaoks)', 'allowed_img_types',0),
	array('K&auml;surea parameetrid ImageMagick\'ule', 'im_options', 0),
	array('Lugeda EXIF andmed JPEG failides', 'read_exif_data', 1),
	array('Albumi kataloog <b>*</b>', 'fullpath', 0),
	array('Kasutajapiltide kataloog <b>*</b>', 'userpics', 0),
	array('Eesliide keskmistele piltidele <b>*</b>', 'normal_pfx', 0),
	array('Eesliide pisipiltidele <b>*</b>', 'thumb_pfx', 0),
	array('Vaikemood kataloogidele', 'default_dir_mode', 0),
	array('Vaikemood piltidele', 'default_file_mode', 0),

	'Pr&auml;&auml;nikud &amp; T&auml;hestiku seaded',
	array('Skripti poolt kasutatava pr&auml;&auml;niku nimi', 'cookie_name', 0),
	array('Skripti poolt kasutatava pr&auml;&auml;niku failitee', 'cookie_path', 0),
	array('T&auml;htekodeering', 'charset', 4),

	'Muud seaded',
	array('V�imalda parandusmood', 'debug_mode', 1),

	'<br /><div align="center">(*) V&auml;ljad m&auml;rgitud *-ga ei pea muutma kui galeriis on juba pilte.</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Sa pead tr&uuml;kkima oma nime ja kommentaari',
	'com_added' => 'Sinu kommentaar lisati',
	'alb_need_title' => 'Sinult oodatakse pealkirja albumile !',
	'no_udp_needed' => 'Uuendust pole vaja.',
	'alb_updated' => 'Album uuendatud',
	'unknown_album' => 'Valitud album puudub v�i sul pole �igusi salvestada sellesse albumisse',
	'no_pic_uploaded' => '&Uuml;htegi pilti ei salvestatud !<br /><br />Kui sul t�esti on valitud pilt salvestamiseks, kontrolli et server lubaks failide salvestamist...',
	'err_mkdir' => 'Viga kataloogi %s loomisel !',
	'dest_dir_ro' => 'Sihtkataloog %s pole skripti poolt kirjutamis�iguslik !',
	'err_move' => 'V�imatu liigutada %s -> %s !',
	'err_fsize_too_large' => 'Sinu poolt salvestatava pildi suurus liiga suur (maksimum lubatud %s x %s) !',
	'err_imgsize_too_large' => 'Sinu poolt salvestatava faili suurus liiga suur (maksimum lubatud %s KB) !',
	'err_invalid_img' => 'Sinu poolt salvestatav fail pole sobiv pilt !',
	'allowed_img_types' => 'Sa v�id salvestada ainult %s pilti.',
	'err_insert_pic' => 'Pilti  \'%s\' ei saa lisada albumisse ',
	'upload_success' => 'Sinu pilt salvestati edukalt<br /><br />See saab n&auml;htavaks p&auml;rast admini heakskiitu.',
	'info' => 'Info',
	'com_added' => 'Kommentaar lisatud',
	'alb_updated' => 'Album uuendatud',
	'err_comment_empty' => 'Sinu kommentaar on t&uuml;hi !',
	'err_invalid_fext' => 'Ainult j&auml;rgmised failit&uuml;&uuml;bid aksepteeritakse : <br /><br />%s.',
	'no_flood' => 'Vabandust, aga sa oled juba selle pildile viimati lisatud kommentaari autor<br /><br />Paranda oma lisatud kommentaari kui soovid seda muuta',
	'redirect_msg' => 'Sind suunatakse &uuml;mber.<br /><br /><br />Klikka \'J&Auml;TKA\' kui lehek&uuml;lg automaatselt ei uuene',
	'upl_success' => 'Sinu pilt edukalt lisatud',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Selgitus',
	'fs_pic' => 'T&auml;is suuruses pilt',
	'del_success' => 'edukalt kustutatud',
	'ns_pic' => 'normaal suuruses pilt',
	'err_del' => 'ei saa kustutada',
	'thumb_pic' => 'pisipilt',
	'comment' => 'kommentaar',
	'im_in_alb' => 'pilt albumis',
	'alb_del_success' => 'Album \'%s\' kustutatud',
	'alb_mgr' => 'Albumi Haldur',
	'err_invalid_data' => 'Vigased andmed laekunud \'%s\'',
	'create_alb' => 'Loon albumit \'%s\'',
	'update_alb' => 'Uuendan albumit \'%s\' pealkirjaga \'%s\' ja indeksiga \'%s\'',
	'del_pic' => 'Kustuta pilt',
	'del_alb' => 'Kustuta album',
	'del_user' => 'Kustuta kasutaja',
	'err_unknown_user' => 'Valitud kasutajat pole olemas !',
	'comment_deleted' => 'Kommentaar edukalt kustutatud',
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
	'confirm_del' => 'Oled kindel, et tahad seda pilti KUSTUTADA ? \\nKommentaarid kustutatakse samuti.',
	'del_pic' => 'KUSTUTA SEE PILT',
	'size' => '%s x %s pixelit',
	'views' => '%s korda',
	'slideshow' => 'Slaidivaade',
	'stop_slideshow' => 'PEATA SLAIDIVAADE',
	'view_fs' => 'Klikka vaatamaks t&auml;issuuruses pilti',
);

$lang_picinfo = array(
	'title' =>'Pildi info',
	'Filename' => 'Failinimi',
	'Album name' => 'Albumi nimi',
	'Rating' => 'Reiting (%s h&auml;&auml;lt)',
	'Keywords' => 'M&auml;rks�nad',
	'File Size' => 'Faili suurus',
	'Dimensions' => 'Dimensioonid',
	'Displayed' => 'Kuvatud',
	'Camera' => 'Kaamera',
	'Date taken' => '&Uuml;lesv�tte kuup&auml;ev',
	'Aperture' => 'Ava',
	'Exposure time' => 'S&auml;ritusaeg',
	'Focal length' => 'Fookuskaugus',
	'Comment' => 'Kommentaar'
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => 'Muuda seda kommentaari',
	'confirm_delete' => 'Oled kindel, et tahad seda kommentaari kustutada ?',
	'add_your_comment' => 'Lisa oma kommentaar',
	'your_name' => 'Sinu nimi',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Saada e-kaart',
	'invalid_email' => '<b>Hoiatus</b> : vigane eposti aadress !',
	'ecard_title' => 'Sulle on e-kaart %s\'lt',
	'view_ecard' => 'Kui e-kaart ei kuva korralikult, klikka seda linki',
	'view_more_pics' => 'Klikka seda linki vaatamaks rohkem pilte !',
	'send_success' => 'Sinu e-kaart on saadetud',
	'send_failed' => 'Vabandust, kuid server ei saa saata sinu e-kaarti...',
	'from' => 'Kellelt',
	'your_name' => 'Sinu nimi',
	'your_email' => 'Sinu eposti aadress',
	'to' => 'Kellele',
	'rcpt_name' => 'Aadressaadi nimi',
	'rcpt_email' => 'Aadressaadi eposti aadress',
	'greetings' => 'Tervitused',
	'message' => 'S�num',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Pildi&nbsp;info',
	'album' => 'Album',
	'title' => 'Pealkiri',
	'desc' => 'Kirjeldus',
	'keywords' => 'M&auml;rks�nad',
	'pic_info_str' => '%sx%s - %sKB - %s vaadet - %s h&auml;&auml;lt',
	'approve' => 'Kinnita pilt',
	'postpone_app' => 'L&uuml;kka kinnitus edasi',
	'del_pic' => 'Kustuta pilt',
	'reset_view_count' => 'Nulli vaadete loendur',
	'reset_votes' => 'Nulli h&auml;&auml;led',
	'del_comm' => 'Kustuta kommendaarid',
	'upl_approval' => 'Salvestuse kinnitus',
	'edit_pics' => 'Paranda pilte',
	'see_next' => 'Vaata j&auml;rgmisi pilte',
	'see_prev' => 'Vaata eelmisi pilte',
	'n_pic' => '%s pilti',
	'n_of_pic_to_disp' => 'Piltide arv kuvamiseks',
	'apply' => 'Omista muudatused'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Gruppi nimi',
	'disk_quota' => 'Ketta kvoot',
	'can_rate' => 'V�ib hinnata pilte',
	'can_send_ecards' => 'V�ib saata e-kaarte',
	'can_post_com' => 'V�ib kommenteerida',
	'can_upload' => 'V�ib salvestada pilte',
	'can_have_gallery' => 'V�ib luua isikliku galerii',
	'apply' => 'Omista muudatused',
	'create_new_group' => 'Loo uus grupp',
	'del_groups' => 'Kustuta valitud grupp(id)',
	'confirm_del' => 'Hoiatus, kui sa kustutad grupi, siis kustutava grupi kasutajad kantakse \'Registereeritud\' gruppi !\n\nTahad sa j&auml;tkata ?',
	'title' => 'Korralda kasutajagruppe',
	'approval_1' => 'Av. salv. kinnitus (1)',
	'approval_2' => 'Isik. salv. kinnitus (2)',
	'note1' => '<b>(1)</b> Salvestused avalikku albumisse vajavad admini kinnitust',
	'note2' => '<b>(2)</b> Salvestused kasutaja albumisse vajavad admini kinnitust',
	'notes' => 'M&auml;rkused'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Teretulemast !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Oled kindel, et tahad seda albumit KUSTUDADA ? \\nK�ik pildid ja kommentaarid kustutakse samuti.',
	'delete' => 'KUSTUTA',
	'modify' => 'OMADUSED',
	'edit_pics' => 'REDIGEERI PILTE',
);

$lang_list_categories = array(
	'home' => 'KODU',
	'stat1' => '<b>[pictures]</b> pilti <b>[albums]</b> albumit ja <b>[cat]</b> kategooriat koos <b>[comments]</b> kommentaariga vaadatud <b>[views]</b> korda',
	'stat2' => '<b>[pictures]</b> pilti <b>[albums]</b> albumit vaadatud <b>[views]</b> korda',
	'xx_s_gallery' => '%s\' Galerii',
	'stat3' => '<b>[pictures]</b> pilti <b>[albums]</b> albumit koos <b>[comments]</b> kommentaariga vaadatud <b>[views]</b> korda'
);

$lang_list_users = array(
	'user_list' => 'Kasutajate loetelu',
	'no_user_gal' => 'Siin pole kasutajate galeriisid',
	'n_albums' => '%s album(it)',
	'n_pics' => '%s pilt(i)'
);

$lang_list_albums = array(
	'n_pictures' => '%s pilt(i)',
	'last_added' => ', viimane lisati %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Logi sisse',
	'enter_login_pswd' => 'Sisenemiseks sisesta kasutajanimi ja parool',
	'username' => 'Kasutajanimi',
	'password' => 'Parool',
	'remember_me' => 'J&auml;ta mind meelde',
	'welcome' => 'Teretulemast %s ...',
	'err_login' => '*** Ei saanud sisse logida. Proovi uuesti ***',
	'err_already_logged_in' => 'Sa oled juba sisse logitud !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Logi v&auml;lja',
	'bye' => 'Head aega, %s ...',
	'err_not_loged_in' => 'Sa pole sisse logitud !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Uuenda album %s',
	'general_settings' => '&Uuml;ldised seaded',
	'alb_title' => 'Albumi pealkiri',
	'alb_cat' => 'Albumi kategooria',
	'alb_desc' => 'Albumi kirjeldus',
	'alb_thumb' => 'Albumi pisipilt',
	'alb_perm' => '�igused sellele albumile',
	'can_view' => 'Albumit v�ivad vaadata',
	'can_upload' => 'K&uuml;lastajad v�ivad salvestada pilte',
	'can_post_comments' => 'K&uuml;lastajad v�ivad kommenteerida',
	'can_rate' => 'K&uuml;lastajad v�ivad hinnata pilte',
	'user_gal' => 'Kasutaja Galerii',
	'no_cat' => '* Kategooriata *',
	'alb_empty' => 'Album on t&uuml;hi',
	'last_uploaded' => 'Viimati salvestatud',
	'public_alb' => 'Iga&uuml;ks (avalik album)',
	'me_only' => 'Ainult mina',
	'owner_only' => 'Albumi omanik (%s) ainult',
	'groupp_only' => 'Grupi \'%s\' liikmed',
	'err_no_alb_to_modify' => '&Uuml;htegi albumit sa ei saa muuta andmebaasis.',
	'update' => 'Uuenda album'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Vabandust, aga sa oled juba seda pilti hinnanud',
	'rate_ok' => 'Sinu h&auml;&auml;l vastu v�etud',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Kuigi saidi {SITE_NAME} administraatorid p&uuml;&uuml;avad eemaldada v�i muuta mistahes &uuml;ldiselt pahaks-pandavad materjalid niipea kui v�imalik, pole v�imalik nendegi poolt kohe n&auml;ha iga postitust. Seet�ttu pead tunnistama, et k�ik postitused, mis siia kiirv&auml;ljaandesse tehakse (pildid, kommentaarid, arvamused) teiste autorite poolt, nende eest administraatorid ja webmasterid ei saa vastutada (v&auml;ljaarvatud nende endi postitused).<br />
<br />
Sa n�ustud mitte postitama s�imu, roppusi, r�vedusi, laimu, solvanguid, &auml;hvardusi, soolisi- ega muid m&auml;rkusi ja kommentaare ning materjale, mis oleksid vastuolus kehtivate seadustega. Sa n�ustud et webmaster, administraator ja saidi {SITE_NAME} vahekohtunikud omavad �igust kustutada v�i parandada mistahes sisu kuidas ja millal neile sobib. Kasutajana sa n�ustud, et kogu sinu &uuml;lal sisestatud info salvestatakse andmebaasi. Kuigi seda infot ei avaldata kolmandatele isikutele ilma sinu n�usolekuta, ei saa webmaster ja administraator v�tta endale vastutust  h&auml;kkimiskatsete eest, mis v�ivad andmed ohtu seada.<br />
<br />
See sait kasutab pr&auml;&auml;nikuid slavestamaks infot sinu lokaalses arvutis. Need pr&auml;&auml;nikud on m�eldud ainult t�stmaks sinu vaatamise r��mu. Eposti aadressi kasutatakse ainult kinnitamaks sinu registreerumise detaile ja parooli.<br />
<br />
Kilkates 'Olen n�us' allpool, n�ustud sa nende n�uete ja tingimustega.
EOT;

$lang_register_php = array(
	'page_title' => 'Kasutaja registreerimine',
	'term_cond' => 'Terminid ja tingimused',
	'i_agree' => 'Olen n�us',
	'submit' => 'Saada registreerimine',
	'err_user_exists' => 'Sinu siseatud kasutajanimi juba olemas, palun vali muu',
	'err_password_mismatch' => 'Kaks parooli ei lange kokku, palun sisesta nad uuesti',
	'err_uname_short' => 'Kasutajanimi peab olema v&auml;hemalt 2 t&auml;hte',
	'err_password_short' => 'Parool peab olema v&auml;hemalt 2 t&auml;hte',
	'err_uname_pass_diff' => 'Kasutajanimi peab paroolist erinema',
	'err_invalid_email' => 'Eposti aadress vigane',
	'err_duplicate_email' => 'Keegi on juba registreerunud sinu sisestatud eposti aadressiga',
	'enter_info' => 'Sisesta registreerimisinfo',
	'required_info' => 'Vajalik info',
	'optional_info' => 'Vabatahtlik info',
	'username' => 'Kasutajanimi',
	'password' => 'Parool',
	'password_again' => 'Parool uuesti',
	'email' => 'Epost',
	'location' => 'Elukoht',
	'interests' => 'Huvid',
	'website' => 'Kodukas',
	'occupation' => 'Elukutse',
	'error' => 'VIGA',
	'confirm_email_subject' => '%s - Registreerumise kinnitus',
	'information' => 'Info',
	'failed_sending_email' => 'Reigistreerumise kinnituse eposti ei saa saata !',
	'thank_you' => 'T&auml;name Teid registreerumast.<br /><br />Epost infoga, kuidas oma kontot aktiveerida, saadeti sinu antud eposti aadressile.',
	'acct_created' => 'Sinu konto on loodud ja n&uuml;&uuml;d sa v�id sisse logida oma kasutajanime ja parooliga',
	'acct_active' => 'Sinu konto on n&uuml;&uuml;d aktiveeritud ja sa v�id sisse logida oma kasutajanime ja parooliga',
	'acct_already_act' => 'Sinu konto on juba aktiivne !',
	'acct_act_failed' => 'Seda kontot ei saa aktiveerida !',
	'err_unk_user' => 'Valitud kasutaja puudub !',
	'x_s_profile' => '%s\'i profiil',
	'group' => 'Grupp',
	'reg_date' => 'Liitutud',
	'disk_usage' => 'Ketta kasutus',
	'change_pass' => 'Muuda parooli',
	'current_pass' => 'Praegune parool',
	'new_pass' => 'Uus parool',
	'new_pass_again' => 'Uus parool veelkord',
	'err_curr_pass' => 'Praegune parool on vale',
	'apply_modif' => 'Omista muudatused',
	'change_pass' => 'Muuda minu parool',
	'update_success' => 'Sinu profiil on uuendatud',
	'pass_chg_success' => 'Sinu parool on muudetud',
	'pass_chg_error' => 'Sinu parooli ei muudetud',
);

$lang_register_confirm_email = <<<EOT
T&auml;name sind registreerumast {SITE_NAME}\'s

Sinu kasutajanimi on : "{USER_NAME}"
Sinu parool on : "{PASSWORD}"

J&auml;rgnevalt et aktiveerida oma konto, pead klikkama lingile allpool
v�i kopeeri ja kleebi see oma weebisirvijasse.

{ACT_LINK}

Tervitustega,

{SITE_NAME} juhtkond

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Kommentaaride &uuml;levaade',
	'no_comment' => 'Siin pole &uuml;htegi kommentaari &uuml;le vaadata',
	'n_comm_del' => '%s kommentaar(i) kustutatud',
	'n_comm_disp' => 'Kommentaaride arv kuvamiseks',
	'see_prev' => 'Vaata eelmist',
	'see_next' => 'Vaata j&auml;rgmist',
	'del_comm' => 'Kustuta valitud kommentaarid',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Otsi pildikogumikku',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Otsi uusi pilte',
	'select_dir' => 'Vali kataloog',
	'select_dir_msg' => 'See funktsioon lubab sul lisada kogumiku pilte, mis sa oled salvestanud oma serverisse FTP\'ga.<br /><br />Vali kataloog kuhu sa oma pildid oled salvestanud',
	'no_pic_to_add' => 'Siin pole pilte lisada',
	'need_one_album' => 'Sa vajad v&auml;hemalt &uuml;hte albumit selle funktsiooni kasutamiseks',
	'warning' => 'Hoiatus',
	'change_perm' => 'see skript ei saa kirjutada sellesse kataloogi, sa pead muutma selle �igusi (mood 755 v�i 777) enne kui &uuml;ritad uuesti lisada pilte !',
	'target_album' => '<b>Pane &quot;</b>%s<b>&quot; pildid albumisse </b>%s',
	'folder' => 'Kaust',
	'image' => 'Pilt',
	'album' => 'Album',
	'result' => 'Tulemus',
	'dir_ro' => 'Pole kirjutatav. ',
	'dir_cant_read' => 'Pole loetav. ',
	'insert' => 'Lisan uued pildid galeriisse',
	'list_new_pic' => 'Uute piltide loetelu',
	'insert_selected' => 'Lisa valitud pildid',
	'no_pic_found' => 'Ei leitud uusi pilte',
	'be_patient' => 'Palun ole kannatlik, skript vajab piltide lisamiseks aega',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : t&auml;hendab, et pilt lisati edukalt'.
				'<li><b>DP</b> : t&auml;hendab, et pilt on dublikaat ja sisaldub juba andmebaasis'.
				'<li><b>PB</b> : t&auml;hendab, et pilti ei saa lisada, kontrolli oma seadeid ja kataloogi �igusi kus su pildid asuvad'.
				'<li>Kui m&auml;rgid \'OK, DP, PB\' ei ilmu, klikka katkenud pildil n&auml;gemaks mistahes PHP poolt antud veateadet'.
				'<li>Kui su sirvijal on \'timeout\', vajuta reload nuppu'.
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
	'title' => 'Salvesa pilt',
	'max_fsize' => 'Maksimaalne lubatud failisuurus on %s KB',
	'album' => 'Album',
	'picture' => 'Pilt',
	'pic_title' => 'Pildi pealkiri',
	'description' => 'Pildi kirjeldus',
	'keywords' => 'M&auml;rks�nad (eralda t&uuml;hikutega)',
	'err_no_alb_uploadables' => 'Vabandust, kuid siin pole albumit kuhu sul oleks piltide salvestamine lubatud',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Halda kasutajaid',
	'name_a' => 'Nimed kasvavalt',
	'name_d' => 'Nimed kahanevalt',
	'group_a' => 'Grupid kasvavalt',
	'group_d' => 'Grupid kahanevalt',
	'reg_a' => 'Reg kuup&auml;ev kasvavalt',
	'reg_d' => 'Reg kuup&auml;ev kahanevalt',
	'pic_a' => 'Piltide arv kasvavalt',
	'pic_d' => 'Piltide arv kahanevalt',
	'disku_a' => 'Ketta kasutus kasvavalt',
	'disku_d' => 'Ketta kasutus kahanevalt',
	'sort_by' => 'Sordi kasutajaid',
	'err_no_users' => 'Kasutajate tabel t&uuml;hi !',
	'err_edit_self' => 'Sa v�id muuta oma profiili, kasuta \'Minu profiil\' linki selleks',
	'edit' => 'MUUDA',
	'delete' => 'KUSTUTA',
	'name' => 'Kasutajanimi',
	'group' => 'Grupp',
	'inactive' => 'Mitteaktiivne',
	'operations' => 'Funktsioonid',
	'pictures' => 'Pildid',
	'disk_space' => 'Kasutatud ruumi / Kvoot',
	'registered_on' => 'Registreeritud',
	'u_user_on_p_pages' => '%d kasutajat %d-el lehel',
	'confirm_del' => 'Oled kindel, et tahad selle kasutaja KUSTUTADA ? \\nK�ik tema pildid ja albumid kustutatakse samuti.',
	'mail' => 'POST',
	'err_unknown_user' => 'Valitud kasutajat pole !',
	'modify_user' => 'Muuda kasutaja',
	'notes' => 'M&auml;rkused',
	'note_list' => '<li>Kui sa ei taha muuta kasutuselolevat parooli, j&auml;ta "parool" v&auml;li t&uuml;hjaks',
	'password' => 'Parool',
	'user_active' => 'Kasutaja aktiivne',
	'user_group' => 'Kasutaja grupp',
	'user_email' => 'Kasutaja epost',
	'user_web_site' => 'Kasutaja kodukas',
	'create_new_user' => 'Loo uus kasutaja',
	'user_location' => 'Kasutaja elukoht',
	'user_interests' => 'Kasutaja huvid',
	'user_occupation' => 'Kasutaja elukutse',
);
?>
