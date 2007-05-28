package be.khleuven.frank.JCpg.Manager;
import java.io.Serializable;

import javax.swing.ImageIcon;
import javax.swing.SwingUtilities;
import javax.swing.tree.DefaultMutableTreeNode;

import be.khleuven.frank.JCpg.Components.JCpgAlbum;
import be.khleuven.frank.JCpg.Components.JCpgCategory;
import be.khleuven.frank.JCpg.Interfaces.JCpgAddTreeEntryInterface;
import be.khleuven.frank.JCpg.UI.JCpgUI;


/**
 * 
 * Add album manager
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgAddAlbumManager extends JCpgAddManager implements JCpgAddTreeEntryInterface, Serializable {
	
	
																	
																			//*************************************
																			//				CONSTRUCTOR           *
																			//*************************************
	/**
	 * 
	 * Makes a new screen for adding an album to the selected category.
	 * 
	 * @param jCpgUIReference
	 * 		reference to the UI object
	 * @param logo
	 * 		path to the logo that has to be used
	 * @param node
	 * 		the currently selected node and parent of this object
	 */
	public JCpgAddAlbumManager(JCpgUI jCpgUIReference, ImageIcon logo, DefaultMutableTreeNode node){
		
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
		
		JCpgCategory category = (JCpgCategory)getNode().getUserObject();
		
		// title empty?
		if(titleField.getText().equals("")){
			
			getMsgLabel().setText("Title is empty !!");
			return;
			
		}
		
		// check duplicate
		for(int i=0; i<category.getAlbums().size(); i++){
			
			if(category.getAlbums().get(i).getName().equals(titleField.getText())){
				
				getMsgLabel().setText("Album already exists. Choose a different name.");
				return;
				
			}
			
		}
		
		// make new album
		JCpgAlbum album = new JCpgAlbum(getJCpgUIReference().getUserConfig(), -1, getTitleField().getText(), getDescriptionField().getText(), 0, true, true, true, 0, category.getId(), 0, getDescriptionField().getText(), "", "");
		
		album.generateSqlInsertQuery();
		
		category.addAlbum(album);
		DefaultMutableTreeNode newNode = new DefaultMutableTreeNode(album);
		getNode().add(newNode);
		SwingUtilities.updateComponentTreeUI(getJCpgUIReference().getTree()); // workaround for Java bug 4173369
		
		getGallerySaver().saveGallery(getJCpgUIReference().getGallery()); // save current gallery state
		
		getJCpgUIReference().setEnabled(true);
		this.dispose();
		
	}
	
}
