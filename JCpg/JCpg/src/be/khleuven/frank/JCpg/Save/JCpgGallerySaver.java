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

package be.khleuven.frank.JCpg.Save;

import java.io.BufferedInputStream;
import java.io.BufferedWriter;
import java.io.DataInputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.FileWriter;
import java.util.List;
import java.util.ListIterator;

import org.jdom.DataConversionException;
import org.jdom.Document;
import org.jdom.Element;
import org.jdom.JDOMException;
import org.jdom.input.SAXBuilder;
import org.jdom.output.XMLOutputter;

import be.khleuven.frank.JCpg.Components.JCpgAlbum;
import be.khleuven.frank.JCpg.Components.JCpgCategory;
import be.khleuven.frank.JCpg.Components.JCpgGallery;
import be.khleuven.frank.JCpg.Components.JCpgPicture;
import be.khleuven.frank.JCpg.UI.JCpgUI;



/**
 * 
 * Save objects to binary file or delete them from it
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgGallerySaver{
	
	
	
	
	
																					
																					//*************************************
																					//				VARIABLES             *
																					//*************************************
	private JCpgGallery gallery = null;
	
	
	
	
	
	
	
																				
																					//*************************************
																					//				CONSTRUCTOR           *
																					//*************************************
	/**
	 * 
	 * Makes a new JCpgGallerySaver object, no arguments
	 *
	 */
	public JCpgGallerySaver(JCpgGallery gallery){
		
		setGallery(gallery);
		
	}

	
	
	
	
	
																					//*************************************
																					//				SETTERS	              *
																					//*************************************
	/**
	 * 
	 * Set the gallery
	 * 
	 * @param gallery
	 * 		the gallery
	 */
	private void setGallery(JCpgGallery gallery){
		
		this.gallery = gallery;
		
	}
	
	
	
	
	
	
	
	
	
	
																					
																					//*************************************
																					//				GETTERS	              *
																					//*************************************
	/**
	 * 
	 * Get the gallery
	 * 
	 * @return
	 * 		the gallery
	 */
	public JCpgGallery getGallery(){
		
		return this.gallery;
		
	}
	
	
	
	
	
	
	
	
	

	
																					//*************************************
																					//				MUTATORS & OTHERS     *
																					//*************************************
	/**
	 * 
	 * Makes a new JCpgGallerySaver object, no arguments
	 * 
	 * @param gallery
	 * 		reference to the gallery that has to be saved
	 */
	public void saveGallery(){
		
		toXML();
		
	}
	/**
	 * 
	 * Load the last saved gallery
	 * 
	 * @return
	 * 		loaded gallery object
	 */
	public JCpgGallery loadGallery(){
		
		File gallery = new File("config/gallery.xml");
		
		if(gallery.exists()){
		
			SAXBuilder builder = new SAXBuilder(false); // no validation for illegal xml format
			
			try {
				
				Document doc = builder.build("config/gallery.xml");
			
				Element egallery = doc.getRootElement();
				
				List content1 = egallery.getChildren();
				ListIterator it1 = content1.listIterator();
				
				// albums in root
				while(it1.hasNext()){
					
					Element element1 = (Element)it1.next();
					
					if(element1.getName().equals("album")){
						
						JCpgAlbum album = new JCpgAlbum(element1.getAttribute("aid").getIntValue(), element1.getAttribute("title").getValue(), element1.getAttribute("description").getValue(), element1.getAttribute("visibility").getIntValue(), element1.getAttribute("uploads").getBooleanValue(), element1.getAttribute("comments").getBooleanValue(), element1.getAttribute("votes").getBooleanValue(), element1.getAttribute("position").getIntValue(), element1.getAttribute("category").getIntValue(), element1.getAttribute("thumb").getIntValue(), element1.getAttribute("keywords").getValue(), element1.getAttribute("password").getValue(), element1.getAttribute("passwordhint").getValue());
						album.addUi(getGallery().getUi()); // for syncer
						getGallery().addAlbum(album);
						
						List content3 = element1.getChildren();
						ListIterator it3 = content3.listIterator();
						
						while(it3.hasNext()){
							
							Element element3 = (Element)it3.next();
							
							if(element3.getName().equals("picture")){
								
								JCpgPicture picture = new JCpgPicture(element3.getAttribute("pid").getIntValue(), element3.getAttribute("aid").getIntValue(), element3.getAttribute("filepath").getValue(), element3.getAttribute("filename").getValue(), element3.getAttribute("filesize").getLongValue(), element3.getAttribute("totalfilesize").getLongValue(), element3.getAttribute("width").getIntValue(), element3.getAttribute("height").getIntValue(), element3.getAttribute("hits").getIntValue(), element3.getAttribute("ctime").getLongValue(), element3.getAttribute("ownerid").getIntValue(), element3.getAttribute("ownername").getValue(), element3.getAttribute("rating").getIntValue(), element3.getAttribute("votes").getIntValue(), element3.getAttribute("title").getValue(), element3.getAttribute("caption").getValue(), element3.getAttribute("keywords").getValue(), element3.getAttribute("approved").getBooleanValue(), element3.getAttribute("galleryicon").getIntValue(), element3.getAttribute("urlprefix").getIntValue(), element3.getAttribute("position").getIntValue());
								picture.addUi(getGallery().getUi()); // for syncer
								album.addPicture(picture);
								
							}
							
						}
					
					// categories
					}else if(element1.getName().equals("category")){
						
						loadCategories(element1, getGallery());
						
					}
					
				}
				
			} catch (JDOMException e) {
				
				System.out.println("JCpgGallery: couldn't load gallery.xml");
				
			}
			
			return null;
			
		}
		
		return null;
		
	}
	/**
	 * 
	 * Used to recursively load categories and its content
	 * 
	 * @param xmlelement
	 * 		parent xml tag
	 * @param parent
	 * 		parent gallery / category object
	 */
	private void loadCategories(Element xmlelement, JCpgGallery parent){
		
		try {
			
			JCpgCategory category = new JCpgCategory(xmlelement.getAttribute("cid").getIntValue(), xmlelement.getAttribute("ownerid").getIntValue(), xmlelement.getAttribute("name").getValue(), xmlelement.getAttribute("description").getValue(), xmlelement.getAttribute("position").getIntValue(), xmlelement.getAttribute("parent").getIntValue(), xmlelement.getAttribute("thumb").getIntValue());
		
			category.addUi(getGallery().getUi()); // for syncer
			parent.addCategory(category);
		
			List content2 = xmlelement.getChildren();
			ListIterator it2 = content2.listIterator();
			
			while(it2.hasNext()){
				
				Element element2 = (Element)it2.next();
				
				if(element2.getName().equals("album")){
				
					JCpgAlbum album = new JCpgAlbum(element2.getAttribute("aid").getIntValue(), element2.getAttribute("title").getValue(), element2.getAttribute("description").getValue(), element2.getAttribute("visibility").getIntValue(), element2.getAttribute("uploads").getBooleanValue(), element2.getAttribute("comments").getBooleanValue(), element2.getAttribute("votes").getBooleanValue(), element2.getAttribute("position").getIntValue(), element2.getAttribute("category").getIntValue(), element2.getAttribute("thumb").getIntValue(), element2.getAttribute("keywords").getValue(), element2.getAttribute("password").getValue(), element2.getAttribute("passwordhint").getValue());
					album.addUi(getGallery().getUi()); // for syncer
					category.addAlbum(album);
					
					List content3 = element2.getChildren();
					ListIterator it3 = content3.listIterator();
					
					while(it3.hasNext()){
						
						Element element3 = (Element)it3.next();
						
						if(element3.getName().equals("picture")){
							
							JCpgPicture picture = new JCpgPicture(element3.getAttribute("pid").getIntValue(), element3.getAttribute("aid").getIntValue(), element3.getAttribute("filepath").getValue(), element3.getAttribute("filename").getValue(), element3.getAttribute("filesize").getLongValue(), element3.getAttribute("totalfilesize").getLongValue(), element3.getAttribute("width").getIntValue(), element3.getAttribute("height").getIntValue(), element3.getAttribute("hits").getIntValue(), element3.getAttribute("ctime").getLongValue(), element3.getAttribute("ownerid").getIntValue(), element3.getAttribute("ownername").getValue(), element3.getAttribute("rating").getIntValue(), element3.getAttribute("votes").getIntValue(), element3.getAttribute("title").getValue(), element3.getAttribute("caption").getValue(), element3.getAttribute("keywords").getValue(), element3.getAttribute("approved").getBooleanValue(), element3.getAttribute("galleryicon").getIntValue(), element3.getAttribute("urlprefix").getIntValue(), element3.getAttribute("position").getIntValue());
							picture.addUi(getGallery().getUi()); // for syncer
							album.addPicture(picture);
							
						}
						
					}
				
				}else if(element2.getName().equals("category")){
					
					loadCategories(element2, category);
					
				}
				
			}
			
		} catch (DataConversionException e) {
			
			System.out.println("JCpgGallery: couldn't load categories in gallery.xml");
			
		}
		
		
	}
	/**
	 * 
	 * Generate xml file which represents the current state of the local coppermine gallery
	 * We will use the JDOM API to generate the xml file
	 *
	 */
	private void toXML(){
		
		Element egallery = new Element("gallery");
		
		// albums in main gallery
		for(int i=0; i<getGallery().getAlbums().size(); i++){
			
			JCpgAlbum album = getGallery().getAlbums().get(i);
			
			Element eAlbum = new Element("album");
			
			eAlbum.setAttribute("aid", album.getId() + "");
			eAlbum.setAttribute("title", album.getName());
			eAlbum.setAttribute("description", album.getDescription());
			eAlbum.setAttribute("visibility", album.getVisibility() + "");
			eAlbum.setAttribute("uploads", album.getUploads() + "");
			eAlbum.setAttribute("comments", album.getComments() + "");
			eAlbum.setAttribute("votes", album.getVotes() + "");
			eAlbum.setAttribute("position", album.getPosition() + "");
			eAlbum.setAttribute("category", album.getCategory() + "");
			eAlbum.setAttribute("thumb", album.getThumb() + "");
			eAlbum.setAttribute("keywords", album.getKeyword());
			eAlbum.setAttribute("password", album.getAlbPassword());
			eAlbum.setAttribute("passwordhint", album.getAlbPasswordHint());
			
			egallery.addContent(eAlbum);
			
			for(int j=0; j<album.getPictures().size(); j++){
				
				JCpgPicture picture = album.getPictures().get(j);
				
				Element ePicture = new Element("picture");
				
				ePicture.setAttribute("pid", picture.getId() + "");
				ePicture.setAttribute("aid", picture.getAid() + "");
				ePicture.setAttribute("filepath", picture.getFilePath());
				ePicture.setAttribute("filename", picture.getFileName());
				ePicture.setAttribute("filesize", picture.getFilesize() + "");
				ePicture.setAttribute("totalfilesize", picture.getTotalFileSize() + "");
				ePicture.setAttribute("width", picture.getpWidth() + "");
				ePicture.setAttribute("height", picture.getpHeight() + "");
				ePicture.setAttribute("hits", picture.getHits() + "");
				ePicture.setAttribute("mtime", picture.getmTime() + "");
				ePicture.setAttribute("ctime", picture.getcTime() + "");
				ePicture.setAttribute("ownerid", picture.getOwnerId() + "");
				ePicture.setAttribute("ownername", picture.getOwnerName());
				ePicture.setAttribute("rating", picture.getPicRating() + "");
				ePicture.setAttribute("votes", picture.getVotes() + "");
				ePicture.setAttribute("title", picture.getName());
				ePicture.setAttribute("caption", picture.getCaption());
				ePicture.setAttribute("keywords", picture.getKeywords());
				ePicture.setAttribute("approved", picture.getApproved() + "");
				ePicture.setAttribute("galleryicon", picture.getGalleryIcon() + "");
				ePicture.setAttribute("urlprefix", picture.getUrlPrefix() + "");
				ePicture.setAttribute("position", picture.getPosition() + "");
				
				eAlbum.addContent(ePicture);
				
			}
			
		}
		
		// process categories
		processCategories(egallery, getGallery());
		
		
		// write file
		Document doc=new Document(egallery);
		
		XMLOutputter out = new XMLOutputter();
		
		out.setIndent(true);
		out.setNewlines(true);
		
		try{
			
			FileOutputStream file = new FileOutputStream("config/gallery.xml");
			
			out.output(doc , file);	
			
		}catch(Exception e){
			
			System.out.println("JCpgGallerySaver: couldn't save to xml");
			
		}

	}
	/**
	 * 
	 * Go through each category and load its contents
	 * 
	 * @param xmlelement
	 * 		the xml tag to go through
	 * @param parent
	 * 		the parent JCpg component
	 */
	private void processCategories(Element xmlelement, JCpgGallery parent){
		
		// categories in main gallery
		for(int i=0; i<parent.getCategories().size(); i++){
			
			JCpgCategory category = parent.getCategories().get(i);
			
			Element ecategory = new Element("category");
			
			ecategory.setAttribute("cid", category.getId() + "");
			ecategory.setAttribute("ownerid", category.getOwnerId() + "");
			ecategory.setAttribute("name", category.getName());
			ecategory.setAttribute("description", category.getDescription());
			ecategory.setAttribute("position", category.getPosition() + "");
			ecategory.setAttribute("parent", category.getParent() + "");
			ecategory.setAttribute("thumb", category.getThumb() + "");
			
			xmlelement.addContent(ecategory);
			
			for(int j=0; j<category.getAlbums().size(); j++){
				
				JCpgAlbum album = category.getAlbums().get(j);
				
				Element eAlbum = new Element("album");
				
				eAlbum.setAttribute("aid", album.getId() + "");
				eAlbum.setAttribute("title", album.getName());
				eAlbum.setAttribute("description", album.getDescription());
				eAlbum.setAttribute("visibility", album.getVisibility() + "");
				eAlbum.setAttribute("uploads", album.getUploads() + "");
				eAlbum.setAttribute("comments", album.getComments() + "");
				eAlbum.setAttribute("votes", album.getVotes() + "");
				eAlbum.setAttribute("position", album.getPosition() + "");
				eAlbum.setAttribute("category", album.getCategory() + "");
				eAlbum.setAttribute("thumb", album.getThumb() + "");
				eAlbum.setAttribute("keywords", album.getKeyword());
				eAlbum.setAttribute("password", album.getAlbPassword());
				eAlbum.setAttribute("passwordhint", album.getAlbPasswordHint());
				
				ecategory.addContent(eAlbum);
				
				for(int k=0; k<album.getPictures().size(); k++){
					
					JCpgPicture picture = album.getPictures().get(k);
					
					Element ePicture = new Element("picture");
					
					ePicture.setAttribute("pid", picture.getId() + "");
					ePicture.setAttribute("aid", picture.getAid() + "");
					ePicture.setAttribute("filepath", picture.getFilePath());
					ePicture.setAttribute("filename", picture.getFileName());
					ePicture.setAttribute("filesize", picture.getFilesize() + "");
					ePicture.setAttribute("totalfilesize", picture.getTotalFileSize() + "");
					ePicture.setAttribute("width", picture.getpWidth() + "");
					ePicture.setAttribute("height", picture.getpHeight() + "");
					ePicture.setAttribute("hits", picture.getHits() + "");
					ePicture.setAttribute("mtime", picture.getmTime() + "");
					ePicture.setAttribute("ctime", picture.getcTime() + "");
					ePicture.setAttribute("ownerid", picture.getOwnerId() + "");
					ePicture.setAttribute("ownername", picture.getOwnerName());
					ePicture.setAttribute("rating", picture.getPicRating() + "");
					ePicture.setAttribute("votes", picture.getVotes() + "");
					ePicture.setAttribute("title", picture.getName());
					ePicture.setAttribute("caption", picture.getCaption());
					ePicture.setAttribute("keywords", picture.getKeywords());
					ePicture.setAttribute("approved", picture.getApproved() + "");
					ePicture.setAttribute("galleryicon", picture.getGalleryIcon() + "");
					ePicture.setAttribute("urlprefix", picture.getUrlPrefix() + "");
					ePicture.setAttribute("position", picture.getPosition() + "");
					
					eAlbum.addContent(ePicture);
					
				}
				
			}
			
			processCategories(ecategory, category);
			
		}
		
	}
	/**
	 * 
	 * Save all delete parameters to a file so they can be loaded later on
	 *
	 */
	public void saveDeleteParameters(JCpgUI ui){
	
		File delete = new File("config/delete.dat");
		if(delete.exists()) delete.delete();
		
		try{
			
			FileWriter fstream = new FileWriter("config/delete.dat");
			BufferedWriter out = new BufferedWriter(fstream);
			
			// write delete parameters to a file for later loading
			for(int i=0; i<ui.getDeleteParameters().size(); i++){

				out.write(ui.getDeleteParameters().get(i) + "\n");
	
			}
			
			out.close();
		
		}catch (Exception e){
		      
			System.err.println("JCpgGallerySaver: couldn't save delete parameters.");
			    
		}	
			
	}
	/**
	 * 
	 * Load the currently saved delete parameters
	 *
	 */
	public void loadDeleteParameters(JCpgUI ui){
		
		File file = new File("config/delete.dat");
	    FileInputStream fis = null;
	    BufferedInputStream bis = null;
	    DataInputStream dis = null;

	    try {
	    	
	      fis = new FileInputStream(file);
	      bis = new BufferedInputStream(fis);
	      dis = new DataInputStream(bis);

	      while (dis.available() != 0) {
	    	  
	    	ui.addDeleteParameter(dis.readLine());
	        
	      }

	      // dispose all the resources after using them.
	      fis.close();
	      bis.close();
	      dis.close();

	    } catch (Exception e) {
	    	
	      System.out.println("JCpgGallerySaver: couldn't load delete parameters");
	      
	    }
		
	}

}
