<?php
/**********************************************
  Coppermine 1.4 Plugin - Google Anylytics
  *********************************************
  Copyright (c) 2009
  
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.4
  $Author: papukaija $
**********************************************/
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('plugin_install','analytics_install');
$thisplugin->add_action('plugin_configure','analytics_configure');
$thisplugin->add_action('plugin_uninstall','analytics_uninstall');
$thisplugin->add_action('plugin_cleanup','analytics_cleanup');
$thisplugin->add_filter('gallery_footer','analytics_footer');

function analytics_footer($html) {
	global $CONFIG;
	if (isset($_COOKIE[$CONFIG['cookie_name'].'_ga-stats'])) {
			$stats = $_COOKIE[$CONFIG['cookie_name'].'_ga-stats'];
		}
	else {
		if (!GALLERY_ADMIN_MODE){
			$stats = "yes";
		}
	}
	
	if ($stats=="yes") {
		$html = <<< EOT
		<script type="text/javascript">
   	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
   	document.write(unescape("%3Cscript src='" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
   	</script>
   	<script type="text/javascript">
   	var pageTracker = _gat._getTracker("{$CONFIG['plugin_analytics_trackerid']}");
   	pageTracker._initData();
   	pageTracker._trackPageview();
   	</script>
EOT;
		return $html;
	}
}

function analytics_install() {
    global $CONFIG, $lang_plugin_analytics_config;
    require ('plugins/google_analytics/include/init.inc.php');
		
		if($_POST['submit'] == $lang_plugin_analytics_config['button_install']){
			// delete previous plugin config options if necessary (just in case)
			cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='plugin_analytics_trackerid'");
			
			$trackerid = $_POST['trackerid'];
			$sql="INSERT INTO ".$CONFIG['TABLE_CONFIG']." VALUES ('plugin_analytics_trackerid', '$trackerid');";
			cpg_db_query($sql);
			return true;
		}
		else {
        return 1;
		}
}

function analytics_configure() {
	global $CONFIG, $lang_plugin_analytics_config;
	require ('plugins/google_analytics/include/init.inc.php');
    echo <<< EOT
    <form name="cpgform" id="cpgform" action="{$_SERVER['REQUEST_URI']}" method="post">
            <table border="0" cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td class="tableb" align="right">
                  Google Analytics tracker id:
                </td>
                <td class="tableb">
                  <input type="text" name="trackerid" class="textinput" value="UA-1234567-8" style="width:100%" />
                </td>
              </tr>
              <tr>
                <td class="tablef" colspan="2">
						<input type="submit" name="submit" value="{$lang_plugin_analytics_config['button_install']}" />
						<input type="button" name="cancel" onclick="window.location='pluginmgr.php';" value="{$lang_plugin_analytics_config['button_cancel']}" />
                </td>
              </tr>
            </table>
    </form>
EOT;
}

function analytics_uninstall() {
	global $CONFIG;

	if (!isset($_POST['remove'])) return 1;

	if ($_POST['remove']) {
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='plugin_analytics_trackerid'");
        setcookie($CONFIG['cookie_name'].'_ga-stats', "no", time() - 60 * 10, $CONFIG['cookie_path']);
	}

    return true;
}

function analytics_cleanup($action) {
    global $lang_plugin_analytics_config;
    require ('plugins/google_analytics/include/init.inc.php');

    if ($action === 1) {
        echo <<< EOT
    <form action="{$_SERVER['REQUEST_URI']}" method="post">
        <p>
            {$lang_plugin_analytics_config['cleanup_question']}<br />
            <font color="red">{$lang_plugin_analytics_config['cleanup_note']}</font>
        </p>
        <div style="margin:25;">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><input type="radio" name="remove" value="1" /></td>
                <td>{$lang_yes}</td>
            </tr>
            <tr>
                <td><input type="radio" name="remove" checked="checked" value="0" /></td>
                <td>{$lang_no}</td>
            </tr>
        </table>
        </div>
        <br />
        <span>
           <input type="submit" name="submit" value="{$lang_plugin_analytics_config['button_submit']}" />
           <input type="button" name="cancel" onClick="window.location='pluginmgr.php';" value="{$lang_plugin_analytics_config['button_cancel']}" />
        </span>
    </form>
EOT;
    }
}
?>
