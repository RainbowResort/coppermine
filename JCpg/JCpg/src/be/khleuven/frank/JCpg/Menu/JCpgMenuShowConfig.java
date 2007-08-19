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

import javax.swing.JLabel;

import be.khleuven.frank.JCpg.JCpgImageUrlValidator;
import be.khleuven.frank.JCpg.UI.JCpgUI;


/**
 * 
 * Shows the current config last fetch from the site
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgMenuShowConfig extends JCpgMenuShow {
	
	
	
	
	
	
													
													//*************************************
													//				VARIABLES	          *
													//*************************************
	private static final long serialVersionUID = 1L;
	
	private JLabel logo;
	
	private String configurationString = "";
	
	
	
	
	
	
	
	
													
													//*************************************
													//				CONSTRUCTOR	          *
													//*************************************
	/**
	 * 
	 * Makes the new JCpgMenuShowConfig object
	 * 
	 * @param ui
	 * 		the UI reference
	 */
	public JCpgMenuShowConfig(JCpgUI ui){
		
		super(ui);
		
		logo = new JLabel(new JCpgImageUrlValidator("data/menu_yoursiteconfig.jpg").createImageIcon(), JLabel.CENTER); // 1000x50
		logo.setBounds(0, 0, 1000, 50);
		this.getContentPane().add(logo);
		
		fillTextArea();
		
	}
	
	

	
	
													
													//*************************************
													//				IMPLEMENTATION        *
													//*************************************
	/**
	 * 
	 * Read the loaded configuration and show it
	 *
	 */
	private void fillTextArea(){
		
		for(int i=0; i<getUI().getCpgConfig().getSiteConfig().getConfigEntries().size(); i++){
			
			if(i+2 < getUI().getCpgConfig().getSiteConfig().getConfigEntries().size())
				configurationString = configurationString + getUI().getCpgConfig().getSiteConfig().getConfigEntries().get(i) + "\t\t" + getUI().getCpgConfig().getSiteConfig().getConfigEntries().get(++i) + "\n";
			
		}
		
		getTextArea().setText(configurationString);
		
	}
	
	

}