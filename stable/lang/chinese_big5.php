<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.1                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR                                     //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array( 
'lang_name_english' => 'Chinese Tranditional BIG5',  
'lang_name_native' => '�����c��', 
'lang_country_code' => 'cn', 
'trans_name'=> 'Fatman', //the name of the translator - can be a nickname 
'trans_email' => 'fatman_li@yahoo.com.hk', //translator's email address (optional) 
'trans_website' => '', //translator's website (optional) 
'trans_date' => '2003-10-22', //the date the translation was created / last modified 
); 

$lang_charset = 'BIG5';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('�P����', '�P���@', '�P���G', '�P���T', '�P���|', '�P����', '�P����');
$lang_month = array('�@��', '�G��', '�T��', '�|��', '����', '����', '�C��', '�K��', '�E��', '�Q��', '�Q�@��', '�Q�G��');

// Some common strings
$lang_yes = '�O';
$lang_no  = '�_';
$lang_back = '��^';
$lang_continue = '�~��';
$lang_info = '�T��';
$lang_error = '���~';

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
        'random' => '�H���Ϥ�', 
        'lastup' => '�̷s�W�ǹϤ�', 
        'lastalb'=> '�̪��s��ï', 
        'lastcom' => '�̷s�N��', 
        'topn' => '�����Ϥ�', 
        'toprated' => '�̰�����', 
        'lasthits' => '�̪����', 
        'search' => '�j�M���G', 
        'favpics'=> '�̷R�Ϥ�' 
); 

$lang_errors = array(
        'access_denied' => '�A�S���ϥΥ������v��.',
        'perm_denied' => 'Y�A�S���v�����榹�ʧ@.',
        'param_missing' => '�{���Q�I�s�ӨS���ݭn���Ѽ�.',
        'non_exist_ap' => '�ҿ�ܪ� ��ï/�Ϥ� ���s�b !',
        'quota_exceeded' => '�W�L�ϺЭ��B<br /><br />�A�����B�� [quota]K, �w�ϥΪ��� [space]K, �[�J���Ϥ��|�W�L���B.',
        'gd_file_type_err' => '��ϥ� GD �Ϲ��{���w�u�e�\ JPEG and PNG ����.',
        'invalid_image' => '�A�W�Ǫ��ɮפv�g�l�a, �άO GD �Ϲ��{���w����B�z',
        'resize_failed' => '�L�k�إ��Y�ϩ��Y�p����.',
        'no_img_to_display' => '�����Ϥ��i�H���.',
        'non_exist_cat' => '�ҿ�ܪ����O�ä��s�b.',
        'orphan_cat' => '�o�Ӥl���O�s��@�Ӥ��s�b�������O, �Х������O�޲z�ץ��o�Ӱ��D.',
        'directory_ro' => '�ؿ� \'%s\' �L�k�g�J, �ɭP�Ϥ��L�k�R��',
        'non_exist_comment' => '�ҿ�ܪ��N���ä��s�b.',
        'pic_in_invalid_album' => '���Ϥ��s�󤣦s�b����ï (%s)!?', 
        'banned' => '�A�Q�T��ϥΥ���.', 
        'not_with_udb' => '�ѩ󥻬�ï�w�M�׾µ{����X, ���\�ఱ��ϥ�. �i��O�{�ɳ]�w���䴩, �Τw�ѽ׾³B�z.', 
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
        'alb_list_title' => '��^��ï�ؿ�',
        'alb_list_lnk' => '��ï�ؿ�',
        'my_gal_title' => '��^�ڪ���ï',
        'my_gal_lnk' => '�ڪ���ï',
        'my_prof_lnk' => '�ڪ��ӤH���',
        'adm_mode_title' => '�ର�޲z�Ҧ�',
        'adm_mode_lnk' => '�޲z�Ҧ�',
        'usr_mode_title' => '�ର�Τ�Ҧ�',
        'usr_mode_lnk' => '�Τ�Ҧ�',
        'upload_pic_title' => '�W�ǹϤ��ܬ�ï',
        'upload_pic_lnk' => '�W�ǹϤ�',
        'register_title' => '�إ߱b��',
        'register_lnk' => '���U',
        'login_lnk' => '�n�J',
        'logout_lnk' => '�n�X',
        'lastup_lnk' => '�̷s�W��',
        'lastcom_lnk' => '�̷s�N��',
        'topn_lnk' => '�����Ϥ�',
        'toprated_lnk' => '�̰�����',
        'search_lnk' => '�j�M',
        'fav_lnk' => '�ڪ��̷R', 

);

$lang_gallery_admin_menu = array(
        'upl_app_lnk' => '�֭�W��',
        'config_lnk' => '�]�w',
        'albums_lnk' => '��ï',
        'categories_lnk' => '���O',
        'users_lnk' => '�Τ�',
        'groups_lnk' => '�s��',
        'comments_lnk' => '�N��',
        'searchnew_lnk' => '���[�J�Ϥ�',
        'util_lnk' => '�վ�Ϥ��ؤo', 
        'ban_lnk' => '���v�Τ�', 
);

$lang_user_admin_menu = array(
        'albmgr_lnk' => '�إ�/�Ƨ� �ڪ���ï',
        'modifyalb_lnk' => '�s��ڪ���ï',
        'my_prof_lnk' => '�ڪ��ӤH���',
);

$lang_cat_list = array(
        'category' => '���O',
        'albums' => '��ï',
        'pictures' => '�Ϥ�',
);

$lang_album_list = array(
        'album_on_page' => '%d ��ï�b %d ��'
);

$lang_thumb_view = array(
        'date' => '���',
        //Sort by filename and title
        'name' => '�ɦW', 
        'title' => '���D', 
        'sort_da' => '�ƧǨ̤�� �ѻ��ܪ�',
        'sort_dd' => '�ƧǨ̤�� �Ѫ�ܻ�',
        'sort_na' => '�ƧǨ̦W�� �Ѥp�ܤj',
        'sort_nd' => '�ƧǨ̦W�� �Ѥj�ܤp',
        'sort_ta' => '�ƧǨ̼��D �Ѥp�ܤj', 
        'sort_td' => '�ƧǨ̼��D �Ѥj�ܤp', 
        'pic_on_page' => '%d �Ϥ��b %d ��',
        'user_on_page' => '%d �Τ�b %d ��'
);

$lang_img_nav_bar = array(
        'thumb_title' => '��^�Y�ϭ�',
        'pic_info_title' => '���/���� �Ϥ���T',
        'slideshow_title' => '�s�򼽩�',
        'ecard_title' => '��Ϥ��H e-card �H�X',
        'ecard_disabled' => 'e-cards �\�ఱ��',
        'ecard_disabled_msg' => '�A�L�v�ϥ� e-cards',
        'prev_title' => '�[�ݫe�@�i�Ϥ�',
        'next_title' => '�[�ݤU�@�i�Ϥ�',
        'pic_pos' => '�Ϥ� %s/%s',
);

$lang_rate_pic = array(
        'rate_this_pic' => '�벼 ',
        'no_votes' => '(�|�����벼)',
        'rating' => '(�ثe�o�� : %s / 5 �� %s �ӧ벼)',
        'rubbish' => '�U��',
        'poor' => '�t�l',
        'fair' => '�@��',
        'good' => '���N',
        'excellent' => '�X��',
        'great' => '���n',
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
        CRITICAL_ERROR => '�����~',
        'file' => '�ɮ�: ',
        'line' => '���: ',
);

$lang_display_thumbnails = array(
        'filename' => '�ɦW : ',
        'filesize' => '�ɮפj�p : ',
        'dimensions' => '�ؤo : ',
        'date_added' => '�[�J��� : '
);

$lang_get_pic_data = array(
        'n_comments' => '%s �ӷN��',
        'n_views' => '%s ���[��',
        'n_votes' => '(%s �ӧ벼)'
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
        'Exclamation' => '�P��',
        'Question' => '�ð�',
        'Very Happy' => '�ܰ���',
        'Smile' => '�L��',
        'Sad' => '�d�s',
        'Surprised' => '��Y',
        'Shocked' => '�_��',
        'Confused' => '�V��',
        'Cool' => '�ܴ�',
        'Laughing' => '�o��',
        'Mad' => '�o�g',
        'Razz' => '�J��',
        'Embarassed' => '����',
        'Crying or Very sad' => '�z��',
        'Evil or Very Mad' => '�c�r',
        'Twisted Evil' => '�j��',
        'Rolling Eyes' => '���઺����',
        'Wink' => '�w��',
        'Idea' => '�D�N',
        'Arrow' => '�b�Y',
        'Neutral' => '����',
        'Mr. Green' => '��L����',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
        0 => '�����}�޲z�Ҧ�...',
        1 => '���i�J�޲z�Ҧ�...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
        'alb_need_name' => '�z�ݭn����ï�@�ӦW�� !',
        'confirm_modifs' => '�T�w�n���o�ǭק�� ?',
        'no_change' => '�z�S����������� !',
        'new_album' => '�s��ï',
        'confirm_delete1' => '�T�w�n�R������ï�� ?',
        'confirm_delete2' => '\n�Ҧ��Ϥ��ηN�����|�R�� !',
        'select_first' => '�Х���ܤ@�Ӭ�ï',
        'alb_mrg' => '��ï�޲z��',
        'my_gallery' => '* �ڪ���ï *',
        'no_category' => '* �S�����O *',
        'delete' => '�R��',
        'new' => '�s�W',
        'apply_modifs' => '�ק�',
        'select_category' => '������O',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
        'miss_param' => '\'%s\'�ާ@�һݭn���Ѽƨå����� !',
        'unknown_cat' => '�ҿ�ܪ����O�ä��s�b���Ʈw',
        'usergal_cat_ro' => '�Τ��ï���O����R�� !',
        'manage_cat' => '���O�޲z',
        'confirm_delete' => '�T�w�n�R�������O��',
        'category' => '���O',
        'operations' => '�ާ@',
        'move_into' => '�h����',
        'update_create' => '��s/�إ� ���O',
        'parent_cat' => '�����O',
        'cat_title' => '���O���D',
        'cat_desc' => '���O�y�z'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
        'title' => '�]�w',
        'restore_cfg' => '�^�_��l�]�w',
        'save_cfg' => '�x�s�s�]�w',
        'notes' => '�`�N',
        'info' => '�T��',
        'upd_success' => '�]�w�w��s',
        'restore_success' => '��l�]�w�w�^�_',
        'name_a' => '�ƧǨ̦W�� �Ѥp�ܤj',
        'name_d' => '�ƧǨ̦W�� �Ѥj�ܤp',
        'title_a' => '�ƧǨ̼��D �Ѥp�ܤj', 
        'title_d' => '�ƧǨ̼��D �Ѥj�ܤp', 
        'date_a' => '�ƧǨ̤�� �ѻ��ܪ�',
        'date_d' => '�ƧǨ̤�� �Ѫ�ܻ�'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
        '�򥻳]�w',
        array('��ï�W��', 'gallery_name', 0),
        array('��ï�y�z', 'gallery_description', 0),
        array('��ï�޲z���q�l', 'gallery_admin_email', 0),
        array('�be-cards�����\'�[�ݧ�h�Ϥ�\'�����}', 'ecards_more_pic_target', 0),
        array('�y��', 'lang', 5),
        //array('enable language selection', 'lang_select_enable', 8 ), 
        array('�G��', 'theme', 6),
        //array('enable theme selection', 'theme_select_enable', 8),

        '��ï�ؿ����',
        array('�D�n���e�� (������ %)', 'main_table_width', 0),
        array('�P�@�h�����l���O��ܭӼ�', 'subcat_level', 0),
        array('��ï��ܭӼ�', 'albums_per_page', 0),
        array('��ï�ؿ�����ï���', 'album_list_cols', 0),
        array('�Y�Ϲ���', 'alb_list_thumb_size', 0),
        array('�D�������e', 'main_page_layout', 0),
        array('��ܤ������Ĥ@�h����ï�Y��','first_level',1), 

        '�Y�����',
        array('�Y�ϭ����', 'thumbcols', 0),
        array('�Y�ϭ��C��', 'thumbrows', 0),
        array('�����̰ܳ��Ӽ�', 'max_tabs', 0),
        array('��ܹϤ��������Y�ϤU�� (���[�����D)', 'caption_in_thumbview', 1),
        array('��ܷN���Ʃ��Y�ϤU��', 'display_comment_count', 1),
        array('�Ϥ�����l�ƧǦ���', 'default_sort_order', 3),
        array('\'�����벼\'�ݭn�̤֧벼��', 'min_votes_for_rating', 0),

        '�Ϥ���� &amp; �N���]�w',
        array('�Ϥ���ܪ����e�� (������ %)', 'picture_table_width', 0),
        array('�Ϥ���T�w�]���', 'display_pic_info', 1),
        array('�N�����L�o���}���J', 'filter_bad_words', 1),
        array('�N���i�H�ϥί��y�ϥ�', 'enable_smilies', 1),
        array('�Ϥ��y�z���e���̤j����', 'max_img_desc_length', 0),
        array('�y�z���e���̤j�r��', 'max_com_wlength', 0),
        array('�N�����̤j���', 'max_com_lines', 0),
        array('�N�����̤j����', 'max_com_size', 0),
        array('��ܹϤ��w���C', 'display_film_strip', 1), 
        array('�Ϥ��w���C���Ϥ���', 'max_film_strip_items', 0), 

        '�Ϥ����Y�ϳ]�w',
        array('JPEG �榡�~��', 'jpeg_qual', 0),
        array('�Y�ϳ̤j�ؤo <b>*</b>', 'thumb_width', 0), 
        array('�ϥΤؤo ( �e�B�����Y�ϳ̤j��� )<b>*</b>', 'thumb_use', 7),    
        array('�إߤ��ŹϤ�','make_intermediate',1),
        array('���ŹϤ��̤j�ؤo <b>*</b>', 'picture_width', 0),
        array('�W�ǹ��ɪ��̤j���� (KB)', 'max_upl_size', 0),
        array('�W�ǹϤ��̤j�ؤo (����)', 'max_upl_width_height', 0),

        '�Τ�]�w',
        array('���\�s�Τ���U', 'allow_user_registration', 1),
        array('���U�ݭn�q�l����', 'reg_requires_valid_email', 1),
        array('���\���P�Τ�ϥΦP�@�ӹq�l�a�}', 'allow_duplicate_emails_addr', 1),
        array('�Τ�i�H���p�H����ï', 'allow_private_albums', 1),

        '�Ϥ��y�z���ۭq��� (�p�G���ϥνЯd�U�ť�)',
        array('��� 1 �W��', 'user_field1_name', 0),
        array('��� 2 �W��', 'user_field2_name', 0),
        array('��� 3 �W��', 'user_field3_name', 0),
        array('��� 4 �W��', 'user_field4_name', 0),

        '�Ϥ��M�Y�Ϫ��i���]�w',
        array('��ܨp�H��ï�ϥܵ����n�J�Τ�','show_private',1), 
        array('�ɮצW�٤��������r��', 'forbiden_fname_char',0),
        array('�W�ǹ��ɥi���������ɦW', 'allowed_file_extensions',0),
        array('�إ��Y�Ϫ���k','thumb_method',2),
        array('ImageMagick \'convert\' �{�������| (�Ҧp /usr/bin/X11/)', 'impath', 0),
        array('�i��������������(�u�� ImageMagick ����)', 'allowed_img_types',0),
        array('ImageMagick ���R�O�C�ﶵ', 'im_options', 0),
        array('Ū�� JPEG �ɮת� EXIF ���', 'read_exif_data', 1),
        array('��ï���| <b>*</b>', 'fullpath', 0),
        array('�Τ���ɸ��| <b>*</b>', 'userpics', 0),
        array('���Ź��ɪ��e�m�r�� <b>*</b>', 'normal_pfx', 0),
        array('�Y���ɪ��e�m�r�� <b>*</b>', 'thumb_pfx', 0),
        array('��m���ɥؿ����w�]�v��', 'default_dir_mode', 0),
        array('�W�ǹϤ����w�]�v��', 'default_file_mode', 0),
        array('����b�u�X�����ηƹ��k�� (JavaScript - ²��O�@)', 'disable_popup_rightclick', 1), 
        array('����b�@������ηƹ��k�� (JavaScript - ²��O�@)', 'disable_gallery_rightclick', 1), 

        'Cookies &amp; �s�X�]�w',
        array('�ϥΪ� cookie �W��', 'cookie_name', 0),
        array('�ϥΪ� cookie ���|', 'cookie_path', 0),
        array('�s�X�]�w', 'charset', 4),

        '��L�]�w',
        array('�Ұʰ����Ҧ�', 'debug_mode', 1),

        '<br /><div align="center">(*) �Y��ï�����Ϥ�, �Хܦ� * ������ܤ��i���</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
        'empty_name_or_com' => '�п�J�A���W�r�M�N��',
        'com_added' => '�z���N���w�g�[�J',
        'alb_need_title' => '�z��������ï���Ѥ@�Ӽ��D!',
        'no_udp_needed' => '�S����s�����n.',
        'alb_updated' => '��ï�w�g��s',
        'unknown_album' => '�ҿ�ܪ���ï���s�b�αz�S���v���W�ǹϤ��즹��ï',
        'no_pic_uploaded' => '�S���Ϥ��Q�W�� !<br /><br />�p�G�z�T�w����ܹϤ��W��, ���ˬd���A���O�_���\�W���ɮ�...',
        'err_mkdir' => '�L�k�إߥؿ� %s !',
        'dest_dir_ro' => '�ؿ� %s  �L�k�g�J!',
        'err_move' => '�L�k�h�� %s �� %s !',
        'err_fsize_too_large' => '�z�W�Ǫ��Ϥ��Ӥj (����W�L %s x %s) !',
        'err_imgsize_too_large' => '�z�W�Ǫ����ɤӤj (����W�L %s KB) !',
        'err_invalid_img' => '�W�Ǫ��ɮרä��O�e�\���Ϥ��榡!',
        'allowed_img_types' => '�z�u�i�H�W�� %s �i�Ϥ�.',
        'err_insert_pic' => '�Ϥ� \'%s\' �L�k�[�J����ï.',
        'upload_success' => '�Ϥ��W�ǧ���<br /><br />��޲z�̮֭��N�i�H�ݨ�Ϥ�.',
        'info' => '�T��',
        'com_added' => '�N���w�[�J',
        'alb_updated' => '��ï�w�g��s',
        'err_comment_empty' => '�N���O�Ū�!',
        'err_invalid_fext' => '�u���U�C�����ɦW�~�e�\ : <br /><br />%s.',
        'no_flood' => '��p, ���Ϥ��̫�@�ӷN���O�z����<br /><br />�z�i�H�ק�z���N��',
        'redirect_msg' => '�����ಾ��.<br /><br /><br />�� \'�~��\' �p�G�����S���۰ʨ�s',
        'upl_success' => '�w�g�[�J�z���Ϥ�',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
        'caption' => '����',
        'fs_pic' => '��j�Ϥ�',
        'del_success' => '�����R��',
        'ns_pic' => '�зǤؤo�Ϥ�',
        'err_del' => '�L�k�R��',
        'thumb_pic' => '�Y��',
        'comment' => '�N��',
        'im_in_alb' => '��ï���Ϥ�',
        'alb_del_success' => '��ï \'%s\' �w�R��',
        'alb_mgr' => '��ï�޲z',
        'err_invalid_data' => '�����줣���T����Ʃ� \'%s\'',
        'create_alb' => '�إ߬�ï \'%s\'',
        'update_alb' => '��s��ï \'%s\' ���D�� \'%s\' ���ެ� \'%s\'',
        'del_pic' => '�R���Ϥ�',
        'del_alb' => '�R����ï',
        'del_user' => '�R���Τ�',
        'err_unknown_user' => '�ҿ�ܪ��Τᤣ�s�b !',
        'comment_deleted' => '�N���w�R��',
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
        'confirm_del' => '�T�w�n�R�����Ϥ��� ? \\n�N���]�|�Q�R��.',
        'del_pic' => '�R�����Ϥ�',
        'size' => '%s x %s ����',
        'views' => '%s ��',
        'slideshow' => '�s�򼽩�',
        'stop_slideshow' => '�����',
        'view_fs' => '�I��Ϥ��H�[�ݭ쥻�ؤo',
);

$lang_picinfo = array(
        'title' =>'�Ϥ���T',
        'Filename' => '�ɮצW��',
        'Album name' => '��ï�W��',
        'Rating' => '���� (%s ���벼)',
        'Keywords' => '����r',
        'File Size' => '�ɮפj�p',
        'Dimensions' => '�ؤo',
        'Displayed' => '���',
        'Camera' => '�۾�',
        'Date taken' => '������',
        'Aperture' => '����',
        'Exposure time' => '�n���ɶ�',
        'Focal length' => '�J�Z',
        'Comment' => '�N��',
        'addFav'=>'�[��ڪ��̷R', 
        'addFavPhrase'=>'�ڪ��̷R', 
        'remFav'=>'�q�ڪ��̷R����', 
);

$lang_display_comments = array(
        'OK' => 'OK',
        'edit_title' => '�s�覹�N��',
        'confirm_delete' => '�T�w�n�R�����N�� ?',
        'add_your_comment' => '�[�J�A���N��',
        'name'=>'�W��', 
        'comment'=>'�N��', 
        'your_name' => '�ΦW', 
);

$lang_fullsize_popup = array(
        'click_to_close' => '�I��Ϥ��H��������', 
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
        'title' => '�H�X e-card',
        'invalid_email' => '<b>ĵ�i</b> : �����T���q�l�a�} !',
        'ecard_title' => '%s �H�ӵ��A�� e-card',
        'view_ecard' => '�p�G e-card �L�k���T���, �Ы����s��',
        'view_more_pics' => '�����s���ݧ�h�Ϥ� !',
        'send_success' => '�A�� e-card �H�X',
        'send_failed' => '��p, �����A���L�k���A�H�X e-card...',
        'from' => '��',
        'your_name' => '�A���W��',
        'your_email' => '�A���q�l�a�}',
        'to' => '��',
        'rcpt_name' => '����̦W��',
        'rcpt_email' => '����̹q�l�a�}',
        'greetings' => '�ݭ�',
        'message' => '�T�����e',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
        'pic_info' => '�Ϥ���T',
        'album' => '��ï',
        'title' => '���D',
        'desc' => '�y�z',
        'keywords' => '����r',
        'pic_info_str' => '%sx%s - %sKB - %s ���[�� - %s ���벼',
        'approve' => '�֭�Ϥ�',
        'postpone_app' => '����֭�',
        'del_pic' => '�R���Ϥ�',
        'reset_view_count' => '���]�[�ݭp�ƾ�',
        'reset_votes' => '���]�벼',
        'del_comm' => '�R���N��',
        'upl_approval' => '�֭�W��',
        'edit_pics' => '�s��Ϥ�',
        'see_next' => '�[�ݤU�@�i�Ϥ�',
        'see_prev' => '�[�ݫe�@�i�Ϥ�',
        'n_pic' => '%s �i�Ϥ�',
        'n_of_pic_to_disp' => '�Ϥ���ܼƶq',
        'apply' => '�ק�'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
        'group_name' => '�s�զW��',
        'disk_quota' => '�ϺЭ��B',
        'can_rate' => '�e�\���Ϥ�����',
        'can_send_ecards' => '�e�\�H�X ecards',
        'can_post_com' => '�e�\�K�X�N��',
        'can_upload' => '�e�\�W�ǹϤ�',
        'can_have_gallery' => '�e�\���ӤH��ï',
        'apply' => '�ק�',
        'create_new_group' => '�إ߷s�s��',
        'del_groups' => '�R���ҿ�ܪ��s��',
        'confirm_del' => 'ĵ�i, ��R���F�@�Ӹs��, �ݩ�Ӹs�ժ��Τ�N�Q�ಾ�� \'Registered\' �s�դ� !\n\nn�T�w�n�R�� ?',
        'title' => '�޲z�Τ�s��',
        'approval_1' => '���}��ï�W�Ǯ֭� (1)',
        'approval_2' => '�p�H��ï�W�Ǯ֭� (2)',
        'note1' => '<b>(1)</b> �W�ǹϤ��ܤ��}��ï�ݺ޲z���֭�',
        'note2' => '<b>(2)</b> �W�ǹϤ��ܨp�H��ï�ݺ޲z���֭�',
        'notes' => '�`�N'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
        'welcome' => '�w�� !'
);

$lang_album_admin_menu = array(
        'confirm_delete' => '�T�w�n�R���o��ï ? \\n�Ҧ��Ϥ��ηN�����|�R��.',
        'delete' => '�R��',
        'modify' => '�ݩ�',
        'edit_pics' => '�s��Ϥ�',
);

$lang_list_categories = array(
        'home' => '�D��',
        'stat1' => '<b>[pictures]</b> �i�Ϥ��� <b>[albums]</b> �Ӭ�ï�� <b>[cat]</b> �����O, �� <b>[comments]</b> �ӷN��, �Q�[�� <b>[views]</b> ��',
        'stat2' => '<b>[pictures]</b> �i�Ϥ��� <b>[albums]</b> �Ӭ�ï, �Q�[�� <b>[views]</b> ��',
        'xx_s_gallery' => '%s\'s ��ï',
        'stat3' => '<b>[pictures]</b> �i�Ϥ��� <b>[albums]</b> �Ӭ�ï, �� <b>[comments]</b> �ӷN��, �Q�[�� <b>[views]</b> ��'
);

$lang_list_users = array(
        'user_list' => '�Τ�C��',
        'no_user_gal' => '�����Τ��ï',
        'n_albums' => '%s �Ӭ�ï',
        'n_pics' => '%s �i�Ϥ�'
);

$lang_list_albums = array(
        'n_pictures' => '%s �i�Ϥ�',
        'last_added' => ', �̷s�Ϥ��� %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
        'login' => '�n�J',
        'enter_login_pswd' => '��J�Τ�W�٩M�K�X',
        'username' => '�Τ�W��',
        'password' => '�K�X',
        'remember_me' => '�O��K�X',
        'welcome' => '�w�� %s ...',
        'err_login' => '*** �L�k�n�J. �Э��� ***',
        'err_already_logged_in' => '�z�w�g�n�J !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
        'logout' => '�n�X',
        'bye' => '�A�� %s ...',
        'err_not_loged_in' => '�z�|���n�J !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
        'upd_alb_n' => '��s��ï %s',
        'general_settings' => '�@��]�w',
        'alb_title' => '��ï���D',
        'alb_cat' => '��ï���O',
        'alb_desc' => '��ï�y�z',
        'alb_thumb' => '��ï�Y��',
        'alb_perm' => '��ï�v��',
        'can_view' => '��ï�i�[��',
        'can_upload' => '�X�ȥi�W�ǹϤ�',
        'can_post_comments' => '�X�ȥi�K�X�N��',
        'can_rate' => '�X�ȥi���Ϥ�����',
        'user_gal' => '�Τ��ï',
        'no_cat' => '* �S�����O *',
        'alb_empty' => '��ï�O�Ū�',
        'last_uploaded' => '�̪�W��',
        'public_alb' => '����H (���}��ï)',
        'me_only' => '�u����',
        'owner_only' => '�u����ï�֦��H (%s)',
        'groupp_only' => '�s�� \'%s\' �|��',
        'err_no_alb_to_modify' => '��Ʈw���S���z�i�ק諸��ï.',
        'update' => '��s��ï'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
        'already_rated' => '��p, �z�w�g�����Ϥ�����',
        'rate_ok' => '�z���벼�w�g�Q����',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
{SITE_NAME} ���޲z���|���־�z�|�ް_�ϷP�����, ���ڭ̤��i���[�ݨC�@�����. �]���z���ݦP�N�Ҧ����u�O�N��@�̪��߳��ηN��, ���N��޲z�H�����߳� (���F�ѥL�̶K�X) �ä��t����k�߳d��.<br />
<br />
�z���ݦP�N���i�i�K����ⱡ, �ɤO, ���}, ������, �����d, ���`��a�w��, �Υ���i��H�k�����.  {SITE_NAME} �H���b����ɭԳ����v�L�o�ýs��z�i�K�����e. �åB�Τ�d�b����������Ƥw�s�b��Ʈw��. ���g�z���P�N, �ڭ̤��|�N�z������൹��L�H�ϥ�, ���L�ڭ̤��|������]�b�Ȧ欰�ӥ~������ƭt����d��.<br />
<br />
�����ϥ� cookies �b�z���q���W���x�s��T. �o�ˬO��K�z��r���s��. �z���q�l�a�}�u�O���ڭ̻{�ұz����ƦӤw.<br />
<br />
���U '�ڦP�N' �N��z�P�N�H�W����.
EOT;

$lang_register_php = array(
        'page_title' => '�Τ���U',
        'term_cond' => '���ڻP�W�h',
        'i_agree' => '�ڦP�N',
        'submit' => '������U',
        'err_user_exists' => '�z�Ҷ�g���Τ�W�٤w�Q�H�ϥ�, �Э���@��',
        'err_password_mismatch' => '�⦸�K�X���X, �Э���@��',
        'err_uname_short' => '�Τ�W�٦ܤֻ� 2 �Ӧr��',
        'err_password_short' => '�K�X�ܤֻ� 2 �Ӧr��',
        'err_uname_pass_diff' => '�Τ�W�٩M�K�X���i�H�ۦP',
        'err_invalid_email' => '�q�l�a�}�����T',
        'err_duplicate_email' => '�o�ӹq�l�a�}�w�g�Q��L�H�ϥιL�F',
        'enter_info' => '��J���U���',
        'required_info' => '���n�����',
        'optional_info' => '�D���n�����',
        'username' => '�Τ�W��',
        'password' => '�K�X',
        'password_again' => '�T�{�K�X',
        'email' => '�q�l�a�}',
        'location' => '�a��',
        'interests' => '����',
        'website' => '���}',
        'occupation' => '¾�~',
        'error' => '���T',
        'confirm_email_subject' => '%s - ���U�{��',
        'information' => '�T��',
        'failed_sending_email' => '�ҵ��U���q�l�a�}�L�k�H�X!',
        'thank_you' => '�P�±z�����U.<br /><br />�@�ʤ��t���p��ҥαb������T�q�l�N�Q�e��z�Ҵ��Ѫ��H�c.',
        'acct_created' => '�z���b���w�g�إ�, �{�b�z�i�H�n�J',
        'acct_active' => '�z���b���w�g�ҥ�, �{�b�z�i�H�n�J',
        'acct_already_act' => '�z���b���w�g�ҥ� !',
        'acct_act_failed' => '���b���L�k�ҥ� !',
        'err_unk_user' => '�ҿ�ܪ��Τ�ä��s�b !',
        'x_s_profile' => '%s\'���ӤH���',
        'group' => '�s��',
        'reg_date' => '�[�J',
        'disk_usage' => '�ϺШϥζq',
        'change_pass' => '�ק�K�X',
        'current_pass' => '�{��K�X',
        'new_pass' => '�s�K�X',
        'new_pass_again' => '�T�{�s�K�X',
        'err_curr_pass' => '�{��K�X�����T',
        'apply_modif' => '�ק�',
        'change_pass' => '�ק�K�X',
        'update_success' => '�A���ӤH��Ƥw�g��s',
        'pass_chg_success' => '�A���K�X�w�g�ק�',
        'pass_chg_error' => '�A���K�X�S���ק�',
);

$lang_register_confirm_email = <<<EOT
�P�±z�b {SITE_NAME} �����U

�z���Τ�W�� is : "{USER_NAME}"
�z���K�X is : "{PASSWORD}"

�бz���U�����s���H�Ұʱz���b��
�Ϊ̧⦹�s���K�W�s�����W.

{ACT_LINK}

�P�N,

{SITE_NAME} �q�W

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
        'title' => '�[�ݷN��',
        'no_comment' => '�|�����N���i�H�[��',
        'n_comm_del' => '%s �ӷN���w�R��',
        'n_comm_disp' => '��ܪ��N���ƶq',
        'see_prev' => '�ݫe�@��',
        'see_next' => '�ݤU�@��',
        'del_comm' => '�R���ҿ諸�N��',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
        0 => '�j�M�Ϥ����e',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
        'page_title' => '�j�M�s�Ϥ�',
        'select_dir' => '��ܥؿ�',
        'select_dir_msg' => '���\��i�H���A�� FTP �W�Ǿ��Ϥ�.<br /><br />�п�ܧA�w�W�ǹϤ����ؿ�',
        'no_pic_to_add' => '�S���Ϥ��i�H�[�J',
        'need_one_album' => '�ϥΦ��\�ॲ�ݤ֭n���@�Ӭ�ï',
        'warning' => 'ĵ�i',
        'change_perm' => '�{���L�k�g�J�o�ӥؿ�, �Эק��v���� 755 ��r 777 ��A�դ@�� !',
        'target_album' => '<b>��Ϥ��� &quot;</b>%s<b>&quot; �� </b>%s',
        'folder' => '��Ƨ�',
        'image' => '�Ϥ�',
        'album' => '��ï',
        'result' => '���G',
        'dir_ro' => '�L�k�g�J. ',
        'dir_cant_read' => '�L�kŪ��. ',
        'insert' => '�s�W�Ϥ��ܬ�ï',
        'list_new_pic' => '�C�X�s�Ϥ�',
        'insert_selected' => '�[�J�ҿ�ܪ��Ϥ�',
        'no_pic_found' => '�S�����s�Ϥ�',
        'be_patient' => '�Э@�ߵ���, �{���ݭn�@�I�ɶ��ӥ[�J�ҿ�Ϥ�',
        'notes' =>  '<ul>'.
                                '<li><b>OK</b> : ��ܹϤ��w���\�Q�[�J'.
                                '<li><b>DP</b> : ��ܹϤ����ЩΤw�s�b��Ʈw'.
                                '<li><b>PB</b> : ��ܹϤ��L�k�[�J, ���ˬd�]�w�ιϤ��s��ؿ����v��'.
                                '<li>If the OK, DP, PB \'�Ÿ�\' �S����ܽЫ��a�����Ϥ��d�� PHP ��ܪ����~�T��'.
                                '<li>�p�G�s�����O��, �Ы����s��z'.
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
                'title' => '���v�Τ�', 
                'user_name' => '�Τ�W��', 
                'ip_address' => 'IP��}', 
                'expiry' => '�����]�ťեN��ä[���v�^', 
                'edit_ban' => '�x�s�ק�', 
                'delete_ban' => '�R��', 
                'add_new' => '�s�W���v�Τ�', 
                'add_ban' => '�s�W', 
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
        'title' => '�W�ǹϤ�',
        'max_fsize' => '�i���\���ɮ׳̤j�� %s KB',
        'album' => '��ï',
        'picture' => '�Ϥ�',
        'pic_title' => '�Ϥ����D',
        'description' => '�Ϥ��y�z',
        'keywords' => '����r (�H�Ů�Ϲj)',
        'err_no_alb_uploadables' => '�ثe�|������ï�i�H�W�ǹϤ�',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
        'title' => '�Τ�޲z',
        'name_a' => '�W�� �Ѥp�ܤj',
        'name_d' => '�W�� �Ѥj�ܤp',
        'group_a' => '�s�� �Ѥp�ܤj',
        'group_d' => '�s�� �Ѥj�ܤp',
        'reg_a' => '���U��� �ѻ��ܪ�',
        'reg_d' => '���U��� �Ѫ�ܻ�',
        'pic_a' => '�Ϥ��� �Ѥp�ܤj',
        'pic_d' => '�Ϥ��� �Ѥj�ܤp',
        'disku_a' => '�ϺХζq �Ѥp�ܤj',
        'disku_d' => '�ϺХζq �Ѥj�ܤp',
        'sort_by' => '�Τ�ƧǨ�',
        'err_no_users' => '�Τ��ƪ�O�Ū� !',
        'err_edit_self' => '�z�L�k�s��z���ӤH���, �ЧQ�� \'�ڪ��ӤH���\' �ӽs��',
        'edit' => '�s��',
        'delete' => '�R��',
        'name' => '�Τ�W��',
        'group' => '�s��',
        'inactive' => '���Ұ�',
        'operations' => '�ާ@',
        'pictures' => '�Ϥ�',
        'disk_space' => '�Ϻ� �ζq / ���B',
        'registered_on' => '���U��',
        'u_user_on_p_pages' => '%d �ӥΤ�� %d ��',
        'confirm_del' => '�T�w�n�R���o�ӥΤ��? \\n�Ҧ��L����ï�ιϤ����|�Q�R��.',
        'mail' => '�q�l',
        'err_unknown_user' => '�ҿ�ܪ��Τ�ä��s�bt !',
        'modify_user' => '�s��Τ�',
        'notes' => '�`�N',
        'note_list' => '<li>�p�G���Q���ܲ{��K�X, �бN "�K�X" ��d�U�ť�',
        'password' => '�K�X',
        'user_active' => '�Τ�w�Ұ�',
        'user_group' => '�Τ�s��',
        'user_email' => '�Τ�q�l',
        'user_web_site' => '�Τ���}',
        'create_new_user' => '�إ߷s�Τ�',
        'user_location' => '�Τ�a��',
        'user_interests' => '�Τῳ��',
        'user_occupation' => '�Τ�¾�~',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => '�վ�Ϥ��ؤo', 
        'what_it_does' => '�o�O���ƻ�', 
        'what_update_titles' => '�H�ɦW��s���D', 
        'what_delete_title' => '�R�����D', 
        'what_rebuild' => '���s�إ��Y�Ϥνվ�ؤo', 
        'what_delete_originals' => '�R����l�ؤo���Ϥ��åH�վ�L�ؤo�����N', 
        'file' => '�ɮ�', 
        'title_set_to' => '���D�w�]��', 
        'submit_form' => '�e�X', 
        'updated_succesfully' => '��s����', 
        'error_create' => '�s�W���~��', 
        'continue' => '�B�z��h�Ϥ�', 
        'main_success' => '�ɮ� %s �w�]���D��', 
        'error_rename' => '���~ %s ��W�� %s', 
        'error_not_found' => '�䤣���ɮ� %s ', 
        'back' => '�^�D��', 
        'thumbs_wait' => '���b��s�Y�Ϥ�(��)�վ�Ϥ��ؤo, �еy��...', 
        'thumbs_continue_wait' => '�~���s�Y�Ϥ�(��)�վ�Ϥ��ؤo...', 
        'titles_wait' => '���D��s��, �еy��...', 
        'delete_wait' => '�R�����D��, �еy��...', 
        'replace_wait' => '���H�վ�ؤo���Ϥ����N��l�ؤo�Ϥ���, �еy��..', 
        'instruction' => '²���ާ@����', 
        'instruction_action' => '�п�ܾާ@', 
        'instruction_parameter' => '�]�w�Ѽ�', 
        'instruction_album' => '��ܬ�ï', 
        'instruction_press' => '�Ы� %s', 
        'update' => '��s�Y�Ϥ�(��)�վ�ؤo���Ϥ�', 
        'update_what' => '�ƻ�n��s', 
        'update_thumb' => '�u���Y��', 
        'update_pic' => '�u���վ�ؤo���Ϥ�', 
        'update_both' => '�Y�Ϥνվ�ؤo���Ϥ�', 
        'update_number' => '�C�I��@���n�B�z���Ϥ��ƥ�', 
        'update_option' => '(�p�G�z�J��ާ@�{�ǹO�ɪ����D�A�иյۭ��C���]�w)', 
        'filename_title' => '�ɦW &rArr; �Ϥ����D', 
        'filename_how' => '�p��ק��ɦW', 
        'filename_remove' => '�R�� .jpg �ñN _ (���u) �ΪŮ���N', 
        'filename_euro' => '�N 2003_11_23_13_20_20.jpg �אּ 23/11/2003 13:20', 
        'filename_us' => '�N 2003_11_23_13_20_20.jpg �אּ 11/23/2003 13:20', 
        'filename_time' => '�N 2003_11_23_13_20_20.jpg �אּ 13:20', 
        'delete' => '�R���Ϥ����D�έ�l�ؤo���Ϥ�', 
        'delete_title' => '�R���Ϥ����D', 
        'delete_original' => '�R����l�ؤo���Ϥ�', 
        'delete_replace' => '�R����l�ؤo���Ϥ��åH�վ�ؤo���Ϥ����N', 
        'select_album' => '��ܬ�ï', 
);

?>