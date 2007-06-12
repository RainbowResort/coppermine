<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.0  miniCMS                                   //
// ------------------------------------------------------------------------- //
// Copyright (C) 2004 Tarique Sani <tarique@sanisoft.com>,                   //
// Amit Badkas <amit@sanisoft.com>                                           //
// http://www.chezgreg.net/coppermine/                                       //
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify      //
// it under the terms of the GNU General Public License as published by      //
// the Free Software Foundation; either version 2 of the License, or         //
// (at your option) any later version.                                       //
// ------------------------------------------------------------------------- //

// ------------------------------------------------------------------------- //
//   Search modification by Kum Sackey                         //
// ------------------------------------------------------------------------- //



define('IN_COPPERMINE', true);
define('ALBCATSEARCH_PHP', true);
require('include/init.inc.php');

pageheader($lang_search_php[results]);
printf("<center>");
starttable("100%", "$lang_search_php[results]" , 3);

?>



<?php
#class='tableborder'
                          while (list($name, $value) = each($HTTP_GET_VARS)) {
                                #               echo "$name = $value<br>\n";

                                 if ($name == "query" ) $query = $value;

                                 }

                                  while (list($name, $value) = each($HTTP_GET_VARS)) {
                                        echo "$name = $value<br>\n";
                                                         }


?>

<?php

$query = $_GET['search'];

$query_pieces = explode(" ", $query);


$query = "";
    $c = 0;
        $cd = 0;
        while ($c < count($query_pieces) )
        {
                if ($query_pieces[$c] != "")
                {
                        if (strlen($query_pieces[$c]) < 3)
                        {
                                $query_discard[$cd] = $query_pieces[$c];
                                $cd = $cd + 1;
                        }
                        else
                        {
                        $query .= '%'.$query_pieces[$c];
                        }
                }
                $c = $c + 1;

        }
$query .= '%';

if ($query != '%' )
{
        $result = cpg_db_query("SELECT * FROM `{$CONFIG['TABLE_CATEGORIES']}` WHERE `name` LIKE '$query'");
        $result2 = cpg_db_query("SELECT * FROM `{$CONFIG['TABLE_ALBUMS']}` WHERE `title` LIKE '$query'");
}
?>


<tr>
  <td class="tableb" > <div align="center">
      <p>&nbsp;</p>

        <?
        if ($cd > 0)
        {

        echo 'The following search terms were discarded because they were too short: ';
    $c = 0;
        while ($c < ($cd - 1) )
        {
                echo $query_discard[$c].',';
                $c = $c + 1;
        }
                echo $query_discard[$c];
        echo '<br>';
        }
        ?>

          <?php if (mysql_num_rows($result) + mysql_num_rows($result2) == 0)
                                { echo "No results found"; }
                else
                {
        ?>
      <table width="75%" border="1" cellpadding="2" cellspacing="2">
        <tr>
          <td colspan="2" class="tableh1"><?php echo $lang_gallery_admin_menu['categories_lnk']?></td>
        </tr>
        <?php
        // Output Data into Table

        while ($cat_list = mysql_fetch_array($result, MYSQL_ASSOC))
        {
?>
        <tr>
          <td> <a href="<?php printf("index.php?cat=%u", $cat_list['cid']); ?> ">
            <?php echo $cat_list['name']; ?> </a></td>
          <td>
            <?php if ($cat_list['description'] == "") { echo '&nbsp;'; }else { echo $cat_list['description']; } ?>
          </td>
        </tr>
        <?php
        }
?>
        <tr>
          <td colspan="2" class="tableh1"><?php echo $lang_gallery_admin_menu['albums_lnk']?></td>
        </tr>
        <?php
        // Output Data into Table

        while ($alb_list = mysql_fetch_array($result2, MYSQL_ASSOC))
        {
?>
        <tr>
          <td><a href="<?php printf("thumbnails.php?album=%u", $alb_list['aid']); ?> ">
            <?php echo $alb_list['title']; ?> </a></td>
          <td>
            <?php if ($alb_list['description'] == "") { echo '&nbsp;'; }else { echo $alb_list['description']; } ?>
          </td>
        </tr>
        <?php
        }
?>
      </table>
                  <?php
        }
?>
    </div></td>
</tr>
<?php
printf("</center>");
endtable();
?>