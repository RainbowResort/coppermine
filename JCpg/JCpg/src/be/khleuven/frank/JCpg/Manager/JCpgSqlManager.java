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

package be.khleuven.frank.JCpg.Manager;

import java.io.Serializable;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import be.khleuven.frank.JCpg.Configuration.JCpgServerConfig;



/**
 * 
 * Makes the connections with the sql database, executes queries and gives their results back
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgSqlManager implements Serializable{
	
	
	
																			
																				//*************************************
																				//				VARIABLES             *
																				//*************************************
	JCpgServerConfig serverConfig = null;
	Connection connection = null;
	
	
	
	
	
																			
																				//*************************************
																				//				CONSTRUCTORS          *
																				//*************************************
	/**
	 * 
	 * Makes a new SqlManager object
	 * 
	 * @param serverConfig	
	 * 		the ServerConfig object, with all the necesarry info to make the connections
	 */
	public JCpgSqlManager(JCpgServerConfig serverConfig){
		
		setServerConfig(serverConfig);
		
	}
	
	
	
	
																			
																				//*************************************
																				//				SETTERS		          *
																				//*************************************
	/**
	 * 
	 * Set the serverConfig reference
	 * 
	 * @param serverConfig
	 * `	the serverConfig reference	
	 */
	private void setServerConfig(JCpgServerConfig serverConfig){
		
		this.serverConfig = serverConfig;
		
	}
	/**
	 * 
	 * Set the connection reference
	 * 
	 * @param connection
	 * 		the connection reference
	 */
	private void setConnection(Connection connection){
		
		this.connection = connection;
		
	}
	
	
	
	
																			
	
	
	
	
	
																				//*************************************
																				//				GETTERS		          *
																				//*************************************
	/**
	 * 
	 * Get the serverConfig reference
	 * 
	 * @return
	 * 		the serverConfig reference
	 */
	public Connection getConnection(){
		
		return connection;
		
	}
	
	
	

	
	
	
	
	
																			
																				//*************************************
																				//				MUTATORS & OTHERS     *
																				//*************************************
	/**
	 * 
	 * Try to make a connection to the database. This connection can then later be used to execute sql queries
	 * 
	 * @return
	 */
	public int connect(){
		
		try {
			
			Class.forName("org.gjt.mm.mysql.Driver").newInstance();
			Connection connection = DriverManager.getConnection(serverConfig.getFullServer(), serverConfig.getUsername(), serverConfig.getPwd());
			setConnection(connection);
			
		} catch (Exception e) {
			
			System.out.println("SqlManager: couldn't connect to sql server.");
			return -1;
			
		}
		
		return 0;
		
	}
	/**
	 * 
	 * Execute a sql query and give back the resultset
	 * 
	 * @param query
	 * 		the sql query
	 * @return
	 * 		the resulting resultset
	 */
	public ResultSet sqlExecute(String query){
		
		try {
			
			if(!query.equals("")){ // only execute when sql query isn't empty
				
				System.out.println(query); 								// DEBUG
				Statement s = getConnection().createStatement();
				
				if(query.startsWith("INSERT") || query.startsWith("UPDATE") || query.startsWith("DELETE")){
					
					s.executeUpdate(query);
					
				}else{ // SELECT FROM
					
					ResultSet rs = s.executeQuery(query);
					return rs;
					
				}

			}
			
			return null;
			
		} catch (SQLException e) {
			
			System.out.println("SqlManager: couldn't execute sql query: " + query);
			
		}
		
		return null;
		
	}

}
