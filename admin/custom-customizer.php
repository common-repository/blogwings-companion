<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Sanitization for textarea field
 */
function blogwings_companion_sanitize_textarea( $input ) {
    global $allowedposttags;
    $output = wp_kses( $input, $allowedposttags );
    return $output;
}
/**
 * Returns a sanitized filepath if it has a valid extension.
 */
function blogwings_companion_sanitize_upload( $upload ) {
    $return = '';
    $fype = wp_check_filetype( $upload );
    if ( $fype["ext"] ) {
        $return = esc_url_raw( $upload );
    }
    return $return;
}
function blogwings_companion_textarea_html( $input ) {
    $output = esc_html( $input );
    return $output;
}
function blogwings_companion_sanitize_text( $string ) {
    return wp_kses_post( balanceTags( $string ) );
}
function blogwings_companion_hex_color( $color ) {
    if ( '' === $color ) {
        return '';
    }
    // 3 or 6 hex digits, or the empty string.
    if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
        return $color;
    }
}
function blogwings_companion_sanitize_checkbox( $input ) {
    if ( $input == 1 ){
        return 1;
    }else{
        return 0;
    }
}
/**
 * Color sanitization callback
 *
 * @since 1.2.1
 */
function blogwings_sanitize_color( $color ) {
    if ( empty( $color ) || is_array( $color ) ) {
        return '';
    }

    // If string does not start with 'rgba', then treat as hex.
    // sanitize the hex color and finally convert hex to rgba
    if ( false === strpos( $color, 'rgba' ) ) {
        return sanitize_hex_color( $color );
    }

    // By now we know the string is formatted as an rgba color so we need to further sanitize it.
    $color = str_replace( ' ', '', $color );
    sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );

    return 'rgba('.$red.','.$green.','.$blue.','.$alpha.')';
}
/**
 * vaild int.
 */
function blogwings_companion_sanitize_int( $input ) {
$return = absint($input);
    return $return;
}
function blogwings_companion_checkbox( $values ) {
$multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;
    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

// hexa color

function blogwings_companion_sanitize_hex_rgba_color($color){
    // 3 or 6 hex digits, or the empty string.
    if ( sanitize_hex_color($color) ) {
        return $color;
    } elseif(preg_match('/\A^rgba\(([0]*[0-9]{1,2}|[1][0-9]{2}|[2][0-4][0-9]|[2][5][0-5])\s*,\s*([0]*[0-9]{1,2}|[1][0-9]{2}|[2][0-4][0-9]|[2][5][0-5])\s*,\s*([0]*[0-9]{1,2}|[1][0-9]{2}|[2][0-4][0-9]|[2][5][0-5])\s*,\s*([0-9]*\.?[0-9]+)\)$\z/im', $color) > 0){

        return $color;

    }
}
function blogwings_companion_customize_register( $wp_customize ) {
/**
 * Multiple checkbox customize control class.
 *
 * @since  1.0.0
 * @access public
 */
class Blogwings_Companion_Checkbox_Multiple extends WP_Customize_Control {


    /**
     * The type of customize control being rendered.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $type = 'checkbox-multiple';

    /**
     * Enqueue scripts/styles.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function enqueue() {
       
    }

    /**
     * Displays the control content.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function render_content() {

        if ( empty( $this->choices ) ){
            return;   }
            ?>
      

        <?php if ( !empty( $this->label ) ) : ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php endif; ?>
        <?php if ( !empty( $this->description ) ) : ?>
            <span class="description customize-control-description"><?php echo $this->description; ?></span>
        <?php endif; ?>
        <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>
        <ul>
            <?php foreach ( $this->choices as $value => $label ) : ?>

                <li>
                    <label>
                        <input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> /> 
                        <?php echo esc_html( $label ); ?>
                    </label>
                </li>
            <?php endforeach; ?>
        </ul>
        <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
    <?php }
}
    
class Blogwings_Companion_Misc_Control extends WP_Customize_Control{
    public function render_content() {
        switch ( $this->type ) {
            default:

            case 'heading':
                echo '<span class="blogwings customize-control-title">' . $this->title . '</span>';
                break;

            case 'custom_message' :
                echo '<p class="blogwings description">' . $this->description . '</p>';
                break;

            case 'hr' :
                echo '<hr />';
                break;
        }
    }
}


class Blogwings_Companion_Break_Misc_Control extends WP_Customize_Control {

    /**
     * Render the control's content.
     *
     * Allows the content to be overriden without having to rewrite the wrapper.
     *
     * @since   1.0.0
     * @return  void
     */
    public function render_content() {

        switch ( $this->type ) {

            case 'content' :
                if ( isset( $this->input_attrs['divider'] ) ) {
                    echo '<hr>';
                }
                if ( isset( $this->label ) ) {
                    echo '<span class="customize-control-title">' . $this->label . '</span>';
                }


                if ( isset( $this->input_attrs['content'] ) ) {
                    echo $this->input_attrs['content'];
                }

                if ( isset( $this->description ) ) {
                    echo '<span class="description customize-control-description">' . $this->description . '</span>';
                }

               

                break;

            case 'divider' :
                echo '<hr>';
                break;

        }

    }

}

// display-text
if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return null;
}

/**
 * A customizer control to display text in customizer.
 *
 */
class Blogwings_Companion_Display_Text extends WP_Customize_Control {


    /**
     * Control id
     *
     * @var string $id Control id.
     */
    public $id = '';

    /**
     * Button class.
     *
     * @var mixed|string
     */
    public $button_class = '';

    /**
     * Icon class.
     *
     * @var mixed|string
     */
    public $icon_class = '';

    /**
     * Button text.
     *
     * @var mixed|string
     */
    public $button_text = '';

    /**
     * Hestia_Display_Text constructor.
     *
     * @param WP_Customize_Manager $manager Customizer manager.
     * @param string               $id Control id.
     * @param array                $args Argument.
     */
    public function __construct( $manager, $id, $args = array() ) {
        parent::__construct( $manager, $id, $args );
        $this->id = $id;
        if ( ! empty( $args['button_class'] ) ) {
            $this->button_class = $args['button_class'];
        }
        if ( ! empty( $args['icon_class'] ) ) {
            $this->icon_class = $args['icon_class'];
        }
        if ( ! empty( $args['button_text'] ) ) {
            $this->button_text = $args['button_text'];
        }
    }

    /**
     * Render content for the control.
     *
     * @since Hestia 1.1.42
     */
    public function render_content() {
        if ( ! empty( $this->button_text ) ) {
            echo '<button type="button" class="button menu-shortcut ' . esc_attr( $this->button_class ) . '" tabindex="0">';
            if ( ! empty( $this->button_class ) ) {
                echo '<span class="dashicons dashicons-format-image" style="margin-right: 10px;margin-top:3PX;
    color:#999;"></span>';
            }
                echo esc_html( $this->button_text );
            echo '</button>';
        }
    }
}
/**
 *widget-redirect
 *
 */
class Blogwings_Companion_Display_Widget extends WP_Customize_Control {


    /**
     * Control id
     *
     * @var string $id Control id.
     */
    public $id = '';

    /**
     * Button class.
     *
     * @var mixed|string
     */
    public $button_class = '';

    /**
     * Icon class.
     *
     * @var mixed|string
     */
    public $icon_class = '';

    /**
     * Button text.
     *
     * @var mixed|string
     */
    public $button_text = '';

    /**
     * Hestia_Display_Text constructor.
     *
     * @param WP_Customize_Manager $manager Customizer manager.
     * @param string               $id Control id.
     * @param array                $args Argument.
     */
    public function __construct( $manager, $id, $args = array() ) {
        parent::__construct( $manager, $id, $args );
        $this->id = $id;
        if ( ! empty( $args['button_class'] ) ) {
            $this->button_class = $args['button_class'];
        }
        if ( ! empty( $args['icon_class'] ) ) {
            $this->icon_class = $args['icon_class'];
        }
        if ( ! empty( $args['button_text'] ) ) {
            $this->button_text = $args['button_text'];
        }
    }

    /**
     * Render content for the control.
     *
     * @since Hestia 1.1.42
     */
    public function render_content() {
        if ( ! empty( $this->button_text ) ) {
            echo '<button type="button" class="button menu-shortcut ' . esc_attr( $this->button_class ) . '" tabindex="0">';
            if ( ! empty( $this->button_class ) ) {
                echo '<span class="dashicons dashicons-admin-generic" style="margin-right: 10px;margin-top:3PX;
    color:#999;"></span>';
            }
                echo esc_html( $this->button_text );
            echo '</button>';
        }
    }
}
class Blogwings_Companion_Sort_List extends WP_Customize_Control {
    /**
     * The type of customize control being rendered.
     */
    public $type = 'sort-list';

    public function enqueue() {
       
    }
    public function render_content() {
          if ( empty( $this->choices ) ){
            return;
               }
            ?>
      <?php if ( !empty( $this->label ) ) : ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php endif; ?>
        <?php if ( !empty( $this->description ) ) : ?>
            <span class="description customize-control-description"><?php echo $this->description; ?></span>
        <?php endif;
        $sort_arr = $myArray = array_filter( $this->value() );

        $default_arr = explode( ',',implode(',',array_keys($this->choices)));
        $new_arr =  array_unique(array_merge($sort_arr,$default_arr));

        $multi_values = (!empty($sort_arr)) ? explode( ',',implode(',',$new_arr )) : explode( ',',implode(',',array_keys($this->choices)));  ?>
        <ul id="sortable">
        <?php foreach ( $multi_values as $value => $label ) :
         ?>
            <li class="ui-state-default" id='<?php echo $label; ?>' ><label><?php echo $this->choices[$label]; ?></label></li>
          <?php endforeach; ?>
        </ul>
                <input type="hidden" <?php $this->link(); ?> value="" />
            <?php }
        }

/**
 *widget-redirect
 *
 */
class Blogwings_Display_Button extends WP_Customize_Control {
    /**
     * Control id
     *
     * @var string $id Control id.
     */
    public $id = '';

    /**
     * Button class.
     *
     * @var mixed|string
     */
    public $button_class = '';

    /**
     * Icon class.
     *
     * @var mixed|string
     */
    public $icon_class = '';

    /**
     * Button text.
     *
     * @var mixed|string
     */
    public $button_text = '';

    /**
     * Hestia_Display_Text constructor.
     *
     * @param WP_Customize_Manager $manager Customizer manager.
     * @param string               $id Control id.
     * @param array                $args Argument.
     */
    public function __construct( $manager, $id, $args = array() ) {
        parent::__construct( $manager, $id, $args );
        $this->id = $id;
        if ( ! empty( $args['button_class'] ) ) {
            $this->button_class = $args['button_class'];
        }
        if ( ! empty( $args['icon_class'] ) ) {
            $this->icon_class = $args['icon_class'];
        }
        if ( ! empty( $args['button_text'] ) ) {
            $this->button_text = $args['button_text'];
        }
    }

    /**
     * Render content for the control.
     *
     * @since Hestia 1.1.42
     */
    public function render_content() {
        if ( ! empty( $this->button_text ) ) {
            echo '<button type="button" class="button menu-shortcut ' . esc_attr( $this->button_class ) . '" tabindex="0">';
            if ( ! empty( $this->button_class ) ) {
                echo '<span class="dashicons dashicons-admin-generic" style="margin-right: 10px;margin-top:3PX;
    color:#999;"></span>';
            }
                echo esc_html( $this->button_text );
            echo '</button>';
        }
    }
}


}
add_action('customize_register','blogwings_companion_customize_register');

function blogwings_companion_enqueue_registers() {
    wp_enqueue_script( 'blogwings_companion_customizer_script', BLOGWINGS_COMPANION_PLUGIN_URL . '/admin/js/customizer.js', array("jquery"), BLOGWINGS_COMPANION_VERSION, true  );
}

function blogwings_companion_customizer_styles() {
    wp_enqueue_style('blogwings_companion_customizer_styles',BLOGWINGS_COMPANION_PLUGIN_URL . '/magazina/customizer/customizer_styles.css');
}

add_action('customize_controls_print_styles','blogwings_companion_customizer_styles');
add_action( 'customize_controls_enqueue_scripts','blogwings_companion_enqueue_registers' );