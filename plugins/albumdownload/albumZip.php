<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2012 Coppermine Dev Team
  v1.0 originally written by Gregory Demar

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  
  ********************************************
  Coppermine version: 1.5.18
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/zipdownload.php $
  $Revision: 8304 $
**********************************************/

error_reporting(E_ALL);
ini_set('display_errors', '1');

define('IN_COPPERMINE', true);
define('THUMBNAILS_PHP', true);
define('INDEX_PHP', true);


include('include/archive.php');

    $filelist = array();
	$aid = $superCage->get->getInt('aid');

        $result = cpg_db_query("SELECT filepath, filename FROM {$CONFIG['TABLE_PICTURES']} WHERE aid = " . $aid );
        $rowset = cpg_db_fetch_rowset($result);
        
        foreach ($rowset as $key => $row) {
		echo $rowset[$key]['filepath'].$rowset[$key]['filename'];
                $filelist[] = $rowset[$key]['filepath'].$rowset[$key]['filename'];
        }

   $name = mysql_fetch_object(cpg_db_query("SELECT title FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid = " .$aid))->title;
   $name = str_replace(" ", "_", $name);

   $zip = new zip_file($name.".zip");
    
    $options = array(
        'basedir'    => "./{$CONFIG['fullpath']}",
        'inmemory'   => 1,
        'recurse'    => 0,
        'storepaths' => 0,
    );
        
    $zip->set_options($options);
    $zip->add_files($filelist);
    $zip->create_archive();
    
    ob_end_clean();
    
    $zip->download_file();
    
    if ($CONFIG['enable_zipdownload'] == 2) {
        @unlink($CONFIG['fullpath'].'edit/'.$readme_filename);
    }

?>
