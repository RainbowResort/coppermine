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
	private String username, password, baseUrl;
	private int id;
	
																										
	
	
	
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
	 * @param baseUrl
	 * 		Coppermine base url
	 */
	public JCpgUserConfig(String username, String password, int id, String baseUrl){
		
		setUsername(username);
		setPassword(password);
		setId(id);
		setBaseUrl(baseUrl);
		
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
	 * Set the user id
	 * 
	 * @param id
	 * 		the user id
	 */
	private void setId(int id){
		
		this.id = id;
		
	}
	/**
	 * 
	 * Set the base url
	 * 
	 * @param serverConfig
	 * 		the base url
	 */
	private void setBaseUrl(String baseUrl){
		
		this.baseUrl = baseUrl;
		
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
	public int getId(){
		
		return this.id; 
		
	}
	/**
	 * 
	 * Get the base url
	 * 
	 * @return
	 * 		the base url
	 */
	public String getBaseUrl(){
		
		return this.baseUrl;
		
	}
	/**
	 * 
	 * Change the current user id
	 * 
	 * @param id
	 * 		the new user id
	 */
	public void changeId(int id){
		
		this.id = id;
		
	}
	
	
	
	
	// TEMP: TO AVOID ERRORS
	public Object getServerConfig(){
		
		return null;
		
	}
	
	
	
	

}
