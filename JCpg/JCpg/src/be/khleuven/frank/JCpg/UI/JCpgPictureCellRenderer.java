package be.khleuven.frank.JCpg.UI;

import java.awt.Component;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.GridLayout;
import java.awt.Insets;

import javax.swing.JLabel;
import javax.swing.JList;
import javax.swing.JPanel;
import javax.swing.ListCellRenderer;

import be.khleuven.frank.JCpg.JCpgImageUrlValidator;
import be.khleuven.frank.JCpg.Components.JCpgPicture;

/**
 * 
 * Determines how the pictures in the picture list are rendered
 * 
 * @author frank
 *
 */
public class JCpgPictureCellRenderer extends JPanel implements ListCellRenderer {
	
	private GridBagLayout gbl = new GridBagLayout();
	private GridBagConstraints gblc = new GridBagConstraints();
	private int y = 0;
	
	public JCpgPictureCellRenderer() {
		
        setOpaque(false); // transparent
        this.setLayout(gbl); // we will use the grid layout
        this.removeAll();
        
        gblc.insets = new Insets(10,10,10,10);
        gblc.weighty = 1;
        gblc.weightx = 1;
    	
	}
	
    public Component getListCellRendererComponent(JList list, Object value, int index, boolean isSelected, boolean cellHasFocus) {
    	
    	JCpgPicture picture = (JCpgPicture)value;
    	JLabel label = new JLabel(new JCpgImageUrlValidator("albums/" + picture.getFilePath() + "thumb_" + picture.getFileName()).createImageIcon());

        // determine grid position
    	System.out.println(index);
        gblc.gridx = index % 10;
        gblc.gridy = getDeler(index, 10);
        
    	this.add(label, gblc);
        
        return this;
        
    }
    
    private int getDeler(int source, int cutoff){
    	
    	int count = 0;
    	
    	while(source > cutoff){
    		
    		source = source - cutoff;
    		count++;
    		
    	}
    	
    	return count;
    	
    }
    
}
