<?php
/**************************************************
  Coppermine Plugin - PotD/PotW
  *************************************************
  Copyright (c) 2006 Paul Van Rompay
  Plugin based on Mod by Casper, Copyright 2005
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
***************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// ------------------------------------------------------------------------------------------------
// Add filters - process search album and add to search results page
// ------------------------------------------------------------------------------------------------
$thisplugin->add_filter('page_html','potd_filter_page');
$thisplugin->add_filter('plugin_block','potd_mainpage_block');
$thisplugin->add_filter('meta_album','potd_meta_album');

// ------------------------------------------------------------------------------------------------
// Add actions
// ------------------------------------------------------------------------------------------------
$thisplugin->add_action('plugin_install','potd_install');
$thisplugin->add_action('plugin_configure','potd_configure');
$thisplugin->add_action('plugin_uninstall','potd_uninstall');
$thisplugin->add_action('page_start','potd_pagestart');

// ------------------------------------------------------------------------------------------------
// Install Plugin
// ------------------------------------------------------------------------------------------------
function potd_install() 
{
  global $CONFIG, $thisplugin, $lang_plugin_potd_config;
  require ('plugins/potd/include/init.inc.php');
  
  if ($_POST['submit']==$lang_plugin_potd_config['button_done']) {
    require 'include/sql_parse.php';
    $db_schema = $thisplugin->fullpath . '/schema.sql';
    $sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
    $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);

    $sql_query = remove_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, ';');

    foreach($sql_query as $q) cpg_db_query($q);
    return true;
  } else {
    return 1;
  }
}

// ------------------------------------------------------------------------------------------------
// Configure Plugin
// ------------------------------------------------------------------------------------------------
function potd_configure() 
{
  global $CONFIG, $lang_plugin_potd, $lang_plugin_potd_config;
  require ('plugins/potd/include/init.inc.php');

  // delete previous plugin config options if necessary (just in case)
  // cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name REGEXP '^plugin_potd_'");

  // insert default parameters into configuration table
  /*
  $sql = "INSERT INTO {$CONFIG['TABLE_CONFIG']} (name, value)"
    ." VALUES"
    ." ('plugin_potd_A','1')"
    .",('plugin_potd_B','0')";
  cpg_db_query($sql);
  */

  echo <<< EOT
    <h2>{$lang_plugin_potd['install_done']}</h2>
    {$lang_plugin_potd['install_note']}<br />
    <br />
    <form action="{$_SERVER['REQUEST_URI']}" method="post">
    <input type="submit" value="{$lang_plugin_potd_config['button_done']}" name="submit"/>
    </form>
EOT;
}

// ------------------------------------------------------------------------------------------------
// Uninstall Plugin
// ------------------------------------------------------------------------------------------------
function potd_uninstall() 
{
  global $CONFIG;
  // cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name REGEXP '^plugin_potd_'");
  return true;
}

// ------------------------------------------------------------------------------------------------
// add config button
// ------------------------------------------------------------------------------------------------
function potd_add_config_button($href,$title,$target,$link)
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

// ------------------------------------------------------------------------------------------------
// Plugin code executed at the beginning of the page
// ------------------------------------------------------------------------------------------------
function potd_pagestart()
{
  global $CONFIG, $lang_errors, $lang_plugin_potd;
  require ('plugins/potd/include/init.inc.php');

  if (GALLERY_ADMIN_MODE) {
    // potd_add_config_button('index.php?file=potd/plugin_config',$lang_plugin_potd['config_title'],'',$lang_plugin_potd['config_button']);

    if (defined('EDITPICS_PHP') && count($_POST)) {
      if (!is_array($_POST['pid'])) cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);
      $pid_array = $_POST['pid'];

      foreach ($pid_array as $pid) {
        $timestamp = time();
        $reset_potd  = isset($_POST['reset_potd'.$pid]);
        $reset_potd_date  = isset($_POST['reset_potd_date'.$pid]);
        $reset_potdn  = isset($_POST['reset_potdn'.$pid]);
        $reset_potw  = isset($_POST['reset_potw'.$pid]);
        $reset_potw_date  = isset($_POST['reset_potw_date'.$pid]);
        $reset_potwn  = isset($_POST['reset_potwn'.$pid]);    

        $columns = '';  
        $values = '';
        $update = '';
        if ($reset_potd)  { $columns .= ',`potd`,`potd_date`'; $values .= ",'1','$timestamp'"; }
        if ($reset_potw)  { $columns .= ',`potw`,`potw_date`'; $values .= ",'1','$timestamp'"; }
        if ($reset_potdn) { $update .= ($update ? ', ':'') . "`potd` = '2'"; }
        if ($reset_potwn) { $update .= ($update ? ', ':'') . "`potw` = '2'"; }

        $query = '';
        if ($columns) {
          $query = "REPLACE INTO {$CONFIG['TABLE_PLUGIN_POTD']} (`pid`$columns) VALUES ('$pid'$values)";
        } elseif ($update) {
          $query = "UPDATE {$CONFIG['TABLE_PLUGIN_POTD']} SET $update WHERE pid='$pid' LIMIT 1";
        }
        if ($query) { $result = cpg_db_query($query); }
      }
    }
  }
}

// ------------------------------------------------------------------------------------------------
// Add in plugin buttons & links to appropriate pages
// ------------------------------------------------------------------------------------------------
function potd_filter_page($html)
{
  global $lang_editpics_php;
  require ('plugins/potd/include/init.inc.php');

  if (GALLERY_ADMIN_MODE && defined('EDITPICS_PHP')) {
    $html_add = <<<EOT
        <tr>
          <td class="tableb" colspan="3" align="center">
            <table border="0" cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td width="25%" align="center">
                  <b><input type="checkbox" name="reset_potd$2" value="YES" class="checkbox" />{$lang_editpics_php['potdnew']}</b>
                </td>
                <td width="25%" align="center">
                  <b><input type="checkbox" name="reset_potdn$2" value="NO" class="checkbox" />{$lang_editpics_php['potdold']}</b>
                </td>
                <td width="25%" align="center">
                  <b><input type="checkbox" name="reset_potw$2" value="YES" class="checkbox" />{$lang_editpics_php['potwnew']}</b>
                </td>
                <td width="25%" align="center">
                  <b><input type="checkbox" name="reset_potwn$2" value="NO" class="checkbox" />{$lang_editpics_php['potwold']}</b>
                </td>
              </tr>
            </table>
          </td>
        </tr>

EOT;
    $pattern = '#(<label for="del_comments)(\d+)(" class="clickable_option">'.preg_quote($lang_editpics_php['del_comm'],'#').'</label></td>\s*</tr>\s*</table>\s*</td>\s*</tr>)#sU';
    $html = preg_replace($pattern,'$1$2$3'."\n".$html_add,$html);
  }
  return $html;
}

// ------------------------------------------------------------------------------------------------
// Add in plugin buttons & links to appropriate pages
// ------------------------------------------------------------------------------------------------
function potd_mainpage_block($matches)
{
  if (is_array($matches)) {
    switch ($matches[1]) {
      case 'potd':
        if ($cat == 0) {
          include('potd.php');
        }
        flush();
        $matches = '';
        break;

      case 'potw':
        if ($cat == 0) {
          include('potw.php');
        }
        flush();
        $matches = '';
        break;
    }
  }
  return $matches;
}

// ------------------------------------------------------------------------------------------------
// Add in new meta albums
// ------------------------------------------------------------------------------------------------
function potd_meta_album($meta_album_passto)
{
  global $CONFIG, $ALBUM_SET, $CURRENT_CAT_NAME, $lang_meta_album_names;

  $album = $meta_album_passto['album'];
  $limit = $meta_album_passto['limit'];
  $set_caption = $meta_album_passto['set_caption'];

  $thumb_per_page = $CONFIG['thumbcols'] * $CONFIG['thumbrows'];
  if ($thumb_per_page == 1) {
    $select_columns = '*';
  } else {
    $select_columns = 'p.pid, filepath, filename, url_prefix, filesize, pwidth, pheight, ctime, aid, keywords';
  }

  switch($album) {
    case 'potdarch': // Archive of the picture of the day
                if ($ALBUM_SET && $CURRENT_CAT_NAME) {
                        $album_name = $lang_meta_album_names['potdarch'].' - '. $CURRENT_CAT_NAME;
                } else {
                        $album_name = $lang_meta_album_names['potdarch'];
                }

                $query = <<< EOT
                  SELECT COUNT(*) 
                    FROM {$CONFIG['TABLE_PLUGIN_POTD']} AS pp LEFT JOIN {$CONFIG['TABLE_PICTURES']} AS p 
                    ON p.pid=pp.pid 
                  WHERE (approved = 'YES' && pp.potd = '2') 
                    $ALBUM_SET
EOT;
                $result = cpg_db_query($query);
                $nbEnr = mysql_fetch_array($result);
                $count = $nbEnr[0];
                mysql_free_result($result);

                if($select_columns != '*' ) $select_columns .= ',title, caption, owner_id, owner_name, pp.potd_date';

                $query = <<< EOT
                  SELECT $select_columns 
                    FROM {$CONFIG['TABLE_PLUGIN_POTD']} AS pp LEFT JOIN {$CONFIG['TABLE_PICTURES']} AS p 
                    ON p.pid=pp.pid 
                  WHERE (approved = 'YES' && pp.potd = '2') 
                    $ALBUM_SET 
                    ORDER BY pp.potd_date DESC 
                    $limit
EOT;
                $result = cpg_db_query($query);

                $rowset = cpg_db_fetch_rowset($result);
                mysql_free_result($result);

                if ($set_caption) foreach ($rowset as $key => $row){
                        $user_link = ($CONFIG['display_uploader'] && $row['owner_id'] && $row['owner_name']) ? '<span class="thumb_title"><a href ="profile.php?uid='.$row['owner_id'].'">'.$row['owner_name'].'</a></span>' : '';
                        $caption = $user_link.'<span class="thumb_caption">'.localised_date($row['potd_date'], $lastup_date_fmt).'</span>';
                        $rowset[$key]['caption_text'] = $caption;
                }
                break;
        
    case 'potwarch': // Archive of the picture of the week
                if ($ALBUM_SET && $CURRENT_CAT_NAME) {
                        $album_name = $lang_meta_album_names['potwarch'].' - '. $CURRENT_CAT_NAME;
                } else {
                        $album_name = $lang_meta_album_names['potwarch'];
                }

                $query = <<< EOT
                  SELECT COUNT(*) 
                    FROM {$CONFIG['TABLE_PLUGIN_POTD']} AS pp LEFT JOIN {$CONFIG['TABLE_PICTURES']} AS p 
                    ON p.pid=pp.pid 
                  WHERE (approved = 'YES' && pp.potw = '2') 
                    $ALBUM_SET
EOT;
                $result = cpg_db_query($query);
                $nbEnr = mysql_fetch_array($result);
                $count = $nbEnr[0];
                mysql_free_result($result);

                if($select_columns != '*' ) $select_columns .= ',title, caption, owner_id, owner_name, pp.potw_date';

                $query = <<< EOT
                  SELECT $select_columns 
                    FROM {$CONFIG['TABLE_PLUGIN_POTD']} AS pp LEFT JOIN {$CONFIG['TABLE_PICTURES']} AS p 
                    ON p.pid=pp.pid 
                  WHERE (approved = 'YES' && pp.potw = '2') 
                    $ALBUM_SET 
                    ORDER BY pp.potw_date DESC 
                    $limit
EOT;
                $result = cpg_db_query($query);

                $rowset = cpg_db_fetch_rowset($result);
                mysql_free_result($result);

                if ($set_caption) foreach ($rowset as $key => $row){
                        $user_link = ($CONFIG['display_uploader'] && $row['owner_id'] && $row['owner_name']) ? '<span class="thumb_title"><a href ="profile.php?uid='.$row['owner_id'].'">'.$row['owner_name'].'</a></span>' : '';
                        $caption = $user_link.'<span class="thumb_caption">'.localised_date($row['potw_date'], $lastup_date_fmt).'</span>';
                        $rowset[$key]['caption_text'] = $caption;
                }
                break;

    default: 
                return false;  // no meta-albums were processed here
  }     

  $meta_album_params = array(
    'album_name' => $album_name,
    'count' => $count,
    'rowset' => $rowset,
  );
  return $meta_album_params;
}

// ------------------------------------------------------------------------------------------------
// End of plugin code
// ------------------------------------------------------------------------------------------------

?>
