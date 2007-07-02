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

import javax.swing.ImageIcon;
import javax.swing.tree.DefaultMutableTreeNode;

import be.khleuven.frank.JCpg.Components.JCpgPicture;
import be.khleuven.frank.JCpg.UI.JCpgUI;



/**
 * Edit picture manager
 * @author    Frank Cleynen
 */
public class JCpgEditPictureManager extends JCpgEditManager {
	
	
	
	
																							
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
		
		if(getTitleField().getText().equals("")){
			
			getMsgLabel().setText("An empty title is not allowed");
			
		}else{
			
			picture.changeTitle(getTitleField().getText());
			picture.changeCaption(getDescriptionField().getText());
			
			if(picture.getId() == -1){ // album not yet in database, produce an INSERT query
				
				picture.generateSqlInsertQuery();
				
			}else{ // album already in database, just UPDATE it
				
				picture.generateSqlUpdateQuery();
				
			}
			
			getGallerySaver().saveGallery(); // save current gallery state

			this.dispose();
			getJCpgUIReference().setEnabled(true);
			
		}
		
		getGallerySaver().saveGallery(); // save current gallery state
		
	}

}
