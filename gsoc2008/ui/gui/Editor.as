package gui
{	import gui.picGrid;
	import flash.display.Sprite;
	import gui.Header;
	import gui.albumListing;
	import gui.previewBox;
	import flash.utils.ByteArray;
	import flash.geom.*;
	
	import caurina.transitions.*;
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
	import fl.controls.TextInput;
	import flash.events.Event;
	import fl.events.SliderEvent;
	import flash.text.TextFormat;
	import flash.utils.clearTimeout;
	import flash.utils.setTimeout;
	import fl.core.UIComponent;
	import fl.data.DataProvider;
	import fl.controls.RadioButton;
	import fl.controls.RadioButtonGroup;
	import fl.controls.Slider;
	import fl.controls.Label;
	
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
		
		//Loading dialog
		var loadingLbl:Label;
		var loadingtext:Label
		
		// save dialog
		var dimmer:Sprite ;
		var save_dialog:Sprite ;
		var save_postUpload:int;
		var jpgQualitySlider:Slider;
		var jpgQualitySlider_label:Label;
		var save_action_code:String ;
		var myBorder:Sprite ;
		var imageID:int;
		var save_submitButton:Button;
		public var preview_drawn:Boolean;
		
		public function Editor(imgID:int,imgurl:String, _width:int,_height:int):void{
		Tweener.addTween(this, {alpha:0, time:1, transition:"linear"});
		Tweener.addTween(this, {alpha:1, time:14, transition:"linear"});	
		//scaleX = 1;
		//scaleY = 1;
		preview_drawn = false;
		trace ("B URL " + imgurl)
		this.imageID = imgID;
		
		// Loads the image from the URL
		loader = new Loader();
		loader.contentLoaderInfo.addEventListener(Event.COMPLETE,loaded);
		loader.load(new URLRequest(imgurl + "?cacheBust="  + Math.random() ));
		effect_applied  = false;

		// Effects option list
		var dp:DataProvider = new DataProvider();
		
		//BASICS
		dp.addItem({ label: "BASICS" });
		dp.addItem({ label: "  |-- Rotate" });
		dp.addItem({ label: "  |-- Crop/Resize" });
		
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
		dp.addItem( { label: "  |-- Blur" } );
		dp.addItem( { label: "  |-- Gray Scale" } );
		dp.addItem( { label: "  |-- Sepia" } );
		//dp.addItem( { label: "  |-- Tint" } );
		//dp.addItem( { label: "  |-- Sketch" } );
	
		effectList.dataProvider = new DataProvider(dp);
		effectList.width = 150;
		effectList.height = 500;
		addChild(effectList);
		effectList.allowMultipleSelection = false;
        effectList.addEventListener(Event.CHANGE, handleEventLists);
		effectList.enabled = false;

		// loading dialog
		loadingLbl = new Label();;
			with (loadingLbl){
				htmlText = "<font color='#FFFFFF' size='16'>Loading your photo for editing... </font>";
				alpha =1 ;
				width = 300;
				height = 30;
			}
			addChild(loadingLbl);
			loadingLbl.x = 400;
			loadingLbl.y = 200;
		
		
		
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
			case "  |-- Crop/Resize":
			trace ("this.height " + this.height);
			if(preview_drawn)
			{
				this.removeChild(previewbox);
			}
			previewbox = new previewBox(597,this.width - 150);
			previewbox.x = 160;
			previewbox.y = 2;
			//previewbox.width = this.width - 150;
			//previewbox.height = this.height-100;
			this.addChild(previewbox);
			preview_drawn = true ;
			
			previewbox.draw_crop();
			break;
			
			case  "  |-- Blur" :
			buildPreviewBox();
			previewbox.draw_blur();
			break;

			case  "  |-- Sepia" :
			buildPreviewBox();
			previewbox.apply_sepia();
			break;
			
			case  "  |-- Gray Scale" :
			buildPreviewBox();
			previewbox.apply_grayScale();
			break;
			
			
			}
			
        }
		
		
		// Draws the previewBox for each Event. Requires addition of cleanup functionality
		private function buildPreviewBox(){
			if(preview_drawn)
			{
				this.removeChild(previewbox);
			}
			previewbox = new previewBox(130,this.width - 150);
			previewbox.x = 160;
			previewbox.y = 2;
			previewbox.width = this.width - 150;
			previewbox.height = 130;
			this.addChild(previewbox);
			preview_drawn = true ;
			//effect_applied  = false;
		}
		
		
		
		// EVENT Manager for image loading 			
		private function loaded(e:Event):void{
			removeChild(loadingLbl);
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
			//this.parent.grid.cacheBust();
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
			
			previewImg.width = effectBMAP.width;
			previewImg.height  = effectBMAP.height ;
			
			if (!( effectBMAP.width < 400 && effectBMAP.height <  400))
			{
						
			
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
/*			for now it doesnt have a state machine . It just goes back one step */

			effectBMAP = new BitmapData(finalBMAP.width,finalBMAP.height,false,0x0);
			effectBMAP = finalBMAP.clone();
			updatePreview(effectBMAP,true);
			
			
		}
		
		// Save EVENT
		private function saveAction(E:Event):void{
			
			/*
			Bring up the save dialog....
			-- after saving dismiss the dialog
			-- Select the correct RADIO button .. .
					-- take the required action
					-- 
			-- Saving animation
			*/
			
			
			//fader
			dimmer = new Sprite();
			with (dimmer){
				x = 0 ;
				y = 0;
				
				alpha = 0.6;
				
				graphics.beginFill(0x000000);
				graphics.drawRect(0, 0, this.width,this.height);
				graphics.endFill();

			}
			
			dimmer.width = this.width;
			dimmer.height = this.height;
			
			save_dialog = new Sprite();
			with (save_dialog){
				x = 200 ;
				y = 50;
				
				alpha = 1;
				//scaleX= 1;
				//scaleY =1;
				
				graphics.beginFill(0x000000);
				graphics.drawRect(0, 0, 600 , 600 ) ;//this.width,this.height);
				graphics.endFill();

			}
			
			save_dialog.width = 600;
			save_dialog.height = 600 ;
			
			myBorder = new Sprite();
			myBorder.graphics.lineStyle(3, 0xffffff);
			myBorder.graphics.drawRect(save_dialog.x ,save_dialog.y , 500 , 500 );
			
			var myFormat:TextFormat = new TextFormat();
			myFormat.font = "Georgia";
			myFormat.size = 14;
			myFormat.color = 0xffffff;
			
			
			var save_cancelButton:Button = new Button();
			with(save_cancelButton){
				label = "Cancel";
				save_cancelButton.setStyle("textFormat", myFormat);
				alpha = 1;
				addEventListener(MouseEvent.CLICK,save_cancel_action);
				height = 80;
				width = 100;
				//scaleX = 3;
				//scaleY = 3;
			}
			save_cancelButton.x = 100;
			save_cancelButton.y =  400;
			
			save_submitButton = new Button();
			with(save_submitButton){
				label = "Save";
				save_submitButton.setStyle("textFormat", myFormat);
				alpha = 1;
				addEventListener(MouseEvent.CLICK,save_submit_action);
				height = 80;
				width = 100;
				//scaleX  = 3;
				//scaleY = 3;
				enabled = false;
			}
			save_submitButton.x = 300;
			save_submitButton.y = 400;

			loadingtext = new Label();
			with(loadingtext){
			x =  200;
			y =  0;
			alpha = 1;
			width = 400;
			wordWrap = true;
			htmlText = "<font color='#FFFFFF' size='10'>Saving photo to the server </font>" ;
			}
			

			var rbg1:RadioButtonGroup = new RadioButtonGroup("group1");
						
			var rb1:RadioButton = new RadioButton();
			var rb2:RadioButton = new RadioButton();
			var rb3:RadioButton = new RadioButton();
			

			with(rb1){
				group = rbg1;
				setStyle("textFormat", myFormat);
				//scaleX= 5;
				//scaleY = 5;
				move(225,200);
				label = "Replace original ";
				name = "1";
				addEventListener( MouseEvent.CLICK  , setSaveAction);
				width = 300;
			}
			
			with(rb2){
				group = rbg1;
				setStyle("textFormat", myFormat);
				//scaleX= 5;
				//scaleY = 5;
				move(225,250);
				label = "Save as Copy";
				name = "2";
				addEventListener( MouseEvent.CLICK  , setSaveAction);
				width = 300;
			}

		
			with(rb3){
				group = rbg1;
				setStyle("textFormat", myFormat);
				//scaleX= 5;
				//scaleY = 5;
				move(225,300);
				label = "Save to Desktop :  ";
				name = "3";
				addEventListener( MouseEvent.CLICK  , setSaveAction);
				width = 300;				
			}
			
			  
														  
			jpgQualitySlider = new Slider();
			with (jpgQualitySlider){
			maximum = 100;
			minimum = 0;
			snapInterval = 1;
			liveDragging = true;
			x = 225;
			y = 90 ;
			height = 200;
			width = 160;
			addEventListener(SliderEvent.CHANGE, jpgQuality_sliderChanged);
			value = 85;
			//scaleX= 6;
			//scaleY = 10;
			setStyle("textFormat", myFormat);
			}
			jpgQualitySlider_label = new Label();
			 with( jpgQualitySlider_label){
			htmlText = "<font color='#FFFFFF' size='16px'>JPEG Quality: </font>" ;
			x = jpgQualitySlider.x - 150;
			y = jpgQualitySlider.y - 20 ;
			alpha = 1;
			width = 200;
			height = 70;
			wordWrap = true;
			//scaleX = 5;
			//scaleY = 5;
			setStyle("textFormat", myFormat);
			}
			
			save_dialog.addChild(jpgQualitySlider_label);
			save_dialog.addChild(jpgQualitySlider);
			
			save_dialog.addChild(rb1);
			save_dialog.addChild(rb2);
			save_dialog.addChild(rb3);
			
			// fader
			this.addChild(dimmer);
			
			// save dialog
			this.addChild(save_dialog);
			//Border
			this.addChild(myBorder);

			// fader
			//SAVE CANCEL
			save_dialog.addChild(save_cancelButton);
			save_dialog.addChild(save_submitButton);
			//save_dialog.addChild(saveAsTXT);

		}
		
		
		function  jpgQuality_sliderChanged(e:Event):void{
			 jpgQualitySlider_label.htmlText = "<font color='#FFFFFF' size='16px'>JPEG Quality: " + e.target.value + "</font>" ;
		}
		
		function setSaveAction(e:MouseEvent):void {
			save_action_code = String(e.target.name);
			save_submitButton.enabled = true;
			
			
			
		}
		
		function save_submit_action(e:MouseEvent):void{
			
			
			
			
			switch(save_action_code)
			{
				case "1":
				// handle Replace original
				upload2Server(1,imageID);
				
				break;
				case "2":
				// handle save as copy
				upload2Server(2,imageID);
				break;
				
				case "3":
				// handle save to desktop
				upload2Server(3,imageID);
				break;
			}
			
			
		}
		
		
		function save_cancel_action(e:MouseEvent):void{
			this.removeChild(myBorder);
			this.removeChild(save_dialog);
			this.removeChild(dimmer);
			
			
		}
		
		
		
		private function upload2Server(action:int,url:int ):void{
			

			// ACCEPT parameters and perform the requested action.
			
			/* we need a way to figure out how to save it on to the server */
			// right now it dumps the image into the /album/snapshot.jpg
			if( effect_applied == true)
			finalBMAP = effectBMAP.clone();
			
			save_dialog.addChild(loadingtext);
			
			trace (" final BMAP . width " + finalBMAP.width + "  .height " + finalBMAP.height);
			
			var jpgEncoder:JPGEncoder = new JPGEncoder(jpgQualitySlider.value);
			var jpgStream:ByteArray = jpgEncoder.encode(finalBMAP);
			var header:URLRequestHeader = new URLRequestHeader("Content-type", "application/octet-stream");
			var jpgURLRequest:URLRequest = new URLRequest("flashmanager.php?upload=1&savetype=" + action + "&fileid=" + url +"&size_x=" + finalBMAP.width + "&size_y=" + finalBMAP.height + "&magik=" /* + this.magik */ );
			trace("flashmanager.php?upload=1&savetype=" + action + "&fileid=" + url)
			jpgURLRequest.requestHeaders.push(header);
			jpgURLRequest.method = URLRequestMethod.POST;
			jpgURLRequest.data = jpgStream;
						
			
			var jpgURLLoader:URLLoader = new URLLoader();	
			jpgURLLoader.load(jpgURLRequest);		
			jpgURLLoader.addEventListener(Event.COMPLETE, savingComplete);

			
			
			
			
		}
		
		function savingComplete(e:Event):void{
			trace("GOT : " + e.target.data);
			this.removeChild(myBorder);
			this.removeChild(save_dialog);
			this.removeChild(dimmer);
			if(save_action_code == "3")
			navigateToURL(new URLRequest("albums/snapshot.jpg"), "_blank");
			
		}
		
		}
	}