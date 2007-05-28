package be.khleuven.frank.JCpg.UI;
import java.awt.BorderLayout;
import java.awt.Dimension;
import java.awt.Toolkit;

import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JWindow;

import be.khleuven.frank.JCpg.JCpgImageUrlValidator;


/**
 * 
 * The class shows the program's splashscreen
 * 
 * @author frank
 *
 */
public class JCpgSplashscreen extends JFrame{
	
														
															//*************************************
															//				VARIABLES             *
															//*************************************
	private JWindow splash;
	private Dimension screensize;
	private JLabel logo;
	private int userManagerWidth, userManagerHeight;
	
	
	
	
	
	
														
															//*************************************
															//				CONSTRUCTORS          *
															//*************************************
	/**
	 * 
	 * Make a new splashscreen object
	 * 
	 * @param width
	 * 		width of the splashscreen
	 * @param height
	 * 		height of the splashscreen
	 * @param seconds
	 * 		number of seconds to show the splashscreen
	 * 
	 */
	public JCpgSplashscreen(int width, int height, int seconds){
		
		setSplashscreenSize(width, height);
		
		splash = new JWindow();
		screensize = Toolkit.getDefaultToolkit().getScreenSize();
		logo = new JLabel(new JCpgImageUrlValidator("data/splash.jpg").createImageIcon(), JLabel.CENTER);
		
		splash.setBounds((screensize.width/2)-(getSplashscreenWidth()/2), (screensize.height/2)-(getSplashscreenHeight()/2), getSplashscreenWidth(), getSplashscreenHeight());
		
		splash.getContentPane().add(logo, BorderLayout.CENTER);
		splash.setVisible(true);
		
		try {
			
			Thread.sleep(seconds);
			
		} catch (InterruptedException e) {
			
			System.out.println("Splashscreen: couldn't go to sleep.");
			
		}
		
		splash.dispose();
		this.setVisible(false);
		this.dispose();
		
	}
	
	
	
															
																//*************************************
																//				SETTERS		          *
																//*************************************
	/**
	 * 
	 * Set the splashscreen window size 
	 * 
	 * @param width
	 * 		the width
	 * @param height
	 * 		the height
	 */
	private void setSplashscreenSize(int width, int height){
		
		this.userManagerWidth = width;
		this.userManagerHeight = height;
		
	}
	
	
	
	
															
	
	
	
																//*************************************
																//				GETTERS		          *
																//*************************************
	/**
	 * 
	 * Get the splashscreen width
	 * 
	 * @return
	 * 		the splashscreen width
	 */
	public int getSplashscreenWidth(){
		
		return this.userManagerWidth;
		
	}
	/**
	 * 
	 * Get the splashscreen height
	 * 
	 * @return
	 * 		the splashscreen height
	 */
	public int getSplashscreenHeight(){
		
		return this.userManagerHeight;
		
	}
	
}
