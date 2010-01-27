<?php
/*************************************************
  avatar maker plugin for cpg 1.4.x
  *******************************************
  Copyright (c) 2003-2009 foulu (Le Hoai Phuong)
  <foulu_bk@yahoo.com> 
  *************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Init
 $thisplugin->add_action('page_start','avmaker_start');
 
 // Add an install action
$thisplugin->add_action('plugin_install','avmaker_install');

// Add avmaker_uninstall action
 $thisplugin->add_action('plugin_uninstall','avmaker_uninstall');

// Add a configure action
$thisplugin->add_action('plugin_configure','avmaker_configure');

// Add avmaker_cleanup action
 $thisplugin->add_action('plugin_cleanup','avmaker_cleanup');

 // Add avmaker_file_data filter
 $thisplugin->add_filter('thumb_data', 'avmaker_thumb_data');
 
// Add avmaker_file_data filter
 $thisplugin->add_filter('file_data', 'avmaker_file_data');
 
 
// Add avmaker_gallery_footer filter
 $thisplugin->add_filter('gallery_footer', 'avmaker_gallery_footer');
 
function avmaker_install(){
    // Install
    if ($_REQUEST['submit']=='Go!') {
        return true;
    } else {
        return 1;
    }
}

function avmaker_uninstall(){
        global $CONFIG;		
		
        if (!isset($_POST['drop'])) return 1;

        if ($_POST['drop']) {						
				//remove - config
				cpg_db_query("DELETE FROM `{$CONFIG['TABLE_CONFIG']}` WHERE name = 'avmk_enabled' OR name = 'avmk_df_width' OR name = 'avmk_df_height' OR name = 'avmk_jpeg_quality' OR name = 'avmk_time';");
				// drop a table
				cpg_db_query("DROP TABLE `{$CONFIG['TABLE_PREFIX']}av_temp`;");
           }		   
        return true;
}
// CONFIG PLUGIN FUNCTION
function avmaker_configure($stop=true)
{
    global $errors, $CONFIG;
    require ('include/sql_parse.php');

    $db_update = 'plugins/avmaker/sql/basic.sql';
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
// Ask if we want to drop the table
function avmaker_cleanup($action) {

	global $lang_codebase_php;

    if ($action===1) {
        echo <<< EOT
    <form action="{$_SERVER['REQUEST_URI']}" method="post">
        <p>
            {$lang_codebase_php['uninstall']}
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

function avmaker_start() {
	global $CONFIG;
	global $USER_DATA;
	global $cpg_udb;
	global $lang_admin_data, $lang_avmaker_php, $lang_errors;			
	// lang
	if (!file_exists("plugins/avmaker/lang/{$CONFIG['lang']}.php"))
		$CONFIG['lang'] = 'english';
	require "plugins/avmaker/lang/{$CONFIG['lang']}.php";		
	// avmaker_add_admin_button('index.php?file=avmaker/avatar',$lang_avmaker['admin_title'],'',$lang_avmaker['admin_title']);			
}

function avmaker_file_data($CURRENT_PIC_DATA) {
	global $lang_avmaker_php;
	$CURRENT_PIC_DATA['menu'] .= "<br /><br /><a target=\"_blank\" href=\"index.php?file=avmaker/avatar&pid={$CURRENT_PIC_DATA['pid']}\" class=\"admin_menu\">&nbsp;{$lang_avmaker_php[18]}&nbsp;</a>";
	return $CURRENT_PIC_DATA;
}

function avmaker_thumb_data($thumb) {
	global $lang_avmaker_php;
	$add = "[<a target=\"_blank\" href=\"index.php?file=avmaker/avatar&pid={$thumb['pid']}\">{$lang_avmaker_php[1]}</a>]";	
	$thumb['caption_text'] = $add . '<br />' . $thumb['caption_text'];
	return $thumb;
}

function avmaker_gallery_footer() {
	global $template_footer;
	if ($_SERVER['SCRIPT_NAME'] == 'index.php' && $_GET['file'] == 'avmaker/avatar') {
		$template_footer .= '<div class="footer" style="padding-top: 10px;" align="center">Avatar Maker plugin made by <a href="http://coppermine-gallery.net/forum/index.php?action=profile;u=3924"><span style="color: red;">foulu</span></a></div>';
	}	
	return $template_footer;
}

function avmaker_add_sub_button($href,$title,$link)
{
  global $template_sub_menu, $template_sub_menu_spacer;

  $new_template=$template_sub_menu;
  $button=template_extract_block($new_template,'search');
  $params = array(
      '{SEARCH_TGT}' => $href,
      '{SEARCH_TITLE}' => $title,      
      '{SEARCH_LNK}' => $link,
   );
   $new_button="<!-- BEGIN $link -->".template_eval($button,$params)."<!-- END $link -->\n";
   template_extract_block($template_sub_menu, 'search', $new_button . $template_sub_menu_spacer . "<!-- BEGIN search -->" . $button . "<!-- END search -->\n");
}   

function avmaker_add_admin_button($href,$title,$target,$link)
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

?>