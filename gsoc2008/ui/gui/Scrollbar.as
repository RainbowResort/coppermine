//scrollbar Class
//author Sribabu Doddapaneni root AT rusticgeek.net

//draw track
//draw handler
//define bounds
//attach scrollbar to a particular object

package gui {
	
	import flash.display.Sprite;
	import fl.containers.UILoader;
	import caurina.transitions.*;
	import flash.events.MouseEvent;
	import fl.controls.Label;
	import flash.events.Event;
	import flash.net.*;
	import caurina.transitions.*;
	import flash.geom.Rectangle;

public class Scrollbar extends Sprite {
	private var pick:Sprite = new Sprite();
	private var track:Sprite =  new Sprite();
	
	private var obj_x:int;
	private var obj_y:int;
	private var obj_height:int;
	private var obj_width:int;	
	
	var minScroll:Number = 0;
	var maxScroll:Number ; //= track.height- handler.height;
	var dragging:Boolean = false;
	var bounds:Rectangle ; //= new Rectangle(track.x,track.y,0,maxScroll);
	var myObj:Object;
				
	//constructor
	// object which needs a scrollbar
	public function Scrollbar(myObj:Object){
	obj_x = myObj.x;
	obj_y = myObj.y;
	obj_height = myObj.height;
	obj_width = myObj.width;
	
	drawTrack();
	drawPick();
	maxScroll = track.height - pick.height;
	bounds = new Rectangle(track.x,track.y,0,maxScroll);
	}
	
	//object thats scrolled
	public function attach(myObj:Object):void{
		
		this.myObj=myObj;
	}
	
	public function drawPick():void{
			pick = new Sprite();
			pick.graphics.beginFill(0xFF9900,1); //orange pick
			pick.graphics.drawRect(obj_x + obj_width - 10, obj_y ,10,30);
			pick.graphics.endFill();
			addChild(pick);
			pick.buttonMode = true;
			pick.addEventListener(MouseEvent.MOUSE_DOWN,beginDrag);
	}
	
	public function drawTrack():void{
			
			track.graphics.beginFill(0x333333,1); //grey pick
			track.graphics.drawRect(obj_x + obj_width - 10, obj_y ,10,obj_height);
			track.graphics.endFill();
			addChild(track);
		
	}
	
	private function pick_startDrag(myObj:Sprite):void{
		//myObj.Dragging = true;
		
	}
	
function beginDrag(event:MouseEvent):void {
			pick.startDrag(false,bounds);
			dragging = true;
			pick.addEventListener(Event.ENTER_FRAME,checkingProgress);
			stage.addEventListener(MouseEvent.MOUSE_UP,endDrag);
		}
		function endDrag(event:MouseEvent):void {
			pick.stopDrag();
			dragging = false;
		}
		
		function checkingProgress(event:Event):void {
			var percent:Number = pick.y/maxScroll ;
			//trace("checking progress");
			//trace(percent);
			if (dragging) {
				Tweener.addTween(myObj,{x:0,y:(-percent*(myObj.height-track.height)),time:1});
			}
	}			
			
}
}