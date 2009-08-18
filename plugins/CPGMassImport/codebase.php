<?php
/*************************
  mass_import Plugin for cpg1.5.x
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (GALLERY_ADMIN_MODE) $thisplugin->add_action('page_start', 'mass_import_start');

function mass_import_add_admin_button($href,$title,$target,$link)
{
  global $template_gallery_admin_menu;

  $new_template=$template_gallery_admin_menu;
  $button=template_extract_block($new_template,'documentation');
  $params = array(
      '{DOCUMENTATION_HREF}' => $href,
      '{DOCUMENTATION_TITLE}' => $title,
      'target="cpg_documentation"' => $target,
      '{DOCUMENTATION_LNK}' => $link,
   );
   $new_button="<!-- BEGIN $link -->".template_eval($button,$params)."<!-- END $link -->\n";
   template_extract_block($template_gallery_admin_menu,'documentation',"<!-- BEGIN documentation -->" . $button . "<!-- END documentation -->\n" . $new_button);
}

function mass_import_start($html) {
	global $template_gallery_admin_menu, $lang_plugin_mass_import;
	
	if (file_exists("plugins/mass_import/lang/{$CONFIG['lang']}.php")) {
		require "plugins/mass_import/lang/{$CONFIG['lang']}.php";
	} else require 'plugins/mass_import/lang/english.php';
	
	mass_import_add_admin_button('index.php?file=mass_import/import',$lang_plugin_mass_import['description'],'',$lang_plugin_mass_import['admin_title']);
}



?>