<?php
/**************************************************
  Coppermine 1.5.x Plugin - keyword_navigation
  *************************************************
  Copyright (c) 2009 eenemeenemuu
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
    $thisplugin->add_filter('theme_img_navbar','keyboard_navigation');
}

function keyboard_navigation($template_img_navbar) {
    $js = <<<EOT
    <script type="text/javascript">
        var sthhasfocus;
        $(document).ready(function() {
            $('.textinput').focus(function () {sthhasfocus = true;}).blur(function () {sthhasfocus = false;});
            $('select').focus(function () {sthhasfocus = true;}).blur(function () {sthhasfocus = false;});
            $(document).keydown(function(e) {
                if (!e) {
                    e = window.event;
                }
                if (e.which) {
                    kcode = e.which;
                } else if (e.keyCode) {
                    kcode = e.keyCode;
                }
                if (sthhasfocus != true) {
                    if(kcode == 37 && $('#prev').attr('title') != '') {
                        window.location = $('.navmenu_pic img[src*=prev]').parent().attr('href');
                    }
                    if(kcode == 39 && $('#next').attr('title') != '') {
                        window.location = $('.navmenu_pic img[src*=next]').parent().attr('href');
                    }
                    if(kcode == 38) {
                        window.location = $('.navmenu_pic img[src*=thumb]').parent().attr('href');
                    }
                    if(kcode == 40) {
                        blocking('picinfo','yes', 'block');
                        return false;
                    }
                }
            });
        });
    </script>
EOT;

    return $template_img_navbar.$js;
}

?>
