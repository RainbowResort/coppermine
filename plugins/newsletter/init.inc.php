<?php
function newsletter_initialize() {
	global $CONFIG, $JS, $lang_plugin_newsletter, $newsletter_icon_array;
	$superCage = Inspekt::makeSuperCage();
	
	$JS['includes'][] = 'js/jquery.spinbutton.js';
	$JS['includes'][] = 'plugins/newsletter/js/script.js';
	
	require "./plugins/newsletter/lang/english.php";
	if ($CONFIG['lang'] != 'english' && file_exists("./plugins/newsletter/lang/{$CONFIG['lang']}.php")) {
	    require "./plugins/newsletter/lang/{$CONFIG['lang']}.php";
	}
	if ($CONFIG['enable_menu_icons'] == 2) {
		$newsletter_icon_array['config'] = '<img src="./plugins/newsletter/images/icons/config.png" width="16" height="16" border="0" alt="" class="icon" />';
		$newsletter_icon_array['announcement'] = '<img src="./plugins/newsletter/images/icons/announcement.png" width="16" height="16" border="0" alt="" class="icon" />';
	} else {
		$newsletter_icon_array['config'] = '';
		$newsletter_icon_array['announcement'] = '';
	}
	$newsletter_icon_array['newsletter'] = cpg_fetch_icon('news_show', 2);
	$newsletter_icon_array['catlist'] = cpg_fetch_icon('news_show', 1);
	$newsletter_icon_array['plugin_manager'] = cpg_fetch_icon('plugin_mgr', 2);
	$newsletter_icon_array['ok'] = cpg_fetch_icon('ok', 2);
	$newsletter_icon_array['cancel'] = cpg_fetch_icon('cancel', 2);
	$newsletter_icon_array['edit'] = cpg_fetch_icon('edit', 0);
	$newsletter_icon_array['delete'] = cpg_fetch_icon('delete', 0);
	$newsletter_icon_array['add'] = cpg_fetch_icon('add', 2);
	$return['language'] = $lang_plugin_newsletter;
	$return['icon'] = $newsletter_icon_array;
	return $return;
}

function newsletter_frequency_words() {
	global $lang_plugin_newsletter;
	$frequency_words = array(
	                   '1' => 'frequency_once_year',
					   '2' => 'frequency_twice_year',
					   '12' => 'frequency_once_month',
					   '24' => 'frequency_twice_month',
					   '52' => 'frequency_once_week',
					   '360' => 'frequency_once_day',
					   );
	return $frequency_words;
}

function newsletter_frequency_options($highlighted = '0') {
	global $LINEBREAK, $lang_plugin_newsletter;
	$return = '';
	$frequency_words = array(
	                   '1'   => $lang_plugin_newsletter['frequency_once_year'],
					   '2'   => $lang_plugin_newsletter['frequency_twice_year'],
					   '3'   => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 3),
					   '4'   => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 4),
					   '5'   => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 5),
					   '6'   => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 6),
					   '7'   => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 7),
					   '8'   => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 8),
					   '9'   => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 9),
					   '10'  => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 10),
					   '12'  => $lang_plugin_newsletter['frequency_once_month'],
					   '24'  => $lang_plugin_newsletter['frequency_twice_month'],
					   '52'  => $lang_plugin_newsletter['frequency_once_week'],
					   '100' => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 100),
					   '360' => $lang_plugin_newsletter['frequency_once_day'],
					   );
	foreach ($frequency_words as $key => $value) {
	    $return .= '			<option value="' . $key . '"';
	    if ($key == $highlighted) {
	        $return .= ' selected="selected"';
	    }
	    $return .= '>' . $value . '</option>' . $LINEBREAK;
	}
	return $return;
}
?>