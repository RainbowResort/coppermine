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
import java.awt.event.MouseEvent;
import java.awt.event.MouseMotionListener;
import java.io.File;
import java.io.IOException;

import javax.imageio.ImageIO;
import javax.swing.ImageIcon;
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
public class JCpgEditorCrop extends JCpgEditor implements MouseMotionListener {
	
	
	
	
	
	
																			
																			//*************************************
																			//				VARIABLES             *
																			//*************************************
	private Rectangle crop = null; // this is the rectangle used to point to the area that has to be cropped

	
	private Rectangle rleft, rup, rright, rdown; // selection blocks
	private Rectangle sleft, sup, sright, sdown; // selection blocks
	
	private boolean selectedRight = false, selectedUp = false, selectedLeft = false, selectedDown = false, selectedCrop = false, touchingBounderies = false;;
	
	private Point mouseposition = new Point();
																			
	
	
	
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
	public JCpgEditorCrop(JCpgUI jCpgUIReference, JCpgPicture picture, Dimension previewPosition, Dimension previewSize, int listIndex){
		
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
		
		getPreviewscroll().addMouseMotionListener(this);
		
		// rectangle start values
        rup = new Rectangle(getImageLabel().getLocation().x + getImageLabel().getSize().width / 4, getImageLabel().getLocation().y + getImageLabel().getSize().height / 4 + 50, getImageLabel().getSize().width / 4, 1); // up
        rdown = new Rectangle(getImageLabel().getLocation().x + getImageLabel().getSize().width / 4, getImageLabel().getLocation().y + getImageLabel().getSize().height / 2 + 50, getImageLabel().getSize().width / 4, 1); // down
        rright = new Rectangle(getImageLabel().getLocation().x + getImageLabel().getSize().width / 2, getImageLabel().getLocation().y + getImageLabel().getSize().height / 4 + 50, 1, rdown.y - rup.y); // right
        rleft = new Rectangle(getImageLabel().getLocation().x + getImageLabel().getSize().width / 4, getImageLabel().getLocation().y + getImageLabel().getSize().height / 4 + 50, 1, rdown.y - rup.y); // left

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
        
        // select lines
        rright = new Rectangle(rright.x, rup.y, 1, rdown.y - rup.y); // right
        rleft = new Rectangle(rleft.x, rup.y, 1, rdown.y - rup.y); // left
        rup = new Rectangle(rleft.x, rup.y, rright.x - rleft.x, 1); // up
        rdown = new Rectangle(rleft.x, rdown.y, rright.x - rleft.x, 1); // down

        // select rectangle
        g2.setPaint(Color.red);
        
        g2.fill(rright);
        g2.fill(rleft);
        g2.fill(rup);
        g2.fill(rdown);
        
        // selection blocks
        sright = new Rectangle(rright.x - 5, rright.y + rright.height / 2 - 5, 10, 10);
        sup = new Rectangle(rup.x + rup.width / 2 - 5, rup.y - 5, 10, 10);
        sleft = new Rectangle(rleft.x - 5, rleft.y + rleft.height / 2 - 5, 10, 10);
        sdown = new Rectangle(rdown.x + rdown.width / 2 - 5, rdown.y - 5, 10, 10);
        
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
			
			// correct coordinates if just out of label
			int leftx = 0;
			if(rleft.x <= getImageLabel().getLocation().x){
				
				leftx = getImageLabel().getLocation().x;
				
			}else{
				
				leftx = rleft.x;
				
			}
			
			int lefty = 0;
			if(rleft.y <= 58){
				
				lefty = 58;
				
			}else{
				
				lefty = rleft.y;
				
			}
			
            ImageIO.write(getBufferedPreview().getSubimage(leftx - getImageLabel().getLocation().x, lefty - 58, rup.width, rleft.height), getPicture().getFileName().substring(getPicture().getFileName().length()-3, getPicture().getFileName().length()), new File(getJCpgUI().getCpgConfig().getSiteConfig().getValueFor("fullpath") + getPicture().getFilePath() + getPicture().getFileName()));
            JCpgPictureResizer thumb = new JCpgPictureResizer(getJCpgUI(), getJCpgUI().getCpgConfig().getSiteConfig().getValueFor("fullpath") + getPicture().getFilePath(), getPicture().getFileName()); // thumb
			thumb.makeThumb();
            
			// change picture size information
			getPicture().changeWidth(rup.width);
			getPicture().changeHeight(rleft.height);
			
			// save this new information
			new JCpgGallerySaver(getJCpgUI().getGallery()).saveGallery();
			
			//getJCpgUI().getPictureList().remove(getListIndex());
			//getJCpgUI().getPictureListModel().add(getListIndex(), getPicture());
			
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
		
		// mouse inside rectangle -> move it
		if(selectedCrop && !selectedRight && !selectedUp && !selectedDown && !selectedLeft && !touchingBounderies){
			
			rleft.x = mouseposition.x - rup.width / 2;
			rup.y = mouseposition.y + 50 - rleft.height / 2;
			rright.x = mouseposition.x + rup.width / 2;
			rdown.y = mouseposition.y + 50 + rleft.height / 2;
		
		}
		
		if(selectedLeft){
			
			rleft.x = mouseposition.x;
			
		}
		if(selectedDown){
			
			rdown.y = mouseposition.y + 50;
			
		}
		if(selectedRight){
	
			rright.x = mouseposition.x;
	
		}
		if(selectedUp){
	
			rup.y = mouseposition.y + 50;
	
		}
		
		// bounderies
		if(rleft.x < getImageLabel().getLocation().x){
			rleft.x = getImageLabel().getLocation().x;
			touchingBounderies = true;
		}else if(rleft.x > rright.x - 10){
			rleft.x = rright.x - 10;
			touchingBounderies = true;
		}else if(rup.y < getImageLabel().getLocation().y + 50){
			rup.y = getImageLabel().getLocation().y + 50 + 1;
			touchingBounderies = true;
		}else if(rup.y > rdown.y - 10){
			rup.y = rdown.y - 10;
			touchingBounderies = true;
		}else if(rright.x > getImageLabel().getLocation().x + getImageLabel().getSize().width){
			rright.x = getImageLabel().getLocation().x + getImageLabel().getSize().width;
			touchingBounderies = true;
		}else if(rright.x < rleft.x + 10){
			rright.x = rleft.x + 10;
			touchingBounderies = true;
		}else if(rdown.y > getImageLabel().getLocation().y + getImageLabel().getSize().height + 50){
			rdown.y = getImageLabel().getLocation().y + getImageLabel().getSize().height + 50;
			touchingBounderies = true;
		}else if(rdown.y < rup.y + 10){
			rdown.y = rup.y + 10;
			touchingBounderies = true;
		}else
			touchingBounderies = false;
		
		repaint();
		
	}




	public void mouseMoved(MouseEvent m) {
	
		Point p = m.getPoint();
		
		p.y = p.y + 50;
		
		// check if mouse is in crop rectangle
		if(p.x > rleft.x && p.x < rright.x && p.y > rup.y && p.y < rdown.y)
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