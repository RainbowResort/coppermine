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

import java.awt.AlphaComposite;
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
	
	private int rwidth;
	private int rheight;
	private int rx;
	private int ry;
	
	private int LEFT = getImageLabel().getLocation().x; // photo bounderies
	private int UP = getImageLabel().getLocation().y + 50;
	private int RIGHT = LEFT + getPicture().getpWidth();
	private int DOWN = UP + getPicture().getpHeight();
	
	private Rectangle sleft, sup, sright, sdown; // selection blocks
	
	private boolean selectedRight = false, selectedUp = false, selectedLeft = false, selectedDown = false, selectedCrop = false;;
	
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
		
		this.addMouseMotionListener(this);
		
		rx = getImageLabel().getLocation().x + getImageLabel().getSize().width / 4;
		ry = 50 + getImageLabel().getLocation().y + getImageLabel().getSize().height / 4;
		rwidth = getPicture().getpWidth() / 4;
		rheight = getPicture().getpHeight() / 4;
		
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
        crop.setLocation(rx, ry);
        g2.draw(crop);
        
        // selection blocks
        sright = new Rectangle(crop.x + crop.width - 5, crop.y  + (crop.height / 2) - 5, 10, 10);
        sleft = new Rectangle(crop.x - 5, crop.y  + (crop.height / 2) - 5, 10, 10);
        sup = new Rectangle(crop.x + crop.width / 2 - 5, crop.y - 5, 10, 10);
        sdown = new Rectangle(crop.x + crop.width / 2 - 5, crop.y + crop.height - 5, 10, 10);
        
        if(selectedRight){
        	
        	g2.setPaint(Color.white);
        	g2.fill(sright);
        	
        }else{
        	
        	g2.setPaint(Color.red);
        	g2.fill(sright);
        	
        }
        
        if(selectedUp){
        	
        	g2.setPaint(Color.white);
        	g2.fill(sup);
        	
        }else{
        	
        	g2.setPaint(Color.red);
        	g2.fill(sup);
        	
        }
        
        if(selectedLeft){
        	
        	g2.setPaint(Color.white);
        	g2.fill(sleft);
        	
        }else{
        	
        	g2.setPaint(Color.red);
        	g2.fill(sleft);
        	
        }
        
        if(selectedDown){
        	
        	g2.setPaint(Color.white);
        	g2.fill(sdown);
        	
        }else{
        	
        	g2.setPaint(Color.red);
        	g2.fill(sdown);
        	
        }
        
        // invert selection rectangles
        Point position = crop.getLocation();
        
        float alpha = 0.75f;
        int type = AlphaComposite.SRC_OVER; 
        AlphaComposite composite = AlphaComposite.getInstance(type, alpha);
        
        g2.setPaint(new Color(0, 0, 0, alpha));
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
			
			//getJCpgUI().getPictureList().remove(getListIndex());
			//getJCpgUI().getPictureListModel().add(getListIndex(), getPicture());
            
			running = false; // stop repaint thread
			
			getJCpgUI().changeMegaExplorerActive();
			getJCpgUI().changeMegaExplorerActive();
			
            getJCpgUI().setEnabled(true);
            this.dispose();
            
        } catch(IOException e){
        	
            System.out.println("JCpgEditor: Couldn't save edited photo");
            
        }
        
        SwingUtilities.updateComponentTreeUI(getJCpgUI().getTree()); // workaround for Java bug 4173369

		return null;
		
	}




	
	

	public void mouseDragged(MouseEvent m) {
		
		mouseposition = m.getPoint();
		cropposition = crop.getLocation();
		
		// mouse inside rectangle -> move it
		if(selectedCrop && !selectedRight && !selectedUp){
			
			rx = mouseposition.x - (crop.width / 2);
			ry = mouseposition.y - 50 - getImageLabel().getLocation().y + (crop.height / 2);
		
		}
		
		// bounderies
		if(rx < getImageLabel().getLocation().x) rx = getImageLabel().getLocation().x;
		if(rx + rwidth > getImageLabel().getLocation().x + getImageLabel().getSize().width) rx = getImageLabel().getLocation().x + getImageLabel().getSize().width - crop.width;
			
		if(ry < 50 + getImageLabel().getLocation().y) ry = 50 + getImageLabel().getLocation().y;
		if(ry + rheight > 50 + getImageLabel().getLocation().y + getImageLabel().getSize().height) ry = 50 + getImageLabel().getLocation().y + getImageLabel().getSize().height - crop.height;
		
		// resize rectangle
		if(selectedUp){
			
			rheight++;
			
		}
		
		repaint();
		
	}




	public void mouseMoved(MouseEvent m) {
	
		Point p = m.getPoint();
		
		// check if mouse is in crop rectangle
		if(crop.contains(p))
			selectedCrop = true;
		else
			selectedCrop = false;
		
		
		// check if mouse is over one of the lines
		// up
		if(sup.contains(p))
			selectedUp = true;
		else
			selectedUp = false;
		
		// right
		if(sright.contains(p))
			selectedRight = true;
		else
			selectedRight = false;
		
		// left
		if(sleft.contains(p))
			selectedLeft = true;
		else
			selectedLeft = false;
		
		// down
		if(sdown.contains(p))
			selectedDown = true;
		else
			selectedDown = false;
		
		repaint();
		
	}
	
}