/**************************************************
  Coppermine 1.5.x Plugin - forum
  *************************************************
  Copyright (c) 2010 foulu (Le Hoai Phuong), eenemeenemuu
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
  
function insert_bbcode_tag(begin_tag, end_tag, form, field) {
    var input = document.forms[form].elements[field];
    input.focus();
    if (typeof document.selection != 'undefined') {
        var range = document.selection.createRange();
        var insert_text = range.text;
        range.text = begin_tag + insert_text + end_tag;
        range = document.selection.createRange();
        if (insert_text.length == 0) {
            range.move('character', - end_tag.length);
        } else {
            range.moveStart('character', begin_tag.length + insert_text.length + end_tag.length);      
        }
        range.select();
    } else if (typeof input.selectionStart != 'undefined') {
        var start = input.selectionStart;
        var end = input.selectionEnd;
        var insert_text = input.value.substring(start, end);
        input.value = input.value.substr(0, start) + begin_tag + insert_text + end_tag + input.value.substr(end);
        var pos;
        if (insert_text.length == 0) {
            pos = start + begin_tag.length;
        } else {
            pos = start + begin_tag.length + insert_text.length + end_tag.length;
        }
        input.selectionStart = pos;
        input.selectionEnd = pos;
    } else {
        var pos;
        var re = new RegExp('^[0-9]{0,3}$');
        while (!re.test(pos)) {
            pos = prompt("Insert at position" + input.value.length + "):", "0");
            //pos = prompt(lang_please_enter_text + input.value.length + "):", "0"); // enable when cpg1.5.x is major version
        }
        if (pos > input.value.length) {
            pos = input.value.length;
        }
        var insert_text = prompt("Please enter the text that you want to see formatted:");
        //var insert_text = prompt(lang_insert_at_position); // enable when cpg1.5.x is major version
        input.value = input.value.substr(0, pos) + begin_tag + insert_text + end_tag + input.value.substr(pos);
    }
}
function anchor_confirm(text) {
    answer = confirm(text);
    return answer;
}
function button_confirm(text, link) {
    answer = confirm(text);
    if (answer) {
        window.location.href = link;
    } else {
        return FALSE;
    }
}