/**************************************************
  Coppermine 1.5.x Plugin - skype_demarkup
  *************************************************
  Copyright (c) 2010 eenemeenemuu
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

// Function copied from http://www.petefreitag.com/item/751.cfm

function demark() {
    $('.skype_pnh_container').html('');
    $('.skype_pnh_print_container').removeClass('skype_pnh_print_container');
}

$(document).ready(function() {
    window.setTimeout(demark, 250);
    window.setTimeout(demark, 500);
    window.setTimeout(demark, 1000);
    window.setTimeout(demark, 2000);
});