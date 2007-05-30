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

package be.khleuven.frank.JCpg.Resize;

import java.awt.Dimension;
import java.awt.Image;
import java.awt.geom.AffineTransform;
import java.awt.image.AffineTransformOp;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.io.Serializable;

import javax.imageio.ImageIO;
import javax.swing.ImageIcon;

import be.khleuven.frank.JCpg.Editor.JCpgTransform;
import be.khleuven.frank.JCpg.UI.JCpgUI;




/**
 * 
 * 
 * Used to resize pictures:
 * 		1) resize picture and get an Image object
 * 		2) resize picture and write to file = make a thumb
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgPictureResizer implements Serializable{
	
	
	
	
	
																
																	//*************************************
																	//				VARIABLES	          *
																	//*************************************
	private String path, filename;
	private JCpgTransform transformer;
	private JCpgUI ui;
	
	
	
	
																
																	//*************************************
																	//				CONSTRUCTOR	          *
																	//*************************************
	/**
	 * 
	 * Make a new JCpgPictureResizer object
	 * 
	 * @param ui
	 * 		reference to the UI
	 * @param path
	 * 		path where the image resides
	 * @param filename
	 * 		filename of the image
	 */
	public JCpgPictureResizer(JCpgUI ui, String path, String filename){
		
		setUi(ui);
		setPath(path);
		setFilename(filename);
		
	}
	/**
	 * 
	 * Makes a new JCpgPictureResizer object. Used by the resize effect when we just want to use resize(Image image, Dimension dimension)
	 *
	 */
	public JCpgPictureResizer(){
		
	}

	
	
	
	
																
																	//*************************************
																	//				SETTERS  	          *
																	//*************************************
	/***
	 * 
	 * 
	 * Set the path where the image resides
	 * 
	 * @param path
	 * 		the path where the image resides
	 */
	private void setPath(String path){
		
		this.path = path;
		
	}
	/**
	 * 
	 * Set the filename of the image
	 * 
	 * @param filename
	 * 		the filename of the image
	 */
	private void setFilename(String filename){
		
		this.filename = filename;
		
	}
	private void setUi(JCpgUI ui){
		
		this.ui = ui;
		
	}
	
	
	
	
																
	
	
	
	
																	//*************************************
																	//				GETTERS		          *
																	//*************************************
	/**
	 * 
	 * Get the path where the image resides
	 * 
	 * @return
	 * 		the path where the image resides
	 */
	public String getPath(){
		
		return this.path;
		
	}
	/**
	 * 
	 * Get the filename of the image
	 * 
	 * @return
	 * 		the filename of the image
	 */
	public String getFilename(){
		
		return this.filename;
		
	}
	public JCpgUI getUi(){
		
		return this.ui;
		
	}
	
	
	
	
	
	
	
																
																	//*************************************
																	//				MUTATORS & OTHERS     *
																	//*************************************
	/**
	 * 
	 * Resize the image and return an Image object
	 * 
	 * @param dimension
	 * 		preferred dimension of the returned Image object
	 * @return
	 * 		a resized Image object
	 */
	public Image resize(Dimension dimension){
		
		try {
			
			Image image2D = ImageIO.read(new File(getPath()));
			return image2D.getScaledInstance(dimension.width, dimension.height, 1);
			
		} catch (IOException e) {
			
			System.out.println("JCpgPictureResizer: Couldn't resize picture: " + getPath());
			
		}
		
		return null;
		
	}
	/**
	 * 
	 * Return a resized version of the given Image object. Used by resize effect.
	 * 
	 * @param image
	 * 		the image to be resized
	 * @param dimension
	 * 		the new dimensin for this resized image
	 * @return
	 * 		the resized image
	 */
	public Image resize(Image image, Dimension dimension){
			
		return image.getScaledInstance(dimension.width, dimension.height, 1);
		
	}
	/**
	 * 
	 * Make a thumb and write to a file
	 * 
	 * @param dimension
	 * 		preferred dimension of the thumb
	 */
	public void makeThumb(Dimension dimension){
		
		ImageIcon imageIcon = new ImageIcon(getPath() + getFilename());
		Image image = imageIcon.getImage();
		BufferedImage bufferedImage = transformer.toBufferedImage(image);
		
		AffineTransform tx = new AffineTransform();
	    tx.scale(dimension.getWidth(), dimension.getHeight());
	    
	    AffineTransformOp op = new AffineTransformOp(tx, AffineTransformOp.TYPE_BILINEAR);
	    bufferedImage = op.filter(bufferedImage, null);
	    
	    try {
	    	
			ImageIO.write(bufferedImage, getFilename().substring(getFilename().length()-3, getFilename().length()), new File(getPath() + "thumb_" + getFilename()));
		
	    } catch (IOException e) {
	    	
			System.out.println("JCpgPicterResizer: Couldn't make thumb");
			
		}
		
	}

}
