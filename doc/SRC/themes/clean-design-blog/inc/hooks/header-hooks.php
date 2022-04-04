<?php
/**
 * Handles hooks for the header area of the themes
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 * 
 */

if( !function_exists( 'clean_design_blog_header_template' ) ) :
    /**
     * Header close
     */
    function clean_design_blog_header_template() {
        get_template_part( 'template-parts/header/layout', 'three' );
    }
    add_action( 'clean_design_blog_header_hook', 'clean_design_blog_header_template', 10 );
endif;