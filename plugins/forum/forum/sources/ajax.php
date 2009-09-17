<?php
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