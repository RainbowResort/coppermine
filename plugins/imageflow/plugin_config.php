<?php
/**************************************************
  Coppermine 1.4.x Plugin - Imageflow $VERSION$=2.08
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ***************************************************/

require('include/init.inc.php');
require('./plugins/imageflow/include/init.inc.php');
require('./plugins/imageflow/include/load_imageflowset.php');

global $CONFIG,$lang_plugin_imageflow,$lang_meta_album_names;
if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
if($lang_text_dir=='ltr') {
  $align="left";
  $direction="ltr";
}else {
  $align="right";
  $direction="rtl";
}
if(isset($_POST['update'])){
  $imageflow_width = $_POST['imageflow_width'];
  $imageflow_intable = $_POST['imageflow_intable'];
  $imageflow_numberofpics = $_POST['imageflow_numberofpics'];
  $imageflow_cache = $_POST['imageflow_cache'];
  $imageflow_bgcolor = $_POST['imageflow_bgcolor'];
  $imageflow_procent = $_POST['imageflow_procent'];
  $imageflow_skipportrait = $_POST['imageflow_skipportrait'];
  $imageflow_align = $_POST['imageflow_align'];
  $imageflow_topcorrect = $_POST['imageflow_topcorrect'];
  $imageflow_album = $_POST['imageflow_album'];
  $imageflow_standardtable = $_POST['imageflow_standardtable'];
  $imageflow_useenlarge = $_POST['imageflow_useenlarge'];
//  $imageflow_enlborder = $_POST['imageflow_enlborder'];
//  $imageflow_enlbrdsize = $_POST['imageflow_enlbrdsize'];
//  $imageflow_enlbrdcolor = $_POST['imageflow_enlbrdcolor'];
//  $imageflow_enlmaxstep = $_POST['imageflow_enlmaxstep'];
//  $imageflow_enlspeed = $_POST['imageflow_enlspeed'];
//  $imageflow_enlani = $_POST['imageflow_enlani'];
//  $imageflow_enlshadow = $_POST['imageflow_enlshadow'];
//  $imageflow_enlshadowsize = $_POST['imageflow_enlshadowsize'];
//  $imageflow_enlshadowintens = $_POST['imageflow_enlshadowintens'];
//  $imageflow_enlshowcap = $_POST['imageflow_enlshowcap'];
  $imageflow_pictype = $_POST['imageflow_pictype'];
//  $imageflow_enlclosebtn = $_POST['imageflow_enlclosebtn'];
//  $imageflow_enlcenter = $_POST['imageflow_enlcenter'];
//  $imageflow_enldark = $_POST['imageflow_enldark'];
  
  
  // if someone types text into a number input field, set default value
  
  if($imageflow_numberofpics != strval(intval($imageflow_numberofpics))) $imageflow_numberofpics = 15;
  if($imageflow_numberofpics < 7) $imageflow_numberofpics = 7;
  if($imageflow_topcorrect != strval(intval($imageflow_topcorrect))) $imageflow_topcorrect = 0;
  if($imageflow_topcorrect < -200) $imageflow_numberofpics = -200;
  if($imageflow_topcorrect > 400) $imageflow_numberofpics = 400;
  $imageflow_width = preg_replace("/\s+/", "", $imageflow_width);
  
  $s="UPDATE `{$CONFIG['TABLE_PREFIX']}mod_imageflow` SET imageflow_pictype=('$imageflow_pictype'), imageflow_useenlarge=($imageflow_useenlarge),imageflow_standardtable=($imageflow_standardtable),imageflow_album=('$imageflow_album'),imageflow_procent=('$imageflow_procent'), imageflow_topcorrect=($imageflow_topcorrect), imageflow_width=('$imageflow_width'), imageflow_intable=($imageflow_intable), imageflow_numberofpics=($imageflow_numberofpics), imageflow_cache=($imageflow_cache), imageflow_bgcolor=('$imageflow_bgcolor'), imageflow_skipportrait=($imageflow_skipportrait), imageflow_align=('$imageflow_align')";
  cpg_db_query($s); 
    pageheader($lang_plugin_imageflow['display_name']);
    msg_box($lang_plugin_imageflow['display_name'], $lang_plugin_imageflow['update_success'], $lang_continue, 'index.php');
  pagefooter();
        exit;

}
pageheader($lang_plugin_imageflow['display_name']);
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
//onload = change;
</script>

<?php
starttable('100%', $lang_plugin_imageflow['main_title'].' - '.$lang_plugin_imageflow['version'].'<font size=1 color=red> by <a href="http://www.timos-welt.de">Timos-Welt</font> - <a href="pluginmgr.php" class="admin_menu">'.$lang_plugin_imageflow['pluginmanager'].'</a>', 3);
?>

<TR>
  <TD class=tableh2 colSpan=3 onClick="show_section('section1')"><SPAN style="CURSOR: pointer"><IMG title="Config" height=9 alt="" src="images/descending.gif" width=9 border=0> <strong><?php echo $lang_plugin_imageflow['main_title']?></strong></SPAN> </TD>
</TR>
<TR>
  <td><form action="<?php $_SERVER['PHP_SELF']?>" method="post" name="imageflow_settings">
      <table class="maintable" cellSpacing="2" cellPadding="2" width="100%" align="<?php echo $align?>" border=0 id="section1">
        <tr>
          <td width="50%">&nbsp;</td>
          <td width="50%">&nbsp;</td>
        </tr>
        <tr>
          <td width="50%" align="right">
            <?php echo $lang_plugin_imageflow['imageflow_width']?>&nbsp;&nbsp;
          </td>
          <td width="50%">
            <input id="imageflow_width" name="imageflow_width" type="int" value="<?php echo $IMAGEFLOWSET['imageflow_width']?>">
          </td>
        </tr>
        <tr>
          <td width="50%" align="right">
            <?php echo $lang_plugin_imageflow['imageflow_numberofpics']?>&nbsp;&nbsp;
          </td>
          <td width="50%">
            <input id="imageflow_numberofpics" name="imageflow_numberofpics" type="int" value="<?php echo $IMAGEFLOWSET['imageflow_numberofpics']?>">
          </td>
        </tr>
        <tr>
          <td width="50%" align="right">
            <?php echo $lang_plugin_imageflow['imageflow_bgcolor']?>&nbsp;&nbsp;
          </td>
          <td width="50%">
            <input id="imageflow_bgcolor" name="imageflow_bgcolor" value="<?php echo $IMAGEFLOWSET['imageflow_bgcolor']?>">
          </td>
        </tr>
        <tr>
          <td align="right">
          	<?php echo $lang_plugin_imageflow['skipportrait']?>&nbsp;&nbsp;</td>
          <td><input name="imageflow_skipportrait" type="radio" value="1" <?php if($IMAGEFLOWSET['imageflow_skipportrait']) echo 'checked="checked"';?> id="imageflow_skipportrait"/>
            <?php echo $lang_plugin_imageflow['imageflow_yes']?>
            <input name="imageflow_skipportrait" type="radio" value="0" <?php if(!$IMAGEFLOWSET['imageflow_skipportrait']) echo 'checked="checked"';?> id="imageflow_skipportrait"/>
            <?php echo $lang_plugin_imageflow['imageflow_no']?> 
        </tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['standardtable']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_standardtable" id="imageflow_standardtable">
                 <option value="0" <?php if($IMAGEFLOWSET['imageflow_standardtable'] == 0) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_no']?></option>
                 <option value="1" <?php if($IMAGEFLOWSET['imageflow_standardtable'] == 1) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_yes']?></option>          
              </select>
          </td>
        </tr>        <tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['album']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_album" id="imageflow_album">
                 <option value="random" <?php if($IMAGEFLOWSET['imageflow_album'] == "random") echo 'selected="selected"';?>><?php echo $lang_meta_album_names['random']?></option>
                 <option value="lastup" <?php if($IMAGEFLOWSET['imageflow_album'] == "lastup") echo 'selected="selected"';?>><?php echo $lang_meta_album_names['lastup']?></option>
                 <option value="topn" <?php if($IMAGEFLOWSET['imageflow_album'] == "topn") echo 'selected="selected"';?>><?php echo $lang_meta_album_names['topn']?></option>
                 <option value="toprated" <?php if($IMAGEFLOWSET['imageflow_album'] == "toprated") echo 'selected="selected"';?>><?php echo $lang_meta_album_names['toprated']?></option>
              </select>
          </td>
        </tr>        	<td align="right"><?php echo $lang_plugin_imageflow['align']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_align" id="imageflow_align">
                 <option value="left" <?php if($IMAGEFLOWSET['imageflow_align'] == 'left') echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['left']?></option>
                 <option value="center" <?php if($IMAGEFLOWSET['imageflow_align'] == 'center') echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['center']?></option>
              </select>
          </td>
        </tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['intable']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_intable" id="imageflow_intable">
                 <option value="0" <?php if($IMAGEFLOWSET['imageflow_intable'] == 0) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_no']?></option>
                 <option value="1" <?php if($IMAGEFLOWSET['imageflow_intable'] == 1) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_yes']?></option>          
              </select>
          </td>
        </tr>
        <tr>
        	<td align="right"><b><br /><br /><?php echo $lang_plugin_imageflow['enlargeoptions']?></b>&nbsp;&nbsp;<br />&nbsp;</td>
        </tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['useenlarge']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_useenlarge" id="imageflow_useenlarge">
                 <option value="1" <?php if($IMAGEFLOWSET['imageflow_useenlarge'] == 1) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_yes']?></option>
                 <option value="0" <?php if($IMAGEFLOWSET['imageflow_useenlarge'] == 0) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['pictype']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_pictype" id="imageflow_pictype">
                 <option value="normal" <?php if($IMAGEFLOWSET['imageflow_pictype'] == 'normal') echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_normalsize']?></option>
                 <option value="fullsize" <?php if($IMAGEFLOWSET['imageflow_pictype'] == 'fullsize') echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_fullsize']?></option>
              </select>
          </td>
        </tr>  
        <tr>
        	<td align="right"><b><br /><br /><?php echo $lang_plugin_imageflow['hardcore']?></b>&nbsp;&nbsp;<br /><br />&nbsp;</td>
        </tr>
        <tr>
          <td width="50%" align="right">
            <?php echo $lang_plugin_imageflow['topcorrect']?>&nbsp;&nbsp;
          </td>
          <td width="50%">
            <input id="imageflow_topcorrect" name="imageflow_topcorrect" type="int" value="<?php echo $IMAGEFLOWSET['imageflow_topcorrect']?>"> px
          </td>
        </tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['procent']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_procent" id="imageflow_procent">
                 <option value="0.33" <?php if($IMAGEFLOWSET['imageflow_procent'] == '0.33') echo 'selected="selected"';?>>33%</option>
                 <option value="0.4" <?php if($IMAGEFLOWSET['imageflow_procent'] == '0.4') echo 'selected="selected"';?>>40%</option>
                 <option value="0.5" <?php if($IMAGEFLOWSET['imageflow_procent'] == '0.5') echo 'selected="selected"';?>>50%</option>
                 <option value="0.6" <?php if($IMAGEFLOWSET['imageflow_procent'] == '0.6') echo 'selected="selected"';?>>60%</option>
                 <option value="0.66" <?php if($IMAGEFLOWSET['imageflow_procent'] == '0.66') echo 'selected="selected"';?>>66%</option>
                 <option value="0.7" <?php if($IMAGEFLOWSET['imageflow_procent'] == '0.7') echo 'selected="selected"';?>>70%</option>
                 <option value="0.75" <?php if($IMAGEFLOWSET['imageflow_procent'] == '0.75') echo 'selected="selected"';?>>75%</option>
                 <option value="0.8" <?php if($IMAGEFLOWSET['imageflow_procent'] == '0.8') echo 'selected="selected"';?>>80%</option>
                 <option value="0.9" <?php if($IMAGEFLOWSET['imageflow_procent'] == '0.9') echo 'selected="selected"';?>>90%</option>
                 <option value="1.0" <?php if($IMAGEFLOWSET['imageflow_procent'] == '1.0') echo 'selected="selected"';?>>100%</option>
              </select>
          </td>
        </tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['cache']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_cache" id="imageflow_cache">
                 <option value="0" <?php if($IMAGEFLOWSET['imageflow_cache'] == 0) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_no']?></option>
                 <option value="1" <?php if($IMAGEFLOWSET['imageflow_cache'] == 1) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_yes']?></option>
                 
              </select>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
            <input name="update" type="hidden" id="update" value="1" /></td>
        </tr>  
        <tr>
          <td>&nbsp;</td>
          <td align="left"><input name="Submit" type="submit" value="<?php echo $lang_plugin_imageflow['submit_button']?>" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
      </table>
    </form></td>
</tr>
<?php 
endtable();
pagefooter();
ob_end_flush();

/*
      
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['enlani']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_enlani" id="imageflow_enlani">
                 <option value="0" <?php if($IMAGEFLOWSET['imageflow_enlani'] == 0) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['noani']?></option>
                 <option value="1" <?php if($IMAGEFLOWSET['imageflow_enlani'] == 1) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['fade']?></option>
                 <option value="2" <?php if($IMAGEFLOWSET['imageflow_enlani'] == 2) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['glide']?></option>
                 <option value="3" <?php if($IMAGEFLOWSET['imageflow_enlani'] == 3) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['bumpglide']?></option>
              </select>
          </td>
        </tr>             
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['enlspeed']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_enlspeed" id="imageflow_enlspeed">
                 <option value="10" <?php if($IMAGEFLOWSET['imageflow_enlspeed'] == 10) echo 'selected="selected"';?>>10</option>
                 <option value="12" <?php if($IMAGEFLOWSET['imageflow_enlspeed'] == 12) echo 'selected="selected"';?>>12</option>
                 <option value="14" <?php if($IMAGEFLOWSET['imageflow_enlspeed'] == 14) echo 'selected="selected"';?>>14</option>
                 <option value="16" <?php if($IMAGEFLOWSET['imageflow_enlspeed'] == 16) echo 'selected="selected"';?>>16</option>
                 <option value="18" <?php if($IMAGEFLOWSET['imageflow_enlspeed'] == 18) echo 'selected="selected"';?>>18</option>
                 <option value="20" <?php if($IMAGEFLOWSET['imageflow_enlspeed'] == 20) echo 'selected="selected"';?>>20</option>
                 <option value="22" <?php if($IMAGEFLOWSET['imageflow_enlspeed'] == 22) echo 'selected="selected"';?>>22</option>
                 <option value="24" <?php if($IMAGEFLOWSET['imageflow_enlspeed'] == 24) echo 'selected="selected"';?>>24</option>
                 <option value="26" <?php if($IMAGEFLOWSET['imageflow_enlspeed'] == 26) echo 'selected="selected"';?>>26</option>
                 <option value="28" <?php if($IMAGEFLOWSET['imageflow_enlspeed'] == 28) echo 'selected="selected"';?>>28</option>
                 <option value="30" <?php if($IMAGEFLOWSET['imageflow_enlspeed'] == 30) echo 'selected="selected"';?>>30</option>
                 <option value="32" <?php if($IMAGEFLOWSET['imageflow_enlspeed'] == 32) echo 'selected="selected"';?>>32</option>
              </select>
          </td>
        </tr>   
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['enlmaxstep']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_enlmaxstep" id="imageflow_enlmaxstep">
                 <option value="4" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 4) echo 'selected="selected"';?>>4</option>
                 <option value="5" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 5) echo 'selected="selected"';?>>5</option>
                 <option value="6" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 6) echo 'selected="selected"';?>>6</option>
                 <option value="7" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 7) echo 'selected="selected"';?>>7</option>
                 <option value="8" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 8) echo 'selected="selected"';?>>8</option>
                 <option value="9" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 9) echo 'selected="selected"';?>>9</option>
                 <option value="10" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 10) echo 'selected="selected"';?>>10</option>
                 <option value="11" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 11) echo 'selected="selected"';?>>11</option>
                 <option value="12" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 12) echo 'selected="selected"';?>>12</option>
                 <option value="13" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 13) echo 'selected="selected"';?>>13</option>
                 <option value="14" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 14) echo 'selected="selected"';?>>14</option>
                 <option value="15" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 15) echo 'selected="selected"';?>>15</option>
                 <option value="16" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 16) echo 'selected="selected"';?>>16</option>
                 <option value="17" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 17) echo 'selected="selected"';?>>17</option>
                 <option value="18" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 18) echo 'selected="selected"';?>>18</option>
                 <option value="19" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 19) echo 'selected="selected"';?>>19</option>
                 <option value="20" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 20) echo 'selected="selected"';?>>20</option>
                 <option value="21" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 21) echo 'selected="selected"';?>>21</option>
                 <option value="22" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 22) echo 'selected="selected"';?>>22</option>
                 <option value="23" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 23) echo 'selected="selected"';?>>23</option>
                 <option value="24" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 24) echo 'selected="selected"';?>>24</option>
                 <option value="25" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 25) echo 'selected="selected"';?>>25</option>
                 <option value="26" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 26) echo 'selected="selected"';?>>26</option>
                 <option value="27" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 27) echo 'selected="selected"';?>>27</option>
                 <option value="28" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 28) echo 'selected="selected"';?>>28</option>
                 <option value="29" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 29) echo 'selected="selected"';?>>29</option>
                 <option value="30" <?php if($IMAGEFLOWSET['imageflow_enlmaxstep'] == 30) echo 'selected="selected"';?>>30</option>
              </select>
          </td>
        </tr>   
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['enlshowcap']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_enlshowcap" id="imageflow_enlshowcap">
                 <option value="1" <?php if($IMAGEFLOWSET['imageflow_enlshowcap'] == 1) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_yes']?></option>
                 <option value="0" <?php if($IMAGEFLOWSET['imageflow_enlshowcap'] == 0) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_no']?></option>
              </select>
          </td>
        </tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['enlclosebtn']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_enlclosebtn" id="imageflow_enlclosebtn">
                 <option value="1" <?php if($IMAGEFLOWSET['imageflow_enlclosebtn'] == 1) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_yes']?></option>
                 <option value="0" <?php if($IMAGEFLOWSET['imageflow_enlclosebtn'] == 0) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['enlcenter']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_enlcenter" id="imageflow_enlcenter">
                 <option value="1" <?php if($IMAGEFLOWSET['imageflow_enlcenter'] == 1) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_yes']?></option>
                 <option value="0" <?php if($IMAGEFLOWSET['imageflow_enlcenter'] == 0) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['enldark']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_enldark" id="imageflow_enldark">
                 <option value="1" <?php if($IMAGEFLOWSET['imageflow_enldark'] == 1) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_yes']?></option>
                 <option value="0" <?php if($IMAGEFLOWSET['imageflow_enldark'] == 0) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['enlborder']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_enlborder" id="imageflow_enlborder">
                 <option value="1" <?php if($IMAGEFLOWSET['imageflow_enlborder'] == 1) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_yes']?></option>
                 <option value="0" <?php if($IMAGEFLOWSET['imageflow_enlborder'] == 0) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_no']?></option>
              </select>
          </td>
        </tr>          
        <tr>
          <td width="50%" align="right">
            <?php echo $lang_plugin_imageflow['enlbrdcolor']?>&nbsp;&nbsp;
          </td>
          <td width="50%">
            <input id="imageflow_enlbrdcolor" name="imageflow_enlbrdcolor" value="<?php echo $IMAGEFLOWSET['imageflow_enlbrdcolor']?>">
          </td>
        </tr>        
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['enlbrdsize']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_enlbrdsize" id="imageflow_enlbrdsize">
                 <option value="1" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 1) echo 'selected="selected"';?>>1</option>
                 <option value="2" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 2) echo 'selected="selected"';?>>2</option>
                 <option value="3" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 3) echo 'selected="selected"';?>>3</option>
                 <option value="4" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 4) echo 'selected="selected"';?>>4</option>
                 <option value="5" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 5) echo 'selected="selected"';?>>5</option>
                 <option value="6" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 6) echo 'selected="selected"';?>>6</option>
                 <option value="7" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 7) echo 'selected="selected"';?>>7</option>
                 <option value="8" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 8) echo 'selected="selected"';?>>8</option>
                 <option value="9" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 9) echo 'selected="selected"';?>>9</option>
                 <option value="10" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 10) echo 'selected="selected"';?>>10</option>
                 <option value="11" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 11) echo 'selected="selected"';?>>11</option>
                 <option value="12" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 12) echo 'selected="selected"';?>>12</option>
                 <option value="13" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 13) echo 'selected="selected"';?>>13</option>
                 <option value="14" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 14) echo 'selected="selected"';?>>14</option>
                 <option value="15" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 15) echo 'selected="selected"';?>>15</option>
                 <option value="16" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 16) echo 'selected="selected"';?>>16</option>
                 <option value="17" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 17) echo 'selected="selected"';?>>17</option>
                 <option value="18" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 18) echo 'selected="selected"';?>>18</option>
                 <option value="19" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 19) echo 'selected="selected"';?>>19</option>
                 <option value="20" <?php if($IMAGEFLOWSET['imageflow_enlbrdsize'] == 20) echo 'selected="selected"';?>>20</option>
              </select>
          </td>
        </tr> 
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['enlbrdshadow']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_enlshadow" id="imageflow_enlshadow">
                 <option value="1" <?php if($IMAGEFLOWSET['imageflow_enlshadow'] == 1) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_yes']?></option>
                 <option value="0" <?php if($IMAGEFLOWSET['imageflow_enlshadow'] == 0) echo 'selected="selected"';?>><?php echo $lang_plugin_imageflow['imageflow_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['enlshadowsize']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_enlshadowsize" id="imageflow_enlshadowsize">
                 <option value="1" <?php if($IMAGEFLOWSET['imageflow_enlshadowsize'] == 1) echo 'selected="selected"';?>>1</option>
                 <option value="2" <?php if($IMAGEFLOWSET['imageflow_enlshadowsize'] == 2) echo 'selected="selected"';?>>2</option>
                 <option value="3" <?php if($IMAGEFLOWSET['imageflow_enlshadowsize'] == 3) echo 'selected="selected"';?>>3</option>
                 <option value="4" <?php if($IMAGEFLOWSET['imageflow_enlshadowsize'] == 4) echo 'selected="selected"';?>>4</option>
                 <option value="5" <?php if($IMAGEFLOWSET['imageflow_enlshadowsize'] == 5) echo 'selected="selected"';?>>5</option>
                 <option value="6" <?php if($IMAGEFLOWSET['imageflow_enlshadowsize'] == 6) echo 'selected="selected"';?>>6</option>
                 <option value="7" <?php if($IMAGEFLOWSET['imageflow_enlshadowsize'] == 7) echo 'selected="selected"';?>>7</option>
                 <option value="8" <?php if($IMAGEFLOWSET['imageflow_enlshadowsize'] == 8) echo 'selected="selected"';?>>8</option>
                 <option value="9" <?php if($IMAGEFLOWSET['imageflow_enlshadowsize'] == 9) echo 'selected="selected"';?>>9</option>
              </select>
          </td>
        </tr>           
        <tr>
        	<td align="right"><?php echo $lang_plugin_imageflow['enlshadowintens']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="imageflow_enlshadowintens" id="imageflow_enlshadowintens">
                 <option value="1" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 1) echo 'selected="selected"';?>>1</option>
                 <option value="2" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 2) echo 'selected="selected"';?>>2</option>
                 <option value="3" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 3) echo 'selected="selected"';?>>3</option>
                 <option value="4" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 4) echo 'selected="selected"';?>>4</option>
                 <option value="5" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 5) echo 'selected="selected"';?>>5</option>
                 <option value="6" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 6) echo 'selected="selected"';?>>6</option>
                 <option value="7" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 7) echo 'selected="selected"';?>>7</option>
                 <option value="8" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 8) echo 'selected="selected"';?>>8</option>
                 <option value="9" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 9) echo 'selected="selected"';?>>9</option>
                 <option value="10" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 10) echo 'selected="selected"';?>>10</option>
                 <option value="11" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 11) echo 'selected="selected"';?>>11</option>
                 <option value="12" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 12) echo 'selected="selected"';?>>12</option>
                 <option value="13" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 13) echo 'selected="selected"';?>>13</option>
                 <option value="14" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 14) echo 'selected="selected"';?>>14</option>
                 <option value="15" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 15) echo 'selected="selected"';?>>15</option>
                 <option value="16" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 16) echo 'selected="selected"';?>>16</option>
                 <option value="17" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 17) echo 'selected="selected"';?>>17</option>
                 <option value="18" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 18) echo 'selected="selected"';?>>18</option>
                 <option value="19" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 19) echo 'selected="selected"';?>>19</option>
                 <option value="20" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 20) echo 'selected="selected"';?>>20</option>
                 <option value="25" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 25) echo 'selected="selected"';?>>25</option>
                 <option value="30" <?php if($IMAGEFLOWSET['imageflow_enlshadowintens'] == 30) echo 'selected="selected"';?>>30</option>
              </select>
          </td>
        </tr>
        
        */

?>