<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2005 Coppermine Dev Team
  v1.1 originaly written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.4.8
  $Source: /cvsroot/cpg-contrib/master_template/codebase.php,v $
  $Revision: 1.3 $
  $Author: donnoman $
  $Date: 2005/12/08 05:46:49 $
**********************************************/
/**********************************************
Modified by Frantz for FileMove plugin
2007/07/19
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('plugin_install','FileMove_install');
$thisplugin->add_action('plugin_configure','FileMove_configure');


$thisplugin->add_action('page_start','FileMove_page_start');
// Install function
// Checks if uid is 'me' and pwd is 'you'; If so, then install the plugin
function FileMove_install() {

    // Install
    if ($_POST['submit']==$lang_plugin_FileMove_config['button_install']) {

        return true;

    // Loop again
    } else {

        return 1;
    }
}

// Configure function
// Displays the form
function FileMove_configure() {
    global $CONFIG, $lang_plugin_FileMove, $lang_plugin_FileMove_config;
	require ('plugins/FileMove/include/init.inc.php');

	echo <<< EOT
		<h2>{$lang_plugin_FileMove['install_click']}</h2>
		{$lang_plugin_FileMove['install_note']}<br />
		<br />
		<form action="{$_SERVER['REQUEST_URI']}" method="post">
		<input type="submit" value="{$lang_plugin_FileMove_config['button_install']}" name="submit" />
		</form>
EOT;
}
// add config button
function FileMove_config_button($href,$title,$target,$link)
{
  global $template_gallery_admin_menu;

  $new_template = $template_gallery_admin_menu;
  $button = template_extract_block($new_template,'documentation');
  $params = array(
      '{DOCUMENTATION_HREF}' => $href,
      '{DOCUMENTATION_TITLE}' => $title,
      'target="cpg_documentation"' => $target,
      '{DOCUMENTATION_LNK}' => $link,
   );
   $new_button="<!-- BEGIN $link -->".template_eval($button,$params)."<!-- END $link -->\n";
   template_extract_block($template_gallery_admin_menu,'documentation',"<!-- BEGIN documentation -->" . $button . "<!-- END documentation -->\n" . $new_button);
}
// add admin button to start of each page
function FileMove_page_start()
{
	global $CONFIG, $lang_plugin_FileMove ;
	require ('plugins/FileMove/include/init.inc.php');
	

	if (GALLERY_ADMIN_MODE) {
		FileMove_config_button('index.php?file=FileMove/plugin_config',$lang_plugin_FileMove['config_title'],'',$lang_plugin_FileMove['config_button']);
	}

}
?>
