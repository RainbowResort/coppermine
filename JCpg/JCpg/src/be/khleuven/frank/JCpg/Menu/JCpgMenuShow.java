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

package be.khleuven.frank.JCpg.Menu;

import java.awt.Dimension;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.BufferedWriter;
import java.io.FileWriter;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JEditorPane;
import javax.swing.JFileChooser;
import javax.swing.JFrame;
import javax.swing.JScrollPane;
import javax.swing.border.EtchedBorder;

import be.khleuven.frank.JCpg.UI.JCpgUI;




/**
 * 
 * Used to SHOW stuff fetched from the user's Coppermine site
 * 
 * @author Frank Cleynen
 *
 */
public abstract class JCpgMenuShow extends JDialog {

	
	
													
													//*************************************
													//				VARIABLES	          *
													//*************************************
	private static final long serialVersionUID = 1L;
	
	private JCpgUI ui;
	private Dimension screensize;
	
	private JButton close, savetofile;
	private JEditorPane textArea;
	
	private JScrollPane scrollPane;
	
	
	
													
													//*************************************
													//				CONSTRUCTOR	          *
													//*************************************
	/**
	 * 
	 * Makes a new JCpgMenuShow object
	 * 
	 * @param ui
	 * 		reference to the UI
	 */
	public JCpgMenuShow(JCpgUI ui){
		
		super(ui);
		
		ui.setEnabled(false);
		
		setUI(ui);
		
		initComponents();
		boundComponents();
		placeComponents();
		
		fillTextArea();
		
	}
	
	
	
													
													//*************************************
													//				SETTERS  	          *
													//*************************************
	/**
	 * 
	 * Set the UI
	 * 
	 * @param ui
	 * 		the UI
	 */
	private void setUI(JCpgUI ui){
		
		this.ui = ui;
		
	}
	
	
	
	
													
													//*************************************
													//				GETTERS		          *
													//*************************************
	/**
	 * 
	 * Get the UI
	 * 
	 * @return
	 * 		the UI
	 */
	public JCpgUI getUI(){
		
		return this.ui;
		
	}
	/**
	 * 
	 * Get the text area
	 * 
	 * @return
	 * 		the text area
	 */
	public JEditorPane getTextArea(){
		
		return this.textArea;
		
	}
	
	
	
													
													//*************************************
													//				SWING		          *
													//*************************************
	/**
	 * 
	 * Init swing components
	 *
	 */
	private void initComponents(){
		
		this.setLayout(null);
		
		screensize = Toolkit.getDefaultToolkit().getScreenSize();
		
		textArea = new JEditorPane();
		textArea.setBorder(new EtchedBorder());
		
		scrollPane = new JScrollPane(textArea);
		textArea.setEditable(false);
		
		close = new JButton("Close");
		savetofile = new JButton("Save to file");
		
		close.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				closeActionPerformed(evt);
			}
		});
		
		savetofile.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				saveToFileActionPerformed(evt);
			}
		});
		
	}
	/**
	 * 
	 * Position components
	 *
	 */
	private void boundComponents(){
		
		this.setBounds((int)(screensize.getWidth()/2)-500, (int)(screensize.getHeight()/2)-350, 1000, 700);
		this.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		this.setUndecorated(true);
		
		scrollPane.setBounds(10, 50, 980, 600);
		
		close.setBounds(450, 660, 100, 30);
		savetofile.setBounds(330, 660, 100, 30);
	
	}
	/**
	 * 
	 * Add components
	 *
	 */
	private void placeComponents(){
		
		this.getContentPane().add(scrollPane);
		this.getContentPane().add(close);
		this.getContentPane().add(savetofile);
		this.setVisible(true);
		
	}
	
	
	
	
	
																
																//*************************************
																//				EVENTS		          *
																//*************************************
	/**
	 * 
	 * Perform right actions when user clicks the close button
	 * 
	 */
	private void closeActionPerformed(java.awt.event.ActionEvent evt) {
		
		getUI().setEnabled(true);
		this.dispose();
		
	}
	/**
	 * 
	 * Perform right actions when user clicks the save to file button
	 * 
	 */
	private void saveToFileActionPerformed(java.awt.event.ActionEvent evt) {
		
		final JFileChooser savefile = new JFileChooser();
		
		int returnVal = savefile.showSaveDialog(this);
		
		if(returnVal == JFileChooser.APPROVE_OPTION) {
           
           try {
        	   
               BufferedWriter out = new BufferedWriter(new FileWriter(savefile.getSelectedFile().getName()));
               out.write(getTextArea().getText());
               out.close();
               
           } catch (Exception e) {
        	   
        	   System.out.println("JCpgMenuShowConfig: couldn't save configuration to a file");
        	   
           }
            
        }
		
	}
	
	
	
																
																//*************************************
																//				MUST IMPLEMENT		  *
																//*************************************
	/**
	 * 
	 * This function should be implemented by every class inhereting from this class. It loads the actual information and puts it in the text area
	 *
	 */
	private void fillTextArea(){
		
	}

}