<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery                                                 //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gregory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning Stoverud <henning@stoverud.com>         //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
//  Hacked by Tarique Sani <tarique@sanisoft.com> and Girsh Nair             //
//  <girish@sanisoft.com> see http://www.sanisoft.com/cpg/README.txt for     //
//  details                                                                  //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'chinese',  //the name of your language in English, e.g. 'Greek' or 'Spanish'
'lang_name_native' => '����', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
'lang_country_code' => 'cn', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
'trans_name'=> 'Jking Jin', //the name of the translator - can be a nickname
'trans_email' => 'jkingyy@eyou.com', //translator's email address (optional)
'trans_website' => 'http://jking.vip.cn/', //translator's website (optional)
'trans_date' => '2003-10-13', //the date the translation was created / last modified
);

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
        'lastup' => '��������ͼƬ',
        'lastalb'=> '�����µ����', //new in cpg1.2.0
        'lastcom' => '���µ�����',
        'topn' => '����ͼƬ',
        'toprated' => '����ͶƱ',
        'lasthits' => '���¹ۿ�',
        'search' => '�������', //new in cpg1.2.0
        'favpics'=> '�ղص�ͼƬ' //new in cpg1.2.0
);

$lang_errors = array(
        'access_denied' => '��û��Ȩ�޷��ʴ�ҳ��.',
        'perm_denied' => '��û��Ȩ��ִ�д˲���.',
        'param_missing' => '����ȱ����Ҫ�Ĳ���.',
        'non_exist_ap' => 'ѡ������/ͼƬ������!',
        'quota_exceeded' => '�ռ䳬��<br><br>�����ʹ�õĿռ��� [quota]K, Ŀǰʹ���� [space]K, �����ͼƬ���ܳ��������ʹ�õĿռ��С.',
        'gd_file_type_err' => 'ʹ��GDͼ�γ����ʱ��ʹ�õ�ͼƬ��ʽΪJPEG��PNG.',
        'invalid_image' => '���ϴ���ͼƬ�Ѿ��𻵻��޷���GD����⴦��',
        'resize_failed' => '�޷�����΢��ͼ�����е�ͼƬ.',
        'no_img_to_display' => 'û�п�����ʾ��ͼƬ',
        'non_exist_cat' => 'ѡ�����𲻴���',
        'orphan_cat' => '������ĸ���𲻴���, �������������������������.',
        'directory_ro' => 'Ŀ¼ \'%s\' �ǲ���д��, ͼƬ����ɾ��',
        'non_exist_comment' => 'ѡ������۲�����.',
        'pic_in_invalid_album' => 'ͼƬ��һ�������ڵ���� (%s)!?', //new in cpg1.2.0
        'banned' => '���Ѿ�����ֹ��������վ.', //new in cpg1.2.0
        'not_with_udb' => '�������������ǲ����õģ���Ϊ���Ǻ���̳���ɵģ������������ò�֧�֣������������Ӧ�ü�����̳�����.', //new in cpg1.2.0
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
        'alb_list_title' => '���ص�ר���б�',
        'alb_list_lnk' => 'ר���б�',
        'my_gal_title' => '���ص��ҵĸ������',
        'my_gal_lnk' => '�ҵ����',
        'my_prof_lnk' => '�ҵĸ�������',
        'adm_mode_title' => '�л�������ģʽ',
        'adm_mode_lnk' => '����ģʽ',
        'usr_mode_title' => '�л����û�ģʽ',
        'usr_mode_lnk' => '�û�ģʽ',
        'upload_pic_title' => '�ϴ�һ��ͼƬ�������',
        'upload_pic_lnk' => '�ϴ�ͼƬ',
        'register_title' => '����һ���ʻ�',
        'register_lnk' => 'ע��',
        'login_lnk' => '����',
        'logout_lnk' => '�ǳ�',
        'lastup_lnk' => '�����ϴ�',
        'lastcom_lnk' => '��������',
        'topn_lnk' => '����ͼƬ',
        'toprated_lnk' => '����ͶƱ',
        'search_lnk' => '����',
        'fav_lnk' => '�ҵ��ղؼ�', //new in cpg1.2.0

);

$lang_gallery_admin_menu = array(
      	'upl_app_lnk' => '����ϴ�',
	'config_lnk' => '����',
	'albums_lnk' => 'ר��',
	'categories_lnk' => '���',
	'users_lnk' => '�û�',
	'groups_lnk' => '�û���',
	'comments_lnk' => '����',
	'searchnew_lnk' => '�����ϴ�ͼƬ',
        'util_lnk' => '����ͼƬ��С', //new in cpg1.2.0
        'ban_lnk' => '��ֹ�û�', //new in cpg1.2.0
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'ר������',
	'modifyalb_lnk' => '�༭�ҵ�ר��',
	'my_prof_lnk' => '��������',
);

$lang_cat_list = array(
	'category' => '���',
	'albums' => 'ר��',
	'pictures' => 'ͼƬ',
);

$lang_album_list = array(
        'album_on_page' => '%d ��ר���� %d ҳ'
);

$lang_thumb_view = array(
        'date' => '����',
        //Sort by filename and title
        'name' => '�ļ���', //new in cpg1.2.0
        'title' => '����', //new in cpg1.2.0
        'sort_da' => '��������������',
        'sort_dd' => '�����ڽ�������',
        'sort_na' => '���ļ�����������',
        'sort_nd' => '���ļ�����������',
        'sort_ta' => '��������������', //new in cpg1.2.0
        'sort_td' => '�����⽵������', //new in cpg1.2.0
        'pic_on_page' => '%d ��ͼƬ�� %d ҳ',
        'user_on_page' => '%d �û��� %d ҳ'
);

$lang_img_nav_bar = array(
	'thumb_title' => '���ص�΢��ͼҳ',
	'pic_info_title' => '��ʾ/����ͼƬѶϢ',
	'slideshow_title' => '�õ�Ƭ����',
	'ecard_title' => '��Ϊ���ӿ�Ƭ���ͳ����ͼƬ',
	'ecard_disabled' => '���ӿ�Ƭ������',
	'ecard_disabled_msg' => '�㲻�������ͳ�������ӿ�Ƭ',
	'prev_title' => '�ۿ�ǰһ��ͼƬ',
	'next_title' => '�ۿ���һ��ͼƬ',
	'pic_pos' => 'ͼƬ %s/%s',
);

$lang_rate_pic = array(
        'rate_this_pic' => 'ͶƱ',
        'no_votes' => '(û��ͶƱ)',
        'rating' => '(Ŀǰ��ͶƱ : %s / 5 �� %s ͶƱ)',
        'rubbish' => '�ܲ�',
        'poor' => '��',
        'fair' => 'һ��',
        'good' => '��',
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
        CRITICAL_ERROR => '���� ',
        'file' => '�ļ� : ',
        'line' => '�к� : ',
);

$lang_display_thumbnails = array(
        'filename' => '�ļ��� : ',
        'filesize' => '�ļ���С : ',
        'dimensions' => 'ά�� : ',
        'date_added' => '�������� : '
);

$lang_get_pic_data = array(
        'n_comments' => '%s ����',
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
        'Exclamation' => '��̾',
        'Question' => '����',
        'Very Happy' => '�ǳ�����',
        'Smile' => '΢Ц',
        'Sad' => '�ѹ�',
        'Surprised' => '����',
        'Shocked' => '��',
        'Confused' => '����',
        'Cool' => '��',
        'Laughing' => '��Ц',
        'Mad' => '����',
        'Razz' => '��Ц',
        'Embarassed' => 'Embarassed',
        'Crying or Very sad' => '�ǳ��ѹ�',
        'Evil or Very Mad' => 'Evil or Very Mad',
        'Twisted Evil' => 'Twisted Evil',
        'Rolling Eyes' => 'ת�����۾�',
        'Wink' => 'գ��',
        'Idea' => '�뷨',
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
        'alb_need_name' => 'ר��������һ�����֣�',
        'confirm_modifs' => 'ȷ��Ҫ����Щ�޸���',
        'no_change' => '��û�����κθı䣡',
        'new_album' => '��ר��',
        'confirm_delete1' => 'ȷ��Ҫɾ����ר����',
        'confirm_delete2' => '\n��ר�������е�ͼƬ�����۶�����ɾ����',
        'select_first' => '��ѡ��һ��ר��',
        'alb_mrg' => 'ר������',
        'my_gallery' => '* �ҵ���� *',
        'no_category' => '* û����� *',
        'delete' => 'ɾ��',
        'new' => '����',
        'apply_modifs' => '�ύ�޸�',
        'select_category' => 'ѡ�����',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
        'miss_param' => ' \'%s\' ������Ҫ�Ĳ���û�б��ṩ��',
        'unknown_cat' => 'ѡ�����𲻴���',
        'usergal_cat_ro' => '�û��������ܱ�ɾ��',
        'manage_cat' => '������',
        'confirm_delete' => 'ȷ��Ҫɾ���������',
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
        'title' => '����',
        'restore_cfg' => '�ָ���Ĭ������',
        'save_cfg' => '�����µ�����',
        'notes' => 'ע��',
        'info' => 'ѶϢ',
        'upd_success' => '�����Ѿ�����',
        'restore_success' => 'ȱʡ�����Ѿ��ָ�',
        'name_a' => '������������',
        'name_d' => '���ƽ�������',
        'title_a' => '������������', //new in cpg1.2.0
        'title_d' => '���ý�������', //new in cpg1.2.0
        'date_a' => '������������',
        'date_d' => '���ڽ�������'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
        '�����趨',
        array('�����', 'gallery_name', 0),
        array('�������', 'gallery_description', 0),
        array('�������ߵ����ʼ�', 'gallery_admin_email', 0),
        array('���ӿ�Ƭ�а��� \'������ͼƬ\' ������', 'ecards_more_pic_target', 0),
        array('����', 'lang', 5),
        array('���', 'theme', 6),

        'ר���б���ͼ',
        array('������� (���ػ�ٷֱ�)', 'main_table_width', 0),
        array('ͬһ������������ʾ��', 'subcat_level', 0),
        array('��ʾ��ר����', 'albums_per_page', 0),
        array('ר���б��е�����', 'album_list_cols', 0),
        array('΢��ͼ�Ĵ�С(����)', 'alb_list_thumb_size', 0),
        array('��ҳ�������', 'main_page_layout', 0),
        array('���������ʾ��һ��ר����΢��ͼ','first_level',1), //new in cpg1.2.0

        '΢��ͼ����',
        array('΢��ͼҳ������', 'thumbcols', 0),
        array('΢��ͼҳ������', 'thumbrows', 0),
        array('��ʾ������ǩ��', 'max_tabs', 0),
        array('��ʾ��΢��ͼ�·�ͼƬ����(���ӵı���)', 'caption_in_thumbview', 1),
        array('��ʾ��΢��ͼ�·���������', 'display_comment_count', 1),
        array('ͼƬȱʡ�����д���', 'default_sort_order', 3),
        array('��ʾΪ \'����ͶƱ\' ��ͼƬ��������Ʊ��', 'min_votes_for_rating', 0),

        '�ۿ�ͼƬ &amp; ��������',
        array('ͼƬ��ʾ�ı���� (���ػ�ٷֱ�)', 'picture_table_width', 0),
        array('ȱʡͼƬѶϢ�ǲ��ɼ���', 'display_pic_info', 1),
        array('Ҫ�������й��˵Ĳ�������', 'filter_bad_words', 1),
        array('������������ʹ��Ц��ͼʾ', 'enable_smilies', 1),
        array('ͼƬ��������󳤶�', 'max_img_desc_length', 0),
        array('������ÿ�����ʵ�����ַ���', 'max_com_wlength', 0),
        array('������ÿ�����ֵ��������', 'max_com_lines', 0),
        array('���۵���󳤶�', 'max_com_size', 0),
        array('չʾ��Ӱ����', 'display_film_strip', 1), //new in cpg1.2.0
        array('��Ӱ�����е���Ŀ��', 'max_film_strip_items', 0), //new in cpg1.2.0

        'Pictures and thumbnails settings',
        array('JPEG�ļ�Ʒ��', 'jpeg_qual', 0),
        array('΢��ͼ������ȼ��߶� <b>*</b>', 'thumb_width', 0), //new in cpg1.2.0
        array('�óߴ�(΢��ͼƬ�Ŀ�Ȼ�߶Ȼ�����)<b>*</b>', //new in cpg1.2.0 'thumb_use', 7),
        array('�����еȴ�СͼƬ','make_intermediate',1),
        array('�еȴ�СͼƬ�Ŀ�Ȼ�߶� <b>*</b>', 'picture_width', 0),
        array('�ϴ�ͼƬ������ַ���(KB)', 'max_upl_size', 0),
        array('�ϴ�ͼƬ������Ȼ�߶�(����)', 'max_upl_width_height', 0),

	'�û�����',
	array('�������û�ע��', 'allow_user_registration', 1),
	array('���û���Ҫ�����ʼ���֤', 'reg_requires_valid_email', 1),
	array('����ͬ�û�ʹ��ͬһ�������ʼ�', 'allow_duplicate_emails_addr', 1),
	array('�û�������˽�˵�ר��', 'allow_private_albums', 1),

	'ͼƬ���������ֶ�(�����ʹ��������)',
	array('�ֶ�1', 'user_field1_name', 0),
	array('�ֶ�2', 'user_field2_name', 0),
	array('�ֶ�3', 'user_field3_name', 0),
	array('�ֶ�4', 'user_field4_name', 0),

        'ͼƬ��΢��ͼ�ĸ߼��趨',
        array('��δ������û���ʾ˽��ר��ͼ��','show_private',1), //new in cpg1.2.0
        array('�ļ����в�������ֵ��ַ�', 'forbiden_fname_char',0),
        array('�ϴ�ͼƬ�ɽ��ܵ��ļ���չ��', 'allowed_file_extensions',0),
        array('����΢��ͼ�ķ���','thumb_method',2),
        array('ImageMagick \'convert\' ����·�� (���� /usr/bin/X11/)', 'impath', 0),
        array('����ͼƬ���� (������ImageMagick��Ч)', 'allowed_img_types',0),
        array('ImageMagick���������ѡ��', 'im_options', 0),
        array('��JPEG�ļ��ж�EXIF����', 'read_exif_data', 1),
        array('ר�� <b>*</b>', 'fullpath', 0),
        array('�û�ͼƬ��Ŀ¼ <b>*</b>', 'userpics', 0),
        array('�еȴ�СͼƬ�ļ�����ǰ׺ <b>*</b>', 'normal_pfx', 0),
        array('΢��ͼƬ�ļ�����ǰ׺ <b>*</b>', 'thumb_pfx', 0),
        array('Ŀ¼ȱʡģʽ', 'default_dir_mode', 0),
        array('ͼƬȱʡģʽ', 'default_file_mode', 0),
        array('ȫ�����������½�ֹ����Ҽ�����', 'disable_popup_rightclick', 1), //new in cpg1.2.0
        array('������ &quot;����&quot; ҳ�� (JavaScript - no foolproof method) ��ֹ����Ҽ�����', 'disable_gallery_rightclick', 1), //new in cpg1.2.0

        'Cookies &amp; �ַ�������',
        array('cookie����', 'cookie_name', 0),
        array('cookie·��', 'cookie_path', 0),
        array('�ַ�����', 'charset', 4),

        '��������',
        array('��������ģʽ', 'debug_mode', 1),

        '<br /><div align="center">�������������ͼƬ�����Ϊ*���ֶα��뱻�ı�</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => '������������ֺ���������',
	'com_added' => '��������Ѿ�����',
	'alb_need_title' => '�����Ϊר���ṩһ�����⣡',
	'no_udp_needed' => '����Ҫ���и��¡�',
	'alb_updated' => 'ר���Ѿ�����',
	'unknown_album' => '��ѡ���ר�������ڻ���û��Ȩ���ϴ�ͼƬ����ר����',
	'no_pic_uploaded' => 'û��ͼƬ���ϴ� !<br><br>�����ȷ����ѡ��ͼƬ�ϴ�, ����������Ƿ������ϴ��ļ�...',
	'err_mkdir' => '���ܽ���Ŀ¼ %s !',
	'dest_dir_ro' => 'Ŀ��Ŀ¼ %s ����д�� !',
	'err_move' => '�����ƶ� %s �� %s !',
	'err_fsize_too_large' => '���ϴ���ͼƬ̫�� (���ͼƬ�ߴ��� %s x %s) !',
	'err_imgsize_too_large' => '���ϴ���ͼƬ̫�� (���ͼƬ�ֽ����� %s KB) !',
	'err_invalid_img' => '�ϴ����ļ�������Ч��ͼƬ��ʽ !',
	'allowed_img_types' => '��ֻ�����ϴ� %s ��ͼƬ.',
	'err_insert_pic' => 'ͼƬ \'%s\' �޷������ר���� ',
	'upload_success' => 'ͼƬ�ɹ��ϴ�<br><br>����������˺���Ϳ��Կ���ͼƬ��.',
	'info' => 'ѶϢ',
	'com_added' => '�����Ѽ���',
	'alb_updated' => 'ר���Ѹ���',
	'err_comment_empty' => '���������ǿյ� !',
	'err_invalid_fext' => 'ֻ�����е��ļ���չ���ſ���ʹ�� : <br><br>%s.',
	'no_flood' => '��Ǹ�����Ѿ������һ��Ϊ��ͼƬ�ṩ����<br><br>������޸��㷢���������',
	'redirect_msg' => '������ת��.<br><br><br>�� \'����\' ���ҳ��û���Զ�ˢ��',
	'upl_success' => '���ͼƬ�Ѿ��ɹ����',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => '����',
	'fs_pic' => 'ʵ�ʴ�СͼƬ',
	'del_success' => '�ɹ�ɾ��',
	'ns_pic' => '�����СͼƬ',
	'err_del' => '����ɾ��',
	'thumb_pic' => '΢��ͼ',
	'comment' => '����',
	'im_in_alb' => 'ר���е�ͼƬ',
	'alb_del_success' => 'ר�� \'%s\' ��ɾ��',
	'alb_mgr' => 'ר������',
	'err_invalid_data' => '���յ���Ч�������� \'%s\'',
	'create_alb' => '����ר�� \'%s\'',
	'update_alb' => '����ר�� \'%s\' ����Ϊ \'%s\' ����ֵΪ \'%s\'',
	'del_pic' => 'ɾ��ͼƬ',
	'del_alb' => 'ɾ��ר��',
	'del_user' => 'ɾ���û�',
	'err_unknown_user' => '��ѡ����û������� !',
	'comment_deleted' => '�����Ѿ�ɾ��',
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
	'confirm_del' => 'ȷ��Ҫɾ����ͼƬ�� ? \\n�������Ҳ�ᱻɾ��.',
	'del_pic' => 'ɾ����ͼƬ',
	'size' => '%s x %s ����',
	'views' => '%s ��',
	'slideshow' => '�õ�Ƭ����',
	'stop_slideshow' => 'ֹͣ�õ�Ƭ����',
	'view_fs' => '����ۿ�ȫ��ͼƬ',
);

$lang_picinfo = array(
	'title' =>'ͼƬ��Ϣ',
	'Filename' => '�ļ�����',
	'Album name' => 'ר������',
	'Rating' => '���� (%s ��ͶƱ)',
	'Keywords' => '�ؼ���',
	'File Size' => '�ļ���С',
	'Dimensions' => 'ά��',
	'Displayed' => '��ʾ',
	'Camera' => '����',
	'Date taken' => 'ȡ������',
	'Aperture' => '��϶',
	'Exposure time' => '�ع�ʱ��',
	'Focal length' => '�۽����',
	'Comment' => '����'
        'addFav'=>'���ӵ��ղؼ���', //new in cpg1.2.0
        'addFavPhrase'=>'�ղؼ�', //new in cpg1.2.0
        'remFav'=>'���ղؼ����Ƴ�', //new in cpg1.2.0
);

$lang_display_comments = array(
	'OK' => '��',
	'edit_title' => '�༭������',
	'confirm_delete' => 'ȷ��Ҫɾ���������� ?',
	'add_your_comment' => '�������',
        'name'=>'����', //new in cpg1.2.0
        'comment'=>'����', //new in cpg1.2.0
        'your_name' => 'Anon', //new in cpg1.2.0
);

$lang_fullsize_popup = array(
        'click_to_close' => '���ͼƬ�ر��������', //new in cpg1.2.0
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => '���͵��ӿ�Ƭ',
	'invalid_email' => '<b>����</b> : ����ȷ�ĵ����ʼ���ַ !',
	'ecard_title' => 'һ�ŵ��ӿ�Ƭ �� %s ��������',
	'view_ecard' => '������ӿ�Ƭ�޷���ȷ��ʾ, �밴�������',
	'view_more_pics' => '��������Ӳ鿴�����ͼƬ !',
	'send_success' => '��ĵ��ӿ�Ƭ�Ѿ��ͳ�',
	'send_failed' => '��Ǹ,�������޷�Ϊ����͵��ӿ�Ƭ...',
	'from' => '��',
	'your_name' => '�������',
	'your_email' => '��ĵ����ʼ�',
	'to' => '��',
	'rcpt_name' => '�ռ�������',
	'rcpt_email' => '�ռ��ߵ����ʼ�',
	'greetings' => 'ף����',
	'message' => 'ѶϢ',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'ͼƬ&nbsp;ѶϢ',
	'album' => 'ר��',
	'title' => '����',
	'desc' => '����',
	'keywords' => '�ؼ���',
	'pic_info_str' => '%sx%s - %sKB - %s �ιۿ� - %s ��ͶƱ',
	'approve' => '���ͼƬ',
	'postpone_app' => '�ӳ����',
	'del_pic' => 'ɾ��ͼƬ',
	'reset_view_count' => '���ùۿ���',
	'reset_votes' => '����ͶƱ',
	'del_comm' => 'ɾ������',
	'upl_approval' => '����ϴ�',
	'edit_pics' => '�༭ͼƬ',
	'see_next' => '�ۿ���һ��ͼƬ',
	'see_prev' => '�ۿ���һ��ͼƬ',
	'n_pic' => '%s ��ͼƬ',
	'n_of_pic_to_disp' => 'ͼƬ��ʾ����',
	'apply' => '�ύ�޸�'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => '�û�������',
	'disk_quota' => '�ռ�����',
	'can_rate' => '����ΪͼƬ����',
	'can_send_ecards' => '���Լ��͵��ӿ�Ƭ',
	'can_post_com' => '���Է�������',
	'can_upload' => '�����ϴ�ͼƬ',
	'can_have_gallery' => '����ʹ�ø������',
	'apply' => '�ύ�޸�',
	'create_new_group' => '�������û���',
	'del_groups' => 'ɾ��ѡ����û���',
	'confirm_del' => '����, ��ɾ����һ���û���, ���ڸ��û�����û�����ת���� \'δע��\' �û����� !Ҳ����˵�����ǽ�ʧȥ����Ȩ��\n\nȷ��Ҫɾ���� ?',
	'title' => '�����û���',
	'approval_1' => '����ר���ϴ���� (1)',
	'approval_2' => '˽��ר���ϴ���� (2)',
	'note1' => '<b>(1)</b> �ϴ�ͼƬ�����õ�ר������������',
	'note2' => '<b>(2)</b> �ϴ�ͼƬ���Լ���ר������������',
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
	'confirm_delete' => 'ȷ��Ҫɾ�����ר���� ? \\n��ר��������ͼƬ�����۽���ͬʱ��ɾ��.',
	'delete' => 'ɾ��',
	'modify' => '����',
	'edit_pics' => '�༭ͼƬ',
);

$lang_list_categories = array(
	'home' => '��ҳ',
	'stat1' => '<b>[pictures]</b> ��ͼƬ�� <b>[albums]</b> ��ר���� <b>[cat]</b> �����<b>[comments]</b> ���������ۣ� �ۿ� <b>[views]</b> ��',
	'stat2' => '<b>[pictures]</b> ��ͼƬ�� <b>[albums]</b> ��ר���� �ۿ� <b>[views]</b> ��',
	'xx_s_gallery' => '%s �����',
	'stat3' => '<b>[pictures]</b> ��ͼƬ�� <b>[albums]</b> ��ר���� <b>[comments]</b> ���������ۣ��ۿ� <b>[views]</b> ��'
);

$lang_list_users = array(
	'user_list' => '�û��б�',
	'no_user_gal' => 'û���û����',
	'n_albums' => '%s �����',
	'n_pics' => '%s ��ͼƬ'
);

$lang_list_albums = array(
	'n_pictures' => '%s ��ͼƬ',
	'last_added' => ', ���������� %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => '����',
	'enter_login_pswd' => '�����û���������',
	'username' => '�û���',
	'password' => '����',
	'remember_me' => '��ס����',
	'welcome' => '��ӭ %s ...',
	'err_login' => '*** ���ܵ���. ������ ***',
	'err_already_logged_in' => '���Ѿ����� !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => '�ǳ�',
	'bye' => '�ټ� %s ����ӭ��������',
	'err_not_loged_in' => '��û�е��� !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => '����ר�� %s',
	'general_settings' => '��ͨ����',
	'alb_title' => 'ר������',
	'alb_cat' => 'ר�����',
	'alb_desc' => 'ר������',
	'alb_thumb' => 'ר��΢��ͼ',
	'alb_perm' => '���ܷ��ʸ�ר��',
	'can_view' => 'ר�����Թۿ���',
	'can_upload' => '�ÿͿ����ϴ�ͼƬ',
	'can_post_comments' => '�ÿͿ��Է�������',
	'can_rate' => '�ÿͿ���ΪͼƬ����',
	'user_gal' => '�û����',
	'no_cat' => '* û����� *',
	'alb_empty' => 'ר���ǿյ�',
	'last_uploaded' => '�����ϴ�',
	'public_alb' => '�κ��� (����ר��)',
	'me_only' => 'ֻ����',
	'owner_only' => 'ֻ��ר��ӵ���� (%s)',
	'groupp_only' => 'ֻ���û����Ա \'%s\'',
	'err_no_alb_to_modify' => '���ݿ���û��������޸ĵ�ר��.',
	'update' => '����ר��'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => '��Ǹ,���Ѿ�Ϊ��ͼƬ��������',
	'rate_ok' => '���ͶƱ�Ѿ�������',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
<B> {SITE_NAME} </B>�Ĺ���Ա�ᾡ��鿴�������,�����ǲ�������ʱ��ϸ�ۿ�ÿһ������. ��������ͬ���ñ�վ��Ȩ�����κ�ʱ�����ʵ��ĵ����㷢�������,�Ա��ֱ�վ���е�Ʒ��.<br>
<br>
�����ͬ�ⲻ�ɷ����漰�κ��й�ɫ��, ����, ����, ������, ������, �������Ұ�ȫ������.<B> {SITE_NAME} </B>���κ�ʱ����Ȩ�����˲��༭�㷢�������,����Ȩ�޸������ڱ�վ���������. �������,���ǲ��Ὣ�������ת��������ʹ��.����֮��,���ڱ�վ��������ݱ�վ������Ϊ�㸺�κ�����.<br>
<br>
��վʹ��COOKIES��������ĵ�����ѶϢ. �����Ƿ�����������Ķ���վѶϢ. ��ĵ����ʼ�ֻ����������֤������϶���,���ǲ�����й.<br>
<br>
���� '��ͬ��' ����.
EOT;

$lang_register_php = array(
	'page_title' => 'ע���û�',
	'term_cond' => '���������',
	'i_agree' => '��ͬ��',
	'submit' => '�ύע��',
	'err_user_exists' => '������д���û����ѱ�����ʹ��, ������һ��',
	'err_password_mismatch' => '�������벻һ��, ������һ��',
	'err_uname_short' => '�û����������� 2 ���ַ�',
	'err_password_short' => '���������� 2 ���ַ�',
	'err_uname_pass_diff' => '�û��������벻������ͬ',
	'err_invalid_email' => '�ʼ���ַ����ȷ',
	'err_duplicate_email' => '��������ʼ���ַ�Ѿ���������ʹ�ù���',
	'enter_info' => '����ע��ѶϢ',
	'required_info' => '���������',
	'optional_info' => 'ѡ�������',
	'username' => '�û���',
	'password' => '����',
	'password_again' => 'ȷ������',
	'email' => '�����ʼ�',
	'location' => 'λ��',
	'interests' => '��Ȥ',
	'website' => '��ҳ',
	'occupation' => 'ְҵ',
	'error' => '����',
	'confirm_email_subject' => '%s - ע��ȷ��',
	'information' => 'ѶϢ',
	'failed_sending_email' => '�����͵���ע�����ṩ���ʼ��У�',
	'thank_you' => '��л���ע��.<br><br>һ�⼤�����ʺŵ��ʼ������͵���ע�����ṩ��������.',
	'acct_created' => '����ʺ��Ѿ������������ڿ���������û������������',
	'acct_active' => '����ʺ��Ѿ���������ڿ���������û������������',
	'acct_already_act' => '����ʺ��Ѿ����',
	'acct_act_failed' => '���ʺŲ��ܼ��',
	'err_unk_user' => 'ѡ����û������ڣ�',
	'x_s_profile' => '%s\' �ĸ�������',
	'group' => '�û���',
	'reg_date' => '��������',
	'disk_usage' => '�ռ�ʹ����',
	'change_pass' => '�޸�����',
	'current_pass' => '��ǰ����',
	'new_pass' => '������',
	'new_pass_again' => '����һ��������',
	'err_curr_pass' => '��ǰ���벻��ȷ',
	'apply_modif' => '�ύ�޸�',
	'change_pass' => '�޸��ҵ�����',
	'update_success' => '��ĸ��������Ѿ�����',
	'pass_chg_success' => '��������Ѿ��ı�',
	'pass_chg_error' => '�������û�иı�',
);

$lang_register_confirm_email = <<<EOT
��л���� {SITE_NAME} ��ע��

����ʺ� : "{USER_NAME}"
������� : "{PASSWORD}"

Ϊ�˼�������ʺţ�����������������
���߿����������Ȼ��ճ�������������С�

{ACT_LINK}

ף���㣬

{SITE_NAME} �����Ŷ�

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => '�ۿ�����',
	'no_comment' => 'û�����ۿ��Թۿ�',
	'n_comm_del' => '%s �������Ѿ�ɾ��',
	'n_comm_disp' => 'Ҫ��ʾ����������',
	'see_prev' => '��ǰһ��',
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
	'select_dir_msg' => '�����ܿ����������μ�������FTP�ϴ���ͼƬ.<br><br>��ѡ�������ϴ���ͼƬĿ¼',
	'no_pic_to_add' => 'û��ͼƬ���Լ���',
	'need_one_album' => 'Ҫʹ�ô˹�������Ҫ��һ��ר��',
	'warning' => '����',
	'change_perm' => '�����޷�д�����Ŀ¼, ���޸�Ŀ¼������ Ϊ 755 �� 777 ������һ��!',
	'target_album' => '<b>����ͼƬ &quot;</b>%s<b>&quot; �� </b>%s',
	'folder' => '�ļ���',
	'image' => 'ͼƬ',
	'album' => '���',
	'result' => '���',
	'dir_ro' => '����д��. ',
	'dir_cant_read' => '���ܶ�ȡ. ',
	'insert' => '����ͼƬ�����',
	'list_new_pic' => '��ͼƬ�б�',
	'insert_selected' => '����ѡ���ͼƬ',
	'no_pic_found' => 'û���µ�ͼƬ',
	'be_patient' => '������һ��, ������ҪһЩʱ��������ͼƬ',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : ����ͼƬ�ѳɹ�����'.
				'<li><b>DP</b> : ����ͼƬ�ظ����Ѵ��������ݿ���'.
				'<li><b>PB</b> : ����ͼƬ�޷�����, �������û�ͼƬ���Ŀ¼��ʹ��Ȩ��'.
				'<li>��� OK, DP, PB \'����\' û����ʾ�밴������ͼƬ���� PHP ��ʾ�Ĵ���ѶϢ'.
				'<li>����������ʱ, ����ˢ�°�ť'.
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
                'title' => '��ֹ�û�', //new in cpg1.2.0
                'user_name' => '�û���', //new in cpg1.2.0
                'ip_address' => 'IP��ַ', //new in cpg1.2.0
                'expiry' => '����(���մ������ý�ֹ���û�)', //new in cpg1.2.0
                'edit_ban' => '�����趨', //new in cpg1.2.0
                'delete_ban' => 'ɾ��', //new in cpg1.2.0
                'add_new' => '������ֹ�û�', //new in cpg1.2.0
                'add_ban' => '����', //new in cpg1.2.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => '�ϴ�ͼƬ',
	'max_fsize' => '�����ϴ��ļ����ߴ�Ϊ %s KB',
	'album' => 'ר��',
	'picture' => 'ͼƬ',
	'pic_title' => 'ͼƬ����',
	'description' => 'ͼƬ����',
	'keywords' => '�ؼ���(���Կո�ֿ�)',
	'err_no_alb_uploadables' => '��Ǹ��û�п����ϴ�ͼƬ��ר��',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => '�û�����',
	'name_a' => '������������',
	'name_d' => '���ֽ�������',
	'group_a' => '�û�����������',
	'group_d' => '�û��齵������',
	'reg_a' => 'ע��������������',
	'reg_d' => 'ע�����ڽ�������',
	'pic_a' => 'ͼƬ����������',
	'pic_d' => 'ͼƬ����������',
	'disku_a' => '����ʹ������������',
	'disku_d' => '����ʹ������������',
	'sort_by' => '�û�������',
	'err_no_users' => '�û����ϱ��ǿյ� !',
	'err_edit_self' => '���޷��༭��ĸ�������, ������ \'�ҵĸ�������\' ���༭',
	'edit' => '�༭',
	'delete' => 'ɾ��',
	'name' => '�û���',
	'group' => '�û���',
	'inactive' => 'δ����',
	'operations' => '����',
	'pictures' => 'ͼƬ',
	'disk_space' => '�ռ� ��ʹ�� / �ܼ�',
	'registered_on' => 'ע����',
	'u_user_on_p_pages' => '%d ���û��� %d ҳ',
	'confirm_del' => 'ȷ��Ҫɾ������û���\\n������������ͼƬ������ɾ����',
	'mail' => '�ʼ�',
	'err_unknown_user' => 'ѡ����û������ڣ�',
	'modify_user' => '�༭�û�',
	'notes' => 'ע��',
	'note_list' => '<li>����㲻��ı䵱ǰ������, �뽫"����"������',
	'password' => '����',
	'user_active' => '�û��Ǽ����',
	'user_group' => '�û���',
	'user_email' => '�û������ʼ�',
	'user_web_site' => '�û���վ',
	'create_new_user' => '�������û�',
	'user_location' => '�û�λ��',
	'user_interests' => '�û���Ȥ',
	'user_occupation' => '�û�ְҵ',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => '���µ���ͼƬ�ߴ�', //new in cpg1.2.0
        'what_it_does' => '��ʲô', //new in cpg1.2.0
        'what_update_titles' => '���ļ������±���', //new in cpg1.2.0
        'what_delete_title' => 'ɾ������', //new in cpg1.2.0
        'what_rebuild' => '�ؽ�΢��ͼ�����µ������ߴ��ͼƬ', //new in cpg1.2.0
        'what_delete_originals' => 'ɾ��ԭʼ�ߴ��ͼƬ�����³ߴ�ͼƬ���', //new in cpg1.2.0
        'file' => '�ļ�', //new in cpg1.2.0
        'title_set_to' => '��������Ϊ', //new in cpg1.2.0
        'submit_form' => '�ύ', //new in cpg1.2.0
        'updated_succesfully' => '�ɹ�����', //new in cpg1.2.0
        'error_create' => '��������', //new in cpg1.2.0
        'continue' => '��������ͼƬ', //new in cpg1.2.0
        'main_success' => '�ļ� %s �Ѿ��ɹ�����Ϊһ����ͼƬ', //new in cpg1.2.0
        'error_rename' => ' %s �� %s ��������', //new in cpg1.2.0
        'error_not_found' => '�ļ� %s ���ܱ��ҵ�', //new in cpg1.2.0
        'back' => '������ҳ��', //new in cpg1.2.0
        'thumbs_wait' => '����΢��ͼ��/�����µ���ͼƬ�ߴ�,��Ⱥ�...', //new in cpg1.2.0
        'thumbs_continue_wait' => '��������΢��ͼ��/�����µ���ͼƬ�ߴ�...', //new in cpg1.2.0
        'titles_wait' => '���±���, ��Ⱥ�...', //new in cpg1.2.0
        'delete_wait' => 'ɾ������, ��Ⱥ�...', //new in cpg1.2.0
        'replace_wait' => 'ɾ��ԭʼͼƬ���õ������ߴ��ͼƬ�������Ⱥ�..', //new in cpg1.2.0
        'instruction' => '����ָ��', //new in cpg1.2.0
        'instruction_action' => 'ѡ����', //new in cpg1.2.0
        'instruction_parameter' => '���ò���', //new in cpg1.2.0
        'instruction_album' => 'ѡ��ר��', //new in cpg1.2.0
        'instruction_press' => '��� %s', //new in cpg1.2.0
        'update' => '��������/�����µ���ͼƬ�ߴ�', //new in cpg1.2.0
        'update_what' => 'ʲôӦ�ñ�����', //new in cpg1.2.0
        'update_thumb' => '����΢��ͼ', //new in cpg1.2.0
        'update_pic' => '�������µ������ߴ��ͼƬ', //new in cpg1.2.0
        'update_both' => '΢��ͼ�����µ������ߴ��ͼƬ', //new in cpg1.2.0
        'update_number' => 'ÿ�ε������ͼƬ������', //new in cpg1.2.0
        'update_option' => '(����������Ȼ���ڣ����ŵ����������)', //new in cpg1.2.0
        'filename_title' => '�ļ��� &rArr; ͼƬ����', //new in cpg1.2.0
        'filename_how' => '�ļ���Ӧ������޸�', //new in cpg1.2.0
        'filename_remove' => '����.jpg��β���ô��ո�� _(�»���)���', //new in cpg1.2.0
        'filename_euro' => '�ı� 2003_11_23_13_20_20.jpg �� 23/11/2003 13:20', //new in cpg1.2.0
        'filename_us' => '�ı� 2003_11_23_13_20_20.jpg �� 11/23/2003 13:20', //new in cpg1.2.0
        'filename_time' => '�ı� 2003_11_23_13_20_20.jpg to 13:20', //new in cpg1.2.0
        'delete' => 'ɾ��ͼƬ�������ԭʼ�ߴ��ͼƬ', //new in cpg1.2.0
        'delete_title' => 'ɾ��ͼƬ����', //new in cpg1.2.0
        'delete_original' => 'ɾ��ԭʼ�ߴ��ͼƬ', //new in cpg1.2.0
        'delete_replace' => 'ɾ��ԭʼ��ͼƬ�����µ�ͼƬ���', //new in cpg1.2.0
        'select_album' => 'ѡ��ר��', //new in cpg1.2.0
);

?>