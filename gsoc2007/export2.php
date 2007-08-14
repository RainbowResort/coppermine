<?php
if(isset($_POST['exportSubmit']) && isset($_POST['directory']) && isset($_POST['album']))
{
  $album = $_POST['album'];						 // Album to export
  $path  = $_POST['directory']; // Path to export to

  $filename = "thumbnails.php";
  $_GET['album'] = $album;
  if(is_file($filename)) {
    include $filename;
    $contents = ob_get_contents();
    ob_end_clean();

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
    $pictures = cpg_db_query("SELECT pid,title,filename,filepath FROM {$CONFIG['TABLE_PICTURES']} WHERE `aid` = '$album'");

    $picture_r = array();
    while($picture = mysql_fetch_array($pictures))
    {
      $picture_r[$picture['pid']] = $picture['filepath'].$picture['filename'];
      if(!is_dir("$path/albums/{$picture['filepath']}")) {
        recursive_mkdir("$path/albums/{$picture['filepath']}");
      }
      copy("albums/{$picture['filepath']}{$picture['filename']}","$path/albums/{$picture['filepath']}{$picture['filename']}");
      copy("albums/{$picture['filepath']}thumb_{$picture['filename']}","$path/albums/{$picture['filepath']}thumb_{$picture['filename']}");

      // Need to replace img lings to displayimage.php with direct links to photographs
      $contents = preg_replace("/displayimage.php\?album=$album&amp;pid={$picture['pid']}/",'albums/'.$picture['filepath'].$picture['filename'],$contents);
    }

    // Find out the theme currently used and copy over necessary files to replicate this
    $result = cpg_db_query("SELECT value FROM {$CONFIG['TABLE_CONFIG']} WHERE `name` = 'theme'");
    $theme  = mysql_fetch_array($result);

    recursive_copy("themes/{$theme['value']}","$path/themes/{$theme['value']}");


    file_put_contents("$path/index.html",$contents);

    header("location:$path");
  } 
} else {
  define('IN_COPPERMINE',true);
  require("include/init.inc.php");
  if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
    pageheader($section, $meta_keywords);
  starttable('60%', 'Chose an Album');
  ?>
    <tr><td><p>This is very experimental/early functionality demo.  This takes the album you specify from the drop down and copies the files necessary to render a static html file of the first page of thumbnails in the directory you specify in the export directory field (relative path from here). Note: this utilizes the current theme and settings but strips menus to inaccessible functions.  Debug info will show up if you have it configured to do so.</td></tr>
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
    <input type='submit' name='exportSubmit' value='Submit'/>
    </form>
    <br/><br/>
  <?php
  endtable();
  echo "<br/><br/><br/><br/>";
        
  pagefooter();


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