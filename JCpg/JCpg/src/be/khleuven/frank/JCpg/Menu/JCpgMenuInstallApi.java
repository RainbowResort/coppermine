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

package be.khleuven.frank.JCpg.Menu;

import java.awt.Dimension;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JTextField;

import be.khleuven.frank.Error.JCpgErrorHandler;
import be.khleuven.frank.JCpg.JCpgImageUrlValidator;
import be.khleuven.frank.JCpg.Communicator.JCpgPhpCommunicator;
import be.khleuven.frank.JCpg.UI.JCpgUI;

/**
 * 
 * Shows a screen from which the user can install the Coppermine API
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgMenuInstallApi extends JDialog {
	
	
	
														//*************************************
														//				VARIABLES             *
														//*************************************
	private static final long serialVersionUID = 1L;
	
	private JCpgUI ui;
	private Dimension screensize;
	
	private JButton close, install;
	
	private JLabel logo, msg, dbserver, dbuser, dbpass, dbname, prefix, adminusername, adminpassword, adminemail;

	private JTextField dbserverField, dbuserField, dbpassField, dbnameField, prefixField, adminusernameField, adminpasswordField, adminemailField;
	
	
	
	
	
	
	
	
	
	
	
	
														//*************************************
														//				CONSTRUCTOR           *
														//*************************************
	/**
	 * 
	 * Makes a new JCpgMenuInstallApi object
	 * 
	 * @param ui
	 * 		UI reference
	 */
	public JCpgMenuInstallApi(JCpgUI ui){
		
		super(ui);
		
		ui.setEnabled(false);
		
		setUI(ui);
		
		initComponents();
		boundComponents();
		placeComponents();
		
	}
	
	
	
	
	
	
	
	
														
														//*************************************
														//				SETTERS	              *
														//*************************************
	/**
	 * 
	 * Set the UI
	 * 
	 * @param ui
	 * 		the UI
	 */
	private void setUI(JCpgUI ui){
		
		this.ui = ui;
		
	}
	
	
	
	
														
														//*************************************
														//				GETTERS	              *
														//*************************************
	/**
	 * 
	 * Get the UI
	 * 
	 * @return
	 * 		the UI
	 */
	public JCpgUI getUI(){
		
		return this.ui;
		
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
		
		screensize = Toolkit.getDefaultToolkit().getScreenSize();
		
		logo = new JLabel(new JCpgImageUrlValidator("data/menu_installapi.jpg").createImageIcon(), JLabel.CENTER); // 1000x50
		
		msg = new JLabel();
		
		dbserver = new JLabel("DB Server");
		dbuser = new JLabel("DB User");
		dbpass = new JLabel("DB Password");
		dbname = new JLabel("DB Name");
		prefix = new JLabel("Prefix");
		adminusername = new JLabel("Admin Username");
		adminpassword = new JLabel("Admin Password");
		adminemail = new JLabel("Admin E-mail");
		
		dbserverField = new JTextField();
		dbuserField = new JTextField();
		dbpassField = new JTextField();
		dbnameField = new JTextField();
		prefixField = new JTextField();
		adminusernameField = new JTextField();
		adminpasswordField = new JTextField();
		adminemailField = new JTextField();
		
		close = new JButton("Close");
		install = new JButton("Install");
		
		close.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				closeActionPerformed(evt);
			}
		});
		
		install.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				installActionPerformed(evt);
			}
		});
		
	}
	/**
	 * 
	 * Position components
	 *
	 */
	private void boundComponents(){
		
		this.setBounds((int)(screensize.getWidth()/2)-500, (int)(screensize.getHeight()/2)-350, 1000, 700);
		this.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		this.setUndecorated(true);
		
		logo.setBounds(0, 0, 1000, 50);
		
		msg.setBounds(330, 620, 500, 20);
		
		dbserver.setBounds(20, 50, 150, 20);
		dbuser.setBounds(20, 80, 150, 20);
		dbpass.setBounds(20, 110, 150, 20);
		dbname.setBounds(20, 140, 150, 20);
		prefix.setBounds(20, 170, 150, 20);
		adminusername.setBounds(20, 200, 150, 20);
		adminpassword.setBounds(20, 230, 150, 20);
		adminemail.setBounds(20, 260, 150, 20);
		
		dbserverField.setBounds(180, 50, 150, 20);
		dbuserField.setBounds(180, 80, 150, 20);
		dbpassField.setBounds(180, 110, 150, 20);
		dbnameField.setBounds(180, 140, 150, 20);
		prefixField.setBounds(180, 170, 150, 20);
		adminusernameField.setBounds(180, 200, 150, 20);
		adminpasswordField.setBounds(180, 230, 150, 20);
		adminemailField.setBounds(180, 260, 150, 20);
		
		close.setBounds(450, 660, 100, 30);
		install.setBounds(330, 660, 100, 30);
	
	}
	/**
	 * 
	 * Add components
	 *
	 */
	private void placeComponents(){
		
		this.getContentPane().add(install);
		this.getContentPane().add(close);
		
		this.getContentPane().add(msg);
		this.getContentPane().add(logo);
		this.getContentPane().add(dbserver);
		this.getContentPane().add(dbuser);
		this.getContentPane().add(dbpass);
		this.getContentPane().add(dbname);
		this.getContentPane().add(prefix);
		this.getContentPane().add(adminusername);
		this.getContentPane().add(adminpassword);
		this.getContentPane().add(adminemail);
		
		this.getContentPane().add(dbserverField);
		this.getContentPane().add(dbuserField);
		this.getContentPane().add(dbpassField);
		this.getContentPane().add(dbnameField);
		this.getContentPane().add(prefixField);
		this.getContentPane().add(adminusernameField);
		this.getContentPane().add(adminpasswordField);
		this.getContentPane().add(adminemailField);
		
		this.setVisible(true);
		
	}
	
	
	
	
	
													//*************************************
													//				EVENTS                *
													//*************************************
	/**
	 * 
	 * Perform right actions when user clicks the close button
	 * 
	 */
	private void closeActionPerformed(java.awt.event.ActionEvent evt) {
		
		getUI().setEnabled(true);
		this.dispose();
		
	}
	/**
	 * 
	 * Perform right actions when user clicks the install button
	 * 
	 */
	private void installActionPerformed(java.awt.event.ActionEvent evt) {
		
		if(getUI().getOnlinemode()){
		
			if(!(dbserverField.getText().equals("") && dbuserField.getText().equals("") && dbpassField.getText().equals("") && dbnameField.getText().equals("") && 
					prefixField.getText().equals("") && adminusernameField.getText().equals("") && adminpasswordField.getText().equals("") && adminemailField.getText().equals(""))){
				
				JCpgPhpCommunicator phpCommunicator = new JCpgPhpCommunicator(getUI().getCpgConfig().getUserConfig().getBaseUrl()); // make a phpCommunicator object to talk with the API
				
				String parameters = "install&dbserver=" + dbserverField.getText() + "&dbuser=" + dbuserField.getText() + "&dbpass=" + dbpassField.getText() + "&dbname=" + dbnameField.getText() + "&prefix=" + prefixField.getText() + "adminusername=" + adminusernameField.getText() + "&adminpassword=" + adminpasswordField.getText() + "&adminemail=" + adminemailField.getText();
				
				if(phpCommunicator.performPhpRequest(parameters) == 0){ // install ok
				
					msg.setText("Installation succesful!!");
					
				}else{
					
					new JCpgErrorHandler().addLogEntry(phpCommunicator.getErrorMessage());
					msg.setText("Failed to install the Coppermine API");
					
					System.out.println("JCpgMenuInstallApi: Couldn't install the API");
					
				}
					
			}else{
				
				msg.setText("You must fill in all fields");
				
			}
		
		}else{
			
			msg.setText("You are not online");
			
		}
			
	}
	
}
