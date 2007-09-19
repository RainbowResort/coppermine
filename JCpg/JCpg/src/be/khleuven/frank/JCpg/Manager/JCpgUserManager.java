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

import java.awt.Dimension;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;
import java.io.FileOutputStream;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JLabel;
import javax.swing.JTextField;
import javax.swing.tree.DefaultMutableTreeNode;

import org.jdom.Document;
import org.jdom.Element;
import org.jdom.JDOMException;
import org.jdom.input.SAXBuilder;
import org.jdom.output.XMLOutputter;

import be.khleuven.frank.Error.JCpgErrorHandler;
import be.khleuven.frank.JCpg.JCpgImageUrlValidator;
import be.khleuven.frank.JCpg.Communicator.JCpgPhpCommunicator;
import be.khleuven.frank.JCpg.Configuration.JCpgConfig;
import be.khleuven.frank.JCpg.Configuration.JCpgSiteConfig;
import be.khleuven.frank.JCpg.Configuration.JCpgUserConfig;
import be.khleuven.frank.JCpg.Save.JCpgGallerySaver;
import be.khleuven.frank.JCpg.UI.JCpgUI;

/**
 * Used to get all the necesarry information about the Coppermine user to login to his/her Coppermine account
 * @author    Frank Cleynen
 */
public class JCpgUserManager extends JDialog {
	
	
	
	
																	
																		//*************************************
																		//				VARIABLES	          *
																		//*************************************
	private static final long serialVersionUID = 1L;
	
	private Dimension screensize;
	
	private JLabel logo;
	private JLabel connectionStatus;
	private JLabel username;
	private JLabel password;
	private JLabel baseurl;
	
	private JTextField baseurlField;
	private JTextField usernameField;
	private JTextField passwordField;
	
	private JButton connect;
	private JButton startOffline;
	
	private JCpgUI ui;
	
	private int userManagerWidth, userManagerHeight, userid;
	private String sessionkey = "";
	
	
	
	
	
																	
																		//*************************************
																		//				CONSTRUCTOR           *
																		//*************************************
	/**
	 * 
	 * Makes a new JCpgUserManager object
	 * 
	 * @param width
	 * 		width of the JDialog
	 * @param height
	 * 		height of JDialog
	 * @param jCpgInterface
	 * 		reference to UI
	 */
	public JCpgUserManager(int width, int height, JCpgUI ui){
		
		super(ui); // on top of jCpgInterface
		
		ui.setEnabled(false);
		
		setUserManagerSize(width, height);
		setUi(ui);
		
		initComponents();
		boundComponents();
		placeComponents();
		
		addActionListeners();
		
		readUserconfig();
		
	}
	
	
	
	
																	
																		//*************************************
																		//				SETTERS	              *
																		//*************************************
	/**
	 * 
	 * Set the dimension of the manager's window
	 * 
	 * @param width
	 * 		the width of the window
	 * @param height
	 * 		the height of the window
	 */							
	private void setUserManagerSize(int width, int height){
		
		this.userManagerWidth = width;
		this.userManagerHeight = height;
		
	}
	/**
	 * 
	 * Set the reference to the JCpgInterface object for communication between both frames
	 * 
	 * @param ui
	 * 		the JCpgInterface reference to communicate with
	 */
	private void setUi(JCpgUI ui){
		
		this.ui = ui;
		
	}
	/**
	 * 
	 * Set the user id
	 * 
	 * @param id
	 * 		the user id
	 */
	private void setId(int id){
		
		this.userid = id;
		
	}
	/**
	 * 
	 * Set the sessionkey
	 * 
	 * @param sessionkey
	 * 		the sessionkey
	 */
	private void setSessionkey(String sessionkey){
		
		this.sessionkey = sessionkey;
		
	}

	
	
	
	
	
																	
																		//*************************************
																		//				SWING	              *
																		//*************************************
	/**
	* 
	* Init swing components
	* 
	*/
	private void initComponents(){
		
		this.setLayout(null);
		this.setUndecorated(true);
		
		screensize = Toolkit.getDefaultToolkit().getScreenSize();
		
		logo = new JLabel(new JCpgImageUrlValidator("data/usermanagerlogo.jpg").createImageIcon(), JLabel.CENTER); // 500x50
		connectionStatus = new JLabel();
		
		baseurl = new JLabel("Base URL: ");
		username = new JLabel("Username");
		password = new JLabel("Password");
		
		baseurlField = new JTextField();
		usernameField = new JTextField();
		passwordField = new JTextField();
		
		connect = new JButton("Connect");
		startOffline = new JButton("Offline");
		
		// make the offline button inactive if there is no local cpg config xml file
		File file = new File("config/config.xml");
		
		if(!file.exists()) {
			
			startOffline.setEnabled(false);
			connectionStatus.setText("No local configuration. You need to connect first.");
			
		}
		
	}
	/**
	 * 
	 * Size swing components
	 *
	 */
	private void boundComponents(){
		
		this.setBounds((screensize.width/2)-(getUserManagerWidth()/2), (screensize.height/2)-(getUserManagerHeight()/2), getUserManagerWidth(), getUserManagerHeight());
		
		connectionStatus.setBounds(75, 160, 500, 20);
		
		logo.setBounds(0, 0, 500, 50);
		baseurl.setBounds(70, 60, 100, 20);
		username.setBounds(70, 81, 100, 20);
		password.setBounds(70, 101, 100, 20);
		
		baseurlField.setBounds(180, 61, 200, 20);
		usernameField.setBounds(180, 81, 200, 20);
		passwordField.setBounds(180, 101, 200, 20);
		
		connect.setBounds(70, 131, 100, 30);
		startOffline.setBounds(180, 131, 100, 30);
		
	}
	/**
	 * 
	 * Place swing components
	 *
	 */
	private void placeComponents(){
		
		this.getContentPane().add(logo);
		this.getContentPane().add(connectionStatus);
		this.getContentPane().add(username);
		this.getContentPane().add(password);
		this.getContentPane().add(baseurl);
		this.getContentPane().add(baseurlField);
		this.getContentPane().add(usernameField);
		this.getContentPane().add(passwordField);
		this.getContentPane().add(connect);
		this.getContentPane().add(startOffline);
		this.setVisible(true);
		
	}
	
	
	
	
	
	
																	
																		//*************************************
																		//				GETTERS	              *
																		//*************************************
	/**
	 * 
	 * Get the manager's frame width
	 * 
	 * @return
	 * 		the manager's frame width
	 * 
	 */
	public int getUserManagerWidth(){
		
		return this.userManagerWidth;
		
	}
	/**
	 * 
	 * Get the manager's frame height
	 * 
	 * @return
	 * 		the manager's frame height
	 */
	public int getUserManagerHeight(){
		
		return this.userManagerHeight;
		
	}
	/**
	 * 
	 * Get the reference to the JCpgInterface object
	 * 
	 * @return
	 * 		the reference to the JCpgInterface object
	 */
	public JCpgUI getUi(){
		
		return this.ui;
		
	}
	/**
	 * 
	 * Get the username
	 * 
	 * @return
	 * 		the username
	 */
	public String getUsername(){
		
		return this.usernameField.getText();
		
	}
	/**
	 * 
	 * Get the password
	 * 
	 * @return
	 * 		the password
	 */
	public String getPassword(){
		
		return this.passwordField.getText();
		
	}
	/**
	 * 
	 * Get the user id
	 * 
	 * @return
	 * 		the user id
	 */
	public int getId(){
		
		return this.userid;
		
	}
	/**
	 * 
	 * Get the sessionkey
	 * 
	 * @return
	 * 		the sessionkey
	 */
	public String getSessionkey(){
		
		return this.sessionkey;
		
	}
	
	
	
	
	
	
																	
																		//*************************************
																		//				EVENTS	              *
																		//*************************************
	/**
	 * 
	 * Add action listeners
	 * 
	 */
	private void addActionListeners(){
		
		connect.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				ConnectActionPerformed(evt);
			}
		});
		
		startOffline.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				startOfflineActionPerformed(evt);
			}
		});
		
	}
	/**
	 * 
	 * Perform right actions if the user presses the connect button: 
	 * 		Try if the connection succeeds
	 * 		Get current server state
	 * 		Go to UI
	 *
	 */
	private void ConnectActionPerformed(java.awt.event.ActionEvent evt) {
		
		connectionStatus.setText(""); // reset connection status msg
		
		String baseUrl = "", parameters = "";
		
		if(!baseurlField.getText().equals("")){ // we must have a base url at least
			
			if(!baseurlField.getText().endsWith("/")){
				
				baseUrl = baseurlField.getText() + "/"; // it must and with a / or the url will not be correctly built
				
			}else{
				
				baseUrl = baseurlField.getText();
				
			}
			
			JCpgPhpCommunicator phpCommunicator = new JCpgPhpCommunicator(baseUrl); // make a phpCommunicator object to talk with the API
			
			parameters = "login&username=" + usernameField.getText() + "&password=" + passwordField.getText();
			
			if(phpCommunicator.performPhpRequest(parameters) == 0){ // login ok
				
				getUi().changeOnlinemode(true); // we go into online mode
				
				writeUserConfig();
				
				JCpgUserConfig userConfig = new JCpgUserConfig(usernameField.getText(), passwordField.getText(), this.userid, baseurlField.getText(), phpCommunicator.getXmlTagText("userdata", "sessionkey")); // build user and site config, then put in global JCpg config
				JCpgSiteConfig siteConfig = new JCpgSiteConfig(baseurlField.getText(), true);
				
				JCpgConfig cpgConfig = new JCpgConfig(userConfig, siteConfig);
				
				getUi().changeCpgConfig(cpgConfig); // pass this config to te UI
				
				connectionStatus.setText("Login successful");
				
				new JCpgGallerySaver(getUi().getGallery(), getUi().getCpgConfig().getUserConfig().getId()).loadGallery(); // load gallery and show contents on screen
				getUi().buildTree();
	        	
	        	new JCpgGallerySaver(getUi().getGallery(), getUi().getCpgConfig().getUserConfig().getId()).loadDeleteParameters(getUi());
	        	
	    		// check if user galleries category must be added, this is only necesarry if the user's gallery xml file does not exist
	        	String gallerypath = "config/" + 1000 + getUi().getCpgConfig().getUserConfig().getId() + "_gallery.xml";
	        	
	        	File galleryxml = new File(gallerypath);
	    		
	    		if(!galleryxml.exists()){
	    			
	    			getUi().getRoot().add(new DefaultMutableTreeNode(getUi().getUserGalleries()));
	    			
	    			getUi().getGallery().addCategory(getUi().getUserGalleries());
	    			
	    		}
	        	
	    		getUi().setEnabled(true);
	        	this.dispose();
				
			}else{ // login failed
				
				new JCpgErrorHandler().addLogEntry(phpCommunicator.getErrorMessage());
				connectionStatus.setText("Wrong username / password / not active");
				
			}

		}else{ // no base url
			
			connectionStatus.setText("A base url like http://www.mycopperminesite.com/ is needed.");
			
		}
		
	}
	/**
	 * 
	 * Perform right actions if the user presses the startOffline button: 
	 * 		We don't search the database because we are offline. Instead, we will just read the current state saved on the disk.
	 * 
	 */
	private void startOfflineActionPerformed(java.awt.event.ActionEvent evt) {
		
		getUi().changeOnlinemode(false); // we go into offline mode
		
		JCpgUserConfig userConfig = new JCpgUserConfig(usernameField.getText(), passwordField.getText(), getId(), baseurlField.getText(), getSessionkey()); // build user and site config, then put in global JCpg config
		JCpgSiteConfig siteConfig = new JCpgSiteConfig(baseurlField.getText(), false);
		
		JCpgConfig cpgConfig = new JCpgConfig(userConfig, siteConfig);
		
		getUi().changeCpgConfig(cpgConfig);
		
		// only load saved gallery if the root of the gallery tree has one child or more. This indicates the gallery already has been loaded and the user just clicked the sync button
		// in offline mode, which will trigger the usermanager to display so the user can connect.
		// if, at this point, he again clicks the offline button, the gallery will be loaded again and displayed double in the tree. This if-statement resolves that.
		if(((DefaultMutableTreeNode)getUi().getTree().getModel().getRoot()).getChildCount() == 0){
			
	        connectionStatus.setText("Working offline"); // make clear we are working offline
	        
	        new JCpgGallerySaver(getUi().getGallery(), getUi().getCpgConfig().getUserConfig().getId()).loadGallery(); // load gallery and show contents on screen
	        getUi().buildTree(); // build the tree with loaded information
	        
	        new JCpgGallerySaver(getUi().getGallery(), getUi().getCpgConfig().getUserConfig().getId()).loadDeleteParameters(getUi());
	        
	        // check if user galleries category must be added, this is only necesarry if the user's gallery xml file does not exist
        	String gallerypath = "config/" + 1000 + getUi().getCpgConfig().getUserConfig().getId() + "_gallery.xml";
        	
        	File galleryxml = new File(gallerypath);
    		
    		if(!galleryxml.exists()){
    			
    			getUi().getRoot().add(new DefaultMutableTreeNode(getUi().getUserGalleries()));
    			
    			getUi().getGallery().addCategory(getUi().getUserGalleries());
    			
    		}
	        
		}
		
        getUi().setEnabled(true);
        this.dispose();
		
	}
	
	
	
	
	

																		//*************************************
																		//				MUTATORS & OTHERS     *
																		//*************************************
	/**
	 * 
	 * Read the userfg.xml file and extract all stored userinformation
	 *
	 */
	private void readUserconfig(){
		
		SAXBuilder builder = new SAXBuilder(false); // no validation for illegal xml format
		
		File file = new File("config/usercfg.xml");
		
		if(file.exists()){
		
			try {
				
				Document doc = builder.build("config/usercfg.xml");
			
				Element userconfig = doc.getRootElement();
				
				baseurlField.setText(userconfig.getAttribute("baseurl").getValue());
				usernameField.setText(userconfig.getAttribute("username").getValue());
				passwordField.setText(userconfig.getAttribute("password").getValue());
				setId(userconfig.getAttribute("id").getIntValue());
				setSessionkey(userconfig.getAttribute("sessionkey").getValue());
				
			} catch (JDOMException e) {
				
				System.out.println("JCpgUserManager: couldn't load usercfg.xml");
				
			}
			
		}
		
	}
	/**
	 * 
	 * Write all user information to usercfg.xml
	 *
	 */
	private void writeUserConfig(){
		
		Element userconfig = new Element("userconfig");
		
		userconfig.setAttribute("baseurl", baseurlField.getText());
		userconfig.setAttribute("username", usernameField.getText());
		userconfig.setAttribute("password", passwordField.getText());
		userconfig.setAttribute("id", new JCpgPhpCommunicator().getXmlTagText("userdata", "user_id"));
		userconfig.setAttribute("sessionkey", new JCpgPhpCommunicator().getXmlTagText("userdata", "sessionkey"));
		
		// write file
		Document doc=new Document(userconfig);
		
		XMLOutputter out = new XMLOutputter();
		
		out.setIndent(true);
		out.setNewlines(true);
		
		try{
			
			FileOutputStream file = new FileOutputStream("config/usercfg.xml");
			
			out.output(doc, file);	
			
		}catch(Exception e){
			
			System.out.println("JCpgUserManager: couldn't save user configuration");
			
		}
		
	}

}