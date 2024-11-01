<?php
/**
 * KasTooltip Plugin
 * 
 * FILE
 * kastooltip_functions.php
 *
 * DESCRIPTION
 * Contains base functions of the plugin.
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
 
 
	function kastooltip_wp_head() {
		// Set plugin URL	
		$url = defined('WP_PLUGIN_URL') ? WP_PLUGIN_URL . '/wp-kastooltip' : get_bloginfo('wpurl') . '/wp-content/plugins/wp-kastooltip';
		// get plugins options
		$options = get_option( 'kastooltip_wp_options', array() );
		// default theme
		$theme = 'bubble';
		if(isset($options['theme'])){
			$theme = $options['theme'];
		}
		echo "<style type=\"text/css\">";
		echo "a.kastooltip{position:relative;z-index:24;color:#3CA3FF;font-weight:bold;text-decoration:none;}";
		echo "a.kastooltip span{ display: none; }";
		echo "a.kastooltip:hover{ z-index:25; color: #aaaaff; background:;}";
		echo "a.kastooltip:hover span.tooltip{display:block;position:absolute;top:0px; left:0;padding: 15px 0 0 0;width:200px;color: #993300;text-align: center;filter: alpha(opacity:90);KHTMLOpacity: 0.90;MozOpacity: 0.90;opacity: 0.90;}";
		echo "a.kastooltip:hover span.top{display: block;padding: 30px 8px 0;background: url($url/themes/$theme/bubble.gif) no-repeat top;}";
		echo "a.kastooltip:hover span.middle{display: block;padding: 0 8px;background: url($url/themes/$theme/bubble_filler.gif) repeat bottom;}";
		echo "a.kastooltip:hover span.bottom{display: block;padding:3px 8px 10px;color: #548912;background: url($url/themes/$theme/bubble.gif) no-repeat bottom;}";
		echo "</style>";
	}

	// Shortcode function for kastooltip tag; sample [kastooltip  ....]
	function kastooltip_wp_tags($atts, $content = null) {
			extract(shortcode_atts(array(
			'msg' => '',
			'tooltip' => ''
			), $atts));	
		// verify type is set
		if($msg == '' || $tooltip == ''){
			return "<b>kastooltip:</b>use [kastooltip msg=\"Here Mgs\" tooltip=\"Popups message\"]"; 
		}
		
		return '<a href="#" class="kastooltip">'.$msg.'<span class="tooltip"><span class="top"></span><span class="middle">'.$tooltip.'</span><span class="bottom"></span></span></a>';
	}

	// add settings link on plugins list
    function kastooltip_wp_plugin_action($links, $file) {
		if ($file == plugin_basename(dirname(__FILE__).'/kastooltip.php')){
			$settings_link = '<a href="admin.php?page=wp-kastooltip/kastooltip_administration.php">Settings</a>';
			return array_merge(array($settings_link), $links);
		}
		return $links;
    }	
?>