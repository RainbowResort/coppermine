<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2007 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

define('IN_COPPERMINE', true);
define('RATEPIC_PHP', true);

require('include/init.inc.php');
// Check if required parameters are present
if (!isset($_GET['pic']) || !isset($_GET['rate'])) cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);

$pic = (int)$_GET['pic'];
$rate = (int)$_GET['rate'];

$rate = min($rate, 5);
$rate = max($rate, 0);

// If user does not accept script's cookies, we don't accept the vote
if (!isset($_COOKIE[$CONFIG['cookie_name'] . '_data'])) {
    header('Location: displayimage.php?pid=' . ($pic));
    exit;
}

/* Commented out by GauGau 2007-03-06 - there appears to be an issue with this block (doesn't work as expected), needs to be reviewed or removed.
// If referer is not displayimage.php we don't accept the vote
if (!eregi("displayimage",$_SERVER["HTTP_REFERER"])){
    header('Location: displayimage.php?pid=' . ($pic));
    exit;
}
*/


// Retrieve picture/album information & check if user can rate picture
$sql = "SELECT a.votes as votes_allowed, p.votes as votes, pic_rating, owner_id " . "FROM {$CONFIG['TABLE_PICTURES']} AS p, {$CONFIG['TABLE_ALBUMS']} AS a " . "WHERE p.aid = a.aid AND pid = '$pic' LIMIT 1";
$result = cpg_db_query($sql);
if (!mysql_num_rows($result)) cpg_die(CRITICAL_ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
$row = mysql_fetch_array($result);
mysql_free_result($result);
if (!USER_CAN_RATE_PICTURES || $row['votes_allowed'] == 'NO') cpg_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);
// Clean votes older votes
$curr_time = time();
$clean_before = $curr_time - $CONFIG['keep_votes_time'] * 86400;
$sql = "DELETE " . "FROM {$CONFIG['TABLE_VOTES']} " . "WHERE vote_time < $clean_before";
$result = cpg_db_query($sql);
// Check if user already rated this picture
$user_md5_id = USER_ID ? md5(USER_ID) : $USER['ID'];
$sql = "SELECT * " . "FROM {$CONFIG['TABLE_VOTES']} " . "WHERE pic_id = '$pic' AND user_md5_id = '$user_md5_id'";
$result = cpg_db_query($sql);
if (mysql_num_rows($result)) { // user has already rated this file
    $location = "displayimage.php?pid=" . ($pic);
    cpgRedirectPage($location, $lang_common['information'], $lang_rate_pic_php['already_rated'], 0);
    // cpg_die(ERROR, $lang_rate_pic_php['already_rated'], __FILE__, __LINE__); // commented out in favor of message-block
}
//Test for Self-Rating
$user=USER_ID;
$owner=$row['owner_id'];

if (!empty($user) && $user==$owner && !USER_IS_ADMIN) {
    $location = "displayimage.php?pid=" . ($pic);
    cpgRedirectPage($location, $lang_common['information'], $lang_rate_pic_php['forbidden'], 1);
    // cpg_die(ERROR, $lang_rate_pic_php['forbidden'], __FILE__, __LINE__); // commented out in favor of message-block
}
// Update picture rating
$new_rating = round(($row['votes'] * $row['pic_rating'] + $rate * 2000) / ($row['votes'] + 1));
$sql = "UPDATE {$CONFIG['TABLE_PICTURES']} " . "SET pic_rating = '$new_rating', votes = votes + 1 " . "WHERE pid = '$pic' LIMIT 1";
$result = cpg_db_query($sql);
// Update the votes table
$sql = "INSERT INTO {$CONFIG['TABLE_VOTES']} " . "VALUES ('$pic', '$user_md5_id', '$curr_time')";
$result = cpg_db_query($sql);

/**
 * Code to record the details of votes for the picture if the option is set in CONFIG
 */
if ($CONFIG['vote_details']) {
        // Get the details of user browser, IP, OS, etc
        $client_details = cpg_determine_client();



        // Code to write the user id if a user is logged in
        $voteUserId = USER_ID;



        $time = time();

        $referer = urlencode(addslashes($_SERVER['HTTP_REFERER']));

        // Insert the record in database
        $query = "INSERT INTO {$CONFIG['TABLE_VOTE_STATS']}
                          SET
                            pid = $pic,
                            rating = $rate,
                            Ip   = '$raw_ip',
                            sdate = '$time',
                            referer = '$referer',
                            browser = '{$client_details['browser']}',
                            os = '{$client_details['os']}',
                            uid = '$voteUserId'";
        cpg_db_query($query);
}

$location = "displayimage.php?pid=" . ($pic);
cpgRedirectPage($location, $lang_common['information'], $lang_rate_pic_php['rate_ok'], 1);

?>