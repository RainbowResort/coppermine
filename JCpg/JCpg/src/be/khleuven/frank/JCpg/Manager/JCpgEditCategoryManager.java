package be.khleuven.frank.JCpg.Manager;
import java.io.Serializable;

import javax.swing.ImageIcon;
import javax.swing.tree.DefaultMutableTreeNode;

import be.khleuven.frank.JCpg.Components.JCpgCategory;
import be.khleuven.frank.JCpg.UI.JCpgUI;



public class JCpgEditCategoryManager extends JCpgEditManager implements Serializable {
	
	
	
	
	
																				
																					//*************************************
																					//				VARIABLES	          *
																					//*************************************
	private JCpgCategory category;

	
	
	
	
																				
																					//*************************************
																					//				CONSTRUCTOR	          *
																					//*************************************
	/**
	 * 
	 * Makes a new JCpgEditCategoryManager object
	 * 
	 * @param jCpgUIReference
	 * 		reference to the UI
	 * @param logo
	 * 		logo for 'edit category'
	 * @param node
	 * 		current selected node
	 */
	public JCpgEditCategoryManager(JCpgUI jCpgUIReference, ImageIcon logo, DefaultMutableTreeNode node) {
		
		super(jCpgUIReference, logo, node);
		setAlbum();
		makeEditWindowChanges();
		
	}
	
	
	
	
																				
																					//*************************************
																					//				SETTERS  	          *
																					//*************************************
	/**
	 * 
	 * Set the album
	 *
	 */
	private void setAlbum(){
		
		this.category = (JCpgCategory)getNode().getUserObject();
		
	}
	
	
	
	
	
																				
																					//*************************************
																					//				MUTARORS & OTHERS     *
																					//*************************************
	/**
	 * 
	 * Make some additional swing stuff specifically for this edit screen
	 *
	 */
	private void makeEditWindowChanges(){
		
		getTitleField().setText(category.getName());
		getDescriptionField().setText(category.getDescription());
		
	}
	
	
	
	
																				
																					//*************************************
																					//				EVENTS		          *
																					//*************************************
	/**
	 * 
	 * Perform the right actions when the user clicks the edit button
	 * 
	 */
	public void createActionPerformed(java.awt.event.ActionEvent evt) {
		
		if(getTitleField().getText().equals("") || getDescriptionField().getText().equals("")){
			
			getMsgLabel().setText("Some fields are still empty!");
			
		}else{
			
			category.changeName(getTitleField().getText());
			category.changeDescription(getDescriptionField().getText());
			
			if(category.getId() == -1){ // album not yet in database, produce an INSERT query
				
				category.generateSqlInsertQuery();
				
			}else{ // album already in database, just UPDATE it
				
				category.generateSqlUpdateQuery();
				
			}
			
			getGallerySaver().saveGallery(getJCpgUIReference().getGallery()); // save current gallery state

			this.dispose();
			getJCpgUIReference().setEnabled(true);
			
		}
		
		getGallerySaver().saveGallery(getJCpgUIReference().getGallery()); // save current gallery state
		
	}

}
