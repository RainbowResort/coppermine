<?php
/**************************************************
  Coppermine 1.4.x Plugin - HighSlide v 3.04
  *************************************************
  Copyright (c) 2006-2007 Borzoo Mossavari and Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Skip Intermediate Page and show full page on the page
  Based on Highslide JS @ http://vikjavev.no/highslide/ 
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
if(isset($_POST['update'])){
	$style_mode = $_POST['style_mode'];
	$admin_show = $_POST['admin_show'];
	$detail = $_POST['detail'];
	$close = $_POST['close'];
	$title = $_POST['title'];
	$custom_text = $_POST['title_text'];
	$index_only = $_POST['index_only'];
	$full_image = $_POST['full_image'];
	$sef = $_POST['sef'];
	$force_intermediate = $_POST['force_intermediate'];
	$slide_cnt = $_POST['slide_cnt'];
	$border_color = $_POST['border_color'];
	$details_color = $_POST['details_color'];
	$detailsover_color = $_POST['detailsover_color'];
	$thickness = $_POST['thickness'];
	$expand_steps = $_POST['expand_steps'];
	$expand_duration = $_POST['expand_duration'];
	$restore_steps = $_POST['restore_steps'];
	$restore_duration = $_POST['restore_duration'];
	$caption_slide_speed = $_POST['caption_slide_speed'];
	$allow_multi_inst = $_POST['allow_multi_inst'];
	
	
	/* If selected certain styles, correct other values accordingly */
	if (($style_mode == '1') || ($style_mode > 5)) {
			if ($thickness < 2) {$thickness = 2;}
	}
	if (($style_mode == '4') || ($style_mode == '0')) {
		$thickness = 0;
	}
	if ($style_mode == '5') {
		$border_color = '#2A2B36';
	}
	
	$s="UPDATE `{$CONFIG['TABLE_HIGHSLIDE_CONFIG']}` SET detail={$detail}, close={$close}, title={$title}, admin_show={$admin_show}, style_mod={$style_mode}, ";
	$s.="custom_text='{$custom_text}', index_only={$index_only}, full_image={$full_image}, sef={$sef}, slide_cnt={$slide_cnt}, border_color='{$border_color}', ";
	$s.="details_color='{$details_color}', detailsover_color='{$detailsover_color}', thickness={$thickness}, expand_steps={$expand_steps}, expand_duration={$expand_duration}, ";
	$s.="restore_steps={$restore_steps}, restore_duration={$restore_duration}, caption_slide_speed={$caption_slide_speed}, allow_multi_inst={$allow_multi_inst}";
	cpg_db_query($s);	
    pageheader($lang_plugin_highslide_config['display_name']);
    msg_box($lang_plugin_highslide_config['display_name'], $lang_plugin_highslide_config['page_success'], $lang_continue, 'index.php');
	pagefooter();
        exit;

}
pageheader($lang_plugin_highslide_config['display_name']);
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
starttable('100%', $lang_plugin_highslide_config['main_title'].' - '.$lang_plugin_highslide_config['version'].'<font size=1 color=red> By <a href="http://www.myprj.com">BMossavari at gmail dot com</a> and <a href="http://www.timos-welt.de">Timos-Welt</font>- <a href="pluginmgr.php" class="admin_menu">'.$lang_plugin_highslide_config['pluginmanager'].'</a>', 3);
?>

<TR>
  <TD class=tableh2 colSpan=3 onClick="show_section('section1')"><SPAN style="CURSOR: pointer"><IMG title="<?php echo $lang_plugin_highslide_config['config_title']?>" height=9 alt="" src="images/descending.gif" width=9 border=0> <strong><?php echo $lang_plugin_highslide_config['config_title']?></strong></SPAN> </TD>
</TR>
<TR>
  <td><form action="<?php $_SERVER['PHP_SELF']?>" method="post" name="hs_settings">
      <table class="maintable" cellSpacing="2" cellPadding="2" width="100%" align="<?php echo $align?>" border=0 id="section1">
        <tr>
          <td width="50%">&nbsp;</td>
          <td width="50%">&nbsp;</td>
        </tr>
        <tr>
         <td align="center">
        	<table width="100%" border="0" align="center">
        		<tr>
        			<td width="200" align="center">
        				<?php echo $lang_plugin_highslide_config['Preview']?><br />
        				<table width="100%" bgcolor="#efefef" border="1">
        					<tr>
        						<td width="100%" align="center">
        							<br />
        							<img src="plugins/highslide/graphics/preview/<?php echo $HIGHSLIDESET['style_mod']?>.jpg" border="0" height="147" width="147" name="hs_vorschau"/><br />&nbsp;
        					 </td>
        				 </tr>
        			  </table>
        		  </td>
              <td align="right">
          	    <?php echo $lang_plugin_highslide_config['Style_of_border']?><br /><br />&nbsp;
          	  </td>
          	 </tr>
          	</table>
          </td>
          <td>
          	<select name="style_mode" id="style_mode" onchange="hs_previewchange()">
              <option value="0" <?php if($HIGHSLIDESET['style_mod'] == 0) echo 'selected="selected"'?> ><?php echo $lang_plugin_highslide_config['Nbshadow']?></option>
              <option value="1" <?php if($HIGHSLIDESET['style_mod'] == 1) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Wrob']?></option>
              <option value="6" <?php if($HIGHSLIDESET['style_mod'] == 6) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Rlightgray']?></option>
              <option value="7" <?php if($HIGHSLIDESET['style_mod'] == 7) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Rmediumgray']?></option>
              <option value="8" <?php if($HIGHSLIDESET['style_mod'] == 8) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Rdarkgray']?></option>
              <option value="9" <?php if($HIGHSLIDESET['style_mod'] == 9) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Rblack']?></option>
              <option value="10" <?php if($HIGHSLIDESET['style_mod'] == 10) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Rroyalblue']?></option>
              <option value="11" <?php if($HIGHSLIDESET['style_mod'] == 11) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Rdarkblue']?></option>
              <option value="12" <?php if($HIGHSLIDESET['style_mod'] == 12) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Rlightgreen']?></option>
              <option value="13" <?php if($HIGHSLIDESET['style_mod'] == 13) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Rdarkgreen']?></option>
              <option value="14" <?php if($HIGHSLIDESET['style_mod'] == 14) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Rlightred']?></option>
              <option value="15" <?php if($HIGHSLIDESET['style_mod'] == 15) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Rdarkred']?></option>
              <option value="16" <?php if($HIGHSLIDESET['style_mod'] == 16) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Rorange']?></option>
              <option value="17" <?php if($HIGHSLIDESET['style_mod'] == 17) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Rcyan']?></option>
              <option value="5" <?php if($HIGHSLIDESET['style_mod'] == 5) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Beveled']?></option>
              <option value="2" <?php if($HIGHSLIDESET['style_mod'] == 2) echo 'selected="selected"'?>><?php echo $lang_plugin_highslide_config['W10b']?></option>
              <option value="3" <?php if($HIGHSLIDESET['style_mod'] == 3) echo 'selected="selected"'?>><?php echo $lang_plugin_highslide_config['Ogb']?></option>
              <option value="4" <?php if($HIGHSLIDESET['style_mod'] == 4) echo 'selected="selected"'?> ><?php echo $lang_plugin_highslide_config['Nb']?></option>
            </select>
            <br /><br /><?php echo $lang_plugin_highslide_config['StyleNote']?><br />
            <?php echo $lang_plugin_highslide_config['StyleNote2']?><br />
          </td>
        </tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_highslide_config['thickness']?></td>
        	<td><select name="thickness" id="thickness" size=>
              <option value="0" <?php if($HIGHSLIDESET['thickness'] == 0) echo 'selected="selected"';?>><?php echo '0px'?></option>
        		  <option value="1" <?php if($HIGHSLIDESET['thickness'] == 1) echo 'selected="selected"';?>><?php echo '1px'?></option>
        		  <option value="2" <?php if($HIGHSLIDESET['thickness'] == 2) echo 'selected="selected"';?>><?php echo '2px'?></option>
        		  <option value="3" <?php if($HIGHSLIDESET['thickness'] == 3) echo 'selected="selected"';?>><?php echo '3px'?></option>
        		  <option value="4" <?php if($HIGHSLIDESET['thickness'] == 4) echo 'selected="selected"';?>><?php echo '4px'?></option>
        		  <option value="5" <?php if($HIGHSLIDESET['thickness'] == 5) echo 'selected="selected"';?>><?php echo '5px'?></option>
        		  <option value="6" <?php if($HIGHSLIDESET['thickness'] == 6) echo 'selected="selected"';?>><?php echo '6px'?></option>
        		  <option value="7" <?php if($HIGHSLIDESET['thickness'] == 7) echo 'selected="selected"';?>><?php echo '7px'?></option>
        		  <option value="8" <?php if($HIGHSLIDESET['thickness'] == 8) echo 'selected="selected"';?>><?php echo '8px'?></option>
        		  <option value="9" <?php if($HIGHSLIDESET['thickness'] == 9) echo 'selected="selected"';?>><?php echo '9px'?></option>
        		  <option value="10" <?php if($HIGHSLIDESET['thickness'] == 10) echo 'selected="selected"';?>><?php echo '10px'?></option>
        		  <option value="11" <?php if($HIGHSLIDESET['thickness'] == 11) echo 'selected="selected"';?>><?php echo '11px'?></option>
        		  <option value="12" <?php if($HIGHSLIDESET['thickness'] == 12) echo 'selected="selected"';?>><?php echo '12px'?></option>
        		  <option value="13" <?php if($HIGHSLIDESET['thickness'] == 13) echo 'selected="selected"';?>><?php echo '13px'?></option>
        		  <option value="14" <?php if($HIGHSLIDESET['thickness'] == 14) echo 'selected="selected"';?>><?php echo '14px'?></option>
        		  <option value="15" <?php if($HIGHSLIDESET['thickness'] == 15) echo 'selected="selected"';?>><?php echo '15px'?></option>
        		  <option value="16" <?php if($HIGHSLIDESET['thickness'] == 16) echo 'selected="selected"';?>><?php echo '16px'?></option>
        		  <option value="17" <?php if($HIGHSLIDESET['thickness'] == 17) echo 'selected="selected"';?>><?php echo '17px'?></option>
        		  <option value="18" <?php if($HIGHSLIDESET['thickness'] == 18) echo 'selected="selected"';?>><?php echo '18px'?></option>
        		  <option value="19" <?php if($HIGHSLIDESET['thickness'] == 19) echo 'selected="selected"';?>><?php echo '19px'?></option>
        		  <option value="20" <?php if($HIGHSLIDESET['thickness'] == 20) echo 'selected="selected"';?>><?php echo '20px'?></option>
        		</select>
        	</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="left"><br /><input name="Submit" type="submit" value="Speichern" /></td>
        </tr>
        <tr><td><hr /></td><td><hr /></td></tr>
        <tr>
        	<td></td>
        	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang_plugin_highslide_config['border_color']?><br />
        	 <input name="border_color" type="text" class="color" value="<?php echo $HIGHSLIDESET['border_color']?>" id="border_color" />
        	</td>
        </tr>
        <tr><td></td><td><hr /></td></tr>
        <tr>
        	<td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang_plugin_highslide_config['details_color']?><br />
           <input name="details_color" type="text" class="color" value="<?php echo $HIGHSLIDESET['details_color']?>" id="details_color" />
         	</td>
        </tr>
        <tr><td></td><td><hr /></td></tr>
        <tr>
        	<td></td>
        	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang_plugin_highslide_config['detailsover_color']?><br />
        	 <input name="detailsover_color" type="text" class="color" value="<?php echo $HIGHSLIDESET['detailsover_color']?>" id="detailsover_color" />
        	</td>
        </tr>
        <tr><td><hr /></td><td><hr /></td></tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_highslide_config['expand_steps']?></td>
        	<td><select name="expand_steps" id="expand_steps">
        		  <option value="6" <?php if($HIGHSLIDESET['expand_steps'] == 6) echo 'selected="selected"';?>><?php echo '6'?></option>
        		  <option value="8" <?php if($HIGHSLIDESET['expand_steps'] == 8) echo 'selected="selected"';?>><?php echo '8'?></option>
        		  <option value="10" <?php if($HIGHSLIDESET['expand_steps'] == 10) echo 'selected="selected"';?>><?php echo '10'?></option>
        		  <option value="12" <?php if($HIGHSLIDESET['expand_steps'] == 12) echo 'selected="selected"';?>><?php echo '12'?></option>
        		  <option value="14" <?php if($HIGHSLIDESET['expand_steps'] == 14) echo 'selected="selected"';?>><?php echo '14'?></option>
        		  <option value="16" <?php if($HIGHSLIDESET['expand_steps'] == 16) echo 'selected="selected"';?>><?php echo '16'?></option>
        		  <option value="18" <?php if($HIGHSLIDESET['expand_steps'] == 18) echo 'selected="selected"';?>><?php echo '18'?></option>
        		  <option value="20" <?php if($HIGHSLIDESET['expand_steps'] == 20) echo 'selected="selected"';?>><?php echo '20'?></option>
        		  <option value="22" <?php if($HIGHSLIDESET['expand_steps'] == 22) echo 'selected="selected"';?>><?php echo '22'?></option>
        		  <option value="24" <?php if($HIGHSLIDESET['expand_steps'] == 24) echo 'selected="selected"';?>><?php echo '24'?></option>
        		  <option value="26" <?php if($HIGHSLIDESET['expand_steps'] == 26) echo 'selected="selected"';?>><?php echo '26'?></option>
        		  <option value="28" <?php if($HIGHSLIDESET['expand_steps'] == 28) echo 'selected="selected"';?>><?php echo '28'?></option>
        		  <option value="30" <?php if($HIGHSLIDESET['expand_steps'] == 30) echo 'selected="selected"';?>><?php echo '30'?></option>
        		  <option value="35" <?php if($HIGHSLIDESET['expand_steps'] == 35) echo 'selected="selected"';?>><?php echo '35'?></option>
        		  <option value="40" <?php if($HIGHSLIDESET['expand_steps'] == 40) echo 'selected="selected"';?>><?php echo '40'?></option>
              <option value="45" <?php if($HIGHSLIDESET['expand_steps'] == 45) echo 'selected="selected"';?>><?php echo '45'?></option>
        		  <option value="50" <?php if($HIGHSLIDESET['expand_steps'] == 50) echo 'selected="selected"';?>><?php echo '50'?></option>
        		</select>
        	</td>
        </tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_highslide_config['expand_duration']?></td>
        	<td><select name="expand_duration" id="expand_duration">
        		  <option value="80" <?php if($HIGHSLIDESET['expand_duration'] == 80) echo 'selected="selected"';?>><?php echo '80'?></option>
        		  <option value="100" <?php if($HIGHSLIDESET['expand_duration'] == 100) echo 'selected="selected"';?>><?php echo '100'?></option>
        		  <option value="120" <?php if($HIGHSLIDESET['expand_duration'] == 120) echo 'selected="selected"';?>><?php echo '120'?></option>
        		  <option value="140" <?php if($HIGHSLIDESET['expand_duration'] == 140) echo 'selected="selected"';?>><?php echo '140'?></option>
        		  <option value="160" <?php if($HIGHSLIDESET['expand_duration'] == 160) echo 'selected="selected"';?>><?php echo '160'?></option>
        		  <option value="180" <?php if($HIGHSLIDESET['expand_duration'] == 180) echo 'selected="selected"';?>><?php echo '180'?></option>
        		  <option value="200" <?php if($HIGHSLIDESET['expand_duration'] == 200) echo 'selected="selected"';?>><?php echo '200'?></option>
        		  <option value="220" <?php if($HIGHSLIDESET['expand_duration'] == 220) echo 'selected="selected"';?>><?php echo '220'?></option>
        		  <option value="250" <?php if($HIGHSLIDESET['expand_duration'] == 250) echo 'selected="selected"';?>><?php echo '250'?></option>
        		  <option value="300" <?php if($HIGHSLIDESET['expand_duration'] == 300) echo 'selected="selected"';?>><?php echo '300'?></option>
        		  <option value="350" <?php if($HIGHSLIDESET['expand_duration'] == 350) echo 'selected="selected"';?>><?php echo '350'?></option>
        		  <option value="400" <?php if($HIGHSLIDESET['expand_duration'] == 400) echo 'selected="selected"';?>><?php echo '400'?></option>
        		  <option value="500" <?php if($HIGHSLIDESET['expand_duration'] == 500) echo 'selected="selected"';?>><?php echo '500'?></option>
        		  <option value="750" <?php if($HIGHSLIDESET['expand_duration'] == 750) echo 'selected="selected"';?>><?php echo '750'?></option>
        		  <option value="1000" <?php if($HIGHSLIDESET['expand_duration'] == 1000) echo 'selected="selected"';?>><?php echo '1000'?></option>
        		</select>
        	</td>
        </tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_highslide_config['restore_steps']?></td>
        	<td><select name="restore_steps" id="restore_steps">
        		  <option value="6" <?php if($HIGHSLIDESET['restore_steps'] == 6) echo 'selected="selected"';?>><?php echo '6'?></option>
        		  <option value="8" <?php if($HIGHSLIDESET['restore_steps'] == 8) echo 'selected="selected"';?>><?php echo '8'?></option>
        		  <option value="10" <?php if($HIGHSLIDESET['restore_steps'] == 10) echo 'selected="selected"';?>><?php echo '10'?></option>
        		  <option value="12" <?php if($HIGHSLIDESET['restore_steps'] == 12) echo 'selected="selected"';?>><?php echo '12'?></option>
        		  <option value="14" <?php if($HIGHSLIDESET['restore_steps'] == 14) echo 'selected="selected"';?>><?php echo '14'?></option>
        		  <option value="16" <?php if($HIGHSLIDESET['restore_steps'] == 16) echo 'selected="selected"';?>><?php echo '16'?></option>
        		  <option value="18" <?php if($HIGHSLIDESET['restore_steps'] == 18) echo 'selected="selected"';?>><?php echo '18'?></option>
        		  <option value="20" <?php if($HIGHSLIDESET['restore_steps'] == 20) echo 'selected="selected"';?>><?php echo '20'?></option>
        		  <option value="22" <?php if($HIGHSLIDESET['restore_steps'] == 22) echo 'selected="selected"';?>><?php echo '22'?></option>
        		  <option value="24" <?php if($HIGHSLIDESET['restore_steps'] == 24) echo 'selected="selected"';?>><?php echo '24'?></option>
        		  <option value="26" <?php if($HIGHSLIDESET['restore_steps'] == 26) echo 'selected="selected"';?>><?php echo '26'?></option>
        		  <option value="28" <?php if($HIGHSLIDESET['restore_steps'] == 28) echo 'selected="selected"';?>><?php echo '28'?></option>
        		  <option value="30" <?php if($HIGHSLIDESET['restore_steps'] == 30) echo 'selected="selected"';?>><?php echo '30'?></option>
        		  <option value="35" <?php if($HIGHSLIDESET['restore_steps'] == 35) echo 'selected="selected"';?>><?php echo '35'?></option>
        		  <option value="40" <?php if($HIGHSLIDESET['restore_steps'] == 40) echo 'selected="selected"';?>><?php echo '40'?></option>
              <option value="45" <?php if($HIGHSLIDESET['restore_steps'] == 45) echo 'selected="selected"';?>><?php echo '45'?></option>
        		  <option value="50" <?php if($HIGHSLIDESET['restore_steps'] == 50) echo 'selected="selected"';?>><?php echo '50'?></option>
        		</select>
        	</td>
        </tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_highslide_config['restore_duration']?></td>
        	<td><select name="restore_duration" id="restore_duration">
        		  <option value="80" <?php if($HIGHSLIDESET['restore_duration'] == 80) echo 'selected="selected"';?>><?php echo '80'?></option>
        		  <option value="100" <?php if($HIGHSLIDESET['restore_duration'] == 100) echo 'selected="selected"';?>><?php echo '100'?></option>
        		  <option value="120" <?php if($HIGHSLIDESET['restore_duration'] == 120) echo 'selected="selected"';?>><?php echo '120'?></option>
        		  <option value="140" <?php if($HIGHSLIDESET['restore_duration'] == 140) echo 'selected="selected"';?>><?php echo '140'?></option>
        		  <option value="160" <?php if($HIGHSLIDESET['restore_duration'] == 160) echo 'selected="selected"';?>><?php echo '160'?></option>
        		  <option value="180" <?php if($HIGHSLIDESET['restore_duration'] == 180) echo 'selected="selected"';?>><?php echo '180'?></option>
        		  <option value="200" <?php if($HIGHSLIDESET['restore_duration'] == 200) echo 'selected="selected"';?>><?php echo '200'?></option>
        		  <option value="220" <?php if($HIGHSLIDESET['restore_duration'] == 220) echo 'selected="selected"';?>><?php echo '220'?></option>
        		  <option value="250" <?php if($HIGHSLIDESET['restore_duration'] == 250) echo 'selected="selected"';?>><?php echo '250'?></option>
        		  <option value="300" <?php if($HIGHSLIDESET['restore_duration'] == 300) echo 'selected="selected"';?>><?php echo '300'?></option>
        		  <option value="350" <?php if($HIGHSLIDESET['restore_duration'] == 350) echo 'selected="selected"';?>><?php echo '350'?></option>
        		  <option value="400" <?php if($HIGHSLIDESET['restore_duration'] == 400) echo 'selected="selected"';?>><?php echo '400'?></option>
        		  <option value="500" <?php if($HIGHSLIDESET['restore_duration'] == 500) echo 'selected="selected"';?>><?php echo '500'?></option>
        		  <option value="750" <?php if($HIGHSLIDESET['restore_duration'] == 750) echo 'selected="selected"';?>><?php echo '750'?></option>
        		  <option value="1000" <?php if($HIGHSLIDESET['restore_duration'] == 1000) echo 'selected="selected"';?>><?php echo '1000'?></option>
        		</select>
        	</td>
        </tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_highslide_config['caption_slide_speed']?></td>
        	<td><select name="caption_slide_speed" id="caption_slide_speed">
        		  <option value="1" <?php if($HIGHSLIDESET['caption_slide_speed'] == 1) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Slowest']?></option>
        		  <option value="2" <?php if($HIGHSLIDESET['caption_slide_speed'] == 2) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Slower']?></option>
        		  <option value="3" <?php if($HIGHSLIDESET['caption_slide_speed'] == 3) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Slow']?></option>
        		  <option value="4" <?php if($HIGHSLIDESET['caption_slide_speed'] == 4) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Fast']?></option>
        		  <option value="5" <?php if($HIGHSLIDESET['caption_slide_speed'] == 5) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Faster']?></option>
        		  <option value="10" <?php if($HIGHSLIDESET['caption_slide_speed'] == 10) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Fastest']?></option>
        		  <option value="0" <?php if($HIGHSLIDESET['caption_slide_speed'] == 0) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['RightNow']?></option>
        		</select>
        	</td>
        </tr>
        <tr>
        	<td align="right"><?php echo $lang_plugin_highslide_config['allow_multi_inst']?></td>
        	<td><select name="allow_multi_inst" id="allow_multi_inst">
        		  <option value="0" <?php if($HIGHSLIDESET['allow_multi_inst'] == 0) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['No']?></option>
        		  <option value="1" <?php if($HIGHSLIDESET['allow_multi_inst'] == 1) echo 'selected="selected"';?>><?php echo $lang_plugin_highslide_config['Yes']?></option>
          		</select>
        	</td>
        </tr>
        <tr>
          <td align="right"><?php echo $lang_plugin_highslide_config['Link_To_intermadiate']?></td>
          <td><input name="detail" type="radio" value="1" <?php if($HIGHSLIDESET['detail']) echo 'checked="checked"';?> id="detail"/>
            <?php echo $lang_plugin_highslide_config['Yes']?>
            <input name="detail" type="radio" value="0" <?php if(!$HIGHSLIDESET['detail']) echo 'checked="checked"';?> id="detail"/>
            <?php echo $lang_plugin_highslide_config['No']?></td>
        </tr>
        <tr>
          <td align="right"><?php echo $lang_plugin_highslide_config['Link_for_Closing']?></td>
          <td><input name="close" type="radio" value="1" <?php if($HIGHSLIDESET['close']) echo 'checked="checked"';?> id="close"/>
            <?php echo $lang_plugin_highslide_config['Yes']?>
            <input name="close" type="radio" value="0" <?php if(!$HIGHSLIDESET['close']) echo 'checked="checked"';?> id="close"/>
            <?php echo $lang_plugin_highslide_config['No']?> 
        </tr>
        <tr>
          <td align="right"><?php echo $lang_plugin_highslide_config['Dispaly_Title_Caption']?></td>
          <td><input name="title" type="radio" value="1" <?php if($HIGHSLIDESET['title']) echo 'checked="checked"';?> id="radio"/>
            <?php echo $lang_plugin_highslide_config['Yes']?>
            <input name="title" type="radio" value="0" <?php if(!$HIGHSLIDESET['title']) echo 'checked="checked"';?> id="radio"/>
            <?php echo $lang_plugin_highslide_config['No']?></td>
        </tr><tr><td><hr /></td></tr>
        <tr>
          <td align="right"><?php echo $lang_plugin_highslide_config['enable_sef']?></td>
          <td><input name="sef" type="radio" value="1" <?php if($HIGHSLIDESET['sef']) echo 'checked="checked"';?> id="sef"/>
            <?php echo $lang_plugin_highslide_config['Yes']?>
            <input name="sef" type="radio" value="0" <?php if(!$HIGHSLIDESET['sef']) echo 'checked="checked"';?> id="sef"/>
            <?php echo $lang_plugin_highslide_config['No']?> 
        </tr>
        <tr>
          <td align="right"><?php echo $lang_plugin_highslide_config['Disable_Admin_Mode']?></td>
          <td><input name="admin_show" type="radio" value="1" <?php if($HIGHSLIDESET['admin_show']) echo 'checked="checked"';?> id="admin_show"/>
            <?php echo $lang_plugin_highslide_config['Yes']?>
            <input name="admin_show" type="radio" value="0" <?php if(!$HIGHSLIDESET['admin_show']) echo 'checked="checked"';?> id="admin_show"/>
            <?php echo $lang_plugin_highslide_config['No']?></td>
        </tr>
        <tr>
          <td align="right"><?php echo $lang_plugin_highslide_config['Aimao']?></td>
          <td><input name="index_only" type="radio" value="1" <?php if($HIGHSLIDESET['index_only']) echo 'checked="checked"';?> />
            <?php echo $lang_plugin_highslide_config['apply_to_index']?>
            <input name="index_only" type="radio" value="0" <?php if(!$HIGHSLIDESET['index_only']) echo 'checked="checked"';?>/>
            <?php echo $lang_plugin_highslide_config['apply_to_all']?> </td>
        </tr>
        <tr>
          <td align="right"><?php echo $lang_plugin_highslide_config['SFIuSIi']?></td>
          <td>&nbsp;<br /><input name="full_image" type="radio" value="1" <?php if($HIGHSLIDESET['full_image']==1) echo 'checked="checked"';?> id="full_image"/>
            <?php echo $lang_plugin_highslide_config['full_image']?><br />
            <input name="full_image" type="radio" value="0" <?php if(!$HIGHSLIDESET['full_image']) echo 'checked="checked"';?> id="full_image"/>
            <?php echo $lang_plugin_highslide_config['intermadiate']?><br />
            <input name="full_image" type="radio" value="2" <?php if($HIGHSLIDESET['full_image']==2) echo 'checked="checked"';?> id="full_image"/>
            <?php echo $lang_plugin_highslide_config['force_intermadiate']?><br />&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><?php echo $lang_plugin_highslide_config['slide_cnt']?></td>
          <td>
            <input name="slide_cnt" type="radio" value="1" <?php if($HIGHSLIDESET['slide_cnt']) echo 'checked="checked"';?> id="slide_cnt"/>
            <?php echo $lang_plugin_highslide_config['Yes']?>
            <input name="slide_cnt" type="radio" value="0" <?php if(!$HIGHSLIDESET['slide_cnt']) echo 'checked="checked"';?> id="slide_cnt"/>
            <?php echo $lang_plugin_highslide_config['No']?></td>
        </tr>
          <tr>
          <td align="right">&nbsp;</td>
          <td><textarea name="custom_text" cols="0" rows="0" id="custom_text" disabled="disabled"><?php if($HIGHSLIDESET['custom_text'] != '') echo $HIGHSLIDESET['custom_text'];?>
</textarea></td>
        </tr> 
        <tr>
          <td>&nbsp;</td>
          <td>
            <input name="update" type="hidden" id="update" value="1" /></td>
        </tr>  
        <tr>
          <td>&nbsp;</td>
          <td align="left"><input name="Submit" type="submit" value="<?php echo $lang_plugin_highslide_install['button_submit']?>" /></td>
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