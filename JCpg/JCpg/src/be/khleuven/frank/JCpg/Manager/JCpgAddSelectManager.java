package be.khleuven.frank.JCpg.Manager;

import java.awt.Dimension;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.tree.DefaultMutableTreeNode;

import be.khleuven.frank.JCpg.UI.JCpgUI;

/**
 * 
 * In Coppermine, users can add albums to the main gallery and can also make subcategories in categories. This class makes it possible to make that choice and call the right AddManager
 * 
 * @author Frank Cleynen
 *
 */
public abstract class JCpgAddSelectManager extends JDialog {
	
	
	private JCpgUI ui;
	private ImageIcon icon;
	private DefaultMutableTreeNode node;
	
	private Dimension screensize;
	
	private JLabel logo;
	
	private JComboBox optionList;
	
	private JButton create;
	private JButton close;
	
	
	
	
	
	public JCpgAddSelectManager(JCpgUI jCpgUIReference, ImageIcon logo, DefaultMutableTreeNode node){
		
		super(jCpgUIReference);
		
		setUi(jCpgUIReference);
		setLogo(logo);
		setNode(node);
		
		initComponents();
		boundComponents();
		placeComponents();
		
	}
	
	
	
	
	
	
	/**
	* 
	* Set the JCpgUI reference
	* 
	* @param jCpgUIReference
	* 		the JCpgUI reference
	*/
	private void setUi(JCpgUI jCpgUIReference){
		
		this.ui = jCpgUIReference;
		
	}
	/**
	 * 
	 * Set the logo
	 * 
	 * @param logo
	 * 		path to the logo
	 */
	private void setLogo(ImageIcon logo){
		
		this.icon = logo;
		
	}
	/**
	 * 
	 * Set the currently selected node
	 * 
	 * @param node
	 * 		the currently selected node
	 */
	private void setNode(DefaultMutableTreeNode node){
		
		this.node = node;
		
	}
	
	
	
	
	
	
	
	/**
	* 
	* Init swing components
	* 
	*/
	private void initComponents(){
	
		this.setLayout(null);
		
		screensize = Toolkit.getDefaultToolkit().getScreenSize();
		
		logo = new JLabel(getLogoIcon(), JLabel.CENTER); // 500x50
		
		optionList = new JComboBox();
		
		create = new JButton("Create");
		close = new JButton("Close");
		
		create.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				createActionPerformed(evt);
			}
		});
		
		close.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				closeActionPerformed(evt);
			}
		});
		
	}
	/**
	* 
	* Size swing components
	*
	*/
	private void boundComponents(){
	
		this.setBounds((int)(screensize.getWidth()/2)-250, (int)(screensize.getHeight()/2)-100, 500, 200);
		this.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		this.setUndecorated(true);
		
		logo.setBounds(0, 0, 500, 50);
		
		optionList.setBounds(180, 55, 200, 30);
		
		create.setBounds(70, 120, 100, 30);
		close.setBounds(70, 160, 100, 30);
	
	}
	/**
	* 
	* Position swing components
	*
	*/
	private void placeComponents(){
		
		this.getContentPane().add(logo);
		this.getContentPane().add(optionList);
		this.getContentPane().add(create);
		this.getContentPane().add(close);
		this.setVisible(true);
		
	}
	
	
	
	
	
	/**
	* 
	* Get the JCpgUI reference
	* 
	* @return jCpgUIReference
	* 		the JCpgUI reference
	*/
	public JCpgUI getJCpgUIReference(){
		
		return this.ui;
		
	}
	/**
	 * 
	 * Get an ImageIcon object from the logo path
	 * 
	 * @return
	 * 		an ImageIcon object from the logo path
	 */
	public ImageIcon getLogoIcon(){
		
		return this.icon;
		
	}
	/**
	 * 
	 * Get the currently selected node
	 * 
	 * @return
	 * 		the currently selected node
	 */
	public DefaultMutableTreeNode getNode(){
		
		return this.node;
		
	}
	public JComboBox getOptionList(){
		
		return this.optionList;
		
	}
	
	
	
	
	/**
	* 
	* Perform right actions when create button is clicked
	* 
	*/
	public void createActionPerformed(java.awt.event.ActionEvent evt) {
		
	}
	/**
	 * 
	 * Perform right actions when close button is clicked
	 * 
	 */
	public void closeActionPerformed(java.awt.event.ActionEvent evt) {
		
		this.dispose();
		getJCpgUIReference().setEnabled(true);
		
	}

}
