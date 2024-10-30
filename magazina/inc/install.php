<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// image cropping
add_action( 'init', 'blogwings_companion_magazina_cropping' );

function blogwings_companion_magazina_cropping(){
   add_image_size('blogwings-companion-one-small', 433, 228, true);
   add_image_size('blogwings-companion-one-large', 908, 460, true);
   add_image_size('blogwings-companion-three-small', 165, 110, true);
   add_image_size('blogwings-companion-three-large', 710, 470, true);
   add_image_size('blogwings-companion-four', 445, 280, true);
   add_image_size('blogwings-companion-five-small', 165, 110, true);
   add_image_size('blogwings-companion-five-large', 710, 470, true);
   add_image_size('blogwings-companion-two-small', '', '', true);
   add_image_size('blogwings-companion-six-medium', 320, 500, true);
   add_image_size('blogwings-companion-seven-sidebar', 445, 280, true);
   add_image_size('blogwings-companion-recent-post', 165, 110, true);
}

add_action('widgets_init', 'blogwings_companion_magazina_customizer_widget_init');
function blogwings_companion_magazina_customizer_widget_init() {
    register_sidebar(array(
    'name' => __('Magazine Widgets Area with Fullwidth (First)', 'blogwings-customizer'),
    'id' => 'magazine-widget',
    'description' => __('Add desired magazine post widgets. Widgets added in this area will display in fullwidth. You can also re-order widgets using drag and drop feature.','blogwings-customizer'),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
    ));

    register_sidebar(array(
    'name' => __('Magazine Widgets Area with Sidebar (First)', 'blogwings-customizer'),
    'id' => 'magazine-sidebar-widget',
    'description' => __('Add desired magazine post widgets. Widgets added in this area will display with sidebar. You can also re-order widgets using drag and drop feature.','blogwings-customizer'),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
    ));
    register_sidebar(array(
    'name' => __('Magazine Widgets Area with Fullwidth (Second)', 'blogwings-customizer'),
    'id' => 'magazine-widget-second',
    'description' => __('Add desired magazine post widgets. Widgets added in this area will display in fullwidth. You can also re-order widgets using drag and drop feature.','blogwings-customizer'),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
    ));
    register_sidebar(array(
    'name' => __('Magazine Widgets Area with Sidebar (Second)', 'blogwings-customizer'),
    'id' => 'magazine-sidebar-widget-second',
    'description' => __('Add desired magazine post widgets. Widgets added in this area will display with sidebar. You can also re-order widgets using drag and drop feature.','blogwings-customizer'),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
    ));
    register_sidebar(array(
    'name' => __('Magazine Widgets Area with Fullwidth (Third)', 'blogwings-customizer'),
    'id' => 'magazine-widget-third',
    'description' => __('Add desired magazine post widgets. Widgets added in this area will display in fullwidth. You can also re-order widgets using drag and drop feature.','blogwings-customizer'),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
    ));
    register_widget( 'Blogwings_Companion_RecentPost' );
    register_widget( 'Blogwings_Companion_Section_One' );
    register_widget( 'Blogwings_Companion_Section_Two' );
    register_widget( 'Blogwings_Companion_Section_Three' );
    register_widget( 'Blogwings_Companion_Section_Four' );
    register_widget( 'Blogwings_Companion_Section_Five' );
    register_widget( 'Blogwings_Companion_Section_Six' );
    register_widget( 'Blogwings_Companion_Section_Seven' );
    register_widget( 'Blogwings_Companion_Section_Ads' );
    register_widget( 'Blogwings_Companion_Section_News' );
    register_widget( 'Blogwings_Companion_Aboutme' );
    register_widget( 'Blogwings_Companion_Social' );
}

function Blogwings_Companion_Comment(){
	comments_popup_link(__('0','blogwings-customizer'), __('1','blogwings-customizer'), __('%','blogwings-customizer'));
}
/*
 * Category Color Options
 */
if ( ! function_exists( 'blogwings_companion_magazina_category_color' ) ) :
function blogwings_companion_magazina_category_color( $wp_category_id ) {
   $args = array(
      'orderby' => 'id',
      'hide_empty' => 0
   );
  $category = get_categories( $args );
   foreach ($category as $category_list ) {
      $color = get_theme_mod('magazina_category_color_'.$wp_category_id);
      return $color;
   }
}
endif;
function Blogwings_Companion_Customizer_Cate(){
    $category = get_the_category();
    $return = '';
    foreach($category as $cat)
    {
$return .= "<a style=background:".blogwings_companion_magazina_category_color(get_cat_id($cat->name))."  href='".get_category_link($cat->cat_ID)."' class='{$cat->slug}'>{$cat->name}</a>";
    }

    return $return;
}
function blogwings_companion_magazina_excerpt_length( $length ) {
        return 20;
    }
        add_filter( 'excerpt_length', 'blogwings_companion_magazina_excerpt_length', 28 );

  function blogwings_companion_magazina_excerpt_more($more) {
   return '…';
   }
   add_filter('excerpt_more', 'blogwings_companion_magazina_excerpt_more');

if ( ! function_exists( 'blogwings_companion_magazina_hex2rgba' ) ) :
/*hexa to rgba convert*/
function blogwings_companion_magazina_hex2rgba($color, $opacity = false) {
 
 $default = 'rgb(0,0,0)';
 
 //Return default if no color provided
 if(empty($color)){
          return $default; 
 }
 //Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
         $color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
 
        //Check if opacity is set(rgba or rgb)
        if($opacity){
         if(abs($opacity) > 1){
         $opacity = 1.0;
     }
         $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
         $output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
        return $output;
}
endif;
if(get_theme_mod( 'footer_script','')!=''):
function blogwings_customscript_add_footer(){
$footer_script = get_theme_mod( 'footer_script');
echo "<script type='text/javascript'>".$footer_script."</script>";
}
add_action('wp_footer', 'blogwings_customscript_add_footer');
endif;
if(get_theme_mod('header_script','')!=''):
function blogwings_customscript_add_head(){
$header_script = get_theme_mod( 'header_script');
echo "<script type='text/javascript'>".$header_script."</script>";
}
add_action('wp_head', 'blogwings_customscript_add_head');
endif;
// Include assets
function blogwings_companion_magazina_enqueue_assets() {

 wp_enqueue_style('magazina-css', BLOGWINGS_COMPANION_PLUGIN_URL . "/magazina/assets/css/magzine.css", '', BLOGWINGS_COMPANION_VERSION, 'all');

 wp_enqueue_style('owl-carousel', BLOGWINGS_COMPANION_PLUGIN_URL . "/magazina/assets/css/owl.carousel.css", '', BLOGWINGS_COMPANION_VERSION, 'all');


wp_enqueue_script('flexslider', BLOGWINGS_COMPANION_PLUGIN_URL. 'magazina/assets/js/jquery.flexslider.js', array(), BLOGWINGS_COMPANION_VERSION, true);

wp_enqueue_script('owl-carousel', BLOGWINGS_COMPANION_PLUGIN_URL. 'magazina/assets/js/owl.carousel.js', array(), BLOGWINGS_COMPANION_VERSION, true);

wp_enqueue_script('news-ticker', BLOGWINGS_COMPANION_PLUGIN_URL. 'magazina/assets/js/jquery.easy-ticker.js', array(), BLOGWINGS_COMPANION_VERSION, true);

wp_enqueue_script('mgazina-js', BLOGWINGS_COMPANION_PLUGIN_URL. 'magazina/assets/js/custom.js', array(), BLOGWINGS_COMPANION_VERSION, true);

}
add_action('wp_enqueue_scripts', 'blogwings_companion_magazina_enqueue_assets');

function blogwings_companion_magazina_unlimited_admin_assets() {
    
wp_enqueue_script('magazina_widget_script', BLOGWINGS_COMPANION_PLUGIN_URL. 'magazina/customizer/js/widget.js', array( 'jquery', 'wp-color-picker' ), BLOGWINGS_COMPANION_VERSION, true);
}
add_action('admin_enqueue_scripts', 'blogwings_companion_magazina_unlimited_admin_assets');