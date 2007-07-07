<?php
/**************************************************
Coppermine Annotate Plugin Config
*************************************************
Based on code by Paul Van Rompay
*************************************************
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
*************************************************/

global $CONFIG, $lang_plugin_controlfullsize, $lang_plugin_controlfullsize_config;
require('include/init.inc.php');

if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

if (count($_POST) > 0) {

        $allowed_groups = implode(',',$_POST['permissions']);
        
        // Updates each of the permission options to the config database with a boolean value
        $sql = "UPDATE {$CONFIG['TABLE_CONFIG']} SET `value` = '$allowed_groups' WHERE (`name` = 'tag_allow');";
        mysql_query($sql) or die(mysql_error());

}

pageheader('Photo Tagging Settings');
starttable('100%', 'Photo Tagging Settings', 3);
echo '<tr><td>'."\n";

global $CONFIG;

if(count($_POST)>0)
echo "<br/><em>Update Successful</em><br/><br/>";

echo "<br/><h2>Who Can Tag Photos?</h2><form action='$_SERVER[REQUEST_URI]' method='post'>";

$result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_CONFIG']} WHERE `name` = 'tag_allow'");
$row = mysql_fetch_assoc($result);
$allowed_groups = explode(',',$row['value']);

$result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_USERGROUPS']} WHERE 1 ORDER BY group_id");

while($group = mysql_fetch_array($result))
{
        if(in_array($group[group_id],$allowed_groups)) {$checked = 'checked';}
        else {$checked = '';}
        
        echo "<input type='checkbox' name='permissions[]' value='$group[group_id]' $checked>$group[group_name]</input><br/>\n";
}
        if(in_array('any',$allowed_groups)) {$checked = 'checked';}
        else {$checked = '';}
        echo "<br/><input type='checkbox' name='permissions[]' value='any' $checked>Anyone</input><br/><br/>";

echo "<input type='submit' name='submit' value='submit'></form>";

echo '</td></tr>'."\n";
endtable();
pagefooter();
ob_end_flush();
?>
