<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.0                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002-2004 Gregory DEMAR                                     //
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
// $Id$
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'Latvian',  //the name of your language in English, e.g. 'Greek' or 'Spanish'
'lang_name_native' => 'Latviski', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
'lang_country_code' => 'lv', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
'trans_name'=> 'Kaspars Priedols', //the name of the translator - can be a nickname
'trans_email' => 'house@tvertne.nu', //translator's email address (optional)
'trans_website' => 'http://foto.tvertne.nu/', //translator's website (optional) //.lv ONLY
'trans_date' => '2004-06-28', //the date the translation was created / last modified
);

$lang_charset = 'ISO-8859-4';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('B', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Sv', 'Pr', 'Ot', 'Tr', 'Ct', 'Pt', 'Ss');
$lang_month = array('Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'J�n', 'J�l', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec');

// Some common strings
$lang_yes = 'J�';
$lang_no  = 'N�';
$lang_back = 'ATGRIEZTIES';
$lang_continue = 'TURPIN�T';
$lang_info = 'Inform�cija';
$lang_error = 'K��da';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%d/%m/%Y %H:%M';
$lastcom_date_fmt = '%d/%m/%Y %H:%M';
$lastup_date_fmt = '%d/%m/%Y %H:%M';
$register_date_fmt = '%d/%m/%Y %H:%M';
$lasthit_date_fmt = '%d/%m/%Y %H:%M';
$comment_date_fmt = '%d/%m/%Y %H:%M';


// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*', 'pimp*', 'pe�*', 'pipel*', 'b�a�*', 'nahu*', 'pist*', 'pisien*', 'mirl*', 's�d*', 'bled', 'blad', 'pizde*', 'mauka', 'mauc�*', '�nus*', 'kaka', 's�k�');

$lang_meta_album_names = array(
    'random' => 'Izlases veida att�li',
    'lastup' => 'Jaun�kie papildin�jumi',
    'lastalb'=> 'P�d�jie atjaunotie albumi', //new in cpg1.2.0
    'lastcom' => 'Jaun�kie koment�ri',
    'topn' => 'Skat�t�kie',
    'toprated' => 'Vispopul�r�kie',
    'lasthits' => 'P�d�jie skat�tie',
    'search' => 'Mekl��anas rezult�ti', //new in cpg1.2.0
    'favpics'=> 'Att�lu favor�ti' //new in cpg1.2.0
);

$lang_errors = array(
        'access_denied' => 'Tev nav pieejas ties�bu �ai lapai.',
        'perm_denied' => 'Tev nav ties�bu veikt ��du darb�bu.',
        'param_missing' => 'Tika izsaukta komanda bez parametriem.',
        'non_exist_ap' => 'Izv�l�tais albums/att�ls neeksist�!',
        'quota_exceeded' => 'Nav vietas uz diska.<br /><br />Tev ir pie��irts ierobe�ojums [quota]K, bet pa�laik jau aiz�emti [space]K, t�p�c �� att�la pievieno�ana nav ieteicama (tiks p�rsniegts ierobe�ojums).',
        'gd_file_type_err' => 'Izmantojot GD att�lu bibliot�ku, at�auts izmantot tikai JPEG un PNG form�tus.',
        'invalid_image' => 'Att�ls boj�ts vai ar� sist�mas GD att�lu bibliot�ka nesp�j to atkod�t.',
        'resize_failed' => 'Nav iesp�jams izveidot mazo att�lu vai izmain�t t� izm�rus.',
        'no_img_to_display' => 'Nav att�la',
        'non_exist_cat' => 'Izv�l�t� sada�a neeksist�',
        'orphan_cat' => '�ai apak�sada�ai nav sada�as, kam t� pieder�tu, l�dzu izmanto sada�u mened�eri, lai atrisin�tu probl�mu.',
        'directory_ro' => 'Direktorij� \'%s\' nav at�auts rakst�t, t�p�c att�lus nav iesp�jams izdz�st.',
        'non_exist_comment' => 'Izv�l�tais koment�rs neeksist�.',
        'pic_in_invalid_album' => 'Att�ls atrodas neeksist�jo�� album� (%s)!?', //new in cpg1.2.0
        'banned' => 'Pieeja foto galerijai aizliegta.', //new in cpg1.2.0
        'not_with_udb' => '�� iesp�ja ir atsl�gta, jo tai j�b�t integr�tai kop� ar foruma programmat�ru. Tr�kst attiec�g�s konfigur�cijas, vai nepiecie�ams uzinstal�t forumu.', //new in cpg1.2.0
        'offline_title' => 'Pazi�ojums', //cpg1.3.0
        'offline_text' => 'Pa�laik notiek tehniski uzlabojumi - ien�c v�l�k', //cpg1.3.0
        'ecards_empty' => 'E-kar�u sist�ma nav aktiviz�ta!', //cpg1.3.0
        'action_failed' => 'Oper�cija p�rtraukta, jo notikusi k��da.', //cpg1.3.0
        'no_zip' => 'Kompres��ana ZIP form�t� nav pieejama.', //cpg1.3.0
        'zip_type' => 'Nav at�aujas pievienot ZIP form�ta failus.', //cpg1.3.0

);

$lang_bbcode_help = 'Teksta format��anai at�auts izmantot: <li>[b]<b>trekni</b>[/b]</li> <li>[i]<i>sl�pi</i>[/i]</li> <li>[url=http://adrese.com/]Nor�des teksts[/url]</li> <li>[email]vards@adrese.com[/email]</li>'; //cpg1.3.0

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
    'alb_list_title' => 'Uz albumu sarakstu',
    'alb_list_lnk' => 'Albumu saraksts',
    'my_gal_title' => 'Uz manu galeriju',
    'my_gal_lnk' => 'Mana galerija',
    'my_prof_lnk' => 'My profails',
    'adm_mode_title' => 'P�rsl�gties Administratora re��m�',
    'adm_mode_lnk' => 'Administratora re��ms',
    'usr_mode_title' => 'P�rsl�gties lietot�ja re��m�',
    'usr_mode_lnk' => 'Lietot�ja re��ms',
    'upload_pic_title' => 'Ielikt att�lu album�',
    'upload_pic_lnk' => 'Pievienot att�lu',
    'register_title' => 'Izveidot kontu',
    'register_lnk' => 'Re�istr�ties',
    'login_lnk' => 'Piesl�gties',
    'logout_lnk' => 'Beigt darbu',
    'lastup_lnk' => 'Jaun�kie att�li',
    'lastcom_lnk' => 'Jaun�kie koment�ri',
    'topn_lnk' => 'Skat�t�kie att�li',
    'toprated_lnk' => 'Vispopul�r�kie',
    'search_lnk' => 'Mekl�t',
    'fav_lnk' => 'Favor�ti', //new in cpg1.2.0
  'memberlist_title' => 'Visi dal�bnieki', //cpg1.3.0
  'memberlist_lnk' => 'Dal�bnieku saraksts', //cpg1.3.0
  'faq_title' => 'Bie��k uzdotie jaut�jumi par &quot;Coppermine&quot;', //cpg1.3.0
  'faq_lnk' => 'FAQ', //cpg1.3.0
);

$lang_gallery_admin_menu = array(
    'upl_app_lnk' => 'Apstiprin�t',
    'config_lnk' => 'Konfigur�t',
    'albums_lnk' => 'Albumi',
    'categories_lnk' => 'Sada�as',
    'users_lnk' => 'Lietot�ji',
    'groups_lnk' => 'Grupas',
    'comments_lnk' => 'Koment�ri',
    'searchnew_lnk' => 'Att�lu grupas...',
    'util_lnk' => 'Main�t att�la izm�rus', //new in cpg1.2.0
    'ban_lnk' => 'Aiziegt piek�uvi', //new in cpg1.2.0
        'db_ecard_lnk' => 'E-kartes', //cpg1.3.0
);

$lang_user_admin_menu = array(
    'albmgr_lnk' => 'Izveidot manu albumu',
    'modifyalb_lnk' => 'Main�t manu albumu',
    'my_prof_lnk' => 'Profails',
);

$lang_cat_list = array(
    'category' => 'Sada�as',
    'albums' => 'Albumi',
    'pictures' => 'Att�li',
);

$lang_album_list = array(
    'album_on_page' => '%d albums(-i) %d lap�(s)'
);

$lang_thumb_view = array(
    'date' => 'LAIKS',
    //Sort by filename and title
    'name' => 'NOSAUKUMS', //new in cpg1.2.0
    'title' => 'VIRSRAKSTS', //new in cpg1.2.0
    'sort_da' => 'p�c datuma augo�i',
    'sort_dd' => 'p�c datuma dilsto�i',
    'sort_na' => 'p�c nosaukuma augo�i',
    'sort_nd' => 'p�c nosaukuma dilsto�i',
    'sort_ta' => 'p�c virsraksta augo�i', //new in cpg1.2.0
    'pic_on_page' => '%d att�ls(-i) %d lap�(s)',
    'user_on_page' => '%d dal�bnieks(-i) %d lap�(s)'
);

$lang_img_nav_bar = array(
    'thumb_title' => 'Atgriezties uz att�lu indeksu',
    'pic_info_title' => 'R�d�t/pasl�pt inform�ciju par att�lu',
    'slideshow_title' => 'Slaid�ovs',
    'ecard_title' => 'S�t�t k� e-karti�u',
    'ecard_disabled' => 'e-karti�u s�t��ana atsl�gta',
    'ecard_disabled_msg' => 'Tev nav pietiekamu ties�bu, lai s�t�tu e-karti�as',
    'prev_title' => 'Iepriek��jais att�ls',
    'next_title' => 'N�kamais att�ls',
    'pic_pos' => 'ATT�LS %s/%s',
);

$lang_rate_pic = array(
    'rate_this_pic' => 'Nov�rt�t ',
    'no_votes' => '(nov�rt�juma nav)',
    'rating' => '(nov�rt�jums: %s balsis no 5 (balsots %s reizi(-es))',
    'rubbish' => 'M�sls',
    'poor' => 'V�ji',
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
    CRITICAL_ERROR => 'Kritiska k��da',
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
    'n_comments' => 'koment�ri: <b>%s</b>',
    'n_views' => 'skat�jumi: <b>%s</b>',
    'n_votes' => 'v�rt�jumi: <b>%s</b>'
);

$lang_cpg_debug_output = array(
  'debug_info' => 'Debug Info', //cpg1.3.0
  'select_all' => 'Select All', //cpg1.3.0
  'copy_and_paste_instructions' => 'If you\'re going to request help on the coppermine support board, copy-and-paste this debug output into your posting. Make sure to replace any passwords from the query with *** before posting.', //cpg1.3.0
  'phpinfo' => 'display phpinfo', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => 'Valoda p�c noklus��anas', //cpg1.3.0
  'choose_language' => 'Izv�lies valodu', //cpg1.3.0
);

$lang_theme_selection = array(
  'reset_theme' => 'T�ma p�c noklus��anas', //cpg1.3.0
  'choose_theme' => 'Izv�lies t�mu', //cpg1.3.0
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
    0 => 'Pametam administr��anas re��mu...',
    1 => 'Uz administr��anas re��mu...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
    'alb_need_name' => 'K� sauksim albumu?',
    'confirm_modifs' => 'Apstiprin�t veikt�s izmai�as?',
    'no_change' => 'Nekas nav main�ts!',
    'new_album' => 'Jauns albums',
    'confirm_delete1' => 'Tie��m dz�st �o albumu?',
    'confirm_delete2' => '\nVisi att�li un koment�ri taj� tiks izdz�sti!',
    'select_first' => 'Vispirms j�izv�las albumu',
    'alb_mrg' => 'Albumu mened�eris',
    'my_gallery' => '* Mana galerija *',
    'no_category' => '* Mana sada�a *',
    'delete' => 'Dz�st',
    'new' => 'Jauns',
    'apply_modifs' => 'Apstiprin�t izmai�as',
    'select_category' => 'Izv�l�ties sada�u',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
    'miss_param' => 'Komandas \'%s\' izpild��anai tr�kst nepiecie�amie parametri!',
    'unknown_cat' => 'Izv�l�t� sada�a datu b�z� neeksist�',
    'usergal_cat_ro' => 'Lietot�ja galerijas sada�a nevar tikt dz�sta!',
    'manage_cat' => 'Administr�t sada�as',
    'confirm_delete' => 'Tie��m dz�st �o sada�u',
    'category' => 'Sada�a',
    'operations' => 'Darb�bas',
    'move_into' => 'P�rvietot uz',
    'update_create' => 'Modific�t/izveidot sada�u',
    'parent_cat' => 'Pieder sada�ai',
    'cat_title' => 'Sada�as virsraksts',
        'cat_thumb' => 'Sada�as starpatt�ls', //cpg1.3.0
    'cat_desc' => 'Sada�as apraksts'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
    'title' => 'Konfigur�cija',
    'restore_cfg' => 'Atjaunot noklus�t�s v�rt�bas',
    'save_cfg' => 'Saglab�t jaunos uzst�d�jumus',
    'notes' => 'Piez�mes',
    'info' => 'Inform�cija',
    'upd_success' => 'Coppermine konfigur�cija saglab�ta',
    'restore_success' => 'Coppermine noklus�t� konfigur�cija uzst�d�ta',
    'name_a' => 'Nosaukums augo�i',
    'name_d' => 'Nosaukums dilsto�i',
    'title_a' => 'Virsraksts augo�i', //new in cpg1.2.0
    'title_d' => 'Virsraksts dilsto�i', //new in cpg1.2.0
    'date_a' => 'Datums augo�i',
    'date_d' => 'Datums dilsto�i',
    'th_any' => 'Max Aspect',
    'th_ht' => 'Augstums',
    'th_wd' => 'Platums',
    'label' => 'Teksts', //cpg1.3.0
    'item' => 'att.', //cpg1.3.0
    'debug_everyone' => 'Jebkur�', //cpg1.3.0
    'debug_admin' => 'Tikai administrators', //cpg1.3.0
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
    'Galvenie uzst�d�jumi',
    array('Nosaukums', 'gallery_name', 0),
    array('Apraksts', 'gallery_description', 0),
    array('Administrators', 'gallery_admin_email', 0),
    array('Adrese, kas b�s e-karti�� pie teksta \'Citi att�li...\'', 'ecards_more_pic_target', 0),
        array('Norit tehniski darbi. Galerija ir atsl�gta.', 'offline', 1), //cpg1.3.0
        array('Log ecards', 'log_ecards', 1), //cpg1.3.0
        array('At�aut lejupiel�d�t ZIP att�lus', 'enable_zipdownload', 1), //cpg1.3.0

        'Valodas, T�mas &amp; kod��ana',
    array('Valoda', 'lang', 5),
    array('T�ma', 'theme', 6),
        array('R�d�t valodu izv�li', 'language_list', 1), //cpg1.3.0
        array('R�d�t karodzi�us', 'language_flags', 8), //cpg1.3.0
        array('R�d�t &quot;reset&quot; valodu izv�l�', 'language_reset', 1), //cpg1.3.0
        array('R�d�t t�mu sarakstu', 'theme_list', 1), //cpg1.3.0
        array('R�d�t &quot;reset&quot; t�mu izv�l�', 'theme_reset', 1), //cpg1.3.0
        array('R�d�t FAQ', 'display_faq', 1), //cpg1.3.0
        array('R�d�t bbcode pal�dz�bu un piem�rus', 'show_bbcode_help', 1), //cpg1.3.0
        array('Kod�jums (Character encoding)', 'charset', 4), //cpg1.3.0

        'Albumu saraksta skat�jums',
        array('Galven�s tabulas platums (pikse�os vai %)', 'main_table_width', 0),
    array('Cik l�me�os sada�as atspogu�ot', 'subcat_level', 0),
    array('Cik albumus atspogu�ot', 'albums_per_page', 0),
    array('Cik kolonn�s atspogu�ot alb�mus', 'album_list_cols', 0),
    array('Cik lieli pikse�os b�s mazie att�li', 'alb_list_thumb_size', 0),
    array('Galven�s lapas saturs', 'main_page_layout', 0),
    array('R�d�t pirm� l�me�a mazos att�lus pa sada��m','first_level',1), //new in cpg1.2.0

    'Mazo att�lu skat�jums',
    array('Cik kolonn�s r�d�t mazos att�lus', 'thumbcols', 0),
    array('Cik rind�s r�d�t mazos att�lus', 'thumbrows', 0),
    array('Cik tabulas atspogu�ot', 'max_tabs', 0),
    array('Blakus mazajam att�lam atspogu�ot ne tikai att�la virsrakstu, bet ar� aprakstu', 'caption_in_thumbview', 1),
        array('R�d�t skat��an�s rei�u skaitu blakus mazajam att�lam', 'views_in_thumbview', 1), //cpg1.3.0
    array('Atspogu�ot koment�ru skaitu', 'display_comment_count', 1),
        array('R�d�t, kur� uzlicis att�lu', 'display_uploader', 1), //cpg1.3.0
    array('K� k�rtot att�lus', 'default_sort_order', 3),
    array('Minim�lais balsu skaits, lai att�ls tiktu iek�auts vispopul�r�ko sarakst�', 'min_votes_for_rating', 0),

    'Att�lu skat��an�s &amp; Koment�ri',
    array('Att�la tabulas platums (pikse�os vai %)', 'picture_table_width', 0),
    array('Att�la inform�cija redzama p�c noklus��anas', 'display_pic_info', 1),
    array('Filtr�t sliktus v�rdus koment�ros', 'filter_bad_words', 1),
    array('At�aut seji�as koment�ros', 'enable_smilies', 1),
        array('At�aut vair�kk�rt�jus koment�rus no vienas personas par vienu att�lu (atsl�gt -flood protection-)', 'disable_comment_flood_protect', 1), //cpg1.3.0
    array('Max att�la apraksta garums', 'max_img_desc_length', 0),
    array('Max simbolu skaits vien� v�rd�', 'max_com_wlength', 0),
    array('Max rindu skaits koment�r�', 'max_com_lines', 0),
    array('Max koment�ra garums', 'max_com_size', 0),
    array('Filmas skat�jums', 'display_film_strip', 1), //new in cpg1.2.0
    array('Att�lu skaits filmas skat�jum�', 'max_film_strip_items', 0), //new in cpg1.2.0
        array('Pazi�ot Administratoram par jaunu koment�ru', 'email_comment_notification', 1), //cpg1.3.0
        array('Slaid�ova interv�ls (1 sek. = 1000 milisek.)', 'slideshow_interval', 0), //cpg1.3.0


    'Lielo un mazo att�lu kvalit�te',
    array('JPEG failu kvalit�te', 'jpeg_qual', 0),
    array('Max maz� att�la platums vai augstums <b>*</b>', 'thumb_width', 0),
    array('Izmantojamie izm�ri ( platums vai augstums )<b>*</b>', 'thumb_use', 0), //new in cpg1.2.0
    array('Izveidot ar� \'starpatt�lus\'','make_intermediate', 1),
    array('Max \'starpatt�la\' platums vai augstums <b>*</b>', 'picture_width', 0),
    array('Max uzlikt� att�la lielums (KB)', 'max_upl_size', 0),
    array('Max uzlikt� att�la platums vai augstums (pikse�os)', 'max_upl_width_height', 0),


        'Failu un mazo att�lu s�k�ki uzst�d�jumi', //cpg1.3.0
        array('R�d�t priv�ta alb�ma ikonu tiem, kas nav piesl�gu�ies','show_private',1), //cpg1.3.0
        array('Aizliegtie simboli failu nosaukumos', 'forbiden_fname_char',0), //cpg1.3.0
        //array('Accepted file extensions for uploaded pictures', 'allowed_file_extensions',0), //cpg1.3.0
        array('At�autie att�lu form�ti', 'allowed_img_types',0), //cpg1.3.0
        array('At�autie �sfilmu form�ti', 'allowed_mov_types',0), //cpg1.3.0
        array('At�autie audio form�ti', 'allowed_snd_types',0), //cpg1.3.0
        array('At�autie dokumentu form�ti', 'allowed_doc_types',0), //cpg1.3.0
        array('Att�lu izm�ru kori���anas metode','thumb_method',2), //cpg1.3.0
        array('Kur sist�m� atrodas ImageMagick \'convert\' util�ta (piem�ram, /usr/bin/X11/)', 'impath', 0), //cpg1.3.0
        //array('Allowed image types (only valid for ImageMagick)', 'allowed_img_types',0), //cpg1.3.0
        array('ImageMagick komandrindas opcijas', 'im_options', 0), //cpg1.3.0
        array('Las�t EXIF inform�ciju no JPEG failiem', 'read_exif_data', 1), //cpg1.3.0
        array('Las�t IPTC inform�ciju no JPEG failiem', 'read_iptc_data', 1), //cpg1.3.0
        array('Alb�ma direktorija <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0), //cpg1.3.0
        array('Dal�bnieku failu direktorija <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0), //cpg1.3.0
        array('Direktorija vid�ja izm�ra att�lu glab��anai <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0), //cpg1.3.0
        array('Mazo att�lu prefikss <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0), //cpg1.3.0
        array('Direktoriju opcijas', 'default_dir_mode', 0), //cpg1.3.0
        array('Failu opcijas', 'default_file_mode', 0), //cpg1.3.0


    'Lietot�ju uzst�d�jumi',
    array('At�aut jaunu lietot�ju piere�istr��anos', 'allow_user_registration', 1),
    array('Lietot�ja sekm�gai re�istr�cija nepiecie�ams e-pasta apstiprin�jums', 'reg_requires_valid_email', 1),
        array('Pazi�ot administratoram par jaunu dal�bnieka re�istr�ciju', 'reg_notify_admin_email', 1), //cpg1.3.0
    array('At�aut diviem da��diem lietot�jiem izmantot vien�das e-pasta adreses', 'allow_duplicate_emails_addr', 1),
    array('Lietot�js dr�kst veidot person�gus alb�mus', 'allow_private_albums', 1),
        array('Pazi�ot Administratoram par dal�bnieku, kam j�apstiprina faila pievieno�ana', 'upl_notify_admin_email', 1), //cpg1.3.0
        array('At�aut skat�ties inform�ciju par citiem dal�bniekiem, ja ir notikusi veiksm�ga piesl�g�an�s sist�mai', 'allow_memberlist', 1), //cpg1.3.0

    'Rezerves lauki att�la aprakstam (ja neizmanto, atst�j tuk�us)',
    array('Lauka 1 nosaukums', 'user_field1_name', 0),
    array('Lauka 2 nosaukums', 'user_field2_name', 0),
    array('Lauka 3 nosaukums', 'user_field3_name', 0),
    array('Lauka 4 nosaukums', 'user_field4_name', 0),

    'Lielo un mazo att�lu �pa�ie uzst�d�jumi',
    array('R�d�t person�g� albuma ikonu anon�majiem apmekl�t�jiem','show_private',1), //new in cpg1.2.0
    array('K�di simboli aizliegti failu nosaukumos', 'forbiden_fname_char',0),
    array('Uzliekamo att�lu at�autie failu papla�in�jumi', 'allowed_file_extensions',0),
    array('Att�lu izm�ru main��anas metodes','thumb_method',2),
    array('Ce�� uz ImageMagick \'convert\' util�tu (piem�ram, /usr/bin/X11/)', 'impath', 0),
    array('At�auti att�lu form�ti (tikai priek� ImageMagick)', 'allowed_img_types',0),
    array('Komandrindas parametri ImageMagick util�tai', 'im_options', 0),
    array('Izmantot JPEG att�lu EXIF inform�ciju', 'read_exif_data', 1),
    array('Albumu direktorija <b>*</b>', 'fullpath', 0),
    array('Lietot�ju albumu direktorija <b>*</b>', 'userpics', 0),
    array('Starpatt�lu prefikss <b>*</b>', 'normal_pfx', 0),
    array('Mazo att�lu prefikss <b>*</b>', 'thumb_pfx', 0),
    array('Direktoriju skat�juma re��ms p�c noklus��anas', 'default_dir_mode', 0),
    array('Att�lu re��ms', 'default_file_mode', 0),
    array('Atsl�gt peles labo tausti�u uz lielajiem att�liem (JavaScript)', 'disable_popup_rightclick', 1), //new in cpg1.2.0
    array('Atsl�gt peles labo tausti�u &quot;parastaj�s&quot; lap�s (JavaScript)', 'disable_gallery_rightclick', 1), //new in cpg1.2.0

    'Cepumi (cookies) &amp; Kod�jums',
    array('Cookie nosaukumus', 'cookie_name', 0),
    array('Cookie ce��', 'cookie_path', 0),
    array('Teksta kod�jums', 'charset', 4),

    'Citi uzst�d�jumi',
    array('Debug re��ms', 'debug_mode', 1),

    '<br /><div align="center">(*) Ar * atz�m�tos parametrus nav ieteicams main�t, ja galer�j�s jau ir att�li</div><br /><a name="notice2"></a>(**) �� konfigur�cijas opcija neiespaidos l�dz �im pievienotos att�lus, bet iespaidos turpm�k�s oper�cijas. Jau eso�os failus iesp�jams modific�t &quot;<a href="util.php">ar Administratora l�dzek�iem</a> (resize opcija no Administratora izv�lnes)&quot;.</div><br />', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => 'Nos�t�t e-karti�u', //cpg1.3.0
  'ecard_sender' => 'S�t�t�js', //cpg1.3.0
  'ecard_recipient' => 'Sa��m�js', //cpg1.3.0
  'ecard_date' => 'Datums', //cpg1.3.0
  'ecard_display' => 'R�d�t e-karti�u', //cpg1.3.0
  'ecard_name' => 'V�rds', //cpg1.3.0
  'ecard_email' => 'Epasts', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_ascending' => 'augo�i', //cpg1.3.0
  'ecard_descending' => 'dilsto�i', //cpg1.3.0
  'ecard_sorted' => 'Sak�rtots', //cpg1.3.0
  'ecard_by_date' => 'p�c datuma', //cpg1.3.0
  'ecard_by_sender_name' => 'p�c v�rda', //cpg1.3.0
  'ecard_by_sender_email' => 'p�c s�t�t�ja epasta adreses', //cpg1.3.0
  'ecard_by_sender_ip' => 'p�c s�t�t�ja IP adreses', //cpg1.3.0
  'ecard_by_recipient_name' => 'p�c sa��m�ja v�rda', //cpg1.3.0
  'ecard_by_recipient_email' => 'p�c sa��m�ja epasta', //cpg1.3.0
  'ecard_number' => 'atspogu�oti %s ieraksti no %s (kop� %s)', //cpg1.3.0
  'ecard_goto_page' => 'uz lapu', //cpg1.3.0
  'ecard_records_per_page' => 'ieraksti vien� lap�', //cpg1.3.0
  'check_all' => 'Ie�eks�t visus', //cpg1.3.0
  'uncheck_all' => 'At�eks�t visus', //cpg1.3.0
  'ecards_delete_selected' => 'Dz�st izv�l�t�s karti�as', //cpg1.3.0
  'ecards_delete_confirm' => 'Vai tie��m dz�st? Apstiprini!', //cpg1.3.0
  'ecards_delete_sure' => 'Esmu guvis nelau�amu p�rliec�bu, ka t� j�dara', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
    'empty_name_or_com' => 'Ja neb�s v�rds un koment�ra teksts, nekas nesan�ks',
    'com_added' => 'Koment�rs pievienots',
    'alb_need_title' => 'K�ds ir albuma virsraksts (nosaukums)?',
    'no_udp_needed' => 'Izmai�as nav nepiecie�amas.',
    'alb_updated' => 'Album� veiksm�gi veiktas izmai�as',
    'unknown_album' => 'Izv�l�tais albums neeksist� vai ar� nav ties�bu taj� pievienot att�lus',
    'no_pic_uploaded' => 'Att�ls netika uzlikts!<br /><br />Vai uz servera ir uzlikta at�auja ��d�m oper�cij�m?',
    'err_mkdir' => 'Direktorija %s NEtika izveidota!',
    'dest_dir_ro' => 'Nav ties�bu veikt ierakstu direktrij� %s!',
    'err_move' => 'Nav iesp�jams p�rvietot %s uz %s !',
    'err_fsize_too_large' => 'Uzliekam� att�la izm�rs p�rsniedz max at�auto (max at�autais ir %s x %s) !',
    'err_imgsize_too_large' => 'Uzliekam� att�la faila izm�rs p�rsniedz max at�auto (max at�autais ir %s KB) !',
    'err_invalid_img' => 'Uzliekamais fails nav klasific�jams k� att�ls!',
    'allowed_img_types' => 'Tu dr�ksti uzlikt %s att�lus.',
    'err_insert_pic' => 'Att�ls \'%s\' nevar tikt pievienots ',
    'upload_success' => 'Att�ls veiksm�gi uzlikts<br /><br />Tas b�s redzams galerij�, tikl�dz Administrators to b�s akcept�jis.',
    'info' => 'Inform�cija',
    'com_added' => 'Koment�rs pievienots',
    'alb_updated' => 'Albums modific�ts',
    'err_comment_empty' => 'Nav koment�ra!',
    'err_invalid_fext' => 'At�auti faili ar ��diem papla�in�jumiem : <br /><br />%s.',
    'no_flood' => 'Atvaino, bet tie�i tu ar� esi p�d�j� ies�t�t� koment�ra autors.<br /><br />Modific� sava p�d�j� ies�t�t� koment�ra tekstu',
    'redirect_msg' => 'Notiek p�radres�cija.<br /><br /><br />Spied uz \'TURPIN�T\', ja lapa nep�rl�d�jas',
    'upl_success' => 'Att�ls veiksm�gi pievienots',
        'email_comment_subject' => 'Jauns foto galerijas koment�rs', //cpg1.3.0
        'email_comment_body' => 'K�ds pievienojis koment�ru, apskaties', //cpg1.3.0

);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
    'caption' => 'Teksts',
    'fs_pic' => 'piln� izm�ra att�ls',
    'del_success' => 'veiksm�gi izdz�sts',
    'ns_pic' => 'norm�la izm�ra att�ls',
    'err_del' => 'nevar tikt izdz�sts',
    'thumb_pic' => 'mazais att�ls',
    'comment' => 'koment�rs',
    'im_in_alb' => 'att�ls album�',
    'alb_del_success' => 'Albums \'%s\' izdz�sts',
    'alb_mgr' => 'Albuma mened�eris',
    'err_invalid_data' => 'Sa�emta nekorekta inform�cija \'%s\'',
    'create_alb' => 'Tiek veidots albums \'%s\'',
    'update_alb' => 'Tiek modific�ts albums \'%s\' ar virsrakstu \'%s\' un indeksu \'%s\'',
    'del_pic' => 'Dz�st att�lu',
    'del_alb' => 'Dz�st albumu',
    'del_user' => 'Dz�st lietot�ju',
    'err_unknown_user' => 'Izv�l�tais lietot�js neeksist�!',
    'comment_deleted' => 'Koment�rs veiksm�gi izdz�sts',
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
    'confirm_del' => 'Tie��m DZ�ST �o att�lu? \\nAr� koment�ri tiks izdz�sti.',
    'del_pic' => 'IZDZ�ST �O ATT�LU',
    'size' => '%s x %s px',
    'views' => '%s reizes',
    'slideshow' => 'Slaid�ovs',
    'stop_slideshow' => 'APST�DIN�T SLAID�OVU',
    'view_fs' => 'Uzspied, lai redz�tu pilna izm�ra att�lu',
        'edit_pic' => 'Redi��t aprakstu', //cpg1.3.0
        'crop_pic' => 'Izgriezt un sagriezt (Crop and Rotate)', //cpg1.3.0
);

$lang_picinfo = array(
    'title' =>'Inform�cija par att�lu',
    'Filename' => 'Att�ls',
    'Album name' => 'Albums',
    'Rating' => 'V�rt�jums (%s balsis)',
    'Keywords' => 'Atsl�gas v�rdi',
    'File Size' => 'Faila lielums',
    'Dimensions' => 'Izm�rs',
    'Displayed' => 'Att�lots',
    'Camera' => 'Kamera',
    'Date taken' => 'Uz�em�anas datums',
    'Aperture' => 'Objekt�va diametrs',
    'Exposure time' => 'Ekspoz�cijas laiks',
    'Focal length' => 'Fokuss',
    'Comment' => 'Koment�ri',
    'addFav'=>'Uz favor�tiem', //new in cpg1.2.0
    'addFavPhrase'=>'Favor�ti', //new in cpg1.2.0
    'remFav'=>'Dz�st no favor�tiem', //new in cpg1.2.0
        'iptcTitle'=>'IPTC Title', //cpg1.3.0
        'iptcCopyright'=>'IPTC Copyright', //cpg1.3.0
        'iptcKeywords'=>'IPTC Keywords', //cpg1.3.0
        'iptcCategory'=>'IPTC Category', //cpg1.3.0
        'iptcSubCategories'=>'IPTC Sub Categories', //cpg1.3.0

);

$lang_display_comments = array(
    'OK' => 'OK',
    'edit_title' => 'Modific�t koment�ru',
    'confirm_delete' => 'Tie��m DZ�ST �o koment�ru?',
    'add_your_comment' => 'Pievienot koment�ru',
    'name'=>'V�rds', //new in cpg1.2.0
    'comment'=>'Koment�rs', //new in cpg1.2.0
    'your_name' => 'Anon�ms', //new in cpg1.2.0
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Uzklik��ini uz att�la, lai aizv�rtu �o logu', //new in cpg1.2.0
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
    'title' => 'Nos�t�t e-karti�u',
    'invalid_email' => '<b>UZMAN�BU</b> : k��daina adrese!',
    'ecard_title' => 'Sveiciens no %s',
    'view_ecard' => '�o sveicienu var redz�t ar� sekojo�a adres�',
    'view_more_pics' => 'Citi for�i att�li...',
    'send_success' => 'E-karti�a nos�t�ta',
    'send_failed' => 'Atvaino, serveris nevar nos�t�t tavu E-karti�u...',
    'from' => 'No k�',
    'your_name' => 'V�rds',
    'your_email' => 'E-pasta adrese',
    'to' => 'Kam',
    'rcpt_name' => 'Sa�em�ja v�rds',
    'rcpt_email' => 'Sa��m�ja e-pasta adrese',
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
    'keywords' => 'Atsl�gas v�rdi',
    'pic_info_str' => '%sx%s - %sKB - %s skat�jumi - %s balsis',
    'approve' => 'Apstiprin�t att�la pievieno�anu',
    'postpone_app' => 'Noraid�t att�la pievieno�anu',
    'del_pic' => 'Dz�st att�lu',
    'reset_view_count' => 'Nodz�st skat�jumi skait�t�ju',
    'reset_votes' => 'Nodz�st balsojumu skaitu',
    'del_comm' => 'Dz�st koment�rus',
    'upl_approval' => 'Uzlik�anas apstiprin�jums',
    'edit_pics' => 'Modific�t att�lus',
    'see_next' => 'Iepriek��jie att�li',
    'see_prev' => 'N�kamie att�li',
    'n_pic' => '%s att�li',
    'n_of_pic_to_disp' => 'Cik att�lus atspogu�ot',
    'apply' => 'Apstiprin�t izmai�as'
);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => 'Frequently Asked Questions', //cpg1.3.0
  'toc' => 'Table of contents', //cpg1.3.0
  'question' => 'Question: ', //cpg1.3.0
  'answer' => 'Answer: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  'General FAQ', //cpg1.3.0
  array('Why do I need to register?', 'Registration may or may not be required by the administrator. Registration gives a member additional features such as uploading, having a favorite list, rating pictures and posting comments etc.', 'allow_user_registration', '0'), //cpg1.3.0
  array('How do I register?', 'Go to &quot;Register&quot; and fill out the required fields (and the optional ones if you want to).<br />If the Administrator has Email Activation enabled ,then after submitting your information you should recieve an email message at the address that you have submitted while registering, giving you instructions on how to activate your membership. Your membership must be activated in order for you to login.', 'allow_user_registration', '1'), //cpg1.3.0
  array('How Do I login?', 'Go to &quot;Login&quot;, submit your username and password and check &quot;Remember Me&quot; so you will be logged in on the site if you should leave it.<br /><b>IMPORTANT:Cookies must be enabled and the cookie from this site must not be deleted in order to use &quot;Remember Me&quot;.</b>', 'offline', 0), //cpg1.3.0
  array('Why can I not login?', 'Did you register and click the link that was sent to you via email?. The link will activate your account. For other login problems contact the site administrator.', 'offline', 0), //cpg1.3.0
  array('What if I forgot my password?', 'If this site has a &quot;Forgot password&quot; link then use it. Other than that contact the site administrator for a new password.', 'offline', 0), //cpg1.3.0
  //array('What if I changed my email address?', 'Just simply login and change your email address through &quot;Profile&quot;', 'offline', 0), //cpg1.3.0
  array('How do I save a picture to &quot;My Favorites&quot;?', 'Click on a picture and click on the &quot;picture info&quot; link (<img src="images/info.gif" width="16" height="16" border="0" alt="Picture information" />); scroll down to the picture information set and click &quot;Add to fav&quot;.<br />The administrator may have the &quot;picture information&quot; on by default.<br />IMPORTANT:Cookies must be enabled and the cookie from this site must not be deleted.', 'offline', 0), //cpg1.3.0
  array('How do I rate a file?', 'Click on a thumbnail and go to the bottom and choose a rating.', 'offline', 0), //cpg1.3.0
  array('How do I post a comment for a picture?', 'Click on a thumbnail and go to the bottom and post a comment.', 'offline', 0), //cpg1.3.0
array('How do I upload a file?', 'Go to &quot;Upload&quot;and select the album that you want to upload to, click &quot;Browse&quot; and find the file to upload and click &quot;open&quot; (add a title and description if you want to) and click &quot;Submit&quot;', 'allow_private_albums', 0), //cpg1.3.0
  array('Where do I upload a picture to?', 'You will be able to upload a file to one of your albums in &quot;My Gallery&quot;. The Administrator may also allow you to upload a file to one or more of the albums in the Main Gallery.', 'allow_private_albums', 0), //cpg1.3.0
  array('What type and size of a file can I upload?', 'The size and type (jpg, png, etc.) is up to the administrator.', 'offline', 0), //cpg1.3.0
  array('What is &quot;My Gallery&quot;?', '&quot;My Gallery&quot; is a personal gallery that the user can upload to and manage.', 'allow_private_albums', 0), //cpg1.3.0
  array('How do I create, rename or delete an album in &quot;My Gallery&quot;?', 'You should already be in &quot;Admin-Mode&quot;<br />Go to &quot;Create/Order My Albums&quot;and click &quot;New&quot;. Change &quot;New Album&quot; to your desired name.<br />You can also rename any of the albums in your gallery.<br />Click &quot;Apply Modifications&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('How can I modify and restrict users from viewing my albums?', 'You should already be in &quot;Admin Mode&quot;<br />Go to &quot;Modify My Albums. On the &quot;Update Album&quot; bar, select the album that you want to modify.<br />Here, you can change the name, description, thumbnail picture, restrict viewing and comment/rating permissions.<br />Click &quot;Update Album&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('How can I view other users\' galleries?', 'Go to &quot;Album List&quot; and select &quot;User Galleries&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('What are cookies?', 'Cookies are a plain text piece of data that is sent from a website and is put on to your computer.<br />Cookies usually allow a user to leave and return to the site without having to login again and other various chores.', 'offline', 0), //cpg1.3.0
  array('Where can I get this program for my site?', 'Coppermine is a free Multimedia Gallery, released under GNU GPL. It is full of features and has been ported to various platforms. Visit the <a href="http://coppermine.sf.net/">Coppermine Home Page</a> to find out more or download it.', 'offline', 0), //cpg1.3.0

  'Navigating the Site', //cpg1.3.0
  array('What\'s &quot;Album List&quot;?', 'This will show you the entire category you are currently in, with a link to each album. If you are not in a category, it will show you the entire gallery with a link to each category. Thumbnails may be a link to the category.', 'offline', 0), //cpg1.3.0
  array('What\'s &quot;My Gallery&quot;?', 'This feature lets a user create their own gallery and add,delete or modify albums as well as upload to them.', 'allow_private_albums', 0), //cpg1.3.0
  array('What\'s the difference between &quot;Admin Mode&quot; and &quot;User Mode&quot;?', 'This feature, when in admin-mode, allows a user to modify their gallery (as well as others if allowed by the administrator).', 'allow_private_albums', 0), //cpg1.3.0
  array('What\'s &quot;Upload Picture&quot;?', 'This feature allows a user to upload a file (size and type is set by the site administrator) to a gallery selected by either you or the administrator.', 'allow_private_albums', 0), //cpg1.3.0
  array('What\'s &quot;Last Uploads&quot;?', 'This feature shows the last uploads to the site.', 'offline', 0), //cpg1.3.0
  array('What\'s &quot;Last Comments&quot;?', 'This feature shows the last comments along with the files posted by users.', 'offline', 0), //cpg1.3.0
  array('What\'s &quot;Most Viewed&quot;?', 'This feature shows the most viewed files by all users (whether logged in or not).', 'offline', 0), //cpg1.3.0
  array('What\'s &quot;Top Rated&quot;?', 'This feature shows the top rated files rated by the users, showing the average rating (e.g: five users each gave a <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />: the file would have an average rating of <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> ;Five users rated the file from 1 to 5 (1,2,3,4,5) would result in an average <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> .)<br />The ratings go from <img src="images/rating5.gif" width="65" height="14" border="0" alt="best" /> (best) to <img src="images/rating0.gif" width="65" height="14" border="0" alt="worst" /> (worst).', 'offline', 0), //cpg1.3.0
  array('What\'s &quot;My Favorites&quot;?', 'This feature will let a user store a favorite file in the cookie that was sent to your computer.', 'offline', 0), //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => 'Paroles atg�din�t�js', //cpg1.3.0
  'err_already_logged_in' => 'Tu jau esi piesl�dzies!', //cpg1.3.0
  'enter_username_email' => 'Tavs dal�bnieka v�rds vai epasta adrese', //cpg1.3.0
  'submit' => 'Aiziet!', //cpg1.3.0
  'failed_sending_email' => 'Neko neav iesp�jams nos�t�t!', //cpg1.3.0
  'email_sent' => 'V�stule ar dal�bnieka inform�ciju tika nos�t�ta uz %s', //cpg1.3.0
  'err_unk_user' => 'Nav t�da dal�bnieka!', //cpg1.3.0
  'passwd_reminder_subject' => '%s - Paroles atg�din�t�js', //cpg1.3.0
  'passwd_reminder_body' => 'Sa��m�m piepras�jumu par dal�bnieku:
Username: %s
Password: %s
Spied %s un piesl�dzies.', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
    'group_name' => 'Grupa',
    'disk_quota' => 'Kvota (atmi�as ierobe�ojumi)',
    'can_rate' => 'Dr�kst v�rt�t att�lus',
    'can_send_ecards' => 'Dr�kst s�t�t e-karti�as',
    'can_post_com' => 'Dr�kst koment�t',
    'can_upload' => 'Dr�kst likt att�lus',
    'can_have_gallery' => 'Dr�kst b�t person�ga galerija',
    'apply' => 'Apstiprin�t izmai�as',
    'create_new_group' => 'Izveidot jaunu grupu',
    'del_groups' => 'Dz�st grupu(-as)',
    'confirm_del' => 'Uzman�bu! Dz��ot grupu, visi tai pieder�gie lietot�ji tiks p�rvietoti uz re�istr�to lietot�ju grupu!\n\nTurpin�t?',
    'title' => 'Administr�t lietot�ju grupas',
    'approval_1' => 'Publisks uzlik�anas apstiprin�jums (1)',
    'approval_2' => 'Priv�ts uzlik�anas apstiprin�jums (2)',
        'upload_form_config' => 'Pievieno�anas formas redi���ana', //cpg1.3.0
        'upload_form_config_values' => array( 'Tikai pa vienam failam', 'Multiple file uploads only', 'URI uploads only', 'ZIP upload only', 'File-URI', 'File-ZIP', 'URI-ZIP', 'File-URI-ZIP'), //cpg1.3.0
        'custom_user_upload'=>'Vai dal�bniekam ir at�auts main�t redi���anas formu?', //cpg1.3.0
        'num_file_upload'=>'Cik failu pievieno�anas lauci�us r�d�t?', //cpg1.3.0
        'num_URI_upload'=>'Cik URI lauci�us r�d�t?', //cpg1.3.0
    'note1' => '<b>(1)</b> Att�lu uzlik�anai publisk� alb�m� ir nepiecie�ama administratora at�auja',
    'note2' => '<b>(2)</b> Att�lu pievieno�anai album�, kas pieder �im lietot�jam, nepiecie�ama administratora at�auja',
    'notes' => 'Piez�mes'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
    'welcome' => 'Laipni l�dzam!'
);

$lang_album_admin_menu = array(
    'confirm_delete' => 'Tie��m DZ�ST �o albumu? \\nVisi att�li un koment�ri taj� tiks izdz�sti.',
    'delete' => 'IZDZ�ST',
    'modify' => 'UZST�D�JUMI',
    'edit_pics' => 'MODIFIC�T ATT�LUS',
);

$lang_list_categories = array(
    'home' => 'Galven� lapa',
    'stat1' => 'att�li: <b>[pictures]</b> | albumi: <b>[albums]</b> | sada�as: <b>[cat]</b> | koment�ri: <b>[comments]</b> | <b>skat�ts [views]</b> reizes',
    'stat2' => 'att�li: <b>[pictures]</b> | albumi: <b>[albums]</b> | skat�ti <b>[views]</b> reizes',
    'xx_s_gallery' => 'Autors %s',
    'stat3' => '<b>[pictures]</b> att�li | <b>[albums]</b> albumi | <b>[comments]</b> koment�ri | skat�ti <b>[views]</b> reizes'
);

$lang_list_users = array(
    'user_list' => 'Lietot�ju saraksts',
    'no_user_gal' => 'Nav lietot�ju galerijas',
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
    'enter_login_pswd' => 'Piesl�dzies ar savu lietot�ja v�rdu un paroli',
    'username' => 'V�rds',
    'password' => 'Parole',
    'remember_me' => 'Atcer�ties mani ar� turpm�k',
    'welcome' => 'Sveicin�ts, %s ...',
    'err_login' => '*** V�rds vai/un parole nepareizi. M��in�si v�lreiz? ***',
    'err_already_logged_in' => 'Tu jau esi sist�m�!',
        'forgot_password_link' => 'Aizmirsu paroli!', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
    'logout' => 'Iziet',
    'bye' => 'Visu labu,  %s ...',
    'err_not_loged_in' => 'J�piesl�dzas sist�mai!',
);

// ------------------------------------------------------------------------- //
// File phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP info', //cpg1.3.0
  'explanation' => 'This is the output generated by the PHP-function <a href="http://www.php.net/phpinfo">phpinfo()</a>, displayed within Copermine (trimming the output at the right corner).', //cpg1.3.0
  'no_link' => 'Having others see your phpinfo can be a security risk, that\'s why this page is only visible when you\'re logged in as admin. You can not post a link to this page for others, they will be denied access.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
    'upd_alb_n' => 'Modific�t albumu %s',
    'general_settings' => 'Galvenie uzst�d�jumi',
    'alb_title' => 'Albuma virsraksts',
    'alb_cat' => 'Sada�a',
    'alb_desc' => 'Albuma apraksts',
    'alb_thumb' => 'Albuma mazais att�ls',
    'alb_perm' => 'Albuma lietot�ju ties�bas',
    'can_view' => 'Albumu var skat�ties',
    'can_upload' => 'Apmekl�t�jie dr�kst pievienot att�lus',
    'can_post_comments' => 'Apmekl�t�ji dr�kst koment�t',
    'can_rate' => 'Apmekl�t�ji dr�kst v�rt�t att�lus',
    'user_gal' => 'Lietot�ja galerija',
    'no_cat' => '* Kategorijas nav *',
    'alb_empty' => 'Albums ir tuk�s',
    'last_uploaded' => 'P�dejoreiz uzlikts att�ls',
    'public_alb' => 'Ikviens (publiskais albums)',
    'me_only' => 'Tikai es',
    'owner_only' => 'Tikai albuma �pa�nieks (%s)',
    'groupp_only' => 'Tikai \'%s\' grup� eso�ie',
    'err_no_alb_to_modify' => 'Tev nav ties�bu modific�t albumus.',
    'update' => 'Saglab�t izmai�as'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
    'already_rated' => 'Atvaino, bet tu jau esi iesniedzis savu v�rt�jumu',
    'rate_ok' => 'V�rt�jums pie�emts',
        'forbidden' => 'V�rt�si pats savus att�lus?', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Ar �o Tu ap�emies neievietot citus aizskaro�us, piedauz�gus, vulg�rus,
apmelojo�us, pret�gus, draudo�us, seksu�li orient�tus, vai jebk�dus citus
materi�lus, kas p�rk�pj jebk�dus likumus. Likumu nezin��ana neatbr�vo
no atbild�bas!!! Tu piekr�ti, ka ��s lapas webmasters, administrators un
moderators ir ties�gi izdz�st vai main�t saturu jebkur� laik�, kad vien
v�l�s. K� lietot�js Tu piekr�ti, ka visa inform�cija ko Tu ievad�si
tiks saglab�ta datub�z�.<br />
<br />
�� lapa izmanto <em>cookies</em> tehnolo�iju, lai saglab�tu inform�ciju tav� dator�.
<em>Cookies</em> vien�gi uzlabo lapas par�d��anas kvalit�ti. E-pasta adrese
tiek izmantota vien�gi Tavas re�istr�cijas apstiprin��anai,
lai nos�t�tu paroli.<br />
<br />
Izv�loties zem�k <bold>Es piekr�tu</bold> Tu piekr�ti visam iepriek� rakst�tajam.
EOT;

$lang_register_php = array(
    'page_title' => 'Lietot�ja re�istr�cija',
    'term_cond' => 'Vieno�an�s nosac�jumi',
    'i_agree' => 'Es piekr�tu',
    'submit' => 'Apstiprin�t re�istr�ciju',
    'err_user_exists' => '�is lietot�ja v�rds jau ir re�istr�ts, izv�lies citu',
    'err_password_mismatch' => 'Paroles nesakr�t, raksti v�lreiz',
    'err_uname_short' => 'Lietot�ja v�rda minim�lais simbolu skaits ir 2',
    'err_password_short' => 'Parol� j�b�t ne maz�k k� 2 simboliem',
    'err_uname_pass_diff' => 'Lietot�ja v�rds un parole nedr�kst b�t vien�di',
    'err_invalid_email' => 'E-pasta adres ir nepareiza',
    'err_duplicate_email' => '��da email adrese jau ir datu b�z�',
    'enter_info' => 'Re�istr�cijas inform�cija',
    'required_info' => 'Nepiecie�am� inform�cija',
    'optional_info' => 'Neoblig�t� inform�cija',
    'username' => 'Lietot�ja v�rds',
    'password' => 'Parole',
    'password_again' => 'V�lreiz parole',
    'email' => 'E-pasts',
    'location' => 'Atra�an�s vieta',
    'interests' => 'Intereses',
    'website' => 'M�jas lapa',
    'occupation' => 'Nodarbo�an�s',
    'error' => 'K��DA',
    'confirm_email_subject' => '%s - Re�istr�cijas apstiprin�jums',
    'information' => 'Inform�cija',
    'failed_sending_email' => 'Nevar tikt nos�t�ta re�istr�cijas apstiprin�juma v�stule!',
    'thank_you' => 'Paldies par re�istr��anos.<br /><br />V�stule ar s�k�ku inform�ciju, k� pabeigt re�istr��an�s procesu, tika nos�t�ta uz iepriek� min�to adresi.',
    'acct_created' => 'Konts izveidots un tu vari piesl�gties ar savu lietot�ja v�rdu un paroli',
    'acct_active' => 'Konts ir akt�vs un tu tagad vari piesl�gties sist�mai',
    'acct_already_act' => 'Konts jau ir akt�vs!',
    'acct_act_failed' => '�is konts nevar tikt aktiviz�ts!',
    'err_unk_user' => 'Izv�l�tais lietot�js neeksist�!',
    'x_s_profile' => '%s : profails',
    'group' => 'Grupa',
    'reg_date' => 'Pievienojies',
    'disk_usage' => 'Diska izmanto�ana',
    'change_pass' => 'Nomain�t paroli',
    'current_pass' => 'Pa�reiz�j� parole',
    'new_pass' => 'Jauna parole',
    'new_pass_again' => 'V�lreiz jaun� parole',
    'err_curr_pass' => 'Pa�reiz�j� parole nepareiza',
    'apply_modif' => 'Apstiprin�t izmai�as',
    'change_pass' => 'Nomain�t paroli',
    'update_success' => 'Profails izmain�ts',
    'pass_chg_success' => 'Parole nomain�ta',
    'pass_chg_error' => 'Parole netika nomain�ta',
        'notify_admin_email_subject' => '%s - re�istr�cijas pazi�ojums', //cpg1.3.0
        'notify_admin_email_body' => 'Jauns dal�bnieks "%s" piere�istr�jies', //cpg1.3.0

);

$lang_register_confirm_email = <<<EOT
Paldies par re�istr��anos {SITE_NAME}

Lietot�ja v�rds : "{USER_NAME}"
Lietot�ja parole : "{PASSWORD}"

Lai aktiviz�tu savu kontu, nepiecie�ams iel�d�t zem�k redzamo lapu.

{ACT_LINK}

Lai veicas,

{SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
    'title' => 'Apskat�ties koment�rus',
    'no_comment' => 'Koment�ru nav',
    'n_comm_del' => '%s koment�ri izdz�sti',
    'n_comm_disp' => 'Cik koment�rus atspogu�ot',
    'see_prev' => 'Iepriek��jie',
    'see_next' => 'N�kamie',
    'del_comm' => 'Dz�st izv�l�tos koment�rus',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
    0 => 'Mekl�t att�lu kolekcij�',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
    'page_title' => 'Mekl�t jaunus att�lus',
    'select_dir' => 'Izv�l�ties direktoriju',
    'select_dir_msg' => '�� funkcija �auj pievienot daudzus att�lus vienlaikus, ja tie iepriek� uzlikti ar FTP.<br /><br />Izv�lies direktoriju, kur tika uzlikti att�li',
    'no_pic_to_add' => 'Nav att�lu, ko var�tu pievienot',
    'need_one_album' => 'Lai izmantotu �o funkciju, nepiecie�ams vismaz viens albums',
    'warning' => 'Uzman�bu',
    'change_perm' => 'nav pieeja direktorijai, tai j�izmaina ties�bas (chmod) no 755 uz 777, lai var�tu pievienot att�lus!',
    'target_album' => '<b>Ievietot att�lus &quot;</b>%s<b>&quot; </b>%s',
    'folder' => 'Direktorija',
    'image' => 'Att�ls',
    'album' => 'Albums',
    'result' => 'Rezult�ti',
    'dir_ro' => 'Nav rakst��anas ties�bu. ',
    'dir_cant_read' => 'Nav las��anas ties�bu. ',
    'insert' => 'Jaunu att�lu pievieno�ana',
    'list_new_pic' => 'Jauno att�lu saraksts',
    'insert_selected' => 'Pievienot izv�l�tos att�lus',
    'no_pic_found' => 'Jauni att�li netika atrasti',
    'be_patient' => 'L�dzu esiet paciet�gi, kam�r tiek pievienoti jaunie att�li',
        'no_album' => 'Alb�ms nav izv�l�ts',  //cpg1.3.0
    'notes' =>  '<ul>'.
                '<li><b>OK</b> : att�ls veiksm�gi pievienots'.
                '<li><b>DP</b> : noz�m�, ka t�ds att�ls jau ir datu b�z�'.
                '<li><b>PB</b> : att�lu nevar pievienot, j�p�rbauda pieejas ties�bas'.
                                '<li><b>NA</b> : noz�m�, ka neesi izv�l�jies alb�mu, kur ievietot �os foto. Spied \'<a href="javascript:history.back(1)">atpaka� pogu</a>\' un izv�lies. Ja nav neviena alb�ma, <a href="albmgr.php">vispirms izveidot</a></li>'.
                '<li>Ja OK, DP, PB \'z�mes\' nepar�d�s, j�klik��ina uz att�la, kas par�d�s, lai ieg�tu detaliz�t�ku k��das aprakstu'.
                '<li>Ja p�rl�k� par�d�s pazi�ojums par taimautu, lapa ir j�p�rl�d�'.
                '</ul>',
        'select_album' => 'izv�l�ties alb�mu', //cpg1.3.0
        'check_all' => 'ie�eks�t visu', //cpg1.3.0
        'uncheck_all' => 'at�eks�t visu', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
                'title' => 'Aizliegt pieeju', //new in cpg1.2.0
                'user_name' => 'Lietot�js', //new in cpg1.2.0
                'ip_address' => 'IP adrese', //new in cpg1.2.0
                'expiry' => 'Darbojas l�dz (tuk�s noz�m� - bezgal�gi)', //new in cpg1.2.0
                'edit_ban' => 'Saglab�t', //new in cpg1.2.0
                'delete_ban' => 'Dz�st', //new in cpg1.2.0
                'add_new' => 'Jauns ieraksts', //new in cpg1.2.0
                'add_ban' => 'Pievienot', //new in cpg1.2.0
                                'error_user' => 'Nevar atrast t�du dal�bnieku', //cpg1.3.0
                                'error_specify' => 'Nepiecie�ams dal�bnieka v�rds vai IP adrese', //cpg1.3.0
                                'error_ban_id' => 'Nepareizs aizlieguma ID!', //cpg1.3.0
                                'error_admin_ban' => 'Sevi nevar aizliegt!', //cpg1.3.0
                                'error_server_ban' => 'Aizliegt piek�uvi no savas adreses? Nepr�ts...', //cpg1.3.0
                                'error_ip_forbidden' => 'Nevar aizliegt piek�uvi ��dai IP adresei! (not routable)', //cpg1.3.0
                                'lookup_ip' => 'Lookup an IP address', //cpg1.3.0
                                'submit' => 'aiziet!', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => 'Pievienot', //cpg1.3.0
  'custom_title' => 'Modific�ta pievieno�anas forma', //cpg1.3.0
  'cust_instr_1' => 'Izv�lies, cik lauci�us atspogu�ot (ierobe�ots lielums).', //cpg1.3.0
  'cust_instr_2' => 'Pievieno�anas lauci�u skaits', //cpg1.3.0
  'cust_instr_3' => 'Max pievieno�anas lauci�u skaits: %s', //cpg1.3.0
  'cust_instr_4' => 'URI/URL lauci�u skaits: %s', //cpg1.3.0
  'cust_instr_5' => 'URI/URL lauci�u skaits:', //cpg1.3.0
  'cust_instr_6' => 'Pievieno�anas lauci�u skaits:', //cpg1.3.0
  'cust_instr_7' => 'Izv�lies katra tipa lauci�u skaitu. p�c tam spied \'Turpin�t\'. ', //cpg1.3.0
  'reg_instr_1' => 'K��da opcij�s.', //cpg1.3.0
  'reg_instr_2' => '<small style="color:white;">Iesp�jama vair�ku failu vienlaic�ga pievieno�ana. Failiem nevajadz�tu b�t liel�kiem par %s KB (katram). Pievienojot ZIP failus, tie paliek t�d� pa�� form�t� (netiek atv�rti).</small>', //cpg1.3.0
  'reg_instr_3' => 'Ja v�lies, lai ZIP form�ta faili tiktu atkompres�ti autom�tiski, pievieno tos sada�� \'Decompressive ZIP Upload\'.', //cpg1.3.0
  'reg_instr_4' => '<small style="color:white;">Izmantojot URI/URL, izmanto pilnu ce�u uz failu: <code>http://www.mysite.com/images/example.jpg</code></small>', //cpg1.3.0
  'reg_instr_5' => '<small style="color:white;">Ja viss aizpild�t un p�rbaud�ts, spied \'Turpin�t\'.</small><br/>', //cpg1.3.0
  'reg_instr_6' => 'Decompressive ZIP Uploads:', //cpg1.3.0
  'reg_instr_7' => 'Faili:', //cpg1.3.0
  'reg_instr_8' => 'URI/URL:', //cpg1.3.0
  'error_report' => 'K��das', //cpg1.3.0
  'error_instr' => 'Bija sekojo�as k��das:', //cpg1.3.0
  'file_name_url' => 'Fails nosaukums/URL', //cpg1.3.0
  'error_message' => 'K��das pazi�ojums', //cpg1.3.0
  'no_post' => 'Fails netika pievienots ar POST metodi.', //cpg1.3.0
  'forb_ext' => 'Aizliegts faila form�ts.', //cpg1.3.0
  'exc_php_ini' => 'P�rsniegts php.ini nor�d�tais pievienojamo failu lielums.', //cpg1.3.0
  'exc_file_size' => 'P�rsniegts CPG uzst�d�tais failu lielums.', //cpg1.3.0
  'partial_upload' => 'Only a partial upload.', //cpg1.3.0
  'no_upload' => 'Pievieno�ana nenotika.', //cpg1.3.0
  'unknown_code' => 'Nezin�ma PHP k��da.', //cpg1.3.0
  'no_temp_name' => 'No upload - No temp name.', //cpg1.3.0
  'no_file_size' => 'Contains no data/Corrupted', //cpg1.3.0
  'impossible' => 'Impossible to move.', //cpg1.3.0
  'not_image' => 'Tas nav att�ls/att�ls ir ���dains', //cpg1.3.0
  'not_GD' => 'Not a GD extension.', //cpg1.3.0
  'pixel_allowance' => 'P�r�k daudz pikse�i.', //cpg1.3.0
  'incorrect_prefix' => 'Nepareiza form�ta URI/URL', //cpg1.3.0
  'could_not_open_URI' => 'Nav iesp�jams atv�rt URI.', //cpg1.3.0
  'unsafe_URI' => 'Safety not verifiable.', //cpg1.3.0
  'meta_data_failure' => 'Meta data k��da', //cpg1.3.0
  'http_401' => '401 Unauthorized', //cpg1.3.0
  'http_402' => '402 Payment Required', //cpg1.3.0
  'http_403' => '403 Forbidden', //cpg1.3.0
  'http_404' => '404 Not Found', //cpg1.3.0
  'http_500' => '500 Internal Server Error', //cpg1.3.0
  'http_503' => '503 Service Unavailable', //cpg1.3.0
  'MIME_extraction_failure' => 'MIME could not be determined.', //cpg1.3.0
  'MIME_type_unknown' => 'Unknown MIME type', //cpg1.3.0
  'cant_create_write' => 'Cannot create write file.', //cpg1.3.0
  'not_writable' => 'Cannot write to write file.', //cpg1.3.0
  'cant_read_URI' => 'Cannot read URI/URL', //cpg1.3.0
  'cant_open_write_file' => 'Cannot open URI write file.', //cpg1.3.0
  'cant_write_write_file' => 'Cannot write to URI write file.', //cpg1.3.0
  'cant_unzip' => 'Nav iesp�jams atkompres�t.', //cpg1.3.0
  'unknown' => 'Nedefin�ta k�uda', //cpg1.3.0
  'succ' => 'Veiksm�gi pievienots', //cpg1.3.0
  'success' => '<small style="color:white;">Fails nr. %s veiksm�gi pievienots</small>', //cpg1.3.0
  'add' => '<small style="color:white;">Spied uz \'Turpin�t\', lai alb�mam pievienotu att�lus.<br/></small>', //cpg1.3.0
  'failure' => 'Pievieno�anas k��da', //cpg1.3.0
  'f_info' => 'Inform�cija par datiem', //cpg1.3.0
  'no_place' => 'Nav iesp�jams nomain�t jau eso�u failu.', //cpg1.3.0
  'yes_place' => 'Iepriek��jais fails veiksm�gi pievienots.', //cpg1.3.0
  'max_fsize' => 'At�autais viena faila lielums %s KB',
  'album' => 'Alb�ms',
  'picture' => 'Fails', //cpg1.3.0
  'pic_title' => 'Faila nosaukums (virsraksts)', //cpg1.3.0
  'description' => 'Fila apraksts', //cpg1.3.0
  'keywords' => 'Atsl�gas v�rdi (vair�kus atdali ar atstarp�m)',
  'err_no_alb_uploadables' => 'Atvaino, bet nav neviena alb�ma, kur tu var�tu likt att�lus', //cpg1.3.0
  'place_instr_1' => 'Ievieto katru att�lu vajadz�gaj� alb�m�, ja vajadz�gs, katram pievieno s�k�ku inform�ciju.', //cpg1.3.0
  'place_instr_2' => 'Spied uz \'Turpin�t\' un nor�di, kur ievietot p�r�jos failus.', //cpg1.3.0
  'process_complete' => 'Visi dati veiksm�gi pievienoti.', //cpg1.3.0
);

/*
if (defined('UPLOAD_PHP')) $lang_upload_php = array(
    'title' => 'Uzlikt att�lu',
    'max_fsize' => 'Max pievienojam� faila lielums %s KB',
    'album' => 'Albums',
    'picture' => 'Att�ls',
    'pic_title' => 'Att�la virsraksts',
    'description' => 'Att�la apraksts',
    'keywords' => 'Atsl�gas v�rdi (atdal�t ar atstarp�m)',
    'err_no_alb_uploadables' => 'Atvaino, nav neviena albuma, kur� tu var�tu ievietot savus att�lus',
);
*/

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
    'title' => 'Administr�t lietot�jus',
    'name_a' => 'V�rds augo�i',
    'name_d' => 'V�rds dilsto�i',
    'group_a' => 'Grupa augo�i',
    'group_d' => 'Grupa dilsto�i',
    'reg_a' => 'Reg datums augo�i',
    'reg_d' => 'Reg datums dilsto�i',
    'pic_a' => 'Att�lu skaits augo�i',
    'pic_d' => 'Att�lu skaits dilsto�i',
    'disku_a' => 'Diska atmi�a augo�i',
    'disku_d' => 'Diska atmi�a dilsto�i',
        'lv_a' => 'Ped�jais apmekl�jums augo�i', //cpg1.3.0
        'lv_d' => 'P�d�jais apmekl�jums dilsto�i', //cpg1.3.0
    'sort_by' => 'K�rtot',
    'err_no_users' => 'Lietot�ju tabul� nav datu!',
    'err_edit_self' => 'Nemaini te savu profailu, tam izmanto \'Mans profails\'',
    'edit' => 'MODIFIC�T',
    'delete' => 'DZ�ST',
    'name' => 'Lietot�js',
    'group' => 'Grupa',
    'inactive' => 'Neakt�vs',
    'operations' => 'Darb�bas',
    'pictures' => 'Att�li',
    'disk_space' => 'Izmantot� atmi�a / Ierobe�ojums',
    'registered_on' => 'Re�istr�ts',
        'last_visit' => 'P�d�jais apmekl�jums', //cpg1.3.0
    'u_user_on_p_pages' => '%d lietot�ji %d lap�(s)',
    'confirm_del' => 'Tie��m DZ�ST �o lietot�ju? \\nVisi vi�a att�li un koment�ri ar� tiks izdz�sti',
    'mail' => 'MAIL',
    'err_unknown_user' => 'Izv�l�tais lietot�js neeksist�!',
    'modify_user' => 'Main�t datus',
    'notes' => 'Piez�mes',
    'note_list' => '<li>Ja nev�lies main�t paroli, atst�j paroles lauku tuk�u',
    'password' => 'Parole',
    'user_active' => 'Lietot�js akt�vs',
    'user_group' => 'Grupa',
    'user_email' => 'Emails',
    'user_web_site' => 'M�jas lapa',
    'create_new_user' => 'Izveidot',
    'user_location' => 'Atra�an�s',
    'user_interests' => 'Intereses',
    'user_occupation' => 'Nodarbo�an�s',
        'latest_upload' => 'P�d�jie pievienotie faili', //cpg1.3.0
        'never' => 'nekad', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Att�lu izm�ri', //new in cpg1.2.0
        'what_it_does' => 'Funkcijas', //new in cpg1.2.0
        'what_update_titles' => 'Virsraksti tiek �emti no failu nosaukumiem', //new in cpg1.2.0
        'what_delete_title' => 'Dz�st virsrakstus', //new in cpg1.2.0
        'what_rebuild' => 'P�rveidot att�lus', //new in cpg1.2.0
        'what_delete_originals' => 'Dz�st ori�in�los att�lus un nomain�t tos ar samazin�tajiem/palielin�tajiem', //new in cpg1.2.0
        'file' => 'Fails', //new in cpg1.2.0
        'title_set_to' => 'virsraksts', //new in cpg1.2.0
        'submit_form' => 'Apstiprin�t', //new in cpg1.2.0
        'updated_succesfully' => 'Veiksm�gi izman�ts', //new in cpg1.2.0
        'error_create' => 'K��da', //new in cpg1.2.0
        'continue' => 'Turpin�t ar citiem att�liem', //new in cpg1.2.0
        'main_success' => 'Fails %s tiek izmantots k� galvenais att�ls', //new in cpg1.2.0
        'error_rename' => 'K��da %s p�rsaucot par %s', //new in cpg1.2.0
        'error_not_found' => 'Fails %s nav atrasts', //new in cpg1.2.0
        'back' => 'Atgriezties', //new in cpg1.2.0
        'thumbs_wait' => 'Notiek mazo un norm�lo att�lu modific��ana, l�dzu uzgaidi...', //new in cpg1.2.0
        'thumbs_continue_wait' => 'Turpinam modific�t mazos un norm�los att�lus...', //new in cpg1.2.0
        'titles_wait' => 'Norit spar�ga virsrakstu modific��ana, uzgaidi...', //new in cpg1.2.0
        'delete_wait' => 'Dz��u virsrakstus, l�dzu uzgaidi...', //new in cpg1.2.0
        'replace_wait' => 'Dz��u ori�in�lus, nomainot tos ar modific�tajiem att�liem, l�dzu uzgaidi...', //new in cpg1.2.0
        'instruction' => 'Ieteikumi', //new in cpg1.2.0
        'instruction_action' => 'Izv�lies darb�bu', //new in cpg1.2.0
        'instruction_parameter' => 'Uzliec parametrus', //new in cpg1.2.0
        'instruction_album' => 'Izv�lies albumu', //new in cpg1.2.0
        'instruction_press' => 'Nospied %s', //new in cpg1.2.0
        'update' => 'Modific� mazos un/vai norm�los att�lus', //new in cpg1.2.0
        'update_what' => 'Kas j�modific�', //new in cpg1.2.0
        'update_thumb' => 'Tikai mazos att�lus', //new in cpg1.2.0
        'update_pic' => 'Tikai modific�tos att�lus', //new in cpg1.2.0
        'update_both' => 'Gan mazie, gan norm�lie att�li', //new in cpg1.2.0
        'update_number' => 'Cik att�lus var modific�t ar vienu klik��i', //new in cpg1.2.0
        'update_option' => '(�o parametru samazini, ja ir probl�mas ar modific��anu)', //new in cpg1.2.0
        'filename_title' => 'Faila nosaukums &rArr; Att�la virsraksts', //new in cpg1.2.0
        'filename_how' => 'K� modific�t att�lu', //new in cpg1.2.0
        'filename_remove' => 'Dz�st .jpg papla�in�jumu un _ nomain�t ar atstarpi', //new in cpg1.2.0
        'filename_euro' => 'Konvert�t 2003_11_23_13_20_20.jpg uz 23/11/2003 13:20', //new in cpg1.2.0
        'filename_us' => 'Konevert�t 2003_11_23_13_20_20.jpg uz 11/23/2003 13:20', //new in cpg1.2.0
        'filename_time' => 'Konvert�t 2003_11_23_13_20_20.jpg uz 13:20', //new in cpg1.2.0
        'delete' => 'Att�lu virsrakstu un att�lu dz��ana', //new in cpg1.2.0
        'delete_title' => 'Dz�st att�lu virsrakstus', //new in cpg1.2.0
        'delete_original' => 'Dz�st ori�in�lus', //new in cpg1.2.0
        'delete_replace' => 'Dz�st ori�in�lus aizst�jot tos ar modific�tajiem att�liem', //new in cpg1.2.0
        'select_album' => 'Izv�lies albumu', //new in cpg1.2.0
        'delete_orphans' => 'Delete orphaned comments (works on all albums)', //cpg1.3.0
        'orphan_comment' => 'orphan comments found', //cpg1.3.0
        'delete' => 'Dz�st', //cpg1.3.0
        'delete_all' => 'Dz�st visu', //cpg1.3.0
        'comment' => 'Koment�ri: ', //cpg1.3.0
        'nonexist' => 'Pievienots neeksist�jo�am dailam # ', //cpg1.3.0
        'phpinfo' => 'R�d�t phpinfo', //cpg1.3.0
        'update_db' => 'Atjaunot datu b�zi', //cpg1.3.0
        'update_db_explanation' => 'If you have replaced coppermine files, added a modification or upgraded from a previous version of coppermine, make sure to run the database update once. This will create the necessary tables and/or config  values in your coppermine database.', //cpg1.3.0

);

?>