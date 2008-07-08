package gui {
	import flash.display.Sprite;
	import fl.containers.UILoader;
	import caurina.transitions.*;
	import flash.events.MouseEvent;
	import fl.controls.Label;
	import flash.events.Event;
	import flash.net.*;
	import caurina.transitions.*;
	import gui.Thumbnail;
	import gui.Thumb_holder;
	import gui.Scrollbar;
	import flash.geom.*;
	import flash.events.MouseEvent;

	
	public class picGrid extends Sprite {
		private var iconSize_x:int;
		private var iconSize_y:int;
		private var numofRows:int;
		private var pos_x:int;
		private var pos_y:int;
		private var pos_height:int;
		private var pos_width:int;
		//var mytrack:Sprite = new track();
		var arrayURL:Array = new Array();
		//--------holds the paths to the big photos-------
		var arrayName:Array = new Array();
		//--------holds the thumbnail objects-------
		var holderArray:Array = new Array();
		//--------represents the number of collumns-------
		var nrColumns:uint = 9;
		//-------represents the container of our gallery
		var sprite:Sprite = new Sprite();
		
		var urlRequest:URLRequest = new URLRequest("xlink.php?allimages=1");
		var urlLoader:URLLoader = new URLLoader();
		var myXML:XML = new XML();
		var xmlList:XMLList;
		
		var thumb:Thumbnail;
		var thumb_holder:Thumb_holder  = new Thumb_holder();
		
		
		var photoLoader:UILoader = new UILoader();
		var thumbsHolder:Sprite = new Sprite();
		var loaderHolder:Sprite = new Sprite();
		
		//constructor : builds the Grid for the first time
		public function picGrid(xParm:int, yParm:int, widthParm:int , heightParm:int):void{
			pos_x = xParm;
			pos_y = yParm;
			pos_width = widthParm ;
			pos_height = heightParm ;
		
		//---------loading the external xml file-------
		myXML.ignoreWhitespace = true;
		urlLoader.addEventListener(Event.COMPLETE,fileLoaded);

		drawGrid();
				
		addChild(sprite);
		//-------- the thumbnails container-------
		sprite.addChild(thumbsHolder);
		//-------- the photoLoader container-------
		loaderHolder.graphics.beginFill(0x000000,1);
		loaderHolder.graphics.drawRect(0,0,1024,600);
		loaderHolder.graphics.endFill();
		loaderHolder.x = 1034;
		loaderHolder.y = 0;
		sprite.addChild(loaderHolder);
		//-------- loads the big photo-------
		photoLoader.width = 1010;
		photoLoader.height = 580;
		photoLoader.y = 5;
		photoLoader.x = 5;
		photoLoader.buttonMode = true;
		photoLoader.addEventListener(MouseEvent.CLICK,onClickBack);
		loaderHolder.addChild(photoLoader);
		thumbsHolder.mask=thumb_holder;
		
		}
		
		// we loop through the xml file
		//populate the arrayURL, arrayName and position the thumbnails
		function fileLoaded(event:Event):void {
			myXML = XML(event.target.data);
			xmlList = myXML.children();
			for (var i:int=0; i<xmlList.length(); i++) {
				var picURL:String = xmlList[i].url;
				var picName:String = xmlList[i].big_url;
				arrayURL.push(picURL);
				arrayName.push(picName);
				holderArray[i] = new Thumbnail(arrayURL[i],i,arrayName[i]);
				holderArray[i].addEventListener(MouseEvent.CLICK,onClick);
				holderArray[i].name = arrayName[i];
				//holderArray[i].height = 10;
				//holderArray[i].width = 10;
				trace(arrayName[i]);
				holderArray[i].buttonMode = true;
				if (i<nrColumns) {
					holderArray[i].y = 65;
					holderArray[i].x = i*110+65;
				} else {
					holderArray[i].y = holderArray[i-nrColumns].y+110;
					holderArray[i].x = holderArray[i-nrColumns].x;
				}
				thumbsHolder.addChild(holderArray[i]);
			}
			thumb_holder.attach(photoLoader);
			addChild(thumb_holder);
			var scrollbar:Scrollbar = new Scrollbar(photoLoader);
			scrollbar.attach(thumbsHolder);
			addChild(scrollbar);
		}
		//----handles the Click event added to the thumbnails--
		function onClick(event:MouseEvent):void {
			photoLoader.source = event.currentTarget.name;
			Tweener.addTween(thumbsHolder, {x:-650, time:1, transition:"easeOutQuint"});
			Tweener.addTween(loaderHolder, {x:0, time:1, transition:"easeOutQuint"});
			Tweener.addTween(thumbsHolder, {alpha:0, time:1, transition:"linear"});
			Tweener.addTween(loaderHolder, {alpha:1, time:1, transition:"linear"});
		
		}
		//----handles the Click event added to the photoLoader----
		function onClickBack(event:MouseEvent):void {
			Tweener.addTween(thumbsHolder, {x:0, time:1, transition:"easeOutQuint"});
			Tweener.addTween(loaderHolder, {x:1034, time:1, transition:"easeOutQuint"});
			Tweener.addTween(thumbsHolder, {alpha:1, time:2, transition:"linear"});
			Tweener.addTween(loaderHolder, {alpha:0, time:2, transition:"linear"});
		}
		
		// populate grid with all root categories
		function getRoot():void{
		urlRequest.url = "http://rgkdev.net/cpg/xlink.php?getroot=1";
		drawGrid();
		}
		
		// populate grid with all albums in the category
		function getCategory(catid:int):void{
		}
		
		//populate the grid with all the images 
		function getAlbum(albumid:int):void{
			
		}
		
		//implement a draw function that reads off a particular URL and populates the grid
		function drawGrid():void{
			urlLoader.load(urlRequest);
		}
		
		function gridDestroy():void{
		
		}

		
		
		
}
}