<?php
/**************************************************
  Coppermine 1.4.x Plugin - Live Search (Ajax Base)
  *************************************************
  Copyright (c) 2006 Borzoo Mossavari
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Simple Ajax search :
  - Search Title of files
  - Search Title of Albums
  
  Licence:
  Orginal Javascript and CSS : Coded by Timothy Groves,
  a designer based in Munich, Germany
  Under Creative Commons License.
  URL:
  http://www.brandspankingnew.net/specials/ajax_autosuggest/ajax_autosuggest_autocomplete.html
  
  Moded By Borzoo Mossavari (Bmossavari(at)gmail(dot)com)
  ***************************************************/
  
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Add an install & configure & uninstall actions
$thisplugin->add_action('plugin_install','as_install');
$thisplugin->add_action('plugin_configure','as_configure');
$thisplugin->add_action('plugin_uninstall','as_uninstall');
$thisplugin->add_action('plugin_cleanup','as_cleanup');

// Add the main filter - Add search filed to the page
$thisplugin->add_filter('page_html','as_field');

// Add actions
$thisplugin->add_action('page_start','as_page_start');

// Install Plugin
function as_install() 
{
	global $CONFIG, $lang_plugin_as, $lang_plugin_as_config, $lang_plugin_asmgr, $thisplugin;
	require ('plugins/active_search/include/init.inc.php');
	if ($_POST['submit']==$lang_plugin_as_config['button_install']) {
		require 'include/sql_parse.php';
		// create table	
		$db_schema = $thisplugin->fullpath . '/schema.sql';
		$sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
		$sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);

		$sql_query = remove_remarks($sql_query);
		$sql_query = split_sql_file($sql_query, ';');
		
		foreach($sql_query as $q) { 
			cpg_db_query($q);
		}
		return true;
	} else {
		return 1;
	}
}

// Configure Plugin
function as_configure() 
{
	global $CONFIG, $lang_plugin_as, $lang_plugin_as_config;
	require ('plugins/active_search/include/init.inc.php');

	echo <<< EOT
		<h2>{$lang_plugin_as['install_click']}</h2>
		{$lang_plugin_as['install_note']}<br />
		<br />
		<form action="{$_SERVER['REQUEST_URI']}" method="post">
		<input type="submit" value="{$lang_plugin_as_config['button_install']}" name="submit" />
		</form>
EOT;
}

// Uninstall (ask admin about dropping table)
function as_uninstall()
{
	global $CONFIG, $thisplugin;
	
	if (!isset($_POST['drop'])) return 1;
	
	if ($_POST['drop']) {
		cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PLUGIN_ACTIVE_SEARCH']}");
   	}

	return true;
}

// Ask if admin wants to drop the table
function as_cleanup($action) 
{
    global $lang_plugin_as_config;
    require ('plugins/active_search/include/init.inc.php');

    if ($action===1) {
        echo <<< EOT
    <form action="{$_SERVER['REQUEST_URI']}" method="post">
        <p>
            {$lang_plugin_as_config['cleanup_question']}
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
           <input type="submit" name="submit" value="{$lang_plugin_as_config['button_submit']}" /> &nbsp;&nbsp;&nbsp;
            <input type="button" name="cancel" onClick="window.location='pluginmgr.php';" value="{$lang_plugin_as_config['button_cancel']}" />
        </span>
    </form>
EOT;
    }
}

// add config button
function as_add_config_button($href,$title,$target,$link)
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

// add admin button to start of each page
function as_page_start()
{
	global $CONFIG, $lang_plugin_as, $lang_plugin_as_config, $lang_plugin_asmgr, $AS;
	require ('plugins/active_search/include/init.inc.php');
	$CONFIG['TABLE_PLUGIN_ACTIVE_SEARCH'] = $CONFIG['TABLE_PREFIX'].'plugin_active_search';
	$AS = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PLUGIN_ACTIVE_SEARCH']}");
/* 	if (GALLERY_ADMIN_MODE) {
		//as_add_config_button('index.php?file=active_search/asmgr',$lang_plugin_as['config_title'],'',$lang_plugin_as['config_button']);
	}
 */
}

// Add Active search field
function as_field($html) 
{
	global $CONFIG, $AS,$lang_plugin_as;
	/* add for album mod
	if($_GET['album'] == 1){ //you can add your desire album id to disable this plugin for that album
		return $html;
	}
	*/
	$as_head='</title>
	<script type="text/javascript">
	var useBSNns = true;
	</script>
	<script type="text/javascript" src="plugins/active_search/js/as.js" charset="utf-8"></script>
	
	<link rel="stylesheet" href="plugins/active_search/css/as.css" type="text/css" media="screen" charset="utf-8" />';
	$as_op='<script type="text/javascript">
	var options_xml = {
		script: function (input) { return "cpls.php?input="+input+"&type="+document.getElementById("stype").value; },
		varname:"input",
';
	while ($row=mysql_fetch_array($AS)){
		$as_op = $as_op.$row[0].":".$row[1].",\n";
	}
	$as_op.='	};
	var as_xml = new bsn.AutoSuggest(\'testinput_xml\', options_xml);
</script></body>';
	
	$as_field = <<<EOT
!-- Start standard table -->
	<table class="maintable" align="center">
		<tr>
			<td class="tableb" >
				<form method="get" action="">
					<label for="testinput_xml">{$lang_plugin_as['search']} <input type="button" value="Files" onclick="togglesearch();" name="stype" id="stype"/> :</label>
						<input type="text" id="testinput_xml" value="" style="width:300px" />
				</form>
			</td>
		</tr>
	</table>
	<!-- END standard table -->
	<!-- Start standard table --
EOT;
	$html = preg_replace('<!-- Start standard table -->',$as_field,$html,1);
	$html = ereg_replace('</title>',$as_head,$html);
	$html = ereg_replace('</body>',$as_op,$html);
	return $html;
	}
?>