<?php
/**************************************************
Coppermine s
*************************************************
Copyright (c) 2007 Paul Van Rompay
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
        // Updates each of the permission options to the config database with a boolean value
        $options = array('admin','owner','registered','any');
        foreach($options as $option)
        {
                if(in_array($option,$_POST['permissions']))
                {
                        $sql = "UPDATE {$CONFIG['TABLE_CONFIG']} SET `value` = '1' WHERE (`name` = 'tag_allow_{$option}');";
                } else {
                        $sql = "UPDATE {$CONFIG['TABLE_CONFIG']} SET `value` = '0' WHERE (`name` = 'tag_allow_{$option}');";
                }
                mysql_query($sql) or die(mysql_error());
        }        
}

pageheader('Photo Tagging Settings');
starttable('100%', 'Photo Tagging Settings', 3);
echo '<tr><td>'."\n";

echo <<< EOT
<br/>
<b>Who Can Tag Photos?</b>
<form action="{$_SERVER['REQUEST_URI']}" method="post">
        <input type="checkbox" name="permissions[]" value="admin">Administrators</input><br/>
        <input type="checkbox" name="permissions[]" value="owner">Owner</input><br/>
        <input type="checkbox" name="permissions[]" value="registered">Registered Users</input><br/>
        <input type="checkbox" name="permissions[]" value="any">All</input><br/>
        <br/>
        <input type="submit" name="submit" value="submit">
</form>
<br/>
EOT;

echo '</td></tr>'."\n";
endtable();
pagefooter();
ob_end_flush();
?>
