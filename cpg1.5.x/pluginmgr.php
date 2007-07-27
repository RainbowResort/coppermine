<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2007 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  
  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

// ------------------------------------------------------------------------- //
//  Open Plugin API (OpenPAPI) for Coppermine Photo Gallery                  //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2004  Christopher Brown-Floyd                              //
//  http://www.brownfloyd.com/                                               //
// ------------------------------------------------------------------------- //
//  For Coppermine support goto http://coppermine.sf.net/board/              //
//  For generic support (non-Coppermine integration) goto                    //
//  the Open Plugin API webpage: http://www.brownfloyd.com/openpapi/         //
// ------------------------------------------------------------------------- //

define('IN_COPPERMINE', true);
define('PLUGINMGR_PHP', true);

require('include/init.inc.php');

if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

function display_plugin_list() {
    global $CPG_PLUGINS,$lang_pluginmgr_php;
    $help = '&nbsp;'.cpg_display_help('f=plugins.htm&amp;as=plugin_manager&amp;ae=plugin_manager_end&amp;top=1', '800', '600');
    starttable('100%', $lang_pluginmgr_php['pmgr'].$help);
echo <<< EOT
        <tr>
                <td>
                    {$lang_pluginmgr_php['explanation']}
                </td>
        </tr>
EOT;
    endtable();
echo <<< EOT
        <br />
EOT;


    $help = '&nbsp;'.cpg_display_help('f=plugins.htm&amp;as=plugin_manager_uninstall&amp;ae=plugin_manager_uninstall_end&amp;top=1', '640', '480');
    $available_plugins = cpg_get_dir_list('./plugins/');
    starttable('100%');

echo <<<EOT
        <tr>
                <td class="tableh1" width="90%"><strong><span class="statlink">{$lang_pluginmgr_php['i_plugins']}</span></strong></td>
                <td colspan="3" class="tableh1" align="center" width="10%"><strong><span class="statlink">{$lang_pluginmgr_php['operation']}</span></strong>{$help}</td>
        </tr>
EOT;

    $installed_count = 0;
    $loop_counter = 0;
    foreach ($CPG_PLUGINS as $thisplugin) {
        $installed_count++;
        unset($extra_info);
        unset($install_info);
        include('./plugins/'.$thisplugin->path.'/configuration.php');

        $safename = addslashes(str_replace('&nbsp;', '', $name));
        $extra = (isset($install_info)) ? ($install_info):(null);

        if (sizeof($thisplugin->error) > 0) {
            $error = $thisplugin->error['desc'];
            $extra = '<tr><td class="tableb" width="100%" colspan="2">'.
                     '<strong>Error:</strong> <span style="color:red;">'.$error.'</span>'.
                     '</td></tr>'.$extra;
        }

        if ($loop_counter == 0) {
            $row_style_class = 'tableb';
        } else {
            $row_style_class = 'tableb tableb_alternate';
        }
        $loop_counter++;
        if ($loop_counter > 1) {
            $loop_counter = 0;
        }

        echo <<<EOT
        <tr>
            <td width="90%" class="{$row_style_class}">
                <table border="0" width="100%" cellspacing="0" cellpadding="0" class="maintable">
                    <tr>
                        <td colspan="2" class="tableh1">{$name}: {$lang_pluginmgr_php['vers']}$version</td>
                    </tr>
                    <tr>
                        <td class="tableb" width="20%">{$lang_pluginmgr_php['extra']}:</td>
                        <td class="tableb">$extra</td>
                    </tr>
                    <tr>
                        <td class="tableb tableb_alternate">{$lang_pluginmgr_php['author']}:</td>
                        <td class="tableb tableb_alternate">$author</td>
                    </tr>
                    <tr>
                        <td class="tableb">{$lang_pluginmgr_php['desc']}</td>
                        <td class="tableb">$description</td>
                    </tr>
                </table>
            </td>
            <td class="{$row_style_class}" valign="top">
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
EOT;
        if ($thisplugin->index > 0 && count($CPG_PLUGINS) > 1) {
            echo <<<EOT
            <td width="3%" align="center" valign="middle">
                <a href="pluginmgr.php?op=moveu&amp;p={$thisplugin->plugin_id}"><img src="images/up.gif"  border="0" alt="" /></a>
            </td>
EOT;
        } else {
            echo '<td width="3%"><img src="images/spacer.gif" width="16" height="16" /></td>';
        }

        if ($thisplugin->index < (count($CPG_PLUGINS)-1)) {
            echo <<<EOT
            <td width="3%" align="center" valign="middle">
                <a href="pluginmgr.php?op=moved&amp;p={$thisplugin->plugin_id}"><img src="images/down.gif"  border="0" alt="" /></a>
            </td>
EOT;
        } else {
            echo '<td width="3%"><img src="images/spacer.gif" width="16" height="16" /></td>';
        }

        echo <<<EOT
            <td width="3%" align="center" valign="middle">
                <a href="pluginmgr.php?op=uninstall&amp;p={$thisplugin->plugin_id}" onClick="return confirmUninstall('$safename')">
                    <img src="images/delete.gif"  border="0" alt="" />
                </a>
            </td>

        </tr>
        </table>
        </td>
        </tr>
EOT;
    }

    if ($installed_count == 0) {
            echo ('<tr><td colspan="4" class="tableb" align="center">'.$lang_pluginmgr_php['none_installed'].'</td></tr>');
    }
    endtable();

    echo('<p>&nbsp;</p>');
    echo('<form name="cpgform" id="cpgform" action="pluginmgr.php?op=upload" method="post" enctype="multipart/form-data">');

    $help_upload = '&nbsp;'.cpg_display_help('f=plugins.htm&amp;as=plugin_manager_upload&amp;ae=plugin_manager_upload_end&amp;top=1', '640', '480');
    $help_install = '&nbsp;'.cpg_display_help('f=plugins.htm&amp;as=plugin_manager_install&amp;ae=plugin_manager_install_end&amp;top=1', '640', '480');
    starttable('100%');
echo <<<EOT
        <tr>
                <td class="tableh1" width="90%">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="left">
                                <strong><span class="statlink">{$lang_pluginmgr_php['n_plugins']}</span></strong>{$help_install}
                            </td>
                            <td align="right">
                                    <input type="file" size="40" name="plugin" class="textinput" />
                                    <input type="submit" class="button" value="{$lang_pluginmgr_php['upload']}" />
                                    {$help_upload}
                            </td>
                        </tr>
                    </table>
                </td>
                <td colspan="3" class="tableh1" align="center" width="10%"><strong><span class="statlink">{$lang_pluginmgr_php['operation']}</span></strong></td>
        </tr>
EOT;

    $loop_counter = 0;

    foreach ($available_plugins as $path) {
        if (($plugin_id = CPGPluginAPI::installed($path))===false) {

            // If codebase.php and configuration.php don't exist, skip this folder
            if (!(file_exists('./plugins/'.$path.'/codebase.php') && file_exists('./plugins/'.$path.'/configuration.php'))) {
                continue;
            }

            unset($extra_info);
            unset($install_info);
            include('./plugins/'.$path.'/configuration.php');

            $safename = addslashes(str_replace('&nbsp;', '', $name));
            $extra = (isset($extra_info)) ? ($extra_info):(null);

            if ($loop_counter == 0) {
                $row_style_class = 'tableb';
            } else {
                $row_style_class = 'tableb tableb_alternate';
            }
            $loop_counter++;
            if ($loop_counter > 1) {
                $loop_counter = 0;
            }

            echo <<<EOT
            <tr>
            <td width="90%" class="{$row_style_class}">
                <table border="0" width="100%" cellspacing="0" cellpadding="0" class="maintable">
                    <tr>
                        <td colspan="2" class="tableh1">{$name}: {$lang_pluginmgr_php['vers']}$version</td>
                    </tr>
                    <tr>
                        <td class="tableb tableb_alternate" width="20%">{$lang_pluginmgr_php['author']}:</td>
                        <td class="tableb tableb_alternate">$author</td>
                    </tr>
                    <tr>
                        <td class="tableb">{$lang_pluginmgr_php['desc']}</td>
                        <td class="tableb">$description</td>
                    </tr>
                </table>
            </td>
            <td class="{$row_style_class}" valign="top">
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="5%" align="center" valign="top">
                        <img src="images/spacer.gif" width="16" height="16" />
                    </td>
                    <td width="5%" align="center" valign="top">
                        <a href="pluginmgr.php?op=install&amp;p=$path"><img src="images/info.gif"  border="0" alt="" /></a>
                    </td>
                    <td width="5%" align="center" valign="top">
                        <a href="pluginmgr.php?op=delete&amp;p=$path" onClick="return confirmDel('$safename')">
                            <img src="images/delete.gif"  border="0" alt="" />
                        </a>
                    </td>
                </tr>
                </table>
            </td>
            </tr>
EOT;
        }
    }
    echo('</form>');
    endtable();
}

// Delete a directory and its contents
function deldir($dir) {
    $handle = opendir($dir);

    // Remove all files
    while (false!==($FolderOrFile = readdir($handle))) {
        if($FolderOrFile != "." && $FolderOrFile != "..") {
            if(is_dir("$dir/$FolderOrFile")) {
                deldir("$dir/$FolderOrFile");
            } else {
                unlink("$dir/$FolderOrFile");
            }
        }
    }
    closedir($handle);

    // If directory was removed return true
    if(rmdir($dir)) {
        return true;
    }
  return false;
}


/**
 * Main code
 */


/**
 * Plugin manager events
 *
 * Executes manager events
 */

$op = @$_GET['op'];
switch ($op) {
    case 'uninstall':
        $plugin_id = $_GET['p'];
        if (!is_numeric($_GET['p'])) {
            $plugin_id = CPGPluginAPI::installed($plugin_id);
        }
        $uninstalled = CPGPluginAPI::uninstall($plugin_id);
        break;
    case 'install':
        $installed = CPGPluginAPI::install($_GET['p']);
        break;
    case 'delete':
        $path = $_GET['p'];
        if (is_bool(strpos('/',$path))) {
            deldir('./plugins/'.$path);
        }
        break;
    case 'moveu':
        $thisplugin = @$CPG_PLUGINS[$_GET['p']];
        if (isset($thisplugin) && ($priority = $thisplugin->priority) > 0) {

            // Move the plugin above down
            $sql = 'update '.$CONFIG['TABLE_PLUGINS'].' set priority='.$priority.' where priority='.($priority-1).';';
            cpg_db_query($sql);

            // Move this plugin up
            $sql = 'update '.$CONFIG['TABLE_PLUGINS'].' '.
                   'set priority='.($priority-1).' where plugin_id='.$thisplugin->plugin_id.';';
            cpg_db_query($sql);
        }
        break;
    case 'moved':
        $thisplugin = @$CPG_PLUGINS[$_GET['p']];
        if (isset($thisplugin) && ($priority = $thisplugin->priority) < (count($CPG_PLUGINS)-1)) {

            // Move the plugin below up
            $sql = 'update '.$CONFIG['TABLE_PLUGINS'].' set priority='.($priority).' where priority='.($priority+1).';';
            cpg_db_query($sql);

            // Move this plugin down
            $sql = 'update '.$CONFIG['TABLE_PLUGINS'].' '.
                   'set priority='.($priority+1).' where plugin_id='.$thisplugin->plugin_id.';';
            cpg_db_query($sql);
        }
        break;
    case 'upload':
        if (is_uploaded_file($_FILES['plugin']['tmp_name'])) {
            $file =& $_FILES['plugin'];
            $info = pathinfo($file['name']);

            if (strtolower($info['extension'] != 'zip')) {
                cpg_die(CRITICAL_ERROR,$lang_pluginmgr_php['not_plugin_package'],__FILE__,__LINE__);
            }

            if (!is_dir('./plugins/receive')) {
                $mask = umask(0);
                mkdir('./plugins/receive',0777);
                umask($mask);
            }

            if (!move_uploaded_file($file['tmp_name'],'./plugins/receive/'.$file['name'])) {
                cpg_die(CRITICAL_ERROR,$lang_pluginmgr_php['copy_error'],__FILE__,__LINE__);
            }

            require_once('./include/zip.lib.php');

            $zip =& new Zip();
            $zip->Extract('./plugins/receive/'.$file['name'],'./plugins',array(-1));

            unlink('./plugins/receive/'.$file['name']);
        }
        break;
}

pageheader($lang_pluginmgr_php['pmgr']);
echo <<<EOT

<script language="javascript" type="text/javascript">
function confirmUninstall(text)
{
    return confirm("{$lang_pluginmgr_php['confirm_uninstall']} (" + text + ") ?");
}

function confirmDel(text)
{
    return confirm("{$lang_pluginmgr_php['confirm_delete']} (" + text + ") ?");
}
</script>
EOT;


/**
 * Display the manager page or execute plugin_configure action
 */

// Plugin isn't being configured; Display the plugin list
if ((($op != 'install') && ($op != 'uninstall')) || (is_bool($installed) && $installed) || (is_bool($uninstalled) && $uninstalled)) {

    // Refresh the page; An operation was just performed
    if  (isset($op)) {
        header('Location: pluginmgr.php');
    }
    display_plugin_list();

// Plugin is being configured; Execute 'plugin_configure' action
} elseif ($op == 'install') {

    // Display configure page table header
    starttable('100%',$lang_pluginmgr_php['configure_plugin'] . ': ' . $CPG_PLUGINS['new']->name);

    echo <<< EOT
    <tr>
        <td class="tableb" valign="top" width="100%">
EOT;

        // Execute 'plugin_configure' action on the new plugin
        CPGPluginAPI::action('plugin_configure',$installed,CPG_EXEC_NEW);
    echo <<< EOT
        </td>
    </tr>
EOT;

    // End the table
    endtable();
} else {

    // Display cleanup page table header
    starttable('100%',$lang_pluginmgr_php['cleanup_plugin'] . ': ' . $CPG_PLUGINS[$plugin_id]->name);

    echo <<< EOT
    <tr>
        <td class="tableb" valign="top" width="100%">
EOT;

        // Execute 'plugin_cleanup' action on the plugin
        CPGPluginAPI::action('plugin_cleanup',$uninstalled,$plugin_id);
    echo <<< EOT
        </td>
    </tr>
EOT;

    // End the table
    endtable();
}


echo "<br />\n";

pagefooter();
ob_end_flush();
?>