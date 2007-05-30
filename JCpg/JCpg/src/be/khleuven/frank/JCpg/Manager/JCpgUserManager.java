/*
Copyright (C) 2997  Frank Cleynen
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
import java.io.FileInputStream;
import java.io.ObjectInputStream;
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

import be.khleuven.frank.JCpg.JCpgImageUrlValidator;
import be.khleuven.frank.JCpg.Configuration.JCpgConfig;
import be.khleuven.frank.JCpg.Configuration.JCpgServerConfig;
import be.khleuven.frank.JCpg.Configuration.JCpgUserConfig;
import be.khleuven.frank.JCpg.Sync.JCpgSyncer;
import be.khleuven.frank.JCpg.UI.JCpgUI;

/**
 * 
 * Used to get all the necesarry information about the Coppermine user to login to his/her Coppermine account
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgUserManager extends JDialog {
	
	
	
	
																	
																		//*************************************
																		//				VARIABLES	          *
																		//*************************************
	private JCpgServerConfig serverConfig; // currently selected config in list
	private JCpgServerConfig defaultServerConfig = new JCpgServerConfig("Default", "127.0.0.1", "root", "", "cpg", "cpg1410");
	
	private Dimension screensize;
	private JLabel logo, connectionStatus, username, password, server;
	private JComboBox serverList;
	private JTextField usernameField, passwordField;
	private JButton connect, selectServer, startOffline;
	
	private JCpgUI jCpgInterface;
	
	private int userManagerWidth, userManagerHeight;
	
	private String[] defaultServer = {"ArDelLa", "ardella16", "default"}; // for testing: username, pwd, saved server config name
	
	
	
	
	
																	
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
		
		jCpgInterface.setEnabled(false);
		
		setUserManagerSize(width, height);
		setJCpgInterfaceReference(jCpgInterface);
		
		initComponents();
		boundComponents();
		placeComponents();
		
		addActionListeners();
		
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
		this.setAlwaysOnTop(true);
		this.setUndecorated(true);
		
		screensize = Toolkit.getDefaultToolkit().getScreenSize();
		
		logo = new JLabel(new JCpgImageUrlValidator("data/usermanagerlogo.jpg").createImageIcon(), JLabel.CENTER); // 500x50
		connectionStatus = new JLabel();
		server = new JLabel("Server: ");
		username = new JLabel("Username");
		password = new JLabel("Password");
		
		usernameField = new JTextField();
		usernameField.setText(defaultServer[0]);
		
		serverList = new JComboBox();
		fillServerList(); // read all cfg files in cwd and add to list
		
		passwordField = new JTextField();
		passwordField.setText(defaultServer[1]);
		
		connect = new JButton("Connect");
		selectServer = new JButton("Edit");
		startOffline = new JButton("Offline");
		
	}
	/**
	 * 
	 * Size swing components
	 *
	 */
	private void boundComponents(){
		
		this.setBounds((screensize.width/2)-(getUserManagerWidth()/2), (screensize.height/2)-(getUserManagerHeight()/2), getUserManagerWidth(), getUserManagerHeight());
		
		connectionStatus.setBounds(180, 151, 300, 20);
		
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
		
		getJCpgInterface().addUserConfig(new JCpgUserConfig(usernameField.getText(), passwordField.getText(), (JCpgServerConfig)serverList.getSelectedItem()));
    	JCpgSqlManager sqlManager = new JCpgSqlManager((JCpgServerConfig)serverList.getSelectedItem()); // make new sqlmanager object for connecting
    	
		connectionStatus.setText("Trying to connect to " + ((JCpgServerConfig)serverList.getSelectedItem()).getFullServer());
		
        if(sqlManager.connect() != -1 && !login()){ // connection goes well => go to JCpgInterface
        	
        	getJCpgInterface().changeOnlinemode(true); // we go into online mode
        	
        	getJCpgInterface().addSqlManager(sqlManager);
        	connectionStatus.setText("Connected to " + ((JCpgServerConfig)serverList.getSelectedItem()).getFullServer());
        	getJCpgInterface().addCpgConfig(new JCpgConfig(sqlManager, (JCpgServerConfig)serverList.getSelectedItem())); // Extract the configuration
        	
        	getJCpgInterface().updateScreenInformation(); // show which server we are connected to
        	
        	new JCpgSyncer(getJCpgInterface(), sqlManager).loadGallery(); // load gallery and show contents on screen
        	getJCpgInterface().buildTree();
        	
        	new JCpgSyncer(getJCpgInterface(), sqlManager).extractDatabase(); // look if their maybe more information in the online database to add to the local state
        	
        	getJCpgInterface().setEnabled(true);
        	this.dispose();
        	
        }else{
        	
        	connectionStatus.setText("Unable to connected to " + ((JCpgServerConfig)serverList.getSelectedItem()).getFullServer());
        	
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
			
			new JCpgServerManager(500, 200, getJCpgInterface(), defaultServerConfig, this);
		
		}else{
		
			new JCpgServerManager(500, 200, getJCpgInterface(), (JCpgServerConfig)serverList.getSelectedItem(), this);
			
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
    	
		// only load saved gallery if the root of the gallery tree has one child or more. This indicates the gallery already has been loaded and the user just clicked the sync button
		// in offline mode, which will trigger the usermanager to display so the user can connect.
		// if, at this point, he again clicks the offline button, the gallery will be loaded again and displayed double in the tree. This if-statement resolves that.
		if(((DefaultMutableTreeNode)getJCpgInterface().getTree().getModel().getRoot()).getChildCount() == 0){
			
			JCpgSqlManager sqlManager = new JCpgSqlManager((JCpgServerConfig)serverList.getSelectedItem()); // make new sqlmanager object for connecting
	        connectionStatus.setText("Working offline"); // make clear we are working offline
	        getJCpgInterface().updateScreenInformation("WORKING OFFLINE");
	        
	        new JCpgSyncer(getJCpgInterface(), sqlManager).loadGallery(); // load gallery saved on disk
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
		
		File cwd = new File(".");
		
		String[] files = cwd.list();
		
		File current;
		for(int i=0; i<files.length; i++){
			
			current = new File(files[i]);
			
			if(current.isFile() && files[i].endsWith(".cfg")){
				
				try{
					
					FileInputStream fistream = new FileInputStream(files[i]);
					ObjectInputStream oistream = new ObjectInputStream(fistream);
	
					serverList.addItem((JCpgServerConfig)oistream.readObject());
	
					oistream.close();
					
				}catch(Exception e){
					
					System.out.println("JCpgUserManager: couldn't load " + files[i]);
					e.printStackTrace();
					
				}
				
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
		
		JCpgSqlManager sqlManager = new JCpgSqlManager((JCpgServerConfig)serverList.getSelectedItem()); // make new sqlmanager object for connecting
		sqlManager.connect(); // this is possible because it has just been checked in the connect button event
		
		try {
			
			ResultSet rs_userid = sqlManager.sqlExecute("SELECT * FROM " + getJCpgInterface().getUserConfig().getServerConfig().getPrefix() + "_users WHERE user_active=TRUE AND user_name='" + usernameField.getText() + "' AND user_password='" + getPwdMd5() + "'");
		
			try {
				
				if(rs_userid.next() == false){
					
					return true;
					
				}
				
			} catch (SQLException e) {
				
				e.printStackTrace();
				return false; // no such user
				
			}
			
			return false;
			
		} catch (NoSuchAlgorithmException e) {
			
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
	

}
