<?php
/**************************************************
  Coppermine 1.4.x Plugin - EnlargeIt! $VERSION$=2.15
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ***************************************************/

define('IN_COPPERMINE', true);
define('RATEPIC_PHP', true);

require('include/init.inc.php');
// Check if required parameters are present



if (!isset($_GET['pic']) || !isset($_GET['rate'])) enl_die($lang_errors['param_missing']);

$pic = (int)$_GET['pic'];
$rate = (int)$_GET['rate'];
$enl_img = isset($_GET['enl_img']) ? $_GET['enl_img'] : 'wurst';

$rate = min($rate, 5);
$rate = max($rate, 0);

// If user does not accept script's cookies, we don't accept the vote
if (!isset($_COOKIE[$CONFIG['cookie_name'] . '_data'])) {
    header('Location: enl_info.php?pid=' .$pic.'&amp;enl_img='.$enl_img);
    exit;
}


// Retrieve picture/album information & check if user can rate picture
$sql = "SELECT a.votes as votes_allowed, p.votes as votes, pic_rating, owner_id " . "FROM {$CONFIG['TABLE_PICTURES']} AS p, {$CONFIG['TABLE_ALBUMS']} AS a " . "WHERE p.aid = a.aid AND pid = '$pic' LIMIT 1";
$result = cpg_db_query($sql);
if (!mysql_num_rows($result)) enl_die($lang_errors['non_exist_ap']);
$row = mysql_fetch_array($result);
mysql_free_result($result);
if (!USER_CAN_RATE_PICTURES || $row['votes_allowed'] == 'NO') enl_die($lang_errors['perm_denied']);
// Clean votes older votes
$curr_time = time();
$clean_before = $curr_time - $CONFIG['keep_votes_time'] * 86400;
$sql = "DELETE " . "FROM {$CONFIG['TABLE_VOTES']} " . "WHERE vote_time < $clean_before";
$result = cpg_db_query($sql);
// Check if user already rated this picture
$user_md5_id = USER_ID ? md5(USER_ID) : $USER['ID'];
$sql = "SELECT * " . "FROM {$CONFIG['TABLE_VOTES']} " . "WHERE pic_id = '$pic' AND user_md5_id = '$user_md5_id'";
$result = cpg_db_query($sql);
if (mysql_num_rows($result)) enl_die($lang_rate_pic_php['already_rated']);
//Test for Self-Rating
$user=USER_ID;
$owner=$row['owner_id'];

if (!empty($user) && $user==$owner && !USER_IS_ADMIN) enl_die($lang_rate_pic_php['forbidden']);
// Update picture rating
$new_rating = round(($row['votes'] * $row['pic_rating'] + $rate * 2000) / ($row['votes'] + 1));
$sql = "UPDATE {$CONFIG['TABLE_PICTURES']} " . "SET pic_rating = '$new_rating', votes = votes + 1 " . "WHERE pid = '$pic' LIMIT 1";
$result = cpg_db_query($sql);
// Update the votes table
$sql = "INSERT INTO {$CONFIG['TABLE_VOTES']} " . "VALUES ('$pic', '$user_md5_id', '$curr_time')";
$result = cpg_db_query($sql);

/**
 * Code to record the details of hits for the picture if the option is set in CONFIG
 */
if ($CONFIG['vote_details']) {
// Get the details of user browser, IP, OS, etc
$os = "Unknown";
if(eregi("Linux",$_SERVER["HTTP_USER_AGENT"])) {
    $os = "Linux";
} else if(eregi("Windows NT 5.0",$_SERVER["HTTP_USER_AGENT"])) {
    $os = "Windows 2000";
} else if(eregi("win98|Windows 98",$_SERVER["HTTP_USER_AGENT"])) {
    $os = "Windows 98";
}

$browser = 'Unknown';
if(eregi("MSIE",$browser)) {
    if(eregi("MSIE 5.5",$browser)) {
        $browser = "Microsoft Internet Explorer 5.5";
    } else if(eregi("MSIE 6.0",$browser)) {
        $browser = "Microsoft Internet Explorer 6.0";
    }
} else if(eregi("Mozilla Firebird",$browser)) {
    $browser = "Mozilla Firebird";
} else if(eregi("netscape",$browser)) {
    $browser = "Netscape";
}
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
                    browser = '$browser',
                    os = '$os'";
cpg_db_query($query);
}

$location = "index.php?file=enlargeit/enl_info&pid=".$pic."&amp;enl_img=".$enl_img;
$header_location = (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE'))) ? 'Refresh: 0; URL=' : 'Location: ';
header($header_location . $location);
enl_message($lang_rate_pic_php['rate_ok']);

ob_end_flush();


function enl_die($enl_error)
{
	echo '<table cellspacing="1" style="width:100%;height:100%">';
	echo '<tr>';
	echo '<td class="enl_infotablehead" align="center"><b>';
	echo $enl_error;
	echo '</b></td>';
	echo '</tr>';
	echo '</table>';
	
	exit();
}

function enl_message($enl_message)
{
	echo '<table cellspacing="1" style="width:100%;height:100%">';
	echo '<tr>';
	echo '<td class="enl_infotablehead" align="center"><b>';
	echo $enl_message;
	echo '</b></td>';
	echo '</tr>';
	echo '</table>';
}


?>
