<?php

// if we're not in coppermine, exit
if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

class storage
{

	function delete_images($images)
	{
	}

	function store_images($images)
	{
	}
	
	function build_url($image)
	{
		return $image->original_url;
	}
	
}

?>