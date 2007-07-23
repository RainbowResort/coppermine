
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
    httpRequest.open('POST', 'include/tag/reqserver.php', true);
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
