package be.khleuven.frank.JCpg.Configuration;
import java.io.Serializable;


/**
 * 
 * User configuration
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgUserConfig implements Serializable {
	
	private String username, password;
	private JCpgServerConfig serverConfig;
	
	
	
	/**
	 * 
	 * Makes a new JcpgUserConfig
	 * 
	 * @param username
	 * 		username of Coppermine site
	 * @param password
	 * 		password of Coppermine site
	 * @param serverConfig
	 * 		reference to choosen server configuration
	 */
	public JCpgUserConfig(String username, String password, JCpgServerConfig serverConfig){
		
		setUsername(username);
		setPassword(password);
		setServerConfig(serverConfig);
		
	}
	
	
	/**
	 * 
	 * Set the userconfig username
	 * 
	 * @param username
	 * 		the userconfig username
	 */
	private void setUsername(String username){
		
		this.username = username;
		
	}
	/**
	 * 
	 * Set the userconfig password
	 * 
	 * @param password
	 * 		the userconfig password
	 */
	private void setPassword(String password){
		
		this.password = password;
		
	}
	/**
	 * 
	 * Set the userconfig server config
	 * 
	 * @param serverConfig
	 * 		the userconfig server config
	 */
	private void setServerConfig(JCpgServerConfig serverConfig){
		
		this.serverConfig = serverConfig;
		
	}
	
	
	
	
	/**
	 * 
	 * Get the userconfig username
	 * 
	 * @return
	 * 		the userconfig username
	 */
	public String getUsername(){
		
		return this.username;
		
	}
	/**
	 * 
	 * Get the userconfig password
	 * 
	 * @return
	 * 		the userconfig password
	 */
	public String getPassword(){
		
		return this.password;
		
	}
	/**
	 * 
	 * Get the userconfig serverconfig
	 * 
	 * @return
	 * 		the userconfig serverconfig
	 */
	public JCpgServerConfig getServerConfig(){
		
		return this.serverConfig;
		
	}

}
