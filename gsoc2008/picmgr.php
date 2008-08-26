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
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

define('IN_COPPERMINE', true);
define('PICMGR_PHP', true);

require('include/init.inc.php');

js_include('js/jquery.js');
js_include('js/jquery.tablednd.js');
js_include('js/jquery.blockUI.js');

if (!(GALLERY_ADMIN_MODE || USER_ADMIN_MODE)) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

function get_album_data()
{
    global $CONFIG, $ALBUM_LIST;

   $result = cpg_db_query("SELECT aid, title FROM {$CONFIG['TABLE_ALBUMS']} ORDER BY title");
   if (mysql_num_rows($result) > 0){
      $rowset = cpg_db_fetch_rowset($result);
      foreach ($rowset as $alb){
         $ALBUM_LIST[]=array($alb['aid'], $alb['title']);
      }
     //s print_r($ALBUM_LIST);
   }
}

function albumselect($id = "album") {
// frogfoot re-wrote this function to present the list in categorized, sorted and nicely formatted order

    global $CONFIG, $lang_picmgr_php, $aid, $lang_errors, $cpg_udb;
    static $select = "";

    // Reset counter
    $list_count = 0;

    if ($select == "") {
        // albums in root category
        if (GALLERY_ADMIN_MODE) {
            $result = cpg_db_query("SELECT aid, title FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = 0");
            while ($row = mysql_fetch_array($result)) {
                // Add to multi-dim array for later sorting
                $listArray[$list_count]['cat'] = $lang_search_new_php['albums_no_category'];
                $listArray[$list_count]['aid'] = $row['aid'];
                $listArray[$list_count]['title'] = $row['title'];
                $list_count++;
            }
            mysql_free_result($result);
        }

        // albums in public categories
        if (GALLERY_ADMIN_MODE) {
            $result = cpg_db_query("SELECT DISTINCT a.aid AS aid, a.title AS title, c.name AS cname FROM {$CONFIG['TABLE_ALBUMS']} AS a, {$CONFIG['TABLE_CATEGORIES']} AS c WHERE a.category = c.cid AND a.category < '" . FIRST_USER_CAT . "'");
            while ($row = mysql_fetch_array($result)) {
                // Add to multi-dim array for later sorting
                $listArray[$list_count]['cat'] = $row['cname'];
                $listArray[$list_count]['aid'] = $row['aid'];
                $listArray[$list_count]['title'] = $row['title'];
                $list_count++;
               
            }
            mysql_free_result($result);
        }

        // albums in user's personal galleries
//        if (defined('UDB_INTEGRATION')) {
            //if (GALLERY_ADMIN_MODE) {
//                $sql = $cpg_udb->get_admin_album_list();
            /*} else {
                $sql = "SELECT aid, title FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = ".(FIRST_USER_CAT + USER_ID);
            }*/
//       } else {
            if (GALLERY_ADMIN_MODE) {
//                $sql = "SELECT aid, CONCAT('(', user_name, ') ', title) AS title " . "FROM {$CONFIG['TABLE_ALBUMS']} AS a " . "INNER JOIN {$CONFIG['TABLE_USERS']} AS u ON category = (" . FIRST_USER_CAT . " + user_id)";
                $sql = $cpg_udb->get_admin_album_list();  //it's always bridged so we no longer need to check.
            } else {
                $sql = "SELECT aid, title AS title FROM {$CONFIG['TABLE_ALBUMS']}  WHERE category = " . (FIRST_USER_CAT + USER_ID);
            }
//       }
        $result = cpg_db_query($sql);
        while ($row = mysql_fetch_array($result)) {
            // Add to multi-dim array for later sorting
            $listArray[$list_count]['cat'] = $lang_search_new_php['personal_albums'];
            $listArray[$list_count]['aid'] = $row['aid'];
            $listArray[$list_count]['title'] = $row['title']; 
            $list_count++;
        }
        mysql_free_result($result);
	
	    if (!$aid) {
            $select = '<option value="0">' . $lang_picmgr_php['no_album'] . "</option>\n";
        }

        // Sort the pulldown options by category and album name
        $listArray = array_csort($listArray,'cat','title');

        // Create the nicely sorted and formatted drop down list
        $alb_cat = '';


        foreach ($listArray as $val) {
            if ($val['cat'] != $alb_cat) {
         		if ($alb_cat) $select .= "</optgroup>\n";
                $select .= '<optgroup label="' . $val['cat'] . '">' . "\n";
                $alb_cat = $val['cat'];
            }
            $select .= '<option value="' . $val['aid'] . '"' . ($val['aid'] == $aid ? ' selected="selected"' : '') . '>   ' . $val['title'] . "</option>\n";
        }
        if ($alb_cat) $select .= "</optgroup>\n";
    }

    return "\n<select name=\"$id\" class=\"listbox\"  >\n$select</select>\n";
}
 	/**set js variable to changes albums*/
 	$change_album  = $lang_picmgr_php['change_album'];
 	set_js_var('change_album', $change_album);
 	
 	
pageheader($lang_picmgr_php['pic_mgr']);
?>


<form name="picture_menu" id="cpgformPic" method="post" action="delete.php?what=picmgr" >
<?php starttable("100%", $lang_picmgr_php['pic_mgr'], 1); ?>
<noscript>
<tr>
                <td colspan="2" class="tableh2">
                <?php echo $lang_common['javascript_needed'] ?>
                </td>
</tr>
</noscript>
<tr>
<?php
   //$aid = isset($_GET['aid']) ? (int) $_GET['aid'] : 0;
	$aid = ($superCage->get->keyExists('aid')) ? $superCage->get->getInt('aid') : 0;
   if (GALLERY_ADMIN_MODE || USER_ADMIN_MODE) {
      $result = cpg_db_query("SELECT aid, pid, filename,title FROM {$CONFIG['TABLE_PICTURES']} WHERE aid = $aid ORDER BY position ASC, pid");
//BM in case I have to fix an album      $result = cpg_db_query("SELECT aid, pid, filename FROM {$CONFIG['TABLE_PICTURES']} WHERE aid = $aid ORDER BY filename");
   } else cpg_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);

   $rowset = cpg_db_fetch_rowset($result);
   $i=100;
   $sort_order = '';

   if (count ($rowset) > 0) foreach ($rowset as $picture){
      $sort_order .= $picture['pid'].'@'.($i++).',';
   }
  // print_r($sort_order);
?>
	   <input type="hidden" name="albunm_id" value="<?php echo $aid; ?>" />
 	   <input type="hidden" name="delete_picture" value="" />
	   <input type="hidden" name="sort_order" value="<?php echo $sort_order ?>" />
	   <input type="hidden" id="pictur_order" name="pictur_order" value="" />
	   
		<td class="tableb" valign="top" align="center">   
      <br />
      <table width="400" border="0" cellspacing="0" cellpadding="0">
<?php
//Joe Ernst - Added USER_ADMIN_MODE
if (GALLERY_ADMIN_MODE || USER_ADMIN_MODE) {
        $ALBUM_LIST = array();
        $ALBUM_LIST[] = array(0, $lang_picmgr_php['no_album']);
        get_album_data(FIRST_USER_CAT + USER_ID,'');

echo <<<EOT
      <tr>
         <td style="float:left; margin-left:60px;">
            <b>{$lang_picmgr_php['select_album']}</b>
EOT;
        print albumselect('aid');
echo <<<EOT
         </td>
      </tr>
EOT;
}
?>	<tr>
		<td>
		<div id="sort">
			<table id="pic_sort">
<?php
   $i=100;
   $lb = '';
   $j=1;
   if (count ($rowset) > 0) 
   		foreach ($rowset as $picture){
	//create a table to sort the picture  
 	$lb .='<tr id='.$picture["pid"].' title='.$picture["pid"].'><td width="10%" style="padding-left:20px" >'.$j.'</td><td><img src="images/image.png"  /><td style="width:335px;padding-left:10px;">'.$picture["filename"].'</td><td style="width:300px;padding-left:10px;">'.$picture["title"].'</td></tr>';
	$j++;
   }
   echo $lb;
   echo <<<EOT
         </td>
      </table>
	  </div>
	</td>
     </tr>
      <tr>
         <td>
		 	<table>
               <tr>
               <td style="float:left; margin-left:50px;"><a class="photoUp"><img  src="images/move_up.gif" width="26" height="21" border="0" alt="" /></a>
			   <a class="photoDown"><img src="images/move_down.gif" width="26" height="21" border="0" alt="" /></a>
               </td>
<!-- Joe Ernst: I commented this out because I can't get it to work. -->
               <td align="center" style="width: 1px;"><img src="images/spacer.gif" width="1" alt=""><br />
               </td>
            </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td><br />
            <br />
         </td>
      </tr>
        </table>
   </td>
</tr>
EOT;
    if($CONFIG['default_sort_order'] != 'pa' && $CONFIG['default_sort_order'] != 'pd') {
    echo <<<EOT
<tr>
    <td colspan="2" align="left" class="tableh2">
        {$lang_picmgr_php['explanation_header']}:
        <ul style="margin-top:0px;margin-bottom:0px;">
            <li>{$lang_picmgr_php['explanation1']}</li>
            <li>{$lang_picmgr_php['explanation2']}</li>
        </ul>
    </td>
</tr>
EOT;
     }

     echo <<<EOT
<tr>
	<td colspan="2" align="center" class="tablef">
	<input type="submit" class="button" value="{$lang_picmgr_php['apply_modifs']}" />
	<a href="index.php"  class="button"> Home </a>
</td>
</tr>
EOT;
   endtable();
   print '</form>';
   pagefooter();
   ob_end_flush();
?>