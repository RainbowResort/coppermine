/*
Copyright (C) 2997  Frank Cleynen
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
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JProgressBar;

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
	
	private JCpgUI ui;
	
	private JProgressBar progress;
	private JLabel logo, title, finished;
	private JButton close;
	
	private String logopath = null;
	private int maximumprogress = 0;
	
	private Dimension screensize;
	
	
	/**
	 * 
	 * Create new JCpgUpdater object
	 * 
	 * @param ui
	 * 		reference to the JCpg ui
	 * @param maximum
	 * 		maximum value of progressbar
	 */
	public JCpgProgressManager(JCpgUI ui, int maximum, String logopath){
		
		//ui.setEnabled(false);
		
		setJCpgUIReference(ui);
		setMaximum(maximum);
		setLogopath(logopath);
		
		initComponents();
		boundComponents();
		placeComponents();
		
	}
	
	
	
	/**
	 * 
	 * Set the JCpgUi reference
	 * 
	 * @param ui
	 * 		the JCpgUi reference
	 */
	private void setJCpgUIReference(JCpgUI ui){
		
		this.ui = ui;
		
	}
	private void setMaximum(int maximum){
		
		this.maximumprogress = maximum;
		
	}
	private void setLogopath(String logopath){
		
		this.logopath = logopath;
		
	}
	
	
	
	
	
	
	
	/**
	 * 
	 * Get the JCpgUi reference
	 * 
	 * @return
	 * 		the JCpgUi reference
	 */
	public JCpgUI getJCpgUI(){
		
		return this.ui;
		
	}
	public int getMaximum(){
		
		return this.maximumprogress;
		
	}
	public String getLogopath(){
		
		return this.logopath;
		
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
		this.getContentPane().add(close);
		this.setVisible(true);
		
	}
	
	
	public void changeProgressMaximum(int maximum){
		
		progress.setMaximum(maximum);
		
	}
	
	
	
	private void closeActionPerformed(java.awt.event.ActionEvent evt) {
		
		//getJCpgUI().setEnabled(true);
		this.dispose();
    	
	}



	public boolean doAction() {
		
		return false;
	}

}
