 jQuery(document).ready(function() {
 "use strict";
 // header-height
  if ((jQuery('header').length)!==''){ 
    jQuery(document).ready(function() {
        // if adminbar exist (should check for visible?) then add margin to our navbar
        var $wpheader = jQuery('header');
        if ($wpheader.length) {
          jQuery('.home .home-container, .single-post #page, .single #page').css('margin-top',$wpheader.height()+'px');  
        }
    });
    } 
/* ---------------------------------------------- /*
* Intro slider setup  # Responsive slider
/* ---------------------------------------------- */
  if( jQuery('.flex-slider').length > 0 ) {
  jQuery(".flex-slider").flexslider({
        animation: "slide",
        controlNav: true,
        smoothHeight: true,
        animationSpeed: 1000,
        animationLoop: true,
        prevText: '',
        nextText: '',
        useCSS: true
      });
    }

// check flexslider active or not
if(jQuery('body').find('.flex-slider').length){
jQuery("body").addClass("flexslider-wrap");
}else{
jQuery("body").removeClass("flexslider-wrap");
}
 // section_one_slider 
jQuery("#section_one .flexslider").flexslider({
        animation: "slide",
        controlNav: false,
        smoothHeight: true,
        animationSpeed: 1500,
        animationLoop: true,
        prevText: '',
        nextText: '',
        useCSS: true
      });
//owl-slider
jQuery('.post_slide .owl-carousel').owlCarousel({
                loop: true,
                margin: 3,
                items: 4,
                autoplay:true,
                smartSpeed: 2500,
                fluidSpeed:true,
                responsive: {
                  0: {
                    items: 1,
                    nav: true
                  },
                  420: {
                    items: 2,
                    nav: true
                  },
                  850: {
                    items: 3,
                    nav: true
                  },
                  1025: {
                    items: 3,
                    nav: true,
                    margin: 3
                  },
                  1180: {
                    items: 4,
                    nav: true,
                    margin: 3
                  }
                }
              })

  
});