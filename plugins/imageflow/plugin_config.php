<?php
/**************************************************
  Coppermine 1.5.x Plugin - Imageflow
  *************************************************
  Copyright (c) 2010 Timo Schewe (www.timos-welt.de)
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

$imageflow_superCage = Inspekt::makeSuperCage();


if ($imageflow_superCage->post->keyExists('update')) {
  if ($imageflow_matches = $imageflow_superCage->post->getMatched('imageflow_width','/^[px0-9\%]+$/'))
  {
    $imageflow_width = $imageflow_matches[0];
  }  
  $imageflow_cache = $imageflow_superCage->post->getInt('imageflow_cache');
  $imageflow_intable = $imageflow_superCage->post->getInt('imageflow_intable');
  $imageflow_numberofpics = $imageflow_superCage->post->getInt('imageflow_numberofpics');
  if ($imageflow_matches = $imageflow_superCage->post->getMatched('imageflow_bgcolor','/^[a-zA-Z0-9#]+$/'))
  {
    $imageflow_bgcolor = $imageflow_matches[0];
  }
  
  if ($imageflow_matches = $imageflow_superCage->post->getMatched('imageflow_procent','/^[0-9\.]+$/'))
  {
    $imageflow_procent = $imageflow_matches[0];
  } 
  
  
  $imageflow_skipportrait = $imageflow_superCage->post->getInt('imageflow_skipportrait');
  $imageflow_auto = $imageflow_superCage->post->getInt('imageflow_auto');
  $imageflow_usewheel = $imageflow_superCage->post->getInt('imageflow_usewheel');
  $imageflow_usekeys = $imageflow_superCage->post->getInt('imageflow_usekeys');
  $imageflow_autotime = $imageflow_superCage->post->getInt('imageflow_autotime');
  $imageflow_align = $imageflow_superCage->post->getAlnum('imageflow_align');
  $imageflow_topcorrect = $imageflow_superCage->post->getInt('imageflow_topcorrect');
  $imageflow_album = $imageflow_superCage->post->getAlnum('imageflow_album');
  $imageflow_useenlarge = $imageflow_superCage->post->getInt('imageflow_useenlarge');
  $imageflow_pictype = $imageflow_superCage->post->getAlnum('imageflow_pictype');
  
 
  
  // if someone types text into a number input field, set default value
  
  if($imageflow_numberofpics != strval(intval($imageflow_numberofpics))) $imageflow_numberofpics = 15;
  if($imageflow_numberofpics < 7) $imageflow_numberofpics = 7;
  if($imageflow_topcorrect != strval(intval($imageflow_topcorrect))) $imageflow_topcorrect = 0;
  if($imageflow_topcorrect < -200) $imageflow_topcorrect = -200;
  if($imageflow_topcorrect > 400) $imageflow_topcorrect = 400;
  $imageflow_width = preg_replace("/\s+/", "", $imageflow_width);
  if ($imageflow_autotime < 2) $imageflow_autotime = 2;
  if ($imageflow_autotime > 20) $imageflow_autotime = 20;
  
  $s="UPDATE `{$CONFIG['TABLE_PREFIX']}mod_imageflow` SET imageflow_usewheel=($imageflow_usewheel),imageflow_usekeys=($imageflow_usekeys),imageflow_auto=($imageflow_auto),imageflow_autotime=($imageflow_autotime),imageflow_pictype=('$imageflow_pictype'), imageflow_useenlarge=($imageflow_useenlarge),imageflow_album=('$imageflow_album'),imageflow_procent=('$imageflow_procent'), imageflow_topcorrect=($imageflow_topcorrect), imageflow_width=('$imageflow_width'), imageflow_intable=($imageflow_intable), imageflow_numberofpics=($imageflow_numberofpics), imageflow_cache=($imageflow_cache), imageflow_bgcolor=('$imageflow_bgcolor'), imageflow_skipportrait=($imageflow_skipportrait), imageflow_align=('$imageflow_align')";
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
starttable('100%', $lang_plugin_imageflow['main_title'].' - '.$lang_plugin_imageflow['version'].'<font size=1 color=red> by <a href="http://www.timos-welt.de">Timos Schewe</font>', 3);
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
          <td align="right">
          	<?php echo $lang_plugin_imageflow['imageflow_auto']?>&nbsp;&nbsp;</td>
          <td><input name="imageflow_auto" type="radio" value="1" <?php if($IMAGEFLOWSET['imageflow_auto']) echo 'checked="checked"';?> id="imageflow_auto"/>
            <?php echo $lang_plugin_imageflow['imageflow_yes']?>
            <input name="imageflow_auto" type="radio" value="0" <?php if(!$IMAGEFLOWSET['imageflow_auto']) echo 'checked="checked"';?> id="imageflow_auto"/>
            <?php echo $lang_plugin_imageflow['imageflow_no']?> 
        </tr>
        <tr>
          <td width="50%" align="right">
            <?php echo $lang_plugin_imageflow['imageflow_autotime']?>&nbsp;&nbsp;
          </td>
          <td width="50%">
            <input id="imageflow_autotime" name="imageflow_autotime" type="int" value="<?php echo $IMAGEFLOWSET['imageflow_autotime']?>">
          </td>
        </tr>        
        <tr>
          <td align="right">
          	<?php echo $lang_plugin_imageflow['imageflow_usewheel']?>&nbsp;&nbsp;</td>
          <td><input name="imageflow_usewheel" type="radio" value="1" <?php if($IMAGEFLOWSET['imageflow_usewheel']) echo 'checked="checked"';?> id="imageflow_usewheel"/>
            <?php echo $lang_plugin_imageflow['imageflow_yes']?>
            <input name="imageflow_usewheel" type="radio" value="0" <?php if(!$IMAGEFLOWSET['imageflow_usewheel']) echo 'checked="checked"';?> id="imageflow_usewheel"/>
            <?php echo $lang_plugin_imageflow['imageflow_no']?> 
        </tr>
        <tr>
          <td align="right">
          	<?php echo $lang_plugin_imageflow['imageflow_usekeys']?>&nbsp;&nbsp;</td>
          <td><input name="imageflow_usekeys" type="radio" value="1" <?php if($IMAGEFLOWSET['imageflow_usekeys']) echo 'checked="checked"';?> id="imageflow_usekeys"/>
            <?php echo $lang_plugin_imageflow['imageflow_yes']?>
            <input name="imageflow_usekeys" type="radio" value="0" <?php if(!$IMAGEFLOWSET['imageflow_usekeys']) echo 'checked="checked"';?> id="imageflow_usekeys"/>
            <?php echo $lang_plugin_imageflow['imageflow_no']?> 
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


?>