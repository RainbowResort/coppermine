<?php
/**************************************************
  Coppermine 1.4.x Plugin - Copper ad
  *************************************************
  Copyright (c) 2006 Borzoo Mossavari
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  This is a simple Advertisement plugin without statistics
  or any kind of log.
  this will give you flash/picture/HTML banner
  By using FRAME technology
  ***************************************************/
  
require('include/init.inc.php');
if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
if($lang_text_dir=='ltr') {
	$align="left";
	$direction="ltr";
}else {
	$align="right";
	$direction="rtl";
}

// check posted value for configuration
if (isset($_POST['update_config'])) {
	$po_status=addslashes($_POST['plugin_status']);
	$sql="UPDATE `{$CONFIG['TABLE_COPPERAD_CONFIG']}` SET value='$po_status' WHERE name='status'";
	cpg_db_query($sql);
	$po_max_show=addslashes($_POST['max_show']);
	$sql="UPDATE `{$CONFIG['TABLE_COPPERAD_CONFIG']}` SET value='$po_max_show' WHERE name='max_show_number'";
	cpg_db_query($sql);
	$po_text_title=addslashes($_POST['text_title']);
	$sql="UPDATE `{$CONFIG['TABLE_COPPERAD_CONFIG']}` SET value='$po_text_title' WHERE name='text_title'";
	cpg_db_query($sql);
	$po_admin_show=addslashes($_POST['admin_show']);
	$sql="UPDATE `{$CONFIG['TABLE_COPPERAD_CONFIG']}` SET value='$po_admin_show' WHERE name='admin_show'";
	cpg_db_query($sql);
	$po_banner_bg=addslashes($_POST['banner_bg']);
	$sql="UPDATE `{$CONFIG['TABLE_COPPERAD_CONFIG']}` SET value='$po_banner_bg' WHERE name='banner_bg'";
	cpg_db_query($sql);
    pageheader($lang_plugin_copperad['display_name']);
    msg_box($lang_plugin_copperad['display_name'], $lang_plugin_copperad['page_success'], $lang_continue, 'index.php');
	pagefooter();
        exit;

}
//check posted value for banner creation
if (isset($_POST['create_banner'])) {
	$adver_name=addslashes($_POST['adver_name']);
	$adver_kind=addslashes($_POST['adver_kind']);
	$adver_stat=addslashes($_POST['adver_stat']);
	$adver_html=addslashes($_POST['adver_html']);
	$adver_address=addslashes($_POST['adver_address']);
	$adver_height=addslashes($_POST['adver_height']);
	$adver_width=addslashes($_POST['adver_width']);
	$adver_linkto=addslashes($_POST['adver_linkto']);	
	$adver_alt=addslashes($_POST['adver_alt']);
	$sql="INSERT INTO `{$CONFIG['TABLE_PLUGIN_COPPERAD']}` (name,kind,stat,html,address,height,width,linkto,alt) VALUES ('$adver_name','$adver_kind','$adver_stat','$adver_html','$adver_address','$adver_height','$adver_width','$adver_linkto','$adver_alt')";
	cpg_db_query($sql);
    pageheader($lang_plugin_copperad['display_name']);
    msg_box($lang_plugin_copperad['display_name'], $lang_plugin_copperad['create_success'], $lang_continue, 'index.php');
	pagefooter();
        exit;
}

// Check for change status CPA 1.2.2
if (isset($_POST['change_stat'])) {
	$cnt=count($_POST)-1;
	if($cnt <=0) {
		cpg_die(ERROR, $lang_plugin_copperad_delete['cant_delete'], __FILE__, __LINE__);
	} else {
		unset($_POST['change_stat']);
		$sql="SELECT adv_id from `{$CONFIG['TABLE_PLUGIN_COPPERAD']}`";
		$result=cpg_db_query($sql);
		$sql="UPDATE `{$CONFIG['TABLE_PLUGIN_COPPERAD']}` SET stat=0";
		cpg_db_query($sql);
		$sql="UPDATE `{$CONFIG['TABLE_PLUGIN_COPPERAD']}` SET stat=1 WHERE";
		$i=0;
		while($row=mysql_fetch_assoc($result)) {
			foreach ($_POST as $key=>$value) {
				if($key==$row['adv_id']) {
					 $i+=1;
					 if($i==$cnt) { $sql=$sql." adv_id='$key'";} 
					 else if ($i<$cnt){ $sql=$sql." adv_id='$key' or ";}
				}
			}
		}
		cpg_db_query($sql);
	}
}
pageheader($lang_plugin_copperad['display_name']);
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
if(advkind==3) {
	document.getElementById("max_show").style.display='block';
	} else {
		document.getElementById("max_show").style.display='none';
	}
advkind2=document.getElementById("adver_kind").value;
if(advkind2==3) {
	document.getElementById("html_tbl").style.display='block';
	document.getElementById("picture_tbl").style.display='none';
	document.getElementById("picflash_tbl").style.display='none';
	} else if(advkind2==1){
		document.getElementById("picture_tbl").style.display='block';
		document.getElementById("html_tbl").style.display='none';
		document.getElementById("picflash_tbl").style.display='block';
	} else if(advkind2==2){
		document.getElementById("html_tbl").style.display='none';
		document.getElementById("picture_tbl").style.display='none';
		document.getElementById("picflash_tbl").style.display='block';
	}

}
function change_new() {
advkind2=document.getElementById("adver_kind").value;
if(advkind2==3) {
	document.getElementById("html_tbl").style.display='block';
	document.getElementById("picture_tbl").style.display='none';
	document.getElementById("picflash_tbl").style.display='none';
	} else if(advkind2==1){
		document.getElementById("picture_tbl").style.display='block';
		document.getElementById("html_tbl").style.display='none';
		document.getElementById("picflash_tbl").style.display='block';
	} else if(advkind2==2){
		document.getElementById("html_tbl").style.display='none';
		document.getElementById("picture_tbl").style.display='none';
		document.getElementById("picflash_tbl").style.display='block';
	}

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
	document.getElementById(formname).elements[i].checked="CHECKED";
	i+=1;
 }
}
onload = change;
</script>
<?php
starttable('100%', 'Advertisement manager - '.$lang_plugin_copperad['version'].'<font size=1 color=red> By <a href=\"http://www.myprj.com\">BMossavari at gmail dot com</a></font>- <a href="pluginmgr.php" class="admin_menu">Plugin Manager</a>', 3);
echo <<<EOT
    <tr>
        <td class="tableh2" colspan="3">
            <a href="javascript:expand();" class="admin_menu">{$lang_plugin_copperad_config['expand_all']}&nbsp;&nbsp;<img src="images/descending.gif" width="9" height="9" border="0" alt="" title="{$lang_plugin_copperad_config['expand_all']}" /></a>
        </td>
    </tr>
EOT;

//Create a list of banner
$sql="SELECT name,adv_id,stat FROM `{$CONFIG['TABLE_PLUGIN_COPPERAD']}`";
$result=cpg_db_query($sql);
?>

<TR>
  <TD class=tableh2 colSpan=3 onClick="show_section('section1')"><SPAN style="CURSOR: pointer"><IMG title="click section name to expand" height=9 alt="" src="images/descending.gif" width=9 border=0><strong> <?php echo $lang_plugin_copperad_manage['list_create']; ?></strong></SPAN> </TD>
</TR>
<TR>
  <TD><TABLE class=maintable cellSpacing=1 cellPadding=0 width="100%" align=center border=0 id="section1" >
      <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <TR>
          <TD width="25%" align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><strong><?php echo $lang_plugin_copperad_manage['list_name']; ?></strong> :
            <input value="" name="adver_name" dir="<?php echo $direction ?>" align="<?php echo $align ?>" id="adver_name" maxlength="255" class="textinput" size="30"/>
          </TD>
        </TR>
        <TR>
          <TD align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><strong><?php echo $lang_plugin_copperad_manage['list_status']; ?></strong> :
            <select name="adver_stat" id="adver_stat">
              <option value="1">Enable</option>
              <option value="0">Disable</option>
            </select></TD>
        </TR>
        <TR>
          <TD align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><strong><?php echo $lang_plugin_copperad_manage['list_kind']; ?></strong> :
            <select name="adver_kind" id="adver_kind" onChange="return change_new();">
              <option value="1" >Picture</option>
              <option value="2" >Flash</option>
              <option value="3" >HTML</option>
            </select>
          </TD>
        </TR>
        <TR>
          <TD align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><table width="100%" border="0" cellpadding="0" cellspacing="0" id="html_tbl">
              <tr>
                <td width="30"><strong><?php echo $lang_plugin_copperad_manage['list_html']; ?></strong> : </td>
                <td width="419"><textarea name="adver_html" cols="64" rows="5" id="adver_html" wrap="virtual" dir="<?php echo $direction ?>" align="<?php echo $align ?>"><h2>This is default HTML banner</h2>
<h1>CopperAD</h1>
                      </textarea></td>
                <td width="535"><strong><?php echo $lang_plugin_copperad_manage['list_html_des']; ?></strong></td>
              </tr>
            </table><table width="100%" border="0" cellpadding="0" cellspacing="0" id="widthheight"><TR><TD><strong><?php echo $lang_plugin_copperad_manage['list_height']; ?></strong> :
                  <input value="100" name="adver_height" dir="<?php echo $direction ?>" align="<?php echo $align ?>" id="adver_height" maxlength="255" class="textinput" size="35"/></TD></TR>
              <TR>
                <TD><strong><?php echo $lang_plugin_copperad_manage['list_width']; ?></strong> :
                  <input value="780" name="adver_width" dir="<?php echo $direction ?>" align="<?php echo $align ?>" id="adver_width" maxlength="255" class="textinput" size="35"/></TD>
              </TR>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" id="picflash_tbl">
              <tr>
                <td><strong><?php echo $lang_plugin_copperad_manage['list_address']; ?></strong> :
                  <input value="Only if its picture or flash" name="adver_address" dir="<?php echo $direction ?>" align="<?php echo $align ?>" id="adver_address" maxlength="255" class="textinput" size="35"/>                </td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" id="picture_tbl">
              <tr>
                <td><strong><?php echo $lang_plugin_copperad_manage['list_linkto']; ?></strong> :
                  <input name="adver_linkto" class="textinput" id="adver_linkto" dir="<?php echo $direction ?>" value="index.php" size="32" maxlength="255" align="<?php echo $align ?>" />
                </td>
              </tr>
              <tr>
                <td><strong><?php echo $lang_plugin_copperad_manage['list_alt']; ?></strong> :
                  <input value="Advertisement" name="adver_alt" dir="<?php echo $direction ?>" align="<?php echo $align ?>" id="adver_alt" maxlength="255" class="textinput" size="32" />
                </td>
              </tr>
            </table></TD>
        </TR>
        <tr>
          <td class="tableb"><br />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center"><input name="adver_id" type="hidden" value="<?php echo $row['adv_id']?>" id="adver_id"/>
                  <INPUT class=button type=submit value="<?php echo $lang_plugin_copperad_manage['list_create']; ?>" name="create_banner">
                  &nbsp;&nbsp;
                  <INPUT class=button onClick="return confirm('<?php echo $lang_plugin_copperad_manage['list_restore']; ?>');" type=submit value="<?php echo $lang_plugin_copperad_manage['list_restore']; ?>" name="restore_config">
                </td>
              </tr>
            </table></td>
        </tr>
      </form>
    </TABLE></TD>
</TR>
<TR>
  <TD class=tableh2 onClick="show_section('section0')" colSpan=3><SPAN 
            style="CURSOR: pointer"><IMG title="click section name to expand" 
            height=9 alt="" 
            src="images/descending.gif" 
            width=9 border=0> <strong><?php echo $lang_plugin_copperad_manage['list_banner']; ?> </strong></SPAN></TD>
</TR>
<TR>
  <TD><TABLE class="maintable" id="section0" cellSpacing="1" cellPadding="0" width="100%" align="center" border="0">
      <form id="banner_stat" name="banner_stat" method="post" action="<?php echo $_SERVER['REQUEST_URI']?>"><TR>
        <TD><TABLE class=maintable cellSpacing=1 cellPadding=0 width="100%" align=center border=0>
            <TR>
              <TD width="70%" align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><strong><?php echo $lang_plugin_copperad_manage['list_name']; ?></strong></TD>
              <TD width="10%" align="center" vAlign=top class=tableb><strong><?php echo $lang_plugin_copperad_manage['list_edit']; ?></strong></TD>
              <TD width="10%" align="center" vAlign=top class=tableb><strong><?php echo $lang_plugin_copperad_manage['list_delete']; ?></strong></TD>
              <TD width="10%" align="center" vAlign=top class=tableb><strong><?php echo $lang_plugin_copperad_manage['list_stat']; ?></strong></TD>
            </TR>
            
              <?php while($row=mysql_fetch_assoc($result)){?>
              <TR>
                <TD class=tableb align="<?php echo $align ?>" dir="<?php echo $direction ?>"><?php echo (stripslashes($row['name']));?></TD>
                <TD align="center" vAlign=top class=tableb><a href="<?php echo ("bannermgr.php?act=edit&id=".stripslashes($row['adv_id']));?>"><img src="images/edit.gif" width="16" height="16" border="0" /></a></TD>
                <TD align="center" vAlign=top class=tableb><a href="<?php echo ("bannermgr.php?act=delete&id=".stripslashes($row['adv_id']));?>"><img src="images/delete.gif" width="16" height="16" border="0" /></a></TD>
                <TD align="center" vAlign=top class=tableb><input name="<?php echo stripslashes($row['adv_id']);?>" type="checkbox" id="<?php echo stripslashes($row['adv_id']);?>" value="1" <?php if($row['stat']==1) { echo 'checked="CHECKED"';} ?>/>                </TD>
              </TR>
              <?php } ?>
              <TR>
                <TD class=tableb align="<?php echo $align ?>" dir="<?php echo $direction ?>">&nbsp;</TD>
                <TD align="center" vAlign=top class=tableb>&nbsp;</TD>
                <TD align="center" vAlign=top class=tableb>&nbsp;</TD>
                <TD align="center" vAlign=top class=tableb>&nbsp;&nbsp;
                  <INPUT class="button" type="button" value="<?php echo $lang_plugin_copperad_manage['list_chkall']; ?>" name="restore_config" onclick="return check_all('banner_stat');"></TD>
              </TR>
            
          </TABLE></TD>
      </TR>
      <TR>
        <TD align="center" class="tableb"><input class="button" type="submit" value="<?php echo $lang_plugin_copperad_manage['list_chstat']; ?>" name="change_stat" />
        </TD>
      </TR></form>
  </TABLE></TD>
</TR>
<TR>
  <TD class=tableh2 colSpan=3><strong><?php echo $lang_plugin_copperad_manage['list_conf']; ?></strong></TD>
</TR>
<TR>
  <TD><TABLE class=maintable cellSpacing=1 cellPadding=0 width="100%" align=center border=0>
      <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
        <TR>
          <td class=tableb><strong><?php echo $lang_plugin_copperad_config['status']?></strong> :
            <select name="plugin_status" id="plugin_status" onChange="return change_conf();">
              <option value="0" <?php if($COPPERAD['status']==0) echo "selected=\"selected\""; ?>>Disable</option>
              <option value="1" <?php if($COPPERAD['status']==1) echo "selected=\"selected\""; ?>>Enable(after sys menu)</option>
              <option value="2" <?php if($COPPERAD['status']==2) echo "selected=\"selected\""; ?>>Enable(after sub menu)</option>
              <option value="3" <?php if($COPPERAD['status']==3) echo "selected=\"selected\""; ?>>Enable(multi location)</option>
            </select></td>
        </TR>
        <TR>
          <td class=tableb><table width="100%" border="0" cellpadding="0" cellspacing="0" id="max_show" style="display:none">
              <tr>
                <td><strong><?php echo $lang_plugin_copperad_config['max_show']; ?></strong> :
                  <input value="<?php echo (stripslashes($COPPERAD['max_show_number']));?>" name="max_show" dir="<?php echo $direction ?>" align="<?php echo $align ?>" id="max_show" maxlength="2" class="textinput" size="5"/></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><strong><?php echo $lang_plugin_copperad_config['text_title']?></strong> :
                  <input value="<?php echo (stripslashes($COPPERAD['text_title']));?>" name="text_title" dir="<?php echo $direction ?>" align="<?php echo $align ?>" id="text_title" maxlength="255" class="textinput" size="35"/>
                  <?php echo $lang_plugin_copperad_config['text_title_des']?></td>
              </tr>
            </table></td>
        </TR>
        <TR>
          <td class=tableb><strong><?php echo $lang_plugin_copperad_config['admin_show']?></strong> : Yes
            <input name="admin_show" type="radio" value="1"  <?php if($COPPERAD['admin_show']==1) { echo 'checked="checked"';} ?>/>
            No
            <input name="admin_show" type="radio" value="0" <?php if($COPPERAD['admin_show']==0) { echo 'checked="checked"';} ?> />
          </td>
        </TR>
        <TR>
          <td class=tableb><strong><?php echo $lang_plugin_copperad_config['banner_bg']?></strong> :
            <input value="<?php echo (stripslashes($COPPERAD['banner_bg']));?>" name="banner_bg" dir="<?php echo $direction ?>" align="<?php echo $align ?>" id="banner_bg" maxlength="7" class="textinput" size="7"/></td>
        </TR>
        <TR>
          <td align="center" class=tableb><INPUT class=button type=submit value="<?php echo $lang_plugin_copperad_manage['list_submit']; ?>" name="update_config" id="update_config">
            &nbsp;&nbsp;
            <INPUT class=button onClick="return confirm('<?php echo $lang_plugin_copperad_manage['list_restore']; ?>');" type=submit value="<?php echo $lang_plugin_copperad_manage['list_restore']; ?>" name="restore_config" id="restore_config"></td>
        </TR>
      </form>
    </TABLE></TD>
</TR>
<?php endtable();
pagefooter();
ob_end_flush();
mysql_free_result($result);
?>
