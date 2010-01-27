<?php
define('IN_COPPERMINE', true);
define('LOGIN_PHP', true);
require('include/init.inc.php');


$input = $_GET['input'];
$type = $_GET['type'];
$len = strlen($input);
	
if ($len){

	$aResults = array();
		
	$searchword = explode(" ", $input);
			
	if($type == 'Files'){		
		for( $i = 0; $i < sizeof($searchword); $i++ ){
			$searchword[$i] = "title LIKE '%" .$searchword[$i]. "%'";
		}
		$ready = implode(" AND ", $searchword);
		$result = cpg_db_query("SELECT pid, title, aid FROM {$CONFIG['TABLE_PICTURES']} as p WHERE $ready $ALBUM_SET");
		while ($row = mysql_fetch_array($result)) {	
			$albums = cpg_db_query("SELECT title, aid FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid = {$row['aid']}");
			$album = mysql_fetch_array($albums);
			$aResults[] = array("id"=>($row['pid']) ,"value"=>htmlspecialchars($row['title']), "info"=>htmlspecialchars('Album: '.$album['title']) );
			mysql_free_result($albums);
		}//End While
	}elseif($type == 'Albums'){
		for( $i = 0; $i < sizeof($searchword); $i++ ){
			$searchword[$i] = "{$CONFIG['TABLE_ALBUMS']}.title LIKE '%" .$searchword[$i]. "%'";
		}
		$ready = implode(" AND ", $searchword);
		$result = cpg_db_query("SELECT {$CONFIG['TABLE_ALBUMS']}.aid, {$CONFIG['TABLE_ALBUMS']}.title, COUNT({$CONFIG['TABLE_PICTURES']}.pid) FROM  {$CONFIG['TABLE_ALBUMS']}, {$CONFIG['TABLE_PICTURES']} WHERE ({$CONFIG['TABLE_PICTURES']}.aid={$CONFIG['TABLE_ALBUMS']}.aid AND $ready) GROUP BY {$CONFIG['TABLE_PICTURES']}.aid ORDER BY {$CONFIG['TABLE_ALBUMS']}.title ASC");
		while ($row = mysql_fetch_array($result)) {	
			$aResults[] = array("id"=>($row['aid']) ,"value"=>htmlspecialchars($row['title']), "info"=>htmlspecialchars('Total Files: '.$row[2]) );
			mysql_free_result($albums);
		}//End While
	}

		mysql_free_result($result);
}
	//output the response
	header("Content-Type: text/xml");
	echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?><results>";
	for ($i=0;$i<count($aResults);$i++)	{
		echo "<rs id=\"".$aResults[$i]['id']."\" info=\"".$aResults[$i]['info']."\">".$aResults[$i]['value']."</rs>";
	}
	echo "</results>";


?>