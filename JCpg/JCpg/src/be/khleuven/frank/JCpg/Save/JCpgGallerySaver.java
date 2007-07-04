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

import java.io.FileOutputStream;
import java.util.List;
import java.util.ListIterator;

import org.jdom.Document;
import org.jdom.Element;
import org.jdom.JDOMException;
import org.jdom.input.SAXBuilder;
import org.jdom.output.XMLOutputter;

import be.khleuven.frank.JCpg.Components.JCpgAlbum;
import be.khleuven.frank.JCpg.Components.JCpgCategory;
import be.khleuven.frank.JCpg.Components.JCpgGallery;
import be.khleuven.frank.JCpg.Components.JCpgPicture;



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
	
	
	
	
										
																					//*************************************
																					//				MUTATORS & OTHERS     *
																					//*************************************
	/**
	 * 
	 * Load the last saved gallery
	 * 
	 * @return
	 * 		loaded gallery object
	 */
	public JCpgGallery loadGallery(){
		
		SAXBuilder builder = new SAXBuilder(false); // no validation for illegal xml format
		
		try {
			
			Document doc = builder.build("config/gallery.xml");
		
			Element egallery = doc.getRootElement();
			
			List content1 = egallery.getChildren();
			ListIterator it1 = content1.listIterator();
			
			while(it1.hasNext()){
				
				Element element1 = (Element)it1.next();
				
				if(element1.getName().equals("category")){
					
					JCpgCategory category = new JCpgCategory(element1.getAttribute("cid").getIntValue(), element1.getAttribute("ownerid").getIntValue(), element1.getAttribute("name").getValue(), element1.getAttribute("description").getValue(), element1.getAttribute("position").getIntValue(), element1.getAttribute("parent").getIntValue(), element1.getAttribute("thumb").getIntValue());
					category.addUi(getGallery().getUi()); // for syncer
					category.changeSqlQuery(element1.getAttribute("query").getValue());
					getGallery().addCategory(category);
				
					List content2 = element1.getChildren();
					ListIterator it2 = content2.listIterator();
					
					while(it2.hasNext()){
						
						Element element2 = (Element)it2.next();
						
						if(element2.getName().equals("album")){
						
							JCpgAlbum album = new JCpgAlbum(element2.getAttribute("aid").getIntValue(), element2.getAttribute("title").getValue(), element2.getAttribute("description").getValue(), element2.getAttribute("visibility").getIntValue(), element2.getAttribute("uploads").getBooleanValue(), element2.getAttribute("comments").getBooleanValue(), element2.getAttribute("votes").getBooleanValue(), element2.getAttribute("position").getIntValue(), element2.getAttribute("category").getIntValue(), element2.getAttribute("thumb").getIntValue(), element2.getAttribute("keywords").getValue(), element2.getAttribute("password").getValue(), element2.getAttribute("passwordhint").getValue());
							album.addUi(getGallery().getUi()); // for syncer
							album.changeSqlQuery(element2.getAttribute("query").getValue());
							category.addAlbum(album);
							
							List content3 = element2.getChildren();
							ListIterator it3 = content3.listIterator();
							
							while(it3.hasNext()){
								
								Element element3 = (Element)it3.next();
								
								if(element3.getName().equals("picture")){
									
									JCpgPicture picture = new JCpgPicture(element3.getAttribute("pid").getIntValue(), element3.getAttribute("aid").getIntValue(), element3.getAttribute("filepath").getValue(), element3.getAttribute("filename").getValue(), element3.getAttribute("filesize").getIntValue(), element3.getAttribute("totalfilesize").getIntValue(), element3.getAttribute("width").getIntValue(), element3.getAttribute("height").getIntValue(), element3.getAttribute("hits").getIntValue(), element3.getAttribute("ctime").getIntValue(), element3.getAttribute("ownerid").getIntValue(), element3.getAttribute("ownername").getValue(), element3.getAttribute("rating").getIntValue(), element3.getAttribute("votes").getIntValue(), element3.getAttribute("title").getValue(), element3.getAttribute("caption").getValue(), element3.getAttribute("keywords").getValue(), element3.getAttribute("approved").getBooleanValue(), element3.getAttribute("galleryicon").getIntValue(), element3.getAttribute("urlprefix").getIntValue(), element3.getAttribute("position").getIntValue());
									picture.addUi(getGallery().getUi()); // for syncer
									picture.changeSqlQuery(element3.getAttribute("query").getValue());
									album.addPicture(picture);
									
								}
								
							}
						
						}
						
					}
					
				}
				
			}
			
		} catch (JDOMException e) {
			
			e.printStackTrace();
			System.out.println("JCpgGallery: couldn't load gallery.xml");
			
		}
		
		return null;
		
	}
	/**
	 * 
	 * Generate xml file which represents the current state of the local coppermine gallery
	 * We will use the JDOM API to generate the xml file
	 *
	 */
	public void toXML(){
		
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
			eAlbum.setAttribute("query", album.getSqlQuery());
			
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
				ePicture.setAttribute("query", picture.getSqlQuery());
				
				eAlbum.addContent(ePicture);
				
			}
			
		}
		
		
		// categories in main gallery
		for(int i=0; i<getGallery().getCategories().size(); i++){
			
			JCpgCategory category = getGallery().getCategories().get(i);
			
			Element ecategory = new Element("category");
			
			ecategory.setAttribute("cid", category.getId() + "");
			ecategory.setAttribute("ownerid", category.getOwnerId() + "");
			ecategory.setAttribute("name", category.getName());
			ecategory.setAttribute("description", category.getDescription());
			ecategory.setAttribute("position", category.getPosition() + "");
			ecategory.setAttribute("parent", category.getParent() + "");
			ecategory.setAttribute("thumb", category.getThumb() + "");
			ecategory.setAttribute("query", category.getSqlQuery());
			
			egallery.addContent(ecategory);
			
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
				eAlbum.setAttribute("query", album.getSqlQuery());
				
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
					ePicture.setAttribute("query", picture.getSqlQuery());
					
					eAlbum.addContent(ePicture);
					
				}
				
			}
			
		}
		
		// write file
		Document doc=new Document(egallery);
		
		XMLOutputter out = new XMLOutputter();
		
		out.setIndent(true);
		out.setNewlines(true);
		
		try{
			
			FileOutputStream file = new FileOutputStream("config/gallery.xml");
			
			out.output(doc , file);	
			
		}catch(Exception e){
			
			e.printStackTrace();
			
		}

	}

}
