package be.khleuven.frank.JCpg.Updater;

import java.io.BufferedOutputStream;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.IOException;
import java.io.InputStream;
import java.net.URL;
import java.net.URLConnection;

import javax.swing.JProgressBar;

import be.khleuven.frank.JCpg.Manager.JCpgProgressManager;

/**
 * 
 * Visits the jcpgtool.org website and looks for an update
 * 
 * @author frank
 * @todo: set updatefile url in version file, so this link is dynamic 
 *
 */
public class JCpgVersionchecker {
	
	
	
	
	private String versionUrl = null, updateUrl = null;
	private int updatefileSize = 0;
	private double serverVersion = 0.0;
	
	
	
	
	/**
	 * 
	 * Create a new Versionchecker object
	 * 
	 * @param versionUrl
	 * 		url to the remote version file
	 * @param updateUrl
	 * 		url to the update file
	 */
	public JCpgVersionchecker(String versionUrl){
		
		setVersionUrl(versionUrl);
		
	}
	
	
	
	
	
	
	
	/**
	 * 
	 * Set the server version
	 * 
	 * @param serverVersion
	 * 		the server version
	 */
	private void setServerVersion(double serverVersion){
		
		this.serverVersion = serverVersion;
		
	}
	/**
	 * 
	 * Set the version url
	 * 
	 * @param versionUrl
	 */
	private void setVersionUrl(String versionUrl){
		
		this.versionUrl = versionUrl;
		
	}
	/**
	 * 
	 * Set the update url
	 * 
	 * @param updateUrl
	 */
	private void setUpdateUrl(String updateUrl){
		
		this.updateUrl = updateUrl;
		
	}
	/**
	 * 
	 * Set the filesize of the actual update file
	 * 
	 * @param updatefileSize
	 * 		the filesize of the actual update file
	 */
	private void setUpdateFileSize(int updatefileSize){
		
		this.updatefileSize = updatefileSize;
		
	}
	
	
	
	
	
	
	
	
	
	public double getServerVersion(){
		
		return this.serverVersion;
		
	}
	/**
	 * 
	 * Get the version url
	 * 
	 * @return
	 */
	public String getVersionUrl(){
		
		return this.versionUrl;
		
	}
	/**
	 * 
	 * Get the update url
	 * 
	 * @return
	 */
	public String getUpdateUrl(){
		
		return this.updateUrl;
		
	}
	/**
	 * 
	 * Get the updatefile size
	 * 
	 * @return
	 * 		the updatefile size
	 */
	public int getUpdatefileSize(){
		
		return this.updatefileSize;

	}
	
	
	
	
	
	
	
	
	/**
	 * 
	 * Download remote version file
	 * 
	 * @return
	 * 		true if download succeeds, else false
	 */
	public boolean downloadRemoteVersionFile(){
		
		try {
			
			File delete = new File("rversion.dat"); // delete file if it already exists
			if(delete.exists()) delete.delete();
	    	
			URL url = new URL(getVersionUrl()); // download remote version
			BufferedOutputStream out = new BufferedOutputStream(new FileOutputStream("rversion.dat"));
			URLConnection conn = url.openConnection();
			InputStream in = conn.getInputStream();
			
			byte[] buffer = new byte[1024];
			int numRead;
			
			while ((numRead = in.read(buffer)) != -1) {
				
				out.write(buffer, 0, numRead);
				
			}

		    out.close();
		    
		    return true;
			
		} catch (Exception exception) {
			
			System.out.println("JCpgVersionChecker: couldn't retrieve remote version");
		
		}
		
		return false;
		
	}
	/**
	 * 
	 * Get all the information form the remote version file
	 * This file currently contains 3 lines:
	 * 	1) server version
	 * 	2) url to update file
	 * 	3) size of this update file in bytes, used by progressbar 
	 * 
	 * @return
	 */
	public boolean processVersionFile(){
		
		try {
			
			File file = new File("rversion.dat"); // delete file after reading
			
			if(file.exists()){
			
		        BufferedReader in = new BufferedReader(new FileReader("rversion.dat")); // read remote version
		        
		        setServerVersion(new Double(in.readLine()));
		        setUpdateUrl(in.readLine());
		        setUpdateFileSize(new Integer(in.readLine()));
		        
		        in.close();
		        
				if(file.exists()) file.delete();
				
				return true; // success
			}
			
			return false; // file does not exist
	        
	    } catch (IOException e) {
	    	
	    	System.out.println("JCpgVersionChecker: couldn't read remote version (possible: file does not exist)");
	    	
	    }
	    
	    return false; // failure
		
	}
	/**
	 * 
	 * Check if a newer version is available
	 * 
	 * @return
	 * 		true if there is newer version, else false
	 */
	public boolean newVersionAvailable(){
		
		Double currentversion = 0.0;
		
		// read local version
		try {
			
	        BufferedReader in = new BufferedReader(new FileReader("version.dat")); // read version on disk
	        currentversion = new Double(in.readLine());
	        in.close();
	        
	    } catch (IOException e) {
	    	
	    	System.out.println("JCpgVersionChecker: couldn't read local version");
	    	
	    }
	    
	    // compare versions
	    if(getServerVersion() > currentversion){
	    
	    	System.out.println("JCpgVersionChecker: New version available");
	    	return true;
	    	
	    }else{
	    	
	    	System.out.println("JCpgVersionChecker: No new version available");
	    	return false;
	    	
	    }
		
	}
	/**
	 * 
	 * Get the actual updatefile
	 * 
	 * @return
	 * 		true if the update file was downloaded succesfully, else false
	 */
	public boolean getUpdate(JProgressBar progress){
		
	    try {
	    	
			URL url = new URL(getUpdateUrl()); // download update
			
			String[] parts = getUpdateUrl().split("/"); // split url at each / and get latest part = update filename
			
			BufferedOutputStream out = new BufferedOutputStream(new FileOutputStream(parts[parts.length-1]));
			URLConnection conn = url.openConnection();
			InputStream in = conn.getInputStream();
			
			byte[] buffer = new byte[1024];
			int numRead;
			int readBytes = 0;
			
			while ((numRead = in.read(buffer)) != -1) {
				
				out.write(buffer, 0, numRead);
				readBytes = readBytes + numRead;
				progress.setValue(readBytes);
				
			}

		    out.close();
		    
		    System.out.println("JCpgVersionChecker: update downloaded succesfully");
		    
		    return true; // success
			
		} catch (Exception exception) {
			
			System.out.println("JCpgVersionChecker: couldn't retrieve update");
		
		}
		
		return false; // failure
		
	}
	
}
