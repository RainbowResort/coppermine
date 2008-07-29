package
{	import gui.picGrid;
	import flash.display.Sprite;
	import com.yahoo.astra.animation.Animation;
	import com.yahoo.astra.animation.AnimationEvent;
	import com.yahoo.astra.fl.containers.BorderPane;
	import com.yahoo.astra.layout.modes.BorderConstraints;
	import gui.Header;
	import gui.albumListing;
	import flash.display.MovieClip;
	
	import gui.Console;
	import gui.Editor;
	
	import fl.controls.List;
	import fl.data.DataProvider;
	
	import flash.display.Shape;
	import flash.display.StageAlign;
	import flash.display.StageScaleMode;
	import flash.events.Event;
	import flash.text.TextFormat;
	import flash.utils.clearTimeout;
	import flash.utils.setTimeout;

public class player extends MovieClip{

	var grid:Sprite ;
	var myTree;
	public 	var editor; //:Sprite;
	public function player(){
		
			super();
			
		if(this.stage)
		{
			this.stage.scaleMode = StageScaleMode.NO_SCALE;
			this.stage.align = StageAlign.TOP_LEFT;
			//this.stage.addEventListener(Event.RESIZE, stageResizeHandler, false, 0, true);
		}
		
			grid = new picGrid(0,0,800,500);
			grid.x = 200;
			grid.y = 10;
			addChild(grid);
			
			
			myTree = new albumListing(200,this.height);
			myTree.x=0;
			myTree.y=10;
			addChild(myTree);
			myTree.attach(grid);
		
}
}
}