<?php
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');


$thisplugin->add_filter('file_data','remove_modify_button');
function remove_modify_button($info)
{
	
	$haystack = $info['menu'];
	$needle  = '<a href="editOnePic.php?';
	$pos = strripos($haystack, $needle);
	if($pos != false)
	{
		$code =& $info['menu'];
		$code = substr($code,$pos,strlen($code));
	}
	return $info;	
}

$thisplugin->add_action('page_start','remove_modify_page');
function remove_modify_page()
{
	$file = substr(strrchr($_SERVER['SCRIPT_FILENAME'], "/"), 1);
	if($file == 'picEditor.php')
	{
		die();
	}
}
?>