<?php

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_filter('file_data','facebook_file_data');


function facebook_file_data($CURRENT_PIC_DATA){

	global $CONFIG;

//	print_r ($CURRENT_PIC_DATA);
	
	if (is_image($CURRENT_PIC_DATA['filename'])){

		$html =& $CURRENT_PIC_DATA['html'];

		$html = '<div class="Photo fn-container" id="PhotoContainer">' . $html . '</div>';
		
                $html .= <<< EOT
		


EOT;

		
		
		$html .= <<< EOT
		
		<div style="clear: both; padding-top: 10px; padding-bottom: 10px">
			<style> html .fb_share_link { padding:2px 0 0 20px; height:216px; }</style><a href="http://www.facebook.com/sharer.php?u={$CONFIG['site_url']}{$CURRENT_PIC_DATA['url']}&{$CURRENT_PIC_DATA['title']}" TARGET="_blank" onclick="window.open(this.href,'window','width=626,height=436,resizable') ;return false;"><img src="plugins/facebook/facebook_share_button.jpg" width=75 height=33 /></a>
		</div>

EOT;


		

		


	}

	return $CURRENT_PIC_DATA;
}


?>
