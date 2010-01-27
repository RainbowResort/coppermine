<?php
/**************************************************
  Coppermine 1.4.x Plugin - EnlargeIt! $VERSION$=2.15
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
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

// Add page start action for admin button and change thumb template
$thisplugin->add_action('page_start','enl_thumb');

// Add filter for page head
$thisplugin->add_filter('page_meta','enlargeit_head');

// Add filter for page body
$thisplugin->add_filter('page_html','enl_main');


global $ENLARGEITSET,$lang_enlargeit;
// get settings
require('./plugins/enlargeit/include/load_enlargeitset.php');


// add config button
function enl_add_config_button($href,$title,$target,$link)
{
  global $template_gallery_admin_menu;
  $new_template = $template_gallery_admin_menu;
  $button = template_extract_block($new_template,'documentation');
  $params = array(
      '{DOCUMENTATION_HREF}' => $href,
      '{DOCUMENTATION_TITLE}' => $title,
      'target="cpg_documentation"' => $target,
      '{DOCUMENTATION_LNK}' => $link,
   );
   $new_button="<!-- BEGIN $link -->".template_eval($button,$params)."<!-- END $link -->\n";
   template_extract_block($template_gallery_admin_menu,'documentation',"<!-- BEGIN documentation -->" . $button . "<!-- END documentation -->\n" . $new_button);
}

function enl_page_start()
{ 
  if (GALLERY_ADMIN_MODE) {
    enl_add_config_button('index.php?file=enlargeit/plugin_config','','','EnlargeIt!');
  } 
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
    $enlargeit_headcode .= "enl_shadowcolor = '".$ENLARGEITSET['enl_shadowcolor']."';
    ";
    $enlargeit_headcode .= "enl_gifpath = 'plugins/enlargeit/js/';
    ";
    $enlargeit_headcode .= "enl_usecounter = 1;
    ";
    $enlargeit_headcode .= "enl_counterurl = 'index.php?file=enlargeit/enl_cnt&a=';
    ";
    if ($ENLARGEITSET['enl_brdbck'] == "" && (strtolower($ENLARGEITSET['enl_brdcolor']) == '#ffffff' || strtolower($ENLARGEITSET['enl_brdcolor']) == 'white')) { 
    $enlargeit_headcode .= "enl_btninact = 'binact.png';
    ";
    $enlargeit_headcode .= "enl_btnact = 'bact.png';
    "; }
    else {
    $enlargeit_headcode .= "enl_btninact = 'binact_transp.png';
    ";
    $enlargeit_headcode .= "enl_btnact = 'bact_transp.png';
    "; 
    }
    if ($ENLARGEITSET['enl_mousecursors'] == 1) {
    $enlargeit_headcode .= "enl_minuscur = 'minuscur.cur';
    ";
    $enlargeit_headcode .= "enl_pluscur = 'pluscur.cur';
    "; }
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
    if ($ENLARGEITSET['enl_buttoninfo'] == 1)
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'index.php?file=enlargeit/enl_info&pid=';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltipinfo']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -16;
    ";
    $i = $i + 1;
    }
    if ($ENLARGEITSET['enl_buttoninfo'] == 2)
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'site:displayimage.php?pid=';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltipinfo']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -16;
    ";
    $i = $i + 1;
    }
    if ($ENLARGEITSET['enl_buttonvote'])
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'index.php?file=enlargeit/enl_rteit&pid=';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltipvote']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -112;
    ";
    $i = $i + 1;
    }
    if ($ENLARGEITSET['enl_buttoncomment'])
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'index.php?file=enlargeit/enl_comment&pos=-';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltipcomment']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -64;
    ";
    $i = $i + 1;
    }    
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
    if ($ENLARGEITSET['enl_buttonecard'])
    {
      $enlargeit_headcode .= "enl_buttonurl[".$i."] = 'index.php?file=enlargeit/enl_ecard&pos=-';
    ";
      $enlargeit_headcode .= "enl_buttontxt[".$i."] = \"".$lang_enlargeit['enl_tooltipecard']."\";
    ";
      $enlargeit_headcode .= "enl_buttonoff[".$i."] = -176;
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
    }        if ($ENLARGEITSET['enl_buttonhist'])
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
<meta http-equiv=\"imagetoolbar\" content=\"no\" />
<!-- End EnlargeIt! Headcode -->
";


$template_header = str_replace('{META}','{META}'.$enlargeit_headcode,$template_header);

}


// Change thumbnail template and add admin button
function enl_thumb() {
  global $CONFIG, $template_thumbnail_view, $lang_enlarge, $ENLARGEITSET;
  require('./plugins/enlargeit/include/init.inc.php');

  if (GALLERY_ADMIN_MODE) {
    enl_add_config_button('index.php?file=enlargeit/plugin_config','','','EnlargeIt!');
  }


  if ((GALLERY_ADMIN_MODE && !$ENLARGEITSET['enl_adminmode']) || (USER_ID && !$ENLARGEITSET['enl_registeredmode']) || (!USER_ID && !$ENLARGEITSET['enl_guestmode']))
  {
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
                                        <!-- BEGIN enlargeit --><a onclick="" href="{LINK_TGT}">{THUMB}<br /></a><!-- END enlargeit -->
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


function enl_main($html) {
  global $thisplugin, $thumb_list, $ENLARGEITSET, $CONFIG;
  
  // enabled for current user type?
  if (GALLERY_ADMIN_MODE && !$ENLARGEITSET['enl_adminmode']) return $html;
  if (USER_ID && !$ENLARGEITSET['enl_registeredmode']) return $html;
  if (!USER_ID && !$ENLARGEITSET['enl_guestmode']) return $html;
  
// get search string depending on thumb_use setting and SEF
switch ($CONFIG['thumb_use'])
{
  case "wd":
    if (!$ENLARGEITSET['enl_sefmode']) $ausdruck = "#<!-- BEGIN enlargeit -->\s*<a\s*onclick=\"\"\s*href=\"displayimage.php\?(.*)\">\s*<img\s*src=\"(.*?)".$CONFIG['thumb_pfx']."(.*?)\"\s*.*\s*width=\"(.*)\"\s*border=\".*\"\s*.*\s*alt=\"(.*?)\"\s*title=\".*\n.*\n.*\n.*?\"\s*/><br /></a><!-- END enlargeit -->#i";
    else $ausdruck = "#<!-- BEGIN enlargeit -->\s*<a\s*onclick=\"\"\s*href=\"displayimage-(.*)\.html\">\s*<img\s*src=\"(.*?)".$CONFIG['thumb_pfx']."(.*?)\"\s*.*\s*width=\"(.*)\"\s*border=\".*\"\s*.*\s*alt=\"(.*?)\"\s*title=\".*\n.*\n.*\n.*?\"\s*/><br /></a><!-- END enlargeit -->#i";
    break;
  case "ht":
    if (!$ENLARGEITSET['enl_sefmode']) $ausdruck = "#<!-- BEGIN enlargeit -->\s*<a\s*onclick=\"\"\s*href=\"displayimage.php\?(.*)\">\s*<img\s*src=\"(.*?)".$CONFIG['thumb_pfx']."(.*?)\"\s*.*\s*height=\"(.*)\"\s*border=\".*\"\s*.*\s*alt=\"(.*?)\"\s*title=\".*\n.*\n.*\n.*?\"\s*/><br /></a><!-- END enlargeit -->#i";
    else $ausdruck = "#<!-- BEGIN enlargeit -->\s*<a\s*onclick=\"\"\s*href=\"displayimage-(.*)\.html\">\s*<img\s*src=\"(.*?)".$CONFIG['thumb_pfx']."(.*?)\"\s*.*\s*height=\"(.*)\"\s*border=\".*\"\s*.*\s*alt=\"(.*?)\"\s*title=\".*\n.*\n.*\n.*?\"\s*/><br /></a><!-- END enlargeit -->#i";
    break;
  default:
    if (!$ENLARGEITSET['enl_sefmode']) $ausdruck = "#<!-- BEGIN enlargeit -->\s*<a\s*onclick=\"\"\s*href=\"displayimage.php\?(.*)\">\s*<img\s*src=\"(.*?)".$CONFIG['thumb_pfx']."(.*?)\"\s*.*\s*width=\"(.*)\"\s*height=\"(.*)\"\s*border=\".*\"\s*.*\s*alt=\"(.*?)\"\s*title=\".*\n.*\n.*\n.*?\"\s*/><br /></a><!-- END enlargeit -->#i";
    else $ausdruck = "#<!-- BEGIN enlargeit -->\s*<a\s*onclick=\"\"\s*href=\"displayimage-(.*)\.html\">\s*<img\s*src=\"(.*?)".$CONFIG['thumb_pfx']."(.*?)\"\s*.*\s*width=\"(.*)\"\s*height=\"(.*)\"\s*border=\".*\"\s*.*\s*alt=\"(.*?)\"\s*title=\".*\n.*\n.*\n.*?\"\s*/><br /></a><!-- END enlargeit -->#i";
}
  
  // get album, cat and pos for each thumb
  preg_match_all($ausdruck, $html, $treffer, PREG_SET_ORDER);
  $i = 0;

  
  foreach($treffer as $match) {
    $i++;
      //File Type detection - EnlargeIt! is for images and SWF files only
      switch ($CONFIG['thumb_use'])
      {
        case "wd":
          $enl_filetype = explode(".",$match[5]);
          if (substr($match[5],0,8) == 'youtube_') $enl_filetype[1] = 'ytb';
          if (substr($match[5],-5) == '.divx') $enl_filetype[1] = 'dvx';
          if (substr($match[5],-4) == '.flv') $enl_filetype[1] = 'flv';
          break;
        case "ht":
          $enl_filetype = explode(".",$match[5]);
          if (substr($match[5],0,8) == 'youtube_') $enl_filetype[1] = 'ytb';
          if (substr($match[5],-5) == '.divx') $enl_filetype[1] = 'dvx';
          if (substr($match[5],-4) == '.flv') $enl_filetype[1] = 'flv';
          break;
        default:
          $enl_filetype = explode(".",$match[6]);
          if (substr($match[6],0,8) == 'youtube_') $enl_filetype[1] = 'ytb';
          if (substr($match[6],-5) == '.divx') $enl_filetype[1] = 'dvx';
          if (substr($match[6],-4) == '.flv') $enl_filetype[1] = 'flv';
      }
      $enl_filetyplower = strtolower($enl_filetype[1]);
      if ($enl_filetyplower == 'jpg' || $enl_filetyplower == 'jpeg' || $enl_filetyplower == 'jpe' || $enl_filetyplower == 'png'|| $enl_filetyplower == 'gif' || $enl_filetyplower == 'bmp'|| $enl_filetyplower == 'jpc' || $enl_filetyplower == 'jp2' || $enl_filetyplower == 'jpx' || $enl_filetyplower == 'jb2' || $enl_filetyplower == 'swc' || $enl_filetyplower == 'swf' || $enl_filetyplower == 'ytb' || $enl_filetyplower == 'dvx' || $enl_filetyplower == 'flv')
      {
        
        // get pos, album, cat out of URL
        
        if (!$ENLARGEITSET['enl_sefmode']) preg_match_all("#album=(.+)&amp;cat=(.+)&amp;pos=(.+)#i",$match[1],$enl_gotit);
        else preg_match_all("#(.+?)-(.+?)-(.+)#i",$match[1],$enl_gotit);
  
        if ($enl_gotit[0]) {
          $album = $enl_gotit[1][0];
          $cat = (int)$enl_gotit[2][0];
          $pos = (int)$enl_gotit[3][0];
        }
        else
        {
          if (!$ENLARGEITSET['enl_sefmode']) preg_match_all("/album=(.+)&amp;pos=(.+)/",$match[1],$enl_gotittoo);
          else preg_match_all("/(.+?)-(.+)/",$match[1],$enl_gotittoo);
          if ($enl_gotittoo[0]) {
            $album = $enl_gotittoo[1][0];
            $cat = 0;
            $pos = (int)$enl_gotittoo[2][0];
          }
          else
          {
            $album = '';
            $cat = 0;
            $pos = 0;
          }
        }
        if (!$album) $album = '';
        if (!$cat) $cat = 0;
        if (!$pos) $pos = 0;


        // Retrieve data for the current picture
        if ($pos < 0) {
            $pid = ($pos < 0) ? -$pos : $pid;
            $result = cpg_db_query("SELECT aid from {$CONFIG['TABLE_PICTURES']} WHERE pid='$pid' LIMIT 1");
            $row = mysql_fetch_array($result);
            $album = $row['aid'];
            $pic_data = get_pic_data($album, $pic_count, $album_name, -1, -1, false);
            for($pos = 0; $pic_data[$pos]['pid'] != $pid && $pos < $pic_count; $pos++);
            $pic_data = get_pic_data($album, $pic_count, $album_name, $pos, 1, false);
            $CURRENT_PIC_DATA = $pic_data[0];
        } else {
            $pic_data = get_pic_data($album, $pic_count, $album_name, $pos, 1, false);
            if (count($pic_data) == 0 && $pos >= $pic_count) {
                $pos = $pic_count - 1;
                $human_pos = $pos + 1;
                $pic_data = get_pic_data($album, $pic_count, $album_name, $pos, 1, false);
            }
            $CURRENT_PIC_DATA = $pic_data[0];
        }

        if (!$ENLARGEITSET['enl_sefmode']) $neu_str = '<a onclick="return false;" href="displayimage.php?'.$match[1];
        else $neu_str = '<a onclick="return false;" href="displayimage-'.$match[1].'.html';

        if ($ENLARGEITSET['enl_pictype']==1) $enl_path = $CONFIG['fullpath'].$CURRENT_PIC_DATA['filepath'].$CURRENT_PIC_DATA['filename'];
        else if ($ENLARGEITSET['enl_pictype']==2) $enl_path = $CONFIG['fullpath'].$CURRENT_PIC_DATA['filepath'].$CONFIG['normal_pfx'].$CURRENT_PIC_DATA['filename'];
        else if ($ENLARGEITSET['enl_pictype']==0 && is_file($CONFIG['fullpath'].$CURRENT_PIC_DATA['filepath'].$CONFIG['normal_pfx'].$CURRENT_PIC_DATA['filename'])) $enl_path = $CONFIG['fullpath'].$CURRENT_PIC_DATA['filepath'].$CONFIG['normal_pfx'].$CURRENT_PIC_DATA['filename'];
        else $enl_path = $CONFIG['fullpath'].$CURRENT_PIC_DATA['filepath'].$CURRENT_PIC_DATA['filename']; 
        
        if ($enl_filetyplower == 'swf' ) 
        {
          $enl_swfheight = $CURRENT_PIC_DATA['pheight'];
          $enl_swfwidth = $CURRENT_PIC_DATA['pwidth'];
          if ($enl_swfheight == 0) $enl_swfheight = 400;
          if ($enl_swfwidth == 0) $enl_swfwidth = 400;      
          $neu_str .= '"><img src="'.$match[2].$CONFIG['thumb_pfx'].$match[3].'" longdesc="swf::'.path2url($enl_path).'::'.$enl_swfwidth.'::'.$enl_swfheight;
        }
        else if ($enl_filetyplower == 'ytb' ) $neu_str .= '"><img src="'.$match[2].$CONFIG['thumb_pfx'].$match[3].'" longdesc="swf::'.str_replace(".jpg","",str_replace("youtube_","http://www.youtube.com/v/",$CURRENT_PIC_DATA['filename'])).'&amp;fs=1&amp;rel=0::480::385';
        else if ($enl_filetyplower == 'dvx' ) {
          $enl_dvxheight = $CURRENT_PIC_DATA['pheight']+20;
          $enl_dvxwidth = $CURRENT_PIC_DATA['pwidth'];
          if ($enl_dvxheight == 20) $enl_dvxheight = 212;
          if ($enl_dvxwidth == 0) $enl_dvxwidth = 320;
          $neu_str .= '"><img src="'.$match[2].$CONFIG['thumb_pfx'].$match[3].'" longdesc="dvx::'.path2url($enl_path).'::'.$enl_dvxwidth.'::'.$enl_dvxheight;
        }
        else if ($enl_filetyplower == 'flv' ) {
          $enl_flvheight = $CURRENT_PIC_DATA['pheight'];
          $enl_flvwidth = $CURRENT_PIC_DATA['pwidth'];
          if ($enl_flvheight == 0) $enl_flvheight = 410;
          if ($enl_flvwidth == 0) $enl_flvwidth = 500;
          if ($ENLARGEITSET['enl_flvplayer'] == 1) $neu_str .= '"><img src="'.$match[2].$CONFIG['thumb_pfx'].$match[3].'" longdesc="fl2::../../../'.path2url($enl_path).'::'.$enl_flvwidth.'::'.$enl_flvheight;
          else $neu_str .= '"><img src="'.$match[2].$CONFIG['thumb_pfx'].$match[3].'" longdesc="flv::../../../'.path2url($enl_path).'::'.$enl_flvwidth.'::'.$enl_flvheight;
        }
        else $neu_str .= '"><img src="'.$CONFIG['fullpath'].path2url($CURRENT_PIC_DATA['filepath'].$CONFIG['thumb_pfx'].$CURRENT_PIC_DATA['filename']).'" longdesc="'.path2url($enl_path);
        
        // build the rest of the string depending on thumb_use setting
        switch ($CONFIG['thumb_use'])
        {
          case "ht":
          $neu_str .= '" border="0" height="'.$match[4].'" name="'.$CURRENT_PIC_DATA['pid'].'" class="enlargeimg" onclick="enlarge(this);" alt="'.$CURRENT_PIC_DATA['title'].'" title="" /><br /></a>';
          break;
          case "wd":
          $neu_str .= '" border="0" width="'.$match[4].'" name="'.$CURRENT_PIC_DATA['pid'].'" class="enlargeimg" onclick="enlarge(this);" alt="'.$CURRENT_PIC_DATA['title'].'" title="" /><br /></a>';
          break;
          default:
          $neu_str .= '" border="0" width="'.$match[4].'" height="'.$match[5].'" name="'.$CURRENT_PIC_DATA['pid'].'" class="enlargeimg" onclick="enlarge(this);" alt="'.$CURRENT_PIC_DATA['title'].'" title="" /><br /></a>';
          break;
        }
        if ($CURRENT_PIC_DATA['pid'] == $_GET['enlarge']) $html = str_replace("enl_gifpath = 'plugins/enlargeit/js/'","enl_openpic = \"enl".$i."\";enl_gifpath = 'plugins/enlargeit/js/'",$html);
        //$neu_str .= "<script type=\"text/javascript\">enl_openpic = \"enl".$i."\";</script>";
  
        // replace
        $html = str_replace($match[0],$neu_str,$html);

      }
    }
  return $html;
}

// Install
function enlargeit_install()
{
                global $CONFIG, $thisplugin;
                require 'include/sql_parse.php';

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
                
                cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_FILETYPES']} (`extension`,`mime`,`content`,`player`) VALUES ('divx','video/divx','movie','')");
                cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_FILETYPES']} (`extension`,`mime`,`content`,`player`) VALUES ('flv','application/x-shockwave-flash','movie','Flash Player')");
                
           return true;
}


// Unnstall and drop settings table
function enlargeit_uninstall()
{
        global $CONFIG;
        cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_enlargeit");
        return true;
}
?>