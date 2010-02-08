// File is needed to set the greybox size dynamically
// Size of the greybox is passed via two private attributes in the link
// - The attributes values come from the plugin-configuration.
// I know it's not pretty with the two separate events, but I 
// just couldn't get the javascript to work otherwise. Help is
// appreciated :-)
$(document).ready(function() {
    for (func in onloads) {
        eval(onloads[func]);
    }
    $("a.flfbox").click(function(){
      var temp_width=0;
      var temp_height=0;
      

    	  temp_width=this.attributes['flfwidth'].value;
    	  temp_height=this.attributes['flfheight'].value;

      var t = this.title || $(this).text() || this.href;
      GB_show(t,this.href,temp_height,temp_width);
      return false;
    });


});