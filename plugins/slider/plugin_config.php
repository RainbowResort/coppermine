<?php
/**************************************************
  Coppermine 1.5.x Plugin - Slider $VERSION$=0.2
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ***************************************************/


require_once('include/init.inc.php');
require('./plugins/slider/include/init.inc.php');
require('./plugins/slider/include/load_sliderset.php');

$slider_superCage = Inspekt::makeSuperCage();

global $CONFIG,$lang_plugin_slider;
if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
if($lang_text_dir=='ltr') {
  $align="left";
  $direction="ltr";
}else {
  $align="right";
  $direction="rtl";
}
if ($slider_superCage->post->keyExists('update')) {
  $slider_width = $slider_superCage->post->getInt('slider_width');
  $slider_height = $slider_superCage->post->getInt('slider_height');
  $slider_numberofpics = $slider_superCage->post->getInt('slider_numberofpics');
  $slider_speed = $slider_superCage->post->getInt('slider_speed');
  if ($enl_matches = $slider_superCage->post->getMatched('slider_bgcolor','/^[a-zA-Z0-9#]+$/'))
  {
    $slider_bgcolor = $enl_matches[0];
  }
  else
  {
  	$slider_bgcolor = '';
  }
  $slider_album = $slider_superCage->post->getAlnum('slider_album');
  $slider_skipportrait = $slider_superCage->post->getInt('slider_skipportrait');
  $slider_align = $slider_superCage->post->getAlnum('slider_align');
  $slider_useenlarge = $slider_superCage->post->getInt('slider_useenlarge');
  $slider_pictype = $slider_superCage->post->getAlnum('slider_pictype');
  $slider_autowidth = $slider_superCage->post->getInt('slider_autowidth');

  
  // if someone types text into a number input field, set default value
  if($slider_width != strval(intval($slider_width))) $slider_width = 800;
  if($slider_height != strval(intval($slider_height))) $slider_height = 55;
  if($slider_numberofpics != strval(intval($slider_numberofpics))) $slider_numberofpics = 15;
  if($slider_numberofpics < 8) $slider_numberofpics = 8;
  if($slider_speed != strval(intval($slider_speed))) $slider_speed = 1;
  if (($slider_speed > 10) || ($slider_speed < 1)) $slider_speed = 1;
  
  $s="UPDATE `{$CONFIG['TABLE_PREFIX']}mod_slider` SET slider_pictype=('$slider_pictype'), slider_autowidth=($slider_autowidth), slider_useenlarge=($slider_useenlarge), slider_album=('$slider_album'), slider_width=($slider_width), slider_height=($slider_height), slider_numberofpics=($slider_numberofpics), slider_speed=($slider_speed), slider_bgcolor=('$slider_bgcolor'), slider_skipportrait=($slider_skipportrait), slider_align=('$slider_align')";
  cpg_db_query($s); 
    pageheader($lang_plugin_slider['display_name']);
    msg_box($lang_plugin_slider['display_name'], $lang_plugin_slider['update_success'], $lang_common['continue'], 'pluginmgr.php');
  pagefooter();
        exit;

}
pageheader($lang_plugin_slider['display_name']);
?>


<?php
starttable('100%', $lang_plugin_slider['main_title'].' - '.$lang_plugin_slider['version'].'<font size=1 color=red> by <a href="http://www.timos-welt.de">Timos-Welt</font>', 3);
?>

<TR>
  <TD class=tableh2 colSpan=3 onClick="show_section('section1')"><SPAN style="CURSOR: pointer"><IMG title="Config" height=9 alt="" src="images/descending.gif" width=9 border=0> <strong><?php echo $lang_plugin_slider['main_title']?></strong></SPAN> </TD>
</TR>
<TR>
  <td><form action="<?php $_SERVER['PHP_SELF']?>" method="post" name="slider_settings">
      <table class="maintable" cellSpacing="2" cellPadding="2" width="100%" align="<?php echo $align?>" border=0 id="section1">
        <tr>
          <td width="50%">&nbsp;</td>
          <td width="50%">&nbsp;</td>
        </tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_slider['album']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="slider_album" id="slider_album">
                 <option value="random" <?php if($SLIDERSET['slider_album'] == "random") echo 'selected="selected"';?>><?php echo $lang_meta_album_names['random']?></option>
                 <option value="lastup" <?php if($SLIDERSET['slider_album'] == "lastup") echo 'selected="selected"';?>><?php echo $lang_meta_album_names['lastup']?></option>
                 <option value="topn" <?php if($SLIDERSET['slider_album'] == "topn") echo 'selected="selected"';?>><?php echo $lang_meta_album_names['topn']?></option>
                 <option value="toprated" <?php if($SLIDERSET['slider_album'] == "toprated") echo 'selected="selected"';?>><?php echo $lang_meta_album_names['toprated']?></option>
              </select>
          </td>
        </tr>
        <tr>
          <td width="50%" align="right">
            <?php echo $lang_plugin_slider['slider_width']?>&nbsp;&nbsp;
          </td>
          <td width="50%">
            <input id="slider_width" name="slider_width" type="int" value="<?php echo $SLIDERSET['slider_width']?>"> px
          </td>
        </tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_slider['slider_autowidth']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="slider_autowidth" id="slider_autowidth">
                 <option value="1" <?php if($SLIDERSET['slider_autowidth'] == 1) echo 'selected="selected"';?>><?php echo $lang_plugin_slider['slider_yes']?></option>
                 <option value="0" <?php if($SLIDERSET['slider_autowidth'] == 0) echo 'selected="selected"';?>><?php echo $lang_plugin_slider['slider_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
          <td width="50%" align="right">
            <?php echo $lang_plugin_slider['slider_height']?>&nbsp;&nbsp;
          </td>
          <td width="50%">
            <input id="slider_height" name="slider_height" type="int" value="<?php echo $SLIDERSET['slider_height']?>"> px
          </td>
        </tr>
        <tr>
          <td width="50%" align="right">
            <?php echo $lang_plugin_slider['slider_numberofpics']?> (8-30)&nbsp;&nbsp;
          </td>
          <td width="50%">
            <input id="slider_numberofpics" name="slider_numberofpics" type="int" value="<?php echo $SLIDERSET['slider_numberofpics']?>">
          </td>
        </tr>
        <tr>
          <td width="50%" align="right">
            <?php echo $lang_plugin_slider['slider_speed']?>&nbsp;(1-10)&nbsp;&nbsp;
          </td>
          <td width="50%">
            <input id="slider_speed" name="slider_speed" type="int" value="<?php echo $SLIDERSET['slider_speed']?>">
          </td>
        </tr>
        <tr>
          <td width="50%" align="right">
            <?php echo $lang_plugin_slider['slider_bgcolor']?>&nbsp;&nbsp;
          </td>
          <td width="50%">
            <input id="slider_bgcolor" name="slider_bgcolor" value="<?php echo $SLIDERSET['slider_bgcolor']?>">
          </td>
        </tr>
        <tr>
          <td align="right">
          	<?php echo $lang_plugin_slider['skipportrait']?>&nbsp;&nbsp;</td>
          <td><input name="slider_skipportrait" type="radio" value="1" <?php if($SLIDERSET['slider_skipportrait']) echo 'checked="checked"';?> id="slider_skipportrait"/>
            <?php echo $lang_plugin_slider['slider_yes']?>
            <input name="slider_skipportrait" type="radio" value="0" <?php if(!$SLIDERSET['slider_skipportrait']) echo 'checked="checked"';?> id="slider_skipportrait"/>
            <?php echo $lang_plugin_slider['slider_no']?> 
        </tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_slider['align']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="slider_align" id="slider_align">
                 <option value="left" <?php if($SLIDERSET['slider_align'] == 'left') echo 'selected="selected"';?>><?php echo $lang_plugin_slider['left']?></option>
                 <option value="center" <?php if($SLIDERSET['slider_align'] == 'center') echo 'selected="selected"';?>><?php echo $lang_plugin_slider['center']?></option>
                 <option value="right" <?php if($SLIDERSET['slider_align'] == 'right') echo 'selected="selected"';?>><?php echo $lang_plugin_slider['right']?></option>
              </select>
          </td>
        </tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_slider['useenlarge']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="slider_useenlarge" id="slider_useenlarge">
                 <option value="1" <?php if($SLIDERSET['slider_useenlarge'] == 1) echo 'selected="selected"';?>><?php echo $lang_plugin_slider['slider_yes']?></option>
                 <option value="0" <?php if($SLIDERSET['slider_useenlarge'] == 0) echo 'selected="selected"';?>><?php echo $lang_plugin_slider['slider_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
        	<td align="right"><?php echo $lang_plugin_slider['pictype']?>&nbsp;&nbsp;</td>
        	<td>
        		  <select name="slider_pictype" id="slider_pictype">
                 <option value="normal" <?php if($SLIDERSET['slider_pictype'] == 'normal') echo 'selected="selected"';?>><?php echo $lang_plugin_slider['slider_normalsize']?></option>
                 <option value="fullsize" <?php if($SLIDERSET['slider_pictype'] == 'fullsize') echo 'selected="selected"';?>><?php echo $lang_plugin_slider['slider_fullsize']?></option>
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
          <td align="left"><input name="Submit" type="submit" value="<?php echo $lang_plugin_slider['submit_button']?>" /></td>
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