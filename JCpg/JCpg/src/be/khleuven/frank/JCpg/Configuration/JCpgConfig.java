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
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import be.khleuven.frank.JCpg.Manager.JCpgSqlManager;

/**
 * 
 * This class contains all the information found in the Cpg _config table.
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgConfig implements Serializable {
	
	
	
																					//*************************************
																					//				VARIABLES	          *
																					//*************************************
	private JCpgSqlManager sqlmanager;
	private JCpgServerConfig serverConfig;
	private ArrayList<String> configEntries = new ArrayList<String>();
	
	
	
	
	
	
																					//*************************************
																					//				CONSTRUCTOR	          *
																					//*************************************
	/**
	 * 
	 * Makes a new JCpgConfig object
	 * 
	 * @param sqlmanager
	 * 		reference to a sql manager
	 * @param serverConfig
	 * 		reference to the current server config
	 */
	public JCpgConfig(JCpgSqlManager sqlmanager, JCpgServerConfig serverConfig){
		
		setSqlManager(sqlmanager);
		setServerConfig(serverConfig);
		getCpgConfiguration();
		
	}
	
	
	
	
	
	
	
																					//*************************************
																					//				SETTERS		          *
																					//*************************************
	/**
	 * 
	 * Set the sql manager
	 * 
	 * @param sqlmanager
	 * 		the sql manager
	 */
	private void setSqlManager(JCpgSqlManager sqlmanager){
		
		this.sqlmanager = sqlmanager;
		
	}
	/**
	 * 
	 * Set the current server config
	 * 
	 * @param serverConfig
	 * 		the current server config
	 */
	private void setServerConfig(JCpgServerConfig serverConfig){
		
		this.serverConfig = serverConfig;
		
	}
	
	
	
	
	
																					
																					//*************************************
																					//				GETTERS		          *
																					//*************************************
	/**
	 * 
	 * Get the sql manager
	 * 
	 * @return
	 * 		the sql manager
	 */
	public JCpgSqlManager getSqlManager(){
		
		return this.sqlmanager;
		
	}
	/**
	 * 
	 * Get the current server config
	 * 
	 * @return
	 * 		the current server config
	 */
	public JCpgServerConfig getServerConfig(){
		
		return this.serverConfig;
		
	}
	/**
	 * 
	 * Get a reference to the arraylist with configuration entries
	 * 
	 * @return
	 * 		a reference to the arraylist with configuration entries
	 */
	public ArrayList<String> getConfigEntries(){
		
		return this.configEntries;
		
	}
	
	/**
	 * 
	 * Extract configuration. Always extracted per pair.
	 *
	 */
	private void getCpgConfiguration(){
		
		String table_config = getServerConfig().getPrefix() + "_config";
		ResultSet rs_config = getSqlManager().sqlExecute("SELECT * FROM " + table_config);
		
		try {
			
			while (rs_config.next()) {
				
				configEntries.add(rs_config.getString("name"));
				configEntries.add(rs_config.getString("value"));
				
			}
			
		} catch (SQLException e) {
			
			System.out.println("JCpgConfig: Couldn't extract from sql query result");
			
		}
		
	}
	/**
	 * 
	 * Give a configuration entry and get the value for it back
	 * 
	 * @param entry
	 * 		a configuration entry
	 * @return
	 * 		the value for this configuration entry
	 */
	public String getValueFor(String entry){
		
		for(int i=0; i<getConfigEntries().size(); i++){
			
			if(entry.equals(getConfigEntries().get(i))){
				
				return getConfigEntries().get(i + 1);
				
			}
			
		}
		
		return "";
		
	}

}
