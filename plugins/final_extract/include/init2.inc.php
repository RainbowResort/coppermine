<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2005 Coppermine Dev Team
  v1.1 originaly written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.4.8
  $Source: /cvsroot/cpg-contrib/master_template/codebase.php,v $
  $Revision: 1.3 $
  $Author: donnoman $
  $Date: 2005/12/08 05:46:49 $
**********************************************/
/**********************************************
Modified By BMossavari 
- Add menu option to remove each part
- Add config page
**********************************************/
$group=explode(',',substr(USER_GROUP_SET,1,-1));
$result = cpg_db_query("SELECT home,login,my_gallery,upload_pic,album_list,lastup,lastcom,topn,toprated,favpics,search,my_profile FROM {$CONFIG['TABLE_PREFIX']}final_extract_config WHERE Group_Id=$group[0]");
while($row = mysql_fetch_array($result,MYSQL_ASSOC)){	
$FEX=$row;				
}
mysql_free_result($row);
    
?>