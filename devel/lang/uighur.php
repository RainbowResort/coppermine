<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.2                                            //
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
// CVS version: $Id$
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
  'lang_name_english' => 'Uighur',
  'lang_name_native' => 'Uighur',
  'lang_country_code' => 'Uig',
  'trans_name'=> 'Abduwahit Semet.NEWRUZ',
  'trans_email' => 'abduwahit@yahoo.com or qumluq@yahoo.com.cn',
  'trans_website' => 'http://www.shehrizat.com/album',
  'trans_date' => '2004-08-30',
);

$lang_charset = 'iso-8859-9';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Yek', 'D�', 'Sey', 'Char', 'Pey', 'J�me', 'Shem');
$lang_month = array('Yanwar', ' F�wral', 'Mart', 'April', 'May', 'Iyun', 'Iyul', 'Awghust', 'S�ntebir', '�ktebir', 'Noyabir', 'D�kabir');

// Some common strings
$lang_yes = 'Hee';
$lang_no  = 'Yaq';
$lang_back = 'Qaytish';
$lang_continue = 'Dawami';
$lang_info = 'Uchur';
$lang_error = 'Xataliq';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%m/%d/%y at %H:%M'; //cpg1.3.0
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p'; //cpg1.3.0
$comment_date_fmt =  '%B %d, %Y at %I:%M %p'; //cpg1.3.0

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
  'random' => 'Random H�jjet', //cpg1.3.0
  'lastup' => 'Y�ngi Y�kler',
  'lastalb'=> 'Y�ngi �zgermiler',
  'lastcom' => 'Y�ngi S�zler',
  'topn' => 'k�p k�r�lgen',
  'toprated' => 'k�p nomurluq',
  'lasthits' => 'Y�ngi k�r�lgini',
  'search' => 'Izdesh',
  'favpics'=> 'K�ngl�mdikidek resim', //cpg1.3.0
);

$lang_errors = array(
  'access_denied' => 'Bu betning ziyaret hoqqoqingiz yoq.',
  'perm_denied' => 'Bu paaliyitingiz cheklinidu.',
  'param_missing' => 'Bu sizge bilazm param�tir.',
  'non_exist_ap' => 'Tallighan alb�m/h�jjet Yoq!', //cpg1.3.0
  'quota_exceeded' => 'Teqsim chektin ashti<br /><br />Teqsimingiz[quota]K, Ishletkiningiz[space]K, Bu h�jjet bilen teqsim chektin ashidu.', //cpg1.3.0
  'gd_file_type_err' => 'Ishletken GD ambiringiz JPEG bilen PNG la qollaydu.',
  'invalid_image' => 'Y�kingiz buzulghan yaki GD ambar bir terep qilalmaydu.',
  'resize_failed' => 'Kichiklitilme yaki �zgertilme �lip baralmidim.',
  'no_img_to_display' => 'K�r�nme H�jjet yoq',
  'non_exist_cat' => 'Tallanma T�r yoq',
  'orphan_cat' => 'Tallanma t�ri xata, T�r tallashtin �zgertiw�ling!', //cpg1.3.0
  'directory_ro' => 'M�nderije \'%s\'  xatirlenmidi, netijide h�jjetni �ch�relmeysiz.', //cpg1.3.0
  'non_exist_comment' => 'Siz tallighan S�z yoq.',
  'pic_in_invalid_album' => 'H�jjet Mewh�m alb�mda (%s)!?', //cpg1.3.0
  'banned' => 'Siz b�kitimiz cheklidi.',
  'not_with_udb' => 'Alb�m m�nber bilen birikturulgen, Bu iqtidar toxtitildi. Tengshek qollimaydu yaki m�nber bir terep qiliwatidu.',
  'offline_title' => 'Biliniye', //cpg1.3.0
  'offline_text' => 'Gallery Biliniyede - Sel turup sinang', //cpg1.3.0
  'ecards_empty' => 'Tor kartisi yoq. Tengshekte tor kartisi ijramiken!', //cpg1.3.0
  'action_failed' => 'Paaliyet tamam.  Coppermine teliwingizni orundiyalmaydu.', //cpg1.3.0
  'no_zip' => 'H�jjetni ZIP liyalmaysiz.  Alb�m Atamani bilen alaqilishing.', //cpg1.3.0
  'zip_type' => 'ZIP h�jjetni y�kleshke biijazet.', //cpg1.3.0
);

$lang_bbcode_help = 'Paydilinish kodi: <li>[b]<b>Bold</b>[/b]</li> <li>[i]<i>Italic</i>[/i]</li> <li>[url=http://yoursite.com/]Url Text[/url]</li> <li>[email]user@domain.com[/email]</li>'; //cpg1.3.0

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
  'alb_list_title' => 'Alb�m sehipisi qaytish',
  'alb_list_lnk' => 'Alb�m sehipisi',
  'my_gal_title' => 'Alb�mimgha qaytimen',
  'my_gal_lnk' => 'Alb�mim',
  'my_prof_lnk' => 'Arxipim',
  'adm_mode_title' => 'Admingha aylinish',
  'adm_mode_lnk' => 'Admin K�n�mi',
  'usr_mode_title' => 'Qollanchi k�n�mige aylinish',
  'usr_mode_lnk' => 'Qollanchi k�n�mi',
  'upload_pic_title' => 'Albomgha h�jjet y�klesh', //cpg1.3.0
  'upload_pic_lnk' => 'H�jjet y�klesh', //cpg1.3.0
  'register_title' => 'Qollanchi qoshush',
  'register_lnk' => 'Tizimlitish',
  'login_lnk' => 'Kiring',
  'logout_lnk' => 'Chiqing',
  'lastup_lnk' => 'Y�ngi Y�k',
  'lastcom_lnk' => 'Y�ngi S�z',
  'topn_lnk' => 'K�p k�r�m',
  'toprated_lnk' => 'Yoquri Nomur',
  'search_lnk' => 'Izde',
  'fav_lnk' => 'K�ngl�mdikisi',
  'memberlist_title' => 'Qollanchi tizimliki', //cpg1.3.0
  'memberlist_lnk' => 'Qollanchilar', //cpg1.3.0
  'faq_title' => 'Galleryning Daimliq soaligha jawap &quot;Coppermine&quot;', //cpg1.3.0
  'faq_lnk' => 'FAQ', //cpg1.3.0
);

$lang_gallery_admin_menu = array(
  'upl_app_lnk' => 'Bap Y�klesh',
  'config_lnk' => 'Tengshesh',
  'albums_lnk' => 'Alb�mlar',
  'categories_lnk' => 'Kat�goriyiler',
  'users_lnk' => 'Qollanchilar',
  'groups_lnk' => 'Grouplar',
  'comments_lnk' => 'Pikirler', //cpg1.3.0
  'searchnew_lnk' => 'H�jjetber', //cpg1.3.0
  'util_lnk' => 'Ataman Arxipi', //cpg1.3.0
  'ban_lnk' => 'Cheklen`genler',
  'db_ecard_lnk' => 'Atr�tkilar', //cpg1.3.0
);

$lang_user_admin_menu = array(
  'albmgr_lnk' => 'Alb�mimni/Qurush ',
  'modifyalb_lnk' => 'Alb�mimni Tehrirlesh',
  'my_prof_lnk' => 'Arxipim',
);

$lang_cat_list = array(
  'category' => 'T�rler',
  'albums' => 'Alb�mlar',
  'pictures' => 'H�jjet', //cpg1.3.0
);

$lang_album_list = array(
  'album_on_page' => '%d alb�m  %d bet(liri)',
);

$lang_thumb_view = array(
  'date' => 'DATE',
  //Sort by filename and title
  'name' => 'H�jjet nami',
  'title' => 'Tambet',
  'sort_da' => 'WAqt tertipi Y�qindin yiraqqa',
  'sort_dd' => 'WAqt tertipi yiraqtin y�qin`gha',
  'sort_na' => 'Nam Kichiktin chonggha',
  'sort_nd' => 'Nam Chongdin kichikke',
  'sort_ta' => 'T�ma Kichiktin chonggha',
  'sort_td' => 'T�ma Chongdin kichikke',
  'download_zip' => 'Zip H�jjitide y�klesh', //cpg1.3.0
  'pic_on_page' => '%d H�jjet %d Bet(liri)',
  'user_on_page' => '%d Qollanchi %d Bet(liri)', //cpg1.3.0
);

$lang_img_nav_bar = array(
  'thumb_title' => 'Kichiklitilgen resim b�tige qayting.',
  'pic_info_title' => 'K�r�ns�n/Yoshurun h�jjet information', //cpg1.3.0
  'slideshow_title' => 'Ret-ret k�r�nsun',
  'ecard_title' => 'Resim �-card qilip yollansun.', //cpg1.3.0
  'ecard_disabled' => '�-cards iqtidari toxtitilghan.',
  'ecard_disabled_msg' => 'Sizge �-cards ni ewertish hoquqi b�rilmidi.', //js-alert //cpg1.3.0
  'prev_title' => 'Aldinqi h�jjet', //cpg1.3.0
  'next_title' => 'K�yinki h�jjet', //cpg1.3.0
  'pic_pos' => 'H�jjet %s/%s', //cpg1.3.0
);

$lang_rate_pic = array(
  'rate_this_pic' => 'H�jjetni bahalang ', //cpg1.3.0
  'no_votes' => '(Hichkim bahalimidi)',
  'rating' => '(�rishken nomuri : %s / 5 We %s nomur)',
  'rubbish' => 'Nacharken',
  'poor' => 'Sel nacharken',
  'fair' => 'Adettikidekla',
  'good' => 'Yaxshiken',
  'excellent' => 'Qaltis',
  'great' => 'Bek Qaltis',
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
  CRITICAL_ERROR => 'Jiddiy xataliq',
  'file' => 'H�jjet: ',
  'line' => 'Qur sani: ',
);

$lang_display_thumbnails = array(
  'filename' => 'H�jjet nami : ',
  'filesize' => 'H�jjet hejimi : ',
  'dimensions' => 'Keng_tarliqi : ',
  'date_added' => 'Ay_k�n qoshush : ', //cpg1.3.0
);

$lang_get_pic_data = array(
  'n_comments' => '%s Pikir',
  'n_views' => '%s Q�tim K�r�ldi',
  'n_votes' => '(%s Nomur)',
);

$lang_cpg_debug_output = array(
  'debug_info' => 'Xata uchur', //cpg1.3.0
  'select_all' => 'Hemmini tallash', //cpg1.3.0
  'copy_and_paste_instructions' => 'If you\'re going to request help on the coppermine support board, copy-and-paste this debug output into your posting. Make sure to replace any passwords from the query with *** before posting.', //cpg1.3.0
  'phpinfo' => 'display phpinfo', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => 'Ataman Tilini Tallang', //cpg1.3.0
  'choose_language' => 'Tilingizni Tallang', //cpg1.3.0
);

$lang_theme_selection = array(
  'reset_theme' => 'Ataman tamb�tini tallang', //cpg1.3.0
  'choose_theme' => 'Tamb�ti tallang', //cpg1.3.0
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
  'Very Happy' => 'Bek xushhal',
  'Smile' => 'K�l�msiresh',
  'Sad' => 'Azaplinish',
  'Surprised' => 'Heyran q�lish',
  'Shocked' => 'Soghuq',
  'Confused' => 'Aylinip k�tey',
  'Cool' => 'Epsus',
  'Laughing' => 'K�lkilik',
  'Mad' => 'Sarang',
  'Razz' => 'Mesxire',
  'Embarassed' => 'Embarassed',
  'Crying or Very sad' => 'Crying or Very sad',
  'Evil or Very Mad' => 'Zeherxende',
  'Twisted Evil' => 'Ghelite',
  'Rolling Eyes' => 'K�zini aylandurush',
  'Wink' => 'Aliyish',
  'Idea' => 'Diqqet',
  'Arrow' => 'Arrow',
  'Neutral' => 'Ara pozutsiye',
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
  0 => 'Bashqurush b�likidin ayrilish...',
  1 => 'Bashqurush b�likige qedem...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
  'alb_need_name' => 'Alb�mgha nam b�ring !', //js-alert
  'confirm_modifs' => 'Choqum �zgertemsiz ?', //js-alert
  'no_change' => 'Siz h�chnimini �zgertmidingiz !', //js-alert
  'new_album' => 'Y�ngi alb�m',
  'confirm_delete1' => 'Rastinla bu alb�mni �ch�rwetmekchimu?', //js-alert
  'confirm_delete2' => '\n Barliq h�jjet we S�zler �ch�p k�tidu !', //js-alert
  'select_first' => 'Alb�m tallang', //js-alert
  'alb_mrg' => 'Album Bashqurghuchisi',
  'my_gallery' => '* M�ning galleryim *',
  'no_category' => '* Kat�goriye yoq *',
  'delete' => '�cher',
  'new' => 'Qoshush',
  'apply_modifs' => 'T�zitish',
  'select_category' => 'Kat�goriyeni Tallash',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
  'miss_param' => 'Meshghulatqa k�reklik \'%s\'miqdar teminlenmidi !',
  'unknown_cat' => 'Tallighan Kat�goriye san ambirida yoq',
  'usergal_cat_ro' => 'Qollanchi galleries Kat�goriyisidin �ch�r�shke bolmaydu !',
  'manage_cat' => 'Kat�goriye bashqurush',
  'confirm_delete' => 'Bu Kat�goriyeni rastinla �ch�remsiz', //js-alert
  'category' => 'Kat�goriye',
  'operations' => 'Meshghulat',
  'move_into' => 'gh y�tkesh',
  'update_create' => 'Kat�goriyeni Y�ngilash/Qurush ',
  'parent_cat' => 'Ata Kat�goriye',
  'cat_title' => 'Kat�goriye munderijisi',
  'cat_thumb' => 'Kat�goriye kichiklitilme s�riti', //cpg1.3.0
  'cat_desc' => 'Kat�goriye izahati',
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
  'title' => 'Tengshek',
  'restore_cfg' => 'Esli tengshekke qayturush',
  'save_cfg' => 'Tengshekni saqlash',
  'notes' => 'Diqqet',
  'info' => 'Uchur',
  'upd_success' => 'Tengshek y�ngilandi',
  'restore_success' => 'Tengshek eslige kelt�rildi',
  'name_a' => 'Nam kichiktin chonggha',
  'name_d' => 'Nam chongdin kichikke',
  'title_a' => 'Tambet kichiktin chonggha',
  'title_d' => 'Tambet chongdin kichikke',
  'date_a' => 'Waqt yeqindin yiraqqa',
  'date_d' => 'Waqt yiraqtin y�qin`gha',
  'th_any' => 'Eng chong k�r�m',
  'th_ht' => 'Igizliki',
  'th_wd' => 'Kengliki',
  'label' => 'Munderije', //cpg1.3.0
  'item' => 'T�r', //cpg1.3.0
  'debug_everyone' => 'Herbir', //cpg1.3.0
  'debug_admin' => 'Atamanch�n', //cpg1.3.0
        );

if (defined('CONFIG_PHP')) $lang_config_data = array(
  'Asasi tengshek',
  array('Alb�m nami', 'gallery_name', 0),
  array('Alb�m izahati', 'gallery_description', 0),
  array('Alb�m atamani �maili', 'gallery_admin_email', 0),
  array('Adr�slar ichide \'T�ximu k�p resim\' e-cards ulinishi', 'ecards_more_pic_target', 0),
  array('Alb�m liniyesiz', 'offline', 1), //cpg1.3.0
  array('�cardlar Tizimi', 'log_ecards', 1), //cpg1.3.0
  array('Yaqturghanni ZIP-qilip saqliyalisun', 'enable_zipdownload', 1), //cpg1.3.0

  'Tilt�ri, Tambetler &amp; Til reqemlik tengshiki',
  array('Tilt�ri', 'lang', 5),
  array('Tambet', 'theme', 6),
  array('Til tallishi k�r�nsun', 'language_list', 1), //cpg1.3.0
  array('Til tughi k�r�nsun', 'language_flags', 8), //cpg1.3.0
  array('K�r�n�sh &quot;Qayata tengshesh&quot; Tambet tengshesh ichide', 'language_reset', 1), //cpg1.3.0
  array('Tambet Munderijisi', 'theme_list', 1), //cpg1.3.0
  array('K�r�n�sh &quot;Qayta tengshesh&quot; Tambet tengshesh ichide', 'theme_reset', 1), //cpg1.3.0
  array('Soal_jawab k�r�n�sh', 'display_faq', 1), //cpg1.3.0
  array('bbcode Yardimi k�r�n�sh', 'show_bbcode_help', 1), //cpg1.3.0
  array('Xet kodi', 'charset', 4), //cpg1.3.0

  'Alb�m K�r�nishi',
  array('Asasliq jedwel kengliki (s�z�kliki or %)', 'main_table_width', 0),
  array('T�r k�rsitish sani', 'subcat_level', 0),
  array('Alb�m sani', 'albums_per_page', 0),
  array('Alb�m munderijisi qur sani', 'album_list_cols', 0),
  array('Kichiklitilgen h�jjetning S�z�kliki', 'alb_list_thumb_size', 0),
  array('Bash bet mezmuni', 'main_page_layout', 0),
  array('alb�m kichiklitilme bash b�ti','first_level',1),

  'Kichiklitip k�rsitish',
  array('Kichik k�rsitish qur sani', 'thumbcols', 0),
  array('Kichik k�rsitish tik qur sani', 'thumbrows', 0),
  array('Jedwel k�rinish eng chong sani', 'max_tabs', 10), //cpg1.3.0
  array('H�jjet ch�shenchisi, kichik k�rsitish astida (Qoshumche T�ma)', 'caption_in_thumbview', 1), //cpg1.3.0
  array('K�r�m sani kichiklitilmining astida k�r�lidu', 'views_in_thumbview', 1), //cpg1.3.0
  array('S�z sani kichiklitilmining astida k�r�lidu', 'display_comment_count', 1),
  array('Y�k ismi kichiklitilmining astida k�r�lidu', 'display_uploader', 1), //cpg1.3.0
  array('H�jjet k�r�m sani tertipi', 'default_sort_order', 3), //cpg1.3.0
  array('h�jjetke qizghin tashlan`ghan b�let\'lazmliq eng az b�let sani', 'min_votes_for_rating', 0), //cpg1.3.0

  'Resim k�r�n�sh &amp; S�z Tengshiki',
  array('Resim k�rinidighan jedwelning kengliki (S�z�kliki or %)', 'picture_table_width', 0), //cpg1.3.0
  array('H�jjet uchurini aldin k�rsitish', 'display_pic_info', 1), //cpg1.3.0
  array('S�zlerdin  chiqirw�tish.', 'filter_bad_words', 1),
  array('S�z bergende sinlarni ishlitish', 'enable_smilies', 1),
  array('Bir h�jjetke birqanche s�z b�relisun (qoghdunush izini Taqash)', 'disable_comment_flood_protect', 1), //cpg1.3.0
  array('Resim izahatining uzunliqi', 'max_img_desc_length', 0),
  array('izahatning xet ch�ki sani', 'max_com_wlength', 0),
  array('izahatning qur ch�ki sani', 'max_com_lines', 0),
  array('izahatning uzunliqi', 'max_com_size', 0),
  array('Resimche k�r�n�sh qur sani', 'display_film_strip', 1),
  array('ziyaret qurdiki resim sani', 'max_film_strip_items', 0),
  array('S�z berse ataman`gha �mail arqiliq uqturulsun', 'email_comment_notification', 1), //cpg1.3.0
  array('�z�lmey k�r�n�shi milliseconds (1 second = 1000 milliseconds)', 'slideshow_interval', 0), //cpg1.3.0

  'H�jjet kichiklitilme tengshigi', //cpg1.3.0
  array('JPEG H�jjitining s�piti', 'jpeg_qual', 0),
  array('Kichiklitilme ch�ki <a href="#notice2" class="clickable_option">**</a>', 'thumb_width', 0), //cpg1.3.0
  array('Ishlitish ch�ki ( kengliki, igizliki yaki kichiklitilme ch�ki)<b>**</b>', 'thumb_use', 7),
  array('Ara derijilik resim qurush','make_intermediate',1),
  array('Ara derije resim we sinning ch�ki<a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0), //cpg1.3.0
  array('Y�klenme h�jjetning hejimi (KB)', 'max_upl_size', 0), //cpg1.3.0
  array('Y�klenme resim we sinning igizlik yaki kenglik ch�ki (pixels)', 'max_upl_width_height', 0), //cpg1.3.0

  'H�jjet bilen resimchening kirg�zme qimmet tengshiki', //cpg1.3.0
  array('Qollanchi h�jjitini m�hmangha k�rs�t�sh','show_private',1), //cpg1.3.0
  array('Qobul qilinmaydighan arxip nam belgiliri', 'forbiden_fname_char',0), //cpg1.3.0
  //array('Y�klenme resim qobullaydighan qoshumche nam', 'allowed_file_extensions',0), //cpg1.3.0
  array('Qobul resim shekli', 'allowed_img_types',0), //cpg1.3.0
  array('Qobul sin shekli', 'allowed_mov_types',0), //cpg1.3.0
  array('Qobul awaz shekli', 'allowed_snd_types',0), //cpg1.3.0
  array('Qobul h�jjet shekli', 'allowed_doc_types',0), //cpg1.3.0
  array('Resimche qurush usuli','thumb_method',2), //cpg1.3.0
  array('Path to ImageMagick \'convert\' ulinish yoli (mesilen /usr/bin/X11/)', 'impath', 0), //cpg1.3.0
  //array('Qobul resim shekli (peqet ImageMagick la ishleydu)', 'allowed_img_types',0), //cpg1.3.0
  array('ImageMagick ning buyruq tallanmiliri', 'im_options', 0), //cpg1.3.0
  array('JPEG ning EXIF mat�riyalini oqush', 'read_exif_data', 1), //cpg1.3.0
  array('JPEG ning IPTC mat�riyalini oqush', 'read_iptc_data', 1), //cpg1.3.0
  array('Alb�m yoli <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0), //cpg1.3.0
  array('Qollanchi h�jjet yoli <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0), //cpg1.3.0
  array('Ara resimning prefix li <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0), //cpg1.3.0
  array('Kichiklitilme resimning prefix li <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0), //cpg1.3.0
  array('Resim munderijisi belgilime ch�ki', 'default_dir_mode', 0), //cpg1.3.0
  array('Y�k resim belgilime ch�ki', 'default_file_mode', 0), //cpg1.3.0

  'Qollanchi ch�ki',
  array('Y�ngi eza qobullinidu', 'allow_user_registration', 1),
  array('�mail arqiliq tizim testiqlinidu', 'reg_requires_valid_email', 1),
  array('ishletk�chi tizimlatsa Ataman`gha �mail ewertilsun', 'reg_notify_admin_email', 1), //cpg1.3.0
  array('Ikki qollanchi bir �mail ishletse bolidu', 'allow_duplicate_emails_addr', 1),
  array('Qollanchiningmu alb�mi bolsun (Diqqet: Eger hee din yaqqa almashtursingiz Qollanchi alb�mi ammiwiliship qalidu)', 'allow_private_albums', 1), //cpg1.3.0
  array('Qollanchi y�k testiqi ataman`gha uqturulsun', 'upl_notify_admin_email', 1), //cpg1.3.0
  array('Ezalar qollanchi tizimini k�relisun', 'allow_memberlist', 1), //cpg1.3.0

  'S�ret izahati �z quri (ishletmisingiz bosh qalsun)',
  array('Qur 1 nami', 'user_field1_name', 0),
  array('Qur 2 nami', 'user_field2_name', 0),
  array('Qur 3 nami', 'user_field3_name', 0),
  array('Qur 4 nami', 'user_field4_name', 0),

  'Cookies settings',
  array('Qollanghan cookie Nami (bbs bilen ishletkende,  bbs\'s cookie nami bilen oxshash bolmisun)', 'cookie_name', 0),
  array('cookie yoli', 'cookie_path', 0),

  'Bashqa tengshek',
  array('Xataliq shekli qozghutulsun', 'debug_mode', 9), //cpg1.3.0
  array('Xataliq shekli k�r�nme uchuri', 'debug_notice', 1), //cpg1.3.0

  '<br /><div align="left"><a name="notice1"></a>(*) Bu h�jjet san ambirida alla burun bar.<br />
  <a name="notice2"></a>(**) �zgertilme bar arxipqila ishleydu, Qandaqla bolmisun ataman iqtidaridin arxipni tengshisingiz &quot;<a href="util.php">ataman qorali</a> da(Resim chong_kichiklikini tengshesh)&quot; </div><br />', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => '� kartisi yollash', //cpg1.3.0
  'ecard_sender' => 'Berg�chi', //cpg1.3.0
  'ecard_recipient' => 'B�rilg�chi', //cpg1.3.0
  'ecard_date' => 'Waqt', //cpg1.3.0
  'ecard_display' => '�kard k�r�n�sh', //cpg1.3.0
  'ecard_name' => 'Nami', //cpg1.3.0
  'ecard_email' => '�mail', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_ascending' => 'ashurush', //cpg1.3.0
  'ecard_descending' => 'k�meytish', //cpg1.3.0
  'ecard_sorted' => 'tertip', //cpg1.3.0
  'ecard_by_date' => 'Bergen Waqt', //cpg1.3.0
  'ecard_by_sender_name' => 'Bergen Yollanchi nami\'s name', //cpg1.3.0
  'ecard_by_sender_email' => 'Berguchi\'s �mail', //cpg1.3.0
  'ecard_by_sender_ip' => 'Berguchi\'s IP adr�si', //cpg1.3.0
  'ecard_by_recipient_name' => 'B�rilg�chi\'s nami', //cpg1.3.0
  'ecard_by_recipient_email' => 'B�rilg�chi\'s �mail', //cpg1.3.0
  'ecard_number' => 'K�r xatire %s din %s gha %s', //cpg1.3.0
  'ecard_goto_page' => 'Betke baridu', //cpg1.3.0
  'ecard_records_per_page' => 'Bet q�tim sani', //cpg1.3.0
  'check_all' => 'Hemmini tallash', //cpg1.3.0
  'uncheck_all' => 'Tallimasliq', //cpg1.3.0
  'ecards_delete_selected' => 'Tallan`ghanni �ch�r�sh', //cpg1.3.0
  'ecards_delete_confirm' => 'Rastinla xatirini �chermekchimu? Emise tallang!', //cpg1.3.0
  'ecards_delete_sure' => 'Muqimlidim', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
  'empty_name_or_com' => 'Nam we S�zni y�zing',
  'com_added' => 'S�zingiz xatirlendi',
  'alb_need_title' => 'Siz alb�m �ch�n T�ma b�ring !',
  'no_udp_needed' => 'Y�ngilash bihajet.',
  'alb_updated' => 'Alb�m y�ngilinip bolghan',
  'unknown_album' => 'Tallighan alb�m yoq yaki siz cheklimige uchurdingiz.',
  'no_pic_uploaded' => 'H�jjet y�klenmidi !<br /><br />Y�k bermek bolsingiz, y�kleshke ijazet barmu yoq teksh�r�p biling...', //cpg1.3.0
  'err_mkdir' => 'Munderije qurghili bolmidi %s !',
  'dest_dir_ro' => 'Munderije %s Xatirige y�zilmidi !',
  'err_move' => 'ge %s Y�tkilelmidi %s !',
  'err_fsize_too_large' => 'Y�k resimi chong ( %s x %s din ashmisun) !', //cpg1.3.0
  'err_imgsize_too_large' => 'H�jjet hejimi chong ( %s KB din ashmisun) !',
  'err_invalid_img' => 'Siz y�kligen h�jjet sheklini qollimaymiz !',
  'allowed_img_types' => 'Siz peqet %s Resim yolliyalaysiz.',
  'err_insert_pic' => 'H�jjet \'%s\' Alb�mgha y�klinelmeydu ', //cpg1.3.0
  'upload_success' => 'H�jjetni y�klesh tamam.<br /><br />Ataman testiqidin k�yin Y�klimingizni k�releysiz.', //cpg1.3.0
  'notify_admin_email_subject' => '%s - Y�klenme uqturishi', //cpg1.3.0
  'notify_admin_email_body' => ' %s Yollanma y�k bar testiqingizni k�tmekte. K�r�p b�qing. %s', //cpg1.3.0
  'info' => 'Uchur',
  'com_added' => 'S�zingiz qoshuldi',
  'alb_updated' => 'Alb�m Y�ngilandi',
  'err_comment_empty' => 'S�zber quruq !',
  'err_invalid_fext' => 'T�wendiki qoshumche namnila qollaydu : <br /><br />%s.',
  'no_flood' => 'Kech�r�ng Eng axirqi s�z sizning<br /><br />Tehrirliwalsingiz bolidu.', //cpg1.3.0
  'redirect_msg' => 'Bet y�tkiliwatidu.<br /><br /><br />Ch�king \'Dawami\' Eger bet �zligidin ch�tkilanmisa',
  'upl_success' => 'H�jjitingiz saqlandi', //cpg1.3.0
  'email_comment_subject' => 'Siz Coppermine Photo Galleryge pikir s�zi b�rip bolghan', //cpg1.3.0
  'email_comment_body' => 'Galleryingizge kishiler s�z qaldurdi. K�r�ng', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
  'caption' => 'Izah',
  'fs_pic' => 'Esli resim',
  'del_success' => 'Pakiz �ch�r�ldi',
  'ns_pic' => 'normal hejimdiki resim',
  'err_del' => '�ch�relmiduq',
  'thumb_pic' => 'Resimche',
  'comment' => 'S�zber',
  'im_in_alb' => 'Alb�mdiki resim',
  'alb_del_success' => 'Alb�m \'%s\' �ch�r�sh',
  'alb_mgr' => 'Alb�m Atamani',
  'err_invalid_data' => 'Natoghra Tapshuruw�linma \'%s\'',
  'create_alb' => 'Alb�m qurush \'%s\'',
  'update_alb' => 'Alb�m y�ngilandi \'%s\' T�misi \'%s\' Bash b�ti \'%s\'',
  'del_pic' => 'H�jjetni �ch�r�sh', //cpg1.3.0
  'del_alb' => 'Alb�mni �ch�r�sh',
  'del_user' => 'Qollanchini �ch�r�sh',
  'err_unknown_user' => 'Tallan`ghan qollanchi yoq !',
  'comment_deleted' => 'S�zler �ch�r�ldi',
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
  'confirm_del' => 'Bu h�jjetni rastinla �chiremsiz? \\nComments will also be deleted.', //js-alert //cpg1.3.0
  'del_pic' => 'Bu resim �ch�r�sh', //cpg1.3.0
  'size' => '%s x %s pixels',
  'views' => '%s Q�tim',
  'slideshow' => 'Ulanma k�r�n�sh',
  'stop_slideshow' => 'Qoyulushni toxtitish',
  'view_fs' => 'ch�kip resimning esli halitini k�r�ng',
  'edit_pic' => 'Ch�shenchini tehrirlesh', //cpg1.3.0
  'crop_pic' => 'K�sish we Aylandurush', //cpg1.3.0
);

$lang_picinfo = array(
  'title' =>'H�jjet uchuri', //cpg1.3.0
  'Filename' => 'H�jjet nami',
  'Album name' => 'Alb�m nami',
  'Rating' => 'Nomur qoyush (%s chi b�let)',
  'Keywords' => 'halqiliq s�z',
  'File Size' => 'H�jjet hejimi',
  'Dimensions' => 'Chong_kichikliki',
  'Displayed' => 'k�r�n�sh',
  'Camera' => 'Kam�ra',
  'Date taken' => 'Tartilghan waqt',
  'ISO'=>'ISO',
  'Aperture' => 'K�z halqisi',
  'Exposure time' => 'Exposure waqti',
  'Focal length' => 'Fokusni yighmaq',
  'Comment' => 'S�zber',
  'addFav'=>'K�ngl�mdikisige saqlash', //cpg1.3.0
  'addFavPhrase'=>'K�ngl�mdikisi', //cpg1.3.0
  'remFav'=>'K�ngl�mdikisidin y�tkesh', //cpg1.3.0
  'iptcTitle'=>'IPTC T�ma', //cpg1.3.0
  'iptcCopyright'=>'IPTC Neshir hoquqi', //cpg1.3.0
  'iptcKeywords'=>'IPTC Halqiliq s�z', //cpg1.3.0
  'iptcCategory'=>'IPTC Kat�goriye', //cpg1.3.0
  'iptcSubCategories'=>'IPTC Tarmaq Kat�goriye', //cpg1.3.0
);

$lang_display_comments = array(
  'OK' => 'Qobul',
  'edit_title' => 'Bu yazmini tehrirlesh',
  'confirm_delete' => 'Bu yazmini rastinla �ch�rw�temsiz ?', //js-alert
  'add_your_comment' => 'S�z qaldurung',
  'name'=>'Nam',
  'comment'=>'S�zber',
  'your_name' => 'S�zleng',
);

$lang_fullsize_popup = array(
  'click_to_close' => 'Resimni ch�kip k�znekni taqang',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
  'title' => '�_kardni ewertish',
  'invalid_email' => '<b>Agahlandurush</b> : inawetsiz �mail !',
  'ecard_title' => 'Bu �kard %s Din kelgen',
  'error_not_image' => '�_kartimiz peqetla resimnila yollaydu.', //cpg1.3.0
  'view_ecard' => '�_card normal k�r�nmise, Bu ulanmini ch�king',
  'view_more_pics' => 'Bu ch�kip t�ximu k�p resimlerni k�r�ng !',
  'send_success' => '�_cartingiz yollandi',
  'send_failed' => 'Kech�r�ng! mulamit�rimiz �-car yollashqa amalsiz...',
  'from' => 'Yollighuchi',
  'your_name' => 'Namingiz',
  'your_email' => '�mail adr�sisingiz',
  'to' => 'Yollan`ghuchi',
  'rcpt_name' => 'Dostingizning nami',
  'rcpt_email' => 'Dostingizning �mail adr�si',
  'greetings' => 'Salam t�misi',
  'message' => 'Salam s�zi',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
  'pic_info' => 'File info', //cpg1.3.0
  'album' => 'Alb�m',
  'title' => 'T�ma',
  'desc' => 'Izahat',
  'keywords' => 'Halqiliq s�z',
  'pic_info_str' => '%s &times; %s - %s KB - %s K�r�ldi - %s Bahalandi',
  'approve' => 'H�jjetni teksh�r�p-bahalash', //cpg1.3.0
  'postpone_app' => 'Teksh�r�p bahalash uzartildi',
  'del_pic' => 'H�jjetni �ch�r�sh', //cpg1.3.0
  'read_exif' => 'Yene EXIF uchurini oqush', //cpg1.3.0
  'reset_view_count' => 'Sanaqni qayta tengshesh',
  'reset_votes' => 'Bahani qayta tengshesh',
  'del_comm' => 'S�zni �ch�rw�tish',
  'upl_approval' => 'Bahalan`ghanni y�klesh',
  'edit_pics' => 'H�jjetni tehrirlesh', //cpg1.3.0
  'see_next' => 'K�yinki h�jjet', //cpg1.3.0
  'see_prev' => 'Aldinqi h�jjet', //cpg1.3.0
  'n_pic' => '%s H�jjet', //cpg1.3.0
  'n_of_pic_to_disp' => 'H�jjet k�rinish sani', //cpg1.3.0
  'apply' => '�zgertish', //cpg1.3.0
  'crop_title' => 'Coppermine Resim tehriri', //cpg1.3.0
  'preview' => 'Ziyaret', //cpg1.3.0
  'save' => 'Saqlash', //cpg1.3.0
  'save_thumb' =>'Kichiklitilmini saqlash', //cpg1.3.0
  'sel_on_img' =>'Paaliyet axirlashti!', //js-alert //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => 'Daimliq soal_jawablar', //cpg1.3.0
  'toc' => 'M�nderije', //cpg1.3.0
  'question' => 'Soal: ', //cpg1.3.0
  'answer' => 'Jawap: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  'Adettiki soal_jawap', //cpg1.3.0
  array('Nime �ch�n tizimlinimiz?', 'Ataman qollanchilarni testiqlaydu. Tizimlansingiz nurghun iqtidarlardin behriman bolisiz, mesilen: Y�klesh, K�ngl�mdikisi, H�jjetlerge baha b�releysiz yaki s�z qalduralaysiz qatarliqlar.', 'allow_user_registration', '1'), //cpg1.3.0
  array('Qandaq tizimlinimen?', '&quot; Tizimlinishni &quot; Ch�kip, katekchilerni toldurimiz (Tallap toldurimiz).<br />Eger, Ataman �mail aktiplashni qozghatqan bolsa, Aktiplinish toldurma uchuringizni tapshurwalisiz, sehipimizge kirishtin burun choqum aktiplinishingiz k�rek.', 'allow_user_registration', '1'), //cpg1.3.0
  array('Qandaq kirimen?', ' &quot; Kirish &quot;, ni ch�kip Nam we Im(parol)ni toldurisiz &quot;M�ni unutmang &quot; Tallap qoysingiz k�lerki kirishingiz aptumatik orunlinidu.<br /><b>Diqqet: Kompingizning Cookies iqtidari ochuq bolsun. cookie ponkitimiz kompingizgha saqlaydu.</b>', 'offline', 0), //cpg1.3.0
  array('Nech�n kirelmeymen?', 'Tizimlinipmu kirelmigen bolsingiz qaytip �mailingizgha qarang. (aktiplandingizmu yoq) Qaldi ishlar bolsa b�ket atamanidin sorang.', 'offline', 0), //cpg1.3.0
  array('Imni untuptimen?', 'Eger bu tor bette &quot;Im(parol) untulsa &quot; ni ch�king. Bolmisa ataman`gha �yting sizge y�ngidin Im(parol) ewertip bersun.', 'offline', 0), //cpg1.3.0
  //array('�mailim �zgerdi ne qilay?', 'Kirgenla bolsingiz &quot;Arxipingizdin �zgertiwalsingizla bolghini;', 'offline', 0), //cpg1.3.0
  array('Resimlerni Qandaq &quot;k�ngl�mdikisi&quot; ge Qoshimen?', 'Awal resimni ch�kip Tallaysiz (<img src="images/info.gif" width="16" height="16" border="0" alt="Picture information" />);  mushu belgini ch�kisiz, bet astida  &quot;k�ngl�mdikisi &quot; d�gen xetni ch�kip saqliwalimiz.<br />Ataman choqum bu iqtidarni tengshep qoyghan bolishi k�rek.<br />Diqqet: Kompingizning Cookies iqtidari ochuq bolsun. cookie ponkitimiz kompingizgha saqlaydu.', 'offline', 0), //cpg1.3.0
  array('H�jjetni Qandaq bahalaymiz?', 'Kichiklitilmining astidiki bahalarni tallang.', 'offline', 0), //cpg1.3.0
  array('Qandaq pikir b�rimiz?', 'Kichiklitilmining astidiki S�zberge yazsingiz bolidu.', 'offline', 0), //cpg1.3.0
  array('H�jjetni qandaq y�kleymiz?', ' &quot;H�jjet y�klesh &quot;ni ch�kip. Alb�mni tallap bolup &quot??/ziyaret&quot arqiliq y�kleymiz, Andin, izah we H�jjet namini toldurup yollisaqla boldi.', 'allow_private_albums', 0), //cpg1.3.0
  array('H�jjetni qandaq Y�kleymiz?', ' &quot;M�ning alb�mim&quot;. Arqiliq y�kleysiz. eskertish: Ataman bu iqtidarni aktiplighan bolishi k�rek.', 'allow_private_albums', 0), //cpg1.3.0
  array('Y�klenmining hejimi, h�jjet shekli qandaq bolidu?', 'Hejim, h�jjet sheklini Ataman belgileydu. (mesilen: jpg, png, etc...wav, rm, xx.Kb qatarliqlar) .', 'offline', 0), //cpg1.3.0
  array('&quot;Alb�mim&quot;d�gen nime?', '�zingizning y�ki hem bashqurush ijazet rayoningizdur.', 'allow_private_albums', 0), //cpg1.3.0
  array('Y�klesh, �zgertish, �ch�r�sh qandaq �lip b�rilidu;?', ' awal bu ch�king &quot;Qollanchi kirish&quot; ni <br /> Andin, &quo;Alb�m qurush&quot; ni ch�kip alb�m qurup &quot;Alb�m y�klesh &quot;ni ch�kip y�klep we  &quot;tehrirlesh &quot;ni ch�kip �zgertsingiz bolidu.', 'allow_private_albums', 0), //cpg1.3.0
  array('cookies nime?', 'Cookie ni ponkitimiz kompingizgha saqlaydu, meqset siz k�ler q�tim ziyaret qilghanda tizimlanmisingizmu aptumatik tizimlinisiz.<br />Cookies ni cheklep qoysingiz bu iqtidardin behriman bolalmaysiz.', 'offline', 0), //cpg1.3.0
  array('Siz bu ponkit programmisini nedin y�kliwalghan?', 'Coppermine GNU GPL ni asas qilghan heqsiz Multimedia Gallery. yaqtursingiz <a href="http://coppermine.sf.net/">Coppermine Ana b�tini</a> ziyaret qilip y�kliw�ling. Andin www.newruz.com teminligen Uyghur terjime til h�jjitini ishletsingiz bolidu.', 'offline', 0), //cpg1.3.0

  'Tor b�ket y�tekchisi', //cpg1.3.0
  array('&quot;Alb�m sehipisi&quot; d�gen nime?', 'Barliq alb�mlar, katigoriyeler, kichiklitilmiler bar bash betni k�rsitidu..', 'offline', 0), //cpg1.3.0
  array('&quot;Alb�mim&quot; d�gen nime?', 'Qollanchilar �ch�n qurulghan, y�k qoshush, tehrirlesh, �ch�rsh rayonidur.(Elwette ataman ruxsiti bolishi k�rek.)', 'allow_private_albums', 0), //cpg1.3.0
  array('&quot;Bashqurush shekli we Qollanchi shekli&quot; Qandaq ayrilidu?', 'Qollanchi shekli ziyaritingiz �ch�n, Bashqurush shekli tehrirlesh, �ch�r�sh, Y�k qoshishingiz �ch�n ajritildi. (Elwette, Atamanning ruxsiti bolishi shert.)', 'allow_private_albums', 0), //cpg1.3.0
  array('&quot;Y�klesh&quot; d�gen nime?', 'H�jjet yollishingizni k�rsitidu. (Elwette, hejimini, h�jjer sheklini ataman belgileydu.)', 'allow_private_albums', 0), //cpg1.3.0
  array('&quot;Eng y�ngi y�k&quot; d�gen nime?', 'Siz we bashqilar yollighan eng y�ngi h�jjetlerni k�rsitidu.', 'offline', 0), //cpg1.3.0
  array('&quot;Eng y�ngi s�z&quot; d�gen nime?', 'B�kettiki h�jjetlerge b�rilgen eng y�ngi pikir yazmilarni k�rsitidu.', 'offline', 0), //cpg1.3.0
  array('&quot;K�p  K�r�lme &quot; d�gen nime?', 'Ezalar bolsun yaki M�hmanlar bolsun ch�kilish sani yoquri h�jjetlerni k�rsitidu. ', 'offline', 0), //cpg1.3.0
  array('&quot;Yoquri baha &quot; d�gen nime?', '�rishken yoquri nomurni k�rsitidu. (Mesilen: Besh qollanchi <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> ni Berse, Netijisi <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />Bolidu; Besh qollanchi 1 din 5 kiche (1,2,3,4,5) Nomur berse, Netijisi<img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> Bolidu .)<br />Netijisi <img src="images/rating5.gif" width="65" height="14" border="0" alt="best" /> (e`la) din <img src="images/rating0.gif" width="65" height="14" border="0" alt="worst" /> (Nachar)gha Tizilidu.', 'offline', 0), //cpg1.3.0
  array('&quot;K�ngl�mdikisi &quot; d�gen nime?', 'Siz yaqturup tallighan h�jjetlerni k�rsitidu. cookie ni lazimlaydu.', 'offline', 0), //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => 'Im(parol)ni �nt�ptimen', //cpg1.3.0
  'err_already_logged_in' => 'Siz kirip bolghan !', //cpg1.3.0
  'enter_username_email' => 'Qollanchi nami yaki �mail adr�sini toldurung', //cpg1.3.0
  'submit' => 'Muqimlash', //cpg1.3.0
  'failed_sending_email' => 'Im(parol) teminlen`gen �malni ewertishke amalsizmiz !', //cpg1.3.0
  'email_sent' => 'Nam we Imingizni %sge �wertip bolundi', //cpg1.3.0
  'err_unk_user' => 'Bu qollanchi yoq!', //cpg1.3.0
  'passwd_reminder_subject' => '%s � Im(parol) Eskertishi', //cpg1.3.0
  'passwd_reminder_body' => 'Kirg�zgen uchuringiz mundaq:
Username: %s
Password: %s
Ch�kip %s gha kirish.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
  'group_name' => 'Group nami',
  'disk_quota' => 'Disk hejimi',
  'can_rate' => 'H�jjetke baha qoshalisun', //cpg1.3.0
  'can_send_ecards' => '�cards yolliyalisun',
  'can_post_com' => 'S�z b�relisun',
  'can_upload' => 'H�jjet yolliyalisun', //cpg1.3.0
  'can_have_gallery' => 'Xususiy alb�m bar bolsun',
  'apply' => '�zgertish',
  'create_new_group' => 'Y�ngi group qurush',
  'del_groups' => 'Tallan`ghan group(lar) ni �ch�r�sh',
  'confirm_del' => 'Diqqet, group �chersingiz, grouptiki Qollanchi \'Registered\' Groupqa barsun !\n\n Rastinla �cherdingizmu ?', //js-alert //cpg1.3.0
  'title' => 'Ataman groupisi',
  'approval_1' => 'Ammiwi alb�mni testiqlash (1)',
  'approval_2' => 'xususiy alb�mni testiqlash (2)',
  'upload_form_config' => 'Y�k shekillirini tengshesh', //cpg1.3.0
  'upload_form_config_values' => array( 'Bir h�jjetni y�klesh', 'K�p h�jjetni y�klesh', 'URI nila y�klesh', 'ZIP nila y�klesh', 'File-URI', 'File-ZIP', 'URI-ZIP', 'File-URI-ZIP'), //cpg1.3.0
  'custom_user_upload'=>'Qollanchilar y�klime somka sani?', //cpg1.3.0
  'num_file_upload'=>'Eng k�p/Y�k H�jjet somka sani', //cpg1.3.0
  'num_URI_upload'=>'Eng k�p/Y�k URI H�jjet somka sani', //cpg1.3.0
  'note1' => '<b>(1)</b> Ammiwiy alb�m y�klimisini ataman testiqlaydu',
  'note2' => '<b>(2)</b> Xususiy alb�m y�klimisini ataman testiqlaydu',
  'notes' => 'Diqqet',
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
  'welcome' => 'Xush keldingiz !',
);

$lang_album_admin_menu = array(
  'confirm_delete' => 'Bu alb�mni rastinla �ch�remsiz ? \\n Barliq resim we S�zler �ch�p k�tidu.', //js-alert //cpg1.3.0
  'delete' => '�ch�r�sh',
  'modify' => 'Xarekt�r',
  'edit_pics' => 'Tehrirlesh', //cpg1.3.0
);

$lang_list_categories = array(
  'home' => 'Ana bet',
  'stat1' => '<b>[pictures]</b> H�jjetler <b>[albums]</b> Alb�mde we<b>[cat]</b> Katigoriyede, <b>[comments]</b> Jawap s�z <b>[views]</b> K�r�m(ziyaret xatirisi) bar.', //cpg1.3.0
  'stat2' => '<b>[pictures]</b> H�jjetler <b>[albums]</b> Alb�mde we<b>[views]</b> Jawap s�z bar.', //cpg1.3.0
  'xx_s_gallery' => '%s\'s Gallery',
  'stat3' => '<b>[pictures]</b> H�jjetler <b>[albums]</b> Alb�mda we <b>[comments]</b> Jawap s�z <b>[views]</b> K�r�m(ziyaret xatirisi) bar.', //cpg1.3.0
);

$lang_list_users = array(
  'user_list' => 'Qollanchi tizimi',
  'no_user_gal' => 'Qollanchi alb�mi yoq',
  'n_albums' => '%s Alb�m(lar)',
  'n_pics' => '%s H�jjet(ler)', //cpg1.3.0
);

$lang_list_albums = array(
  'n_pictures' => '%s H�jjet', //cpg1.3.0
  'last_added' => ', Eng y�ngisi %s',
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
  'login' => 'Kiring',
  'enter_login_pswd' => 'Nam we Im(parol)ni toldurung',
  'username' => 'Nam',
  'password' => 'Im(parol)',
  'remember_me' => 'M�ni unutmang',
  'welcome' => 'Merhaba %s ...',
  'err_login' => '*** Kirelmidingiz Qayta sinang***',
  'err_already_logged_in' => 'Ow! siz kirip bolghan!',
  'forgot_password_link' => 'Im(parol)ni untuptimen', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
  'logout' => 'Chiqe',
  'bye' => 'Xeyr_xosh %s ...',
  'err_not_loged_in' => 'Siz t�xi kirmidingiz !',
);

// ------------------------------------------------------------------------- //
// File phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP uchuri', //cpg1.3.0
  'explanation' => 'Buni PHP-function kelt�r�p chiqarghan <a href="http://www.php.net/phpinfo">phpinfo()</a>, Copermine azqisim uchurlirini k�rsitish.', //cpg1.3.0
  'no_link' => 'Bashqilar phpinfo yingizni k�rse bixeterlik xataliqi k�rilidu, Ataman bolup kirishingizdiki sewebmu shu. Bu ulunushni bashqilargha dep bermeng, bolmisa saqlash xataliqi k�rilidu.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
  'upd_alb_n' => 'Update album %s',
  'general_settings' => 'General settings',
  'alb_title' => 'Alb�m Munderijisi',
  'alb_cat' => 'Alb�m kat�goriyisi',
  'alb_desc' => 'Alb�m izahati',
  'alb_thumb' => 'Alb�m �lgisi',
  'alb_perm' => 'Alb�m cheklimisi',
  'can_view' => 'Alb�mni k�releysiz',
  'can_upload' => 'H�jjet y�kliyeleysiz',
  'can_post_comments' => 'Pikir b�releysiz',
  'can_rate' => 'H�jjetke nomur b�releysiz',
  'user_gal' => 'Qollanchi alb�mi',
  'no_cat' => '* Alb�m t�ri *',
  'alb_empty' => 'Alb�m quruq',
  'last_uploaded' => 'Y�qinqi y�k',
  'public_alb' => 'Hemmige (Ammiwi alb�m)',
  'me_only' => 'Peqet menla',
  'owner_only' => 'Alb�m igisigila (%s) tewe',
  'groupp_only' => 'Qollanchilar \'%s\' grouplar',
  'err_no_alb_to_modify' => 'Alb�mingizda h�jjet yoq.',
  'update' => 'Alb�mni y�ngilash', //cpg1.3.0
  'notice1' => '(*) groupqa %s asasen%s Tengshesh', //cpg1.3.0 (do not translate %s!)
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
  'already_rated' => 'Kech�risiz! siz bu h�jjetke nomur b�rip bolghan.', //cpg1.3.0
  'rate_ok' => 'Nomuringiz qobullandi',
  'forbidden' => '�zingizning h�jjitige nomur b�relmeysiz.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
 {SITE_NAME} ning Atamani, Adette namuwapiq h�jjetlerni retlep tursimu, Biraq, Barliq h�jjetlerni waqtida k�r�p bolishi mumkin emes. Shunga, Y�klimining mesuliyiti yollighuchighila tewe bolup, Atamanning (Ataman y�kligen h�jjetler buningdin sirtida) meydanini bild�rmeydu hem qanuniy mesuliyetni �z �stige alalmaydu.
<br />
<br />
Siz choqum eza bolghandin k�yin, bashqilarning shexsiyitige yatidighan, Zorawanliq, Shehwaniliq, Dinniy esebiylikni, Xurapatliqni terghip qilidighan qanungha xilap bolghan herqandaq h�jjetni yollimasliqqa qoshulishingiz shert. Siz {SITE_NAME} ning Atamani herqandaq waqtta h�jjetlerni tehrirlishige yaki �ch�r�shige yol qoyisiz. Y�klimingiz sanliq ambarda saqlinidu, Sizning ruxsitingizsiz biz h�ch kishige �t�nmeymiz. Shunisi, Hachk�rliq qilmishi bilen oghurlunup k�tilse mesuliyetni ustimizge alalmaymiz.  <br />
<br />
B�kitimiz "cookiesa" arqiliq kompingizgha uchur saqlap yene ziyaret qilishingizni asanlashturidu. �mailingiz peqetla tizim arxipingizni (parolingizni) aktiplash �ch�nla ishlitilidu. <br />
<br />
'Qoshulimen' ni ch�kish arqiliq shertlirimizge k�n�ng.
EOT;

$lang_register_php = array(
  'page_title' => 'Ezaliqqa Tizimlitish',
  'term_cond' => 'Shertler',
  'i_agree' => 'Qoshulimen',
  'submit' => 'Tizimlinimen',
  'err_user_exists' => 'Kech�risiz, Bu nam qollinip bolun`ghan, bashqa Namni qollunung',
  'err_password_mismatch' => 'Ikki im(parol) oxshash bolmidi, qayta y�zing',
  'err_uname_short' => 'Namingiz ikki herptin kam bolmisun.',
  'err_password_short' => 'Im(parol) ikki herptin kam bolmisun.',
  'err_uname_pass_diff' => 'Im(parol) we Nam oxshash bolmisun.',
  'err_invalid_email' => '�mail adr�si xata.',
  'err_duplicate_email' => 'Bu �mail ishlitilip bolun`ghan.',
  'enter_info' => 'Tizimlitish uchurini toldurung',
  'required_info' => 'Choqum toldurung',
  'optional_info' => 'Toldurmisingizmu bolidu',
  'username' => 'Namingiz',
  'password' => 'Im(parol)',
  'password_again' => 'Im(parol)ni qayta y�zing',
  'email' => '�mail',
  'location' => 'Orningiz',
  'interests' => 'Qiziqishingiz',
  'website' => 'Tor b�tinigiz',
  'occupation' => 'Kespingiz',
  'error' => 'Xataliq',
  'confirm_email_subject' => '%s - H�jjet Y�klime uqturushi',
  'information' => 'Uchur',
  'failed_sending_email' => 'Tizimlan`ghan �mail adr�si ewertelmeydu !',
  'thank_you' => 'Tizimlatqiningizgha teshekk�r.<br /><br />H�sapingizni aktiplash uchuri �malingizgha yollandi.',
  'acct_created' => 'H�sapingiz quruldi, kirsinigz bolidu.',
  'acct_active' => 'H�sapingiz qozghitildi, kirsingiz bolidu.',
  'acct_already_act' => 'H�sapingiz qozghitildi!',
  'acct_act_failed' => 'H�sapingiz qozghilishqa amalsiz!',
  'err_unk_user' => 'Siz tallighan Qollanchi mewj�t emes !',
  'x_s_profile' => '%s\'s ning arxipi',
  'group' => 'Group',
  'reg_date' => 'Eza bolung',
  'disk_usage' => 'Disk Hejimi',
  'change_pass' => ' IM(parol) �zgertish ',
  'current_pass' => 'Esli IM(parol)',
  'new_pass' => 'Y�ngi IM(parol)',
  'new_pass_again' => 'Y�ngi Im(parol)ni muqimlang',
  'err_curr_pass' => 'Esli IM(parol) xata',
  'apply_modif' => '�zgertish',
  'change_pass' => 'IM(parol)ni �zgertish',
  'update_success' => 'Arxipingiz y�ngilandi',
  'pass_chg_success' => 'IM(parol) �zgerdi',
  'pass_chg_error' => 'IM(parol) �zgermidi',
  'notify_admin_email_subject' => '%s - Tizimlitish uqturushi', //cpg1.3.0
  'notify_admin_email_body' => 'Yene bir y�ngi eza nami"%s" galleryge tizimlandi', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
{SITE_NAME} ge tizimlatqiningizgha k�p teshekk�r

Qollanchi namingiz : "{USER_NAME}"
IM(parol)ingiz : "{PASSWORD}"

T�wendiki ulanmini ch�kip H�sapingizni qozghutung yaki ulanmini E ulanmisigha chaplang.
or copy and paste it in your web browser.

{ACT_LINK}

Regards,

The management of {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
  'title' => 'Pikir k�r�sh',
  'no_comment' => 'T�xi S�z yoq',
  'n_comm_del' => '%s Pikir �ch�r�ldi',
  'n_comm_disp' => 'Pikir ziyaret sani',
  'see_prev' => 'Aldinqisi',
  'see_next' => 'K�yinkisi',
  'del_comm' => 'Tallan`ghan s�zni �ch�r�ng',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
  0 => 'Alb�mdin izdesh',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
  'page_title' => 'Y�ngidin h�jjet izdesh', //cpg1.3.0
  'select_dir' => 'M�nderijini tallash',
  'select_dir_msg' => 'Bu iqtida sizning FTP arqiliq top h�jjet yolishinigzni qollaydu.<br /><br />Yollimaqchi bolghan top h�jjet m�nderijisini tallang', //cpg1.3.0
  'no_pic_to_add' => 'Qoshulidighan h�jjet yoqken', //cpg1.3.0
  'need_one_album' => 'Bu iqtidarni ishlitishch�n azkem bir alb�m bolsun.',
  'warning' => 'agahlandurush',
  'change_perm' => 'M�nderije qurulmisa, CMOD qimmitini 775 yaki 777 qilip tengshep k�r�ng!', //cpg1.3.0
  'target_album' => '<b>H�jjetni &quot;</b>%s<b>&quot; ge yollang </b>%s', //cpg1.3.0
  'folder' => 'Somka',
  'image' => 'H�jjet',
  'album' => 'Alb�m',
  'result' => 'Netije',
  'dir_ro' => 'Y�klenmidi. ',
  'dir_cant_read' => 'Oqulmidi. ',
  'insert' => 'galleryge y�ngi h�jjet qoshush', //cpg1.3.0
  'list_new_pic' => 'Y�ngi h�jjetler', //cpg1.3.0
  'insert_selected' => 'Tallighan h�jjetni qoshung', //cpg1.3.0
  'no_pic_found' => 'Y�ngi h�jjet t�pilmidi', //cpg1.3.0
  'be_patient' => 'Saqlang, H�jjetni y�kleshke azraq waqt k�tidu.', //cpg1.3.0
  'no_album' => 'Alb�m tallanmidi',  //cpg1.3.0
  'notes' =>  '<ul>'.
                          '<li><b>OK</b> : H�jjet muwapiqiyetlik y�klendi'.
                          '<li><b>DP</b> : H�jjet qaytilan`ghan yaki ambarda bar'.
                          '<li><b>PB</b> : H�jjet Y�klenmeyse, tengshekni yaki munderije cheklimisini teksh�r�p k�r�ng.'.
                          '<li><b>NA</b> : H�jjet alb�mini tallimapsiz, Muqimlash \'<a href="javascript:history.back(1)">Qaytish</a>\' Alb�mni tallang. Alb�mingiz bolmisa <a href="albmgr.php">Alb�m qurung</a></li>'.
                          '<li>Eger OK, DP, PB \'Belgiler\' H�jjet k�r�nmise PHP k�rsetken xataliq uchurini teksh�r�ng.'.
                          '<li>Eger torkez(browser/???)ning waqti �tse qaytidin retleng.'.
                          '</ul>', //cpg1.3.0
  'select_album' => 'Alb�mni tallang', //cpg1.3.0
  'check_all' => 'Hemmini tallang', //cpg1.3.0
  'uncheck_all' => 'Hemmini tallimang', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
  'title' => 'Cheklen`gen Qollanchi',
  'user_name' => 'Qollanchi Nami',
  'ip_address' => 'IP Adr�si',
  'expiry' => 'Ch�ki (Bosh qalsa mengg�l�ktur)',
  'edit_ban' => '�zgirishni saqlash',
  'delete_ban' => '�ch�r�sh',
  'add_new' => 'Cheklen`gen Qollanchi Qoshush',
  'add_ban' => 'Qoshush',
  'error_user' => 'Bundaq qolanchi yoq', //cpg1.3.0
  'error_specify' => 'Qollanchi namini we IP adr�sini kirg�z�ng', //cpg1.3.0
  'error_ban_id' => 'Xata ID!', //cpg1.3.0
  'error_admin_ban' => '�zingizni cheklimekchimu!', //cpg1.3.0
  'error_server_ban' => '�zingizning Mulazim�tirini cheklimekchimu? boldi...boldi.. axmaqliq qilmang!', //cpg1.3.0
  'error_ip_forbidden' => 'Bu IP ni chekliyelmeysiz- ch�nki u, non-routable!', //cpg1.3.0
  'lookup_ip' => 'IP adr�sini teksh�r�sh', //cpg1.3.0
  'submit' => 'Ijra!', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => 'H�jjet y�klesh', //cpg1.3.0
  'custom_title' => 'Y�klesh tallanma jediwili', //cpg1.3.0
  'cust_instr_1' => 'T�wendikilerdin Y�k somkisini tallap y�kleng.', //cpg1.3.0
  'cust_instr_2' => 'Tallanma somka nomuri', //cpg1.3.0
  'cust_instr_3' => 'H�jjet y�klesh somkisi: %s', //cpg1.3.0
  'cust_instr_4' => 'URI/URL Y�k somkisi: %s', //cpg1.3.0
  'cust_instr_5' => 'URI/URL Y�k somkisi:', //cpg1.3.0
  'cust_instr_6' => 'H�jjet Y�k somkisi:', //cpg1.3.0
  'cust_instr_7' => 'Lazmliq Y�k somkisining sanini y�zip ch�king \'Dawami\'. ', //cpg1.3.0
  'reg_instr_1' => 'Inawetsiz paaliyet.', //cpg1.3.0
  'reg_instr_2' => 'H�jjetlerni "t�wendiki y�k somkisi arqiliq yollisingiz bolidu. Y�k hejimi %s KB etrapida. ZIP H�jjet yollinidu \'H�jjet yollash\' we \'URI/URL Yollash\' arqiliq baridu.', //cpg1.3.0
  'reg_instr_3' => 'Eger zipliq yaki zipsiz h�jjetlerni choqum H�jjet yollash arqiliq y�kleng \'ZIPsiz H�jjet y�klesh\' arqiliq Y�klinidu.', //cpg1.3.0
  'reg_instr_4' => 'Eger URI/URL Y�kini tallisingiz, H�jjet ulinishini tallang Mesilen: http://www.mysite.com/images/example.jpg', //cpg1.3.0
  'reg_instr_5' => 'Tallap bolghandin k�yin, Ch�king \'dawami\'.', //cpg1.3.0
  'reg_instr_6' => 'Y�shilme ZIP y�klesh:', //cpg1.3.0
  'reg_instr_7' => 'H�jjet y�klesh:', //cpg1.3.0
  'reg_instr_8' => 'URI/URL Y�ki:', //cpg1.3.0
  'error_report' => 'Xata doklat', //cpg1.3.0
  'error_instr' => 'T�wendikiler uchurghan xataliqlar:', //cpg1.3.0
  'file_name_url' => 'H�jjet ismi/URL', //cpg1.3.0
  'error_message' => 'Xata uchur', //cpg1.3.0
  'no_post' => 'H�jjet y�klenmidi.', //cpg1.3.0
  'forb_ext' => 'Biruxset qoshumche nam.', //cpg1.3.0
  'exc_php_ini' => 'H�jjet php.ini cheklimisidin �ship ketti.', //cpg1.3.0
  'exc_file_size' => 'H�jjet CPG cheklimisidin �ship ketti.', //cpg1.3.0
  'partial_upload' => 'Bir qismila y�klendi.', //cpg1.3.0
  'no_upload' => 'Y�klenmidi.', //cpg1.3.0
  'unknown_code' => 'Biligsiz PHP xata code.', //cpg1.3.0
  'no_temp_name' => 'Y�klenmidi - temp nam yoq.', //cpg1.3.0
  'no_file_size' => 'Mezmun yoq/Corrupted', //cpg1.3.0
  'impossible' => 'Arxipqa yollanmidi.', //cpg1.3.0
  'not_image' => 'Bu �lchemsiz t�ma', //cpg1.3.0
  'not_GD' => 'Bu GD ning yandash nami emes.', //cpg1.3.0
  'pixel_allowance' => 'Bek chong bolup ketti.', //cpg1.3.0
  'incorrect_prefix' => 'URI/URL xata, prefix', //cpg1.3.0
  'could_not_open_URI' => 'URI Qozghulushqa amalsiz.', //cpg1.3.0
  'unsafe_URI' => 'Bixeterlik testiqlanmidi.', //cpg1.3.0
  'meta_data_failure' => 'H�jjetni aylandurush muwapiqiyetsiz', //cpg1.3.0
  'http_401' => '401 Ziyaret tosulghan', //cpg1.3.0
  'http_402' => '402 Pulgha ziyaret qilisiz', //cpg1.3.0
  'http_403' => '403 Ziyaret cheklengen', //cpg1.3.0
  'http_404' => '404 Mualzim�tirdin jawab yoq', //cpg1.3.0
  'http_500' => '500 Mulazim�tirdiki chataq', //cpg1.3.0
  'http_503' => '503 Mulazim�tir uzaq saqlighach mulazimet toxtitildi.', //cpg1.3.0
  'MIME_extraction_failure' => 'MIME Teksh�r�p testiqlanmidi.', //cpg1.3.0
  'MIME_type_unknown' => 'Bilgili bolmas MIME type', //cpg1.3.0
  'cant_create_write' => 'Yazma arxipni qoshqili bolmidi.', //cpg1.3.0
  'not_writable' => 'Yazghili bolmidi.', //cpg1.3.0
  'cant_read_URI' => 'URI/URL lar oqulmidi', //cpg1.3.0
  'cant_open_write_file' => 'URI Qozghatqili bolmidi.', //cpg1.3.0
  'cant_write_write_file' => 'URI ni xatirligili bolmidi.', //cpg1.3.0
  'cant_unzip' => 'Muwapiqiyetsiz unzip.', //cpg1.3.0
  'unknown' => 'Ch�shiniksiz xataliq', //cpg1.3.0
  'succ' => 'Y�klendi', //cpg1.3.0
  'success' => '%s Y�klinip bolun`ghan.', //cpg1.3.0
  'add' => 'Ch�king \'Dawamlashturung\' H�jjet arxipini alb�mgha qoshush.', //cpg1.3.0
  'failure' => 'Y�klenmidi', //cpg1.3.0
  'f_info' => 'H�jjet uchuri', //cpg1.3.0
  'no_place' => 'Y�klime arxipqa saqlanmidi.', //cpg1.3.0
  'yes_place' => 'Y�klime arxipta saqlandi.', //cpg1.3.0
  'max_fsize' => 'Arxipning eng chong ruxset hejimi is %s KB',
  'album' => 'Alb�m',
  'picture' => 'H�jjet', //cpg1.3.0
  'pic_title' => 'H�jjet t�misi', //cpg1.3.0
  'description' => 'H�jjet izahati', //cpg1.3.0
  'keywords' => 'Halqiliq s�z (Bosh orun)',
  'err_no_alb_uploadables' => 'Siz yollighudek alb�m yoq', //cpg1.3.0
  'place_instr_1' => 'H�jjetlerni alb�mgha chaplang.  Siz hazir bu arxipning munasiwetlik uchurlirini kirg�zsingiz bolidu.', //cpg1.3.0
  'place_instr_2' => 'K�pligen h�jjetler Seplinishni k�t�watidu. Ch�king \'Dawamlashturung\'.', //cpg1.3.0
  'process_complete' => 'Qutluq! Hemme h�jjetni muwapiqiyetlik y�klep boldingiz.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
  'title' => 'Qollanchi Tehrirlesh',
  'name_a' => 'Nami kichiktin chonggha',
  'name_d' => 'Nami chongdin kichikke',
  'group_a' => 'Group kichiktin chonggha',
  'group_d' => 'Group chongdin kichikke',
  'reg_a' => 'Tizim waqti y�qindin yiraqqa',
  'reg_d' => 'Tizim waqti yiraqtin y�qin`gha',
  'pic_a' => 'H�jjet sani azdin k�pke',
  'pic_d' => 'H�jjet sani k�ptin azgha',
  'disku_a' => 'Hejimi kichiktin chonggha',
  'disku_d' => 'Hejimi chongdin kichikke',
  'lv_a' => 'Qollanchi ziyariti y�qindin yiraqqa', //cpg1.3.0
  'lv_d' => ' Qollanchi ziyariti yiraqtin y�qin`gha', //cpg1.3.0
  'sort_by' => '`Qollanchi r�ti ',
  'err_no_users' => 'Ezalar matiryal b�ti quruq !',
  'err_edit_self' => '�zingizni arxipini �zgertelmeysiz \'profilingizgha\' k�lip �zgerting',
  'edit' => 'Tehrir',
  'delete' => '�cher',
  'name' => 'Qollanchi nami',
  'group' => 'Group',
  'inactive' => 'Qozghalmighan',
  'operations' => 'Herketlen',
  'pictures' => 'H�jjet', //cpg1.3.0
  'disk_space' => 'Hejimi/ Ch�ki',
  'registered_on' => 'Tizimlatqan waqit',
  'last_visit' => 'Y�ngi ziyaret', //cpg1.3.0
  'u_user_on_p_pages' => '%d Qollanchi %d bet',
  'confirm_del' => 'Bu qollanchini rastla �chiremsiz? \\nBarliq h�jjetlirimu �ch�p k�tidu.', //js-alert //cpg1.3.0
  'mail' => '�mail',
  'err_unknown_user' => 'Siz tallighan Qollanchi mewj�t emes!',
  'modify_user' => 'Qollanchi Tehrirlesh',
  'notes' => 'Diqqet',
  'note_list' => '<li>Im(parol)ni �zgertmisingiz, "Im(parol)" ornini bosh qaldurung.',
  'password' => 'Im(parol)',
  'user_active' => 'Qollanchini aktiplash',
  'user_group' => 'Qollanchi group',
  'user_email' => 'Qollanchi �mail',
  'user_web_site' => 'Qollanchi tor b�ti',
  'create_new_user' => 'Y�ngi eza qoshush',
  'user_location' => 'Qollanchi yurti',
  'user_interests' => 'Qollanchi qiziqishi',
  'user_occupation' => 'Qollanchi kespi',
  'latest_upload' => 'Y�ngi y�k', //cpg1.3.0
  'never' => 'Yoq', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
  'title' => 'Ataman qorali (Resim chong_kichiklikini tengshesh)', //cpg1.3.0
  'what_it_does' => 'Iqtidar',
  'what_update_titles' => 'Arxiptiki ismidin resim arxipini �zgertish.',
  'what_delete_title' => 'T�mini �ch�r�sh',
  'what_rebuild' => 'Qaytidin kichiklitilme we resim chong kichiklikini b�kitish.',
  'what_delete_originals' => 'Qayta tengshelgen resim esli resimning ornini alsun.',
  'file' => 'H�jjet',
  'title_set_to' => 'T�mini �zgertish',
  'submit_form' => 'Muqimlash',
  'updated_succesfully' => 'Y�ngilandi',
  'error_create' => 'Xataliq k�r�ldi',
  'continue' => 'Bashqa resimlerni ijralash',
  'main_success' => 'Bu H�jjet %s Bash resim qilindi', //cpg1.3.0
  'error_rename' => 'Xataliq %s ismini  %s gha �zgertimiz',
  'error_not_found' => 'Bu h�jjet %s T�pilmidi',
  'back' => 'Bash betke qaytish',
  'thumbs_wait' => 'Kichiklitilmini dawamliq y�ngilash yaki resim chong kichiklikini tengshash boliwatidu, Sel saqlang...',
  'thumbs_continue_wait' => 'Continuing to update thumbnails and/or resized images...',
  'titles_wait' => 'T�mini y�ngilawatidu, Sel saqlang...',
  'delete_wait' => 'T�mini �ch�r�watidu, Sel saqlang...',
  'replace_wait' => 'Tengshelgen resim esli resimning ornigha almishiwatidu, sel saqlang..',
  'instruction' => 'Addiy paaliyet ch�shend�rilishi',
  'instruction_action' => 'Paaliyetni tallash',
  'instruction_parameter' => 'parameterni tallash',
  'instruction_album' => 'Alb�mni tallang',
  'instruction_press' => 'ch�king %s',
  'update' => 'Kichiktilmini yaki resim chong_kichiklikini y�ngilash',
  'update_what' => 'Nimini y�ngilaysiz',
  'update_thumb' => 'Peqet kichiklitilminila �lish',
  'update_pic' => 'Peqet Resim chong_kichiklikini tengshesh.',
  'update_both' => 'Kichiklitilme resim hem �lchimini y�ngilash.',
  'update_number' => 'Her ch�kilgende resim sanini belgilesh',
  'update_option' => '(Eger programma ijrasida mesile k�r�lse, Tengshekni t�wenliting.)',
  'filename_title' => 'H�jjet nami &rArr; H�jjet ', //cpg1.3.0
  'filename_how' => 'H�jjet nami qandaq �zgertilidu.',
  'filename_remove' => 'Esli .jpg �ch�r�l�p _ (underscore) gha �zgertilidu.',
  'filename_euro' => 'Bu 2003_11_23_13_20_20.jpg gha �zgertilidu 23/11/2003 13:20',
  'filename_us' => 'Bu 2003_11_23_13_20_20.jpg gha �zgertilidu 11/23/2003 13:20',
  'filename_time' => 'Bu 2003_11_23_13_20_20.jpg gha �zgertilidu 13:20',
  'delete' => 'H�jjet m�nderijisi yaki �lchimini �ch�r�sh', //cpg1.3.0
  'delete_title' => 'H�jjet munderijisini �ch�r�sh.', //cpg1.3.0
  'delete_original' => 'Esli �lchemdiki resimni �ch�r�sh',
  'delete_replace' => 'Eslidiki �lchem �ch�r�l�p y�ngi �lchem qollinilsun.',
  'select_album' => 'Alb�m tallash',
  'delete_orphans' => 'Parche_purat S�zlerni �ch�r�sh(Hemme alb�mdiki)', //cpg1.3.0
  'orphan_comment' => 'Parche_purat S�zler bayqaldi.', //cpg1.3.0
  'delete' => '�cher', //cpg1.3.0
  'delete_all' => 'Hemmini �cher', //cpg1.3.0
  'comment' => 'S�z qaldurung: ', //cpg1.3.0
  'nonexist' => 'Qoshumche qoshulma yoq # ', //cpg1.3.0
  'phpinfo' => 'php uchurini k�rsitish', //cpg1.3.0
  'update_db' => 'San ambirini y�ngilash', //cpg1.3.0
  'update_db_explanation' => 'coppermine ning arxipini y�ngilimaq bolsingiz, �zgertish yaki neshirini y�ngilimaq bolsingiz, Matiryal ambirini y�ngilashni ijra qiling. shundila coppermine ning matiryal ambirigha y�ngidin jedwel qoshulidu. yaki Tengshilidu.', //cpg1.3.0
);

?>