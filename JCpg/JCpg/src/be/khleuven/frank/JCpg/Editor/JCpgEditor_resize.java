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
import java.awt.event.MouseEvent;
import java.awt.event.MouseMotionListener;
import java.io.File;
import java.io.IOException;

import javax.imageio.ImageIO;
import javax.swing.ImageIcon;
import javax.swing.JButton;
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
	
	private JLabel newWidthLabel;
	private JLabel newHeightLabel;
	private JTextField newWidthField;
	private JTextField newHeightField;
	private JButton preview;
	
	private Rectangle rleft, rup, rright, rdown;

	private boolean selectedLeft = false, selectedRight = false, selectedUp = false, selectedDown = false;
	
																			
	
	
	
	
	
	
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
		
		getImageButton().addMouseMotionListener(this);
		
		newWidthLabel = new JLabel("New width (>0): ");
		newWidthLabel.setBounds(250, 665, 120, 20);
		newHeightLabel = new JLabel("New height (>0): ");
		newHeightLabel.setBounds(490, 665, 120, 20);
		
		newWidthField = new JTextField();
		newWidthField.setBounds(380, 665, 100, 20);
		newWidthField.setText(getBufferedPreview().getWidth() + "");
		newHeightField = new JTextField();
		newHeightField.setBounds(620, 665, 100, 20);
		newHeightField.setText(getBufferedPreview().getHeight() + "");
		
		preview = new JButton("Preview");
		preview.setBounds(750, 660, 100, 30);
		
		this.getContentPane().add(newWidthLabel);
		this.getContentPane().add(newHeightLabel);
		this.getContentPane().add(newWidthField);
		this.getContentPane().add(newHeightField);
		this.getContentPane().add(preview);
		
		preview.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				previewActionPerformed(evt);
			}
		});
		
	}
	
	
	
	
																			
																			//*************************************
																			//				EVENTS	              *
																			//*************************************
	/**
	 * 
	 * Do the resize effect
	 * 
	 */
	private void previewActionPerformed(java.awt.event.ActionEvent evt) {
		
		if((new Integer(newWidthField.getText())) > 0 && (new Integer(newHeightField.getText())) > 0){ // width and height must be bigger than 0
			
			Image image = getTransformer().toImage(getBufferedPreview());
			Dimension newDimension = new Dimension(new Integer(newWidthField.getText()), new Integer(newHeightField.getText()));
			
			image = resizer.resize(image, newDimension);
			
			previewPicture(getTransformer().toBufferedImage(image));
		
		}
    	
	}
	
	/**
	 * 
	 * Perform the right actions when the user presses the 'Apply' button. Save the current buffered image to the right file.
	 * Custom for resize: save new image size
	 * 
	 */	
	public ImageIcon performEdit() {
		
		// change picture size information
		getPicture().changeWidth(new Integer(newWidthField.getText()));
		getPicture().changeHeight(new Integer(newHeightField.getText()));
		
		try {
			
            ImageIO.write(getBufferedPreview(), getPicture().getFileName().substring(getPicture().getFileName().length()-3, getPicture().getFileName().length()), new File(getJCpgUI().getCpgConfig().getSiteConfig().getValueFor("fullpath") + getPicture().getFilePath() + getPicture().getFileName()));
            JCpgPictureResizer thumb = new JCpgPictureResizer(getJCpgUI(), getJCpgUI().getCpgConfig().getSiteConfig().getValueFor("fullpath") + getPicture().getFilePath(), getPicture().getFileName()); // thumb
			thumb.makeThumb();
			
			// save new changes
			new JCpgGallerySaver(getJCpgUI().getGallery()).saveGallery();
			
			getJCpgUI().getPictureList().remove(getListIndex());
			getJCpgUI().getPictureListModel().add(getListIndex(), getPicture());
            
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
        
        rleft = new Rectangle(getPreviewSize().width/2 - getPicture().getpWidth()/2, 58, 1, getPicture().getpHeight()); // left
        rup = new Rectangle(getPreviewSize().width/2 - getPicture().getpWidth()/2, 58, getPicture().getpWidth(), 1); // up
        rdown = new Rectangle(getPreviewSize().width/2 - getPicture().getpWidth()/2, 58 + getPicture().getpHeight(), getPicture().getpWidth(), 1); // down
        rright = new Rectangle(getPreviewSize().width/2 - getPicture().getpWidth()/2 + getPicture().getpWidth(), 58, 1, getPicture().getpHeight()); // right
        
        // draw in correct color: red = not selected, white = selected
        if(selectedLeft){
        	
        	g2.setPaint(Color.white);
        	g2.draw(rleft);
        	
        }else{
        	
        	g2.setPaint(Color.red);
        	g2.draw(rleft);
        	
        }
        
        if(selectedUp){
        	
        	g2.setPaint(Color.white);
        	g2.draw(rup);
        	
        }else{
        	
        	g2.setPaint(Color.red);
        	g2.draw(rup);
        	
        }
        
        if(selectedDown){
        	
        	g2.setPaint(Color.white);
        	g2.draw(rdown);
        	
        }else{
        	
        	g2.setPaint(Color.red);
        	g2.draw(rdown);
        	
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

		
	}








	public void mouseMoved(MouseEvent m) {
		
		Point p = m.getPoint();
		
		Point e = new Point();
		e.x = (int) (getPreviewSize().width/2 - getPicture().getpWidth()/2 + p.getX());
		e.y = (int) (p.getY() + 58);
		
		// check if mouse is over one of the lines
		// down
		if(rdown.contains(e))
			selectedDown = true;
		else
			selectedDown = false;
		
		// up
		if(rup.contains(e))
			selectedUp = true;
		else
			selectedUp = false;
		
		// left
		if(rleft.contains(e))
			selectedLeft = true;
		else
			selectedLeft = false;
		
		// right
		if(rright.contains(e))
			selectedRight = true;
		else
			selectedRight = false;
		
		repaint();
		
	}

}
