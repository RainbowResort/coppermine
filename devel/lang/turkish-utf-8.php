<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery v1.1 Beta 2                                     //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Grégory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning Støverud <henning@stoverud.com>         //
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

$lang_charset = 'utf-8';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bayt', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Paz', 'Pzt', 'Sal', 'Çrş', 'Prş', 'Cum', 'Cmt');
$lang_month = array('Oca', 'Şub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Au&Auml;�', 'Eyl', 'Eki', 'Kas', 'Ara');

// Some common strings
$lang_yes = 'Evet';
$lang_no  = 'Hay&Auml;�r';
$lang_back = 'GER&Auml;�';
$lang_continue = '&Auml;�LER&Auml;�';
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
	'lastcom' => 'Son yorumlar',
	'topn' => 'En çok izlenenler',
	'toprated' => 'En çok oy alanlar',
	'lasthits' => 'Son izlenenler',
	'search' => 'Arama sonuçlar'
);

$lang_errors = array(
	'access_denied' => 'Bu sayfay&Auml;� görüntülemeye izniniz yok.',
	'perm_denied' => 'Bu işlemi yürütmeye izniniz yok.',
	'param_missing' => 'Program&Auml;� çal&Auml;�şt&Auml;�rmak için yetersiz komut(lar).',
	'non_exist_ap' => 'Şeçilmiş olan Albüm/Resim yok !',
	'quota_exceeded' => 'Disk kotas&Auml;� aş&Auml;�ld&Auml;�<br /><br />Sizin şu an ki alan&Auml;�n&Auml;�z [quota]K, resimleriniz [space]K alan kapl&Auml;�yor, bu resim eklenseydi kotan&Auml;�z&Auml;� aşm&Auml;�ş olacakt&Auml;�n&Auml;�z.',
	'gd_file_type_err' => 'GD Resim Kütüphanesini kullan&Auml;�rken geçerli olan resim tipleri JPG ve PNG.',
	'invalid_image' => 'Yükledi&Auml;�iniz resim ya bozuk ya da GD Kütüphanesi taraf&Auml;�ndan tan&Auml;�mlanam&Auml;�yor.',
	'resize_failed' => 'Küçük resim veya düşük boyutlu resim oluşturulam&Auml;�yor.',
	'no_img_to_display' => 'Gösterilecek resim yok',
	'non_exist_cat' => 'Seçilmiş olan kategori yok',
	'orphan_cat' => 'Bir kategorinin ana dal&Auml;� yok, bu sorunu haletmek için Kategori Yöneticisini çal&Auml;�şt&Auml;�r&Auml;�n.',
	'directory_ro' => 'Dizin \'%s\'  e yaz&Auml;�labilir de&Auml;�il, resimler silinemiyor',
	'non_exist_comment' => 'Şeçilmiş olan yorum yok.',
	'pic_in_invalid_album' => 'Resim var olmayan bir albümde (%s)!?'
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'Albüm listesine git',
	'alb_list_lnk' => 'Albüm listesi',
	'my_gal_title' => 'Kişisel galerime git',
	'my_gal_lnk' => 'Kişisel Galerim',
	'my_prof_lnk' => 'My profile',
	'adm_mode_title' => 'Yönetici konumuna geçiş yap',
	'adm_mode_lnk' => 'Yönetici konumu',
	'usr_mode_title' => 'Kullan&Auml;�c&Auml;� konumuna geçiş yap',
	'usr_mode_lnk' => 'Kullan&Auml;�c&Auml;� konumu',
	'upload_pic_title' => 'Bir resimi bir albüme yükle',
	'upload_pic_lnk' => 'Resim yükle',
	'register_title' => 'Bir hesap oluştur',
	'register_lnk' => 'Kay&Auml;�t ol',
	'login_lnk' => 'Giriş',
	'logout_lnk' => 'Ç&Auml;�k&Auml;�ş',
	'lastup_lnk' => 'Son yüklenenler',
	'lastcom_lnk' => 'Son yorumlar',
	'topn_lnk' => 'En çok izlenenler',
	'toprated_lnk' => 'En çok oy alanlar',
	'search_lnk' => 'Ara',
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Yükleme izini',
	'config_lnk' => 'Seçenekler',
	'albums_lnk' => 'Albümler',
	'categories_lnk' => 'Kategoriler',
	'users_lnk' => 'Kullan&Auml;�c&Auml;�lar',
	'groups_lnk' => 'Gruplar',
	'comments_lnk' => 'Yorumlar',
	'searchnew_lnk' => 'Küme resimleri ekle',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Oluştur veya albümleri iste',
	'modifyalb_lnk' => 'Albümlerde de&Auml;�işiklik yap',
	'my_prof_lnk' => 'Profilim',
);

$lang_cat_list = array(
	'category' => 'Kategori',
	'albums' => 'Albümler',
	'pictures' => 'Resimler',
);

$lang_album_list = array(
	'album_on_page' => '%d albümünüz %d sayfadad&Auml;�r'
);

$lang_thumb_view = array(
	'date' => 'TAR&Auml;�H',
	'name' => 'AD',
	'sort_da' => 'Tarihi küçükten büyüyü&Auml;�e s&Auml;�rala',
	'sort_dd' => 'Tarihi büyükten küçüyü&Auml;�e s&Auml;�rala',
	'sort_na' => 'Ad&Auml;� küçükten büyüyü&Auml;�e s&Auml;�rala',
	'sort_nd' => 'Ad&Auml;� büyükten küçüyü&Auml;�e s&Auml;�rala',
	'pic_on_page' => '%d resim %d sayfadad&Auml;�r',
	'user_on_page' => '%d kullan&Auml;�c&Auml;� %d sayfadad&Auml;�r'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Küçük resim sayfas&Auml;�na geri dön',
	'pic_info_title' => 'Resmi bilgilerine göster/sakla',
	'slideshow_title' => 'Gösteri',
	'ecard_title' => 'Bu resimi e-Kart olarak yolla',
	'ecard_disabled' => 'e-Kart iptal edilmiştir',
	'ecard_disabled_msg' => 'e-Kart göndermeye izininiz yok',
	'prev_title' => 'Önceki resime bak',
	'next_title' => 'Bir sonraki resime bak',
	'pic_pos' => 'RES&Auml;�M %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Bu resimi oylay&Auml;�n ',
	'no_votes' => '(Oy yok şimdilik)',
	'rating' => '(Şu anki durum : %s / 5 ile %s oy)',
	'rubbish' => 'Saçma',
	'poor' => 'Yetersiz',
	'fair' => 'Orta',
	'good' => '&Auml;�yi',
	'excellent' => 'Mükemmel',
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
	'line' => 'Sat&Auml;�r: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Dosya ad&Auml;� : ',
	'filesize' => 'Dosya boyutu : ',
	'dimensions' => 'Boyutlar&Auml;� : ',
	'date_added' => 'Eklenme tarihi : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s yorum',
	'n_views' => '%s görüntüleme',
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
	'Exclamation' => 'Ünlem',
	'Question' => 'Soru',
	'Very Happy' => 'Çok mutlu',
	'Smile' => 'Gül',
	'Sad' => 'Mutsuz',
	'Surprised' => 'Şaş&Auml;�rm&Auml;�ş',
	'Shocked' => 'Sars&Auml;�lm&Auml;�ş',
	'Confused' => 'Confused',
	'Cool' => 'Süper',
	'Laughing' => 'Gülerek',
	'Mad' => 'Deli',
	'Razz' => 'Razz',
	'Embarassed' => 'Utanm&Auml;�ş',
	'Crying or Very sad' => 'A&Auml;�lamak veya çok mutsuz',
	'Evil or Very Mad' => 'Bela veya çok deli',
	'Twisted Evil' => 'Cilveli Bela',
	'Rolling Eyes' => 'Yuvarlanan Gözler',
	'Wink' => 'Göz k&Auml;�rpma',
	'Idea' => 'Fikir',
	'Arrow' => 'Ok',
	'Neutral' => 'Tarafs&Auml;�z',
	'Mr. Green' => 'Bay Yeşil',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'Yönetici konumu kapat&Auml;�l&Auml;�yor...',
	1 => 'Yönetici konumu aç&Auml;�l&Auml;�yor...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Albümleri isim vermelisiniz !',
	'confirm_modifs' => 'Bu de&Auml;�işiklikleri uygulamak istedi&Auml;�inizden eminmisiniz ?',
	'no_change' => 'Herhangi bir de&Auml;�işklik yap&Auml;�lmad&Auml;� !',
	'new_album' => 'Yeni Albüm',
	'confirm_delete1' => 'Bu albümü silmek istedi&Auml;�inizden emin misiniz ?',
	'confirm_delete2' => '\n&Auml;�çerdi&Auml;�i bütün resim ve yorumlar silinecektir !',
	'select_first' => 'Önce bir albüm seçin',
	'alb_mrg' => 'Albüm Yöneticisi',
	'my_gallery' => '* Benim Galerim *',
	'no_category' => '* Kategori Yok *',
	'delete' => 'Sil',
	'new' => 'Yeni',
	'apply_modifs' => 'De&Auml;�işiklikleri uygula',
	'select_category' => 'Kategori seçin',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => '\'%s\' için komutlar gerekli işlem yap&Auml;�lamad&Auml;� !',
	'unknown_cat' => 'Seçilmiş olan kategori veritaban&Auml;�nda bulunamad&Auml;�',
	'usergal_cat_ro' => 'Kullan&Auml;�c&Auml;� galerileri silinemez !',
	'manage_cat' => 'Kategorileri düzenle',
	'confirm_delete' => 'Bu kategoriyi S&Auml;�LMEK istedi&Auml;�inizden eminmisiniz ?',
	'category' => 'Kategori',
	'operations' => '&Auml;�şlemler',
	'move_into' => 'Sürükle',
	'update_create' => 'Kategori oluştur/güncelle',
	'parent_cat' => 'Ana kategori',
	'cat_title' => 'Kategori başl&Auml;�&Auml;�&Auml;�',
	'cat_desc' => 'Kategori aç&Auml;�klamas&Auml;�'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Seçenekler',
	'restore_cfg' => 'Ayarlar&Auml;� s&Auml;�f&Auml;�rla',
	'save_cfg' => 'Yeni seçenekleri kaydet',
	'notes' => 'Notlar',
	'info' => 'Bilgi',
	'upd_success' => 'Coppermine seçenekleri güncellendi',
	'restore_success' => 'Coppermine ayarlar&Auml;� s&Auml;�f&Auml;�rland&Auml;�',
	'name_a' => 'Ad küçükten büyüyü&Auml;�e',
	'name_d' => 'Ad büyükten küçüyü&Auml;�e',
	'date_a' => 'Tarih küçükten büyüyü&Auml;�e',
	'date_d' => 'Date büyükten küçüyü&Auml;�e'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Genel Seçenekler',
	array('Galeri &Auml;�smi', 'gallery_name', 0),
	array('Galeri Aç&Auml;�klamas&Auml;�', 'gallery_description', 0),
	array('Galeri Yöneticisi e-Posta', 'gallery_admin_email', 0),
	array('\'See more pictures\' hedef adres ba&Auml;�lant&Auml;�s&Auml;� e-Kartlar içinde', 'ecards_more_pic_target', 0),
	array('Dil', 'lang', 5),
	array('Arayüz', 'theme', 6),

	'Albüm liste görüntüsü',
	array('Ana tablonun genişli&Auml;�i (piksel veya %)', 'main_table_width', 0),
	array('Gösterilecek olan kategori düzeylerinin say&Auml;�s&Auml;�', 'subcat_level', 0),
	array('Gösterilecek albümlerin say&Auml;�s&Auml;�', 'albums_per_page', 0),
	array('Albüm listesi için sütun say&Auml;�s&Auml;�', 'album_list_cols', 0),
	array('Küçük resimlerin boyutu piksel olarak', 'alb_list_thumb_size', 0),
	array('Ana sayfan&Auml;�n içeri&Auml;�i', 'main_page_layout', 0),

	'Küçük resim görüntüsü',
	array('Küçük resim sayfas&Auml;�ndaki sütun say&Auml;�s&Auml;�', 'thumbcols', 0),
	array('Küçük resim sayfas&Auml;�ndaki s&Auml;�ra say&Auml;�s&Auml;�', 'thumbrows', 0),
	array('En çok gösterilecek etiket say&Auml;�s&Auml;�', 'max_tabs', 0),
	array('Resim manşet başl&Auml;�&Auml;�&Auml;�n&Auml;� küçük resim sayfas&Auml;�nda göster', 'caption_in_thumbview', 1),
	array('Küçük resimlerin alt&Auml;�nda yorum say&Auml;�s&Auml;�n&Auml;� görüntüle', 'display_comment_count', 1),
	array('Haz&Auml;�r ayarlar&Auml;� kullanarak resimleri s&Auml;�rala', 'default_sort_order', 3),
	array('Bir resmin \'top-rated\' listesine gözükebilmesi için almas&Auml;� gerekn azami oy say&Auml;�s&Auml;�', 'min_votes_for_rating', 0),

	'Resim görüntüleme &amp; Yorum seçenekleri',
	array('Resimlerin gösterilece&Auml;�i tablonun genişli&Auml;�i (piksel veya %)', 'picture_table_width', 0),
	array('Resim bilgilerine göster', 'display_pic_info', 1),
	array('Küfürleri yorumlarda filtrele', 'filter_bad_words', 1),
	array('Yorumlar da smiley kullan&Auml;�m&Auml;�na izin ver', 'enable_smilies', 1),
	array('Bir resim aç&Auml;�klmas&Auml;�n&Auml;�n maksimum uzunlu&Auml;�u', 'max_img_desc_length', 0),
	array('Bir kelime içindeki maksimum harf say&Auml;�s&Auml;�', 'max_com_wlength', 0),
	array('Bir yorum içindeki maksimum sat&Auml;�r say&Auml;�s&Auml;�', 'max_com_lines', 0),
	array('Bir yorumun maksimum uzunlu&Auml;�u', 'max_com_size', 0),

	'Resim ve küçük resim seçenekleri',
	array('JPEG dosyalar&Auml;� için kalite ayar&Auml;�', 'jpeg_qual', 0),
	array('Bir küçük resimin maksiumum genişli&Auml;�i veya boyu <b>*</b>', 'thumb_width', 0),
	array('Ara resimleri yarat','make_intermediate',1),
	array('Bir ara resmin maksium genişli&Auml;�i veya boyu <b>*</b>', 'picture_width', 0),
	array('Yüklenecek olan resimler için maksimum boyut (KB)', 'max_upl_size', 0),
	array('Yüklenecek olan resimler için makisum genişlik veya boy (piksel)', 'max_upl_width_height', 0),

	'Kullan&Auml;�c&Auml;� seçenekleri',
	array('Yeni kullan&Auml;�c&Auml;� kayd&Auml;�na izin ver', 'allow_user_registration', 1),
	array('Yeni kullan&Auml;�c&Auml;� kayd&Auml;� için e-Posta onay&Auml;�na ihtiyaç var', 'reg_requires_valid_email', 1),
	array('&Auml;�ki kullan&Auml;�c&Auml;� ayn&Auml;� e-Posta adresine sahip olmas&Auml;�na izin ver', 'allow_duplicate_emails_addr', 1),
	array('Kullan&Auml;�c&Auml;�lar&Auml;�n kişisel galerileri olabilir', 'allow_private_albums', 1),

	'Resim aç&Auml;�klamalar&Auml;� için özel alanlar (e&Auml;�er kullan&Auml;�lmayacaksa boş b&Auml;�rak&Auml;�n)',
	array('Alan 1 ad&Auml;�', 'user_field1_name', 0),
	array('Alan 2 ad&Auml;�', 'user_field2_name', 0),
	array('Alan 3 ad&Auml;�', 'user_field3_name', 0),
	array('Alan 4 ad&Auml;�', 'user_field4_name', 0),

	'Resim ve küçük resim gelişmiş seçenekleri',
	array('Dosya isimlerinde karakterlere izin verme', 'forbiden_fname_char',0),
	array('Yüklenmiş olan resimler için kabul edilen uzant&Auml;�lar', 'allowed_file_extensions',0),
	array('Resimleri boyutland&Auml;�rmak için kullan&Auml;�lan yöntem','thumb_method',2),
	array('ImageMagick için yol (example /usr/bin/X11/)', 'impath', 0),
	array('Kabul edilen resim tipleri (sadece ImageMagick için geçerli)', 'allowed_img_types',0),
	array('Komut sat&Auml;�r seçenekleri ImageMagick için', 'im_options', 0),
	array('EXIF bilgisini oku JPEG dosyalar&Auml;�nda', 'read_exif_data', 1),
	array('Albüm dizini <b>*</b>', 'fullpath', 0),
	array('Kullan&Auml;�c&Auml;� resimleri için dizin <b>*</b>', 'userpics', 0),
	array('Ara resimler için önek <b>*</b>', 'normal_pfx', 0),
	array('Küçük resimler için önek <b>*</b>', 'thumb_pfx', 0),
	array('Dizinler için haz&Auml;�r ayar', 'default_dir_mode', 0),
	array('Resimleri için haz&Auml;�r ayar', 'default_file_mode', 0),

	'Cookie &amp; Charset ayarlar&Auml;�',
	array('Program taraf&Auml;�ndan kullan&Auml;�lan cookielerin ad&Auml;�', 'cookie_name', 0),
	array('Program taraf&Auml;�ndan kullan&Auml;�lan cookielerin dizin yolu', 'cookie_path', 0),
	array('Karakter kodlama', 'charset', 4),

	'Di&Auml;�er seçenekler',
	array('Hata çözümleme seçene&Auml;�i aç', 'debug_mode', 1),
	
	'<br /><div align="center">(*) * ile gösterilmiş olan alanlar, resim galerinizde resim bulunuyorsa de&Auml;�iştirilmemeli</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Ad&Auml;�n&Auml;�z&Auml;� ve bir yorum yazman&Auml;�z gerek',
	'com_added' => 'Yorumunuz eklendi',
	'alb_need_title' => 'Albüm için bir başl&Auml;�k vermeniz gerek !',
	'no_udp_needed' => 'Güncellemeye gerek yok.',
	'alb_updated' => 'Albüm güncellenmiştir.',
	'unknown_album' => 'Albüm yok veya sizin o albümü de&Auml;�iştirmeye izniniz yok',
	'no_pic_uploaded' => 'Hiçbir resim yüklenmedi !<br /><br />E&Auml;�er bir resim seçtiyseniz, ana makinanin resim yüklemeye izin verdi&Auml;�inden emin olun...',
	'err_mkdir' => '%s dizini yarat&Auml;�lamad&Auml;�!',
	'dest_dir_ro' => '%s dizinine program taraf&Auml;�ndan yaz&Auml;�lam&Auml;�yor !',
	'err_move' => '%s &Auml;� %s e sürüklemek imkans&Auml;�z!',
	'err_fsize_too_large' => 'Yüklemeye çal&Auml;�şt&Auml;�&Auml;�&Auml;�n&Auml;�z resmin boyutu çok büyük (izin verilen %s x %s) !',
	'err_imgsize_too_large' => 'Yüklemeye çal&Auml;�şt&Auml;�&Auml;�&Auml;�n&Auml;�z resmin boyutu çok büyük (izin verilen %s KB) !',
	'err_invalid_img' => 'Yüklemeye çal&Auml;�şt&Auml;�&Auml;�&Auml;�n&Auml;�z resim geçersiz bir resim biçimidir !',
	'allowed_img_types' => 'Sadece %s resim yükleyebilirsiniz.',
	'err_insert_pic' => '\'%s\' resmi albüme eklenemiyor ',
	'upload_success' => 'Resiminiz başar&Auml;� ile yüklenmiştir<br /><br />Yönetici onay&Auml;�ndan sonra yay&Auml;�nlanacakt&Auml;�r.',
	'info' => 'Bilgi',
	'com_added' => 'Yorum eklendi',
	'alb_updated' => 'Albüm güncellendi',
	'err_comment_empty' => 'Yorumunuz boş !',
	'err_invalid_fext' => 'Sadece bu uzant&Auml;�lara sahip resimler kabul edilir : <br /><br />%s.',
	'no_flood' => 'Bu resim için son yorumu yollayan zaten sizsiniz<br /><br />E&Auml;�er başka birşey eklemek istiyorsan&Auml;�z kendi yorumunuzu güncelleyin',
	'redirect_msg' => 'Şu anda yönlendiriliyorsunuz.<br /><br /><br />\'CONTINUE\' a bas&Auml;�n e&Auml;�er sayfa kendili&Auml;�inden yenilenmezse',
	'upl_success' => 'Resminiz başar&Auml;� ile eklenmiştir',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Başl&Auml;�k',
	'fs_pic' => 'tam boy resim',
	'del_success' => 'başar&Auml;� ile silindi',
	'ns_pic' => 'normal boyut resim',
	'err_del' => 'silinemiyor',
	'thumb_pic' => 'küçük resim',
	'comment' => 'yorum',
	'im_in_alb' => 'albümdeki resim',
	'alb_del_success' => 'Albüm \'%s\' silindi',
	'alb_mgr' => 'Albüm Yöneticisi',
	'err_invalid_data' => 'Geçersiz veri al&Auml;�nd&Auml;� \'%s\' da',
	'create_alb' => 'Albüm \'%s\' oluşturuluyor',
	'update_alb' => 'Albüm \'%s\' güncelleniyor, \'%s\' başl&Auml;�&Auml;�&Auml;�d&Auml;�r ve \'%s\' içeri&Auml;�i ile',
	'del_pic' => 'Resimi sil',
	'del_alb' => 'Albümü sil',
	'del_user' => 'Kullan&Auml;�c&Auml;� sil',
	'err_unknown_user' => 'Seçilen kullan&Auml;�c&Auml;� yok !',
	'comment_deleted' => 'Yorum başar&Auml;� ile silindi',
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
	'confirm_del' => 'Bu resmi silece&Auml;�inizden emin misiniz ? \\nYorumlar da silinecektir.',
	'del_pic' => 'BU RESM&Auml;� S&Auml;�L',
	'size' => '%s x %s piksel',
	'views' => '%s kere',
	'slideshow' => 'Gösteri',
	'stop_slideshow' => 'GÖSTER&Auml;�Y&Auml;� DURDUR',
	'view_fs' => 'Tam boy resmi görebilmek için t&Auml;�klay&Auml;�n',
);

$lang_picinfo = array(
	'title' =>'Resim bilgileri',
	'Filename' => 'Dosya ad&Auml;�',
	'Album name' => 'Albüm ad&Auml;�',
	'Rating' => 'Be&Auml;�enilme (%s oy)',
	'Keywords' => 'Anahtar kelime',
	'File Size' => 'Dosya boyutu',
	'Dimensions' => 'Boyutlar',
	'Displayed' => 'Gösterilen',
	'Camera' => 'Kamera',
	'Date taken' => 'Al&Auml;�nan tarih',
	'Aperture' => 'Foto&Auml;�raf makinesi aç&Auml;�kl&Auml;�&Auml;�&Auml;�',
	'Exposure time' => '&Auml;�fşa zaman&Auml;�',
	'Focal length' => 'Merkez uzunlu&Auml;�u',
	'Comment' => 'Yorum'
);

$lang_display_comments = array(
	'OK' => 'TAMAM',
	'edit_title' => 'Bu yorumu güncelle',
	'confirm_delete' => 'Bu yorumu silmek istedi&Auml;�inizden emin misiniz ?',
	'add_your_comment' => 'Yorumunuzu ekleyin',
	'your_name' => 'Ad&Auml;�n&Auml;�z',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Bir e-Kart yollay&Auml;�n',
	'invalid_email' => '<b>Dikkat</b> : yanl&Auml;�ş e-Posta adresi !',
	'ecard_title' => 'Size %s taraf&Auml;�ndan bir e-Kart gönderilmiştir',
	'view_ecard' => 'E&Auml;�er e-Kart&Auml;�n&Auml;�z&Auml;� do&Auml;�ru görüntüleyemiyorsan&Auml;�z buraya t&Auml;�klay&Auml;�n',
	'view_more_pics' => 'Daha fazla resim görebilmek için bu ba&Auml;�lant&Auml;�ya t&Auml;�klay&Auml;�n !',
	'send_success' => 'e-Kart&Auml;�n&Auml;�z gönderilmiştir',
	'send_failed' => 'Ana makina e-Kart&Auml;�n&Auml;�z&Auml;� gönderemiyor',
	'from' => 'Kimden',
	'your_name' => 'Sizin ad&Auml;�n&Auml;�z',
	'your_email' => 'Sizin e-Posta adresiniz',
	'to' => 'Kime',
	'rcpt_name' => 'Al&Auml;�c&Auml;�n&Auml;�n &Auml;�smi',
	'rcpt_email' => 'Al&Auml;�c&Auml;�n&Auml;�n e-Posta adresi',
	'greetings' => 'Selamlar',
	'message' => '&Auml;�leti',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Resim bilgileri',
	'album' => 'Albüm',
	'title' => 'Başl&Auml;�k',
	'desc' => 'Aç&Auml;�klama',
	'keywords' => 'Anahta kelimeler',
	'pic_info_str' => '%sx%s - %sKB - %s görüntüleme - %s oy',
	'approve' => 'Resimi onayla',
	'postpone_app' => 'Onaylamay&Auml;� ertele',
	'del_pic' => 'Resimi sil',
	'reset_view_count' => 'Görüntüleme sayac&Auml;�n&Auml;� s&Auml;�f&Auml;�rla',
	'reset_votes' => 'Oylamalar&Auml;� s&Auml;�f&Auml;�rla',
	'del_comm' => 'Yorumlar&Auml;� sil',
	'upl_approval' => 'Yüklemeyi onayla',
	'edit_pics' => 'Resimlerde de&Auml;�işiklik yap',
	'see_next' => 'Sonraki resimleri gör',
	'see_prev' => 'Önceki resimleri gör',
	'n_pic' => '%s resim',
	'n_of_pic_to_disp' => 'Gösterilecek olan resim say&Auml;�s&Auml;�',
	'apply' => 'De&Auml;�işiklikleri uygula'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Grup ad&Auml;�',
	'disk_quota' => 'Disk kotas&Auml;�',
	'can_rate' => 'Resimleri oylayabilir',
	'can_send_ecards' => 'e-Kart gönderebilir',
	'can_post_com' => 'Yorum yazabilir',
	'can_upload' => 'Resim yükleyebilir',
	'can_have_gallery' => 'Kişisel galeri yapabilir',
	'apply' => 'De&Auml;�işiklikleri uygula',
	'create_new_group' => 'Yeni grup yarat',
	'del_groups' => 'Seçilmiş olan grup(lar&Auml;�) sil',
	'confirm_del' => 'Dikkat ! E&Auml;�er bu grubu silerseniz, gruptaki bütün kullan&Auml;�c&Auml;�lar \'Registered\' grubuna transfer edilecektir !\n\nDevam etmek istiyormusunuz ?',
	'title' => 'Kullan&Auml;�c&Auml;� gruplar&Auml;�n&Auml;� düzenle',
	'approval_1' => 'Herkese aç&Auml;�k yükleme onay&Auml;� (1)',
	'approval_2' => 'Kişisel yükleme onay&Auml;� (2)',
	'note1' => '<b>(1)</b> Kişisel galeriye yüklenecek olan resimler yönetici taraf&Auml;�ndan onaylanmal&Auml;�',
	'note2' => '<b>(2)</b> Kullan&Auml;�c&Auml;�ya ait galeriye yükleme yapmak için yönetici onay&Auml;�na gerek',
	'notes' => 'Notlar'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Hoşgeldiniz !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Bu albümü silmek istedi&Auml;�inizden emin misiniz ? \\nBütün resimler ve yorumlar da silinecektir.',
	'delete' => 'S&Auml;�L',
	'modify' => 'ÖZELL&Auml;�KLER',
	'edit_pics' => 'RES&Auml;�MLERDE DE&Auml;�&Auml;�Ş&Auml;�&Auml;�KL&Auml;�LK YAP',
);

$lang_list_categories = array(
	'home' => 'Ana',
	'stat1' => '<b>[pictures]</b> resimler <b>[albums]</b> albümde ve <b>[cat]</b> kategoride, <b>[comments]</b> yorum <b>[views]</b> kere görüntülenmiştir',
	'stat2' => '<b>[pictures]</b> resim <b>[albums]</b> albümde <b>[views]</b> kere görüntülenmiştir',
	'xx_s_gallery' => '%s\ in Galerisi',
	'stat3' => '<b>[pictures]</b> resim <b>[albums]</b> albümde <b>[comments]</b> yorum <b>[views]</b> kere görüntülenmiştir'
);

$lang_list_users = array(
	'user_list' => 'Kullan&Auml;�c&Auml;� listesi',
	'no_user_gal' => 'Albüm yaratma izni olan hiçbir kullan&Auml;�c&Auml;� yok',
	'n_albums' => '%s albüm',
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
	'login' => 'Giriş',
	'enter_login_pswd' => 'Giriş yapabilmek için kullan&Auml;�c&Auml;� ad&Auml;�n&Auml;�z&Auml;� ve şifrenizi kullan&Auml;�n',
	'username' => 'Kullan&Auml;�c&Auml;� ad&Auml;�',
	'password' => 'Şifre',
	'remember_me' => 'Beni hat&Auml;�rla',
	'welcome' => 'Hoşgeldin %s ...',
	'err_login' => '*** Giriş yap&Auml;�lmad&Auml;� tekrar deneyim ***',
	'err_already_logged_in' => 'Zaten Giriş yapm&Auml;�şs&Auml;�n&Auml;�z !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Ç&Auml;�k&Auml;�ş',
	'bye' => 'Görüşmek üzere %s ...',
	'err_not_loged_in' => 'Giriş yapmad&Auml;�n&Auml;�z ki !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Albümü güncelle %s',
	'general_settings' => 'Genel seçenekler',
	'alb_title' => 'Albüm başl&Auml;�&Auml;�&Auml;�',
	'alb_cat' => 'Albüm kategorisi',
	'alb_desc' => 'Albüm aç&Auml;�klamas&Auml;�',
	'alb_thumb' => 'Albüm küçük resimler',
	'alb_perm' => 'Bu albüm için izinler',
	'can_view' => 'Albüm kimler taraf&Auml;�ndan görüntülenebilir',
	'can_upload' => 'Ziyaretçiler resim yükleyebilir',
	'can_post_comments' => 'Ziyaretçiler yorum yollayabilir',
	'can_rate' => 'Ziyaretçiler resim oylayabilir',
	'user_gal' => 'Kullan&Auml;�c&Auml;� galerisi',
	'no_cat' => '* Kategori yok *',
	'alb_empty' => 'Albüm boş',
	'last_uploaded' => 'Son yüklenen',
	'public_alb' => 'Herkes (aç&Auml;�k albüm)',
	'me_only' => 'Sadece ben',
	'owner_only' => 'Albüm sahibi (%s) sadece',
	'groupp_only' => '\'%s\' grubunun üyesi',
	'err_no_alb_to_modify' => 'Güncelleme yapabilece&Auml;�iniz bir albüm yok veritaban&Auml;�nda.',
	'update' => 'Albümü güncelle'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Bu resimi önceden oylad&Auml;�n&Auml;�z',
	'rate_ok' => 'Oyunuz kabul edildi',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
{SITE_NAME} yöneticileri herhangi nahoş malzemeleri en k&Auml;�sa sürede ortadan kald&Auml;�racakt&Auml;�r, her iletiyi okumak imkans&Auml;�zd&Auml;�r. Böylelikle gönderilen bütün iletilerin yöneticilerin veya site sahibinin görüşlerini de&Auml;�il, yazar&Auml;�n&Auml;�n görüşlerini yans&Auml;�tt&Auml;�&Auml;�&Auml;�n&Auml;� kabul etmiş oluyorsunuz (yöneticiler taraf&Auml;�ndan göndeirlenler hariç) bu nedenle yöneticiler veya site sahibi sorumlu tutulamaz. .<br />
<br />
Böylelikle herhangi sövgü dolu, müstehcen, kaba, karalay&Auml;�c&Auml;�, nefret dolu, tehdit edici, cinsel içerikli ve uygulanabilir yasalar&Auml;� çi&Auml;�neyecek içerikli ileti yollamamay&Auml;� kabul etmiş oluyorsunuz. {SITE_NAME} in site sahibinin, yöneticilerinin ve moderatörlerin uygun gördükleri takdirde, içerikleri silebilme veya bunlarda de&Auml;�işiklikler yapabilme haklar&Auml;�na her içerik için her zaman sahip olduklar&Auml;�n&Auml;� da kabul etmiş oluyorsunuz. Bir kullan&Auml;�c&Auml;� olarak veritaban&Auml;�na eklenmiş olan herhangi bir bilgiyi de kabul etmiş oluyorsunuz. Bu bilgi sizin izniniz olmadan hiç birşekilde üçünçü kişilere ulaşt&Auml;�r&Auml;�lmayacakt&Auml;�r, fakat site sahibi ve yöneticileri hacklenme sonucu bu verilen kaybolmas&Auml;� ve/veya kullan&Auml;�lmas&Auml;� sonucu ve/veya çal&Auml;�nmas&Auml;� durumunda sorumlu tutulamaz..<br />
<br />
Bu site bilgisayar&Auml;�n&Auml;�zda bilgi kaydetmek amac&Auml;�yla cookie'ler kullan&Auml;�yor. Bu cookie'ler sadece sizin görüntüleme zevkinizi geliştirmek amac&Auml;�yla kullan&Auml;�l&Auml;�r. E-Posta adresiniz sadece kaydolma bilgilerinizi ve şifrenizi onaylama amac&Auml;� ile kullan&Auml;�l&Auml;�r.<br />
<br />
'Kabul Ediyorum' a basarak bu koşullara ba&Auml;�l&Auml;� kalmay&Auml;� kabul etmiş oluyorsunuz.
EOT;

$lang_register_php = array(
	'page_title' => 'Kullan&Auml;�c&Auml;� kayd&Auml;�',
	'term_cond' => 'Şartlar ve durumlar',
	'i_agree' => 'Kabul Ediyorum',
	'submit' => 'Kayd&Auml;� Gönder',
	'err_user_exists' => 'Yazd&Auml;�&Auml;�&Auml;�n&Auml;�z kullan&Auml;�c&Auml;� ad&Auml;� kullan&Auml;�lmaktad&Auml;�r, başka bir kullan&Auml;�c&Auml;� ad&Auml;� deneyin',
	'err_password_mismatch' => 'Yazd&Auml;�&Auml;�&Auml;�n&Auml;�z şifreler tutmuyor lütfen şifreleriniz tekrar girin',
	'err_uname_short' => 'Kullan&Auml;�c&Auml;� ad&Auml;� en az 2 karakterden oluşmal&Auml;�',
	'err_password_short' => 'Şifre en az 2 karakterden oluşmal&Auml;�',
	'err_uname_pass_diff' => 'Kullan&Auml;�c&Auml;� ad&Auml;� ve şifre farkl&Auml;� olmal&Auml;�',
	'err_invalid_email' => 'E-Posta adresi geçersizdir',
	'err_duplicate_email' => 'Başka bir kullan&Auml;�c&Auml;� bu E-Posta adresini kullanarak kaydolmuştur',
	'enter_info' => 'Bilgilerinizi girin',
	'required_info' => 'Gerekli bilgiler',
	'optional_info' => 'Seçimlik bilgiler',
	'username' => 'Kullan&Auml;�c&Auml;� Ad&Auml;�',
	'password' => 'Şifre',
	'password_again' => 'Şifrenizi yeniden girin',
	'email' => 'E-Posta',
	'location' => 'Konum',
	'interests' => '&Auml;�lgi alanlar&Auml;�',
	'website' => 'Kişisel Sayfa',
	'occupation' => 'Meslek',
	'error' => 'HATA',
	'confirm_email_subject' => '%s - Kay&Auml;�t onay&Auml;�',
	'information' => 'Bilgi',
	'failed_sending_email' => 'Kay&Auml;�t onay&Auml;� e-Postas&Auml;� yollanam&Auml;�yor !',
	'thank_you' => 'Kaydoldu&Auml;�unuz için teşekkür ederiz.<br /><br />Hesab&Auml;�n&Auml;�z&Auml;� nas&Auml;�l etkinleştirece&Auml;�inizi yazan bir E-Posta adersinize yollanm&Auml;�şt&Auml;�r.',
	'acct_created' => 'Hesab&Auml;�n&Auml;�z oluşturulmuştur, şimdi kullan&Auml;�c&Auml;� ad&Auml;�n&Auml;�z&Auml;� ve şifrenizi kullanarak giriş yapabilirsiniz',
	'acct_active' => 'Hesab&Auml;�n&Auml;�z etkinleştirildi, şimdi sisteme giriş yapabilirsiniz',
	'acct_already_act' => 'Bu hesap zaten etkin !',
	'acct_act_failed' => 'Bu hesab etkinleştirilemiyor !',
	'err_unk_user' => 'Seçilen kullan&Auml;�c&Auml;� yok !',
	'x_s_profile' => '%s\'in profili',
	'group' => 'Grup',
	'reg_date' => 'Kat&Auml;�lma tarihi',
	'disk_usage' => 'Disk kullan&Auml;�m&Auml;�',
	'change_pass' => 'Şifre de&Auml;�iştir',
	'current_pass' => 'Şu anki şifre',
	'new_pass' => 'Yeni şifre',
	'new_pass_again' => 'Yeni şifre yeniden',
	'err_curr_pass' => 'Şu anki şifre yanl&Auml;�ş',
	'apply_modif' => 'De&Auml;�işiklikleri uygula',
	'change_pass' => 'Şifremi de&Auml;�iştir',
	'update_success' => 'Profiliniz güncelleştirildi',
	'pass_chg_success' => 'Şifreniz de&Auml;�iştirildi',
	'pass_chg_error' => 'Şifreniz de&Auml;�iştirildi',
);

$lang_register_confirm_email = <<<EOT
{SITE_NAME} de kaydoldu&Auml;�unuz için teşekkür ederiz

Kullan&Auml;�c&Auml;� ad&Auml;�n&Auml;�z : "{USER_NAME}"
Şifreniz : "{PASSWORD}"

Hesab&Auml;�n&Auml;�z&Auml;� etkinleştirebilmek için aşa&Auml;�&Auml;�daki ba&Auml;�lant&Auml;�ya t&Auml;�klay&Auml;�n
Veya tarayc&Auml;�n&Auml;�z&Auml;�n adres çubu&Auml;�una kopyalay&Auml;�n

{ACT_LINK}

Sayf&Auml;�lar&Auml;�m&Auml;�zla,

{SITE_NAME} yöneticileri

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Eleştiri yorumlar&Auml;�',
	'no_comment' => 'Eleştirilecek yorum yok',
	'n_comm_del' => '%s yorum silindi',
	'n_comm_disp' => 'Gösterilecek yorum say&Auml;�s&Auml;�',
	'see_prev' => 'Öncekini gör',
	'see_next' => 'Sonrakini göre',
	'del_comm' => 'Seçilmiş yorumlar&Auml;� sil',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Resim arşivinde ara',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Yeni resimler ara',
	'select_dir' => 'Dizin seç',
	'select_dir_msg' => 'Bu fonksiyon size FTP ile yükled&Auml;�iniz bir grup resmi eklemenizi sa&Auml;�lar.<br /><br />Yükledi&Auml;�iniz resimlerin dizinini seçin',
	'no_pic_to_add' => 'Eklenecek resim yok',
	'need_one_album' => 'Bu fonksiyonu kullanabilmek için en az bir albüme ihtiyac&Auml;�n&Auml;�z var',
	'warning' => 'Dikkat',
	'change_perm' => 'Program bu dizine yazam&Auml;�yor, yazabilmek için CHMOD unu 755 veya 777 yapman&Auml;�z gerekiyor resimleri yüklemeden önce !',
	'target_album' => '<b>Resimlerini &quot;</b>%s<b>&quot; e gönder </b>%s',
	'folder' => 'Klasör',
	'image' => 'Resim',
	'album' => 'Albüm',
	'result' => 'Sonuç',
	'dir_ro' => 'Yaz&Auml;�lamaz. ',
	'dir_cant_read' => 'Okunamaz. ',
	'insert' => 'Galeriye yeni resim ekle',
	'list_new_pic' => 'Yeni resimlerin listesi',
	'insert_selected' => 'Seçilmiş resimleri ekle',
	'no_pic_found' => 'Yeni resim bulunamad&Auml;�',
	'be_patient' => 'Lütfen bekleyiniz, program işleminiz yapmaktad&Auml;�r',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : Resminiz başar&Auml;� ile eklenmiştir.'.
				'<li><b>DP</b> : Resim bir kopya, başka bir kopyas&Auml;� veritaban&Auml;�nda bulunmaktad&Auml;�r'.
				'<li><b>PB</b> : Resim yüklenemedi, resimlerin bulundu&Auml;�u dizinlerin do&Auml;�ru ayarlanm&Auml;�ş oldu&Auml;�undan emin olun'.
				'<li>E&Auml;�er OK, DP, PB \'signs\' işaretlerinden biri ç&Auml;�km&Auml;�yorsa, k&Auml;�r&Auml;�k resmin üzerine t&Auml;�klay&Auml;�n PHP hata iletisini görebilmek için'.
				'<li>E&Auml;�er sunucu zaman ba&Auml;�lant&Auml;� hatas&Auml;� olursa, yenile tuşuna bas&Auml;�n'.
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
	'title' => 'Resim yükleme',
	'max_fsize' => 'En fazla izin verilen boyut %s KB',
	'album' => 'Albüm',
	'picture' => 'Resim',
	'pic_title' => 'Resim Başl&Auml;�&Auml;�&Auml;�',
	'description' => 'Resim aç&Auml;�klamas&Auml;�',
	'keywords' => 'Anahat kelimeler (her anahtar kelimesi aras&Auml;�nda boşluk b&Auml;�rak&Auml;�n)',
	'err_no_alb_uploadables' => 'Yükleyebilece&Auml;�iniz herhangi bir albümünüz yok',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Kullan&Auml;�c&Auml;�lar düzenle',
	'name_a' => '&Auml;�simler küçükten büyü&Auml;�e s&Auml;�rala ',
	'name_d' => '&Auml;�simler büyüktan küçü&Auml;�e s&Auml;�rala',
	'group_a' => 'Gruplar&Auml;� küçükten büyü&Auml;�e s&Auml;�rala',
	'group_d' => 'Gruplar&Auml;� büyüktan küçü&Auml;�e s&Auml;�rala',
	'reg_a' => 'Kay&Auml;�t olma tarihi küçükten büyü&Auml;�e s&Auml;�rala',
	'reg_d' => 'Kay&Auml;�t olma tarihi büyüktan küçü&Auml;�e s&Auml;�rala',
	'pic_a' => 'Resim sayma küçükten bü&Auml;�ü&Auml;�e',
	'pic_d' => 'Resim sayma büyükten küçü&Auml;�e',
	'disku_a' => 'Disk kullan&Auml;�m&Auml;� küçükten büyü&Auml;�e',
	'disku_d' => 'Disk kullan&Auml;�m&Auml;� büyükten küçü&Auml;�e',
	'sort_by' => 'Kullan&Auml;�c&Auml;�lar&Auml;� göre s&Auml;�rala',
	'err_no_users' => 'Kullan&Auml;�c&Auml;� tablosu boş !',
	'err_edit_self' => 'Kendi profilinizi düzenleyemezsiniz, bunun için \'My profile\' ba&Auml;�lant&Auml;�s&Auml;�n&Auml;� kullan&Auml;�n',
	'edit' => 'DÜZENLE',
	'delete' => 'S&Auml;�L',
	'name' => 'Kullan&Auml;�c&Auml;� ad',
	'group' => 'Grup',
	'inactive' => 'Pasif',
	'operations' => '&Auml;�şlemler',
	'pictures' => 'Resimler',
	'disk_space' => 'Kullan&Auml;�lan alan / kota',
	'registered_on' => 'Kay&Auml;�t olma tarihi',
	'u_user_on_p_pages' => '%d kullan&Auml;�c&Auml;� %d sayfada',
	'confirm_del' => 'Bu kullan&Auml;�c&Auml;�y S&Auml;�LMEK istedi&Auml;�inizden emin misiniz ? \\nBütün resim ve albümleri silinecektir.',
	'mail' => 'POSTA',
	'err_unknown_user' => 'Seçilen kullan&Auml;�c&Auml;� yok !',
	'modify_user' => 'Kullan&Auml;�c&Auml;�y Düzenle',
	'notes' => 'Notlar',
	'note_list' => '<li>Şu anki şifreyi de&Auml;�iştirmek istemiyorsan&Auml;�z Şifre alan&Auml;�n&Auml;� boş b&Auml;�rak&Auml;�n&Auml;�z',
	'password' => 'Şifre',
	'user_active_cp' => 'Kulann&Auml;�c&Auml;� etkin',
	'user_group_cp' => 'Kullan&Auml;�c&Auml;� grubu',
	'user_email' => 'Kullan&Auml;�c&Auml;� e-Posta',
	'user_web_site' => 'Kullan&Auml;�c&Auml;� a&Auml;� sitesi',
	'create_new_user' => 'Yeni kullan&Auml;�c&Auml;� oluştur',
	'user_from' => 'Kullan&Auml;�c&Auml;� konumu',
	'user_interests' => 'Kullan&Auml;�c&Auml;� &Auml;�lgi alanlar&Auml;�',
	'user_occ' => 'Kullan&Auml;�c&Auml;� Mesle&Auml;�i',
);
?>
