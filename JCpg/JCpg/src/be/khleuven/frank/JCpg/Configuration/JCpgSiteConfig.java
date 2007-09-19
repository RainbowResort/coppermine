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
import java.util.ArrayList;
import java.util.List;
import java.util.ListIterator;

import org.jdom.Document;
import org.jdom.Element;
import org.jdom.JDOMException;
import org.jdom.Text;
import org.jdom.input.SAXBuilder;
import org.jdom.output.XMLOutputter;

import be.khleuven.frank.Error.JCpgErrorHandler;
import be.khleuven.frank.JCpg.Communicator.JCpgPhpCommunicator;

/**
 * This class contains all the information found in the Cpg _config table.
 * 
 * @author    Frank Cleynen
 */
public class JCpgSiteConfig {
	
	
	
																					//*************************************
																					//				VARIABLES	          *
																					//*************************************
	private ArrayList<String> configEntries = new ArrayList<String>();
	private String baseUrl = "";
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
	public JCpgSiteConfig(String baseUrl, boolean online){
		
		setBaseUrl(baseUrl);
		setOnlineMode(online);
		
		getCpgConfiguration();
		
	}
	
	
	
	
	
	
	
																					//*************************************
																					//				SETTERS		          *
																					//*************************************
	/**
	 * 
	 * Set the base url
	 * 
	 * @param baseUrl
	 * 		the base url
	 */
	private void setBaseUrl(String baseUrl){
		
		this.baseUrl = baseUrl;
		
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
			
			File delete = new File("svr.xml"); // delete previous server respons
			if (delete.exists()) delete.delete();
	
			JCpgPhpCommunicator phpCommunicator = new JCpgPhpCommunicator(getBaseUrl()); // get the Cpg config
			
			if(phpCommunicator.performPhpRequest("getconfig") == 0){ // respons ok
				
				File file = new File("svr.xml");
				
				if(file.exists()){
					
					delete = new File("config/config.xml"); // delete old configuration file
					if (delete.exists()) delete.delete();
					
					SAXBuilder builder = new SAXBuilder(false); // no validation for illegal xml format
					
					try {
						
						Document input = builder.build("svr.xml");
					
						Element cpgconfig = input.getRootElement();
						Element cpgconfigout = new Element("cpgconfig");
						
						List content = cpgconfig.getChildren();
						ListIterator it = content.listIterator(); // catalog tag
						
						while(it.hasNext()){
							
							Element element = (Element)it.next();
							
							if(element.getName().equals("config")){
								
								List content2 = element.getChildren();
								ListIterator it2 = content2.listIterator();
								
								while(it2.hasNext()){
									
									Element element2 = (Element)it2.next();
									
									getConfigEntries().add(element2.getName());
									getConfigEntries().add(element2.getText());
									
									Element elementout = new Element(element2.getName());
									elementout.addContent(element2.getText());
									
									cpgconfigout.addContent(elementout);
									
								}
								
								// write file
								Document doc=new Document(cpgconfigout);
								
								XMLOutputter out = new XMLOutputter();
								
								out.setIndent(true);
								out.setNewlines(true);
								
								try{
									
									FileOutputStream output = new FileOutputStream("config/config.xml");
									
									out.output(doc, output);	
									
								}catch(Exception e){
									
									System.out.println("JCpgSiteConfig: couldn't save site configuration");
									
								}
								
							}
							
						}
						
					} catch (JDOMException e) {
						
						System.out.println("JCpgUserManager: couldn't load usercfg.xml");
						
					}
					
				}
				
			}else{ // respons not ok
				
				new JCpgErrorHandler().addLogEntry(phpCommunicator.getErrorMessage());
				System.out.println("JCpgSiteConfig: unable to retrieve the Coppermine configuration");
				
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
					
				} catch (JDOMException e) {
					
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
