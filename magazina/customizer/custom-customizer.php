<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
  
if ( ! function_exists( 'blogwings_companion_customizer_registers' ) ) :
function blogwings_companion_customizer_registers(){
wp_enqueue_style( 'blogwings_companion_custom_customizer_style', BLOGWINGS_COMPANION_PLUGIN_URL . '/magazina/customizer/customizer_styles.css','', BLOGWINGS_COMPANION_VERSION, 'all' );
wp_enqueue_script( 'blogwings_companion_custom_customizer_script', BLOGWINGS_COMPANION_PLUGIN_URL . '/magazina/customizer/js/customizer.js', array("jquery"), '', true  );
}
add_action( 'customize_controls_enqueue_scripts', 'blogwings_companion_customizer_registers' );
endif;