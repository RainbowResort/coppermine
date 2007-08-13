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
import be.khleuven.frank.JCpg.Communicator.JCpgPhpCommunicator;
import be.khleuven.frank.JCpg.UI.JCpgUI;


/**
 * 
 * Tries to extract information about the current user from the Coppermine site
 * Online mode required
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgMenuShowUser extends JCpgMenuShow {
	
	
													
													//*************************************
													//				VARIABLES	          *
													//*************************************
	private static final long serialVersionUID = 1L;
	
	private JLabel logo;
	
	private String userString = "";
	
	
	
													
													//*************************************
													//				CONSTRUCTOR	          *
													//*************************************
	/**
	 * 
	 * Makes a new JCpgMenuShowUser object
	 * 
	 * @param ui
	 * 		the UI reference
	 */
	public JCpgMenuShowUser(JCpgUI ui){
		
		super(ui);
		
		logo = new JLabel(new JCpgImageUrlValidator("data/menu_youruserconfig.jpg").createImageIcon(), JLabel.CENTER); // 1000x50
		logo.setBounds(0, 0, 1000, 50);
		this.getContentPane().add(logo);
		
		fillTextArea();
		
	}

	

	
													
													//*************************************
													//				IMPLEMENTATION	      *
													//*************************************
	/**
	 * 
	 * Tries to fetch information from the current user from the Coppermine site and displays it
	 *
	 */
	private void fillTextArea(){
		
		JCpgPhpCommunicator phpCommunicator = new JCpgPhpCommunicator(getUI().getCpgConfig().getUserConfig().getBaseUrl()); // make a phpCommunicator object to talk with the API
		
		String parameters = "showusers&username=" + getUI().getCpgConfig().getUserConfig().getUsername() + "&sessionkey=" + getUI().getCpgConfig().getUserConfig().getSessionkey();
		
		if(getUI().getOnlinemode() && phpCommunicator.performPhpRequest(parameters) == 0){ // show user ok
			
			userString = userString + "Username:" + "\t\t" + phpCommunicator.getXmlTagText("userdata", "username") + "\n";
			userString = userString + "User IDs:" + "\t\t" + phpCommunicator.getXmlTagText("userdata", "user_id") + "\n";
			userString = userString + "E-mail:" + "\t\t" + phpCommunicator.getXmlTagText("userdata", "email") + "\n";
			userString = userString + "Registration date:" + "\t\t" + phpCommunicator.getXmlTagText("userdata", "regdate") + "\n";
			userString = userString + "Last visit:" + "\t\t" + phpCommunicator.getXmlTagText("userdata", "lastvisit") + "\n";
			userString = userString + "Active:" + "\t\t" + phpCommunicator.getXmlTagText("userdata", "active") + "\n";
			userString = userString + "Group name:" + "\t\t" + phpCommunicator.getXmlTagText("userdata", "groupname") + "\n";
			
			getTextArea().setText(userString);

		}else{
			
			userString = "Couldn't fetch your user information. Maybe you are not online.";
			getTextArea().setText(userString);
			
			System.out.println("JCpgMenuShowUser: couldn't fetch user data");
			
		}
		
	}

}