package be.khleuven.frank.JCpg;

import java.io.File;
import org.w3c.dom.Document;
import org.w3c.dom.*;

import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.DocumentBuilder;
import org.xml.sax.SAXException;
import org.xml.sax.SAXParseException;

public class ReadAndPrintXMLFile{

public static void main (String argv []){
	
	try {
	
		DocumentBuilderFactory docBuilderFactory = DocumentBuilderFactory.newInstance();
		DocumentBuilder docBuilder = docBuilderFactory.newDocumentBuilder();
		Document doc = docBuilder.parse (new File("config/gallery.xml"));
		
		// normalize text representation
		doc.getDocumentElement ().normalize ();
		System.out.println ("Root element of the doc is " + doc.getDocumentElement().getNodeName());
		
		
		NodeList listOfPersons = doc.getElementsByTagName("gallery");
		int totalPersons = listOfPersons.getLength();
		System.out.println("Total no of people : " + totalPersons);
		
		for(int s=0; s<listOfPersons.getLength() ; s++){
		
		
			Node firstPersonNode = listOfPersons.item(s);
			if(firstPersonNode.getNodeType() == Node.ELEMENT_NODE){
			
			
			Element firstPersonElement = (Element)firstPersonNode; 
			
			//-------
			NodeList firstNameList = firstPersonElement.getElementsByTagName("category");
			Element firstNameElement = (Element)firstNameList.item(0);
			
			NodeList textFNList = firstNameElement.getChildNodes();
			System.out.println("First Name : " + ((Node)textFNList.item(0)).getNodeValue().trim());
			
			//------- 
			NodeList lastNameList = firstPersonElement.getElementsByTagName("album");
			Element lastNameElement = (Element)lastNameList.item(0);
			
			NodeList textLNList = lastNameElement.getChildNodes();
			System.out.println("Last Name : " + ((Node)textLNList.item(0)).getNodeValue().trim());
			
			//----
			NodeList ageList = firstPersonElement.getElementsByTagName("picture");
			Element ageElement = (Element)ageList.item(0);
			
			NodeList textAgeList = ageElement.getChildNodes();
			System.out.println("Age : " + ((Node)textAgeList.item(0)).getNodeValue().trim());
			
			//------
		
		
		}//end of if clause
		
		
		}//end of for loop with s var
		
		
		}catch (SAXParseException err) {
		System.out.println ("** Parsing error" + ", line " + err.getLineNumber () + ", uri " + err.getSystemId ());
		System.out.println(" " + err.getMessage ());
		err.printStackTrace();
		
		}catch (SAXException e) {
		Exception x = e.getException ();
		((x == null) ? e : x).printStackTrace ();
		e.printStackTrace();
		}catch (Throwable t) {
			t.printStackTrace ();
		}
		//System.exit (0);

	}//end of main


}