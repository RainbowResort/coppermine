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
import java.awt.Dimension;
import java.awt.Graphics2D;
import java.awt.GraphicsConfiguration;
import java.awt.GraphicsDevice;
import java.awt.GraphicsEnvironment;
import java.awt.Transparency;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.image.BufferedImage;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JTextField;

/**
 * 
 * Editor: rotate
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgEditor_rotate extends JCpgEditor{

	private JButton rotate90Right;
	private JButton rotate90Left;
	private JLabel customLabel;
	private JTextField customRotation;
	private JButton preview;
	
	
	
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
	public JCpgEditor_rotate(JCpgUI jCpgUIReference, JCpgPicture picture, Dimension previewPosition, Dimension previewSize){
		
		super(jCpgUIReference, picture, previewPosition, previewSize);
		doExtraSwingComponents();
		
	}
	
	
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
		
	}
	
	
	
	
	/**
	 * 
	 * Do the rotate effect
	 * 
	 */
	private void previewActionPerformed(java.awt.event.ActionEvent evt) {
		
		if(!customRotation.getText().equals("")){ // do if user has put in actual custom angel
			
			BufferedImage image = getBufferedPreview();
			int angle = new Integer(customRotation.getText());
	    	
			double sin = Math.abs(Math.sin(angle)), cos = Math.abs(Math.cos(angle));
	        int w = image.getWidth(), h = image.getHeight();
	        int neww = (int)Math.floor(w*cos+h*sin), newh = (int)Math.floor(h*cos+w*sin);
	        GraphicsConfiguration gc = getDefaultConfiguration();
	        BufferedImage result = gc.createCompatibleImage(neww, newh, Transparency.TRANSLUCENT);
	        Graphics2D g = result.createGraphics();
	        g.rotate(Math.toRadians(angle), w/2, h/2);
	        g.translate((neww-w)/2, (newh-h)/2);
	        g.drawRenderedImage(image, null);
	        g.dispose();
	        
	        previewPicture(result);
	        
	   }     
		
	}
    private static GraphicsConfiguration getDefaultConfiguration() {
    	
        GraphicsEnvironment ge = GraphicsEnvironment.getLocalGraphicsEnvironment();
        GraphicsDevice gd = ge.getDefaultScreenDevice();
        
        return gd.getDefaultConfiguration();
        
    }

}
