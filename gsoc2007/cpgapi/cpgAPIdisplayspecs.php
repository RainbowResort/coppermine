<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2007 Coppermine Dev Team
  v0.1 originally written by Nitin Gupta

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision: 2 $
  $LastChangedBy: xnitingupta $
  $Date: 6:01 PM 6/1/2007 $
**********************************************/

/**
 * Class specifying everthing about the display structure
 */
class displayspecs {
  var $userpersonalfields, $groupfields, $configfields;

  function initialize() {
    // Database connection settings

    $this->userpersonalfields = array(
       'username', 'user_id', 'email', 'regdate', 'lastvisit', 'active',
       'profile1', 'profile2', 'profile3', 'profile4', 'profile5', 'profile6'
    );

    $this->groupfields = array(
       'group_id', 'groupname', 'admin'
    );

    $this->configfields = array(
	'albums_per_page',
	'album_list_cols',
	'display_pic_info',
	'alb_list_thumb_size',
	'allowed_mov_types',
	'allowed_doc_types',
	'allowed_snd_types',
	'allowed_img_types',
	'allow_private_albums',
	'allow_user_registration',
	'user_registration_disclaimer',
	'allow_unlogged_access',
	'allow_duplicate_emails_addr',
	'caption_in_thumbview',
	'views_in_thumbview',
	'charset',
	'cookie_name',
	'cookie_path',
	'debug_mode',
	'debug_notice',
	'default_dir_mode',
	'default_file_mode',
	'default_sort_order',
	'ecards_more_pic_target',
	'home_target',
	'custom_lnk_name',
	'custom_lnk_url',
	'enable_smilies',
	'filter_bad_words',
	'forbiden_fname_char',
	'fullpath',
	'gallery_admin_email',
	'gallery_description',
	'gallery_name',
	'im_options',
	'impath',
	'jpeg_qual',
	'keep_votes_time',
	'lang',
	'main_page_layout',
	'main_table_width',
	'make_intermediate',
	'max_com_lines',
	'max_com_size',
	'max_com_wlength',
	'max_img_desc_length',
	'max_tabs',
	'max_upl_size',
	'max_upl_width_height',
	'auto_resize',
	'min_votes_for_rating',
	'normal_pfx',
	'offline',
	'picture_table_width',
	'picture_width',
	'read_exif_data',
	'reg_requires_valid_email',
	'subcat_level',
	'theme',
	'thumbcols',
	'thumbrows',
	'thumb_method',
	'thumb_pfx',
	'thumb_width',
	'userpics',
	'vanity_block',
	'user_profile1_name',
	'user_profile2_name',
	'user_profile3_name',
	'user_profile4_name',
	'user_profile5_name',
	'user_profile6_name',
	'user_field1_name',
	'user_field2_name',
	'user_field3_name',
	'user_field4_name',
	'display_comment_count',
	'show_private',
	'first_level',
	'display_film_strip',
	'display_film_strip_filename',
	'max_film_strip_items',
	'thumb_use',
	'read_iptc_data',
	'reg_notify_admin_email',
	'disable_comment_flood_protect',
	'upl_notify_admin_email',
	'display_uploader',
	'display_filename',
	'language_list',
	'language_flags',
	'theme_list',
	'language_reset',
	'theme_reset',
	'allow_memberlist',
	'display_faq',
	'show_bbcode_help',
	'log_ecards',
	'email_comment_notification',
	'enable_zipdownload',
	'slideshow_interval',
	'log_mode',
	'media_autostart',
	'enable_encrypted_passwords',
	'time_offset',
	'ban_private_ip',
	'smtp_host',
	'smtp_username',
	'smtp_password',
	'enable_plugins',
	'enable_help',
	'categories_alpha_sort',
	'login_threshold',
	'login_expiry',
	'allow_email_change',
	'clickable_keyword_search',
	'users_can_edit_pics',
	'language_fallback',
	'vote_details',
	'hit_details',
	'browse_batch_add',
	'custom_header_path',
	'custom_footer_path',
	'comments_sort_descending',
	'report_post',
	'comments_anon_pfx',
	'admin_activation',
	'display_thumbnail_rating',
	'thumbnail_to_fullsize',
	'global_registration_pw',
	'silly_safe_mode',
	'enable_watermark',
	'where_put_watermark',
	'watermark_file',
	'which_files_to_watermark',
	'orig_pfx',
	'watermark_transparency',
	'reduce_watermark',
	'watermark_transparency_featherx',
	'watermark_transparency_feathery',
	'enable_thumb_watermark',
	'enable_unsharp',
	'unsharp_amount',
	'unsharp_radius',
	'unsharp_threshold',
	'thumb_height',
	'picinfo_movie_download_link',
	'show_which_exif',
	'alb_desc_thumb',
	'link_pic_count',
	'bridge_enable',
	'comment_approval',
	'display_comment_approval_only',
	'comment_placeholder',
	'comment_user_edit',
	'comment_captcha',
	'registration_captcha',
	'ecard_flash',
	'personal_album_on_registration',
	'slideshow_hits',
	'transparent_overlay',
	'comment_promote_registration',
	'allow_user_account_delete',
	'display_stats_on_index',
	'browse_by_date',
        'site_url',
        'allow_get_api'
    );

  }
}
?>