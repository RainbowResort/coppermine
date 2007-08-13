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

import java.awt.Dimension;
import java.awt.Graphics2D;
import java.awt.GraphicsConfiguration;
import java.awt.GraphicsDevice;
import java.awt.GraphicsEnvironment;
import java.awt.Transparency;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.geom.AffineTransform;
import java.awt.image.AffineTransformOp;
import java.awt.image.BufferedImage;

import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JTextField;

import be.khleuven.frank.JCpg.Components.JCpgPicture;
import be.khleuven.frank.JCpg.UI.JCpgUI;

/**
 * 
 * Editor: rotate
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgEditorRotate extends JCpgEditor{

	
															
															//*************************************
															//				VARIABLES             *
															//*************************************
	private JButton rotate90Right;
	private JButton rotate90Left;
	private JLabel customLabel;
	private JTextField customRotation;
	private JButton preview;
	
	
	
	
															
															//*************************************
															//				CONSTRUCTOR           *
															//*************************************
	/**
	 * 
	 * Makes a new JCpgEditor_rotate object
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
	public JCpgEditorRotate(JCpgUI jCpgUIReference, JCpgPicture picture, Dimension previewPosition, Dimension previewSize, int listIndex){
		
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
		
		rotate90Right = new JButton("90¡ >");
		rotate90Right.setBounds(280, 660, 100, 30);
		rotate90Left = new JButton("90¡ <");
		rotate90Left.setBounds(390, 660, 100, 30);
		
		customLabel = new JLabel("Custom rotation: ");
		customLabel.setBounds(520, 665, 150, 20);
		
		customRotation = new JTextField();
		customRotation.setBounds(680, 665, 100, 20);
		
		preview = new JButton("Preview");
		preview.setBounds(800, 660, 100, 30);
		
		this.getContentPane().add(rotate90Right);
		this.getContentPane().add(rotate90Left);
		this.getContentPane().add(customLabel);
		this.getContentPane().add(customRotation);
		this.getContentPane().add(preview);
		
		preview.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				previewActionPerformed(evt);
			}
		});
		
		rotate90Right.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				rotate90RightActionPerformed(evt);
			}
		});
		
		rotate90Left.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				rotate90LeftActionPerformed(evt);
			}
		});
		
	}
	
	
	
	
															
															//*************************************
															//				MUTATORS & OTHERS     *
															//*************************************
	/**
	 * 
	 * Do the rotate effect
	 * 
	 */
	private void previewActionPerformed(java.awt.event.ActionEvent evt) {
		
		if(!customRotation.getText().equals("")){ // do if user has put in actual custom angel
			
			int angle = new Integer(customRotation.getText());
			
			AffineTransformOp op = new AffineTransformOp(AffineTransform.getRotateInstance(Math.toRadians(angle), getBufferedPreview().getWidth() / 2, getBufferedPreview().getHeight() / 2), AffineTransformOp.TYPE_NEAREST_NEIGHBOR);
	    	BufferedImage tempImage = op.filter(getBufferedPreview(), null);
	        
	        previewPicture(tempImage);
	        
	   }     
		
	}
    private static GraphicsConfiguration getDefaultConfiguration() {
    	
        GraphicsEnvironment ge = GraphicsEnvironment.getLocalGraphicsEnvironment();
        GraphicsDevice gd = ge.getDefaultScreenDevice();
        
        return gd.getDefaultConfiguration();
        
    }
    private void rotate90RightActionPerformed(java.awt.event.ActionEvent evt) {
    	
    	AffineTransformOp op = new AffineTransformOp(AffineTransform.getRotateInstance(Math.toRadians(90), getBufferedPreview().getWidth() / 2, getBufferedPreview().getHeight() / 2), AffineTransformOp.TYPE_NEAREST_NEIGHBOR);
    	BufferedImage tempImage = op.filter(getBufferedPreview(), null);
        
        previewPicture(tempImage);
    	
    }
    private void rotate90LeftActionPerformed(java.awt.event.ActionEvent evt) {
    	
    	AffineTransformOp op = new AffineTransformOp(AffineTransform.getRotateInstance(Math.toRadians(-90), getBufferedPreview().getWidth() / 2, getBufferedPreview().getHeight() / 2), AffineTransformOp.TYPE_NEAREST_NEIGHBOR);
    	BufferedImage tempImage = op.filter(getBufferedPreview(), null);
        
        previewPicture(tempImage);
    	
    }

}
