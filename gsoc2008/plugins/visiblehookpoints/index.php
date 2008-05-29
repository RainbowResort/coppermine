<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.0
  $Source: /cvsroot/coppermine/devel/admin.php,v $
  $Revision: 3995 $
  $LastChangedBy: gaugau $
  $Date: 2007-10-08 19:16:55 +0200 (Mo, 08 Okt 2007) $
**********************************************/


// Call basic functions, etc.
require_once('include/init.inc.php');

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}


//####################################################################################################
//#############################  INIT OF SCRIPT VARIABLES  ###########################################
//####################################################################################################

//Initialize local parameters.
//$action = isset($_POST['action']) ? $_POST['action']: $_GET['action'];
//$superCage->get->getInt('hookpoints'){gaugau}
if($superCage->post->keyExists('action')){
	$action = $superCage->post->getAlpha('action');
}else{
	$action = $superCage->get->getAlpha('action');
}


//####################################################################################################
//################################# MAIN CODE BLOCK ##################################################
//####################################################################################################


if (!GALLERY_ADMIN_MODE) {
  cpg_die($lang_common['error'], $lang_errors['access_denied'], __FILE__, __LINE__);
}

///////////////////////////////////////////////////////////////////////
/////////////////   HANDLE OF INCOMING ACTIONS  (if any)  /////////////
///////////////////////////////////////////////////////////////////////


switch ($action) {
  case 'config':
    //if (isset($_POST['visiblehookpoints_display']) == TRUE) {
	if ($superCage->post->keyExists('visiblehookpoints_display')) {
      //if ($_POST['visiblehookpoints_display'] == 1) {�
	  if ($superCage->post->getInt('visiblehookpoints_display') == 1) {
        $value = 1;
      } else {
        $value = 0;
      }
      if ($value != $CONFIG['plugin_visiblehookpoints_display']) {
        $f= cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '{$value}' WHERE name = 'plugin_visiblehookpoints_display'");
        if (version_compare(COPPERMINE_VERSION, '1.5.0') == -1) {
            $header_location = (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE'))) ? 'Refresh: 0; URL=' : 'Location: ';
            $redirect = "index.php?file=visiblehookpoints/index&action=config";
            header($header_location . $redirect);
            pageheader('Information', "<meta http-equiv=\"refresh\" content=\"0;url=$redirect\" />");
            msg_box('Information', 'Settings changed for Visible Hookpoints Plugin', 'continue', $redirect);
            pagefooter();
            ob_end_flush();
            exit;
        } else {
            cpgRedirectPage('index.php?file=visiblehookpoints/index&action=config', $lang_common['information'], 'Settings changed for Visible Hookpoints Plugin', 1);
        }
      }
    } else {
      $message_id = '';
    }
    pageheader('Configuration of plugin &quot;Visible HookPoints&quot;');
    visiblehookpoints_configure();
          break;
  default:
          cpg_die (ERROR, 'Plugin &quot;Visible HookPoints&quot;: Unknown action value', __FILE__, __LINE__);
}

pagefooter();
ob_end_flush();
?>