<?php
/**************************************************
  Coppermine 1.5.x Plugin - Imageflow
  *************************************************
  Copyright (c) 2010 Timo Schewe (www.timos-welt.de)
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

// Add plugin_install action
$thisplugin->add_action('plugin_install','imageflow_install');

// Add plugin_uninstall action
$thisplugin->add_action('plugin_uninstall','imageflow_uninstall');

// Add search display action
$thisplugin->add_filter('plugin_block','imageflow_mainpage');

// Add filter for page head
$thisplugin->add_filter('page_meta','imageflow_head');

global $IMAGEFLOWSET;



// include some stuff in page header (css things that are needed for Imageflow)
function imageflow_head()
{        
    global $IMAGEFLOWSET,$CONFIG, $CPG_PHP_SELF, $JS,$template_header;
    require('./plugins/imageflow/include/load_imageflowset.php');

    $imageflow_pages_array = array('index.php');
    if (in_array($CPG_PHP_SELF, $imageflow_pages_array) == TRUE)
    {
        if ($IMAGEFLOWSET['imageflow_useenlarge']) {
	        $JS['includes'][] = "plugins/imageflow/js/imageflowenl.js";
        }
        else
        {
	        $JS['includes'][] = "plugins/imageflow/js/imageflow.js";
        }

        set_js_var('cpgif_auto', $IMAGEFLOWSET['imageflow_auto']);
        set_js_var('cpgif_autotime', $IMAGEFLOWSET['imageflow_autotime']);
        set_js_var('cpgif_usewheel', $IMAGEFLOWSET['imageflow_usewheel']);
        set_js_var('cpgif_usekeys', $IMAGEFLOWSET['imageflow_usekeys']);

        $imageflow_headcode = '<link rel="stylesheet" title="Standard" href="plugins/imageflow/js/screen.css" type="text/css" media="screen" />';
        $imageflow_headcode.='<style type="text/css">';
        $imageflow_headcode.='  #imageflow{background-color:#'.$IMAGEFLOWSET['imageflow_bgcolor'].';width:'.$IMAGEFLOWSET['imageflow_width'].';}';
        if ($IMAGEFLOWSET['imageflow_intable']) { $imageflow_headcode.='  #imgflowcontainer{margin-top:'.$IMAGEFLOWSET['imageflow_topcorrect'].'px;width:'.$IMAGEFLOWSET['imageflow_width'].';} '; }
        $imageflow_headcode.='  #imgflowslider{background-image:url(\'plugins/imageflow/js/slider.gif\');}';
        $imageflow_headcode.='</style>';

	    $template_header = str_replace('{META}', '{META}'.$imageflow_headcode, $template_header);
	}
}


function imageflow_mainpage()
{ 
    global $CONFIG, $lang_plugin_imageflow, $matches, $FORBIDDEN_SET, $IMAGEFLOWSET,$lang_meta_album_names, $META_ALBUM_SET;
    require('./plugins/imageflow/include/init.inc.php');
    require('./plugins/imageflow/include/load_imageflowset.php');
    if($matches[1] != 'imageflow') {
        return $matches;
    }
    echo "<!-- Start Imageflow PlugIn ".$lang_plugin_imageflow['version']." -->\n";

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
  if ($FORBIDDEN_SET) $imageflow_FORBIDDEN_SET = "$FORBIDDEN_SET";
  
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
      if (!(strpos($imageflow_file,'thumb_nopic') === FALSE)) $imageflow_file=get_pic_url($imageflow_row,'fullsize');
      $imageflow_reflfile=get_pic_url($imageflow_row,'normal');
      if (!(strpos($imageflow_reflfile,'thumb_nopic') === FALSE)) $imageflow_reflfile=get_pic_url($imageflow_row,'fullsize');
      $imageflow_temppercent = $IMAGEFLOWSET['imageflow_procent'];
      if (($imageflow_row['pwidth']<$CONFIG['picture_width']) && ($imageflow_row['pheight']<$CONFIG['picture_width'])) $imageflow_temppercent = 1;
      // link of pic

    if ($IMAGEFLOWSET['imageflow_useenlarge']) {
      if ($imgflow_fixedsize == 0) {
        $imageflow_lien="<img src=\"plugins/imageflow/js/reflect.php?bgc=".$IMAGEFLOWSET['imageflow_bgcolor']."&amp;procent=".$imageflow_temppercent."&amp;cache=".$IMAGEFLOWSET['imageflow_cache']."&amp;img=".$imageflow_reflfile."\" longdesc=\"".$imageflow_file."\"  class=\"imgflowimg\" name=\"".$imageflow_row['pid']."\" alt=\"".$imageflow_row['title']."\" id=\"iflowpic".$i."\" title=\"\" style=\"-ms-interpolation-mode:bicubic;\" />";
      } else
      {
   	    $imageflow_lien="<img src=\"plugins/imageflow/js/reflect.php?bgc=".$IMAGEFLOWSET['imageflow_bgcolor']."&amp;fixed=".$imgflow_fixedsize."&amp;cache=".$IMAGEFLOWSET['imageflow_cache']."&amp;img=".$imageflow_reflfile."\" longdesc=\"".$imageflow_file."\"   class=\"imgflowimg\" name=\"".$imageflow_row['pid']."\" alt=\"".$imageflow_row['title']."\" id=\"iflowpic".$i."\" title=\"\" style=\"-ms-interpolation-mode:bicubic;\" />";
   	  }
    }
    else
    {
      if ($imgflow_fixedsize == 0) {
        $imageflow_lien="<img class=\"imgflowimg\" src=\"plugins/imageflow/js/reflect.php?bgc=".$IMAGEFLOWSET['imageflow_bgcolor']."&amp;procent=".$imageflow_temppercent."&amp;cache=".$IMAGEFLOWSET['imageflow_cache']."&amp;img=".$imageflow_reflfile."\" longdesc=\"displayimage.php?pid=".$imageflow_key."\"  alt=\"".$imageflow_row['title']."\" style=\"-ms-interpolation-mode:bicubic;\" />";
      } else
      {
   	    $imageflow_lien="<img class=\"imgflowimg\" src=\"plugins/imageflow/js/reflect.php?bgc=".$IMAGEFLOWSET['imageflow_bgcolor']."&amp;fixed=".$imgflow_fixedsize."&amp;cache=".$IMAGEFLOWSET['imageflow_cache']."&amp;img=".$imageflow_reflfile."\" longdesc=\"displayimage.php?pid=".$imageflow_key."\"  alt=\"".$imageflow_row['title']."\" style=\"-ms-interpolation-mode:bicubic;\" />";
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
      if ($FORBIDDEN_SET != "") $imageflow_FORBIDDEN_SET = "$FORBIDDEN_SET";
      
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
          if (!(strpos($imageflow_file,'thumb_nopic') === FALSE)) $imageflow_file=get_pic_url($imageflow_row,'fullsize');
          $imageflow_reflfile=get_pic_url($imageflow_row,'normal');
          if (!(strpos($imageflow_reflfile,'thumb_nopic') === FALSE)) $imageflow_reflfile=get_pic_url($imageflow_row,'fullsize');
          $imageflow_temppercent = $IMAGEFLOWSET['imageflow_procent'];
          if (($imageflow_row['pwidth']<$CONFIG['picture_width']) && ($imageflow_row['pheight']<$CONFIG['picture_width'])) $imageflow_temppercent = 1;
          // link of pic
          if ($IMAGEFLOWSET['imageflow_useenlarge']) {
            if ($imgflow_fixedsize == 0) {
              $imageflow_lien="<img src=\"plugins/imageflow/js/reflect.php?bgc=".$IMAGEFLOWSET['imageflow_bgcolor']."&amp;procent=".$imageflow_temppercent."&amp;cache=".$IMAGEFLOWSET['imageflow_cache']."&amp;img=".$imageflow_reflfile."\" longdesc=\"".$imageflow_file."\"    class=\"imgflowimg\" name=\"".$imageflow_row['pid']."\" alt=\"".$imageflow_row['title']."\" id=\"iflowpic".$i."\" title=\"\" style=\"-ms-interpolation-mode:bicubic;\" />";
            } else
            {
   	          $imageflow_lien="<img src=\"plugins/imageflow/js/reflect.php?bgc=".$IMAGEFLOWSET['imageflow_bgcolor']."&amp;fixed=".$imgflow_fixedsize."&amp;cache=".$IMAGEFLOWSET['imageflow_cache']."&amp;img=".$imageflow_reflfile."\" longdesc=\"".$imageflow_file."\"   class=\"imgflowimg\" name=\"".$imageflow_row['pid']."\" alt=\"".$imageflow_row['title']."\" id=\"iflowpic".$i."\" title=\"\" style=\"-ms-interpolation-mode:bicubic;\" />";
   	        }
         }
         else
         {
         if ($imgflow_fixedsize == 0) {
           $imageflow_lien="<img class=\"imgflowimg\" src=\"plugins/imageflow/js/reflect.php?bgc=".$IMAGEFLOWSET['imageflow_bgcolor']."&amp;procent=".$imageflow_temppercent."&amp;cache=".$IMAGEFLOWSET['imageflow_cache']."&amp;img=".$imageflow_reflfile."\" longdesc=\"displayimage.php?pid=".$imageflow_key."\"  alt=\"".$imageflow_row['title']."\" style=\"-ms-interpolation-mode:bicubic;\" />";
           } else
           {
   	         $imageflow_lien="<img class=\"imgflowimg\" src=\"plugins/imageflow/js/reflect.php?bgc=".$IMAGEFLOWSET['imageflow_bgcolor']."&amp;fixed=".$imgflow_fixedsize."&amp;cache=".$IMAGEFLOWSET['imageflow_cache']."&amp;img=".$imageflow_reflfile."\" longdesc=\"displayimage.php?pid=".$imageflow_key."\"  alt=\"".$imageflow_row['title']."\" style=\"-ms-interpolation-mode:bicubic;\" />";
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

?>