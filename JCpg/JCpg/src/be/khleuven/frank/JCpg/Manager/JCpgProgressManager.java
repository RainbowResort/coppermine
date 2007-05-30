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
import javax.swing.JComboBox;
import javax.swing.JComponent;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JProgressBar;
import javax.swing.JWindow;

import be.khleuven.frank.JCpg.JCpgImageUrlValidator;
import be.khleuven.frank.JCpg.Interfaces.JCpgProgressManagerInterface;
import be.khleuven.frank.JCpg.UI.JCpgUI;

/**
 * 
 * Progress manager can be used for everything that needs a progress bar
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgProgressManager extends JDialog implements JCpgProgressManagerInterface{
	
	private Window parent;
	
	private JProgressBar progress;
	private JLabel logo, title, finished;
	private JButton close;
	
	private String logopath = null;
	private int maximumprogress = 0;
	private boolean showCloseButton, autoClose;
	
	private Dimension screensize;
	
	
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
	private void setMaximum(int maximum){
		
		this.maximumprogress = maximum;
		
	}
	private void setLogopath(String logopath){
		
		this.logopath = logopath;
		
	}
	private void setShowCloseButton(boolean showCloseButton){
		
		this.showCloseButton = showCloseButton;
		
	}
	private void setAutoClose(boolean autoClose){
		
		this.autoClose = autoClose;
		
	}
	
	
	
	
	
	
	
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
	public int getMaximum(){
		
		return this.maximumprogress;
		
	}
	public String getLogopath(){
		
		return this.logopath;
		
	}
	public boolean getShowCloseButton(){
		
		return this.showCloseButton;
		
	}
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
	
	
	
	
	
	
	
	/**
	 * 
	 * Init swing components
	 *
	 */
	private void initComponents(){
		
		this.setLayout(null);
		this.setAlwaysOnTop(true);
		
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
		this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		this.setUndecorated(true);
		
		logo.setBounds(0, 0, 500, 50);
		title.setBounds(30, 70, 100, 20);
		progress.setBounds(30, 100, 300, 20);
		finished.setBounds(340, 100, 100, 20);
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
	
	
	public void changeProgressMaximum(int maximum){
		
		progress.setMaximum(maximum);
		
	}
	
	
	
	private void closeActionPerformed(java.awt.event.ActionEvent evt) {
		
		getParent().setEnabled(true);
		this.dispose();
    	
	}
	public void changeProgressbarValue(int value){
		
		progress.setValue(value);
		
		if(progress.getValue() == progress.getMaximum()){
			
			finished.setText("Done!");
			
		}else if(progress.getValue() == progress.getMaximum() && getAutoClose()){
			
			getParent().setEnabled(true);
			this.dispose();
			
		}
		
	}



	public boolean doAction() {
		
		return false;
		
	}

}
