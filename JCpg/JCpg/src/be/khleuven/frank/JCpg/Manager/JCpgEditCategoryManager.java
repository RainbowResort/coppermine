/*
Copyright (C) 2997  Frank Cleynen
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

import java.io.Serializable;

import javax.swing.ImageIcon;
import javax.swing.tree.DefaultMutableTreeNode;

import be.khleuven.frank.JCpg.Components.JCpgCategory;
import be.khleuven.frank.JCpg.UI.JCpgUI;


/**
 * 
 * 
 * Edit category manager
 * 
 * @author Frank Cleynen
 *
 */
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
