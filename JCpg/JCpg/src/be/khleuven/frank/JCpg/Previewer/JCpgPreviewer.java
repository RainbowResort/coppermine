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

package be.khleuven.frank.JCpg.Previewer;

import java.awt.Color;
import java.awt.Dimension;
import java.awt.FlowLayout;
import java.awt.Graphics;
import java.awt.Image;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.image.BufferedImage;
import java.io.File;
import java.util.ArrayList;

import javax.imageio.ImageIO;
import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.JSlider;
import javax.swing.border.EtchedBorder;
import javax.swing.event.ChangeEvent;
import javax.swing.event.ChangeListener;

import be.khleuven.frank.JCpg.Components.JCpgAlbum;
import be.khleuven.frank.JCpg.Components.JCpgPicture;
import be.khleuven.frank.JCpg.Editor.JCpgTransform;
import be.khleuven.frank.JCpg.UI.JCpgUI;

/**
 * This class will make it possible to preview the pictures in an album.
 * @author    Frank Cleynen
 */
public class JCpgPreviewer extends JDialog{
	
	
	
																					//*************************************
																					//				VARIABLES	          *
																					//*************************************
	private JCpgUI jCpgUIReference;
	private JCpgAlbum album;
	
	private Dimension screensize;
	
	private JButton close;
	private JPanel preview;
	private JSlider timeslider;
	
	private BufferedImage previewBuffered;
	
	private JCpgTransform transformer = new JCpgTransform();
	
	private Image currentLoadedImage; // holds the currently loaded image to display
	private int currentIndex = 0; // current index for picture array
	private boolean running = true; // as long as this is true, the preview threads will continue running
	private int timeslice = 1000; // time between 2 images
	
	
	
																					//*************************************
																					//				CONSTRUCTORS          *
																					//*************************************
	/**
	 * 
	 * Makes a new JCpgPreviewer object
	 * 
	 * @param jCpgUIReference
	 * 		reference of the UI
	 * @param album
	 * 		album to preview
	 */
	public JCpgPreviewer(JCpgUI jCpgUIReference, JCpgAlbum album){
		
		super(jCpgUIReference);
		
		jCpgUIReference.setEnabled(false);
		
		setJCpgUIReference(jCpgUIReference);
		setAlbum(album);
		initComponents();
		boundComponents();
		placeComponents();
		
	}
	
	
																					
																					//*************************************
																					//				SETTERS		          *
																					//*************************************
	/**
	 * 
	 * Set the previewer UI reference
	 * 
	 * @param jCpgUIReference
	 * 		the previewer UI reference
	 */
	private void setJCpgUIReference(JCpgUI jCpgUIReference){
		
		this.jCpgUIReference = jCpgUIReference;
		
	}
	/**
	 * 
	 * Set the previewer album
	 * 
	 * @param album
	 * 		the previewer album
	 */
	private void setAlbum(JCpgAlbum album){
		
		this.album = album;
		
	}
	
	
	
	
	
	
																					
																					//*************************************
																					//				GETTERS		          *
																					//*************************************
	/**
	 * 
	 * Get the reference to the UI
	 * 
	 * @return
	 * 		the reference to the UI
	 */
	public JCpgUI getJCpgUI(){
		
		return this.jCpgUIReference;
		
	}
	/**
	 * 
	 * Get the album that is previewed
	 * 
	 * @return
	 * 		the album that is previewed	
	 */
	public JCpgAlbum getAlbum(){
		
		return this.album;
		
	}
	/**
	 * 
	 * Get the preview JPanel
	 * 
	 * @return
	 * 		the preview JPanel
	 */
	public JPanel getPreview(){
		
		return this.preview;
		
	}
	/**
	 * 
	 * Get a BufferedImage from the previewed image
	 * 
	 * @return
	 * 		a BufferedImage from the previewed image
	 */
	public BufferedImage getBufferedPreview(){
		
		return this.previewBuffered;
		
	}
	/**
	 * 
	 * Get a reference to the transformer
	 * 
	 * @return
	 * 		a reference to the transformer
	 */
	public JCpgTransform getTransformer(){
		
		return this.transformer;
		
	}
	
	
	
	
	
	
																					
																					//*************************************
																					//				SWING		          *
																					//*************************************
	/**
	 * 
	 * Init swing components
	 *
	 */
	private void initComponents(){
		
		this.setLayout(null);
		
		screensize = Toolkit.getDefaultToolkit().getScreenSize();
		
		preview = new JPanel();
		preview.setBorder(new EtchedBorder());
		preview.setLayout(new FlowLayout());
		preview.setOpaque(false);
		
		close = new JButton("Close");
		
		timeslider = new JSlider(500, 5000);
		timeslider.setValue(1000);
		
		close.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				closeActionPerformed(evt);
			}
		});
		
		timeslider.addChangeListener(new ChangeListener() {
			public void stateChanged(ChangeEvent evt) {
				timesliderValueChanged(evt);
			}
	    });
		
	}
	/**
	 * 
	 * Position components
	 *
	 */
	private void boundComponents(){
		
		this.setBounds((int)(screensize.getWidth()/2)-500, (int)(screensize.getHeight()/2)-350, 1000, 700);
		this.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		this.setUndecorated(true);
		this.setBackground(new Color(0, 138, 196));
		
		preview.setBounds(0, 0, 1000, 700);
		
		close.setBounds(450, 660, 100, 30);
		
		timeslider.setBounds(570, 660, 300, 20);
	
	}
	/**
	 * 
	 * Add components
	 *
	 */
	private void placeComponents(){
		
		this.getContentPane().add(preview);
		this.getContentPane().add(close);
		this.getContentPane().add(timeslider);
		this.setVisible(true);
		
	}
	
	
	
	
	
	
	
	/**
	 * 
	 * This methode will create 2 threads that run 'at the same time'. This is needed to do the previewing correctly. One thread shows the currently loaded picture, the other thread is used
	 * as a timer. Each time the timer finishes, he recalculates the currentIndex variable and sets it to the next picture of the album.
	 *
	 */
	public void startPreview() {
		
		final ArrayList<JCpgPicture> pictures = getAlbum().getPictures();

		// first thread: show the currently loaded picture
		Thread t1 = new Thread(new Runnable() {
			
			public void run() {
				
				while(running){
					
					repaint();
				
				}
				
			}
			
		});

		// second thread: do the waiting and recalculate the currentIndex variable and load that picture
		// TODO: overhead still remains: always loading the pictures will take a lot of RAM
		Thread t2 = new Thread(new Runnable() {
			
			public void run() {
				
				while(running){
					
					try {
						
						Thread.sleep(timeslice);
						
						currentIndex = (currentIndex+1)%pictures.size(); // stay in the correct range of the album's size
						currentLoadedImage = getTransformer().toImage(ImageIO.read(new File(getJCpgUI().getCpgConfig().getValueFor("fullpath")+pictures.get(currentIndex).getFilePath() + pictures.get(currentIndex).getFileName())));
						
					} catch (Exception e) {
						
						e.printStackTrace();
						
					}
					
				}
				
			}
			
		});

		// start the threads
		t1.start();
		t2.start();

	}
	/**
	 * 
	 * Override the paint function: draw the currently loaded picture
	 * 
	 */
	public void paint(Graphics g){
		
		super.paint(g);
		
		try {
			
			g.drawImage(currentLoadedImage, 500 - currentLoadedImage.getWidth(null)/2, 10, this);
			
		} catch (Exception e) {}
		
	}
	
	

	
	
	
	/**
	 * 
	 * Perform right actions when user clicks the close button
	 * 
	 */
	private void closeActionPerformed(java.awt.event.ActionEvent evt) {
		
		getJCpgUI().setEnabled(true);
		this.dispose();
		
	}
	/**
	 * 
	 * Perform right actions when user changes the slider value
	 * 
	 */
	private void timesliderValueChanged(ChangeEvent evt) {
		
		timeslice = timeslider.getValue();
    	
	}

}
