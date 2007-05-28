package be.khleuven.frank.JCpg.Editor;

import java.awt.Graphics;
import java.awt.GraphicsConfiguration;
import java.awt.GraphicsDevice;
import java.awt.GraphicsEnvironment;
import java.awt.HeadlessException;
import java.awt.Image;
import java.awt.Toolkit;
import java.awt.Transparency;
import java.awt.image.BufferedImage;
import java.awt.image.ColorModel;
import java.awt.image.PixelGrabber;

import javax.swing.ImageIcon;


/**
 * 
 * Used to transform from Image to BufferedImage and back
 * 
 * @author frank
 *
 */
public class JCpgTransform {
	
	public JCpgTransform(){
		
		
	}
	
	
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
    	
        if (image instanceof BufferedImage) {
        	
            return (BufferedImage)image;
            
        }
    
        // This code ensures that all the pixels in the image are loaded
        image = new ImageIcon(image).getImage();
    
        // Determine if the image has transparent pixels
        boolean hasAlpha = hasAlpha(image);
    
        // Create a buffered image with a format that's compatible with the screen
        BufferedImage bimage = null;
        GraphicsEnvironment ge = GraphicsEnvironment.getLocalGraphicsEnvironment();
        try {
        	
            // Determine the type of transparency of the new buffered image
            int transparency = Transparency.OPAQUE;
            if (hasAlpha) {
            	
                transparency = Transparency.BITMASK;
                
            }
    
            // Create the buffered image
            GraphicsDevice gs = ge.getDefaultScreenDevice();
            GraphicsConfiguration gc = gs.getDefaultConfiguration();
            bimage = gc.createCompatibleImage(image.getWidth(null), image.getHeight(null), transparency);
            
        } catch (HeadlessException e) {
          
        	System.out.println("JCpgEditor: system does not have screen");
        	
        }
    
        if (bimage == null) {
        	
            // Create a buffered image using the default color model
            int type = BufferedImage.TYPE_INT_RGB;
            if (hasAlpha) {
            	
                type = BufferedImage.TYPE_INT_ARGB;
                
            }
            
            bimage = new BufferedImage(image.getWidth(null), image.getHeight(null), type);
            
        }
    
        // Copy image to buffered image
        Graphics g = bimage.createGraphics();
    
        // Paint the image onto the buffered image
        g.drawImage(image, 0, 0, null);
        g.dispose();
    
        return bimage;
        
    }
    /**
     * 
     * Determine if the picture has transparant pixels
     * 
     * @param image
     * 		image to check
     * @return
     * 		true if the image has transparant pixels, else false
     */
    private static boolean hasAlpha(Image image) {
    	
        // If buffered image, the color model is readily available
        if (image instanceof BufferedImage) {
        	
            BufferedImage bimage = (BufferedImage)image;
            return bimage.getColorModel().hasAlpha();
            
        }
    
        // Use a pixel grabber to retrieve the image's color model;
        // grabbing a single pixel is usually sufficient
         PixelGrabber pg = new PixelGrabber(image, 0, 0, 1, 1, false);
         
        try {
        	
            pg.grabPixels();
            
        } catch (InterruptedException e) {
        	
        	System.out.println("JCpgEditor: Transparant pixel grabbing failed");
        	
        }
    
        // Get the image's color model
        ColorModel cm = pg.getColorModel();
        return cm.hasAlpha();
        
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
    public static Image toImage(BufferedImage bufferedImage) {
    	
        return Toolkit.getDefaultToolkit().createImage(bufferedImage.getSource());
        
    }

}
