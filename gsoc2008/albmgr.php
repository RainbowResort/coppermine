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

/**
* Coppermine Photo Gallery albmgr.php
*
* This file is the which allows creation of new Albumbs and editing the names of albums,
* this is not the file which allows you to set album properties,
* also see documentation for this file's {@relativelink ../_albmgr.php.php Free Standing Code}
*
* @copyright 2002-2006 Gregory DEMAR, Coppermine Dev Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License V2
* @package Coppermine
* @version $Id$
*/

/**
* @ignore
*/
define('IN_COPPERMINE', true);

define('ALBMGR_PHP', true);

require('include/init.inc.php');

js_include('js/jquery.js');
js_include('js/jquery.cluetip.js');
js_include('js/jquery.tablednd.js');

if (!(GALLERY_ADMIN_MODE || USER_ADMIN_MODE)) {
    cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

/**
 * alb_get_subcat_data()
 *
 * @param integer $parent
 * @param string $ident
 **/
function alb_get_subcat_data($parent, $ident = '')
{
        global $CONFIG, $CAT_LIST, $USER_DATA;
		
		//select cats where the users can change the albums
		$group_id = $USER_DATA['group_id'];
		$result = cpg_db_query("SELECT cid, name, description FROM {$CONFIG['TABLE_CATEGORIES']} WHERE parent = '$parent' AND cid != 1 ORDER BY pos");
	
		if (mysql_num_rows($result) > 0) {
			$rowset = cpg_db_fetch_rowset($result);
			foreach ($rowset as $subcat) {
				if(!GALLERY_ADMIN_MODE) {
					$check_group = cpg_db_query("SELECT group_id FROM {$CONFIG['TABLE_CATMAP']} WHERE group_id = '$group_id' AND cid=".$subcat['cid']);
					$check_group_rowset = cpg_db_fetch_rowset($check_group);
					if($check_group_rowset){
						$CAT_LIST[] = array($subcat['cid'], $ident . $subcat['name']);
					}
				} else {
					$CAT_LIST[] = array($subcat['cid'], $ident . $subcat['name']);
				}
				alb_get_subcat_data($subcat['cid'], $ident . '&nbsp;&nbsp;&nbsp;');
			}
		}
}

pageheader($lang_albmgr_php['alb_mrg']);

?>
<form name="album_menu" id="cpgformAlbum" method="post" action="delete.php?what=albmgr" >

<?php 
starttable("100%", $lang_albmgr_php['alb_mrg'].'&nbsp;'.cpg_display_help('f=albums.htm&as=albmgr&ae=albmgr_end&top=1', '600', '400'), 1);
?>
	<noscript>
		<tr>
			<td colspan="2" class="tableh2">
			 <?php echo $lang_common['javascript_needed'] ?>
			</td>
		</tr>
	</noscript>
<tr>
<?php
	if ($superCage->get->keyExists('cat')) {
    	$cat = $superCage->get->getInt('cat');
	} else {
		$cat = 0;
	}
	if ($cat == 1) {
    	$cat = 0;
	}
	if (GALLERY_ADMIN_MODE) {
        $result = cpg_db_query("SELECT aid, title FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = $cat ORDER BY pos ASC");
	} elseif (USER_ADMIN_MODE) {
		//Only list the albums owned by the user
		if ($cat == 0) $cat = USER_ID + FIRST_USER_CAT;
		$user_id = USER_ID;
		$result = cpg_db_query("SELECT aid, title FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = $cat AND owner = $user_id ORDER BY pos ASC");

	} else cpg_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);
		$rowset = cpg_db_fetch_rowset($result);
		$i = 100;
		$sort_order = '';
	if (count ($rowset) > 0) foreach ($rowset as $album) {
        $sort_order .= $album['aid'] . '@' . ($i++) . ',';
	}
?>

		<input type="hidden" name="delete_album" value="" />
        <input id="sort_order" type="hidden" name="sort_order_album" value="" />
        <input type="hidden" name="sort_order" value="<?php echo $sort_order ?>" />
    
		<td class="tableb" valign="top" align="center">
    	<br />
	<table width="300" border="0" cellspacing="0" cellpadding="0">
<?php
if (GALLERY_ADMIN_MODE||USER_ADMIN_MODE) {
	$CAT_LIST = array();
	$CAT_LIST[] = array(FIRST_USER_CAT + USER_ID, $lang_albmgr_php['my_gallery']);
	//only add 'no category' when user is admin
	if (GALLERY_ADMIN_MODE){$CAT_LIST[] = array(0, $lang_albmgr_php['no_category']);}
	alb_get_subcat_data(0, '');

echo <<<EOT
         <tr>
            <td>
            <b>{$lang_albmgr_php['select_category']}</b>
            <select onChange="if(this.options[this.selectedIndex].value) window.location.href='$CPG_PHP_SELF?cat='+this.options[this.selectedIndex].value;"  name="cat" class="listbox">
EOT;
    foreach($CAT_LIST as $category) {
           echo '<option value="' . $category[0] . '"' . ($cat == $category[0] ? ' selected': '') . ">" . $category[1] . "</option>\n";
    }
      
    echo <<<EOT
               </select>
                <br /><br />
             </td>
          </tr>
EOT;
}

?>
           </table>
              <!--<select id="to" name="to[]" size="<?php //echo min(max(count ($rowset) + 3, 15), 40) ?>" multiple onChange="Album_Select(this.selectedIndex);" class="listbox" style="width: 300px">-->
              <div id="sort" style="margin-top:10px;height:250px;overflow:auto;padding-top:10px;background:#FFF;width:60%; border:1px solid #0E72A4;">
			  <table id="album_sort">
<?php
	$i = 100;
	$lb = '';
	$j=1;

	if (count ($rowset) > 0) 
	foreach ($rowset as $album) {
       //$lb .= '<option value="album_no=' . $album['aid'] . ',album_nm=' . $album['title'] . ',album_sort=' . ($i++) . ',action=0">' . stripslashes($album['title']) . "</option>\n";
        $lb .='<tr id="'.$j.'" style=\'padding:0 5px 0 5px; height:20px;cursor:move;width:100%\' title="'.$album['aid'].'@'.stripslashes($album['title']).'@0'.'"><td width="10%" style="padding-left:20px" >'.$j.'</td><td><img src="images/image.png"  /></td><td style="width:300px">'.stripslashes($album['title']).'</td><td><a style="cursor:pointer;" class="edit" title="Edit">Edit</a></td><td><a class="delete" style="cursor:pointer;color:red" title="Delet">Delete</a></td></tr>';
		$j++;
	}		
	echo $lb;
?>
</table>
	</div>
    <table>
	    <tr>
        	<td>
    	    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        		<tr>
<?php

  // Only show move-buttons when admin or in user's private categorie
  // sorting is also prevented in delete.php when user doesn't have the rights.
  if(GALLERY_ADMIN_MODE||($cat == USER_ID + FIRST_USER_CAT)){
  echo '<td><a id="up_click" ><img src="images/move_up.gif" width="26" height="21" border="0" alt="" /></a><a id="down_click"><img src="images/move_down.gif" width="26" height="21" border="0" alt="" /></a></td>';
  }else{
  echo '<td></td>';
  }
 
?> 
		<td align="center" style="background-color: #D4D0C8; width: 80px; height: 21px; border-top: 1px solid White; border-left: 1px solid White; border-right: 1px solid #808080; border-bottom: 1px solid #808080;"><a id="add_new_album" title="New" style="color: Black; font-weight: bold;cursor:pointer;"><?php echo $lang_albmgr_php['new'] ?></a></td>
		<td align="center" style="width: 10px;"><img src="images/spacer.gif" width="1" alt=""><br /></td>
        <td><input type="text" id="album_nm" name="album_nm" id="album_nm" size="27" maxlength="80" class="textinput" value="" disabled="disabled" /></td>
		<td align="center" style="width: 10px;"><img src="images/spacer.gif" width="1" alt=""><br /></td>
		<td align="center" style="background-color: #D4D0C8; width: 80px; height: 21px; border-top: 1px solid White; border-left: 1px solid White; border-right: 1px solid #808080; border-bottom: 1px solid #808080;"><a id="buttonEvent" title="addAlbumButton" style="color: Black; font-weight: bold;cursor:pointer;" >Save</a></td>
    </tr>
</table>
        </td>
      </tr>
     </table>
        </td>
</tr>
<tr>
                <td colspan="2" align="center" class="tablef">
                <input type="submit" class="button" value="<?php echo $lang_albmgr_php['apply_modifs'] ?>" />
                </td>
</tr>
<?php
endtable();
print '                </form>';
pagefooter();
ob_end_flush();

?>