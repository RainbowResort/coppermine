package be.khleuven.frank.Error;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.Date;

import be.khleuven.frank.JCpg.UI.JCpgUI;

public class JCpgErrorHandler {
	
	private JCpgUI ui;
	private File log = null;
	private boolean writingIsPossible = false;
	
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
	
	private void setUi(JCpgUI ui){
		
		this.ui = ui;
		
	}
	
	public JCpgUI getUi(){
		
		return this.ui;
		
	}
	
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
