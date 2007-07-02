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

package be.khleuven.frank.JCpg.UI;

import java.awt.Color;
import java.awt.Dimension;
import java.awt.FlowLayout;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.Enumeration;

import javax.swing.DefaultListModel;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JList;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JSplitPane;
import javax.swing.JTree;
import javax.swing.ListSelectionModel;
import javax.swing.SwingUtilities;
import javax.swing.border.EtchedBorder;
import javax.swing.event.TreeSelectionEvent;
import javax.swing.event.TreeSelectionListener;
import javax.swing.tree.DefaultMutableTreeNode;
import javax.swing.tree.DefaultTreeCellRenderer;
import javax.swing.tree.TreePath;
import javax.swing.tree.TreeSelectionModel;

import be.khleuven.frank.JCpg.JCpgImageUrlValidator;
import be.khleuven.frank.JCpg.Components.JCpgAlbum;
import be.khleuven.frank.JCpg.Components.JCpgCategory;
import be.khleuven.frank.JCpg.Components.JCpgGallery;
import be.khleuven.frank.JCpg.Components.JCpgPicture;
import be.khleuven.frank.JCpg.Configuration.JCpgConfig;
import be.khleuven.frank.JCpg.Configuration.JCpgUserConfig;
import be.khleuven.frank.JCpg.Editor.JCpgEditor_colors;
import be.khleuven.frank.JCpg.Editor.JCpgEditor_crop;
import be.khleuven.frank.JCpg.Editor.JCpgEditor_resize;
import be.khleuven.frank.JCpg.Editor.JCpgEditor_rotate;
import be.khleuven.frank.JCpg.Manager.JCpgAddPictureManager;
import be.khleuven.frank.JCpg.Manager.JCpgAddSelectManagerCategory;
import be.khleuven.frank.JCpg.Manager.JCpgAddSelectManagerGallery;
import be.khleuven.frank.JCpg.Manager.JCpgEditAlbumManager;
import be.khleuven.frank.JCpg.Manager.JCpgEditCategoryManager;
import be.khleuven.frank.JCpg.Manager.JCpgEditPictureManager;
import be.khleuven.frank.JCpg.Manager.JCpgSqlManager;
import be.khleuven.frank.JCpg.Manager.JCpgUserManager;
import be.khleuven.frank.JCpg.Previewer.JCpgPreviewer;
import be.khleuven.frank.JCpg.Save.JCpgGallerySaver;
import be.khleuven.frank.JCpg.Sync.JCpgSyncer;


/**
 * Complete JCpg UI
 * @author    Frank Cleynen
 */
public class JCpgUI extends JFrame implements TreeSelectionListener{
	
	
	
	
																	//*************************************
																	//				VARIABLES             *
																	//*************************************
	private JCpgUserConfig userConfig;
	private JCpgSqlManager sqlManager;
	private JCpgConfig cpgConfig;
	private JCpgUI globalUi = this;
	
	private static JCpgGallery gallery = new JCpgGallery("My Coppermine Gallery", "Default gallery"); // default static gallery to store all catgories and albums

	private Dimension screensize;
	private Dimension framesize;
	private Dimension buttonPreferredSize;
	private Dimension thumbnailPreferredSize;
	
	private boolean onlinemode = false; // false if we work offline, true if we work online
	private boolean megaExplorerActive = false; // when in mega explorer mode, only the tree and one big list with many rows of photo's is visible. If a photo is selected, we switch to one row of photo's at the top with the explorer below
	private boolean isSyncing; // used to synchronise syncing threads
	
	private JSplitPane splitPane;
	private JSplitPane megaSplitPane;
	
	private JList pictureList;
	private ListSelectionModel pictureListSelectionModel;
	private DefaultListModel pictureListModel;
	private JPanel explorer;
	private JPanel tools;
	private JPanel albumcontrol;
	private JScrollPane explorerscroll;
	private JButton edit_crop;
	private JButton edit_colorcorrection;
	private JButton edit_resize;
	private JButton edit_rotate;
	private JButton control_new;
	private JButton control_delete;
	private JButton control_sync;
	private JButton control_edit;
	private JButton control_preview;
	private JButton closeMegaExplorer;
	private JTree tree;
	private JScrollPane treeView;
	private JScrollPane megaTreeView;
	private JScrollPane pictureView;
	private JScrollPane megaPictureView;
	private DefaultMutableTreeNode root;
	
	
	
	
	
	
	
																	//*************************************
																	//				CONSTRUCTORS          *
																	//*************************************
	/**
	 * 
	 * Makes a new JCpgInterface object
	 * 
	 * @param megaExplorerActive
	 * 		true if we go in to mega explorer mode, else false
	 *
	 */
	public JCpgUI(boolean megaExplorerActive){
		
		setMegaExplorerActive(megaExplorerActive);
		initComponents();
		boundComponents();
		placeComponents();
		controlMegaExplorerActive();
		getGallery().addUi(this);
		new JCpgUserManager(500, 200, this);
		
	}
	
	
	
	
	
	/**
	 * 
	 * Set the megaExplorerActive flag
	 * 
	 * @param megaExplorerActive
	 * 		true if we want a mega explorer view (tree with one big list of photo's)
	 * 		false if we want tree with one row of photo's and explorer below (used when photo is selected)
	 */
	private void setMegaExplorerActive(boolean megaExplorerActive){
		
		this.megaExplorerActive = megaExplorerActive;
		
	}
	
	
	
	
	
	
	
																	//*************************************
																	//				SWING	              *
																	//*************************************
	/**
	 * 
	 * Init swing components
	 * 
	 */
	private void initComponents(){
		
		this.setLayout(null);
		super.setName("JCpg");
		
		screensize = Toolkit.getDefaultToolkit().getScreenSize();
		buttonPreferredSize = new Dimension(30, 30);
		thumbnailPreferredSize = new Dimension(100, 100);
		
		pictureListModel = new DefaultListModel();
		pictureList = new JList(pictureListModel);
		pictureList.setBorder(new EtchedBorder());
		pictureListSelectionModel = pictureList.getSelectionModel();
		pictureList.setCellRenderer(new JCpgPictureCellRenderer());
		
		pictureView = new JScrollPane(pictureList);
		megaPictureView = new JScrollPane();
		megaPictureView.setBackground(new Color(230, 230, 230));
		explorerscroll = new JScrollPane(explorer);
		
		explorer = new JPanel();
		explorer.setBackground(new Color(230, 230, 230));
		tools = new JPanel();
		tools.setBackground(new Color(168, 168, 168));
		albumcontrol = new JPanel();
		albumcontrol.setBackground(new Color(168, 168, 168));
		
		edit_crop = new JButton();
		edit_crop.setIcon(new JCpgImageUrlValidator("data/edit_cut.jpg").createImageIcon());
		edit_crop.setToolTipText("Cut");
		edit_crop.setBackground(new Color(168, 168, 168));
		edit_colorcorrection = new JButton();
		edit_colorcorrection.setIcon(new JCpgImageUrlValidator("data/edit_colors.jpg").createImageIcon());
		edit_colorcorrection.setToolTipText("Correct colors");
		edit_colorcorrection.setBackground(new Color(168, 168, 168));
		edit_resize = new JButton();
		edit_resize.setIcon(new JCpgImageUrlValidator("data/edit_resize.jpg").createImageIcon());
		edit_resize.setToolTipText("Resize");
		edit_resize.setBackground(new Color(168, 168, 168));
		edit_rotate = new JButton();
		edit_rotate.setIcon(new JCpgImageUrlValidator("data/edit_rotate.jpg").createImageIcon());
		edit_rotate.setToolTipText("Rotate");
		edit_rotate.setBackground(new Color(168, 168, 168));
		control_new = new JButton();
		control_new.setIcon(new JCpgImageUrlValidator("data/album_add.jpg").createImageIcon());
		control_new.setToolTipText("New album");
		control_new.setBackground(new Color(168, 168, 168));
		control_delete = new JButton();
		control_delete.setIcon(new JCpgImageUrlValidator("data/album_delete.jpg").createImageIcon());
		control_delete.setToolTipText("Delete album");
		control_sync = new JButton();
		control_sync.setIcon(new JCpgImageUrlValidator("data/sync.gif").createImageIcon());
		control_sync.setToolTipText("Sync your gallery");
		control_sync.setBackground(new Color(168, 168, 168));
		control_edit = new JButton();
		control_edit.setIcon(new JCpgImageUrlValidator("data/edit.gif").createImageIcon());
		control_edit.setToolTipText("Edit");
		control_edit.setBackground(new Color(168, 168, 168));
		control_preview = new JButton();
		control_preview.setIcon(new JCpgImageUrlValidator("data/control_preview.gif").createImageIcon());
		control_preview.setToolTipText("Preview Album");
		control_preview.setBackground(new Color(168, 168, 168));
		closeMegaExplorer = new JButton();
		closeMegaExplorer.setIcon(new JCpgImageUrlValidator("data/close.jpg").createImageIcon());
		closeMegaExplorer.setToolTipText("Close view");
		closeMegaExplorer.setBackground(new Color(168, 168, 168));
		
		root = new DefaultMutableTreeNode(gallery);
		tree = new JTree(root);
		tree.getSelectionModel().setSelectionMode(TreeSelectionModel.DISCONTIGUOUS_TREE_SELECTION);
		tree.addTreeSelectionListener(this);
		tree.setBackground(new Color(230, 237, 248));
		DefaultTreeCellRenderer renderer = (DefaultTreeCellRenderer)tree.getCellRenderer();
		treeView = new JScrollPane(tree);
		treeView.setMinimumSize(new Dimension(200, 400));
		treeView.setBackground(new Color(230, 237, 248));
		megaTreeView = new JScrollPane();
		megaTreeView.setMinimumSize(new Dimension(200, 501));
		megaTreeView.setBackground(new Color(230, 237, 248));
		
		splitPane = new JSplitPane(JSplitPane.HORIZONTAL_SPLIT, treeView, explorer);
		megaSplitPane = new JSplitPane(JSplitPane.HORIZONTAL_SPLIT, megaTreeView, megaPictureView);
		
		pictureListSelectionModel.addListSelectionListener(new javax.swing.event.ListSelectionListener() {
            public void valueChanged(javax.swing.event.ListSelectionEvent evt) {
                pictureListValueChanged(evt);
            }
        });
		
		control_new.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				control_newActionPerformed(evt);
			}
		});
		
		control_delete.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				control_deleteActionPerformed(evt);
			}
		});
		
		control_sync.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				syncActionPerformed(evt);
			}
		});
		
		control_edit.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				control_editActionPerformed(evt);
			}
		});
		
		control_preview.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				control_previewActionPerformed(evt);
			}
		});
		
		edit_crop.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				edit_cropActionPerformed(evt);
			}
		});
		
		edit_colorcorrection.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				edit_colorcorrectionActionPerformed(evt);
			}
		});
		
		edit_resize.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				edit_resizeActionPerformed(evt);
			}
		});
		
		edit_rotate.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				edit_rotateActionPerformed(evt);
			}
		});
		
		closeMegaExplorer.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				closeMegaExplorerActionPerformed(evt);
			}
		});
		
	}
	/**
	 * 
	 * Size swing components
	 *
	 */
	private void boundComponents(){
		
		this.setBounds(0, 0, screensize.width, screensize.height);
		this.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		framesize = this.getSize();
		
		pictureView.setBounds(0, 0, framesize.width, 100);
		
		explorer.setBorder(new EtchedBorder());
		explorer.setLayout(new FlowLayout()); // give the thumbs a preferred size. The flowlayout manager will take care of the rest.
		tools.setBounds(200, framesize.height - 145, framesize.width - 200, 50);
		tools.setBorder(new EtchedBorder());
		tools.setLayout(new FlowLayout());
		albumcontrol.setBounds(0, framesize.height - 145, 200, 50);
		albumcontrol.setBorder(new EtchedBorder());
		albumcontrol.setLayout(new FlowLayout());
		
		splitPane.setBounds(0, 100, framesize.width, framesize.height - 245);
		megaSplitPane.setBounds(0, 0, framesize.width, framesize.height - 145);
		
		edit_crop.setPreferredSize(buttonPreferredSize);
		edit_colorcorrection.setPreferredSize(buttonPreferredSize);
		edit_resize.setPreferredSize(buttonPreferredSize);
		edit_rotate.setPreferredSize(buttonPreferredSize);
		closeMegaExplorer.setPreferredSize(buttonPreferredSize);
		
		control_new.setPreferredSize(buttonPreferredSize);
		control_delete.setPreferredSize(buttonPreferredSize);
		control_sync.setPreferredSize(buttonPreferredSize);
		control_edit.setPreferredSize(buttonPreferredSize);
		control_preview.setPreferredSize(buttonPreferredSize);
		
	}
	/**
	 * 
	 * Position swing components
	 *
	 */
	private void placeComponents(){
		
		this.getContentPane().add(pictureView);
		this.getContentPane().add(explorerscroll);
		tools.add(edit_rotate);
		tools.add(edit_crop);
		tools.add(edit_resize);
		tools.add(edit_colorcorrection);
		tools.add(closeMegaExplorer);
		this.getContentPane().add(tools);
		albumcontrol.add(control_sync);
		albumcontrol.add(control_new);
		albumcontrol.add(control_delete);
		albumcontrol.add(control_edit);
		albumcontrol.add(control_preview);
		this.getContentPane().add(albumcontrol);
		this.getContentPane().add(splitPane);
		this.getContentPane().add(megaSplitPane);
		this.setVisible(true);
		
	}
	
	
																	
	
	
	
																	//*************************************
																	//				GETTERS	              *
																	//*************************************
	/**
	 * 
	 * Get the UserConfig object
	 * 
	 * @return
	 * 		the UserConfig object
	 */
	public JCpgUserConfig getUserConfig(){
		
		return this.userConfig;
		
	}
	/**
	 * 
	 * Get a SqlManager reference for executing queries
	 * 
	 * @return
	 * 		SqlManager reference for executing queries
	 */
	public JCpgSqlManager getSqlManager(){
		
		return this.sqlManager;
		
	}
	/**
	 * 
	 * Get the current config
	 * 
	 * @return
	 * 		the current config
	 */
	public JCpgConfig getCpgConfig(){
		
		return this.cpgConfig;
		
	}
	/**
	 * 
	 * Get a reference to the gallery
	 * 
	 * @return
	 * 		a reference to the gallery
	 */
	public JCpgGallery getGallery(){
		
		return this.gallery;
		
	}
	/**
	 * 
	 * Get a reference to the tree
	 * 
	 * @return
	 * 		a reference to the tree
	 */
	public JTree getTree(){
		
		return this.tree;
		
	}
	/**
	 * 
	 * Get the preferred thumbnail size
	 * 
	 * @return
	 * 		the preferred thumbnail size
	 */
	public Dimension getThumbnailPreferredSize(){
		
		return this.thumbnailPreferredSize;
		
	}
	/**
	 * 
	 * Get a reference to the list of pictures
	 * 
	 * @return
	 * 		a reference to the list of pictures
	 */
	public JList getPictureList(){
		
		return this.pictureList;
		
	}
	/**
	 * 
	 * Get the current online mode
	 * 
	 * @return
	 * 		true if we are online, otherwhise false
	 */
	public boolean getOnlinemode(){
		
		return this.onlinemode;
		
	}
	/**
	 * 
	 * Get the megaExplorerActive flag
	 * 
	 * @return
	 * 		the megaExplorerActive flag
	 */
	public boolean getMegaExplorerActive(){
		
		return this.megaExplorerActive;
		
	}
	
	
	
	
	
	
	
	
																	
																	//*************************************
																	//				EVENTS			      *
																	//*************************************
	/**
	 * 
	 * When the user selects a different item in the picture list, perform the right actions: make a new button with the selected image in it and then add it to the explorer pane which has
	 * just been cleaned. The explorer pane has a flow layout manager so the button will alsways be placed correctly.
	 * 
	 * If the user selects a photo and we are in mega explorer view, exit mega explorer view
	 * 
	 */
	private void pictureListValueChanged(javax.swing.event.ListSelectionEvent evt) {
		
		if(getMegaExplorerActive()) changeMegaExplorerActive(false); // exit mega explorer view if needed
		
		JButton image = new JButton(); // make button with picture
		JCpgPicture selectedPicture = (JCpgPicture)pictureList.getSelectedValue();
		
		if(selectedPicture != null){
			
	    	image.setIcon(new JCpgImageUrlValidator("albums/" + selectedPicture.getFilePath() + selectedPicture.getFileName()).createImageIcon());
	    	image.setToolTipText(selectedPicture.getFileName());
	    	Dimension realSize = new Dimension(selectedPicture.getpWidth(), selectedPicture.getpHeight());
	    	image.setPreferredSize(realSize);
	    	
	    	getTree().addSelectionPath(selectedPicture.getTreePath());
	    	
	    	explorer.removeAll(); // add picture to explorer pane
	    	explorer.add(image);
	    	
	    	SwingUtilities.updateComponentTreeUI(explorer); // workaround for Java bug 4173369
	    	SwingUtilities.updateComponentTreeUI(getTree()); // workaround for Java bug 4173369
	    
		}
    	
	}
	/**
	 * 
	 * Action when user clicks on 'create new' button. Start up a new Album Manager object
	 * 
	 */
	private void control_newActionPerformed(java.awt.event.ActionEvent evt) {
		
		DefaultMutableTreeNode node = (DefaultMutableTreeNode)tree.getLastSelectedPathComponent();
		
		Object object = node.getUserObject();
		
		if (node == null){ // no node selected
			
	    	return;
	    	
		}else if(object.getClass().equals(JCpgGallery.class)){ // add category
			
			String[] options = {"album", "category"};
			new JCpgAddSelectManagerGallery(this, new JCpgImageUrlValidator("data/createcategory_logo.jpg").createImageIcon(), node, options);
		
		}else if(object.getClass().equals(JCpgCategory.class)){ // add album
			
			String[] options = {"album", "category"};
			new JCpgAddSelectManagerCategory(this, new JCpgImageUrlValidator("data/createcategory_logo.jpg").createImageIcon(), node, options);
		
		}else if(object.getClass().equals(JCpgAlbum.class)){ // add picture
			
			new JCpgAddPictureManager(this, getCpgConfig(), new JCpgImageUrlValidator("data/createpicture_logo.jpg").createImageIcon(), node);
		
		}
		
    }
	/**
	 * 
	 * Action when user clicks on 'delete' button. 
	 * 
	 */
	private void control_deleteActionPerformed(java.awt.event.ActionEvent evt) {
		
		//JCpgConfirmManager confirmManager = new JCpgConfirmManager(this, new JCpgImageUrlValidator("data/confirm_logo.jpg").createImageIcon());
		
		//if(!confirmManager.isEnabled()){
			
			TreePath[] selectedPaths = tree.getSelectionPaths();
			
			for(int i=0; i<selectedPaths.length; i++){
				
				TreePath treePath = selectedPaths[i];
				
				DefaultMutableTreeNode node = (DefaultMutableTreeNode)treePath.getLastPathComponent();
				
				Object object = node.getUserObject();
				
				if (node == null){ // no node selected
					
			    	return;
			    	
				}else if(object.getClass().equals(JCpgCategory.class)){ // leaf is category
					
					JCpgCategory category = (JCpgCategory)node.getUserObject();
					DefaultMutableTreeNode categoryParentNode = (DefaultMutableTreeNode)node.getParent();
			    	JCpgGallery galleryParent = (JCpgGallery)categoryParentNode.getUserObject();
			    	
			    	getGallery().deleteCategory(category);
			    	category.delete(this); // delete category and all underlying components. Generate DELETE query if needed
			    	node.removeFromParent();
			    	
			    	SwingUtilities.updateComponentTreeUI(tree); // workaround for Java bug 4173369
			    	pictureListModel.clear();
			    	pictureList.removeAll();
			    	explorer.removeAll();
			    	
			    }else if(object.getClass().equals(JCpgAlbum.class)){ // leaf is album
			    	
			    	JCpgAlbum album = (JCpgAlbum)node.getUserObject();
			    	DefaultMutableTreeNode albumParentNode = (DefaultMutableTreeNode)node.getParent();
			    	JCpgCategory albumParent = (JCpgCategory)albumParentNode.getUserObject();
			    	
			    	albumParent.deleteAlbum(album);
			    	album.delete(this); // delete album and all underlying components. Generate DELETE query if needed
			    	node.removeFromParent();
			    	
			    	SwingUtilities.updateComponentTreeUI(tree); // workaround for Java bug 4173369
			    	pictureListModel.clear();
			    	pictureList.removeAll();
			    	explorer.removeAll();
			    	
			    }else if(object.getClass().equals(JCpgPicture.class)){ // leaf is picture
			    	
			    	JCpgPicture picture = (JCpgPicture)node.getUserObject();
			    	DefaultMutableTreeNode pictureParentNode = (DefaultMutableTreeNode)node.getParent();
			    	JCpgAlbum pictureParent = (JCpgAlbum)pictureParentNode.getUserObject();
			    	
			    	pictureParent.deletePicture(picture);
			    	picture.delete(this); // delete pictureobject + files. Generate DELETE query if needed
			    	node.removeFromParent();
			   
			    	SwingUtilities.updateComponentTreeUI(tree); // workaround for Java bug 4173369
			    	pictureListModel.clear();
			    	pictureList.removeAll();
			    	explorer.removeAll();
			    	
			    }
				
				new JCpgGallerySaver(getGallery()).saveGallery(); // save gallery
				
			}
			
		//}
		
    }
	/**
	 * 
	 * Action when user clicks on 'edit' button. 
	 * 
	 */
	private void control_editActionPerformed(java.awt.event.ActionEvent evt) {
		
		DefaultMutableTreeNode node = (DefaultMutableTreeNode)tree.getLastSelectedPathComponent();
		
		Object object = node.getUserObject();
		
		if (node == null){
			
	    	return;
	    	
		}else if(object.getClass().equals(JCpgCategory.class)){ // category
			
			new JCpgEditCategoryManager(this, new JCpgImageUrlValidator("data/editcategory_logo.jpg").createImageIcon(), node);
			SwingUtilities.updateComponentTreeUI(tree); // workaround for Java bug 4173369
		
		}else if(object.getClass().equals(JCpgAlbum.class)){ // album
			
			new JCpgEditAlbumManager(this, new JCpgImageUrlValidator("data/editalbum_logo.jpg").createImageIcon(), node);
			SwingUtilities.updateComponentTreeUI(tree); // workaround for Java bug 4173369
		
		}else if(object.getClass().equals(JCpgPicture.class)){ // picture
			
			new JCpgEditPictureManager(this, new JCpgImageUrlValidator("data/editpicture_logo.jpg").createImageIcon(), node);
			SwingUtilities.updateComponentTreeUI(tree); // workaround for Java bug 4173369
		
		}
		
    }
	private void control_previewActionPerformed(java.awt.event.ActionEvent evt) {
		
		DefaultMutableTreeNode node = (DefaultMutableTreeNode)tree.getLastSelectedPathComponent();
		
		if(node != null && node.getLevel() == 2){
			
			JCpgAlbum album = (JCpgAlbum)node.getUserObject();
			
			if(album.getPictures().size() > 0){
		
				new JCpgPreviewer(this, album).startPreview();
				
			}
			
		}
		
	}
	/**
	 * 
	 * Action when user clicks on 'sync' button. 
	 * 
	 */
	private void syncActionPerformed(java.awt.event.ActionEvent evt) {
		
		this.setEnabled(false);
		
		if(getOnlinemode()){ // if true, we are online
			/*
			Thread t1 = new Thread(new Runnable() {
				
				public void run() {
					
					JCpgSplashscreen splash = new JCpgSplashscreen(359, 76, "data/syncing.jpg");
					
					while(isSyncing) {};
					
					splash.setVisible(false);
					splash.dispose();
					globalUi.setEnabled(true);
					
				}
				
			});
			
			Thread t2 = new Thread(new Runnable() {
				
				public void run() {
					
					isSyncing = true; 
					new JCpgSyncer(globalUi, getSqlManager()).sync();
					isSyncing = false;
					
				}
				
			});
			
			t2.start();
			t1.start();
		*/
		
		new JCpgSyncer(globalUi, getSqlManager()).sync();
		
		this.setEnabled(true);
		
		}else{ // offline, let user go online
			
			new JCpgUserManager(500, 200, this);
			
		}
		
	}
	/**
	 * 
	 * Action when user clicks on 'crop' button. 
	 * 
	 */
	private void edit_cropActionPerformed(java.awt.event.ActionEvent evt) {
		
		DefaultMutableTreeNode node = (DefaultMutableTreeNode)tree.getLastSelectedPathComponent();
		
		if(node != null && node.getLevel() == 3){
		
			new JCpgEditor_crop(this, (JCpgPicture)node.getUserObject(), new Dimension(1, 51), new Dimension(1000, 600));
			
		}
		
	}
	/**
	 * 
	 * Action when user clicks on 'resize' button. 
	 * 
	 */
	private void edit_resizeActionPerformed(java.awt.event.ActionEvent evt) {
		
		DefaultMutableTreeNode node = (DefaultMutableTreeNode)tree.getLastSelectedPathComponent();
		
		if(node != null && node.getLevel() == 3){
		
			new JCpgEditor_resize(this, (JCpgPicture)node.getUserObject(), new Dimension(1, 51), new Dimension(1000, 600));
			
		}
		
	}
	/**
	 * 
	 * Action when user clicks on 'correct colors' button. 
	 * 
	 */
	private void edit_colorcorrectionActionPerformed(java.awt.event.ActionEvent evt) {
		
		DefaultMutableTreeNode node = (DefaultMutableTreeNode)tree.getLastSelectedPathComponent();
		
		if(node != null && node.getLevel() == 3){
		
			new JCpgEditor_colors(this, (JCpgPicture)node.getUserObject(), new Dimension(1, 51), new Dimension(600, 600));
			
		}
		
	}
	/**
	 * 
	 * Action when user clicks on 'rotate' button. 
	 * 
	 */
	private void edit_rotateActionPerformed(java.awt.event.ActionEvent evt) {
		
		DefaultMutableTreeNode node = (DefaultMutableTreeNode)tree.getLastSelectedPathComponent();
		
		if(node != null && node.getLevel() == 3){
		
			new JCpgEditor_rotate(this, (JCpgPicture)node.getUserObject(), new Dimension(1, 51), new Dimension(1000, 600));
			
		}
		
	}
	/**
	 * 
	 * 
	 * Action when user clicks 'close' mega explorer view 
	 * 
	 */
	private void closeMegaExplorerActionPerformed(java.awt.event.ActionEvent evt) {
		
		changeMegaExplorerActive(true); // go to mega explorer view
		
	}
	/**
	 * 
	 * Handle the actions that must be taken when the user select a tree entry. When an entry is selected, it is very important to know which object lies behind. It could be a gallery, 
	 * a category, an album or a picture. To handle this information, we need to do typecasting. But to what object do we need to cast if we don't know in advance which object the user has selected?
	 * Solution: count the depth of the tree entry: 0 = gallery (root), 1 = album, 2 = category, 3 = picture. We start from the node, go up to the parent and we keep going up until we can
	 * go no further (=root).
	 * When a user selects a tree entry, some things will change depending on that. For example, the add button(+) will get a different function, depending on the selected tree entry. IF the root,
	 * or gallery is selected, the + button will add a category, if a category is selected, the + button will add an album and so on.
	 * 
	 */
	public void valueChanged(TreeSelectionEvent e) {
		
	    DefaultMutableTreeNode node = (DefaultMutableTreeNode)tree.getLastSelectedPathComponent();
	    
	    Object object = node.getUserObject();
	    
	    // do correct typecasting and actions
	    if (node == null){
	    	
	    	return;
	    	
	    }else if(object.getClass().equals(JCpgCategory.class)){ // leaf is category	
	    
	    	explorer.removeAll(); // clear explorer
	    	SwingUtilities.updateComponentTreeUI(explorer); // workaround for Java bug 4173369
	    	
		}else if(object.getClass().equals(JCpgAlbum.class)){ // leaf is album	
	    	
	    	explorer.removeAll(); // clear explorer
	    	SwingUtilities.updateComponentTreeUI(explorer); // workaround for Java bug 4173369
	    	
	    	JCpgAlbum album = (JCpgAlbum)node.getUserObject();
	    	pictureListModel.clear();
	    	
	    	for(int i=0; i<album.getPictures().size(); i++){
	    		
	    		pictureListModel.addElement(album.getPictures().get(i));
	    	
	    	}
	    	
	    }else if(object.getClass().equals(JCpgPicture.class)){ // leaf is picture
	    	
	    	JCpgPicture picture = (JCpgPicture)node.getUserObject();
	    	JButton image = new JButton();
	    	
	    	image.setIcon(new JCpgImageUrlValidator("albums/" + picture.getFilePath() + picture.getFileName()).createImageIcon());
	    	image.setToolTipText(picture.getFileName());
	    	Dimension realSize = new Dimension(picture.getpWidth(), picture.getpHeight());
	    	image.setPreferredSize(realSize);
	    	
	    	explorer.removeAll();
	    	explorer.add(image);
	    	SwingUtilities.updateComponentTreeUI(explorer); // workaround for Java bug 4173369
	    	
	    }

	}
	
	
	
	
	
	
	
	
	
	
	
	
																	//*************************************
																	//				MUTATORS & OTHERS     *
																	//*************************************
	/**
	 * 
	 * Add a userConfig file to the interface. The serverConfig contains all the necesarry information for making the connection to the database and the correct Cpg tables
	 * 
	 * @param userConfig
	 * 		a userConfig object
	 */
	protected void addServerConfig(JCpgUserConfig userConfig){
		
		this.userConfig = userConfig;
		
	}
	/**
	 * 
	 * Add a userConfig file to the interface. The userconfig contains all the necesarry information for making the connection to the database and the correct Cpg tables
	 * 
	 * @param userConfig
	 * 		a userConfig object
	 */
	public void addUserConfig(JCpgUserConfig userConfig){
		
		this.userConfig = userConfig;
		
	}
	/**
	 * 
	 * Set a SqlManager reference for executing queries
	 * 
	 * @param sqlManager
	 * 		a SqlManager reference for executing queries
	 */
	public void addSqlManager(JCpgSqlManager sqlManager){
		
		this.sqlManager = sqlManager;
		
	}
	/**
	 * 
	 * Change the current configuration
	 * 
	 * @param config
	 * 		the new configuration
	 */
	public void addCpgConfig(JCpgConfig config){
		
		this.cpgConfig = config;
		
	}
	/**
	 * 
	 * Build up the tree with the given gallery components
	 *
	 */
	public void buildTree(){
		
		getTree().removeAll(); // will remove all nodes besides the root
		
		for(int i=0; i<getGallery().getCategories().size(); i++) {
			
			JCpgCategory category = getGallery().getCategories().get(i);

			DefaultMutableTreeNode treeCategory = new DefaultMutableTreeNode(category);
			root.add(treeCategory);
				
			category.changeTreePath(new TreePath(treeCategory.getPath())); // add treePath
		
			for(int j=0; j<category.getAlbums().size(); j++) {
				
				JCpgAlbum album = category.getAlbums().get(j);
				
				DefaultMutableTreeNode treeAlbum = new DefaultMutableTreeNode(album);
				treeCategory.add(treeAlbum);
				
				album.changeTreePath(new TreePath(treeAlbum.getPath())); // add treePath
				
				for(int k=0; k<album.getPictures().size(); k++) {
					
					JCpgPicture picture = album.getPictures().get(k);
					
					DefaultMutableTreeNode treePicture = new DefaultMutableTreeNode(picture);
					treeAlbum.add(treePicture);

					picture.changeTreePath(new TreePath(treePicture.getPath())); // add treePath
					
				}

			}
			
		}
		
	}
	/**
	 * 
	 * Go through the whole components tree and find the node you're looking for
	 * 
	 * @param node
	 * 		startnode
	 * @param type
	 * 		type to search for either 'category, album or picture' always LOWERCASE, used to filter out duplicates between different types eg album called MyColl and category called MyColl
	 * @param name
	 * 		name of object so we can compare
	 */
	public DefaultMutableTreeNode visitAllNodes(DefaultMutableTreeNode node, String type, String name) {
    
		DefaultMutableTreeNode result = null;
		
        if (node.getChildCount() >= 0) {
        	
            for (Enumeration e=node.children(); e.hasMoreElements(); ) {
            	
            	DefaultMutableTreeNode n = (DefaultMutableTreeNode)e.nextElement();
                
                if(n.getUserObject().getClass().equals(JCpgCategory.class) && type.equals("category")){ // node is category
                	
                	JCpgCategory category = (JCpgCategory)n.getUserObject();
                	
                	if(category.getName().equals(name)){ // match found
                		
                		return n;
                		
                	}
                	
                }else if(n.getUserObject().getClass().equals(JCpgAlbum.class) && type.equals("album")){ // node is album
                	
                	JCpgAlbum album = (JCpgAlbum)n.getUserObject();
                	
                	if(album.getName().equals(name)){ // match found
                		
                		return n;
                		
                	}
                	
                }else if(n.getUserObject().getClass().equals(JCpgPicture.class) && type.equals("picture")){ // node is picture
                	
                	JCpgPicture picture = (JCpgPicture)n.getUserObject();
                	
                	if(picture.getFileName().equals(name)){ // match found
                		
                		return n;
                		
                	}
                	
                }
                
                result = visitAllNodes(n, type, name);
                
            }
            
        }
        
        return result; // no correspondenting node found
        
    }
	/**
	 * 
	 * Change the current online mode (true = online, false = offline)
	 * 
	 * @param mode
	 * 		the new mode
	 */
	public void changeOnlinemode(boolean mode){
		
		this.onlinemode = mode;
		
	}
	/**
	 * 
	 * Make it possible to switch from mega explorer view to normal view when we want
	 *
	 */
	private void controlMegaExplorerActive(){
		
		if(getMegaExplorerActive()){
			
			megaPictureView.getViewport().add(pictureList);
			megaTreeView.getViewport().add(tree);
			
			pictureView.setVisible(false);
			splitPane.setVisible(false);
			megaSplitPane.setVisible(true);
			
			closeMegaExplorer.setVisible(false);
			
			edit_rotate.setVisible(false);
			edit_crop.setVisible(false);
			edit_resize.setVisible(false);
			edit_colorcorrection.setVisible(false);
			
			//pictureList.setVisibleRowCount(3);
			
		}else{

			pictureView.getViewport().add(pictureList);
			treeView.getViewport().add(tree);
			
			pictureView.setVisible(true);
			splitPane.setVisible(true);
			megaSplitPane.setVisible(false);
			
			closeMegaExplorer.setVisible(true);

			edit_rotate.setVisible(true);
			edit_crop.setVisible(true);
			edit_resize.setVisible(true);
			edit_colorcorrection.setVisible(true);
			
			//pictureList.setVisibleRowCount(1);
			
		}
		
	}
	/**
	 * 
	 * Change mega explorer view flag
	 * 
	 * @param megaExplorerActive
	 * 		mega explorer view flag
	 */
	public void changeMegaExplorerActive(boolean megaExplorerActive){

		setMegaExplorerActive(megaExplorerActive);
		controlMegaExplorerActive();
		
	}
	
}