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
  $URL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/addfav.php $
  $Revision: 5126 $
  $LastChangedBy: gaugau $
  $Date: 2008-10-17 13:10:13 +0530 (Fri, 17 Oct 2008) $
**********************************************/

/**
* Coppermine Photo Gallery addfav.php
*
* This file does the needful when add to fav links are clicked, if the user is logged in then
* the favs are stored in the database else the favs are stored in a local cookie, the favs in
* database take precedence over the cookie favs
*
* @copyright 2002-2006 Gregory DEMAR, Coppermine Dev Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License V2
* @package Coppermine
* @version $Id: addfav.php 5126 2008-10-17 07:40:13Z gaugau $
*/

/**
* @ignore
*/
define('IN_COPPERMINE', true);
/**
* @ignore
*/
define('RATEPIC_PHP', true);

require('include/init.inc.php');

/**
 * Clean up GPC and other Globals here
 */
 $pid = $superCage->get->getInt('pid');
 // Used getRaw() method but sanitize immediately
 //$ref = htmlspecialchars($superCage->get->getRaw('ref'));

// Check if required parameters are present
if (empty($pid)) cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);

$ref = $CONFIG['site_url'] . (!empty($CPG_REFERER) ? $CPG_REFERER : "displayimage.php?pid={$pid}");
$ref = str_replace('&amp;', '&', $ref);
// If user does not accept script's cookies, we don't accept the vote
if (!$superCage->cookie->keyExists($CONFIG['cookie_name'] . '_data')) {
    header("Location: $ref");
    exit;
}
// See if this picture is already present in the array
if (!in_array($pid, $FAVPICS)) {
    $FAVPICS[] = $pid;
} else {
    $key = array_search($pid, $FAVPICS);
    unset ($FAVPICS[$key]);
}

$data = base64_encode(serialize($FAVPICS));
setcookie($CONFIG['cookie_name'] . '_fav', $data, time() + 86400 * 30, $CONFIG['cookie_path']);
// If the user is logged in then put it in the DB
/*if (USER_ID > 0) {
        $sql = "UPDATE {$CONFIG['TABLE_FAVPICS']} SET user_favpics = '$data' WHERE user_id = " . USER_ID;
        cpg_db_query($sql);
        // User never stored a fav... so insert new row
        if (!mysql_affected_rows($CONFIG['LINK_ID'])) {
                $sql = "INSERT INTO {$CONFIG['TABLE_FAVPICS']} ( user_id, user_favpics) VALUES (" . USER_ID . ", '$data')";
                cpg_db_query($sql);
        }
}	*/
##################################		DB		###################################
// If the user is logged in then put it in the DB
if (USER_ID > 0) {
		$cpgdb->query($cpg_db_addfav_php['user_new_favpics'], $data, USER_ID);
        // User never stored a fav... so insert new row
        if (!$cpgdb->affectedRows()) {
				$cpgdb->query($cpg_db_addfav_php['user_first_favpics'], USER_ID, $data);
        }
}
###################################################################################

$header_location = (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE'))) ? 'Refresh: 0; URL=' : 'Location: ';
header($header_location . $ref);
pageheader($lang_common['information'], "<meta http-equiv=\"refresh\" content=\"1;url=$ref\">");
msg_box($lang_info, $lang_rate_pic_php['rate_ok'], $lang_common['continue'], $ref);
pagefooter();
ob_end_flush();
?>