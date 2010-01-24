<?php
/**************************************************
  Coppermine 1.5.x Plugin - move_to_public
  *************************************************
  Copyright (c) 2010 Borzoo Mossavari (Sami)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/slider/codebase.php $
  $Revision: 6994 $
  $LastChangedBy: timoswelt $
  $Date: 2010-01-04 10:54:19 +0100 (Mo, 04. Jan 2010) $
  **************************************************/

if (!defined('IN_COPPERMINE')) {
	die('Not in Coppermine...');
}

require_once './plugins/move_to_public/init.inc.php';
$move_to_public_init_array = move_to_public_initialize();
$lang_plugin_move_to_public = $move_to_public_init_array['language']; 
$move_to_public_icon_array = $move_to_public_init_array['icon'];

$self = "$CPG_PHP_SELF?file=move_to_public/index";

if (!GALLERY_ADMIN_MODE)
  cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

pageheader($lang_plugin_move_to_public['move_to_public']);
echo <<< EOT
        <form name="mtb" action="$self" method="post">
EOT;

if ($superCage->post->keyExists('submit')) {
  starttable("100%", $lang_plugin_move_to_public['move_to_public'] . ' / ' . $lang_plugin_move_to_public['status'], 3);
  $albums_selected = 0;
    $post_album_array = $superCage->post->getInt('album');

  foreach($post_album_array as $album)
  {
    if ($album['checked'] == "on")
    {
      if ($albums_selected == 0)
      {
        echo <<< EOT
          <tr>
            <td class="tableb"> {$lang_plugin_move_to_public['album']} </td>
            <td class="tableb"> {$lang_plugin_move_to_public['moved_to_category']} </td>
            <td class="tableb"> {$lang_plugin_move_to_public['album_properties']} </td>
          </tr>
EOT;
      }
      $albums_selected++;

      $album_title = mysql_result(cpg_db_query("SELECT title FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid = {$album['aid']}"),0);
      echo "<tr> <td class=\"tableb\"> <a href=\"thumbnails.php?album={$album['aid']}\"> $album_title </a> </td>";

      if ($album['chown'] == "YES")
      {
        $user_id = $album['user'];
        $user_name = mysql_result(cpg_db_query("SELECT user_name FROM {$CONFIG['TABLE_USERS']} WHERE user_id = '$user_id'"),0);
        cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET owner_id = '$user_id', owner_name = '$user_name' WHERE aid = {$album['aid']}");
      }

      $cid = $album['category'];
      cpg_db_query("UPDATE {$CONFIG['TABLE_ALBUMS']} SET category = $cid WHERE aid = {$album['aid']} AND category > 10000");
      if (mysql_affected_rows() == 0)
      {
        echo '<td class="tableb">'.$lang_plugin_move_to_public['failure'].'</td>';
        echo '<td class="tableb"> &nbsp; </a>';
      }
      else
      {
        $cat_name = mysql_result(cpg_db_query("SELECT name FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid = $cid"),0);
        if ($cid == 0)
          $cat_name = "<i>Gallery root</i>";
        echo "<td class=\"tableb\"> <a href=\"index.php?cat=$cid\"> $cat_name </a> </td>";
        echo "<td class=\"tableb\"> <a href=\"modifyalb.php?album={$album['aid']}\"> modify </a>";
      }
    }
  }
  if ($albums_selected == 0)
    echo '<tr><td class="tableb" colspan="3">'.$lang_plugin_move_to_public['no_album_selected'].'</td></tr>';
  endtable();
  echo '<p align="center"> <a href="$self">'.$lang_plugin_move_to_public['move_more_albums_to_public'].'</a>';
}
else
{
  starttable("100%", $lang_plugin_move_to_public['move_to_public'] . ' / ' . $lang_plugin_move_to_public['choose'], 5);
  $albums_available = 0;

  $row = mysql_fetch_array(cpg_db_query("SELECT user_name, user_id FROM {$CONFIG['TABLE_USERS']} ORDER BY user_id ASC LIMIT 1"));
  $select_options_user = "<optgroup label=\"first user\" /><option value=\"{$row['user_id']}\" selected=\"selected\">{$row['user_name']}</option><optgroup label=\"user list\" />";
  $result = cpg_db_query("SELECT user_name, user_id FROM {$CONFIG['TABLE_USERS']} ORDER BY user_name ASC");
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
    $select_options_user .= "<option value=\"{$row['user_id']}\">{$row['user_name']}</option>";

  $row = mysql_fetch_array(cpg_db_query("SELECT cid, name FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid != 1 ORDER BY cid DESC LIMIT 1"));
  $select_options_category = "<optgroup label=\"last category\" /><option value=\"{$row['cid']}\" selected=\"selected\">{$row['name']}</option><optgroup label=\"category list\" /><option value=\"0\">- Gallery root -</option>";
  $result = cpg_db_query("SELECT cid, name, parent FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid != 1 ORDER BY name, cid ASC");
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
  {
    if ($row['parent'] != "0")
      $row['name'] .= " (".mysql_result(cpg_db_query("SELECT name FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid = '{$row['parent']}'"),0).")";
    $select_options_category .= "<option value=\"{$row['cid']}\">{$row['name']}</option>";
  }

  $result = cpg_db_query("
    SELECT a.aid, a.title, u.user_name FROM {$CONFIG['TABLE_ALBUMS']} a
    INNER JOIN {$CONFIG['TABLE_USERS']} u
    ON a.category-10000 = u.user_id
    WHERE category > 10000 ORDER BY u.user_name, a.title ASC
  ");
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
  {
    if ($albums_available == 0)
    {
      echo <<< EOT
        <tr>
          <th class="tableh2"> {$lang_plugin_move_to_public['user']} </th>
          <th class="tableh2"> {$lang_plugin_move_to_public['album']} </th>
          <th class="tableh2"> {$lang_plugin_move_to_public['move_to_category']} </th>
          <th class="tableh2"> {$lang_plugin_move_to_public['take_ownership']} </th>
          <th class="tableh2"> {$lang_plugin_move_to_public['enable']} </th>
        </tr>
EOT;
    }
    $albums_available++;

    echo <<< EOT
      <tr>
        <td class="tableb">
          {$row['user_name']}
        </td>
        <td class="tableb">
          <a href="thumbnails.php?album={$row['aid']}"> {$row['title']}
        </td>
        <td class="tableb">
          <select name="album[{$row['aid']}][category]" class="button">
            {$select_options_category}
          </select>
        </td>
        <td class="tableb">
          <select name="album[{$row['aid']}][chown]" class="button">
            <option onclick="document.getElementById('users{$row['aid']}').style.display = 'none'" selected="selected">{$lang_common['no']}</option>
            <option onclick="document.getElementById('users{$row['aid']}').style.display = 'inline'">{$lang_common['yes']}</option>
          </select>
          <select name="album[{$row['aid']}][user]" id="users{$row['aid']}" style="display:none" class="button">
            {$select_options_user}
          </select>
        </td>
        <td class="tableb">
          <input type="checkbox" name="album[{$row['aid']}][checked]" />
          <input type="hidden" name="album[{$row['aid']}][aid]" value="{$row['aid']}" />
        </td>
      </tr>
EOT;
  }

  if ($albums_available == 0)
  {
    echo '<tr><td class="tableb">'.$lang_plugin_move_to_public['no_user_albums_available'].'</td></tr>';
  }
  else
  {
    echo <<< EOT
      <tr>
        <td class="tableb" colspan="4">
          {$lang_plugin_move_to_public['default_behaviour_explain']}
        </td>
        <td class="tableb" valign=\"top\">
          <button type="submit" class="button" name="submit" value="{$lang_common['go']}">{$move_to_public_icon_array['menu']}{$lang_common['go']}</button>
        </td>
      </tr>
EOT;
  }
  endtable();
  echo <<< EOT
      </form>
EOT;
}

pagefooter();
?>
