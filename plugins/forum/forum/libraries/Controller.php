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