<?php
/**************************************************
  Coppermine 1.5.x Plugin - JSmin
  *************************************************
  Copyright (c) 2010 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/
  
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Compress JS files
$thisplugin->add_filter('javascript_includes','compr_js');


function compr_js($js_includes)
{
   global $LINEBREAK;
   $compr_JS_algo = 0;  // algorithm for JS compression:
                        // 0 = merge jquery, scripts.js, greybox, elastic into one file, merge the others to second file, compress with jsmin and gzip if browser supports it (default)
                        // 1 = merge in one file and use packer
                        // 2 = merge in one file and use jsmin (recommended)
                        // 3 = keep different files and use packer
                        // 4 = keep different files and use jsmin (recommended)
                        // 5 = keep different files and use jsmin with gzip for browsers that support it (recommended)
                        // 6 = merge in one file and use jsmin with gzip for browsers that support it (recommended)
                        // 7 = just merge in one file
   $JSstring = '';
   $JScontent = '';

   if (!GALLERY_ADMIN_MODE) 
   {
       $js_arraycount = count($js_includes);
       switch ($compr_JS_algo)
       {
       
       // case 0 (default): merge basic files into one file, merge the others to second file, compress with jsmin and gzip if browser supports it
       case 0:
           require 'jsmin/jsmin.php';
           // gzip works with Firefox, Opera, Chrome, IE7+
           // but browser must be setup to accept gzip encoding
           $client_array = cpg_determine_client();
           $jsserver = Inspekt::makeSuperCage();
           $jsacceptencoding = $jsserver->server->getRaw('HTTP_ACCEPT_ENCODING');
           if (in_array($client_array['browser'], array('Firefox', 'Opera', 'Chrome', 'IE8', 'IE7')) == TRUE && substr_count($jsacceptencoding, 'gzip') && defined('FORCE_GZIP'))
           {
               // check if basic files are there and compress them to one file
               if (in_array('js/jquery-1.3.2.js', $js_includes) && in_array('js/scripts.js', $js_includes) && in_array('js/jquery.greybox.js', $js_includes) && in_array('js/jquery.elastic.js', $js_includes))
               {
                 $JShash = md5('js/jquery-1.3.2.jsjs/scripts.jsjs/jquery.greybox.jsjs/jquery.elastic.js');
                 if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js.gz'))
                 {
                   $JScontent = file_get_contents('js/jquery-1.3.2.js').$LINEBREAK.file_get_contents('js/scripts.js').$LINEBREAK.file_get_contents('js/jquery.greybox.js').$LINEBREAK.file_get_contents('js/jquery.elastic.js').$LINEBREAK;
                   $JSpackedcontent = JSMin::minify($JScontent);
                   $JSgzipcontent = gzencode($JSpackedcontent);
                   $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js.gz',"w+");
                   fwrite($JSnewfile,$JSgzipcontent);
                   fclose($JSnewfile);
                 }
                 $js_jquery = 'plugins/jsmin/cache/'.$JShash.'.js.gz';
                 unset($js_includes[array_search('js/scripts.js',$js_includes)]);
                 unset($js_includes[array_search('js/jquery.greybox.js',$js_includes)]);
                 unset($js_includes[array_search('js/jquery.elastic.js',$js_includes)]);
                 // compress the rest to another file
	               $JScontent = '';
	               for ($i = 1; $i < $js_arraycount; $i++) 
	               {
	                   $JSstring .= $js_includes[$i];
	               }
	               $JShash = md5($JSstring.$compr_JS_algo);
	    
	               // generate new file 
	               if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js.gz'))
	               {
	                   for ($i = 1; $i < $js_arraycount; $i++) 
	                   {
	                       $JScontent .= file_get_contents($js_includes[$i]).$LINEBREAK;
	                   }
	                   $JSpackedcontent = JSMin::minify($JScontent);
	                   $JSgzipcontent = gzencode($JSpackedcontent);
	                   $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js.gz',"w+");
	                   fwrite($JSnewfile,$JSgzipcontent);
	                   fclose($JSnewfile);
	               }
	               $js_includes = array();
	               $js_includes[] = $js_jquery;
	               $js_includes[] ='plugins/jsmin/cache/'.$JShash.'.js.gz';
             }
             else
             {
	               // basic files not found - compress all to one file
	               for ($i = 0; $i < $js_arraycount; $i++) 
	               {
	                   $JSstring .= $js_includes[$i];
	               }
	               $JShash = md5($JSstring.$compr_JS_algo);
	    
	               // generate new file 
	               if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js.gz'))
	               {
	                   for ($i = 0; $i < $js_arraycount; $i++) 
	                   {
	                       $JScontent .= file_get_contents($js_includes[$i]).$LINEBREAK;
	                   }
	                   $JSpackedcontent = JSMin::minify($JScontent);
	                   $JSgzipcontent = gzencode($JSpackedcontent);
	                   $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js.gz',"w+");
	                   fwrite($JSnewfile,$JSgzipcontent);
	                   fclose($JSnewfile);
	               }
	               $js_includes = array();
	               $js_includes[] ='plugins/jsmin/cache/'.$JShash.'.js.gz';
             }
          }
          else
          {
               // check if basic files are there and compress them to one file
               if (in_array('js/jquery-1.3.2.js', $js_includes) && in_array('js/scripts.js', $js_includes) && in_array('js/jquery.greybox.js', $js_includes) && in_array('js/jquery.elastic.js', $js_includes))
               {
                 $JShash = md5('js/jquery-1.3.2.jsjs/scripts.jsjs/jquery.greybox.jsjs/jquery.elastic.js');
                 if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js'))
                 {
                   $JScontent = file_get_contents('js/jquery-1.3.2.js').$LINEBREAK.file_get_contents('js/scripts.js').$LINEBREAK.file_get_contents('js/jquery.greybox.js').$LINEBREAK.file_get_contents('js/jquery.elastic.js').$LINEBREAK;
                   $JSpackedcontent = JSMin::minify($JScontent);
                   $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js',"w+");
                   fwrite($JSnewfile,$JSpackedcontent);
                   fclose($JSnewfile);
                 }
                 $js_query = 'plugins/jsmin/cache/'.$JShash.'.js';
                 unset($js_includes[array_search('js/scripts.js',$js_includes)]);
                 unset($js_includes[array_search('js/jquery.greybox.js',$js_includes)]);
                 unset($js_includes[array_search('js/jquery.elastic.js',$js_includes)]);
                 // compress the rest to another file
                 $JScontent = '';
	               for ($i = 1; $i < $js_arraycount; $i++) 
	               {
	                   $JSstring .= $js_includes[$i];
	               }
	               $JShash = md5($JSstring.$compr_JS_algo);
	    
	               // generate new file 
	               if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js'))
	               {
	                   for ($i = 1; $i < $js_arraycount; $i++) 
	                   {
	                       $JScontent .= file_get_contents($js_includes[$i]).$LINEBREAK;
	                   }
	                   $JSpackedcontent = JSMin::minify($JScontent);
	                   $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js',"w+");
	                   fwrite($JSnewfile,$JSpackedcontent);
	                   fclose($JSnewfile);
	               }
	               $js_includes = array();
	               $js_includes[] = $js_query;
	               $js_includes[] ='plugins/jsmin/cache/'.$JShash.'.js';
             }
             else
             {
	               // basic files not found - compress all to one file
	               for ($i = 0; $i < $js_arraycount; $i++) 
	               {
	                   $JSstring .= $js_includes[$i];
	               }
	               $JShash = md5($JSstring.$compr_JS_algo);
	    
	               // generate new file 
	               if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js'))
	               {
	                   for ($i = 0; $i < $js_arraycount; $i++) 
	                   {
	                       $JScontent .= file_get_contents($js_includes[$i]).$LINEBREAK;
	                   }
	                   $JSpackedcontent = JSMin::minify($JScontent);
	                   $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js',"w+");
	                   fwrite($JSnewfile,$JSpackedcontent);
	                   fclose($JSnewfile);
	               }
	               $js_includes = array();
	               $js_includes[] ='plugins/jsmin/cache/'.$JShash.'.js';
             }
          }
         break;
       
       
       // case 1: merge in one file and use packer to compress
       case 1:
           for ($i = 0; $i < $js_arraycount; $i++) 
           {
               $JSstring .= $js_includes[$i];
           }
           $JShash = md5($JSstring.$compr_JS_algo);

           // generate new file 
           if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js'))
           {
              for ($i = 0; $i < $js_arraycount; $i++) 
              {
                  $JScontent .= file_get_contents($js_includes[$i]).$LINEBREAK;
              }
              require 'packer/class.JavaScriptPacker.php';
              $JSpacker = new JavaScriptPacker($JScontent, 62, true, false);
              $JSpackedcontent = $JSpacker->pack();
              $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js',"w+");
              fwrite($JSnewfile,$JSpackedcontent);
              fclose($JSnewfile);
          }
          $js_includes = array();
          $js_includes[] ='plugins/jsmin/cache/'.$JShash.'.js';
          break;

       // case 2: merge in one file and use jsmin to compress
       case 2:
           for ($i = 0; $i < $js_arraycount; $i++) 
           {
               $JSstring .= $js_includes[$i];
           }
           $JShash = md5($JSstring.$compr_JS_algo);

           // generate new file 
           if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js'))
           {
               for ($i = 0; $i < $js_arraycount; $i++) 
               {
                   $JScontent .= file_get_contents($js_includes[$i]).$LINEBREAK;
               }
               require 'jsmin/jsmin.php';
               $JSpackedcontent = JSMin::minify($JScontent);
               $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js',"w+");
               fwrite($JSnewfile,$JSpackedcontent);
               fclose($JSnewfile);
         }
         $js_includes = array();
         $js_includes[] ='plugins/jsmin/cache/'.$JShash.'.js';
         break;
         
       // case 3: use packer to compress each file
       case 3:
           require 'packer/class.JavaScriptPacker.php';
           for ($i = 0; $i < $js_arraycount; $i++) 
           {
               $JShash = md5($js_includes[$i].$compr_JS_algo);
               if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js'))
               {
                   $JScontent = file_get_contents($js_includes[$i]);
                   $JSpacker = new JavaScriptPacker($JScontent, 62, true, false);
                   $JSpackedcontent = $JSpacker->pack();
                   $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js',"w+");
                   fwrite($JSnewfile,$JSpackedcontent);
                   fclose($JSnewfile);
               }
               $js_includes[$i] = 'plugins/jsmin/cache/'.$JShash.'.js';
          }
          break;

       // case 4: use JSmin to compress each file
       case 4:
           require 'jsmin/jsmin.php';
           for ($i = 0; $i < $js_arraycount; $i++) 
           {
              $JShash = md5($js_includes[$i].$compr_JS_algo);
              if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js'))
              {
                  $JScontent = file_get_contents($js_includes[$i]);
                  $JSpackedcontent = JSMin::minify($JScontent);
                  $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js',"w+");
                  fwrite($JSnewfile,$JSpackedcontent);
                  fclose($JSnewfile);
              }
              $js_includes[$i] = 'plugins/jsmin/cache/'.$JShash.'.js';
           }
           break;

       // case 5: use JSmin with gzip for FF to compress each file
       case 5:
           require 'jsmin/jsmin.php';
           // gzip works with Firefox, Opera, Chrome, IE7+
           // but browser must be setup to accept gzip encoding
           $client_array = cpg_determine_client();
           $jsserver = Inspekt::makeSuperCage();
           $jsacceptencoding = $jsserver->server->getRaw('HTTP_ACCEPT_ENCODING');
           if (in_array($client_array['browser'], array('Firefox', 'Opera', 'Chrome', 'IE8', 'IE7')) == TRUE && substr_count($jsacceptencoding, 'gzip') && defined('FORCE_GZIP'))
           {
               for ($i = 0; $i < $js_arraycount; $i++) 
               {
                  $JShash = md5($js_includes[$i].$compr_JS_algo);
                  if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js.gz'))
                  {
                      $JScontent = file_get_contents($js_includes[$i]);
                      $JSpackedcontent = JSMin::minify($JScontent);
                      $JSgzipcontent = gzencode($JSpackedcontent);
                      $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js.gz',"w+");
                      fwrite($JSnewfile,$JSgzipcontent);
                      fclose($JSnewfile);
                  }
                  $js_includes[$i] = 'plugins/jsmin/cache/'.$JShash.'.js.gz';
               }
           }
           else
           // other browsers get JSmin without gzip
           {
              for ($i = 0; $i < $js_arraycount; $i++) 
              {
                  $JShash = md5($js_includes[$i].$compr_JS_algo);
                  if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js'))
                  {
                      $JScontent = file_get_contents($js_includes[$i]);
                      $JSpackedcontent = JSMin::minify($JScontent);
                      $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js',"w+");
                      fwrite($JSnewfile,$JSpackedcontent);
                      fclose($JSnewfile);
                  }
                  $js_includes[$i] = 'plugins/jsmin/cache/'.$JShash.'.js';
              }
          }
          break;

       // case 6: merge in one file and use jsmin with gzip to compress
       case 6:
           require 'jsmin/jsmin.php';
           // gzip works with Firefox, Opera, Chrome, IE7+
           // but browser must be setup to accept gzip encoding
           $client_array = cpg_determine_client();
           $jsserver = Inspekt::makeSuperCage();
           $jsacceptencoding = $jsserver->server->getRaw('HTTP_ACCEPT_ENCODING');
           if (in_array($client_array['browser'], array('Firefox', 'Opera', 'Chrome', 'IE8', 'IE7')) == TRUE && substr_count($jsacceptencoding, 'gzip') && defined('FORCE_GZIP'))
           {

               for ($i = 0; $i < $js_arraycount; $i++) 
               {
                   $JSstring .= $js_includes[$i];
               }
               $JShash = md5($JSstring.$compr_JS_algo);
    
               // generate new file 
               if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js.gz'))
               {
                   for ($i = 0; $i < $js_arraycount; $i++) 
                   {
                       $JScontent .= file_get_contents($js_includes[$i]).$LINEBREAK;
                   }
                   $JSpackedcontent = JSMin::minify($JScontent);
                   $JSgzipcontent = gzencode($JSpackedcontent);
                   $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js.gz',"w+");
                   fwrite($JSnewfile,$JSgzipcontent);
                   fclose($JSnewfile);
               }
               $js_includes = array();
               $js_includes[] ='plugins/jsmin/cache/'.$JShash.'.js.gz';
           }
           else
           {
               // other browsers get JSmin without gzip
               for ($i = 0; $i < $js_arraycount; $i++) 
               {
                   $JSstring .= $js_includes[$i];
               }
               $JShash = md5($JSstring.$compr_JS_algo);
    
               // generate new file 
               if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js'))
               {
                   for ($i = 0; $i < $js_arraycount; $i++) 
                   {
                       $JScontent .= file_get_contents($js_includes[$i]).$LINEBREAK;
                   }
                   $JSpackedcontent = JSMin::minify($JScontent);
                   $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js',"w+");
                   fwrite($JSnewfile,$JSpackedcontent);
                   fclose($JSnewfile);
               }
               $js_includes = array();
               $js_includes[] ='plugins/jsmin/cache/'.$JShash.'.js';
         }
         break;

       // case 7: just merge in one file
       case 7:
           for ($i = 0; $i < $js_arraycount; $i++) 
           {
               $JSstring .= $js_includes[$i];
           }
           $JShash = md5($JSstring.$compr_JS_algo);

           // generate new file 
           if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js'))
           {
               for ($i = 0; $i < $js_arraycount; $i++) 
               {
                   $JScontent .= file_get_contents($js_includes[$i]).$LINEBREAK;
               }

               $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js',"w+");
               fwrite($JSnewfile,$JScontent);
               fclose($JSnewfile);
           }
           $js_includes = array();
           $js_includes[] ='plugins/jsmin/cache/'.$JShash.'.js';
           break;
       }
   }
   return $js_includes;
}

?>