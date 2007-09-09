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
import java.awt.MediaTracker;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseWheelEvent;
import java.awt.event.MouseWheelListener;
import java.io.File;
import java.util.ArrayList;
import java.util.Enumeration;

import javax.swing.DefaultListModel;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JList;
import javax.swing.JMenu;
import javax.swing.JMenuBar;
import javax.swing.JMenuItem;
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
import javax.swing.tree.TreePath;
import javax.swing.tree.TreeSelectionModel;

import be.khleuven.frank.JCpg.JCpgImageUrlValidator;
import be.khleuven.frank.JCpg.Components.JCpgAlbum;
import be.khleuven.frank.JCpg.Components.JCpgCategory;
import be.khleuven.frank.JCpg.Components.JCpgGallery;
import be.khleuven.frank.JCpg.Components.JCpgPicture;
import be.khleuven.frank.JCpg.Configuration.JCpgConfig;
import be.khleuven.frank.JCpg.Editor.JCpgEditorColors;
import be.khleuven.frank.JCpg.Editor.JCpgEditorCrop;
import be.khleuven.frank.JCpg.Editor.JCpgEditorResize;
import be.khleuven.frank.JCpg.Editor.JCpgEditorRotate;
import be.khleuven.frank.JCpg.Manager.JCpgAddAlbumManager;
import be.khleuven.frank.JCpg.Manager.JCpgAddPictureManager;
import be.khleuven.frank.JCpg.Manager.JCpgAddSelectManagerCategory;
import be.khleuven.frank.JCpg.Manager.JCpgAddSelectManagerGallery;
import be.khleuven.frank.JCpg.Manager.JCpgEditAlbumManager;
import be.khleuven.frank.JCpg.Manager.JCpgEditCategoryManager;
import be.khleuven.frank.JCpg.Manager.JCpgEditPictureManager;
import be.khleuven.frank.JCpg.Manager.JCpgUserManager;
import be.khleuven.frank.JCpg.Menu.JCpgMenuAddUser;
import be.khleuven.frank.JCpg.Menu.JCpgMenuInstallApi;
import be.khleuven.frank.JCpg.Menu.JCpgMenuSetConfig;
import be.khleuven.frank.JCpg.Menu.JCpgMenuShowConfig;
import be.khleuven.frank.JCpg.Menu.JCpgMenuShowUser;
import be.khleuven.frank.JCpg.Previewer.JCpgPreviewer;
import be.khleuven.frank.JCpg.Save.JCpgGallerySaver;
import be.khleuven.frank.JCpg.Sync.JCpgSyncer;


/**
 * 
 * Complete JCpg UI
 * 
 * @author    Frank Cleynen
 * 
 */
public class JCpgUI extends JFrame implements TreeSelectionListener, MouseWheelListener{
	
	
	
	
	
	
	
																	//*************************************
																	//				VARIABLES             *
																	//*************************************
	private static final long serialVersionUID = 1L;
	
	private MediaTracker tracker; // mediatracker to track image load status
	
	private JCpgConfig cpgConfig;
	
	private JCpgPicture currentPicture; // the currently selected picture
	private JCpgAlbum currentAlbum; // the currently selected album
	
	private static JCpgGallery gallery = new JCpgGallery("Root", ""); // default static gallery to store all catgories and albums
	private JCpgCategory usergalleries = new JCpgCategory(1, 0, "User galleries", "This category contains albums that belong to Coppermine users.", 0, 0, 0);
	
	private Dimension screensize;
	private Dimension framesize;
	private Dimension buttonPreferredSize;
	private Dimension thumbnailPreferredSize;
	
	private boolean onlinemode = false; // false if we work offline, true if we work online
	private boolean megaExplorerActive = false; // when in mega explorer mode, only the tree and one big list with many rows of photo's is visible. If a photo is selected, we switch to one row of photo's at the top with the explorer below
	
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
	private DefaultMutableTreeNode root, usergalleriesnode;
	
	private JMenuBar menubar;
	private JMenu menu, api, config, users, groups;
	private JMenuItem menuInstallApi, menuShowConfig, menuSetConfig, menuShowUser, menuAddUser, menuUpdateUser;
	
	private ArrayList<String> deleteparameters = new ArrayList<String>(); // used to store all the delete parameters from deleted components
	private ArrayList<JCpgAlbum> albumViewAlbums = new ArrayList<JCpgAlbum>(); // holds the current albums when in albumview
	
	private int albumscrollindex = 0; // holds the index of the current thumb to show when scrolling of album in albumview

	
	
	
	
	
	
	
	
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
		
		tracker = new MediaTracker(this);
		
		screensize = Toolkit.getDefaultToolkit().getScreenSize();
		
		buttonPreferredSize = new Dimension(30, 30);
		thumbnailPreferredSize = new Dimension(100, 100);
		
		pictureListModel = new DefaultListModel();
		pictureList = new JList(pictureListModel);
		pictureList.setBorder(new EtchedBorder());
		pictureList.setLayoutOrientation(JList.HORIZONTAL_WRAP);
		pictureList.setVisibleRowCount(-1);
		pictureList.setCellRenderer(new JCpgPictureCellRenderer(this));
		pictureListSelectionModel = pictureList.getSelectionModel();
		
		pictureView = new JScrollPane(pictureList);
		megaPictureView = new JScrollPane();
		megaPictureView.setBackground(new Color(230, 230, 230));
		
		explorer = new JPanel();
		explorer.setBackground(new Color(230, 230, 230));
		explorerscroll = new JScrollPane(explorer);
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
		
		// check if user galleries category must be added, this is only necesarry if gallery.xml does not exist
		File galleryxml = new File("config/gallery.xml");
		
		if(!galleryxml.exists()){
			
			usergalleriesnode = new DefaultMutableTreeNode(usergalleries);
			root.add(usergalleriesnode);
			
			getGallery().addCategory(usergalleries);
			
		}
		
		tree = new JTree(root);
		tree.getSelectionModel().setSelectionMode(TreeSelectionModel.DISCONTIGUOUS_TREE_SELECTION);
		tree.addTreeSelectionListener(this);
		tree.setBackground(new Color(230, 237, 248));
		
		treeView = new JScrollPane(tree);
		treeView.setMinimumSize(new Dimension(200, 400));
		treeView.setBackground(new Color(230, 237, 248));
		
		megaTreeView = new JScrollPane();
		megaTreeView.setMinimumSize(new Dimension(200, 501));
		megaTreeView.setBackground(new Color(230, 237, 248));
		
		splitPane = new JSplitPane(JSplitPane.HORIZONTAL_SPLIT, treeView, explorerscroll);
		megaSplitPane = new JSplitPane(JSplitPane.HORIZONTAL_SPLIT, megaTreeView, megaPictureView);
		
		// menu
		menubar = new JMenuBar();
		
		menu = new JMenu("Manage");
		menubar.add(menu);
		
		api = new JMenu("API");
		menu.add(api);
		
		menuInstallApi = new JMenuItem("Install the API");
		api.add(menuInstallApi);
		
		menu.addSeparator();
		
		config = new JMenu("Configuration");
		menu.add(config);
		
		menuShowConfig = new JMenuItem("Show configuration");
		config.add(menuShowConfig);
		
		menuSetConfig = new JMenuItem("Change configuration");
		config.add(menuSetConfig);
		
		menu.addSeparator();
		
		users = new JMenu("Users");
		menu.add(users);
		
		menuShowUser = new JMenuItem("Show my user information");
		users.add(menuShowUser);
		
		menuAddUser = new JMenuItem("Add user");
		users.add(menuAddUser);
		
		menuUpdateUser = new JMenuItem("Update user");
		users.add(menuUpdateUser);
		
		menu.addSeparator();
		
		groups = new JMenu("Groups");
		groups.getAccessibleContext().setAccessibleDescription("Manage your Coppermine Photo Gallery groups");
		menu.add(groups);
		
		
		this.setJMenuBar(menubar);
		
		
		// EVENTS
		pictureListSelectionModel.addListSelectionListener(new javax.swing.event.ListSelectionListener() {
            public void valueChanged(javax.swing.event.ListSelectionEvent evt) {
                pictureListValueChanged(evt);
            }
        });
		
		// control buttons
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
		
		// edit buttons
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
		
		// menu
		menuInstallApi.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				menuInstallApiActionPerformed(evt);
			}
		});
		
		menuShowConfig.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				menuShowConfigActionPerformed(evt);
			}
		});
		
		menuSetConfig.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				menuSetConfigActionPerformed(evt);
			}
		});
		
		menuShowUser.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				menuShowUserActionPerformed(evt);
			}
		});
		
		menuAddUser.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				menuAddUserActionPerformed(evt);
			}
		});
		
		menuUpdateUser.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				
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
																	//				SETTERS	              *
																	//*************************************
	/**
	 * 
	 * Set the current album
	 * 
	 * @param album
	 * 		the current album
	 * 
	 */
	private void setCurrentAlbum(JCpgAlbum album){
		
		this.currentAlbum = album;
		
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
																	//				GETTERS	              *
																	//*************************************
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
		
		return JCpgUI.gallery;
		
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
	 * Get the picture list model
	 * 
	 * @return
	 * 		the picture list model
	 */
	public DefaultListModel getPictureListModel(){
		
		return this.pictureListModel;
		
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
	/**
	 * 
	 * Get the current album
	 * 
	 * @return
	 * 		the current album
	 */
	public JCpgAlbum getCurrentAlbum(){
		
		return this.currentAlbum;
		
	}
	/**
	 * 
	 * Get the delete parameters arraylist
	 * 
	 * @return
	 * 		the delete parameters arraylist
	 */
	public ArrayList<String> getDeleteParameters(){
		
		return this.deleteparameters;
		
	}
	/**
	 * 
	 * Get the albums currently viewable when in album view
	 * 
	 * @return
	 * 		the albums currently viewable when in album view
	 */
	public ArrayList<JCpgAlbum> getAlbumViewAlbums(){
		
		return this.albumViewAlbums;
		
	}
	
	
	
	
	
	
	
	
																	
																	//*************************************
																	//				EVENTS			      *
																	//*************************************
	/**
	 * 
	 * When the user selects a different item in the picture list, perform the right actions: make a new button with the selected image in it and then add it to the explorer pane which has
	 * just been cleaned. The explorer pane has a flow layout manager so the button will always be placed correctly.
	 * 
	 * If the user selects a photo and we are in mega explorer view, exit mega explorer view
	 * 
	 */
	private void pictureListValueChanged(javax.swing.event.ListSelectionEvent evt) {
		
		DefaultMutableTreeNode node = (DefaultMutableTreeNode)tree.getLastSelectedPathComponent();
		
		if(!node.getUserObject().getClass().equals((JCpgCategory.class))){ // only go to this picture if we are in pictureview. If we are in albumview, we must go to that particular album
		
			if(getTree().getSelectionModel().getSelectionCount() > 1) getTree().getSelectionModel().clearSelection();
			
			if(getMegaExplorerActive()) changeMegaExplorerActive(false); // exit mega explorer view if needed
			
			JLabel image = new JLabel(); // make label with picture
			currentPicture = (JCpgPicture)pictureList.getSelectedValue();
			
			if(currentPicture != null){
				
		    	image.setIcon(new JCpgImageUrlValidator(getCpgConfig().getSiteConfig().getValueFor("fullpath") + currentPicture.getFilePath() + currentPicture.getFileName()).createImageIcon());
		    	image.setToolTipText(currentPicture.getFileName());
		    	Dimension realSize = new Dimension(currentPicture.getpWidth(), currentPicture.getpHeight());
		    	image.setPreferredSize(realSize);
		    	
		    	getTree().addSelectionPath(currentPicture.getTreePath());
		    	
		    	explorer.removeAll(); // add picture to explorer pane
		    	explorer.add(image);
		    	
		    	SwingUtilities.updateComponentTreeUI(explorer); // workaround for Java bug 4173369
		    	SwingUtilities.updateComponentTreeUI(getTree()); // workaround for Java bug 4173369
		    
			}
			
		}else if(node.getUserObject().getClass().equals((JCpgCategory.class))){
			
			if(pictureList.getSelectedIndex() >= 0){ // apparently, when nothing is selected, the returned index = -1 which would cause an array out of bound exception
			
				JCpgAlbum album = getAlbumViewAlbums().get(pictureList.getSelectedIndex());
				
				getTree().setSelectionPath(album.getTreePath());
				
			}
			
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
	    	
		}else if(object.getClass().equals(JCpgGallery.class)){ // add category or album
			
			String[] options = {"album", "category"};
			new JCpgAddSelectManagerGallery(this, new JCpgImageUrlValidator("data/wtc_logo.jpg").createImageIcon(), node, options);
		
		}else if(object.getClass().equals(JCpgCategory.class)){ // add category or album
			
			JCpgCategory category = (JCpgCategory)object;
			
			if(category.getId() == 1){ // only albums can be added to "user galleries" category
				
				new JCpgAddAlbumManager(this, new JCpgImageUrlValidator("data/createalbum_logo.jpg").createImageIcon(), node);
				
			}else{ // albums and categories can be added to all other categories
				
				String[] options = {"album", "category"};
				
				new JCpgAddSelectManagerCategory(this, new JCpgImageUrlValidator("data/wtc_logo.jpg").createImageIcon(), node, options);
				
			}
			
		}else if(object.getClass().equals(JCpgAlbum.class)){ // add picture
			
			new JCpgAddPictureManager(this, getCpgConfig().getSiteConfig(), new JCpgImageUrlValidator("data/createpicture_logo.jpg").createImageIcon(), node);
		
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
					
					if(category.getId() != 1){ // user galleries category can not be deleted
					
						DefaultMutableTreeNode categoryParentNode = (DefaultMutableTreeNode)node.getParent();
				    	JCpgGallery galleryParent = (JCpgGallery)categoryParentNode.getUserObject();
				    	
				    	galleryParent.deleteCategory(category);
				    	category.delete(this); // delete category and all underlying components.
				    	node.removeFromParent();
				    	
				    	SwingUtilities.updateComponentTreeUI(tree); // workaround for Java bug 4173369
	
				    	explorer.removeAll();
				    	
					}
			    	
			    }else if(object.getClass().equals(JCpgAlbum.class)){ // leaf is album
			    	
			    	JCpgAlbum album = (JCpgAlbum)node.getUserObject();
			    	DefaultMutableTreeNode albumParentNode = (DefaultMutableTreeNode)node.getParent();
			    	
			    	Object parentObject = albumParentNode.getUserObject();
			    	
			    	JCpgGallery albumParent = null;
			    	
			    	if(parentObject.getClass().equals(JCpgCategory.class))
			    		albumParent = (JCpgCategory)albumParentNode.getUserObject();
			    	if(parentObject.getClass().equals(JCpgGallery.class))
			    		albumParent = (JCpgGallery)albumParentNode.getUserObject();
			    	
			    	albumParent.deleteAlbum(album);
			    	album.delete(this); // delete album and all underlying components.
			    	node.removeFromParent();
			    	
			    	SwingUtilities.updateComponentTreeUI(tree); // workaround for Java bug 4173369

			    	explorer.removeAll();
			    	
			    }else if(object.getClass().equals(JCpgPicture.class)){ // leaf is picture
			    	
			    	JCpgPicture picture = (JCpgPicture)node.getUserObject();
			    	DefaultMutableTreeNode pictureParentNode = (DefaultMutableTreeNode)node.getParent();
			    	JCpgAlbum pictureParent = (JCpgAlbum)pictureParentNode.getUserObject();
			    	
			    	pictureParent.deletePicture(picture);
			    	picture.delete(this, pictureParent); // delete pictureobject + files
			    	node.removeFromParent();
			   
			    	SwingUtilities.updateComponentTreeUI(tree); // workaround for Java bug 4173369
			    	
			    	explorer.removeAll();
			    	
			    }
				
				new JCpgGallerySaver(getGallery()).saveGallery(); // save gallery
				
			}
			
			// save delete parameters for later loading
			new JCpgGallerySaver(getGallery()).saveDeleteParameters(this);
			
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
			
			JCpgCategory category = (JCpgCategory)object;
			
			if(category.getId() != 1){ // "User Galleries" category can not be edited
			
				new JCpgEditCategoryManager(this, new JCpgImageUrlValidator("data/editcategory_logo.jpg").createImageIcon(), node);
				SwingUtilities.updateComponentTreeUI(tree); // workaround for Java bug 4173369
				
			}
		
		}else if(object.getClass().equals(JCpgAlbum.class)){ // album
			
			new JCpgEditAlbumManager(this, new JCpgImageUrlValidator("data/editalbum_logo.jpg").createImageIcon(), node);
			SwingUtilities.updateComponentTreeUI(tree); // workaround for Java bug 4173369
		
		}else if(object.getClass().equals(JCpgPicture.class)){ // picture
			
			new JCpgEditPictureManager(this, new JCpgImageUrlValidator("data/editpicture_logo.jpg").createImageIcon(), node);
			SwingUtilities.updateComponentTreeUI(tree); // workaround for Java bug 4173369
		
		}
		
    }
	/**
	 * 
	 * Action when user clicks on 'preview' button. 
	 * 
	 */
	private void control_previewActionPerformed(java.awt.event.ActionEvent evt) {
		
		DefaultMutableTreeNode node = (DefaultMutableTreeNode)tree.getLastSelectedPathComponent();
		
		if(node != null && node.getUserObject().getClass().equals(JCpgAlbum.class)){
			
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
		
		if(getOnlinemode()){ // if true, we are online
			
			this.setEnabled(false);
			
			new JCpgSyncer(this).sync();
			
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
		
		if(currentPicture != null){
		
			new JCpgEditorCrop(this, currentPicture, new Dimension(1, 51), new Dimension(1000, 600), getPictureList().getSelectedIndex());
			
		}
		
	}
	/**
	 * 
	 * Action when user clicks on 'resize' button. 
	 * 
	 */
	private void edit_resizeActionPerformed(java.awt.event.ActionEvent evt) {
		
		if(currentPicture != null){
		
			new JCpgEditorResize(this, currentPicture, new Dimension(1, 51), new Dimension(1000, 600), getPictureList().getSelectedIndex());
			
		}
		
	}
	/**
	 * 
	 * Action when user clicks on 'correct colors' button. 
	 * 
	 */
	private void edit_colorcorrectionActionPerformed(java.awt.event.ActionEvent evt) {
		
		if(currentPicture != null){
		
			new JCpgEditorColors(this, currentPicture, new Dimension(1, 51), new Dimension(600, 600), getPictureList().getSelectedIndex());
			
		}
		
	}
	/**
	 * 
	 * Action when user clicks on 'rotate' button. 
	 * 
	 */
	private void edit_rotateActionPerformed(java.awt.event.ActionEvent evt) {
		
		if(currentPicture != null){
			
			new JCpgEditorRotate(this, currentPicture, new Dimension(1,51), new Dimension(1000, 600), getPictureList().getSelectedIndex());
			
		}
		
	}
	/**
	 *  
	 * Action when user clicks 'close' mega explorer view 
	 * 
	 */
	private void closeMegaExplorerActionPerformed(java.awt.event.ActionEvent evt) {
		
		changeMegaExplorerActive(true); // go to mega explorer view
		
	}
	/**
	 * 
	 * Show the current Cpg config
	 * 
	 */
	private void menuInstallApiActionPerformed(java.awt.event.ActionEvent evt) {
		
		new JCpgMenuInstallApi(this);
		
	}
	/**
	 * 
	 * Show the current Cpg config
	 * 
	 */
	private void menuShowConfigActionPerformed(java.awt.event.ActionEvent evt) {
		
		new JCpgMenuShowConfig(this);
		
	}
	/**
	 * 
	 * Change the current Cpg config
	 * 
	 */
	private void menuSetConfigActionPerformed(java.awt.event.ActionEvent evt) {
		
		new JCpgMenuSetConfig(this);
		
	}
	/**
	 * 
	 * Show the current user data
	 * 
	 */
	private void menuShowUserActionPerformed(java.awt.event.ActionEvent evt) {
		
		new JCpgMenuShowUser(this);
		
	}
	/**
	 * 
	 * Add new user
	 * 
	 */
	private void menuAddUserActionPerformed(java.awt.event.ActionEvent evt) {
		
		new JCpgMenuAddUser(this);
		
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
	    
	    if(node == null) return;
	    
	    Object object = node.getUserObject();
	    
	    // do correct typecasting and actions
	    if(object.getClass().equals(JCpgCategory.class)){ // leaf is category
	    	
	    	setCurrentAlbum(null); // reset current album
	    	getAlbumViewAlbums().clear(); // remove all previous albums
	    	
	    	JCpgCategory category = (JCpgCategory)node.getUserObject();
	    	
	    	for(int i=0; i<category.getAlbums().size(); i++){ // build album view
	    		
	    		try {
	    			
		    		JCpgAlbum album = category.getAlbums().get(i);
		    		
		    		if(album.getPictures().size() > 0){
		    		
			    		getPictureListModel().removeAllElements();
			    		
			    		String path = getCpgConfig().getSiteConfig().getValueFor("fullpath") + album.getPictures().get(0).getFilePath() + "thumb_" + album.getPictures().get(0).getFileName(); // first picture of the album
			    		
		    			tracker.addImage(new ImageIcon(path).getImage(), 0);
		    		
						tracker.waitForAll();
						
						pictureListModel.addElement(album.getPictures().get(0));
						
						getAlbumViewAlbums().add(album);
						
		    		}
					
	    		} catch (InterruptedException e1) {
					
					System.out.println("JCpgUI: couldn't track first image of album");
	    			
				}
	    		
	    	}
	    
		}else if(object.getClass().equals(JCpgAlbum.class)){ // leaf is album
	    	
	    	JCpgAlbum album = (JCpgAlbum)node.getUserObject();
	    	
	    	if(!album.equals(getCurrentAlbum()) || getCurrentAlbum() == null){ // only do explorer update if this album is not already loaded
	    		
		    	setCurrentAlbum(album);
		    	
		    	getPictureListModel().removeAllElements();
		    	
		    	for(int i=0; i<album.getPictures().size(); i++){
		    		
		    		try {
		    		
		    			String path = getCpgConfig().getSiteConfig().getValueFor("fullpath") + album.getPictures().get(i).getFilePath() + "thumb_" + album.getPictures().get(i).getFileName();
		    		
		    			tracker.addImage(new ImageIcon(path).getImage(), 0);
		    		
						tracker.waitForAll();
						
						pictureListModel.addElement(album.getPictures().get(i));
						
					} catch (InterruptedException e1) {
						
						System.out.println("JCpgUI: couldn't track image");
						
					}
		    		
		    	}
		    	
		    	getPictureList().setModel(pictureListModel);
	    		
	    	}
	    	
	    }else if(object.getClass().equals(JCpgPicture.class)){ // leaf is picture
	    	
	    	if(getMegaExplorerActive())
	    		changeMegaExplorerActive(false); // exit mega explorer view if needed
	    	
	    	currentPicture = (JCpgPicture)node.getUserObject();
	    	JLabel image = new JLabel();
	    	
	    	image.setIcon(new JCpgImageUrlValidator(getCpgConfig().getSiteConfig().getValueFor("fullpath") + currentPicture.getFilePath() + currentPicture.getFileName()).createImageIcon());
	    	image.setToolTipText(currentPicture.getFileName());
	    	Dimension realSize = new Dimension(currentPicture.getpWidth(), currentPicture.getpHeight());
	    	image.setPreferredSize(realSize);
	    	
	    	// show this picture's album in the picture list
	    	DefaultMutableTreeNode parent = (DefaultMutableTreeNode)node.getParent();
	    	JCpgAlbum album = (JCpgAlbum)parent.getUserObject();

	    	if(!album.equals(getCurrentAlbum())){ // only do explorer update if this album is not already loaded
		    	
	    		currentAlbum = album;
	    		
	    		getPictureListModel().removeAllElements();
		    	
		    	for(int i=0; i<album.getPictures().size(); i++){
		    		
		    		pictureListModel.addElement(album.getPictures().get(i));
		    	
		    	}
		    	
		    	getPictureList().setModel(pictureListModel);
		    	changeMegaExplorerActive();
		    	changeMegaExplorerActive();
		    	
	    	}
	    	
	    	// update
	    	explorer.removeAll();
	    	explorer.add(image);
	    	SwingUtilities.updateComponentTreeUI(explorer); // workaround for Java bug 4173369
	    	
	    }
	    
	    SwingUtilities.updateComponentTreeUI(getPictureList()); // workaround for Java bug 4173369
	    
	}
	
	
	
	
	
	
	
	
	
	
	
	
																	//*************************************
																	//				MUTATORS & OTHERS     *
																	//*************************************
	/**
	 * 
	 * Add a cpgConfig to the interface.
	 * 
	 * @param userConfig
	 * 		a userConfig object
	 */
	public void changeCpgConfig(JCpgConfig cpgConfig){
		
		this.cpgConfig = cpgConfig;
		
	}
	/**
	 * 
	 * Build up the tree with the given gallery components
	 *
	 */
	public void buildTree(){
		
		getTree().removeAll(); // will remove all nodes besides the root
		
		for(int j=0; j<getGallery().getAlbums().size(); j++) {
			
			JCpgAlbum album = getGallery().getAlbums().get(j);
			
			DefaultMutableTreeNode treeAlbum = new DefaultMutableTreeNode(album);
			root.add(treeAlbum);
			
			album.changeTreePath(new TreePath(treeAlbum.getPath())); // add treePath
			
			for(int k=0; k<album.getPictures().size(); k++) {
				
				JCpgPicture picture = album.getPictures().get(k);
				
				DefaultMutableTreeNode treePicture = new DefaultMutableTreeNode(picture);
				treeAlbum.add(treePicture);

				picture.changeTreePath(new TreePath(treePicture.getPath())); // add treePath
				
			}

		}
		
		loadCategories(getGallery(), root);
		
	}
	private void loadCategories(JCpgGallery parent, DefaultMutableTreeNode treenode){
		
		for(int i=0; i<parent.getCategories().size(); i++) {
			
			JCpgCategory category = parent.getCategories().get(i);

			DefaultMutableTreeNode treeCategory = new DefaultMutableTreeNode(category);
			treenode.add(treeCategory);
				
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
			
			loadCategories(category, treeCategory); // recursion
			
		}
		
	}
	/**
	 * 
	 * Go through the whole components tree and find the node you're looking for
	 * 
	 * @param node
	 * 		startnode
	 * @param type
	 * 		type to search for either 'gallery, category, album or picture' always LOWERCASE, used to filter out duplicates between different types eg album called MyColl and category called MyColl
	 * @param name
	 * 		name of object so we can compare
	 */
	public DefaultMutableTreeNode visitAllNodes(DefaultMutableTreeNode node, String type, String name) {
    
		DefaultMutableTreeNode result = null;
		
		// check parent node itself
		if(node.getUserObject().getClass().equals(JCpgGallery.class) && type.equals("gallery")){ // parent node is category
        	
        	JCpgGallery gallery = (JCpgGallery)node.getUserObject();
        	
        	if(gallery.getName().equals(name)){ // match found
        		
        		return node;
        		
        	}
        
    	}else if(node.getUserObject().getClass().equals(JCpgCategory.class) && type.equals("category")){ // parent node is category
        	
        	JCpgCategory category = (JCpgCategory)node.getUserObject();
        	
        	if(category.getName().equals(name)){ // match found
        		
        		return node;
        		
        	}
        
    	}else if(node.getUserObject().getClass().equals(JCpgAlbum.class) && type.equals("album")){ // parent node is album
        	
        	JCpgAlbum album = (JCpgAlbum)node.getUserObject();
        	
        	if(album.getName().equals(name)){ // match found
        		
        		return node;
        		
        	}
        	
    	}else if(node.getUserObject().getClass().equals(JCpgPicture.class) && type.equals("picture")){ // parent node is picture
        	
        	JCpgPicture picture = (JCpgPicture)node.getUserObject();
        	
        	if(picture.getFileName().equals(name)){ // match found
        		
        		return node;
        		
        	}
        	
    	}
		
    	// check parent node's children
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
			
			megaPictureView.getViewport().add(getPictureList());
			megaTreeView.getViewport().add(getTree());
			
			pictureView.setVisible(false);
			splitPane.setVisible(false);
			megaSplitPane.setVisible(true);
			
			closeMegaExplorer.setVisible(false);
			
			edit_rotate.setVisible(false);
			edit_crop.setVisible(false);
			edit_resize.setVisible(false);
			edit_colorcorrection.setVisible(false);
			
		}else{

			pictureView.getViewport().add(getPictureList());
			treeView.getViewport().add(getTree());
			
			pictureView.setVisible(true);
			splitPane.setVisible(true);
			megaSplitPane.setVisible(false);
			
			closeMegaExplorer.setVisible(true);

			edit_rotate.setVisible(true);
			edit_crop.setVisible(true);
			edit_resize.setVisible(true);
			edit_colorcorrection.setVisible(true);
			
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
	/**
	 * 
	 * Switch the mega explorer view depending on the current state
	 *
	 */
	public void changeMegaExplorerActive(){
		
		if(getMegaExplorerActive()){
			
			changeMegaExplorerActive(false);
			
		}else{
			
			changeMegaExplorerActive(true);
			
		}
		
		controlMegaExplorerActive();
		
	}
	/**
	 * 
	 * Add a new delete parameter to the delete parameter list
	 * 
	 * @param parameter
	 * 		a new delete parameter
	 */
	public void addDeleteParameter(String parameter){
		
		getDeleteParameters().add(parameter);
		
	}
	/**
	 * 
	 * Checks if a certain delete parameter already exists so it's not added twice
	 * 
	 * @param parameter
	 * 		the parameter string to search for
	 * @return
	 * 		true if it was already generated, else false
	 */
	public boolean hasDeleteParameter(String parameter){
		
		for(int i=0; i<getDeleteParameters().size(); i++){
			
			if(getDeleteParameters().get(i).equals(parameter)){
				
				return true;
				
			}
			
		}
		
		return false;
		
	}










	public void mouseWheelMoved(MouseWheelEvent m) {
		
		albumscrollindex++;
		
		int albumindex = getPictureList().locationToIndex(m.getPoint());
		
		JCpgAlbum album = albumViewAlbums.get(albumindex);
		
		if(albumscrollindex >= album.getPictures().size()){
			
			albumscrollindex = 0;
			
		}
		
		String path = getCpgConfig().getSiteConfig().getValueFor("fullpath") + album.getPictures().get(albumscrollindex).getFilePath() + "thumb_" + album.getPictures().get(albumscrollindex).getFileName();
		
		getPictureListModel().removeElementAt(albumindex);
		getPictureListModel().add(albumindex, album.getPictures().get(albumscrollindex));
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}