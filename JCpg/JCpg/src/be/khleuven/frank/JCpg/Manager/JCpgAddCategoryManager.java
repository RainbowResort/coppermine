package be.khleuven.frank.JCpg.Manager;
import java.io.Serializable;

import javax.swing.ImageIcon;
import javax.swing.SwingUtilities;
import javax.swing.tree.DefaultMutableTreeNode;

import be.khleuven.frank.JCpg.Components.JCpgCategory;
import be.khleuven.frank.JCpg.Components.JCpgGallery;
import be.khleuven.frank.JCpg.Interfaces.JCpgAddTreeEntryInterface;
import be.khleuven.frank.JCpg.UI.JCpgUI;



/**
 * 
 * Add category manager
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgAddCategoryManager extends JCpgAddManager implements JCpgAddTreeEntryInterface, Serializable {

	
	
																			//*************************************
																			//				CONSTRUCTORS	      *
																			//*************************************
	/**
	 * 
	 * Makes a new JCpgAddCategoryManager object
	 * 
	 * @param jCpgUIReference
	 * 		reference to the UI
	 * @param logo
	 * 		path to add category logo
	 * @param node
	 * 		currently selected tree node
	 */
	public JCpgAddCategoryManager(JCpgUI jCpgUIReference, ImageIcon logo, DefaultMutableTreeNode node){
		
		super(jCpgUIReference, logo, node);
		
	}
	
	
	
	
																			//*************************************
																			//				EVENTS			      *
																			//*************************************	
	/**
	* 
	* Perform right actions when create button is clicked.
	* 
	*/
	public void createActionPerformed(java.awt.event.ActionEvent evt) {
		
		JCpgGallery gallery = (JCpgGallery)getNode().getUserObject();
		
		// title empty?
		if(titleField.getText().equals("")){
			
			getMsgLabel().setText("Title is empty !!");
			return;
			
		}
		
		// check duplicate
		for(int i=0; i<gallery.getCategories().size(); i++){
			
			if(gallery.getCategories().get(i).getName().equals(titleField.getText())){
				
				getMsgLabel().setText("Category already exists. Choose a different name.");
				return;
				
			}
			
		}
		
		// make new category
		JCpgCategory category = new JCpgCategory(getJCpgUIReference().getUserConfig(), -1, -1, getTitleField().getText(), getDescriptionField().getText(), -1, 0, 0);
		
		category.generateSqlInsertQuery();
		
		gallery.addCategory(category);
		DefaultMutableTreeNode newNode = new DefaultMutableTreeNode(category);
		getNode().add(newNode);
		SwingUtilities.updateComponentTreeUI(getJCpgUIReference().getTree()); // workaround for Java bug 4173369
		
		getGallerySaver().saveGallery(getJCpgUIReference().getGallery()); // save current gallery state
		
		getJCpgUIReference().setEnabled(true);
		this.dispose();
		
	}
	
}
