package be.khleuven.frank.JCpg.Communicator;

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
	public boolean getXmlResult(){
		
		return true;
		
	}
	

}
