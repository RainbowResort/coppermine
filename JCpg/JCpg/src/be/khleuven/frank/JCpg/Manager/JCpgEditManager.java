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

import be.khleuven.frank.JCpg.Interfaces.JCpgAddTreeEntryInterface;
import be.khleuven.frank.JCpg.UI.JCpgUI;


/**
 * 
 * Uses the addmanager but makes some changes so it can be used as an edit manager. While the addmanager only produces INSERT sql queries, the edit manager can produce both INSERT and
 * UPDATE sql queries depending on what the id is of an object.
 * If the user edits a tree node and the id of this object is -1, it means it hasn't been put into the database yet. This is because we can't give an id to the object ourselves. We first have
 * to put it in the database, there it will get an id and we will retrieve it back.
 * If the id is not -1, the edit manager will produce an update query;
 * 
 * @author Frank Cleynen
 *
 */
public abstract class JCpgEditManager extends JCpgAddManager implements JCpgAddTreeEntryInterface {

	
	
	
																		
																			//*************************************
																			//				CONSTRUCTOR	          *
																			//*************************************
	/**
	 * 
	 * Makes a new JCpgEditManager object
	 * 
	 * @param jCpgUIReference
	 * 		reference to the UI
	 * @param logo
	 * 		logo for editing screen
	 * @param node
	 * 		current selected node
	 */
	public JCpgEditManager(JCpgUI jCpgUIReference, ImageIcon logo, DefaultMutableTreeNode node){
		
		super(jCpgUIReference, logo, node);
		
		makeEditWindowChanges();
		
	}
	
	
	
	
	
																		
																			//*************************************
																			//				MUTATORS & OTHERS	  *
																			//*************************************
	/**
	 * 
	 * Make additional swing stuff specifically for this edit screen
	 *
	 */
	private void makeEditWindowChanges(){
		
		
		getCreateButton().setText("Apply");
		
		
	}
	
	
	
	
																		
																			//*************************************
																			//				EVENTS		          *
																			//*************************************
	/**
	 * 
	 * Perform the right actions when the user presses the edit button
	 * 
	 */
	public void createActionPerformed(java.awt.event.ActionEvent evt){
		
	}
	
}
