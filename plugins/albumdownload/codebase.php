<?php
require_once "./plugins/albumdownload/initialize.inc.php";

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Add install & configure actions
$thisplugin->add_action('plugin_install','downloadZip_install');
$thisplugin->add_action('plugin_configure','downloadZip_configure');

// Add a filter for the thumbnail header
$thisplugin->add_filter('theme_thumbnails_title','downloadZip_header');

// Modify template header
function downloadZip_header($html) {
	$lang_plugin_albumdownload = albumdownload_language();
    $superCage = Inspekt::makeSuperCage();
    if ($superCage->get->getInt('album') > 0) {
        $html['{ALBUM_NAME}'] = $html['{ALBUM_NAME}'] . ' <a href="index.php?file=albumdownload/albumZip&aid='.$superCage->get->getInt('album').'">'.$lang_plugin_albumdownload['albumDownload'].'</a>';
    }
	return $html;
}

// Install the plugin
function downloadZip_install() {
    
   
  $superCage = Inspekt::makeSuperCage(); 

    $submit_code = '';
    if ($superCage->post->keyExists('submit')) {
      $submit_code = $superCage->post->getEscaped('submit');
    }
    if (!$submit_code) {
        return 1;  // configure function has not been called yet, so return error code '1'
    } elseif ($submit_code == 'Yes') {
        return true;  // configure function has been called, so install the plugin
    } elseif ($submit_code == 'No')  {
        header("Location: pluginmgr.php\n\n");  // go back to plugin manager without installing the plugin
        exit(0);
    } elseif ($submit_code == 'Simulate critical error') {
        return false;  // simulate a critical error by returning false
    } else {
        return 2;  // user is not sure whether to install yet, so return error code '2'
    }
}

// Configure function: displays the configuration form
function downloadZip_configure($action_code) {
    global $thisplugin;
    if ($action_code == 2) {
        echo 'Ok, I hope you\'ve had enough time to decide now.<br />';
    }
    if (($action_code === 1) || ($action_code == 2)) {
        echo <<< EOT

            <h3>Do you want to install plugin <b>{$thisplugin->name}</b>?</h3>
            <form action="{$_SERVER['REQUEST_URI']}" method="post">

            <input type="submit" name="submit" value="Yes" />
            <input type="submit" name="submit" value="No" />
            </form>

EOT;
    }
}?>