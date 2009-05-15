<?php
// Initialize language and icons
require_once './plugins/thumb_rotate/init.inc.php';
$thumb_rotate_init_array = thumb_rotate_initialize();
$lang_plugin_thumb_rotate = $thumb_rotate_init_array['language']; 
$thumb_rotate_icon_array = $thumb_rotate_init_array['icon'];
// No access for non-admins
 if (!GALLERY_ADMIN_MODE) {
   	cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}
// Number of cached files
$result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}plugin_thumb_rotate");
list($cached_files_total) = mysql_fetch_row($result);
mysql_free_result($result);
// Number of files in pictures table
$result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']}");
list($image_files_total) = mysql_fetch_row($result);
mysql_free_result($result);
// Query the pictures table for unique pids that only reside in the pictures table, but not in the cache table
$result = cpg_db_query("SELECT DISTINCT * FROM {$CONFIG['TABLE_PICTURES']} WHERE pid NOT IN (SELECT {$CONFIG['TABLE_PREFIX']}plugin_thumb_rotate.pid FROM {$CONFIG['TABLE_PREFIX']}plugin_thumb_rotate) LIMIT 1");

// Loop if there are still files to cache
$remaining_files = $image_files_total - $cached_files_total;
if ($remaining_files > 0) {
	$meta_refresh = '<meta http-equiv="refresh" content="' . $CONFIG['plugin_thumb_rotate_timelimit'] . '; URL=index.php?file=thumb_rotate/batch_fill" />';
} else {
	$message = cpgStoreTempMessage($lang_plugin_thumb_rotate['batch_fill'].': '.$lang_common['done']);
	$meta_refresh = '<meta http-equiv="refresh" content="0; URL=index.php?file=thumb_rotate/index&message_id=' . $message . '&message_icon=success" />';
}
pageheader($lang_plugin_thumb_rotate['config_name'] .'-' . $lang_plugin_thumb_rotate['batch_fill'], $meta_refresh);

$CURRENT_PIC_DATA = mysql_fetch_assoc($result);
$CURRENT_PIC_DATA['extension'] = ltrim(substr($CURRENT_PIC_DATA['filename'], strrpos($CURRENT_PIC_DATA['filename'], '.')), '.');
$CURRENT_PIC_DATA['filename_without_extension'] = str_replace('.' . $CURRENT_PIC_DATA['extension'], '', $CURRENT_PIC_DATA['filename']);
if ($remaining_files > 0) {
	$created_image_array = thumb_rotate_image_create($CURRENT_PIC_DATA);
}
if ($created_image_array['path'] != '') {
	$result = cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_PREFIX']}plugin_thumb_rotate ( `pid` , `filepath`, `width`, `height` ) VALUES ('{$CURRENT_PIC_DATA['pid']}', '{$created_image_array['path']}', '{$created_image_array['width']}', '{$created_image_array['height']}');");
	$remaining_files--;
}
$remaining_output = theme_display_bar($remaining_files,$image_files_total,600,'', '', sprintf($lang_plugin_thumb_rotate['x_files_remaining'], '/' . $image_files_total,'red','green'));
// Display the rotated thumb we just created
starttable('100%', $thumb_rotate_icon_array['batch'] . $lang_plugin_thumb_rotate['batch_fill'], 3);
$max_dimension = max($CONFIG['thumb_width'], $CONFIG['thumb_height']) + 10;
$random = uniqid(rand());
if (defined('THEME_HAS_PROGRESS_GRAPHICS')) {
    $prefix = $THEME_DIR;
} else {
    $prefix = '';
}
$loader = '<img src="' . $prefix . 'images/loader.gif" border="0" alt="" />';
if ($remaining_files > 0) {
	echo <<< EOT
	<tr>
		<td class="tableb" rowspan="8" style="width:30%;height:{$max_dimension}">
			<img src="{$CONFIG['fullpath']}{$created_image_array['path']}" border="0" width="{$created_image_array['width']}" height="{$created_image_array['height']}" class="image" style="border:none" alt="" />
		</td>
		<td class="tableh2" colspan="2">
			{$lang_common['information']}
		</td>
	</tr>
	<tr>
		<td class="tableb">
			{$lang_common['album']}
		</td>
		<td class="tableb">
			<a href="thumbnails.php?album={$CURRENT_PIC_DATA['aid']}">{$CURRENT_PIC_DATA['aid']}</a>
		</td>
	</tr>
	<tr>
		<td class="tableb tableb_alternate">
			{$lang_common['file']}
		</td>
		<td class="tableb tableb_alternate">
			<a href="javascript:;" onclick="MM_openBrWindow('displayimage.php?pid={$CURRENT_PIC_DATA['pid']}&amp;fullsize=1','{$random}','scrollbars=yes,toolbar=no,status=no,resizable=yes,width={$CURRENT_PIC_DATA['pwidth']},height={$CURRENT_PIC_DATA['pheight']}')">{$CONFIG['site_url']}{$CONFIG['fullpath']}{$CURRENT_PIC_DATA['filepath']}{$CURRENT_PIC_DATA['filename']}</a>
		</td>
	</tr>
	<tr>
		<td class="tableb">
			PID
		</td>
		<td class="tableb">
			<a href="displayimage.php?album={$CURRENT_PIC_DATA['aid']}&pid={$CURRENT_PIC_DATA['pid']}">{$CURRENT_PIC_DATA['pid']}</a>
		</td>
	</tr>
	<tr>
		<td class="tableb tableb_alternate">
			{$lang_common['owner_name']}
		</td>
		<td class="tableb tableb_alternate">
			<a href="profile.php?uid={$CURRENT_PIC_DATA['owner_id']}">{$CURRENT_PIC_DATA['owner_name']}</a>
		</td>
	</tr>
	<tr>
		<td class="tableb">
			{$lang_common['title']}
		</td>
		<td class="tableb">
			{$CURRENT_PIC_DATA['title']}
		</td>
	</tr>
	<tr>
		<td class="tableb tableb_alternate">
			{$lang_common['caption']}
		</td>
		<td class="tableb tableb_alternate">
			{$CURRENT_PIC_DATA['caption']}
		</td>
	</tr>
	<tr>
		<td class="tableb">
			{$lang_plugin_thumb_rotate['manual_control']}
		</td>
		<td class="tableb">
			<a href="index.php?file=thumb_rotate/index" class="admin_menu">{$thumb_rotate_icon_array['cancel']}{$lang_plugin_thumb_rotate['cancel']}</a> &bull; <a href="index.php?file=thumb_rotate/batch_fill" class="admin_menu">{$thumb_rotate_icon_array['next']}{$lang_common['continue']}</a> ({$lang_plugin_thumb_rotate['manual_control_explain']})
		</td>
	</tr>
	<tr>
		<td class="tablef">
			{$loader}
		</td>
		<td class="tablef" colspan="2">
			{$remaining_output}
		</td>
	</tr>
EOT;
} else {
	echo <<< EOT
	<tr>
		<td class="tablef" colspan="3">
			{$lang_common['done']}
			<a href="index.php?file=thumb_rotate/index" class="admin_menu">{$thumb_rotate_icon_array['ok']}{$lang_common['ok']}</a>
		</td>
	</tr>
EOT;
}
endtable();
 


pagefooter();
die;


?>