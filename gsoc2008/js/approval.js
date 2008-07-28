//approval.js to approval and disapproval comment 
  	$(document).ready(function(){
		
			var getCurrentDOM = '';
			var approvalButtonHandel = '';
		//click the aproval_button to view event box
		$('.aproval_button').click(function(){
				getCurrentDOM = $(this).parents("div");
				approvalButtonHandel = $(this).next();
				$(this).next().toggle();
		});
		
		//event handling for approval events
		$('.aproval_event').click(function(){
				var getResult = '';
				
				var getURL = getCurrentDOM.prev().children("a").attr("rel");
					getURL = getURL + '&what=approve&action=1&ajax_call=1';
					//ajax calling 
					$.getJSON(getURL, function(data){
					getResult = data['resopnd'];	
					if(getResult){
				var a = 	getCurrentDOM.prev().children("a").children("img").attr({src:"images/disapprove.gif"});
					}		
				});

			
				//close the approval box
				approvalButtonHandel.slideUp();
		});
		
		//event handeling for disapproval_event
		$('.disapproval_event').click(function(){
				var getResult = '';
				
				var getURL = getCurrentDOM.prev().children("a").attr("rel");
					getURL = getURL + "&what=disapprove&action=1&ajax_call=1";
				
				$.getJSON(getURL, function(data){
					getResult = data['resopnd'];					
					if(getResult){
					getCurrentDOM.prev().children("a").children("img").attr({
 						src: "images/approve.gif"
						});
					}			
				});
				

				//close the approval box after executing ajax
				approvalButtonHandel.slideUp();
		});
		
		//calel to reviewcom.php funciton and get callback 
		function callToAjax(url){
				var getURL 		= url;
				var getResult 	= '';
				

				alert(getResult)
			return getResult;
			}
			
});