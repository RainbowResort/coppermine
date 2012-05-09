<?php

function albumdownload_language() {
    global $CONFIG, $lang_plugin_albumdownload;

    require "./plugins/albumdownload/lang/english.php";
    if ($CONFIG['lang'] != 'english' && file_exists("./plugins/albumdownload/lang/{$CONFIG['lang']}.php")) {
        require "./plugins/albumdownload/lang/{$CONFIG['lang']}.php";
    }
    return $lang_plugin_albumdownload;
}

?>