<?php
/**************************************************
  CPG Mosaic Plugin for Coppermine Photo Gallery
  *************************************************
  Copyright (c) 2008 Thomas Lange <stramm@gmx.net>
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Coppermine version: 1.4.18
  Mosaic version: 1.0
  $Revision: 1.0 $
  $Author: stramm $
***************************************************/
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Init
 $thisplugin->add_action('page_start','mosaic_start');

// Add plugin_install action
 $thisplugin->add_action('plugin_install','mosaic_install');

// Add plugin_uninstall action
 $thisplugin->add_action('plugin_uninstall','mosaic_uninstall');

// Add plugin_cleanup action
 $thisplugin->add_action('plugin_cleanup','mosaic_cleanup');

// Add plugin_configure action
 $thisplugin->add_action('plugin_configure','mosaic_configure');

// Some filters
$thisplugin->add_filter('file_data','mosaic_create');


//functions
//Plugin init
function mosaic_start()
{
  global $CONFIG, $lang_mosaic;
  require_once ('plugins/mosaic/include/init.inc.php');

  //add admin button
  mosaic_add_admin_button('index.php?file=mosaic/mosaic_config',$lang_mosaic['admin_title'],'',$lang_mosaic['admin_title']);
}

//install
function mosaic_install(){
    // Install
    if ($_REQUEST['submit']=='Go!') {
        return true;
    } else {
        return 1;
    }
}

//uninstall
function mosaic_uninstall(){
        global $CONFIG;

        if (!isset($_POST['drop'])) return 1;

        if ($_POST['drop']) {
                cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_MOSAIC']}");

				//config entries
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='mosaic_enable'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='mosaic_admin'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='mosaic_thumbnail_width'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='mosaic_thumbnail_height'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='mosaic_thumbnail_quality'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='mosaic_resize_option'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='mosaic_time_limit'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='mosaic_memory_limit'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='mosaic_thumbnail_limit'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='mosaic_range'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='mosaic_distance'");
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='mosaic_quality'");
            }

        return true;
}

//cleanup, ask if we want to drop the table
function mosaic_cleanup($action) {

	global $lang_mosaic;

    if ($action===1) {
        echo <<< EOT
    <form action="{$_SERVER['REQUEST_URI']}" method="post">
        <p>
            {$lang_mosaic['uninstall']}
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
           <input type="submit" name="submit" value="Submit" /> &nbsp;&nbsp;&nbsp;
            <input type="button" name="cancel" onClick="window.location='pluginmgr.php';" value="Cancel" />
        </span>
    </form>
EOT;
    }
}

//configure
function mosaic_configure($stop=true)
{
    global $errors, $CONFIG;
    require ('include/sql_parse.php');

    $db_update = 'plugins/mosaic/sql/basic.sql';
    $sql_query = fread(fopen($db_update, 'r'), filesize($db_update));
    // Update table prefix
    $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);

    $sql_query = remove_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, ';');

    ?>
        <h2>Performing Database Updates<h2>
        <table class="maintable">

    <?php

    foreach($sql_query as $q) {
        echo "<tr><td class='debug_text' style='color: black;'>
		{$q}
		</td>";
        if (mysql_query($q)) {
            echo "<td class='debug_text' style='color: green;'>OK</td></tr>";
        } else {
            echo "<td class='debug_text' style='color: black;'>Already Done</td></tr>";
        }
    }

    echo "</table>";

    if ($stop) {
        echo <<< EOT

        <form action="{$_SERVER['REQUEST_URI']}" method="post">
            <input type="submit" value="Go!" name="submit" />
        </form>
EOT;
    }

}

//admin button
function mosaic_add_admin_button($href,$title,$target,$link)
{
  global $template_gallery_admin_menu;

  $new_template=$template_gallery_admin_menu;
  $button=template_extract_block($new_template,'documentation');
  $params = array(
      '{DOCUMENTATION_HREF}' => $href,
      '{DOCUMENTATION_TITLE}' => $title,
      'target="cpg_documentation"' => $target,
      '{DOCUMENTATION_LNK}' => $link,
   );
   $new_button="<!-- BEGIN $link -->".template_eval($button,$params)."<!-- END $link -->\n";
   template_extract_block($template_gallery_admin_menu,'documentation',"<!-- BEGIN documentation -->" . $button . "<!-- END documentation -->\n" . $new_button);
}


//action
function mosaic_create($pic_data){
	global $CONFIG, $lang_mosaic;

	$html = "";
	$added = "";


	if ($CONFIG['mosaic_admin'] == 0 || GALLERY_ADMIN_MODE) {
		$event = isset($_POST['event']) ? $_POST['event'] : null;
		if ($event == "create_mosaic") {
			include('plugins/mosaic/mosaic_include.php');

			$pmic = new phpMosaicImageCreator();
			$pmic->registerProgressCallback("updateProcessBar");

			$pmic->setRange($CONFIG['mosaic_range']);
			$pmic->setDistance($CONFIG['mosaic_distance']);
			$pmic->setQuality($CONFIG['mosaic_range']);

			$pmic->setSourceImageFile($CONFIG['fullpath'].$pic_data['filepath'].$pic_data['filename']);
			$pmic->createMosaicImage($CONFIG['fullpath'].'edit/'.$pic_data['filename']);

			$mosaic_form_data =  "<a href = \"index.php?file=mosaic/mosaic_download&filename={$pic_data['filename']}&image=".$CONFIG['fullpath'].'edit/'.$pic_data['filename']."\">{$lang_mosaic['download']}</a>";

		} else {

		($album == 'search') ? $referer = "displayimage.php?pos=-{$pic_data['pid']}" : $referer = null;

		$mosaic_form_data =  <<<EOT
		<table class="shop_table">
			<tr>
				<td>
				<form action="{$referer}" method="post">
					<input type="hidden" value="{$pic_data['pid']}" name="pid" />
					<input type="hidden" value="create_mosaic" name="event" />
	    			<input type="submit" value="{$lang_mosaic['send']}" class="comment_button" />
				</form>
				</td>
			</tr>
		</table>

EOT;

		}
	} else {
		$mosaic_form_data = '';
	}


	$pic_data['html'] = $pic_data['html'].$mosaic_form_data;

	return $pic_data;
}
?>