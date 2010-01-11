<?php
/**************************************************
  Coppermine 1.5.x Plugin - Mirror
  *************************************************
  Copyright (c) 2010 Timo Schewe (www.timos-welt.de)
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
  
if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}

$thisplugin->add_action('plugin_install','mirror_install');
$thisplugin->add_action('plugin_configure','mirror_configure');
$thisplugin->add_action('page_start','include_js_mirrorplug');

function mirror_install() {
    global $CONFIG;
    $superCage = Inspekt::makeSuperCage();

	// Check for the transparent overlay
	if ($CONFIG['transparent_overlay'] != '0') {
		 if ($superCage->post->keyExists('mirror_continue_anyway') == TRUE && $superCage->post->getInt('mirror_continue_anyway') == 1) {
		     $CONFIG['transparent_overlay'] = '0';
		     cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='0' WHERE name='transparent_overlay'");
		 } else {
		    return 1;
		}
	}
	
	// Check for the image_manipulation plugin
	if (($plugin_id = CPGPluginAPI::installed('image_manipulation'))!==false) {
		 return 1;
	}
	
    return true;
}

function mirror_configure() {
    global $CONFIG, $CPG_PLUGINS;
    $icon_array['ok'] = cpg_fetch_icon('ok', 1);
    $icon_array['cancel'] = cpg_fetch_icon('cancel', 1);
    $allow_continue = 1;
    echo <<< EOT
    <form action="" method="post" name="mirror_config" id="mirror_config">
        <ul>
EOT;
    if ($CONFIG['transparent_overlay'] != '0') {
        echo <<< EOT
            <li>The mirror plugin doesn't work with the config option '<em>Insert a transparent overlay to minimize image theft</em>'. If you decide to continue, that option will be disabled for you. Don't turn it back on while using this plugin.</li>
EOT;
    }
    if (($plugin_id = CPGPluginAPI::installed('image_manipulation')) !== false) {
        echo <<< EOT
            <li>You have installed the plugin '<em>Image Manipulation (image_manipulation)</em>' that can't be run at the same time with the Mirror plugin. Return to the plugin manager and uninstall that other plugin first before installing this plugin.</li>
EOT;
        $allow_continue = 0;
    }
    echo <<< EOT
        </ul>
EOT;
    if ($allow_continue == 1) {
        echo <<< EOT
        <input type="hidden" name="mirror_continue_anyway" id="mirror_continue_anyway" value="1" />
        <button type="submit" class="button" name="submit" value="Continue anyway">{$icon_array['ok']}Continue anyway</button>
EOT;
    }
    echo <<< EOT
        <a href="pluginmgr.php" class="admin_menu">{$icon_array['cancel']}Cancel</a>
EOT;
    echo <<< EOT
    </form>
EOT;
}

function include_js_mirrorplug() {
    global $JS, $CPG_PHP_SELF;
    $mirror_pages_array = array('displayimage.php');
    if (in_array($CPG_PHP_SELF, $mirror_pages_array) == TRUE)
    {  
        $JS['includes'][] = 'plugins/mirror/mirror.js';
    }
}

?>