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

package be.khleuven.frank.JCpg;

import java.io.File;

import be.khleuven.frank.JCpg.Configuration.JCpgSiteConfig;


/**
 * Allowed extensions for pictures importation
 * @author    Frank Cleynen
 */
public class JCpgAllowedExtensionFilter extends javax.swing.filechooser.FileFilter {
	
																	
	
	
	
	
	
																	//*************************************
																	//				VARIABLES             *
																	//*************************************
	private JCpgSiteConfig cpgConfig;
	
	
	
																	
	
	
	
	
																	
	
	
	
																	//*************************************
																	//				CONSTRUCTOR           *
																	//*************************************
	/**
	 * 
	 * Makes a new JCpgAllowedExtensionFilter object
	 * 
	 * @param config
	 * 		reference to the current configuration
	 */
	public JCpgAllowedExtensionFilter(JCpgSiteConfig config){
		
		setCpgConfig(config);
		
	}
	
	
	
	
	
	
																	
																	//*************************************
																	//				SETTERS	              *
																	//*************************************
	/**
	 * 
	 * Set the allowed extension configuration
	 * 
	 * @param cpgConfig
	 * 		the allowed extension configuration
	 */
	private void setCpgConfig(JCpgSiteConfig cpgConfig){
		
		this.cpgConfig = cpgConfig;
		
	}
	
	
	
	
	
	
																	
																	//*************************************
																	//				GETTERS	              *
																	//*************************************
	/**
	 * 
	 * Get the allowed extension configuration
	 * 
	 * @return
	 * 		the allowed extension configuration
	 */
	public JCpgSiteConfig getCpgConfig(){
		
		return this.cpgConfig;
		
	}
	
	
	
	
	
	
	
	
																	
																	//*************************************
																	//				MUTATORS & OTHERS     *
																	//*************************************
	/**
	 * 
	 * This methode has to be implemented by extending javax.swing.filechooser.FileFilter. It tells us which files can be accepted as right picture files. 
	 * 
	 */
	public boolean accept(File file) {
		
        String filename = file.getName();
        String allowedExtensions = null;
        
        
        if(file.isDirectory()){ // also allow dirs
        	
        	return true;
        	
        }
        
        // if the config says 'ALL', we here manually add all the allowed extensions, otherwhise we will use the config setting
        allowedExtensions = getCpgConfig().getValueFor("allowed_img_types");
        
        if(allowedExtensions.equals("ALL")){
        	
	        if(filename.toLowerCase().endsWith(".jpg") || filename.toLowerCase().endsWith(".gif") || filename.toLowerCase().endsWith(".png") || filename.toLowerCase().endsWith(".bmp")){
	        	
	        	return true;
	        	
	        }
	        
        }else{
        	
        	String[] split = allowedExtensions.split("/");
        	
        	for(int i=0; i<split.length; i++){
        		
        		if(filename.toLowerCase().endsWith("." + split[i])){
        			
        			return true;
        			
        		}
        		
        	}
        	
        	return false;
        	
        }
        
        return false;
        
    }
	/**
	 * 
	 * This methode has to be implemented by extending javax.swing.filechooser.FileFilter
	 * 
	 */
    public String getDescription() {
    	
        return "";
        
    }
    
}
