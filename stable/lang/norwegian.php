<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery  1.2.1                                          //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gregory DEMAR                                   //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning St�verud <henning@stoverud.com>         //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
//  Updated by the Coppermine Dev Team                                       //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

$lang_translation_info = array( 
'lang_name_english' => 'Norwegian',  //the name of your language in English, e.g. 'Greek' or 'Spanish' 
'lang_name_native' => 'Norsk', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa�ol' 
'lang_country_code' => 'no', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es' 
'trans_name'=> 'FinnK', //the name of the translator - can be a nickname 
'trans_email' => '', //translator's email address (optional) 
'trans_website' => '', //translator's website (optional) 
'trans_date' => '2003-12-22', //the date the translation was created / last modified 
); 

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'kB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('S�n', 'Man', 'Tir', 'Ons', 'Tor', 'Fre', 'L�r');
$lang_month = array('Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des');

// Some common strings
$lang_yes = 'Ja';
$lang_no  = 'Nei';
$lang_back = 'TILBAKE';
$lang_continue = 'FORTSETT';
$lang_info = 'Informasjon';
$lang_error = 'Feil';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%d. %B, %Y';
$lastcom_date_fmt =  '%d/%b/%y kl. %H:%M';
$lastup_date_fmt = '%d. %B, %Y';
$register_date_fmt = '%d. %B, %Y';
$lasthit_date_fmt = '%d. %B, %Y kl. %R';
$comment_date_fmt =  '%d. %B, %Y kl. %R';

// For the word censor (sensurer ufine ord)
$lang_bad_words = array('*faen*', 'fitte', 'kuk', 'hore*', 'klitt', 'pakkis', 's�d', 'helvete', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array( 
        'random' => 'Tilfeldige bilder', 
        'lastup' => 'Siste bilder', 
        'lastalb'=> 'Sist oppdaterte album', 
        'lastcom' => 'Siste kommentarer', 
        'topn' => 'Mest viste', 
        'toprated' => 'Beste karakter', 
        'lasthits' => 'Siste visninger', 
        'search' => 'S�keresultat', 
        'favpics'=> 'Favoritter'//new in cpg1.2.0
); 

$lang_errors = array(
	'access_denied' => 'Du har ikke adgang til denne siden.',
	'perm_denied' => 'Du kan ikke utf�re denne handlingen.',
	'param_missing' => 'Scriptet ble kallet uten n�dvendige paramentere.',
	'non_exist_ap' => 'Det valgte album/bilde eksisterer ikke!',
	'quota_exceeded' => 'Disk-kvote er oppbrukt<br /><br />Du har plass til [quota]K, dine bilder bruker [space]K. Legger du inn flere bilder overskrider du kvoten',
	'gd_file_type_err' => 'N�r albumet bruker GD Graphics- teknikk er det kun tillatt � bruke JPEG eller PNG bilder.',
	'invalid_image' => 'Bildet du lastet opp er defekt eller st�ttes ikke av GD teknikk',
	'resize_failed' => 'Kunne ikke forandre st�rrelsen p� bildet eller opprette miniatyrbilde.',
	'no_img_to_display' => 'Ingen bilder � vise',
	'non_exist_cat' => 'Den valgte kategorien eksisterer ikke',
	'orphan_cat' => 'En kategori er -foreldrel�s-. Kj�r kategoriadministrasjon for � rette p� problemet.',
	'directory_ro' => 'Mappen \'%s\' er skrivebeskyttet. Bildet kan ikke slettes.',
	'non_exist_comment' => 'Den valgte kommentaren finnes ikke.',
     'pic_in_invalid_album' => 'Det er bilder i et album som ikke eksisterer (%s)!?', 
     'banned' => 'Du har mistet tillatelsen til � bruke dette internettstedet.', 
     'not_with_udb' => 'Funksjonen er deaktivert fordi Coppermine kj�rer sammen med et diskusjonsforum.', 
); 

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'G� til albumlisten',
	'alb_list_lnk' => 'Albumliste',
	'my_gal_title' => 'G� til personlig galleri',
	'my_gal_lnk' => 'Mitt galleri',
	'my_prof_lnk' => 'Min profil',
	'adm_mode_title' => 'Skift til admin modus',
	'adm_mode_lnk' => 'Admin modus',
	'usr_mode_title' => 'Skift til bruker modus',
	'usr_mode_lnk' => 'Bruker modus',
	'upload_pic_title' => 'Last opp et bilde til et album',
	'upload_pic_lnk' => 'Last opp bilde',
	'register_title' => 'Opprett konto',
	'register_lnk' => 'Registrer',
	'login_lnk' => 'Logg inn',
	'logout_lnk' => 'Logg ut',
	'lastup_lnk' => 'Siste opplastinger',
	'lastcom_lnk' => 'Siste kommentarer',
	'topn_lnk' => 'Mest viste',
	'toprated_lnk' => 'Beste karakter',
	'search_lnk' => 'S�k',
	'fav_lnk' => 'Mine favoritter', //new in cpg1.2.0
    'ban_lnk' => 'Utvis brukere', //new in cpg1.2.0
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Last opp til godkjennelse',
	'config_lnk' => 'Konfigurasjon',
	'albums_lnk' => 'Album',
	'categories_lnk' => 'Kategorier',
	'users_lnk' => 'Brukere',
	'groups_lnk' => 'Grupper',
	'comments_lnk' => 'Kommentarer',
	'searchnew_lnk' => 'Legg inn nye bilder',
	'util_lnk' => 'Endre bildedimensjoner', 
    'ban_lnk' => 'Utvis brukere', 
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Opprett / ordne albumer',
	'modifyalb_lnk' => 'Rediger album',
	'my_prof_lnk' => 'Min profil',
);

$lang_cat_list = array(
	'category' => 'Kategori',
	'albums' => 'Album',
	'pictures' => 'Bilder',
);

$lang_album_list = array(
	'album_on_page' => '%d album p� %d side(r)'
);

$lang_thumb_view = array(
	'date' => 'DATO',
	
    'name' => 'FILNAVN', 
     'title' => 'TITTEL', 
	'sort_da' => 'Sorter p� dato i stigende rekkef�lge',
	'sort_dd' => 'Sorter p� dato i synkende rekkef�lge',
	'sort_na' => 'Sorter p� filnavn i stigende rekkef�lge',
	'sort_nd' => 'Sorter p� filnavn i synkende rekkef�lge',
	 'sort_ta' => 'Sorter p� tittel i stigende rekkef�lge', 
     'sort_td' => 'Sorter p� tittel i synkende rekkef�lge', 
	'pic_on_page' => '%d bilder p� %d side(r)',
	'user_on_page' => '%d brukere p� %d side(r)'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Tilbake til oversikt',
	'pic_info_title' => 'Vis/skjul informasjon om bildet',
	'slideshow_title' => 'Lysbildeshow',
	'ecard_title' => 'Send dette bildet som et e-postkort',
	'ecard_disabled' => 'e-postkort er sl�tt av',
	'ecard_disabled_msg' => 'Du har ikke tillatelse til � sende e-postkort',
	'prev_title' => 'Se forrige bilde',
	'next_title' => 'Se neste bilde',
	'pic_pos' => 'BILDE %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Gi karakter til dette bildet ',
	'no_votes' => '(Ingen karakterer enda)',
	'rating' => '(Aktuell karakter : %s / 5 med %s stemmer)',
	'rubbish' => 'S�ppel',
	'poor' => 'D�rlig',
	'fair' => 'Greit nok',
	'good' => 'Bra',
	'excellent' => 'Veldig bra',
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
	CRITICAL_ERROR => 'Kritisk feil',
	'file' => 'Fil: ',
	'line' => 'Linje: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Filnavn: ',
	'filesize' => 'Filst�rrelse: ',
	'dimensions' => 'Dimensjoner: ',
	'date_added' => 'Lagt inn dato: '
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
	'Exclamation' => 'Utrop',
	'Question' => 'Sp�rsm�l',
	'Very Happy' => 'Veldig glad',
	'Smile' => 'Smil',
	'Sad' => 'Trist',
	'Surprised' => 'Overrasket',
	'Shocked' => 'Sjokkert',
	'Confused' => 'Forvirret',
	'Cool' => 'Kult',
	'Laughing' => 'Latter',
	'Mad' => 'Sur/Sint',
	'Razz' => 'Fleiper',
	'Embarassed' => 'Flau',
	'Crying or Very sad' => 'Gr�ter eller veldig trist',
	'Evil or Very Mad' => 'Ond eller veldig sint',
	'Twisted Evil' => 'Ond',
	'Rolling Eyes' => 'Ruller med �yne',
	'Wink' => 'Blunker lurt',
	'Idea' => 'God ide',
	'Arrow' => 'Pil',
	'Neutral' => 'N�ytral',
	'Mr. Green' => 'Mr. Gr�nn',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'g�r ut av admin mode...',
	1 => 'g�r inn i admin mode...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Album m� ha et navn!',
	'confirm_modifs' => 'Er du sikker p� at du vil lagre disse instillingene?',
	'no_change' => 'Du gjorde ingen endringer!',
	'new_album' => 'Nytt album',
	'confirm_delete1' => 'Er du sikker p� at du vil slette dette albumet?',
	'confirm_delete2' => '\nAlle bilder og kommentarer vil forsvinne!',
	'select_first' => 'Velg et album f�rst ',
	'alb_mrg' => 'Album administrasjon',
	'my_gallery' => '* Mitt galleri *',
	'no_category' => '* Ingen kategori *',
	'delete' => 'Slett',
	'new' => 'Ny',
	'apply_modifs' => 'Gjennomf�r endringer',
	'select_category' => 'Velg kategori',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'N�dvendige parametere for \'%s\'operasjonen manglet!',
	'unknown_cat' => 'Den valgte kategorien eksisterer ikke i databasen',
	'usergal_cat_ro' => 'Brukergalleri kategorien kan ikke slettes!',
	'manage_cat' => 'Administrer kategorier',
	'confirm_delete' => 'Er du sikker p� at du �nsker og SLETTE denne kategorien?',
	'category' => 'Kategori',
	'operations' => 'Handling',
	'move_into' => 'Flytt til',
	'update_create' => 'Oppdater/Opprett kategori',
	'parent_cat' => 'Hovedkategori',
	'cat_title' => 'Kategoritittel',
	'cat_desc' => 'Kategoribeskrivelse'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Konfigurasjon',
	'restore_cfg' => 'Gjenopprett standardoppsett',
	'save_cfg' => 'Lagre ny konfigurasjon',
	'notes' => 'Notater',
	'info' => 'Informasjon',
	'upd_success' => 'Coppermine konfigurasjonen ble oppdatert',
	'restore_success' => 'Coppermine standartoppsett er gjenninstallert',
	'name_a' => 'Navn stigende',
	'name_d' => 'Navn synkende',
	'title_a' => 'Tittel i stigende rekkef�lge', 
    'title_d' => 'Tittel i synkende rekkef�lge', 
	'date_a' => 'Dato stigende',
	'date_d' => 'Dato synkende',
        'th_any' => 'Maks h�yde/bredde',
        'th_ht' => 'h�yde',
        'th_wd' => 'bredde',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Generelle instillinger',
	array('Gallerinavn', 'gallery_name', 0),
	array('Galleribeskrivelse', 'gallery_description', 0),
	array('Galleriadministrators e-post', 'gallery_admin_email', 0),
	array('M�ladressen for \'Se flere bilder\' link i e-postkort', 'ecards_more_pic_target', 0),
	array('Spr�k', 'lang', 5),
	array('Tema', 'theme', 6),

	'Album liste visning',
	array('Bredde p� hovedtabell (piksler eller %)', 'main_table_width', 0),
	array('Antall kategoriniv�er som skal vises', 'subcat_level', 0),
	array('Antall album som skal vises pr.side', 'albums_per_page', 0),
	array('Antall kolonner i albumlisten', 'album_list_cols', 0),
	array('St�rrelse p� miniatyrbilde i piksler', 'alb_list_thumb_size', 0),
	array('Innholdet p� hovedsiden', 'main_page_layout', 0),
	array('Vis miniatyrbilder fra �verste albumniv� i kategorier','first_level',1), 

	'Miniatyrbilde',
	array('Antall kolonner p� siden med miniatyrbilder', 'thumbcols', 0),
	array('Antall rader p� siden med miniatyrbilder', 'thumbrows', 0),
	array('Maks antall side-snarveier som skal vises p� siden', 'max_tabs', 0),
	array('Vis bildebeskrivelsen (i tillegg til tittelen) under miniatyrbildet', 'caption_in_thumbview', 1),
	array('Vis antall kommentarer under miniatyrbilde', 'display_comment_count', 1),
	array('Standard sortering av bildene', 'default_sort_order', 3),
	array('Minimum antall stemmer p� bilde f�r visning i \'beste karakter\' listen', 'min_votes_for_rating', 0),

	'Bildevisning og kommentarinnstillinger',
	array('Bredden av tabellen for visning av bilder (piksler eller %)', 'picture_table_width', 0),
	array('Bildeinformasjon er synlig som standard', 'display_pic_info', 1),
	array('Filtrer ufine ord som standard', 'filter_bad_words', 1),
	array('Smilefjes er tillatt i kommentarer', 'enable_smilies', 1),
	array('Maksimum lengde p� bildebeskrivelsen', 'max_img_desc_length', 0),
	array('Maks antall karakterer i et ord', 'max_com_wlength', 0),
	array('Maks antall linjer i en kommentar', 'max_com_lines', 0),
	array('Maks lengde p� en kommentar', 'max_com_size', 0),
	array('Vis filmstripe', 'display_film_strip', 1), 
    array('Antall enheter i filmstripe', 'max_film_strip_items', 0), 

	'Bilder og miniatyrbilder',
	array('Kvalitet p� JPEG-filer', 'jpeg_qual', 0),
	array('Maks dimensjon for et miniatyrbilde <b>*</b>', 'thumb_width', 0),
    array('Bruk dimensjon (bredde, h�yde eller maks bredde/h�yde for mineatyrbilder)<b>*</b>', 'thumb_use', 7),  //Get a "invalid error" message on configuration page 
	array('Opprett mellomst�rrelse-bilder','make_intermediate',1),
	array('Maks bredde eller h�yde for et mellomst�rrelse-bilder <b>*</b>', 'picture_width', 0),
	array('Maks filst�rrelse for bilder til opplasting (kB)', 'max_upl_size', 0),
	array('Maks bredde eller h�yde for bilder til opplasting (piksler)', 'max_upl_width_height', 0),

	'Instillinger for brukere',
	array('Tillat at nye brukere kan registrere seg', 'allow_user_registration', 1),
	array('Brukerregistrering skal verifiseres via epost', 'reg_requires_valid_email', 1),
	array('Tillat to brukere og ha samme e-postadresse', 'allow_duplicate_emails_addr', 1),
	array('Brukere kan ha private album', 'allow_private_albums', 1),

	'Spesialfelt ved bildebeskrivelse (la disse v�re tomme hvis de ikke skal brukes)',
	array('Felt 1 navn', 'user_field1_name', 0),
	array('Felt 2 navn', 'user_field2_name', 0),
	array('Felt 3 navn', 'user_field3_name', 0),
	array('Felt 4 navn', 'user_field4_name', 0),

	'Avanserte instillinger for bilder og miniatyrbilder',
	array('Vis ikon for privat album til ikke p�logget bruker','show_private',1), 
	array('Forbudte tegn i filnavn', 'forbiden_fname_char',0),
	array('Aksepterte filtyper for opplasting', 'allowed_file_extensions',0),
	array('Metode for endring av bildest�rrelse','thumb_method',2),
	array('Adresse(sti) til ImageMagick \'konverterings\' verkt�y (eksempel /usr/bin/X11/)', 'impath', 0),
	array('Tillatte bildetyper (kun gyldig ved bruk av ImageMagick)', 'allowed_img_types',0),
	array('Kommandolinje-oppsjoner ved bruk av ImageMagick', 'im_options', 0),
	array('Les EXIF data i JPEG filer', 'read_exif_data', 1),
	array('Album mappen <b>*</b>', 'fullpath', 0),
	array('Mappen for brukerenes bilder <b>*</b>', 'userpics', 0),
	array('Prefiks for mellomst�rrelse-bilder <b>*</b>', 'normal_pfx', 0),
	array('Prefiks for miniatyrbilder <b>*</b>', 'thumb_pfx', 0),
	array('Standard modus for mapper', 'default_dir_mode', 0),
	array('Standard modus for bilder', 'default_file_mode', 0),

	'Cookies og tegnkoding',
	array('Navnet p� cookie-en som brukes av dette systemet', 'cookie_name', 0),
	array('Adressen/stien til den cookie-en som brukes av dette systemet', 'cookie_path', 0),
	array('Tegnkoding', 'charset', 4),

	'Diverse instillinger',
	array('Aktiver testmodus (debug)', 'debug_mode', 1),
	
	'<br /><div align="center">(*) Felt markert med * m� ikke forandres hvis du allerede har bilder galleriet ditt</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Du m� skrive navnet ditt og en kommentar',
	'com_added' => 'Kommentaren din har blitt lagt inn',
	'alb_need_title' => 'Du m� legge inn en tittel p� albumet !',
	'no_udp_needed' => 'Ingen oppdatering var n�dvendig.',
	'alb_updated' => 'Albumet ble oppdatert',
	'unknown_album' => 'Det valgte albumet eksisterer ikke eller du har ikke tillatelse til � laste opp bilder i dette albumet',
	'no_pic_uploaded' => 'Det ble ikke lastet opp noe bilde!<br /><br />Hvis du virkelig valgte et bilde s� sjekk om serveren tillater opplasting av filer...',
	'err_mkdir' => 'Klarte ikke � lage en mappe %s !',
	'dest_dir_ro' => 'M�lmappen %s kan ikke skrives til av dette skriptet !',
	'err_move' => 'Umulig � flytte %s til %s !',
	'err_fsize_too_large' => 'Filst�rrelsen p� bildet du har lastet opp er for stor (maks tillatt er %s KB) !',
	'err_imgsize_too_large' => 'Bildest�rrelsen p� bildet du har lastet opp er for stor (maks tillatt er %s x %s) !',
	'err_invalid_img' => 'Filen du har lastet opp er ikke en gyldig bildefil !',
	'allowed_img_types' => 'Du kan bare laste opp %s bilder.',
	'err_insert_pic' => 'Bildet \'%s\' kan ikke legges inn i albumet ',
	'upload_success' => 'Opplastingen av bildet ditt var vellykket<br /><br />Det vil komme tilsyne etter at administratoren har godkjent det.',
	'info' => 'Informasjon',
	'com_added' => 'Kommentar lagt til',
	'alb_updated' => 'Albumet ble oppdatert',
	'err_comment_empty' => 'Kommentaren din er tom!',
	'err_invalid_fext' => 'Bare filer med disse fil-endelsene er tillatt : <br /><br />%s.',
	'no_flood' => 'Beklager, men du st�r allerede som forfatter av den siste kommentaren som er lagt inn til dette bildet <br /><br />Du kan redigere kommentaren du har lagt inn hvis du vil forandre p� den',
	'redirect_msg' => 'Du blir omdirigert.<br /><br /><br />Klikk \'FORTSETT\' hvis ikke siden oppdateres automatisk',
	'upl_success' => 'Bildet ditt har blitt lagt inn',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Beskrivelse',
	'fs_pic' => 'Full-st�rrelse bilde',
	'del_success' => 'sletting vellykket',
	'ns_pic' => 'Normalst�rrelse bilde',
	'err_del' => 'Kan ikke slettes',
	'thumb_pic' => 'Miniatyrbilde',
	'comment' => 'Kommentar',
	'im_in_alb' => 'Bilde i album',
	'alb_del_success' => 'Album \'%s\' slettet',
	'alb_mgr' => 'Album Administrator',
	'err_invalid_data' => 'Ugyldige data mottatt i \'%s\'',
	'create_alb' => 'Oppretter album \'%s\'',
	'update_alb' => 'Oppdaterer album \'%s\' med tittel \'%s\' og indeks \'%s\'',
	'del_pic' => 'Slett bilde',
	'del_alb' => 'Slett album',
	'del_user' => 'Slett bruker',
	'err_unknown_user' => 'Den valgte brukeren eksisterer ikke!',
	'comment_deleted' => 'Kommentar ble slettet',
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
	'confirm_del' => 'Er du sikker p� at du vil slette dette bildet? \\nKommentarer blir ogs� slettet.',
	'del_pic' => 'SLETT DETTE BILDET',
	'size' => '%s x %s piksler',
	'views' => '%s ganger',
	'slideshow' => 'Lysbildeshow',
	'stop_slideshow' => 'STOPP LYSBILDESHOW',
	'view_fs' => 'Klikk for � vise bildet i full st�rrelse',
);

$lang_picinfo = array(
	'title' =>'Bildeinfo',
	'Filename' => 'Filnavn',
	'Album name' => 'Album navn',
	'Rating' => 'Karakter (%s stemmer)',
	'Keywords' => 'N�kkelord',
	'File Size' => 'Filst�rrelse',
	'Dimensions' => 'Dimensjoner',
	'Displayed' => 'Visninger',
	'Camera' => 'Kamera',
	'Date taken' => 'Tatt dato',
	'Aperture' => 'Blender�pning',
	'Exposure time' => 'Eksponeringstid ',
	'Focal length' => 'Brennvidde',
    'Comment' => 'Kommentar', 
    'addFav'=>'Legg til i favoritter', 
    'addFavPhrase'=>'Favoritter', 
    'remFav'=>'Fjern fra favoritter', 
); 

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => 'Rediger denne kommentaren',
	'confirm_delete' => 'Er du sikker p� du vil slette denne kommentaren?',
	'add_your_comment' => 'Legg til din kommentar',
    'name'=>'Navn', 
    'comment'=>'Kommentar', 
    'your_name' => 'Anonym', 
);

$lang_fullsize_popup = array( 
        'click_to_close' => 'Klikk p� bildet for � lukke viduet', 
); 

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Send et e-postkort',
	'invalid_email' => '<b>Advarsel</b> : ugyldig e-post adresse!',
	'ecard_title' => 'Et E-postkort fra %s til deg!',
	'view_ecard' => 'Hvis kortet ikke vises riktig, klikk her',
	'view_more_pics' => 'Klikk p� denne linken for flere bilder!',
	'send_success' => 'Ditt e-postkort ble sendt',
	'send_failed' => 'Beklager, serveren kunne ikke sende E-postkortet',
	'from' => 'Fra',
	'your_name' => 'Ditt navn',
	'your_email' => 'Din e-post adresse',
	'to' => 'Til',
	'rcpt_name' => 'Navn p� mottaker',
	'rcpt_email' => 'E-post adresse til mottaker',
	'greetings' => 'Hilsen',
	'message' => 'Beskjed',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Bildeinfo',
	'album' => 'Album',
	'title' => 'Tittel',
	'desc' => 'Beskrivelse',
	'keywords' => 'N�kkelord',
	'pic_info_str' => '%sx%s - %skB - %s visninger - %s stemmer',
	'approve' => 'Godkjenn bilde',
	'postpone_app' => 'Utsett godkjennelse',
	'del_pic' => 'Slett billede',
	'reset_view_count' => 'Tilbakestill visningsteller',
	'reset_votes' => 'Tilbakestill avstemmning',
	'del_comm' => 'Slett kommentarer',
	'upl_approval' => 'Opplastingsgodkjennelse',
	'edit_pics' => 'Rediger bilder',
	'see_next' => 'Se neste bilde',
	'see_prev' => 'Se forrige bilde',
	'n_pic' => '%s bilder',
	'n_of_pic_to_disp' => 'Antall bilder til fremvisning',
	'apply' => 'Utf�r rettelser'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Gruppenavn',
	'disk_quota' => 'Disk kvote',
	'can_rate' => 'Kan gi karakterer',
	'can_send_ecards' => 'Kan sende e-postkort',
	'can_post_com' => 'Kan legge inn kommentar',
	'can_upload' => 'Kan laste opp bilder',
	'can_have_gallery' => 'Kan ha personlig galleri',
	'apply' => 'Utf�r rettelser',
	'create_new_group' => 'Opprett ny gruppe',
	'del_groups' => 'Slett valgt(e) gruppe(r)',
	'confirm_del' => 'Advarsel, n�r du sletter en gruppe vil medlemmene i denne bli flyttet til \'Registrert\' gruppen !\n\nVil du fortsette ?',
	'title' => 'Administrer brukergrupper',
	'approval_1' => 'OK for offentlige opplastinger(1)',
	'approval_2' => 'OK for private opplastinger(2)',
	'note1' => '<b>(1)</b> Nei=Opplastinger til offentlig album krever administrators godkjennelse',
	'note2' => '<b>(2)</b> Nei=Opplastinger til privat album som tilh�rer brukeren krever administrators godkjennelse',
	'notes' => 'Notater'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Velkommen!'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Er du sikker p� at du vil slette dette albumet? \\nAlle bilder og kommentarer vil ogs� bli slettet.',
	'delete' => 'SLETT',
	'modify' => 'REDIGER album',
	'edit_pics' => 'REDIGER BILDER',
);

$lang_list_categories = array(
	'home' => 'Hjem',
	'stat1' => '<b>[pictures]</b> bilde(r) i <b>[albums]</b> album og <b>[cat]</b> kategori(er) med <b>[comments]</b> kommentar(er) vist <b>[views]</b> gang(er)',
	'stat2' => '<b>[pictures]</b> bilde(r) i <b>[albums]</b> album vist <b>[views]</b> ganger',
	'xx_s_gallery' => '%s\'s Galleri',
	'stat3' => '<b>[pictures]</b> bilde(r) i <b>[albums]</b> album med <b>[comments]</b> kommentar(er) vist <b>[views]</b> gang(er)'
);

$lang_list_users = array(
	'user_list' => 'Brukerliste',
	'no_user_gal' => 'Ingen brukere kan ha album',
	'n_albums' => '%s album',
	'n_pics' => '%s bilde(r)'
);

$lang_list_albums = array(
	'n_pictures' => '%s bilde(r)',
	'last_added' => ', siste lagt inn %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Logg inn',
	'enter_login_pswd' => 'Skriv brukernavn og passord for � logge inn',
	'username' => 'Brukernavn',
	'password' => 'Passord',
	'remember_me' => 'Husk meg',
	'welcome' => 'Velkommen %s ...',
	'err_login' => '*** Kunne ikke logge deg inn. Pr�v igjen ***',
	'err_already_logged_in' => 'Du er allerede logget inn !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Logg ut',
	'bye' => 'P� gjensyn %s ...',
	'err_not_loged_in' => 'Du er ikke logget inn !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Oppdaterer album %s',
	'general_settings' => 'Generelle instillinger',
	'alb_title' => 'Albumtittel',
	'alb_cat' => 'Albumkategori',
	'alb_desc' => 'Albumbeskrivelse',
	'alb_thumb' => 'Album miniatyrbilder',
	'alb_perm' => 'Tillatelser for dette album',
	'can_view' => 'Album kan sees av',
	'can_upload' => 'Gjester kan laste opp bilder',
	'can_post_comments' => 'Gjester kan skrive kommentarer',
	'can_rate' => 'Gjester kan gi karakter til bilder',
	'user_gal' => 'Brukergalleri',
	'no_cat' => '* Ingen kategori *',
	'alb_empty' => 'Albumet er tomt',
	'last_uploaded' => 'Sist lastet opp',
	'public_alb' => 'Alle (offentlige album)',
	'me_only' => 'Kun meg',
	'owner_only' => 'Kun albumeier (%s)',
	'groupp_only' => 'Medlemmer av \'%s\' gruppen',
	'err_no_alb_to_modify' => 'Det er ingen album du kan redigere i basen.',
	'update' => 'Oppdater album'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Beklager, men du har allerede gitt karakter til dette bildet',
	'rate_ok' => 'Din stemme ble akseptert',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
// Lag egne vilk�r for bruk her hvis du ikke vil ha det som er standard

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Selv om administratoren (ene) av {SITE_NAME} vil pr�ve � fjerne eller 
redigere st�tende materiale umiddelbart kan det ofte v�re umulig � g� igjennom alt som legges inn. 
Derfor m� du godta at det som legges inn her bare reflekterer meninger og holdninger til brukerne selv og ikke 
til administratorene eller webmasteren. (Bortsett fra materiale de selv har lagt inn.)

Du lover � ikke legge inn noe materiale som kan virke st�tende p� noen m�te og som p� noen m�te
kan v�re lovstridig.
Du godtar at webmaster, administrator eller moderatorer av {SITE_NAME} har all rett til � fjerne
 eller redigere ethvert innhold n�r det m�tte passe. 
 
Dette fotogalleriet bruker cookies (informasjonskapsler) for � lagre informasjon p� 
din PC. Disse blir bare brukt for � forbedre bruken av galleriet. Epostadressen blir bare brukt for � bekrefte
brukerregistreringen og passord.

Ved � klikke 'Jeg aksepterer' under sier du deg enig i disse punktene.

EOT;

$lang_register_php = array(
	'page_title' => 'Registrering av ny bruker',
	'term_cond' => 'Regler og betingelser',
	'i_agree' => 'Jeg aksepterer',
	'submit' => 'Send registrering',
	'err_user_exists' => 'Brukernavnet finnes allerede. Velg et annet!',
	'err_password_mismatch' => 'Passordene var ikke like, skriv dem inn p� ny',
	'err_uname_short' => 'Brukernavnet var for kort',
	'err_password_short' => 'Passordet var for kort',
	'err_uname_pass_diff' => 'Brukernavn og passord m� v�re forskjellige',
	'err_invalid_email' => 'E-postadressen er ugyldig',
	'err_duplicate_email' => 'En annen bruker er allerede oppf�rt med din e-postadresse.',
	'enter_info' => 'Legg inn registreringsinfo',
	'required_info' => 'P�krevet info',
	'optional_info' => 'Valgfri info',
	'username' => 'Brukernavn',
	'password' => 'Passord',
	'password_again' => 'Gjennta passord',
	'email' => 'E-post',
	'location' => 'Sted',
	'interests' => 'Interesser',
	'website' => 'Hjemmeside',
	'occupation' => 'Stilling',
	'error' => 'FEIL',
	'confirm_email_subject' => '%s - Godkjennelse',
	'information' => 'Informasjon',
	'failed_sending_email' => 'Godkjennelsen kan ikke sendes!',
	'thank_you' => 'Takk for din registrering.<br /><br />en e-post er sendt til deg der du m� aktivere din konto.',
	'acct_created' => 'Din konto er n� opprettet og du kan logge inn med ditt brukernavn og passord',
	'acct_active' => 'Din konto er n� aktiv og du kan logge p� med ditt brukernavn og passord',
	'acct_already_act' => 'Din konto er allerede aktiv !',
	'acct_act_failed' => 'Denne kontoen kan ikke aktiveres !',
	'err_unk_user' => 'Den valgte brukeren eksisterer ikke !',
	'x_s_profile' => '%s\'s profil',
	'group' => 'Gruppe',
	'reg_date' => 'Tilsluttet',
	'disk_usage' => 'Disk bruk',
	'change_pass' => 'Bytt passord',
	'current_pass' => 'N�v�rende passord',
	'new_pass' => 'Nytt passord',
	'new_pass_again' => 'Nytt passord en gang til',
	'err_curr_pass' => 'N�v�rende passord er feil',
	'apply_modif' => 'Utf�r rettelser',
	'change_pass' => 'Bytt mitt passord',
	'update_success' => 'Din profil ble oppdatert',
	'pass_chg_success' => 'Ditt passord ble endret',
	'pass_chg_error' => 'Ditt passord ble ikke endret',
);

$lang_register_confirm_email = <<<EOT
Takk for din registrering hos {SITE_NAME}

Ditt brukernavn er : "{USER_NAME}"
Dit passord er : "{PASSWORD}"

For � aktivere din konto m� du klikke p� linken under eller lime den inn i din nettleser.

{ACT_LINK}

Vennlig hilsen,

Administrasjonen av - {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Se igjennom kommentarer',
	'no_comment' => 'Der er ingen kommentarer � se igjennom',
	'n_comm_del' => '%s kommentar(er) slettet',
	'n_comm_disp' => 'Antall kommentarer � vise',
	'see_prev' => 'Se forrige',
	'see_next' => 'Se neste',
	'del_comm' => 'Slett valgte kommentarer',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'S�k i bildesamlingen',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Legge inn nye bilder',
	'select_dir' => 'Velg mappe',
	'select_dir_msg' => 'Denne funksjonen tillater deg og legge inn bilder du har lastet opp via FTP.<br /><br />Velg mappen du har lastet opp bilder i',
	'no_pic_to_add' => 'Det finnes ingen bilder � legge til',
	'need_one_album' => 'Du m� ha minst ett album for � legge til bilder',
	'warning' => 'Advarsel',
	'change_perm' => 'Systemet kan ikke skrive til denne mappen, du m� endre rettigheter med CHMOD 755 eller 777 f�r du pr�ver igjen !',
	'target_album' => '<b>Flytt bilder av &quot;</b>%s<b>&quot; til </b>%s',
	'folder' => 'Mappe',
	'image' => 'Bilde',
	'album' => 'Album',
	'result' => 'Resultat',
	'dir_ro' => 'Ikke skrivbar. ',
	'dir_cant_read' => 'Ikke lesbar. ',
	'insert' => 'Legger inn nye bilder i galleriet',
	'list_new_pic' => 'Liste med nye bilder',
	'insert_selected' => 'Legg inn valgte bilder',
	'no_pic_found' => 'Ingen nye bilder ble funnet',
	'be_patient' => 'Ha litt t�lmodighet, systemet arbeider n� med � legge inn bildene',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : Betyr at bildet er lagt inn'.
				'<li><b>DP</b> : Betyr at bildet er en dublett og allerede ligger i databasen'.
				'<li><b>PB</b> : Betyr at bildet ikke kan legges inn, sjekk konfigurasjon og tillatelser til mappen bildene ligger i'.
				'<li>Hvis OK, DP, PB \'skiltene\' ikke kommer frem klikk da p� det manglende bildet for � se eventuelle feilmeldinger PHP lager'.
				'<li>Hvis din nettleser lager timeout s� klikk p� oppdater-knappen'.
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
                'title' => 'Utvis brukere', 
                'user_name' => 'Brukernavn', 
                'ip_address' => 'IP Adresse', 
                'expiry' => 'Utg�r (blankt felt er permanent)', 
                'edit_ban' => 'Lagre endringer', 
                'delete_ban' => 'Slett', 
                'add_new' => 'Utvis ny bruker', 
                'add_ban' => 'Legg til ny bruker', 
); 

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'Last opp bilde',
	'max_fsize' => 'Maks tillatt filst�rrelse er satt til %s kB',
	'album' => 'Album',
	'picture' => 'Bilde',
	'pic_title' => 'Bildetittel',
	'description' => 'Bildebeskrivelse',
	'keywords' => 'N�kkelord (separer med mellomrom)',
	'err_no_alb_uploadables' => 'Beklager, det finnes ingen album der du har tillatelse til � laste opp bilder',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Administrer bruker',
	'name_a' => 'Navn stigende',
	'name_d' => 'Navn synkende',
	'group_a' => 'Gruppe stigende',
	'group_d' => 'Gruppe synkende',
	'reg_a' => 'Reg dato stigende',
	'reg_d' => 'Reg dato synkende',
	'pic_a' => 'Antall bilder  stigende',
	'pic_d' => 'Antall bilder  synkende',
	'disku_a' => 'Disk bruk stigende',
	'disku_d' => 'Disk bruk synkene',
	'sort_by' => 'Sorter brukere etter',
	'err_no_users' => 'Brukertabellen er tom!',
	'err_edit_self' => 'Du kan ikke redigere din profil her, bruk \'Min profil\' link til dette form�let',
	'edit' => 'REDIGER',
	'delete' => 'SLETT',
	'name' => 'Brukernavn',
	'group' => 'Gruppe',
	'inactive' => 'Ikke aktiv',
	'operations' => 'Handlinger',
	'pictures' => 'Bilder',
	'disk_space' => 'Plass brukt / Kvote',
	'registered_on' => 'Registrert den',
	'u_user_on_p_pages' => '%d bruker(e) p� %d side(r)',
	'confirm_del' => 'Er du sikker p� du vil SLETTE denne brukeren ? \\nAlle billeder og album vil ogs� bli slettet.',
	'mail' => 'POST',
	'err_unknown_user' => 'Den valgte brukeren eksisterer ikke!',
	'modify_user' => 'Rediger bruker',
	'notes' => 'Notater',
	'note_list' => '<li>Hvis du ikke vil endre det gjeldende passordet, la feltet "passord" st� tomt',
	'password' => 'Passord',
	'user_active' => 'Brukeren er aktiv',
	'user_group' => 'Brukergruppe',
	'user_email' => 'Bruker e-post',
	'user_web_site' => 'Brukerens hjemmeside',
	'create_new_user' => 'Opprett ny bruker',
	'user_location' => 'Brukerens plassering',
	'user_interests' => 'Brukerens interesser',
	'user_occupation' => 'Brukerens yrke',
);

// ------------------------------------------------------------------------- // 
// File util.php 
// ------------------------------------------------------------------------- // 

if (defined('UTIL_PHP')) $lang_util_php = array( 
        'title' => 'Endre bilder/titler', 
        'what_it_does' => 'Hva det gj�r', 
        'what_update_titles' => 'Oppdater titler fra bildenavn', 
        'what_delete_title' => 'Slett titler', 
        'what_rebuild' => 'Gjennoppbygger miniatyrbilder og endrede bilder', 
        'what_delete_originals' => 'Sletter originalbilder og bytter disse med den versjonen du har endret st�rrelsen p�', 
        'file' => 'Fil', 
        'title_set_to' => 'tittel settes til', 
        'submit_form' => 'Send', 
        'updated_succesfully' => 'oppdateringen var vellykket', 
        'error_create' => 'FEIL under opprettelse av', 
        'continue' => 'Fortsett � behandle bilder', 
        'main_success' => 'Filen %s ble brukt som hovedbilde', 
        'error_rename' => 'Feil ved navnebytte av %s til %s', 
        'error_not_found' => 'Tittelen %s ble ikke funnet', 
        'back' => 'tilbake til hovedsiden', 
        'thumbs_wait' => 'Oppdaterer bilder... vennligst vent...', 
        'thumbs_continue_wait' => 'Fortsetter oppdateringen av bilder...', 
        'titles_wait' => 'Oppdaterer titler, vennligst vent...', 
        'delete_wait' => 'Sletter titler, vennligst vent..', 
        'replace_wait' => 'Sletter originalbilder og erstatter dem med endrede bilder..', 
        'instruction' => 'Hurtiginstruksjoner', 
        'instruction_action' => 'Velg handling', 
        'instruction_parameter' => 'Sett paramentere', 
        'instruction_album' => 'Velg album', 
        'instruction_press' => 'Trykk %s', 
        'update' => 'Oppdater miniatyrbilder og/eller endrede bilder', 
        'update_what' => 'Hva skal oppdateres', 
        'update_thumb' => 'Kun miniatyrbilder', 
        'update_pic' => 'Kun endrede bilder', 
        'update_both' => 'B�de sm�bilder og endrede bilder', 
        'update_number' => 'Antall bilder � behandle pr klikk', 
        'update_option' => '(Pr�v � sette denne instillingen lavere om du f�r time-out i nettlesren)', 
        'filename_title' => 'Filnavn &rArr; Tittel p� bilde', 
        'filename_how' => 'Hvordan skal filnavnet modifiseres', 
        'filename_remove' => 'Fjern .jpg endelsen og bytt ut _(understrek) med mellomrom', 
        'filename_euro' => 'Endre 2003_11_23_13_20_20.jpg til 23/11/2003 13:20', 
        'filename_us' => 'Endre 2003_11_23_13_20_20.jpg til 11/23/2003 13:20', 
        'filename_time' => 'Endre 2003_11_23_13_20_20.jpg til 13:20', 
        'delete' => 'Slett bildetitler eller bilder i originalst�rrelse', 
        'delete_title' => 'Slett bildetitler', 
        'delete_original' => 'Slett bilder i originalst�rrelse', 
        'delete_replace' => 'Sletter de originale bildene og bytter dem ut med de endrede utgavene', 
        'select_album' => 'Velg album', 
); 

?>