<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  
  ********************************************
  Coppermine version: 1.5.0
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/keyword_create_dict.php $
  $Revision: 5129 $
  $LastChangedBy: gaugau $
  $Date: 2008-10-18 16:03:12 +0530 (Sat, 18 Oct 2008) $
**********************************************/

/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | Filename: keyword_create_dict.php                                    |
// +----------------------------------------------------------------------+
// | Copyright (c) http://www.sanisoft.com                                |
// +----------------------------------------------------------------------+
// | Description:                                                         |
// +----------------------------------------------------------------------+
// | Authors: Original Author                                             |
// |          SANIsoft Developement Team                                  |
// +----------------------------------------------------------------------+

define('IN_COPPERMINE', true);
define('EDITPICS_PHP', true);
require('include/init.inc.php');
if (!(GALLERY_ADMIN_MODE)) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
/*$query  = "SELECT keywords from {$CONFIG['TABLE_PREFIX']}pictures";
$result = cpg_db_query($query);
$i=0;
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

	$keywords = $row["keywords"];
	$keyArr   = explode(" ",$keywords);
		foreach ($keyArr as $keyword) {
			$query = "SELECT keyword from {$CONFIG['TABLE_PREFIX']}dict WHERE keyword = '$keyword'";
			$result2 = cpg_db_query($query);

			if (mysql_num_rows($result2) == 0 && $keyword != "" && $keyword != " ") {
				$query = "INSERT INTO {$CONFIG['TABLE_PREFIX']}dict SET keyword = '$keyword'";
				cpg_db_query($query);
				echo "* ";
								$i++ ;
			} else {
				echo "% ";
			}
		}
		mysql_free_result($result2);
		flush();
	}	*/
##############################         DB        ##############################
$cpgdb->query($cpg_db_keyword_create_dict_php['get_pic_keywords']);
$rowset1 = $cpgdb->fetchRowSet();
$cpgdb->free();
$i=0;
	foreach ($rowset1 as $row) {
		$keywords = $row["keywords"];
		$keyArr   = explode(" ",$keywords);
		foreach ($keyArr as $keyword) {
			$cpgdb->query($cpg_db_keyword_create_dict_php['get_dict_keyword'], $keyword);
			$rowset2 = $cpgdb->fetchRow();
			$cpgdb->free();

			if (count($rowset2) == 0 && $keyword != "" && $keyword != " ") {
				$cpgdb->query($cpg_db_keyword_create_dict_php['set_dict_keyword'], $keyword);
				echo "* ";
				$i++ ;
			} else {
					echo "% ";
			}
		}
		flush();
	}
#####################################################################	
echo "<p>{$lang_editpics_php['new_keywords']} = ".$i;
echo "<br/>* = {$lang_editpics_php['new_keyword']}";
echo "<br/>% = {$lang_editpics_php['existing_keyword']}</p>";
//mysql_free_result($result);	####	cpgdb_AL
?>
