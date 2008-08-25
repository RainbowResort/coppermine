
package gui{
	
// Import the treeClasses.* to use TreeDataProvider
import com.yahoo.astra.fl.controls.treeClasses.*;
import com.yahoo.astra.fl.controls.Tree;

// Import ListEvent to capture events inherited from List
import fl.events.ListEvent;
import flash.text.TextField;

// Import GetDefinitionByName to dynamically refer to library clips
import flash.utils.getDefinitionByName;
import flash.display.Sprite;
	import fl.containers.UILoader;
	import caurina.transitions.*;
	import flash.events.MouseEvent;
	import fl.controls.Label;
	import flash.events.Event;
	import flash.net.*;
	import caurina.transitions.*;
	import gui.Thumbnail;
	import gui.gridMasker;
	import gui.Scrollbar;
	import fl.controls.Slider;
	import flash.geom.*;
	import flash.events.MouseEvent;
	import fl.events.SliderEvent;
	import flash.text.TextFormat;
	
	public class albumListing extends Sprite{
		
		var urlRequest:URLRequest;
		var urlLoader:URLLoader = new URLLoader();
		var	mytree:Tree = new Tree();
		var myXML:XML = new XML();
		var xmlList:XMLList;
		
		//we attach the Tree to the picGrid so that update requests can be sent across
		var targetGrid:Object ;
		
		
		public function albumListing(_width:int,_height:int):void{
			
		this.graphics.beginFill(0x0);
        this.graphics.drawRect(0, 0, _width, _height);
        this.graphics.endFill();
		trace(_width);
				
		mytree.width = _width;
		mytree.height = _height;
	
			
		myXML.ignoreWhitespace = true;
		urlLoader.addEventListener(Event.COMPLETE,fileLoaded);
		mytree.setRendererStyle("closedBranchIcon", folderClosedIcon);
		mytree.setRendererStyle("openBranchIcon", folderOpenIcon);
		mytree.setRendererStyle("leafIcon", fileIcon);
		// Call function handleClick when an item in the Tree is clicked
		mytree.addEventListener(ListEvent.ITEM_CLICK, handleClick);
		trace("TREE INITIED");	
		
		//loadXML();
		}
		
		
		//seperate function to handle reload/refresh requests
		public function loadXML():void{
		//finally load the url for album listing
		urlRequest = new URLRequest("flashmanager.php?albumlisting=1&magik=" + this.parent.magik);
		urlLoader.load(urlRequest);
		}
		
		//attach the tragetGrid to the externa Grid class
		public function attach(myGrid:Object):void{
			this.targetGrid = myGrid;
		}
		
		
		//populate the tree
		function fileLoaded(event:Event):void {
		trace(event.target.data);
		myXML = XML(event.target.data);
		// Set the Tree's dataProvider to a new TreeDataProvider, instantiated with the above XML
		mytree.setRendererStyle("textFormat", new TextFormat("Arial", 12, 0xFFCC00));
		mytree.dataProvider = new TreeDataProvider(myXML);
		addChild(mytree);
		//mytree.openAllNodes();			
		}
		
		

		function handleClick (ev:ListEvent) {
		// If the item has an 'image' attribute
		
		// need to check for the status of the 
		
		switch(ev.item.t){
			case "R":
			targetGrid.getRoot();
			break;
			case "C":
			targetGrid.getCategory(ev.item.i,true);
			break;
			case "A":
			targetGrid.getAlbum(ev.item.i,true);
			break;
		}
		}
		
}
}