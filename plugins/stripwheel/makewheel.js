/**************************************************
  Coppermine 1.5.x Plugin - Mouse wheel support for filmstrip $VERSION$=0.1
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ***************************************************/


  jQuery(function($) {
    $(document).ready(function() {
      $('#filmstrip').bind('mousewheel', function(event, delta) {
              if (delta > 0)
              {
                if ($('#filmstrip_prev').is(":visible")) $('#filmstrip_prev').click();
              }
              else
              {
                if ($('#filmstrip_next').is(":visible")) $('#filmstrip_next').click();
              }
              return false;
          });
      try { $('#filmstrip').css("cursor", 'url(plugins/stripwheel/mousescroll.cur),e-resize')} catch(woschd_err) {}

    });
  });
  
