<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery v1.1 Beta 2                                     //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gregory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning Stoverud <henning@stoverud.com>         //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

$lang_charset = 'GB2312';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('������', '����һ', '���ڶ�', '������', '������', '������', '������');
$lang_month = array('һ��', '����', '����', '����', '����', '����', '����', '����', '����', 'ʮ��', 'ʮһ��', 'ʮ����');

// Some common strings
$lang_yes = '��';
$lang_no  = '��';
$lang_back = '����';
$lang_continue = '����';
$lang_info = 'ѶϢ';
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
	'lastup' => '�������ͼƬ',
	'lastcom' => '������������',
	'topn' => '����ͼƬ',
	'toprated' => '����ͶƱ',
	'lasthits' => '����ۿ�',
	'search' => '��Ѱ���'
);

$lang_errors = array(
	'access_denied' => '��û��ʹ�ñ�ҳ��Ȩ��.',
	'perm_denied' => '��û��Ȩ��ִ�д˶���.',
	'param_missing' => '��ʽ���в�����Ҫ�Ĳ���.',
	'non_exist_ap' => '��ѡ��� �౾/ͼƬ ������!',
	'quota_exceeded' => '�ŵ�ʹ�ó���<br><br>������ʹ�õĿռ��� [quota]K, Ŀǰʹ���� [space]K, �����ͼƬ���ܳ���������ʹ�õĿռ��С.',
	'gd_file_type_err' => '��ʹ�� GD ͼ�γ�ʽ�����ʹ�õ�ͼƬ��̬Ϊ JPEG �� PNG.',
	'invalid_image' => '���ϴ���ͼƬ�Ѿ��жϻ��޷��� GD ��ʽ�����',
	'resize_failed' => '�޷�������ͼ��������е�ͼ��.',
	'no_img_to_display' => '��δ��ͼƬ������ʾ',
	'non_exist_cat' => '��ѡ�����𲢲�����',
	'orphan_cat' => '�����������һ�������ڵĸ����, �����������������������.',
	'directory_ro' => 'Ŀ¼ \'%s\' �޷�д��, ����ͼƬ�޷�ɾ��',
	'non_exist_comment' => '��ѡ��������������.',
	'pic_in_invalid_album' => '��ͼƬ���ڲ����ڵ�ͼ��� (%s)!?'
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => '����ͼ�����ҳ',
	'alb_list_lnk' => 'ͼ�����ҳ',
	'my_gal_title' => '���ظ����ಾ',
	'my_gal_lnk' => '�����ಾ',
	'my_prof_lnk' => '�ҵĸ�������',
	'adm_mode_title' => 'ִ�й���ģʽ',
	'adm_mode_lnk' => '����ģʽ',
	'usr_mode_title' => 'ִ��ʹ����ģʽ',
	'usr_mode_lnk' => 'ʹ����ģʽ',
	'upload_pic_title' => '�ϴ�ͼƬ���ಾ',
	'upload_pic_lnk' => '�ϴ�ͼƬ',
	'register_title' => '�����ʺ�',
	'register_lnk' => 'ע��',
	'login_lnk' => '����',
	'logout_lnk' => '�ǳ�',
	'lastup_lnk' => '����ϴ�',
	'lastcom_lnk' => '���������',
	'topn_lnk' => '����ͼƬ',
	'toprated_lnk' => '����ͶƱ',
	'search_lnk' => '��Ѱ',
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => '��׼�ϴ�',
	'config_lnk' => '����',
	'albums_lnk' => 'ͼ���',
	'categories_lnk' => '���',
	'users_lnk' => 'ʹ����',
	'groups_lnk' => 'Ⱥ��',
	'comments_lnk' => '�������',
	'searchnew_lnk' => '�����ϴ�ͼƬ',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => '���� / ���� ͼ���',
	'modifyalb_lnk' => '�༭�ҵ��౾',
	'my_prof_lnk' => '��������',
);

$lang_cat_list = array(
	'category' => '���',
	'albums' => '�౾',
	'pictures' => 'ͼƬ',
);

$lang_album_list = array(
	'album_on_page' => '%d ���౾�� %d ҳ'
);

$lang_thumb_view = array(
	'date' => '����',
	'name' => '����',
	'sort_da' => '��������������',
	'sort_dd' => '��������������',
	'sort_na' => '��������������',
	'sort_nd' => '��������������',
	'pic_on_page' => '%d ��ͼƬ�� %d ҳ',
	'user_on_page' => '%d λʹ������ %d ҳ'
);

$lang_img_nav_bar = array(
	'thumb_title' => '������ͼҳ',
	'pic_info_title' => '��ʾ/���� ͼƬ��Ѷ',
	'slideshow_title' => '��������',
	'ecard_title' => '���� e-card',
	'ecard_disabled' => 'e-cards �ݲ�����',
	'ecard_disabled_msg' => '��û��ʹ��Ȩ',
	'prev_title' => '�ۿ�ǰһ��ͼƬ',
	'next_title' => '�ۿ���һ��ͼƬ',
	'pic_pos' => 'ͼƬ %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'ͶƱ ',
	'no_votes' => '(��δ��ͶƱ)',
	'rating' => '(Ŀǰ�÷� : %s / 5 �� %s ��ͶƱ)',
	'rubbish' => '����',
	'poor' => '��',
	'fair' => 'ѷ����',
	'good' => '����',
	'excellent' => '���ѵ�',
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
	CRITICAL_ERROR => '����',
	'file' => '����: ',
	'line' => '����: ',
);

$lang_display_thumbnails = array(
	'filename' => '���� : ',
	'filesize' => '������С : ',
	'dimensions' => 'ά�� : ',
	'date_added' => '�������� : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s �����',
	'n_views' => '%s �ιۿ�',
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
	0 => '���뿪����ģʽ...',
	1 => '���������ģʽ...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => '����Ҫ��ͼ���һ������ !',
	'confirm_modifs' => 'ȷ��Ҫ����Щ�޸��� ?',
	'no_change' => '��û�����κθı� !',
	'new_album' => '��ͼ���',
	'confirm_delete1' => 'ȷ��Ҫɾ����ͼ����� ?',
	'confirm_delete2' => '\n��ô��ͼ����ڵ�����ͼƬ���������ɾ�� !',
	'select_first' => '����ѡ��һ��ͼ���',
	'alb_mrg' => 'ͼ��й���',
	'my_gallery' => '* �ҵ��౾ *',
	'no_category' => '* û����� *',
	'delete' => 'ɾ��',
	'new' => '����',
	'apply_modifs' => '�ᱨ�޸�',
	'select_category' => 'ѡ�����',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => '\'%s\'��������Ҫ�Ĳ�����δ���ṩʹ��!',
	'unknown_cat' => '��ѡ�����𲢲�����',
	'usergal_cat_ro' => 'ʹ�����౾����޷�ɾ�� !',
	'manage_cat' => '������',
	'confirm_delete' => 'ȷ��Ҫɾ���������',
	'category' => '���',
	'operations' => '����',
	'move_into' => '������',
	'update_create' => '����/���� ���',
	'parent_cat' => '�����',
	'cat_title' => '�������',
	'cat_desc' => '�������'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => '��̬�趨',
	'restore_cfg' => '�ظ�Ԥ����̬',
	'save_cfg' => '�������趨',
	'notes' => 'ע��',
	'info' => 'ѶϢ',
	'upd_success' => '��̬�趨�Ѹ���',
	'restore_success' => 'Ԥ����̬�ѻظ�',
	'name_a' => '������������',
	'name_d' => '���ƽ�������',
	'date_a' => '������������',
	'date_d' => '���ڽ�������'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'�����趨',
	array('�ಾ����', 'gallery_name', 0),
	array('�ಾ����', 'gallery_description', 0),
	array('�ಾ������ email', 'gallery_admin_email', 0),
	array('�ڼ��͵�e-cards����ʾ�ۿ�����ͼƬ��������ַ', 'ecards_more_pic_target', 0),
	array('����', 'lang', 5),
	array('����', 'theme', 6),

	'ͼ�����ʾ�趨',
	array('��Ҫ����� (pixels or %)', 'main_table_width', 0),
	array('ͬһ�����������ʾ����', 'subcat_level', 0),
	array('ͼ�����ʾ����', 'albums_per_page', 0),
	array('ͼ�������', 'album_list_cols', 0),
	array('��ʾ��ͼ�Ĵ�С(pixels)', 'alb_list_thumb_size', 0),
	array('��ҳ������', 'main_page_layout', 0),

	'��ͼ�趨',
	array('��ͼҳ����', 'thumbcols', 0),
	array('��ͼҳ����', 'thumbrows', 0),
	array('�½�ͼƬ��¼��ʾ����', 'max_tabs', 0),
	array('��ʾͼƬ���� (���ӵı���) ����ͼ�·�', 'caption_in_thumbview', 1),
	array('��ʾ���������ͼ�·�', 'display_comment_count', 1),
	array('ͼƬ���������', 'default_sort_order', 3),
	array('Ҫ��ʾ�� \'����ͶƱ\' �ڵ�ͼƬ������Ͷ��Ʊ', 'min_votes_for_rating', 0),

	'�ۿ�ͼƬ &amp; ��������趨',
	array('ͼƬ��ʾ�ı���� (pixels or %)', 'picture_table_width', 0),
	array('ͼƬ��Ѷ��Ԥ��ֵ��ʾ', 'display_pic_info', 1),
	array('���˲��������������', 'filter_bad_words', 1),
	array('�����������ʹ��Ц��ͼʾ', 'enable_smilies', 1),
	array('ͼƬ�������ݵ���󳤶�', 'max_img_desc_length', 0),
	array('�������ݵ������Ԫ��', 'max_com_wlength', 0),
	array('ÿ��������ֵ������', 'max_com_lines', 0),
	array('����������ݵ���󳤶�', 'max_com_size', 0),

	'ͼƬ����ͼ�趨',
	array('JPEG ��ʽƷ��', 'jpeg_qual', 0),
	array('��ͼ������ȼ��߶� <b>*</b>', 'thumb_width', 0),
	array('�������д�СͼƬ','make_intermediate',1),
	array('���д�СͼƬ�Ŀ�Ȼ�߶� <b>*</b>', 'picture_width', 0),
	array('�ϴ�ͼ����������� (KB)', 'max_upl_size', 0),
	array('�ϴ�ͼƬ�Ŀ�Ȼ�߶�������� (pixels)', 'max_upl_width_height', 0),

	'ʹ�����趨',
	array('������ʹ����ע��', 'allow_user_registration', 1),
	array('��ע������Ҫ email ��֤', 'reg_requires_valid_email', 1),
	array('����ͬʹ����ʹ��ͬһ�� email', 'allow_duplicate_emails_addr', 1),
	array('ʹ���߿�����˽�˵��ಾ', 'allow_private_albums', 1),

	'�ÿ�ʹ��ͼƬ��������λ (�����ʹ�������¿հ�)',
	array('ͼƬ����1', 'user_field1_name', 0),
	array('ͼƬ����2', 'user_field2_name', 0),
	array('ͼƬ����3', 'user_field3_name', 0),
	array('ͼƬ����4', 'user_field4_name', 0),

	'ͼƬ����ͼ�Ľ����趨',
	array('���������ų����Ԫ', 'forbiden_fname_char',0),
	array('�ϴ�ͼƬ�ɽ��ܵĸ�����', 'allowed_file_extensions',0),
	array('������ͼ�ķ���','thumb_method',2),
	array('ImageMagick \'convert\' ��ʽ��·�� (���� /usr/bin/X11/)', 'impath', 0),
	array('����ͼƬ��̬ (ֻ�� ImageMagick ��Ч)', 'allowed_img_types',0),
	array('ImageMagick ��������ѡ��', 'im_options', 0),
	array('�ɶ�EXIF ������ JPEG ����', 'read_exif_data', 1),
	array('ͼ���Ŀ¼ <b>*</b>', 'fullpath', 0),
	array('ʹ����ͼƬĿ¼ <b>*</b>', 'userpics', 0),
	array('��������ͼ����ǰ����Ԫ <b>*</b>', 'normal_pfx', 0),
	array('������ͼ����ǰ����Ԫ <b>*</b>', 'thumb_pfx', 0),
	array('����ͼ��Ŀ¼��Ԥ��CHMOD', 'default_dir_mode', 0),
	array('�ϴ�ͼƬ��Ԥ��CHMOD', 'default_file_mode', 0),

	'Cookies &amp; Charset �趨',
	array('����ʽ��ʹ�õ� cookie ����', 'cookie_name', 0),
	array('����ʽ��ʹ�õ� cookie ·��', 'cookie_path', 0),
	array('�����趨', 'charset', 4),

	'Miscellaneous settings',
	array('��������ģʽ', 'debug_mode', 1),

	'<br><div align="center">(*) ��λ�ڱ�ʾ�� * ���ű�ʾ��������Ҫ�޸ģ�Ҳ����˵һ��Ҫ��д</div><br>'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => '������������������',
	'com_added' => '���ṩ����������Ѿ�����',
	'alb_need_title' => '������Ϊͼ����ṩһ������ !',
	'no_udp_needed' => 'û�и��µı�Ҫ.',
	'alb_updated' => 'ͼ����Ѿ�����',
	'unknown_album' => '��ѡ���ͼ��в������ڻ���û��Ȩ���ϴ�ͼƬ����ͼ���',
	'no_pic_uploaded' => 'û��ͼƬ���ϴ� !<br><br>�����ȷ����ѡ��ͼƬ�ϴ�, �����ŷ����ǻ������ϴ�����...',
	'err_mkdir' => '�޷�����Ŀ¼ %s !',
	'dest_dir_ro' => 'Ŀ��Ŀ¼ %s �޷�д�� !',
	'err_move' => '�޷����� %s �� %s !',
	'err_fsize_too_large' => '���ϴ���ͼƬ̫�� (���ܳ��� %s x %s) !',
	'err_imgsize_too_large' => '���ϴ���ͼ��̫�� (���ܳ��� %s KB) !',
	'err_invalid_img' => '�ϴ��ĵ�����������ȷ��ͼƬ��ʽ !',
	'allowed_img_types' => '��ֻ�����ϴ� %s ��ͼƬ.',
	'err_insert_pic' => 'ͼƬ \'%s\' �޷������ͼ��� ',
	'upload_success' => 'ͼƬ�ϴ����<br><br>�������ߺ�׼�����Ϳ��Կ���ͼƬ��.',
	'info' => 'ѶϢ',
	'com_added' => '��������Ѽ���',
	'alb_updated' => 'ͼ����Ѹ���',
	'err_comment_empty' => '��������ǿյ� !',
	'err_invalid_fext' => 'ֻ�����еĸ������ſ����� : <br><br>%s.',
	'no_flood' => '��Ǹ�����Ѿ������һ��Ϊ��ͼƬ�ṩ���<br><br>�������޸��������������',
	'redirect_msg' => '��������.<br><br><br>�� \'����\' ���ҳ��û���Զ�ˢ��',
	'upl_success' => '����ͼƬ�Ѽ������',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => '����',
	'fs_pic' => 'ʵ�ʴ�СͼƬ',
	'del_success' => '���ɾ��',
	'ns_pic' => '��׼��СͼƬ',
	'err_del' => '�޷�ɾ��',
	'thumb_pic' => '��ͼ',
	'comment' => '�������',
	'im_in_alb' => 'ͼƬ��ͼ���',
	'alb_del_success' => 'ͼ��� \'%s\' ��ɾ��',
	'alb_mgr' => 'ͼ��й���',
	'err_invalid_data' => '���յ�����ȷ�������� \'%s\'',
	'create_alb' => '����ͼ��� \'%s\'',
	'update_alb' => '����ͼ��� \'%s\' ����Ϊ \'%s\' ����ֵΪ \'%s\'',
	'del_pic' => 'ɾ��ͼƬ',
	'del_alb' => 'ɾ��ͼ���',
	'del_user' => 'ɾ��ʹ����',
	'err_unknown_user' => '��ѡ���ʹ���߲������� !',
	'comment_deleted' => '��������Ѿ�ɾ��',
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
	'confirm_del' => 'ȷ��Ҫɾ����Ƭ�� ? \\n��ͬ���Ҳ�ᱻɾ��.',
	'del_pic' => 'ɾ����ͼƬ',
	'size' => '%s x %s pixels',
	'views' => '%s ��',
	'slideshow' => '��������',
	'stop_slideshow' => 'ֹͣ��������',
	'view_fs' => '��һ�¹ۿ�����ͼƬ',
);

$lang_picinfo = array(
	'title' =>'ͼƬ��Ϣ',
	'Filename' => '��������',
	'Album name' => 'ͼ�������',
	'Rating' => '���� (%s ��ͶƱ)',
	'Keywords' => '�ؼ���',
	'File Size' => '������С',
	'Dimensions' => 'ά��',
	'Displayed' => '��ʾ',
	'Camera' => 'ͼƬ',
	'Date taken' => 'ȡ������',
	'Aperture' => '����',
	'Exposure time' => 'ʱ��',
	'Focal length' => '��С',
	'Comment' => '���'
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => '�༭���������',
	'confirm_delete' => 'ȷ��Ҫɾ��������� ?',
	'add_your_comment' => '�ṩ������',
	'your_name' => '���Ĵ���',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => '���� e-card',
	'invalid_email' => '<b>����</b> : ����ȷ�� email !',
	'ecard_title' => 'һ�� e-card �� %s ��������',
	'view_ecard' => '��� e-card �޷���ȷ��ʾ, �밴�������',
	'view_more_pics' => '�����￴����ͼƬ !',
	'send_success' => '���Ŀ�Ƭ�Ѿ��ͳ�',
	'send_failed' => '��Ǹ,���ŷ����޷�Ϊ����� e-card...',
	'from' => '��',
	'your_name' => '��Ĵ���',
	'your_email' => '��� email',
	'to' => '��',
	'rcpt_name' => '�ռ�������',
	'rcpt_email' => '�ռ��� email',
	'greetings' => 'ף����',
	'message' => 'ѶϢ����',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'ͼƬ&nbsp;��Ѷ',
	'album' => 'ͼ���',
	'title' => '����',
	'desc' => '����',
	'keywords' => '�ؼ���',
	'pic_info_str' => '%sx%s - %sKB - %s �ιۿ� - %s ��ͶƱ',
	'approve' => '��׼ͼƬ',
	'postpone_app' => 'Postpone approval',
	'del_pic' => 'ɾ��ͼƬ',
	'reset_view_count' => '����ۿ���������',
	'reset_votes' => '����ͶƱ',
	'del_comm' => 'ɾ���������',
	'upl_approval' => '��׼�ϴ�',
	'edit_pics' => '�༭ͼƬ',
	'see_next' => '�ۿ���һ��ͼƬ',
	'see_prev' => '�ۿ���һ��ͼƬ',
	'n_pic' => '%s ��ͼƬ',
	'n_of_pic_to_disp' => 'ͼƬ��ʾ����',
	'apply' => '�ᱨ�޸�'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Ⱥ������',
	'disk_quota' => 'ʹ������',
	'can_rate' => '����ΪͼƬ����',
	'can_send_ecards' => '���Լ��� ecards',
	'can_post_com' => '���������������',
	'can_upload' => '�����ϴ�ͼƬ',
	'can_have_gallery' => '����ʹ�ø��˻��ಾ',
	'apply' => '�ᱨ�޸�',
	'create_new_group' => '������Ⱥ��',
	'del_groups' => 'ɾ����ѡ���Ⱥ��',
	'confirm_del' => '����, ��ɾ����һ��Ⱥ��, ���ڸ�Ⱥ���ʹ���߽���ת���� \'Registered\' Ⱥ���� !Ҳ����˵�����ǽ�ʧȥ����Ȩ��\n\nȷ��Ҫɾ���� ?',
	'title' => '����ʹ����Ⱥ��',
	'approval_1' => '����ͼ����ϴ���׼ (1)',
	'approval_2' => '˽��ͼ����ϴ���׼ (2)',
	'note1' => '<b>(1)</b> �ϴ�ͼƬ�����õ��ಾ������ߺ�׼',
	'note2' => '<b>(2)</b> �ϴ�ͼƬ���Լ����ಾ������ߺ�׼',
	'notes' => 'ע��'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => '��ӭ !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'ȷ��Ҫɾ�����ͼ����� ? \\n��ͼ���������ͼƬ���������ͬʱ��ɾ��.',
	'delete' => 'ɾ��',
	'modify' => '����',
	'edit_pics' => '�༭ͼƬ',
);

$lang_list_categories = array(
	'home' => '��ҳ',
	'stat1' => '<b>[pictures]</b> ��ͼƬ�� <b>[albums]</b> ��ͼ��У� <b>[cat]</b> �����<b>[comments]</b> ����������� �ۿ� <b>[views]</b> ��',
	'stat2' => '<b>[pictures]</b> ��ͼƬ�� <b>[albums]</b> ��ͼ��У� �ۿ� <b>[views]</b> ��',
	'xx_s_gallery' => '%s ���ಾ',
	'stat3' => '<b>[pictures]</b> ��ͼƬ�� <b>[albums]</b> ��ͼ��У� <b>[comments]</b> ������������ۿ� <b>[views]</b> ��'
);

$lang_list_users = array(
	'user_list' => 'ʹ�����б�',
	'no_user_gal' => '��δ��ʹ���߱�����ʹ��ͼ���',
	'n_albums' => '%s ��ͼ���',
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
	'login' => '����',
	'enter_login_pswd' => '����ʹ�������ƺ�����',
	'username' => 'ʹ��������',
	'password' => '����',
	'remember_me' => '��ס����',
	'welcome' => '��ӭ %s ...',
	'err_login' => '*** �޷�����. ������ ***',
	'err_already_logged_in' => '���Ѿ����� !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => '�ǳ�',
	'bye' => '�ټ��� %s ...',
	'err_not_loged_in' => '����δ���� !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => '����ͼ��� %s',
	'general_settings' => 'һ���趨',
	'alb_title' => 'ͼ��б���',
	'alb_cat' => 'ͼ������',
	'alb_desc' => 'ͼ�������',
	'alb_thumb' => 'ͼ�����ͼ',
	'alb_perm' => '��ͼ��д�ȡ���',
	'can_view' => 'ͼ��пɹۿ���',
	'can_upload' => '�ÿͿ����ϴ�ͼƬ',
	'can_post_comments' => '�ÿͿ��������������',
	'can_rate' => '�ÿͿ���ΪͼƬ����',
	'user_gal' => 'ʹ�����ಾ',
	'no_cat' => '* û����� *',
	'alb_empty' => 'ͼ����ǿյ�',
	'last_uploaded' => '����ϴ�',
	'public_alb' => '�κ��� (����ͼ���)',
	'me_only' => 'ֻ����',
	'owner_only' => 'ֻ��ͼ���ӵ���� (%s)',
	'groupp_only' => 'ֻ��Ⱥ���Ա \'%s\'',
	'err_no_alb_to_modify' => '���Ͽ�����δ�������Ա��޵�ͼ���.',
	'update' => '����ͼ���'
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
��������<B> {SITE_NAME} </B>�ᾡ��������������,�����ǲ�������ʱ��ϸ�ۿ�ÿһ�����ļ�. ���������ͬ���ñ�վ��Ȩ�����κ�ʱ�����ʵ��ĵ������������ļ�,�Ա��ֱ�վ��Ʒ��.<br>
<br>
������ͬ�ⲻ�������κ�ɫ��, ����, ����, ������, ������, �������Ұ�ȫ, ������������ȡ���ļ�.<B> {SITE_NAME} </B>���κ�ʱ����Ȩ�����˲��༭������������,����Ȩ�޸������ڱ�վ�ڵ�����. �������,���ǲ��Ὣ��������ת��������ʹ��.����֮��,���ڱ�վ���������ݱ�վ����Ϊ�����κ�����.<br>
<br>
��վʹ��COOKIES���������ĵ�������Ѷ. �����Ƿ������������Ķ���վ��Ѷ. ���� email ֻ����������֤�������϶���,���ǲ�����й.<br>
<br>
���� '��ͬ��' ����.
EOT;

$lang_register_php = array(
	'page_title' => 'ע��ʹ����',
	'term_cond' => '���������',
	'i_agree' => '��ͬ��',
	'submit' => '�ͳ�ע��',
	'err_user_exists' => '������д��ʹ���������ѱ���ʹ��, ������һ��',
	'err_password_mismatch' => '�������벻��, ������һ��',
	'err_uname_short' => 'ʹ�������������� 2 ����Ԫ',
	'err_password_short' => '���������� 2 ����Ԫ',
	'err_uname_pass_diff' => 'ʹ�������ƺ����벻������ͬ',
	'err_invalid_email' => 'Email ����ȷ',
	'err_duplicate_email' => '��� email �Ѿ���������ʹ�ù���',
	'enter_info' => '����ע��������',
	'required_info' => '��Ҫ������',
	'optional_info' => '�Ǳ�Ҫ������',
	'username' => 'ʹ��������',
	'password' => '����',
	'password_again' => 'ȷ������',
	'email' => 'Email',
	'location' => 'λ��',
	'interests' => '��Ȥ',
	'website' => '��ҳ',
	'occupation' => 'ְҵ',
	'error' => '����',
	'confirm_email_subject' => '%s - ע������趨',
	'information' => 'ѶϢ',
	'failed_sending_email' => '��ע��� email �޷��ͳ� !',
	'thank_you' => '��л����ע��.<br><br>һ�� email �ں�����������ʺŵ���Ѷ�����͵������ṩ������.',
	'acct_created' => '�����ʺ��Ѿ����������������Ե������',
	'acct_active' => '�����ʺ��Ѿ����ã����������Ե�������������',
	'acct_already_act' => '�����ʺ��Ѿ����� !',
	'acct_act_failed' => '���ʺ��޷����� !',
	'err_unk_user' => '��ѡ���ʹ���߲������� !',
	'x_s_profile' => '%s\' �ĸ�������',
	'group' => 'Ⱥ��',
	'reg_date' => '����',
	'disk_usage' => '�ռ�ʹ����',
	'change_pass' => '�޸�����',
	'current_pass' => '������',
	'new_pass' => '������',
	'new_pass_again' => 'ȷ������',
	'err_curr_pass' => '�����벻��ȷ',
	'apply_modif' => '�ᱨ�޸�',
	'change_pass' => '�޸��ҵ�����',
	'update_success' => '��ĸ��������Ѿ�����',
	'pass_chg_success' => '��������Ѿ��޸�',
	'pass_chg_error' => '�������û���޸�',
);

$lang_register_confirm_email = <<<EOT
��л��ע���� {SITE_NAME}

�����ʺ� : "{USER_NAME}"
�������� : "{PASSWORD}"

Ϊ�˷������������ʺ�,�����谴һ�����������
�����Ƚ�������������.

{ACT_LINK}

ף����,

 {SITE_NAME} ����

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => '�ۿ����',
	'no_comment' => '��δ��������Թۿ�',
	'n_comm_del' => '%s �������ɾ��',
	'n_comm_disp' => 'Ҫ��ʾ���������',
	'see_prev' => '��ǰһ��',
	'see_next' => '����һ��',
	'del_comm' => 'ɾ����ѡ�����',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'ͶѰͼƬ����',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Ѱ����ͼƬ',
	'select_dir' => 'ѡ��Ŀ¼',
	'select_dir_msg' => '�����ܿ������������������� FTP �ϴ���ͼƬ.<br><br>��ѡ�������ϴ���ͼƬĿ¼',
	'no_pic_to_add' => 'û��ͼƬ���Լ���',
	'need_one_album' => 'Ҫʹ�ô˹��ܱ�����Ҫ��һ��ͼ���',
	'warning' => '����',
	'change_perm' => '��ʽ�޷�д�����Ŀ¼, ���޸�CHMOD Ϊ 755 �� 777 ������һ��!',
	'target_album' => '<b>����ͼƬ &quot;</b>%s<b>&quot; �� </b>%s',
	'folder' => '���ϼ�',
	'image' => 'ͼƬ',
	'album' => 'ͼ���',
	'result' => '���',
	'dir_ro' => '�޷�д��. ',
	'dir_cant_read' => '�޷���ȡ. ',
	'insert' => '����ͼƬ���ಾ',
	'list_new_pic' => '�г���ͼƬ',
	'insert_selected' => '������ѡ���ͼƬ',
	'no_pic_found' => 'û���ҵ���ͼƬ',
	'be_patient' => '�����ĵȺ�, ��ʽ��Ҫһ��ʱ����������ѡͼƬ',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : ��ʾͼƬ�ѳɹ�������'.
				'<li><b>DP</b> : ��ʾͼƬ�ظ����Ѵ������Ͽ�'.
				'<li><b>PB</b> : ��ʾͼƬ�޷�����, ������̬�趨��ͼƬ���Ŀ¼��ʹ��Ȩ��'.
				'<li>��� OK, DP, PB \'����\' û����ʾ�밴������ͼƬ���� PHP ��ʾ�Ĵ���ѶϢ'.
				'<li>���������ӳ�, �밴��������'.
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
	'title' => '�ϴ�ͼƬ',
	'max_fsize' => '������ĵ������Ϊ %s KB',
	'album' => 'ͼ���',
	'picture' => 'ͼƬ',
	'pic_title' => 'ͼƬ����',
	'description' => 'ͼƬ����',
	'keywords' => '�ؼ��� (���Կո�����)',
	'err_no_alb_uploadables' => 'Ŀǰ��δ��ͼ��п��Թ����ϴ�ͼƬ',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'ʹ���߹���',
	'name_a' => '������������',
	'name_d' => '���ƽ�������',
	'group_a' => 'Ⱥ����������',
	'group_d' => 'Ⱥ�齵������',
	'reg_a' => 'ע��������������',
	'reg_d' => 'ע�����ڽ�������',
	'pic_a' => 'ͼƬ����������',
	'pic_d' => 'ͼƬ����������',
	'disku_a' => 'ʹ������������',
	'disku_d' => 'ʹ������������',
	'sort_by' => 'ʹ����������',
	'err_no_users' => 'ʹ�������ϱ��ǿյ� !',
	'err_edit_self' => '���޷��༭��������, ������ \'�ҵĸ�������\' ���༭',
	'edit' => '�༭',
	'delete' => 'ɾ��',
	'name' => 'ʹ��������',
	'group' => 'Ⱥ��',
	'inactive' => 'δ����',
	'operations' => '����',
	'pictures' => 'ͼƬ',
	'disk_space' => '�ռ� ʹ���� / ����',
	'registered_on' => 'ע����',
	'u_user_on_p_pages' => '%d ��ʹ������ %d ҳ',
	'confirm_del' => 'ȷ��Ҫɾ�����ʹ������ ? \\n��ͬ����ͼ��м�ͼƬ���ᱻɾ��.',
	'mail' => 'MAIL',
	'err_unknown_user' => '��ѡ���ʹ���߲������� !',
	'modify_user' => '�༭ʹ����',
	'notes' => 'ע��',
	'note_list' => '<li>����㲻��ı�Ŀǰ������, �뽫 "����" λ���¿հ�',
	'password' => '����',
	'user_active' => 'ʹ����������',
	'user_group' => 'ʹ����Ⱥ��',
	'user_email' => 'ʹ���� email',
	'user_web_site' => 'ʹ������ҳ',
	'create_new_user' => '������ʹ����',
	'user_location' => 'ʹ����λ��',
	'user_interests' => 'ʹ������Ȥ',
	'user_occupation' => 'ʹ����ְҵ',
);
?>
