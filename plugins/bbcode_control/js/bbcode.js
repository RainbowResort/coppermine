function insert(aTag, eTag, form) {
  var input = document.forms[form].elements['msg_body'];
  input.focus();
  /* f�r Internet Explorer */
  if(typeof document.selection != 'undefined') {
    /* Einf�gen des Formatierungscodes */
    var range = document.selection.createRange();
    var insText = range.text;
    range.text = aTag + insText + eTag;
    /* Anpassen der Cursorposition */
    range = document.selection.createRange();
    if (insText.length == 0) {
      range.move('character', -eTag.length);
    } else {
      range.moveStart('character', aTag.length + insText.length + eTag.length);
    }
    range.select();
  }
  /* f�r neuere auf Gecko basierende Browser */
  else if(typeof input.selectionStart != 'undefined')
  {
    /* Einf�gen des Formatierungscodes */
    var start = input.selectionStart;
    var end = input.selectionEnd;
    var insText = input.value.substring(start, end);
    input.value = input.value.substr(0, start) + aTag + insText + eTag + input.value.substr(end);
    /* Anpassen der Cursorposition */
    var pos;
    if (insText.length == 0) {
      pos = start + aTag.length;
    } else {
      pos = start + aTag.length + insText.length + eTag.length;
    }
    input.selectionStart = pos;
    input.selectionEnd = pos;
  }
  /* f�r die �brigen Browser */
  else
  {
    /* Abfrage der Einf�geposition */
    var pos;
    var re = new RegExp('^[0-9]{0,3}$');
    while(!re.test(pos)) {
      pos = prompt(lang_insert_at_position + " (0.." + input.value.length + "):", "0");
    }
    if(pos > input.value.length) {
      pos = input.value.length;
    }
    /* Einf�gen des Formatierungscodes */
    var insText = prompt(lang_please_enter_text + ":");
    input.value = input.value.substr(0, pos) + aTag + insText + eTag + input.value.substr(pos);
  }
}