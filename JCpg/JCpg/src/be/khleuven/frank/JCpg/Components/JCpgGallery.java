package be.khleuven.frank.JCpg.Components;



import java.io.BufferedWriter;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileWriter;
import java.io.IOException;
import java.io.ObjectOutputStream;
import java.io.Serializable;
import java.util.ArrayList;

import javax.swing.tree.TreePath;

import be.khleuven.frank.JCpg.Configuration.JCpgUserConfig;
import be.khleuven.frank.JCpg.UI.JCpgUI;


public class JCpgGallery implements Serializable{
	
	
	
														//*************************************
														//				VARIABLES             *
														//*************************************
	private String name = null, description = null;
	private JCpgUserConfig userConfig;
	private ArrayList<JCpgCategory> categories = new ArrayList<JCpgCategory>();
	private ArrayList<String> deleteQueries = new ArrayList<String>(); // used to store deletion queries. Needed because the object itself will be deleted so we can't get the query from the object anymore
	
	private boolean mustSync = false; // used to indicate if there's anything new about this object. If yes, a SQL query us generated and needs to be executed.
	private String sqlquery = ""; // when mustSync becomes true, this variable will be filled with the right query and must be executed during the next sync

	private TreePath treePath; // holds the path in the tree to the object so if we select a picture in the pictureList we can also make it selected in the tree
	
	
	
														//*************************************
														//				CONSTRUCTORS          *
														//*************************************
	/**
	 * 
	 * Makes a new JCpgGallery object. This object contains all the albums in de list view. We use this object to order the albums.
	 * We can just use the index of the album in the arraylist.
	 * Normally only one main gallery is active in JCgp but at a later time, when galleries may be part of Cpg, more could be
	 * active at the same time.
	 * 
	 */
	public JCpgGallery(JCpgUserConfig userConfig, String name, String description){
		
		setName(name);
		setDescription(description);
		setUserConfig(userConfig);
		
	}
	
	
	
														
														//*************************************
														//				SETTERS	              *
														//*************************************
	/**
	 * 
	 * Set the gallery name
	 * 
	 * @param name
	 * 		the name of the gallery
	 */
	private void setName(String name){
		
		this.name = name;
		
	}
	/**
	 * 
	 * Set the gallery desciption
	 * 
	 * @param description
	 * 		the gallery desciption
	 */
	private void setDescription(String description){
		
		this.description = description;
		
	}
	/**
	 * 
	 * Set the gallery userConfig
	 * 
	 * @param userConfig
	 * 		the gallery userConfig
	 */
	private void setUserConfig(JCpgUserConfig userConfig){
		
		this.userConfig = userConfig;
		
	}
	
	
	
	
	
	
	
														
														//*************************************
														//				GETTERS               *
														//*************************************
	/**
	 * 
	 * Get the gallery name
	 * 
	 * @return
	 * 		the name of the gallery
	 */
	public String getName(){
		
		return this.name;
		
	}
	/**
	 * 
	 * Get the gallery description
	 * 
	 * @return
	 * 		the gallery description
	 */
	public String getDescription(){
		
		return this.description;
		
	}
	/**
	 * 
	 * Gets the caption. Used by pictures.
	 * 
	 * @return
	 * 		the picture caption
	 */
	public String getCaption(){
		
		return getDescription();
		
	}
	/**
	 * 
	 * Get the gallery user config
	 * 
	 * @return
	 * 		the gallery user config
	 */
	public JCpgUserConfig getUserConfig(){
		
		return this.userConfig;
		
	}
	/**
	 * 
	 * Get an arraylist with the albums in this gallery
	 * 
	 * @return
	 * 		an arraylist with the albums in this gallery
	 */
	public ArrayList<JCpgCategory> getCategories(){
		
		return this.categories;
		
	}
	/**
	 * 
	 * Get a specific category based on its name
	 * 
	 * @param name
	 * 		name of the category you search
	 * @return
	 * 		the category if it has been found, else null
	 */
	public JCpgCategory getCategory(String name){
		
		for(int i=0; i<getCategories().size(); i++){
			
			JCpgCategory category = getCategories().get(i);
			
			if(category.getName().equals(name)){
				
				return category; // category found
				
			}
			
		}
		
		return null; // nothing found
		
	}
	/**
	 * 
	 * Get the mustSync flag
	 * 
	 * @return
	 * 		the mustSync flag
	 */
	public boolean getMustSync(){
		
		return this.mustSync;
		
	}
	/**
	 * 
	 * Get the current filled in sql query
	 * 
	 * @return
	 * 		the current filled in sql query
	 */
	public String getSqlQuery(){
		
		return this.sqlquery;
		
	}
	/**
	 * 
	 * Get a list with all the delete queries. We need to collect them in this never deleted arraylist because we can't store them in the objects themselves because they are already deleted
	 * and are not anymore linked with the gallery.
	 * 
	 * @return
	 * 		a list with all the delete queries
	 */
	public ArrayList<String> getDeleteQueries(){
	
		return this.deleteQueries;
		
	}
	public TreePath getTreePath(){
		
		return this.treePath;
		
	}
	
	
	
	
	
	
	
	
	
	
														
														//*************************************
														//				MUTATORS & OTHERS     *
														//*************************************
	/**
	 * 
	 * Add an album to the gallery
	 * 
	 * @param jCpgAlbum
	 *		the album to add
	 */
	public void addCategory(JCpgCategory category){
		
		getCategories().add(category);
		
	}
	/**
	 * 
	 * Delete an album from the gallery
	 * 
	 * @param jCpgAlbum
	 * 		the album to delete
	 */
	public void deleteCategory(JCpgCategory category){
		
		getCategories().remove(category);
		
	}
	/**
	 * 
	 * Change the gallery name
	 * 
	 * @param name
	 * 		the new gallery name
	 */
	public void changeName(String name){
		
		setName(name);
		
	}
	/**
	 * 
	 * Change the gallery description
	 * 
	 * @param description
	 * 		the new gallery description
	 */
	public void changeDescription(String description){
		
		setDescription(description);
		
	}
	/**
	 * 
	 * Change the gallery user configuration
	 * 
	 * @param userConfig
	 * 		the new user configuration
	 */
	public void changeUserConfig(JCpgUserConfig userConfig){
		
		setUserConfig(userConfig);
		
	}
	/**
	 * 
	 * Generate xml file which represents the current state of the local coppermine gallery
	 *
	 */
	public void toXML(){
		
		ArrayList<String> xml = new ArrayList<String>();
		
		xml.add("<?xml version=\"1.0\"?>");
		xml.add("<gallery>");
		
		for(int i=0; i<getCategories().size(); i++){
			
			JCpgCategory category = getCategories().get(i);
			xml.add("\t" + "<category>");
			xml.add("\t\t" + "<name>" + category.getName() + "</name>");
			xml.add("\t\t" + "<description>" + category.getDescription() + "</description>");
			xml.add("\t\t" + "<position>" + category.getPosition() + "</position>");
			xml.add("\t\t" + "<parent>" + category.getParent() + "</parent>");
			
			for(int j=0; j<category.getAlbums().size(); j++){
				
				JCpgAlbum album = category.getAlbums().get(j);
				xml.add("\t\t" + "<album>");
				xml.add("\t\t\t" + "<title>" + album.getName() + "</title>");
				xml.add("\t\t\t" + "<description>" + album.getDescription() + "</description>");
				xml.add("\t\t\t" + "<visibility>" + album.getVisibility() + "</visiblity>");
				xml.add("\t\t\t" + "<uploads>" + album.getUploads() + "</uploads>");
				xml.add("\t\t\t" + "<comments>" + album.getComments() + "</comments>");
				xml.add("\t\t\t" + "<votes>" + album.getVotes() + "</votes>");
				xml.add("\t\t\t" + "<position>" + album.getPosition() + "</position>");
				xml.add("\t\t\t" + "<category>" + album.getCategory() + "</category>");
				xml.add("\t\t\t" + "<thumb>" + album.getThumb() + "</thumb>");
				xml.add("\t\t\t" + "<keyword>" + album.getKeyword() + "</keyword>");
				xml.add("\t\t\t" + "<password>" + album.getAlbPassword() + "</password>");
				xml.add("\t\t\t" + "<passwordhint>" + album.getAlbPasswordHint() + "</passwordhint>");
				
				for(int k=0; k<album.getPictures().size(); k++){
					
					JCpgPicture picture = album.getPictures().get(k);
					xml.add("\t\t\t" + "<picture>");
					xml.add("\t\t\t\t" + "<aid>" + picture.getAid() + "</aid>");
					xml.add("\t\t\t\t" + "<filepath>" + picture.getFilePath() + "</filepath>");
					xml.add("\t\t\t\t" + "<filename>" + picture.getFileName() + "</filename>");
					xml.add("\t\t\t\t" + "<filesize>" + picture.getFilesize() + "</filesize>");
					xml.add("\t\t\t\t" + "<totalfilesize>" + picture.getTotalFileSize() + "</totalfilesize>");
					xml.add("\t\t\t\t" + "<width>" + picture.getpWidth() + "</width>");
					xml.add("\t\t\t\t" + "<height>" + picture.getpHeight() + "</height>");
					xml.add("\t\t\t\t" + "<hits>" + picture.getHits() + "</hits>");
					xml.add("\t\t\t\t" + "<mtime>" + picture.getmTime() + "</mtime>");
					xml.add("\t\t\t\t" + "<ctime>" + picture.getcTime() + "</ctime>");
					xml.add("\t\t\t\t" + "<ownerid>" + picture.getOwnerId() + "</ownerid>");
					xml.add("\t\t\t\t" + "<ownername>" + picture.getOwnerName() + "</ownername>");
					xml.add("\t\t\t\t" + "<rating>" + picture.getPicRating() + "</rating>");
					xml.add("\t\t\t\t" + "<votes>" + picture.getVotes() + "</votes>");
					xml.add("\t\t\t\t" + "<title>" + picture.getName() + "</title>");
					xml.add("\t\t\t\t" + "<caption>" + picture.getCaption() + "</caption>");
					xml.add("\t\t\t\t" + "<keywords>" + picture.getKeywords() + "</keywords>");
					xml.add("\t\t\t\t" + "<approved>" + picture.getApproved() + "</approved>");
					xml.add("\t\t\t\t" + "<galleryicon>" + picture.getGalleryIcon() + "</galleryicon>");
					xml.add("\t\t\t\t" + "<urlprefix>" + picture.getUrlPrefix() + "</urlprefix>");
					xml.add("\t\t\t\t" + "<position>" + picture.getPosition() + "</position>");
					xml.add("\t\t\t" + "</picture>");
					
				}
				
				xml.add("\t\t" + "</album>");
				
			}
			
			xml.add("\t" + "</category>");
			
		}
		
		xml.add("</gallery>");
		
		// write file
		try {
			
			File xmlfile = new File("gallery.xml"); // delete file if existing
			if(xmlfile.exists()) xmlfile.delete();
			
	        BufferedWriter out = new BufferedWriter(new FileWriter("gallery.xml"));
	        
	        for(int i=0; i<xml.size(); i++){
	        	
	        	out.write(xml.get(i) + "\n");
	        	
	        }
	        
	        out.close();
	        
	    } catch (IOException e) {
	    	
	    	System.out.println("JCpgGallery: couldn't write XML file");
	    	
	    }
	    
	}
	/**
	 * 
	 * Deletes a gallery. Of course the main gallery can't be deleted, but all the other stuff can. Everything in the tree will be deleted. The JCpgUIReference is needed to get the reference
	 * to the main gallery and add sql delete queries of all tree elements.
	 * 
	 * @param jCpgUIReference
	 */
	public void delete(JCpgUI jCpgUIReference){
		
		for(int i=0; i<getCategories().size(); i++){
    		
			JCpgCategory category = getCategories().get(i);
			if (category.getId() != -1) jCpgUIReference.getGallery().getDeleteQueries().add(category.generateSqlDeleteQuery());
    		for(int j=0; j<category.getAlbums().size(); j++){
    			
    			JCpgAlbum album = category.getAlbums().get(j);
    			if (album.getId() != -1) jCpgUIReference.getGallery().getDeleteQueries().add(album.generateSqlDeleteQuery());
    			for(int k=0; k<album.getPictures().size(); k++){
    				
    				JCpgPicture picture = album.getPictures().get(k);
    				if (picture.getId() != -1) jCpgUIReference.getGallery().getDeleteQueries().add(picture.generateSqlDeleteQuery());
    				File delete = new File("albums/" + picture.getFilePath() + picture.getFileName());
    				delete.delete();
    				delete = new File("albums/" + picture.getFilePath() + "thumb_" + picture.getFileName());
    	    		delete.delete();
    				picture = null;
    				
    			}
    			
    			album = null;
    		}
    		
    		category.getAlbums().clear();
    		category = null;
    		
    	}
		
		getCategories().clear();
		
	}

	/**
	 * 
	 * toString override
	 * 
	 */
	public String toString(){
		
		return this.getName();
		
	}
	/**
	 * 
	 * Change the mustSync flag
	 * 
	 * @param mustSync
	 * 		the new mustSync flag
	 */
	public void changeMustSync(boolean mustSync){
		
		this.mustSync = mustSync;
		
	}
	public void changeTreePath(TreePath treePath){
		
		this.treePath = treePath;
		
	}
	/**
	 * 
	 * Change the sql query
	 * 
	 * @param sqlquery
	 * 		the new sql query
	 */
	public void changeSqlQuery(String sqlquery){
		
		this.sqlquery = sqlquery;
		
	}
	/**
	 * 
	 * Generate a new INSERT query
	 *
	 */
	public void generateSqlInsertQuery(){
		
	}
	/**
	 * 
	 * Generate a new UPDATE query
	 *
	 */
	public void generateSqlUpdateQuery(){
		
	}
	/**
	 * 
	 * Generate a new DELETE query
	 *
	 */
	public String generateSqlDeleteQuery(){
		
		return "";
		
	}
	/**
	 * 
	 * Sometimes we need to regenerate the sql query because after it was first generated, small changes were done to the object. For example, when running the syncer, an newly inserted category
	 * will fetch its assigned unique id and pass it through to his albums. We then need to regenerate the album's sql queries.
	 *
	 */
	public void regenerateSqlQuery(){
		
		if(getSqlQuery().startsWith("INSERT")){
			
			generateSqlInsertQuery();
			
		}else if(getSqlQuery().startsWith("INSERT")){
			
			generateSqlUpdateQuery();
			
		}
		
	}
	
}
