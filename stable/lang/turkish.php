<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery v1.1 Beta 2                                     //
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
//  Translation by Mustafa Tolga YILMAZ <mtolgay@yahoo.com>                  //
//  http://deermaker.cjb.net/                                                //
//  Translation Version 1.0 Alpha 2                                          //
// ------------------------------------------------------------------------- //

// info about translators and translated language 
$lang_translation_info = array( 
'lang_name_english' => 'Turkish',  //the name of your language in English, e.g. 'Greek' or 'Spanish' 
'lang_name_native' => 'T�rk�e', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa�ol' 
'lang_country_code' => 'tr', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es' 
'trans_name'=> 'Mustafa Tolga YILMAZ', //the name of the translator - can be a nickname 
'trans_email' => 'mtolgay@yahoo.com', //translator's email address (optional) 
'trans_website' => 'http://www.fiat.web.tr/', //translator's website (optional) 
'trans_date' => '2003-10-02', //the date the translation was created / last modified 
); 

$lang_charset = 'windows-1254';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bayt', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Paz', 'Pzt', 'Sal', '�r�', 'Pr�', 'Cum', 'Cmt');
$lang_month = array('Oca', '�ub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Au�', 'Eyl', 'Eki', 'Kas', 'Ara');

// Some common strings
$lang_yes = 'Evet';
$lang_no  = 'Hay�r';
$lang_back = 'GER�';
$lang_continue = '�LER�';
$lang_info = 'Bilgi';
$lang_error = 'Hata';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%d %B %Y';
$lastcom_date_fmt =  '%d/%m/%y saat %H:%M';
$lastup_date_fmt = '%d %B %Y';
$register_date_fmt = '%d %B %Y';
$lasthit_date_fmt = '%d %B %Y at %H:%M';
$comment_date_fmt =  '%d %B %Y at %H:%M';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*', '*sik*', 'am*', 'yarrak', 'yarak', 'orospu');

$lang_meta_album_names = array( 
        'random' => 'Rasgele resimler', 
        'lastup' => 'Son eklenenler', 
        'lastalb'=> 'Son g�ncellenen alb�mler', 
        'lastcom' => 'Son yorumlar', 
        'topn' => 'En �ok izlenen', 
        'toprated' => 'En �ok oylanan', 
        'lasthits' => 'En son izlenen', 
        'search' => 'Arama sonu�lar�', 
        'favpics'=> 'S�k Kullan�lan Resimler' 
);

$lang_errors = array(
	'access_denied' => 'Bu sayfay� g&ouml;r&uuml;nt&uuml;lemeye izniniz yok.',
	'perm_denied' => 'Bu i�lemi y&uuml;r&uuml;tmeye izniniz yok.',
	'param_missing' => 'Program� �al��t�rmak i�in yetersiz komut(lar).',
	'non_exist_ap' => '�e�ilmi� olan Alb&uuml;m/Resim yok !',
	'quota_exceeded' => 'Disk kotas� a��ld�<br /><br />Sizin �u an ki alan�n�z [quota]K, resimleriniz [space]K alan kapl�yor, bu resim eklenseydi kotan�z� a�m�� olacakt�n�z.',
	'gd_file_type_err' => 'GD Resim K&uuml;t&uuml;phanesini kullan�rken ge�erli olan resim tipleri JPG ve PNG.',
	'invalid_image' => 'Y&uuml;kledi�iniz resim ya bozuk ya da GD K&uuml;t&uuml;phanesi taraf�ndan tan�mlanam�yor.',
	'resize_failed' => 'K&uuml;�&uuml;k resim veya d&uuml;�&uuml;k boyutlu resim olu�turulam�yor.',
	'no_img_to_display' => 'G&ouml;sterilecek resim yok',
	'non_exist_cat' => 'Se�ilmi� olan kategori yok',
	'orphan_cat' => 'Bir kategorinin ana dal� yok, bu sorunu haletmek i�in Kategori Y&ouml;neticisini �al��t�r�n.',
	'directory_ro' => 'Dizin \'%s\'  e yaz�labilir de�il, resimler silinemiyor',
	'non_exist_comment' => '�e�ilmi� olan yorum yok.',
        'pic_in_invalid_album' => 'Resim var olmayan bir alb�mde (%s)!?',
        'banned' => 'Bu siteyi �imdlik kullanman�z yasaklanm��t�r.', 
        'not_with_udb' => 'Bu fonksiyon Coppermine\'da iptal edilmi�tir ��nk� forum yaz�l�m� ile birle�tirilmi�tir. Denemek istedi�iniz ya bu konfigurasyon ile desteklenmiyor veyahut bu fonksiyon forum yaz�l�m� taraf�ndan uygulanacak.', 
); 

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'Alb&uuml;m listesine git',
	'alb_list_lnk' => 'Alb&uuml;m listesi',
	'my_gal_title' => 'Ki�isel galerime git',
	'my_gal_lnk' => 'Ki�isel Galerim',
	'my_prof_lnk' => 'My profile',
	'adm_mode_title' => 'Y&ouml;netici konumuna ge�i� yap',
	'adm_mode_lnk' => 'Y&ouml;netici konumu',
	'usr_mode_title' => 'Kullan�c� konumuna ge�i� yap',
	'usr_mode_lnk' => 'Kullan�c� konumu',
	'upload_pic_title' => 'Bir resimi bir alb&uuml;me y&uuml;kle',
	'upload_pic_lnk' => 'Resim y&uuml;kle',
	'register_title' => 'Bir hesap olu�tur',
	'register_lnk' => 'Kay�t ol',
	'login_lnk' => 'Giri�',
	'logout_lnk' => '��k��',
	'lastup_lnk' => 'Son y&uuml;klenenler',
	'lastcom_lnk' => 'Son yorumlar',
	'topn_lnk' => 'En �ok izlenenler',
	'toprated_lnk' => 'En �ok oy alanlar',
	'search_lnk' => 'Ara',
        'fav_lnk' => 'S�k Kullan�lanlar', 
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Y&uuml;kleme izini',
	'config_lnk' => 'Se�enekler',
	'albums_lnk' => 'Alb&uuml;mler',
	'categories_lnk' => 'Kategoriler',
	'users_lnk' => 'Kullan�c�lar',
	'groups_lnk' => 'Gruplar',
	'comments_lnk' => 'Yorumlar',
	'searchnew_lnk' => 'K&uuml;me resimleri ekle',
        'util_lnk' => 'Resimleri boyutland�r', 
        'ban_lnk' => 'Kullan�c�lar� yasakla', 
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Olu�tur veya alb&uuml;mleri iste',
	'modifyalb_lnk' => 'Alb&uuml;mlerde de�i�iklik yap',
	'my_prof_lnk' => 'Profilim',
);

$lang_cat_list = array(
	'category' => 'Kategori',
	'albums' => 'Alb&uuml;mler',
	'pictures' => 'Resimler',
);

$lang_album_list = array(
	'album_on_page' => '%d alb&uuml;m&uuml;n&uuml;z %d sayfadad�r'
);

$lang_thumb_view = array(
	'date' => 'TAR�H',
        //Sort by filename and title 
        'name' => 'DOSYA ADI', 
        'title' => 'BA�LIK',
	'sort_da' => 'Tarihi k&uuml;�&uuml;kten b&uuml;y&uuml;y&uuml;�e s�rala',
	'sort_dd' => 'Tarihi b&uuml;y&uuml;kten k&uuml;�&uuml;y&uuml;�e s�rala',
	'sort_na' => 'Ad� k&uuml;�&uuml;kten b&uuml;y&uuml;y&uuml;�e s�rala',
	'sort_nd' => 'Ad� b&uuml;y&uuml;kten k&uuml;�&uuml;y&uuml;�e s�rala',
        'sort_ta' => 'Ba�l��a g�re k���kten b�y��e diz', 
        'sort_td' => 'Ba�l��a g�re b�y�kten k����e diz', 
	'pic_on_page' => '%d resim %d sayfadad�r',
	'user_on_page' => '%d kullan�c� %d sayfadad�r'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'K&uuml;�&uuml;k resim sayfas�na geri d&ouml;n',
	'pic_info_title' => 'Resmi bilgilerine g&ouml;ster/sakla',
	'slideshow_title' => 'G&ouml;steri',
	'ecard_title' => 'Bu resimi e-Kart olarak yolla',
	'ecard_disabled' => 'e-Kart iptal edilmi�tir',
	'ecard_disabled_msg' => 'e-Kart g&ouml;ndermeye izininiz yok',
	'prev_title' => '&Ouml;nceki resime bak',
	'next_title' => 'Bir sonraki resime bak',
	'pic_pos' => 'RES�M %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Bu resimi oylay�n ',
	'no_votes' => '(Oy yok �imdilik)',
	'rating' => '(�u anki durum : %s / 5 ile %s oy)',
	'rubbish' => 'Sa�ma',
	'poor' => 'Yetersiz',
	'fair' => 'Orta',
	'good' => '�yi',
	'excellent' => 'M&uuml;kemmel',
	'great' => 'Harikulade',
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
	CRITICAL_ERROR => 'Ciddi hata',
	'file' => 'Dosya: ',
	'line' => 'Sat�r: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Dosya ad� : ',
	'filesize' => 'Dosya boyutu : ',
	'dimensions' => 'Boyutlar� : ',
	'date_added' => 'Eklenme tarihi : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s yorum',
	'n_views' => '%s g&ouml;r&uuml;nt&uuml;leme',
	'n_votes' => '(%s oy)'
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
	'Exclamation' => '&Uuml;nlem',
	'Question' => 'Soru',
	'Very Happy' => '�ok mutlu',
	'Smile' => 'G&uuml;l',
	'Sad' => 'Mutsuz',
	'Surprised' => '�a��rm��',
	'Shocked' => 'Sars�lm��',
	'Confused' => 'Confused',
	'Cool' => 'S&uuml;per',
	'Laughing' => 'G&uuml;lerek',
	'Mad' => 'Deli',
	'Razz' => 'Razz',
	'Embarassed' => 'Utanm��',
	'Crying or Very sad' => 'A�lamak veya �ok mutsuz',
	'Evil or Very Mad' => 'Bela veya �ok deli',
	'Twisted Evil' => 'Cilveli Bela',
	'Rolling Eyes' => 'Yuvarlanan G&ouml;zler',
	'Wink' => 'G&ouml;z k�rpma',
	'Idea' => 'Fikir',
	'Arrow' => 'Ok',
	'Neutral' => 'Tarafs�z',
	'Mr. Green' => 'Bay Ye�il',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'Y&ouml;netici konumu kapat�l�yor...',
	1 => 'Y&ouml;netici konumu a��l�yor...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Alb&uuml;mleri isim vermelisiniz !',
	'confirm_modifs' => 'Bu de�i�iklikleri uygulamak istedi�inizden eminmisiniz ?',
	'no_change' => 'Herhangi bir de�i�klik yap�lmad� !',
	'new_album' => 'Yeni Alb&uuml;m',
	'confirm_delete1' => 'Bu alb&uuml;m&uuml; silmek istedi�inizden emin misiniz ?',
	'confirm_delete2' => '\n��erdi�i b&uuml;t&uuml;n resim ve yorumlar silinecektir !',
	'select_first' => '&Ouml;nce bir alb&uuml;m se�in',
	'alb_mrg' => 'Alb&uuml;m Y&ouml;neticisi',
	'my_gallery' => '* Benim Galerim *',
	'no_category' => '* Kategori Yok *',
	'delete' => 'Sil',
	'new' => 'Yeni',
	'apply_modifs' => 'De�i�iklikleri uygula',
	'select_category' => 'Kategori se�in',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => '\'%s\' i�in komutlar gerekli i�lem yap�lamad� !',
	'unknown_cat' => 'Se�ilmi� olan kategori veritaban�nda bulunamad�',
	'usergal_cat_ro' => 'Kullan�c� galerileri silinemez !',
	'manage_cat' => 'Kategorileri d&uuml;zenle',
	'confirm_delete' => 'Bu kategoriyi S�LMEK istedi�inizden eminmisiniz ?',
	'category' => 'Kategori',
	'operations' => '��lemler',
	'move_into' => 'S&uuml;r&uuml;kle',
	'update_create' => 'Kategori olu�tur/g&uuml;ncelle',
	'parent_cat' => 'Ana kategori',
	'cat_title' => 'Kategori ba�l���',
	'cat_desc' => 'Kategori a��klamas�'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Se�enekler',
	'restore_cfg' => 'Ayarlar� s�f�rla',
	'save_cfg' => 'Yeni se�enekleri kaydet',
	'notes' => 'Notlar',
	'info' => 'Bilgi',
	'upd_success' => 'Coppermine se�enekleri g&uuml;ncellendi',
	'restore_success' => 'Coppermine ayarlar� s�f�rland�',
	'name_a' => 'Ad k&uuml;�&uuml;kten b&uuml;y&uuml;y&uuml;�e',
	'name_d' => 'Ad b&uuml;y&uuml;kten k&uuml;�&uuml;y&uuml;�e',
	'date_a' => 'Tarih k&uuml;�&uuml;kten b&uuml;y&uuml;y&uuml;�e',
	'date_d' => 'Date b&uuml;y&uuml;kten k&uuml;�&uuml;y&uuml;�e',,
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
        'title_a' => 'Ba�l�k k���kten b�y��e', 
        'title_d' => 'Ba�l�k b�y�kten k����e',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Genel Se�enekler',
	array('Galeri �smi', 'gallery_name', 0),
	array('Galeri A��klamas�', 'gallery_description', 0),
	array('Galeri Y&ouml;neticisi e-Posta', 'gallery_admin_email', 0),
	array('\'See more pictures\' hedef adres ba�lant�s� e-Kartlar i�inde', 'ecards_more_pic_target', 0),
	array('Dil', 'lang', 5),
	array('Aray&uuml;z', 'theme', 6),

	'Alb&uuml;m liste g&ouml;r&uuml;nt&uuml;s&uuml;',
	array('Ana tablonun geni�li�i (piksel veya %)', 'main_table_width', 0),
	array('G&ouml;sterilecek olan kategori d&uuml;zeylerinin say�s�', 'subcat_level', 0),
	array('G&ouml;sterilecek alb&uuml;mlerin say�s�', 'albums_per_page', 0),
	array('Alb&uuml;m listesi i�in s&uuml;tun say�s�', 'album_list_cols', 0),
	array('K&uuml;�&uuml;k resimlerin boyutu piksel olarak', 'alb_list_thumb_size', 0),
	array('Ana sayfan�n i�eri�i', 'main_page_layout', 0),
        array('Birinci seviye alb�mlerin k���k resimlerini kategorilerde g�ster','first_level',1), 

	'K&uuml;�&uuml;k resim g&ouml;r&uuml;nt&uuml;s&uuml;',
	array('K&uuml;�&uuml;k resim sayfas�ndaki s&uuml;tun say�s�', 'thumbcols', 0),
	array('K&uuml;�&uuml;k resim sayfas�ndaki s�ra say�s�', 'thumbrows', 0),
	array('En �ok g&ouml;sterilecek etiket say�s�', 'max_tabs', 0),
	array('Resim man�et ba�l���n� k&uuml;�&uuml;k resim sayfas�nda g&ouml;ster', 'caption_in_thumbview', 1),
	array('K&uuml;�&uuml;k resimlerin alt�nda yorum say�s�n� g&ouml;r&uuml;nt&uuml;le', 'display_comment_count', 1),
	array('Haz�r ayarlar� kullanarak resimleri s�rala', 'default_sort_order', 3),
	array('Bir resmin \'top-rated\' listesine g&ouml;z&uuml;kebilmesi i�in almas� gerekn azami oy say�s�', 'min_votes_for_rating', 0),

	'Resim g&ouml;r&uuml;nt&uuml;leme &amp; Yorum se�enekleri',
	array('Resimlerin g&ouml;sterilece�i tablonun geni�li�i (piksel veya %)', 'picture_table_width', 0),
	array('Resim bilgilerine g&ouml;ster', 'display_pic_info', 1),
	array('K&uuml;f&uuml;rleri yorumlarda filtrele', 'filter_bad_words', 1),
	array('Yorumlar da smiley kullan�m�na izin ver', 'enable_smilies', 1),
	array('Bir resim a��klmas�n�n maksimum uzunlu�u', 'max_img_desc_length', 0),
	array('Bir kelime i�indeki maksimum harf say�s�', 'max_com_wlength', 0),
	array('Bir yorum i�indeki maksimum sat�r say�s�', 'max_com_lines', 0),
	array('Bir yorumun maksimum uzunlu�u', 'max_com_size', 0),
        array('Film �eridi g�ster', 'display_film_strip', 1), 
        array('Film �eridindeki adet say�s�', 'max_film_strip_items', 0), 

	'Resim ve k&uuml;�&uuml;k resim se�enekleri',
	array('JPEG dosyalar� i�in kalite ayar�', 'jpeg_qual', 0),
        array('K���k resmin en b�y�k boyutu <b>*</b>', 'thumb_width', 0), 
        array('Boyut kullan ( geni�lik veya y�kseklik veya en b�y�k g�r�n�� k���k resimler i�in ) <b>*</b>', 'thumb_use', 7), 
	array('Ara resimleri yarat','make_intermediate',1),
	array('Bir ara resmin maksium geni�li�i veya boyu <b>*</b>', 'picture_width', 0),
	array('Y&uuml;klenecek olan resimler i�in maksimum boyut (KB)', 'max_upl_size', 0),
	array('Y&uuml;klenecek olan resimler i�in makisum geni�lik veya boy (piksel)', 'max_upl_width_height', 0),

	'Kullan�c� se�enekleri',
	array('Yeni kullan�c� kayd�na izin ver', 'allow_user_registration', 1),
	array('Yeni kullan�c� kayd� i�in e-Posta onay�na ihtiya� var', 'reg_requires_valid_email', 1),
	array('�ki kullan�c� ayn� e-Posta adresine sahip olmas�na izin ver', 'allow_duplicate_emails_addr', 1),
	array('Kullan�c�lar�n ki�isel galerileri olabilir', 'allow_private_albums', 1),

	'Resim a��klamalar� i�in &ouml;zel alanlar (e�er kullan�lmayacaksa bo� b�rak�n)',
	array('Alan 1 ad�', 'user_field1_name', 0),
	array('Alan 2 ad�', 'user_field2_name', 0),
	array('Alan 3 ad�', 'user_field3_name', 0),
	array('Alan 4 ad�', 'user_field4_name', 0),

	'Resim ve k&uuml;�&uuml;k resim geli�mi� se�enekleri',
        array('��k�� yapmam�� kullan�c�ya �zel resim ikonunu g�ster','show_private',1), 
	array('Dosya isimlerinde karakterlere izin verme', 'forbiden_fname_char',0),
	array('Y&uuml;klenmi� olan resimler i�in kabul edilen uzant�lar', 'allowed_file_extensions',0),
	array('Resimleri boyutland�rmak i�in kullan�lan y&ouml;ntem','thumb_method',2),
	array('ImageMagick i�in yol (example /usr/bin/X11/)', 'impath', 0),
	array('Kabul edilen resim tipleri (sadece ImageMagick i�in ge�erli)', 'allowed_img_types',0),
	array('Komut sat�r se�enekleri ImageMagick i�in', 'im_options', 0),
	array('EXIF bilgisini oku JPEG dosyalar�nda', 'read_exif_data', 1),
	array('Alb&uuml;m dizini <b>*</b>', 'fullpath', 0),
	array('Kullan�c� resimleri i�in dizin <b>*</b>', 'userpics', 0),
	array('Ara resimler i�in &ouml;nek <b>*</b>', 'normal_pfx', 0),
	array('K&uuml;�&uuml;k resimler i�in &ouml;nek <b>*</b>', 'thumb_pfx', 0),
	array('Dizinler i�in haz�r ayar', 'default_dir_mode', 0),
	array('Resimleri i�in haz�r ayar', 'default_file_mode', 0),
        array('Tam ekran yeni pencerede sa� klik yasakla (JavaScript - foolproof metodu yok)', 'disable_popup_rightclick', 1), 
        array('B�t�n "s�radan" sayfalarda sa� klik yasakla (JavaScript - foolproof metodu yok)', 'disable_gallery_rightclick', 1), 

	'Cookie &amp; Charset ayarlar�',
	array('Program taraf�ndan kullan�lan cookielerin ad�', 'cookie_name', 0),
	array('Program taraf�ndan kullan�lan cookielerin dizin yolu', 'cookie_path', 0),
	array('Karakter kodlama', 'charset', 4),

	'Di�er se�enekler',
	array('Hata �&ouml;z&uuml;mleme se�ene�i a�', 'debug_mode', 1),
	
	'<br /><div align="center">(*) * ile g&ouml;sterilmi� olan alanlar, resim galerinizde resim bulunuyorsa de�i�tirilmemeli</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Ad�n�z� ve bir yorum yazman�z gerek',
	'com_added' => 'Yorumunuz eklendi',
	'alb_need_title' => 'Alb&uuml;m i�in bir ba�l�k vermeniz gerek !',
	'no_udp_needed' => 'G&uuml;ncellemeye gerek yok.',
	'alb_updated' => 'Alb&uuml;m g&uuml;ncellenmi�tir.',
	'unknown_album' => 'Alb&uuml;m yok veya sizin o alb&uuml;m&uuml; de�i�tirmeye izniniz yok',
	'no_pic_uploaded' => 'Hi�bir resim y&uuml;klenmedi !<br /><br />E�er bir resim se�tiyseniz, ana makinanin resim y&uuml;klemeye izin verdi�inden emin olun...',
	'err_mkdir' => '%s dizini yarat�lamad�!',
	'dest_dir_ro' => '%s dizinine program taraf�ndan yaz�lam�yor !',
	'err_move' => '%s � %s e s&uuml;r&uuml;klemek imkans�z!',
	'err_fsize_too_large' => 'Y&uuml;klemeye �al��t���n�z resmin boyutu �ok b&uuml;y&uuml;k (izin verilen %s x %s) !',
	'err_imgsize_too_large' => 'Y&uuml;klemeye �al��t���n�z resmin boyutu �ok b&uuml;y&uuml;k (izin verilen %s KB) !',
	'err_invalid_img' => 'Y&uuml;klemeye �al��t���n�z resim ge�ersiz bir resim bi�imidir !',
	'allowed_img_types' => 'Sadece %s resim y&uuml;kleyebilirsiniz.',
	'err_insert_pic' => '\'%s\' resmi alb&uuml;me eklenemiyor ',
	'upload_success' => 'Resiminiz ba�ar� ile y&uuml;klenmi�tir<br /><br />Y&ouml;netici onay�ndan sonra yay�nlanacakt�r.',
	'info' => 'Bilgi',
	'com_added' => 'Yorum eklendi',
	'alb_updated' => 'Alb&uuml;m g&uuml;ncellendi',
	'err_comment_empty' => 'Yorumunuz bo� !',
	'err_invalid_fext' => 'Sadece bu uzant�lara sahip resimler kabul edilir : <br /><br />%s.',
	'no_flood' => 'Bu resim i�in son yorumu yollayan zaten sizsiniz<br /><br />E�er ba�ka bir�ey eklemek istiyorsan�z kendi yorumunuzu g&uuml;ncelleyin',
	'redirect_msg' => '�u anda y&ouml;nlendiriliyorsunuz.<br /><br /><br />\'CONTINUE\' a bas�n e�er sayfa kendili�inden yenilenmezse',
	'upl_success' => 'Resminiz ba�ar� ile eklenmi�tir',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Ba�l�k',
	'fs_pic' => 'tam boy resim',
	'del_success' => 'ba�ar� ile silindi',
	'ns_pic' => 'normal boyut resim',
	'err_del' => 'silinemiyor',
	'thumb_pic' => 'k&uuml;�&uuml;k resim',
	'comment' => 'yorum',
	'im_in_alb' => 'alb&uuml;mdeki resim',
	'alb_del_success' => 'Alb&uuml;m \'%s\' silindi',
	'alb_mgr' => 'Alb&uuml;m Y&ouml;neticisi',
	'err_invalid_data' => 'Ge�ersiz veri al�nd� \'%s\' da',
	'create_alb' => 'Alb&uuml;m \'%s\' olu�turuluyor',
	'update_alb' => 'Alb&uuml;m \'%s\' g&uuml;ncelleniyor, \'%s\' ba�l���d�r ve \'%s\' i�eri�i ile',
	'del_pic' => 'Resimi sil',
	'del_alb' => 'Alb&uuml;m&uuml; sil',
	'del_user' => 'Kullan�c� sil',
	'err_unknown_user' => 'Se�ilen kullan�c� yok !',
	'comment_deleted' => 'Yorum ba�ar� ile silindi',
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
	'confirm_del' => 'Bu resmi silece�inizden emin misiniz ? \\nYorumlar da silinecektir.',
	'del_pic' => 'BU RESM� S�L',
	'size' => '%s x %s piksel',
	'views' => '%s kere',
	'slideshow' => 'G&ouml;steri',
	'stop_slideshow' => 'G&Ouml;STER�Y� DURDUR',
	'view_fs' => 'Tam boy resmi g&ouml;rebilmek i�in t�klay�n',
);

$lang_picinfo = array(
	'title' =>'Resim bilgileri',
	'Filename' => 'Dosya ad�',
	'Album name' => 'Alb&uuml;m ad�',
	'Rating' => 'Be�enilme (%s oy)',
	'Keywords' => 'Anahtar kelime',
	'File Size' => 'Dosya boyutu',
	'Dimensions' => 'Boyutlar',
	'Displayed' => 'G&ouml;sterilen',
	'Camera' => 'Kamera',
	'Date taken' => 'Al�nan tarih',
	'Aperture' => 'Foto�raf makinesi a��kl���',
	'Exposure time' => '�f�a zaman�',
	'Focal length' => 'Merkez uzunlu�u',
	'Comment' => 'Yorum',
        'addFav'=>'S�k Kullan�lana ekle', 
        'addFavPhrase'=>'S�k Kullan�lanlar', 
        'remFav'=>'S�k Kullan�lanlarda ��kar', 
);

$lang_display_comments = array(
	'OK' => 'TAMAM',
	'edit_title' => 'Bu yorumu g&uuml;ncelle',
	'confirm_delete' => 'Bu yorumu silmek istedi�inizden emin misiniz ?',
	'add_your_comment' => 'Yorumunuzu ekleyin',
        'name'=>'�sim', 
        'comment'=>'Yorum', 
        'your_name' => 'Anonim', 
);

$lang_fullsize_popup = array( 
        'click_to_close' => 'Bu pencereyi kapatmak i�in resime klikleyin', 
); 

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Bir e-Kart yollay�n',
	'invalid_email' => '<b>Dikkat</b> : yanl�� e-Posta adresi !',
	'ecard_title' => 'Size %s taraf�ndan bir e-Kart g&ouml;nderilmi�tir',
	'view_ecard' => 'E�er e-Kart�n�z� do�ru g&ouml;r&uuml;nt&uuml;leyemiyorsan�z buraya t�klay�n',
	'view_more_pics' => 'Daha fazla resim g&ouml;rebilmek i�in bu ba�lant�ya t�klay�n !',
	'send_success' => 'e-Kart�n�z g&ouml;nderilmi�tir',
	'send_failed' => 'Ana makina e-Kart�n�z� g&ouml;nderemiyor',
	'from' => 'Kimden',
	'your_name' => 'Sizin ad�n�z',
	'your_email' => 'Sizin e-Posta adresiniz',
	'to' => 'Kime',
	'rcpt_name' => 'Al�c�n�n �smi',
	'rcpt_email' => 'Al�c�n�n e-Posta adresi',
	'greetings' => 'Selamlar',
	'message' => '�leti',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Resim bilgileri',
	'album' => 'Alb&uuml;m',
	'title' => 'Ba�l�k',
	'desc' => 'A��klama',
	'keywords' => 'Anahta kelimeler',
	'pic_info_str' => '%sx%s - %sKB - %s g&ouml;r&uuml;nt&uuml;leme - %s oy',
	'approve' => 'Resimi onayla',
	'postpone_app' => 'Onaylamay� ertele',
	'del_pic' => 'Resimi sil',
	'reset_view_count' => 'G&ouml;r&uuml;nt&uuml;leme sayac�n� s�f�rla',
	'reset_votes' => 'Oylamalar� s�f�rla',
	'del_comm' => 'Yorumlar� sil',
	'upl_approval' => 'Y&uuml;klemeyi onayla',
	'edit_pics' => 'Resimlerde de�i�iklik yap',
	'see_next' => 'Sonraki resimleri g&ouml;r',
	'see_prev' => '&Ouml;nceki resimleri g&ouml;r',
	'n_pic' => '%s resim',
	'n_of_pic_to_disp' => 'G&ouml;sterilecek olan resim say�s�',
	'apply' => 'De�i�iklikleri uygula'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Grup ad�',
	'disk_quota' => 'Disk kotas�',
	'can_rate' => 'Resimleri oylayabilir',
	'can_send_ecards' => 'e-Kart g&ouml;nderebilir',
	'can_post_com' => 'Yorum yazabilir',
	'can_upload' => 'Resim y&uuml;kleyebilir',
	'can_have_gallery' => 'Ki�isel galeri yapabilir',
	'apply' => 'De�i�iklikleri uygula',
	'create_new_group' => 'Yeni grup yarat',
	'del_groups' => 'Se�ilmi� olan grup(lar�) sil',
	'confirm_del' => 'Dikkat ! E�er bu grubu silerseniz, gruptaki b&uuml;t&uuml;n kullan�c�lar \'Registered\' grubuna transfer edilecektir !\n\nDevam etmek istiyormusunuz ?',
	'title' => 'Kullan�c� gruplar�n� d&uuml;zenle',
	'approval_1' => 'Herkese a��k y&uuml;kleme onay� (1)',
	'approval_2' => 'Ki�isel y&uuml;kleme onay� (2)',
	'note1' => '<b>(1)</b> Ki�isel galeriye y&uuml;klenecek olan resimler y&ouml;netici taraf�ndan onaylanmal�',
	'note2' => '<b>(2)</b> Kullan�c�ya ait galeriye y&uuml;kleme yapmak i�in y&ouml;netici onay�na gerek',
	'notes' => 'Notlar'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Ho�geldiniz !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Bu alb&uuml;m&uuml; silmek istedi�inizden emin misiniz ? \\nB&uuml;t&uuml;n resimler ve yorumlar da silinecektir.',
	'delete' => 'S�L',
	'modify' => '&Ouml;ZELL�KLER',
	'edit_pics' => 'RES�MLERDE DE�����KL�LK YAP',
);

$lang_list_categories = array(
	'home' => 'Ana',
	'stat1' => '<b>[pictures]</b> resimler <b>[albums]</b> alb&uuml;mde ve <b>[cat]</b> kategoride, <b>[comments]</b> yorum <b>[views]</b> kere g&ouml;r&uuml;nt&uuml;lenmi�tir',
	'stat2' => '<b>[pictures]</b> resim <b>[albums]</b> alb&uuml;mde <b>[views]</b> kere g&ouml;r&uuml;nt&uuml;lenmi�tir',
	'xx_s_gallery' => '%s\ in Galerisi',
	'stat3' => '<b>[pictures]</b> resim <b>[albums]</b> alb&uuml;mde <b>[comments]</b> yorum <b>[views]</b> kere g&ouml;r&uuml;nt&uuml;lenmi�tir'
);

$lang_list_users = array(
	'user_list' => 'Kullan�c� listesi',
	'no_user_gal' => 'Alb&uuml;m yaratma izni olan hi�bir kullan�c� yok',
	'n_albums' => '%s alb&uuml;m',
	'n_pics' => '%s resim'
);

$lang_list_albums = array(
	'n_pictures' => '%s resim',
	'last_added' => ', sonuncusu %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Giri�',
	'enter_login_pswd' => 'Giri� yapabilmek i�in kullan�c� ad�n�z� ve �ifrenizi kullan�n',
	'username' => 'Kullan�c� ad�',
	'password' => '�ifre',
	'remember_me' => 'Beni hat�rla',
	'welcome' => 'Ho�geldin %s ...',
	'err_login' => '*** Giri� yap�lmad� tekrar deneyim ***',
	'err_already_logged_in' => 'Zaten Giri� yapm��s�n�z !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => '��k��',
	'bye' => 'G&ouml;r&uuml;�mek &uuml;zere %s ...',
	'err_not_loged_in' => 'Giri� yapmad�n�z ki !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Alb&uuml;m&uuml; g&uuml;ncelle %s',
	'general_settings' => 'Genel se�enekler',
	'alb_title' => 'Alb&uuml;m ba�l���',
	'alb_cat' => 'Alb&uuml;m kategorisi',
	'alb_desc' => 'Alb&uuml;m a��klamas�',
	'alb_thumb' => 'Alb&uuml;m k&uuml;�&uuml;k resimler',
	'alb_perm' => 'Bu alb&uuml;m i�in izinler',
	'can_view' => 'Alb&uuml;m kimler taraf�ndan g&ouml;r&uuml;nt&uuml;lenebilir',
	'can_upload' => 'Ziyaret�iler resim y&uuml;kleyebilir',
	'can_post_comments' => 'Ziyaret�iler yorum yollayabilir',
	'can_rate' => 'Ziyaret�iler resim oylayabilir',
	'user_gal' => 'Kullan�c� galerisi',
	'no_cat' => '* Kategori yok *',
	'alb_empty' => 'Alb&uuml;m bo�',
	'last_uploaded' => 'Son y&uuml;klenen',
	'public_alb' => 'Herkes (a��k alb&uuml;m)',
	'me_only' => 'Sadece ben',
	'owner_only' => 'Alb&uuml;m sahibi (%s) sadece',
	'groupp_only' => '\'%s\' grubunun &uuml;yesi',
	'err_no_alb_to_modify' => 'G&uuml;ncelleme yapabilece�iniz bir alb&uuml;m yok veritaban�nda.',
	'update' => 'Alb&uuml;m&uuml; g&uuml;ncelle'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Bu resimi &ouml;nceden oylad�n�z',
	'rate_ok' => 'Oyunuz kabul edildi',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
{SITE_NAME} y&ouml;neticileri herhangi naho� malzemeleri en k�sa s&uuml;rede ortadan kald�racakt�r, her iletiyi okumak imkans�zd�r. B&ouml;ylelikle g&ouml;nderilen b&uuml;t&uuml;n iletilerin y&ouml;neticilerin veya site sahibinin g&ouml;r&uuml;�lerini de�il, yazar�n�n g&ouml;r&uuml;�lerini yans�tt���n� kabul etmi� oluyorsunuz (y&ouml;neticiler taraf�ndan g&ouml;ndeirlenler hari�) bu nedenle y&ouml;neticiler veya site sahibi sorumlu tutulamaz. .<br />
<br />
B&ouml;ylelikle herhangi s&ouml;vg&uuml; dolu, m&uuml;stehcen, kaba, karalay�c�, nefret dolu, tehdit edici, cinsel i�erikli ve uygulanabilir yasalar� �i�neyecek i�erikli ileti yollamamay� kabul etmi� oluyorsunuz. {SITE_NAME} in site sahibinin, y&ouml;neticilerinin ve moderat&ouml;rlerin uygun g&ouml;rd&uuml;kleri takdirde, i�erikleri silebilme veya bunlarda de�i�iklikler yapabilme haklar�na her i�erik i�in her zaman sahip olduklar�n� da kabul etmi� oluyorsunuz. Bir kullan�c� olarak veritaban�na eklenmi� olan herhangi bir bilgiyi de kabul etmi� oluyorsunuz. Bu bilgi sizin izniniz olmadan hi� bir�ekilde &uuml;�&uuml;n�&uuml; ki�ilere ula�t�r�lmayacakt�r, fakat site sahibi ve y&ouml;neticileri hacklenme sonucu bu verilen kaybolmas� ve/veya kullan�lmas� sonucu ve/veya �al�nmas� durumunda sorumlu tutulamaz..<br />
<br />
Bu site bilgisayar�n�zda bilgi kaydetmek amac�yla cookie'ler kullan�yor. Bu cookie'ler sadece sizin g&ouml;r&uuml;nt&uuml;leme zevkinizi geli�tirmek amac�yla kullan�l�r. E-Posta adresiniz sadece kaydolma bilgilerinizi ve �ifrenizi onaylama amac� ile kullan�l�r.<br />
<br />
'Kabul Ediyorum' a basarak bu ko�ullara ba�l� kalmay� kabul etmi� oluyorsunuz.
EOT;

$lang_register_php = array(
	'page_title' => 'Kullan�c� kayd�',
	'term_cond' => '�artlar ve durumlar',
	'i_agree' => 'Kabul Ediyorum',
	'submit' => 'Kayd� G&ouml;nder',
	'err_user_exists' => 'Yazd���n�z kullan�c� ad� kullan�lmaktad�r, ba�ka bir kullan�c� ad� deneyin',
	'err_password_mismatch' => 'Yazd���n�z �ifreler tutmuyor l&uuml;tfen �ifreleriniz tekrar girin',
	'err_uname_short' => 'Kullan�c� ad� en az 2 karakterden olu�mal�',
	'err_password_short' => '�ifre en az 2 karakterden olu�mal�',
	'err_uname_pass_diff' => 'Kullan�c� ad� ve �ifre farkl� olmal�',
	'err_invalid_email' => 'E-Posta adresi ge�ersizdir',
	'err_duplicate_email' => 'Ba�ka bir kullan�c� bu E-Posta adresini kullanarak kaydolmu�tur',
	'enter_info' => 'Bilgilerinizi girin',
	'required_info' => 'Gerekli bilgiler',
	'optional_info' => 'Se�imlik bilgiler',
	'username' => 'Kullan�c� Ad�',
	'password' => '�ifre',
	'password_again' => '�ifrenizi yeniden girin',
	'email' => 'E-Posta',
	'location' => 'Konum',
	'interests' => '�lgi alanlar�',
	'website' => 'Ki�isel Sayfa',
	'occupation' => 'Meslek',
	'error' => 'HATA',
	'confirm_email_subject' => '%s - Kay�t onay�',
	'information' => 'Bilgi',
	'failed_sending_email' => 'Kay�t onay� e-Postas� yollanam�yor !',
	'thank_you' => 'Kaydoldu�unuz i�in te�ekk&uuml;r ederiz.<br /><br />Hesab�n�z� nas�l etkinle�tirece�inizi yazan bir E-Posta adersinize yollanm��t�r.',
	'acct_created' => 'Hesab�n�z olu�turulmu�tur, �imdi kullan�c� ad�n�z� ve �ifrenizi kullanarak giri� yapabilirsiniz',
	'acct_active' => 'Hesab�n�z etkinle�tirildi, �imdi sisteme giri� yapabilirsiniz',
	'acct_already_act' => 'Bu hesap zaten etkin !',
	'acct_act_failed' => 'Bu hesab etkinle�tirilemiyor !',
	'err_unk_user' => 'Se�ilen kullan�c� yok !',
	'x_s_profile' => '%s\'in profili',
	'group' => 'Grup',
	'reg_date' => 'Kat�lma tarihi',
	'disk_usage' => 'Disk kullan�m�',
	'change_pass' => '�ifre de�i�tir',
	'current_pass' => '�u anki �ifre',
	'new_pass' => 'Yeni �ifre',
	'new_pass_again' => 'Yeni �ifre yeniden',
	'err_curr_pass' => '�u anki �ifre yanl��',
	'apply_modif' => 'De�i�iklikleri uygula',
	'change_pass' => '�ifremi de�i�tir',
	'update_success' => 'Profiliniz g&uuml;ncelle�tirildi',
	'pass_chg_success' => '�ifreniz de�i�tirildi',
	'pass_chg_error' => '�ifreniz de�i�tirildi',
);

$lang_register_confirm_email = <<<EOT
{SITE_NAME} de kaydoldu�unuz i�in te�ekk&uuml;r ederiz

Kullan�c� ad�n�z : "{USER_NAME}"
�ifreniz : "{PASSWORD}"

Hesab�n�z� etkinle�tirebilmek i�in a�a��daki ba�lant�ya t�klay�n
Veya tarayc�n�z�n adres �ubu�una kopyalay�n

{ACT_LINK}

Sayf�lar�m�zla,

{SITE_NAME} y&ouml;neticileri

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Ele�tiri yorumlar�',
	'no_comment' => 'Ele�tirilecek yorum yok',
	'n_comm_del' => '%s yorum silindi',
	'n_comm_disp' => 'G&ouml;sterilecek yorum say�s�',
	'see_prev' => '&Ouml;ncekini g&ouml;r',
	'see_next' => 'Sonrakini g&ouml;re',
	'del_comm' => 'Se�ilmi� yorumlar� sil',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Resim ar�ivinde ara',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Yeni resimler ara',
	'select_dir' => 'Dizin se�',
	'select_dir_msg' => 'Bu fonksiyon size FTP ile y&uuml;kled�iniz bir grup resmi eklemenizi sa�lar.<br /><br />Y&uuml;kledi�iniz resimlerin dizinini se�in',
	'no_pic_to_add' => 'Eklenecek resim yok',
	'need_one_album' => 'Bu fonksiyonu kullanabilmek i�in en az bir alb&uuml;me ihtiyac�n�z var',
	'warning' => 'Dikkat',
	'change_perm' => 'Program bu dizine yazam�yor, yazabilmek i�in CHMOD unu 755 veya 777 yapman�z gerekiyor resimleri y&uuml;klemeden &ouml;nce !',
	'target_album' => '<b>Resimlerini &quot;</b>%s<b>&quot; e g&ouml;nder </b>%s',
	'folder' => 'Klas&ouml;r',
	'image' => 'Resim',
	'album' => 'Alb&uuml;m',
	'result' => 'Sonu�',
	'dir_ro' => 'Yaz�lamaz. ',
	'dir_cant_read' => 'Okunamaz. ',
	'insert' => 'Galeriye yeni resim ekle',
	'list_new_pic' => 'Yeni resimlerin listesi',
	'insert_selected' => 'Se�ilmi� resimleri ekle',
	'no_pic_found' => 'Yeni resim bulunamad�',
	'be_patient' => 'L&uuml;tfen bekleyiniz, program i�leminiz yapmaktad�r',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : Resminiz ba�ar� ile eklenmi�tir.'.
				'<li><b>DP</b> : Resim bir kopya, ba�ka bir kopyas� veritaban�nda bulunmaktad�r'.
				'<li><b>PB</b> : Resim y&uuml;klenemedi, resimlerin bulundu�u dizinlerin do�ru ayarlanm�� oldu�undan emin olun'.
				'<li>E�er OK, DP, PB \'signs\' i�aretlerinden biri ��km�yorsa, k�r�k resmin &uuml;zerine t�klay�n PHP hata iletisini g&ouml;rebilmek i�in'.
				'<li>E�er sunucu zaman ba�lant� hatas� olursa, yenile tu�una bas�n'.
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
                'title' => 'Kullan�c�lar� Yasakla', 
                'user_name' => 'Kullan�c� Ad�', 
                'ip_address' => 'IP Adresi', 
                'expiry' => 'Biti� s�resi (bo� daimi anlam�nda)', 
                'edit_ban' => 'De�i�iklikleri Kay�t Et', 
                'delete_ban' => 'Sil', 
                'add_new' => 'Yeni Yasakl� Ekle', 
                'add_ban' => 'Ekle', 
); 

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'Resim y&uuml;kleme',
	'max_fsize' => 'En fazla izin verilen boyut %s KB',
	'album' => 'Alb&uuml;m',
	'picture' => 'Resim',
	'pic_title' => 'Resim Ba�l���',
	'description' => 'Resim a��klamas�',
	'keywords' => 'Anahat kelimeler (her anahtar kelimesi aras�nda bo�luk b�rak�n)',
	'err_no_alb_uploadables' => 'Y&uuml;kleyebilece�iniz herhangi bir alb&uuml;m&uuml;n&uuml;z yok',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Kullan�c�lar d&uuml;zenle',
	'name_a' => '�simler k&uuml;�&uuml;kten b&uuml;y&uuml;�e s�rala ',
	'name_d' => '�simler b&uuml;y&uuml;ktan k&uuml;�&uuml;�e s�rala',
	'group_a' => 'Gruplar� k&uuml;�&uuml;kten b&uuml;y&uuml;�e s�rala',
	'group_d' => 'Gruplar� b&uuml;y&uuml;ktan k&uuml;�&uuml;�e s�rala',
	'reg_a' => 'Kay�t olma tarihi k&uuml;�&uuml;kten b&uuml;y&uuml;�e s�rala',
	'reg_d' => 'Kay�t olma tarihi b&uuml;y&uuml;ktan k&uuml;�&uuml;�e s�rala',
	'pic_a' => 'Resim sayma k&uuml;�&uuml;kten b&uuml;�&uuml;�e',
	'pic_d' => 'Resim sayma b&uuml;y&uuml;kten k&uuml;�&uuml;�e',
	'disku_a' => 'Disk kullan�m� k&uuml;�&uuml;kten b&uuml;y&uuml;�e',
	'disku_d' => 'Disk kullan�m� b&uuml;y&uuml;kten k&uuml;�&uuml;�e',
	'sort_by' => 'Kullan�c�lar� g&ouml;re s�rala',
	'err_no_users' => 'Kullan�c� tablosu bo� !',
	'err_edit_self' => 'Kendi profilinizi d&uuml;zenleyemezsiniz, bunun i�in \'My profile\' ba�lant�s�n� kullan�n',
	'edit' => 'D&Uuml;ZENLE',
	'delete' => 'S�L',
	'name' => 'Kullan�c� ad',
	'group' => 'Grup',
	'inactive' => 'Pasif',
	'operations' => '��lemler',
	'pictures' => 'Resimler',
	'disk_space' => 'Kullan�lan alan / kota',
	'registered_on' => 'Kay�t olma tarihi',
	'u_user_on_p_pages' => '%d kullan�c� %d sayfada',
	'confirm_del' => 'Bu kullan�c�y S�LMEK istedi�inizden emin misiniz ? \\nB&uuml;t&uuml;n resim ve alb&uuml;mleri silinecektir.',
	'mail' => 'POSTA',
	'err_unknown_user' => 'Se�ilen kullan�c� yok !',
	'modify_user' => 'Kullan�c�y D&uuml;zenle',
	'notes' => 'Notlar',
	'note_list' => '<li>�u anki �ifreyi de�i�tirmek istemiyorsan�z �ifre alan�n� bo� b�rak�n�z',
	'password' => '�ifre',
	'user_active_cp' => 'Kulann�c� etkin',
	'user_group_cp' => 'Kullan�c� grubu',
	'user_email' => 'Kullan�c� e-Posta',
	'user_web_site' => 'Kullan�c� a� sitesi',
	'create_new_user' => 'Yeni kullan�c� olu�tur',
	'user_from' => 'Kullan�c� konumu',
	'user_interests' => 'Kullan�c� �lgi alanlar�',
	'user_occ' => 'Kullan�c� Mesle�i',
);

// ------------------------------------------------------------------------- // 
// File util.php 
// ------------------------------------------------------------------------- // 

if (defined('UTIL_PHP')) $lang_util_php = array( 
        'title' => 'Resimleri boyutland�r', 
        'what_it_does' => 'Ne yapar', 
        'what_update_titles' => 'Dosya Ad�ndan ba�l�klar� g�nceller', 
        'what_delete_title' => 'Ba�l�klar� Siler', 
        'what_rebuild' => 'K���k resimleri ve boyutland�r�lm�� resimleri yeniden yap�land�r�r', 
        'what_delete_originals' => 'Ger�ek boyuttaki resimleri siler ve onlar� boyutland�r�lm��la de�i�tirir', 
        'file' => 'Dosya', 
        'title_set_to' => 'ba�l�k ayarlanm��', 
        'submit_form' => 'ilet', 
        'updated_succesfully' => 'g�ncelleme ba�ar�l�', 
        'error_create' => 'yarat�rken HATA', 
        'continue' => 'Daha fazla resim i�le', 
        'main_success' => ' %s dosyas� ba�ar�l� bir �ekilde ana resim olarak kullan�ld�', 
        'error_rename' => ' %s ye %s yeniden adland�r�ken hata olu�tu', 
        'error_not_found' => ' %s dosyas� bulunamad�', 
        'back' => 'anasyafa geri d�n', 
        'thumbs_wait' => 'K���k resimleri ve/veya boyutland�r�lm�� resimler g�ncelleniyor, l�tfen bekleyiniz...', 
        'thumbs_continue_wait' => 'K���k resimlerin ve/veya boyutland�r�lm�� resimlerin g�ncellenmesine devam ediliyor...', 
        'titles_wait' => 'Ba�l�klar g�ncelleniyor, l�tfen bekleyiniz...', 
        'delete_wait' => 'Ba�l�klar siliniyor, l�tfen bekleyiniz...', 
        'replace_wait' => 'As�l resimler siliniyor ve/veya boyutland�r�lm�� resimleri ile de�i�tiriliyor, l�tfen bekleyiniz...', 
        'instruction' => 'H�zl� Talimat', 
        'instruction_action' => 'Hareket se�', 
        'instruction_parameter' => 'Parametreleri ayarlar', 
        'instruction_album' => 'Alb�m se�', 
        'instruction_press' => ' %s bas', 
        'update' => 'K���k resimleri ve/veya boyutland�r�lm�� resimleri g�ncelle', 
        'update_what' => 'Neler g�ncellenmeli', 
        'update_thumb' => 'Sadece k���k resimler', 
        'update_pic' => 'Sadece boyutland�r�lm�� resimler', 
        'update_both' => 'Her ikiside k���k resimler ve boyutland�r�lm�� resimler', 
        'update_number' => 'Klik ba��na i�lenmi� resimlerin say�s�', 
        'update_option' => '(E�er timeout sorunlar� ya��yorsan�z daha d����e getirmeyi deneyin)', 
        'filename_title' => 'Dosya Ad� ? Resim ba�l���', 
        'filename_how' => 'Dosya ad� nas�l de�i�tirilsin', 
        'filename_remove' => '.jpg sonunu kald�r ve _ (alt �izgi)yi bo�lukla de�i�tir', 
        'filename_euro' => '2003_11_23_13_20_20.jpg yi 3/11/2003 13:20 ye de�i�tir', 
        'filename_us' => '2003_11_23_13_20_20.jpg yi 11/23/2003 13:20 ye de�i�tir', 
        'filename_time' => '2003_11_23_13_20_20.jpg yi 13:20 ye de�i�tir', 
        'delete' => 'Resim ba�l�klar�n� veya ger�ek boyut resimlerini sil', 
        'delete_title' => 'Resim ba�l�klar�n� sil', 
        'delete_original' => 'Ger�ek boy resimleri sil', 
        'delete_replace' => 'As�l resimleri sil ve bunlar� boyutland�r�lm��larla de�i�tir', 
        'select_album' => 'Alb�m se�', 
); 

?>
