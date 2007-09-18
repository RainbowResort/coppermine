package be.khleuven.frank.JCpg.Menu;

import java.awt.Dimension;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JFrame;

import be.khleuven.frank.JCpg.UI.JCpgUI;


/**
 * 
 * Shows a screen from which the user can add new users
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgMenuHelp extends JDialog {
	
	
	
															
															//*************************************
															//				VARIABLES             *
															//*************************************
	private static final long serialVersionUID = 1L;
	
	private JCpgUI ui;
	private Dimension screensize;
	
	private JButton close;
	
	
	
	
															
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
	public JCpgMenuHelp(JCpgUI ui){
		
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
		
		close = new JButton("Close");
		
		close.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				closeActionPerformed(evt);
			}
		});
		
	}
	/**
	 * 
	 * Position components
	 *
	 */
	private void boundComponents(){
		
		this.setBounds(10, 10, screensize.width - 10, screensize.height - 70);
		this.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		this.setUndecorated(true);
		
		close.setBounds(490, 660, 100, 30);
	
	}
	/**
	 * 
	 * Add components
	 *
	 */
	private void placeComponents(){
		
		this.getContentPane().add(close);
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

}
