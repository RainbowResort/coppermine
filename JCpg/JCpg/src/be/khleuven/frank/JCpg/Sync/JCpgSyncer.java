/*
 Copyright (C) 2007  Frank Cleynen
 This program is free software; you can redistribute it and/or
 modify it under the terms of the GNU General Public License
 as published by the Free Software Foundation; either version 2
 of the License, or (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

package be.khleuven.frank.JCpg.Sync;

import java.io.File;
import java.io.FileInputStream;
import java.util.List;
import java.util.ListIterator;

import javax.swing.SwingUtilities;
import javax.swing.tree.DefaultMutableTreeNode;

import org.jdom.DataConversionException;
import org.jdom.Document;
import org.jdom.Element;
import org.jdom.JDOMException;
import org.jdom.input.SAXBuilder;

import be.khleuven.frank.JCpg.Communicator.JCpgPhpCommunicator;
import be.khleuven.frank.JCpg.Components.JCpgAlbum;
import be.khleuven.frank.JCpg.Components.JCpgCategory;
import be.khleuven.frank.JCpg.Components.JCpgGallery;
import be.khleuven.frank.JCpg.Components.JCpgPicture;
import be.khleuven.frank.JCpg.Manager.JCpgProgressManager;
import be.khleuven.frank.JCpg.Save.JCpgGallerySaver;
import be.khleuven.frank.JCpg.UI.JCpgUI;

/**
 * Used for syncing the whole gallery.
 * First we check what's on the server and download all the information not yet saved offline on our disk
 * Then we upload all the information that was made locally to the server. If the component's id is -1, it means it has not yet been uploaded.
 * 
 * @author Frank Cleynen
 */
public class JCpgSyncer {
	
	
	
	

													// *************************************
													// 				VARIABLES 			   *
													// *************************************
	private JCpgUI ui;

	
	
	
	

	
	
	
													// *************************************
													// 				CONSTRUCTOR 		   *
													// *************************************
	/**
	 * 
	 * Makes a new JCpgSyncer object
	 * 
	 * @param ui
	 *            reference to the ui
	 * @param sqlManager
	 *            reference to a sql manager
	 */
	public JCpgSyncer(JCpgUI ui) {

		setUi(ui);

	}
	
	
	
	
	
	
	
	

													// *************************************
													// 				SETTERS 			   *
													// *************************************
	/**
	 * 
	 * Set the syncer ui
	 * 
	 * @param ui
	 *            the syncer ui reference
	 */
	private void setUi(JCpgUI ui) {

		this.ui = ui;

	}

	
	
	
	
	
	
	
	
												
													// *************************************
													// 				GETTERS				   *
													// *************************************
	/**
	 * 
	 * Get the syncer Ui reference
	 * 
	 * @return the Ui reference
	 */
	public JCpgUI getUi() {

		return this.ui;

	}


	
	
	
	
	
	
	

													// *************************************
													// 				MUTATORS & OTHERS 	   *
													// *************************************
	/**
	 * 
	 * Perform all the right sync operations
	 * 
	 */
	public void sync() {
		
		JCpgPhpCommunicator phpCommunicator = new JCpgPhpCommunicator(getUi().getCpgConfig().getSiteConfig().getBaseUrl()); // make a phpCommunicator object to talk with the API
		JCpgProgressManager progressManager = new JCpgProgressManager(getUi(), 100, "data/syncing.jpg", true, false);
		progressManager.changeProgressbarValue(10);
		
		// DELETE
		for(int i=0; i<getUi().getDeleteParameters().size(); i++){
			
			if(phpCommunicator.performPhpRequest(getUi().getDeleteParameters().get(i)) == 0){ // result ok
				
				System.out.println("JCpgSyncer: delete parameter " + i + " succesfully executed");
				
			}else{
				
				System.out.println("JCpgSyncer: delete parameter " + i + " failed to execute");
				
			}
			
		}
		
		getUi().getDeleteParameters().clear(); // clear delete parameters
		
		File delete = new File("config/delete.dat"); // clear saved delete parameters
		if(delete.exists()) delete.delete();
		
		
		
		
		// SERVER -> CLIENT
		// Categories
		
		//String parameters = "showmycategories&username=" + getUi().getCpgConfig().getUserConfig().getUsername() + "&sessionkey=" + getUi().getCpgConfig().getUserConfig().getSessionkey(); isn't showing anything at the moment
		String parameters = "showcategories&setoutputtype=attr&sessionkey=" + getUi().getCpgConfig().getUserConfig().getSessionkey(); // get components in "user galleries" category
		
		if(phpCommunicator.performPhpRequest(parameters) == 0){ // result ok
			
			SAXBuilder builder = new SAXBuilder(false); // no validation for illegal xml format
			
			File file = new File("svr.xml");
			
			if(file.exists()){
			
				try {
					
					Document doc = builder.build("svr.xml");
					
					Element root = doc.getRootElement();
					
					List content = root.getChildren();
					ListIterator it = content.listIterator();
					
					while(it.hasNext()){
						
						Element element = (Element)it.next();
						
						if(element.getName().equals("categorydata")){
							
							if(element.getAttributeValue("name").equals("User galleries")){ // search for the "User Galleries" node and use this object as the parent to add all fetched components
								
								downloadComponents(element, getUi().getGallery().getCategory("User Galleries", 1), phpCommunicator);
								
							}else{ // process root components
								
								downloadComponents(root, ((JCpgGallery)((DefaultMutableTreeNode)getUi().getTree().getModel().getRoot()).getUserObject()), phpCommunicator);
								
							}
							
						}
						
					}
					
				} catch (JDOMException e) {
					
					System.out.println("JCpgSyncer: Couldn't extract categories from xml root tag");
					
				}
				
			}	
				
		}
		
		
		
		
		
		// CLIENT -> SERVER
		uploadComponents(getUi().getGallery(), phpCommunicator);
		
		progressManager.changeProgressbarValue(100);
		
		
		// save new information
		new JCpgGallerySaver(ui.getGallery()).saveGallery(); // save gallery
		
		// refresh JTree
		SwingUtilities.updateComponentTreeUI(getUi().getTree()); // workaround for Java bug 4173369
		

	}
	/**
	 * 
	 * Recursively go through all the category tags and extract all their albums and pictures
	 * 
	 * First we ask for an xml file with all the current categories. We then check if a category is already in on the harddisk by comparing the id's. We do not compare the names because
	 * the name could be changed on the server while this component still has the old name offline. If a component with this id is not found, make one. Otherwhise, use the already present
	 * component and immediatelly change it name and other attributes to the ones found in the xml file so these attributes are also updated.
	 * 
	 * @param xmlelement
	 * 		parent xml tag
	 * @param parent
	 * 		parent object
	 */
	private void downloadComponents(Element xmlelement, JCpgGallery parent, JCpgPhpCommunicator phpCommunicator){
		
		List content = xmlelement.getChildren();
		ListIterator it = content.listIterator();
		
		while(it.hasNext()){
			
			Element element = (Element)it.next();
			
			// albums in parent object
			if(element.getName().equals("albumdata")){
				
				try {
					
					JCpgAlbum album = null;
					DefaultMutableTreeNode treealbum = null;
					
					String parenttype = "";
					if(parent.getClass().equals(JCpgGallery.class)){
						
						parenttype = "gallery";
						
					}else if(parent.getClass().equals(JCpgCategory.class)){
						
						parenttype = "category";
						
					}
					
					DefaultMutableTreeNode parentnode = getUi().visitAllNodes((DefaultMutableTreeNode)getUi().getTree().getModel().getRoot(), parenttype, parent.getName());
					
					if(parent.getAlbum(element.getAttribute("title").getValue(), element.getAttribute("aid").getIntValue()) == null){
					
						album = new JCpgAlbum(element.getAttribute("aid").getIntValue(), element.getAttribute("title").getValue(), element.getAttribute("description").getValue(), element.getAttribute("visibility").getIntValue(), element.getAttribute("uploads").getBooleanValue(), element.getAttribute("comments").getBooleanValue(), element.getAttribute("votes").getBooleanValue(), element.getAttribute("position").getIntValue(), parent.getId(), element.getAttribute("thumb").getIntValue(), element.getAttribute("keyword").getValue(), element.getAttribute("alb_password").getValue(), element.getAttribute("alb_password_hint").getValue());
						album.addUi(getUi());
						parent.addAlbum(album);
						
						treealbum = new DefaultMutableTreeNode(album);
						
						parentnode.add(treealbum);
						
					}else{
						
						album = parent.getAlbum(element.getAttribute("title").getValue(), element.getAttribute("aid").getIntValue());
						
						album.changeName(element.getAttribute("title").getValue());
						album.changeDescription(element.getAttribute("description").getValue());
						
						treealbum = getUi().visitAllNodes(parentnode, "album", element.getAttribute("title").getValue());
						
					}
					
					// extract pictures
					List pictures = element.getChildren();
					ListIterator picturesit = pictures.listIterator();
					
					while(picturesit.hasNext()){
						
						Element pictureelement = (Element)picturesit.next();
						
						if(pictureelement.getName().equals("picturedata")){
							
							try {
								
								if(album.getPicture(pictureelement.getAttribute("title").getValue(), pictureelement.getAttribute("pid").getIntValue()) == null){ // only create picture if not already on local machine
								
									JCpgPicture picture = new JCpgPicture(pictureelement.getAttribute("pid").getIntValue(), album.getId(), pictureelement.getAttribute("filepath").getValue(), pictureelement.getAttribute("filename").getValue(), pictureelement.getAttribute("filesize").getLongValue(), pictureelement.getAttribute("totalfilesize").getLongValue(), pictureelement.getAttribute("pwidth").getIntValue(), pictureelement.getAttribute("pheight").getIntValue(), pictureelement.getAttribute("hits").getIntValue(),
																				pictureelement.getAttribute("ctime").getIntValue(), pictureelement.getAttribute("ownerid").getIntValue(), pictureelement.getAttribute("ownername").getValue(), pictureelement.getAttribute("picrating").getIntValue(), pictureelement.getAttribute("votes").getIntValue(), pictureelement.getAttribute("title").getValue(), pictureelement.getAttribute("caption").getValue(), pictureelement.getAttribute("keywords").getValue(), pictureelement.getAttribute("approved").getBooleanValue(), pictureelement.getAttribute("galleryicon").getIntValue(),
																				pictureelement.getAttribute("urlprefix").getIntValue(), pictureelement.getAttribute("position").getIntValue());
									picture.addUi(getUi());
									album.addPicture(picture);
									
									DefaultMutableTreeNode treepicture = new DefaultMutableTreeNode(picture);
									treealbum.add(treepicture);
									
									// get picture data
									String parameters = "getpicturedata&username=" + getUi().getCpgConfig().getUserConfig().getUsername() + "&pictureid=" + picture.getId() + "&sessionkey=" + getUi().getCpgConfig().getUserConfig().getSessionkey();
									
									int result = phpCommunicator.performPhpRequest(parameters);
									
									if(result == 0)
										System.out.println("JCpgSyncer: " + picture.getName() + " data was succesfully downloaded");
									else if(result == 1)
										System.out.println("JCpgSyncer: " + picture.getName() + " failed to download data: INVALID SESSION");
									else
										System.out.println("JCpgSyncer: " + picture.getName() + " failed to download data");
								
								}
								
							} catch (DataConversionException e) {
								
								System.out.println("JCpgSyncer: couldn't convert xml attributes - picture");
								
							}
							
						}
						
					}
					
				} catch (DataConversionException e) {
					
					System.out.println("JCpgSyncer: couldn't convert xml attributes - album");
					
				}
				
			}
			
			
			// categories in parent object
			if(element.getName().equals("categorydata")){
				
				try {
					
					if(parent.getCategory(element.getAttribute("name").getValue(), element.getAttribute("cid").getIntValue()) == null){ // category not found in current tree so it's not saved offline -> load it in
						
						JCpgCategory category = new JCpgCategory(element.getAttribute("cid").getIntValue(), element.getAttribute("ownerid").getIntValue(), element.getAttribute("name").getValue(), element.getAttribute("description").getValue(), element.getAttribute("parent").getIntValue(), element.getAttribute("pos").getIntValue(), element.getAttribute("thumb").getIntValue());
						category.addUi(getUi());
						parent.addCategory(category);
						
						String parenttype = "";
						if(parent.getClass().equals(JCpgGallery.class)){
							
							parenttype = "gallery";
							
						}else if(parent.getClass().equals(JCpgCategory.class)){
							
							parenttype = "category";
							
						}
						
						DefaultMutableTreeNode parentnode = getUi().visitAllNodes((DefaultMutableTreeNode)getUi().getTree().getModel().getRoot(), parenttype, parent.getName());
						DefaultMutableTreeNode treecategory = new DefaultMutableTreeNode(category);
						parentnode.add(treecategory);
						
						// extract albums
						List albums = element.getChildren();
						ListIterator albumsit = albums.listIterator();
						
						while(albumsit.hasNext()){
							
							Element albumelement = (Element)albumsit.next();
							
							if(albumelement.getName().equals("albumdata")){
								
								try {
									
									JCpgAlbum album = null;
									DefaultMutableTreeNode treealbum = null;
									if(category.getAlbum(albumelement.getAttribute("title").getValue()) == null){
									
										album = new JCpgAlbum(albumelement.getAttribute("aid").getIntValue(), albumelement.getAttribute("title").getValue(), albumelement.getAttribute("description").getValue(), albumelement.getAttribute("visibility").getIntValue(), albumelement.getAttribute("uploads").getBooleanValue(), albumelement.getAttribute("comments").getBooleanValue(), albumelement.getAttribute("votes").getBooleanValue(), albumelement.getAttribute("position").getIntValue(), category.getId(), albumelement.getAttribute("thumb").getIntValue(), albumelement.getAttribute("keyword").getValue(), albumelement.getAttribute("alb_password").getValue(), albumelement.getAttribute("alb_password_hint").getValue());
										album.addUi(getUi());
										category.addAlbum(album);
										
										treealbum = new DefaultMutableTreeNode(album);
										treecategory.add(treealbum);
										
									}else{
										
										album = category.getAlbum(albumelement.getAttribute("title").getValue());
										
										album.changeName(albumelement.getAttribute("title").getValue());
										album.changeDescription(albumelement.getAttribute("description").getValue());
										
										treealbum = getUi().visitAllNodes(treecategory, "album", albumelement.getAttribute("title").getValue());
										
									}
									
									// extract pictures
									List pictures = albumelement.getChildren();
									ListIterator picturesit = pictures.listIterator();
									
									while(picturesit.hasNext()){
										
										Element pictureelement = (Element)picturesit.next();
										
										if(pictureelement.getName().equals("picturedata")){
											
											try {
												
												if(album.getPicture(pictureelement.getAttribute("title").getValue(), pictureelement.getAttribute("pid").getIntValue()) == null){ // only create picture if not already on local machine
												
													JCpgPicture picture = new JCpgPicture(pictureelement.getAttribute("pid").getIntValue(), album.getId(), pictureelement.getAttribute("filepath").getValue(), pictureelement.getAttribute("filename").getValue(), pictureelement.getAttribute("filesize").getLongValue(), pictureelement.getAttribute("totalfilesize").getLongValue(), pictureelement.getAttribute("pwidth").getIntValue(), pictureelement.getAttribute("pheight").getIntValue(), pictureelement.getAttribute("hits").getIntValue(),
																								pictureelement.getAttribute("ctime").getIntValue(), pictureelement.getAttribute("ownerid").getIntValue(), pictureelement.getAttribute("ownername").getValue(), pictureelement.getAttribute("picrating").getIntValue(), pictureelement.getAttribute("votes").getIntValue(), pictureelement.getAttribute("title").getValue(), pictureelement.getAttribute("caption").getValue(), pictureelement.getAttribute("keywords").getValue(), pictureelement.getAttribute("approved").getBooleanValue(), pictureelement.getAttribute("galleryicon").getIntValue(),
																								pictureelement.getAttribute("urlprefix").getIntValue(), pictureelement.getAttribute("position").getIntValue());
													picture.addUi(getUi());
													album.addPicture(picture);
													
													DefaultMutableTreeNode treepicture = new DefaultMutableTreeNode(picture);
													treealbum.add(treepicture);
													
													// get picture data
													String parameters = "getpicturedata&username=" + getUi().getCpgConfig().getUserConfig().getUsername() + "&pictureid=" + picture.getId() + "&sessionkey=" + getUi().getCpgConfig().getUserConfig().getSessionkey();
													
													int result = phpCommunicator.performPhpRequest(parameters);
													
													if(result == 0)
														System.out.println("JCpgSyncer: " + picture.getName() + " data was succesfully downloaded");
													else if(result == 1)
														System.out.println("JCpgSyncer: " + picture.getName() + " failed to download data: INVALID SESSION");
													else
														System.out.println("JCpgSyncer: " + picture.getName() + " failed to download data");
												
												}
												
											} catch (DataConversionException e) {
												
												System.out.println("JCpgSyncer: couldn't convert xml attributes - picture");
												
											}
											
										}
										
									}
									
								} catch (DataConversionException e) {
									
									System.out.println("JCpgSyncer: couldn't convert xml attributes - album");
									
								}
								
							}
							
						}
						
						downloadComponents(element, category, phpCommunicator); // go through the tree xml tag structure using recursion
					
					}else{ // category already exists in the tree, take a look in this category to find new, unsaved stuff
						
						JCpgCategory category = parent.getCategory(element.getAttribute("name").getValue(), element.getAttribute("cid").getIntValue());
						category.changeName(element.getAttribute("name").getValue());
						category.changeDescription(element.getAttribute("description").getValue());
						
						downloadComponents(element, category, phpCommunicator);
					
					}	
						
				} catch (DataConversionException e) {
					
					System.out.println("JCpgSyncer: couldn't convert xml attributes - category");
					
				}
				
			}
			
		}
		
	}
	/**
	 * 
	 * Upload all not yet present information on the server to the server. Every component that has a -1 id, isn't yet uploaded
	 * 
	 * @param parent
	 * 		the parent gallery/category to procees the categories from
	 * @param phpCommunicator
	 * 		phpCommunicator to talk with the server
	 */
	private void uploadComponents(JCpgGallery parent, JCpgPhpCommunicator phpCommunicator){
		
		String parameters = "";
		
		// albums in root gallery
		if(parent.getClass().equals(JCpgGallery.class)){
			
			for(int i=0; i<parent.getAlbums().size(); i++){
				
				JCpgAlbum album = parent.getAlbums().get(i);
				
				if(album.getId() == -1){
					
					parameters = "createalbum&username=" + getUi().getCpgConfig().getUserConfig().getUsername() + "&categoryid=" + parent.getId() + "&albumname=" + album.getName() + "&albumdesc=" + album.getDescription() + "&albumkeywords=" + album.getKeyword() + "&sessionkey=" + getUi().getCpgConfig().getUserConfig().getSessionkey();
					
					int result = phpCommunicator.performPhpRequest(parameters);
					
					if(result == 0)
						System.out.println("JCpgSyncer: " + album.getName() + " was succesfully uploaded");
					else if(result == 1)
						System.out.println("JCpgSyncer: " + album.getName() + " failed to upload: INVALID SESSION");
					else
						System.out.println("JCpgSyncer: " + album.getName() + " failed to upload");
					
					// fetch id for this newly uploaded album
					album.changeId(fetchUploadId("albumdata", phpCommunicator));
				
				}else{ // album is already on server, check if it's modified and generate the modify parameters
					
					if(album.isModified()){
						
						parameters = "modifyalbum&username=" + getUi().getCpgConfig().getUserConfig().getUsername() + "&albumid=" + album.getId() + "&albumname=" + album.getName() + "&albumdesc=" + album.getDescription() + "&albumkeywords=" + album.getKeyword() + "&sessionkey=" + getUi().getCpgConfig().getUserConfig().getSessionkey();
						
						int result = phpCommunicator.performPhpRequest(parameters);
						
						if(result == 0)
							System.out.println("JCpgSyncer: " + album.getName() + " was succesfully modified");
						else if(result == 1)
							System.out.println("JCpgSyncer: " + album.getName() + " failed to modify: INVALID SESSION");
						else
							System.out.println("JCpgSyncer: " + album.getName() + " failed to modify");
						
						album.switchIsModified(); // set back to not modified
						
					}
					
				}
				
				for(int j=0; j<album.getPictures().size(); j++){
					
					JCpgPicture picture = album.getPictures().get(j);
					picture.changeAlbumId(album.getId());
					
					if(picture.getId() == -1){
						
						parameters = "addpicture&username=" + getUi().getCpgConfig().getUserConfig().getUsername() + "&albumid=" + album.getId() + "&pictitle=" + picture.getName() + "&piccaption=" + picture.getCaption() + "&pickeywords=" + picture.getKeywords() + "&user1=&user2=&user3=&user4=&filename=" + getUi().getCpgConfig().getSiteConfig().getValueFor("fullpath") + picture.getFilePath() + picture.getFileName() + "&filecontents=" + getBytesFromFile(getUi().getCpgConfig().getSiteConfig().getValueFor("fullpath") + picture.getFilePath() + picture.getFileName()) + "&sessionkey=" + getUi().getCpgConfig().getUserConfig().getSessionkey();
						
						int result = phpCommunicator.performPhpRequest(parameters);
						
						if(result == 0)
							System.out.println("JCpgSyncer: " + picture.getName() + " was succesfully uploaded");
						else if(result == 1)
							System.out.println("JCpgSyncer: " + picture.getName() + " failed to upload: INVALID SESSION");
						else
							System.out.println("JCpgSyncer: " + picture.getName() + " failed to upload");
						
						// fetch id for this newly uploaded picture
						picture.changeId(fetchUploadId("picturedata", phpCommunicator));
					
					}else{ // picture is already on server, check if it's modified and generate the modify parameters
						
						if(picture.isModified()){
							
							parameters = "modifypicture&username=" + getUi().getCpgConfig().getUserConfig().getUsername() + "&pictureid=" + picture.getId() + "&pictitle=" + picture.getName() + "&piccaption=" + picture.getCaption() + "&pickeywords=" + picture.getKeywords() + "&sessionkey=" + getUi().getCpgConfig().getUserConfig().getSessionkey();
							
							int result = phpCommunicator.performPhpRequest(parameters);
							
							if(result == 0)
								System.out.println("JCpgSyncer: " + picture.getName() + " was succesfully modified");
							else if(result == 1)
								System.out.println("JCpgSyncer: " + picture.getName() + " failed to modify: INVALID SESSION");
							else
								System.out.println("JCpgSyncer: " + picture.getName() + " failed to modify");
							
							picture.switchIsModified(); // set back to not modified
							
						}
						
					}
					
				}
				
			}
			
		}
		
		// Categories
		for(int i=0; i<parent.getCategories().size(); i++){ // categories
			
			JCpgCategory category = parent.getCategories().get(i);
				
			if(category.getId() == -1){
				
				parameters = "createcategory&username=" + getUi().getCpgConfig().getUserConfig().getUsername() + "&categoryid=" + parent.getId() + "&categoryname=" + category.getName() + "&categorydesc=" + category.getDescription() + "&sessionkey=" + getUi().getCpgConfig().getUserConfig().getSessionkey();
					
				int result = phpCommunicator.performPhpRequest(parameters);
				
				if(result == 0)
					System.out.println("JCpgSyncer: " + category.getName() + " was succesfully uploaded");
				else if(result == 1)
					System.out.println("JCpgSyncer: " + category.getName() + " failed to upload: INVALID SESSION");
				else
					System.out.println("JCpgSyncer: " + category.getName() + " failed to upload");
					
				// fetch id for this newly uploaded category
				category.changeId(fetchUploadId("categorydata", phpCommunicator));
				
			}else{ // category is already on server, check if it's modified and generate the modify parameters
				
				if(category.isModified()){
					
					parameters = "modifycategory&username=" + getUi().getCpgConfig().getUserConfig().getUsername() + "&categoryid=" + category.getId() + "&categoryname=" + category.getName() + "&categorydesc=" + category.getDescription() + "&sessionkey=" + getUi().getCpgConfig().getUserConfig().getSessionkey();

					int result = phpCommunicator.performPhpRequest(parameters);
					
					if(result == 0)
						System.out.println("JCpgSyncer: " + category.getName() + " was succesfully modified");
					else if(result == 1)
						System.out.println("JCpgSyncer: " + category.getName() + " failed to modify: INVALID SESSION");
					else
						System.out.println("JCpgSyncer: " + category.getName() + " failed to modify");
					
					category.switchIsModified(); // set back to not modified
					
				}
				
			}
				
			for(int j=0; j<category.getAlbums().size(); j++){ // albums
					
				JCpgAlbum album = category.getAlbums().get(j);
				album.changeCategory(category.getId());
				
				if(album.getId() == -1){
					
					parameters = "createalbum&username=" + getUi().getCpgConfig().getUserConfig().getUsername() + "&categoryid=" + category.getId() + "&albumname=" + album.getName() + "&albumdesc=" + album.getDescription() + "&albumkeywords=" + album.getKeyword() + "&sessionkey=" + getUi().getCpgConfig().getUserConfig().getSessionkey();
						
					int result = phpCommunicator.performPhpRequest(parameters);
					
					if(result == 0)
						System.out.println("JCpgSyncer: " + album.getName() + " was succesfully uploaded");
					else if(result == 1)
						System.out.println("JCpgSyncer: " + album.getName() + " failed to upload: INVALID SESSION");
					else
						System.out.println("JCpgSyncer: " + album.getName() + " failed to upload");
						
					// fetch id for this newly uploaded album
					album.changeId(fetchUploadId("albumdata", phpCommunicator));
					
				}else{ // album is already on server, check if it's modified and generate the modify parameters
					
					if(album.isModified()){
						
						parameters = "modifyalbum&username=" + getUi().getCpgConfig().getUserConfig().getUsername() + "&albumid=" + album.getId() + "&albumname=" + album.getName() + "&albumdesc=" + album.getDescription() + "&albumkeywords=" + album.getKeyword() + "&sessionkey=" + getUi().getCpgConfig().getUserConfig().getSessionkey();
						
						int result = phpCommunicator.performPhpRequest(parameters);
						
						if(result == 0)
							System.out.println("JCpgSyncer: " + album.getName() + " was succesfully modified");
						else if(result == 1)
							System.out.println("JCpgSyncer: " + album.getName() + " failed to modify: INVALID SESSION");
						else
							System.out.println("JCpgSyncer: " + album.getName() + " failed to modify");
						
						album.switchIsModified(); // set back to not modified
						
					}
					
				}
					
				for(int k=0; k<album.getPictures().size(); k++){
						
					JCpgPicture picture = album.getPictures().get(k);
					picture.changeAlbumId(album.getId());
					
					if(picture.getId() == -1){
						
						parameters = "addpicture&username=" + getUi().getCpgConfig().getUserConfig().getUsername() + "&albumid=" + album.getId() + "&pictitle=" + picture.getName() + "&piccaption=" + picture.getCaption() + "&pickeywords=" + picture.getKeywords() + "&user1=&user2=&user3=&user4=&filename=" + getUi().getCpgConfig().getSiteConfig().getValueFor("fullpath") + picture.getFilePath() + picture.getFileName() + "&filecontents=" + getBytesFromFile(getUi().getCpgConfig().getSiteConfig().getValueFor("fullpath") + picture.getFilePath() + picture.getFileName()) + "&sessionkey=" + getUi().getCpgConfig().getUserConfig().getSessionkey();
							
						int result = phpCommunicator.performPhpRequest(parameters);
						
						if(result == 0)
							System.out.println("JCpgSyncer: " + picture.getName() + " was succesfully uploaded");
						else if(result == 1)
							System.out.println("JCpgSyncer: " + picture.getName() + " failed to upload: INVALID SESSION");
						else
							System.out.println("JCpgSyncer: " + picture.getName() + " failed to upload");
							
						// fetch id for this newly uploaded picture
						picture.changeId(fetchUploadId("picturedata", phpCommunicator));
					
					}else{ // picture is already on server, check if it's modified and generate the modify parameters
						
						if(picture.isModified()){
							
							parameters = "modifypicture&username=" + getUi().getCpgConfig().getUserConfig().getUsername() + "&pictureid=" + picture.getId() + "&pictitle=" + picture.getName() + "&piccaption=" + picture.getCaption() + "&pickeywords=" + picture.getKeywords() + "&sessionkey=" + getUi().getCpgConfig().getUserConfig().getSessionkey();
							
							int result = phpCommunicator.performPhpRequest(parameters);
							
							if(result == 0)
								System.out.println("JCpgSyncer: " + picture.getName() + " was succesfully modified");
							else if(result == 1)
								System.out.println("JCpgSyncer: " + picture.getName() + " failed to modify: INVALID SESSION");
							else
								System.out.println("JCpgSyncer: " + picture.getName() + " failed to modify");
							
							picture.switchIsModified(); // set back to not modified
							
						}
						
					}
						
				}
					
			}
			
			uploadComponents(category, phpCommunicator); // go through tree structure
			
		}
		
	}
	/**
	 * 
	 * Get the id of the just uploaded component
	 * 
	 * @param type
	 * 		type of the component just uploaded: categorydata, albumdata or picturedata
	 * @param phpCommunicator
	 * 		phpcommunicator to talk with server
	 * @return
	 * 		the id if one is found, else -1
	 */
	private int fetchUploadId(String type, JCpgPhpCommunicator phpCommunicator){
		
		String tag = "";
		
		if(type.equals("categorydata")){
			
			tag = "cid";
			
		}else if(type.equals("albumdata")){
			
			tag = "aid";
			
		}else if(type.equals("picturedata")){
			
			tag = "pid";
			
		}
		
		String result = phpCommunicator.getXmlTagText(type, tag);
		
		System.out.println("Fetched ID: " + result);
		
		if(!result.equals("")){ // id was found, return it
		
			return new Integer(phpCommunicator.getXmlTagText(type, tag));
		
		}else{ // not id found, return -1
			
			return -1;
			
		}
		
	}
	/**
	 * 
	 * Transform a file into bytes so it can be send to the API
	 * 
	 * @param path
	 * 		path of the file
	 * @return
	 * 		row of bytes representing this file
	 */
	private byte getBytesFromFile(String path){
		
		File file = new File(path);

		byte[] b = new byte[(int) file.length()];
		byte result = 0;
		
		try {
			
			FileInputStream fileInputStream = new FileInputStream(file);
			fileInputStream.read(b);
			
		} catch (Exception e) {
			
			System.out.println("JCpgSyncer: couldn't convert " + path + " into array of bytes");
			
		}
		
		for(int i=0; i<b.length; i++){
			
			result = (byte) (result + b[i]);
			System.out.println(result);
			
		}
		
		return result;
		
	}

}
