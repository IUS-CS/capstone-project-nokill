<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Clean Design Blog
 * @since 1.0.0
 */

if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar('sidebar-page') ) {
	return;
}
?>
<?php
if ( is_page() ) { 
	?>
	<aside id="secondary" class="widget-area">
		<?php
			if ( class_exists( 'WooCommerce' ) ) {
				if( is_woocommerce() ) {
					dynamic_sidebar( 'shop-sidebar' );
				} else {
					dynamic_sidebar( 'sidebar-page' );
				}
			} else {
				dynamic_sidebar( 'sidebar-page' );
			}
		?>
	</aside><!-- #secondary -->
	<?php 
} else{ ?>
	<aside id="secondary" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- #secondary -->
<?php
}
