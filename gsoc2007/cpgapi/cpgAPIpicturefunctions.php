<?php
/*
 * PHP library for all album related functions in CPG
 * @author xnitingupta
 */

/**
 * Class for photo related functions
 */
class picturefunctions {
    
    function authorizeuserpicture($CURRENT_USER, $picid, $perm, $albumpassword) {
		global $CF, $DBS, $UF, $AF;

		$results = $DBS->sql_query("SELECT * FROM {$DBS->picturetable} WHERE {$DBS->picturefield['pid']}={$picid}");
		if (mysql_numrows($results)) {
		   $albumid = mysql_result($results, 0, $DBS->picturefield['aid']);
		}  else {
		   return false;
		}		
		
		return $AF->authorizeuseralbum($CURRENT_USER, $albumid, $perm, $albumpassword);
	}	
    
    
    function addPicture($albumid, $pictitle, $piccaption, $pickeywords, $filename, $extension, $filesize, $ownername, $ownerid, $user1, $user2, $user3, $user4) {
    	global $DBS, $CF, $CONFIG;
    	
    	$picpos = 0;
      	$results = $DBS->sql_query("SELECT COUNT(*) AS CX, MAX({$DBS->picturefield['pos']}) AS MX FROM {$DBS->picturetable} WHERE {$DBS->picturefield['aid']}=" . $albumid);
       	if(mysql_result($results, 0, "CX") > 0) {
       		$picpos = mysql_result($results, 0, "MX") + 1;	
       	}
    	    	
    	$DBS->sql_update("INSERT INTO {$DBS->picturetable} ({$DBS->picturefield['aid']},{$DBS->picturefield['filename']},{$DBS->picturefield['filesize']},{$DBS->picturefield['ownername']},{$DBS->picturefield['ownerid']},{$DBS->picturefield['title']},{$DBS->picturefield['caption']},{$DBS->picturefield['keywords']},{$DBS->picturefield['user1']},{$DBS->picturefield['user2']},{$DBS->picturefield['user3']},{$DBS->picturefield['user4']},{$DBS->picturefield['pos']}) VALUES ('{$albumid}','{$filename}','{$filesize}','{$ownername}','{$ownerid}','{$pictitle}','{$piccaption}','{$pickeywords}','{$user1}','{$user2}','{$user3}','{$user4}','{$picpos}')");
    	$picid =  $DBS->sql_insert_id();
    	
    	$randomname = $CF->str_makerand(7, 10, true, false, true);   	
    	$filepath = $CONFIG['fullpath'] . $CONFIG['userpics'] . $randomname . "." . $extension;
    	$DBS->sql_update("UPDATE {$DBS->picturetable} SET {$DBS->picturefield['filepath']}='" . $filepath . "', {$DBS->picturefield['pic_raw_ip']}='" . $_SERVER['REMOTE_ADDR'] . "', {$DBS->picturefield['pic_hdr_ip']}='" . $_SERVER['REMOTE_ADDR'] . "', {$DBS->picturefield['lasthit_ip']}='" . $_SERVER['REMOTE_ADDR'] . "' WHERE {$DBS->picturefield['pid']}=" . $picid);
    	return $picid;
    }
    
    function checkExtension($extension) {
    	global $DBS;
    	$results = $DBS->sql_query("SELECT * FROM {$DBS->filetypetable} WHERE {$DBS->filetypefield['extension']}='" . $extension . "';");
    	if (mysql_numrows($results))
    	   return true;
    	return false;
    }
    
    function getPicturePath($pictureid) {
    	global $DBS;
    	$results = $DBS->sql_query("SELECT {$DBS->picturefield['filepath']} FROM {$DBS->picturetable} WHERE {$DBS->picturefield['pid']}=" . $pictureid);
    	if  (mysql_numrows($results)) {
    		return mysql_result($results, 0, $DBS->picturefield['filepath']);
    	}
    	return false;
    }

	function getPictureData($pictureid) {
		global $DISPLAY, $DBS;

    	$fieldstring = "";
    	for($i=0;$i<count($DISPLAY->picturefields);$i++) {
       		if($i!=0) $fieldstring .= ", ";
       		$fieldstring .= "{$DBS->picturefield[$DISPLAY->picturefields[$i]]} AS {$DISPLAY->picturefields[$i]}";
    	}
    	
    	$sql =  "SELECT $fieldstring FROM {$DBS->picturetable}";
    	$sql .= " WHERE {$DBS->picturefield['pid']} = '$pictureid'";
    	$results = $DBS->sql_query($sql);

    	if (mysql_num_rows($results)) {
       		$PICTURE_DATA = mysql_fetch_assoc($results);
       		mysql_free_result($results);
       		return $PICTURE_DATA;
    	}  else {
           $PICTURE_DATA = array();
           $PICTURE_DATA['error'] = true;
           $PICTURE_DATA['messagecode'] = "picture_not_found";
           return $PICTURE_DATA;   	      	
    	}
	}
    
    function showPicture($pictureid) {
  	   global $DBS;
  	   
  	   $DBS->sql_update("UPDATE {$DBS->picturetable} SET {$DBS->picturefield['hits']}={$DBS->picturefield['hits']}+1, {$DBS->picturefield['lasthit_ip']}='" . $_SERVER['REMOTE_ADDR'] . "' WHERE {$DBS->picturefield['pid']}=" . $pictureid);
  	   
  	   $picturepath = $this->getPicturePath($pictureid);
       if ($picturepath) {
   	      if ($fh = @fopen($picturepath, "r")) {
   	      	 $theData = fread($fh, filesize($picturepath));
   	  	     fclose($fh);
   	         echo $theData;
   	      }  else {
             $PICTURE_DATA = array();
             $PICTURE_DATA['error'] = true;
             $PICTURE_DATA['messagecode'] = "read_error";
             return $PICTURE_DATA;   	      	
   	      }
   	   }  else {
          $PICTURE_DATA = array();
          $PICTURE_DATA['error'] = true;
          $PICTURE_DATA['messagecode'] = "read_error";
          return $PICTURE_DATA;
   	   }
       return true;
    }
    
    function showPictureData ($PICTURE_DATA) {
      global $DISPLAY;

      print "<picturedata>";
      for($i=0;$i<count($DISPLAY->picturefields);$i++) {
         print "<" . $DISPLAY->picturefields[$i] . ">";
         print $PICTURE_DATA[$DISPLAY->picturefields[$i]];
         print "</" . $DISPLAY->picturefields[$i] . ">";
      }
      print "</picturedata>";
    }

	function movePicture($pictureid, $picturepos) {
		global $DBS;
		
		$results = $DBS->sql_query("SELECT * FROM {$DBS->picturetable} WHERE {$DBS->picturefield['pid']}=" . $pictureid);
		if (mysql_numrows($results)) {
			$albumid = mysql_result($results, 0, $DBS->picturefield['aid']);
			$oldpos = mysql_result($results, 0, $DBS->picturefield['pos']);
			if ($oldpos < $picturepos) {
				$DBS->sql_update("UPDATE {$DBS->picturetable} SET {$DBS->picturefield['pos']}={$DBS->picturefield['pos']}-1 WHERE {$DBS->picturefield['aid']}=" . $albumid . " AND {$DBS->picturefield['pos']} <= " . $picturepos);
			} else if ($oldpos > $picturepos){
				$DBS->sql_update("UPDATE {$DBS->picturetable} SET {$DBS->picturefield['pos']}={$DBS->picturefield['pos']}+1 WHERE {$DBS->picturefield['aid']}=" . $albumid . " AND {$DBS->picturefield['pos']} >= " . $picturepos);
			}
			$DBS->sql_update("UPDATE {$DBS->picturetable} SET {$DBS->picturefield['pos']}=" . $picturepos . " WHERE {$DBS->picturefield['pid']}=" . $pictureid);
			return true;
		}

		return false;
	}	

	function modifyPictureData($pictureid,  $pictitle, $piccaption, $pickeywords, $user1, $user2, $user3, $user4) {
		global $DBS;

	    $sets = "";
	    if ($pictitle === false) { }
	    else $sets = $sets . (($sets == "")? "" : ",") . "{$DBS->picturefield['title']}='{$pictitle}'";

	    if ($piccaption === false) { }
	    else $sets = $sets . (($sets == "")? "" : ",") . "{$DBS->picturefield['caption']}='{$piccaption}'";

	    if ($pickeywords === false) { }
	    else $sets = $sets . (($sets == "")? "" : ",") . "{$DBS->picturefield['keywords']}='{$pickeywords}'";

	    if ($user1 === false) { }
	    else $sets = $sets . (($sets == "")? "" : ",") . "{$DBS->picturefield['user1']}='{$user1}'";

	    if ($user2 === false) { }
	    else $sets = $sets . (($sets == "")? "" : ",") . "{$DBS->picturefield['user2']}='{$user2}'";

	    if ($user3 === false) { }
	    else $sets = $sets . (($sets == "")? "" : ",") . "{$DBS->picturefield['user3']}='{$user3}'";

	    if ($user4 === false) { }
	    else $sets = $sets . (($sets == "")? "" : ",") . "{$DBS->picturefield['user4']}='{$user4}'";

		if ($sets != "") $DBS->sql_update("UPDATE {$DBS->picturetable} SET " . $sets . " WHERE {$DBS->picturefield['pid']}={$pictureid}");
		return $this->getPictureData($pictureid);
	}

    function removePicture ($pictureid) {
    	global $DBS;
    	
        $DBS->sql_update("DELETE FROM {$DBS->picturetable} WHERE {$DBS->picturefield['pid']}=" . $pictureid);
    }   
}

?>