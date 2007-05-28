package be.khleuven.frank.JCpg.Manager;
import java.io.Serializable;

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
 * @author frank
 *
 */
public abstract class JCpgEditManager extends JCpgAddManager implements JCpgAddTreeEntryInterface, Serializable {

	
	
	
																		
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
