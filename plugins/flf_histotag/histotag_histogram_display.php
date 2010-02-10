<?php
define('IN_COPPERMINE', true);
//require_once('./include/init.inc.php');
require ("include/histotag_histogram_support.php");
	global $CURRENT_PIC_DATA, $_GET;
	    $superCage = Inspekt::makeSuperCage();
$pid=$superCage->get->getInt('pid');

if ($pid) {
	$filename=checkandcreatehistogram($pid);
	
	if ($filename) {
	
	echo "<div style=\"text-align:center\"><img src=\"./$filename\"></div>";

	}
	else {
		// TODO: Not found
	}
}


?>
