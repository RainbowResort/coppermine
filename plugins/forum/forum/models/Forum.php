<?php

/*
* ****************************************************
* Model Forum Class
* Hand all possible queries of the forum plugin.
*
* @package: Model Forum Class
* @author: Le Hoai Phuong
* ****************************************************
*/

class forum_model extends Model {
    function forum_model() {
        parent::Model();
        $this->validate = Inspekt::makeSuperCage();
    }
    // singleton
    function & getInstance() {
        static $instance = array();
        if (!is_object($instance[0])) {
            $instance[0] = & new forum_model();
        }
        return $instance[0];
    }
/**
* ****************************************************
* FORUM PART
* ****************************************************
*/
    function get_nagavitor($c = '', $m = '', $id = '') {
        $nagavitors = array();
        if (!$c)  $c  = Config::item('c');
        if (!$m)  $m  = Config::item('m');
        if (!$id) $id = $this->validate->get->getInt('id');
        do {
            switch ($c) {
                case 'message':
                    if ($m == 'index') {
                        $msg = $this->get_message_data($id, 'topic_id, subject');
                        $nagavitors[] = array('forum.php?c='.$c.'&id='.$id, $msg['subject']);
                        $c  = 'topic';
                        $id = $msg['topic_id'];
                    } else {
                        $nagavitors[] = array('forum.php?c='.$c.'&m='.$m.'&id='.$id, Lang::item($c.'.'.$m.'_nagavitor'));
                        $m = 'index';
                    }
                    break;
                case 'topic':
                    if ($m == 'index') {
                        // subject
                        $this->db->select('subject');
                        $this->db->where('topic_id', $id);
                        $this->db->orderby('msg_id asc');
                        $this->db->limit(1);
                        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
                        $row = $query->row();
                        $nagavitors[] = array('forum.php?c='.$c.'&id='.$id, $row->subject);
                        // board_id
                        $this->db->select('board_id');
                        $this->db->where('topic_id', $id);
                        $query = $this->db->get(Config::item('TABLE_FR_TOPICS'));
                        $row = $query->row();
                        // next
                        $c  = 'board';
                        $id = $row->board_id;
                    } else {
                        $nagavitors[] = array('forum.php?c='.$c.'&m='.$m.'&id='.$id, Lang::item($c.'.'.$m.'_nagavitor'));
                        $m = 'index';
                    }
                    break;
                case 'board':
                    if ($m == 'index') {
                        // any parent board
                        $this->db->select('cat_id, child_level, parent_id, name');
                        $this->db->where('board_id', $id);
                        $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
                        $row = $query->row();
                        $nagavitors[] = array('forum.php?c='.$c.'&id='.$id, $row->name);
                        if ($row->parent_id == 0) {
                            $c  = 'home';
                            $id = $row->cat_id;
                        } else {
                            $c  = 'board';
                            $id = $row->parent_id;
                        }
                    } else {
                        $nagavitors[] = array('forum.php?c='.$c.'&m='.$m.'&id='.$id, Lang::item($c.'.'.$m.'_nagavitor'));
                        $m = 'index';
                    }
                    break;
                case 'home':
                    if ($id) {
                        // category
                        $this->db->select('name');
                        $this->db->where('cat_id', $id);
                        $query = $this->db->get(Config::item('TABLE_FR_CATEGORIES'));
                        $row = $query->row();
                        $nagavitors[] = array('forum.php?c='.$c.'&id='.$id, $row->name);
                        $id = 0;
                    } else {
                        // home sweet home
                        $nagavitors[] = array('forum.php','Forum');
                        $c = 'end';
                    }
                    break;
                default:
                    // other simple page
                    $m = isset($m) ? $m : Config::item('m');
                    if ($m == 'index') {
                        $nagavitors[] = array('forum.php?c='.$c, Lang::item($c.'.nagavitor'));
                        $c  = 'home';
                        $id = 0;
                    } else {
                        $nagavitors[] = array('forum.php?c='.$c.'&m='.$m, Lang::item($c.'.'.$m.'_nagavitor'));
                        $m = 'index';
                    }
            }
        } while ($c != 'end');
        return $nagavitors;
    }
    function get_statistics() {
        $stasts = array();
        // Total Registered Members
        $this->db->select('count(*) as count');
        $query = $this->db->get(Config::item('TABLE_USERS'));
        $row   = $query->row();
        $stasts['t_r_m'] = (int)$row->count;
        // Total Logged-in Users
        $this->db->select('count(*) as count');
        $this->db->where('user_id>0');
        $this->db->where('time>', time()-Config::item('fr_time_online_checking')*60);
        $query = $this->db->get(Config::item('TABLE_PREFIX').'sessions');
        $row   = $query->row();
        $stasts['t_li_u'] = (int)$row->count;
        // Total Topics
        $this->db->select('count(*) as count');
        $query = $this->db->get(Config::item('TABLE_FR_TOPICS'));
        $row   = $query->row();
        $stasts['t_t'] = (int)$row->count;
        // Total Anonymous Users
        $this->db->select('count(*) as count');
        $this->db->where('user_id=0');
        $this->db->where('time >', time()-Config::item('fr_time_online_checking')*60);
        $query = $this->db->get(Config::item('TABLE_PREFIX').'sessions');
        $row   = $query->row();
        $stasts['t_a_u'] = (int)$row->count;
        //Total Replies t_r
        $query = $this->db->select('count(*) as count');
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        $row   = $query->row();
        $stasts['t_r'] = (int)$row->count;
        return $stasts;
    }
    function get_icons() {
        $this->db->select('title, filename');
        $this->db->orderby('icon_id ASC');
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGE_ICONS'));
        return $query->result_array();
    }
    function get_redirect_data() {
        // cbs
        $cbs = array();
        // first get the cat
        $cats = $this->get_category();
        foreach ($cats as $cat) {
            $cbs[] = array('cat', $cat['cat_id'], $cat['name']);
            $this->get_board_list($cat['cat_id'], 0, $cbs);
        }
        return $cbs;
    }
    function get_board_list($cat_id, $parent_id, &$cbs) {
         if ($parent_id == 0) {
            $this->db->select('board_id, name, child_level');
            $this->db->where('cat_id', $cat_id);
            $this->db->where('child_level', 1);
            $this->db->orderby('board_order asc');
            $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
            $boards = $query->result_array();
         } else {
            $this->db->select('board_id, name, child_level');
            $this->db->where('cat_id', $cat_id);
            $this->db->where('parent_id', $parent_id);
            $this->db->orderby('board_order asc');
            $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
            $boards = $query->result_array();
         }
         foreach ($boards as $board) {
            $cbs[] = array('board', $board['board_id'], $board['name'], $board['child_level']);
            $this->get_board_list($cat_id, $board['board_id'], $cbs);
         }
    }
    function get_board_list2($cat_id, $parent_id, &$cbs) {
        global $CONFIG;
        if ($parent_id == 0) {
            $this->db->select('cat_id, board_id, board_order, name, child_level, parent_id');
            $this->db->where('cat_id', $cat_id);
            // $this->db->where('child_level', 1);
            $this->db->where('parent_id',$parent_id);
            $this->db->orderby('board_order asc');
            $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
            $boards = $query->result_array();
        } else {
            $this->db->select('cat_id, board_id, board_order, name, child_level, parent_id');
            $this->db->where('cat_id', $cat_id);
            $this->db->where('parent_id', $parent_id);
            $this->db->orderby('board_order asc');
            $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
            $boards = $query->result_array();
        }
        foreach ($boards as $board) {
            $cbs[] = $board;
            $this->get_board_list2($cat_id, $board['board_id'], $cbs);
        }
    }
    function save_config($name, $value) {
        $this->db->update(Config::item('TABLE_CONFIG'), array('value'=>$value), 'name=\''.$name."'");
    }

/**
* ****************************************************
* CATEGORY PART
* ****************************************************
*/
    function insert_category($data) {
        $data['cat_order']++;
        $this->db->set('cat_order', 'cat_order+1', FALSE);
        $this->db->where('cat_order >= '.($data['cat_order']));
        $this->db->update(Config::item('TABLE_FR_CATEGORIES'));
        $this->db->insert(Config::item('TABLE_FR_CATEGORIES'), $data);
    }
    function modify_category($cat_id, $data) {
        $this->db->update(Config::item('TABLE_FR_CATEGORIES'), $data, "cat_id= '{$cat_id}'");
    }
    function delete_category($cat_id, $move_cat_id = '') {
        if (!$move_cat_id) {
            $this->db->delete(Config::item('TABLE_FR_CATEGORIES'), "cat_id='{$cat_id}'");
            $this->arrange_all_cat();
        } else {
            $this->db->select('MAX(board_order) as max');
            $this->db->where('cat_id', $move_cat_id);
            $this->db->where('child_level', 1);
            $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
            $row = $query->row();
            $board_order = $row->max;
            $this->db->where('cat_id', $cat_id);
            $this->db->where('child_level', 1);
            $this->db->orderby('board_order asc');
            $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
            $boards = $query->result_array();
            foreach ($boards as $board) {
                $this->db->update(Config::item('TABLE_FR_BOARDS'), array('board_order' => $board_order), "board_id='{$board['board_id']}'");
            }
            $this->db->update(Config::item('TABLE_FR_BOARDS'), array('cat_id'=>$move_cat_id), "cat_id='{$cat_id}'");
            $this->db->delete(Config::item('TABLE_FR_CATEGORIES'), "cat_id='{$cat_id}'");
            $this->arrange_all_cat();
        }
    }
    function move_category($data1, $data2) {
        $this->db->update(Config::item('TABLE_FR_CATEGORIES'), array('cat_order'=>$data2['order']), "cat_id='{$data1['cat']}'");
        $this->db->update(Config::item('TABLE_FR_CATEGORIES'), array('cat_order'=>$data1['order']), "cat_id='{$data2['cat']}'");
    }
    function check_category($cat_id) {
        $cat_id = (int)$cat_id;
        $this->db->select('COUNT(*) as count');
        $this->db->where('cat_id', $cat_id);
        $query = $this->db->get(Config::item('TABLE_FR_CATEGORIES'));
        if ($query->num_row() == 1) {
            return TRUE;
        } else {
            cpg_die(ERROR, '', __FILE__, __LINE__);
        }
    }
    function get_category($cat_id = 0, $select = '*', $order = 'cat_order asc') {
        $this->db->select($select);
        $this->db->order_by($order);
        if ($cat_id) {
            $this->db->where('cat_id', $cat_id);
        }
        $query = $this->db->get(Config::item('TABLE_FR_CATEGORIES'));
        return $query->result_array();
    }
    function get_category_data($cat_id, $select = '*') {
        $this->db->select($select);
        $this->db->where('cat_id', $cat_id);
        $this->db->limit(1);
        $query = $this->db->get(Config::item('TABLE_FR_CATEGORIES'));
        return $query->row_array();
    }
    function arrange_a_cat($cat_id, $board_id = 0, $child_level = 0) {
        $this->db->where('parent_id', $board_id);
        $this->db->where('cat_id', $cat_id);
        $this->db->orderby('board_order asc');
        $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
        $boards = $query->result_array();
        $order[$child_level] = 0;
        $real_child_level = $child_level + 1;
        foreach ($boards as $board) {
            $order[$child_level]++;
            $data = array(
                'child_level' => $real_child_level,
                'board_order' => $order[$child_level],
            );
            $this->db->update(Config::item('TABLE_FR_BOARDS'), $data, "board_id='{$board['board_id']}'");
            $this->arrange_a_cat($cat_id, $board['board_id'], $real_child_level);
        }
    }
    function arrange_all_cat() {
        global $CONFIG;
        $this->db->select('cat_id');
        $this->db->orderby('cat_order asc');
        $query = $this->db->get(Config::item('TABLE_FR_CATEGORIES'));
        $cats = $query->result_array();
        $order = 0;
        foreach ($cats as $cat) {
            $order++;
            $this->db->update(Config::item('TABLE_FR_CATEGORIES'), array('cat_order'=>$order), "cat_id='{$cat['cat_id']}'");
            $this->arrange_a_cat($category['cat_id']);
        }
    }
/**
* ****************************************************
* BOARD PART
* ****************************************************
*/
   function insert_board($data) {
        $this->db->select('MAX(board_order) as max');
        $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
        $row = $query->row();
        $data['board_order'] = $row->max + 1;
        $data['child_level'] = 1;
        $data['parent_id']   = 0;
        $this->db->insert(Config::item('TABLE_FR_BOARDS'), $data);
   }
   function modify_board($board_id, $data) {
        $this->db->update(Config::item('TABLE_FR_BOARDS'), $data, "board_id='{$board_id}'");
   }
   function delete_board($board_id) {
        $this->db->select('cat_id, parent_id');
        $this->db->where('board_id', $board_id);
        $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
        $row   = $query->row();
        $cat_id    = $row->cat_id;
        $parent_id = $row->parent_id;
        $this->db->where('parent_id', $board_id);
        $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
        $boards = $query->result_array();
        foreach ($boards as $board) {
            $data = array(
                'parent_id'   => $parent_id,
                'board_order' => 9999,
            );
            $this->db->update(Config::item('TABLE_FR_BOARDS'), $data, "board_id='{$board['board_id']}'");
        }
        $this->db->delete(Config::item('TABLE_FR_BOARDS'), "board_id='{$board_id}'");
        $this->db->delete(Config::item('TABLE_FR_NOTIFY'), "board_id='{$board_id}'");
        $this->arrange_all_cat();
   }
   function move_board($data1 = array(), $data2 = array(), $board = '', $to_cat = '', $to_board = '') {
        if ($data1['board'] && $data1['board']) {
            $this->db->update(Config::item('TABLE_FR_BOARDS'), array('board_order'=>$data2['order']), "board_id='{$data1['board']}'");
            $this->db->update(Config::item('TABLE_FR_BOARDS'), array('board_order'=>$data1['order']), "board_id='{$data2['board']}'");
            $this->arrange_all_cat();
        } else if ($board && $to_cat) {
            $this->db->select('cat_id');
            $this->db->where('board_id', $board);
            $query  = $this->db->get(Config::item('TABLE_FR_BOARDS'));
            $row    = $query->row();
            $cat_id = $row->cat_id;
            $cbs = array();
            $this->get_board_list($cat_id, $board, $cbs);
            foreach ($cbs as $cb) {
                $this->db->update(Config::item('TABLE_FR_BOARDS'), array('cat_id'=>$to_cat, 'board_order'=>9999), "board_id='{$cb[1]}'");
            }
            $this->db->update(Config::item('TABLE_FR_BOARDS'), array('parent_id'=>0, 'cat_id'=>$to_cat, 'board_order'=>9999), "board_id='{$board}'");
            $this->arrange_all_cat();
        } else if ($board && $to_board) {
            $this->db->select('cat_id');
            $this->db->where('board_id', $to_board);
            $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
            $row = $query->row();
            $to_cat = $row->cat_id;
            $this->db->update(Config::item('TABLE_FR_BOARDS'), array('parent_id'=>$to_board, 'cat_id'=>$to_cat, 'board_order'=>9999), "board_id='{$board}'");
            $this->arrange_all_cat();
        }
   }
   function notify_board($board_id, $user_id = '') {
        // find if any
        $this->db->select('send');
        $this->db->where('user_id', $user_id ? $user_id : USER_ID);
        $this->db->where('board_id', $board_id);
        $query = $this->db->get(Config::item('TABLE_FR_NOTIFY'));
        if ($query->num_rows()) {
            // have
            $row = $query->row();
            $data = array(
                'send' => ($row->send == 1) ? 0 : 1,
            );
            $this->db->where('user_id', $user_id ? $user_id : USER_ID);
            $this->db->where('board_id', $board_id);
            $this->db->update(Config::item('TABLE_FR_NOTIFY'), $data);
        } else {
            // not have = create
            $data = array(
                'user_id'  => $user_id ? $user_id : USER_ID,
                'board_id' => $board_id,
                'topic_id' => 0,
                'send'     => 1,
            );
            $this->db->insert(Config::item('TABLE_FR_NOTIFY'), $data);
        }
   }
   function unnotify_board($board_id, $user_id = '') {
            $data = array(
                'user_id'  => $user_id ? $user_id : USER_ID,
                'board_id' => $board_id,
            );
        $this->db->delete(Config::item('TABLE_FR_NOTIFY'), $data);
   }
   function set_board_notify($board_id, $notify, $user_id = '') {
        // find if any
        $this->db->select('send');
        $this->db->where('user_id', $user_id ? $user_id : USER_ID);
        $this->db->where('board_id', $board_id);
        $query = $this->db->get(Config::item('TABLE_FR_NOTIFY'));
        if ($query->num_rows()) {
            $data = array(
                'send' => $notify,
            );
            $this->db->where('user_id', $user_id ? $user_id : USER_ID);
            $this->db->where('board_id', $board_id);
            $this->db->update(Config::item('TABLE_FR_NOTIFY'), $data);
        } else {
            // not have = create
            $data = array(
                'user_id'  => $user_id ? $user_id : USER_ID,
                'board_id' => $board_id,
                'topic_id' => 0,
                'send'     => $notify,
            );
            $this->db->insert(Config::item('TABLE_FR_NOTIFY'), $data);
        }
   }
   function board_notify_recovery($board_id) {
       $data = array('send'=>1);
       $this->db->where('user_id', USER_ID);
       $this->db->where('board_id', $board_id);
       $this->db->update(Config::item('TABLE_FR_NOTIFY'), $data);
   }
   function get_first_level_board($cat_id = 0, $select = '*', $order = 'board_order asc') {
        $this->db->select($select);
        $this->db->order_by($order);
        if ($cat_id != 0) {
            $this->db->where('cat_id', $cat_id);
        }
        $this->db->where('child_level', 1);
        $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
        return $query->result_array();
    }
    function get_board_data($board_id, $select='*') {
        $this->db->select($select);
        $this->db->where('board_id', $board_id);
        $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
        return $query->row_array();
    }
    function get_board_count($cat_id) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('cat_id', $cat_id);
        $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
        $row = $query->row();
        return $row->count;
    }
    function get_child_board($board_id, $child_level, $select = '*', $orderby = 'board_order asc') {
        $this->db->select($select);
        $this->db->where('parent_id', $board_id);
        $this->db->where('child_level', $child_level+1);
        $this->db->orderby($orderby);
        $query  = $this->db->get(Config::item('TABLE_FR_BOARDS'));
        return $query->result_array();
    }
    function update_board_stats($board_id) {
        // get real topic count
        $this->db->select('COUNT(*) as count');
        $this->db->where('board_id', $board_id);
        $query  = $this->db->get(Config::item('TABLE_FR_TOPICS'));
        $row    = $query->row();
        $topics = $row->count;
        // get real post count
        $this->db->select('SUM(replies) as count');
        $this->db->where('board_id', $board_id);
        $query = $this->db->get(Config::item('TABLE_FR_TOPICS'));
        $row   = $query->row();
        $posts = $row->count;
        // last topic data
        $this->db->select('last_msg_id');
        $this->db->where('board_id', $board_id);
        $this->db->orderby('last_msg_id desc');
        $this->db->limit(1);
        $query = $this->db->get(Config::item('TABLE_FR_TOPICS'));
        $topic = $query->row();
        // update the board with correct value
        $data = array(
            'topics'         => $topics,
            'posts'          => $posts,
            'last_msg_id'    => $topic->last_msg_id,
            'updated_msg_id' => $topic->last_msg_id,
        );
        $this->db->where('board_id', $board_id);
        $this->db->update(Config::item('TABLE_FR_BOARDS'), $data);
    }
    function get_board_min_order($cat_id, $child_level, $parent_id) {
        $this->db->select('MIN(board_order) as board_order');
        $this->db->where('cat_id', $cat_id);
        $this->db->where('child_level', $child_level);
        $this->db->where('parent_id', $parent_id);
        $this->db->orderby('board_order desc');
        $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
        $row = $query->row();
        return $row->board_order;
    }
    function get_board_max_order($cat_id, $child_level, $parent_id) {
        $this->db->select('MAX(board_order) as board_order');
        $this->db->where('cat_id', $cat_id);
        $this->db->where('child_level', $child_level);
        $this->db->where('parent_id', $parent_id);
        $this->db->orderby('board_order desc');
        $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
        $row = $query->row();
        return $row->board_order;
    }
/**
* ****************************************************
* TOPIC PART
* *****************************************************/
    function insert_topic($board_id, $data) {
        $topic_data = array(
            'is_sticky'         => 0,
            'board_id'          => $board_id,
            'first_msg_id'      => 0,
            'last_msg_id'       => 0,
            'started_member_id' => USER_ID,
            'updated_member_id' => USER_ID,
            'poll_id'           => 0,
            'replies'           => 0,
            'views'             => 0,
            'locked'            => 0,
        );
        $this->db->insert(Config::item('TABLE_FR_TOPICS'), $topic_data);
        $topic_id = $this->db->insert_id();
        $data['topic_id'] = $topic_id;
        $data['board_id'] = $board_id;
        $this->db->insert(Config::item('TABLE_FR_MESSAGES'), $data);
        $msg_id = $this->db->insert_id();
        $this->db->update(Config::item('TABLE_FR_TOPICS'), array('first_msg_id' => $msg_id, 'last_msg_id'  => $msg_id), "topic_id='{$topic_id}'");
        $this->db->update(Config::item('TABLE_FR_BOARDS'), array('last_msg_id' => $msg_id, 'updated_msg_id'  => $msg_id), "board_id='{$board_id}'");
        $this->update_topic_stats($topic_id);
        $this->update_board_stats($board_id);
        return $topic_id;
    }
    function sticky_topic($topic_id) {
        $this->db->select('is_sticky');
        $this->db->where('topic_id', $topic_id);
        $query  = $this->db->get(Config::item('TABLE_FR_TOPICS'));
        $row    = $query->row();
        if ($row->is_sticky == 0) {
            $data = array('is_sticky' => 1);
        } else {
            $data = array('is_sticky' => 0);
        }
        $this->db->update(Config::item('TABLE_FR_TOPICS'), $data, "topic_id='{$topic_id}'");
    }
    function lock_topic($topic_id) {
        $this->db->select('locked');
        $this->db->where('topic_id', $topic_id);
        $query  = $this->db->get(Config::item('TABLE_FR_TOPICS'));
        $row      = $query->row();
        if ($row->locked == 0) {
            $data = array('locked' => 1);
        } else {
            $data = array('locked' => 0);
        }
        $this->db->update(Config::item('TABLE_FR_TOPICS'), $data, "topic_id='{$topic_id}'");
    }
    function delete_topic($topic_id) {
        $topic = $this->get_topic_data($topic_id, 'board_id');
        $this->db->delete(Config::item('TABLE_FR_MESSAGES'), "topic_id='{$topic_id}'");
        $this->db->delete(Config::item('TABLE_FR_TOPICS'), "topic_id='{$topic_id}'");
        $this->db->delete(Config::item('TABLE_FR_NOTIFY'), "topic_id='{$topic_id}'");
        $this->update_board_stats($topic['board_id']);
    }
    function move_topic($topic_id, $data) {
        $topic = $this->get_topic_data($topic_id);
        if ($topic['board_id'] != $data['board_id']) {
            $this->db->update(Config::item('TABLE_FR_TOPICS'), $data, "topic_id='{$topic_id}'");
            $this->update_board_stats($data['board_id']);
            $this->update_board_stats($topic['board_id']);
            return TRUE;
        } else {
            return TRUE;
        }
    }
    function notify_topic($topic_id, $user_id = '') {
        // find if any
        $this->db->select('send');
        $this->db->where('user_id', $user_id ? $user_id : USER_ID);
        $this->db->where('topic_id', $topic_id);
        $query = $this->db->get(Config::item('TABLE_FR_NOTIFY'));
        if ($query->num_rows()) {
            // have
            $row = $query->row();
            $data = array(
                'send' => ($row->send == 1) ? 0 : 1,
            );
            $this->db->where('user_id', $user_id ? $user_id : USER_ID);
            $this->db->where('topic_id', $topic_id);
            $this->db->update(Config::item('TABLE_FR_NOTIFY'), $data);
        } else {
            // not have = create
            $data = array(
                'user_id'  => $user_id ? $user_id : USER_ID,
                'board_id' => 0,
                'topic_id' => $topic_id,
                'send'     => 1,
            );
            $this->db->insert(Config::item('TABLE_FR_NOTIFY'), $data);
        }
    }
    function unnotify_topic($topic_id, $user_id = '') {
        $data = array(
            'user_id'  => $user_id ? $user_id : USER_ID,
            'topic_id' => $topic_id,
            );
        $this->db->delete(Config::item('TABLE_FR_NOTIFY'), $data);
    }
    function set_topic_notify($topic_id, $notify, $user_id = '') {
    // find if any
        $this->db->select('send');
        $this->db->where('user_id', $user_id ? $user_id : USER_ID);
        $this->db->where('topic_id', $topic_id);
        $query = $this->db->get(Config::item('TABLE_FR_NOTIFY'));
        if ($query->num_rows()) {
            // have
            $row = $query->row();
            $data = array(
                'send' => $notify,
            );
            $this->db->where('user_id', $user_id ? $user_id : USER_ID);
            $this->db->where('topic_id', $topic_id);
            $this->db->update(Config::item('TABLE_FR_NOTIFY'), $data);
        } else {
            // not have = create
            $data = array(
                'user_id'  => $user_id ? $user_id : USER_ID,
                'board_id' => 0,
                'topic_id' => $topic_id,
                'send'     => $notify,
            );
            $this->db->insert(Config::item('TABLE_FR_NOTIFY'), $data);
        }
    }
    function topic_notify_recovery($topic_id) {
       $data = array('send'=>1);
       $this->db->where('user_id', USER_ID);
       $this->db->where('topic_id', $topic_id);
       $this->db->update(Config::item('TABLE_FR_NOTIFY'), $data);
    }
    function update_topic_stats($topic_id) {
        global $CONFIG;
         // get real message count
        $this->db->select('COUNT(*) as count');
        $this->db->where('topic_id', $topic_id);
        $query    = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        $row      = $query->row();
        $messages = $row->count;
        // first, last message data
        $this->db->select('msg_id, poster_id');
        $this->db->where('topic_id', $topic_id);
        $this->db->orderby('msg_id asc');
        $this->db->limit(1);
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        $first = $query->row();
        $this->db->select('msg_id, poster_id');
        $this->db->where('topic_id', $topic_id);
        $this->db->orderby('msg_id desc');
        $this->db->limit(1);
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        $last  = $query->row();
        // update
        $data = array(
            'replies'           => ($messages-1),
            'first_msg_id'      => $first->msg_id,
            'last_msg_id'       => $last->msg_id,
            'started_member_id' => $first->poster_id,
            'updated_member_id' => $last->poster_id,
        );
        $this->db->where('topic_id', $topic_id);
        $this->db->update(Config::item('TABLE_FR_TOPICS'), $data);
    }
    function get_topic($board_id, $select = '*', $orderby = 'topic_id asc', $limit1 = '', $limit2 = '') {
        $this->db->select($select);
        $this->db->where('board_id', $board_id);
        $this->db->orderby($orderby);
        if ($limit1 && $limit2) {
            $this->db->limit($limit2, $limit1);
        } elseif ($limit1 && !$limit2) {
            $this->db->limit($limit1);
        }
        $query = $this->db->get(Config::item('TABLE_FR_TOPICS'));
        return $query->result_array();
    }
    function get_topic_data($topic_id, $select = '*') {
        $this->db->select($select);
        $this->db->where('topic_id', $topic_id);
        $query = $this->db->get(Config::item('TABLE_FR_TOPICS'));
        return $query->row_array();
    }
    function get_topic_count($board_id) {
        $this->db->select('count(*) as count');
        $this->db->where('board_id', $board_id);
        $query = $this->db->get(Config::item('TABLE_FR_TOPICS'));
        $row = $query->row();
        return $row->count;
    }
    function get_topic_name($topic_id) {
        $this->db->select('subject');
        $this->db->where('topic_id', $topic_id);
        $this->db->orderby('msg_id asc');
        $this->db->limit(1);
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        $row = $query->row();
        return $row->subject;
    }
    function add_view($topic_id) {
        $this->db->set('views', 'views+1', FALSE);
        $this->db->update(Config::item('TABLE_FR_TOPICS'), array(), "topic_id='{$topic_id}'");
    }
/**
* ****************************************************
* MESSAGE PART
* ****************************************************
*/
    function insert_message($data) {
        $this->db->insert(Config::item('TABLE_FR_MESSAGES'), $data);
        $msg_id = $this->db->insert_id();
        $this->update_topic_stats($data['topic_id']);
        $topic = $this->get_topic_data($data['topic_id'], 'board_id');
        $this->update_board_stats($topic['board_id']);
        return $msg_id;
    }
    function modify_message($msg_id, $data) {
        $this->db->update(Config::item('TABLE_FR_MESSAGES'), $data, "msg_id='{$msg_id}'");
    }
    function delete_message($msg_id) {
        $msg = $this->get_message_data($msg_id, 'topic_id');
        $topic = $this->get_topic_data($msg['topic_id'], 'board_id');
        $this->db->select('count(*) as count');
        $this->db->where('topic_id', $msg['topic_id']);
        $query = $this->db->get(Config::item('TABLE_FR_TOPICS'));
        $row = $query->row();
        $this->db->delete(Config::item('TABLE_FR_MESSAGES'), "msg_id='{$msg_id}'");
        $this->update_topic_stats($msg['topic_id']);
        $this->update_board_stats($topic['board_id']);
    }
    function get_latest_message($n = 5) {
        $this->db->select('topic_id, msg_id, subject, poster_id, poster_name, poster_time');
        $this->db->orderby('msg_id desc');
        global $CONFIG; $this->db->where('1', '1\' AND msg_id IN (SELECT MAX(msg_id) FROM `'.$CONFIG['TABLE_FR_MESSAGES'].'` GROUP BY topic_id) AND 1=\'1');
        $this->db->limit($n);
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        return $query->result_array();
    }
    function get_message($topic_id, $select = '*', $orderby = 'msg_id asc', $limit1 = '', $limit2 = '') {
        $this->db->select($select);
        $this->db->where('topic_id', $topic_id);
        $this->db->limit($limit2, $limit1);
        $this->db->orderby($orderby);
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        return $query->result_array();
    }
    function get_message_data($msg_id, $select = '*') {
        $this->db->select($select);
        $this->db->where('msg_id', $msg_id);
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        return $query->row_array();
    }
    function get_message_number($topic_id, $msg_id) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('topic_id', $topic_id);
        $this->db->where('msg_id<=', $msg_id);
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        $row = $query->row();
        return $row->count;
    }
    function get_message_count($topic_id) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('topic_id', $topic_id);
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        $row = $query->row_array();
        return $row['count'];
    }
    function get_message_pos($topic_id, $msg_id) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('topic_id', $topic_id);
        $this->db->where("msg_id<='{$msg_id}'");
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        $row = $query->row_array();
        return $row['count'];
    }
/**
* ****************************************************
* USER PART
* ****************************************************
*/
    function get_notify_user($board_id = '', $topic_id = '') {
        $this->db->select('user_id');
        if ($board_id) $this->db->where('board_id', $board_id);
        if ($topic_id) $this->db->where('topic_id', $topic_id);
        $this->db->where('send', 1);
        $query = $this->db->get(Config::item('TABLE_FR_NOTIFY'));
        return $query->result_array();
    }
    function get_latest_user($n = 5) {
        $this->db->select('user_id, user_name');
        $this->db->orderby('user_id desc');
        $this->db->limit($n);
        $query = $this->db->get(Config::item('TABLE_USERS'));
        return $query->result_array();
    }
    function get_active_user() {
        $this->db->select('user_id');
        $this->db->orderby('time desc');
        $this->db->where('user_id >', 0);
        $this->db->where('time >', time()-Config::item('fr_time_online_checking')*60);
        $this->db->limit($n);
        $query = $this->db->get(Config::item('TABLE_PREFIX').'sessions');
        $rowset = $query->result_array();
        $n = count($rowset);
        for ($i=0;$i<$n;$i++) {
            for ($j=$i+1;$j<=$n;$j++) {
                if ($rowset[$i]['user_id'] == $rowset[$j]['user_id']) {
                    unset($rowset[$j]);
                }
            }
        }
        foreach ($rowset as $key => $row) {
            $rowset[$key]['user_name'] = get_username($row['user_id']);
        }
        return $rowset;
    }
    function get_user_data($user_id = USER_ID, $select = '*') {
        $this->db->select($select);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get(Config::item('TABLE_USERS'));
        return $query->row_array();
    }
    function get_user_avatar($user_id = USER_ID) {
        $this->db->select('fr_avatar');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get(Config::item('TABLE_USERS'));
        $row = $query->row();
        if ($row->fr_avatar) {
            return $row->fr_avatar;
        } else {
            return 'plugins/forum/forum/html/images/default_avatar.png';
        }
    }
    function edit_profile($user_id, $data) {
        $this->db->update(Config::item('TABLE_USERS'), $data, "user_id='{$user_id}'");
    }
    function get_user_post_count($user_id = USER_ID) {
        $user_id = (int)$user_id;
        $this->db->select('COUNT(*) as count');
        $this->db->where('poster_id', $user_id);
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        $row = $query->row();
        return $row->count;
    }
    function get_last_visit_time($user_id = USER_ID) {
        $user_id = (int)$user_id;
        $this->db->select('user_lastvisit');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get(Config::item('TABLE_USERS'));
        $row = $query->row();
        return time::decode(strtotime($row->user_lastvisit));
    }
    function get_group_name($user_id = USER_ID) {
        if (USER_ID == $user_id) {
            global $USER_DATA;
            return $USER_DATA['group_name'];
        } else {
            $this->db->select('user_group');
            $this->db->where('user_id', $user_id);
            $query = $this->db->get(Config::item('TABLE_USERS'));
            $row = $query->row();
            $group_id = $row->user_group;
            $this->db->select('group_name');
            $this->db->where('group_id', $group_id);
            $query = $this->db->get(Config::item('TABLE_USERGROUPS'));
            $row = $query->row();
            return $row->group_name;
        }
    }
    function get_user_signature($user_id = USER_ID) {
        $this->db->select('fr_signature');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get(Config::item('TABLE_USERS'));
        $row = $query->row();
        return $row->fr_signature;
    }
    function get_registed_time($user_id = USER_ID) {
        $row = $this->get_user_data($user_id, 'user_regdate');
        return date('d.m.Y', strtotime($row['user_regdate']));

    }
/**
* ****************************************************
* SEARCH
* ****************************************************
*/
    function get_search_result($search, $select = '*', $limit1 = '', $limit2 = '') {
         $keywords = explode(" ", $search);
         $keywords = array_diff($keywords, array(""));
         $fields = array();
         $this->db->select($select);
         foreach ($keywords as $keyword) {
            $this->db->orwhere("subject LIKE '%$keyword%'");
            $this->db->orwhere("body LIKE '%$keyword%'");
         }
         if ($limit1 && $limit2) {
            $this->db->limit($limit2, $limit1);
        } elseif ($limit1 && !$limit2) {
            $this->db->limit($limit1);
        }
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        return $query->result_array();
    }
    function get_search_result_count($search) {
        $keywords = explode(" ", $search);
        $keywords = array_diff($keywords, array(""));
        $fields = array();
        $this->db->select('COUNT(*) as count');
        foreach ($keywords as $keyword) {
            $this->db->orwhere("subject LIKE '%$keyword%'");
            $this->db->orwhere("body LIKE '%$keyword%'");
        }
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        $row = $query->row();
        return $row->count;
    }
    function get_xxx_topic($xxx, $select = '*', $limit1 = '', $limit2 = '') {
        $this->db->select($select);
        if ($limit1 && $limit2) {
            $this->db->limit($limit2, $limit1);
        } elseif ($limit1 && !$limit2) {
             $this->db->limit($limit1);
        }
        switch ($xxx) {
            case 'new':
                $this->db->orderby(Config::item('TABLE_FR_TOPICS').'.topic_id DESC');
                break;
            case 'active':
                $this->db->orderby(Config::item('TABLE_FR_TOPICS').'.topic_id DESC');
                break;
            case 'pending':
                $this->db->orderby(Config::item('TABLE_FR_TOPICS').'.topic_id DESC');
                break;
        }
        $this->db->join(Config::item('TABLE_FR_MESSAGES'), Config::item('TABLE_FR_TOPICS').'.first_msg_id='.Config::item('TABLE_FR_MESSAGES').'.msg_id');
        $query = $this->db->get(Config::item('TABLE_FR_TOPICS'));
        if ($query->num_rows() == 1) {
            $row = $query->row_array();
            return $row['count'];
        } else {
            return $query->result_array();
        }
    }
    function get_new_topic($select = '*', $limit1 = '', $limit2 = '') {
        return $this->get_xxx_topic('new', $select, $limit1, $limit2);
    }
    function get_active_topic($select = '*', $limit1 = '', $limit2 = '') {
        return $this->get_xxx_topic('active', $select, $limit1, $limit2);
    }
    function get_pending_topic($select = '*', $limit1 = '', $limit2 = '') {
        return $this->get_xxx_topic('pending', $select, $limit1, $limit2);
    }
}
