<?php
/********************************************************
  Coppermine 1.5.x plugin - FetchContent
  *******************************************************
  Copyright (c) 2010 Coppermine dev team
  *******************************************************
  This program is free software; you can redistribute 
  it and/or modify it under the terms of the GNU General
  Public License as published by the Free Software
  Foundation; either version 3 of the License, or 
  (at your option) any later version.
  *******************************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  *******************************************************/
  
require_once('./plugins/fetchcontent/configuration.php');
  
// create Inspekt supercage
$superCage = Inspekt::makeSuperCage();

if (!GALLERY_ADMIN_MODE) {
    cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

pageheader('Documentation FetchContent-plugin for cpg1.5.x');
echo <<< EOT
<a name="header"></a><h1>Documentation FetchContent-plugin for cpg1.5.x<a href="#header" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h1>

<a name="purpose"></a><h2>What's this?<a href="#purpose" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h2>
<p>Display content taken from coppermine on non-coppermine-driven pages. Might later become the successor of cpmFetch.</p>

<a name="purpose_docs"></a><h2>Documentation<a href="#purpose_docs" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h2>
Unlike other documentation for Coppermine or plugins for coppermine this piece of documentation differs: it is a PHP-file instead of a plain HTML file. The benefit for you as user is that the examples used on this page apply for you exactly: you don't have to mind placeholders and replace them with actual content. Instead, the examples on this page should work out of the box.

<a name="requirements"></a><h2>Minimum requirements<a href="#requirements" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h2>
There are currently no minimum requirements for the usage of this plugin other than having a coppermine gallery up-and-running. This may change later for particular features.

<a name="install"></a><h2>Install and uninstall<a href="#install" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h2>
Install/uninstall this plugin as any other plugin, using the plugin manager. There are no particular install/uninstall steps that differ from "regular" plugins.

<a name="configuration"></a><h2>Configuration<a href="#configuration" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h2>
After installing the plugin you can access the plugin's configuration screen at any time by clicking on the corresponding link on the plugin manager page.<br />
On the plugin configuration screen you can enable or disable how the plugin works.

<div class="indent">
	<a name="configuration_overall"></a><h3>Overall Settings<a href="#configuration_overall" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h3>
	The following options apply for all components of the plugin.
	<div class="indent">
		<a name="configuration_overall_enable_logging"></a><h4>Enable logging<a href="#configuration_overall_enable_logging" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h4>
        Specify if the actions of this plugin should be logged.<br />
        Possible options:
        <ul>
            <li>No, don't log</li>
            <li>Only log errors</li>
            <li>Log everything</li>
        </ul>
		
		<a name="configuration_overall_debug"></a><h4>Fetchcontent debugging<a href="#configuration_overall_debug" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h4>
        Enable this option during debugging (i.e. if you're a coder and you're developing this plugin). When enabled, there will be no header redirection. Instead, there will be output echoed. Only makes sense when going to <tt class="code">{$CONFIG['site_url']}?file=fetchcontent/image&pid={$fetchcontent_random_pid}&amp;size=1</tt> directly in the browser's address bar.<br />
        Regular users (non-developers) should keep this option off you will need coding skills to understand the output.
		
	</div>
	
	<a name="configuration_image"></a><h3>Individual file (image) settings<a href="#configuration_image" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h3>
	The following options apply for individual images / files fetched by the script.
	
	<div class="indent">
    
		<a name="configuration_image_image_denied"></a><h4>Deny access action<a href="#configuration_image_image_denied" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h4>
        Specifiy what should happen if the visitor is denied to see the image.<br />
        Available options:
        <ul>
            <li>Output nothing at all, resulting in a broken image</li>
            <li>Display a blank, 1x1 pixel image (recommended, default)</li>
            <li>Display a placeholder image that tells the visitor about being denied to view the image he requested</li>
            <li>try to display the image no matter what, ignoring permissions (troubleshooting only!)</li>
        </ul>
		
		<a name="configuration_image_check_referer"></a><h4>Check referer<a href="#configuration_image_check_referer" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h4>
        Specify if the referer should be checked (Option has not been implemented yet, that's why it's currently greyed out)<br />
        Possible options:
        <ul>
            <li>No, don't check referer</li>
            <li>Only allow the domain that the gallery resides on</li>
            <li>List of allowed domains, separated with a pipe (|)</li>
        </ul>
		
		<a name="configuration_image_non_image"></a><h4>Allow other files than images<a href="#configuration_image_non_image" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h4>
        Specify if non-images should be allowed to be fetched as well.<br />
        Possible options:
        <ul>
            <li>No, don't allow non-images.</li>
            <li>Allowed, but only if URL parameter "filetype" is explicitely set to 'document', 'audio', 'movie' or 'any'</li>
            <li>Allowed, but only if URL parameter "imageonly" is NOT set</li>
            <li>Allowed without further checking</li>
        </ul>
		
	</div>
	
	<a name="configuration_several"></a><h3>Fetching several files<a href="#configuration_several" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h3>
	The following options apply when fetching several files.
	<div class="indent">
		<p class="cpg_message_success">The fetchcontent script has got the potential to read an infinite number of records from the coppermine database. Allowing a high number of records to be fetched increases the risk that the fetchcontent plugin will be abused to leech the content of your site. That's why you can (and should) limit the number of records that fetchcontent can pull by setting the max. columns and rows to a value that makes sense for your own usage.</p>
		
		<a name="configuration_several_cols"></a><h4>Maximum number of table columns<a href="#configuration_several_cols" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h4>
		The maximum number of columns. Default is the number of columns you have set in coppermine's config.
		
		<a name="configuration_several_rows"></a><h4>Maximum number of table rows<a href="#configuration_several_rows" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h4>
		The maximum number of rows. Default is the number of rows you have set in coppermine's config.
	</div>
</div>

<a name="todo"></a><h2>To-do<a href="#todo" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h2>
<p>This plugin just is at the very start of it's development and doesn't do anything really usefull yet. It is meant to be later a replacement for the popular cpmFetch add-on, using the plugin API of coppermine and thus ending newbie agony. There are a lot of features that come to mind that one could implement:</p>
<ul>
    <li>Option to create redirection images with text on them that contain real error messages, using GD2 and TrueType</li>
    <li>Option to actually hide the location of individual images or even secure the albums folder against web access by fetching the images dynamically (will be an enourmous resource-eater)</li>
    <li>Stats recording: take into account the hits counter from the core</li>
    <li>Code creation page: an interface for newbies that generates code ready to be copied and pasted into the external page with an intuitive interface with checkboxes and radio buttons.</li>
    <li>Generate RSS feeds</li>
    <li>Off-site content syndication: allow gallery owners to hand out keys (similar to the akismet API keys or google maps api keys) that correlate to a specific third-party domain. This should allow the owners of that third-party site to display content taken from the gallery, but should keep unauthorized copycats from lifting the content syndication code to their site.</li>
</ul>

<a name="usage"></a><h2>How to use<a href="#usage" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h2>

<div class="indent">

	<a name="usage_several"></a><h3>Fetching several files<a href="#usage_several" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h3>
	<div class="indent">
    	Create a test file anywhere (inside the coppermine folder or outside of it) and add this content:<br />
    	<textarea class="cpg_code smallcode" rows="9" style="width:80%;">&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;
    &lt;html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr"&gt;
    &lt;head&gt;
    &lt;title&gt;Example&lt;/title&gt;
    &lt;meta http-equiv="Content-Type" content="text/html; charset=utf-8" /&gt;
    &lt;/head&gt;
    &lt;body&gt;
    This line represents the content area where you need to paste the examples below in.
    &lt;/body&gt;
    &lt;/html&gt;</textarea><br />
    
        Replace the content placeholder line (<tt class="code smallcode">This line represents the content area where you need to paste the examples below in.</tt>) with
        <textarea class="cpg_code smallcode" rows="1" style="width:80%;">&lt;script src="{$CONFIG['site_url']}?file=fetchcontent/js&amp;album=random" type="text/javascript"&gt;&lt;/script&gt;</textarea>
        
        <a name="usage_several_params"></a><h4>Parameters<a href="#usage_several_params" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h4>
            <div class="indent">
                You can control the behaviour of the script to a certain extent by adding parameters to the URL. To add more parameters, use the ampersand sign (<tt class="code">&amp;</tt>) to add more parameters to the string:
                <a name="usage_several_params_album"></a><h5>album<a href="#usage_several_params_album" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h5>
				<p>Specify the album that the files should be fetched from. Similarly to the core coppermine files you can specify both the album ID (aid) as well as the name of the meta album.</p>
				Available meta albums:
				<ul>
					<li>random</li>
					<li>lastup</li>
					<li>topn</li>
					<li>toprated</li>
					<li>lastcom</li>
					<li>lasthits</li>
					<li>lastalb</li>
					<li>search</li>
				</ul>
				
				<a name="usage_several_params_cols"></a><h5>cols<a href="#usage_several_params_cols" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h5>
                The number of table columns returned. Default is the number of columns you specified in coppermine's config record &quot;<a href="docs/en/configuration.htm#admin_thumbnail_columns">Number of columns on thumbnail page</a>&quot;. 
                This value can't be higher than what you have specified as &quot;<a href="#configuration_several_cols">Maximum number of table columns</a>". If you (or a malevolent leecher) specifies a larger number, the setting for the maximum number of columns will apply instead.
                
                <a name="usage_several_params_rows"></a><h5>rows<a href="#usage_several_params_cols" title="Link to this section"><img src="docs/en/images/anchor.gif" width="15" height="9" border="0" alt="" /></a></h5>
                The number of table rows returned. Default is the number of rows you specified in coppermine's config record &quot;<a href="docs/en/configuration.htm#admin_thumbnail_rows">Number of rows on thumbnail page</a>&quot;
                This value can't be higher than what you have specified as &quot;<a href="#configuration_several_rows">Maximum number of table rows</a>". If you (or a malevolent leecher) specifies a larger number, the setting for the maximum number of rows will apply instead.
            </div>
    </div>

</div>
EOT;
pagefooter();
?>