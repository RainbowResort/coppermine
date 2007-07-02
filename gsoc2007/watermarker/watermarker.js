function write_watermarker(flashvars) { 
document.write("<object  classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0\" width=\"600\" height=\"500\">")
document.write("      <param name=\"movie\" value=\"./watermarker/configurator.swf\" />")
document.write(flashvars)
document.write("      <param name=\"quality\" value=\"high\" />")
document.write("</object>")
document.write("<br /><iframe frameborder=\"0\" id=\"iframe\" height=\"400\" width=\"500\" src=\"\" style=\"display:none\"></iframe>")
}

function previewIframe(vars){
	var rand = "&ran=" + Math.floor(Math.random()*999999); 
	document.getElementById("iframe").style.display = '';
	document.getElementById("iframe").src = './watermarker.php?action=preview' + vars + rand;
}