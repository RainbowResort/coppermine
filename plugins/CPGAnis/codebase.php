<?php
/**************************************************
  Coppermine 1.5.x Plugin - CPGAnis
  *************************************************
  Copyright (c) 2011 eenemeenemuu
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

$thisplugin->add_action('page_start','anis');

function anis() {
    global $ALBUM_SET,$cat,$CONFIG;
    $superCage = Inspekt::makeSuperCage();

    if ($superCage->get->keyExists('fullsize') && defined('DISPLAYIMAGE_PHP')) {
        if (!USER_ID && $CONFIG['allow_unlogged_access'] == 0) {
            $redirect = $redirect . "login.php";
            header("Location: $redirect");
            exit();
        }
        $cat = $superCage->get->keyExists('cat') ? $superCage->get->getInt('cat') : 0;        
        get_meta_album_set($cat,$ALBUM_SET);
        anis_display_fullsize_pic();
        ob_end_flush();
        exit();
    }
}

// Display the full size image
function anis_display_fullsize_pic() {
    global $CONFIG, $THEME_DIR, $ALBUM_SET;
    global $lang_errors, $lang_fullsize_popup, $lang_charset;
    $superCage = Inspekt::makeSuperCage();

    if ($superCage->get->keyExists('picfile')) {
        if (!GALLERY_ADMIN_MODE) {
            cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
        }

        $picfile = $superCage->get->getRaw('picfile');
        $picname = $CONFIG['fullpath'] . $picfile;
        $imagesize = @getimagesize($picname);
        $imagedata = array('name' => $picfile, 'path' => path2url($picname), 'geometry' => $imagesize[3]);
    } elseif ($superCage->get->keyExists('pid')) {
        $pid = $superCage->get->getInt('pid');
        $sql = "SELECT * " . "FROM {$CONFIG['TABLE_PICTURES']} " . "WHERE pid='$pid' $ALBUM_SET";
        $result = cpg_db_query($sql);

        if (!mysql_num_rows($result)) {
            cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
        }

        $row = mysql_fetch_array($result);
        $pic_url = get_pic_url($row, 'fullsize');
        $geom = 'width="' . $row['pwidth'] . '" height="' . $row['pheight'] . '"';
        $imagedata = array('name' => $row['filename'], 'path' => $pic_url, 'geometry' => $geom);
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
  <title><?php echo $CONFIG['gallery_name'] ?>: <?php echo $lang_fullsize_popup['click_to_close'];
      ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $CONFIG['charset'] == 'language file' ? $lang_charset : $CONFIG['charset'] ?>" />
  <script type="text/javascript">
  function adjust_popup()
{
        var w, h, fixedW, fixedH, diffW, diffH;
        if (document.documentElement && document.body.clientHeight==0) {     // Catches IE6 and FF in DOCMODE
                fixedW = document.documentElement.clientWidth;
                fixedH = document.documentElement.clientHeight;
                window.resizeTo(fixedW, fixedH);
                diffW = fixedW - document.documentElement.clientWidth;
                diffH = fixedH - document.documentElement.clientHeight;
                w = fixedW + diffW + 16; // Vert Scrollbar Always On in DOCMODE.
                h = fixedH + diffH;
                if (w >= screen.availWidth) h += 16;
        } else if (document.all) {
                fixedW = document.body.clientWidth;
                fixedH = document.body.clientHeight;
                window.resizeTo(fixedW, fixedH);
                diffW = fixedW - document.body.clientWidth;
                diffH = fixedH - document.body.clientHeight;
                w = fixedW + diffW;
                h = fixedH + diffH;
                if (h >= screen.availHeight) w += 16;
                if (w >= screen.availWidth)  h += 16;
        } else {
                fixedW = window.innerWidth;
                fixedH = window.innerHeight;
                window.resizeTo(fixedW, fixedH);
                diffW = fixedW - window.innerWidth;
                diffH = fixedH - window.innerHeight;
                w = fixedW + diffW;
                h = fixedH + diffH;
                if (w >= screen.availWidth)  h += 16;
                if (h >= screen.availHeight) w += 16;
        }
        w = Math.min(w,screen.availWidth);
        h = Math.min(h,screen.availHeight);
        paspect = <?php echo $row['pwidth']/$row['pheight']; ?>; // Picture aspect ratio
        caspect = w/h; // Current aspect ratio
        if (paspect > caspect) {
            h = Math.round(h / paspect * caspect); // Adjust height
        }
        if (paspect < caspect) {
            w = Math.round(w / caspect * paspect); // Adjust width
        }
        window.resizeTo(w,h);
        window.moveTo((screen.availWidth-w)/2, (screen.availHeight-h)/2);
       // alert('<!-- width: ' + w + ' height: ' + h + ' --> ');
       //applet_tag='<APPLET codebase=\"plugins/CPGAnis/anis\" code=\"AniS.class\" width=\"' + w + '\" height=\"' + h + '\">';
       applet_tag1='<PARAM name=\"image_window_size\" value=\"'+(w-diffW)+','+(h-diffH)+'\">\n';
       applet_tag2='<APPLET codebase=\"plugins/CPGAnis/anis\" code=\"AniS.class\" width=\"'+ (w-diffW-5) +'\" height=\"' + (h-diffH-7) + '\">\n';
       applet_tag=applet_tag2+applet_tag1;
}
  </script>
  <style type="text/css">
  body { margin: 0; padding: 0; background-color: gray; }
  img { margin:0; padding:0; border:0; }
  #content { margin:0 auto; padding:0; border:0; }
  table { border:0; height:100%; width:100%; border-collapse:collapse}
  td {         vertical-align: middle; text-align:center; }
  applet {border:0, margin:0; padding:0;}
  </style>
  </head>
  <body>
   <script language="JavaScript" type="text/JavaScript">
      adjust_popup();
   </script>
    <table>
      <tr>
            <td>
          <div id="content">
                <script language="JavaScript" type="text/JavaScript">
                 document.write(applet_tag);
                </script>
               <PARAM name="active_zoom" value="x">

              <?php
              
           echo ' <PARAM name="filenames" value="'
                . htmlspecialchars($imagedata['path']) . '"> '

               ?>
                 </APPLET>
          </div>
        </td>
      </tr>
    </table>
  </body>
</html>
<?php
}

?>