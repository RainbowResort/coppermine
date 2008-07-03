/**
 * @author sameera
 *
 **/

  	$(document).ready(function(){	
		
		var get_link = '';
		var message_ID ='';
	
		//click the approves DOM and cheack the it's values
	    	$("#edit_one_image").click(function(){
							
			get_link = $(this).attr('href');	
		//	message_ID = $(this).attr('rel');
			//title = $(this).attr('title');
				//if approve titile set to the variables in order to call getTwo and getOne functions
	
					
				//alert(a+"dis");
				// first execut the get ajax call and the pop up the dialog box
			$.get(get_link, {}, function(data) {
			$("#dialog").html(data);
				//set property to the dispalyed dialog box..
			$("#dialog").dialog({
  				modal: true, 
  				overlay: { opacity: 0.5, background: "black" }, 
				draggable:false,
 				resizable:false,
 				title: 'Disapproval Window',
				width: 900, 
				height: 500,
				buttons: {  "Cancel": function() { $(this).dialog("close"); } }
								
			});			
		});
		return false;
	});
	
				
/**
 * 		function getOne (){	
 * 		
 * 			$.get(get_link+"&what=disapprove&action=1",{},function(message){
 * 				if (message == "ok") {
 * 					
 * 					$("a#"+message_ID).attr({
 * 						title: "approve"
 * 					});
 * 					$("#image"+message_ID).attr({
 * 						src: "images/approve.gif"
 * 					})
 * 					$("#"+message_ID).removeClass();
 * 					$("#"+message_ID).addClass("approve_box");
 * 				}

 * 			});
 * 			$(this).dialog("close");
 * 		//	return false;
 * 		}
 */
 
		});
	