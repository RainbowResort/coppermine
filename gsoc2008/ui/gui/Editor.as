package gui
{	import gui.picGrid;
	import flash.display.Sprite;
	import gui.Header;
	import gui.albumListing;
	import gui.previewBox;
	import flash.utils.ByteArray;
	import flash.geom.*;
	
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
	
	import gui.Window;

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

		public var loader:Loader;		
		//Memory copy of the image (original image)
		public var mBMAP:BitmapData;
		//Memory copy of the image (modified image)
		public var mmBMAP:BitmapData;
		//final copy of the edited bitmap
		public var finalBMAP:BitmapData;
		//visible image
		// holds the runtime image ..for live image editing and previewing.
		public var effectBMAP:BitmapData;
		
		private var bckButton:Button;
		// preview box
		private var previewbox:Sprite;
		private var preview_myBorder:Sprite;
		
		public var effect_applied:Boolean;
		public var effect_selected:Boolean;
		
		public function Editor(imgurl:String, _width:int,_height:int):void{
		
		trace ("B URL " + imgurl)
		
		// Loads the image from the URL
		loader = new Loader();
		loader.contentLoaderInfo.addEventListener(Event.COMPLETE,loaded);
		loader.load(new URLRequest(imgurl));
		effect_applied  = false;

		// Effects option list
		var dp:DataProvider = new DataProvider();
		
		//BASICS
		dp.addItem({ label: "BASICS" });
		dp.addItem({ label: "  |-- Rotate" });
		dp.addItem({ label: "  |-- Crop" });
		
		//ADJUSTMENTS
		dp.addItem({ label: "ADJUSTMENTS" });
		dp.addItem( { label: "  |-- Brightness" } );
		dp.addItem( { label: "  |-- Brightness (slider)" } );		
		dp.addItem( { label: "  |-- Contrast" } );
		dp.addItem( { label: "  |-- Sharpen" } );
		dp.addItem( { label: "  |-- Hue" } );
		dp.addItem( { label: "  |-- Saturation" } );
		
		//EFFECTS 
		dp.addItem({ label: "EFFECTS"});
		dp.addItem( { label: "  |-- Pop Colors" } );
		dp.addItem( { label: "  |-- White Bal" } );
		dp.addItem( { label: "  |-- Highlight" } );
		dp.addItem( { label: "  |-- Fill Light" } );
		dp.addItem( { label: "  |-- Soft" } );
		dp.addItem( { label: "  |-- Black & White" } );
		dp.addItem( { label: "  |-- Sepia" } );
		dp.addItem( { label: "  |-- Tint" } );
		dp.addItem( { label: "  |-- Auto Color" } );
		dp.addItem( { label: "  |-- Sketch" } );
	
		effectList.dataProvider = new DataProvider(dp);
		effectList.width = 150;
		effectList.height = 500;
		addChild(effectList);
		effectList.allowMultipleSelection = false;
        effectList.addEventListener(Event.CHANGE, handleEventLists);
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
		private function handleEventLists(e:Event):void {
			if ( effect_applied  == true)
			{	//copy the modified image back onto the code
				finalBMAP = effectBMAP.clone();
            	trace(effectList.selectedItem.label);
				effect_appplied = false;
				trace(effect_applied);
			}
			switch(effectList.selectedItem.label){
			case "  |-- Sharpen" :
			buildPreviewBox();
			previewbox.draw_sharpen();
			break;
			case "  |-- Brightness" :
			buildPreviewBox();
			previewbox.draw_brighten();
			break;
			case "  |-- Pop Colors":
			buildPreviewBox();
			previewbox.draw_popColors();
			break;
			case "  |-- Hue":
			buildPreviewBox();
			previewbox.draw_hue();
			break;
			case "  |-- Saturation":
			buildPreviewBox();
			previewbox.draw_saturation();
			break;
			case "  |-- Contrast":
			buildPreviewBox();
			previewbox.draw_contrast();
			break;
			case "  |-- Brightness (slider)":
			buildPreviewBox();
			previewbox.draw_brightnessSlider();
			break;
			case "  |-- Alhpa":
			buildPreviewBox();
			previewbox.draw_brightnessSlider();
			break;
			case "  |-- Rotate":
			buildPreviewBox();
			previewbox.draw_RotatePanel();
			break;
			case "  |-- Crop":
			trace ("this.height " + this.height);
			previewbox = new previewBox(550,this.width - 150);
			previewbox.x = 160;
			previewbox.y = 2;
			//previewbox.width = this.width - 150;
			//previewbox.height = this.height-100;
			this.addChild(previewbox);
			
			previewbox.draw_crop();
			
			
			
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
			//effect_applied  = false;
		}
		
		
		
		// EVENT Manager for image loading 			
		private function loaded(e:Event):void{
			
			mBMAP =  loader.content.bitmapData.clone() ; //(previewImg.bitmapData.clone());
			mmBMAP = loader.content.bitmapData.clone() ; //(previewImg.bitmapData.clone());
			finalBMAP = loader.content.bitmapData.clone() ;  //new BitmapData(previewImg.bitmapData.width,previewImg.bitmapData.height,false,0x0);
			effectBMAP = finalBMAP.clone();
//			finalBMAP = (previewImg.bitmapData.clone());
			trace("FINALbmap . width " + finalBMAP.width);
			updatePreview(finalBMAP,false);
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
		public function updatePreview(source:BitmapData,redraw:Boolean){
			if (redraw){
			this.removeChild(previewImg);
			}
			trace("WIDTH : " + source.width);
			trace("Height : " + source.height);
			previewImg =  new Bitmap(source);
			previewImg.x = 400 ;
			previewImg.y = 150 ;
			if ( source.width > source.height) // landscape
			{
				previewImg.width = source.width * (400 / source.width  );
				previewImg.height = source.height * (400 / source.width  ); 
			}
			if ( source.width < source.height) //portrait
			{
				previewImg.width = source.width * (400 / source.height );
				previewImg.height = source.height * (400 / source.height ); 
			}

			addChild(previewImg);
			
			if(redraw){
			this.removeChild(preview_myBorder);
			}
			preview_myBorder = new Sprite();
			preview_myBorder.graphics.lineStyle(2, 0x333333);
			preview_myBorder.graphics.drawRect (previewImg.x ,previewImg.y , previewImg.width , previewImg.height );
			this.addChild (preview_myBorder);
		}
		
			
		// UNDO EVENT
		private function undoLastAction(E:Event):void{
			var win:Sprite = new Window();
			addChild(win);
		}
		
		// Save EVENT
		private function saveAction(E:Event):void{
			
			/* we need a way to figure out how to save it on to the server */
			// right now it dumps the image into the /album/snapshot.jpg
			finalBMAP = effectBMAP.clone();
			var jpgEncoder:JPGEncoder = new JPGEncoder(85);
			var jpgStream:ByteArray = jpgEncoder.encode(finalBMAP);
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