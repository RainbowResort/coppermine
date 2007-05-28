package be.khleuven.frank.JCpg.Updater;

import be.khleuven.frank.JCpg.Manager.JCpgProgressManager;
import be.khleuven.frank.JCpg.UI.JCpgUI;




/**
 * 
 * Show update window looking for new updates
 * 
 * @author frank
 *
 */
public class JCpgUpdater extends JCpgProgressManager {
	
	JCpgVersionchecker vc = new JCpgVersionchecker("http://ardella.madoka.be/jcpg/updater/version.dat");
	
	
	
	public JCpgUpdater(JCpgUI ui, int maximum){
		
		super(ui, maximum, "data/updater_logo.jpg");
		doAction();
		
	}
	
	
	
	
	
	public boolean doAction() {
		
		if(vc.downloadRemoteVersionFile()){ // download the remote version file
		
			if(vc.processVersionFile()){ // get all the information out of this file
				
				if(vc.newVersionAvailable()){ // check for new version
					
					changeProgressMaximum(vc.getUpdatefileSize()); // set maximum of progressbar to updatefile size
					vc.getUpdate(getProgressBar()); // get the actual update file
					
				}
				
			}
		
		}
		
		return false;
	
	}

}
