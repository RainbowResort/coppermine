<?php
/**************************************************
  Coppermine 1.5.x Plugin - image preloader
  *************************************************
  Copyright (c) 2009-2010 eenemeenemuu
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (defined('DISPLAYIMAGE_PHP')) {
    $thisplugin->add_filter('file_data','preload_file_data');
}

function preload_file_data($data) {
    // add preload container
    $data['html'] .= '<div id="preload_container" style="display:none;"></div>';

    // load full size image
    if ($data['mode'] != "fullsize") {
        global $CONFIG;
        $data['html'] .= <<<EOT
        <script type="text/javascript">
            $(window).load(function() {
                $('#preload_container').html('<img src="{$CONFIG['fullpath']}{$data['filepath']}{$data['filename']}" />');
            });
        </script>
EOT;
    }

    // load prev/next/filmstrip images
    $data['html'] .= <<<EOT
    <script type="text/javascript">
        $(window).load(function() {
            var urls = '';
            $('a:not([href*={$data['pid']}])[href*=pid]').each( function (i) { urls += $(this).attr('href'); });
            $.get('index.php?file=preload/ajax', {urls:urls}, function(data) { $('#preload_container').html($('#preload_container').html() + data); });
        });
    </script>
EOT;

    return $data;
}

?>
