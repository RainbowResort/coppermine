<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery v1.1 Beta 3                                     //
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

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'rtl'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('�����', '���', '�����', '�����', '�����', '����', '���');
$lang_month = array('�����', '������', '���', '�����', '���', '����', '����', '������', '������', '�������', '������', '�����');

// Some common strings
$lang_yes = '��';
$lang_no  = '��';
$lang_back = '�����';
$lang_continue = '����';
$lang_info = '����';
$lang_error = '�����';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%m/%d/%y � %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y � %I:%M %p';
$comment_date_fmt =  '%B %d, %Y � %I:%M %p';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
	'random' => '������ �������',
	'lastup' => '����� �������',
	'lastcom' => '����� �������',
	'topn' => '����� �����',
	'toprated' => '������� �����',
	'lasthits' => '���� �������',
	'search' => '������ �����'
);

$lang_errors = array(
	'access_denied' => '���� ����� ������ ��� ��.',
	'perm_denied' => '���� ����� ���� ����� ��.',
	'param_missing' => '����� ������ ��� �������� �������.',
	'non_exist_ap' => '������ / ������ ����� ���� ������',
	'quota_exceeded' => '�� ���� ���� �����<br /><br />���� ����� ���� ����� ��� ����� ���� �� [quota]K, �������� ���� ������� ���� �� [space]K, ����� ����� �� ����� ������ ��� .',
	'gd_file_type_err' => '���� ������� ����� GD image library ������ ������� ������ �� ���� JPEG �- PNG.',
	'invalid_image' => '������ ���� ���� ������ ����� �� �- GD library ���� ����� ���� �� ����� ���� ����',
	'resize_failed' => '��� ������ ����� ����� ������ �� ������ �� �����.',
	'no_img_to_display' => '�� ����� ����� �����.',
	'non_exist_cat' => '�������� ������ ���� �����.',
	'orphan_cat' => '�������� ��� ������ �� ,��� �� ���� ��������� ���� ����� ���� ��.',
	'directory_ro' => '������ \'%s\' �� ����� ������, �� ���� ����� ������.',
	'non_exist_comment' => '����� ������ ���� �����',
	'pic_in_invalid_album' => '������ ��� ������ ������ ����� (%s)!?'
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => '�� �� ����� ��������',
	'alb_list_lnk' => '����� �������',
	'my_gal_title' => '�� �� ������ ������ ���',
	'my_gal_lnk' => '������ ���',
	'my_prof_lnk' => '������� ���',
	'adm_mode_title' => '���� ���� ����',
	'adm_mode_lnk' => '��� ����',
	'usr_mode_title' => '���� ���� �����',
	'usr_mode_lnk' => '��� �����',
	'upload_pic_title' => '��� ����� ���� ������',
	'upload_pic_lnk' => '��� �����',
	'register_title' => '��� �����',
	'register_lnk' => '����',
	'login_lnk' => '�����',
	'logout_lnk' => '�����',
	'lastup_lnk' => '����� �������',
	'lastcom_lnk' => '����� �������',
	'topn_lnk' => '��� �����',
	'toprated_lnk' => '��� �������',
	'search_lnk' => '���',
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => '����� ������',
	'config_lnk' => '������',
	'albums_lnk' => '�������',
	'categories_lnk' => '��������',
	'users_lnk' => '�������',
	'groups_lnk' => '������',
	'comments_lnk' => '�����',
	'searchnew_lnk' => '����� ����� ������',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => '��� \ ���� �� ������ ���',
	'modifyalb_lnk' => '��� �� ������ ���',
	'my_prof_lnk' => '������� ���',
);

$lang_cat_list = array(
	'category' => '�������',
	'albums' => '�������',
	'pictures' => '������',
);

$lang_album_list = array(
	'album_on_page' => '%d ������� �- %d ����'
);

$lang_thumb_view = array(
	'date' => '�����',
	'name' => '��',
	'sort_da' => '���� ��� ����� ���� ����',
	'sort_dd' => '���� ��� ����� ���� ����',
	'sort_na' => '���� ��� �� ���� ����',
	'sort_nd' => '���� ��� �� ���� ����',
	'pic_on_page' => '%d ������ �- %d ����',
	'user_on_page' => '%d ������� �- %d ����'
);

$lang_img_nav_bar = array(
	'thumb_title' => '���� �� ��� ������� ��������',
	'pic_info_title' => '���\���� ����� ��',
	'slideshow_title' => '��������',
	'ecard_title' => '��� ����� �� ������ ��������',
	'ecard_disabled' => '����� �������� ���� ����',
	'ecard_disabled_msg' => '��� �� ����� ����� ������ ��������',
	'prev_title' => '����� �����',
	'next_title' => '������ ����',
	'pic_pos' => '����� %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => '��� ����� �� ',
	'no_votes' => '(����� ��� ������)',
	'rating' => '(����� ����� : %s / 5 �� %s ������)',
	'rubbish' => '����',
	'poor' => '��',
	'fair' => '�����',
	'good' => '���',
	'excellent' => '�����',
	'great' => '�����',
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
	CRITICAL_ERROR => '����� ������',
	'file' => '����: ',
	'line' => '����: ',
);

$lang_display_thumbnails = array(
	'filename' => '�� ���� : ',
	'filesize' => '���� ���� : ',
	'dimensions' => '����� : ',
	'date_added' => '���� ������ : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s �����',
	'n_views' => '%s �����',
	'n_votes' => '(%s ������)'
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
	'Exclamation' => '�����',
	'Question' => '����',
	'Very Happy' => '��� ���',
	'Smile' => '�����',
	'Sad' => '����',
	'Surprised' => '�����',
	'Shocked' => '����',
	'Confused' => '������',
	'Cool' => '�����',
	'Laughing' => '�����',
	'Mad' => '����',
	'Razz' => '�����',
	'Embarassed' => '����',
	'Crying or Very sad' => '���� �� ���� ���',
	'Evil or Very Mad' => '����� �� ����� ���',
	'Twisted Evil' => '����� ������',
	'Rolling Eyes' => '������ ��������',
	'Wink' => '����',
	'Idea' => '�����',
	'Arrow' => '��',
	'Neutral' => '������',
	'Mr. Green' => '��.����',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'Leaving admin mode...',
	1 => 'Entering admin mode...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => '������ ���� ����� ��� �� !',
	'confirm_modifs' => '��� ��� ���� ����� ���� ������� ��� ?',
	'no_change' => '�� ����� �� ����� !',
	'new_album' => '����� ���',
	'confirm_delete1' => '��� ��� ���� ������� ����� ����� �� ?',
	'confirm_delete2' => '��� �� �� ������� ������� �� ����� !',
	'select_first' => '����� ��� ������',
	'alb_mrg' => '����� �������',
	'my_gallery' => '* ������ ��� *',
	'no_category' => '* ��� ������� *',
	'delete' => '���',
	'new' => '���',
	'apply_modifs' => '���� �������',
	'select_category' => '��� �������',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => '������� ������ ���� \'%s\'������ �� ������ !',
	'unknown_cat' => '�������� ������ ���� ����� ����� �������',
	'usergal_cat_ro' => '�������� ������ ������ �� ������ ������ !',
	'manage_cat' => '���� ��������',
	'confirm_delete' => '��� ��� ���� ������� ����� ������� �� ?',
	'category' => '�������',
	'operations' => '������',
	'move_into' => '���� ����',
	'update_create' => '���� / ��� �������',
	'parent_cat' => '������� ��',
	'cat_title' => '����� �������',
	'cat_desc' => '����� ��������'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => '�����',
	'restore_cfg' => '���� ����� ����',
	'save_cfg' => '���� ������ �����',
	'notes' => '�����',
	'info' => '����',
	'upd_success' => '����� ������ ������',
	'restore_success' => '����� ����� ����� ������',
	'name_a' => '�� ���� ����',
	'name_d' => '�� ���� ����',
	'date_a' => '����� ���� ����',
	'date_d' => '����� ���� ����',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'General settings',
	array('Gallery name', 'gallery_name', 0),
	array('Gallery description', 'gallery_description', 0),
	array('Gallery administrator email', 'gallery_admin_email', 0),
	array('Target address for the \'See more pictures\' link in e-cards', 'ecards_more_pic_target', 0),
	array('Language', 'lang', 5),
	array('Theme', 'theme', 6),

	'Album list view',
	array('Width of the main table (pixels or %)', 'main_table_width', 0),
	array('Number of levels of categories to display', 'subcat_level', 0),
	array('Number of albums to display', 'albums_per_page', 0),
	array('Number of columns for the album list', 'album_list_cols', 0),
	array('Size of thumbnails in pixels', 'alb_list_thumb_size', 0),
	array('The content of the main page', 'main_page_layout', 0),

	'Thumbnail view',
	array('Number of columns on thumbnail page', 'thumbcols', 0),
	array('Number of rows on thumbnail page', 'thumbrows', 0),
	array('Maximum number of tabs to display', 'max_tabs', 0),
	array('Display picture caption (in addition to title) below the thumbnail', 'caption_in_thumbview', 1),
	array('Display number of comments below the thumbnail', 'display_comment_count', 1),
	array('Default sort order for pictures', 'default_sort_order', 3),
	array('Minimum number of votes for a picture to appear in the \'top-rated\' list', 'min_votes_for_rating', 0),

	'Image view &amp; Comment settings',
	array('Width of the table for picture display (pixels or %)', 'picture_table_width', 0),
	array('Picture information are visible by default', 'display_pic_info', 1),
	array('Filter bad words in comments', 'filter_bad_words', 1),
	array('Allow smiles in comments', 'enable_smilies', 1),
	array('Max length for an image description', 'max_img_desc_length', 0),
	array('Max number of characters in a word', 'max_com_wlength', 0),
	array('Max number of lines in a comment', 'max_com_lines', 0),
	array('Maximum length of a comment', 'max_com_size', 0),

	'Pictures and thumbnails settings',
	array('Quality for JPEG files', 'jpeg_qual', 0),
	array('Max width or height of a thumbnail <b>*</b>', 'thumb_width', 0),
	array('Create intermediate pictures','make_intermediate',1),
	array('Max width or height of an intermediate picture <b>*</b>', 'picture_width', 0),
	array('Max size for uploaded pictures (KB)', 'max_upl_size', 0),
	array('Max width or height for uploaded pictures (pixels)', 'max_upl_width_height', 0),

	'User settings',
	array('Allow new user registrations', 'allow_user_registration', 1),
	array('User registration requires email verification', 'reg_requires_valid_email', 1),
	array('Allow two users to have the same email address', 'allow_duplicate_emails_addr', 1),
	array('Users can can have private albums', 'allow_private_albums', 1),

	'Custom fields for image description (leave blank if unused)',
	array('Field 1 name', 'user_field1_name', 0),
	array('Field 2 name', 'user_field2_name', 0),
	array('Field 3 name', 'user_field3_name', 0),
	array('Field 4 name', 'user_field4_name', 0),

	'Pictures and thumbnails advanced settings',
	array('Characters forbidden in filenames', 'forbiden_fname_char',0),
	array('Accepted file extensions for uploaded pictures', 'allowed_file_extensions',0),
	array('Method for resizing images','thumb_method',2),
	array('Path to ImageMagick \'convert\' utility (example /usr/bin/X11/)', 'impath', 0),
	array('Allowed image types (only valid for ImageMagick)', 'allowed_img_types',0),
	array('Command line options for ImageMagick', 'im_options', 0),
	array('Read EXIF data in JPEG files', 'read_exif_data', 1),
	array('The album directory <b>*</b>', 'fullpath', 0),
	array('The directory for user pictures <b>*</b>', 'userpics', 0),
	array('The prefix for intermediate pictures <b>*</b>', 'normal_pfx', 0),
	array('The prefix for thumbnails <b>*</b>', 'thumb_pfx', 0),
	array('Default mode for directories', 'default_dir_mode', 0),
	array('Default mode for pictures', 'default_file_mode', 0),

	'Cookies &amp; Charset settings',
	array('Name of the cookie used by the script', 'cookie_name', 0),
	array('Path of the cookie used by the script', 'cookie_path', 0),
	array('Character encoding', 'charset', 4),

	'Miscellaneous settings',
	array('Enable debug mode', 'debug_mode', 1),
	
	'<br /><div align="center">(*) Fields marked with * must not be changed if you already have pictures in your gallery</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => '���� ������ �� ��� ��� �����',
	'com_added' => '����� �����',
	'alb_need_title' => '���� ����� ����� ������ !',
	'no_udp_needed' => '�� ������ �������.',
	'alb_updated' => '������ �����',
	'unknown_album' => '������ ����� ���� ���� �� ����� ����� ������ ������ ���� !',
	'no_pic_uploaded' => '�� ����� �� ����� !<br /><br />����� ���� ���� ����� ������ ,���� ����� ����� ����� ������...',
	'err_mkdir' => '����� ����� ������� ����� %s !',
	'dest_dir_ro' => '������ ��� %s ���� ����� ������ ������� ������� !',
	'err_move' => '�� ���� ������ %s �� %s !',
	'err_fsize_too_large' => '���� ������ ���� ���� ����� ���� ��� (�������� ����� ��� %s x %s) !',
	'err_imgsize_too_large' => '���� ����� ����� ���� ��� (�������� ����� ��� %s �"�) !',
	'err_invalid_img' => '����� ����� ���� ���� ����� ���� !',
	'allowed_img_types' => '���� ����� %s ������ ����.',
	'err_insert_pic' => '������ \'%s\' �� ����� ������ ���� ������ ! ',
	'upload_success' => '������ ����� ������<br /><br />��� ���� ����� ������ ���� ����� �����.',
	'info' => '����',
	'com_added' => '���� �����',
	'alb_updated' => '������ �����',
	'err_comment_empty' => '����� ���� ����� !',
	'err_invalid_fext' => '�� ��� ����� ���� ������� ����� ������ ������ �������� : <br /><br />%s.',
	'no_flood' => '������� �� ��� ����� ���� ������ ��<br /><br />���� �� ����� ����� ����� ������',
	'redirect_msg' => '��� ����� ����<br /><br /><br />��� \'����\' ����� ���� �� ������ ��������',
	'upl_success' => '������ ����� ������',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => '�����',
	'fs_pic' => '����� ����� ���',
	'del_success' => '���� ������',
	'ns_pic' => '����� ����� ����',
	'err_del' => '�� ���� ������',
	'thumb_pic' => '����� ������',
	'comment' => '����',
	'im_in_alb' => '����� ���� ������',
	'alb_del_success' => '������ \'%s\' ����',
	'alb_mgr' => '����� �����',
	'err_invalid_data' => '���� ���� ����� �- \'%s\'',
	'create_alb' => '����� ����� \'%s\'',
	'update_alb' => '����� ����� \'%s\' �� ����� \'%s\' ������� \'%s\'',
	'del_pic' => '����� �����',
	'del_alb' => '����� �����',
	'del_user' => '����� �����',
	'err_unknown_user' => '������ ����� ���� ���� !',
	'comment_deleted' => '����� ����� ������',
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
	'confirm_del' => '��� ��� ���� ������� ����� ����� �� ? \\ ��� �� �� ������ �������� ���� ����� �� ��.',
	'del_pic' => '����� ����� ��',
	'size' => '%s x %s �������',
	'views' => '%s �����',
	'slideshow' => '���� ��������',
	'stop_slideshow' => '���� ���� ��������',
	'view_fs' => '��� ���� ����� ����� ���',
);

$lang_picinfo = array(
	'title' =>'���� �� ������',
	'Filename' => '�� ����',
	'Album name' => '�� �����',
	'Rating' => '����� (%s ������)',
	'Keywords' => '���� ����',
	'File Size' => '���� ����',
	'Dimensions' => '�����',
	'Displayed' => '�����',
	'Camera' => '�����',
	'Date taken' => '����� �����',
	'Aperture' => '����',
	'Exposure time' => '��� �����',
	'Focal length' => '���� ���',
	'Comment' => '����'
);

$lang_display_comments = array(
	'OK' => '����',
	'edit_title' => '���� ���� ��',
	'confirm_delete' => '��� ��� ���� ������� ����� ���� �� ?',
	'add_your_comment' => '���� �������',
	'your_name' => '��� ���',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => '��� ����� ��������',
	'invalid_email' => '<b>�����</b> : ����� ���� ����� !',
	'ecard_title' => '����� �������� ��� %s �����',
	'view_ecard' => '����� ������� ��������� ���� ���� ����� , ��� �� ����� ��',
	'view_more_pics' => '��� �� ����� �� ���� ����� ������� ������ !',
	'send_success' => '������ ��������� ����',
	'send_failed' => '������� �� ���� ���� ����� ����� ������� ����������...',
	'from' => '���',
	'your_name' => '��� ���',
	'your_email' => '����� ������� ���',
	'to' => '����',
	'rcpt_name' => '�� ����',
	'rcpt_email' => '����� ������ �� �����',
	'greetings' => '�����',
	'message' => '�����',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => '�����&nbsp;����',
	'album' => '�����',
	'title' => '�����',
	'desc' => '�����',
	'keywords' => '���� ����',
	'pic_info_str' => '%sx%s - %sKB - %s ����� - %s ������',
	'approve' => '��� �����',
	'postpone_app' => '��� �����',
	'del_pic' => '��� �����',
	'reset_view_count' => '��� ���� �����',
	'reset_votes' => '��� ������',
	'del_comm' => '��� �����',
	'upl_approval' => '��� �����',
	'edit_pics' => '���� �����',
	'see_next' => '��� ������ ����',
	'see_prev' => '��� ������ ������',
	'n_pic' => '%s ������',
	'n_of_pic_to_disp' => '���� ������� �����',
	'apply' => '���� �������'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => '�� �����',
	'disk_quota' => '��� ����',
	'can_rate' => '���� ���� ������',
	'can_send_ecards' => '���� ����� ����� ��������',
	'can_post_com' => '���� ������ �����',
	'can_upload' => '���� ����� �������',
	'can_have_gallery' => '���� ����� ��� ����� �����',
	'apply' => '���� �������',
	'create_new_group' => '��� ����� ����',
	'del_groups' => '��� ������ ������',
	'confirm_del' => '�����, ���� ��� ���� �����, ������� ������ ������ �� ������ ������ \'�������\'\�\��� ������ ������ ?',
	'title' => '���� ������ �������',
	'approval_1' => '����. ���. ����� (1)',
	'approval_2' => '����. ���. ����� (2)',
	'note1' => '<b>(1)</b> ����� ������ ���� ����� ����� ����.',
	'note2' => '<b>(2)</b> ����� ������ �� ����� ����� �� ����� �����.',
	'notes' => '�����'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => '���� ��� !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => '��� ��� ���� ���� ���� ����� ����� �� ? \\�� ������� ������� ����� �� ��.',
	'delete' => '�����',
	'modify' => '������',
	'edit_pics' => '���� ������',
);

$lang_list_categories = array(
	'home' => '���� ����',
	'stat1' => '<b>[������]</b> ������ �- <b>[�������]</b> ������� � <b>[�������]</b> �������� �� <b>[�����]</b> ����� ���� <b>[����]</b> �����',
	'stat2' => '<b>[������]</b> ������ �- <b>[�������]</b> ������� ���� <b>[����]</b> �����',
	'xx_s_gallery' => '%s\ ������',
	'stat3' => '<b>[������]</b> ������ �- <b>[�������]</b> ������� �� <b>[�����]</b> ����� ���� <b>[����]</b> �����'
);

$lang_list_users = array(
	'user_list' => '����� �������',
	'no_user_gal' => '��� ������ �������',
	'n_albums' => '%s �������',
	'n_pics' => '%s ������'
);

$lang_list_albums = array(
	'n_pictures' => '%s ������',
	'last_added' => ', ����� ������� %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => '�����',
	'enter_login_pswd' => '���� �� ��� ������� ���� ������',
	'username' => '�� �����',
	'password' => '�����',
	'remember_me' => '���� �� ������',
	'welcome' => '���� ��� %s ...',
	'err_login' => '*** ��� ������ ������. ��� ���� ***',
	'err_already_logged_in' => '��� ��� ����� !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => '�����',
	'bye' => '������� %s ...',
	'err_not_loged_in' => '��� ����� ����',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => '���� ����� %s',
	'general_settings' => '������ �����',
	'alb_title' => '����� �����',
	'alb_cat' => '�������� �����',
	'alb_desc' => '����� ������',
	'alb_thumb' => '������ ������� ������',
	'alb_perm' => '������ ���� ����� ��',
	'can_view' => '������ ����� ������',
	'can_upload' => '������ ������ ������ ������',
	'can_post_comments' => '������ ������ ����� �����',
	'can_rate' => '������ ������ ���� ������',
	'user_gal' => '����� �����',
	'no_cat' => '* ��� �������� *',
	'alb_empty' => '������ ���',
	'last_uploaded' => '����� �������',
	'public_alb' => '���� (����� ����)',
	'me_only' => '�� ���',
	'owner_only' => '��� ������ (%s) ����',
	'groupp_only' => '����� �- \'%s\' �����',
	'err_no_alb_to_modify' => '��� ����� ���� ���� ����� ����� �������.',
	'update' => '���� �����'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => '������� �� ��� ������ ����� ��',
	'rate_ok' => '������ ������',
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
By clicking '��� �����' below you agree to be bound by these conditions.
EOT;

$lang_register_php = array(
	'page_title' => '����� �������',
	'term_cond' => '����� �������',
	'i_agree' => '��� �����',
	'submit' => '��� �����',
	'err_user_exists' => '��� ������ ��� ���� , ��� ��� �� ���.',
	'err_password_mismatch' => '��� �������� ������ ���� ������, ��� ���� ���� ���.',
	'err_uname_short' => '�� ����� ���� ����� ��� 2 ����� �����.',
	'err_password_short' => '����� ����� ����� ���� 2 ����� �����.',
	'err_uname_pass_diff' => '�� ������ ������� ������ ����� �����.',
	'err_invalid_email' => '����� ������� �����',
	'err_duplicate_email' => '����� ��� ����� ��� ������ ������� ������.',
	'enter_info' => '���� ���� �����',
	'required_info' => '���� ����',
	'optional_info' => '���� ���������',
	'username' => '�� �����',
	'password' => '�����',
	'password_again' => '���� ����� ���',
	'email' => '������',
	'location' => '�����',
	'interests' => '�������',
	'website' => '�� ���� ���',
	'occupation' => '�����',
	'error' => '�����',
	'confirm_email_subject' => '%s - ����� ����� �����',
	'information' => '����',
	'failed_sending_email' => '����� ���� ������ ���� ���� ������ ������� !',
	'thank_you' => '���� ������<br /><br />������ ��� ���� �� ��� ������ �� ������ ���� ������ ������� �����.',
	'acct_created' => '������ ���� ���� ���� ������ ������� �� ������ ������� ���.',
	'acct_active' => '������ ���� ��� , ���� ������ ������� �� ������ �������.',
	'acct_already_act' => '������ ��� ���� !',
	'acct_act_failed' => '�� ���� ������ ����� �� !',
	'err_unk_user' => '������ ����� �� ���� ������ !',
	'x_s_profile' => '%s\'s ��������',
	'group' => '�����',
	'reg_date' => '�����',
	'disk_usage' => '���� ������',
	'change_pass' => '��� �����',
	'current_pass' => '����� ������',
	'new_pass' => '����� ����',
	'new_pass_again' => '���� ����� ���� ���',
	'err_curr_pass' => '����� ������ ���� �����',
	'apply_modif' => '���� �������',
	'change_pass' => '��� �� ������ ���',
	'update_success' => '������� ��� �����',
	'pass_chg_success' => '������ �����',
	'pass_chg_error' => '������ �� �����',
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
	'title' => '���� �����',
	'no_comment' => '��� ����� ������',
	'n_comm_del' => '%s ����� �����',
	'n_comm_disp' => '���� ������ ������',
	'see_prev' => '��� �����',
	'see_next' => '��� ����',
	'del_comm' => '��� ����� ������',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => '��� �������� �������',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => '��� ����� ����',
	'select_dir' => '��� �����',
	'select_dir_msg' => '������� �� ������ �� ����� ���� ������ ������ ���� ������ ���� �- FTP<br /><br />��� �� ������ �� ������ �������.',
	'no_pic_to_add' => '�� ����� ������ ������',
	'need_one_album' => '��� ���� ����� ��� ����� ���� ������ �������� ��',
	'warning' => '�����',
	'change_perm' => '��� ������� ������� ����� ������ ��, ���� ����� �� ���� ������ �- 755 �� 777 ���� ���� ���� ������ �� ������� !',
	'target_album' => '<b>���� ������ �� &quot;</b>%s<b>&quot; ���� </b>%s',
	'folder' => '�����',
	'image' => '�����',
	'album' => '�����',
	'result' => '�����',
	'dir_ro' => '�� ���� ������. ',
	'dir_cant_read' => '�� ���� ������. ',
	'insert' => '����� ������ ����� ������',
	'list_new_pic' => '����� �� ������� ������',
	'insert_selected' => '���� ������ ������',
	'no_pic_found' => '�� ����� ������ �����',
	'be_patient' => '��� ���� ������� , ������� ���� ��� ��� ���� ������ �� �������.',
	'notes' =>  '<ul>'.
				'<li><b>����</b> : ������ ��� �������� ����� ������'.
				'<li><b>������</b> : ������ ��� ������� ��� ��� ������ ����� �������'.
				'<li><b>�� ����</b> : ������ ��� ��� ���� ������ ������, ��� ���� �� ������� ��� ��� ���� ������� ������� ���� ��� ���� ����� �� �������'.
				'<li>�� ����� �� ������� ������ ����,������,�� ���� ��� �� ������ ������ ���� ����� ���� ����� ����� ��� �- PHP'.
				'<li>�� ����� ������ �� ���� ���� , ���� �� ���� ������ ����.'.
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
	'title' => '��� �����',
	'max_fsize' => '���� ���� ������� ���� ��� %s �"�',
	'album' => '�����',
	'picture' => '�����',
	'pic_title' => '����� �����',
	'description' => '����� �����',
	'keywords' => '���� ���� (����� �������)',
	'err_no_alb_uploadables' => '������� �� ��� ����� �� ��� ����� ������ ������ !',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => '���� �������',
	'name_a' => '���� ���� ����',
	'name_d' => '���� ���� ����',
	'group_a' => '������ ���� ����',
	'group_d' => '������ ���� ����',
	'reg_a' => '����� ����� ���� ����',
	'reg_d' => '����� ����� ���� ����',
	'pic_a' => '����� ������ ���� ����',
	'pic_d' => '����� ������ ���� ����',
	'disku_a' => '���� ������ ���� ����',
	'disku_d' => '���� ������ ���� ����',
	'sort_by' => '��� ������� ���',
	'err_no_users' => '���� ������� ���� !',
	'err_edit_self' => '���� ���� ����� ������ �� ������� ���, ����� �����\'������� ���\' ���� ����� ��',
	'edit' => '����',
	'delete' => '���',
	'name' => '�� �����',
	'group' => '�����',
	'inactive' => '�� ����',
	'operations' => '������',
	'pictures' => '������',
	'disk_space' => '���� ������ / ����',
	'registered_on' => '���� �...',
	'u_user_on_p_pages' => '%d ������� � %d ����',
	'confirm_del' => '��� ��� ���� ������� ����� ����� �� ? \\��� �� �� ������� ������� �� ����� �� ����� �� ��',
	'mail' => '����',
	'err_unknown_user' => '������ ����� ���� ���� !',
	'modify_user' => '���� �����',
	'notes' => '�����',
	'note_list' => '<li>�� ���� ������ ����� �� ������ ,���� �� ���� ������ ���.',
	'password' => '�����',
	'user_active' => '������ ����',
	'user_group' => '����� �����',
	'user_email' => '����� ������ �� ������',
	'user_web_site' => '��� ���� �� ������',
	'create_new_user' => '��� ����� ���',
	'user_location' => '����� ������',
	'user_interests' => '������ ������',
	'user_occupation' => '����� ������',
);
?>