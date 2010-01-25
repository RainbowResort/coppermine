<?php
/**************************************************
  Coppermine 1.5.x Plugin - keywords_add
  *************************************************
  Copyright (c) coppermine dev team
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

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('plugin_install','keywords_add_install');
$thisplugin->add_action('plugin_configure','keywords_add_configure');


$thisplugin->add_action('page_start','keywords_add_page_start');
// Install function
// Checks if uid is 'me' and pwd is 'you'; If so, then install the plugin
function keywords_add_install() {

    // Install
    if ($_POST['submit']==$lang_plugin_keywords_add_config['button_install']) {

        return true;

    // Loop again
    } else {

        return 1;
    }
}

// Configure function
// Displays the form
function keywords_add_configure() {
    global $CONFIG, $lang_plugin_keywords_add, $lang_plugin_keywords_add_config;
	require ('plugins/keywords_add/include/init.inc.php');

	echo <<< EOT
		<h2>{$lang_plugin_keywords_add['install_click']}</h2>
		{$lang_plugin_keywords_add['install_note']}<br />
		<br />
		<form action="{$_SERVER['REQUEST_URI']}" method="post">
		<input type="submit" value="{$lang_plugin_keywords_add_config['button_install']}" name="submit" />
		</form>
EOT;
}
// add config button
function keywords_add_config_button($href,$title,$target,$link)
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
function keywords_add_page_start()
{
	global $CONFIG, $lang_plugin_keywords_add, $lang_plugin_keywords_add_config, $lang_plugin_keywords_add_manage, $FEX,$lang_plugin_keywords_add_delete;
	require ('plugins/keywords_add/include/init.inc.php');
	

	if (GALLERY_ADMIN_MODE) {
		keywords_add_config_button('index.php?file=keywords_add/plugin_config',$lang_plugin_keywords_add['config_title'],'',$lang_plugin_keywords_add['config_button']);
	}

}
?>
