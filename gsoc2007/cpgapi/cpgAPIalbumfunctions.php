<?php
/*
 * PHP library for all album related functions in CPG
 * @author xnitingupta
 */

/**
 * Class for album related functions
 */
class albumfunctions {
	function authorizeusercat($CURRENT_USER, $categoryid, $perm) {
		global $CF, $DBS, $UF;
		
		$results = $DBS->sql_query("SELECT * FROM {$DBS->categorytable} WHERE {$DBS->catfield['cid']}={$categoryid}");
		if (!mysql_numrows($results)) {
    		mysql_free_result($results);
			return false;
		}
		mysql_free_result($results);
		
		if (!$CURRENT_USER) {
		   // Not logged in user certainly cannot own/edit
		   if ($perm == "owner") {
		      return false;
		   }  else {
   		      $results = $DBS->sql_query("SELECT * FROM {$DBS->categorytable} WHERE {$DBS->catfield['cid']}={$categoryid} AND {$DBS->catfield['ownerid']}=0");
			  if (mysql_numrows($results)) 
			     return true;
			  return false;
		   }
		}  else {
		   // Admin can access everything
		   if ($UF->isAdmin($CURRENT_USER['username']))
    		  return true;
    		  
           if ($perm == "owner") {
   		      $results = $DBS->sql_query("SELECT * FROM {$DBS->categorytable} WHERE {$DBS->catfield['cid']}={$categoryid} AND {$DBS->catfield['ownerid']}=" . $CURRENT_USER['user_id']);
			  if (mysql_numrows($results)) 
			     return true;
			  return false;           	
           }  else {
   		      $results = $DBS->sql_query("SELECT * FROM {$DBS->categorytable} WHERE {$DBS->catfield['cid']}={$categoryid} AND ({$DBS->catfield['ownerid']}=0 OR {$DBS->catfield['ownerid']}=" . $CURRENT_USER['user_id'] . ")");
			  if (mysql_numrows($results)) 
			     return true;
			  return false;           	
           }    	   
		}
	}	

	function authorizeuseralbum($CURRENT_USER, $albumid, $perm) {
		global $CF, $DBS, $UF;

		$results = $DBS->sql_query("SELECT * FROM {$DBS->albumtable} WHERE {$DBS->albumfield['aid']}={$albumid}");
		if (mysql_numrows($results)) {
		   $catid = mysql_result($results, 0, $DBS->albumfield['category']);
           $vg = mysql_result($results, 0, $DBS->albumfield['visibility']);
           $mg = mysql_result($results, 0, $DBS->albumfield['moderator_group']);
		}  else {
		   return false;
		}		
		
		if (!$CURRENT_USER) {
		   if ($perm == "owner") {
		   	  return false;
		   }  else {
		   	  if ($vg == 0)
		   	     return true;
		   	  return false;
		   }
		}  else {
		   if ($UF->isAdmin($CURRENT_USER['username']))
		      return true;

           if ($perm == "view") {
           	  if ($vg == 0)
		   	     return true;
           }

           // Check for ownership
	   	   // do i own the category?
		   if (authorizeusercat($CURRENT_USER, $catid, "owner"))
		      return true;
		   // am i in the moderator group?
		   $iresult = "SELECT * FROM {$DBS->userxgrouptable} WHERE {$DBS->userxgroup['user_id']}=" . $CURRENT_USER['user_id'] . " AND {$DBS->userxgroup['group_id']}=" . $mg;
		   if (mysql_numrows($iresult))
		      return true;
		   return false;
		}
	}	
	
	function createCategory($username, $catname, $catdesc, $catparent) {
		global $DBS;
		$DBS->sql_query("INSERT INTO {$DBS->categorytable} ({$DBS->catfield['ownerid']},{$DBS->catfield['name']},{$DBS->catfield['description']},{$DBS->catfield['parent']}) VALUEs ('{$username}', '{$catname}', '{$catdesc}', {$catparent})");
		return $DBS->sql_insert_id();
	}

	function getCategoryData($catid) {
		global $DBS;

    	$fieldstring = "";
    	for($i=0;$i<count($DISPLAY->categoryfields);$i++) {
       		if($i!=0) $fieldstring .= ", ";
       		$fieldstring .= "{$DBS->catfield[$DISPLAY->categoryfields[$i]]} AS {$DISPLAY->categoryfields[$i]}";
    	}

    	$sql =  "SELECT $fieldstring FROM {$DBS->category}";
    	$sql .= " WHERE {$DBS->catfield['cid']} = '$catid'";
    	$results = $DBS->sql_query($sql);

    	if (mysql_num_rows($results)) {
       		$CAT_DATA = mysql_fetch_assoc($results);
       		mysql_free_result($results);
       		return $CAT_DATA;
    	}  else {
       		return false;
    	}
	}

	function createAlbum($catid, $albumname, $albumdesc) {
		global $DBS;
		$DBS->sql_query("INSERT INTO {$DBS->albumtable} ({$DBS->albumfield['title']},{$DBS->albumfield['description']},{$DBS->albumfield['category']}) VALUEs ('{$albumname}', '{$albumdesc}', '{$catid}')");
		return $DBS->sql_insert_id();
	}
}

?>