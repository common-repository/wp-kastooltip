<?php
/**
 * KasTooltip Plugin
 * 
 * FILE
 * kastooltip_administration.php
 *
 * DESCRIPTION
 * Contains base functions to admin of the plugin.
 *
 *   Copyright (C) 2010  Wladimir A. Jimenez B.
 *   E-mail: wjimenez@kasbeel.cl
 *   Home site: www.kasbeel.cl
 *
 *   This file is part of wp-kastooltip.
 *
 *   wp-kastooltip is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>. 
 **/

	// Function plugin active, set initial parameters
	function kastooltip_wp_activate() {
		if ( false === get_option('kastooltip_wp_options') )
		{
			// set default options
			$def = array( 'theme' => 'bubble');
			update_option('kastooltip_wp_options', $def);
		}

	}
	// Function plugin deactive
	function kastooltip_wp_deactivate() {
		//empty
	}

	// Function plugin uninstall, clean all data of the plugin
	function kastooltip_wp_uninstall() {
		//clear options
		delete_option('kastooltip_wp_options');	   
	}

	// Home plugins menu.
	function kastooltip_wp_admin_settings() {
	    kasplugins_wp_admin_home();
		echo '<div class="wrap">';
		echo '<h2>KasTooltip</h2>';
		// get options array
		$options = get_option('kastooltip_wp_options');
		// Overwrite existing options
		if ( isset( $_POST['submit'] ) ) {
			$options['theme'] = $_POST['kastooltip_wp_theme'];
			update_option( 'kastooltip_wp_options', $options );
		}		
		echo '<p>More details in homepage of the plugin in : <a href="http://www.kasbeel.cl/kas2008/kasplugins/wp-kastooltip/">Kasbeel Plugins for Wordpress - KasTooltip</a>.</p>';
		echo '<form method="post" action="">';
		echo '<table class="widefat">';
		echo '<thead>';
		echo '<tr><th colspan="2" style="text-align:center;">';
		echo 'Customization';
		echo '</th></tr>';
		echo '</thead>';
		// Generate plugin DIR	
		$url = defined('WP_PLUGIN_DIR') ? WP_PLUGIN_DIR . '/wp-kastooltip/themes' : get_bloginfo('HOME') . '/wp-content/plugins/wp-kastooltip/themes';
		// Capture directories in theme plugin DIR	
		$files = scandir($url);
			
		echo '<tr valign="top">';
		echo '<th scope="row">Themes</th>';
		echo '<td><select name="kastooltip_wp_theme" id="kastooltip_wp_theme">';
		foreach ($files as $folder) {
			if ( is_dir( $url . '/' . $folder ) && $folder != '.' && $folder != '..' ) {
				echo '<option' . ( $folder == $options['theme'] ? ' selected="selected"' : '' ) . '>' . $folder . '</option>';
			}
		}
		echo '</select></td>';
		echo '</tr>';
		echo '<tr>';
		// Generate plugin URL	
		$url = defined('WP_PLUGIN_URL') ? WP_PLUGIN_URL . '/wp-kastooltip/themes' : get_bloginfo('wpurl') . '/wp-content/plugins/wp-kastooltip/themes';
		echo '<td colspan="2" align="center"><img id="thumbs-box" name="thumbs-box" src="'.$url.'/'.$options['theme'].'/bubble.gif"></td>';
		echo '</tr>';
		echo '</table>';
		echo '<p class="submit">';
		echo '<input type="submit" name="submit" class="button-secondary" value="Save changes" />';
		echo '</p>';		
		echo '</form>';		
		
		echo '<table class="widefat">';
		echo '<thead>';
		echo '<tr><th colspan="2" style="text-align:center;">';
		echo 'Help';
		echo '</th></tr>';
		echo '</thead>';
		echo '<tr><td>';
		echo 'Using To:<br/>';
		echo '<br/>';
		echo '&nbsp;Show Customer Tooltip:<br/>';
		echo '<br/>';
		echo '&nbsp;[kastooltip msg="Text with tooltip" tooltip="Text in tooltip"]<br/>';
		echo '<br/>';
		echo '<td></tr></table>';
		echo '</div>';
	}

	// Create Plugins Menu.
	function kastooltip_wp_addmenu() {
		if ( function_exists('add_submenu_page') ) {
			// General plugins settings
			add_submenu_page( KASPLUGINS.'/kasplugins_administration.php' , 'KasTooltip', 'KasTooltip', 8, __FILE__, 'kastooltip_wp_admin_settings');
		}
	}

?>