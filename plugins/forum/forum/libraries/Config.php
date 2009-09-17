<?php
class Config {
    function item($item) {
        static $instance = array();
        if (empty($instance['config'])) {
            global $CONFIG;
            $instance['config'] = & $CONFIG;
        }
        return $instance['config'][$item];
    }
    function set($item, $value) {
        global $CONFIG;
        $CONFIG[$item] = $value;
    }
}