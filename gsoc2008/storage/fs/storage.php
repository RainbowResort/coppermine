<?php

// if we're not in coppermine, exit
if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

class storage
{

	function delete_file($fileContainer)
	{
	}

	function store_file($fileContainer)
	{
	}
	
	function build_url($fileContainer)
	{
		return $fileContainer->original_path;
	}
	
	function replace_file($fileContainer)
	{
	}
	
}

?>