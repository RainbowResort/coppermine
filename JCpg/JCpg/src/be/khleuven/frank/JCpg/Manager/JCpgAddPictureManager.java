package be.khleuven.frank.JCpg.Manager;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;
import java.io.Serializable;
import java.util.Date;

import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFileChooser;
import javax.swing.JLabel;
import javax.swing.SwingUtilities;
import javax.swing.tree.DefaultMutableTreeNode;

import be.khleuven.frank.JCpg.JCpgAllowedExtensionFilter;
import be.khleuven.frank.JCpg.Components.JCpgAlbum;
import be.khleuven.frank.JCpg.Components.JCpgPicture;
import be.khleuven.frank.JCpg.Configuration.JCpgConfig;
import be.khleuven.frank.JCpg.Interfaces.JCpgAddTreeEntryInterface;
import be.khleuven.frank.JCpg.Resize.JCpgPictureResizer;
import be.khleuven.frank.JCpg.Sync.JCpgPictureTransferer;
import be.khleuven.frank.JCpg.UI.JCpgUI;


/**
 * 
 * Add picture manager
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgAddPictureManager extends JCpgAddManager implements JCpgAddTreeEntryInterface, Serializable {

	
	
	
																									//*************************************
																									//				VARIABELS             *
																									//*************************************
	JCpgConfig cpgConfig;
	
	JFileChooser pictureChooser;
	JLabel pictureStatus;
	JButton browse;
	
	
	
	
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
		
		pictureStatus = new JLabel();
		pictureStatus.setBounds(180, 91, 250, 20);
		
		browse = new JButton("Choose file");
		browse.setBounds(70, 91, 100, 30);
		
		this.getContentPane().add(pictureStatus);
		this.getContentPane().add(browse);
		
		browse.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				browseActionPerformed(evt);
			}
		});
		
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
		
		JCpgAlbum album = (JCpgAlbum)getNode().getUserObject();
		
		// title empty?
		if(getTitleField().getText().equals("")){
			
			getMsgLabel().setText("Title is empty !!");
			return;
			
		}
		
		// no file choosen
		if(pictureStatus.getText().equals("")){
			
			getMsgLabel().setText("No file choosen !!");
			return;
			
		}
		
		// check duplicate
		for(int i=0; i<album.getPictures().size(); i++){
			
			if(album.getPictures().get(i).getName().equals(titleField.getText())){
				
				getMsgLabel().setText("Picture already exists. Choose a different name.");
				return;
				
			}
			
		}
		
		// make new picture
		ImageIcon image = new ImageIcon(getFileChooser().getSelectedFile().getAbsolutePath()); // for width and height
		File source = new File(getFileChooser().getSelectedFile().getAbsolutePath());
		File destination = new File(getCpgConfig().getValueFor("fullpath") + "userpics/10001/" + getFileChooser().getSelectedFile().getName());
		JCpgPictureTransferer transferer = new JCpgPictureTransferer();
		long filesize = 0;
		
		try {
			
			filesize = transferer.copyFile(source, destination); // copy picture locally
			JCpgPictureResizer thumb = new JCpgPictureResizer(getJCpgUIReference(), getCpgConfig().getValueFor("fullpath") + "userpics/10001/", getFileChooser().getSelectedFile().getName());
			//thumb.makeThumb(getJCpgUIReference().getThumbnailPreferredSize()); memory error
			
		} catch (Exception e) {
			
			System.out.println("JCpgAddPictureManager: couldn't copy picture to local Cpg");
			
		}
		
		Date date = new Date(); // used to get number of seconds since 1970 for ctime
	    
		JCpgPicture picture = new JCpgPicture(getJCpgUIReference().getUserConfig(), -1, album.getId(), "userpics/10001/", getFileChooser().getSelectedFile().getName(), (int)filesize, (int)filesize, image.getIconWidth(), image.getIconHeight(), 0, (int)date.getTime(), 0, "", 0, 0, getTitleField().getText(), getDescriptionField().getText(), "", true, 0, 0, 0);
		
		picture.generateSqlInsertQuery();
		
		album.addPicture(picture);
		DefaultMutableTreeNode newNode = new DefaultMutableTreeNode(picture);
		getNode().add(newNode);
		SwingUtilities.updateComponentTreeUI(getJCpgUIReference().getTree()); // workaround for Java bug 4173369
		
		getGallerySaver().saveGallery(getJCpgUIReference().getGallery()); // save current gallery state
		
		getJCpgUIReference().setEnabled(true);
		this.dispose();
		
	}
	
	/**
	 * 
	 * Actions when the user pushes the 'choose file' button. We fire up a new filechooser with a correct filter attachted to it. The allowed extension we get from the Cpg configuration.
	 * 
	 */
	public void browseActionPerformed(java.awt.event.ActionEvent evt) {
		
		pictureChooser = new JFileChooser();
		
		JCpgAllowedExtensionFilter filter = new JCpgAllowedExtensionFilter(getCpgConfig());
		pictureChooser.setFileFilter(filter);
		
		int returnVal = pictureChooser.showOpenDialog(this);
	    
		if(returnVal == JFileChooser.APPROVE_OPTION) {
			
			pictureStatus.setText(pictureChooser.getSelectedFile().getName());
			
	    }
		
	}
		
}
