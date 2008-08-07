<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  
  ********************************************
  Coppermine version: 1.4.20
  $HeadURL$
  $Revision$
  $Author$
  $Date$
**********************************************/
// ------------------------------------------------------------------------- //
// $Id$
// ------------------------------------------------------------------------- //

if (!defined('IN_COPPERMINE')) { die('Не во Coppermine...');}

// info about translators and translated language
$lang_translation_info = array(
  'lang_name_english' => 'Macedonian', //cpg1.4
  'lang_name_native' => 'Македонски',//cpg1.4
  'lang_country_code' => 'MK',
  'trans_name'=> 'GjokoMK',
  'trans_email' => 'velgosti@gmail.com',
  'trans_website' => 'http://www.velgosti.com',
  'trans_date' => '2007-07-18',
);

$lang_charset = 'utf-8';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('недела', 'понеделник', 'вторник', 'среда', 'четврток.', 'петок', 'сабота');
$lang_month = array('јануари', 'февруари', 'март', 'април', 'мај', 'јуни', 'јули', 'август', 'септември', 'октомври', 'ноември', 'декември');

// Some common strings
$lang_yes = 'Да';
$lang_no  = 'Не';
$lang_back = 'НАЗАД';
$lang_continue = 'ПРОДОЛЖИ';
$lang_info = 'Информација';
$lang_error = 'Грешка';
$lang_check_uncheck_all = 'Maркирај/Демаркирај ги сите'; //cpg1.4

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d %Y';
$lastcom_date_fmt =  '%d/%m/%y в %H:%M'; //cpg1.3.0
$lastup_date_fmt = '%d %B %Y';
$register_date_fmt = '%d %B %Y';
$lasthit_date_fmt = '%d %B %Y в %I:%M %p'; //cpg1.3.0
$comment_date_fmt =  '%d %B %Y в %I:%M %p'; //cpg1.3.0
$log_date_fmt = '%B %d, %Y at %I:%M %p'; //cpg1.4

// For the word censor
$lang_bad_words = array('*fuck*', 'кур','пичка','ебање','еби се','asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', '*бам','lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*','picka','pickatimater','пичкатиматер');

$lang_meta_album_names = array(
  'random' => 'Случајни фајлови', //cpg1.3.0
  'lastup' => 'Последно додадени',
  'lastalb'=> 'Последно додадени албуми',
  'lastcom' => 'Последни коментари',
  'topn' => 'Нај-гледани',
  'toprated' => 'Нај-високо отценети',
  'lasthits' => 'Последно видeни',
  'search' => 'Резултати од пребарување',
  'favpics'=> 'Омилени фајлови', //cpg1.3.0
);

$lang_errors = array(
  'access_denied' => 'Вие немате довлола да влезите во оваа страна.',
  'perm_denied' => 'Вие немате дозвола за оваа операција.',
  'param_missing' => 'Script called without the required parameter(s).',
  'non_exist_ap' => 'Одбраниот албум/фајл не постои !',
  'quota_exceeded' => 'Достигнување на простор<br /><br />Го достигнавте просторот од [quota]K, вашите слики моментално користат [space]K, со додавање на овој фајл ке го надмините дозволениот простор.',
  'gd_file_type_err' => 'When using the GD image library allowed image types are only JPEG and PNG.',
  'invalid_image' => 'The image you have uploaded is corrupted or can\'t be handled by the GD library',
  'resize_failed' => 'Не беше возможно да се создадат мали сликичли или да се промени големината на сликата.',
  'no_img_to_display' => 'Нема Слики',
  'non_exist_cat' => 'Одбраната категорија не постои',
  'orphan_cat' => 'A category has a non-existing parent, run the category manager to correct the problem!',
  'directory_ro' => 'Во Директориумот \'%s\' не може да се пишува, фајловите не можат да се избришат',
  'non_exist_comment' => 'Одбраниот коментар не постои.',
  'pic_in_invalid_album' => 'Фајлот е во не постоечки алнум (%s)!?',
  'banned' => 'Вие сте банирани од оваа страна и не може да влезете моментално.',
  'not_with_udb' => 'Оваа функција е исклучена зошто е поврзана со форум софтверот. Што и да пробате не е подржано со оваа конфигурација,или оваа фунција треба да биде извршена преку форумот.',
  'offline_title' => 'Offline',
  'offline_text' => 'Галеријата е исклучена offline - навратете покасно',
  'ecards_empty' => 'There are currently no ecard records to display.',
  'action_failed' => 'Акцијата е неуспешна.  Скриптата не можеше да го исполни вашето барање.',
  'no_zip' => 'The necessary libraries to process ZIP files are not available.  Ве молиме контактирајте го Администраторот.',
  'zip_type' => 'Немате дозвола да поставувате  ZIP фајлови.',
  'database_query' => 'There was an error while processing a database query', //cpg1.4
  'non_exist_comment' => 'Одбраниот коментар не постои', //cpg1.4
);

$lang_bbcode_help_title = 'bbcode помош'; //cpg1.4
$lang_bbcode_help = 'Може да поставите линкови за кликнување во некој формат користеќи ББ-код користеќи : <li>[b]Bold[/b] =&gt; <b>Bold</b></li><li>[i]Italic[/i] =&gt; <i>Italic</i></li><li>[url=http://yoursite.com/]Url Text[/url] =&gt; <a href="http://yoursite.com">Url Text</a></li><li>[email]user@domain.com[/email] =&gt; <a href="mailto:user@domain.com">user@domain.com</a></li><li>[color=red]some text[/color] =&gt; <span style="color:red">some text</span></li><li>[img]http://coppermine-gallery.net/demo/cpg14x/images/red.gif[/img] => <img src="../images/red.gif" border="0" alt="" /></li>'; //cpg1.4

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
  'home_title' => 'Оди до Дома страната',
  'home_lnk' => 'Галерија Дома',
  'alb_list_title' => 'Оди до албум листата',
  'alb_list_lnk' => 'Албум листа',
  'my_gal_title' => 'Оди до лична Галерија',
  'my_gal_lnk' => 'Моја Галерија',
  'my_prof_title' => 'Оди до мојот личен профил', //cpg1.4
  'my_prof_lnk' => 'Мој Профил',
  'adm_mode_title' => 'Промени во Админ мод',
  'adm_mode_lnk' => 'Админ мод',
  'usr_mode_title' => 'Промени во членски мод',
  'usr_mode_lnk' => 'Членски мод',
  'upload_pic_title' => 'Постави фајл',
  'upload_pic_lnk' => 'Upload фајл',
  'register_title' => 'Креирај членство',
  'register_lnk' => 'Регистрирај се',
  'login_title' => 'Логирај ме', //cpg1.4
  'login_lnk' => 'Влези',
  'logout_title' => 'Од логирај ме', //cpg1.4
  'logout_lnk' => 'Излези',
  'lastup_title' => 'Покажи ги најновите поставувања', //cpg1.4
  'lastup_lnk' => 'Последно Поставени',
  'lastcom_title' => 'Покажи ги најновите коментари', //cpg1.4
  'lastcom_lnk' => 'Последни коментари',
  'topn_title' => 'Покажи ги најмногу видените', //cpg1.4
  'topn_lnk' => 'Најмногу видени',
  'toprated_title' => 'Покажи ги на рангирани', //cpg1.4
  'toprated_lnk' => 'Нај отценети',
  'search_title' => 'Барај во Галеријата', //cpg1.4
  'search_lnk' => 'Барај',
  'fav_title' => 'Оди во моите омилени', //cpg1.4
  'fav_lnk' => 'Мои Омилени',
  'memberlist_title' => 'Покажи ја листата на Членови',
  'memberlist_lnk' => 'Членови',
  'faq_title' => 'Често Поставувани Прашања',
  'faq_lnk' => 'ЧЧП',
);

$lang_gallery_admin_menu = array(
  'upl_app_title' => 'Одобри нов аплод', //cpg1.4
  'upl_app_lnk' => 'Одобрение',
  'admin_title' => 'Оди во конфигурација', //cpg1.4
  'admin_lnk' => 'Конфигурација', //cpg1.4
  'albums_title' => 'Оди во конфигурација на албуми', //cpg1.4
  'albums_lnk' => 'Албуми',
  'categories_title' => 'Оди во конфигурација на кетегории', //cpg1.4
  'categories_lnk' => 'Категории',
  'users_title' => 'Оди ви конфигурација на членови', //cpg1.4
  'users_lnk' => 'Членови',
  'groups_title' => 'Оди во конфигурација на групи', //cpg1.4
  'groups_lnk' => 'Групи',
  'comments_title' => 'Види ги сите коментари', //cpg1.4
  'comments_lnk' => 'Коментари', //cpg1.3.0
  'searchnew_title' => 'Оди во Фајлови на куп', //cpg1.4
  'searchnew_lnk' => 'Фајлови на куп', //cpg1.3.0
  'util_title' => 'Оди во Админ алатки', //cpg1.4
  'util_lnk' => 'Админ алатки', //cpg1.3.0
  'key_title' => 'Оди во речник на клучни зборови', //cpg1.4
  'key_lnk' => 'Речник на клучни зборови', //cpg1.4
  'ban_title' => 'Оди до банирани членови', //cpg1.4
  'ban_lnk' => 'Банирани членови',
  'db_ecard_title' => 'Преглед на е-картички', //cpg1.4
  'db_ecard_lnk' => 'Е-Картички', //cpg1.3.0
  'pictures_title' => 'Сортирај ги моите слики', //cpg1.4
  'pictures_lnk' => 'Сортирај ги моите слики', //cpg1.4
  'documentation_lnk' => 'Документација', //cpg1.4
  'documentation_title' => 'Coppermine корисник', //cpg1.4
);

$lang_user_admin_menu = array(
  'albmgr_title' => 'Создади и сортирање на мооите албуми', //cpg1.4
  'albmgr_lnk' => 'Создавање / сортирање на моите албуми',
  'modifyalb_title' => 'Промена на моите албуми',  //cpg1.4
  'modifyalb_lnk' => 'Промена на мои албуми',
  'my_prof_title' => 'Оди во мојот профил', //cpg1.4
  'my_prof_lnk' => 'Профил',
);

$lang_cat_list = array(
  'category' => 'Категорија',
  'albums' => 'Албуми',
  'pictures' => 'Слики', //cpg1.3.0
);

$lang_album_list = array(
  'album_on_page' => '%d албум(и) на %d страница(и)',
);

$lang_thumb_view = array(
  'date' => 'ДАТА',
  //Сортиране по filename and title
  'name' => 'ИМЕ НА ФАЈЛОТ',
  'title' => 'НАСЛОВ',
  'sort_da' => 'Сортирај по дата (ascending)',
  'sort_dd' => 'Сортирај по дата (descending)',
  'sort_na' => 'Сортирај по име(ascending)',
  'sort_nd' => 'Сортирај по име (descending)',
  'sort_ta' => 'Сортирај по наслов (ascending)',
  'sort_td' => 'Сортирај по наслов (descending)',
  'position' => 'ПОЗИЦИЈА', //cpg1.4
  'sort_pa' => 'Sort by position ascending', //cpg1.4
  'sort_pd' => 'Sort by position descending', //cpg1.4
  'download_zip' => 'Постави како Zip фајл',
  'pic_on_page' => '%d Фајлови на %d страна(и)',
  'user_on_page' => '%d членови на %d страна(и)',
  'enter_alb_pass' => 'Внеси ја лозинката за Албумот', //cpg1.4
  'invalid_pass' => 'Грешна лозинка', //cpg1.4
  'pass' => 'Лозинка', //cpg1.4
  'submit' => 'Испрати', //cpg1.4
);

$lang_img_nav_bar = array(
  'thumb_title' => 'Return to the thumbnail page',
  'pic_info_title' => 'Покажи/сокри информации за фајлот',
  'slideshow_title' => 'Slideshow',
  'ecard_title' => 'Испрати го овој фајл како е-картица',
  'ecard_disabled' => 'e-картиците се исклучени',
  'ecard_disabled_msg' => 'You don\'t have permission to send ecards', //js-alert
  'prev_title' => 'Види предходно',
  'next_title' => 'Види следно',
  'pic_pos' => 'ФАЈЛ %s/%s',
  'report_title' => 'Report this file to the administrator', //cpg1.4
  'go_album_end' => 'Скокни на крај', //cpg1.4
  'go_album_start' => 'Вратисе на почеток', //cpg1.4
  'go_back_x_items' => 'go back %s items', //cpg1.4
  'go_forward_x_items' => 'go forward %s items', //cpg1.4
);

$lang_rate_pic = array(
  'rate_this_pic' => 'Отцени го фајлот ',
  'no_votes' => '(Нема отценки)',
  'rating' => '(отценките се : %s / 5 with %s votes)',
  'rubbish' => 'Ѓубре',
  'poor' => 'Лошо',
  'fair' => 'Не е добро',
  'good' => 'Добро е',
  'excellent' => 'Многу добро',
  'great' => 'Одлично е',
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
  CRITICAL_ERROR => 'Критична грешка',
  'file' => 'Фајл: ',
  'line' => 'Ред: ',
);

$lang_display_thumbnails = array(
  'filename' => 'Име на Фајлот=', //cpg1.4
  'filesize' => 'Големина на фајлот=', //cpg1.4
  'dimensions' => 'Димензии=', //cpg1.4
  'date_added' => 'Додадено на дата=', //cpg1.4
);

$lang_get_pic_data = array(
  'n_comments' => '%s коментари',
  'n_views' => '%s пати е видено',
  'n_votes' => '(%s отценки)',
);

$lang_cpg_debug_output = array(
  'debug_info' => 'Debug Info',
  'select_all' => 'Селектирај ги сите',
  'copy_and_paste_instructions' => 'If you\'re going to request help on the coppermine support board, copy-and-paste this debug output into your posting when requested, along with the error message you get (if any). Make sure to replace any passwords from the query with *** before posting. <br />Note: This is for information only and does not mean there is an error with your gallery.', //cpg1.4
  'phpinfo' => 'display phpinfo',
  'notices' => 'Notices', //cpg1.4
);

$lang_language_selection = array(
  'reset_language' => 'Default lјазик',
  'choose_language' => 'Одбери јазик (Choose language)',
);

$lang_theme_selection = array(
  'reset_theme' => 'Постави стил',
  'choose_theme' => 'Одбери стил',
);

$lang_version_alert = array(
  'version_alert' => 'Unsupported version!', //cpg1.4
  'security_alert' => 'Security Alert!', //cpg1.4.3
  'relocate_exists' => 'Remove the <a href="http://coppermine-gallery.net/forum/index.php?topic=24217.0" target=_blank>relocate_server.php</a> file from your website!',
  'no_stable_version' => 'You are running Coppermine %s (%s) which is only meant for very experienced users - this version comes without support nor any warranties. Use it at your own risk or downgrade to the latest stable version if you need support!', //cpg1.4
  'gallery_offline' => 'The gallery is currently offline and will be only visible for you as admin. Don\'t forget to switch it back online after finishing maintenance.', //cpg1.4
);

$lang_create_tabs = array(
  'previous' => 'Предходно', //cpg1.4
  'next' => 'Следно', //cpg1.4
);

// ------------------------------------------------------------------------- //
// File include/init.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File keyword.inc.php                                                      //
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File include/picmgmt.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File include/plugin_api.inc.php
// ------------------------------------------------------------------------- //
$lang_plugin_api = array(
  'error_wakeup' => "Couldn't awaken plugin '%s'", //cpg1.4
  'error_install' => "Couldn't install plugin '%s'", //cpg1.4
  'error_uninstall' => "Couldn't uninstall plugin '%s'", //cpg1.4
  'error_sleep' => "Couldn't uninstall plugin '%s'<br />", //cpg1.4
);

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
// File mode.php //cpg1.4
// ------------------------------------------------------------------------- //

if (defined('MODE_PHP')) $lang_mode_php = array(
  0 => 'Напуштате админ мод...',
  1 => 'Влегувате во админ мод...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
  'alb_need_name' => 'Албумот мора да има име !', //js-alert
  'confirm_modifs' => 'Сигурно сакате да ги направите овие промени модификации ?', //js-alert
  'no_change' => 'Не направивте никакви промени !', //js-alert
  'new_album' => 'Нов Албум',
  'confirm_delete1' => 'Сигурно сакате да го избришите овој албум ?', //js-alert
  'confirm_delete2' => '\nСите коментари ке бидат изгубени !', //js-alert
  'select_first' => 'Одбери албум прво', //js-alert
  'alb_mrg' => 'Албум менаџер',
  'my_gallery' => '* Моја Галерија *',
  'no_category' => '* Нема Категории *',
  'delete' => 'Бриши',
  'new' => 'Ново',
  'apply_modifs' => 'Испрати Модификација',
  'select_category' => 'Селектирај категорија',
);

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
  'title' => 'Ban Users', //cpg1.4
  'user_name' => 'User Name', //cpg1.4
  'ip_address' => 'IP Address', //cpg1.4
  'expiry' => 'Expires (blank is permanent)', //cpg1.4
  'edit_ban' => 'Save Changes', //cpg1.4
  'delete_ban' => 'Delete', //cpg1.4
  'add_new' => 'Add New Ban', //cpg1.4
  'add_ban' => 'Add', //cpg1.4
  'error_user' => 'Cannot find user', //cpg1.4
  'error_specify' => 'You need to specifiy either a user name or an IP address', //cpg1.4
  'error_ban_id' => 'Invalid ban ID!', //cpg1.4
  'error_admin_ban' => 'You cannnot ban yourself!', //cpg1.4
  'error_server_ban' => 'You were going to ban your own server? Tsk tsk, cannot do that...', //cpg1.4
  'error_ip_forbidden' => 'You cannnot ban this IP - it is non-routable (private) anyway!<br />If you want to allow banning for private IPs, change this in your <a href="admin.php">Config</a> (only makes sense when Coppermine runs on a LAN).', //cpg1.4
  'lookup_ip' => 'Lookup an IP address', //cpg1.4
  'submit' => 'go!', //cpg1.4
  'select_date' => 'select date', //cpg1.4
);

// ------------------------------------------------------------------------- //
// File bridgemgr.php //cpg1.4
// ------------------------------------------------------------------------- //

if (defined('BRIDGEMGR_PHP')) $lang_bridgemgr_php = array(
  'title' => 'Bridge помошник',
  'warning' => 'Warning: when using this wizard you have to understand that sensitive data is being sent using html forms. Only run it on your own PC (not on a public client like an internet cafe), and make sure to clear the browser cache and temporary files after you have finished, or others might be able to access your data!',
  'back' => 'назад',
  'next' => 'следно',
  'start_wizard' => 'Start bridging wizard',
  'finish' => 'Finish',
  'hide_unused_fields' => 'hide unused form fields (recommended)',
  'clear_unused_db_fields' => 'clear invalid database entries (recommended)',
  'custom_bridge_file' => 'your custom bridge file\'s name (if the bridge file\'s name is <i>myfile.inc.php</i>, enter <i>myfile</i> into this field)',
  'no_action_needed' => 'No action needed in this step. Just click \'next\' to continue.',
  'reset_to_default' => 'Reset to default value',
  'choose_bbs_app' => 'choose application to bridge coppermine with',
  'support_url' => 'Go here for support on this application',
  'settings_path' => 'path(s) used by your BBS app',
  'database_connection' => 'database connection',
  'database_tables' => 'database tables',
  'bbs_groups' => 'BBS groups',
  'license_number' => 'License number',
  'license_number_explanation' => 'enter your license number (if applicable)',
  'db_database_name' => 'Database name',
  'db_database_name_explanation' => 'Enter the name of the database your BBS app uses',
  'db_hostname' => 'Database host',
  'db_hostname_explanation' => 'Hostname where your mySQL database resides, usually &quot;localhost&quot;',
  'db_username' => 'Database user account',
  'db_username_explanation' => 'mySQL user account to use for connection with BBS',
  'db_password' => 'Database passsword',
  'db_password_explanation' => 'Passsword for this mySQL user account',
  'full_forum_url' => 'Forum URL',
  'full_forum_url_explanation' => 'Full URL of your BBS app (including the leading http:// bit, e.g. http://www.yourdomain.tld/forum)',
  'relative_path_of_forum_from_webroot' => 'Relative forum path',
  'relative_path_of_forum_from_webroot_explanation' => 'Relative path to your BBS app from the webroot (Example: if your BBS is at http://www.yourdomain.tld/forum/, enter &quot;/forum/&quot; into this field)',
  'relative_path_to_config_file' => 'Relative path to your BBS\'s config file',
  'relative_path_to_config_file_explanation' => 'Relative path to your BBS, seen from your Coppermine folder (e.g. &quot;../forum/&quot; if your BBS is at http://www.yourdomain.tld/forum/ and Coppermine at http://www.yourdomain.tld/gallery/)',
  'cookie_prefix' => 'Cookie prefix',
  'cookie_prefix_explanation' => 'this has to be your BBS\'s cookie name',
  'table_prefix' => 'Table prefix',
  'table_prefix_explanation' => 'Must match the prefix you chose for your BBS when setting it up.',
  'user_table' => 'User table',
  'user_table_explanation' => '(usually default value should be OK, unless your BBS install isn\'t standard)',
  'session_table' => 'Session table',
  'session_table_explanation' => '(usually default value should be OK, unless your BBS install isn\'t standard)',
  'group_table' => 'Group table',
  'group_table_explanation' => '(usually default value should be OK, unless your BBS install isn\'t standard)',
  'group_relation_table' => 'Group relation table',
  'group_relation_table_explanation' => '(usually default value should be OK, unless your BBS install isn\'t standard)',
  'group_mapping_table' => 'Group mapping table',
  'group_mapping_table_explanation' => '(usually default value should be OK, unless your BBS install isn\'t standard)',
  'use_standard_groups' => 'Use standard BBS usergroups',
  'use_standard_groups_explanation' => 'Use standard (built-in) usergroups (recommended). This will make all custom usergroups settings made on this page become void. Only disable this option if you REALLY know what you\'re doing!',
  'validating_group' => 'Validating group',
  'validating_group_explanation' => 'The group ID of your BBS where users accounts that need validation are in (usually default value should be OK, unless your BBS install isn\'t standard)',
  'guest_group' => 'Guest group',
  'guest_group_explanation' => 'Group ID of your BBS where guests (anonymous users) are in (default value should be OK, only edit if you know what you\'re doing)',
  'member_group' => 'Member group',
  'member_group_explanation' => 'Group ID of your BBS where &quot;regular&quot; users accounts are in (default value should be OK, only edit if you know what you\'re doing)',
  'admin_group' => 'Admin group',
  'admin_group_explanation' => 'Group ID of your BBS where admins are in (default value should be OK, only edit if you know what you\'re doing)',
  'banned_group' => 'Banned group',
  'banned_group_explanation' => 'Group ID of your BBS where banned users are in (default value should be OK, only edit if you know what you\'re doing)',
  'global_moderators_group' => 'Global moderators group',
  'global_moderators_group_explanation' => 'Group ID of your BBS where global moderators of your BBS are in (default value should be OK, only edit if you know what you\'re doing)',
  'special_settings' => 'BBS-specific settings',
  'logout_flag' => 'phpBB version (logout flag)',
  'logout_flag_explanation' => 'What\'s your BBS version (this setting specifies how logouts are being handled)',
  'use_post_based_groups' => 'Use post-based groups?',
  'logout_flag_yes' => '2.0.5 or higher',
  'logout_flag_no' => '2.0.4 or lower',
  'use_post_based_groups_explanation' => 'Should the groups from the BBS that are defined by the number of posts be taken into account (allows a granular permissions management) or just the default groups (makes administration easier, recommended). You can change this setting later as well.',
  'use_post_based_groups_yes' => 'yes',
  'use_post_based_groups_no' => 'no',
  'error_title' => 'You need to correct these errors before you can continue. Go to the previous screen.',
  'error_specify_bbs' => 'You have to specify what application you want to bridge your Coppermine install with.',
  'error_no_blank_name' => 'You can\'t leave the name of your custom bridge file blank.',
  'error_no_special_chars' => 'The bridge file name mustn\'t contain any special chars except underscore (_) and dash (-)!',
  'error_bridge_file_not_exist' => 'The bridge file %s doesn\'t exist on the server. Check if you have actually uploaded it.',
  'finalize' => 'enable/disable BBS integration',
  'finalize_explanation' => 'So far, the settings you specified have been written into the database, but BBS integration hasn\'t been enabled. You can switch integration on/off later at any time. Make sure to remember the admin username and password from standalone Coppermine, you might need it later to be able to make any changes. If anything goes wrong, go to %s and disable BBS integration there, using your standalone (unbridged) admin account (usually the one you set up during Coppermine install).',
  'your_bridge_settings' => 'Your bridge settings',
  'title_enable' => 'Enable integration/bridging with %s',
  'bridge_enable_yes' => 'enable',
  'bridge_enable_no' => 'disable',
  'error_must_not_be_empty' => 'must not be empty',
  'error_either_be' => 'must either be %s or %s',
  'error_folder_not_exist' => '%s doesn\'t exist. Correct the value you entered for %s',
  'error_cookie_not_readible' => 'Coppermine can\'t read a cookie named %s. Correct the value you entered for %s, or go to your BBS administration panel and make sure that the cookie path is readible for coppermine.',
  'error_mandatory_field_empty' => 'You can not leave the field %s blank - fill in the proper value.',
  'error_no_trailing_slash' => 'There mustn\'t be a trailing slash in the field %s.',
  'error_trailing_slash' => 'There must be a trailing slash in the field %s.',
  'error_db_connect' => 'Could not connect to the mySQL database with the data you specified. Here\'s what mySQL said:',
  'error_db_name' => 'Although Coppermine could establish a connection, it wasn\'t able to find the database %s. Make sure you have specified %s properly. Here\'s what mySQL said:',
  'error_prefix_and_table' => '%s and ',
  'error_db_table' => 'Could not find the table %s. Make sure you have specified %s correctly.',
  'recovery_title' => 'Bridge Manager: emergency recovery',
  'recovery_explanation' => 'If you came here to administer the BBS integration of your Coppermine gallery, you have to log in first as admin. If you can not log in because bridging doesn\'t work as expected, you can disable BBS integration with this page. Entering your username and password will not log you in, it will only disable BBS integration. Refer to the documentation for details.',
  'username' => 'Username',
  'password' => 'Password',
  'disable_submit' => 'submit',
  'recovery_success_title' => 'Authorization successful',
  'recovery_success_content' => 'You have successfully disabled BBS bridging. Your Coppermine install runs now in standalone mode.',
  'recovery_success_advice_login' => 'Log in as admin to edit your bridge settings and/or enable BBS integration again.',
  'goto_login' => 'Go to login page',
  'goto_bridgemgr' => 'Go to bridge manager',
  'recovery_failure_title' => 'Authorization failed',
  'recovery_failure_content' => 'You supplied the wrong credentials. You will have to supply the admin account data of the standalone version (usually the account you set up during Coppermine install).',
  'try_again' => 'try again',
  'recovery_wait_title' => 'Wait time has not elapsed',
  'recovery_wait_content' => 'For security reasons this script does not allow failed logons in short succession, so you will have to wait a bit untill you\'re allowed to try to authenticate.',
  'wait' => 'wait',
  'create_redir_file' => 'Create redirection file (recommended)',
  'create_redir_file_explanation' => 'To redirect users back to Coppermine once they logged into your BBS, you need a redirection file to be created within your BBS folder. When this option is checked, the bridge manager will attempt to create this file for you, or give you code ready to copy-and-paste to create the file manually.',
  'browse' => 'browse',
);

// ------------------------------------------------------------------------- //
// File calendar.php //cpg1.4
// ------------------------------------------------------------------------- //

if (defined('CALENDAR_PHP')) $lang_calendar_php = array(
  'title' => 'Календар', //cpg1.4
  'close' => 'затвори', //cpg1.4
  'clear_date' => 'изчисти ја датата', //cpg1.4
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
  'miss_param' => 'Parameters required for \'%s\'operation not supplied !',
  'unknown_cat' => 'Selected category does not exist in database',
  'usergal_cat_ro' => 'Категории во Членска Галерија не може да се избриши !',
  'manage_cat' => 'Промени ги категориите',
  'confirm_delete' => 'Are you sure you want to DELETE this category', //js-alert
  'category' => 'Категорија',
  'operations' => 'Операции',
  'move_into' => 'Премести во',
  'update_create' => 'Обнови/Креирај Категорија',
  'parent_cat' => 'Под Категорија',
  'cat_title' => 'Име на категоријата',
  'cat_thumb' => 'Category thumbnail',
  'cat_desc' => 'Category description',
  'categories_alpha_sort' => 'Sort categories alphabetically (instead of custom sort order)', //cpg1.4
  'save_cfg' => 'Зачувај ја конфигурацијата', //cpg1.4
);

// ------------------------------------------------------------------------- //
// File admin.php //cpg1.4
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
  'title' => 'Gallery Configuration', //cpg1.4
  'manage_exif' => 'Manage exif display', //cpg1.4
  'manage_plugins' => 'Manage plugins', //cpg1.4
  'manage_keyword' => 'Manage keywords', //cpg1.4
  'restore_cfg' => 'Restore factory defaults',
  'save_cfg' => 'Зачувај ја новата конфирурација',
  'notes' => 'Белешки',
  'info' => 'Информација',
  'upd_success' => 'Coppermine configuration was updated',
  'restore_success' => 'Coppermine default configuration restored',
  'name_a' => 'Name ascending',
  'name_d' => 'Name descending',
  'title_a' => 'Title ascending',
  'title_d' => 'Title descending',
  'date_a' => 'Date ascending',
  'date_d' => 'Date descending',
  'pos_a' => 'Position ascending', //cpg1.4
  'pos_d' => 'Position descending', //cpg1.4
  'th_any' => 'Max Aspect',
  'th_ht' => 'Height',
  'th_wd' => 'Width',
  'label' => 'label',
  'item' => 'item',
  'debug_everyone' => 'Everyone',
  'debug_admin' => 'Admin only',
  'no_logs'=> 'Off', //cpg1.4
  'log_normal'=> 'Normal', //cpg1.4
  'log_all' => 'Сите', //cpg1.4
  'view_logs' => 'View logs', //cpg1.4
  'click_expand' => 'click section name to expand', //cpg1.4
  'expand_all' => 'Expand All', //cpg1.4
  'notice1' => '(*) These settings mustn\'t be changed if you already have files in your database.', //cpg1.4 - (relocated)
  'notice2' => '(**) When changing this setting, only the files that are added from that point on are affected, so it is advisable that this setting must not be changed if there are already files in the gallery. You can, however, apply the changes to the existing files with the &quot;<a href="util.php">admin tools</a> (resize pictures)&quot; utility from the admin menu.', //cpg1.4 - (relocated)
  'notice3' => '(***) All log files are written in english.', //cpg1.4 - (relocated)
  'bbs_disabled' => 'Function disabled when using bb integration', //cpg1.4
  'auto_resize_everyone' => 'Everyone', //cpg1.4
  'auto_resize_user' => 'User only', //cpg1.4
  'ascending' => 'ascending', //cpg1.4
  'descending' => 'descending', //cpg1.4
);

if (defined('ADMIN_PHP')) $lang_admin_data = array(
  'General settings',
  array('Gallery name', 'gallery_name', 0, 'f=index.htm&amp;as=admin_general_name&amp;ae=admin_general_name_end'), //cpg1.4
  array('Gallery description', 'gallery_description', 0, 'f=index.htm&amp;as=admin_general_description&amp;ae=admin_general_description_end'), //cpg1.4
  array('Gallery administrator email', 'gallery_admin_email', 0, 'f=index.htm&amp;as=admin_general_email&amp;ae=admin_general_email_end'), //cpg1.4
  array('URL of your coppermine gallery folder (no \'index.php\' or similar at the end)', 'ecards_more_pic_target', 0, 'f=index.htm&amp;as=admin_general_coppermine-url&amp;ae=admin_general_coppermine-url_end'), //cpg1.4
  array('URL of your home page', 'home_target', 0, 'f=index.htm&amp;as=admin_general_home-url&amp;ae=admin_general_home-url_end'), //cpg1.4
  array('Allow ZIP-download of favorites', 'enable_zipdownload', 1, 'f=index.htm&amp;as=admin_general_zip-download&amp;ae=admin_general_zip-download_end'), //cpg1.4
  array('Timezone difference relative to GMT (current time: ' . localised_date(-1, $comment_date_fmt) . ')','time_offset',0, 'f=index.htm&amp;as=admin_general_time-offset&amp;ae=admin_general_time-offset_end&amp;top=1'), //cpg1.4
  array('Enable encrypted passwords (can not be undone)','enable_encrypted_passwords',1, 'f=index.htm&amp;as=admin_general_encrypt_password_start&amp;ae=admin_general_encrypt_password_end&amp;top=1'), // cpg 1.4
  array('Enable help-icons (help available in English only)','enable_help',9, 'f=index.htm&amp;as=admin_general_help&amp;ae=admin_general_help_end'), //cpg1.4
  array('Enable clickable keywords in search','clickable_keyword_search',14, 'f=index.htm&amp;as=admin_general_keywords_start&amp;ae=admin_general_keywords_end'), //cpg1.4
  array('Enable plugins', 'enable_plugins', 12, 'f=index.htm&amp;as=admin_general_enable-plugins&amp;ae=admin_general_enable-plugins_end'),  //cpg1.4
  array('Allow banning of non-routable (private) IP addresses', 'ban_private_ip', 1,  'f=index.htm&amp;as=admin_general_private-ip&amp;ae=admin_general_private-ip_end'), //cpg1.4
  array('Browsable batch-add interface', 'browse_batch_add', 1, 'f=index.htm&amp;as=admin_general_browsable_batch_add&amp;ae=admin_general_browsable_batch_add_end'), //cpg1.4

  'Language &amp; Charset settings',
  array('Language', 'lang', 5, 'f=index.htm&amp;as=admin_language_language&amp;ae=admin_language_language_end'), //cpg1.4
  array('Fallback to English if translated phrase not found?', 'language_fallback', 1, 'f=index.htm&amp;as=admin_language_fallback&amp;ae=admin_language_fallback_end'), //cpg1.4
  array('Character encoding', 'charset', 4, 'f=index.htm&amp;as=admin_language_charset&amp;ae=admin_language_charset_end'), //cpg1.4
  array('Display language list', 'language_list', 1, 'f=index.htm&amp;as=admin_language_list&amp;ae=admin_language_list_end'), //cpg1.4
  array('Display language flags', 'language_flags', 8, 'f=index.htm&amp;as=admin_language_flags&amp;ae=admin_language_flags_end&amp;top=1'), //cpg1.4
  array('Display &quot;reset&quot; in language selection', 'language_reset', 1, 'f=index.htm&amp;as=admin_language_reset&amp;ae=admin_language_reset_end&amp;top=1'), //cpg1.4
  //array('Display previous/next on tabbed pages', 'previous_next_tab', 1), //cpg1.4

  'Themes settings',
  array('Theme', 'theme', 6, 'f=index.htm&amp;as=admin_theme_theme&amp;ae=admin_theme_theme_end'), //cpg1.4
  array('Display theme list', 'theme_list', 1, 'f=index.htm&amp;as=admin_theme_theme_list&amp;ae=admin_theme_theme_list_end'), //cpg1.4
  array('Display &quot;reset&quot; in theme selection', 'theme_reset', 1, 'f=index.htm&amp;as=admin_theme_theme_reset&amp;ae=admin_theme_theme_reset_end'), //cpg1.4
  array('Display FAQ', 'display_faq', 1, 'f=index.htm&amp;as=admin_theme_faq&amp;ae=admin_theme_faq_end'), //cpg1.4
  array('Custom menu link name', 'custom_lnk_name', 0,'f=index.htm&amp;as=admin_theme_custom_lnk_name&amp;ae=admin_theme_custom_lnk_name_end'), //cpg1.4
  array('Custom menu link URL', 'custom_lnk_url', 0,'f=index.htm&amp;as=admin_language_custom_lnk_url&amp;ae=admin_language_custom_lnk_url_end'), //cpg1.4
  array('Display bbcode help', 'show_bbcode_help', 1, 'f=index.htm&amp;as=admin_theme_bbcode&amp;ae=admin_theme_bbcode_end&amp;top=1'), //cpg1.4
  array('Show the vanity block on themes that are defined as XHTML and CSS compliant','vanity_block',1, 'f=index.htm&amp;as=vanity_block&amp;ae=vanity_block_end'), //cpg1.4
  array('Path to custom header include', 'custom_header_path', 0, 'f=index.htm&amp;as=admin_theme_include_path_start&amp;ae=admin_theme_include_path_end'), //cpg1.4
  array('Path to custom footer include', 'custom_footer_path', 0, 'f=index.htm&amp;as=admin_theme_include_path_start&amp;ae=admin_theme_include_path_end'), //cpg1.4

  'Album list view',
  array('Width of the main table (pixels or %)', 'main_table_width', 0, 'f=index.htm&amp;as=admin_album_table-width&amp;ae=admin_album_table-width_end'), //cpg1.4
  array('Number of levels of categories to display', 'subcat_level', 0, 'f=index.htm&amp;as=admin_album_category-levels&amp;ae=admin_album_category-levels_end'), //cpg1.4
  array('Number of albums to display', 'albums_per_page', 0, 'f=index.htm&amp;as=admin_album_number&amp;ae=admin_album_number_end'), //cpg1.4
  array('Number of columns for the album list', 'album_list_cols', 0, 'f=index.htm&amp;as=admin_album_columns&amp;ae=admin_album_columns_end'), //cpg1.4
  array('Size of thumbnails in pixels', 'alb_list_thumb_size', 0, 'f=index.htm&amp;as=admin_album_thumbnail-size&amp;ae=admin_album_thumbnail-size_end'), //cpg1.4
  array('The content of the main page', 'main_page_layout', 0, 'f=index.htm&amp;as=admin_album_list_content&amp;ae=admin_album_list_content_end'), //cpg1.4
  array('Show first level album thumbnails in categories','first_level',1, 'f=index.htm&amp;as=admin_album_first-level_thumbs&amp;ae=admin_album_first-level_thumbs_end'), //cpg1.4
  array('Sort categories alphabetically (instead of custom sort order)','categories_alpha_sort',1, 'f=index.htm&amp;as=admin_album_list_alphasort_start&amp;ae=admin_album_list_alphasort_end'), //cpg1.4
  array('Show number of linked files','link_pic_count',1, 'f=index.htm&amp;as=admin_album_linked_files_start&amp;ae=admin_album_linked_files_end'), //cpg1.4

  'Thumbnail view',
  array('Number of columns on thumbnail page', 'thumbcols', 0, 'f=index.htm&amp;as=admin_thumbnail_columns&amp;ae=admin_thumbnail_columns_end'), //cpg1.4
  array('Number of rows on thumbnail page', 'thumbrows', 0, 'f=index.htm&amp;as=admin_thumbnail_rows&amp;ae=admin_thumbnail_rows_end'), //cpg1.4
  array('Maximum number of tabs to display', 'max_tabs', 10, 'f=index.htm&amp;as=admin_thumbnail_tabs&amp;ae=admin_thumbnail_tabs_end'), //cpg1.4
  array('Display file caption (in addition to title) below the thumbnail', 'caption_in_thumbview', 1, 'f=index.htm&amp;as=admin_thumbnail_display_caption&amp;ae=admin_thumbnail_display_caption_end'), //cpg1.4
  array('Display number of views below the thumbnail', 'views_in_thumbview', 1, 'f=index.htm&amp;as=admin_thumbnail_display_views&amp;ae=admin_thumbnail_display_views_end'), //cpg1.4
  array('Display number of comments below the thumbnail', 'display_comment_count', 1, 'f=index.htm&amp;as=admin_thumbnail_display_comments&amp;ae=admin_thumbnail_display_comments_end'), //cpg1.4
  array('Display uploader name below the thumbnail', 'display_uploader', 1, 'f=index.htm&amp;as=admin_thumbnail_display_uploader&amp;ae=admin_thumbnail_display_uploader_end'), //cpg1.4
  //array('Display name of admin uploaders below the thumbnail', 'display_admin_uploader', 1, 'f=index.htm&amp;as=admin_thumbnail_display_admin_uploader&amp;ae=admin_thumbnail_display_admin_uploader_end'), //cpg1.4
  array('Display file name below the thumbnail', 'display_filename', 1, 'f=index.htm&amp;as=admin_thumbnail_display_filename&amp;ae=admin_thumbnail_display_filename_end'), //cpg1.4
  //array('Display album description', 'alb_desc_thumb', 1, 'f=index.htm&amp;as=admin_thumbnail_display_description&amp;ae=admin_thumbnail_display_description_end'), //cpg1.4
  array('Default sort order for files', 'default_sort_order', 3, 'f=index.htm&amp;as=admin_thumbnail_default_sortorder&amp;ae=admin_thumbnail_default_sortorder_end'), //cpg1.4
  array('Minimum number of votes for a file to appear in the \'top-rated\' list', 'min_votes_for_rating', 0, 'f=index.htm&amp;as=admin_thumbnail_minimum_votes&amp;ae=admin_thumbnail_minimum_votes_end'), //cpg1.4

  'Image view', //cpg1.4
  array('Width of the table for file display (pixels or %)', 'picture_table_width', 0, 'f=index.htm&amp;as=admin_image_comment_table-width&amp;ae=admin_image_comment_table-width_end'), //cpg1.4
  array('File information is visible by default', 'display_pic_info', 1, 'f=index.htm&amp;as=admin_image_comment_info_visible&amp;ae=admin_image_comment_info_visible_end'), //cpg1.4
  array('Max length for an image description', 'max_img_desc_length', 0, 'f=index.htm&amp;as=admin_image_comment_descr_length&amp;ae=admin_image_comment_descr_length_end'), //cpg1.4
  array('Max number of characters in a word', 'max_com_wlength', 0, 'f=index.htm&amp;as=admin_image_comment_chars_per_word&amp;ae=admin_image_comment_chars_per_word_end'), //cpg1.4
  array('Show film strip', 'display_film_strip', 1, 'f=index.htm&amp;as=admin_image_comment_filmstrip_toggle&amp;ae=admin_image_comment_filmstrip_toggle_end'), //cpg1.4
  array('Display file name under film strip thumbnail', 'display_film_strip_filename', 1, 'f=index.htm&amp;as=admin_image_comment_display_film_strip_filename&amp;ae=admin_image_comment_display_film_strip_filename_end'), //cpg1.4
  array('Number of items in film strip', 'max_film_strip_items', 0, 'f=index.htm&amp;as=admin_image_comment_filmstrip_number&amp;ae=admin_image_comment_filmstrip_number_end'), //cpg1.4
  array('Slideshow interval in milliseconds (1 second = 1000 milliseconds)', 'slideshow_interval', 0, 'f=index.htm&amp;as=admin_image_comment_slideshow_interval&amp;ae=admin_image_comment_slideshow_interval_end'), //cpg1.4

  'Comment settings', //cpg1.4
  array('Filter bad words in comments', 'filter_bad_words', 1, 'f=index.htm&amp;as=admin_image_comment_bad_words&amp;ae=admin_image_comment_bad_words_end'), //cpg1.4
  array('Allow smiles in comments', 'enable_smilies', 1, 'f=index.htm&amp;as=admin_image_comment_smilies&amp;ae=admin_image_comment_smilies_end'), //cpg1.4
  array('Allow several consecutive comments on one file from the same user (disable flood protection)', 'disable_comment_flood_protect', 1, 'f=index.htm&amp;as=admin_image_comment_flood&amp;ae=admin_image_comment_flood_end'), //cpg1.4
  array('Max number of lines in a comment', 'max_com_lines', 0, 'f=index.htm&amp;as=admin_image_comment_lines&amp;ae=admin_image_comment_lines_end'), //cpg1.4
  array('Maximum length of a comment', 'max_com_size', 0, 'f=index.htm&amp;as=admin_image_comment_length&amp;ae=admin_image_comment_length_end'), //cpg1.4
  array('Notify admin of comments by email', 'email_comment_notification', 1, 'f=index.htm&amp;as=admin_image_comment_admin_notify&amp;ae=admin_image_comment_admin_notify_end'), //cpg1.4
  array('Sort order of comments', 'comments_sort_descending', 17, 'f=index.htm&amp;as=admin_comment_sort_start&amp;ae=admin_comment_sort_end'), //cpg1.4
  array('Prefix for anonymous comments authors', 'comments_anon_pfx', 0, 'f=index.htm&amp;as=comments_anon_pfx&amp;ae=comments_anon_pfx_end'), //cpg1.4

  'Files and thumbnails settings',
  array('Quality for JPEG files', 'jpeg_qual', 0, 'f=index.htm&amp;as=admin_picture_thumbnail_jpeg_quality&amp;ae=admin_picture_thumbnail_jpeg_quality_end'), //cpg1.4
  array('Max dimension of a thumbnail <a href="#notice2" class="clickable_option">**</a>', 'thumb_width', 0, 'f=index.htm&amp;as=admin_picture_thumbnail_max-dimension&amp;ae=admin_picture_thumbnail_max-dimension_end'), //cpg1.4
  array('Use dimension ( width or height or Max aspect for thumbnail ) <a href="#notice2" class="clickable_option">**</a>', 'thumb_use', 7, 'f=index.htm&amp;as=admin_picture_thumbnail_use-dimension&amp;ae=admin_picture_thumbnail_use-dimension_end'), //cpg1.4
  array('Create intermediate pictures','make_intermediate',1, 'f=index.htm&amp;as=admin_picture_thumbnail_intermediate_toggle&amp;ae=admin_picture_thumbnail_intermediate_toggle_end'), //cpg1.4
  array('Max width or height of an intermediate picture/video <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0, 'f=index.htm&amp;as=admin_picture_thumbnail_intermediate_dimension&amp;ae=admin_picture_thumbnail_intermediate_dimension_end'), //cpg1.4
  array('Max size for uploaded files (KB)', 'max_upl_size', 0, 'f=index.htm&amp;as=admin_picture_thumbnail_max_upload_size&amp;ae=admin_picture_thumbnail_max_upload_size_end'), //cpg1.4
  array('Max width or height for uploaded pictures/videos (pixels)', 'max_upl_width_height', 0, 'f=index.htm&amp;as=admin_picture_thumbnail_max_upload_dimension&amp;ae=admin_picture_thumbnail_max_upload_dimension_end'), //cpg1.4
  array('Auto resize images that are larger than max width or height', 'auto_resize', 16, 'f=index.htm&amp;as=admin_picture_thumbnail_auto-resize&amp;ae=admin_picture_thumbnail_auto-resize_end'), //cpg1.4

  'Files and thumbnails advanced settings',
  array('Albums can be private (Note: if you switch from \'yes\' to \'no\' any current private albums will become public)', 'allow_private_albums', 1, 'f=index.htm&amp;as=admin_picture_thumb_advanced_private_toggle&amp;ae=admin_picture_thumb_advanced_private_toggle_end'), //cpg1.4
  array('Show private album Icon to unlogged user','show_private',1, 'f=index.htm&amp;as=admin_picture_thumb_advanced_private_icon_show&amp;ae=admin_picture_thumb_advanced_private_icon_show_end'), //cpg1.4
  array('Characters forbidden in filenames', 'forbiden_fname_char',0, 'f=index.htm&amp;as=admin_picture_thumb_advanced_filename_forbidden_chars&amp;ae=admin_picture_thumb_advanced_filename_forbidden_chars_end'), //cpg1.4
  //array('Accepted file extensions for uploaded pictures', 'allowed_file_extensions',0, 'f=index.htm&amp;as=&amp;ae=_end'), //cpg1.4
  array('Allowed image types', 'allowed_img_types',0, 'f=index.htm&amp;as=admin_picture_thumb_advanced_pic_extensions&amp;ae=admin_picture_thumb_advanced_pic_extensions_end'), //cpg1.4
  array('Allowed movie types', 'allowed_mov_types',0, 'f=index.htm&amp;as=admin_thumbs_advanced_movie&amp;ae=admin_thumbs_advanced_movie_end'), //cpg1.4
  array('Movie Playback Autostart', 'media_autostart',1, 'f=index.htm&amp;as=admin_movie_autoplay&amp;ae=admin_movie_autoplay_end'), //cpg1.4
  array('Allowed audio types', 'allowed_snd_types',0, 'f=index.htm&amp;as=admin_picture_thumb_advanced_audio_extensions&amp;ae=admin_picture_thumb_advanced_audio_extensions_end'), //cpg1.4
  array('Allowed document types', 'allowed_doc_types',0, 'f=index.htm&amp;as=admin_picture_thumb_advanced_doc_extensions&amp;ae=admin_picture_thumb_advanced_doc_extensions_end'), //cpg1.4
  array('Method for resizing images','thumb_method',2, 'f=index.htm&amp;as=admin_picture_thumb_advanced_resize_method&amp;ae=admin_picture_thumb_advanced_resize_method_end'), //cpg1.4
  array('Path to ImageMagick \'convert\' utility (example /usr/bin/X11/)', 'impath', 0, 'f=index.htm&amp;as=admin_picture_thumb_advanced_im_path&amp;ae=admin_picture_thumb_advanced_im_path_end'), //cpg1.4
  //array('Allowed image types (only valid for ImageMagick)', 'allowed_img_types',0, 'f=index.htm&amp;as=admin_picture_thumb_advanced_allowed_imagetypes&amp;ae=admin_picture_thumb_advanced_allowed_imagetypes_end'), //cpg1.4
  array('Command line options for ImageMagick', 'im_options', 0, 'f=index.htm&amp;as=admin_picture_thumb_advanced_im_commandline&amp;ae=admin_picture_thumb_advanced_im_commandline_end'), //cpg1.4
  array('Read EXIF data in JPEG files', 'read_exif_data', 13, 'f=index.htm&amp;as=admin_picture_thumb_advanced_exif&amp;ae=admin_picture_thumb_advanced_exif_end'), //cpg1.4
  array('Read IPTC data in JPEG files', 'read_iptc_data', 1, 'f=index.htm&amp;as=admin_picture_thumb_advanced_iptc&amp;ae=admin_picture_thumb_advanced_iptc_end'), //cpg1.4
  array('The album directory <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0, 'f=index.htm&amp;as=admin_picture_thumb_advanced_albums_dir&amp;ae=admin_picture_thumb_advanced_albums_dir_end'), //cpg1.4
  array('The directory for user files <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0, 'f=index.htm&amp;as=admin_picture_thumb_advanced_userpics_dir&amp;ae=admin_picture_thumb_advanced_userpics_dir_end'), //cpg1.4
  array('The prefix for intermediate pictures <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0, 'f=index.htm&amp;as=admin_picture_thumb_advanced_intermediate_prefix&amp;ae=admin_picture_thumb_advanced_intermediate_prefix_end'), //cpg1.4
  array('The prefix for thumbnails <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0, 'f=index.htm&amp;as=admin_picture_thumb_advanced_thumbs_prefix&amp;ae=admin_picture_thumb_advanced_thumbs_prefix_end'), //cpg1.4
  array('Default mode for directories', 'default_dir_mode', 0, 'f=index.htm&amp;as=admin_picture_thumb_advanced_chmod_folder&amp;ae=admin_picture_thumb_advanced_chmod_folder_end'), //cpg1.4
  array('Default mode for files', 'default_file_mode', 0, 'f=index.htm&amp;as=admin_picture_thumb_advanced_chmod_files&amp;ae=admin_picture_thumb_advanced_chmod_files_end'), //cpg1.4

  'User settings',
  array('Allow new user registrations', 'allow_user_registration', 1, 'f=index.htm&amp;as=admin_allow_registration&amp;ae=admin_allow_registration_end'), //cpg1.4
  array('Allow unlogged users (guest or anonymous) access', 'allow_unlogged_access', 1, 'f=index.htm&amp;as=admin_allow_unlogged_access&amp;ae=admin_allow_unlogged_access_end'), //cpg1.4
  array('User registration requires email verification', 'reg_requires_valid_email', 1, 'f=index.htm&amp;as=admin_registration_verify&amp;ae=admin_registration_verify_end'), //cpg1.4
  array('Notify admin of user registration by email', 'reg_notify_admin_email', 1, 'f=index.htm&amp;as=admin_registration_notify&amp;ae=admin_registration_notify_end'), //cpg1.4
  array('Admin activation of registrations', 'admin_activation', 1, 'f=index.htm&amp;as=admin_activation&amp;ae=admin_activation_end'),  //cpg1.4
  array('Allow two users to have the same email address', 'allow_duplicate_emails_addr', 1, 'f=index.htm&amp;as=admin_allow_duplicate_emails_addr&amp;ae=admin_allow_duplicate_emails_addr_end'), //cpg1.4
  array('Notify admin of user upload awaiting approval', 'upl_notify_admin_email', 1, 'f=index.htm&amp;as=admin_approval_notify&amp;ae=admin_approval_notify_end'), //cpg1.4
  array('Allow logged in users to view memberlist', 'allow_memberlist', 1, 'f=index.htm&amp;as=admin_user_memberlist&amp;ae=admin_user_memberlist_end'), //cpg1.4
  array('Allow users to change their email address in profile', 'allow_email_change', 1, 'f=index.htm&amp;as=admin_user_allow_email_change&amp;ae=admin_user_allow_email_change_end'), //cpg1.4
  array('Allow users to retain control over their pics in public galleries', 'users_can_edit_pics', 1, 'f=index.htm&amp;as=admin_user_editpics_public_start&amp;ae=admin_user_editpics_public_end'), //cpg1.4
  array('Number of failed login attempts until temporary ban (to avoid brute force attacks)', 'login_threshold', 0, 'f=index.htm&amp;as=admin_user_login_start&amp;ae=admin_user_login_end'), //cpg1.4
  array('Duration of a temporary ban after failed logins', 'login_expiry', 0, 'f=index.htm&amp;as=admin_user_login_start&amp;ae=admin_user_login_end'), //cpg1.4
  array('Enable Report to Admin', 'report_post', 1, 'f=index.htm&amp;as=admin_user_enable_report&amp;ae=admin_user_enable_report_end'),  //cpg1.4


// custom profile fields,  //cpg1.4
  'Custom fields for user profile (leave blank if unused).
  Use Profile 6 for long entries, such as biographies', //cpg1.4
  array('Profile 1 name', 'user_profile1_name', 0, 'f=index.htm&amp;as=admin_custom&amp;ae=admin_custom_end'), //cpg1.4
  array('Profile 2 name', 'user_profile2_name', 0), //cpg1.4
  array('Profile 3 name', 'user_profile3_name', 0), //cpg1.4
  array('Profile 4 name', 'user_profile4_name', 0), //cpg1.4
  array('Profile 5 name', 'user_profile5_name', 0), //cpg1.4
  array('Profile 6 name', 'user_profile6_name', 0), //cpg1.4

  'Custom fields for image description (leave blank if unused)',
  array('Field 1 name', 'user_field1_name', 0, 'f=index.htm&amp;as=admin_custom_image&amp;ae=admin_custom_image_end'), //cpg1.4
  array('Field 2 name', 'user_field2_name', 0),
  array('Field 3 name', 'user_field3_name', 0),
  array('Field 4 name', 'user_field4_name', 0),

  'Cookies settings',
  array('Cookie name', 'cookie_name', 0, 'f=index.htm&amp;as=admin_cookie_name&amp;ae=admin_cookie_name_end'), //cpg1.4
  array('Cookie path', 'cookie_path', 0, 'f=index.htm&amp;as=admin_cookie_path&amp;ae=admin_cookie_path_end'), //cpg1.4

  'Email settings  (usually nothing has to be changed here; leave all fields blank when not sure)', //cpg1.4
  array('SMTP Host (when left blank, sendmail will be used)', 'smtp_host', 0, 'f=index.htm&amp;as=admin_email&amp;ae=admin_email_end'), //cpg1.4
  array('SMTP Username', 'smtp_username', 0), //cpg1.4
  array('SMTP Password', 'smtp_password', 0), //cpg1.4

  'Logging and statistics', //cpg1.4
  array('Logging mode <a href="#notice3" class="clickable_option">***</a>', 'log_mode', 11, 'f=index.htm&amp;as=admin_logging_log_mode&amp;ae=admin_logging_log_mode_end'), //cpg1.4
  array('Log ecards', 'log_ecards', 1, 'f=index.htm&amp;as=admin_general_log_ecards&amp;ae=admin_general_log_ecards_end'), //cpg1.4
  array('Keep detailed vote statistics','vote_details',1, 'f=index.htm&amp;as=admin_logging_votedetails&amp;ae=admin_logging_votedetails_end'), //cpg1.4
  array('Keep detailed hit statistics','hit_details',1, 'f=index.htm&amp;as=admin_logging_hitdetails&amp;ae=admin_logging_hitdetails_end'), //cpg1.4

  'Maintenance settings', //cpg1.4
  array('Enable debug mode', 'debug_mode', 9, 'f=index.htm&amp;as=debug_mode&amp;ae=debug_mode_end'), //cpg1.4
  array('Display notices in debug mode', 'debug_notice', 1, 'f=index.htm&amp;as=admin_misc_debug_notices&amp;ae=admin_misc_debug_notices_end'), //cpg1.4
  array('Gallery is offline', 'offline', 1, 'f=index.htm&amp;as=admin_general_offline&amp;ae=admin_general_offline_end'), //cpg1.4
);


// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => 'Испрати е-картичка',
  'ecard_sender' => 'Испраќач',
  'ecard_recipient' => 'Примач',
  'ecard_date' => 'Дата',
  'ecard_display' => 'Покажи е-картичка',
  'ecard_name' => 'Име',
  'ecard_email' => 'Емаил',
  'ecard_ip' => 'IP #',
  'ecard_ascending' => 'ascending',
  'ecard_descending' => 'descending',
  'ecard_sorted' => 'Сортирано',
  'ecard_by_date' => 'по дата',
  'ecard_by_sender_name' => 'by sender\'s name',
  'ecard_by_sender_email' => 'by sender\'s email',
  'ecard_by_sender_ip' => 'by sender\'s IP address',
  'ecard_by_recipient_name' => 'by recipient\'s name',
  'ecard_by_recipient_email' => 'by recipient\'s email',
  'ecard_number' => 'displaying record %s to %s of %s',
  'ecard_goto_page' => 'Оди до страна',
  'ecard_records_per_page' => 'Records per page',
  'check_all' => 'Чекирај ги сите',
  'uncheck_all' => 'Одчекирај ги сите',
  'ecards_delete_selected' => 'Избричи ги селектираните е-картички',
  'ecards_delete_confirm' => 'Сигурно сакате да ги избришите овие рекорди? Чекирај ја кутиичката!',
  'ecards_delete_sure' => 'Сигурен сум',
);


// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
  'empty_name_or_com' => 'You need to type your name and a comment',
  'com_added' => 'Your comment was added',
  'alb_need_title' => 'You have to provide a title for the album !',
  'no_udp_needed' => 'No update needed.',
  'alb_updated' => 'The album was updated',
  'unknown_album' => 'Selected album does not exist or you don\'t have permission to upload in this album',
  'no_pic_uploaded' => 'No file was uploaded !<br /><br />If you have really selected a file to upload, check that the server allows file uploads...',
  'err_mkdir' => 'Failed to create directory %s !',
  'dest_dir_ro' => 'Destination directory %s is not writable by the script !',
  'err_move' => 'Impossible to move %s to %s !',
  'err_fsize_too_large' => 'The size of file you have uploaded is too large (maximum allowed is %s x %s) !', //obsolete since cpg1.3 - consider removal in cpg1.4 once upload.php has been overhauled
  'err_imgsize_too_large' => 'The size of the file you have uploaded is too large (maximum allowed is %s KB) !', //obsolete since cpg1.3 - consider removal in cpg1.4 once upload.php has been overhauled
  'err_invalid_img' => 'The file you have uploaded is not a valid image !',
  'allowed_img_types' => 'You can only upload %s images.',
  'err_insert_pic' => 'The file \'%s\' can\'t be inserted in the album ',
  'upload_success' => 'Вашиот фајл беше поставен успешно.<br /><br />Ќе треба одобрение од администраторот пред да бидат видливи.',
  'notify_admin_email_subject' => '%s - Upload notification',
  'notify_admin_email_body' => 'A picture has been uploaded by %s that needs your approval. Visit %s',
  'info' => 'Information',
  'com_added' => 'Comment added',
  'alb_updated' => 'Album updated',
  'err_comment_empty' => 'Your comment is empty !',
  'err_invalid_fext' => 'Only files with the following extensions are accepted : <br /><br />%s.',
  'no_flood' => 'Sorry but you are already the author of the last comment posted for this file<br /><br />Edit the comment you have posted if you want to modify it',
  'redirect_msg' => 'You are being redirected.<br /><br /><br />Click \'CONTINUE\' if the page does not refresh automatically',
  'upl_success' => 'Your file was successfully added',
  'email_comment_subject' => 'Comment posted on Coppermine Photo Gallery',
  'email_comment_body' => 'Someone has posted a comment on your gallery. See it at',
  'album_not_selected' => 'Album not selected', //cpg1.4
  'com_author_error' => 'Регистриран член го користи ова ,име логирај се или стави друго име', //cpg1.4
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
  'caption' => 'Caption',
  'fs_pic' => 'full size image',
  'del_success' => 'successfully deleted',
  'ns_pic' => 'normal size image',
  'err_del' => 'can\'t be deleted',
  'thumb_pic' => 'thumbnail',
  'comment' => 'comment',
  'im_in_alb' => 'image in album',
  'alb_del_success' => 'Албумот &laquo;%s&raquo; е избришан', //cpg1.4
  'alb_mgr' => 'Album Manager',
  'err_invalid_data' => 'Invalid data received in \'%s\'',
  'create_alb' => 'Креирање Албум \'%s\'',
  'update_alb' => 'Updating album \'%s\' with title \'%s\' and index \'%s\'',
  'del_pic' => 'Delete file',
  'del_alb' => 'Delete album',
  'del_user' => 'Delete user',
  'err_unknown_user' => 'The selected user does not exist !',
  'err_empty_groups' => 'There\'s no group table, or the group table is empty!', //cpg1.4
  'comment_deleted' => 'Comment was succesfully deleted',
  'npic' => 'Picture', //cpg1.4
  'pic_mgr' => 'Picture Manager', //cpg1.4
  'update_pic' => 'Updating picture \'%s\' with filename \'%s\' and index \'%s\'', //cpg1.4
  'username' => 'Username', //cpg1.4
  'anonymized_comments' => '%s comment(s) anonymized', //cpg1.4
  'anonymized_uploads' => '%s public upload(s) anonymized', //cpg1.4
  'deleted_comments' => '%s comment(s) deleted', //cpg1.4
  'deleted_uploads' => '%s public upload(s) deleted', //cpg1.4
  'user_deleted' => 'user %s deleted', //cpg1.4
  'activate_user' => 'Activate user', //cpg1.4
  'user_already_active' => 'Account has already been active', //cpg1.4
  'activated' => 'Activated', //cpg1.4
  'deactivate_user' => 'Deactivate user', //cpg1.4
  'user_already_inactive' => 'Account has already been inactive', //cpg1.4
  'deactivated' => 'Deactivated', //cpg1.4
  'reset_password' => 'Reset password(s)', //cpg1.4
  'password_reset' => 'Password reset to %s', //cpg1.4
  'change_group' => 'Change primary group', //cpg1.4
  'change_group_to_group' => 'Changing from %s to %s', //cpg1.4
  'add_group' => 'Add secondary group', //cpg1.4
  'add_group_to_group' => 'Adding user %s to group %s. He\'s now member of %s as primary and of %s as secondary membergroup(s).', //cpg1.4
  'status' => 'Status', //cpg1.4
);

// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //

if (defined('DISPLAYECARD_PHP')) {

$lang_displayecard_php = array(
  'invalid_data' => 'The data for the ecard you are trying to access has been corrupted by your mail client. Check the link is complete.', //cpg1.4
);
}

// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //

if (defined('DISPLAYIMAGE_PHP')){

$lang_display_image_php = array(
  'confirm_del' => 'Сигурно сакате да го ИЗБРИШИТЕ овој фајл? ? \\nКоментарот исто ке се избриши.', //js-alert
  'del_pic' => 'ИЗБРИШИ ЈА СЛИКАТА',
  'size' => '%s x %s пиксели',
  'views' => '%s times',
  'slideshow' => 'Започни Slideshow',
  'stop_slideshow' => 'Застани го SLIDESHOW',
  'view_fs' => 'Кликни за целосна големина на сликата',
  'edit_pic' => 'Промени ги информациите за фајлот', //cpg1.4
  'crop_pic' => 'Исечи и Ротирај',
  'set_player' => 'Промени плеер',
);

$lang_picinfo = array(
  'title' =>'Информација за фајлот',
  'Filename' => 'Име на фајлот',
  'Album name' => 'Име на Албумe',
  'Rating' => 'Rating (%s votes)',
  'Keywords' => 'Kлучен збор',
  'File Size' => 'Големина на Фајлот',
  'Date Added' => 'Додадено на', //cpg1.4
  'Dimensions' => 'Димензии',
  'Displayed' => 'Displayed',
  'URL' => 'URL', //cpg1.4
  'Make' => 'Марка', //cpg1.4
  'Model' => 'Модел', //cpg1.4
  'DateTime' => 'Дата Време', //cpg1.4
  'ISOSpeedRatings'=>'ISO', //cpg1.4
  'MaxApertureValue' => 'Max Aperture', //cpg1.4
  'FocalLength' => 'Focal length', //cpg1.4
  'Comment' => 'Коментар',
  'addFav'=>'Додади во омилени',
  'addFavPhrase'=>'Омилени',
  'remFav'=>'Отстрани од омилени',
  'iptcTitle'=>'IPTC Title',
  'iptcCopyright'=>'',
  'iptcKeywords'=>'IPTC Keywords',
  'iptcCategory'=>'IPTC Category',
  'iptcSubCategories'=>'IPTC Sub Categories',
  'ColorSpace' => 'Color Space', //cpg1.4
  'ExposureProgram' => 'Exposure Program', //cpg1.4
  'Flash' => 'Flash', //cpg1.4
  'MeteringMode' => 'Metering Mode', //cpg1.4
  'ExposureTime' => 'Exposure Time', //cpg1.4
  'ExposureBiasValue' => 'Exposure Bias', //cpg1.4
  'ImageDescription' => ' Image Description', //cpg1.4
  'Orientation' => 'Orientation', //cpg1.4
  'xResolution' => 'X Resolution', //cpg1.4
  'yResolution' => 'Y Resolution', //cpg1.4
  'ResolutionUnit' => 'Resolution Unit', //cpg1.4
  'Software' => 'Software', //cpg1.4
  'YCbCrPositioning' => 'YCbCrPositioning', //cpg1.4
  'ExifOffset' => 'Exif Offset', //cpg1.4
  'IFD1Offset' => 'IFD1 Offset', //cpg1.4
  'FNumber' => 'FNumber', //cpg1.4
  'ExifVersion' => 'Exif Version', //cpg1.4
  'DateTimeOriginal' => 'DateTime Original', //cpg1.4
  'DateTimedigitized' => 'DateTime digitized', //cpg1.4
  'ComponentsConfiguration' => 'Components Configuration', //cpg1.4
  'CompressedBitsPerPixel' => 'Compressed Bits Per Pixel', //cpg1.4
  'LightSource' => 'Light Source', //cpg1.4
  'ISOSetting' => 'ISO Setting', //cpg1.4
  'ColorMode' => 'Color Mode', //cpg1.4
  'Quality' => 'Quality', //cpg1.4
  'ImageSharpening' => 'Image Sharpening', //cpg1.4
  'FocusMode' => 'Focus Mode', //cpg1.4
  'FlashSetting' => 'Flash Setting', //cpg1.4
  'ISOSelection' => 'ISO Selection', //cpg1.4
  'ImageAdjustment' => 'Image Adjustment', //cpg1.4
  'Adapter' => 'Adapter', //cpg1.4
  'ManualFocusDistance' => 'Manual Focus Distance', //cpg1.4
  'DigitalZoom' => 'Digital Zoom', //cpg1.4
  'AFFocusPosition' => 'AF Focus Position', //cpg1.4
  'Saturation' => 'Saturation', //cpg1.4
  'NoiseReduction' => 'Noise Reduction', //cpg1.4
  'FlashPixVersion' => 'Flash Pix Version', //cpg1.4
  'ExifImageWidth' => 'Exif Image Width', //cpg1.4
  'ExifImageHeight' => 'Exif Image Height', //cpg1.4
  'ExifInteroperabilityOffset' => 'Exif Interoperability Offset', //cpg1.4
  'FileSource' => 'File Source', //cpg1.4
  'SceneType' => 'Scene Type', //cpg1.4
  'CustomerRender' => 'Customer Render', //cpg1.4
  'ExposureMode' => 'Exposure Mode', //cpg1.4
  'WhiteBalance' => 'White Balance', //cpg1.4
  'DigitalZoomRatio' => 'Digital Zoom Ratio', //cpg1.4
  'SceneCaptureMode' => 'Scene Capture Mode', //cpg1.4
  'GainControl' => 'Gain Control', //cpg1.4
  'Contrast' => 'Contrast', //cpg1.4
  'Sharpness' => 'Sharpness', //cpg1.4
  'ManageExifDisplay' => 'Manage Exif Display', //cpg1.4
  'submit' => 'Испрати', //cpg1.4
  'success' => 'Информациите обновени успешно.', //cpg1.4
  'details' => 'Детали', //cpg1.4
);

$lang_display_comments = array(
  'OK' => 'OK',
  'edit_title' => 'Промени го овој коментар',
  'confirm_delete' => 'Сигурно сакате да го избришите овој коментар ?', //js-alert
  'add_your_comment' => 'Додади коментар',
  'name'=>'Име',
  'comment'=>'Коментар',
  'your_name' => 'Ваше име',
  'report_comment_title' => 'Пријави го коментарот на Администраторот', //cpg1.4
);

$lang_fullsize_popup = array(
  'click_to_close' => 'Кликни на сликата да го затвориш овој прозорец',
);


}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
  'title' => 'Испрати е-картица',
  'invalid_email' => '<font color="red"><b>Предупредување</b></font>: неточна емаил адреса:', //cpg1.4
  'ecard_title' => 'Е-картица од %s до тебе',
  'error_not_image' => 'Only images can be sent as an ecard.',
  'view_ecard' => 'Alternate link if the e-card does not display correctly', //cpg1.4
  'view_ecard_plaintext' => 'Да ја видите е-картицата копирајте па пастирајте ја адресата во вашиот  browser:', //cpg1.4
  'view_more_pics' => 'Види уште слики !', //cpg1.4
  'send_success' => 'Важата е-картица беше испратена',
  'send_failed' => 'Се извинуваме но овој сервер не може да испрати е-картици...',
  'from' => 'Од',
  'your_name' => 'Ваше име',
  'your_email' => 'Ваша емаил адреса',
  'to' => 'To',
  'rcpt_name' => 'Recipient name',
  'rcpt_email' => 'Recipient email address',
  'greetings' => 'Heading', //cpg1.4
  'message' => 'Порака', //cpg1.4
  'ecards_footer' => 'Испратено од %s од IP %s во %s (Време на Галеријата)', //cpg1.4
  'preview' => 'Preview of the ecard', //cpg1.4
  'preview_button' => 'Preview', //cpg1.4
  'submit_button' => 'Send ecard', //cpg1.4
  'preview_view_ecard' => 'This will be the alternate link to the ecard once it gets generated. It won\'t work for previews.', //cpg1.4
);


// ------------------------------------------------------------------------- //
// File report_file.php //cpg1.4
// ------------------------------------------------------------------------- //

if (defined('REPORT_FILE_PHP') || defined('DISPLAYREPORT_PHP')) $lang_report_php =array(
  'title' => 'Пријави до Администратерот', //cpg1.4
  'invalid_email' => '<b>Предупредување</b> : неточна емаил адреса !', //cpg1.4
  'report_subject' => 'A report from %s on a gallery %s', //cpg1.4
  'view_report' => 'Alternate link if the report does not display correctly', //cpg1.4
  'view_report_plaintext' => 'To view the report, copy and paste this url into your browser\'s address bar:', //cpg1.4
  'view_more_pics' => 'Галерија', //cpg1.4
  'send_success' => 'Your report was sent', //cpg1.4
  'send_failed' => 'Се извинуваме серверот не може да испрати пријава (report)...', //cpg1.4
  'from' => 'Од', //cpg1.4
  'your_name' => 'Ваше име', //cpg1.4
  'your_email' => 'Вашата емаил адреса', //cpg1.4
  'to' => 'To', //cpg1.4
  'administrator' => 'Administrator/Mod', //cpg1.4
  'subject' => 'Subject', //cpg1.4
  'comment_field_name' => 'Reporting on Comment by "%s"', //cpg1.4
  'reason' => 'Reason', //cpg1.4
  'message' => 'Message', //cpg1.4
  'report_footer' => 'Sent by %s from IP %s at %s (Gallery time)', //cpg1.4
  'obscene' => 'obscene', //cpg1.4
  'offensive' => 'offensive', //cpg1.4
  'misplaced' => 'off-topic/misplaced', //cpg1.4
  'missing' => 'missing', //cpg1.4
  'issue' => 'error/cannot view', //cpg1.4
  'other' => 'other', //cpg1.4
  'refers_to' => 'File report refers to', //cpg1.4
  'reasons_list_heading' => 'reason(s) for report:', //cpg1.4
  'no_reason_given' => 'no reason was given', //cpg1.4
  'go_comment' => 'Go to comment', //cpg1.4
  'view_comment' => 'View full report with comment', //cpg1.4
  'type_file' => 'file', //cpg1.4
  'type_comment' => 'comment', //cpg1.4
  'invalid_data' => 'The data for the report you are trying to access has been corrupted by your mail client. Check the link is complete.', //cpg1.4

);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
  'pic_info' => 'File info',
  'album' => 'Album',
  'title' => 'Title',
  'filename' => 'Filename', //cpg1.4
  'desc' => 'Description',
  'keywords' => 'Keywords',
  'new_keyword' => 'New keyword', //cpg1.4
  'new_keywords' => 'New keywords found', //cpg1.4
  'existing_keyword' => 'Existing keyword', //cpg1.4
  'pic_info_str' => '%s &times; %s - %s KB - %s views - %s votes',
  'approve' => 'Approve file',
  'postpone_app' => 'Postpone approval',
  'del_pic' => 'Delete file',
  'del_all' => 'Delete ALL files', //cpg1.4
  'read_exif' => 'Read EXIF info again',
  'reset_view_count' => 'Reset view counter',
  'reset_all_view_count' => 'Reset ALL view counters', //cpg1.4
  'reset_votes' => 'Reset votes',
  'reset_all_votes' => 'Reset ALL votes', //cpg1.4
  'del_comm' => 'Delete comments',
  'del_all_comm' => 'Delete ALL comments', //cpg1.4
  'upl_approval' => 'Upload approval', //cpg1.4
  'edit_pics' => 'Edit files',
  'see_next' => 'See next files',
  'see_prev' => 'See previous files',
  'n_pic' => '%s files',
  'n_of_pic_to_disp' => 'Number of files to display',
  'apply' => 'Испрати Модификација',
  'crop_title' => 'Coppermine Picture Editor',
  'preview' => 'Preview',
  'save' => 'Save picture',
  'save_thumb' =>'Save as thumbnail',
  'gallery_icon' => 'Make this my icon', //cpg1.4
  'sel_on_img' =>'The selection has to be entirely on the image!', //js-alert
  'album_properties' =>'Album properties', //cpg1.4
  'parent_category' =>'Parent category', //cpg1.4
  'thumbnail_view' =>'Thumbnail view', //cpg1.4
  'select_unselect' =>'select/unselect all', //cpg1.4
  'file_exists' => "Destination file '%s' already exists.", //cpg1.4
  'rename_failed' => "Failed to rename '%s' to '%s'.", //cpg1.4
  'src_file_missing' => "Source file '%s' is missing.", // cpg 1.4
  'mime_conv' => "Cannot convert file from '%s' to '%s'",//cpg1.4
  'forb_ext' => 'Forbidden file extension.',//cpg1.4
);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => 'Често Поставувани Прашања (се извинуваме не е уште превенено на Македонски)', //cpg1.3.0
  'toc' => 'Содржина', //cpg1.3.0
  'question' => 'Прашање: ', //cpg1.3.0
  'answer' => 'Одговор: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  'General FAQ',
  array('Why do I need to register?', 'Registration may or may not be required by the administrator. Registration gives a member additional features such as uploading, having a favorite list, rating pictures and posting comments etc.', 'allow_user_registration', '1'),
  array('How do I register?', 'Go to &quot;Register&quot; and fill out the required fields (and the optional ones if you want to).<br />If the Administrator has Email Activation enabled, then after submitting your information you should recieve an email message at the address that you have submitted while registering, giving you instructions on how to activate your membership. Your membership must be activated in order for you to login.', 'allow_user_registration', '1'), //cpg1.4
  array('How Do I login?', 'Go to &quot;Login&quot;, submit your username and password and check &quot;Remember Me&quot; so you will be logged in on the site if you should leave it.<br /><b>IMPORTANT:Cookies must be enabled and the cookie from this site must not be deleted in order to use &quot;Remember Me&quot;.</b>', 'offline', 0),
  array('Why can I not login?', 'Did you register and click the link that was sent to you via email?. The link will activate your account. For other login problems contact the site administrator.', 'offline', 0),
  array('What if I forgot my password?', 'If this site has a &quot;Forgot password&quot; link then use it. Other than that contact the site administrator for a new password.', 'offline', 0),
  //array('What if I changed my email address?', 'Just simply login and change your email address through &quot;Profile&quot;', 'offline', 0),
  array('How do I save a picture to &quot;My Favorites&quot;?', 'Click on a picture and click on the &quot;picture info&quot; link (<img src="images/info.gif" width="16" height="16" border="0" alt="Picture information" />); scroll down to the picture information set and click &quot;Add to fav&quot;.<br />The administrator may have the &quot;picture information&quot; on by default.<br />IMPORTANT:Cookies must be enabled and the cookie from this site must not be deleted.', 'offline', 0),
  array('How do I rate a file?', 'Click on a thumbnail and go to the bottom and choose a rating.', 'offline', 0),
  array('How do I post a comment for a picture?', 'Click on a thumbnail and go to the bottom and post a comment.', 'offline', 0),
  array('How do I upload a file?', 'Go to &quot;Upload&quot;and select the album that you want to upload to. Click &quot;Browse,&quot; find the file to upload, and click &quot;open.&quot; Add a title and description if you want. Click &quot;Submit&quot;.<br /><br />Alternatively, for those users using <b>Windows XP</b>, you can upload multiple files directly to your own private albums using the XP Publishing wizard.<br />For instructions on how, and to get the required registry file, click <a href="xp_publish.php">here.</a>', 'allow_private_albums', 1), //cpg1.4
  array('Where do I upload a picture to?', 'You will be able to upload a file to one of your albums in &quot;My Gallery&quot;. The Administrator may also allow you to upload a file to one or more of the albums in the Main Gallery.', 'allow_private_albums', 0),
  array('What type and size of a file can I upload?', 'The size and type (jpg, png, etc.) is up to the administrator.', 'offline', 0),
  array('How do I create, rename or delete an album in &quot;My Gallery&quot;?', 'You should already be in &quot;Admin-Mode&quot;<br />Go to &quot;Create/Order My Albums&quot;and click &quot;New&quot;. Change &quot;New Album&quot; to your desired name.<br />You can also rename any of the albums in your gallery.<br />Click &quot;Испрати Модификација&quot;.', 'allow_private_albums', 0),
  array('How can I modify and restrict users from viewing my albums?', 'You should already be in &quot;Admin Mode&quot;<br />Go to &quot;Modify My Albums. On the &quot;Update Album&quot; bar, select the album that you want to modify.<br />Here, you can change the name, description, thumbnail picture, restrict viewing and comment/rating permissions.<br />Click &quot;Update Album&quot;.', 'allow_private_albums', 0),
  array('How can I view other users\' galleries?', 'Go to &quot;Album List&quot; and select &quot;Членска Галерија&quot;.', 'allow_private_albums', 0),
  array('What are cookies?', 'Cookies are a plain text piece of data that is sent from a website and is put on to your computer.<br />Cookies usually allow a user to leave and return to the site without having to login again and other various chores.', 'offline', 0),
  array('Where can I get this program for my site?', 'Coppermine is a free Multimedia Gallery, released under GNU GPL. It is full of features and has been ported to various platforms. Visit the <a href="http://coppermine.sf.net/">Coppermine Home Page</a> to find out more or download it.', 'offline', 0),

  'Navigating the Site',
  array('What\'s &quot;Album List&quot;?', 'This will show you the entire category you are currently in, with a link to each album. If you are not in a category, it will show you the entire gallery with a link to each category. Thumbnails may be a link to the category.', 'offline', 0),
  array('What\'s &quot;My Gallery&quot;?', 'This feature lets users create their own galleries and add, delete or modify albums as well as upload to them.', 'allow_private_albums', 1), //cpg1.4
  array('What\'s &quot;Upload Picture&quot;?', 'This feature allows a user to upload a file (size and type is set by the site administrator) to a gallery selected by either you or the administrator.', 'allow_private_albums', 0),
  array('What\'s &quot;Last Uploads&quot;?', 'This feature shows the last uploads to the site.', 'offline', 0),
  array('What\'s &quot;Last Comments&quot;?', 'This feature shows the last comments along with the files posted by users.', 'offline', 0),
  array('What\'s &quot;Most Viewed&quot;?', 'This feature shows the most viewed files by all users (whether logged in or not).', 'offline', 0),
  array('What\'s &quot;Top Rated&quot;?', 'This feature shows the top rated files rated by the users, showing the average rating (e.g: five users each gave a <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />: the file would have an average rating of <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> ;Five users rated the file from 1 to 5 (1,2,3,4,5) would result in an average <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> .)<br />The ratings go from <img src="images/rating5.gif" width="65" height="14" border="0" alt="best" /> (best) to <img src="images/rating0.gif" width="65" height="14" border="0" alt="worst" /> (worst).', 'offline', 0),
  array('What\'s &quot;My Favorites&quot;?', 'This feature will let a user store a favorite file in the cookie that was sent to your computer.', 'offline', 0),
);


// ------------------------------------------------------------------------- //
// File forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => 'Си ја заборавив Лозинката',
  'err_already_logged_in' => 'Веќе сте логирани !',
  'enter_email' => 'Ставете ја вашата емаил адреса', //cpg1.4
  'submit' => 'Оди',
  'illegal_session' => 'Сесијата за заборавена лозика не е точна или е истечена.', //cpg1.4
  'failed_sending_email' => 'Лозинката не можеше да биде испратена на емаил !',
  'email_sent' => 'Емаил со вашето членско име и лозинка беше испратен до  %s', //cpg1.4
  'verify_email_sent' => 'An email has been sent to %s. Please check your email to complete the process.', //cpg1.4
  'err_unk_user' => 'Одбраниот член не постои!',
  'account_verify_subject' => '%s - Побарување на нова Лозинка', //cpg1.4
  'account_verify_body' => 'You have requested a new password. If you would like to proceed with having a new password sent to you, click on the following link:

%s', //cpg1.4
  'passwd_reset_subject' => '%s - Вашата нова лозинка', //cpg1.4
  'passwd_reset_body' => 'Овде е новата лозинка што ја баравте:
Username: %s
Password: %s
Click %s to log in.', //cpg1.4
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
  'group_name' => 'Група', //cpg1.4
  'permissions' => 'Дпзволи', //cpg1.4
  'public_albums' => 'Public albums upload', //cpg1.4
  'personal_gallery' => 'Personal gallery', //cpg1.4
  'upload_method' => 'Upload method', //cpg1.4
  'disk_quota' => 'Quota', //cpg1.4
  'rating' => 'Rating', //cpg1.4
  'ecards' => 'Е-Картица', //cpg1.4
  'comments' => 'Коментар', //cpg1.4
  'allowed' => 'Дозволено', //cpg1.4
  'approval' => 'Approval', //cpg1.4
  'boxes_number' => 'Бр. на кутии', //cpg1.4
  'variable' => 'variable', //cpg1.4
  'fixed' => 'fixed', //cpg1.4
  'apply' => 'Испрати Модификација',
  'create_new_group' => 'Create new group',
  'del_groups' => 'Delete selected group(s)',
  'confirm_del' => 'Warning, when you delete a group, users that belong to this group will be transferred to the \'Registered\' group !\n\nDo you want to proceed ?', //js-alert
  'title' => 'Manage user groups',
  'num_file_upload' => 'File upload boxes', //cpg1.4
  'num_URI_upload' => 'URI upload boxes', //cpg1.4
  'reset_to_default' => 'Reset to default name (%s) - recommended!', //cpg1.4
  'error_group_empty' => 'Group table was empty !<br /><br />Default groups created, please reload this page', //cpg1.4
  'explain_greyed_out_title' => 'Why is this row greyed out?', //cpg1.4
  'explain_guests_greyed_out_text' => 'You can not change the properties of this group because you set the option &quot; Allow unlogged users (guest or anonymous) access&quot; to &quot;No&quot; on the config page. All guest (members of the group %s) can\'t do anything but login; therefor group settings don\'t apply for them.', //cpg1.4
  'explain_banned_greyed_out_text' => 'You can not change the properties of the group %s because it\'s members can\'t do anything anyway.', //cpg1.4
  'group_assigned_album' => 'assigned album(s)', //cpg1.4
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
  'welcome' => 'Добредојде !',
);

$lang_album_admin_menu = array(
  'confirm_delete' => 'Сигурно сакате да го ИЗБРИШИТЕ овој Албум ? \\nСите фајлови и коментари ке бидат избришани.', //js-alert
  'delete' => 'БРИШИ',
  'modify' => 'PROPERTIES',
  'edit_pics' => 'ПРОМЕНИ ФАЈЛОВИ',
);

$lang_list_categories = array(
  'home' => 'Галерија Дома',
  'stat1' => '<b>[pictures]</b> слики во <b>[albums]</b> албуми и <b>[cat]</b> категории со  <b>[comments]</b>  коментари, видени <b>[views]</b> пати',
  'stat2' => '<b>[pictures]</b> слики во <b>[albums]</b> албуми, видени <b>[views]</b> пати',
  'xx_s_gallery' => '%s\' Галерија',
  'stat3' => '<b>[pictures]</b> слики во <b>[albums]</b> албуми <b>[comments]</b> коментари, видени <b>[views]</b> пати',
);

$lang_list_users = array(
  'user_list' => 'Листа на членови',
  'no_user_gal' => 'Нема членски галерии',
  'n_albums' => '%s албум(и)',
  'n_pics' => '%s фајлови(и)',
);

$lang_list_albums = array(
  'n_pictures' => 'додадени фајлови: %s ',
  'last_added' => ', додадени на %s',
  'n_link_pictures' => '%s линкувани фајлови', //cpg1.4
  'total_pictures' => '%s вкупно фајлови', //cpg1.4
);

}

// ------------------------------------------------------------------------- //
// File keywordmgr.php //cpg1.4
// ------------------------------------------------------------------------- //

if (defined('KEYWORDMGR_PHP')) $lang_keywordmgr_php = array(
  'title' => 'Manage keywords', //cpg1.4
  'edit' => 'промени', //cpg1.4
  'delete' => 'бриши', //cpg1.4
  'search' => 'барај', //cpg1.4
  'keyword_test_search' => 'барај за %s во нов прозорец', //cpg1.4
  'keyword_del' => 'бриши клучен збор %s', //cpg1.4
  'confirm_delete' => 'Сигурно сакате да го избришите клучниот збор %s од целата галерија?', //cpg1.4  // js-alert
  'change_keyword' => 'промени клучен збор', //cpg1.4
);

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
  'login' => 'Влез',
  'enter_login_pswd' => 'Внесете лозинка да влезите',
  'username' => 'Име',
  'password' => 'Лозинка',
  'remember_me' => 'Запамти ме',
  'welcome' => 'Добре дојде %s ...',
  'err_login' => '*** Не можете да влезнете. Пробај се повторно. ***',
  'err_already_logged_in' => 'Веќе сте логирани !',
  'forgot_password_link' => 'Си ја забноравив лозинката', //cpg1.3.0
  'cookie_warning' => 'Warning your browser does not accept script\'s cookies!', //cpg1.4
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
  'logout' => 'Излези',
  'bye' => 'Пријатно %s ...',
  'err_not_loged_in' => 'Не сте логирани !',
);

// ------------------------------------------------------------------------- //
// File minibrowser.php  //cpg1.4
// ------------------------------------------------------------------------- //

if (defined('MINIBROWSER_PHP')) $lang_minibrowser_php = array(
  'close' => 'затвори', //cpg1.4
  'submit' => 'OK', //cpg1.4
  'up' => 'нагоре', //cpg1.4
  'current_path' => 'сегашна насока', //cpg1.4
  'select_directory' => 'ве молиме изберете директориум', //cpg1.4
  'click_to_close' => 'Кликнете на сликата за да го затворите прозорецот',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
  'upd_alb_n' => 'Обнови албум %s',
  'general_settings' => 'Генерални сетинзи',
  'alb_title' => 'Наслов на албумот',
  'alb_cat' => 'Категорија на Албумот',
  'alb_desc' => 'Опис на Албумот',
  'alb_keyword' => 'Клучен збор на албум', //cpg1.4
  'alb_thumb' => 'Album thumbnail',
  'alb_perm' => 'Дозволи за овој Албум',
  'can_view' => 'Албумот може да биде виден од',
  'can_upload' => 'Посетители можат да ставаат фајлови',
  'can_post_comments' => 'Посетители можат да остават коментари',
  'can_rate' => 'Посетители можат да отценат фајлови',
  'user_gal' => 'Членска Галерија',
  'no_cat' => '* Нема категории *',
  'alb_empty' => 'Албумот е празен',
  'last_uploaded' => 'Последно поставен',
  'public_alb' => 'Сите (јавен албум)',
  'me_only' => 'Само јас',
  'owner_only' => 'Album owner (%s) only',
  'groupp_only' => 'Членови на  \'%s\' групата',
  'err_no_alb_to_modify' => 'Неможе да се променат албуми.',
  'update' => 'Обнови го албумот',
  'reset_album' => 'Reset album', //cpg1.4
  'reset_views' => 'Reset views counter to &quot;0&quot; in %s', //cpg1.4
  'reset_rating' => 'Reset ratings on all files in %s', //cpg1.4
  'delete_comments' => 'Бриши коментари направени во %s', //cpg1.4
  'delete_files' => '%sIrreversibly%s delete all files in %s', //cpg1.4
  'views' => 'видено', //cpg1.4
  'votes' => 'гласано', //cpg1.4
  'comments' => 'коментари', //cpg1.4
  'files' => 'фајлови', //cpg1.4
  'submit_reset' => 'испрати промени', //cpg1.4
  'reset_views_confirm' => 'Сигурен сум', //cpg1.4
  'notice1' => '(*) depending on %sgroups%s settings',  //cpg1.4 //(do not translate %s!)
  'alb_password' => 'Лозинка на албумот', //cpg1.4
  'alb_password_hint' => 'Album password hint', //cpg1.4
  'edit_files' =>'Промени фајлови', //cpg1.4
  'parent_category' =>'Parent category', //cpg1.4
  'thumbnail_view' =>'Thumbnail view', //cpg1.4
);

// ------------------------------------------------------------------------- //
// File phpinfo.php
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP info',
  'explanation' => 'This is the output generated by the PHP-function <a href="http://www.php.net/phpinfo">phpinfo()</a>, displayed within Coppermine (trimming the output at the right side).',
  'no_link' => 'Having others see your phpinfo can be a security risk, that\'s why this page is only visible when you\'re logged in as admin. You can not post a link to this page for others, they will be denied access.',
);

// ------------------------------------------------------------------------- //
// File picmgr.php //cpg1.4
// ------------------------------------------------------------------------- //
if (defined('PICMGR_PHP')) $lang_picmgr_php = array(
  'pic_mgr' => 'Picture Manager', //cpg1.4
  'select_album' => 'Одбери албум', //cpg1.4
  'delete' => 'Delete', //cpg1.4
  'confirm_delete1' => 'Сигурно сакате да ја избришите оваа слика?', //cpg1.4
  'confirm_delete2' => '\nСликата ке биде избришана засекогаш.', //cpg1.4
  'apply_modifs' => 'Испрати Модификација', //cpg1.4
  'confirm_modifs' => 'Confirm modifications', //cpg1.4
  'pic_need_name' => 'Сликата мора да има име !', //cpg1.4
  'no_change' => 'Не направивте никакви промениe !', //cpg1.4
  'no_album' => '* Нема албум *', //cpg1.4
  'explanation_header' => 'The custom sort order you can specify on this page will only be taken into account if', //cpg1.4
  'explanation1' => 'the admin has set the "Default sort order for files" in the config to "Position descending" or "Position ascending" (global setting for all users who haven\'t chosen another sort option individually)', //cpg1.4
  'explanation2' => 'the user has chosen "Position descending" or "Position ascending" on the thumbail page (per user setting)', //cpg1.4
);


// ------------------------------------------------------------------------- //
// File pluginmgr.php //cpg1.4
// ------------------------------------------------------------------------- //

if (defined('PLUGINMGR_PHP')){

$lang_pluginmgr_php = array(
  'confirm_uninstall' => 'Are you sure you want to UNINSTALL this plugin', //cpg1.4
  'confirm_delete' => 'Are you sure you want to DELETE this plugin', //cpg1.4
  'pmgr' => 'Plugin Manager', //cpg1.4
  'name' => 'Име', //cpg1.4
  'author' => 'Автор', //cpg1.4
  'desc' => 'Description', //cpg1.4
  'vers' => 'v', //cpg1.4
  'i_plugins' => 'Installed Plugins', //cpg1.4
  'n_plugins' => 'Plugins Not installed', //cpg1.4
  'none_installed' => 'None Installed', //cpg1.4
  'operation' => 'Operation', //cpg1.4
  'not_plugin_package' => 'The file uploaded is not a plugin package.', //cpg1.4
  'copy_error' => 'There was an error copying the package to the plugins folder.', //cpg1.4
  'upload' => 'Upload', //cpg1.4
  'configure_plugin' => 'Configure plugin', //cpg1.4
  'cleanup_plugin' => 'Cleanup plugin', //cpg1.4
);
}

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
  'already_rated' => 'Извини но веќе го одценивте овој фајл',
  'rate_ok' => 'Вашата отценка е прифатена',
  'forbidden' => 'Не може да ги отцениш твоите фајлови.',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Додека Администраторите на  {SITE_NAME} ќе пробаат да ги избришат или променат секој непристоен материја што е можно побрзо, не е возможно да се видат сите слики.<br />
<br />
Се согласувате дека нема да поставувате незаконска,сексуално ориентирана,насилничка ,вулгарна и застрашувачка содржина и {SITE_NAME}  ке биде користен само за информативни намери. Ако не се придржувате на правилата ке бидите банирани и вашиот Интернет провајдер ќе биде известен. IP адресите ке бидат запишани за секој материјал . Се согласуваш дека {SITE_NAME}  има право да ги промени материјалите што мисли дека не се пристојни, да избриши,заклучи или премерти материјали во секое време.  {SITE_NAME}   Не е одговорен за изгубени матријали од страна на {SITE_NAME} . Кршењето на правилата ќе резултира со забрана за користење на оваа страна (бан). Ако се повредени законите на Република Македонија или некоја друга држава, доколку е потребно, администраторите може да соработуваат со сите домашни и странски правни институции, откривајќи ги сите потребни информации на прекршителот (IP адреса, e-mail ...) .<br />
<br />
Системот на овоаа страна користи cookies за да ја запази информацијата на вашиот компјутер. Тие не содржат никаква информација која ќе ја напишете овде, туку се користат да се подобри функционалноста на форумот. Вашата е-маил адреса се користи само за потврда на регистрацијата (и за испраќање на лозинката ако случајно сте ја заборавиле).<br />
<br />
Со кликнување на  'Се согласувам' подолу вие се согласувате со горе наведените правила.
EOT;

$lang_register_php = array(
  'page_title' => 'Членска Регистрација',
  'term_cond' => 'Услови за употреба',
  'i_agree' => 'Се Согласувам',
  'submit' => 'Испрати',
  'err_user_exists' => 'Членското име што го одбравте е веќе во употреба, ве молиме одберете друго',
  'err_password_mismatch' => 'Двете лозинки не се исти, внесете ги повторно',
  'err_uname_short' => 'Членското име мора да биде барем 2 букви/броеви долго',
  'err_password_short' => 'Лозинката мора да биде барем 2 букви/броеви долга',
  'err_uname_pass_diff' => 'Членското име и лозинка мора да се разликуваат',
  'err_invalid_email' => 'Емаил адресата не е валидна',
  'err_duplicate_email' => 'Некој друг член веќе се регистрирал со оваа емаил адреса што ја внесовте',
  'enter_info' => 'Внесете ги вашите информации',
  'required_info' => 'Задолжителни информации',
  'optional_info' => 'Додатни Информации',
  'username' => 'Членско име',
  'password' => 'Лозинка',
  'password_again' => 'Повтори ја лозинката',
  'email' => 'Електронска пошта емаил',
  'location' => 'Локација',
  'interests' => 'Интереси',
  'website' => 'Веб Страна',
  'occupation' => 'Занимање',
  'error' => 'ГРЕШКА',
  'confirm_email_subject' => '%s - Регистрациона конформација',
  'information' => 'Информација',
  'failed_sending_email' => 'Конформација за регистрирање не може да биде испратена преку емаил !',
  'thank_you' => 'Ви благодариме што се регистриравте.<br /><br />Емаил со клуч за активација и како да го активирате членството е испратена на емаил адресата што ја ставивте.',
  'acct_created' => 'Вашето членство беше креирано и сега може да се логирате со вашето членско име и лозинка',
  'acct_active' => 'Вашето членство беше активирано и сега може да се логирате со вашето членско име и лозинка',
  'acct_already_act' => 'Членството е веќе активно!', //cpg1.4
  'acct_act_failed' => 'Ова Членство не можееше да се активира !',
  'err_unk_user' => 'Одбраниот член не постои !',
  'x_s_profile' => 'Профил на %s ',
  'group' => 'Група',
  'reg_date' => 'Приклучен',
  'disk_usage' => 'Користење на простор (Disk usage)',
  'change_pass' => 'Промени лозинка',
  'current_pass' => 'Сегашна лозинка',
  'new_pass' => 'Нова лозинка',
  'new_pass_again' => 'Повтори ја новата лозинка',
  'err_curr_pass' => 'Сегашната лозинка е неточна',
  'apply_modif' => 'Испрати Модификација',
  'change_pass' => 'Промени лозинка',
  'update_success' => 'Вашиот Профил беше обновен',
  'pass_chg_success' => 'Вашата лозинка беше променета',
  'pass_chg_error' => 'Вашата лозинка НЕ беше променета',
  'notify_admin_email_subject' => '%s - Известување за регистрација',
  'last_uploads' => 'Последно поставен фајл.<br />Кликни да ги видиш сите поставени фајлови од', //cpg1.4
  'last_comments' => 'Последен коментар.<br />Кликни да ги видиш сите коментари поставени од', //cpg1.4
  'notify_admin_email_body' => 'A new user with the username "%s" has registered in your gallery',
  'pic_count' => 'Вкупно поставени', //cpg1.4
  'notify_admin_request_email_subject' => '%s - Registration request', //cpg1.4
  'thank_you_admin_activation' => 'Благодариме.<br /><br />Your request for account activation was sent to the admin. You will receive an email if approved.', //cpg1.4
  'acct_active_admin_activation' => 'The account is now active and an email has been sent to the user.', //cpg1.4
  'notify_user_email_subject' => '%s - Activation notification', //cpg1.4
);

$lang_register_confirm_email = <<<EOT
Ви Благодарам што се регистриравте на {SITE_NAME}

За да го активирате членското име "{USER_NAME}", кликнете на линкот долу или копирајте го па пастирајтего во вашиот web browser.

<a href="{ACT_LINK}">{ACT_LINK}</a>

Regards,

The management of {SITE_NAME}

EOT;

$lang_register_approve_email = <<<EOT
A new user with the username "{USER_NAME}" has registered in your gallery.

In order to activate the account, you need to click on the link below or copy and paste it in your web browser.

<a href="{ACT_LINK}">{ACT_LINK}</a>

EOT;

$lang_register_activated_email = <<<EOT
Your account has been approved and activated.

You can now log in at <a href="{SITE_LINK}">{SITE_LINK}</a> using the username "{USER_NAME}"


Regards,

The management of {SITE_NAME}

EOT;
}


// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
  'title' => 'Разгледај коментари',
  'no_comment' => 'Нема коментари за разгледување',
  'n_comm_del' => '%s коментар(и) избришани',
  'n_comm_disp' => 'Број на коментари да се видат',
  'see_prev' => 'Види предходно',
  'see_next' => 'Види следно',
  'del_comm' => 'Бриши ги селектираните коментари',
  'user_name' => 'Име', //cpg1.4
  'date' => 'Дата', //cpg1.4
  'comment' => 'Коментар', //cpg1.4
  'file' => 'Фајл', //cpg1.4
  'name_a' => 'User name ascending', //cpg1.4
  'name_d' => 'User name descending', //cpg1.4
  'date_a' => 'Date ascending', //cpg1.4
  'date_d' => 'Date descending', //cpg1.4
  'comment_a' => 'Comment message ascending', //cpg1.4
  'comment_d' => 'Comment message descending', //cpg1.4
  'file_a' => 'File ascending', //cpg1.4
  'file_d' => 'File descending', //cpg1.4
);


// ------------------------------------------------------------------------- //
// File search.php                                                           //
// ------------------------------------------------------------------------- //


if (defined('SEARCH_PHP')){

$lang_search_php = array(
  'title' => 'Пребара ја колекцијата на фајлови', //cpg1.4
  'submit_search' => 'барај', //cpg1.4
  'keyword_list_title' => 'Keyword list', //cpg1.4
  'keyword_msg' => 'The above list is not all inclusive. It does not include words from photo titles or descriptions. Try a full-text search.',  //cpg1.4
  'edit_keywords' => 'Edit keywords', //cpg1.4
  'search in' => 'Барај во:', //cpg1.4
  'ip_address' => 'IP address', //cpg1.4
  'fields' => 'Search in', //cpg1.4
  'age' => 'Години', //cpg1.4
  'newer_than' => 'Поново од', //cpg1.4
  'older_than' => 'Постаро од', //cpg1.4
  'days' => 'денови', //cpg1.4
  'all_words' => 'Match all words (AND)', //cpg1.4
  'any_words' => 'Match any words (OR)', //cpg1.4
);

$lang_adv_opts = array(
  'title' => 'Наслов', //cpg1.4
  'caption' => 'Наслов', //cpg1.4
  'keywords' => 'Keywords', //cpg1.4
  'owner_name' => 'Owner name', //cpg1.4
  'filename' => 'име на фајот', //cpg1.4
);

}

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
  'page_title' => 'Барај  нови фајлови',
  'select_dir' => 'Одбери директориум',
  'select_dir_msg' => 'This function allows you to add a batch of files that your have uploaded to your server by FTP.<br /><br />Select the directory where you have uploaded your files.', //cpg1.4
  'no_pic_to_add' => 'There is no file to add',
  'need_one_album' => 'You need at least one album to use this function',
  'warning' => 'Warning',
  'change_perm' => 'the script can\'t write in this directory, you need to change its mode to 755 or 777 before trying to add the files !',
  'target_album' => '<b>Put files of &quot;</b>%s<b>&quot; into </b>%s',
  'folder' => 'Folder',
  'image' => 'file',
  'album' => 'Албум',
  'result' => 'Резултат',
  'dir_ro' => 'Not writable. ',
  'dir_cant_read' => 'Not readable. ',
  'insert' => 'Adding new files to the gallery',
  'list_new_pic' => 'List of new files',
  'insert_selected' => 'Insert selected files',
  'no_pic_found' => 'No new file was found',
  'be_patient' => 'Please be patient, the script needs time to add the files',
  'no_album' => 'no album selected',
  'result_icon' => 'click for details or to reload',  //cpg1.4
  'notes' =>  '<ul>'.
                          '<li><b>OK</b> : means that the file was succesfully added'.
                          '<li><b>DP</b> : means that the file is a duplicate and is already in the database'.
                          '<li><b>PB</b> : means that the file could not be added, check your configuration and the permission of directories where the files are located'.
                          '<li><b>NA</b> : means that you haven\'t selected an album the files should go to, hit \'<a href="javascript:history.back(1)">back</a>\' and select an album. If you don\'t have an album <a href="albmgr.php">create one first</a></li>'.
                          '<li>If the OK, DP, PB \'signs\' does not appear click on the broken file to see any error message produced by PHP'.
                          '<li>If your browser timeouts, hit the reload button'.
                          '</ul>',
  'select_album' => 'select album',
  'check_all' => 'Check All',
  'uncheck_all' => 'Uncheck All',
  'no_folders' => 'There are no folders inside the "albums" folder yet. Make sure to create at least one custom folder within "albums" folder and ftp-upload your files there. You mustn\'t upload to the "userpics" nor "edit" folders, they are reserved for http uploads and internal purposes.', //cpg1.4
   'albums_no_category' => 'Albums with no category', //cpg1.4 // album pulldown mod, added by frogfoot
  'personal_albums' => '* Personal albums', //cpg1.4 // album pulldown mod, added by frogfoot
  'browse_batch_add' => 'Browsable interface (recommended)', //cpg1.4
  'edit_pics' => 'Edit files', //cpg1.4
  'edit_properties' => 'Album properties', //cpg1.4
  'view_thumbs' => 'Thumbnail view', //cpg1.4
);

// ------------------------------------------------------------------------- //
// File stat_details.php //cpg1.4
// ------------------------------------------------------------------------- //

if (defined('STAT_DETAILS_PHP')) $lang_stat_details_php = array(
  'show_hide' => 'show/hide this column', //cpg1.4
  'vote' => 'Vote Details', //cpg1.4
  'hits' => 'Hit Details', //cpg1.4
  'stats' => 'Vote Statistics', //cpg1.4
  'sdate' => 'Дата', //cpg1.4
  'rating' => 'Rating', //cpg1.4
  'search_phrase' => 'Search phrase', //cpg1.4
  'referer' => 'Referer', //cpg1.4
  'browser' => 'Browser', //cpg1.4
  'os' => 'Оперативен систем', //cpg1.4
  'ip' => 'IP', //cpg1.4
  'sort_by_xxx' => 'Sort by %s', //cpg1.4
  'ascending' => 'ascending', //cpg1.4
  'descending' => 'descending', //cpg1.4
  'internal' => 'int', //cpg1.4
  'close' => 'Затвори', //cpg1.4
  'hide_internal_referers' => 'hide internal referers', //cpg1.4
  'date_display' => 'Date display', //cpg1.4
  'submit' => 'submit / refresh', //cpg1.4
);

// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => 'Постави фајл Upload file',
  'custom_title' => 'Customized Request Form',
  'cust_instr_1' => 'Може да одберите број на кутии за аплод. Но не може да одберите повеќе од границата покажана долу.',
  'cust_instr_2' => 'Box Number Requests',
  'cust_instr_3' => 'File upload boxes: %s',
  'cust_instr_4' => 'URI/URL upload boxes: %s',
  'cust_instr_5' => 'URI/URL upload boxes:',
  'cust_instr_6' => 'File upload boxes:',
  'cust_instr_7' => 'Please enter the number of each type of upload box you desire at this time.  Then click \'Continue\'. ',
  'reg_instr_1' => 'Invalid action for form creation.',
  'reg_instr_2' => 'Сега може да поставите фајлови користеќи ги кутиите долу. Фајловите поставени од вашиот компјутер до нашиот сервер не можат да бидат поголеми од %s KB секој посебно. ZIP фајловите поставени во  \'File Upload\' и \'URI/URL Upload\' секциите ќе останат компреситани.',
  'reg_instr_3' => 'If you want the zipped file or archive to be decompressed, you must use the file upload box provided in the \'Decompressive ZIP Upload\' area.',
  'reg_instr_4' => 'Кога користите URI/URL за поставување ,ве молиме внесете целосната адреса на фајлот кој што сакате да го поставите какао на пример: http://www.mysite.com/images/example.jpg',
  'reg_instr_5' => 'Кога ке завршите со пополнување на пормата стиснете \'Продолжи\'.',
  'reg_instr_6' => 'Decompressive ZIP Uploads:',
  'reg_instr_7' => 'File Uploads:',
  'reg_instr_8' => 'URI/URL Uploads:',
  'error_report' => 'Error Report',
  'error_instr' => 'The following uploads encountered errors:',
  'file_name_url' => 'File Name/URL',
  'error_message' => 'Error Message',
  'no_post' => 'File not uploaded by POST.',
  'forb_ext' => 'Forbidden file extension.',
  'exc_php_ini' => 'Exceeded filesize allowed in php.ini.',
  'exc_file_size' => 'Exceeded filesize permitted by CPG.',
  'partial_upload' => 'Only a partial upload.',
  'no_upload' => 'No upload occurred.',
  'unknown_code' => 'Unknown PHP upload error code.',
  'no_temp_name' => 'No upload - No temp name.',
  'no_file_size' => 'Contains no data/Corrupted',
  'impossible' => 'Impossible to move.',
  'not_image' => 'Not an image/corrupt',
  'not_GD' => 'Not a GD extension.',
  'pixel_allowance' => 'The height and or width of the uploaded picture is more than that allowed by the gallery config.', //cpg1.4
  'incorrect_prefix' => 'Incorrect URI/URL prefix',
  'could_not_open_URI' => 'Could not open URI.',
  'unsafe_URI' => 'Safety not verifiable.',
  'meta_data_failure' => 'Meta data failure',
  'http_401' => '401 Unauthorized',
  'http_402' => '402 Payment Required',
  'http_403' => '403 Forbidden',
  'http_404' => '404 Not Found',
  'http_500' => '500 Internal Server Error',
  'http_503' => '503 Service Unavailable',
  'MIME_extraction_failure' => 'MIME could not be determined.',
  'MIME_type_unknown' => 'Unknown MIME type',
  'cant_create_write' => 'Cannot create write file.',
  'not_writable' => 'Cannot write to write file.',
  'cant_read_URI' => 'Cannot read URI/URL',
  'cant_open_write_file' => 'Cannot open URI write file.',
  'cant_write_write_file' => 'Cannot write to URI write file.',
  'cant_unzip' => 'Cannot unzip.',
  'unknown' => 'Непозната грешка',
  'succ' => 'Successful Uploads',
  'success' => '%s uploads беја успешни.',
  'add' => 'Кликнете \'Продолжи\' да ги додадете фајловите во албумите.',
  'failure' => 'Upload Failure',
  'f_info' => 'Информација за фајлот',
  'no_place' => 'Предходниот фајл не можесе да да биде поставен.',
  'yes_place' => 'Предходниот фајл беше поставен успешно.',
  'max_fsize' => 'Мазксимална дозволена големина е  %s KB',
  'album' => 'Албум',
  'picture' => 'Фајл',
  'pic_title' => 'Наслов на фајлот',
  'description' => 'Опис на фајлот',
  'keywords' => 'Keywords (separate with spaces)<br /><a href="#" onClick="return MM_openBrWindow(\'keyword_select.php\',\'selectKey\',\'width=250, height=400, scrollbars=yes,toolbar=no,status=yes,resizable=yes\')">Insert from list</a>', //cpg1.4
  'keywords_sel' =>'Select a Keyword', //cpg1.4
  'err_no_alb_uploadables' => 'Sorry there is no album where you are allowed to upload files',
  'place_instr_1' => 'Поставете ги фајловите во албум. Исто може да внесите информации са секој фајл посебно.',
  'place_instr_2' => 'More files need placement. Please click \'Continue\'.',
  'process_complete' => 'Успешно ги поставивте сите фајлови.',
   'albums_no_category' => 'Albums with no category', //cpg1.4. //album pulldown mod, added by frogfoot
  'personal_albums' => '* Personal albums', //cpg1.4 //album pulldown mod, added by frogfoot
  'select_album' => 'Одбер албум', //cpg1.4 //album pulldown mod, added by frogfoot
  'close' => 'Close', //cpg1.4
  'no_keywords' => 'Sorry, no keywords available!', //cpg1.4
  'regenerate_dictionary' => 'Regenerate Dictionary', //cpg1.4
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
  'memberlist' => 'Memberlist', //cpg1.4
  'user_manager' => 'User manager', //cpg1.4
  'title' => 'Manage users',
  'name_a' => 'Name ascending',
  'name_d' => 'Name descending',
  'group_a' => 'Group ascending',
  'group_d' => 'Group descending',
  'reg_a' => 'Reg date ascending',
  'reg_d' => 'Reg date descending',
  'pic_a' => 'File count ascending',
  'pic_d' => 'File count descending',
  'disku_a' => 'Disk usage ascending',
  'disku_d' => 'Disk usage descending',
  'lv_a' => 'Last visit ascending',
  'lv_d' => 'Last visit descending',
  'sort_by' => 'Sort users by',
  'err_no_users' => 'User table is empty !',
  'err_edit_self' => 'You can\'t edit your own profile, use the \'My profile\' link for that',
  'edit' => 'Edit', //cpg1.4
  'with_selected' => 'With selected:', //cpg1.4
  'delete' => 'Delete', //cpg1.4
  'delete_files_no' => 'keep public files (but anonymize)', //cpg1.4
  'delete_files_yes' => 'delete public files as well', //cpg1.4
  'delete_comments_no' => 'keep comments (but anonymize)', //cpg1.4
  'delete_comments_yes' => 'delete comments as well', //cpg1.4
  'activate' => 'Activate', //cpg1.4
  'deactivate' => 'Deactivate', //cpg1.4
  'reset_password' => 'Reset Password', //cpg1.4
  'change_primary_membergroup' => 'Change primary membergroup', //cpg1.4
  'add_secondary_membergroup' => 'Add secondary membergroup', //cpg1.4
  'name' => 'User name',
  'group' => 'Group',
  'inactive' => 'Inactive',
  'operations' => 'Operations',
  'pictures' => 'Files',
  'disk_space_used' => 'Искористен простор', //cpg1.4
  'disk_space_quota' => 'Space Quota', //cpg1.4
  'registered_on' => 'Регистриран', //cpg1.4
  'last_visit' => 'Last Visit',
  'u_user_on_p_pages' => '%d users on %d page(s)',
  'confirm_del' => 'Are you sure you want to DELETE this user ? \\nAll his files and albums will also be deleted.', //js-alert
  'mail' => 'MAIL',
  'err_unknown_user' => 'Selected user does not exist !',
  'modify_user' => 'Modify user',
  'notes' => 'Notes',
  'note_list' => '<li>If you don\'t want to change the current password, leave the "password" field blank',
  'password' => 'Password',
  'user_active' => 'User is active',
  'user_group' => 'User group',
  'user_email' => 'User email',
  'user_web_site' => 'User web site',
  'create_new_user' => 'Create new user',
  'user_location' => 'User location',
  'user_interests' => 'User interests',
  'user_occupation' => 'User occupation',
  'user_profile1' => '$user_profile1', //cpg1.4
  'user_profile2' => '$user_profile2', //cpg1.4
  'user_profile3' => '$user_profile3', //cpg1.4
  'user_profile4' => '$user_profile4', //cpg1.4
  'user_profile5' => '$user_profile5', //cpg1.4
  'user_profile6' => '$user_profile6', //cpg1.4
  'latest_upload' => 'Recent uploads',
  'never' => 'никогаш',
  'search' => 'Барај член', //cpg1.4
  'submit' => 'Испрати', //cpg1.4
  'search_submit' => 'Оди!', //cpg1.4
  'search_result' => 'Резултати за: ', //cpg1.4
  'alert_no_selection' => 'You have to select at least one user first!', //cpg1.4 //js-alert
  'password' => 'Лозинка', //cpg1.4
  'select_group' => 'Одбери група', //cpg1.4
  'groups_alb_access' => 'Album permissions by group', //cpg1.4
  'album' => 'Album', //cpg1.4
  'category' => 'Категорија', //cpg1.4
  'modify' => 'Modify?', //cpg1.4
  'group_no_access' => 'This group has no special access', //cpg1.4
  'notice' => 'Notice', //cpg1.4
  'group_can_access' => 'Album(s) that only "%s" can access', //cpg1.4
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) {
$lang_util_desc_php = array(
'Updates titles from filename', //cpg1.4
'Deletes titles', //cpg1.4
'Rebuilds thumbnails and resized photos', //cpg1.4
'Deletes original sized photos replacing them with the resized version', //cpg1.4
'Deletes original or intermediate size photos to free webspace', //cpg1.4
'Deletes orphaned comments', //cpg1.4
'Re-reads file sizes and dimensions (if you manually edited pics)', //cpg1.4
'Resets views counter', //cpg1.4
'Displays phpinfo', //cpg1.4
'Updates the database', //cpg1.4
'Displays log files', //cpg1.4
);
$lang_util_php = array(
  'title' => 'Admin utilities (Resize pictures)',
  'what_it_does' => 'What it does',
  'file' => 'File',
  'problem' => 'Problem', //cpg1.4
  'status' => 'Status', //cpg1.4
  'title_set_to' => 'title set to',
  'submit_form' => 'submit',
  'updated_succesfully' => 'updated succesfully',
  'error_create' => 'ERROR creating',
  'continue' => 'Process more images',
  'main_success' => 'The file %s was successfully used as main file',
  'error_rename' => 'Error renaming %s to %s',
  'error_not_found' => 'The file %s was not found',
  'back' => 'back to main',
  'thumbs_wait' => 'Updating thumbnails and/or resized images, please wait...',
  'thumbs_continue_wait' => 'Continuing to update thumbnails and/or resized images...',
  'titles_wait' => 'Updating titles, please wait...',
  'delete_wait' => 'Deleting titles, please wait...',
  'replace_wait' => 'Deleting originals and replacing them with resized images, please wait..',
  'instruction' => 'Quick instructions',
  'instruction_action' => 'Select action',
  'instruction_parameter' => 'Set parameters',
  'instruction_album' => 'Select album',
  'instruction_press' => 'Press %s',
  'update' => 'Update thumbs and/or resized photos',
  'update_what' => 'What should be updated',
  'update_thumb' => 'Only thumbnails',
  'update_pic' => 'Only resized pictures',
  'update_both' => 'Both thumbnails and resized pictures',
  'update_number' => 'Number of processed images per click',
  'update_option' => '(Try setting this option lower if you experience timeout problems)',
  'filename_title' => 'Filename &rArr; File title',
  'filename_how' => 'How should the filename be modified',
  'filename_remove' => 'Remove the .jpg ending and replace _ (underscore) with spaces',
  'filename_euro' => 'Change 2003_11_23_13_20_20.jpg to 23/11/2003 13:20',
  'filename_us' => 'Change 2003_11_23_13_20_20.jpg to 11/23/2003 13:20',
  'filename_time' => 'Change 2003_11_23_13_20_20.jpg to 13:20',
  'delete' => 'Delete file titles or original size photos',
  'delete_title' => 'Delete file titles',
  'delete_title_explanation' => 'This will remove all titles on files in the album you specify.', //cpg1.4
  'delete_original' => 'Delete original size photos',
  'delete_original_explanation' => 'This will remove the full sized pictures.', //cpg1.4
  'delete_intermediate' => 'Delete intermediate pictures', //cpg1.4
  'delete_intermediate_explanation' => 'This will delete intermediate (normal) pictures.<br />Use this to free up disk space if you have disabled \'Create intermediate pictures\' in config after adding pictures.', //cpg1.4
  'delete_replace' => 'Deletes the original images replacing them with the sized versions',
  'titles_deleted' => 'All titles in specified album removed', //cpg1.4
  'deleting_intermediates' => 'Deleting intermediate images, please wait...', //cpg1.4
  'searching_orphans' => 'Searching for orphans, please wait...', //cpg1.4
  'select_album' => 'Select album',
  'delete_orphans' => 'Delete comments on missing files', //cpg1.4
  'delete_orphans_explanation' => 'This will identify and allow you to delete any comments associated with files no longer in the gallery.<br />Checks all albums.', //cpg1.4
  'refresh_db' => 'Reload file dimensions and size information', //cpg1.4
  'refresh_db_explanation' => 'This will re-read file sizes and dimensions. Use this if quota\'s are incorrect or you have changed the files manually.', //cpg1.4
  'reset_views' => 'Reset view counters', //cpg1.4
  'reset_views_explanation' => 'Sets all file view counts to zero in the album specified.', //cpg1.4
  'orphan_comment' => 'orphan comments found',
  'delete' => 'Delete',
  'delete_all' => 'Delete all',
  'delete_all_orphans' => 'Delete all orphans?', //cpg1.4
  'comment' => 'Comment: ',
  'nonexist' => 'attached to non existant file # ',
  'phpinfo' => 'Display phpinfo',
  'phpinfo_explanation' => 'Contains technical information about your server.<br /> - You may be asked to provide information from this when requesting support.', //cpg1.4
  'update_db' => 'Update database',
  'update_db_explanation' => 'If you have replaced coppermine files, added a modification or upgraded from a previous version of coppermine, make sure to run the database update once. This will create the necessary tables and/or config values in your coppermine database.',
  'view_log' => 'View log files', //cpg1.4
  'view_log_explanation' => 'Coppermine can keep track of various actions users perform. You can browse those logs if you have enabled logging in <a href="admin.php">coppermine config</a>.', //cpg1.4
  'versioncheck' => 'Check versions', //cpg1.4
  'versioncheck_explanation' => 'Check your file versions to find out if you have replaced all files after an upgrade, or if coppermine source files have been updated after the release of a package.', //cpg1.4
  'bridgemanager' => 'Bridge Manager', //cpg1.4
  'bridgemanager_explanation' => 'Enable/disable integration (bridging) of Coppermine with another application (e.g. your BBS).', //cpg1.4
);
}

// ------------------------------------------------------------------------- //
// File versioncheck.php //cpg1.4
// ------------------------------------------------------------------------- //

if (defined('VERSIONCHECK_PHP')) $lang_versioncheck_php = array(
  'title' => 'Versioncheck', //cpg1.4
  'what_it_does' => 'This page is meant for users who have updated their coppermine install. This script goes through the files on your webserver and tries to determine if your local file versions on the webserver are the same as the ones from the repository at http://coppermine.sourceforge.net, this way displaying the files you were meant to update as well.<br />It will show everything in red that needs to be fixed. Entries in yellow need looking into. Entries in green (or your default font color) are OK.<br />Click on the help icons to find out more.', //cpg1.4
  'online_repository_unable' => 'Unable to connect to online repository', //cpg1.4
  'online_repository_noconnect' => 'Coppermine was unable to connect to the online repository. This can have two reasons:', //cpg1.4
  'online_repository_reason1' => 'the coppermine online repository is currently down - check if you can browse this page: %s - if you can\'t access this page, try again later.', //cpg1.4
  'online_repository_reason2' => 'PHP on your webserver is configured with %s turned off (by default, it\'s turned on). If the server is yours to administer, turn this option on in <i>php.ini</i> (at least allow it to be overridden with %s). If you\'re webhosted, you will probably have to live with the fact that you can\'t compare your files to the online repository. This page will then only display the file versions that came with your distribution - updates will not be displayed.', //cpg1.4
  'online_repository_skipped' => 'Connection to online repository skipped', //cpg1.4
  'online_repository_to_local' => 'The script is defaulting to the local copy of the version-files now. The data may be inacurate if you have upgraded Coppermine and you haven\'t uploaded all files. Changes to the files after the release won\'t be taken into account as well.', //cpg1.4
  'local_repository_unable' => 'Unable to connect to the repository on your server', //cpg1.4
  'local_repository_explanation' => 'Coppermine was unable to connect to the repository file %s on your webserver. This probably means that you haven\'t uploaded the repository file to your webserver. Do so now and then try to run this page once more (hit refresh).<br />If the script still fails, your webhost might have disabled parts of <a href="http://www.php.net/manual/en/ref.filesystem.php">PHP\'s filesystem functions</a> completely. In this case, you simply won\'t be able to use this tool at all, sorry.', //cpg1.4
  'coppermine_version_header' => 'Installed Coppermine version', //cpg1.4
  'coppermine_version_info' => 'You have currently installed: %s', //cpg1.4
  'coppermine_version_explanation' => 'If you think this is entirely wrong and you\'re supposed to be running a higher version of Coppermine, you probably haven\'t uploaded the most recent version of the file <i>include/init.inc.php</i>', //cpg1.4
  'version_comparison' => 'Version comparison', //cpg1.4
  'folder_file' => 'folder/file', //cpg1.4
  'coppermine_version' => 'cpg version', //cpg1.4
  'file_version' => 'file version', //cpg1.4
  'webcvs' => 'web svn', //cpg1.4
  'writable' => 'writable', //cpg1.4
  'not_writable' => 'not writable', //cpg1.4
  'help' => 'Help', //cpg1.4
  'help_file_not_exist_optional1' => 'file/folder does not exist', //cpg1.4
  'help_file_not_exist_optional2' => 'The file/folder %s has not been found on your server. Although it is optional you should upload it (using your FTP client) to your webserver if you are experiencing problems.', //cpg1.4
  'help_file_not_exist_mandatory1' => 'file/folder does not exist', //cpg1.4
  'help_file_not_exist_mandatory2' => 'The file/folder %s has not been found on your server, although it is mandatory. Upload the file to your webserver (using your FTP client).', //cpg1.4
  'help_no_local_version1' => 'No local file version', //cpg1.4
  'help_no_local_version2' => 'The script was unable to extract a local file version - your file is either outdated or you have modified it, removing the header information on the way. Updating the file is recommended.', //cpg1.4
  'help_local_version_outdated1' => 'Local version outdated', //cpg1.4
  'help_local_version_outdated2' => 'Your version of this file seems to be from an older version of Coppermine (you probably upgraded). Make sure to update this file as well.', //cpg1.4
  'help_local_version_na1' => 'Unable to extract subversion version info', //cpg1.4
  'help_local_version_na2' => 'The script could not determine what subversion (SVN) version the file on your webserver is. You should upload the file from your package.', //cpg1.4
  'help_local_version_dev1' => 'Development version', //cpg1.4
  'help_local_version_dev2' => 'The file on your webserver seems to be newer than your Coppermine version. You are either using a development file (you should only do so if you know what you are doing), or you have upgraded your Coppermine install and not uploaded include/init.inc.php', //cpg1.4
  'help_not_writable1' => 'Folder not writable', //cpg1.4
  'help_not_writable2' => 'Change file permissions (CHMOD) to grant the script write access to the folder %s and everything within it.', //cpg1.4
  'help_writable1' => 'Folder writable', //cpg1.4
  'help_writable2' => 'The folder %s is writable. This is an unnecessary risk, coppermine only needs read/execute access.', //cpg1.4
  'help_writable_undetermined' => 'Coppermine was not able to determine wether the folder is writable.', //cpg1.4
  'your_file' => 'your file', //cpg1.4
  'reference_file' => 'reference file', //cpg1.4
  'summary' => 'Summary', //cpg1.4
  'total' => 'Total files/folders checked', //cpg1.4
  'mandatory_files_missing' => 'Mandatory files missing', //cpg1.4
  'optional_files_missing' => 'Optional files missing', //cpg1.4
  'files_from_older_version' => 'Files left over from outdated Coppermine version', //cpg1.4
  'file_version_outdated' => 'Outdated file versions', //cpg1.4
  'error_no_data' => 'The script made a boo, it was not able to retrieve any information. Sorry for the inconvenience.', //cpg1.4
  'go_to_webcvs' => 'go to %s', //cpg1.4
  'options' => 'Options', //cpg1.4
  'show_optional_files' => 'show optional folders/files', //cpg1.4
  'show_mandatory_files' => 'show mandatory files', //cpg1.4
  'show_file_versions' => 'show file versions', //cpg1.4
  'show_errors_only' => 'show folders/files with errors only', //cpg1.4
  'show_permissions' => 'show folder permissions', //cpg1.4
  'show_condensed_output' => 'show condensed ouput (for easier screenshots)', //cpg1.4
  'coppermine_in_webroot' => 'coppermine is installed in the webroot', //cpg1.4
  'connect_online_repository' => 'try connecting to the online repository', //cpg1.4
  'show_additional_information' => 'show additional information', //cpg1.4
  'no_webcvs_link' => 'don\'t display web svn link', //cpg1.4
  'stable_webcvs_link' => 'display web svn link to stable branch', //cpg1.4
  'devel_webcvs_link' => 'display web svn link to devel branch', //cpg1.4
  'submit' => 'apply changes / refresh', //cpg1.4
  'reset_to_defaults' => 'reset to default values', //cpg1.4
);

// ------------------------------------------------------------------------- //
// File view_log.php  //cpg1.4
// ------------------------------------------------------------------------- //

if (defined('VIEWLOG_PHP')) $lang_viewlog_php = array(
  'delete_all' => 'Delete All Logs', //cpg1.4
  'delete_this' => 'Delete This Log', //cpg1.4
  'view_logs' => 'View Logs', //cpg1.4
  'no_logs' => 'No logs created.', //cpg1.4
);


// ------------------------------------------------------------------------- //
// File xp_publish.php //cpg1.4
// ------------------------------------------------------------------------- //

if (defined('XP_PUBLISH_PHP')) {

$lang_xp_publish_client = <<<EOT
<h1>XP Web Publishing Wizard Client</h1><p>This module allows to use <b>Windows XP</b> web publishing wizard with Coppermine.</p><p>Code is based on article posted by
EOT;

$lang_xp_publish_required = <<<EOT
<h2>What is required</h2><ul><li>Windows XP in order to have the wizard.</li><li>A working installation of Coppermine on which <b>the web upload function works properly.</b></li></ul><h2>How to install on client side</h2><ul><li>Right click on
EOT;

$lang_xp_publish_select = <<<EOT
Select &quot;save target as..&quot;. Save the file on your hard drive. When saving the file, check that the proposed file name is <b>cpg_###.reg</b> (the ### represents a numerical timestamp). Change it to that name if necessary (leave the numbers). When downloaded, double click on the file in order to register your server with the web publishing wizard.</li></ul>
EOT;

$lang_xp_publish_testing = <<<EOT
<h2>Testing</h2><ul><li>In Windows Explorer, select some files and click on <b>Publish xxx on the web</b> in the left pane.</li><li>Confirm your file selection. Click on <b>Next</b>.</li><li>In the list of services that appear, select the one for your photo gallery (it has the name of your gallery). If the service does not appear, check that you have installed <b>cpg_pub_wizard.reg</b> as described above.</li><li>Input your login information if required.</li><li>Select the target album for your pictures or create a new one.</li><li>Click on <b>next</b>. The upload of your pictures starts.</li><li>When it is completed, check your gallery to see if pictures have been properly added.</li></ul>
EOT;

$lang_xp_publish_notes = <<<EOT
<h2>Notes :</h2><ul><li>Once the upload has started, the wizard can't display any error message returned by the script so you can't know if the upload failed or succeeded until you check your gallery.</li><li>If the upload fails, enable &quot;Debug mode&quot; on the Coppermine admin page, try with one single picture and check error messages in the
EOT;

$lang_xp_publish_flood = <<<EOT
file that is located in Coppermine directory on your server.</li><li>In order to avoid that the gallery be <i>flooded</i> by pictures uploaded through the wizard, only the <b>gallery admins</b> and <b>users that can have their own albums</b> can use this feature.</li>
EOT;



$lang_xp_publish_php = array(
  'title' => 'Coppermine - XP Web Publishing Wizard', //cpg1.4
  'welcome' => 'Добредојде <b>%s</b>,', //cpg1.4
  'need_login' => 'Мора да се логирате во галеријата пред да може да го користите овој визард.<p/><p>Кога ќе се логирате не заборавете да ја селектирате <b>Запамти ме</b> oпцијата ако е поставена.', //cpg1.4
  'no_alb' => 'Се извинуваме но нема албум каде што ви е дозволено поставување на слики преку овој визард.', //cpg1.4
  'upload' => 'Поставете ги сликите во постоечкиот албум', //cpg1.4
  'create_new' => 'Креирајте нов Албум за вашите слики', //cpg1.4
  'album' => 'Албум', //cpg1.4
  'category' => 'Категорија', //cpg1.4
  'new_alb_created' => 'Вашиот нов албум  &quot;<b>%s</b>&quot; беше создаден.', //cpg1.4
  'continue' => 'Стисни &quot;Следно&quot; да започнеш со поставување на твојата слика', //cpg1.4
  'link' => 'овој линк', //cpg1.4
);
}
?>
