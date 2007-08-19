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


/**
 * 
 * Shows a screen from which the user can add new users
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgMenuAddUser extends JDialog {
	
	
	
															
															//*************************************
															//				VARIABLES             *
															//*************************************
	private static final long serialVersionUID = 1L;
	
	private JCpgUI ui;
	private Dimension screensize;
	
	private String[] activenotactive = {"Not Active", "Active"};
	
	private JLabel logo, msg;
	
	private JButton close, add;
	private JLabel username, password, email, activation;
	private JTextField usernameField, passwordField, emailField;
	private JComboBox activationCombo;
	
	
	
	
															
															//*************************************
															//				CONSTRUCTOR			  *
															//*************************************
	/**
	 * 
	 * Makes a new JCpgMenuAddUser object
	 * 
	 * @param ui
	 * 		UI reference
	 */
	public JCpgMenuAddUser(JCpgUI ui){
		
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
															//				SWING                 *
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
		
		username = new JLabel("Username");
		password = new JLabel("Password");
		email = new JLabel("E-mail");
		activation = new JLabel("Activation");
		
		usernameField = new JTextField();
		passwordField = new JTextField();
		emailField = new JTextField();
		
		activationCombo = new JComboBox(activenotactive);
		
		close = new JButton("Close");
		add = new JButton("Add user");
		
		close.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				closeActionPerformed(evt);
			}
		});
		
		add.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				AddActionPerformed(evt);
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
		
		username.setBounds(10, 50, 250, 20);
		password.setBounds(10, 70, 250, 20);
		email.setBounds(10, 90, 250, 20);
		activation.setBounds(10, 110, 250, 20);
		
		usernameField.setBounds(270, 50, 250, 20);
		passwordField.setBounds(270, 70, 250, 20);
		emailField.setBounds(270, 90, 250, 20);
		activationCombo.setBounds(270, 110, 250, 20);
		
		close.setBounds(490, 660, 100, 30);
		add.setBounds(330, 660, 150, 30);
	
	}
	/**
	 * 
	 * Add components
	 *
	 */
	private void placeComponents(){
		
		this.getContentPane().add(logo);
		
		this.getContentPane().add(msg);
		
		this.getContentPane().add(username);
		this.getContentPane().add(password);
		this.getContentPane().add(email);
		this.getContentPane().add(activation);
		
		this.getContentPane().add(usernameField);
		this.getContentPane().add(passwordField);
		this.getContentPane().add(emailField);
		this.getContentPane().add(activationCombo);
		
		this.getContentPane().add(close);
		this.getContentPane().add(add);
		this.setVisible(true);
		
	}
	
	
	
	
	
	
	
															
															//*************************************
															//				EVENTS	              *
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
	 * Perform right actions when user clicks the add user button
	 * 
	 */
	private void AddActionPerformed(java.awt.event.ActionEvent evt) {
		
		if(!usernameField.getText().equals("") && !passwordField.getText().equals("") && !emailField.getText().equals("")){
		
			JCpgPhpCommunicator phpCommunicator = new JCpgPhpCommunicator(getUI().getCpgConfig().getUserConfig().getBaseUrl()); // make a phpCommunicator object to talk with the API
			
			String parameters = "adduser&username=" + getUI().getCpgConfig().getUserConfig().getUsername() + "&addusername=" + usernameField.getText() + "&password=" + passwordField.getText()
							+ "&email=" + emailField.getText() + "&active=" + activationCombo.getSelectedIndex() + "&sessionkey=" + getUI().getCpgConfig().getUserConfig().getSessionkey();
			
			if(getUI().getOnlinemode() && phpCommunicator.performPhpRequest(parameters) == 0){ // change config ok
				
				msg.setText("New user added succesfully.");
				
			}else{
				
				msg.setText("New user failed to add. Maybe you are not online or the user already exists.");
				
			}
			
		}else{
			
			msg.setText("Please fill in all textfields");
			
		}
		
	}

}
