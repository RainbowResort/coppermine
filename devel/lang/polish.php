<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery                                                 //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gr�gory DEMAR <gdemar@wanadoo.fr>               //
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
//  Polish language file - version 1.0                                       //
//  contributed by Bogdan (koszalkb@wizard.ae.krakow.pl)                     //
// ------------------------------------------------------------------------- //

$lang_charset = 'iso-8859-2';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bajt�w', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Nie', 'Pon', 'Wto', '�ro', 'Czw', 'Pi�', 'Sob');
$lang_month = array('Sty', 'Lut', 'Mar', 'Kwi', 'Maj', 'Cze', 'Lip', 'Sie', 'Wrz', 'Pa�', 'Lis', 'Gru');

// Some common strings
$lang_yes = 'Tak';
$lang_no  = 'Nie';
$lang_back = 'WSTECZ';
$lang_continue = 'KONTYNUUJ';
$lang_info = 'Informacja';
$lang_error = 'B��d';

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
	'random' => 'Losowe obrazy',
	'lastup' => 'Ostatnio dodane',
	'lastcom' => 'Ostatnie komentarze',
	'topn' => 'Najcz�ciej ogl�dane',
	'toprated' => 'Najwy�ej oceniane',
	'lasthits' => 'Ostatnio ogl�dane',
	'search' => 'Wyniki wyszukiwania'
);

$lang_errors = array(
	'access_denied' => 'Nie masz uprawnie� dost�pu do tej strony.',
	'perm_denied' => 'Nie masz uprawnie� do przeprowadzenia tej operacji.',
	'param_missing' => 'Skrypt wywo�any bez wymaganego(ych) parametru(�w).',
	'non_exist_ap' => 'Wybrany album/obraz nie istnieje!',
	'quota_exceeded' => 'Przekroczona przestrze� dyskowa<br /><br />Twoja przestrze� dyskowa to [quota]K, Twoje obrazy aktualnie zajmuja [space]K, dodanie tego obrazu spowodowa�oby przekroczenie dost�pnej przestrzeni dyskowej.',
	'gd_file_type_err' => 'Podczas korzystania z biblioteki graficznej GD dopuszczalne typy plik�w to jedynie JPEG i PNG.',
	'invalid_image' => 'Obraz kt�ry wgra�e� jest uszkodzony lub nie mo�e zosta� przetworzony przez bibliotek� GD',
	'resize_failed' => 'Nie mo�na utworzy� miniatury lub pomniejszonego obrazu.',
	'no_img_to_display' => 'Brak obrazu do wy�wietlenia',
	'non_exist_cat' => 'Wybrana kategoria nie istnieje',
	'orphan_cat' => 'Kategoria ma nieistniej�c� grup� nadrz�dn�, uruchom mened�era kategori aby naprawi� ten problem.',
	'directory_ro' => 'Katalog \'%s\' nie jest zapisywalny, obrazy nie mog� zosta� usuni�te',
	'non_exist_comment' => 'Wskazany komentarz nie istnieje.',
	'pic_in_invalid_album' => 'Obraz jest w nieistniej�cym albumie (%s)!?'
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'Id� do listy album�w',
	'alb_list_lnk' => 'Lista album�w',
	'my_gal_title' => 'Id� do mojej osobistej galerii',
	'my_gal_lnk' => 'Moja galeria',
	'my_prof_lnk' => 'M�j profil',
	'adm_mode_title' => 'Prze��cz do trybu administratora',
	'adm_mode_lnk' => 'Tryb administratora',
	'usr_mode_title' => 'Prze��cz do trybu u�ytkownika',
	'usr_mode_lnk' => 'Tryb u�ytkownika',
	'upload_pic_title' => 'Za�aduj obraz do albumu',
	'upload_pic_lnk' => 'Za�aduj obraz',
	'register_title' => 'Stw�rz konto',
	'register_lnk' => 'Zarejestruj',
	'login_lnk' => 'Zaloguj',
	'logout_lnk' => 'Wyloguj',
	'lastup_lnk' => 'Ostatnio dodane',
	'lastcom_lnk' => 'Ostatnie komentarze',
	'topn_lnk' => 'Najcz�ciej ogl�dane',
	'toprated_lnk' => 'Najwy�ej oceniane',
	'search_lnk' => 'Szukaj',
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Pozwolenie �adowania',
	'config_lnk' => 'Konfiguracja',
	'albums_lnk' => 'Albumy',
	'categories_lnk' => 'Kategorie',
	'users_lnk' => 'U�ytkownicy',
	'groups_lnk' => 'Grupy',
	'comments_lnk' => 'Komentarze',
	'searchnew_lnk' => 'Wsadowe dodawanie obraz�w',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Tw�rz / porz�dkuj moje albumy',
	'modifyalb_lnk' => 'Modyfikuj moje albumy',
	'my_prof_lnk' => 'M�j profil',
);

$lang_cat_list = array(
	'category' => 'Kategoria',
	'albums' => 'Albumy',
	'pictures' => 'Obrazy',
);

$lang_album_list = array(
	'album_on_page' => '%d album�w na %d stronie(ach)'
);

$lang_thumb_view = array(
	'date' => 'DATA',
	'name' => 'NAZWA',
	'sort_da' => 'Sortuj wed�ug daty rosn�co',
	'sort_dd' => 'Sortuj wed�ug daty malej�co',
	'sort_na' => 'Sortuj wed�ug nazwy rosn�co',
	'sort_nd' => 'Sortuj wed�ug nazwy malej�co',
	'pic_on_page' => '%d obraz�w na %d stronie(ach)',
	'user_on_page' => '%d u�ytkownik�w na %d stronie(ach)'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Powr�t do strony miniatur',
	'pic_info_title' => 'Poka�/ukryj informacje o obrazie',
	'slideshow_title' => 'Pokaz slajd�w',
	'ecard_title' => 'Wy�lij ten obraz jako e-kartk�',
	'ecard_disabled' => 'e-kartki nieaktywne',
	'ecard_disabled_msg' => 'Nie masz uprawnie� do wysy�ania e-kartek',
	'prev_title' => 'Poka� poprzedi obraz',
	'next_title' => 'Poka� nast�pny obraz',
	'pic_pos' => 'OBRAZ %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Oce� ten obraz ',
	'no_votes' => '(Dotychczas bez g�os�w)',
	'rating' => '(aktualna ocena : %s / 5 z %s g�osami)',
	'rubbish' => 'Smie�',
	'poor' => 'S�aby',
	'fair' => '�redni',
	'good' => 'Dorby',
	'excellent' => 'Wy�mienity',
	'great' => 'Wspania�y',
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
	CRITICAL_ERROR => 'B��d krytyczny',
	'file' => 'Plik: ',
	'line' => 'Linia: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Nazwa pliku : ',
	'filesize' => 'Rozmiar pliku : ',
	'dimensions' => 'Wymiary : ',
	'date_added' => 'Data dodania : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s komentarzy',
	'n_views' => '%s ods�on',
	'n_votes' => '(%s g�os�w)'
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
	'Exclamation' => 'Wykrzyknik',
	'Question' => 'Pytanie',
	'Very Happy' => 'Bardzo szcz�liwy',
	'Smile' => 'U�miech',
	'Sad' => 'Smutny',
	'Surprised' => 'Zaskoczony',
	'Shocked' => 'Zaszokowany',
	'Confused' => 'Zak�opotany',
	'Cool' => 'Spoko',
	'Laughing' => '�miech',
	'Mad' => 'Szalony',
	'Razz' => 'Razz',
	'Embarassed' => 'Zawstydzony',
	'Crying or Very sad' => 'P�acze lub bardzo smutny',
	'Evil or Very Mad' => 'Z�y lub bardzo w�ciek�y',
	'Twisted Evil' => 'Twisted Evil',
	'Rolling Eyes' => 'Przewraca oczyma',
	'Wink' => 'Mrugni�cie',
	'Idea' => 'Pomys�',
	'Arrow' => 'Strza�ka',
	'Neutral' => 'Neutralny',
	'Mr. Green' => 'Pan Zielony',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'Opuszczanie trybu administratora...',
	1 => '�adowanie trybu administratora...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Albumy musz� mie� nazwy!',
	'confirm_modifs' => 'Czy jeste� pewny, �e chcesz dokona� tych modyfikacji?',
	'no_change' => 'Nie dokona�e� �adnej zmiany!',
	'new_album' => 'Nowy album',
	'confirm_delete1' => 'Czy jeste� pewny, �e chcesz usun�� ten album?',
	'confirm_delete2' => '\nWszystkie obrazy i komentarze, kt�re zawiera zostan� utracone!',
	'select_first' => 'Najpierw wybierz album',
	'alb_mrg' => 'Menad�er Album�w',
	'my_gallery' => '* Moja galeria *',
	'no_category' => '* Bez kategorii *',
	'delete' => 'Usu�',
	'new' => 'Nowy',
	'apply_modifs' => 'Wprowad� zmiany',
	'select_category' => 'Wybierz kategori�',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Parametry wymagane dla \'%s\'operacji nie podane!',
	'unknown_cat' => 'Wybrana kategoria nie figuruje w bazie danych',
	'usergal_cat_ro' => 'Kategoria galerii u�ytkownika nie mo�e zosta� usuni�ta!',
	'manage_cat' => 'Zarz�dzaj kategoriami',
	'confirm_delete' => 'Czy jeste� pewny, �e chcesz USUN�� t� kategori�',
	'category' => 'Kategoria',
	'operations' => 'Operacje',
	'move_into' => 'Przenie� do',
	'update_create' => 'Aktualizuj/Tw�rz kategori�',
	'parent_cat' => 'Kategoria nadrz�dna',
	'cat_title' => 'Tytu� kategorii',
	'cat_desc' => 'Opis kategorii'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Konfiguracja',
	'restore_cfg' => 'Przywr�� ustawienia fabryczne',
	'save_cfg' => 'Zapisz now� konfiguracj�',
	'notes' => 'Notatki',
	'info' => 'Informacja',
	'upd_success' => 'Konfiguracja Coppermine zosta�a zaktualizowana',
	'restore_success' => 'Domy�lna konfiguracja Coppermine przywr�cona',
	'name_a' => 'Nazwa rosn�co',
	'name_d' => 'Nazwa malej�ca',
	'date_a' => 'Data rosn�co',
	'date_d' => 'Data malej�co'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Ustawienia g��wne',
	array('Nazwa galerii', 'gallery_name', 0),
	array('Opis galerii', 'gallery_description', 0),
	array('E-mail administratora galerii', 'gallery_admin_email', 0),
	array('Adres docelowy dla odno�nika \'Zobacz wi�cej obraz�w\' w e-kartkach', 'ecards_more_pic_target', 0),
	array('J�zyk', 'lang', 5),
	array('Temat', 'theme', 6),

	'Widok listy album�w',
	array('Szeroko�� g��wnej tabeli (w pikselach lub %)', 'main_table_width', 0),
	array('Liczba poziom�w kategorii do wy�wietlenia', 'subcat_level', 0),
	array('Liczba album�w do wy�wietlenia', 'albums_per_page', 0),
	array('Liczba kolumn dla listy album�w', 'album_list_cols', 0),
	array('Rozmiar miniatur w pikselach', 'alb_list_thumb_size', 0),
	array('Zawarto�� strony g��wnej', 'main_page_layout', 0),

	'Widok miniatur',
	array('Liczba kolumn na stronie miniatur', 'thumbcols', 0),
	array('Liczba wierszy na stronie miniatur', 'thumbrows', 0),
	array('Maksymalna liczba tabs do wy�wietlenia', 'max_tabs', 0),
	array('Poka� caption obrazu (opr�cz tytu�u) pod miniatur�', 'caption_in_thumbview', 1),
	array('Poka� liczb� komentarzy poni�ej miniatury', 'display_comment_count', 1),
	array('Domy�lny porz�dek sortowania dla obraz�w', 'default_sort_order', 3),
	array('Minimalna liczba g�os�w do pojawienia si� obrazu na li�cie \'najwy�ej-oceniane\' ', 'min_votes_for_rating', 0),

	'Widok obrazu &amp; Ustawienia komentarzy',
	array('Szeroko�� tabeli dla ekranu obraz�w (piksele lub %)', 'picture_table_width', 0),
	array('Informacja o obrazie domy�lnie widoczna', 'display_pic_info', 1),
	array('Filtrowanie niecenzuralnych s��w w komentarzach', 'filter_bad_words', 1),
	array('Pozw�l na u�mieszki w komentarzach', 'enable_smilies', 1),
	array('Maksymalna d�ugo�� opisu obrazu', 'max_img_desc_length', 0),
	array('Maksymalna liczba znak�w w s�owie', 'max_com_wlength', 0),
	array('Maksymalna liczba linii w komentarzu', 'max_com_lines', 0),
	array('Maksymalna d�ugo�� komentarza', 'max_com_size', 0),

	'Ustawienia obraz�w i miniatur',
	array('Jako�� dla plikow JPG', 'jpeg_qual', 0),
	array('Maksymalna szeroko�� lub wysoko�� miniatury <b>*</b>', 'thumb_width', 0),
	array('Tw�rz po�rednie obrazy','make_intermediate',1),
	array('Maksymalna szeroko�� lub wysoko�� po�redniego obrazu <b>*</b>', 'picture_width', 0),
	array('Maksymalny rozmiar wgrywanych plik�w (KB)', 'max_upl_size', 0),
	array('Maksymalna szeroko�� lub wysoko�� dodwanych obraz�w (w pikselach)', 'max_upl_width_height', 0),

	'Ustawienia u�ytkownika',
	array('Zezwalaj na rejestracj� nowych u�ytkownik�w', 'allow_user_registration', 1),
	array('Rejestracja u�ytkownika wymaga potwierdzenia e-mail', 'reg_requires_valid_email', 1),
	array('Zezwalaj aby dw�ch u�ytkownik�w dzieli�o ten sam adres e-mail', 'allow_duplicate_emails_addr', 1),
	array('U�ytkownicy mog� tworzy� prywatne albumy', 'allow_private_albums', 1),

	'Dodakowe pola opisu obrazu (pozostaw puste je�li nieu�ywane)',
	array('Nazwa pola 1', 'user_field1_name', 0),
	array('Nazwa pola 2', 'user_field2_name', 0),
	array('Nazwa pola 3', 'user_field3_name', 0),
	array('Nazwa pola 4', 'user_field4_name', 0),

	'Zaawansowane ustawienia obraz�w i miniatur',
	array('Znaki niedozwolone w nazwach plik�w', 'forbiden_fname_char',0),
	array('Akceptowane rozszerzenia plik�w dla dodawanych obraz�w', 'allowed_file_extensions',0),
	array('Metoda zmiany rozdzielczo�ci obraz�w','thumb_method',2),
	array('�cie�ka do ImageMagick \'convert\' utility (przyk�adowo /usr/bin/X11/)', 'impath', 0),
	array('Dozwolone typy obraz�w (wa�ne tylko dla ImageMagick)', 'allowed_img_types',0),
	array('Opcje linii komend dla ImageMagick', 'im_options', 0),
	array('Czytaj dane nag��wka EXIF w plikach JPEG', 'read_exif_data', 1),
	array('Katalog albumu <b>*</b>', 'fullpath', 0),
	array('Katalog obraz�w u�ytkownika <b>*</b>', 'userpics', 0),
	array('Przedrostek dla obraz�w po�rednich <b>*</b>', 'normal_pfx', 0),
	array('Przedrostek dla miniatur <b>*</b>', 'thumb_pfx', 0),
	array('Domy�lny tryb katalog�w', 'default_dir_mode', 0),
	array('Domy�lny tryb obraz�w', 'default_file_mode', 0),

	'Ustawienia Ciasteczek &amp; Zestawu znak�w',
	array('Nazwa ciasteczka u�ywana przez skrypt', 'cookie_name', 0),
	array('�cie�ka ciasteczka u�ywana przez skrypt', 'cookie_path', 0),
	array('Kodowanie znak�w', 'charset', 4),

	'Ustawienia inne',
	array('W��cz tryb debug', 'debug_mode', 1),

	'<br /><div align="center">(*) Pola oznaczone * nie mog� by� zmieniane je�eli masz ju� jakie� obrazy w swojej galerii</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Musisz wpisa� swoje imi� i komentarz',
	'com_added' => 'Tw�j komentarz zosta� dodany',
	'alb_need_title' => 'Musisz poda� tytu� albumu!',
	'no_udp_needed' => 'Brak potrzeby uaktualnienia.',
	'alb_updated' => 'Album zosta� uaktualniony',
	'unknown_album' => 'Wskazany album nie sitnieje albo nie masz pozwolenia na dodawanie do tego albumu',
	'no_pic_uploaded' => 'Nie wgrano �adnego obrazu!<br /><br />Je�eli naprawd� wskaza�e� obraz do dodania, sprawd� czy serwer dopuszcza wgrywanie plik�w...',
	'err_mkdir' => 'Nieudane tworzenie katalogu %s !',
	'dest_dir_ro' => 'Katalog docelowy %s nie jest zapisywalny przez skrypt!',
	'err_move' => 'Nie mo�na przenie�� %s do %s !',
	'err_fsize_too_large' => 'Rozmiar obrazu dodanego przez Ciebie jest zbyt du�y (najwi�kszy dopuszczany to %s x %s) !',
	'err_imgsize_too_large' => 'Rozmiar pliku dodanego przez Ciebie jest zbyt du�y (najwi�kszy dopuszczany to %s KB) !',
	'err_invalid_img' => 'Plik, kt�ry doda�e� nie jest poprawnym obrazem !',
	'allowed_img_types' => 'Mo�esz doda� tylko %s obraz�w.',
	'err_insert_pic' => 'Obraz \'%s\' nie mo�e zosta� umieszczony w albumie ',
	'upload_success' => 'Tw�j obraz zosta� dodany poprawnie<br /><br />Stanie si� on widoczny po akceptacji administratora.',
	'info' => 'Informacja',
	'com_added' => 'Komentarz dodany',
	'alb_updated' => 'Album zaktualizowany',
	'err_comment_empty' => 'Tw�j komentarz jest pusty !',
	'err_invalid_fext' => 'Akceptowane s� tylko pliki z nast�puj�cymi rozszerzeniami : <br /><br />%s.',
	'no_flood' => 'Przykro mi, ale jeste� aktualnie autorem ostatniego komentarza wys�anego dla tego obrazu<br /><br />Edytuj komentarz, kt�ry wys�a�e� je�li chcesz go zmieni�',
	'redirect_msg' => 'Jeste� przekierowywany.<br /><br /><br />Kliknij \'KONTYNUUJ\' je�li strona nie od�wie�y si� automatycznie',
	'upl_success' => 'Tw�j obraz zosta� dodany poprawnie',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Nag��wek',
	'fs_pic' => 'obraz pe�nowymiarowy',
	'del_success' => 'skasowany poprawnie',
	'ns_pic' => 'normalny rozmiar obrazu',
	'err_del' => 'nie mo�e zosta� skasowany',
	'thumb_pic' => 'miniatura',
	'comment' => 'komentarz',
	'im_in_alb' => 'obraz w albumie',
	'alb_del_success' => 'Album \'%s\' skasowany',
	'alb_mgr' => 'Menad�er album�w',
	'err_invalid_data' => 'Otrzymano nieprawid�owe dane w \'%s\'',
	'create_alb' => 'Tworzenie albumu \'%s\'',
	'update_alb' => 'Uaktualnianie albumu \'%s\' with title \'%s\' and index \'%s\'',
	'del_pic' => 'Kasuj obraz',
	'del_alb' => 'Kasuj album',
	'del_user' => 'Kasuj u�ytkownika',
	'err_unknown_user' => 'Wskazany u�ytkownik nie istnieje !',
	'comment_deleted' => 'Komentarz zosta� pomy�lnie dodany',
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
	'confirm_del' => 'Czy jeste� pewny, �e chcesz USUN�� ten obraz ? \\nKomentarze r�wnie� zostan� usuni�te.',
	'del_pic' => 'USU� TEN OBRAZ',
	'size' => '%s x %s pikseli',
	'views' => '%s razy',
	'slideshow' => 'Pokaz slajd�w',
	'stop_slideshow' => 'ZATRZYMAJ POKAZ',
	'view_fs' => 'Kliknij by zobaczy� oryginalny obraz',
);

$lang_picinfo = array(
	'title' =>'Informacje o obrazie',
	'Filename' => 'Nazwa pliku',
	'Album name' => 'Nazwa albumu',
	'Rating' => 'Ocena (%s g�os�w)',
	'Keywords' => 'S�owa kluczowe',
	'File Size' => 'Rozmiar pliku',
	'Dimensions' => 'Wymiary',
	'Displayed' => 'Wy�wietlany',
	'Camera' => 'Aparat',
	'Date taken' => 'Data wykonania',
	'Aperture' => 'Przys�ona',
	'Exposure time' => 'Czas ekspozycji',
	'Focal length' => 'D�ugo�� ogniskowej',
	'Comment' => 'Komentarz'
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => 'Edytuj ten komentarz',
	'confirm_delete' => 'Czy jeste� pewny, �e chcesz usun�� ten komentarz ?',
	'add_your_comment' => 'Dodaj sw�j komentarz',
	'your_name' => 'Twoje imi�',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Wy�lij e-kartk�',
	'invalid_email' => '<b>Uwaga</b> : nieprawid�owy adres e-mail !',
	'ecard_title' => 'e-kartka od %s dla Ciebie',
	'view_ecard' => 'Je�eli e-kartka nie jest wy�wietlana prawid�owo, kliknij ten odno�nik',
	'view_more_pics' => 'Kliknij ten odno�nik by zobaczy� wi�cej obraz�w !',
	'send_success' => 'Twoja e-kartka zosta�a wys�ana',
	'send_failed' => 'Przykro nam ale serwer nie mo�e wys�a� twojej e-kartki...',
	'from' => 'Od',
	'your_name' => 'Twoje imi�',
	'your_email' => 'Tw�j adres e-mail',
	'to' => 'Do',
	'rcpt_name' => 'Imi� odbiorcy',
	'rcpt_email' => 'Adres e-mail odbiorcy',
	'greetings' => 'Pozdrowienia',
	'message' => 'Wiadomo��',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Info&nbsp;obrazu',
	'album' => 'Album',
	'title' => 'Tytu�',
	'desc' => 'Opis',
	'keywords' => 'S�owa kluczowe',
	'pic_info_str' => '%sx%s - %sKB - %s ods�on - %s g�os�w',
	'approve' => 'Dopu�� obraz',
	'postpone_app' => 'Od�� dopuszczenie na p�niej',
	'del_pic' => 'Usu� obraz',
	'reset_view_count' => 'Wyzeruj licznik ods�on',
	'reset_votes' => 'Wyzeruj g�osy',
	'del_comm' => 'Usu� komentarze',
	'upl_approval' => 'Pozwolenie �adowania',
	'edit_pics' => 'Edytuj obrazy',
	'see_next' => 'Poka� nast�pny obraz',
	'see_prev' => 'Poka� poprzedni obraz',
	'n_pic' => '%s obraz�w',
	'n_of_pic_to_disp' => 'Liczba obraz�w do wy�wietlenia',
	'apply' => 'Wprowad� zmiany'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Nazwa grupy',
	'disk_quota' => 'Przestrze� dyskowa',
	'can_rate' => 'Mo�e ocania� obrazy',
	'can_send_ecards' => 'Mo�e wysy�a� e-kartki',
	'can_post_com' => 'Mo�e wysy�a� komentarze',
	'can_upload' => 'Mo�e dodawa� obrazy',
	'can_have_gallery' => 'Mo�e mie� osobist� galeri�',
	'apply' => 'Wprowad� zmiany',
	'create_new_group' => 'Tw�rz now� grup�',
	'del_groups' => 'Usu� wskazan�(e) grup�(y)',
	'confirm_del' => 'Uwaga, przy usuwaniu grupy, u�ytkownicy nale��cy do tej grupy zostan� przeniesieni do \'Registered\' grupy !\n\nCzy chcesz kontynuowa� ?',
	'title' => 'Zarz�dzaj grupami u�ytkownik�w',
	'approval_1' => 'Pub. pozw. �adowania (1)',
	'approval_2' => 'Pryw. pozw. �adowania (2)',
	'note1' => '<b>(1)</b> Dodawanie do albumu publicznego wymaga pozwolenia administratora',
	'note2' => '<b>(2)</b> Dodawanie do albumu, ktr�ry nale�y do (innego) u�ytkownika wymaga pozwolenia administratora',
	'notes' => 'Notatki'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Witaj !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Czy jeste� pewny, �e chcesz USUN�� ten album ? \\nWszystkie obrazy i komentarze r�wnie� zostan� usuni�te.',
	'delete' => 'USU�',
	'modify' => 'W�A�CIWO�CI',
	'edit_pics' => 'EDYTUJ OBRAZY',
);

$lang_list_categories = array(
	'home' => 'Strona g��wna',
	'stat1' => '<b>[pictures]</b> obraz�w w <b>[albums]</b> albumach i <b>[cat]</b> kategoriach z <b>[comments]</b> komentarzami prz�gl�danymi <b>[views]</b> razy',
	'stat2' => '<b>[pictures]</b> obraz�w w <b>[albums]</b> albumach ogl�danych <b>[views]</b> razy',
	'xx_s_gallery' => '%s\'s Galeria',
	'stat3' => '<b>[pictures]</b> obraz�w w <b>[albums]</b> albumach z <b>[comments]</b> komentarzami, ogl�dane <b>[views]</b> razy'
);

$lang_list_users = array(
	'user_list' => 'Lista u�ytkownika',
	'no_user_gal' => 'Brak galerii u�ytkownika',
	'n_albums' => '%s album(�w)',
	'n_pics' => '%s obraz(�w)'
);

$lang_list_albums = array(
	'n_pictures' => '%s obraz�w',
	'last_added' => ', ostatni dodany %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Logowanie',
	'enter_login_pswd' => 'Wprowad� nazw� u�ytkownika i has�o aby si� zalogowa�',
	'username' => 'Nazwa u�ytkownika',
	'password' => 'Has�o',
	'remember_me' => 'Zapami�taj mnie',
	'welcome' => 'Witaj %s ...',
	'err_login' => '*** B��d logowania. Spr�buj ponownie ***',
	'err_already_logged_in' => 'Jeste� aktualnie zalogowany !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Wylogowywanie',
	'bye' => 'Pa pa %s ...',
	'err_not_loged_in' => 'Nie jeste� zalogowany !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Uaktualnij album %s',
	'general_settings' => 'Ustawienia generalne',
	'alb_title' => 'Tytu� albumu',
	'alb_cat' => 'Kategoria albumu',
	'alb_desc' => 'Opis albumu',
	'alb_thumb' => 'Miniatura albumu',
	'alb_perm' => 'Pozwolenia dla tego albumu',
	'can_view' => 'Album mo�e by� ogl�dany przez',
	'can_upload' => 'Zwiedzaj�cy nie mog� dodawa� obraz�w',
	'can_post_comments' => 'Zwiedzaj�cy mog� wysy�a� komentarze',
	'can_rate' => 'Zwiedzaj�cy mog� ocenia� obrazy',
	'user_gal' => 'Galeria u�ytkownika',
	'no_cat' => '* Bez kategorii *',
	'alb_empty' => 'Album jest pusty',
	'last_uploaded' => 'Ostatnio dodane',
	'public_alb' => 'Wszyscy (album publiczny)',
	'me_only' => 'Tylko ja',
	'owner_only' => 'Tylko w�a�ciciel albumu (%s)',
	'groupp_only' => 'Cz�onkowie grupy \'%s\' ',
	'err_no_alb_to_modify' => 'W bazie danych brak albumu, kt�ry mo�esz zmodyfikowa�.',
	'update' => 'Auktualnij album'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Przykro mi ale ju� oceni�e� ten obraz',
	'rate_ok' => 'Tw�j g�os zosta� zaakceptowany',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
While the administrators of {SITE_NAME} will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every post. Therefore you acknowledge that all posts made to this site express the views and opinions of the author and not the administrators or webmaster (except for posts by these people) and hence will not be held liable.<br />
<br />
You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-orientated or any other material that may violate any applicable laws. You agree that the webmaster, administrator and moderators of {SITE_NAME} have the right to remove or edit any content at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent the webmaster and administrator cannot be held responsible for any hacking attempt that may lead to the data being compromised.<br />
<br />
This site uses cookies to store information on your local computer. These cookies serve only to improve your viewing pleasure. The email address is used only for confirming your registration details and password.<br />
<br />
By clicking 'I agree' below you agree to be bound by these conditions.
EOT;

$lang_register_php = array(
	'page_title' => 'Rejestracja u�ytkownika',
	'term_cond' => 'Zwroty i warunki',
	'i_agree' => 'Zgadzam si�',
	'submit' => 'Wy�lij rejestracj�',
	'err_user_exists' => 'Nazwa u�ytkownika, kt�r� wprowadzi�e� ju� istnieje. Prosz�, wybierz inn�',
	'err_password_mismatch' => 'Oba has�a nie pokrywaj� si� ze sob�, prosz� wprowad� je ponownie',
	'err_uname_short' => 'Nazwa u�ytkownika musi mie� conajmniej 2 znaki',
	'err_password_short' => 'Has�o musi mie� conajmniej 2 znaki',
	'err_uname_pass_diff' => 'Nazwa u�ytkownika i has�o musz� by� r�ne',
	'err_invalid_email' => 'Niepoprawny adres e-mail',
	'err_duplicate_email' => 'Inny u�ytkownik jest aktualnie zarejestrowany z adresem e-mail takim jaki poda�e�',
	'enter_info' => 'Wprowad� informacje rejestracyjne',
	'required_info' => 'Informacja wymagana',
	'optional_info' => 'Informacja opcjonalna',
	'username' => 'Nazwa u�ytkownika',
	'password' => 'Has�o',
	'password_again' => 'Powt�rz has�o',
	'email' => 'E-mail',
	'location' => 'Lokalizacja',
	'interests' => 'Zainteresowania',
	'website' => 'Strona domowa',
	'occupation' => 'Zaw�d',
	'error' => 'B��D',
	'confirm_email_subject' => '%s - Potwierdzenie rejestracji',
	'information' => 'Informacja',
	'failed_sending_email' => 'E-mail potwierdzaj�cy rejestracj� nie mo�e zosta� wys�any !',
	'thank_you' => 'Dzi�kuj� za zarejestrowanie.<br /><br />E-mail z informacj� jak aktywowa� Twoje konto zosta� wys�any pod adres, kt�ry poda�e�.',
	'acct_created' => 'Twoje konto zosta�o utworzone i teraz mo�esz zalogowa� si� podaj�c Twoj� nazw� u�ytkownika i has�o',
	'acct_active' => 'Twoje konto jest teraz aktywne i mo�esz zalogowa� si� podaj�c Twoj� nazw� u�ytkownika i has�o',
	'acct_already_act' => 'Twoje konto jest ju� aktywne !',
	'acct_act_failed' => 'To konto nie mo�e zosta� aktywowane !',
	'err_unk_user' => 'Wskazany u�ytkownik nie istnieje !',
	'x_s_profile' => 'Profil u�ytkownika %s',
	'group' => 'Grupa',
	'reg_date' => 'Przy��czy� si�',
	'disk_usage' => 'U�ycie dysku',
	'change_pass' => 'Zmie� has�o',
	'current_pass' => 'Aktualne has�o',
	'new_pass' => 'Nowe has�o',
	'new_pass_again' => 'Nowe has�o ponownie',
	'err_curr_pass' => 'Aktualne has�o jest nieprawid�owe',
	'apply_modif' => 'Wprowad� zmiany',
	'change_pass' => 'Zmie� moje has�o',
	'update_success' => 'Tw�j profil zosta� uaktualniony',
	'pass_chg_success' => 'Twoje has�o zosta�o zmienione',
	'pass_chg_error' => 'Twoje has�o nie zosta�o zmienione',
);

$lang_register_confirm_email = <<<EOT
Thank you for registering at {SITE_NAME}

Your username is : "{USER_NAME}"
Your password is : "{PASSWORD}"

In order to activate your account, you need to click on the link below
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
	'title' => 'Przegl�daj komentarze',
	'no_comment' => 'Brak komentarzy do przegl�dania',
	'n_comm_del' => '%s komentarz(y) usuni�to',
	'n_comm_disp' => 'Liczba komentarzy do wy�wietlenia',
	'see_prev' => 'Zobacz poprzedni',
	'see_next' => 'Zobacz nast�pny',
	'del_comm' => 'Usu� zaznaczone komentarze',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Przeszukuj kolekcj� oraz�w',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Szukaj w�r�d nowych obraz�w',
	'select_dir' => 'Wybierz katalog',
	'select_dir_msg' => 'Ta funkcja pozwala Ci doda� grup� obraz�w, kt�r� skopiowa�e� na serwer poprzez FTP.<br /><br />Wybierz katalog do kt�rego skopiowa�e� swoje obrazy',
	'no_pic_to_add' => 'Brak obrazu do dodania',
	'need_one_album' => 'Aby u�y� tej funkcji potrzebujesz conajmniej jeden album',
	'warning' => 'Ostrze�enie',
	'change_perm' => 'skrypt nie mo�e zapisywa� do tego katalogu, musisz zmieni� jego tryb na 755 lub 777 przed pr�b� dodawania obraz�w !',
	'target_album' => '<b>Umie�� obrazy &quot;</b>%s<b>&quot; w </b>%s',
	'folder' => 'Katalog',
	'image' => 'Obraz',
	'album' => 'Album',
	'result' => 'Rezultat',
	'dir_ro' => 'Nie do zapisania. ',
	'dir_cant_read' => 'Nie do odczytania. ',
	'insert' => 'Dodawanie nowych obraz�w do galerii',
	'list_new_pic' => 'Lista nowych obraz�w',
	'insert_selected' => 'Wstaw wskazane obrazy',
	'no_pic_found' => 'Nie odnaleziono nowego obrazu',
	'be_patient' => 'Prosz� b�d� cierpliwy, skrypt potrzebuje czasu na dodatnie obraz�w',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : oznacza, �e obraz zosta� pomy�lnie dodany'.
				'<li><b>DP</b> : oznacza, �e obraz to duplikat i jest ju� w bazie danych'.
				'<li><b>PB</b> : oznacza, �e obraz nie mo�e zosta� dodany, sprawd� swoj� konfiguracj� oraz prawa dost�pu do katalogu gdzie umieszczone s� obrazy'.
				'<li>Je�eli nie wida� \'znak�w\' OK, DP, PB kliknij na uszkodzonym obrazie aby zobaczy� wiadomo�� o b��dzie utworzon� przez PHP'.
				'<li>Je�eli Twoja przegl�darka wyczerpa�a limit czasu, naci�nij przycisk od�wie�'.
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
	'title' => 'Dodaj obraz',
	'max_fsize' => 'Maksymalny dozwolony rozmiar pliku to %s KB',
	'album' => 'Album',
	'picture' => 'Obraz',
	'pic_title' => 'Tytu� obrazu',
	'description' => 'Opis obrazu',
	'keywords' => 'S�owa kluczowe (oddzielone spacjami)',
	'err_no_alb_uploadables' => 'Przykro mi ale nie ma albumu, do kt�rego by�by� uprawniony dodawa� obrazy',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Zarz�dzaj u�ytkownikami',
	'name_a' => 'Nazwa rosn�co',
	'name_d' => 'Nazwa malej�co',
	'group_a' => 'Grupa rosn�co',
	'group_d' => 'Grupa malej�co',
	'reg_a' => 'Data rejestracji rosn�co',
	'reg_d' => 'Data rejestracji malej�co',
	'pic_a' => 'Liczba obraz�w rosn�co',
	'pic_d' => 'Liczba obraz�w malej�co',
	'disku_a' => 'U�ycie dysku rosn�co',
	'disku_d' => 'U�ycie dysku malej�co',
	'sort_by' => 'Sortuj u�ytkownik�w wed�ug',
	'err_no_users' => 'Tabela u�ytkownik�w jest pusta !',
	'err_edit_self' => 'Nie mo�esz edytowa� swojego w�asnego progilu, u�yj odno�nika \'M�j profil\' w tym celu',
	'edit' => 'EDYTUJ',
	'delete' => 'USU�',
	'name' => 'Nazwa u�ytkownika',
	'group' => 'Grupa',
	'inactive' => 'Nieaktywny',
	'operations' => 'Operacje',
	'pictures' => 'Obrazy',
	'disk_space' => 'U�ywana przestrze� / Quota',
	'registered_on' => 'Zarejestrowany',
	'u_user_on_p_pages' => '%d u�ytkownik�w na %d stronie(ach)',
	'confirm_del' => 'Czy jeste� pewny, �e chcesz USUN�� tego u�ytkownika ? \\nWszystkie jego obrazy i albumy r�wnie� zostan� usuni�te.',
	'mail' => 'POCZTA',
	'err_unknown_user' => 'Wskazany u�ytkownik nie istnieje !',
	'modify_user' => 'Modyfikuj u�ytkownika',
	'notes' => 'Notatki',
	'note_list' => '<li>Je�li nie chcesz zmieni� aktualnego has�a, pozostaw pole "has�o" puste',
	'password' => 'Has�o',
	'user_active' => 'U�ytkownik jest aktywny',
	'user_group' => 'Grupa u�ytkownika',
	'user_email' => 'E-mail u�ytkownika',
	'user_web_site' => 'Strona www u�ytkownika',
	'create_new_user' => 'Tw�rz nowego u�ytkownika',
	'user_location' => 'Lokalizacja u�ytkownika',
	'user_interests' => 'Zainteresowania u�ytkownika',
	'user_occupation' => 'Zaw�d u�ytkownika',
);
?>