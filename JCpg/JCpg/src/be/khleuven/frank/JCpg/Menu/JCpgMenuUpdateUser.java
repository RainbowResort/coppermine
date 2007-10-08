package be.khleuven.frank.JCpg.Menu;

import java.awt.Dimension;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;
import java.util.List;
import java.util.ListIterator;

import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JTextField;

import org.jdom.Document;
import org.jdom.Element;
import org.jdom.JDOMException;
import org.jdom.input.SAXBuilder;

import be.khleuven.frank.JCpg.JCpgImageUrlValidator;
import be.khleuven.frank.JCpg.Communicator.JCpgPhpCommunicator;
import be.khleuven.frank.JCpg.Error.JCpgErrorHandler;
import be.khleuven.frank.JCpg.UI.JCpgUI;

public class JCpgMenuUpdateUser extends JDialog {
	
	
	
	
	
													//*************************************
													//				VARIABLES             *
													//*************************************
	private static final long serialVersionUID = 1L;
	
	private JCpgUI ui;
	private Dimension screensize;
	
	private String[] activenotactive = {"Not Active", "Active"};
	
	private JLabel logo, msg;
	
	private JButton close, update;
	private JLabel password, email, activation, user;
	private JTextField passwordField, emailField;
	private JComboBox activationCombo, userCombo;
	
	
	
	
	
	
	
	
	
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
	public JCpgMenuUpdateUser(JCpgUI ui){
		
		super(ui);
		
		ui.setEnabled(false);
		
		setUI(ui);
		
		initComponents();
		boundComponents();
		placeComponents();
		
		fillUsersCombo();
		
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
				
		logo = new JLabel(new JCpgImageUrlValidator("data/menu_adduser.jpg").createImageIcon(), JLabel.CENTER); // 1000x50
		
		msg = new JLabel();
		
		password = new JLabel("Password");
		email = new JLabel("E-mail");
		activation = new JLabel("Activation");
		user = new JLabel("User");
		
		passwordField = new JTextField();
		emailField = new JTextField();
		
		activationCombo = new JComboBox(activenotactive);
		userCombo = new JComboBox();
		
		close = new JButton("Close");
		update = new JButton("Update user");
		
		close.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				closeActionPerformed(evt);
			}
		});
		
		update.addActionListener(new ActionListener(){
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
		
		msg.setBounds(330, 630, 600, 20);
		
		user.setBounds(10, 50, 250, 20);
		password.setBounds(10, 70, 250, 20);
		email.setBounds(10, 90, 250, 20);
		activation.setBounds(10, 110, 250, 20);
		
		userCombo.setBounds(270, 50, 250, 20);
		passwordField.setBounds(270, 70, 250, 20);
		emailField.setBounds(270, 90, 250, 20);
		activationCombo.setBounds(270, 110, 250, 20);
		
		close.setBounds(490, 660, 100, 30);
		update.setBounds(330, 660, 150, 30);
	
	}
	/**
	 * 
	 * Add components
	 *
	 */
	private void placeComponents(){
		
		this.getContentPane().add(logo);
		
		this.getContentPane().add(msg);
		
		this.getContentPane().add(password);
		this.getContentPane().add(email);
		this.getContentPane().add(activation);
		this.getContentPane().add(user);
		
		this.getContentPane().add(passwordField);
		this.getContentPane().add(emailField);
		
		this.getContentPane().add(activationCombo);
		this.getContentPane().add(userCombo);
		
		this.getContentPane().add(close);
		this.getContentPane().add(update);
		this.setVisible(true);
		
	}
	
	
	
	
													//*************************************
													//				MUTATORS & OTHERS     *
													//*************************************
	private void fillUsersCombo(){
		
		JCpgPhpCommunicator phpCommunicator = new JCpgPhpCommunicator(getUI().getCpgConfig().getSiteConfig().getBaseUrl()); // make a phpCommunicator object to talk with the API
		
		String parameters = "showusers&username=" + getUI().getCpgConfig().getUserConfig().getUsername() + "&sessionkey=" + getUI().getCpgConfig().getUserConfig().getSessionkey();
		
		if(phpCommunicator.performPhpRequest(parameters) == 0){ // query ok
			
			if(phpCommunicator.performPhpRequest(parameters) == 0){ // result ok
				
				SAXBuilder builder = new SAXBuilder(false); // no validation for illegal xml format
				
				File file = new File("svr.xml");
				
				if(file.exists()){
				
					try {
						
						Document doc = builder.build("svr.xml");
						
						Element root = doc.getRootElement();
						
						List content = root.getChildren();
						ListIterator it = content.listIterator();
						
						while(it.hasNext()){
							
							Element element = (Element)it.next();
							
							if(element.getName().equals("userdata")){
								
								List content2 = element.getChildren();
								ListIterator it2 = content2.listIterator();
								
								while(it2.hasNext()){
									
									Element element2 = (Element)it2.next();
									
									if(element2.getName().equals("username")){
										
										userCombo.addItem(element2.getText());
										
									}
									
								}
								
							}
							
						}
						
					} catch (JDOMException e) {
						
						System.out.println("JCpgMenuUpdateUser: Couldn't extract users from server response");
						
					}
					
				}	
					
			}
			
		}else{
			
			new JCpgErrorHandler().addLogEntry(phpCommunicator.getErrorMessage());
			msg.setText("You need to be online and an admin to update a user's information");
			
		}
		
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
		
		if(!passwordField.getText().equals("") && !emailField.getText().equals("")){
		
			JCpgPhpCommunicator phpCommunicator = new JCpgPhpCommunicator(getUI().getCpgConfig().getUserConfig().getBaseUrl()); // make a phpCommunicator object to talk with the API
			
			String parameters = "";
				
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
