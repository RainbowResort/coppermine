<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2007 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// management of the plugin
$thisplugin->add_action('plugin_install','user_vote_install');
$thisplugin->add_action('plugin_uninstall','user_vote_uninstall');
$thisplugin->add_action('plugin_cleanup','user_vote_cleanup');

// at page start, language is determined, can load translations
$thisplugin->add_action('page_start','contest_init');

// setup of an album as a contest album
$thisplugin->add_filter('page_html','add_contest');
$thisplugin->add_filter('template_html','fix_relative_template');

// actions right after the image data are gathered, in get_pic_data
$thisplugin->add_filter('thumb_caption_regular','fix_caption');// fixes data 
$thisplugin->add_filter('thumb_caption_lastcom','fix_caption');// fixes data 
$thisplugin->add_filter('thumb_caption_lastcomby','fix_caption');// fixes data 
$thisplugin->add_filter('thumb_caption_lastup','fix_caption');// fixes data 
$thisplugin->add_filter('thumb_caption_lastupby','fix_caption');// fixes data 
$thisplugin->add_filter('thumb_caption_topn','fix_caption');// fixes data 
$thisplugin->add_filter('thumb_caption_toprated','fix_caption');// fixes data 
$thisplugin->add_filter('thumb_caption_lasthits','fix_caption');// fixes data 
$thisplugin->add_filter('post_breadcrumb','fix_displayimage');
$thisplugin->add_filter('gallery_header','fix_ratepic');
global $saved_template_image_comments,$saved_template_add_your_comment;
global $lang_contest;

function contest_init(){
   //save templates for comments will be used in fix_displayimage
   global $template_image_comments,$template_add_your_comment,$saved_template_image_comments,$saved_template_add_your_comment;
   $saved_template_image_comments=$template_image_comments;$saved_template_add_your_comment=$template_add_your_comment;
   // We load the chosen language file
   global $lang_contest,$CONFIG;
   $l=$CONFIG['lang'];if (!file_exists("./plugins/adxd_voting/lang/{$l}.php")) $l='english';
   require_once("./plugins/adxd_voting/lang/{$l}.php");
}

function fix_caption($rowset){
   global $CONFIG,$CURRENT_ALBUM_DATA,$lang_rate_pic,$lang_contest,$album;
   //remove caption text if thumbnail image belongs to a Concours in progress
   if(is_numeric($album) && $album>0){
      $result = cpg_db_query("SELECT votes,contest FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid='$album'");
      if ($row=mysql_fetch_row($result)) {
          $votes=$row[1];$album_is_contest=$row[0];
      } else {
          $album_is_contest='NO';$votes='NO';
      }
      if ($votes=='YES' && $album_is_contest=='YES'){
         //remove caption text if thumbnail image belongs to a Concours in progress
         foreach ($rowset as &$r) { 
             $r['caption_text']="";$r['title']="";
         }
         unset($r);
         //for the image in progress, checks if the user has voted, and prepares the text that will be included through cheating the no_vote option by setting vote to 0.
         $pid = $rowset[0]['pid'];
         if ($pid != '') {
             $result = cpg_db_query("SELECT rating FROM `{$CONFIG['TABLE_PREFIX']}user_votes` WHERE pid = $pid AND user_id  = ".USER_ID);
         }
         if ($row = mysql_fetch_row($result)) {
             $myvote = " - ".$lang_contest['my_vote'].": ".$row[0]; 
         } else { 
             $myvote = "";
         }
         $rowset[0]['votes'] = 0;
         $lang_rate_pic['no_votes'] = $lang_contest['wip'].$myvote;
         //checks if the user can vote
         if($rowset[0]['owner_id']==USER_ID) {
             $lang_rate_pic['rate_this_pic']=$lang_contest['my_image'];
         }
      }
   }else{/*
      // non regular albums (bestof,etc...) remove photos within a non finished contest
   	$forbidden_aids=array();
   	$result = cpg_db_query("SELECT aid FROM {$CONFIG['TABLE_PREFIX']}albums WHERE contest ='YES' AND votes ='YES'");
      while($row=mysql_fetch_row($result)){$forbidden_aids[]=$row[0];}
   	if(count($forbidden_aids)>0) {
   	  foreach($rowset AS $index=>$row){if(in_array($row['aid'],$forbidden_aids)) unset($rowset[$index]);}
   	}*/
   }
   // for image already voted, not within a contest in progress - probably should change
   foreach ($rowset as $key => $r) {
      $pattern = "#(<span class=\"thumb_caption\">)(.*?)(</span>)#s";
      if (preg_match($pattern, $r['caption_text'], $matches)){
      $subst="<span class=\"thumb_caption\"> Evaluation: ".round($r['pic_rating'] / 2000,2)." / 10 " .sprintf($lang_get_pic_data['n_votes'], $r['votes'])."</span>";
         $rowset[$key]['caption_text'] = str_replace($matches[1].$matches[2].$matches[3], $subst, $r['caption_text']);
      }
   }
   return $rowset;
}

function fix_displayimage(){
   // no specifics for Thumbnail page today.
   if (!defined("DISPLAYIMAGE_PHP")) return;

   global $CONFIG,$film_strip;
   global $CURRENT_PIC_DATA,$CURRENT_ALBUM_DATA,$comments,$picture,$votes,$pic_info,$template_display_media,$THEME_DIR;
   global $saved_template_image_comments, $saved_template_add_your_comment, $lang_display_comments,$lang_contest,$template_image_rating;
   if (!array_key_exists('aid',$CURRENT_ALBUM_DATA))return;
   //checks if current album is a contest - not extracted in displayimage.php 
   $result = cpg_db_query("SELECT contest FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid='{$CURRENT_ALBUM_DATA['aid']}'");
   if ($row=mysql_fetch_row($result)) $CURRENT_ALBUM_DATA['contest']=$row[0];else return;
   // display the votes as a voting page.
   if($CURRENT_ALBUM_DATA['votes'] != 'YES' && $CURRENT_ALBUM_DATA['contest'] == 'YES') {
      if(!defined('MAX_RATING'))define ('MAX_RATING',5);
      $title=$lang_contest['result'];
      $votetext = $CURRENT_PIC_DATA['votes'] ? sprintf($lang_contest['evaluation'], round($CURRENT_PIC_DATA['pic_rating'] / 2000, 1),MAX_RATING ,$CURRENT_PIC_DATA['votes']) : $lang_rate_pic['no_votes'];
      $votes=$template_image_rating;
      $pattern = "#(<a href)(.*?)(</a>)#s";
      if (preg_match_all($pattern,$votes,$matches)){
         foreach($matches[0] as $key => $match) {if(preg_match("rating",$match))$votes=ereg_replace(preg_quote($match),"",$votes);}
      }
      $votes=ereg_replace("{VOTES}",$votetext,$votes);$votes=ereg_replace("{TITLE}",$title,$votes);$votes=ereg_replace("{LOCATION}",$THEME_DIR,$votes);
      if(preg_match("<!-- BEGIN rating_boxes -->",$votes)) template_extract_block($votes, 'rating_boxes', '');
   }
   //to be used only for contests in progress
   if($CURRENT_ALBUM_DATA['votes']== 'YES' && $CURRENT_ALBUM_DATA['contest'] == 'YES'){
      // do not display pic infos,owner names, captions
      $pic_info="";
      $pattern = "#(<!-- BEGIN img_desc -->)(.*?)(<!-- END img_desc -->)#s";
      if (preg_match($pattern, $picture, $matches)) $picture = str_replace($matches[0], $matches[1].$matches[3], $picture);

      //findout which image has already been noted by user in the contest and show them with a square in the film strip
      $myvotes=array();
      $query = "SELECT concat(filepath,'{$CONFIG['thumb_pfx']}',filename) FROM `{$CONFIG['TABLE_PREFIX']}user_votes` AS T1, `{$CONFIG['TABLE_PREFIX']}pictures` AS T2 WHERE T1.pid=T2.pid AND user_id  = ".USER_ID;
      $result = cpg_db_query($query);
      while ($row = mysql_fetch_row($result)) {$myvotes[]=$row[0];}
      $pattern = "#(<img )(.*?albums.*?)(\" border=\"0\")(.*?)(/>)#s";
      if (preg_match_all($pattern, $film_strip, $matches)){
         foreach($matches[0] as $key => $match) {
            foreach($myvotes as $v){if (strpos($match,$v)!==FALSE){$matches[3][$key]=" style=\"border:1pix;border-color:grey;\"";break;}}
            $film_strip=ereg_replace(preg_quote($match),$matches[1][$key].$matches[2][$key].$matches[3][$key].$matches[4][$key].$matches[5][$key],$film_strip);
         }
         $film_strip=ereg_replace("class=\"image\"","",$film_strip);
      }
      //removes alt and title from film_strip
      $pattern = "#(alt=\")(.*?)(\")#s";
      if (preg_match_all($pattern, $film_strip, $matches)){
         foreach($matches[0] as $key => $match) $film_strip=ereg_replace(preg_quote($match),"",$film_strip);
      }
      $pattern = "#(title=\")(.*?)(\")#s";
      if (preg_match_all($pattern, $film_strip, $matches)){
         foreach($matches[0] as $key => $match) $film_strip=ereg_replace(preg_quote($match),"",$film_strip);
      }
      //and try to set a border on current vote
      $result = cpg_db_query("SELECT rating FROM `{$CONFIG['TABLE_PREFIX']}user_votes` WHERE pid = {$CURRENT_PIC_DATA['pid']} AND user_id  = ".USER_ID);
      if ($row = mysql_fetch_row($result)) {
         $pattern = "#(<img.*?rating{$row[0]}.*?)(border=\"0\")(.*?/>)#s";
         if (preg_match($pattern, $votes, $matches)){$votes=ereg_replace(preg_quote($matches[0]),$matches[1]."border=\"2\"".$matches[3],$votes);}
      }
      // find if user can vote (not own image) and if can vote verifies that the voting block is not hidden
      if($CURRENT_PIC_DATA['owner_id']==USER_ID || !(USER_CAN_RATE_PICTURES)){
      //<a href="javascript:location.href='./ratepic.php?pic=22&amp;rate=1'" title="Beurk"><img src="themes/alphadxd/images/rating1.gif" border="0" alt="Beurk" /></a>
         $pattern = "#(<a href.*?ratepic.*?\>)(.*?)(</a>)#s";
         if (preg_match_all($pattern, $votes, $matches)){
            foreach($matches[0] as $key => $match) {$votes=ereg_replace(preg_quote($match),$matches[2][$key],$votes);}
         }
      }else $votes=ereg_replace(preg_quote("display: none;"),"",$votes);
      // only display current user's comments in a contest
       if($CURRENT_ALBUM_DATA['comments'] != 'YES')return;
       $comments = '';
       $pid=$CURRENT_PIC_DATA['pid'];
       if (!$CONFIG['enable_smilies']) {
           $tmpl_comment_edit_box = template_extract_block($saved_template_image_comments, 'edit_box_no_smilies', '{EDIT}');
           template_extract_block($saved_template_image_comments, 'edit_box_smilies');
           template_extract_block($saved_template_add_your_comment, 'input_box_smilies');
       } else {
           $tmpl_comment_edit_box = template_extract_block($saved_template_image_comments, 'edit_box_smilies', '{EDIT}');
           template_extract_block($saved_template_image_comments, 'edit_box_no_smilies');
           template_extract_block($saved_template_add_your_comment, 'input_box_no_smilies');
       }
       $tmpl_comments_buttons = template_extract_block($saved_template_image_comments, 'buttons', '{BUTTONS}');
       template_extract_block($saved_template_image_comments, 'ipinfo', '');//suppressed by PL
       template_extract_block($saved_template_image_comments, 'report_comment_button');// won't report on own comment, would we?
   
       $newpostok=true;
       $query="SELECT msg_id, msg_author, msg_body, UNIX_TIMESTAMP(msg_date) AS msg_date, author_id, author_md5_id, msg_raw_ip, msg_hdr_ip, pid FROM {$CONFIG['TABLE_COMMENTS']} WHERE pid='$pid' AND msg_author='".USER_NAME ."' ORDER BY msg_id DESC LIMIT 1";
       $result = cpg_db_query($query);
       if ($row = mysql_fetch_array($result)) {
           $user_can_edit = true;
           $comment_buttons = $tmpl_comments_buttons;$comment_edit_box = $tmpl_comment_edit_box;
   
           if ($CONFIG['enable_smilies']) {
               $comment_body = process_smilies(make_clickable($row['msg_body']));
               $smilies = generate_smilies("f{$row['msg_id']}", 'msg_body');
           } else {
               $comment_body = make_clickable($row['msg_body']);
               $smilies = '';
           }
   
           $params = array('{EDIT}' => &$tmpl_comment_edit_box,'{BUTTONS}' => &$tmpl_comments_buttons);
           $template = template_eval($saved_template_image_comments, $params);
   
           $params = array('{MSG_AUTHOR}' => stripslashes($row['msg_author']),
               '{MSG_ID}' => $row['msg_id'],
               '{PID}' => $row['pid'],
               '{EDIT_TITLE}' => &$lang_display_comments['edit_title'],
               '{CONFIRM_DELETE}' => &$lang_display_comments['confirm_delete'],
               '{MSG_DATE}' => localised_date($row['msg_date'], '%d %B %Y'),
               '{MSG_BODY}' => bb_decode($comment_body),
               '{MSG_BODY_RAW}' => $row['msg_body'],
               '{OK}' => &$lang_display_comments['OK'],
               '{SMILIES}' => $smilies,
               '{REPORT_COMMENT_TITLE}' => &$lang_display_comments['report_comment_title'],
               '{WIDTH}' => $CONFIG['picture_table_width']
               );
           $comments .= template_eval($template, $params);
           $newpostok=false;// only 1 comment per author
           
       }
       if(USER_ID==$CURRENT_PIC_DATA['owner_id']|| USER_ID==0)$newpostok=false;
   
      if ($newpostok) {
           $user_name_input = '<tr><td><input type="hidden" name="msg_author" value="' . stripslashes(USER_NAME) . '" /></td>';
           template_extract_block($saved_template_add_your_comment, 'user_name_input', $user_name_input);
           $user_name = '';
           $params = array('{ADD_YOUR_COMMENT}' => $lang_display_comments['add_your_comment'],
               // Modified Name and comment field
               '{NAME}' => $lang_display_comments['name'],
               '{COMMENT}' => "",
               '{PIC_ID}' => $pid,
               '{USER_NAME}' => $user_name,
               '{MAX_COM_LENGTH}' => $CONFIG['max_com_size'],
               '{OK}' => $lang_display_comments['OK'],
               '{SMILIES}' => '',
               '{WIDTH}' => $CONFIG['picture_table_width'],
               );
   
           if ($CONFIG['enable_smilies'])$params['{SMILIES}'] = generate_smilies();
           else template_extract_block($saved_template_add_your_comment, 'smilies');
           $comments .= template_eval($saved_template_add_your_comment, $params);
       }
    }

}
function fix_ratepic(){
//replaces distribution ratepic by function to manage votes
   if(defined("RATEPIC_PHP")){
      global $CONFIG;
      // Check if required parameters are present
      if (!isset($_GET['pic']) || !isset($_GET['rate'])) return "";
      $pic = (int)$_GET['pic'];
      $rate = (int)$_GET['rate'];$rate = min($rate, 10);$rate = max($rate, 1);
      // If user does not accept script's cookies, we don't accept the vote
      if (!isset($_COOKIE[$CONFIG['cookie_name'] . '_data'])) {header('Location: displayimage.php?pos=' . (- $pic));exit;}
      // If referer is not displayimage.php we don't accept the vote
      if (!eregi("displayimage",$_SERVER["HTTP_REFERER"])){header('Location: displayimage.php?pos=' . (- $pic));exit;}
      
      // Retrieve picture/album information & check if user can rate picture, and if this is a contest - else let go to normal ratepic
      $sql = "SELECT a.votes as votes_allowed, a.contest, p.votes as votes, pic_rating, owner_id " . "FROM {$CONFIG['TABLE_PICTURES']} AS p, {$CONFIG['TABLE_ALBUMS']} AS a " . "WHERE p.aid = a.aid AND pid = '$pic' LIMIT 1";
      $result = cpg_db_query($sql);
      if (!mysql_num_rows($result)) return "";
      $row = mysql_fetch_array($result);
      if (!USER_CAN_RATE_PICTURES || $row['votes_allowed'] == 'NO' || $row['contest'] == 'NO')return ""; 
      //removed previous votes for USER_ID
   	cpg_db_query("DELETE FROM `{$CONFIG['TABLE_PREFIX']}user_votes` WHERE pid = $pic AND user_id  = ".USER_ID);
   	// insert new vote
   	cpg_db_query("INSERT INTO `{$CONFIG['TABLE_PREFIX']}user_votes` SET pid = $pic, rating = $rate,user_id  = ".USER_ID);
   	// get average rating and store them with the image
   	$result=cpg_db_query("SELECT COUNT(rating), SUM(rating) FROM `{$CONFIG['TABLE_PREFIX']}user_votes` WHERE pid = $pic");
   	if($row = mysql_fetch_array($result)){$count=$row[0];$average=round($row[1]*2000.0/$count);}else{$count=0;$average=0;}
      $result = cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']}  SET pic_rating = '$average', votes = $count  WHERE pid = '$pic' LIMIT 1");
       // record the details of hits for the picture if the option is set in CONFIG
      if ($CONFIG['vote_details']) {
      	$client_details = cpg_determine_client();$os = $client_details['os'];$browser = $client_details['browser'];
       	$time = time();$referer = addslashes(htmlentities($_SERVER['HTTP_REFERER']));
      	cpg_db_query("INSERT INTO {$CONFIG['TABLE_VOTE_STATS']} SET pid = $pic,rating = $rate,Ip   = '$raw_ip',sdate = '$time',referer = '$referer',browser = '$browser',os = '$os'");
      } 
      $location = "displayimage.php?pos=" . (- $pic);
      $header_location = (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE'))) ? 'Refresh: 0; URL=' : 'Location: ';
      header($header_location . $location);
      pageheader($lang_info, "<META http-equiv=\"refresh\" content=\"1;url=$location\">");
      msg_box($lang_info, $lang_rate_pic_php['rate_ok'], $lang_continue, $location);
      pagefooter();
      ob_end_flush();    
   }
   return "";
}

function add_contest(&$html){
// Album setup as a contest
   if(defined('MODIFYALB_PHP') && GALLERY_ADMIN_MODE){
      global $CONFIG,$ALBUM_DATA,$lang_yes,$lang_no,$lang_contest;
      $name='contest';
      $value = isset($ALBUM_DATA[$name]) ? $ALBUM_DATA[$name] : 'NO';
      $yes_selected = $value == 'YES' ? 'checked="checked"' : '';
      $no_selected = $value == 'NO' ? 'checked="checked"' : '';
      $newline= "<tr> <td class=\"tableb\"> {$lang_contest['iscontest']} </td><td class=\"tableb\" valign=\"top\">"
      . "<input type=\"radio\" id=\"{$name}1\" name=\"$name\" value=\"YES\" $yes_selected /><label for=\"{$name}1\" class=\"clickable_option\">$lang_yes</label> &nbsp;&nbsp; "
      . "<input type=\"radio\" id=\"{$name}0\" name=\"$name\" value=\"NO\"  $no_selected  /><label for=\"{$name}0\" class=\"clickable_option\">$lang_no</label> </td> </tr>";
      
      $pattern = "#(<tr>)(.*?)(id=\"votes1\")(.*?)(</tr>)#s";
      if (preg_match($pattern, $html, $matches)){
         $html=ereg_replace(preg_quote($matches[0]),$matches[0].$newline,$html);
      }
      $form1="<form method=\"post\" name=\"modifyalbum\" action=\"db_input.php\">";
      $form2="<form method=\"post\" name=\"modifyalbum\" action=\"./plugins/adxd_voting/contest_db_input.php\">";
      $html=ereg_replace(preg_quote($form1),$form2,$html);
   }
   //remove image titles from thumbnails in case of contest in progress
   if(defined('THUMBNAILS_PHP')){
      global $CONFIG,$album;
      $result = cpg_db_query("SELECT contest,votes FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid='$album'");
      if ($row=mysql_fetch_row($result)) $contest=$row[0];$votes=$row[1];
      // display the votes as a voting page.
      if($votes == 'YES' && $contest == 'YES') {
         $pattern = "#(<img src=\"album)(.*?)(title=\")(.*?)(\")(.*?)(/>)#s";
         $votes=$template_image_rating;
         if (preg_match_all($pattern,$html,$matches)){
            foreach($matches[0] as $key => $match) $html=ereg_replace(preg_quote($matches[3][$key].$matches[4][$key].$matches[5][$key]),"",$html);
         }
      }
    }

   return $html;
}
function fix_relative_template($template){// uses because template.html called from a <LINK> does not realize the path is not relative to the plugin place
   if(defined('CONTEST_DB_INPUT_PHP'))return ereg_replace("themes/","../../themes/",$template);
   else return $template;
}
// plugin management
function user_vote_uninstall() {
    return user_vote_cleanup();
}

function user_vote_cleanup() {
   global $thisplugin, $CONFIG;
	$sql = "DROP TABLE IF EXISTS `{$CONFIG['TABLE_PREFIX']}user_votes`";
   $result = cpg_db_query("SHOW COLUMNS FROM `{$CONFIG['TABLE_PREFIX']}albums`");
   while ($row = mysql_fetch_assoc($result)) {
      if($row['field']=="contest"){
         $sql = "ALTER TABLE `{$CONFIG['TABLE_PREFIX']}albums` DROP `contest`"; 
         return cpg_db_query($sql);
      }
   }
}	

function user_vote_install() {
   global $thisplugin, $CONFIG;
   //user_vote_cleanup(); 
   // Commented out, because this line crashes the plugin on initial install. If you want it back, you need to run some queries first that check if the column is there in the first place.	
	// code fixed but not retested
   $sql = <<< EOT
	
CREATE TABLE IF NOT EXISTS `{$CONFIG['TABLE_PREFIX']}user_votes` (
  `vid` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `pid` varchar(100)  NOT NULL,
  `rating` smallint(6) unsigned NOT NULL,
  PRIMARY KEY  (`vid`),
  KEY `pid` (`pid`)
) TYPE=MyISAM ;

EOT;
   echo $sql;
	cpg_db_query($sql);
	$sql="ALTER TABLE `{$CONFIG['TABLE_PREFIX']}albums` ADD `contest` ENUM( 'YES', 'NO' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'NO'";
   echo $sql;
	return cpg_db_query($sql);
 }
 
?>
