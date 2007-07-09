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
import java.io.FileOutputStream;

import be.khleuven.frank.JCpg.Components.JCpgPicture;
import be.khleuven.frank.JCpg.Configuration.JCpgConfig;




/**
 * Handles the up and download of the user's picture to/from his server.
 * @author    Frank Cleynen
 */
public class JCpgPictureTransferer{
	
	
	
	
																				
																					//*************************************
																					//				VARIABLES	          *
																					//*************************************
	private JCpgConfig cpgConfig = null;
	private JCpgPicture picture = null;

	
	
	
	
	
																					//*************************************
																					//				CONSTRUCTOR	          *
																					//*************************************
	/**
	 * 
	 * Empty constructor
	 *
	 */
	public JCpgPictureTransferer(){
		
	}																			
	/**
	 * 
	 * Makes a new JCpgPictureTransferer object. The current open connection is needed to first get the root and then go on.
	 * 
	 * @param config
	 * 		Coppermine configuration
	 * @param picture
	 * 		picture to transfer
	 */
	public JCpgPictureTransferer(JCpgConfig config, JCpgPicture picture){
		
		setCpgConfig(config);
		setPicture(picture);
		
	}
	
	
	
																				
																					//*************************************
																					//				SETTERS		          *
																					//*************************************
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
	
	
	
	
	
	
																				
																					//*************************************
																					//				GETTERS		          *
																					//*************************************
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

	
	
																					
																				
	
	
	
																					//*************************************
																					//				MUTATORS & OTHERS     *
																					//*************************************
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
