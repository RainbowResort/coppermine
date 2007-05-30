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

package be.khleuven.frank.JCpg.Sync;

import java.awt.Dimension;
import java.io.BufferedOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.io.Serializable;
import java.net.URL;
import java.net.URLConnection;

import be.khleuven.frank.JCpg.Components.JCpgPicture;
import be.khleuven.frank.JCpg.Configuration.JCpgConfig;
import be.khleuven.frank.JCpg.Configuration.JCpgServerConfig;
import be.khleuven.frank.JCpg.Manager.JCpgSqlManager;




/**
 * 
 * Handles the up and download of the user's picture to/from his server.
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgPictureTransferer implements Serializable{
	
	
	
	
																				
																					//*************************************
																					//				VARIABLES	          *
																					//*************************************
	private JCpgSqlManager sqlManager = null;
	private JCpgServerConfig serverConfig = null;
	private JCpgConfig cpgConfig = null;
	private JCpgPicture picture = null;
	private String root = null;
	private Dimension thumbnailPreferredSize = new Dimension(100, 100);
	
	public JCpgPictureTransferer(){
		
	}
	
	
	
	
																				
	
	
	
	
																					//*************************************
																					//				CONSTRUCTOR	          *
																					//*************************************
	/**
	 * 
	 * Makes a new JCpgPictureTransferer object. The current open connection is needed to first get the root and then go on.
	 * 
	 * @param cpgServerpath
	 * 		path to the cpg directory on the user's server.
	 */
	public JCpgPictureTransferer(JCpgSqlManager sqlManager, JCpgServerConfig serverConfig, JCpgConfig config, JCpgPicture picture){
		
		setSqlManager(sqlManager);
		setServerConfig(serverConfig);
		setCpgConfig(config);
		setPicture(picture);
		
		setRoot();
		
	}
	
	
	
																				
																					//*************************************
																					//				SETTERS		          *
																					//*************************************
	/**
	 * 
	 * Set the picture transferer sql manager
	 * 
	 * @param sqlManager
	 * 		the picture transferer sql manager
	 */
	private void setSqlManager(JCpgSqlManager sqlManager){
		
		this.sqlManager = sqlManager;
		
	}
	/**
	 * 
	 * Set the picture transferer server configuration
	 * 
	 * @param serverConfig
	 * 		the picture transferer server configuration
	 */
	private void setServerConfig(JCpgServerConfig serverConfig){
		
		this.serverConfig = serverConfig;
		
	}
	/**
	 * 
	 * Set the picture transferer configuration
	 * 
	 * @param config
	 * 		the picture transferer configuration
	 */
	private void setCpgConfig(JCpgConfig config){
		
		this.cpgConfig = config;
		
	}
	/**
	 * 
	 * Set the picture transferer picture to transfer
	 * 
	 * @param picture
	 * 		the picture transferer picture to transfer
	 */
	private void setPicture(JCpgPicture picture){
		
		this.picture = picture;
		
	}
	/**
	 * 
	 * Set the server root, for example 'http://localhost/cpg1410/'
	 *
	 */
	private void setRoot(){
		
		this.root = getCpgConfig().getValueFor("ecards_more_pic_target");
		
	}
	
	
	
	
	
	
																				
																					//*************************************
																					//				GETTERS		          *
																					//*************************************
	/**
	 * 
	 * Get the sql manager
	 * 
	 * @return
	 * 		the sql manager
	 */
	public JCpgSqlManager getSqlManager(){
		
		return this.sqlManager;
		
	}
	/**
	 * 
	 * Get the server config
	 * 
	 * @return
	 * 		the server config
	 */
	public JCpgServerConfig getServerConfig(){
		
		return this.serverConfig;
		
	}
	/**
	 * 
	 * Get the configuration
	 * 
	 * @return
	 * 		the configuration
	 */
	public JCpgConfig getCpgConfig(){
		
		return this.cpgConfig;
		
	}
	/**
	 * 
	 * Get the picture to transfer
	 * 
	 * @return
	 * 		the picture to transfer
	 */
	public JCpgPicture getPicture(){
		
		return this.picture;
		
	}
	/**
	 * 
	 * Get the server's root
	 * 
	 * @return
	 * 		the server's root
	 */
	public String getRoot(){
		
		return this.root;
		
	}

	
	
																					
																				
	
	
	
																					//*************************************
																					//				MUTATORS & OTHERS     *
																					//*************************************
	/**
	 * 
	 * Download the picture. First build a http url and then use the http protocol to get the bytes and write them to a file
	 *
	 */
	public void downloadImage() {
		
		OutputStream out = null;
		URLConnection conn = null;
		InputStream  in = null;
		
		File checkExistance = new File(getCpgConfig().getValueFor("fullpath") + getPicture().getFilePath() + getPicture().getFileName());
		
		if(!checkExistance.exists()){ // only download if file does not exist
			
			try {
				
				// download and save
				URL url = new URL(getRoot() + getCpgConfig().getValueFor("fullpath") + getPicture().getFilePath() + getPicture().getFileName()); // link to remote file
				new File(getCpgConfig().getValueFor("fullpath") + getPicture().getFilePath()).mkdirs(); // make directory structure if not existing
				out = new BufferedOutputStream(new FileOutputStream(getCpgConfig().getValueFor("fullpath") + getPicture().getFilePath() + getPicture().getFileName()));
				conn = url.openConnection();
				in = conn.getInputStream();
				
				byte[] buffer = new byte[1024];
				int numRead;
				long numWritten = 0;
				
				while ((numRead = in.read(buffer)) != -1) {
					
					out.write(buffer, 0, numRead);
					numWritten += numRead;
					
				}
				
				
			    out.close(); 
				
				System.out.println(getRoot() + getCpgConfig().getValueFor("fullpath") + getPicture().getFilePath() + getPicture().getFileName() + "\t" + numWritten);
				
			} catch (Exception exception) {
				
				System.out.println("JCpgPictureTransferer: Couldn't transfer file: " + getRoot() + getCpgConfig().getValueFor("fullpath") + getPicture().getFilePath() + getPicture().getFileName());
			
			} finally {
				
				try {
					
					if (in != null) {
						
						in.close();
						
					}
					
					if (out != null) {
						
						out.close();
						
					}
					
				} catch (IOException ioe) {
					
				}
				
			}
			
		}	
		
	}
	/**
	 * 
	 * Copy a file locally. Used when adding offline pictures.
	 * 
	 * @param in
	 * 		selected file on harddrive
	 * @param out
	 * 		output file that comes in the offline Coppermine album
	 * @return
	 * 		returns the number of bytes copied
	 * @throws Exception
	 * 		when the copying failed
	 */
	public long copyFile(File in, File out) throws Exception {
		
	    FileInputStream fis  = new FileInputStream(in);
	    FileOutputStream fos = new FileOutputStream(out);
	    
	    byte[] buf = new byte[1024];
	    
	    int i = 0;
	    long filesize = 0;
	    while((i=fis.read(buf))!=-1) {
	    	
	    	fos.write(buf, 0, i);
	    	filesize = filesize + i;
	    	
	    }
	    
	    fis.close();
	    fos.close();
	    
	    return filesize;
	    
	}

}
