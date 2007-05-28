package be.khleuven.frank.JCpg.Manager;
import java.io.Serializable;

import javax.swing.ImageIcon;
import javax.swing.tree.DefaultMutableTreeNode;

import be.khleuven.frank.JCpg.Components.JCpgAlbum;
import be.khleuven.frank.JCpg.Interfaces.JCpgAddTreeEntryInterface;
import be.khleuven.frank.JCpg.UI.JCpgUI;



public class JCpgEditAlbumManager extends JCpgEditManager implements JCpgAddTreeEntryInterface, Serializable {
	
	
																					
																					//*************************************
																					//				VARIABLES	          *
																					//*************************************
	private JCpgAlbum album;

	
	
	
	
																					
																					//*************************************
																					//				CONSTRUCTOR           *
																					//*************************************
	/**
	 * 
	 * Make a new JCpgEditAlbumManager object
	 * 
	 * @param jCpgUIReference
	 * 		a reference to the UI
	 * @param logo
	 * 		path to edit logo
	 * @param node
	 * 		currently selected node
	 */
	public JCpgEditAlbumManager(JCpgUI jCpgUIReference, ImageIcon logo, DefaultMutableTreeNode node) {
		
		super(jCpgUIReference, logo, node);
		setAlbum();
		makeEditWindowChanges();
		
	}
	
	
	
	
																					
																					//*************************************
																					//				SETTERS		          *
																					//*************************************
	/**
	 * 
	 * Set currently selected album
	 *
	 */
	private void setAlbum(){
		
		this.album = (JCpgAlbum)getNode().getUserObject();
		
	}
	
	
	
	
	
	
																					//*************************************
																					//				EVENTS		          *
																					//*************************************
	/**
	* 
	* Perform right actions when pressing the create button
	* 
	*/
	public void createActionPerformed(java.awt.event.ActionEvent evt) {
	
		if(getTitleField().getText().equals("") || getDescriptionField().getText().equals("")){
		
			getMsgLabel().setText("Some fields are still empty!");
			
		}else{
			
			album.changeName(getTitleField().getText());
			album.changeDescription(getDescriptionField().getText());
			
			if(album.getId() == -1){ // album not yet in database, produce an INSERT query
			
				album.generateSqlInsertQuery();
			
			}else{ // album already in database, just UPDATE it
			
				album.generateSqlUpdateQuery();
			
			}
			
			getGallerySaver().saveGallery(getJCpgUIReference().getGallery()); // save current gallery state
		
			this.dispose();
			getJCpgUIReference().setEnabled(true);
		
		}
		
		getGallerySaver().saveGallery(getJCpgUIReference().getGallery()); // save current gallery state
	
	}



	
	
	
	
	
																					//*************************************
																					//				MUTATORS & OTHERS	  *
																					//*************************************
	/**
	 * 
	 * Make some extra swing stuff specificly for this window
	 *
	 */
	private void makeEditWindowChanges(){
		
		getTitleField().setText(album.getName());
		getDescriptionField().setText(album.getDescription());
		
	}

}
