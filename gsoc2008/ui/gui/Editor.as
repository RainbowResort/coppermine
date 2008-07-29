package gui
{	import gui.picGrid;
	import flash.display.Sprite;
	import gui.Header;
	import gui.albumListing;
	import gui.previewBox;
	import flash.utils.ByteArray;
	
	import com.adobe.images.JPGEncoder;
	import com.adobe.images.BMPEncoder;
	import flash.net.navigateToURL;
	import flash.display.Sprite;
	import flash.events.*;
	import flash.net.*;
		
	import fl.controls.List;
	import fl.data.DataProvider;
	import fl.containers.UILoader;
	import flash.net.URLRequest;
   	import flash.display.Loader;
   	import flash.net.URLRequest;
   	import flash.events.*;
   	import flash.net.*;
	import fl.controls.Button;
	import flash.display.Shape;
	import flash.display.StageAlign;
	import flash.display.StageScaleMode;
	import flash.events.Event;
	import flash.text.TextFormat;
	import flash.utils.clearTimeout;
	import flash.utils.setTimeout;
	import fl.core.UIComponent;
	import fl.data.DataProvider;
	
	import flash.display.Bitmap;
	import flash.display.BitmapData;

	/*
	@AUTHOR SRIBABU DODDAPANENI
	@CONTACT root [at] rusticgeek.net
	
	should have pluggable interface
	plugin on click should load it self
	access the original and modified copy of the image
	save as modified-new copy of the image and replace modified image on final save
	plugin can have its own 1. tool options bar 2. tool previews
	
	
	the editor also holds a BITMAP memory copy
	original
	modified
	modified-new
		*/
public class Editor extends Sprite{
		
		var effectList:List = new List();
		public var previewImg:Bitmap;

		private var loader:Loader;		
		//Memory copy of the image (original image)
		public var mBMAP:BitmapData;
		//Memroy copy of the image (modified image)
		public var mmBMAP:BitmapData;
		//visible image
		private var bckButton:Button;
		// preview box
		private var previewbox:Sprite;
		
		public function Editor(imgurl:String, _width:int,_height:int):void{
		
		trace ("B URL " + imgurl)
		
		// Loads the image from the URL
		loader = new Loader();
		loader.contentLoaderInfo.addEventListener(Event.COMPLETE,loaded);
		loader.load(new URLRequest(imgurl));
		

		// Effects option list
		var dp:DataProvider = new DataProvider();
		dp.addItem( { label: "Brightness" } );
		dp.addItem( { label: "Sharpen" } );
		dp.addItem( { label: "Auto Color" } );
		dp.addItem( { label: "White Bal" } );
		dp.addItem( { label: "Saturation" } );
		dp.addItem( { label: "Highlight" } );
		dp.addItem( { label: "Fill Light" } );
		dp.addItem( { label: "Soft" } );
		dp.addItem( { label: "Pop Colors" } );
		dp.addItem( { label: "Black & White" } );
		dp.addItem( { label: "Sepia" } );
		dp.addItem( { label: "Tint" } );
		dp.addItem( { label: "Sketch" } );
	
		effectList.dataProvider = new DataProvider(dp);
		effectList.width = 150;
		effectList.height = 300;
		addChild(effectList);
		effectList.allowMultipleSelection = false;
        effectList.addEventListener(Event.CHANGE, updateLists);
		effectList.enabled = false;
		
		// preparing Editor	
		graphics.beginFill(0x000000);
        graphics.drawRect(0, 0, _width,_height);
        graphics.endFill();
				
		//Adding Menu Buttons				
		save = new Button();
		save.x = 0
		save.y = 460;// _height - 30;
		save.width = 50;
		save.height = 20;
		save.label = "save";
		save.addEventListener(MouseEvent.CLICK	, saveAction);
		
		undo = new Button();
		undo.x = 0
		undo.y = 480;// _height - 30;
		undo.width = 50;
		undo.height = 20;
		undo.label = "UNDO";
		undo.addEventListener(MouseEvent.CLICK	, undoLastAction);
				
		bckButton = new Button();
		bckButton.x = 0
		bckButton.y = 500;// _height - 30;
		bckButton.width = 50;
		bckButton.height = 20;
		bckButton.label = "Back";
		bckButton.addEventListener(MouseEvent.CLICK	, bckEvent);
		}

		// EVENT MANAGER for the LIST
		private function updateLists(e:Event):void {
            trace(effectList.selectedItem.label);
			switch(effectList.selectedItem.label){
			case "Sharpen" :
			buildPreviewBox();
			previewbox.draw_sharpen();
			break;
			case "Brightness" :
			buildPreviewBox();
			previewbox.draw_brighten();
			break;
				
				
			}
			
        }
		
		
		// Draws the previewBox for each Event. Requires addition of cleanup functionality
		private function buildPreviewBox(){
			previewbox = new previewBox(130,this.width - 150);
			previewbox.x = 160;
			previewbox.y = 2;
			previewbox.width = this.width - 150;
			previewbox.height = 130;
			this.addChild(previewbox);
		}
		
		
		// EVENT Manager for image loading 			
		private function loaded(e:Event):void{
			updatePreview(loader.content.bitmapData,false);
			mBMAP =  (previewImg.bitmapData.clone());
			mmBMAP = (previewImg.bitmapData.clone());
			this.addChild(bckButton);
			this.addChild(undo);
			this.addChild(save);
			effectList.enabled = true;
		}
		
		//Back Button Event
		private function bckEvent(e:Event):void{
			this.parent.removeChild(this);
		}
		
		//Manages reloading of the preview 
		private function updatePreview(source:BitmapData,redraw:Boolean){
			if(redraw){ removeChild(previewImg);}
			previewImg =  new Bitmap(source);
			previewImg.x = 300 ;
			previewImg.y = 150 ;
			previewImg.width = 440 ; // previewImg.content.width * 0.4;// previewImg.width	/ 3;
			previewImg.height = 330 ; //previewImg.content.height * 0.4; //previewImg.height / 4;
			addChild(previewImg);
		}
			
		// UNDO EVENT
		private function undoLastAction(E:Event):void{
			updatePreview(mmBMAP,true);
		}
		
		// Save EVENT
		private function saveAction(E:Event):void{
			
			/* we need a way to figure out how to save it on to the server */
			// right now it dumps the image into the /album/snapshot.jpg
			
			var jpgEncoder:JPGEncoder = new JPGEncoder(85);
			var jpgStream:ByteArray = jpgEncoder.encode(previewImg.bitmapData);
			var header:URLRequestHeader = new URLRequestHeader("Content-type", "application/octet-stream");
			var jpgURLRequest:URLRequest = new URLRequest("flashmanager.php?filename=snapshot.jpg");
			jpgURLRequest.requestHeaders.push(header);
			jpgURLRequest.method = URLRequestMethod.POST;
			jpgURLRequest.data = jpgStream;
			
			var jpgURLLoader:URLLoader = new URLLoader();	
			jpgURLLoader.load(jpgURLRequest);		
			
			// would require a Event Handler that shows a progress bar while the image is being saved
			navigateToURL(new URLRequest("albums/snapshot.jpg"), "_blank");
		}
				
		}
	}