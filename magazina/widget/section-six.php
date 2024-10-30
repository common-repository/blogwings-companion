<?php
  if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * Post first Widget
*/
class Blogwings_Companion_Section_Six extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'magazina-section-six',
            'description' => __('Display post in Recent, Featured and Random','blogwings-companion'));
        parent::__construct('magazina-section-six', __('Add Magazina : Post Style 6','blogwings-companion'), $widget_ops);
    }
function widget($args, $instance) {
        extract($args);
        // widget content
        echo $before_widget;
        $title = isset($instance['title'])?$instance['title']:__('Featured Post Title','blogwings-companion');
        $lttitle = isset($instance['lttitle']) ? esc_attr($instance['lttitle']) : __('Latest Post Title','blogwings-companion');
        $orderby = isset($instance['orderby']) ?$instance['orderby'] : 'post_date';
        $fcount = isset($instance['fcount']) ? absint($instance['fcount']) : 4;
        $r_title_bg_color = isset($instance['r_title_bg_color'])? $instance['r_title_bg_color']:'#66cda9';
        $r_title_txt_color = isset($instance['r_title_txt_color'])? $instance['r_title_txt_color']:'#fff';
        $args = array(
            'orderby' => $orderby,
            'order' => 'DESC',
            'ignore_sticky_posts' => 1,
            'post_type' => 'post',
            'meta_key' => '_thumbnail_id',
            'posts_per_page' => $fcount, 
        );
        $featured1_posts = new WP_Query($args);
?>     
<section id="section_six">
  <?php if($title!==''){?>
    <h3 class="title" style="background:<?php echo $r_title_bg_color;?>; color:<?php echo $r_title_txt_color;?>"><?php echo $title;?></h3>
    <?php } ?>
     <div class="inner_wrap">
<?php if ( $featured1_posts->have_posts() ) { ?>
<?php  while ($featured1_posts->have_posts()): $featured1_posts->the_post(); ?>
           <div class="post-item"><a class="clickable" href="<?php the_permalink(); ?>">
              <div class="post-thumb">
                <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())){ 
                        the_post_thumbnail( 'blogwings-companion-six-medium' );
                    }
                 ?>
              </div></a>
              <div class="post-item-content">
                <div class="post-item-heading">
                <span class="cat-links">
                        <?php echo Blogwings_Companion_Customizer_Cate(); ?>
                         </span>
                <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </div>
                <div class="entry-meta">
                    <span class="entry-date"><?php the_time( get_option('date_format') ); ?></span>
                    <span class="comments-link"><?php Blogwings_Companion_Comment(); ?></span>
                </div>
            </div>
            </div> 
      <?php endwhile; ?>
<?php } wp_reset_postdata(); ?>

        </div>
</section>
<?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance["fcount"] = absint($new_instance["fcount"]);
        $instance["orderby"] = $new_instance["orderby"];
        $instance["r_title_bg_color"] = $new_instance["r_title_bg_color"];
        $instance["r_title_txt_color"] = $new_instance["r_title_txt_color"];
        return $instance;
    }
    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : __('Featured Post Title','blogwings-companion');
        $fcount = isset($instance['fcount']) ? absint($instance['fcount']) : 4;
        $orderby = isset($instance['orderby']) ? $instance['orderby']: 'post_date';
        $r_title_bg_color = isset($instance['r_title_bg_color']) ? $instance['r_title_bg_color'] :"#66cda9";
        $r_title_txt_color = isset($instance['r_title_txt_color']) ? $instance['r_title_txt_color'] :"#fff";
?>
    <style>
    .thunk-widget-title{
     background: #d9e8e9;
    padding: 6px;
    text-align: center;
    border-radius: 1px;
}
    </style>
     <div class="clearfix"></div>
     <img src="<?php echo BLOGWINGS_COMPANION_MAGAZINA_STYLE6; ?>" />
    <p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Featured Post Title','blogwings-companion'); ?></label>
    <input name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>"  class="widefat" value="<?php echo $title; ?>" >
    </p>

     <p><label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Show Post Orderby','blogwings-companion'); ?></label>
         <select id ="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" >
                <option value="post_date" <?php if($orderby=='post_date') 'selected'; ?>> <?php _e('Recent Posts','blogwings-companion'); ?></option>
                <!-- <option value="featured" <?php if($orderby=='featured') 'selected'; ?>> <?php _e('Featured Post','blogwings-companion'); ?></option> -->
                <option value="comment_count" <?php if($orderby=='comment_count') 'selected'; ?>> <?php _e('Popular Posts','blogwings-companion'); ?></option>
                <option value="rand" <?php if($orderby=='rand') 'selected'; ?>> <?php _e('Random Post','blogwings-companion'); ?></option>

         </select>
            </p>  
  <p><label for="<?php echo $this->get_field_id('fcount'); ?>"><?php _e('Add Number Of Post To Show','elanzalite'); ?></label>
            <input id="<?php echo $this->get_field_id('fcount'); ?>" name="<?php echo $this->get_field_name('fcount'); ?>" type="text" value="<?php echo $fcount; ?>" size="3" /></p>

 <p><label for="<?php echo $this->get_field_id( 'r_title_bg_color' ); ?>" style="display:block;"><?php _e( 'Title Background Color:','blogwings-companion' ); ?></label> 
    <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'r_title_bg_color' ); ?>" name="<?php echo $this->get_field_name( 'r_title_bg_color' ); ?>" type="text" value="<?php echo esc_attr( $r_title_bg_color ); ?>" />
    </p>
  <p>
     <label for="<?php echo $this->get_field_id( 'r_title_txt_color' ); ?>" style="display:block;"><?php _e( 'Text Color','blogwings-companion' ); ?></label> 
      <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'r_title_txt_color' ); ?>" name="<?php echo $this->get_field_name( 'r_title_txt_color' ); ?>" type="text" value="<?php echo esc_attr( $r_title_txt_color); ?>" />
  </p>

        <?php
    }
}