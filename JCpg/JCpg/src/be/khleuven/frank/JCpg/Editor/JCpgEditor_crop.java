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

package be.khleuven.frank.JCpg.Editor;

import java.awt.Color;
import java.awt.Dimension;
import java.awt.Graphics;
import java.awt.Graphics2D;
import java.awt.Point;
import java.awt.Rectangle;
import java.awt.RenderingHints;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseMotionListener;
import java.awt.geom.Line2D;
import java.io.File;
import java.io.IOException;

import javax.imageio.ImageIO;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.SwingUtilities;

import be.khleuven.frank.JCpg.Components.JCpgPicture;
import be.khleuven.frank.JCpg.Resize.JCpgPictureResizer;
import be.khleuven.frank.JCpg.Save.JCpgGallerySaver;
import be.khleuven.frank.JCpg.UI.JCpgUI;


/**
 * 
 * Editor: crop
 * The Crop Editor will paint a rectangle on the image. This rectangle can be moved with the mouse and can also be set bigger or smaller by the user.
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgEditor_crop extends JCpgEditor implements MouseMotionListener {
	
	
	
	
	
	
																			
																			//*************************************
																			//				VARIABLES             *
																			//*************************************
	private Rectangle crop = null; // this is the rectangle used to point to the area that has to be cropped
	private JButton xplus;
	private JButton xminus;
	private JButton yplus;
	private JButton yminus;
	
	private int rwidth;
	private int rheight;
	private int rx;
	private int ry;
	
	private int LEFT = getPreviewSize().width/2-getPicture().getpWidth()/2; // photo bounderies
	private int UP = 59;
	private int RIGHT = LEFT + getPicture().getpWidth();
	private int DOWN = UP + getPicture().getpHeight();
	
	private Point mouseposition = new Point();
	private Point cropposition = new Point();
	
	
	
	private boolean running = true; // for paint thread
																			
	
	
	
																			//*************************************
																			//				CONSTRUCTOR           *
																			//*************************************
	/**
	 * 
	 * Makes a new JCpgEditor_crop object
	 * 
	 * @param jCpgUIReference
	 * 		reference to the UI
	 * @param picture
	 * 		picture that needs effect
	 * @param previewPosition
	 * 	 	position of preview JPanel
	 * @param previewSize
	 * 		size of preview JPanel
	 */
	public JCpgEditor_crop(JCpgUI jCpgUIReference, JCpgPicture picture, Dimension previewPosition, Dimension previewSize, int listIndex){
		
		super(jCpgUIReference, picture, previewPosition, previewSize, listIndex);
		
		doExtraSwingComponents();
		
	}
	
	
	
																			
																			//*************************************
																			//				SWING	              *
																			//*************************************
	/**
	 * 
	 * Do extra swing stuff specifically for the add picture window: we need a browe button so the user can choose a picture
	 *
	 */
	private void doExtraSwingComponents(){
		
		getImageLabel().addMouseMotionListener(this);
		
		rx = getImageLabel().getSize().width / 4;
		ry = getImageLabel().getSize().height / 4;
		rwidth = getPicture().getpWidth() / 4;
		rheight = getPicture().getpHeight() / 4;
		
		xplus = new JButton("xWider");
		xminus = new JButton("xSmaller");
		yplus = new JButton("yWider");
		yminus = new JButton("ySmaller");
		
		xplus.setBounds(330, 660, 100, 30);
		xminus.setBounds(430, 660, 100, 30);
		yplus.setBounds(530, 660, 100, 30);
		yminus.setBounds(630, 660, 100, 30);
		
		this.getContentPane().add(xplus);
		this.getContentPane().add(xminus);
		this.getContentPane().add(yplus);
		this.getContentPane().add(yminus);
		
		xplus.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				xplusActionPerformed(evt);
			}
		});
		xminus.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				xminusActionPerformed(evt);
			}
		});
		yplus.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				yplusActionPerformed(evt);
			}
		});
		yminus.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				yminusActionPerformed(evt);
			}
		});
		
		crop = new Rectangle(rwidth, rheight);
		
		// we introduce a thread to continiously draw the black rectangles around the crop rectangle, otherwhise sometimes these will disappear
		Thread t1 = new Thread(new Runnable() {
			
			public void run() {
				
				while(running){
					
					repaint();
				
				}
				
			}
			
		});
		
		//t1.start();

	}
	/**
	 * 
	 * Overrided version of the paint methode: paint the crop square and the excluding black squares
	 * 
	 */
	public void paint(Graphics g){
		
        super.paint(g);
        
        Graphics2D g2 = (Graphics2D)g;
        g2.setRenderingHint(RenderingHints.KEY_ANTIALIASING, RenderingHints.VALUE_ANTIALIAS_ON);

        // select rectangle
        g2.setPaint(Color.red);
        
        crop.setSize(rwidth, rheight);
        crop.setLocation(rx + (getPreviewSize().width/2 - getImageLabel().getSize().width/2), ry + UP);
        g2.draw(crop);
        
        // invert selection rectangles
        Point position = crop.getLocation();
        
        g2.setPaint(Color.black);
        
        g2.fillRect(LEFT, UP, position.x - LEFT, getPicture().getpHeight()); // left
        g2.fillRect(LEFT, UP, getPicture().getpWidth(), position.y - UP); // up
        g2.fillRect(position.x + rwidth + 1, UP, getPreview().getWidth() - position.x - LEFT - rwidth, getPicture().getpHeight()); // right
        g2.fillRect(LEFT, position.y + rheight + 1, getPicture().getpWidth(), getPicture().getpHeight() + UP - position.y - rheight - 1); // under
        
        g2.dispose();
        
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
																			
																			// *************************************
																			// 					EVENTS			   *
																			// *************************************
	/**
	 * 
	 * Perform the right actions when the user presses the 'Apply' button. Save
	 * the current buffered image to the right file. Custom for resize: save new
	 * image size
	 * 
	 */	
	public ImageIcon performEdit() {
		
		try {
			
            ImageIO.write(getBufferedPreview().getSubimage(rx, ry, rwidth, rheight), getPicture().getFileName().substring(getPicture().getFileName().length()-3, getPicture().getFileName().length()), new File(getJCpgUI().getCpgConfig().getSiteConfig().getValueFor("fullpath") + getPicture().getFilePath() + getPicture().getFileName()));
            JCpgPictureResizer thumb = new JCpgPictureResizer(getJCpgUI(), getJCpgUI().getCpgConfig().getSiteConfig().getValueFor("fullpath") + getPicture().getFilePath(), getPicture().getFileName()); // thumb
			thumb.makeThumb();
            
			// change picture size information
			getPicture().changeWidth(rwidth);
			getPicture().changeHeight(rheight);
			
			// save this new information
			new JCpgGallerySaver(getJCpgUI().getGallery()).saveGallery();
			
			getJCpgUI().getPictureList().remove(getListIndex());
			getJCpgUI().getPictureListModel().add(getListIndex(), getPicture());
            
			running = false; // stop repaint thread
			
            getJCpgUI().setEnabled(true);
            this.dispose();
            
        } catch(IOException e){
        	
            System.out.println("JCpgEditor: Couldn't save edited photo");
            
        }
        
        SwingUtilities.updateComponentTreeUI(getJCpgUI().getTree()); // workaround for Java bug 4173369

		return null;
		
	}
	/**
	 * 
	 * Make crop square wider (horizontal)
	 * 
	 */
	private void xplusActionPerformed(java.awt.event.ActionEvent evt) {
		
		Point position = crop.getLocation();
		
		if(position.x + rwidth + 1 != RIGHT){
			
			rwidth++;
			repaint();
			
		}
    	
	}
	/**
	 * 
	 * Make crop square smaller (horizontal)
	 * 
	 */
	private void xminusActionPerformed(java.awt.event.ActionEvent evt) {
		
		Point position = crop.getLocation();
		
		if(position.x + rwidth - 1 != position.x){
		
			rwidth--;
			repaint();
			
		}
	    	
	}
	/**
	 * 
	 * Make crop square wider (vertical)
	 * 
	 */
	private void yplusActionPerformed(java.awt.event.ActionEvent evt) {
		
		Point position = crop.getLocation();
		
		if(position.y + rheight + 1 != DOWN){
			
			rheight++;
			repaint();
			
		}
		
	}
	/**
	 * 
	 * Make crop square smaller (vertical)
	 * 
	 */
	private void yminusActionPerformed(java.awt.event.ActionEvent evt) {
		
		Point position = crop.getLocation();
		
		if(position.y + rheight -1 != position.y){
			
			rheight--;
			repaint();
			
		}
		
	}



	
	

	public void mouseDragged(MouseEvent m) {
		
		mouseposition = m.getPoint();
		cropposition = crop.getLocation();
		
		Line2D.Double l1 = new Line2D.Double(cropposition.x, cropposition.y, cropposition.x + crop.width, cropposition.y);
		Line2D.Double l2 = new Line2D.Double(cropposition.x, cropposition.y, cropposition.x, cropposition.y  + crop.height);
		Line2D.Double l3 = new Line2D.Double(cropposition.x, cropposition.y + crop.height, cropposition.x + crop.width, cropposition.y  + crop.height);
		Line2D.Double l4 = new Line2D.Double(cropposition.x + crop.width, cropposition.y, cropposition.x + crop.width, cropposition.y  + crop.height);
		
		// if user starts dragging the mouse when on one of the crop rectange borders, the rectangle is resized
		if(l1.contains(mouseposition) || l2.contains(mouseposition) || l3.contains(mouseposition) || l4.contains(mouseposition)){
			
			rwidth++;
			rheight++;
			
		}else{
		
			rx = mouseposition.x;
			ry = mouseposition.y;
			
			// bounderies
			if(rx < 0) rx = 0;
			if(rx + rwidth > getImageLabel().getSize().width) rx = getImageLabel().getSize().width - rwidth;
			
			if(ry < 0) ry = 0;
			if(ry + rheight > getImageLabel().getSize().height) ry = getImageLabel().getSize().height - rheight;
		
		}
		
		repaint();
		
	}




	public void mouseMoved(MouseEvent m) {
	
		
	}
	
}