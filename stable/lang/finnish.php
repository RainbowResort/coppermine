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
'lang_name_english' => 'Finnish',  
'lang_name_native' => 'Suomea', 
'lang_country_code' => 'fi', 
'trans_name'=> 'V.Taavila', //the name of the translator - can be a nickname 
'trans_email' => 'quandox@kastema.to', //translator's email address (optional) 
'trans_website' => 'http://', //translator's website (optional) 
'trans_date' => '2003-10-14', //the date the translation was created / last modified 
); 

$lang_charset = 'iso-8859-15';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Su', 'Ma', 'Ti', 'Ke', 'To', 'Pe', 'La');
$lang_month = array('Tammikuu', 'Helmikuu', 'Maaliskuu', 'Huhtikuu', 'Toukokuu', 'Kes�kuu', 'Hein�kuu', 'Elokuu', 'Syyskuu', 'Lokakuu', 'Marraskuu', 'Joulukuu');

// Some common strings
$lang_yes = 'Kyll�';
$lang_no  = 'Ei';
$lang_back = 'TAKAISIN';
$lang_continue = 'JATKA';
$lang_info = 'Info';
$lang_error = 'Virhe';

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
        'random' => 'Satunaiset kuvat', 
        'lastup' => 'Uusimmat kuvat', 
        'lastalb'=> 'Viimeksi p�ivitetyt albumit', 
        'lastcom' => 'Uusimmat komentit', 
        'topn' => 'Katsotuimmat', 
        'toprated' => 'Suosituimmat', 
        'lasthits' => 'Viimeksi tarkasteltu', 
        'search' => 'Haun tulokset', 
        'favpics'=> 'Suosikkikini' 
); 

$lang_errors = array(
	'access_denied' => 'Ei oikeuksia t�lle sivulle.',
	'perm_denied' => 'Ei oikeuksia kyseisen toiminnon suorittamiseen.',
	'param_missing' => 'Scripti� kutsuttu ilman vaadittavia parametrej�.',
	'non_exist_ap' => 'Valittua albumia/kuvaa ei l�ydy !',
	'quota_exceeded' => 'Levytilasi on t�ynn�<br /><br />Levytilasi on t�ynn� [quota]K, kuviesi viev� tila [space]K, lis��m�ll� t�m�n kuvan tilasi koko ylittyisi.',
	'gd_file_type_err' => 'Kun k�yt�t GD:t� sallitut tiedostomuodot ovat JPEG ja PNG.',
	'invalid_image' => 'Kuva on korruptoitunut eik� sit� voi k�sitell� GD:ll�',
	'resize_failed' => 'Ongelma thumbnailien luomisessa.',
	'no_img_to_display' => 'Ei n�yttett�vi� kuvia',
	'non_exist_cat' => 'Valittua kategoriaa ei l�ydy',
	'orphan_cat' => 'Ongelmia kategoriassa, aja kategoria manageri selvit��ksesi ongelma.',
	'directory_ro' => 'Hakemistoon \'%s\' ei ole m��ritelty kirjoitusoikeuksia. Kuvia ei voi poistaa',
	'non_exist_comment' => 'Valittua kommenttia ei l�ydy.',
	'pic_in_invalid_album' => 'Kuvaa ei ole albumissa (%s)!?',
	'banned' => 'Sinulta on ev�tty p��sy t�lle sivulle.', 
    'not_with_udb' => 'T�m� toiminto on poistettu k�yt�st� Coppermine gallerissa koska t�m� on integroitu foorumi ohjelmistoon. Toiminto jota eritit tehd� ei ole tuettuna t�ss� kokoonpanossa, toiminto l�ytyy mahdollisesti foorumi ohjelmistosta.', 
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'Mene albumi listaan',
	'alb_list_lnk' => 'Albumi lista',
	'my_gal_title' => 'Mene omaan galleriaan',
	'my_gal_lnk' => 'Oma galleria',
	'my_prof_lnk' => 'Omat asetukset',
	'adm_mode_title' => 'Vaihda yll�pitotilaan',
	'adm_mode_lnk' => 'Yll�pitotila',
	'usr_mode_title' => 'Vaihda k�ytt�j�tilaan',
	'usr_mode_lnk' => 'K�ytt�j�tila',
	'upload_pic_title' => 'Lis�� kuva albumiin',
	'upload_pic_lnk' => 'Lis�� kuva',
	'register_title' => 'Luo uusi tili',
	'register_lnk' => 'Rekister�idy',
	'login_lnk' => 'Kirjaudu',
	'logout_lnk' => 'Poistu',
	'lastup_lnk' => 'Viimeksi lis�tty',
	'lastcom_lnk' => 'Uusimmat kommentit',
	'topn_lnk' => 'Katsotuimmat',
	'toprated_lnk' => 'Suosituimmat',
	'search_lnk' => 'Haku',
	'fav_lnk' => 'Suosikkini',
	
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Tarkistettavat',
	'config_lnk' => 'Asetukset',
	'albums_lnk' => 'Albumit',
	'categories_lnk' => 'Kategoriat',
	'users_lnk' => 'K�ytt�j�t',
	'groups_lnk' => 'Ryhm�t',
	'comments_lnk' => 'Kommentit',
	'searchnew_lnk' => 'Lis�� "FTP" kuvat',
	'util_lnk' => 'K�sittele Kuvia',
	'ban_lnk' => 'Kiell� K�ytt�ji�',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Luo / muokkaa albumeita',
	'modifyalb_lnk' => 'Muokkaa omaa albumia',
	'my_prof_lnk' => 'Omat asetukset',
);

$lang_cat_list = array(
	'category' => 'Kategoria',
	'albums' => 'Albumit',
	'pictures' => 'Kuvat',
);

$lang_album_list = array(
	'album_on_page' => '%d albumia %d sivu(a)'
);

$lang_thumb_view = array(
	'date' => 'PVM',
	//Sort by filename and title 
    'name' => 'NIMI', 
    'title' => 'OTSIKKO', 
	'sort_da' => 'J�rjest� p�iv�m��ritt�in nousevasti',
	'sort_dd' => 'J�rjest� p�iv�m��ritt�in laskevasti',
	'sort_na' => 'J�rjest� nimell� nousevasti',
	'sort_nd' => 'J�rjest� nimell� laskevasti',
	'sort_ta' => 'J�rjest� otsikolla nousevasti', 
    'sort_td' => 'J�rjest� otsikolla laskevasti',
	'pic_on_page' => '%d kuvaa %d sivu(a)',
	'user_on_page' => '%d k�ytt�j�� %d sivu(a)'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Takaisin thumbnail sivulle',
	'pic_info_title' => 'N�yt�/piilota kuvan tiedot',
	'slideshow_title' => 'diashow',
	'ecard_title' => 'L�het� t�m� kuva e-korttina',
	'ecard_disabled' => 'e-kortit pois p��lt�',
	'ecard_disabled_msg' => 'Sinulla ei ole oikeuksia l�hett�� e-kortteja',
	'prev_title' => 'N�yt� edellinen kuva',
	'next_title' => 'N�yt� seuraava kuva',
	'pic_pos' => 'KUVA %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => '��nest� t�t� kuvaa ',
	'no_votes' => '(ei ��ni� viel�)',
	'rating' => '(nykyinen taso : %s / 5 ja %s ��nt�)',
	'rubbish' => 'Roskaa',
	'poor' => 'Tyls��',
	'fair' => 'Keskinkertainen',
	'good' => 'Hyv�',
	'excellent' => 'Loistava',
	'great' => 'Mahtava',
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
	CRITICAL_ERROR => 'Kriittinen Virhe',
	'file' => 'Tiedosto: ',
	'line' => 'Rivi: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Tiedostonimi : ',
	'filesize' => 'Tiedostokoko : ',
	'dimensions' => 'Tarkkuus : ',
	'date_added' => 'Lis�tty : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s kommenttia',
	'n_views' => '%s tarkastelua',
	'n_votes' => '(%s ��nt�)'
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
	'Exclamation' => 'Huuto',
	'Question' => 'Kysymys',
	'Very Happy' => 'Eritt�in Iloinen',
	'Smile' => 'Hymy',
	'Sad' => 'Suru',
	'Surprised' => 'Yll�ttynyt',
	'Shocked' => 'J�rkyttynyt',
	'Confused' => 'H�keltynyt',
	'Cool' => 'Cool',
	'Laughing' => 'Nauru',
	'Mad' => 'Hullu',
	'Razz' => 'Razz',
	'Embarassed' => 'Embarassed',
	'Crying or Very sad' => 'Itke�',
	'Evil or Very Mad' => 'Eritt�in Hullu',
	'Twisted Evil' => 'Kieroutunut Hullu',
	'Rolling Eyes' => 'Py�riv�t silm�t',
	'Wink' => 'Vink',
	'Idea' => 'Idea',
	'Arrow' => 'Nuoli',
	'Neutral' => 'Neutraali',
	'Mr. Green' => 'Mr. Vihre�',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'Poistuu yll�pitotilasta...',
	1 => 'Sis��n yll�pitotilaan...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Albumi tarvitsee nimen !',
	'confirm_modifs' => 'Haluatko varmasti tehd� n�m� muutokset ?',
	'no_change' => 'Et tehnyt yht��n muutosta !',
	'new_album' => 'Uusi albumi',
	'confirm_delete1' => 'Haluatko varmasti poistaa t�m�n albumin albumin ?',
	'confirm_delete2' => '\nKaikki kuvat ja kommentit tulevat poistumaan !',
	'select_first' => 'Valitse albumi ensin',
	'alb_mrg' => 'Albumi Manageri',
	'my_gallery' => '* Oma galleria *',
	'no_category' => '* Ei kategoriaa *',
	'delete' => 'Poista',
	'new' => 'Uusi',
	'apply_modifs' => 'Hyv�ksy muutokset',
	'select_category' => 'Valitse Kategoria',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Toimintoa \'%s\'ei voitu suorittaa !',
	'unknown_cat' => 'Valittua kategoriaa ei ole en�� tietokannassa',
	'usergal_cat_ro' => 'K�ytt�jien gallerioiden kategorioita ei voi poistaa !',
	'manage_cat' => 'Hallitse kategorioita',
	'confirm_delete' => 'Haluatko varmasti POISTAA t�m�n kategorian',
	'category' => 'Kategoria',
	'operations' => 'Toiminnot',
	'move_into' => 'Siirr�',
	'update_create' => 'P�ivit�/Luo kategoria',
	'parent_cat' => 'P��kategoria',
	'cat_title' => 'Kategorian otsikko',
	'cat_desc' => 'Kategorian tarkenne'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Asetukset',
	'restore_cfg' => 'Palauta oletukset',
	'save_cfg' => 'Tallenna muutokset',
	'notes' => 'Huomio',
	'info' => 'Info',
	'upd_success' => 'Coppermine asetukset p�ivitetty',
	'restore_success' => 'Coppermine oletusasetukset palautettu',
	'name_a' => 'Nimi nousevasti',
	'name_d' => 'Nimi laskevasti',
	'title_a' => 'Otsikko nousevasti', 
    'title_d' => 'Otsikko laskevasti',
	'date_a' => 'P�iv� nousevasti',
	'date_d' => 'P�iv� laskevasti',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Yleiset asetukset',
	array('Gallerian nimi', 'gallery_name', 0),
	array('Gallerian tarkenne', 'gallery_description', 0),
	array('Gallerian yll�pit�j�n s�hk�posti', 'gallery_admin_email', 0),
	array('Kohde osoite \'N�yt� enemm�n kuvia\' linkki e-korteissa', 'ecards_more_pic_target', 0),
	array('Kieli', 'lang', 5),
	array('Teema', 'theme', 6),

	'Albumin "n�ytt�" asetukset',
	array('P��taulukon leveys (pikseleiss� tai %)', 'main_table_width', 0),
	array('Kuinka monta kategoriaa n�ytet��n tasolla', 'subcat_level', 0),
	array('Kuinka monta albumia n�ytet��n sivulla', 'albums_per_page', 0),
	array('Kuinka monta saraketta n�ytet��n albumi listassa', 'album_list_cols', 0),
	array('Thumbnailien koko pikseleiss�', 'alb_list_thumb_size', 0),
	array('Mit� tietoja etusivulla n�ytet��n', 'main_page_layout', 0),
	array('N�yt� ensimm�isen tason albumin thumbnailit kategoriassa','first_level',1),

	'Thumbnailien n�ytt�',
	array('Sarakkeita thumbnail sivulla', 'thumbcols', 0),
	array('Rivej� thumbnail sivulla', 'thumbrows', 0),
	array('Kaistaleiden maksimi m��r�', 'max_tabs', 0),
	array('N�yt� kuvateksti thumbnaileissa', 'caption_in_thumbview', 1),
	array('N�yt� kommenttien m��r� thumbnaileissa', 'display_comment_count', 1),
	array('Kuvien oletus j�rjestys', 'default_sort_order', 3),
	array('Tarvittavien ��nien m��r� ennen \'suosituimmat\' listalle p��sy�', 'min_votes_for_rating', 0),

	'Kuvien n�ytt� &amp; Kommentti asetukset',
	array('Kuvan n�ytt� taulukon leveys (pikselein� tai %)', 'picture_table_width', 0),
	array('Kuvan info oletuksena piilotettu', 'display_pic_info', 1),
	array('Rumasana filtteri', 'filter_bad_words', 1),
	array('Hyv�ksy hymi�t kommentissa', 'enable_smilies', 1),
	array('Kuvatekstin maksimi pituus', 'max_img_desc_length', 0),
	array('Maksimi m��r� merkkej� sanassa', 'max_com_wlength', 0),
	array('Kommentti rivien maksimi m��r�', 'max_com_lines', 0),
	array('Kommentin maksimi pituus', 'max_com_size', 0),
	array('N�yt� thumbnaileja kuva sivulla', 'display_film_strip', 1), 
    array('Thumbnaileja kuva sivulla', 'max_film_strip_items', 0), 

	'Kuvien ja thumbnailien asetukset',
	array('Tarkkuus JPEG tiedostoilla', 'jpeg_qual', 0),
	array('Thumbnail maksimi leveys tai korkeus <b>*</b>', 'thumb_width', 0),
    array('K�yt� mittaa ( leveys tai korkeus tai Maksimi mitta thumbnaileissa )<b>*</b>', 'thumb_use', 7), 
	array('Luo v�liaikaiset kuvat','make_intermediate',1),
	array('V�liaikaiset kuvien maksimi leveys tai korkeus <b>*</b>', 'picture_width', 0),
	array('Ladattavien kuvien maksimi koko (KB)', 'max_upl_size', 0),
	array('Ladattavien kuvien maksimi leveys (pikselein�)', 'max_upl_width_height', 0),

	'K�ytt�j� asetukset',
	array('Salli uusien k�ytt�jien rekister�ity�', 'allow_user_registration', 1),
	array('Rekister�inti vaatii s�hk�posti varmistuksen', 'reg_requires_valid_email', 1),
	array('Salli kahdelle k�ytt�j�lle sama s�hk�posti osoite', 'allow_duplicate_emails_addr', 1),
	array('K�ytt�j�t saavat yksityiset albumit', 'allow_private_albums', 1),

	'Valinnaiset kent�t kuvan n�yt�ss� (j�t� tyhj�ksi jos et halua k�ytt��)',
	array('Kentt� 1 nimi', 'user_field1_name', 0),
	array('Kentt� 2 nimi', 'user_field2_name', 0),
	array('Kentt� 3 nimi', 'user_field3_name', 0),
	array('Kentt� 4 nimi', 'user_field4_name', 0),

	'Kuvien ja thumbnailien lis� asetukset',
	array('N�yt� yksityisessa albumissa Ikoni kirjautumattomalle k�ytt�j�lle','show_private',1),
	array('Kielletyt merkit tiedostonimiss�', 'forbiden_fname_char',0),
	array('Hyv�ksytyt tiedotop��tteet', 'allowed_file_extensions',0),
	array('Kuvien koot muutetaan k�ytt�m�ll�','thumb_method',2),
	array('T�ydellinen ImageMagick polku \'konventteri\' (esimerkiksi /usr/bin/X11/)', 'impath', 0),
	array('Kyv�ksytyt kuva tyypit (kelpaa vain ImageMagickia k�ytett�ess�)', 'allowed_img_types',0),
	array('ImageMagick komentorivin asetukset', 'im_options', 0),
	array('Lue EXIF tiedot JPEG kuvista', 'read_exif_data', 1),
	array('Albumi hakemisto <b>*</b>', 'fullpath', 0),
	array('K�ytt�jien kuvien hakemisto <b>*</b>', 'userpics', 0),
	array('V�liaikaisten kuvien etuliite <b>*</b>', 'normal_pfx', 0),
	array('Thumbnailien etuliite <b>*</b>', 'thumb_pfx', 0),
	array('Hakemistojen oletus oikeudet', 'default_dir_mode', 0),
	array('Kuvien oletus oikeudet', 'default_file_mode', 0),

	'Ev�ste &amp; koodaus asetukset',
	array('Ev�steen nimi', 'cookie_name', 0),
	array('Ev�steen polku', 'cookie_path', 0),
	array('K�ytett�v� koodaus', 'charset', 4),

	'Muut asetukset',
	array('N�yt� palvelimen virheilmoitukset', 'debug_mode', 1),
	
	'<br /><div align="center">(*) Kent�t joissa on * merkki ei saa muuttaa jos galleriassa on jo kuvia.</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Sinun on kirjoitettava nimesi kommenttiin',
	'com_added' => 'Kommenttisi on lis�tty',
	'alb_need_title' => 'Albumin otsikko puuttuu !',
	'no_udp_needed' => 'P�ivitysta ei tarvita.',
	'alb_updated' => 'Albumi p�ivitetty',
	'unknown_album' => 'Valittua albumia ei l�ydy tai sinulla ei ole oikeuksia siihen',
	'no_pic_uploaded' => 'Ei lis�tty� kuvaa !<br /><br />Jos todella valitsit lis�tt�v�n kuvan pyyd� yll�pit�j�� tarkistamaan palvelimen asetukset...',
	'err_mkdir' => 'Virhe hakemiston luomisessa %s !',
	'dest_dir_ro' => 'L�hde hakemisto %s ei ole luettavissa !',
	'err_move' => 'Mahdotonta siirt�� %s - %s !',
	'err_fsize_too_large' => 'Tiedosto jota yritit lis�t� oli liian suuri (suurin sallittu koko %s x %s) !',
	'err_imgsize_too_large' => 'Tiedosto jota yritit lis�t� oli liian suuri (suurin sallittu koko on %s KB) !',
	'err_invalid_img' => 'Tiedosto jota yritit lis�t� ei hyv�ksyt� !',
	'allowed_img_types' => 'Voit lis�t� ainostaan %s kuvia.',
	'err_insert_pic' => 'Kuvaa \'%s\' ei voi liitt�� albumiin ',
	'upload_success' => 'Kuva lis�tty onnistuneesti<br /><br />Se tulee julkiseksi jos yll�pit�j� hyv�ksyy sen.',
	'info' => 'Info',
	'com_added' => 'Kommentti lis�tty',
	'alb_updated' => 'Albumi p�ivitetty',
	'err_comment_empty' => 'Kommenttisi oli tyhj� !',
	'err_invalid_fext' => 'Vain seuraavat tiedostop��tteet ovat sallittuja : <br /><br />%s.',
	'no_flood' => 'Viimeinen kommentti on jo lis�tty<br /><br />Muokkaa kommenttia jos haluat muuttaa sit�',
	'redirect_msg' => 'Sinut siirret��n.<br /><br /><br />Klikkaa \'JATKA\' jos sivu ei p�ivity automaattisesti',
	'upl_success' => 'Kuvasi lis�tty onnistuneesti',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Kuvateksti',
	'fs_pic' => 't�ysikokoinen kuva',
	'del_success' => 'onnistuneesti poistettu',
	'ns_pic' => 'normaali kokoinen kuva',
	'err_del' => 'ei voi poistaa',
	'thumb_pic' => 'thumbnaili',
	'comment' => 'kommentti',
	'im_in_alb' => 'kuva albumissa',
	'alb_del_success' => 'Albumi \'%s\' poistettu',
	'alb_mgr' => 'Albumin Hallinta',
	'err_invalid_data' => 'Virhellist� dataa v�litetty \'%s\'',
	'create_alb' => 'Luodaan albumia \'%s\'',
	'update_alb' => 'P�ivitet��n albumia \'%s\' otsikko \'%s\' ja indeksi \'%s\'',
	'del_pic' => 'Poista kuva',
	'del_alb' => 'Poista albumi',
	'del_user' => 'Poista k�ytt�j�',
	'err_unknown_user' => 'Valittua k�ytt�j�� ei l�ydy !',
	'comment_deleted' => 'Komentti poistettu onnistuneesti',
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
	'confirm_del' => 'Haluatko varmasti POISTAA t�m�n kuvan ? \\nKommentit poistetaan samalla.',
	'del_pic' => 'POISTA T�M� KUVA',
	'size' => '%s x %s pikseli�',
	'views' => '%s kertaa',
	'slideshow' => 'Diashow',
	'stop_slideshow' => 'PYS�YT� DIASHOW',
	'view_fs' => 'Klikkaamalla kuvaa voit tarkastella sit� t�ysikokoisena',
);

$lang_picinfo = array(
	'title' =>'Kuvan tiedot',
	'Filename' => 'Tiedostonimi',
	'Album name' => 'Albumin nimi',
	'Rating' => 'Arvo (%s ��nt�)',
	'Keywords' => 'Hakusanat',
	'File Size' => 'Tiedostokoko',
	'Dimensions' => 'Tarkkuus',
	'Displayed' => 'Tarkasteltu',
	'Camera' => 'Kamera',
	'Date taken' => 'Kuva otettu',
	'Aperture' => 'Aukko',
	'Exposure time' => 'Valotusaika',
	'Focal length' => 'Polttov�li',
	'Comment' => 'Kommentti',
	'addFav'=>'Lis�� suosikkeihin', 
    'addFavPhrase'=>'Suosikit', 
    'remFav'=>'Poista suosikeista',
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => 'Muokkaa kommenttia',
	'confirm_delete' => 'Haluatko varmasti poistaa t�m�n kommentin ?',
	'add_your_comment' => 'Lis�� kommenttisi',
	'name'=>'Nimi', 
    'comment'=>'Komenti', 
	'your_name' => 'Nimesi',
);

$lang_fullsize_popup = array( 
        'click_to_close' => 'Klikkaa kuvaa sulkeaksesi t�m� ikkuna', 
); 

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'l�het� e-kortti',
	'invalid_email' => '<b>Varoitus</b> : virheellinen s�hk�posti osoite!',
	'ecard_title' => 'E-kortti %s sinulle',
	'view_ecard' => 'Jos e-kortti n�kyy virheellisesti klikkaa t�st�',
	'view_more_pics' => 'Klikkaa t�sta n�hd�ksesi lis�� kuvia !',
	'send_success' => 'E-kortti l�hetetty',
	'send_failed' => 'Palvelin ei salli e-korttien l�hetyst�...',
	'from' => 'L�hett�j�',
	'your_name' => 'Nimesi',
	'your_email' => 'S�hk�posti',
	'to' => 'Vastaanottaja',
	'rcpt_name' => 'Vastaanottajan nimi',
	'rcpt_email' => 'Vastaanottaja s�hk�posti',
	'greetings' => 'Terveiset',
	'message' => 'Viesti',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Kuvan&nbsp;tiedot',
	'album' => 'Albumi',
	'title' => 'Otsikko',
	'desc' => 'Tarkenne',
	'keywords' => 'Hakusanat',
	'pic_info_str' => '%sx%s - %sKB - %s tarkastelua - %s ��nt�',
	'approve' => 'Hyv�ksy kuva',
	'postpone_app' => 'Lykk�� vahvistamista',
	'del_pic' => 'Poista kuva',
	'reset_view_count' => 'Nollaa laskuri',
	'reset_votes' => 'Nollaa ��net',
	'del_comm' => 'Poista kommentit',
	'upl_approval' => 'Lis�tyt hyv�ksytt�v�t',
	'edit_pics' => 'Muokkaa kuvia',
	'see_next' => 'N�yt� seuraavat kuvat',
	'see_prev' => 'N�yt� edelliset kuvat',
	'n_pic' => '%s kuvat',
	'n_of_pic_to_disp' => 'Kuinka monta kuvaa n�ytet��n',
	'apply' => 'Hyv�ksy muutokset'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Ryhm�n nimi',
	'disk_quota' => 'Levytila',
	'can_rate' => 'Voi ��nest�� kuvia',
	'can_send_ecards' => 'Voi l�hett�� e-kortteja',
	'can_post_com' => 'Voi kommentoida',
	'can_upload' => 'Voi lis�t� kuvia',
	'can_have_gallery' => 'Voi saada oman gallerian',
	'apply' => 'Hyv�ksy muutokset',
	'create_new_group' => 'Luo uusi ryhm�',
	'del_groups' => 'Poista valitut ryhm�t',
	'confirm_del' => 'Varoitus, kun poistat ryhm�n, k�ytt�j�t ketk� kuuluvat ryhm��n siirret��n \'Rekister�idyt\' ryhm��n !\n\nHaluatko jatkaa ?',
	'title' => 'Muokkaa k�ytt�j� ryhmi�',
	'approval_1' => 'Hyv�ksynt� asetus (1)',
	'approval_2' => 'Hyv�ksynt� asetus (2)',
	'note1' => '<b>(1)</b> Lis�ykset julkiseen albumiin tarvitsevat yll�pidon hyv�ksynn�n',
	'note2' => '<b>(2)</b> Lis�ykset k�ytt�j�n albumiin tarvitsevat yll�pidon hyv�ksynn�n',
	'notes' => 'Huomio'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Tervetuloa !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Haluatko varmasti POISTAA t�m�n albumin ? \\nKaikki kuvat ja kommentit poistetaan my�s.',
	'delete' => 'POISTA',
	'modify' => 'MUOKKAA',
	'edit_pics' => 'MUOKKAA KUVIA',
);

$lang_list_categories = array(
	'home' => 'Etusivu',
	'stat1' => '<b>[pictures]</b> kuvaa <b>[albums]</b> albumia ja <b>[cat]</b> kategoriaa sek� <b>[comments]</b> kommentia. Kuvia tarkasteltu <b>[views]</b> kertaa',
	'stat2' => '<b>[pictures]</b> kuvaa <b>[albums]</b> albumia tarkasteltu <b>[views]</b> kertaa',
	'xx_s_gallery' => '%s\'s Galleria',
	'stat3' => '<b>[pictures]</b> kuvaa <b>[albums]</b> albumia jossa <b>[comments]</b> kommenttia. Kuvia tarkasteltu <b>[views]</b> kertaa'
);

$lang_list_users = array(
	'user_list' => 'K�ytt�j� lista',
	'no_user_gal' => 'Ei ole k�ytt�ji� joilla oikeus albumiin',
	'n_albums' => '%s albumi(t)',
	'n_pics' => '%s kuva(a)'
);

$lang_list_albums = array(
	'n_pictures' => '%s kuvaa',
	'last_added' => ', viimeisin lis�tty %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Sis��n',
	'enter_login_pswd' => 'Kirjoita tunnus ja salasana kirjautuaksesi',
	'username' => 'Tunnus',
	'password' => 'Salasana',
	'remember_me' => 'Muista minut',
	'welcome' => 'Tervetuloa %s ...',
	'err_login' => '*** Virhe kirjautuessa - yrit� uudelleen ***',
	'err_already_logged_in' => 'Olet jo kirjautunut !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Poistu',
	'bye' => 'N�kemiin %s ...',
	'err_not_loged_in' => 'Et ole kirjautuneena !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'P�ivit� albumi %s',
	'general_settings' => 'Yleiset asetukset',
	'alb_title' => 'Albumin otsikko',
	'alb_cat' => 'Albumin kategoria',
	'alb_desc' => 'Albumin tarkenne',
	'alb_thumb' => 'Albumi thumbnailit',
	'alb_perm' => 'Albumin oikeudet',
	'can_view' => 'Albumia voi tarkastella',
	'can_upload' => 'Vierailijat voivat lis�t� kuvia',
	'can_post_comments' => 'Vierailijat voivat kommentoida',
	'can_rate' => 'Vier�ilijat voivat arvostella',
	'user_gal' => 'K�ytt�j�n Galleria',
	'no_cat' => '* Ei kategoriaa *',
	'alb_empty' => 'Albumi on tyhja',
	'last_uploaded' => 'Viimeksi lis�tty',
	'public_alb' => 'Kaikki (julkinen albumi)',
	'me_only' => 'Min� ainoastaan',
	'owner_only' => 'Albumin omistaja (%s) ainoastaan',
	'groupp_only' => 'J�senet ryhm�st� \'%s\' ',
	'err_no_alb_to_modify' => 'Ei muokattavia albumeita tietokannassa.',
	'update' => 'P�ivit� albumi'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Olet jo arvostellut t�m�n kuvan',
	'rate_ok' => '��nesi hyv�ksytty',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Sivuston {SITE_NAME} yll�pit�j�t poistavat kaiken sopimattoman materiaalin niin nopeasti kuin mahdollista. S�hk�posti osoitteen on oltava toimiva koska asetuksista riippuen saatat joutua aktivoimaan tilisi s�hk�postin v�lityksell�.<br />
<br />
Hyv�ksym�ll� t�m�n sopimuksen sitoudut olemaan l�hett�m�tt� laitonta, seksuaalista tai muuten sopimatonta materiaalia muuten {SITE_NAME} yll�pit�j�t ovat tapauksen sattuessa oikeutettu poistamaan kuvat sek� tunnuksesi varoituksetta.<br />
<br />
Sivu k�ytt�� ev�steit� tallentamaa informaatiota. Ev�steiden tarkoitus on ainoastaa helpottaa sivun k�ytt��. S�hk�posti osoitetta ei luovuteta ulkopuolisten tietoon tarkoituksellisesti.<br />
<br />
Klikkaamalla 'Hyv�ksyn' hyv�ksyt n�m� s��nn�t.
EOT;

$lang_register_php = array(
	'page_title' => 'Rekister�inti',
	'term_cond' => 'K�ytt�sopimus',
	'i_agree' => 'Hyv�ksyn',
	'submit' => 'L�het� rekister�inti',
	'err_user_exists' => 'Tunnus on jo k�yt�ss�, ole hyv� ja valitse toinen',
	'err_password_mismatch' => 'Salasanat eiv�t t�sm��',
	'err_uname_short' => 'Tunnuksen on oltava v�hint��n 2 merkki� pitk�',
	'err_password_short' => 'Salasanan on oltava v�hint��n 2 merkki� pitk�',
	'err_uname_pass_diff' => 'Tunnuksen ja salasanan on oltava eri',
	'err_invalid_email' => 'S�hk�posti osoite on virhellinen',
	'err_duplicate_email' => 'Joku on jo rekister�itynyt samalla s�hk�posti osoitteella',
	'enter_info' => 'Lis�� rekister�inti tiedot',
	'required_info' => 'Pakolliset tiedot',
	'optional_info' => 'Vapaaehtoiset tiedot',
	'username' => 'K�ytt�j�nimi',
	'password' => 'Salasana',
	'password_again' => 'Salasana uudestaan',
	'email' => 'S�hk�posti',
	'location' => 'Sijainti',
	'interests' => 'Kiinnostukset',
	'website' => 'Kotisivu',
	'occupation' => 'Koulutus',
	'error' => 'VIRHE',
	'confirm_email_subject' => '%s - Rekister�inti tiedot',
	'information' => 'Info',
	'failed_sending_email' => 'Rekister�innin varmistavaa s�hk�postia ei voi l�hett��!',
	'thank_you' => 'Kiitos rekister�itymisest�.<br /><br />Tilisi t�ytyy viel� aktivoida. Valitsemaasi s�hk�posti osoitteeseen on l�hetty ohjeet k�ytt�j�tilisi aktivointiin.',
	'acct_created' => 'K�ytt�j�tilisi on nyt luotu. Voit kirjautua sis��n k�ytt�m�ll� tunnustasi sek� salasanaasi',
	'acct_active' => 'K�ytt�j�tilisi on nyt aktivoitu. Voit kirjautua sis��n k�ytt�m�ll� tunnustasi sek� salasanaasi',
	'acct_already_act' => 'Tilisi on jo aktiivinen !',
	'acct_act_failed' => 'Tili�si ei voi aktivoida !',
	'err_unk_user' => 'Valittua k�ytt�j�� ei l�ydy !',
	'x_s_profile' => '%s\' asetukset',
	'group' => 'Ryhm�',
	'reg_date' => 'Liittynyt',
	'disk_usage' => 'Levyn k�ytt�',
	'change_pass' => 'Vaihda salasana',
	'current_pass' => 'Nykyinen salasana',
	'new_pass' => 'uusi salasana',
	'new_pass_again' => 'Uusi salasana uudestaan',
	'err_curr_pass' => 'Nykyinen salasana v��rin',
	'apply_modif' => 'Hyv�ksy muutokset',
	'change_pass' => 'Vaihda salasana',
	'update_success' => 'Profiilisi p�ivitetty',
	'pass_chg_success' => 'Salasanasi vaihdettu',
	'pass_chg_error' => 'Salasanaasi ei vaihdettu',
);

$lang_register_confirm_email = <<<EOT
Kiitos rekister�itymisest� {SITE_NAME} sivulle.

Tunnus : "{USER_NAME}"
Salasana : "{PASSWORD}"

Sinun on aktivoitava tilisi, tarvitsee vain klikata alla olevaa linkki�
tai leikkaa/liit� (copy/paste) se www selaimeesi.

{ACT_LINK}

Terveisin,

Sivun {SITE_NAME} yll�pit�j�.

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'N�yt� kommentit',
	'no_comment' => 'Ei kommentteja',
	'n_comm_del' => '%s kommentti poistettu',
	'n_comm_disp' => 'Kuinka monta kommenttia n�ytet��n',
	'see_prev' => 'Edellinen',
	'see_next' => 'Seuraava',
	'del_comm' => 'Poista valitut kommentit',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Hae kuva',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Etsi uusia kuvia',
	'select_dir' => 'Valitse hakemisto',
	'select_dir_msg' => 'Voit lis�t� FTP:ll� lis�tyt kuvat hakemistoihin<br /><br />Valitse hakemisto johon laitoit kuvat',
	'no_pic_to_add' => 'Ei lis�tt�vi� kuvia',
	'need_one_album' => 'Tarvitset v�hint��n yhden albumin voidaksesi k�ytt�� toimintoa',
	'warning' => 'Varoitus',
	'change_perm' => 'scripti ei voi kirjoittaa t�h�n hakemistoon. Oikeuksien t�ytyy olla 755 tai 777 ennen kuin yrit�t lis�t� kuvia !',
	'target_album' => '<b>Laita kuvat hakemistosta &quot;</b>%s<b>&quot;</b>%s albumiin',
	'folder' => 'Hakemisto',
	'image' => 'Kuva',
	'album' => 'Albumi',
	'result' => 'Tulos',
	'dir_ro' => 'Ei kirjoitettavissa. ',
	'dir_cant_read' => 'Ei luettavissa. ',
	'insert' => 'Lis�t��n uusia kuvia galleriaan',
	'list_new_pic' => 'Lista uusista kuvista',
	'insert_selected' => 'Lis�� valitut kuvat',
	'no_pic_found' => 'Uusia kuvia ei l�ytynyt',
	'be_patient' => 'Odota hetki. Menee pikkuisen aikaa kuvien k�sittelyss�',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : tarkoittaa kuva lis�tty onnistuneesti'.
				'<li><b>DP</b> : tarkoittaa kuva on jo aiemmin lis�tty'.
				'<li><b>PB</b> : tarkoittaa kuvaa ei voitu lis�t�, tarkista asetukset ja oikeudet'.
				'<li>Jos OK, DP, PB \'merkit\' eiv�t ilmesty klikkaa rikkin�ist� kuvaa n�hd�ksesi PHP: virheilmoituksen'.
				'<li>Jos selaimesi menee timeouttiin, lataa sivu uudestaan'.
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
                'title' => 'Kiell� K�tt�ji�', 
                'user_name' => 'K�ytt�j�nimi', 
                'ip_address' => 'IP Osoite', 
                'expiry' => 'P��ttyy (tyhj� jos pysyv�)', 
                'edit_ban' => 'Tallenna Muutokset', 
                'delete_ban' => 'Poista', 
                'add_new' => 'Lis�� uusi esto', 
                'add_ban' => 'Lis��', 
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'Lis�� kuva',
	'max_fsize' => 'Suurin sallittu tiedostokoko %s KB',
	'album' => 'Albumi',
	'picture' => 'Kuva',
	'pic_title' => 'Kuvan otsikko',
	'description' => 'Kuvan tarkenne',
	'keywords' => 'Hakusana (erota v�lily�nnill�)',
	'err_no_alb_uploadables' => 'Ei albumeita joille oikeus lis�t� kuvia',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Muokkaa k�ytt�ji�',
	'name_a' => 'Nimell� nousevasti',
	'name_d' => 'Nimell� laskevasti',
	'group_a' => 'Ryhmitt�in nousevasti',
	'group_d' => 'Ryhmitt�in laskevasti',
	'reg_a' => 'Rekister�inti p�iv�ll� nousevasti',
	'reg_d' => 'Rekister�inti p�iv�ll� laskevasti',
	'pic_a' => 'Kuvien m��r�ll� nousevasti',
	'pic_d' => 'Kuvien m��r�ll� laskevasti',
	'disku_a' => 'Levyn k�ytt� nousevasti',
	'disku_d' => 'Levyn k�ytt� laskevasti',
	'sort_by' => 'J�rjest� k�ytt�j�t',
	'err_no_users' => 'K�ytt�j�taulu on tyhj� !',
	'err_edit_self' => 'Et voi muokata profiiliasi t��lt� \'Omat asetukset\' linkist� p��set tekem��n sen',
	'edit' => 'MUOKKAA',
	'delete' => 'POISTA',
	'name' => 'Tunnus',
	'group' => 'Ryhm�',
	'inactive' => 'Passiivinen',
	'operations' => 'Toiminto',
	'pictures' => 'Kuvat',
	'disk_space' => 'Tilaa k�ytetty / Maksimi',
	'registered_on' => 'Rekister�itynyt',
	'u_user_on_p_pages' => '%d k�ytt�j�� %d sivu(a)',
	'confirm_del' => 'Haluatko varmasti POISTAA t�m�n k�ytt�j�n ? \\nKaikki albumit ja kuvat poistuvat my�s.',
	'mail' => 'POSTI',
	'err_unknown_user' => 'Valittua k�ytt�j�� ei l�ydy !',
	'modify_user' => 'Muokkaa k�ytt�j��',
	'notes' => 'Huomio',
	'note_list' => '<li>Jos et halua vaihtaa salasanaa, j�t� "salasana" kentt� tyhj�ksi',
	'password' => 'Salasana',
	'user_active' => 'K�ytt�j� aktiivinen',
	'user_group' => 'K�ytt�j�n ryhm�',
	'user_email' => 'K�ytt�j�n s�hk�posti',
	'user_web_site' => 'K�ytt�j�n kotisivu',
	'create_new_user' => 'Luo uusi k�ytt�j�',
	'user_location' => 'K�ytt�j�n sijainti',
	'user_interests' => 'K�ytt�j�n kiinnostukset',
	'user_occupation' => 'K�ytt�j�n koulutus',
);

// ------------------------------------------------------------------------- // 
// File util.php 
// ------------------------------------------------------------------------- // 

if (defined('UTIL_PHP')) $lang_util_php = array( 
        'title' => 'Pienenn� kuvia', 
        'what_it_does' => 'Ominaisuudet', 
        'what_update_titles' => 'P�ivitt�� otsikot tiedostonimiin', 
        'what_delete_title' => 'Poistaa otsikot', 
        'what_rebuild' => 'Tekee uudet thumbnailit ja pienent�� kuvat', 
        'what_delete_originals' => 'Poistaa alkuper�isen kokoiset kuvat ja korvaa ne pienennetyill� versioilla', 
        'file' => 'Tiedosto', 
        'title_set_to' => 'otsikon asetti', 
        'submit_form' => 'l�het�', 
        'updated_succesfully' => 'p�ivitetty onnistuneesti', 
        'error_create' => 'VIRHE tapahtumassa', 
        'continue' => 'K�sittele lis�� kuvia', 
        'main_success' => 'Tiedostoa %s on onnistuneesti k�ytetty p��kuvana', 
        'error_rename' => 'Virhe uudelleen nime�misess� %s ei voitu nimet� %s', 
        'error_not_found' => 'Tiedostoa %s ei l�ydy', 
        'back' => 'takaisin', 
        'thumbs_wait' => 'P�ivit�� thumbnaileja ja/tai pienent�� kuvia, odota hetki...', 
        'thumbs_continue_wait' => 'Jatkaa thumbnailien p�ivitt�mist� ja/tai kuvien pienent�mist�...', 
        'titles_wait' => 'P�ivitt�� otsikoita, odota hetki...', 
        'delete_wait' => 'Poistaa otsikoita, odota hetki...', 
        'replace_wait' => 'Poistaa alkuper�isia kuvia ja korvaa ne pienennetyill�, odota hetki..', 
        'instruction' => 'Pikaohje', 
        'instruction_action' => 'Valitse toiminto', 
        'instruction_parameter' => 'Aseta arvot', 
        'instruction_album' => 'Valitse albumi', 
        'instruction_press' => 'Paina %s', 
        'update' => 'P�ivit� thumbnailit ja/tai pienenn� kuvat', 
        'update_what' => 'Mit� p�ivitet��n', 
        'update_thumb' => 'Ainoastaan thumbnailit', 
        'update_pic' => 'Pienennet��n pelk�t kuvat', 
        'update_both' => 'Pienennet��n kuvat ja p�ivitet��n thumbnailit', 
        'update_number' => 'Kuinka monta kuvaa k�sitell��n joka klikkauksella', 
        'update_option' => '(Kokeile s��t�� toimintoa pienemm�lle jos tulee timeout ongelmia)', 
        'filename_title' => 'Tiedostonimi ? Kuvan otsikko', 
        'filename_how' => 'Kuinka tiedostonimet muokatann', 
        'filename_remove' => 'Poista .jpg p��te ja korvaa v�lit _ (alleviivaus)', 
        'filename_euro' => 'Muuta 2003_11_23_13_20_20.jpg t�mm�iseksi 23/11/2003 13:20', 
        'filename_us' => 'Muuta 2003_11_23_13_20_20.jpg t�mm�iseksi 11/23/2003 13:20', 
        'filename_time' => 'Muuta 2003_11_23_13_20_20.jpg t�mm�iseksi 13:20', 
        'delete' => 'Poista otsikot tai alkuper�isen kokoiset kuvat', 
        'delete_title' => 'Poista kuvien otsikot', 
        'delete_original' => 'Poista alkuper�isen kokoiset kuvat', 
        'delete_replace' => 'Poistaa alkuper�iset kuvat ja korvaa ne pienennetyill� versioilla', 
        'select_album' => 'Valitse albumi', 
); 

?>