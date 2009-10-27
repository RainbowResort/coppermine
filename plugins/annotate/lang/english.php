<?php
/**************************************************
  Picture Annotation (annotate) plugin for cpg1.5.x
  *************************************************
  Copyright (c) 2003-2009 Coppermine Dev Team

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  *************************************************
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**************************************************/

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}

$lang_plugin_annotate['annotate'] = 'Annotate';
$lang_plugin_annotate['plugin_name'] = 'Picture Annotation';
$lang_plugin_annotate['plugin_description'] = 'Add text annotations to your images';
$lang_plugin_annotate['plugin_credit_creator'] = 'Created by %s for cpg1.4.x';
$lang_plugin_annotate['plugin_credit_porter'] = 'Ported to cpg1.5.x by %s';
$lang_plugin_annotate['plugin_credit_js'] = 'JavaScript libraries used by %s and %s';
$lang_plugin_annotate['plugin_credit_i18n'] = 'Internationalization by %s';
$lang_plugin_annotate['submit_to_install'] = 'Submit the form to install the plugin';
$lang_plugin_annotate['configure_plugin'] = 'Configure Picture Annotation plugin';
$lang_plugin_annotate['changes_saved'] = 'Your changes have been saved';
$lang_plugin_annotate['no_changes'] = 'There have been no changes or the values you entered where invalid';
$lang_plugin_annotate['guests_more_permissions_than_registered'] = 'Granting guests more permissions than registered users doesn\'t make sense. Please review your settings!';
$lang_plugin_annotate['prune_database'] = 'Do you want to remove all annotations from the database?';
$lang_plugin_annotate['announcemen_thread'] = 'Announcement thread for %s plugin';
$lang_plugin_annotate['delete_orphaned_entries'] = 'Delete orphaned entries';
$lang_plugin_annotate['x_orphaned_entries_deleted'] = '%s orphaned entries deleted';
$lang_plugin_annotate['1_orphaned_entry_deleted'] = '1 orphaned entry deleted';
$lang_plugin_annotate['save'] = 'Save';
$lang_plugin_annotate['cancel'] = 'Cancel';
$lang_plugin_annotate['error_saving_note'] = 'Error saving note'; // JS-alert
$lang_plugin_annotate['onsave_not_implemented'] = 'onsave must be implemented in order to *actually* save'; // JS-alert
$lang_plugin_annotate['permissions'] = 'Permissions';
$lang_plugin_annotate['group'] = 'Group';
$lang_plugin_annotate['guests'] = 'Guests';
$lang_plugin_annotate['registered_users'] = 'Registered Users';
$lang_plugin_annotate['administrators'] = 'Administrators';
$lang_plugin_annotate['read_annotations'] = 'Read annotations';
$lang_plugin_annotate['read_write_annotations'] = 'Read and create annotations';
$lang_plugin_annotate['read_write_delete_annotations'] = 'Read, create and delete annotations';
$lang_plugin_annotate['no_access'] = 'No access';
$lang_plugin_annotate['lastnotes'] = 'Last annotated pictures';
$lang_plugin_annotate['x_annotations_for_file'] = 'There are %s annotations for this file.';
$lang_plugin_annotate['1_annotation_for_file'] = 'There is one annotation for this file.';
$lang_plugin_annotate['registration_promotion'] = 'You need to be logged in to view annotations. %sLog in%s if you already have an account or %sregister%s for free.'; // Do not translate the %s placeholders
?>