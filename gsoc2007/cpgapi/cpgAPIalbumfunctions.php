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
		
		if (!($UF->isAdmin($CURRENT_USER['username']) && $categoryid==0)) {
			$results = $DBS->sql_query("SELECT * FROM {$DBS->categorytable} WHERE {$DBS->catfield['cid']}={$categoryid}");
			if (!mysql_numrows($results)) {
	    		mysql_free_result($results);
				return false;
			}
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

	function authorizeuseralbum($CURRENT_USER, $albumid, $perm, $albumpassword) {
		global $CF, $DBS, $UF;

		$results = $DBS->sql_query("SELECT * FROM {$DBS->albumtable} WHERE {$DBS->albumfield['aid']}={$albumid}");
		if (mysql_numrows($results)) {
		   $catid = mysql_result($results, 0, $DBS->albumfield['category']);
           $vg = mysql_result($results, 0, $DBS->albumfield['visibility']);
           $mg = mysql_result($results, 0, $DBS->albumfield['moderator_group']);
           $password = mysql_result($results, 0, $DBS->albumfield['alb_password']);
		}  else {
		   return false;
		}		
		
		if (!$CURRENT_USER['username']) {
		   if ($perm == "owner") {
		   	  return false;
		   }  else {
		   	  if ($password) {
		   	  	 if (md5($albumpassword) != $password) return false;
              }
	   	      if ($vg == 0)
	   	         return true;
		   	  return false;
		   }
		}  else {
		   if ($UF->isAdmin($CURRENT_USER['username']))
		      return true;

           // Check for ownership
	   	   // do i own the category?
		   if ($this->authorizeusercat($CURRENT_USER, $catid, "owner"))
		      return true;
		   // am i in the moderator group?
		   $iresult = "SELECT * FROM {$DBS->userxgrouptable} WHERE {$DBS->userxgroup['user_id']}=" . $CURRENT_USER['user_id'] . " AND {$DBS->userxgroup['group_id']}=" . $mg;
		   if (mysql_numrows($iresult))
		      return true;
		      
           if ($perm == "view") {
		   	  if ($password) {
		   	  	 if (md5($albumpassword) != $password) return false;
              }
	   	      if ($vg == 0)
	   	         return true;
           }

		   return false;
		}
	}	
	
	function createCategory($CURRENT_USER, $catname, $catdesc, $catparent, $isadmincategory) {
		global $DBS;
        $catpos = 0;
        if($catparent != 0) {
        	$results = $DBS->sql_query("SELECT COUNT(*) AS CX, MAX({$DBS->catfield['pos']}) AS MX FROM {$DBS->categorytable} WHERE {$DBS->catfield['parent']}=" . $catparent);
        	if(mysql_result($results, 0, "CX") > 0) {
        		$catpos = mysql_result($results, 0, "MX") + 1;	
        	}
        }

        $ownerid = $CURRENT_USER['user_id'];
        if ($isadmincategory)
        	$ownerid = 0;
		$DBS->sql_update("INSERT INTO {$DBS->categorytable} ({$DBS->catfield['ownerid']},{$DBS->catfield['name']},{$DBS->catfield['description']},{$DBS->catfield['parent']},{$DBS->catfield['pos']}) VALUEs ('{$ownerid}', '{$catname}', '{$catdesc}', {$catparent}, {$catpos})");
		return $this->getCategoryData($DBS->sql_insert_id());
	}
	
	function moveCategory($catid, $catpos) {
		global $DBS;
		
		$results = $DBS->sql_query("SELECT * FROM {$DBS->categorytable} WHERE {$DBS->catfield['cid']}=" . $catid);
		if (mysql_numrows($results)) {
			$catparent = mysql_result($results, 0, $DBS->catfield['parent']);
			$oldpos = mysql_result($results, 0, $DBS->catfield['pos']);
			if ($oldpos < $catpos) {
				$DBS->sql_update("UPDATE {$DBS->categorytable} SET {$DBS->catfield['pos']}={$DBS->catfield['pos']}-1 WHERE {$DBS->catfield['parent']}=" . $catparent . " AND {$DBS->catfield['pos']} <= " . $catpos);
			} else if ($oldpos > $catpos){
				$DBS->sql_update("UPDATE {$DBS->categorytable} SET {$DBS->catfield['pos']}={$DBS->catfield['pos']}+1 WHERE {$DBS->catfield['parent']}=" . $catparent . " AND {$DBS->catfield['pos']} >= " . $catpos);				
			}
			$DBS->sql_update("UPDATE {$DBS->categorytable} SET {$DBS->catfield['pos']}=" . $catpos . " WHERE {$DBS->catfield['cid']}=" . $catid);
			return true;
		}

		return false;
	}	

	function modifyCategory($catid, $catname, $catdesc, $catparent, $catthumb) {
		global $DBS;

	    $sets = "";
	    if ($catname === false) { }
	    else $sets = $sets . (($sets == "")? "" : ",") . "{$DBS->catfield['name']}='{$catname}'";

	    if ($catdesc === false) { }
	    else $sets = $sets . (($sets == "")? "" : ",") . "{$DBS->catfield['description']}='{$catdesc}'";

	    if ($catparent === false) { }
	    else $sets = $sets . (($sets == "")? "" : ",") . "{$DBS->catfield['parent']}='{$catparent}'";

	    if ($catthumb === false) { }
	    else $sets = $sets . (($sets == "")? "" : ",") . "{$DBS->catfield['thumb']}='{$catthumb}'";

		if ($sets != "") $DBS->sql_update("UPDATE {$DBS->categorytable} SET " . $sets . " WHERE {$DBS->catfield['cid']}={$catid}");
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

	function getAlbumData($albumid) {
		global $DISPLAY, $DBS;

    	$fieldstring = "";
    	for($i=0;$i<count($DISPLAY->albumfields);$i++) {
       		if($i!=0) $fieldstring .= ", ";
       		$fieldstring .= "{$DBS->albumfield[$DISPLAY->albumfields[$i]]} AS {$DISPLAY->albumfields[$i]}";
    	}

    	$sql =  "SELECT $fieldstring FROM {$DBS->albumtable}";
    	$sql .= " WHERE {$DBS->albumfield['aid']} = '$albumid'";
    	$results = $DBS->sql_query($sql);

    	if (mysql_num_rows($results)) {
       		$ALBUM_DATA = mysql_fetch_assoc($results);
       		mysql_free_result($results);
       		return $ALBUM_DATA;
    	}  else {
       		return false;
    	}
	}

    /* Shows the data corresponding to a single category.
     * @ CAT_DATA
     */
    function showSingleCategoryData ($CAT_DATA) {
      global $DISPLAY, $CF;
      $ot = $CF->getvariable("setoutputtype");

      print "<categorydata";
      if($ot!="attr") print ">";
      for($i=0;$i<count($DISPLAY->categoryfields);$i++) {
         if($ot!="attr") print "<";
         else print " ";
         print $DISPLAY->categoryfields[$i];
         if($ot!="attr") print ">";
         else print "=\"";
         print $CAT_DATA[$DISPLAY->categoryfields[$i]];
         if($ot!="attr") print "</" . $DISPLAY->categoryfields[$i] . ">";
         else print "\"";
      }
      if($ot=="attr") print ">";
      print "</categorydata>";
    }

    function showAlbumData ($ALBUM_DATA) {
      global $DISPLAY, $PF, $DBS, $CF;
      $ot = $CF->getvariable("setoutputtype");

      print "<albumdata";
      if($ot!="attr") print ">";
      for($i=0;$i<count($DISPLAY->albumfields);$i++) {
         if($ot!="attr") print "<";
         else print " ";
         print $DISPLAY->albumfields[$i];
         if($ot!="attr") print ">";
         else print "=\"";
         print $ALBUM_DATA[$DISPLAY->albumfields[$i]];
         if($ot!="attr") print "</" . $DISPLAY->albumfields[$i] . ">";
         else print "\"";
      }
      if($ot=="attr") print ">";

      $results = $DBS->sql_query("SELECT {$DBS->picturefield['pid']} FROM {$DBS->picturetable} WHERE {$DBS->picturefield['aid']}=" . $ALBUM_DATA['aid'] . " ORDER BY {$DBS->picturefield['pos']}");
	  for($i=0; $i < mysql_numrows($results); $i++) {
     	 $PF->showPictureData($PF->getPictureData(mysql_result($results, $i, $DBS->picturefield['pid'])));
	  }

      print "</albumdata>";
    }
    
    function registerAlbumHit($albumid) {
      global $DBS;

	  $DBS->sql_update("UPDATE {$DBS->albumtable} SET {$DBS->albumfield['alb_hits']}={$DBS->albumfield['alb_hits']}+1 WHERE {$DBS->albumfield['aid']}=" . $albumid);    	
    }
    
    
    function showSingleAlbumData ($ALBUM_DATA) {
      global $DISPLAY, $PF, $DBS, $CF;
      $ot = $CF->getvariable("setoutputtype");

      print "<albumdata";
      if($ot!="attr") print ">";
      for($i=0;$i<count($DISPLAY->albumfields);$i++) {
         if($ot!="attr") print "<";
         else print " ";
         print $DISPLAY->albumfields[$i];
         if($ot!="attr") print ">";
         else print "=\"";
         print $ALBUM_DATA[$DISPLAY->albumfields[$i]];
         if($ot!="attr") print "</" . $DISPLAY->albumfields[$i] . ">";
         else print "\"";
      }
      if($ot=="attr") print ">";
      
      print "</albumdata>";
    }
    
    /* Shows the data corresponding to a single category and its subtree.
     * @ CAT_DATA
     */
    function showCategoryData ($CAT_DATA, $CURRENT_USER) {
      global $DISPLAY, $DBS, $CF;
      $ot = $CF->getvariable("setoutputtype");

      print "<categorydata";
      if($ot!="attr") print ">";
      for($i=0;$i<count($DISPLAY->categoryfields);$i++) {
         if($ot!="attr") print "<";
         else print " ";
         print $DISPLAY->categoryfields[$i];
         if($ot!="attr") print ">";
         else print "=\"";
         print $CAT_DATA[$DISPLAY->categoryfields[$i]];
         if($ot!="attr") print "</" . $DISPLAY->categoryfields[$i] . ">";
         else print "\"";
      }
      if($ot=="attr") print ">";
      
      $results = $DBS->sql_query("SELECT {$DBS->albumfield['aid']} FROM {$DBS->albumtable} WHERE {$DBS->albumfield['category']}=" . $CAT_DATA['cid'] . " ORDER BY {$DBS->albumfield['pos']}");
	  for($i=0; $i < mysql_numrows($results); $i++) {
         $albumid = mysql_result($results, $i, $DBS->albumfield['aid']);
	     if($this->authorizeuseralbum($CURRENT_USER, $albumid, "view"))
	     	$this->showSingleAlbumData($this->getAlbumData($albumid));
	  }

      $results = $DBS->sql_query("SELECT {$DBS->catfield['cid']} FROM {$DBS->categorytable} WHERE {$DBS->catfield['parent']}=" . $CAT_DATA['cid'] . " ORDER BY {$DBS->catfield['pos']}");
	  for($i=0; $i < mysql_numrows($results); $i++) {
	  	 $this->showCategoryData($this->getCategoryData(mysql_result($results, $i, $DBS->catfield['cid'])), $CURRENT_USER);
	  }
      print "</categorydata>";
    }

	function showCategories ($CURRENT_USER) {
      global $DISPLAY, $DBS;
      
      $results = $DBS->sql_query("SELECT {$DBS->catfield['cid']} FROM {$DBS->categorytable} WHERE {$DBS->catfield['parent']}=0 AND {$DBS->catfield['ownerid']}=0" . " ORDER BY {$DBS->catfield['pos']}");
	  for($i=0; $i < mysql_numrows($results); $i++) {
	  	 $this->showCategoryData($this->getCategoryData(mysql_result($results, $i, $DBS->catfield['cid'])), $CURRENT_USER);
	  }
	  
	  if($CURRENT_USER['username']) {
      	 $results = $DBS->sql_query("SELECT {$DBS->catfield['cid']} FROM {$DBS->categorytable} WHERE {$DBS->catfield['parent']}=0 AND {$DBS->catfield['ownerid']}=" . $CURRENT_USER['user_id'] . " ORDER BY {$DBS->catfield['pos']}");
	  	 for($i=0; $i < mysql_numrows($results); $i++) {
	  	 	$this->showCategoryData($this->getCategoryData(mysql_result($results, $i, $DBS->catfield['cid'])), $CURRENT_USER);
	  	 }	  	
	  }
	}

	function showUserCategories ($CURRENT_USER) {
      global $DISPLAY, $DBS, $UF;
      
	  if($CURRENT_USER['username']) {
      	 $results = $DBS->sql_query("SELECT {$DBS->catfield['cid']} FROM {$DBS->categorytable} WHERE {$DBS->catfield['parent']}=0 AND {$DBS->catfield['ownerid']}=" . $CURRENT_USER['user_id'] . " ORDER BY {$DBS->catfield['pos']}");
	  	 for($i=0; $i < mysql_numrows($results); $i++) {
	  	 	$this->showCategoryData($this->getCategoryData(mysql_result($results, $i, $DBS->catfield['cid'])), $CURRENT_USER);
	  	 }	  	
	  }
	}

	function showAdminCategories ($CURRENT_USER) {
      global $DISPLAY, $DBS, $UF;
      
      $results = $DBS->sql_query("SELECT {$DBS->catfield['cid']} FROM {$DBS->categorytable} WHERE {$DBS->catfield['parent']}=0 AND {$DBS->catfield['ownerid']}=0" . " ORDER BY {$DBS->catfield['pos']}");
	  for($i=0; $i < mysql_numrows($results); $i++) {
	     $this->showCategoryData($this->getCategoryData(mysql_result($results, $i, $DBS->catfield['cid'])), $CURRENT_USER);
	  }
	}

	function createAlbum($albumname, $albumdesc, $albumkeywords, $catid) {
		global $DBS;
        $albumpos = 0;
      	$results = $DBS->sql_query("SELECT COUNT(*) AS CX, MAX({$DBS->albumfield['pos']}) AS MX FROM {$DBS->albumtable} WHERE {$DBS->albumfield['category']}=" . $catid);
       	if(mysql_result($results, 0, "CX") > 0) {
       		$albumpos = mysql_result($results, 0, "MX") + 1;	
       	}

		$DBS->sql_update("INSERT INTO {$DBS->albumtable} ({$DBS->albumfield['title']},{$DBS->albumfield['description']},{$DBS->albumfield['category']},{$DBS->albumfield['keyword']},{$DBS->albumfield['pos']}) VALUES ('{$albumname}', '{$albumdesc}', '{$catid}', '{$albumkeywords}', '{$albumpos}')");
		return $this->getAlbumData($DBS->sql_insert_id());
	}
	
	function moveAlbum($albumid, $albumpos) {
		global $DBS;
		
		$results = $DBS->sql_query("SELECT * FROM {$DBS->albumtable} WHERE {$DBS->albumfield['aid']}=" . $albumid);
		if (mysql_numrows($results)) {
			$catid = mysql_result($results, 0, $DBS->albumfield['category']);
			$oldpos = mysql_result($results, 0, $DBS->albumfield['pos']);
			if ($oldpos < $albumpos) {
				$DBS->sql_update("UPDATE {$DBS->albumtable} SET {$DBS->albumfield['pos']}={$DBS->albumfield['pos']}-1 WHERE {$DBS->albumfield['category']}=" . $catid . " AND {$DBS->albumfield['pos']} <= " . $albumpos);
			} else if ($oldpos > $albumpos){
				$DBS->sql_update("UPDATE {$DBS->albumtable} SET {$DBS->albumfield['pos']}={$DBS->albumfield['pos']}+1 WHERE {$DBS->albumfield['category']}=" . $catid . " AND {$DBS->albumfield['pos']} >= " . $albumpos);
			}
			$DBS->sql_update("UPDATE {$DBS->albumtable} SET {$DBS->albumfield['pos']}=" . $albumpos . " WHERE {$DBS->albumfield['aid']}=" . $albumid);
			return true;
		}

		return false;
	}	

	function modifyAlbum($albumid, $albumname, $albumdesc, $albumthumb, $albumpassword, $albumpasswordhint) {
		global $DBS;

	    $sets = "";
	    if ($albumname === false) { }
	    else $sets = $sets . (($sets == "")? "" : ",") . "{$DBS->albumfield['title']}='{$albumname}'";

	    if ($albumdesc === false) { }
	    else $sets = $sets . (($sets == "")? "" : ",") . "{$DBS->albumfield['description']}='{$albumdesc}'";

	    if ($albumthumb === false) { }
	    else $sets = $sets . (($sets == "")? "" : ",") . "{$DBS->albumfield['thumb']}='{$albumthumb}'";

	    if ($albumpassword === false) { }
	    else {
	       $albumpassword = md5($albumpassword);
	       $sets = $sets . (($sets == "")? "" : ",") . "{$DBS->albumfield['alb_password']}='{$albumpassword}'";	
	    }

	    if ($albumpasswordhint === false) { }
	    else $sets = $sets . (($sets == "")? "" : ",") . "{$DBS->albumfield['alb_password_hint']}='{$albumpasswordhint}'";

		if ($sets != "") $DBS->sql_update("UPDATE {$DBS->albumtable} SET " . $sets . " WHERE {$DBS->albumfield['aid']}={$albumid}");
		return $this->getAlbumData($albumid);
	}

    function removeAlbum($albumid) {
		global $DBS, $DISPLAY, $PF;

		$DBS->sql_update("DELETE FROM {$DBS->albumtable} WHERE {$DBS->albumfield['aid']}=" . $albumid);

  	    $results = $DBS->sql_query("SELECT {$DBS->picturefield['pid']} FROM {$DBS->picturetable} WHERE {$DBS->picturefield['aid']}=" . $albumid);
	    for($i=0; $i < mysql_numrows($results); $i++) {
	  	   $PF->removePicture(mysql_result($results, $i, $DBS->picturefield['pid']));
	    }
        mysql_free_result($results);
    }
    
}

?>