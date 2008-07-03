//approval.js to approval and disapproval comment 
  	$(document).ready(function(){
		
		var get_link = '';
		var message_ID ='';
		var action ='';		
		
		//click the approves DOM and cheack the it's values
	    	$(".approves").click(function(){
			
			$.blockUI({ css: {
        		border: 'none', 
        		padding: '20px', 
        		backgroundColor: '#333333', 
        		'-webkit-border-radius': '10px', 
        		'-moz-border-radius': '10px', 
        		color: '#FFF' 
    		} }); 
         									
			//get_link_href = $(this).attr('href');
			get_link = $(this).attr('rel');
			message_ID = $(this).attr('id');
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
		
				// first execut the get ajax call and the pop up the dialog box
			$.get(get_link+"&what="+action+"&ajax_call=1", {}, function(data) {
			$("#dialog").html(data);
				//set property to the dispalyed dialog box..
			$("#dialog").dialog({
  				modal: true, 
  				overlay: { opacity: 0.5, background: "black" }, 
				draggable:false,
 				resizable:false,
				width: 410, 
				height: 300,
				buttons: { "Ok": temp , "Cancel": function() { $(this).dialog("close"); } }
								
			});	
			setTimeout($.unblockUI)			
		});
		return false;
	});
	
				
		function getOne (){			
			$.get(get_link+"&what=disapprove&action=1&ajax_call=1",{},function(message){
								
					$("a#"+message_ID).attr({
						title: "approve"
					});
					$("#image"+message_ID).attr({
						src: "images/approve.gif"
					})
		
			});
			$(this).dialog("close");
		//	return false;
		}
		
		function getTwo(){									
				$.get(get_link+"&what=approve&action=1",{},function(message){
				
						$("a#"+message_ID).attr({
							title: "disapprove",							
						});
						$("#image"+message_ID).attr({
							src: "images/disapprove.gif"
						})
										
			});
			$(this).dialog("close");
			//return false;
		}
	
});