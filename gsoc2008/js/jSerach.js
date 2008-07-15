$(document).ready(function(){

	//function serachUp(inputString) {
	
		var jId = "#suggestionContainer";
		var setArray = "";
		var jH = ".jSuggestHover";
		var jsH = "jSuggestHover";
		
		$("body").append('<div id="suggestionContainer"></div>');
		$(jId).hide();
		
		//$("input.serachUp").keyup(function(event){
		$("input.serachUp").bind("click", function(event){
				$.getJSON("keyword_select.php?ajax_key=1", function(data){
						if(data['keywords']['0']) {
							numberElement = data['keywords'].length;
							setArray  = new Array(numberElement);
							for(var i=0; i<data['keywords'].length; i++ ){
								setArray[i]= data['keywords'][i];
							}
						}
				});
								
		});
		
		
		$("input.serachUp").bind("keyup", function(e){
		var inputString = $(this).val();
		var inputBoxId = $(this).attr('id');
		
		if(inputString.length != 0) {
		// Hide the suggestion box.
			var offSet = $(this).offset(); 
			var $content ="";
			
			$(jId).css({
					position: "absolute",
					top: offSet.top + $(this).outerHeight() + "px",
					left: offSet.left,
					width: $(this).outerWidth()-2 + "px",
					zIndex: 20000,
				}).show();
				
				if(setArray) {				
					$content += "<ul id='seach_box'>";
					for(var i=0; i< setArray.length ; i++){
						$content += "<li>"+ setArray[i] + "</li>";
					}
					$content += "</ul>";
					
			$("#suggestionContainer").show();
			$(jId).find('ul').remove();
			$(jId).append($content);
			
								$("#suggestionContainer ul li").bind("mouseover",	function(){
										$(jH).removeClass(jsH);
										$(this).addClass(jsH);
								});
								
								$("#suggestionContainer ul li").click(function(){
									//$(this).addClass(jsH);
									textVal = $(this).text();
									var	getValueOfCurrentbox = $("input[name='"+inputBoxId+"']").attr("value");
									if(getValueOfCurrentbox.lenght ==0 ){
										setValue = textVal;
									}else{
										setValue = getValueOfCurrentbox + " " +textVal;
									}									
									$("input[name='"+inputBoxId+"']").val(setValue);
									$("input[name='"+inputBoxId+"']").focus();

								});	
				}
			
		}
});	

	//} // lookup
	$("input.serachUp").blur(function(){
		setTimeout("$('#suggestionContainer').hide();",200);	
	});
	$("a.dicttionary").click(function(){
			
			$.blockUI({ css: {
        		border: 'none', 
        		padding: '20px', 
        		backgroundColor: '#333333', 
        		'-webkit-border-radius': '10px', 
        		'-moz-border-radius': '10px', 
        		color: '#FFF' 
    		} }); 
    		
    	$("body").append('<div id="dictionary_message"></div>');
		$("#dictionary_message").hide();
		
   	 $.ajax({
  		type: "POST",
   		url: "keyword_create_dict.php",
   		success: function(msg){
   			var message_dic ="<p style='position:relative;text-align:center;top:7px; color: #c00000; font-size:14px'><strong>Keyword dictionary updated..</strong></p>"; 
			    
			   $("#dictionary_message").css({
					position: "absolute",
					top:"0px",
					textAlign: "center",
					zIndex: 20000,
					width: "100%",
					height: '30px',
					backgroundColor: '#F4F1DF',
					borderBottom: '3px solid #E1DAB7',
					position: "fixed"
			}).show();
			
			$("#dictionary_message").show();
			$("#dictionary_message").find('p').remove();
			$("#dictionary_message").append(message_dic);	
     		setTimeout($.unblockUI);
     		setTimeout(function () {
				$("#dictionary_message").fadeOut("slow");
			},5000); 

     		
   			}
 		});
	});
});