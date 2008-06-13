
$.fn.insertTags = function (open, close, myValue) {
	return this.each(function(){
		//IE support
		if (document.selection) {
			this.focus();
			sel = document.selection.createRange();
			if (sel.text != '') myValue = sel.text;

			if (close == "[/url]") {
				var link=prompt("Enter the URL","http://");
				open = open.replace("http://www.domain.com", link);

				if (!sel.text) {
					var linkText=prompt("Enter the URL Title","");
					myValue = linkText;
				}
			}

			sel.text = open+myValue+close;
			this.focus();
		}

		//MOZILLA/NETSCAPE support
		else if (this.selectionStart || this.selectionStart == '0') {
			var startPos = this.selectionStart;
			var endPos = this.selectionEnd;
			var scrollTop = this.scrollTop;
			mySel = this.value.substring(startPos, endPos);

			if (mySel != '') myValue = mySel;

			if (close == "[/url]") {
				var link=prompt("Enter the URL","http://");
				open = open.replace("http://www.domain.com", link);

				// checking if any text was selected
				if (endPos-startPos == 0) {
					var linkText=prompt("Enter the URL Title","");
					myValue = linkText;
				}
			}

			this.value = this.value.substring(0, startPos) + open + myValue + close + this.value.substring(endPos,this.value.length);
			this.focus();
			this.selectionStart = startPos + myValue.length;
			this.selectionEnd = startPos + myValue.length;
			this.scrollTop = scrollTop;
		}
		else {
			this.value += myValue;
			this.focus();
		}
	});
}

$(document).ready(function() {
	$('img.bb_img').click(function() {
		// getting the text area
		editBox = $(this).parent().parent().next();

		// getting the id
		editId = $(this).attr('id');
		editTitle = $(this).attr('title');

		if (editId == "bb_bold") editBox.insertTags('[b]','[/b]', editTitle);
		else if (editId == "bb_italic") editBox.insertTags('[i]','[/i]', editTitle);
		else if (editId == "bb_underline") editBox.insertTags('[u]','[/u]', editTitle);
		else if (editId == "bb_url") editBox.insertTags('[url=http://www.domain.com]','[/url]', editTitle);
		else if (editId == "bb_img") editBox.insertTags('[img]','[/img]', 'http://domain.com/image.jpg');
	});
});