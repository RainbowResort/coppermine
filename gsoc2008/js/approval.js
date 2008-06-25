/**
 * @author sameera
 *
 **/

  	$(document).ready(function(){	
		
		var get_link = '';
		var message_ID ='';
		var action ='';		
		
		//click the approves DOM and cheack the it's values
	    	$(".approves").click(function(){
							
			get_link = $(this).attr('href');	
			message_ID = $(this).attr('rel');
			title = $(this).attr('title');
				//if approve titile set to the variables in order to call getTwo and getOne functions
				if(title=="approve"){
					var temp = getTwo;
					action="approve";
				}	
				//if title disapprove set to the variables temp and cation disapporve...
				if(title=="disapprove"){
					var temp = getOne;
					action = "disapprove";
				}
					
				//alert(a+"dis");
				// first execut the get ajax call and the pop up the dialog box
			$.get(get_link+"&what="+action, {}, function(data) {
			$("#dialog").html(data);
				//set property to the dispalyed dialog box..
			$("#dialog").dialog({
				draggable:false,
 				resizable:false,
 				title: 'Disapproval Window',
				width: 410, 
				height: 300,
				buttons: { "Ok": temp , "Cancel": function() { $(this).dialog("close"); } }
								
			});			
		});
		return false;
	});
	
				
		function getOne (){	
		
			$.get(get_link+"&what=disapprove&action=1",{},function(message){
				if (message == "ok") {
					
					$("a#"+message_ID).attr({
						title: "approve"
					});
					$("#image"+message_ID).attr({
						src: "images/approve.gif"
					})
					$("#"+message_ID).removeClass();
					$("#"+message_ID).addClass("approve_box");
				}

			});
			$(this).dialog("close");
		//	return false;
		}
		
		function getTwo(){
									
				$.get(get_link+"&what=approve&action=1",{},function(message){
					if (message == "ok") {
						
						$("a#"+message_ID).attr({
							title: "disapprove",							
						});
						$("#image"+message_ID).attr({
							src: "images/disapprove.gif"
						})
						$("#"+message_ID).removeClass();
						$("#"+message_ID).addClass("disapprove_box");
												
					}
			});
			$(this).dialog("close");
			//return false;
		}
	
});