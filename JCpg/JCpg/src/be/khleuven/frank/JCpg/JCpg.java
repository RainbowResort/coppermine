package be.khleuven.frank.JCpg;

import be.khleuven.frank.JCpg.UI.JCpgSplashscreen;
import be.khleuven.frank.JCpg.UI.JCpgUI;
import be.khleuven.frank.JCpg.Updater.JCpgUpdater;

/**
 * 
 * JCpg main class
 * 
 * @author Frank Cleynen
 *
 */
public class JCpg {
	
	public static void main(String[] args) {
		
		//new JCpgSplashscreen(359, 76, 2000);
		new JCpgUI(true);
		new JCpgUpdater(null, 100);

	}

}
