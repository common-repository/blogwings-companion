<?php
  if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * Post first Widget
*/
class Blogwings_Companion_Section_One extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'magazina-section-one',
            'description' => __('Display post slider in left column and other post in right column','blogwings-companion'));
        parent::__construct('magazina-section-one', __('Add Magazina : Post Style 1','blogwings-companion'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        // widget content
        echo $before_widget;
        $title = isset($instance['title'])?$instance['title']:__('Featured Post Title','blogwings-companion');
        $fcate = isset($instance['fcate']) ? absint($instance['fcate']) : 0;
        $ltcate = isset($instance['ltcate']) ? absint($instance['ltcate']) : 0;
        $fcount = isset($instance['fcount']) ? absint($instance['fcount']) : 4;
        $title_bg_color = isset($instance['title_bg_color'])? $instance['title_bg_color']:'#66cda9';
        $title_txt_color = isset($instance['title_txt_color'])? $instance['title_txt_color']:'#fff';
        

        $args = array(
            'order' => 'DESC',
            'ignore_sticky_posts' => 1,
            'post_type' => 'post',
            'meta_key' => '_thumbnail_id',
            'posts_per_page' => $fcount, 
            'cat' => $fcate
        );
            $featured_posts = new WP_Query($args);

?>
<section id="section_one">
    <h3 class="section-title" style="background:<?php echo $title_bg_color;?>; color:<?php echo $title_txt_color;?>"><?php echo apply_filters('widget_title', $title ); ?></h3>
        <div class="inner_wrap">
        <?php if ( $featured_posts->have_posts() ) { ?>
            <div class="slider">
                <div class="flexslider carousel">
                    <ul class="slides">
<?php  while ($featured_posts->have_posts()): $featured_posts->the_post();
    if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { 
    $imgurl =  get_the_post_thumbnail_url($featured_posts->ID,'blogwings-companion-one-large');
        ?>
            <li class="slide" style="background:url('<?php echo $imgurl; ?>')">
                <a class="clickable" href="<?php the_permalink(); ?>"></a>
                <div class="slide-header"><div class="slide-content">
                    <div class="slide-cat"><span class="cat-links">
                        <?php echo Blogwings_Companion_Customizer_Cate(); ?>
                         </span></div>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="entry-meta">
                        <span class="entry-date"><?php the_time( get_option('date_format') ); ?></span>

                        <span class="comments-link"><?php Blogwings_Companion_Comment(); ?></span>

                    </div>
                    </div>
                </div>
            </li>
<?php } endwhile; ?>
                    </ul>
                </div>
            </div>
<?php } wp_reset_postdata(); ?>
<?php 
$args1 = array(
            'order' => 'DESC',
            'ignore_sticky_posts' => 1,
            'post_type' => 'post',
            'meta_key' => '_thumbnail_id',
            'posts_per_page' => 4, 
            'cat' => $ltcate
        );
$latest_posts = new WP_Query($args1);

if ( $latest_posts->have_posts() ) { ?>
            <div class="slider_widgets">
                <div class="slider_widgets_one">
                    <div class="feature-grid">
                    <?php  while ($latest_posts->have_posts()): $latest_posts->the_post(); ?>
        <div class="post-item one"><a class="clickable" href="<?php the_permalink(); ?>">
            <div class="post-thumb">
<?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { 
         the_post_thumbnail( 'blogwings-companion-one-small' );
        }
    ?>
</div></a>
            <div class="post-item-content">
                <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <div class="entry-meta">
                    <span class="entry-date"><?php the_time( get_option('date_format') ); ?></span>
                    <span class="comments-link"><?php Blogwings_Companion_Comment(); ?></span>
                </div>
            </div>
        </div>
<?php endwhile; ?>
                    </div>
                </div>
            </div>
<?php } wp_reset_postdata(); ?>

    </div>
</section>
<?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance["fcate"] = absint($new_instance["fcate"]);
        $instance["ltcate"] = absint($new_instance["ltcate"]);
        $instance["fcount"] = absint($new_instance["fcount"]);
        $instance["title_bg_color"] = $new_instance["title_bg_color"];
        $instance["title_txt_color"] = $new_instance["title_txt_color"];
        
        return $instance;
    }

    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : __('Featured Post Title','blogwings-companion');
        $fcate = isset($instance['fcate']) ? absint($instance['fcate']) : 0;
        $ltcate = isset($instance['ltcate']) ? absint($instance['ltcate']) : 0;
        $fcount = isset($instance['fcount']) ? absint($instance['fcount']) : 4;
        $title_bg_color = isset($instance['title_bg_color']) ? $instance['title_bg_color'] :"#66cda9";
        $title_txt_color = isset($instance['title_txt_color']) ? $instance['title_txt_color'] :"#fff";
$termarr = array('child_of'   => 0);
$terms = get_terms('category' ,$termarr);
$foption = $ltoption = '';
foreach($terms as $cat) {
    $term_id = $cat->term_id;
    $selected1 = ($fcate==$term_id)?'selected':'';
    $selected2 = ($ltcate==$term_id)?'selected':'';
$foption .= '<option value="'.$term_id.'" '.$selected1.'>'.$cat->name.'</option>';
$ltoption .= '<option value="'.$term_id.'" '.$selected2.'>'.$cat->name.'</option>';
}
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
     <img src="<?php echo BLOGWINGS_COMPANION_MAGAZINA_STYLE1; ?>" />
     <p class="thunk-widget-title">Left Column Slider Setting</p>
    <p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Featured Post Title','blogwings-companion'); ?></label>
    <input name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>"  class="widefat" value="<?php echo $title; ?>" >
    </p>
     <p><label for="<?php echo $this->get_field_id('fcount'); ?>"><?php _e('Add Number Of Post To Show','elanzalite'); ?></label>
            <input id="<?php echo $this->get_field_id('fcount'); ?>" name="<?php echo $this->get_field_name('fcount'); ?>" type="text" value="<?php echo $fcount; ?>" size="3" /></p>
        <p>
    <p>
    <label for="<?php echo $this->get_field_id('fcate'); ?>"><?php _e('Choose Category To Show Post','blogwings-companion'); ?></label>
        <select name="<?php echo $this->get_field_name('fcate'); ?>" ><?php echo $foption; ?></select>
    </p>
     <p><label for="<?php echo $this->get_field_id( 'title_bg_color' ); ?>" style="display:block;"><?php _e( 'Title Background Color:','blogwings-companion' ); ?></label> 
    <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'title_bg_color' ); ?>" name="<?php echo $this->get_field_name( 'title_bg_color' ); ?>" type="text" value="<?php echo esc_attr( $title_bg_color ); ?>" />
    </p>
    

    <p>
     <label for="<?php echo $this->get_field_id( 'title_txt_color' ); ?>" style="display:block;"><?php _e( 'Text Color','blogwings-companion' ); ?></label> 
      <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'title_txt_color' ); ?>" name="<?php echo $this->get_field_name( 'title_txt_color' ); ?>" type="text" value="<?php echo esc_attr( $title_txt_color); ?>" />
        </p>
    <div class='tchr'></div>
         <p class="thunk-widget-title">Right Column Setting</p>
 <p>
    <label for="<?php echo $this->get_field_id('ltcate'); ?>"><?php _e('Choose Category To Show Post','blogwings-companion'); ?></label>
<select name="<?php echo $this->get_field_name('ltcate'); ?>" ><?php echo $ltoption; ?></select>    
    </p>
 
        <?php
    }
}