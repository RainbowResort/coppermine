package gui{
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
	import flash.net.URLLoader;
	import flash.net.URLLoaderDataFormat;
	import fl.controls.ComboBox;
	import fl.data.DataProvider;
	import fl.controls.TextInput;
	import fl.controls.TextArea;
	import fl.controls.RadioButtonGroup;
	import fl.controls.RadioButton;


	public class PhotoProperties extends Sprite {
		var urlLoader:URLLoader;
		public function PhotoProperties(photoID:int,widthParm:int, heightParm:int) {

			this.graphics.beginFill(0x333333);
			this.graphics.drawRect(0, 0, widthParm, heightParm);
			this.graphics.endFill();
			// Load Vars
			var urlRequest:URLRequest = new URLRequest("flashmanager.php?photoinfo=1&photo=" + photoID);
			urlLoader = new URLLoader();
			urlLoader.dataFormat = URLLoaderDataFormat.VARIABLES;
			urlLoader.addEventListener(Event.COMPLETE, urlLoader_complete);
			urlLoader.load(urlRequest);
		}
		private function htmlTxt(txt:String,fontSize:int):String {
			return String("<font color='#FFFFFF' size='" + fontSize + "'>" + txt + "</font>");
		}
		function urlLoader_complete(evt:Event):void {
			// UI
			var desc:Label = new Label();
			with (desc) {
				htmlText = htmlTxt("Description",13);
				x = 10;
				y = 10 ;
				wordWrap =1;
				alpha =1;
			}
			this.addChild(desc);

			var fileInfo:Label = new Label();
			with (fileInfo) {
				htmlText = htmlTxt("FileInfo : " + urlLoader.data.info ,12);
				x = 10;
				y = 30 ;
				width=500, wordWrap =1;
				alpha =1;
			}
			this.addChild(fileInfo);

			var Album:Label = new Label();
			with (Album) {
				htmlText = htmlTxt("Album",13);
				x = 10;
				y = 50 ;
				wordWrap =1;
				alpha =1;
			}
			this.addChild(Album);

			var AlbumCombo:ComboBox = new ComboBox();
			var dp:DataProvider = new DataProvider();

			with (AlbumCombo) {
				x = 80 ;
				y = 50;
				width= 150;
				var AlbArr:String =  urlLoader.data.AlbumArray;
				trace(AlbArr);
				var my_array:Array = AlbArr.split(",");
				for (var i = 0; i<my_array.length; i++) {
					dp.addItem( { label: my_array[i] } );
					trace(my_array[i]);
				}
			}
			this.addChild(AlbumCombo);
			AlbumCombo.dataProvider = dp;

			
			//TITLE
			var Title:Label = new Label();
			with (Title) {
				htmlText = htmlTxt("Title",13);
				x = 10;
				y = 80 ;
				wordWrap =1;
				alpha =1;
			}
			this.addChild(Title);
			
			var TitleIP:TextInput = new TextInput();
			with (TitleIP) {
				text = urlLoader.data.Title;
				x = 80;
				y = 80 ;
				width = 150;
				wordWrap =1;
				alpha =1;
			}
			this.addChild(TitleIP);
			
			var Filename:Label = new Label();
			with (Filename) {
				htmlText = htmlTxt("File",13);
				x = 10;
				y = 110 ;
				wordWrap =1;
				alpha =1;
			}
			this.addChild(Filename);
			
			var FilenameIP:TextInput = new TextInput();
			with (FilenameIP) {
				text = urlLoader.data.Filename;
				x = 80;
				y = 110 ;
				width = 150;
				wordWrap =1;
				alpha =1;
			}
			this.addChild(FilenameIP);
			
			var Desc:Label = new Label();
			with (Desc) {
				htmlText = htmlTxt("Desc",13);
				x = 10;
				y = 135 ;
				wordWrap =1;
				alpha =1;
			}
			this.addChild(Desc);
			
			var DescIP:TextArea = new TextArea();
			with (DescIP) {
				text = urlLoader.data.Desc;
				x = 80;
				y = 135 ;
				width = 250;
				height = 100;
				wordWrap =1;
				alpha =1;
			}
			this.addChild(DescIP);
			
			//KEYWORDS 
			var keywords:Label = new Label();
			with (keywords) {
				htmlText = htmlTxt("Keywords",13);
				x = 10;
				y = 240 ;
				wordWrap =1;
				alpha =1;
			}
			this.addChild(keywords);
			
			var keywordsIP:TextInput = new TextInput();
			with (keywordsIP) {
				text = urlLoader.data.keywords;
				x = 80;
				y = 240 ;
				width = 150;
				wordWrap =1;
				alpha =1;
			}
			this.addChild(keywordsIP);
			
			//APPROVAL
			var Approval:Label = new Label();
			with (Approval) {
				htmlText = htmlTxt("Approval",13);
				x = 10;
				y = 270 ;
				wordWrap =1;
				alpha =1;
			}
			this.addChild(Approval);
			
			var myRadioGroup:RadioButtonGroup = new RadioButtonGroup("options");
			//myRadioGroup.addEventListener(Event.CHANGE, changeHandler);
			
			var appYES:RadioButton = new RadioButton();
			appYES.label = "Yes";
			appYES.value = "YES";
			appYES.group = myRadioGroup;
			//appYes.move(60,260);
			addChild(appYES);
			
			var appNO:RadioButton = new RadioButton();
			appNO.label = "NO";
			appNO.value = "NO";
			appNO.group = myRadioGroup;
//	appNO.move(60,260);
			addChild(appNO);

		}
	

	}
	
	
}