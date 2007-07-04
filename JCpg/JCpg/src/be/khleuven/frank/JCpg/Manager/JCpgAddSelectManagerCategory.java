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

import be.khleuven.frank.JCpg.JCpgImageUrlValidator;
import be.khleuven.frank.JCpg.UI.JCpgUI;

/**
 * 
 * Determines what can be added to the main gallery
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgAddSelectManagerCategory extends JCpgAddSelectManager {
	
	private String[] options = null;
	
	
	
	
	public JCpgAddSelectManagerCategory(JCpgUI jCpgUIReference, ImageIcon logo, DefaultMutableTreeNode node, String[] options){
		
		super(jCpgUIReference, logo, node);
		
		setOptions(options);
		
		fillOptionList();
		
	}
	
	
	private void setOptions(String[] options){
		
		this.options = options;
		
	}
	
	
	public String[] getOptions(){
		
		return this.options;
		
	}
	
	public void fillOptionList(){
		
		String[] options = getOptions();
		
		for(int i=0; i<options.length; i++){
			
			getOptionList().addItem(options[i]);
			
		}
		
	}
	
	
	
	
	/**
	* 
	* Perform right actions when create button is clicked
	* 
	*/
	public void createActionPerformed(java.awt.event.ActionEvent evt) {
		
		if(getOptionList().getSelectedItem().equals("category")){
			
			new JCpgAddCategoryManager(getJCpgUIReference(), new JCpgImageUrlValidator("data/createcategory_logo.jpg").createImageIcon(), getNode());
			this.dispose();
			
		}else if(getOptionList().getSelectedItem().equals("album")){
			
			new JCpgAddAlbumManager(getJCpgUIReference(), new JCpgImageUrlValidator("data/createalbum_logo.jpg").createImageIcon(), getNode());
			this.dispose();
			
		}
		
	}

	
}

