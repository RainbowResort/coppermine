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
class board_controller extends Controller {
    function board_controller() {
        parent::Controller();
    }
    function index() {
        $vars = array();
        $authorizer = check_model::getInstance();
        $vars['board_id'] = $this->validate->get->getInt('id');
        if (!$authorizer->is_board_id($vars['board_id'])) {
            cpg_die(ERROR, Lang::item('error.wrong_board_id'), __FILE__, __LINE__);
        }
        $vars['nagavitor'] = $this->forum->get_nagavitor();
        $board = $this->forum->get_board_data($vars['board_id']);
        $child_boards = $this->forum->get_child_board($vars['board_id'], $board['child_level'], 'board_id,name,description,last_msg_id,topics,posts,child_level');
        $vars['child_boards'] = array();
        foreach ($child_boards as $child) {
            $newboard = array();
            $last = $this->forum->get_message_data($child['last_msg_id'], 'subject, poster_id, poster_time');
            $newboard['icon']                  = 'plugins/forum/forum/html/images/icon_board_new.gif';
            $newboard['id']                    = $child['board_id'];
            $newboard['name']                  = $child['name'];
            $newboard['description']           = $child['description'];
            $newboard['last_post_id']          = $child['last_msg_id'];
            $newboard['last_post_title']       = $last['subject'];
            $newboard['last_post_time']        = $last['poster_time'];
            $newboard['last_post_author_id']   = $last['poster_id'];
            $newboard['last_post_author_name'] = get_username($last_message['poster_id']);
            $newboard['topics']                = $child['topics'];
            $newboard['replies']               = $child['posts'];
            $newboard['childs']                = $this->forum->get_child_board($child['board_id'], $child['child_level'], 'board_id, name');
            $vars['child_boards'][] = $newboard;
            unset($newboard);
        }
        $vars['paging'] = array();
        $vars['paging']['total']   = $this->forum->get_topic_count($vars['board_id']);
        $vars['paging']['pattern'] = 'forum.php?c=board&id='.$vars['board_id'];
        $vars['paging']['start']   = $this->validate->get->getInt('start', 0);
        $vars['paging']['limit']   = Config::item('fr_topic_per_page');
        $topics = $this->forum->get_topic($vars['board_id'], 'topic_id,replies,views,first_msg_id,last_msg_id,is_sticky,locked', 'is_sticky desc, last_msg_id desc', $vars['paging']['start'], $vars['paging']['limit']);
        $vars['topics'] = array();
        foreach ($topics as $topic) {
            $newtopic = array();
            $first_message = $this->forum->get_message_data($topic['first_msg_id']);
            $last_message  = $this->forum->get_message_data($topic['last_msg_id']);
            $message_count = $this->forum->get_message_count($topic['topic_id']);
            if ($topic['locked']) {
                $newtopic['status'] = 'plugins/forum/forum/html/images/icon_topic_readonly.gif';
            } else if ($topic['is_sticky']) {
                $newtopic['status'] = 'plugins/forum/forum/html/images/icon_topic_reply.gif';
            } else if ($number_of_msg >= Config::item('fr_hot_topic_msg')) {
                $newtopic['status'] = 'plugins/forum/forum/html/images/icon_topic_hot.gif';
            } else {
                $newtopic['status'] = 'plugins/forum/forum/html/images/icon_topic_new.gif';
                //"plugins/forum/forum/html/images/default/icon_topic.gif";
            }
            $newtopic['icon']                  = 'plugins/forum/forum/html/images/post/'.$first_message['icon'].'.gif';
            $newtopic['id']                    = $topic['topic_id'];
            $newtopic['name']                  = $first_message['subject'];
            $newtopic['starter_id']            = $first_message['poster_id'];
            $newtopic['starter_name']          = $first_message['poster_name'];
            $newtopic['replies']               = $topic['replies'];
            $newtopic['views']                 = $topic['views'];
            $newtopic['last_post_id']          = $last_message['msg_id'];
            $newtopic['last_post_title']       = $last_message['subject'];
            $newtopic['last_post_time']        = $last_message['poster_time'];
            $newtopic['last_post_author_id']   = $last_message['poster_id'];
            $newtopic['last_post_author_name'] = get_username($last_message['poster_id']);
            $vars['topics'][] = $newtopic;
            unset($newtopic);
        }
        $vars['cbs'] = $this->forum->get_redirect_data();
        $this->forum->board_notify_recovery($vars['board_id']);
        $this->view->render('board/index', $vars);
    }
    function newtopic() {
        include(BASE_DIR.'include'.DS.'smilies.inc.php');
        include(BASE_DIR.'include'.DS.'mailer.inc.php');
        $vars = array();$errors = array();
        $authorizer = check_model::getInstance();
        $vars['board_id']  = $this->validate->get->getInt('id');
        if (!$authorizer->is_board_id($vars['board_id'])) {
            cpg_die(ERROR, Lang::item('error.wrong_board_id'), __FILE__, __LINE__);
        }
        if (!$authorizer->can_create_topic($vars['board_id'])) {
            cpg_die(ERROR, Lang::item('error.perm_denied'), __FILE__, __LINE__);
        }
        $vars['nagavitor'] = $this->forum->get_nagavitor();
        $vars['icons']     = $this->forum->get_icons();
        $data = array('icon' => 'icon1');
        if ($this->validate->post->keyExists('submit')) {
            $data = array(
                'icon'            => $this->validate->post->getRaw('icon'),
                'subject'         => $this->validate->post->getEscaped('subject'),
                'body'            => $this->validate->post->getRaw('body'),
                'poster_time'     => time(),
                'poster_id'       => USER_ID,
                'poster_name'     => USER_NAME,
                'poster_ip'       => Config::item('hdr_ip'),
                'smileys_enabled' => 1,
            );
            if (Config::item('fr_msg_icons') == 0 && $data['icon'] == '') $data['icon'] = 'icon1';
            if ($data['subject'] == '') $errors[] = Lang::item('error.empty_subject');
            if ($data['icon'] == '')    $errors[] = Lang::item('error.no_msg_icon');
            if ($data['body'] == '')    $errors[] = Lang::item('error.empty_body');
            if (strlen($data['body']) > Config::item('fr_msg_max_size') && Config::item('fr_msg_max_size')) {
                $data['body'] = substr($data['body'], 0, Config::item('fr_msg_max_size'));
            }
            if (count($errors) == 0) {
                if ($authorizer->double_post()) {
                    cpg_die(ERROR, Lang::item('error.already_post'), __FILE__, __LINE__);
                } else {
                    $topic_id = $this->forum->insert_topic($vars['board_id'], $data);
                    // to-do: send notify email
                    $users = $this->forum->get_notify_user($vars['board_id'], '');
                    foreach ($users as $user) {
                        if ($user['user_id'] == USER_ID) continue;
                        $user =  $this->forum->get_user_data($user['user_id'], 'user_email');
                        // prepare email
                        $email_subject = Lang::item('board.board_new_topic'). $data['subject'];
                        $email_body = sprintf(
                            Lang::item('board.notify_email'),
                            $data['subject'],
                            Config::item('fr_prefix_url').forum::link('topic', '', $topic_id),
                            Config::item('fr_prefix_url').forum::link('topic', '', $topic_id),
                            Config::item('fr_prefix_url').forum::link('board', 'notify', $vars['board_id']),
                            Config::item('fr_prefix_url').forum::link('board', 'notify', $vars['board_id']),
                            Config::item('fr_title')
                        );
                        // send mail
                        cpg_mail($user['user_email'], $email_subject, $email_body, 'text/html', Config::item('fr_title'), Config::item('gallery_admin_email'));
                        // set send = 0
                        $this->forum->set_board_notify($vars['board_id'], 0, $user['user_id']);
                    }
                    // set notify ?
                    if ($this->validate->post->getInt('notify') === 1) {
                        $this->forum->set_topic_notify($topic_id, $this->validate->post->getInt('notify'));
                    }
                    forum::message(Lang::item('common.message'), sprintf(Lang::item('topic.new_topic_success'), $data['subject']), 'forum.php?c=topic&id='.$topic_id);
                }
            }
        }
        $vars['errors'] = $errors;
        $vars['form']   = $data;
        $this->view->render('board/newtopic', $vars);
    }
    function notify() {
        $vars = array();$errors = array();
        $vars['board_id'] = $this->validate->get->getInt('id');
        $this->forum->notify_board($vars['board_id']);
        forum::redirect(forum::link('board','',$vars['board_id']));
    }
    function unnotify() {
        $vars = array();$errors = array();
        $vars['board_id'] = $this->validate->get->getInt('id');
        $this->forum->unnotify_board($vars['board_id']);
        forum::redirect(forum::link('board','',$vars['board_id']));
    }
}
