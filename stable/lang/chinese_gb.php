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
// to all devs: stop overwriting this file!

// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'Chinese(GB2312)',  //the name of your language in English, e.g. 'Greek' or 'Spanish'
'lang_name_native' => '����(����)', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '���˦˦Ǧͦɦ�?' or 'Espanol'
'lang_country_code' => 'cn', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
'trans_name'=> 'hotsnow', //the name of the translator - can be a nickname
'trans_email' => 'webmaster@qilu.tv', //translator's email address (optional)
'trans_website' => 'http://bbs.qilu.tv/', //translator's website (optional)
'trans_date' => '2003-10-16', //the date the translation was created / last modified
);

$lang_charset = 'GB2312';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('����', '��һ', '�ܶ�', '����', '����', '����', '����');
$lang_month = array('һ��', '����', '����', '����', '����', '����', '����', '����', '����', 'ʮ��', 'ʮһ��', 'ʮ����');

// Some common strings
$lang_yes = '��';
$lang_no  = '��';
$lang_back = '����';
$lang_continue = '����';
$lang_info = '��Ϣ';
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
	'random' => '���ͼƬ',
	'lastup' => '�������',
	'lastalb'=> '���¸���ͼ��',
	'lastcom' => '��������',
	'topn' => '����ͼƬ',
	'toprated' => '����ͶƱ',
	'lasthits' => '�������',
	'search' => '�������',
	'favpics'=> '�ҵ��ղ�',
);

$lang_errors = array(
	'access_denied' => '��û��Ȩ�޷��ʸ�ҳ.',
	'perm_denied' => '��û��Ȩ��ִ�иò���.',
	'param_missing' => '�������ȱ�ٲ���.',
	'non_exist_ap' => '��ѡ���ͼ��/ͼƬ������!',
	'quota_exceeded' => '�ռ�ʹ���ѳ����޶�<br><br>���Ŀռ��޶�Ϊ [quota]K, Ŀǰ��ʹ�� [space]K, �����ͼƬ���ܻᳬ�����Ŀռ��޶�.',
	'gd_file_type_err' => '��ǰʹ�� GD ͼ�ο�,���õ�ͼƬ��ʽΪ JPEG �� PNG.',
	'invalid_image' => '���ϴ���ͼƬ���𻵻��޷��� GD ͼ�ο⴦��',
	'resize_failed' => '�޷�������ͼ���С���ʵ�ͼƬ.',
	'no_img_to_display' => 'Ŀǰ����ͼƬ',
	'non_exist_cat' => '��ѡ��ķ��಻����',
	'orphan_cat' => '�������ĸ���𲻴���,���������������.',
	'directory_ro' => 'Ŀ¼ \'%s\' ����д, ͼƬ�޷�ɾ��',
	'non_exist_comment' => '��ѡ������۲�����.',
	'pic_in_invalid_album' => '��ͼƬλ�ڲ����ڵ�ͼ�� (%s)!?',
	'banned' => '��Ŀǰ����ֹ�����վ��.',
	'not_with_udb' => '����ͼ��Ŀǰ����̳������,��˸ù����޷�ʹ��.�������趨ģʽ�²�֧�ָù���,���Ǹù�������̳������.',
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => '����ͼ���б�',
	'alb_list_lnk' => 'ͼ���б�',
	'my_gal_title' => '���ظ���ͼ��',
	'my_gal_lnk' => '����ͼ��',
	'my_prof_lnk' => '�ҵĸ�������',
	'adm_mode_title' => '�������ģʽ',
	'adm_mode_lnk' => '����ģʽ',
	'usr_mode_title' => '�����û�ģʽ',
	'usr_mode_lnk' => '�û�ģʽ',
	'upload_pic_title' => '�ϴ�ͼƬ��ͼ��',
	'upload_pic_lnk' => '�ϴ�ͼƬ',
	'register_title' => 'ע���ʺ�',
	'register_lnk' => 'ע��',
	'login_lnk' => '��¼',
	'logout_lnk' => '�˳�',
	'lastup_lnk' => '�����ϴ�',
	'lastcom_lnk' => '��������',
	'topn_lnk' => '����ͼƬ',
	'toprated_lnk' => '����ͶƱ',
	'search_lnk' => '����',
	'fav_lnk' => '�ҵ��ղ�',

);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => '����ϴ�',
	'config_lnk' => '����',
	'albums_lnk' => 'ͼ��',
	'categories_lnk' => '���',
	'users_lnk' => '�û�',
	'groups_lnk' => 'Ⱥ��',
	'comments_lnk' => '����',
	'searchnew_lnk' => '�������ͼƬ',
	'util_lnk' => '����ͼƬ��С',
	'ban_lnk' => '�����û�',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => '����/���� ͼ��',
	'modifyalb_lnk' => '�༭�ҵ�ͼ��',
	'my_prof_lnk' => '�ҵĸ�������',
);

$lang_cat_list = array(
	'category' => '���',
	'albums' => 'ͼ��',
	'pictures' => 'ͼƬ',
);

$lang_album_list = array(
	'album_on_page' => '%d ��ͼ���� %d ҳ'
);

$lang_thumb_view = array(
	'date' => '����',
	//Sort by filename and title
	'name' => '�ļ���',
	'title' => '����',
	'sort_da' => '��������������',
	'sort_dd' => '�����ڽ�������',
	'sort_na' => '��������������',
	'sort_nd' => '�����ƽ�������',
	'sort_ta' => '��������������',
	'sort_td' => '�����⽵������',
	'pic_on_page' => '%d ��ͼƬ�� %d ҳ',
	'user_on_page' => '%d λ�û��� %d ҳ'
);

$lang_img_nav_bar = array(
	'thumb_title' => '������ͼҳ��',
	'pic_info_title' => '��ʾ/���� ͼƬ��Ϣ',
	'slideshow_title' => '��������',
	'ecard_title' => '���͵��Ӻؿ�',
	'ecard_disabled' => '���Ӻؿ��ݲ�����',
	'ecard_disabled_msg' => '����Ȩ���͵��Ӻؿ�',
	'prev_title' => 'ǰһ��ͼƬ',
	'next_title' => '��һ��ͼƬ',
	'pic_pos' => 'ͼƬ %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'ͶƱ ',
	'no_votes' => '(����ͶƱ)',
	'rating' => '(Ŀǰ�÷� : %s / 5 �� %s ��ͶƱ)',
	'rubbish' => '����',
	'poor' => '�ϲ�',
	'fair' => 'һ��',
	'good' => '�ܺ�',
	'excellent' => '����',
	'great' => '̫����',
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
	CRITICAL_ERROR => 'ϵͳ����',
	'file' => '�ļ�: ',
	'line' => '����: ',
);

$lang_display_thumbnails = array(
	'filename' => '�ļ��� : ',
	'filesize' => '�ļ���С : ',
	'dimensions' => '�ߴ� : ',
	'date_added' => '�������� : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s ������',
	'n_views' => '%s �����',
	'n_votes' => '(%s ��ͶƱ)'
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
	'Exclamation' => '��̾',
	'Question' => '����',
	'Very Happy' => '����',
	'Smile' => '΢Ц',
	'Sad' => '����',
	'Surprised' => '����',
	'Shocked' => '��',
	'Confused' => '�ɻ�',
	'Cool' => '��',
	'Laughing' => '��Ц',
	'Mad' => '��',
	'Razz' => '��Ц',
	'Embarassed' => 'Embarassed',
	'Crying or Very sad' => '��޻�ǳ�����',
	'Evil or Very Mad' => 'а��Ļ����',
	'Twisted Evil' => 'Twisted Evil',
	'Rolling Eyes' => 'ת����',
	'Wink' => 'գ��',
	'Idea' => 'Idea',
	'Arrow' => '��',
	'Neutral' => '����',
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
	0 => '���뿪����ģʽ...',
	1 => '���������ģʽ...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => '����Ҫ��ͼ��һ������ !',
	'confirm_modifs' => '��ȷ��Ҫ����Щ�޸��� ?',
	'no_change' => '��û�����κ��޸� !',
	'new_album' => '��ͼ��',
	'confirm_delete1' => '��ȷ��Ҫɾ����ͼ���� ?',
	'confirm_delete2' => '\n��ͼ���ڵ�����ͼƬ�����۶��ᱻɾ�� !',
	'select_first' => '����ѡ��һ��ͼ��',
	'alb_mrg' => 'ͼ������',
	'my_gallery' => '* �ҵ�ͼ�� *',
	'no_category' => '* û����� *',
	'delete' => 'ɾ��',
	'new' => '���',
	'apply_modifs' => '�ύ�޸�',
	'select_category' => 'ѡ�����',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => '\'%s\'����ȱ�ٱ�Ҫ�Ĳ��� !',
	'unknown_cat' => '��ѡ�����𲻴���',
	'usergal_cat_ro' => '�û�ͼ������޷�ɾ�� !',
	'manage_cat' => '������',
	'confirm_delete' => '��ȷ��Ҫɾ��������� ?',
	'category' => '���',
	'operations' => '����',
	'move_into' => '�ƶ���',
	'update_create' => '����/���� ���',
	'parent_cat' => '�����',
	'cat_title' => '�������',
	'cat_desc' => '�������'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'ϵͳ����',
	'restore_cfg' => '�ָ�ԭʼ����',
	'save_cfg' => '����������',
	'notes' => 'ע��',
	'info' => '��Ϣ',
	'upd_success' => '�����Ѹ���',
	'restore_success' => 'ԭʼ�����ѻָ�',
	'name_a' => '���Ƶ���',
	'name_d' => '���Ƶݼ�',
	'title_a' => '�������',
	'title_d' => '����ݼ�',
	'date_a' => '���ڵ���',
	'date_d' => '���ڵݼ�',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',

);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'�����趨',
	array('ͼ������', 'gallery_name', 0),
	array('ͼ������', 'gallery_description', 0),
	array('����Ա�����ʼ�', 'gallery_admin_email', 0),
	array('�ڷ��͵ĵ��Ӻؿ�����ʾ \'���͸���ͼƬ\' ��������ַ', 'ecards_more_pic_target', 0),
	array('����', 'lang', 5),
	//array('��������ѡ��', 'lang_select_enable', 8 ),
	array('����', 'theme', 6),
	//array('��������ѡ��', 'theme_select_enable', 8),

	'ͼ���б���ʾ�趨',
	array('������� (pixels or %)', 'main_table_width', 0),
	array('ͬһ�����������ʾ����', 'subcat_level', 0),
	array('ͼ����ʾ����', 'albums_per_page', 0),
	array('ͼ���б������', 'album_list_cols', 0),
	array('��ʾ��ͼ�Ĵ�С(pixels)', 'alb_list_thumb_size', 0),
	array('��ҳ����', 'main_page_layout', 0),
	array('���������ʾ��һ��ͼ������ͼ','first_level',1), //new in cpg1.2.0

	'��ͼ�趨',
	array('��ͼҳ����', 'thumbcols', 0),
	array('��ͼҳ����', 'thumbrows', 0),
	array('��ʾ����� tab ��', 'max_tabs', 0),
	array('��ʾͼƬ���� (���ӵı���) ����ͼ�·�', 'caption_in_thumbview', 1),
	array('��ʾ����������ͼ�·�', 'display_comment_count', 1),
	array('ͼƬ��Ĭ�����д���', 'default_sort_order', 3),
	array('Ҫ��ʾ�� \'����ͶƱ\' �ڵ�ͼƬ������Ͷ��Ʊ', 'min_votes_for_rating', 0),

	'ͼƬ��ʾ &amp; �����趨',
	array('ͼƬ��ʾ�ı���� (pixels or %)', 'picture_table_width', 0),
	array('Ĭ����ʾͼƬ��Ϣ', 'display_pic_info', 1),
	array('���������еĲ����ַ�', 'filter_bad_words', 1),
	array('�����п���ʹ��Ц��ͼʾ', 'enable_smilies', 1),
	array('ͼƬ�������ݵ���󳤶�', 'max_img_desc_length', 0),
	array('ÿ�����ʵ�����ַ���', 'max_com_wlength', 0),
	array('������ÿ�����������ַ���', 'max_com_lines', 0),
	array('�������ݵ���󳤶�', 'max_com_size', 0),
	array('��ʾͼƬԤ����', 'display_film_strip', 1),
	array('ͼƬԤ���е�ͼƬ��', 'max_film_strip_items', 0),

	'ͼƬ����ͼ�趨',
	array('JPEG ��ʽƷ��', 'jpeg_qual', 0),
	array('��ͼ������ȼ��߶� <b>*</b>', 'thumb_width', 0),
	array('ʹ�óߴ磨���߻���ͼ���ߴ磩<b>*</b>', 'thumb_use', 7),
	array('�������д�С��ͼƬ','make_intermediate',1),
	array('���д�СͼƬ�Ŀ�Ȼ�߶� <b>*</b>', 'picture_width', 0),
	array('�ϴ�ͼƬ��������� (KB)', 'max_upl_size', 0),
	array('�ϴ�ͼƬ�Ŀ�Ȼ�߶�������� (pixels)', 'max_upl_width_height', 0),

	'�û��趨',
	array('�������û�ע��', 'allow_user_registration', 1),
	array('�û�ע����Ҫ Email ��֤', 'reg_requires_valid_email', 1),
	array('����ͬ�û�ʹ��ͬһ�� Email', 'allow_duplicate_emails_addr', 1),
	array('�����û�����˽��ͼ��', 'allow_private_albums', 1),

	'�Զ����ͼƬ���� (�������������)',
	array('ͼƬ����1', 'user_field1_name', 0),
	array('ͼƬ����2', 'user_field2_name', 0),
	array('ͼƬ����3', 'user_field3_name', 0),
	array('ͼƬ����4', 'user_field4_name', 0),

	'ͼƬ����ͼ�ĸ߼��趨',
	array('������ͼ��ͼ����ʾ��δ��¼���û�','show_private',1),
	array('�ļ������õ��ַ�', 'forbiden_fname_char',0),
	array('�ϴ�ͼƬ�������չ��', 'allowed_file_extensions',0),
	array('������ͼ�ķ���','thumb_method',2),
	array('ImageMagick \'convert\' �����·�� (���� /usr/bin/X11/)', 'impath', 0),
	array('����ͼƬ������ (���� ImageMagick ��Ч)', 'allowed_img_types',0),
	array('ImageMagick ��������ѡ��', 'im_options', 0),
	array('��ȡ JPEG ͼƬ�� EXIF ��Ϣ', 'read_exif_data', 1),
	array('ͼ��Ŀ¼ <b>*</b>', 'fullpath', 0),
	array('�û�ͼƬĿ¼ <b>*</b>', 'userpics', 0),
	array('��������ͼƬ��ǰ���ַ� <b>*</b>', 'normal_pfx', 0),
	array('������ͼ��ǰ���ַ� <b>*</b>', 'thumb_pfx', 0),
	array('Ŀ¼��ȱʡ CHMOD', 'default_dir_mode', 0),
	array('ͼƬ�ļ���ȱʡ CHMOD', 'default_file_mode', 0),
	array('��󵯳����ڽ�������Ҽ� (JavaScript - ���ṩ��������)', 'disable_popup_rightclick', 1),
	array('���д��ڽ�������Ҽ� (JavaScript - ���ṩ��������)', 'disable_gallery_rightclick', 1),

	'Cookies &amp; �ַ��� �趨',
	array('��������ʹ�õ� cookie ����', 'cookie_name', 0),
	array('��������ʹ�õ� cookie ·��', 'cookie_path', 0),
	array('�ַ�������', 'charset', 4),

	'��������',
	array('���õ���ģʽ', 'debug_mode', 1),

	'<br><div align="center">(*) ���ͼ��������ͼƬ,����� * �ŵ�������޸�</div><br>'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => '�������������ֺ�����',
	'com_added' => '���������Ѽ���',
	'alb_need_title' => '������Ϊͼ���ṩһ������ !',
	'no_udp_needed' => 'û�б�Ҫ����.',
	'alb_updated' => 'ͼ���Ѹ���',
	'unknown_album' => '��ѡ���ͼ�������ڻ���û��Ȩ���ϴ�ͼƬ����ͼ��',
	'no_pic_uploaded' => 'ͼƬû�б��ϴ� !<br><br>�����ȷʵѡ�����ϴ�ͼƬ, ����������ǻ������ϴ��ļ�...',
	'err_mkdir' => '�޷�����Ŀ¼ %s !',
	'dest_dir_ro' => 'Ŀ��Ŀ¼ %s �޷�д�� !',
	'err_move' => '�޷��ƶ� %s �� %s !',
	'err_fsize_too_large' => '���ϴ���ͼƬ̫�� (���ܳ��� %s x %s) !',
	'err_imgsize_too_large' => '���ϴ����ļ�̫�� (���ܳ��� %s KB) !',
	'err_invalid_img' => '�ϴ����ļ�������Ч��ͼƬ��ʽ !',
	'allowed_img_types' => '���������ϴ� %s ��ͼƬ.',
	'err_insert_pic' => 'ͼƬ \'%s\' �޷������ͼ�� ',
	'upload_success' => 'ͼƬ�ϴ����<br><br>����Ա��˺�ſ�����ʾ.',
	'info' => '��Ϣ',
	'com_added' => '�����Ѽ���',
	'alb_updated' => 'ͼ���Ѹ���',
	'err_comment_empty' => '�����ǿյ� !',
	'err_invalid_fext' => 'ֻ�������������չ�����ļ� : <br><br>%s.',
	'no_flood' => '��Ǹ,��ͼƬ�ĵ�ǰ���һ���������������<br><br>�������޸ķ����������',
	'redirect_msg' => '����ת��.<br><br><br>���ҳ��û���Զ�ˢ��,�밴 \'����\'',
	'upl_success' => '����ͼƬ�ѳɹ�����',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => '����',
	'fs_pic' => 'ʵ�ʴ�СͼƬ',
	'del_success' => '�ɹ�ɾ��',
	'ns_pic' => '��׼��СͼƬ',
	'err_del' => '�޷�ɾ��',
	'thumb_pic' => '��ͼ',
	'comment' => '����',
	'im_in_alb' => 'ͼƬ��ͼ��',
	'alb_del_success' => 'ͼ�� \'%s\' ��ɾ��',
	'alb_mgr' => 'ͼ������',
	'err_invalid_data' => '���յ�����ȷ�������� \'%s\'',
	'create_alb' => '����ͼ�� \'%s\'',
	'update_alb' => '����ͼ�� \'%s\' ����Ϊ \'%s\' ����ֵΪ \'%s\'',
	'del_pic' => 'ɾ��ͼƬ',
	'del_alb' => 'ɾ��ͼ��',
	'del_user' => 'ɾ���û�',
	'err_unknown_user' => '��ѡ����û������� !',
	'comment_deleted' => '������ɾ��',
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
	'confirm_del' => 'ȷ��Ҫɾ����ͼƬ�� ? \\n��ͬ����Ҳ�ᱻһ��ɾ��.',
	'del_pic' => 'ɾ����ͼƬ',
	'size' => '%s x %s ����',
	'views' => '%s ��',
	'slideshow' => '��������',
	'stop_slideshow' => 'ֹͣ��������',
	'view_fs' => '����ۿ�����ͼƬ',
);

$lang_picinfo = array(
	'title' =>'ͼƬ��Ϣ',
	'Filename' => '�ļ���',
	'Album name' => 'ͼ������',
	'Rating' => '���� (%s ��ͶƱ)',
	'Keywords' => '�ؼ���',
	'File Size' => '�ļ���С',
	'Dimensions' => '�ߴ�',
	'Displayed' => '��ʾ',
	'Camera' => '����ͺ�',
	'Date taken' => '����ʱ��',
	'Aperture' => '��Ȧ',
	'Exposure time' => '�ع�ʱ��',
	'Focal length' => '����',
	'Comment' => 'ע��',
	'addFav'=>'��ӵ��ҵ��ղ�',
	'addFavPhrase'=>'�ҵ��ղ�',
	'remFav'=>'���ҵ��ղ�ɾ��',
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => '�༭����',
	'confirm_delete' => 'ȷ��ɾ�������� ?',
	'add_your_comment' => '��������',
	'name'=>'�ǳ�',
	'comment'=>'����',
	'your_name' => '��������',
);

$lang_fullsize_popup = array(
	'click_to_close' => '����ͼƬ�رմ���',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => '���͵��Ӻؿ�',
	'invalid_email' => '<b>����</b> : ��Ч�� Email ��ַ!',
	'ecard_title' => '����� %s ���������ĵ��Ӻؿ�',
	'view_ecard' => '������Ӻؿ��޷���ȷ��ʾ, �����������',
	'view_more_pics' => '����������͸���ͼƬ !',
	'send_success' => '���ĵ��Ӻؿ��ѷ���',
	'send_failed' => '��Ǹ,��ǰ�޷�Ϊ�����͵��Ӻؿ�...',
	'from' => '������',
	'your_name' => '��������',
	'your_email' => '���� Email',
	'to' => '������',
	'rcpt_name' => '�ռ�������',
	'rcpt_email' => '�ռ��� Email',
	'greetings' => 'ף����',
	'message' => '��Ϣ����',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'ͼƬ&nbsp;��Ϣ',
	'album' => 'ͼ��',
	'title' => '����',
	'desc' => '����',
	'keywords' => '�ؼ���',
	'pic_info_str' => '%sx%s - %sKB - %s �ε�� - %s ��ͶƱ',
	'approve' => '���ͼƬ',
	'postpone_app' => '�ݲ���׼',
	'del_pic' => 'ɾ��ͼƬ',
	'reset_view_count' => '���õ������',
	'reset_votes' => '����ͶƱ',
	'del_comm' => 'ɾ������',
	'upl_approval' => '��׼�ϴ�',
	'edit_pics' => '�༭ͼƬ',
	'see_next' => '��һ��ͼƬ',
	'see_prev' => '��һ��ͼƬ',
	'n_pic' => '%s ��ͼƬ',
	'n_of_pic_to_disp' => 'ͼƬ��ʾ����',
	'apply' => '�ύ�޸�'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Ⱥ������',
	'disk_quota' => '�����޶�',
	'can_rate' => '����ΪͼƬ����',
	'can_send_ecards' => '�����͵��Ӻؿ�',
	'can_post_com' => '����������',
	'can_upload' => '�����ϴ�ͼƬ',
	'can_have_gallery' => '�������ͼ��',
	'apply' => '�ύ�޸�',
	'create_new_group' => '������Ⱥ��',
	'del_groups' => 'ɾ����ѡ���Ⱥ��',
	'confirm_del' => '����, ���ɾ��һ��Ⱥ��, �����ڸ�Ⱥ����û�����ת���� \'Registered\' Ⱥ���� !Ҳ����˵,���ǽ�ʧȥ����Ȩ��\n\nȷ��Ҫɾ���� ?',
	'title' => '�����û�Ⱥ��',
	'approval_1' => '����ͼ���ϴ���� (1)',
	'approval_2' => '����ͼ���ϴ���� (2)',
	'note1' => '<b>(1)</b> �ϴ�������ͼ����ͼƬ����������',
	'note2' => '<b>(2)</b> �ϴ�������ͼ����ͼƬ����������',
	'notes' => 'ע��'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => '��ӭ!'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'ȷ��Ҫɾ����ͼ���� ? \\n��ͼ��������ͼƬ�����۽���ͬʱ��ɾ��.',
	'delete' => 'ɾ��',
	'modify' => '����',
	'edit_pics' => '�༭ͼƬ',
);

$lang_list_categories = array(
	'home' => '��ҳ',
	'stat1' => '<b>[pictures]</b> ��ͼƬ�� <b>[albums]</b> ��ͼ��,<b>[cat]</b> �����,<b>[comments]</b> ������,��� <b>[views]</b> ��',
	'stat2' => '<b>[pictures]</b> ��ͼƬ�� <b>[albums]</b> ��ͼ��,��� <b>[views]</b> ��',
	'xx_s_gallery' => '%s ��ͼ��',
	'stat3' => '<b>[pictures]</b> ��ͼƬ�� <b>[albums]</b> ��ͼ��,<b>[comments]</b> ������,��� <b>[views]</b> ��'
);

$lang_list_users = array(
	'user_list' => '�û��б�',
	'no_user_gal' => '��δ���û�ͼ��',
	'n_albums' => '%s ��ͼ��',
	'n_pics' => '%s ��ͼƬ'
);

$lang_list_albums = array(
	'n_pictures' => '%s ��ͼƬ',
	'last_added' => ', ��������� %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => '��½',
	'enter_login_pswd' => '�������û����������½',
	'username' => '�û���',
	'password' => '����',
	'remember_me' => '��ס����',
	'welcome' => '��ӭ %s ...',
	'err_login' => '*** �޷���½. ������ ***',
	'err_already_logged_in' => '���Ѿ���½ !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => '�˳�',
	'bye' => '�ټ�,%s ...',
	'err_not_loged_in' => '����δ��½ !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => '����ͼ�� %s',
	'general_settings' => 'һ������',
	'alb_title' => 'ͼ������',
	'alb_cat' => 'ͼ�����',
	'alb_desc' => 'ͼ������',
	'alb_thumb' => 'ͼ����ͼ',
	'alb_perm' => 'ͼ�����Ȩ��',
	'can_view' => 'ͼ������ۿ���',
	'can_upload' => '�ÿͿ����ϴ�ͼƬ',
	'can_post_comments' => '�ÿͿ��Է�������',
	'can_rate' => '�ÿͿ���ΪͼƬ����',
	'user_gal' => '�û�ͼ��',
	'no_cat' => '* û����� *',
	'alb_empty' => 'ͼ��Ϊ��',
	'last_uploaded' => '�����ϴ�',
	'public_alb' => '�κ��� (����ͼ��)',
	'me_only' => 'ֻ����',
	'owner_only' => 'ֻ��ͼ��ӵ���� (%s)',
	'groupp_only' => 'ֻ��Ⱥ���Ա \'%s\'',
	'err_no_alb_to_modify' => '���ݿ���û�п��Ա༭��ͼ��.',
	'update' => '����ͼ��'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => '��Ǹ,���Ѿ�Ϊ��ͼƬ��������',
	'rate_ok' => '����ͶƱ�Ѿ�������',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
����Ա�ᾡ��������������,�����ǲ�������ʱ��ϸ�쿴ÿһ���ļ�. ��վ��Ȩ�����κ�ʱ������������ļ����ʵ��ĵ���.<br>
<br>
������ͬ�ⲻ�������κ�ɫ�顢�����������������������������������Ұ�ȫ��������������ȡ�õ��ļ�.��վ���κ�ʱ����Ȩ�����˲��༭������������,
<br>
����Ȩ�޸����ڱ�վ�ڵ�����.�������,���ǲ��Ὣ�����κ�����͸©���κε�����.����֮��,���ڱ�վ���������ݱ�վ�������κ�����.<br>
<br>
��վʹ��COOKIES��������Ϣ.�������������Ķ���վ��Ϣ. ���� Email ֻ��������֤��������,���Ǿ�������й.<br>
<br>
���� '��ͬ��' ����.
EOT;

$lang_register_php = array(
	'page_title' => '�û�ע��',
	'term_cond' => '���������',
	'i_agree' => '��ͬ��',
	'submit' => '�ύע��',
	'err_user_exists' => '���û����Ѵ���,������',
	'err_password_mismatch' => '�������벻һ��,������',
	'err_uname_short' => '�û���������Ҫ 2 ���ַ�',
	'err_password_short' => '����������Ҫ 2 ���ַ�',
	'err_uname_pass_diff' => '�û��������벻������ͬ',
	'err_invalid_email' => 'Email ����ȷ',
	'err_duplicate_email' => '��� Email �Ѿ���������ʹ�ù���',
	'enter_info' => '����ע������Ϣ',
	'required_info' => '���������',
	'optional_info' => '��ѡ������',
	'username' => '�û���',
	'password' => '����',
	'password_again' => 'ȷ������',
	'email' => 'Email',
	'location' => 'λ��',
	'interests' => '��Ȥ',
	'website' => '��ҳ',
	'occupation' => 'ְҵ',
	'error' => '����',
	'confirm_email_subject' => '%s - ע��ȷ��',
	'information' => '��Ϣ',
	'failed_sending_email' => '�޷�����ע��ȷ�� Email !',
	'thank_you' => '��л����ע��.<br><br>һ���ں���μ����ʺŵ���Ϣ�� Email �ѱ����͵���������.',
	'acct_created' => '�����ʺ�������,���������Ե�½',
	'acct_active' => '�����ʺ��Ѽ���,���������Ե�½',
	'acct_already_act' => '�����ʺ��Ѿ����� !',
	'acct_act_failed' => '���ʺ��޷����� !',
	'err_unk_user' => '��ѡ����û������� !',
	'x_s_profile' => '%s �ĸ�������',
	'group' => 'Ⱥ��',
	'reg_date' => '����',
	'disk_usage' => '�ռ�ʹ����',
	'change_pass' => '�޸�����',
	'current_pass' => '������',
	'new_pass' => '������',
	'new_pass_again' => 'ȷ������',
	'err_curr_pass' => '�����벻��ȷ',
	'apply_modif' => '�ύ�޸�',
	'change_pass' => '�޸�����',
	'update_success' => '���ĸ��������Ѹ���',
	'pass_chg_success' => '�����������޸�',
	'pass_chg_error' => '��������û���޸�',
);

$lang_register_confirm_email = <<<EOT
��л��ע�� {SITE_NAME}

�����ʺ� : "{USER_NAME}"
�������� : "{PASSWORD}"

Ϊ�˼��������ʺ�,��������һ�����������
�����Ƚ�������Ӵ�����.�Ժ��ټ���.

{ACT_LINK}

��л��,

 {SITE_NAME} ����

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => '�鿴����',
	'no_comment' => '�������ۿ��Բ鿴',
	'n_comm_del' => '%s ��������ɾ��',
	'n_comm_disp' => 'Ҫ��ʾ����������',
	'see_prev' => '����һ��',
	'see_next' => '����һ��',
	'del_comm' => 'ɾ����ѡ������',
);

// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => '����ͼƬ',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => '������ͼƬ',
	'select_dir' => 'ѡ��Ŀ¼',
	'select_dir_msg' => '�����ܿ������������������� FTP �ϴ���ͼƬ.<br><br>��ѡ�������ϴ���ͼƬĿ¼',
	'no_pic_to_add' => 'û��ͼƬ���Լ���',
	'need_one_album' => 'Ҫʹ�ô˹��ܱ���������һ��ͼ��',
	'warning' => '����',
	'change_perm' => '�޷�д�����Ŀ¼, ���޸� CHMOD Ϊ 755 �� 777 ������һ��!',
	'target_album' => '<b>����ͼƬ &quot;</b>%s<b>&quot; �� </b>%s',
	'folder' => '�ļ���',
	'image' => 'ͼƬ',
	'album' => 'ͼ��',
	'result' => '���',
	'dir_ro' => '�޷�д��. ',
	'dir_cant_read' => '�޷���ȡ. ',
	'insert' => '����ͼƬ��ͼ��',
	'list_new_pic' => '�г���ͼƬ',
	'insert_selected' => '������ѡ���ͼƬ',
	'no_pic_found' => 'û���ҵ���ͼƬ',
	'be_patient' => '���Ժ�,������ҪһЩʱ����������ѡͼƬ',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : ��ʾͼƬ�ѳɹ�����'.
				'<li><b>DP</b> : ��ʾͼƬ�ظ����Ѵ���'.
				'<li><b>PB</b> : ��ʾͼƬ�޷�����, ����ϵͳ���û�ͼƬ���Ŀ¼�ķ���Ȩ��'.
				'<li>��� OK, DP, PB \'����\' û����ʾ,�����𻵵�ͼƬ�鿴 PHP ��ʾ�Ĵ�����Ϣ'.
				'<li>����������ʱ, ���ˢ�°�ť'.
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
                'title' => '�����û�',
                'user_name' => '�û���',
                'ip_address' => 'IP��ַ',
                'expiry' => '���ޣ��ձ�ʾ���ã�',
                'edit_ban' => '��������',
                'delete_ban' => 'ɾ��',
                'add_new' => '��������û�',
                'add_ban' => '���',
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => '�ϴ�ͼƬ',
	'max_fsize' => '��������ļ����Ϊ %s KB',
	'album' => 'ͼ��',
	'picture' => 'ͼƬ',
	'pic_title' => 'ͼƬ����',
	'description' => 'ͼƬ����',
	'keywords' => '�ؼ��� (���Կո�ָ�)',
	'err_no_alb_uploadables' => 'Ŀǰ����ͼ���������ϴ�ͼƬ',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => '�û�����',
	'name_a' => '������������',
	'name_d' => '���ƽ�������',
	'group_a' => 'Ⱥ����������',
	'group_d' => 'Ⱥ�齵������',
	'reg_a' => 'ע��������������',
	'reg_d' => 'ע�����ڽ�������',
	'pic_a' => 'ͼƬ����������',
	'pic_d' => 'ͼƬ����������',
	'disku_a' => '�ռ�ʹ����������',
	'disku_d' => '�ռ�ʹ�ý�������',
	'sort_by' => '�û�������',
	'err_no_users' => '�û����ϱ��ǿյ� !',
	'err_edit_self' => '���޷��༭��������, ��ʹ�� \'�ҵĸ�������\' ���༭',
	'edit' => '�༭',
	'delete' => 'ɾ��',
	'name' => '�û���',
	'group' => 'Ⱥ��',
	'inactive' => 'δ����',
	'operations' => '����',
	'pictures' => 'ͼƬ',
	'disk_space' => '�ռ� ʹ����/����',
	'registered_on' => 'ע������',
	'u_user_on_p_pages' => '%d ���û��� %d ҳ',
	'confirm_del' => 'ȷ��Ҫɾ������û��� ? \\n��ͬ����ͼ����ͼƬ���ᱻɾ��.',
	'mail' => 'MAIL',
	'err_unknown_user' => '��ѡ����û������� !',
	'modify_user' => '�༭�û�',
	'notes' => 'ע��',
	'note_list' => '<li>����������޸ĵ�ǰ����, �뽫 "����" ������',
	'password' => '����',
	'user_active' => '�û�����',
	'user_group' => '�û�Ⱥ��',
	'user_email' => '�û� Email',
	'user_web_site' => '�û���ҳ',
	'create_new_user' => '�������û�',
	'user_location' => '�û�λ��',
	'user_interests' => '�û���Ȥ',
	'user_occupation' => '�û�ְҵ',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => '����ͼƬ��С',
        'what_it_does' => '������ʲô�õ�',
        'what_update_titles' => '���ļ���ȡ�ñ���',
        'what_delete_title' => 'ɾ������',
        'what_rebuild' => '������ͼ����������С��ͼƬ',
        'what_delete_originals' => 'ɾ��ԭʼ��С��ͼƬ���Ե�������С��ȡ��',
        'file' => '�ļ�',
        'title_set_to' => '���������',
       'submit_form' => '�ύ',
        'updated_succesfully' => '���³ɹ�',
        'error_create' => '��������',
        'continue' => '��������ͼƬ',
        'main_success' => 'ͼƬ %s �ѳɹ���Ϊ��ҪͼƬ',
        'error_rename' => '�޷��� %s ������ %s',
        'error_not_found' => '�ļ� %s ������',
        'back' => '����������',
        'thumbs_wait' => '���ڸ�����ͼ��(��)��������С��ͼƬ,���Ժ�...',
        'thumbs_continue_wait' => '����������ͼ��(��)��������С��ͼƬ...',
        'titles_wait' => '���������,���Ժ�...',
        'delete_wait' => '����ɾ������,���Ժ�...',
        'replace_wait' => '�����Ե�������С��ͼƬȡ��ԭʼ��СͼƬ,���Ժ�...',
        'instruction' => '���ײ���˵��',
        'instruction_action' => '��ѡ�����',
        'instruction_parameter' => '�趨����',
        'instruction_album' => 'ѡ��ͼ��',
        'instruction_press' => '�밴 %s',
        'update' => '������ͼ��(��)��������С��ͼƬ',
        'update_what' => 'Ҫ����ʲô',
        'update_thumb' => 'ֻ����ͼ',
        'update_pic' => 'ֻ�е�������С��ͼƬ',
        'update_both' => '��ͼ����������С��ͼƬ',
        'update_number' => 'ÿ��ѡһ��Ҫ�����ͼƬ��Ŀ',
        'update_option' => '(�����������������ʱ������,�����ż�С���趨)',
        'filename_title' => '�ļ���ͼƬ����',
        'filename_how' => '����޸��ļ���',
        'filename_remove' => 'ɾ�� .jpg ���� _ (�»���) �ÿո�ȡ��',
        'filename_euro' => '�� 2003_11_23_13_20_20.jpg �ĳ� 23/11/2003 13:20',
        'filename_us' => '�� 2003_11_23_13_20_20.jpg �ĳ� 11/23/2003 13:20',
        'filename_time' => '�� 2003_11_23_13_20_20.jpg �ĳ� 13:20',
        'delete' => 'ɾ��ͼƬ�����ԭʼ�ߴ��ͼƬ',
        'delete_title' => 'ɾ��ͼƬ����',
        'delete_original' => 'ɾ��ԭʼ�ߴ��ͼƬ',
        'delete_replace' => 'ɾ��ԭʼ�ߴ��ͼƬ���Ե�������С��ͼƬȡ��',
        'select_album' => 'ѡ��ͼ��',
);

?>