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
require('include/init.inc.php');

if(isset($_POST['exportSubmit']))
{
  ($_POST['exportType'] == 'html') ? initHTMLExport($_POST['album'],$_POST['directory']) : initPhotoCopy($_POST['album'],$_POST['directory']);
} else if (isset($_GET['album']) && isset($_GET['path']) && isset($_GET['page'])) {
  exportThumbnailPage();
} else if (isset($_GET['id']) && isset($_GET['dir'])) { 
  copyPhoto($_GET['id'],$_GET['dir']);
} else {
  pageheader($section, $meta_keywords);
  starttable('60%', 'Chose an Album');
  ?>
    <tr><td>&nbsp;</td></tr>
    <tr>
    <form action='<?php echo $_SERVER['PHP_SELF']?>' method='POST'>
    <td>
    Export Type:<br/>
    <input type='radio' name='exportType' value='html'>Formatted HTML</input> <input type='radio' name='exportType' value='img'>Images Only</input><br/><br/>
    Select a Album:
    <select name='album' class='listbox'>
      <?php
        $albums = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_ALBUMS']} WHERE 1 ORDER BY `title`");
        while($album = mysql_fetch_array($albums)) {
          echo "<option value='$album[aid]'>$album[title]</option>";
        }
      ?>
    </select><br/><br/>
    Export Directory:<br/>
    <input type='text' value='export' name='directory'/><br/><br/>
    <input type='submit' name='exportSubmit' value='Submit'/>
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

function initHTMLExport($album,$path)
{
  global $CONFIG;

  $pictures = cpg_db_query("SELECT pid,title,filename,filepath FROM {$CONFIG['TABLE_PICTURES']} WHERE `aid` = '$album'");
  $picture_r = array();
  // Copy pictures to export directory
  while($picture = mysql_fetch_array($pictures))
  {
    $picture_r[$picture['pid']] = $picture['filepath'].$picture['filename'];
    if(!is_dir("$path/albums/{$picture['filepath']}")) {
      recursive_mkdir("$path/albums/{$picture['filepath']}");
    }
    copy("albums/{$picture['filepath']}{$picture['filename']}","$path/albums/{$picture['filepath']}{$picture['filename']}");
    copy("albums/{$picture['filepath']}thumb_{$picture['filename']}","$path/albums/{$picture['filepath']}thumb_{$picture['filename']}");
  }

  $pages = ceil(count($picture_r)/($CONFIG['thumbrows']*$CONFIG['thumbcols'])); // Calculate number of thumnail pages necessary 
  pageheader($section, $meta_keywords);

  echo "<p align=center>Processing...</p>";
  echo<<<EOT
    
    <script type="text/javascript">
      var album = "{$album}";
      var path = "{$path}";
      var pages = "{$pages}";
      getPage(1);
      function getPage(page)
      {
        if(page<=pages) {
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
                  getPage(page+1);
                }
              };
              
              // Generate and do xmlHttp call
            ajxobj.open('GET',"{$_SERVER['PHP_SELF']}?album="+album+"&path="+path+"&page="+page, true);
            ajxobj.send(null);
        } else {
          window.location = path;
        }
      }

    </script>
EOT;
}

function exportThumbnailPage()
{
    global $CONFIG;
    $album = $_GET['album'];
    $page = $_GET['page'];
    $path = $_GET['path'];
       
    $filename = "thumbnails.php";
    include $filename;
    $contents = ob_get_contents();
    ob_end_clean();

    $pictures = cpg_db_query("SELECT pid,title,filename,filepath FROM {$CONFIG['TABLE_PICTURES']} WHERE `aid` = '$album'");
    $picture_r = array();
    while($picture = mysql_fetch_array($pictures))
    {
      $picture_r[$picture['pid']] = $picture['filepath'].$picture['filename'];
    }
  
    // Create a DOM Object to parse the html (Removing links to dynamic content/functions that require php)
    $doc = new DomDocument();
    $doc->loadHtml($contents);
    $divs = $doc->getElementsByTagName('div');
    foreach($divs as $div)
    {
      if($div->getAttribute('id') == 'MENUS' || $div->getAttribute('class') == 'admin_menu_wrapper') {
        $div->setAttribute('style','display:none');
      }
    }
    $tds = $doc->getElementsByTagName('td');
    foreach($tds as $td)
    {
      if($td->getAttribute('class') == 'sortorder_options') {
        $td->setAttribute('style','display:none');
      }
    }
    
    $contents = $doc->saveHTML();

    foreach($picture_r as $id => $filename)
    {
      $contents = preg_replace("/displayimage.php\?album=$album&amp;pid=$id/","albums/$filename",$contents);    
    }
    $contents = preg_replace("/thumbnails.php\?album=2&amp;page=([\d]+)/",'thumbnails_$1.html',$contents);

    // Find out the theme currently used and copy over necessary files to replicate this
    $result = cpg_db_query("SELECT value FROM {$CONFIG['TABLE_CONFIG']} WHERE `name` = 'theme'");
    $theme  = mysql_fetch_array($result);

    recursive_copy("themes/{$theme['value']}","$path/themes/{$theme['value']}");

    file_put_contents("$path/thumbnails_$page.html",$contents);
    if($page==1)
      copy("$path/thumbnails_$page.html","$path/index.html");
}

function copyPhoto($id,$dir)
{
  global $CONFIG;
  $result = cpg_db_query("SELECT filename,filepath,title FROM {$CONFIG['TABLE_PICTURES']} WHERE `pid` = '$id' LIMIT 1");
  $picture = mysql_fetch_array($result);

  $safename  = preg_replace('[\s]','_',$picture['title']);
  $safename  = preg_replace('[\W]','',$safename);
  
  $extension = preg_replace('[^\.]','',$picture['filename']); // Extract file extension
  $filename  = $safename . $extension;
  
  copy('albums/'.$picture['filepath'].$picture['filename'],$dir.'/'.$filename);
}

function initPhotoCopy($album,$directory)
{
  global $CONFIG;
  mkdir($directory);
  pageheader($section, $meta_keywords);
  starttable('100%', 'ID',2);
  echo "<tr><td>ID</td><td>Path</td></tr>";
  $pic_array = array();
  $pictures = cpg_db_query("SELECT pid,title,filename,filepath FROM {$CONFIG['TABLE_PICTURES']} WHERE `aid` = '$album'");
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
}
// Does a recursive copy on a directory
function recursive_copy($src,$dest)
{
	// Base case, is file so just copy
	if (is_file($src)) {
		$c = copy($src, $dest);
		return $c;
	}


	if(!is_dir($dest)) {
		recursive_mkdir($dest);
	}
	
		$dir = dir($src);
		while (false !== $entry = $dir->read()) {		
		if($entry== '.' || $entry == '..' || preg_match('/^\./',$entry)) // Skips the index '.' and '..' along with hidden files
			continue;
		if($dest !== "$src/$entry") {
			recursive_copy("$src/$entry","$dest/$entry");
		}
	}
}

// Recursively makes directories as necessary to create a given path:
function recursive_mkdir( $folder )
{
$folder = explode( DIRECTORY_SEPARATOR , $folder );
$mkfolder = '';
for(  $i=0 ; isset( $folder[$i] ) ; $i++ )
    {
    $mkfolder .= $folder[$i];
    if( !is_dir( $mkfolder ) )
        mkdir( "$mkfolder" ,  0777);
    $mkfolder .= DIRECTORY_SEPARATOR;
    }
}
?>

