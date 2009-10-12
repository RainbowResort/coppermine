/**************************************************
  Picture Annotation (annotate) plugin for cpg1.5.x
  *************************************************
  Copyright (c) 2003-2009 Coppermine Dev Team

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  *************************************************
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**************************************************/

function annotate_request(data, note){

    if (window.XMLHttpRequest) { // Mozilla, Safari, ...
        var httpRequest = new XMLHttpRequest();
    } else if (window.ActiveXObject) { // IE
        try {
            var httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                var httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
        }
    }

	httpRequest.onreadystatechange = function() { callback(httpRequest, note); };
    httpRequest.open('POST', 'index.php?file=annotate/reqserver', true);
    httpRequest.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    httpRequest.send(data);

	return true;
}

function callback(req, note){

    if (req.readyState == 4) {
        if (req.status == 200) {
        	note.nid = req.responseText;
        }
    }
}
