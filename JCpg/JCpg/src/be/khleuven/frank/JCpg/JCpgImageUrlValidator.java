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

import javax.swing.ImageIcon;


/**
 * Takes a path to a file and checks of that file exists. File must be an image.
 * @author    Frank Cleynen
 */
public class JCpgImageUrlValidator{
	
	
	
																
																	//*************************************
																	//				VARIABLES	          *
																	//*************************************
	private String path;


	
	
	
																
																	//*************************************
																	//				CONSTRUCTORS          *
																	//*************************************
	/**
	 * 
	 * Makes a new JCpgImageUrlValidator object
	 * 
	 * @param path
	 * 		a new JCpgImageUrlValidator object.
	 */
	public JCpgImageUrlValidator(String path){
		
		setPath(path);
		
	}
	
	
	
	
																
																	//*************************************
																	//				SETTERS		          *
																	//*************************************
	/**
	 * 
	 * Set the path to the image
	 * 
	 * @param path
	 * 		the path to the image
	 */
	private void setPath(String path){
		
		this.path = path;
		
	}
	
	
	
	
	
																
																	//*************************************
																	//				GETTERS		          *
																	//*************************************
	/**
	 * 
	 * Get the path to the image
	 * 
	 * @return
	 * 		the path to the image
	 */
	public String getPath(){
		
		return this.path;
		
	}
	
	
	
	
	
																
	
	
																	//*************************************
																	//				MUTATORS & OTHERS     *
																	//*************************************
	/**
	 * 
	 * Checks if an image with a given path exists, then returns an ImageIcon object from that image
	 * 
	 * @return
	 * 		an ImageIcon object from the image path
	 */
	public ImageIcon createImageIcon(){
		
		File image = new File(getPath());
		
		if(image.exists()){
			
			return new ImageIcon(getPath());
			
		}
		
		System.out.println("JCpgImageUrlValidator: Couldn't validate image: " + getPath());
		
		return null;
		
	}
	
}
