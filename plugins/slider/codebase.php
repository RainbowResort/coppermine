<?php
/**************************************************
  Coppermine 1.5.x Plugin - Slider $VERSION$=0.3
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ***************************************************/

  
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Add plugin_install action
$thisplugin->add_action('plugin_install','slider_install');

// Add plugin_uninstall action
$thisplugin->add_action('plugin_uninstall','slider_uninstall');

// Add search display action
$thisplugin->add_filter('plugin_block','slider_mainpage');

// Add filter for page head
$thisplugin->add_filter('page_meta','slider_head');

global $SLIDERSET,$lang_plugin_slider;
require ('./plugins/slider/include/init.inc.php');
require ('./plugins/slider/include/load_sliderset.php');



// include some stuff in page header
function slider_head()
{        
global $template_header, $lang_plugin_slider, $CONFIG;
    
    $slider_headcode = "
<!-- Start Slider ".$lang_plugin_slider['version']." Headcode -->";
    
    $slider_headcode .= <<<EOS

<script type="text/javascript" src="plugins/slider/slider.js"></script>
<style type="text/css">
  .sliderimg { cursor: pointer; }
</style>
<!-- End Slider Headcode -->

EOS;

// only insert stuff if we're on album list page
 if (defined('INDEX_PHP') && !defined('DISPLAYIMAGE_PHP') && !defined('THUMBNAILS_PHP')) 
 { 
 	 $template_header = str_replace('{META}','{META}'.$slider_headcode,$template_header);
 }

}


function slider_mainpage($matches)
{
  // only insert stuff if we're on album list page
  if (defined('INDEX_PHP') && !defined('DISPLAYIMAGE_PHP') && !defined('THUMBNAILS_PHP'))
  { 
        global $CONFIG,$lang_plugin_slider,$FORBIDDEN_SET,$SLIDERSET,$lang_meta_album_names,$META_ALBUM_SET;
        if($matches[1] != 'slider') {
          return $matches;
        }
        $cpgslideplug_align=$SLIDERSET['slider_align'];
        if ($SLIDERSET['slider_autowidth']) $cpgslideplug_align="left";
        echo "<!-- Start Slider PlugIn ".$lang_plugin_slider['version']." Table-->\n";
        $slider_icon = array( 'topn' => 'most_viewed', 'lastup' => 'last_uploads', 'toprated' => 'top_rated', 'random' => 'random');
        starttable("100%", cpg_fetch_icon($slider_icon[$SLIDERSET['slider_album']],0,$lang_meta_album_names[$SLIDERSET['slider_album']]).$lang_meta_album_names[$SLIDERSET['slider_album']]);
?>
        <tr>
            <td align="<?php echo $cpgslideplug_align;?>">
                <table border="0" <?php if ($SLIDERSET['slider_autowidth']) echo "width=\"100%\" ";?> id="slidergetwidth" cellspacing="0" cellpadding="0">
                   <tr>
                       <td align="left">
                           <script type="text/javascript">
                                var slideshowgap=2;
                                var copyspeed=<?php echo $SLIDERSET['slider_speed'];?>;
                                var realcopyspeed=<?php echo $SLIDERSET['slider_speed'];?>;
                                var cpgslid_brwsx,cpgslid_brwsy,cpgslid_oldbrwsx,cpgslid_oldbrwsy;
<?php
  // maximum pics to show
  $sliderlimit=$SLIDERSET['slider_numberofpics'];
  // request of your database
  $slider_pics='';
  $slider_pics2='';
  $slider_pics3='';
  $slider_FORBIDDEN_SET = "";
  if ($FORBIDDEN_SET != "") $slider_FORBIDDEN_SET = "AND $FORBIDDEN_SET";

  // request string for meta album toprated
  if ($SLIDERSET['slider_album'] == "toprated") {
    $slider_query = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p WHERE filename like '%.jpg' AND filename not like 'youtube_%' approved = 'YES' $slider_FORBIDDEN_SET AND votes >= '{$CONFIG['min_votes_for_rating']}' $META_ALBUM_SET ORDER BY pic_rating DESC, votes DESC, pid DESC LIMIT $sliderlimit";
  }
  // request string for meta album most viewed
  else if ($SLIDERSET['slider_album'] == "topn") {
    $slider_query = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p WHERE filename like '%.jpg' AND filename not like 'youtube_%' AND approved = 'YES' $slider_FORBIDDEN_SET AND hits > 0 $META_ALBUM_SET ORDER BY hits DESC, filename LIMIT $sliderlimit";  
  }
  // request string for meta album last uploads
  else if ($SLIDERSET['slider_album'] == "lastup") {
    $slider_query = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p WHERE filename like '%.jpg' AND filename not like 'youtube_%' AND approved = 'YES' $slider_FORBIDDEN_SET $META_ALBUM_SET ORDER BY pid DESC LIMIT $sliderlimit";  
  }
  // request string for meta album random pics
  else
  {
  $slider_query = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p WHERE filename like '%.jpg' AND filename not like 'youtube_%' AND approved = 'YES' $slider_FORBIDDEN_SET $META_ALBUM_SET ORDER BY RAND() LIMIT $sliderlimit";
  }
  // For reading result
  $slider_rowset = array();
  // Index of tab
  $i=0;
  // max height : will be 75px or 100px
  $max_height=0;
  // For each pic.....building javascript in php
  if ($SLIDERSET['slider_autowidth']) $slider_minpics = 15;
  else $slider_minpics = 10;
  // result of request
  $slider_result = cpg_db_query($slider_query);
  while($slider_row = mysql_fetch_array($slider_result)){
    if (!$SLIDERSET['slider_skipportrait'] || ($slider_row['pwidth']>$slider_row['pheight'])) {
      // reading pid of pic
      $slider_key=$slider_row['pid'];
      // reading height of pic
      $slider_image_size = compute_img_size($slider_row['pwidth'], $slider_row['pheight'], $CONFIG['thumb_width']);
      // Calcul de la hauteur maxi de la zone déroulante (par défaut = 75px)
      if ($slider_image_size['height'] > $max_height) {
        $max_height = $slider_image_size['height'];
      }
    // path of pic
    $slider_file=get_pic_url($slider_row,'thumb');
    $slider_imgfile=get_pic_url($slider_row,$SLIDERSET['slider_pictype']);
    if ($slider_imgfile == "images/thumbs/thumb_nopic.png") $slider_imgfile=get_pic_url($slider_row,'fullsize');
    $slider_pictitle = $slider_row['title'];
    // link of pic
    
    if ($SLIDERSET['slider_useenlarge'] == 1) {
       $slider_lien="<img src=\"".$slider_file."\" onclick=\"enlarge(this);\" longdesc=\"".$slider_imgfile."\" border=\"0\" name=\"".$slider_row['pid']."\" class=\"sliderimg\" alt=\"".$slider_pictitle."\" />";
       $slider_lien2="<img src=\"".$slider_file."\" onclick=\"enlarge(this);\" longdesc=\"".$slider_imgfile."\" border=\"0\" name=\"".$slider_row['pid']."\" class=\"sliderimg\" alt=\"".$slider_pictitle."\" />";
       $slider_lien3="<img src=\"".$slider_file."\" onclick=\"enlarge(this);\" longdesc=\"".$slider_imgfile."\" border=\"0\" name=\"".$slider_row['pid']."\" class=\"sliderimg\" alt=\"".$slider_pictitle."\" />";
      }
      else
      {
       $slider_lien="<a href=\"displayimage.php?pid=$slider_key\"><img src=\"".$slider_file."\" border=\"0\" alt=\"".$slider_pictitle."\" /></a>";
       $slider_lien2="<a href=\"displayimage.php?pid=$slider_key\"><img src=\"".$slider_file."\" border=\"0\" alt=\"".$slider_pictitle."\" /></a>";
       $slider_lien3="<a href=\"displayimage.php?pid=$slider_key\"><img src=\"".$slider_file."\" border=\"0\" alt=\"".$slider_pictitle."\" /></a>";
      }
    // building javascript code
    $slider_pics .= $slider_lien."&nbsp;";
    $slider_pics2 .= $slider_lien2."&nbsp;";
    $slider_pics3 .= $slider_lien3."&nbsp;";
    $i=$i+1;
   }
  }
  // free memory
  mysql_free_result($slider_result);


  if ($i > 0) 
  {
    while ($i < $slider_minpics)
    {
      $i = $i * 2;
      $slider_pics .= str_replace('id="slider','id="slider1',$slider_pics);
      $slider_pics2 .= str_replace('id="slider','id="slider1',$slider_pics2);
      $slider_pics3 .= str_replace('id="slider','id="slider1',$slider_pics3);
    }
  }
    
    
      
  //Max height of pics fixed
  $cpgslideplug_sliderheight = $max_height."px";

?>                                var actualwidth='';
                                var cross_slide;
                                var cross_slide2;
                                var slider_autowidth;
                                <?php if ($SLIDERSET['slider_autowidth']) echo "var autowidth=1;"; else echo "var autowidth=0;";?>

                                slid_addLoad(cpgslideplug_fillup);
                           </script>
                                <span id="slider_temp" style="visibility:visible;position:absolute;top:-100px;white-space:nowrap;left:-9000px;"><?php echo $slider_pics;?></span>
                                <div id="slider_autow1" style="position:relative<?php if (!$SLIDERSET['slider_autowidth']) { echo ';width:'.$SLIDERSET['slider_width']."px"; } ?>;height:<?php echo $cpgslideplug_sliderheight;?>;overflow:hidden;white-space:nowrap;">
                                      <div id="slider_autow2" style="white-space:nowrap;position:absolute<?php if (!$SLIDERSET['slider_autowidth']) { echo ';width:'.$SLIDERSET['slider_width']."px"; } ?>;height:<?php echo $cpgslideplug_sliderheight;?>;<?php if ($SLIDERSET['slider_bgcolor']) echo "background-color:".$SLIDERSET['slider_bgcolor'].";";?>">
                                          <div id="slider_test2" style="visibility:hidden;position:absolute;left:0px;top:0px;white-space:nowrap;"><?php echo $slider_pics2;?></div>  
                                          <div id="slider_test3" style="visibility:hidden;position:absolute;left:-2000px;top:0px;white-space:nowrap;"><?php echo $slider_pics3;?></div>
                                      </div>
                                </div>
                            </td>
                       </tr>
               </table>                
          </td>
     </tr>
<?php
endtable();
echo "<!-- End Slider PlugIn Table-->\n";
  }
}

// Install
function slider_install()
{
                global $CONFIG, $thisplugin;
                require 'include/sql_parse.php';

                // create table
                $db_schema = $thisplugin->fullpath . '/schema.sql';
                $sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
                $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);
                $sql_query = remove_remarks($sql_query);
                $sql_query = split_sql_file($sql_query, ';');

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
function slider_uninstall()
{
        global $CONFIG;
        cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_slider");
        return true;
}
?>