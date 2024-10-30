<?php
  if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 *  Testimonial Widget
  */
class Blogwings_Companion_Section_Seven extends WP_Widget{
    function __construct() {
        $widget_ops = array('classname' => 'magazina-section-seven',
            'description' => __('Best suited for sidebar and footer widget area.','blogwings-companion'));
        parent::__construct('magazina-section-seven', __('Add Magazina : Sidebar Post Style','blogwings-companion'), $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        // widget content
        echo $before_widget;
        $wdtitle = isset($instance['wdtitle'])?$instance['wdtitle']:__('Widget Title','blogwings-companion');
        $one_cate = isset($instance['one_cate']) ? absint($instance['one_cate']) : 0;
        $one_count = isset($instance['one_count']) ? absint($instance['one_count']) : 3;
        $args = array(
            'order' => 'DESC',
            'orderby' =>'date',
            'ignore_sticky_posts' => 1,
            'post_type' => 'post',
           // 'meta_key' => '_thumbnail_id',
            'posts_per_page' => $one_count, 
            'cat' => $one_cate
        );
        if($one_cate != true){
            $args['orderby'] = 'rand';
        }
            $one_posts = new WP_Query($args);
?>
<h4 class="widgettitle">
    <?php echo $wdtitle ?></h4>
            <div class="sidebar-tip"></div>
<section id="section_seven">
        <div class="inner_wrap">
            <div class="col-one">
        <?php if ( $one_posts->have_posts() ) { $count=1; ?>
             <?php  while($one_posts->have_posts()): $one_posts->the_post();
              ?>
                <?php if($count<=1){ ?>

                <div class="post-item">
                    <div class="post-thumb"><a href="<?php the_permalink(); ?>"><?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { 
                        the_post_thumbnail( 'blogwings-companion-seven-sidebar' );
                         }
                        ?></a></div>
                    <div class="post-item-content">
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="entry-meta">
                            <span class="entry-date"><?php the_time( get_option('date_format') ); ?></span>
                            <span class="comments-link"><?php Blogwings_Companion_Comment(); ?></span>
                        </div>
                         <?php the_excerpt(); ?>
                    </div>
                </div>
                <ul class="feat-cat_small_list">
                <?php } else{ ?>
                    <li>
                        <div class="post-item">
                            
                            <div class="post-thumb"><a href="<?php the_permalink(); ?>">
                            <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { 
                        the_post_thumbnail( 'blogwings-companion-five-small' );
                         }
                        ?></a></div>
                            <div class="post-item-content">
                                <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="entry-meta">
                                    <span class="entry-date"><?php the_time( get_option('date_format') ); ?></span>
                                    <span class="comments-link"><?php Blogwings_Companion_Comment(); ?></span>
                                </div>
                            </div>
                            
                        </div>
                    </li>

                 <?php } $count++; ?>
              <?php endwhile; } wp_reset_postdata(); ?> 
            </div>
        </div>
    </section>
<?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['wdtitle'] = strip_tags( $new_instance['wdtitle'] );
        $instance["one_cate"] = absint($new_instance["one_cate"]);
        $instance['one_count'] = strip_tags( $new_instance['one_count'] );
        return $instance;
    }
    function form($instance){
        $wdtitle = isset($instance['wdtitle']) ? esc_attr($instance['wdtitle']) : __('Widget Title','blogwings-companion');
        $one_cate = isset($instance['one_cate']) ? absint($instance['one_cate']) : 0;
        $one_count = isset($instance['one_count']) ? absint($instance['one_count']) : 3; 

$termarr = array('child_of'   => 0);
$terms = get_terms('category' ,$termarr);
$oneoption  = '<option value="0">Random Post</option>';

foreach($terms as $cat) {
    $term_id = $cat->term_id;
    $selected1 = ($one_cate==$term_id)?'selected':'';
$oneoption .= '<option value="'.$term_id.'" '.$selected1.'>'.$cat->name.'</option>';
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
    <img src="<?php echo BLOGWINGS_COMPANION_MAGAZINA_STYLE7; ?>" />
    <p class="thunk-widget-title">Blog Setting</p>
    <p>
    <label for="<?php echo $this->get_field_id('wdtitle'); ?>"><?php _e('Widget Title','blogwings-companion'); ?></label>
    <input name="<?php echo $this->get_field_name('wdtitle'); ?>" id="<?php echo $this->get_field_id('wdtitle'); ?>"  class="widefat" value="<?php echo $wdtitle; ?>" >
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('one_cate'); ?>"><?php _e('Select Specific Option To Display Post','blogwings-companion'); ?></label>
        <select name="<?php echo $this->get_field_name('one_cate'); ?>" ><?php echo $oneoption; ?></select>
    </p>
    <p><label for="<?php echo $this->get_field_id('one_count'); ?>"><?php _e('Add Number Of Post To Show','blogwings-companion'); ?></label>
            <input id="<?php echo $this->get_field_id('one_count'); ?>" name="<?php echo $this->get_field_name('one_count'); ?>" type="text" value="<?php echo $one_count; ?>" size="3" /></p>
        <?php
    }
}
?>