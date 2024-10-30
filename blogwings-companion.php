<?php
/*
  Plugin Name: BlogWings Companion
  Description: With the help of Blogwings Companion unlimited addon you can add unlimited number of post  with color options for each.
  Version: 1.0.7
  Author: Blogwings.com
  Text Domain: blogwings-companion
  License URI:  https://www.gnu.org/licenses/gpl-2.0.html
  Author URI: http://www.blogwings.com/
 */
  if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
  
// Version constant for easy CSS refreshes
define('BLOGWINGS_COMPANION_VERSION', '1.0.0');
define('BLOGWINGS_COMPANION_PLUGIN_URL', plugin_dir_url(__FILE__));

function blogwings_companion_theme_text_domain(){
	$theme = wp_get_theme();
	$themeArr=array();
	$themeArr[] = $theme->get( 'TextDomain' );
	$themeArr[] = $theme->get( 'Template' );
	return $themeArr;
}

function blogwings_companion_load_file(){
	include_once(plugin_dir_path(__FILE__) . 'admin/customizer-font-selector/class/class-oneline-font-selector.php' );
    include_once(plugin_dir_path(__FILE__) . 'admin/customizer-range-value/class/class-oneline-customizer-range-value-control.php' );
    $font_selector_functions = plugin_dir_path(__FILE__) . 'admin/customizer-font-selector/functions.php';
    if ( file_exists( $font_selector_functions ) ){
    	include_once( $font_selector_functions );
	}
	include_once(plugin_dir_path(__FILE__) . 'admin/customizer-tabs/class/class-customize-control-tabs.php' );
	include_once(plugin_dir_path(__FILE__) . 'admin/customizer-radio-image/class/class-customize-control-radio-image.php' );
	include_once(plugin_dir_path(__FILE__) . 'admin/customizer-scroll/class/class-customize-control-scroll.php' );
}

add_action('after_setup_theme', 'blogwings_companion_load_plugin');
function blogwings_companion_load_plugin() {
	include_once( plugin_dir_path(__FILE__) . 'admin/custom-customizer.php' );
	include_once( plugin_dir_path(__FILE__) . 'admin/color/class-control-color.php' );
	$theme = blogwings_companion_theme_text_domain(); 
	if(in_array("magazina", $theme)){
		blogwings_companion_load_file();
		include_once( plugin_dir_path(__FILE__) . 'magazina/include.php' );
	}
}