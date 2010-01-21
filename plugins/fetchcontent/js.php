<?php
/********************************************************
  Coppermine 1.5.x plugin - FetchContent
  *******************************************************
  Copyright (c) 2010 Coppermine dev team
  *******************************************************
  This program is free software; you can redistribute 
  it and/or modify it under the terms of the GNU General
  Public License as published by the Free Software
  Foundation; either version 3 of the License, or 
  (at your option) any later version.
  *******************************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/fetchcontent/image.php $
  $Revision: 7091 $
  $LastChangedBy: gaugau $
  $Date: 2010-01-18 19:32:22 +0100 (Mo, 18. Jan 2010) $
  *******************************************************/
  
if (!defined('IN_COPPERMINE')) { // Make sure this page is not being accessed directly 
    die('Not in Coppermine...');
}

require_once('plugins/fetchcontent/functions.inc.php');

// Sanitize and populate URL parameter variables
$superCage = Inspekt::makeSuperCage();
if ($superCage->get->testAlpha('album')) {
    $album = $superCage->get->getAlpha('album');
} else {
    $album = $superCage->get->getInt('album');
}

if ($superCage->get->keyExists('cols') && $superCage->get->getInt('cols')) {
    $thumbcols = $superCage->get->getInt('cols');
} else {
    $thumbcols = $CONFIG['thumbcols'];
}

if ($superCage->get->keyExists('rows') && $superCage->get->getInt('rows')) {
    $thumbrows = $superCage->get->getInt('rows');
} else {
    $thumbrows = $CONFIG['thumbrows'];
}

if ($superCage->get->keyExists('tableid') && $superCage->get->getAlnum('tableid')) {
    $tableid = 'id="' . $superCage->get->getAlnum('tableid') . '"';
} else {
    $tableid = '';
}

// size = what should be returned, in analogy to the access_level, either 1 = thumbnail, 2 = normal/intermediate, 3 = fullsize
$size = 1; // Default is 1, i.e. thumbnail access
if ($superCage->get->keyExists('size')) {
    if ($superCage->get->getInt('size') == 2) {
        $size = 2;
    } elseif ($superCage->get->getInt('size') == 3) {
        $size = 3;
    }
}

$display_array = fetchcontent_display_thumbnails($album, $superCage->get->getInt('cat'), 1, $thumbcols, $thumbrows, FALSE);
/*
echo '<pre>';
print_r($display_array);
echo '</pre>';
die;
*/




$loopCounter = 1;
echo <<< EOT
document.writeln(' ');
document.writeln('    <table border="1" cellspacing="0" cellpadding="0" class="fc_table" {$tableid}>');
document.writeln('        <tbody>');
EOT;
for ($i = 1; $i <= $thumbrows; $i++) {
    echo <<< EOT
    document.writeln('            <tr class="fc_row">');
EOT;
    for ($j = 1; $j <= $thumbcols; $j++) {
		if ($loopCounter <= $display_array['thumb_count']) {
			// Determine the file type
			$filetype = cpg_get_type($display_array['thumb_list'][$loopCounter]['filename']); // returns an associative array with keys extension, mime, content (possible values: 'image', 'audio', 'movie', 'document') and player.
			// Come up with the image tag
			$image_string = '';
			if ($size == 1) { // Requested files are thumbnail-size
				$image_string .= '<img src="' . $CONFIG['site_url'] . $display_array['thumb_list'][$loopCounter]['thumbpath']. '" ' . $display_array['thumb_list'][$loopCounter]['thumbsize'];
			} else { // Requested file size is bigger than thumbs --- start
				$image_string .= '<img src="' . $CONFIG['site_url'] . $CONFIG['fullpath'] . $display_array['thumb_list'][$loopCounter]['filepath'];
				if ($size == 2) {
					$image_string .= $CONFIG['normal_pfx'];
				}
				$image_string .= $display_array['thumb_list'][$loopCounter]['filename'] . '"';
			} // Requested file size is bigger than thumbs --- end
			if ($display_array['thumb_list'][$loopCounter]['title'] != '') {
				$image_string .= ' title="' . $display_array['thumb_list'][$loopCounter]['title'] . '"';
			} elseif ($display_array['thumb_list'][$loopCounter]['description'] != '') {
				$image_string .= ' title="' . $display_array['thumb_list'][$loopCounter]['description'] . '"';
			} 
			$image_string .= ' border="0" alt="" id="fc_image_' . $loopCounter . '" class="fc_image" />';
			// Requested file is an image and we're not just supposed to display the thumb, but deliver actual content
			if ($filetype['content'] != 'image' && $size != 1) { 
				$image_string = 'Needs to be implemented later';
			}
			// Wrap the link around the image if applicable
			if ($size == 1 && $superCage->get->keyExists('nolink') != TRUE) {
			    $link_target = $CONFIG['site_url'] . 'displayimage.php?';
			    $link_target .= 'album=' . $display_array['thumb_list'][$loopCounter]['aid'] . '&amp;';
			    if ($superCage->get->keyExists('cat')) {
			        $link_target .= 'cat=' . $superCage->get->getInt('cat') . '&amp;';
			    }
			    $link_target .= 'pid=' . $display_array['thumb_list'][$loopCounter]['pid'];
			    $link_target .= '#top_display_media';
			    $image_string = '<a href="' . $link_target . '">' . $image_string;
			    $image_string .= '</a>';
			}
		} else {
			$image_string = '';
		}
		echo <<< EOT
    document.writeln('                <td id="fc_cell_{$loopCounter}" class="fc_cell">');
    document.writeln('                    {$image_string}');
    document.writeln('                </td>');
EOT;
	$loopCounter++;
	}
    echo <<< EOT
    document.writeln('            </tr>');
EOT;
}
echo <<< EOT
document.writeln('        </tbody>');
document.writeln('    </table>');
EOT;
?>