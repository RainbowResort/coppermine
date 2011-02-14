<?php
/**************************************************
  Coppermine 1.5.x Plugin - forum
  *************************************************
  Copyright (c) 2010 foulu (Le Hoai Phuong), eenemeenemuu
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }
class profile_controller extends Controller {
    function profile_controller() {
        parent::Controller();
    }
    function index() {
        require_once('include'.DS.'smilies.inc.php');
        $vars = array();
        $errors = array();
        $authorizer = check_model::getInstance();
        // user or not
        if (!$authorizer->is_user()) {
            cpg_die(ERROR, Lang::item('error.perm_denied'), __FILE__, __LINE__);
        }
        // to-do: display the profile if + avatar
        $vars['nagavitor'] = $this->forum->get_nagavitor();
        $vars['user'] = $user = $this->forum->get_user_data();
        if ($this->validate->post->keyExists('submit')) {
            $data = array(
                'fr_signature' => $this->validate->post->getRaw('fr_signature'),
            );
            if (strlen($data['fr_signature']) > Config::item('fr_signature_max_size') && Config::item('fr_signature_max_size')) {
                $data['fr_signature'] = substr($data['fr_signature'], 0, Config::item('fr_signature_max_size'));
            }
            $avatar_type = $this->validate->post->getRaw('avatar_type');
            if ($avatar_type == 'url') {
                $data['fr_avatar'] = $this->validate->post->getRaw('fr_avatar_url');
                $files = explode('.', $data['fr_avatar']);
                if (!in_array($files[count($files)-1], array('gif','jpg','jpeg','png'))) {
                    $errors[] = Lang::item('error.wrong_avatar_extension');
                }
            } else if ($avatar_type == 'file') {
                $upload = load_library('upload', TRUE);
                $upload->upload_dir = 'plugins/forum/forum/uploads/avatars/';
                if (!is_dir($upload->upload_dir)) {
                    mkdir($upload->upload_dir, octdec(Config::item('default_dir_mode')));
                }
                $upload->extensions = array('.jpg','.jpeg','.gif','.png');
                $upload->max_length_filename = 255;
                $upload->rename_file = true;
                $upload->the_temp_file = $this->validate->files->getRaw('/fr_avatar_file/tmp_name');
                $upload->the_file = $this->validate->files->getRaw('/fr_avatar_file/name');
                $upload->http_error = $this->validate->files->getRaw('/fr_avatar_file/error');
                $upload->replace = 'y';
                $upload->do_filename_check = 'y';
                $new_name = 'avatar_'.USER_ID;
                if ($upload->do_upload($new_name)) {
                    $extension = strtolower(strrchr($upload->the_file,"."));
                    $data['fr_avatar'] = $upload->upload_dir.$new_name.$extension;
                } else {
                    $errors[] = $upload->show_error_string();
                }
                $imagesize = getimagesize($data['fr_avatar']);
                if (max($imagesize[0], $imagesize[1]) > Config::item('fr_avatar_size') && Config::item('fr_avatar_size')) {
                    if (!function_exists('resize_image')) {
                        require_once('include/picmgmt.inc.php');
                    }
                    resize_image($data['fr_avatar'], $data['fr_avatar'], Config::item('fr_avatar_size'), Config::item('thumb_method'), Config::item('thumb_use'));
                }
            } else {
                unset($data['fr_avatar']);
            }
            if (count($errors) == 0) {
                $this->forum->edit_profile($user['user_id'], $data);
                forum::message(Lang::item('common.message'), Lang::item('profile.update_profile_success'), 'forum.php?c=profile');
            }
        }
        $vars['errors'] = $errors;
        $this->view->render('profile/index', $vars);
    }
    function remove_avatar() {
        $authorizer = check_model::getInstance();
        // user or not
        if (!$authorizer->is_user()) {
            cpg_die(ERROR, Lang::item('error.perm_denied'), __FILE__, __LINE__);
        }
        $data['fr_avatar'] = '';
        $this->forum->edit_profile(USER_ID, $data);
        forum::redirect('forum.php?c=profile');
    }
}