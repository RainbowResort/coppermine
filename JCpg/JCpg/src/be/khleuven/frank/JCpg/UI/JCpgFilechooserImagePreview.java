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
import java.awt.Graphics;
import java.awt.Image;
import java.beans.PropertyChangeEvent;
import java.beans.PropertyChangeListener;
import java.io.File;

import javax.swing.ImageIcon;
import javax.swing.JFileChooser;
import javax.swing.JPanel;

/**
 * 
 * This class makes it possible to show picture previews when adding pictures. Ver handy for the user to see exactly what he is adding.
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgFilechooserImagePreview extends JPanel implements PropertyChangeListener {
    
																							
																							//*************************************
																							//				VARIABLES	          *
																							//*************************************
    private int width, height;
    private ImageIcon icon;
    private Image image;
    private static final int ACCSIZE = 155;
    private Color bg;
    
    
																						    
																							//*************************************
																							//				CONSTRUCTOR	          *
																							//*************************************
    /**
     * 
     * Makes a new JCpgFilechooserImagePreview object
     *
     */
    public JCpgFilechooserImagePreview() {
    	
        setPreferredSize(new Dimension(ACCSIZE, -1));
        bg = getBackground();
        
    }
    
    
    
																						    
																							//*************************************
																							//				MUTATORS & OTHERS     *
																							//*************************************
    /**
     * 
     * Create the preview when something is selected
     * 
     */
    public void propertyChange(PropertyChangeEvent e) {
    	
        String propertyName = e.getPropertyName();
        
        // Only react to correct event
        if (propertyName.equals(JFileChooser.SELECTED_FILE_CHANGED_PROPERTY)) {
        	
            File selection = (File)e.getNewValue();
            String name;
            
            if (selection == null){
            	
                return;
                
            }else{
            	
                name = selection.getAbsolutePath();
                
            }
            
            // Check for allowed extensions
            if ((name != null) && name.toLowerCase().endsWith(".jpg") || name.toLowerCase().endsWith(".jpeg") || name.toLowerCase().endsWith(".gif") || name.toLowerCase().endsWith(".png")) {
            	
                icon = new ImageIcon(name);
                image = icon.getImage();
                scaleImage();
                repaint();
                
            }
            
        }
        
    }
    
    /**
     * 
     * Scale the image
     *
     */
    private void scaleImage() {
    	
        width = image.getWidth(this);
        height = image.getHeight(this);
        double ratio = 1.0;
       
        /* 
         * Determine how to scale the image. Since the accessory can expand
         * vertically make sure we don't go larger than 150 when scaling
         * vertically.
         */
        if (width >= height) {
        	
            ratio = (double)(ACCSIZE-5) / width;
            width = ACCSIZE-5;
            height = (int)(height * ratio);
            
        }
        else {
        	
            if (getHeight() > 150) {
            	
                ratio = (double)(ACCSIZE-5) / height;
                height = ACCSIZE-5;
                width = (int)(width * ratio);
                
            }
            
            else {
            	
                ratio = (double)getHeight() / height;
                height = getHeight();
                width = (int)(width * ratio);
                
            }
            
        }
                
        image = image.getScaledInstance(width, height, Image.SCALE_DEFAULT);
        
    }
    /**
     * 
     * Clean up between preview switch
     * 
     */
    public void paintComponent(Graphics g) {
    	
        g.setColor(bg);
        
        /*
         * If we don't do this, we will end up with garbage from previous
         * images if they have larger sizes than the one we are currently
         * drawing. Also, it seems that the file list can paint outside
         * of its rectangle, and will cause odd behavior if we don't clear
         * or fill the rectangle for the accessory before drawing. This might
         * be a bug in JFileChooser.
         */
        g.fillRect(0, 0, ACCSIZE, getHeight());
        g.drawImage(image, getWidth() / 2 - width / 2 + 5, getHeight() / 2 - height / 2, this);
        
    }
    
}