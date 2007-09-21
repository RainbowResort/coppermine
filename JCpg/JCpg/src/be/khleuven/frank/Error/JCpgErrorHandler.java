package be.khleuven.frank.Error;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.Date;

import be.khleuven.frank.JCpg.UI.JCpgUI;

/**
 * 
 * Used to handle error messages received by the API
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgErrorHandler {
	
	
	
	
	private JCpgUI ui;
	private File log = null;
	private boolean writingIsPossible = false;
	
	
	
	/**
	 * 
	 * Make a new JCpgErrorHandler object
	 *
	 */
	public JCpgErrorHandler(){
		
		setUi(ui);
		
		log = new File("log/log.dat");
		
		if(!log.exists()){
			
			try {
				
				log.createNewFile();
				writingIsPossible = true;
				
			} catch (IOException e) {
				
				System.out.println("JCpgError; couldn't create log file");
				
			}
			
		}else{
			
			writingIsPossible = true;
			
		}
		
	}
	
	
	
	/**
	 * 
	 * Set the ui
	 * 
	 * @param ui
	 * 		the ui
	 */
	private void setUi(JCpgUI ui){
		
		this.ui = ui;
		
	}
	
	
	/**
	 * 
	 * Get the ui
	 * 
	 * @return
	 * 		the ui
	 */
	public JCpgUI getUi(){
		
		return this.ui;
		
	}
	
	
	/**
	 * 
	 * Add a log entry to the logfile
	 * 
	 * @param entry
	 * 		the entry to add to the log file
	 */
	public void addLogEntry(String entry){
		
		if(writingIsPossible){
		
			Date date = new Date();
			
			String logentry = date.toString() + " - " + entry + "\n";
			
			
			try {
				
				FileWriter fstream = new FileWriter(log, true);
				BufferedWriter out = new BufferedWriter(fstream);
				
				if(logentry.length() > 0){
					
					out.write(logentry);
				
				}
				
			    out.close();
				
			} catch (IOException e) {
				
				System.out.println("JCpgErrorHandler: coudln't add log entry");
				
			}
	    
		}
		
	}

}
