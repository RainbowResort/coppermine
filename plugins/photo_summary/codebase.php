<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2006 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  
  $Source$
  $Revision: 3125 $
  $Author: gaugau $
  $Date: 2006-06-16 08:48:03 +0200 (Fr, 16 Jun 2006) $
**********************************************/
/*********************************************
 Ported to cpg1.5.x by Frantz
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
require ('plugins/photo_summary/include/init.inc.php');


// User menus , (fixed by Sami)
$thisplugin->add_action('page_start','photo_summary_page_start');

// create button template from current sys menu template (added by Sami)
function photo_summary_add_admin_button($href,$title,$target,$link)
{
  global $template_sys_menu, $template_sys_menu_spacer;
require ('plugins/photo_summary/include/init.inc.php');
  $new_template=$template_sys_menu;
  $button=template_extract_block($new_template,'upload_pic');
  
   $params = array(
      '{UPL_PIC_LNK}' => $target,
      '{UPL_PIC_TITLE}' => $title,
      '{UPL_PIC_TGT}' => $href,
      'upload_pic' => $link,
   );
   $new_button="<!-- BEGIN $link -->".template_eval($button,$params)."<!-- END $link -->\n";
   template_extract_block($template_sys_menu,'upload_pic',"<!-- BEGIN upload_pic -->" . $button . "<!-- END upload_pic -->\n" .$new_button);
}


// Add photo_summary button after home under sys menu (added by Sami)
function photo_summary_page_start()
{
  
  	global $template_sys_menu, $template_sys_menu_spacer, $template_sys_menu_button, $sys_menu_buttons;
    global $CONFIG, $lang_plugin_photo_summary;

    require ('plugins/photo_summary/include/init.inc.php');
  	  	//if(USER_ID){//uncomment this line if you will only registred users to see the link
  		photo_summary_add_admin_button('index.php?file=photo_summary/summary',$lang_plugin_photo_summary['menu_link'],$lang_plugin_photo_summary['menu_link'],$lang_plugin_photo_summary['menu_link']);
//}//uncomment this line if you will only registred users to see the link
}

?>