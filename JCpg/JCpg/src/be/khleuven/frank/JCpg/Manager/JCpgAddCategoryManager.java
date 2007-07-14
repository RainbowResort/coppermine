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
public class JCpgAddCategoryManager extends JCpgAddManager implements JCpgAddTreeEntryInterface {

	
	
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
		
		Object object = getNode().getUserObject();
		
		JCpgGallery parent = null;
		
		if(object.getClass().equals(JCpgGallery.class)){
		
			parent = (JCpgGallery)getNode().getUserObject();
			
		}else if(object.getClass().equals(JCpgCategory.class)){
		
			parent = (JCpgCategory)getNode().getUserObject();
			
		}
		
		// title empty?
		if(titleField.getText().equals("")){
			
			getMsgLabel().setText("Title is empty !!");
			
			return;
			
		}
		
		// check duplicate
		for(int i=0; i<parent.getCategories().size(); i++){
			
			if(parent.getCategories().get(i).getName().equals(titleField.getText())){
				
				getMsgLabel().setText("Category already exists. Choose a different name.");
				
				return;
				
			}
			
		}
		
		// make new category
		JCpgCategory category = new JCpgCategory(-1, -1, getTitleField().getText(), getDescriptionField().getText(), -1, 0, 0);
		
		category.addUi(super.getJCpgUIReference());
		
		parent.addCategory(category);
		DefaultMutableTreeNode newNode = new DefaultMutableTreeNode(category);
		getNode().add(newNode);
		SwingUtilities.updateComponentTreeUI(getJCpgUIReference().getTree()); // workaround for Java bug 4173369
		
		getGallerySaver().saveGallery(); // save current gallery state
		
		getJCpgUIReference().setEnabled(true);
		this.dispose();
		
	}
	
}
