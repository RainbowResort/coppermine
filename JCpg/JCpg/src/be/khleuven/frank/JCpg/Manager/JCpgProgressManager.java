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
import java.awt.Toolkit;
import java.awt.Window;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JProgressBar;

import be.khleuven.frank.JCpg.JCpgImageUrlValidator;
import be.khleuven.frank.JCpg.Interfaces.JCpgProgressManagerInterface;

/**
 * Progress manager can be used for everything that needs a progress bar
 * @author    Frank Cleynen
 */
public class JCpgProgressManager extends JDialog implements JCpgProgressManagerInterface{
	
	
	
	
	
	
	
												
	
	
	
												//*************************************
												//				VARIABLES			  *
												//*************************************
	private static final long serialVersionUID = 1L;
	
	private Window parent;
	
	private JProgressBar progress;
	private JLabel logo;
	private JLabel title;
	private JLabel finished;
	private JButton close;
	
	private String logopath = null;
	private int maximumprogress = 0;
	private boolean showCloseButton;
	private boolean autoClose;
	
	private Dimension screensize;
	
	
	
	
	
	
	
	
												
												//*************************************
												//				CONSTRUCTOR			  *
												//*************************************
	/**
	 * 
	 * Create new JCpgUpdater object
	 * 
	 * @param parent
	 * 		reference to the parent Swing component
	 * @param maximum
	 * 		maximum value of progressbar
	 * @param showCloseButton
	 * 		is the close button shown or not
	 * @param autoClose
	 * 		make the window disappear after the progressbar hits 100%
	 */
	public JCpgProgressManager(Window parent, int maximum, String logopath, boolean showCloseButton, boolean autoClose){
		
		super(parent);
		
		parent.setEnabled(false);
		
		setParent(parent);
		setMaximum(maximum);
		setLogopath(logopath);
		setShowCloseButton(showCloseButton);
		setAutoClose(autoClose);
		
		initComponents();
		boundComponents();
		placeComponents();
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
												
	
	
												//*************************************
												//				SETTERS				  *
												//*************************************
	/**
	 * 
	 * Set the parent reference
	 * 
	 * @param parent
	 * 		the parent reference
	 */
	private void setParent(Window parent){
		
		this.parent = parent;
		
	}
	/**
	 * 
	 * Set the maximum value of the progress bar
	 * 
	 * @param maximum
	 * 		the maximum value of the progress bar
	 */
	private void setMaximum(int maximum){
		
		this.maximumprogress = maximum;
		
	}
	/**
	 * 
	 * Set the path to the logo to use
	 * 
	 * @param logopath
	 * 		the path to the logo to use
	 */
	private void setLogopath(String logopath){
		
		this.logopath = logopath;
		
	}
	/**
	 * 
	 * Set if the close button should be showed or not
	 * 
	 * @param showCloseButton
	 * 		show or not show the close button
	 */
	private void setShowCloseButton(boolean showCloseButton){
		
		this.showCloseButton = showCloseButton;
		
	}
	/**
	 * 
	 * Set if the progress manager should auto close on completion or not 
	 * 
	 * @param autoClose
	 * 		the progress manager should auto close on completion or not
	 */
	private void setAutoClose(boolean autoClose){
		
		this.autoClose = autoClose;
		
	}
	
	
	
	
	
	
	
	
	
	
	
												
												//*************************************
												//				GETTERS				  *
												//*************************************
	/**
	 * 
	 * Get the parent reference
	 * 
	 * @return
	 * 		the parent reference
	 */
	public Window getParent(){
		
		return this.parent;
		
	}
	/**
	 * 
	 * Get the maximum progress bar value
	 * 
	 * @return
	 * 		the maximum progress bar value
	 */
	public int getMaximum(){
		
		return this.maximumprogress;
		
	}
	/**
	 * 
	 * Get the path to the logo
	 * 
	 * @return
	 * 		the path to the logo
	 */
	public String getLogopath(){
		
		return this.logopath;
		
	}
	/**
	 * 
	 * Check if the close button will be shown or not
	 * 
	 * @return
	 * 		true if the close button will be shown, otherwhise false
	 */
	public boolean getShowCloseButton(){
		
		return this.showCloseButton;
		
	}
	/**
	 * 
	 * Check if the progress manager will be autoclosed after completion or not
	 * 
	 * @return
	 * 		true of the progress manager will be autoclosed, else false
	 */
	public boolean getAutoClose(){
		
		return this.autoClose;
		
	}
	/**
	 * 
	 * Returns a reference to the progress bar. Used to change its value
	 * 
	 * @return
	 * 		a reference to the progress bar
	 */
	public JProgressBar getProgressBar(){
		
		return this.progress;
		
	}
	
	
	
	
	
												
	
	
	
												//*************************************
												//				SWING				  *
												//*************************************
	/**
	 * 
	 * Init swing components
	 *
	 */
	private void initComponents(){
		
		this.setLayout(null);
		
		progress = new JProgressBar(0, getMaximum());
		logo = new JLabel(new JCpgImageUrlValidator(getLogopath()).createImageIcon(), JLabel.CENTER); // 500x50
		title = new JLabel("Progress");
		finished = new JLabel();
		close = new JButton("Close");
		
		screensize = Toolkit.getDefaultToolkit().getScreenSize();
		
		close.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				closeActionPerformed(evt);
			}
		});
		
	}
	/**
	 * 
	 * Position components
	 *
	 */
	private void boundComponents(){
		
		this.setBounds((int)(screensize.getWidth()/2)-250, (int)(screensize.getHeight()/2)-100, 500, 200);
		this.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		this.setUndecorated(true);
		
		logo.setBounds(0, 0, 500, 50);
		title.setBounds(30, 70, 100, 20);
		progress.setBounds(30, 100, 300, 20);
		finished.setBounds(340, 100, 150, 20);
		close.setBounds(10, 150, 100, 30);
	
	}
	/**
	 * 
	 * Add components
	 *
	 */
	private void placeComponents(){
		
		this.getContentPane().add(logo);
		this.getContentPane().add(title);
		this.getContentPane().add(progress);
		this.getContentPane().add(finished);
		if(getShowCloseButton()) this.getContentPane().add(close);
		this.setVisible(true);
		
	}
	
	
	
	
	
	
	
	
	
	
	

												//*************************************
												//				EVENTS				  *
												//*************************************
	/**
	 * 
	 * Perform the right actions when the close button
	 * 
	 */
	private void closeActionPerformed(java.awt.event.ActionEvent evt) {
		
		getParent().setEnabled(true);
		this.dispose();
    	
	}
	
	
	
	
	
	
	
	
	
												//*************************************
												//				MUTATORS & OTHERS	  *
												//*************************************
	/**
	 * 
	 * Change the maximum value of the progress bar
	 * 
	 * @param maximum
	 * 		the new maximum value of the progress bar
	 */
	public void changeProgressMaximum(int maximum){
		
		progress.setMaximum(maximum);
		
	}
	/**
	 * 
	 * Change the current value of the progress bar
	 * 
	 * @param value
	 * 		the new value of the progress bar
	 */
	public void changeProgressbarValue(int value){
		
		progress.setValue(value);
		
		if(progress.getValue() == progress.getMaximum()){
			
			finished.setText("Done!");
			
		}else if(progress.getValue() == progress.getMaximum() && getAutoClose()){
			
			getParent().setEnabled(true);
			this.dispose();
			
		}
		
	}
	/**
	 * 
	 * Change the text of the finished label
	 * 
	 * @param text
	 * 		the new text for the finished label
	 */
	public void changeFinishedText(String text){
		
		finished.setText(text);
		
	}
	
	
	
	
	
	
	/**
	 * 
	 * Interface implementation
	 * 
	 */
	public boolean doAction() {
		
		return false;
		
	}

}
