<?php
/**************************************************
  Coppermine 1.5.x Plugin - Slider
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
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


require_once('include/init.inc.php');
require('./plugins/slider/include/init.inc.php');


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

pageheader($lang_plugin_slider['display_name']);
if ($slider_superCage->post->keyExists('update')) {
  $slider_width = $slider_superCage->post->getInt('slider_width');
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
  if($slider_numberofpics != strval(intval($slider_numberofpics))) $slider_numberofpics = 15;
  if($slider_numberofpics < 8) $slider_numberofpics = 8;
  if($slider_speed != strval(intval($slider_speed))) $slider_speed = 1;
  if (($slider_speed > 10) || ($slider_speed < 1)) $slider_speed = 1;
  
  $s="UPDATE `{$CONFIG['TABLE_PREFIX']}plugin_slider` SET slider_pictype=('$slider_pictype'), slider_autowidth=($slider_autowidth), slider_useenlarge=($slider_useenlarge), slider_album=('$slider_album'), slider_width=($slider_width), slider_numberofpics=($slider_numberofpics), slider_speed=($slider_speed), slider_bgcolor=('$slider_bgcolor'), slider_skipportrait=($slider_skipportrait), slider_align=('$slider_align')";
  cpg_db_query($s); 
  msg_box($lang_plugin_slider['display_name'], $lang_plugin_slider['update_success']);
}

require('./plugins/slider/include/load_sliderset.php');

starttable('100%', $lang_plugin_slider['main_title'].' - Version '.$lang_plugin_slider['version']);
?>

<TR>
  <TD class=tableh2 colSpan=3><?php echo $lang_plugin_slider['main_title']?></TD>
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
          <td align="right">
          	<?php echo $lang_plugin_slider['slider_autowidth']?>&nbsp;&nbsp;</td>
          <td><input name="slider_autowidth" type="radio" value="1" <?php if($SLIDERSET['slider_autowidth']) echo 'checked="checked"';?> id="slider_autowidth"/>
            <?php echo $lang_plugin_slider['slider_yes']?>
            <input name="slider_autowidth" type="radio" value="0" <?php if(!$SLIDERSET['slider_autowidth']) echo 'checked="checked"';?> id="slider_autowidth"/>
            <?php echo $lang_plugin_slider['slider_no']?> 
        </tr>
        <tr>
        </tr>
        <tr>
          <td width="50%" align="right">
            <?php echo $lang_plugin_slider['slider_numberofpics']?> (10-30)&nbsp;&nbsp;
          </td>
          <td width="50%">
          	<select name="slider_numberofpics" id="slider_numberofpics">
          	<?php for($i = 10; $i < 31; $i++)
          	{
          	  echo '<option value="'.$i.'" ';
          	  if($SLIDERSET['slider_numberofpics'] == $i) echo 'selected="selected" ';
          	  echo '>'.$i.'</option>';
          	} ?>
          </select>
          </td>
        </tr>
        <tr>
          <td align="right">
          	<?php echo $lang_plugin_slider['slider_speed']?>&nbsp;&nbsp;</td>
          <td><input name="slider_speed" type="radio" value="1" <?php if($SLIDERSET['slider_speed'] == 1) echo 'checked="checked"';?> id="slider_speed"/>
            1
            <input name="slider_speed" type="radio" value="2" <?php if($SLIDERSET['slider_speed'] == 2) echo 'checked="checked"';?> id="slider_speed"/>
            2
            <input name="slider_speed" type="radio" value="3" <?php if($SLIDERSET['slider_speed'] == 3) echo 'checked="checked"';?> id="slider_speed"/>
            3
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
          <td align="right">
          	<?php echo $lang_plugin_slider['align']?>&nbsp;&nbsp;</td>
          <td><input name="slider_align" type="radio" value="left" <?php if($SLIDERSET['slider_align'] == 'left') echo 'checked="checked"';?> id="slider_align"/>
            <?php echo $lang_plugin_slider['left']?>
            <input name="slider_align" type="radio" value="center" <?php if($SLIDERSET['slider_align'] == 'center') echo 'checked="checked"';?> id="slider_align"/>
            <?php echo $lang_plugin_slider['center']?> 
            <input name="slider_align" type="radio" value="right" <?php if($SLIDERSET['slider_align'] == 'right') echo 'checked="checked"';?> id="slider_align"/>
            <?php echo $lang_plugin_slider['right']?> 
        </tr>
        <tr>
          <td align="right">
          	<?php echo $lang_plugin_slider['useenlarge']?>&nbsp;&nbsp;</td>
          <td><input name="slider_useenlarge" type="radio" value="1" <?php if($SLIDERSET['slider_useenlarge']) echo 'checked="checked"';?> id="slider_useenlarge"/>
            <?php echo $lang_plugin_slider['slider_yes']?>
            <input name="slider_useenlarge" type="radio" value="0" <?php if(!$SLIDERSET['slider_useenlarge']) echo 'checked="checked"';?> id="slider_useenlarge"/>
            <?php echo $lang_plugin_slider['slider_no']?> 
        </tr>

        <tr>
          <td align="right">
          	<?php echo $lang_plugin_slider['pictype']?>&nbsp;&nbsp;</td>
          <td><input name="slider_pictype" type="radio" value="normal" <?php if($SLIDERSET['slider_pictype'] == 'normal') echo 'checked="checked"';?> id="slider_pictype"/>
            <?php echo $lang_plugin_slider['slider_normalsize']?>
            <input name="slider_pictype" type="radio" value="fullsize" <?php if($SLIDERSET['slider_pictype'] == 'fullsize') echo 'checked="checked"';?> id="slider_pictype"/>
            <?php echo $lang_plugin_slider['slider_fullsize']?> 
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