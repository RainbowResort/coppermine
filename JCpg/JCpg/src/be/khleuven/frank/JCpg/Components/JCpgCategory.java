/*
Copyright (C) 2997  Frank Cleynen
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



import java.io.File;
import java.io.Serializable;
import java.util.ArrayList;

import be.khleuven.frank.JCpg.Configuration.JCpgUserConfig;
import be.khleuven.frank.JCpg.UI.JCpgUI;

/**
 * 
 * Cpg Categories. A categorie contains albums.
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgCategory extends JCpgGallery implements Serializable{
																						
	
	
	
																						//*************************************
																						//				VARIABELS             *
																						//*************************************
	private int id, ownerid, position, parent, thumb;
	private ArrayList<JCpgAlbum> albums = new ArrayList<JCpgAlbum>();

	
	
	
	
																					
	
	
																						//*************************************
																						//				CONSTRUCTORS          *
																						//*************************************
	/**
	 * 
	 * Makes a new JCpgCategory object
	 * 
	 * @param id
	 * 		the id
	 * @param name
	 * 		the name
	 * @param description
	 * 		the description
	 * @param position
	 * 		the position
	 * @param parent
	 * 		the parent category
	 */
	public JCpgCategory(JCpgUserConfig userConfig, int id, int ownerid, String name, String description, int position, int parent, int thumb){
		
		super(userConfig, name, description);
		setId(id);
		setOwnerid(ownerid);
		setPosition(position);
		setParent(parent);
		setThumb(thumb);
		
	}
	
	
	
	
	
	
	
																						//*************************************
																						//				SETTERS		          *
																						//*************************************
	/**
	 * 
	 * Set the category id
	 * 
	 * @param id
	 * 		the category id
	 */
	private void setId(int id){
		
		this.id = id;
		
	}
	/**
	 * 
	 * Set the category owner id
	 * 
	 * @param ownerid
	 * 		the category owner id
	 */
	private void setOwnerid(int ownerid){
		
		this.ownerid = ownerid;
		
	}
	/**
	 * 
	 * Set the category position
	 * 
	 * @param position
	 * 		the category position
	 */
	private void setPosition(int position){
		
		this.position = position;
		
	}
	/**
	 * 
	 * Set the category parent
	 * 
	 * @param parent
	 * 		the category parent
	 */
	private void setParent(int parent){
		
		this.parent = parent;
		
	}
	/**
	 * 
	 * Set the category thumb
	 * 
	 * @param thumb
	 * 		the category thumb
	 */
	private void setThumb(int thumb){
		
		this.thumb = thumb;
		
	}

	
	
	
	
	
	
	
	
	
																						//*************************************
																						//				GETTERS		          *
																						//*************************************
	/**
	 * 
	 * Get the category id
	 * 
	 * @return
	 * 		the category id
	 */
	public int getId(){
		
		return this.id;
		
	}
	/**
	 * 
	 * Get the category owner id
	 * 
	 * @return
	 * 		the category owner id
	 */
	public int getOwnerId(){
		
		return this.ownerid;
		
	}
	/**
	 * 
	 * Get the category position
	 * 
	 * @return
	 * 		the category position
	 */
	public int getPosition(){
		
		return this.position;
		
	}
	/**
	 * 
	 * Get the category parent
	 * 
	 * @return
	 * 		the category parent
	 */
	public int getParent(){
		
		return this.parent;
		
	}
	/**
	 * 
	 * Get the category arraylist with albums
	 * 
	 * @return
	 * 		the category arraylist with albums
	 */
	public ArrayList<JCpgAlbum> getAlbums(){
		
		return this.albums;
		
	}
	/**
	 * 
	 * Get a specific album based on its name
	 * 
	 * @param name
	 * 		name of the album you search
	 * @return
	 * 		the album if it has been found, else null
	 */
	public JCpgAlbum getAlbum(String name){
		
		for(int i=0; i<getAlbums().size(); i++){
			
			JCpgAlbum album = getAlbums().get(i);
			
			if(album.getName().equals(name)){
				
				return album; // album found
				
			}
			
		}
		
		return null; // nothing found
		
	}
	/**
	 * 
	 * Get the category thumb
	 * 
	 * @return
	 * 		the category thumb
	 */
	public int getThumb(){
		
		return this.thumb;
		
	}
	
	
	
	
	
																						//*************************************
																						//				OVERRIDES	          *
																						//*************************************
	/**
	 * 
	 * Override the toString methode. Used when building the tree in UI
	 * 
	 */
	public String toString(){
		
		return getName();
		
	}
	
	
	
	
	
																						//*************************************
																						//				MUTATORS & OTHERS	  *
																						//*************************************
	/**
	 * 
	 * Add an album to the category
	 * 
	 * @param album
	 * 		the album to add
	 */
	public void addAlbum(JCpgAlbum album){
		
		this.albums.add(album);
		
	}
	/**
	 * 
	 * Delete an album from the category
	 * 
	 * @param album
	 * 		the album to delete
	 */
	public void deleteAlbum(JCpgAlbum album){
		
		this.albums.remove(album);
		
	}
	/**
	 * 
	 * Used when deleting a category. All its albums and the pictures in their will be deleted.
	 * 
	 */
	public void delete(JCpgUI jCpgUIReference){
		
		for(int i=0; i<getAlbums().size(); i++){
    		
			JCpgAlbum album = getAlbums().get(i);
			if (album.getId() != -1) jCpgUIReference.getGallery().getDeleteQueries().add(album.generateSqlDeleteQuery());

    		for(int j=0; j<album.getPictures().size(); j++){
    				
    			JCpgPicture picture = album.getPictures().get(j);
    			if (picture.getId() != -1) jCpgUIReference.getGallery().getDeleteQueries().add(picture.generateSqlDeleteQuery());
    			File delete = new File("albums/" + picture.getFilePath() + picture.getFileName());
    			delete.delete();
    			delete = new File("albums/" + picture.getFilePath() + "thumb_" + picture.getFileName());
        		delete.delete();
    			picture = null;
    				
    		}
    		
    		album.getPictures().clear();
    		album = null;
    		
    	}
		
		getAlbums().clear();
		if (getId() != -1) jCpgUIReference.getGallery().getDeleteQueries().add(generateSqlDeleteQuery()); // delete category itself
		
	}
	/**
	 * 
	 * Change the id after is has been inserted in the db and assigned a unique id. No need to set mustSync to true because the category already is in the right state in the db at this moment.
	 * 
	 * @param id
	 * 		new fetched id
	 */
	public void changeId(int id){
		
		setId(id);
		
	}
	/**
	 * 
	 * Generate a new INSERT query. Used when syncing when we pass the generated category id.
	 *
	 */
	public void generateSqlInsertQuery(){
		
		changeMustSync(true);
		String sqlquery = "INSERT INTO " + getUserConfig().getServerConfig().getPrefix() + "_categories(owner_id, name, description, pos, parent, thumb) VALUES(" + getOwnerId() + ", '" + getName() + "', '" + getDescription() + 
		"', " + getPosition() + ", " + getParent() + ", " + getThumb() + ")";
		changeSqlQuery(sqlquery);
		
	}
	/**
	 * 
	 * Generate a new UPDATE query
	 *
	 */
	public void generateSqlUpdateQuery(){
		
		changeMustSync(true);
		String sqlquery = "UPDATE " + getUserConfig().getServerConfig().getPrefix() + "_categories owner_id=" + getOwnerId() + ", name='" + getName() + "', description='" + getDescription() + 
		"', pos=" + getPosition() + ", parent=" + getParent() + ", thumb=" + getThumb() + " WHERE cid=" + getId();
		changeSqlQuery(sqlquery);
		
	}
	/**
	 * 
	 * Generate a new DELETE query
	 *
	 */
	public String generateSqlDeleteQuery(){
		
		String sqlquery = "DELETE FROM " + getUserConfig().getServerConfig().getPrefix() + "_categories WHERE name = '" + getName() + "'";
		return sqlquery;
		
	}
	/**
	 * 
	 * Generate a new fetch id query
	 *
	 */
	public void generateIdFetchQuery(){
		
		changeMustSync(true);
		String sqlquery = "SELECT " + getUserConfig().getServerConfig().getPrefix() + "_categories.cid FROM " + getUserConfig().getServerConfig().getPrefix() + "_categories WHERE name = '" + getName() + "'";
		changeSqlQuery(sqlquery);
		
	}
	
}
