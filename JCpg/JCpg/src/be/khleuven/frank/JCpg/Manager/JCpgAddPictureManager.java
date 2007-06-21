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

import be.khleuven.frank.JCpg.Components.JCpgAlbum;
import be.khleuven.frank.JCpg.Components.JCpgPicture;
import be.khleuven.frank.JCpg.Configuration.JCpgConfig;
import be.khleuven.frank.JCpg.Interfaces.JCpgAddTreeEntryInterface;
import be.khleuven.frank.JCpg.JCpgAllowedExtensionFilter;
import be.khleuven.frank.JCpg.Resize.JCpgPictureResizer;
import be.khleuven.frank.JCpg.Sync.JCpgPictureTransferer;
import be.khleuven.frank.JCpg.UI.JCpgFilechooserImagePreview;
import be.khleuven.frank.JCpg.UI.JCpgUI;
import java.awt.Dimension;
import java.awt.Toolkit;
import java.io.File;
import java.io.Serializable;
import java.util.Date;
import javax.swing.ImageIcon;
import javax.swing.JFileChooser;
import javax.swing.SwingUtilities;
import javax.swing.tree.DefaultMutableTreeNode;


/**
 * Add picture manager We need to do a change to the default add manager's size because we need to integrate a filechooser. This way, users can import as many pictures as they want with just one click.
 * @author    Frank Cleynen
 */
public class JCpgAddPictureManager extends JCpgAddManager implements JCpgAddTreeEntryInterface, Serializable {

	
	
	
																									//*************************************
																									//				VARIABELS             *
																									//*************************************
	private JCpgConfig cpgConfig;
	
	private JFileChooser pictureChooser;
	
	private Dimension screensize;
	
	
	
	
																									//*************************************
																									//				CONSTRUCTORS          *
																									//*************************************
	/**
	 * 
	 * Makes a new JCpgAddPictureManager object
	 * 
	 * @param jCpgUIReference
	 * 		reference to the UI
	 * @param cpgConfig
	 * 		reference to the current configuration
	 * @param logo
	 * 		path to add picture logo
	 * @param node
	 * 		the currently selected node
	 */
	public JCpgAddPictureManager(JCpgUI jCpgUIReference, JCpgConfig cpgConfig, ImageIcon logo, DefaultMutableTreeNode node){
		
		super(jCpgUIReference, logo, node);
		setCpgConfig(cpgConfig);
		doExtraSwingComponents();
		
	}
	
	
	
	
																									//*************************************
																									//				SETTERS		          *
																									//*************************************
	/**
	 * 
	 * Set the current configuration
	 * 
	 * @param cpgConfig
	 * 		the current configuration
	 */
	private void setCpgConfig(JCpgConfig cpgConfig){
		
		this.cpgConfig = cpgConfig;
		
	}
	
	
	
	
	
																									//*************************************
																									//				GETTERS		          *
																									//*************************************
	/**
	 * 
	 * Get the current configuration
	 * 
	 * @return
	 * 		the current configuration
	 */
	public JCpgConfig getCpgConfig(){
		
		return this.cpgConfig;
		
	}
	/**
	 * 
	 * Get the filechooser
	 * 
	 * @return
	 * 		the filechooser
	 */
	public JFileChooser getFileChooser(){
		
		return this.pictureChooser;
		
	}
	
	
	

																									
																									//*************************************
																									//				MUTATORS & OTHERS     *
																									//*************************************
	/**
	 * 
	 * Do extra swing stuff specifically for the add picture window: we need a browe button so the user can choose a picture
	 *
	 */
	private void doExtraSwingComponents(){
		
		screensize = Toolkit.getDefaultToolkit().getScreenSize();
		this.setBounds((int)(screensize.getWidth()/2)-250, (int)(screensize.getHeight()/2)-250, 500, 500);
		
		pictureChooser = new JFileChooser();
		pictureChooser.setFileFilter(new JCpgAllowedExtensionFilter(getCpgConfig()));
		pictureChooser.setMultiSelectionEnabled(true);
		pictureChooser.setBounds(0, 100, 495, 345);
		
		JCpgFilechooserImagePreview imagePreview = new JCpgFilechooserImagePreview();
		
		pictureChooser.setAccessory(imagePreview); // add picture preview when adding pictures
		pictureChooser.addPropertyChangeListener(imagePreview);
		
		getCreateButton().setText("Add");
		getCreateButton().setBounds(70, 450, 100, 30);
		
		getCloseButton().setBounds(180, 450, 100, 30);
		
		this.getContentPane().add(pictureChooser);
		
	}
	
	
	
	
	
																									//*************************************
																									//				EVENTS			      			*
																									//*************************************	
	/**
	* 
	* Perform right actions when create button is clicked.
	* 
	*/
	public void createActionPerformed(java.awt.event.ActionEvent evt) {
				
		JCpgAlbum album = (JCpgAlbum) getNode().getUserObject();

		File[] selectedFiles = pictureChooser.getSelectedFiles();

		if (selectedFiles.length > 0) { // only proceed if user selected file(s)

			JCpgProgressManager progress = new JCpgProgressManager(this,selectedFiles.length - 1, "data/updater_logo.jpg", false,true); // new progress manager

			for (int i = 0; i < selectedFiles.length; i++) {

				// make new picture
				ImageIcon image = new ImageIcon(selectedFiles[i].getAbsolutePath()); // for width and height
				File source = new File(selectedFiles[i].getAbsolutePath());
				File destination = new File(getCpgConfig().getValueFor("fullpath") + "userpics/10001/" + selectedFiles[i].getName());
				JCpgPictureTransferer transferer = new JCpgPictureTransferer();
				long filesize = 0;

				try {

					filesize = transferer.copyFile(source, destination); // copy picture locally
					JCpgPictureResizer thumb = new JCpgPictureResizer(getJCpgUIReference(), getCpgConfig().getValueFor("fullpath")+ "userpics/10001/", selectedFiles[i].getName());
					thumb.makeThumb();

				} catch (Exception e) {

					System.out.println("JCpgAddPictureManager: couldn't copy picture to local Cpg");

				}

				Date date = new Date(); // used to get number of seconds since 1970 for ctime

				JCpgPicture picture = new JCpgPicture(getJCpgUIReference().getUserConfig(), -1, album.getId(), "userpics/10001/",selectedFiles[i].getName(), (int) filesize,(int) filesize, image.getIconWidth(), image.getIconHeight(), 0, (int) date.getTime(), 0,"", 0, 0, getTitleField().getText(),getDescriptionField().getText(), "", true, 0, 0, 0);

				picture.generateSqlInsertQuery();

				album.addPicture(picture);
				DefaultMutableTreeNode newNode = new DefaultMutableTreeNode(picture);
				getNode().add(newNode);

				getGallerySaver().saveGallery(getJCpgUIReference().getGallery()); // save current gallery state

				progress.changeProgressbarValue(i);

				SwingUtilities.updateComponentTreeUI(getJCpgUIReference().getTree()); // workaround for java bug 4173369

			}

			progress.dispose();

		}

		getJCpgUIReference().setEnabled(true);
		this.dispose();
		
	}
		
}
