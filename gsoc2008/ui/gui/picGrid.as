/*
picGrid class
Manages Grid Display;


Author : Sribabu Doddapaneni
mail: root [at] rusticgeek.net
*/


//seperate code for loading and drawing the arrays
//seperate code

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
	import gui.gridMasker;
	import gui.Scrollbar;
	import fl.controls.Slider;
	import flash.geom.*;
	import flash.events.MouseEvent;
	import fl.events.SliderEvent;

	
	public class picGrid extends Sprite {
		private var iconSize_x:int;
		private var iconSize_y:int;
		private var numofRows:int;
	
		private var selectedPics:Array = new Array();

		var holderArray:Array;
		//--------represents the number of collumns-------
		var gallery:Sprite = new Sprite();
		var urlRequest:URLRequest = new URLRequest("flashmanager.php?allimages=1");
		var urlLoader:URLLoader = new URLLoader();
		var myXML:XML = new XML();
		var xmlList:XMLList;
		
		var gridslider:Slider;// = new Slider();
		var pathLabel:Label = new Label();

		
		var grid_mask:gridMasker = new gridMasker();
		var thumbsHolder:Sprite; 
		
		
		//to be replaced by editor 
		var photoLoader:UILoader = new UILoader();
		var loaderHolder:Sprite = new Sprite();
		
		//constructor : builds the Grid for the first time
		// x , y , width , height
		public function picGrid(xParm:int, yParm:int, widthParm:int , heightParm:int):void{

			trace("widthParam" + widthParm);
			this.graphics.beginFill(0x0);
            this.graphics.drawRect(0, 0, widthParm, heightParm);
            this.graphics.endFill();
			
			gallery.graphics.beginFill(0x0);
            gallery.graphics.drawRect(0, 0, widthParm, heightParm);
            gallery.graphics.endFill();
			gallery.alpha = 1;
			gallery.blendMode = "lighten";
			
			
			
			var myBorder:Sprite = new Sprite();
			myBorder.graphics.lineStyle(2, 0x333333);
			myBorder.graphics.drawRect (this.x ,this.y , this.width , this.height );
			this.addChild (myBorder);
			
			thumbsHolder =  new Sprite();
			//---------loading the external xml file-------
			myXML.ignoreWhitespace = true;
			urlLoader.addEventListener(Event.COMPLETE,fileLoaded);
			
			//stitch gallery to the display
			addChild(gallery);
//			stitch thumbnails inside the gallery
			gallery.addChild(thumbsHolder);
		// default icon size
		
		iconSize_x = 108;
		iconSize_y = 75;
		numofRows = 8;
			
			
		
		//drawGrid();
		
		// first go we draw the root categories
		getRoot();
//		addChild(thumbsHolder);

		

		var scrollbar:Scrollbar = new Scrollbar(this);
		scrollbar.attach(gallery);
		addChild(scrollbar);
		grid_mask.attach(gallery);
		addChild(grid_mask);
		thumbsHolder.mask=grid_mask;
		
		// to be replaced by editor
				//-------- the photoLoader container-------
		loaderHolder.graphics.beginFill(0x000000,1);
		loaderHolder.graphics.drawRect(0,0,widthParm,heightParm);
		loaderHolder.graphics.endFill();
		loaderHolder.x = xParm + widthParm;
		loaderHolder.y = yParm;
		addChild(loaderHolder);
		//-------- loads the big photo-------
		photoLoader.width = widthParm;
		photoLoader.height = heightParm;
		photoLoader.y = 5;
		photoLoader.x = 5;
		photoLoader.buttonMode = true;
		photoLoader.addEventListener(MouseEvent.CLICK,onClickBack);
		loaderHolder.addChild(photoLoader);
				
		
		
		
		
		
	}
		
		
/*		XML - represntation
		
		<image>
		<i></i> -id
		<l></l> -label
		<t></t>	-type
		<b></b>	- big url
		<s></s> - small url
		</image>
		
*/		
		// we loop through the xml file
		//populate the arrayURL, arrayName and position the thumbnails
		function fileLoaded(event:Event):void {
			myXML = XML(event.target.data);
			holderArray = new Array();
			xmlList = myXML.children();
			for (var i:int=0; i<xmlList.length(); i++) {
				holderArray[i] = new Thumbnail(xmlList[i].i,xmlList[i].l,xmlList[i].t,xmlList[i].b,xmlList[i].s,iconSize_x,iconSize_y)			
				holderArray[i].addEventListener(MouseEvent.CLICK,multiSelect);
		//-- enable DoubleClick		
				holderArray[i].doubleClickEnabled=true;
				holderArray[i].mouseChildren = false;
				holderArray[i].addEventListener(MouseEvent.DOUBLE_CLICK,doubleClickEvent,false, 0, true);
				holderArray[i].buttonMode = true;
				
				// needs intelligent handling
				if (i < this.numofRows) {
					holderArray[i].y = iconSize_y;
					holderArray[i].x = i * iconSize_x + iconSize_x/2;
				} else {
					holderArray[i].y = holderArray[i-numofRows].y + iconSize_y  ;
					holderArray[i].x = holderArray[i-numofRows].x;
				}
				thumbsHolder.addChild(holderArray[i]);
			}
			//gridslider.enabled = true;
			
		}
					
		function multiSelect(event:MouseEvent):void 
		{
			if (event.ctrlKey)
			{
				selectedPics.push(event.currentTarget.id);
				event.currentTarget.alpha = 1 ;
				printSelectedpics();
				
				
			}
			
			
		}
		//----handles the Click event added to the photoLoader----
		function onClickBack(event:MouseEvent):void {
			Tweener.addTween(thumbsHolder, {x:0, time:1, transition:"easeOutQuint"});
			Tweener.addTween(loaderHolder, {x:1034, time:1, transition:"easeOutQuint"});
			Tweener.addTween(thumbsHolder, {alpha:1, time:2, transition:"linear"});
			Tweener.addTween(loaderHolder, {alpha:0, time:2, transition:"linear"});
		}
		//-- performs an action based on the kind of thumbnail
		function doubleClickEvent(event:MouseEvent):void {
				if (event.currentTarget.type == "CAT")
				{
					getCategory(event.currentTarget.id);
				}
				else if (event.currentTarget.type == "ALB")
				{
					getAlbum(event.currentTarget.id);
									
				}
				else
				{
				photoLoader.source = event.currentTarget.bURL;
			  	Tweener.addTween(thumbsHolder, {x:-650, time:1, transition:"easeOutQuint"});
				Tweener.addTween(loaderHolder, {x:0, time:1, transition:"easeOutQuint"});
				Tweener.addTween(thumbsHolder, {alpha:0, time:1, transition:"linear"});
				Tweener.addTween(loaderHolder, {alpha:1, time:1, transition:"linear"});
				}
				
		}
		
		
		function sliderChanged(event:SliderEvent):void{
			switch(event.currentTarget.value)
			{
				case 1:
						iconSize_y = 75;
						iconSize_x = 108;
						numofRows = 8;
						break;
				case 2: 
						iconSize_y = 90;
						iconSize_x = 120;
						numofRows = 6;
						break;
				case 3: 
						iconSize_y = 120;
						iconSize_x = 160;
						numofRows = 4;
						break;
				case 4: 
						iconSize_y = 240;
						iconSize_x = 320;
						numofRows = 2;
						break;
			}
						
						
						// should be clean redraw()
					//	gridDestroy();
					//	drawGrid();
				// clean reDraw
				for (var i:int = 0 ; i < holderArray.length ; i ++){
				holderArray[i].resize(iconSize_x,iconSize_y);
				if (i < this.numofRows) {
					holderArray[i].y = iconSize_y;
					holderArray[i].x = i * iconSize_x + iconSize_x/2;
				} else {
					holderArray[i].y = holderArray[i-numofRows].y+iconSize_y ;
					holderArray[i].x = holderArray[i-numofRows].x;
				}
				}
		
			
		}
		
		// populate grid with all root categories
		function getRoot():void{
		urlRequest.url = "flashmanager.php?getroot=1";
		drawGrid();
		drawPanel(false);
		pathLabel.htmlText = "<font color='#FFFFFF' size='15px'>Categories</font>" 
		}
		
		// populate grid with all albums in the category
		function getCategory(catid:int):void{
		urlRequest.url = "flashmanager.php?getcat=1&cat=" + catid;
		gridDestroy();
		drawGrid();
		drawPanel(false);
		pathLabel.htmlText = "<font color='#FFFFFF' size='15px'>Albums</font>" 
		}
		
		//populate the grid with all the images 
		function getAlbum(albumid:int):void{
		urlRequest.url = "flashmanager.php?getalb=1&alb=" + albumid;
		gridDestroy();
		drawGrid();
		drawPanel(false);
		pathLabel.htmlText = "<font color='#FFFFFF' size='15px'>Photos</font>" 
		}
		
		//implement a draw function that reads off a particular URL and populates the grid
		function drawGrid():void{
			urlLoader.load(urlRequest);
			//gridslider.enabled = false;
		}
		
		function gridDestroy():void{
			
			//trace ("holder array lenght ");
			trace (holderArray.length);
			
			//remove the panel
			
			
			for(var i:int = 0 ; i < holderArray.length ; i++)
			{
				//trace(" i : " + i );
				thumbsHolder.removeChild(holderArray[i]);
			}
			holderArray = null;
		}

		function printSelectedpics()
		{ 
			
			for(var i:int = 0; i < selectedPics.length ; i++)
			trace (selectedPics[i]);
		}
		
		function drawPanel(redraw:Boolean):void
		{
		 gridslider = new Slider();			
		gridslider.maximum = 4;
		gridslider.minimum = 1;
		gridslider.snapInterval = 1;
		gridslider.liveDragging = true;
		gridslider.x = this.width -  90;
		gridslider.y = 15 ;
		gridslider.height = 10;
		gridslider.width = 60;
		gridslider.addEventListener(SliderEvent.CHANGE, sliderChanged);
		gridslider.value = 1;
		//if (!redraw)
		addChild(gridslider);
		var gridslider_label:Label = new Label();
		gridslider_label.htmlText = "<font color='#FFFFFF' size='12px'>Zoom:</font>" ;
		gridslider_label.x = gridslider.x - 50;
		gridslider_label.y = gridslider.y - 7;
		gridslider_label.alpha = 1;
		gridslider_label.width = 40;
		gridslider_label.wordWrap = true;
		//gridslider_label.opaqueBackground = 0x000000;
		//gridslider_label.blendMode =  "lighten";
		//if(!redraw)
		this.addChild(gridslider_label);

		//pathLabel.htmlText = "<font color='#FFFFFF' size='15px'></font>" ;
		pathLabel.x =  20;
		pathLabel.y =  10;
		pathLabel.alpha = 1;
		pathLabel.width = 100;
		pathLabel.wordWrap = true;
		//pathLabel.opaqueBackground = 0x000000;
		//pathLabel.blendMode =  "lighten"
		//if(!redraw)
		this.addChild(pathLabel);
		}
		
		
}
}