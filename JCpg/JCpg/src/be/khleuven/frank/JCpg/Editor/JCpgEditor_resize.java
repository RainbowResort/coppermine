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
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseMotionListener;
import java.io.File;
import java.io.IOException;

import javax.imageio.ImageIO;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JCheckBox;
import javax.swing.JLabel;
import javax.swing.JTextField;
import javax.swing.SwingUtilities;

import be.khleuven.frank.JCpg.Components.JCpgPicture;
import be.khleuven.frank.JCpg.Resize.JCpgPictureResizer;
import be.khleuven.frank.JCpg.Save.JCpgGallerySaver;
import be.khleuven.frank.JCpg.UI.JCpgUI;


/**
 * Editor: resize
 * @author    Frank Cleynen
 */
public class JCpgEditor_resize extends JCpgEditor implements MouseMotionListener {
	
	
	
																			
																			//*************************************
																			//				VARIABLES             *
																			//*************************************
	private JCpgPictureResizer resizer = new JCpgPictureResizer();
	
	private JLabel msg;
	private JCheckBox constrainProportions;
	
	private Rectangle rleft, rup, rright, rdown;

	private boolean selectedLeft = false, selectedRight = false, selectedUp = false, selectedDown = false, constrainProportionsSelected = true;
	private int upY = 58, downY = 57 + getPicture().getpHeight(), leftX = getPreviewSize().width/2 - getPicture().getpWidth()/2, rightX = getPreviewSize().width/2 - getPicture().getpWidth()/2 + getPicture().getpWidth() - 1;
	
																			
	
	
	
	
	
	
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
	public JCpgEditor_resize(JCpgUI jCpgUIReference, JCpgPicture picture, Dimension previewPosition, Dimension previewSize, int listIndex){
		
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
		
		msg = new JLabel("Drag the upper or right red line to resize");
		msg.setBounds(230, 665, 300, 20);
		
		constrainProportions = new JCheckBox("Constrain proportions", true);
		constrainProportions.setBounds(550, 665, 200, 20);
		constrainProportions.addItemListener(null);
		
		constrainProportions.addItemListener(new ItemListener(){
			public void itemStateChanged(ItemEvent arg0) {
				constrainProportionsStateChanged(arg0);
			}
		});
		
		this.getContentPane().add(msg);
		this.getContentPane().add(constrainProportions);
		
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
		Dimension newDimension = new Dimension(rightX - leftX, downY - upY);
			
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
		getPicture().changeWidth(rightX - leftX);
		getPicture().changeHeight(downY - upY);
		
		try {
			
			Image image = getTransformer().toImage(getBufferedPreview());
			Dimension newDimension = new Dimension(rightX - leftX, downY - upY);
				
			image = resizer.resize(image, newDimension);
			
            ImageIO.write(getTransformer().toBufferedImage(image), getPicture().getFileName().substring(getPicture().getFileName().length()-3, getPicture().getFileName().length()), new File(getJCpgUI().getCpgConfig().getSiteConfig().getValueFor("fullpath") + getPicture().getFilePath() + getPicture().getFileName()));
            JCpgPictureResizer thumb = new JCpgPictureResizer(getJCpgUI(), getJCpgUI().getCpgConfig().getSiteConfig().getValueFor("fullpath") + getPicture().getFilePath(), getPicture().getFileName()); // thumb
			thumb.makeThumb();
			
			// save new changes
			new JCpgGallerySaver(getJCpgUI().getGallery()).saveGallery();
			
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
        
        rright = new Rectangle(rightX, upY - (upY - 58)/2, 1, downY - upY); // right, -1 because else we are just out of the picture
        rleft = new Rectangle(leftX, upY - (upY - 58)/2, 1, downY - upY); // left
        rup = new Rectangle(leftX, upY - (upY - 58)/2, rightX - leftX, 1); // up
        rdown = new Rectangle(leftX, downY - (upY - 58)/2, rightX - leftX, 1); // down, -1 because else we are just out of the picture
        
        // draw in correct color: red = not selected, white = selected  	
        g2.setPaint(Color.red);
        g2.draw(rleft);
        
        g2.setPaint(Color.red);
        g2.draw(rdown);
        
        if(selectedUp){
        	
        	g2.setPaint(Color.white);
        	g2.draw(rup);
        	
        }else{
        	
        	g2.setPaint(Color.red);
        	g2.draw(rup);
        	
        }
        
        if(selectedRight){
        	
        	g2.setPaint(Color.white);
        	g2.draw(rright);
        	
        }else{
        	
        	g2.setPaint(Color.red);
        	g2.draw(rright);
        	
        }
        
        g2.dispose();
        
    }







	public void mouseDragged(MouseEvent m) {
		
		// drag up line
		if(selectedUp){
			
			upY = 58 + m.getY() * 2;
			
			// if we must constrain proportions, also correctly change the width
			if(constrainProportionsSelected){ 
				
				float proportion = (downY - upY) / getPicture().getpHeight();
				rightX = (int)(getPreviewSize().width/2 - getPicture().getpWidth()/2 + (getPicture().getpWidth() * proportion) - 1);
				
			}
			
			if(upY < 58)
				upY = 58;
			if(upY > downY - 10)
				upY = downY -10;
			
			repaint();
			
		}
		
		// drag right line
		if(selectedRight){
			
			rightX = getPreviewSize().width/2 - getPicture().getpWidth()/2 + getPicture().getpWidth() - 1 - (getPicture().getpWidth() - m.getX());
			
			// if we must constrain proportions, also correctly change the height
			if(constrainProportionsSelected){ 
				
				float proportion = (rightX - leftX) / getPicture().getpWidth();
				downY = (int)(57 + (getPicture().getpHeight() * proportion));
				upY = (int)((57 + (getPicture().getpHeight() - getPicture().getpHeight() * proportion))/2);
				
			}
			
			if(rightX < leftX + 10)
				rightX = leftX + 10;
			if(rightX > getPreviewSize().width/2 - getPicture().getpWidth()/2 + getPicture().getpWidth() - 1)
				rightX = getPreviewSize().width/2 - getPicture().getpWidth()/2 + getPicture().getpWidth() - 1;
				
			repaint();
			
		}
		
		preview();
	
	}








	public void mouseMoved(MouseEvent m) {
		
		Point p = m.getPoint();
		
		Point e = new Point();
		e.x = (int) (getPreviewSize().width/2 - getPicture().getpWidth()/2 + p.getX());
		e.y = (int) (p.getY() + 58);
		
		// check if mouse is over one of the lines
		// up
		if(rup.contains(e))
			selectedUp = true;
		else
			selectedUp = false;
		
		// right
		if(rright.contains(e))
			selectedRight = true;
		else
			selectedRight = false;
		
		repaint();
		
	}
	
	
	
	private void constrainProportionsStateChanged(ItemEvent arg0) {
		
		if(arg0.getStateChange() == ItemEvent.DESELECTED)
			constrainProportionsSelected = false;
		
		if(arg0.getStateChange() == ItemEvent.SELECTED)
			constrainProportionsSelected = true;
    	
	}

}
