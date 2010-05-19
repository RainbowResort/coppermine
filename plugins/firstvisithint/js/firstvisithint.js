/**************************************************
  Coppermine 1.5.x Plugin - firstvisithint
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
function fvh_init()
{
	var fvh_numviews = fvh_readCookie('cpg_firstvisit');
	if (!fvh_numviews)
	{
	  fvh_createCookie('cpg_firstvisit',1);
	  GB_show('','index.php?file=firstvisithint/message');
    }
}


// add to window.onload
function fvh_addLoad(fvh_func) { var fvh_oldonload = window.onload; if (typeof window.onload != 'function') { window.onload = fvh_func; } else { window.onload = function() { if (fvh_oldonload) { fvh_oldonload(); } fvh_func(); }; } }

function fvh_createCookie(fvh_name,fvh_value) {
    var fvh_date = new Date();
    fvh_date.setTime(fvh_date.getTime()+86400000);
    var fvh_expires = "; expires="+fvh_date.toGMTString();
    document.cookie = fvh_name+"="+fvh_value+fvh_expires+"; path=/";
}

function fvh_readCookie(fvh_name) {
    var fvh_nameEQ = fvh_name + "=";
    var fvh_ca = document.cookie.split(';');
    for(var i=0;i < fvh_ca.length;i++) 
    {
        var fvh_c = fvh_ca[i];
        while (fvh_c.charAt(0)==' ') fvh_c = fvh_c.substring(1,fvh_c.length);
        if (fvh_c.indexOf(fvh_nameEQ) == 0) return fvh_c.substring(fvh_nameEQ.length,fvh_c.length);
    }
    return null;
}

fvh_addLoad(fvh_init);