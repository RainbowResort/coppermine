<?php
/**************************************************
  Coppermine 1.4.x Plugin - Copper ad
  *************************************************
  Copyright (c) 2006 Borzoo Mossavari
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  This is a simple Advertisement plugin without statistics
  or any kind of log.
  this will give you flash/picture/HTML banner
  By using FRAME technology
  ***************************************************/
  
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Add an install & configure & uninstall actions
$thisplugin->add_action('plugin_install','copperad_install');
$thisplugin->add_action('plugin_configure','copperad_configure');
$thisplugin->add_action('plugin_uninstall','copperad_uninstall');
$thisplugin->add_action('plugin_cleanup','copperad_cleanup');

// Add the main filter - Add banner to end of each table
$thisplugin->add_filter('page_html','copperad_banner');

// Add actions
$thisplugin->add_action('page_start','copperad_page_start');

// Install Plugin
function copperad_install() 
{
	global $CONFIG, $lang_plugin_copperad, $lang_plugin_copperad_config, $thisplugin;
	require ('plugins/copper_ad/include/init.inc.php');
	if ($_POST['submit']==$lang_plugin_copperad_config['button_install']) {
		if(!isset($CONFIG['cpa_enable'])) {
			require 'include/sql_parse.php';
			$query="INSERT INTO ".$CONFIG['TABLE_CONFIG']." VALUES ('cpa_enable', '1');";
			cpg_db_query($query);
    		// Copy needed file and ADV directory ===If you can't CHMODE you gallery then comment these line 40~46 and after installation copy "banner.php.sample" and "bannermgr.php.sample" to your gallery root and remove ".sample" extention.
			copy($thisplugin->fullpath."/banner.php.sample","banner.php") or cpg_die(ERROR,$lang_plugin_copperad_config['permission'], __FILE__, __LINE__);
			copy($thisplugin->fullpath."/bannermgr.php.sample","bannermgr.php") or cpg_die(ERROR,$lang_plugin_copperad_config['permission'], __FILE__, __LINE__);
			mkdir('adv') or cpg_die(ERROR,$lang_plugin_copperad_config['permission'], __FILE__, __LINE__);
			mkdir('adv/pic') or cpg_die(ERROR,$lang_plugin_copperad_config['permission'], __FILE__, __LINE__);
			mkdir('adv/flash') or cpg_die(ERROR, $lang_plugin_copperad_config['permission'], __FILE__, __LINE__);
			copy($thisplugin->fullpath."/adv/pic/copperad.jpg","adv/pic/copperad.jpg") or cpg_die(ERROR, $lang_plugin_copperad_config['permission'], __FILE__, __LINE__);
			copy($thisplugin->fullpath."/adv/flash/copperad.swf","adv/flash/copperad.swf") or cpg_die(ERROR, $lang_plugin_copperad_config['permission'], __FILE__, __LINE__);

			// create table	
			$db_schema = $thisplugin->fullpath . '/schema.sql';
			$sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
			$sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);

			$sql_query = remove_remarks($sql_query);
			$sql_query = split_sql_file($sql_query, ';');
		
			foreach($sql_query as $q) { 
				cpg_db_query($q);
			}
			// Put default setting
			$db_schema = $thisplugin->fullpath . '/basic.sql';
			$sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
			$sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);

			$sql_query = remove_remarks($sql_query);
			$sql_query = split_sql_file($sql_query, ';');
		
			foreach($sql_query as $q) { 
				cpg_db_query($q);
			}
		}
		return true;
	} else {
		return 1;
	}
}

// Configure Plugin
function copperad_configure() 
{
	global $CONFIG, $lang_plugin_copperad, $lang_plugin_copperad_config;
	require ('plugins/copper_ad/include/init.inc.php');

	echo <<< EOT
		<h2>{$lang_plugin_copperad['install_click']}</h2>
		{$lang_plugin_copperad['install_note']}<br />
		<br />
		<form action="{$_SERVER['REQUEST_URI']}" method="post">
		<input type="submit" value="{$lang_plugin_copperad_config['button_install']}" name="submit" />
		</form>
EOT;
}

// Uninstall (ask admin about dropping table)
function copperad_uninstall()
{
	global $CONFIG, $thisplugin;
	
	if (!isset($_POST['drop'])) return 1;
	
	if ($_POST['drop']) {
		cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PLUGIN_COPPERAD']}");
		cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_COPPERAD_CONFIG']}");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='cpa_enable';");
   	}
		unlink("banner.php");
		unlink("bannermgr.php");
		unlink("adv/pic/copperad.jpg");
		unlink("adv/flash/copperad.swf");
		rmdir('adv/flash');
		rmdir('adv/pic');
		rmdir('adv');

	return true;
}

// Ask if admin wants to drop the table
function copperad_cleanup($action) 
{
    global $lang_plugin_copperad_config;
    require ('plugins/copper_ad/include/init.inc.php');

    if ($action===1) {
        echo <<< EOT
    <form action="{$_SERVER['REQUEST_URI']}" method="post">
        <p>
            {$lang_plugin_copperad_config['cleanup_question']}
        </p>
        <div style="margin:25;">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><input type="radio" name="drop" value="1" /></td>
                <td>Yes</td>
            </tr>
            <tr>
                <td><input type="radio" name="drop" checked="checked" value="0" /></td>
                <td>No</td>
            </tr>
        </table>
        </div>
        <span>
           <input type="submit" name="submit" value="{$lang_plugin_copperad_config['button_submit']}" /> &nbsp;&nbsp;&nbsp;
            <input type="button" name="cancel" onClick="window.location='pluginmgr.php';" value="{$lang_plugin_copperad_config['button_cancel']}" />
        </span>
    </form>
EOT;
    }
}

// add config button
function copperad_add_config_button($href,$title,$target,$link)
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

// add banner after sys menu for javascript sys menu compatibility
function copperad_add_banner_after_sys_menu()
{
  global $template_sys_menu, $COPPERAD;
  if((GALLERY_ADMIN_MODE && $COPPERAD['admin_show']==1) || (!GALLERY_ADMIN_MODE)) {
	  if($COPPERAD['text_title']=='') {
    		$template_sys_menu = $template_sys_menu.'</div></div><!-- Start Banner table --><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="center"><iframe align="middle" frameborder="0" height="'.$COPPERAD['height'].'" id="adver" marginheight="0" marginwidth="0" name="adver"  scrolling="no" src="banner.php" width="'.$COPPERAD['width'].'"></iframe></td></tr></table><!-- End Banner table --><div><div>';
		}else {
  		  $template_sys_menu = $template_sys_menu.'</div></div><!-- Start Banner table --><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="center"><iframe align="middle" frameborder="0" height="'.$COPPERAD['height'].'" id="adver" marginheight="0" marginwidth="0" name="adver"  scrolling="no" src="banner.php" width="'.$COPPERAD['width'].'"></iframe></td></tr><tr><td align="center"><font size="1">'.$COPPERAD['text_title'].'</font></td></tr></table><!-- End Banner table --><div><div>';
  		}
	}
}

// add banner after sub menu for normal sys menu
function copperad_add_banner_after_sub_menu()
{
  global $template_sub_menu, $COPPERAD;
  if((GALLERY_ADMIN_MODE && $COPPERAD['admin_show']==1) || (!GALLERY_ADMIN_MODE)) {
  	if($COPPERAD['text_title']=='') {
    		$template_sub_menu = $template_sub_menu.'<!-- Start Banner table --><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="center"><iframe align="middle" frameborder="0" height="'.$COPPERAD['height'].'" id="adver" marginheight="0" marginwidth="0" name="adver"  scrolling="no" src="banner.php" width="'.$COPPERAD['width'].'"></iframe></td></tr></table><!-- End Banner table -->';
  	}else {
  		  $template_sub_menu = $template_sub_menu.'<!-- Start Banner table --><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="center"><iframe align="middle" frameborder="0" height="'.$COPPERAD['height'].'" id="adver" marginheight="0" marginwidth="0" name="adver"  scrolling="no" src="banner.php" width="'.$COPPERAD['width'].'"></iframe></td></tr><tr><td align="center"><font size="1">'.$COPPERAD['text_title'].'</font></td></tr></table><!-- End Banner table -->';
 	 }
	}
}

// add admin button to start of each page
function copperad_page_start()
{
	global $CONFIG, $lang_plugin_copperad, $lang_plugin_copperad_config, $COPPERAD, $lang_plugin_copperad_manage, $lang_plugin_copperad_delete;
	require ('plugins/copper_ad/include/init.inc.php');
	require ('plugins/copper_ad/include/init2.inc.php');


	$CONFIG['TABLE_PLUGIN_COPPERAD'] = $CONFIG['TABLE_PREFIX'].'plugin_copperad';
	$CONFIG['TABLE_COPPERAD_CONFIG'] = $CONFIG['TABLE_PREFIX'].'copperad_config';

	if (GALLERY_ADMIN_MODE) {
		copperad_add_config_button('index.php?file=copper_ad/advmgr',$lang_plugin_copperad['config_title'],'',$lang_plugin_copperad['config_button']);
	}
	if ($COPPERAD['status']=='1') {
		copperad_add_banner_after_sys_menu();
		}
	if ($COPPERAD['status']=='2') {
		copperad_add_banner_after_sub_menu();
	}

}

// Add banner at the end of the each table with given limit
function copperad_banner($html) 
{
	global $COPPERAD;
	if((GALLERY_ADMIN_MODE && $COPPERAD['admin_show']==1) || (!GALLERY_ADMIN_MODE)) {
		if ($COPPERAD['status']=='3') {
			if($COPPERAD['text_title']=='') {
				$new_banner = '!-- End standard table --><!-- Start Banner table --><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="center"><iframe align="middle" frameborder="0" height="'.$COPPERAD['height'].'" id="adver" marginheight="0" marginwidth="0" name="adver"  scrolling="no" src="banner.php" width="'.$COPPERAD['width'].'"></iframe></td></tr></table><!-- End Banner table --';
				}else {
					$new_banner = '!-- End standard table --><!-- Start Banner table --><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="center"><iframe align="middle" frameborder="0" height="'.$COPPERAD['height'].'" id="adver" marginheight="0" marginwidth="0" name="adver"  scrolling="no" src="banner.php" width="'.$COPPERAD['width'].'"></iframe></td></tr><tr><td align="center"><font size="1">'.$COPPERAD['text_title'].'</font></td></tr></table><!-- End Banner table --';
				}
			if($COPPERAD['max_show_number']>0) {
					$html = preg_replace('<!-- End standard table -->',$new_banner,$html,$COPPERAD['max_show_number']);
			}else {
				$html = preg_replace('<!-- End standard table -->',$new_banner,$html);
			}
		}
	}
	return $html;
}

?>
