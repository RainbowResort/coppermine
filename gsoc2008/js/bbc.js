
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
			var scrollPos = this.scrollTop;
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
			
			if(close=="[/color]"){
				open = open.replace("black",myValue);
			}

	
		//.focus();



			this.value = this.value.substring(0, startPos) + open + myValue + close + this.value.substring(endPos,this.value.length);
			
			if (this.setSelectionRange || myValue.length==0){
				this.focus();
				this.setSelectionRange(startPos + open.length, startPos + open.length);
			}
			
			if(this.setSelectionRange && myValue.length>0){
				this.focus();
				this.setSelectionRange(startPos + ((open + myValue + close).length), startPos +(open + myValue + close).length  );
			}
			this.scrollTop = scrollPos;
			//this.selectionStart = startPos + myValue.length;
			//this.selectionEnd = startPos + myValue.length;
			
		}
		else {
			this.value += myValue;
			this.focus();
		}
	});
}

$(document).ready(function() {
	
	$('.choose_color').click(function(){
		editRel = $(this).attr('rel');

		editBox = $("#comment_box"+editRel).children();
		editTitle = $(this).attr('bgcolor');
		
		if(editTitle[0] == '#'){
			editTitle = editTitle.toUpperCase();
		}
			
		if(editBox) editBox.insertTags('[color='+ editTitle +']','[/color]', '');
		$('#dsrte-color'+editRel).slideUp(); 
		
		
	});
	
	$('img.bb_img').click(function() {
		editRel = $(this).attr('rel');

		// getting the text area
		editBox = $("#comment_box"+editRel).children();

		// getting the id
		editId = $(this).attr('id');
		//alert(editId);
		editTitle = $(this).attr('title');

		if (editId == "bb_bold"+editRel ) editBox.insertTags('[b]','[/b]', editTitle);
		else if (editId == "bb_italic"+editRel ) editBox.insertTags('[i]','[/i]', editTitle);
		else if (editId == "bb_underline"+editRel ) editBox.insertTags('[u]','[/u]', editTitle);
		else if (editId == "bb_url" +editRel ) editBox.insertTags('[url=http://www.domain.com]','[/url]', editTitle);
		else if (editId == "bb_img"+ editRel) editBox.insertTags('[img]','[/img]', 'http://domain.com/image.jpg');
		else if (editId == "bb_email"+editRel ) editBox.insertTags('[email]','[/email]',editTitle);
		
	});
	

});