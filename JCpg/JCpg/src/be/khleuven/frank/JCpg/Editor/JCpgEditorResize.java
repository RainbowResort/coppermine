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
import java.awt.Image;
import java.awt.Point;
import java.awt.Rectangle;
import java.awt.RenderingHints;
import java.awt.event.MouseEvent;
import java.awt.event.MouseMotionListener;
import java.io.File;
import java.io.IOException;

import javax.imageio.ImageIO;
import javax.swing.ImageIcon;
import javax.swing.JLabel;
import javax.swing.SwingUtilities;

import be.khleuven.frank.JCpg.Components.JCpgPicture;
import be.khleuven.frank.JCpg.Resize.JCpgPictureResizer;
import be.khleuven.frank.JCpg.Save.JCpgGallerySaver;
import be.khleuven.frank.JCpg.UI.JCpgUI;


/**
 * Editor: resize
 * @author    Frank Cleynen
 */
public class JCpgEditorResize extends JCpgEditor implements MouseMotionListener {
	
	
	
																			
																			//*************************************
																			//				VARIABLES             *
																			//*************************************
	private static final long serialVersionUID = 1L;
	
	private JCpgPictureResizer resizer = new JCpgPictureResizer();
	
	private JLabel msg;
	
	private Rectangle rleft, rup, rright, rdown; // lines
	private Rectangle sup, sright; // selection blocks

	private boolean selectedRight = false, selectedUp = false;
	
	
	
	
	
	
																			//*************************************
																			//				CONSTRUCTOR           *
																			//*************************************
	/**
	 * 
	 * Makes a new JCpgEditor_colors object
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
	public JCpgEditorResize(JCpgUI jCpgUIReference, JCpgPicture picture, Dimension previewPosition, Dimension previewSize, int listIndex){
		
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
		
		// default rectangle positions
		rright = new Rectangle(getImageLabel().getLocation().x + getImageLabel().getWidth(), getImageLabel().getLocation().y + 50, 5, getImageLabel().getHeight()); // right
        rleft = new Rectangle(getImageLabel().getLocation().x, getImageLabel().getLocation().y + 50, 5, getImageLabel().getHeight()); // left
        rup = new Rectangle(getImageLabel().getLocation().x, getImageLabel().getLocation().y + 50, getImageLabel().getWidth(), 5); // up
        rdown = new Rectangle(getImageLabel().getLocation().x - 5, getImageLabel().getLocation().y + getImageLabel().getHeight() + 50, getImageLabel().getWidth() + 10, 5); // down
		
		msg = new JLabel("Drag the upper or right red line to resize");
		msg.setBounds(230, 665, 300, 20);
		
	}
	
	
	
	
																			
																			//*************************************
																			//				EVENTS	              *
																			//*************************************
	/**
	 * 
	 * Do the resize effect
	 * 
	 */
	private void preview() {

		Image image = getTransformer().toImage(getBufferedPreview());
		Dimension newDimension = new Dimension(rright.x - rleft.x, rdown.y - rup.y);
			
		image = resizer.resize(image, newDimension);
		
		getImageLabel().setIcon(new ImageIcon(image));
    	
	}
	
	/**
	 * 
	 * Perform the right actions when the user presses the 'Apply' button. Save the current buffered image to the right file.
	 * Custom for resize: save new image size
	 * 
	 */
	public ImageIcon performEdit() {
		
		// change picture size information
		getPicture().changeWidth(rright.x - rleft.x);
		getPicture().changeHeight(rdown.y - rup.y);
		
		try {
			
			Image image = getTransformer().toImage(getBufferedPreview());
			Dimension newDimension = new Dimension(rright.x - rleft.x, (rdown.y - rup.y) / 4);
				
			image = resizer.resize(image, newDimension);
			
            ImageIO.write(JCpgTransform.toBufferedImage(image), getPicture().getFileName().substring(getPicture().getFileName().length()-3, getPicture().getFileName().length()), new File(getJCpgUI().getCpgConfig().getSiteConfig().getValueFor("fullpath") + getPicture().getFilePath() + getPicture().getFileName()));
            JCpgPictureResizer thumb = new JCpgPictureResizer(getJCpgUI(), getJCpgUI().getCpgConfig().getSiteConfig().getValueFor("fullpath") + getPicture().getFilePath(), getPicture().getFileName()); // thumb
			thumb.makeThumb();
			
			// save new changes
			new JCpgGallerySaver(getJCpgUI().getGallery(), getJCpgUI().getCpgConfig().getUserConfig().getId()).saveGallery();
			
			//getJCpgUI().getPictureList().remove(getListIndex());
			//getJCpgUI().getPictureListModel().add(getListIndex(), getPicture());
            
            getJCpgUI().setEnabled(true);
            this.dispose();
            
        } catch(IOException e){
        	
            System.out.println("JCpgEditor: Couldn't save edited photo");
            
        }
        
        SwingUtilities.updateComponentTreeUI(getJCpgUI().getTree()); // workaround for Java bug 4173369

		return null;
		
	}

	
	
	
	
	public void paint(Graphics g){
		
        super.paint(g);
        
        Graphics2D g2 = (Graphics2D)g;
        g2.setRenderingHint(RenderingHints.KEY_ANTIALIASING, RenderingHints.VALUE_ANTIALIAS_ON);
        
        // handles
        rright = new Rectangle(rright.x, rup.y, 5, rdown.y - rup.y); // right
        rleft = new Rectangle(rleft.x, rup.y, 5, rdown.y - rup.y); // left
        rup = new Rectangle(rleft.x, rup.y, rright.x - rleft.x, 5); // up
        rdown = new Rectangle(rleft.x, rdown.y, rright.x - rleft.x + 5, 5); // down
        
        // selection blocks
        sright = new Rectangle(rright.x - 2, rright.y + rright.height / 2, 10, 10);
        sup = new Rectangle(rup.x + rup.width / 2, rup.y - 2, 10, 10);
        
        // draw in correct color: red = not selected, white = selected  	
        g2.setPaint(Color.red);
        g2.fill(rleft);
        g2.fill(rdown);
        g2.fill(rup);
        g2.fill(rright);
        
        // draw selection blocks
        if(selectedUp){
        	
        	g2.setPaint(Color.white);
        	g2.fill(sup);
        	
        }else{
        	
        	g2.setPaint(Color.red);
        	g2.fill(sup);
        	
        }
        
        if(selectedRight){
        	
        	g2.setPaint(Color.white);
        	g2.fill(sright);
        	
        }else{
        	
        	g2.setPaint(Color.red);
        	g2.fill(sright);
        	
        }
        
        g2.dispose();
        
    }







	public void mouseDragged(MouseEvent m) {
		
		// drag up line
		if(selectedUp){
			
			rup.y = m.getY() + 50;
			rdown.y = (getImageLabel().getLocation().y + getImageLabel().getSize().height + 50) - ((rup.y - 58));

			repaint();
			
		}

		// drag right line
		if(selectedRight){
			
			rright.x = m.getX();
				
			repaint();
			
		}
		
		// bounderies
		if(rup.y < getImageLabel().getLocation().y + 50)
			rup.y = getImageLabel().getLocation().y + 50;
		
		if(rright.x < rleft.x + 10)
			rright.x = rleft.x + 10;
		if(rright.x > getImageLabel().getLocation().x + getImageLabel().getSize().width)
			rright.x = getImageLabel().getLocation().x + getImageLabel().getSize().width;
		
		if(rdown.y > getImageLabel().getLocation().y + getImageLabel().getHeight() + 50)
			rdown.y = getImageLabel().getLocation().y + getImageLabel().getHeight() + 50;
		
		if(rdown.y < getImageLabel().getLocation().y + getImageLabel().getHeight() / 2 + 50 + 10)
			rdown.y = getImageLabel().getLocation().y + getImageLabel().getHeight() / 2 + 50 + 10;
		if(rup.y > getImageLabel().getLocation().y + getImageLabel().getHeight() / 2 + 50 - 10)
			rup.y = getImageLabel().getLocation().y + getImageLabel().getHeight() / 2 + 50 - 10;
		
		preview();
	
	}








	public void mouseMoved(MouseEvent m) {
		
		Point p = m.getPoint();
		
		p.y = p.y + 50;
		
		// check if mouse is over one of the selection blocks
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
		
		repaint();
		
	}

}
