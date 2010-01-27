<?php
/**************************************************
  Coppermine 1.4.x Plugin - Imageflow $VERSION$=2.03
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  **************************************************/
  
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
include_once ('./plugins/imageflow/include/init.inc.php');

// Add plugin_install action
$thisplugin->add_action('plugin_install','imageflow_install');

// Add page_start action for config button
$thisplugin->add_action('page_start','imageflow_page_start');

// Add plugin_uninstall action
$thisplugin->add_action('plugin_uninstall','imageflow_uninstall');

// Add search display action
$thisplugin->add_filter('plugin_block','imageflow_mainpage');

// Add filter for page head
$thisplugin->add_filter('page_html','imageflow_head');

global $IMAGEFLOWSET;
require('./plugins/imageflow/include/load_imageflowset.php');


// include some stuff in page header (css things that are needed for Imageflow)
function imageflow_head($imageflow_html,$IMAGEFLOWSET)
{        
global $IMAGEFLOWSET;
    
    $imageflow_headcode='';
    
    
    $imageflow_exper = '#(<\s*script\s*type\s*=\s*"text/javascript"\s*src\s*=\s*"scripts.js"\s*>\s*</script>)#i';
    $imageflow_headcode = <<<EOS
<link rel="stylesheet" title="Standard" href="plugins/imageflow/js/screen.css" type="text/css" media="screen" />
EOS;

    if ($IMAGEFLOWSET['imageflow_useenlarge']) {
	  $imageflow_headcode .= '<script language="JavaScript" type="text/javascript" src="plugins/imageflow/js/imageflowenl.js"></script>
	  ';
    }
    else
    {
	  $imageflow_headcode .= '<script language="JavaScript" type="text/javascript" src="plugins/imageflow/js/imageflow.js"></script>
	  ';
    }
    $imageflow_headcode.='<style type="text/css">
  ';
    $imageflow_headcode.='  #imageflow{background-color:#'.$IMAGEFLOWSET['imageflow_bgcolor'].';width:'.$IMAGEFLOWSET['imageflow_width'].';}
  ';
    if ($IMAGEFLOWSET['imageflow_intable']) { $imageflow_headcode.='  #imgflowcontainer{margin-top:'.$IMAGEFLOWSET['imageflow_topcorrect'].'px;width:'.$IMAGEFLOWSET['imageflow_width'].';}
  '; }
    $imageflow_headcode.='  #imgflowslider{background-image:url(\'plugins/imageflow/js/slider.gif\');}
';
    $imageflow_headcode.='</style>
    ';
    $imageflow_headcode.='
    <script type="text/javascript" src="scripts.js"></script>
    ';
	  $imageflow_html = preg_replace($imageflow_exper,$imageflow_headcode,$imageflow_html);
	  return $imageflow_html;
}


// add config button
function imageflow_add_config_button($href,$title,$target,$link)
{
  global $template_gallery_admin_menu;
  $new_template = $template_gallery_admin_menu;
  $button = template_extract_block($new_template,'documentation');
  $params = array(
      '{DOCUMENTATION_HREF}' => $href,
      '{DOCUMENTATION_TITLE}' => $title,
      'target="cpg_documentation"' => $target,
      '{DOCUMENTATION_LNK}' => $link,
   );
   $new_button="<!-- BEGIN $link -->".template_eval($button,$params)."<!-- END $link -->\n";
   template_extract_block($template_gallery_admin_menu,'documentation',"<!-- BEGIN documentation -->" . $button . "<!-- END documentation -->\n" . $new_button);
}

function imageflow_page_start()
{ 
  if (GALLERY_ADMIN_MODE) {
    imageflow_add_config_button('index.php?file=imageflow/plugin_config','','','Imageflow');
  } 
}

function imageflow_mainpage($matches)
{ 
        global $CONFIG, $lang_plugin_imageflow, $FORBIDDEN_SET, $IMAGEFLOWSET,$lang_meta_album_names, $META_ALBUM_SET;
        if($matches[1] != 'imageflow') {
          return $matches;
        }
        require ('./plugins/imageflow/include/init.inc.php');
        echo "<!-- Start Imageflow PlugIn ".$lang_plugin_imageflow['version']." -->\n";
        if ($IMAGEFLOWSET['imageflow_standardtable']) {
           starttable("100%", $lang_meta_album_names[$IMAGEFLOWSET['imageflow_album']]);
           echo "<tr><td>";
        }

        if ($IMAGEFLOWSET['imageflow_align'] == "center") echo "<center>
        ";


  if ($IMAGEFLOWSET['imageflow_intable']) echo"<div id=\"imgflowcontainer\" style=\"width:".$IMAGEFLOWSET['imageflow_width'].";\">
  ";
?>
            <div id="imageflow"> 
                <div id="imgflowloading">
                  <b><?php echo $lang_plugin_imageflow['loading'];?></b><br/>
                  <img src="plugins/imageflow/js/loading.gif" width="208" height="13" alt="loading" />
                </div>
                <div id="imgflowimages">
<?php
  // maximum pics to show
  $imageflowlimit=$IMAGEFLOWSET['imageflow_numberofpics'];
  // request of your database
  $imageflow_pics='';
  $imageflow_FORBIDDEN_SET = "";
  if ($FORBIDDEN_SET != "") $imageflow_FORBIDDEN_SET = "AND $FORBIDDEN_SET";
  
  // request string for meta album toprated
  if ($IMAGEFLOWSET['imageflow_album'] == "toprated") {
    $imageflow_query = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p WHERE filename like '%.jpg' AND filename not like 'youtube_%' AND approved = 'YES' $imageflow_FORBIDDEN_SET AND votes >= '{$CONFIG['min_votes_for_rating']}' $META_ALBUM_SET ORDER BY pic_rating DESC, votes DESC, pid DESC LIMIT $imageflowlimit";
  }
  // request string for meta album most viewed
  else if ($IMAGEFLOWSET['imageflow_album'] == "topn") {
    $imageflow_query = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p WHERE filename like '%.jpg' AND filename not like 'youtube_%' AND approved = 'YES' $imageflow_FORBIDDEN_SET AND hits > 0 $META_ALBUM_SET ORDER BY hits DESC, filename LIMIT $imageflowlimit";  
  }
  // request string for meta album last uploads
  else if ($IMAGEFLOWSET['imageflow_album'] == "lastup") {
    $imageflow_query = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p WHERE filename like '%.jpg' AND filename not like 'youtube_%' AND approved = 'YES' $imageflow_FORBIDDEN_SET $META_ALBUM_SET ORDER BY pid DESC LIMIT $imageflowlimit";  
  }
  // request string for meta album random pics
  else
  {
  $imageflow_query = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p WHERE filename like '%.jpg' AND filename not like 'youtube_%' AND approved = 'YES' $imageflow_FORBIDDEN_SET $META_ALBUM_SET ORDER BY RAND() LIMIT $imageflowlimit";
  }
  // result of request
  $imageflow_result = cpg_db_query($imageflow_query);
  // For reading result
  $imageflow_rowset = array();
  // Index of tab
  $i=0;
  // for each pic build HTML code
  $imgflow_fixedsize = 0;
  if (strtolower(substr($IMAGEFLOWSET['imageflow_width'],-2))=="px") {
  	$imgflow_fixedsize = trim(substr($IMAGEFLOWSET['imageflow_width'],0,strlen($IMAGEFLOWSET['imageflow_width'])-2));
  }
  while($imageflow_row = mysql_fetch_array($imageflow_result)){
    if (!$IMAGEFLOWSET['imageflow_skipportrait'] || ($imageflow_row['pwidth']>$imageflow_row['pheight'])) {
      // reading pid of pic
      $imageflow_key=$imageflow_row['pid'];
      // path of pic, depending if intermediate image is there or not
      $imageflow_file=get_pic_url($imageflow_row,$IMAGEFLOWSET['imageflow_pictype']);
      if (!cpgif_my_is_file($imageflow_file)) $imageflow_file=get_pic_url($imageflow_row,'fullsize');
      $imageflow_reflfile=get_pic_url($imageflow_row,'normal');
      if (!cpgif_my_is_file($imageflow_reflfile)) $imageflow_reflfile=get_pic_url($imageflow_row,'fullsize');
      $imageflow_temppercent = $IMAGEFLOWSET['imageflow_procent'];
      if (($imageflow_row['pwidth']<$CONFIG['picture_width']) && ($imageflow_row['pheight']<$CONFIG['picture_width'])) $imageflow_temppercent = 1;
      // link of pic

    if ($IMAGEFLOWSET['imageflow_useenlarge']) {
      if ($imgflow_fixedsize == 0) {
        $imageflow_lien="<img src=\"plugins/imageflow/js/reflect.php?bgc=".$IMAGEFLOWSET['imageflow_bgcolor']."&amp;procent=".$imageflow_temppercent."&amp;cache=".$IMAGEFLOWSET['imageflow_cache']."&amp;img=".$imageflow_reflfile."\" longdesc=\"".$imageflow_file."\"  class=\"imgflowimg\" name=\"".$imageflow_row['pid']."\" alt=\"".$imageflow_row['title']."\" id=\"iflowpic".$i."\" title=\"\" />";
      } else
      {
   	    $imageflow_lien="<img src=\"plugins/imageflow/js/reflect.php?bgc=".$IMAGEFLOWSET['imageflow_bgcolor']."&amp;fixed=".$imgflow_fixedsize."&amp;cache=".$IMAGEFLOWSET['imageflow_cache']."&amp;img=".$imageflow_reflfile."\" longdesc=\"".$imageflow_file."\"   class=\"imgflowimg\" name=\"".$imageflow_row['pid']."\" alt=\"".$imageflow_row['title']."\" id=\"iflowpic".$i."\" title=\"\" />";
   	  }
    }
    else
    {
      if ($imgflow_fixedsize == 0) {
        $imageflow_lien="<img class=\"imgflowimg\" src=\"plugins/imageflow/js/reflect.php?bgc=".$IMAGEFLOWSET['imageflow_bgcolor']."&amp;procent=".$imageflow_temppercent."&amp;cache=".$IMAGEFLOWSET['imageflow_cache']."&amp;img=".$imageflow_reflfile."\" longdesc=\"displayimage.php?pos=-".$imageflow_key."\"  alt=\"".$imageflow_row['title']."\" />";
      } else
      {
   	    $imageflow_lien="<img class=\"imgflowimg\" src=\"plugins/imageflow/js/reflect.php?bgc=".$IMAGEFLOWSET['imageflow_bgcolor']."&amp;fixed=".$imgflow_fixedsize."&amp;cache=".$IMAGEFLOWSET['imageflow_cache']."&amp;img=".$imageflow_reflfile."\" longdesc=\"displayimage.php?pos=-".$imageflow_key."\"  alt=\"".$imageflow_row['title']."\" />";
   	  } 
    }
   	
      // building HTML code
      $imageflow_pics .= $imageflow_lien."\n";
      $i=$i+1;
    }
  }
  // free memory
  mysql_free_result($imageflow_result);
  
  /* fill if not enough pictures in current category
     if 3 or 4, repeat once to get 6 or 8 pics; if 2, repeat four times to get 8 pics; if only 1, repeat 8 times to get 8 pics */
      if ($i<5) $imageflow_pics=$imageflow_pics.str_replace("iflowpic","iflow2pic",$imageflow_pics);
      if ($i<3) $imageflow_pics=$imageflow_pics.str_replace("iflowpic","iflow3pic",str_replace("iflow2pic","iflow4pic",$imageflow_pics));
      if ($i<2) $imageflow_pics=$imageflow_pics.str_replace("iflow4pic","iflow8pic",str_replace("iflow3pic","iflow7pic",str_replace("iflowpic","iflow5pic",str_replace("iflow2pic","iflow6pic",$imageflow_pics))));
  
  // if no pictures found at all in current category, simply take random pictures from whole gallery
  if ($i<1) {
      $imageflow_pics='';
      $imageflow_FORBIDDEN_SET = "";
      if ($FORBIDDEN_SET != "") $imageflow_FORBIDDEN_SET = "AND $FORBIDDEN_SET";
      
      $imageflow_query = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p WHERE filename like '%.jpg' AND filename not like 'youtube_%' AND approved = 'YES' $imageflow_FORBIDDEN_SET ORDER BY RAND() LIMIT $imageflowlimit";
      
      // result of request
      $imageflow_result = cpg_db_query($imageflow_query);
      // For reading result
      $imageflow_rowset = array();
      // Index of tab
      $i=0;
      // For each pic.....building HTML in php
      
      $imgflow_fixedsize = 0;
      if (strtolower(substr($IMAGEFLOWSET['imageflow_width'],-2))=="px") {
      	$imgflow_fixedsize = trim(substr($IMAGEFLOWSET['imageflow_width'],0,strlen($IMAGEFLOWSET['imageflow_width'])-2));
      }      
      
      while($imageflow_row = mysql_fetch_array($imageflow_result)){
        if (!$IMAGEFLOWSET['imageflow_skipportrait'] || ($imageflow_row['pwidth']>$imageflow_row['pheight'])) {
          // reading pid of pic
          $imageflow_key=$imageflow_row['pid'];
          // path of pic, depending if intermediate image is there or not
          $imageflow_file=get_pic_url($imageflow_row,$IMAGEFLOWSET['imageflow_pictype']);
          if (!cpgif_my_is_file($imageflow_file)) $imageflow_file=get_pic_url($imageflow_row,'fullsize');
          $imageflow_reflfile=get_pic_url($imageflow_row,'normal');
          if (!cpgif_my_is_file($imageflow_reflfile)) $imageflow_reflfile=get_pic_url($imageflow_row,'fullsize');
          $imageflow_temppercent = $IMAGEFLOWSET['imageflow_procent'];
          if (($imageflow_row['pwidth']<$CONFIG['picture_width']) && ($imageflow_row['pheight']<$CONFIG['picture_width'])) $imageflow_temppercent = 1;
          // link of pic
          if ($IMAGEFLOWSET['imageflow_useenlarge']) {
            if ($imgflow_fixedsize == 0) {
              $imageflow_lien="<img src=\"plugins/imageflow/js/reflect.php?bgc=".$IMAGEFLOWSET['imageflow_bgcolor']."&amp;procent=".$imageflow_temppercent."&amp;cache=".$IMAGEFLOWSET['imageflow_cache']."&amp;img=".$imageflow_reflfile."\" longdesc=\"".$imageflow_file."\"    class=\"imgflowimg\" name=\"".$imageflow_row['pid']."\" alt=\"".$imageflow_row['title']."\" id=\"iflowpic".$i."\" title=\"\" />";
            } else
            {
   	          $imageflow_lien="<img src=\"plugins/imageflow/js/reflect.php?bgc=".$IMAGEFLOWSET['imageflow_bgcolor']."&amp;fixed=".$imgflow_fixedsize."&amp;cache=".$IMAGEFLOWSET['imageflow_cache']."&amp;img=".$imageflow_reflfile."\" longdesc=\"".$imageflow_file."\"   class=\"imgflowimg\" name=\"".$imageflow_row['pid']."\" alt=\"".$imageflow_row['title']."\" id=\"iflowpic".$i."\" title=\"\" />";
   	        }
         }
         else
         {
         if ($imgflow_fixedsize == 0) {
           $imageflow_lien="<img class=\"imgflowimg\" src=\"plugins/imageflow/js/reflect.php?bgc=".$IMAGEFLOWSET['imageflow_bgcolor']."&amp;procent=".$imageflow_temppercent."&amp;cache=".$IMAGEFLOWSET['imageflow_cache']."&amp;img=".$imageflow_reflfile."\" longdesc=\"displayimage.php?pos=-".$imageflow_key."\"  alt=\"".$imageflow_row['title']."\" />";
           } else
           {
   	         $imageflow_lien="<img class=\"imgflowimg\" src=\"plugins/imageflow/js/reflect.php?bgc=".$IMAGEFLOWSET['imageflow_bgcolor']."&amp;fixed=".$imgflow_fixedsize."&amp;cache=".$IMAGEFLOWSET['imageflow_cache']."&amp;img=".$imageflow_reflfile."\" longdesc=\"displayimage.php?pos=-".$imageflow_key."\"  alt=\"".$imageflow_row['title']."\" />";
   	       } 
         }

          // building HTML code
          $imageflow_pics .= $imageflow_lien."\n";
          $i=$i+1;
        }
      }
      // free memory
      mysql_free_result($imageflow_result);
      // if not a single pic in the whole gallery, use dummy pic from plugin folder
      if ($i<1) $imageflow_pics="<img class=\"imgflowimg\" src=\"plugins/imageflow/js/reflect.php?bgc=".$IMAGEFLOWSET['imageflow_bgcolor']."&amp;procent=".$IMAGEFLOWSET['imageflow_procent']."&amp;cache=0&amp;img=plugins/imageflow/nopicstoshow.jpg\" longdesc=\"\"  alt=\"Add Some Pics!\" />";
      /* fill if not enough random pictures in whole gallery
         if 3 or 4, repeat once to get 6 or 8 pics; if 2, repeat four times to get 8 pics; if only 1, repeat 8 times to get 8 pics */
      if ($i<5) $imageflow_pics=$imageflow_pics.str_replace("iflowpic","iflow2pic",$imageflow_pics);
      if ($i<3) $imageflow_pics=$imageflow_pics.str_replace("iflowpic","iflow3pic",str_replace("iflow2pic","iflow4pic",$imageflow_pics));
      if ($i<2) $imageflow_pics=$imageflow_pics.str_replace("iflow4pic","iflow8pic",str_replace("iflow3pic","iflow7pic",str_replace("iflowpic","iflow5pic",str_replace("iflow2pic","iflow6pic",$imageflow_pics))));
  }
  
  echo $imageflow_pics;
?>                                
                </div>
                <div id="imgflowcaptions"></div>
                <div id="imgflowscrollbar">
                  <div id="imgflowslider"></div>
                </div>
              </div>
<?php
            if ($IMAGEFLOWSET['imageflow_intable']) echo "            </div>
          ";

            if ($IMAGEFLOWSET['imageflow_align'] == "center") { echo "</center>
"; }
            if ($IMAGEFLOWSET['imageflow_standardtable']) {
              echo "</td></tr>";
              endtable();
            }

echo "<!-- End Imageflow PlugIn -->\n";
}

// Install
function imageflow_install()
{
                global $CONFIG, $thisplugin;
                require 'include/sql_parse.php';

                // create table
                $db_schema = $thisplugin->fullpath . '/schema.sql';
                $sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
                $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);
                $sql_query = remove_remarks($sql_query);
                $sql_query = split_sql_file($sql_query, ';');
                echo $sqlquery;
                foreach($sql_query as $q) { 
                  cpg_db_query($q);
                }
                
                // insert default values
                $db_schema = $thisplugin->fullpath . '/basic.sql';
                $sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
                $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);
                $sql_query = remove_remarks($sql_query);
                $sql_query = split_sql_file($sql_query, ';');
              
                foreach($sql_query as $q) { 
                  cpg_db_query($q);
                }
           return true;
}

// Unnstall and drop settings table
function imageflow_uninstall()
{
        global $CONFIG;
        cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}mod_imageflow");
        return true;
}

// checking for file (Intermadiate) availablity
function cpgif_my_is_file($chk_file)
{
    $test_wrong = array ("%28","%29","%C3%BC","%5B","%5D","%25","%23","%7E","%c2%A7","%21","%3D","%C2%B4");
    $test_right = array ('(',')','#','[',']','%','#','~','§','!','=','´');
    $chk_file = str_replace($test_wrong, $test_right, $chk_file);
    if(is_file($chk_file)) return true;
    else return false;
}
?>