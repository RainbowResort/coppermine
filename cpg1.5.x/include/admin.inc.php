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
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

/**********************************************
  Defines the scope of configuration variables
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');


$config_data = array(
  'general_settings' => array(
    'gallery_name' => array(
      'type' => 'textfield',
      'help_link' => 'f=configuration.htm&amp;as=admin_general_name&amp;ae=admin_general_name_end',
      'regex_not' => '^Your gallery name here$',
    ),
    'gallery_description' => array(
      'type' => 'textfield',
      'help_link' => 'f=configuration.htm&amp;as=admin_general_description&amp;ae=admin_general_description_end',
      'regex_not' => '^Your gallery description here$',
    ),
    'gallery_admin_email' => array(
      'type' => 'textfield',
      'help_link' => 'f=configuration.htm&amp;as=admin_general_email&amp;ae=admin_general_email_end',
      'regex' => '^'
                  .'('
                  .'[a-zA-Z0-9]((\.|\-|\_){0,1}'
                  .'[a-zA-Z0-9]){0,}'
                  .')'
                  .'@'
                  .'('
                  .'[a-zA-Z]((\.|\-){0,1}'
                  .'[a-zA-Z0-9]){0,}'
                  .')'
                  .'\.'
                  .'([a-zA-Z]{2,4})'
                  .'$',
      'regex_not' => '^you@somewhere\.com$',
    ),
    'ecards_more_pic_target' => array(
      'type' => 'textfield',
      'help_link' => 'f=configuration.htm&amp;as=admin_general_coppermine-url&amp;ae=admin_general_coppermine-url_end',
      'regex' => '^'
                  .'(http://){1,1}' // leading 'http://' is mandatory - no support for https yet
                  .'(([0-9a-z_!~*\'().&=+$%-]+: ){0,1}' //password, separated with a colon
                  .'[0-9a-z_!~*\'().&=+$%-]+@){0,1}' //username, separated with an @
                  .'(([0-9]{1,3}\.){3}[0-9]{1,3}' // IP- 199.194.52.184
                  .'|' // allows either IP or domain or localhost
                  .'(' // domain start
                  .'([0-9a-z_!~*\'()-]+\.)*' // tertiary domain(s)- www.
                  .'([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\.' // second level domain
                  .'[a-z]{2,6}' // first level domain- .com or .museum
                  .')' // domain end
                  .'|' // allows either IP or domain or localhost
                  .'(localhost)' // allow localhost
                  .')' // end of domain / IP address
                  .'(:[0-9]{1,4}){0,1}' // port number- :80
                  .'[/]{1,1}' // trailing slash after domain-part of URL
                  .'('
                  .'([0-9a-zA-Z_!~.()-])+/{1}'
                  .'){0,}'
                  .'$',
      'regex_not' => '^http://yoursite.tld/your_coppermine_folder/$',
      'additional_description' => $lang_admin_php['ecards_more_pic_target_detail'],
    ),
    'home_target' => array(
      'type' => 'textfield',
      'default_value' => 'index.php',
      'help_link' => 'f=configuration.htm&amp;as=admin_general_home-url&amp;ae=admin_general_home-url_end',
    ),
    'enable_zipdownload' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_general_zip-download&amp;ae=admin_general_zip-download_end',
    ),
    'time_offset' => array(
      'type' => 'textfield',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_general_time-offset&amp;ae=admin_general_time-offset_end&amp;top=1',
      'regex' => '^[+-]?([0-9]{1,2})*\.?[0-9]+$',
      'size' => '5',
      'width' => '5',
      'maxlength' => '5',
      'end_description' => $lang_admin_php['time_offset_detail'],
    ),
    'enable_help' => array(
      'type' => 'radio',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_general_help&amp;ae=admin_general_help_end',
      'options' => array($lang_common['no'],
                         $lang_common['yes'].': '.$lang_admin_php['debug_everyone'],
                         $lang_common['yes'].': '.$lang_admin_php['debug_admin']
                         ),
      'additional_description' => ' (' . $lang_admin_php['enable_help_description'] .')',
    ),
    'clickable_keyword_search' => array(
      'type' => 'radio',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_general_keywords_start&amp;ae=admin_general_keywords_end',
      'options' => array($lang_common['no'],
                         $lang_common['yes']
                         ),
      'end_description' => '&nbsp;&nbsp;(<a href="keywordmgr.php">'.$lang_admin_php['manage_keyword'].'</a>)',
    ),
    'enable_plugins' => array(
      'type' => 'radio',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_general_enable-plugins&amp;ae=admin_general_enable-plugins_end',
      'options' => array($lang_common['no'],
                         $lang_common['yes']
                         ),
      'end_description' => '&nbsp;&nbsp;(<a href="pluginmgr.php">'.$lang_admin_php['manage_plugins'].'</a>)',
    ),
    'ban_private_ip' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => ' f=configuration.htm&amp;as=admin_general_private-ip&amp;ae=admin_general_private-ip_end',
    ),
    'browse_batch_add' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_general_browsable_batch_add&amp;ae=admin_general_browsable_batch_add_end',
    ),
    'display_thumbs_batch_add' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_general_display_thumbs_batch_add&amp;ae=admin_general_display_thumbs_batch_add_end',
    ),
  ),
  'language_charset_settings' => array(
    'lang' => array(
      'type' => 'select',
      'default_value' => 'english',
      'help_link' => 'f=configuration.htm&amp;as=admin_language_language&amp;ae=admin_language_language_end',
      'options' => form_get_foldercontent('lang/','file', 'php')
    ),
    'language_fallback' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_language_fallback&amp;ae=admin_language_fallback_end',
    ),
    'charset' => array(
      'type' => 'select',
      'default_value' => 'utf-8',
      'help_link' => 'f=configuration.htm&amp;as=admin_language_charset&amp;ae=admin_language_charset_end',
      'options' => array( 'Default (not recommended)' => 'language file',
                          'Arabic' => 'iso-8859-6',
                          'Baltic' => 'iso-8859-4',
                          'Central European' => 'iso-8859-2',
                          'Chinese Simplified' => 'euc-cn',
                          'Chinese Traditional' => 'big5',
                          'Cyrillic' => 'koi8-r',
                          'Greek' => 'iso-8859-7',
                          'Hebrew' => 'iso-8859-8-i',
                          'Icelandic' => 'x-mac-icelandic',
                          'Japanese' => 'euc-jp',
                          'Korean' => 'euc-kr',
                          'Maltese' => 'iso-8859-3',
                          'Thai' => 'windows-874 ',
                          'Turkish' => 'iso-8859-9',
                          'Unicode (utf-8)' => 'utf-8',
                          'Vietnamese' => 'windows-1258',
                          'Western' => 'iso-8859-1'),
       'additional_description' => ' (Unicode '.$lang_admin_php['recommended'].'!)',
       'end_description' => '<br />'.$lang_admin_php['do_not_change']
    ),
    'language_list' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_language_list&amp;ae=admin_language_list_end',
    ),
    'language_flags' => array(
      'type' => 'radio',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_language_flags&amp;ae=admin_language_flags_end&amp;top=1',
      'options' => array($lang_common['no'], $lang_common['yes'].': '.$lang_admin_php['item'], $lang_common['yes'].': '.$lang_admin_php['label'])
    ),
    'language_reset' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_language_reset&amp;ae=admin_language_reset_end&amp;top=1',
    ),
  ),
  'themes_settings' => array(
    'theme' => array(
      'type' => 'select',
      'help_link' => 'f=configuration.htm&amp;as=admin_theme_theme&amp;ae=admin_theme_theme_end',
      'options' => form_get_foldercontent('themes/','folder', '',array('sample', '.svn'))
    ),
    'theme_list' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_theme_theme_list&amp;ae=admin_theme_theme_list_end',
    ),
    'theme_reset' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_theme_theme_reset&amp;ae=admin_theme_theme_reset_end',
    ),
    'display_faq' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_theme_faq&amp;ae=admin_theme_faq_end',
    ),
    'display_sidebar_user' => array(
      'type' => 'radio',
      'default_value' => '2',
      'help_link' => 'f=configuration.htm&amp;as=admin_sidebar&amp;ae=admin_sidebar_end',
      'options' => array($lang_common['no'], $lang_common['yes'].': '.$lang_admin_php['allow_no_link'], $lang_common['yes'].': '.$lang_admin_php['allow_show_link']),
      'linebreak' => '<br />',
    ),
    'display_sidebar_guest' => array(
      'type' => 'radio',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_sidebar&amp;ae=admin_sidebar_end',
      'options' => array($lang_common['no'], $lang_common['yes'].': '.$lang_admin_php['allow_no_link'], $lang_common['yes'].': '.$lang_admin_php['allow_show_link']),
      'linebreak' => '<br />',
    ),
    'custom_lnk_name' => array(
      'type' => 'textfield',
      'help_link' => 'f=configuration.htm&amp;as=admin_theme_custom_lnk_name&amp;ae=admin_theme_custom_lnk_name_end',
    ),
    'custom_lnk_url' => array(
      'type' => 'textfield',
      'help_link' => 'f=configuration.htm&amp;as=admin_language_custom_lnk_url&amp;ae=admin_language_custom_lnk_url_end',
    ),
    'show_bbcode_help' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_theme_bbcode&amp;ae=admin_theme_bbcode_end&amp;top=1',
    ),
    'vanity_block' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=vanity_block&amp;ae=vanity_block_end',
    ),
    'display_social_bookmarks' => array(
      'type' => 'select_multiple',
      'help_link' => 'f=configuration.htm&amp;as=admin_social_bookmarks&amp;ae=admin_social_bookmarks_end',
      'options' => array('Digg.com', 'del.icio.us', 'Yahoo MyWeb', 'Technorati', 'Spurl', 'Furl', 'Blinklist', 'Fark', 'Blogmarks', 'Simpy', 'Reddit', 'StumbleUpon', 'Slashdot', 'Netscape', 'diigo', 'NewsVine', 'ma.gnolia', 'Google', 'Mister-Wong.de', 'Linkarena', 'Newskick.de', 'Weblinkr.com', 'Alltagz.de', 'Webbrille.de', 'Newstube.de', 'Webnews.de', 'Readster.de', 'oneview.de', 'Maodi.de', 'tausendreporter.stern.de', 'Linksilo.de'),
      'end_description' => '('.$lang_admin_php['highlight_multiple'].')',
    ),
    'custom_header_path' => array(
      'type' => 'textfield',
      'help_link' => 'f=configuration.htm&amp;as=admin_theme_include_path_start&amp;ae=admin_theme_include_path_end',
    ),
    'custom_footer_path' => array(
      'type' => 'textfield',
      'help_link' => 'f=configuration.htm&amp;as=admin_theme_include_path_start&amp;ae=admin_theme_include_path_end',
    ),
    'browse_by_date' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_theme_browse_by_date&amp;ae=admin_theme_browse_by_date_end',
    ),
    'display_redirection_page' => array(
      'type' => 'radio',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_theme_display_redirection_page&amp;ae=admin_theme_display_redirection_page_end',
      'options' => array($lang_common['no'], $lang_common['yes']),
      'end_description' => '('.$lang_admin_php['recommended'].': '.$lang_common['no'].')'
    ),
  ),
  'album_list_view' => array(
    'main_table_width' => array(
      'type' => 'textfield',
      'default_value' => '100%',
      'help_link' => 'f=configuration.htm&amp;as=admin_album_table-width&amp;ae=admin_album_table-width_end',
      'regex' => '^([0-9]{1,3}){1}([%]{0,1})$',
      'size' => '5',
      'width' => '5',
      'end_description' => $lang_admin_php['pixels_or_percent'],
    ),
    'subcat_level' => array(
      'type' => 'textfield',
      'default_value' => '2',
      'help_link' => 'f=configuration.htm&amp;as=admin_album_category-levels&amp;ae=admin_album_category-levels_end',
      'regex' => '^[0-9]{1,2}$',
      'size' => '3',
      'width' => '3',
    ),
    'albums_per_page' => array(
      'type' => 'textfield',
      'default_value' => '12',
      'help_link' => 'f=configuration.htm&amp;as=admin_album_number&amp;ae=admin_album_number_end',
      'regex' => '^[0-9]{1,3}$',
      'size' => '3',
      'width' => '3',
    ),
    'album_list_cols' => array(
      'type' => 'textfield',
      'default_value' => '2',
      'help_link' => 'f=configuration.htm&amp;as=admin_album_columns&amp;ae=admin_album_columns_end',
      'regex' => '^[0-9]{1,2}$',
      'size' => '3',
      'width' => '3',
    ),
    'alb_list_thumb_size' => array(
      'type' => 'textfield',
      'default_value' => '50',
      'help_link' => 'f=configuration.htm&amp;as=admin_album_thumbnail-size&amp;ae=admin_album_thumbnail-size_end',
      'regex' => '^[0-9]{1,4}$',
      'size' => '4',
      'width' => '4',
    ),
    'main_page_layout' => array(
      'type' => 'textfield',
      'default_value' => 'breadcrumb/catlist/alblist/random,2/lastup,2',
      'help_link' => 'f=configuration.htm&amp;as=admin_album_list_content&amp;ae=admin_album_list_content_end',
      'regex' => '^'
                .'('
                .'([0-9a-z]){1,}'
                .'(' // start of optional number that must be separated with a coma
                .'([,]){0,1}' // coma-separator
                .'([0-9]){1,2}' // numerical expression
                .'){0,1}'  // end of optional number that must be separated with a coma
                .'){1,1}' // alphanumerical string without special chars
                .'('
                .'(/){1,1}'
                .'('
                .'[0-9a-z]{1,}'
                .'(' // start of optional number that must be separated with a coma
                .'([,]){0,1}' // coma-separator
                .'([0-9]){1,2}' // numerical expression
                .'){0,1}'  // end of optional number that must be separated with a coma
                .')'
                .'){1,}'
                .'$',
    ),
    'first_level' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_album_first-level_thumbs&amp;ae=admin_album_first-level_thumbs_end',
    ),
    'categories_alpha_sort' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_album_list_alphasort_start&amp;ae=admin_album_list_alphasort_end',
      'additional_description' => $lang_admin_php['categories_alpha_sort_details'],
    ),
    'link_pic_count' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_album_linked_files_start&amp;ae=admin_album_linked_files_end',
    ),
  ),
  'thumbnail_view' => array(
    'thumbcols' => array(
      'type' => 'textfield',
      'default_value' => '4',
      'help_link' => 'f=configuration.htm&amp;as=admin_thumbnail_columns&amp;ae=admin_thumbnail_columns_end',
      'regex' => '^[0-9]$',
      'size' => '3',
      'width' => '3',
    ),
    'thumbrows' => array(
      'type' => 'textfield',
      'default_value' => '3',
      'help_link' => 'f=configuration.htm&amp;as=admin_thumbnail_rows&amp;ae=admin_thumbnail_rows_end',
      'regex' => '^[0-9]$',
      'size' => '3',
      'width' => '3',
    ),
    'max_tabs' => array(
      'type' => 'select',
      'default_value' => '12',
      'help_link' => 'f=configuration.htm&amp;as=admin_thumbnail_tabs&amp;ae=admin_thumbnail_tabs_end',
      'options' => array(5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25)
    ),
    'caption_in_thumbview' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_thumbnail_display_caption&amp;ae=admin_thumbnail_display_caption_end',
    ),
    'views_in_thumbview' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_thumbnail_display_views&amp;ae=admin_thumbnail_display_views_end',
    ),
    'display_comment_count' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_thumbnail_display_comments&amp;ae=admin_thumbnail_display_comments_end',
    ),
    'display_uploader' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_thumbnail_display_uploader&amp;ae=admin_thumbnail_display_uploader_end',
    ),
    'display_admin_uploader' => array(
      'type' => 'hidden',
      'help_link' => 'f=configuration.htm&amp;as=admin_thumbnail_display_admin_uploader&amp;ae=admin_thumbnail_display_admin_uploader_end',
    ),
    'display_filename' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_thumbnail_display_filename&amp;ae=admin_thumbnail_display_filename_end',
    ),
    'display_thumbnail_rating' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_thumbnail_display_rating&amp;ae=admin_thumbnail_display_rating_end',
    ),
    'alb_desc_thumb' => array(
      'type' => 'hidden', // not implemented yet
      'help_link' => 'f=configuration.htm&amp;as=admin_thumbnail_display_description&amp;ae=admin_thumbnail_display_description_end',
    ),
    'thumbnail_to_fullsize' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_thumbnail_to_fullsize&amp;ae=admin_thumbnail_to_fullsize_end',
    ),
    'default_sort_order' => array(
      'type' => 'select',
      'default_value' => 'na',
      'help_link' => 'f=configuration.htm&amp;as=admin_thumbnail_default_sortorder&amp;ae=admin_thumbnail_default_sortorder_end',
      'options' => array($lang_admin_php['title_a'] => 'ta',
                         $lang_admin_php['title_d'] => 'td',
                         $lang_admin_php['name_a'] => 'na',
                         $lang_admin_php['name_d'] => 'nd',
                         $lang_admin_php['date_a'] => 'da',
                         $lang_admin_php['date_d'] => 'dd',
                         $lang_admin_php['pos_a'] => 'pa',
                         $lang_admin_php['pos_d'] => 'pd',
                         )
    ),
    'min_votes_for_rating' => array(
      'type' => 'textfield',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_thumbnail_minimum_votes&amp;ae=admin_thumbnail_minimum_votes_end',
      'regex' => '^[0-9]$',
      'size' => '3',
      'width' => '3',
    ),
  ),
  'image_view' => array(
    'picture_table_width' => array(
      'type' => 'textfield',
      'default_value' => '100%',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_comment_table-width&amp;ae=admin_image_comment_table-width_end',
      'size' => '5',
      'width' => '5',
      'end_description' => $lang_admin_php['pixels_or_percent'],
    ),
    'display_pic_info' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_comment_info_visible&amp;ae=admin_image_comment_info_visible_end',
    ),
    'picinfo_movie_download_link' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_movie_download_link_visible&amp;ae=admin_image_movie_download_link_visible_end',
    ),
    'max_img_desc_length' => array(
      'type' => 'textfield',
      'default_value' => '512',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_comment_descr_length&amp;ae=admin_image_comment_descr_length_end',
      'regex' => '^[0-9]{1,4}$',
      'size' => '5',
      'width' => '5',
    ),
    'display_film_strip' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_comment_filmstrip_toggle&amp;ae=admin_image_comment_filmstrip_toggle_end',
    ),
    'display_film_strip_filename' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_comment_display_film_strip_filename&amp;ae=admin_image_comment_display_film_strip_filename_end',
    ),
    'max_film_strip_items' => array(
      'type' => 'textfield',
      'default_value' => '5',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_comment_filmstrip_number&amp;ae=admin_image_comment_filmstrip_number_end',
      'regex' => '^[0-9]{1,2}$',
      'size' => '3',
      'width' => '3',
    ),
    'slideshow_interval' => array(
      'type' => 'textfield',
      'default_value' => '5000',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_comment_slideshow_interval&amp;ae=admin_image_comment_slideshow_interval_end',
      'regex' => '^[0-9]{1,6}$',
      'size' => '6',
      'width' => '6',
      'end_description' => $lang_admin_php['slideshow_interval_detail'],
    ),
    'slideshow_hits' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_slideshow_hits&amp;ae=admin_image_slideshow_hits_end',
    ),
    'ecard_flash' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_ecard_flash_start&amp;ae=admin_image_ecard_flash_end',
      'end_description' => '('.$lang_admin_php['not_recommended'].')',
    ),
    'transparent_overlay' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_transparent_overlay_start&amp;ae=admin_image_transparent_overlay_end',
    ),
	'old_style_rating' => array(
	  'type' => 'checkbox',
      'default_value' => '0',
	  'help_link' => 'f=configuration.htm&amp;as=admin_image_old_style_rating_start&amp;ae=admin_image_old_style_rating_end',
	  'end_description' => '('.$lang_admin_php['old_style_rating_extra'].')',
	),
	'rating_stars_amount' => array(
      'type' => 'textfield',
      'default_value' => '5',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_rating_stars_amount_start&amp;ae=admin_image_rating_stars_amount_end',
      'regex' => '^[0-9]{0,2}',
      'size' => '3',
      'width' => '3',
	  'maxlength' => '2',
	  'default_value' => '5',
    ),
  ),
  'comment_settings' => array(
    'filter_bad_words' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_comment_bad_words&amp;ae=admin_image_comment_bad_words_end',
    ),
    'enable_smilies' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_comment_smilies&amp;ae=admin_image_comment_smilies_end',
    ),
    'disable_comment_flood_protect' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_comment_flood&amp;ae=admin_image_comment_flood_end',
      'additional_description' => $lang_admin_php['disable_comment_flood_protect_details'],
    ),
    'max_com_lines' => array(
      'type' => 'textfield',
      'default_value' => '10',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_comment_lines&amp;ae=admin_image_comment_lines_end',
      'regex' => '^[0-9]{1,3}$',
      'size' => '3',
      'width' => '3',
    ),
    'max_com_size' => array(
      'type' => 'textfield',
      'default_value' => '512',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_comment_length&amp;ae=admin_image_comment_length_end',
      'regex' => '^[0-9]{1,5}$',
      'size' => '5',
      'width' => '5',
    ),
    'max_com_wlength' => array(
      'type' => 'textfield',
      'default_value' => '38',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_comment_chars_per_word&amp;ae=admin_image_comment_chars_per_word_end',
      'regex' => '^[0-9]{1,4}$',
      'size' => '5',
      'width' => '5',
    ),
    'email_comment_notification' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_image_comment_admin_notify&amp;ae=admin_image_comment_admin_notify_end',
    ),
    'comments_sort_descending' => array(
      'type' => 'radio',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_comment_sort_start&amp;ae=admin_comment_sort_end',
      'options' => array($lang_admin_php['ascending'], $lang_admin_php['descending'])
    ),
    'comments_anon_pfx' => array(
      'type' => 'textfield',
      'help_link' => 'f=configuration.htm&amp;as=comments_anon_pfx&amp;ae=comments_anon_pfx_end',
    ),
    'comment_approval' => array(
      'type' => 'radio',
      'help_link' => 'f=configuration.htm&amp;as=admin_comment_approval&amp;ae=admin_comment_approval_end',
      'options' => array($lang_common['no'],
                         $lang_common['yes'].': '.$lang_admin_php['debug_everyone'],
                         $lang_common['yes'].': '.$lang_admin_php['guests_only']
                         )
    ),
    'display_comment_approval_only' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_comment_display_comment_approval_only_start&amp;ae=admin_comment_display_comment_approval_only_end',
    ),
    'comment_placeholder' => array(
      'type' => 'checkbox',
      'default_value' => 'Guest_',
      'help_link' => 'f=configuration.htm&amp;as=admin_comment_display_placeholder_start&amp;ae=admin_comment_display_placeholder_end',
    ),
    'comment_user_edit' => array(
      'type' => 'checkbox',
      'help_link' => 'f=configuration.htm&amp;as=admin_comment_user_edit_start&amp;ae=admin_comment_user_edit_end',
    ),
    'comment_captcha' => array(
      'type' => 'radio',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_comment_captcha_start&amp;ae=admin_comment_captcha_end',
      'options' => array($lang_common['no'],
                         $lang_common['yes'].': '.$lang_admin_php['debug_everyone'],
                         $lang_common['yes'].': '.$lang_admin_php['guests_only']
                         )
    ),
    'comment_promote_registration' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_comment_promote_registration_start&amp;ae=admin_comment_promote_registration_end',
    ),
  ),
  'contact_form_settings' => array(
    'contact_form_guest_enable' => array(
      'type' => 'radio',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_contact_guest_enable&amp;ae=admin_contact_guest_enable_end',
      'options' => array($lang_common['no'],
                         $lang_common['yes'].' ('.$lang_admin_php['with_captcha'].')',
                         $lang_common['yes'].' ('.$lang_admin_php['without_captcha'].')'
                         )
    ),
    'contact_form_guest_name_field' => array(
      'type' => 'radio',
      'default_value' => '2',
      'help_link' => 'f=configuration.htm&amp;as=admin_contact_guest_name_field&amp;ae=admin_contact_guest_name_field_end',
      'options' => array($lang_common['no'],
                         $lang_common['yes'].' ('.$lang_admin_php['optional'].')',
                         $lang_common['yes'].' ('.$lang_admin_php['mandatory'].')'
                         )
    ),
    'contact_form_guest_email_field' => array(
      'type' => 'radio',
      'default_value' => '2',
      'help_link' => 'f=configuration.htm&amp;as=admin_contact_guest_email_field&amp;ae=admin_contact_guest_email_field_end',
      'options' => array($lang_common['no'],
                         $lang_common['yes'].' ('.$lang_admin_php['optional'].')',
                         $lang_common['yes'].' ('.$lang_admin_php['mandatory'].')'
                         )
    ),
    'contact_form_registered_enable' => array(
      'type' => 'radio',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_contact_registered_enable&amp;ae=admin_contact_registered_enable_end',
      'options' => array($lang_common['no'],
                         $lang_common['yes'].' ('.$lang_admin_php['with_captcha'].')',
                         $lang_common['yes'].' ('.$lang_admin_php['without_captcha'].')'
                         )
    ),
    'contact_form_subject_content' => array(
      'type' => 'textfield',
      'default_value' => 'Coppermine gallery contact form',
      'help_link' => 'f=configuration.htm&amp;as=admin_contact_subject_content&amp;ae=admin_contact_subject_content_end',
      'size' => '100%',
      'width' => '200',
    ),
    'contact_form_subject_field' => array(
      'type' => 'radio',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_contact_subject_field&amp;ae=admin_contact_subject_field_end',
      'options' => array($lang_common['no'],
                         $lang_common['yes'].' ('.$lang_admin_php['optional'].')',
                         $lang_common['yes'].' ('.$lang_admin_php['mandatory'].')'
                         )
    ),
    'contact_form_sender_email' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_contact_sender_email&amp;ae=admin_contact_sender_email_end',
    ),
  ),
  'thumbnail_settings' => array(
    'thumb_width' => array(
      'type' => 'textfield',
      'default_value' => '100',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumbnail_max-dimension&amp;ae=admin_picture_thumbnail_max-dimension_end',
      'regex' => '^[0-9]{1,5}$',
      'size' => '5',
      'width' => '5',
      'warning' => $lang_admin_php['warning_change'],
    ),
    'thumb_use' => array(
      'type' => 'select',
      'default_value' => 'any',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumbnail_use-dimension&amp;ae=admin_picture_thumbnail_use-dimension_end',
      'options' => array($lang_admin_php['th_any'] => 'any',
                         $lang_admin_php['th_ht'] => 'ht',
                         $lang_admin_php['th_wd'] => 'wd',
                         $lang_admin_php['th_ex'] => 'ex',
                         ),
      'additional_description' => $lang_admin_php['thumb_use_detail'],
      'warning' => $lang_admin_php['warning_change'],
    ),
    'thumb_height' => array(
      'type' => 'textfield',
      'default_value' => '100',
      'help_link' => '',
      'regex' => '^[0-9]{1,5}$',
      'size' => '5',
      'width' => '5',
      'additional_description' => $lang_admin_php['thumb_height_detail'],
      'warning' => $lang_admin_php['warning_change'],
    ),
    'enable_custom_thumbs' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'default_value' => '1',
      'help_link' => '',
      'additional_description' => '('.$lang_admin_php['movie_audio_document'].')',
    ),
    'thumb_pfx' => array(
      'type' => 'textfield',
      'default_value' => 'thumb_',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_thumbs_prefix&amp;ae=admin_picture_thumb_advanced_thumbs_prefix_end',
      'warning' => $lang_admin_php['warning_change'],
    ),
    'enable_unsharp' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => '',
    ),
    'unsharp_amount' => array(
      'type' => 'textfield',
      'default_value' => '120',
      'help_link' => '',
      'regex' => '^[0-9]{1,5}$',
      'size' => '5',
      'width' => '5',
    ),
    'unsharp_radius' => array(
      'type' => 'textfield',
      'default_value' => '0.5',
      'help_link' => '',
      'regex' => '^[0-9]{1,1}([.]+([0-9]){0,1}){0,1}$',
      'size' => '5',
      'width' => '5',
    ),
    'unsharp_threshold' => array(
      'type' => 'textfield',
      'default_value' => '3',
      'help_link' => '',
      'regex' => '^[0-9]{1,5}$',
      'size' => '5',
      'width' => '5',
    ),
  ),
  'file_settings' => array(
    'jpeg_qual' => array(
      'type' => 'textfield',
      'default_value' => '80',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumbnail_jpeg_quality&amp;ae=admin_picture_thumbnail_jpeg_quality_end',
      'regex' => '^[0-9]{1,3}$',
      'size' => '3',
      'width' => '3',
    ),
    'make_intermediate' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumbnail_intermediate_toggle&amp;ae=admin_picture_thumbnail_intermediate_toggle_end',
    ),
    'picture_width' => array(
      'type' => 'textfield',
      'default_value' => '400',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumbnail_intermediate_dimension&amp;ae=admin_picture_thumbnail_intermediate_dimension_end',
      'regex' => '^[0-9]{1,5}$',
      'size' => '5',
      'width' => '5',
      'warning' => $lang_admin_php['warning_change'],
    ),
    'max_upl_size' => array(
      'type' => 'textfield',
      'default_value' => '1024',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumbnail_max_upload_size&amp;ae=admin_picture_thumbnail_max_upload_size_end',
      'regex' => '^[0-9]{1,7}$',
      'size' => '7',
      'width' => '7',
      'end_description' => $lang_admin_php['kilobytes'],
    ),
    'max_upl_width_height' => array(
      'type' => 'textfield',
      'default_value' => '2048',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumbnail_max_upload_dimension&amp;ae=admin_picture_thumbnail_max_upload_dimension_end',
      'regex' => '^[0-9]{1,5}$',
      'size' => '5',
      'width' => '5',
      'end_description' => $lang_admin_php['pixels'],
    ),
    'auto_resize' => array(
      'type' => 'radio',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumbnail_auto-resize&amp;ae=admin_picture_thumbnail_auto-resize_end',
      'options' => array($lang_common['no'],
                         $lang_common['yes'].': '.$lang_admin_php['auto_resize_everyone'],
                         $lang_common['yes'].': '.$lang_admin_php['auto_resize_user']
                         )
    ),
    'fullsize_padding_x' => array(
      'type' => 'textfield',
      'default_value' => '5',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumbnail_fullsize_padding_x&amp;ae=admin_picture_thumbnail_fullsize_padding_x_end',
      'regex' => '^[0-9]{1,3}$',
      'size' => '3',
      'width' => '3',
    ),
    'fullsize_padding_y' => array(
      'type' => 'textfield',
      'default_value' => '3',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumbnail_fullsize_padding_y&amp;ae=admin_picture_thumbnail_fullsize_padding_y_end',
      'regex' => '^[0-9]{1,3}$',
      'size' => '3',
      'width' => '3',
    ),
    'allow_private_albums' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_private_toggle&amp;ae=admin_picture_thumb_advanced_private_toggle_end',
      'additional_description' => $lang_admin_php['allow_private_albums_note'],
      'end_description' => '('.$lang_admin_php['recommended'].')',
    ),
    'show_private' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_private_icon_show&amp;ae=admin_picture_thumb_advanced_private_icon_show_end',
    ),
    'forbiden_fname_char' => array(
      'type' => 'textfield',
      'default_value' => '$/\\\\:*?&quot;\'&lt;&gt;|` &amp;#@',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_filename_forbidden_chars&amp;ae=admin_picture_thumb_advanced_filename_forbidden_chars_end',
    ),
    'silly_safe_mode' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_silly_safe_mode_start&amp;ae=admin_picture_thumb_advanced_silly_safe_mode_end',
    ),
    'allowed_file_extensions' => array(
      'type' => 'hidden',
      'help_link' => 'f=configuration.htm&amp;as=&amp;ae=_end',
    ),
    'allowed_img_types' => array(
      'type' => 'textfield',
      'default_value' => 'jpeg/jpg/png/gif',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_pic_extensions&amp;ae=admin_picture_thumb_advanced_pic_extensions_end',
      'regex' => '^(([a-z0-9]{1,}){1}([/]{1,1})){0,}([a-z0-9]{1,}){1}$',
      'regex_not' => '^ALL$',
    ),
    'allowed_mov_types' => array(
      'type' => 'textfield',
      'default_value' => 'asf/asx/mpg/mpeg/wmv/swf/avi/mov',
      'help_link' => 'f=configuration.htm&amp;as=admin_thumbs_advanced_movie&amp;ae=admin_thumbs_advanced_movie_end',
      'regex' => '^(([a-z0-9]{1,}){1}([/]{1,1})){0,}([a-z0-9]{1,}){1}$',
      'regex_not' => '^ALL$',
    ),
    'media_autostart' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_movie_autoplay&amp;ae=admin_movie_autoplay_end',
    ),
    'allowed_snd_types' => array(
      'type' => 'textfield',
      'default_value' => 'mp3/midi/mid/wma/wav/ogg',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_audio_extensions&amp;ae=admin_picture_thumb_advanced_audio_extensions_end',
      'regex' => '^(([a-z0-9]{1,}){1}([/]{1,1})){0,}([a-z0-9]{1,}){1}$',
      'regex_not' => '^ALL$',
    ),
    'allowed_doc_types' => array(
      'type' => 'textfield',
      'default_value' => 'doc/txt/rtf/pdf/xls/pps/ppt/zip/gz/mdb',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_doc_extensions&amp;ae=admin_picture_thumb_advanced_doc_extensions_end',
      'regex' => '^(([a-z0-9]{1,}){1}([/]{1,1})){0,}([a-z0-9]{1,}){1}$',
      'regex_not' => '^ALL$',
    ),
    'thumb_method' => array(
      'type' => 'select',
      'default_value' => '2',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_resize_method&amp;ae=admin_picture_thumb_advanced_resize_method_end',
      'options' => array('Image Magick' => 'im',
                         'GD version 1.x' => 'gd1',
                         'GD version 2.x' => 'gd2'
                         )
    ),
    'impath' => array(
      'type' => 'textfield',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_im_path&amp;ae=admin_picture_thumb_advanced_im_path_end',
    ),
    'im_options' => array(
      'type' => 'textfield',
      'default_value' => '-antialias',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_im_commandline&amp;ae=admin_picture_thumb_advanced_im_commandline_end',
    ),
    'read_exif_data' => array(
      'type' => 'radio',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_exif&amp;ae=admin_picture_thumb_advanced_exif_end',
      'options' => array($lang_common['no'],
                         $lang_common['yes']
                         ),
      'end_description' => '&nbsp;&nbsp;(<a href="exifmgr.php">'.$lang_admin_php['manage_exif'].'</a>)',
    ),
    'read_iptc_data' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_iptc&amp;ae=admin_picture_thumb_advanced_iptc_end',
    ),
    'fullpath' => array(
      'type' => 'textfield',
      'default_value' => 'albums/',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_albums_dir&amp;ae=admin_picture_thumb_advanced_albums_dir_end',
      'warning' => $lang_admin_php['warning_exist'],
      'additional_description' => '<br />('.$lang_admin_php['warning_exist'].')',
    ),
    'userpics' => array(
      'type' => 'textfield',
      'default_value' => 'userpics/',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_userpics_dir&amp;ae=admin_picture_thumb_advanced_userpics_dir_end',
      'warning' => $lang_admin_php['warning_exist'],
      'additional_description' => '<br />('.$lang_admin_php['warning_exist'].')',
    ),
    'normal_pfx' => array(
      'type' => 'textfield',
      'default_value' => 'normal_',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_intermediate_prefix&amp;ae=admin_picture_thumb_advanced_intermediate_prefix_end',
      'warning' => $lang_admin_php['warning_exist'],
      'additional_description' => '<br />('.$lang_admin_php['warning_exist'].')',
    ),
    'default_dir_mode' => array(
      'type' => 'textfield',
      'default_value' => '0755',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_chmod_folder&amp;ae=admin_picture_thumb_advanced_chmod_folder_end',
      'regex' => '^[0-9]{0,4}$',
      'size' => '4',
      'width' => '4',
    ),
    'default_file_mode' => array(
      'type' => 'textfield',
      'default_value' => '0644',
      'help_link' => 'f=configuration.htm&amp;as=admin_picture_thumb_advanced_chmod_files&amp;ae=admin_picture_thumb_advanced_chmod_files_end',
      'regex' => '^[0-9]{0,4}$',
      'size' => '4',
      'width' => '4',
    ),
  ),
  'image_watermarking' => array(
    'enable_watermark' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_watermarking_enable&amp;ae=admin_watermarking_enable_end',
    ),
    'enable_thumb_watermark' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_watermarking_custom_thumb&amp;ae=admin_watermarking_custom_thumb_end',
      'additional_description' => '('.$lang_admin_php['movie_audio_document'].')',
    ),
    'where_put_watermark' => array(
      'type' => 'select',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_watermarking_orientation&amp;ae=admin_watermarking_orientation_end',
      'options' => array($lang_admin_php['wm_bottomright'] => 'southeast',
                         $lang_admin_php['wm_bottomleft'] => 'southwest',
                         $lang_admin_php['wm_topleft'] => 'northwest',
                         $lang_admin_php['wm_topright'] => 'northeast',
                         $lang_admin_php['wm_center'] => 'center',
                         )
    ),
    'which_files_to_watermark' => array(
      'type' => 'select',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_watermarking_filetype&amp;ae=admin_watermarking_filetype_end',
      'options' => array($lang_admin_php['wm_both'] => 'both',
                         $lang_admin_php['wm_original'] => 'original',
                         $lang_admin_php['wm_resized'] => 'resized',
                         )
    ),
    'watermark_file' => array(
      'type' => 'textfield',
      'default_value' => 'images/watermark.png',
      'help_link' => 'f=configuration.htm&amp;as=admin_watermarking_filepath&amp;ae=admin_watermarking_filepath_end',
    ),
    'watermark_transparency' => array(
      'type' => 'textfield',
      'default_value' => '40',
      'help_link' => 'f=configuration.htm&amp;as=admin_watermarking_transparency&amp;ae=admin_watermarking_transparency_end',
      'regex' => '^[0-9]{0,3}$',
      'size' => '3',
      'width' => '3',
      'end_description' => '('.$lang_admin_php['zero_2_hundred'].')',
    ),
    'reduce_watermark' => array(
      'type' => 'textfield',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_watermarking_downsize&amp;ae=admin_watermarking_downsize_end',
    ),
    'watermark_transparency_featherx' => array(
      'type' => 'textfield',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_watermarking_transparent_x&amp;ae=admin_watermarking_transparent_x_end',
      'regex' => '^[0-9]{0,6}$',
      'size' => '6',
      'width' => '6',
      'additional_description' => '('.$lang_admin_php['gd2_only'].')',
    ),
    'watermark_transparency_feathery' => array(
      'type' => 'textfield',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_watermarking_transparent_y&amp;ae=admin_watermarking_transparent_y_end',
      'regex' => '^[0-9]{0,6}$',
      'size' => '6',
      'width' => '6',
      'additional_description' => '('.$lang_admin_php['gd2_only'].')',
    ),
  ),
  'registration' => array(
    'allow_user_registration' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_allow_registration&amp;ae=admin_allow_registration_end',
    ),
    'global_registration_pw' => array(
      'type' => 'textfield',
      'bridged' => 'hide',
      'help_link' => 'f=configuration.htm&amp;as=admin_global_registration_pw&amp;ae=admin_global_registration_pw_end',
    ),
    'user_registration_disclaimer' => array(
      'type' => 'radio',
      'default_value' => '1',
      'bridged' => 'hide',
      'help_link' => 'f=configuration.htm&amp;as=admin_user_registration_disclaimer&amp;ae=admin_user_registration_disclaimer_end',
      'options' => array($lang_common['no'],
                         $lang_common['yes'].': '.$lang_admin_php['separate_page'],
                         $lang_common['yes'].': '.$lang_admin_php['inline']
                         )
    ),
    'registration_captcha' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'bridged' => 'hide',
      'help_link' => 'f=configuration.htm&amp;as=admin_registration_captcha_start&amp;ae=admin_registration_captcha_end',
    ),
    'reg_requires_valid_email' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'bridged' => 'hide',
      'help_link' => 'f=configuration.htm&amp;as=admin_registration_verify&amp;ae=admin_registration_verify_end',
    ),
    'reg_notify_admin_email' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'bridged' => 'hide',
      'help_link' => 'f=configuration.htm&amp;as=admin_registration_notify&amp;ae=admin_registration_notify_end',
    ),
    'admin_activation' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'bridged' => 'hide',
      'help_link' => 'f=configuration.htm&amp;as=admin_activation&amp;ae=admin_activation_end',
    ),
    'personal_album_on_registration' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'bridged' => 'hide',
      'help_link' => 'f=configuration.htm&amp;as=admin_personal_album_on_registration&amp;ae=admin_personal_album_on_registration_end',
      'end_description' => '('.$lang_admin_php['not_recommended'].')',
    ),
  ),
  'user_settings' => array(
    'allow_unlogged_access' => array(
      'type' => 'radio',
      'default_value' => '3',
      'help_link' => 'f=configuration.htm&amp;as=admin_allow_unlogged_access&amp;ae=admin_allow_unlogged_access_end',
      'options' => array($lang_common['no'],
                         $lang_common['yes'].': '.$lang_admin_php['thumbnail_only'],
                         $lang_common['yes'].': '.$lang_admin_php['thumbnail_intermediate'],
                         $lang_common['yes'].': '.$lang_admin_php['thumbnail_intermediate_full']
                         ),
      'linebreak' => '<br />'
    ),
    'allow_duplicate_emails_addr' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'bridged' => 'hide',
      'help_link' => 'f=configuration.htm&amp;as=admin_allow_duplicate_emails_addr&amp;ae=admin_allow_duplicate_emails_addr_end',
    ),
    'upl_notify_admin_email' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_approval_notify&amp;ae=admin_approval_notify_end',
    ),
    'allow_memberlist' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_user_memberlist&amp;ae=admin_user_memberlist_end',
    ),
    'allow_email_change' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'bridged' => 'hide',
      'help_link' => 'f=configuration.htm&amp;as=admin_user_allow_email_change&amp;ae=admin_user_allow_email_change_end',
    ),
    'allow_user_account_delete' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'bridged' => 'hide',
      'help_link' => 'f=configuration.htm&amp;as=admin_user_allow_account_delete&amp;ae=admin_user_allow_account_delete_end',
    ),
    'users_can_edit_pics' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_user_editpics_public_start&amp;ae=admin_user_editpics_public_end',
    ),
    'allow_user_move_album' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_user_allow_album_move&amp;ae=admin_user_allow_album_move_end',
    ),
    'allow_user_edit_after_cat_close' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_allow_user_edit_after_cat_close&amp;ae=admin_allow_user_edit_after_cat_close_end',
    ),
    'allow_user_album_keyword' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_allow_user_album_keyword&amp;ae=admin_allow_user_album_keyword_end',
    ),
	//login_method gives you the choice of logging in with username, email or both
	'login_method' => array(
      'type' => 'select',
	  'default_value' => 'username',
      'bridged' => 'hide',
      'help_link' => 'f=configuration.htm&amp;as=admin_user_login_start&amp;ae=admin_user_login_method_end',
      'options' => array(
	  		$lang_admin_php['login_method_username'] => 'username',
			$lang_admin_php['login_method_email'] => 'email',
			$lang_admin_php['login_method_both'] => 'both' 
	 		),
	),
    'login_threshold' => array(
      'type' => 'textfield',
      'default_value' => '5',
      'bridged' => 'hide',
      'help_link' => 'f=configuration.htm&amp;as=admin_user_login_threshold_start&amp;ae=admin_user_login_threshold_end',
      'regex' => '^[0-9]{1,4}$',
      'size' => '4',
      'width' => '4',
      'additional_description' => $lang_admin_php['login_threshold_detail'],
    ),
    'login_expiry' => array(
      'type' => 'textfield',
      'default_value' => '10',
      'bridged' => 'hide',
      'help_link' => 'f=configuration.htm&amp;as=admin_user_login_expiry_start&amp;ae=admin_user_login_expiry_end',
      'regex' => '^[0-9]{1,7}$',
      'size' => '7',
      'width' => '7',
    ),
    'report_post' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_user_enable_report&amp;ae=admin_user_enable_report_end',
    ),
  ),
  'custom_fields_user_profile' => array(
    'user_profile1_name' => array(
      'type' => 'textfield',
      'default_value' => 'Location',
      'bridged' => 'hide',
      'help_link' => 'f=configuration.htm&amp;as=admin_custom&amp;ae=admin_custom_end',
    ),
    'user_profile2_name' => array(
      'type' => 'textfield',
      'default_value' => 'Interests',
      'bridged' => 'hide',
      'help_link' => '',
    ),
    'user_profile3_name' => array(
      'type' => 'textfield',
      'default_value' => 'Website',
      'bridged' => 'hide',
      'help_link' => '',
    ),
    'user_profile4_name' => array(
      'type' => 'textfield',
      'default_value' => 'Occupation',
      'bridged' => 'hide',
      'help_link' => '',
    ),
    'user_profile5_name' => array(
      'type' => 'textfield',
      'bridged' => 'hide',
      'help_link' => '',
    ),
    'user_profile6_name' => array(
      'type' => 'textfield',
      'default_value' => 'Biography',
      'bridged' => 'hide',
      'help_link' => '',
    ),
  ),
  'custom_fields_image_description' => array(
    'user_field1_name' => array(
      'type' => 'textfield',
      'help_link' => 'f=configuration.htm&amp;as=admin_custom_image&amp;ae=admin_custom_image_end',
    ),
    'user_field2_name' => array(
      'type' => 'textfield',
      'help_link' => '',
    ),
    'user_field3_name' => array(
      'type' => 'textfield',
      'help_link' => '',
    ),
    'user_field4_name' => array(
      'type' => 'textfield',
      'help_link' => '',
    ),
  ),
  'cookie_settings' => array(
    'cookie_name' => array(
      'type' => 'textfield',
      'default_value' => 'cpg15x',
      'help_link' => 'f=configuration.htm&amp;as=admin_cookie_name&amp;ae=admin_cookie_name_end',
      'regex' => '^([a-z0-9_-]){1,}$',
    ),
    'cookie_path' => array(
      'type' => 'textfield',
      'default_value' => '/',
      'help_link' => 'f=configuration.htm&amp;as=admin_cookie_path&amp;ae=admin_cookie_path_end',
    ),
  ),
  'email_settings' => array(
    'smtp_host' => array(
      'type' => 'textfield',
      'help_link' => 'f=configuration.htm&amp;as=admin_email&amp;ae=admin_email_end',
    ),
    'smtp_username' => array(
      'type' => 'textfield',
      'help_link' => '',
    ),
    'smtp_password' => array(
      'type' => 'textfield',
      'help_link' => '',
    ),
  ),
  'logging_stats' => array(
    'log_mode' => array(
      'type' => 'radio',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_logging_log_mode&amp;ae=admin_logging_log_mode_end',
      'options' => array($lang_admin_php['no_logs'],
                         $lang_admin_php['log_normal'],
                         $lang_admin_php['log_all']
                         ),
      'end_description' => '&nbsp;&nbsp;(<a href="viewlog.php">'.$lang_admin_php['view_logs'].'</a>)',
      'additional_description' => '<br />('.$lang_admin_php['log_mode_details'].')',
    ),
    'log_ecards' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_general_log_ecards&amp;ae=admin_general_log_ecards_end',
      'additional_description' => '<br />('.$lang_admin_php['log_ecards_detail'].')',
    ),
    'vote_details' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_logging_votedetails&amp;ae=admin_logging_votedetails_end',
    ),
    'hit_details' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_logging_hitdetails&amp;ae=admin_logging_hitdetails_end',
    ),
    'display_stats_on_index' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_logging_display_stats_on_index&amp;ae=admin_logging_display_stats_on_index_end',
    ),
    'count_file_hits' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_count_file_hits&amp;ae=admin_count_file_hits_end',
    ),
    'count_album_hits' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_count_album_hits&amp;ae=admin_count_album_hits_end',
    ),
  ),
  'maintenance_settings' => array(
    'debug_mode' => array(
      'type' => 'radio',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=debug_mode&amp;ae=debug_mode_end',
      'options' => array($lang_common['no'],
                         $lang_common['yes'].': '.$lang_admin_php['debug_everyone'],
                         $lang_common['yes'].': '.$lang_admin_php['debug_admin']
                         )
    ),
    'debug_notice' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_misc_debug_notices&amp;ae=admin_misc_debug_notices_end',
    ),
    'offline' => array(
      'type' => 'checkbox',
      'default_value' => '0',
      'help_link' => 'f=configuration.htm&amp;as=admin_general_offline&amp;ae=admin_general_offline_end',
    ),
    'display_coppermine_news' => array(
      'type' => 'checkbox',
      'default_value' => '1',
      'help_link' => 'f=configuration.htm&amp;as=admin_general_coppermine_news&amp;ae=admin_general_coppermine_news_end',
      'end_description' => '('.$lang_admin_php['display_coppermine_detail'].')',
    ),
  ),
);




?>