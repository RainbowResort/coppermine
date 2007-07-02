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

package be.khleuven.frank.JCpg.Updater;

import java.awt.Window;

import be.khleuven.frank.JCpg.Manager.JCpgProgressManager;



/**
 * Show update window looking for new updates
 * @author    Frank Cleynen
 */
public class JCpgUpdater extends JCpgProgressManager {
	
	
																									
																									//*************************************
																									//				VARIABLES             *
																									//*************************************
	JCpgVersionchecker vc = new JCpgVersionchecker("http://ardella.madoka.be/jcpg/updater/version.dat");
	
	
	
	
																																																	
																									//*************************************
																									//				CONSTRUCTOR           *
																									//*************************************
	/**
	 * 
	 * Makes a new JCpgUpdater object
	 * 
	 * @param parent
	 * 		the parent window, the window from where this updater was called
	 * @param maximum
	 * 		maximum of the progressbar
	 */
	public JCpgUpdater(Window parent, int maximum){
		
		super(parent, maximum, "data/updater_logo.jpg", true, false);
		doAction();
		
	}
	
	
	
																									
																									//*************************************
																									//				MUTATORS & OTHERS     *
																									//*************************************																							
	/**
	 * 
	 * This is the interface implementation. You can undertake certain self implemented actions while the updater is active.
	 * 
	 */
	public boolean doAction() {
		
		if(vc.downloadRemoteVersionFile()){ // download the remote version file
		
			if(vc.processVersionFile()){ // get all the information out of this file
				
				if(vc.newVersionAvailable()){ // check for new version
					
					changeProgressMaximum(vc.getUpdatefileSize()); // set maximum of progressbar to updatefile size
					vc.getUpdate(this); // get the actual update file and update progressbar
					
				}
				
			}
		
		}
		
		return false;
	
	}

}
