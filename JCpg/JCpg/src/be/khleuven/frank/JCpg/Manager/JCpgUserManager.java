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
import java.math.BigInteger;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.sql.ResultSet;
import java.sql.SQLException;

import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JDialog;
import javax.swing.JLabel;
import javax.swing.JTextField;
import javax.swing.tree.DefaultMutableTreeNode;

import org.jdom.Document;
import org.jdom.Element;
import org.jdom.JDOMException;
import org.jdom.input.SAXBuilder;
import org.jdom.output.XMLOutputter;

import be.khleuven.frank.JCpg.JCpgImageUrlValidator;
import be.khleuven.frank.JCpg.Configuration.JCpgConfig;
import be.khleuven.frank.JCpg.Configuration.JCpgServerConfig;
import be.khleuven.frank.JCpg.Configuration.JCpgUserConfig;
import be.khleuven.frank.JCpg.Save.JCpgGallerySaver;
import be.khleuven.frank.JCpg.Sync.JCpgSyncer;
import be.khleuven.frank.JCpg.UI.JCpgUI;

/**
 * Used to get all the necesarry information about the Coppermine user to login to his/her Coppermine account
 * @author    Frank Cleynen
 */
public class JCpgUserManager extends JDialog {
	
	
	
	
																	
																		//*************************************
																		//				VARIABLES	          *
																		//*************************************
	private Dimension screensize;
	private JLabel logo;
	private JLabel connectionStatus;
	private JLabel username;
	private JLabel password;
	private JLabel server;
	private JComboBox serverList;
	private JTextField usernameField;
	private JTextField passwordField;
	private JButton connect;
	private JButton selectServer;
	private JButton startOffline;
	
	private JCpgUI jCpgInterface;
	
	private int userManagerWidth, userManagerHeight, userid;
	
	
	
	
	
																	
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
	public JCpgUserManager(int width, int height, JCpgUI jCpgInterface){
		
		super(jCpgInterface); // on top of jCpgInterface
		
		jCpgInterface.setEnabled(false);
		
		setUserManagerSize(width, height);
		setJCpgInterfaceReference(jCpgInterface);
		
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
	 * @param jCpgInterface
	 * 		the JCpgInterface reference to communicate with
	 */
	private void setJCpgInterfaceReference(JCpgUI jCpgInterface){
		
		this.jCpgInterface = jCpgInterface;
		
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
		server = new JLabel("Server: ");
		username = new JLabel("Username");
		password = new JLabel("Password");
		
		usernameField = new JTextField();
		
		serverList = new JComboBox();
		fillServerList(); // read all cfg files in cwd and add to list
		
		passwordField = new JTextField();
		
		connect = new JButton("Connect");
		selectServer = new JButton("Edit");
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
		server.setBounds(70, 60, 100, 20);
		username.setBounds(70, 81, 100, 20);
		password.setBounds(70, 101, 100, 20);
		
		serverList.setBounds(180, 55, 200, 30);
		usernameField.setBounds(180, 81, 200, 20);
		passwordField.setBounds(180, 101, 200, 20);
		
		connect.setBounds(70, 131, 100, 30);
		selectServer.setBounds(390, 51, 100, 30);
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
		this.getContentPane().add(server);
		this.getContentPane().add(serverList);
		this.getContentPane().add(usernameField);
		this.getContentPane().add(passwordField);
		this.getContentPane().add(connect);
		this.getContentPane().add(selectServer);
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
	public JCpgUI getJCpgInterface(){
		
		return this.jCpgInterface;
		
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
		
		selectServer.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				selectServerActionPerformed(evt);
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
	 * 		Try if the connectio succeeds
	 * 		Get current server state
	 * 		Go to UI
	 *
	 */
	private void ConnectActionPerformed(java.awt.event.ActionEvent evt) {
		
		getJCpgInterface().changeUserConfig(new JCpgUserConfig(usernameField.getText(), passwordField.getText(), readServerConfig()));
    	JCpgSqlManager sqlManager = new JCpgSqlManager(readServerConfig()); // make new sqlmanager object for connecting
		
        if(sqlManager.connect() != -1 && login() && serverList.getSelectedItem() != null){ // connection goes well => go to JCpgInterface
        	
        	writeUserConfig();
        	
        	getJCpgInterface().changeOnlinemode(true); // we go into online mode
        	
        	getJCpgInterface().addSqlManager(sqlManager);
        	
        	connectionStatus.setText("Connected to " + (readServerConfig()).getFullServer());
        	
        	getJCpgInterface().addCpgConfig(new JCpgConfig(sqlManager, readServerConfig(), getJCpgInterface().getOnlinemode())); // Extract the configuration
        	
        	new JCpgGallerySaver(getJCpgInterface().getGallery()).loadGallery(); // load gallery and show contents on screen
        	getJCpgInterface().buildTree();
        	
        	new JCpgSyncer(getJCpgInterface(), sqlManager).extractDatabase(); // look if their maybe more information in the online database to add to the local state
        	
        	getJCpgInterface().setEnabled(true);
        	this.dispose();
        	
        }else{
        	
        	connectionStatus.setText("Unable to connected to your online Coppermine Photo Gallery");
        	
        }
		
	}
	/**
	 * 
	 * Perform right actions if the user presses the edit button: 
	 * 		If no configuration exists, use the default one
	 * 		Else edit selected
	 * 
	 */
	private void selectServerActionPerformed(java.awt.event.ActionEvent evt) {
		
		if(serverList.getItemCount() == 0){
			
			new JCpgServerManager(500, 200, getJCpgInterface(), "", this);
		
		}else{
		
			new JCpgServerManager(500, 200, getJCpgInterface(), (String)serverList.getSelectedItem(), this);
			
		}
		
	}
	/**
	 * 
	 * Perform right actions if the user presses the startOffline button: 
	 * 		We don't search the database because we are offline. Instead, we will just read the current state saved on the disk.
	 * 
	 */
	private void startOfflineActionPerformed(java.awt.event.ActionEvent evt) {
		
		getJCpgInterface().changeOnlinemode(false); // we go into offline mode
		
		getJCpgInterface().changeUserConfig(new JCpgUserConfig(usernameField.getText(), passwordField.getText(), readServerConfig()));
		getJCpgInterface().getUserConfig().changeId(this.userid);
		
		JCpgSqlManager sqlManager = new JCpgSqlManager(readServerConfig()); // make new sqlmanager object
		getJCpgInterface().addCpgConfig(new JCpgConfig(sqlManager, readServerConfig(), getJCpgInterface().getOnlinemode())); // Extract the configuration
    	
		// only load saved gallery if the root of the gallery tree has one child or more. This indicates the gallery already has been loaded and the user just clicked the sync button
		// in offline mode, which will trigger the usermanager to display so the user can connect.
		// if, at this point, he again clicks the offline button, the gallery will be loaded again and displayed double in the tree. This if-statement resolves that.
		if(((DefaultMutableTreeNode)getJCpgInterface().getTree().getModel().getRoot()).getChildCount() == 0){
			
	        connectionStatus.setText("Working offline"); // make clear we are working offline
	        
	        new JCpgGallerySaver(getJCpgInterface().getGallery()).loadGallery(); // load gallery and show contents on screen
	        getJCpgInterface().buildTree(); // build the tree with loaded information
	        
		}
		
        getJCpgInterface().setEnabled(true);
        this.dispose();
		
	}
	
	
	
	
	

																		//*************************************
																		//				MUTATORS & OTHERS     *
																		//*************************************
	/**
	 * 
	 * Browse cwd and read all cfg files and put them in the serverList
	 * Will also be called each time a new server is saved or deleted
	 *
	 */
	protected void fillServerList(){
		
		serverList.removeAllItems(); // clear list, then rebuild.
		
		File cwd = new File("config/");

		String[] files = cwd.list();
		
		File current;
		for(int i=0; i<files.length; i++){
			
			current = new File("config/" + files[i]);
			
			if(current.isFile() && files[i].endsWith(".cfg")){
				
				String filename = current.getName();
				
				filename = filename.substring(0, filename.length()-4);
				
				serverList.addItem(filename);
				
			}
			
		}
		
	}
	/**
	 * 
	 * Try logging in with the given username and password
	 * 
	 * @return
	 * 		true if login succeeds, otherwhise false
	 */
	private boolean login(){
		
		JCpgSqlManager sqlManager = new JCpgSqlManager(readServerConfig()); // make new sqlmanager object for connecting
		sqlManager.connect(); // this is possible because it has just been checked in the connect button event
					
		try {
						
			ResultSet rs_userid = sqlManager.sqlExecute("SELECT * FROM " + getJCpgInterface().getUserConfig().getServerConfig().getPrefix() + "users WHERE user_active=TRUE AND user_name='" + usernameField.getText() + "' AND user_password='" + getPwdMd5() + "'");
					
			try {
							
				if(rs_userid.next() == true){
					
					this.userid = rs_userid.getInt("user_id");
					getJCpgInterface().getUserConfig().changeId(rs_userid.getInt("user_id"));
					return true;
								
				}
							
			} catch (SQLException e) {
							
				e.printStackTrace();
				return false; // no such user
							
			}
					
			return false;
						
		} catch (NoSuchAlgorithmException e) {
				
			e.printStackTrace();
			System.out.println("JCpgUserManager: couldn't convert pwd to MD5 equivalent.");
						
		}
					
		return false;

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
	    m.update(passwordField.getText().getBytes(),0,passwordField.getText().length());
	    
	    return new BigInteger(1,m.digest()).toString(16);
	    
	}
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
				
				usernameField.setText(userconfig.getAttribute("username").getValue());
				passwordField.setText(userconfig.getAttribute("password").getValue());
				this.userid = userconfig.getAttribute("id").getIntValue();
				
			} catch (JDOMException e) {
				
				e.printStackTrace();
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
		
		userconfig.setAttribute("username", usernameField.getText());
		userconfig.setAttribute("password", passwordField.getText());
		userconfig.setAttribute("id", this.userid + "");
		
		// write file
		Document doc=new Document(userconfig);
		
		XMLOutputter out = new XMLOutputter();
		
		out.setIndent(true);
		out.setNewlines(true);
		
		try{
			
			FileOutputStream file = new FileOutputStream("config/usercfg.xml");
			
			out.output(doc , file);	
			
		}catch(Exception e){
			
			e.printStackTrace();
			
		}
		
	}
	/**
	 * 
	 * Read all server information from the choosen server config cfg file
	 * 
	 * @return
	 * 		a serverconfig object if a file was read succesfully, else null
	 */
	private JCpgServerConfig readServerConfig(){
		
		if(serverList.getSelectedItem() != null){
			
			SAXBuilder builder = new SAXBuilder(false); // no validation for illegal xml format
			
			File file = new File("config/" + serverList.getSelectedItem() + ".cfg");
			
			if(file.exists()){
			
				try {
					
					Document doc = builder.build("config/" + serverList.getSelectedItem() + ".cfg");
				
					Element userconfig = doc.getRootElement();
					
					JCpgServerConfig serverConfig = new JCpgServerConfig(userconfig.getAttribute("configname").getValue(), userconfig.getAttribute("server").getValue(), userconfig.getAttribute("username").getValue(), userconfig.getAttribute("password").getValue(), userconfig.getAttribute("database").getValue(), userconfig.getAttribute("prefix").getValue());
					
					return serverConfig;
					
				} catch (JDOMException e) {
					
					e.printStackTrace();
					System.out.println("JCpgUserManager: couldn't load server configuration");
					
				}
				
			}else{
				
				connectionStatus.setText("No available server configuration!");
				
				return null;
				
			}
			
			return null;
			
		}
		
		return null;
		
	}
	
}