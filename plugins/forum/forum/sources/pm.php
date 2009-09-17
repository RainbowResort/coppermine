<?php
if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }
class pm_controller extends Controller {
    function topic() {
        parent::Controller();
    }
    function index() {
        $vars = array();
        $this->view->render('pm/index', $vars);
    }
    function compose() {
        $vars = array();
        $this->view->render('pm/compose', $vars);
    }
    function reply() {
    }
    function delete() {
    }
}