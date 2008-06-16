<?php

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

class image
{

	public $id;
	public $original_url;
	public $thumb_urls = array();
	public $owner_id;
	public $total_filesize;
	public $filename;

	function image($id=0, $owner_id=0, $original_url="", $thumb_urls = array(), $total_filesize=0, $filename = "")
	{
		$this->id = $id;
		$this->owner_id = $owner_id;
		$this->original_url = $original_url;
		$this->thumb_urls = $thumb_urls;
		$this->total_filesize = $total_filesize;
		$this->filename = $filename;
	}
	
}

?>