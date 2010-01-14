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
$thisplugin->add_action('page_start','compr_js');


function compr_js() 
{
   global $JS,$LINEBREAK;
   $compr_JS_algo = 4;  // algorithm for JS compression 0 = just merge in one file, 1 = merge in one file and use packer, 2 = merge in one file and use jsmin,
                        // 3 = keep different files and use packer, 4 = keep different files and use jsmin (recommended)
   $JSstring = '';
   $JScontent = '';
   if (!GALLERY_ADMIN_MODE) 
   {
       $js_arraycount = count($JS['includes']);


       {

           if ($compr_JS_algo == 0)
           {
				       for ($i = 0; $i < $js_arraycount; $i++) 
				       {
				           $JSstring .= $JS['includes'][$i];
				       }
				       $JShash = md5($JSstring.$compr_JS_algo);

               // generate new file 
               if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js'))
               {
				           for ($i = 0; $i < $js_arraycount; $i++) 
				           {
				               $JScontent .= file_get_contents($JS['includes'][$i]).$LINEBREAK;
				               $JSstring .= $JS['includes'][$i];
				           }

				           $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js',"w+");
				           fwrite($JSnewfile,$JScontent);
				           fclose($JSnewfile);
		           }
		           $JS['includes'] = array();
		           $JS['includes'][] ='plugins/jsmin/cache/'.$JShash.'.js';
           }
           if ($compr_JS_algo == 1)
           {
				       for ($i = 0; $i < $js_arraycount; $i++) 
				       {
				           $JSstring .= $JS['includes'][$i];
				       }
				       $JShash = md5($JSstring.$compr_JS_algo);

               // generate new file 
               if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js'))
               {
				          for ($i = 0; $i < $js_arraycount; $i++) 
				          {
				              $JScontent .= file_get_contents($JS['includes'][$i]).$LINEBREAK;
				          }
		              require 'packer/class.JavaScriptPacker.php';
		              $JSpacker = new JavaScriptPacker($JScontent, 62, true, false);
		              $JSpackedcontent = $JSpacker->pack();
		              $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js',"w+");
		              fwrite($JSnewfile,$JSpackedcontent);
		              fclose($JSnewfile);
              }
              $JS['includes'] = array();
              $JS['includes'][] ='plugins/jsmin/cache/'.$JShash.'.js';
          }
           if ($compr_JS_algo == 2)
           {
				       for ($i = 0; $i < $js_arraycount; $i++) 
				       {
				           $JSstring .= $JS['includes'][$i];
				       }
				       $JShash = md5($JSstring.$compr_JS_algo);

               // generate new file 
               if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js'))
               {
			             for ($i = 0; $i < $js_arraycount; $i++) 
			             {
			                 $JScontent .= file_get_contents($JS['includes'][$i]).$LINEBREAK;
			                 
			             }
                   require 'jsmin/jsmin.php';
                   $JSpackedcontent = JSMin::minify($JScontent);
		               $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js',"w+");
		               fwrite($JSnewfile,$JSpackedcontent);
		               fclose($JSnewfile);
             }
             $JS['includes'] = array();
             $JS['includes'][] ='plugins/jsmin/cache/'.$JShash.'.js';
          }
           if ($compr_JS_algo == 3)
           {
            require 'packer/class.JavaScriptPacker.php';
            for ($i = 0; $i < $js_arraycount; $i++) 
            {
               $JShash = md5($JS['includes'][$i].$compr_JS_algo);
               if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js'))
               {
                   $JScontent = file_get_contents($JS['includes'][$i]);
                   $JSpacker = new JavaScriptPacker($JScontent, 62, true, false);
                   $JSpackedcontent = $JSpacker->pack();
                   $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js',"w+");
                   fwrite($JSnewfile,$JSpackedcontent);
                   fclose($JSnewfile);
               }
               $JS['includes'][$i] = 'plugins/jsmin/cache/'.$JShash.'.js';
             }
           }
           if ($compr_JS_algo == 4)
           {
            require 'jsmin/jsmin.php';
            for ($i = 0; $i < $js_arraycount; $i++) 
            {
               $JShash = md5($JS['includes'][$i].$compr_JS_algo);
               if (!file_exists('plugins/jsmin/cache/'.$JShash.'.js'))
               {
                   $JScontent = file_get_contents($JS['includes'][$i]);
                   $JSpackedcontent = JSMin::minify($JScontent);
                   $JSnewfile = fopen('plugins/jsmin/cache/'.$JShash.'.js',"w+");
                   fwrite($JSnewfile,$JSpackedcontent);
                   fclose($JSnewfile);
               }
               $JS['includes'][$i] = 'plugins/jsmin/cache/'.$JShash.'.js';
            }
          }
       }
   }
}

?>