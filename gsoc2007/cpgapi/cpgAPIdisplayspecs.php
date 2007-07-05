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
  var $userpersonalfields, $groupfields, $messagecode, $configfields;

  function initialize() {
    // Database connection settings

    $this->userpersonalfields = array(
       'username', 'user_id', 'email', 'regdate', 'lastvisit', 'active'
    );

    $this->groupfields = array(
       'groupname', 'group_id', 'admin'
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
      'forbiden_fname_char'
    );

    $this->messagecode = array(
       'success' => 0,
       'dbserver' => 1,
       'login_error' => 2,
       'unknown_query' => 3,
       'unknown_user' => 4,
       'no_perms' => 5,
       'install_error' => 6,
       'init_error' => 7,
       'user_error' => 8,
       'usergroup_error' => 9,
       'group_error' => 10
    );
  }
}
?>