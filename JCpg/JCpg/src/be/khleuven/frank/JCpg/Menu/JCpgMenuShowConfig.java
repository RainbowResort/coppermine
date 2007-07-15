package be.khleuven.frank.JCpg.Menu;

import java.awt.Dimension;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JFrame;
import javax.swing.JScrollPane;
import javax.swing.JTextArea;
import javax.swing.border.EtchedBorder;

import be.khleuven.frank.JCpg.UI.JCpgUI;

public class JCpgMenuShowConfig  extends JDialog {
	
	private JCpgUI ui;
	private Dimension screensize;
	
	private JButton close;
	private JTextArea config;
	
	private JScrollPane scrollPane;
	
	
	public JCpgMenuShowConfig(JCpgUI ui){
		
		super(ui);
		
		ui.setEnabled(false);
		
		setUI(ui);
		
		initComponents();
		boundComponents();
		placeComponents();
		
		loadConfig();
		
	}
	
	
	
	private void setUI(JCpgUI ui){
		
		this.ui = ui;
		
	}
	
	
	public JCpgUI getUI(){
		
		return this.ui;
		
	}
	
	
	/**
	 * 
	 * Init swing components
	 *
	 */
	private void initComponents(){
		
		this.setLayout(null);
		
		screensize = Toolkit.getDefaultToolkit().getScreenSize();
		
		config = new JTextArea();
		config.setBorder(new EtchedBorder());
		
		scrollPane = new JScrollPane(config);
		config.setEditable(false);
		
		close = new JButton("Close");
		
		close.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent evt) {
				closeActionPerformed(evt);
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
		
		config.setBounds(10, 10, 980, 600);
		
		close.setBounds(450, 660, 100, 30);
	
	}
	/**
	 * 
	 * Add components
	 *
	 */
	private void placeComponents(){
		
		this.getContentPane().add(config);
		this.getContentPane().add(scrollPane);
		this.getContentPane().add(close);
		this.setVisible(true);
		
	}
	
	/**
	 * 
	 * Perform right actions when user clicks the close button
	 * 
	 */
	private void closeActionPerformed(java.awt.event.ActionEvent evt) {
		
		getUI().setEnabled(true);
		this.dispose();
		
	}
	
	
	private void loadConfig(){
		
		String entry = "";
		
		for(int i=0; i<getUI().getCpgConfig().getSiteConfig().getConfigEntries().size(); i++){
			
			if(i+2 < getUI().getCpgConfig().getSiteConfig().getConfigEntries().size())
				entry = entry + getUI().getCpgConfig().getSiteConfig().getConfigEntries().get(i) + "\t" + getUI().getCpgConfig().getSiteConfig().getConfigEntries().get(++i) + "\n";
			
		}
		
		config.setText(entry);
		
	}
	
	

}
