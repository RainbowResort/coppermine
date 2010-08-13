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
class admin_controller extends Controller {
    function admin_controller() {
        parent::Controller();
    } 
    /**
    * ****************************************************
    * HOME
    * ****************************************************
    */
    function index() {
        $vars = array();
        $img = array();
        $vars['img'] = &$img; 
        $img['up']     = 'images/icons/up.png';
        $img['down']   = 'images/icons/down.png';
        $img['edit']   = 'images/icons/edit.png';
        $img['delete'] = 'images/icons/delete.png';
        // action & id
        $action = $this->validate->get->getRaw('action');
        $action_list = array();
        if (in_array($action, $action_list)) {
            $this->$action();
        }
        $vars['nagavitor'] = $this->forum->get_nagavitor();
        $vars['board_move_data'] = $this->forum->get_redirect_data();
        $cats = $this->forum->get_category();
        $vars['cats'] = array();
        foreach ($cats as $key => $cat) {
            $newcat = array();
            $newcat['up'] = $newcat['down'] = '';
            if ($key - 1 >= 0) {
                $newcat['up'] = html::anchor('forum.php?c=admin&amp;m=movecat&amp;cat1='.$cat['cat_id'].'&amp;order1='.$cat['cat_order'].'&amp;cat2='.$cats[$key-1]['cat_order'].'&amp;order2='.$cats[$key-1]['cat_order'], html::img($img['up']));
            }
            if ($key + 2 <= count($cats)) {
                $newcat['down'] = html::anchor('forum.php?c=admin&amp;m=movecat&amp;cat1='.$cat['cat_id'].'&amp;order1='.$cat['cat_order'].'&amp;cat2='.$cats[$key+1]['cat_id'].'&amp;order2='.$cats[$key+1]['cat_order'], html::img($img['down']));
            }
            $newcat['id']   = $cat['cat_id'];
            $newcat['name'] = $cat['name'];
            $vars['cats'][$key] = $newcat;
            unset($newcat);
            $vars['cats'][$key]['boards'] = array();
            $catkey = $key;
            // get the board data
            $boards = array();
            $this->forum->get_board_list2($cat['cat_id'], 0, $boards);
            foreach ($boards as $key => $board) {
                $newboard = array();
                $newboard['up'] = $newboard['down'] = '';
                $min_order = $this->forum->get_board_min_order($cat['cat_id'], $board['child_level'], $board['parent_id']);
                $max_order = $this->forum->get_board_max_order($cat['cat_id'], $board['child_level'], $board['parent_id']);
                if ($board['board_order'] > $min_order) {
                    $newboard['up'] = html::anchor('forum.php?c=admin&amp;m=moveboard&amp;board1='.$board['board_id'].'&amp;order1='.$board['board_order'].'&amp;board2='.$boards[$key-1]['board_id'].'&amp;order2='.$boards[$key-1]['board_order'], html::img($img['up']));
                }
                if ($board['board_order'] < $max_order) {
                    $newboard['down'] = html::anchor('forum.php?c=admin&amp;m=moveboard&amp;board1='.$board['board_id'].'&amp;order1='.$board['board_order'].'&amp;board2='.$boards[$key+1]['board_id'].'&amp;order2='.$boards[$key+1]['board_order'], html::img($img['down']));
                }
                $newboard['level'] = $board['child_level'];
                $newboard['id'] = $board['board_id'];
                $newboard['name'] = $board['name'];
                $newboard['child_level'] = $board['name'];
                $newboard['parent'] = $board['parent_id'];
                $vars['cats'][$catkey]['boards'][] =  $newboard;
                unset($newboard);
            }
        }
        $this->view->render('admin/index', $vars);
    }
    /**
    * ****************************************************
    * NEW CATEGORY
    * ****************************************************
    */
    function newcat() {
        $vars = array();
        $vars['nagavitor'] = $this->forum->get_nagavitor();
        $vars['orders'] = array();
        $vars['form'] = array(
            'cat_order' => 0,
            'name'      => Lang::item('admin.default_cname'),
        );
        $cats = $this->forum->get_category();
        $vars['orders'][0] = Lang::item('admin.first_place');
        foreach ($cats as $cat) {
            $vars['orders'][$cat['cat_order']] = Lang::item('admin.after')." \"".$cat['name']."\".";
        }
        // post ?
        if ($this->validate->post->keyExists('submit')) {
            $errors = array();
            $vars['form'] = array(
                'cat_order' => $this->validate->post->getInt('cat_order'),
                'name'      => $this->validate->post->getRaw('name'),
            );
            if (!$vars['form']['name']) {
                $errors[] = Lang::item('error.cat_name_empty');
            }
            if (count($errors) == 0) {
                $this->forum->insert_category($vars['form']);
                forum::message(Lang::item('admin.new_cat'), sprintf(Lang::item('admin.new_cat_success'), $vars['form']['name']), 'forum.php?c=admin', 3);
            }
            $vars['errors'] = $errors;
        }
        $this->view->render('admin/newcat', $vars);
    }
    /**
    * ****************************************************
    * DELETE CATEGORY
    * ****************************************************
    */
    function delcat() {
        $vars = array();
        $vars['nagavitor'] = $this->forum->get_nagavitor();
        $vars['cat_id'] = $cat_id = $this->validate->get->getInt('id');
        $board_in_cat = $this->forum->get_board_count($cat_id);
        if ($board_in_cat == 0) {
            $this->forum->delete_category($cat_id);
            forum::redirect('forum.php?c=admin');
        }
        if ($this->validate->post->keyExists('submit')) {
            $cat_id = $this->validate->post->getInt('id');
            $move_cat_id = $this->validate->post->getInt('move_cat_id');
            $this->forum->delete_category($cat_id, $move_cat_id);
            forum::redirect('forum.php?c=admin');
        } else {
            $cats = $this->forum->get_category();
            $vars['cats'] = array();
            foreach ($cats as $cat) {
                if ($cat['cat_id'] != $cat_id) {
                    $vars['cats'][$cat['cat_id']] = $cat['name'];
                }
            }
            $this->view->render('admin/delcat', $vars);
        }
    }
    /**
    * ****************************************************
    * MODIFY CATEGORY
    * ****************************************************
    */
    function editcat() {
        $vars = array();
        $vars['nagavitor'] = $this->forum->get_nagavitor();
        $vars['cat_id'] = $cat_id = $this->validate->get->getInt('id');
        $cat = $this->forum->get_category_data($cat_id);
        $vars['form'] = array(
            'name' => $cat['name'],
        );
        if ($this->validate->post->keyExists('submit')) {
            $errors = array();
            $vars['form'] = array(
                'name' => $this->validate->post->getRaw('name'),
            );
            if (!$vars['form']['name']) {
                $errors[] = Lang::item('error.cat_name_empty');
            }
            if (count($errors) == 0) {
                $this->forum->modify_category($this->validate->post->getInt('id'), $vars['form']);
                forum::message(Lang::item('admin.edit_cat'), sprintf(Lang::item('admin.edit_cat_success'), $vars['form']['name']), 'forum.php?c=admin', 3);
            }
            $vars['errors'] = $errors;
        }
        $this->view->render('admin/editcat', $vars);
    }
    /**
    * ****************************************************
    * MOVE CATEGORY
    * ****************************************************
    */
    function movecat() {
        $data1 = array(
            'cat'   => $this->validate->get->getInt('cat1'),
            'order' => $this->validate->get->getInt('order'),
        );
        $data2 = array(
            'cat'   => $this->validate->get->getInt('cat2'),
            'order' => $this->validate->get->getInt('order2'),
        );
        $this->forum->move_category($data1, $data2);
        forum::redirect('forum.php?c=admin');
    }
    /**
    * ****************************************************
    * NEW BOARD
    * ****************************************************
    */
    function newboard() {
        $vars = array();
        $vars['nagavitor'] = $this->forum->get_nagavitor();
        $cat_id = $this->validate->get->getInt('id');
        $cats = $this->forum->get_category(0, 'cat_id, name');
        $vars['cats'] = array();
        foreach ($cats as $cat) {
            $vars['cats'][$cat['cat_id']] = $cat['name'];
        }
        $cat = $this->forum->get_category_data($cat_id, 'cat_id');
        $vars['form'] = array(
            'cat_id'      => $cat['cat_id'],
            'name'        => Lang::item('admin.default_bname'),
            'description' => '',
        );
        if ($this->validate->post->keyExists('submit')) {
            $errors = array();
            $vars['form'] = array(
                'cat_id'      => $this->validate->post->getInt('cat_id'),
                'name'        => $this->validate->post->getRaw('name'),
                'description' => $this->validate->post->getRaw('description'),
            );
            if (!$vars['form']['name']) {
                $errors[] = Lang::item('error.board_name_empty');
            }
            if (count($errors) == 0) {
                $this->forum->insert_board($vars['form']);
                forum::message(Lang::item('admin.new_board'), sprintf(Lang::item('admin.new_board_success'), $vars['form']['name']), 'forum.php?c=admin', 3);
            }
            $vars['errors'] = $errors;
        }
        $this->view->render('admin/newboard', $vars);
    }
    /**
    * ****************************************************
    * EDIT BOARD
    * ****************************************************
    */
    function editboard() {
        $vars = array();
        $vars['nagavitor'] = $this->forum->get_nagavitor();
        $vars['board_id'] = $board_id = $this->validate->get->getInt('id');
        $cats = $this->forum->get_category('cat_id, name');
        $vars['cats'] = array();
        foreach ($cats as $cat) {
            $vars['cats'][$cat['cat_id']] = $cat['name'];
        }
        $board = $this->forum->get_board_data($board_id);
        $vars['form'] = array(
            'name'        => $board['name'],
            'description' => $board['description'],
        );
        if ($this->validate->post->keyExists('submit')) {
            $errors = array();
            $vars['form'] = array(
                'name'        => $this->validate->post->getRaw('name'),
                'description' => $this->validate->post->getRaw('description'),
            );
            if (!$vars['form']['name']) {
                $errors[] = Lang::item('error.board_name_empty');
            }
            if (count($errors) == 0) {
                $this->forum->modify_board($this->validate->post->getInt('id'), $vars['form']);
                forum::message(Lang::item('admin.edit_board'), sprintf(Lang::item('admin.edit_board_success'), $vars['form']['name']), 'forum.php?c=admin', 3);
            }
            $vars['errors'] = $errors;
        }
        $this->view->render('admin/editboard', $vars);
    }
    /**
    * ****************************************************
    * DELETE BOARD
    * ****************************************************
    */
    function delboard() {
        $board_id = $this->validate->get->getInt('id');
        $this->forum->delete_board($board_id);
        //forum::message(Lang::item('admin.del_board'), Lang::item('admin.del_board_success'), 'forum.php?c=admin', 3);
        forum::redirect('forum.php?c=admin');
    }
    /**
    * ****************************************************
    * DELETE BOARD
    * ****************************************************
    */
    function moveboard() {
        $data1 = array(
            'board' => $this->validate->get->getInt('board1'),
            'order' => $this->validate->get->getInt('order1'),
        );
        $data2 = array(
            'board' => $this->validate->get->getInt('board2'),
            'order' => $this->validate->get->getInt('order2'),
        );
        $to_cat    = $this->validate->get->getInt('to_cat');
        $to_board  = $this->validate->get->getInt('to_board');
        $board     = $this->validate->get->getInt('board');
        $this->forum->move_board($data1, $data2, $board, $to_cat, $to_board);
        //forum::message(Lang::item('admin.move_board'), Lang::item('admin.move_board_success'), 'forum.php?c=admin', 3);
        forum::redirect('forum.php?c=admin');
    }
    /**
    * ****************************************************
    * SETTING
    * ****************************************************
    */
    function setting() {
        $vars = array();
        $vars['nagavitor'] = $this->forum->get_nagavitor();
        $vars['form'] = array(
            'fr_title'                => Config::item('fr_title'),
            'fr_guest_browse'         => Config::item('fr_guest_browse'),
            'fr_guest_post'           => Config::item('fr_guest_post'),
            'fr_topic_per_page'       => Config::item('fr_topic_per_page'),
            'fr_hot_topic_msg'        => Config::item('fr_hot_topic_msg'),
            'fr_msg_per_page'         => Config::item('fr_msg_per_page'),
            'fr_msg_max_size'         => Config::item('fr_msg_max_size'),
            'fr_max_word_length'      => Config::item('fr_max_word_length'),
            'fr_gap_time'             => Config::item('fr_gap_time'),
            'fr_avatar_size'          => Config::item('fr_gap_time'),
            'fr_signature_max_size'   => Config::item('fr_gap_time'),
            'fr_time_online_checking' => Config::item('fr_time_online_checking'),
            'fr_msg_icons'            => Config::item('fr_msg_icons')
        );
        $errors = array();
        if ($this->validate->post->keyExists('submit')) {
            foreach ($vars['form'] as $k => $v) {
                $nv = $this->validate->post->getRaw($k);
                if ($nv != $v) {
                    $this->forum->save_config($k, $nv);
                    Config::set($k, $nv);
                }
            }
        }
        $vars['errors'] = $errors;
        $this->view->render('admin/setting', $vars);
    }
    /**
    * ****************************************************
    * UPDATE
    * ****************************************************
    */
    function update() {
        codebase_query(Lang::item('admin.update'), 'plugins'.DS.'forum'.DS.'sql'.DS.'update.sql');
        forum::message(Lang::item('common.message'), Lang::item('admin.update_success'), 'forum.php?c=admin', 3);
    }
}