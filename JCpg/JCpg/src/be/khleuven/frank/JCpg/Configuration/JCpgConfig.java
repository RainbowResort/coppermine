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
