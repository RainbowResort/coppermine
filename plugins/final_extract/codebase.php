<?php
/**************************************************
  Coppermine 1.5.x Plugin - final_extract
  *************************************************
  Copyright (c) 2009 Donnovan Bray
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

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('plugin_install','final_extract_install');
$thisplugin->add_action('plugin_configure','final_extract_configure');
$thisplugin->add_action('plugin_uninstall','final_extract_uninstall');
$thisplugin->add_action('plugin_cleanup','final_extract_cleanup');


// Main filter - Remove exact block from page
$thisplugin->add_filter('page_html','final_extract_page_html');
// Add actions
$thisplugin->add_action('page_start','final_extract_page_start');

function final_extract_block(&$template, $block_name, $subst='')
{
        $pattern = "#(<!-- BEGIN $block_name -->)(.*?)(<!-- END $block_name -->)#s";
        if ( preg_match($pattern, $template, $matches)){
            $template = str_replace($matches[1].$matches[2].$matches[3], $subst, $template);
            return $matches[2];
        }
}

// Install Plugin
function final_extract_install() 
{
	global $CONFIG, $lang_plugin_final_extract, $lang_plugin_final_extract_config, $thisplugin;
	require ('plugins/final_extract/include/init.inc.php');
	if ($_POST['submit']==$lang_plugin_final_extract_config['button_install']) {
		require 'include/sql_parse.php';
		if(!isset($CONFIG['fex_enable'])) {
			$query="INSERT INTO ".$CONFIG['TABLE_CONFIG']." VALUES ('fex_enable', '1');";
			cpg_db_query($query);
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
function final_extract_configure() 
{
	global $CONFIG, $lang_plugin_final_extract, $lang_plugin_final_extract_config;
	require ('plugins/final_extract/include/init.inc.php');

	echo <<< EOT
		<h2>{$lang_plugin_final_extract['install_click']}</h2>
		{$lang_plugin_final_extract['install_note']}<br />
		<br />
		<form action="{$_SERVER['REQUEST_URI']}" method="post">
		<input type="submit" value="{$lang_plugin_final_extract_config['button_install']}" name="submit" />
		</form>
EOT;
}

// Uninstall (ask admin about dropping table)
function final_extract_uninstall()
{
	global $CONFIG, $thisplugin;
	
	if (!isset($_POST['drop'])) return 1;
	
	if ($_POST['drop']) {
		cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_FINAL_EXTRACT_CONFIG']}");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='fex_enable';");
   	}
	return true;
}
// Ask if admin wants to drop the table
function final_extract_cleanup($action) 
{
    global $lang_plugin_final_extract_config;
    require ('plugins/final_extract/include/init.inc.php');

    if ($action===1) {
        echo <<< EOT
    <form action="{$_SERVER['REQUEST_URI']}" method="post">
        <p>
            {$lang_plugin_final_extract_config['cleanup_question']}
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
           <input type="submit" name="submit" value="{$lang_plugin_final_extract_config['button_submit']}" /> &nbsp;&nbsp;&nbsp;
            <input type="button" name="cancel" onClick="window.location='pluginmgr.php';" value="{$lang_plugin_final_extract_config['button_cancel']}" />
        </span>
    </form>
EOT;
    }
}

// add config button
function final_extract_config_button($href,$title,$target,$link)
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
// Remove object
function final_extract_page_html($html)
{   	
	
	
	global $FEX;
	foreach ($FEX as $key => $value) {
		if ($value=="1") {
			final_extract_block($html, $key);
		}
	}
	
	return $html;
}
// add admin button to start of each page
function final_extract_page_start()
{
	global $CONFIG, $lang_plugin_final_extract, $lang_plugin_final_extract_config, $lang_plugin_final_extract_manage, $FEX,$lang_plugin_final_extract_delete;
	require ('plugins/final_extract/include/init.inc.php');
	require ('plugins/final_extract/include/init2.inc.php');

	$CONFIG['TABLE_FINAL_EXTRACT_CONFIG'] = $CONFIG['TABLE_PREFIX'].'final_extract_config';

	if (GALLERY_ADMIN_MODE) {
		final_extract_config_button('index.php?file=final_extract/plugin_config',$lang_plugin_final_extract['config_title'],'',$lang_plugin_final_extract['config_button']);
	}

}
	
?>
