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

import be.khleuven.frank.JCpg.Interfaces.JCpgAddTreeEntryInterface;
import be.khleuven.frank.JCpg.Save.JCpgGallerySaver;
import be.khleuven.frank.JCpg.UI.JCpgUI;
import java.awt.Dimension;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.Serializable;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JTextField;
import javax.swing.tree.DefaultMutableTreeNode;

/**
 * This class will take care of all the actions when the user clicks on the + button. First we will determine which node is selected in the tree, determine the type of this node and then start the right manager. We have three manager classes inheritating from this class: category, album, picture.
 * @author    Frank Cleynen
 */
public abstract class JCpgAddManager extends JDialog implements JCpgAddTreeEntryInterface, Serializable {
												
	
	
	
																				//*************************************
																				//				VARIABELS             *
																				//*************************************
	private JCpgUI jCpgUIReference;
	private JCpgGallerySaver gallerySaver = new JCpgGallerySaver();
	
	private JLabel logo;
	private JLabel title;
	private JLabel description;
	protected JLabel msg;
	protected JTextField titleField;
	protected JTextField descriptionField;
	private JButton create;
	private JButton close;
	private ImageIcon logoIcon;
	
	private Dimension screensize;
	
	private DefaultMutableTreeNode node;

	
	
	
	
	
	
	

																				//*************************************
																				//				CONSTRUCTORS	      *
																				//*************************************
	/**
	* 
	* Makes a new albummanager object
	* 
	* @param jCpgUIReference
	* 		reference to the UI object
	* @param categories
	* 		list with categories
	* @param tree
	* 		the tree in the UI
	*/
	public JCpgAddManager(JCpgUI jCpgUIReference, ImageIcon logo, DefaultMutableTreeNode node){
		
		super(jCpgUIReference);
		
		jCpgUIReference.setEnabled(false);
		
		setLogo(logo);
		setJCpgUIReference(jCpgUIReference);
		setNode(node);
		
		initComponents();
		boundComponents();
		placeComponents();
		
		getGallerySaver().changeGallery(jCpgUIReference.getGallery());
		
	}

	
	
	
	
	
	
	
	
																				//*************************************
																				//				SETTERS			      *
																				//*************************************
	/**
	* 
	* Set the JCpgUI reference
	* 
	* @param jCpgUIReference
	* 		the JCpgUI reference
	*/
	private void setJCpgUIReference(JCpgUI jCpgUIReference){
		
		this.jCpgUIReference = jCpgUIReference;
		
	}
	/**
	 * 
	 * Set the logo
	 * 
	 * @param logo
	 * 		path to the logo
	 */
	private void setLogo(ImageIcon logo){
		
		this.logoIcon = logo;
		
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
		
		logo = new JLabel(getLogoIcon(), JLabel.CENTER); // 500x50
		title = new JLabel("Title: ");
		description = new JLabel("Description: ");
		msg = new JLabel();
		
		titleField = new JTextField();
		descriptionField = new JTextField();
		
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
		title.setBounds(70, 51, 100, 20);
		description.setBounds(70, 71, 100, 20);
		msg.setBounds(180, 120, 350, 20);
		
		titleField.setBounds(180, 51, 200, 20);
		descriptionField.setBounds(180, 71, 200, 20);
		
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
		this.getContentPane().add(title);
		this.getContentPane().add(description);
		this.getContentPane().add(msg);
		this.getContentPane().add(titleField);
		this.getContentPane().add(descriptionField);
		this.getContentPane().add(create);
		this.getContentPane().add(close);
		this.setVisible(true);
		
	}
	
	
	
	
	
	
	
	
																				//*************************************
																				//				GETTERS			      *
																				//*************************************
	/**
	* 
	* Get the JCpgUI reference
	* 
	* @return jCpgUIReference
	* 		the JCpgUI reference
	*/
	public JCpgUI getJCpgUIReference(){
		
		return this.jCpgUIReference;
		
	}
	/**
	 * 
	 * Get an ImageIcon object from the logo path
	 * 
	 * @return
	 * 		an ImageIcon object from the logo path
	 */
	public ImageIcon getLogoIcon(){
		
		return this.logoIcon;
		
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
	/**
	 * 
	 * Get the current title given by the user
	 * 
	 * @return
	 * 		the current title given by the user
	 */
	public JTextField getTitleField(){
		
		return this.titleField;
		
	}
	/**
	 * 
	 * Get the current description label text
	 * 
	 * @return
	 * 		the current description label text
	 */
	public JLabel getDescriptionLabel(){
		
		return this.description;
		
	}
	/**
	 * 
	 * Get the current description given by the user
	 * 
	 * @return
	 * 		the current description given by the user
	 */
	public JTextField getDescriptionField(){
		
		return this.descriptionField;
		
	}
	/**
	 * 
	 * Get the message label. Used to inform about wrong inputted information
	 * 
	 * @return
	 * 		the message label
	 */
	public JLabel getMsgLabel(){
		
		return this.msg;
		
	}
	/**
	 * 
	 * Get the reference to the create button
	 * 
	 * @return
	 * 		the reference to the create button
	 */
	public JButton getCreateButton(){
		
		return this.create;
	}
	public JButton getCloseButton(){
		
		return this.close;
		
	}
	/**
	 * 
	 * Get the reference to the gallery saver object
	 * 
	 * @return
	 */
	public JCpgGallerySaver getGallerySaver(){
		
		return this.gallerySaver;
		
	}
	
	
	
	
	
																				//*************************************
																				//				EVENTS			      *
																				//*************************************	
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
