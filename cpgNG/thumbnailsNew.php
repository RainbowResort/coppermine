<?php
define('IN_COPPERMINE', true);
define('THUMBNAILS_PHP', true);

/**
 *
 * $Id:
 */
define('INDEX_PHP', true);
require('include/init.inc.php');

require_once('classes/cpgAlbumFactory.class.php');
require_once('classes/cpgTemplate.class.php');

if ($CONFIG['enable_smilies']) include("include/smilies.inc.php");

//$ad = new CPGAlbumData;
if (isset($_GET['sort'])) {
  $USER['sort'] = $_GET['sort'];
}
if (isset($_GET['cat'])) {
  $cat = (int)$_GET['cat'];
} else {
  $cat = 0;
}
if (isset($_GET['uid'])) {
  $USER['uid'] = (int)$_GET['uid'];
}

if (isset($_GET['page'])) {
    $page = max((int)$_GET['page'], 1);
} else {
    $page = 1;
}

$album = $_GET['album'];


$albumData = cpgAlbumFactory::getAlbumObj($album);

$t = new cpgTemplate;

$breadcrumb = $albumData->getBreadcrumbData ($album);

$thumbData = $albumData->getThumbnailData($album, $cat, $page, $CONFIG['thumbcols'], $CONFIG['thumbrows'], true);

$breadcrumbHTML = $t->getBreadcrumbHTML($breadcrumb);

//$CONTENT = $t->getThumbnailHTML($thumbData, $thumb_count, $album_name, $album, $cat, $page, $total_pages, is_numeric($album), $display_tabs);
$CONTENT = $t->getThumbnailHTML($thumbData);


$t->assign("breadcrumbHTML", $breadcrumbHTML);
$t->assign("CONTENT", $CONTENT);
$t->assign("PAGE_TITLE", $CONFIG["gallery_name"] . " - " . $album_name);
$t->assign("GALLERY_DESCRIPTION", $CONFIG["gallery_description"]);

/**
 * Assign lang array's
 */
$t->assign("lang_main_menu", $lang_main_menu);
$t->assign("lang_gallery_admin_menu", $lang_gallery_admin_menu);
$t->assign("lang_user_admin_menu", $lang_user_admin_menu);

/**
 * Assign user related data
 */
if (!USER_ID) {
  $t->assign("loggedin", 0);
} else {
  $t->assign("loggedin", 1);
}

/**
 * Assign user related data
 */
$t->assign("GALLERY_ADMIN_MODE", GALLERY_ADMIN_MODE);
$t->assign("USER_ADMIN_MODE", USER_ADMIN_MODE);
$t->assign("USER_CAN_CREATE_ALBUMS", USER_CAN_CREATE_ALBUMS);
$t->assign("USER_IS_ADMIN", USER_IS_ADMIN);
$t->assign("USER_CAN_UPLOAD_PICTURES", USER_CAN_UPLOAD_PICTURES);
$t->assign("REFERER", $REFERER);
$t->assign("cat", $cat);
$t->assign("USER_NAME", USER_NAME);
$t->assign("my_cat_id", FIRST_USER_CAT + USER_ID);

$t->display ("2bornot2b/main.html");
?>
