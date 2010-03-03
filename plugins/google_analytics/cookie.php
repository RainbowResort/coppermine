<?php
/*************************
  Coppermine 1.4 Plugin - Google Anylytics
  ************************
  Copyright (c) 2009
  
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.4
  $Author: papukaija $
**********************************************/
require('include/init.inc.php');
require('plugins/google_analytics/include/init.inc.php');
if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

$data = "no";
$days = 3650;//10 years
$date_of_expiry = time() + 60 * 60 * 24 * $days;
setcookie($CONFIG['cookie_name'].'_ga-stats', $data, $date_of_expiry, $CONFIG['cookie_path']);

//redirecting user
$url = $CONFIG['ecards_more_pic_target'];
pageheader($lang_info,"<meta http-equiv=\"refresh\" content=\"5;url=$url\">");
msg_box($lang_info, $lang_plugin_analytics_config['cookie_inst'], $lang_continue, $url);
pagefooter();
ob_end_flush();//this line might not be needed to run this plugin
?>