package be.khleuven.frank.JCpg.Configuration;

/**
 * 
 * This is the global JCpg configuration which holds the user config and the Coppermine site config
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgConfig {
	
	
	private JCpgUserConfig userConfig = null;
	private JCpgSiteConfig siteConfig = null;
	
	
	
	/**
	 * 
	 * Makes a new JCpgConfig object
	 * 
	 * @param userConfig
	 * 		the user configuration
	 * @param siteConfig
	 * 		the site configuration
	 */
	public JCpgConfig(JCpgUserConfig userConfig, JCpgSiteConfig siteConfig){
		
		setUserConfig(userConfig);
		setSiteConfig(siteConfig);
		
	}
	
	
	/**
	 * 
	 * Set the user configuration
	 * 
	 * @param userConfig
	 * 		the user configuration
	 */
	private void setUserConfig(JCpgUserConfig userConfig){
		
		this.userConfig = userConfig;
		
	}
	/**
	 * 
	 * Set the site confuguration
	 * 
	 * @param siteConfig
	 * 		the site confuguration
	 */
	private void setSiteConfig(JCpgSiteConfig siteConfig){
		
		this.siteConfig = siteConfig;
		
	}
	
	
	/**
	 * 
	 * Get the user configuration
	 * 
	 * @return
	 * 		the user configuration
	 */
	public JCpgUserConfig getUserConfig(){
		
		return this.userConfig;
		
	}
	/**
	 * 
	 * Get the site configuration
	 * 
	 * @return
	 * 		the site configuration
	 */
	public JCpgSiteConfig getSiteConfig(){
		
		return this.siteConfig;
		
	}

}
