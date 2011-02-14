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
class message_controller extends Controller {
    function message_controller() {
        parent::Controller();
    }
    function index() {
        $msg_id = $this->validate->get->getInt('id');
        $authorizer = check_model::getInstance();
        if (!$authorizer->is_msg_id($msg_id)) {
            cpg_die(ERROR, Lang::item('error.wrong_msg_id'), __FILE__, __LINE__);
        }
        $msg = $this->forum->get_message_data($msg_id, 'topic_id');
        $total_msg = $this->forum->get_message_count($msg['topic_id']);
        $current = $this->forum->get_message_pos($msg['topic_id'], $msg_id);
        $start = (floor(($current-1)/Config::item('fr_msg_per_page')))*Config::item('fr_msg_per_page');
        $superCage = Inspekt::makeSuperCage();
        if ($CONFIG['display_redirection_page'] == 0 && $superCage->get->keyExists('message_id')) {
            forum::redirect('forum.php?c=topic&id='.$msg['topic_id'].'&start='.$start.'&message_id='.$superCage->get->getAlNum('message_id').'#cpgMessageBlock');
        } else {
            forum::redirect('forum.php?c=topic&id='.$msg['topic_id'].'&start='.$start.'#'.$msg_id);
        }
    }
    function single() {
        // to-do: view single post
        $vars = array();
        $authorizer = check_model::getInstance();
        $msg_id = $this->validate->get->getInt('id');
        $vars['nagavitor'] = $this->forum->get_nagavitor();
        if (!$authorizer->is_msg_id($msg_id)) {
            cpg_die(ERROR, Lang::item('error.wrong_msg_id'), __FILE__, __LINE__);
        }
        $vars['message'] = $msg = $this->forum->get_message_data($msg_id, '*');
        $vars['message']['avatar'] = $this->forum->get_user_avatar($vars['message']['poster_id']);
        $vars['message']['poster_posts'] = $this->forum->get_user_post_count($vars['message']['poster_id']);
        $vars['message']['poster_group'] = $this->forum->get_group_name($vars['message']['poster_id']);
        $vars['message']['poster_registed'] = $this->forum->get_registed_time($vars['message']['poster_id']);
        $vars['message']['avatar'] = $this->forum->get_user_avatar($vars['message']['poster_id']);
        $vars['message']['icon'] = 'plugins/forum/forum/html/images/post/'.$vars['message']['icon'].'.gif'; 
        $vars['message']['signature'] = $this->forum->get_user_signature($vars['message']['poster_id']);
        $this->view->render('message/single', $vars);
    }
    function edit() {
        include(BASE_DIR.'include'.DS.'smilies.inc.php');
        $vars = array();$errors = array();
        $authorizer = check_model::getInstance();
        $vars['msg_id'] = $this->validate->get->getInt('id');
        if (!$authorizer->is_msg_id($vars['msg_id'])) {
            cpg_die(ERROR, Lang::item('error.wrong_msg_id'), __FILE__, __LINE__);
        }
        if (!$authorizer->can_edit_msg($vars['msg_id'])) {
            cpg_die(ERROR, Lang::item('error.perm_denied'), __FILE__, __LINE__);
        }
        $vars['nagavitor'] = $this->forum->get_nagavitor();
        $vars['icons']     = $this->forum->get_icons();
        $vars['form']      = $msg = $this->forum->get_message_data($vars['msg_id']);
        if ($this->validate->post->keyExists('submit')) {
            $data = array(
                'icon'            => $this->validate->post->getRaw('icon'),
                'subject'         => $this->validate->post->getEscaped('subject'),
                'body'            => $this->validate->post->getRaw('body'),
                'poster_time'     => time(),
                'modified_time'   => USER_ID,
                'modified_name'   => USER_NAME,
            );
            if (Config::item('fr_msg_icons') == 0 && $data['icon'] == '') $data['icon'] = 'icon1';
            if ($data['subject'] == '') $errors[] = Lang::item('error.empty_subject');
            if ($data['icon'] == '')    $errors[] = Lang::item('error.no_msg_icon');
            if ($data['body'] == '')    $errors[] = Lang::item('error.empty_body');
            if (strlen($data['body']) > Config::item('fr_msg_max_size') && Config::item('fr_msg_max_size')) {
                $data['body'] = substr($data['body'], 0, Config::item('fr_msg_max_size'));
            }
            if (count($errors) == 0) {
                $topic_id = $this->forum->modify_message($vars['msg_id'], $data);
                forum::message(Lang::item('common.message'), sprintf(Lang::item('message.modify_msg_success'), $data['subject']), 'forum.php?c=message&id='.$vars['msg_id']);
            }
        }
        $vars['errors'] = $errors;
        $this->view->render('message/edit', $vars);
    }
    function delete() {
        $authorizer = check_model::getInstance();
        $msg_id = $this->validate->get->getInt('id');
        if (!$authorizer->is_msg_id($msg_id)) {
            cpg_die(ERROR, Lang::item('error.wrong_msg_id'), __FILE__, __LINE__);
        }
        if (!$authorizer->can_delete_msg($msg_id)) {
            cpg_die(ERROR, Lang::item('error.perm_denied'), __FILE__, __LINE__);
        }
        $msg = $this->forum->get_message_data($msg_id, 'subject,topic_id');
        $this->forum->delete_message($msg_id);
        if ($this->forum->get_message_count($msg['topic_id']) == 0) {
            $topic = $this->forum->get_topic_data($msg['topic_id'], 'board_id');
            $this->forum->delete_topic($msg['topic_id']);
            forum::message(Lang::item('common.message'), sprintf(Lang::item('message.del_msg_success'), $msg['subject']), 'forum.php?c=board&id='.$topic['board_id']);
        } else {
            forum::message(Lang::item('common.message'), sprintf(Lang::item('message.del_msg_success'), $msg['subject']), 'forum.php?c=topic&id='.$msg['topic_id']);
        }
    }
}