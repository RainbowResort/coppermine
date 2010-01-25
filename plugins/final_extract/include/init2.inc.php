<?php
/**************************************************
  Coppermine 1.5.x Plugin - final_extract
  *************************************************
  Copyright (c) 2009 Donnovan Bray
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/
  
$group=explode(',',substr(USER_GROUP_SET,1,-1));
$result = cpg_db_query("SELECT home,login,my_gallery,upload_pic,album_list,lastup,lastcom,topn,toprated,favpics,search,my_profile FROM {$CONFIG['TABLE_PREFIX']}final_extract_config WHERE Group_Id=$group[0]");
while($row = mysql_fetch_array($result,MYSQL_ASSOC)){	
$FEX=$row;				
}
mysql_free_result($row);
    
?>