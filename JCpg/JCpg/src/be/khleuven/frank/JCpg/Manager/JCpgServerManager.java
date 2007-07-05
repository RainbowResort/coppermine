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

import org.jdom.Document;
import org.jdom.Element;
import org.jdom.JDOMException;
import org.jdom.input.SAXBuilder;
import org.jdom.output.XMLOutputter;

import be.khleuven.frank.JCpg.JCpgImageUrlValidator;
import be.khleuven.frank.JCpg.Configuration.JCpgServerConfig;
import be.khleuven.frank.JCpg.UI.JCpgUI;

/**
 * Is responsible for asking all the necesarry info to make a connection to the right sql db and tables
 * @author    Frank Cleynen
 */
public class JCpgServerManager extends JDialog{
	
	
	
																	
																	//*************************************
																	//				VARIABLES	          *
																	//*************************************
	private JCpgServerConfig defaultServerConfig = new JCpgServerConfig("Default", "127.0.0.1", "root", "", "cpg", "cpg1410_");
	
	private Dimension screensize;
	private JLabel logo;
	private JLabel configName;
	private JLabel connectionStatus;
	private JLabel username;
	private JLabel password;
	private JLabel server;
	private JLabel prefix;
	private JLabel database;
	private JTextField configNameField;
	private JTextField usernameField;
	private JTextField passwordField;
	private JTextField prefixField;
	private JTextField databaseField;
	private JTextField serverField;
	private JButton save;
	private JButton delete;
	
	private JCpgUI jCpgInterface;
	private String serverConfig;
	private JCpgUserManager userManager;
	
	private int serverManagerWidth;
	private int serverManagerHeight;
	
	
																	
	
	
	
																	//*************************************
																	//				CONSTRUCTORS          *
																	//*************************************
	/**
	 * 
	 * Makes a new JCpgUserManager object
	 * 
	 * @param width
	 * 		width of the JCpgUserManager screen
	 * @param height
	 * 		height of the JCpgUserManager screen
	 * @param serverConfig
	 * 		name of server config xml file
	 */
	public JCpgServerManager(int width, int height, JCpgUI jCpgInterface, String serverConfig, JCpgUserManager userManager){
		
		super(userManager); // on top of userManager
		
		jCpgInterface.setEnabled(false);
		
		setServerManagerSize(width, height);
		setJCpgInterfaceReference(jCpgInterface);
		setServerConfig(serverConfig);
		setUserManager(userManager);
		
		initComponents();
		boundComponents();
		placeComponents();
		
		readServerConfig();
		
		addActionListeners();
		
	}
	
	
																	
																	//*************************************
																	//				SETTERS		          *
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
	private void setServerManagerSize(int width, int height){
		
		this.serverManagerWidth = width;
		this.serverManagerHeight = height;
		
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
	/**
	 * 
	 * Set the current server configuration
	 * 
	 * @param serverConfig
	 * 		the current server configuration
	 */
	private void setServerConfig(String serverConfig){
		
		this.serverConfig = serverConfig;
		
	}
	/**
	 * 
	 * Set the user manager. Communication between the two windows is needed for updating the server list
	 * 
	 * @param userManager
	 * 		the user manager
	 */
	private void setUserManager(JCpgUserManager userManager){
		
		this.userManager = userManager;
		
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
		
		logo = new JLabel(new JCpgImageUrlValidator("data/servermanagerlogo.jpg").createImageIcon(), JLabel.CENTER); // 500x50
		
		configName = new JLabel("Name");
		connectionStatus = new JLabel();
		prefix = new JLabel("Prefix");
		database = new JLabel("Database");
		username = new JLabel("Username");
		password = new JLabel("Password");
		server = new JLabel("Server");
		
		configNameField = new JTextField();
		usernameField = new JTextField();
		serverField = new JTextField();
		passwordField = new JTextField();
		prefixField = new JTextField();
		databaseField = new JTextField();
		
		save = new JButton("Save");
		delete = new JButton("Delete");
		
	}
	/**
	 * 
	 * Size swing components
	 *
	 */
	private void boundComponents(){
		
		this.setBounds((screensize.width/2)-(getServerManagerWidth()/2), (screensize.height/2)-(getServerManagerHeight()/2), getServerManagerWidth(), getServerManagerHeight());
		
		connectionStatus.setBounds(180, 151, 300, 20);
		
		logo.setBounds(0, 0, 500, 50);
		configName.setBounds(70, 51, 100, 20);
		server.setBounds(70, 71, 100, 20);
		username.setBounds(70, 91, 100, 20);
		password.setBounds(70, 111, 100, 20);
		database.setBounds(70, 131, 100, 20);
		prefix.setBounds(70, 151, 100, 20);
		
		configNameField.setBounds(180, 51, 200, 20);
		serverField.setBounds(180, 71, 200, 20);
		usernameField.setBounds(180, 91, 200, 20);
		passwordField.setBounds(180, 111, 200, 20);
		databaseField.setBounds(180, 131, 200, 20);
		prefixField.setBounds(180, 151, 200, 20);
		
		save.setBounds(70, 171, 100, 30);
		delete.setBounds(180, 171, 100, 30);
		
	}
	/**
	 * 
	 * Place swing components
	 *
	 */
	private void placeComponents(){
		
		this.getContentPane().add(logo);
		this.getContentPane().add(connectionStatus);
		this.getContentPane().add(configName);
		this.getContentPane().add(server);
		this.getContentPane().add(username);
		this.getContentPane().add(password);
		this.getContentPane().add(prefix);
		this.getContentPane().add(database);
		this.getContentPane().add(configNameField);
		this.getContentPane().add(serverField);
		this.getContentPane().add(usernameField);
		this.getContentPane().add(passwordField);
		this.getContentPane().add(prefixField);
		this.getContentPane().add(databaseField);
		this.getContentPane().add(save);
		this.getContentPane().add(delete);
		this.setVisible(true);
		
	}
	
	

																	//*************************************
																	//				GETTERS			      *
																	//*************************************
	
	
	/**
	 * 
	 * Get the manager's frame width
	 * 
	 * @return
	 * 		the manager's frame width
	 * 
	 */
	public int getServerManagerWidth(){
		
		return this.serverManagerWidth;
		
	}
	/**
	 * 
	 * Get the manager's frame height
	 * 
	 * @return
	 * 		the manager's frame height
	 */
	public int getServerManagerHeight(){
		
		return this.serverManagerHeight;
		
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
	 * Get the current server configuration
	 * 
	 * @return
	 * 		the current server configuration
	 */
	public String getServerConfig(){
		
		return this.serverConfig;
		
	}
	/**
	 * 
	 * Get the user manager
	 * 
	 * @return
	 * 		the user manager
	 */
	public JCpgUserManager getUserManager(){
		
		return this.userManager;
		
	}
	
	
	
	
	
	
	
	
	
																
																	//*************************************
																	//				EVENTS			      *
																	//*************************************
	/**
	 * 
	 * Actionlistener for save button
	 * 
	 */
	private void addActionListeners(){
		
		save.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				saveActionPerformed(evt);
			}
		});
		
		delete.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				deleteActionPerformed(evt);
			}
		});
		
	}
	/**
	 * 
	 * Actionlistener implementation for save button:
	 * Save the new server information
	 * 
	 */
	private void saveActionPerformed(java.awt.event.ActionEvent evt) {
		
		saveServerConfig();
		
		getUserManager().fillServerList();
		
		this.dispose();
        
    }
	/**
	 * 
	 * Perform the right actions when the user clicks the delete button
	 * Go through all the files, look for the one with the right name and if the file exists, delete it
	 * 
	 */
	private void deleteActionPerformed(java.awt.event.ActionEvent evt) {
		
		File file = new File("config/" + configNameField.getText() + ".cfg");
		
		if(file.exists()){
			
			file.delete();
		
			emptyDialogFields();
			
			userManager.fillServerList();
			
			this.dispose();
		
		}	
		
    }
	
	
	
	
																
																	//*************************************
																	//				MUTATORS & OTHERS     *
																	//*************************************
	/**
	 * 
	 * Clear all the input fields
	 *
	 */
	private void emptyDialogFields(){
		
		databaseField.setText("");
		serverField.setText("");
		usernameField.setText("");
		passwordField.setText("");
		prefixField.setText("");
		configNameField.setText("");
		
	}
	/**
	 * 
	 * Fill all the textfields with the data found in the given serverConfig object
	 *
	 */
	private void readServerConfig(){
		
		if(!getServerConfig().equals("")){
			
			SAXBuilder builder = new SAXBuilder(false); // no validation for illegal xml format
			
			File file = new File("config/" + getServerConfig() + ".cfg");
			
			if(file.exists()){
			
				try {
					
					Document doc = builder.build("config/" + getServerConfig() + ".cfg");
				
					Element userconfig = doc.getRootElement();
					
					configNameField.setText(userconfig.getAttribute("configname").getValue());
					serverField.setText(userconfig.getAttribute("server").getValue());
					usernameField.setText(userconfig.getAttribute("username").getValue());
					passwordField.setText(userconfig.getAttribute("password").getValue());
					prefixField.setText(userconfig.getAttribute("prefix").getValue());
					databaseField.setText(userconfig.getAttribute("database").getValue());
					
				} catch (JDOMException e) {
					
					e.printStackTrace();
					System.out.println("JCpgServerManager: couldn't load server configuration");
					
				}
				
			}
			
		}else{
			
			configNameField.setText(defaultServerConfig.getConfigName());
			serverField.setText(defaultServerConfig.getServer());
			usernameField.setText(defaultServerConfig.getUsername());
			passwordField.setText(defaultServerConfig.getPwd());
			prefixField.setText(defaultServerConfig.getPrefix());
			databaseField.setText(defaultServerConfig.getDatabase());
			
		}
		
	}
	/**
	 * 
	 * Save the current server configuration as an objectfile
	 *
	 */
	private void saveServerConfig(){
		
		File current = new File("config/" + configNameField.getText() + ".cfg");
		if(current.exists()) current.delete(); // delete of existing
		
		Element serverconfig = new Element("serverconfig");
		
		serverconfig.setAttribute("configname", configNameField.getText());
		serverconfig.setAttribute("server", serverField.getText());
		serverconfig.setAttribute("username", usernameField.getText());
		serverconfig.setAttribute("password", passwordField.getText());
		serverconfig.setAttribute("prefix", prefixField.getText());
		serverconfig.setAttribute("database", databaseField.getText());
		
		// write file
		Document doc=new Document(serverconfig);
		
		XMLOutputter out = new XMLOutputter();
		
		out.setIndent(true);
		out.setNewlines(true);
		
		try{
			
			FileOutputStream file = new FileOutputStream("config/" + configNameField.getText() + ".cfg");
			
			out.output(doc , file);	
			
		}catch(Exception e){
			
			e.printStackTrace();
			
		}
		
	}	

}
