<?php
  /**
 *
 * BrainFeeder for CPG
 * Version 1.0
 * written  by Hallvard Natvik <hallvard@natvik.com>
 * Send me a mail if you use it
 * 
 * This is free software made available to you without any guarantees or obligations
 * You can use this sofware anyway you like.
 *------------------------------------------------------------
 * BrainFeeder for Coppermine is a Coppermine Plugin that helps you set up
 * RSS feeds using the BrainFeeder RSS generator.
 */

$name='BrainFeeder for Coppermine 1.4x';
$description='RSS publishing';
$author='Hallvard Natvik';
$version='1.0 RC';

/*
 * $extra_info is displayed with the title of a plugin that is NOT installed and
 * can be used to present extra information.  
 */
$extra_info = <<<EOT
     <table border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="tableb">BrainFeeder lets you: <br />
    <ul>
        <li>Setup multiple feeds with their own unique URL
        <li>Make feeds based on several criteria, like keyword, category, album or rating
        <li>Pick random pictures or the most recent pictures
        <li>Use MiniCMS to author texts for the feeds
        <li>Caching of feeds to reduce server load
        <li>Build picture caption in the feeds from coppermine and exif data
    </ul>
    </td></tr></table>
EOT;

/**
* $install_info is displayed AFTER the plugin is installed
*/
$install_info = $extra_info;
?>