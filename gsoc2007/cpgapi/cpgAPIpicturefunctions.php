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

    function authorizeusercomment($CURRENT_USER, $msgid, $perm, $albumpassword) {
		global $CF, $DBS, $UF, $AF, $CONFIG;
		$results = $DBS->sql_query("SELECT * FROM {$DBS->commentstable} WHERE {$DBS->commentsfield['msgid']}={$msgid}");
		if (mysql_numrows($results)) {
		   if ($UF->isAdmin($CURRENT_USER['username']))
			  return true;
           if (mysql_result($results, 0, $DBS->commentsfield['author_id']) == $CURRENT_USER['user_id'])
              return true;
           if (mysql_result($results, 0, $DBS->commentsfield['author_md5_id']) == md5($CURRENT_USER['user_id']))
              return true;

		   if ($perm == "view") {
			  if ($this->authorizeuserpicture($CURRENT_USER, mysql_result($results, 0, $DBS->commentsfield['pid']), "owner", $albumpassword))
			     return true;
			  if ($CONFIG['display_comment_approval_only'] && mysql_result($results, 0, $DBS->commentsfield['approval']) == "NO")
			     return false;
			  
			  return true;
		   }
		}
		
		return false;
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
    	$DBS->sql_update("UPDATE {$DBS->picturetable} SET {$DBS->picturefield['filepath']}='" . $filepath . "', {$DBS->picturefield['pic_raw_ip']}='" . $_SERVER['REMOTE_ADDR'] . "', {$DBS->picturefield['pic_hdr_ip']}='" . $_SERVER['REMOTE_ADDR'] . "', {$DBS->picturefield['lasthit_ip']}='" . $_SERVER['REMOTE_ADDR'] . "', {$DBS->picturefield['mtime']}='" . date("Y-m-d H:i:s") . "' WHERE {$DBS->picturefield['pid']}=" . $picid);
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
    
    function showThumbNail($pictureid) {
  	   global $DBS;
  	   
  	   $picturepath = $this->getPicturePath($pictureid) . ".thumb";
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
    
    function registerPictureHit($pictureid, $search_phrase) {
  	   global $DBS;
  	   
  	   $DBS->sql_update("UPDATE {$DBS->picturetable} SET {$DBS->picturefield['hits']}={$DBS->picturefield['hits']}+1, {$DBS->picturefield['lasthit_ip']}='" . $_SERVER['REMOTE_ADDR'] . "' WHERE {$DBS->picturefield['pid']}=" . $pictureid);
  	   
  	   $browser = get_browser(null, true);
  	   $DBS->sql_update("INSERT INTO {$DBS->hitstatstable} ({$DBS->hitstatsfield['pid']}, {$DBS->hitstatsfield['ip']}, {$DBS->hitstatsfield['search_phrase']}, {$DBS->hitstatsfield['sdate']}, {$DBS->hitstatsfield['referer']}, {$DBS->hitstatsfield['browser']}, {$DBS->hitstatsfield['os']}) VALUES ('{$pictureid}', '" . $_SERVER['REMOTE_ADDR'] . "', '" . $search_phrase . "', '" . time() . "', '" . $_SERVER['HTTP_REFERER']  . "', '" . $_SERVER['HTTP_USER_AGENT'] . "', '" . $browser['platform'] . "')");
    }
    
    function showPictureData ($PICTURE_DATA) {
      global $DISPLAY, $CONFIG, $DBS, $CF;
      $ot = $CF->getvariable("setoutputtype");

      print "<picturedata";
      if($ot!="attr") print ">";
      for($i=0;$i<count($DISPLAY->picturefields);$i++) {
         if($ot!="attr") print "<";
         else print " ";
         print $DISPLAY->picturefields[$i];
         if($ot!="attr") print ">";
         else print "=\"";         
         print $PICTURE_DATA[$DISPLAY->picturefields[$i]];
         if($ot!="attr") print "</" . $DISPLAY->picturefields[$i] . ">";
         else print "\"";
      }

      $results = $DBS->sql_query("SELECT COUNT(*) AS CX, AVG({$DBS->votestatsfield['rating']}) AS AV FROM {$DBS->votestatstable} WHERE {$DBS->votestatsfield['pid']}=" . $PICTURE_DATA['pid']);
      if($ot!="attr") print "<votes>" . mysql_result($results, 0, "CX") . "</votes>";
      else print " votes=\"" . mysql_result($results, 0, "CX") . "\"";
      if (mysql_result($results, 0, "CX") >= $CONFIG['min_votes_for_rating']) {
      	 if($ot!="attr") print "<rating>" . mysql_result($results, 0, "AV") . "</rating>";
      	 else print " rating=\"" . mysql_result($results, 0, "AV") . "\"";
      }
      
      $this->showComments($PICTURE_DATA['pid']);
      if ($CONFIG['hit_details']) {
      	 $this->showHits($PICTURE_DATA['pid']);
      }   
      if ($CONFIG['vote_details']) {
      	 $this->showVotes($PICTURE_DATA['pid']);
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
        
        $results = $DBS->sql_query("SELECT {$DBS->commentsfield['msgid']} FROM {$DBS->commentstable} WHERE {$DBS->commentsfield['pid']}=" . $pictureid);
	    for($i=0; $i < mysql_numrows($results); $i++) {
	  	   $this->removeComment(mysql_result($results, $i, $DBS->commentsfield['msgid']));
	    }
        mysql_free_result($results);

        $results = $DBS->sql_query("SELECT {$DBS->votestatsfield['sid']} FROM {$DBS->votestatstable} WHERE {$DBS->votestatsfield['pid']}=" . $pictureid);
	    for($i=0; $i < mysql_numrows($results); $i++) {
	  	   $this->removeVote(mysql_result($results, $i, $DBS->votestatsfield['sid']));
	    }
        mysql_free_result($results);
        
    }
    
    function createComment($pictureid, $msgbody, $authorname, $authorid) {
    	global $DBS, $CF, $CONFIG;
    	
    	$DBS->sql_update("INSERT INTO {$DBS->commentstable} ({$DBS->commentsfield['pid']},{$DBS->commentsfield['msgauthor']},{$DBS->commentsfield['msgbody']},{$DBS->commentsfield['msgdate']},{$DBS->commentsfield['msg_raw_ip']},{$DBS->commentsfield['msg_hdr_ip']},{$DBS->commentsfield['author_id']},{$DBS->commentsfield['author_md5_id']}) VALUES ('{$pictureid}','{$authorname}','{$msgbody}','" . date("Y-m-d H:i:s") . "','" . $_SERVER['REMOTE_ADDR'] . "','" . $_SERVER['REMOTE_ADDR'] . "','{$authorid}','" . md5($authorid) . "')");
		$msgid = $DBS->sql_insert_id();
		
		if($CONFIG['comment_approval']) {
    		$DBS->sql_update("UPDATE {$DBS->commentstable} SET {$DBS->commentsfield['approval']}='NO' WHERE {$DBS->commentsfield['msgid']}='{$msgid}'");
		}
    	return $msgid;
    }

    function approveComment($msgid) {
    	global $DBS, $CF, $CONFIG;
    	
    	$DBS->sql_update("UPDATE {$DBS->commentstable} SET {$DBS->commentsfield['approval']}='YES' WHERE {$DBS->commentsfield['msgid']}='{$msgid}'");
    	return $this->getCommentData($msgid);
    }

	function getCommentData($msgid) {
		global $DISPLAY, $DBS;

    	$fieldstring = "";
    	for($i=0;$i<count($DISPLAY->commentsfields);$i++) {
       		if($i!=0) $fieldstring .= ", ";
       		$fieldstring .= "{$DBS->commentsfield[$DISPLAY->commentsfields[$i]]} AS {$DISPLAY->commentsfields[$i]}";
    	}
    	
    	$sql =  "SELECT $fieldstring FROM {$DBS->commentstable}";
    	$sql .= " WHERE {$DBS->commentsfield['msgid']} = '$msgid'";
    	$results = $DBS->sql_query($sql);

    	if (mysql_num_rows($results)) {
       		$COMMENT_DATA = mysql_fetch_assoc($results);
       		mysql_free_result($results);
       		return $COMMENT_DATA;
    	}  else {
           $COMMENT_DATA = array();
           $COMMENT_DATA['error'] = true;
           $COMMENT_DATA['messagecode'] = "comment_not_found";
           return $COMMENT_DATA;   	      	
    	}
	}

    function showCommentData ($COMMENT_DATA) {
      global $DISPLAY, $CONFIG, $DBS, $CF;
      $ot = $CF->getvariable("setoutputtype");

      print "<commentdata";
      if($ot!="attr") print ">";
      for($i=0;$i<count($DISPLAY->commentsfields);$i++) {
         if($ot!="attr") print "<";
         else print " ";
         print $DISPLAY->commentsfields[$i];
         if($ot!="attr") print ">";
         else print "=\"";
         print $COMMENT_DATA[$DISPLAY->commentsfields[$i]];
         if($ot!="attr") print "</" . $DISPLAY->commentsfields[$i] . ">";
         else print "\"";
      }
      if($ot=="attr") print ">";
      print "</commentdata>";
    }

    function showComments ($pictureid) {
      global $DISPLAY, $CONFIG, $DBS, $CF;
      $ot = $CF->getvariable("setoutputtype");
      
      if ($CONFIG['display_comment_count']) {
      	$results = $DBS->sql_query("SELECT COUNT(*) AS CX FROM {$DBS->commentstable} WHERE {$DBS->commentsfield['pid']}=" . $pictureid);
       	if($ot!="attr") print "<comment_count>" . mysql_result($results, 0, "CX") . "</comment_count>";
       	else print " comment_count=\"" . mysql_result($results, 0, "CX") . "\"";
      }
      if($ot=="attr") print ">";
      
      if ($CONFIG['display_comment_approval_only']) {
      	 $results = $DBS->sql_query("SELECT {$DBS->commentsfield['msgid']} FROM {$DBS->commentstable} WHERE {$DBS->commentsfield['pid']}=" . $pictureid . " AND {$DBS->commentsfield['approval']}='YES'");      	
      }  else {
      	 $results = $DBS->sql_query("SELECT {$DBS->commentsfield['msgid']} FROM {$DBS->commentstable} WHERE {$DBS->commentsfield['pid']}=" . $pictureid);
      }
	  for($i=0; $i < mysql_numrows($results); $i++) {
     	 $this->showCommentData($this->getCommentData(mysql_result($results, $i, $DBS->commentsfield['msgid'])));
	  }
    }

   function showAllComments ($pictureid) {
      global $DISPLAY, $CONFIG, $DBS, $CF;
      $ot = $CF->getvariable("setoutputtype");
      
      if ($CONFIG['display_comment_count']) {
      	$results = $DBS->sql_query("SELECT COUNT(*) AS CX FROM {$DBS->commentstable} WHERE {$DBS->commentsfield['pid']}=" . $pictureid);
       	if($ot!="attr") print "<comment_count>" . mysql_result($results, 0, "CX") . "</comment_count>";
       	else print " comment_count=\"" . mysql_result($results, 0, "CX") . "\"";
      }
      if($ot=="attr") print ">";
      
      $results = $DBS->sql_query("SELECT {$DBS->commentsfield['msgid']} FROM {$DBS->commentstable} WHERE {$DBS->commentsfield['pid']}=" . $pictureid . " AND {$DBS->commentsfield['approval']}='YES'");      	
	  for($i=0; $i < mysql_numrows($results); $i++) {
     	 $this->showCommentData($this->getCommentData(mysql_result($results, $i, $DBS->commentsfield['msgid'])));
	  }
    }

	function modifyComment($msgid,  $msgbody) {
		global $DBS;

	    $sets = "";
	    if ($msgbody === false) { }
	    else $sets = $sets . (($sets == "")? "" : ",") . "{$DBS->commentsfield['msgbody']}='{$msgbody}'";

		if ($sets != "") $DBS->sql_update("UPDATE {$DBS->commentstable} SET " . $sets . " WHERE {$DBS->commentsfield['msgid']}={$msgid}");
		return $this->getCommentData($msgid);
	}


    function removeComment ($msgid) {
    	global $DBS;
    	
        $DBS->sql_update("DELETE FROM {$DBS->commentstable} WHERE {$DBS->commentsfield['msgid']}=" . $msgid);
    }


    function createVote($CURRENT_USER, $pictureid, $rating) {
    	global $DBS, $CF, $CONFIG;
    	
    	$results = $DBS->sql_query("SELECT * FROM {$DBS->votestable} WHERE {$DBS->votesfield['pid']}='{$pictureid}' AND {$DBS->votesfield['user_md5_id']}='" . md5($CURRENT_USER['user_id']) . "'");
		if(!mysql_numrows($results)) {
    	   $DBS->sql_update("INSERT INTO {$DBS->votestable} ({$DBS->votesfield['pid']},{$DBS->votesfield['user_md5_id']},{$DBS->votesfield['vote_time']}) VALUES ('{$pictureid}','" . md5($CURRENT_USER['user_id']) . "','" . time() . "')");
    	   $browser = get_browser(null, true);
  	       $DBS->sql_update("INSERT INTO {$DBS->votestatstable} ({$DBS->votestatsfield['pid']}, {$DBS->votestatsfield['ip']}, {$DBS->votestatsfield['rating']}, {$DBS->votestatsfield['sdate']}, {$DBS->votestatsfield['referer']}, {$DBS->votestatsfield['browser']}, {$DBS->votestatsfield['os']}, {$DBS->votestatsfield['uid']}) VALUES ('{$pictureid}', '" . $_SERVER['REMOTE_ADDR'] . "', '" . $rating . "', '" . time() . "', '" . $_SERVER['HTTP_REFERER']  . "', '" . $_SERVER['HTTP_USER_AGENT'] . "', '" . $browser['platform'] . "', '" . $CURRENT_USER['user_id'] . "')");
		}
		
    	return $DBS->sql_insert_id();
    }

	function getVoteData($sid) {
		global $DISPLAY, $DBS;

    	$fieldstring = "";
    	for($i=0;$i<count($DISPLAY->votestatsfields);$i++) {
       		if($i!=0) $fieldstring .= ", ";
       		$fieldstring .= "{$DBS->votestatsfield[$DISPLAY->votestatsfields[$i]]} AS {$DISPLAY->votestatsfields[$i]}";
    	}
    	
    	$sql =  "SELECT $fieldstring FROM {$DBS->votestatstable}";
    	$sql .= " WHERE {$DBS->votestatsfield['sid']} = '$sid'";
    	$results = $DBS->sql_query($sql);

    	if (mysql_num_rows($results)) {
       		$VOTE_DATA = mysql_fetch_assoc($results);
       		mysql_free_result($results);
       		return $VOTE_DATA;
    	}  else {
           $VOTE_DATA = array();
           $VOTE_DATA['error'] = true;
           $VOTE_DATA['messagecode'] = "vote_not_found";
           return $VOTE_DATA;   	      	
    	}
	}

    function showVoteData ($VOTE_DATA) {
      global $DISPLAY, $CONFIG, $DBS, $CF;
      $ot = $CF->getvariable("setoutputtype");

      print "<votedata";
      if($ot!="attr") print ">";
      for($i=0;$i<count($DISPLAY->votestatsfields);$i++) {
         if($ot!="attr") print "<";
         else print " ";
         print $DISPLAY->votestatsfields[$i];
         if($ot!="attr") print ">";
         else print "=\"";
         print $VOTE_DATA[$DISPLAY->votestatsfields[$i]];
         if($ot!="attr") print "</" . $DISPLAY->votestatsfields[$i] . ">";
         else print "\"";
      }
      if($ot=="attr") print ">";
      print "</votedata>";
    }
    
    function showVotes ($pictureid) {
      global $DISPLAY, $CONFIG, $DBS, $CF;
      $ot = $CF->getvariable("setoutputtype");
      
      $results = $DBS->sql_query("SELECT {$DBS->votestatsfield['sid']} FROM {$DBS->votestatstable} WHERE {$DBS->votestatsfield['pid']}=" . $pictureid);
	  for($i=0; $i < mysql_numrows($results); $i++) {
     	 $this->showVoteData($this->getVoteData(mysql_result($results, $i, $DBS->votestatsfield['sid'])));
	  }
    }

    function removeVote ($sid) {
    	global $DBS;

        $results = $DBS->sql_query("SELECT * FROM {$DBS->votestatstable} WHERE {$DBS->votestatsfield['sid']}=" . $sid);
        if (mysql_numrows($results)) {
           $DBS->sql_update("DELETE FROM {$DBS->votestable} WHERE {$DBS->votesfield['pid']}=" . mysql_result($results, 0, $DBS->votestatsfield['pid']) . " AND {$DBS->votesfield['user_md5_id']}='" . md5(mysql_result($results, 0, $DBS->votestatsfield['uid'])) . "'");        	
        }
    	
        $DBS->sql_update("DELETE FROM {$DBS->votestatstable} WHERE {$DBS->votestatsfield['sid']}=" . $sid);
    }

	function getHitData($sid) {
		global $DISPLAY, $DBS;

    	$fieldstring = "";
    	for($i=0;$i<count($DISPLAY->hitstatsfields);$i++) {
       		if($i!=0) $fieldstring .= ", ";
       		$fieldstring .= "{$DBS->hitstatsfield[$DISPLAY->hitstatsfields[$i]]} AS {$DISPLAY->hitstatsfields[$i]}";
    	}
    	
    	$sql =  "SELECT $fieldstring FROM {$DBS->hitstatstable}";
    	$sql .= " WHERE {$DBS->hitstatsfield['sid']} = '$sid'";
    	$results = $DBS->sql_query($sql);

    	if (mysql_num_rows($results)) {
       		$HIT_DATA = mysql_fetch_assoc($results);
       		mysql_free_result($results);
       		return $HIT_DATA;
    	}  else {
           $HIT_DATA = array();
           $HIT_DATA['error'] = true;
           $HIT_DATA['messagecode'] = "hit_not_found";
           return $HIT_DATA;   	      	
    	}
	}

    function showHitData ($HIT_DATA) {
      global $DISPLAY, $CONFIG, $DBS, $CF;
      $ot = $CF->getvariable("setoutputtype");

      print "<hitdata";
      if($ot!="attr") print ">";
      for($i=0;$i<count($DISPLAY->hitstatsfields);$i++) {
         if($ot!="attr") print "<";
         else print " ";
         print $DISPLAY->hitstatsfields[$i];
         if($ot!="attr") print ">";
         else print "=\"";
         print $HIT_DATA[$DISPLAY->hitstatsfields[$i]];
         if($ot!="attr") print "</" . $DISPLAY->hitstatsfields[$i] . ">";
         else print "\"";
      }
      if($ot=="attr") print ">";
      print "</hitdata>";
    }

    function showHits ($pictureid) {
      global $DISPLAY, $CONFIG, $DBS, $CF;
      $ot = $CF->getvariable("setoutputtype");
      
      $results = $DBS->sql_query("SELECT {$DBS->hitstatsfield['sid']} FROM {$DBS->hitstatstable} WHERE {$DBS->hitstatsfield['pid']}=" . $pictureid);
	  for($i=0; $i < mysql_numrows($results); $i++) {
     	 $this->showHitData($this->getHitData(mysql_result($results, $i, $DBS->hitstatsfield['sid'])));
	  }
    }
       
}

?>