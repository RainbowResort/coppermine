var sbut_counter = 0;

function sbut_readCookie(sbut_name) {
    var sbut_nameEQ = sbut_name + "=";
    var sbut_ca = document.cookie.split(';');
    for(var i=0;i < sbut_ca.length;i++) 
    {
        var sbut_c = sbut_ca[i];
        while (sbut_c.charAt(0)==' ') sbut_c = sbut_c.substring(1,sbut_c.length);
        if (sbut_c.indexOf(sbut_nameEQ) == 0) return sbut_c.substring(sbut_nameEQ.length,sbut_c.length);
    }
    return null;
}

function sbut_col(px)
{
  document.getElementById("sbut_left").style.backgroundPosition = '100% '+px;
  document.getElementById("sbut_right").style.backgroundPosition = '0 '+px;
}

function sbut_mod()
{
if( sbut_counter%2 == 0 ) sbut_col('-59px');
else sbut_col('0px');
sbut_counter++;
if (sbut_counter < 11) setTimeout('sbut_mod()', 100);
else sbut_createCookie('startbutton',1);
}

function sbut_createCookie(sbut_name,sbut_value) {
    var sbut_date = new Date();
    sbut_date.setTime(sbut_date.getTime()+62208000000);
    var sbut_expires = "; expires="+sbut_date.toGMTString();
    document.cookie = sbut_name+"="+sbut_value+sbut_expires+"; path=/";
}

function sbut_addLoad(startbutfunc)
{
  var startbutoldonload = window.onload;
  if (typeof window.onload != 'undefined')
  { window.onload = startbutfunc; }
  else
  { window.onload = function() {
    if (startbutoldonload) { startbutoldonload(); }
    startbutfunc();
    };
  }
}

sbut_cookiestring = sbut_readCookie('startbutton');
if (!sbut_cookiestring) sbut_addLoad(sbut_mod);