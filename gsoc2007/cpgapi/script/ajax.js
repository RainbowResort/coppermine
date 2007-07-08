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


/* 
 * XML function: gets the element corresponding to the tagname from xmldoc
 * @ xmldoc
 * @ tagname
 */
function xmlParserGet(xmldoc, tagname) {
   for(var i = 0; i < xmldoc.contents.length; i++) {
      if(xmldoc.contents[i].type == "element")
         if(xmldoc.contents[i].name == tagname) return xmldoc.contents[i];
   }
   return null;
}


/* 
 * XML function: gets the content of element corresponding to the tagname from xmldoc
 * @ xmldoc
 * @ tagname
 */
function xmlParserGetValue(xmldoc, tagname) {
   for(var i = 0; i < xmldoc.contents.length; i++) {
      if (xmldoc.contents[i].type == "element") {
         if (xmldoc.contents[i].name == tagname) {
            return xmldoc.contents[i].contents[0].value;
         }
      }
   }
   return null;
}

/* 
 * XML function: gets the element corresponding to the tagname from xmldoc
 * @ xmldoc
 * @ tagname
 */
function xmlParserGetLong(xmldoc, tagname) {
   if (tagname == "") {
      return xmldoc;
   }

   var toSearch = "";
   var pos = tagname.indexOf('.');
   if(pos == -1) { toSearch = tagname; pos = toSearch.length; }
   else toSearch = tagname.substring(0, pos);
 
   for(var i = 0; i < xmldoc.contents.length; i++) {
      if (xmldoc.contents[i].type == "element")
         if (xmldoc.contents[i].name == toSearch) 
            return xmlParserGetLong(xmldoc.contents[i], tagname.substring(pos+1));
   }
   return null;
}

/* 
 * XML function: gets the element corresponding to the tagname from xmldoc
 * @ xmldoc
 * @ tagname
 */
function xmlParserGetLongValue(xmldoc, tagname) {
   if (tagname == "") {
      if(xmldoc.contents.length == 0) return "";
      else return xmldoc.contents[0].value;
   }
   var toSearch = "";
   var pos = tagname.indexOf('.');
   if(pos == -1) { toSearch = tagname; pos = toSearch.length; }
   else toSearch = tagname.substring(0, pos);

   for(var i = 0; i < xmldoc.contents.length; i++) {
      if (xmldoc.contents[i].type == "element")
         if (xmldoc.contents[i].name == toSearch) 
            return xmlParserGetLongValue(xmldoc.contents[i], tagname.substring(pos+1));
   }
   return "";
}

