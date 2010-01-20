/**************************************************
  Coppermine 1.5.x Plugin - tentimes
  *************************************************
  Copyright (c) 2010 Timo Schewe (www.timos-welt.de)
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
  
// page is ready loaded
function tt_init()
{
	var tt_numviews = tt_readCookie('cpg_numviews');
	if (!tt_numviews) tt_numviews = 0;
	else tt_numviews = parseInt(tt_numviews);
	tt_numviews +=1;
	tt_createCookie('cpg_numviews',tt_numviews);
	if (tt_numviews > 10) tt_showmessage('','index.php?file=tentimes/message');
}


function tt_showmessage(caption, url, height, width) {
  GB_HEIGHT = height || 400;
  GB_WIDTH = width || 600;
  if(!GB_DONE) {
    $(document.body)
      .append("<div id=\"GB_overlay\"></div><div id=\"GB_window\"><div id=\"GB_caption\" class=\"tableh1\"></div>"
        + "</div>");
    $(window).resize(GB_position);
    $(window).scroll(GB_position);
    GB_DONE = true;
  }

  $("#GB_frame").remove();
  $("#GB_window").append("<iframe id=\"GB_frame\" src=\""+url+"\"></iframe>");

  $("#GB_caption").html(caption);
  $("#GB_overlay").show();
  GB_position();

  if(GB_ANIMATION)
    $("#GB_window").slideDown("slow");
  else
    $("#GB_window").show();
}

// add to window.onload
function tt_addLoad(tt_func) { var tt_oldonload = window.onload; if (typeof window.onload != 'function') { window.onload = tt_func; } else { window.onload = function() { if (tt_oldonload) { tt_oldonload(); } tt_func(); }; } }

function tt_createCookie(tt_name,tt_value) {
    var tt_date = new Date();
    tt_date.setTime(tt_date.getTime()+86400000);
    var tt_expires = "; expires="+tt_date.toGMTString();
    document.cookie = tt_name+"="+tt_value+tt_expires+"; path=/";
}

function tt_readCookie(tt_name) {
    var tt_nameEQ = tt_name + "=";
    var tt_ca = document.cookie.split(';');
    for(var i=0;i < tt_ca.length;i++) 
    {
        var tt_c = tt_ca[i];
        while (tt_c.charAt(0)==' ') tt_c = tt_c.substring(1,tt_c.length);
        if (tt_c.indexOf(tt_nameEQ) == 0) return tt_c.substring(tt_nameEQ.length,tt_c.length);
    }
    return null;
}

tt_addLoad(tt_init);