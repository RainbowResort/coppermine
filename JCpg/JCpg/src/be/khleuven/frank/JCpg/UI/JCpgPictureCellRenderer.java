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

package be.khleuven.frank.JCpg.UI;

import java.awt.Color;
import java.awt.Component;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Insets;

import javax.swing.JLabel;
import javax.swing.JList;
import javax.swing.JPanel;
import javax.swing.ListCellRenderer;
import javax.swing.border.EtchedBorder;

import be.khleuven.frank.JCpg.JCpgImageUrlValidator;
import be.khleuven.frank.JCpg.Components.JCpgPicture;

/**
 * 
 * Determines how the pictures in the picture list are rendered
 * 
 * @author Frank Cleynen
 *
 */
public class JCpgPictureCellRenderer extends JPanel implements ListCellRenderer {
	
	
	
																//*************************************
																//				VARIABLES	          *
																//*************************************
	private static final long serialVersionUID = 1L;
	
	private JCpgUI ui = null;
	
	private GridBagLayout gbl = new GridBagLayout();
	private GridBagConstraints gblc = new GridBagConstraints();
	
	
	
																
	
	
	
	
	
																//*************************************
																//				CONSTRUCTOR	          *
																//*************************************
	/**
	 * 
	 * Makes a new JCpgPictureCellRenderer object
	 * 
	 * @param ui
	 * 		reference to the UI
	 */
	public JCpgPictureCellRenderer(JCpgUI ui) {
		
		setUi(ui);
		
        setOpaque(false); // transparent
        this.setLayout(gbl); // we will use the grid layout
        
        gblc.fill = GridBagConstraints.BOTH;
        gblc.insets = new Insets(10,10,10,10);
    	gblc.ipadx = 10;
    	gblc.ipady = 10;
        
	}
	
	
	
	
	
	
																
																//*************************************
																//				SETTERS		          *
																//*************************************
	/**
	 * 
	 * Set the UI
	 * 
	 * @param ui
	 * 		the UI
	 */
	private void setUi(JCpgUI ui){
		
		this.ui = ui;
		
	}
	
	
	
	
	
	
	
																
																//*************************************
																//				GETTERS		          *
																//*************************************
	/**
	 * 
	 * Get the UI
	 * 
	 * @return
	 * 		the UI
	 */
	public JCpgUI getUi(){
		
		return this.ui;
		
	}
	
	
																
	
	
	
	
																//*************************************
																//				MUTATORS & OTHERS	  *
																//*************************************
	/**
	 * 
	 * Determines how each cell will be displayed
	 * 
	 */
    public Component getListCellRendererComponent(JList list, Object value, int index, boolean isSelected, boolean cellHasFocus) {
    	
    	this.removeAll();
    	
    	JCpgPicture picture = (JCpgPicture)value;
    	JLabel label = new JLabel(new JCpgImageUrlValidator(getUi().getCpgConfig().getSiteConfig().getValueFor("fullpath") + picture.getFilePath() + "thumb_" + picture.getFileName()).createImageIcon());
        
    	// determine grid position
        gblc.gridx = index % 10;
        gblc.gridy = getRow(index, 10);
        
        
        JPanel p = new JPanel(new GridBagLayout()); // make a panel to put everything in it
        p.setBorder(new EtchedBorder());
        p.setBackground(new Color(255,255,255));
        
        GridBagConstraints panelgblc = new GridBagConstraints();
        
        panelgblc.gridx = 1;
        panelgblc.gridy = 0;
        p.add(label, panelgblc);
        
        panelgblc.gridx = 1;
        panelgblc.gridy = 1;
        p.add(new JLabel(((JCpgPicture)value).getFileName()), panelgblc);
    	
    	this.add(p, gblc); // add the panel with all components in it to the list
    	
        return this;
        
    }
    /**
     * 
     * Used to determine the Y value (=row) in the picture list for a particular cell
     * 
     * @param source
     * 		index of the list item
     * @param cutoff
     * 		number of cells in one row
     * @return
     * 		the y value for this cell based on the index and cutoff
     */
    private int getRow(int source, int cutoff){
    	
    	int count = 0;
    	
    	while(source > cutoff){
    		
    		source = source - cutoff;
    		count++;
    		
    	}
    	
    	return count;
    	
    }
    
}