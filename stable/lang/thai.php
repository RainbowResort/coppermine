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


$lang_charset = 'windows-874';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('�ҷԵ��', '�ѹ���', '�ѧ���', '�ظ', '����ʺ��', '�ء��', '�����');
$lang_month = array('���Ҥ�', '����Ҿѹ��', '�չҤ�', '����¹', '����Ҥ�', '�Զع�¹', '�á�Ҥ�', '�ԧ�Ҥ�', '�ѹ��¹', '���Ҥ�', '��Ȩԡ�¹', '�ѹ�Ҥ�');

// Some common strings
$lang_yes = '��';
$lang_no  = '���';
$lang_back = '��Ѻ�';
$lang_continue = '����';
$lang_info = '��������´';
$lang_error = '�Դ��Ҵ';

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
	'random' => '�����Ҿ�ҡ��ź�����ҧ�',
	'lastup' => '�Ҿ����������������ش',
	'lastcom' => '��ͤԴ�������ش',
	'topn' => '�Ҿ���١�Դ���ҡ����ش',
	'toprated' => '�ѹ�Ѻ�Ҿ�ʹ����',
	'lasthits' => '�Ҿ���١�Դ������ش',
	'search' => '�š�ä���'
);

$lang_errors = array(
	'access_denied' => 'You don\'t have permission to access this page.',
	'perm_denied' => 'You don\'t have permission to perform this operation.',
	'param_missing' => 'Script called without the required parameter(s).',
	'non_exist_ap' => 'The selected album/picture does not exist !',
	'quota_exceeded' => 'Disk quota exceeded<br /><br />You have a space quota of [quota]K, your pictures currently use [space]K, adding this picture would make you exceed your quota.',
	'gd_file_type_err' => 'When using the GD image library allowed image types are only JPEG and PNG.',
	'invalid_image' => 'The image you have uploaded is corrupted or can\'t be handled by the GD library',
	'resize_failed' => 'Unable to create thumbnail or reduced size image.',
	'no_img_to_display' => 'No image to display',
	'non_exist_cat' => 'The selected category does not exist',
	'orphan_cat' => 'A category has a non-existing parent, runs the category manager to correct the problem.',
	'directory_ro' => 'Directory \'%s\' is not writable, pictures can\'t be deleted',
	'non_exist_comment' => 'The selected comment does not exist.',
	'pic_in_invalid_album' => 'Picture is in a non existant album (%s)!?'
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => '��ѧ˹�������ź�����ҧ �',
	'alb_list_lnk' => '�ٹ�������ź���',
	'my_gal_title' => '��ѧ��ͧ�Ҿ��ǹ���',
	'my_gal_lnk' => '��ͧ�Ҿ��ǹ���',
	'my_prof_lnk' => '�����������´��ǹ���',
	'adm_mode_title' => '����¹�������������к�',
	'adm_mode_lnk' => '�����������к�',
	'usr_mode_title' => '����¹�����������',
	'usr_mode_lnk' => '���������',
	'upload_pic_title' => '�����Ŵ�Ҿ��ѧ��ź���',
	'upload_pic_lnk' => '�����Ŵ�Ҿ',
	'register_title' => '���ҧ account',
	'register_lnk' => 'ŧ����¹',
	'login_lnk' => '������к�',
	'logout_lnk' => '�͡�ҡ�к�',
	'lastup_lnk' => '�����Ŵ����ش',
	'lastcom_lnk' => '��ͤԴ�������ش',
	'topn_lnk' => '�Ҿ���١�Դ���ҡ����ش',
	'toprated_lnk' => '�ѹ�Ѻ�ʹ����',
	'search_lnk' => '����',
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => '���٨���Ҿ�������',
	'config_lnk' => '��Ѻ����¹�к�',
	'albums_lnk' => '��ź�����ҧ�',
	'categories_lnk' => '�¡��Ǵ����',
	'users_lnk' => '�ѭ�ռ����',
	'groups_lnk' => '����������',
	'comments_lnk' => '��ͤԴ���',
	'searchnew_lnk' => '���Ҿ�����',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => '���ҧ / �Ѵ���§��ź���',
	'modifyalb_lnk' => '�����ź���',
	'my_prof_lnk' => '��������ǹ���',
);

$lang_cat_list = array(
	'category' => '��Ǵ����',
	'albums' => '��ź���',
	'pictures' => '�Ҿ',
);

$lang_album_list = array(
	'album_on_page' => '%d ��ź����ӹǹ %d ˹��'
);

$lang_thumb_view = array(
	'date' => '�ѹ���',
	'name' => '����',
	'sort_da' => 'Sort by date ascending',
	'sort_dd' => 'Sort by date descending',
	'sort_na' => 'Sort by name ascending',
	'sort_nd' => 'Sort by name descending',
	'pic_on_page' => '%d pictures on %d page(s)',
	'user_on_page' => '%d users on %d page(s)'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Return to the thumbnail page',
	'pic_info_title' => 'Display/hide picture information',
	'slideshow_title' => 'Slideshow',
	'ecard_title' => 'Send this picture as an e-card',
	'ecard_disabled' => 'e-cards are disabled',
	'ecard_disabled_msg' => 'You don\'t have permission to send ecards',
	'prev_title' => 'See previous picture',
	'next_title' => 'See next picture',
	'pic_pos' => 'PICTURE %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => '�ѹ�Ѻ�Ҿ��� ',
	'no_votes' => '( �ѧ����ա����ǵ )',
	'rating' => '(�õ��駻Ѩ�غѹ : %s / 5 �ҡ�����ǵ %s ��)',
	'rubbish' => '����һ�зѺ�',
	'poor' => '�ʹ���',
	'fair' => '�ҹ��ҧ',
	'good' => '���ҡ',
	'excellent' => '�ʹ������',
	'great' => '�ʹ����������ش',
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
	'filename' => '������� : ',
	'filesize' => '��Ҵ�ͧ��� : ',
	'dimensions' => '���ҧx���s : ',
	'date_added' => '�����������ѹ��� : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s �������',
	'n_views' => '%s views',
	'n_votes' => '(%s votes)'
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
	0 => '���ѧ�͡�ҡ�����������к�',
	1 => '���ѧ�����������������к�.',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Albums need to have a name !',
	'confirm_modifs' => 'Are you sure you want to make these modifications ?',
	'no_change' => 'You did not make any change !',
	'new_album' => 'New album',
	'confirm_delete1' => 'Are you sure you want to delete this album ?',
	'confirm_delete2' => '\nAll pictures and comments it contains will be lost !',
	'select_first' => 'Select an album first',
	'alb_mrg' => 'Album Manager',
	'my_gallery' => '* My gallery *',
	'no_category' => '* No category *',
	'delete' => 'Delete',
	'new' => 'New',
	'apply_modifs' => 'Apply modifications',
	'select_category' => 'Select category',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Parameters required for \'%s\'operation not supplied !',
	'unknown_cat' => 'Selected category does not exist in database',
	'usergal_cat_ro' => 'User galleries category can\'t be deleted !',
	'manage_cat' => 'Manage categories',
	'confirm_delete' => 'Are you sure you want to DELETE this category',
	'category' => 'Category',
	'operations' => 'Operations',
	'move_into' => 'Move into',
	'update_create' => 'Update/Create category',
	'parent_cat' => 'Parent category',
	'cat_title' => 'Category title',
	'cat_desc' => 'Category description'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Configuration',
	'restore_cfg' => 'Restore factory defaults',
	'save_cfg' => 'Save new configuration',
	'notes' => 'Notes',
	'info' => 'Information',
	'upd_success' => 'Coppermine configuration was updated',
	'restore_success' => 'Coppermine default configuration restored',
	'name_a' => 'Name ascending',
	'name_d' => 'Name descending',
	'date_a' => 'Date ascending',
	'date_d' => 'Date descending'
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
	'empty_name_or_com' => 'You need to type your name and a comment',
	'com_added' => 'Your comment was added',
	'alb_need_title' => 'You have to provide a title for the album !',
	'no_udp_needed' => 'No update needed.',
	'alb_updated' => 'The album was updated',
	'unknown_album' => 'Selected album does not exist or you don\'t have permission to upload in this album',
	'no_pic_uploaded' => 'No picture was uploaded !<br /><br />If you have really selected a picture to upload, check that the server allows file uploads...',
	'err_mkdir' => 'Failed to create directory %s !',
	'dest_dir_ro' => 'Destination directory %s is not writable by the script !',
	'err_move' => 'Impossible to move %s to %s !',
	'err_fsize_too_large' => 'The size of picture you have uploaded is too large (maximum allowed is %s x %s) !',
	'err_imgsize_too_large' => 'The size of the file you have uploaded is too large (maximum allowed is %s KB) !',
	'err_invalid_img' => 'The file you have uploaded is not a valid image !',
	'allowed_img_types' => 'You can only upload %s images.',
	'err_insert_pic' => 'The picture \'%s\' can\'t be inserted in the album ',
	'upload_success' => 'Your picture was uploaded successfully<br /><br />It will be visible after admin approval.',
	'info' => 'Information',
	'com_added' => 'Comment added',
	'alb_updated' => 'Album updated',
	'err_comment_empty' => 'Your comment is empty !',
	'err_invalid_fext' => 'Only files with the following extensions are accepted : <br /><br />%s.',
	'no_flood' => 'Sorry but you are already the author of the last comment posted for this picture<br /><br />Edit the comment you have posted if you want to modify it',
	'redirect_msg' => 'You are being redirected.<br /><br /><br />Click \'CONTINUE\' if the page does not refresh automatically',
	'upl_success' => 'Your picture was successfully added',
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
	'alb_del_success' => 'Album \'%s\' deleted',
	'alb_mgr' => 'Album Manager',
	'err_invalid_data' => 'Invalid data received in \'%s\'',
	'create_alb' => 'Creating album \'%s\'',
	'update_alb' => 'Updating album \'%s\' with title \'%s\' and index \'%s\'',
	'del_pic' => 'Delete picture',
	'del_alb' => 'Delete album',
	'del_user' => 'Delete user',
	'err_unknown_user' => 'The selected user does not exist !',
	'comment_deleted' => 'Comment was succesfully deleted',
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
	'confirm_del' => '�س��ͧ���ź�Ҿ����ԧ� ���� ? \\n ��ͤԴ��繵�ҧ� �ж١ź仴���.',
	'del_pic' => 'ź�Ҿ���',
	'size' => '%s x %s pixels',
	'views' => '%s ����',
	'slideshow' => '��Ŵ����',
	'stop_slideshow' => '��ش��Ŵ����',
	'view_fs' => '�����ʹ��ҾẺ�����',
);

$lang_picinfo = array(
	'title' =>'��������´�ͧ�Ҿ',
	'Filename' => '�������',
	'Album name' => '������ź���',
	'Rating' => '�õ��� (%s ��ǵ)',
	'Keywords' => '���������',
	'File Size' => '��Ҵ���',
	'Dimensions' => '���ҧx���',
	'Displayed' => '�١�ʴ�����',
	'Camera' => '����ͧ',
	'Date taken' => '������������',
	'Aperture' => '��Ѻ��ͧ�Ѻ�ʧ',
	'Exposure time' => '���������Դ˹�ҡ��ͧ',
	'Focal length' => '����⿡��',
	'Comment' => '��ͤԴ���'
);

$lang_display_comments = array(
	'OK' => '��ŧ',
	'edit_title' => '��䢢�ͤԴ��繹��',
	'confirm_delete' => '�س���������Ҩ�ź��ͤԴ��繹�� ?',
	'add_your_comment' => '������ͤԴ���',
	'your_name' => '���ͧ͢�س',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => '�� E-card',
	'invalid_email' => '<b>����͹</b> : E-mail Address ���١��ͧ !',
	'ecard_title' => 'An e-card from %s for you',
	'view_ecard' => 'If the e-card does not display correctly, click this link',
	'view_more_pics' => 'Click this link to view more pictures !',
	'send_success' => 'Your ecard was sent',
	'send_failed' => 'Sorry but the server can\'t send your e-card...',
	'from' => 'From',
	'your_name' => '���ͼ����',
	'your_email' => 'E-mail �ͧ�����',
	'to' => 'To',
	'rcpt_name' => '���ͼ���Ѻ',
	'rcpt_email' => 'E-mail �ͧ����Ѻ',
	'greetings' => '����¾�',
	'message' => '��ͤ���',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Picture&nbsp;info',
	'album' => 'Album',
	'title' => 'Title',
	'desc' => 'Description',
	'keywords' => 'Keywords',
	'pic_info_str' => '%sx%s - %sKB - %s views - %s votes',
	'approve' => 'Approve picture',
	'postpone_app' => 'Postpone approval',
	'del_pic' => 'Delete picture',
	'reset_view_count' => 'Reset view counter',
	'reset_votes' => 'Reset votes',
	'del_comm' => 'Delete comments',
	'upl_approval' => 'Upload approval',
	'edit_pics' => 'Edit pictures',
	'see_next' => 'See next pictures',
	'see_prev' => 'See previous pictures',
	'n_pic' => '%s pictures',
	'n_of_pic_to_disp' => 'Number of picture to display',
	'apply' => 'Apply modifications'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => '���͡����',
	'disk_quota' => '���ǵ���红�����',
	'can_rate' => '����ö����ṹ�Ҿ��',
	'can_send_ecards' => '����ö�� E-card ��',
	'can_post_com' => '����ö��¹��ͤԴ�����',
	'can_upload' => '����ö�����Ŵ�Ҿ��',
	'can_have_gallery' => '����ö����ͧ�Ҿ��ǹ�����',
	'apply' => '��ŧ��Ѻ��ا���',
	'create_new_group' => '���ҧ���������',
	'del_groups' => 'ź�����������͡',
	'confirm_del' => '����͹, ����ͤسź�����, ���ͼ����㹡������� �ж١������ѧ����� \'�����ŧ����¹���\'  !\n\n ��ͧ��÷ӵ���������� ?',
	'title' => 'Manage user groups',
	'approval_1' => 'Pub. Upl. approval (1)',
	'approval_2' => 'Priv. Upl. approval (2)',
	'note1' => '<b>(1)</b> Uploads in a public album need admin approval',
	'note2' => '<b>(2)</b> Uploads in an album that belong to the user need admin approval',
	'notes' => 'Notes'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => '�Թ�յ�͹�Ѻ !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => '�س������ͷ���ź��ź������ ? \\n �ٻ��Т�ͤԴ��繷������ж١ź仴���.',
	'delete' => 'ź',
	'modify' => '�س���ѵ�',
	'edit_pics' => '����Ҿ',
);

$lang_list_categories = array(
	'home' => '˹����ѡ',
	'stat1' => '<b>[pictures]</b> �Ҿ � <b>[albums]</b> ��ź��� <b>[cat]</b> ��Ǵ���� ��<b>[comments]</b> ��ͤԴ��� ��觶١�Դ������ <b>[views]</b> ����',
	'stat2' => '<b>[pictures]</b> �Ҿ � <b>[albums]</b> ��ź��� ��觶١�Դ������ <b>[views]</b> ����',
	'xx_s_gallery' => '%s\'s Gallery',
	'stat3' => '<b>[pictures]</b> �Ҿ � <b>[albums]</b> ��ź��� �� <b>[comments]</b> ��ͤԴ��� ��觶١�Դ������ <b>[views]</b> ����'
);

$lang_list_users = array(
	'user_list' => '��ª��ͼ����',
	'no_user_gal' => '����ժ��ͼ������ͧ�Ҿ',
	'n_albums' => '%s ��ź���',
	'n_pics' => '%s �Ҿ'
);

$lang_list_albums = array(
	'n_pictures' => '%s �Ҿ',
	'last_added' => ', �Ҿ����ش���١���������ѧ %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Login => �������к�',
	'enter_login_pswd' => '�����ͼ���� ������ʼ�ҹ���͢�͹حҵ�������к�',
	'username' => '���ͼ����',
	'password' => '���ʼ�ҹ',
	'remember_me' => '����騴�Ӫ����������������� ?',
	'welcome' => '�Թ�յ�͹�Ѻ��Ѻ �س %s ...',
	'err_login' => '*** �������ö�������к���, �������ա���� ***',
	'err_already_logged_in' => '�س����Ң�͹حҵ�������к����� !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => '�͡�ҡ�к�',
	'bye' => '⪤�դ�Ѻ��Ѻ �س %s .���ǡ�Ѻ����������ҧ�Ф�Ѻ..',
	'err_not_loged_in' => '�س�ѧ������͹حҵ����к� !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Update album %s',
	'general_settings' => 'General settings',
	'alb_title' => 'Album title',
	'alb_cat' => 'Album category',
	'alb_desc' => 'Album description',
	'alb_thumb' => 'Album thumbnail',
	'alb_perm' => 'Permissions for this album',
	'can_view' => 'Album can be viewed by',
	'can_upload' => 'Visitors can upload pictures',
	'can_post_comments' => 'Visitors can post comments',
	'can_rate' => 'Visitors can rate pictures',
	'user_gal' => 'User Gallery',
	'no_cat' => '* No category *',
	'alb_empty' => 'Album is empty',
	'last_uploaded' => 'Last uploaded',
	'public_alb' => 'Everybody (public album)',
	'me_only' => 'Me only',
	'owner_only' => 'Album owner (%s) only',
	'groupp_only' => 'Members of the \'%s\' group',
	'err_no_alb_to_modify' => 'No album you can modify in the database.',
	'update' => 'Update album'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Sorry but you have already rated this picture',
	'rate_ok' => 'Your vote was accepted',
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
	'page_title' => 'User registration',
	'term_cond' => 'Terms and conditions',
	'i_agree' => 'I agree',
	'submit' => 'Submit registration',
	'err_user_exists' => 'The username you have entered already exist, please choose a different one',
	'err_password_mismatch' => 'The two passwords does not match, please input them again',
	'err_uname_short' => 'Username must be 2 characters long minimum',
	'err_password_short' => 'Password must be 2 characters long minimum',
	'err_uname_pass_diff' => 'Username and password must be different',
	'err_invalid_email' => 'Email address is invalid',
	'err_duplicate_email' => 'Another user has already registered with the email address you entered',
	'enter_info' => 'Input registration information',
	'required_info' => 'Required information',
	'optional_info' => 'Optional information',
	'username' => 'Username',
	'password' => 'Password',
	'password_again' => 'Re-enter password',
	'email' => 'Email',
	'location' => 'Location',
	'interests' => 'Interests',
	'website' => 'Home page',
	'occupation' => 'Occupation',
	'error' => 'ERROR',
	'confirm_email_subject' => '%s - Registration confirmation',
	'information' => 'Information',
	'failed_sending_email' => 'The registration confirmation email can\'t be send !',
	'thank_you' => 'Thank your for registering.<br /><br />An email with information on how to activate your account was sent to the email address your provided.',
	'acct_created' => 'Your account has been created and you can now login with your username and password',
	'acct_active' => 'Your account is now active and you can login with your username and password',
	'acct_already_act' => 'Your account is already active !',
	'acct_act_failed' => 'This account can\'t be activated !',
	'err_unk_user' => 'Selected user does not exist !',
	'x_s_profile' => '%s\'s profile',
	'group' => 'Group',
	'reg_date' => 'Joined',
	'disk_usage' => 'Disk usage',
	'change_pass' => 'Change password',
	'current_pass' => 'Current password',
	'new_pass' => 'New password',
	'new_pass_again' => 'New password again',
	'err_curr_pass' => 'Current password is incorrect',
	'apply_modif' => 'Apply modifications',
	'change_pass' => 'Change my password',
	'update_success' => 'Your profile was updated',
	'pass_chg_success' => 'Your password was changed',
	'pass_chg_error' => 'Your password was not changed',
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
	'title' => 'Review comments',
	'no_comment' => 'There is no comment to review',
	'n_comm_del' => '%s comment(s) deleted',
	'n_comm_disp' => 'Number of comments to display',
	'see_prev' => 'See previous',
	'see_next' => 'See next',
	'del_comm' => 'Delete selected comments',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Search the image collection',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Search new pictures',
	'select_dir' => 'Select directory',
	'select_dir_msg' => 'This function allows you to add a batch of picture that your have uploaded on your server by FTP.<br /><br />Select the directory where you have uploaded your pictures',
	'no_pic_to_add' => 'There is no picture to add',
	'need_one_album' => 'You need at least one album to use this function',
	'warning' => 'Warning',
	'change_perm' => 'the script can\'t write in this directory, you need to change its mode to 755 or 777 before trying to add the pictures !',
	'target_album' => '<b>Put pictures of &quot;</b>%s<b>&quot; into </b>%s',
	'folder' => 'Folder',
	'image' => 'Image',
	'album' => 'Album',
	'result' => 'Result',
	'dir_ro' => 'Not writable. ',
	'dir_cant_read' => 'Not readable. ',
	'insert' => 'Adding new pictures to the gallery',
	'list_new_pic' => 'List of new pictures',
	'insert_selected' => 'Insert selected pictures',
	'no_pic_found' => 'No new picture was found',
	'be_patient' => 'Please be patient, the script needs time to add the pictures',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : means that the picture was succesfully added'.
				'<li><b>DP</b> : means that the picture is a duplicate and is already in the database'.
				'<li><b>PB</b> : means that the picture could not be added, check your configuration and the permission of directories where the pictures are located'.
				'<li>If the OK, DP, PB \'signs\' does not appear click on the broken picture to see any error message produced by PHP'.
				'<li>If your browser timeout, hit the reload button'.
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
	'title' => 'Upload picture',
	'max_fsize' => 'Maximum allowed file size is %s KB',
	'album' => 'Album',
	'picture' => 'Picture',
	'pic_title' => 'Picture title',
	'description' => 'Picture description',
	'keywords' => 'Keywords (separate with spaces)',
	'err_no_alb_uploadables' => 'Sorry there is no album where you are allowed to upload pictures',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Manage users',
	'name_a' => 'Name ascending',
	'name_d' => 'Name descending',
	'group_a' => 'Group ascending',
	'group_d' => 'Group descending',
	'reg_a' => 'Reg date ascending',
	'reg_d' => 'Reg date descending',
	'pic_a' => 'Pic count ascending',
	'pic_d' => 'Pic count descending',
	'disku_a' => 'Disk usage ascending',
	'disku_d' => 'Disk usage descending',
	'sort_by' => 'Sort users by',
	'err_no_users' => 'User table is empty !',
	'err_edit_self' => 'You can\'t edit your own profile, use the \'My profile\' link for that',
	'edit' => 'EDIT',
	'delete' => 'DELETE',
	'name' => 'User name',
	'group' => 'Group',
	'inactive' => 'Inactive',
	'operations' => 'Operations',
	'pictures' => 'Pictures',
	'disk_space' => 'Space used / Quota',
	'registered_on' => 'Registered on',
	'u_user_on_p_pages' => '%d users on %d page(s)',
	'confirm_del' => 'Are you sure you want to DELETE this user ? \\nAll his pictures and albums will also be deleted.',
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
);
?>