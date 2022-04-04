<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Clean Design Blog
 * @since 1.0.0
 */

 /**
  * hook - clean_design_blog_footer_hook
  *
  * @hooked - clean_design_blog_footer_start
  * @hooked - clean_design_blog_footer_close
  *
  */
  	if( has_action( 'clean_design_blog_footer_hook' ) ) {
		do_action( 'clean_design_blog_footer_hook' );
	}

  /**
  * hook - clean_design_blog_bottom_footer_hook
  *
  * @hooked - clean_design_blog_bottom_footer_start
  * @hooked - clean_design_blog_bottom_footer_menu
  * @hooked - clean_design_blog_bottom_footer_site_info
  * @hooked - clean_design_blog_bottom_footer_close
  *
  */
  	if( has_action( 'clean_design_blog_bottom_footer_hook' ) ) {
	  	do_action( 'clean_design_blog_bottom_footer_hook' );
  	}

    /**
    * hook - clean_design_blog_after_footer_hook
    *
    * @hooked - clean_design_blog_scroll_to_top
    *
    */
  	if( has_action( 'clean_design_blog_after_footer_hook' ) ) {
	  	do_action( 'clean_design_blog_after_footer_hook' );
  	}
?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>