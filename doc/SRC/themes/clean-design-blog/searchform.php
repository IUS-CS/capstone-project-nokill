<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Clean Design Blog
 * @since 1.0.0
 */
?>
<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<span class="screen-reader-text"><?php _x( 'Search for:', 'Screen reader text', 'clean-design-blog' ); ?></span>
	    <input type="text" class="form-control" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" placeholder="<?php _x( 'Enter search words', 'Search field placeholder','clean-design-blog' ) ; ?>">
		<button class="search-button" type="submit"><span class="fa fa-search"></span></button>	
	</div>
</form>