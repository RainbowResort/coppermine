<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.0                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR <gdemar@wanadoo.fr>                 //
// http://www.chezgreg.net/coppermine/                                       //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify      //
// it under the terms of the GNU General Public License as published by      //
// the Free Software Foundation; either version 2 of the License, or         //
// (at your option) any later version.                                       //
// ------------------------------------------------------------------------- // 


// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'Slovak',  //the name of your language in English, e.g. 'Greek' or 'Spanish'
'lang_name_native' => 'Slovensky', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espan~ol'
'lang_country_code' => 'sk', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
'trans_name'=> 'Rado Kertes', //the name of the translator - can be a nickname
'trans_email' => 'radovan@kertes.net', //translator's email address (optional)
'trans_website' => 'http://www.kertes.net/', //translator's website (optional)
'trans_date' => '2003-11-25', //the date the translation was created / last modified
);


$lang_charset = 'windows-1250';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytov', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Ne', 'Po', 'Ut', 'St', '�t', 'Pi', 'So');
$lang_month = array('Janu�r', 'Febru�r', 'Marec', 'Apr�l', 'M�j', 'J�n', 'J�l', 'August', 'September', 'Okt�ber', 'November', 'December');

// Some common strings
$lang_yes = 'Ano';
$lang_no  = 'Nie';
$lang_back = 'SPA�';
$lang_continue = 'POKRA�OVA�';
$lang_info = 'Inform�cie';
$lang_error = 'Chyba';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%m/%d/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt =  '%B %d, %Y at %I:%M %p';

// For the word censor
$lang_bad_words = array('pi�a', 'hovno', '*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
        'random' => 'N�hodn� obr�zky',
        'lastup' => 'Najnov�ie',
        'lastalb'=> 'Naposledy aktualizovan� albumy',
        'lastcom' => 'Najnovj�ie koment�re',
        'topn' => 'Nejprezeranej�ie',
        'toprated' => 'Nejlep�ie hodnoten�',
        'lasthits' => 'Naposledy zobrazen�',
        'search' => 'V�sledky h�adania',
        'favpics'=> 'Ob��ben� obr�zky',
);

$lang_errors = array(
    'access_denied' => 'Nem�te opr�vnenie na t�to str�nku',
    'perm_denied' => 'Nem�te dostato�n� pr�va pre potvrdenie tejto oper�cie.',
    'param_missing' => 'Skriptu neboli predan� potrebn� parametre',
    'non_exist_ap' => 'Vybran� album/obr�zok neexistuje',
    'quota_exceeded' => 'Vy�erpal(a) ste miesto na disku.<br /><br />Va�a kv�ta je[quota]K, Va�e obr�zky zaberaj� [space]K, pridan�m tohto obr�zku by jste svoju kv�tu prekro�ili',
    'gd_file_type_err' => 'Pokia� pou��vate GD kni�nicu, s� podporovan� len obr�zky JPG a PNG',
    'invalid_image' => 'Tento obr�zok je po�koden�/poru�en�, GD kni�nica s n�m nem��e pracova�.',
    'resize_failed' => 'Nemo�no vytvori� n�h�ad �i zmen�en� obr�zok',
    'no_img_to_display' => 'Tu nie je obr�zok ktor� by ste si mohli(a) prezrie�',
    'non_exist_cat' => 'Vybran� kateg�ria neexistuje',
    'orphan_cat' => 'Podkateg�ria nem� nadraden� kateg�riu. Probl�m opravte cez nastavenie kateg�ri�.',
    'directory_ro' => 'Do adres�ra \'%s\' nemo�no zapisova� (nedostato�n� pr�va), obr�zky nemohli by� zmazan�.',
    'non_exist_comment' => 'Vybran� koment�r neexistuje',
    'pic_in_invalid_album' => 'Obr�zok(y) je/s� v neexistuj�com albume (%s)!?',
    'banned' => 'Boli ste vykopnut� z t�chto str�nok, nie je V�m umo�nen� ich pou��va�.',
    'not_with_udb' => 'T�to funkcia je vypnut� preto�e je integrovan� vo f�re. Bu� nie je po�adovan� funkcia dostupn� v tomto syst�me, alebo t�to/tieto funkciu/e pln� f�rum.',
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
    'alb_list_title' => 'Prejs� na zoznam gal�ri�',
    'alb_list_lnk' => 'Zoznam gal�ri�',
    'my_gal_title' => 'Prejs� do mojej osobnej gal�rie',
    'my_gal_lnk' => 'Moja gal�ria',
    'my_prof_lnk' => 'M�j Profil',
    'adm_mode_title' => 'Do Admin m�du',
    'adm_mode_lnk' => 'Admin m�d',
    'usr_mode_title' => 'Do U��vate�sk�ho m�du',
    'usr_mode_lnk' => 'U�ivate�sk� m�d',
    'upload_pic_title' => 'Nahra� obr�zok do gal�rie',
    'upload_pic_lnk' => 'Upload obr�zku',
    'register_title' => 'Vytvori� ��et',
    'register_lnk' => 'Registrova� sa',
    'login_lnk' => 'Prihl�si�',
    'logout_lnk' => 'Odhl�si�',
    'lastup_lnk' => 'Najnovj�ie obr�zky',
    'lastcom_lnk' => 'Posledn� koment�re',
    'topn_lnk' => 'Najprezeranej�ie',
    'toprated_lnk' => 'Nejlep�ie hodnoten�',
    'search_lnk' => 'Vyh�ad�vanie',
    'fav_lnk' => 'Ob��ben�',
);

$lang_gallery_admin_menu = array(
    'upl_app_lnk' => 'Potvrdenie uploadu',
    'config_lnk' => 'Nastavenie',
    'albums_lnk' => 'Gal�rie',
    'categories_lnk' => 'Kateg�rie',
    'users_lnk' => 'U�ivatelia',
    'groups_lnk' => 'U�. skupiny',
    'comments_lnk' => 'Koment�re',
    'searchnew_lnk' => 'D�vkov� pridanie obr�zkov',
    'util_lnk' => 'Zmeni� ve�kos� obr�zkov',
    'ban_lnk' => 'Vykopn�� u�ivate�a',
);

$lang_user_admin_menu = array(
    'albmgr_lnk' => 'Vytvori� / organizova� moje gal�rie',
    'modifyalb_lnk' => 'Zmeni� moje gal�rie',
    'my_prof_lnk' => 'M�j profil',
);

$lang_cat_list = array(
    'category' => 'Kateg�rie',
    'albums' => 'Gal�rie',
    'pictures' => 'Obr�zky',
);

$lang_album_list = array(
    'album_on_page' => '%d Gal�ri� na %d str�nkach'
);
           //ascending VZESTUPNE
$lang_thumb_view = array(
    'date' => 'D�TUM',
    //Sort by filename and title
    'name' => 'M�NO S�BORU',
    'title' => 'NADPIS',
    'sort_da' => 'Radi� vzostupne pod�a d�tumu',
    'sort_dd' => 'Radi� zostupne pod�a d�tumu',
    'sort_na' => 'Radi� vzostupne pod�a mena',
    'sort_nd' => 'Radi� zostupne pod�a mena',
    'sort_ta' => 'Radi� pod�a nadpisu vzostupne',
    'sort_td' => 'Radi� pod�a nadpisu zostupne',
    'pic_on_page' => '%d obr�zkov na %d str�nkach',
    'user_on_page' => '%d u��vate�ov na %d str�nkach'
);

$lang_img_nav_bar = array(
    'thumb_title' => 'Sp� na str�nku s n�h�admi',
    'pic_info_title' => 'Zobraz/skryj inform�cie o obr�zku',
    'slideshow_title' => 'Slideshow',
    'ecard_title' => 'Posla� tento obr�zok ako poh�adnicu',
    'ecard_disabled' => 'Poh�adnice s� vypnut�',
    'ecard_disabled_msg' => 'Nem�te dostato�n� pr�va pre zaslanie poh�adnice',
    'prev_title' => 'Predch�dzaj�ci obr�zok',
    'next_title' => '�al�� obr�zok',
    'pic_pos' => 'OBR�ZOK %s/%s',
);

$lang_rate_pic = array(
    'rate_this_pic' => 'Hodnoti� tento obr�zok ',
    'no_votes' => '(�iadne hodnotenie)',
    'rating' => '(Aktu�lne hodnotenie : %s / z 5, hlasovan� %s kr�t)',
    'rubbish' => 'Hnusn�',
    'poor' => 'Mizern�',
    'fair' => 'Ujde to',
    'good' => 'Dobr�',
    'excellent' => 'V�born�',
    'great' => 'Dokonal�',
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
    CRITICAL_ERROR => 'Kritick� chyba',
    'file' => 'S�bor: ',
    'line' => 'Riadok: ',
);

$lang_display_thumbnails = array(
    'filename' => 'Meno s�boru : ',
    'filesize' => 'Ve�kos� s�boru : ',
    'dimensions' => 'Rozmery : ',
    'date_added' => 'D�tum pridania : '
);

$lang_get_pic_data = array(
    'n_comments' => '%s Koment�r(ov)',
    'n_views' => '%s zobrazen�',
    'n_votes' => '(%s hlas(ov))'
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
    0 => 'Op���am Admin M�d....:-(',
    1 => 'Vstupujem do Admin M�du....:-)',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
    'alb_need_name' => 'Gal�ria mus� ma� meno',
    'confirm_modifs' => 'Ste si ist�(�) t�mito zmenami ?',
    'no_change' => 'Neurobil(a) ste �iadne zmeny !',
    'new_album' => 'Nov� gal�ria',
    'confirm_delete1' => 'Ste si ist�(�), �e chcete zmaza� t�to gal�riu ?',
    'confirm_delete2' => '\nV�etky obr�zky a koment�re bud� zmazan� !',
    'select_first' => 'Najprv vyberte gal�riu',
    'alb_mrg' => 'Spr�vca gal�ri�',
    'my_gallery' => '* Moje gal�rie *',
    'no_category' => '* Nie je kateg�ria *',
    'delete' => 'Zmaza�',
    'new' => 'Nov�/�',
    'apply_modifs' => 'Potvrdi� zmeny',
    'select_category' => 'Vybra� kateg�riu',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
    'miss_param' => 'Parametre potrebn� pre \'%s\'oper�ciu not supplied !',
    'unknown_cat' => 'Vybran� kateg�ria v datab�zi neexistuje',
    'usergal_cat_ro' => 'Nemo�no zmaza� u��vate�sk� gal�rie !',
    'manage_cat' => 'Spravova� kateg�rie',
    'confirm_delete' => 'Naozaj chcete ZMAZA� t�to kateg�riu',
    'category' => 'Kateg�rie',
    'operations' => 'Oper�cie',
    'move_into' => 'Presun�� do',
    'update_create' => 'Aktualizova�/Vytvori� kateg�riu',
    'parent_cat' => 'Nadraden� kateg�ria',
    'cat_title' => 'Nadpis kateg�rie',
    'cat_desc' => 'Popis kateg�rie'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
    'title' => 'Nastavenie',
    'restore_cfg' => 'Nastavi� v�chodzie',
    'save_cfg' => 'Ulo�i� konfigur�ciu',
    'notes' => 'Pozn�mky',
    'info' => 'Inform�cie',
    'upd_success' => 'Konfigur�cia bola zmenen�',
    'restore_success' => 'Konfigur�cia bola nastaven� na v�chodzie nastavenie',
    'name_a' => 'Meno vzostupne',
    'name_d' => 'Meno zostupne',
    'date_a' => 'D�tum vzostupne',
    'date_d' => 'D�tum zostupne',
    'title_a' => 'Nadpis vzostupne',
    'title_d' => 'Nadpis zostupne',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
    'Z�kladn� nastavenie',
    array('Meno gall�rie', 'gallery_name', 0),
    array('Popis gal�rie', 'gallery_description', 0),
    array('Email administr�tora gal�rie', 'gallery_admin_email', 0),
    array('Cie�ov� adresa pre odkaz \'Zobrazi� �al�ie obr�zky\' v odkaze poh�adnice', 'ecards_more_pic_target', 0),
    array('Jazyk', 'lang', 5),
    array('T�ma', 'theme', 6),

    'Nastaven� zobrazen�',
    array('��rka hlavnej tabu�ky v (pixeloch alebo %)', 'main_table_width', 0),
    array('Po�et �rovn� subkateg�rii', 'subcat_level', 0),
    array('Po�et gal�ri na str�nku', 'albums_per_page', 0),
    array('Po�et stlpcov v preh�ade gal�rii', 'album_list_cols', 0),
    array('Ve�kos� n�h�adov v pixeloch', 'alb_list_thumb_size', 0),
    array('Obsah hlavnej str�nky', 'main_page_layout', 0),
    array('Ukazova� v kateg�riach n�h�ady gal�rii prvej �rovne','first_level',1),

    'Zobrazen� n�hled�',
    array('Po�et stlpcov na str�nku', 'thumbcols', 0),
    array('Po�et riadkov na str�nku', 'thumbrows', 0),
    array('Maxim�lne mno�stv� z�lo�iek', 'max_tabs', 0),
    array('Zobrazi� legendu obr�zku pod n�h�adom', 'caption_in_thumbview', 1),
    array('Zobrazi� po�et koment�rov pod n�h�adom', 'display_comment_count', 1),
    array('Z�kladn� radenie n�h�adov', 'default_sort_order', 3),
    array('Min. po�et hlasov potrebn� k zaradeniu do zoznamu \'Nejlep�ie hodnoten�\'', 'min_votes_for_rating', 0),

    'Zobrazenie obr�zkov &amp; Nastavenie koment�rov',
    array('��rka tabu�ky pre zobrazenie obr�zku (v pixeloch alebo %)', 'picture_table_width', 0),
    array('V�dy zobrazi� podrobn� info', 'display_pic_info', 1),
    array('CENZUROVA� slov� v koment�roch', 'filter_bad_words', 1),
    array('Povoli� smajl�ky v koment�roch', 'enable_smilies', 1),
    array('Maxim�lna d�ka popisu obr�zku', 'max_img_desc_length', 0),
    array('Maxim�lna d�ka slova v koment�re', 'max_com_wlength', 0),
    array('Maxim�lne mno�stvo riadkov v koment�re', 'max_com_lines', 0),
    array('Maxim�lna d�ka koment�ra', 'max_com_size', 0),
    array('Uk�za� filmov� pr��ok', 'display_film_strip', 1),
    array('Po�et polo�iek vo filmovom pr��ku', 'max_film_strip_items', 0),

    'Obr�zky a nastaven� n�hled�',
    array('Kvalita s�borov JPEG', 'jpeg_qual', 0),
    array('Maxim�lne rozmery n�h�adu <b>*</b>', 'thumb_width', 0),
    array('Pou�i� rozmer ( ��rka alebo v��ka alebo maxim�lny rozmer n�h�adu )<b>*</b>', 'thumb_use', 7),
    array('Vytvori� stredn� obr�zok','make_intermediate',1),
    array('Maxim�lna ��rka alebo v��ka stredn�ho obr�zku <b>*</b>', 'picture_width', 0),
    array('Maxim�lna ve�kos� uploadovan�ch obr�zkov (KB)', 'max_upl_size', 0),
    array('Maxim�lne rozmery uploadovan�ch obr�zkov (v pixeloch)', 'max_upl_width_height', 0),

    'Nastavenie u�ivate�ov',
    array('Povoli� registr�ciu nov�ch u��vate�ov', 'allow_user_registration', 1),
    array('Pre registr�ciu vy�adova� potvrdenie admina', 'reg_requires_valid_email', 1),
    array('Povoli� pre dvoch u��vate�ov rovnak� email', 'allow_duplicate_emails_addr', 1),
    array('Maj� ma� u��vatelia vlastn� gal�riu?', 'allow_private_albums', 1),

    'Volite�n� polia pre popis obr�zkov (Nechajte pr�zdne a nezobraz� sa)',
    array('Meno polo�ky 1', 'user_field1_name', 0),
    array('Meno polo�ky 2', 'user_field2_name', 0),
    array('Meno polo�ky 3', 'user_field3_name', 0),
    array('Meno polo�ky 4', 'user_field4_name', 0),

    'Obr�zky a n�h�ady roz��rene nastavenie',
    array('Zobrazi� ikonu zamknut� gal�rie neprihl�sen�mu u��vate�ovi.','show_private',1),
    array('Znaky zak�zan� v n�zvoch s�borov', 'forbiden_fname_char',0),
    array('Povolen� koncovky uploadovan�ch s�borov', 'allowed_file_extensions',0),
    array('Met�da zmeny ve�kosti obr�zkov','thumb_method',2),
    array('Cesta k ImageMagicu (pr�klad /usr/bin/X11/)', 'impath', 0),
    array('Povolen� typy obr�zkov (iba pre ImageMagic)', 'allowed_img_types',0),
    array('Parametre pre ImageMagic', 'im_options', 0),
    array('��ta� EXIF data zo s�borov JPEG', 'read_exif_data', 1),
    array('Adres�r pre gal�rie <b>*</b>', 'fullpath', 0),
    array('Adres�r pre gal�rie u��vate�ov <b>*</b>', 'userpics', 0),
    array('Prefix pre stredne ve�k� obr�zky <b>*</b>', 'normal_pfx', 0),
    array('Prefix pre n�h�ady <b>*</b>', 'thumb_pfx', 0),
    array('Z�kladn� m�d pre adres�re', 'default_dir_mode', 0),
    array('Z�kladn� m�d pre obr�zky', 'default_file_mode', 0),
    array('Zak�za� kliknutia prav�m tla��tkom pri plnom zobrazen� ( JavaScript metoda - NIE nepriestreln� odrad� amat�rov :-D )', 'disable_popup_rightclick', 1),
    array('Zak�za� kliknutia prav�m tla��tkom na norm�lnych str�nkach ( JavaScript metoda - NE nepriestreln� odrad� amat�rov :-D )', 'disable_gallery_rightclick', 1),

    'Cookies &amp; K�dov� str�nka',
    array('Meno cookies u��van� programom (expertn� vo�ba)', 'cookie_name', 0),
    array('Cesta pre cookies u��van� programom (expertn� vo�ba)', 'cookie_path', 0),
    array('K�dov� str�nka', 'charset', 4),

    '�al�ie nastavenia',
    array('Zapn�� debug m�d (len pre testovanie)', 'debug_mode', 1),

    '<br /><div align="center">(*) Polo�ky ozna�en� * se NESM� meni� pokia� u� m�te ve va�ej Gal�rii nahran� obr�zky</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
    'empty_name_or_com' => 'Vlo�te meno a V� koment�r',
    'com_added' => 'V� koment�r bol pridan�',
    'alb_need_title' => 'Pros�m, dajte gal�rii nadpis !',
    'no_udp_needed' => 'Aktualiz�cia nie je potrebn�.',
    'alb_updated' => 'Gal�ria bola pridan�',
    'unknown_album' => 'Vybran� album neexistuje alebo nem�te pr�vo na upload do tohto albumu',
    'no_pic_uploaded' => 'Obr�zok nebol uploadovan�!<br /><br />skontrolujte �i server podporuje upload s�borov a �i ste naozaj zadal(a) obr�zok na uploadu...',
    'err_mkdir' => '  ERROR: Chyba pri vytv�ran� adres�ra (nebol vytvoren�) %s !',
    'dest_dir_ro' => 'Do cie�ov�ho adres�ra %s nem��e skript zapisova� (skontrolujte opr�vnenia) !',
    'err_move' => 'Nemo�no presun�� %s do %s !',
    'err_fsize_too_large' => 'Rozmery obr�zka, ktor� se sna��te uploadova�, s� pr�li� ve�k� (max. ve�kos� je %s x %s) !',
    'err_imgsize_too_large' => 'Ve�kos� s�boru, ktor� se sna��te uploadova�, je pr�li� ve�k� (max. ve�kos� je %s KB) !',
    'err_invalid_img' => 's�bor ktor� ste nahral(a) na server nie je korektn�m obr�zkom !',
    'allowed_img_types' => 'M��ete uploadova� iba obr�zky %s .',
    'err_insert_pic' => 'Obr�zok \'%s\' nemo�no vlo�i� do gal�rie ',
    'upload_success' => 'V� obr�zok bol nahran� na server bez probl�mov<br /><br />Bude vidite�n� po schv�len� adminom.',
    'info' => 'Inform�cie',
    'com_added' => 'Koment�rov pridan�ch',
    'alb_updated' => 'Gal�ria aktualizovan�',
    'err_comment_empty' => 'V� koment�r je pr�zdny !',
    'err_invalid_fext' => 'Iba s�bory s n�sleduj�cimi koncovkami s� podporovan� : <br /><br />%s.',
    'no_flood' => 'Ste autorom posledn�ho koment�ra k tomuto obr�zku<br /><br />Pokia� ho chcete zmeni� pou�ijte vo�bu upravi� ',
    'redirect_msg' => 'Pr�ve ste presmerov�van�(a).<br /><br /><br />Kliknite na \'POKRA�OVA�\' pokia� sa str�nka nepresmeruje sama',
    'upl_success' => 'V� obr�zok bol pridan� v poriadku',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
    'caption' => 'Legenda(popis)',
    'fs_pic' => 'p�vodn� ve�kos� obr�zku',
    'del_success' => 'bezchybne zmazan�',
    'ns_pic' => 'norm�lna ve�kos� obr�zku',
    'err_del' => 'nemo�no zmaza�',
    'thumb_pic' => 'n�h�ad',
    'comment' => 'koment�r',
    'im_in_alb' => 'patr� do gal�rie',
    'alb_del_success' => 'Gal�ria \'%s\' zmazan�',
    'alb_mgr' => 'Spr�vca gal�ri�',
    'err_invalid_data' => 'Obdr�an� chybn� data \'%s\'',
    'create_alb' => 'Vytv�ram gal�riu \'%s\'',
    'update_alb' => 'Aktualizujem gal�riu \'%s\' s nadpisom \'%s\' a zoznamom \'%s\'',
    'del_pic' => 'Zmaza� obr�zok',
    'del_alb' => 'Zmaza� gal�riu',
    'del_user' => 'Zmaza� u��vate�a',
    'err_unknown_user' => 'Vybran� u��vate� neexistuje !',
    'comment_deleted' => 'Koment�r bezchybne zmazan� ! ',
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
    'confirm_del' => 'Ste si ist�, �e chcete zmaza� tento obr�zok ? \\nPrilo�en� koment�re bud� straten�.',
      'del_pic' => 'ZMAZA� TENTO OBR�ZOK',
    'size' => '%s x %s pixelov',
    'views' => '%s kr�t',
    'slideshow' => 'Slideshow',
    'stop_slideshow' => 'ZASTAV� SLIDESHOW',
        'view_fs' => 'kliknite pre zobrazenie p�vodn�ho obr�zku',
);

$lang_picinfo = array(
    'title' =>'Inform�cie o obr�zku',
    'Filename' => 'Meno s�boru',
    'Album name' => 'Meno gal�rie',
    'Rating' => 'Hodnotenie (%s hlas(ov))',
    'Keywords' => 'K���ov� slov�',
    'File Size' => 'Ve�kos� s�boru',
    'Dimensions' => 'Rozmery',
    'Displayed' => 'Zobrazen�',
    'Camera' => 'Fotoapar�t',
    'Date taken' => 'D�tum vytvorenia sn�mky',
    'Aperture' => 'Clona',
    'Exposure time' => 'Expozi�n� �as',
    'Focal length' => 'Ohniskov� vzdialenos�',
    'Comment' => 'Koment�re',
    'addFav' => 'Prida� k ob��ben�m',
    'addFavPhrase' => 'Ob��ben�',
    'remFav' => 'Odstrani� z ob��ben�ch',
);

$lang_display_comments = array(
    'OK' => 'OK',
    'edit_title' => 'Upravi� tento koment�r',
    'confirm_delete' => 'Ste si ist�(�), �e chcete zmaza� tento koment�r ?',
    'add_your_comment' => 'Prida� koment�r',
    'name'=>'Meno',
    'comment'=>'Koment�r',
    'your_name' => 'Anonym',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Kliknut�m na obr�zok zavriete okno',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
    'title' => 'Posla� poh�adnicu',
    'invalid_email' => '<b>Varovanie</b> : neplatn� emailov� adresa !',
    'ecard_title' => 'Poh�ednica zo servra %s pro v�s/teba',
    'view_ecard' => 'Pokia� se poh�ednica nezobrazila klikni na link',
    'view_more_pics' => 'Klikni pre �al�ie obr�zky !',
    'send_success' => 'Va�a poh�adnica bola odoslan�',
    'send_failed' => 'Prep��te, ale server nebol schopn� odosla� Va�u poh�adnicu sk�ste
     to znova za chv�u...',
    'from' => 'Od',
    'your_name' => 'Va�e meno',
    'your_email' => 'V� email',
    'to' => 'Komu',
    'rcpt_name' => 'Meno pr�jemcu',
    'rcpt_email' => 'Doru�i� na email',
    'greetings' => 'Pozdrav/oslovenie',
    'message' => 'Spr�va',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
    'pic_info' => 'Info o obr�zku',
    'album' => 'Gal�ria',
    'title' => 'Nadpis',
    'desc' => 'Popis',
    'keywords' => 'K���ov� slov�',
    'pic_info_str' => '%sx%s - %sKB - %s zobrazen� - %s hlas(ov)',
    'approve' => 'Schv�li� obr�zok',
    'postpone_app' => 'Odlo�i� schv�lenie',
    'del_pic' => 'Zmaza� obr�zok',
    'reset_view_count' => 'Vynulova� po��tadlo zobrazen�',
    'reset_votes' => 'Vynulova� hlasy',
    'del_comm' => 'Zmaza� koment�re',
    'upl_approval' => 'Potvrdenie uploadu',
    'edit_pics' => 'Upravi� obr�zky',
    'see_next' => 'Zobrazi� dal�ie obr�zky',
    'see_prev' => 'Zobrazi� predch�dzaj�ce obr�zky',
    'n_pic' => '%s obr�zkov',
    'n_of_pic_to_disp' => 'Po�et obr�zkov na zobrazenie',
    'apply' => 'Ulo�i� zmeny'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
    'group_name' => 'Meno skupiny',
    'disk_quota' => 'Diskov� kv�ta',
    'can_rate' => 'M��u hodnoti� obr�zky',
    'can_send_ecards' => 'M��u posiela� poh�adnice',
    'can_post_com' => 'M��u posiela� koment�re',
    'can_upload' => 'M��u nahr�va� obr�zky',
    'can_have_gallery' => 'M��u ma� osobn� gal�riu',
    'apply' => 'Ulo�i� zmeny',
    'create_new_group' => 'Vytvori� nov� skupinu',
    'del_groups' => 'Zmaza� vybran� skupiny',
    'confirm_del' => 'Pokia� zma�ete t�to skupinu v�etci u��vatelia, patriaci do tejto skupiny bud� presunut� do skupiny \'Registered\' !\n\nPrajete si pokra�ova� ?',
    'title' => 'Spravova� u��vate�sk� skupiny',
    'approval_1' => 'Potvrdenie verejn�ho. Upl. (1)',
    'approval_2' => 'Potvrdenie s�kromn�ho. Upl. (2)',
    'note1' => '<b>(1)</b> Upload do verejn�ch gal�ri� vy�aduje potvrdenie adminom',
    'note2' => '<b>(2)</b> Upload do gal�rie patriacej u��vate�ovi vy�aduje potvrdenie adminom',
    'notes' => 'Pozn�mky'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
    'welcome' => 'V�tajte !'
);

$lang_album_admin_menu = array(
    'confirm_delete' => 'Ste si jist�(�), �e chcete zmaza� t�to gal�riu? \\nV�etky obr�zky a koment�re p�jdu do pekla tie�. Prajete si pokra�ova�?',
    'delete' => 'ZMAZA�',
    'modify' => 'VLASTNOSTI',
    'edit_pics' => 'UPRAVI� OBR.',
);

$lang_list_categories = array(
    'home' => 'Domov',
    'stat1' => '<b>[pictures]</b> obr�zky v <b>[albums]</b> gal�rii <b>[cat]</b>v kateg�rii s <b>[comments]</b> koment�rami zobrazen� <b>[views]</b> kr�t',
    'stat2' => '<b>[pictures]</b> obr�zky v <b>[albums]</b> gal�rii zobrazen� <b>[views]</b> kr�t',
    'xx_s_gallery' => '%s\' Gal�ria',
    'stat3' => '<b>[pictures]</b> obr�zkov v <b>[albums]</b> gal�rii s <b>[comments]</b> koment�rami zobrazen� <b>[views]</b> kr�t'
);

$lang_list_users = array(
    'user_list' => 'Zoznam u��vate�ov',
    'no_user_gal' => 'Nie s� �iadne u��vate�sk� gal�rie',
    'n_albums' => '%s gal�ri�',
    'n_pics' => '%s obr�zkov'
);

$lang_list_albums = array(
    'n_pictures' => '%s obr�zkov',
    'last_added' => ', posledn� pridanie %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
    'login' => 'Prihl�senie',
    'enter_login_pswd' => 'Zadajte Va�e meno a heslo pre prihl�senie',
    'username' => 'Meno',
    'password' => 'Heslo',
    'remember_me' => 'Pam�taj si ma',
    'welcome' => 'V�taj u n�s %s ...',
    'err_login' => '*** Chyba pri prihl�sen� sk�ste to znova ***',
    'err_already_logged_in' => 'U� ste prihl�sen� !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
    'logout' => 'Odhl�si�',
    'bye' => 'Tak si to u�ij zase inde %s ...',
    'err_not_loged_in' => 'Nie ste prihl�sen� !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
    'upd_alb_n' => 'Aktualizova� album %s',
    'general_settings' => 'Z�kladn� nastavenie',
    'alb_title' => 'Nadpis gal�rie',
    'alb_cat' => 'Kateg�rie gal�rie',
    'alb_desc' => 'Popis gal�rie',
    'alb_thumb' => 'N�h�ad reprezentuj�ci album',
    'alb_perm' => 'Pr�stupov� pr�va pre t�to gal�riu',
    'can_view' => 'Album m��u prezera�',
    'can_upload' => 'N�v�tevn�ci sm� prid�va� obr�zky',
    'can_post_comments' => 'Povoli� koment�re',
    'can_rate' => 'N�v�tevn�ci m��u hlasova�',
    'user_gal' => 'U��vate�sk� gal�ria',
    'no_cat' => '* Bez kateg�rie *',
    'alb_empty' => 'Gal�ria je pr�zdna',
    'last_uploaded' => 'Najnov�� obr�zok',
    'public_alb' => 'ktoko�vek (verejn� gal�ria)',
    'me_only' => 'Iba ja',
    'owner_only' => 'Iba vlastn�k (%s)',
    'groupp_only' => '�lenovia skupiny \'%s\'',
    'err_no_alb_to_modify' => 'Album nemo�no modifikova� v datab�ze.',
    'update' => 'Aktualizova� album'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
    'already_rated' => 'Tento ob�zok ste u� hodnotil(a)',
    'rate_ok' => 'V� hlas bol prijat�. �akujeme.',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Administr�tori servra {SITE_NAME}, po�a�mo tejto gal�rie si vyhradzuj� pr�vo z�sahu do obsahu gal�rie napr. koment�re, mazanie obr�zkov pr�padne �prava (Pokia� poru�uj� pravidl� gal�rie alebo dobr� mravy).
Pokia� bud� obr�zky nahran� u��vate�om poru�ova� z�kon(y) bud� ihne� po zisten� ich umiestnenia na serveri zmazan�. Administr�tori/prev�dzkovatelia tejto gal�rie sa di�tancuj� od
pr�padn�ho z�vadn�ho obsahu nahran�ho na server u��vate�om. Vlastn�kom d�t v gal�rii s� ich autori. Administr�tori predpokladaj�, �e na server s� umiest�ovan� u��vate�mi iba obr�zky ku ktor�m m� u��vate� autorsk� pr�va.
<br />
Pokia� s�hlas�te, �e nebudete posiela� ak�ko�vek z�vadn� materi�l ako vulg�rny a obsc�nny obr�zky/koment�re, ak�ko�vek materi�l vzbudzuj�ci nen�vis�, rasizmus, alebo in� materi�l poru�uj�ci z�kony. S�hlas�te, �e administr�tori, prev�dzkovatelia a moder�tori  {SITE_NAME}   maj� pr�vo zmaza� pr�padne upravi� ak�ko�vek materi�l kedyko�vek to uznaj� za vhodn�. Vlo�en� inform�cie bud� ulo�en� na servri a v datab�ze a nebud� poskytnut� �iadnej tretej strane bez v�ho s�hlasu. Administr�tori/prev�dzkovatelia servra  v�ak nie s� ani nebud� ru�i� za d�ta na servri ulo�en� pokia� d�jde k ak�muko�vek �toku na sever.
<br />
<br />
Tieto str�nky vyu��vaj� k ulo�eniu u��vate�sk�ch d�t cookies. Cookies sl��ia len pre zv��enie komfortu pri pou��van� tejto aplik�cie. Emailov� adresa sl��i len pre potvrdenie va�ich �dajov a zaslanie hesla.<br />
<br />
Kliknut�m na 'S�hlas�m' s�hlas�te z vy��ie uveden�mi pravidlami..

EOT;

$lang_register_php = array(
    'page_title' => 'Registr�cia nov�ho u��vate�a',
    'term_cond' => 'Podmienky a pravidl�',
    'i_agree' => 'S�hlas�m',
    'submit' => 'Posla� registr�ciu',
    'err_user_exists' => 'Zadan� u��vate�sk� mno u� existuje vyberte si pros�m in�',
    'err_password_mismatch' => 'Hesla sa musia zhodova� pokuste sa ich obe zada� znova',
    'err_uname_short' => 'Minim�lna d�ka u��vate�sk�ho mena je 2 znaky',
    'err_password_short' => 'Heslo mus� by� aspo� 2 znaky dlh�',
    'err_uname_pass_diff' => 'Meno a heslo se nesm� zhodova�',
    'err_invalid_email' => 'Bola zadan� neplatn� emailov� adresa',
    'err_duplicate_email' => 'In� u��vate� sa zaregistroval so zadan�m emailom. Email mus� by� jedine�n�',
    'enter_info' => 'Zadan� registra�n� inform�cie',
    'required_info' => 'Vy�adovan� inform�cie',
    'optional_info' => 'Volite�n� inform�cie',
    'username' => 'Meno',
    'password' => 'Heslo',
    'password_again' => 'Heslo (potvrdenie)',
    'email' => 'Email',
    'location' => 'Mesto (napr. Ko�ice apod.)',
    'interests' => 'Z�ujmy',
    'website' => 'Dom�ca str�nka',
    'occupation' => 'Povolanie',
    'error' => 'CHYBA',
    'confirm_email_subject' => '%s - Potvrdenie registr�cie',
    'information' => 'Inform�cie',
    'failed_sending_email' => 'Nemo�no odosla� potvrdenie registr�cie !',
    'thank_you' => '�akujeme za registr�ciu.<br /><br />Na adresu zadan� pri registr�cii V�m bud� doru�en� inform�cie o aktiv�cii va�ho ��tu',
    'acct_created' => 'V� u��vate�sk� ��et bol �spe�ne vytvoren�. Teraz sa prihl�ste pomocou v�ho mena a hesla',
    'acct_active' => 'V� ��et je teraz akt�vny prihl�ste se pomocou v�ho mena a hesla.',
    'acct_already_act' => 'V� ��et je u� akt�vny !',
    'acct_act_failed' => 'Tento ��et nem��e by� aktivovan� !',
    'err_unk_user' => 'Vybran� u��vate� neexistuje !',
    'x_s_profile' => '%s\' profil',
    'group' => 'Skupina',
    'reg_date' => 'Pripojen�',
    'disk_usage' => 'Vyu�itie disku',
    'change_pass' => 'Zmeni� heslo',
    'current_pass' => 'S��asn� heslo',
    'new_pass' => 'Nov� heslo',
    'new_pass_again' => 'Nov� heslo (kontrola)',
    'err_curr_pass' => 'S��asn� heslo zad�n� nespr�vne',
    'apply_modif' => 'potvrdi� zmeny',
    'change_pass' => 'Zmeni� heslo',
    'update_success' => 'V� profil bol aktualizovan�',
    'pass_chg_success' => 'Va�e heslo bolo zmenen�',
    'pass_chg_error' => 'Va�e heslo nebolo zmenen�',
);

$lang_register_confirm_email = <<<EOT
�akujeme za registr�ciu na {SITE_NAME}

Va�e meno je : "{USER_NAME}"
Va�e heslo je: "{PASSWORD}"

Pre aktiv�ci va�eho ��tu je potrebn� klikn�� na odkaz ni��ie alebo ho skop�rova�
do adresn�ho riadku v�ho browsera a prejs� na t�to str�nku


{ACT_LINK}

S Pozdravom,

Spr�va serveru {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
    'title' => 'Kontrola koment�rov',
    'no_comment' => 'Tu nie s� koment�re na kontrolu',
    'n_comm_del' => '%s koment�r(ov) zmazan�(ch)',
    'n_comm_disp' => 'Po�et koment�rov na zobrazenie',
    'see_prev' => 'Predch�dzaj�ci',
    'see_next' => '�al��',
    'del_comm' => 'Zmaza� vybran� koment�re',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
    0 => 'Preh�ad�va� obr�zky',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
    'page_title' => 'N�js� nov� obr�zky',
    'select_dir' => 'Vybra� adres�r',
    'select_dir_msg' => 'T�to funkcia v�m umo�n� d�vkovo spracova� obr�zky nahran� cez FTP.<br /><br />Vyberte adres�r kde sa nach�dzaj� obr�zky na spracovanie',
    'no_pic_to_add' => 'Nie su tu �iadne obr�zky na pridanie',
    'need_one_album' => 'Porebujete ma� vytvoren� aspo� jednu gal�riu',
    'warning' => 'Varovanie',
    'change_perm' => 'Skript nem��e zapisova� do tohto adres�ra, mus�te ho nastavit na CHMOD 755 alebo 777 pred pridan�m obr�zkov !',
    'target_album' => '<b>Vlo�i� obr�zky z &quot;</b>%s<b>&quot; do </b>%s',
    'folder' => 'Zlo�ka',
    'image' => 'Obr�zok',
    'album' => 'Gal�ria',
    'result' => 'V�sledok',
    'dir_ro' => 'Nezapisovate�n�. ',
    'dir_cant_read' => 'Ne�itate�n�. ',
    'insert' => 'Prid�v�m nov� obr�zky do gal�rie',
    'list_new_pic' => 'Zoznam obr�zkov',
    'insert_selected' => 'Vlo�i� vybran� obr�zky',
    'no_pic_found' => 'Nov� obr�zky neboli n�jden�',
    'be_patient' => 'Pros�m bu�te trpezliv�(�), program potrebuje na spracovanie obr�zka nejak� ten �as.',
    'notes' =>  '<ul>'.
                '<li><b>OK</b> : Tieto obr�zky boli pridan�'.
                '<li><b>DP</b> : Zdvojenie!, Tento obr�zok u� existuje'.
                '<li><b>PB</b> : tento obr�zok nemo�no prida�, skontrolujte konfigur�ciu pr�padne pr�stupov� pr�va'.
                '<li>Ak se neuk�e \'ozna�enie\' OK, DP, PB kliknite na obr�zek a uvid�te chybov� hl�ku generovan� PHP, ktor� V�m pom��e zisti� pr��inu probl�mu'.
                '<li>Pokia� d�jde k timeoutu F5 alebo reload str�nky by mal pom�c�'.
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
                'title' => 'Vykopnut� u��vatelia',
                'user_name' => 'U��vate�ske meno',
                'ip_address' => 'IP Adresa',
                'expiry' => 'Vypr�� za (nevypl�ova� pre st�le vykopnutie)',
                'edit_ban' => 'Ulo�i� zmeny',
                'delete_ban' => 'Zmaza�',
                'add_new' => 'Prida� dal�ie vykopnutie',
                'add_ban' => 'Prida�',
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
    'title' => 'Uploadn�� obr�zok',
    'max_fsize' => 'Max. ve�kos� s�boru je %s KB',
    'album' => 'Gal�ria',
    'picture' => 'Obr�zok',
    'pic_title' => 'Nadpis obr�zku',
    'description' => 'Popis obr�zku',
    'keywords' => 'K���ov� slov� (oddelen� medzerou)',
    'err_no_alb_uploadables' => 'Nie je tu gal�ria do ktorej je povolen� upload.',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
    'title' => 'Spravova� u��vate�ov',
    'name_a' => 'Meno vzostup.',
    'name_d' => 'Meno zostup.',
    'group_a' => 'Skupina vzostup.',
    'group_d' => 'Skupina zostup.',
    'reg_a' => 'D�tum registr�cie vzostup.',
    'reg_d' => 'D�tum registr�cie zostup.',
    'pic_a' => 'Po�et obr�zkov vzostup.',
    'pic_d' => 'Po�et obr�zkov zostup.',
    'disku_a' => 'Vyu�itie disku vzostup.',
    'disku_d' => 'Vyu�itie disku zostup.',
    'sort_by' => 'Radi� u��vate�ov pod�a',
    'err_no_users' => 'Tabu�ka u��vate�ov je pr�zdna!',
    'err_edit_self' => 'Tu nem��te editova� vlastn� profil pou�ijte pr�slu�n� vo�bu pracuj�cu s va�im profilom',
    'edit' => 'UPRAVI�',
    'delete' => 'ZMAZA�',
    'name' => 'U�iv. meno',
    'group' => 'Skupina U�iv.',
    'inactive' => 'Neaktivn�',
    'operations' => 'Oper�cia',
    'pictures' => 'Obr�zky',
    'disk_space' => 'Miesto vyu�it� / kv�ta',
    'registered_on' => 'Registrovan�',
    'u_user_on_p_pages' => '%d u��vate�ov na %d str�nkach',
    'confirm_del' => 'Ste si jist�(�), �e chcete zmaza� tohto u��vate�a ? \\nV�etky jeho obr�zky, gal�rie a koment�re bud� zmazan�.',
    'mail' => 'MAIL',
    'err_unknown_user' => 'Vybran� u��v. neexistuje !',
    'modify_user' => 'Zmeni� u��v.',
    'notes' => 'Pozn�mky',
    'note_list' => '<li>Pokia� nechcete zmeni� heslo ponechajte pol��ko pre heslo pr�zdne',
    'password' => 'Heslo',
    'user_active' => 'U��v. je akt�vny',
    'user_group' => 'U��v. Skupina',
    'user_email' => 'U��v. emaill',
    'user_web_site' => 'U��v. dom�ca str�nka',
    'create_new_user' => 'Vytvori� nov�ho u��vate�a.',
    'user_location' => 'Mesto U��v. (napr. Ko�ice apod.)',
    'user_interests' => 'U��v. z�ujmy',
    'user_occupation' => 'U��v. povolanie',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Zmeni� ve�kos� obr�zku',
        'what_it_does' => '�o to rob�?',
        'what_update_titles' => 'Aktualizova� nadpisy pod�a mena s�borov',
        'what_delete_title' => 'Zmaza� nadpisy',
        'what_rebuild' => 'Prerobi� n�h�ady a zmenen� obr�zky',
        'what_delete_originals' => 'Zmaza� origin�ly a nahradi� ich stredn�mi obr�zkami',
        'file' => 's�bor',
        'title_set_to' => 'Nastavi� nadpis na',
        'submit_form' => 'odosla�',
        'updated_succesfully' => 'Aktualiz�cia probehla OK',
        'error_create' => 'CHYBA pri vytv�ran�',
        'continue' => 'Spracova� viac obr�zkov',
        'main_success' => 'S�bor %s bol uspe�ne pou�it� ako hlavn� obr�zok',
        'error_rename' => 'Chyba premenov�van� %s na %s',
        'error_not_found' => 's�bor %s nebol n�jden�',
        'back' => 'sp� na halvn�',
        'thumbs_wait' => 'Aktualizujem n�h�ady a/alebo stredn� obr�zky, pros�m �akajte...',
        'thumbs_continue_wait' => 'Pokra�ujem v aktualiz�cii n�h�adov a/alebo stredn�ch obr�zkov...',
        'titles_wait' => 'Aktualizujem nadpisy, pros�m �akajte...',
        'delete_wait' => 'Ma�em nadpisy, pros�m �akajte...',
        'replace_wait' => 'Ma�em origin�ly a nahr�dzam ich stredn�mi obr�zkami, pros�m �akajte...',
        'instruction' => 'R�chle in�trukcie',
        'instruction_action' => 'Vyberte akciu',
        'instruction_parameter' => 'Nastavi� parametre',
        'instruction_album' => 'Vybra� gal�riu',
        'instruction_press' => 'Stla�te %s',
        'update' => 'Aktualizova� n�h�ady a/alebo stredn� obr�zky',
        'update_what' => '�o m� by� aktualizovan�',
        'update_thumb' => 'Len n�h�ady',
        'update_pic' => 'Iba stredn� obr�zky',
        'update_both' => 'Oboje n�h�ady i stredn� obr�zky',
        'update_number' => 'Po�et obr�zkov, ktor� spracova� na 1 kliknutie',
        'update_option' => '(Zn�te ��slo pokia� m�te probl�my s timeoutom)',
        'filename_title' => 'Meno s�boru ? Nadpis obr�zka',
        'filename_how' => 'Ako sa m� zmeni� meno obr�zka?',
        'filename_remove' => 'Odstr�ni� .jpg koncovku a prep�sa� _ (podtr��tka medzerami)',
        'filename_euro' => 'Zmeni� 2003_11_23_13_20_20.jpg na 23/11/2003 13:20',
        'filename_us' => 'Zmeni� 2003_11_23_13_20_20.jpg na 11/23/2003 13:20',
        'filename_time' => 'Zmeni� 2003_11_23_13_20_20.jpg na 13:20',
        'delete' => 'Zmaza� nadpisy obr�zkov alebo origin�lne obr�zky',
        'delete_title' => 'Zmaza� nadpisy obr�zkov',
        'delete_original' => 'Zmaza� origin�lne obr�zky',
        'delete_replace' => 'Zmaza� origin�ly a nahradi� ich stredn�mi verziami obr�zkov',
        'select_album' => 'Vybra� gal�riu',
);
?>
