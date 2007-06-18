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

import be.khleuven.frank.JCpg.JCpgImageUrlValidator;
import java.awt.BorderLayout;
import java.awt.Dimension;
import java.awt.Toolkit;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JWindow;


/**
 * 
 * The class shows the program's splashscreen
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgSplashscreen extends JFrame{
	
														
															//*************************************
															//				VARIABLES             *
															//*************************************
	private JWindow splash;
	private Dimension screensize;
	private JLabel logo;
	private int userManagerWidth;
	private int userManagerHeight;
	
	
	
	
	
	
														
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
	 * @param logopath
	 * 		path to the picture to be shown
	 * @param seconds
	 * 		number of seconds to show the splashscreen
	 * 
	 */
	public JCpgSplashscreen(int width, int height, String logopath, int seconds){
		
		setSplashscreenSize(width, height);
		
		splash = new JWindow();
		screensize = Toolkit.getDefaultToolkit().getScreenSize();
		logo = new JLabel(new JCpgImageUrlValidator(logopath).createImageIcon(), JLabel.CENTER);
		
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
	/**
	 * 
	 * Used to show a splashwindow we want to close ourselves
	 * 
	 * @param width
	 * 		width of the splashscreen
	 * @param height
	 * 		height of the splashscreen
	 * @param logopath
	 * 		path to the picture to be shown
	 */
	public JCpgSplashscreen(int width, int height, String logopath){
		
		setSplashscreenSize(width, height);
		
		splash = new JWindow();
		screensize = Toolkit.getDefaultToolkit().getScreenSize();
		logo = new JLabel(new JCpgImageUrlValidator(logopath).createImageIcon(), JLabel.CENTER);
		
		splash.setBounds((screensize.width/2)-(getSplashscreenWidth()/2), (screensize.height/2)-(getSplashscreenHeight()/2), getSplashscreenWidth(), getSplashscreenHeight());
		
		splash.getContentPane().add(logo, BorderLayout.CENTER);
		splash.setVisible(true);
		
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
	
	
	public void closeSplash(){
		
		splash.dispose();
		this.setVisible(false);
		this.dispose();
		
	}
	
}
