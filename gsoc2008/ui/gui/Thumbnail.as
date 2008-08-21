/*
Thumbnail class
Loads Thumbnails based on the type and URL


Author : Sribabu Doddapaneni
mail: root [at] rusticgeek.net
*/

package gui {
	import flash.display.Sprite;
	import fl.containers.UILoader;
	import caurina.transitions.*;
	import flash.events.MouseEvent;
	import fl.controls.Label;
	
	 import flash.events.Event;
	
	public class Thumbnail extends Sprite {

		//thumbnail vars
		public var id:int;
		private var tag:String;
		public var type:String;
		public var bURL:String;
		private var sURL:String;
		private var  loader_height:int;
		private var loader_width:int;
		
		private var optionslbl:Label;
		private var loader:UILoader; // holds the image
		//private var 
		private var selectbox :Sprite;
		var cover:Sprite = new Sprite();
		var tag_lbl:Label = new Label();
		
		
		// border around the image
		var myBorder:Sprite = new Sprite();
		
		var coloredBorder:Sprite = new Sprite();
		var coloredBorderBool:Boolean;
		
		
		function Thumbnail(id:int,tag:String,type:String,bURL:String,sURL:String,_width:int,_height:int):void {
			this.id = id;
			this.tag = tag;
			this.type = type;
			this.bURL = bURL;
			this.sURL = sURL;
			loader_height = _height ;
			loader_width = _width;
			this.width = _width;
			this.height = _height;
			drawLoader(false);
			
			addEventListener(MouseEvent.MOUSE_OVER,onOver);
			addEventListener(MouseEvent.MOUSE_OUT,onOut);
			
			//change the border on multiselect
			addEventListener(MouseEvent.CLICK,clickHappened);
			coloredBorderBool = false;
			scaleThumb();
			}
		
		private function myevent(event:Event):void {
		//trace("clickevent occured ");
 		//event.stopPropagation();
	}
	
		private function clickHappened(event:MouseEvent){
			if (event.ctrlKey){
							
			if(coloredBorderBool == false){
				coloredBorder = new Sprite();
				coloredBorder.graphics.lineStyle(2, 0xFF8C00);
				coloredBorder.graphics.drawRect (-(loader_width/2),-(loader_height/2),loader_width, loader_height);
				coloredBorder.graphics.endFill();
				
				this.addChild (coloredBorder);
				coloredBorderBool = true
				
			}
			}
			
		}
	
		public function resetBorder(){
			//trace("------------------- Removing borders -------------");
			if(coloredBorderBool == true)
			{
				//trace("Removing border for : ID : " + id);
				this.removeChild(coloredBorder);
				coloredBorderBool = false;
			}
			
		}
		
		private function drawLoader(resize:Boolean):void {
			if(this.type == "CAT")
			{
			drawBoxWithLabel(this.tag,resize);
							
			}
			else if (this.type == "ALB")
			{
				
				drawBoxWithLabel(this.tag,resize);
			}
			else {
				//trace("drawing the loader");
			if(!resize)
			{
			loader = new UILoader();
			loader.scaleContent = true;
			//trace(sURL+ "?cacheBust=" + Math.random() * 9);
			loader.source = sURL + "?cacheBust="  + Math.random() ;
			loader.mouseEnabled = false;
			}
			loader.x = -(loader_width/2);
			loader.y = -(loader_height/2);
			loader.height = loader_height ; // 75 ; //this.height;
			loader.width = loader_width ; //108 ; //this.width;
			if(!resize)
			addChild(loader);
			}
		}
		
		private function onOver(event:MouseEvent):void {
			Tweener.addTween(this, {alpha:1, time:1, transition:"easeoutelastic"});

			myBorder = new Sprite();
			myBorder.graphics.lineStyle(2, 0xFFFFFF);
			myBorder.graphics.drawRect (-(loader_width/2),-(loader_height/2),loader_width, loader_height);
			myBorder.graphics.endFill();
			this.addChild (myBorder);
		}
		
		private function onOut(event:MouseEvent):void {
		//	Tweener.addTween(this, {scaleX:.9,scaleY:.9, time:1, transition:"easeoutelastic"});
			Tweener.addTween(this, {alpha:.5, time:1, transition:"easeoutelastic"});
			removeChild(myBorder);
		}
		private function scaleThumb():void {
			this.scaleX = .9;
			this.scaleY = .9;
			this.alpha = .5;
		}
		

		
		//resizes a thumbnail
		public function resize(newWidth:int, newHeight:int):void{
			loader_width = newWidth;
			loader_height = newHeight;
			drawLoader(true);
		}
		
		// we use fillers for Categories and Albums
		private function drawBoxWithLabel(lbl:String,resize:Boolean){
				//if(resize)
				//this.removeChild(cover);
							
				cover.x = -(loader_width/2);
				cover.y = -(loader_height/2);
				cover.graphics.beginFill(0x333333,1);
				cover.graphics.drawRect(0,0,loader_width,loader_height);
				cover.graphics.endFill();
						
				tag_lbl.htmlText = "<font color='#FFFFFF' size='15px'>" + lbl + "</font>" ;
				tag_lbl.x = -(loader_width/2);
				tag_lbl.y = -(loader_height/2);
				tag_lbl.alpha = 1 ; 
				tag_lbl.width = loader_width;
				tag_lbl.height = loader_height;
				tag_lbl.wordWrap = true;
				tag_lbl.opaqueBackground = 0x333333;
				tag_lbl.blendMode =  "lighten"
				if(!resize)
				this.addChild(tag_lbl);

				
			
		}
		
	
	}
}