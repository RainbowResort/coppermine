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
	require ('plugins/final_extract/configuration.php');
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
}
// Configure Plugin
function final_extract_configure() 
{
	global $CONFIG, $lang_plugin_final_extract, $lang_plugin_final_extract_config;
	require ('plugins/final_extract/configuration.php');
	$superCage = Inspekt::makeSuperCage();
	$request_uri = $superCage->server->getDigits('REQUEST_URI');

	echo <<< EOT
		<h2>{$lang_plugin_final_extract['install_click']}</h2>
		{$lang_plugin_final_extract['install_note']}<br />
		<br />
		<form action="{$request_uri}" method="post">
		    <button type="submit" class="button" name="submit" value="{$lang_plugin_final_extract_config['button_install']}">{$final_extract_icon_array['ok']}{$lang_plugin_final_extract_config['button_install']}</button>
		</form>
EOT;
}

// Uninstall (ask admin about dropping table)
function final_extract_uninstall()
{
	global $CONFIG, $thisplugin;
	$superCage = Inspekt::makeSuperCage();
	if ($superCage->post->keyExists('drop')) {
		cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_FINAL_EXTRACT_CONFIG']}");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='fex_enable';");
	} else {
	    return 1;
	}
	return true;
}
// Ask if admin wants to drop the table
function final_extract_cleanup($action) 
{
    global $CONFIG, $lang_common;
    require ('plugins/final_extract/configuration.php');
    $superCage = Inspekt::makeSuperCage();
	$request_uri = $superCage->server->getDigits('REQUEST_URI');

    if ($action===1) {
        echo <<< EOT
    <form action="{$request_uri}" method="post">
        <p>
            {$lang_plugin_final_extract_config['cleanup_question']}
        </p>
        <div style="margin:25;">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><input type="radio" name="drop" value="1" /></td>
                <td>{$lang_common['yes']}</td>
            </tr>
            <tr>
                <td><input type="radio" name="drop" checked="checked" value="0" /></td>
                <td>{$lang_common['no']}</td>
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
	require ('plugins/final_extract/configuration.php');

    $group=explode(',',substr(USER_GROUP_SET,1,-1));
    $result = cpg_db_query("SELECT home,login,my_gallery,upload_pic,album_list,lastup,lastcom,topn,toprated,favpics,search,my_profile FROM {$CONFIG['TABLE_PREFIX']}final_extract_config WHERE Group_Id=$group[0]");
    while($row = mysql_fetch_array($result,MYSQL_ASSOC)){	
        $FEX=$row;				
    }
    mysql_free_result($row);
  	

	$CONFIG['TABLE_FINAL_EXTRACT_CONFIG'] = $CONFIG['TABLE_PREFIX'].'final_extract_config';

	if (GALLERY_ADMIN_MODE) {
		final_extract_config_button('index.php?file=final_extract/admin',$lang_plugin_final_extract['config_title'],'',$lang_plugin_final_extract['config_button']);
	}

}
	
?>
