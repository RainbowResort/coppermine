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
import java.util.Date;

import be.khleuven.frank.JCpg.Configuration.JCpgUserConfig;
import be.khleuven.frank.JCpg.UI.JCpgUI;


/**
 * 
 * Cpg component: picture
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgPicture extends JCpgGallery implements Serializable{
	
	
	
											
											//*************************************
											//				VARIABLES	          *
											//*************************************
	private int id, aid, pwidth, pheight, ownerid, picrating, votes, ctime, galleryicon, urlprefix, position, filesize, totalfilesize, hits;
	private String filename = null, filepath = null, ownername = null, keywords = null;
	private Date mtime = null;
	private boolean approved;
											
	
	
	
	
	
	
	
											//*************************************
											//				CONSTRUCTORS          *
											//*************************************
	/**
	 * 
	 * Makes a new JCpgPicture object
	 * 
	 * @param name
	 * 		the name of the picture
	 * @param fileUrl
	 * 		the URL to the file on the disk
	 */	
	public JCpgPicture(JCpgUserConfig userConfig, int id, int aid, String filepath, String filename, int filesize, int totalfilesize, int pwidth, int pheight, int hits, int ctime, int ownerid, String ownername,
			int picrating, int votes, String title, String caption, String keywords, boolean approved, int galleryicon, int urlprefix, int position){
		
		super(userConfig, title, caption);
		setId(id);
		setAid(aid);
		setFilePath(filepath);
		setFileName(filename);
		setFilesize(filesize);
		setTotalFileSize(totalfilesize);
		setpWidth(pwidth);
		setpHeight(pheight);
		setHits(hits);
		setmTime(mtime);
		setcTime(ctime);
		setOwnerId(ownerid);
		setOwnerName(ownername);
		setPicRating(picrating);
		setVotes(votes);
		setKeywords(keywords);
		setApproved(approved);
		setGalleryIcon(galleryicon);
		setUrlPrefix(urlprefix);
		setPosition(position);
		
	}
											
	
	
	
											//*************************************
											//				SETTERS		          *
											//*************************************
	/**
	 * 
	 * Set the picture id
	 * 
	 * @param id
	 * 		the picture id
	 */
	private void setId(int id){
		
		this.id = id;
		
	}
	/**
	 * 
	 * Set the picture aid
	 * 
	 * @param aid
	 * 		the picture aid
	 */
	private void setAid(int aid){
		
		this.aid = aid;
		
	}
	/**
	 * 
	 * Set the picture filepath
	 * 
	 * @param filepath
	 * 		the picture filepath
	 */
	private void setFilePath(String filepath){
		
		this.filepath = filepath;
		
	}
	/**
	 * 
	 * Set the picture filename
	 * 
	 * @param filename
	 * 		the picture filename
	 */
	private void setFileName(String filename){
		
		this.filename = filename;
		
	}
	/**
	 * 
	 * Set the picture filesize
	 * 
	 * @param filesize
	 * 		the picture filesize
	 */
	private void setFilesize(int filesize){
		
		this.filesize = filesize;
		
	}
	/**
	 * 
	 * Set the picture total filesize
	 * 
	 * @param totalfilesize
	 * 		the picture total filesize
	 */
	private void setTotalFileSize(int totalfilesize){
		
		this.totalfilesize = totalfilesize;
		
	}
	/**
	 * 
	 * Set the picture width
	 * 
	 * @param pwidth
	 * 		the picture width
	 */
	private void setpWidth(int pwidth){
		
		this.pwidth = pwidth;
		
	}
	/**
	 * 
	 * Set the picture height
	 * 
	 * @param pheight
	 * 		the picture height
	 */
	private void setpHeight(int pheight){
		
		this.pheight = pheight;
		
	}
	/**
	 * 
	 * Set the picture hits
	 * 
	 * @param hits
	 * 		the picture hits
	 */
	private void setHits(int hits){
		
		this.hits = hits;
		
	}
	/**
	 * 
	 * Set the picture creation time
	 * 
	 * @param ctime
	 * 		the picture creation time
	 */
	private void setcTime(int ctime){
		
		this.ctime = ctime;
		
	}
	/**
	 * 
	 * Set the picture modification time
	 * 
	 * @param mtime
	 * 		the picture modification time
	 */
	private void setmTime(Date mtime){
		
		this.mtime = mtime;
		
	}
	/**
	 * 
	 * Set the picture owner id
	 * 
	 * @param ownerid
	 * 		the picture owner id
	 */
	private void setOwnerId(int ownerid){
		
		this.ownerid = ownerid;
		
	}
	/**
	 * 
	 * Set the picture owner name
	 * 
	 * @param ownername
	 * 		the picture owner name
	 */
	private void setOwnerName(String ownername){
		
		this.ownername = ownername;
		
	}
	/**
	 * 
	 * Set the picture rating
	 * 
	 * @param picrating
	 * 		the picture rating
	 */
	private void setPicRating(int picrating){
		
		this.picrating = picrating;
		
	}
	/**
	 * 
	 * Set the picture votes
	 * 
	 * @param votes
	 * 		the picture votes
	 */
	private void setVotes(int votes){
		
		this.votes = votes;
		
	}
	/**
	 * 
	 * Set the picture keywords
	 * 
	 * @param keywords
	 * 		the picture keywords
	 */
	private void setKeywords(String keywords){
		
		this.keywords = keywords;
		
	}
	/**
	 * 
	 * Set the picture approved
	 * 
	 * @param approved
	 * 		the picture approved
	 */
	private void setApproved(boolean approved){
		
		this.approved = approved;
		
	}
	/**
	 * 
	 * Set the picture gallery icon
	 * 
	 * @param galleryicon
	 * 		the picture gallery icon
	 */
	private void setGalleryIcon(int galleryicon){
		
		this.galleryicon = galleryicon;
		
	}
	/**
	 * 
	 * Set the picture url prefix
	 * 
	 * @param urlprefix
	 * 		the picture url prefix
	 */
	private void setUrlPrefix(int urlprefix){
		
		this.urlprefix = urlprefix;
		
	}
	/**
	 * 
	 * Set the picture position
	 * 
	 * @param position
	 * 		the picture position
	 */
	private void setPosition(int position){
		
		this.position = position;
		
	}
	
	
	
											
											
											//*************************************
											//				GETTERS		          *
											//*************************************
	/**
	 * 
	 * Get the picture id
	 * 
	 * return id
	 * 		the picture id
	 */
	public int getId(){
		
		return this.id;
		
	}
	/**
	 * 
	 * Get the picture aid
	 * 
	 * @return
	 * 		the picture aid
	 */
	public int getAid(){
		
		return this.aid;
		
	}
	/**
	 * 
	 * Get the picture filepath
	 * 
	 * @return
	 * 		the picture filepath
	 */
	public String getFilePath(){
		
		return this.filepath;
		
	}
	/**
	 * 
	 * Get the picture filename
	 * 
	 * @return
	 * 		the picture filename
	 */
	public String getFileName(){
		
		return this.filename;
		
	}
	/**
	 * 
	 * Get the picture filesize
	 * 
	 * @return
	 * 		the picture filesize
	 */
	public int getFilesize(){
		
		return this.filesize;
		
	}
	/**
	 * 
	 * Get the picture total filesize
	 * 
	 * @return
	 * 		the picture total filesize
	 */
	public int getTotalFileSize(){
		
		return this.totalfilesize;
		
	}
	/**
	 * 
	 * Get the picture width
	 * 
	 * @return
	 * 		the picture width
	 */
	public int getpWidth(){
		
		return this.pwidth;
		
	}
	/**
	 * 
	 * Get the picture height
	 * 
	 * @return
	 * 		the picture height
	 */
	public int getpHeight(){
		
		return this.pheight;
		
	}
	/**
	 * 
	 * Get the picture hits
	 * 
	 * @return
	 * 		the picture hits
	 */
	public int getHits(){
		
		return this.hits;
		
	}
	/**
	 * 
	 * Get the picture modification time
	 * 
	 * @return
	 * 		the picture modification time
	 */
	public Date getmTime(){
		
		return this.mtime;
		
	}
	/**
	 * 
	 * Get the picture creation time
	 * 
	 * @return
	 * 		the picture creation time
	 */
	public int getcTime(){
		
		return this.ctime;
		
	}
	/**
	 * 
	 * Get the picture owner id
	 * 
	 * @return
	 * 		the picture owner id
	 */
	public int getOwnerId(){
		
		return this.ownerid;
		
	}
	/**
	 * 
	 * Get the picture owner name
	 * 
	 * @return
	 * 		the picture owner name
	 */
	public String getOwnerName(){
		
		return this.ownername;
		
	}
	/**
	 * 
	 * Get the picture rating
	 * 
	 * @return
	 * 		the picture rating
	 */
	public int getPicRating(){
		
		return this.picrating;
		
	}
	/**
	 * 
	 * Get the picture votes
	 * 
	 * @return
	 * 		the picture votes
	 */
	public int getVotes(){
		
		return this.votes;
		
	}
	/**
	 * 
	 * Get the picture keywords
	 * 
	 * @return
	 * 		the picture keywords
	 */
	public String getKeywords(){
		
		return this.keywords;
		
	}
	/**
	 * 
	 * Get the picture approved
	 * 
	 * @return
	 * 		the picture approved
	 */
	public boolean getApproved(){
		
		return this.approved;
		
	}
	/**
	 * 
	 * Get the picture gallery icon
	 * 
	 * @return
	 * 		the picture gallery icon
	 */
	public int getGalleryIcon(){
		
		return this.galleryicon;
		
	}
	/**
	 * 
	 * Get the picture url prefix
	 * 
	 * @return
	 * 		the picture url prefix
	 */
	public int getUrlPrefix(){
		
		return this.urlprefix;
		
	}
	/**
	 * 
	 * Get the picture position
	 * 
	 * @return
	 * 		the picture position
	 */
	public int getPosition(){
		
		return this.position;
		
	}
	
	
	
	
	
																		
																			//*************************************
																			//				OVERRIDES			  *
																			//*************************************
	/**
	 * 
	 * toString override
	 * 
	 */
	public String toString(){
		
		return getFileName();
		
	}
	
	
	
	
	
	
																		
																			//*************************************
																			//				MUTATORS & OTHERS	  *
																			//*************************************
	/**
	 * 
	 * Delete picture file
	 * 
	 */
	public void delete(JCpgUI jCpgUIReference){
		
		if (getId() != -1) jCpgUIReference.getGallery().getDeleteQueries().add(generateSqlDeleteQuery()); // id = -1 means this picture is not yet in the database
		
		File delete = new File("albums/" + getFilePath() + getFileName());
		delete.delete();
		delete = new File("albums/" + getFilePath() + "thumb_" + getFileName());
		delete.delete();
		
	}
	/**
	 * 
	 * Change the picture title
	 * 
	 * @param title
	 * 		new picture title
	 */
	public void changeTitle(String title){
		
		changeName(title);
		changeMustSync(true);
		
	}
	/**
	 * 
	 * Change the picture caption
	 * 
	 * @param caption
	 * 		new picture caption
	 */
	public void changeCaption(String caption){
		
		changeDescription(caption);
		changeMustSync(true);
		
	}
	/**
	 * 
	 * Change the picture id
	 * 
	 * @param id
	 * 		new picture id
	 */
	public void changeId(int id){
		
		setId(id);
		
	}
	/**
	 * 
	 * Change the picture aid
	 * 
	 * @param aid
	 * 		new picture aid
	 */
	public void changeAlbumId(int aid){
		
		setAid(aid);
		changeMustSync(true);
		
	}
	/**
	 * 
	 * Change the picture width
	 * 
	 * @param pwidth
	 * 		new picture width
	 */
	public void changeWidth(int pwidth){
		
		setpWidth(pwidth);
		
	}
	/**
	 * 
	 * Change the picture heigth
	 * 
	 * @param pheight
	 * 		new picture height
	 */
	public void changeHeight(int pheight){
		
		setpHeight(pheight);
		
	}
	/**
	 * 
	 * Generate a new INSERT query
	 *
	 */
	public void generateSqlInsertQuery(){
		
		changeMustSync(true);
		String sqlquery = "INSERT INTO " + getUserConfig().getServerConfig().getPrefix() + "_pictures(aid, filepath, filename, filesize, total_filesize, pwidth, pheight, hits, ctime, owner_id, owner_name, pic_rating, votes, title, caption, keywords, approved, galleryicon, url_prefix, position)" +
			" VALUES(" + getAid() + ", '" + getFilePath() + "', '" + getFileName() + "', " + getFilesize() + ", " + getTotalFileSize() + ", " + getpWidth() + ", " + getpHeight()
			+ ", " + getHits() + ", " + getcTime() + ", " + getOwnerId() + ", '" + getOwnerName() + "', " + getPicRating() + ", " + getVotes() + ", '" + getName() + "', '"
			+ getCaption() + "', '" + getKeywords() + "', " + getApproved() + ", " + getGalleryIcon() + ", " + getUrlPrefix() + ", " + getPosition() + ")";
		changeSqlQuery(sqlquery);
		
	}
	/**
	 * 
	 * Generate a new UPDATE query
	 *
	 */
	public void generateSqlUpdateQuery(){
		
		changeMustSync(true);
		String sqlquery = "UPDATE " + getUserConfig().getServerConfig().getPrefix() + "_pictures SET aid=" + getAid() + ", filepath='" + getFilePath() + "', filename='" + getFileName() + 
		"', filesize=" + getFilesize() + ", total_filesize=" + getTotalFileSize() + ", pwidth=" + getpWidth() + ", pheight=" + getpHeight() + ", hits=" + getHits()
		+ ", ctime=" + getcTime() + ", owner_id=" + getOwnerId() + ", owner_name='" + getOwnerName() + "', pic_rating=" + getPicRating() + ", votes=" + getVotes() + ", title='" + getName() 
		+ "', caption='" + getCaption() + "', keywords='" + getKeywords() + "', approved=" + getApproved() + ", galleryicon=" + getGalleryIcon() + ", url_prefix=" + getUrlPrefix() + ", position=" + getPosition() 
		+ " WHERE pid=" + getId();
		changeSqlQuery(sqlquery);
		
	}
	/**
	 * 
	 * Generate a new DELETE query
	 *
	 */
	public String generateSqlDeleteQuery(){
		
		String sqlquery = "DELETE FROM " + getUserConfig().getServerConfig().getPrefix() + "_pictures WHERE filename = '" + getFileName() + "'";
		return sqlquery;
		
	}
	/**
	 * 
	 * Generate a new fetch id query
	 *
	 */
	public void generateIdFetchQuery(){
		
		changeMustSync(true);
		String sqlquery = "SELECT " + getUserConfig().getServerConfig().getPrefix() + "_pictures.pid FROM " + getUserConfig().getServerConfig().getPrefix() + "_pictures WHERE filename = '" + getFileName() + "'";
		changeSqlQuery(sqlquery);
		
	}
	
}
