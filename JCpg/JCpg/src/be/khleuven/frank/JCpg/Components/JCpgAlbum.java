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



import java.io.File;
import java.io.Serializable;
import java.util.ArrayList;

import be.khleuven.frank.JCpg.Configuration.JCpgUserConfig;
import be.khleuven.frank.JCpg.UI.JCpgUI;

/**
 * 
 * Cpg component: album
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgAlbum extends JCpgGallery implements Serializable{
	
	
	
	
																	//*************************************
																	//				VARIABLES             *
																	//*************************************
	private String keyword = null, alb_password = null, alb_password_hint = null;
	private int visibility;
	private boolean uploads, comments, votes;
	private int id, position, thumb, category;
	private ArrayList<JCpgPicture> pictures = new ArrayList<JCpgPicture>();
	
	
	
	
	
	
														
																	//*************************************
																	//				CONSTRUCTORS          *
																	//*************************************
	/**
	 * 
	 * Makes a new JCpgAlbum object
	 * 
	 * @param title
	 * 		the title of the album
	 */
	public JCpgAlbum(JCpgUserConfig userConfig, int id, String title, String description, int visibility, boolean uploads, boolean comments, boolean votes, int position, int category, int thumb, String keyword, String alb_password, String alb_password_hint){
		
		super(userConfig, title, description);
		setId(id);
		setVisibility(visibility);
		setUploads(uploads);
		setComments(comments);
		setVotes(votes);
		setPosition(position);
		setCategory(category);
		setThumb(thumb);
		setKeyword(keyword);
		setAlbPassword(alb_password);
		setAlbPasswordHint(alb_password_hint);
		
	}
	
	
	
	
	
	
														
																	//*************************************
																	//				SETTERS               *
																	//*************************************
	/**
	 * 
	 * Set the album id
	 * 
	 * @param id
	 * 		the id of the album
	 */
	private void setId(int id){
		
		this.id = id;
		
	}
	/**
	 * 
	 * Set the album visibility
	 * 
	 * @param visibility
	 * 		the visibility of the album
	 */
	private void setVisibility(int visibility){
		
		this.visibility = visibility;
		
	}
	/**
	 * 
	 * Set the album uploads
	 * 
	 * @param uploads
	 * 		the uploads of the album
	 */
	private void setUploads(boolean uploads){
		
		this.uploads = uploads;
		
	}
	/**
	 * 
	 * Set the album comments flag
	 * 
	 * @param comments
	 * 		the comments flag of the album
	 */
	private void setComments(boolean comments){
		
		this.comments = comments;
		
	}
	/**
	 * 
	 * Set the album votes flag
	 * 
	 * @param votes
	 * 		the votes flag of the album
	 */
	private void setVotes(boolean votes){
		
		this.votes = votes;
		
	}
	/**
	 * 
	 * Set the album position
	 * 
	 * @param position
	 * 		the position of the album
	 */
	private void setPosition(int position){
		
		this.position = position;
		
	}
	/**
	 * 
	 * Set the album category
	 * 
	 * @param category
	 * 		the category of the album
	 */
	private void setCategory(int category){
		
		this.category = category;
		
	}
	/**
	 * 
	 * Set the album thumb
	 * 
	 * @param thumb
	 * 		the thumb of the album
	 */
	private void setThumb(int thumb){
		
		this.thumb = thumb;
		
	}
	/**
	 * 
	 * Set the album keyword
	 * 
	 * @param keyword
	 * 		the keyword of the album
	 */
	private void setKeyword(String keyword){
		
		this.keyword = keyword;
		
	}
	/**
	 * 
	 * Set the album album password
	 * 
	 * @param alb_password
	 * 		the album password of the album
	 */
	private void setAlbPassword(String alb_password){
		
		this.alb_password = alb_password;
		
	}
	/**
	 * 
	 * Set the album album password hint
	 * 
	 * @param alb_password_hint
	 * 		the album password hint of the album
	 */
	private void setAlbPasswordHint(String alb_password_hint){
		
		this.alb_password_hint = alb_password_hint;
		
	}
	
	
	
	
	
	
	
														
																	//*************************************
																	//				GETTERS               *
																	//*************************************
	/**
	 * 
	 * Get the album id
	 * 
	 * @return
	 * 		the id of the album
	 */
	public int getId(){
		
		return this.id;
		
	}
	/**
	 * 
	 * Get the album visibility
	 * 
	 * @return
	 * 		the visibility of the album
	 */
	public int getVisibility(){
		
		return this.visibility;
		
	}
	/**
	 * 
	 * Get the album uploads
	 * 
	 * @return
	 * 		the uploads of the album
	 */
	public boolean getUploads(){
		
		return this.uploads;
		
	}
	/**
	 * 
	 * Get the album comments flag
	 * 
	 * @return
	 * 		the comments flag of the album
	 */
	public boolean getComments(){
		
		return this.comments;
		
	}
	/**
	 * 
	 * Get the album votes flag
	 * 
	 * @return
	 * 		the votes flag of the album
	 */
	public boolean getVotes(){
		
		return this.votes;
		
	}
	/**
	 * 
	 * Get the album position
	 * 
	 * @return
	 * 		the position of the album
	 */
	public int getPosition(){
		
		return this.position;
		
	}
	/**
	 * 
	 * Get the album category
	 * 
	 * @return
	 * 		the category of the album
	 */
	public int getCategory(){
		
		return this.category;
		
	}
	/**
	 * 
	 * Get the album thumb
	 * 
	 * @return
	 * 		the thumb of the album
	 */
	public int getThumb(){
		
		return this.thumb;
		
	}
	/**
	 * 
	 * Get the album keyword
	 * 
	 * @return
	 * 		the keyword of the album
	 */
	public String getKeyword(){
		
		return this.keyword;
		
	}
	/**
	 * 
	 * Get the album password
	 * 
	 * @return
	 * 		the password of the album
	 */
	public String getAlbPassword(){
		
		return this.alb_password;
		
	}
	/**
	 * 
	 * Get the album password hint
	 * 
	 * @return
	 * 		the password hint of the album
	 */
	public String getAlbPasswordHint(){
		
		return this.alb_password_hint;
		
	}
	/**
	 * 
	 * Get an arraylist containing the pictures of this album
	 * 
	 * @return
	 * 		an arraylist containing the pictures of this album
	 */
	public ArrayList<JCpgPicture> getPictures(){
		
		return this.pictures;
		
	}
	/**
	 * 
	 * Get a specific picture based on its name
	 * 
	 * @param name
	 * 		name of the picture you search
	 * @return
	 * 		the picture if it has been found, else null
	 */
	public JCpgPicture getPicture(String name){
		
		for(int i=0; i<getPictures().size(); i++){
			
			JCpgPicture picture = getPictures().get(i);
			
			if(picture.getFileName().equals(name)){
				
				return picture; // picture found
				
			}
			
		}
		
		return null; // nothing found
		
	}
	/**
	 * 
	 * Get number of pictures in this album
	 * 
	 * @return
	 * 		number of pictures in this album
	 */
	public int getNumberOfPictures(){
		
		return getPictures().size();
		
	}
	
	/**
	 * 
	 * Override the toString methode. Used when building the tree
	 * 
	 */
	public String toString(){
		
		return getName();
		
	}
	
	
	
	
	
	
	
	
														
																	//*************************************
																	//				MUTATORS & OTHERS     *
																	//*************************************
	/**
	 * 
	 * Add a picture the the album
	 * 
	 * @param cpgPicture
	 * 		a picture to add
	 */
	public void addPicture(JCpgPicture picture){
		
		this.pictures.add(picture);
		
	}
	/**
	 * 
	 * Delete a picture from the album
	 * 
	 * @param picture
	 * 		the reference to the picture object to delete
	 */
	public void deletePicture(JCpgPicture picture){
		
		this.pictures.remove(picture);
		
	}
	/**
	 * 
	 * Used when deleting an album. All its pictures will be deleted as well.
	 * 
	 */
	public void delete(JCpgUI jCpgUIReference){
		
		for(int i=0; i<getPictures().size(); i++){
    		
			JCpgPicture picture = getPictures().get(i);
			if (picture.getId() != -1) jCpgUIReference.getGallery().getDeleteQueries().add(picture.generateSqlDeleteQuery());
    		File delete = new File("albums/" + picture.getFilePath() + picture.getFileName());
    		delete.delete();
    		delete = new File("albums/" + picture.getFilePath() + "thumb_" + picture.getFileName());
    		delete.delete();
    		picture = null;
    		
		}
		
		getPictures().clear();
    	if (getId() != -1) jCpgUIReference.getGallery().getDeleteQueries().add(generateSqlDeleteQuery());
		
	}
	
	/**
	 * 
	 * Change the id after is has been inserted in the db and assigned a unique id. No need to set mustSync to true because the album already is in the right state in the db at this moment.
	 * 
	 * @param id
	 * 		new fetched id
	 */
	public void changeId(int id){
		
		setId(id);
		
	}
	/**
	 * 
	 * Change the category after the parent category of this album has been inserted into the database. It will then receive a unique id and it will pass it through to its albums
	 * 
	 * @param category
	 * 		the new category id
	 */
	public void changeCategory(int category){
		
		setCategory(category);
		changeMustSync(true);
		
	}
	/**
	 * 
	 * Generate a new INSERT query. Used when syncing when we pass the generated category id.
	 *
	 */
	public void generateSqlInsertQuery(){
		
		changeMustSync(true);
		String sqlquery = "INSERT INTO " + getUserConfig().getServerConfig().getPrefix() + "_albums(title, description, visibility, uploads, comments, votes, pos, category, thumb, keyword, alb_password, alb_password_hint) " +
							"VALUES('" + getName() + "', '" + getDescription() + "', " + getVisibility() + 
							", " + getUploads() + ", " + getComments() + ", " + getVotes() + ", " + getPosition() + ", " + getCategory() + ", " + getThumb() +
							", '" + getKeyword() + "', '" + getAlbPassword() + "', '" + getAlbPasswordHint() + "')";
		changeSqlQuery(sqlquery);
		
	}
	/**
	 * 
	 * Generate a new UPDATE query. Used when changes have been made and the id != -1 which means it's now in the database
	 * 
	 */
	public void generateSqlUpdateQuery(){
		
		changeMustSync(true);
		String sqlquery = "UPDATE " + getUserConfig().getServerConfig().getPrefix() + "_albums SET title='" + getName() + "', description='" + getDescription() + "', visibility=" + getVisibility() + 
							", uploads=" + getUploads() + ", comments=" + getComments() + ", votes=" + getVotes() + ", pos=" + getPosition() + ", category=" + getCategory() + ", thumb=" + getThumb() +
							", keyword='" + getKeyword() + "', alb_password='" + getAlbPassword() + "', alb_password_hint='" + getAlbPasswordHint() + "'"
							+ " WHERE aid=" + getId();
		changeSqlQuery(sqlquery);
		
	}
	/**
	 * 
	 * Generate a DELETE query.
	 * 
	 */
	public String generateSqlDeleteQuery(){
		
		String sqlquery = "DELETE FROM " + getUserConfig().getServerConfig().getPrefix() + "_albums WHERE title = '" + getName() + "'";
		return sqlquery;
		
	}
	/**
	 * 
	 * Generate a fetch id query. Used when we have ma de new album and need the unique id assigned by the database.
	 *
	 */
	public void generateIdFetchQuery(){
		
		changeMustSync(true);
		String sqlquery = "SELECT " + getUserConfig().getServerConfig().getPrefix() + "_albums.aid FROM " + getUserConfig().getServerConfig().getPrefix() + "_albums WHERE title = '" + getName() + "'";
		changeSqlQuery(sqlquery);
		
	}

}
