<?php
/**************************************************
  CPG Photo Shop Plugin for Coppermine Photo Gallery
  *************************************************
  Copyright (c) 2006 Thomas Lange <stramm@gmx.net>
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Coppermine version: 1.4.19
  Photo Shop version: 1.4.0
  $Revision: 1.0 $
  $Author: stramm $
***************************************************/
define('PHOTOSHOP_ADMIN_PHP', true);
define('ADMIN_PHP', true);

require('include/init.inc.php');

$lang = isset($USER['lang']) ? $USER['lang'] : $CONFIG['lang'];
if (!file_exists("plugins/photo_shop/lang/{$lang}.php"))
  $lang = 'english';
require "plugins/photo_shop/lang/{$lang}.php";


if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (!(GALLERY_ADMIN_MODE))	cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

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

        foreach($lang_photoshop_admin_data as $element) {
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
        msg_box($lang_admin_php['info'], $lang_admin_php['upd_success'], $lang_continue, 'index.php?file=photo_shop/photo_shop_config');
		pagefooter();
		die();
}
//end functions

$album = @$_REQUEST['album'];

if (isset($_REQUEST['alb_enabled']) && isset($album)){
	switch ($_REQUEST['alb_enabled']) {
    	case '1':
        		$results = cpg_db_query ("INSERT INTO `{$CONFIG['TABLE_SHOP_PRICES']}` (`aid`, `gid`) VALUES ('$album', '-1')");
		break;

		case '0':
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_SHOP_PRICES']} WHERE aid=$album and gid=-1");
        break;
	}
}

if (isset($_REQUEST['change_album'])) {
   	if (isset($_POST['for_all_albs'])) { // if all albums in the (sub)category of the current album should be changed too
		//get the category the album is in
		$result = cpg_db_query("SELECT category FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid = ".$album);
		$cat_id = mysql_fetch_row($result);
		mysql_free_result($result);
		//$cat_id[0];
		//now get all albums of that category
		$result = cpg_db_query("SELECT aid FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = ".$cat_id[0]);
		while ($all_albums = mysql_fetch_array($result)) {
			//echo $all_albums[0]."<br \>";
			photoshop_process_post_data2($all_albums[0]);
		}
		mysql_free_result($result);
	   	photoshop_refresh($_SERVER['PHP_SELF'].'?file=photo_shop/photo_shop_config&album='.$album);

	} else {
        photoshop_process_post_data2($album);
        photoshop_refresh($_SERVER['PHP_SELF'].'?file=photo_shop/photo_shop_config&album='.$album);
	}

}
if (isset($_POST['reset_album'])) {
    	cpg_db_query("DELETE FROM {$CONFIG['TABLE_SHOP_PRICES']} WHERE aid={$album} AND gid<>-1");
}


$op = @$_GET['op'];
switch ($op) {
    case 'moveu':
		$thisitem = @$_GET['p'];
		$thispriority = @$_GET['priority'];
        if (isset($thisitem) && ($thispriority > 0)) {

            // Move the item above down
            $sql = 'update '.$CONFIG['TABLE_SHOP_CONFIG'].' set priority='.($thispriority).' where priority='.($thispriority-1).';';
            cpg_db_query($sql);

            // Move this item up
            $sql = 'update '.$CONFIG['TABLE_SHOP_CONFIG'].' '.
                   'set priority='.($thispriority-1).' where id='.$thisitem.';';
            cpg_db_query($sql);

        }
    	photoshop_refresh($_SERVER['PHP_SELF'].'?file=photo_shop/photo_shop_config');
        break;
    case 'moved':
		$thisitem = @$_GET['p'];
		$thispriority = @$_GET['priority'];
        if (isset($thisitem) && ($thispriority) < (count($SHOP_CONFIG)-1)) {

            // Move the item below up
            $sql = 'update '.$CONFIG['TABLE_SHOP_CONFIG'].' set priority='.($thispriority).' where priority='.($thispriority+1).';';
            cpg_db_query($sql);

            // Move this item down
            $sql = 'update '.$CONFIG['TABLE_SHOP_CONFIG'].' '.
                   'set priority='.($thispriority+1).' where id='.$thisitem.';';
            cpg_db_query($sql);
        }
    	photoshop_refresh($_SERVER['PHP_SELF'].'?file=photo_shop/photo_shop_config');
        break;
    case 'delete':
		$thisitem = @$_GET['p'];
		$thispriority = @$_GET['priority'];
        if (isset($thisitem) && isset($thispriority)) {

            // Delete the item
            $sql = 'DELETE FROM '.$CONFIG['TABLE_SHOP_CONFIG'].' where id='.$thisitem.';';
            cpg_db_query($sql);

			if ($thispriority < (count($SHOP_CONFIG))){
	            // Move up all
	            $sql = 'update '.$CONFIG['TABLE_SHOP_CONFIG'].' '.
	                   'set priority=priority-1  where priority > '.$thispriority.';';
	            cpg_db_query($sql);
			}
        }
    	photoshop_refresh($_SERVER['PHP_SELF'].'?file=photo_shop/photo_shop_config');
        break;


}

if (isset($_POST) && count($_POST)) {
	if (isset($_POST['new_item'])) {
		$result = cpg_db_query("SELECT max(priority) FROM {$CONFIG['TABLE_SHOP_CONFIG']}");
		$temp = mysql_fetch_row($result);
		$priority = (is_numeric($temp[0])) ? ++$temp[0] : 0;
		mysql_free_result($result);
        cpg_db_query("INSERT INTO {$CONFIG['TABLE_SHOP_CONFIG']} (priority) VALUES ('{$priority}')");
    	photoshop_refresh($_SERVER['PHP_SELF'].'?file=photo_shop/photo_shop_config');
    } elseif (isset($_POST['apply_modifs'])) {
        photoshop_process_post_data();
    }
}

pageheader($lang_photoshop_config['title']);

$signature = 'Coppermine Photo Gallery ' . COPPERMINE_VERSION . ' ('. COPPERMINE_VERSION_STATUS . ')';


//config start

echo "<form action=\"index.php?file=photo_shop/photo_shop_config\" method=\"post\">";
starttable('100%', "{$lang_photoshop_config['title']} - $signature", 3);
create_form($lang_photoshop_admin_data);

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
echo "<form action=\"".$_SERVER['PHP_SELF'].'?file=photo_shop/photo_shop_config'."\" method=\"post\">";
starttable('100%', "{$lang_photoshop_config['title']} - $signature", 9);

photoshop_config_create_form();


echo <<<EOT
                <tr>
                        <td align="left" class="tablef" colspan="9">
                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tr>
                                    <td width="100%" align="center">
                                        <input type="submit" class="button" name="apply_modifs" value="{$lang_photoshop_config['save_cfg']}" />
                                        <input type="submit" class="button" name="new_item" value="{$lang_photoshop_config['new_item']}" />
                                    </td>
                                </tr>
                            </table>
                        </td>
                </tr>
EOT;
endtable();
echo '</form>';
//here we start the new addition per album settings
starttable('100%', $lang_photoshop_config['per_alb_settings']." - $signature", 2);
$alb_list = alb_list_box();
if(is_numeric($album)){
// display album on/ off
//first see if there's an entry for disabled in shop_prices
$results = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_SHOP_PRICES']} WHERE aid=$album AND gid=-1 LIMIT 1");
$row = mysql_fetch_row($results);

if($row[2]=='-1'){
		$alb_enabled = "0";
		$checked='';
	}else{
		$alb_enabled = "1";
		$checked='checked';
	}


mysql_free_result($results);
echo <<<EOT
                <tr>
						<td width="50%" class="tablef">
							{$alb_list}
						</td>
                        <td width="50%" align="left" class="tablef">
                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tr>
                                    <td width="100%">
										<form name="alb_enabled" action="{$_SERVER['PHP_SELF']}?file=photo_shop/photo_shop_config&album={$album}&alb_enabled={$alb_enabled}" method="post">
										{$lang_photoshop_config['shop_enabled']}
                                        <input type="checkbox" onClick="document.alb_enabled.submit();" {$checked} />
										</form>
                                    </td>
                                </tr>
                            </table>
                        </td>
                </tr>
				<tr>
EOT;



	echo "<form action=\"".$_SERVER['PHP_SELF'].'?file=photo_shop/photo_shop_config&album='.$album.''."\" method=\"post\">";

	$results = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_SHOP_PRICES']} WHERE aid={$album}");
	    while ($temp_data = mysql_fetch_array($results)) {
			$changed_price[] = $temp_data;
		}

	$photo_pricelist="";
	foreach($SHOP_CONFIG as $key => $value) {
		if ((is_numeric($key))) {
			if($SHOP_CONFIG[$key]['type']=="photo"){

				foreach($changed_price as $key2 => $value2) {
					if($changed_price[$key2]['gid']==$SHOP_CONFIG[$key]['id']){
						$SHOP_CONFIG[$key]['price']=$changed_price[$key2]['price'];
						$SHOP_CONFIG[$key]['changed']=1;
					}
				}



				photoshop_config_create_form_image2($SHOP_CONFIG[$key], $album);
			}
		}
	}
echo <<<EOT
                <tr>
                        <td align="left" class="tablef" colspan="2">
                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tr>
                                    <td width="100%" align="center">
										<br>{$lang_photoshop_config['all_albs']}
										<input type="checkbox" name="for_all_albs" value="for_all_albs" /><br />
                                        <input type="submit" class="button" name="change_album" value="{$lang_photoshop_config['update_alb']}" />
                                        <input type="submit" class="button" name="reset_album" value="{$lang_photoshop_config['reset_alb']}" />
                                    </td>
                                </tr>
                            </table>
                        </td>
                </tr>
EOT;

	mysql_free_result($results);


	echo <<<EOT
					</tr>
EOT;

endtable();



} else { //album not set... display only the alb dropdown
echo <<<EOT
                <tr>
						<td width="50%" class="tablef">
							{$alb_list}
						</td>
						<td width="50%" class="tablef">
                        </td>
                </tr>
EOT;

}
endtable();

pagefooter();
ob_end_flush();

//functions
function photoshop_config_create_form() {

	global $SHOP_CONFIG, $lang_photoshop_config;
	echo "<tr><td>{$lang_photoshop_config['type']}</td><td>{$lang_photoshop_config['name']}</td><td>{$lang_photoshop_config['price']}</td><td>{$lang_photoshop_config['max_items']}</td><td>{$lang_photoshop_config['ship_item']}</td><td>{$lang_photoshop_config['size_item']}</td><td width=10% colspan=3 align=center>{$lang_photoshop_config['order']}</td></tr>\n";
	foreach($SHOP_CONFIG as $key => $value) {

		 //if ($value['type'] == 'photo') {
		 	photoshop_config_create_form_image($value);
		//} else {
		 	//photoshop_config_create_form_image($value);
		//}
	}
}

function photoshop_config_create_form_image($data) {
	global $SHOP_CONFIG;

	$link = $_SERVER['PHP_SELF'].'?file=photo_shop/photo_shop_config';
	echo "<tr>\n";
	echo "<input type=\"hidden\" name=\"item_id[]\" value=\"{$data['id']}\" />";
	foreach($data as $key => $value) {
		if ((!is_numeric($key))  && ($key != "id")) {
			if ($key == "type") {
            	$photo_selected = ($value == 'photo') ? 'selected="selected"' : '';
            	$cd_selected = ($value == 'cd') ? 'selected="selected"' : '';
            	$shipping_selected = ($value == 'ship') ? 'selected="selected"' : '';

		    	echo <<<EOT
                        <td width="10%" class="tableb" valign="top">
                            <select name="{$key}_{$data['id']}"/>
								<option value="photo" {$photo_selected}>Photo</option>
								<option value="cd" {$cd_selected}>CD</option>
								<option value="ship" {$shipping_selected}>Shipping</option>
							</select>
                        </td>

EOT;
			} elseif ($key == "priority") {

        if ($value > 0 && count($data) > 1) {
            echo <<<EOT
            <td class="tableb" width="2%" align="center" valign="middle">
                <a href="{$link}&amp;op=moveu&amp;p={$data['id']}&amp;priority={$value}"><img src="images/up.gif"  border="0" alt="" /></a>
            </td>
EOT;
        } else {
            echo '<td class="tableb" width="2%"><img src="images/spacer.gif" width="16" height="16" /></td>';
        }

		//cause we introduced shipping and save it 2x in SHOP_CONFIG we need to subtract 2 if shipping is set
		(array_key_exists("ship", $SHOP_CONFIG)) ? $sub_temp = 2 : $sub_temp = 1;

        if (($value) < (count($SHOP_CONFIG)-$sub_temp)) {
            echo <<<EOT
            <td class="tableb" width="2%" align="center" valign="middle">
                <a href="{$link}&amp;op=moved&amp;p={$data['id']}&amp;priority={$value}"><img src="images/down.gif"  border="0" alt="" /></a>
            </td>
EOT;
        } else {
            echo '<td class="tableb" width="2%"><img src="images/spacer.gif" width="16" height="16" /></td>';
        }

        echo <<<EOT
            <td class="tableb" width="2%" align="center" valign="middle">
                <a href="{$link}&amp;op=delete&amp;p={$data['id']}&amp;priority={$value}">
                    <img src="images/delete.gif"  border="0" alt="" />
                </a>
            </td>
EOT;

			} else {
		    echo <<<EOT
                        <td width="21%" class="tableb" valign="top">
                            <input type="text" class="textinput" maxlength="40" style="width: 90%" name="{$key}_{$data['id']}" value="{$value}"/>
                        </td>
EOT;
			}
		}
	}
	echo "<td></td></tr>\n";

}

function photoshop_process_post_data()
{
    global $CONFIG;

    $field_list = array('type', 'name', 'price', 'max_items', 'size', 'ship');

    $item_id_array = photoshop_get_post_var('item_id');
    foreach ($item_id_array as $key => $item_id) {
        $set_statment = '';
        foreach ($field_list as $field) {
            if ($field == 'type' || $field == 'name' ) {
                $set_statment .= $field . "='" . addslashes($_POST[$field . '_' . $item_id]) . "',";
            } else {
                $set_statment .= $field . "='" . $_POST[$field . '_' . $item_id] . "',";
            }
        }
        $set_statment = substr($set_statment, 0, -1);
        cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP_CONFIG']} SET $set_statment WHERE id = '$item_id' LIMIT 1");
    }
    	photoshop_refresh($_SERVER['PHP_SELF'].'?file=photo_shop/photo_shop_config');

}

function photoshop_process_post_data2($album)
{
    global $CONFIG, $SHOP_CONFIG;

    $field_list = array('price');
    	cpg_db_query("DELETE FROM {$CONFIG['TABLE_SHOP_PRICES']} WHERE aid={$album} AND gid<>-1");

    $item_id_array = photoshop_get_post_var('item_id');

    foreach ($item_id_array as $key => $item_id) {
        $set_statment = '';
        foreach ($field_list as $field) {
				$price = $_POST[$field . '_' . $item_id];
				//compare with the one from config
        }
		if($price!=$SHOP_CONFIG[$item_id]['price']){
			cpg_db_query("INSERT INTO {$CONFIG['TABLE_SHOP_PRICES']} (aid, gid, price) VALUES ('$album', '$item_id', '$price')");
		}
    }
	return;
}

function photoshop_get_post_var($var)
{
    global $lang_errors;

    if (!isset($_POST[$var])) cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'] . " ($var)", __FILE__, __LINE__);
    return $_POST[$var];
}

function alb_list_box()
{
    global $CONFIG, $album, $cpg_udb, $lang_photoshop_config;

    if (GALLERY_ADMIN_MODE) {
        $result = cpg_db_query("SELECT aid, title FROM {$CONFIG['TABLE_ALBUMS']} WHERE category < '" . FIRST_USER_CAT . "' ORDER BY title");
        $rowset = cpg_db_fetch_rowset($result);
        mysql_free_result($result);

        //if (defined('UDB_INTEGRATION')) {
            $sql = $cpg_udb->get_admin_album_list();
        /*} else {
            $sql = "SELECT aid, CONCAT('(', user_name, ') ', title) AS title " . "FROM {$CONFIG['TABLE_ALBUMS']} AS a " . "INNER JOIN {$CONFIG['TABLE_USERS']} AS u ON category = (" . FIRST_USER_CAT . " + user_id) " . "ORDER BY title";
        }*/
        $result = cpg_db_query($sql);
        while ($row = mysql_fetch_array($result)) $rowset[] = $row;
        mysql_free_result($result);
    } else {
        $result = cpg_db_query("SELECT aid, title FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = '" . (FIRST_USER_CAT + USER_ID) . "' ORDER BY title");
        $rowset = cpg_db_fetch_rowset($result);
        mysql_free_result($result);
    }

    if (count($rowset)) {
        $lb = "<select name=\"album_listbox\" class=\"listbox\" onChange=\"if(this.options[this.selectedIndex].value) window.location.href='{$_SERVER['PHP_SELF']}?file=photo_shop/photo_shop_config&album='+this.options[this.selectedIndex].value;\">\n";
        $lb .= "        <option>". $lang_photoshop_config['select_alb'] ."</option>\n";
		foreach ($rowset as $row) {
            $selected = ($row['aid'] == $album) ? "SELECTED" : "";
            $lb .= "        <option value=\"" . $row['aid'] . "\" $selected>" . $row['title'] . "</option>\n";
        }
        $lb .= "</select>\n";
        return $lb;
    }
}

function photoshop_config_create_form_image2($data, $album) {
	global $SHOP_CONFIG;
	echo "<input type=\"hidden\" name=\"item_id[]\" value=\"{$data['id']}\" />";

	foreach($data as $key => $value) {
		if ((!is_numeric($key))) {

			if ($key == "name") {
			    echo <<<EOT
	                        <td width="28%" class="tableb" valign="top" align=""right>
	                            {$value}
	                        </td>
EOT;
			}


			if ($key == "price" && $data['changed']!=1) {
			    echo <<<EOT
	                        <td width="28%" class="tableb" valign="top">
	                            <input type="text" style="color:black;" class="textinput" maxlength="40" style="width: 100%" name="{$key}_{$data['id']}" value="{$value}"/>
	                        </td>
EOT;
			} elseif ($key == "price" && $data['changed']==1) {
			    echo <<<EOT
	                        <td width="28%" class="tableb" valign="top">
	                            <input type="text" style="color:red;" class="textinput" maxlength="40" style="width: 100%" name="{$key}_{$data['id']}" value="{$value}"/>
	                        </td>
EOT;
			}


		}
	}
	echo "<td></td></tr>\n";

}
?>