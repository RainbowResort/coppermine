<?php
define('IN_COPPERMINE', true);
//require('./include/init.inc.php');
require ("include/histotag_histogram_support.php");
	global $CURRENT_PIC_DATA, $_GET;
	    $superCage = Inspekt::makeSuperCage();
$pid=$superCage->get->getInt('pid');

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
