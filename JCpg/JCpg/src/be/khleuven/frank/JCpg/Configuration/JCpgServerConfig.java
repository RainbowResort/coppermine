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

import java.io.Serializable;
import java.math.BigInteger;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;


/**
 * Server configuration
 * @author    Frank Cleynen
 */
public class JCpgServerConfig implements Serializable{
	
												
	
				
																//*************************************
																//				VARIABLES             *
																//*************************************
	String server = null ;
																//*************************************
																//				VARIABLES             *
																//*************************************
	String username = null ;
																//*************************************
																//				VARIABLES             *
																//*************************************
	String pwd = null ;
																//*************************************
																//				VARIABLES             *
																//*************************************
	String database = null ;
																//*************************************
																//				VARIABLES             *
																//*************************************
	String prefix = null ;
																//*************************************
																//				VARIABLES             *
																//*************************************
	String configName = null ;
	
	
	
	
															
																//*************************************
																//				CONSTRUCTORS          *
																//*************************************
	/**
	 * 
	 * Make a new ServerConfig object
	 * 
	 * @param server
	 * 		the servername
	 * @param username
	 * 		the username
	 * @param pwd
	 * 		the user's password
	 */
	public JCpgServerConfig(String configName, String server, String username, String pwd, String database, String prefix){
		
		setConfigName(configName);
		setUsername(username);
		setPwd(pwd);
		setDatabase(database);
		setServer(server); // must come after setDatabase because the getDatabase() is used in making the complete server string
		setPrefix(prefix);
		
	}
	
	
	
	
	
															
																//*************************************
																//				SETTERS		          *
																//*************************************
	private void setConfigName(String configName){
		
		this.configName = configName;
		
	}
	/**
	 * 
	 * Set the server for this connection
	 * 
	 * @param server
	 * 		the server for this connection
	 */
	private void setServer(String server){
		
		this.server = server;
		
	}
	/**
	 * 
	 * Set the username for this connection
	 * 
	 * @param username
	 * 		the username for this connection
	 */
	private void setUsername(String username){
		
		this.username = username;
		
	}
	/**
	 * 
	 * Set the password for this connection
	 * 
	 * @param pwd
	 * 		the password for this connection
	 */
	private void setPwd(String pwd){
		
		this.pwd = pwd;
		
	}
	/**
	 * 
	 * Set the database for this connection: the databasename where the Cpg tables are stored
	 * 
	 * @param database
	 * 		the database for this connection
	 */
	private void setDatabase(String database){
		
		this.database = database;
		
	}
	/**
	 * 
	 * Set the prefix for this connection: a certain prefix, selected at installation, which is added before each Cpg tablename
	 * 
	 * @param prefix
	 * 		the prefix for this connection
	 */
	private void setPrefix(String prefix){
		
		this.prefix = prefix;
		
	}
	
	
	
															
																//*************************************
																//				GETTERS		          *
																//*************************************
	/**
	 * 
	 * Get the configuration name
	 * 
	 * @return
	 * 		the configuration name
	 */	
	public String getConfigName(){
		
		return this.configName;
		
	}
	/**
	 * 
	 * Get the server for this connection
	 * 
	 * @return
	 * 		the server for this connection
	 */
	public String getServer(){
		
		return this.server;
		
	}
	/**
	 * 
	 * Get the full server string for this connection
	 * 
	 * @return
	 * 		the full server string for this connection
	 */
	public String getFullServer(){
		
		return "jdbc:mysql://" + this.server + ":3306/" + getDatabase();
		
	}
	/**
	 * 
	 * Get the username for ths connection
	 * 
	 * @return
	 * 		the username for ths connection
	 */
	public String getUsername(){
		
		return this.username;
		
	}
	/**
	 * 
	 * Get the password for ths connection (plaintext)
	 * 
	 * @return
	 * 		the password for ths connection
	 */
	public String getPwd(){
		
		return this.pwd;
		
	}
	/**
	 * 
	 * Get the database for ths connection
	 * 
	 * @return
	 * 		the database for ths connection
	 */
	public String getDatabase(){
		
		return this.database;
		
	}
	/**
	 * 
	 * Get the prefix for ths connection
	 * 
	 * @return
	 * 		the prefix for ths connection
	 */
	public String getPrefix(){
		
		return this.prefix;
		
	}
	/**
	 * 
	 * Get the password for ths connection (MD5)
	 * 
	 * @return
	 * 		the password for ths connection
	 */
	public String getPwdMd5() throws NoSuchAlgorithmException{
		
	    MessageDigest m=MessageDigest.getInstance("MD5");
	    m.update(getPwd().getBytes(),0,getPwd().length());
	    
	    return new BigInteger(1,m.digest()).toString(16);
	    
	}
	
	/**
	 * 
	 * Override for the toString methode. Gives back the config name
	 * 
	 */
	public String toString(){
		
		return getConfigName();
		
	}
	
	/**
	 * 
	 * Change the configuration name
	 * 
	 * @param configName
	 * 		the new config name
	 */
	public void changeConfigName(String configName){
		
		setConfigName(configName);
		
	}
	/**
	 * 
	 * Change the servername
	 * 
	 * @param server
	 * 		the new servername
	 */
	public void changeServer(String server){
		
		setServer(server);
		
	}
	/**
	 * 
	 * Change the username
	 * 
	 * @param username
	 * 		the new username
	 */
	public void changeUsername(String username){
		
		setUsername(username);
		
	}
	/**
	 * 
	 * Change the password
	 * 
	 * @param pwd
	 * 		the new password
	 */
	public void changePassword(String pwd){
		
		setPwd(pwd);
		
	}
	/**
	 * 
	 * Change the database
	 * 
	 * @param database
	 * 		the new database
	 */
	public void changeDatabase(String database){
		
		setDatabase(database);
		
	}
	/**
	 * 
	 * Change the prefix
	 * 
	 * @param prefix
	 * 		the new prefix
	 */
	public void changePrefix(String prefix){
		
		setPrefix(prefix);
		
	}
	
}
