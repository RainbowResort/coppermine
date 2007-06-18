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

import be.khleuven.frank.JCpg.Components.JCpgPicture;
import be.khleuven.frank.JCpg.UI.JCpgUI;
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
import java.awt.event.MouseListener;
import java.io.File;
import java.io.IOException;
import javax.imageio.ImageIO;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.SwingUtilities;


/**
 * 
 * Editor: crop
 * The Crop Editor will paint a rectangle on the image. This rectangle can be moved with the mouse and can also be set bigger or smaller by the user.
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgEditor_crop extends JCpgEditor implements MouseListener {
	
	
	
	
	
	
																			
																			//*************************************
																			//				VARIABLES             *
																			//*************************************
	private Rectangle crop = null; // this is the rectangle used to point to the area that has to be cropped
	private JButton xplus;
	private JButton xminus;
	private JButton yplus;
	private JButton yminus;
	
	private int rwidth = 300 ;
	private int rheight = 300 ;
	private int rx = getPreviewSize ( ) . width / 2 - getPicture ( ) . getpWidth ( ) / 2 + 75 ;
	private int ry = 59 + 50 ;
	
	private int LEFT = getPreviewSize().width/2-getPicture().getpWidth()/2;
	private int UP = 59;
	private int RIGHT = LEFT + getPicture().getpWidth();
	private int DOWN = UP + getPicture().getpHeight();
	
	private boolean dragging;
	
	private Point offset = new Point();
	
	private Rectangle fillerleft = new Rectangle ( ) ;
	private Rectangle fillerright = new Rectangle ( ) ;
	private Rectangle fillerup = new Rectangle ( ) ;
	private Rectangle fillerdown = new Rectangle ( ) ;
	
	
	
	
																			
	
	
	
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
	public JCpgEditor_crop(JCpgUI jCpgUIReference, JCpgPicture picture, Dimension previewPosition, Dimension previewSize){
		
		super(jCpgUIReference, picture, previewPosition, previewSize);
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
		
		repaint();

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
        
        // unselect rectangles
        Point position = crop.getLocation();
        
        g2.setPaint(Color.black);
        
        g2.fillRect(LEFT, UP, position.x - LEFT, getPicture().getpHeight()); // left
        g2.fillRect(LEFT, UP, getPicture().getpWidth(), position.y - UP); // up
        g2.fillRect(position.x + rwidth + 1, UP, getPreview().getWidth() - position.x - LEFT - rwidth, getPicture().getpHeight()); // right
        g2.fillRect(LEFT, position.y + rheight + 1, getPicture().getpWidth(), getPicture().getpHeight() + UP - position.y - rheight - 1); // under
        
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
			
            ImageIO.write(getBufferedPreview().getSubimage(rx, ry, rwidth, rheight), getPicture().getFileName().substring(getPicture().getFileName().length()-3, getPicture().getFileName().length()), new File("albums/" + getPicture().getFilePath() + getPicture().getFileName()));
            
			// change picture size information
			getPicture().changeWidth(rwidth);
			getPicture().changeHeight(rheight);
			
			// TODO: adjust thumb + refresh in explorer view
            
            getJCpgUI().setEnabled(true);
            this.dispose();
            
        } catch(IOException ioe){
        	
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



	/**
	 * 
	 * Move the square with the mouse
	 * 
	 */
	public void mouseClicked(MouseEvent e) {
		
		Point p = e.getPoint();
		
        if(crop.contains(p)){
        	
            offset.x = p.x - crop.x;
            offset.y = p.y - crop.y;
            dragging = true;
            
        }

	}




	public void mouseEntered(MouseEvent e) {
		
	}




	public void mouseExited(MouseEvent e) {
		
	}




	public void mousePressed(MouseEvent e) {
		
	}




	public void mouseReleased(MouseEvent e) {
		
		dragging = false;
		
	}
	public void mouseDragged(MouseEvent e){
		
        if(dragging){
        	
            rx = e.getX() - offset.x;
            ry = e.getY() - offset.y;
            
            repaint();
            
        }
        
    }

}