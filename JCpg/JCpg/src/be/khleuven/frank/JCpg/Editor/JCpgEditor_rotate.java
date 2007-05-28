package be.khleuven.frank.JCpg.Editor;

import java.awt.Dimension;
import java.awt.Graphics2D;
import java.awt.GraphicsConfiguration;
import java.awt.GraphicsDevice;
import java.awt.GraphicsEnvironment;
import java.awt.Image;
import java.awt.Transparency;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.geom.AffineTransform;
import java.awt.image.AffineTransformOp;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;

import javax.imageio.ImageIO;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JTextField;

import be.khleuven.frank.JCpg.Components.JCpgPicture;
import be.khleuven.frank.JCpg.Resize.JCpgPictureResizer;
import be.khleuven.frank.JCpg.UI.JCpgUI;

/**
 * 
 * Editor: rotate
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgEditor_rotate extends JCpgEditor{

	JButton rotate90Right, rotate90Left;
	JLabel customLabel;
	JTextField customRotation;
	JButton preview;
	
	
	
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
		rotate90Right.setBounds(510, 60, 100, 30);
		rotate90Left = new JButton("90¡ <");
		rotate90Left.setBounds(620, 60, 100, 30);
		
		customLabel = new JLabel("Custom rotation: ");
		customLabel.setBounds(510, 100, 150, 20);
		
		customRotation = new JTextField();
		customRotation.setBounds(670, 100, 100, 20);
		
		preview = new JButton("Preview");
		preview.setBounds(780, 93, 100, 30);
		
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
