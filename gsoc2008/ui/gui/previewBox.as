/*
	@DESC Holds the preview images for a given effect
	@AUTHOR SRIBABU DODDAPANENI
	@CONTACT root [at] rusticgeek.net
*/

package gui
{
	import fl.controls.TextInput;
	import gui.effectPreview;
	import com.quasimondo.geom.ColorMatrix ;
	
	import flash.display.Bitmap;
	import flash.display.BitmapData;
	
	import flash.display.DisplayObject;
	import flash.events.MouseEvent;
	import flash.net.URLRequest;
	import flash.net.URLVariables;
	import flash.net.navigateToURL;
	import flash.text.TextField;
	import flash.text.TextFieldAutoSize;
	import flash.text.TextFormat;
	import flash.display.Sprite;
	import flash.geom.Matrix;
	import flash.filters.ColorMatrixFilter;
    import flash.filters.BitmapFilter;
    import flash.filters.ConvolutionFilter;
	import flash.events.Event;
	import flash.geom.*;
	import flash.events.MouseEvent;
	import fl.events.SliderEvent;
	import fl.controls.Slider;
	import fl.controls.Label;
	import fl.controls.Button;
	import flash.display.Shape;
	import flash.filters.BlurFilter;

/*
Prepares and previews the image
-- gets a parameter
-- constructor prepares the images
-- variables are defined [a global array that can be accessed onclick and wud paint the effect onto the main picture

TOOLBAR -- displays the images
ATTACH() -- needs a handle to the picture previewer

--event handler -- will accept the target and apply properties to it :) might need a change in the way its called. maybe will touch this later
*/


/*
previewBox(1) -- should accept a parameter and generate a set of preview thumbnails.
*/	
	
public class previewBox extends Sprite
	{
		var previewBitmaps;
		var previewInProgress:Boolean; // is true if a preview is already being drawn/has been drawn
		var bitmap_count:int;
		var bmp:Bitmap ;
		var bitmaps_preview:Array; // holds the preview images
		var caseID:Number;
		var gridslider:Slider;// = new Slider();
		var	slider_label:Label;
		var sliderX:Slider;// = new Slider();
		var	sliderX_label:Label;
		var sliderY:Slider;
		var	sliderY_label:Label;
		var Quantity:Slider;
		var	Quantity_label:Label;

		//CROP Variables
		var crop_down:Boolean = false;
		var factor ;
		var x_org;
		var y_org;
		var crop_mask:Sprite;
		var crop_box:Sprite
		
		//Resize text box
		var resize_x:TextInput;
		var resize_y:TextInput;
		var resizeButton:Button;
		
		
		//Slider_values
		var slider_value_brightness = -1000;
		var slider_value_contrast = -1000 ;
		var slider_value_hue = -1000 ;
		var slider_value_saturation = -1000 ;
		var slider_value_blur_x = -1000;
		var slider_value_blur_y = -1000 ;
		var slider_value_blur_q = -1000;
		
		private var myRectangle:Shape;
		private var myRectSp:Sprite;
		private var ltx:Number; // top left x position
		private var lty:Number; // top left y position
		private var rtx:Number; // bottom right x position
		private var rty:Number; // bottom right y position
		private var button:Button;
		private var buttonDrag:Button;
		var drawn=false;
		var previewImg;

		//draws a preview box of a given height and width
		public function previewBox(heightParm:int ,widthParm:int)
		{	trace("Preview Box Drawn");
						
			this.graphics.beginFill(0x000000);
            this.graphics.drawRect(0, 0, widthParm, heightParm);
            this.graphics.endFill();
			
			var myBorder:Sprite = new Sprite();
			myBorder.graphics.lineStyle(2, 0x333333);
			myBorder.graphics.drawRect (this.x ,this.y , this.width , this.height );
			this.addChild (myBorder);
			
			
			
		}
		
		// SHARPEN //
				
		// Applies the sharpness effect to the preview images
		public function draw_sharpen(){

			prepare_bitmaps(5); // generates 5 previews
           	var matrices:Array = new Array();
			matrices.push([0, -1, 0,
                          -1, 10, -1,
                           0, 0, 0]);
			matrices.push([0, -1, 0,
                          -1, 13, -1,
                           0, 0, 0]);
			matrices.push([0, -1, 0,
                          -1, 16, -1,
                           0, 0, 0]);
			matrices.push([0, -1, 0,
                          -1, 20, -1,
                           0, 0, 0]);
			matrices.push([0, -1, 0,
                          -1, 23, -1,
                           0, 0, 0]);
			for (var i:int = 0 ; i < bitmaps_preview.length - 1  ; i++)
			{
				applyFilter(bitmaps_preview[i].bitmap.bitmapData,bitmaps_preview[bitmaps_preview.length - 1].bitmap.bitmapData, matrices[i]);
				bitmaps_preview[i].effectValue.push(matrices[i]);
				bitmaps_preview[i].addEventListener(MouseEvent.CLICK,apply_sharpen,false, 0, true);
				bitmaps_preview[i].buttonMode = true;
				addChild(bitmaps_preview[i]);
			}
		}
		
		//Applies the sharpen filter
		private function apply_sharpen(e:MouseEvent):void{
			applyFilter(this.parent.effectBMAP,this.parent.finalBMAP,e.target.effectValue.pop());
			this.parent.effect_applied = true;
			this.parent.updatePreview(this.parent.effectBMAP,true);
		
		}
		
		
		
		
		//Applies the brighten filter to the preview thubnails
		public function draw_brighten():void{
			prepare_bitmaps(5);
           	var matrices:Array = new Array();
			matrices.push([1, 1, 1,
                           1, 0, 1,
                           1, 1, 1]);
			matrices.push([2, 2, 2,
                           2, 0, 2,
                           2, 2, 2]);
			matrices.push([3, 3, 3,
                           3, 0, 3,
                           3, 3, 3]);
			matrices.push([5, 5, 5,
                           5, 0, 5,
                           5, 5, 5]);
			matrices.push([7, 7, 7,
                           7, 0, 7,
                           7, 7, 7]);
			for (var i:int = 0 ; i < bitmaps_preview.length - 1  ; i++)
			{	applyFilter(bitmaps_preview[i].bitmap.bitmapData,bitmaps_preview[bitmaps_preview.length - 1].bitmap.bitmapData, matrices[i]);
				bitmaps_preview[i].effectValue.push(matrices[i]);
				bitmaps_preview[i].addEventListener(MouseEvent.CLICK,apply_brighten,false, 0, true);
				bitmaps_preview[i].buttonMode = true;
				addChild(bitmaps_preview[i]);
			}
		}
		
		// applies brighten effect to the preview Image
		private function apply_brighten(e:MouseEvent):void{
			applyFilter(this.parent.effectBMAP,this.parent.finalBMAP,e.target.effectValue.pop());
			this.parent.effect_applied = true;
			this.parent.updatePreview(this.parent.effectBMAP,true);
		
		}
		
		// BRIGHTNESS SLIDER
		
		
		public function draw_brightnessSlider():void{
			slider = new Slider();			
			slider.maximum = 100;
			slider.minimum = -100;
			slider.snapInterval = 1;
			slider.liveDragging = true;
			slider.x = 100;
			slider.y = 40 ;
			slider.height = 60;
			slider.width = 500 ; //this.width - 150;
			slider.addEventListener(SliderEvent.CHANGE, apply_brightnessSlider);
			if(slider_value_brightness != -1000)
			slider.value = slider_value_brightness;
			else 
			slider.value = 0;
			
			addChild(slider);
			
			slider_label = new Label();
			slider_label.htmlText = "<font color='#FFFFFF' size='12px'>BRT: " + String(slider.value) + "</font>" ;
			slider_label.x = 20;
			slider_label.y = 40;
			slider_label.alpha = 1;
			slider_label.width = 80;
			slider_label.wordWrap = true;
			this.addChild(slider_label);
		}
		
		private function apply_brightnessSlider(event:SliderEvent):void{	
			var mat:ColorMatrix = new ColorMatrix();
			mat.adjustBrightness(event.currentTarget.value);
			slider_label.htmlText = "<font color='#FFFFFF' size='12px'>BRT: " + String(event.currentTarget.value) + "</font>" ;
			apply_color_effect(this.parent.effectBMAP,this.parent.finalBMAP,mat);
			this.parent.effect_applied = true;
			this.parent.updatePreview(this.parent.effectBMAP,true);
		}
		
		// POP COLORS //
			
		public function draw_popColors(){
			
			prepare_bitmaps(3);
			var mat:ColorMatrix = new ColorMatrix();
           	var matrices:Array = new Array();
			mat = new ColorMatrix();
			mat.setChannels(1,0,0,0);
			matrices.push(mat);
			mat = new ColorMatrix();
			mat.setChannels(0,2,0,0);
			matrices.push(mat);
			mat= new ColorMatrix();
			mat.setChannels(0,0,4,0);
			matrices.push(mat);
			mat = new ColorMatrix();
			mat.setChannels(0,0,0,8);
			matrices.push(mat);
			
			for (var i:int = 0 ; i < bitmaps_preview.length - 1  ; i++)
			{	apply_color_effect(bitmaps_preview[i].bitmap.bitmapData,bitmaps_preview[bitmaps_preview.length - 1].bitmap.bitmapData, matrices[i]);
				bitmaps_preview[i].effectValue.push(matrices[i]);
				bitmaps_preview[i].addEventListener(MouseEvent.CLICK,apply_popcolors,false, 0, true);
				bitmaps_preview[i].buttonMode = true;
				addChild(bitmaps_preview[i]);
			}
		}
		
		private function apply_popcolors(e:MouseEvent):void{			
			var copy =	e.target.effectValue.pop(); // for subsequent calls to the function
			apply_color_effect(this.parent.effectBMAP,this.parent.finalBMAP,copy);
			e.target.effectValue.push(copy);
			this.parent.updatePreview(this.parent.effectBMAP,true);
			this.parent.effect_applied = true;
		}
		
		// APPLY HUE //
		
		public function draw_hue(){
			slider = new Slider();			
			slider.maximum = 360;
			slider.minimum = 0;
			slider.snapInterval = 1;
			slider.liveDragging = true;
			slider.x = 100;
			slider.y = 40 ;
			slider.height = 60;
			slider.width = 500;// this.width - 100;
			slider.addEventListener(SliderEvent.CHANGE, apply_hue);
			if(slider_value_hue != -1000)
			slider.value = slider_value_hue;
			else 
			slider.value = 0;
			addChild(slider);
			
			slider_label = new Label();
			slider_label.htmlText = "<font color='#FFFFFF' size='12px'>Hue: 0" + String(slider.value) + "</font>" ;
			slider_label.x = 20;
			slider_label.y = 40;
			slider_label.alpha = 1;
			slider_label.width = 80;
			slider_label.wordWrap = true;
			this.addChild(slider_label);
		}
		
		private function apply_hue(event:SliderEvent):void{	
			var mat:ColorMatrix = new ColorMatrix();
			mat.adjustHue(event.currentTarget.value);
			slider_label.htmlText = "<font color='#FFFFFF' size='12px'>Hue: " + String(event.currentTarget.value) + "</font>" ;
			apply_color_effect(this.parent.effectBMAP,this.parent.finalBMAP,mat);
			this.parent.updatePreview(this.parent.effectBMAP,true);
			this.parent.effect_applied = true;
		}
		
		// SATURATION //
		
		public function draw_saturation():void{
			slider = new Slider();			
			slider.maximum = 100;
			slider.minimum = 0;
			slider.snapInterval = 1;
			slider.liveDragging = true;
			slider.x = 100;
			slider.y = 40 ;
			slider.height = 60;
			slider.width = 500 ; //this.width - 150;
			slider.addEventListener(SliderEvent.CHANGE, apply_saturation);
			if(slider_value_saturation != -1000)
			slider.value = slider_value_saturation;
			else 
			slider.value = 100;
			addChild(slider);
			
			slider_label = new Label();
			slider_label.htmlText = "<font color='#FFFFFF' size='12px'>Sat: " + String(slider.value) + "</font>" ;
			slider_label.x = 20;
			slider_label.y = 40;
			slider_label.alpha = 1;
			slider_label.width = 80;
			slider_label.wordWrap = true;
			this.addChild(slider_label);
		}
		
		private function apply_saturation(event:SliderEvent):void{
			var mat:ColorMatrix = new ColorMatrix();
			mat.adjustSaturation(event.currentTarget.value/100);
			slider_label.htmlText = "<font color='#FFFFFF' size='12px'>Sat: " + String(event.currentTarget.value) + "</font>" ;
			apply_color_effect(this.parent.effectBMAP,this.parent.finalBMAP,mat);
			this.parent.updatePreview(this.parent.effectBMAP,true);
			this.parent.effect_applied = true;
		}
		
		// --  CONTRAST  -- //
		
		public function draw_contrast():void{
			slider = new Slider();			
			slider.maximum = 500;
			slider.minimum = 0;
			slider.snapInterval = 1;
			slider.liveDragging = true;
			slider.x = 100;
			slider.y = 40 ;
			slider.height = 60;
			slider.width = 500 ; //this.width - 150;
			slider.addEventListener(SliderEvent.CHANGE, apply_contrast);
			if(slider_value_contrast != -1000)
			slider.value = slider_value_contrast;
			else 
			slider.value = 0;
			addChild(slider);
			
			slider_label = new Label();
			slider_label.htmlText = "<font color='#FFFFFF' size='12px'>Con: " + String(slider.value) + "</font>" ;
			slider_label.x = 20;
			slider_label.y = 40;
			slider_label.alpha = 1;
			slider_label.width = 80;
			slider_label.wordWrap = true;
			this.addChild(slider_label);
		}
		
		private function apply_contrast(event:SliderEvent):void{
			var mat:ColorMatrix = new ColorMatrix();
			mat.adjustContrast(event.currentTarget.value/100);
			slider_label.htmlText = "<font color='#FFFFFF' size='12px'>Sat: " + String(event.currentTarget.value) + "</font>" ;
			apply_color_effect(this.parent.effectBMAP,this.parent.finalBMAP,mat);
			this.parent.updatePreview(this.parent.effectBMAP,true);
			this.parent.effect_applied = true;
		}
						
						
		// ROTATE //						
		
		public function draw_RotatePanel():void{
			var rotRT:Button = new Button();
			rotRT.label = "Right -->" 
			rotRT.x = (this.width /2 ) + 40;
			rotRT.y = 40;
			rotRT.addEventListener(MouseEvent.CLICK,rotateRight,false,false);
			addChild(rotRT);
			
			var rotLT:Button = new Button();
			rotLT.label = "<-- Left" 
			rotLT.x = (this.width /2 ) - 80;
			rotLT.y = 40;
			rotLT.addEventListener(MouseEvent.CLICK,rotateLeft,false,false);
			addChild(rotLT);
		}
		
		private function rotateRight(event:MouseEvent):void{
			var matrix:Matrix = new Matrix();
			var trans = new Matrix(); 
			matrix.rotate( Math.PI / 2);
			var transX = this.parent.finalBMAP.height; 
			var transY =0;
			trans.translate(transX, transY);
			matrix.concat(trans);
			trace("this point");
			var bmd:BitmapData = new BitmapData(this.parent.finalBMAP.height,this.parent.finalBMAP.width);
			bmd.draw(new Bitmap(this.parent.finalBMAP),matrix);
			//RESET sizes
			this.parent.finalBMAP = new BitmapData(bmd.width,bmd.height,false,0x0);
			this.parent.mmBMAP =  new BitmapData(bmd.width,bmd.height,false,0x0);
			this.parent.mBMAP =  new BitmapData(bmd.width,bmd.height,false,0x0);
			this.parent.effectBMAP =  new BitmapData(bmd.width,bmd.height,false,0x0);
			this.parent.finalBMAP = bmd.clone();
			this.parent.effectBMAP = bmd.clone();
			this.parent.mBMAP = bmd.clone();
			
			this.parent.updatePreview(this.parent.finalBMAP,true);
		}
		
		
		
		
		private function rotateLeft(event:MouseEvent):void{
			var matrix:Matrix = new Matrix();
			var trans = new Matrix(); 
			matrix.rotate(- Math.PI / 2);
			var transX = 0 ;
			var transY = this.parent.previewImg.bitmapData.width;
			trans.translate(transX, transY);
			matrix.concat(trans);
			trace("this point");
			var bmd:BitmapData = new BitmapData(this.parent.finalBMAP.height,this.parent.finalBMAP.width);
			bmd.draw(new Bitmap(this.parent.finalBMAP),matrix);
			//RESET sizes
			this.parent.finalBMAP = new BitmapData(bmd.width,bmd.height,false,0x0);
			this.parent.mmBMAP =  new BitmapData(bmd.width,bmd.height,false,0x0);
			this.parent.mBMAP =  new BitmapData(bmd.width,bmd.height,false,0x0);
			this.parent.effectBMAP =  new BitmapData(bmd.width,bmd.height,false,0x0);
			this.parent.finalBMAP = bmd.clone();
			this.parent.effectBMAP = bmd.clone();
			this.parent.mBMAP = bmd.clone();
			
			this.parent.updatePreview(this.parent.finalBMAP,true);
		}
	
	
	// --- CROP ---//
		public function draw_crop(){
			crop_down = false;
			
			var crop_help_lbl = new Label();
			with (crop_help_lbl){
				x = 0 ; y = 0;
				width = 300;
				height = 200;
				wordWrap = 1;
				htmlText = "<font color='#FFFFFF' size='12px'>hold the CTRL key down when selecting a crop region and draw a region from top to bottom</font>" ;
				
				
			}
			addChild(crop_help_lbl);
			
			var crop_but:Button = new Button;
			var crop_reset_but:Button = new Button;
			
			with (crop_but){
				x = this.width-150;
				y = 10;
				label = "CROP";
				addEventListener(MouseEvent.CLICK,crop_action,false,false);
			}
			addChild(crop_but);
			
			with (crop_reset_but){
				x = this.width - 150;
				y = 40;
				label = "RESET";
				addEventListener(MouseEvent.CLICK,reset_crop,false,false);
			}
			addChild(crop_reset_but);
			
			var save_crop:Button = new Button();
			with(save_crop){
				x = this.width-150;
				y = 70;
				label = "Save CROP";
				addEventListener(MouseEvent.CLICK,save_crop_action,false,false);
				
				
			}
			addChild(save_crop);
			
			
			draw_crop_image(false);
			

					
			var resize_x_lbl:Label = new Label();
			with (resize_x_lbl){
				x = this.width - 150;
				y = 200;
				htmlText = "<font color='#FFFFFF' size='12px'>Width</font>" ;
				width = 80;
				height = 20;
				
			}					
			
			
			resize_x = new TextInput();
			with (resize_x){
				x = this.width - 150;
				y = 230;
				text = this.parent.finalBMAP.width;
				
			}

			var resize_y_lbl:Label = new Label();
			with (resize_y_lbl){
				x = this.width - 150;
				y = 260;
				htmlText = "<font color='#FFFFFF' size='12px'>Height</font>" ;
				width = 80;
				height = 20;
			}					
			
			
			resize_y = new TextInput();
			with(resize_y)
			{
				x = this.width - 150;
				y =  280;
				text = this.parent.finalBMAP.height;
			
			}

			resizeButton = new Button();
			with (resizeButton){
				label = " Resize";
				x = this.width - 150;
				y = 310;
				addEventListener(MouseEvent.CLICK , resizeImage,false,false);
				
			}
					
			addChild(resize_x_lbl);
			addChild(resize_y_lbl);					
			addChild(resize_x);
			addChild(resize_y);
			addChild(resizeButton);
			
}
			
		private function resizeImage(e:Event):void{

			//trace("WIDTH : " + resize_x.text + "  Height : " + resize_y.text );
			
			var sx = resize_x.text / this.parent.finalBMAP.width;
			var sy = resize_y.text / this.parent.finalBMAP.height;
			var matrix:Matrix =  new Matrix(sx, 0, 0, sy, 0, 0);
			
			this.parent.effectBMAP = new BitmapData(resize_x.text,resize_y.text,false,0x0);
		    this.parent.effectBMAP.draw(new Bitmap(this.parent.finalBMAP),matrix);
			resizeBMAPS(this.parent.effectBMAP);
			//draw_crop_image(true);
			//this.parent.effect_applied = true;
			//this.parent.updatePreview(this.parent.effectBMAP,true);
			
			this.parent.updatePreview(this.parent.effectBMAP,true);
			this.parent.effect_applied = true;
			this.parent.preview_drawn = false;
			this.parent.removeChild(this);
			
		}
		
		
		private function resizeBMAPS(bmd:BitmapData){
			//RESET sizes
			trace("RESIZING BITMAPS");
			this.parent.finalBMAP = new BitmapData(bmd.width,bmd.height,false,0x0);
			this.parent.mmBMAP =  new BitmapData(bmd.width,bmd.height,false,0x0);
			this.parent.mBMAP =  new BitmapData(bmd.width,bmd.height,false,0x0);
			this.parent.finalBMAP = bmd.clone();
			this.parent.mBMAP = bmd.clone();
			this.parent.mmBMAP = bmd.clone();
			
			
		}
		
			
		private function draw_crop_image(redrawBool:Boolean){
			
			var img_width:int = this.parent.effectBMAP.width;
			var img_height:int = this.parent.effectBMAP.height ;
			
			if (!( this.parent.effectBMAP.width < 450 &&  this.parent.effectBMAP.height <  450))
			{
						
			if ( this.parent.effectBMAP.width > this.parent.effectBMAP.height) // landscape
			{
				img_width = this.parent.effectBMAP.width * (450 / this.parent.effectBMAP.width  );
				img_height = this.parent.effectBMAP.height * (450 / this.parent.effectBMAP.width  ); 
				factor = 450 / this.parent.effectBMAP.width ;
			}
			if ( this.parent.effectBMAP.width < this.parent.effectBMAP.height) //portrait
			{
				img_width = this.parent.effectBMAP.width * (450 / this.parent.effectBMAP.height );
				img_height = this.parent.effectBMAP.height * (450 / this.parent.effectBMAP.height ); 
				factor = 450 / this.parent.effectBMAP.height ;
			}
			}
			
			trace("Echo " + factor );
			
			if (redrawBool){
				crop_box.removeChild(previewImg);
			}
				
			previewImg =  new Bitmap(this.parent.effectBMAP);
			with (previewImg) {
				x = 0 ;
				y = 0;
				width = img_width;
				height = img_height;
			} 
			
			if (redrawBool){
				removeChild(crop_box);
			}
			
			crop_box= new Sprite();
			crop_box.name = "CROP_BOX";
			with (crop_box){
			x = 200;
			y = 80;
			graphics.beginFill(0xffffff);
        	graphics.drawRect(0, 0, previewImg.width,previewImg.height);
        	graphics.endFill();
			width = previewImg.width;
			height = previewImg.height;
			addChild(previewImg);
			}
			
			addChild(crop_box);
			with (crop_box){
					addEventListener(MouseEvent.MOUSE_DOWN, rectStartingPoint,false,1);
					addEventListener(MouseEvent.MOUSE_MOVE, rectDraw,false,2);
					}
			
		}
		
			
	
	
		private function rectStartingPoint(m:MouseEvent):void
		{	
			if(m.ctrlKey){
			trace("MOUSE DOWN  EVENT:");
			crop_down = true;
			drawn = false;
			ltx = mouseX;
			lty = mouseY;
			trace(m.target.name);
			crop_box.addEventListener(MouseEvent.MOUSE_UP, stopRectDraw,false, 31);
		}
		}

	private function rectDraw(m:MouseEvent):void {
		
		if(m.ctrlKey){
		if(crop_down == true){
			//trace("MOUSE MOVE EVENT:");
			//m.updateAfterEvent();
			rtx = mouseX;
			rty = mouseY;

			var myRectangle:Shape = new Shape();
			myRectangle.graphics.beginFill(0xffffff);
            myRectangle.graphics.lineStyle(1, 0x000000);
            myRectangle.graphics.drawRect(ltx, lty, rtx - ltx, rty - lty);
            myRectangle.graphics.endFill();
			if(drawn ==  true){
			removeChild(myRectSp);
			}
			myRectSp = new Sprite();
			myRectSp.addChild(myRectangle);
			myRectSp.alpha = 0.5;
			
			this.addChild (myRectSp);
			drawn = true;
			
			}
		}
	}
		private function stopRectDraw(m:MouseEvent):void
		{
			
			if(!m.ctrlKey){
			trace("MOUSE UP EVENT:");
			crop_down = false;
			drawn = false ;
			resizeBMAPS(this.parent.effectBMAP);
			}
		}

		private function crop_action(e:MouseEvent){

			trace("effectBMAP width : " +this.parent.effectBMAP.width + " height "  +this.parent.effectBMAP.height); 
			this.parent.effectBMAP = new BitmapData((rtx - ltx) * (1/factor),(rty - lty) * (1/factor),false,0x0);
			this.parent.effectBMAP.copyPixels(this.parent.finalBMAP,new Rectangle((ltx - 200) * (1/factor) , (lty - 80) * (1/factor)  ,(rtx - ltx) * (1/factor),(rty - lty ) * (1/factor)),new Point(0,0));
			
			//this.parent.effectBMAP.copyPixels(this.parent.finalBMAP,new Rectangle( (myRectSp.x - 200) * (1/factor) , (myRectSp.y - 80) * (1/factor)  ,(myRectSp.width) * (1/factor),(myRectSp.height) * (1/factor)),new Point(0,0));			

			
			trace("effectBMAP width : " +this.parent.effectBMAP.width + " height "  +this.parent.effectBMAP.height); 
			resize_x.text = this.parent.effectBMAP.width;
			resize_y.text = this.parent.effectBMAP.height;
			
			draw_crop_image(true);
			
		}
		
		private function save_crop_action(e:MouseEvent){

			resizeBMAPS(this.parent.effectBMAP);
			this.parent.updatePreview(this.parent.effectBMAP,true);
			this.parent.effect_applied = true;
			this.parent.preview_drawn = false;
			this.parent.removeChild(this);
					
		}
		
		private function reset_crop(e:MouseEvent){
			removeChild(myRectSp);
			
		}
	
		//---- BLUR -----//
		
		public function draw_blur():void{
			trace("BLUR CALLED");
			
			sliderX = new Slider();			
			sliderX.maximum = 255;
			sliderX.minimum = 0;
			sliderX.snapInterval = 1;
			sliderX.liveDragging = true;
			sliderX.x = 100;
			sliderX.y = 20 ;
			sliderX.height = 60;
			sliderX.width = 500 ; //this.width - 150;
			sliderX.addEventListener(SliderEvent.CHANGE, apply_blur);
			if(slider_value_blur_x != -1000)
				sliderX.value = slider_value_slider_value_blur_x ;
			else 
				sliderX.value = 0;
			sliderX.name = "X";
			addChild(sliderX);
			
			sliderX_label = new Label();
			sliderX_label.htmlText = "<font color='#FFFFFF' size='12px'>Horizontal: " + String(sliderX.value) + "</font>" ;
			sliderX_label.x = 20;
			sliderX_label.y = 20;
			sliderX_label.alpha = 1;
			sliderX_label.width = 80;
			sliderX_label.wordWrap = true;
			this.addChild(sliderX_label);
			
			sliderY = new Slider();			
			sliderY.maximum = 255;
			sliderY.minimum = 0;
			sliderY.snapInterval = 1;
			sliderY.liveDragging = true;
			sliderY.x = 100;
			sliderY.y = 40 ;
			sliderY.height = 60;
			sliderY.width = 500 ; // this.width - 150;
			sliderY.addEventListener(SliderEvent.CHANGE, apply_blur);
			if(slider_value_blur_y != -1000)
				sliderY.value = slider_value_slider_value_blur_y ;
			else 
				sliderY.value = 0;
			sliderX.name = "Y";
			addChild(sliderY);
			
			sliderY_label = new Label();
			sliderY_label.htmlText = "<font color='#FFFFFF' size='12px'>Vertical: " + String(sliderY.value) + "</font>" ;
			sliderY_label.x = 20;
			sliderY_label.y = 40;
			sliderY_label.alpha = 1;
			sliderY_label.width = 80;
			sliderY_label.wordWrap = true;
			this.addChild(sliderY_label);
			
			Quantity = new Slider();			
			Quantity.maximum = 3;
			Quantity.minimum = 1;
			Quantity.snapInterval = 1;
			Quantity.liveDragging = true;
			Quantity.x = 100;
			Quantity.y = 60 ;
			Quantity.height = 60;
			Quantity.width = 500 ; //this.width - 150;
			Quantity.addEventListener(SliderEvent.CHANGE, apply_blur);
			if(slider_value_blur_q != -1000)
				Quantity.value = slider_value_slider_value_blur_q ;
			else 
				Quantity.value = 0;
			Quantity.name = "Q";
			addChild(Quantity);
			
			Quantity_label = new Label();
			Quantity_label.htmlText = "<font color='#FFFFFF' size='12px'>Quality: " + String(Quantity.value) + "</font>" ;
			Quantity_label.x = 20;
			Quantity_label.y = 60;
			Quantity_label.alpha = 1;
			Quantity_label.width = 80;
			Quantity_label.wordWrap = true;
			this.addChild(Quantity_label);
		}
		
		private function apply_blur(event:SliderEvent):void{
			var myBlur = new BlurFilter(int(sliderX.value),int(sliderY.value),int(Quantity.value));
			sliderX_label.htmlText = "<font color='#FFFFFF' size='12px'>Horizontal: " + String(sliderX.value) + "</font>" ;
			sliderY_label.htmlText = "<font color='#FFFFFF' size='12px'>Vertical: " + String(sliderY.value) + "</font>" ;
			Quantity_label.htmlText = "<font color='#FFFFFF' size='12px'>Quality: " + String(Quantity.value) + "</font>" ;

			this.parent.effectBMAP.applyFilter(this.parent.finalBMAP, new Rectangle(0,0,this.parent.finalBMAP.width,this.parent.finalBMAP.height), new Point(0, 0), myBlur);
			this.parent.updatePreview(this.parent.effectBMAP,true);
			this.parent.effect_applied = true;
		}
		
		
		//SEPIA //
		
		public function apply_sepia(){
			var matrix:Array = new Array();
			matrix = matrix.concat([0.35, 0.35, 0.35, 0, 0]);
			// red
			matrix = matrix.concat([0.3, 0.3, 0.3, 0, 0]);
			// green
			matrix = matrix.concat([0.21, 0.21, 0.21, 0, 0]);
			// blue
			matrix = matrix.concat([0, 0, 0, 1, 0]);
			// alpha
			var Sepiafilter:BitmapFilter = new ColorMatrixFilter(matrix);
			this.parent.effectBMAP.applyFilter(this.parent.finalBMAP, new Rectangle(0,0,this.parent.finalBMAP.width,this.parent.finalBMAP.height), new Point(0, 0), Sepiafilter);
			this.parent.updatePreview(this.parent.effectBMAP,true);
			this.parent.effect_applied = true;
		}
		
		// TINT //
		
		
		// GRAY SCALE //
		
		public function apply_grayScale(){
			var elements:Array =   [0.33, 0.33, 0.33, 0, 0,
									0.33, 0.33, 0.33, 0, 0,
									0.33, 0.33, 0.33, 0, 0,
									0, 0, 0, 1, 0];
									
			var grayScaleFilter:ColorMatrixFilter = new ColorMatrixFilter(elements);
			this.parent.effectBMAP.applyFilter(this.parent.finalBMAP, new Rectangle(0,0,this.parent.finalBMAP.width,this.parent.finalBMAP.height), new Point(0, 0), grayScaleFilter);
			this.parent.updatePreview(this.parent.effectBMAP,true);
			this.parent.effect_applied = true;
			
		}
		

		// prepares bitmap Array for effect preview
		public function prepare_bitmaps(count:int){
			bitmaps_preview = new Array(count+1);
			trace ("bitmap length " + bitmaps_preview.length);
			var bm_height;// = this.parent.effectBMAP.height;
			var bm_width;// = this.parent.effectBMAP.width ;
			
			this.parent.effectBMAP
			
			if ( this.parent.effectBMAP.width >= this.parent.effectBMAP.height) // landscape
			{
				bm_width = this.parent.effectBMAP.width * (160 / this.parent.effectBMAP.width );
				
				bm_height = this.parent.effectBMAP.height * (160 / this.parent.effectBMAP.width  ); 
				
			}
			if ( this.parent.effectBMAP.width < this.parent.effectBMAP.height) //portrait
			{
				bm_width = this.parent.effectBMAP.width * (120 / this.parent.effectBMAP.height );
				bm_height = this.parent.effectBMAP.height * (120 / this.parent.effectBMAP.height ); 
			}

			trace("BM_WIDTH : " + bm_width);
			trace("BM_Height: " + bm_height);
			
			
			
			for (var i:int ; i <= count ; i++){
			
			bitmaps_preview[i] = new effectPreview(this.parent.effectBMAP,bm_width,bm_height);
			if(i != count)
			this.addChild(bitmaps_preview[i]);
			if(i == 0)
			bitmaps_preview[i].x = 5 ; 
			else
			bitmaps_preview[i].x = bitmaps_preview[i-1].x + bm_width + 10 ; 
			bitmaps_preview[i].y = 5; 
			bitmaps_preview[i].width = bm_width;
			bitmaps_preview[i].height = bm_height;
			}
		}
			
		
		
		// Apply Filter 
		private function applyFilter(dest:BitmapData , src:BitmapData, matrix:Array) {
            var matrixX:Number = 3;
            var matrixY:Number = 3;
            var divisor:Number = 9;
            var filter:BitmapFilter = new ConvolutionFilter(matrixX, matrixY, matrix, divisor);
			/* actually applies the filter to the bitmapData rather than child.filters */
			dest.applyFilter(src, new Rectangle(0,0,src.width,src.height), new Point(0, 0), filter);
	    }
		// child == null , mat : Matrix
		private function apply_color_effect(dest:BitmapData, src:BitmapData,mat:ColorMatrix):void{

			var cm:ColorMatrixFilter = new ColorMatrixFilter(mat.matrix);
			dest.applyFilter(src,new Rectangle(0,0,src.width,src.height),new Point(0,0),cm);
			
		}
		
	}
}