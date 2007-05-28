package be.khleuven.frank.JCpg.Manager;
import java.io.Serializable;

import javax.swing.ImageIcon;
import javax.swing.tree.DefaultMutableTreeNode;

import be.khleuven.frank.JCpg.Components.JCpgPicture;
import be.khleuven.frank.JCpg.UI.JCpgUI;



public class JCpgEditPictureManager extends JCpgEditManager implements Serializable {
	
	
	
	
																							
																								//*************************************
																								//				VARIABLES	          *
																								//*************************************
	private JCpgPicture picture;

	
	
	
	
																							
																								//*************************************
																								//				CONSTRUCTOR	          *
																								//*************************************
	/**
	 * 
	 * Makes a new JCpgEditPictureManager object
	 * 
	 * @param jCpgUIReference
	 * 		reference to the UI
	 * @param logo
	 * 		logo for this edit screen
	 * @param node
	 * 		current selected node
	 */
	public JCpgEditPictureManager(JCpgUI jCpgUIReference, ImageIcon logo, DefaultMutableTreeNode node) {
		
		super(jCpgUIReference, logo, node);
		setAlbum();
		makeEditWindowChanges();
		
	}
	
	
	
	
	
	
																							
																								//*************************************
																								//				SETTERS		          *
																								//*************************************
	/**
	 * 
	 * Sets the album parent
	 *
	 */
	private void setAlbum(){
		
		this.picture = (JCpgPicture)getNode().getUserObject();
		
	}
	
	
	
																							
	
	
																								//*************************************
																								//				MUTATORS & OTHERS	    *
																								//*************************************
	/**
	 * 
	 * Do additional swing stuff specifically for this edit screen
	 *
	 */
	private void makeEditWindowChanges(){
		
		getTitleField().setText(picture.getName());
		getDescriptionField().setText(picture.getCaption());
		getDescriptionLabel().setText("Caption");
		
	}
	
	
	
	
	
																							
																								//*************************************
																								//				EVENTS		          *
																								//*************************************
	/**
	 * 
	 * Perform right actions when user presses the edit button
	 * 
	 */
	public void createActionPerformed(java.awt.event.ActionEvent evt) {
		
		if(getTitleField().getText().equals("") || getDescriptionField().getText().equals("")){
			
			getMsgLabel().setText("Some fields are still empty!");
			
		}else{
			
			picture.changeTitle(getTitleField().getText());
			picture.changeCaption(getDescriptionField().getText());
			
			if(picture.getId() == -1){ // album not yet in database, produce an INSERT query
				
				picture.generateSqlInsertQuery();
				
			}else{ // album already in database, just UPDATE it
				
				picture.generateSqlUpdateQuery();
				
			}
			
			getGallerySaver().saveGallery(getJCpgUIReference().getGallery()); // save current gallery state

			this.dispose();
			getJCpgUIReference().setEnabled(true);
			
		}
		
		getGallerySaver().saveGallery(getJCpgUIReference().getGallery()); // save current gallery state
		
	}

}
