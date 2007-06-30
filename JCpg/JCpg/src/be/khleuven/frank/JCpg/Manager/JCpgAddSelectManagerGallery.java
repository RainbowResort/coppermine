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
public class JCpgAddSelectManagerGallery extends JCpgAddSelectManager {
	
	private String[] options = null;
	
	
	
	
	public JCpgAddSelectManagerGallery(JCpgUI jCpgUIReference, ImageIcon logo, DefaultMutableTreeNode node, String[] options){
		
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
