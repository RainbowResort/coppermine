<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision: 5099 $
  $LastChangedBy: gaugau $
  $Date: 2008-10-09 22:47:22 +0530 (Thu, 09 Oct 2008) $
**********************************************/

define('IN_COPPERMINE',1);
define('VIEWLOG_PHP',1);

require('include/init.inc.php');

	$folder_icon = cpg_fetch_icon('folder', 0);
    $delete_all_icon = cpg_fetch_icon('delete', 2);
    $delete_this_icon = cpg_fetch_icon('erase', 2);
    $view_icon = cpg_fetch_icon('file', 2);

function display_log_list()
{
	global $lang_viewlog_php, $folder_icon, $delete_all_icon, $delete_this_icon, $view_icon;

	$log_list = getloglist('logs/');
	if (count($log_list)>0) {
			foreach ($log_list as $log) {
					echo <<<EOT
								<tr>
										<td class="tableb">
												{$folder_icon}&nbsp;<a href= "{$CPG_PHP_SELF}?log={$log['logname']}">{$log['logname']}</a>
												&nbsp;&nbsp;&nbsp; ( <i>{$log['filesize']} KB</i> )
										</td>
								</tr>
EOT;
			}
			echo <<<EOT
								<tr>
										<td class="tableb" align="center">
												<!--<input class="button" type="button" value="{$lang_viewlog_php['delete_all']}" name="dall" id="dall" onclick="window.location='viewlog.php?action=dall';" />-->
                                                <button type="button" class="button" name="dall" value="{$lang_viewlog_php['delete_all']}" id="dall" onclick="window.location='viewlog.php?action=dall';">{$delete_all_icon}{$lang_viewlog_php['delete_all']}</button>
										</td>
								</tr>
EOT;
	} else {
			cpg_die(INFORMATION,$lang_viewlog_php['no_logs'], __FILE__,1);
	}
}

function display_log($logname)
{
		global $lang_viewlog_php, $folder_icon, $delete_all_icon, $delete_this_icon, $view_icon;

		echo <<<EOT
				<tr>
						<td class="tableb" align="center">
                                <button type="button" class="button" name="dall" value="{$lang_viewlog_php['delete_all']}" id="dall" onclick="window.location='viewlog.php?action=dall';">{$delete_all_icon}{$lang_viewlog_php['delete_all']}</button>
                                <button type="button" class="button" value="{$lang_viewlog_php['view_logs']}" name="back1" id="back1" onclick="window.location='viewlog.php';">{$view_icon}{$lang_viewlog_php['view_logs']}</button>
                                <button class="button" type="button" value="{$lang_viewlog_php['delete_this']}" name="dthis1" id="dthis1" onclick="window.location='viewlog.php?action=dthis&amp;log=$logname';">{$delete_this_icon}{$lang_viewlog_php['delete_this']}</button>
						</td>
				</tr>
				<tr>
						<td class="tableb">
								<pre>
EOT;
		log_read($logname);
		echo <<<EOT
								</pre>
						</td>
				</tr>
				<tr>
						<td class="tableb" align="center">
								<button class="button" type="button" value="{$lang_viewlog_php['delete_all']}" name="dall2" id="dall2" onclick="window.location='viewlog.php?action=dall';" />{$delete_all_icon}{$lang_viewlog_php['delete_all']}</button>
								<button class="button" type="button" value="{$lang_viewlog_php['view_logs']}" name="back2" id="back2" onclick="window.location='viewlog.php';" />{$view_icon}{$lang_viewlog_php['view_logs']}</button>
								<button class="button" type="button" value="{$lang_viewlog_php['delete_this']}" name="dthis2" id="dthis2" onclick="window.location='viewlog.php?action=dthis&amp;log=$logname';" />{$delete_this_icon}{$lang_viewlog_php['delete_this']}</button>
						</td>
				</tr>

EOT;
}

$log = $superCage->get->getAlpha('log');
$action = $superCage->get->getAlpha('action');

pageheader('Logs :: '.$log);

if (!$USER_DATA['has_admin_access']) {
		// Write access attempt to 'security' log file
		if ($CONFIG['log_mode']) {
				log_write('Denied privileged access to viewlog.php from user '.$USER_DATA['user_name'].' at ' . $hdr_ip .' on '.date("F j, Y, g:i a"),CPG_SECURITY_LOG);
		}
		cpg_die(CRITICAL_ERROR,$lang_errors['access_denied'], __FILE__,1);
}

starttable("100%", cpg_fetch_icon('view_logs', 2) . "Logs :: ".$log);


if (isset($action)) {
		if ($action=='dthis' && isset($log)) {
				log_delete($log);
				unset($log);
		} elseif ($action=='dall') {
				unset($log);
				log_delete();
		}
}

// If log variable not set or log file's directory is not current directory then display logs list else display log with given name stripping risky characters from it
if (!isset($log) || dirname($log) != '.') {
	display_log_list();
} else {
	display_log(ereg_replace('\.|/|%00', '', $log));
}

endtable();
pagefooter();
?>