<?php
define('IN_COPPERMINE', true);
//require('./include/init.inc.php');
require ("include/histotag_histogram_support.php");
	global $CURRENT_PIC_DATA;

$pid = $_SESSION['flfhisto_pid'];
// this file is where to generate the histogram
// Histogram contains fileid
if ($pid) {
	$filename=checkandcreatehistogram($pid);
	
	if ($filename) {
	
	echo "<img src=\"./$filename\">";

	}
	else {
		// TODO: Not found
	}
}


?>
