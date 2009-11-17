<?php
/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt! $VERSION$=0.4
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  **************************************************/

require_once('include/init.inc.php');
require('./plugins/enlargeit/include/init.inc.php');
require('./plugins/enlargeit/include/load_enlargeitset.php');

// create Inspekt supercage
$enl_superCage = Inspekt::makeSuperCage();

global $CONFIG,$lang_enlargeit,$lang_meta_album_names;
if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

// text direction
if($lang_text_dir=='ltr') {
  $align="left";
  $direction="ltr";
}else {
  $align="right";
  $direction="rtl";
}

// get sanitized POST parameters
if ($enl_superCage->post->keyExists('update')) {
  $enl_brd = $enl_superCage->post->getInt('enl_brd');
  $enl_brdsize = $enl_superCage->post->getInt('enl_brdsize');
  $enl_brdround = $enl_superCage->post->getInt('enl_brdround');
  // colors can be given as hex value (#ffffff) or clear text (white), so alphanumeric + # is allowed
  if ($enl_matches = $enl_superCage->post->getMatched('enl_brdcolor','/^[a-zA-Z0-9#]+$/'))
  {
    $enl_brdcolor = $enl_matches[0];
  }
  else
  {
  	$enl_brdcolor = '#FFFFFF';
  }
  $enl_shadow = $enl_superCage->post->getInt('enl_shadow');
  $enl_shadowsize = $enl_superCage->post->getInt('enl_shadowsize');
  $enl_shadowintens = $enl_superCage->post->getInt('enl_shadowintens');
  $enl_ani = $enl_superCage->post->getInt('enl_ani');
  $enl_maxstep = $enl_superCage->post->getInt('enl_maxstep');
  $enl_speed = $enl_superCage->post->getInt('enl_speed');
  $enl_titlebar = $enl_superCage->post->getInt('enl_titlebar');
  // colors can be given as hex value (#ffffff) or clear text (white), so alphanumeric + # is allowed
  if ($enl_matches = $enl_superCage->post->getMatched('enl_titletxtcol','/^[a-zA-Z0-9#]+$/'))
  {
    $enl_titletxtcol = $enl_matches[0];
  }
  else
  {
  	$enl_titletxtcol = '#445544';
  }
  // colors can be given as hex value (#ffffff) or clear text (white), so alphanumeric + # is allowed
  if ($enl_matches = $enl_superCage->post->getMatched('enl_ajaxcolor','/^[a-zA-Z0-9#]+$/'))
  {
    $enl_ajaxcolor = $enl_matches[0];
  }
  else
  {
  	$enl_ajaxcolor = '#666677';
  }
  $enl_center = $enl_superCage->post->getInt('enl_center');
  $enl_dark = $enl_superCage->post->getInt('enl_dark');
  $enl_darkprct = $enl_superCage->post->getInt('enl_darkprct');
  $enl_buttonpic = $enl_superCage->post->getInt('enl_buttonpic');
  $enl_buttoninfo = $enl_superCage->post->getInt('enl_buttoninfo');
  $enl_buttonfav = $enl_superCage->post->getInt('enl_buttonfav');
  $enl_buttoncomment = $enl_superCage->post->getInt('enl_buttoncomment');
  $enl_buttonhist = $enl_superCage->post->getInt('enl_buttonhist');
  $enl_buttonvote = $enl_superCage->post->getInt('enl_buttonvote');
  $enl_buttondownload = $enl_superCage->post->getInt('enl_buttondownload');
  $enl_buttonmax = $enl_superCage->post->getInt('enl_buttonmax');
  $enl_buttonclose = $enl_superCage->post->getInt('enl_buttonclose');
  $enl_buttonnav = $enl_superCage->post->getInt('enl_buttonnav');
  $enl_adminmode = $enl_superCage->post->getInt('enl_adminmode');
  $enl_registeredmode = $enl_superCage->post->getInt('enl_registeredmode');
  $enl_guestmode = $enl_superCage->post->getInt('enl_guestmode');
  $enl_pictype = $enl_superCage->post->getInt('enl_pictype');
  $enl_dragdrop = $enl_superCage->post->getInt('enl_dragdrop');
  $enl_darkensteps = $enl_superCage->post->getInt('enl_darkensteps');
  // border background is a filename with underscore and dot
  if ($enl_matches = $enl_superCage->post->getMatched('enl_brdbck','/^[a-zA-Z0-9_\.]+$/'))
  {
    $enl_brdbck = $enl_matches[0];
  }
  else
  {
  	$enl_brdbck = '';
  }
  $enl_opaglide = $enl_superCage->post->getInt('enl_opaglide');
  $enl_wheelnav = $enl_superCage->post->getInt('enl_wheelnav');
  $enl_flvplayer = $enl_superCage->post->getInt('enl_flvplayer');
  $enl_buttonbbcode = $enl_superCage->post->getInt('enl_buttonbbcode');
  
  // build SQL string
  $s="UPDATE `{$CONFIG['TABLE_PREFIX']}plugin_enlargeit` 
      SET enl_pictype='$enl_pictype',
          enl_brd='$enl_brd',
          enl_brdsize='$enl_brdsize',
          enl_brdround='$enl_brdround',
          enl_brdcolor=('$enl_brdcolor'),
          enl_shadow='$enl_shadow',
          enl_shadowsize='$enl_shadowsize',
          enl_shadowintens='$enl_shadowintens',
          enl_ani='$enl_ani',
          enl_maxstep='$enl_maxstep',
          enl_speed='$enl_speed',
          enl_titlebar='$enl_titlebar',
          enl_titletxtcol='$enl_titletxtcol',
          enl_ajaxcolor='$enl_ajaxcolor',
          enl_center='$enl_center',
          enl_dark='$enl_dark',
          enl_darkprct='$enl_darkprct',
          enl_buttonnav='$enl_buttonnav',
          enl_buttonvote='$enl_buttonvote',
          enl_buttondownload='$enl_buttondownload',
          enl_buttonpic='$enl_buttonpic',
          enl_buttoninfo='$enl_buttoninfo',
          enl_buttonfav='$enl_buttonfav',
          enl_buttonclose='$enl_buttonclose',
          enl_buttonmax='$enl_buttonmax',
          enl_buttonhist='$enl_buttonhist',
          enl_buttoncomment='$enl_buttoncomment',
          enl_wheelnav='$enl_wheelnav',
          enl_buttonbbcode='$enl_buttonbbcode',
          enl_adminmode='$enl_adminmode',
          enl_registeredmode='$enl_registeredmode',
          enl_guestmode='$enl_guestmode',
          enl_opaglide='$enl_opaglide',
          enl_dragdrop='$enl_dragdrop',
          enl_darkensteps='$enl_darkensteps',
          enl_brdbck='$enl_brdbck',
          enl_flvplayer='$enl_flvplayer'";
  
  // query database
  cpg_db_query($s); 
  
  
  // success note to user
  pageheader($lang_enlargeit['display_name']);
  msg_box($lang_enlargeit['display_name'], $lang_enlargeit['update_success'], $lang_common['continue'], 'pluginmgr.php');
  pagefooter();
  exit();
}


// no POST variables: display config page
pageheader($lang_enlargeit['display_name']);
starttable('100%', $enlargeit_icon_array['table'] . $lang_enlargeit['main_title'].' by <a href="http://www.timos-welt.de/" rel="external" class="external">Timos-Welt</a>', 3);
?>

<tr>
  <td class=tableh2 colSpan=3 onClick="show_section('section1')"><span style="cursor: pointer"><img title="Config" height=9 alt="" src="images/descending.gif" width=9 border=0> <strong><?php echo $lang_enlargeit['main_title']?></strong></span> </td>
</tr>
<tr>
  <td><form action="<?php $CPG_PHP_SELF ?>" method="post" name="enlargeit_settings">
      <table class="maintable" cellSpacing="2" cellPadding="2" width="100%" align="<?php echo $align?>" border=0 id="section1">
        <tr>
          <td width="50%">&nbsp;</td>
          <td width="50%">&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_pictype']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_pictype" id="enl_pictype">
                 <option value="0" <?php if($ENLARGEITSET['enl_pictype'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_normalsize']?></option>
                 <option value="1" <?php if($ENLARGEITSET['enl_pictype'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_fullsize']?></option>
                 <option value="2" <?php if($ENLARGEITSET['enl_pictype'] == 2) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_forcenormal']?></option>
                 
              </select>
          </td>
        </tr>
        <tr>
          <td><hr /></td><td><hr /></td>
        </tr>
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_ani']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_ani" id="enl_ani">
                 <option value="0" <?php if($ENLARGEITSET['enl_ani'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['noani']?></option>
                 <option value="1" <?php if($ENLARGEITSET['enl_ani'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['fade']?></option>
                 <option value="2" <?php if($ENLARGEITSET['enl_ani'] == 2) echo 'selected="selected"';?>><?php echo $lang_enlargeit['glide']?></option>
                 <option value="3" <?php if($ENLARGEITSET['enl_ani'] == 3) echo 'selected="selected"';?>><?php echo $lang_enlargeit['bumpglide']?></option>
                 <option value="4" <?php if($ENLARGEITSET['enl_ani'] == 4) echo 'selected="selected"';?>><?php echo $lang_enlargeit['smoothglide']?></option>
                 <option value="5" <?php if($ENLARGEITSET['enl_ani'] == 5) echo 'selected="selected"';?>><?php echo $lang_enlargeit['expglide']?></option>
                 <option value="6" <?php if($ENLARGEITSET['enl_ani'] == 6) echo 'selected="selected"';?>><?php echo $lang_enlargeit['topglide']?></option>
                 <option value="7" <?php if($ENLARGEITSET['enl_ani'] == 7) echo 'selected="selected"';?>><?php echo $lang_enlargeit['leftglide']?></option>
                 <option value="8" <?php if($ENLARGEITSET['enl_ani'] == 8) echo 'selected="selected"';?>><?php echo $lang_enlargeit['topleftglide']?></option>
                 
              </select>
          </td>
        </tr>             
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_speed']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_speed" id="enl_speed">
                 <option value="10" <?php if($ENLARGEITSET['enl_speed'] == 10) echo 'selected="selected"';?>>10</option>
                 <option value="12" <?php if($ENLARGEITSET['enl_speed'] == 12) echo 'selected="selected"';?>>12</option>
                 <option value="14" <?php if($ENLARGEITSET['enl_speed'] == 14) echo 'selected="selected"';?>>14</option>
                 <option value="16" <?php if($ENLARGEITSET['enl_speed'] == 16) echo 'selected="selected"';?>>16</option>
                 <option value="18" <?php if($ENLARGEITSET['enl_speed'] == 18) echo 'selected="selected"';?>>18</option>
                 <option value="20" <?php if($ENLARGEITSET['enl_speed'] == 20) echo 'selected="selected"';?>>20</option>
                 <option value="22" <?php if($ENLARGEITSET['enl_speed'] == 22) echo 'selected="selected"';?>>22</option>
                 <option value="24" <?php if($ENLARGEITSET['enl_speed'] == 24) echo 'selected="selected"';?>>24</option>
                 <option value="26" <?php if($ENLARGEITSET['enl_speed'] == 26) echo 'selected="selected"';?>>26</option>
                 <option value="28" <?php if($ENLARGEITSET['enl_speed'] == 28) echo 'selected="selected"';?>>28</option>
                 <option value="30" <?php if($ENLARGEITSET['enl_speed'] == 30) echo 'selected="selected"';?>>30</option>
                 <option value="32" <?php if($ENLARGEITSET['enl_speed'] == 32) echo 'selected="selected"';?>>32</option>
              </select>
          </td>
        </tr>   
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_maxstep']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_maxstep" id="enl_maxstep">
                 <option value="4" <?php if($ENLARGEITSET['enl_maxstep'] == 4) echo 'selected="selected"';?>>4</option>
                 <option value="5" <?php if($ENLARGEITSET['enl_maxstep'] == 5) echo 'selected="selected"';?>>5</option>
                 <option value="6" <?php if($ENLARGEITSET['enl_maxstep'] == 6) echo 'selected="selected"';?>>6</option>
                 <option value="7" <?php if($ENLARGEITSET['enl_maxstep'] == 7) echo 'selected="selected"';?>>7</option>
                 <option value="8" <?php if($ENLARGEITSET['enl_maxstep'] == 8) echo 'selected="selected"';?>>8</option>
                 <option value="9" <?php if($ENLARGEITSET['enl_maxstep'] == 9) echo 'selected="selected"';?>>9</option>
                 <option value="10" <?php if($ENLARGEITSET['enl_maxstep'] == 10) echo 'selected="selected"';?>>10</option>
                 <option value="11" <?php if($ENLARGEITSET['enl_maxstep'] == 11) echo 'selected="selected"';?>>11</option>
                 <option value="12" <?php if($ENLARGEITSET['enl_maxstep'] == 12) echo 'selected="selected"';?>>12</option>
                 <option value="13" <?php if($ENLARGEITSET['enl_maxstep'] == 13) echo 'selected="selected"';?>>13</option>
                 <option value="14" <?php if($ENLARGEITSET['enl_maxstep'] == 14) echo 'selected="selected"';?>>14</option>
                 <option value="15" <?php if($ENLARGEITSET['enl_maxstep'] == 15) echo 'selected="selected"';?>>15</option>
                 <option value="16" <?php if($ENLARGEITSET['enl_maxstep'] == 16) echo 'selected="selected"';?>>16</option>
                 <option value="17" <?php if($ENLARGEITSET['enl_maxstep'] == 17) echo 'selected="selected"';?>>17</option>
                 <option value="18" <?php if($ENLARGEITSET['enl_maxstep'] == 18) echo 'selected="selected"';?>>18</option>
                 <option value="19" <?php if($ENLARGEITSET['enl_maxstep'] == 19) echo 'selected="selected"';?>>19</option>
                 <option value="20" <?php if($ENLARGEITSET['enl_maxstep'] == 20) echo 'selected="selected"';?>>20</option>
                 <option value="21" <?php if($ENLARGEITSET['enl_maxstep'] == 21) echo 'selected="selected"';?>>21</option>
                 <option value="22" <?php if($ENLARGEITSET['enl_maxstep'] == 22) echo 'selected="selected"';?>>22</option>
                 <option value="23" <?php if($ENLARGEITSET['enl_maxstep'] == 23) echo 'selected="selected"';?>>23</option>
                 <option value="24" <?php if($ENLARGEITSET['enl_maxstep'] == 24) echo 'selected="selected"';?>>24</option>
                 <option value="25" <?php if($ENLARGEITSET['enl_maxstep'] == 25) echo 'selected="selected"';?>>25</option>
                 <option value="26" <?php if($ENLARGEITSET['enl_maxstep'] == 26) echo 'selected="selected"';?>>26</option>
                 <option value="27" <?php if($ENLARGEITSET['enl_maxstep'] == 27) echo 'selected="selected"';?>>27</option>
                 <option value="28" <?php if($ENLARGEITSET['enl_maxstep'] == 28) echo 'selected="selected"';?>>28</option>
                 <option value="29" <?php if($ENLARGEITSET['enl_maxstep'] == 29) echo 'selected="selected"';?>>29</option>
                 <option value="30" <?php if($ENLARGEITSET['enl_maxstep'] == 30) echo 'selected="selected"';?>>30</option>
              </select>
          </td>
        </tr>   
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_opaglide']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_opaglide" id="enl_opaglide">
                 <option value="1" <?php if($ENLARGEITSET['enl_opaglide'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_opaglide'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>   
        <tr>
          <td><hr /></td><td><hr /></td>
        </tr>
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_brd']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_brd" id="enl_brd">
                 <option value="1" <?php if($ENLARGEITSET['enl_brd'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_brd'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>          
        <tr>
          <td width="50%" align="right">
            <?php echo $lang_enlargeit['enl_brdcolor']?>&nbsp;&nbsp;
          </td>
          <td width="50%">
            <input id="enl_brdcolor" name="enl_brdcolor" value="<?php echo $ENLARGEITSET['enl_brdcolor']?>">
          </td>
        </tr>        
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_brdbck']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_brdbck" id="enl_brdbck">
                 <option value="" <?php if($ENLARGEITSET['enl_brdbck'] == "") echo 'selected="selected"';?>>-</option>
                 <option value="b_marble.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_marble.png") echo 'selected="selected"';?>>Marble</option>
                 <option value="b_metallight.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_metallight.png") echo 'selected="selected"';?>>Brushed Metal</option>
                 <option value="b_metalwhite.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_metalwhite.png") echo 'selected="selected"';?>>White Metal</option>
                 <option value="b_metalwhite2.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_metalwhite2.png") echo 'selected="selected"';?>>White Metal 2</option>
                 <option value="b_metalblue.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_metalblue.png") echo 'selected="selected"';?>>Blue Metal</option>
                 <option value="b_metalred.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_metalred.png") echo 'selected="selected"';?>>Red Metal</option>
                 <option value="b_metalgreen.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_metalgreen.png") echo 'selected="selected"';?>>Green Metal</option>
                 <option value="b_metalsilver.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_metalsilver.png") echo 'selected="selected"';?>>Silver Metal</option>
                 <option value="b_metalblack.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_metalblack.png") echo 'selected="selected"';?>>Black Metal</option>
                 <option value="b_rain.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_rain.png") echo 'selected="selected"';?>>Rain</option>
                 <option value="b_rainlight.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_rainlight.png") echo 'selected="selected"';?>>Light Rain</option>
                 <option value="b_woodlight.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_woodlight.png") echo 'selected="selected"';?>>Light Wood</option>
                 <option value="b_wooddark.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_wooddark.png") echo 'selected="selected"';?>>Dark Wood</option>
                 <option value="b_paper.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_paper.png") echo 'selected="selected"';?>>Paper</option>
                 <option value="b_leather.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_leather.png") echo 'selected="selected"';?>>Leather</option>
                 <option value="b_green.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_green.png") echo 'selected="selected"';?>>Dark Green</option>
                 <option value="b_greenliquid.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_greenliquid.png") echo 'selected="selected"';?>>Green Liquid</option>
                 <option value="b_choc.png" <?php if($ENLARGEITSET['enl_brdbck'] == "b_choc.png") echo 'selected="selected"';?>>Chocolate</option>
              </select>
          </td>
        </tr> 
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_brdsize']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_brdsize" id="enl_brdsize">
                 <option value="1" <?php if($ENLARGEITSET['enl_brdsize'] == 1) echo 'selected="selected"';?>>1</option>
                 <option value="2" <?php if($ENLARGEITSET['enl_brdsize'] == 2) echo 'selected="selected"';?>>2</option>
                 <option value="3" <?php if($ENLARGEITSET['enl_brdsize'] == 3) echo 'selected="selected"';?>>3</option>
                 <option value="4" <?php if($ENLARGEITSET['enl_brdsize'] == 4) echo 'selected="selected"';?>>4</option>
                 <option value="5" <?php if($ENLARGEITSET['enl_brdsize'] == 5) echo 'selected="selected"';?>>5</option>
                 <option value="6" <?php if($ENLARGEITSET['enl_brdsize'] == 6) echo 'selected="selected"';?>>6</option>
                 <option value="7" <?php if($ENLARGEITSET['enl_brdsize'] == 7) echo 'selected="selected"';?>>7</option>
                 <option value="8" <?php if($ENLARGEITSET['enl_brdsize'] == 8) echo 'selected="selected"';?>>8</option>
                 <option value="9" <?php if($ENLARGEITSET['enl_brdsize'] == 9) echo 'selected="selected"';?>>9</option>
                 <option value="10" <?php if($ENLARGEITSET['enl_brdsize'] == 10) echo 'selected="selected"';?>>10</option>
                 <option value="11" <?php if($ENLARGEITSET['enl_brdsize'] == 11) echo 'selected="selected"';?>>11</option>
                 <option value="12" <?php if($ENLARGEITSET['enl_brdsize'] == 12) echo 'selected="selected"';?>>12</option>
                 <option value="13" <?php if($ENLARGEITSET['enl_brdsize'] == 13) echo 'selected="selected"';?>>13</option>
                 <option value="14" <?php if($ENLARGEITSET['enl_brdsize'] == 14) echo 'selected="selected"';?>>14</option>
                 <option value="15" <?php if($ENLARGEITSET['enl_brdsize'] == 15) echo 'selected="selected"';?>>15</option>
                 <option value="16" <?php if($ENLARGEITSET['enl_brdsize'] == 16) echo 'selected="selected"';?>>16</option>
                 <option value="17" <?php if($ENLARGEITSET['enl_brdsize'] == 17) echo 'selected="selected"';?>>17</option>
                 <option value="18" <?php if($ENLARGEITSET['enl_brdsize'] == 18) echo 'selected="selected"';?>>18</option>
                 <option value="19" <?php if($ENLARGEITSET['enl_brdsize'] == 19) echo 'selected="selected"';?>>19</option>
                 <option value="20" <?php if($ENLARGEITSET['enl_brdsize'] == 20) echo 'selected="selected"';?>>20</option>
                 <option value="21" <?php if($ENLARGEITSET['enl_brdsize'] == 21) echo 'selected="selected"';?>>21</option>
                 <option value="22" <?php if($ENLARGEITSET['enl_brdsize'] == 22) echo 'selected="selected"';?>>22</option>
                 <option value="23" <?php if($ENLARGEITSET['enl_brdsize'] == 23) echo 'selected="selected"';?>>23</option>
                 <option value="24" <?php if($ENLARGEITSET['enl_brdsize'] == 24) echo 'selected="selected"';?>>24</option>
                 <option value="25" <?php if($ENLARGEITSET['enl_brdsize'] == 25) echo 'selected="selected"';?>>25</option>
                 <option value="30" <?php if($ENLARGEITSET['enl_brdsize'] == 30) echo 'selected="selected"';?>>30</option>
                 <option value="35" <?php if($ENLARGEITSET['enl_brdsize'] == 35) echo 'selected="selected"';?>>35</option>
                 <option value="40" <?php if($ENLARGEITSET['enl_brdsize'] == 40) echo 'selected="selected"';?>>40</option>
              </select>
          </td>
        </tr> 
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_brdround']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_brdround" id="enl_brdround">
                 <option value="1" <?php if($ENLARGEITSET['enl_brdround'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_brdround'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>          
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_shadow']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_shadow" id="enl_shadow">
                 <option value="1" <?php if($ENLARGEITSET['enl_shadow'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_shadow'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_shadowsize']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_shadowsize" id="enl_shadowsize">
                 <option value="1" <?php if($ENLARGEITSET['enl_shadowsize'] == 1) echo 'selected="selected"';?>>1</option>
                 <option value="2" <?php if($ENLARGEITSET['enl_shadowsize'] == 2) echo 'selected="selected"';?>>2</option>
                 <option value="3" <?php if($ENLARGEITSET['enl_shadowsize'] == 3) echo 'selected="selected"';?>>3</option>
                 <option value="4" <?php if($ENLARGEITSET['enl_shadowsize'] == 4) echo 'selected="selected"';?>>4</option>
                 <option value="5" <?php if($ENLARGEITSET['enl_shadowsize'] == 5) echo 'selected="selected"';?>>5</option>
                 <option value="6" <?php if($ENLARGEITSET['enl_shadowsize'] == 6) echo 'selected="selected"';?>>6</option>
                 <option value="7" <?php if($ENLARGEITSET['enl_shadowsize'] == 7) echo 'selected="selected"';?>>7</option>
                 <option value="8" <?php if($ENLARGEITSET['enl_shadowsize'] == 8) echo 'selected="selected"';?>>8</option>
                 <option value="9" <?php if($ENLARGEITSET['enl_shadowsize'] == 9) echo 'selected="selected"';?>>9</option>
              </select>
          </td>
        </tr>           
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_shadowintens']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_shadowintens" id="enl_shadowintens">
                 <option value="1" <?php if($ENLARGEITSET['enl_shadowintens'] == 1) echo 'selected="selected"';?>>1</option>
                 <option value="2" <?php if($ENLARGEITSET['enl_shadowintens'] == 2) echo 'selected="selected"';?>>2</option>
                 <option value="3" <?php if($ENLARGEITSET['enl_shadowintens'] == 3) echo 'selected="selected"';?>>3</option>
                 <option value="4" <?php if($ENLARGEITSET['enl_shadowintens'] == 4) echo 'selected="selected"';?>>4</option>
                 <option value="5" <?php if($ENLARGEITSET['enl_shadowintens'] == 5) echo 'selected="selected"';?>>5</option>
                 <option value="6" <?php if($ENLARGEITSET['enl_shadowintens'] == 6) echo 'selected="selected"';?>>6</option>
                 <option value="7" <?php if($ENLARGEITSET['enl_shadowintens'] == 7) echo 'selected="selected"';?>>7</option>
                 <option value="8" <?php if($ENLARGEITSET['enl_shadowintens'] == 8) echo 'selected="selected"';?>>8</option>
                 <option value="9" <?php if($ENLARGEITSET['enl_shadowintens'] == 9) echo 'selected="selected"';?>>9</option>
                 <option value="10" <?php if($ENLARGEITSET['enl_shadowintens'] == 10) echo 'selected="selected"';?>>10</option>
                 <option value="11" <?php if($ENLARGEITSET['enl_shadowintens'] == 11) echo 'selected="selected"';?>>11</option>
                 <option value="12" <?php if($ENLARGEITSET['enl_shadowintens'] == 12) echo 'selected="selected"';?>>12</option>
                 <option value="13" <?php if($ENLARGEITSET['enl_shadowintens'] == 13) echo 'selected="selected"';?>>13</option>
                 <option value="14" <?php if($ENLARGEITSET['enl_shadowintens'] == 14) echo 'selected="selected"';?>>14</option>
                 <option value="15" <?php if($ENLARGEITSET['enl_shadowintens'] == 15) echo 'selected="selected"';?>>15</option>
                 <option value="16" <?php if($ENLARGEITSET['enl_shadowintens'] == 16) echo 'selected="selected"';?>>16</option>
                 <option value="17" <?php if($ENLARGEITSET['enl_shadowintens'] == 17) echo 'selected="selected"';?>>17</option>
                 <option value="18" <?php if($ENLARGEITSET['enl_shadowintens'] == 18) echo 'selected="selected"';?>>18</option>
                 <option value="19" <?php if($ENLARGEITSET['enl_shadowintens'] == 19) echo 'selected="selected"';?>>19</option>
                 <option value="20" <?php if($ENLARGEITSET['enl_shadowintens'] == 20) echo 'selected="selected"';?>>20</option>
                 <option value="25" <?php if($ENLARGEITSET['enl_shadowintens'] == 25) echo 'selected="selected"';?>>25</option>
                 <option value="30" <?php if($ENLARGEITSET['enl_shadowintens'] == 30) echo 'selected="selected"';?>>30</option>
              </select>
          </td>
        </tr>
        <tr>
          <td><hr /></td><td><hr /></td>
        </tr>
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_titlebar']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_titlebar" id="enl_titlebar">
                 <option value="1" <?php if($ENLARGEITSET['enl_titlebar'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_titlebar'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
          <td width="50%" align="right">
            <?php echo $lang_enlargeit['enl_titletxtcol']?>&nbsp;&nbsp;
          </td>
          <td width="50%">
            <input id="enl_titletxtcol" name="enl_titletxtcol" value="<?php echo $ENLARGEITSET['enl_titletxtcol']?>">
          </td>
        </tr>        
        <tr>
          <td width="50%" align="right">
            <?php echo $lang_enlargeit['enl_ajaxcolor']?>&nbsp;&nbsp;
          </td>
          <td width="50%">
            <input id="enl_titletxtcol" name="enl_ajaxcolor" value="<?php echo $ENLARGEITSET['enl_ajaxcolor']?>">
          </td>
        </tr>        
        <tr>
          <td><hr /></td><td><hr /></td>
        </tr>
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_center']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_center" id="enl_center">
                 <option value="1" <?php if($ENLARGEITSET['enl_center'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_center'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_dragdrop']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_dragdrop" id="enl_dragdrop">
                 <option value="1" <?php if($ENLARGEITSET['enl_dragdrop'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_dragdrop'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_wheelnav']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_wheelnav" id="enl_wheelnav">
                 <option value="1" <?php if($ENLARGEITSET['enl_wheelnav'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_wheelnav'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>   
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_dark']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_dark" id="enl_dark">
                 <option value="1" <?php if($ENLARGEITSET['enl_dark'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?> 1</option>
                 <option value="2" <?php if($ENLARGEITSET['enl_dark'] == 2) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?> 2</option>
                 <option value="0" <?php if($ENLARGEITSET['enl_dark'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_darkprct']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_darkprct" id="enl_darkprct">
                 <option value="0" <?php if($ENLARGEITSET['enl_darkprct'] == 0) echo 'selected="selected"';?>>0</option>
                 <option value="10" <?php if($ENLARGEITSET['enl_darkprct'] == 10) echo 'selected="selected"';?>>10</option>
                 <option value="20" <?php if($ENLARGEITSET['enl_darkprct'] == 20) echo 'selected="selected"';?>>20</option>
                 <option value="30" <?php if($ENLARGEITSET['enl_darkprct'] == 30) echo 'selected="selected"';?>>30</option>
                 <option value="40" <?php if($ENLARGEITSET['enl_darkprct'] == 40) echo 'selected="selected"';?>>40</option>
                 <option value="50" <?php if($ENLARGEITSET['enl_darkprct'] == 50) echo 'selected="selected"';?>>50</option>
                 <option value="60" <?php if($ENLARGEITSET['enl_darkprct'] == 60) echo 'selected="selected"';?>>60</option>
                 <option value="70" <?php if($ENLARGEITSET['enl_darkprct'] == 70) echo 'selected="selected"';?>>70</option>
                 <option value="80" <?php if($ENLARGEITSET['enl_darkprct'] == 80) echo 'selected="selected"';?>>80</option>
                 <option value="90" <?php if($ENLARGEITSET['enl_darkprct'] == 90) echo 'selected="selected"';?>>90</option>
                 <option value="100" <?php if($ENLARGEITSET['enl_darkprct'] == 100) echo 'selected="selected"';?>>100</option>
              </select>
          </td>
        </tr>        
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_darkensteps']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_darkensteps" id="enl_darkensteps">
                 <option value="1" <?php if($ENLARGEITSET['enl_darkensteps'] == 1) echo 'selected="selected"';?>>1</option>
                 <option value="2" <?php if($ENLARGEITSET['enl_darkensteps'] == 2) echo 'selected="selected"';?>>2</option>
                 <option value="3" <?php if($ENLARGEITSET['enl_darkensteps'] == 3) echo 'selected="selected"';?>>3</option>
                 <option value="4" <?php if($ENLARGEITSET['enl_darkensteps'] == 4) echo 'selected="selected"';?>>4</option>
                 <option value="5" <?php if($ENLARGEITSET['enl_darkensteps'] == 5) echo 'selected="selected"';?>>5</option>
                 <option value="6" <?php if($ENLARGEITSET['enl_darkensteps'] == 6) echo 'selected="selected"';?>>6</option>
                 <option value="7" <?php if($ENLARGEITSET['enl_darkensteps'] == 7) echo 'selected="selected"';?>>7</option>
                 <option value="8" <?php if($ENLARGEITSET['enl_darkensteps'] == 8) echo 'selected="selected"';?>>8</option>
                 <option value="9" <?php if($ENLARGEITSET['enl_darkensteps'] == 9) echo 'selected="selected"';?>>9</option>
                 <option value="10" <?php if($ENLARGEITSET['enl_darkensteps'] == 10) echo 'selected="selected"';?>>10</option>
                 <option value="11" <?php if($ENLARGEITSET['enl_darkensteps'] == 11) echo 'selected="selected"';?>>11</option>
                 <option value="12" <?php if($ENLARGEITSET['enl_darkensteps'] == 12) echo 'selected="selected"';?>>12</option>
                 <option value="13" <?php if($ENLARGEITSET['enl_darkensteps'] == 13) echo 'selected="selected"';?>>13</option>
                 <option value="14" <?php if($ENLARGEITSET['enl_darkensteps'] == 14) echo 'selected="selected"';?>>14</option>
                 <option value="15" <?php if($ENLARGEITSET['enl_darkensteps'] == 15) echo 'selected="selected"';?>>15</option>
                 <option value="16" <?php if($ENLARGEITSET['enl_darkensteps'] == 16) echo 'selected="selected"';?>>16</option>
                 <option value="17" <?php if($ENLARGEITSET['enl_darkensteps'] == 17) echo 'selected="selected"';?>>17</option>
                 <option value="18" <?php if($ENLARGEITSET['enl_darkensteps'] == 18) echo 'selected="selected"';?>>18</option>
                 <option value="19" <?php if($ENLARGEITSET['enl_darkensteps'] == 19) echo 'selected="selected"';?>>19</option>
                 <option value="20" <?php if($ENLARGEITSET['enl_darkensteps'] == 20) echo 'selected="selected"';?>>20</option>
              </select>
          </td>
        </tr>       
        <tr>
          <td><hr /></td><td><hr /></td>
        </tr>
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_buttonpic'] . $enlargeit_icon_array['show']; ?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_buttonpic" id="enl_buttonpic">
                 <option value="1" <?php if($ENLARGEITSET['enl_buttonpic'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_buttonpic'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_buttoninfo'] . $enlargeit_icon_array['info'];?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_buttoninfo" id="enl_buttoninfo">
                 <option value="2" <?php if($ENLARGEITSET['enl_buttoninfo'] == 2) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_buttoninfoyes2']?></option>
                 <option value="1" <?php if($ENLARGEITSET['enl_buttoninfo'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_buttoninfoyes1']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_buttoninfo'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_buttonfav'] . $enlargeit_icon_array['favorites']; ?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_buttonfav" id="enl_buttonfav">
                 <option value="1" <?php if($ENLARGEITSET['enl_buttonfav'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_buttonfav'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
          <td align="right"><em>Dummy - does not work yet:</em> <?php echo $lang_enlargeit['enl_buttonvote'] . $enlargeit_icon_array['vote']; ?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_buttonvote" id="enl_buttonvote" disabled="disabled">
                 <option value="1" <?php if($ENLARGEITSET['enl_buttonvote'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_buttonvote'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>   
        <tr>
          <td align="right"><em>Dummy - does not work yet:</em> <?php echo $lang_enlargeit['enl_buttoncomment'] . $enlargeit_icon_array['comment']; ?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_buttoncomment" id="enl_buttoncomment" disabled="disabled">
                 <option value="1" <?php if($ENLARGEITSET['enl_buttoncomment'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_buttoncomment'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>       
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_buttondownload'] . $enlargeit_icon_array['download']; ?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_buttondownload" id="enl_buttondownload">
                 <option value="1" <?php if($ENLARGEITSET['enl_buttondownload'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="2" <?php if($ENLARGEITSET['enl_buttondownload'] == 2) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_maxforreg']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_buttondownload'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>  
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_buttonmax'] . $enlargeit_icon_array['fullsize']; ?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_buttonmax" id="enl_buttonmax">
                 <option value="1" <?php if($ENLARGEITSET['enl_buttonmax'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="2" <?php if($ENLARGEITSET['enl_buttonmax'] == 2) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_maxforreg']?></option>
                 <option value="3" <?php if($ENLARGEITSET['enl_buttonmax'] == 3) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_maxpopup']?></option>
                 <option value="4" <?php if($ENLARGEITSET['enl_buttonmax'] == 4) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_maxpopupforreg']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_buttonmax'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>       
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_buttonbbcode'] . $enlargeit_icon_array['bbcode']; ?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_buttonbbcode" id="enl_buttonbbcode">
                 <option value="1" <?php if($ENLARGEITSET['enl_buttonbbcode'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_buttonbbcode'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>    
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_buttonhist'] . $enlargeit_icon_array['histogramm']; ?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_buttonhist" id="enl_buttonhist">
                 <option value="1" <?php if($ENLARGEITSET['enl_buttonhist'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_buttonhist'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_buttonnav'] . $enlargeit_icon_array['previous'] . $enlargeit_icon_array['next']; ?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_buttonnav" id="enl_buttonnav">
                 <option value="1" <?php if($ENLARGEITSET['enl_buttonnav'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_buttonnav'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr> 
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_buttonclose'] . $enlargeit_icon_array['close']; ?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_buttonclose" id="enl_buttonclose">
                 <option value="1" <?php if($ENLARGEITSET['enl_buttonclose'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_buttonclose'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
          <td><hr /></td><td><hr /></td>
        </tr>
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_adminmode']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_adminmode" id="enl_adminmode">
                 <option value="1" <?php if($ENLARGEITSET['enl_adminmode'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_adminmode'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_registeredmode']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_registeredmode" id="enl_registeredmode">
                 <option value="1" <?php if($ENLARGEITSET['enl_registeredmode'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_registeredmode'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_guestmode']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_guestmode" id="enl_guestmode">
                 <option value="1" <?php if($ENLARGEITSET['enl_guestmode'] == 1) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_yes']?></option>
                 <option value="0" <?php if($ENLARGEITSET['enl_guestmode'] == 0) echo 'selected="selected"';?>><?php echo $lang_enlargeit['enl_no']?></option>
              </select>
          </td>
        </tr>        
        <tr>
          <td><hr /></td><td><hr /></td>
        </tr>
        <tr>
          <td align="right"><?php echo $lang_enlargeit['enl_flvplayer']?>&nbsp;&nbsp;</td>
          <td>
              <select name="enl_flvplayer" id="enl_flvplayer">
                 <option value="1" <?php if($ENLARGEITSET['enl_flvplayer'] == 1) echo 'selected="selected"';?>>OS FLV</option>
                 <option value="0" <?php if($ENLARGEITSET['enl_flvplayer'] == 0) echo 'selected="selected"';?>>rphMedia</option>
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
          <td align="left">
                                          <button type="submit" class="button" name="submit" value="<?php echo $lang_enlargeit['submit_button']; ?>"><?php echo $enlargeit_icon_array['ok'] . $lang_enlargeit['submit_button']; ?></button>
          </td>
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