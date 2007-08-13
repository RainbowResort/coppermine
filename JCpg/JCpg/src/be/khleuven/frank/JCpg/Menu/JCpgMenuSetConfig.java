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
import javax.swing.JComboBox;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JTextField;

import be.khleuven.frank.JCpg.JCpgImageUrlValidator;
import be.khleuven.frank.JCpg.Communicator.JCpgPhpCommunicator;
import be.khleuven.frank.JCpg.UI.JCpgUI;





public class JCpgMenuSetConfig extends JDialog {
	
	
	private JCpgUI ui;
	private Dimension screensize;
	
	private String[] yesno = {"No", "Yes"};
	
	private JLabel logo, msg;
	
	private JButton close, save;
	private JLabel allow_user_registration, allow_duplicate_emails_addr, reg_requires_valid_email, admin_activation, reg_notify_admin_email, gallery_name, gallery_admin_email, 
					gallery_description, site_url;
	private JTextField gallery_nameField, gallery_admin_emailField, gallery_descriptionField, site_urlField;
	private JComboBox allow_user_registrationCombo, allow_duplicate_emails_addrCombo, reg_requires_valid_emailCombo, admin_activationCombo, reg_notify_admin_emailCombo;
	
	
	public JCpgMenuSetConfig(JCpgUI ui){
		
		super(ui);
		
		ui.setEnabled(false);
		
		setUI(ui);
		
		initComponents();
		boundComponents();
		placeComponents();
		
	}
	
	
	
	
											//*************************************
											//				SETTERS  	          *
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
											//				GETTERS		          *
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
											//				SWING		          *
											//*************************************
	/**
	 * 
	 * Init swing components
	 *
	 */
	private void initComponents(){
		
		this.setLayout(null);
		
		screensize = Toolkit.getDefaultToolkit().getScreenSize();
				
		logo = new JLabel(new JCpgImageUrlValidator("data/menu_changeyoursiteconfig.jpg").createImageIcon(), JLabel.CENTER); // 1000x50
		
		msg = new JLabel();
		
		allow_user_registration = new JLabel("Allow user registration");
		allow_duplicate_emails_addr = new JLabel("Allow duplicate email addresses");
		reg_requires_valid_email = new JLabel("Registration requires valid email");
		admin_activation = new JLabel("Admin activation");
		reg_notify_admin_email = new JLabel("Registration notifies admin email");
		gallery_name = new JLabel("Gallery name");
		gallery_admin_email = new JLabel("Gallery admin email");
		gallery_description = new JLabel("Gallery description");
		site_url = new JLabel("Site url");
		
		gallery_nameField = new JTextField(getUI().getCpgConfig().getSiteConfig().getValueFor("gallery_name"));
		gallery_admin_emailField = new JTextField(getUI().getCpgConfig().getSiteConfig().getValueFor("gallery_admin_email"));
		gallery_descriptionField = new JTextField(getUI().getCpgConfig().getSiteConfig().getValueFor("gallery_description"));
		site_urlField = new JTextField(getUI().getCpgConfig().getSiteConfig().getValueFor("site_url"));
		
		allow_user_registrationCombo = new JComboBox(yesno);
		if(getUI().getCpgConfig().getSiteConfig().getValueFor("allow_user_registration").equals("0")) 
			allow_user_registrationCombo.setSelectedItem("No");
		else
			allow_user_registrationCombo.setSelectedItem("Yes");
		
		allow_duplicate_emails_addrCombo = new JComboBox(yesno);
		if(getUI().getCpgConfig().getSiteConfig().getValueFor("allow_duplicate_emails_addr").equals("0")) 
			allow_duplicate_emails_addrCombo.setSelectedItem("No");
		else
			allow_duplicate_emails_addrCombo.setSelectedItem("Yes");
		
		reg_requires_valid_emailCombo = new JComboBox(yesno);
		if(getUI().getCpgConfig().getSiteConfig().getValueFor("reg_requires_valid_email").equals("0")) 
			reg_requires_valid_emailCombo.setSelectedItem("No");
		else
			reg_requires_valid_emailCombo.setSelectedItem("Yes");
		
		admin_activationCombo = new JComboBox(yesno);
		if(getUI().getCpgConfig().getSiteConfig().getValueFor("admin_activation").equals("0")) 
			admin_activationCombo.setSelectedItem("No");
		else
			admin_activationCombo.setSelectedItem("Yes");
		
		reg_notify_admin_emailCombo = new JComboBox(yesno);
		if(getUI().getCpgConfig().getSiteConfig().getValueFor("reg_notify_admin_email").equals("0")) 
			reg_notify_admin_emailCombo.setSelectedItem("No");
		else
			reg_notify_admin_emailCombo.setSelectedItem("Yes");
		
		
		close = new JButton("Close");
		save = new JButton("Save configuration");
		
		close.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				closeActionPerformed(evt);
			}
		});
		
		save.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				saveToFileActionPerformed(evt);
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
		
		msg.setBounds(330, 630, 400, 20);
		
		allow_user_registration.setBounds(10, 50, 250, 20);
		allow_duplicate_emails_addr.setBounds(10, 70, 250, 20);
		reg_requires_valid_email.setBounds(10, 90, 250, 20);
		admin_activation.setBounds(10, 110, 250, 20);
		reg_notify_admin_email.setBounds(10, 130, 250, 20);
		gallery_name.setBounds(10, 150, 250, 20);
		gallery_admin_email.setBounds(10, 170, 250, 20);
		gallery_description.setBounds(10, 190, 250, 20);
		site_url.setBounds(10, 210, 250, 20);
		
		allow_user_registrationCombo.setBounds(270, 50, 250, 20);
		allow_duplicate_emails_addrCombo.setBounds(270, 70, 250, 20);
		reg_requires_valid_emailCombo.setBounds(270, 90, 250, 20);
		admin_activationCombo.setBounds(270, 110, 250, 20);
		
		reg_notify_admin_emailCombo.setBounds(270, 130, 250, 20);
		gallery_nameField.setBounds(270, 150, 250, 20);
		gallery_admin_emailField.setBounds(270, 170, 250, 20);
		gallery_descriptionField.setBounds(270, 190, 250, 20);
		site_urlField.setBounds(270, 210, 250, 20);
		
		close.setBounds(490, 660, 100, 30);
		save.setBounds(330, 660, 150, 30);
	
	}
	/**
	 * 
	 * Add components
	 *
	 */
	private void placeComponents(){
		
		this.getContentPane().add(logo);
		
		this.getContentPane().add(msg);
		
		this.getContentPane().add(allow_user_registration);
		this.getContentPane().add(allow_duplicate_emails_addr);
		this.getContentPane().add(reg_requires_valid_email);
		this.getContentPane().add(admin_activation);
		this.getContentPane().add(reg_notify_admin_email);
		this.getContentPane().add(gallery_name);
		this.getContentPane().add(gallery_admin_email);
		this.getContentPane().add(gallery_description);
		this.getContentPane().add(site_url);
		
		this.getContentPane().add(gallery_nameField);
		this.getContentPane().add(gallery_admin_emailField);
		this.getContentPane().add(gallery_descriptionField);
		this.getContentPane().add(site_urlField);
		this.getContentPane().add(allow_user_registrationCombo);
		this.getContentPane().add(allow_duplicate_emails_addrCombo);
		this.getContentPane().add(reg_requires_valid_emailCombo);
		this.getContentPane().add(admin_activationCombo);
		this.getContentPane().add(reg_notify_admin_emailCombo);
		
		this.getContentPane().add(close);
		this.getContentPane().add(save);
		this.setVisible(true);
		
	}
	
	
	
	
	
	
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
	 * Perform right actions when user clicks the save to file button
	 * 
	 */
	private void saveToFileActionPerformed(java.awt.event.ActionEvent evt) {
		
		JCpgPhpCommunicator phpCommunicator = new JCpgPhpCommunicator(getUI().getCpgConfig().getUserConfig().getBaseUrl()); // make a phpCommunicator object to talk with the API
		
		String parameters = "setconfig&username=" + getUI().getCpgConfig().getUserConfig().getUsername() + "&sessionkey=" + getUI().getCpgConfig().getUserConfig().getSessionkey()
						        + "&allow_user_registration=" + allow_user_registrationCombo.getSelectedIndex()
						        + "&allow_duplicate_emails_addr=" + allow_duplicate_emails_addrCombo.getSelectedIndex()
						        + "&reg_requires_valid_email=" + reg_requires_valid_emailCombo.getSelectedIndex()
						        + "&admin_activation=" + admin_activationCombo.getSelectedIndex()
						        + "&reg_notify_admin_email=" + reg_notify_admin_emailCombo.getSelectedIndex()
						        + "&gallery_name=" + gallery_nameField.getText()
						        + "&gallery_admin_email=" + gallery_admin_emailField.getText()
						        + "&gallery_description=" + gallery_descriptionField.getText()
						        + "&site_url=" + site_urlField.getText()
						        + "&user_profile1_name=" + getUI().getCpgConfig().getSiteConfig().getValueFor("user_profile1_name")
						        + "&user_profile2_name=" + getUI().getCpgConfig().getSiteConfig().getValueFor("user_profile2_name")
						        + "&user_profile3_name=" + getUI().getCpgConfig().getSiteConfig().getValueFor("user_profile3_name")
						        + "&user_profile4_name=" + getUI().getCpgConfig().getSiteConfig().getValueFor("user_profile4_name")
						        + "&user_profile5_name=" + getUI().getCpgConfig().getSiteConfig().getValueFor("user_profile5_name")
						        + "&user_profile6_name=" + getUI().getCpgConfig().getSiteConfig().getValueFor("user_profile6_name");
		
		if(getUI().getOnlinemode() && phpCommunicator.performPhpRequest(parameters) == 0){ // change config ok
			
			msg.setText("Configuration changed succesfully.");
			
		}else{
			
			msg.setText("Configuration failed to change. Maybe you are not online.");
			
		}
		
	}

}
