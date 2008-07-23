//write function to get the table serialize 
	function getSerialize (){
	jQuery.tableDnD.currentTable = document.getElementById("album_sort"); // use your table ID obviously
	var bb = jQuery.tableDnD.serialize();
		return bb;
	} 

//write function to get the table serialize 
	function getSerializePic (){
	jQuery.tableDnD.currentTable = document.getElementById("pic_sort"); // use your table ID obviously
	var bb = jQuery.tableDnD.serialize();
		return bb;
	} 
	
	
	
	
	
// this jquery.tablednd is to drag and drop sort images. 
	jQuery(document).ready(function() {
		
    jQuery("#pic_sort").tableDnD();
	$("#pic_sort tr:odd").css("background-color", "#EFEFEF");
	
    jQuery("#pic_sort tr").hover(function() {    	
	$(this).find("td").css({ borderBottom:'1px solid #CCC',
					     borderTop: '1px solid #CCC' 
						});
    }, function() {
    	  $(this.cells[0]).removeClass('showDragHandle');
	      $(this).find("td").css('border','none');
    });
    //add query to input hidden when drop the pic item..
    	$('#pic_sort').tableDnD({
        	onDrop: function(table, row) {
        	//call the getSerializePic() funtion to get query
           $("#pictur_order").val(getSerializePic());
        }
    });
    //load the form when click the submit button
	$("#cpgformPic").submit(function () { 
		$("#pictur_order").val(getSerializePic());
		var a =	$("input[name='pictur_order']").attr("value");
		if(a.length > 0){
		if(confirm('Confirm modifications!')) {
			return true;
			}
		}
	  	return false; 
	}); // so it won't submit

});




// this jquery.tablednd is to drag and drop sort albums. 
	jQuery(document).ready(function() {
	
	//varible defining which need to handle the events
		var object_edit ='';
		var event 		="";
		var getId 		="";
		var amountOfRows="";
		var currentRows =[];
		
	//styel to album list
	$("#album_sort tr:odd").css("background-color", "#EFEFEF");

	$("#add_new_album").click(function(){
		$("#album_nm").removeAttr("disabled").focus().val("New album");
		event = 'addAlbumButton';
		
	});
	//edit the ablums 
	$(".edit").click(function(){						
			object_edit = $(this).parents("td").prev();
			getId 		= $(this).parents("tr").attr("id");

			$("#album_nm").removeAttr("disabled");
				$("#album_nm").empty();
				$("#album_nm").val(object_edit.text()).focus();
				event = 'editAlbumButton';
	});

	//add new album when click the save buttons
	$("#buttonEvent").click(function (){
		var get_album = $("#album_nm").val();
			
			// add new album check whether nulll and event
			if(get_album.length > 0 && event=='addAlbumButton'){
		var get_album_item_count = $("#album_sort tr").length +1;				
		var album_tr = '<tr id="sort'+get_album_item_count+'" title="'+get_album_item_count+'@'+get_album+'@1" style="height: 20px; cursor: move; width: 100%;"><td width="10%" style="padding-left: 20px;">'+get_album_item_count+'</td><td><img src="images/image.png"/></td><td style="width: 100px;">'+get_album+'</td><td style="border: medium none ;"><a class="edit" title="Edit" style="cursor: pointer;">Edit</a></td><td style="border: medium none ;"><a class="delete" title="Delet" style="cursor: pointer;">Delete</a></td></tr>';
		
			$("#album_sort").append(album_tr);
			$("#album_nm").attr({ disabled: 'disabled' }).val("");
}			
			//check wheter null and event to edit the album
			if(get_album.length > 0 && event=='editAlbumButton'){
				getTitle = $("#"+getId).attr("title");
		//split the title value
		var words = getTitle.split('@');
		var result = [];
			//put values in to the array
			$.each(words, function(i, value) {
				if ( $.trim(value) )
				result[i] = $.trim(value);
		});
				//change the title in main table
				$("#"+getId).attr({title: result[0]+'@'+get_album+'@'+3})
				//change the text which having album name.
				$(object_edit).empty().text(get_album);
				//to empty the box value 
				$("#album_nm").attr({value: ""});
			}
		$("#sort_order").val(getSerialize());
	});
	
		// Initialise the first table (as before)
		jQuery("#album_sort").tableDnD();

	$('#album_sort').tableDnD({
        	onDrop: function(table, row) {
        	var rows = table.tBodies[0].rows;
            var debugStr = [];
            for (var i=0; i<rows.length; i++) {
                debugStr[i] = rows[i].id;
            }
            currentRows = debugStr;
            compareRows(currentRows,amountOfRows);
           $("#sort_order").val(getSerialize());
        },
        // Initialise the second table specifying a dragClass and an onDrop function that will display an alert
 		onDragStart: function(table, row) {
 			var rows1 = table.tBodies[0].rows;
            var getRows = rows1.length; 
	       		amountOfRows = getRows;
  		}
    });
		//delete items which having the  album list 
		$(".delete").click(function(){
			var getDeleteId = $(this).parents("tr").attr("id");
				if(confirm('Are you sure you want to delete this album ? \n All files and comments it contains will be lost !')) {
						//get the current row title value
						var getTitleRowDelete =  $("#"+getDeleteId).attr("title");
						
						//split the title value
						var wordsDelete = getTitleRowDelete.split('@');
						var resultDelete = [];
						//put values in to the array
						$.each(wordsDelete, function(i, value){
							if ( $.trim(value) )
							resultDelete[i] = $.trim(value);
						});
				$("#"+getDeleteId).attr({title: resultDelete[0]+'@'+resultDelete[1]+'@'+4}).hide();	
				$("#sort_order").val(getSerialize());		
			}				
		});
     
		//highlight the albums item on hover
		jQuery("#album_sort tr").hover(function() {
          $(this.cells[0]).addClass('showDragHandle');
		  $(this).find("td").css({ borderBottom:'1px solid #CCC',
					     borderTop: '1px solid #CCC' 
						});
    	}, function() {
          $(this.cells[0]).removeClass('showDragHandle');
	      $(this).find("td").css('border','none');
	});
    	//load the form when click the submit button
	    $("#cpgformAlbum").submit(function () { 
			var a =	$("input[name='sort_order']").attr("value");
				if(a.length > 0){
					if(confirm('Are you sure you want to make these modifications ?')) {
				return true;
				}
			}
		   	return false; 
	}); // so it won't submit
	
		//function to compare the current and initial rows..
		function compareRows(rows,amount){
			var getCurrentRows =[];
				getCurrentRows = rows;
			var getAmount	   = amount;
				for(var i=0; i<getAmount; i++){
					
						//get the current row title value
						var getTitleRow =  $("#"+(i+1)).attr("title");
						
						//split the title value
						var words = getTitleRow.split('@');
						var result = [];
						//put values in to the array
						$.each(words, function(i, value){
							if ( $.trim(value) )
							result[i] = $.trim(value);
						});
						
					if(getCurrentRows[i]==(i+1)){
						if(result[2]==2){
							$("#"+(i+1)).attr({title: result[0]+'@'+result[1]+'@'+0})
						}
						else
						continue;
					}
					else if(getCurrentRows[i]!=(i+1)){
					
						if(result[2]==0){
						$("#"+(i+1)).attr({title: result[0]+'@'+result[1]+'@'+2})
						}
						else{
							continue;
						}
					}
					
				}
		}


});




jQuery.tableDnD = {
    /** Keep hold of the current table being dragged */
    currentTable : null,
    /** Keep hold of the current drag object if any */
    dragObject: null,
    /** The current mouse offset */
    mouseOffset: null,
    /** Remember the old value of Y so that we don't do too much processing */
    oldY: 0,

    /** Actually build the structure */
    build: function(options) {
        // Make sure options exists
        options = options || {};
        // Set up the defaults if any

        this.each(function() {
            // Remember the options
            this.tableDnDConfig = {
                onDragStyle: options.onDragStyle,
                onDropStyle: options.onDropStyle,
				// Add in the default class for whileDragging
				onDragClass: options.onDragClass ? options.onDragClass : "tDnD_whileDrag",
                onDrop: options.onDrop,
                onDragStart: options.onDragStart,
                scrollAmount: options.scrollAmount ? options.scrollAmount : 5
            };
            // Now make the rows draggable
            jQuery.tableDnD.makeDraggable(this);
        });

        // Now we need to capture the mouse up and mouse move event
        // We can use bind so that we don't interfere with other event handlers
        jQuery(document)
            .bind('mousemove', jQuery.tableDnD.mousemove)
            .bind('mouseup', jQuery.tableDnD.mouseup);

        // Don't break the chain
        return this;
    },

    /** This function makes all the rows on the table draggable apart from those marked as "NoDrag" */
    makeDraggable: function(table) {
        // Now initialise the rows
        var rows = table.rows; //getElementsByTagName("tr")
        var config = table.tableDnDConfig;
        for (var i=0; i<rows.length; i++) {
            // To make non-draggable rows, add the nodrag class (eg for Category and Header rows) 
			// inspired by John Tarr and Famic
            var nodrag = $(rows[i]).hasClass("nodrag");
            if (! nodrag) { //There is no NoDnD attribute on rows I want to drag
                jQuery(rows[i]).mousedown(function(ev) {
                    if (ev.target.tagName == "TD") {
                        jQuery.tableDnD.dragObject = this;
                        jQuery.tableDnD.currentTable = table;
                        jQuery.tableDnD.mouseOffset = jQuery.tableDnD.getMouseOffset(this, ev);
                        if (config.onDragStart) {
                            // Call the onDrop method if there is one
                            config.onDragStart(table, this);
                        }
                        return false;
                    }
                }).css("cursor", "move"); // Store the tableDnD object
            }
        }
    },

    /** Get the mouse coordinates from the event (allowing for browser differences) */
    mouseCoords: function(ev){
        if(ev.pageX || ev.pageY){
            return {x:ev.pageX, y:ev.pageY};
        }
        return {
            x:ev.clientX + document.body.scrollLeft - document.body.clientLeft,
            y:ev.clientY + document.body.scrollTop  - document.body.clientTop
        };
    },

    /** Given a target element and a mouse event, get the mouse offset from that element.
        To do this we need the element's position and the mouse position */
    getMouseOffset: function(target, ev) {
        ev = ev || window.event;

        var docPos    = this.getPosition(target);
        var mousePos  = this.mouseCoords(ev);
        return {x:mousePos.x - docPos.x, y:mousePos.y - docPos.y};
    },

    /** Get the position of an element by going up the DOM tree and adding up all the offsets */
    getPosition: function(e){
        var left = 0;
        var top  = 0;
        /** Safari fix -- thanks to Luis Chato for this! */
        if (e.offsetHeight == 0) {
            /** Safari 2 doesn't correctly grab the offsetTop of a table row
            this is detailed here:
            http://jacob.peargrove.com/blog/2006/technical/table-row-offsettop-bug-in-safari/
            the solution is likewise noted there, grab the offset of a table cell in the row - the firstChild.
            note that firefox will return a text node as a first child, so designing a more thorough
            solution may need to take that into account, for now this seems to work in firefox, safari, ie */
            e = e.firstChild; // a table cell
        }

        while (e.offsetParent){
            left += e.offsetLeft;
            top  += e.offsetTop;
            e     = e.offsetParent;
        }

        left += e.offsetLeft;
        top  += e.offsetTop;

        return {x:left, y:top};
    },

    mousemove: function(ev) {
        if (jQuery.tableDnD.dragObject == null) {
            return;
        }

        var dragObj = jQuery(jQuery.tableDnD.dragObject);
        var config = jQuery.tableDnD.currentTable.tableDnDConfig;
        var mousePos = jQuery.tableDnD.mouseCoords(ev);
        var y = mousePos.y - jQuery.tableDnD.mouseOffset.y;
        //auto scroll the window
	    var yOffset = window.pageYOffset;
	 	if (document.all) {
	        // Windows version
	        //yOffset=document.body.scrollTop;
	        if (typeof document.compatMode != 'undefined' &&
	             document.compatMode != 'BackCompat') {
	           yOffset = document.documentElement.scrollTop;
	        }
	        else if (typeof document.body != 'undefined') {
	           yOffset=document.body.scrollTop;
	        }

	    }
		    
		if (mousePos.y-yOffset < config.scrollAmount) {
	    	window.scrollBy(0, -config.scrollAmount);
	    } else {
            var windowHeight = window.innerHeight ? window.innerHeight
                    : document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight;
            if (windowHeight-(mousePos.y-yOffset) < config.scrollAmount) {
                window.scrollBy(0, config.scrollAmount);
            }
        }


        if (y != jQuery.tableDnD.oldY) {
            // work out if we're going up or down...
            var movingDown = y > jQuery.tableDnD.oldY;
            // update the old value
            jQuery.tableDnD.oldY = y;
            // update the style to show we're dragging
			if (config.onDragClass) {
				dragObj.addClass(config.onDragClass);
			} else {
	            dragObj.css(config.onDragStyle);
			}
            // If we're over a row then move the dragged row to there so that the user sees the
            // effect dynamically
            var currentRow = jQuery.tableDnD.findDropTargetRow(dragObj, y);
            if (currentRow) {
                // TODO worry about what happens when there are multiple TBODIES
                if (movingDown && jQuery.tableDnD.dragObject != currentRow) {
                    jQuery.tableDnD.dragObject.parentNode.insertBefore(jQuery.tableDnD.dragObject, currentRow.nextSibling);
                } else if (! movingDown && jQuery.tableDnD.dragObject != currentRow) {
                    jQuery.tableDnD.dragObject.parentNode.insertBefore(jQuery.tableDnD.dragObject, currentRow);
                }
            }
        }

        return false;
    },

    /** We're only worried about the y position really, because we can only move rows up and down */
    findDropTargetRow: function(draggedRow, y) {
        var rows = jQuery.tableDnD.currentTable.rows;
        for (var i=0; i<rows.length; i++) {
            var row = rows[i];
            var rowY    = this.getPosition(row).y;
            var rowHeight = parseInt(row.offsetHeight)/2;
            if (row.offsetHeight == 0) {
                rowY = this.getPosition(row.firstChild).y;
                rowHeight = parseInt(row.firstChild.offsetHeight)/2;
            }
            // Because we always have to insert before, we need to offset the height a bit
            if ((y > rowY - rowHeight) && (y < (rowY + rowHeight))) {
                // that's the row we're over
				// If it's the same as the current row, ignore it
				if (row == draggedRow) {return null;}
                var config = jQuery.tableDnD.currentTable.tableDnDConfig;
                if (config.onAllowDrop) {
                    if (config.onAllowDrop(draggedRow, row)) {
                        return row;
                    } else {
                        return null;
                    }
                } else {
					// If a row has nodrop class, then don't allow dropping (inspired by John Tarr and Famic)
                    var nodrop = $(row).hasClass("nodrop");
                    if (! nodrop) {
                        return row;
                    } else {
                        return null;
                    }
                }
                return row;
            }
        }
        return null;
    },

    mouseup: function(e) {
        if (jQuery.tableDnD.currentTable && jQuery.tableDnD.dragObject) {
            var droppedRow = jQuery.tableDnD.dragObject;
            var config = jQuery.tableDnD.currentTable.tableDnDConfig;
            // If we have a dragObject, then we need to release it,
            // The row will already have been moved to the right place so we just reset stuff
			if (config.onDragClass) {
	            jQuery(droppedRow).removeClass(config.onDragClass);
			} else {
	            jQuery(droppedRow).css(config.onDropStyle);
			}
            jQuery.tableDnD.dragObject   = null;
            if (config.onDrop) {
                // Call the onDrop method if there is one
                config.onDrop(jQuery.tableDnD.currentTable, droppedRow);
            }
            jQuery.tableDnD.currentTable = null; // let go of the table too
        }
    },

    serialize: function() {
        if (jQuery.tableDnD.currentTable) {
            var result = "";
            var tableId = jQuery.tableDnD.currentTable.id;
            var rows = jQuery.tableDnD.currentTable.rows;
            for (var i=0; i<rows.length; i++) {
               // if (result.length > 0)// result += ",";
                result += rows[i].title+",";
            }
            return result;
        } else {
            return "Error: No Table id set, you need to set an id on your table and every row";
        }
    }
    
}

jQuery.fn.extend(
	{
		tableDnD : jQuery.tableDnD.build
	}
);