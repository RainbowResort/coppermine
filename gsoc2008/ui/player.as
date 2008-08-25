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
	import fl.controls.TextInput;
	import fl.controls.Label;
	import fl.controls.Button;
	import flash.events.MouseEvent;
	import flash.net.URLLoader;
	import flash.net.URLLoaderDataFormat;
	import fl.data.DataProvider;
	import flash.events.IOErrorEvent;
	import flash.net.*;

public class player extends MovieClip{

	var grid:Sprite ;
	var myTree;
	public 	var editor; //:Sprite;
	public var magik:String;
	
	var login_status:Label;
	var url_loader:URLLoader ;
	var login_box:Sprite ;
	var login_box_usr:TextInput;
	var login_box_pw:TextInput;
	var login_box_submit_button:Button;
	
	
	public function player(){
		
		super();
			
		if(this.stage)
		{
			this.stage.scaleMode = StageScaleMode.NO_SCALE;
			this.stage.align = StageAlign.TOP_LEFT;
			//this.stage.addEventListener(Event.RESIZE, stageResizeHandler, false, 0, true);
		}
		drawLogin();
		
		
		
		
		

		}
	
	private function drawLogin():void{
		
			
		login_box_usr = new TextInput();
		with(login_box_usr){
			x = 300;
			y = 200;
			width = 300;
			text = "Username";
		}

		login_box_pw = new TextInput();
		with (login_box_pw){
			x = 300;
			y = 250;
			width = 300;
			text = "Password" ;
			displayAsPassword = true;
		}
		
		login_box_submit_button = new Button();
		with (login_box_submit_button){
			x =  300 ;
			y = 300 ;
			label = " Login";
			addEventListener(MouseEvent.CLICK,handleLogin);
			
		}

		login_status = new Label();
		with (login_status){
			x = 300;
			y = 350;
			htmlText = "<font color='#FFFFFF' size='16px'> Enter your Coppermine Gallery Username and Password</font>" ;
			width = 400;
			height = 200;
			
			
		}
		
		addChild(login_box_usr);
		addChild(login_box_pw);
		addChild(login_box_submit_button);
		addChild(login_status);
		
			
		
	}
	
	private function handleLogin(event:MouseEvent){
		var request:URLRequest = new URLRequest( "flashmanager.php?check=1" );
		var variables:URLVariables = new URLVariables();
		request.method = URLRequestMethod.POST;
		variables.username  = login_box_usr.text;
		variables.password = login_box_pw.text ;

		request.data = variables;
		
		url_loader = new URLLoader();
		url_loader.addEventListener(Event.COMPLETE, login_complete);
		//url_loader.addEventListener(IOErrorEvent.IO_ERROR, onError);
		url_loader.load(request);
		
	}
	
	
	private function login_complete(e:Event){
		trace(url_loader.data);
		if(url_loader.data == "FAILED"){
			 login_status.htmlText = "<font color='#FFFFFF' size='16px'> Login Failed. Please try again</font>" ;
		}
		else{
		removeChild(login_box_usr);
		removeChild(login_box_pw);
		removeChild(login_box_submit_button);
		removeChild(login_status);
		magik = String(url_loader.data);
		trace("MAGIK " + magik);
		drawGrid();

						
		}
	}
	
	private function drawGrid():void{
			
			trace("MAGIK " + magik);
		
			grid = new picGrid(0,0,800,500);
			grid.x = 200;
			grid.y = 5;
			addChild(grid);
			grid.getAlbum(1,false);
			
			
			
			myTree = new albumListing(200,this.height);
			myTree.x=0;
			myTree.y=5;
			addChild(myTree);
			myTree.attach(grid);
			myTree.loadXML();
			
			
			
	}
		
		
		
}
}