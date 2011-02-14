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
class topic_controller extends Controller {
    function topic_controller() {
        parent::Controller();
    }
    function index() {
        include(BASE_DIR.'include'.DS.'smilies.inc.php');
        $vars = array();
        $authorizer = check_model::getInstance();
        $vars['topic_id']  = $this->validate->get->getInt('id');
        if (!$authorizer->is_topic_id($vars['topic_id'])) {
            cpg_die(ERROR, Lang::item('error.wrong_topic_id'), __FILE__, __LINE__);
        }
        if (!$authorizer->can_access_topic($vars['topic_id'])) {
            $superCage = Inspekt::makeSuperCage();
            $redirect = 'login.php';
            if ($matches = $superCage->server->getMatched('QUERY_STRING', '/^[a-zA-Z0-9&=_\/.-]+$/')) {
                $redirect .= '?force_login=1&referer='.urlencode('forum.php?'.$matches[0]);
            }
            header("Location: $redirect");
            exit();
        }
        $this->forum->add_view($vars['topic_id']);
        $vars['nagavitor'] = $this->forum->get_nagavitor();
        $vars['icons']     = $this->forum->get_icons();
        $board = $this->forum->get_topic_data($vars['topic_id'], 'board_id');
        $vars['board_id']  = $board['board_id'];
        $vars['paging'] = array();
        $vars['paging']['total']   = $this->forum->get_message_count($vars['topic_id']);
        $vars['paging']['pattern'] = 'forum.php?c=topic&id='.$vars['topic_id'];
        $vars['paging']['start']   = $this->validate->get->getInt('start', 0);
        $vars['paging']['limit']   = Config::item('fr_msg_per_page');
        $messages = $this->forum->get_message($vars['topic_id'], 'msg_id,subject,body,icon,poster_id,poster_name,poster_time', 'msg_id asc', $vars['paging']['start'], $vars['paging']['limit']);
        $vars['messages'] = array();
        $vars['topic_name'] = $messages[0]['subject'];
        foreach ($messages as $pos => $message) {
            $newmessage = array();
            $newmessage['id']   = $message['msg_id'];
            $newmessage['name'] = $message['subject'];
            $newmessage['pos']  = $pos+1;
            $newmessage['avatar'] = $this->forum->get_user_avatar($message['poster_id']);
            $newmessage['poster_id'] = $message['poster_id'];
            $newmessage['poster_name'] = $message['poster_name'];
            $newmessage['poster_posts'] = $this->forum->get_user_post_count($message['poster_id']);
            $newmessage['poster_group'] = $this->forum->get_group_name($message['poster_id']);
            $newmessage['poster_registed'] = $this->forum->get_registed_time($message['poster_id']);
            $newmessage['icon'] = 'plugins/forum/forum/html/images/post/'.$message['icon'].'.gif';
            $newmessage['post'] = $message['body'];
            $newmessage['time'] = $message['poster_time'];
            $newmessage['signature'] = $this->forum->get_user_signature($message['poster_id']);
            $vars['messages'][] = $newmessage;
            unset($newmessage);
        }
        $vars['cbs'] = $this->forum->get_redirect_data();
        $this->forum->topic_notify_recovery($vars['topic_id']);
        $this->view->render('topic/index', $vars);
    }
    function reply() {
        include(BASE_DIR.'include'.DS.'smilies.inc.php');
        include(BASE_DIR.'include'.DS.'mailer.inc.php');
        $vars = array();$errors = array();
        $authorizer = check_model::getInstance();
        $vars['topic_id'] = $this->validate->get->getInt('id');
        if (!$authorizer->is_topic_id($vars['topic_id'])) {
            cpg_die(ERROR, Lang::item('error.wrong_topic_id'), __FILE__, __LINE__);
        }
        if (!$authorizer->can_reply($vars['topic_id'])) {
            cpg_die(ERROR, Lang::item('error.perm_denied'), __FILE__, __LINE__);
        }
        $vars['nagavitor'] = $this->forum->get_nagavitor();
        $vars['icons'] = $this->forum->get_icons();
        $topic         = $this->forum->get_topic_data($vars['topic_id'], 'board_id');
        $messages      = $this->forum->get_message($vars['topic_id'], 'subject', 'msg_id asc', '1');
        $data = array(
            'icon'    => 'icon1',
            'subject' => Lang::item('topic.re').$messages[0]['subject'],
        );
        if ($this->validate->post->keyExists('submit')) {
            $data = array(
                'topic_id'        => $vars['topic_id'],
                'icon'            => $this->validate->post->getRaw('icon'),
                'subject'         => $this->validate->post->getEscaped('subject'),
                'body'            => $this->validate->post->getRaw('body'),
                'board_id'        => $topic['board_id'],
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
                    $msg_id = $this->forum->insert_message($data);
                    // to-do: send notify email
                    $users = $this->forum->get_notify_user('', $vars['topic_id']);
                    foreach ($users as $user) {
                        if ($user['user_id'] == USER_ID) continue;
                        $user = $this->forum->get_user_data($user['user_id'], 'user_email');
                        // prepare email
                        $email_subject = Lang::item('topic.topic_reply'). $data['subject'];
                        $email_body = sprintf(
                            Lang::item('topic.notify_email'),
                            Config::item('fr_prefix_url').'profile.php?uid='.USER_ID,
                            USER_NAME,
                            Config::item('fr_prefix_url').forum::link('message', '', $msg_id),
                            Config::item('fr_prefix_url').forum::link('message', '', $msg_id),
                            Config::item('fr_prefix_url').forum::link('topic', 'notify', $vars['topic_id']),
                            Config::item('fr_prefix_url').forum::link('topic', 'notify', $vars['topic_id']),
                            Config::item('fr_title')
                        );
                        // send mail
                        cpg_mail($user['user_email'], $email_subject, $email_body, 'text/html', Config::item('fr_title'), Config::item('gallery_admin_email'));
                        // set send = 0
                        $this->forum->set_topic_notify($vars['topic_id'], 0, $user['user_id']);
                    }
                    if ($this->validate->post->getInt('notify') === 1) {
                        $this->forum->set_topic_notify($vars['topic_id'], $this->validate->post->getInt('notify'));
                    } 
                    if ($this->validate->post->getInt('notify') === 0) {
                        $this->forum->unnotify_topic($vars['topic_id']);
                    }
                    forum::message(Lang::item('common.message'), sprintf(Lang::item('message.new_msg_success'), $data['subject']), 'forum.php?c=message&id='.$msg_id);
                }
            }
        }
        $vars['errors'] = $errors;
        $vars['form']   = $data;
        $this->view->render('topic/reply', $vars);
    }
    function move() {
        $vars = array();$errors = array();
        $authorizer = check_model::getInstance();
        $vars['topic_id']  = $this->validate->get->getInt('id');
        if (!$authorizer->is_topic_id($vars['topic_id'])) {
            cpg_die(ERROR, Lang::item('error.wrong_topic_id'), __FILE__, __LINE__);
        }
        if (!$authorizer->can_move_topic($vars['topic_id'])) {
            cpg_die(ERROR, Lang::item('error.perm_denied'), __FILE__, __LINE__);
        }
        $vars['nagavitor'] = $this->forum->get_nagavitor();
        if ($this->validate->post->keyExists('submit')) {
            $data['board_id'] = $this->validate->post->getInt('board_id');
            $this->forum->move_topic($vars['topic_id'], $data);
            forum::message(Lang::item('common.message'), sprintf(Lang::item('topic.move_topic_success'), $this->forum->get_topic_name($vars['topic_id'])), 'forum.php?c=topic&id='.$vars['topic_id']);
        } else {
            $vars['topic_move_data'] = $this->forum->get_redirect_data();
            $vars['topic'] = $this->forum->get_topic_data($vars['topic_id'], 'board_id');
            $vars['topic']['name'] = $this->forum->get_topic_name($vars['topic_id']);
            $this->view->render('topic/move', $vars);
        }
    }
    function delete() {
        $authorizer = check_model::getInstance();
        $topic_id = $this->validate->get->getInt('id');
        if (!$authorizer->is_topic_id($topic_id)) {
            cpg_die(ERROR, Lang::item('error.wrong_topic_id'), __FILE__, __LINE__);
        }
        if (!$authorizer->can_delete_topic($topic_id)) {
            cpg_die(ERROR, Lang::item('error.perm_denied'), __FILE__, __LINE__);
        }
        $topic = $this->forum->get_topic_data($topic_id, 'board_id');
        $topic_name = $this->forum->get_topic_name($topic_id);
        $this->forum->delete_topic($topic_id);
        forum::message(Lang::item('common.message'), sprintf(Lang::item('topic.delete_topic_success'), $topic_name), 'forum.php?c=board&id='.$topic['board_id']);
    }
    function sticky() {
        $authorizer = check_model::getInstance();
        $topic_id = $this->validate->get->getInt('id');
        if (!$authorizer->is_topic_id($topic_id)) {
            cpg_die(ERROR, Lang::item('error.wrong_topic_id'), __FILE__, __LINE__);
        }
        if (!$authorizer->can_moderator_topic($topic_id)) {
            cpg_die(ERROR, Lang::item('error.perm_denied'), __FILE__, __LINE__);
        }
        $this->forum->sticky_topic($topic_id);
        forum::redirect('forum.php?c=topic&id='.$topic_id);
    }
    function locked() {
        $authorizer = check_model::getInstance();
        $topic_id = $this->validate->get->getInt('id');
        if (!$authorizer->is_topic_id($topic_id)) {
            cpg_die(ERROR, Lang::item('error.wrong_topic_id'), __FILE__, __LINE__);
        }
        if (!$authorizer->can_moderator_topic($topic_id)) {
            cpg_die(ERROR, Lang::item('error.perm_denied'), __FILE__, __LINE__);
        }
        $this->forum->lock_topic($topic_id);
        forum::redirect('forum.php?c=topic&id='.$topic_id);
    }
    function notify() {
        $vars = array();$errors = array();
        $vars['topic_id'] = $this->validate->get->getInt('id');
        $this->forum->notify_topic($vars['topic_id']);
        forum::redirect(forum::link('topic','',$vars['topic_id']));
    }
    function unnotify() {
        $vars = array();$errors = array();
        $vars['topic_id'] = $this->validate->get->getInt('id');
        $this->forum->unnotify_topic($vars['topic_id']);
        forum::redirect(forum::link('topic','',$vars['topic_id']));
    }
}
