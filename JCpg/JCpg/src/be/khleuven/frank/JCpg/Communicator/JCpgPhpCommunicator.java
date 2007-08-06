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

import java.io.BufferedOutputStream;
import java.io.File;
import java.io.FileOutputStream;
import java.io.InputStream;
import java.net.URL;
import java.net.URLConnection;
import java.util.ArrayList;
import java.util.List;
import java.util.ListIterator;

import org.jdom.Document;
import org.jdom.Element;
import org.jdom.JDOMException;
import org.jdom.input.SAXBuilder;

import be.khleuven.frank.JCpg.Components.JCpgCategory;


/**
 * Does GET and POST HTTP request to generate and receive XML files to / from Nitin's Coppermine API
 * @author    Frank Cleynen
 */
public class JCpgPhpCommunicator {
	
	
	
																	//*************************************
																	//				VARIABLES	          *
																	//*************************************
	private String baseUrl = "";
	private ArrayList<JCpgCategory> categories = new ArrayList<JCpgCategory>();
	
	
	
	
																	//*************************************
																	//				CONSTRUCTOR	          *
																	//*************************************
	/**
	 * 
	 * Makes a new JCpgPhpCommunicator object
	 * 
	 * @param String baseUrl
	 * 		base Coppermine url (e.g. http://www.mycopperminesite.com/
	 */
	public JCpgPhpCommunicator(String baseUrl){
		
		setBaseUrl(baseUrl);
		
	}
	/**
	 * 
	 * Empty constructor to use the getTagText function where we just want to read to just downloaded svr.xml file
	 *
	 */
	public JCpgPhpCommunicator(){
		
		
	}
	
	
	
																	
																	//*************************************
																	//				SETTERS		          *
																	//*************************************
	/**
	 * 
	 * Sets the base url
	 * 
	 * @param baseUrl
	 * 		the base url
	 */
	private void setBaseUrl(String baseUrl){
		
		this.baseUrl = baseUrl;
		
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
	
	
	
																	
																	//*************************************
																	//				MUTATORS & OTHERS	  *
																	//*************************************
	/**
	 * 
	 * Get the XML server response
	 * 
	 * @param parameters
	 * 		parameters that need to be added to the base url
	 * @return
	 * 		true if the server response was collected successfully, else false
	 */
	
	public boolean performPhpRequest(String parameters){
		
		System.out.println("DEBUG: " + parameters);
		
		try {
			
			File delete = new File("svr.xml"); // delete file if it already exists
			if(delete.exists()) delete.delete();
			
			String url = getBaseUrl() + "cpgapi/webapi.php?query=" + parameters;
	    	
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
					
					return false;
					
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
	 * @param parameters
	 * 		parameters that need to be added to the base url
	 * @return
	 * 		true if the server response was collected successfully, else false
	 */
	public File performPhpRequestAndGetXml(String parameters){
		
		System.out.println("DEBUG: " + parameters);
		
		try {
			
			File delete = new File("svr.xml"); // delete file if it already exists
			if(delete.exists()) delete.delete();
			
			String url = getBaseUrl() + "cpgapi/webapi.php?query=" + parameters;
	    	
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
			
			System.out.println("JCpgPhpCommunicator: couldn't process server respons xml file");
		
		}
		
		return null; // svr.xml was not made
		
	}
	/**
	 * 
	 * Get the value from a certain tag
	 * 
	 * @param parent
	 * 		the parent tag
	 * @param tag
	 * 		the tag to search
	 * @return
	 * 		return the value if the tag is found, else an empty string is returned
	 */
	public String getXmlTagText(String parent, String tag){
		
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
					
					if(element.getName().equals(parent)){
						
						List content2 = element.getChildren();
						ListIterator it2 = content2.listIterator();
						
						while(it2.hasNext()){
							
							Element element2 = (Element)it2.next();
							
							if(element2.getName().equals(tag)){
								
								return element2.getText();
								
							}
							
						}
						
					}
					
				}
				
				return ""; // tag not found, return empty string
				
			} catch (JDOMException e) {
				
				System.out.println("JCpgPhpCommunicator: couldn't process server respons xml file");
				
			}
			
		}
		
		return "";
		
	}
	/**
	 * 
	 * Get the value from a certain tag
	 *
	 * @return
	 * 		return a list of categorie objects
	 */
	public ArrayList<JCpgCategory> getCategories(Element root){
		
	    SAXBuilder builder = new SAXBuilder(false); // no validation for illegal xml format
		
		File file = new File("svr.xml");
		
		if(file.exists()){
		
			List content = root.getChildren();
			ListIterator it = content.listIterator();
			
			while(it.hasNext()){
				
				Element element = (Element)it.next();
				
				if(element.getName().equals("categorydata")){
					
					List content2 = element.getChildren();
					ListIterator it2 = content2.listIterator();
						
						/*
						int cid = new Integer(((Element)it2.next()).getText());
						int ownerid = new Integer(((Element)it2.next()).getText());
						String name = ((Element)it2.next()).getText();
						String description = ((Element)it2.next()).getText();
						int parent = new Integer(((Element)it2.next()).getText());
						int pos = new Integer(((Element)it2.next()).getText());
						int thumb = new Integer(((Element)it2.next()).getText());
						
						JCpgCategory category = new JCpgCategory(cid, ownerid, name, description, parent, pos, thumb);
						
						categories.add(category);
						
						System.out.println(element.getName());
						
						getCategories(element);
						*/
					
					System.out.println(((Element)it2.next()).getName());
						
				}
				
			}
			
			return categories; // tag not found, return empty string
			
		}
		
		return categories;
		
	}
	
}
