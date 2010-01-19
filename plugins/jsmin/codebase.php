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

include('jsmin/jsmin.php');


// Compress JS files
$thisplugin->add_filter('javascript_includes','jsmin_compressjs');



function jsmin_compressjs($jsmin_includes)
{
   global $LINEBREAK, $superCage;

   if (!GALLERY_ADMIN_MODE && !in_array('plugins/jsmin/cache/basic.js', $jsmin_includes) && !in_array('plugins/jsmin/cache/basic.js.gz', $jsmin_includes))
   {
       // gzip works with Firefox, Opera, Chrome, IE7+
       // but browser must be setup to accept gzip encoding
       $jsmin_clientarray = cpg_determine_client();
       $jsmin_acceptencoding = $superCage->server->getRaw('HTTP_ACCEPT_ENCODING');
       
       // default suffix is .js
       $jsmin_suffix = '.js';
       if (in_array($jsmin_clientarray['browser'], array('Firefox', 'Opera', 'Chrome', 'IE8', 'IE7')) == TRUE && substr_count($jsmin_acceptencoding, 'gzip') && defined('FORCE_GZIP'))
       {
          // zlib there and browser supports it => suffix is now .js.gz
          $jsmin_suffix = '.js.gz';
       }

       // basic files
       if (!file_exists('plugins/jsmin/cache/basic'.$jsmin_suffix))
       {
         $jsmin_content = file_get_contents('js/jquery-1.3.2.js').$LINEBREAK.file_get_contents('js/scripts.js').$LINEBREAK.file_get_contents('js/jquery.greybox.js').$LINEBREAK.file_get_contents('js/jquery.elastic.js').$LINEBREAK;
         $jsmin_packedcontent = JSMin::minify($jsmin_content);
         if ($jsmin_suffix == '.js.gz') $jsmin_packedcontent = gzencode($jsmin_packedcontent);
         $jsmin_newfile = fopen('plugins/jsmin/cache/basic'.$jsmin_suffix,"w+");
         fwrite($jsmin_newfile,$jsmin_packedcontent);
         fclose($jsmin_newfile);
       }
       $jsmin_basicfiles = 'plugins/jsmin/cache/'.'basic'.$jsmin_suffix;
       if (in_array('js/jquery-1.3.2.js',$jsmin_includes)) unset($jsmin_includes[array_search('js/jquery-1.3.2.js',$jsmin_includes)]);
       if (in_array('js/scripts.js',$jsmin_includes)) unset($jsmin_includes[array_search('js/scripts.js',$jsmin_includes)]);
       if (in_array('js/jquery.greybox.js',$jsmin_includes)) unset($jsmin_includes[array_search('js/jquery.greybox.js',$jsmin_includes)]);
       if (in_array('js/jquery.elastic.js',$jsmin_includes)) unset($jsmin_includes[array_search('js/jquery.elastic.js',$jsmin_includes)]);

       // compress the rest to another file
       $jsmin_string = '';
       foreach ($jsmin_includes as $jsmin_file)
       {
           $jsmin_string .= $jsmin_file;
       }
       $jsmin_hash = md5($jsmin_string);

       // generate new file 
       if (!file_exists('plugins/jsmin/cache/'.$jsmin_hash.$jsmin_suffix))
       {
           $jsmin_content = '';
           foreach ($jsmin_includes as $jsmin_file) 
           {
               $jsmin_content .= file_get_contents($jsmin_file).$LINEBREAK;
           }
           $jsmin_packedcontent = JSMin::minify($jsmin_content);
           // $jsmin_packedcontent .= $LINEBREAK.'//'.$jsmin_string;
           if ($jsmin_suffix == '.js.gz') $jsmin_packedcontent = gzencode($jsmin_packedcontent);
           $jsmin_newfile2 = fopen('plugins/jsmin/cache/'.$jsmin_hash.$jsmin_suffix,"w+");
           fwrite($jsmin_newfile2,$jsmin_packedcontent);
           fclose($jsmin_newfile2);
       }
       $jsmin_includes = array();
       $jsmin_includes[] = $jsmin_basicfiles;
       if ($jsmin_hash != 'd41d8cd98f00b204e9800998ecf8427e') $jsmin_includes[] ='plugins/jsmin/cache/'.$jsmin_hash.$jsmin_suffix;
   }
   return $jsmin_includes;
}

?>