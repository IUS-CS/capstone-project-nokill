<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Clean Design Blog
 * @since 1.0.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php 
		wp_body_open();
	?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'clean-design-blog' ); ?></a>
	<?php
		/**
		 * hook - clean_design_blog_top_header_hook
		 * 
		 * @hooked - clean_design_blog_top_header_date
		 * 
		 */
		if( has_action( 'clean_design_blog_top_header_hook' ) ) {
			do_action( 'clean_design_blog_top_header_hook' );
		}
		
		/**
		 * hook - clean_design_blog_header_hook
		 * 
		 * @hooked - clean_design_blog_header_start
		 * 
		 */
		if( has_action( 'clean_design_blog_header_hook' ) ) {
			do_action( 'clean_design_blog_header_hook' );
		}

		/**
		 * hook - clean_design_blog_before_content_hook
		 * 
		 * @hooked - 
		 * 
		 */
		if( has_action( 'clean_design_blog_before_content_hook' ) ) {
			do_action( 'clean_design_blog_before_content_hook' );
		}