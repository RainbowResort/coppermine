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
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/image_manipulation/admin.php $
  $Revision: 7043 $
  $LastChangedBy: gaugau $
  $Date: 2010-01-11 19:26:53 +0100 (Mo, 11. Jan 2010) $
  **************************************************/

require('include/init.inc.php');

if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
if($lang_text_dir=='ltr') {
	$align="left";
	$direction="ltr";
}else {
	$align="right";
	$direction="rtl";
}

// Check for change status Final extract 2.3
if (isset($_POST['change_stat'])) {
//set new values for bloc status
$groupid=$_POST['groupid'];
//test if this usergroup exist in the FINAL_EXTRACT_CONFIG table:
$sql="select group_id FROM `{$CONFIG['TABLE_FINAL_EXTRACT_CONFIG']}` WHERE `group_id`=$groupid";
$result=cpg_db_query($sql);
$row=mysql_num_rows($result);
$home=0;$login=0;$my_gallery=0;$upload_pic=0;$album_list=0;$lastup=0;$lastcom=0;$topn=0;$toprated=0;$favpics=0;$search=0;$my_profile=0;
	if($_POST['home']<>"")$home=1;
	if($_POST['login']<>"")$login=1;	
	if($_POST['my_gallery']<>"")$my_gallery=1;
	if($_POST['upload_pic']<>"")$upload_pic=1;
	if($_POST['album_list']<>"")$album_list=1;
	if($_POST['lastup']<>"")$lastup=1;
	if($_POST['lastcom']<>"")$lastcom=1;
	if($_POST['topn']<>"")$topn=1;
	if($_POST['toprated']<>"")$toprated=1;
	if($_POST['favpics']<>"")$favpics=1;
	if($_POST['search']<>"")$search=1;
	if($_POST['my_profile']<>"")$my_profile=1;
if ($row==FALSE){
	$sql="INSERT INTO `{$CONFIG['TABLE_FINAL_EXTRACT_CONFIG']}`VALUE($groupid,$home,$login,$my_gallery,$upload_pic,$album_list,$lastup,$lastcom,$topn,$toprated,$favpics,$search,$my_profile)";
	cpg_db_query($sql);
	}
else{	
	$sql="UPDATE `{$CONFIG['TABLE_FINAL_EXTRACT_CONFIG']}` SET `home`=$home,`login`=$login,`my_gallery`=$my_gallery,`upload_pic`=$upload_pic,`album_list`=$album_list,`lastup`=$lastup,`lastcom`=$lastcom,`topn`=$topn,`toprated`=$toprated,`favpics`=$favpics,`search`=$search,`my_profile`=$my_profile  WHERE Group_Id=$groupid";
	cpg_db_query($sql);
	unset($_POST['change_stat']);
	$cnt=count($_POST)-1;
	if($cnt <=0) {
		pageheader($lang_plugin_final_extract['display_name']);
        msg_box($lang_plugin_final_extract['display_name'], $lang_plugin_final_extract_delete['nothing_changed'], $lang_continue, 'index.php?file=final_extract/plugin_config');
		pagefooter();
		exit;
	} }/*else {
		
		$sql="UPDATE `{$CONFIG['TABLE_FINAL_EXTRACT_CONFIG']}` SET value=1 WHERE";
		$i=0;
		foreach ($_POST as $key=>$value) {
			if($value=="1") {
				 $i+=1;
				 if($i==$cnt) { $sql=$sql." name='$key'";} 
				 else if ($i<$cnt){ $sql=$sql." name='$key' or ";}
			}
		}
		cpg_db_query($sql);*/
		pageheader($lang_plugin_final_extract['display_name']);
        msg_box($lang_plugin_final_extract['display_name'], $lang_plugin_final_extract_delete['success'], $lang_continue, 'index.php?file=final_extract/plugin_config');
		pagefooter();
		exit;
	}

pageheader($lang_plugin_final_extract['display_name']);
?>
<script language="javascript" type="text/javascript">
function change() {
   var Nodes = document.getElementsByTagName("table")
        var max = Nodes.length
        for(var i = 0;i < max;i++) {
                var nodeObj = Nodes.item(i)
                var str = nodeObj.id
                if (str.match("section")) {
                        nodeObj.style.display = 'none';
                }
        }
advkind=document.getElementById("plugin_status").value;
}
function change_conf() {
advkind=document.getElementById("plugin_status").value;
if(advkind==3) {
	document.getElementById("max_show").style.display='block';
	} else {
		document.getElementById("max_show").style.display='none';
	}
}
function check_all(formname) {
 i=0;
 while(document.getElementById(formname).elements[i]) {
	document.getElementById(formname).elements[i].checked="cheked";
	i+=1;
 }
}
//onload = change;
</script>
<?php
//create usergroup dropdown list
$sql="SELECT group_id,group_name FROM `{$CONFIG['TABLE_USERGROUPS']}`";
$result=cpg_db_query($sql);
$usergroup=isset($_POST['usergroup']) ? $_POST['usergroup'] : '';

starttable('100%', 'Final Extract - '.$lang_plugin_final_extract['version'].'<font size=1 color=red> By <a href=\"http://www.myprj.com\">BMossavari at gmail dot com</a></font>- <a href="pluginmgr.php" class="admin_menu">Plugin Manager</a>', 3);
?>
<form id='username' name='username' action='<?php echo $_SERVER['REQUEST_URI']?>' method='post'>
<tr>
	<td class="tableh2" align="rigth"><?php  echo $lang_plugin_final_extract['group_name']; ?>:
	<select name='usergroup' >
			<?php while ($row=mysql_fetch_array($result)){
				extract($row);
					if($usergroup==$row['group_name']){
						echo"<option value='$group_name'selected>$group_name \n";
					}
					else{
						echo"<option value='$group_name'>$group_name \n";
					}
					  
					
				 } ?></select>		
				<input name="groupid" type="hidden" value="<?php echo $row['group_id']; ?>">		
				<input type='submit'value="<?php echo $lang_plugin_final_extract_config['button_submit'];?>">
</tr>
</form>
<?php
//if usergroup selected
if($usergroup<>""){
//extract groupid from the selected usergroup
$sql3="SELECT group_id,group_name FROM `{$CONFIG['TABLE_USERGROUPS']}`WHERE group_name = '$usergroup'";
$result3=cpg_db_query($sql3);
$row3=mysql_fetch_array($result3);
$groupid=$row3['group_id'];


//create block list to configure
$sql2="SELECT * FROM `{$CONFIG['TABLE_FINAL_EXTRACT_CONFIG']}` WHERE group_id LIKE'$groupid'";
$result2=cpg_db_query($sql2);
$row2=mysql_fetch_array($result2);


?>
<tr><td><form id="" name="" action="<?php echo $_SERVER['REQUEST_URI']?>" method="POST">
	<table class="maintable" id="section0" cellSpacing="1" cellPadding="0" width="50%" align="center" border="0">
		<tr>			
              		<td width="70%" align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><strong><?php echo $lang_plugin_final_extract_manage['list_name']; ?></strong></td>
              		<td width="10%" align="center" vAlign=top class=tableb><strong><?php echo $lang_plugin_final_extract_manage['list_check']; ?></strong></td>
            	</tr>
            	<tr>
            		<td class=tableb align="<?php echo $align ?>" dir="<?php echo $direction ?>"><?php echo $lang_plugin_final_extract['home_block'];?></td>
            		<td align="center" valign=top class=tableb><input name="home" type="checkbox"   <?php if($row2['home']==1) { echo 'checked="cheked"';} ?>/></td>
            	</tr>
            	<tr>
            		<td class=tableb align="<?php echo $align ?>" dir="<?php echo $direction ?>"><?php echo $lang_plugin_final_extract['login_block'];?></td>
            		<td align="center" valign=top class=tableb><input name="login" type="checkbox"  <?php if($row2['login']==1) { echo 'checked="cheked"';} ?>/></td>
            	</tr>
            	<tr>
            		<td class=tableb align="<?php echo $align ?>" dir="<?php echo $direction ?>"><?php echo $lang_plugin_final_extract['my_galery_block'];?></td>
            		<td align="center" valign=top class=tableb><input name="my_gallery" type="checkbox"  <?php if($row2['my_gallery']==1) { echo 'checked="cheked"';} ?>/></td>
            	</tr>
            	<tr>
            		<td class=tableb align="<?php echo $align ?>" dir="<?php echo $direction ?>"><?php echo $lang_plugin_final_extract['upload_pic_block'];?></td>
            		<td align="center" valign=top class=tableb><input name="upload_pic" type="checkbox"  <?php if($row2['upload_pic']==1) { echo 'checked="cheked"';} ?>/></td>
            	</tr>
            		<tr>
            		<td class=tableb align="<?php echo $align ?>" dir="<?php echo $direction ?>"><?php echo $lang_plugin_final_extract['album_list_block'];?></td>
            		<td align="center" valign=top class=tableb><input name="album_list" type="checkbox"   <?php if($row2['album_list']==1) { echo 'checked="cheked"';} ?>/></td>
            	</tr>
            	<tr>
            		<td class=tableb align="<?php echo $align ?>" dir="<?php echo $direction ?>"><?php echo $lang_plugin_final_extract['lastup_block'];?></td>
            		<td align="center" valign=top class=tableb><input name="lastup" type="checkbox"   <?php if($row2['lastup']==1) { echo 'checked="cheked"';} ?>/></td>
            	</tr>
            	<tr>
            		<td class=tableb align="<?php echo $align ?>" dir="<?php echo $direction ?>"><?php echo $lang_plugin_final_extract['lastcom_block'];?></td>
            		<td align="center" valign=top class=tableb><input name="lastcom" type="checkbox"  <?php if($row2['lasctom']==1) { echo 'checked="cheked"';} ?>/></td>
            	</tr>
            	<tr>
            		<td class=tableb align="<?php echo $align ?>" dir="<?php echo $direction ?>"><?php echo $lang_plugin_final_extract['topn_block'];?></td>
            		<td align="center" valign=top class=tableb><input name="topn" type="checkbox"   <?php if($row2['topn']==1) { echo 'checked="cheked"';} ?>/></td>
            	</tr>
            	<tr>
            		<td class=tableb align="<?php echo $align ?>" dir="<?php echo $direction ?>"><?php echo $lang_plugin_final_extract['toprated_block'];?></td>
            		<td align="center" valign=top class=tableb><input name="toprated" type="checkbox"   <?php if($row2['toprated']==1) { echo 'checked="cheked"';} ?>/></td>
            	</tr>
            	<tr>
            		<td class=tableb align="<?php echo $align ?>" dir="<?php echo $direction ?>"><?php echo $lang_plugin_final_extract['favpics_block'];?></td>
            		<td align="center" valign=top class=tableb><input name="favpics" type="checkbox"   <?php if($row2['favpics']==1) { echo 'checked="cheked"';} ?>/></td>
            	</tr>
            	<tr>
            		<td class=tableb align="<?php echo $align ?>" dir="<?php echo $direction ?>"><?php echo $lang_plugin_final_extract['search_block'];?></td>
            		<td align="center" valign=top class=tableb><input name="search" type="checkbox"  <?php if($row2['search']==1) { echo 'checked="cheked"';} ?>/></td>
            	</tr>
		<tr>
            		<td class=tableb align="<?php echo $align ?>" dir="<?php echo $direction ?>"><?php echo $lang_plugin_final_extract['my_profile_block'];?></td>
            		<td align="center" valign=top class=tableb><input name="my_profile" type="checkbox"  <?php if($row2['my_profile']==1) { echo 'checked="cheked"';} ?>/></td>
            	</tr>
            	<tr>
                	<td class=tableb align="<?php echo $align ?>" dir="<?php echo $direction ?>">&nbsp;</td>
                	<td align="center" valign=top class=tableb>&nbsp;&nbsp;
                  	<input class="button" type="button" value="<?php echo $lang_plugin_final_extract_manage['list_chkall']; ?>" name="restore_config" onclick="return check_all('blocks');"></td>
              	</tr>
	</table>
</td></tr><tr>
	
        <td align="center" class="tableb"><input type="hidden" name="groupid" value="<?php echo $groupid;?>"><input class="button" type="submit" value="<?php echo $lang_plugin_final_extract_manage['list_chstat']; ?>" name="change_stat" />
        </td>
      </tr></form>
<?php
}
endtable();
pagefooter();
ob_end_flush();
mysql_free_result($result);
mysql_free_result($result2);
mysql_free_result($result3);
?>