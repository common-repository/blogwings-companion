<?php
  if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function blogwings_companion_dummy($section=''){
    if($section=='magazine'){ 
      if ( is_active_sidebar( 'magazine-widget' ) ){
        dynamic_sidebar( 'magazine-widget' );
        }
    }elseif($section=='magazine-sidebar'){ 
      if ( is_active_sidebar( 'magazine-sidebar-widget' ) ){
        dynamic_sidebar( 'magazine-sidebar-widget' );
        }
    }elseif($section=='magazine-widget-second'){ 
      if ( is_active_sidebar( 'magazine-widget-second' ) ){
        dynamic_sidebar( 'magazine-widget-second' );
        }
      }elseif($section=='magazine-sidebar-second'){ 
      if ( is_active_sidebar( 'magazine-sidebar-widget-second' ) ){
        dynamic_sidebar( 'magazine-sidebar-widget-second' );
        }
    }elseif($section=='magazine-widget-third'){ 
      if ( is_active_sidebar( 'magazine-widget-third' ) ){
        dynamic_sidebar( 'magazine-widget-third' );
        }
    }elseif($section=='social-share'){ 
    ?>
      <div class="post-share">
      <span class="share-text"><?php _e('Share:','elanzalite' ); ?></span>
      <ul class="single-social-icon">
        <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i></a></li>
        <li><a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a></li>
        <li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&source=LinkedIn"><i class="fa fa-linkedin"></i></a></li>
        <li><a target="_blank" href="https://twitter.com/home?status=<?php the_title(); ?>-<?php the_permalink(); ?>"><i class="fa fa-twitter"></i></a></li>
        <li><a data-pin-do="skipLink" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=&amp;description=<?php the_title(); ?>"><i class="fa fa-pinterest"></i></a></li>
      </ul>
    </div>
  <?php
    }
}

function blogwings_companion_magazina_data($atts) {
    $output = '';
    $pull_quote_atts = shortcode_atts(array(
        'page' => 1
            ), $atts);
    $did = wp_kses_post($pull_quote_atts['page']);

  	$output = blogwings_companion_dummy($did);
    return $output;
}
add_shortcode('blogwings-companion-magazina', 'blogwings_companion_magazina_data');