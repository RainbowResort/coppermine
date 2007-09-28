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

package be.khleuven.frank.JCpg.Manager;

import java.awt.Dimension;
import java.awt.FlowLayout;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;

import be.khleuven.frank.JCpg.Save.JCpgGallerySaver;
import be.khleuven.frank.JCpg.UI.JCpgUI;

/**
 * 
 * In Coppermine, users can add albums to the main gallery and can also make subcategories in categories. This class makes it possible to make that choice and call the right AddManager
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgRateManager extends JDialog {
	
	
														
														//*************************************
														//				VARIABLES             *
														//*************************************
	private JCpgUI ui;
	private ImageIcon icon;
	
	private Dimension screensize;
	
	private JLabel logo;
	
	private JPanel ratepanel;
	private JButton[] stars;
	
	private JButton rate, reset, close;
	
	private int starsToActivate = 0;
	
	
	
	
														
														//*************************************
														//				CONSTRUCTOR           *
														//*************************************
	/**
	 * 
	 * Makes a new JCpgAddSelectManager object
	 * 
	 * @param jCpgUIReference
	 * 		reference to the ui
	 * @param logo
	 * 		which logo to use
	 */
	public JCpgRateManager(JCpgUI jCpgUIReference, ImageIcon logo){
		
		super(jCpgUIReference);
		
		setUi(jCpgUIReference);
		setLogo(logo);
		
		initComponents();
		boundComponents();
		placeComponents();
		
	}
	
	
	
	
														
														//*************************************
														//				SETTERS	              *
														//*************************************
	/**
	* 
	* Set the JCpgUI reference
	* 
	* @param jCpgUIReference
	* 		the JCpgUI reference
	*/
	private void setUi(JCpgUI jCpgUIReference){
		
		this.ui = jCpgUIReference;
		
	}
	/**
	 * 
	 * Set the logo
	 * 
	 * @param logo
	 * 		path to the logo
	 */
	private void setLogo(ImageIcon logo){
		
		this.icon = logo;
		
	}
	
	
	
	
	
	
	
														
														//*************************************
														//				SWING	              *
														//*************************************
	/**
	* 
	* Init swing components
	* 
	*/
	private void initComponents(){
	
		this.setLayout(null);
		
		screensize = Toolkit.getDefaultToolkit().getScreenSize();
		
		logo = new JLabel(getLogoIcon(), JLabel.CENTER); // 500x50
		
		rate = new JButton("Rate");
		reset = new JButton("Reset");
		close = new JButton("Close");
		
		ratepanel = new JPanel(new FlowLayout());
		
		stars = new JButton[5]; // init star buttons
		for(int i=0; i<stars.length; i++){
			
			stars[i] = new JButton(new ImageIcon("data/stargrey.jpg"));
			
			ratepanel.add(stars[i]);
			
			stars[i].addActionListener(new ActionListener(){
				public void actionPerformed(ActionEvent evt) {
					starActionPerformed(evt);
				}
			});
			
		}
		
		// read current rating and show it
		for(int i=0; i<getJCpgUIReference().getCurrentPicture().getPicRating(); i++){
			
			stars[i].setIcon(new ImageIcon("data/star.jpg"));
			
		}
		
		rate.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				rateActionPerformed(evt);
			}
		});
		
		reset.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				resetActionPerformed(evt);
			}
		});
		
		close.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				closeActionPerformed(evt);
			}
		});
		
	}
	/**
	* 
	* Size swing components
	*
	*/
	private void boundComponents(){
	
		this.setBounds((int)(screensize.getWidth()/2)-250, (int)(screensize.getHeight()/2)-100, 500, 200);
		this.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		this.setUndecorated(true);
		
		logo.setBounds(0, 0, 500, 50);
		
		ratepanel.setBounds(0, 70, 500, 50);
		
		rate.setBounds(90, 160, 100, 30);
		reset.setBounds(200, 160, 100, 30);
		close.setBounds(310, 160, 100, 30);
	
	}
	/**
	* 
	* Position swing components
	*
	*/
	private void placeComponents(){
		
		this.getContentPane().add(logo);
		this.getContentPane().add(ratepanel);
		this.getContentPane().add(rate);
		this.getContentPane().add(reset);
		this.getContentPane().add(close);
		this.setVisible(true);
		
	}
	
	
	
														
														//*************************************
														//				GETTERS               *
														//*************************************
	/**
	* 
	* Get the JCpgUI reference
	* 
	* @return jCpgUIReference
	* 		the JCpgUI reference
	*/
	public JCpgUI getJCpgUIReference(){
		
		return this.ui;
		
	}
	/**
	 * 
	 * Get an ImageIcon object from the logo path
	 * 
	 * @return
	 * 		an ImageIcon object from the logo path
	 */
	public ImageIcon getLogoIcon(){
		
		return this.icon;
		
	}

	
	
	
														//*************************************
														//				EVENTS	              *
														//*************************************
	/**
	* 
	* Perform right actions when rate button is clicked
	* 
	*/
	public void rateActionPerformed(java.awt.event.ActionEvent evt) {
		
		getJCpgUIReference().getCurrentPicture().changePicRating(starsToActivate);
		
		new JCpgGallerySaver(getJCpgUIReference().getGallery(), getJCpgUIReference().getCpgConfig().getUserConfig().getId()).saveGallery();
		
		this.dispose();
		getJCpgUIReference().setEnabled(true);
		
	}
	/**
	* 
	* Perform right actions when reset button is clicked
	* 
	*/
	public void resetActionPerformed(java.awt.event.ActionEvent evt) {
		
		// reset all stars
		for(int i=0; i<stars.length; i++){
				
			stars[i].setIcon(new ImageIcon("data/stargrey.jpg"));
				
		}
		
		starsToActivate = 0; // reset rating
		
	}
	/**
	 * 
	 * Perform right actions when close button is clicked
	 * 
	 */
	public void closeActionPerformed(java.awt.event.ActionEvent evt) {
		
		this.dispose();
		getJCpgUIReference().setEnabled(true);
		
	}
	/**
	* 
	* Perform right actions when a star button is clicked
	* 
	*/
	public void starActionPerformed(java.awt.event.ActionEvent evt) {
		
		starsToActivate = 0;
		
		JButton star = (JButton) evt.getSource();
		
		// reset all stars
		for(int i=0; i<stars.length; i++){
				
			stars[i].setIcon(new ImageIcon("data/stargrey.jpg"));
				
		}
		
		while(starsToActivate < stars.length && !star.equals(stars[starsToActivate])){
			
			starsToActivate++;
			
		}
		
		starsToActivate++; // also include clicked star
			
		// color all stars before and including the clicked star
			
		// fill the needed stars
		for(int i=0; i<starsToActivate; i++){
			
			stars[i].setIcon(new ImageIcon("data/star.jpg"));
				
		}
		
	}

}

