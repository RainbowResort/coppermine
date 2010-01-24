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
class ajax_controller extends Controller {
    function ajax_controller() {
        parent::Controller();
    }
    function previewmessage() {
        $vars['subject'] = $this->validate->post->getRaw('subject');
        $vars['body'] = forum::format_message($this->validate->post->getRaw('body'));
        echo $vars['subject'].'|_|'.$vars['body'];
    }
}