<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2007 Coppermine Dev Team
  Originally written by Daniel Hammond

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision:  $
  $LastChangedBy:  $
  $Date:  $
**********************************************/

define('IN_COPPERMINE',true);

require("include/init.inc.php");

if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

if(isset($_POST['album']) && isset($_POST['directory'])) 
{
  mkdir($_POST['directory']);
  pageheader($section, $meta_keywords);
  starttable('100%', 'ID',2);
  echo "<tr><td>ID</td><td>Path</td></tr>";
  $pic_array = array();
  $pictures = cpg_db_query("SELECT pid,title,filename,filepath FROM {$CONFIG['TABLE_PICTURES']} WHERE `aid` = {$_POST['album']}");
  while($picture = mysql_fetch_array($pictures))
  {
    echo "<tr><td><span id='id_{$picture['pid']}'>{$picture['pid']}</span></td><td><span id='path_{$picture['pid']}'>{$picture['filepath']}{$picture['filename']}</span></td></tr>\n";
    $pic_array[] = $picture;
  }
  
  $js_pictures = phpArrayToJS($pic_array,'pictures');
  
  ?>
    
    <script type="text/javascript">
      var <?php echo $js_pictures ?>;
      processPicture(0);
      
      function processPicture(offset)
      {
        if(offset >= pictures.length) {return 0;};
        	// Create an xmlHttp Object (Tries Activex object then xmlHttp request)
          try {
            ajxobj = new ActiveXObject('Msxml2.XMLHTTP');
          } catch (e) {
            try {
              ajxobj = new ActiveXObject('Microsoft.XMLHTTP');
                } catch (E) {
                 ajxobj = false;
              }
          }
            if (!ajxobj && typeof XMLHttpRequest!='undefined') {
              ajxobj = new XMLHttpRequest(); //If we were able to get a working active x object, start an XMLHttpRequest
            } 
            ajxobj.onreadystatechange=function() {	//Handle successful xmlHttp transfer
              if(ajxobj.readyState==4) {
                document.getElementById('path_'+pictures[offset]['pid']).style.textDecoration = 'line-through';
                document.getElementById('id_'+pictures[offset]['pid']).style.textDecoration = 'line-through';
                processPicture(offset+1);
              }
            };
            
            // Generate and do xmlHttp call
          ajxobj.open('GET',"<?php echo $_SERVER[PHP_SELF]?>?dir=<?php echo $_POST[directory]?>&id=" + pictures[offset]['pid'], true);
          ajxobj.send(null);
      }



    </script>
    
  <?
  
  endtable();
} else if (isset($_GET['id']) && isset($_GET['dir'])) { 
  $result = cpg_db_query("SELECT filename,filepath,title FROM {$CONFIG['TABLE_PICTURES']} WHERE `pid` = '{$_GET['id']}' LIMIT 1");
  $picture = mysql_fetch_array($result);

  $safename  = preg_replace('[\s]','_',$picture['title']);
  $safename  = preg_replace('[\W]','',$safename);
  
  $extension = preg_replace('[^\.]','',$picture['filename']); // Extract file extension
  $filename  = $safename . $extension;
  
  copy('albums/'.$picture['filepath'].$picture['filename'],$_GET[dir].'/'.$filename);
} else {
  pageheader($section, $meta_keywords);
  starttable('60%', 'Chose an Album');
  ?>
    <tr><td><p>This is very experimental/early functionality demo.  Do not use unless you would just like to see how it works.  Do not run on a large album, throttling will be added soon.  At the moment all this does is take the directory name you give it and writes out the pictures in the album in that directory with filenames based on their titles.  Directory name can be a relative path to the root coppermine dir.</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
    <td>
    Select a Album:
    <form action='<?php echo $_SERVER['PHP_SELF']?>' method='POST'>
    <select name='album' class='listbox'>
      <?php
        $albums = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_ALBUMS']} WHERE 1 ORDER BY `title`");
        while($album = mysql_fetch_array($albums)) {
          echo "<option value='$album[aid]'>$album[title]</option>";
        }
      ?>
    </select><br/>
    Export Directory:<br/>
    <input type='text' value='export' name='directory'/><br/><br/>
    <input type='submit' value='Submit'/>
    </form>
    <br/><br/>
  <?php
  endtable();
  echo "<br/><br/><br/><br/>";
        
  pagefooter();
}



// Based on code by Rob Williams
//Convert a PHP array to a JavaScript one (rev. 4)
function phpArrayToJS($array, $baseName) {
  
	$return = '';
  
  //Write out the initial array definition
  $return .= ($baseName . " = new Array(); \r\n ");    
  
  //Reset the array loop pointer
  reset ($array);
  
  //Use list() and each() to loop over each key/value
  //pair of the array
  while (list($key, $value) = each($array)) {
    if (is_numeric($key)) {
      //A numeric key, so output as usual
      $outKey = "[" . $key . "]";
    } else {
      //A string key, so output as a string
      $outKey = "['" . $key . "']";
    }
    
    if (is_array($value)) {
      //The value is another array, so simply call
      //another instance of this function to handle it
      $return .= phpArrayToJS($value, $baseName . $outKey);
    } else {
      
      //Output the key declaration
      $return .= ($baseName . $outKey . " = ");      
      
      //Now output the value
      if (is_numeric($value)){
        $return .= ($value . "; \r\n ");
      } else if (is_string($value)) {
        //Output as a string, as we did before       
        $return .= ("'" . $value . "'; \r\n ");
      } else if ($value === false) {
        //Explicitly output false
        $return .= ("false; \r\n ");
      } else if ($value === NULL) {
        //Explicitly output null
        $return .= ("null; \r\n ");
      } else if ($value === true) {
        //Explicitly output true
        $return .= ("true; \r\n ");
      } else {
        //Output the value directly otherwise
        $return .= ($value . "; \r\n ");
      }
    }
  }
  
  return $return;
}
