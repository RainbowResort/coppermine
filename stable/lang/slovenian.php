<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery                                                 //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gregory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning Stoverud <henning@stoverud.com>         //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
//  Hacked by Tarique Sani <tarique@sanisoft.com> and Girsh Nair             //
//  <girish@sanisoft.com> see http://www.sanisoft.com/cpg/README.txt for     //
//  details                                                                  //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'Slovenian',  //the name of your language in English, e.g. 'Greek' or 'Spanish'
'lang_name_native' => 'Sloven��ina', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
'lang_country_code' => 'si', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
'trans_name'=> 's55hh', //the name of the translator - can be a nickname
'trans_email' => 's55hh.jani@siol.net', //translator's email address (optional)
'trans_website' => 'http://slovhf.net/', //translator's website (optional)
'trans_date' => '2003-10-11', //the date the translation was created / last modified
);

$lang_charset = 'windows-1250';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bitov', 'kB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Ne', 'Po', 'To', 'Sr', '�e', 'Pe', 'So');
$lang_month = array('Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Avg', 'Sep', 'Okt', 'Nov', 'Dec');

// Some common strings
$lang_yes = 'Da';
$lang_no  = 'Ne';
$lang_back = 'NAZAJ';
$lang_continue = 'NAPREJ';
$lang_info = 'Informacija';
$lang_error = 'Napaka';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%d.%m.%Y';
$lastcom_date_fmt =  '%d.%m.%Y ob %H:%M';
$lastup_date_fmt = '%d.%m.%Y';
$register_date_fmt = '%d.%m.%Y';
$lasthit_date_fmt = '%d.%m.%Y ob %I:%M %p';
$comment_date_fmt =  '%d.%m.%Y ob %I:%M %p';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
        'random' => 'Naklju�ne slike',
        'lastup' => 'Zadnje dodane slike',
        'lastalb'=> 'Zadnji dodani albumi', //new in cpg1.2.0
        'lastcom' => 'Zadnji komentarji',
        'topn' => 'Najve� ogledov',
        'toprated' => 'Naj ocene',
        'lasthits' => 'Zadnji ogledi',
        'search' => 'Rezultati iskanja', //new in cpg1.2.0
        'favpics'=> 'Priljubljene slike' //new in cpg1.2.0
);

$lang_errors = array(
        'access_denied' => 'Nima� pravic za dostop do te strani.',
        'perm_denied' => 'Nima� pravic za izvedbo tega ukaza.',
        'param_missing' => 'Manjkajo podatki za izvedbo...',
        'non_exist_ap' => 'Izbrani album/slika ne obstaja!',
        'quota_exceeded' => 'Disk je poln<br /><br />Na razpolago ima� [quota]K, tvoje slike pa trenutno zasedajo [space]K, �e bi dodal pa �e to sliko, bi prekora�il prostor na disku.',
        'gd_file_type_err' => 'Pri uporabi GD knji�nice lahko uporabi� samo JPEG in PNG slike.',
        'invalid_image' => 'Poslana slika je po�kodovana ali pa ni v pravilnem formatu za GD knji�nico.',
        'resize_failed' => 'Ne morem narediti ikone ali pomanj�ane slike.',
        'no_img_to_display' => 'Trenutno �e brez slik',
        'non_exist_cat' => 'Izbrana kategorija ne obstaja',
        'orphan_cat' => 'Kategorija ima dolo�eno neobstoje�o nadrejeno kategorijo. Popravi napako v nastavitvah.',
        'directory_ro' => 'Direktorij \'%s\' ne dopu��a pisanja, slik ni mo�no pobrisati',
        'non_exist_comment' => 'Izbrani komentar ne obstaja.',
        'pic_in_invalid_album' => 'Slika je v neobstoje�em albumu (%s)!?', //new in cpg1.2.0
        'banned' => 'Trenutno ima� prepoved dostopa do teh strani.', //new in cpg1.2.0
        'not_with_udb' => 'Ta ukaz je onemogo�en, ker je premaknjen v forum. Ali to kar �eli� narediti ni omogo�eno v nastavitvah ali pa je predvideno za izvedbo v forumu.', //new in cpg1.2.0
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
        'alb_list_title' => 'Pojdi na seznam albumov',
        'alb_list_lnk' => 'Seznam albumov',
        'my_gal_title' => 'Pojdi v mojo osebno galerijo',
        'my_gal_lnk' => 'Moja galerija',
        'my_prof_lnk' => 'Moj profil',
        'adm_mode_title' => 'Preklop v administracijo',
        'adm_mode_lnk' => 'Administracija',
        'usr_mode_title' => 'Preklop v uporabni�ki na�in',
        'usr_mode_lnk' => 'Uporabni�ki na�in',
        'upload_pic_title' => 'Nalo�i sliko v album',
        'upload_pic_lnk' => 'Nalaganje slik',
        'register_title' => 'Ustvari ra�un',
        'register_lnk' => 'Registracija',
        'login_lnk' => 'Prijava',
        'logout_lnk' => 'Odjava',
        'lastup_lnk' => 'Zadnje dodane slike',
        'lastcom_lnk' => 'Zadnji komentarji',
        'topn_lnk' => 'Najve� ogledov',
        'toprated_lnk' => 'Najbolj ocenjeno',
        'search_lnk' => 'Iskanje',
        'fav_lnk' => 'Moji favoriti', //new in cpg1.2.0

);

$lang_gallery_admin_menu = array(
        'upl_app_lnk' => 'Odobri slike',
        'config_lnk' => 'Nastavitve',
        'albums_lnk' => 'Albumi',
        'categories_lnk' => 'Kategorije',
        'users_lnk' => 'Uporabniki',
        'groups_lnk' => 'Skupine',
        'comments_lnk' => 'Komentarji',
        'searchnew_lnk' => 'Najdi nove slike',
        'util_lnk' => 'Spremeni velikost slike', //new in cpg1.2.0
        'ban_lnk' => 'Zavrni uporabnika', //new in cpg1.2.0
);

$lang_user_admin_menu = array(
        'albmgr_lnk' => 'Ustvari/naro�i svoj album',
        'modifyalb_lnk' => 'Spremeni svoj album',
        'my_prof_lnk' => 'Moj profil',
);

$lang_cat_list = array(
        'category' => 'Kategorija',
        'albums' => 'Albumi',
        'pictures' => 'Slike',
);

$lang_album_list = array(
        'album_on_page' => '�t. albumov:%d (�t. strani:%d)'
);

$lang_thumb_view = array(
        'date' => 'Datum',
        //Sort by filename and title
        'name' => 'Datoteka', //new in cpg1.2.0
        'title' => 'Naziv', //new in cpg1.2.0
        'sort_da' => 'Sortiraj po datumu nara��ujo�e',
        'sort_dd' => 'Sortiraj po datumu padajo�e',
        'sort_na' => 'Sortiraj po imenu datoteke nara��ujo�e',
        'sort_nd' => 'Sortiraj po imenu datoteke padajo�e',
        'sort_ta' => 'Sortiraj po nazivu nara��ujo�e', //new in cpg1.2.0
        'sort_td' => 'Sortiraj po nazivu padajo�e', //new in cpg1.2.0
        'pic_on_page' => '�t. slik:%d (�t. strani:%d)',
        'user_on_page' => '�t. uporabnikov:%d (�t. strani:%d)'
);

$lang_img_nav_bar = array(
        'thumb_title' => 'Nazaj na stran z ikonami',
        'pic_info_title' => 'Prika�i/skrij informacije o sliki',
        'slideshow_title' => 'Samodejno predvajaj slike',
        'ecard_title' => 'Po�lji sliko kot e-razglednico',
        'ecard_disabled' => 'Po�iljanje e-razglednic ni dovoljeno',
        'ecard_disabled_msg' => 'Nima� pravic za po�iljanje e-razglednic',
        'prev_title' => 'Poglej predhodno sliko',
        'next_title' => 'Poglej naslednjo sliko',
        'pic_pos' => 'Slika %s od %s',
);

$lang_rate_pic = array(
        'rate_this_pic' => 'Oceni to sliko ',
        'no_votes' => '(Brez ocen do sedaj)',
        'rating' => '(trenutna ocena: %s (najve� 5; �t. glasov:%s)',
        'rubbish' => 'Zani�',
        'poor' => 'Slabo',
        'fair' => 'Tako tako',
        'good' => 'Dobro',
        'excellent' => 'Odli�no',
        'great' => 'Super',
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
        CRITICAL_ERROR => 'Kriti�na napaka',
        'file' => 'Datoteka: ',
        'line' => 'Vrstica: ',
);

$lang_display_thumbnails = array(
        'filename' => 'Ime datoteke: ',
        'filesize' => 'Velikost datoteke: ',
        'dimensions' => 'Dimenzija: ',
        'date_added' => 'Datum objave: '
);

$lang_get_pic_data = array(
        'n_comments' => '�t. komentarjev:%s',
        'n_views' => '�t. ogledov:%s',
        'n_votes' => '(�t. ocen:%s)'
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
        'Exclamation' => 'Vzklik',
        'Question' => 'Vpra�anje',
        'Very Happy' => 'Zelo sre�en',
        'Smile' => 'Sme�ko',
        'Sad' => '�alosten',
        'Surprised' => 'Presene�en',
        'Shocked' => 'V �oku',
        'Confused' => 'Zmeden',
        'Cool' => 'Hladen',
        'Laughing' => 'Nasmejan',
        'Mad' => 'Nor',
        'Razz' => 'Nagajiv',
        'Embarassed' => 'Embarassed',
        'Crying or Very sad' => 'Jokajo� ali �alosten',
        'Evil or Very Mad' => 'Vra�ji ali zloben',
        'Twisted Evil' => 'Slepar',
        'Rolling Eyes' => 'Kotale�e o�i',
        'Wink' => 'Me�ikanje',
        'Idea' => 'Ideja',
        'Arrow' => 'Pu��ica',
        'Neutral' => 'Nevtralen',
        'Mr. Green' => 'Gospod zelenko',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
        0 => 'Zapu��am administracijo...',
        1 => 'Vstop v administracijo...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
        'alb_need_name' => 'Album mora imeti ime!',
        'confirm_modifs' => 'Res �eli� izvesti te spremembe?',
        'no_change' => 'Nobenih sprememb nisi naredil!',
        'new_album' => 'Novi album',
        'confirm_delete1' => 'Res �eli� pobrisati ta album?',
        'confirm_delete2' => '\nVse slike in vsi komentarji bodo prav tako pobrisani!',
        'select_first' => 'Najprej izberi album',
        'alb_mrg' => 'Urejanje albumov',
        'my_gallery' => '* Moja galerija *',
        'no_category' => '* Brez kategorij *',
        'delete' => 'Brisanje',
        'new' => 'Novo',
        'apply_modifs' => 'Izvedi spremembe',
        'select_category' => 'Izberi kategorijo',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
        'miss_param' => 'Parameter potreben za \'%s\'operacijo ni vpisan!',
        'unknown_cat' => 'Izbrana kategorija ne obstaja v bazi',
        'usergal_cat_ro' => 'Brisanje kategorije od uporabni�kih galerij ni mo�no!',
        'manage_cat' => 'Urejanje kategorij',
        'confirm_delete' => 'Res �eli� pobrisati to kategorijo',
        'category' => 'Kategorija',
        'operations' => 'Operacija',
        'move_into' => 'Premakni v',
        'update_create' => 'Posodobi/ustvari kategorijo',
        'parent_cat' => 'Nadrejena kategorija',
        'cat_title' => 'Ime kategorije',
        'cat_desc' => 'Opis kategorije'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
        'title' => 'Nastavitve',
        'restore_cfg' => 'Povrni osnovne nastavitve',
        'save_cfg' => 'Shrani nove nastavitve',
        'notes' => 'Opombe',
        'info' => 'Informacija',
        'upd_success' => 'Nastavitve galerije so bile uspe�no posodobljene',
        'restore_success' => 'Povrnjene so bile osnovne nastavitve galerije',
        'name_a' => 'Naziv nara��ujo�e',
        'name_d' => 'Naziv padajo�e',
        'title_a' => 'Naslov nara��ujo�e', //new in cpg1.2.0
        'title_d' => 'Naslov padajo�e', //new in cpg1.2.0
        'date_a' => 'Datum nara��ujo�e',
        'date_d' => 'Datum padajo�e'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
        'Osnovne nastavitve',
        array('Ime galerije', 'gallery_name', 0),
        array('Opis galerije', 'gallery_description', 0),
        array('Administratorjev e-mail', 'gallery_admin_email', 0),
        array('Naslov za link v e-razglednicah (Poglej si ve� slik)', 'ecards_more_pic_target', 0),
        array('Jezik', 'lang', 5),
        //array('enable language selection', 'lang_select_enable', 8),
        array('Tema', 'theme', 6),
        //array('enable user theme selection', 'theme_select_enable', 8),

        'Seznam albumov',
        array('�irina glavne tabele (pixli ali %)', 'main_table_width', 0),
        array('�tevilo nivojev za prikaz kategorij', 'subcat_level', 0),
        array('�tevilo albumov na strani', 'albums_per_page', 0),
        array('�tevilo kolon za prikaz albumov', 'album_list_cols', 0),
        array('Velikost ikon v pixlih', 'alb_list_thumb_size', 0),
        array('Vsebina na glavni strani', 'main_page_layout', 0),
        array('Prikaz ikon albumov za prvi nivo kategorij','first_level',1), //new in cpg1.2.0

        'Prikaz ikon',
        array('�tevilo kolon na strani z ikonami', 'thumbcols', 0),
        array('�tevilo vrstic na strani z ikonami', 'thumbrows', 0),
        array('Max. �t. tabulatorjev', 'max_tabs', 0),
        array('Prika�i opis slike (zraven imena) pod ikono', 'caption_in_thumbview', 1),
        array('Prika�i �tevilo komentarjev pod ikono', 'display_comment_count', 1),
        array('Privzeto sortiranje slik', 'default_sort_order', 3),
        array('Minimalno �tevilo ocen za sliko, da se uvrsti na seznam  \'naj-ocene\'', 'min_votes_for_rating', 0),

        'Prikaz slik &amp; nastavitve za komentarje',
        array('�irina tabele za prikaz slik (pixli ali %)', 'picture_table_width', 0),
        array('Informacija o sliki je privzeto vidna', 'display_pic_info', 1),
        array('Izlo�i grde besede v komentarjih', 'filter_bad_words', 1),
        array('Dovoli sme�kote v komentarjih', 'enable_smilies', 1),
        array('Max. velikost za opis slike', 'max_img_desc_length', 0),
        array('Max. �tevilo zankov v besedi', 'max_com_wlength', 0),
        array('Max. �tevilo vrstic komentarja', 'max_com_lines', 0),
        array('Max. velikost komentarja', 'max_com_size', 0),
        array('Prika�i filmski trak z ikonami', 'display_film_strip', 1), //new in cpg1.2.0
        array('�t. ikon na traku', 'max_film_strip_items', 0), //new in cpg1.2.0

        'Nastavitve slik in ikon',
        array('Kvaliteta za JPEG datoteke', 'jpeg_qual', 0),
        array('Max. velikost za ikone <b>*</b>', 'thumb_width', 0), //new in cpg1.2.0
        array('Velikost uporabi za �irino ali vi�ino ali razmerje ikone <b>*</b>', 'thumb_use', 7),    //new in cpg1.2.0
        array('Ustvari vmesne slike','make_intermediate',1),
        array('Max. �irina ali vi�ina vmesnih slik <b>*</b>', 'picture_width', 0),
        array('Max. velikost datotek/slik (kB)', 'max_upl_size', 0),
        array('Max. �irina ali vi�ina dodanih slik (pixli)', 'max_upl_width_height', 0),

        'Nastavitve uporabnikov',
        array('Dovoli registriranje novih uporabnikov', 'allow_user_registration', 1),
        array('Registracija zahteva preverjanje e-mail naslova', 'reg_requires_valid_email', 1),
        array('Dva uporabnika lahko imata enak e-mail naslov', 'allow_duplicate_emails_addr', 1),
        array('Uporabnik ima lahko privatni album', 'allow_private_albums', 1),

        'Dodatna polja za vpis informacij o sliki (pusti prazno, �e ne uporablja�)',
        array('Polje 1', 'user_field1_name', 0),
        array('Polje 2', 'user_field2_name', 0),
        array('Polje 3', 'user_field3_name', 0),
        array('Polje 4', 'user_field4_name', 0),

        'Dodatne nastavitve za slike in ikone',
        array('Prika�i ikone privatnih albumov neprijavljenim uporabnikom','show_private',1), //new in cpg1.2.0
        array('Prepovedani znaki v imenih datotek', 'forbiden_fname_char',0),
        array('Dovoljene vrste datotek za dodajanje slik', 'allowed_file_extensions',0),
        array('Na�in kreiranja ikon','thumb_method',2),
        array('Pot do ImageMagick programa (npr. /usr/bin/X11/)', 'impath', 0),
        array('Dovoljene vrste datotek (samo za ImageMagick)', 'allowed_img_types',0),
        array('Opcija za ukazno vrstico od ImageMagick', 'im_options', 0),
        array('Prika�i EXIF podatke v JPEG datotekah', 'read_exif_data', 1),
        array('Direktorij za albume <b>*</b>', 'fullpath', 0),
        array('Direktorij za slike od uporabnikov <b>*</b>', 'userpics', 0),
        array('Predpona za vmesne slike <b>*</b>', 'normal_pfx', 0),
        array('Predpona za ikone <b>*</b>', 'thumb_pfx', 0),
        array('Privzete pravice za direktorije', 'default_dir_mode', 0),
        array('Privzete pravice za slike', 'default_file_mode', 0),
        array('Izklopi desni klik pri slikah (JavaScript - ni 100% zanesljivo)', 'disable_popup_rightclick', 1), //new in cpg1.2.0
        array('Izklopi desni klik na vseh straneh (JavaScript - ni 100% zanesljivo)', 'disable_gallery_rightclick', 1), //new in cpg1.2.0

        'Pi�kotki in kodne tabele',
        array('Ime za pi�kotke, ki jih uporablja galerija', 'cookie_name', 0),
        array('Pot do pi�kotkov', 'cookie_path', 0),
        array('Kodiranje strani', 'charset', 4),

        'Ostale nastavitve',
        array('Vklju�i na�in za odkrivanje napak', 'debug_mode', 1),

        '<br /><div align="center">(*) Polja ozna�ena z * se ne smejo spreminjati, �e so v galeriji �e slike</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
        'empty_name_or_com' => 'Vpisati mora� svoje ime in komentar',
        'com_added' => 'Tvoj komentar je bil dodan',
        'alb_need_title' => 'Vpisati mora� ime albuma!',
        'no_udp_needed' => 'Posodobitve niso potrebne.',
        'alb_updated' => 'Album je bil posodobljen',
        'unknown_album' => 'Izbrani album ne obstaja ali pa nima� pravic za dodajanje slik v ta album',
        'no_pic_uploaded' => 'Nobena slika ni bila dodana!<br /><br />�e si resni�no poslal sliko, preveri ali je to sploh dovoljeno...',
        'err_mkdir' => 'Kreiranje direktorija %s ni bilo uspe�no!',
        'dest_dir_ro' => '�eljeni direktorij %s ne omogo�a pisanja - pravice!',
        'err_move' => 'Nemogo�e je premakniti %s v %s !',
        'err_fsize_too_large' => 'Dimenzije slike so prevelike (dovoljeno je %s x %s) !',
        'err_imgsize_too_large' => 'Velikost datoteke presega limit (dovoljeno je %s kB) !',
        'err_invalid_img' => 'Poslana slika ni v pravilnem formatu!',
        'allowed_img_types' => 'Doda� lahko samo %s slike.',
        'err_insert_pic' => 'Slike \'%s\' se ne da dodati v album ',
        'upload_success' => 'Tvoja slika je bila dodana.<br /><br />Vidna bo takoj po administratorjevi odobritvi.',
        'info' => 'Informacija',
        'com_added' => 'Komentar dodan',
        'alb_updated' => 'Album posodobljen',
        'err_comment_empty' => 'Komentar je prazen!',
        'err_invalid_fext' => 'Veljavne so samo datoteke z naslednjimi kon�nicami: <br /><br />%s.',
        'no_flood' => 'Oprosti, ampak si �e avtor zadnjega komentarja za to sliko<br /><br />Izberi urejanje,�e ga �eli� spremeniti',
        'redirect_msg' => 'Prestavljen bo� na novo stran.<br /><br /><br />Klikni \'NAPREJ\', �e se stran samodejno ne zamenja',
        'upl_success' => 'Tvoje slike so bile uspe�no dodane',
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
        'empty_name_or_com' => 'Vpisati mora� ime in komentar',
        'com_added' => 'Komentar je bil dodan',
        'alb_need_title' => 'Vpisati mora� ime za album!',
        'no_udp_needed' => 'Posodobitve niso potrebne.',
        'alb_updated' => 'Album je bil posodobljen',
        'unknown_album' => 'Izbrani album ne obstaja ali pa nima� pravic za dodajanje slik v njega',
        'no_pic_uploaded' => 'Nobena slika ni bila dodana!<br /><br />�e si resni�no poslal sliko, preveri ali je to sploh dovoljeno...',
        'err_mkdir' => 'Kreiranje direktorija %s ni bilo uspe�no!',
        'dest_dir_ro' => '�eljeni direktorij %s ne omogo�a pisanja - pravice!',
        'err_move' => 'Nemogo�e je premakniti %s v %s !',
        'err_fsize_too_large' => 'Dimenzije slike so prevelike (dovoljeno je %s x %s) !',
        'err_imgsize_too_large' => 'Velikost datoteke presega limit (dovoljeno je %s kB) !',
        'err_invalid_img' => 'Poslana slika ni v pravilnem formatu!',
        'allowed_img_types' => 'Doda� lahko samo %s slike.',
        'err_insert_pic' => 'Slike \'%s\' se ne da dodati v album ',
        'upload_success' => 'Tvoja slika je bila dodana.<br /><br />Vidna bo takoj po administratorjevi odobritvi.',
        'info' => 'Informacija',
        'com_added' => 'Komentar dodan',
        'alb_updated' => 'Album posodobljen',
        'err_comment_empty' => 'Komentar je prazen!',
        'err_invalid_fext' => 'Veljavne so samo datoteke z naslednjimi kon�nicami: <br /><br />%s.',
        'no_flood' => 'Oprosti, ampak si �e avtor zadnjega komentarja za to sliko<br /><br />Izberi urejanje,�e ga �eli� spremeniti',
        'redirect_msg' => 'Prestavljen bo� na novo stran.<br /><br /><br />Klikni \'NAPREJ\', �e se stran samodejno ne zamenja',
        'upl_success' => 'Tvoje slike so bile uspe�no dodane',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
        'caption' => 'Naslov',
        'fs_pic' => 'velika slika',
        'del_success' => 'uspe�no pobrisano',
        'ns_pic' => 'normalna velikost slike',
        'err_del' => 'brisanje ni mo�no',
        'thumb_pic' => 'ikona',
        'comment' => 'komentar',
        'im_in_alb' => 'slika v albumu',
        'alb_del_success' => 'Album \'%s\' pobrisan',
        'alb_mgr' => 'Urejanje albumov',
        'err_invalid_data' => 'Napa�ni podatki v \'%s\'',
        'create_alb' => 'Kreiram album \'%s\'',
        'update_alb' => 'Posodabljam album \'%s\' z naslovom \'%s\' in indeksom \'%s\'',
        'del_pic' => 'Pobri�i sliko',
        'del_alb' => 'Pobri�i album',
        'del_user' => 'Pobri�i uporabnika',
        'err_unknown_user' => 'Izbrani uporabnik ne obstaja!',
        'comment_deleted' => 'Komentar uspe�no pobrisan',
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
        'confirm_del' => 'Res �eli� pobrisati to sliko? \\nTudi komentarji od nje bodo pobrisani.',
        'del_pic' => 'POBRI�I TO SLIKO',
        'size' => '%s x %s pixlov',
        'views' => '%s krat',
        'slideshow' => 'Samodejno predvajanje',
        'stop_slideshow' => 'Ustavi predvajanje',
        'view_fs' => 'Klikni za ogled ve�je slike',
);

$lang_picinfo = array(
        'title' =>'Informacija o sliki',
        'Filename' => 'Ime datoteke',
        'Album name' => 'Ime albuma',
        'Rating' => 'Ocena (�t. glasov:%s)',
        'Keywords' => 'Klju�ne besede',
        'File Size' => 'Velikost datoteke',
        'Dimensions' => 'Velikost slike',
        'Displayed' => '�t. ogledov',
        'Camera' => 'Kamera',
        'Date taken' => 'Datum posnetka',
        'Aperture' => 'Zaslonka',
        'Exposure time' => '�as',
        'Focal length' => 'Gori��na razdalja',
        'Comment' => 'Komentar',
        'addFav'=>'Dodaj med priljubljene', //new in cpg1.2.0
        'addFavPhrase'=>'Priljubljene', //new in cpg1.2.0
        'remFav'=>'Odstrani iz priljubljenih', //new in cpg1.2.0
);

$lang_display_comments = array(
        'OK' => 'OK',
        'edit_title' => 'Uredi komentar',
        'confirm_delete' => 'Res �eli� pobrisati komentar?',
        'add_your_comment' => 'Dodaj komentar',
        'name'=>'Ime', //new in cpg1.2.0
        'comment'=>'Komentar', //new in cpg1.2.0
        'your_name' => 'Anonimne�', //new in cpg1.2.0
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Klikni sliko, da zapre� to okno', //new in cpg1.2.0
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
        'title' => 'Po�lji e-razglednico',
        'invalid_email' => '<b>Opozorilo</b>: napa�ni e-mail naslov!',
        'ecard_title' => 'To je e-razglednica od %s za tebe',
        'view_ecard' => '�e razglednice ne vidi� pravilno, klikni na to povezavo',
        'view_more_pics' => 'Klikni tukaj za ogled ve�ih slik!',
        'send_success' => 'Razglednica je bila poslana',
        'send_failed' => 'Oprosti, ampak serven ne omogo�a po�iljanja razglednic...',
        'from' => 'Od',
        'your_name' => 'Tvoje ime',
        'your_email' => 'Tvoj e.mail naslov',
        'to' => 'Za',
        'rcpt_name' => 'Naslovnikovo ime',
        'rcpt_email' => 'Naslovnikov e-mail naslov',
        'greetings' => 'Pozdrav',
        'message' => 'Sporo�ilo',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
        'pic_info' => 'Informacija o sliki',
        'album' => 'Album',
        'title' => 'Naziv',
        'desc' => 'Opis',
        'keywords' => 'Klju�ne besede',
        'pic_info_str' => '%sx%s - %skB - %s ogledov - %s ocen',
        'approve' => 'Odobri sliko',
        'postpone_app' => 'Prelo�i odobritev',
        'del_pic' => 'Pobri�i sliko',
        'reset_view_count' => 'Resetiraj �tevec ogledov',
        'reset_votes' => 'Resetiraj ocene',
        'del_comm' => 'Pobri�i komentarje',
        'upl_approval' => 'Dodaj odobritev',
        'edit_pics' => 'Uredi sliko',
        'see_next' => 'Naslednja slika',
        'see_prev' => 'predhodna slika',
        'n_pic' => '%s slik',
        'n_of_pic_to_disp' => '�tevilo slik za prikaz',
        'apply' => 'Izvedi spremembe'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
        'group_name' => 'Ime skupine',
        'disk_quota' => 'Velikost diska',
        'can_rate' => 'Lahko ocenjuje slike',
        'can_send_ecards' => 'Lahko po�ilja razglednice',
        'can_post_com' => 'Lahko dodaja komentarje',
        'can_upload' => 'Lahko dodaja slike',
        'can_have_gallery' => 'Lahko ima osebno galerijo',
        'apply' => 'Izvedi spremembe',
        'create_new_group' => 'Ustvari novo skupino',
        'del_groups' => 'Pobri�i izbrano skupino',
        'confirm_del' => 'Opozorilo: pri brisanju skupine se vsi �lani prmaknejo v skupino z imenom \'Registered\'!\n\n�eli� nadaljevati?',
        'title' => 'Urejanje uporabni�kih skupin',
        'approval_1' => 'Javne odobritve slik (1)',
        'approval_2' => 'Privatne odobritve slik (2)',
        'note1' => '<b>(1)</b> Slike v javnih albumih potrebujejo odobritev za prikaz',
        'note2' => '<b>(2)</b> Slike v privatnih albumih potrebujejo odobritev za prikaz',
        'notes' => 'Notes'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
        'welcome' => 'Dobrodo�el!'
);

$lang_album_admin_menu = array(
        'confirm_delete' => 'Res �eli� pobrisati ta album? \\nVse slike in komentarji bodo pobriani.',
        'delete' => 'BRISANJE',
        'modify' => 'LASTNOSTI',
        'edit_pics' => 'UREJANJE',
);

$lang_list_categories = array(
        'home' => 'Domov',
        'stat1' => '�t. slik:<b>[pictures]</b> - �t. albumov:<b>[albums]</b> - �t. kategorij:<b>[cat]</b>  - �t. komentarjev:<b>[comments]</b> - �t. ogledov:<b>[views]</b>',
        'stat2' => '�t. slik:<b>[pictures]</b> - �t. albumov:<b>[albums]</b> - �t. ogledov<b>[views]</b>',
        'xx_s_gallery' => 'Galerija od %s',
        'stat3' => '�t. slik:<b>[pictures]</b> - �t. albumov:<b>[albums]</b> - �t. komentarjev:<b>[comments]</b>  - �t. ogledov:<b>[views]</b>'
);

$lang_list_users = array(
        'user_list' => 'Seznam uporabnikov',
        'no_user_gal' => 'Brez uporabni�kih galerij',
        'n_albums' => '�t. albumov:%s',
        'n_pics' => '�t. slik:%s'
);

$lang_list_albums = array(
        'n_pictures' => '�t. slik:%s',
        'last_added' => ', zadnja dodana %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
        'login' => 'Login',
        'enter_login_pswd' => 'Enter your username and password to login',
        'username' => 'Username',
        'password' => 'Password',
        'remember_me' => 'Remember me',
        'welcome' => 'Welcome %s ...',
        'err_login' => '*** Couldn\'t log in. Try again ***',
        'err_already_logged_in' => 'You are already logged in !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
        'logout' => 'Odjava',
        'bye' => 'Lepo pozdravljen %s ...',
        'err_not_loged_in' => 'Nisi prijavljen!',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
        'upd_alb_n' => 'Posodobi album %s',
        'general_settings' => 'Splo�ne nastavitve',
        'alb_title' => 'Ime albuma',
        'alb_cat' => 'Kategorija od albuma',
        'alb_desc' => 'Opis albuma',
        'alb_thumb' => 'Ikona albuma',
        'alb_perm' => 'Pravice za ta album',
        'can_view' => 'Album lahko vidijo',
        'can_upload' => 'Obiskovalci lahko dodajajo slike',
        'can_post_comments' => 'Obiskovalci lahko dodajajo komentarje',
        'can_rate' => 'Obiskovalci lahko ocenjujejo slike',
        'user_gal' => 'Uporabni�ka galerija',
        'no_cat' => '* Brez kategorije *',
        'alb_empty' => 'Album je prazen',
        'last_uploaded' => 'Zadnje dodano...',
        'public_alb' => 'Vsi (javni album)',
        'me_only' => 'Samo jaz',
        'owner_only' => 'Lastnik albuma (%s)',
        'groupp_only' => '�lani skupine \'%s\'',
        'err_no_alb_to_modify' => 'Brez albuma - spremembe mo�ne samo v bazi.',
        'update' => 'Posodobi album'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
        'already_rated' => 'Oprosti, ampak to sliko si �e ocenil',
        'rate_ok' => 'Tvoja ocena je bila zabele�ena',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
�eprav bo administrator {SITE_NAME} posku�al odstraniti vsako neprimerno vsebino objavljeno v galeriji, je nemogo�e hkrati in pravo�asno pregledati vse kar je objavljeno s strani obiskovalcev. Zavedati se morate, da vse objavljeno na teh straneh predstavlja pogled in mnenje avtorja in ne administratorja oz. vzdr�evalca teh spletnih strani (razen tistega kar je objavljeno z njune strani).<br />
<br />
S sodelovanjem na teh spletnih straneh se tudi strinjate, da ne boste objavljali nobenih obscenih, vulgarnih, �aljivih, seksualnih, sovra�nih, rasno nestrpnih in ostalih vsebin, ki so v nasprotju z veljavno zakonodajo. Strinjate se tudi, da ima aministrator in/ali moderator dolo�enih vsebin na {SITE_NAME} pravico v katerem koli trenutku pravico odstraniti po njegovem mnenju sporni objavljeni prispevek. Kot uporabnik se strinjate, da je z va�e strani objavljeno gradivo shranjeno v bazi. �eprav ti podatki ne bodo posredovani nobeni tretji stranki, administrator oziroma skrbnik teh strani ne odgovarja za izgubljene podatke v primeru hekerskega poskusa kraje podatkov.<br />
<br />
Te spletne strani uporabljajo pi�kotke (cookies) za shranjevanje informacij na va�em ra�unalniku. Ti podatki so namenjeni isklju�no temu, da vam olaj�ajo brskanje na teh straneh. Va� email naslov pa je uporabljen samo za to, da vam lahko posredujemo geslo za prijavo.<br />
<br />
S klikom na 'STRINJAM SE' potrjujete, da ste seznanjeni s pogoji sodelovanje na straneh {SITE_NAME}.
EOT;

$lang_register_php = array(
        'page_title' => 'Registracija',
        'term_cond' => 'Navodila in pogoji za sodelovanje',
        'i_agree' => 'STRINJAM SE',
        'submit' => 'Po�lji registracijo',
        'err_user_exists' => 'To uporabni�ko ime �e obstaja, izberi si drugo',
        'err_password_mismatch' => 'Gesli se ne ujemata - ponovi vpis',
        'err_uname_short' => 'Uporabni�ko ime mora imeti vsaj dva znaka',
        'err_password_short' => 'Geslo mora biti dolgo vsaj dva znaka',
        'err_uname_pass_diff' => 'Uporabni�ko ime in geslo morata biti razli�na',
        'err_invalid_email' => 'Napa�ni e-mail naslov!',
        'err_duplicate_email' => 'Ta e-mail naslov je nekdo �e uporabil',
        'enter_info' => 'Vpis podatkov za registracijo',
        'required_info' => 'Obvezni podatki',
        'optional_info' => 'Neobvezni vpis',
        'username' => 'Uporabni�ko ime',
        'password' => 'Geslo',
        'password_again' => 'Ponovi geslo',
        'email' => 'e-mail',
        'location' => 'Kraj',
        'interests' => 'Zanimanje',
        'website' => 'Doma�a stran',
        'occupation' => 'Zaposlitev',
        'error' => 'NAPAKA',
        'confirm_email_subject' => '%s - registracija potrjena',
        'information' => 'Informacija',
        'failed_sending_email' => 'Ne morem poslati e-mail sporo�ila s podatki o registraciji!',
        'thank_you' => 'Hvala za registracijo.<br /><br />Navodila za aktiviranje ra�una so bila poslana na vpisani e-mail naslov.',
        'acct_created' => 'Tvoj ra�un je bil ustvarjen - lahko se prijavi� s svojim uporabni�kim imenom in geslom',
        'acct_active' => 'Tvoj ra�un je aktiven in se lahko prijavi�',
        'acct_already_act' => 'Tvoj ra�un je �e aktiven!',
        'acct_act_failed' => 'Tega ra�una ni mo�no aktivirati!',
        'err_unk_user' => 'Izbrani uporabnik ne obstaja!',
        'x_s_profile' => 'Profil od %s',
        'group' => 'Skupina',
        'reg_date' => 'Datum pristopa',
        'disk_usage' => 'Velikost diska',
        'change_pass' => 'Spremeni geslo',
        'current_pass' => 'Staro geslo',
        'new_pass' => 'Novo geslo',
        'new_pass_again' => 'Novo geslo ponovno',
        'err_curr_pass' => 'Staro geslo ni pravilno',
        'apply_modif' => 'Izvedi spremembe',
        'change_pass' => 'Spremeni moje geslo',
        'update_success' => 'Profil je bil posodobljen',
        'pass_chg_success' => 'Geslo je bilo spremenjeno',
        'pass_chg_error' => 'Geslo ni bilo spremenjeno',
);

$lang_register_confirm_email = <<<EOT
Hvala za registracijo pri: {SITE_NAME}

Tvoje uporabni�ko ime je: "{USER_NAME}"
Tvoje geslo je: "{PASSWORD}"

�e �eli� aktivirati svoj ra�un, mora� klikniti na spodnjo povezavo
ali pa jo vpisati v naslovno vrstico brskalnika.

{ACT_LINK}

Lep pozdrav,

administrator od {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
        'title' => 'Prikaz komentarjev',
        'no_comment' => 'Ni komentarjev za prikaz',
        'n_comm_del' => '�t. pobrisanik komentarjev:%s',
        'n_comm_disp' => '�t. komentarjev za prikaz',
        'see_prev' => 'Poglej predhodnega',
        'see_next' => 'Poglej naslednjega',
        'del_comm' => 'Pobri�i izbrane komentarje',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
        0 => 'Iskanje slik',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
        'page_title' => 'Iskanje novih slik',
        'select_dir' => 'Izberi direktorij',
        'select_dir_msg' => 'Ta ukaz ti omogo�a dodajanje slik, ki si jih dodal na server s pomo�jo FTP protokola.<br /><br />Izberi direktorij v katerega si dodal slike',
        'no_pic_to_add' => 'Tu ni nobenih slik za dodajanje',
        'need_one_album' => 'Za uporabo te funkcije mora� imeti vsaj en album',
        'warning' => 'Opozorilo',
        'change_perm' => 'pisanje v direktorij ni omogo�eno, spremeni pravice v 755 ali 777 pred ponovnim poskusom dodajanja slik!',
        'target_album' => '<b>Dodaj slike </b>%s<b> v </b>%s',
        'folder' => 'Direktorij',
        'image' => 'Slika',
        'album' => 'Album',
        'result' => 'Rezultat',
        'dir_ro' => 'Pisanje onemogo�eno. ',
        'dir_cant_read' => 'Branje onemobo�eno. ',
        'insert' => 'Dodajanje novih slik v galerijo',
        'list_new_pic' => 'Seznam novih slik',
        'insert_selected' => 'Dodaj izbrane slike',
        'no_pic_found' => 'Brez novih slik',
        'be_patient' => 'Potrpe�ljivost... dodajanje traja nekaj �asa',
        'notes' =>  '<ul>'.
                                '<li><b>OK</b>: pomeni, da so slike uspe�no dodane'.
                                '<li><b>DP</b>: pomeni, da je slika duplikat in je �e v bazi'.
                                '<li><b>PB</b>: pomeni, da slike ni mo�no dodati. Preveri nastavitve in pravice za direktorij v katerem se nahajajo'.
                                '<li>�e ne vidi� oznak OK, DP ali PB, klikni na manjkajo�o slikico za prikaz napake, ki jo generira PHP'.
                                '<li>Za osve�itev prikaza pritisni tipko reload  v svojem brskalniku'.
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
                'title' => 'Zavrni uporabnika', //new in cpg1.2.0
                'user_name' => 'Uporabni�ko ime', //new in cpg1.2.0
                'ip_address' => 'IP naslov', //new in cpg1.2.0
                'expiry' => 'Pote�e (za trajno - pusti prazno)', //new in cpg1.2.0
                'edit_ban' => 'Shrani spremembe', //new in cpg1.2.0
                'delete_ban' => 'Pobri�i', //new in cpg1.2.0
                'add_new' => 'Dodaj novo prepoved', //new in cpg1.2.0
                'add_ban' => 'Dodaj', //new in cpg1.2.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
        'title' => 'Dodaj sliko',
        'max_fsize' => 'Najve�ja dovoljena velikost datoteke je %s kB',
        'album' => 'Album',
        'picture' => 'Slika',
        'pic_title' => 'Ime slike',
        'description' => 'Opis slike',
        'keywords' => 'Klju�ne besede (lo�i jih s presledki)',
        'err_no_alb_uploadables' => 'Oprosti, trenutno ni albuma v katerega bi lahko dodal slike',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
        'title' => 'Urejanje uporabnikov',
        'name_a' => 'Ime nara��ajo�e',
        'name_d' => 'Ime padajo�e',
        'group_a' => 'Skupina nara��ajo�e',
        'group_d' => 'Skupina padajo�e',
        'reg_a' => 'Datum reg. nara��ajo�e',
        'reg_d' => 'Datum reg. padajo�e',
        'pic_a' => '�t. slik nara��ajo�e',
        'pic_d' => '�t. slik padajo�e',
        'disku_a' => 'Poraba diska nara��ajo�e',
        'disku_d' => 'Poraba diska padajo�e',
        'sort_by' => 'Sortiraj uporabnike po',
        'err_no_users' => 'Tabela s podatki je prazna!',
        'err_edit_self' => 'Svojega prifila ne more� spremeniti. Uporabi povezavo \'Moj profil\'',
        'edit' => 'UREJANJE',
        'delete' => 'BRISANJE',
        'name' => 'Uporabni�ko ime',
        'group' => 'Skupina',
        'inactive' => 'Neaktivni',
        'operations' => 'Operacije',
        'pictures' => 'Slike',
        'disk_space' => 'Porabljen prostor',
        'registered_on' => 'Registriran',
        'u_user_on_p_pages' => '�t. uporabnikov:%d (�t. strani:%d)',
        'confirm_del' => 'Res �eli� pobrisati tega uporabnika? \\nTudi njegove slike in albumi bodo pobrisani.',
        'mail' => 'PO�TA',
        'err_unknown_user' => 'Izbrani uporabnik ne obstaja!',
        'modify_user' => 'Uredi uporabnika',
        'notes' => 'Opombe',
        'note_list' => '<li>�e gesla ne �eli� spreminjati, pusti polje za geslo prazno',
        'password' => 'Geslo',
        'user_active' => 'Uporabnik je aktiven',
        'user_group' => 'Uporabnikova skupina',
        'user_email' => 'Uporabnikov email',
        'user_web_site' => 'Uporabnikova doma�a stran',
        'create_new_user' => 'Ustvari novega uporabnika',
        'user_location' => 'Uporabnikova lokacija',
        'user_interests' => 'Uporabnikovo zanimanje',
        'user_occupation' => 'Uporabnikova zaposlitev',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Spremeni velikost slik', //new in cpg1.2.0
        'what_it_does' => 'Kaj to pomeni', //new in cpg1.2.0
        'what_update_titles' => 'Kreira imena slik iz imena datotek', //new in cpg1.2.0
        'what_delete_title' => 'Brisanje imen', //new in cpg1.2.0
        'what_rebuild' => 'Ponastavi ikone in spremeni velikost slik', //new in cpg1.2.0
        'what_delete_originals' => 'Pobri�e originalne slike in jih nadomesti z novimi', //new in cpg1.2.0
        'file' => 'Datoteka', //new in cpg1.2.0
        'title_set_to' => 'naslov spremenjen v', //new in cpg1.2.0
        'submit_form' => 'po�lji', //new in cpg1.2.0
        'updated_succesfully' => 'uspe�no posodobljeno', //new in cpg1.2.0
        'error_create' => 'NAPAKA pri kreiranju', //new in cpg1.2.0
        'continue' => 'Nadaljuj na naslednjih slikah', //new in cpg1.2.0
        'main_success' => 'Datoteka %s je bila uporabljena za originalno sliko', //new in cpg1.2.0
        'error_rename' => 'Napaka pri preimenovanju %s v %s', //new in cpg1.2.0
        'error_not_found' => 'Ne najdem datoteke %s', //new in cpg1.2.0
        'back' => 'nazaj na glavno stran', //new in cpg1.2.0
        'thumbs_wait' => 'Poteka posodabljanje ikon in/ali spreminjanje slik, prosim po�akaj...', //new in cpg1.2.0
        'thumbs_continue_wait' => 'Nadaljujem s posodabljanjem ikon in/ali slik, prosim po�akaj...', //new in cpg1.2.0
        'titles_wait' => 'Posodabljanje naslovov, prosim po�akaj...', //new in cpg1.2.0
        'delete_wait' => 'Brisanje naslovov, prosim po�akaj...', //new in cpg1.2.0
        'replace_wait' => 'Brisanje originalnih slik in nadome��anje s spremenjenimi, prosim po�akaj..', //new in cpg1.2.0
        'instruction' => 'Kratka navodila', //new in cpg1.2.0
        'instruction_action' => 'Izberi ukaz', //new in cpg1.2.0
        'instruction_parameter' => 'Nastavi parametre', //new in cpg1.2.0
        'instruction_album' => 'Izberi album', //new in cpg1.2.0
        'instruction_press' => 'Pritisni %s', //new in cpg1.2.0
        'update' => 'Posodobi ikone in/ali spremeni velikost slik', //new in cpg1.2.0
        'update_what' => 'Kaj naj posodobim', //new in cpg1.2.0
        'update_thumb' => 'Samo ikone', //new in cpg1.2.0
        'update_pic' => 'Samo spremenjene slike', //new in cpg1.2.0
        'update_both' => 'Ikone in spremenjene slike', //new in cpg1.2.0
        'update_number' => '�tevilo slik za spreminjanje za vsak klik', //new in cpg1.2.0
        'update_option' => '(Poskusi z manj�o vrednostjo, �e pride do poteka �asa med izvajanjem opracije)', //new in cpg1.2.0
        'filename_title' => 'Ime datoteke &rArr; Ime slike', //new in cpg1.2.0
        'filename_how' => 'Kako naj pretvorim ime datoteke', //new in cpg1.2.0
        'filename_remove' => 'Odstrani kon�nico .jpg in nadomesti _ (pod�rtaj) s presledki', //new in cpg1.2.0
        'filename_euro' => 'Spremeni 2003_11_23_13_20_20.jpg v 23/11/2003 13:20', //new in cpg1.2.0
        'filename_us' => 'Spremeni 2003_11_23_13_20_20.jpg v 11/23/2003 13:20', //new in cpg1.2.0
        'filename_time' => 'Spremeni 2003_11_23_13_20_20.jpg v 13:20', //new in cpg1.2.0
        'delete' => 'Pobri�i naslove slik ali originalne slike', //new in cpg1.2.0
        'delete_title' => 'Pobri�i naslove slik', //new in cpg1.2.0
        'delete_original' => 'Pobri�i originalne slike', //new in cpg1.2.0
        'delete_replace' => 'Pobri�i originalne slike, nadomesti jih s spremenjenimi (po velikosti)', //new in cpg1.2.0
        'select_album' => 'Izberi album', //new in cpg1.2.0
);

?>