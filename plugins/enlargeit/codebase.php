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
  
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');


// Add plugin_install action
$thisplugin->add_action('plugin_install','enlargeit_install');

// Add plugin_uninstall action
$thisplugin->add_action('plugin_uninstall','enlargeit_uninstall');

// Add page start action for change thumb template
$thisplugin->add_action('page_start','enl_thumb');

// Add filter for page head
$thisplugin->add_filter('page_meta','enlargeit_head');

// Add filter for thumb
$thisplugin->add_filter('theme_display_thumbnails_params','enlargeit_addparams');



global $ENLARGEITSET,$lang_enlargeit;

// get settings
require_once('./plugins/enlargeit/include/load_enlargeitset.php');


// add neccessary parameters
function enlargeit_addparams($params) 
{
    global $thumb, $CONFIG, $template_thumbnail_view, $ENLARGEITSET, $CURRENT_PIC_DATA;
    
    // enabled for current user type?
    if (GALLERY_ADMIN_MODE && !$ENLARGEITSET['enl_adminmode']) return $params;
    if (USER_ID && !$ENLARGEITSET['enl_registeredmode']) return $params;
    if (!USER_ID && !$ENLARGEITSET['enl_guestmode']) return $params;
    
    $enl_filetype = explode(".",$thumb['filename']);
    if (substr($thumb['filename'],0,8) == 'youtube_') 
    {
      $enl_filetype[1] = 'ytb';
    }
    if (substr($thumb['filename'],-5) == '.divx') 
    {
      $enl_filetype[1] = 'dvx';
    }
    if (substr($thumb['filename'],-4) == '.flv') 
    {
      $enl_filetype[1] = 'flv';
    }
    
    $enl_filetyplower = strtolower($enl_filetype[1]);
    
    // get file path depending if normal size pic exists and config setting enl_pictype
    if ($ENLARGEITSET['enl_pictype']==1) $enl_path = $CONFIG['fullpath'].$thumb['filepath'].$thumb['filename'];
    else if ($ENLARGEITSET['enl_pictype']==2) $enl_path = $CONFIG['fullpath'].$thumb['filepath'].$CONFIG['normal_pfx'].$thumb['filename'];
    else if ($ENLARGEITSET['enl_pictype']==0 && is_file($CONFIG['fullpath'].$thumb['filepath'].$CONFIG['normal_pfx'].$thumb['filename'])) $enl_path = $CONFIG['fullpath'].$thumb['filepath'].$CONFIG['normal_pfx'].$thumb['filename'];
    else $enl_path = $CONFIG['fullpath'].$thumb['filepath'].$thumb['filename']; 
    
    // CASE 1: images
    if ($enl_filetyplower == 'jpg' || $enl_filetyplower == 'jpeg' || $enl_filetyplower == 'jpe' || $enl_filetyplower == 'png' || $enl_filetyplower == 'gif' || $enl_filetyplower == 'bmp' || $enl_filetyplower == 'jpc' || $enl_filetyplower == 'jp2' || $enl_filetyplower == 'jpx' || $enl_filetyplower == 'jb2' || $enl_filetyplower == 'swc')
    {
       $enl_newthumb  = '<img src="'.$CONFIG['fullpath'].$thumb['filepath'].$CONFIG['thumb_pfx'].$thumb['filename'].'" ';
       $enl_newthumb .= 'class="enlargeimg" ';
       if (($CONFIG['thumb_use'] == 'any' && $thumb['pwidth'] >= $thumb['pheight']) || $CONFIG['thumb_use'] == 'wd')
       {
       	 $enl_thumbheight = round($thumb['pheight']/$thumb['pwidth']*$CONFIG['thumb_width']);
       	 $enl_newthumb  .= 'width="'.$CONFIG['thumb_width'].'" height="'.$enl_thumbheight.'" ';
       }
       else if (($CONFIG['thumb_use'] == 'any' && $thumb['pwidth'] < $thumb['pheight']) || $CONFIG['thumb_use'] == 'ht')
       {
       	 $enl_thumbwidth = round($thumb['pwidth']/$thumb['pheight']*$CONFIG['thumb_width']);
       	 $enl_newthumb  .= 'width="'.$enl_thumbwidth.'" height="'.$CONFIG['thumb_width'].'" ';
       }
       $enl_newthumb .= 'border="0" onclick="enlarge(this);" longdesc="'.path2url($enl_path).'" name="'.$thumb['pid'].'" ';
       $enl_newthumb .= 'alt="'.$thumb['title'].'" />';
       $more_params = array(
        '{LINK_ONCLICK}'  => 'onclick="return false;"',
        '{THUMB}'  => $enl_newthumb,
       );
    }
    
    // CASE 2: flash or movie
    else if ($enl_filetyplower == 'swf' || $enl_filetyplower == 'ytb' || $enl_filetyplower == 'dvx' || $enl_filetyplower == 'flv')
    {
      $pid = $thumb['pid'];
      
      // For flash or movie files we need some more data from the database
      $result = cpg_db_query("SELECT aid from {$CONFIG['TABLE_PICTURES']} WHERE pid='$pid' LIMIT 1");
      $row = mysql_fetch_array($result);
      $album = $row['aid'];
      $pic_data = get_pic_data($album, $pic_count, $album_name, -1, -1, false);
      for($pos = 0; $pic_data[$pos]['pid'] != $pid && $pos < $pic_count; $pos++);
      $pic_data = get_pic_data($album, $pic_count, $album_name, $pos, 1, false);
      $CURRENT_PIC_DATA = $pic_data[0];
      if ($CURRENT_PIC_DATA['pwidth'] == 0) $CURRENT_PIC_DATA['pwidth'] = 500;
      if ($CURRENT_PIC_DATA['pheight'] == 0) $CURRENT_PIC_DATA['pheight'] = 410;
      
      if ($enl_filetyplower == 'swf') 
      {
      	$enl_newthumb  = '<img src="images/thumbs/thumb_swf.png" class="enlargeimg" width="'.$thumb['pwidth'].'" height="'.$thumb['pheight'].'" ';
      }
      else 
      {
      	$enl_newthumb  = '<img src="images/thumbs/thumb_movie.png" class="enlargeimg" width="'.$thumb['pwidth'].'" height="'.$thumb['pheight'].'" ';
      }
      $enl_newthumb .= 'border="0" onclick="enlarge(this);" ';
      if ($enl_filetyplower == 'swf') 
      {
      	$enl_newthumb .= 'longdesc="swf::'.path2url($enl_path).'::'.$CURRENT_PIC_DATA['pwidth'].'::'.$CURRENT_PIC_DATA['pheight'].'" ';
      }
      if ($enl_filetyplower == 'flv' && $ENLARGEITSET['enl_flvplayer'] == 1) 
      {
      	$enl_newthumb .= 'longdesc="fl2::../../../'.path2url($enl_path).'::'.$CURRENT_PIC_DATA['pwidth'].'::'.$CURRENT_PIC_DATA['pheight'].'" ';
      }
      if ($enl_filetyplower == 'flv' && $ENLARGEITSET['enl_flvplayer'] == 2) 
      {
      	$enl_newthumb .= 'longdesc="flv::../../../'.path2url($enl_path).'::'.$CURRENT_PIC_DATA['pwidth'].'::'.$CURRENT_PIC_DATA['pheight'].'" ';
      }
      if ($enl_filetyplower == 'dvx') 
      {
      	$enl_newthumb .= 'longdesc="dvx::'.path2url($enl_path).'::'.$CURRENT_PIC_DATA['pwidth'].'::'.$CURRENT_PIC_DATA['pheight'].'" ';
      }
      $enl_newthumb .= 'name="'.$thumb['pid'].'" alt="'.$thumb['title'].'" />';
      $more_params = array(
       '{LINK_ONCLICK}'  => 'onclick="return false;"',
       '{THUMB}'  => $enl_newthumb,
      );
    }

    // CASE 3: format not supported by enlargeit
    else 
    {
      $more_params = array(
        '{LINK_ONCLICK}'  => '',
      );
    }

    return array_merge($params,$more_params);

}


// include some stuff in page header
function enlargeit_head()
{        
global $ENLARGEITSET, $template_header, $lang_enlargeit,$CONFIG;
require('./plugins/enlargeit/include/init.inc.php');
    
    $enlargeit_headcode = <<<EOS
<!-- Begin EnlargeIt! Headcode -->
<script type="text/javascript" src="plugins/enlargeit/js/enlargeit.js"></script>
<link rel="stylesheet" href="plugins/enlargeit/enl_styles.css" type="text/css" />

EOS;

    $enlargeit_headcode .= "<script type=\"text/javascript\"><!--
    ";
    $enlargeit_headcode .= "enl_ani = ".$ENLARGEITSET['enl_ani'].";
    ";
    $enlargeit_headcode .= "enl_opaglide = ".$ENLARGEITSET['enl_opaglide'].";
    ";
    $enlargeit_headcode .= "enl_brd = ".$ENLARGEITSET['enl_brd'].";
    ";
    $enlargeit_headcode .= "enl_titlebar = ".$ENLARGEITSET['enl_titlebar'].";
    ";
    $enlargeit_headcode .= "enl_brdsize = ".$ENLARGEITSET['enl_brdsize'].";
    ";
    $enlargeit_headcode .= "enl_brdcolor = '".$ENLARGEITSET['enl_brdcolor']."';
    ";
    $enlargeit_headcode .= "enl_titletxtcol = '".$ENLARGEITSET['enl_titletxtcol']."';
    ";
    $enlargeit_headcode .= "enl_ajaxcolor = '".$ENLARGEITSET['enl_ajaxcolor']."';
    ";
    $enlargeit_headcode .= "enl_brdround = ".$ENLARGEITSET['enl_brdround'].";
    ";    
    $enlargeit_headcode .= "enl_maxstep = ".$ENLARGEITSET['enl_maxstep'].";
    ";
    $enlargeit_headcode .= "enl_shadow = ".$ENLARGEITSET['enl_shadow'].";
    ";
    $enlargeit_headcode .= "enl_shadowsize = ".$ENLARGEITSET['enl_shadowsize'].";
    ";
    $enlargeit_headcode .= "enl_shadowintens = ".$ENLARGEITSET['enl_shadowintens'].";
    ";
    $enlargeit_headcode .= "enl_gifpath = 'plugins/enlargeit/js/';
    ";
    $enlargeit_headcode .= "enl_usecounter = 1;
    ";
    $enlargeit_headcode .= "enl_counterurl = 'index.php?file=enlargeit/enl_cnt&a=';
    ";
    $enlargeit_headcode .= "enl_btnact = 'bact.png';
    ";
    $enlargeit_headcode .= "enl_btninact = 'binact.png';
    ";
    $enlargeit_headcode .= "enl_minuscur = 'minuscur.cur';
    ";
    $enlargeit_headcode .= "enl_speed = ".$ENLARGEITSET['enl_speed'].";
    ";
    $enlargeit_headcode .= "enl_dark = ".$ENLARGEITSET['enl_dark'].";
    ";
    $enlargeit_headcode .= "enl_darkprct = ".$ENLARGEITSET['enl_darkprct'].";
    ";
    $enlargeit_headcode .= "enl_center = ".$ENLARGEITSET['enl_center'].";
    ";
    $enlargeit_headcode .= "enl_wheelnav = ".$ENLARGEITSET['enl_wheelnav'].";
    ";
    $enlargeit_headcode .= "enl_drgdrop = ".$ENLARGEITSET['enl_dragdrop'].";
    ";
    $enlargeit_headcode .= "enl_brdbck = '".$ENLARGEITSET['enl_brdbck']."';
    ";
    $enlargeit_headcode .= "enl_darksteps = ".$ENLARGEITSET['enl_darkensteps'].";
    ";
    $enlargeit_headcode .= "enl_canceltext = \"".$lang_enlargeit['enl_canceltext']."\";
    ";
    $enlargeit_headcode .= "enl_noflash = \"".$lang_enlargeit['enl_noflashfound']."\";
    ";
    $i = 0;
    if ($ENLARGEITSET['enl_buttonpic'])
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'pic';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltippic']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = 0;
    ";
    $i = $i + 1;
    }
    if ($ENLARGEITSET['enl_buttonfav'])
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'index.php?file=enlargeit/enl_addfav&pid=';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltipfav']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -32;
    ";
    $i = $i + 1;
    }
/*    if ($ENLARGEITSET['enl_buttoninfo'] == 1)
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'enl_info.php?pid=';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltipinfo']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -16;
    ";
    $i = $i + 1;
    } */
    if ($ENLARGEITSET['enl_buttoninfo'])
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'site:displayimage.php?pid=';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltipinfo']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -16;
    ";
    $i = $i + 1;
    }
/*    if ($ENLARGEITSET['enl_buttonvote'])
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'enl_rteit.php?pid=';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltipvote']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -112;
    ";
    $i = $i + 1;
    }
    if ($ENLARGEITSET['enl_buttoncomment'])
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'enl_comment.php?pos=-';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltipcomment']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -64;
    ";
    $i = $i + 1;
    }    */
    if ($ENLARGEITSET['enl_buttondownload'] == 1 || ($ENLARGEITSET['enl_buttondownload'] == 2 && USER_ID))
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'index.php?file=enlargeit/enl_download&pid=';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltipdownload']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -208;
    ";
    $i = $i + 1;
    }   
    if ($ENLARGEITSET['enl_buttonbbcode'])
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'index.php?file=enlargeit/enl_bbcode&pos=-';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltipbbcode']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -192;
    ";
    $i = $i + 1;
    }        
    if ($ENLARGEITSET['enl_buttonhist'])
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'index.php?file=enlargeit/enl_hist&pid=';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltiphist']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -160;
    ";
    $i = $i + 1;
    }
    if ($ENLARGEITSET['enl_buttonmax'] == 1 || (USER_ID && $ENLARGEITSET['enl_buttonmax'] == 2))
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'max';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltipmax']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -144;
    ";
    $i = $i + 1;
    }
    if ($ENLARGEITSET['enl_buttonmax'] == 3 || (USER_ID && $ENLARGEITSET['enl_buttonmax'] == 4))
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'maxpop';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltipmax']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -144;
    ";
    $i = $i + 1;
    }    
    if ($ENLARGEITSET['enl_buttonnav'])
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'prev';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltipprev']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -96;
    ";
    $i = $i + 1;
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'next';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltipnext']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -80;
    ";
    $i = $i + 1;
    }
    if ($ENLARGEITSET['enl_buttonclose'])
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'close';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltipclose']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -128;
";
    $i = $i + 1;
    }    
    $enlargeit_headcode .= "//--></script>
<!-- End EnlargeIt! Headcode -->
";

    $template_header = str_replace('{META}','{META}'.$enlargeit_headcode,$template_header);
}


// Change thumbnail template
function enl_thumb() 
{
  global $CONFIG, $template_thumbnail_view, $lang_enlarge, $ENLARGEITSET;
  // get language
  require_once('./plugins/enlargeit/include/init.inc.php');

  // change thumb template if enlargeit is active for current user
  if ((GALLERY_ADMIN_MODE && !$ENLARGEITSET['enl_adminmode']) || (USER_ID && !$ENLARGEITSET['enl_registeredmode']) || (!USER_ID && !$ENLARGEITSET['enl_guestmode']))
  {
    // do nothing
  }
  else
  {
    $template_thumbnail_view = <<<EOT

<!-- BEGIN header -->
        <tr>
<!-- END header -->
<!-- BEGIN thumb_cell -->
        <td valign="top" class="thumbnails" width ="{CELL_WIDTH}" align="center">
                <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                                <td align="center">
                                        <a {LINK_ONCLICK} href="{LINK_TGT}">{THUMB}<br /></a>
                                        {CAPTION}
                                        {ADMIN_MENU}
                                </td>
                        </tr>
                </table>
        </td>
<!-- END thumb_cell -->
<!-- BEGIN empty_cell -->
                <td valign="top" class="thumbnails" align="center">&nbsp;</td>
<!-- END empty_cell -->
<!-- BEGIN row_separator -->
        </tr>
        <tr>
<!-- END row_separator -->
<!-- BEGIN footer -->
        </tr>
<!-- END footer -->
<!-- BEGIN tabs -->
        <tr>
                <td colspan="{THUMB_COLS}" style="padding: 0px;">
                        <table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                       {TABS}
                                </tr>
                        </table>
                </td>
        </tr>
<!-- END tabs -->
<!-- BEGIN spacer -->
        <img src="images/spacer.gif" width="1" height="7" border="" alt="" /><br />
<!-- END spacer -->

EOT;

  }
}


// install
function enlargeit_install()
{
    global $CONFIG, $thisplugin;
    require_once 'include/sql_parse.php';

    // create table
    $db_schema = $thisplugin->fullpath . '/schema.sql';
    $sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
    $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);
    $sql_query = remove_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, ';');
    echo $sqlquery;
    foreach($sql_query as $q) { 
      cpg_db_query($q);
    }
    
    // insert default values
    $db_schema = $thisplugin->fullpath . '/basic.sql';
    $sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
    $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);
    $sql_query = remove_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, ';');
  
    foreach($sql_query as $q) { 
      cpg_db_query($q);
    }
    
    // register file types FLV and DivX
    cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_FILETYPES']} (`extension`,`mime`,`content`,`player`) VALUES ('divx','video/divx','movie','')");
    cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_FILETYPES']} (`extension`,`mime`,`content`,`player`) VALUES ('flv','application/x-shockwave-flash','movie','Flash Player')");
    
           return true;
}


// uninstall and drop settings table
function enlargeit_uninstall()
{
    global $CONFIG;
    cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_enlargeit");
    return true;
}
?>