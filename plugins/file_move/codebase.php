<?php
/******************************
  Coppermine Plugin "File Move"
  *****************************
  Copyright (c) 2003-2009 François Keller

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  ********************************************
  Coppermine version: 1.5.x
  $Source: /cvsroot/cpg-contrib/master_template/codebase.php,v $
  $Revision: 1.3 $
  $Author: donnoman $
  $Date: 2005/12/08 05:46:49 $
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('plugin_install','file_move_install');
$thisplugin->add_action('plugin_configure','file_move_configure');


$thisplugin->add_action('page_start','file_move_page_start');
// Install function
// Checks if uid is 'me' and pwd is 'you'; If so, then install the plugin
function file_move_install() {
    global $lang_plugin_file_move_config;
    $superCage = Inspekt::makeSuperCage();
    // Install
    if ($superCage->post->keyExists('submit') && $superCage->post->getRaw('submit') == $lang_plugin_file_move_config['button_install']) {
        return true;
    // Loop again
    } else {
        return 1;
    }
}

// Configure function
// Displays the form
function file_move_configure() {
    global $CONFIG, $lang_plugin_file_move, $lang_plugin_file_move_config;
    $superCage = Inspekt::makeSuperCage();
	require ('plugins/file_move/include/init.inc.php');
	$request_uri = $superCage->server->getEscaped('REQUEST_URI');

	echo <<< EOT
		<h2>{$lang_plugin_file_move['install_click']}</h2>
		{$lang_plugin_file_move['install_note']}<br />
		<br />
		<form action="{$request_uri}" method="post">
		<input type="submit" value="{$lang_plugin_file_move_config['button_install']}" name="submit" />
		</form>
EOT;
}
// add config button
function file_move_config_button($href,$title,$target,$link)
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
function file_move_page_start()
{
	global $CONFIG, $lang_plugin_file_move ;
	require ('plugins/file_move/include/init.inc.php');
	

	if (GALLERY_ADMIN_MODE) {
		file_move_config_button('index.php?file=file_move/plugin_config',$lang_plugin_file_move['config_title'],'',$lang_plugin_file_move['config_button']);
	}

}
?>
