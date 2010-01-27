<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2006 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.4.19
  Photo Shop version: 1.4.0
  $Revision: 1.0 $
  $Author: stramm $
**********************************************/

define('PHOTOSHOP_ADMIN_PHP', true);
define('IN_COPPERMINE', true);

require('include/init.inc.php');
require('include/archive.php');

//if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (!(GALLERY_ADMIN_MODE))	cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

$filelist= array();

        $select_columns = 'p.filepath, p.filename';

        $result = cpg_db_query("SELECT p.filepath, p.filename FROM {$CONFIG['TABLE_PICTURES']} as p LEFT JOIN {$CONFIG['TABLE_SHOP']} as s ON p.pid=s.pid WHERE s.pid <> 0 AND s.oid=".$_REQUEST['oid']);
        $rowset = cpg_db_fetch_rowset($result);
        foreach ($rowset as $key => $row){
        		if (is_known_filetype($rowset[$key]['filepath'] . $CONFIG['orig_pfx'] . $rowset[$key]['filename'])) {
					$filelist[] = $rowset[$key]['filepath'] . $CONFIG['orig_pfx'] . $rowset[$key]['filename'];
				} else {
					$filelist[] = $rowset[$key]['filepath'] . $rowset[$key]['filename'];
				}
        }

$cwd = "./{$CONFIG['fullpath']}";

$zip = new zip_file('photoshop_pics_oid_'.$_REQUEST['oid'].'.zip');

$zip->set_options(array('basedir' => $cwd, 'inmemory' => 1, 'recurse' => 0, 'storepaths' => 0));
$zip->add_files($filelist);
$zip->create_archive();
ob_end_clean();
$zip->download_file();
?>