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
  Coppermine version: 1.4.1
  $Source: /cvsroot/coppermine/devel/plugins/sample/codebase.php,v $
  $Revision: 1.8 $
  $Author: oddeveloper $
  $Date: 2005/02/20 10:30:05 $
**********************************************/
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
$COUNT_FILES=0;
require('include/init.inc.php');
include('configuration.php');
$TABLE_PREFIX=$CONFIG['TABLE_PREFIX'];
$RESULT = cpg_db_query("SELECT $CONFIG['TABLE_PICTURES'].filepath, $CONFIG['TABLE_PICTURES'].filename,
						$CONFIG['TABLE_PICTURES'].pid.$CONFIG['TABLE_ALBUMS'].title 
							FROM {$CONFIG['TABLE_ALBUMS']},{$CONFIG['TABLE_PICTURES']} 
							WHERE {$CONFIG['TABLE_ALBUMS']}.aid={$CONFIG['TABLE_PICTURES']}.aid
							ORDER BY {$CONFIG['TABLE_ALBUMS']}.title"
						);
echo "<table border=0 width=100%>";
echo "<tr bgcolor='#999999'><td>filename</td><td>old directory</td><td>new directory</td><td>original file</td><td>normal_ file</td><td>thumb_ file</td><td>SQL Update</td><td>Was it moved?</td><td>Error code</td></tr>";
while ($total = mysql_fetch_array($RESULT))
	{
	$ALBUMS_DIR=$CONFIG['fullpath'];									//eg "Albums/"

	$OLD_DIR=$ALBUMS_DIR."".$total[filepath];							//eg Albums/trees/
	$OLD_FILE=$total[filename];											//eg greentree.jpg
	$OLD_PATH_N_FILE=$OLD_DIR."".$OLD_FILE;								//eg Albums/trees/greentree.jpg
	$OLD_PATH_N_FILE_NORMAL=$OLD_DIR."normal_".$OLD_FILE;				//eg Albums/trees/normal_greentree.jpg
	$OLD_PATH_N_FILE_THUMB=$OLD_DIR."thumb_".$OLD_FILE;					//eg Albums/trees/thumb_greentree.jpg

	$NEW_TMP_DIR=str_replace("/","_",$total[title]);					//eg "Forest_winter 2005" instead of "Forest/winter 2005"
	$NEW_TMP_DIR=str_replace(" ","_",$NEW_TMP_DIR);						//eg "Forest_winter_2005" instead of "Forest_winter 2005"	
	$NEW_DIR_NO_AD=$imagefolder."".$NEW_TMP_DIR."/";					//eg images/Forest_winter_2005/ 				(NO_AD=NO Albums Directory, needed for the database)
	$NEW_DIR=$ALBUMS_DIR."".$imagefolder."".$NEW_TMP_DIR."/";			//eg Albums/images/Forest_winter_2005/
	$NEW_PATH_N_FILE=$NEW_DIR."".$OLD_FILE;								//eg Albums/images/Forest_winter_2005/greentree.jpg (I'm using the $OLD_FILE, cause i don't change the filename)
	$NEW_PATH_N_FILE_NORMAL=$NEW_DIR."normal_".$OLD_FILE;				//eg Albums/images/Forest_winter_2005/normal_greentree.jpg
	$NEW_PATH_N_FILE_THUMB=$NEW_DIR."thumb_".$OLD_FILE;					//eg Albums/images/Forest_winter_2005/thumb_greentree.jpg
	
	if ($OLD_PATH_N_FILE != $NEW_PATH_N_FILE)							//If these are the same, file doesn't have to be moved
	{
	$ERROR_CODE=0;
	echo "<tr><td>".$OLD_FILE."</td><td>".$OLD_DIR."</td><td>".$NEW_DIR."</td>";
		if (!file_exists($NEW_DIR)) 									//Check if directory doesnet exist
			{
			mkdir ($NEW_DIR, 0777);										//If it doesn't create it
			chmod ($NEW_DIR, 0777);										//and change the rights
			}
		if (!file_exists($NEW_PATH_N_FILE)){							//Check if $NEW_PATH_N_FILE doesn't exist
			if (copy ($OLD_PATH_N_FILE,$NEW_PATH_N_FILE))				//If it doesn't copy it
				{
				 echo "<td><center><img src='images/green.gif'></center></td>";
				}
			else
				{
				echo "<td><center><img src='images/red.gif'></center></td>";
				$ERROR_CODE=$ERROR_CODE+1;
				}
			}

		if (file_exists($OLD_PATH_N_FILE_NORMAL)){
			if (!file_exists($NEW_PATH_N_FILE_NORMAL))								//Check if $NEW_PATH_N_FILE_NORMAL doesn't exist
				{if (copy ($OLD_PATH_N_FILE_NORMAL,$NEW_PATH_N_FILE_NORMAL)) 		//If it doesn't copy it
					{unlink ($OLD_PATH_N_FILE_NORMAL);								//Delete the original normal_file
					echo "<td><center><img src='images/green.gif'></center></td>";	//If it is good place green.gif in the table
					}
				else
					{
					echo "<td><center><img src='images/red.gif'></center></td>";	//If it is bad place red.gif in the table
					$ERROR_CODE=$ERROR_CODE+2;										//And raise $ERROR_CODE by 2
					}
				}
			}
		else
			{
			echo "<td></td>";
			}
		
		if (file_exists($OLD_PATH_N_FILE_THUMB)){									//Check if $OLD_PATH_N_FILE_THUMB exist if it is move the file
			if (!file_exists($NEW_PATH_N_FILE_THUMB))								//Check if $NEW_PATH_N_FILE_THUMB doesn't exist
				{if (copy ($OLD_PATH_N_FILE_THUMB,$NEW_PATH_N_FILE_THUMB))			//If it doesn't copy it and check if it's gooed
					echo "<td><center><img src='images/green.gif'></center></td>";	//If it is good place green.gif in the table
				}
				else
				{
					echo "<td><center><img src='images/red.gif'></center></td>";	//If it is bad place red.gif in the table
					$ERROR_CODE=$ERROR_CODE+4;										//And raise $ERROR_CODE by 4
				}
			}
		else
			{
			echo "<td></td>";				
			}
		
		if ($ERROR_CODE > 0)
			{
			if (file_exists ($NEW_PATH_N_FILE)) unlink ($NEW_PATH_N_FILE);				//Delete the new file
			if (file_exists ($NEW_PATH_N_FILE_NORMAL)) unlink ($NEW_PATH_N_FILE_NORMAL);//Delete the new normal_file
			if (file_exists ($NEW_PATH_N_FILE_THUMB)) unlink ($NEW_PATH_N_FILE_THUMB);	//Delete the new thumb_file
			echo "<td><center><img src='images/red.gif'></center></td>";	
			echo "<td><center><img src='images/red.gif'></center></td>";
			}
		else
			{
			$UPDATE_SQL_QUERY="UPDATE ".$CONFIG['TABLE_PICTURES']." SET filepath='".$NEW_DIR_NO_AD."' WHERE pid=".$total[pid];	//This is the sql statement that modifies the database so the new dir's are corrected
			cpg_db_query($UPDATE_SQL_QUERY);							//execute the query
			unlink ($OLD_PATH_N_FILE);									//Delete the original file
			unlink ($OLD_PATH_N_FILE_NORMAL);							//Delete the original normal_file
			unlink ($OLD_PATH_N_FILE_THUMB);							//Delete the original thumb_file
			echo "<td><center><img src='images/green.gif'></center></td>";		
			echo "<td><center><img src='images/green.gif'></center></td>";
			}
		$COUNT_FILES=$COUNT_FILES+1;
		echo "<td><center>".$ERROR_CODE."</center></td>";
	echo "</tr>";
	}
}
echo "</table>";
echo "Total files moved: ".$COUNT_FILES;
echo "<br><br><br><font size='1'>Errorcodes:<br>1=Error copying original file<br>2=Error copying normal_ file<br>3=Error copying orignal and normal_ file<br>";
echo "4=Error copying thumb_ file<br>5=Error copying original file and thumb_ file<br>6=Error copying normal_ file and thumb_ file<br>";
echo "7=Error copying all three files</font>";
?>