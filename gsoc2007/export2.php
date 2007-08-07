<?php
$album = 2;						 // Album to export
$path  = 'testExport'; // Path to export to

$filename = "thumbnails.php";
$_GET['album'] = $album;

$src  =  "themes/classic";
$dest =  "$path/themes/classic";
recursive_copy($src,$dest);

if(is_file($filename)) {
	include $filename;
	$contents = ob_get_contents();
	ob_end_clean();

	$contents = preg_replace('/<!-- BEGIN [^\-]+ -->[^\!]+!-- END [^\-]+--> /',' ',$contents);

  $pictures = cpg_db_query("SELECT pid,title,filename,filepath FROM {$CONFIG['TABLE_PICTURES']} WHERE `aid` = '$album'");

	$picture_r = array();
  while($picture = mysql_fetch_array($pictures))
  {
  	$picture_r[$picture['pid']] = $picture['filepath'].$picture['filename'];
		if(!is_dir('$path/albums/'.$picture['filepath']))
			recursive_mkdir('$path/albums/'.$picture['filepath']);
		copy('albums/'.$picture['filepath'].$picture['filename'],'$path/albums/'.$picture['filepath'].$picture['filename']);
		copy('albums/'.$picture['filepath'].'thumb_'.$picture['filename'],'$path/albums/'.$picture['filepath'].'thumb_'.$picture['filename']);
		
		$contents = preg_replace("/displayimage.php\?album=$album&amp;pid={$picture['pid']}/",'albums/'.$picture['filepath'].$picture['filename'],$contents);
  }

	file_put_contents("$path/index.html",$contents);

	echo "success.<br><a href=$path/>Exported Album</a>";
	
}


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
		if($entry== '.' || $entry == '..' || preg_match('/^\./',$entry))
			continue;
		if($dest !== "$src/$entry") {
			recursive_copy("$src/$entry","$dest/$entry");
		}
	}
}

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