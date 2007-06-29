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

package be.khleuven.frank.JCpg.Components;



import be.khleuven.frank.JCpg.Configuration.JCpgUserConfig;
import be.khleuven.frank.JCpg.UI.JCpgUI;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileOutputStream;
import java.io.FileWriter;
import java.io.IOException;
import java.io.Serializable;
import java.util.ArrayList;
import javax.swing.tree.TreePath;
import org.jdom.*;
import org.jdom.output.*;


/**
 * Cpg component: Gallery
 * @author    Frank Cleynen
 */
public class JCpgGallery implements Serializable{
	
	
	
														//*************************************
														//				VARIABLES             *
														//*************************************
	private JCpgUI ui = null;
	private String name = null ;
	private String description = null ;
	//private JCpgUserConfig userConfig;
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
	public JCpgGallery(String name, String description){
		
		setName(name);
		setDescription(description);
		
	}
	
	
	
														
														//*************************************
														//				SETTERS	              *
														//*************************************
	private void setUi(JCpgUI ui){
		
		this.ui = ui;
		
	}
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
	/*private void setUserConfig(JCpgUserConfig userConfig){
		
		this.userConfig = userConfig;
		
	}*/
	
	
	
	
	
	
	
														
														//*************************************
														//				GETTERS               *
														//*************************************
	public JCpgUI getUi(){

		return this.ui;
		
	}
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
	/*public JCpgUserConfig getUserConfig(){
		
		return this.userConfig;
		
	}*/
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
	public void addUi(JCpgUI ui){
		
		setUi(ui);
		
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
	/*public void changeUserConfig(JCpgUserConfig userConfig){
		
		setUserConfig(userConfig);
		
	}*/
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
    				picture.delete(jCpgUIReference);
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
