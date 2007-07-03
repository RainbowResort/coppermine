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

import java.io.File;
import java.io.FileOutputStream;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
import java.util.ListIterator;

import org.jdom.Document;
import org.jdom.Element;
import org.jdom.JDOMException;
import org.jdom.Text;
import org.jdom.input.SAXBuilder;
import org.jdom.output.XMLOutputter;

import be.khleuven.frank.JCpg.Manager.JCpgSqlManager;

/**
 * This class contains all the information found in the Cpg _config table.
 * 
 * @author    Frank Cleynen
 */
public class JCpgConfig {
	
	
	
																					//*************************************
																					//				VARIABLES	          *
																					//*************************************
	private JCpgSqlManager sqlmanager;
	private JCpgServerConfig serverConfig;
	private ArrayList<String> configEntries = new ArrayList<String>();
	private boolean mode;
	
	
	
	
	
	
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
	 * @param online
	 * 		are we online or offline
	 */
	public JCpgConfig(JCpgSqlManager sqlmanager, JCpgServerConfig serverConfig, boolean online){
		
		setSqlManager(sqlmanager);
		setServerConfig(serverConfig);
		setOnlineMode(online);
		
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
	/**
	 * 
	 * Set the online mode
	 * 
	 * @param mode
	 * 		true = online, false = offline
	 */
	private void setOnlineMode(boolean mode){
		
		this.mode = mode;
		
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
	 * Get online mode
	 * 
	 * @return
	 * 		true if online, else false
	 */
	public boolean getOnlineMode(){
		
		return this.mode;
		
	}
	/**
	 * 
	 * Extract configuration. Always extracted per pair.
	 *
	 */
	private void getCpgConfiguration(){
		
		// if we are online, get the current config
		if(getOnlineMode()){
			File delete = new File("config/config.xml");
			if (delete.exists()) delete.delete();
	
			String table_config = getServerConfig().getPrefix() + "config";
			ResultSet rs_config = getSqlManager().sqlExecute("SELECT * FROM " + table_config);
	
			try {
	
				Element cpgconfig = new Element("cpgconfig");
	
				while (rs_config.next()) {
	
					configEntries.add(rs_config.getString("name"));
					configEntries.add(rs_config.getString("value"));
					
					Element element = new Element(rs_config.getString("name"));
					element.addContent(rs_config.getString("value"));
	
					cpgconfig.addContent(element);
				
				}
	
				// write file
				Document doc = new Document(cpgconfig);
	
				XMLOutputter out = new XMLOutputter();
	
				out.setIndent(true);
				out.setNewlines(true);
				
				// make directory structure for saving pictures
				new File(getValueFor("fullpath") + getValueFor("userpics") + "10001").mkdirs();
	
				try {
	
					FileOutputStream file = new FileOutputStream("config/config.xml");
	
					out.output(doc, file);
	
				} catch (Exception e) {
	
					System.out.println("JCpgConfig: Couldn't save config.xml");
	
				}
	
			} catch (SQLException e) {
	
				System.out.println("JCpgConfig: Couldn't extract from sql query result");
	
			}
			
		}else{ // offline: load config
			
			SAXBuilder builder = new SAXBuilder(false); // no validation for illegal xml format
			
			File file = new File("config/config.xml");
			
			if(file.exists()){
			
				try {
					
					Document doc = builder.build("config/config.xml");
				
					Element cpgconfig = doc.getRootElement();
					
					List content = cpgconfig.getChildren();
					ListIterator it = content.listIterator();
					
					while(it.hasNext()){
						
						Element element = (Element)it.next();
						
						configEntries.add(element.getName());
						
						List elementcontent = element.getContent();
						ListIterator it1 = elementcontent.listIterator();
						
						while (it1.hasNext()){
							
							Object el = it1.next();
							
							configEntries.add(((Text)el).getText());
						
						}
						
					}
					
				} catch (JDOMException e1) {
					
					System.out.println("JCpgUserManager: couldn't load usercfg.xml");
					
				}
				
			}
			
		}
		
	}
	/**
	 * 
	 * Give a configuration entry and get the value for it back
	 * 
	 * @param entry
	 *            a configuration entry
	 * @return the value for this configuration entry
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
