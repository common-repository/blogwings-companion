<?php
  if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 *  Testimonial Widget
  */
class Blogwings_Companion_Section_Three extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'magazina-section-three',
            'description' => __('Display post in left column along with description and other post in right column','blogwings-companion'));
        parent::__construct('magazina-section-three', __('Add Magazina : Post Style 3','blogwings-companion'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        // widget content
        echo $before_widget;
        $title = isset($instance['title'])?$instance['title']:__('Featured Post','blogwings-companion');
        $ofcate = isset($instance['ofcate']) ? absint($instance['ofcate']) : 0;
        $ofcount = isset($instance['ofcount']) ? absint($instance['ofcount']) : 5;
        $title_bg_color = isset($instance['title_bg_color'])? $instance['title_bg_color']:'#66cda9';
        $title_txt_color = isset($instance['title_txt_color'])? $instance['title_txt_color']:'#fff';
        $args = array(
            'order' => 'DESC',
            'orderby' =>'date',
            'ignore_sticky_posts' => 1,
            'post_type' => 'post',
           // 'meta_key' => '_thumbnail_id',
            'posts_per_page' => $ofcount, 
            'cat' => $ofcate
        );
         if($ofcate != true){
            $args['orderby'] = 'rand';
        }
            $of_posts = new WP_Query($args);
            $catelink = get_category_link( $ofcate ); 
?>
<section id="section_three">
        <div class="inner_wrap">
            <?php if ( $of_posts->have_posts() ) { $count=1; ?>

             <?php  while($of_posts->have_posts()): $of_posts->the_post(); ?>
                <?php if($count<=1){ ?>
                <div class="heading-wrap">
                    <?php if($title!==''){?>
                 <h3 class="title" style="background:<?php echo $title_bg_color;?>; color:<?php echo $title_txt_color;?>"><?php echo $title; ?></h3>
                 <?php } ?>
                 <?php if($ofcate): ?>
                <h3 class="view"><a href="<?php echo esc_url($catelink); ?>"><?php _e('View All','blogwings-companion'); ?></a></h3>
                <?php endif; ?>
               </div>
               <div class="col-content">
                <div class="col-one">
                <div class="post-item">
                    <div class="post-thumb"><a class="clickable" href="<?php the_permalink(); ?>">
                    <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { 
                        the_post_thumbnail( 'blogwings-companion-three-large' );
                         }
                        ?>
                    </a></div>
                    <div class="post-item-content">
                        <span class="cat-links">
                        <?php echo Blogwings_Companion_Customizer_Cate(); ?>
                         </span>
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="entry-meta">
                            <span class="entry-date"><?php the_time( get_option('date_format') ); ?></span>
                            <span class="comments-link"><?php Blogwings_Companion_Comment(); ?></span>
                        </div>
                            <?php the_excerpt(); ?>
                    </div>
                </div>
            </div>
            <div class="col-two">
                <?php } else{ ?>
                <div class="post-item">
                    <div class="post-thumb"><a class="clickable" href="<?php the_permalink(); ?>">
                        <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { 
                        the_post_thumbnail( 'blogwings-companion-three-small' );
                         }
                        ?>
                    </a>
                    </div>
                    <div class="post-item-content">
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="entry-meta">
                            <span class="entry-date"><?php the_time( get_option('date_format') ); ?></span>
                            <span class="comments-link"><?php Blogwings_Companion_Comment(); ?></span>
                        </div>
                    </div>
                </div>
             <?php } $count++; ?>
              <?php endwhile; } wp_reset_postdata(); ?>
            </div> <!-- col-two -->
        </div><!--col-content-->
        </div>
    </section>
<?php
        echo $after_widget;

    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance["ofcate"] = absint($new_instance["ofcate"]);
        $instance['ofcount'] = strip_tags( $new_instance['ofcount'] );
         $instance["title_bg_color"] = $new_instance["title_bg_color"];
        $instance["title_txt_color"] = $new_instance["title_txt_color"];
        return $instance;
    }

    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : __('Featured Post','blogwings-companion');
        $ofcate = isset($instance['ofcate']) ? absint($instance['ofcate']) : 0;
        $ofcount = isset($instance['ofcount']) ? absint($instance['ofcount']) : 5;
        $title_bg_color = isset($instance['title_bg_color']) ? $instance['title_bg_color'] :"#66cda9";
         $title_txt_color = isset($instance['title_txt_color']) ? $instance['title_txt_color'] :"#fff";


$termarr = array('child_of'   => 0);
$terms = get_terms('category' ,$termarr);
$foption = '<option value="0">Random Post</option>';
foreach($terms as $cat) {
    $term_id = $cat->term_id;
    $selected1 = ($ofcate==$term_id)?'selected':'';
$foption .= '<option value="'.$term_id.'" '.$selected1.'>'.$cat->name.'</option>';
}
    ?>
        <div class="clearfix"></div>
         <img src="<?php echo BLOGWINGS_COMPANION_MAGAZINA_STYLE3; ?>" />
    <p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Featured Post Title','blogwings-companion'); ?></label>
    <input name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>"  class="widefat" value="<?php echo $title; ?>" >
    </p>
     <p><label for="<?php echo $this->get_field_id('ofcount'); ?>"><?php _e('Add Number Of Post To Show','elanzalite'); ?></label>
            <input id="<?php echo $this->get_field_id('ofcount'); ?>" name="<?php echo $this->get_field_name('ofcount'); ?>" type="text" value="<?php echo $ofcount; ?>" size="3" /></p>
        <p>
    <p>
    <label for="<?php echo $this->get_field_id('ofcate'); ?>"><?php _e('Select Specific Option To Display Post','blogwings-companion'); ?></label>
        <select name="<?php echo $this->get_field_name('ofcate'); ?>" ><?php echo $foption; ?></select>
    </p>
    <p><label for="<?php echo $this->get_field_id( 'title_bg_color' ); ?>" style="display:block;"><?php _e( 'Title Background Color:','blogwings-companion' ); ?></label> 
    <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'title_bg_color' ); ?>" name="<?php echo $this->get_field_name( 'title_bg_color' ); ?>" type="text" value="<?php echo esc_attr( $title_bg_color ); ?>" />
    </p>
    <p>
     <label for="<?php echo $this->get_field_id( 'title_txt_color' ); ?>" style="display:block;"><?php _e( 'Text Color','blogwings-companion' ); ?></label> 
      <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'title_txt_color' ); ?>" name="<?php echo $this->get_field_name( 'title_txt_color' ); ?>" type="text" value="<?php echo esc_attr( $title_txt_color); ?>" />
        </p>
    
        <?php
    }
}
?>