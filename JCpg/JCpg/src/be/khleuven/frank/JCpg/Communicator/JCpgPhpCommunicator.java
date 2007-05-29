package be.khleuven.frank.JCpg.Communicator;

import java.io.BufferedOutputStream;
import java.io.File;
import java.io.FileOutputStream;
import java.io.InputStream;
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
	
	
	private JCpgUserConfig config = null;
	
	
	
	
	public JCpgPhpCommunicator(JCpgUserConfig config){
		
		setUserConfig(config);
		
	}
	
	
	
	private void setUserConfig(JCpgUserConfig config){
		
		this.config = config;
		
	}
	
	
	
	
	public JCpgUserConfig getConfig(){
		
		return this.config;
		
	}
	
	
	public boolean performPhpRequest(String request){
		
		return true;
		
	}
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
		    
		    return true;
			
		} catch (Exception exception) {
			
			System.out.println("JCpgPhpCommunicator: couldn't retrieve server response");
		
		}
		
		return false;
		
	}
	

}
