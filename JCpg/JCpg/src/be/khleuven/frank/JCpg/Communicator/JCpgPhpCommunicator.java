package be.khleuven.frank.JCpg.Communicator;

import java.io.BufferedOutputStream;
import java.io.File;
import java.io.FileOutputStream;
import java.io.InputStream;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLConnection;

import be.khleuven.frank.JCpg.Configuration.JCpgUserConfig;


/**
 * 
 * Does GET and POST HTTP request to generate and receive XML files to / from Nitin's Coppermine API
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgPhpCommunicator {
	
	
	
																	//*************************************
																	//				VARIABLES	          *
																	//*************************************
	private JCpgUserConfig config = null;
	
	
	
	
																	//*************************************
																	//				CONSTRUCTOR	          *
																	//*************************************
	/**
	 * 
	 * Makes a new JCpgPhpCommunicator object
	 * 
	 * @param config
	 * 		reference to the current configuration
	 */
	public JCpgPhpCommunicator(JCpgUserConfig config){
		
		setUserConfig(config);
		
	}
	
	
	
																	
																	//*************************************
																	//				SETTERS		          *
																	//*************************************
	/**
	 * 
	 * Sets the current configuration
	 * 
	 * @param config
	 * 		the current configuration
	 */
	private void setUserConfig(JCpgUserConfig config){
		
		this.config = config;
		
	}
	
																	
	
	
	
																	//*************************************
																	//				GETTERS		          *
																	//*************************************
	/**
	 * 
	 * Get the current configuration
	 * 
	 * @return
	 * 		the current configuration
	 */
	public JCpgUserConfig getConfig(){
		
		return this.config;
		
	}
	
	
	
																	
																	//*************************************
																	//				MUTATORS & OTHERS	  *
																	//*************************************
	/**
	 * 
	 * Go to a URL to get a XML server response
	 * 
	 * @param url
	 * 		the URL to go to
	 * @return
	 * 		true if it was visited successfully, else false
	 */
	public boolean performPhpRequest(String url){
		
		try {
			
			URL requestUrl = new URL(url);
			
			requestUrl.openConnection();
			
		} catch (Exception e) {
		
			System.out.println("JCpgPhpCommunicator: Couldn't send request URL");
			
		}
		
		return true;
		
	}
	/**
	 * 
	 * Get the XML server response
	 * 
	 * @param url
	 * 		URL where the server response can be found
	 * @return
	 * 		true if the server response was collected successfully, else false
	 */
	public boolean getXmlResult(String url){
		
		try {
			
			File delete = new File("serverResponse.xml"); // delete file if it already exists
			if(delete.exists()) delete.delete();
	    	
			URL responseUrl = new URL(url); // download server xml response
			BufferedOutputStream out = new BufferedOutputStream(new FileOutputStream("serverResponse.xml"));
			URLConnection conn = responseUrl.openConnection();
			InputStream in = conn.getInputStream();
			
			byte[] buffer = new byte[1024];
			int numRead;
			
			while ((numRead = in.read(buffer)) != -1) {
				
				out.write(buffer, 0, numRead);
				
			}

		    out.close();
		    
		    return true; // remote response received well
			
		} catch (Exception exception) {
			
			System.out.println("JCpgPhpCommunicator: couldn't retrieve server response");
		
		}
		
		return false;
		
	}
	

}
