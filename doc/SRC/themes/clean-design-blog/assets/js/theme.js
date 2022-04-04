/**
 * Theme Main sript handler file
 * 
 */
jQuery(document).ready(function($) { // on document ready
    var stickey_header_one, stickySidebar;
    stickey_header_one  = cleanDesignBlogThemeObject.stickeyHeader_one;
    stickySidebar = cleanDesignBlogThemeObject.stickySidebar
    
    //trigger the effect on scroll
    if( stickey_header_one ) {
        $('.site-header').waypoint(function(direction) {  
            $('.main-navigation-section-wrap').toggleClass('fixed_header');
        }, { offset: - 0 });
    }
    
    /**
     * Stickey sidebar
     * 
     */
     if( stickySidebar ) {
        $( "#clean-design-blog-middle-left-content-section .primary-section, #clean-design-blog-middle-left-content-section .secondary-section" ).theiaStickySidebar(); // for middle left content section
        $( "#clean-design-blog-middle-right-content-section .primary-section, #clean-design-blog-middle-right-content-section .secondary-section" ).theiaStickySidebar(); // for middle right content section
        $( "#primary .blaze-main-content, #primary .blaze-sidebar-content" ).theiaStickySidebar(); // for all innerpages
     }

    /**
     * Header Toggle Sidebar handler
     * 
     */
    var header_sidebar_trigger = $( ".header-sidebar-trigger" )
    if( header_sidebar_trigger.length ) {
        header_sidebar_trigger.on( "click", function() {
            $("#page").prepend( '<div class="header-sidebar-overlay"></div>');
            $("body").toggleClass( "header_toggle_sidebar_active" );
            $(this).next(".header-sidebar-content").animate({
            width: "toggle"
          });
        })

        // on close trigger
        $(document).on( "click", ".header-sidebar-content .header-sidebar-trigger-close, .header-sidebar-overlay", function() {
            $("body").toggleClass( "header_toggle_sidebar_active" );
            $("#page .header-sidebar-overlay").remove();
            $("body").find( ".header-sidebar-content" ).animate({
            width: "toggle"
          });
        })
    }

    $(window).scroll(function() {
        if ( $(this).scrollTop() > 800 ) {
            $('#clean-design-blog-scroll-to-top').addClass('show');
        } else {
            $('#clean-design-blog-scroll-to-top').removeClass('show');
        }
    });

    // banner slider block
    $( ".bmm-banner-slider-block" ).each(function() {
        var _this = $(this),
        loop = ( _this.data( "loop" ) == 1 ),
        controls = ( _this.data( "controls" ) == 1 ),
        dots = ( _this.data( "dots" ) == 1 ),
        auto = ( _this.data( "auto" ) == 1 ),
        fade = ( _this.data( "fade" ) == 1 );
        speed = _this.data( "speed" );
        _this.slick({
            dots: dots,
            infinite: loop,
            fade: fade,
            speed: speed,
            arrows: controls,
            autoplay: auto,
            nextArrow: '<span class="slickArrow next-icon"><i class="fas fa-chevron-right"></i></span>',
            prevArrow: '<span class="slickArrow prev-icon"><i class="fas fa-chevron-left"></i></span>',
        })
        
    });
    
    // posts carousel block
    $( ".bmm-post-carousel-block .bmm-post-wrapper" ).each(function() {
        var _this = $(this),
        loop = ( _this.data( "loop" ) == 1 ),
        controls = ( _this.data( "control" ) == 1 ),
        dots = ( _this.data( "dots" ) == 1 ),
        auto = ( _this.data( "auto" ) == 1 ),
        speed = _this.data( "speed" );
        carouselColumn = _this.data( "column" ),
        responsiveCarouselColumn = _this.data( "res-column" );
        _this.slick({
            dots: dots,
            infinite: loop,
            speed: speed,
            arrows: controls,
            autoplay: auto,
            slidesToShow: carouselColumn,
            nextArrow: '<span class="slickArrow next-icon"><i class="fas fa-chevron-right"></i></span>',
            prevArrow: '<span class="slickArrow prev-icon"><i class="fas fa-chevron-left"></i></span>',
            responsive: [
                {
                    breakpoint:991,
                    settings: {
                      slidesToShow: responsiveCarouselColumn,
                      slidesToScroll: 1
                    }
                  },
                {
                    breakpoint: 480,
                    settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  }
            ],
        })
    });

    // header search
    $('.header_search_icon .main_search_icon').click( function() {
       $(this).next( '.header-search-wrap' ).toggleClass( 'show', 1000, "easeOutSine" );
    });
});