package be.khleuven.frank.JCpg.Configuration;
import java.io.Serializable;
import java.math.BigInteger;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;


/**
 * 
 * Server configuration
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgServerConfig implements Serializable{
	
												
	
				
																//*************************************
																//				VARIABLES             *
																//*************************************
	String server = null, username = null, pwd = null, database = null, prefix = null, configName = null;
	
	
	
	
															
																//*************************************
																//				CONSTRUCTORS          *
																//*************************************
	/**
	 * 
	 * Make a new ServerConfig object
	 * 
	 * @param server
	 * 		the servername
	 * @param username
	 * 		the username
	 * @param pwd
	 * 		the user's password
	 */
	public JCpgServerConfig(String configName, String server, String username, String pwd, String database, String prefix){
		
		setConfigName(configName);
		setUsername(username);
		setPwd(pwd);
		setDatabase(database);
		setServer(server); // must come after setDatabase because the getDatabase() is used in making the complete server string
		setPrefix(prefix);
		
	}
	
	
	
	
	
															
																//*************************************
																//				SETTERS		          *
																//*************************************
	private void setConfigName(String configName){
		
		this.configName = configName;
		
	}
	/**
	 * 
	 * Set the server for this connection
	 * 
	 * @param server
	 * 		the server for this connection
	 */
	private void setServer(String server){
		
		this.server = server;
		
	}
	/**
	 * 
	 * Set the username for this connection
	 * 
	 * @param username
	 * 		the username for this connection
	 */
	private void setUsername(String username){
		
		this.username = username;
		
	}
	/**
	 * 
	 * Set the password for this connection
	 * 
	 * @param pwd
	 * 		the password for this connection
	 */
	private void setPwd(String pwd){
		
		this.pwd = pwd;
		
	}
	/**
	 * 
	 * Set the database for this connection: the databasename where the Cpg tables are stored
	 * 
	 * @param database
	 * 		the database for this connection
	 */
	private void setDatabase(String database){
		
		this.database = database;
		
	}
	/**
	 * 
	 * Set the prefix for this connection: a certain prefix, selected at installation, which is added before each Cpg tablename
	 * 
	 * @param prefix
	 * 		the prefix for this connection
	 */
	private void setPrefix(String prefix){
		
		this.prefix = prefix;
		
	}
	
	
	
															
																//*************************************
																//				GETTERS		          *
																//*************************************
	public String getConfigName(){
		
		return this.configName;
		
	}
	/**
	 * 
	 * Get the server for this connection
	 * 
	 * @return
	 * 		the server for this connection
	 */
	public String getServer(){
		
		return this.server;
		
	}
	/**
	 * 
	 * Get the full server string for this connection
	 * 
	 * @return
	 * 		the full server string for this connection
	 */
	public String getFullServer(){
		
		return "jdbc:mysql://" + this.server + ":3306/" + getDatabase();
		
	}
	/**
	 * 
	 * Get the username for ths connection
	 * 
	 * @return
	 * 		the username for ths connection
	 */
	public String getUsername(){
		
		return this.username;
		
	}
	/**
	 * 
	 * Get the password for ths connection (plaintext)
	 * 
	 * @return
	 * 		the password for ths connection
	 */
	public String getPwd(){
		
		return this.pwd;
		
	}
	/**
	 * 
	 * Get the database for ths connection
	 * 
	 * @return
	 * 		the database for ths connection
	 */
	public String getDatabase(){
		
		return this.database;
		
	}
	/**
	 * 
	 * Get the prefix for ths connection
	 * 
	 * @return
	 * 		the prefix for ths connection
	 */
	public String getPrefix(){
		
		return this.prefix;
		
	}
	/**
	 * 
	 * Get the password for ths connection (MD5)
	 * 
	 * @return
	 * 		the password for ths connection
	 */
	public String getPwdMd5() throws NoSuchAlgorithmException{
		
	    MessageDigest m=MessageDigest.getInstance("MD5");
	    m.update(getPwd().getBytes(),0,getPwd().length());
	    return new BigInteger(1,m.digest()).toString(16);
	    
	}
	
	
	public String toString(){
		
		return getConfigName();
		
	}
	
	
	public void changeConfigName(String configName){
		
		setConfigName(configName);
		
	}
	public void changeServer(String server){
		
		setServer(server);
		
	}
	public void changeUsername(String username){
		
		setUsername(username);
		
	}
	public void changePassword(String pwd){
		
		setPwd(pwd);
		
	}
	public void changeDatabase(String database){
		
		setDatabase(database);
		
	}
	public void changePrefix(String prefix){
		
		setPrefix(prefix);
		
	}
	
}
