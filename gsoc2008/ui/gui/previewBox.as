/*
	@DESC Holds the preview images for a given effect
	@AUTHOR SRIBABU DODDAPANENI
	@CONTACT root [at] rusticgeek.net
*/

package gui
{
	import com.yahoo.astra.fl.containers.HBoxPane;
	import com.yahoo.astra.layout.modes.VerticalAlignment;
	
	import fl.controls.TextInput;
	import gui.effectPreview;
	
	
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
		
		//draws a preview box of a given height and width
		public function previewBox(heightParm:int ,widthParm:int)
		{
			
			this.graphics.beginFill(0x000000);
            this.graphics.drawRect(0, 0, widthParm, heightParm);
            this.graphics.endFill();
			
			var myBorder:Sprite = new Sprite();
			myBorder.graphics.lineStyle(2, 0x333333);
			myBorder.graphics.drawRect (this.x ,this.y , this.width , this.height );
			this.addChild (myBorder);
		}
		
		// draw the preview thumbnails of the exposure settings // add properties
		private function draw_exposure(){
			
			
		}
		
		//Applies a specific exposure TO BE IMPLEMENTED
		private function apply_exposure(parameter:int){
			switch (parameter){
				case 1 : //exposure
				draw_exposure();
				break;
				case 2 : //sharpness
				draw_sharpness()
				break;
				case 3 :
				draw_blurring();
				break;
			}
			
			
		}
		
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
			for (var i:int = 0 ; i < bitmaps_preview.length  ; i++)
			{
				applyFilter(bitmaps_preview[i].bitmap, matrices[i]);
				bitmaps_preview[i].effectValue.push(matrices[i]);
				bitmaps_preview[i].addEventListener(MouseEvent.CLICK,apply_sharpen,false, 0, true);
				bitmaps_preview[i].buttonMode = true;
				addChild(bitmaps_preview[i]);
			}
		}
		
		//Applies the sharpen filter
		private function apply_sharpen(e:MouseEvent):void{
			applyFilter(this.parent.previewImg,e.target.effectValue.pop());
		
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
			//matrices.push([10, 10, 10,
//                           10, 0, 10,
//                           10, 10, 10]);
			for (var i:int = 0 ; i < bitmaps_preview.length  ; i++)
			{
				
				applyFilter(bitmaps_preview[i].bitmap, matrices[i]);
				bitmaps_preview[i].effectValue.push(matrices[i]);
				bitmaps_preview[i].addEventListener(MouseEvent.CLICK,apply_brighten,false, 0, true);
				bitmaps_preview[i].buttonMode = true;
				addChild(bitmaps_preview[i]);
			}
		}
		
		// applies brighten effect to the preview Image
		private function apply_brighten(e:MouseEvent):void{
			applyFilter(this.parent.previewImg,e.target.effectValue.pop());
		
		}
		
		private function draw_blurring(){
			
			
		}
		
		private function apply_blurring(){
			
		}
		
		private function draw_thumbnails(){
						
			
		}
		
		// prepares bitmap Array for effect preview
		public function prepare_bitmaps(count:int){
			

			bitmaps_preview = new Array(count);
			trace ("bitmap length " + bitmaps_preview.length);
			for (var i:int ; i < count ; i++){
			
			bitmaps_preview[i] = new effectPreview(this.parent.previewImg);
			this.addChild(bitmaps_preview[i]);
			if(i == 0)
			bitmaps_preview[i].x = 5 ; 
			else
			bitmaps_preview[i].x = bitmaps_preview[i-1].x + 160 + 10 ; 
			bitmaps_preview[i].y = 5;
			bitmaps_preview[i].width = 160;
			bitmaps_preview[i].height = 120;
				
			}
			
		}
		
		// Apply Filter 
		private function applyFilter(child:DisplayObject, matrix:Array):void {
            var matrixX:Number = 3;
            var matrixY:Number = 3;
            var divisor:Number = 9;
            var filter:BitmapFilter = new ConvolutionFilter(matrixX, matrixY, matrix, divisor);
			/* actually applies the filter to the bitmapData rather than child.filters */
			child.bitmapData.applyFilter(child.bitmapData, new Rectangle(0,0,child.bitmapData.width,child.bitmapData.height), new Point(0, 0), filter);
        }
		
		
	}
}