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

import be.khleuven.frank.JCpg.Components.JCpgAlbum;
import be.khleuven.frank.JCpg.Editor.JCpgTransform;
import be.khleuven.frank.JCpg.UI.JCpgUI;
import java.awt.Color;
import java.awt.Dimension;
import java.awt.FlowLayout;
import java.awt.Graphics2D;
import java.awt.Image;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import javax.imageio.ImageIO;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.SwingUtilities;
import javax.swing.border.EtchedBorder;

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
	
	private BufferedImage previewBuffered;
	
	private JCpgTransform transformer = new JCpgTransform();
	
	
	
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
	/**
	 * 
	 * Set the buffered preview image
	 * 
	 * @param picture
	 * 		ImageIcon that will be converted to the buffered previes image
	 */
	private void setBufferedPreview(ImageIcon picture){
		
		this.previewBuffered = transformer.toBufferedImage(picture.getImage());
		
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
		this.setAlwaysOnTop(true);
		
		screensize = Toolkit.getDefaultToolkit().getScreenSize();
		
		preview = new JPanel();
		preview.setBorder(new EtchedBorder());
		preview.setLayout(new FlowLayout());
		preview.setOpaque(false);
		
		close = new JButton("Close");
		
		close.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				closeActionPerformed(evt);
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
		this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		this.setUndecorated(true);
		
		preview.setBounds(0, 0, 1000, 700);
		
		close.setBounds(450, 660, 100, 30);
	
	}
	/**
	 * 
	 * Add components
	 *
	 */
	private void placeComponents(){
		
		this.getContentPane().add(preview);
		this.getContentPane().add(close);
		this.setVisible(true);
		
	}
	
	
	
	
	
	
	
	
	public void run(){
		
		try{
			
			JButton image;
			Dimension realSize;
			
			BufferedImage pic1 = ImageIO.read(new File("data/createalbum_logo.jpg")); // begin pictures
			
			Image imageFromBuffered = transformer.toImage(pic1);
	    	ImageIcon imageIcon = new ImageIcon(imageFromBuffered);
		    
	    	image = new JButton(imageIcon);
	    	realSize = new Dimension(imageIcon.getIconWidth(), imageIcon.getIconHeight());
	    	image.setPreferredSize(realSize);
	    	getPreview().removeAll();
	    	getPreview().add(image);
	    	SwingUtilities.updateComponentTreeUI(preview); // workaround for Java bug 4173369
    	
		}catch(Exception e){}
		
	}
	
	
	
	
	

	
	
	
	
	
	
	
	
	public static Color combine(Color c1, Color c2, double alpha) {
		
        int r = (int) (alpha * c1.getRed()   + (1 - alpha) * c2.getRed());
        int g = (int) (alpha * c1.getGreen() + (1 - alpha) * c2.getGreen());
        int b = (int) (alpha * c1.getBlue()  + (1 - alpha) * c2.getBlue());
        
        return new Color(r, g, b);
        
    }
	public void startPreview(int frames, String pic1path, String pic2path) {
		
		int color, r, g, b;
        
		try {
			
			BufferedImage pic1 = ImageIO.read(new File(pic1path)); // begin pictures
			BufferedImage pic2 = ImageIO.read(new File(pic2path)); // end picture
			
		    int width  = pic1.getWidth();
		    int height = pic1.getHeight();
		        
		    BufferedImage pic = new BufferedImage(width, height, BufferedImage.TYPE_INT_RGB);
		    Graphics2D g2d = pic.createGraphics();    // Get a Graphics2D object
		        
		    for (int n = 0; n <= frames; n++) {

				double alpha = 1.0 * n / frames;

				for (int i = 0; i < width; i++) {

					for (int j = 0; j < height; j++) {

						color = pic1.getRGB(i, j);
						Color c1 = new Color((color & 0x00ff0000) >> 16, (color & 0x0000ff00) >> 8, color & 0x000000ff);

						color = pic2.getRGB(i, j);
						Color c2 = new Color((color & 0x00ff0000) >> 16, (color & 0x0000ff00) >> 8, color & 0x000000ff);

						g2d.setColor(combine(c2, c1, alpha));
						g2d.drawLine(i, j, i, j);

					}

				}

				Image imageFromBuffered = transformer.toImage(pic);
		    	ImageIcon imageIcon = new ImageIcon(imageFromBuffered);
			    
		    	JButton image = new JButton(imageIcon);
		    	Dimension realSize = new Dimension(imageIcon.getIconWidth(), imageIcon.getIconHeight());
		    	image.setPreferredSize(realSize);
		    	getPreview().removeAll();
		    	getPreview().add(image);
		    	SwingUtilities.updateComponentTreeUI(preview); // workaround for Java bug 4173369
				
			}
		        
		} catch (IOException e) {
			
			
		}
        
    }
	
	

	
	
	
	
	private void closeActionPerformed(java.awt.event.ActionEvent evt) {
		
		getJCpgUI().setEnabled(true);
		this.dispose();
		
	}

}
