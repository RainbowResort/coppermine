<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
// Initialize language and iconsrequire_once './plugins/newsletter/init.inc.php';
$newsletter_init_array = newsletter_initialize();
$lang_plugin_newsletter = $newsletter_init_array['language']; 
$newsletter_icon_array = $newsletter_init_array['icon'];
$display_submit_button = 0;
$subscriber_email_warning = '';
$USER_DATA = array_merge($USER_DATA, $cpg_udb->get_user_infos(USER_ID));

pageheader($lang_plugin_newsletter['archive']);
echo 'Nothing here yet...';
pagefooter();
die;
?>