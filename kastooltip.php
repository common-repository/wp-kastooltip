<?php
/*
Plugin Name: KasTooltip
Plugin URI: http://www.kasbeel.cl/kas2008/kasplugins/wp-kastooltip/
Description: Display a pop tooltip, on a text selected.
Version: 0.2
Author: Wladimir A. Jimenez B.
Author URI: http://www.kasbeel.cl/

Acknowledgement: 
	Trent Richardson - http://trentrichardson.com/examples/csstooltips/
*/
/**
 * KasTooltip Plugin
 * 
 * FILE
 * kastooltip.php
 *
 * DESCRIPTION
 * Contains hooks of the plugins
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

 /**
 * Inclusion of administration,  and general functions.
 */
   if(!defined('KASPLUGINS'))	
	include( 'kasplugins_administration.php' );
   
   include( 'kastooltip_administration.php' );
   include( 'kastooltip_functions.php' );
 
 /**
 * Addition functions to hooks.
 */

if (is_admin()) {
   // Create administration menu 
   add_action( 'admin_menu', 'kastooltip_wp_addmenu' );
}
else{
	// include headers 
	add_action('wp_head', 'kastooltip_wp_head');
}

// Shortcode for [kastooltip  ....]
add_shortcode('kastooltip', 'kastooltip_wp_tags' );

// Activation of plugin
register_activation_hook( __FILE__, 'kastooltip_wp_activate' );

// Deactivation of plugin 
register_deactivation_hook( __FILE__, 'kastooltip_wp_deactivate' );

// Add link settings 
add_filter('plugin_action_links', 'kastooltip_wp_plugin_action', 10, 2);


