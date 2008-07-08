package gui {
	import flash.display.Sprite;
	import fl.containers.UILoader;
	import caurina.transitions.*;
	import flash.events.MouseEvent;
	import fl.controls.Label;
	
	 import flash.events.Event;
	
	public class Thumbnail extends Sprite {
		private var nume:String;
		private var url:String;
		private var id:int;
		private var loader:UILoader;
		private var selectbox :Sprite;
		
		private var thumbType:int; // 0 : CAT 1: ALBM 2: PIC
		private var thumbDBID:int;	//id from the database
		private var label:String;	//the label is usually the name for category / album
		
	
		private var optionslbl:Label;
		function Thumbnail(source:String,itemNr:int,numeThumb:String):void {
			url = source;
			id = itemNr;
			this.nume = numeThumb;
			drawLoader();
			addEventListener(MouseEvent.MOUSE_OVER,onOver);
			addEventListener(MouseEvent.MOUSE_OUT,onOut);
			scaleThumb();
			//addEventListener(MouseEvent.DOUBLE_CLICK,doubleClick);

		}
		
		private function myevent(event:Event):void {
		trace("clickevent occured ");
 		event.stopPropagation();
	}
		
		private function drawLoader():void {
			loader = new UILoader();
			loader.source = url;
			loader.mouseEnabled = false;
			loader.x = -50;
			loader.y = -50;
			loader.height = 75;
			loader.width = 108;
			addChild(loader);

		}
		private function onOver(event:MouseEvent):void {
			//Tweener.addTween(this, {scaleX:1,scaleY:1, time:1, transition:"easeoutelastic"});
			Tweener.addTween(this, {alpha:1, time:1, transition:"easeoutelastic"});
			var optionslbl:Label = new Label();
			optionslbl.htmlText = "<font color='#FFFFFF'>options</font>" ; // "<strong>" + source  + "</strong>" ;//"<font color=#000000>" + source + "</font>" ;//color //source;
			optionslbl.y = 30  ;//height - 10;
			optionslbl.x = -30 ;
			optionslbl.alpha = 0.3;
			optionslbl.opaqueBackground = 0x333333;
			optionslbl.blendMode =  "lighten"
			optionslbl.addEventListener(MouseEvent.CLICK, myevent);
			this.addChild(optionslbl);
			Tweener.addTween(optionslbl, {alpha:1, time:1, transition:"easeoutelastic"});
			
		}
		private function onOut(event:MouseEvent):void {
		//	Tweener.addTween(this, {scaleX:.9,scaleY:.9, time:1, transition:"easeoutelastic"});
			Tweener.addTween(this, {alpha:.5, time:1, transition:"easeoutelastic"});
			//removeChild(toolbar);
			Tweener.addTween(optionslbl, {alpha:0, time:1, transition:"easeoutelastic"});
		//	removeChild(optionslbl);
		}
		private function scaleThumb():void {
			this.scaleX = .9;
			this.scaleY = .9;
			this.alpha = .5;
		}
		
		private function doubleClick(event:MouseEvent):void {
			
			
		}
		
		private function draw_select_box():void{
			selectbox = new Sprite();
			selectbox.graphics.beginFill(0x00FF00);
			selectbox.graphics.drawRect(this.width-40,10,20, 20);
            trace(this.width);
			selectbox.graphics.endFill();
			selectbox.buttonMode = true;
			this.addChild(selectbox);

		}
		
	}
}