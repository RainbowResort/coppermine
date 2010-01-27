<?php

if (!defined('IN_COPPERMINE')) die("0");

require 'include/init.inc.php';

if (!USER_ID) die('Access denied');

if (isset($_POST['add'])){

	$pid = (int) $_POST['add'];
	$nid = (int) $_POST['nid'];
	$posx = (int) $_POST['posx'];
	$posy = (int) $_POST['posy'];
	$width = (int) $_POST['width'];
	$height = (int) $_POST['height'];
	$note = addslashes(urldecode($_POST['note']));

	if ($nid){
	
		$sql = "UPDATE {$CONFIG['TABLE_PREFIX']}notes SET posx = $posx, posy = $posy, width = $width, height = $height, note = '$note' WHERE nid = $nid";	
		if (!GALLERY_ADMIN_MODE) $sql .= " AND user_id = " . USER_ID . " LIMIT 1";
		cpg_db_query($sql);
		die("$nid");

	} else {
		$sql = "INSERT INTO {$CONFIG['TABLE_PREFIX']}notes (pid, posx, posy, width, height, note, user_id) VALUES ($pid, $posx, $posy, $width, $height, '$note', " . USER_ID . ")";	
		cpg_db_query($sql);
		$nid = mysql_insert_id($CONFIG['LINK_ID']);
		die("$nid");
	}

} elseif (isset($_POST['remove'])){

	$nid = (int) $_POST['remove'];

	$sql = "DELETE FROM {$CONFIG['TABLE_PREFIX']}notes WHERE nid = $nid";
	if (!GALLERY_ADMIN_MODE) $sql .= " AND user_id = " . USER_ID . " LIMIT 1";
	
	cpg_db_query($sql);
	die("$nid");
}

die("0");