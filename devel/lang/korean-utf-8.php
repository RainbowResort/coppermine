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
$lang_charset = 'utf-8';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
$lang_month = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

// Some common strings
$lang_yes = '��';
$lang_no  = '�ƴϿ&Agrave;';
$lang_back = '&micro;&Uacute;�&Icirc;';
$lang_continue = '�&Ugrave;&Agrave;�';
$lang_info = '�&Egrave;&sup3;�';
$lang_error = '����';

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
	'random' => '���&auml;���� ������',
	'lastup' => '�&Ouml;�&Ugrave; &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;',
	'lastcom' => '�&Ouml;�&Ugrave; &Auml;&Uacute;�&agrave;Ʈ',
	'topn' => '�&Ouml;�&Ugrave; &Aacute;�&Egrave;�',
	'toprated' => '�&Ouml;�&iacute; �&ograve;&Aacute;�',
	'lasthits' => '��&Aacute;&ouml;�� &Aacute;�&Egrave;�',
	'search' => '�˻&ouml; �&aacute;�&uacute;'
);

$lang_errors = array(
	'access_denied' => '&Egrave;����&Ocirc;&Agrave;� ����&Agrave;��&Icirc; &Agrave;&Igrave;�&auml;&Aacute;&ouml;�� ���� �&ouml; ���&Agrave;�ϴ&Ugrave;. �&uuml;��&Agrave;&Uacute;���&Ocirc; ��&Agrave;��ϼ��&auml;.',
	'perm_denied' => '&Egrave;����&Ocirc;&Agrave;� ����&Agrave;��&Icirc; ���&agrave;�&Ograve; �&ouml; ���&Acirc; �&iacute;�&Eacute;&Agrave;&Ocirc;�ϴ&Ugrave;.',
	'param_missing' => '�&Ecirc;�&ouml;�׸�&Agrave;� &Egrave;�&Agrave;&Icirc;�ϼ��&auml;.',
	'non_exist_ap' => '������ �&Ugrave;�&uuml;&Agrave;&Igrave;&sup3;� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�� &Aacute;�&Agrave;���&Aacute;&ouml; �&Ecirc;�&Agrave;�ϴ&Ugrave; !',
	'quota_exceeded' => '�&Ograve;��뷮 �&Ecirc;�&uacute;,<br /><br />�&Ograve;��&micro;&Egrave; &micro;�ũ[quota]K, ��밡�&Eacute;�� �뷮[space]K, �&Ograve;��뷮 �&Ecirc;�&uacute;�&Icirc; ���&Icirc;&micro;��&Ograve; �&ouml; ��&Agrave;�,',
	'gd_file_type_err' => 'JPEG�&Iacute; PNG�&Auml;&Agrave;ϸ� &Aacute;&ouml;��&micro;&Ecirc;,',
	'invalid_image' => '��&Aacute;��&oacute; �&Auml;&Agrave;� �Ǵ&Acirc; ���������� &Aacute;&ouml;��&micro;�&Aacute;&ouml;�&Ecirc;�&Acirc; �&Auml;&Agrave;�&Agrave;&Ocirc;�ϴ&Ugrave;.',
	'resize_failed' => '��&sup3;�&Agrave;�&Agrave;&Igrave; ����&micro;�&Aacute;&ouml; �&Ecirc;�&Ograve;�&Agrave;�ϴ&Ugrave;.',
	'no_img_to_display' => 'ǥ���&Ograve; &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�� ���&Agrave;�ϴ&Ugrave;.',
	'non_exist_cat' => '������ &Auml;��װ&iacute;���&Acirc; &Aacute;�&Agrave;���&Aacute;&ouml; �&Ecirc;�&Agrave;�ϴ&Ugrave;.',
	'orphan_cat' => '�&oacute;&Agrave;� &Auml;��װ&iacute;���� &Aacute;�&Agrave;���&Aacute;&ouml;�&Ecirc;�&Agrave;�ϴ&Ugrave;. �&uuml;��&Agrave;&Uacute;���&Ocirc; ��&Agrave;��ϼ��&auml;.',
	'directory_ro' => '\'%s\'�� &micro;�&Egrave;&ugrave; �&iacute;�&Eacute;&Agrave;� ���&agrave;�&Ograve; �&ouml; ���&Agrave;�ϴ&Ugrave;.',
	'non_exist_comment' => '������ &Auml;&Uacute;�&agrave;Ʈ�&Acirc; &Aacute;�&Agrave;���&Aacute;&ouml; �&Ecirc;�&Agrave;�ϴ&Ugrave;.',
	'pic_in_invalid_album' => '&Aacute;�&Agrave;���&Aacute;&ouml;�&Ecirc;�&Acirc; �&Ugrave;�&uuml;&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;(%s)!?'
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => '�&Ugrave;�&uuml; ���&Agrave;��&Icirc;',
	'alb_list_lnk' => '�&Ugrave;�&uuml;���',
	'my_gal_title' => '�&sup3;&Agrave;&Icirc;�&Ugrave;�&uuml;&Agrave;��&Icirc;',
	'my_gal_lnk' => '�&sup3;&Agrave;&Icirc;�&Ugrave;�&uuml;',
	'my_prof_lnk' => '�&sup3;&Agrave;&Icirc;&Aacute;���',
	'adm_mode_title' => '�&uuml;����&micro;�&Icirc; &Agrave;&uuml;&Egrave;�',
	'adm_mode_lnk' => '�&uuml;����&micro;�',
	'usr_mode_title' => '&Agrave;Ϲݸ�&micro;�&Icirc; &Agrave;&uuml;&Egrave;�',
	'usr_mode_lnk' => '&Agrave;Ϲݸ�&micro;�',
	'upload_pic_title' => '�&Ugrave;�&uuml;�� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml; ���&Icirc;&micro;�',
	'upload_pic_lnk' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;���&Icirc;&micro;�',
	'register_title' => '�&egrave;&Aacute;�����',
	'register_lnk' => '&Egrave;���&micro;&icirc;��',
	'login_lnk' => '�&Icirc;��&Agrave;&Icirc;',
	'logout_lnk' => '�&Icirc;�׾ƿ&ocirc;',
	'lastup_lnk' => '�&Ouml;�&Ugrave;&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;',
	'lastcom_lnk' => '�&Ouml;�&Ugrave;&Auml;&Uacute;�&agrave;Ʈ',
	'topn_lnk' => '�&Ouml;�&Ugrave;&Aacute;�&Egrave;�',
	'toprated_lnk' => '�&Ouml;�&iacute;�&ograve;&Aacute;�',
	'search_lnk' => '�˻&ouml;',
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => '���&Icirc;&micro;�&Acirc;&Agrave;&Icirc;',
	'config_lnk' => '&Egrave;���&sup3;&Aacute;�',
	'albums_lnk' => '�&Ugrave;�&uuml;�&uuml;��',
	'categories_lnk' => '&Auml;��װ&iacute;���&uuml;��',
	'users_lnk' => '&Egrave;����&uuml;��',
	'groups_lnk' => '�׷&igrave;�&uuml;��',
	'comments_lnk' => '&Auml;&Uacute;�&agrave;Ʈ�&uuml;��',
	'searchnew_lnk' => 'FTP���&Icirc;&micro;��&Auml;&Agrave;Ͽ��&aacute;',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => '�&sup3;&Agrave;&Icirc;�&Ugrave;�&uuml; ���� �� �&uuml;��',
	'modifyalb_lnk' => '�&sup3;&Agrave;&Icirc;�&Ugrave;�&uuml; �&ouml;&Aacute;�',
	'my_prof_lnk' => '�&sup3;&Agrave;&Icirc;&Aacute;���',
);

$lang_cat_list = array(
	'category' => '������ �&Ugrave;�&Icirc;���&acirc;',
	'albums' => '�&Ugrave;�&uuml;',
	'pictures' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;',
);

$lang_album_list = array(
	'album_on_page' => '�&Ugrave;�&uuml; %d �&auml;&Agrave;&Igrave;&Aacute;&ouml; %d'
);

$lang_thumb_view = array(
	'date' => 'DATE',
	'name' => 'NAME',
	'sort_da' => '(a-z)',
	'sort_dd' => '(z-a)',
	'sort_na' => '(a-z)',
	'sort_nd' => '(z-a)',
	'pic_on_page' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; %d �&auml;&Agrave;&Igrave;&Aacute;&ouml; %d',
	'user_on_page' => '���&Agrave;&Uacute;(&Egrave;���): %d �&auml;&Agrave;&Igrave;&Aacute;&ouml;: %d'
);

$lang_img_nav_bar = array(
	'thumb_title' => '���&Agrave;��&Icirc; &micro;��ư��&acirc;',
	'pic_info_title' => '�&oacute;��&Aacute;��� ���&acirc;/�&ucirc;�&acirc;�&acirc;',
	'slideshow_title' => '���&oacute;&Agrave;&Igrave;&micro;�&icirc;',
	'ecard_title' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�� ÷�&Icirc;�� &Auml;�&micro;庸&sup3;��&acirc;',
	'ecard_disabled' => '&Auml;�&micro;庸&sup3;��&acirc; &Agrave;&aacute;�&egrave;',
	'ecard_disabled_msg' => '&Auml;�&micro;庸&sup3;��&acirc; ���Ѿ�&Agrave;�',
	'prev_title' => '&Agrave;&Igrave;&Agrave;&uuml;',
	'next_title' => '�&Ugrave;&Agrave;�',
	'pic_pos' => '&micro;&icirc;�� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml; %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => '�&ograve;��',
	'no_votes' => '(�&ograve;�����&Eacute;)',
	'rating' => '(�&ograve;&Aacute;���&Agrave;� : %s / 5 �&ograve;��&Egrave;��&ouml; %s &Egrave;�)',
	'rubbish' => 'Rubbish',
	'poor' => 'Poor',
	'fair' => 'Fair',
	'good' => 'Good',
	'excellent' => 'Excellent',
	'great' => 'Great',
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
	CRITICAL_ERROR => 'Critical error',
	'file' => 'File: ',
	'line' => 'Line: ',
);

$lang_display_thumbnails = array(
	'filename' => '�&Auml;&Agrave;�&Agrave;&Igrave;�� : ',
	'filesize' => '�&Auml;&Agrave;Ͽ뷮 : ',
	'dimensions' => '���&Icirc;,���&Icirc; : ',
	'date_added' => '&micro;&icirc;��&Agrave;� : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s comments',
	'n_views' => '%s views',
	'n_votes' => '%s votes'
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
	0 => '&Agrave;Ϲ� ��&micro;�&Icirc; &Agrave;&uuml;&Egrave;��մϴ&Ugrave;...',
	1 => '�&uuml;�� ��&micro;�&Icirc; &Agrave;&uuml;&Egrave;��մϴ&Ugrave;...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => '�&Ugrave;�&uuml;&Agrave;&Igrave;��&Agrave;&Igrave; �&Ecirc;�&auml;�մϴ&Ugrave; !',
	'confirm_modifs' => '�������&Agrave;� &Agrave;&uacute;&Agrave;��Ͻð&Uacute;�&Agrave;�ϱ&icirc; ?',
	'no_change' => '����&micro;Ǿ&uacute;�&Agrave;�ϴ&Ugrave; !',
	'new_album' => '�� �&Ugrave;�&uuml;',
	'confirm_delete1' => '�&Ugrave;�&uuml;&Agrave;� �&egrave;&Aacute;��Ͻð&Uacute;�&Agrave;�ϱ&icirc; ?',
	'confirm_delete2' => '\n�&Ugrave;�&uuml;�� &micro;&icirc;��&micro;&Egrave; &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�&Iacute; &Auml;&Uacute;�&agrave;Ʈ�� ��&micro;&Icirc; �&egrave;&Aacute;��մϴ&Ugrave; !',
	'select_first' => '��&Agrave;&uacute; �&Ugrave;�&uuml;&Agrave;� �����ϼ��&auml;',
	'alb_mrg' => '�&Ugrave;�&uuml;�&uuml;��',
	'my_gallery' => '�&sup3;&Agrave;&Icirc;�&Ugrave;�&uuml;',
	'no_category' => '*�&Ouml;�&oacute;&Agrave;� &Auml;��װ&iacute;��(��&Agrave;&Icirc;)',
	'delete' => '�&egrave;&Aacute;�',
	'new' => '����',
	'apply_modifs' => '����&micro;&icirc;��',
	'select_category' => '&Auml;��װ&iacute;�� ����',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Parameters required for \'%s\'operation not supplied !',
	'unknown_cat' => '������ &Auml;��װ&iacute;���&Acirc; &Aacute;�&Agrave;���&Aacute;&ouml; �&Ecirc;�&Agrave;�ϴ&Ugrave;.',
	'usergal_cat_ro' => '&Egrave;��� �������&Acirc; �&egrave;&Aacute;��&Ograve; �&ouml; ���&Agrave;�ϴ&Ugrave; !',
	'manage_cat' => '&Auml;��װ&iacute;���&uuml;��',
	'confirm_delete' => '&Auml;��װ&iacute;���� �&egrave;&Aacute;��Ͻð&Uacute;�&Agrave;�ϱ&icirc; ?',
	'category' => '&Auml;��װ&iacute;��',
	'operations' => '���&agrave;�޴�',
	'move_into' => '&Auml;��װ&iacute;�� ����',
	'update_create' => '&Auml;��װ&iacute;�� ����/����',
	'parent_cat' => '�&oacute;&Agrave;� &Auml;��װ&iacute;��',
	'cat_title' => '&Auml;��װ&iacute;�� &Agrave;&Igrave;��',
	'cat_desc' => '&Auml;��װ&iacute;�� �&sup3;�&iacute;'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => '�&sup3;&Aacute;�����',
	'restore_cfg' => '�&acirc;���&sup3;&Aacute;�&Agrave;��&Icirc;',
	'save_cfg' => '�������&Agrave;&uacute;&Agrave;�',
	'notes' => '&sup3;�Ʈ',
	'info' => '&Aacute;���',
	'upd_success' => '�������&Agrave;&Igrave; &Agrave;&ucirc;��&micro;Ǿ&uacute;�&Agrave;�ϴ&Ugrave;!',
	'restore_success' => '�&acirc;���&sup3;&Aacute;�&Agrave;��&Icirc; ����&micro;Ǿ&uacute;�&Agrave;�ϴ&Ugrave;!',
	'name_a' => '&Agrave;&Igrave;�� (a-z)',
	'name_d' => '&Agrave;&Igrave;�� (z-a)',
	'date_a' => '�&Ouml;�ű&Ucirc; �&Icirc;�&Iacute;',
	'date_d' => '�&Agrave;���&Ucirc; �&Icirc;�&Iacute;'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'�&acirc;���&sup3;&Aacute;�',
	array('������ &Agrave;&Igrave;��', 'gallery_name', 0),
	array('������ �&sup3;�&iacute;', 'gallery_description', 0),
	array('�&uuml;��&Agrave;&Uacute; &Agrave;&Igrave;��&Agrave;�', 'gallery_admin_email', 0),
	array('e-card &Agrave;� �&oacute;��&Aacute;����� �&micro;ũ&micro;&Eacute; URL', 'ecards_more_pic_target', 0),
	array('��&icirc;����', 'lang', 5),
	array('�׸�����', 'theme', 6),

	'�&Ugrave;�&uuml;��� �&sup3;&Aacute;�',
	array('��&Agrave;&Icirc;��&Agrave;&Igrave;�&iacute;&Agrave;� �� (pixels or %)', 'main_table_width', 0),
	array('ǥ���&Ograve; &Auml;��װ&iacute;�� �����&ouml;', 'subcat_level', 0),
	array('ǥ���&Ograve; �&Ugrave;�&uuml;&Agrave;� �&ouml;', 'albums_per_page', 0),
	array('�&Ugrave;�&uuml;&Agrave;� ���&Icirc; ��', 'album_list_cols', 0),
	array('��&sup3;�&Agrave;� ũ�&acirc;(pixels)', 'alb_list_thumb_size', 0),
	array('��&Agrave;&Icirc;�&auml;&Agrave;&Igrave;&Aacute;&ouml;�� �&Ograve;���� &Auml;&Aacute;�&Ugrave;Ʈ', 'main_page_layout', 0),

	'��&sup3;�&Agrave;ϸ�� �&sup3;&Aacute;�',
	array('��&sup3;�&Agrave;� &Auml;÷&sup3;�&ouml;', 'thumbcols', 0),
	array('��&sup3;�&Agrave;� �&agrave;�&ouml;', 'thumbrows', 0),
	array('�&Ograve;���� ��&sup3;�&Agrave;� �Ѽ&ouml;', 'max_tabs', 0),
	array('��&sup3;�&Agrave;ϰ&uacute; �&Ocirc;&sup2;&sup2; �&oacute;��&Aacute;��� �&acirc;�&Acirc;', 'caption_in_thumbview', 1),
	array('��&sup3;�&Agrave;ϰ&uacute; �&Ocirc;�&Ocirc; &Auml;&Uacute;�&agrave;Ʈ �&ouml;�� �&acirc;�&Acirc;', 'display_comment_count', 1),
	array('&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; &Aacute;��&Auml;���', 'default_sort_order', 3),
	array('�&Ouml;�&iacute;�&ograve;&Aacute;��� &sup3;�Ÿ&sup3;� �&Ouml;�&Ograve; �&ograve;��&Egrave;��&ouml;', 'min_votes_for_rating', 0),

	'&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;���&acirc;�޴� �� &Auml;&Uacute;�&agrave;Ʈ �&sup3;&Aacute;�',
	array('&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;���&acirc; ��&Agrave;&Igrave;�&iacute;&Agrave;� ��(pixels or %)', 'picture_table_width', 0),
	array('&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;&Agrave;� �&oacute;��&Aacute;����� �&acirc;��&Agrave;&ucirc;&Agrave;��&Icirc; �&acirc;�&Acirc;', 'display_pic_info', 1),
	array('����&Aacute;&ouml;�&icirc; �&Ecirc;�&Iacute;�&micro; ���', 'filter_bad_words', 1),
	array('&Auml;&Uacute;�&agrave;Ʈ�� ����&Agrave;� ��&Agrave;&Igrave;&Auml;&Uuml; ���', 'enable_smilies', 1),
	array('&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; �&sup3;�&iacute; �&Ouml;�� ��&Agrave;&Uacute;�&ouml;', 'max_img_desc_length', 0),
	array('�&Uuml;�&icirc;��&Agrave;&Uacute; ��&Agrave;&Igrave;(��&ouml;�&sup2;�&acirc;��&Agrave;&Igrave;)', 'max_com_wlength', 0),
	array('&Auml;&Uacute;�&agrave;Ʈ �&oacute;&Agrave;&Icirc; &Aacute;���', 'max_com_lines', 0),
	array('&Auml;&Uacute;�&agrave;Ʈ �&Ecirc;�� ��&Agrave;&Uacute;�&ouml;', 'max_com_size', 0),

	'&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; �� ��&sup3;�&Agrave;� �&sup3;&Aacute;�',
	array('JPEG &Auml;���Ƽ', 'jpeg_qual', 0),
	array('��&sup3;�&Agrave;� ���&Icirc;,���&Icirc; �&Ouml;��<b>*</b>', 'thumb_width', 0),
	array('&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; ���&acirc;�� ���&Icirc;�&icirc; �&Auml;&Agrave;ϻ���','make_intermediate',1),
	array('���&Icirc; ����&micro;&Eacute; �&Auml;&Agrave;�&Agrave;� �&Ouml;��ũ�&acirc;(��)<b>*</b>', 'picture_width', 0),
	array('���&Icirc;&micro;� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml; �&Ouml;��뷮 (KB)', 'max_upl_size', 0),
	array('���&Icirc;&micro;� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml; ���&Icirc;,���&Icirc; �&Ouml;��ũ�&acirc;(pixels)', 'max_upl_width_height', 0),

	'����(&Egrave;���)�&sup3;&Aacute;�',
	array('&Egrave;�����&Agrave;&Ocirc; ���', 'allow_user_registration', 1),
	array('&Egrave;�����&Agrave;&Ocirc;�� &Agrave;&Igrave;��&Agrave;� &Agrave;�&Egrave;����&Icirc; ��&Aacute;�', 'reg_requires_valid_email', 1),
	array('&Agrave;&Igrave;��&Agrave;� &Aacute;&szlig;����� ���&Icirc;', 'allow_duplicate_emails_addr', 1),
	array('���&Agrave;&Uacute; �&sup3;&Agrave;&Icirc;�&Ugrave;�&uuml; ���� ���', 'allow_private_albums', 1),

	'Custom fields for image description (leave blank if unused)',
	array('Field 1 name', 'user_field1_name', 0),
	array('Field 2 name', 'user_field2_name', 0),
	array('Field 3 name', 'user_field3_name', 0),
	array('Field 4 name', 'user_field4_name', 0),

	'&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; �� ��&sup3;�&Agrave;� �&iacute;�޼&sup3;&Aacute;�',
	array('�&Auml;&Agrave;� &Agrave;&Igrave;���� ����&Aacute;&ouml;�&Ograve; ��&Agrave;&Uacute;', 'forbiden_fname_char',0),
	array('����&Ograve; &Agrave;&Igrave;�&Igrave;&Aacute;&ouml; &Egrave;�&Agrave;�&Agrave;&Uacute;', 'allowed_file_extensions',0),
	array('&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; ����&Agrave;&Igrave;&Acirc;��� &Agrave;&Igrave;���&Ograve; Method','thumb_method',2),
	array('Path to ImageMagick \'convert\' utility (example /usr/bin/X11/)', 'impath', 0),
	array('Allowed image types (only valid for ImageMagick)', 'allowed_img_types',0),
	array('Command line options for ImageMagick', 'im_options', 0),
	array('Read EXIF data in JPEG files', 'read_exif_data', 1),
	array('�&Ugrave;�&uuml; &micro;��&auml;�� ��&Icirc; <b>*</b>', 'fullpath', 0),
	array('���&Agrave;&Uacute;(&Egrave;���) ���&Icirc;&micro;� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml; ��&Icirc; <b>*</b>', 'userpics', 0),
	array('���&Icirc; ����&micro;&Eacute; &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;&Agrave;� &Aacute;�&micro;&Icirc;�&icirc; <b>*</b>', 'normal_pfx', 0),
	array('��&sup3;�&Agrave;�&Agrave;� &Aacute;�&micro;&Icirc;�&icirc; <b>*</b>', 'thumb_pfx', 0),
	array('&micro;��&auml;�� �&acirc;�� �&Ucirc;�&Igrave;��', 'default_dir_mode', 0),
	array('&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; �&acirc;�� �&Ucirc;�&Igrave;��', 'default_file_mode', 0),

	'&Auml;&iacute;Ű �� ���� &Agrave;&Icirc;&Auml;&Uacute;&micro;&ugrave; �&sup3;&Aacute;�',
	array('&Auml;&iacute;Ű&Agrave;&Igrave;��', 'cookie_name', 0),
	array('&Auml;&iacute;Ű��&Icirc;', 'cookie_path', 0),
	array('&Agrave;&Icirc;&Auml;&Uacute;&micro;&ugrave;', 'charset', 4),

	'�&acirc;Ÿ�&sup3;&Aacute;�',
	array('Enable debug mode', 'debug_mode', 1),

	'<br /><div align="center"> * ǥ��&micro;&Egrave; �&Icirc;��&Agrave;� �&Eacute;��&Agrave;� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�� &micro;&icirc;��&micro;&Egrave; &Agrave;&Igrave;&Egrave;&Auml;�� ������&Aacute;&ouml; �����&auml;.</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => '&Agrave;&Igrave;��&Agrave;� &Agrave;&Ocirc;�&Acirc;�ϼ��&auml;.',
	'com_added' => '&Auml;&Uacute;�&agrave;Ʈ�� &micro;&icirc;��&micro;Ǿ&uacute;�&Agrave;�ϴ&Ugrave;.',
	'alb_need_title' => '��&Agrave;&uuml;�� �&Ugrave;�&uuml; Ÿ&Agrave;&Igrave;�&sup2;&Agrave;� &Aacute;��ϼ��&auml; !',
	'no_udp_needed' => '��&micro;�&Agrave;&Igrave;Ʈ�&Ograve; �&Ecirc;�&auml;����.',
	'alb_updated' => 'The ��&micro;�&Agrave;&Igrave;Ʈ &micro;Ǿ&uacute;�&Agrave;�ϴ&Ugrave;.',
	'unknown_album' => '������ �&Ugrave;�&uuml;&Agrave;&Igrave; ����&sup3;�, ���&Icirc;&micro;��&Ograve; ����&Agrave;&Igrave; �&uuml;��&Agrave;&Uacute;�� &Agrave;��� &Aacute;���&micro;Ǿ&icirc;&Agrave;&Ouml;�&Agrave;�ϴ&Ugrave;.',
	'no_pic_uploaded' => '���&Icirc;&micro;� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml; ���&Agrave;�ϴ&Ugrave; !<br /><br />���&ouml;���� ���&micro;Ǵ&Acirc; &Agrave;&Igrave;�&Igrave;&Aacute;&ouml; �&Auml;&Agrave;�&Agrave;� ���&Icirc;&micro;��ϼ��&auml;.',
	'err_mkdir' => '%s &micro;��&auml;�� �������� !',
	'dest_dir_ro' => '%s &micro;��&auml;���&Acirc; �&sup2;�&acirc;��&Aacute;&ouml;&micro;Ǿ&icirc;&Agrave;&Ouml;�&Agrave;�ϴ&Ugrave; !',
	'err_move' => '%s�&uacute; %s�� ���&aacute;��&Aacute;&ouml;���&szlig;�&Agrave;�ϴ&Ugrave;  !',
	'err_fsize_too_large' => '��&Agrave;&Igrave;&Aacute;&icirc;�&Ecirc;�&uacute;(maximum %s x %s) !',
	'err_imgsize_too_large' => '�뷮�&Ecirc;�&uacute; (maximum %s KB) !',
	'err_invalid_img' => '&Aacute;����� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�� ���&Icirc;&micro;��Ͻ&Ecirc;�ÿ&Agrave; !',
	'allowed_img_types' => '%s &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�� ���&Icirc;&micro;��&Ograve; �&ouml; &Agrave;&Ouml;�&Agrave;�ϴ&Ugrave;.',
	'err_insert_pic' => '\'%s\' &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�&Acirc; �&Ugrave;�&uuml;�� &micro;&icirc;���&Ograve; �&ouml; ���&Agrave;�ϴ&Ugrave;. ',
	'upload_success' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�� ����&Agrave;&ucirc;&Agrave;��&Icirc; ���&Icirc;&micro;� &micro;Ǿ&uacute;�&Agrave;�ϴ&Ugrave;.<br /><br />�&uuml;��&Agrave;&Uacute;&Agrave;� �&Acirc;&Agrave;&Icirc;&Egrave;&Auml; �&Ocirc;��&micro;˴ϴ&Ugrave;.',
	'info' => '�&Egrave;&sup3;�',
	'com_added' => '&Auml;&Uacute;�&agrave;Ʈ &micro;&icirc;��',
	'alb_updated' => '�&Ugrave;�&uuml; ��&micro;�&Agrave;&Igrave;Ʈ',
	'err_comment_empty' => '&Auml;&Uacute;�&agrave;Ʈ ��&icirc;&Agrave;&Ouml;&Agrave;� !',
	'err_invalid_fext' => 'Only files with the following extensions are accepted : <br /><br />%s.',
	'no_flood' => '&Auml;&Uacute;�&agrave;Ʈ�� �&ouml;&Aacute;��ϰ�&sup3;� &micro;&icirc;���&Ograve; �&ouml; ���&Agrave;�ϴ&Ugrave;.',
	'redirect_msg' => '\'�&Ugrave;&Agrave;�\' �&ouml;ư&Agrave;� �����&acirc; &Agrave;&uuml;�� �&ecirc;�&oacute;�&igrave;&Agrave;&uacute;&Agrave;� ���&Icirc;�&iacute;&Auml;� �&ouml;ư&Agrave;� �����&Aacute;&ouml; �����&auml;.',
	'upl_success' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�� ����&Agrave;&ucirc;&Agrave;��&Icirc; ���&Icirc;&micro;�&micro;Ǿ&uacute;�&Agrave;�ϴ&Ugrave;.',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => '&Auml;���',
	'fs_pic' => '���� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;',
	'del_success' => '�&egrave;&Aacute;�&micro;Ǿ&uacute;�&Agrave;�ϴ&Ugrave;!',
	'ns_pic' => '&Agrave;&uuml;�ø� &Agrave;��� ��&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;',
	'err_del' => '�&egrave;&Aacute;�&micro;�&Aacute;&ouml; �&Ecirc;�&Ograve;�&Agrave;�ϴ&Ugrave;!!',
	'thumb_pic' => '��&sup3;�&Agrave;�',
	'comment' => '&Auml;&Uacute;�&agrave;Ʈ',
	'im_in_alb' => '�&Ugrave;�&uuml; &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;',
	'alb_del_success' => '\'%s\' �&Ugrave;�&uuml;�&egrave;&Aacute;�',
	'alb_mgr' => '�&Ugrave;�&uuml;�&uuml;��',
	'err_invalid_data' => '\'%s\' &micro;�&Agrave;&Igrave;Ÿ ���&Agrave;�ϴ&Ugrave;!',
	'create_alb' => '\'%s\' �&Ugrave;�&uuml;����',
	'update_alb' => '\'%s\' �&Ugrave;�&uuml; ��&micro;�&Agrave;&Igrave;Ʈ \'%s\' &Agrave;&Igrave;�&Igrave;&Aacute;&ouml; \'%s\' &Agrave;&Icirc;&micro;���',
	'del_pic' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�&egrave;&Aacute;�',
	'del_alb' => '�&Ugrave;�&uuml;�&egrave;&Aacute;�',
	'del_user' => '���&Agrave;&Uacute;�&egrave;&Aacute;�',
	'err_unknown_user' => '������ ���&Agrave;&Uacute;�&Acirc; ���&Agrave;�ϴ&Ugrave; !',
	'comment_deleted' => '&Auml;&Uacute;�&agrave;Ʈ�� ����&Agrave;&ucirc;&Agrave;��&Icirc; �&egrave;&Aacute;�&micro;Ǿ&uacute;�&Agrave;�ϴ&Ugrave;.',
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
	'confirm_del' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�� �&egrave;&Aacute;��Ͻð&Ugrave;�&Agrave;�ϱ&icirc; ? \\n&Auml;&Uacute;�&agrave;Ʈ&micro;&micro; �&Ocirc;&sup2;&sup2; �&egrave;&Aacute;�&micro;˴ϴ&Ugrave;.',
	'del_pic' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�&egrave;&Aacute;� (�&uuml;��&Agrave;&Uacute;�޴�)',
	'size' => '%s x %s pixels',
	'views' => '%s times',
	'slideshow' => '���&oacute;&Agrave;&Igrave;&micro;�&icirc;',
	'stop_slideshow' => '���&oacute;&Agrave;&Igrave;&micro;�&icirc;-&Aacute;�&Aacute;&ouml;',
	'view_fs' => '���� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml; ���&acirc;',
);

$lang_picinfo = array(
	'title' =>'Information',
	'Filename' => 'Filename',
	'Album name' => 'Album name',
	'Rating' => 'Rating (%s votes)',
	'Keywords' => 'Keywords',
	'File Size' => 'File Size',
	'Dimensions' => 'Dimensions',
	'Displayed' => 'Displayed',
	'Camera' => 'Camera',
	'Date taken' => 'Date taken',
	'Aperture' => 'Aperture',
	'Exposure time' => 'Exposure time',
	'Focal length' => 'Focal length',
	'Comment' => 'Comment'
);

$lang_display_comments = array(
	'OK' => '&micro;&icirc;��',
	'edit_title' => '&Auml;&Uacute;�&agrave;Ʈ �&ouml;&Aacute;�',
	'confirm_delete' => '&Auml;&Uacute;�&agrave;Ʈ�� �&egrave;&Aacute;��Ͻð&Uacute;�&Agrave;�ϱ&icirc; ?',
	'add_your_comment' => '&Auml;&Uacute;�&agrave;Ʈ &micro;&icirc;��',
	'your_name' => '&Agrave;&Igrave;��',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'e-card ��&sup3;��&acirc;',
	'invalid_email' => '<b>Warning</b> : &Agrave;�&Egrave;���&Aacute;&ouml; �&Ecirc;&Agrave;� &Agrave;&Igrave;��&Agrave;�&Agrave;&Ocirc;�ϴ&Ugrave; !',
	'ecard_title' => '%s�&Ocirc;&sup2;&sup2;�� ��&sup3;��� e-card &Agrave;&Ocirc;�ϴ&Ugrave;!',
	'view_ecard' => '&Auml;�&micro;尡 ��&Agrave;&Igrave;&Aacute;&ouml;�&Ecirc;�&Acirc; ���&Agrave;&Uacute;&sup2;&sup2;���&Acirc; &Agrave;&Igrave;�&micro;ũ�� Ŭ���ϼ��&auml; !',
	'view_more_pics' => '�� ��&Agrave;� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�� ���&oacute;�Ͻ÷&Aacute;�&eacute; Ŭ���ϼ��&auml; !',
	'send_success' => 'e-card�� ��&sup3;&Acirc;�&Agrave;�ϴ&Ugrave;!',
	'send_failed' => '&Aacute;˼&Ucirc;�մϴ&Ugrave;, e-card �&szlig;�&Ucirc;�� �����Ͽ��&Agrave;�ϴ&Ugrave;.',
	'from' => 'e-card &Agrave;&Ucirc;���&ucirc;',
	'your_name' => '��&sup3;��&Acirc; ��� &Agrave;&Igrave;��',
	'your_email' => '��&sup3;��&Acirc; ��� &Agrave;&Igrave;��&Agrave;�',
	'to' => 'To',
	'rcpt_name' => '�޴&Acirc; ��� &Agrave;&Igrave;��',
	'rcpt_email' => '�޴&Acirc; ��� &Agrave;&Igrave;��&Agrave;�',
	'greetings' => '&Aacute;���',
	'message' => '�޼�&Aacute;&ouml;',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; �&oacute;��&Aacute;���',
	'album' => '�&Ugrave;�&uuml;',
	'title' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; &Aacute;���',
	'desc' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; �&sup3;�&iacute;',
	'keywords' => '�˻&ouml; Ű�&ouml;&micro;�',
	'pic_info_str' => '%sx%s - %sKB - %s views - %s votes',
	'approve' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; �&Acirc;&Agrave;&Icirc;',
	'postpone_app' => '�&Acirc;&Agrave;&Icirc; ���&ugrave;',
	'del_pic' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; �&egrave;&Aacute;�',
	'reset_view_count' => '&Aacute;�&Egrave;��&ouml; �&Ecirc;�&acirc;&Egrave;�',
	'reset_votes' => '�&ograve;�� �&Ecirc;�&acirc;&Egrave;�',
	'del_comm' => '&Auml;&Uacute;�&agrave;Ʈ �&egrave;&Aacute;�',
	'upl_approval' => '���&Icirc;&micro;� �&Acirc;&Agrave;&Icirc;',
	'edit_pics' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; �&iacute;&Aacute;�',
	'see_next' => '�&Ugrave;&Agrave;�',
	'see_prev' => '&Agrave;&Igrave;&Agrave;&uuml;',
	'n_pic' => '��&acirc;&Aacute;&szlig;&Agrave;&Icirc; &Agrave;&Igrave;�&Igrave;&Aacute;&ouml; (%s)',
	'n_of_pic_to_disp' => '�&auml;&Agrave;&Igrave;&Aacute;&ouml;�� �&acirc;�&Acirc;�&Ograve; &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;',
	'apply' => '������� &Agrave;&uacute;&Agrave;�'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => '�׷&igrave;&Agrave;&Igrave;��',
	'disk_quota' => '&micro;�ũ �&Ograve;��',
	'can_rate' => '�&ograve;�����&Eacute;',
	'can_send_ecards' => 'e-card �&szlig;�&Ucirc;���&Eacute;',
	'can_post_com' => '&Auml;&Uacute;�&agrave;Ʈ &micro;&icirc;�ϰ��&Eacute;',
	'can_upload' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; ���&Icirc;&micro;尡�&Eacute;',
	'can_have_gallery' => '�&sup3;&Agrave;&Icirc;�&Ugrave;�&uuml; �������&Eacute;',
	'apply' => '������� &Agrave;&uacute;&Agrave;�',
	'create_new_group' => '�� �׷&igrave;����',
	'del_groups' => '������ �׷&igrave;�&egrave;&Aacute;�',
	'confirm_del' => 'Warning, when you delete a group, users that belong to this group will be transfered to the \'Registered\' group !\n\nDo you want to proceed ?',
	'title' => '���&Agrave;&Uacute; �׷&igrave;�&uuml;��',
	'approval_1' => 'Pub. Upl. approval (1)',
	'approval_2' => 'Priv. Upl. approval (2)',
	'note1' => '<b>(1)</b> public album �� ���&Icirc;&micro;��&Ograve; &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�&Acirc; �&uuml;��&Agrave;&Uacute;&Agrave;� �&Acirc;&Agrave;&Icirc;&Agrave;�&Acirc;��� ���&Auml; �&Ocirc;��&micro;˴ϴ&Ugrave;.',
	'note2' => '<b>(2)</b> ���&Agrave;&Uacute;(&Egrave;���)�� ���&Icirc;&micro;��� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�&Acirc; &Agrave;&uacute;&Agrave;&Ucirc;�ǹ��� &Agrave;��&egrave;&micro;�&Aacute;&ouml; �&Ecirc;�ƾ&szlig; �&Ocirc;��&micro;˴ϴ&Ugrave;. ',
	'notes' => 'Notes'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => '&Egrave;��&micro;�մϴ&Ugrave; !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => '�&Ugrave;�&uuml;&Agrave;� �&egrave;&Aacute;��Ͻð&Uacute;�&Agrave;�ϱ&icirc; ? \\n��&micro;� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�&Iacute; &Auml;&Uacute;�&agrave;Ʈ&micro;&micro; �&Ocirc;&sup2;&sup2; �&egrave;&Aacute;�&micro;˴ϴ&Ugrave;.',
	'delete' => '�&egrave;&Aacute;�',
	'modify' => '�&Ugrave;�&uuml;�&sup3;&Aacute;�',
	'edit_pics' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�� &Aacute;����&ouml;&Aacute;� ',
);

$lang_list_categories = array(
	'home' => '������ ��&Agrave;&Icirc;',
	'stat1' => '<b>&Auml;��װ&iacute;��:[cat] �&Ugrave;�&uuml;:[albums] &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;:[pictures] &Auml;&Uacute;�&agrave;Ʈ:[comments] &Aacute;�&Egrave;�:[views]</b>',
	'stat2' => '<b>�&Ugrave;�&uuml;:[albums] &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;:[pictures] &Aacute;�&Egrave;�:[views]</b>',
	'xx_s_gallery' => '%s\'������',
	'stat3' => '<b>&Auml;��װ&iacute;��:[cat] �&Ugrave;�&uuml;:[albums] &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;:[pictures] &Auml;&Uacute;�&agrave;Ʈ:[comments] &Aacute;�&Egrave;�:[views]</b>'
);

$lang_list_users = array(
	'user_list' => '���&Agrave;&Uacute;(&Egrave;���)���',
	'no_user_gal' => '���&Agrave;&Uacute;(&Egrave;���) �������� ���&Agrave;�ϴ&Ugrave;.',
	'n_albums' => '%s �&Ugrave;�&uuml;',
	'n_pics' => '%s &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;'
);

$lang_list_albums = array(
	'n_pictures' => '%s images',
	'last_added' => ', last one added on %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => '�&Icirc;��&Agrave;&Icirc;',
	'enter_login_pswd' => '��&Agrave;&Igrave;&micro;�&Iacute; ��й�&Egrave;��� &Agrave;&Ocirc;�&Acirc;�ϼ��&auml;!',
	'username' => '��&Agrave;&Igrave;&micro;�',
	'password' => '��й�&Egrave;�',
	'remember_me' => '�&acirc;���ϱ&acirc;',
	'welcome' => '%s�&Ocirc; �&Icirc;��&Agrave;&Icirc;&micro;Ǿ&uacute;�&Agrave;�ϴ&Ugrave; !!',
	'err_login' => '*** �&Icirc;��&Agrave;&Icirc;&micro;�&Aacute;&ouml; �&Ecirc;�&Ograve;�&Agrave;�ϴ&Ugrave;. ***',
	'err_already_logged_in' => '&Agrave;&Igrave;�&Igrave; �&Icirc;��&Agrave;&Icirc;&micro;Ǿ&uacute;�&Agrave;�ϴ&Ugrave; !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => '�&Icirc;�׾ƿ&ocirc;',
	'bye' => '%s�&Ocirc; �&Icirc;�׾ƿ&ocirc;&micro;Ǿ&uacute;�&Agrave;�ϴ&Ugrave; !!',
	'err_not_loged_in' => '�&Icirc;��&Agrave;&Icirc;&micro;�&Aacute;&ouml; �&Ecirc;�&Ograve;�&Agrave;�ϴ&Ugrave; !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => '%s�&Ocirc; �&Ugrave;�&uuml; ��&micro;�&Agrave;&Igrave;Ʈ',
	'general_settings' => '�&acirc;���&sup3;&Aacute;�',
	'alb_title' => '�&Ugrave;�&uuml; &Aacute;���',
	'alb_cat' => '�&Ugrave;�&uuml; &Auml;��װ&iacute;��',
	'alb_desc' => '�&Ugrave;�&uuml; �&sup3;�&iacute;',
	'alb_thumb' => '�&Ugrave;�&uuml; ��&sup3;�&Agrave;�',
	'alb_perm' => '�&Ugrave;�&uuml; ���Ѽ&sup3;&Aacute;�',
	'can_view' => '�&Ugrave;�&uuml; ���&sup3;�&sup3;&Aacute;�',
	'can_upload' => '�湮&Agrave;&Uacute;�� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�� ���&Icirc;&micro;��&Ograve;�&ouml; &Agrave;&Ouml;&Agrave;�',
	'can_post_comments' => '�湮&Agrave;&Uacute;�� &Auml;&Uacute;�&agrave;Ʈ�� �&micro;�&ouml; &Agrave;&Ouml;&Agrave;�',
	'can_rate' => '�湮&Agrave;&Uacute;�� �&ograve;���&Ograve; �&ouml; &Agrave;&Ouml;&Agrave;�',
	'user_gal' => '���&Agrave;&Uacute;(&Egrave;���) ������',
	'no_cat' => '*�&Ouml;�&oacute;&Agrave;� &Auml;��װ&iacute;��(��&Agrave;&Icirc;)',
	'alb_empty' => '�&Ugrave;�&uuml;&Agrave;&Igrave; ��&icirc;&Agrave;&Ouml;�&Agrave;�ϴ&Ugrave;.',
	'last_uploaded' => '��&Aacute;&ouml;�� ���&Icirc;&micro;�',
	'public_alb' => '��&micro;&Icirc;���&sup3;(public album)',
	'me_only' => '&sup3;������&acirc;',
	'owner_only' => '(%s)�� ���&acirc;',
	'groupp_only' => '\'%s\' �׷&igrave;',
	'err_no_alb_to_modify' => '�&ouml;&Aacute;��&Ograve; �&ouml; ���&Agrave;�ϴ&Ugrave;.',
	'update' => '�&Ugrave;�&uuml; ��&micro;�&Agrave;&Igrave;Ʈ'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => '&Aacute;˼&Ucirc;�մϴ&Ugrave;. &Agrave;&Igrave;�&Igrave; �&ograve;���ϼ&Igrave;�&Agrave;�ϴ&Ugrave;.',
	'rate_ok' => '�&ograve;���� &Aacute;&Ouml;�ż� �����մϴ&Ugrave; !',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
{SITE_NAME}�� �&Agrave;�� �&Iacute;&Agrave;� &Egrave;��&micro;�մϴ&Ugrave;.<br />
&Egrave;����&Ocirc;&Agrave;� �&sup3;&Agrave;&Icirc;�&Ugrave;�&uuml;&Agrave;� ���� �&uuml;���&Ograve;�&ouml; &Agrave;&Ouml;�&Acirc; �ý��&Ucirc;&Agrave;� &Aacute;غ�&Aacute;&szlig;�� &Agrave;&Ouml;�&Agrave;�ϴ&Ugrave;.<br />
�&ouml;&Agrave;�&Acirc; �׽�Ʈ&Aacute;&szlig;&Agrave;&Igrave;�Ƿ&Icirc;, &Egrave;�����&Agrave;&Ocirc;&Agrave;&Igrave;&sup3;� �&acirc;Ÿ ������ �&Aacute;�&Icirc;�׷�����&Agrave;� �&Auml;&Agrave;� &Agrave;���&micro;&icirc;&Agrave;� å&Agrave;&Oacute;&Aacute;&ouml;&Aacute;&ouml; �&Ecirc;�&Agrave;�ϴ&Ugrave;.<br />
&Agrave;ϴ&Uuml; &Egrave;���&micro;&icirc;���� ��&sup2;&sup2;�&Acirc; &Aacute;��&Auml; �&Agrave;�&Acirc;�� &Agrave;&Igrave;��&Agrave;�&Agrave;� ���� �˷&Aacute;&micro;帱 �&Iacute;&Agrave;&Igrave;��, ���&egrave; �&acirc;��&micro;��&Egrave; ��&Agrave;&Ocirc;�� &Egrave;���&Agrave;� ��&oacute;&Agrave;��&Icirc; Ư���� &Agrave;&Igrave;��Ʈ�� &Aacute;غ��ϰ&iacute; &Agrave;&Ouml;�&Agrave;�ϴ&Ugrave;.<br />&Egrave;�����&Agrave;&Ocirc;�� &Agrave;&Igrave;��&Agrave;�&Agrave;� &Agrave;�&Egrave;��� üũ�� ���� &Agrave;�&Egrave;���&Aacute;&ouml; �&Ecirc;&Agrave;� &Agrave;&Igrave;��&Agrave;�&Agrave;� &micro;&icirc;��&micro;�&Aacute;&ouml; �&Ecirc;�&Acirc;&Aacute;� &Acirc;&uuml;�&iacute;�ϼ��&auml;.<br /><br />
�&Ugrave;���ѹ� {SITE_NAME}�� �湮�� &Aacute;&Ouml;�ż� �����մϴ&Ugrave;.
EOT;

$lang_register_php = array(
	'page_title' => '&Egrave;���&micro;&icirc;��',
	'term_cond' => '&micro;&icirc;�Ͼ&agrave;�&uuml; �� &Agrave;&Igrave;��&Egrave;&sup3;�',
	'i_agree' => '&micro;�&Agrave;��մϴ&Ugrave;!',
	'submit' => '&Egrave;���&micro;&icirc;��',
	'err_user_exists' => '&Agrave;&Igrave;�&Igrave; ���&Aacute;&szlig;&Agrave;&Icirc; ��&Agrave;&Igrave;&micro;�&Agrave;&Ocirc;�ϴ&Ugrave;. �&Ugrave;�� ��&Agrave;&Igrave;&micro;�&Icirc; &micro;&icirc;���ϼ��&auml;.',
	'err_password_mismatch' => '&micro;&Icirc; ��й�&Egrave;��� &Agrave;�&Auml;���&Aacute;&ouml; �&Ecirc;�&Agrave;�ϴ&Ugrave;.',
	'err_uname_short' => '��&Agrave;&Igrave;&micro;�&Acirc; �&Ouml;�&Ograve;4~10&Agrave;&Uacute; &Agrave;&Igrave;&sup3;��&Icirc; &Agrave;&Ucirc;���ؾ&szlig; �մϴ&Ugrave;.',
	'err_password_short' => '��й�&Egrave;��&Acirc; �&Ouml;�&Ograve;4~12&Agrave;&Uacute; &Agrave;&Igrave;&sup3;��&Icirc; &Agrave;&Ucirc;���ؾ&szlig; �մϴ&Ugrave;.',
	'err_uname_pass_diff' => '��&Agrave;&Igrave;&micro;�&Iacute; ��й�&Egrave;��� &Agrave;�&Auml;���&Aacute;&ouml; �&Ecirc;�&Agrave;�ϴ&Ugrave;.',
	'err_invalid_email' => '&Agrave;&Igrave;��&Agrave;�&Agrave;� &Agrave;&Ocirc;�&Acirc;�ϼ��&auml;.',
	'err_duplicate_email' => '&Agrave;&Igrave;�&Igrave; &micro;&icirc;��&micro;&Egrave; &Agrave;&Igrave;��&Agrave;� &Aacute;&Ouml;�&Ograve;&Agrave;&Ocirc;�ϴ&Ugrave;.',
	'enter_info' => '&Egrave;���&micro;&icirc;�� �&ucirc;',
	'required_info' => '�&Ecirc;�&ouml;&Agrave;&Ocirc;�&Acirc; �׸�',
	'optional_info' => '�&szlig;��&Aacute;���',
	'username' => '��&Agrave;&Igrave;&micro;�',
	'password' => '��й�&Egrave;�',
	'password_again' => '��й�&Egrave;� &Agrave;�&Agrave;&Ocirc;�&Acirc;',
	'email' => '&Agrave;&Igrave;��&Agrave;�',
	'location' => '&Aacute;&ouml;��',
	'interests' => '�&uuml;�&Eacute;�о&szlig;',
	'website' => '&Egrave;��&auml;&Agrave;&Igrave;&Aacute;&ouml;',
	'occupation' => '�Ͻô&Acirc; &Agrave;�',
	'error' => '����..',
	'confirm_email_subject' => '%s &Egrave;���&micro;&icirc;��',
	'information' => '�&Egrave;&sup3;�',
	'failed_sending_email' => '&micro;&icirc;��&Aacute;��� &Agrave;&Igrave;��&Agrave;� �&szlig;�&Ucirc;���� !',
	'thank_you' => '&micro;&icirc;����&Aacute;&Ouml;�ż� �����մϴ&Ugrave;.<br />&Agrave;&Ocirc;�&Acirc;�� &Agrave;&Igrave;��&Agrave;� &Aacute;&Ouml;�&Ograve;�&Icirc; &Egrave;���&Egrave;� &Auml;&Uacute;&micro;尡 ��&auml; &Agrave;&Igrave;��&Agrave;�&Agrave;� ��&sup3;&Acirc;�&Agrave;�ϴ&Ugrave;.<br />&micro;&icirc;��&Agrave;�&Acirc;��� �Ϸ&aacute;�Ϸ&Aacute;�&eacute; &Agrave;&Igrave;��&Agrave;�&Agrave;� &Egrave;���&Egrave;� &Auml;&Uacute;&micro;带 Ŭ����&Aacute;&Ouml;�&Ecirc;�ÿ&Agrave;.',
	'acct_created' => '&Egrave;����&Ocirc;&Agrave;� &micro;&icirc;��&Agrave;�&Acirc;��� &Aacute;��&oacute;&Agrave;&ucirc;&Agrave;��&Icirc; �Ϸ&aacute;&micro;Ǿ&uacute;�&Agrave;�ϴ&Ugrave;. �&Icirc;��&Agrave;&Icirc;&Egrave;&Auml; �&sup3;&Agrave;&Icirc;&Aacute;����� �&ouml;&Aacute;���&Aacute;&Ouml;�&Ecirc;�ÿ&Agrave;.',
	'acct_active' => '&Egrave;����&Ocirc;&Agrave;� �&egrave;&Aacute;�&Agrave;&Igrave; &Aacute;��&oacute;&Agrave;&ucirc;&Agrave;��&Icirc; &Egrave;���&Egrave;�&micro;Ǿ&uacute;�&Agrave;�ϴ&Ugrave;. �&Icirc;��&Agrave;&Icirc;&Egrave;&Auml; &Agrave;&Igrave;����&Aacute;&Ouml;�&Ecirc;�ÿ&Agrave;.',
	'acct_already_act' => '&Egrave;����&Ocirc;&Agrave;� �&egrave;&Aacute;�&Agrave;&Igrave; &Agrave;&Igrave;�&Igrave; &Egrave;���&Egrave;�&micro;Ǿ&uacute;�&Agrave;�ϴ&Ugrave; !',
	'acct_act_failed' => '&Agrave;&Igrave; �&egrave;&Aacute;�&Agrave;� &Egrave;���&Egrave;�&micro;�&Aacute;&ouml; �&Ecirc;�&Ograve;�&Agrave;�ϴ&Ugrave; !',
	'err_unk_user' => '������ ���&Agrave;&Uacute;�&Acirc; &Aacute;�&Agrave;���&Aacute;&ouml; �&Ecirc;�&Agrave;�ϴ&Ugrave; !',
	'x_s_profile' => '%s\'�&Ocirc;&Agrave;� �&sup3;&Agrave;&Icirc;&Aacute;���',
	'group' => '�׷&igrave;',
	'reg_date' => '&Egrave;�����&Agrave;&Ocirc;',
	'disk_usage' => '&micro;�ũ ��뷮',
	'change_pass' => '��й�&Egrave;� ����',
	'current_pass' => '�&ouml;&Agrave;� ��й�&Egrave;�',
	'new_pass' => '���&Icirc;�&icirc; ��й�&Egrave;�',
	'new_pass_again' => '��й�&Egrave;� &Agrave;�&Agrave;&Ocirc;�&Acirc;',
	'err_curr_pass' => '�&ouml;&Agrave;� ��й�&Egrave;��� �&sup2;�&sup3;�ϴ&Ugrave;.',
	'apply_modif' => '������� &Agrave;&uacute;&Agrave;�',
	'change_pass' => '��й�&Egrave;� ����',
	'update_success' => '�&sup3;&Agrave;&Icirc;&Aacute;����� ��&micro;�&Agrave;&Igrave;Ʈ &micro;Ǿ&uacute;�&Agrave;�ϴ&Ugrave;.',
	'pass_chg_success' => '��й�&Egrave;��� ���� &micro;Ǿ&uacute;�&Agrave;�ϴ&Ugrave;.',
	'pass_chg_error' => '��й�&Egrave;��� ����&micro;�&Aacute;&ouml; �&Ecirc;�&Ograve;�&Agrave;�ϴ&Ugrave;.',
);

$lang_register_confirm_email = <<<EOT
�ݰ��&Agrave;�ϴ&Ugrave; !! 

&Agrave;&Igrave; ��&Agrave;�&Agrave;� '{SITE_NAME}' &Egrave;���&micro;&icirc;�� ��û&Agrave;&Uacute;���&Ocirc; ��&sup3;�&micro;帮�&Acirc; ��&Agrave;�&Agrave;&Ocirc;�ϴ&Ugrave;.

�Ʒ� ��&Agrave;&Igrave;&micro;�&Iacute; ��й�&Egrave;��&Acirc; &Agrave;�&Aacute;&ouml;�&Ecirc;&micro;&micro;�� �޸���&micro;&Icirc;�ñ&acirc; �&Ugrave;���ϴ&Ugrave;.

��&Agrave;&Igrave;&micro;� : '{USER_NAME}'
��й�&Egrave;� : '{PASSWORD}'

�&szlig;���&Icirc; �Ʒ� �&micro;ũ�� Ŭ���ؼ� &Egrave;����&Ocirc;&Agrave;� �&egrave;&Aacute;�&Agrave;� &Egrave;���&Egrave;� ���&sup2;�&Ugrave;&Agrave;� �&Icirc;��&Agrave;&Icirc;�ϼ��&auml;. 

{ACT_LINK}

�&acirc;Ÿ ��&Agrave;ǻ���&Agrave;� �&icirc;�&micro;&Agrave;&Uacute; ��&Agrave;� tmax@puchonphoto.com �&Icirc; &Aacute;&Ouml;�ñ&acirc; �&Ugrave;���ϴ&Ugrave;.

{SITE_NAME} �&icirc;�&micro;&Agrave;&Uacute;

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => '&Auml;&Uacute;�&agrave;Ʈ �&Ugrave;�ú��&acirc;',
	'no_comment' => '&Auml;&Uacute;�&agrave;Ʈ ���&Agrave;�ϴ&Ugrave;.',
	'n_comm_del' => '%s comment(s) deleted',
	'n_comm_disp' => '�&auml;&Agrave;&Igrave;&Aacute;&ouml;�� �&acirc;�&Acirc;�&Ucirc;�&ouml;',
	'see_prev' => '&Agrave;&Igrave;&Agrave;&uuml;',
	'see_next' => '�&Ugrave;&Agrave;�',
	'del_comm' => '������ &Auml;&Uacute;�&agrave;Ʈ �&egrave;&Aacute;�',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; ������ �˻&ouml;',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => '�� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml; �˻&ouml;',
	'select_dir' => '���&Icirc;&micro;� &micro;��&auml;��',
	'select_dir_msg' => 'FTP�� &Agrave;&Igrave;�� &Aacute;���&Aacute;� �&uacute;���� &Agrave;&Igrave;�&Igrave; ���&Icirc;&micro;��� �&Auml;&Agrave;�&Agrave;� ���ϴ&Acirc; �������&Iacute; ���&aacute;��&Auml;� &Aacute;&Ouml;�&Acirc; &Agrave;&Ucirc;��&Agrave;� �ϴ&Acirc; ��&Agrave;&Ocirc;�ϴ&Ugrave;. <br /><br />*&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; �&Auml;&Agrave;�&Agrave;�(public_html/gallery/Albums/userpics)�&uacute;���&Icirc; &Agrave;&uuml;�&Ucirc;�� �&Ugrave;&Agrave;� �Ʒ� &Agrave;&Ucirc;��&Agrave;� &Aacute;��&agrave;�մϴ&Ugrave;.<br /><br />1) userpics �� Ŭ���ϸ&eacute; &Agrave;&uuml;ü ����Ʈ ���&icirc;&micro;� ���&Icirc; ���&Icirc;&micro;�&micro;&Egrave; �&Auml;&Agrave;ϸ� üũ&micro;Ǿ&icirc; &Agrave;&Ouml;�&Agrave;�ϴ&Ugrave;.<br />2) ���ϴ&Acirc; �������� ������ �&Ugrave;&Agrave;� "������ &Agrave;&Igrave;�&Igrave;&Aacute;&ouml; ���&aacute;" �&ouml;ư&Agrave;� Ŭ�� &micro;&icirc;���մϴ&Ugrave;.<br /><br />*��&sup3;�&Agrave;� �&Auml;&Agrave;�&Agrave;� &micro;&Icirc; ��&Agrave;� �������� �&micro;ũ�&Ograve; �&ouml; ���&Agrave;�ϴ&Ugrave;. �ش� ���������� �&egrave;&Aacute;�&Egrave;&Auml; &Agrave;�&micro;&icirc;�� �ϼ��&auml;.',
	'no_pic_to_add' => '���&aacute;&micro;&Egrave; &Agrave;&Igrave;�&Igrave;&Aacute;&ouml; ���&Agrave;�ϴ&Ugrave;.',
	'need_one_album' => '��&sup3;� &Agrave;&Igrave;�&oacute;&Agrave;� �&Ugrave;�&uuml;&Agrave;� ������ �&Ugrave;&Agrave;� &Agrave;&Igrave;���ϼ��&auml;.',
	'warning' => '&Aacute;&Ouml;&Agrave;�',
	'change_perm' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�� ���&Icirc;&micro;��ϱ&acirc; &Agrave;&uuml;�� �ش� &micro;��&auml;��&Agrave;� �&Ucirc;�&Igrave;��&Agrave;� 755 �Ǵ&Acirc; 777 �&Icirc; �����ؾ&szlig; �մϴ&Ugrave; !',
	'target_album' => '<b>&quot; %s &quot; �&uacute;��&Agrave;� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�� ���&aacute;�&Ograve; ������ ���� </b>%s',
	'folder' => '���&Icirc;&micro;� �&uacute;��',
	'image' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;',
	'album' => '������',
	'result' => '�&aacute;�&uacute;',
	'dir_ro' => '�&sup2;�&acirc; ���� ���&Agrave;�ϴ&Ugrave;. ',
	'dir_cant_read' => '&Agrave;б&acirc; ���� ���&Agrave;�ϴ&Ugrave;. ',
	'insert' => '�������� ���&Icirc;�&icirc; &Agrave;&Igrave;�&Igrave;&Aacute;&ouml; ���&aacute;',
	'list_new_pic' => '�� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml; ���',
	'insert_selected' => '������ &Agrave;&Igrave;�&Igrave;&Aacute;&ouml; ���&aacute;',
	'no_pic_found' => '�� &Agrave;&Igrave;�&Igrave;&Aacute;&ouml;�� ã&Aacute;&ouml; ���Ͽ��&Agrave;�ϴ&Ugrave;.',
	'be_patient' => '�&aacute;�&uacute; ��&Agrave;&Igrave;&Auml;&Uuml;&Agrave;� &Acirc;&uuml;&Aacute;��ϼ��&auml;.',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : ���&aacute;����'.
				'<li><b>DP</b> : �&Ugrave;�� �������� &Agrave;&Igrave;�&Igrave; &micro;&icirc;��&micro;Ǿ&icirc;&Agrave;&Ouml;&Agrave;�'.
				'<li><b>PB</b> : ����, ���&Icirc;&micro;� &micro;��&auml;��&Agrave;� �&Ucirc;�&Igrave;��&micro;&icirc; �&szlig;��&Agrave;&Ucirc;�� �&Ecirc;�&auml;'.
				'<li>���&agrave; �&aacute;�&uacute;â�� OK, DP, PB &micro;&icirc;&Agrave;� ��&Agrave;&Igrave;&Auml;&Uuml;&Agrave;&Igrave; ǥ��&micro;�&Aacute;&ouml; �&Ecirc;�&Ograve;�&Ugrave;�&eacute; �&Aacute;�&Icirc;�׷�&Agrave;� &Aacute;����ϼ��&auml;.'.
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
	'title' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; ���&Icirc;&micro;�',
	'max_fsize' => '���&Icirc;&micro;� ��� �&Ouml;�� �&Auml;&Agrave;�ũ�&acirc; %s KB',
	'album' => '�&Ugrave;�&uuml;',
	'picture' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;',
	'pic_title' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; &Aacute;���',
	'description' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml; �&sup3;�&iacute;',
	'keywords' => 'Ű�&ouml;&micro;� (�˻&ouml;�&icirc;)',
	'err_no_alb_uploadables' => '�ش� �&Auml;&Agrave;� ���&Agrave;�ϴ&Ugrave;.',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => '���&Agrave;&Uacute;(&Egrave;���)�&uuml;��',
	'name_a' => '&Agrave;&Igrave;�� (a-z)',
	'name_d' => '&Agrave;&Igrave;�� (z-a)',
	'group_a' => '�׷&igrave; (a-z)',
	'group_d' => '�׷&igrave; (z-a)',
	'reg_a' => '&micro;&icirc;�� (a-z)',
	'reg_d' => '&micro;&icirc;�� (z-a)',
	'pic_a' => '&Aacute;�&Egrave;� (a-z)',
	'pic_d' => '&Aacute;�&Egrave;� (z-a)',
	'disku_a' => '��뷮 (a-z)',
	'disku_d' => '��뷮 (z-a)',
	'sort_by' => '&Aacute;��&Auml;����',
	'err_no_users' => '���&Agrave;&Uacute;(&Egrave;���) ��&Agrave;&Igrave;�&iacute;&Agrave;&Igrave; ��&icirc;&Agrave;&Ouml;�&Agrave;�ϴ&Ugrave; !',
	'err_edit_self' => '�&ouml;&Aacute;��&Ograve; �&ouml; ���&Agrave;�ϴ&Ugrave;. �&sup3;&Agrave;&Icirc;&Aacute;��� �&ouml;&Aacute;� �&auml;&Agrave;&Igrave;&Aacute;&ouml;�� &Agrave;&Igrave;���ϼ��&auml;.',
	'edit' => '�&iacute;&Aacute;�',
	'delete' => '�&egrave;&Aacute;�',
	'name' => '���&Agrave;&Uacute; &Agrave;&Igrave;��',
	'group' => '�׷&igrave;',
	'inactive' => '��&Egrave;���',
	'operations' => '���&agrave;�޴�',
	'pictures' => '&Agrave;&Igrave;�&Igrave;&Aacute;&ouml;',
	'disk_space' => '��뷮/�&Ograve;�緮',
	'registered_on' => '&Egrave;���',
	'u_user_on_p_pages' => '%d &Agrave;&uuml;ü %d �&auml;&Agrave;&Igrave;&Aacute;&ouml;',
	'confirm_del' => '�&egrave;&Aacute;� �Ͻð&Uacute;�&Agrave;�ϱ&icirc; ? \\n&micro;&icirc;��&micro;&Egrave; ��&micro;� �&Auml;&Agrave;�&Agrave;&Igrave; �&egrave;&Aacute;�&micro;˴ϴ&Ugrave;.',
	'mail' => '&Agrave;&Igrave;��&Agrave;�',
	'err_unknown_user' => '������ &Egrave;���&Agrave;&Igrave; &Aacute;�&Agrave;���&Aacute;&ouml; �&Ecirc;�&Agrave;�ϴ&Ugrave; !',
	'modify_user' => '&Egrave;���&Aacute;��� �&ouml;&Aacute;�',
	'notes' => '�޸�',
	'note_list' => '<li>��й�&Egrave;��� �&ouml;&Aacute;���&Aacute;&ouml; �&Ecirc;&Agrave;���&igrave; ��&ouml;&micro;&Icirc;�ø&eacute; &micro;˴ϴ&Ugrave;.',
	'password' => '��й�&Egrave;�',
	'user_active' => '&Egrave;���&Egrave;�&micro;&Egrave; ���&Agrave;&Uacute;',
	'user_group' => '���&Agrave;&Uacute; �׷&igrave;',
	'user_email' => '���&Agrave;&Uacute; &Agrave;&Igrave;��&Agrave;�',
	'user_web_site' => '���&Agrave;&Uacute; &Egrave;��&auml;&Agrave;&Igrave;&Aacute;&ouml;',
	'create_new_user' => '���&Icirc;�&icirc; ���&Agrave;&Uacute; ����',
	'user_location' => '&Aacute;��&Oacute;&Aacute;&ouml;',
	'user_interests' => '�&uuml;�&Eacute;�о&szlig;',
	'user_occupation' => '�Ͻô&Acirc; &Agrave;�',
);
?>
