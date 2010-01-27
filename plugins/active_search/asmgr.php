<?php
/**************************************************
  Coppermine 1.4.x Plugin - Live Search (Ajax Base)
  *************************************************
  Copyright (c) 2006 Borzoo Mossavari
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Simple Ajax search :
  - Search Title of files
  - Search Title of Albums
  
  Licence:
  Orginal Javascript and CSS : Coded by Timothy Groves,
  a designer based in Munich, Germany
  Under Creative Commons License.
  URL:
  http://www.brandspankingnew.net/specials/ajax_autosuggest/ajax_autosuggest_autocomplete.html
  
  Moded By Borzoo Mossavari (Bmossavari(at)gmail(dot)com)
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
//check posted value for Menu Item creation
if (isset($_POST['create_item'])) {
	$item_title=addslashes($_POST['title']);
	$item_admin=addslashes($_POST['admin_menu']);
	$item_hr=addslashes($_POST['hr']);
	$item_url=addslashes($_POST['url']);
	$item_target=addslashes($_POST['target']);
	$item_id=addslashes($_POST['id'])+1;
	$sql="INSERT INTO `{$CONFIG['TABLE_PLUGIN_RCMENU']}` (id,title,admin,url,target,hrnext) VALUES ('$item_id','$item_title','$item_admin','$item_url','$item_target','$item_hr')";
	cpg_db_query($sql);
}
//check posted value for Menu items changing
if (isset($_POST['change_items'])) {
	for ($i=0;$i<=30;$i++) {
		$p_id="id_".$i;
		$p_title="title_".$i;
		$p_target="target_".$i;
		$p_url="url_".$i;
		$p_hr="hr_".$i;
		$p_admin="admin_".$i;
		if(isset($_POST[$p_id])) {
			$up_id=addslashes($_POST[$p_id]);
			$up_title=addslashes($_POST[$p_title]);
			$up_target=addslashes($_POST[$p_target]);
			$up_url=addslashes($_POST[$p_url]);
			$up_hr=addslashes($_POST[$p_hr]);
			$up_admin=addslashes($_POST[$p_admin]);
			$sql="UPDATE `{$CONFIG['TABLE_PLUGIN_RCMENU']}` SET id='$up_id',title='$up_title',target='$up_target',url='$up_url',hrnext='$up_hr',admin='$up_admin' Where id='$i'";
			//echo $sql;
			cpg_db_query($sql);
		}
	}
$sql="DELETE FROM `{$CONFIG['TABLE_PLUGIN_RCMENU']}` WHERE id='0'";
cpg_db_query($sql);
}
pageheader($lang_plugin_rcmenu['display_name']);
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
}
onload=change;
</script>
<?php
starttable('100%', 'Right Click Menu manager - '.$lang_plugin_rcmenu['version'].'<font size=1 color=red> By <a href=\"http://www.myprj.com\">BMossavari at gmail dot com</a></font>- <a href="pluginmgr.php" class="admin_menu">Plugin Manager</a>', 3);
echo <<<EOT
    <tr>
        <td class="tableh2" colspan="3">
            <a href="javascript:expand();" class="admin_menu">{$lang_plugin_rcmenu_config['expand_all']}&nbsp;&nbsp;<img src="images/descending.gif" width="9" height="9" border="0" alt="" title="{$lang_plugin_rcmenu_config['expand_all']}" /></a>
        </td>
    </tr>
EOT;
//Create a list of menu items
$sql="SELECT id,title,url,target,hrnext,admin FROM `{$CONFIG['TABLE_PLUGIN_RCMENU']}` order by id";
$result=cpg_db_query($sql);
?>
<TR>
  <TD class=tableh2 onClick="show_section('section0')" colSpan=3><SPAN 
            style="CURSOR: pointer"><IMG title="click section name to expand" 
            height=9 alt="" 
            src="images/descending.gif" 
            width=9 border=0> <strong><?php echo $lang_plugin_rcmenumgr['items']; ?> </strong></SPAN></TD>
</TR>
<TR>
  <TD><TABLE class="maintable" id="section0" cellSpacing="1" cellPadding="0" width="100%" align="center" border="0">
      <form id="item_list" name="item_list" method="post" action="<?php echo $_SERVER['REQUEST_URI']?>">
        <TR>
        <TD><TABLE class=maintable cellSpacing=1 cellPadding=0 width="100%" align=center border=0>
            <TR>
              <TD width="5%" align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><strong><?php echo $lang_plugin_rcmenumgr['id']; ?></strong></TD>
              <TD width="15%" align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><strong><?php echo $lang_plugin_rcmenumgr['list_title']; ?></strong></TD>
              <TD width="35%" align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><strong><?php echo $lang_plugin_rcmenumgr['list_url']; ?></strong></TD>
              <TD width="15%" align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><strong><?php echo $lang_plugin_rcmenumgr['list_target']; ?></strong></TD>
              <TD width="15%" align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><strong><?php echo $lang_plugin_rcmenumgr['list_hr']; ?></strong></TD>
              <TD width="15%" align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><strong><?php echo $lang_plugin_rcmenumgr['list_admin']; ?></strong></TD>
            </TR>
            
              <?php while($row=mysql_fetch_assoc($result)){?>
              <TR>
                <TD class=tableb align="<?php echo $align ?>" dir="<?php echo $direction ?>"><input name="id_<?php echo (stripslashes($row['id']));?>" type="text" id="id_<?php echo (stripslashes($row['id']));?>" value="<?php echo (stripslashes($row['id']));?>" size="1" maxlength="2">
                </TD>
                <TD align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb>
                  <input name="title_<?php echo (stripslashes($row['id']));?>" type="text" id="title_<?php echo (stripslashes($row['id']));?>" value="<?php echo (stripslashes($row['title']));?>" size="10" maxlength="45">
                </TD>
                <TD align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><input name="url_<?php echo (stripslashes($row['id']));?>" type="text" id="url_<?php echo (stripslashes($row['id']));?>" value="<?php echo (stripslashes($row['url']));?>" size="40" maxlength="255"></TD>
                <TD align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><input name="target_<?php echo (stripslashes($row['id']));?>" type="text" id="target_<?php echo (stripslashes($row['id']));?>" value="<?php echo (stripslashes($row['target']));?>" size="15" maxlength="15" disabled="disabled">                </TD>
                <TD align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><select name="hr_<?php echo (stripslashes($row['id']));?>" id="hr_<?php echo (stripslashes($row['id']));?>">
              <option value="0" <?php if($row['hrnext']==0) echo "selected"; ?>><?php echo $lang_plugin_rcmenumgr['no']; ?></option>
              <option value="1" <?php if($row['hrnext']==1) echo "selected"; ?>><?php echo $lang_plugin_rcmenumgr['yes']; ?></option>
                </select></TD>
                <TD align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><select name="admin_<?php echo (stripslashes($row['id']));?>" id="admin_<?php echo (stripslashes($row['id']));?>">
              <option value="0" <?php if($row['admin']==0) echo "selected"; ?>><?php echo $lang_plugin_rcmenumgr['no']; ?></option>
              <option value="1" <?php if($row['admin']==1) echo "selected"; ?>><?php echo $lang_plugin_rcmenumgr['yes']; ?></option>
            </select></TD>
              </TR>
              <?php } ?>
          </TABLE></TD>
      </TR>
      <TR>
        <TD align="center" class="tableb"><input name="change_items" type="submit" class="button" id="change_items" value="<?php echo $lang_plugin_rcmenumgr['list_but']; ?>" />
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="<?php echo $align ?>" dir="<?php echo $direction ?>"><?php echo $lang_plugin_rcmenumgr['delete']; ?></td>
            </tr>
            <tr>
              <td align="<?php echo $align ?>" dir="<?php echo $direction ?>"><?php echo $lang_plugin_rcmenumgr['max']; ?></td>
            </tr>
          </table>        </TD>
      </TR></form>
  </TABLE></TD>
</TR>
<TR>
  <TD class=tableh2 colSpan=3 onClick="show_section('section1')"><SPAN style="CURSOR: pointer"><IMG title="click section name to expand" height=9 alt="" src="images/descending.gif" width=9 border=0><strong> <?php echo $lang_plugin_rcmenumgr['create']; ?></strong></SPAN> </TD>
</TR>
<TR>
  <TD><TABLE class=maintable cellSpacing=1 cellPadding=0 width="100%" align=center border=0 id="section1" >
      <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <TR>
          <TD width="25%" align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><strong><?php echo $lang_plugin_rcmenumgr['name']; ?></strong> :
            <input value="" name="title" dir="<?php echo $direction ?>" align="<?php echo $align ?>" id="title" maxlength="45" class="textinput" size="30"/>
          </TD>
        </TR>
        <TR>
          <TD align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><strong><?php echo $lang_plugin_rcmenumgr['admin_menu']; ?></strong> :
            <select name="admin_menu" id="admin_menu">
              <option value="0"><?php echo $lang_plugin_rcmenumgr['no']; ?></option>
              <option value="1"><?php echo $lang_plugin_rcmenumgr['yes']; ?></option>
            </select></TD>
        </TR>
        <TR>
          <TD align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><strong><?php echo $lang_plugin_rcmenumgr['hr']; ?></strong> :
            <select name="hr" id="hr">
              <option value="0" ><?php echo $lang_plugin_rcmenumgr['no']; ?></option>
              <option value="1" ><?php echo $lang_plugin_rcmenumgr['yes']; ?></option>
            </select>
          </TD>
        </TR>
        <TR><tr>
                <td align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><strong><?php echo $lang_plugin_rcmenumgr['url']; ?></strong> :
                  <input value="http://www.coppermine-gallery.net" name="url" dir="<?php echo $direction ?>" align="<?php echo $align ?>" id="url" maxlength="255" class="textinput" size="35"/>                </td>
              </tr>
          <tr>
                <td align="<?php echo $align ?>" dir="<?php echo $direction ?>" class=tableb><strong><?php echo $lang_plugin_rcmenumgr['target']; ?></strong> :
                  <input name="target" class="textinput" id="target" dir="<?php echo $direction ?>" value="_self" size="15" maxlength="15" align="<?php echo $align ?>" disabled="disabled"/>                </td>
                      </TR>
        <tr>
          <td class="tableb"><br />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" class=tableb><input name="id" type="hidden" value="<?php $sql="SELECT max(id) as id from `{$CONFIG['TABLE_PLUGIN_RCMENU']}`";
				$result=cpg_db_query($sql);
				$row=mysql_fetch_assoc($result);
				echo $row['id']; 
				?>" id="id"/>
                <INPUT name="create_item" type=submit class=button id="create_item" value="<?php echo $lang_plugin_rcmenumgr['create']; ?>"></td>
              </tr>
            </table></td>
        </tr>
      </form>
    </TABLE></TD>
</TR>
<?php
endtable();
pagefooter();
ob_end_flush();
mysql_free_result($result);
?>