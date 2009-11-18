<?php
/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt!
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.2
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
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



global $lang_plugin_enlargeit;

// get settings
//require_once('./plugins/enlargeit/include/load_enlargeitset.php');


// add neccessary parameters
function enlargeit_addparams($params) 
{
    global $thumb, $CONFIG, $template_thumbnail_view, $CURRENT_PIC_DATA;
    
    // enabled for current user type?
    if (GALLERY_ADMIN_MODE && !$CONFIG['plugin_enlargeit_adminmode']) return $params;
    if (USER_ID && !$CONFIG['plugin_enlargeit_registeredmode']) return $params;
    if (!USER_ID && !$CONFIG['plugin_enlargeit_guestmode']) return $params;
    
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
    if ($CONFIG['plugin_enlargeit_pictype']==1) $enl_path = $CONFIG['fullpath'].$thumb['filepath'].$thumb['filename'];
    else if ($CONFIG['plugin_enlargeit_pictype']==2) $enl_path = $CONFIG['fullpath'].$thumb['filepath'].$CONFIG['normal_pfx'].$thumb['filename'];
    else if ($CONFIG['plugin_enlargeit_pictype']==0 && is_file($CONFIG['fullpath'].$thumb['filepath'].$CONFIG['normal_pfx'].$thumb['filename'])) $enl_path = $CONFIG['fullpath'].$thumb['filepath'].$CONFIG['normal_pfx'].$thumb['filename'];
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
      if ($enl_filetyplower == 'flv' && $CONFIG['plugin_enlargeit_flvplayer'] == 1) 
      {
      	$enl_newthumb .= 'longdesc="fl2::../../../'.path2url($enl_path).'::'.$CURRENT_PIC_DATA['pwidth'].'::'.$CURRENT_PIC_DATA['pheight'].'" ';
      }
      if ($enl_filetyplower == 'flv' && $CONFIG['plugin_enlargeit_flvplayer'] == 2) 
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
function enlargeit_head($meta) {        
	global $template_header, $lang_plugin_enlargeit, $CONFIG, $CPG_PHP_SELF, $LINEBREAK, $JS;
	require('./plugins/enlargeit/include/init.inc.php');
	$enlargeit_pages_array = array('thumbnails.php');
	if (in_array('plugins/enlargeit/js/enlargeit_source.js', $JS['includes']) != TRUE && in_array($CPG_PHP_SELF, $enlargeit_pages_array) == TRUE) {
		$JS['includes'][] = 'plugins/enlargeit/js/enlargeit_source.js';
		$meta  .= '<link rel="stylesheet" href="plugins/enlargeit/enl_styles.css" type="text/css" />';
		set_js_var('enl_ani', $CONFIG['plugin_enlargeit_ani']);
		set_js_var('enl_opaglide', $CONFIG['plugin_enlargeit_opaglide']);
		if ($CONFIG['plugin_enlargeit_brdsize'] > 0) {
			set_js_var('enl_brd', '1');
		} else {
			set_js_var('enl_brd', '0');
		}
		set_js_var('enl_titlebar', $CONFIG['plugin_enlargeit_titlebar']);
		set_js_var('enl_brdsize', $CONFIG['plugin_enlargeit_brdsize']);
		set_js_var('enl_brdcolor', $CONFIG['plugin_enlargeit_brdcolor']);
		set_js_var('enl_titletxtcol', $CONFIG['plugin_enlargeit_titletxtcol']);
		set_js_var('enl_ajaxcolor', $CONFIG['plugin_enlargeit_ajaxcolor']);
		set_js_var('enl_brdround', $CONFIG['plugin_enlargeit_brdround']);
		set_js_var('enl_maxstep', $CONFIG['plugin_enlargeit_maxstep']);
		if ($CONFIG['plugin_enlargeit_shadowsize'] > 0) {
			set_js_var('enl_shadow', 1);
		} else {
			set_js_var('enl_shadow', 0);
		}
		set_js_var('enl_shadowsize', $CONFIG['plugin_enlargeit_shadowsize']);
		set_js_var('enl_shadowintens', $CONFIG['plugin_enlargeit_shadowintens']);
		set_js_var('enl_speed', $CONFIG['plugin_enlargeit_speed']);
		set_js_var('enl_dark', $CONFIG['plugin_enlargeit_dark']);
		set_js_var('enl_darkprct', $CONFIG['plugin_enlargeit_darkprct']);
		set_js_var('enl_center', $CONFIG['plugin_enlargeit_center']);
		set_js_var('enl_wheelnav', $CONFIG['plugin_enlargeit_wheelnav']);
		set_js_var('enl_drgdrop', $CONFIG['plugin_enlargeit_dragdrop']);
		if ($CONFIG['plugin_enlargeit_brdbck'] != '') {
			set_js_var('enl_brdbck', 'backgrounds/'.$CONFIG['plugin_enlargeit_brdbck'].'.png');
		} else {
			set_js_var('enl_brdbck', '');
		}
		set_js_var('enl_darksteps', $CONFIG['plugin_enlargeit_darkensteps']);
		set_js_var('enl_canceltext', $lang_plugin_enlargeit['enl_canceltext']);
		set_js_var('enl_noflash', $lang_plugin_enlargeit['enl_noflashfound']);
		// Define the buttons
		$buttonurl_array = array();
		$buttontxt_array = array();
		$buttonoff_array = array();
		if ($CONFIG['plugin_enlargeit_buttonpic']) {
			$buttonurl_array[] = 'pic';
			$buttontxt_array[] = $lang_plugin_enlargeit['enl_tooltippic'];
			$buttonoff_array[] = '0';
		}
		if ($CONFIG['plugin_enlargeit_buttonfav']) {
			$buttonurl_array[] = 'index.php?file=enlargeit/enl_addfav&pid=';
			$buttontxt_array[] = $lang_plugin_enlargeit['enl_tooltipfav'];
			$buttonoff_array[] = '-32';
		}
		set_js_var('enl_buttonurl', $buttonurl_array);
		set_js_var('enl_buttontxt', $buttontxt_array);
		set_js_var('enl_buttonoff', $buttonoff_array);
	}
	return $meta;
}


// Change thumbnail template
function enl_thumb() 
{
  global $CONFIG, $template_thumbnail_view, $lang_enlarge;
  // get language
  require_once('./plugins/enlargeit/include/init.inc.php');

  // change thumb template if enlargeit is active for current user
  if ((GALLERY_ADMIN_MODE && !$CONFIG['plugin_enlargeit_adminmode']) || (USER_ID && !$CONFIG['plugin_enlargeit_registeredmode']) || (!USER_ID && !$CONFIG['plugin_enlargeit_guestmode']))
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
function enlargeit_install() {
    global $CONFIG;
    // register file types FLV and DivX
    cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_FILETYPES']} (`extension`,`mime`,`content`,`player`) VALUES ('divx','video/divx','movie','')");
    cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_FILETYPES']} (`extension`,`mime`,`content`,`player`) VALUES ('flv','application/x-shockwave-flash','movie','Flash Player')");
	// Add the config options for the plugin
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_brdsize', '22')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_brdround', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_brdcolor', '#FFFFFF')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_shadow', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_shadowsize', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_shadowintens', '20')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_ani', '5')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_maxstep', '18')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_speed', '12')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_titlebar', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_titletxtcol', '#445544')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_ajaxcolor', '#666677')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_center', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_dark', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_darkprct', '20')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_buttonpic', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_buttoninfo', '2')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_buttonfav', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_buttoncomment', '0')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_buttondownload', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_buttonbbcode', '0')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_buttonhist', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_buttonvote', '0')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_buttonmax', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_buttonclose', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_buttonnav', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_adminmode', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_registeredmode', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_guestmode', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_sefmode', '0')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_pictype', '0')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_dragdrop', '0')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_wheelnav', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_flvplayer', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_opaglide', '0')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_brdbck', '0')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_enlargeit_darkensteps', '20')");
	
    return true;
}


// uninstall and drop settings table
function enlargeit_uninstall() {
    global $CONFIG;
	$superCage = Inspekt::makeSuperCage();
    if (!checkFormToken()) {
        global $lang_errors;
        cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
    }
    // Delete the plugin config records
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_brdsize'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_brdround'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_brdcolor'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_shadow'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_shadowsize'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_shadowintens'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_ani'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_maxstep'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_speed'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_titlebar'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_titletxtcol'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_ajaxcolor'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_center'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_dark'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_darkprct'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_buttonpic'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_buttoninfo'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_buttonfav'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_buttoncomment'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_buttondownload'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_buttonbbcode'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_buttonhist'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_buttonvote'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_buttonmax'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_buttonclose'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_buttonnav'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_adminmode'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_registeredmode'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_guestmode'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_sefmode'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_pictype'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_dragdrop'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_wheelnav'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_flvplayer'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_opaglide'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_brdbck'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_enlargeit_darkensteps'");
    return true;
}
?>