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
class home_controller extends Controller {
    function home_controller() {
        parent::Controller();
    }
    function index() {
        $vars = array();
        $authorizer = check_model::getInstance();
        $vars['nagavitor']  = $this->forum->get_nagavitor();
        $vars['cat_id'] = $this->validate->get->getInt('id');
        if ($vars['cat_id']) {
            if (!$authorizer->is_cat_id($vars['cat_id'])) {
                cpg_die(ERROR, Lang::item('error.wrong_cat_id'), __FILE__, __LINE__);
            }
        }
        $vars['user_posts'] = $this->forum->get_user_post_count();
        $vars['last_visit'] = $this->forum->get_last_visit_time();
        $cats = $this->forum->get_category($vars['cat_id'], 'cat_id, name');
        $vars['categories'] = array();
        foreach ($cats as $cat) {
            $newcat = array();
            $newcat['name'] = $cat['name'];
            $newcat['id']   = $cat['cat_id'];
            $boards = $this->forum->get_first_level_board($cat['cat_id'], 'board_id,name,description,last_msg_id,topics,posts,child_level');
            $newcat['boards'] = array();
            foreach ($boards as $board) {
                $last_message = $this->forum->get_message_data($board['last_msg_id'], 'subject, poster_id, poster_time');
                $newboard = array();
                $newboard['icon']                  = 'plugins/forum/forum/html/images/icon_board_new.gif';
                $newboard['id']                    = $board['board_id'];
                $newboard['name']                  = $board['name'];
                $newboard['description']           = $board['description'];
                $newboard['last_post_id']          = $board['last_msg_id'];
                $newboard['last_post_title']       = $last_message['subject'];
                $newboard['last_post_time']        = $last_message['poster_time'];
                $newboard['last_post_author_id']   = $last_message['poster_id'];
                $newboard['last_post_author_name'] = get_username($last_message['poster_id']);
                $newboard['topics']                = $board['topics'];
                $newboard['replies']               = $board['posts'];
                $newboard['childs']                = $this->forum->get_child_board($board['board_id'], $board['child_level'], 'board_id, name');
                $newcat['boards'][] = $newboard;
                unset($newboard);
            }
            $vars['categories'][] = $newcat;
            unset($newcat);
        }
        $recents = $this->forum->get_latest_message();
        $vars['recents'] = $recents;
        $vars['stats'] = $this->forum->get_statistics();
        $vars['newest_members'] = $this->forum->get_latest_user();
        $vars['active_members'] = $this->forum->get_active_user();
        $this->view->render('home/index', $vars);
    }
}
