<?php

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

require_once "./plugins/albumdownload/initialize.inc.php";

// Add a filter for the thumbnail header
$thisplugin->add_filter('theme_thumbnails_title','downloadZip_header');

// Modify template header
function downloadZip_header($html) {
    $lang_plugin_albumdownload = albumdownload_language();
    $superCage = Inspekt::makeSuperCage();
    if ($superCage->get->getInt('album') > 0) {
        $imgcode = '<img src="plugins/albumdownload/ico/ziparrow.png" alt="'.$lang_plugin_albumdownload['albumDownload'].'" title="'.$lang_plugin_albumdownload['albumDownload'].'" style="vertical-align:text-top;" />';
        $html['{ALBUM_NAME}'] = $html['{ALBUM_NAME}'] . ' <a href="index.php?file=albumdownload/albumZip&aid='.$superCage->get->getInt('album').'">'.$imgcode.'</a>';
    }
    return $html;
}

?>