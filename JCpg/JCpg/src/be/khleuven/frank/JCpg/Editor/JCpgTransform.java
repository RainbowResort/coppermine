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

import java.awt.Graphics2D;
import java.awt.Image;
import java.awt.Toolkit;
import java.awt.image.BufferedImage;


/**
 * 
 * Used to transform from Image to BufferedImage and back
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgTransform {
	
	
	
																
																//*************************************
																//				CONSTRUCTOR			  *
																//*************************************
	/**
	 * 
	 * Empty constructor
	 *
	 */
	public JCpgTransform(){
		
	}
	
	
	


																
																//*************************************
																//				MUTATORS & OTHERS	  *
																//*************************************
	/**
	 * 
	 * Returns a Buffered Image object of a given Image object. A Buffered Image object is needed to do some effects.
	 * 
	 * @param image
	 * 		image to convert
	 * @return
	 * 		a Buffered Image object of a given Image object
	 */
    public static BufferedImage toBufferedImage(Image image) {
    	
    	BufferedImage bi = new BufferedImage(image.getWidth(null), image.getHeight(null), BufferedImage.TYPE_INT_RGB);
    	Graphics2D g = bi.createGraphics();
    	g.drawImage(image, 0, 0, null);
    		 
    	return bi;
        
    }
    /**
     * 
     * Convert a BufferedImage object to an Image object
     * 
     * @param bufferedImage
     * 		BufferedImage object to convert
     * @return
     * 		and Image object from the given BufferedImage object
     */
    public Image toImage(BufferedImage bufferedImage) {
    	
        return Toolkit.getDefaultToolkit().createImage(bufferedImage.getSource());
        
    }

}
