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
  Adapted for CPG 1.5.* by daxad # http://forum.coppermine-gallery.net/index.php?action=profile;u=45771
  Plugin Created by Frantz 04/11/2006
*/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
GLOBAL $lang_plugin_update_history;
GLOBAL $CONFIG;
$superCage = Inspekt::makeSuperCage();
require ('plugins/update_history/include/init.inc.php');
$CONFIG['TABLE_UPDATE_HISTORY_CONFIG'] = $CONFIG['TABLE_PREFIX'].'update_history_config';
if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
if($lang_text_dir=='ltr') {
	$align="left";
	$direction="ltr";
}else {
	$align="right";
	$direction="rtl";
}
pageheader($lang_plugin_update_history['plugin_name']);
//Check if form is submitted
if ($superCage->post->keyExists('save')) {
//set the new params
$save=$superCage->post->getRaw('save');
$groupid=$superCage->post->getAlnum('groupid');
if ($superCage->post->getAlnum('bloc')=="Yes"){
	$setbloc=1;
}else{
	$setbloc=0;
}
if ($superCage->post->getAlnum('archive')=="Yes"){
	$setarchive=1;
}else{
	$setarchive=0;
}
if ($superCage->post->getAlnum('uploader')=="Yes"){
	$setuploader=1;
}else{
	$setuploader=0;
}
if ($superCage->post->getAlnum('days')=="days"){
	$setdays=1;
}else{
	$setdays=0;
}
$setnumber=$superCage->post->getAlnum('nb');
//check if group exist in the table
$sql="select * FROM `{$CONFIG['TABLE_UPDATE_HISTORY_CONFIG']}` WHERE `Group_Id`=$groupid";
$result2=cpg_db_query($sql);
$row2=mysql_num_rows($result2);
//if not in the table, create a new entry
if ($row2==FALSE){
	echo "row2: ".$row2;
	//$query="INSERT INTO `{$CONFIG['TABLE_UPDATE_HISTORY_CONFIG']}`VALUE($groupid,$setbloc,$setarchive,$setuploader,$setdays,$setnumber)";
	//cpg_db_query($query);
}else{
//else, update the table
	$query="UPDATE `{$CONFIG['TABLE_UPDATE_HISTORY_CONFIG']}` SET bloc=$setbloc, archive=$setarchive, uploader_name=$setuploader, days=$setdays, number=$setnumber WHERE Group_Id=$groupid";
	cpg_db_query($query);
}
msg_box($lang_plugin_update_history['plugin_name'], $lang_plugin_update_history_admin['succes'], $lang_continue, 'index.php?file=update_history/history_admin','100%');
pagefooter();
unset($save);
exit;
}
//end of saving
//pageheader($lang_plugin_update_history['plugin_name']);
//select User group to config
//create usergroup dropdown list
$sql="SELECT group_id,group_name FROM `{$CONFIG['TABLE_USERGROUPS']}`";
$result=cpg_db_query($sql);
if ($superCage->post->keyExists('usergroup')) {
    $usergroup = $superCage->post->getAlnum('usergroup');
} else {
        $usergroup = '';
}
starttable("100%",$lang_plugin_update_history_admin['title']);
?>
<form id='username' name='username' action='<?php echo $superCage->server->getEscaped('REQUEST_URI')?>' method='post'>
<tr>
	<td class="tableh2" align="rigth"><?php  echo $lang_plugin_update_history_admin['group_name']; ?>:
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
				<input type='submit'value="<?php echo $lang_plugin_update_history['submit'];?>">
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
$title=$lang_plugin_update_history_admin['param']."<b>".$usergroup."</b>";

$result4=cpg_db_query("select * FROM {$CONFIG['TABLE_UPDATE_HISTORY_CONFIG']} WHERE Group_Id=$groupid");
$param=mysql_fetch_array($result4);
//prepare the form
if ($param['bloc']==1){
	$confbloc="<td align='right' width='50%'>{$lang_plugin_update_history_admin['bloc']}</td><td align='left'><input type='radio' name='bloc'  value='Yes' checked='true' >{$lang_plugin_update_history_config['yes']}<input type='radio' name='bloc' value='No'>{$lang_plugin_update_history_config['no']}</td>";
}else{
	$confbloc="<td align='right' width='50%'>{$lang_plugin_update_history_admin['bloc']}</td><td align='left'><input type='radio' name='bloc' value='Yes'>{$lang_plugin_update_history_config['yes']}<input type='radio' name='bloc' value='No' checked='true'>{$lang_plugin_update_history_config['no']}</td>";
}
if ($param['archive']==1){
	$confarchive="<td align='right' width='50%' >{$lang_plugin_update_history_admin['archive']}</td><td align='left'><input type='radio' name='archive'  value='Yes' checked='true' >{$lang_plugin_update_history_config['yes']}<input type='radio' name='archive' value='No'>{$lang_plugin_update_history_config['no']}</td>";
}else{
	$confarchive="<td align='right' width='50%'>{$lang_plugin_update_history_admin['archive']}</td><td align='left'><input type='radio' name='archive'  value='Yes'  >{$lang_plugin_update_history_config['yes']}<input type='radio' name='archive' value='No' checked='true'>{$lang_plugin_update_history_config['no']}</td>";
}
if ($param['uploader_name']==1){
	$confuploader="<td align='right' width='50%'>{$lang_plugin_update_history_admin['uploader']}</td><td align='left'><input type='radio' name='uploader'  value='Yes' checked='true' >{$lang_plugin_update_history_config['yes']}<input type='radio' name='uploader' value='No'>{$lang_plugin_update_history_config['no']}</td>";
}else{
	$confuploader="<td align='right' width='50%'>{$lang_plugin_update_history_admin['uploader']}</td><td align='left'><input type='radio' name='uploader'  value='Yes'  >{$lang_plugin_update_history_config['yes']}<input type='radio' name='uploader' value='No' checked='true'>{$lang_plugin_update_history_config['no']}</td>";
}
if ($param['days']==1){
	$confdays="<td align='right' width='50%'>{$lang_plugin_update_history_admin['days_last']}</td><td align='left'><input type='radio' name='days'  value='days' checked='true' >{$lang_plugin_update_history_admin['days']}<input type='radio' name='days' value='last'>{$lang_plugin_update_history_admin['last']}</td>";
}else{
	$confdays="<td align='right' width='50%'>{$lang_plugin_update_history_admin['days_last']}</td><td align='left'><input type='radio' name='days'  value='days'>{$lang_plugin_update_history_admin['days']}<input type='radio' name='days' value='last' checked='true'>{$lang_plugin_update_history_admin['last']}</td>";
}

//Display config form
starttable("100%",$title,2);
echo '<tr align="center"><td class="tableh2" colspan="2">'.$lang_plugin_update_history_admin['text'].'</td></tr>';
?>
<form id='admin' name='admin' action='<?php echo $superCage->server->getEscaped('REQUEST_URI');?>' method='post'>
<tr><?php echo $confbloc;?></tr>
<tr><?php echo $confarchive;?></tr>	
<tr><?php echo $confuploader;?></tr>
<tr><?php echo $confdays;?></tr>
<tr><td align='right' width='50%'><?php echo $lang_plugin_update_history_admin['nb'];?></td>
    <td align='left'><input type='text' size='5' name='nb' value="<?php echo $param['number'];?>"></td>
</tr>
<tr><td colspan='2' align='center'><input type="hidden" name="groupid" value="<?php echo $groupid;?>"><input type='submit' name='save' value='<?php echo$lang_plugin_update_history_admin[save];?>'></td></tr>	
</form>
<?php
endtable();
}
endtable();
ob_end_flush();
mysql_free_result($result2);
mysql_free_result($result3);
mysql_free_result($result);
mysql_free_result($result4);
pagefooter();
?>
