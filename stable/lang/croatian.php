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
'lang_name_english' => 'Croatian',  
'lang_name_native' => 'Hrvatski', 
'lang_country_code' => 'hr', 
'trans_name'=> 'Webfrater', //the name of the translator - can be a nickname 
'trans_email' => 'veritas@veritas.com.hr', //translator's email address (optional) 
'trans_website' => 'http://www.veritas.com.hr/', //translator's website (optional) 
'trans_date' => '2003-10-12', //the date the translation was created / last modified 
); 

$lang_charset = 'iso-8859-2';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('ned', 'pon', 'uto', 'sri', '�et', 'pet', 'sub');
$lang_month = array('sij', 'velj', 'o�u', 'tra', 'svi', 'lip', 'srp', 'kol', 'ruj', 'lis', 'stu', 'pro');

// Some common strings
$lang_yes = 'Da';
$lang_no  = 'Ne';
$lang_back = 'NATRAG';
$lang_continue = 'NAPRIJED';
$lang_info = 'Informacija';
$lang_error = 'Pogre�ka';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%d/%m/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt =  '%B %d, %Y at %I:%M %p';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array( 
        'random' => 'Slu�ajno odabrana slika', 
        'lastup' => 'Posljednje dodano', 
        'lastalb'=> 'Posljednji obnovljeni album', 
        'lastcom' => 'Posljednji komentari', 
        'topn' => 'Najgledanije', 
        'toprated' => 'Najbolje ocijenjeno', 
        'lasthits' => 'Posljednje pogledano', 
        'search' => 'Rezultati pretra�ivanja', 
        'favpics'=> 'Omiljene slike', 
);

$lang_errors = array(
	'access_denied' => 'Ne mo�ete pristupiti ovoj stranici.',
	'perm_denied' => 'Nemate dopu�tenje izvr�iti tu operaciju.',
	'param_missing' => 'Skripta je pozvana bez obveznih parametara.',
	'non_exist_ap' => 'Izabrani album/slika vi�e ne postoji !',
	'quota_exceeded' => 'Disk kvota prekora�ena<br /><br />Imate dozvoljenu kvotu od [quota]K, va�e slike zauzimaju [space]K, dodavanjem ove slike prelazite dozvoljenu kvotu.',
	'gd_file_type_err' => 'Ukoliko kotristite GD, dopu�teni formati slika su samo JPG i PNG.',
	'invalid_image' => 'Slika koju ste uploadali nije u redu, ili se ne mo�e obraditi u GD-u',
	'resize_failed' => 'Nije mogu�e napraviti manju sli�icu.',
	'no_img_to_display' => 'Nema slike za prikaz',
	'non_exist_cat' => 'Izabrana kategorija ne postoji',
	'orphan_cat' => 'Kategorija ne postoji, pokrenite organizator kategorija da bi rije�ili problem.',
	'directory_ro' => 'Direktoriju \'%s\' nije dodjeljen writable status, slike se ne mogu izbrisati',
	'non_exist_comment' => 'Odabrani komentar ne postoji.',
	'pic_in_invalid_album' => 'Slika je u nepostoje�em albumu (%s)!?',
        'banned' => 'Vama je zabranjeno koristiti ovaj site.', 
        'not_with_udb' => 'Ova funkcija nije omogu�ena u galeriji Coppermine jer se nalazi integrirana u software za forum. To �to poku�avate napraviti nije podr�ano u ovoj konfiguraciji, ili se mo�e jedino napraviti koriste�i software za forum.', 
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'Idi na popis albuma',
	'alb_list_lnk' => 'Popis albuma',
	'my_gal_title' => 'Idi na moju osobnu galeriju',
	'my_gal_lnk' => 'Moja galerija',
	'my_prof_lnk' => 'Moj profil',
	'adm_mode_title' => 'Prebaci na admin mod',
	'adm_mode_lnk' => 'Admin mod',
	'usr_mode_title' => 'Prebaci na korisni�ki mod',
	'usr_mode_lnk' => 'Korisni�ki mod',
	'upload_pic_title' => 'Uploadaj sliku u album',
	'upload_pic_lnk' => 'Upload sliku',
	'register_title' => 'Kreiraj account',
	'register_lnk' => 'Registracija',
	'login_lnk' => 'Ulaz',
	'logout_lnk' => 'Izlaz',
	'lastup_lnk' => 'Posljednje dodano',
	'lastcom_lnk' => 'Posljednji komentari',
	'topn_lnk' => 'Najgledanije',
	'toprated_lnk' => 'Visoko rangirano',
	'search_lnk' => 'Pretra�ivanje',
        'fav_lnk' => 'Moje omiljene slike', 
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Dopu�tenje uploada',
	'config_lnk' => 'Konfiguracija',
	'albums_lnk' => 'Albumi',
	'categories_lnk' => 'Kategorije',
	'users_lnk' => 'Korisnici',
	'groups_lnk' => 'Grupe',
	'comments_lnk' => 'Komentari',
	'searchnew_lnk' => 'Prebacivanje',
        'util_lnk' => 'Promijeni veli�inu slike', 
        'ban_lnk' => 'Zabrani pristup korisnicima', 
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Kreiraj / poredaj moje albume',
	'modifyalb_lnk' => 'Prepravi moje albume',
	'my_prof_lnk' => 'Moj profil',
);

$lang_cat_list = array(
	'category' => 'Kategorija',
	'albums' => 'Albumi',
	'pictures' => 'Slike',
);

$lang_album_list = array(
	'album_on_page' => '%d albuma na %d stranici'
);

$lang_thumb_view = array(
	'date' => 'DATUM',
        //Sort by filename and title 
        'name' => 'NAZIV DOKUMENTA', 
        'title' => 'NASLOV', 
	'sort_da' => 'Poredaj po datumu novije',
	'sort_dd' => 'Poredaj po datumu starije',
	'sort_na' => 'Poredaj po nazivu novije',
	'sort_nd' => 'Poredaj po nazivu starije',
        'sort_ta' => 'Razvrstaj prema nazivu po�ev�i od po�etka', 
        'sort_td' => 'Razvrstaj prema nazivu po�ev�i od kraja', 
	'pic_on_page' => '%d slika na %d stranici',
	'user_on_page' => '%d korisnika na %d stranici'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Povratak na sli�ice',
	'pic_info_title' => 'Poka�i/sakrij info o fotografiji',
	'slideshow_title' => 'Slideshow',
	'ecard_title' => 'Po�aljite ovu sliku kao razglednicu',
	'ecard_disabled' => 'Razglednica je isklju�ena',
	'ecard_disabled_msg' => 'Ne mo�ete poslati razglednicu',
	'prev_title' => 'Pogledajte prethodnu sliku',
	'next_title' => 'Pogledajte slijede�u sliku',
	'pic_pos' => 'SLIKA %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Ocijenite ovu fotografiju ',
	'no_votes' => '(Jo� nema ocjena)',
	'rating' => '(trenute ocjene : %s / 5 sa %s glasova)',
	'rubbish' => 'Jako lo�e',
	'poor' => 'Slabo',
	'fair' => 'Prosje�no',
	'good' => 'Dobro',
	'excellent' => 'Odli�no',
	'great' => 'Prekrasno',
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
	CRITICAL_ERROR => 'Kriti�na pogre�ka',
	'file' => 'Datoteka: ',
	'line' => 'Linija: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Naziv datoteke : ',
	'filesize' => 'Veli�ina : ',
	'dimensions' => 'Dimenzije : ',
	'date_added' => 'Dodano : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s komentara',
	'n_views' => '%s pregleda',
	'n_votes' => '(%s glasova)'
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
	'Exclamation' => 'Uzvik',
	'Question' => 'Pitanje',
	'Very Happy' => 'Jako sretan',
	'Smile' => 'Osmjeh',
	'Sad' => 'Tu�an',
	'Surprised' => 'Iznena�en',
	'Shocked' => '�okiran',
	'Confused' => 'Zbunjen',
	'Cool' => 'Cool',
	'Laughing' => 'Smijeh',
	'Mad' => 'Bijesan',
	'Razz' => 'Va�an',
	'Embarassed' => 'Posti�en',
	'Crying or Very sad' => 'Jako tu�an',
	'Evil or Very Mad' => 'Zao',
	'Twisted Evil' => 'Izopa�en',
	'Rolling Eyes' => 'Kotrljaju�e o�i',
	'Wink' => 'Mig',
	'Idea' => 'Ideja',
	'Arrow' => 'Strjelica',
	'Neutral' => 'Neutralan',
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
	0 => 'Napu�tanje administratorskog moda...',
	1 => 'Ulaz u administratorski mod...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Morate upisati ime albuma !',
	'confirm_modifs' => 'Da li ste sigurni da �elite napraviti izmjene ?',
	'no_change' => 'Niste napravili nikakvu promjenu !',
	'new_album' => 'Novi album',
	'confirm_delete1' => 'Da li ste sigurni da �elite izbrisati ovaj album ?',
	'confirm_delete2' => '\nSve slike i komentari koji su tu biti �e izbrisani !',
	'select_first' => 'Prvo izaberite album',
	'alb_mrg' => 'Organizacija albuma',
	'my_gallery' => '* Moja galerija *',
	'no_category' => '* Nema kategorija *',
	'delete' => 'Izbri�i',
	'new' => 'Novo',
	'apply_modifs' => 'Napravi promjene',
	'select_category' => 'Izaberi kategoriju',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Parametri obavezni za \'%s\'naredba nije izvr�ena !',
	'unknown_cat' => 'Izabrana kategorija ne postoji u bazi podataka',
	'usergal_cat_ro' => 'Korisni�ka kategorija se ne mo�e brisati !',
	'manage_cat' => 'Organiziraj kategorije',
	'confirm_delete' => 'Da li ste sigurni da �elite IZBRISATI ovu kategoriju',
	'category' => 'Kategorija',
	'operations' => 'Naredbe',
	'move_into' => 'Prebaci u',
	'update_create' => 'Osvje�i/Napravi kategoriju',
	'parent_cat' => 'Osnovna kategorija',
	'cat_title' => 'Naziv kategorije',
	'cat_desc' => 'Opis kategorije'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Konfiguracija',
	'restore_cfg' => 'Vrati na osnovnu konfiguraciju',
	'save_cfg' => 'Snimi novu konfiguraciju',
	'notes' => 'Napomena',
	'info' => 'Informacija',
	'upd_success' => 'Konfiguracija je osvje�ena',
	'restore_success' => 'Osnova konfiguracija je vra�ena',
	'name_a' => 'Naziv novije',
	'name_d' => 'Naziv starije',
        'title_a' => 'Naslov razvrstan ascending', 
        'title_d' => 'Naslov razvrstan descending', 
	'date_a' => 'Datum novije',
	'date_d' => 'Datum starije',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Osnovno pode�avanje',
	array('Naziv galerije', 'gallery_name', 0),
	array('Opis galerije', 'gallery_description', 0),
	array('E-Mail administratora galerije', 'gallery_admin_email', 0),
	array('Krajnja adresa za \'See more pictures\' link u razglednicama', 'ecards_more_pic_target', 0),
	array('Jezik', 'lang', 5),
	array('Predlo�ak', 'theme', 6),

	'Album list view',
	array('�irina glavne tablice (pikseli ili %)', 'main_table_width', 0),
	array('Broj nivoa kategorija za prikaz', 'subcat_level', 0),
	array('Broj albuma za prikaz', 'albums_per_page', 0),
	array('Broj stupaca za listu albuma', 'album_list_cols', 0),
	array('Veli�ina sli�ice u pikselima', 'alb_list_thumb_size', 0),
	array('Sadr�aj naslovne stranice', 'main_page_layout', 0),
        array('Show first level album thumbnails in categories','first_level',1),  

	'Thumbnail view',
	array('Broj stupaca na stranici sa sli�icama', 'thumbcols', 0),
	array('Broj redova na stranici sa sli�icama', 'thumbrows', 0),
	array('Maximum number of tabs to display', 'max_tabs', 0),
	array('Display picture caption (in addition to title) below the thumbnail', 'caption_in_thumbview', 1),
	array('Poka�i broj komentara ispod sli�ice', 'display_comment_count', 1),
	array('Default sort order for pictures', 'default_sort_order', 3),
	array('Minimum number of votes for a picture to appear in the \'top-rated\' list', 'min_votes_for_rating', 0),

	'Image view &amp; Comment settings',
	array('�irina tablice za prikaz slike (pixels or %)', 'picture_table_width', 0),
	array('Informacije o slici se vide po dafaultu', 'display_pic_info', 1),
	array('Izbaci ru�ne rije�i u komentarima', 'filter_bad_words', 1),
	array('Omogu�i smje�ke u komentarima', 'enable_smilies', 1),
	array('Max du�ina za opis slike', 'max_img_desc_length', 0),
	array('Max broj znakova u rije�i', 'max_com_wlength', 0),
	array('Max broj linija u komentaru', 'max_com_lines', 0),
	array('Max du�ina komentara', 'max_com_size', 0),
        array('Poka�i film strip', 'display_film_strip', 1), 
        array('Broj sli�ica u film stripu', 'max_film_strip_items', 0), 

	'Pictures and thumbnails settings',
	array('Kvalitet za JPEG slike', 'jpeg_qual', 0),
        array('Max dimenzija sli�ice <b>*</b>', 'thumb_width', 0), 
        array('Kori�tena veli�ina ( width or height or Max aspect for thumbnail )<b>*</b>', 'thumb_use', 7), 
	array('Napravi srednje-velike slike','make_intermediate',1),
	array('Max �irina ili visina srednje-velike slike <b>*</b>', 'picture_width', 0),
	array('Max veli�ina za uploadane slike (KB)', 'max_upl_size', 0),
	array('Max �irina ili visina za uploadane slike (pixels)', 'max_upl_width_height', 0),

	'User settings',
	array('�elite li dopustiti registraciju novih korisnika', 'allow_user_registration', 1),
	array('Za registraciju novih korisnika potrebna je e-mail potvrda', 'reg_requires_valid_email', 1),
	array('�elite li dopustiti da dva korisnika imaju istu email adresu', 'allow_duplicate_emails_addr', 1),
	array('Mogu li korisnici imati osobne albume', 'allow_private_albums', 1),

	'Custom fields for image description (leave blank if unused)',
	array('Field 1 name', 'user_field1_name', 0),
	array('Field 2 name', 'user_field2_name', 0),
	array('Field 3 name', 'user_field3_name', 0),
	array('Field 4 name', 'user_field4_name', 0),

	'Pictures and thumbnails advanced settings',
        array('Poka�i ikonu osobnih albuma nelogiranom korisniku','show_private',1), 
	array('Znakovi zabranjeni u imenima dokumenata', 'forbiden_fname_char',0),
	array('Dopu�teni do�eci dokumenata za upload slike', 'allowed_file_extensions',0),
	array('Metoda za mijenjanje veli�ine slike','thumb_method',2),
	array('Put do ImageMagick \'convert\' programa (example /usr/bin/X11/)', 'impath', 0),
	array('Dopu�tene vrste slika (vrijedi samo za ImageMagick)', 'allowed_img_types',0),
	array('Opcije komandne linije za ImageMagick', 'im_options', 0),
	array('Pro�itaj EXIF podatke u JPEG dokumentima', 'read_exif_data', 1),
	array('Album direktorij <b>*</b>', 'fullpath', 0),
	array('Direktorij za korisni�ke slike <b>*</b>', 'userpics', 0),
	array('Prefix za srednje-velike slike <b>*</b>', 'normal_pfx', 0),
	array('Prefix za sli�ice <b>*</b>', 'thumb_pfx', 0),
	array('Default mode za direktorije', 'default_dir_mode', 0),
	array('Default mode za slike', 'default_file_mode', 0),

	'Cookies &amp; Charset settings',
	array('Naziv cookie-ja kori�tenog u skripti', 'cookie_name', 0),
	array('Put cookie-ja kori�tenog u skripti', 'cookie_path', 0),
	array('Character encoding', 'charset', 4),

	'Miscellaneous settings',
	array('Enable debug mode', 'debug_mode', 1),

	'<br /><div align="center">(*) Fields marked with * must not be changed if you already have pictures in your gallery</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Trebate upisati svoje ime i komentar',
	'com_added' => 'Va� komentar je dodan',
	'alb_need_title' => 'Morate upisati naziv za album !',
	'no_udp_needed' => 'Nije potrebno osvje�avanje.',
	'alb_updated' => 'Album je osvje�en',
	'unknown_album' => 'Izabrani album ne postoji ili nemate dopu�tenje za upload u ovaj album',
	'no_pic_uploaded' => 'Slika nije dodana !<br /><br />Ako ste zaista izabrali sliku za upload, onda je do�lo do gre�ke...',
	'err_mkdir' => 'Nije mogu�e napraviti direktorij %s !',
	'dest_dir_ro' => 'Odabrani direktorij nije writable po skripti !',
	'err_move' => 'Ne mo�e se prebaciti %s u %s !',
	'err_fsize_too_large' => 'Dimenzije slike koju uploadate je prevelika (maksimalno dozvoljeno je %s x %s) !',
	'err_imgsize_too_large' => 'Veli�ina koju uploadate je prevelika (maksimalno dozvoljeno je %s KB) !',
	'err_invalid_img' => 'Datoteka koju uploadate nije  u dopu�tenom formatu slike !',
	'allowed_img_types' => 'Mo�ete uploadati samo %s slika.',
	'err_insert_pic' => 'Slika \'%s\' (ne)mo�e biti dodana u album ',
	'upload_success' => 'Va�a slika je uploadana uspje�no<br /><br />Slika �e biti vidljiva nakon administratovog dopu�tenja.',
	'info' => 'Informacija',
	'com_added' => 'Komentar dodan',
	'alb_updated' => 'Album osvje�en',
	'err_comment_empty' => 'Prostor za komentar je prazan !',
	'err_invalid_fext' => 'Samo datoteke sa slijede�im ekstenzijama su prihvatljive : <br /><br />%s.',
	'no_flood' => '�ao nam je, vi ste ve� autor posljednjeg komentara upisanog za ovu sliku<br /><br />Izmijenite komentar koji ste poslali ako �elite promijeniti komentar o slici',
	'redirect_msg' => 'Biti �ete preba�eni.<br /><br /><br />Klinki \'CONTINUE\' ako se stranica ne osvje�i automatski',
	'upl_success' => 'Slika uspje�no dodana',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Naziv',
	'fs_pic' => 'Puna veli�ina slike',
	'del_success' => 'Uspje�no',
	'ns_pic' => 'Normalna veli�ina slike',
	'err_del' => 'Ne mo�e biti izbrisano',
	'thumb_pic' => 'Sli�ica',
	'comment' => 'Komentar',
	'im_in_alb' => 'Slika u albumu',
	'alb_del_success' => 'Album \'%s\' izbrisan',
	'alb_mgr' => 'Organizator albuma',
	'err_invalid_data' => 'Neto�ni podaci primljeni u \'%s\'',
	'create_alb' => 'Kreiranje albuma \'%s\'',
	'update_alb' => 'Osvje�avanje albuma \'%s\' sa malo \'%s\' i index \'%s\'',
	'del_pic' => 'Izbri�i sliku',
	'del_alb' => 'Izbri�i album',
	'del_user' => 'Izbri�i korisnika',
	'err_unknown_user' => 'Izabrani korisnik ne postoji !',
	'comment_deleted' => 'Komentar uspje�no izbrisan',
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
	'confirm_del' => 'Da li sigurno �elite IZBRISATI ovu sliku ? \\nKomentari �e tako�er biti izbrisani.',
	'del_pic' => 'IZBRI�I OVU SLIKU',
	'size' => '%s x %s pixela',
	'views' => '%s puta',
	'slideshow' => 'Slideshow',
	'stop_slideshow' => 'ZAUSTAVI SLIDESHOW',
	'view_fs' => 'Kliknite da vidite u punoj veli�ini',
);

$lang_picinfo = array(
	'title' =>'Informacije o slici',
	'Filename' => 'Ime datoteke',
	'Album name' => 'Ime albuma',
	'Rating' => 'Ocjena (%s glasova)',
	'Keywords' => 'Klju�ne rije�i',
	'File Size' => 'Veli�ina datoteke',
	'Dimensions' => 'Dimenzije',
	'Displayed' => 'Prikazano',
	'Camera' => 'Kamera',
	'Date taken' => 'Datum snimanja',
	'Aperture' => 'Otvor',
	'Exposure time' => 'Vrijeme izlaganja',
	'Focal length' => 'Udaljenost od centra',
        'Comment' => 'Komentar', 
        'addFav'=>'Dodaj u omiljene slike', 
        'addFavPhrase'=>'Omiljene slike', 
        'remFav'=>'Odstrani iz omiljenih slika', 
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => 'Izmijeni ovaj komentar',
	'confirm_delete' => 'Jeste li sigurni da �elite izbrisati ovaj komentar ?',
	'add_your_comment' => 'Dodajte svoj komentar',
        'name'=>'Ime', 
        'comment'=>'Komentar', 
        'your_name' => 'Va�e ime', 
);

$lang_fullsize_popup = array( 
        'click_to_close' => 'Kliknite sliku kako biste zatvorili prozor', 
); 

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Po�aljite ovu e-razglednicu',
	'invalid_email' => '<b>Ops</b> : Neispravna email adresa !',
	'ecard_title' => 'Razglednica od %s za Vas',
	'view_ecard' => 'Ako razglednica nije prikazana ispravno, kliknite na ovaj link',
	'view_more_pics' => 'Kliknite na ovaj link da vidite vi�e slika !',
	'send_success' => 'Va�a razglednica je poslana',
	'send_failed' => '�ao nam je, ali server ne mo�e poslati va�u razglednicu...',
	'from' => 'Od',
	'your_name' => 'Va�e ime',
	'your_email' => 'Va�a email adresa',
	'to' => 'Za',
	'rcpt_name' => 'Ime primatelja',
	'rcpt_email' => 'Email adresa primatelja',
	'greetings' => 'Naslov',
	'message' => 'Poruka',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Slika&nbsp;info',
	'album' => 'Album',
	'title' => 'Naslov',
	'desc' => 'Opis',
	'keywords' => 'Klju�ne rije�i',
	'pic_info_str' => '%sx%s - %sKB - %s pregleda - %s glasova',
	'approve' => 'Odobrite sliku',
	'postpone_app' => 'Odgodi odobrenje',
	'del_pic' => 'Izbri�ite sliku',
	'reset_view_count' => 'Osvje�ite broja� pregleda',
	'reset_votes' => 'Osvje�ite glasove',
	'del_comm' => 'Izbri�ite komentare',
	'upl_approval' => 'Odobrite upload',
	'edit_pics' => 'Prepravite slike',
	'see_next' => 'Pogledajte slijede�e slike',
	'see_prev' => 'Pogledajte prethodne slike',
	'n_pic' => '%s slike',
	'n_of_pic_to_disp' => 'Broj slika za prikazivanje',
	'apply' => 'Napravite promjene'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Naziv grupe',
	'disk_quota' => 'Kvota diska',
	'can_rate' => 'Mo�e ocijeniti sliku',
	'can_send_ecards' => 'Mo�e poslati razglednicu',
	'can_post_com' => 'Mo�e komentirati',
	'can_upload' => 'Mo�e uploadati sliku',
	'can_have_gallery' => 'Mo�e imati osobnu galeriju',
	'apply' => 'Napravite izmjene',
	'create_new_group' => 'Kreirajte novu grupu',
	'del_groups' => 'Izbri�ite izabrane grupe',
	'confirm_del' => 'Upozorenje, kada izbri�ete grupu, korisnici koji pripadaju toj grupi biti �e preba�eni u \'Registered\' grupu !\n\n �elite li nastaviti ?',
	'title' => 'Organizirajte korisni�ke grupe',
	'approval_1' => 'Pub. Upl. approval (1)',
	'approval_2' => 'Priv. Upl. approval (2)',
	'note1' => '<b>(1)</b> Za upload u javni album potrebno dopu�tenje administratora',
	'note2' => '<b>(2)</b> Za upload u album koji pripada korisniku potrebno dopu�tenje administratora',
	'notes' => 'Napomena'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Dobro do�li !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Da li ste sigurni da �elite IZBRISATI ovaj album ? \\nSve slike i komentari �e tako�er biti izbrisani.',
	'delete' => 'IZBRI�I',
	'modify' => 'KARAKTERISTIKE',
	'edit_pics' => 'ISPRAVKA',
);

$lang_list_categories = array(
	'home' => 'Po�etna stranica',
	'stat1' => '<b>[pictures]</b> slika u <b>[albums]</b> albuma i <b>[cat]</b> kategorije sa <b>[comments]</b> komentara pogledane <b>[views]</b> puta',
	'stat2' => '<b>[pictures]</b> slike u <b>[albums]</b> albuma pogledane <b>[views]</b> puta',
	'xx_s_gallery' => '%s\'s Galerija',
	'stat3' => '<b>[pictures]</b> slike u <b>[albums]</b> albuma sa <b>[comments]</b> komentara pogledane <b>[views]</b> puta'
);

$lang_list_users = array(
	'user_list' => 'Popis korisnika',
	'no_user_gal' => 'Nema korisni�kih galerija',
	'n_albums' => '%s album(a)',
	'n_pics' => '%s slika'
);

$lang_list_albums = array(
	'n_pictures' => '%s slika',
	'last_added' => ', posljednja dodana %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Ulaz',
	'enter_login_pswd' => 'Upi�ite korisni�ko ime i zaporku za ulaz',
	'username' => 'Korisni�ko ime',
	'password' => 'Zaporka',
	'remember_me' => 'Zapamti me',
	'welcome' => 'Lijep pozdrav %s ...',
	'err_login' => '*** Ne�to nije u redu. Probajte ponovno ***',
	'err_already_logged_in' => 'Ve� ste logirani !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Izlaz',
	'bye' => 'Do vi�enja %s ...',
	'err_not_loged_in' => 'Niste logirani !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Osvje�i album %s',
	'general_settings' => 'Osnovno �timanje',
	'alb_title' => 'Naziv albuma',
	'alb_cat' => 'Kategorija albuma',
	'alb_desc' => 'Opis albuma',
	'alb_thumb' => 'Sli�ice albuma',
	'alb_perm' => 'Dozvole za ovaj album',
	'can_view' => 'Album mo�e biti vidljiv',
	'can_upload' => 'Posjetioci mogu uploadati slike',
	'can_post_comments' => 'Posjetioci mogu pisati komentare',
	'can_rate' => 'Posjetioci mogu ocjenjivati slike',
	'user_gal' => 'Korisnikova galerija',
	'no_cat' => '* Nema kategorije *',
	'alb_empty' => 'Album je prazan',
	'last_uploaded' => 'Posljednje uploadano',
	'public_alb' => 'Svi (javni album)',
	'me_only' => 'Samo ja',
	'owner_only' => 'Vlasnik albuma (%s) samo',
	'groupp_only' => '�lanovi \'%s\' grupe',
	'err_no_alb_to_modify' => 'U bazi podataka nema albuma koji mo�ete prepraviti.',
	'update' => 'Osvje�i album'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => '�ao mi je, ve� ste ocijenili ovu sliku',
	'rate_ok' => 'Glas upisan',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Za postavljanje vlastitih fotografija u galeriju potrebno se registrirati. Prilikom registracije obavezno morate upisati va�u to�nu, postoje�u E-Mail adresu, na koju �e vam biti poslana poruka sa linkom kojim �ete potvrditi va�u registraciju.<br />
<br /> 
Sla�em se da ne�u postavljati bilo kakve uznemiruju�e, pornografske, vulgarne fotografije, kao i fotografije koje poti�u na bilo kakav oblik mr�nje. Sla�em se tako�e da Administratorima pravo izbrisati sve fotografije koje nisu prihvatljive, odnosno nabrojane kategorije fotografija. Sla�em se da Administrator mo�e izbrisati svaki moj komentar ukoliko ocijeni da nije prikladan. Kao korisnik ove foto galerije sla�em se da svi moji podaci koje upi�em u registracijski obrazac budu pohranjeni u bazu podataka. Ukoliko na bilo kakav na�in uznemiravam foto galeriju sla�em se da Administator zabrani pristup mojoj IP adresi, odnosno da mi do daljnjeg zabrani pristup ovim stranicama.<br />
<br />
Ova stranica koristi cookie-je za pohranu podataka na va�em ra�unaru. Email adresa se koristi samo za potvrdu va�e registracije.<br />
<br />
Klikom na 'Sla�em se' prihva�ate uvjete kori�tenja i nadamo se da ih ne�ete prekr�iti.
EOT;

$lang_register_php = array(
	'page_title' => 'Registracija',
	'term_cond' => 'Pravila i uvjeti',
	'i_agree' => 'Sla�em se',
	'submit' => 'Po�aljite registraciju',
	'err_user_exists' => 'Izabrano korisni�ko ime ve� je registrirano, probajte neko drugo',
	'err_password_mismatch' => 'Nedostaju dvije zaporke, upi�ite ponovno',
	'err_uname_short' => 'Korisni�ko ime mora imati najmanje 2 znaka',
	'err_password_short' => 'Zaporka mora imati najmanje 2 znaka',
	'err_uname_pass_diff' => 'Korisni�ko ime i zaporka ne mogu biti isti',
	'err_invalid_email' => 'Neispravna email adresa',
	'err_duplicate_email' => 'Ve� je netko registriran sa istom email adresom koju ste upisali',
	'enter_info' => 'Upi�ite registracijske podatke',
	'required_info' => 'Obvezni podaci',
	'optional_info' => 'Dodatni podaci',
	'username' => 'Korisni�ko ime',
	'password' => 'Zaporka',
	'password_again' => 'Zaporka ponovno',
	'email' => 'Email',
	'location' => 'Lokacija',
	'interests' => 'Hobiji',
	'website' => 'Web stranica',
	'occupation' => 'Zanimanje',
	'error' => 'POGRE�KA',
	'confirm_email_subject' => '%s - Potvrdite registraciju',
	'information' => 'Informacija',
	'failed_sending_email' => 'Registracijsku potvrdu nije mogu�e poslati !',
	'thank_you' => 'Hvala na registraciji.<br /><br />Email sa informacijama kako aktivirati va� korisni�ki ra�un poslan je na email adresu koju ste upisali prilikom registracije.',
	'acct_created' => 'Va� korisni�ki ra�un je otvoren i sada mo�ete pristupiti stranici sa va�im korisni�kim imenom i zaporkom',
	'acct_active' => 'Va� korisni�ki ra�un od sada je aktivan i mo�ete stranici pristupiti sa va�im korisni�im imenom i zaporkom',
	'acct_already_act' => 'Va� korisni�ki ra�un je ve� aktivan !',
	'acct_act_failed' => 'Ovaj korisni�ki ra�un ne mo�e biti aktivan !',
	'err_unk_user' => 'Izabrani korisnik ne postoji !',
	'x_s_profile' => '%s\'s profil',
	'group' => 'Grupa',
	'reg_date' => 'Registriran(a)',
	'disk_usage' => 'Iskori�tenost disk prostora',
	'change_pass' => 'Promijeni zaporku',
	'current_pass' => 'Trenutna zaporka',
	'new_pass' => 'Nova zaporka',
	'new_pass_again' => 'Nova zaporka ponovno',
	'err_curr_pass' => 'Trenutna zaporka nije ispravna',
	'apply_modif' => 'Izvr�i promjene',
	'change_pass' => 'Promijeni moju zaporku',
	'update_success' => 'Va� profil je osvje�en',
	'pass_chg_success' => 'Va�a zaporka je promijenjena',
	'pass_chg_error' => 'Va�a zaporka nije promijenjena',
);

$lang_register_confirm_email = <<<EOT
Hvala na registraciji na {SITE_NAME}

Va�e korisni�ko ime : "{USER_NAME}"
Va�a  zaporka : "{PASSWORD}"

Da biste aktivirali va� korisni�ki ra�un potrebno je kliknuti na link ispod ili ako �elite kopirajte link i nalijepite u va� web browser.

{ACT_LINK}

Srda�an pozdrav,

Team {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Pro�itajte komentare',
	'no_comment' => 'Nema komentara za �itanje',
	'n_comm_del' => '%s komentari su izbrisani',
	'n_comm_disp' => 'Broj komentara za prikaz',
	'see_prev' => 'Pogledaj prethodne',
	'see_next' => 'Pogledaj slijede�e',
	'del_comm' => 'Izbri�i izabrane komentare',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Pretra�ite kolekciju slika',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Pretraga novih slika',
	'select_dir' => 'Izaberi tedirektorij',
	'select_dir_msg' => 'Ova funkcija dozvoljava vam da napravite put do slike koju imate na svom serveru.<br /><br />Izaberite direktorij gdje ste uploadali svoje slike',
	'no_pic_to_add' => 'Nema slike za dodati',
	'need_one_album' => 'Morate imati najmanje jedan album da bi koristili ovu funkciju',
	'warning' => 'Upozorenje',
	'change_perm' => 'Skripta ne mo�e upisivati u ovaj direktorij, morate promijeniti CHMOD na 755 ili 777 prije nego �to dodate slike !',
	'target_album' => '<b>Prebaci sliku iz &quot;</b>%s<b>&quot; u </b>%s',
	'folder' => 'Folder',
	'image' => 'Slika',
	'album' => 'Album',
	'result' => 'Rezultat',
	'dir_ro' => 'Nije writable. ',
	'dir_cant_read' => 'Nije readable. ',
	'insert' => 'Dodavanje novih slika u galeriju',
	'list_new_pic' => 'Lista novih slika',
	'insert_selected' => 'Ubacite izabrane slike',
	'no_pic_found' => 'Nije prona�ema nova slika',
	'be_patient' => 'Molimo budite strpljivi, skripti treba vremena da doda slike',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : zna�i da je slika uspje�no dodana'.
				'<li><b>DP</b> : zna�i da je slika duplikat i da je ve� u bazi podataka'.
				'<li><b>PB</b> : zna�i da sliku nije mogu�e dodati, provjerite vlastitu konfiguraciju i dozvolu direktorija gdje su slike smje�tene'.
				'<li>Ako OK, DP, PB \'signs\' se ne pojave kliknite na puknutu sliku da vidite koju je gre�ku napravio PHP'.
				'<li>Ako je vrijeme isteklo, pritisnite refresh'.
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
                'title' => 'Zabrani pristup korisnicima', 
                'user_name' => 'Korisni�ko ime', 
                'ip_address' => 'IP adresa', 
                'expiry' => 'Isti�e (blank is permanent)', 
                'edit_ban' => 'Sa�uvaj promjene', 
                'delete_ban' => 'Izbri�i', 
                'add_new' => 'Dodaj novu zabranu pristupa', 
                'add_ban' => 'Dodaj', 
); 


// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'Upload slika',
	'max_fsize' => 'Maksimalno dozvoljena veli�ina je %s KB',
	'album' => 'Album',
	'picture' => 'Slika',
	'pic_title' => 'Naslov slike',
	'description' => 'Opis slike',
	'keywords' => 'Klju�ne rije�i (odvojiti praznim mjestom)',
	'err_no_alb_uploadables' => '�ao nam je, ovdje nema albuma gdje biste mogli dodati sliku.',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Organizirajte korisnike',
	'name_a' => 'Ime ascending',
	'name_d' => 'Ime descending',
	'group_a' => 'Grupa ascending',
	'group_d' => 'Grupa descending',
	'reg_a' => 'Datum registracije ascending',
	'reg_d' => 'Datum registracije descending',
	'pic_a' => 'Broj slika ascending',
	'pic_d' => 'Broj slika descending',
	'disku_a' => 'Iskori�tenost diska ascending',
	'disku_d' => 'Iskori�tenost diska descending',
	'sort_by' => 'Poredajte korisnike po',
	'err_no_users' => 'Korisni�ka tabla je prazna !',
	'err_edit_self' => 'Ne mo�ete promijeniti svoj profil, koristite \'My profile\' link za to',
	'edit' => 'PREPRAVI',
	'delete' => 'IZBRI�I',
	'name' => 'Korisni�ko ime',
	'group' => 'Grupa',
	'inactive' => 'Neaktivno',
	'operations' => 'Operacije',
	'pictures' => 'Slike',
	'disk_space' => 'Iskori�teno prostora / Kvota',
	'registered_on' => 'Registriran',
	'u_user_on_p_pages' => '%d korisnika na %d stranica',
	'confirm_del' => 'Da li ste sigurni da  �elite IZBRISATI korisnika ? \\nSve njegove slike i albumi �e biti izbrisani.',
	'mail' => 'MAIL',
	'err_unknown_user' => 'Izabrani korisnik ne postoji !',
	'modify_user' => 'Modificiraj korisnika',
	'notes' => 'Napomena',
	'note_list' => '<li>Ako ne �elite promijeniti trenutnu �ifru, ostavite polje "zaporka" prazno',
	'password' => 'Zaporka',
	'user_active' => 'Korisnik je aktivan',
	'user_group' => 'Grupa',
	'user_email' => 'Email',
	'user_web_site' => 'Web stranica',
	'create_new_user' => 'Kreiraj novog korisnika',
	'user_location' => 'Mjesto',
	'user_interests' => 'Hobiji',
	'user_occupation' => 'Zanimanje',
);

// ------------------------------------------------------------------------- // 
// File util.php 
// ------------------------------------------------------------------------- // 

if (defined('UTIL_PHP')) $lang_util_php = array( 
        'title' => 'Promijeni veli�inu slike', 
        'what_it_does' => '�to �ini', 
        'what_update_titles' => 'Osvje�ava naslove iz imena dokumenata', 
        'what_delete_title' => 'Bri�e naslove', 
        'what_rebuild' => 'Obnavlja sli�ice i smanjene slike', 
        'what_delete_originals' => 'Bri�e originalne slike zamjenjuju�i ih smanjenom verzijom', 
        'file' => 'File', 
        'title_set_to' => 'naslov postavljen na', 
        'submit_form' => 'po�alji', 
        'updated_succesfully' => 'uspje�no osvje�eno', 
        'error_create' => 'POGRE�KA kod postavljanja', 
        'continue' => 'Obradi vi�e slika', 
        'main_success' => 'Dokument je uspje�no upotrijebljen kao glavna slika', 
        'error_rename' => 'Pogre�ka kod mijenjanja imena %s u %s', 
        'error_not_found' => 'Dokument nije prona�en', 
        'back' => 'natrag na glavnu', 
        'thumbs_wait' => 'Osvje�avaju se sli�ice i/ili se mijenja njihova veli�ina, molimo Vas da se strpite...', 
        'thumbs_continue_wait' => 'Nastavlja se osvje�avanje sli�ica i/ili mijenjanja veli�ine slika...', 
        'titles_wait' => 'Osvje�avaju se naslovi slika, molimo Vas da se strpite...', 
        'delete_wait' => 'Bri�e nazive, molimo Vas da se strpite...', 
        'replace_wait' => 'Bri�e originale i mijenja ih slikama manje veli�ine, molimo Vas da se strpite..', 
        'instruction' => 'Brza uputstva', 
        'instruction_action' => 'Odaberite radnju', 
        'instruction_parameter' => 'Postavite parametre', 
        'instruction_album' => 'Odaberite album', 
        'instruction_press' => 'Pritisnite %s', 
        'update' => 'Osvje�ite sli�ice i/ili slike izmijenjene veli�ine', 
        'update_what' => '�to treba osvje�iti', 
        'update_thumb' => 'Samo sli�ice', 
        'update_pic' => 'Samo slike izmijenje veli�ine', 
        'update_both' => 'I sli�ice i slike izmijenjene veli�ine', 
        'update_number' => 'Broj procesuiranih slika po kliku', 
        'update_option' => '(Nastojte postaviti ovu opciju ni�om ako imate problema s prekidima)', 
        'filename_title' => 'Naziv dokumenta ? Naziv slike title', 
        'filename_how' => 'Kako treba izmijeniti ime dokumenta', 
        'filename_remove' => 'Izbri�ite .jpg nastavak i zamijenite ga _ (crtom) i praznim prostorom', 
        'filename_euro' => 'Promijeni 2003_11_23_13_20_20.jpg u 23/11/2003 13:20', 
        'filename_us' => 'Promijeni 2003_11_23_13_20_20.jpg u 11/23/2003 13:20', 
        'filename_time' => 'Promijeni 2003_11_23_13_20_20.jpg u 13:20', 
        'delete' => 'Izbri�i nazive slika ili originalnu veli�ina slika', 
        'delete_title' => 'Izbri�i nazive slika', 
        'delete_original' => 'Izbri�i originalnu veli�inu slika', 
        'delete_replace' => 'Izbri�i originalne slike zamjenjuju�i ih manjim verzijama', 
        'select_album' => 'Odaberi album', 
); 
?>