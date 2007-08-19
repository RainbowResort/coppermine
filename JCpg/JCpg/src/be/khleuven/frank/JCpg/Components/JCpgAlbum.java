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



import java.util.ArrayList;

import be.khleuven.frank.JCpg.UI.JCpgUI;

/**
 * Cpg component: album
 * @author    Frank Cleynen
 */
public class JCpgAlbum extends JCpgGallery{
	
	
	
	
																	//*************************************
																	//				VARIABLES             *
																	//*************************************
	private String keyword = null ;
	private String alb_password = null ;
	private String alb_password_hint = null ;
	private int visibility;
	private boolean uploads;
	private boolean comments;
	private boolean votes;
	private int id;
	private int position;
	private int thumb;
	private int category;
	private ArrayList<JCpgPicture> pictures = new ArrayList<JCpgPicture>();
	
	
	
	
	
	
																														
																	//*************************************
																	//				CONSTRUCTORS          *
																	//*************************************														
	/**
	 * 
	 * Makes a new JCpgAlbum object
	 * 
	 * @param id
	 * 		album id (-1 means not in database)
	 * @param title
	 * 		album title
	 * @param description
	 * 		album description
	 * @param visibility
	 * 		album visibility
	 * @param uploads
	 * 		album uploads
	 * @param comments
	 * 		album comments
	 * @param votes
	 * 		album votes
	 * @param position
	 * 		album position
	 * @param category
	 * 		album category
	 * @param thumb
	 * 		album thumb
	 * @param keyword
	 * 		album keyword
	 * @param alb_password
	 * 		album password
	 * @param alb_password_hint
	 * 		album password hint
	 */
	public JCpgAlbum(int id, String title, String description, int visibility, boolean uploads, boolean comments, boolean votes, int position, int category, int thumb, String keyword, String alb_password, String alb_password_hint){
		
		super(title, description);
		
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
			picture.delete(getUi(), this);
			picture = null;
    		
		}
		
		generateDeleteParamaters();
		
		getPictures().clear();
		
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
		
	}
	/**
	 * 
	 * Generate delete parameters and add them to the arraylist in the ui
	 *
	 */
	private void generateDeleteParamaters(){
		
		if(getId() != -1){ // only generate delete parameters if this album is in the server's database
			
			String parameters = "removealbum&username=" + getUi().getCpgConfig().getUserConfig().getUsername() + "&albumid=" + this.getId() + "&sessionkey=" + getUi().getCpgConfig().getUserConfig().getSessionkey();
			
			if(!getUi().hasDeleteParameter(parameters)){
				
				getUi().addDeleteParameter(parameters);
				
			}
			
		}
		
	}

}
