<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery                                                 //
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

$lang_charset = 'windows-1251';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('&aacute;&agrave;&eacute;&ograve;', 'K&aacute;', 'M&aacute;');

// Day of weeks and months
$lang_day_of_week = array('&Iacute;�&auml;', '�&icirc;&iacute;', '&Acirc;&ograve;&icirc;', '���', '��&ograve;', '��&ograve;', '�&uacute;&aacute;');
$lang_month = array('&szlig;&iacute;&oacute;', '&Ocirc;�&acirc;', '&Igrave;&agrave;�', '&Agrave;��', '&Igrave;&agrave;&eacute;', '�&iacute;&egrave;', '��&egrave;', '&Agrave;&acirc;�', '���', '&Icirc;&ecirc;&ograve;', '&Iacute;&icirc;�', '&Auml;�&ecirc;');

// Some common strings
$lang_yes = '&Auml;&agrave;';
$lang_no  = '&Iacute;�';
$lang_back = '&Iacute;&Agrave;�&Agrave;&Auml;';
$lang_continue = '��&icirc;&auml;&uacute;��&egrave;';
$lang_info = '&Egrave;&iacute;&ocirc;&icirc;�&igrave;&agrave;&ouml;&egrave;�';
$lang_error = '����&ecirc;&agrave;';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%m/%d/%y &acirc; %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y &acirc; %I:%M %p';
$comment_date_fmt =  '%B %d, %Y &acirc; %I:%M %p';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
	'random' => '��&oacute;�&agrave;&eacute;&iacute;&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	'lastup' => '�&icirc;���&auml;&iacute;&icirc; &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;&egrave;',
	'lastcom' => '�&icirc;���&auml;&iacute;&egrave; &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&egrave;',
	'topn' => '&Iacute;&agrave;&eacute; ���&auml;&agrave;&iacute;&egrave;',
	'toprated' => '&Iacute;&agrave;&eacute; &icirc;&ouml;�&iacute;�&iacute;&egrave;',
	'lasthits' => '�&icirc;���&auml;&iacute;&icirc; &acirc;&egrave;&auml;�&iacute;&egrave;',
	'search' => '���&oacute;�&ograve;&agrave;&ograve;&egrave; &icirc;&ograve; &ograve;&uacute;���&iacute;�'
);

$lang_errors = array(
	'access_denied' => '&Acirc;&egrave;� &iacute;�&igrave;&agrave;&ograve;� ��&agrave;&acirc;&agrave; �&agrave; &auml;&icirc;�&ograve;&uacute;� &auml;&icirc; &ograve;&agrave;�&egrave; �&ograve;�&agrave;&iacute;&egrave;&ouml;&agrave;.',
	'perm_denied' => '&Acirc;&egrave;� &iacute;�&igrave;&agrave;&ograve;� ��&agrave;&acirc;&agrave; �&agrave; &auml;&agrave; &egrave;��&uacute;�&iacute;&egrave;&ograve;� &ograve;&agrave;�&egrave; &icirc;���&agrave;&ouml;&egrave;�.',
	'param_missing' => '�&ecirc;�&egrave;�&ograve;&agrave; � &egrave;�&acirc;&egrave;&ecirc;&agrave;&iacute; &aacute;�� &iacute;�&icirc;&aacute;�&icirc;&auml;&egrave;&igrave;&egrave;&ograve;� �&agrave;�&agrave;&igrave;�&ograve;�&egrave;.',
	'non_exist_ap' => '&Egrave;�&aacute;�&agrave;&iacute;&egrave;�&ograve; &agrave;�&aacute;&oacute;&igrave;/&ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; &iacute;� �&uacute;&ugrave;��&ograve;&acirc;&oacute;&acirc;&agrave; !',
	'quota_exceeded' => '�&egrave;&igrave;&egrave;&ograve;&agrave; �&agrave; &igrave;��&ograve;&icirc; � ���&acirc;&egrave;��&iacute;<br /><br />&Acirc;&egrave;� &egrave;&igrave;&agrave;&ograve;� &icirc;&ograve;&auml;���&iacute;&icirc; &igrave;��&ograve;&icirc; &icirc;&ograve; [quota]K, &Acirc;&agrave;�&egrave;&ograve;� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; �&agrave;�&igrave;&agrave;&ograve; [space]K, &agrave; &auml;&icirc;&aacute;&agrave;&acirc;�&eacute;&ecirc;&egrave; &ograve;&agrave;�&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; &ugrave;� ���&acirc;&egrave;�&egrave; �&egrave;&igrave;&egrave;&ograve;&agrave;.',
	'gd_file_type_err' => '&Ecirc;&icirc;�&agrave;&ograve;&icirc; �� &egrave;��&icirc;��&acirc;&agrave; GD &aacute;&egrave;&aacute;�&egrave;&icirc;&ograve;�&ecirc;&agrave;&ograve;&agrave; �&agrave;�����&iacute;&egrave;&ograve;� &acirc;&egrave;&auml;&icirc;&acirc;� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; �&agrave; �&agrave;&igrave;&icirc; JPEG &egrave; PNG.',
	'invalid_image' => '&Ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;&ograve;&agrave; &ecirc;&icirc;�&ograve;&icirc; �&ograve;� &ecirc;&agrave;�&egrave;�&egrave; � �&icirc;&acirc;��&auml;�&iacute;&agrave; &egrave; &iacute;� &igrave;&icirc;�� &auml;&agrave; �� &icirc;&aacute;�&agrave;&aacute;&icirc;&ograve;&egrave;',
	'resize_failed' => '&Iacute;� &igrave;&icirc;�� &auml;&agrave; �� �&uacute;�&auml;&agrave;&auml;� &igrave;&agrave;�&ecirc;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;.',
	'no_img_to_display' => '&Iacute;�&igrave;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; �&agrave; �&icirc;&ecirc;&agrave;�&acirc;&agrave;&iacute;�',
	'non_exist_cat' => '&Egrave;�&aacute;�&agrave;&iacute;&agrave;&ograve;&agrave; &ecirc;&agrave;&ograve;��&icirc;�&egrave;� &iacute;� �&uacute;&ugrave;��&ograve;&acirc;&oacute;&acirc;&agrave;',
	'orphan_cat' => '&Ecirc;&agrave;&ograve;��&icirc;�&egrave;�&ograve;&agrave; &egrave;&igrave;&agrave; &iacute;��&uacute;&ugrave;��&ograve;&acirc;&oacute;&acirc;&agrave;&ugrave; �&icirc;&auml;&egrave;&ograve;��, �&ograve;&agrave;�&ograve;&egrave;�&agrave;&eacute;&ograve;� &igrave;�&iacute;&agrave;���&agrave; &iacute;&agrave; &ecirc;&agrave;&ograve;��&icirc;�&egrave;&egrave; �&agrave; &auml;&agrave; &ecirc;&icirc;�&egrave;�&egrave;�&agrave;&ograve;� ��&icirc;&aacute;��&igrave;&agrave;.',
	'directory_ro' => '&Acirc; &auml;&egrave;��&ecirc;&ograve;&icirc;�&egrave;� \'%s\' &iacute;� &igrave;&icirc;�� &auml;&agrave; �� �&agrave;�&egrave;�&acirc;&agrave;, &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;&ograve;&agrave; &iacute;� &igrave;&icirc;�� &auml;&agrave; �� &egrave;�&ograve;�&egrave;�',
	'non_exist_comment' => '&Egrave;�&aacute;�&agrave;&iacute;&egrave;� &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;� &iacute;� �&uacute;&ugrave;��&ograve;&acirc;&oacute;&acirc;&agrave;.',
	'pic_in_invalid_album' => '&Ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;&ograve;&agrave; &iacute;� �&uacute;&ugrave;��&ograve;&acirc;&oacute;&acirc;&agrave; &acirc; &agrave;�&aacute;&oacute;&igrave; (%s)!?'
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => '&Acirc;&egrave;� ��&egrave;�&uacute;&ecirc;&agrave; &iacute;&agrave; &agrave;�&aacute;&oacute;&igrave;&egrave;&ograve;�',
	'alb_list_lnk' => '��&egrave;�&uacute;&ecirc; &iacute;&agrave; &agrave;�&aacute;&oacute;&igrave;&egrave;&ograve;�',
	'my_gal_title' => '&Icirc;&ograve;&egrave;&auml;&egrave; &acirc; �&egrave;�&iacute;&agrave;&ograve;&agrave; �&agrave;���&egrave;�',
	'my_gal_lnk' => '�&egrave;�&iacute;&agrave; �&agrave;���&egrave;�',
	'my_prof_lnk' => '&Igrave;&icirc;� ��&icirc;&ocirc;&egrave;�',
	'adm_mode_title' => '���&igrave;&egrave;&iacute;&egrave; &acirc; &agrave;&auml;&igrave;&egrave;&iacute;&egrave;�&ograve;�&agrave;&ograve;&egrave;&acirc;�&iacute; ���&egrave;&igrave;',
	'adm_mode_lnk' => '&Agrave;&auml;&igrave;&egrave;&iacute;&egrave;�&ograve;�&agrave;&ograve;&egrave;&acirc;�&iacute; ���&egrave;&igrave;',
	'usr_mode_title' => '���&igrave;&egrave;&iacute;&egrave; &acirc; �&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&egrave; ���&egrave;&igrave;',
	'usr_mode_lnk' => '�&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&egrave; ���&egrave;&igrave;',
	'upload_pic_title' => '&Auml;&icirc;&aacute;&agrave;&acirc;&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; &acirc; &agrave;�&aacute;&oacute;&igrave;',
	'upload_pic_lnk' => '&Auml;&icirc;&aacute;&agrave;&acirc;&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;',
	'register_title' => '�&uacute;�&auml;&agrave;&eacute; &iacute;&icirc;&acirc; �&icirc;&ograve;��&aacute;&egrave;&ograve;��',
	'register_lnk' => '���&egrave;�&ograve;�&egrave;�&agrave;&eacute; ��',
	'login_lnk' => '&Acirc;�&icirc;&auml;',
	'logout_lnk' => '&Egrave;��&icirc;&auml;',
	'lastup_lnk' => '�&icirc;���&auml;&iacute;&icirc; &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;&egrave;',
	'lastcom_lnk' => '�&icirc;���&auml;&iacute;&egrave; &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&egrave;',
	'topn_lnk' => '&Iacute;&agrave;&eacute; ���&auml;&agrave;&iacute;&egrave;',
	'toprated_lnk' => '&Iacute;&agrave;&eacute; &icirc;&ouml;�&iacute;�&iacute;&egrave;',
	'search_lnk' => '&Ograve;&uacute;���&iacute;�',
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => '&Icirc;&auml;&icirc;&aacute;��&iacute;&egrave;� &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	'config_lnk' => '&Ecirc;&icirc;&iacute;&ocirc;&egrave;�&oacute;�&agrave;&ouml;&egrave;�',
	'albums_lnk' => '&Agrave;�&aacute;&oacute;&igrave;&egrave;',
	'categories_lnk' => '&Ecirc;&agrave;&ograve;��&icirc;�&egrave;&egrave;',
	'users_lnk' => '�&icirc;&ograve;��&aacute;&egrave;&ograve;��&egrave;',
	'groups_lnk' => '��&oacute;�&egrave;',
	'comments_lnk' => '&Ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&egrave;',
	'searchnew_lnk' => '�&agrave;&ecirc;�&ograve;&iacute;&icirc; &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;� &iacute;&agrave; �&iacute;&egrave;&igrave;&ecirc;&egrave;',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => '�&uacute;�&auml;&agrave;&eacute;/�&icirc;&auml;��&auml;&egrave; &igrave;&icirc;&egrave;&ograve;� &agrave;�&aacute;&oacute;&igrave;&egrave;',
	'modifyalb_lnk' => '��&icirc;&igrave;�&iacute;&egrave; &igrave;&icirc;&egrave;&ograve;� &agrave;�&aacute;&oacute;&igrave;&egrave;',
	'my_prof_lnk' => '&Igrave;&icirc;� ��&icirc;&ocirc;&egrave;�',
);

$lang_cat_list = array(
	'category' => '&Ecirc;&agrave;&ograve;��&icirc;�&egrave;�',
	'albums' => '&Agrave;�&aacute;&oacute;&igrave;&egrave;',
	'pictures' => '&Ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
);

$lang_album_list = array(
	'album_on_page' => '%d &agrave;�&aacute;&oacute;&igrave;&egrave; &iacute;&agrave; %d �&ograve;&agrave;&iacute;&egrave;&ouml;&agrave;(&egrave;)'
);

$lang_thumb_view = array(
	'date' => '&Auml;&Agrave;&Ograve;&Agrave;',
	'name' => '&Egrave;&Igrave;�',
	'sort_da' => '�&icirc;�&ograve;. �&icirc; &auml;&agrave;&ograve;&agrave; &acirc;&uacute;��&icirc;&auml;�&ugrave;&icirc;',
	'sort_dd' => '�&icirc;�&ograve;. �&icirc; &auml;&agrave;&ograve;&agrave; &iacute;&egrave;��&icirc;&auml;�&ugrave;&icirc;',
	'sort_na' => '�&icirc;�&ograve;. �&icirc; &egrave;&igrave;� &acirc;&uacute;��&icirc;&auml;�&ugrave;&icirc;',
	'sort_nd' => '�&icirc;�&ograve;. �&icirc; &auml;&agrave;&ograve;&agrave; &iacute;&egrave;��&icirc;&auml;�&ugrave;&icirc;',
	'pic_on_page' => '%d &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; &iacute;&agrave; %d �&ograve;�&agrave;&iacute;&egrave;&ouml;&agrave;(&egrave;)',
	'user_on_page' => '%d �&icirc;&ograve;��&aacute;&egrave;&ograve;��&egrave; &iacute;&agrave; %d �&ograve;�&agrave;&iacute;&egrave;&ouml;&agrave;(&egrave;)'
);

$lang_img_nav_bar = array(
	'thumb_title' => '&Acirc;&uacute;�&iacute;&egrave; �� &iacute;&agrave; �&ograve;�&agrave;&iacute;&egrave;&ouml;&agrave;&ograve;&agrave; � &igrave;&agrave;�&ecirc;&egrave;&ograve;� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	'pic_info_title' => '�&icirc;&ecirc;&agrave;�&egrave;/�&ecirc;�&egrave;&eacute; &egrave;&iacute;&ocirc;&icirc;�&igrave;&agrave;&ouml;&egrave;� �&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;&ograve;&agrave;',
	'slideshow_title' => '��&agrave;&eacute;&auml; �&icirc;&oacute;',
	'ecard_title' => '&Egrave;���&agrave;&ograve;&egrave; &ograve;&agrave;�&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; &ecirc;&agrave;&ograve;&icirc; �-&ecirc;&agrave;�&ograve;&egrave;�&ecirc;&agrave;',
	'ecard_disabled' => '�-&ecirc;&agrave;�&ograve;&egrave;�&ecirc;&egrave; �&agrave; &egrave;�&ecirc;����&iacute;&egrave;',
	'ecard_disabled_msg' => '&Iacute;�&igrave;&agrave;� ��&agrave;&acirc;&agrave; &auml;&agrave; &egrave;���&agrave;&ugrave;&agrave;� �-&ecirc;&agrave;�&ograve;&egrave;�&ecirc;&egrave;',
	'prev_title' => '&Acirc;&egrave;� ���&auml;&egrave;�&iacute;&agrave;&ograve;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;',
	'next_title' => '&Acirc;&egrave;� ���&auml;&acirc;&agrave;&ugrave;&agrave;&ograve;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;',
	'pic_pos' => '&Ecirc;&Agrave;�&Ograve;&Egrave;&Iacute;&Ecirc;&Agrave; %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => '&Icirc;&ouml;�&iacute;&egrave; &ograve;&agrave;�&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; ',
	'no_votes' => '(&iacute;�&igrave;&agrave; ��&agrave;�&oacute;&acirc;&agrave;&iacute;�)',
	'rating' => '(&ograve;�&ecirc;&oacute;&ugrave;&agrave; &icirc;&ouml;�&iacute;&ecirc;&agrave; : %s / 5 �&uacute;� %s ��&agrave;�&icirc;&acirc;�)',
	'rubbish' => '&Iacute;&egrave;&ecirc;&agrave;&ecirc;',
	'poor' => '&Igrave;&iacute;&icirc;�&icirc; �&icirc;�&agrave;',
	'fair' => '�&icirc;�&agrave;',
	'good' => '���&auml;&iacute;&agrave;',
	'excellent' => '&Auml;&icirc;&aacute;�&agrave;',
	'great' => '&Igrave;&iacute;&icirc;�&icirc; &auml;&icirc;&aacute;�&agrave;',
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
	CRITICAL_ERROR => '&Ecirc;�&egrave;&ograve;&egrave;�&iacute;&agrave; ����&ecirc;&agrave;',
	'file' => '&Ocirc;&agrave;&eacute;�: ',
	'line' => '�&egrave;&iacute;&egrave;�: ',
);

$lang_display_thumbnails = array(
	'filename' => '&Ocirc;&agrave;&eacute;� : ',
	'filesize' => '�&icirc;��&igrave;&egrave;&iacute;&agrave; : ',
	'dimensions' => '�&agrave;�&igrave;�� : ',
	'date_added' => '&Auml;&icirc;&aacute;&agrave;&acirc;�&iacute; &iacute;&agrave; : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&agrave;',
	'n_views' => '%s ������&auml;&agrave;',
	'n_votes' => '(%s ��&agrave;�&icirc;&acirc;�)'
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
	0 => '&Egrave;��&icirc;&auml; &icirc;&ograve; &agrave;&auml;&igrave;&egrave;&iacute;&egrave;�&ograve;�&agrave;&ograve;&egrave;&acirc;�&iacute; ���&egrave;&igrave;...',
	1 => '&Acirc;�&icirc;&auml; &agrave;&auml;&igrave;&egrave;&iacute;&egrave;�&ograve;�&agrave;&ograve;&egrave;&acirc;�&iacute; ���&egrave;&igrave;...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => '&Agrave;�&aacute;&oacute;&igrave;&agrave; &ograve;��&aacute;&acirc;&agrave; &auml;&agrave; &egrave;&igrave;&agrave; &egrave;&igrave;� !',
	'confirm_modifs' => '�&egrave;�&oacute;��&iacute; �&egrave; �&egrave;, �� &egrave;�&ecirc;&agrave;� &auml;&agrave; &iacute;&agrave;��&agrave;&acirc;&egrave;� &ograve;��&egrave; ��&icirc;&igrave;�&iacute;&egrave; ?',
	'no_change' => '&Iacute;� �&egrave; &iacute;&agrave;��&agrave;&acirc;&egrave;� &iacute;&egrave;&ecirc;&agrave;&ecirc;&acirc;&agrave; ��&icirc;&igrave;�&iacute;&agrave; !',
	'new_album' => '&Iacute;&icirc;&acirc; &agrave;�&aacute;&oacute;&igrave;',
	'confirm_delete1' => '�&egrave;�&oacute;��&iacute; �&egrave; �&egrave;, �� &egrave;�&ecirc;&agrave;� &auml;&agrave; &egrave;�&ograve;�&egrave;�� &ograve;&icirc;�&egrave; &agrave;�&aacute;&oacute;&igrave; ?',
	'confirm_delete2' => '\n&Acirc;�&egrave;�&ecirc;&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; &egrave; &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&egrave; &ecirc;&icirc;&egrave;&ograve;&icirc; �&uacute;&auml;&uacute;��&agrave;, &ugrave;� &aacute;&uacute;&auml;&agrave;&ograve; &egrave;�&ograve;�&egrave;&ograve;&egrave; !',
	'select_first' => '&Egrave;�&aacute;��&egrave; &agrave;�&aacute;&oacute;&igrave; �&uacute;�&acirc;&icirc;',
	'alb_mrg' => '&Igrave;�&iacute;&agrave;��� &iacute;&agrave; &agrave;�&aacute;&oacute;&igrave;&egrave;&ograve;�',
	'my_gallery' => '* &Igrave;&icirc;�&ograve;&agrave; �&agrave;���&egrave;� *',
	'no_category' => '* &Iacute;�&igrave;&agrave; &ecirc;&agrave;&ograve;��&icirc;�&egrave;� *',
	'delete' => '&Egrave;�&ograve;�&egrave;&eacute;',
	'new' => '&Iacute;&icirc;&acirc;',
	'apply_modifs' => '&Egrave;�&acirc;&uacute;��&egrave; &igrave;&icirc;&auml;&egrave;&ocirc;&egrave;&ecirc;&agrave;&ouml;&egrave;&eacute;&ograve;�',
	'select_category' => '&Egrave;�&aacute;��&egrave; &ecirc;&agrave;&ograve;��&icirc;�&egrave;�',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => '�&agrave;�&agrave;&igrave;�&ograve;&uacute;� &egrave;�&egrave;�&ecirc;&acirc;&agrave;&iacute; �&agrave; &icirc;���&agrave;&ouml;&egrave;� \'%s\' &iacute;� � &auml;&icirc;&aacute;&agrave;&acirc;�&iacute; !',
	'unknown_cat' => '&Egrave;�&aacute;�&agrave;&iacute;&agrave;&ograve;&agrave; &ecirc;&agrave;&ograve;��&icirc;�&egrave;� &iacute;� �&uacute;&ugrave;��&ograve;&acirc;&oacute;&acirc;&agrave;',
	'usergal_cat_ro' => '&Ecirc;&agrave;&ograve;��&icirc;�&egrave;� &iacute;&agrave; �&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&egrave; �&agrave;���&egrave;&egrave; &iacute;&agrave; &igrave;&icirc;�� &auml;&agrave; &aacute;&uacute;&auml;� &egrave;�&ograve;�&egrave;&ograve;&agrave; !',
	'manage_cat' => '&Oacute;��&agrave;&acirc;��&iacute;&egrave;� &iacute;&agrave; &ecirc;&agrave;&ograve;��&icirc;�&egrave;&eacute;&ograve;�',
	'confirm_delete' => '�&egrave;�&oacute;��&iacute; �&egrave; �&egrave;, �� &egrave;�&ecirc;&agrave;� &auml;&agrave; &Egrave;�&Ograve;�&Egrave;�� &ograve;&agrave;�&egrave; &ecirc;&agrave;&ograve;��&icirc;�&egrave;�',
	'category' => '&Ecirc;&agrave;&ograve;��&icirc;�&egrave;�',
	'operations' => '&Icirc;���&agrave;&ouml;&egrave;&egrave;',
	'move_into' => '���&igrave;��&ograve;&egrave; &acirc;',
	'update_create' => '&Icirc;&aacute;&iacute;&icirc;&acirc;&egrave;/�&uacute;�&auml;&agrave;&eacute; &ecirc;&agrave;&ograve;��&icirc;�&egrave;�',
	'parent_cat' => '��&agrave;&acirc;&iacute;&agrave; &ecirc;&agrave;&ograve;��&icirc;�&egrave;�',
	'cat_title' => '�&agrave;��&agrave;&acirc;&egrave;� &iacute;&agrave; &ecirc;&agrave;&ograve;��&icirc;�&egrave;�',
	'cat_desc' => '&Icirc;�&egrave;�&agrave;&iacute;&egrave;� &iacute;&agrave; &ecirc;&agrave;&ograve;��&icirc;�&egrave;�'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => '&Ecirc;&icirc;&iacute;&ocirc;&egrave;�&oacute;�&agrave;&ouml;&egrave;�',
	'restore_cfg' => '&Acirc;&uacute;��&ograve;&agrave;&iacute;&icirc;&acirc;�&acirc;&agrave;&iacute;� &iacute;&agrave; �&ograve;&icirc;&eacute;&iacute;&icirc;�&ograve;&egrave;&ograve;� �&icirc; �&icirc;&auml;�&agrave;�&aacute;&egrave;�&agrave;&iacute;�',
	'save_cfg' => '�&agrave;�&egrave;�&egrave; &iacute;&icirc;&acirc;&agrave;&ograve;&agrave; &ecirc;&icirc;&iacute;&ocirc;&egrave;�&oacute;�&agrave;&ouml;&egrave;�',
	'notes' => '&Aacute;����&ecirc;&egrave;',
	'info' => '&Egrave;&iacute;&ocirc;&icirc;�&igrave;&agrave;&ouml;&egrave;�',
	'upd_success' => '&Ecirc;&icirc;&iacute;&ocirc;&egrave;�&oacute;�&agrave;&ouml;&egrave;�&ograve;&agrave; � &icirc;&aacute;&iacute;&icirc;&acirc;�&iacute;&agrave;',
	'restore_success' => '&Ecirc;&icirc;&iacute;&ocirc;&egrave;�&oacute;�&agrave;&ouml;&egrave;�&ograve;&agrave; �&icirc; �&icirc;&auml;�&agrave;�&aacute;&egrave;�&agrave;&iacute;� � &acirc;&uacute;��&ograve;&agrave;&iacute;&icirc;&acirc;�&iacute;&agrave;',
	'name_a' => '&Egrave;&igrave;� &acirc;&uacute;��&icirc;&auml;�&ugrave;',
	'name_d' => '&Egrave;&igrave;� &iacute;&egrave;��&icirc;&auml;�&ugrave;',
	'date_a' => '&Auml;&agrave;&ograve;&agrave; &acirc;&uacute;��&icirc;&auml;�&ugrave;&agrave;',
	'date_d' => '&Auml;&agrave;&ograve;&agrave; &iacute;&egrave;��&icirc;&auml;�&ugrave;&agrave;'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'&Icirc;&aacute;&ugrave;&egrave; &iacute;&agrave;�&ograve;�&icirc;&eacute;&ecirc;&egrave;',
	array('&Egrave;&igrave;� &iacute;&agrave; �&agrave;���&egrave;�', 'gallery_name', 0),
	array('&Icirc;�&egrave;�&agrave;&iacute;&egrave;� &iacute;&agrave; �&agrave;���&egrave;�', 'gallery_description', 0),
	array('�-&igrave;&agrave;&eacute;� &iacute;&agrave; &agrave;&auml;&igrave;&egrave;&iacute;&egrave;�&ograve;�&agrave;&ograve;&icirc;�&agrave; &iacute;&agrave; �&agrave;���&egrave;�&ograve;&agrave;', 'gallery_admin_email', 0),
	array('&Agrave;&auml;��� �&agrave; &acirc;�&uacute;�&ecirc;&agrave;&ograve;&agrave; \'&Acirc;&egrave;� &icirc;&ugrave;� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;\' &acirc; �-&ecirc;&agrave;�&ograve;&egrave;�&ecirc;&agrave;', 'ecards_more_pic_target', 0),
	array('��&egrave;&ecirc;', 'lang', 5),
	array('&Acirc;&egrave;�&oacute;&agrave;�&iacute;&agrave; &ograve;�&igrave;&agrave;', 'theme', 6),

	'������&auml; &iacute;&agrave; �&egrave;�&ograve;&agrave; � &agrave;�&aacute;&oacute;&igrave;&egrave;',
	array('�&egrave;�&egrave;&iacute;&agrave; &iacute;&agrave; ��&agrave;&acirc;&agrave;&iacute;&ograve;&agrave; &ograve;&agrave;&aacute;�&egrave;&ouml;&agrave; (�&egrave;&ecirc;���&egrave; &egrave;�&egrave; %)', 'main_table_width', 0),
	array('&Aacute;�&icirc;&eacute; &iacute;&egrave;&acirc;&agrave; &icirc;&ograve; &ecirc;&agrave;&ograve;��&icirc;�&egrave;&eacute;&ograve;� �&agrave; &acirc;&egrave;�&oacute;&agrave;�&egrave;�&agrave;&ouml;&egrave;�', 'subcat_level', 0),
	array('&Aacute;�&icirc;&eacute; &agrave;�&aacute;&oacute;&igrave;&egrave; &iacute;&agrave; �&ograve;�&agrave;&iacute;&egrave;&ouml;&agrave;', 'albums_per_page', 0),
	array('&Aacute;�&icirc;&eacute; &ecirc;&icirc;�&icirc;&iacute;&egrave; �&agrave; �&egrave;�&ograve;&agrave; &iacute;&agrave; &agrave;�&aacute;&oacute;&igrave;&egrave;&ograve;�', 'album_list_cols', 0),
	array('�&icirc;��&igrave;&egrave;&iacute;&agrave; &iacute;&agrave; &igrave;&agrave;�&ecirc;&agrave;&ograve;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; &acirc; �&egrave;&ecirc;���&egrave;', 'alb_list_thumb_size', 0),
	array('�&uacute;&auml;&uacute;��&agrave;&iacute;&egrave;� &iacute;&agrave; ��&agrave;&acirc;&iacute;&agrave;&ograve;&agrave; �&ograve;�&agrave;&iacute;&egrave;&ouml;&agrave;', 'main_page_layout', 0),

	'������&auml; &iacute;&agrave; &igrave;&agrave;�&ecirc;&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	array('&Ecirc;&icirc;�&egrave;���&ograve;&acirc;&icirc; &ecirc;&icirc;�&icirc;&iacute;&ecirc;&egrave; &iacute;&agrave; �&ograve;�&agrave;&iacute;&egrave;&ouml;&agrave;&ograve;&agrave;', 'thumbcols', 0),
	array('&Ecirc;&icirc;�&egrave;���&ograve;&acirc;&icirc; ��&auml;&icirc;&acirc;� &iacute;&agrave; �&ograve;�&agrave;&iacute;&egrave;&ouml;&agrave;&ograve;&agrave;', 'thumbrows', 0),
	array('&Igrave;&agrave;&ecirc;�&egrave;&igrave;&agrave;�&iacute;&icirc; &ecirc;&icirc;�&egrave;���&ograve;&acirc;&icirc; &iacute;&agrave; &ograve;&agrave;&aacute;&oacute;�&agrave;&ouml;&egrave;&egrave;', 'max_tabs', 0),
	array('�&icirc;&ecirc;&agrave;�&acirc;&agrave;&iacute;� &iacute;&agrave; &iacute;&agrave;&auml;�&egrave;�&agrave; &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; (&acirc; &auml;&icirc;�&uacute;�&iacute;�&iacute;&egrave;� &iacute;&agrave; �&agrave;��&agrave;&acirc;&egrave;�&ograve;&icirc;) �&icirc;&auml; &igrave;&agrave;�&ecirc;&agrave;&ograve;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;', 'caption_in_thumbview', 1),
	array('�&icirc;&ecirc;&agrave;�&acirc;&agrave;&iacute;� &iacute;&agrave; &aacute;�&icirc;� &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&egrave; �&icirc;&auml; &igrave;&agrave;�&ecirc;&agrave;&ograve;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;', 'display_comment_count', 1),
	array('�&icirc;�&ograve;&egrave;�&agrave;&iacute;� �&icirc; �&icirc;&auml;�&agrave;�&aacute;&egrave;�&agrave;&iacute;� &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;&ograve;�', 'default_sort_order', 3),
	array('&Igrave;&egrave;&iacute;&egrave;&igrave;&agrave;��&iacute; &aacute;�&icirc;&eacute; ��&agrave;�&oacute;&acirc;&agrave;&iacute;&egrave;� �&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; �&agrave; &auml;&agrave; �� &acirc;&ecirc;���&egrave; &acirc; �&egrave;�&ograve;&agrave;&ograve;&agrave; &iacute;&agrave; \'&iacute;&agrave;&eacute;-���&auml;&agrave;&iacute;&egrave;\'', 'min_votes_for_rating', 0),

	'������&auml; &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; &amp; &Iacute;&agrave;��&icirc;&eacute;&ecirc;&agrave; &iacute;&agrave; &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�',
	array('�&egrave;�&egrave;&iacute;&agrave; &iacute;&agrave; &ograve;&agrave;&aacute;�&egrave;&ouml;&agrave;&ograve;&agrave; �&agrave; �&icirc;&ecirc;&agrave;�&acirc;&agrave;&iacute;� &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; (�&egrave;&ecirc;���&egrave; &egrave;�&egrave; %)', 'picture_table_width', 0),
	array('&Egrave;&iacute;&ocirc;&icirc;�&igrave;&agrave;&ouml;&egrave;� �&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;&ograve;&agrave; �� &acirc;&egrave;�&auml;&agrave; �&icirc; �&icirc;&auml;�&agrave;�&aacute;&egrave;�&agrave;&iacute;�', 'display_pic_info', 1),
	array('&Ocirc;&egrave;�&ograve;�&egrave;�&agrave;&eacute; \'�&icirc;�&egrave;&ograve;�\' &auml;&oacute;&igrave;&egrave; &acirc; &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&egrave;&ograve;�', 'filter_bad_words', 1),
	array('�&icirc;�&acirc;&icirc;�&egrave; &oacute;�&igrave;&egrave;&acirc;&ecirc;&egrave; &acirc;', 'enable_smilies', 1),
	array('&Igrave;&agrave;&ecirc;�&egrave;&igrave;&agrave;�&iacute;&agrave; &auml;&uacute;��&egrave;&iacute;&agrave; &iacute;&agrave; &icirc;�&egrave;�&agrave;&iacute;&egrave;� &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;', 'max_img_desc_length', 0),
	array('&Igrave;&agrave;&ecirc;�&egrave;&igrave;&agrave;��&iacute; &aacute;�&icirc;&eacute; &iacute;&agrave; �&egrave;&igrave;&acirc;&icirc;�&egrave; &acirc; &auml;&oacute;&igrave;&agrave;', 'max_com_wlength', 0),
	array('&Igrave;&agrave;&ecirc;�&egrave;&igrave;&agrave;��&iacute; &aacute;�&icirc;&eacute; &iacute;&agrave; ��&auml;&icirc;&acirc;� &acirc; &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�', 'max_com_lines', 0),
	array('&Igrave;&agrave;&ecirc;�&egrave;&igrave;&agrave;�&iacute;&agrave; &auml;&uacute;��&egrave;&iacute;&agrave; &iacute;&agrave; &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;� &acirc; �&egrave;&igrave;&acirc;&icirc;�&egrave;', 'max_com_size', 0),

	'&Iacute;&agrave;�&ograve;&icirc;�&eacute;&ecirc;&egrave; &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; &egrave; &igrave;&agrave;�&ecirc;&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	array('&Ecirc;&agrave;���&ograve;&acirc;&icirc; &iacute;&agrave; JPEG &ocirc;&agrave;&eacute;�&icirc;&acirc;�&ograve;�', 'jpeg_qual', 0),
	array('&Igrave;&agrave;&ecirc;�&egrave;&igrave;&agrave;�&iacute;&agrave; &acirc;&egrave;�&icirc;�&egrave;&iacute;&agrave; &egrave;�&egrave; �&egrave;�&egrave;&iacute;&agrave; &iacute;&agrave; &igrave;&agrave;�&ecirc;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; <b>*</b>', 'thumb_width', 0),
	array('�&uacute;�&auml;&agrave;&eacute; &igrave;��&auml;&egrave;&iacute;&iacute;&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;','make_intermediate',1),
	array('&Igrave;&agrave;&ecirc;�&egrave;&igrave;&agrave;�&iacute;&agrave; &acirc;&egrave;�&icirc;�&egrave;&iacute;&agrave; &egrave;�&egrave; �&egrave;�&egrave;&iacute;&agrave; &iacute;&agrave; &igrave;��&auml;&egrave;&iacute;&iacute;&egrave;&ograve;� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; <b>*</b>', 'picture_width', 0),
	array('&Igrave;&agrave;&ecirc;�&egrave;&igrave;&agrave;�&iacute;&agrave; �&icirc;��&igrave;&egrave;&iacute;&agrave; &iacute;&agrave; &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;&egrave;&ograve;� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; (KB)', 'max_upl_size', 0),
	array('&Igrave;&agrave;&ecirc;�&egrave;&igrave;&agrave;�&iacute;&agrave; &acirc;&egrave;�&icirc;�&egrave;&iacute;&agrave; &egrave;�&egrave; �&egrave;�&egrave;&iacute;&agrave; �&agrave; &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;&agrave;&ograve;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; (�&egrave;&ecirc;���&egrave;)', 'max_upl_width_height', 0),

	'�&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&egrave; &iacute;&agrave;�&ograve;�&icirc;&eacute;&ecirc;&egrave;',
	array('�&agrave;�����&iacute;&egrave;� �&agrave; �&uacute;�&auml;&agrave;&acirc;&agrave;&iacute;� &iacute;&agrave; &iacute;&icirc;&acirc;&egrave; �&icirc;&ograve;��&aacute;&egrave;&ograve;��&egrave;', 'allow_user_registration', 1),
	array('���&egrave;�&ograve;�&egrave;�&agrave;&iacute;�&ograve;&icirc; &iacute;&agrave; �&icirc;&ograve;��&aacute;&egrave;&ograve;�� &egrave;�&egrave;�&ecirc;&agrave;&acirc;&agrave; �&icirc;&ograve;&acirc;&uacute;��&auml;�&iacute;&egrave;� � �-&igrave;�&eacute;�', 'reg_requires_valid_email', 1),
	array('�&icirc;�&acirc;&icirc;�&egrave; &iacute;&agrave; &auml;&acirc;&agrave;&igrave;&agrave; �&icirc;&ograve;��&aacute;&egrave;&ograve;��&egrave; &auml;&agrave; &egrave;&igrave;&agrave;&ograve; �&auml;&iacute;&agrave;&ecirc;&acirc;&egrave; �-&igrave;�&eacute;� &agrave;&auml;���&egrave;', 'allow_duplicate_emails_addr', 1),
	array('�&icirc;&ograve;��&aacute;&egrave;&ograve;��&egrave;&ograve;� &igrave;&icirc;�&agrave;&ograve; &auml;&agrave; &egrave;&igrave;&agrave;&ograve; �&egrave;�&iacute;&egrave; &agrave;�&aacute;&oacute;&igrave;&egrave;', 'allow_private_albums', 1),

	'�&icirc;&ograve;��&aacute;&egrave;&ograve;���&egrave; �&icirc;��&ograve;&agrave; ��&egrave; &icirc;�&egrave;�&agrave;&iacute;&egrave;�&ograve;&icirc; &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; (&icirc;�&ograve;&agrave;&acirc;&egrave; ��&agrave;�&iacute;&icirc;, &agrave;&ecirc;&icirc; &iacute;� �� �&icirc;��&acirc;&agrave;)',
	array('&Egrave;&igrave;� &iacute;&agrave; �&icirc;�� 1', 'user_field1_name', 0),
	array('&Egrave;&igrave;� &iacute;&agrave; �&icirc;�� 2', 'user_field2_name', 0),
	array('&Egrave;&igrave;� &iacute;&agrave; �&icirc;�� 3', 'user_field3_name', 0),
	array('&Egrave;&igrave;� &iacute;&agrave; �&icirc;�� 4', 'user_field4_name', 0),

	'�&agrave;��&egrave;��&iacute;&egrave; &iacute;&agrave;�&ograve;&icirc;�&eacute;&ecirc;&egrave; &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; &egrave; &igrave;&agrave;�&ecirc;&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	array('�&egrave;&igrave;&acirc;&icirc;�&egrave; �&agrave;&aacute;�&agrave;&iacute;�&iacute;&egrave; &acirc; &egrave;&igrave;�&ograve;&icirc; &iacute;&agrave; &ocirc;&agrave;&eacute;�&icirc;&acirc;�&ograve;�', 'forbiden_fname_char',0),
	array('&Icirc;&auml;&icirc;&aacute;��&iacute;&egrave; &ocirc;&agrave;&eacute;�&icirc;&acirc;&egrave; �&agrave;��&egrave;��&iacute;&egrave;� �&agrave; &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;', 'allowed_file_extensions',0),
	array('&Igrave;�&ograve;&icirc;&auml; &iacute;&agrave; ��&igrave;&agrave;&ugrave;&agrave;&aacute;&egrave;�&agrave;&iacute;� &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;&ograve;�','thumb_method',2),
	array('�&uacute;&ograve; &ecirc;&uacute;&igrave; ImageMagick \'&ecirc;&icirc;&iacute;&acirc;��&ograve;&egrave;�&agrave;&ugrave;&agrave;\' ��&icirc;��&agrave;&igrave;&agrave; (��&egrave;&igrave;�� /usr/bin/X11/)', 'impath', 0),
	array('�&agrave;�����&iacute;&egrave; &ograve;&egrave;�&icirc;&acirc;� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; (&acirc;&agrave;�&egrave;&auml;&iacute;&icirc; �&agrave;&igrave;&icirc; �&agrave; ImageMagick)', 'allowed_img_types',0),
	array('&Icirc;�&ouml;&egrave;&egrave; &icirc;&ograve; &ecirc;&icirc;&igrave;&agrave;&iacute;&auml;�&iacute; ��&auml; �&agrave; ImageMagick', 'im_options', 0),
	array('��&ograve;&egrave; EXIF &egrave;&iacute;&ocirc;&icirc;�&igrave;&agrave;&ouml;&egrave;� &acirc; JPEG &ocirc;&agrave;&eacute;�&icirc;&acirc;�&ograve;�', 'read_exif_data', 1),
	array('&Agrave;�&aacute;&oacute;&igrave; &auml;&egrave;��&ecirc;&ograve;&icirc;�&egrave;� <b>*</b>', 'fullpath', 0),
	array('&Auml;&egrave;��&ecirc;&ograve;&icirc;�&egrave;� �&agrave; �&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; <b>*</b>', 'userpics', 0),
	array('���&ocirc;&egrave;&ecirc;� �&agrave; &igrave;��&auml;&egrave;&iacute;&iacute;&egrave;&ograve;� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; <b>*</b>', 'normal_pfx', 0),
	array('���&ocirc;&egrave;&ecirc;� �&agrave; &igrave;&agrave;�&ecirc;&egrave;&ograve;� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; <b>*</b>', 'thumb_pfx', 0),
	array('&Agrave;&ograve;�&egrave;&aacute;&oacute;&ograve;&egrave; �&icirc; �&icirc;&auml;�&agrave;�&aacute;&egrave;�&agrave;&iacute;� &iacute;&agrave; &auml;&egrave;��&ecirc;&ograve;&icirc;�&egrave;&eacute;&ograve;�', 'default_dir_mode', 0),
	array('&Agrave;&ograve;�&egrave;&aacute;&oacute;&ograve;&egrave; �&icirc; �&icirc;&auml;�&agrave;�&aacute;&egrave;�&agrave;&iacute;� &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;&ograve;�', 'default_file_mode', 0),

	'Cookies &amp; &Iacute;&agrave;�&ograve;�&icirc;&eacute;&ecirc;&egrave; &iacute;&agrave; �&iacute;&ecirc;&icirc;&auml;&egrave;&iacute;�&agrave;',
	array('&Egrave;&igrave;� &iacute;&agrave; cookie-&ograve;&icirc; &egrave;��&icirc;��&acirc;&agrave;&iacute;&icirc; &icirc;&ograve; �&ecirc;�&egrave;�&ograve;&agrave;', 'cookie_name', 0),
	array('�&uacute;&ograve; &iacute;&agrave; cookie-&ograve;&icirc; &egrave;��&icirc;��&acirc;&agrave;&iacute;&icirc; &ograve;&icirc; �&ecirc;�&egrave;�&ograve;&agrave;', 'cookie_path', 0),
	array('�&egrave;&igrave;&acirc;&icirc;��&iacute; �&iacute;&ecirc;&icirc;&auml;&egrave;&iacute;�', 'charset', 4),

	'&Auml;&icirc;�&uacute;�&iacute;&egrave;&ograve;��&iacute;&egrave; &iacute;&agrave;�&ograve;�&icirc;&eacute;&ecirc;&egrave;',
	array('&Acirc;&ecirc;���&egrave; ���&egrave;&igrave;&agrave; &iacute;&agrave; &auml;�&aacute;&uacute;�&acirc;&agrave;&iacute;�', 'debug_mode', 1),

	'<br /><div align="center">(*) �&icirc;��&ograve;&agrave;&ograve;&agrave; &igrave;&agrave;�&ecirc;&egrave;�&agrave;&iacute;&egrave; �&uacute;� �&egrave;&igrave;&acirc;&icirc;�&agrave; * &iacute;� &ograve;��&iacute;&acirc;&agrave; &auml;&agrave; �� ��&icirc;&igrave;�&iacute;�&ograve; &agrave;&ecirc;&icirc; &egrave;&igrave;&agrave;&ograve;� &Acirc;��� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; &acirc; �&agrave;���&egrave;�&ograve;&agrave;</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => '&Ograve;��&aacute;&acirc;&agrave; &auml;&agrave; &acirc;&uacute;&acirc;�&auml;�&ograve;� &acirc;&agrave;��&ograve;&icirc; &egrave;&igrave;� &egrave; &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�',
	'com_added' => '&Acirc;&agrave;�&egrave;� &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;� � &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;',
	'alb_need_title' => '&Ograve;��&aacute;&acirc;&agrave; &auml;&agrave; &acirc;&uacute;&acirc;�&auml;�&ograve;� �&agrave;��&agrave;&acirc;&egrave;� &iacute;&agrave; &agrave;�&aacute;&oacute;&igrave;&agrave; !',
	'no_udp_needed' => '&Iacute;�&igrave;&agrave; &iacute;&oacute;�&auml;&agrave; &icirc;&ograve; &icirc;&aacute;&iacute;&icirc;&acirc;�&acirc;&agrave;&iacute;�.',
	'alb_updated' => '&Agrave;�&aacute;&oacute;&igrave;&agrave; � &icirc;&aacute;&iacute;&icirc;&acirc;�&iacute;',
	'unknown_album' => '&Egrave;�&aacute;�&agrave;&iacute;&egrave;� &agrave;�&aacute;&oacute;&igrave; &iacute;� �&uacute;&ugrave;��&ograve;&acirc;&oacute;&acirc;&agrave; &egrave;�&egrave; &iacute;�&igrave;&agrave;� &auml;&icirc;�&ograve;&uacute;� &auml;&icirc; &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;� &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; &acirc; &ograve;&icirc;�&egrave; &agrave;�&aacute;&oacute;&igrave;',
	'no_pic_uploaded' => '&Ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;&ograve;&agrave; &iacute;� &aacute;��� &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;&agrave; !<br /><br />&Agrave;&ecirc;&icirc; &iacute;&agrave;&egrave;�&ograve;&egrave;&iacute;&agrave; �&ograve;� &egrave;�&aacute;�&agrave;�&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; �&agrave; &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;�, ��&icirc;&acirc;���&ograve;� &auml;&agrave;�&egrave; �&uacute;�&acirc;&uacute;�&agrave; �&icirc;�&acirc;&icirc;��&acirc;&agrave; &ecirc;&agrave;�&acirc;&agrave;&iacute;� &iacute;&agrave; &ocirc;&agrave;&eacute;�&icirc;&acirc;�...',
	'err_mkdir' => '&Iacute;� &igrave;&icirc;�� &auml;&agrave; &aacute;&uacute;&auml;� �&uacute;�&auml;&agrave;&auml;�&iacute;&agrave; &auml;&egrave;��&ecirc;&ograve;&icirc;�&egrave;� %s !',
	'dest_dir_ro' => '&Acirc; &auml;&egrave;��&ecirc;&ograve;&icirc;�&egrave;� %s �&ecirc;�&egrave;�&ograve;&agrave; &iacute;� &igrave;&icirc;�� &auml;&agrave; �&agrave;�&egrave;�&acirc;&agrave; !',
	'err_move' => '&Iacute;�&acirc;&uacute;�&igrave;&icirc;�&iacute;&icirc; � ���&igrave;��&ograve;&acirc;&agrave;&iacute;�&ograve;&icirc; &iacute;&agrave; %s &acirc; %s !',
	'err_fsize_too_large' => '�&agrave;�&igrave;��&agrave; &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;&ograve;&agrave; &ecirc;&icirc;�&ograve;&icirc; &auml;&icirc;&aacute;&agrave;&acirc;�&ograve;� � &igrave;&iacute;&icirc;�&icirc; �&icirc;��&igrave; (&igrave;&agrave;&ecirc;�&egrave;&igrave;&oacute;&igrave; �&agrave;�����&iacute; �&agrave;�&igrave;�� � %s x %s) !',
	'err_imgsize_too_large' => '�&icirc;��&igrave;&egrave;&iacute;&agrave;&ograve;&agrave; &iacute;&agrave; &ocirc;&agrave;&eacute;�&agrave; &ecirc;&icirc;&eacute;&ograve;&icirc; &auml;&icirc;&aacute;&agrave;&acirc;�&ograve;� � &igrave;&iacute;&icirc;�&icirc; �&icirc;��&igrave; (&igrave;&agrave;&ecirc;�&egrave;&igrave;&agrave;�&iacute;&agrave;&ograve;&agrave; �&icirc;��&igrave;&egrave;&iacute;&agrave; � %s KB) !',
	'err_invalid_img' => '&Ocirc;&agrave;&eacute;�&agrave;, &ecirc;&icirc;&eacute;&ograve;&icirc; &auml;&icirc;&aacute;&agrave;&acirc;�&ograve;� &iacute;� � &acirc;&agrave;�&egrave;&auml;&iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; !',
	'allowed_img_types' => '&Igrave;&icirc;�� &auml;&agrave; &auml;&icirc;&aacute;&agrave;&acirc;�&ograve;� �&agrave;&igrave;&icirc; %s &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;.',
	'err_insert_pic' => '&Ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;&ograve;&agrave; \'%s\' &iacute;� &igrave;&icirc;�� &auml;&agrave; &aacute;&uacute;&auml;� &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;&agrave; &acirc; &agrave;�&aacute;&oacute;&igrave;&agrave; ',
	'upload_success' => '&Acirc;&agrave;�&agrave;&ograve;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; &aacute;��� &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;&agrave; &oacute;����&iacute;&icirc;<br /><br />&Ograve;� &ugrave;� &aacute;&uacute;&auml;� &acirc;&egrave;&auml;&egrave;&igrave;&agrave; ���&auml; &icirc;&aacute;&icirc;&aacute;��&iacute;&egrave;�&ograve;&icirc; &iacute;&agrave; &agrave;&auml;&igrave;&egrave;&iacute;&egrave;�&ograve;�&agrave;&ograve;&icirc;�&agrave;.',
	'info' => '&Egrave;&iacute;&ocirc;&icirc;�&igrave;&agrave;&ouml;&egrave;�',
	'com_added' => '&Ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&agrave; � &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;',
	'alb_updated' => '&Agrave;�&aacute;&oacute;&igrave;&agrave; � &icirc;&aacute;&iacute;&icirc;&acirc;�&iacute;',
	'err_comment_empty' => '&Acirc;&agrave;�&egrave;� &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;� &acirc; ��&agrave;��&iacute; !',
	'err_invalid_fext' => '�&agrave;&igrave;&icirc; &ocirc;&agrave;&eacute;�&icirc;&acirc;� �&uacute;� ���&auml;&iacute;&egrave;&ograve;� �&agrave;��&egrave;��&iacute;&egrave;� �� ��&egrave;�&igrave;&agrave;&ograve; : <br /><br />%s.',
	'no_flood' => '�&uacute;�&agrave;��&acirc;&agrave;&igrave;�, &iacute;&icirc; &Acirc;&egrave;� �&ograve;� &agrave;&acirc;&ograve;&icirc;�&agrave; &iacute;&agrave; �&icirc;���&auml;&iacute;&egrave;� &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;� �&agrave; &ograve;&agrave;�&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;.<br /><br />��&auml;&agrave;&ecirc;&ograve;&egrave;�&agrave;&eacute;&ograve;� &ecirc;&icirc;&igrave;�&ograve;&agrave;�&agrave;, &agrave;&ecirc;&icirc; &egrave;�&ecirc;&agrave;&ograve;� &auml;&agrave; &iacute;&agrave;��&agrave;&acirc;&egrave;&ograve;� ��&icirc;&igrave;�&iacute;&egrave;',
	'redirect_msg' => '&Acirc;&egrave;� �&ograve;� ���&iacute;&agrave;�&icirc;��&iacute;&egrave;.<br /><br /><br />&Iacute;&agrave;&ograve;&egrave;�&iacute;�&ograve;� \'��&Icirc;&Auml;&Uacute;���&Iacute;&Egrave;�\' &agrave;&ecirc;&icirc; �&ograve;�&agrave;&iacute;&egrave;&ouml;&agrave;&ograve;&agrave; &iacute;� �� &icirc;&aacute;&iacute;&icirc;&acirc;&egrave; &agrave;&acirc;&ograve;&icirc;&igrave;&agrave;&ograve;&egrave;�&iacute;&icirc;',
	'upl_success' => '&Acirc;&agrave;�&agrave;&ograve;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; � &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;&agrave; &oacute;����&iacute;&icirc;',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => '�&agrave;��&agrave;&acirc;&egrave;�',
	'fs_pic' => '�&uacute;��&iacute; �&agrave;�&igrave;�� &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;',
	'del_success' => '&egrave;�&ograve;�&egrave;&ograve;&agrave; &oacute;����&iacute;&icirc;',
	'ns_pic' => '&iacute;&icirc;�&igrave;&agrave;��&iacute; �&agrave;�&igrave;�� &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;',
	'err_del' => '&iacute;� &igrave;&icirc;�� &auml;&agrave; &aacute;&uacute;&auml;� &egrave;�&ograve;�&egrave;&ograve;&agrave;',
	'thumb_pic' => '&igrave;&agrave;�&ecirc;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;',
	'comment' => '&ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�',
	'im_in_alb' => '&ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; &acirc; &agrave;�&aacute;&oacute;&igrave;',
	'alb_del_success' => '&Agrave;�&aacute;&oacute;&igrave;&uacute;&ograve; \'%s\' � &egrave;�&ograve;�&egrave;&ograve;',
	'alb_mgr' => '&Igrave;�&iacute;&agrave;��� &iacute;&agrave; &agrave;�&aacute;&oacute;&igrave;',
	'err_invalid_data' => '&Iacute;�&acirc;&agrave;�&egrave;&auml;&iacute;&agrave; &egrave;&iacute;&ocirc;&icirc;�&igrave;&agrave;&ouml;&egrave;� � �&icirc;�&oacute;��&iacute;&agrave; &acirc; \'%s\'',
	'create_alb' => '�&uacute;�&auml;&agrave;&acirc;&agrave;&iacute;� &iacute;&agrave; &agrave;�&aacute;&oacute;&igrave; \'%s\'',
	'update_alb' => '&Icirc;&aacute;&iacute;&icirc;&acirc;�&acirc;&agrave;&iacute;� &iacute;&agrave; &agrave;�&aacute;&oacute;&igrave; \'%s\' �&uacute;� �&agrave;��&agrave;&acirc;&egrave;� \'%s\' &egrave; &egrave;&iacute;&auml;�&ecirc;� \'%s\'',
	'del_pic' => '&Egrave;�&ograve;�&egrave;&eacute; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;',
	'del_alb' => '&Egrave;�&ograve;�&egrave;&eacute; &agrave;�&aacute;&oacute;&igrave;',
	'del_user' => '&Egrave;�&ograve;�&egrave;&eacute; �&icirc;&ograve;��&aacute;&egrave;&ograve;��',
	'err_unknown_user' => '&Egrave;�&aacute;�&agrave;&iacute;&egrave;� �&icirc;&ograve;��&aacute;&egrave;&ograve;�� &iacute;� �&uacute;&ugrave;��&ograve;&acirc;&oacute;&acirc;&agrave; !',
	'comment_deleted' => '&Ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&agrave; � &egrave;�&ograve;�&egrave;&ograve; &oacute;����&iacute;&icirc;',
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
	'confirm_del' => '�&egrave;�&oacute;��&iacute; �&egrave; �&ograve;�, �� &egrave;�&ecirc;&agrave;&ograve;� &auml;&agrave; &Egrave;�&Ograve;�&Egrave;�&Ograve;� &ograve;&agrave;�&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; ? \\n&Ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&egrave;&ograve;� &ecirc;&uacute;&igrave; &iacute;�� �&uacute;&ugrave;&icirc; &ugrave;� &aacute;&uacute;&auml;&agrave;&ograve; &egrave;�&ograve;�&egrave;&ograve;&egrave;.',
	'del_pic' => '&Egrave;�&Ograve;�&Egrave;&Eacute; &Ograve;&Agrave;�&Egrave; &Ecirc;&Agrave;�&Ograve;&Egrave;&Iacute;&Ecirc;&Agrave;',
	'size' => '%s x %s �&egrave;&ecirc;���&agrave;',
	'views' => '%s �&uacute;&ograve;&egrave;',
	'slideshow' => '��&agrave;&eacute;&auml; �&icirc;&oacute;',
	'stop_slideshow' => '���&Egrave; ��&Agrave;&Eacute;&Auml; �&Icirc;&Oacute;',
	'view_fs' => '&Ugrave;�&agrave;&ecirc;&iacute;�&ograve;� �&agrave; &auml;&agrave; &acirc;&egrave;&auml;&egrave;&ograve;� �&uacute;�&iacute;&agrave;&ograve;&agrave; �&icirc;��&igrave;&egrave;&iacute;&agrave; &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;&ograve;&agrave;',
);

$lang_picinfo = array(
	'title' =>'&Egrave;&iacute;&ocirc;&icirc;�&igrave;&agrave;&ouml;&egrave;� �&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;&ograve;&agrave;',
	'Filename' => '&Egrave;&igrave;� &iacute;&agrave; &ocirc;&agrave;&eacute;�&agrave;',
	'Album name' => '&Egrave;&igrave;� &iacute;&agrave; &agrave;�&aacute;&oacute;&igrave;&agrave;',
	'Rating' => '��&eacute;&ograve;&egrave;&iacute;� (%s ��&agrave;�&icirc;&acirc;�)',
	'Keywords' => '&Ecirc;���&icirc;&acirc;&egrave; &auml;&oacute;&igrave;&egrave;',
	'File Size' => '�&icirc;��&igrave;&egrave;&iacute;&agrave; &iacute;&agrave; &ocirc;&agrave;&eacute;�&agrave;',
	'Dimensions' => '�&agrave;�&igrave;��&egrave;',
	'Displayed' => '�&icirc;&ecirc;&agrave;�&acirc;&agrave;&iacute;&egrave;�',
	'Camera' => '&Ecirc;&agrave;&igrave;��&agrave;',
	'Date taken' => '&Auml;&agrave;&ograve;&agrave; &iacute;&agrave; �&agrave;�&iacute;�&igrave;&agrave;&iacute;�',
	'Aperture' => '&Agrave;���&ograve;&oacute;�&agrave;',
	'Exposure time' => '&Acirc;��&igrave;� &iacute;&agrave; &egrave;��&agrave;�&agrave;&iacute;�',
	'Focal length' => '&Ocirc;&icirc;&ecirc;&oacute;�&iacute;&agrave; &auml;&uacute;��&egrave;&iacute;&agrave;',
	'Comment' => '&Ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�'
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => '��&auml;&agrave;&ecirc;&ograve;&egrave;�&agrave;&eacute; &ograve;&icirc;�&egrave; &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�',
	'confirm_delete' => '�&egrave;�&oacute;��&iacute; �&egrave; �&ograve;�, �� &egrave;�&ecirc;&agrave;&ograve;� &auml;&agrave; &egrave;�&ograve;�&egrave;�&ograve;� &ograve;&icirc;�&egrave; &ecirc;&icirc;&igrave;�&ograve;&agrave;� ?',
	'add_your_comment' => '&Auml;&icirc;&aacute;&agrave;&acirc;&egrave; &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�',
	'your_name' => '&Acirc;&agrave;��&ograve;&icirc; &egrave;&igrave;�',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => '&Egrave;���&agrave;&ograve;&egrave; e-&ecirc;&agrave;�&ograve;&egrave;�&ecirc;&agrave;',
	'invalid_email' => '<b>&Acirc;&iacute;&egrave;&igrave;&agrave;&iacute;&egrave;�</b> : &iacute;�&acirc;&agrave;�&egrave;&auml;�&iacute; e-mail &agrave;&auml;��� !',
	'ecard_title' => '�&auml;&iacute;&agrave; �-&ecirc;&agrave;�&ograve;&egrave;�&ecirc;&agrave; &icirc;&ograve; %s �&agrave; &ograve;�&aacute;',
	'view_ecard' => '&Agrave;&ecirc;&icirc; �-&ecirc;&agrave;�&ograve;&egrave;�&ecirc;&agrave; &iacute;� �� �&icirc;&ecirc;&agrave;�&acirc;&agrave; &ecirc;&icirc;��&ecirc;&ograve;&iacute;&icirc;, &igrave;&icirc;�� ��&agrave;&ecirc;&iacute;�&ograve;� &ograve;&icirc;�&agrave; &acirc;�&uacute;�&ecirc;&agrave;',
	'view_more_pics' => '&Ugrave;�&agrave;&ecirc;&iacute;�&ograve;� &iacute;&agrave; &ograve;&agrave;�&egrave; &acirc;�&uacute;�&ecirc;&agrave; �&agrave; &auml;&agrave; &acirc;&egrave;&auml;&egrave;&ograve;� &icirc;&ugrave;� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; !',
	'send_success' => '&Acirc;&agrave;�&agrave;&ograve;� �-&ecirc;&agrave;�&ograve;&egrave;�&ecirc;&agrave; &aacute;��� &egrave;���&agrave;&ograve;�&iacute;&agrave;',
	'send_failed' => '�&uacute;�&agrave;��&acirc;&agrave;&igrave;�, &iacute;&icirc; �&uacute;�&acirc;&uacute;�&agrave; &iacute;� &igrave;&icirc;�� &auml;&agrave; &egrave;���&agrave;&ograve;&egrave; &Acirc;&agrave;�&agrave;&ograve;&agrave; �-&ecirc;&agrave;�&ograve;&egrave;�&ecirc;&agrave;...',
	'from' => '&Icirc;&ograve;',
	'your_name' => '&Acirc;&agrave;��&ograve;&icirc; &egrave;&igrave;�',
	'your_email' => '&Acirc;&agrave;�&egrave;�&ograve; e-mail &agrave;&auml;���',
	'to' => '�&agrave;',
	'rcpt_name' => '&Egrave;&igrave;�&ograve;&icirc; &iacute;&agrave; �&icirc;�&oacute;�&agrave;&ograve;���',
	'rcpt_email' => 'e-mail &agrave;&auml;��� &iacute;&agrave; �&icirc;�&oacute;�&agrave;&ograve;���',
	'greetings' => '�&icirc;�&auml;�&agrave;&acirc;',
	'message' => '�&uacute;&icirc;&aacute;&ugrave;�&iacute;&egrave;�',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => '&Egrave;&iacute;&ocirc;&icirc;�&igrave;&agrave;&ouml;&egrave;� �&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;',
	'album' => '&Agrave;�&aacute;&oacute;&igrave;',
	'title' => '�&agrave;��&agrave;&acirc;&egrave;�',
	'desc' => '&Icirc;�&egrave;�&agrave;&iacute;&egrave;�',
	'keywords' => '&Ecirc;���&icirc;&acirc;&egrave; &auml;&oacute;&igrave;&egrave;',
	'pic_info_str' => '%sx%s - %sKB - %s ������&auml;&agrave; - %s ��&agrave;�&icirc;&acirc;�',
	'approve' => '&Icirc;&auml;&icirc;&aacute;�&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;',
	'postpone_app' => '&Icirc;&ograve;��&icirc;��&iacute;&icirc; &icirc;&auml;&icirc;&aacute;��&iacute;&egrave;�',
	'del_pic' => '&Egrave;�&ograve;�&egrave;&eacute; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;&ograve;&agrave;',
	'reset_view_count' => '&Iacute;&oacute;�&egrave;�&agrave;&eacute; &aacute;�&icirc;��&agrave; &iacute;&agrave; ������&auml;&egrave;',
	'reset_votes' => '&Iacute;&oacute;�&egrave;�&agrave;&eacute; ��&agrave;�&icirc;&acirc;�&ograve;�',
	'del_comm' => '&Egrave;�&ograve;�&egrave;&eacute; &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&egrave;&ograve;�',
	'upl_approval' => '&Icirc;&auml;&icirc;&aacute;��&iacute;&egrave;� &iacute;&agrave; &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;�',
	'edit_pics' => '��&auml;&agrave;&ecirc;&ograve;&egrave;�&agrave;&eacute; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	'see_next' => '&Acirc;&egrave;� ���&auml;&acirc;&agrave;&ugrave;&egrave;&ograve;� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	'see_prev' => '&Acirc;&egrave;� ���&auml;&egrave;�&iacute;&egrave;&ograve;� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	'n_pic' => '%s &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	'n_of_pic_to_disp' => '&Aacute;�&icirc;&eacute; &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; �&agrave; �&icirc;&ecirc;&agrave;�&acirc;&agrave;&iacute;�',
	'apply' => '&Auml;&icirc;&aacute;&agrave;&acirc;&egrave; &igrave;&icirc;&auml;&egrave;&ocirc;&egrave;&ecirc;&agrave;&ouml;&egrave;&eacute;&ograve;�'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => '&Egrave;&igrave;� &iacute;&agrave; ��&oacute;�&agrave;',
	'disk_quota' => '&Auml;&egrave;�&ecirc;&icirc;&acirc; �&egrave;&igrave;&egrave;&ograve;',
	'can_rate' => '&Igrave;&icirc;�� &auml;&agrave; ��&agrave;�&oacute;&acirc;&agrave; �&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	'can_send_ecards' => '&Igrave;&icirc;�� &auml;&agrave; &egrave;���&agrave;&ugrave;&agrave; �-&ecirc;&agrave;�&ograve;&egrave;�&ecirc;&egrave;',
	'can_post_com' => '&Igrave;&icirc;�� &auml;&agrave; &auml;&icirc;&aacute;&agrave;&acirc;� &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&egrave;',
	'can_upload' => '&Igrave;&icirc;�� &auml;&agrave; &auml;&icirc;&aacute;&agrave;&acirc;� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	'can_have_gallery' => '&Igrave;&icirc;�� &auml;&agrave; &egrave;&igrave;&agrave; �&icirc;&aacute;�&ograve;&acirc;�&iacute;&agrave; �&agrave;���&egrave;�',
	'apply' => '&Auml;&icirc;&aacute;&agrave;&acirc;&egrave; &igrave;&icirc;&auml;&egrave;&ocirc;&egrave;&ecirc;&agrave;&ouml;&egrave;&eacute;&ograve;�',
	'create_new_group' => '�&uacute;�&auml;&agrave;&eacute; &iacute;&icirc;&acirc;&agrave; ��&oacute;�&agrave;',
	'del_groups' => '&Egrave;�&ograve;�&egrave;&eacute; &egrave;�&aacute;�&agrave;&iacute;&agrave;&ograve;&agrave; ��&oacute;�&agrave;(&egrave;)',
	'confirm_del' => '&Acirc;&iacute;&egrave;&igrave;&agrave;&iacute;&egrave;�, &ecirc;&icirc;�&agrave;&ograve;&icirc; &egrave;�&ograve;�&egrave;�&ograve;� ��&oacute;�&agrave;, �&icirc;&ograve;��&aacute;&egrave;&ograve;��&egrave;&ograve;� &ecirc;&icirc;&egrave;&ograve;&icirc; ��&egrave;&iacute;&agrave;&auml;���&agrave;&ograve; &ecirc;&uacute;&igrave; &ograve;&agrave;�&egrave; ��&oacute;�&agrave; &ugrave;� &aacute;&uacute;&auml;&agrave; ����&acirc;&uacute;���&iacute;&egrave; &acirc; ��&oacute;�&agrave; \'Registered\' !\n\n&Egrave;�&ecirc;&agrave;&ograve;� �&egrave; &auml;&agrave; ��&icirc;&auml;&uacute;��&egrave;&ograve;� ?',
	'title' => '&Oacute;��&agrave;&acirc;��&iacute;&egrave;� &iacute;&agrave; �&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&egrave;&ograve;� ��&oacute;�&egrave;',
	'approval_1' => '&Icirc;&auml;&icirc;&aacute;��&iacute;&egrave;� �&oacute;&aacute;. &Auml;&icirc;&aacute;. (1)',
	'approval_2' => '&Icirc;&auml;&icirc;&aacute;��&iacute;&egrave;� �&agrave;�&ograve;. &Auml;&icirc;&aacute;. (2)',
	'note1' => '<b>(1)</b> &Auml;&icirc;&aacute;&agrave;&acirc;�&iacute;� &acirc; �&oacute;&aacute;�&egrave;��&iacute; &agrave;�&aacute;&oacute;&igrave; &egrave;�&egrave;�&ecirc;&acirc;&agrave; &agrave;&auml;&igrave;&egrave;&iacute;&egrave;�&ograve;�&agrave;&ograve;&icirc;��&ecirc;&icirc; &icirc;&auml;&icirc;&aacute;��&iacute;&egrave;�',
	'note2' => '<b>(2)</b> &Auml;&icirc;&aacute;&agrave;&acirc;�&iacute;� &acirc; &agrave;�&aacute;&oacute;&igrave; &ecirc;&icirc;&eacute;&ograve;&icirc; � &iacute;&agrave; �&icirc;&ograve;��&aacute;&egrave;&ograve;��� &egrave;�&egrave;�&ecirc;&acirc;&agrave; &agrave;&auml;&igrave;&egrave;&iacute;&egrave;�&ograve;�&agrave;&ograve;&icirc;��&ecirc;&icirc; &icirc;&auml;&icirc;&aacute;��&iacute;&egrave;�',
	'notes' => '&Aacute;����&ecirc;&egrave;'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => '&Auml;&icirc;&aacute;�� &auml;&icirc;��&egrave; !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => '�&egrave;�&oacute;��&iacute; �&egrave; �&ograve;�, �� &egrave;�&ecirc;&agrave;&ograve;� &auml;&agrave; &Egrave;�&Ograve;�&Egrave;�&Ograve;� &ograve;&icirc;�&egrave; &agrave;�&aacute;&oacute;&igrave; ? \\n&Acirc;�&egrave;�&ecirc;&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; &egrave; &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&egrave; �&uacute;&ugrave;&icirc; &ugrave;� &aacute;&uacute;&auml;&agrave;&ograve; &egrave;�&ograve;�&egrave;&ograve;&egrave;.',
	'delete' => '&Egrave;�&Ograve;�&Egrave;&Eacute;',
	'modify' => '&Iacute;&Agrave;�&Ograve;�&Icirc;&Eacute;&Ecirc;&Egrave;',
	'edit_pics' => '��&Ecirc;&Auml;&Agrave;&Ecirc;&Ograve;&Egrave;�&Agrave;&Eacute; &Ecirc;&Agrave;�&Ograve;&Egrave;&Iacute;&Ecirc;&Egrave;',
);

$lang_list_categories = array(
	'home' => '&iacute;&agrave;�&agrave;�&icirc;',
	'stat1' => '<b>[pictures]</b> &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; &acirc; <b>[albums]</b> &agrave;�&aacute;&oacute;&igrave;&agrave; &egrave; <b>[cat]</b> &ecirc;&agrave;&ograve;��&icirc;�&egrave;&egrave; � <b>[comments]</b> &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&agrave; ������&auml;&agrave;&iacute;&egrave; <b>[views]</b> �&uacute;&ograve;&egrave;',
	'stat2' => '<b>[pictures]</b> &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; &acirc; <b>[albums]</b> &agrave;�&aacute;&oacute;&igrave;&agrave; ������&auml;&agrave;&iacute;&egrave; <b>[views]</b> �&uacute;&ograve;&egrave;',
	'xx_s_gallery' => '�&agrave;���&egrave;� &iacute;&agrave; %s\'',
	'stat3' => '<b>[pictures]</b> &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; &acirc; <b>[albums]</b> &agrave;�&aacute;&oacute;&igrave;&agrave; � <b>[comments]</b> &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&agrave; ������&auml;&agrave;&iacute;&egrave; <b>[views]</b> �&uacute;&ograve;&egrave;'
);

$lang_list_users = array(
	'user_list' => '�&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&agrave; �&egrave;�&ograve;&agrave;',
	'no_user_gal' => '&Iacute;�&igrave;&agrave; �&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&egrave; �&agrave;���&egrave;&egrave;',
	'n_albums' => '%s &agrave;�&aacute;&oacute;&igrave;(&egrave;)',
	'n_pics' => '%s &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;(&egrave;)'
);

$lang_list_albums = array(
	'n_pictures' => '%s &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	'last_added' => ', �&icirc;���&auml;&iacute;&icirc; &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;&agrave; &iacute;&agrave; %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => '&Acirc;�&icirc;&auml;',
	'enter_login_pswd' => '&Acirc;&uacute;&acirc;�&auml;�&ograve;� �&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&icirc; &egrave;&igrave;� &egrave; �&agrave;�&icirc;�&agrave;',
	'username' => '�&icirc;&ograve;��&aacute;&egrave;&ograve;��',
	'password' => '�&agrave;�&icirc;�&agrave;',
	'remember_me' => '�&agrave;�&icirc;&igrave;&iacute;&egrave; &igrave;�',
	'welcome' => '&Auml;&icirc;&aacute;�� &auml;&icirc;�&uacute;� %s ...',
	'err_login' => '*** &Iacute;� &igrave;&icirc;�� &auml;&agrave; &acirc;����&ograve;�. &Icirc;�&egrave;&ograve;&agrave;&eacute;&ograve;� �&agrave;&ecirc;  ***',
	'err_already_logged_in' => '&Egrave;&igrave;&agrave; &acirc;&ecirc;����&iacute; �&icirc;&ograve;��&aacute;&egrave;&ograve;�� � &ograve;&icirc;&acirc;&agrave; &egrave;&igrave;� &egrave; �&agrave;�&icirc;�&agrave; !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => '&Egrave;��&icirc;&auml;',
	'bye' => '&Auml;&icirc;&acirc;&egrave;�&auml;&agrave;&iacute;� %s ...',
	'err_not_loged_in' => '&Acirc;&egrave;� &iacute;� �&ograve;� &acirc;&ecirc;����&iacute; !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => '&Icirc;&aacute;&iacute;&icirc;&acirc;&egrave; &agrave;�&aacute;&oacute;&igrave; %s',
	'general_settings' => '��&agrave;&acirc;&iacute;&egrave; &iacute;&agrave;�&ograve;�&icirc;&eacute;&ecirc;&egrave;',
	'alb_title' => '�&agrave;��&agrave;&acirc;&egrave;� &iacute;&agrave; &agrave;�&aacute;&oacute;&igrave;&agrave;',
	'alb_cat' => '&Ecirc;&agrave;&ograve;��&icirc;�&egrave;� &iacute;&agrave; &agrave;�&aacute;&oacute;&igrave;&agrave;',
	'alb_desc' => '&Icirc;�&egrave;�&agrave;&iacute;&egrave;� &iacute;&agrave; &agrave;�&aacute;&oacute;&igrave;&agrave;',
	'alb_thumb' => '&Igrave;&agrave;�&ecirc;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; &iacute;&agrave; &agrave;�&aacute;&oacute;&igrave;&agrave;',
	'alb_perm' => '�&agrave;�����&iacute;&egrave;� �&agrave; &ograve;&icirc;�&egrave; &agrave;�&aacute;&oacute;&igrave;',
	'can_view' => '&Agrave;�&aacute;&oacute;&igrave;&agrave; &igrave;&icirc;�� &auml;&agrave; �� &acirc;&egrave;&auml;&egrave; &icirc;&ograve;',
	'can_upload' => '�&icirc;��&ograve;&egrave;&ograve;��&egrave;&ograve;� &igrave;&icirc;�� &auml;&agrave; &auml;&icirc;&aacute;&agrave;&acirc;�&ograve; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	'can_post_comments' => '�&icirc;��&ograve;&egrave;&ograve;��&egrave;&ograve;� &igrave;&icirc;�� &auml;&agrave; &auml;&icirc;&aacute;&agrave;&acirc;�&ograve; &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&egrave;',
	'can_rate' => '�&icirc;��&ograve;&egrave;&ograve;��&egrave;&ograve;� &igrave;&icirc;�� &auml;&agrave; ��&agrave;�&oacute;&acirc;&agrave;&ograve; �&agrave; &ecirc;&agrave;&ograve;&egrave;&iacute;&ecirc;&egrave;',
	'user_gal' => '�&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&egrave; �&agrave;���&egrave;&egrave;',
	'no_cat' => '* &Iacute;&agrave;&igrave;&agrave; &ecirc;&agrave;&ograve;��&icirc;�&egrave;� *',
	'alb_empty' => '&Agrave;�&aacute;&oacute;&igrave;&agrave; � ��&agrave;��&iacute;',
	'last_uploaded' => '�&icirc;���&auml;&iacute;&icirc; &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;&egrave;',
	'public_alb' => '&Acirc;��&ecirc;&egrave; (�&oacute;&aacute;�&egrave;��&iacute; &agrave;�&aacute;&oacute;&igrave;)',
	'me_only' => '�&agrave;&igrave;&icirc; &Agrave;�',
	'owner_only' => '�&icirc;&aacute;�&ograve;&acirc;�&iacute;&egrave;&ecirc;&agrave; (%s) &iacute;&agrave; &agrave;�&aacute;&oacute;&igrave;&agrave; �&agrave;&igrave;&icirc;',
	'groupp_only' => '�&icirc;&ograve;��&aacute;&egrave;&ograve;��&egrave; &icirc;&ograve; \'%s\' ��&oacute;�&agrave;',
	'err_no_alb_to_modify' => '&Iacute;�&igrave;&agrave; &agrave;�&aacute;&oacute;&igrave;&egrave; &ecirc;&icirc;&egrave;&ograve;&icirc; &igrave;&icirc;�� &auml;&agrave; &igrave;&icirc;&auml;&egrave;&ocirc;&egrave;&ouml;&egrave;�&agrave;&ograve;�.',
	'update' => '&Icirc;&aacute;&iacute;&icirc;&acirc;&egrave; &agrave;�&aacute;&oacute;&igrave;&agrave;'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => '�&uacute;�&agrave;��&acirc;&agrave;&igrave;�, &iacute;&icirc; �&ograve;� ��&agrave;�&oacute;&acirc;&agrave;�&egrave; &acirc;��� �&agrave; &ograve;&agrave;�&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;',
	'rate_ok' => '&Acirc;&agrave;��&ograve;&icirc; ��&agrave;�&oacute;&acirc;&agrave;&iacute;� � ��&egrave;�&ograve;&icirc;',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
&Agrave;&auml;&igrave;&egrave;&iacute;&egrave;�&ograve;�&agrave;&ograve;&icirc;�&agrave; &iacute;&agrave; <b>{SITE_NAME}</b> &ugrave;� �� &icirc;�&egrave;&ograve;&agrave; &auml;&agrave; ���&igrave;&agrave;�&iacute;� &egrave;�&egrave; ��&auml;&agrave;&ecirc;&ograve;&egrave;�&agrave; &acirc;��&ecirc;&egrave; &iacute;����&agrave;&iacute; &igrave;&agrave;&ograve;��&egrave;&agrave;� &acirc;&uacute;�&igrave;&icirc;�&iacute;&icirc; &iacute;&agrave;&eacute;-&aacute;&uacute;��&icirc; (�&icirc;&iacute;��� &iacute;� &igrave;&icirc;�� &auml;&agrave; �� �������&auml;&agrave; &acirc;��&ecirc;&icirc; &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;�), &Acirc;&egrave;� �� �&uacute;��&agrave;��&acirc;&agrave;&ograve;�, �� &acirc;�&egrave;�&ecirc;&egrave; &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;&egrave;� &iacute;&agrave; &ograve;&icirc;�&egrave; �&agrave;&eacute;&ograve; &egrave;��&agrave;��&acirc;&agrave;&ograve; &acirc;&uacute;����&auml;&egrave;&ograve;� &egrave; &igrave;&iacute;�&iacute;&egrave;�&ograve;&icirc; &iacute;&agrave; &agrave;&acirc;&ograve;&icirc;�&agrave;, &agrave; &iacute;� &iacute;&agrave; &agrave;&auml;&igrave;&egrave;&iacute;&egrave;�&ograve;�&agrave;&ograve;&icirc;�&agrave; &egrave; &oacute;�&aacute;&igrave;&agrave;�&ograve;�� (� &egrave;�&ecirc;����&iacute;&egrave;� &iacute;&agrave; &iacute;�&ugrave;&agrave; &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;&egrave; &icirc;&ograve; &ograve;��) &egrave; ���&auml;&icirc;&acirc;&agrave;&ograve;��&iacute;&icirc; &iacute;�&igrave;&agrave; &auml;&agrave; &aacute;&uacute;&auml;&agrave;&ograve; &icirc;&ograve;&acirc;�&ograve;&iacute;&egrave; �&egrave;&ouml;&agrave;.<br />
<br />
&Acirc;&egrave;� �� �&uacute;��&agrave;��&acirc;&agrave;&ograve;� &auml;&agrave; &iacute;� &auml;&icirc;&aacute;&agrave;&acirc;�&ograve;� &icirc;�&ecirc;&uacute;�&aacute;&egrave;&ograve;��&iacute;&egrave;, &iacute;���&egrave;�&ograve;&icirc;&eacute;&iacute;&egrave;, &ecirc;��&acirc;�&ograve;&iacute;&egrave;���&ecirc;&egrave;, &iacute;�&iacute;&agrave;&acirc;&egrave;�&ograve;&iacute;&egrave;, �&agrave;��&agrave;�&egrave;&ograve;��&iacute;&egrave;, ��&ecirc;�&oacute;&agrave;�&iacute;&icirc;-&icirc;�&egrave;�&iacute;&ograve;&egrave;�&agrave;&iacute;&egrave; &egrave;�&egrave; &ecirc;&agrave;&ecirc;&acirc;&egrave;&ograve;&icirc; &egrave; &auml;&agrave; � &auml;�&oacute;�&egrave; &igrave;&agrave;&ograve;��&egrave;&agrave;�&egrave; &ecirc;&icirc;&egrave;&ograve;&icirc; &iacute;&agrave;�&oacute;�&agrave;&acirc;&agrave;&ograve; &acirc;��&ecirc;&agrave;&acirc;&egrave; ��&egrave;�&icirc;�&egrave;&igrave;&egrave; �&agrave;&ecirc;&icirc;&iacute;&egrave;. &Acirc;&egrave;� �� �&uacute;��&agrave;��&acirc;&agrave;&ograve;�, �� &oacute;�&aacute;&igrave;&agrave;�&ograve;��&agrave;, &agrave;&auml;&igrave;&egrave;&iacute;&egrave;�&ograve;�&agrave;&ograve;&icirc;�&agrave; &egrave; &igrave;&icirc;&auml;��&agrave;&ograve;&icirc;�&egrave;&ograve;� &iacute;&agrave; <b>{SITE_NAME}</b> &egrave;&igrave;&agrave;&ograve; ��&agrave;&acirc;&icirc; &auml;&agrave; ���&igrave;&agrave;�&iacute;&agrave;&ograve; &egrave;�&egrave; ��&auml;&agrave;&ecirc;&ograve;&egrave;�&agrave;&ograve; �&icirc; &acirc;��&ecirc;&icirc; &acirc;��&igrave;�, &acirc;��&ecirc;&icirc; �&uacute;&auml;&uacute;��&agrave;&iacute;&egrave;�. &Ecirc;&agrave;&ograve;&icirc; �&icirc;&ograve;��&aacute;&egrave;&ograve;�� &Acirc;&egrave;� �� �&uacute;��&agrave;��&acirc;&agrave;&ograve;�, �� &acirc;�&ecirc;&agrave; &egrave;&iacute;&ocirc;&icirc;�&igrave;&agrave;&ouml;&egrave;� &acirc;&uacute;&acirc;�&auml;�&iacute;&agrave; &icirc;&ograve; &Acirc;&agrave;�, &ugrave;� &aacute;&uacute;&auml;� �&agrave;�&egrave;�&agrave;&iacute;&agrave; &acirc; &aacute;&agrave;�&agrave; &auml;&agrave;&iacute;&iacute;&egrave;. &Ograve;&agrave;�&egrave; &egrave;&iacute;&ocirc;&icirc;�&igrave;&agrave;&ouml;&egrave;� &iacute;�&igrave;&agrave; &auml;&agrave; &aacute;&uacute;&auml;� �&agrave;�&ecirc;�&egrave;&acirc;&agrave;&iacute;&agrave; &iacute;&agrave; &ograve;��&ograve;&egrave; �&egrave;&ouml;&agrave; &aacute;�� &Acirc;&agrave;��&ograve;&icirc; �&uacute;��&agrave;�&egrave;�. &Oacute;�&aacute;&igrave;&agrave;�&ograve;��&agrave; &egrave; &agrave;&auml;&igrave;&egrave;&iacute;&egrave;�&ograve;�&agrave;&ograve;&icirc;�&agrave; &iacute;� &iacute;&icirc;��&ograve; &icirc;&ograve;�&icirc;&acirc;&icirc;�&iacute;&icirc;�&ograve; �&agrave; &icirc;�&egrave;&ograve;(&egrave;) �&agrave; �&agrave;&ecirc;&acirc;&agrave;&iacute;�, &ecirc;&icirc;&egrave;&ograve;&icirc; &igrave;&icirc;�&agrave;&ograve; &auml;&agrave; &auml;&icirc;&acirc;�&auml;&agrave;&ograve; &auml;&icirc; &ecirc;&icirc;&igrave;��&icirc;&igrave;�&ograve;&egrave;�&agrave;&iacute;� &iacute;&agrave; &auml;&agrave;&iacute;&iacute;&egrave;.<br />
<br />
&Ograve;&icirc;�&egrave; �&agrave;&eacute;&ograve; &egrave;��&icirc;��&acirc;&agrave; 'cookies' �&agrave; &auml;&agrave; �&agrave;�&agrave;�&egrave; &egrave;&iacute;&ocirc;&icirc;�&igrave;&agrave;&ouml;&egrave;� &iacute;&agrave; &Acirc;&agrave;�&egrave;� �&icirc;&ecirc;&agrave;��&iacute; &ecirc;&icirc;&igrave;��&ograve;&uacute;�. &Ograve;��&egrave; 'cookies' ��&oacute;�&agrave;&ograve; �&agrave;&igrave;&icirc; �&agrave; �&icirc;&auml;&icirc;&aacute;��&iacute;&egrave;� &iacute;&agrave; ������&auml;&agrave; &iacute;&agrave; �&agrave;&eacute;&ograve;&agrave;. &Acirc;&agrave;�&egrave;�&ograve; �-&igrave;�&eacute;� &agrave;&auml;��� �� &egrave;��&icirc;��&acirc;&agrave; �&agrave;&igrave;&icirc; �&agrave; &auml;&agrave; �&icirc;�&oacute;�&egrave;&ograve;� �&icirc;&ograve;&acirc;&uacute;��&auml;&agrave;&acirc;&agrave;&ugrave;&icirc; �&egrave;�&igrave;&icirc; � ���&egrave;�&ograve;�&agrave;&ouml;&egrave;&icirc;&iacute;&iacute;&egrave; &auml;�&ograve;&agrave;&eacute;�&egrave; &egrave; �&agrave;&acirc;&icirc;�&agrave;.<br>
� &iacute;&agrave;&ograve;&egrave;�&ecirc;&agrave;&iacute;� &iacute;&agrave; '�&uacute;��&agrave;��&iacute; �&uacute;&igrave;' &Acirc;&egrave;� �� �&uacute;��&agrave;��&acirc;&agrave;&ograve;� � &acirc;�&egrave;�&ecirc;&egrave; &egrave;�&aacute;�&icirc;�&iacute;&egrave; &oacute;��&icirc;&acirc;&egrave;�.
EOT;

$lang_register_php = array(
	'page_title' => '�&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&agrave; ���&egrave;�&ograve;�&agrave;&ouml;&egrave;�',
	'term_cond' => '&Oacute;��&icirc;&acirc;&egrave;� &egrave; &ograve;��&igrave;&egrave;&iacute;&egrave;',
	'i_agree' => '�&uacute;��&agrave;��&iacute; �&uacute;&igrave;',
	'submit' => '��&icirc;&auml;&uacute;��&egrave; ���&egrave;�&ograve;�&agrave;&ouml;&egrave;�&ograve;&agrave;',
	'err_user_exists' => '�&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&icirc;&ograve;&icirc; &egrave;&igrave;� &ecirc;&icirc;�&ograve;&icirc; �&ograve;� &iacute;&agrave;�&egrave;�&agrave;�&egrave;, &acirc;��� � �&agrave;�&ograve;&icirc;. &Igrave;&icirc;�� &egrave;�&aacute;���&ograve;� &auml;�&oacute;�&icirc;',
	'err_password_mismatch' => '&Auml;&acirc;�&ograve;� �&agrave;�&icirc;�&egrave; &iacute;� �&uacute;&acirc;�&agrave;&auml;&agrave;&ograve;. &Igrave;&icirc;�� �&icirc;�&uacute;�&iacute;�&ograve;� �&egrave; &icirc;&ograve;&iacute;&icirc;&acirc;&icirc;',
	'err_uname_short' => '�&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&icirc;&ograve;&icirc; &egrave;&igrave;� &ograve;��&aacute;&acirc;&agrave; &auml;&agrave; � �&icirc;&iacute;� 2 �&egrave;&igrave;&acirc;&icirc;�&agrave;',
	'err_password_short' => '�&agrave;�&icirc;�&agrave;&ograve;&agrave; &ograve;��&aacute;&acirc;&agrave; &auml;&agrave; � �&icirc;&iacute;� 2 �&egrave;&igrave;&acirc;&icirc;�&agrave;',
	'err_uname_pass_diff' => '�&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&icirc;&ograve;&icirc; &egrave;&igrave;� &egrave; �&agrave;�&icirc;�&agrave; &ograve;��&aacute;&acirc;&agrave; &auml;&agrave; �&agrave; �&agrave;��&egrave;�&iacute;&egrave;',
	'err_invalid_email' => 'E-mail &agrave;&auml;���&agrave; &iacute;� � &acirc;&agrave;�&egrave;&auml;�&iacute;',
	'err_duplicate_email' => '&Auml;�&oacute;� �&icirc;&ograve;��&aacute;&egrave;&ograve;�� &acirc;��� � ���&egrave;�&ograve;�&egrave;�&agrave;&iacute; � &ograve;&icirc;�&egrave; �-&igrave;�&eacute;� &agrave;&auml;���',
	'enter_info' => '&Acirc;&uacute;&acirc;�&auml;�&ograve;� ���&egrave;�&ograve;�&agrave;&ouml;&egrave;&icirc;&iacute;&iacute;&agrave;&ograve;&agrave; &egrave;&iacute;&ocirc;&icirc;�&igrave;&agrave;&ouml;&egrave;�',
	'required_info' => '&Egrave;�&egrave;�&ecirc;&acirc;&agrave;&iacute;&agrave; &egrave;&iacute;&ocirc;&icirc;�&igrave;&agrave;&ouml;&egrave;�',
	'optional_info' => '&Icirc;�&ouml;&egrave;&icirc;&iacute;&agrave;�&iacute;&agrave; &egrave;&iacute;&ocirc;&icirc;�&igrave;&agrave;&ouml;&egrave;�',
	'username' => '�&icirc;&ograve;��&aacute;&egrave;&ograve;��',
	'password' => '�&agrave;�&icirc;�&agrave;',
	'password_again' => '�&agrave;�&icirc;�&agrave; &icirc;&ograve;&iacute;&icirc;&acirc;&icirc;',
	'email' => 'E-&igrave;�&eacute;�',
	'location' => '&Igrave;��&ograve;&icirc;&iacute;&agrave;�&icirc;�&auml;�&iacute;&egrave;�',
	'interests' => '&Egrave;&iacute;&ograve;����&egrave;',
	'website' => '�&egrave;�&iacute;&agrave; �&ograve;�&agrave;&iacute;&egrave;&ouml;&agrave;',
	'occupation' => '�&agrave;&iacute;&egrave;&igrave;&agrave;&iacute;&egrave;�',
	'error' => '�����&Ecirc;&Agrave;',
	'confirm_email_subject' => '%s - �&icirc;&ograve;&acirc;&uacute;��&auml;�&iacute;&egrave;� &iacute;&agrave; ���&egrave;�&ograve;�&agrave;&ouml;&egrave;�&ograve;&agrave;',
	'information' => '&Egrave;&iacute;&ocirc;&icirc;�&igrave;&agrave;&ouml;&egrave;�',
	'failed_sending_email' => '�&icirc;&ograve;&acirc;&uacute;��&auml;�&iacute;&egrave;�&ograve;&icirc; &iacute;&agrave; ���&egrave;�&ograve;�&agrave;&ouml;&egrave;�&ograve;&agrave; &iacute;� &igrave;&icirc;�� &auml;&agrave; &aacute;&uacute;&auml;� &egrave;���&agrave;&ograve;�&iacute;&icirc; !',
	'thank_you' => '&Aacute;�&agrave;�&icirc;&auml;&agrave;�� �&agrave; ���&egrave;�&ograve;�&agrave;&ouml;&egrave;�&ograve;&agrave;.<br /><br />�-&igrave;�&eacute;� � &egrave;&iacute;&ocirc;&icirc;�&igrave;&agrave;&ouml;&egrave;� &ecirc;&agrave;&ecirc; &auml;&agrave; &agrave;&ecirc;&ograve;&egrave;&acirc;&egrave;�&agrave;&ograve;� &Acirc;&agrave;�&egrave;� �&icirc;&ograve;��&aacute;&egrave;&ograve;�� � &egrave;���&agrave;&ograve;�&iacute; &iacute;&agrave; &agrave;&auml;���&agrave; &ecirc;&icirc;&eacute;&ograve;&icirc; &acirc;&uacute;&acirc;�&auml;&icirc;�&ograve;�.',
	'acct_created' => '&Acirc;&agrave;�&egrave;�&ograve; �&icirc;&ograve;��&aacute;&egrave;&ograve;�� &aacute;��� �&uacute;�&auml;&agrave;&auml;�&iacute; &egrave; &igrave;&icirc;�� &auml;&agrave; �� &acirc;&ecirc;���&egrave;&ograve;� � �&icirc;&ograve;��&aacute;&egrave;&ograve;�� &egrave; �&agrave;�&icirc;�&agrave;',
	'acct_active' => '&Acirc;&agrave;�&egrave;�&ograve; �&icirc;&ograve;��&aacute;&egrave;&ograve;�� &aacute;��� &agrave;&ecirc;&ograve;&egrave;&acirc;&egrave;�&agrave;&iacute; &egrave; &igrave;&icirc;�� &auml;&agrave; �� &acirc;&ecirc;���&egrave;&ograve;� � �&icirc;&ograve;��&aacute;&egrave;&ograve;�� &egrave; �&agrave;�&icirc;�&agrave;',
	'acct_already_act' => '&Acirc;&agrave;�&egrave;�&ograve; �&icirc;&ograve;��&aacute;&egrave;&ograve;�� � &acirc;��� &agrave;&ecirc;&ograve;&egrave;&acirc;�&iacute; !',
	'acct_act_failed' => '&Ograve;&icirc;�&egrave; �&icirc;&ograve;��&aacute;&egrave;&ograve;�� &iacute;� &igrave;&icirc;�� &auml;&agrave; &aacute;&uacute;&auml;� &agrave;&ecirc;&ograve;&egrave;&acirc;&egrave;�&agrave;&iacute; !',
	'err_unk_user' => '&Egrave;�&aacute;�&agrave;&iacute;&egrave;� �&icirc;&ograve;��&aacute;&egrave;&ograve;�� &iacute;� �&uacute;&ugrave;��&ograve;&acirc;&oacute;&acirc;&agrave; !',
	'x_s_profile' => '��&icirc;&ocirc;&egrave;� &iacute;&agrave; %s\'',
	'group' => '��&oacute;�&agrave;',
	'reg_date' => '&Auml;&agrave;&ograve;&agrave; &iacute;&agrave; ���&egrave;�&ograve;�&agrave;&ouml;&egrave;�',
	'disk_usage' => '�&icirc;&ograve;��&aacute;��&iacute;&egrave;� &iacute;&agrave; &auml;&egrave;�&ecirc;&agrave;',
	'change_pass' => '�&igrave;�&iacute;&egrave; �&agrave;�&icirc;�&agrave;',
	'current_pass' => '&Ograve;�&ecirc;&oacute;&ugrave;&agrave; �&agrave;�&icirc;�&agrave;',
	'new_pass' => '&Iacute;&icirc;&acirc;&agrave; �&agrave;�&icirc;�&agrave;',
	'new_pass_again' => '&Iacute;&icirc;&acirc;&agrave; �&agrave;�&icirc;�&agrave; &icirc;&ograve;&iacute;&icirc;&acirc;&icirc;',
	'err_curr_pass' => '&Ograve;�&ecirc;&oacute;&ugrave;&agrave;&ograve;&agrave; �&agrave;�&icirc;�� &iacute;� � &acirc;��&iacute;&agrave;',
	'apply_modif' => '&Auml;&icirc;&aacute;&agrave;&acirc;&egrave; &igrave;&icirc;&auml;&egrave;&ocirc;&egrave;&ecirc;&agrave;&ouml;&egrave;&eacute;&ograve;�',
	'change_pass' => '�&igrave;�&iacute;&egrave; &igrave;&icirc;�&ograve;&agrave; �&agrave;�&icirc;�&agrave;',
	'update_success' => '&Acirc;&agrave;�&egrave;�&ograve; ��&icirc;&ocirc;&egrave;� � &icirc;&aacute;&iacute;&icirc;&acirc;�&iacute;',
	'pass_chg_success' => '&Acirc;&agrave;�&agrave;&ograve;&agrave; �&agrave;�&icirc;�&agrave; � ��&icirc;&igrave;�&iacute;�&iacute;&agrave;',
	'pass_chg_error' => '&Acirc;&agrave;�&agrave;&ograve;&agrave; �&agrave;�&icirc;�&agrave; &Iacute;� � ��&icirc;&igrave;�&iacute;�&iacute;&agrave;',
);

$lang_register_confirm_email = <<<EOT
&Aacute;�&agrave;�&icirc;&auml;&agrave;�&egrave;&igrave; &Acirc;&egrave; �&agrave; ���&egrave;�&ograve;�&agrave;&ouml;&egrave;� &acirc; {SITE_NAME}

�&icirc;&ograve;��&aacute;&egrave;&ograve;�� : "{USER_NAME}"
�&agrave;�&icirc;�&agrave; : "{PASSWORD}"

�&agrave; &agrave;&ecirc;&ograve;&egrave;&acirc;&egrave;�&agrave;&iacute;� &iacute;&agrave; &Acirc;&agrave;�&egrave;� �&icirc;&ograve;��&aacute;&egrave;&ograve;��, &iacute;&agrave;&ograve;&egrave;�&iacute;�&ograve;� &acirc;�&uacute;�&ecirc;&agrave;&ograve;&agrave; �&icirc;-&auml;&icirc;�&oacute;
&egrave;�&egrave; &ecirc;&icirc;�&egrave;�&agrave;&eacute;&ograve;� &agrave;&auml;���&agrave; &acirc; &oacute;�&aacute; &aacute;�&icirc;&oacute;���.

{ACT_LINK}

� &oacute;&acirc;&agrave;��&iacute;&egrave;�,

&Agrave;&auml;&igrave;&egrave;&iacute;&egrave;�&ograve;�&agrave;&ouml;&egrave;� &iacute;&agrave;  {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => '������&auml; &iacute;&agrave; &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&egrave;',
	'no_comment' => '&Iacute;�&igrave;&agrave; &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;� �&agrave; ������&auml;',
	'n_comm_del' => '%s &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�(&egrave;) &egrave;�&ograve;�&egrave;&ograve;(&egrave;)',
	'n_comm_disp' => '&Aacute;�&icirc;&eacute; &iacute;&agrave; �&icirc;&ecirc;&agrave;�&acirc;&agrave;&iacute;&egrave; &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&egrave;',
	'see_prev' => '&Acirc;&egrave;� ���&auml;&egrave;��&iacute;',
	'see_next' => '&Acirc;&egrave;� ���&auml;&acirc;&agrave;&ugrave;',
	'del_comm' => '&Egrave;�&ograve;�&egrave;&eacute; &egrave;�&aacute;�&agrave;&iacute;&egrave;&ograve;� &ecirc;&icirc;&igrave;�&iacute;&ograve;&agrave;�&egrave;',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => '&Ograve;&uacute;���&iacute;� &acirc; &ecirc;&icirc;��&ecirc;&ouml;&egrave;&egrave;&ograve;� &icirc;&ograve; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => '&Ograve;&uacute;���&iacute;� &iacute;&agrave; &iacute;&icirc;&acirc;&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	'select_dir' => '&Egrave;�&aacute;��&egrave; �&agrave;�&ecirc;&agrave;',
	'select_dir_msg' => '&Ograve;&agrave;�&egrave; &ocirc;&oacute;&iacute;&ecirc;&ouml;&egrave;� �&icirc;�&acirc;&icirc;��&acirc;&agrave; &auml;&agrave; &auml;&icirc;&aacute;&agrave;&acirc;�&ograve;� ��&oacute;�&agrave; &icirc;&ograve; &ecirc;&agrave;�&egrave;&iacute;&ecirc;&egrave; &ecirc;&agrave;��&iacute;&egrave; &iacute;&agrave; �&uacute;�&acirc;&uacute;�&agrave;.<br /><br />&Egrave;�&aacute;���&ograve;� �&agrave;�&ecirc;&agrave; &ecirc;&uacute;&auml;�&ograve;&icirc; �&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;&ograve;�',
	'no_pic_to_add' => '&Iacute;�&igrave;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; �&agrave; &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;�',
	'need_one_album' => '&Ograve;��&aacute;&acirc;&agrave; &auml;&agrave; &egrave;&igrave;&agrave; �&icirc;&iacute;� �&auml;&egrave;&iacute; &agrave;�&aacute;&oacute;&igrave; �&agrave; &auml;&agrave; �&icirc;��&acirc;&agrave;&ograve;� &ograve;&agrave;�&egrave; &ocirc;&oacute;&iacute;&ecirc;&ouml;&egrave;�',
	'warning' => '&Acirc;&Iacute;&Egrave;&Igrave;&Agrave;&Iacute;&Egrave;�',
	'change_perm' => '�&ecirc;�&egrave;�&ograve;&agrave; &iacute;� &igrave;&icirc;�� &auml;&agrave; �&egrave;�� &acirc; &ograve;&agrave;�&egrave; &auml;&egrave;��&ecirc;&ograve;&icirc;�&egrave;�, �&igrave;�&iacute;�&ograve;� &agrave;&ograve;�&egrave;&aacute;&oacute;&ograve;&egrave;&ograve;� &iacute;&agrave; &auml;&egrave;��&ecirc;&ograve;&icirc;�&egrave;�&ograve;&agrave; &iacute;&agrave; 755 &egrave;�&egrave; 777 ���&auml;&egrave; &auml;&agrave; &icirc;�&egrave;&ograve;&acirc;&agrave;&ograve;� &auml;&agrave; &auml;&icirc;&aacute;&agrave;&acirc;�&ograve;� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; !',
	'target_album' => '<b>��&icirc;�&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;&ograve;� &icirc;&ograve; &quot;</b>%s<b>&quot; &acirc; </b>%s',
	'folder' => '�&agrave;�&ecirc;&agrave;',
	'image' => '&Ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;',
	'album' => '&Agrave;�&aacute;&oacute;&igrave;',
	'result' => '���&oacute;�&ograve;&agrave;&ograve;',
	'dir_ro' => '�&agrave;&igrave;&icirc; �&agrave; ��&ograve;�&iacute;�. ',
	'dir_cant_read' => '&Iacute;� &igrave;&icirc;�� &auml;&agrave; �� ��&icirc;��&ograve;�. ',
	'insert' => '&Auml;&icirc;&aacute;&agrave;&acirc;�&iacute;� &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; &acirc; �&agrave;���&egrave;�&ograve;&agrave;',
	'list_new_pic' => '��&egrave;�&uacute;&ecirc; &iacute;&agrave; &iacute;&icirc;&acirc;&egrave;&ograve;� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	'insert_selected' => '&Auml;&icirc;&aacute;&agrave;&acirc;&egrave; &egrave;�&aacute;�&agrave;&iacute;&egrave;&ograve;� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	'no_pic_found' => '&Iacute;� �&agrave; &iacute;&agrave;&igrave;���&iacute;&egrave; &iacute;&icirc;&acirc;&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	'be_patient' => '&Igrave;&icirc;��, &aacute;&uacute;&auml;�&ograve;� &ograve;&uacute;����&egrave;&acirc;&egrave;, �&ecirc;�&egrave;�&ograve;&agrave; &egrave;&igrave;&agrave; &iacute;&oacute;�&auml;&agrave; &icirc;&ograve; &acirc;��&igrave;� �&agrave; &auml;&agrave; &auml;&icirc;&aacute;&agrave;&acirc;&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;&ograve;�',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : &icirc;�&iacute;&agrave;�&agrave;&acirc;&agrave;, �� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;&ograve;&agrave; � &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;&agrave; &oacute;����&iacute;&icirc;'.
				'<li><b>DP</b> : &icirc;�&iacute;&agrave;�&agrave;&acirc;&agrave;, �� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;&ograve;&agrave; � &auml;&oacute;&aacute;�&egrave;&ecirc;&agrave;&ograve; &egrave; � &egrave;&igrave;&agrave; &acirc;��� &acirc; &aacute;&agrave;�&agrave;&ograve;&agrave; &auml;&agrave;&iacute;&iacute;&egrave;'.
				'<li><b>PB</b> : &icirc;�&iacute;&agrave;�&agrave;&acirc;&agrave;, �� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;&ograve;&agrave; &iacute;� � &auml;&icirc;&aacute;&agrave;&acirc;�&iacute;&agrave;. ��&icirc;&acirc;���&ograve;� &iacute;&agrave;�&ograve;�&icirc;&eacute;&ecirc;&egrave;&ograve;� &egrave; &agrave;&ograve;�&egrave;&aacute;&oacute;&ograve;&egrave;&ograve;� &iacute;&agrave; &auml;&egrave;��&ecirc;&ograve;&icirc;�&egrave;�&ograve;&agrave; &ecirc;&uacute;&auml;�&ograve;&icirc; �� &iacute;&agrave;&igrave;&egrave;�&agrave;&ograve; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;&ograve;�'.
				'<li>&Agrave;&ecirc;&icirc; OK, DP, PB \'�&iacute;&agrave;&ouml;&egrave;\' &iacute;� �� �&icirc;�&acirc;�&ograve;, &ugrave;�&agrave;&ecirc;&iacute;�&ograve;� &iacute;&agrave; \'�&icirc;�&agrave;&ograve;&agrave;\' &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave; &egrave; &acirc;&uacute;�&ograve;� �&uacute;&icirc;&aacute;&ugrave;�&iacute;&egrave;�&ograve;&icirc; �&agrave; ����&ecirc;&agrave; ��&iacute;��&egrave;�&agrave;&iacute;&icirc; &icirc;&ograve; PHP'.
				'<li>&Agrave;&ecirc;&icirc; �&icirc;�&oacute;�&egrave;&ograve;� �&uacute;&icirc;&aacute;&ugrave;�&iacute;&egrave;� �&agrave; &egrave;�&ograve;&egrave;�&agrave;&iacute;� &iacute;&agrave; &acirc;��&igrave;�, &ugrave;�&agrave;&ecirc;&iacute;�&ograve;� &iacute;&agrave; &aacute;&oacute;&ograve;&icirc;&iacute;&agrave; �&agrave; &icirc;����&iacute;�&acirc;&agrave;&iacute;�'.
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
	'title' => '&Auml;&icirc;&aacute;&agrave;&acirc;&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;',
	'max_fsize' => '&Igrave;&agrave;&ecirc;�&egrave;&igrave;&agrave;�&iacute;&icirc; �&agrave;�����&iacute;&agrave; �&icirc;��&igrave;&egrave;&iacute;&agrave; &iacute;&agrave; &ocirc;&agrave;&eacute;�&agrave; � %s KB',
	'album' => '&Agrave;�&aacute;&oacute;&igrave;',
	'picture' => '&Ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;',
	'pic_title' => '�&agrave;��&agrave;&acirc;&egrave;� &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;&ograve;&agrave;',
	'description' => '&Icirc;�&egrave;�&agrave;&iacute;&egrave;� &iacute;&agrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&agrave;&ograve;&agrave;',
	'keywords' => '&Ecirc;���&icirc;&acirc;&egrave; &auml;&oacute;&igrave;&egrave; (�&agrave;�&auml;���&iacute;&egrave; �&uacute;� &egrave;&iacute;&ograve;��&acirc;&agrave;�&egrave;)',
	'err_no_alb_uploadables' => '�&uacute;�&agrave;��&acirc;&agrave;&igrave;�, &iacute;�&igrave;&agrave; &agrave;�&aacute;&oacute;&igrave; &acirc; &ecirc;&icirc;&eacute;&ograve;&icirc; &auml;&agrave; � �&agrave;�����&iacute;&icirc; &auml;&agrave; &auml;&icirc;&aacute;&agrave;&acirc;�&ograve;� &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => '&Oacute;��&agrave;&acirc;��&iacute;&egrave;� &iacute;&agrave; �&icirc;&ograve;��&aacute;&egrave;&ograve;��&egrave;',
	'name_a' => '&Egrave;&igrave;� &acirc;&uacute;��&icirc;&auml;�&ugrave;&icirc;',
	'name_d' => '&Egrave;&igrave;� &iacute;&egrave;��&icirc;&auml;�&ugrave;&icirc;',
	'group_a' => '��&oacute;�&agrave; &acirc;&uacute;��&icirc;&auml;�&ugrave;&icirc;',
	'group_d' => '��&oacute;�&agrave; &iacute;&egrave;��&icirc;&auml;�&ugrave;&icirc;',
	'reg_a' => '���. &auml;&agrave;&ograve;&agrave; &acirc;&uacute;��&icirc;&auml;�&ugrave;&agrave;',
	'reg_d' => '���. &auml;&agrave;&ograve;&agrave; &iacute;&egrave;��&icirc;&auml;�&ugrave;&agrave;',
	'pic_a' => '&Aacute;�. &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; &acirc;&uacute;��&icirc;&auml;�&ugrave;&icirc;',
	'pic_d' => '&Aacute;�. &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; &iacute;&egrave;��&icirc;&auml;�&ugrave;�',
	'disku_a' => '&Auml;&egrave;�&ecirc;&icirc;&acirc;&icirc; &igrave;��&ograve;&icirc; &acirc;&uacute;��&icirc;&auml;�&ugrave;&icirc;',
	'disku_d' => '&Auml;&egrave;�&ecirc;&icirc;&acirc;&icirc; &igrave;��&ograve;&icirc; &iacute;&egrave;��&icirc;&auml;�&ugrave;&icirc;',
	'sort_by' => '�&icirc;�&ograve;&egrave;�&agrave; �&icirc;&ograve;��&aacute;&egrave;&ograve;��&egrave;&ograve;� �&icirc;',
	'err_no_users' => '&Iacute;�&igrave;&agrave; �&icirc;&ograve;��&aacute;&egrave;&ograve;��&egrave; !',
	'err_edit_self' => '&Iacute;� &igrave;&icirc;�� &auml;&agrave; ��&auml;&agrave;&ecirc;&ograve;&egrave;�&agrave;&ograve;� �&acirc;&icirc;� �&icirc;&aacute;�&ograve;&acirc;�&iacute; ��&icirc;&ocirc;&egrave;�. &Egrave;��&icirc;��&acirc;&agrave;&eacute;&ograve;� \'&Igrave;&icirc;� ��&icirc;&ocirc;&egrave;�\' �&agrave; &ograve;&agrave;�&egrave; &ouml;��',
	'edit' => '��&Auml;&Agrave;&Ecirc;&Ograve;&Egrave;�&Agrave;&Iacute;�',
	'delete' => '&Egrave;�&Ograve;�&Egrave;&Acirc;&Agrave;&Iacute;�',
	'name' => '�&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&icirc; &egrave;&igrave;�',
	'group' => '��&oacute;�&agrave;',
	'inactive' => '&Iacute;�&agrave;&ecirc;&ograve;&egrave;&acirc;�&iacute;',
	'operations' => '&Icirc;���&agrave;&ouml;&egrave;&egrave;',
	'pictures' => '&Ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave;',
	'disk_space' => '&Egrave;��&icirc;��&acirc;&agrave;&iacute;&icirc; &igrave;��&ograve;&icirc; / �&egrave;&igrave;&egrave;&ograve;',
	'registered_on' => '���&egrave;�&ograve;�&egrave;�&agrave;&iacute; &iacute;&agrave;',
	'u_user_on_p_pages' => '%d �&icirc;&ograve;��&aacute;&egrave;&ograve;��&egrave; &iacute;&agrave; %d �&ograve;�&agrave;&iacute;&egrave;&ouml;&agrave;(&egrave;)',
	'confirm_del' => '�&egrave;�&oacute;��&iacute; �&egrave;�&ograve;�, �� &egrave;�&ecirc;&agrave;&ograve;� &auml;&agrave; &Egrave;�&Ograve;�&Egrave;�&Ograve;� &ograve;&icirc;�&egrave; �&icirc;&ograve;��&aacute;&egrave;&ograve;�� ? \\n&Acirc;�&egrave;�&ecirc;&egrave; &iacute;��&icirc;&acirc;&egrave; &ecirc;&agrave;�&ograve;&egrave;&iacute;&ecirc;&egrave; &egrave; &agrave;�&aacute;&oacute;&igrave;&egrave; &ugrave;� &aacute;&uacute;&auml;&agrave;&ograve; &egrave;�&ograve;�&egrave;&ograve;&egrave;.',
	'mail' => '�&Icirc;&Ugrave;&Agrave;',
	'err_unknown_user' => '&Egrave;�&aacute;�&agrave;&iacute;&egrave;� �&icirc;&ograve;��&aacute;&egrave;&ograve;� &iacute;� �&uacute;&ugrave;��&ograve;&acirc;&oacute;&acirc;&agrave; !',
	'modify_user' => '��&icirc;&igrave;�&iacute;&egrave; �&icirc;&ograve;��&aacute;&egrave;&ograve;���',
	'notes' => '&Aacute;����&ecirc;&egrave;',
	'note_list' => '<li>&Agrave;&ecirc;&icirc; &iacute;� ���&agrave;�&ograve;� &auml;&agrave; �&egrave; ��&icirc;&igrave;�&iacute;&egrave;&ograve;� &ograve;�&ecirc;&oacute;&ugrave;&agrave;&ograve;&agrave; �&agrave;�&icirc;�&agrave;, &icirc;�&ograve;&agrave;&acirc;�&ograve;� �&icirc;��&iacute;&ouml;�&ograve;&icirc; "�&agrave;�&icirc;�&agrave;" ��&agrave;�&iacute;&icirc;',
	'password' => '�&agrave;�&icirc;�&agrave;',
	'user_active' => '�&icirc;&ograve;��&aacute;&egrave;&ograve;��� � &agrave;&ecirc;&ograve;&egrave;&acirc;�&iacute;',
	'user_group' => '�&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&agrave; ��&oacute;�&agrave;',
	'user_email' => '�&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&egrave; e-mail',
	'user_web_site' => '�&icirc;&ograve;��&aacute;&egrave;&ograve;���&ecirc;&egrave; &oacute;�&aacute; �&agrave;&eacute;&ograve;',
	'create_new_user' => '�&uacute;�&auml;&agrave;&eacute; &iacute;&icirc;&acirc; �&icirc;&ograve;��&aacute;&egrave;&ograve;��',
	'user_location' => '&Igrave;��&ograve;&icirc;&iacute;&agrave;�&icirc;�&auml;�&iacute;&egrave;� &iacute;&agrave; �&icirc;&ograve;��&aacute;&egrave;&ograve;���',
	'user_interests' => '&Egrave;&iacute;&ograve;����&egrave; &iacute;&agrave; �&icirc;&ograve;��&aacute;&egrave;&ograve;���',
	'user_occupation' => '�&agrave;&iacute;&egrave;&igrave;&agrave;&iacute;&egrave;� &iacute;&agrave; �&icirc;&ograve;��&aacute;&egrave;&ograve;���',
);
?>
