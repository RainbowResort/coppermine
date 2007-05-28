package be.khleuven.frank.JCpg;
import java.io.File;
import java.io.Serializable;

import javax.swing.ImageIcon;


/**
 * 
 * Takes a path to a file and checks of that file exists. File must be an image.
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgImageUrlValidator implements Serializable{
	
	
	
																
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
