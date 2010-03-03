<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2006 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.4.8
  $Source$
  $Revision: 3116 $
  $Author: abbas-ali $
  $Date: 2006-07-17 00:11:54 +0200 $
**********************************************/

/**
* Coppermine Photo Gallery 1.4.6 index.php
*
* This file is the main display for categories and album it also displays thumbnails,
* also see documentation for this file's {@relativelink ../_index.php.php Free Standing Code}
*
* @copyright  2002-2005 Gregory DEMAR, Coppermine Dev Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License V2
* @package Coppermine
* @version $Id: index.php 3116 2006-06-07 22:11:54Z abbas-ali $
*/

/**
* Unless this is true most things wont work - protection against direct execution of inc files
*/
define('IN_COPPERMINE', true);

define('MOD_LANG_PHP', true);

require('include/init.inc.php');

/**
 * Only admin can access this page
 */
if (!GALLERY_ADMIN_MODE) {
  cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

/**
 * Number of records to be shown per page.
 */
$catPerPage = 15;
$albPerPage = 15;
$picPerPage = 30;

if (isset($_REQUEST['start'])) {
  $start = (int)$_REQUEST['start'];
} else {
  $start = 0;
}

/**
 * Function to get the category data
 */
function get_subcat_data($parent, $ident = '')
{
    global $CONFIG, $CAT_LIST;
    if ($CONFIG['categories_alpha_sort'] == 1) {
    $sort_query = 'name';
    } else {
    $sort_query = 'pos';
    }

    $sql = "SELECT cid, name, description " . "FROM {$CONFIG['TABLE_CATEGORIES']} " . "WHERE parent = '$parent' " . "ORDER BY $sort_query";
    $result = cpg_db_query($sql);

    if (($cat_count = mysql_num_rows($result)) > 0) {
        $rowset = cpg_db_fetch_rowset($result);
        $pos = 0;
        foreach ($rowset as $subcat) {
            if ($pos > 0) {
                $CAT_LIST[] = array('cid' => $subcat['cid'],
                    'parent' => $parent,
                    'pos' => $pos++,
                    'prev' => $prev_cid,
                    'cat_count' => $cat_count,
                    'name' => $ident . $subcat['name']);
                $CAT_LIST[$last_index]['next'] = $subcat['cid'];
            } else {
                $CAT_LIST[] = array('cid' => $subcat['cid'],
                    'parent' => $parent,
                    'pos' => $pos++,
                    'cat_count' => $cat_count,
                    'name' => $ident . $subcat['name']);
            }
            $prev_cid = $subcat['cid'];
            $last_index = count($CAT_LIST) -1;
            get_subcat_data($subcat['cid'], $ident . '&nbsp;&nbsp;&nbsp;');
        }
    }
}

/**
 * Function to build the html for cat list drop down.
 */
function buildCatList() {
  global $CAT_LIST;
  get_subcat_data(0);

  if (isset($_REQUEST['category'])) {
    $selectedCat = $_REQUEST['category'];
  }

  if ($_REQUEST['category'] === "0") {
    $noCat = " selected";
  }

  $return = "<select name=\"category\" class=\"listbox\" onchange=\"this.form.submit();\">\n";
  $return .= "<option value=\"none\">Select Category</option>\n<option value=\"0\"$noCat>No Category</option>\n";

  foreach ($CAT_LIST as $cat) {
    $selected = $selectedCat == $cat['cid'] ? " selected" : "";
    $return .= "<option value=\"{$cat['cid']}\"$selected>{$cat['name']}</option>\n";
  }

  $return .= "</select>";
  return $return;
}

/**
 * Function to create the album drop down.
 */
function albumselect($id = "album") {

    global $CONFIG, $lang_picmgr_php, $lang_errors, $cpg_udb;
    //static $select = "";
    if (isset($_REQUEST['album']) && $id == "album") {
      $aid = $_REQUEST['album'];
    } elseif (isset($_REQUEST['picAlbum']) && $id == "picAlbum") {
      $aid = $_REQUEST['picAlbum'];
    }
    // Reset counter
    $list_count = 0;

    if ($select == "") {
        // albums in root category
        if (GALLERY_ADMIN_MODE) {
            $result = cpg_db_query("SELECT aid, title FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = 0");
            while ($row = mysql_fetch_array($result)) {
                // Add to multi-dim array for later sorting
                $listArray[$list_count]['cat'] = $lang_search_new_php['albums_no_category'];
                $listArray[$list_count]['aid'] = $row['aid'];
                $listArray[$list_count]['title'] = $row['title'];
                $list_count++;
            }
            mysql_free_result($result);
        }

        // albums in public categories
        if (GALLERY_ADMIN_MODE) {
            $result = cpg_db_query("SELECT DISTINCT a.aid AS aid, a.title AS title, c.name AS cname FROM {$CONFIG['TABLE_ALBUMS']} AS a, {$CONFIG['TABLE_CATEGORIES']} AS c WHERE a.category = c.cid AND a.category < '" . FIRST_USER_CAT . "'");
            while ($row = mysql_fetch_array($result)) {
                // Add to multi-dim array for later sorting
                $listArray[$list_count]['cat'] = $row['cname'];
                $listArray[$list_count]['aid'] = $row['aid'];
                $listArray[$list_count]['title'] = $row['title'];
                $list_count++;
            }
            mysql_free_result($result);
        }

        if (GALLERY_ADMIN_MODE) {
            $sql = $cpg_udb->get_admin_album_list();  //it's always bridged so we no longer need to check.
        } else {
            $sql = "SELECT aid, title AS title FROM {$CONFIG['TABLE_ALBUMS']}  WHERE category = " . (FIRST_USER_CAT + USER_ID);
        }

        $result = cpg_db_query($sql);
        while ($row = mysql_fetch_array($result)) {
            // Add to multi-dim array for later sorting
            $listArray[$list_count]['cat'] = $lang_search_new_php['personal_albums'];
            $listArray[$list_count]['aid'] = $row['aid'];
            $listArray[$list_count]['title'] = $row['title'];
            $list_count++;
        }
        mysql_free_result($result);

        $select = "<option value=\"0\">Select album</option>\n";

        // Sort the pulldown options by category and album name
        $listArray = array_csort($listArray,'cat','title');

        // Create the nicely sorted and formatted drop down list
        $alb_cat = '';

        foreach ($listArray as $val) {
            if ($val['cat'] != $alb_cat) {
              if ($alb_cat) $select .= "</optgroup>\n";
                    $select .= '<optgroup label="' . $val['cat'] . '">' . "\n";
                    $alb_cat = $val['cat'];
            }
            $select .= '<option value="' . $val['aid'] . '"' . ($val['aid'] == $aid ? ' selected="selected"' : '') . '>   ' . $val['title'] . "</option>\n";
        }
        if ($alb_cat) $select .= "</optgroup>\n";
    }

    return "\n<select name=\"$id\" class=\"listbox\"  onChange=\"this.form.submit();\" >\n$select</select>\n";
}

function sync_categories() {
  global $CONFIG;

  $langArr = explode(',', $CONFIG['mod_active_lang']);

  $langCatArr = array();

  $query = "SELECT cid, name, description FROM {$CONFIG['TABLE_CATEGORIES']}";
  $result = cpg_db_query($query);
  while ($row = cpg_db_fetch_row($result)) {
    $rowsetOrg[$row['cid']] = $row;
    $orgCatArr[$row['cid']] = $row['cid'];
  }

  $query = "SELECT origId FROM {$CONFIG['TABLE_LANG_STRINGS']} WHERE type='catName' OR type='catDesc'";
  $result = cpg_db_query($query);
  while ($row = cpg_db_fetch_row($result)) {
    $langCatArr[$row['origId']] = $row['origId'];
  }

  $toAdd = array_diff($orgCatArr, $langCatArr);
  $toDel = array_diff($langCatArr, $orgCatArr);
  $toUpdate = array_intersect($orgCatArr, $langCatArr);

  foreach ($toAdd as $id) {
    echo "Adding cid $id to lang table<br />";flush();
    $originalName = $rowsetOrg[$id]['name'];
    $originalDesc = $rowsetOrg[$id]['description'];
    foreach ($langArr as $lang) {
      $query = "INSERT INTO {$CONFIG['TABLE_LANG_STRINGS']} SET original = '$originalName', lang = '$lang', type = 'catName', origId = '$id'";
      cpg_db_query($query);
      //print $query."<br />";
      $query = "INSERT INTO {$CONFIG['TABLE_LANG_STRINGS']} SET original = '$originalDesc', lang = '$lang', type = 'catDesc', origId = '$id'";
      //print $query."<br />";
      cpg_db_query($query);
    }
  }
//print "------------<br>";
  foreach ($toUpdate as $id) {
    echo "Updating cid $id in lang table<br />";flush();
    $originalName = $rowsetOrg[$id]['name'];
    $originalDesc = $rowsetOrg[$id]['description'];

    $query = "UPDATE {$CONFIG['TABLE_LANG_STRINGS']} SET original = '$originalName' WHERE type = 'catName' AND origId = '$id'";
    cpg_db_query($query);
    //print $query."<br />";
    if ($originalDesc) {
      $query = "UPDATE {$CONFIG['TABLE_LANG_STRINGS']} SET original = '$originalDesc' WHERE type = 'catDesc' AND origId = '$id'";
      //print $query."<br />";
      cpg_db_query($query);
    }
  }

  if (is_array($toDel) && count($toDel)) {
    echo "Deleting unused cid from lang table<br />";flush();
    $delStr = implode(',', $toDel);
    $query = "DELETE FROM {$CONFIG['TABLE_LANG_STRINGS']} WHERE origId IN ($delStr) AND (type = 'catName' OR type = 'catDesc')";
    //print $query."<br />";
    cpg_db_query($query);
  }
}

function sync_albums() {
  global $CONFIG;

  $langArr = explode(',', $CONFIG['mod_active_lang']);
  $langAlbArr = array();
  $query = "SELECT aid, title, description FROM {$CONFIG['TABLE_ALBUMS']}";
  $result = cpg_db_query($query);
  while ($row = cpg_db_fetch_row($result)) {
    $rowsetOrg[$row['aid']] = $row;
    $orgAlbArr[$row['aid']] = $row['aid'];
  }

  $query = "SELECT origId FROM {$CONFIG['TABLE_LANG_STRINGS']} WHERE type='albName' OR type='albDesc'";
  $result = cpg_db_query($query);
  while ($row = cpg_db_fetch_row($result)) {
    $langAlbArr[$row['origId']] = $row['origId'];
  }

  $toAdd = array_diff($orgAlbArr, $langAlbArr);
  $toDel = array_diff($langAlbArr, $orgAlbArr);
  $toUpdate = array_intersect($orgAlbArr, $langAlbArr);

  foreach ($toAdd as $id) {
    echo "Adding aid $id to lang table<br />";flush();
    $originalName = $rowsetOrg[$id]['title'];
    $originalDesc = $rowsetOrg[$id]['description'];
    foreach ($langArr as $lang) {
      $query = "INSERT INTO {$CONFIG['TABLE_LANG_STRINGS']} SET original = '$originalName', lang = '$lang', type = 'albName', origId = '$id'";
      cpg_db_query($query);
      //print $query."<br />";
      $query = "INSERT INTO {$CONFIG['TABLE_LANG_STRINGS']} SET original = '$originalDesc', lang = '$lang', type = 'albDesc', origId = '$id'";
      //print $query."<br />";
      cpg_db_query($query);
    }
  }
//print "------------<br>";

  foreach ($toUpdate as $id) {
    echo "Updating aid $id in lang table<br />";flush();
    $originalName = $rowsetOrg[$id]['title'];
    $originalDesc = $rowsetOrg[$id]['description'];

    $query = "UPDATE {$CONFIG['TABLE_LANG_STRINGS']} SET original = '$originalName' WHERE type = 'albName' AND origId = '$id'";
    cpg_db_query($query);
    //print $query."<br />";
    if ($originalDesc) {
      $query = "UPDATE {$CONFIG['TABLE_LANG_STRINGS']} SET original = '$originalDesc' WHERE type = 'albDesc' AND origId = '$id'";
      //print $query."<br />";
      cpg_db_query($query);
    }
  }

  if (is_array($toDel) && count($toDel)) {
    echo "Deleting unused aid from lang table<br />";flush();
    $delStr = implode(',', $toDel);
    $query = "DELETE FROM {$CONFIG['TABLE_LANG_STRINGS']} WHERE origId IN ($delStr) AND (type = 'albName' OR type = 'albDesc')";
    //print $query."<br />";
    cpg_db_query($query);
  }
}

function sync_pictures() {
  global $CONFIG;

  $langArr = explode(',', $CONFIG['mod_active_lang']);

  $query = "SELECT pid, title, caption FROM {$CONFIG['TABLE_PICTURES']}";
  $result = cpg_db_query($query);
  while ($row = cpg_db_fetch_row($result)) {
    $rowsetOrg[$row['pid']] = $row;
    $orgPicArr[$row['pid']] = $row['pid'];
  }

  $langPicArr = array();

  $query = "SELECT origId FROM {$CONFIG['TABLE_LANG_STRINGS']} WHERE type='picTitle' OR type='picDesc'";
  $result = cpg_db_query($query);
  while ($row = cpg_db_fetch_row($result)) {
    $langPicArr[$row['origId']] = $row['origId'];
  }

  $toAdd = array_diff($orgPicArr, $langPicArr);
  $toDel = array_diff($langPicArr, $orgPicArr);
  $toUpdate = array_intersect($orgPicArr, $langPicArr);

  echo "Adding new pictures to lang table<br />";flush();
  foreach ($toAdd as $id) {
    $originalName = $rowsetOrg[$id]['title'];
    $originalDesc = $rowsetOrg[$id]['caption'];
    foreach ($langArr as $lang) {
      $query = "INSERT INTO {$CONFIG['TABLE_LANG_STRINGS']} SET original = '$originalName', lang = '$lang', type = 'picTitle', origId = '$id'";
      cpg_db_query($query);
      //print $query."<br />";
      $query = "INSERT INTO {$CONFIG['TABLE_LANG_STRINGS']} SET original = '$originalDesc', lang = '$lang', type = 'picDesc', origId = '$id'";
      //print $query."<br />";
      cpg_db_query($query);
    }
  }
//print "------------<br>";
  echo "Updating pictures in lang table<br />";flush();
  foreach ($toUpdate as $id) {
    $originalName = $rowsetOrg[$id]['title'];
    $originalDesc = $rowsetOrg[$id]['caption'];

    $query = "UPDATE {$CONFIG['TABLE_LANG_STRINGS']} SET original = '$originalName' WHERE type = 'picTitle' AND origId = '$id'";
    cpg_db_query($query);
    //print $query."<br />";
    if ($originalDesc) {
      $query = "UPDATE {$CONFIG['TABLE_LANG_STRINGS']} SET original = '$originalDesc' WHERE type = 'picDesc' AND origId = '$id'";
      //print $query."<br />";
      cpg_db_query($query);
    }
  }

  if (is_array($toDel) && count($toDel)) {
    echo "Deleting unused pictures from lang table<br />";flush();
    $delStr = implode(',', $toDel);
    $query = "DELETE FROM {$CONFIG['TABLE_LANG_STRINGS']} WHERE origId IN ($delStr) AND (type = 'picTitle' OR type = 'picDesc')";
    //print $query."<br />";
    cpg_db_query($query);
  }
}

pageheader("Manage Multilingual Plugin");

echo <<<EOT
  <br />
  <div align="center">
    <table cellpadding="0" cellspacing="1">
      <tr>
        <td class="admin_menu"><a href="mod_lang.php?sync=categories" title="Synchronize categories lang strings">Synchronize Categories</a></td>
        <td class="admin_menu"><a href="mod_lang.php?sync=albums" title="Synchronize albums lang strings">Synchronize Albums</a></td>
        <td class="admin_menu"><a href="mod_lang.php?sync=pictures" title="Synchronize pictures lang strings">Synchronize Pictures</a></td>
      </tr>
    </table>
  </div>
EOT;

$catList = buildCatList();
//$albList = albumselect();
$picAlbList = albumselect('picAlbum');

if ($_REQUEST['category'] && $_REQUEST['what'] == 'getCat') {
  $selected = " selected";
}

starttable('100%', 'Select the item for which you want to enter language strings', 6);
echo <<<EOT
  <tr>
  <form method="post" action="mod_lang.php" name="catForm">
    <td class="tableh2" width='50'>
      Category
    </td>
    <td class="tableb">
     <select name="category" class="listbox" onchange="this.form.submit();">
       <option value="0">Select Category</option>
       <option value="all"$selected>All Categories</option>
     </select>
     <input type="hidden" name="what" value="getCat">
    </td>
  </form>
  <form action="mod_lang.php" method="post" name="albForm">
    <td class="tableh2" width='50'>
      Albums
    </td>
    <td class="tableb">
     $catList &nbsp;&nbsp;
    </td>
    <input type="hidden" name="what" value="getAlb">
  </form>
  <form method="post" action="mod_lang.php" name="albForm">
    <td class="tableh2" width='100'>
      Pictures of Album
    </td>
    <td class="tableb">
     $picAlbList &nbsp;&nbsp;
    </td>
    <input type="hidden" name="what" value="getPic">
  </form>
  </tr>
EOT;
endtable();

if (isset($_GET['sync'])) {
  $allowedTypes = array('categories', 'albums', 'pictures');
  if (!in_array($_GET['sync'], $allowedTypes)) {
    cpg_die(ERROR, 'Invalid Sync Type', __FILE__, __LINE__);
  }
  $func = "sync_".$_GET['sync'];
  $func();
}

if (isset($_POST['update'])) {
  updateLangData();
}

if (isset($_REQUEST['what'])) {
  switch($_REQUEST['what']) {
    case 'getCat':
        buildForm($_REQUEST['category'], 'getCat');
      break;
    case 'getAlb':
        buildForm($_REQUEST['category'], 'getAlb');
      break;
    case 'getPic':
        buildForm($_REQUEST['picAlbum'], 'getPic');
      break;
    default:
      cpg_die(ERROR, 'Invalid action performed', __FILE__, __LINE__);

  }
}

pagefooter();

function buildForm($val, $what) {
  global $CONFIG, $catPerPage, $picPerPage, $albPerPage, $start;

  $langArr = explode(',', $CONFIG['mod_active_lang']);

  $langCount = count($langArr);

  if ($what == 'getAlb' && $val == 'none') {
    return;
  }

  if ($what == 'getCat' && !$val) {
    return;
  }

  if ($what == 'picAlbum' && !$val) {
    return;
  }

  if ($what == 'getCat') {
    $lowerLimit = $start*$catPerPage*$langCount;
    $higherLimit = $catPerPage*$langCount;

    $hiddenFields = '<input type="hidden" name="category" value="'.$val.'">';
    $queryString = "&category=$val";

    $query = "SELECT * FROM {$CONFIG['TABLE_LANG_STRINGS']} WHERE original != '' AND (type = 'catName' OR type = 'catDesc') ORDER BY origId, type LIMIT $lowerLimit, $higherLimit";
    $countQuery = "SELECT count(id) FROM {$CONFIG['TABLE_LANG_STRINGS']} WHERE original != '' AND (type = 'catName' OR type = 'catDesc')";
  } elseif ($what == 'getAlb') {
    // Get the albums for the selected category..
    if ($val == 1) {
      $whereClause = " WHERE category > '".FIRST_USER_CAT."'";
    } else {
      $whereClause = " WHERE category = '$val'";
    }

    $query = "SELECT aid FROM {$CONFIG['TABLE_ALBUMS']} $whereClause";

    $result = cpg_db_query($query);
    $aidArr = array();
    while ($row = cpg_db_fetch_row($result)) {
      $aidArr[] = $row['aid'];
    }

    if (!count($aidArr)) {
      cpg_die(ERROR, 'No albums in this category', __FILE__, __LINE__);
    }

    $aidStr = implode(',', $aidArr);

    $lowerLimit = $start*$albPerPage*$langCount;
    $higherLimit = $albPerPage*$langCount;

    $hiddenFields = '<input type="hidden" name="category" value="'.$val.'">';
    $queryString = "&category=$val";
    $query = "SELECT * FROM {$CONFIG['TABLE_LANG_STRINGS']} WHERE origId IN ($aidStr) AND original != '' AND (type = 'albName' OR type = 'albDesc') ORDER BY origId, type LIMIT $lowerLimit, $higherLimit";

    $countQuery = "SELECT count(id) FROM {$CONFIG['TABLE_LANG_STRINGS']} WHERE origId IN ($aidStr) AND original != '' AND (type = 'albName' OR type = 'albDesc')";

  } elseif ($what == 'getPic') {

    $query = "SELECT pid FROM {$CONFIG['TABLE_PICTURES']} WHERE aid = '$val'";

    $result = cpg_db_query($query);
    $pidArr = array();
    while ($row = cpg_db_fetch_row($result)) {
      $pidArr[] = $row['pid'];
    }

    if (!count($pidArr)) {
      cpg_die(ERROR, 'No pictures in this album', __FILE__, __LINE__);
    }

    $pidStr = implode(',', $pidArr);

    $lowerLimit = $start*$picPerPage*$langCount;
    $higherLimit = $picPerPage*$langCount;

    $hiddenFields = '<input type="hidden" name="picAlbum" value="'.$val.'">';
    $queryString = "&picAlbum=$val";
    $query = "SELECT * FROM {$CONFIG['TABLE_LANG_STRINGS']} WHERE origId IN ($pidStr) AND original != '' AND (type = 'picTitle' OR type = 'picDesc') ORDER BY origId, type LIMIT $lowerLimit, $higherLimit";
    $countQuery = "SELECT count(id) FROM {$CONFIG['TABLE_LANG_STRINGS']} WHERE origId IN ($pidStr) AND original != '' AND (type = 'picTitle' OR type = 'picDesc')";
  }

  $result = cpg_db_query($query);
  $countResult = cpg_db_query($countQuery);

  while ($row1 = cpg_db_fetch_row($result)) {
    $rowset[$row1['origId']][$row1['type']]['lang'][$row1['lang']] = array($row1['id'], $row1['translated']);
    $rowset[$row1['origId']][$row1['type']]['original'] = $row1['original'];
  }

  $nr = cpg_db_fetch_row($countResult);
  $totalCount = $nr[0];
  $totalPages = ceil($totalCount/$higherLimit);

  echo "<br />
       <form method=\"post\" action=\"mod_lang.php\">\n";
  starttable('100%', 'Manage multiple language strings', 2);
  foreach ($rowset as $origId => $typeArr) {
    foreach ($typeArr as $typeKey => $type){
      switch ($typeKey) {
        case 'catName':
          $elementName = 'category name';
          $elementType = 'text';
          break;
        case 'catDesc':
          $elementName = 'category description';
          $elementType = 'textarea';
          break;
        case 'albName':
          $elementName = 'album name';
          $elementType = 'text';
          break;
        case 'albDesc':
          $elementName = 'album description';
          $elementType = 'textarea';
          break;
        case 'picTitle':
          $elementName = 'picture title';
          $elementType = 'text';
          break;
        case 'picDesc':
          $elementName = 'picture description';
          $elementType = 'textarea';
          break;
      }

      echo "<tr>
                  <td class=\"tableh2\">
                    Original $elementName
                  </td>
                  <td class=\"tableh2\">
                    ".nl2br($type['original'])."
                  </td>
                </tr>";

      foreach ($type['lang'] as $lang => $val) {
        echo "<tr>
                <td class=\"tableb\" valign=\"top\">
                  Translation In $lang
                </td>
                <td class=\"tableb\">
                ";

                if ($elementType == 'textarea') {
                  echo "<textarea name=\"{$val[0]}\" rows=\"2\" cols=\"40\">{$val[1]}</textarea>";
                } else {
                  echo "<input type=\"$elementType\" name=\"{$val[0]}\" value=\"{$val[1]}\" size=\"50\">";
                }

                echo "</td>
                    </tr>";
      }
        echo "<tr>
                <td class=\"tableh1\" colspan=\"2\" align=\"right\">
                  &nbsp;
                </td>
              </tr>";
    }
  }

    echo "<tr>
          <td class=\"tablehb_compact\" colspan=\"2\" align=\"right\">
            Page ";
            for ($i = 1;$i <= $totalPages;$i++) {
            //print "I:$i|";
              if (($i-1) == $start) {
                echo " $i";
              } else {
                echo " <a href=\"mod_lang.php?what=$what&start=".($i-1)."$queryString\">$i</a>";
              }
            }
          echo "</td>
        </tr>";
  echo "<tr>
          <td align=\"center\" colspan=\"2\">
            <input type=\"submit\" value=\"Submit\">
          </td>
        </tr>";
  endtable();

  echo <<<EOT
    <input type="hidden" name="what" value="$what">
    <input type="hidden" name="update" value="update">
    <input type="hidden" name="start" value="$start">
    $hiddenFields
    </form>
EOT;
}

function updateLangData() {
  global $CONFIG;

  foreach ($_POST as $key => $val) {
    if (is_numeric($key)) {
      $query = "UPDATE {$CONFIG['TABLE_LANG_STRINGS']} SET translated = '$val' WHERE id = '$key'";
      cpg_db_query($query);
    }
  }
}
?>