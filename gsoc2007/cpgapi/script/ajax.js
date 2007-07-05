/*
 * AJAX Library for sending GET requests to host
 * @author xnitingupta
 */

function randomString() {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var string_length = 8;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	return randomstring;
}

function xmlhttpPost(strURL, f) {
  var xmlHttpReq = false;
  var self = this;
  // Mozilla/Safari
  if (window.XMLHttpRequest) {
     self.xmlHttpReq = new XMLHttpRequest();
  }
  // IE
  else if (window.ActiveXObject) {
     self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
  }
  self.xmlHttpReq.open('GET', strURL+"&random="+randomString(), true);
  self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  self.xmlHttpReq.onreadystatechange = function() {
      if (self.xmlHttpReq.readyState == 4) {
          f(self.xmlHttpReq.responseText.replace(/\n/g, '').replace(/\n/g, ''));
      }
  }
  self.xmlHttpReq.send(null);
}