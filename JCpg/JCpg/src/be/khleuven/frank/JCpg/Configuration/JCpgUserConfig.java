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
 * User configuration (username and password for the Coppermine site)
 * 
 * @author    Frank Cleynen
 */
public class JCpgUserConfig {
	
	
																										
																										//*************************************
																										//				VARIABLES	          *
																										//*************************************
	private String username;
	private String password;
	private JCpgServerConfig serverConfig;
	
																										
	
	
	
																										//*************************************
																										//				CONSTRUCTOR	          *
																										//*************************************
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
																										
	
	
	
	
	
	
	
																										//*************************************
																										//				SETTERS					          *
																										//*************************************
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
	
	
																										
																										//*************************************
																										//				GETTERS					          *
																										//*************************************
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
