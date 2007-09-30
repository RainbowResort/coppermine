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
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.InputStream;
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
	private String errormsg = "";
	
	
	
	
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
	 * Empty constructor to use the getTagText function where we just want to read the just downloaded svr.xml file
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
	/**
	 * 
	 * Sets the error message returned by the API
	 * 
	 * @param msg
	 * 		the error message returned by the API
	 */
	private void setErrorMessage(String msg){
		
		this.errormsg = msg;
		
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
	 * Get the error message returned by the API
	 * 
	 * @return
	 * 		the error message returned by the API
	 */
	public String getErrorMessage(){
		
		return this.errormsg;
		
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
	
	public int performPhpRequest(String parameters){
		
		System.out.println("DEBUG: " + parameters);
		
		String[] firstsplit = parameters.split("&"); // split so we have the initial command and parameters + value
		
		try {
			
			JCpgHttpPoster httpPoster = new JCpgHttpPoster(getBaseUrl() + "cpgapi/webapi.php");
			
			httpPoster.setParameter("query", firstsplit[0]); // API function we want to use
			
			for(int i=1; i<firstsplit.length; i++){
				
				String[] secondsplit = firstsplit[i].split("="); // extract parameters and add them to the http poster
				
				if(secondsplit.length == 2) // parameter has value
					httpPoster.setParameter(secondsplit[0], secondsplit[1]);
				else if (secondsplit.length == 1) // paramater has no value
					httpPoster.setParameter(secondsplit[0], "");
				
				if(secondsplit[0].equals("filename")) // if we are dealing with a picture, also add a parameter with the contents of the file
					httpPoster.setParameter("_FILE[" + getBytesFromFile(new File(".").getCanonicalPath() + "/" + secondsplit[1]) + "]", "");
				
			}
			
			File delete = new File("svr.xml"); // delete file if it already exists
			if(delete.exists()) delete.delete();
	    	
			BufferedOutputStream out = new BufferedOutputStream(new FileOutputStream("svr.xml"));
			InputStream in = httpPoster.post();
			
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
						
						if(element.getName().equals("messagecode")){ // look if query was succesful or not
							
							if(element.getText().equals("success")){
								
								setErrorMessage("success");
								return 0;
							
							}else{
								
								setErrorMessage(element.getText());
								return -1;
								
							}
							
						}
						
					}
					
					return -1; // unknown answer
					
				} catch (JDOMException e) {
					
					System.out.println("JCpgPhpCommunicator: couldn't get a server response");
					
				}
				
			}
		    
		    return -1;  // unknown answer
			
		} catch (Exception exception) {
			
			System.out.println("JCpgPhpCommunicator: couldn't retrieve server response");
		
		}
		
		return -1; // unknown answer
		
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
		
		File file = new File("svr.xml");
		
		if(file.exists()){
		
			List content = root.getChildren();
			ListIterator it = content.listIterator();
			
			while(it.hasNext()){
				
				Element element = (Element)it.next();
				
				if(element.getName().equals("categorydata")){
					
					List content2 = element.getChildren();
					ListIterator it2 = content2.listIterator();
					
					while(it2.hasNext()){
						
						System.out.println(((Element)it2.next()).getAttributeValue("name"));
						
					}
						
				}
				
			}
			
			return categories; // tag not found, return empty string
			
		}
		
		return categories;
		
	}
	/**
	 * 
	 * Transform a file into bytes so it can be send to the API
	 * 
	 * @param path
	 * 		path of the file
	 * @return
	 * 		row of bytes representing this file
	 */
	private byte getBytesFromFile(String path){
		
		File file = new File(path);

		byte[] b = new byte[(int) file.length()];
		byte result = 0;
		
		try {
			
			int offset = 0;
	        int numRead = 0;
	        
	        FileInputStream fileInputStream = new FileInputStream(file);
	        
	        while (offset < b.length && (numRead=fileInputStream.read(b, offset, b.length-offset)) >= 0) {
	        	
	            offset += numRead;
	            
	        }
			
		} catch (Exception e) {
			
			e.printStackTrace();
			System.out.println("JCpgSyncer: couldn't convert " + path + " into array of bytes");
			
		}
		
		for(int i=0; i<b.length; i++){
			
			result = (byte) (result + b[i]);
			
		}
		
		return result;
		
	}
	
}
