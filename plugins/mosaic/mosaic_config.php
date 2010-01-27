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

define('MOSAIC_ADMIN_PHP', true);
define('ADMIN_PHP', true);

require('include/init.inc.php');
include('plugins/mosaic/mosaic_include.php');

$lang = isset($USER['lang']) ? $USER['lang'] : $CONFIG['lang'];
if (!file_exists("plugins/mosaic/lang/{$lang}.php"))
  $lang = 'english';
require "plugins/mosaic/lang/{$lang}.php";


if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (!(GALLERY_ADMIN_MODE))	cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);


if (isset($_POST['index'])) {
	//create index
	$pmip = new phpMosaicImageParser();

	$albumid = (isset($_POST['albumid'])) ? $_POST['albumid'] : 0;
    $albstr = ($albumid) ? "WHERE aid = $albumid" : '';
    $sql = "SELECT pid, filename, filepath FROM {$CONFIG['TABLE_PICTURES']} $albstr";
    $result = cpg_db_query($sql);

	while ($row = mysql_fetch_assoc($result)) {
		$image = $CONFIG['fullpath']. $row['filepath'].$row['filename'];
		if (is_known_filetype($image)){
			if (is_image($image)){
				$pmip->parseImage($image);
				echo $pmip->getParsedImages();
			}
		}
	} // while
	mysql_free_result($result);

} elseif (isset($_POST['clear'])) {
	//clear index
    $sql = "TRUNCATE TABLE {$CONFIG['TABLE_MOSAIC']}";
    $result = cpg_db_query($sql);
}



//functions
$options_to_disable = array(); //nothing to disable

function form_label($text)
{
        global $lang_admin_php;

        static $cmi = 0;
        static $open = false;

        if ($open){
        echo <<< EOT
                                </table>
                        </td>
                </tr>
EOT;
        }
        echo <<< EOT
                <tr>
                        <td class="tableh2" colspan="3" onclick="show_section('section{$cmi}')">
                                <span style="cursor:pointer"><img src="images/descending.gif" border="0" width="9" height="9" alt="" title="{$lang_admin_php['click_expand']}" /> <b>$text</b></span>
                        </td>
                </tr>
                <tr>
                        <td>
                                <table align="center" width="100%" cellspacing="1" cellpadding="0" class="maintable" id="section{$cmi}" border="0">
EOT;

        $open = true;
        $cmi++;
}

function form_yes_no_alb_pwd($text, $name, $help = '')
{
    global $CONFIG, $lang_yes, $lang_no, $lang_admin_php, $lang_mosaic_config;
    $help = cpg_display_help($help);


    $value = $CONFIG[$name];
    $yes_0_selected = ($value == '0') ? 'checked="checked"' : '';
    $yes_1_selected = ($value == '1') ? 'checked="checked"' : '';
    $yes_2_selected = ($value == '2') ? 'checked="checked"' : '';

    echo <<<EOT
        <tr>
            <td class="tableb" width="60%">
                $text
            </td>
            <td class="tableb" valign="top" width="50%">
                <input type="radio" id="{$name}0" name="$name" value="0" $yes_0_selected /><label for="{$name}0" class="clickable_option">{$lang_mosaic_config['yes_cut']}</label>
                &nbsp;&nbsp;
                <input type="radio" id="{$name}1" name="$name" value="1" $yes_1_selected /><label for="{$name}1" class="clickable_option">{$lang_mosaic_config['yes_ignore']}</label>
                &nbsp;&nbsp;
                <input type="radio" id="{$name}2" name="$name" value="2" $yes_2_selected /><label for="{$name}2" class="clickable_option">{$lang_mosaic_config['yes_deform']}</label>
            </td>
            <td class="tableb" width="10%">
                $help
            </td>
        </tr>

EOT;
}

function form_input($text, $name, $help = '')
{
    global $CONFIG;

    $value = $CONFIG[$name];
    $help = cpg_display_help($help);

    $type = ($name == 'smtp_password') ? 'password' : 'text';


    echo <<<EOT
                <tr>
                        <td width="60%" class="tableb">
                                $text
                        </td>
                        <td width="50%" class="tableb" valign="top">
                            <input type="$type" class="textinput" maxlength="255" style="width: 100%" name="$name" value="$value"/>
                        </td>
                        <td class="tableb" width="10%">
                                $help
                        </td>
        </tr>

EOT;
}

function form_yes_no($text, $name, $help = '')
{
    global $CONFIG, $lang_yes, $lang_no;
    $help = cpg_display_help($help);

    $value = $CONFIG[$name];
    $yes_selected = $value ? 'checked="checked"' : '';
    $no_selected = !$value ? 'checked="checked"' : '';

    echo <<<EOT
        <tr>
                        <td class="tableb" width="60%">
                                $text
                        </td>
                        <td class="tableb" valign="top" width="50%">
                                <input type="radio" id="{$name}1" name="$name" value="1" $yes_selected/><label for="{$name}1" class="clickable_option">$lang_yes</label>
                                &nbsp;&nbsp;
                                <input type="radio" id="{$name}0" name="$name" value="0" $no_selected/><label for="{$name}0" class="clickable_option">$lang_no</label>
                        </td>
                        <td class="tableb" width="10%">
                                $help
                        </td>
        </tr>

EOT;
}

function form_disabled($text, $name, $help = '')
{
  global $lang_admin_php;
  $help = cpg_display_help($help);

    echo <<<EOT
                <tr>
                    <td width="60%" class="tableb">
                        $text
                    </td>
                    <td width="50%" class="tableb" valign="top">
                        {$lang_admin_php['bbs_disabled']}
                    </td>
                    <td class="tableb" width="10%">
                        $help
                    </td>
                </tr>

EOT;
}

function create_form(&$data)
{
        global $options_to_disable, $CONFIG;

    foreach($data as $element) {
        if ((is_array($element))) {
                $element[3] = (isset($element[3])) ? $element[3] : '';
                if (UDB_INTEGRATION != 'coppermine' AND in_array($element[1],$options_to_disable) AND $CONFIG['bridge_enable']) $element[2] = 15;
            switch ($element[2]) {
                case 0 :
                    form_input($element[0], $element[1], $element[3]);
                    break;
                case 1 :
                    if (($element[1] == 'enable_encrypted_passwords' && !$CONFIG['enable_encrypted_passwords']) || $element[1] != 'enable_encrypted_passwords') {
                        form_yes_no($element[0], $element[1], $element[3]);
                    }
                    break;
                case 2 :
                        form_yes_no_alb_pwd($element[0], $element[1], $element[3]);
                    break;
                case 15 :
                    	form_disabled($element[0], $element[1], $element[3]);
                    break;
                default:
                    die('Invalid action');
            } // switch
        } else {
                form_label($element);
        }
    }
}
    if (isset($_POST['update_config'])) {


        // Code to rename system thumbs in images folder
        $old_thumb_pfx =& $CONFIG['thumb_pfx'];

        foreach($lang_mosaic_admin_data as $element) {
            if ((is_array($element))) {
                if (!isset($_POST[$element[1]])) /*cpg_die(CRITICAL_ERROR, "Missing admin value for '{$element[1]}'", __FILE__, __LINE__);*/ continue;
                $value = addslashes($_POST[$element[1]]);
                if ($CONFIG[$element[1]] !== stripslashes($value))
                     {
                        cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$value' WHERE name = '{$element[1]}'");
                         if ($CONFIG['log_mode'] == CPG_LOG_ALL) {
                                log_write('CONFIG UPDATE SQL: '.
                                          "UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$value' WHERE name = '{$element[1]}'\n".
                                          'TIME: '.date("F j, Y, g:i a")."\n".
                                          'USER: '.$USER_DATA['user_name'],
                                          CPG_DATABASE_LOG
                                          );
                        }
                }
            }
        }
        pageheader($lang_admin_php['title']);
        msg_box($lang_admin_php['info'], $lang_admin_php['upd_success'], $lang_continue, 'index.php?file=mosaic/mosaic_config');
		pagefooter();
		die();
}


function filloptions()
{
        global $CONFIG, $lang_mosaic_config;

        $result = cpg_db_query("SELECT aid, category, IF(user_name IS NOT NULL, CONCAT('(', user_name, ') ',title), CONCAT(' - ', title)) AS title " . "FROM {$CONFIG['TABLE_ALBUMS']} AS a " . "LEFT JOIN {$CONFIG['TABLE_USERS']} AS u ON category = (" . FIRST_USER_CAT . " + user_id) " . "ORDER BY category, title");

        echo '&nbsp;&nbsp;&nbsp;&nbsp;<select size="1" name="albumid" class="listbox"><option value="0">All Albums</option>';

        while ($row = mysql_fetch_array($result)){
                $result2 = cpg_db_query("SELECT name FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid = {$row['category']}");
                $row2 = mysql_fetch_assoc($result2);
                echo "<option value=\"{$row['aid']}\">{$row2['name']} {$row['title']}</option>";
        }

        echo '</select> &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="index" value="'.$lang_mosaic_config['index'].'" class="button" /> ';
		echo '<input type="submit" class="button" name="clear" value="'.$lang_mosaic_config['clear'].'" />';

}

//end functions



pageheader($lang_mosaic_config['title']);

$signature = 'Coppermine Photo Gallery ' . COPPERMINE_VERSION . ' ('. COPPERMINE_VERSION_STATUS . ')';


//config start

echo "<form action=\"index.php?file=mosaic/mosaic_config\" method=\"post\">";
starttable('100%', "{$lang_mosaic_config['title']} - $signature", 3);
create_form($lang_mosaic_admin_data);

echo '</table></td></tr>';

echo <<<EOT
                <tr>
                        <td align="left" class="tablef">
                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tr>
                                    <td width="100%" align="center">
                                        <input type="submit" class="button" name="update_config" value="{$lang_admin_php['save_cfg']}" />
                                    </td>
                                </tr>
                            </table>
                        </td>
                </tr>
EOT;
endtable();
echo '</form>';
//config end
?>
<script type="text/javascript">
        onload = hideall;
</script>
<?php
echo "<form action=\"".$_SERVER['PHP_SELF'].'?file=mosaic/mosaic_config'."\" method=\"post\">";
starttable('100%', "{$lang_mosaic_config['title']} - $signature", 1);


echo <<<EOT
                <tr>
                        <td align="left" class="tablef" colspan="9">
                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tr>
                                    <td width="100%" align="center">
EOT;

filloptions();

echo <<<EOT
                                    </td>
                                </tr>
                            </table>
                        </td>
                </tr>
EOT;
endtable();
echo '</form>';

pagefooter();
?>