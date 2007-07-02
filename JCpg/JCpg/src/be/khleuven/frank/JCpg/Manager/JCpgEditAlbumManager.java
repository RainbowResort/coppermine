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

import be.khleuven.frank.JCpg.Components.JCpgAlbum;
import be.khleuven.frank.JCpg.Interfaces.JCpgAddTreeEntryInterface;
import be.khleuven.frank.JCpg.UI.JCpgUI;


/**
 * Edit album manager
 * @author    Frank Cleynen
 */
public class JCpgEditAlbumManager extends JCpgEditManager implements JCpgAddTreeEntryInterface {
	
	
																					
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
	
		if(getTitleField().getText().equals("")){
		
			getMsgLabel().setText("An empty title is not allowed");
			
		}else{
			
			album.changeName(getTitleField().getText());
			album.changeDescription(getDescriptionField().getText());
			
			if(album.getId() == -1){ // album not yet in database, produce an INSERT query
			
				album.generateSqlInsertQuery();
			
			}else{ // album already in database, just UPDATE it
			
				album.generateSqlUpdateQuery();
			
			}
			
			getGallerySaver().saveGallery(); // save current gallery state
		
			this.dispose();
			getJCpgUIReference().setEnabled(true);
		
		}
		
		getGallerySaver().saveGallery(); // save current gallery state
	
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
