<?php
/**************************************************
  Coppermine 1.5.x Plugin - FileMove
  *************************************************
  Copyright (c) 2003-2010 Coppermine Dev Team
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
require ('./plugins/FileMove/include/init.inc.php');
$thisplugin->add_action('page_start','FileMove_page_start');

// add config button
function FileMove_config_button($href,$title,$target,$link)
{
  global $template_gallery_admin_menu;

  $new_template = $template_gallery_admin_menu;
  $button = template_extract_block($new_template,'update_database');
  $params = array(
      'update.php' => $href,
      '{UPDATE_DATABASE_TITLE}' => $title,
      'target="cpg_documentation"' => $target,
      '{UPDATE_DATABASE_LNK}' => $link,
      '{UPDATE_DATABASE_ICO}' => cpg_fetch_icon('download', 1),
   );
   $new_button="<!-- BEGIN $link -->".template_eval($button,$params)."<!-- END $link -->\n";
   template_extract_block($template_gallery_admin_menu,'update_database',"<!-- BEGIN update_database -->" . $button . "<!-- END update_database -->\n" . $new_button);
}
// add admin button to start of each page
function FileMove_page_start()
{
    global $CONFIG, $lang_plugin_FileMove ;
    require ('./plugins/FileMove/include/init.inc.php');
    $icon = cpg_fetch_icon('download', 1);

    if (GALLERY_ADMIN_MODE) {
        FileMove_config_button('index.php?file=FileMove/plugin_config',$lang_plugin_FileMove['config_title'],'',$lang_plugin_FileMove['config_button']);
    }

}
?>
