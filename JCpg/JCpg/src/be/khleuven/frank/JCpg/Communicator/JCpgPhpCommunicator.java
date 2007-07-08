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

package be.khleuven.frank.JCpg.Communicator;

import be.khleuven.frank.JCpg.Configuration.JCpgUserConfig;
import java.io.BufferedOutputStream;
import java.io.File;
import java.io.FileOutputStream;
import java.io.InputStream;
import java.net.URL;
import java.net.URLConnection;
import java.util.List;
import java.util.ListIterator;

import org.jdom.Document;
import org.jdom.Element;
import org.jdom.JDOMException;
import org.jdom.input.SAXBuilder;


/**
 * Does GET and POST HTTP request to generate and receive XML files to / from Nitin's Coppermine API
 * @author    Frank Cleynen
 */
public class JCpgPhpCommunicator {
	
	
	
																	//*************************************
																	//				VARIABLES	          *
																	//*************************************
	private JCpgUserConfig config = null;
	
	
	
	
																	//*************************************
																	//				CONSTRUCTOR	          *
																	//*************************************
	/**
	 * 
	 * Makes a new JCpgPhpCommunicator object
	 * 
	 * @param config
	 * 		reference to the current configuration
	 */
	public JCpgPhpCommunicator(JCpgUserConfig config){
		
		setUserConfig(config);
		
	}
	
	
	
																	
																	//*************************************
																	//				SETTERS		          *
																	//*************************************
	/**
	 * 
	 * Sets the current configuration
	 * 
	 * @param config
	 * 		the current configuration
	 */
	private void setUserConfig(JCpgUserConfig config){
		
		this.config = config;
		
	}
	
																	
	
	
	
																	//*************************************
																	//				GETTERS		          *
																	//*************************************
	/**
	 * 
	 * Get the current configuration
	 * 
	 * @return
	 * 		the current configuration
	 */
	public JCpgUserConfig getConfig(){
		
		return this.config;
		
	}
	
	
	
																	
																	//*************************************
																	//				MUTATORS & OTHERS	  *
																	//*************************************
	/**
	 * 
	 * Get the XML server response
	 * 
	 * @param url
	 * 		URL where the server response can be found
	 * @return
	 * 		true if the server response was collected successfully, else false
	 */
	public boolean performPhpRequest(String url){
		
		try {
			
			File delete = new File("svr.xml"); // delete file if it already exists
			if(delete.exists()) delete.delete();
	    	
			URL responseUrl = new URL(url); // download server xml response
			BufferedOutputStream out = new BufferedOutputStream(new FileOutputStream("svr.xml"));
			URLConnection conn = responseUrl.openConnection();
			InputStream in = conn.getInputStream();
			
			byte[] buffer = new byte[1024];
			int numRead;
			
			while ((numRead = in.read(buffer)) != -1) {
				
				out.write(buffer, 0, numRead);
				
			}

		    out.close();
		    
		    SAXBuilder builder = new SAXBuilder(false); // no validation for illegal xml format
			
			File file = new File("svr.xml");
			
			if(file.exists()){
			
				try {
					
					Document doc = builder.build("svr.xml");
				
					Element respons = doc.getRootElement();
					
					List content = respons.getChildren();
					ListIterator it = content.listIterator();
					
					while(it.hasNext()){
						
						Element element = (Element)it.next();
						
						if(element.getName().equals("messagecode")){
							
							if(element.getText().equals("success")) return true; // if respons is success return true
							
						}
						
					}
					
				} catch (JDOMException e) {
					
					System.out.println("JCpgPhpCommunicator: couldn't get a server response");
					
				}
				
			}
		    
		    return true; // remote response received well
			
		} catch (Exception exception) {
			
			System.out.println("JCpgPhpCommunicator: couldn't retrieve server response");
		
		}
		
		return false;
		
	}
	/**
	 * 
	 * Get the XML server response and return the received xml file
	 * 
	 * @param url
	 * 		URL where the server response can be found
	 * @return
	 * 		true if the server response was collected successfully, else false
	 */
	public File performPhpRequestAndGetXml(String url){
		
		try {
			
			File delete = new File("svr.xml"); // delete file if it already exists
			if(delete.exists()) delete.delete();
	    	
			URL responseUrl = new URL(url); // download server xml response
			BufferedOutputStream out = new BufferedOutputStream(new FileOutputStream("svr.xml"));
			URLConnection conn = responseUrl.openConnection();
			InputStream in = conn.getInputStream();
			
			byte[] buffer = new byte[1024];
			int numRead;
			
			while ((numRead = in.read(buffer)) != -1) {
				
				out.write(buffer, 0, numRead);
				
			}

		    out.close();
		    
		    // check if svr.xml has been made, then return handle
		    File file = new File("svr.xml");
		    
		    if(file.exists()) return file;
			
		} catch (Exception exception) {
			
			System.out.println("JCpgPhpCommunicator: couldn't retrieve server response");
		
		}
		
		return null; // svr.xml was not made
		
	}
	

}
