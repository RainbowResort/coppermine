<?php
/**************************************************
  Coppermine 1.5.x Plugin - keywords_add
  *************************************************
  Copyright (c) coppermine dev team
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

$superCage = Inspekt::makeSuperCage();

if($lang_text_dir=='ltr') {
    $align="left";
    $direction="ltr";
} else {
    $align="right";
    $direction="rtl";
}

//Update database if for was submit
if ($superCage->post->keyExists('change_stat')) {
// Set variable values
    $albumid = $superCage->post->keyExists('albumid') ? $superCage->post->getInt('albumid') : 0;
    $albstr = ($albumid) ? " WHERE aid = $albumid" : '';
    $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} $albstr");
    while ($row = mysql_fetch_array($result)) {

        $pid=$row['pid'];
        if ($superCage->post->getRaw('keyword') <> "") {
            $keyword = $row['keywords']." ".$superCage->post->getRaw('keyword');
            $kword = "keywords='$keyword'";
        }
        if ($superCage->post->getRaw('title') <> "") {
            $pictitle = $superCage->post->getRaw('title');
            if (isset($kword)) {
                $title = ", title='$pictitle'";
            } else {
                $title = "title='$pictitle'";
            }
        }
        if ($superCage->post->getRaw('description') <> "") {
            $picdesc = $superCage->post->getRaw('description');
            if (isset($kword) || isset($pictitle)) {
                $description = ", caption='$picdesc'";
            } else {
                $description = "caption='$picdesc'";
            }
        }
        if($superCage->post->getRaw('user1') <> "") {
            $field1 = $superCage->post->getRaw('user1');
            if (isset($kword) || isset($pictitle) || isset($picdesc)) {
                $user1=", user1='$field1'";
            } else {
                $user1="user1='$field1'";
            }
        }
        if($superCage->post->getRaw('user2') <> "") {
            $field2 = $superCage->post->getRaw('user2');
            if (isset($kword) || isset($pictitle) || isset($picdesc) || isset($user1)) {
                $user2 = ", user2='$field2'";
            } else {
                $user2 = "user2='$field2'";
            }
        }
        if($superCage->post->getRaw('user3') <> "") {
            $field3 = $superCage->post->getRaw('user3');
            if (isset($kword) || isset($pictitle) || isset($picdesc) || isset($user1) || isset($user2)) {
                $user3=", user3='$field3'";
            } else {
                $user3="user3='$field3'";
            }
        }
        if($superCage->post->getRaw('user4') <> "") {
            $field4 = $superCage->post->getRaw('user4');
            if (isset($kword) || isset($pictitle) || isset($picdesc) || isset($user1) || isset($user2) || isset($user3)) {
                $user4 = ", user4='$field4'";
            } else {
                $user4 = "user4='$field4'";
            }
        }
        $updtstr = "SET ".$kword.$title.$description.$user1.$user2.$user3.$user4." WHERE pid=$pid";
        cpg_db_query("UPDATE `{$CONFIG['TABLE_PICTURES']}`$updtstr");
        //unset($updtstr);unset($keyword);unset($title);unset($descritpion);unset($pictitle);unset($picdesc);
        //unset($kword);unset($user1);unset($user2);unset($user3);unset($user4);unset($field1);unset($field2);unset($field3);unset($field4);
    }
    pageheader($lang_plugin_keywords_add['display_name']);
    msg_box($lang_plugin_keywords_add['display_name'], $lang_plugin_keywords_add_delete['success'], $lang_continue, 'index.php?file=keywords_add/plugin_config');
    pagefooter();
    exit;
}

//Display form to enter fields values
pageheader($lang_plugin_keywords_add['display_name']);
//create album dropdown list
$sql1="SELECT * FROM `{$CONFIG['TABLE_CONFIG']}`";
$result1=cpg_db_query($sql1);

starttable('100%', 'Plugin Keywords add - '.$lang_plugin_keywords_add['version'].'    '.'<a href="pluginmgr.php" class="admin_menu">Plugin Manager</a>');
?>
<form id='albumname' name='albumname' action='<?php echo $superCage->server->getRaw('REQUEST_URI');?>' method='post'>
<tr>
    <td class="tableh2" align="center"><?php  echo $lang_plugin_keywords_add['album_name']; ?>:
<?php
$result = cpg_db_query("SELECT aid, category, IF(user_name IS NOT NULL, CONCAT('(', user_name, ') ',a.title), CONCAT(' - ', a.title)) AS title " . "FROM {$CONFIG['TABLE_ALBUMS']} AS a " . "LEFT JOIN {$CONFIG['TABLE_USERS']} AS u ON category = (" . FIRST_USER_CAT . " + user_id) " . "ORDER BY category, title");
    echo '&nbsp;&nbsp;&nbsp;&nbsp;<select size="1" name="albumid" class="listbox">';
        while ($row = mysql_fetch_array($result)) {
                $result2 = cpg_db_query("SELECT name FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid = {$row['category']}");
                $row2 = mysql_fetch_assoc($result2);
                echo "<option value=\"{$row['aid']}\">{$row2['name']} {$row['title']}</option>";
        }
        echo '</select> &nbsp;&nbsp;&nbsp;&nbsp; ';
?>
</tr>
<?php
starttable('60%',$lang_plugin_keywords_add['add_info'],2);
?>
<tr class="tableh2">
    <td  align="right"><?php  echo $lang_plugin_keywords_add['keyword']; ?>:</td><td align="left" width="50"><input name="keyword" type="text" size="50"></td>
</tr>
<tr class="tableh2">
    <td align="right"><?php echo $lang_plugin_keywords_add['title']; ?>:</td>
    <td align="left"><input name="title" type="text" size="50"></td>
</tr>
<tr class="tableh2">
    <td align="right"><?php echo $lang_plugin_keywords_add['description']; ?>:</td>
    <td align="left"><input name="description" type="text" size="50"></td>
</tr>
<?php while ($row1=mysql_fetch_array($result1)) {
                extract($row1);
    if ($row1['name']=="user_field1_name") {
        if ($row1['value']<>"") { ?>
<tr class="tableh2" >
    <td  align="right"><?php  echo $row1['value']; ?>:</td><td align="left"><input name="user1" type="text"></td>
</tr>
<?php }}
    if ($row1['name']=="user_field2_name") {
        if ($row1['value']<>"") { ?>
<tr class="tableh2">
    <td  align="right"><?php  echo $row1['value']; ?>:</td><td align="left"><input name="user2" type="text"></td>
</tr>
<?php }}
    if ($row1['name']=="user_field3_name") {
        if ($row1['value']<>"") { ?>
<tr class="tableh2" >
    <td  align="right"><?php  echo $row1['value']; ?>:</td><td align="left"><input name="user3" type="text"></td>
</tr>
<?php }}
    if ($row1['name']=="user_field4_name") {
        if ($row1['value']<>"") { ?>
<tr class="tableh2" >
    <td  align="right"><?php  echo $row1['value']; ?>:</td><td align="left"><input name="user4" type="text"></td>
</tr>
<?php }}} ?>

<tr>
    <td colspan="2" align="center" class="tableh2" style="color:red"><b><?php echo $lang_plugin_keywords_add['caution']; ?></b></td>
</tr>
<tr class="tableh2">
    <td colspan="2" class="tableh2" align="center"><input name="aid" type="hidden" value="<?php echo $row['aid']; ?>">
                        
                <input name="change_stat" type='submit'value="<?php echo $lang_plugin_keywords_add_config['button_submit'];?>">
    </td>
</tr>
<?php
endtable();
?>
</tr>
</form>
<?php
endtable();
pagefooter();
ob_end_flush();
mysql_free_result($result);
mysql_free_result($result1);
?>