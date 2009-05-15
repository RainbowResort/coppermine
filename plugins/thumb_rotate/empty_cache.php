<?php
// Initialize language and icons
require_once './plugins/thumb_rotate/init.inc.php';
$thumb_rotate_init_array = thumb_rotate_initialize();
$lang_plugin_thumb_rotate = $thumb_rotate_init_array['language']; 
$thumb_rotate_icon_array = $thumb_rotate_init_array['icon'];
$records_processed_per_pageload = 100;
$result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}plugin_thumb_rotate");
list($cached_files_total) = mysql_fetch_row($result);
mysql_free_result($result);

if ($cached_files_total > $records_processed_per_pageload) {
	$meta_refresh = '<meta http-equiv="refresh" content="1; URL=index.php?file=thumb_rotate/empty_cache" />';
	$message_output = sprintf($lang_plugin_thumb_rotate['wait'], '<strong>' . $cached_files_total . '</strong>');
} else {
	$meta_refresh = '';
	$message_output = <<< EOT
	<strong>{$lang_common['done']}</strong>
	<br />&nbsp;<br />
	<a href="index.php?file=thumb_rotate/index" class="admin_menu">{$thumb_rotate_icon_array['ok']}{$lang_common['ok']}</a>
EOT;
}

// Empty the cache
 if (!GALLERY_ADMIN_MODE) {
   	cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

pageheader($lang_plugin_thumb_rotate['config_name'] .'-' . $lang_plugin_thumb_rotate['empty_cache'], $meta_refresh);
echo <<< EOT
<h1>{$lang_plugin_thumb_rotate['empty_cache']}</h1>
EOT;
$result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_thumb_rotate LIMIT {$records_processed_per_pageload}");
$loopCounter = 0;
while ($row = mysql_fetch_assoc($result)) {
	$delete_array[$row['pid']] = $row['filepath'];
}
mysql_free_result($result);
foreach ($delete_array as $key => $value) {
	if ($loopCounter/2 == floor($loopCounter/2)) {
		$cellstyle = 'tableb';
	} else {
		$cellstyle = 'tableb tableb_alternate';
	}
	if (is_file($CONFIG['fullpath'] . $value)) {
		$delete = cpg_folder_file_delete($CONFIG['fullpath'] . $value);
	}
	$result = cpg_db_query("DELETE FROM {$CONFIG['TABLE_PREFIX']}plugin_thumb_rotate WHERE `pid` = {$key}");
	echo '<div class="'.$cellstyle.'">';
	if (file_exists($CONFIG['fullpath'] . $value)){
		echo $thumb_rotate_icon_array['cancel'];
	} else {
		echo $thumb_rotate_icon_array['ok'];
	}
	echo $CONFIG['fullpath'] . $value . '</div>';
	$loopCounter++;
}
echo <<< EOT
<a name="result"></a>
<br />
{$message_output}
EOT;
if ($cached_files_total <= $records_processed_per_pageload) {
	cpg_db_query("TRUNCATE TABLE `{$CONFIG['TABLE_PREFIX']}plugin_thumb_rotate`");
}
pagefooter();
die;
?>