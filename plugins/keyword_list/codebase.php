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
  Coppermine version: 1.4.9
  $Source$
  $Revision: 3125 $
  $Author: gaugau $
  $Date: 2006-06-16 08:48:03 +0200 (Fr, 16 Jun 2006) $
**********************************************/
/*********************************************
  Modified by Frantz for keyword_list version 2.0 plugin
  Fixing keyword_list button positioning by B.Mossavari (Sami)
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
require ('plugins/keyword_list/include/init.inc.php');


// User menus , (fixed by Sami)
$thisplugin->add_action('page_start','keyword_list_page_start');

// create button template from current sys menu template (added by Sami)
function keyword_list_add_admin_button($href,$title,$target,$link)
{
  global $template_sys_menu, $template_sys_menu_spacer;
require ('plugins/keyword_list/include/init.inc.php');
  $new_template=$template_sys_menu;
  $button=template_extract_block($new_template,'faq');
  
   $params = array(
      '{FAQ_LNK}' => $target,
      '{FAQ_TITLE}' => $title,
      '{FAQ_TGT}' => $href,
      'faq' => $link,
   );
   $new_button="<!-- BEGIN $link -->".template_eval($button,$params)."<!-- END $link -->\n";
   template_extract_block($template_sys_menu,'faq',"<!-- BEGIN faq -->" . $button . "<!-- END faq -->\n" .$new_button);
}

// Add photo_summary button after home under sys menu (added by Sami)
function keyword_list_page_start()
{
  
  	global $template_sys_menu, $template_sys_menu_spacer, $template_sys_menu_button, $sys_menu_buttons;
    global $CONFIG, $lang_plugin_keyword_list;

    require ('plugins/keyword_list/include/init.inc.php');
  	  	//if(USER_ID){//uncomment this line if you will only registred users to see the link
  		keyword_list_add_admin_button('index.php?file=keyword_list/keyword',$lang_plugin_keyword_list['menu_link'],$lang_plugin_keyword_list['menu_link'],$lang_plugin_keyword_list['menu_link']);
//}//uncomment this line if you will only registred users to see the link
}

?>