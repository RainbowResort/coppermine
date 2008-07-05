<?php

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

class FileContainer
{

	public $id;
	public $original_path;
	public $thumb_paths = array();
	public $owner_id;
	public $total_filesize;
	public $filename;

	function FileContainer($id=0, $owner_id=0, $original_path="", $thumb_paths = array(), $total_filesize=0, $filename = "")
	{
		$this->id = $id;
		$this->owner_id = $owner_id;
		$this->original_path = $original_path;
		$this->thumb_paths = $thumb_paths;
		$this->total_filesize = $total_filesize;
		$this->filename = $filename;
	}
	
}

?>