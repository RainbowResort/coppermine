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
		
		if (!$CURRENT_USER['username']) {
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
		
		if (!$CURRENT_USER['username']) {
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
	
	function createCategory($CURRENT_USER, $catname, $catdesc, $catparent) {
		global $DBS;
        $catpos = 0;
        if($catparent != 0) {
        	$results = $DBS->sql_query("SELECT COUNT(*) AS CX, MAX({$DBS->catfield['pos']}) AS MX FROM {$DBS->categorytable} WHERE {$DBS->catfield['parent']}=" . $catparent);
        	if(mysql_result($results, 0, "CX") > 0) {
        		$catpos = mysql_result($results, 0, "MX") + 1;	
        	}
        }

		$DBS->sql_update("INSERT INTO {$DBS->categorytable} ({$DBS->catfield['ownerid']},{$DBS->catfield['name']},{$DBS->catfield['description']},{$DBS->catfield['parent']},{$DBS->catfield['pos']}) VALUEs ('{$CURRENT_USER['user_id']}', '{$catname}', '{$catdesc}', {$catparent}, {$catpos})");
		return $this->getCategoryData($DBS->sql_insert_id());
	}

	function modifyCategory($catid, $catname, $catdesc, $catpos, $catthumb) {
		global $DBS;

		$DBS->sql_update("UPDATE {$DBS->categorytable} SET {$DBS->catfield['name']}='{$catname}', {$DBS->catfield['description']}='{$catdesc}', {$DBS->catfield['pos']}={$catpos}, {$DBS->catfield['thumb']}='{$catthumb}' WHERE {$DBS->catfield['cid']}={$catid}");
		return $this->getCategoryData($catid);
	}

	function removeCategory($catid) {
		global $DBS, $DISPLAY;

		$DBS->sql_update("DELETE FROM {$DBS->categorytable} WHERE {$DBS->catfield['cid']}=" . $catid);

  	    $results = $DBS->sql_query("SELECT {$DBS->albumfield['aid']} FROM {$DBS->albumtable} WHERE {$DBS->albumfield['category']}=" . $catid);
	    for($i=0; $i < mysql_numrows($results); $i++) {
	  	   $this->removeAlbum(mysql_result($results, $i, $DBS->albumfield['aid']));
	    }
        mysql_free_result($results);

  	    $results = $DBS->sql_query("SELECT {$DBS->catfield['cid']} FROM {$DBS->categorytable} WHERE {$DBS->catfield['parent']}=" . $catid);
	    for($i=0; $i < mysql_numrows($results); $i++) {
	  	   $this->removeCategory(mysql_result($results, $i, $DBS->catfield['cid']));
	    }
        mysql_free_result($results);
	}

	function getCategoryData($catid) {
		global $DISPLAY, $DBS;

    	$fieldstring = "";
    	for($i=0;$i<count($DISPLAY->categoryfields);$i++) {
       		if($i!=0) $fieldstring .= ", ";
       		$fieldstring .= "{$DBS->catfield[$DISPLAY->categoryfields[$i]]} AS {$DISPLAY->categoryfields[$i]}";
    	}

    	$sql =  "SELECT $fieldstring FROM {$DBS->categorytable}";
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


    /* Shows the data corresponding to a single category.
     * @ CAT_DATA
     */
    function showSingleCategoryData ($CAT_DATA) {
      global $DISPLAY;

      print "<categorydata>";
      for($i=0;$i<count($DISPLAY->categoryfields);$i++) {
         print "<" . $DISPLAY->categoryfields[$i] . ">";
         print $CAT_DATA[$DISPLAY->categoryfields[$i]];
         print "</" . $DISPLAY->categoryfields[$i] . ">";
      }
      print "</categorydata>";
    }
    
    /* Shows the data corresponding to a single category and its subtree.
     * @ CAT_DATA
     */
    function showCategoryData ($CAT_DATA) {
      global $DISPLAY, $DBS;

      print "<categorydata>";
      for($i=0;$i<count($DISPLAY->categoryfields);$i++) {
         print "<" . $DISPLAY->categoryfields[$i] . ">";
         print $CAT_DATA[$DISPLAY->categoryfields[$i]];
         print "</" . $DISPLAY->categoryfields[$i] . ">";
      }

      $results = $DBS->sql_query("SELECT {$DBS->catfield['cid']} FROM {$DBS->categorytable} WHERE {$DBS->catfield['parent']}=" . $CAT_DATA['cid'] . " ORDER BY {$DBS->catfield['pos']}");
	  for($i=0; $i < mysql_numrows($results); $i++) {
	  	 $this->showCategoryData($this->getCategoryData(mysql_result($results, $i, $DBS->catfield['cid'])));
	  }
      print "</categorydata>";
    }

	function showCategories ($CURRENT_USER) {
      global $DISPLAY, $DBS;
      
      $results = $DBS->sql_query("SELECT {$DBS->catfield['cid']} FROM {$DBS->categorytable} WHERE {$DBS->catfield['parent']}=0 AND {$DBS->catfield['ownerid']}=0" . " ORDER BY {$DBS->catfield['pos']}");
	  for($i=0; $i < mysql_numrows($results); $i++) {
	  	 $this->showCategoryData($this->getCategoryData(mysql_result($results, $i, $DBS->catfield['cid'])));
	  }
	  
	  if($CURRENT_USER['username']) {
      	 $results = $DBS->sql_query("SELECT {$DBS->catfield['cid']} FROM {$DBS->categorytable} WHERE {$DBS->catfield['parent']}=0 AND {$DBS->catfield['ownerid']}=" . $CURRENT_USER['user_id'] . " ORDER BY {$DBS->catfield['pos']}");
	  	 for($i=0; $i < mysql_numrows($results); $i++) {
	  	 	$this->showCategoryData($this->getCategoryData(mysql_result($results, $i, $DBS->catfield['cid'])));
	  	 }	  	
	  }
	}

	function showUserCategories ($CURRENT_USER) {
      global $DISPLAY, $DBS, $UF;
      
      if ($CURRENT_USER['username'] && $UF->isAdmin($CURRENT_USER['username'])) {
	     $results = $DBS->sql_query("SELECT {$DBS->catfield['cid']} FROM {$DBS->categorytable} WHERE {$DBS->catfield['parent']}=0 AND {$DBS->catfield['ownerid']}=0" . " ORDER BY {$DBS->catfield['pos']}");
	  	 for($i=0; $i < mysql_numrows($results); $i++) {
	  	    $this->showCategoryData($this->getCategoryData(mysql_result($results, $i, $DBS->catfield['cid'])));
	     }
      }
	  
	  if($CURRENT_USER['username']) {
      	 $results = $DBS->sql_query("SELECT {$DBS->catfield['cid']} FROM {$DBS->categorytable} WHERE {$DBS->catfield['parent']}=0 AND {$DBS->catfield['ownerid']}=" . $CURRENT_USER['user_id'] . " ORDER BY {$DBS->catfield['pos']}");
	  	 for($i=0; $i < mysql_numrows($results); $i++) {
	  	 	$this->showCategoryData($this->getCategoryData(mysql_result($results, $i, $DBS->catfield['cid'])));
	  	 }	  	
	  }
	}

	function showAllCategories () {
      global $DISPLAY, $DBS, $UF;
      
	  $results = $DBS->sql_query("SELECT {$DBS->catfield['cid']} FROM {$DBS->categorytable} WHERE {$DBS->catfield['parent']}=0" . " ORDER BY {$DBS->catfield['pos']}");
	  for($i=0; $i < mysql_numrows($results); $i++) {
	  	 $this->showCategoryData($this->getCategoryData(mysql_result($results, $i, $DBS->catfield['cid'])));
	  }
	}
	
	function createAlbum($catid, $albumname, $albumdesc) {
		global $DBS;
		$DBS->sql_update("INSERT INTO {$DBS->albumtable} ({$DBS->albumfield['title']},{$DBS->albumfield['description']},{$DBS->albumfield['category']}) VALUEs ('{$albumname}', '{$albumdesc}', '{$catid}')");
		return $DBS->sql_insert_id();
	}

    function removeAlbum($albumid) {
		global $DBS, $DISPLAY;

		$DBS->sql_update("DELETE FROM {$DBS->albumtable} WHERE {$DBS->albumfield['aid']}=" . $albumid);
    }
}

?>