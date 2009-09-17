<?php

class Controller {
    function Controller() {    
        $this->validate = Inspekt::makeSuperCage();
        $this->db       = Database::getInstance(array('conn_id'=>Config::item('LINK_ID')));
        $this->view     = new View;
        // auto load helper
        load_helper(array('php','time','html','form','table','forum'));
        // load forum model
        load_model('forum', FALSE);
        load_model('check', FALSE);
        $this->forum = forum_model::getInstance();
    }
}