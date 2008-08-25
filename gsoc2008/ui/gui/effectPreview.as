/*
	
	@DESC Individual thumbnails showing Effect previews
	@AUTHOR SRIBABU DODDAPANENI
	@CONTACT root [at] rusticgeek.net

*/

package gui{
	
	import flash.display.Sprite;
	import fl.containers.UILoader;
	import caurina.transitions.*;
	import flash.events.MouseEvent;
	import fl.controls.Label;
	import flash.filters.ColorMatrixFilter;
    import flash.filters.BitmapFilter;
    import flash.filters.ConvolutionFilter;
	import flash.events.Event;
	import flash.geom.*;
	import flash.display.Bitmap;
	import flash.display.BitmapData;
	import flash.events.Event;
	
	
	public class effectPreview extends Sprite{
	
	
		var myBorder:Sprite = new Sprite();
		public var bitmap:Bitmap;
		public var effectValue:Array;
		var bm_width;
		var bm_height;
			
		//accepts and draws a bitmap. Usually a bitmap with no effects applied
		public function effectPreview(bm:Object,bm_w:int,bm_h:int):void{
			effectValue = new Array();
			var matrix:Matrix = new Matrix();
						
			bm_width = bm_w;
			bm_height = bm_h;
			
				
			var bd:BitmapData = new BitmapData(bm_width,bm_height,false,0x0); // transparent, in case your image is…
			matrix.scale( (bm_width / bm.bitmapData.width ), (bm_height / bm.bitmapData.height ));
			bd.draw(bm,matrix);
			bitmap = new Bitmap(bd);
			bitmap.height= bm_height;
			bitmap.width = bm_width;
			addChild(bitmap)
			addEventListener(MouseEvent.MOUSE_OVER,onOver);
			addEventListener(MouseEvent.MOUSE_OUT,onOut);
		}
		
		private function onOver(event:MouseEvent):void {
			myBorder = new Sprite();
			myBorder.graphics.lineStyle(2, 0xFFFFFF);
			myBorder.graphics.drawRect (0,0,bm_width,bm_height);
			this.addChild (myBorder);
		}
		
		private function onOut(event:MouseEvent):void {
			removeChild(myBorder);
		}
	}
}