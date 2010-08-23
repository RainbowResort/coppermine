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

class check_model extends Model {
    function check_model() {    
        parent::Model();
        $this->validate = Inspekt::makeSuperCage();
    }
    // singleton 
    function & getInstance() {
        static $instance = array();
        if (!is_object($instance[0])) {
            $instance[0] = & new check_model();
        }
        return $instance[0];
    }
    function is_admin() {
        if (GALLERY_ADMIN_MODE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function is_user() {
        if (USER_ID) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function double_post() {
        if (Config::item('fr_gap_time') == 0 || GALLERY_ADMIN_MODE) return FALSE; 
        $time = time();
        $allow_time = $time - Config::item('fr_gap_time');
        $this->db->where('poster_id', USER_ID);
        $this->db->where('poster_time', $allow_time);
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        if ((int)$query->num_rows() != 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function is_cat_id($cat_id) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('cat_id', $cat_id);
        $query = $this->db->get(Config::item('TABLE_FR_CATEGORIES'));
        $row = $query->row();
        if ((int)$row->count == 0) {
            return FALSE; 
        } else {
            return TRUE;
        }
    }
    function is_board_id($board_id) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('board_id', $board_id);
        $query = $this->db->get(Config::item('TABLE_FR_BOARDS'));
        $row = $query->row();
        if ((int)$row->count == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    function is_topic_id($topic_id) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('topic_id', $topic_id);
        $query = $this->db->get(Config::item('TABLE_FR_TOPICS'));
        $row = $query->row();
        if ((int)$row->count == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    function is_msg_id($msg_id) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('msg_id', $msg_id);
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        $row = $query->row();
        if ((int)$row->count == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    function is_notify_topic($topic_id) {
        $this->db->select('send');
        $this->db->where('user_id', USER_ID);
        $this->db->where('topic_id', $topic_id);
        $query = $this->db->get(Config::item('TABLE_FR_NOTIFY'));
        if ($query->num_rows() > 0) {
            $row = $query->row();
            if ($row->send == 1) return TRUE;
            else return FALSE;
        } else {
            return FALSE;
        }
    }
    function is_notify_board($board_id) {
        $this->db->select('send');
        $this->db->where('user_id', USER_ID);
        $this->db->where('board_id', $board_id);
        $query = $this->db->get(Config::item('TABLE_FR_NOTIFY'));
        if ($query->num_rows() > 0) {
            $row = $query->row();
            if ($row->send == 1) return TRUE;
            else return FALSE;
        } else {
            return FALSE;
        }
    }
    function is_locked($topic_id) {
        $this->db->select('locked');
        $this->db->where('topic_id', $topic_id);
        $query = $this->db->get(Config::item('TABLE_FR_TOPICS'));
        $row = $query->row();
        if ((int)$row->locked == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function is_sticky($topic_id) {
        $this->db->select('is_sticky');
        $this->db->where('topic_id', $topic_id);
        $query = $this->db->get(Config::item('TABLE_FR_TOPICS'));
        $row = $query->row();
        if ((int)$row->is_sticky == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function is_msg_owner() {
        // to-do:
    }
    function can_access_forum() {
        if (USER_ID) {
            return TRUE;
        } else {
            if (Config::item('fr_guest_browse') == 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
    function can_access_topic($topic_id) {
        $authorizer = check_model::getInstance();        
        return $authorizer->can_access_forum();
    }
    function can_moderator_topic() {
        if (GALLERY_ADMIN_MODE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function can_create_topic($board_id) {
        if (USER_ID) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function can_reply($topic_id) {
        if (GALLERY_ADMIN_MODE) {
            return TRUE;
        } else {
            if (USER_ID) {
                $authorizer = check_model::getInstance();                
                if ($authorizer->is_locked($topic_id)) {
                    return FALSE;
                } else {
                    return TRUE;
                }
            } else {
                if (Config::item('fr_guest_post') == 1) {
                    $authorizer = check_model::getInstance();                
                    if ($authorizer->is_locked($topic_id)) {
                        return FALSE;
                    } else {
                        return TRUE;
                    }
                } else {
                    return FALSE;
                }
            }
        }
    }
    function can_edit_msg($msg_id) {
        // own message
        $this->db->select('poster_id');
        $this->db->where('msg_id', $msg_id);
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        $row = $query->row();
        if ($row->poster_id == USER_ID) {
            $authorizer = check_model::getInstance();
            return $authorizer->can_edit_own_msg();
        } else {
            if (GALLERY_ADMIN_MODE) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
    function can_edit_own_msg() {
        if (USER_ID) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function can_delete_msg($msg_id) {
        // own message
        $this->db->select('poster_id');
        $this->db->where('msg_id', $msg_id);
        $query = $this->db->get(Config::item('TABLE_FR_MESSAGES'));
        $row = $query->row();
        if ($row->poster_id == USER_ID) {
            $authorizer = check_model::getInstance();
            return $authorizer->can_delete_own_msg();
        } else {
            if (GALLERY_ADMIN_MODE) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
    function can_delete_own_msg() {
        if (USER_ID) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function can_move_topic($topic_id) {
        if (GALLERY_ADMIN_MODE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function can_delete_topic($topic_id) {
        if (GALLERY_ADMIN_MODE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}