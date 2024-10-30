<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function blogwings_companion_magazina_customize_register( $wp_customize ) {
$wp_customize->register_control_type( 'Blogwings_Companion_Color_Control' ); 
// *****************************
// Theme Option
// ******************************
$wp_customize->add_panel( 'magazina_theme_options', array(
        'priority'       => 4,
        'title'          => __('Appearance Settings', 'blogwings-companion'),
) ); 
$wp_customize->get_section('colors')->title = esc_html__('Body Background Color', 'blogwings-companion');
 $wp_customize->get_section('colors')->priority = 60;
 $wp_customize->get_section('colors')->panel ='magazina_theme_options';
 // custom background
$wp_customize->add_section( 'background_image', array(
  'title'          => __( 'Body Background Image', 'blogwings-companion' ),
  'theme_supports' => 'custom-background',
  'priority'       => 80,
  'panel'         =>'magazina_theme_options',
  
) );
$wp_customize->add_section( 'header_image', array(
  'title'          => __( 'Header Background Image', 'blogwings-companion' ),
  'theme_supports' => 'custom-header',
  'panel'         =>'magazina_theme_options',
  'priority'       => 40,
  
) );
// title
$wp_customize->add_setting('site_title_color', array(
        'default'        => '#606060',
        'capability'     => 'edit_theme_options', 
        
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'site_title_color', 
    array(
    'label' => __('Site Title Color','blogwings-companion'),
        'section'    => 'title_tagline',
        'settings'   => 'site_title_color',
) ) );
//*****************************************//             
// site-color
//*****************************************//           
$wp_customize->add_section('site_color', array(
        'title'    => __('Global Color', 'blogwings-companion'),
        'priority' => 1,
        'panel'  => 'magazina_theme_options',
));
$wp_customize->add_setting('theme_color', array(
        'default'        => '#66cda9',
        'capability'     => 'edit_theme_options',
        
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'theme_color', 
    array(
        'label'      => __( 'Theme Color', 'blogwings-companion' ),
        'section'    => 'site_color',
        'settings'   => 'theme_color',
    ) ) );
    
//****************************************//
// custom  script
//****************************************//
$wp_customize->add_section('custom_script_option', array(
        'title'    => __('Custom Script', 'magazina'),
        'priority' => 10,
    ));
$wp_customize->add_setting('header_script', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'blogwings_companion_sanitize_textarea',
    ));
$wp_customize->add_control('header_script', array(
        'settings'    => 'header_script',
        'label'       => esc_html__('Header Script', 'magazina'),
        'description' => esc_html__('The following code will add to the <head> tag.
( Useful if you need to add additional scripts such as CSS or JS. )', 'magazina'),
        'section'     => 'custom_script_option',
        'type'        => 'textarea',
    ) );
$wp_customize->add_setting('footer_script', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'blogwings_companion_sanitize_textarea',
    ));
$wp_customize->add_control('footer_script', array(
        'settings'=> 'footer_script',
        'label'   => esc_html__('Footer Script', 'magazina'),
        'description' => esc_html__('The following code will be added to the footer before the closing </body> tag.
( Useful if you need to Javascript or tracking code. )', 'magazina'),
        'section' => 'custom_script_option',
        'type'    => 'textarea',
    ) );
//****************************************//
// footer otpion   
//****************************************//
 $wp_customize->add_section('footer_option', array(
        'title'    => __('Footer Option', 'magazina'),
        'priority' => 5,
    ));
  $wp_customize->add_setting(
            'magzina_footer_tabs', array(
            'sanitize_callback' => 'sanitize_text_field',
    )
    );
    if ( class_exists('Blogwings_Companion_Control_Tabs')){
    $wp_customize->add_control(
            new Blogwings_Companion_Control_Tabs(
                $wp_customize, 'magzina_footer_tabs', array(
                    'section' => 'footer_option',
                    'tabs'    => array(
                        'general'    => array(
                            'nicename' => esc_html__( 'Setting', 'blogwings-companion' ),
                            'controls' => array(
                                  'copyright_textbox', 
                                  'copytxt_desc',
                                  'widget_redirect1', 
                            ),
                        ),
                        'style' => array(
                            'nicename' => esc_html__( 'Style', 'blogwings-companion' ),
                            'controls' => array(
                            'ftr_bg_color',
                            'ftr_wgt_tl_color',
                            'ftr_wgt_txt_color',
                            'ftr_wgt_link_color',
                            'ftr_cpybg_color',
                            'copy_txt_color',
                            'social_icon_color',
                            ),
                        ),
                    ),
                )
            )
        );
}
   $wp_customize->add_setting('copytxt_desc', array(
        'sanitize_callback' => 'blogwings_companion_sanitize_text',
    ));
   $wp_customize->add_control( new Blogwings_Companion_Misc_Control( $wp_customize, 'copytxt_desc',
            array(
        'section'     => 'footer_option',
        'type'        => 'custom_message',
        'description' => wp_kses_post( 'For adding widgets in footer area. Navigate to widgets and Choose desired widgets from widget area.','blogwings-companion' )
   )));
   // widget-redirect
if (class_exists('Blogwings_Display_Button')){ 
$wp_customize->add_setting(
            'widget_redirect1', array(
            'sanitize_callback' => 'sanitize_text_field',
            )
        );
 $wp_customize->add_control(
            new Blogwings_Display_Button(
            $wp_customize, 'widget_redirect1', array(
            'section'      => 'footer_option',
            'button_text'  => esc_html__( 'Go to Widget', 'blogwings-companion' ),
            'button_class' => 'focus-customizer-widget-redirect',
                )
            )
        );
}    
    $wp_customize->add_setting('copyright_textbox', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('copyright_textbox', array(
        'settings'=> 'copyright_textbox',
        'label'   => esc_html__('Copyright Text', 'magazina'),
        'section' => 'footer_option',
        'type'    => 'text',
    ) );
//  =============================
//  = Social Settings       =
//  =============================
 $wp_customize->add_section('social_option', array(
        'title'    => __('Social Icon', 'magazina'),
        'priority' => 5,
    ));
  $wp_customize->add_setting(
            'magzina_social_tabs', array(
            'sanitize_callback' => 'sanitize_text_field',
    )
    );
    if ( class_exists('Blogwings_Companion_Control_Tabs')){
    $wp_customize->add_control(
            new Blogwings_Companion_Control_Tabs(
                $wp_customize, 'magzina_social_tabs', array(
                    'section' => 'social_option',
                    'tabs'    => array(
                        'general'    => array(
                            'nicename' => esc_html__( 'Setting', 'blogwings-companion' ),
                            'controls' => array(
                                   'social_icon_desc',
                                  'f_link',
                                  'g_link',
                                  'l_link',
                                  'p_link',
                                  't_link',   
                            ),
                        ),
                        'style' => array(
                            'nicename' => esc_html__( 'Style', 'blogwings-companion' ),
                            'controls' => array(
                            'social_icon_color',
                            ),
                        ),
                    ),
                )
            )
        );
}   

$wp_customize->add_setting('social_icon_desc', array(
        'sanitize_callback' => 'blogwings_companion_sanitize_text',
    ));
$wp_customize->add_control( new Blogwings_Companion_Misc_Control( $wp_customize, 'social_icon_desc',
            array(
        'section'  => 'social_option',
        'type'        => 'custom_message',
        'description' => wp_kses_post( 'Social icons will be shown in Footer area as well as on the Top Header.','blogwings-companion' )
 )));
    //= social Options = facebook
     $wp_customize->add_setting('f_link', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('f_link', array(
        'settings' => 'f_link',
        'label'   => esc_html__('Facebook Link:','magazina'),
        'section' => 'social_option',
        'type'    => 'text',
    )  );
    //google icon
      $wp_customize->add_setting('g_link', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('g_link', array(
        'settings' => 'g_link',
        'label'   => esc_html__('Google Link:','magazina'),
        'section' => 'social_option',
        'type'    => 'text',
    )  );
    //linkdin icon
      $wp_customize->add_setting('l_link', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('l_link', array(
        'settings' => 'l_link',
        'label'   => esc_html__('Linkedin Link:','magazina'),
        'section' => 'social_option',
        'type'    => 'text',
    )  );
    //pintrest
      $wp_customize->add_setting('p_link', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('p_link', array(
        'settings' => 'p_link',
        'label'   => esc_html__('Pinterest Link:','magazina'),
        'section' => 'social_option',
        'type'    => 'text',
    )  );
    //twitter
     $wp_customize->add_setting('t_link', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('t_link', array(
        'settings' => 't_link',
        'label'   => esc_html__('Twitter Link:','magazina'),
        'section' => 'social_option',
        'type'    => 'text',
    )); 
    // social icon color
 $wp_customize->add_setting('social_icon_color', array(
        'default'        => '#8224e3',
        'capability'     => 'edit_theme_options',
        
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'social_icon_color', 
    array(
        'label'      => __( 'Icon color', 'blogwings-companion' ),
        'section'    => 'social_option',
        'settings'   => 'social_icon_color',
    ) ) );   
// footer-bg     
 $wp_customize->add_setting('ftr_bg_color',
        array(
            'default'     => '#111',
            'type'        => 'theme_mod',
            'capability'  => 'edit_theme_options',
            
        ) );

$wp_customize->add_control(
        new Blogwings_Companion_Color_Control($wp_customize,
            'ftr_bg_color',
            array(
                'label'     => __('Footer Widget Background Color','blogwings-companion'),
                'section'   => 'footer_option',
                'settings'  => 'ftr_bg_color',
            )
        )
    );   
$wp_customize->add_setting('ftr_wgt_tl_color', array(
        'default'        => '#5a5d5a',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'blogwings_sanitize_color',
        
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'ftr_wgt_tl_color', 
    array(
        'label'      => __( 'Footer Widget Title Color', 'blogwings-companion' ),
        'section'    => 'footer_option',
        'settings'   => 'ftr_wgt_tl_color',
    ) ) );
    $wp_customize->add_setting('ftr_wgt_txt_color', array(
        'default'        => '#666',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'blogwings_sanitize_color',
        
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'ftr_wgt_txt_color', 
    array(
        'label'      => __( 'Footer Widget Text Color', 'blogwings-companion' ),
        'section'    => 'footer_option',
        'settings'   => 'ftr_wgt_txt_color',
    ) ) );
    $wp_customize->add_setting('ftr_wgt_link_color', array(
        'default'        => '#666',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'blogwings_sanitize_color',
        
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'ftr_wgt_link_color', 
    array(
        'label'      => __( 'Footer Widget Link Color', 'blogwings-companion' ),
        'section'    => 'footer_option',
        'settings'   => 'ftr_wgt_link_color',
    ) ) );
    // copyright Background
 $wp_customize->add_setting('ftr_cpybg_color',
        array(
            'default'     => '#111',
            'type'        => 'theme_mod',
            'capability'  => 'edit_theme_options',
            'sanitize_callback' => 'blogwings_sanitize_color',
        ) );

$wp_customize->add_control(
        new Blogwings_Companion_Color_Control($wp_customize,
            'ftr_cpybg_color',
            array(
                'label'     => __('Footer Copyright Background Color','blogwings-companion'),
                'section'   => 'footer_option',
                'settings'  => 'ftr_cpybg_color',
            )
        )
    );    
// copyright color
$wp_customize->add_setting('copy_txt_color', array(
        'default'        => '#ddd',
        'capability'     => 'edit_theme_options',
        
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'copy_txt_color', 
    array(
        'label'      => __( 'Footer Copyright Text Color', 'blogwings-companion' ),
        'section'    => 'footer_option',
        'settings'   => 'copy_txt_color',
    ) ) );
  

//  =============================
//  = Header Option =
//  =============================
$wp_customize->add_section('magzina_header_option', array(
            'title'    => __('Header Option', 'blogwings-companion'),
            'priority' => 4,
)); 
$wp_customize->add_setting(
            'magzina_header_tabs', array(
            'sanitize_callback' => 'sanitize_text_field',
    )
);
if ( class_exists('Blogwings_Companion_Control_Tabs')){
 $wp_customize->add_control(
            new Blogwings_Companion_Control_Tabs(
                $wp_customize, 'magzina_header_tabs', array(
                    'section' => 'magzina_header_option',
                    'tabs'    => array(
                        'general'    => array(
                            'nicename' => esc_html__( 'Setting', 'blogwings-companion' ),
                            'controls' => array(
                                'more_grd_lyt_11',
                                'menu_redirect1',
                                'top_hdr_active',
                                'header_fixed_disable',  
                            ),
                        ),
                        'style' => array(
                            'nicename' => esc_html__( 'Style', 'blogwings-companion' ),
                            'controls' => array(
                            'top_header_color',
                            'top_hd_bg_color',
                            'top_date_clr',
                            'top_menu_clr',
                            'top_icon_clr',
                            'header_color',
                            'hd_bg_color',
                            'hd_bg_shr_color',
                            'hd_menu_color',
                            'hd_menu_hvr_color',
                            'mobile_menu_bg_color',
                            ),
                        ),
                    ),
                )
            )
        );
}
//  =============================
//  =Header Settings =
//  =============================
$wp_customize->add_setting('more_grd_lyt_11', array(
        'sanitize_callback' => 'blogwings_companion_sanitize_text',
    ));
$wp_customize->add_control( new Blogwings_Companion_Misc_Control( $wp_customize, 'more_grd_lyt_11',
            array(
        'section'  => 'magzina_header_option',
        'type'        => 'custom_message',
        'description' => wp_kses_post( 'First create a menu for showing your top header','blogwings-companion' )
 )));
// widget-redirect
if (class_exists('Blogwings_Display_Button')){ 
$wp_customize->add_setting(
            'menu_redirect1', array(
            'sanitize_callback' => 'sanitize_text_field',
            )
        );
 $wp_customize->add_control(
            new Blogwings_Display_Button(
            $wp_customize, 'menu_redirect1', array(
            'section'      => 'magzina_header_option',
            'button_text'  => esc_html__( 'Go to Menu', 'blogwings-companion' ),
            'button_class' => 'focus-customizer-menu-redirect',
                )
            )
        );
}      

$wp_customize->add_setting( 'top_hdr_active',
              array(
            'sanitize_callback' => 'blogwings_companion_sanitize_checkbox',
            'default'           => '1',
                )
            );
$wp_customize->add_control( 'top_hdr_active',
                array(
                'type'        => 'checkbox',
                'label'       => esc_html__('Top Header Hide', 'blogwings-companion'),
                'section'     => 'magzina_header_option',
                'description' => esc_html__('(Check here to Disable Top Header)', 'blogwings-companion')
                )
            );
//fixed header
$wp_customize->add_setting( 'header_fixed_disable',
              array(
            'sanitize_callback' => 'blogwings_companion_sanitize_checkbox',
            'default'           => '',
                )
            );
$wp_customize->add_control( 'header_fixed_disable',
                array(
                'type'        => 'checkbox',
                'label'       => esc_html__('Disable Fixed Header ?', 'blogwings-companion'),
                'section'     => 'magzina_header_option',
                'description' => esc_html__('(check here to disable fixed header)', 'blogwings-companion')
                )
            );
 // TOP header-bg-color
$wp_customize->add_setting('top_header_color', array(
        'sanitize_callback' => 'blogwings_companion_sanitize_text',
    ));
$wp_customize->add_control( new Blogwings_Companion_Misc_Control( $wp_customize, 'top_header_color',
            array(
        'section'  => 'magzina_header_option',
        'type'        => 'custom_message',
        'description' => wp_kses_post( 'Top Header Color','blogwings-companion' )
 )));
$wp_customize->add_setting('top_hd_bg_color',
        array(
            'default'     => '#0e0e0e',
            'type'        => 'theme_mod',
            'capability'  => 'edit_theme_options',
            'sanitize_callback' => 'blogwings_sanitize_color',
            
        ) );

$wp_customize->add_control(
        new Blogwings_Companion_Color_Control($wp_customize,
            'top_hd_bg_color',
            array(
                'label'     => __('Background Color','blogwings-companion'),
                'section'   => 'magzina_header_option',
                'settings'  => 'top_hd_bg_color',
            )
        )
    ); 
$wp_customize->add_setting('top_date_clr', array(
        'default'        => '#fff',
        'capability'     => 'edit_theme_options', 
        
    ));
$wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'top_date_clr', 
    array(
    'label' => __('Date Color','blogwings-companion'),
        'section'    => 'magzina_header_option',
        'settings'   => 'top_date_clr',
    ) ) );
$wp_customize->add_setting('top_menu_clr', array(
        'default'        => '#fff',
        'capability'     => 'edit_theme_options', 
        
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'top_menu_clr', 
    array(
    'label' => __('Menu Color','blogwings-companion'),
        'section'    => 'magzina_header_option',
        'settings'   => 'top_menu_clr',
    ) ) ); 

$wp_customize->add_setting('top_icon_clr', array(
        'default'        => '#fff',
        'capability'     => 'edit_theme_options', 
        
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'top_icon_clr', 
    array(
    'label' => __('Search Icon & Menu Icon Color ','blogwings-companion'),
        'section'    => 'magzina_header_option',
        'settings'   => 'top_icon_clr',
    ) ) );
$wp_customize->add_setting('header_color', array(
        'sanitize_callback' => 'blogwings_companion_sanitize_text',
    ));
$wp_customize->add_control( new Blogwings_Companion_Misc_Control( $wp_customize, 'header_color',
            array(
        'section'  => 'magzina_header_option',
        'type'        => 'custom_message',
        'description' => wp_kses_post( 'Header Color','blogwings-companion' )
 )));      
//  =============================
//  = Header color
//  =============================

$wp_customize->add_setting('hd_bg_color',
        array(
            'default'     => '#fff',
            'type'        => 'theme_mod',
            'capability'  => 'edit_theme_options',
            'sanitize_callback' => 'blogwings_sanitize_color',
            
        ) );

$wp_customize->add_control(
        new Blogwings_Companion_Color_Control($wp_customize,
            'hd_bg_color',
            array(
                'label'     => __('Header Background Color','blogwings-companion'),
                'section'   => 'magzina_header_option',
                'settings'  => 'hd_bg_color',

            )
        )
    );
// header-bg-shrink-color
$wp_customize->add_setting('hd_bg_shr_color',
        array(
            'default'     => 'rgba(255, 255, 255, 0.95)',
            'type'        => 'theme_mod',
            'capability'  => 'edit_theme_options',
            'sanitize_callback' => 'blogwings_sanitize_color',
            
        ) );

$wp_customize->add_control(
        new Blogwings_Companion_Color_Control($wp_customize,
            'hd_bg_shr_color',
            array(
                'label'     => __('Header Shrink Background Color','blogwings-companion'),
                'section'   => 'magzina_header_option',
                'settings'  => 'hd_bg_shr_color',
            )
        )
    );    

// menu   
$wp_customize->add_setting('hd_menu_color', array(
        'default'        => '#606060',
        'capability'     => 'edit_theme_options',  
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'hd_menu_color', 
    array(
    'label' => __('Menu Link Color','blogwings-companion'),
        'section'    => 'magzina_header_option',
        'settings'   => 'hd_menu_color',
    ) ) );
  // hover 
$wp_customize->add_setting('hd_menu_hvr_color', array(
        'default'        => '#66cdaa',
        'capability'     => 'edit_theme_options',      
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'hd_menu_hvr_color', 
    array(
    'label' => __('Menu Link Hover/Active Color','blogwings-companion'),
        'section'    => 'magzina_header_option',
        'settings'   => 'hd_menu_hvr_color',
    ) ) );
  // responsive menu icon button color 
   $wp_customize->add_setting('mobile_menu_bg_color', array(
        'default'        => '#606060',
        'capability'     => 'edit_theme_options', 
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'mobile_menu_bg_color', 
    array(
    'label' => __('Responsive Menu Icon Color','blogwings-companion'),
        'section'    => 'magzina_header_option',
        'settings'   => 'mobile_menu_bg_color',
) ) );      
/*************************************************************************/

                    //Gloabal-typograpgy//

/**************************************************************************/
$wp_customize->register_control_type( 'Blogwings_Companion_Range_Value_Control' );
$wp_customize->add_panel( 'theme_tygrphy', array(
    'priority'       => 4,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Typography', 'blogwings-companion'),
    'description'    => '',
) );
$wp_customize->add_section(
        'elanzalite_fontsubset_typography', array(
            'title' => esc_html__( 'Font Subsets', 'blogwings-companion' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );
if ( class_exists( 'Blogwings_Companion_Checkbox_Multiple' ) ) {

        $wp_customize->add_setting(
            'themehunk_font_subsets', array(
                'default' => array( 'latin' ),
                'sanitize_callback' => 'blogwings_companion_checkbox_explode',
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Checkbox_Multiple(
                $wp_customize, 'themehunk_font_subsets', array(
                    'section' => 'elanzalite_fontsubset_typography',
                    'label' => esc_html__('Font Subsets', 'blogwings-companion'),
                    'choices' => array(
                        'latin' => 'latin',
                        'latin-ext' => 'latin-ext',
                        'cyrillic' => 'cyrillic',
                        'cyrillic-ext' => 'cyrillic-ext',
                        'greek' => 'greek',
                        'greek-ext' => 'greek-ext',
                        'vietnamese' => 'vietnamese',
                        'arabic' => 'arabic',
                    ),
                    'priority' => 10,
                )
            )
        );
    }
$wp_customize->add_section(
        'elanzalite_typography', array(
            'title' => esc_html__( 'Body', 'blogwings-companion' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );

    if ( class_exists( 'Blogwings_Companion_Font_Selector' ) ) {
        $wp_customize->add_setting(
            'elanzalite_body_font', array(
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Font_Selector(
                $wp_customize, 'elanzalite_body_font', array(
        'label' => esc_html__( 'Font family', 'blogwings-companion' ),
                    'section'           => 'elanzalite_typography',
                    'priority'          => 2,
                    'type'              => 'select',
                )
            )
        );
    }
     if ( class_exists( 'Blogwings_Companion_Range_Value_Control' ) ) {

        $wp_customize->add_setting(
            'elanzalite_body_font_size', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 15,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 20,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );

        // tab
        $wp_customize->add_setting(
            'elanzalite_body_font_size_tb', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 15,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_tb', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 20,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );
         // mob
        $wp_customize->add_setting(
            'elanzalite_body_font_size_mb', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 15,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_mb', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 20,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // line-height
      $wp_customize->add_setting(
            'elanzalite_body_line_height', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 24,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 50,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'elanzalite_body_line_height_tb', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 24,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_tb', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 50,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'elanzalite_body_line_height_mb', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 24,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_mb', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 50,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // letter-spacing
       $wp_customize->add_setting(
            'elanzalite_body_letter_spacing', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_tb', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_tb', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
         //mob
        $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_mb', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_mb', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );

    }
/************************************/   
// H1-typography
/***********************************/
    $wp_customize->add_section(
        'elanzalite_typography_h1', array(
            'title' => esc_html__( 'Heading 1 (H1)', 'blogwings-companion' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );

    if ( class_exists( 'Blogwings_Companion_Font_Selector' ) ) {
        $wp_customize->add_setting(
            'elanzalite_body_font_h1', array(
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Font_Selector(
                $wp_customize, 'elanzalite_body_font_h1', array(
        'label' => esc_html__( 'Font family', 'blogwings-companion' ),
                    'section'           => 'elanzalite_typography_h1',
                    'priority'          => 2,
                    'type'              => 'select',
                )
            )
        );
    }
     if ( class_exists( 'Blogwings_Companion_Range_Value_Control' ) ) {

        $wp_customize->add_setting(
            'elanzalite_body_font_size_h1', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 44,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_h1', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h1',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );

        // tab
        $wp_customize->add_setting(
            'elanzalite_body_font_size_tb_h1', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 44,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_tb_h1', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h1',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );
         // mob
        $wp_customize->add_setting(
            'elanzalite_body_font_size_mb_h1', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 44,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_mb_h1', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h1',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // line-height
      $wp_customize->add_setting(
            'elanzalite_body_line_height_h1', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 55,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_h1', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h1',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'elanzalite_body_line_height_tb_h1', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 55,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_tb_h1', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h1',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'elanzalite_body_line_height_mb_h1', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 55,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_mb_h1', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h1',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // letter-spacing
       $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_h1', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_h1', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h1',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_tb_h1', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_tb_h1', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h1',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
         //mob
        $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_mb_h1', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_mb_h1', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h1',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );

    }
/************************************/   
// H2-typography
/***********************************/
    $wp_customize->add_section(
        'elanzalite_typography_h2', array(
            'title' => esc_html__( 'Heading 2 (H2)', 'blogwings-companion' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );

    if ( class_exists( 'Blogwings_Companion_Font_Selector' ) ) {
        $wp_customize->add_setting(
            'elanzalite_body_font_h2', array(
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Font_Selector(
                $wp_customize, 'elanzalite_body_font_h2', array(
        'label' => esc_html__( 'Font family', 'blogwings-companion' ),
                    'section'           => 'elanzalite_typography_h2',
                    'priority'          => 2,
                    'type'              => 'select',
                )
            )
        );
    }
     if ( class_exists( 'Blogwings_Companion_Range_Value_Control' ) ) {

        $wp_customize->add_setting(
            'elanzalite_body_font_size_h2', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 38,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_h2', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h2',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );

        // tab
        $wp_customize->add_setting(
            'elanzalite_body_font_size_tb_h2', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 38,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_tb_h2', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h2',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );
         // mob
        $wp_customize->add_setting(
            'elanzalite_body_font_size_mb_h2', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 38,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_mb_h2', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h2',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // line-height
      $wp_customize->add_setting(
            'elanzalite_body_line_height_h2', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 48,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_h2', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h2',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'elanzalite_body_line_height_tb_h2', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 48,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_tb_h2', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h2',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'elanzalite_body_line_height_mb_h2', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 48,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_mb_h2', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h2',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // letter-spacing
       $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_h2', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_h2', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h2',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_tb_h2', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_tb_h2', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h2',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
         //mob
        $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_mb_h2', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_mb_h2', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h2',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );

    }
/************************************/   
// H3-typography
/***********************************/
    $wp_customize->add_section(
        'elanzalite_typography_h3', array(
            'title' => esc_html__( 'Heading 3 (H3)', 'blogwings-companion' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );

    if ( class_exists( 'Blogwings_Companion_Font_Selector' ) ) {
        $wp_customize->add_setting(
            'elanzalite_body_font_h3', array(
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Font_Selector(
                $wp_customize, 'elanzalite_body_font_h3', array(
        'label' => esc_html__( 'Font family', 'blogwings-companion' ),
                    'section'           => 'elanzalite_typography_h3',
                    'priority'          => 2,
                    'type'              => 'select',
                )
            )
        );
    }
     if ( class_exists( 'Blogwings_Companion_Range_Value_Control' ) ) {

        $wp_customize->add_setting(
            'elanzalite_body_font_size_h3', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 34,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_h3', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h3',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );

        // tab
        $wp_customize->add_setting(
            'elanzalite_body_font_size_tb_h3', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 34,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_tb_h3', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h3',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );
         // mob
        $wp_customize->add_setting(
            'elanzalite_body_font_size_mb_h3', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 34,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_mb_h3', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h3',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // line-height
      $wp_customize->add_setting(
            'elanzalite_body_line_height_h3', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 44,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_h3', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h3',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'elanzalite_body_line_height_tb_h3', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 44,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_tb_h3', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h3',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'elanzalite_body_line_height_mb_h3', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 44,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_mb_h3', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h3',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // letter-spacing
       $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_h3', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_h3', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h3',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_tb_h3', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_tb_h3', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h3',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
         //mob
        $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_mb_h3', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_mb_h3', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h3',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );

    }    
 /************************************/   
// H4-typography
/***********************************/
    $wp_customize->add_section(
        'elanzalite_typography_h4', array(
            'title' => esc_html__( 'Heading 4 (H4)', 'blogwings-companion' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );

    if ( class_exists( 'Blogwings_Companion_Font_Selector' ) ) {
        $wp_customize->add_setting(
            'elanzalite_body_font_h4', array(
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Font_Selector(
                $wp_customize, 'elanzalite_body_font_h4', array(
        'label' => esc_html__( 'Font family', 'blogwings-companion' ),
                    'section'           => 'elanzalite_typography_h4',
                    'priority'          => 2,
                    'type'              => 'select',
                )
            )
        );
    }
     if ( class_exists( 'Blogwings_Companion_Range_Value_Control' ) ) {

        $wp_customize->add_setting(
            'elanzalite_body_font_size_h4', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 30,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_h4', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h4',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );

        // tab
        $wp_customize->add_setting(
            'elanzalite_body_font_size_tb_h4', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 30,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_tb_h4', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h4',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );
         // mob
        $wp_customize->add_setting(
            'elanzalite_body_font_size_mb_h4', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 30,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_mb_h4', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h4',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // line-height
      $wp_customize->add_setting(
            'elanzalite_body_line_height_h4', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 40,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_h4', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h4',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'elanzalite_body_line_height_tb_h4', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 40,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_tb_h4', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h4',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'elanzalite_body_line_height_mb_h4', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 40,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_mb_h4', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h4',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // letter-spacing
       $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_h4', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_h4', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h4',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_tb_h4', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_tb_h4', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h4',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
         //mob
        $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_mb_h4', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_mb_h4', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h4',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );

    }       
/************************************/   
// H5-typography
/***********************************/
    $wp_customize->add_section(
        'elanzalite_typography_h5', array(
            'title' => esc_html__( 'Heading 5 (H5)', 'blogwings-companion' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );

    if ( class_exists( 'Blogwings_Companion_Font_Selector' ) ) {
        $wp_customize->add_setting(
            'elanzalite_body_font_h5', array(
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Font_Selector(
                $wp_customize, 'elanzalite_body_font_h5', array(
        'label' => esc_html__( 'Font family', 'blogwings-companion' ),
                    'section'           => 'elanzalite_typography_h5',
                    'priority'          => 2,
                    'type'              => 'select',
                )
            )
        );
    }
     if ( class_exists( 'Blogwings_Companion_Range_Value_Control' ) ) {

        $wp_customize->add_setting(
            'elanzalite_body_font_size_h5', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 26,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_h5', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h5',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );

        // tab
        $wp_customize->add_setting(
            'elanzalite_body_font_size_tb_h5', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 26,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_tb_h5', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h5',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );
         // mob
        $wp_customize->add_setting(
            'elanzalite_body_font_size_mb_h5', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 26,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_mb_h5', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h5',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // line-height
      $wp_customize->add_setting(
            'elanzalite_body_line_height_h5', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 36,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_h5', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h5',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'elanzalite_body_line_height_tb_h5', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 36,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_tb_h5', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h5',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'elanzalite_body_line_height_mb_h5', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 36,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_mb_h5', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h5',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // letter-spacing
       $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_h5', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_h5', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h5',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_tb_h5', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_tb_h5', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h5',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
         //mob
        $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_mb_h5', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_mb_h5', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h5',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );

    }       
/************************************/   
// H6-typography
/***********************************/
    $wp_customize->add_section(
        'elanzalite_typography_h6', array(
            'title' => esc_html__( 'Heading 6 (H6)', 'blogwings-companion' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );

    if ( class_exists( 'Blogwings_Companion_Font_Selector' ) ) {
        $wp_customize->add_setting(
            'elanzalite_body_font_h6', array(
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Font_Selector(
                $wp_customize, 'elanzalite_body_font_h6', array(
        'label' => esc_html__( 'Font family', 'blogwings-companion' ),
                    'section'           => 'elanzalite_typography_h6',
                    'priority'          => 2,
                    'type'              => 'select',
                )
            )
        );
    }
     if ( class_exists( 'Blogwings_Companion_Range_Value_Control' ) ) {

        $wp_customize->add_setting(
            'elanzalite_body_font_size_h6', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 22,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_h6', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h6',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );

        // tab
        $wp_customize->add_setting(
            'elanzalite_body_font_size_tb_h6', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 22,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_tb_h6', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h6',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );
         // mob
        $wp_customize->add_setting(
            'elanzalite_body_font_size_mb_h6', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 22,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_font_size_mb_h6', array(
                    'label' => esc_html__( 'Font size', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h6',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // line-height
      $wp_customize->add_setting(
            'elanzalite_body_line_height_h6', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 32,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_h6', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h6',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'elanzalite_body_line_height_tb_h6', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 32,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_tb_h6', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h6',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'elanzalite_body_line_height_mb_h6', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 32,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_line_height_mb_h6', array(
                    'label' => esc_html__( 'Line height', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h6',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // letter-spacing
       $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_h6', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_h6', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h6',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_tb_h6', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_tb_h6', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h6',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
         //mob
        $wp_customize->add_setting(
            'elanzalite_body_letter_spacing_mb_h6', array(
                'sanitize_callback' => 'blogwc_range_value',
                'default' => 0.7,
                
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Range_Value_Control(
                $wp_customize, 'elanzalite_body_letter_spacing_mb_h6', array(
                    'label' => esc_html__( 'Letter-spacing ', 'blogwings-companion' ) . ' ( ' . esc_html__( 'px','blogwings-companion' ) . ' )',
                    'section' => 'elanzalite_typography_h6',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
    }  
/************************************/   
// a-typography
/***********************************/
    $wp_customize->add_section(
        'elanzalite_typography_a', array(
            'title' => esc_html__( 'Anchor Tag (a)', 'blogwings-companion' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );

    if ( class_exists( 'Blogwings_Companion_Font_Selector' ) ) {
        $wp_customize->add_setting(
            'elanzalite_body_font_a', array(
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new Blogwings_Companion_Font_Selector(
                $wp_customize, 'elanzalite_body_font_a', array(
        'label' => esc_html__( 'Font family', 'blogwings-companion' ),
                    'section'           => 'elanzalite_typography_a',
                    'priority'          => 2,
                    'type'              => 'select',
                )
            )
        );
    }

/*********************/   
//magzine template
/*********************/   
  $wp_customize->add_panel( 'elanzalite_magzine', array(
        'priority'       => 3,
        'title'          => __('Magazine Template', 'blogwings-companion'),
    ) ); 
 // magazine-color  
 $wp_customize->add_section('magzine_color_option', array(
        'title'    => __('View All Button & Category Bg Color', 'blogwings-companion'),
        'priority' => 5,
        'panel' => 'elanzalite_magzine',
    ));
// Sidebar settings
$wp_customize->add_section('elanzalite_magzine_layout_section', array(
        'title'    => __('Setting', 'blogwings-companion'),
        'priority' => 1,
        'panel' => 'elanzalite_magzine',
    ));
$wp_customize->add_setting( 'magazina_magzine_layout',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default'           => 'right',
               
              )
         );
$wp_customize->add_control( 'magazina_magzine_layout',
        array(
        'type'        => 'select',
        'label'       => esc_html__('Sidebar Alignment', 'blogwings-companion'),
        'description' => esc_html__('Choose sidebar option for Magazine Template', 'blogwings-companion'),
        'section'     => 'elanzalite_magzine_layout_section',
        'priority' => 100,
        'choices' => array(
        'right' => esc_html__('Right sidebar', 'blogwings-companion'),
        'left' => esc_html__('Left sidebar', 'blogwings-companion'),
                    )
                )
        );
$wp_customize->add_setting( 'magazina_magzine_layout_second',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default'           => 'right',
               
              )
         );
$wp_customize->add_control( 'magazina_magzine_layout_second',
        array(
        'type'        => 'select',
        'label'       => esc_html__('Sidebar Alignment', 'blogwings-companion'),
        'description' => esc_html__('Choose sidebar option for Magazine Template', 'blogwings-companion'),
        'section'     => 'elanzalite_magzine_layout_section',
        'priority' => 100,
        'choices' => array(
        'right' => esc_html__('Right sidebar', 'blogwings-companion'),
        'left' => esc_html__('Left sidebar', 'blogwings-companion'),
                    )
                )
        );
//break 
    $wp_customize->add_setting('mg_view_break_color', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(new Blogwings_Companion_break_Misc_Control(
            $wp_customize,'mg_view_break_color',array(
            'section' => 'magzine_color_option',
            'description' => __( 'View All Button', 'blogwings-companion' ),
            'type' => 'content',
            'input_attrs' => array('divider' => true),
   
             'priority' => 2,
            ))); 

    $wp_customize->add_setting('magzine_vw_bg_color', array(
        'default'        => '#0e0e0e',
        'capability'     => 'edit_theme_options',
        
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'magzine_vw_bg_color', 
    array(
        'label'      => __( 'Background Color', 'blogwings-companion' ),
        'section'    => 'magzine_color_option',
        'settings'   => 'magzine_vw_bg_color',
         'priority' => 3,
    ) ) );
//break 
    $wp_customize->add_setting('mg_cat_break_color', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(new Blogwings_Companion_break_Misc_Control(
            $wp_customize,'mg_cat_break_color',array(
            'section' => 'magzine_color_option',
            'description' => __( 'Category Background Color', 'blogwings-companion' ),
            'type' => 'content',
            'input_attrs' => array('divider' => true),
            'priority' => 4,
            ))); 
    $i = 1;
    $args = array(
        'orderby' => 'id',
        'hide_empty' => 0
    );
    $categories = get_categories( $args );
    $wp_category_list = array();
    foreach ( $categories as $category_list ) {
        $wp_category_list[ $category_list->cat_ID ] = $category_list->cat_name;
        $wp_customize->add_setting( 'magazina_category_color_' . get_cat_id( $wp_category_list[ $category_list->cat_ID ] ), array(
            'default' => '',
            'capability' => 'edit_theme_options',
            
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'magazina_category_color_' . get_cat_id( $wp_category_list[ $category_list->cat_ID ] ), array(
            'label' => sprintf( __( '%s', 'blogwings-companion' ), $wp_category_list[ $category_list->cat_ID ] ),
            'section' => 'magzine_color_option',
            'settings' => 'magazina_category_color_' . get_cat_id( $wp_category_list[ $category_list->cat_ID ] ),
            'priority' => $i,
            'priority' => 5,
        ) ) );
        $i ++;
    }
$wp_customize->add_section('magazine_set_inf_1', array(
            'title'    => __('Magazine Widgets Area with Fullwidth', 'blogwings-companion'),
            'panel'    =>'elanzalite_magzine',
            'priority' => 1,
            ));


$wp_customize->add_setting('magazine_page_desc_1', array(
        'sanitize_callback' => 'blogwings_companion_sanitize_text',
    ));
$wp_customize->add_control( new Blogwings_Companion_Misc_Control( $wp_customize, 'magazine_page_desc_1',
            array(
        'section'  => 'magazine_set_inf_1',
        'active_callback' => 'blogwings_is_not_magazine_page',
        'type'        => 'custom_message',
        'description' => wp_kses_post( 'To customize the Magazine widgets area Page first go to "Dashboard > Page > Template > Magazine Template". Then open the page in the browser and click on customize. After that you will able to see the setting of Magazine widgets area in your customize panel.','blogwings-companion' )
 )));
$wp_customize->add_section('magazine_set_inf_2', array(
            'title'    => __('Magazine Widgets Area with Sidebar', 'blogwings-companion'),
            'panel'    =>'elanzalite_magzine',
            'priority' => 1,
            ));
$wp_customize->add_setting('magazine_set_inf_2', array(
        'sanitize_callback' => 'blogwings_companion_sanitize_text',
    ));
$wp_customize->add_control( new Blogwings_Companion_Misc_Control( $wp_customize, 'magazine_set_inf_2',
            array(
        'section'  => 'magazine_set_inf_2',
        'active_callback' => 'blogwings_is_not_magazine_page',
        'type'        => 'custom_message',
        'description' => wp_kses_post( 'To customize the Magazine widgets area Page first go to "Dashboard > Page > Template > Magazine Template". Then open the page in the browser and click on customize. After that you will able to see the setting of Magazine widgets area in your customize panel.','blogwings-companion' )
 )));

}
add_action('customize_register','blogwings_companion_magazina_customize_register',999);
/**
 * Check if a string is in json format
 * @param  string $string Input.
 *
 * @since 1.1.38
 * @return bool
 */
function blogwings_companion_is_json( $string ) {
    return is_string( $string ) && is_array( json_decode( $string, true ) ) ? true : false;
}
/**
 * Check if is magazine page
 */
function blogwings_is_magazine_page() {
    return is_page_template( 'magazine-template.php' );
}
/**
 * Check if is not magazine page
 */
function blogwings_is_not_magazine_page() {
    return ! is_page_template( 'magazine-template.php' );
}