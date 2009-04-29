<?php

// Initialize language and icons
require_once './plugins/thumb_rotate/init.inc.php';
$thumb_rotate_init_array = thumb_rotate_initialize();
$lang_plugin_thumb_rotate = $thumb_rotate_init_array['language']; 
$thumb_rotate_icon_array = $thumb_rotate_init_array['icon'];
// Configuration
pageheader($lang_plugin_thumb_rotate['config']);
thumb_rotate_configure();
pagefooter();
die;
?>