<?php
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //
//  Svenskt spr�kpaket av David Garcia <lejonturbo@yahoo.se>                 //
//             			                             //
// ------------------------------------------------------------------------- //

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'kB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('S�n', 'M�n', 'Tis', 'Ons', 'Tors', 'Fre', 'L�r');
$lang_month = array('Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec');

// Some common strings
$lang_yes = 'Ja';
$lang_no  = 'Nej';
$lang_back = 'TILLBAKA';
$lang_continue = 'FORTS�TT';
$lang_info = 'Information';
$lang_error = 'Fel';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%d. %B, %Y';
$lastcom_date_fmt =  '%d/%b/%y kl. %H:%M';
$lastup_date_fmt = '%d. %B, %Y';
$register_date_fmt = '%d. %B, %Y';
$lasthit_date_fmt = '%d. %B, %Y kl. %R';
$comment_date_fmt =  '%d. %B, %Y kl. %R';

// For the word censor (sensurer ufine ord)
$lang_bad_words = array('*fan*', 'fitta', 'kuk', 'hora*', 'fan', 'blatte', 'helvete', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'Fu\(*', 'fuk*', 'honkey', 'hora', 'slampa', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
	'random' => 'Slumpm�ssiga bilder',
	'lastup' => 'Senaste bilder',
	'lastcom' => 'Senaste kommentarer',
	'topn' => 'Flest visningar',
	'toprated' => 'B�sta bild',
	'lasthits' => 'Senast visat',
	'search' => 'Resultat vid s�kning'
);

$lang_errors = array(
	'access_denied' => 'Du har inte access tilll den h�r sidan.',
	'perm_denied' => 'Du har inte tilllst�nd att utf�ra den h�r handlingen.',
	'param_missing' => 'Scriptet k�rdes utan n�dv�ndiga parametrar.',
	'non_exist_ap' => 'Det valda albumet/bilden existerar inte!',
	'quota_exceeded' => 'Diskutrymmet �r fullt f�r dig.<br /><br />Du har [quota]K i utrymme, dina bilder anv�nder [space]K. L�gger du in flera bilder �verskrider du den tilll�tna m�ngden',
	'gd_file_type_err' => 'N�r albumet anv�nder GD Graphics- teknik �r det bara tilll�tet att anv�nda JPEG eller PNG bilder. Har du m�jlighet att anv�nda PNG �r detta det b�sta valet!',
	'invalid_image' => 'Bilden du laddat upp �r defekt eller st�der inte GD tekniken',
	'resize_failed' => 'Kunde inte f�r�ndra storleken p� bilden eller skapa en miniatyrbild.',
	'no_img_to_display' => 'Inga bilder att visa',
	'non_exist_cat' => 'Den valda kategorin exsisterar inte',
	'orphan_cat' => 'En kategori har en non-existing parent, k�r category manager f�r att r�tta tilll problemet.',
	'directory_ro' => 'Mappen \'%s\' �r skrivskyddad. Bilden kan inte tas bort.',
	'non_exist_comment' => 'Den valda kommentaren finns inte.',
	'pic_in_invalid_album' => 'Bilden-/erna i album existerar inte (%s)!?'
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'G� tilll Albumlistan',
	'alb_list_lnk' => 'Albumlista',
	'my_gal_title' => 'G� till personligt galleri',
	'my_gal_lnk' => 'Mitt galleri',
	'my_prof_lnk' => 'Min profil',
	'adm_mode_title' => 'Byt till Admin l�ge',
	'adm_mode_lnk' => 'Admin l�ge',
	'usr_mode_title' => 'Byt till Anv�ndar l�ge',
	'usr_mode_lnk' => 'Anv�ndar l�ge',
	'upload_pic_title' => 'Ladda upp en bild till ett album',
	'upload_pic_lnk' => 'Ladda upp bild',
	'register_title' => 'Uppr�tta konto',
	'register_lnk' => 'Registrera',
	'login_lnk' => 'Logga in',
	'logout_lnk' => 'Logga ut',
	'lastup_lnk' => 'Senaste uppladdningarna',
	'lastcom_lnk' => 'Senaste kommentarer',
	'topn_lnk' => 'Mest visade',
	'toprated_lnk' => 'B�sta bild',
	'search_lnk' => 'S�k',
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Ladda upp f�r godk�nnande',
	'config_lnk' => 'Konfiguration',
	'albums_lnk' => 'Album',
	'categories_lnk' => 'Kategorier',
	'users_lnk' => 'Anv�ndare',
	'groups_lnk' => 'Grupper',
	'comments_lnk' => 'Kommentarer',
	'searchnew_lnk' => 'S�k igen',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'uppr�tta / ordna album',
	'modifyalb_lnk' => 'Redigera album',
	'my_prof_lnk' => 'Min profil',
);

$lang_cat_list = array(
	'category' => 'Kategori',
	'albums' => 'Album',
	'pictures' => 'Bilder',
);

$lang_album_list = array(
	'album_on_page' => '%d album p� %d sidor'
);

$lang_thumb_view = array(
	'date' => 'datum',
	'name' => 'namn',
	'sort_da' => 'Sorterat i stigande datumordning',
	'sort_dd' => 'Sorterat i fallande datumordning',
	'sort_na' => 'Sorterat alfabetisk stigande ordning',
	'sort_nd' => 'Sorterat alfabetisk fallande ordning',
	'pic_on_page' => '%d bilder p� %d sida(or)',
	'user_on_page' => '%d anv�ndare p� %d sida(or)'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Tillbaka till �versikt',
	'pic_info_title' => 'Visa/d�lj information om bilden',
	'slideshow_title' => 'Slideshow',
	'ecard_title' => 'S�nd den h�r bilden som ett e-vykort',
	'ecard_disabled' => 'e-vykort �r inaktiverat',
	'ecard_disabled_msg' => 'Du har inte tilll�telse att skicka e-vykort',
	'prev_title' => 'Se f�rra bilden',
	'next_title' => 'Se n�sta bild',
	'pic_pos' => 'BILD %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Kommentera den h�r bilden ',
	'no_votes' => '(Ingen kommentar �nnu)',
	'rating' => '(Aktuellt betyg : %s / 5 med %s r�ster)',
	'rubbish' => 'D�lig',
	'poor' => 'Medel',
	'fair' => 'OK',
	'good' => 'Bra',
	'excellent' => 'B�ttre �n bra',
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
	CRITICAL_ERROR => 'Kritiskt fel',
	'file' => 'Fil: ',
	'line' => 'Rad: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Filnamn: ',
	'filesize' => 'Filstorlek: ',
	'dimensions' => 'Dimension: ',
	'date_added' => 'Inlagt datum: '
);

$lang_get_pic_data = array(
	'n_comments' => '%s kommentar',
	'n_views' => '%s visningar',
	'n_votes' => '(%s r�ster)'
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
	'Question' => 'Fr�gande',
	'Very Happy' => 'V�ldigt glad',
	'Smile' => 'Ler',
	'Sad' => 'Trist',
	'Surprised' => '�verraskad',
	'Shocked' => 'Chockad',
	'Confused' => 'F�rvirrad',
	'Cool' => 'Cool',
	'Laughing' => 'Skrattande',
	'Mad' => 'Galen',
	'Razz' => 'Razz',
	'Embarassed' => 'Generad',
	'Crying or Very sad' => 'Gr�ter eller mycket ledsen',
	'Evil or Very Mad' => 'Elak eller mycket sur',
	'Twisted Evil' => 'Ond',
	'Rolling Eyes' => 'Rullar med �gonen',
	'Wink' => 'Blinkar',
	'Idea' => 'God id�',
	'Arrow' => 'Pil',
	'Neutral' => 'Neutral',
	'Mr. Green' => 'Mr. Gr�n',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'l�mnar Admin l�ge...',
	1 => 'kommer in i Admin l�ge...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Albumet m�ste ha ett namn!',
	'confirm_modifs' => '�r du s�ker p� att du vill spara de h�r inst�llningarna?',
	'no_change' => 'Du har inte �ndrat n�got!',
	'new_album' => 'Nytt album',
	'confirm_delete1' => '�r du s�ker p� att du vill radera albumet?',
	'confirm_delete2' => '\nAlla bilder och kommentarer f�rsvinner!',
	'select_first' => 'V�lj ett album f�rst',
	'alb_mrg' => 'Album Manager',
	'my_gallery' => '* Mitt galleri *',
	'no_category' => '* Ingen kategori *',
	'delete' => 'Raderat',
	'new' => 'Ny',
	'apply_modifs' => 'Godk�nn �ndringarna',
	'select_category' => 'V�lj kategori',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Obligatorisk parameter vid \'%s\'operationen utf�rdes inte!',
	'unknown_cat' => 'Den valda kategorin existerar inte i databasen',
	'usergal_cat_ro' => 'Kategorin Anv�ndargalleri kan inte raderas!',
	'manage_cat' => 'Administrerar kategorier',
	'confirm_delete' => '�r du s�ker p� att du vill radera den h�r kategorin?',
	'category' => 'Kategori',
	'operations' => 'Handling',
	'move_into' => 'Flytta till',
	'update_create' => 'Uppdaterar/skapar kategori',
	'parent_cat' => 'Huvudkategori',
	'cat_title' => 'Kategori titel',
	'cat_desc' => 'Kategori beskrivning'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Konfiguration',
	'restore_cfg' => '�terskapa standardinst�llningar',
	'save_cfg' => 'Spara ny konfiguration',
	'notes' => 'Noteringar',
	'info' => 'Information',
	'upd_success' => 'Coppermine konfigurationen �r uppdaterad',
	'restore_success' => 'Coppermine standardinst�llningar blev uppdaterade',
	'name_a' => 'Namn stigande',
	'name_d' => 'Namn fallande',
	'date_a' => 'Datum stigande',
	'date_d' => 'Datum fallande'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Generella inst�llningar',
	array('Galleri namn', 'gallery_name', 0),
	array('Galleri beskrivning', 'gallery_description', 0),
	array('Galleri administrator e-mail', 'gallery_admin_email', 0),
	array('M�ladress f�r \'Se fler bilder\' l�nk i e-vykort', 'ecards_more_pic_target', 0),
	array('Spr�k', 'lang', 5),
	array('Tema', 'theme', 6),

	'Albumlist visning',
	array('Bredd p� huvudtabell (pixlar eller %)', 'main_table_width', 0),
	array('Antal rader i kategorier f�r visning', 'subcat_level', 0),
	array('Antal album per sida', 'albums_per_page', 0),
	array('Antal kolumner f�r albumvisning', 'album_list_cols', 0),
	array('Storlek p� miniatyrbilder i pixlar', 'alb_list_thumb_size', 0),
	array('Inneh�ll p� huvudsidan', 'main_page_layout', 0),

	'Miniatyrbild',
	array('Antal kolumner p� sidan med miniatyrbilder', 'thumbcols', 0),
	array('Antal rader p� sidan med miniatyrbilder', 'thumbrows', 0),
	array('Max antal miniatyrbilder p� varje sida', 'max_tabs', 0),
	array('Visa bildrubrik nedanf�r miniatyrbild', 'caption_in_thumbview', 1),
	array('Visa antal kommentarer nedanf�r miniatyrbild', 'display_comment_count', 1),
	array('Standard sortering av bildf�ljd', 'default_sort_order', 3),
	array('Minimum antal r�ster p� bild f�r visning i \'b�sta bild\' listan', 'min_votes_for_rating', 0),

	'Bildvisning och kommentarer',
	array('Bredd f�r tabell av bildvisning (pixlar eller %)', 'picture_table_width', 0),
	array('Information om bilden �r synlig som standard', 'display_pic_info', 1),
	array('Filtrera fula ord som standard', 'filter_bad_words', 1),
	array('Smilies �r till�tet', 'enable_smilies', 1),
	array('Max l�ngd p� bildbeskrivning', 'max_img_desc_length', 0),
	array('Max l�ngd p� hela ord', 'max_com_wlength', 0),
	array('Max rader i en kommentar', 'max_com_lines', 0),
	array('Max l�ngd p� en kommentar', 'max_com_size', 0),

	'Bilder och miniatyrbilder',
	array('Kvalitet p� JPEG', 'jpeg_qual', 0),
	array('Max bredd och h�jd p� miniatyrbilder <b>*</b>', 'thumb_width', 0),
	array('Skapa mellanliggande bilder','make_intermediate',1),
	array('Max h�jd eller bredd p� mellanliggande bild <b>*</b>', 'picture_width', 0),
	array('Max storlek p� bilder f�r uppladdning (kB)', 'max_upl_size', 0),
	array('Max bredd eller h�jd p� bilder f�r uppladdning (pixlar)', 'max_upl_width_height', 0),

	'Anv�ndarinst�llningar',
	array('Till�t att nya anv�ndare kan registrera sig', 'allow_user_registration', 1),
	array('Nya anv�ndare m�ste aktiveras med e-post adress', 'reg_requires_valid_email', 1),
	array('Till�t tv� anv�ndare att ha samma e-post adress', 'allow_duplicate_emails_addr', 1),
	array('Anv�ndare kan ha privata album', 'allow_private_albums', 1),

	'Specialf�lt vid bildbeskrivning (l�t dessa vara blanka som standard)',
	array('F�lt 1 namn', 'user_field1_name', 0),
	array('F�lt 2 namn', 'user_field2_name', 0),
	array('F�lt 3 namn', 'user_field3_name', 0),
	array('F�lt 4 namn', 'user_field4_name', 0),

	'Avancerade inst�llningar f�r bilder och miniatyrbilder',
	array('F�rbjudna tecken i filnamn', 'forbiden_fname_char',0),
	array('Accepterade filtyper f�r uppladdning', 'allowed_file_extensions',0),
	array('Metod f�r �ndring av storlek p� bilder','thumb_method',2),
	array('Adress till ImageMagick \'konverterings\' verktyg (exempel /usr/bin/X11/)', 'impath', 0),
	array('Till�tna bildtyper (endast tillg�nglig vid anv�ndning av ImageMagick)', 'allowed_img_types',0),
	array('Kommandolinje vid anv�ndande av ImageMagick', 'im_options', 0),
	array('L�s EXIF data i JPEG filer', 'read_exif_data', 1),
	array('Album mapp <b>*</b>', 'fullpath', 0),
	array('Mapp f�r anv�ndarnas bilder <b>*</b>', 'userpics', 0),
	array('Prefix p� medlemsbilder <b>*</b>', 'normal_pfx', 0),
	array('Prefix p� miniatyrbilder <b>*</b>', 'thumb_pfx', 0),
	array('Standard tillst�nd p� mappar', 'default_dir_mode', 0),
	array('Standard tillst�nd p� bilder', 'default_file_mode', 0),

	'Cookies och teckenkodning',
	array('Namnet p� den cookie som anv�nds av detta system', 'cookie_name', 0),
	array('S�kv�g till den cookie anv�nd av detta system', 'cookie_path', 0),
	array('Teckenkodning', 'charset', 4),

	'Diverse inst�llningar',
	array('Till�t testning (debug)', 'debug_mode', 1),
	
	'<br /><div align="center">(*) F�lt markerat med * m�ste �ndras om du redan har bilder i ditt galleri</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Du m�ste skriva in ditt namn och en kommentar',
	'com_added' => 'Din kommentar har lagts till',
	'alb_need_title' => 'Du m�ste ge albumet en titel!',
	'no_udp_needed' => 'Ingen uppdatering beh�vs.',
	'alb_updated' => 'Albumet uppdaterades',
	'unknown_album' => 'Valt album existerar inte, eller Du har inte tillst�nd att ladda upp bilder i detta album.',
	'no_pic_uploaded' => 'Inget foto laddades upp!<br /><br />Om du redan valt bild f�r uppladdning, kontrollera att serven till�ter uppladdningar...',
	'err_mkdir' => 'Misslyckades med att skapa mappen %s !',
	'dest_dir_ro' => 'Mappen %s �r inte skrivbar av scriptet!',
	'err_move' => 'Kan inte flytta %s till %s !',
	'err_fsize_too_large' => 'Bildstorleken som du laddat upp �r f�r stor (max till�tet �r %s x %s) !',
	'err_imgsize_too_large' => 'Filstorleken p� den uppladdade bilden �r f�r stor (max till�tet �r %s KB) !',
	'err_invalid_img' => 'Filen du laddat upp �r inte i till�tet bildformat!',
	'allowed_img_types' => 'Du kan bara ladda upp %s bilder.',
	'err_insert_pic' => 'Bilden \'%s\' kan inte infogas i albumet',
	'upload_success' => 'Din bild laddades upp felfritt<br /><br />Bilden blir synlig efter godk�nnande av administrat�ren.',
	'info' => 'Information',
	'com_added' => 'Kommentar tillagd',
	'alb_updated' => 'Album updaterat',
	'err_comment_empty' => 'Din kommentar har inget inneh�ll!',
	'err_invalid_fext' => 'Endast filer med f�ljande fil�ndelser �r till�tna: <br /><br />%s.',
	'no_flood' => 'Ledsen, men du �r f�rfattaren till den senast postade kommentaren f�r den h�r bilden.<br /><br />�ndra kommentaren du postat, om inneh�llet beh�ver �ndras',
	'redirect_msg' => 'Du blir omdirigerad.<br /><br /><br />Tryck p� \'>> FORTS�TT <<\' om sidan inte �ndras automatiskt inom n�gra sekunder.',
	'upl_success' => 'Din bild infogades utan problem.',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Rubrik',
	'fs_pic' => 'Full storlek',
	'del_success' => 'Raderad',
	'ns_pic' => 'Normal storlek',
	'err_del' => 'Kan inte raderas',
	'thumb_pic' => 'Miniatyrbild',
	'comment' => 'Kommentar',
	'im_in_alb' => 'Bilder i album',
	'alb_del_success' => 'Album \'%s\' raderat',
	'alb_mgr' => 'Album Administrat�r',
	'err_invalid_data' => 'Datafel i \'%s\'',
	'create_alb' => 'Skapar album \'%s\'',
	'update_alb' => 'Uppdaterar album \'%s\' med titel \'%s\' och index \'%s\'',
	'del_pic' => 'Radera bild',
	'del_alb' => 'Radera album',
	'del_user' => 'Radera anv�ndare',
	'err_unknown_user' => 'Den valda anv�ndaren existerar inte!',
	'comment_deleted' => 'Kommentaren raderades',
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
	'confirm_del' => '�r du s�ker p� att du vill radera den h�r bilden? \\nKommentarer blir ocks� raderade.',
	'del_pic' => 'Radera DENNA bild',
	'size' => '%s x %s pixlar',
	'views' => '%s g�nger',
	'slideshow' => 'Bildspel',
	'stop_slideshow' => 'STOPPA BILDSPEL',
	'view_fs' => 'Klicka f�r att visa full storlek',
);

$lang_picinfo = array(
	'title' =>'Information om bilden',
	'Filename' => 'Filnamn',
	'Album name' => 'Album namn',
	'Rating' => 'Betyg (%s r�ster)',
	'Keywords' => 'Nyckelord',
	'File Size' => 'Filstorlek',
	'Dimensions' => 'Dimensioner',
	'Displayed' => 'Visningar',
	'Camera' => 'Kamera',
	'Date taken' => 'Fotograferat datum',
	'Aperture' => '�ppning',
	'Exposure time' => 'Exponeringstid ',
	'Focal length' => 'Br�nnvidd',
	'Comment' => 'Kommentar'
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => '�ndra den h�r kommentaren',
	'confirm_delete' => '�r du s�ker p� du vill radera den h�r kommentaren?',
	'add_your_comment' => 'L�gg till din kommentar',
	'your_name' => 'Ditt namn',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Skicka ett e-vykort',
	'invalid_email' => '<b>VARNING</b> : ogiltig e-post adress!',
	'ecard_title' => 'e-vykort fr�n %s till dig!',
	'view_ecard' => 'Om inte e-vykortet visas riktigt, klicka h�r',
	'view_more_pics' => 'Klicka p� den h�r l�nken f�r fler bilder!',
	'send_success' => 'Ditt e-vykort skickades',
	'send_failed' => 'Beklagar, servern kunde inte skicka...',
	'from' => 'Fr�n',
	'your_name' => 'Ditt namn',
	'your_email' => 'Din e-post adress',
	'to' => 'Till',
	'rcpt_name' => 'Namn p� mottagare',
	'rcpt_email' => 'E-post adress till mottagare',
	'greetings' => 'H�lsning',
	'message' => 'Meddelande',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Bildinformation',
	'album' => 'Album',
	'title' => 'Titel',
	'desc' => 'Beskrivning',
	'keywords' => 'Nyckelord',
	'pic_info_str' => '%sx%s - %skB - %s visningar - %s r�ster',
	'approve' => 'Godk�nn bild',
	'postpone_app' => 'Avsl� godk�nnande',
	'del_pic' => 'Radera bild',
	'reset_view_count' => 'Nollst�ll r�knare',
	'reset_votes' => 'Nollst�ll r�ster',
	'del_comm' => 'Radera kommentarer',
	'upl_approval' => 'Godk�nn uppladdning',
	'edit_pics' => 'Redigera bilder',
	'see_next' => 'Se n�sta bild',
	'see_prev' => 'Se f�reg�ende bild',
	'n_pic' => '%s bilder',
	'n_of_pic_to_disp' => 'Bilder f�r visning',
	'apply' => 'L�gg till �ndringar'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Gruppnamn',
	'disk_quota' => 'Diskkvot',
	'can_rate' => 'Kan r�sta',
	'can_send_ecards' => 'Kan skicka e-vykort',
	'can_post_com' => 'Kan kommentera',
	'can_upload' => 'Kan ladda upp bilder',
	'can_have_gallery' => 'Kan ha privat galleri',
	'apply' => 'L�gg till �ndringar',
	'create_new_group' => 'Skapa ny grupp',
	'del_groups' => 'Radera vald grupp',
	'confirm_del' => 'Varning, n�r du raderar en grupp blir medlemmarna i denna flyttade till \'Registrerad\' grupp !\n\nVill du forts�tta ?',
	'title' => 'Administrera anv�ndargrupper',
	'approval_1' => 'Godk�nnande f�r offentliga uppladdningar(1)',
	'approval_2' => 'Godk�nnande f�r privata uppladdningar(2)',
	'note1' => '<b>(1)</b> Uppladdningar i offentligt album kr�ver administrat�rs godk�nnande',
	'note2' => '<b>(2)</b> Uppladdningar i privata album som tillh�r anv�ndaren kr�ver administrat�rs godk�nnande',
	'notes' => 'Noteringar'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'V�lkommen!'
);

$lang_album_admin_menu = array(
	'confirm_delete' => '�r du s�ker p� att du vill radera detta album? \\nAlla bilder och kommentarer blir ocks� raderade.',
	'delete' => 'RADERA',
	'modify' => 'REDIGERA',
	'edit_pics' => 'REDIGERA BILDER',
);

$lang_list_categories = array(
	'home' => 'Hem',
	'stat1' => '<b>[pictures]</b> Bilder i <b>[albums]</b> album och <b>[cat]</b> kategorier med <b>[comments]</b> kommentarer visat <b>[views]</b> g�nger',
	'stat2' => '<b>[pictures]</b> Bilder i <b>[albums]</b> album visat <b>[views]</b> g�nger',
	'xx_s_gallery' => '%s\'s Galleri',
	'stat3' => '<b>[pictures]</b> Bilder i <b>[albums]</b> album med <b>[comments]</b> kommentarer visat <b>[views]</b> g�nger'
);

$lang_list_users = array(
	'user_list' => 'Anv�ndarlista',
	'no_user_gal' => 'Ingen anv�ndare kan ha album',
	'n_albums' => '%s album',
	'n_pics' => '%s bilder'
);

$lang_list_albums = array(
	'n_pictures' => '%s bilder',
	'last_added' => ', senaste inlagt %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Logga in',
	'enter_login_pswd' => 'Skriv ditt anv�ndarnamn och l�senord',
	'username' => 'Anv�ndarnamn',
	'password' => 'L�senord',
	'remember_me' => 'Kom ih�g mig',
	'welcome' => 'V�lkommen %s ...',
	'err_login' => '*** Kunde inte logga in. Pr�va igen ***',
	'err_already_logged_in' => 'Du �r redan inloggad!',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Logga ut',
	'bye' => 'P� �terseende %s ...',
	'err_not_loged_in' => 'Du �r inte inloggad!',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Uppdatera album %s',
	'general_settings' => 'Generella inst�llningar',
	'alb_title' => 'Album titel',
	'alb_cat' => 'Album kategori',
	'alb_desc' => 'Album beskrivning',
	'alb_thumb' => 'Album miniatyrbilder',
	'alb_perm' => 'R�ttigheter f�r detta album',
	'can_view' => 'Album kan ses av',
	'can_upload' => 'G�ster kan ladda upp bilder',
	'can_post_comments' => 'G�ster kan skriva kommentarer',
	'can_rate' => 'G�ster kan r�sta p� bilder',
	'user_gal' => 'Anv�ndargalleri',
	'no_cat' => '* Ingen kategori *',
	'alb_empty' => 'Albumet �r tomt',
	'last_uploaded' => 'Senast uppladdat',
	'public_alb' => 'Alla (offentliga album)',
	'me_only' => 'Endast jag',
	'owner_only' => 'Albumet �gs av (%s)',
	'groupp_only' => 'Medlemmar av \'%s\' gruppen',
	'err_no_alb_to_modify' => 'Inget album att redigera.',
	'update' => 'Uppdatera album'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Ledsen, men du har redan r�stat p� denna bild',
	'rate_ok' => 'Din r�st registrerades',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
// L�gg in egna villkor f�r anv�ndning h�r, om du inte vill ha standardvillkor//

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Denna sida kan ha album som g�ster kan ladda upp bilder i. Administrat�ren av den h�r siten kan inte alltid ha kontroll �ver vad som laddas upp,
men administrat�ren kommer att f�rs�ka radera st�tande material s� fort som m�jligt, om detta f�rekommer vill s�ga.
Du m�ste d�rf�r trycka p� "Jag Accepterar" knappen nedanf�r.
EOT;

$lang_register_php = array(
	'page_title' => 'Registrering av ny anv�ndare',
	'term_cond' => 'Regler f�r fotoalbumet',
	'i_agree' => 'Jag accepterar',
	'submit' => 'Skicka registrering',
	'err_user_exists' => 'Anv�ndarnamnet finns redan. V�lj ett annat!',
	'err_password_mismatch' => 'L�senorden st�mde inte med varandra',
	'err_uname_short' => 'Anv�ndarnamnet var f�r kort',
	'err_password_short' => 'L�senordet var f�r kort',
	'err_uname_pass_diff' => 'Anv�ndarnamn och l�senord st�mmer inte. F�rs�k igen',
	'err_invalid_email' => 'E-post adressen �r ogiltig',
	'err_duplicate_email' => 'En annan anv�ndare �r registrerad med din e-post adress.',
	'enter_info' => 'Ange registreringsinformation',
	'required_info' => 'Informationskrav',
	'optional_info' => 'Valfri information',
	'username' => 'Anv�ndarnamn',
	'password' => 'L�senord',
	'password_again' => 'L�senord igen',
	'email' => 'E-post',
	'location' => 'Jag bor i',
	'interests' => 'Intressen',
	'website' => 'Hemsida',
	'occupation' => 'Jag arbetar som',
	'error' => 'FEL',
	'confirm_email_subject' => '%s - Godk�nnande',
	'information' => 'Information',
	'failed_sending_email' => 'Godk�nnande kan inte skickas!',
	'thank_you' => 'Tack f�r din registrering.<br /><br />ett e-post meddelande �r skickat till dig d�r info om hur du aktiverar ditt konto finns.',
	'acct_created' => 'Ditt konto �r nu uppr�ttat och du kan logga in med ditt anv�ndarnamn och l�senord',
	'acct_active' => 'Ditt konto �r nu aktivt och du kan logga in med ditt anv�ndarnamn och l�senord',
	'acct_already_act' => 'Din konto �r redan aktiverat !',
	'acct_act_failed' => 'Detta konto kan inte bli aktiverat !',
	'err_unk_user' => 'Den valda anv�ndaren existerar inte !',
	'x_s_profile' => '%s\'s profil',
	'group' => 'grupp',
	'reg_date' => 'Medlem sedan',
	'disk_usage' => 'Diskutrymme',
	'change_pass' => 'Byt l�senord',
	'current_pass' => 'Nuvarande l�senord',
	'new_pass' => 'Nytt l�senord',
	'new_pass_again' => 'Bekr�fta l�senord',
	'err_curr_pass' => 'Fel under nytt l�senord',
	'apply_modif' => 'L�gg till �ndringar',
	'change_pass' => 'Byt mitt l�senord',
	'update_success' => 'Din profil uppdaterades',
	'pass_chg_success' => 'Ditt l�senord �ndrades',
	'pass_chg_error' => 'Ditt l�senord �ndrades INTE',
);

$lang_register_confirm_email = <<<EOT
Tack f�r din registrering hos {SITE_NAME}

Ditt anv�ndarnamn : "{USER_NAME}"
Ditt l�senord : "{PASSWORD}"

F�r att aktivera ditt konto m�ste du klicka p� l�nken under eller klistra in den i din browser (p� adressraden).

{ACT_LINK}

Med v�nliga h�lsningar,

Administrat�ren av  - {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Se kommentarer',
	'no_comment' => 'Det finns inga kommentarer att se p�',
	'n_comm_del' => '%s kommentarer raderade',
	'n_comm_disp' => 'Antal kommentarer att visa',
	'see_prev' => 'Se foreg�ende',
	'see_next' => 'Se n�sta',
	'del_comm' => 'Radera valda kommentarer',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'S�k bland bilderna',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'S�k i nya bilder',
	'select_dir' => 'V�lj mapp',
	'select_dir_msg' => 'Denna funktion till�ter dig att l�gga in bilder du har laddat upp via FTP.<br /><br />V�lj mappen du har laddat upp bilder i',
	'no_pic_to_add' => 'Det finns inga bilder att l�gga till',
	'need_one_album' => 'Du m�ste ha minst ett album f�r att l�gga till bilder',
	'warning' => 'Varning',
	'change_perm' => 'Systemet kan inte skriva till denna mapp, du m�ste �ndra r�ttigheter med CHMOD 755 eller 777 innan du pr�var igen !',
	'target_album' => '<b>Flytta bilder fr�n &quot;</b>%s<b>&quot; till </b>%s',
	'folder' => 'Mapp',
	'image' => 'Bild',
	'album' => 'Album',
	'result' => 'Resultat',
	'dir_ro' => 'Inte skrivbar. ',
	'dir_cant_read' => 'Kan inte l�sa. ',
	'insert' => 'L�gg in nya bilder i album',
	'list_new_pic' => 'Lista med nya bilder',
	'insert_selected' => 'S�tt in valda bilder',
	'no_pic_found' => 'Inga nya bilder hittades',
	'be_patient' => 'Tagga ner, systemet arbetar med bilderna',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : Betyder att bilden blev inlagd'.
				'<li><b>DP</b> : Betyder att bilden �r en kopia och ligger redan i databasen'.
				'<li><b>PB</b> : Betyder att bilden inte kan l�ggas in, kontrollera r�ttigheterna'.
				'<li>Om OK, DP, PB \'tecken\' inte kommer fram klicka d� p� f�rst�rda bilder och kontrollera felmeddelande syns i PHP'.
				'<li>Om din browser ger timeout prova att klicka p� Uppdatera'.
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
	'title' => 'Ladda upp bild',
	'max_fsize' => 'Max filstorlek �r satt till %s kB',
	'album' => 'Album',
	'picture' => 'Bild',
	'pic_title' => 'Titel p� bild',
	'description' => 'Beskrivning av bild',
	'keywords' => 'Nyckelord (separera med kommatecken. t.ex- audi, s3, quattro, rs4 etc.)',
	'err_no_alb_uploadables' => 'Ledsen, det finns inga album d�r du har till�telse att ladda upp bilder i.',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Administrera anv�ndare',
	'name_a' => 'Namn stigande',
	'name_d' => 'Namn fallande',
	'group_a' => 'Grupp stigande',
	'group_d' => 'Grupp fallande',
	'reg_a' => 'Reg datum stigande',
	'reg_d' => 'Reg datum fallande',
	'pic_a' => 'Bilder stigande',
	'pic_d' => 'Bilder fallande',
	'disku_a' => 'Diskutrymme stigande',
	'disku_d' => 'Diskutrymme fallande',
	'sort_by' => 'Sorterat av anv�ndare',
	'err_no_users' => 'Anv�ndartabellen �r tom!',
	'err_edit_self' => 'Du kan inte editera din egna profil, anv�nd \'Min profil\' l�nken f�r detta',
	'edit' => 'REDIGERA',
	'delete' => 'RADERA',
	'name' => 'Anv�ndarnamn',
	'group' => 'Grupp',
	'inactive' => 'Inte aktiv',
	'operations' => 'Handlingar',
	'pictures' => 'Bilder',
	'disk_space' => 'Utrymme anv�nt / Kvot',
	'registered_on' => 'Registrerad den',
	'u_user_on_p_pages' => '%d anv�ndare p� %d sidor',
	'confirm_del' => '�r du s�ker p� att du vill radera E denna anv�ndaren ? \\nAlla bilder och album blir ocks� raderade.',
	'mail' => 'SKICKA',
	'err_unknown_user' => 'Den valda anv�ndaren existerar inte!',
	'modify_user' => 'Redigera anv�ndare',
	'notes' => 'Noteringar',
	'note_list' => '<li>Om du inte vill �ndra det aktuella l�senordet, l�t f�ltet "L�senord" st� tomt',
	'password' => 'L�senord',
	'user_active' => 'Anv�ndaren �r inte aktiv',
	'user_group' => 'Anv�ndargrupp',
	'user_email' => 'Anv�ndar e-post',
	'user_web_site' => 'Anv�ndarens hemsida',
	'create_new_user' => 'Skapa ny anv�ndare',
	'user_location' => 'Anv�ndarens placering',
	'user_interests' => 'Anv�ndarens intressen',
	'user_occupation' => 'Anv�ndarens beskrivning',
);
?>