package gui{
	import flash.display.Sprite;
	import fl.containers.UILoader;
	import caurina.transitions.*;
	import flash.events.MouseEvent;
	import fl.controls.Label;
	
	 import flash.events.Event;
	
	public class Thumb_holder extends Sprite {
		private var masker:Sprite;
		public function Thumb_holder(){
			}
			
		public function attach(myObj:Object):void{
			masker = new Sprite();
			masker.graphics.beginFill(0x000000,1);
			masker.graphics.drawRect(myObj.x,myObj.y,myObj.width,myObj.height);
			trace(myObj.x);
			trace (myObj.y-myObj.height);
			trace (myObj.width);
			trace (myObj.height);
			masker.graphics.endFill();
			addChild(masker);

		}
		
	}
}