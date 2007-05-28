package be.khleuven.frank.JCpg;
import java.io.File;
import java.io.Serializable;

import be.khleuven.frank.JCpg.Configuration.JCpgConfig;



public class JCpgAllowedExtensionFilter extends javax.swing.filechooser.FileFilter implements Serializable {
	
																	
	
	
	
	
	
																	//*************************************
																	//				VARIABLES             *
																	//*************************************
	private JCpgConfig cpgConfig;
	
	
	
																	
	
	
	
	
																	
	
	
	
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
	public JCpgAllowedExtensionFilter(JCpgConfig config){
		
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
	private void setCpgConfig(JCpgConfig cpgConfig){
		
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
	public JCpgConfig getCpgConfig(){
		
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
        
        // if the config says 'ALL', we here manually add all the allowed extensions, otherwhise we will use the config setting
        allowedExtensions = getCpgConfig().getValueFor("allowed_img_types");
        
        if(allowedExtensions.equals("ALL")){
        	
	        if(filename.endsWith(".jpg") || filename.endsWith(".gif") || filename.endsWith(".png") || filename.endsWith(".bmp")
	        		|| filename.endsWith(".JPG") || filename.endsWith(".GIF") || filename.endsWith(".PNG") || filename.endsWith(".BMP")){
	        	
	        	return true;
	        	
	        }
	        
        }else{
        	
        	String[] split = allowedExtensions.split("/");
        	
        	for(int i=0; i<split.length; i++){
        		
        		if(filename.endsWith("." + split[i])){
        			
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
